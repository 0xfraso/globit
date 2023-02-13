-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Feb 13, 2023 at 03:13 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `social`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `body` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `parent_id` int(11) DEFAULT NULL,
  `post_owner_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `post_id`, `user_id`, `body`, `created_at`, `parent_id`, `post_owner_id`) VALUES
(76, 120, 5, 'Lorem est aliquip amet voluptate voluptate dolor minim nulla est proident. Nostrud officia pariatur ut officia.', '2023-02-13 13:41:40', NULL, 4),
(77, 120, 3, 'Aliqua reprehenderit commodo ex non excepteur duis sunt velit enim. Voluptate laboris sint cupidatat ullamco ut ea consectetur et est culpa et culpa duis.', '2023-02-13 13:52:50', NULL, 4),
(78, 120, 3, 'Aliqua reprehenderit commodo ex non excepteur duis sunt velit enim. Voluptate laboris sint cupidatat ullamco ut ea consectetur et est culpa et culpa duis.', '2023-02-13 13:52:54', 76, 4),
(79, 120, 4, ' Sit irure elit esse ea nulla sunt ex occaecat reprehenderit commodo officia dolor Lorem duis laboris cupidatat officia voluptate.', '2023-02-13 13:53:54', 76, 4),
(80, 120, 4, ' Sit irure elit esse ea nulla sunt ex occaecat reprehenderit commodo officia dolor Lorem duis laboris cupidatat officia voluptate.', '2023-02-13 13:54:00', 77, 4);

-- --------------------------------------------------------

--
-- Table structure for table `comment_votes`
--

CREATE TABLE `comment_votes` (
  `user_id` int(11) NOT NULL,
  `comment_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `follows`
--

CREATE TABLE `follows` (
  `follower_id` int(11) NOT NULL,
  `followed_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `follows`
--

INSERT INTO `follows` (`follower_id`, `followed_id`) VALUES
(3, 4),
(4, 3),
(5, 3),
(5, 4);

-- --------------------------------------------------------

--
-- Table structure for table `login_attempts`
--

CREATE TABLE `login_attempts` (
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `login_attempts`
--

INSERT INTO `login_attempts` (`user_id`, `created_at`) VALUES
(3, '2023-02-10 16:02:56');

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `content` varchar(255) NOT NULL,
  `seen` tinyint(1) DEFAULT 0,
  `href` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `user_id`, `content`, `seen`, `href`, `created_at`) VALUES
(89, 4, 'fraso ha iniziato a seguirti.', 1, 'profile.php?id=3', '2023-02-09 11:59:25'),
(91, 4, 'fraso ha aggiunto un commento al tuo post', 1, 'post.php?id=110', '2023-02-09 18:12:54'),
(93, 3, 'rikisan96 ha appena votato il tuo post.', 1, 'post.php?id=117', '2023-02-12 00:41:52'),
(94, 4, 'fraso ha risposto al tuo commento sul post', 1, 'post.php?id=109', '2023-02-12 00:53:07'),
(95, 3, 'rikisan96 ha appena votato il tuo post.', 1, 'post.php?id=118', '2023-02-12 14:55:52'),
(96, 3, 'rikisan96 ha appena votato il tuo post.', 0, 'post.php?id=118', '2023-02-12 17:47:06'),
(97, 4, 'fraso ha appena votato il tuo post.', 0, 'post.php?id=120', '2023-02-12 21:42:05'),
(98, 4, 'meemmo ha iniziato a seguirti.', 0, 'profile.php?id=5', '2023-02-12 23:44:26'),
(99, 3, 'meemmo ha iniziato a seguirti.', 0, 'profile.php?id=5', '2023-02-12 23:44:28'),
(101, 4, 'meemmo ha aggiunto un commento al tuo post', 0, 'post.php?id=120', '2023-02-13 14:41:40'),
(102, 4, 'fraso ha aggiunto un commento al tuo post', 0, 'post.php?id=120', '2023-02-13 14:52:50'),
(103, 4, 'fraso ha aggiunto un commento al tuo post', 0, 'post.php?id=120', '2023-02-13 14:52:54'),
(104, 5, 'fraso ha risposto al tuo commento sul post', 0, 'post.php?id=120', '2023-02-13 14:52:54'),
(105, 5, 'rikisan96 ha risposto al tuo commento sul post', 0, 'post.php?id=120', '2023-02-13 14:53:54'),
(106, 3, 'rikisan96 ha risposto al tuo commento sul post', 0, 'post.php?id=120', '2023-02-13 14:54:00'),
(107, 4, 'fraso ha appena votato il tuo post.', 0, 'post.php?id=120', '2023-02-13 14:58:10');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `body` text NOT NULL,
  `picture` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `parent_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `user_id`, `body`, `picture`, `created_at`, `parent_id`) VALUES
