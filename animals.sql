-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 19, 2022 at 10:00 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `animals`
--

-- --------------------------------------------------------

--
-- Table structure for table `info`
--

CREATE TABLE `info` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `category` varchar(100) NOT NULL,
  `image` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `life-span` varchar(100) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `info`
--

INSERT INTO `info` (`id`, `name`, `category`, `image`, `description`, `life-span`, `date`) VALUES
(11, 'Lion', 'Omnivores', 'lion.jpg', 'King of jungle', '5-10', '2022-06-18 18:30:00'),
(12, 'Tiger', 'Omnivores', 'tiger.jpg', 'National Animal', '5-10', '2022-06-18 18:30:00'),
(13, 'Monkey', 'Herbivores', 'monkey.jpg', 'Lives in Jungle', '1-5', '2022-06-18 18:30:00'),
(14, 'Elephant', 'Herbivores', 'elephant.jpg', 'Big Animal', '1-5', '2022-06-18 18:30:00'),
(15, 'Cow', 'Herbivores', 'cow.jpg', 'Pet Animal', '10+', '2022-06-18 18:30:00'),
(16, 'Goat', 'Herbivores', 'goat.jpg', 'Pet animal', '1-5', '2022-06-18 18:30:00'),
(17, 'Zebra', 'Carnivores', 'download.jpg', 'Wild animal', '0-1', '2022-06-18 18:30:00');

-- --------------------------------------------------------

--
-- Table structure for table `visitor`
--

CREATE TABLE `visitor` (
  `id` int(11) NOT NULL,
  `browser_name` varchar(255) NOT NULL,
  `browser_version` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `os` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `ref` varchar(255) NOT NULL,
  `added_on` date DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `visitor`
--

INSERT INTO `visitor` (`id`, `browser_name`, `browser_version`, `type`, `os`, `url`, `ref`, `added_on`) VALUES
(76, 'Chrome', '102.0.0.0', 'PC', 'Window', 'http//localhost/assignment/submission.php', '', '2022-06-19'),
(77, 'Chrome', '102.0.0.0', 'PC', 'Window', 'http//localhost/assignment/submission.php', '', '2022-06-19'),
(78, 'Chrome', '102.0.0.0', 'PC', 'Window', 'http//localhost/assignment/submission.php', '', '2022-06-19'),
(79, 'Chrome', '102.0.0.0', 'PC', 'Window', 'http//localhost/assignment/submission.php', '', '2022-06-19');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `info`
--
ALTER TABLE `info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `visitor`
--
ALTER TABLE `visitor`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `info`
--
ALTER TABLE `info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `visitor`
--
ALTER TABLE `visitor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
