-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 20, 2019 at 07:48 PM
-- Server version: 10.1.31-MariaDB
-- PHP Version: 5.6.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mindgigs_fleek`
--

-- --------------------------------------------------------

--
-- Table structure for table `discussion`
--

CREATE TABLE `discussion` (
  `chatID` int(15) NOT NULL,
  `poiID` int(15) NOT NULL,
  `userID` int(15) NOT NULL,
  `userType` varchar(222) DEFAULT NULL,
  `discussion` text NOT NULL,
  `dateTime` datetime NOT NULL,
  `status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `event_categories`
--

CREATE TABLE `event_categories` (
  `event_category_id` int(22) NOT NULL,
  `category` varchar(255) NOT NULL,
  `event_type_id` int(22) DEFAULT NULL,
  `status` int(22) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `event_categories`
--

INSERT INTO `event_categories` (`event_category_id`, `category`, `event_type_id`, `status`) VALUES
(1, 'Running', 1, NULL),
(3, 'Social', 2, NULL),
(4, 'Drinking', 3, NULL),
(7, 'Golf', 2, NULL),
(8, 'Cricket', 2, NULL),
(9, 'Soccer', 1, NULL),
(10, 'Football', 1, NULL),
(11, 'Baseball', 1, NULL),
(12, 'Eating', 3, NULL),
(13, 'Video Games', 1, NULL),
(14, 'Hockey', 1, NULL),
(15, 'Basketball', 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `event_images`
--

CREATE TABLE `event_images` (
  `image_id` int(11) NOT NULL,
  `poiID` int(12) DEFAULT NULL,
  `path` varchar(255) DEFAULT NULL,
  `userID` int(12) DEFAULT NULL,
  `status` int(12) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `event_images`
--

INSERT INTO `event_images` (`image_id`, `poiID`, `path`, `userID`, `status`) VALUES
(11, 645, '/uploads/1aef0bf3.png', 48, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `event_notifications`
--

CREATE TABLE `event_notifications` (
  `notificationID` int(14) NOT NULL,
  `poiID` int(14) NOT NULL,
  `message` text,
  `notificationType` varchar(255) DEFAULT NULL,
  `type` varchar(255) DEFAULT 'unread',
  `userType` varchar(225) DEFAULT 'guest',
  `user_id` int(22) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `status` int(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `event_notifications`
--

INSERT INTO `event_notifications` (`notificationID`, `poiID`, `message`, `notificationType`, `type`, `userType`, `user_id`, `created_at`, `status`) VALUES
(97, 657, 'You have been removed from the event \'dd\'\'', 'Removed From Event', 'unread', 'guest', NULL, '2017-02-09 07:04:37', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `event_types`
--

CREATE TABLE `event_types` (
  `event_type_id` int(22) NOT NULL,
  `type` varchar(255) NOT NULL,
  `status` int(22) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `event_types`
--

INSERT INTO `event_types` (`event_type_id`, `type`, `status`) VALUES
(1, 'Athletics', NULL),
(2, 'Social', NULL),
(3, 'Other', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `friends`
--

CREATE TABLE `friends` (
  `friend_id` int(22) NOT NULL,
  `host_id` int(22) NOT NULL,
  `guest_id` int(22) NOT NULL,
  `friend_accepted` varchar(244) DEFAULT 'no',
  `status` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `friends`
--

INSERT INTO `friends` (`friend_id`, `host_id`, `guest_id`, `friend_accepted`, `status`) VALUES
(104, 44, 21, 'no', NULL),
(105, 44, 21, 'no', NULL),
(106, 44, 21, 'no', NULL),
(107, 44, 21, 'no', NULL),
(108, 44, 21, 'no', NULL),
(109, 44, 21, 'no', NULL),
(110, 44, 21, 'no', NULL),
(111, 44, 21, 'no', NULL),
(112, 44, 21, 'no', NULL),
(113, 44, 21, 'no', NULL),
(114, 43, 21, 'no', NULL),
(115, 43, 21, 'no', NULL),
(116, 43, 21, 'no', NULL),
(117, 43, 21, 'no', NULL),
(118, 43, 21, 'no', NULL),
(119, 43, 21, 'no', NULL),
(120, 43, 21, 'no', NULL),
(121, 24, 21, 'no', NULL),
(173, 43, 48, 'no', NULL),
(206, 48, 21, 'yes', NULL),
(207, 21, 48, 'yes', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `host_notifications`
--

CREATE TABLE `host_notifications` (
  `hostNotificationID` int(14) NOT NULL,
  `message` text,
  `hostID` int(22) DEFAULT NULL,
  `userID` int(12) DEFAULT NULL,
  `notificationType` varchar(255) NOT NULL,
  `type` varchar(255) DEFAULT 'unread',
  `poiID` int(22) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `status` int(12) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `host_notifications`
--

INSERT INTO `host_notifications` (`hostNotificationID`, `message`, `hostID`, `userID`, `notificationType`, `type`, `poiID`, `created_at`, `status`) VALUES
(325, 'test test Invited you for <a href=\"/joinEvent/657\">dd</a> Event\n                    <br />\n                        <div id=\"657\" class=\"btn btn-primary btn-small\" title=\"$obj->title\">Accept</div>\n                        <div id=\"657\" class=\"btn btn-warning  btn-small\">Reject</div>', 21, 21, 'Event Invitation', 'notread', 657, '2017-02-09 07:11:36', NULL),
(326, 'test test Invited you for <a href=\"/joinEvent/657\">dd</a> Event\n                    <br />\n                        <div id=\"657\" class=\"btn btn-primary btn-small\" title=\"$obj->title\">Accept</div>\n                        <div id=\"657\" class=\"btn btn-warning  btn-small\">Reject</div>', 21, 21, 'Event Invitation', 'notread', 657, '2017-02-09 07:12:24', NULL),
(327, 'test test Invited you for <a href=\"/joinEvent/657\">dd</a> Event\n                    <br />\n                        <div id=\"657\" class=\"btn btn-primary btn-small\" title=\"$obj->title\">Accept</div>\n                        <div id=\"657\" class=\"btn btn-warning  btn-small\">Reject</div>', 21, 21, 'Event Invitation', 'notread', 657, '2017-02-09 07:12:38', NULL),
(328, 'haq nawaz Invited you for <a href=\"/joinEvent/644\">Cricket</a> Event\n                    <br />\n                        <div id=\"644\" class=\"btn btn-primary btn-small\" title=\"$obj->title\">Accept</div>\n                        <div id=\"644\" class=\"btn btn-warning  btn-small\">Reject</div>', 48, 48, 'Event Invitation', 'read', 644, '2017-02-09 07:14:29', NULL),
(329, 'test test Invited you for <a href=\"/joinEvent/657\">dd</a> Event\n                    <br />\n                        <div id=\"657\" class=\"btn btn-primary btn-small\" title=\"$obj->title\">Accept</div>\n                        <div id=\"657\" class=\"btn btn-warning  btn-small\">Reject</div>', 21, 21, 'Event Invitation', 'notread', 657, '2017-02-09 07:24:18', NULL),
(330, 'test test Invited you for <a href=\"/joinEvent/657\">dd</a> Event\n                    <br />\n                        <div id=\"657\" class=\"btn btn-primary btn-small\" title=\"$obj->title\">Accept</div>\n                        <div id=\"657\" class=\"btn btn-warning  btn-small\">Reject</div>', 21, 21, 'Event Invitation', 'unread', 657, '2017-02-09 07:24:35', NULL),
(331, 'test test Invited you for <a href=\"/joinEvent/657\">dd</a> Event\n                    <br />\n                        <div id=\"657\" class=\"btn btn-primary btn-small\" title=\"$obj->title\">Accept</div>\n                        <div id=\"657\" class=\"btn btn-warning  btn-small\">Reject</div>', 21, 21, 'Event Invitation', 'read', 657, '2017-02-09 07:26:49', NULL),
(332, 'test test Invited you for <a href=\"/joinEvent/657\">dd</a> Event\n                    <br />\n                        <div id=\"657\" class=\"btn btn-primary btn-small\" title=\"$obj->title\">Accept</div>\n                        <div id=\"657\" class=\"btn btn-warning  btn-small\">Reject</div>', 21, 21, 'Event Invitation', 'unread', 657, '2017-02-09 07:26:51', NULL),
(333, 'test test Invited you for <a href=\"/joinEvent/657\">dd</a> Event\n                    <br />\n                        <div id=\"657\" class=\"btn btn-primary btn-small\" title=\"$obj->title\">Accept</div>\n                        <div id=\"657\" class=\"btn btn-warning  btn-small\">Reject</div>', 21, 21, 'Event Invitation', 'read', 657, '2017-02-09 07:27:00', NULL),
(334, 'test test Invited you for <a href=\"/joinEvent/657\">dd</a> Event\n                    <br />\n                        <div id=\"657\" class=\"btn btn-primary btn-small\" title=\"$obj->title\">Accept</div>\n                        <div id=\"657\" class=\"btn btn-warning  btn-small\">Reject</div>', 21, 21, 'Event Invitation', 'unread', 657, '2017-02-09 07:27:00', NULL),
(335, 'test test Invited you for <a href=\"/joinEvent/657\">dd</a> Event\n                    <br />\n                        <div id=\"657\" class=\"btn btn-primary btn-small\" title=\"$obj->title\">Accept</div>\n                        <div id=\"657\" class=\"btn btn-warning  btn-small\">Reject</div>', 21, 21, 'Event Invitation', 'read', 657, '2017-02-09 07:28:30', NULL),
(336, 'test test Invited you for <a href=\"/joinEvent/657\">dd</a> Event\n                    <br />\n                        <div id=\"657\" class=\"btn btn-primary btn-small\" title=\"$obj->title\">Accept</div>\n                        <div id=\"657\" class=\"btn btn-warning  btn-small\">Reject</div>', 21, 21, 'Event Invitation', 'unread', 657, '2017-02-09 07:29:14', NULL),
(337, 'test test Invited you for <a href=\"/joinEvent/655\">dd</a> Event\n                    <br />\n                        <div id=\"655\" class=\"btn btn-primary btn-small\" title=\"$obj->title\">Accept</div>\n                        <div id=\"655\" class=\"btn btn-warning  btn-small\">Reject</div>', 21, 21, 'Event Invitation', 'unread', 655, '2017-02-09 08:24:55', NULL),
(338, 'test test Invited you for <a href=\"/joinEvent/655\">dd</a> Event\n                    <br />\n                        <div id=\"655\" class=\"btn btn-primary btn-small\" title=\"$obj->title\">Accept</div>\n                        <div id=\"655\" class=\"btn btn-warning  btn-small\">Reject</div>', 21, 21, 'Event Invitation', 'read', 655, '2017-02-09 08:26:02', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `join_event`
--

CREATE TABLE `join_event` (
  `joinEventID` int(11) NOT NULL,
  `poiID` int(14) NOT NULL,
  `user_id` varchar(11) NOT NULL,
  `status` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `join_event`
--

INSERT INTO `join_event` (`joinEventID`, `poiID`, `user_id`, `status`) VALUES
(290, 645, '21', 'join'),
(291, 646, '48', 'join'),
(292, 647, '48', 'join'),
(293, 645, '48', 'join'),
(294, 645, '48', 'join'),
(295, 645, '48', 'join'),
(296, 651, '48', 'join'),
(297, 651, '48', 'join'),
(298, 651, '48', 'join'),
(299, 651, '48', 'join'),
(300, 655, '48', 'join'),
(301, 656, '48', 'join'),
(302, 657, '48', 'join'),
(303, 657, '21', 'suspend');

-- --------------------------------------------------------

--
-- Table structure for table `layer`
--

CREATE TABLE `layer` (
  `layer` varchar(255) NOT NULL,
  `refreshInterval` int(10) DEFAULT '300',
  `refreshDistance` int(10) DEFAULT '100',
  `fullRefresh` tinyint(1) DEFAULT '1',
  `showMessage` varchar(255) DEFAULT NULL,
  `id` int(11) NOT NULL,
  `biwStyle` enum('classic','collapsed') DEFAULT 'classic'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `layer`
--

INSERT INTO `layer` (`layer`, `refreshInterval`, `refreshDistance`, `fullRefresh`, `showMessage`, `id`, `biwStyle`) VALUES
('newlayerl30q', 300, 100, 1, NULL, 1, 'classic');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`migration`, `batch`) VALUES
('2014_10_12_000000_create_users_table', 1),
('2014_10_12_100000_create_password_resets_table', 1),
('2016_08_06_092911_create_buyer_table', 1),
('2016_08_06_092911_create_profiles_table', 1),
('2016_08_06_093135_create_workexp_table', 1),
('2016_08_06_093303_create_education_table', 1),
('2016_08_06_093403_create_volwork_table', 1),
('2016_08_10_025726_create_affiliates_table', 1),
('2016_08_24_132319_create_projposts_table', 1),
('2016_08_24_132449_create_projbids_table', 1),
('2016_08_29_162859_create_blogs_table', 1),
('2016_10_05_051002_create_portfilio_table', 1),
('2016_10_05_051046_create_certificates_table', 1),
('2016_10_06_140449_create_skills_table', 1),
('2016_12_30_144958_create_social_accounts_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('haqnawazwgbm@gmail.com', '5c91a9a11d1ab10c18f011c4f59d239f96ae6c5bc3710e475e9ee344aa46b26b', '2017-10-23 20:20:18');

-- --------------------------------------------------------

--
-- Table structure for table `poi`
--

CREATE TABLE `poi` (
  `id` int(11) NOT NULL,
  `footnote` varchar(150) DEFAULT NULL,
  `title` varchar(150) DEFAULT NULL,
  `lat` decimal(13,10) NOT NULL,
  `lon` decimal(13,10) NOT NULL,
  `imageURL` varchar(255) DEFAULT NULL,
  `eventDescription` varchar(150) DEFAULT NULL,
  `typeOfEvent` varchar(255) DEFAULT NULL,
  `alt` int(10) DEFAULT NULL,
  `location` text,
  `time` time DEFAULT NULL,
  `eventType` varchar(255) DEFAULT NULL,
  `viewType` varchar(255) DEFAULT 'public',
  `noOfAttendees` int(11) DEFAULT '0',
  `noOfParticipant` int(11) DEFAULT '0',
  `team` varchar(255) DEFAULT NULL,
  `address` text,
  `poiType` enum('geo','vision') NOT NULL DEFAULT 'geo',
  `createdDate` datetime DEFAULT NULL,
  `dateTime` datetime DEFAULT NULL,
  `eventPicture` varchar(255) DEFAULT '/img/default.png',
  `finishDate` date DEFAULT NULL,
  `event_category_id` int(22) DEFAULT NULL,
  `status` varchar(255) DEFAULT 'open',
  `layerID` int(11) DEFAULT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `poi`
--

INSERT INTO `poi` (`id`, `footnote`, `title`, `lat`, `lon`, `imageURL`, `eventDescription`, `typeOfEvent`, `alt`, `location`, `time`, `eventType`, `viewType`, `noOfAttendees`, `noOfParticipant`, `team`, `address`, `poiType`, `createdDate`, `dateTime`, `eventPicture`, `finishDate`, `event_category_id`, `status`, `layerID`, `user_id`) VALUES
(525, NULL, 'dd', '49.2846036730', '-123.1321048737', NULL, 'fff', NULL, NULL, '1224 Davie St, Vancouver, BC V6E 1N3, Canada', NULL, '3', '1', 1, NULL, NULL, NULL, 'geo', NULL, '2016-11-24 12:46:00', 'img/default.png', NULL, NULL, 'open', 1, 42),
(526, NULL, 'amr', '49.2869550936', '-123.1189727783', NULL, 'sajkdhjskad', NULL, NULL, '335 Burrard St, Vancouver, BC V6C 0C5, Canada', NULL, '1', 'public', 1, NULL, NULL, NULL, 'geo', NULL, '2016-11-24 12:47:00', 'uploads/2016-11-24-05-47-32-brampton.png', '2017-01-24', NULL, 'open', 1, 43),
(527, NULL, 'amr', '49.2866191832', '-123.1376838684', NULL, 'sajkdhjskad', NULL, NULL, '871 Denman St, Vancouver, BC V6G 2L9, Canada', NULL, '1', '1', 1, NULL, NULL, NULL, 'geo', NULL, '2016-11-24 12:47:00', 'img/default.png', '2017-01-01', NULL, 'close', 1, 43),
(552, NULL, '2v2 basketball', '43.6663815274', '-79.6707916260', NULL, 'ok', NULL, NULL, '1420 Midway Blvd, Mississauga, ON L5T 2S4, Canada', NULL, '4', '1', 4, NULL, NULL, NULL, 'geo', NULL, '2016-11-24 02:21:00', 'uploads/2016-11-24-19-26-07-vulcan.jpg', NULL, NULL, 'open', 1, 44),
(573, NULL, 'Amirski event', '51.5046823116', '-0.0826549530', NULL, '', NULL, NULL, '33, The Shard, 31 St Thomas St, London SE1 9RY, United Kingdom', NULL, '2', '1', 3, NULL, NULL, NULL, 'geo', NULL, '2016-12-02 11:10:00', 'uploads/2016-11-30-08-21-06-Amirski Anzur Webpreneur Academy Profile Picture.jpg', NULL, NULL, 'open', 1, 46),
(574, NULL, 'Cricket', '34.0012649132', '71.5404796600', NULL, '', NULL, NULL, 'Saddar (Cantt) Bazar Saddar Rd, Peshawar, Saddar (Cantt) Bazar Saddar Rd, Peshawar, Pakistan', NULL, '2', '1', 3, NULL, NULL, NULL, 'geo', NULL, '2016-12-26 10:00:00', 'img/default.png', '2017-01-19', NULL, 'close', 1, 21),
(579, NULL, 'dasd', '49.2877948594', '-123.0962276459', NULL, '', NULL, NULL, '1152 Alberni St, Vancouver, BC V6E 1V8, Canada', NULL, '3', '1', 3, 0, NULL, NULL, 'geo', NULL, '2017-01-28 10:00:00', '/img/default.png', '2017-01-16', NULL, 'close', 1, 21),
(585, NULL, 'Cricket', '34.0173801741', '71.5318107605', NULL, '', NULL, NULL, 'Warsak Rd, Peshawar, Pakistan', NULL, '3', '1', 3, 0, NULL, NULL, 'geo', NULL, '2017-01-26 10:00:00', '/img/default.png', '2017-01-19', NULL, 'close', 1, 21),
(587, NULL, 'kkk', '34.0211150629', '71.5359306335', NULL, '', NULL, NULL, 'Peshawar, Pakistan', NULL, 'social', 'public', 3, 0, NULL, NULL, 'geo', NULL, NULL, '/img/default.png', '2017-01-23', NULL, 'close', 1, 21),
(588, NULL, 'kkk', '34.0228223859', '71.5582466125', NULL, '', NULL, NULL, 'Street 2 Shami Rd Peshawar, Street 2 Shami Rd, Peshawar, Pakistan', NULL, 'Athletics', 'public', 8, 0, NULL, NULL, 'geo', NULL, '2017-01-25 10:00:00', '/img/default.png', '2017-01-23', NULL, 'close', 1, 21),
(589, NULL, 'Cricket', '34.0185895847', '71.5329265594', NULL, '', NULL, NULL, 'Peshawar, Pakistan', NULL, 'Athletics', 'private', 0, 0, NULL, NULL, 'geo', NULL, '2017-01-12 10:00:00', '/img/default.png', '2017-01-23', NULL, 'open', 1, 21),
(590, NULL, 'ddd', '34.0209372148', '71.5505218506', NULL, '', NULL, NULL, 'Sher Khan Rd, Peshawar, Pakistan', NULL, 'social', 'public', 4, 0, NULL, NULL, 'geo', NULL, '2017-01-05 10:00:00', '/img/default.png', '2017-01-26', NULL, 'open', 1, 21),
(591, NULL, 'other', '34.0218620209', '71.5579891205', NULL, '', NULL, NULL, 'Street 2 Shami Rd Peshawar, Street 2 Shami Rd, Peshawar, Pakistan', NULL, 'Other', 'public', 0, 0, NULL, NULL, 'geo', NULL, '2017-01-12 10:00:00', '/img/default.png', '2017-01-26', NULL, 'open', 1, 21),
(592, NULL, 'test', '34.0151747341', '71.5335273743', NULL, '', NULL, NULL, 'Warsak Rd, Peshawar, Pakistan', NULL, 'Other', 'public', 0, 0, NULL, NULL, 'geo', NULL, '2017-01-25 10:00:00', '/img/default.png', '2017-01-26', NULL, 'open', 1, 21),
(593, NULL, 'kkk', '34.0274639966', '71.5789318085', NULL, '', NULL, NULL, 'Charsadda Rd S, Peshawar, Khyber Pakhtoonkhwa, Pakistan', NULL, 'Athletics', 'public', 3, 0, NULL, NULL, 'geo', NULL, '2017-01-06 10:00:00', '/img/default.png', '2017-01-30', NULL, 'open', 1, 21),
(595, NULL, 'Peshawar Cantonment, Peshawar, Pakistan', '34.0045024407', '71.5179920197', NULL, '', NULL, NULL, 'Grand Trunk Rd, Peshawar, Pakistan', NULL, 'Athletics', 'public', 3, 0, NULL, NULL, 'geo', NULL, '2017-01-26 10:00:00', '/img/default.png', '2017-01-30', NULL, 'open', 1, 21),
(596, NULL, 'Cricket', '34.0239250137', '71.5279054642', NULL, '', NULL, NULL, 'Warsak Road, Peshawar 25160, Pakistan', NULL, 'Athletics', 'public', 2, 0, NULL, NULL, 'geo', NULL, '2017-01-05 10:00:00', '/img/default.png', '2017-01-30', NULL, 'open', 1, 21),
(597, NULL, 'Peshawar Cantonment, Peshawar, Pakistan', '34.0276240476', '71.6048526764', NULL, '', NULL, NULL, 'Dalazak Rd, Peshawar, Pakistan', NULL, 'social', 'public', 3, 0, NULL, NULL, 'geo', NULL, '2017-01-05 10:00:00', '/img/default.png', '2017-01-30', NULL, 'open', 1, 21),
(604, NULL, 'Cricket', '34.0275529139', '71.5916347504', NULL, '', NULL, NULL, 'Shadab Colony, Dalazak Rd, Peshawar, Pakistan', NULL, 'social', 'public', 3, 0, NULL, NULL, 'geo', NULL, '2017-01-06 10:00:00', '/img/default.png', '2017-01-30', NULL, 'open', 1, 21),
(605, NULL, 'Cricket', '34.0148901570', '71.5781593323', NULL, '', NULL, NULL, 'Grand Trunk Rd, Peshawar, Pakistan', NULL, 'Athletics', 'public', 3, 0, NULL, NULL, 'geo', NULL, '2017-01-28 10:00:00', '/img/default.png', '2017-01-30', NULL, 'open', 1, 21),
(607, NULL, 'Peshawar Cantonment, Peshawar, Pakistan', '34.0225734034', '71.5341711044', NULL, '', NULL, NULL, 'Peshawar, Pakistan', NULL, 'Athletics', 'public', 0, 0, NULL, NULL, 'geo', NULL, '2017-01-25 10:00:00', '/img/default.png', '2017-01-30', NULL, 'open', 1, 21),
(611, NULL, 'Cricket', '34.0016562693', '71.5429687500', NULL, '', NULL, NULL, 'Saddar (Cantt) Bazar Saddar Rd, Peshawar, Saddar (Cantt) Bazar Saddar Rd, Peshawar, Pakistan', NULL, 'Athletics', 'public', 0, 0, NULL, NULL, 'geo', NULL, '2017-02-22 10:00:00', '/img/default.png', '2017-01-30', NULL, 'close', 1, 21),
(618, NULL, 'Cricket', '34.0165976052', '71.6099166870', NULL, '', NULL, NULL, 'Peshawar, Pakistan', NULL, 'social', 'public', 2, 0, NULL, NULL, 'geo', NULL, '2017-01-27 10:00:00', '/img/default.png', '2017-02-03', 3, 'open', 1, 21),
(619, NULL, 'Cricket', '34.0210083541', '71.6243362427', NULL, '', NULL, NULL, 'Peshawar-Rawalpindi Rd, Chughal Pura, Pakistan', NULL, 'Athletics', 'public', 3, 0, NULL, NULL, 'geo', NULL, '2017-01-06 10:00:00', '/img/default.png', '2017-02-03', 7, 'open', 1, 21),
(620, NULL, 'Cricket', '49.2909858393', '-123.1315040588', NULL, '', NULL, NULL, '821 Denman St, Vancouver, BC V6G 2L7, Canada', NULL, 'Athletics', 'public', 5, 0, NULL, NULL, 'geo', NULL, '2017-01-27 10:00:00', '/img/default.png', '2017-02-06', 1, 'open', 1, 48),
(622, NULL, 'Cricket', '34.0125423597', '71.5534400940', NULL, '', NULL, NULL, 'Khyber Rd E, Peshawar, Khyber Pakhtoonkhwa, Pakistan', NULL, 'Other', 'public', 1, 0, NULL, NULL, 'geo', NULL, '2017-01-06 10:00:00', '/img/default.png', '2017-02-08', 3, 'open', 1, 21),
(623, NULL, 'Cricket', '33.9914092624', '71.5491485596', NULL, '', NULL, NULL, 'Gulistan Colony Talab Road Nothia Qadeem, Peshawar 25000, Pakistan', NULL, 'Other', 'public', 1, 0, NULL, NULL, 'geo', NULL, '2017-01-06 10:00:00', '/img/default.png', '2017-02-08', 8, 'open', 1, 21),
(624, NULL, 'Cricket', '34.0126135060', '71.5774726868', NULL, '', NULL, NULL, 'Peshawar, Pakistan', NULL, 'Other', 'public', 1, 0, NULL, NULL, 'geo', NULL, '2017-01-05 10:00:00', '/img/default.png', '2017-02-08', 3, 'open', 1, 21),
(625, NULL, 'Cricket', '34.0027947493', '71.5653705597', NULL, '', NULL, NULL, 'Khyber Pakhtoonkhwa, Namak Mandi Rd, Peshawar, Pakistan', NULL, 'social', 'public', 1, 0, NULL, NULL, 'geo', NULL, '2017-01-14 10:00:00', '/img/default.png', '2017-02-08', 3, 'open', 1, 21),
(626, NULL, 'Cricket', '34.0222177129', '71.5700054169', NULL, '', NULL, NULL, 'Peshawar, Pakistan', NULL, 'Other', 'public', 1, 0, NULL, NULL, 'geo', NULL, '2017-01-26 10:00:00', '/img/default.png', '2017-02-08', 3, 'open', 1, 21),
(627, NULL, 'Cricket', '34.0141075651', '71.5922355652', NULL, '', NULL, NULL, '5 Qamar Abbas Shaheed Rd, Peshawar, Pakistan', NULL, 'Other', 'public', 1, 0, NULL, NULL, 'geo', NULL, '2017-01-17 10:00:00', '/img/default.png', '2017-02-08', 1, 'open', 1, 21),
(628, NULL, 'Cricket', '34.0165976052', '71.6019344330', NULL, '', NULL, NULL, 'Grand Trunk Rd, Peshawar, Pakistan', NULL, 'Other', 'public', 1, 0, NULL, NULL, 'geo', NULL, '2017-01-21 10:00:00', '/img/default.png', '2017-02-08', 4, 'open', 1, 21),
(629, NULL, 'Cricket', '34.0045024407', '71.5571308136', NULL, '', NULL, NULL, 'Kohat Rd, Peshawar, Pakistan', NULL, 'Other', 'public', 1, 0, NULL, NULL, 'geo', NULL, '2017-01-26 10:00:00', '/img/default.png', '2017-02-08', 3, 'open', 1, 21),
(630, NULL, 'dasd', '34.0160284596', '71.5434837341', NULL, '', NULL, NULL, 'Sher Khan Rd, Peshawar, Pakistan', NULL, 'Athletics', 'public', 1, 0, NULL, NULL, 'geo', NULL, '2017-01-07 10:00:00', '/img/default.png', '2017-02-08', 3, 'open', 1, 21),
(631, NULL, 'Cricket', '34.0194432759', '71.5630531311', NULL, '', NULL, NULL, 'Bungalow # 8, Shami Road, Peshawar, Pakistan', NULL, 'social', 'public', 1, 0, NULL, NULL, 'geo', NULL, '2017-02-09 10:00:00', '/img/default.png', '2017-02-14', 4, 'open', 1, 21),
(632, NULL, 'Cricket', '34.0091272659', '71.5809917450', NULL, '', NULL, NULL, 'Circular Rd, Peshawar, Khyber Pakhtoonkhwa, Pakistan', NULL, '1', 'public', 1, 0, NULL, NULL, 'geo', NULL, '2017-02-03 10:00:00', '/img/default.png', '2017-02-16', 9, 'open', 1, 21),
(633, NULL, 'Cricket', '34.0013004911', '71.5430545807', NULL, '', NULL, NULL, 'Saddar (Cantt) Bazar Saddar Rd, Peshawar, Saddar (Cantt) Bazar Saddar Rd, Peshawar, Pakistan', NULL, '1', 'public', 1, 0, NULL, NULL, 'geo', NULL, '2017-02-09 10:00:00', '/img/default.png', '2017-02-16', 9, 'open', 1, 21),
(634, NULL, 'Cricket', '34.0160996030', '71.5721511841', NULL, '', NULL, NULL, 'Peshawar, Pakistan', NULL, '1', 'public', 1, 0, NULL, NULL, 'geo', NULL, '2017-02-16 10:00:00', '/img/default.png', '2017-02-16', 9, 'open', 1, 21),
(635, NULL, 'Cricket', '34.0038620604', '71.5987586975', NULL, '', NULL, NULL, 'Al-Hassan, House no.134, Street no.4, Gulbahar no.2, Block B، Peshawar 25000, Pakistan', NULL, '2', 'public', 1, 0, NULL, NULL, 'geo', NULL, '2017-02-03 10:00:00', '/img/default.png', '2017-02-16', 8, 'open', 1, 21),
(636, NULL, 'Cricket', '34.0121154805', '71.5866565704', NULL, '', NULL, NULL, 'Gulbahar Rd, Peshawar, Pakistan', NULL, '2', 'public', 1, 0, NULL, NULL, 'geo', NULL, '2017-02-02 10:00:00', '/img/default.png', '2017-02-16', 7, 'open', 1, 21),
(637, NULL, 'Cricket', '34.0276951813', '71.5890598297', NULL, '', NULL, NULL, 'Peshawar, Pakistan', NULL, '3', 'public', 1, 0, NULL, NULL, 'geo', NULL, '2017-02-16 10:00:00', '/img/default.png', '2017-02-16', 4, 'open', 1, 21),
(638, NULL, 'Cricket', '34.0216486050', '71.5830516815', NULL, '', NULL, NULL, 'Peshawar, Pakistan', NULL, '2', 'public', 1, 0, NULL, NULL, 'geo', NULL, '2017-02-17 10:00:00', '/img/default.png', '2017-02-16', 7, 'open', 1, 21),
(639, NULL, 'Cricket', '34.0121866272', '71.5803909302', NULL, '', NULL, NULL, 'Grand Trunk Rd, Peshawar, Pakistan', NULL, '2', 'public', 1, 0, NULL, NULL, 'geo', NULL, '2017-02-02 10:00:00', '/img/default.png', '2017-02-16', 7, 'open', 1, 21),
(640, NULL, 'Cricket', '34.0289044449', '71.5777301788', NULL, '', NULL, NULL, 'Charsadda Rd S, Peshawar, Khyber Pakhtoonkhwa, Pakistan', NULL, '2', 'public', 1, 0, NULL, NULL, 'geo', NULL, '2017-02-10 10:00:00', '/img/default.png', '2017-02-16', 7, 'open', 1, 21),
(641, NULL, 'Peshawar Cantonment, Peshawar, Pakistan', '34.0214351886', '71.5516376495', NULL, '', NULL, NULL, 'near garrison park, Shami Road, Peshawar, Pakistan', NULL, '2', 'public', 1, 0, NULL, NULL, 'geo', NULL, '2017-02-16 10:00:00', '/img/default.png', '2017-02-16', 7, 'open', 1, 21),
(642, NULL, 'Cricket', '34.0323898728', '71.5633964539', NULL, '', NULL, NULL, 'Rasheedabad, Peshawar, Khyber Pakhtoonkhwa, Pakistan', NULL, '3', 'public', 1, 0, NULL, NULL, 'geo', NULL, '2017-02-16 10:00:00', '/img/default.png', '2017-02-16', 12, 'open', 1, 21),
(643, NULL, 'Peshawar Cantonment, Peshawar, Pakistan', '34.0195855569', '71.5373897552', NULL, '', NULL, NULL, 'Peshawar, Pakistan', NULL, '2', 'public', 3, 0, NULL, NULL, 'geo', NULL, '2017-02-23 10:00:00', '/img/default.png', '2017-02-16', 3, 'open', 1, 21),
(644, NULL, 'Cricket', '34.0064947040', '71.5876007080', NULL, '', NULL, NULL, 'Gulbahar Rd, Peshawar, Pakistan', NULL, '2', 'public', 3, 0, NULL, NULL, 'geo', NULL, '2017-02-03 10:00:00', '/img/default.png', '2017-02-16', 7, 'open', 1, 21),
(645, NULL, 'test', '49.2857234111', '-123.1248950958', NULL, 'description description description description description description description description ', NULL, NULL, '625 Howe St, Vancouver, BC V6C 2T6, Canada', NULL, '1', 'public', 3, 0, NULL, NULL, 'geo', NULL, '2017-02-24 10:00:00', '/img/default.png', '2017-02-16', 9, 'open', 1, 48),
(646, NULL, 'dd', '34.0254010899', '71.5972137451', NULL, '', NULL, NULL, 'Dalazak Rd, City Town, Peshawar, Khyber Pakhtoonkhwa, Pakistan', NULL, '3', 'public', 1, 0, NULL, NULL, 'geo', NULL, '2017-02-22 10:00:00', '/img/default.png', '2017-02-22', 4, 'open', 1, 48),
(647, NULL, 'dd', '34.0266103861', '71.5976428986', NULL, '', NULL, NULL, 'Dalazak Rd, City Town, Peshawar, Khyber Pakhtoonkhwa, Pakistan', NULL, '3', 'public', 1, 0, NULL, NULL, 'geo', NULL, '2017-02-23 10:00:00', '/img/default.png', '2017-02-22', 4, 'open', 1, 48),
(648, NULL, 'dd', '34.0257567670', '71.6015911102', NULL, '', NULL, NULL, 'Dalazak Rd, Peshawar, Pakistan', NULL, '2', 'public', 1, 0, NULL, NULL, 'geo', NULL, '2017-02-24 10:00:00', '/img/default.png', '2017-02-22', 3, 'open', 1, 48),
(649, NULL, 'dd', '34.0245474586', '71.6021919250', NULL, '', NULL, NULL, 'Dalazak Rd, Peshawar, Pakistan', NULL, '2', 'public', 1, 0, NULL, NULL, 'geo', NULL, '2017-02-23 10:00:00', '/img/default.png', '2017-02-22', 8, 'open', 1, 48),
(650, NULL, 'dd', '34.0244763223', '71.5912914276', NULL, '', NULL, NULL, 'Dalazak Rd, City Town, Peshawar, Khyber Pakhtoonkhwa, Pakistan', NULL, '2', 'public', 1, 0, NULL, NULL, 'geo', NULL, '2017-02-22 10:00:00', '/img/default.png', '2017-02-22', 7, 'open', 1, 48),
(651, NULL, 'dd', '34.0259701726', '71.6030502319', NULL, 'description description description description description description description description  ', NULL, NULL, 'Pakistan', NULL, '2', 'public', 1, 0, NULL, NULL, 'geo', NULL, '2017-02-28 10:00:00', '/img/default.png', '2017-02-22', 3, 'open', 1, 48),
(652, NULL, 'dd', '34.0251876828', '71.6017627716', NULL, '', NULL, NULL, 'Dalazak Rd, Peshawar, Pakistan', NULL, '2', 'public', 1, 0, NULL, NULL, 'geo', NULL, '2017-02-15 10:00:00', '/img/default.png', '2017-02-22', 3, 'open', 1, 48),
(653, NULL, 'dd', '34.0262547125', '71.5965270996', NULL, '', NULL, NULL, 'Dalazak Rd, City Town, Peshawar, Khyber Pakhtoonkhwa, Pakistan', NULL, '2', 'public', 1, 0, NULL, NULL, 'geo', NULL, '2017-02-22 10:00:00', '/img/default.png', '2017-02-22', 3, 'open', 1, 48),
(654, NULL, 'dd', '34.0264681168', '71.6607284546', NULL, '', NULL, NULL, 'Budai Village, Pakistan', NULL, '2', 'public', 1, 0, NULL, NULL, 'geo', NULL, '2017-02-22 10:00:00', '/img/default.png', '2017-02-22', 3, 'open', 1, 48),
(655, NULL, 'dd', '34.0264681168', '71.6607284546', NULL, '', NULL, NULL, 'Dalazak Rd, City Town, Peshawar, Khyber Pakhtoonkhwa, Pakistan', NULL, '2', 'public', 2, 0, NULL, NULL, 'geo', NULL, '2017-02-23 10:00:00', '/img/default.png', '2017-02-22', 3, 'open', 1, 48),
(656, NULL, 'dd', '34.0344348277', '71.5901756287', NULL, '', NULL, NULL, 'Peshawar, Pakistan', NULL, '2', 'public', 1, 0, NULL, NULL, 'geo', NULL, '2017-02-02 10:00:00', '/img/default.png', '2017-02-22', 3, 'open', 1, 48),
(657, NULL, 'dd', '34.0290289269', '71.5973854065', NULL, 'description description description description description description description description description description  ', NULL, NULL, 'Peshawar, Pakistan', NULL, '2', 'public', 11, 0, NULL, NULL, 'geo', NULL, '2017-02-25 10:00:00', '/img/default.png', '2017-02-23', 3, 'open', 1, 48);

-- --------------------------------------------------------

--
-- Table structure for table `rating`
--

CREATE TABLE `rating` (
  `ratingID` int(12) NOT NULL,
  `rating` int(12) DEFAULT NULL,
  `userID` int(12) DEFAULT NULL,
  `poiID` int(12) DEFAULT NULL,
  `status` int(12) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `social_accounts`
--

CREATE TABLE `social_accounts` (
  `user_id` int(11) NOT NULL,
  `provider_user_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `provider` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `social_accounts`
--

INSERT INTO `social_accounts` (`user_id`, `provider_user_id`, `provider`, `created_at`, `updated_at`) VALUES
(57, '764721022016819200', 'TwitterProvider', '2017-01-03 02:33:32', '2017-01-03 02:33:32'),
(58, '385741815107380', 'FacebookProvider', '2017-01-03 03:59:07', '2017-01-03 03:59:07');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `first_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `last_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_picture` varchar(255) COLLATE utf8_unicode_ci DEFAULT 'img/userDefault.jpg',
  `password` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `lat` decimal(13,10) DEFAULT '49.2888110000',
  `lng` decimal(13,10) DEFAULT '-123.1111530000',
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `name`, `email`, `phone`, `user_picture`, `password`, `lat`, `lng`, `remember_token`, `created_at`, `updated_at`) VALUES
(48, 'test', 'test', NULL, 'test2@gmail.com', NULL, 'img/userDefault.jpg', '$2y$10$AjVeUJAJqcB45j1j5VY.o.k5dun8paVan/WAkrjkf0yO0Tv6XqixW', '34.0149748000', '71.5804899000', 'dC7NdUx1wa4PIHjKYxXEY2ipVKDYknLzmUSukHSV5vbSAWyaGerPF4YfwzTH', '2016-12-23 05:05:21', '2017-02-09 08:23:04'),
(44, 'Muneeb', 'Test', NULL, 'muneeb5115@hotmail.com', NULL, '/img/userDefault.jpg', '$2y$10$BKfZybPs10jQZX3GsvYgC.p.ko3b0ms9EjVO7iOGvqfmh.Q4dkLo.', '43.7045903000', '-79.7175736000', NULL, '2016-11-25 01:18:06', '2016-11-25 01:18:06'),
(43, 'Amr', 'Mahmoud', NULL, 'amrmahmoud.am@hotmail.com', NULL, '/img/userDefault.jpg', '$2y$10$RVyAQtiBZTNQmpkJQWnNo.HmSD.X/tLSkyeLg54X1FuteeMKA7R6u', '43.6345577000', '-79.7117932000', '75lWYJB16rh0obKXdfrCUvFcnOpOon2CmpJXTyTBGg8pONuQmSwOgvkI0QLx', '2016-11-24 11:46:29', '2016-11-24 12:02:29'),
(42, 'Afnan', 'Qureshi', NULL, 'afnan_qu@Hotmail.com', NULL, '/img/userDefault.jpg', '$2y$10$iwjeU8Cq9zMtZAmAELwSMONX9tTrT0wH.1jf6DprnUEGNNpbc3Dnu', '43.6980079000', '-79.7063207000', NULL, '2016-11-24 11:46:00', '2016-11-24 11:46:00'),
(41, 'test', 'test', NULL, 'test@gmail.com', NULL, '/img/userDefault.jpg', '$2y$10$Pt0jUINuQPTkqBl0GdbT6OM1nsz4dtqCs1tsN2qEnpHfUo6k20YTm', '49.2888110000', '-123.1111530000', 'aEvODg3j8XhTpX5N4NDR5LHEJCzu7iLSM5SzRPzYpRiw5PXhIHd2D1XxqWLU', '2016-11-12 02:05:51', '2016-12-10 06:37:47'),
(24, 'sadam', 'hussain', NULL, 'sadam@gmail.com', NULL, '/img/userDefault.jpg', '$2y$10$PVtXcJRjvDCBDiXvznNr5.4OiqamGJhKGt21PuPL0KIEAjBv/QKNS', '49.2888110000', '-123.1111530000', 'QseuHXIZ41Y4PDBqALtEckMXGLpByaH4qRh6MM49hpGDDe0Gikjw2c025ykn', '2016-11-07 14:15:07', '2016-11-12 02:03:44'),
(21, 'haq', 'nawaz', NULL, 'haqnawazwgbm@gmail.com', NULL, '/uploads/253c8d5d.jpg', '$2y$10$7psDy2nqIXOeg1nS/wE2n.9CFWWP5VzjS8v2.j59ZuBVCEe93W6e6', '34.0015492000', '71.5448653000', 'SHEkWVAu0UmtI3osomihAWxY6ZayQE3zMhviEGzagDteEz800fnPGdPVBItE', '2016-11-07 13:20:09', '2017-10-23 20:20:05'),
(46, 'Amir', 'Anzur', NULL, 'amir@amiranzur.com', NULL, '/img/userDefault.jpg', '$2y$10$r.zUuxVmXMeb6ZQ7ZHAn.e3.L1QYOJ7v2pRlwYyr/6Y1RtXK44zKC', '49.2888110000', '-123.1111530000', NULL, '2016-11-30 14:18:12', '2016-11-30 14:18:12'),
(47, 'Nasir', 'Khan', NULL, 'monday123@gmail.com', NULL, '/img/userDefault.jpg', '$2y$10$wdt4cA4VZw180H8j3A7NYuK5N5Q1pywmpz9iecSvecSHYWEfJ.L0e', '49.2888110000', '-123.1111530000', NULL, '2016-12-06 16:29:03', '2016-12-06 16:29:03'),
(49, 'Shaif', 'Khan', NULL, 'evening@gmail.com', NULL, 'img/userDefault.jpg', '$2y$10$trg90Gec/XrbjV01SolRDevCaN83.tBGTPaNZdWbAzVHu/xKfTT4C', '34.0015842000', '71.5448808000', NULL, '2016-12-23 19:17:56', '2016-12-23 19:17:56'),
(50, 'zahid', 'hussain', NULL, '7skyzahid@gmail.com', NULL, 'img/userDefault.jpg', '$2y$10$aNEoeagD3BiFBPJS3R0rM.XBPpzJg6fBPnv.Lt/tJMwq1yibvS08q', '49.2888110000', '-123.1111530000', NULL, '2016-12-26 12:56:46', '2016-12-26 12:56:46'),
(51, 'Muhammad ', 'Ali', NULL, 'a.bbuttar@me.com', NULL, 'img/userDefault.jpg', '$2y$10$ANmEJiV9QR0l69Mqr0C37.vLZWqcIdTsS2IsLzhNbwFSWJt13TIza', '49.2888110000', '-123.1111530000', NULL, '2016-12-30 12:12:51', '2016-12-30 12:12:51'),
(57, 'haq', 'nawaz', NULL, NULL, NULL, 'img/userDefault.jpg', NULL, '49.2888110000', '-123.1111530000', 'Trt82WKwoErdeAP3I0EelSDSCxMdiLaQ0JGQoPQCqN4CIGxJTyDIOt3uJ73Y', '2017-01-03 02:33:32', '2017-01-03 04:00:39'),
(58, 'Haqnawaz', 'Khan', NULL, NULL, NULL, 'img/userDefault.jpg', NULL, '49.2888110000', '-123.1111530000', '2CSfhdE5wsVRSNsFCiVeTR5GGBNjJvV0e0tt0Fr5vJID2VRDA5zgVRT0weFy', '2017-01-03 03:59:07', '2017-01-03 04:01:00');

-- --------------------------------------------------------

--
-- Table structure for table `user_activations`
--

CREATE TABLE `user_activations` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_activations`
--

INSERT INTO `user_activations` (`id`, `user_id`, `token`, `created_at`) VALUES
(1, 21, '52b19802e47c89c49965bb307d9bf5a13211ec0537255770a7d6af6e6dd1a020', '2017-10-23 20:02:28');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `discussion`
--
ALTER TABLE `discussion`
  ADD PRIMARY KEY (`chatID`);

--
-- Indexes for table `event_categories`
--
ALTER TABLE `event_categories`
  ADD PRIMARY KEY (`event_category_id`);

--
-- Indexes for table `event_images`
--
ALTER TABLE `event_images`
  ADD PRIMARY KEY (`image_id`);

--
-- Indexes for table `event_notifications`
--
ALTER TABLE `event_notifications`
  ADD PRIMARY KEY (`notificationID`);

--
-- Indexes for table `event_types`
--
ALTER TABLE `event_types`
  ADD PRIMARY KEY (`event_type_id`);

--
-- Indexes for table `friends`
--
ALTER TABLE `friends`
  ADD PRIMARY KEY (`friend_id`);

--
-- Indexes for table `host_notifications`
--
ALTER TABLE `host_notifications`
  ADD PRIMARY KEY (`hostNotificationID`);

--
-- Indexes for table `join_event`
--
ALTER TABLE `join_event`
  ADD PRIMARY KEY (`joinEventID`);

--
-- Indexes for table `layer`
--
ALTER TABLE `layer`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `layer` (`layer`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`),
  ADD KEY `password_resets_token_index` (`token`);

--
-- Indexes for table `poi`
--
ALTER TABLE `poi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `layerID` (`layerID`);

--
-- Indexes for table `rating`
--
ALTER TABLE `rating`
  ADD PRIMARY KEY (`ratingID`);

--
-- Indexes for table `social_accounts`
--
ALTER TABLE `social_accounts`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_phone_unique` (`phone`);

--
-- Indexes for table `user_activations`
--
ALTER TABLE `user_activations`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `discussion`
--
ALTER TABLE `discussion`
  MODIFY `chatID` int(15) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `event_categories`
--
ALTER TABLE `event_categories`
  MODIFY `event_category_id` int(22) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `event_images`
--
ALTER TABLE `event_images`
  MODIFY `image_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `event_notifications`
--
ALTER TABLE `event_notifications`
  MODIFY `notificationID` int(14) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=98;

--
-- AUTO_INCREMENT for table `event_types`
--
ALTER TABLE `event_types`
  MODIFY `event_type_id` int(22) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `friends`
--
ALTER TABLE `friends`
  MODIFY `friend_id` int(22) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=208;

--
-- AUTO_INCREMENT for table `host_notifications`
--
ALTER TABLE `host_notifications`
  MODIFY `hostNotificationID` int(14) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=339;

--
-- AUTO_INCREMENT for table `join_event`
--
ALTER TABLE `join_event`
  MODIFY `joinEventID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=304;

--
-- AUTO_INCREMENT for table `layer`
--
ALTER TABLE `layer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `poi`
--
ALTER TABLE `poi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=658;

--
-- AUTO_INCREMENT for table `rating`
--
ALTER TABLE `rating`
  MODIFY `ratingID` int(12) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `social_accounts`
--
ALTER TABLE `social_accounts`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `user_activations`
--
ALTER TABLE `user_activations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `poi`
--
ALTER TABLE `poi`
  ADD CONSTRAINT `POI_ibfk_8` FOREIGN KEY (`layerID`) REFERENCES `layer` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
