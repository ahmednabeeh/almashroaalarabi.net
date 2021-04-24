-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 30, 2018 at 04:46 PM
-- Server version: 5.6.38
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `almashro_Uxvs_DBNen`
--

-- --------------------------------------------------------

--
-- Table structure for table `advertising`
--

CREATE TABLE `advertising` (
  `advertis_id` int(255) NOT NULL,
  `title` varchar(256) NOT NULL,
  `description` varchar(512) NOT NULL,
  `image` varchar(128) NOT NULL,
  `display` int(1) NOT NULL DEFAULT '1',
  `display_phone` int(1) NOT NULL,
  `creation` datetime NOT NULL,
  `modify` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `gallery`
--

CREATE TABLE `gallery` (
  `gallery_id` int(255) NOT NULL,
  `title` varchar(256) NOT NULL,
  `display` int(1) NOT NULL DEFAULT '1',
  `display_phone` int(1) NOT NULL DEFAULT '0',
  `creation` datetime NOT NULL,
  `modify` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `gallery_images`
--

CREATE TABLE `gallery_images` (
  `gallery_image_id` int(255) NOT NULL,
  `gallery_id` int(255) NOT NULL,
  `title` varchar(256) NOT NULL,
  `image` varchar(128) NOT NULL,
  `display` int(1) NOT NULL DEFAULT '1',
  `display_phone` int(1) NOT NULL DEFAULT '0',
  `creation` datetime NOT NULL,
  `modify` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `news_id` int(255) NOT NULL,
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
  `comments_number` int(255) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `news_comments`
--

CREATE TABLE `news_comments` (
  `comment_id` int(255) NOT NULL,
  `news_id` int(255) NOT NULL,
  `name` varchar(128) NOT NULL,
  `comment` varchar(2048) NOT NULL,
  `display` int(1) NOT NULL DEFAULT '0',
  `display_phone` int(1) NOT NULL DEFAULT '0',
  `creation` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `news_hashtag`
--

CREATE TABLE `news_hashtag` (
  `hashtag_id` int(255) NOT NULL,
  `keywords` varchar(64) NOT NULL,
  `active` int(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `subtitle`
--

CREATE TABLE `subtitle` (
  `subtitle_id` int(255) NOT NULL,
  `title` varchar(512) NOT NULL,
  `display` int(1) NOT NULL DEFAULT '1',
  `creation` datetime DEFAULT NULL,
  `modify` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(255) NOT NULL,
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
  `activite` int(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='This table for users';

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `firstname`, `lastname`, `username`, `password`, `jobtitle`, `phone`, `email`, `creation`, `modify`, `permission_news`, `permission_subtitle`, `permission_video`, `permission_gallery`, `permission_advertising`, `permission_programs_day`, `permission_questionnaire`, `permission_users`, `permission_export`, `permission_sitemap`, `permission_insert`, `permission_update`, `permission_delete`, `adminstration`, `decription`, `activite`) VALUES
(1, 'Admin', 'Admin', 'almashroaa', '9806416eb22e4c4ff122beebf02f142a', 'a', 'a', 'a', '2017-06-16 09:36:45', NULL, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users_log`
--

CREATE TABLE `users_log` (
  `log_id` int(255) NOT NULL,
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
  `countrycode` varchar(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='This table for users login';

--
-- Dumping data for table `users_log`
--

INSERT INTO `users_log` (`log_id`, `user_id`, `fullname`, `login_date`, `login_time`, `logout_date`, `logout_time`, `adminstration`, `browser`, `os`, `ip`, `countryname`, `countrycode`) VALUES
(1, 1, 'Admin Admin', '2017-06-16', '09:40:11', NULL, NULL, 0, 'Google Chrome', 'Windows OS', '', '', ''),
(2, 1, 'Admin Admin', '2017-06-22', '04:19:01', NULL, NULL, 0, 'Unknown', 'Unknown OS', '', '', ''),
(3, 1, 'Admin Admin', '2017-06-22', '04:21:55', NULL, NULL, 0, 'Unknown', 'Unknown OS', '', '', ''),
(4, 1, 'Admin Admin', '2017-06-22', '12:11:40', NULL, NULL, 0, 'Unknown', 'Unknown OS', '', '', ''),
(5, 1, 'Admin Admin', '2017-06-30', '03:25:12', NULL, NULL, 0, 'Unknown', 'Unknown OS', '', '', ''),
(6, 1, 'Admin Admin', '2017-06-30', '05:10:22', NULL, NULL, 0, 'Unknown', 'Unknown OS', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `users_track`
--

CREATE TABLE `users_track` (
  `track_id` int(255) NOT NULL,
  `user_id` int(6) DEFAULT NULL,
  `operation` varchar(128) NOT NULL,
  `description` varchar(512) NOT NULL,
  `creation` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `video`
--

CREATE TABLE `video` (
  `video_id` int(255) NOT NULL,
  `title` varchar(256) NOT NULL,
  `code` varchar(512) NOT NULL,
  `image` varchar(128) NOT NULL,
  `display` int(1) NOT NULL DEFAULT '1',
  `display_phone` int(1) NOT NULL DEFAULT '0',
  `creation` datetime DEFAULT NULL,
  `modify` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `video_gallery`
--

CREATE TABLE `video_gallery` (
  `video_gallery_id` int(255) NOT NULL,
  `title` varchar(256) NOT NULL,
  `description` varchar(512) NOT NULL,
  `image` varchar(128) NOT NULL,
  `display` int(1) NOT NULL,
  `display_phone` int(1) NOT NULL,
  `creation` datetime NOT NULL,
  `modify` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `video_gallery_items`
--

CREATE TABLE `video_gallery_items` (
  `video_id` int(255) NOT NULL,
  `video_gallery_id` int(255) NOT NULL,
  `title` varchar(256) NOT NULL,
  `code` varchar(512) NOT NULL,
  `display` int(1) NOT NULL,
  `display_phone` int(1) NOT NULL,
  `creation` datetime NOT NULL,
  `modify` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `advertising`
--
ALTER TABLE `advertising`
  ADD PRIMARY KEY (`advertis_id`);

--
-- Indexes for table `gallery`
--
ALTER TABLE `gallery`
  ADD PRIMARY KEY (`gallery_id`);

--
-- Indexes for table `gallery_images`
--
ALTER TABLE `gallery_images`
  ADD PRIMARY KEY (`gallery_image_id`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`news_id`);

--
-- Indexes for table `news_comments`
--
ALTER TABLE `news_comments`
  ADD PRIMARY KEY (`comment_id`);

--
-- Indexes for table `news_hashtag`
--
ALTER TABLE `news_hashtag`
  ADD PRIMARY KEY (`hashtag_id`);

--
-- Indexes for table `subtitle`
--
ALTER TABLE `subtitle`
  ADD PRIMARY KEY (`subtitle_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `users_log`
--
ALTER TABLE `users_log`
  ADD PRIMARY KEY (`log_id`);

--
-- Indexes for table `users_track`
--
ALTER TABLE `users_track`
  ADD PRIMARY KEY (`track_id`);

--
-- Indexes for table `video`
--
ALTER TABLE `video`
  ADD PRIMARY KEY (`video_id`);

--
-- Indexes for table `video_gallery`
--
ALTER TABLE `video_gallery`
  ADD PRIMARY KEY (`video_gallery_id`);

--
-- Indexes for table `video_gallery_items`
--
ALTER TABLE `video_gallery_items`
  ADD PRIMARY KEY (`video_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `advertising`
--
ALTER TABLE `advertising`
  MODIFY `advertis_id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `gallery`
--
ALTER TABLE `gallery`
  MODIFY `gallery_id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `gallery_images`
--
ALTER TABLE `gallery_images`
  MODIFY `gallery_image_id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `news_id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `news_comments`
--
ALTER TABLE `news_comments`
  MODIFY `comment_id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `news_hashtag`
--
ALTER TABLE `news_hashtag`
  MODIFY `hashtag_id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `subtitle`
--
ALTER TABLE `subtitle`
  MODIFY `subtitle_id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users_log`
--
ALTER TABLE `users_log`
  MODIFY `log_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users_track`
--
ALTER TABLE `users_track`
  MODIFY `track_id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `video`
--
ALTER TABLE `video`
  MODIFY `video_id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `video_gallery`
--
ALTER TABLE `video_gallery`
  MODIFY `video_gallery_id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `video_gallery_items`
--
ALTER TABLE `video_gallery_items`
  MODIFY `video_id` int(255) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
