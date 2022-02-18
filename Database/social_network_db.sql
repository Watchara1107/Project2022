-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 17, 2022 at 03:56 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `social_network_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `person`
--

CREATE TABLE `person` (
  `per_no` varchar(10) NOT NULL COMMENT 'รหัสสมาชิก',
  `per_fname` varchar(10) DEFAULT NULL COMMENT 'คำนำหน้า',
  `per_name` varchar(40) DEFAULT NULL COMMENT 'ชื่อสมาชิก',
  `per_lname` varchar(40) DEFAULT NULL COMMENT 'นามสกุล',
  `per_idcard` varchar(13) DEFAULT NULL COMMENT 'หมายเลขบัตรประจำตัวประชาชน',
  `per_sex` varchar(5) DEFAULT NULL COMMENT 'เพศ',
  `per_address` varchar(60) DEFAULT NULL COMMENT 'ที่อยู่',
  `per_email` varchar(30) DEFAULT NULL COMMENT 'อีเมล',
  `per_datereg` date DEFAULT NULL COMMENT 'วันที่ลงทะเบียน',
  `per_username` varchar(20) DEFAULT NULL COMMENT 'ชื่อเข้าใช้งานระบบ',
  `per_password` varchar(20) DEFAULT NULL COMMENT 'รหัสผ่าน'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `postdata`
--

CREATE TABLE `postdata` (
  `post_id` varchar(10) NOT NULL COMMENT 'รหัสการโพสต์ข้อความ',
  `per_no` varchar(10) DEFAULT NULL COMMENT 'รหัสสมาชิก',
  `post_date` datetime DEFAULT NULL COMMENT 'วันที่ เวลาที่โพสต์',
  `post_text` text DEFAULT NULL COMMENT 'ข้อความที่โพสต์',
  `post_image` varchar(100) DEFAULT NULL COMMENT 'รูปภาพที่โพสต์'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `person`
--
ALTER TABLE `person`
  ADD PRIMARY KEY (`per_no`);

--
-- Indexes for table `postdata`
--
ALTER TABLE `postdata`
  ADD PRIMARY KEY (`post_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
