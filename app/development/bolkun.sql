-- DROP DATABASE IF EXISTS bolkun;
-- CREATE DATABASE IF NOT EXISTS bolkun;
-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 19. Okt 2019 um 19:09
-- Server-Version: 10.4.6-MariaDB
-- PHP-Version: 7.3.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
-- Berlin Zone
SET time_zone = "+02:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `bolkun`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `user`
--
create table `user` (
  `user_id`                     bigint(20)      unsigned not null auto_increment,
  `account_status`              tinyint(1)      unsigned not null default 0         comment '1 account is active, 0 account ist inactive',
  `role`                        varchar(15)     default 'RegisteredUser'            comment 'RegisteredUser oder Admin',
  `firstname`                   varchar(70)     not null                            comment 'vorname',
  `surname`                     varchar(70)     not null                            comment 'nachname',
  `email`                       varchar(80)     not null                            comment 'email',
  `password`                    varchar(100)    not null                            comment 'hashed password',
  `password_tries`              int(1)          not null default 5                  comment 'max 5 tries available, 0 no tries available',
  `ip`                          longtext        not null                            comment 'ip',
  `creation_date`               datetime        default current_timestamp,
  `verification_code`           varchar(100)    default null,
  `inactive_date`               datetime        default null,
  primary key (`user_id`)
) engine=myisam default charset=utf8                                                comment='hier werden alle registrierte users gespeichert';

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `blog`
--
create table `blog` (
  `blog_id`                     bigint(20)      unsigned not null auto_increment,
  `created_by_user_id`          int(10)         unsigned not null                   comment 'user-id who created the article',
  `creation_date`               datetime        default current_timestamp,
  `last_edit_date`              datetime        default current_timestamp,
  `preview_image`               varchar(100)    not null default 'default_preview_image-min.png',
  `observe_permissions`         varchar(20)     not null                            comment 'All, RegisteredUsers, Admins, (I is [UserEmail])',
  `category`                    varchar(100)    default null,
  `title`                       text            not null,
  `rank`                        tinyint(1)      unsigned default 5,
  `views`                       bigint(20)      unsigned default 0,
  `views_ip`                    longtext        default null,
  `content`                     longblob        default null                        comment 'longblog main content',
  `parent_id`                   bigint(20)      not null                            comment 'id for main_menu',
  primary key (`blog_id`)
) engine=myisam default charset=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `preview_image`
--
create table `preview_image` (
  `id`                          bigint(20)      unsigned not null auto_increment,
  `created_by_user_id`          int(10)         unsigned not null                   comment 'user-id who created the article',
  `creation_date`               datetime        default current_timestamp,
  `preview_image`               varchar(100)    not null,
  primary key (`id`)
) engine=myisam default charset=utf8;

INSERT INTO `preview_image` (`id`, `created_by_user_id`, `preview_image`) VALUES
(1, 1, 'default_preview_image-min.png');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `social_media`
--
create table `social_media` (
  `id`                          bigint(20)      unsigned not null auto_increment,
  `name`                        varchar(100)    not null,
  `link`                        varchar(100)    not null,
  `image`                       varchar(100)    not null,
  primary key (`id`)
) engine=myisam default charset=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `social_image`
--
create table `social_image` (
  `id`                          bigint(20)      unsigned not null auto_increment,
  `created_by_user_id`          int(10)         unsigned not null,
  `creation_date`               datetime        default current_timestamp,
  `image`                       varchar(100)    not null,
  primary key (`id`)
) engine=myisam default charset=utf8;

INSERT INTO `social_image` (`id`, `created_by_user_id`, `image`) VALUES
(1, 1, 'default_social_image-min.png');

-- --------------------------------------------------------
