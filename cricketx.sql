-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 06, 2022 at 08:56 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cricketx`
--

-- --------------------------------------------------------

--
-- Table structure for table `bowler_stat`
--

CREATE TABLE `bowler_stat` (
  `id` int(11) NOT NULL,
  `runs` int(11) DEFAULT NULL,
  `team` int(11) DEFAULT NULL,
  `balls` int(11) DEFAULT NULL,
  `code` varchar(255) DEFAULT NULL,
  `wickets` int(11) DEFAULT NULL,
  `bname` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bowler_stat`
--

INSERT INTO `bowler_stat` (`id`, `runs`, `team`, `balls`, `code`, `wickets`, `bname`) VALUES
(5, 13, 2, 6, 'CM', 0, 'Jasprit Bumrah'),
(6, 11, 2, 6, 'CM', 1, 'Hardik Pandya'),
(7, 16, 1, 6, 'CM', 1, 'M Sharma'),
(8, 7, 1, 7, 'CM', 0, 'R Ashwin');

-- --------------------------------------------------------

--
-- Table structure for table `match_details`
--

CREATE TABLE `match_details` (
  `id` int(11) NOT NULL,
  `team1` varchar(50) NOT NULL,
  `team2` varchar(50) NOT NULL,
  `players` int(11) NOT NULL,
  `overs` int(11) NOT NULL,
  `code` varchar(50) NOT NULL,
  `toss` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `match_details`
--

INSERT INTO `match_details` (`id`, `team1`, `team2`, `players`, `overs`, `code`, `toss`) VALUES
(23, 'Chennai', 'Mumbai', 5, 5, 'CM', 1);

-- --------------------------------------------------------

--
-- Table structure for table `player_details`
--

CREATE TABLE `player_details` (
  `id` int(11) NOT NULL,
  `pname` varchar(255) DEFAULT NULL,
  `team` int(11) NOT NULL,
  `code` varchar(255) DEFAULT NULL,
  `flag` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `player_details`
--

INSERT INTO `player_details` (`id`, `pname`, `team`, `code`, `flag`) VALUES
(39, 'Ms Dhoni', 1, 'CM', 0),
(40, 'Faf Du Plesis', 1, 'CM', 0),
(41, 'R Jadeja', 1, 'CM', 0),
(42, 'R Ashwin', 1, 'CM', 3),
(43, 'M Sharma', 1, 'CM', 0),
(44, 'Rohit Sharma', 2, 'CM', 0),
(45, 'Ishan Kishan', 2, 'CM', 2),
(46, 'Hardik Pandya', 2, 'CM', 1),
(47, 'Jasprit Bumrah', 2, 'CM', 0),
(48, 'Trent bolt', 2, 'CM', 0);

-- --------------------------------------------------------

--
-- Table structure for table `player_score`
--

CREATE TABLE `player_score` (
  `id` int(11) NOT NULL,
  `score` int(11) DEFAULT NULL,
  `team` int(11) DEFAULT NULL,
  `flag` int(11) DEFAULT NULL,
  `balls` int(11) DEFAULT NULL,
  `code` varchar(255) DEFAULT NULL,
  `pname` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `player_score`
--

INSERT INTO `player_score` (`id`, `score`, `team`, `flag`, `balls`, `code`, `pname`) VALUES
(23, 21, 1, 0, 7, 'CM', 'Ms Dhoni'),
(24, 2, 1, 1, 3, 'CM', 'Faf Du Plesis'),
(25, 1, 1, 0, 1, 'CM', 'R Jadeja'),
(26, 13, 2, 1, 3, 'CM', 'Rohit Sharma'),
(27, 3, 2, 0, 5, 'CM', 'Ishan Kishan'),
(28, 7, 2, 0, 4, 'CM', 'Hardik Pandya');

-- --------------------------------------------------------

--
-- Table structure for table `team_score`
--

CREATE TABLE `team_score` (
  `id` int(11) NOT NULL,
  `score` int(11) DEFAULT NULL,
  `team` int(11) DEFAULT NULL,
  `code` varchar(255) DEFAULT NULL,
  `balls` int(11) DEFAULT NULL,
  `flag` int(11) DEFAULT NULL,
  `bat_flag` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `team_score`
--

INSERT INTO `team_score` (`id`, `score`, `team`, `code`, `balls`, `flag`, `bat_flag`) VALUES
(72, 24, 1, 'CM', 12, 0, 0),
(73, 23, 2, 'CM', 13, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `created_at`) VALUES
(1, 'sanskar', '$2y$10$hA/UfViVJtoBjZI.39KH7u9ixhuIEq9MAv8grNl.Nj032U4jXZ7m2', '2022-06-19 16:06:24');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bowler_stat`
--
ALTER TABLE `bowler_stat`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `match_details`
--
ALTER TABLE `match_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `player_details`
--
ALTER TABLE `player_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `player_score`
--
ALTER TABLE `player_score`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `team_score`
--
ALTER TABLE `team_score`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT for table `bowler_stat`
--
ALTER TABLE `bowler_stat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `match_details`
--
ALTER TABLE `match_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `player_details`
--
ALTER TABLE `player_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `player_score`
--
ALTER TABLE `player_score`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `team_score`
--
ALTER TABLE `team_score`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
