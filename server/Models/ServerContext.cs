using Microsoft.EntityFrameworkCore;

namespace server.Models
{
    public class ServerContext : DbContext
    {
        public ServerContext(DbContextOptions<ServerContext> opts)
            : base(opts)
        {
        }

        public DbSet<User> Users { get; set; } = null!;
        public DbSet<Logbook> Logbooks { get; set; } = null!;
        public DbSet<Log> Logs { get; set; } = null!;
        public DbSet<LogEntry> LogEntries { get; set; } = null!;
    }
}