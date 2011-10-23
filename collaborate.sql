-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 23, 2011 at 04:44 AM
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
  `account_type` enum('pocket','project','shareholder','cash') NOT NULL,
  `account_description` text NOT NULL,
  PRIMARY KEY (`account_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=25 ;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`account_id`, `account_owner_id`, `account_type`, `account_description`) VALUES
(1, 1, 'pocket', 'Colin''s pocket'),
(2, 1, 'shareholder', 'Colin''s shareholder account'),
(3, 2, 'pocket', 'Matt''s pocket'),
(7, 2, 'shareholder', 'Matt''s shareholder account'),
(5, 1, 'project', 'The account for project Collaborate'),
(6, 5, 'project', 'The account for Operation Furry Mammal'),
(9, 0, 'cash', 'Income'),
(18, 7, 'shareholder', 'David''s shareholder account'),
(19, 8, 'pocket', 'Patrick''s pocket account'),
(17, 7, 'pocket', 'David''s pocket account'),
(20, 8, 'shareholder', 'Patrick''s shareholder account'),
(21, 9, 'pocket', 'Kyle''s pocket account'),
(22, 9, 'shareholder', 'Kyle''s shareholder account'),
(23, 9, 'project', ''),
(24, 10, 'project', '');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
  `comment_id` int(11) NOT NULL AUTO_INCREMENT,
  `comment_owner` int(11) NOT NULL,
  `comment_context` varchar(20) NOT NULL,
  `comment_text` text NOT NULL,
  `comment_creationdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `comment_deleted` tinyint(1) NOT NULL,
  `comment_replyto` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`comment_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=438 ;

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
(109, 'wrote a new project status update', 1, '2011-10-11 01:53:46', 1, 28),
(110, 'logged in', 1, '2011-10-11 02:18:22', 0, 1),
(111, 'logged in', 2, '2011-10-11 02:35:01', 0, 2),
(112, 'logged out', 2, '2011-10-11 02:35:49', 0, 0),
(113, 'logged in', 2, '2011-10-11 02:35:54', 0, 2),
(114, 'uncompleted a task', 2, '2011-10-11 02:38:38', 1, 40),
(115, 'completed a task', 2, '2011-10-11 02:38:39', 1, 40),
(116, 'created a new task', 2, '2011-10-11 02:39:04', 1, 51),
(117, 're-ordered some milestones', 2, '2011-10-11 02:39:32', 1, 14),
(118, 're-ordered some milestones', 2, '2011-10-11 02:39:36', 1, 14),
(119, 'logged in', 1, '2011-10-11 03:14:50', 0, 1),
(120, 'deleted a task', 1, '2011-10-11 03:22:06', 0, 51),
(121, 'wrote a new project status update', 1, '2011-10-11 03:43:51', 1, 29),
(122, 're-ordered some milestones', 1, '2011-10-11 03:44:38', 1, 13),
(123, 're-ordered some milestones', 1, '2011-10-11 03:44:40', 1, 14),
(124, 'created a project', 1, '2011-10-11 03:46:42', 7, 7),
(125, 'completed a task', 1, '2011-10-11 03:47:32', 1, 50),
(126, 'completed a task', 1, '2011-10-11 03:47:52', 1, 48),
(127, 'created a new task', 1, '2011-10-11 03:48:06', 1, 52),
(128, 'logged in', 1, '2011-10-12 00:54:37', 0, 1),
(129, 'wrote a new project status update', 1, '2011-10-12 00:55:58', 1, 30),
(130, 'logged out', 1, '2011-10-12 00:56:46', 0, 0),
(131, 'logged in', 1, '2011-10-12 22:43:54', 0, 1),
(132, 'completed a task', 1, '2011-10-12 23:02:52', 1, 33),
(133, 'logged in', 1, '2011-10-12 23:36:14', 0, 1),
(134, 'completed a task', 1, '2011-10-13 00:05:58', 5, 41),
(135, 'completed a task', 1, '2011-10-13 00:06:08', 5, 43),
(136, 'logged in', 1, '2011-10-13 01:05:12', 0, 1),
(137, 'logged in', 1, '2011-10-13 01:49:12', 0, 1),
(138, 'logged in', 1, '2011-10-13 02:45:33', 0, 1),
(139, 'logged in', 2, '2011-10-13 03:26:20', 0, 2),
(140, 'logged out', 2, '2011-10-13 03:26:50', 0, 0),
(141, 'logged in', 2, '2011-10-13 03:26:58', 0, 2),
(142, 'wrote a new project status update', 1, '2011-10-13 03:43:03', 5, 31),
(143, 'wrote a new project status update', 1, '2011-10-13 03:43:32', 1, 32),
(144, 'funded a project', 1, '2011-10-13 04:53:16', 0, 0),
(145, 'funded a project', 1, '2011-10-13 05:00:01', 0, 5),
(146, 'funded a project', 1, '2011-10-13 05:00:24', 0, 6),
(147, 'funded a project', 1, '2011-10-13 05:01:10', 0, 7),
(148, 'funded a project', 1, '2011-10-13 05:14:04', 0, 0),
(149, 'funded a project', 1, '2011-10-13 05:14:37', 0, 0),
(150, 'funded a project', 1, '2011-10-13 05:17:47', 5, 0),
(151, 'funded a project', 1, '2011-10-13 05:19:00', 5, 9),
(152, 'funded a project', 1, '2011-10-13 05:19:59', 5, 10),
(153, 'logged out', 1, '2011-10-13 05:27:54', 0, 0),
(154, 'logged in', 2, '2011-10-13 05:27:59', 0, 2),
(155, 'funded a project', 2, '2011-10-13 05:28:16', 5, 0),
(156, 'funded a project', 2, '2011-10-13 05:29:22', 5, 12),
(157, 'logged out', 2, '2011-10-13 05:31:38', 0, 0),
(158, 'logged in', 1, '2011-10-13 05:31:42', 0, 1),
(159, 'completed a task', 1, '2011-10-13 05:32:01', 1, 52),
(160, 'funded a request', 1, '2011-10-13 05:48:43', 5, 14),
(161, 'funded a request from his own pocket', 1, '2011-10-13 05:48:43', 5, 15),
(162, 'funded a request', 1, '2011-10-13 05:50:07', 5, 16),
(163, 'funded a request from his own pocket', 1, '2011-10-13 05:50:07', 5, 17),
(164, 'created a new task', 1, '2011-10-13 05:50:54', 1, 53),
(165, 'wrote a new project status update', 1, '2011-10-13 05:51:25', 1, 33),
(166, 'logged in', 2, '2011-10-13 15:55:55', 0, 2),
(167, 'added themselves as a member', 2, '2011-10-13 15:57:07', 5, 15),
(168, 'logged in', 1, '2011-10-13 15:58:41', 0, 1),
(169, 'funded a project', 2, '2011-10-13 16:01:15', 5, 18),
(170, 'logged in', 1, '2011-10-13 19:16:29', 0, 1),
(171, 'logged in', 1, '2011-10-14 01:33:09', 0, 1),
(172, 'logged in', 1, '2011-10-14 01:33:20', 0, 1),
(173, 'logged in', 1, '2011-10-14 02:21:19', 0, 1),
(174, 'logged out', 1, '2011-10-14 03:50:44', 0, 0),
(175, 'logged in', 2, '2011-10-14 03:50:47', 0, 2),
(176, 'funded a project', 2, '2011-10-14 03:51:11', 5, 19),
(177, 'funded a request', 2, '2011-10-14 03:52:09', 5, 20),
(178, 'funded a request from his own pocket', 2, '2011-10-14 03:52:09', 5, 21),
(179, 'logged out', 2, '2011-10-14 04:17:02', 0, 0),
(180, 'logged in', 1, '2011-10-14 04:17:05', 0, 1),
(181, 'completed a task', 1, '2011-10-14 04:17:46', 1, 53),
(182, 'completed a task', 1, '2011-10-14 04:17:57', 1, 47),
(183, 'created a new task', 1, '2011-10-14 04:18:13', 1, 54),
(184, 'created a new task', 1, '2011-10-14 04:18:42', 1, 55),
(185, 'created a new task', 1, '2011-10-14 04:18:56', 1, 56),
(186, 'logged in', 1, '2011-10-14 12:30:51', 0, 1),
(187, 'logged in', 1, '2011-10-14 13:03:25', 0, 1),
(188, 'logged in', 1, '2011-10-16 17:41:35', 0, 1),
(189, 'logged in', 1, '2011-10-16 19:57:39', 0, 1),
(190, 'logged in', 1, '2011-10-16 20:37:39', 0, 1),
(191, 'logged in', 1, '2011-10-16 21:51:50', 0, 1),
(192, 'logged in', 1, '2011-10-17 00:08:51', 0, 1),
(193, 'logged in', 2, '2011-10-17 00:52:44', 0, 2),
(194, 'logged out', 2, '2011-10-17 00:55:40', 0, 0),
(195, 'logged in', 1, '2011-10-17 00:57:53', 0, 1),
(196, 'logged in', 1, '2011-10-17 02:04:08', 0, 1),
(197, 'logged in', 1, '2011-10-17 02:04:31', 0, 1),
(198, 'wrote a new project status update', 1, '2011-10-17 02:45:00', 1, 34),
(199, 'logged in', 1, '2011-10-17 04:02:31', 0, 1),
(200, 'logged out', 1, '2011-10-17 04:03:10', 0, 0),
(201, 'funded a request', 1, '2011-10-17 04:36:38', 5, 36),
(202, 'funded a request from his own pocket', 1, '2011-10-17 04:36:38', 5, 37),
(203, 'funded a request', 1, '2011-10-17 04:40:46', 5, 39),
(204, 'funded a request from his own pocket', 1, '2011-10-17 04:40:46', 5, 40),
(205, 'funded a request', 1, '2011-10-17 05:14:19', 5, 62),
(206, 'funded a request from his own pocket', 1, '2011-10-17 05:14:19', 5, 63),
(207, 'wrote a new project status update', 1, '2011-10-17 05:16:49', 1, 35),
(208, 'completed a task', 1, '2011-10-17 05:16:57', 1, 54),
(209, 'completed a task', 1, '2011-10-17 05:16:57', 1, 55),
(210, 'logged in', 1, '2011-10-17 13:13:12', 0, 1),
(211, 'funded a request', 1, '2011-10-17 13:13:55', 5, 68),
(212, 'funded a request from his own pocket', 1, '2011-10-17 13:13:55', 5, 69),
(213, 'logged out', 1, '2011-10-17 13:14:17', 0, 0),
(214, 'logged in', 2, '2011-10-17 13:14:21', 0, 2),
(215, 'funded a request', 2, '2011-10-17 13:14:52', 5, 70),
(216, 'funded a request from his own pocket', 2, '2011-10-17 13:14:52', 5, 71),
(217, 'logged in', 2, '2011-10-17 13:19:24', 0, 2),
(218, 'funded a request', 2, '2011-10-17 13:23:22', 5, 72),
(219, 'funded a request from his own pocket', 2, '2011-10-17 13:23:22', 5, 73),
(220, 'funded a request', 2, '2011-10-17 13:32:29', 5, 74),
(221, 'funded a request from his own pocket', 2, '2011-10-17 13:32:29', 5, 75),
(222, 'logged in', 1, '2011-10-17 14:05:05', 0, 1),
(223, 'logged in', 1, '2011-10-17 20:48:12', 0, 1),
(224, 'logged in', 1, '2011-10-18 03:10:07', 0, 1),
(225, 'funded a request', 1, '2011-10-18 03:17:35', 5, 84),
(226, 'funded a request from his own pocket', 1, '2011-10-18 03:17:35', 5, 85),
(227, 'logged out', 1, '2011-10-18 03:17:54', 0, 0),
(228, 'logged in', 2, '2011-10-18 03:17:58', 0, 2),
(229, 'funded a request', 2, '2011-10-18 03:18:21', 5, 86),
(230, 'funded a request from his own pocket', 2, '2011-10-18 03:18:21', 5, 87),
(231, 'logged out', 2, '2011-10-18 03:25:26', 0, 0),
(232, 'logged in', 1, '2011-10-18 03:25:32', 0, 1),
(233, 'logged in', 1, '2011-10-18 03:25:35', 0, 1),
(234, 'funded a request', 1, '2011-10-18 03:25:57', 5, 97),
(235, 'funded a request from his own pocket', 1, '2011-10-18 03:25:57', 5, 98),
(236, 'funded a request', 1, '2011-10-18 03:40:14', 5, 105),
(237, 'funded a request from his own pocket', 1, '2011-10-18 03:40:14', 5, 106),
(238, 'created a project', 1, '2011-10-18 03:48:58', 8, 8),
(239, 'logged out', 1, '2011-10-18 04:02:28', 0, 0),
(240, 'logged in', 1, '2011-10-18 04:04:59', 0, 1),
(241, 'logged out', 1, '2011-10-18 04:06:37', 0, 0),
(242, 'logged in', 7, '2011-10-18 04:06:43', 0, 7),
(243, 'logged out', 7, '2011-10-18 04:08:17', 0, 0),
(244, 'logged in', 1, '2011-10-18 04:08:20', 0, 1),
(245, 'wrote a new project status update', 1, '2011-10-18 04:34:25', 1, 36),
(246, 'wrote a new project status update', 1, '2011-10-18 04:34:35', 1, 37),
(247, 'wrote a new project status update', 1, '2011-10-18 04:34:41', 1, 38),
(248, 'completed a task', 1, '2011-10-18 04:34:51', 1, 49),
(249, 'created a new task', 1, '2011-10-18 04:35:19', 1, 57),
(250, 'created a new task', 1, '2011-10-18 04:35:40', 1, 58),
(251, 'logged in', 1, '2011-10-18 13:10:48', 0, 1),
(252, 'created a new user', 1, '2011-10-18 13:12:31', 0, 8),
(253, 'created a new user', 1, '2011-10-18 13:12:44', 0, 9),
(254, 'logged in', 8, '2011-10-18 14:29:35', 0, 8),
(255, 'logged out', 8, '2011-10-18 14:31:08', 0, 0),
(256, 'logged in', 1, '2011-10-18 18:12:11', 0, 1),
(257, 'logged out', 1, '2011-10-18 18:12:30', 0, 0),
(258, 'logged in', 7, '2011-10-18 20:22:59', 0, 7),
(259, 'logged in', 7, '2011-10-18 20:49:44', 0, 7),
(260, 'added themselves as a member', 7, '2011-10-18 20:58:28', 5, 17),
(261, 'created a new funding request', 7, '2011-10-18 21:00:17', 5, 20),
(262, 'funded a request', 7, '2011-10-18 21:00:43', 5, 111),
(263, 'funded a request from his own pocket', 7, '2011-10-18 21:00:43', 5, 112),
(264, 'funded a request', 7, '2011-10-18 21:00:57', 5, 113),
(265, 'funded a request from his own pocket', 7, '2011-10-18 21:00:57', 5, 114),
(266, 'funded a request', 7, '2011-10-18 21:01:04', 5, 115),
(267, 'funded a request from his own pocket', 7, '2011-10-18 21:01:04', 5, 116),
(268, 'logged out', 7, '2011-10-18 21:01:35', 0, 0),
(269, 'logged in', 7, '2011-10-18 21:02:35', 0, 7),
(270, 'logged out', 7, '2011-10-18 21:03:18', 0, 0),
(271, 'logged in', 7, '2011-10-18 21:18:15', 0, 7),
(272, 'logged out', 7, '2011-10-18 21:19:59', 0, 0),
(273, 'logged in', 1, '2011-10-18 21:20:40', 0, 1),
(274, 'logged in', 2, '2011-10-18 21:36:57', 0, 2),
(275, 'logged in', 1, '2011-10-18 21:59:43', 0, 1),
(276, 'logged in', 2, '2011-10-18 22:13:57', 0, 2),
(277, 'created a new task', 1, '2011-10-18 22:14:21', 1, 59),
(278, 'logged in', 8, '2011-10-18 22:15:25', 0, 8),
(279, 'created a project', 2, '2011-10-18 22:20:48', 9, 9),
(280, 'wrote a new project status update', 2, '2011-10-18 22:21:30', 9, 39),
(281, 'created a new project milestone', 2, '2011-10-18 22:22:08', 9, 21),
(282, 'logged out', 1, '2011-10-18 22:24:51', 0, 0),
(283, 'created a new task', 2, '2011-10-18 22:26:57', 9, 60),
(284, 'created a new task', 2, '2011-10-18 22:27:29', 9, 61),
(285, 'logged out', 8, '2011-10-18 22:27:37', 0, 0),
(286, 'created a new task', 2, '2011-10-18 22:32:21', 9, 62),
(287, 'created a new task', 2, '2011-10-18 22:33:08', 9, 63),
(288, 'created a new task', 2, '2011-10-18 22:34:07', 9, 64),
(289, 'created a new project milestone', 2, '2011-10-18 22:34:42', 9, 22),
(290, 'created a new task', 2, '2011-10-18 22:35:46', 9, 65),
(291, 'created a new task', 2, '2011-10-18 22:36:24', 9, 66),
(292, 'created a new task', 2, '2011-10-18 22:37:07', 9, 67),
(293, 'created a new task', 2, '2011-10-18 22:37:48', 9, 68),
(294, 'created a new project milestone', 2, '2011-10-18 22:38:10', 9, 23),
(295, 'created a new task', 2, '2011-10-18 22:38:48', 9, 69),
(296, 'created a new task', 2, '2011-10-18 22:39:22', 9, 70),
(297, 'created a new task', 2, '2011-10-18 22:41:25', 9, 71),
(298, 're-ordered some milestones', 2, '2011-10-18 22:41:55', 9, 21),
(299, 're-ordered some milestones', 2, '2011-10-18 22:42:00', 9, 21),
(300, 're-ordered some milestones', 2, '2011-10-18 22:42:06', 9, 23),
(301, 'logged out', 2, '2011-10-18 22:44:03', 0, 0),
(302, 'logged in', 2, '2011-10-18 22:44:34', 0, 2),
(303, 'created a project', 2, '2011-10-18 22:48:29', 10, 10),
(304, 'created a new project milestone', 2, '2011-10-18 22:48:53', 10, 24),
(305, 'created a new task', 2, '2011-10-18 22:49:27', 10, 72),
(306, 'created a new task', 2, '2011-10-18 22:50:55', 10, 73),
(307, 'deleted a task', 2, '2011-10-18 22:51:20', 0, 73),
(308, 'created a new task', 2, '2011-10-18 22:51:57', 10, 74),
(309, 'created a new task', 2, '2011-10-18 22:52:25', 10, 75),
(310, 'created a new project milestone', 2, '2011-10-18 22:52:50', 10, 25),
(311, 'created a new task', 2, '2011-10-18 22:53:32', 10, 76),
(312, 'created a new task', 2, '2011-10-18 22:54:02', 10, 77),
(313, 'created a new task', 2, '2011-10-18 22:54:29', 10, 78),
(314, 'created a new task', 2, '2011-10-18 22:55:21', 10, 79),
(315, 'created a new task', 2, '2011-10-18 23:01:40', 10, 80),
(316, 'created a new task', 2, '2011-10-18 23:02:15', 10, 81),
(317, 'created a new project resource', 2, '2011-10-18 23:04:01', 10, 8),
(318, 'created a new project resource', 2, '2011-10-18 23:04:27', 10, 9),
(319, 'logged in', 1, '2011-10-18 23:49:39', 0, 1),
(320, 'added themselves as a member', 1, '2011-10-18 23:52:27', 9, 20),
(321, 're-ordered some milestones', 1, '2011-10-18 23:52:39', 9, 23),
(322, 'logged in', 1, '2011-10-19 00:02:32', 0, 1),
(323, 'logged in', 2, '2011-10-19 00:10:29', 0, 2),
(324, 'logged in', 7, '2011-10-19 01:08:21', 0, 7),
(325, 'logged out', 7, '2011-10-19 01:12:26', 0, 0),
(326, 'logged in', 2, '2011-10-19 01:49:14', 0, 2),
(327, 'logged in', 1, '2011-10-19 02:43:07', 0, 1),
(328, 'created a new task', 1, '2011-10-19 02:44:35', 1, 82),
(329, 'logged out', 1, '2011-10-19 03:06:07', 0, 0),
(330, 'logged in', 1, '2011-10-19 03:06:10', 0, 1),
(331, 'logged out', 1, '2011-10-19 03:06:23', 0, 0),
(332, 'logged in', 1, '2011-10-19 03:06:26', 0, 1),
(333, 'completed a task', 1, '2011-10-19 03:06:37', 1, 59),
(334, 'created a new funding request', 1, '2011-10-19 03:10:33', 1, 21),
(335, 'funded a request', 1, '2011-10-19 03:10:40', 1, 117),
(336, 'funded a request from his own pocket', 1, '2011-10-19 03:10:40', 1, 118),
(337, 'reported a new income', 1, '2011-10-19 03:11:08', 1, 125),
(338, 'balanced some books', 1, '2011-10-19 03:11:08', 1, 337),
(339, 'reported a new income', 1, '2011-10-19 03:15:20', 1, 132),
(340, 'balanced some books', 1, '2011-10-19 03:15:20', 1, 339),
(341, 'logged out', 1, '2011-10-19 03:20:01', 0, 0),
(342, 'logged in', 7, '2011-10-19 05:04:40', 0, 7),
(343, 'logged in', 2, '2011-10-19 13:29:26', 0, 2),
(344, 'logged in', 1, '2011-10-19 16:31:17', 0, 1),
(345, 'logged out', 1, '2011-10-19 16:33:05', 0, 0),
(346, 'logged in', 1, '2011-10-19 16:34:21', 0, 1),
(347, 'created a new task', 1, '2011-10-19 16:35:49', 1, 83),
(348, 'created a new task', 1, '2011-10-19 16:36:23', 1, 84),
(349, 'created a new task', 1, '2011-10-19 16:38:58', 1, 85),
(350, 'created a new task', 1, '2011-10-19 16:39:28', 1, 86),
(351, 'logged out', 1, '2011-10-19 16:42:00', 0, 0),
(352, 'logged in', 2, '2011-10-19 16:48:31', 0, 2),
(353, 'completed a task', 2, '2011-10-19 16:49:21', 9, 65),
(354, 'uncompleted a task', 2, '2011-10-19 16:49:21', 9, 65),
(355, 'logged out', 2, '2011-10-19 16:50:01', 0, 0),
(356, 'logged in', 2, '2011-10-19 21:21:07', 0, 2),
(357, 'logged out', 2, '2011-10-19 21:23:47', 0, 0),
(358, 'logged in', 1, '2011-10-20 04:44:10', 0, 1),
(359, 'logged out', 1, '2011-10-20 04:46:08', 0, 0),
(360, 'logged in', 7, '2011-10-20 19:55:56', 0, 7),
(361, 'logged out', 7, '2011-10-20 20:00:42', 0, 0),
(362, 'logged in', 1, '2011-10-20 20:35:22', 0, 1),
(363, 'logged in', 1, '2011-10-20 23:20:25', 0, 1),
(364, 'logged in', 2, '2011-10-20 23:21:47', 0, 2),
(365, 'logged out', 1, '2011-10-20 23:21:56', 0, 0),
(366, 'logged in', 1, '2011-10-20 23:25:28', 0, 1),
(367, 'logged in', 1, '2011-10-20 23:44:10', 0, 1),
(368, 'logged out', 1, '2011-10-20 23:44:57', 0, 0),
(369, 'logged in', 1, '2011-10-20 23:45:15', 0, 1),
(370, 'funded a request', 1, '2011-10-20 23:46:42', 5, 133),
(371, 'logged out', 1, '2011-10-21 00:16:43', 0, 0),
(372, 'logged in', 1, '2011-10-21 00:17:57', 0, 1),
(373, 'logged out', 1, '2011-10-21 00:18:01', 0, 0),
(374, 'logged in', 9, '2011-10-21 00:18:06', 0, 9),
(375, 'logged in', 2, '2011-10-21 00:23:50', 0, 2),
(376, 'wrote a new project status update', 2, '2011-10-21 00:24:51', 9, 40),
(377, 'logged out', 9, '2011-10-21 00:24:54', 0, 0),
(378, 'logged in', 8, '2011-10-21 00:25:55', 0, 8),
(379, 'logged out', 8, '2011-10-21 00:25:57', 0, 0),
(380, 'logged in', 1, '2011-10-21 00:26:25', 0, 1),
(381, 'logged in', 1, '2011-10-21 00:30:11', 0, 1),
(382, 'logged in', 2, '2011-10-21 00:49:48', 0, 2),
(383, 'logged in', 8, '2011-10-21 00:56:07', 0, 8),
(384, 'logged out', 1, '2011-10-21 00:56:47', 0, 0),
(385, 'logged in', 7, '2011-10-21 00:58:20', 0, 7),
(386, 'logged in', 9, '2011-10-21 00:58:20', 0, 9),
(387, 'logged in', 9, '2011-10-21 00:58:23', 0, 9),
(388, 'logged out', 9, '2011-10-21 00:58:23', 0, 0),
(389, 'logged in', 1, '2011-10-21 00:58:36', 0, 1),
(390, 'logged in', 1, '2011-10-21 01:00:03', 0, 1),
(391, 'logged out', 7, '2011-10-21 01:02:43', 0, 0),
(392, 'logged out', 1, '2011-10-21 01:05:06', 0, 0),
(393, 'logged in', 1, '2011-10-21 01:05:13', 0, 1),
(394, 'logged out', 2, '2011-10-21 01:10:48', 0, 0),
(395, 'logged in', 2, '2011-10-21 01:13:44', 0, 2),
(396, 'logged in', 8, '2011-10-21 01:23:53', 0, 8),
(397, 'logged out', 8, '2011-10-21 01:30:47', 0, 0),
(398, 'logged in', 1, '2011-10-21 01:31:21', 0, 1),
(399, 'logged in', 8, '2011-10-21 01:31:54', 0, 8),
(400, 'logged out', 8, '2011-10-21 01:32:23', 0, 0),
(401, 'logged out', 1, '2011-10-21 01:34:36', 0, 0),
(402, 'logged in', 1, '2011-10-21 01:37:28', 0, 1),
(403, 'logged out', 1, '2011-10-21 01:39:24', 0, 0),
(404, 'logged in', 7, '2011-10-21 01:39:34', 0, 7),
(405, 'reported a new income', 1, '2011-10-21 01:42:29', 10, 139),
(406, 'balanced some books', 1, '2011-10-21 01:42:29', 10, 405),
(407, 'logged out', 1, '2011-10-21 02:03:33', 0, 0),
(408, 'logged in', 7, '2011-10-21 02:07:24', 0, 7),
(409, 'logged out', 7, '2011-10-21 02:10:05', 0, 0),
(410, 'logged in', 7, '2011-10-21 02:11:40', 0, 7),
(411, 'logged out', 7, '2011-10-21 02:12:23', 0, 0),
(412, 'logged in', 1, '2011-10-21 14:23:29', 0, 1),
(413, 'logged in', 7, '2011-10-21 15:36:28', 0, 7),
(414, 'logged out', 7, '2011-10-21 15:37:15', 0, 0),
(415, 'logged in', 8, '2011-10-21 20:02:52', 0, 8),
(416, 'logged out', 8, '2011-10-21 20:04:25', 0, 0),
(417, 'logged in', 8, '2011-10-21 20:05:05', 0, 8),
(418, 'logged out', 8, '2011-10-21 20:05:43', 0, 0),
(419, 'logged in', 2, '2011-10-21 21:04:01', 0, 2),
(420, 'created a new project resource', 2, '2011-10-21 21:04:52', 9, 10),
(421, 'created a new project resource', 2, '2011-10-21 21:05:27', 10, 11),
(422, 'logged in', 9, '2011-10-22 03:05:02', 0, 9),
(423, 'logged in', 7, '2011-10-22 06:42:28', 0, 7),
(424, 'logged out', 7, '2011-10-22 06:43:37', 0, 0),
(425, 'logged in', 7, '2011-10-22 21:06:54', 0, 7),
(426, 'logged out', 7, '2011-10-22 21:07:00', 0, 0),
(427, 'logged in', 1, '2011-10-23 03:04:13', 0, 1),
(428, 'completed a task', 1, '2011-10-23 04:09:26', 1, 34),
(429, 'completed a task', 1, '2011-10-23 04:09:27', 1, 58),
(430, 'completed a task', 1, '2011-10-23 04:09:28', 1, 85),
(431, 'completed a task', 1, '2011-10-23 04:12:27', 1, 32),
(432, 'completed a task', 1, '2011-10-23 04:12:30', 1, 57),
(433, 'created a new task', 1, '2011-10-23 04:12:42', 1, 87),
(434, 'logged out', 1, '2011-10-23 04:13:15', 0, 0),
(435, 'logged in', 1, '2011-10-23 04:18:38', 0, 1),
(436, 'completed a task', 1, '2011-10-23 04:18:58', 1, 86),
(437, 'wrote a new project status update', 1, '2011-10-23 04:19:27', 1, 41);

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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=22 ;

--
-- Dumping data for table `fundingrequests`
--

INSERT INTO `fundingrequests` (`fundingrequest_id`, `fundingrequest_description`, `fundingrequest_creator_id`, `fundingrequest_value`, `fundingrequest_debtor`, `fundingrequest_creationdate`) VALUES
(21, 'Buying a domain name. I bought 2025-labs.com from 1&1 for 99 cents. Amazing deals!', 1, 0.99, 5, '2011-10-19 03:10:33'),
(20, 'Pillows and blankets', 7, 80.25, 6, '2011-10-18 21:00:17');

-- --------------------------------------------------------

--
-- Table structure for table `ideas`
--

CREATE TABLE IF NOT EXISTS `ideas` (
  `idea_id` int(11) NOT NULL AUTO_INCREMENT,
  `idea_title` varchar(40) NOT NULL,
  `idea_description` text NOT NULL,
  `idea_creator` int(11) NOT NULL,
  `idea_creationdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `idea_approved` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`idea_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `ideas`
--

INSERT INTO `ideas` (`idea_id`, `idea_title`, `idea_description`, `idea_creator`, `idea_creationdate`, `idea_approved`) VALUES
(1, 'Proposal section for Collaborate', 'Someone should create an area in the website where people can submit crazy ideas they had and have discussions about the ideas.', 1, '2011-10-23 03:33:35', 0),
(2, 'Yet another idea', 'I had an idea guys omg', 1, '2011-10-23 04:00:19', 0);

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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=21 ;

--
-- Dumping data for table `projectmemberships`
--

INSERT INTO `projectmemberships` (`projectmembership_id`, `projectmembership_user_id`, `projectmembership_project_id`, `projectmembership_creationdate`, `projectmembership_role`) VALUES
(1, 1, 1, '0000-00-00 00:00:00', 'programmer'),
(9, 2, 1, '2011-10-10 17:13:46', 'observer'),
(13, 1, 6, '2011-10-10 19:47:23', ''),
(12, 1, 5, '2011-10-10 19:45:27', ''),
(14, 1, 7, '2011-10-11 03:46:42', ''),
(15, 2, 5, '2011-10-13 15:57:07', 'Bossman'),
(16, 1, 8, '2011-10-18 03:48:58', ''),
(17, 7, 5, '2011-10-18 20:58:28', 'clicking around'),
(18, 2, 9, '2011-10-18 22:20:48', ''),
(19, 2, 10, '2011-10-18 22:48:29', ''),
(20, 1, 9, '2011-10-18 23:52:27', 'observer');

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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `projectresource`
--

INSERT INTO `projectresource` (`projectresource_id`, `projectresource_project_id`, `projectresource_title`, `projectresource_value`) VALUES
(1, 1, 'GitHub URL', 'https://github.com/colin353/2025-labs'),
(5, 1, 'Best resource', 'http://2025-labs.com'),
(4, 1, 'Datasheets', 'www.google.com'),
(6, 1, 'Test', 'Resource'),
(7, 5, 'My favourite acorn tree', 'http://g.co/maps/trnrs'),
(8, 10, 'Narin_fender''s eBay page for cables', 'http://www.ebay.ca/itm/ws/eBayISAPI.dll?ViewItem&item=120792076478&ssPageName=ADME:L:OU:CA:1123'),
(9, 10, 'Kyle Scheppman', 'http://www.myspace.com/kylescheppman'),
(10, 9, 'Photo album, password is 2025-labs', 'http://photobucket.com/twenty-twenty-five'),
(11, 10, 'Photo album, password is 2025-labs', 'http://photobucket.com/twenty-twenty-five');

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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`project_id`, `project_name`, `project_description`, `project_salespitch`, `project_creationdate`, `project_creator_id`, `project_code`, `project_unique`) VALUES
(1, 'Collaborate', 'Collaborate is the website backend that runs 2025 Labs.', 'I think it would be pretty cool to have a backend website which runs and organizes everything about 2025, so I am creating it.', '2011-10-02 23:47:24', 1, '', 0),
(5, 'Operation Furry Mammal', 'YOU GUYS, this project is TOP SECRET', 'YOU GUYS, this project is TOP SECRET', '2011-10-10 19:57:52', 1, '', 98178734),
(9, 'PIC Debug Module', 'Microcontroller Debugging and Visualization tool.', 'Already done; marketing and future improvements remain.', '2011-10-18 22:20:48', 2, '', 833715350),
(10, 'Guitar Effect Pedal Power Supply', 'Design and potential low volume production of power supplies for Kyle Scheppman, Entrepreneur', 'Brief Rundown:\r\n\r\nReiner and I designed a power supply for guitar effect pedals for Kyle Scheppman, an entrepreneur from Illinois.  Kyle has developed a patent-pending guitar effect pedal board that he wanted to have a matching brand PSU to go with but lacked the electronics knowledge, so he contacted me through Instructables asking if I would be interested.  We have the completed design and produced 3 demo units for him, we are currently waiting on the first order but it is tentatively stated for 35 units.  We do not know what our manufacturing capabilities will be so I am working with Kyle to sort it out.  The main issue is drilling and painting, the soldering is minor and the device is designed so no tight-quarters soldering is required.  This project has earned us some money; we have about $110 USD profit remaining, which will be dispersed amongst employees as starting cashflow, after subtracting for domain name and other expenses in the near future.', '2011-10-18 22:48:29', 2, '', 573125184);

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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=42 ;

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
(28, 1, 1, 'working on finance integration, starting with funding requests', '2011-10-11 01:53:46'),
(29, 1, 1, 'initial funding requests backend complete, need to make forms now', '2011-10-11 03:43:51'),
(30, 1, 1, 'posted from my phone', '2011-10-12 00:55:58'),
(31, 1, 5, 'using this guy for testing', '2011-10-13 03:43:03'),
(32, 1, 1, 'working on responding to funding requests', '2011-10-13 03:43:32'),
(33, 1, 1, 'responding to funding requests works now, with a couple minor bugs. I''m committing', '2011-10-13 05:51:25'),
(34, 1, 1, 'project account balancing! omg', '2011-10-17 02:45:00'),
(35, 1, 1, 'project account balancing done, finances looking sweet', '2011-10-17 05:16:49'),
(36, 1, 1, 'fixed a bug, hopefully accounting works now', '2011-10-18 04:34:25'),
(37, 1, 1, 'greater density of event reporting', '2011-10-18 04:34:35'),
(38, 1, 1, 'user creation done', '2011-10-18 04:34:41'),
(39, 2, 9, 'PCBs ordered on monday, parts for 4x orders being done today', '2011-10-18 22:21:30'),
(40, 2, 9, 'Testing out some laser cut acrylic covers for both sides of the PCBs', '2011-10-21 00:24:51'),
(41, 1, 1, 'finished collaborate-0.3! now on to 0.4...', '2011-10-23 04:19:27');

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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=88 ;

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
(32, 0, 14, 'link the public page profiles with user data', 0, '2011-10-23 04:12:27', NULL, 1),
(40, 0, 8, 'code a user dashboard page', 1, '2011-10-11 02:38:39', NULL, 1),
(22, 0, 9, 'monkey and dog', 0, '2011-10-09 20:41:42', NULL, 0),
(23, 0, 8, 'allow people to add themselves to projects', 1, '2011-10-09 22:06:48', NULL, 1),
(24, 0, 8, 'convert the text in todolist to copy source', 1, '2011-10-10 21:15:53', NULL, 1),
(25, 0, 10, 'throw a par-tay', 0, '2011-10-09 22:53:46', NULL, 1),
(26, 0, 11, 'trip y''all up', 0, '2011-10-09 22:54:42', NULL, 1),
(27, 0, 12, 'make public home page', 0, '2011-10-10 02:47:55', NULL, 1),
(28, 0, 12, 'make basic login functionality', 0, '2011-10-09 23:29:05', NULL, 1),
(29, 0, 12, 'code people, projects overview pages', 0, '2011-10-09 23:29:05', NULL, 1),
(33, 0, 13, 'create finances db backend', 1, '2011-10-12 23:02:52', NULL, 1),
(46, 0, 13, 'design the finances db backend', 0, '2011-10-11 01:43:51', NULL, 1),
(34, 0, 13, 'create finance overview pages', 0, '2011-10-23 04:09:26', NULL, 1),
(39, 0, 14, 'should make automatic gantt charts', 0, '2011-10-10 17:46:56', NULL, 0),
(41, 0, 18, 'collect some nuts', 0, '2011-10-13 00:05:58', NULL, 1),
(42, 0, 18, 'collect some seeds and stuff', 0, '2011-10-10 20:02:02', NULL, 1),
(43, 0, 19, 'hide those nuts and stuff underground', 0, '2011-10-13 00:06:08', NULL, 1),
(44, 0, 19, 'find a good hibernation spot', 0, '2011-10-10 20:00:20', NULL, 0),
(45, 0, 20, 'hibernate', 0, '2011-10-10 20:01:58', NULL, 0),
(47, 0, 13, 'create project-finances page', 1, '2011-10-14 04:17:57', NULL, 1),
(48, 0, 13, 'create a page for new funding requests', 1, '2011-10-11 03:47:52', NULL, 1),
(49, 0, 13, 'create an "add user" script', 1, '2011-10-18 04:34:51', NULL, 1),
(50, 0, 13, 'update project creation to include project account creation', 1, '2011-10-11 03:47:32', NULL, 1),
(52, 0, 13, 'allow responding to a funding request', 1, '2011-10-13 05:32:01', NULL, 1),
(53, 0, 13, 'when funded out of pocket, funding requests do not register the funds', 1, '2011-10-14 04:17:46', NULL, 1),
(54, 0, 13, 'create "report project income"', 1, '2011-10-17 05:16:57', NULL, 1),
(55, 0, 13, 'write the account balance calculator for projects', 1, '2011-10-17 05:16:57', NULL, 1),
(56, 0, 14, 'integrate paypal', 0, '2011-10-14 04:18:56', NULL, 0),
(57, 0, 14, 'do nice mouse hover css', 0, '2011-10-23 04:12:30', NULL, 1),
(58, 0, 13, 'write some nice general accounting functions', 1, '2011-10-23 04:09:27', NULL, 1),
(59, 0, 13, 'write password changing into the user profile', 1, '2011-10-19 03:06:37', NULL, 1),
(60, 0, 21, 'Meet with faculty Paul Kemp and Tom King to discuss how many demo units they would like', 2, '2011-10-18 22:26:57', NULL, 0),
(61, 0, 21, 'get the order', 2, '2011-10-18 22:27:29', NULL, 0),
(62, 0, 21, 'receive his personal order and assemble, write assembly documents and photograph', 2, '2011-10-18 22:32:21', NULL, 0),
(63, 0, 21, 'receive parts for the Sheridan order, prepare parts in bags and deliver', 0, '2011-10-18 22:33:08', NULL, 0),
(64, 0, 21, 'receive the payment of 100% markup and pay debts, disperse profit to company', 2, '2011-10-18 22:34:07', NULL, 0),
(65, 0, 22, 'Think up new ideas and improvements for the device', 0, '2011-10-19 16:49:21', NULL, 0),
(66, 0, 22, 'Develop Rev 2.0 schematic and PCB, do simulations', 0, '2011-10-18 22:36:24', NULL, 0),
(67, 0, 22, 'Approve Rev 2.0, begin production of prototype units', 2, '2011-10-18 22:37:07', NULL, 0),
(68, 0, 22, 'Assemble new prototypes, write documentation for assembly and use', 0, '2011-10-18 22:37:48', NULL, 0),
(69, 0, 23, 'look for avenues to market device through', 0, '2011-10-18 22:38:48', NULL, 0),
(70, 0, 23, 'Tell everyone about the units and show off their personal units to promote sales', 0, '2011-10-18 22:39:22', NULL, 0),
(71, 0, 21, 'Order parts for 4x units for Patrick, Aaron, Mike, Matt', 2, '2011-10-18 22:41:25', NULL, 0),
(72, 0, 24, 'Receive test cables from eBay', 2, '2011-10-18 22:49:27', NULL, 0),
(74, 0, 24, 'Negotiate deal with eBay seller for bulk purchases of cables, with Scheppman''s Approval', 2, '2011-10-18 22:51:57', NULL, 0),
(75, 0, 24, 'Receive or ship direct to Scheppman', 2, '2011-10-18 22:52:25', NULL, 0),
(76, 0, 25, 'Search for ways to do mass production drilling and painting, or outsourcing possibilities', 2, '2011-10-18 22:53:32', NULL, 0),
(77, 0, 25, 'Receive the first order', 2, '2011-10-18 22:54:02', NULL, 0),
(78, 0, 25, 'Drill, paint, solder, assemble units (tentatively 35 units)', 0, '2011-10-18 22:54:29', NULL, 0),
(79, 0, 25, 'package and ship to Scheppman', 0, '2011-10-18 22:55:21', NULL, 0),
(80, 0, 25, 'Look for ways to approve production process and reduce work times', 0, '2011-10-18 23:01:40', NULL, 0),
(81, 0, 25, 'Write documentation on assembly for future use and reference', 0, '2011-10-18 23:02:15', NULL, 0),
(82, 0, 14, 'allow people to delete funding requests', 0, '2011-10-19 02:44:35', NULL, 0),
(83, 0, 14, 'write some sweet-ass generalized visualizations using google charts', 0, '2011-10-19 16:35:49', NULL, 0),
(84, 0, 14, 'change tasks to submit via ajax for faster speeds', 0, '2011-10-19 16:36:23', NULL, 0),
(85, 0, 13, 'sort people by random on people', 1, '2011-10-23 04:09:28', NULL, 1),
(86, 0, 13, 'links go to company email addresses', 0, '2011-10-23 04:18:58', NULL, 1),
(87, 0, 14, 'write a proposals section''', 1, '2011-10-23 04:12:42', NULL, 0);

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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=26 ;

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
(20, 'OFM-0.3 aka Sleeping Ferret', 3, 5),
(21, 'Marketing and Sales - Sheridan College', 1, 9),
(22, 'Future Development', 0, 9),
(23, 'Marketing', 2, 9),
(24, 'Power Supply Cables', 1, 10),
(25, 'Production', 2, 10);

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE IF NOT EXISTS `transactions` (
  `transaction_id` int(11) NOT NULL AUTO_INCREMENT,
  `transaction_debtor` int(11) NOT NULL,
  `transaction_creditor` int(11) NOT NULL,
  `transaction_creationdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `transaction_value` float NOT NULL,
  `transaction_note` text NOT NULL,
  `transaction_fundingrequest_id` int(11) DEFAULT NULL,
  `transaction_code` varchar(32) NOT NULL,
  PRIMARY KEY (`transaction_id`),
  UNIQUE KEY `transaction_code` (`transaction_code`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=140 ;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`transaction_id`, `transaction_debtor`, `transaction_creditor`, `transaction_creationdate`, `transaction_value`, `transaction_note`, `transaction_fundingrequest_id`, `transaction_code`) VALUES
(139, 22, 24, '2011-10-21 01:42:29', 20, 'project generated extra money, have some kickback', NULL, 'fde83e910aa12d8f5bf31e43ee779cb1'),
(137, 18, 24, '2011-10-21 01:42:29', 20, 'project generated extra money, have some kickback', NULL, 'a62b20bc3da93e17f91ea0b16350299f'),
(138, 20, 24, '2011-10-21 01:42:29', 20, 'project generated extra money, have some kickback', NULL, 'ae1f15197952ed7146f3ca7dc46ec7e3'),
(136, 7, 24, '2011-10-21 01:42:29', 20, 'project generated extra money, have some kickback', NULL, '5acea1607bfd96291d415f23bcd7c20f'),
(135, 2, 24, '2011-10-21 01:42:29', 20, 'project generated extra money, have some kickback', NULL, '91995ec91b046b6dd6633e81e0b8ea0e'),
(134, 24, 9, '2011-10-21 01:42:29', 100, 'Money embezzled from Bergerschmidt.', NULL, '2a34b26a2d0f8713aa801a71301faa01'),
(132, 22, 5, '2011-10-19 03:15:20', 0.402, 'project generated extra money, have some kickback', NULL, '929520a7bfe288840dc9d85254426011'),
(133, 6, 2, '2011-10-20 23:46:42', 0.402, 'funding a funding request', 20, 'eef4d6e406bf1583f9dcecce24a05c7f'),
(131, 20, 5, '2011-10-19 03:15:20', 0.402, 'project generated extra money, have some kickback', NULL, 'cb0c0a58a4f5235b558bf4409865cfd5'),
(130, 18, 5, '2011-10-19 03:15:20', 0.402, 'project generated extra money, have some kickback', NULL, 'e37302821c35be6527dd7b9b492e5ab5'),
(129, 7, 5, '2011-10-19 03:15:20', 0.402, 'project generated extra money, have some kickback', NULL, '54467af8c60326dea0e528e03ed6d642'),
(128, 2, 5, '2011-10-19 03:15:20', 0.402, 'project generated extra money, have some kickback', NULL, '6436cce00a7cd0046663fe66e6fda9ca'),
(127, 1, 5, '2011-10-19 03:15:20', 0.99, 'project paying off debts owed to members', NULL, '85631abb307c41a0e20157dd179233a1'),
(126, 5, 9, '2011-10-19 03:15:20', 3, 'income best', NULL, '7473cf21a29c2567ae83aa4c41769ed8'),
(117, 5, 2, '2011-10-19 03:10:40', 0, 'funding a funding request', 21, '594de55cf4c84fa786c6aeeae65b1833'),
(118, 5, 1, '2011-10-19 03:10:40', 0.99, 'funding a funding request', 21, '885845d5a0d72ed7d12eebd4e09c0598');

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
  `user_publicdesc` text NOT NULL,
  `user_email` varchar(80) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_pass`, `user_name`, `user_realname`, `user_photo`, `user_creationdate`, `user_publicdesc`, `user_email`) VALUES
(1, 'a8ca5ae673869069d6f13ab314eb5678', 'colin', 'Colin Merkel', '', '2011-10-02 04:00:00', 'Computer programmer, electronics designer, undergraduate candidate in Engineering Science at the University of Toronto, majoring in Engineering Physics', 'colin.merkel@2025-labs.com'),
(2, 'da70006beb3ae007f60eb38330dc869c', 'matt', 'Matt Bechberger', '', '2011-10-02 22:58:27', 'Certified Technologist, Hardware Designer, Expert Fabricator', 'matt.bechberger@2025-labs.com'),
(8, 'b43fa627462319df49b6242272910bc9', 'patrick', 'Patrick Moreau', '', '2011-10-18 13:12:31', 'Electronic Engineer interested in Programming, Automation, Solution Design & Development. I enjoy solving problems, big and small, and long walks on the beach.\r\n\r\n', 'patrick.moreau@2025-labs.com'),
(9, 'efd7ba94da1100cec2b4d526ac093eb0', 'kyle', 'Kyle Rodrigues', '', '2011-10-18 13:12:44', '', 'kyle.rodrigues@2025-labs.com'),
(7, '8f2c9a6ec8498ea94815c62acd45baaf', 'david', 'David Bell', '', '2011-10-18 04:05:46', 'Programmer, Sound & Lighting Tech, Musician, happy while soldering. My grandfather always tells me "You can learn something from any damn fool".', 'david.bell@2025-labs.com');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
