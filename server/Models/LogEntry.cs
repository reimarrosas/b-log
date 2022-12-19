using System.Text.Json.Serialization;

namespace server.Models
{
    public class LogEntry
    {
        public Guid LogEntryID { get; set; }
        public string Content { get; set; } = null!;
        [JsonIgnore]
        public Log Log { get; set; } = null!;
    }
}