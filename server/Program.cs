using Microsoft.EntityFrameworkCore;
using Microsoft.AspNetCore.Authentication.Cookies;
using Microsoft.AspNetCore.Authorization;

using server.Models;
using server.Helpers;

var builder = WebApplication.CreateBuilder(args);

// Add services to the container.

builder.Services.AddControllers(opts =>
{
    opts.RespectBrowserAcceptHeader = true;
});

builder.Services.AddSingleton<IAuthorizationMiddlewareResultHandler, CustomAuthorization>();

builder.Services
       .AddAuthentication(CookieAuthenticationDefaults.AuthenticationScheme)
       .AddCookie();

builder.Services.AddDbContext<ServerContext>(opts =>
{
    opts.UseNpgsql(builder.Configuration.GetConnectionString("ServerContext"));
});

// Learn more about configuring Swagger/OpenAPI at https://aka.ms/aspnetcore/swashbuckle
builder.Services.AddEndpointsApiExplorer();
builder.Services.AddSwaggerGen();

var app = builder.Build();

// Configure the HTTP request pipeline.
if (app.Environment.IsDevelopment())
{
    app.UseSwagger();
    app.UseSwaggerUI();
}

app.UseHttpsRedirection();

app.UseAuthentication();
app.UseAuthorization();

app.MapControllers();

app.Run();
