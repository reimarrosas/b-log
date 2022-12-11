using System.ComponentModel.DataAnnotations;

namespace server.DTOs
{
    public class SignupDTO : UserDTO
    {
        [Required]
        public string Name { get; set; }
    }
}