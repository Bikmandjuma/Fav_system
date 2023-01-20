-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 17, 2023 at 03:03 AM
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
-- Database: `facdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `firstname` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `gender` varchar(25) NOT NULL,
  `phone` varchar(100) NOT NULL,
  `email` varchar(200) NOT NULL,
  `dob` date NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `firstname`, `lastname`, `gender`, `phone`, `email`, `dob`, `username`, `password`, `image`) VALUES
(1, 'Bikman', 'Djuma', 'male', '0785389000', 'admin@gmail.com', '1993-12-20', 'admin@gmail.com', 'a43c27c2babefd68df8a694900f30a1c', 'user.png');

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `a_id` int(11) NOT NULL,
  `citizen_fk_id` int(11) NOT NULL,
  `attend_date` date NOT NULL,
  `attend_time` varchar(50) NOT NULL,
  `year` varchar(50) NOT NULL,
  `month` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `attendance`
--

INSERT INTO `attendance` (`a_id`, `citizen_fk_id`, `attend_date`, `attend_time`, `year`, `month`) VALUES
(1, 1, '2022-10-11', '10:10:20 am', '2022', '10'),
(2, 2, '2022-10-11', '10:16:39 am', '2022', '10'),
(3, 1, '2022-10-11', '10:18:24 am', '2022', '10'),
(4, 2, '2022-10-11', '10:18:55 am', '2022', '10'),
(5, 1, '2022-10-11', '10:19:17 am', '2022', '10'),
(6, 2, '2022-11-14', '03:23:14 pm', '2022', '11'),
(7, 4, '2022-11-15', '09:20:27 am', '2022', '11'),
(8, 2, '2022-11-15', '09:43:13 am', '2022', '11'),
(9, 2, '2022-11-15', '09:43:45 am', '2022', '11'),
(10, 1, '2022-11-15', '09:45:42 am', '2022', '11'),
(11, 2, '2022-11-15', '09:46:40 am', '2022', '11'),
(12, 1, '2022-11-15', '09:47:06 am', '2022', '11'),
(13, 1, '2022-11-16', '04:26:11 pm', '2022', '11'),
(14, 2, '2022-11-16', '04:27:01 pm', '2022', '11'),
(15, 4, '2022-11-16', '04:28:22 pm', '2022', '11'),
(16, 4, '2022-11-16', '04:28:53 pm', '2022', '11'),
(17, 2, '2022-11-16', '04:29:44 pm', '2022', '11'),
(18, 2, '2022-11-16', '04:29:50 pm', '2022', '11'),
(19, 1, '2022-11-16', '04:29:54 pm', '2022', '11'),
(20, 1, '2022-11-16', '04:29:59 pm', '2022', '11'),
(21, 1, '2022-11-16', '04:30:06 pm', '2022', '11'),
(22, 1, '2022-11-16', '04:30:14 pm', '2022', '11'),
(23, 1, '2022-11-17', '09:18:51 am', '2022', '11'),
(24, 2, '2022-11-20', '11:32:15 pm', '2022', '11'),
(25, 1, '2022-11-20', '11:32:24 pm', '2022', '11'),
(26, 2, '2022-11-20', '11:36:13 pm', '2022', '11'),
(27, 3, '2022-11-20', '11:37:46 pm', '2022', '11'),
(28, 1, '2022-11-20', '11:37:53 pm', '2022', '11'),
(29, 3, '2022-11-20', '11:37:57 pm', '2022', '11'),
(30, 2, '2022-11-20', '11:40:52 pm', '2022', '11'),
(31, 1, '2022-11-20', '11:41:46 pm', '2022', '11'),
(32, 1, '2022-11-20', '11:41:51 pm', '2022', '11'),
(33, 2, '2022-11-20', '11:42:04 pm', '2022', '11'),
(34, 4, '2022-11-20', '11:42:53 pm', '2022', '11'),
(35, 2, '2022-11-23', '08:28:04 am', '2022', '11'),
(36, 1, '2022-11-23', '08:28:10 am', '2022', '11'),
(37, 2, '2022-11-23', '08:28:15 am', '2022', '11'),
(38, 1, '2022-11-24', '03:11:58 pm', '2022', '11'),
(39, 5, '2022-11-24', '03:12:06 pm', '2022', '11'),
(40, 2, '2022-11-24', '03:12:14 pm', '2022', '11'),
(41, 5, '2022-11-27', '01:09:05 pm', '2022', '11'),
(42, 1, '2022-11-27', '01:09:24 pm', '2022', '11'),
(43, 2, '2022-11-27', '01:09:46 pm', '2022', '11'),
(44, 5, '2022-11-27', '01:09:49 pm', '2022', '11'),
(45, 2, '2022-11-27', '01:09:52 pm', '2022', '11'),
(46, 4, '2022-11-27', '01:09:55 pm', '2022', '11'),
(47, 5, '2022-11-27', '01:09:58 pm', '2022', '11'),
(48, 5, '2022-11-28', '12:09:00 am', '2022', '11'),
(49, 1, '2022-11-28', '12:09:05 am', '2022', '11'),
(50, 2, '2022-11-28', '12:09:12 am', '2022', '11'),
(51, 4, '2022-11-28', '12:09:23 am', '2022', '11'),
(52, 4, '2022-11-28', '12:09:25 am', '2022', '11'),
(53, 1, '2022-11-28', '12:09:27 am', '2022', '11'),
(54, 2, '2022-11-28', '12:09:35 am', '2022', '11'),
(55, 1, '2022-11-28', '12:09:39 am', '2022', '11'),
(56, 1, '2022-11-28', '12:09:46 am', '2022', '11'),
(57, 1, '2022-11-28', '12:09:50 am', '2022', '11'),
(58, 2, '2022-11-28', '12:09:52 am', '2022', '11'),
(59, 4, '2022-11-28', '12:09:58 am', '2022', '11'),
(60, 2, '2022-11-28', '12:10:05 am', '2022', '11'),
(61, 4, '2022-11-28', '12:10:07 am', '2022', '11'),
(62, 1, '2022-11-28', '12:10:09 am', '2022', '11'),
(63, 2, '2022-11-29', '05:04:45 pm', '2022', '11'),
(64, 1, '2022-11-29', '05:04:51 pm', '2022', '11'),
(65, 5, '2022-11-29', '05:04:54 pm', '2022', '11'),
(66, 5, '2022-12-02', '04:10:06 pm', '2022', '12'),
(67, 5, '2022-12-04', '12:41:30 pm', '2022', '12'),
(68, 1, '2022-12-04', '12:55:08 pm', '2022', '12'),
(69, 1, '2022-12-04', '12:55:15 pm', '2022', '12'),
(70, 1, '2022-12-04', '01:36:42 pm', '2022', '12'),
(71, 2, '2022-12-09', '11:01:42 am', '2022', '12'),
(72, 4, '2022-12-09', '11:01:51 am', '2022', '12'),
(73, 5, '2022-12-09', '11:13:10 pm', '2022', '12'),
(74, 2, '2022-12-09', '11:13:14 pm', '2022', '12'),
(75, 5, '2022-12-09', '11:13:19 pm', '2022', '12'),
(76, 2, '2022-12-09', '11:13:22 pm', '2022', '12'),
(77, 2, '2022-12-09', '11:13:29 pm', '2022', '12'),
(78, 2, '2022-12-18', '09:27:20 pm', '2022', '12'),
(79, 5, '2022-12-18', '09:27:28 pm', '2022', '12'),
(80, 5, '2022-12-22', '02:27:24 pm', '2022', '12'),
(81, 1, '2022-12-22', '03:24:17 pm', '2022', '12'),
(82, 5, '2023-01-02', '02:57:45 pm', '2023', '01'),
(83, 1, '2023-01-02', '02:57:49 pm', '2023', '01'),
(84, 4, '2023-01-02', '02:57:54 pm', '2023', '01'),
(85, 2, '2023-01-02', '02:58:00 pm', '2023', '01'),
(86, 4, '2023-01-05', '05:33:36 pm', '2023', '01'),
(87, 5, '2023-01-05', '07:00:13 pm', '2023', '01'),
(88, 1, '2023-01-05', '07:00:18 pm', '2023', '01'),
(89, 4, '2023-01-05', '07:00:26 pm', '2023', '01'),
(90, 5, '2023-01-05', '07:00:34 pm', '2023', '01'),
(91, 5, '2023-01-05', '07:01:03 pm', '2023', '01'),
(92, 5, '2023-01-05', '07:01:03 pm', '2023', '01'),
(93, 1, '2023-01-05', '07:01:09 pm', '2023', '01'),
(94, 1, '2023-01-05', '07:01:09 pm', '2023', '01'),
(95, 4, '2023-01-05', '07:01:14 pm', '2023', '01'),
(96, 4, '2023-01-05', '07:01:15 pm', '2023', '01'),
(97, 2, '2023-01-05', '07:01:19 pm', '2023', '01'),
(98, 4, '2023-01-05', '07:01:38 pm', '2023', '01'),
(99, 4, '2023-01-05', '07:01:38 pm', '2023', '01'),
(100, 4, '2023-01-05', '07:01:43 pm', '2023', '01'),
(101, 4, '2023-01-05', '07:01:44 pm', '2023', '01'),
(102, 2, '2023-01-05', '07:01:47 pm', '2023', '01'),
(103, 5, '2023-01-05', '07:01:50 pm', '2023', '01'),
(104, 2, '2023-01-05', '07:01:53 pm', '2023', '01'),
(105, 2, '2023-01-05', '07:01:54 pm', '2023', '01'),
(106, 1, '2023-01-05', '07:01:59 pm', '2023', '01'),
(107, 4, '2023-01-05', '07:02:08 pm', '2023', '01'),
(108, 1, '2023-01-08', '02:45:13 pm', '2023', '01'),
(109, 2, '2023-01-08', '02:45:17 pm', '2023', '01'),
(110, 2, '2023-01-09', '08:59:02 am', '2023', '01'),
(111, 5, '2023-01-10', '11:04:57 am', '2023', '01'),
(112, 2, '2023-01-10', '11:05:08 am', '2023', '01'),
(113, 1, '2023-01-10', '11:05:15 am', '2023', '01'),
(114, 1, '2023-01-10', '05:16:01 pm', '2023', '01'),
(115, 7, '2023-01-15', '09:26:52 pm', '2023', '01');

-- --------------------------------------------------------

--
-- Table structure for table `citizentb`
--

CREATE TABLE `citizentb` (
  `c_id` int(11) NOT NULL,
  `card_id` varchar(50) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `middlename` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `gender` varchar(50) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `province` varchar(50) NOT NULL,
  `district` varchar(50) NOT NULL,
  `sector` varchar(50) NOT NULL,
  `cellule` varchar(50) NOT NULL,
  `village` varchar(50) NOT NULL,
  `dob` date NOT NULL,
  `registered_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `citizentb`
