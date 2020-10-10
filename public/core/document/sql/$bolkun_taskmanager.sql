-- DROP DATABASE IF EXISTS $bolkun_taskmanager;
-- CREATE DATABASE IF NOT EXISTS $bolkun_taskmanager;
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
-- Datenbank: `$bolkun_taskmanager`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `task`
--
create table `task` (
  `task_id`                     bigint(20)      unsigned not null auto_increment,
  `creation_date`               datetime        default current_timestamp           comment 'datum wann die aufgabe angelegt wurde',
  `created_by_user_id`          int(10)         unsigned not null                   comment 'user-id wer diese aufgabe erstellt hat',
  `created_for_user_id`         int(10)         unsigned default null               comment 'user-id wer diese aufgabe machen muss',
  `created_for_user_id_date`    datetime        not null                            comment 'datum wann die aufgabe zugewiesen wurde',
  `deadline_date`               datetime        default null                        comment 'deadline',
  `end_date`                    datetime        default null                        comment 'datum wann die aufgabe abgeschlossen wurde',
  `status`                      tinyint(1)      unsigned not null default 0         comment '0 neu, 1 in bearbeitung, 2 wartend, 3 abgeschlossen, 4 ueberarbeiten',
  `type`                        tinyint(1)      unsigned not null default 1         comment '1 einmalig, 2 wiederholend',
  `title`                       varchar(255)    not null,
  `description`                 text            default null,
  `remark`                      text            default null                        comment 'hier werden bemerkungen zur aufgabe notiert',
  `remark_date`                 datetime        not null                            comment 'zuletzt bemerkung geschrieben datum',
  `remark_by_user_id`           int(10)         unsigned not null                   comment 'user-id wer diese bemerkung geschrieben hat',
  primary key (`task_id`)
) engine=myisam default charset=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `document`
--

create table `document` (
  `document_id`                 bigint(20)      unsigned not null auto_increment,
  `task_id`                     bigint(20)      unsigned default null,
  `uploaded_by_user_id`         bigint(20)      unsigned not null,
  `upload_date`                 datetime        default current_timestamp,
  `type`                        varchar(10)     default null                        comment 'txt, pdf, png ...',
  `name`                        varchar(50)     not null,
  `saved_path`                  varchar(255)    not null,
  primary key (`document_id`)
) engine=myisam default charset=utf8;

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
  `ip`                          varchar(45)     not null                            comment 'ip',
  `creation_date`               datetime        default current_timestamp,
  `verification_code`           varchar(100)    default null,
  `inactive_date`               datetime        default null,
  primary key (`user_id`)
) engine=myisam default charset=utf8                                                comment='hier werden alle registrierte users gespeichert';

--
-- Daten für Tabelle `user`
--

