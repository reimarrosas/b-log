using Microsoft.AspNetCore.Authorization;
using Microsoft.AspNetCore.Mvc;
using server.DTOs;
using server.Models;

namespace server.Controllers
{
    [Route("api/[controller]")]
    [ApiController]
    [Produces("application/json")]
    [Authorize]
    public class LogbookController : ControllerBase
    {
        private readonly ILogger _logger;
        private readonly ServerContext _context;
        private string CurrentUserID => User.Claims.Where(c => c.Type == "UserID").First().Value;
        public LogbookController(ILogger<LogbookController> logger, ServerContext context)
        {
            _logger = logger;
            _context = context;
        }
        [HttpGet]
        public IActionResult GetUserLogbooks()
        {
            var userLogbooks = _context.Logbooks.Where(l => l.LogbookUser.UserID.ToString() == CurrentUserID).ToList();
            return Ok(new { Message = "User logbooks fetch successful!", Logbooks = userLogbooks });
        }
        [HttpGet("{logbookID}")]
        public IActionResult GetSingleUserLogbook(Guid logbookID)
        {
            var userLogbook = _context.Logbooks.Where(l => l.LogbookUser.UserID.ToString() == CurrentUserID && l.LogbookID == logbookID).FirstOrDefault();

            if (userLogbook == null)
            {
                return NotFound(new { Message = $"Logbook {logbookID} not found!" });
            }

            return Ok(new { Message = "User logbook fetch successful!", Logbook = userLogbook });
        }
        [HttpPost]
        public IActionResult CreateSingleLogbook([FromBody] LogbookCreateDTO newLogbook)
        {
            var user = _context.Users.Where(u => u.UserID.ToString() == CurrentUserID).First();

            var logbook = new Logbook
            {
                LogbookName = newLogbook.LogbookName,
                LogbookUser = user
            };

            try
            {
                _context.Logbooks.Add(logbook);
                _context.SaveChanges();
            }
            catch (System.Exception ex)
            {
                _logger.LogError(ex, "Logbook creation error: {Logbook}", newLogbook);
                return StatusCode(500, new { Message = "Something broke!" });
            }

            return StatusCode(201, new { Message = "Logbook creation successful!" });
        }
        [HttpPut]
        public IActionResult UpdateSingleLogbook([FromBody] LogbookUpdateDTO newLogbook)
        {
            var logbook = _context.Logbooks.Where(l => l.LogbookUser.UserID.ToString() == CurrentUserID && l.LogbookID == newLogbook.LogbookID).FirstOrDefault();

            if (logbook == null)
            {
                return NotFound(new { Message = $"Logbook {newLogbook.LogbookID} not found!" });
            }

            logbook.LogbookName = newLogbook.LogbookName;
            logbook.UpdatedAt = DateTime.UtcNow;

            try
            {
                _context.Logbooks.Update(logbook);
                _context.SaveChanges();
            }
            catch (System.Exception ex)
            {
                _logger.LogError(ex, "Logbook update error: {Logbook}", newLogbook);
                return StatusCode(500, new { Message = "Something broke!" });
            }

            return Ok(new { Message = $"Logbook {logbook.LogbookID} updated successfully!" });
        }
        [HttpDelete("{logbookID}")]
        public IActionResult DeleteSingleLogbook(Guid logbookID)
        {
            var logbook = _context.Logbooks.Where(l => l.LogbookUser.UserID.ToString() == CurrentUserID && l.LogbookID == logbookID).FirstOrDefault();

            if (logbook == null)
            {
                return NotFound(new { Message = $"Logbook {logbookID} not found!" });
            }

            try
            {
                _context.Logbooks.Remove(logbook);
                _context.SaveChanges();
            }
            catch (System.Exception ex)
            {
                _logger.LogError(ex, "Logbook deletion error: {Logbook}", logbookID);
                return StatusCode(500, new { Message = "Something broke!" });
            }

            return Ok(new { Message = $"Logbook {logbookID} deletion successful!" });
        }
    }
}