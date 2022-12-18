using Microsoft.AspNetCore.Authorization;
using Microsoft.AspNetCore.Mvc;
using Microsoft.EntityFrameworkCore;

using server.DTOs;
using server.Models;

namespace server.Controllers
{
    [Route("api/{logbookID}/[controller]")]
    [ApiController]
    [Produces("application/json")]
    [Authorize]
    public class LogController : ControllerBase
    {
        private readonly ILogger _logger;
        private readonly ServerContext _context;
        private string CurrentUserID => User.Claims.Where(c => c.Type == "UserID").First().Value;
        public LogController(ILogger<LogController> logger, ServerContext context)
        {
            _logger = logger;
            _context = context;
        }
        [HttpGet]
        public IActionResult GetAllLogs(Guid logbookID)
        {
            var logbook = _context.Logbooks.Include(lb => lb.LogbookUser).Where(lb => lb.LogbookID == logbookID).FirstOrDefault();

            if (logbook == null)
            {
                return NotFound(new { Message = $"Logbook {logbookID} not found!" });
            }
            else if (logbook.LogbookUser.UserID.ToString() != CurrentUserID)
            {
                return StatusCode(403, new { Message = $"Logbook access forbidden!" });
            }

            var logs = _context.Logs.Include(l => l.LogEntries).Where(l => l.Logbook.LogbookID == logbookID).OrderByDescending(l => l.LogDate);

            return Ok(new { Message = "Logbook logs fetch successful!", Logs = logs });
        }
        [HttpPost]
        public IActionResult CreateLog(Guid logbookID, LogCreateDTO newLog)
        {
            var logbook = _context.Logbooks.Include(lb => lb.LogbookUser).Where(lb => lb.LogbookID == logbookID).FirstOrDefault();

            if (logbook == null)
            {
                return NotFound(new { Message = $"Logbook {logbookID} not found!" });
            }
            else if (logbook.LogbookUser.UserID.ToString() != CurrentUserID)
            {
                return StatusCode(403, new { Message = $"Logbook access forbidden!" });
            }

            var log = new Log();
            log.Name = newLog.Name;
            log.LogDate = newLog.Date;
            log.Logbook = logbook;
            log.LogEntries = newLog.LogEntries.Select(le => new LogEntry()
            {
                Content = le.Content,
                Log = log
            }).ToList();

            try
            {
                _context.Logs.Add(log);
                _context.SaveChanges();
            }
            catch (System.Exception ex)
            {
                _logger.LogError(ex, "Log creation error: {Log}", log);
                return StatusCode(500, new { Message = "Something broke!" });
            }

            return StatusCode(201, new { Message = "Log creation successful!" });
        }
        [HttpDelete("{logID}")]
        public IActionResult DeleteLog(Guid logbookID, Guid logID)
        {
            var logbook = _context.Logbooks.Include(lb => lb.LogbookUser).Where(lb => lb.LogbookID == logbookID).FirstOrDefault();

            if (logbook == null)
            {
                return NotFound(new { Message = $"Logbook {logbookID} not found!" });
            }
            else if (logbook.LogbookUser.UserID.ToString() != CurrentUserID)
            {
                return StatusCode(403, new { Message = $"Logbook access forbidden!" });
            }

            var log = _context.Logs.Where(l => l.Logbook.LogbookID == logbookID && l.LogID == logID).FirstOrDefault();

            if (log == null)
            {
                return NotFound(new { Message = $"Log {logID} not found!" });
            }

            try
            {
                _context.Logs.Remove(log);
                _context.SaveChanges();
            }
            catch (System.Exception ex)
            {
                _logger.LogError(ex, "Log deletion error: {Log}", log);
                return StatusCode(500, new { Message = "Something broke!" });
            }

            return Ok(new { Message = $"Log {logID} deletion successful!" });
        }
    }
}