(119, 3, 'Il mio personaggio preferito in Jujutsu Kaisen Ã¨ sicuramente Gojo.\n\n#anime', 'WallpaperDog-20512721_2.jpg', '2023-02-12 16:52:08', NULL),
(120, 4, 'Lorem ipsum dolor sit amet, officia excepteur ex fugiat reprehenderit enim labore culpa sint ad nisi Lorem pariatur mollit ex esse exercitation amet. Nisi anim cupidatat excepteur officia. Reprehenderit nostrud nostrud ipsum Lorem est aliquip amet voluptate voluptate dolor minim nulla est proident. Nostrud officia pariatur ut officia. Sit irure elit esse ea nulla sunt ex occaecat reprehenderit commodo officia dolor Lorem duis laboris cupidatat officia voluptate. Culpa proident adipisicing id nulla nisi laboris ex in Lorem sunt duis officia eiusmod. Aliqua reprehenderit commodo ex non excepteur duis sunt velit enim. Voluptate laboris sint cupidatat ullamco ut ea consectetur et est culpa et culpa duis.\n\n#globit #social', NULL, '2023-02-12 16:53:24', NULL),
(121, 5, 'Super spettacolo ieri sera!\n\nhttps://www.youtube.com/watch?v=7I6pxfdMwzU', NULL, '2023-02-13 13:42:46', NULL),
(122, 3, 'Questo Ã¨ il link al repository ufficiale\r\n\r\nhttps://github.com/fraso-dev/globit', NULL, '2023-02-13 13:58:02', NULL),
(123, 5, 'Nisi anim cupidatat excepteur officia.', NULL, '2023-02-13 13:58:51', 120);

-- --------------------------------------------------------

--
-- Table structure for table `post_shares`
--

CREATE TABLE `post_shares` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `post_shares`
--

INSERT INTO `post_shares` (`id`, `user_id`, `post_id`, `created_at`) VALUES
(5, 3, 112, '2023-02-09 19:00:25'),
(6, 3, 110, '2023-02-10 14:06:49'),
(7, 5, 120, '2023-02-13 13:58:51');

-- --------------------------------------------------------

--
-- Table structure for table `post_tags`
--

