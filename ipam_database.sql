-- phpMyAdmin SQL Dump
-- version 3.4.10.1deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 03, 2013 at 03:07 PM
-- Server version: 5.5.34
-- PHP Version: 5.3.10-1ubuntu3.9

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `ipam`
--
CREATE DATABASE `ipam` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `ipam`;

-- --------------------------------------------------------

--
-- Table structure for table `ipaddress`
--

CREATE TABLE IF NOT EXISTS `ipaddress` (
  `id` mediumint NOT NULL AUTO_INCREMENT,
  `ipaddress` varchar(20) NOT NULL,
  `desc` varchar(60) NOT NULL,
  `devicename` varchar(30) NOT NULL,
  `devicetype` varchar(30) NOT NULL,
  `notes` text NOT NULL,
  `netid` mediumint NOT NULL,
  `used` tinyint(2) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `ipaddress` (`ipaddress`),
  KEY `netid` (`netid`),
  KEY `used` (`used`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=99 ;



--
-- Table structure for table `netgroup`
--

CREATE TABLE IF NOT EXISTS `netgroup` (
  `id` mediumint NOT NULL AUTO_INCREMENT,
  `name` varchar(60) NOT NULL,
  `desc` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;


-- --------------------------------------------------------

--
-- Table structure for table `networks`
--

CREATE TABLE IF NOT EXISTS `networks` (
  `id` mediumint NOT NULL AUTO_INCREMENT,
  `netgroup` mediumint NOT NULL,
  `name` varchar(30) NOT NULL,
  `network` varchar(30) NOT NULL,
  `vlan` int(10) NOT NULL,
  `exclusion_list` varchar(160) NOT NULL,
  `snmp` varchar(160) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `netgroup` (`netgroup`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;


-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` mediumint NOT NULL AUTO_INCREMENT,
  `username` varchar(30) NOT NULL,
  `password` varchar(200) NOT NULL,
  `fname` varchar(20) NOT NULL,
  `lname` varchar(20) NOT NULL,
  `role` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `fname`, `lname`, `role`) VALUES
(1, 'admin', '$2a$10$QfygyosUT2S6KUJup2ohnu/.PH/Vch8San6rsoAtROwcyhT6qf38u', 'Administrator', 'Main', 'Administrator');

--
-- Table structure for table `stats`
--

CREATE TABLE IF NOT EXISTS `stats` (
  `id` mediumint NOT NULL AUTO_INCREMENT,
  `ipaddress` varchar(30) NOT NULL,
  `user` varchar(50) NOT NULL,
  `session` char(100) NOT NULL,
  `time` int(20) NOT NULL,
  `online` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `ipaddress`
--
ALTER TABLE `ipaddress`
  ADD CONSTRAINT `ipaddress_ibfk_1` FOREIGN KEY (`netid`) REFERENCES `networks` (`id`) ON DELETE NO ACTION;

--
-- Constraints for table `networks`
--
ALTER TABLE `networks`
  ADD CONSTRAINT `networks_ibfk_1` FOREIGN KEY (`netgroup`) REFERENCES `netgroup` (`id`) ON DELETE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

GRANT ALL PRIVILEGES ON ipam.* TO 'ipam'@'localhost' IDENTIFIED BY 'ip12#4';
