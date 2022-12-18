namespace server.Models
{
    public class LogEntry
    {
        public Guid LogEntryID { get; set; }
        public string Content { get; set; } = null!;
        public Log Log { get; set; } = null!;
    }
}