CREATE TABLE `post_tags` (
  `post_id` int(11) NOT NULL,
  `tag_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `post_tags`
--

INSERT INTO `post_tags` (`post_id`, `tag_id`) VALUES
(119, 9),
(120, 10),
(120, 11);

-- --------------------------------------------------------

--
-- Table structure for table `post_votes`
--

CREATE TABLE `post_votes` (
  `user_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `post_votes`
--

INSERT INTO `post_votes` (`user_id`, `post_id`, `created_at`) VALUES
(3, 119, '2023-02-13 11:52:16'),
(3, 120, '2023-02-13 13:58:10');

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

CREATE TABLE `tags` (
  `id` int(11) NOT NULL,
  `tag` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tags`
--

INSERT INTO `tags` (`id`, `tag`) VALUES
(9, 'anime'),
(10, 'globit'),
(11, 'social');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` char(128) NOT NULL,
  `salt` char(128) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `profile_picture` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `salt`, `full_name`, `email`, `profile_picture`, `description`, `created_at`) VALUES
(3, 'fraso', '3a2bba3fa37ff5566460dfe1a24248c33db6d8bdacbb2121190a224591a11b10509b97990841d1a2f4669c971c5a45148fb758754280b57e8cde7e99a0f20b59', '103f882bbbb7c15dda46d92d9e9dc9ae78fedc1b70953bdea4ad849c1833278b945e3ca7e1518685d109bc8778e73458d6c3cc3db868da9e48397d51c75af0f7', 'Francesco Raso', 'francesco.raso@studio.unibo.it', 'gojo1.jpg', 'Studente di Ingegneria e Scienze Informatiche all\'universitÃ  degli studi di Cesena', '2023-01-28 13:00:10'),
(4, 'rikisan96', '8d605c70a4450f76a9cbf08e91b857d7e6075cb8e4a01502e603491b39d294273749ae8f2d1e1e208efe145ff6c11db69e1636e5dc69a0324e262cb198c7fbf3', 'f29477dba683fe7bf0c956d8ba33bbc38d7d4191db734b65998d0918a6bba65b3617f39b880055d32b4e7a0bb2b7062129735c5f91c98fbbc1a82e90932b1667', 'Riccardo Cutruneo', 'cutrux@neo.it', 'giyu-min.png', 'Aspirante web developer', '2023-01-29 15:52:00'),
(5, 'meemmo', '544ead8d8de40f508ce335ef97c7bfedf95dc246fd52e5b552e7c2d104bf4f0aee79b5075cf2c75d1c6d7d9e91291666e2cb347ef52e20854825d2ca5465e273', '0e124e95da021f16069384aadb188ba1e0438070e3d70267666ff3e75dfaa0772f42c2f2554780f33f208c2f3551b79a3085f769034fc5b2f0019cb6cd809af4', 'Domenico Bivona', 'meemmo@bivona.it', 'tanjiro-min.png', 'Amo la musica. Libero professionista.', '2023-02-12 22:38:58');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `post_id` (`post_id`),
  ADD KEY `parent_id` (`parent_id`),
  ADD KEY `fk_post_owner_id` (`post_owner_id`);

--
-- Indexes for table `comment_votes`
--
ALTER TABLE `comment_votes`
  ADD PRIMARY KEY (`user_id`,`comment_id`),
  ADD KEY `comment_id` (`comment_id`);

--
-- Indexes for table `follows`
--
ALTER TABLE `follows`
  ADD PRIMARY KEY (`follower_id`,`followed_id`),
  ADD UNIQUE KEY `follower_id` (`follower_id`,`followed_id`),
  ADD KEY `followed_id` (`followed_id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `post_shares`
--
ALTER TABLE `post_shares`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `post_tags`
--
ALTER TABLE `post_tags`
  ADD PRIMARY KEY (`post_id`,`tag_id`),
  ADD KEY `tag_id` (`tag_id`);

--
-- Indexes for table `post_votes`
--
ALTER TABLE `post_votes`
  ADD PRIMARY KEY (`user_id`,`post_id`),
  ADD KEY `post_id` (`post_id`);

--
-- Indexes for table `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `tag` (`tag`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=108;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=124;

--
-- AUTO_INCREMENT for table `post_shares`
--
ALTER TABLE `post_shares`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tags`
--
ALTER TABLE `tags`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `comments_ibfk_4` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`),
  ADD CONSTRAINT `comments_ibfk_5` FOREIGN KEY (`parent_id`) REFERENCES `comments` (`id`),
  ADD CONSTRAINT `fk_post_owner_id` FOREIGN KEY (`post_owner_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `comment_votes`
--
ALTER TABLE `comment_votes`
  ADD CONSTRAINT `comment_votes_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `comment_votes_ibfk_2` FOREIGN KEY (`comment_id`) REFERENCES `comments` (`id`);

--
-- Constraints for table `follows`
--
ALTER TABLE `follows`
  ADD CONSTRAINT `follows_ibfk_1` FOREIGN KEY (`follower_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `follows_ibfk_2` FOREIGN KEY (`followed_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `notifications_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `post_tags`
--
ALTER TABLE `post_tags`
  ADD CONSTRAINT `post_tags_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`),
  ADD CONSTRAINT `post_tags_ibfk_2` FOREIGN KEY (`tag_id`) REFERENCES `tags` (`id`);

--
-- Constraints for table `post_votes`
--
ALTER TABLE `post_votes`
  ADD CONSTRAINT `post_votes_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `post_votes_ibfk_2` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
