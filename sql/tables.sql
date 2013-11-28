-- phpMyAdmin SQL Dump
-- version 4.0.6
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 28, 2013 at 06:27 PM
-- Server version: 5.5.33
-- PHP Version: 5.5.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `a3_render_week1`
--

-- --------------------------------------------------------

--
-- Table structure for table `article`
--

CREATE TABLE `article` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `author` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `enabled` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `article`
--

INSERT INTO `article` (`id`, `title`, `content`, `author`, `date`, `enabled`) VALUES
(1, 'PHP 5.5.6 is now available', 'The PHP development team announces the immediate availability of PHP 5.5.6. This release fixes some bugs against PHP 5.5.5, and adds some performance improvements.\r\n\r\nFor source downloads of PHP 5.5.6 please visit our downloads page, Windows binaries can be found on windows.php.net/download/. The list of changes is recorded in the ChangeLog.', 2, '2013-11-28 18:24:30', 1),
(2, 'A further update on php.net', 'We are continuing to work through the repercussions of the php.net malware issue described in a news post earlier today. As part of this, the php.net systems team have audited every server operated by php.net, and have found that two servers were compromised: the server which hosted the www.php.net, static.php.net and git.php.net domains, and was previously suspected based on the JavaScript malware, and the server hosting bugs.php.net. The method by which these servers were compromised is unknown at this time.\r\n\r\nAll affected services have been migrated off those servers. We have verified that our Git repository was not compromised, and it remains in read only mode as services are brought back up in full.\r\n\r\nAs it''s possible that the attackers may have accessed the private key of the php.net SSL certificate, we have revoked it immediately. We are in the process of getting a new certificate, and expect to restore access to php.net sites that require SSL (including bugs.php.net and wiki.php.net) in the next few hours.\r\n\r\nTo summarise, the situation right now is that:\r\n\r\nJavaScript malware was served to a small percentage of php.net users from the 22nd to the 24th of October 2013.\r\nNeither the source tarball downloads nor the Git repository were modified or compromised.\r\nTwo php.net servers were compromised, and have been removed from service. All services have been migrated to new, secure servers.\r\nSSL access to php.net Web sites is temporarily unavailable until a new SSL certificate is issued and installed on the servers that need it.\r\nOver the next few days, we will be taking further action:\r\n\r\nphp.net users will have their passwords reset. Note that users of PHP are unaffected by this: this is solely for people committing code to projects hosted on svn.php.net or git.php.net.\r\nWe will provide a full post mortem in due course, most likely next week. You can also get updates from the official php.net Twitter: @official_php.', 2, '2013-11-28 18:24:52', 1),
(3, 'PHP 5.4.22 Released', 'The PHP development team announces the immediate availability of PHP 5.4.22. About 10 bugs were fixed. All PHP 5.4 users are encouraged to upgrade to this version.\r\n\r\nFor source downloads of PHP 5.4.22 please visit our downloads page, Windows binaries can be found on windows.php.net/download/. The list of changes is recorded in the ChangeLog.', 2, '2013-11-28 18:25:25', 0);

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `content` text NOT NULL,
  `author` int(11) NOT NULL,
  `article` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`id`, `content`, `author`, `article`) VALUES
(1, 'PHP 5.5.6 is better, think to upgrade your servers !', 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `password`, `role`) VALUES
(1, 'user', '12dea96fec20593566ab75692c9949596833adc9', 'ROLE_USER'),
(2, 'admin', 'd033e22ae348aeb5660fc2140aec35850c4da997', 'ROLE_ADMIN');
