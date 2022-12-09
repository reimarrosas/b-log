using Microsoft.EntityFrameworkCore;

namespace server.Models
{
    public class User
    {
        public Guid UserID { get; set; }
        public string Name { get; set; } = null!;
        public string Email { get; set; } = null!;
        public string Password { get; set; } = null!;
    }
}