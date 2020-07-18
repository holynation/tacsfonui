-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jul 18, 2020 at 05:51 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tacsfon`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `ID` int(11) NOT NULL,
  `firstname` varchar(100) NOT NULL,
  `middlename` varchar(100) DEFAULT NULL,
  `lastname` varchar(100) NOT NULL,
  `email` varchar(150) DEFAULT NULL,
  `phone_number` varchar(50) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `role_id` int(11) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `admin_path` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`ID`, `firstname`, `middlename`, `lastname`, `email`, `phone_number`, `address`, `dob`, `role_id`, `status`, `admin_path`) VALUES
(1, 'Holynation', 'Dev', 'Oluwaseun', 'admin@gmail.com', '08109994485', 'university of ibadan', '2018-04-17', 1, 1, 'uploads/admin/1_5f123517f0d39_2020-07-18.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `article`
--

CREATE TABLE `article` (
  `ID` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `article_path` varchar(255) NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `article`
--

INSERT INTO `article` (`ID`, `title`, `article_path`, `user_id`, `status`, `date_created`) VALUES
(1, 'Hypocrisy', 'uploads/article/1_5f0488fb97833_2020-07-07.pdf', '1', 1, '2020-07-07 14:38:51');

-- --------------------------------------------------------

--
-- Table structure for table `article_history`
--

CREATE TABLE `article_history` (
  `ID` int(11) NOT NULL,
  `article_id` int(11) NOT NULL,
  `approval_status` tinyint(1) NOT NULL DEFAULT 0,
  `user_id` int(11) NOT NULL,
  `user_type` varchar(15) NOT NULL,
  `date_approved` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `date_created` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `audios`
--

CREATE TABLE `audios` (
  `ID` int(11) NOT NULL,
  `uploader` varchar(30) NOT NULL,
  `title` varchar(150) NOT NULL,
  `caption` text NOT NULL,
  `audios_path` varchar(150) NOT NULL,
  `audios_directory` varchar(150) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `audios`
--

INSERT INTO `audios` (`ID`, `uploader`, `title`, `caption`, `audios_path`, `audios_directory`, `status`, `date_created`) VALUES
(1, 'admin', 'My life is in your hands - Kirk franklin', 'This is a song of life and exhortation', 'uploads/audios/1_5e6d57a209053_2020-03-14.mp3', '', 1, '2020-07-18 01:35:51'),
(2, 'admin', 'Leadership talk', 'The Word of God is potent and strong of it is received with meekness of the heart. Listen to this message and your life will be transformed totally.', 'uploads/audios/file/1_5e9e5b9922639_2020-04-21.mp3', '', 1, '2020-07-18 02:13:42'),
(3, 'admin', 'Oceans deep', 'The depth of God is deeper than the deep itself.Everyone need to search and seek Him for deeper dimension in God. Listen to this message and your life will be transformed totally.', 'uploads/audios/file/1_5e9e5c06347a5_2020-04-21.mp3', '', 1, '2020-07-18 02:14:54');

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `ID` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `start` datetime NOT NULL,
  `end` datetime NOT NULL,
  `description` text NOT NULL,
  `events_path` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`ID`, `title`, `start`, `end`, `description`, `events_path`) VALUES
(1, 'Favour Heirs by Pastor J.P.', '2020-03-21 18:03:00', '2020-03-22 17:03:11', 'We are Daniel\'s company', 'uploads/events/1_5e763479e43f2_2020-03-21.jpg'),
(2, 'This is Peniel', '2020-08-06 00:00:00', '2020-08-06 00:00:00', 'This is an hour and wrestle with God...', 'uploads/events/1_5e9e650de55b3_2020-04-21.jpg'),
(3, 'Open my eye', '2020-04-24 04:04:20', '2020-04-21 05:16:31', 'This is a program that is design to change men and transform them for greater purpose in life.', 'uploads/events/1_5e9e658f284e3_2020-04-21.jpeg'),
(4, 'Fresher Forum Program', '2020-04-28 05:04:00', '2020-04-21 05:18:47', 'This is a program design for the freshers in the house. It is program of enlightenment and empowerment. It is where men are made and transformed in God.', 'uploads/events/1_5e9e66171dccd_2020-04-21.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `gallery`
--

CREATE TABLE `gallery` (
  `ID` int(11) NOT NULL,
  `uploader` varchar(30) NOT NULL,
  `title` varchar(150) NOT NULL,
  `gallery_path` varchar(150) NOT NULL,
  `display_type` enum('home','gallery') NOT NULL DEFAULT 'gallery',
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `gallery`
--

INSERT INTO `gallery` (`ID`, `uploader`, `title`, `gallery_path`, `display_type`, `status`, `date_created`) VALUES
(1, 'admin', 'Fellowship Session', 'uploads/galleries/front end.png', 'home', 1, '2020-07-18 02:26:52'),
(2, 'admin', 'Fellowship Session', 'uploads/galleries/front end 2.png', 'home', 1, '2020-07-18 02:26:52'),
(3, 'admin', 'Fellowship Session', 'uploads/galleries/front end 3.png', 'home', 1, '2020-07-18 02:26:52'),
(4, 'admin', 'Fellowship Session', 'uploads/galleries/front end 4.png', 'home', 1, '2020-07-18 02:26:52'),
(5, 'admin', 'Fellowship Session', 'uploads/galleries/front end 5.png', 'home', 1, '2020-07-18 02:26:52'),
(6, 'admin', 'TACSFON UI', 'uploads/galleries/DSC_0492.JPG', 'gallery', 1, '2020-07-18 03:13:08'),
(7, 'admin', 'TACSFON UI', 'uploads/galleries/DSC_0589.JPG', 'gallery', 1, '2020-07-18 03:13:08'),
(8, 'admin', 'TACSFON UI', 'uploads/galleries/DSC_0803.JPG', 'gallery', 1, '2020-07-18 03:13:08'),
(9, 'admin', 'TACSFON UI', 'uploads/galleries/DSC_0851.JPG', 'gallery', 1, '2020-07-18 03:13:08'),
(10, 'admin', 'TACSFON UI', 'uploads/galleries/IMG_20171104_173121.jpg', 'gallery', 1, '2020-07-18 03:13:08'),
(11, 'admin', 'TACSFON UI', 'uploads/galleries/IMG_20191108_092847_108.jpg', 'gallery', 1, '2020-07-18 03:13:08'),
(12, 'admin', 'TACSFON UI', 'uploads/galleries/IMG_20191214_165158.jpg', 'gallery', 1, '2020-07-18 03:13:08'),
(13, 'admin', 'TACSFON UI', 'uploads/galleries/IMG_4326.JPG', 'gallery', 1, '2020-07-18 03:13:08'),
(14, 'admin', 'TACSFON UI', 'uploads/galleries/IMG_4375.JPG', 'gallery', 1, '2020-07-18 03:13:08');

-- --------------------------------------------------------

--
-- Table structure for table `member`
--

CREATE TABLE `member` (
  `ID` int(11) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `middlename` varchar(50) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `phone_number` varchar(15) NOT NULL,
  `member_path` varchar(150) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `permission`
--

CREATE TABLE `permission` (
  `ID` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `path` varchar(100) DEFAULT NULL,
  `permission` enum('r','w') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `permission`
--

INSERT INTO `permission` (`ID`, `role_id`, `path`, `permission`) VALUES
(1, 1, 'vc/admin/dashboard', 'w'),
(2, 1, 'vc/admin/profile', 'w'),
(3, 1, 'vc/add/admin', 'w'),
(4, 1, 'vc/add/member', 'w'),
(5, 1, 'vc/add/role', 'w'),
(6, 1, 'vc/add/title', 'w'),
(7, 1, 'vc/admin/article', 'w'),
(8, 1, 'vc/admin/bulletin', 'w'),
(9, 1, 'vc/add/secretariat', 'w'),
(10, 1, 'vc/add/slider', 'w'),
(11, 1, 'vc/admin/event_gallery', 'w'),
(12, 1, 'vc/admin/audio', 'w'),
(13, 1, 'vc/admin/video', 'w'),
(14, 1, 'vc/add/publicity', 'w'),
(15, 1, 'vc/add/media_collection', 'w'),
(16, 1, 'vc/add/approve_article', 'w'),
(17, 1, 'vc/add/approve_donation', 'w'),
(18, 1, 'vc/add/birthday', 'w'),
(19, 1, 'vc/add/subscription', 'w'),
(468, 1, 'vc/add/audios', 'w'),
(7993, 1, 'vc/add/video', 'w'),
(8069, 1, 'vc/add/videos', 'w'),
(8542, 1, 'vc/create/gallery', 'w'),
(8884, 1, 'vc/admin/gallery', 'w'),
(17266, 1, 'vc/create/events', 'w'),
(17300, 1, 'vc/create/slider', 'w'),
(17302, 1, 'vc/create/audios', 'w'),
(17303, 1, 'vc/create/videos', 'w'),
(17305, 1, 'vc/create/media_collection', 'w'),
(17532, 1, 'vc/create/events/single', 'w'),
(19242, 1, 'vc/admin/events', 'w'),
(41632, 1, 'vc/create/admin', 'w'),
(41633, 1, 'vc/create/member', 'w'),
(41634, 1, 'vc/create/role', 'w'),
(47944, 1, 'vc/add/article', 'w'),
(48286, 1, 'vc/create/article', 'w'),
(54158, 3, 'vc/admin/dashboard', 'r'),
(54159, 3, 'vc/admin/profile', 'r'),
(54160, 3, 'vc/create/member', 'r'),
(54161, 3, 'vc/create/article', 'r');

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `ID` int(11) NOT NULL,
  `role_title` varchar(150) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`ID`, `role_title`, `status`) VALUES
(1, 'superadmin', 1),
(2, 'Member', 1),
(3, 'Editorial', 1);

-- --------------------------------------------------------

--
-- Table structure for table `slider`
--

CREATE TABLE `slider` (
  `ID` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `slider_path` varchar(255) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `slider`
--

INSERT INTO `slider` (`ID`, `title`, `slider_path`, `date_created`) VALUES
(1, 'TACSFON UI', 'uploads/slider/1_5e763d563487d_2020-03-21.jpg', '2020-07-07 13:05:10'),
(2, 'TACSFON UI', 'uploads/slider/1_5e763d7448626_2020-03-21.jpg', '2020-07-18 01:17:12'),
(3, 'TACSFON UI', 'uploads/slider/1_5e76411b6d2e1_2020-03-21.jpg', '2020-07-18 01:21:14');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `ID` int(11) NOT NULL,
  `username` varchar(150) NOT NULL,
  `password` varchar(150) NOT NULL,
  `user_type` varchar(100) NOT NULL,
  `user_table_id` int(11) NOT NULL,
  `token` text DEFAULT NULL,
  `last_login` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `last_logout` timestamp NULL DEFAULT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`ID`, `username`, `password`, `user_type`, `user_table_id`, `token`, `last_login`, `last_logout`, `date_created`, `status`) VALUES
(1, 'admin@gmail.com', '25d55ad283aa400af464c76d713c07ad', 'admin', 1, NULL, '2020-07-17 23:51:54', NULL, '2018-04-05 20:26:09', 1);

-- --------------------------------------------------------

--
-- Table structure for table `videos`
--

CREATE TABLE `videos` (
  `ID` int(11) NOT NULL,
  `uploader` varchar(30) NOT NULL,
  `title` varchar(150) NOT NULL,
  `caption` text NOT NULL,
  `videos_path` varchar(150) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `videos`
--

INSERT INTO `videos` (`ID`, `uploader`, `title`, `caption`, `videos_path`, `status`, `date_created`) VALUES
(2, 'admin', 'Drama series -Story so far', 'This a video of the pathfinder ministry in Tacsfon UI. Watch and be blessed.', 'uploads/videos/1_5f1269ec99806_2020-07-18.mp4', 1, '2020-07-18 03:18:04');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `phone_number` (`phone_number`);

--
-- Indexes for table `article`
--
ALTER TABLE `article`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `article_history`
--
ALTER TABLE `article_history`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `audios`
--
ALTER TABLE `audios`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `title` (`title`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `gallery`
--
ALTER TABLE `gallery`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `permission`
--
ALTER TABLE `permission`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `role_id` (`role_id`,`path`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `role_title` (`role_title`);

--
-- Indexes for table `slider`
--
ALTER TABLE `slider`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `username_2` (`username`);

--
-- Indexes for table `videos`
--
ALTER TABLE `videos`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `title` (`title`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `article`
--
ALTER TABLE `article`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `article_history`
--
ALTER TABLE `article_history`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `audios`
--
ALTER TABLE `audios`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `gallery`
--
ALTER TABLE `gallery`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `member`
--
ALTER TABLE `member`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `permission`
--
ALTER TABLE `permission`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57426;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `slider`
--
ALTER TABLE `slider`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `videos`
--
ALTER TABLE `videos`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
