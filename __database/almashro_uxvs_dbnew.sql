-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 10, 2018 at 07:09 AM
-- Server version: 5.7.9
-- PHP Version: 5.6.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `almashro_uxvs_dbnew`
--

-- --------------------------------------------------------

--
-- Table structure for table `advertising`
--

DROP TABLE IF EXISTS `advertising`;
CREATE TABLE IF NOT EXISTS `advertising` (
  `advertis_id` int(255) NOT NULL AUTO_INCREMENT,
  `title` varchar(256) NOT NULL,
  `description` varchar(512) NOT NULL,
  `image` varchar(128) NOT NULL,
  `display` int(1) NOT NULL DEFAULT '1',
  `display_phone` int(1) NOT NULL,
  `creation` datetime NOT NULL,
  `modify` datetime NOT NULL,
  PRIMARY KEY (`advertis_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `gallery`
--

DROP TABLE IF EXISTS `gallery`;
CREATE TABLE IF NOT EXISTS `gallery` (
  `gallery_id` int(255) NOT NULL AUTO_INCREMENT,
  `title` varchar(256) NOT NULL,
  `display` int(1) NOT NULL DEFAULT '1',
  `display_phone` int(1) NOT NULL DEFAULT '0',
  `creation` datetime NOT NULL,
  `modify` datetime DEFAULT NULL,
  PRIMARY KEY (`gallery_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `gallery`
--

INSERT INTO `gallery` (`gallery_id`, `title`, `display`, `display_phone`, `creation`, `modify`) VALUES
(1, 'تجربة', 1, 0, '2017-06-18 01:12:35', NULL),
(2, 'تيست', 1, 0, '2017-06-18 01:28:13', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `gallery_images`
--

DROP TABLE IF EXISTS `gallery_images`;
CREATE TABLE IF NOT EXISTS `gallery_images` (
  `gallery_image_id` int(255) NOT NULL AUTO_INCREMENT,
  `gallery_id` int(255) NOT NULL,
  `title` varchar(256) NOT NULL,
  `image` varchar(128) NOT NULL,
  `display` int(1) NOT NULL DEFAULT '1',
  `display_phone` int(1) NOT NULL DEFAULT '0',
  `creation` datetime NOT NULL,
  `modify` datetime DEFAULT NULL,
  PRIMARY KEY (`gallery_image_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `gallery_images`
--

INSERT INTO `gallery_images` (`gallery_image_id`, `gallery_id`, `title`, `image`, `display`, `display_phone`, `creation`, `modify`) VALUES
(1, 1, 'تسيت', 'images/gallery/119185201743466171497737810.jpg', 1, 0, '2017-06-18 01:16:50', NULL),
(2, 1, 'تيست', 'images/gallery/119185201743466171497737835.jpg', 1, 0, '2017-06-18 01:17:15', NULL),
(3, 2, 'dfdf', 'images/gallery/119185201743466171497738502.jpg', 1, 0, '2017-06-18 01:28:22', NULL),
(4, 2, 'dfdf', 'images/gallery/119185201743466171497737835.jpg', 1, 0, '2017-06-18 01:28:22', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

DROP TABLE IF EXISTS `news`;
CREATE TABLE IF NOT EXISTS `news` (
  `news_id` int(255) NOT NULL AUTO_INCREMENT,
  `title` varchar(256) NOT NULL,
  `editor` varchar(128) NOT NULL,
  `content` text NOT NULL,
  `image` varchar(128) NOT NULL,
  `video_youtube` varchar(512) NOT NULL,
  `category` varchar(128) CHARACTER SET utf8mb4 NOT NULL,
  `display` int(1) NOT NULL DEFAULT '1',
  `display_phone` int(1) NOT NULL DEFAULT '0',
  `creation` datetime DEFAULT NULL,
  `modify` datetime DEFAULT NULL,
  `views` int(255) NOT NULL DEFAULT '0',
  `comments` int(1) NOT NULL DEFAULT '0',
  `comments_number` int(255) NOT NULL DEFAULT '0',
  PRIMARY KEY (`news_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`news_id`, `title`, `editor`, `content`, `image`, `video_youtube`, `category`, `display`, `display_phone`, `creation`, `modify`, `views`, `comments`, `comments_number`) VALUES
(1, 'تجربة', 'dfdf', 'as', 'images/news/119185201743466161497609075.jpg', 'no video', 'نشاطات المكتب', 1, 0, '2017-06-16 13:31:15', NULL, 22, 0, 0),
(2, 'dfsdfsdf', 'sdfs', 'sdf', 'images/news/119185201743466161497620608.jpg', 'no video', 'نشاطات المكتب', 1, 0, '2017-06-16 16:43:28', NULL, 3, 0, 0),
(3, 'jjjjjj', 'sdfs', 'lklk', 'images/news/119185201743466161497621568.jpg', 'jljl', 'بيانات ومواقف', 1, 0, '2017-06-16 16:59:28', NULL, 1, 0, 0),
(4, 'oiuyyy', 'لم يتم تحديد المحرر', 'لم يتم تحديد المحتوى', 'images/news/119185201743466161497621751.jpg', 'no video', 'الامين العام', 1, 0, '2017-06-16 17:02:31', NULL, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `news_comments`
--

DROP TABLE IF EXISTS `news_comments`;
CREATE TABLE IF NOT EXISTS `news_comments` (
  `comment_id` int(255) NOT NULL AUTO_INCREMENT,
  `news_id` int(255) NOT NULL,
  `name` varchar(128) NOT NULL,
  `comment` varchar(2048) NOT NULL,
  `display` int(1) NOT NULL DEFAULT '0',
  `display_phone` int(1) NOT NULL DEFAULT '0',
  `creation` datetime NOT NULL,
  PRIMARY KEY (`comment_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `news_hashtag`
--

DROP TABLE IF EXISTS `news_hashtag`;
CREATE TABLE IF NOT EXISTS `news_hashtag` (
  `hashtag_id` int(255) NOT NULL AUTO_INCREMENT,
  `keywords` varchar(64) NOT NULL,
  `active` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`hashtag_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `subtitle`
--

DROP TABLE IF EXISTS `subtitle`;
CREATE TABLE IF NOT EXISTS `subtitle` (
  `subtitle_id` int(255) NOT NULL AUTO_INCREMENT,
  `title` varchar(512) NOT NULL,
  `display` int(1) NOT NULL DEFAULT '1',
  `creation` datetime DEFAULT NULL,
  `modify` datetime DEFAULT NULL,
  PRIMARY KEY (`subtitle_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `subtitle`
--

INSERT INTO `subtitle` (`subtitle_id`, `title`, `display`, `creation`, `modify`) VALUES
(1, 'تسيت', 1, '2017-06-16 13:51:57', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(255) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(64) DEFAULT NULL,
  `lastname` varchar(64) DEFAULT NULL,
  `username` varchar(64) DEFAULT NULL,
  `password` varchar(128) DEFAULT NULL,
  `jobtitle` varchar(64) DEFAULT NULL,
  `phone` varchar(16) DEFAULT NULL,
  `email` varchar(32) DEFAULT NULL,
  `creation` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modify` timestamp NULL DEFAULT NULL,
  `permission_news` int(1) NOT NULL DEFAULT '1',
  `permission_subtitle` int(1) NOT NULL DEFAULT '1',
  `permission_video` int(1) NOT NULL DEFAULT '1',
  `permission_gallery` int(1) NOT NULL DEFAULT '1',
  `permission_advertising` int(1) NOT NULL DEFAULT '1',
  `permission_programs_day` int(1) NOT NULL DEFAULT '1',
  `permission_questionnaire` int(1) NOT NULL DEFAULT '1',
  `permission_users` int(1) NOT NULL DEFAULT '1',
  `permission_export` int(1) NOT NULL DEFAULT '1',
  `permission_sitemap` int(1) NOT NULL DEFAULT '1',
  `permission_insert` int(1) NOT NULL DEFAULT '1',
  `permission_update` int(1) NOT NULL DEFAULT '1',
  `permission_delete` int(1) NOT NULL DEFAULT '1',
  `adminstration` int(1) NOT NULL DEFAULT '0',
  `decription` text,
  `activite` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='This table for users';

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `firstname`, `lastname`, `username`, `password`, `jobtitle`, `phone`, `email`, `creation`, `modify`, `permission_news`, `permission_subtitle`, `permission_video`, `permission_gallery`, `permission_advertising`, `permission_programs_day`, `permission_questionnaire`, `permission_users`, `permission_export`, `permission_sitemap`, `permission_insert`, `permission_update`, `permission_delete`, `adminstration`, `decription`, `activite`) VALUES
(1, 'Admin', 'Admin', 'admin', '21232f297a57a5a743894a0e4a801fc3', 'a', 'a', 'a', '2017-06-16 09:36:45', NULL, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users_log`
--

DROP TABLE IF EXISTS `users_log`;
CREATE TABLE IF NOT EXISTS `users_log` (
  `log_id` int(255) NOT NULL AUTO_INCREMENT,
  `user_id` int(255) NOT NULL,
  `fullname` varchar(64) NOT NULL,
  `login_date` date DEFAULT NULL,
  `login_time` time DEFAULT NULL,
  `logout_date` date DEFAULT NULL,
  `logout_time` time DEFAULT NULL,
  `adminstration` int(1) NOT NULL DEFAULT '0',
  `browser` varchar(32) NOT NULL,
  `os` varchar(32) NOT NULL,
  `ip` varchar(32) NOT NULL,
  `countryname` varchar(10) NOT NULL,
  `countrycode` varchar(4) NOT NULL,
  PRIMARY KEY (`log_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COMMENT='This table for users login';

--
-- Dumping data for table `users_log`
--

INSERT INTO `users_log` (`log_id`, `user_id`, `fullname`, `login_date`, `login_time`, `logout_date`, `logout_time`, `adminstration`, `browser`, `os`, `ip`, `countryname`, `countrycode`) VALUES
(1, 1, 'Admin Admin', '2017-06-16', '09:40:11', NULL, NULL, 0, 'Google Chrome', 'Windows OS', '', '', ''),
(2, 1, 'Admin Admin', '2017-06-19', '02:36:48', NULL, NULL, 0, 'Google Chrome', 'Windows OS', '', '', ''),
(3, 1, 'Admin Admin', '2017-06-22', '03:47:57', NULL, NULL, 0, 'Google Chrome', 'Windows OS', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `users_track`
--

DROP TABLE IF EXISTS `users_track`;
CREATE TABLE IF NOT EXISTS `users_track` (
  `track_id` int(255) NOT NULL AUTO_INCREMENT,
  `user_id` int(6) DEFAULT NULL,
  `operation` varchar(128) NOT NULL,
  `description` varchar(512) NOT NULL,
  `creation` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`track_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `video`
--

DROP TABLE IF EXISTS `video`;
CREATE TABLE IF NOT EXISTS `video` (
  `video_id` int(255) NOT NULL AUTO_INCREMENT,
  `title` varchar(256) NOT NULL,
  `code` varchar(512) NOT NULL,
  `image` varchar(128) NOT NULL,
  `display` int(1) NOT NULL DEFAULT '1',
  `display_phone` int(1) NOT NULL DEFAULT '0',
  `creation` datetime DEFAULT NULL,
  `modify` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`video_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `video`
--

INSERT INTO `video` (`video_id`, `title`, `code`, `image`, `display`, `display_phone`, `creation`, `modify`) VALUES
(1, 'sdsdsd', '<iframe width="380" height="240" src="https://www.youtube.com/embed/grY7HG94hbI" frameborder="0" allowfullscreen></iframe>', 'images/video/default.png', 1, 0, NULL, NULL),
(2, 'sdsdsd', '<iframe width="380" height="240" src="https://www.youtube.com/embed/grY7HG94hbI" frameborder="0" allowfullscreen></iframe>', 'images/video/default.png', 1, 0, '2017-06-22 07:00:16', NULL),
(3, 'dffdgdfgfdg', '<iframe width="380" height="240" src="https://www.youtube.com/embed/grY7HG94hbI" frameborder="0" allowfullscreen></iframe>', 'images/video/119185201743466221498104056.jpg', 1, 0, '2017-06-22 07:00:56', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `video_gallery`
--

DROP TABLE IF EXISTS `video_gallery`;
CREATE TABLE IF NOT EXISTS `video_gallery` (
  `video_gallery_id` int(255) NOT NULL AUTO_INCREMENT,
  `title` varchar(256) NOT NULL,
  `description` varchar(512) NOT NULL,
  `image` varchar(128) NOT NULL,
  `display` int(1) NOT NULL,
  `display_phone` int(1) NOT NULL,
  `creation` datetime NOT NULL,
  `modify` datetime NOT NULL,
  PRIMARY KEY (`video_gallery_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `video_gallery_items`
--

DROP TABLE IF EXISTS `video_gallery_items`;
CREATE TABLE IF NOT EXISTS `video_gallery_items` (
  `video_id` int(255) NOT NULL AUTO_INCREMENT,
  `video_gallery_id` int(255) NOT NULL,
  `title` varchar(256) NOT NULL,
  `code` varchar(512) NOT NULL,
  `display` int(1) NOT NULL,
  `display_phone` int(1) NOT NULL,
  `creation` datetime NOT NULL,
  `modify` datetime NOT NULL,
  PRIMARY KEY (`video_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
