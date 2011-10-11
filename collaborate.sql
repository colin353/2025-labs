-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 11, 2011 at 02:11 AM
-- Server version: 5.1.53
-- PHP Version: 5.3.4

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `collaborate`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE IF NOT EXISTS `accounts` (
  `account_id` int(11) NOT NULL AUTO_INCREMENT,
  `account_owner_id` int(11) DEFAULT NULL,
  `account_type` enum('pocket','project','shareholder') NOT NULL,
  PRIMARY KEY (`account_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`account_id`, `account_owner_id`, `account_type`) VALUES
(1, 1, 'pocket'),
(2, 1, 'shareholder'),
(3, 2, 'pocket'),
(7, 2, 'shareholder'),
(5, 1, 'project'),
(6, 5, 'project');

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE IF NOT EXISTS `events` (
  `event_id` int(11) NOT NULL AUTO_INCREMENT,
  `event_text` text NOT NULL,
  `event_user_id` int(11) NOT NULL,
  `event_creationdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `event_project_id` int(11) NOT NULL,
  `event_relevant_id` int(11) NOT NULL,
  PRIMARY KEY (`event_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=110 ;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`event_id`, `event_text`, `event_user_id`, `event_creationdate`, `event_project_id`, `event_relevant_id`) VALUES
(37, 'created a new project milestone', 2, '2011-10-10 17:21:32', 1, 17),
(38, 'deleted a milestone', 2, '2011-10-10 17:21:42', 0, 17),
(39, 'deleted a task', 2, '2011-10-10 17:27:14', 0, 37),
(40, 'created a new task', 2, '2011-10-10 17:27:42', 1, 39),
(41, 're-ordered some milestones', 2, '2011-10-10 17:28:06', 0, 0),
(42, 'wrote a new project status update', 2, '2011-10-10 17:29:06', 1, 21),
(43, 'wrote a new project status update', 1, '2011-10-10 17:29:28', 1, 22),
(44, 're-ordered some milestones', 1, '2011-10-10 17:31:28', 0, 0),
(45, 're-ordered some milestones', 1, '2011-10-10 17:31:41', 0, 0),
(46, 're-ordered some milestones', 1, '2011-10-10 17:32:46', 0, 14),
(47, 're-ordered some milestones', 1, '2011-10-10 17:34:43', 1, 13),
(48, 're-ordered some milestones', 1, '2011-10-10 17:34:50', 1, 14),
(49, 'completed a task', 1, '2011-10-10 17:34:59', 0, 0),
(50, 'uncompleted a task', 1, '2011-10-10 17:35:28', 0, 39),
(51, 'completed a task', 1, '2011-10-10 17:35:37', 0, 39),
(52, 're-ordered some milestones', 1, '2011-10-10 17:36:20', 1, 14),
(53, 'uncompleted a task', 1, '2011-10-10 17:37:55', 0, 39),
(54, 'completed a task', 1, '2011-10-10 17:37:58', 0, 39),
(55, 'uncompleted a task', 1, '2011-10-10 17:39:01', 0, 39),
(56, 'completed a task', 1, '2011-10-10 17:39:02', 0, 39),
(57, 'uncompleted a taskYou have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near '''' at line 1', 1, '2011-10-10 17:40:09', 0, 39),
(58, 'completed a taskYou have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near '''' at line 1', 1, '2011-10-10 17:40:10', 0, 39),
(59, 'uncompleted a task: select * from todolistmilestone,todolist where todolistmilestone_id = todolist_milestone_id and todolistmilestone_id = ', 1, '2011-10-10 17:41:14', 0, 39),
(60, 'completed a task: select * from todolistmilestone,todolist where todolistmilestone_id = todolist_milestone_id and todolistmilestone_id = ', 1, '2011-10-10 17:41:14', 0, 39),
(61, 'uncompleted a task: ', 1, '2011-10-10 17:42:35', 0, 39),
(62, 'completed a task: select * from todolistmilestone,todolist where todolistmilestone_id = todolist_milestone_id and todolist_id = 10', 1, '2011-10-10 17:43:45', 0, 10),
(63, 'completed a task', 1, '2011-10-10 17:46:41', 1, 39),
(64, 'uncompleted a task', 1, '2011-10-10 17:46:56', 1, 39),
(65, 'created a new project resource', 1, '2011-10-10 17:47:50', 1, 6),
(66, 'wrote a new project status update', 1, '2011-10-10 17:48:28', 1, 23),
(67, 'wrote a new project status update', 1, '2011-10-10 17:50:40', 1, 24),
(68, 'deleted a task', 1, '2011-10-10 19:02:09', 0, 20),
(69, 'created a new task', 1, '2011-10-10 19:02:17', 1, 40),
(70, 'completed a task', 1, '2011-10-10 19:02:20', 1, 40),
(71, 'created a project', 1, '2011-10-10 19:34:55', 0, 0),
(72, 'created a project', 1, '2011-10-10 19:36:05', 2, 2),
(73, 'created a project', 1, '2011-10-10 19:41:36', 3, 3),
(74, 'created a project', 1, '2011-10-10 19:42:45', 4, 4),
(75, 'created a project', 1, '2011-10-10 19:45:27', 5, 5),
(76, 'created a project', 1, '2011-10-10 19:47:23', 6, 6),
(77, 'created a new project milestone', 1, '2011-10-10 19:58:38', 5, 18),
(78, 'created a new task', 1, '2011-10-10 19:58:48', 5, 41),
(79, 'created a new task', 1, '2011-10-10 19:59:04', 5, 42),
(80, 'created a new project milestone', 1, '2011-10-10 19:59:58', 5, 19),
(81, 'created a new task', 1, '2011-10-10 20:00:08', 5, 43),
(82, 'created a new task', 1, '2011-10-10 20:00:20', 5, 44),
(83, 'created a new project milestone', 1, '2011-10-10 20:01:50', 5, 20),
(84, 'created a new task', 1, '2011-10-10 20:01:58', 5, 45),
(85, 'completed a task', 1, '2011-10-10 20:02:02', 5, 42),
(86, 'created a new project resource', 1, '2011-10-10 20:03:25', 5, 7),
(87, 'wrote a new project status update', 1, '2011-10-10 20:03:36', 5, 25),
(88, 'completed a task', 1, '2011-10-10 20:09:40', 1, 18),
(89, 'wrote a new project status update', 1, '2011-10-10 20:09:52', 1, 26),
(90, 'logged in', 2, '2011-10-10 20:28:32', 0, 2),
(91, 'logged in', 1, '2011-10-10 20:29:19', 0, 1),
(92, 'logged out', 1, '2011-10-10 20:29:23', 0, 0),
(93, 'logged in', 2, '2011-10-10 20:29:27', 0, 2),
(94, 'logged out', 2, '2011-10-10 20:29:35', 0, 0),
(95, 'logged in', 1, '2011-10-10 20:29:38', 0, 1),
(96, 'wrote a new project status update', 1, '2011-10-10 20:38:14', 1, 27),
(97, 'completed a task', 1, '2011-10-10 21:15:53', 1, 24),
(98, 'deleted a task', 1, '2011-10-10 21:18:01', 0, 31),
(99, 'logged in', 1, '2011-10-10 23:16:28', 0, 1),
(100, 'logged in', 1, '2011-10-11 01:16:04', 0, 1),
(101, 'created a new task', 1, '2011-10-11 01:16:37', 1, 46),
(102, 'completed a task', 1, '2011-10-11 01:43:48', 1, 33),
(103, 'uncompleted a task', 1, '2011-10-11 01:43:50', 1, 33),
(104, 'completed a task', 1, '2011-10-11 01:43:51', 1, 46),
(105, 'created a new task', 1, '2011-10-11 01:44:22', 1, 47),
(106, 'created a new task', 1, '2011-10-11 01:44:43', 1, 48),
(107, 'created a new task', 1, '2011-10-11 01:52:14', 1, 49),
(108, 'created a new task', 1, '2011-10-11 01:53:01', 1, 50),
(109, 'wrote a new project status update', 1, '2011-10-11 01:53:46', 1, 28);

-- --------------------------------------------------------

--
-- Table structure for table `fundingrequests`
--

CREATE TABLE IF NOT EXISTS `fundingrequests` (
  `fundingrequest_id` int(11) NOT NULL AUTO_INCREMENT,
  `fundingrequest_description` text NOT NULL,
  `fundingrequest_creator_id` int(11) NOT NULL,
  `fundingrequest_value` float NOT NULL,
  `fundingrequest_debtor` int(11) NOT NULL,
  `fundingrequest_creationdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`fundingrequest_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `projectmemberships`
--

CREATE TABLE IF NOT EXISTS `projectmemberships` (
  `projectmembership_id` int(11) NOT NULL AUTO_INCREMENT,
  `projectmembership_user_id` int(11) NOT NULL,
  `projectmembership_project_id` int(11) NOT NULL,
  `projectmembership_creationdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `projectmembership_role` varchar(50) NOT NULL,
  PRIMARY KEY (`projectmembership_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `projectmemberships`
--

INSERT INTO `projectmemberships` (`projectmembership_id`, `projectmembership_user_id`, `projectmembership_project_id`, `projectmembership_creationdate`, `projectmembership_role`) VALUES
(1, 1, 1, '0000-00-00 00:00:00', 'programmer'),
(9, 2, 1, '2011-10-10 17:13:46', 'observer'),
(13, 1, 6, '2011-10-10 19:47:23', ''),
(12, 1, 5, '2011-10-10 19:45:27', '');

-- --------------------------------------------------------

--
-- Table structure for table `projectresource`
--

CREATE TABLE IF NOT EXISTS `projectresource` (
  `projectresource_id` int(11) NOT NULL AUTO_INCREMENT,
  `projectresource_project_id` int(11) NOT NULL,
  `projectresource_title` varchar(50) NOT NULL,
  `projectresource_value` varchar(200) NOT NULL,
  PRIMARY KEY (`projectresource_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `projectresource`
--

INSERT INTO `projectresource` (`projectresource_id`, `projectresource_project_id`, `projectresource_title`, `projectresource_value`) VALUES
(1, 1, 'GitHub URL', 'https://github.com/colin353/2025-labs'),
(5, 1, 'Best resource', 'http://2025-labs.com'),
(4, 1, 'Datasheets', 'www.google.com'),
(6, 1, 'Test', 'Resource'),
(7, 5, 'My favourite acorn tree', 'http://g.co/maps/trnrs');

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE IF NOT EXISTS `projects` (
  `project_id` int(11) NOT NULL AUTO_INCREMENT,
  `project_name` varchar(40) NOT NULL,
  `project_description` varchar(140) NOT NULL,
  `project_salespitch` text NOT NULL,
  `project_creationdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `project_creator_id` int(11) NOT NULL,
  `project_code` varchar(6) NOT NULL,
  `project_unique` int(11) NOT NULL,
  PRIMARY KEY (`project_id`),
  UNIQUE KEY `project_unique` (`project_unique`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`project_id`, `project_name`, `project_description`, `project_salespitch`, `project_creationdate`, `project_creator_id`, `project_code`, `project_unique`) VALUES
(1, 'Collaborate', 'Collaborate is the website backend that runs 2025 Labs.', 'I think it would be pretty cool to have a backend website which runs and organizes everything about 2025, so I am creating it.', '2011-10-02 23:47:24', 1, '', 0),
(5, 'Operation Furry Mammal', 'YOU GUYS, this project is TOP SECRET', 'YOU GUYS, this project is TOP SECRET', '2011-10-10 19:57:52', 1, '', 98178734);

-- --------------------------------------------------------

--
-- Table structure for table `projectstatus`
--

CREATE TABLE IF NOT EXISTS `projectstatus` (
  `projectstatus_id` int(11) NOT NULL AUTO_INCREMENT,
  `projectstatus_user_id` int(11) NOT NULL,
  `projectstatus_project_id` int(11) NOT NULL,
  `projectstatus_status` text NOT NULL,
  `projectstatus_creationdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`projectstatus_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=29 ;

--
-- Dumping data for table `projectstatus`
--

INSERT INTO `projectstatus` (`projectstatus_id`, `projectstatus_user_id`, `projectstatus_project_id`, `projectstatus_status`, `projectstatus_creationdate`) VALUES
(1, 1, 1, 'I am just writing the project status module right now.', '2011-10-03 01:08:34'),
(2, 2, 1, 'Trying to see if the project status module will work.', '2011-10-03 01:17:15'),
(3, 1, 1, 'I think the nice javascript status update plugin works now', '2011-10-03 02:15:14'),
(4, 1, 1, 'Let''s see if the nice new javascript plugin works', '2011-10-03 02:16:51'),
(5, 1, 1, 'Yep, I can post updates now, pretty sweet', '2011-10-03 02:17:02'),
(6, 1, 1, 'Commited new version of the site to github, supercool', '2011-10-03 02:20:39'),
(7, 1, 1, 'Working on project links for now I guess', '2011-10-03 02:21:57'),
(8, 1, 1, 'Last commit for the night. Resources are done, maybe I should start to-do next', '2011-10-03 03:03:15'),
(9, 1, 1, 'Totally hacked haha', '2011-10-03 13:54:25'),
(10, 1, 1, 'ghjfkjnfghdrfgservsev', '2011-10-03 13:56:08'),
(11, 1, 1, 'writing the to-do module, it is looking pretty sweet', '2011-10-04 04:24:24'),
(12, 1, 1, 'to-do list module almost complete now! going to sleep...', '2011-10-04 05:56:18'),
(13, 1, 1, 'to-do list module now can re-order milestones, complete tasks, delete tasks', '2011-10-06 05:16:27'),
(14, 1, 1, 'status updates now have the correct times shown', '2011-10-06 05:21:33'),
(15, 1, 1, 'and now we have support for zero-second display', '2011-10-06 05:23:39'),
(16, 1, 1, 'and now it actually has correct grammar!', '2011-10-06 05:24:17'),
(17, 1, 1, 'finished to-do list milestone deletion, now I''ll work on project status', '2011-10-09 20:49:44'),
(18, 1, 1, 'now people can be added to projects, will do project status now', '2011-10-09 22:09:17'),
(19, 1, 1, 'committed latest before starting status', '2011-10-09 22:10:03'),
(20, 1, 1, 'working on event log', '2011-10-10 01:12:51'),
(21, 2, 1, 'finishing up event log', '2011-10-10 17:29:06'),
(22, 1, 1, 'accidentally signed in as matt for last status update', '2011-10-10 17:29:28'),
(23, 1, 1, 'I think event log is done now', '2011-10-10 17:48:28'),
(24, 1, 1, 'made another commit for event log, it''s done now. 63% to collaborate-0.3!', '2011-10-10 17:50:40'),
(25, 1, 5, 'created the project', '2011-10-10 20:03:36'),
(26, 1, 1, 'now you can add your own projects!', '2011-10-10 20:09:52'),
(27, 1, 1, 'added a favicon', '2011-10-10 20:38:14'),
(28, 1, 1, 'working on finance integration, starting with funding requests', '2011-10-11 01:53:46');

-- --------------------------------------------------------

--
-- Table structure for table `todolist`
--

CREATE TABLE IF NOT EXISTS `todolist` (
  `todolist_id` int(11) NOT NULL AUTO_INCREMENT,
  `todolist_project_id` int(11) NOT NULL,
  `todolist_milestone_id` int(11) NOT NULL,
  `todolist_text` text NOT NULL,
  `todolist_user_id` int(11) NOT NULL,
  `todolist_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `todolist_completed` timestamp NULL DEFAULT NULL,
  `todolist_status` tinyint(1) NOT NULL,
  PRIMARY KEY (`todolist_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=51 ;

--
-- Dumping data for table `todolist`
--

INSERT INTO `todolist` (`todolist_id`, `todolist_project_id`, `todolist_milestone_id`, `todolist_text`, `todolist_user_id`, `todolist_created`, `todolist_completed`, `todolist_status`) VALUES
(1, 1, 1, 'do twelve push ups', 2, '2011-10-07 02:13:04', '0000-00-00 00:00:00', 0),
(5, 0, 1, 'perform the canonical procedure', 1, '2011-10-07 02:13:06', NULL, 0),
(6, 0, 1, 'make the new PCB design', 0, '2011-10-04 05:42:11', NULL, 0),
(7, 0, 2, 'do a dance', 0, '2011-10-06 02:44:54', NULL, 0),
(8, 0, 7, 'throw a party', 0, '2011-10-07 02:12:57', NULL, 0),
(9, 0, 7, 'fill up helium balloons', 0, '2011-10-04 05:55:42', NULL, 0),
(10, 0, 8, 'code the user actions log', 1, '2011-10-10 17:43:45', NULL, 1),
(11, 0, 8, 'finish up to-do list (task completion, deletion)', 1, '2011-10-09 23:30:48', NULL, 1),
(16, 0, 8, 'create project completion percentage', 1, '2011-10-10 02:55:31', NULL, 1),
(17, 0, 8, 'code milestone deletion', 1, '2011-10-09 20:45:18', NULL, 1),
(18, 0, 8, 'code new project form', 1, '2011-10-10 20:09:40', NULL, 1),
(32, 0, 14, 'link the public page profiles with user data', 0, '2011-10-09 23:32:21', NULL, 0),
(40, 0, 8, 'code a user dashboard page', 1, '2011-10-10 19:02:20', NULL, 1),
(22, 0, 9, 'monkey and dog', 0, '2011-10-09 20:41:42', NULL, 0),
(23, 0, 8, 'allow people to add themselves to projects', 1, '2011-10-09 22:06:48', NULL, 1),
(24, 0, 8, 'convert the text in todolist to copy source', 1, '2011-10-10 21:15:53', NULL, 1),
(25, 0, 10, 'throw a par-tay', 0, '2011-10-09 22:53:46', NULL, 1),
(26, 0, 11, 'trip y''all up', 0, '2011-10-09 22:54:42', NULL, 1),
(27, 0, 12, 'make public home page', 0, '2011-10-10 02:47:55', NULL, 1),
(28, 0, 12, 'make basic login functionality', 0, '2011-10-09 23:29:05', NULL, 1),
(29, 0, 12, 'code people, projects overview pages', 0, '2011-10-09 23:29:05', NULL, 1),
(33, 0, 13, 'create finances db backend', 1, '2011-10-11 01:43:50', NULL, 0),
(46, 0, 13, 'design the finances db backend', 0, '2011-10-11 01:43:51', NULL, 1),
(34, 0, 13, 'create finance overview pages', 0, '2011-10-09 23:58:27', NULL, 0),
(39, 0, 14, 'should make automatic gantt charts', 0, '2011-10-10 17:46:56', NULL, 0),
(41, 0, 18, 'collect some nuts', 0, '2011-10-10 19:58:48', NULL, 0),
(42, 0, 18, 'collect some seeds and stuff', 0, '2011-10-10 20:02:02', NULL, 1),
(43, 0, 19, 'hide those nuts and stuff underground', 0, '2011-10-10 20:00:08', NULL, 0),
(44, 0, 19, 'find a good hibernation spot', 0, '2011-10-10 20:00:20', NULL, 0),
(45, 0, 20, 'hibernate', 0, '2011-10-10 20:01:58', NULL, 0),
(47, 0, 13, 'create project-finances page', 1, '2011-10-11 01:44:22', NULL, 0),
(48, 0, 13, 'create a page for new funding requests', 1, '2011-10-11 01:44:43', NULL, 0),
(49, 0, 13, 'create an "add user" script', 1, '2011-10-11 01:52:14', NULL, 0),
(50, 0, 13, 'update project creation to include project account creation', 1, '2011-10-11 01:53:01', NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `todolistmilestone`
--

CREATE TABLE IF NOT EXISTS `todolistmilestone` (
  `todolistmilestone_id` int(11) NOT NULL AUTO_INCREMENT,
  `todolistmilestone_name` varchar(50) NOT NULL,
  `todolistmilestone_order` int(11) NOT NULL,
  `todolistmilestone_project_id` int(11) NOT NULL,
  PRIMARY KEY (`todolistmilestone_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=21 ;

--
-- Dumping data for table `todolistmilestone`
--

INSERT INTO `todolistmilestone` (`todolistmilestone_id`, `todolistmilestone_name`, `todolistmilestone_order`, `todolistmilestone_project_id`) VALUES
(12, 'collaborate-0.1', 0, 1),
(13, 'collaborate-0.3', 2, 1),
(8, 'collaborate-0.2', 1, 1),
(14, 'collaborate-0.4', 3, 1),
(18, 'OFM-0.1 aka Flying Squirrel', 1, 5),
(19, 'OFM-0.2 aka Daybreak Opossom', 2, 5),
(20, 'OFM-0.3 aka Sleeping Ferret', 3, 5);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(20) NOT NULL AUTO_INCREMENT,
  `user_pass` varchar(32) NOT NULL,
  `user_name` varchar(20) NOT NULL,
  `user_realname` varchar(50) NOT NULL,
  `user_photo` blob NOT NULL,
  `user_creationdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_pass`, `user_name`, `user_realname`, `user_photo`, `user_creationdate`) VALUES
(1, 'a8ca5ae673869069d6f13ab314eb5678', 'colin', 'Colin Merkel', '', '2011-10-02 04:00:00'),
(2, 'f11cf2fe6f2d6a34357c0408f3736567', 'matt', 'Matt Bechberger', '', '2011-10-02 22:58:27');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
