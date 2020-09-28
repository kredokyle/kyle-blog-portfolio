-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 28, 2020 at 03:07 AM
-- Server version: 10.4.8-MariaDB
-- PHP Version: 7.3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `blog`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE `accounts` (
  `id` int(11) NOT NULL,
  `username` varchar(15) NOT NULL,
  `password` varchar(100) NOT NULL,
  `role` varchar(1) NOT NULL DEFAULT 'U'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`id`, `username`, `password`, `role`) VALUES
(1, 'mark', '$2y$10$kh3AmgoiIqLcQ7KVjDQOnOqN96EBK1qpSGPgtiBbPHuUMlWsSXYfy', 'U'),
(2, 'kyle', '$2y$10$/ubGwzUJ0Ncji58J/U9l0uh5vdb/E0sY/KtDo1iPXXEjwFvT9/GgG', 'A'),
(10, 'asd', '$2y$10$hHOFJUMYkFPxRIn.RgIPnu/bqwjS6oRI/X5sYAKKE9ct5YMAtCNY2', 'U'),
(12, 'test', '$2y$10$8Hd1jFIwpI6QmPzLdncL9uDKODJyfIlcfumvm.j2M7aQ0yIXCicGW', 'U');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`) VALUES
(1, 'Lifestyle'),
(2, 'Food'),
(3, 'Travel'),
(4, 'Fitness'),
(5, 'Events');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` longtext NOT NULL,
  `date_posted` date NOT NULL,
  `account_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `title`, `content`, `date_posted`, `account_id`, `category_id`) VALUES
(1, 'Privet \"Russia\"!', 'Since I was 15, due to excessive \'Red Alert\', I\'ve always dreamed to travel to Russia.', '2020-07-22', 2, 1),
(2, 'Sun\'s Out, Bun\'s Out', 'You know those late afternoons wherein you feel like you’ve been working the whole day, stuck in your workstation and tempted to take a quick breather? Your mouth starts to water and you feel your stomach grumbling—you head out for a quick merienda break. You walk around the area and you suddenly want to sink your teeth into a thick, juicy burger. Because come on, there’s nothing a burger can’t fix, right?', '2020-07-17', 2, 2),
(3, 'Lan Kwai Fong', 'This week we launched the fourth leg of The Filo Bloggers United. To those who aren’t familiar, The Filo Bloggers United is a collaboration between five (5) Filipino menswear bloggers wherein we agree on a specific theme each month and we do our own interpretation by coming up with a look on our respective blogs. The idea of this little project of ours is to see how each blogger is different from the other–and of course, give you options when dressing up. Let’s face it, you might be a loyal reader of my blog but you’re not really able to relate to my style. This is when The Filo Bloggers United comes in.', '2020-07-22', 2, 3);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `address` varchar(255) NOT NULL,
  `contact_number` varchar(100) NOT NULL,
  `avatar` varchar(100) DEFAULT NULL,
  `bio` text DEFAULT NULL,
  `account_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `address`, `contact_number`, `avatar`, `bio`, `account_id`) VALUES
(1, 'Mark', 'Lee', 'Cebu City', '0909123123', NULL, NULL, 1),
(2, 'Kyle', 'Nurville', 'Davao City', '090909', '04.jpg', 'Kyle is a Lifestyle + Travel + Food blogger based in Cebu. Subscribe to my newsletter for weekly updates!', 2),
(10, 'afds', 'fs', 'sfwer', 'rwe', NULL, NULL, 10),
(12, 'ftest', 'ltest', 'addtest', 'contest', NULL, NULL, 12);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accounts`
--
ALTER TABLE `accounts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
