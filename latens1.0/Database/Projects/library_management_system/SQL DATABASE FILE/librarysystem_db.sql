-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 13, 2024 at 02:04 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `librarysystem_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `author` varchar(255) NOT NULL,
  `year` int(11) NOT NULL,
  `isbn` varchar(255) NOT NULL,
  `status` enum('available','borrowed') DEFAULT 'available',
  `borrower_id` int(11) DEFAULT NULL,
  `borrow_count` int(11) DEFAULT 0,
  `genre` varchar(50) DEFAULT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`id`, `title`, `author`, `year`, `isbn`, `status`, `borrower_id`, `borrow_count`, `genre`, `description`) VALUES
(1, 'Rich Dad Poor Dad', 'Robert Kiyosaki', 2009, '158620368920', 'available', NULL, 1, 'FINANCIAL BOOK', 'Learn How To Invest'),
(2, 'To Kill a Mockingbird', 'Harper Lee', 1960, '9780061120084', 'borrowed', 2, 0, 'CLASSIC', 'A gripping novel set in the racially segregated South, focusing on themes of injustice and empathy.'),
(3, '1984', 'George Orwell', 1949, '9780451524935', 'borrowed', 6, 1, 'DYSTOPIAN', 'A totalitarian regime controls every aspect of life, and one man tries to break free from the oppression.'),
(4, 'Pride and Prejudice', 'Jane Austen', 1813, '9780141040349', 'borrowed', 2, 3, 'ROMANCE', 'A classic tale of love, class, and prejudice, set in early 19th-century England.'),
(5, 'The Catcher in the Rye', 'J.D. Salinger', 1951, '9780316769488', 'borrowed', 2, 0, 'CLASSIC', 'A young man struggles with alienation and confusion in post-war America.'),
(6, 'The Great Gatsby', 'F. Scott Fitzgerald', 1925, '9780743273565', 'available', NULL, 0, 'CLASSIC', 'The rise and fall of a mysterious millionaire, exploring themes of the American Dream and love.'),
(7, 'Moby-Dick', 'Herman Melville', 1851, '9781853260087', 'available', NULL, 1, 'CLASSIC', 'A tale of obsession, revenge, and the power of nature, set on the high seas.'),
(8, 'War and Peace', 'Leo Tolstoy', 1869, '9780199232765', 'borrowed', 2, 0, 'HISTORICAL FICTION', 'A monumental story of Napoleon’s invasion of Russia, exploring war, peace, and human nature.'),
(9, 'The Odyssey', 'Homer', 1998, '9780143039952', 'borrowed', 5, 2, 'EPIC POEM', 'An ancient Greek epic poem about the adventures of Odysseus on his journey home after the Trojan War.'),
(10, 'The Hobbit', 'J.R.R. Tolkien', 1937, '9780547928227', 'available', NULL, 1, 'FANTASY', 'A young hobbit embarks on an epic quest to destroy a powerful ring and save Middle-earth.'),
(11, 'The Lord of the Rings', 'J.R.R. Tolkien', 1954, '9780618640157', 'available', NULL, 0, 'FANTASY', 'The epic journey of a young hobbit and his companions to destroy a magical ring and defeat dark forces.'),
(12, 'Harry Potter and the Sorcerer\'s Stone', 'J.K. Rowling', 1997, '9780439708180', 'borrowed', 2, 0, 'FANTASY', 'A young wizard discovers his magical heritage and begins his journey to defeat the dark wizard who killed his parents.'),
(13, 'The Da Vinci Code', 'Dan Brown', 2003, '9780307474278', 'borrowed', 5, 1, 'THRILLER', 'A symbologist and a cryptologist uncover a secret society’s hidden code that could change history forever.'),
(14, 'The Alchemist', 'Paulo Coelho', 1988, '9780061122415', 'available', NULL, 3, 'ALLEGORICAL', 'A philosophical tale of a young shepherd who seeks to find the meaning of life and his personal legend.'),
(15, 'The Hunger Games', 'Suzanne Collins', 2008, '9780439023528', 'borrowed', 6, 1, 'SCI-FI', 'In a dystopian future, a young girl fights for survival in a society where teenagers must compete in a deadly game.'),
(16, 'The Shining', 'Stephen King', 1977, '9780307743657', 'borrowed', 5, 1, 'HORROR', 'A psychological horror story where a family is haunted by paranormal events in a remote hotel.');

-- --------------------------------------------------------

--
-- Table structure for table `borrowed_books`
--

CREATE TABLE `borrowed_books` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  `borrowed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `borrowed_books`
--

INSERT INTO `borrowed_books` (`id`, `user_id`, `book_id`, `borrowed_at`) VALUES
(5, 2, 1, '2024-11-07 12:06:30');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','user') DEFAULT 'user',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role`, `created_at`, `email`) VALUES
(1, 'maina', '$2y$10$YbSlypoZiO77ExdeFKvdk.gX0Ck2vuKhvmMbhKFCp3IZQi.U63Kcu', 'admin', '2024-11-07 10:01:04', 'maina123@gmail.com'),
(2, 'peter', '$2y$10$N7gMuzQL61y9iL9bcnN5CORx2v2sh37vxjOvBEWwP1/DMJffytspW', 'user', '2024-11-07 10:02:28', 'peter123@gmail.com'),
(5, 'mary', '$2y$10$HxfrQmi5ovA5nW7qjwgw4uEdK4kuyAxseIzDnAmz1zGR7HMCZPuqO', 'user', '2024-11-08 08:25:45', 'mary123@gmail.com'),
(6, 'martin', '$2y$10$ud26/c3cJgyLc2WqC6x15.4oRUFEDrLqItSL9acvdbD4707G/s.o6', 'user', '2024-11-08 08:52:50', 'martin123@gmail.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_borrower` (`borrower_id`);

--
-- Indexes for table `borrowed_books`
--
ALTER TABLE `borrowed_books`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `book_id` (`book_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `borrowed_books`
--
ALTER TABLE `borrowed_books`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `books`
--
ALTER TABLE `books`
  ADD CONSTRAINT `fk_borrower` FOREIGN KEY (`borrower_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `borrowed_books`
--
ALTER TABLE `borrowed_books`
  ADD CONSTRAINT `borrowed_books_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `borrowed_books_ibfk_2` FOREIGN KEY (`book_id`) REFERENCES `books` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
