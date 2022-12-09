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
    }
}