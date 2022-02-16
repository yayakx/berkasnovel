-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 30, 2021 at 06:40 AM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.1.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_neonovel`
--

-- --------------------------------------------------------

--
-- Table structure for table `ft`
--

CREATE TABLE `ft` (
  `id_ft` int(11) NOT NULL,
  `nama_ft` varchar(50) NOT NULL,
  `url_ft` varchar(100) NOT NULL,
  `owner_ft` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ft`
--

INSERT INTO `ft` (`id_ft`, `nama_ft`, `url_ft`, `owner_ft`) VALUES
(1, 'Maou Novel', 'https://maounovel.blogspot.com/rss.xml', 'Auliyaur Rahman'),
(2, 'Kimi Novel', 'https://www.kiminovel.com/rss.xml', 'Kimi'),
(3, 'Kaito Novel', 'https://zerokaito.blogspot.com/rss.xml', 'Kaito'),
(4, 'LW Novel', 'https://lwnovels.blogspot.com/rss.xml', 'Setia'),
(5, 'Darktranslation', 'https://darktranslation.com/feed/', 'Dark Legiun'),
(6, '4scanlation', 'https://4scanlation.com/feed/', '4scan'),
(9, 'Isekai Novel', 'https://isekaitranslation.blogspot.com//rss.xml', 'Isekai Novel');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ft`
--
ALTER TABLE `ft`
  ADD PRIMARY KEY (`id_ft`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ft`
--
ALTER TABLE `ft`
  MODIFY `id_ft` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
