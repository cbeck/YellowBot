-- phpMyAdmin SQL Dump
-- version 3.3.0-dev
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 06, 2010 at 10:51 PM
-- Server version: 5.0.70
-- PHP Version: 5.2.9-pl2-gentoo

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `locationmonitor`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `username` tinytext NOT NULL,
  `password` tinytext NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `name` tinytext NOT NULL,
  `business_name` tinytext NOT NULL,
  `address1` tinytext NOT NULL,
  `address2` tinytext,
  `city` tinytext NOT NULL,
  `state` varchar(2) NOT NULL,
  `zip` varchar(5) NOT NULL,
  `phone` varchar(10) NOT NULL,
  `email` tinytext NOT NULL,
  `password` tinytext NOT NULL,
  `cc_number` tinytext NOT NULL,
  `cc_type` tinytext NOT NULL,
  `cc_exp` tinytext NOT NULL,
  `cc_name` tinytext NOT NULL,
  `cc_cvv` tinytext NOT NULL,
  `payment_key` text,
  `yellowbot_user_identifier` text NOT NULL,
  `signup_datetime` timestamp NOT NULL default CURRENT_TIMESTAMP,
  `cost` decimal(10,2) NOT NULL,
  `registered_business` int(11) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=53 ;
