-- phpMyAdmin SQL Dump
-- version 3.4.10.1deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 24, 2013 at 08:32 PM
-- Server version: 5.5.31
-- PHP Version: 5.3.10-1ubuntu3.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `spacegame`
--

-- --------------------------------------------------------

--
-- Table structure for table `sg_systems`
--

CREATE TABLE IF NOT EXISTS `sg_systems` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(64) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `sg_systems`
--

INSERT INTO `sg_systems` (`id`, `Name`) VALUES
(1, 'Sol');

-- --------------------------------------------------------

--
-- Table structure for table `ssim_events`
--

CREATE TABLE IF NOT EXISTS `ssim_events` (
  `id` int(64) NOT NULL AUTO_INCREMENT,
  `what` varchar(64) DEFAULT NULL,
  `who` int(64) NOT NULL,
  `where` int(64) NOT NULL,
  `when` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `ssim_govts`
--

CREATE TABLE IF NOT EXISTS `ssim_govts` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(64) NOT NULL DEFAULT '',
  `isoname` varchar(2) NOT NULL DEFAULT '',
  `color` varchar(7) NOT NULL DEFAULT '#CCCCCC',
  `desc` longtext,
  `type` enum('I','R','P') DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `ssim_govts`
--

INSERT INTO `ssim_govts` (`id`, `name`, `isoname`, `color`, `desc`, `type`) VALUES
(1, 'Allied Neutral Systems', 'AN', '#CCCCCC', 'What makes a good man go neutral? Lust for gold? Power? Or were you just born with a heart full of neutrality?', 'I'),
(2, 'Human Federation', 'HF', '#D72A13', 'Humans! Can''t live with ''em, can''t live without ''em.', 'R'),
(3, 'Xenophobic Aliens', 'XA', '#720C75', 'They''re big, they''re bad and all they want to do is rip your goddamn face off.', 'R'),
(4, 'Pirates', 'PI', '#026259', 'Yarr!', 'P');

-- --------------------------------------------------------

--
-- Table structure for table `ssim_jumplanes`
--

CREATE TABLE IF NOT EXISTS `ssim_jumplanes` (
  `source` int(11) DEFAULT NULL,
  `destination` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ssim_jumplanes`
--

INSERT INTO `ssim_jumplanes` (`source`, `destination`) VALUES
(1, 2),
(2, 1),
(2, 4),
(4, 2),
(3, 2),
(2, 3);

-- --------------------------------------------------------

--
-- Table structure for table `ssim_news`
--

CREATE TABLE IF NOT EXISTS `ssim_news` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `date` datetime DEFAULT NULL,
  `content` longtext,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `ssim_news`
--

INSERT INTO `ssim_news` (`id`, `date`, `content`) VALUES
(1, '2012-11-24 08:05:48', 'Welcome to SpaceSim!'),
(2, '2012-11-24 09:04:18', 'Testing the news function!'),
(3, '2012-11-24 09:08:57', 'What should be working so far: <br><br>\r\n\r\n• Jumping<br>\r\n• Landing<br>\r\n• Each jump should last five minutes (300 seconds), during which you may not land or jump.'),
(4, '2012-11-25 11:51:02', 'Login and registration should be working. Note that there is NO VALIDATION WHAT SO EVER. Passwords are stored as sha1 sums, email addresses are stored in plaintext. TL;DR: Safety not guaranteed. '),
(5, '2012-11-26 10:16:29', 'For those that do not wish to register, a testing account has been created.<br>\r\n<strong>Username:</strong> testing<br>\r\n<strong>Password:</strong> testing<br><br>\r\n\r\nNote that there is a high probability of data conflicts with multiple people logged into and using the same account at once. Please report any errors.'),
(6, '2012-12-05 09:33:12', 'Jumps now last anywhere from 3-6 minutes.');

-- --------------------------------------------------------

--
-- Table structure for table `ssim_options`
--

CREATE TABLE IF NOT EXISTS `ssim_options` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `key` varchar(64) DEFAULT NULL,
  `value` varchar(256) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `ssim_options`
--

INSERT INTO `ssim_options` (`id`, `key`, `value`) VALUES
(1, 'game_name', 'Space Sim!'),
(2, 'fuelprice', '100');

-- --------------------------------------------------------

--
-- Table structure for table `ssim_ships`
--

CREATE TABLE IF NOT EXISTS `ssim_ships` (
  `id` int(64) NOT NULL AUTO_INCREMENT,
  `name` varchar(64) NOT NULL,
  `fueltank` int(4) NOT NULL,
  `cargobay` int(7) NOT NULL,
  `desc` varchar(512) NOT NULL,
  `cost` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `ssim_ships`
--

INSERT INTO `ssim_ships` (`id`, `name`, `fueltank`, `cargobay`, `desc`, `cost`) VALUES
(1, 'Mk. VI D.E.A.T.H.T.R.A.P', 10, 20, 'It''s basically a flying coffin really...', 10000),
(2, 'Pantheon Cargo Hauler', 15, 1000, 'A small, robust little cargo transport for a small, little pilot like yourself.', 15000);

-- --------------------------------------------------------

--
-- Table structure for table `ssim_spob`
--

CREATE TABLE IF NOT EXISTS `ssim_spob` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(64) DEFAULT NULL,
  `parent` int(11) DEFAULT NULL,
  `type` int(11) DEFAULT NULL,
  `desc` longtext,
  `bar` varchar(64) NOT NULL,
  `bardesc` varchar(1024) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `ssim_spob`
--

INSERT INTO `ssim_spob` (`id`, `name`, `parent`, `type`, `desc`, `bar`, `bardesc`) VALUES
(1, 'Earth', 1, 0, 'Earth, home of humanity. Raise your hand if you don''t like Earth. Now raise your other hand! You''re under arrest for being an Earth-hating alien!', 'The Dead Horse Bar', 'If you''re looking to run something into the ground you''ve come to the right place. This club has EVERYTHING. Poorly written references to pop culture from the early 2010s, unsubtle inside jokes and that thing where it''s painfully obvious this was funnier in my head.'),
(2, 'Mars', 1, 0, 'Ancient Romans worshiped Mars as the god of war. It is in fact now the largest dump in the Sol system, the result of decades of failed attempts to terraform the planet.', 'Lucky''s', 'Like the legend of the Phoenix, Lucky''s has come to far to give up who it is. The bartender looks like she''s been up all night.'),
(3, 'Luna', 1, 2, 'Earth''s only natural satellite, Luna, is smaller than your mom.', 'The Eclipse Bar and Grille', 'This bar is named for the lunar eclipse of 2319, when your mother walked in front of the sun.'),
(4, 'Centauri Prime', 2, 0, 'Early settlers were dismayed to discover that Centauri Prime is, in fact, quite boring and devoid of life.', 'The Bar', 'Barkeep grunts a hello at you and slides you a shot of scotch that you didn''t ask for or realized you wanted this badly.'),
(5, 'Whitecliffe', 2, 1, 'Something about this station gives you the creeps. It might have something to do with all the creeps.', 'The Winchester', 'Everyone agrees: the best thing to do when the going gets tough is to go to the Winchester, have a pint and wait for it all to blow over.'),
(6, 'Clarke', 1, 1, 'The inhabitants and crew of this outpost are pretty sure this station isn''t named for noted science fiction author Arthur C. Clarke. "Nooooope," they''ll say, "it''s definitely got nothing to do with the fact that the guy invented futurism or anything like that. No siree".', 'TMA-1', 'Everything in here is solid black. A radio in the corner is blasting indecipherable static.'),
(7, 'Space Station 13', 4, 3, 'Welcome to the station. Enjoy your stay.', 'The Maltese Falcon', 'A man dressed as a suspicious fucking detective is chain smoking at one end of the bar. Another man dressed as a clown is getting beaten to death by a team of red-suited security guards in the corner.'),
(8, 'Tau Ceti IV', 4, 0, 'Widely regarded as the best place for G4 Sunbathing in the galaxy, Tau Ceti IV''s horizon is made up of No Artificial Colors. Just Beware Low Flying Defense Drones, the planetary government here is in favor of the Nuke and Pave variety of diplomacy.', 'The Marathon', 'A dilapidated sign over the door reads "If I had a rocket Launcher I''d Make Somebody Pay". Welcome to The Marathon; For Carnage, Apply Within.');

-- --------------------------------------------------------

--
-- Table structure for table `ssim_syst`
--

CREATE TABLE IF NOT EXISTS `ssim_syst` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(64) DEFAULT NULL,
  `connections` varchar(128) DEFAULT NULL,
  `government` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `ssim_syst`
--

INSERT INTO `ssim_syst` (`id`, `name`, `connections`, `government`) VALUES
(1, 'Sol', '2', 2),
(2, 'Alpha Centauri', '1,3', 2),
(3, 'Polaris', '2,4', 3),
(4, 'Tau Ceti', '3', 2);

-- --------------------------------------------------------

--
-- Table structure for table `ssim_user`
--

CREATE TABLE IF NOT EXISTS `ssim_user` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(64) DEFAULT NULL,
  `email` varchar(256) DEFAULT NULL,
  `password` varchar(128) DEFAULT NULL,
  `location_syst` int(11) DEFAULT NULL,
  `location_spob` int(11) DEFAULT NULL,
  `landed` tinyint(1) DEFAULT NULL,
  `fuel` int(11) DEFAULT NULL,
  `jumping` tinyint(1) DEFAULT NULL,
  `eta` int(11) unsigned DEFAULT NULL,
  `role` enum('A','M','P') DEFAULT NULL,
  `registered` timestamp NULL DEFAULT NULL,
  `government` tinyint(1) DEFAULT '1',
  `credits` bigint(20) NOT NULL,
  `ship` int(64) NOT NULL,
  `vessel` varchar(128) NOT NULL,
  `attackable` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `ssim_user`
--

INSERT INTO `ssim_user` (`id`, `name`, `email`, `password`, `location_syst`, `location_spob`, `landed`, `fuel`, `jumping`, `eta`, `role`, `registered`, `government`, `credits`, `ship`, `vessel`, `attackable`) VALUES
(5, 'testing', 'testing', 'dc724af18fbdd4e59189f5fe768a5f8311527050', 1, 1, 0, 0, NULL, NULL, 'P', '2012-11-26 10:09:35', 1, 0, 2, 'Test Pilot, Please Ignore', 1),
(4, 'nfreader', 'nick@nfreader.net', 'dc724af18fbdd4e59189f5fe768a5f8311527050', 4, 7, 0, 15, 1, 1374697415, 'A', '2012-11-24 09:48:46', 1, 485500, 2, 'A Shot of Whiskey', 0),
(6, 'An Alien!', NULL, NULL, 1, 1, 0, 10, NULL, NULL, NULL, '2013-07-19 18:26:23', 3, 0, 2, 'ImmaKillYou', 1),
(7, 'nfreader2', 'nick@nfreader.net', 'dc724af18fbdd4e59189f5fe768a5f8311527050', 1, 1, 1, 10, 0, NULL, 'P', '2013-07-24 19:35:18', 1, 1000000, 1, 'Unnamed Vessel', 1),
(10, 'goforit', 'goforit', '937b4071b2514888795aea60cc06fc49f6faa779', 1, 1, 1, 10, 0, NULL, 'P', '2013-07-24 19:42:41', 1, 1000000, 1, 'Unnamed Vessel', 1),
(9, 'testacct', 'test@example.com', 'a94a8fe5ccb19ba61c4c0873d391e987982fbbd3', 1, 1, 1, 15, 0, NULL, 'P', '2013-07-24 19:39:44', 1, 985000, 2, 'Unnamed Vessel', 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
