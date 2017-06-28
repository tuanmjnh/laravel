-- phpMyAdmin SQL Dump
-- version 4.6.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Aug 15, 2016 at 08:22 AM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 5.6.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `laravel`
--

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE `groups` (
  `id` bigint(20) NOT NULL,
  `lang_code` char(36) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `parent_id` bigint(20) DEFAULT NULL,
  `level` int(11) DEFAULT NULL,
  `parent_sid` varchar(255) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `description` text,
  `content` longtext,
  `images` varchar(255) DEFAULT NULL,
  `icon` text,
  `total_item` int(11) DEFAULT NULL,
  `created_by` varchar(255) DEFAULT NULL,
  `updated_by` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `end_at` datetime DEFAULT NULL,
  `orders` int(11) DEFAULT '0',
  `flag` int(11) DEFAULT '1',
  `extra` longtext,
  `seo_link_url` text,
  `seo_link_search` text,
  `seo_keyword` text,
  `seo_desc` longtext,
  `seo_title` text,
  `seo_link` text,
  `seo_lang` text,
  `seo_extra` text,
  `seo_params` longtext,
  `application` char(36) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `groups_groups`
--

CREATE TABLE `groups_groups` (
  `first_id` bigint(20) NOT NULL,
  `last_id` bigint(20) NOT NULL,
  `level` int(11) DEFAULT NULL,
  `parent_sid` varchar(255) DEFAULT NULL,
  `extra` longtext,
  `application` char(36) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `groups_items`
--

CREATE TABLE `groups_items` (
  `gid` bigint(20) NOT NULL,
  `iid` bigint(20) NOT NULL,
  `type` text,
  `description` text,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `end_at` datetime DEFAULT NULL,
  `orders` int(11) DEFAULT '0',
  `application` char(36) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `information`
--

CREATE TABLE `information` (
  `lang_code` char(36) NOT NULL,
  `app_key` char(255) NOT NULL,
  `sub_key` char(255) NOT NULL,
  `value` longtext,
  `sub_value` longtext,
  `images` varchar(255) DEFAULT NULL,
  `icon` text,
  `orders` int(11) DEFAULT '0',
  `description` text,
  `flag` int(11) DEFAULT '1',
  `extra` text,
  `application` char(36) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `id` bigint(20) NOT NULL,
  `lang_code` char(36) DEFAULT NULL,
  `type` text,
  `app_key` text,
  `title` text,
  `description` text,
  `content` longtext,
  `images` varchar(255) DEFAULT NULL,
  `icon` text,
  `url` text,
  `first_price` double DEFAULT NULL,
  `last_price` double DEFAULT NULL,
  `total_sub_item` int(11) DEFAULT NULL,
  `total_view` int(11) DEFAULT NULL,
  `last_view` datetime DEFAULT NULL,
  `created_by` varchar(255) DEFAULT NULL,
  `updated_by` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `end_at` datetime DEFAULT NULL,
  `orders` int(11) DEFAULT '0',
  `flag` int(11) DEFAULT '1',
  `extra` longtext,
  `seo_link_url` text,
  `seo_link_search` text,
  `seo_keyword` text,
  `seo_desc` longtext,
  `seo_title` text,
  `seo_link` text,
  `seo_lang` text,
  `seo_extra` text,
  `seo_params` longtext,
  `application` char(36) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `items_sub`
--

CREATE TABLE `items_sub` (
  `id` bigint(20) NOT NULL,
  `iid` bigint(20) DEFAULT NULL,
  `lang_code` char(36) DEFAULT NULL,
  `app_key` text,
  `title` text,
  `description` text,
  `content` longtext,
  `images` text,
  `icon` text,
  `email` text,
  `url` text,
  `created_by` varchar(255) DEFAULT NULL,
  `updated_by` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `end_at` datetime DEFAULT NULL,
  `orders` int(11) DEFAULT '0',
  `flag` int(11) DEFAULT '1',
  `extra` longtext,
  `seo_link_url` text,
  `seo_link_search` text,
  `seo_keyword` text,
  `seo_desc` longtext,
  `seo_title` text,
  `seo_link` text,
  `seo_lang` text,
  `seo_extra` text,
  `seo_params` longtext,
  `application` char(36) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `language`
--

CREATE TABLE `language` (
  `id` bigint(20) NOT NULL,
  `title` varchar(256) DEFAULT NULL,
  `native_name` varchar(256) DEFAULT NULL,
  `lang_code` char(64) DEFAULT NULL,
  `post_code` char(64) DEFAULT NULL,
  `country_code` char(64) DEFAULT NULL,
  `currency` float DEFAULT NULL,
  `images` varchar(255) DEFAULT NULL,
  `icon` tinytext,
  `description` text,
  `created_by` varchar(255) DEFAULT NULL,
  `updated_by` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `orders` int(11) DEFAULT '0',
  `flag` int(11) DEFAULT '1',
  `application` char(36) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `language`
--

INSERT INTO `language` (`id`, `title`, `native_name`, `lang_code`, `post_code`, `country_code`, `currency`, `images`, `icon`, `description`, `created_by`, `updated_by`, `created_at`, `updated_at`, `orders`, `flag`, `application`) VALUES
(1, 'Vietnamese', 'Tiếng việt', 'vi-VN', 'vi', 'vi', 0, 'language/vn.png', '', '', 'admin', 'admin', '2016-08-15 06:03:26', '2016-08-15 06:10:49', 0, 1, NULL),
(2, 'English', 'English', 'en-GB', 'en', 'en', 0, 'language/gb.png', '', '', 'admin', 'admin', '2016-08-15 06:19:19', '2016-08-15 06:21:03', 1, 1, NULL),
(3, 'Japanese', '日本語 (にほんご)', 'ja-JP', 'jp', 'jp', 0, 'language/jp.png', '', '', 'admin', 'admin', '2016-08-15 06:20:37', '2016-08-15 06:21:20', 2, 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `language_items`
--

CREATE TABLE `language_items` (
  `lid` bigint(20) NOT NULL,
  `lkid` bigint(20) NOT NULL,
  `title` text,
  `description` text,
  `extra` longtext,
  `application` char(36) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `language_key`
--

CREATE TABLE `language_key` (
  `id` bigint(20) NOT NULL,
  `title` text,
  `description` text,
  `application` char(36) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE `members` (
  `id` bigint(20) NOT NULL,
  `user_name` varchar(128) DEFAULT NULL,
  `password` varchar(256) DEFAULT NULL,
  `salt` text,
  `property_name` varchar(512) DEFAULT NULL,
  `email` varchar(128) DEFAULT NULL,
  `phone` char(128) DEFAULT NULL,
  `person_id` text,
  `address` text,
  `description` text,
  `images` char(250) DEFAULT NULL,
  `remember_token` text,
  `last_inf` text,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `last_login` datetime DEFAULT NULL,
  `last_change_pass` datetime DEFAULT NULL,
  `login_time` int(11) DEFAULT '0',
  `locked_by` text,
  `locked_at` datetime DEFAULT NULL,
  `flag_lock` int(11) DEFAULT '1',
  `flag` int(11) DEFAULT '1',
  `extra` longtext,
  `application` char(36) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `modules`
--

CREATE TABLE `modules` (
  `id` bigint(20) NOT NULL,
  `parent_id` bigint(20) DEFAULT NULL,
  `level` int(11) DEFAULT '0',
  `parent_sid` text,
  `title` text,
  `description` text,
  `url` text,
  `icon` text,
  `roles` text,
  `created_by` varchar(255) DEFAULT NULL,
  `updated_by` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `orders` int(11) DEFAULT '0',
  `flag` int(11) DEFAULT '1',
  `extra` longtext,
  `application` char(36) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) NOT NULL,
  `app_key` text,
  `value` text,
  `description` text,
  `images` varchar(255) DEFAULT NULL,
  `icon` text,
  `created_by` varchar(255) DEFAULT NULL,
  `updated_by` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `orders` int(11) DEFAULT '0',
  `extra` longtext,
  `application` char(36) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `setting`
--

CREATE TABLE `setting` (
  `app` varchar(255) NOT NULL,
  `app_key` varchar(255) NOT NULL,
  `sub_key` varchar(255) NOT NULL,
  `value` varchar(255) NOT NULL DEFAULT '',
  `sub_value` varchar(255) DEFAULT NULL,
  `description` text,
  `extra` longtext,
  `application` char(36) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) NOT NULL,
  `roles` text,
  `user_name` varchar(128) DEFAULT NULL,
  `password` varchar(512) DEFAULT NULL,
  `salt` text,
  `property_name` varchar(512) DEFAULT NULL,
  `email` varchar(128) DEFAULT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `images` char(255) DEFAULT NULL,
  `remember_token` text,
  `last_inf` text,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `last_login` datetime DEFAULT NULL,
  `last_change_pass` datetime DEFAULT NULL,
  `login_time` int(11) DEFAULT NULL,
  `locked_by` text,
  `locked_at` datetime DEFAULT NULL,
  `flag_lock` int(11) DEFAULT '0',
  `application` char(36) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `groups_groups`
--
ALTER TABLE `groups_groups`
  ADD PRIMARY KEY (`first_id`,`last_id`);

--
-- Indexes for table `groups_items`
--
ALTER TABLE `groups_items`
  ADD KEY `groups_items_groups` (`gid`),
  ADD KEY `groups_items_items` (`iid`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `items_sub`
--
ALTER TABLE `items_sub`
  ADD PRIMARY KEY (`id`),
  ADD KEY `items_sub_items` (`iid`);

--
-- Indexes for table `language`
--
ALTER TABLE `language`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `language_items`
--
ALTER TABLE `language_items`
  ADD KEY `language_items_language` (`lid`),
  ADD KEY `language_items_key` (`lkid`);

--
-- Indexes for table `language_key`
--
ALTER TABLE `language_key`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `modules`
--
ALTER TABLE `modules`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `setting`
--
ALTER TABLE `setting`
  ADD PRIMARY KEY (`app`,`app_key`,`sub_key`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `items_sub`
--
ALTER TABLE `items_sub`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `language`
--
ALTER TABLE `language`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `language_key`
--
ALTER TABLE `language_key`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `members`
--
ALTER TABLE `members`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `modules`
--
ALTER TABLE `modules`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `groups_items`
--
ALTER TABLE `groups_items`
  ADD CONSTRAINT `groups_items_groups` FOREIGN KEY (`gid`) REFERENCES `groups` (`id`),
  ADD CONSTRAINT `groups_items_items` FOREIGN KEY (`iid`) REFERENCES `items` (`id`);

--
-- Constraints for table `items_sub`
--
ALTER TABLE `items_sub`
  ADD CONSTRAINT `items_sub_items` FOREIGN KEY (`iid`) REFERENCES `items` (`id`);

--
-- Constraints for table `language_items`
--
ALTER TABLE `language_items`
  ADD CONSTRAINT `language_items_key` FOREIGN KEY (`lkid`) REFERENCES `language_key` (`id`),
  ADD CONSTRAINT `language_items_language` FOREIGN KEY (`lid`) REFERENCES `language` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
