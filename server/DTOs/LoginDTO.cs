using System.ComponentModel.DataAnnotations;

namespace server.DTOs
{
    public class LoginDTO : UserDTO
    {
        [Required]
        public bool KeepLoggedIn { get; set; }
    }
}