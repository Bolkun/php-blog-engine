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
  `task_id` 					bigint(20) 		unsigned not null auto_increment,
  `creation_date` 				datetime 		default current_timestamp 			comment 'datum wann die aufgabe angelegt wurde',
  `created_by_user_id` 			int(10) 		unsigned not null 					comment 'user-id wer diese aufgabe erstellt hat',
  `created_for_user_id`			int(10) 		unsigned default null 				comment 'user-id wer diese aufgabe machen muss',
  `created_for_user_id_date` 	datetime 		not null 							comment 'datum wann die aufgabe zugewiesen wurde',
  `deadline_date` 				datetime 		default null 						comment 'deadline',
  `end_date` 				    datetime 		default null 						comment 'datum wann die aufgabe abgeschlossen wurde',
  `status` 						tinyint(1) 		unsigned not null default 0 		comment '0 neu, 1 in bearbeitung, 2 wartend, 3 abgeschlossen, 4 ueberarbeiten',
  `type` 						tinyint(1) 		unsigned not null default 1			comment '1 einmalig, 2 wiederholend',
  `title` 						varchar(255) 	not null,
  `description` 				text 			default null,
  `remark` 					    text 			default null						comment 'hier werden bemerkungen zur aufgabe notiert',
  `remark_date` 				datetime 		not null                            comment 'zuletzt bemerkung geschrieben datum',
  `remark_by_user_id` 			int(10) 		unsigned not null 					comment 'user-id wer diese bemerkung geschrieben hat',
  primary key (`task_id`)
) engine=myisam default charset=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `document`
--

create table `document` (
  `document_id` 				bigint(20) 		unsigned not null auto_increment,
  `task_id` 					bigint(20) 		unsigned default null,
  `uploaded_by_user_id` 		int(10) 	    unsigned not null,
  `upload_date` 				datetime 		default current_timestamp,
  `type` 						varchar(10) 	default null 				        comment 'txt, pdf, png ...',
  `name` 						varchar(50) 	not null,
  `saved_path` 					varchar(255) 	not null,
  primary key (`document_id`)
) engine=myisam default charset=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `user`
--

create table `user` (
  `user_id` 					int(10) 		unsigned not null auto_increment,
  `acount_status` 				tinyint(1) 		unsigned not null default 1			comment '1 account ist aktiv, 0 account ist inaktiv.',
  `role` 						varchar(15) 	default 'Mitarbeiter'				comment 'Mitarbeiter oder Admin',
  `firstname` 					varchar(70) 	not null							comment 'vorname',
  `surname` 					varchar(70) 	not null							comment 'nachname',
  `email` 						varchar(80) 	not null							comment 'email',
  `password` 					varchar(1000) 	not null							comment 'hashed password',
  `creation_date` 				datetime 		default current_timestamp,
  `inactive_date` 				datetime 		default null,
  primary key (`user_id`)
) engine=myisam default charset=utf8 												comment='hier werden alle mitarbeiter gespeichert';

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `cost`
--
create table `cost` (
  `cost_id` 					bigint(20) 		unsigned not null auto_increment,
  `created_by_user_id` 			int(10) 		unsigned not null 					comment 'user-id wer diese aufgabe erstellt hat',
  `category` 					varchar(20) 	default null						comment 'exmpl. household, firmhold',
  `type` 						tinyint(1) 		unsigned not null default 1			comment '1 einmalig, 2 wiederholend',
  `price` 					    decimal(15,2) 	default null,
  `title` 						varchar(255) 	not null,
  `repeated` 					tinyint(1) 		default null 						comment '0 daily, 1 monthly, 2 yearly', 
  `year` 						int(4) 		not null,
  `january` 					varchar(20) 		default null 		comment 'status: not paid, paid, free',
  `february` 					varchar(20) 		default null 		comment 'status: not paid, paid, free',
  `march` 						varchar(20) 		default null 		comment 'status: not paid, paid, free',
  `april` 						varchar(20) 		default null 		comment 'status: not paid, paid, free',
  `may` 						varchar(20) 		default null		comment 'status: not paid, paid, free',
  `june` 						varchar(20) 		default null 		comment 'status: not paid, paid, free',
  `july` 						varchar(20) 		default null 		comment 'status: not paid, paid, free',
  `august` 						varchar(20) 		default null 		comment 'status: not paid, paid, free',
  `september` 					varchar(20) 		default null 		comment 'status: not paid, paid, free',
  `october` 					varchar(20) 		default null 		comment 'status: not paid, paid, free',
  `november` 					varchar(20) 		default null 		comment 'status: not paid, paid, free',
  `december` 					varchar(20) 		default null 		comment 'status: not paid, paid, free',
  primary key (`cost_id`)
) engine=myisam default charset=utf8;

-- --------------------------------------------------------