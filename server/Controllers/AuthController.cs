using Microsoft.AspNetCore.Http;
using Microsoft.AspNetCore.Authentication;
using Microsoft.AspNetCore.Mvc;
using Microsoft.AspNetCore.Authentication.Cookies;
using Microsoft.EntityFrameworkCore;

using System.Security.Claims;

using server.Models;
using server.DTOs;
using Microsoft.AspNetCore.Authorization;

namespace server.Controllers
{
    [Route("api/[controller]")]
    [ApiController]
    [Produces("application/json")]
    public class AuthController : ControllerBase
    {
        private readonly ILogger _logger;
        private readonly ServerContext _context;
        public AuthController(ILogger<AuthController> logger, ServerContext context)
        {
            _logger = logger;
            _context = context;
        }

        [HttpPost("login")]
        public async Task<IActionResult> Login([FromBody] LoginDTO login)
        {
            var user = _context.Users.Where(u => u.Email == login.Email).FirstOrDefault();

            if (user == null)
            {
                return Unauthorized(new { Message = "User does not exist!" });
            }

            if (!BCrypt.Net.BCrypt.Verify(login.Password, user.Password))
            {
                return Unauthorized(new { Message = "Password invalid!" });
            }

            var claims = new List<Claim>
            {
                new Claim("UserID", user.UserID.ToString()),
                new Claim("Email", user.Email),
            };

            var claimsIdentity = new ClaimsIdentity(claims, CookieAuthenticationDefaults.AuthenticationScheme);

            var authProperties = new AuthenticationProperties
            {
                IsPersistent = login.KeepLoggedIn
            };

            await HttpContext.SignInAsync(
                CookieAuthenticationDefaults.AuthenticationScheme,
                new ClaimsPrincipal(claimsIdentity),
                authProperties
            );

            _logger.LogInformation("User {Email} logged in at {Time}.", user.Email, DateTime.UtcNow);

            return Ok(new { Message = "User login successful!" });
        }
        [HttpPost("signup")]
        public IActionResult Signup([FromBody] SignupDTO signup)
        {
            var user = _context.Users.Where(u => u.Email == signup.Email).FirstOrDefault();

            if (user != null)
            {
                return Conflict(new { Message = "User already exists!" });
            }

            try
            {
                _context.Add(new User
                {
                    Name = signup.Name,
                    Email = signup.Email,
                    Password = BCrypt.Net.BCrypt.HashPassword(signup.Password)
                });

                _context.SaveChanges();
            }
            catch (System.Exception ex)
            {
                _logger.LogError(ex, "Signup body error: {Body}", signup);
                return StatusCode(500, new { Message = "Something broke!" });
            }

            return StatusCode(201, new { Message = "User creation successful!" });
        }
        [HttpGet("me")]
        [Authorize]
        public IActionResult Me()
        {
            var userID = User.Claims.Where(u => u.Type == "UserID").First().Value;
            var email = User.Claims.Where(u => u.Type == "Email").First().Value;
            return Ok(new
            {
                Message = "User is currently logged in!",
                User = new
                {
                    ID = userID,
                    Email = email
                }
            });
        }
        [HttpPost("logout")]
        [Authorize]
        public async Task<IActionResult> Logout()
        {
            await HttpContext.SignOutAsync(CookieAuthenticationDefaults.AuthenticationScheme);
            return Ok(new { Message = "User logout successful!" });
        }
    }
}
