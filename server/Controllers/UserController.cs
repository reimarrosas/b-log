using Microsoft.AspNetCore.Http;
using Microsoft.AspNetCore.Mvc;

using server.Models;

namespace server.Controllers
{
    [Route("api/[controller]")]
    [ApiController]
    public class UserController : ControllerBase
    {
        private readonly ILogger _logger;
        private readonly ServerContext _context;
        public UserController(ILogger<UserController> logger, ServerContext context)
        {
            _logger = logger;
            _context = context;
        }
    }
}
