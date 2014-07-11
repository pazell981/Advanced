-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: localhost:8889
-- Generation Time: Jul 11, 2014 at 10:52 PM
-- Server version: 5.5.34
-- PHP Version: 5.5.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `theWall`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--
-- Creation: Jul 09, 2014 at 11:55 PM
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `message_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `comment` text,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_comments_messages1_idx` (`message_id`),
  KEY `fk_comments_users1_idx` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `message_id`, `user_id`, `comment`, `created_at`, `updated_at`) VALUES
(1, 12, 6, 'Comment', '2014-07-11 13:04:00', '2014-07-11 13:04:00'),
(4, 13, 6, 'Hi Mom!', '2014-07-11 13:14:27', '2014-07-11 13:14:27');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--
-- Creation: Jul 11, 2014 at 01:32 AM
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `message` text,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_messages_users_idx` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `user_id`, `message`, `created_at`, `updated_at`) VALUES
(8, 2, 'test', '2014-07-10 02:54:34', '2014-07-11 03:34:34'),
(10, 2, 'test', '2014-07-10 17:42:21', '2014-07-10 18:42:21'),
(11, 2, 'test', '2014-07-10 18:45:19', '2014-07-10 18:45:19'),
(12, 5, 'test', '2014-07-11 11:58:18', '2014-07-11 11:58:18'),
(13, 6, 'I am a new post!', '2014-07-11 13:04:29', '2014-07-11 13:04:29');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--
-- Creation: Jul 09, 2014 at 11:55 PM
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(45) DEFAULT NULL,
  `last_name` varchar(45) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `password` varchar(45) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `password`, `created_at`, `updated_at`) VALUES
(2, 'Paul', 'Zellmer', 'zguy981@me.com', 'aed0f18f58d42c86d2e3457e1e03063c', '2014-07-10 19:11:40', '2014-07-10 19:11:40'),
(4, 'Paul', 'Zellmer', 'zguy981@gmail.com', 'cdYNdYF4p8l6s', '2014-07-11 19:46:40', '2014-07-11 19:46:40'),
(5, 'Paul', 'Zellmer', 'paulzellmer@icloud.com', '81Uz2wqq6hOUs', '2014-07-11 20:43:07', '2014-07-11 20:43:07'),
(6, 'Trey', 'Villafane', 'tv@gmail.com', 'ba5RwAwihj/nA', '2014-07-11 22:03:32', '2014-07-11 22:03:32');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `fk_comments_messages1` FOREIGN KEY (`message_id`) REFERENCES `posts` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_comments_users1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `fk_messages_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
