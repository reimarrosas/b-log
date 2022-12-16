using System.Text.Json.Serialization;

namespace server.Models
{
    public class Logbook
    {
        public Guid LogbookID { get; set; }
        public string LogbookName { get; set; } = null!;
        public DateTime CreatedAt { get; set; } = DateTime.UtcNow;
        public DateTime UpdatedAt { get; set; } = DateTime.UtcNow;

        [JsonIgnore]
        public User LogbookUser { get; set; } = null!;
    }
}