INSERT INTO `user` (`user_id`, `account_status`, `role`, `firstname`, `surname`, `email`, `password`, `ip`, `creation_date`, `verification_code`, `inactive_date`) VALUES
(1, 1, 'Admin', 'Serhiy', 'Bolkun', 'serhij16@live.de', '$2y$10$QBe5F9nCEmFifRaBFAurbuZo9z2WKz9wwrsAv7peo.cdbtNrJ/jE.', '::1', '2020-07-02 10:53:21', '666666',  NULL),
(2, 1, 'RegisteredUser', 'John', 'Snow', 'john@live.de', '$2y$10$QBe5F9nCEmFifRaBFAurbuZo9z2WKz9wwrsAv7peo.cdbtNrJ/jE.', '::1', '2020-07-02 10:53:21', '666666',  NULL);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `main_menu`
--
create table `main_menu` (
  `id`        int(11)       NOT NULL AUTO_INCREMENT,
  `title`     varchar(200)  NOT NULL,
  `parent_id` varchar(11)   NOT NULL,
  primary key (`id`)
) engine=myisam default charset=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `cost`
--
create table `cost` (
  `cost_id`                     bigint(20)      unsigned not null auto_increment,
  `created_by_user_id`          int(10)         unsigned not null                   comment 'user-id wer diese aufgabe erstellt hat',
  `category`                    varchar(20)     default null                        comment 'exmpl. household, firmhold',
  `type`                        tinyint(1)      unsigned not null default 1         comment '1 einmalig, 2 wiederholend',
  `price`                       decimal(15,2)   default null,
  `title`                       varchar(255)    not null,
  `repeated`                    tinyint(1)      default null                        comment '0 daily, 1 monthly, 2 yearly', 
  `year`                        int(4)          not null,
  `january`                     varchar(20)     default null                        comment 'status: not paid, paid, free',
  `february`                    varchar(20)     default null                        comment 'status: not paid, paid, free',
  `march`                       varchar(20)     default null                        comment 'status: not paid, paid, free',
  `april`                       varchar(20)     default null                        comment 'status: not paid, paid, free',
  `may`                         varchar(20)     default null                        comment 'status: not paid, paid, free',
  `june`                        varchar(20)     default null                        comment 'status: not paid, paid, free',
  `july`                        varchar(20)     default null                        comment 'status: not paid, paid, free',
  `august`                      varchar(20)     default null                        comment 'status: not paid, paid, free',
  `september`                   varchar(20)     default null                        comment 'status: not paid, paid, free',
  `october`                     varchar(20)     default null                        comment 'status: not paid, paid, free',
  `november`                    varchar(20)     default null                        comment 'status: not paid, paid, free',
  `december`                    varchar(20)     default null                        comment 'status: not paid, paid, free',
  primary key (`cost_id`)
) engine=myisam default charset=utf8;

--
-- Daten für Tabelle `cost`
--

INSERT INTO `cost` (`cost_id`, `created_by_user_id`, `category`, `type`, `price`, `title`, `repeated`, `year`, `january`, `february`, `march`, `april`, `may`, `june`, `july`, `august`, `september`, `october`, `november`, `december`) VALUES
(1, 1, 'household', 2, '16.00', 'Strom (Drewag)', 1, 2020, 'paid', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2, 1, 'household', 2, '232.00', 'Miete', 1, 2020, 'paid', NULL, 'paid', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(3, 1, 'household', 2, '32.98', '1&1', 1, 2020, 'paid', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(4, 1, 'household', 2, '61.50', 'Fahrkarte(Dresden)', 1, 2020, 'paid', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(5, 1, 'household', 2, '17.00', 'ARD-ZDF', 1, 2020, 'free', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `page`
--
create table `page` (
  `page_id`                     bigint(20)      unsigned not null auto_increment,
  `created_by_user_id`          int(10)         unsigned not null                   comment 'user-id who created the page',
  `creation_date`               datetime        default current_timestamp,
  `observe_permissions`         varchar(20)     not null                            comment 'everyone, registered_users, admins',
  `observed_count`              bigint(20)      unsigned default 0,
  `path`                        varchar(100)    not null                            comment 'absolute path to file',
  `link`                        varchar(100)    not null,
  `content`                     text            default null                        comment 'page main content',
  primary key (`page_id`)
) engine=myisam default charset=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `blog`
--
create table `blog` (
  `blog_id`                     bigint(20)      unsigned not null auto_increment,
  `created_by_user_id`          int(10)         unsigned not null                   comment 'user-id who created the article',
  `creation_date`               datetime        default current_timestamp,
  `last_edit_date`              datetime        default current_timestamp,
  `preview_image`               varchar(100)    not null default 'default_blog_page-min.png',
  `observe_permissions`         varchar(20)     not null                            comment 'All, RegisteredUsers, Admins, (I is [UserEmail])',
  `category`                    varchar(100)    not null default 'Info',
  `title`                       varchar(100)    not null,
  `rank`                        tinyint(1)      unsigned default 5,
  `views`                       bigint(20)      unsigned default 0,
  `content`                     blob            default null                        comment 'blog main content',
  `mm_id`                       int(11)         not null                            comment 'secondary key from main_menu',
  primary key (`blog_id`)
) engine=myisam default charset=utf8;

-- --------------------------------------------------------