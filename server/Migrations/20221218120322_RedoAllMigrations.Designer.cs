﻿// <auto-generated />
using System;
using Microsoft.EntityFrameworkCore;
using Microsoft.EntityFrameworkCore.Infrastructure;
using Microsoft.EntityFrameworkCore.Migrations;
using Microsoft.EntityFrameworkCore.Storage.ValueConversion;
using Npgsql.EntityFrameworkCore.PostgreSQL.Metadata;
using server.Models;

#nullable disable

namespace server.Migrations
{
    [DbContext(typeof(ServerContext))]
    [Migration("20221218120322_RedoAllMigrations")]
    partial class RedoAllMigrations
    {
        protected override void BuildTargetModel(ModelBuilder modelBuilder)
        {
#pragma warning disable 612, 618
            modelBuilder
                .HasAnnotation("ProductVersion", "6.0.10")
                .HasAnnotation("Relational:MaxIdentifierLength", 63);

            NpgsqlModelBuilderExtensions.UseIdentityByDefaultColumns(modelBuilder);

            modelBuilder.Entity("server.Models.Log", b =>
                {
                    b.Property<Guid>("LogID")
                        .ValueGeneratedOnAdd()
                        .HasColumnType("uuid");

                    b.Property<DateTime>("CreatedAt")
                        .HasColumnType("timestamp with time zone");

                    b.Property<DateTime>("LogDate")
                        .HasColumnType("timestamp with time zone");

                    b.Property<Guid>("LogbookID")
                        .HasColumnType("uuid");

                    b.Property<string>("Name")
                        .HasColumnType("text");

                    b.Property<int>("PaginationID")
                        .ValueGeneratedOnAdd()
                        .HasColumnType("integer");

                    NpgsqlPropertyBuilderExtensions.UseIdentityByDefaultColumn(b.Property<int>("PaginationID"));

                    b.Property<DateTime>("UpdatedAt")
                        .HasColumnType("timestamp with time zone");

                    b.HasKey("LogID");

                    b.HasIndex("LogbookID");

                    b.ToTable("Logs");
                });

            modelBuilder.Entity("server.Models.Logbook", b =>
                {
                    b.Property<Guid>("LogbookID")
                        .ValueGeneratedOnAdd()
                        .HasColumnType("uuid");

                    b.Property<DateTime>("CreatedAt")
                        .HasColumnType("timestamp with time zone");

                    b.Property<DateTime>("Date")
                        .HasColumnType("timestamp with time zone");

                    b.Property<string>("LogbookName")
                        .IsRequired()
                        .HasColumnType("text");

                    b.Property<Guid>("LogbookUserUserID")
                        .HasColumnType("uuid");

                    b.Property<DateTime>("UpdatedAt")
                        .HasColumnType("timestamp with time zone");

                    b.HasKey("LogbookID");

                    b.HasIndex("LogbookUserUserID");

                    b.ToTable("Logbooks");
                });

            modelBuilder.Entity("server.Models.LogEntry", b =>
                {
                    b.Property<Guid>("LogEntryID")
                        .ValueGeneratedOnAdd()
                        .HasColumnType("uuid");

                    b.Property<string>("Content")
                        .IsRequired()
                        .HasColumnType("text");

                    b.Property<Guid>("LogID")
                        .HasColumnType("uuid");

                    b.HasKey("LogEntryID");

                    b.HasIndex("LogID");

                    b.ToTable("LogEntries");
                });

            modelBuilder.Entity("server.Models.User", b =>
                {
                    b.Property<Guid>("UserID")
                        .ValueGeneratedOnAdd()
                        .HasColumnType("uuid");

                    b.Property<string>("Email")
                        .IsRequired()
                        .HasColumnType("text");

                    b.Property<string>("Name")
                        .IsRequired()
                        .HasColumnType("text");

                    b.Property<string>("Password")
                        .IsRequired()
                        .HasColumnType("text");

                    b.HasKey("UserID");

                    b.ToTable("Users");
                });

            modelBuilder.Entity("server.Models.Log", b =>
                {
                    b.HasOne("server.Models.Logbook", "Logbook")
                        .WithMany("Logs")
                        .HasForeignKey("LogbookID")
                        .OnDelete(DeleteBehavior.Cascade)
                        .IsRequired();

                    b.Navigation("Logbook");
                });

            modelBuilder.Entity("server.Models.Logbook", b =>
                {
                    b.HasOne("server.Models.User", "LogbookUser")
                        .WithMany("UserLogbooks")
                        .HasForeignKey("LogbookUserUserID")
                        .OnDelete(DeleteBehavior.Cascade)
                        .IsRequired();

                    b.Navigation("LogbookUser");
                });

            modelBuilder.Entity("server.Models.LogEntry", b =>
                {
                    b.HasOne("server.Models.Log", "Log")
                        .WithMany("LogEntries")
                        .HasForeignKey("LogID")
                        .OnDelete(DeleteBehavior.Cascade)
                        .IsRequired();

                    b.Navigation("Log");
                });

            modelBuilder.Entity("server.Models.Log", b =>
                {
                    b.Navigation("LogEntries");
                });

            modelBuilder.Entity("server.Models.Logbook", b =>
                {
                    b.Navigation("Logs");
                });

            modelBuilder.Entity("server.Models.User", b =>
                {
                    b.Navigation("UserLogbooks");
                });
#pragma warning restore 612, 618
        }
    }
}