--

INSERT INTO `citizentb` (`c_id`, `card_id`, `firstname`, `middlename`, `lastname`, `gender`, `phone`, `province`, `district`, `sector`, `cellule`, `village`, `dob`, `registered_date`) VALUES
(1, 'BCA2580C', 'Bikman', 'Nganga', 'Sufi', 'male', '0785389000', 'western', 'rusizi', 'bugarama', 'nyange', 'mubogora', '1993-12-20', '2022-11-10'),
(2, 'AA031DEC', 'Elon', 'Edward', 'Musk', 'male', '0787943106', 'Eastern', 'Kayonza', 'Karubamba', 'Nkoto', 'kayonza', '1972-10-11', '2022-10-11'),
(3, '23DB987B', 'Hawa', 'Djuma', 'Mukeshimana', 'female', '0787943100', 'Western', 'Rusizi', 'Bugarama', 'Nyange', 'Mubogora', '2022-12-31', '2022-10-11'),
(4, '35B7A4BB', 'Husna', 'Djuma', 'Ramadhan', 'female', '0728020881', 'Northen', 'Musanze', 'Gakuba', 'Bereshi', 'Susa', '2004-12-31', '2022-10-11'),
(5, '2345678FB', 'Mark', 'Lee', 'Zukerberg', 'male', '250734392541', 'Kigali', 'Basabo', 'Kacyiru', 'kimihurura', 'Ntovu', '1996-12-30', '2022-11-24'),
(6, 'B34D0126', 'Bill ', 'Niyo', 'Gate', 'male', '+250785009000', 'Western', 'Rubavu', 'Mukamira', 'shyogwe', 'kibusumba', '1984-04-04', '2022-12-04'),
(7, '20KIRABO', 'Kirabo', 'programmer', 'Phionah', 'female', '0784597218', 'Eastern', 'Nyagatare', 'Sector', 'cel', 'vil', '2013-09-15', '2023-01-15');

