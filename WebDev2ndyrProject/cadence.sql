-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 11, 2024 at 04:53 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cadence`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments_tbl`
--

CREATE TABLE `comments_tbl` (
  `comment_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `comment_text` text NOT NULL,
  `comment_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `draftstbl`
--

CREATE TABLE `draftstbl` (
  `draft_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `draft_title` varchar(255) DEFAULT NULL,
  `draft_text` text DEFAULT NULL,
  `draft_attachment` varchar(255) DEFAULT NULL,
  `draft_tag` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `likes_comment_tbl`
--

CREATE TABLE `likes_comment_tbl` (
  `like_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `comment_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `likes_post_tbl`
--

CREATE TABLE `likes_post_tbl` (
  `like_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `likes_reply_tbl`
--

CREATE TABLE `likes_reply_tbl` (
  `like_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `reply_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `poststbl`
--

CREATE TABLE `poststbl` (
  `post_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `post_title` varchar(255) DEFAULT NULL,
  `post_text` text DEFAULT NULL,
  `post_attachment` varchar(255) DEFAULT NULL,
  `post_publish_date` date DEFAULT NULL,
  `post_comments` int(11) DEFAULT NULL,
  `post_likes` int(11) DEFAULT NULL,
  `post_tag` varchar(255) DEFAULT NULL,
  `draft_tag` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `post_likes_tbl`
--

CREATE TABLE `post_likes_tbl` (
  `like_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `post_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `profiletbl`
--

CREATE TABLE `profiletbl` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `author_name` varchar(255) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `page_title` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `profile_icon` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `replies_tbl`
--

CREATE TABLE `replies_tbl` (
  `reply_id` int(11) NOT NULL,
  `comment_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `reply_text` text NOT NULL,
  `reply_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `supporttbl`
--

CREATE TABLE `supporttbl` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `assistance` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `issue` varchar(255) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `detail` text NOT NULL,
  `attachment` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `userstbl`
--

CREATE TABLE `userstbl` (
  `id` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `reset_token_hash` varchar(64) DEFAULT NULL,
  `reset_token_expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments_tbl`
--
ALTER TABLE `comments_tbl`
  ADD PRIMARY KEY (`comment_id`),
  ADD KEY `post_id` (`post_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `draftstbl`
--
ALTER TABLE `draftstbl`
  ADD PRIMARY KEY (`draft_id`);

--
-- Indexes for table `likes_comment_tbl`
--
ALTER TABLE `likes_comment_tbl`
  ADD PRIMARY KEY (`like_id`),
  ADD UNIQUE KEY `user_id` (`user_id`,`comment_id`),
  ADD KEY `comment_id` (`comment_id`);

--
-- Indexes for table `likes_post_tbl`
--
ALTER TABLE `likes_post_tbl`
  ADD PRIMARY KEY (`like_id`),
  ADD UNIQUE KEY `user_id` (`user_id`,`post_id`),
  ADD KEY `post_id` (`post_id`);

--
-- Indexes for table `likes_reply_tbl`
--
ALTER TABLE `likes_reply_tbl`
  ADD PRIMARY KEY (`like_id`),
  ADD UNIQUE KEY `user_id` (`user_id`,`reply_id`),
  ADD KEY `reply_id` (`reply_id`);

--
-- Indexes for table `poststbl`
--
ALTER TABLE `poststbl`
  ADD PRIMARY KEY (`post_id`);

--
-- Indexes for table `post_likes_tbl`
--
ALTER TABLE `post_likes_tbl`
  ADD PRIMARY KEY (`like_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `post_id` (`post_id`);

--
-- Indexes for table `profiletbl`
--
ALTER TABLE `profiletbl`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `replies_tbl`
--
ALTER TABLE `replies_tbl`
  ADD PRIMARY KEY (`reply_id`),
  ADD KEY `comment_id` (`comment_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `supporttbl`
--
ALTER TABLE `supporttbl`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `userstbl`
--
ALTER TABLE `userstbl`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `reset_token_hash` (`reset_token_hash`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments_tbl`
--
ALTER TABLE `comments_tbl`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `draftstbl`
--
ALTER TABLE `draftstbl`
  MODIFY `draft_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `likes_comment_tbl`
--
ALTER TABLE `likes_comment_tbl`
  MODIFY `like_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `likes_post_tbl`
--
ALTER TABLE `likes_post_tbl`
  MODIFY `like_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `likes_reply_tbl`
--
ALTER TABLE `likes_reply_tbl`
  MODIFY `like_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `poststbl`
--
ALTER TABLE `poststbl`
  MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `post_likes_tbl`
--
ALTER TABLE `post_likes_tbl`
  MODIFY `like_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `profiletbl`
--
ALTER TABLE `profiletbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `replies_tbl`
--
ALTER TABLE `replies_tbl`
  MODIFY `reply_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `supporttbl`
--
ALTER TABLE `supporttbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `userstbl`
--
ALTER TABLE `userstbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments_tbl`
--
ALTER TABLE `comments_tbl`
  ADD CONSTRAINT `comments_tbl_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `poststbl` (`post_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `comments_tbl_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `userstbl` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `likes_comment_tbl`
--
ALTER TABLE `likes_comment_tbl`
  ADD CONSTRAINT `likes_comment_tbl_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `userstbl` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `likes_comment_tbl_ibfk_2` FOREIGN KEY (`comment_id`) REFERENCES `comments_tbl` (`comment_id`) ON DELETE CASCADE;

--
-- Constraints for table `likes_post_tbl`
--
ALTER TABLE `likes_post_tbl`
  ADD CONSTRAINT `likes_post_tbl_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `userstbl` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `likes_post_tbl_ibfk_2` FOREIGN KEY (`post_id`) REFERENCES `poststbl` (`post_id`) ON DELETE CASCADE;

--
-- Constraints for table `likes_reply_tbl`
--
ALTER TABLE `likes_reply_tbl`
  ADD CONSTRAINT `likes_reply_tbl_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `userstbl` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `likes_reply_tbl_ibfk_2` FOREIGN KEY (`reply_id`) REFERENCES `replies_tbl` (`reply_id`) ON DELETE CASCADE;

--
-- Constraints for table `profiletbl`
--
ALTER TABLE `profiletbl`
  ADD CONSTRAINT `profiletbl_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `userstbl` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `replies_tbl`
--
ALTER TABLE `replies_tbl`
  ADD CONSTRAINT `replies_tbl_ibfk_1` FOREIGN KEY (`comment_id`) REFERENCES `comments_tbl` (`comment_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `replies_tbl_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `userstbl` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `supporttbl`
--
ALTER TABLE `supporttbl`
  ADD CONSTRAINT `supporttbl_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `userstbl` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
