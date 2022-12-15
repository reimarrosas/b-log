namespace server.DTOs
{
    public class LogbookUpdateDTO : LogbookCreateDTO
    {
        public Guid LogbookID { get; set; }
    }
}