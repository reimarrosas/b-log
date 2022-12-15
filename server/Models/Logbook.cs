namespace server.Models
{
    public class Logbook
    {
        public Guid LogbookID { get; set; }
        public string LogbookName { get; set; } = null!;

        public User LogbookUser { get; set; } = null!;
    }
}