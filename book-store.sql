-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 02, 2024 at 12:54 PM
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
-- Database: `book-store`
--
CREATE DATABASE IF NOT EXISTS `book-store` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `book-store`;

-- --------------------------------------------------------

--
-- Table structure for table `address_code`
--

CREATE TABLE `address_code` (
  `id` int(11) NOT NULL,
  `city` varchar(100) NOT NULL,
  `zip_code` varchar(20) NOT NULL,
  `state` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `address_code`
--

INSERT INTO `address_code` (`id`, `city`, `zip_code`, `state`) VALUES
(1, 'Los Angeles', '90001', 'California '),
(2, 'Los Angeles', '90001', 'California');

-- --------------------------------------------------------

--
-- Table structure for table `authors`
--

CREATE TABLE `authors` (
  `id` int(11) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `authors`
--

INSERT INTO `authors` (`id`, `first_name`, `last_name`, `email`) VALUES
(1, 'John', 'Doe', 'john.doe@example.com'),
(2, 'Jane', 'Smith', 'jane.smith@example.com'),
(3, 'Emily', 'Johnson', 'emily.johnson@example.com'),
(4, 'Michael', 'Brown', 'michael.brown@example.com'),
(5, 'Sarah', 'Davis', 'sarah.davis@example.com'),
(6, 'David', 'Wilson', 'david.wilson@example.com'),
(7, 'Laura', 'Garcia', 'laura.garcia@example.com'),
(8, 'Robert', 'Martinez', 'robert.martinez@example.com'),
(9, 'Linda', 'Anderson', 'linda.anderson@example.com'),
(10, 'James', 'Taylor', 'james.taylor@example.com');

-- --------------------------------------------------------

--
-- Table structure for table `book`
--

CREATE TABLE `book` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `ISBN_code` varchar(20) NOT NULL,
  `short_description` text NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `publisher_name` varchar(255) NOT NULL,
  `publisher_address` varchar(255) NOT NULL,
  `publish_date` date NOT NULL,
  `genre_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `book`
--

INSERT INTO `book` (`id`, `title`, `image`, `ISBN_code`, `short_description`, `price`, `publisher_name`, `publisher_address`, `publish_date`, `genre_id`) VALUES
(1, 'The Galactic Journey', 'galactic-journey.jpg', 'ISBN-12345', 'An epic space adventure.', 19.99, 'Universal Publishers', '123 Space Lane', '2024-01-01', 1),
(2, 'The Enchanted Forest', 'enchanted-forest.jpg', 'ISBN-12346', 'A tale of magic and mystery in a mystical forest.', 15.99, 'Fantasy Worlds', '456 Magic St.', '2024-02-01', 2),
(3, 'The Mystery of the Ancient Manor', 'ancient-manor.jpg', 'ISBN-12347', 'A detective story set in a mysterious old house.', 12.99, 'Mystery Press', '789 Puzzle Rd.', '2024-03-01', 3),
(4, 'Love in the Time of Dragons', 'time-of-dragons.jpg', 'ISBN-12348', 'A romantic novel set in a world where dragons exist.', 9.99, 'Romance Novel Inc.', '101 Heart St.', '2024-04-01', 4),
(5, 'The Last Emperor', 'last-emperor.jpg', 'ISBN-12349', 'Historical fiction about the fall of an empire.', 22.99, 'History Books Ltd.', '202 Past Ave.', '2024-05-01', 5),
(6, 'Stars Beyond', 'stars-beyond.jpg', 'ISBN-12350', 'Exploring new worlds beyond our stars.', 18.99, 'Galactic Reads', '303 Spaceway', '2024-06-01', 1),
(7, 'Wizards Quest', 'wizards-quest.jpg', 'ISBN-12351', 'A wizard’s journey to uncover ancient magic.', 14.99, 'Magical Tales', '404 Spell Rd.', '2024-07-01', 2),
(8, 'The Unsolved Case', 'unsolved-case.jpg', 'ISBN-12352', 'A thrilling chase to solve an unsolved case.', 13.99, 'Detective Stories', '505 Clue Blvd.', '2024-08-01', 3),
(9, 'Hearts Whisper', 'hearts-whisper.jpg', 'ISBN-12353', 'A story of finding love in unexpected places.', 11.99, 'Love Stories Co.', '606 Cupid Lane', '2024-09-01', 2);

-- --------------------------------------------------------

--
-- Table structure for table `books_authors`
--

CREATE TABLE `books_authors` (
  `book_id` int(11) NOT NULL,
  `author_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `books_authors`
--

INSERT INTO `books_authors` (`book_id`, `author_id`) VALUES
(1, 3),
(2, 1),
(3, 5),
(4, 2),
(5, 7),
(6, 4),
(7, 6),
(8, 8),
(9, 10);

-- --------------------------------------------------------

--
-- Table structure for table `genres`
--

CREATE TABLE `genres` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `status` varchar(50) NOT NULL,
  `popular` tinyint(1) NOT NULL,
  `image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `genres`
--

INSERT INTO `genres` (`id`, `name`, `description`, `status`, `popular`, `image`) VALUES
(1, 'Science Fiction', 'Genre focusing on futuristic concepts, space exploration, and technological advancements.', 'active', 1, 'sci-fi.jpg'),
(2, 'Fantasy', 'Genre featuring magical or supernatural elements that do not exist in the real world.', 'active', 1, 'fantasy.jpg'),
(3, 'Mystery', 'Genre involving suspenseful and often crime-related plots.', 'active', 1, 'mystery.jpg'),
(4, 'Romance', 'Genre centered around romantic relationships between characters.', 'active', 0, 'romance.jpg'),
(5, 'Historical Fiction', 'Genre set in the past, often incorporating real historical figures or events.', 'active', 0, 'historical-fiction.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `shopping_cart`
--

CREATE TABLE `shopping_cart` (
  `id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `total` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `birth_date` date NOT NULL,
  `gender` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `street_address` varchar(255) NOT NULL,
  `address_code_id` int(11) DEFAULT NULL,
  `profile_picture` varchar(255) NOT NULL,
  `user_type` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `birth_date`, `gender`, `email`, `password`, `street_address`, `address_code_id`, `profile_picture`, `user_type`) VALUES
(1, 'John', 'Doe', '2004-12-16', 'male', 'john@mail.com', '96cae35ce8a9b0244178bf28e4966c2ce1b8385723a96a6b838858cdd6ca0a1e', 'Sunset Boulevard', 1, 'user.jpg', 'user'),
(2, 'Admin', 'Admin', '1996-02-08', 'female', 'admin@mail.com', '96cae35ce8a9b0244178bf28e4966c2ce1b8385723a96a6b838858cdd6ca0a1e', 'Hollywood Boulevard', 2, 'user.jpg', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `address_code`
--
ALTER TABLE `address_code`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `authors`
--
ALTER TABLE `authors`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `book`
--
ALTER TABLE `book`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `ISBN_code` (`ISBN_code`),
  ADD KEY `genre_id` (`genre_id`);

--
-- Indexes for table `books_authors`
--
ALTER TABLE `books_authors`
  ADD PRIMARY KEY (`book_id`,`author_id`),
  ADD KEY `author_id` (`author_id`);

--
-- Indexes for table `genres`
--
ALTER TABLE `genres`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shopping_cart`
--
ALTER TABLE `shopping_cart`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `book_id` (`book_id`,`user_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `address_code_id` (`address_code_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `address_code`
--
ALTER TABLE `address_code`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `authors`
--
ALTER TABLE `authors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `book`
--
ALTER TABLE `book`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `genres`
--
ALTER TABLE `genres`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `shopping_cart`
--
ALTER TABLE `shopping_cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `book`
--
ALTER TABLE `book`
  ADD CONSTRAINT `book_ibfk_1` FOREIGN KEY (`genre_id`) REFERENCES `genres` (`id`);

--
-- Constraints for table `books_authors`
--
ALTER TABLE `books_authors`
  ADD CONSTRAINT `books_authors_ibfk_1` FOREIGN KEY (`book_id`) REFERENCES `book` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `books_authors_ibfk_2` FOREIGN KEY (`author_id`) REFERENCES `authors` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `shopping_cart`
--
ALTER TABLE `shopping_cart`
  ADD CONSTRAINT `shopping_cart_ibfk_1` FOREIGN KEY (`book_id`) REFERENCES `book` (`id`),
  ADD CONSTRAINT `shopping_cart_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`address_code_id`) REFERENCES `address_code` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