-- --------------------------------------------------------

--
-- Table structure for table `online_users`
--

CREATE TABLE `online_users` (
  `ou_id` int(11) NOT NULL,
  `status` varchar(25) NOT NULL,
  `period` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `fk_user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `online_users`
--

INSERT INTO `online_users` (`ou_id`, `status`, `period`, `fk_user_id`) VALUES
(1, 'OFF', '2023-01-17 10:52:03', 1),
(2, 'ON', '2023-01-17 10:52:14', 2);

-- --------------------------------------------------------

--
-- Table structure for table `site_name`
--

CREATE TABLE `site_name` (
  `id` int(11) NOT NULL,
  `sitename` varchar(100) NOT NULL,
  `entrance` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `site_name`
--

INSERT INTO `site_name` (`id`, `sitename`, `entrance`) VALUES
(0, 'NyamiramboStadium', 'FirstEntrance'),
(1, 'Nyabugogo', 'FirstEntrance'),
(2, 'Nyabugogo', 'SecondEntrance');

-- --------------------------------------------------------

--
-- Table structure for table `system_name`
--

CREATE TABLE `system_name` (
  `id` int(11) NOT NULL,
  `system_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `system_name`
--

INSERT INTO `system_name` (`id`, `system_name`) VALUES
(1, 'Fav system');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_member`
--

CREATE TABLE `tbl_member` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(200) NOT NULL,
  `email` varchar(255) NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_password_reset`
--

CREATE TABLE `tbl_password_reset` (
  `id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  `password_recovery_token` varchar(255) NOT NULL,
  `expire_at` timestamp NULL DEFAULT NULL,
  `is_valid` tinyint(4) NOT NULL,
  `expired_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `create_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `u_id` int(11) NOT NULL,
  `firstname` varchar(100) DEFAULT NULL,
  `lastname` varchar(100) DEFAULT NULL,
  `gender` varchar(100) DEFAULT NULL,
  `phone` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `dob` varchar(100) DEFAULT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `exp_date` varchar(250) DEFAULT NULL,
  `reset_link_token` varchar(250) DEFAULT NULL,
  `image` varchar(100) DEFAULT NULL,
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`u_id`, `firstname`, `lastname`, `gender`, `phone`, `email`, `dob`, `username`, `password`, `exp_date`, `reset_link_token`, `image`) VALUES
(1, 'Elon', 'Musk', 'male', '0785389000', '', '1972-06-04', 'elon@gmail.com', '31108a8706e7052557db9a508ad89aa7', NULL, NULL, '202301170250EVU0Es7XYAAbNf2.jpg'),
(2, 'Bill ', 'Gate', 'male', '0728020881', 'bill@gmail.com', '1961-05-05', 'bill@gmail.com', '95dd405376481c3f77603be8ed96ae25', NULL, NULL, '202301170254321425318_680249360344312_3443105703562450081_n.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`a_id`),
  ADD KEY `citizen_fk_id` (`citizen_fk_id`);
--
-- Indexes for table `citizentb`
--
ALTER TABLE `citizentb`
  ADD PRIMARY KEY (`c_id`);

--
-- Indexes for table `online_users`
--
ALTER TABLE `online_users`
  ADD PRIMARY KEY (`ou_id`),
  ADD KEY `fk_user_id` (`fk_user_id`);

--
-- Indexes for table `site_name`
--
ALTER TABLE `site_name`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `system_name`
--
ALTER TABLE `system_name`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_member`
--
ALTER TABLE `tbl_member`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_password_reset`
--
ALTER TABLE `tbl_password_reset`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`u_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `attendance`
--
ALTER TABLE `attendance`
  MODIFY `a_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=116;

--
-- AUTO_INCREMENT for table `citizentb`
--
ALTER TABLE `citizentb`
  MODIFY `c_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `online_users`
--
ALTER TABLE `online_users`
  MODIFY `ou_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_member`
--
ALTER TABLE `tbl_member`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_password_reset`
--
ALTER TABLE `tbl_password_reset`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `u_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `attendance`
--
ALTER TABLE `attendance`
  ADD CONSTRAINT `attendance_ibfk_1` FOREIGN KEY (`citizen_fk_id`) REFERENCES `citizentb` (`c_id`);

--
-- Constraints for table `online_users`
--
ALTER TABLE `online_users`
  ADD CONSTRAINT `online_users_ibfk_1` FOREIGN KEY (`fk_user_id`) REFERENCES `users` (`u_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
