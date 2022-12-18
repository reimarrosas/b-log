using System.ComponentModel.DataAnnotations;
using System.ComponentModel.DataAnnotations.Schema;
using System.Text.Json.Serialization;

namespace server.Models
{
    public class Log
    {
        [Key]
        public Guid LogID { get; set; }
        public string? Name { get; set; }
        public DateTime LogDate { get; set; }
        public DateTime CreatedAt { get; set; } = DateTime.UtcNow;
        public DateTime UpdatedAt { get; set; } = DateTime.UtcNow;
        [JsonIgnore]
        [DatabaseGenerated(DatabaseGeneratedOption.Identity)]
        public int PaginationID { get; set; }
        [JsonIgnore]
        public Logbook Logbook { get; set; } = null!;
        public List<LogEntry> LogEntries { get; set; } = null!;
    }
}