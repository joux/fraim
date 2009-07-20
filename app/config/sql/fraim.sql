-- phpMyAdmin SQL Dump
-- version 3.1.2deb1ubuntu0.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Erstellungszeit: 20. Juli 2009 um 20:22
-- Server Version: 5.0.75
-- PHP-Version: 5.2.6-3ubuntu4.1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Datenbank: `fraim`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `copies`
--

CREATE TABLE IF NOT EXISTS `copies` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `original_id` int(10) unsigned NOT NULL,
  `user_id` smallint(5) unsigned NOT NULL,
  `description` varchar(256) default NULL,
  `created` datetime default NULL,
  `file` varchar(128) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `films`
--

CREATE TABLE IF NOT EXISTS `films` (
  `id` smallint(5) unsigned NOT NULL auto_increment,
  `user_id` smallint(5) unsigned NOT NULL,
  `created` datetime default NULL,
  `description` varchar(256) default NULL,
  `title` varchar(128) NOT NULL,
  `single_frames_ready` tinyint(1) NOT NULL,
  `conversion_error` tinyint(1) NOT NULL,
  `render_me` tinyint(1) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `originals`
--

CREATE TABLE IF NOT EXISTS `originals` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `film_id` smallint(5) unsigned NOT NULL,
  `file` varchar(128) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5468 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` smallint(5) unsigned NOT NULL auto_increment,
  `name` varchar(64) NOT NULL,
  `email` varchar(128) default NULL,
  `password` varchar(64) default NULL,
  `reset_token` varchar(64) default NULL,
  `reset_token_expires` datetime default NULL,
  `group` varchar(64) NOT NULL,
  `created` datetime default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

