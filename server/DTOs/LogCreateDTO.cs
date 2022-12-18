using System.ComponentModel.DataAnnotations;

namespace server.DTOs
{
    public class LogCreateDTO
    {
        public string? Name { get; set; }
        [Required]
        public DateTime Date { get; set; }
        [Required]
        public List<LogEntryDTO> LogEntries { get; set; } = null!;
    }
}