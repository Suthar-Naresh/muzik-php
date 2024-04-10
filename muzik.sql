-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 16, 2022 at 12:01 PM
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
-- Database: `muzik`
--

-- --------------------------------------------------------

--
-- Table structure for table `likedsongs`
--

CREATE TABLE `likedsongs` (
  `id` int(11) NOT NULL,
  `songid` text NOT NULL,
  `userid` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `likedsongs`
--

INSERT INTO `likedsongs` (`id`, `songid`, `userid`) VALUES
(1, '634bcdf26c6762.34674225', '634bca66132083.35012822'),
(2, '634bcbb4499ec3.57982633', '634bca66132083.35012822'),
(3, '634bce535fd163.20273599', '634bca66132083.35012822');

-- --------------------------------------------------------

--
-- Table structure for table `playlist`
--

CREATE TABLE `playlist` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `uid` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `playlist`
--

INSERT INTO `playlist` (`id`, `name`, `uid`) VALUES
(1, 'Anime', '634bca66132083.35012822');

-- --------------------------------------------------------

--
-- Table structure for table `playlistsongs`
--

CREATE TABLE `playlistsongs` (
  `iid` int(11) NOT NULL,
  `playid` int(11) NOT NULL,
  `sid` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `playlistsongs`
--

INSERT INTO `playlistsongs` (`iid`, `playid`, `sid`) VALUES
(1, 1, '634bcbb4499ec3.57982633'),
(2, 1, '634bcdf26c6762.34674225');

-- --------------------------------------------------------

--
-- Table structure for table `songs`
--

CREATE TABLE `songs` (
  `id` varchar(255) NOT NULL,
  `name` text NOT NULL,
  `genre` text NOT NULL,
  `creator` text NOT NULL,
  `movie` text NOT NULL,
  `songpath` text NOT NULL,
  `posterpath` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `songs`
--

INSERT INTO `songs` (`id`, `name`, `genre`, `creator`, `movie`, `songpath`, `posterpath`) VALUES
('634bcb5df1ad07.54604111', 'Blue Eyes', 'Party', 'YoYo Honey Singh', 'Blue Eyes', 'uploads/634bcb5df1aac7.27002447.mp3', 'uploads/634bcb5df1aca2.60670150.jpg'),
('634bcbb4499ec3.57982633', 'Lost In Paradice', 'Anime', 'ALI', 'Jujutsu Kaisen', 'uploads/634bcbb4499d44.91541291.mp3', 'uploads/634bcbb4499e93.53634465.jpg'),
('634bcc170bc216.98414557', 'Despacito', 'HipHop', 'Louse', 'Despacito', 'uploads/634bcc170bc099.51046466.mp3', 'uploads/634bcc170bc1e5.70004828.jpg'),
('634bcca3ef8203.67736918', 'Chatur Naar', 'Comedy', 'Kishor Kumar', 'Padosan', 'uploads/634bcca3ef8073.34426034.mp3', 'uploads/634bcca3ef81c0.07796048.jpg'),
('634bcce760ec03.28750120', 'Ice Cream', 'Party', 'Himesh', 'The Expose', 'uploads/634bcce760ea74.02414404.mp3', 'uploads/634bcce760ebc4.96423966.jpg'),
('634bcd4ca0ba06.79241539', 'Jai Ho', 'Bollywood', 'ARR', 'Slumdog Millionaire', 'uploads/634bcd4ca0b7e4.77993618.mp3', 'uploads/634bcd4ca0b9c5.25821476.jpg'),
('634bcdd1ea3515.21753297', 'Kesariya', 'Bollywood', 'Singer', 'Movie', 'uploads/634bcdd1ea3366.57748032.mp3', 'uploads/634bcdd1ea34d4.72226350.jpg'),
('634bcdf26c6762.34674225', 'Hero', 'Anime', 'RAP', 'One Punch', 'uploads/634bcdf26c65f5.21866325.mp3', 'uploads/634bcdf26c6723.12846687.jpg'),
('634bce535fd163.20273599', 'Maa Tujhe Salaam', 'Patriotic', 'ARR', 'Vande Mataram', 'uploads/634bce535fcfd6.39097027.mp3', 'uploads/634bce535fd131.25067754.jpg'),
('634bce89d11484.20717313', 'Akatsuki Theme Song', 'Anime', 'Mashashi', 'Naruto', 'uploads/634bce89d11262.61736939.mp3', 'uploads/634bce89d113f0.95698436.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userid` varchar(255) NOT NULL,
  `name` text NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userid`, `name`, `email`, `password`) VALUES
('634bca66132083.35012822', 'Kakashi', 'kakashi@leaf.ninja', '$2y$10$Zg8LLs50pvXI0dBv8NbnqeQJ1pL696EpqnZxweSdjyRPWANxWx.Ai'),
('634bd3f967be57.93911460', 'Gojo', 'gojo@jujutsu.tech', '$2y$10$Rg5HxivNJSUdeWYhUrxAbOTpU..sKvEyq9voltB8/hTykeVwtIemK');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `likedsongs`
--
ALTER TABLE `likedsongs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `playlist`
--
ALTER TABLE `playlist`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `playlistsongs`
--
ALTER TABLE `playlistsongs`
  ADD PRIMARY KEY (`iid`);

--
-- Indexes for table `songs`
--
ALTER TABLE `songs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `songpath` (`songpath`) USING HASH,
  ADD UNIQUE KEY `posterpath` (`posterpath`) USING HASH;

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userid`),
  ADD UNIQUE KEY `userid` (`userid`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `likedsongs`
--
ALTER TABLE `likedsongs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `playlist`
--
ALTER TABLE `playlist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `playlistsongs`
--
ALTER TABLE `playlistsongs`
  MODIFY `iid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
