-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 14, 2025 at 09:14 AM
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
-- Database: `todolist`
--

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `password_resets`
--

INSERT INTO `password_resets` (`id`, `email`, `token`, `created_at`) VALUES
(1, 'mariamahmed6@yahoo.com', 'cc4dc7127ab42b4743def9a861fb9bbf4589d0b043513bfcf835e930a2c967ca', '2025-05-11 21:01:51');

-- --------------------------------------------------------

--
-- Table structure for table `signup`
--

CREATE TABLE `signup` (
  `username` varchar(30) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `signup`
--

INSERT INTO `signup` (`username`, `email`, `password`) VALUES
('mariem ahmed', 'mariamahmed6@yahoo.com', '$2y$10$UuGoLIvKzz0Ov0oO31l3y.8mEyOpPu9j6jArfYBvJYzdKAH7vpYoO'),
('nourangad', 'nourangad89@yahoo.com', '$2y$10$BOcTPA/iDKBs4uYjzxbQSuABuru3L9tRGp2LUG836g3EsKnB2osjG');

-- --------------------------------------------------------

--
-- Table structure for table `task`
--

CREATE TABLE `task` (
  `id` int(11) NOT NULL,
  `tasktitle` varchar(50) NOT NULL,
  `description` varchar(200) NOT NULL,
  `duedate` date NOT NULL,
  `priority` varchar(10) NOT NULL,
  `status` varchar(50) DEFAULT NULL,
  `username` varchar(80) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `task`
--

INSERT INTO `task` (`id`, `tasktitle`, `description`, `duedate`, `priority`, `status`, `username`) VALUES
(1, 'work', 'do work', '2025-05-11', 'medium', 'completed', 'mariem ahmed'),
(3, 'hh', 'hh', '2025-05-13', 'high', 'completed', 'nourangad'),
(4, 'gdfg', 'gdgd', '2025-05-13', 'high', 'uncompleted', 'nourangad'),
(5, 'gdfg', 'gdgd', '2025-05-13', 'high', ' uncompleted', 'nourangad'),
(6, '', 'gdgd', '0000-00-00', 'high', '', 'nourangad'),
(7, 'fgdg', 'gfdg', '2025-05-13', 'high', ' uncompleted', 'nourangad'),
(8, 'fgdg', 'gfdg', '2025-05-13', 'high', ' uncompleted', 'nourangad'),
(11, 'لللل', 'لللللللل', '2025-05-13', 'high', ' uncompleted', 'nourangad');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `signup`
--
ALTER TABLE `signup`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `task`
--
ALTER TABLE `task`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `password_resets`
--
ALTER TABLE `password_resets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `task`
--
ALTER TABLE `task`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
