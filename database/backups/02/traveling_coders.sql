-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 20, 2017 at 08:14 AM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 7.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `traveling_coders`
--

-- --------------------------------------------------------

--
-- Table structure for table `blogs`
--

CREATE TABLE `blogs` (
  `blog_id` int(11) NOT NULL,
  `blog_title` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  `blog_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `blog_image` text,
  `blog_content` text NOT NULL,
  `blog_tags` varchar(255) NOT NULL,
  `blog_view_count` int(11) NOT NULL DEFAULT '0',
  `blog_likes_count` int(11) NOT NULL DEFAULT '0',
  `blog_comments_count` int(11) NOT NULL DEFAULT '0',
  `category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `blogs`
--

INSERT INTO `blogs` (`blog_id`, `blog_title`, `user_id`, `blog_time`, `blog_image`, `blog_content`, `blog_tags`, `blog_view_count`, `blog_likes_count`, `blog_comments_count`, `category_id`) VALUES
(14, 'Walking In The Rain', 3, '2017-05-19 22:32:31', 'venice.jpg', 'We choose to go to the moon in this decade and do the other things, not because they are easy, but because they are hard, because that goal will serve to organize and measure the best of our energies and skills, because that challenge is one that we are willing to accept, one we are unwilling to postpone, and one which we intend to win.', 'Tea Trees Birds Lake', 0, 0, 0, 1),
(15, 'Siting On A Boat', 3, '2017-05-19 22:36:13', 'boat.jpg', 'We choose to go to the moon in this decade and do the other things, not because they are easy, but because they are hard, because that goal will serve to organize and measure the best of our energies and skills, because that challenge is one that we are willing to accept, one we are unwilling to postpone, and one which we intend to win.', 'Tea Trees Birds Lake', 0, 0, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `boards`
--

CREATE TABLE `boards` (
  `board_id` int(11) NOT NULL,
  `board_title` varchar(255) NOT NULL,
  `board_posts_count` int(11) NOT NULL DEFAULT '0',
  `board_users_count` int(11) NOT NULL DEFAULT '0',
  `category_id` int(11) NOT NULL,
  `board_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `board_views_count` int(11) NOT NULL DEFAULT '0',
  `board_open` int(11) NOT NULL DEFAULT '0',
  `user_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `boards`
--

INSERT INTO `boards` (`board_id`, `board_title`, `board_posts_count`, `board_users_count`, `category_id`, `board_date`, `board_views_count`, `board_open`, `user_id`) VALUES
(12, 'Germany', 0, 0, 1, '2017-05-19 00:53:52', 0, 0, 1),
(11, 'Brazil', 0, 0, 1, '2017-05-19 00:53:45', 0, 0, 1),
(10, 'Mexico', 0, 0, 1, '2017-05-19 00:53:35', 0, 0, 1),
(8, 'USA', 0, 0, 1, '2017-05-19 00:53:17', 0, 0, 1),
(9, 'China', 0, 0, 1, '2017-05-19 00:53:25', 0, 0, 1),
(13, 'New Zealand', 0, 0, 1, '2017-05-19 00:54:05', 0, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`category_id`, `category_name`) VALUES
(1, 'Travel'),
(2, 'Life'),
(3, 'Money');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `comment_id` int(11) NOT NULL,
  `comment_content` text NOT NULL,
  `user_id` int(11) NOT NULL,
  `comment_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `comment_edited_time` timestamp NULL DEFAULT NULL,
  `comment_likes_count` int(11) NOT NULL DEFAULT '0',
  `comment_replies_count` int(11) NOT NULL DEFAULT '0',
  `comment_replied_to_id` int(11) DEFAULT NULL,
  `thread_id` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`comment_id`, `comment_content`, `user_id`, `comment_time`, `comment_edited_time`, `comment_likes_count`, `comment_replies_count`, `comment_replied_to_id`, `thread_id`) VALUES
(3, 'sdfsdfgsdfs', 1, '2017-05-19 16:45:07', NULL, 0, 0, NULL, 57),
(4, 'sdoisdofjiosdfwfsdf', 1, '2017-05-19 16:45:18', NULL, 0, 0, NULL, 57),
(5, 'sdoisdofjiosdfwfsdf', 1, '2017-05-19 16:45:50', NULL, 0, 0, NULL, 57),
(6, 'sdfsdfsdfsdfsdfs', 1, '2017-05-19 16:46:01', NULL, 0, 0, NULL, 57),
(7, 'dhfgdgdfgdfgdfg', 1, '2017-05-19 16:46:06', NULL, 0, 0, NULL, 57),
(8, 'dfghdfgdgfdh', 1, '2017-05-19 16:46:10', NULL, 0, 0, NULL, 57),
(9, 'dfgdgfdgdfhd', 1, '2017-05-19 16:46:25', NULL, 0, 0, NULL, 57),
(10, 'dfgdgfdfgdfhdfgdgf', 1, '2017-05-19 16:48:53', NULL, 0, 0, NULL, 57),
(11, 'dfgdfgdfghdfg', 1, '2017-05-19 16:48:59', NULL, 0, 0, NULL, 57),
(12, 'dfgdfgdfgdfgdfgdfg', 1, '2017-05-19 16:49:06', NULL, 0, 0, NULL, 57),
(13, 'dfgdfgdfgdfg', 1, '2017-05-19 16:49:11', NULL, 0, 0, NULL, 57),
(14, 'dfgdfgdgd', 1, '2017-05-19 16:49:15', NULL, 0, 0, NULL, 57);

-- --------------------------------------------------------

--
-- Table structure for table `threads`
--

CREATE TABLE `threads` (
  `thread_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `thread_title` varchar(255) NOT NULL,
  `thread_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `thread_likes_count` int(11) NOT NULL DEFAULT '0',
  `thread_comments_count` int(11) NOT NULL DEFAULT '0',
  `thread_tags` varchar(255) NOT NULL,
  `thread_views_count` int(11) NOT NULL DEFAULT '0',
  `board_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `threads`
--

INSERT INTO `threads` (`thread_id`, `user_id`, `thread_title`, `thread_time`, `thread_likes_count`, `thread_comments_count`, `thread_tags`, `thread_views_count`, `board_id`) VALUES
(57, 1, 'What country is coolest during the summer?', '2017-05-19 01:30:40', 0, 0, 'Winter Summer Fall', 0, 12),
(58, 1, 'Best beach in Germany?', '2017-05-19 17:20:37', 0, 0, 'Winter Summer Fall', 0, 12);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `user_name_first` varchar(255) NOT NULL,
  `user_name_last` varchar(255) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `user_avatar` text,
  `user_username` varchar(255) NOT NULL,
  `user_email` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_name_first`, `user_name_last`, `user_password`, `user_avatar`, `user_username`, `user_email`) VALUES
(1, 'admin', 'admin', 'password', NULL, 'admin', 'admin@localhost'),
(2, 'Jason', 'Jack', 'password', NULL, 'jasonjack', 'ssdfsdfs@sdfsfsf.csom'),
(3, 'Joseph', 'Oliver', 'password', NULL, 'josepholver2', 'josepholiver@example.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `blogs`
--
ALTER TABLE `blogs`
  ADD PRIMARY KEY (`blog_id`);

--
-- Indexes for table `boards`
--
ALTER TABLE `boards`
  ADD PRIMARY KEY (`board_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`comment_id`);

--
-- Indexes for table `threads`
--
ALTER TABLE `threads`
  ADD PRIMARY KEY (`thread_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `blogs`
--
ALTER TABLE `blogs`
  MODIFY `blog_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `boards`
--
ALTER TABLE `boards`
  MODIFY `board_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `threads`
--
ALTER TABLE `threads`
  MODIFY `thread_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
