-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 06, 2019 at 11:07 AM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gwjdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_cut_group`
--

CREATE TABLE `tbl_cut_group` (
  `group_id` int(11) NOT NULL,
  `description` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `close_date` date NOT NULL DEFAULT '2050-12-31',
  `created_by` int(11) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_by` int(11) NOT NULL,
  `updated_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_cut_lot`
--

CREATE TABLE `tbl_cut_lot` (
  `clot_id` int(11) NOT NULL,
  `description` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `close_date` date NOT NULL DEFAULT '2050-12-31',
  `created_by` int(11) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_by` int(11) NOT NULL,
  `updated_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_cut_plan_header`
--

CREATE TABLE `tbl_cut_plan_header` (
  `cph_id` int(11) NOT NULL,
  `order_no` varchar(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `is_del` tinyint(1) NOT NULL DEFAULT '0',
  `created_by` int(11) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_by` int(11) NOT NULL,
  `updated_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_cut_plan_marker`
--

CREATE TABLE `tbl_cut_plan_marker` (
  `cpm_id` int(11) NOT NULL,
  `cph_id` int(11) NOT NULL,
  `description` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `width` decimal(8,2) NOT NULL,
  `length` decimal(8,2) NOT NULL,
  `fabrication` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_by` int(11) NOT NULL,
  `updated_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_cut_plan_ratio`
--

CREATE TABLE `tbl_cut_plan_ratio` (
  `cpr_id` int(11) NOT NULL,
  `cpm_id` int(11) NOT NULL,
  `csqty_id` int(11) NOT NULL,
  `ratio` int(11) NOT NULL,
  `is_del` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_menu`
--

CREATE TABLE `tbl_menu` (
  `mn_id` int(11) NOT NULL,
  `description` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_menu`
--

INSERT INTO `tbl_menu` (`mn_id`, `description`) VALUES
(1, 'Cut group'),
(2, 'Cut lot'),
(3, 'Marker'),
(4, 'User control');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_permission`
--

CREATE TABLE `tbl_permission` (
  `pms_id` int(11) NOT NULL,
  `usr_id` int(11) NOT NULL,
  `mn_id` int(11) NOT NULL,
  `can_create` tinyint(1) NOT NULL DEFAULT '0',
  `can_read` tinyint(1) NOT NULL DEFAULT '0',
  `can_update` tinyint(1) NOT NULL DEFAULT '0',
  `can_delete` tinyint(1) NOT NULL DEFAULT '0',
  `can_approve` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_permission`
--

INSERT INTO `tbl_permission` (`pms_id`, `usr_id`, `mn_id`, `can_create`, `can_read`, `can_update`, `can_delete`, `can_approve`) VALUES
(25, 1, 1, 1, 1, 1, 1, 1),
(26, 1, 2, 1, 1, 1, 1, 1),
(27, 1, 3, 1, 1, 1, 1, 1),
(28, 1, 4, 1, 1, 1, 1, 1),
(29, 2, 1, 1, 1, 1, 1, 1),
(30, 2, 2, 1, 1, 1, 1, 1),
(31, 2, 3, 1, 1, 1, 1, 1),
(32, 2, 4, 1, 1, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_ticket_detail`
--

CREATE TABLE `tbl_ticket_detail` (
  `tktd_id` int(11) NOT NULL,
  `tkth_id` int(11) NOT NULL,
  `ticket_no` int(11) NOT NULL COMMENT 'Ticket No by IA. Number will increment from last ticket_no used in same IA',
  `master_ticket_no` int(11) NOT NULL COMMENT 'Master ticket no. Normally is same with ticket no, unless qty is split to multiple PO	',
  `size` varchar(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `ticket_qty` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_ticket_header`
--

CREATE TABLE `tbl_ticket_header` (
  `tkth_id` int(11) NOT NULL,
  `order_no` varchar(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `ticket_no` int(11) NOT NULL COMMENT 'ticket header no. by IA',
  `cut_date` datetime NOT NULL,
  `clot_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  `cpm_id` int(11) NOT NULL,
  `remark` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `is_replacement` tinyint(1) NOT NULL DEFAULT '0',
  `is_itemized` tinyint(1) NOT NULL DEFAULT '0',
  `ply` int(11) NOT NULL,
  `total_qty` int(11) NOT NULL,
  `dye_lot` varchar(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `color_id` int(11) NOT NULL,
  `is_del` tinyint(1) NOT NULL DEFAULT '0',
  `created_by` int(11) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_by` int(11) NOT NULL,
  `updated_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `usr_id` int(11) NOT NULL,
  `username` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT 'User login',
  `usr_password` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `full_name` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT 'name display in screen',
  `position` tinyint(2) NOT NULL DEFAULT '2' COMMENT '1 = admin; 2 = normal user',
  `language` tinyint(2) NOT NULL DEFAULT '1' COMMENT '1 = EN, 2 = ZH, 3 = ZH_HK, 4 = KM, 5 = VI',
  `resign_date` date NOT NULL DEFAULT '2050-12-31' COMMENT 'check user active or suspend',
  `created_by` int(11) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_by` int(11) NOT NULL,
  `updated_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`usr_id`, `username`, `usr_password`, `full_name`, `position`, `language`, `resign_date`, `created_by`, `created_date`, `updated_by`, `updated_date`) VALUES
(1, 'Admin', '$2y$10$ZhVxWynPKaau.afoqtG9CO5btIrFb19rcAd9lAFX6phbobb.7NbQe', 'Administrator', 1, 2, '2050-12-31', 1, '2019-10-25 09:52:00', 1, '2019-11-06 06:29:31'),
(2, 'jxyee', '$2y$10$aCZwI/zD.Wd1SyHGWOwgqultHXLj.uAi7CkXfSwDG54iRr4jMtxKG', 'Yee Jian Xiong', 2, 1, '2050-12-31', 1, '2019-11-06 07:24:11', 1, '2019-11-06 08:40:19');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user_log`
--

CREATE TABLE `tbl_user_log` (
  `ulog_id` int(11) NOT NULL,
  `usr_id` int(11) NOT NULL,
  `mn_id` int(11) NOT NULL,
  `log_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `description` varchar(500) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_user_log`
--

INSERT INTO `tbl_user_log` (`ulog_id`, `usr_id`, `mn_id`, `log_time`, `description`) VALUES
(1, 1, 0, '2019-11-06 06:29:38', 'Login'),
(10, 1, 4, '2019-11-06 07:24:11', 'Create new user (usr_id: 2)'),
(11, 1, 4, '2019-11-06 09:22:30', 'Edit user info (usr_id: 1)'),
(12, 1, 4, '2019-11-06 09:22:44', 'Edit user info (usr_id: 2)');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_cut_group`
--
ALTER TABLE `tbl_cut_group`
  ADD PRIMARY KEY (`group_id`);

--
-- Indexes for table `tbl_cut_lot`
--
ALTER TABLE `tbl_cut_lot`
  ADD PRIMARY KEY (`clot_id`);

--
-- Indexes for table `tbl_cut_plan_header`
--
ALTER TABLE `tbl_cut_plan_header`
  ADD PRIMARY KEY (`cph_id`);

--
-- Indexes for table `tbl_cut_plan_marker`
--
ALTER TABLE `tbl_cut_plan_marker`
  ADD PRIMARY KEY (`cpm_id`);

--
-- Indexes for table `tbl_cut_plan_ratio`
--
ALTER TABLE `tbl_cut_plan_ratio`
  ADD PRIMARY KEY (`cpr_id`);

--
-- Indexes for table `tbl_menu`
--
ALTER TABLE `tbl_menu`
  ADD PRIMARY KEY (`mn_id`);

--
-- Indexes for table `tbl_permission`
--
ALTER TABLE `tbl_permission`
  ADD PRIMARY KEY (`pms_id`),
  ADD UNIQUE KEY `idx_usr_mn` (`usr_id`,`mn_id`);

--
-- Indexes for table `tbl_ticket_detail`
--
ALTER TABLE `tbl_ticket_detail`
  ADD PRIMARY KEY (`tktd_id`);

--
-- Indexes for table `tbl_ticket_header`
--
ALTER TABLE `tbl_ticket_header`
  ADD PRIMARY KEY (`tkth_id`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`usr_id`);

--
-- Indexes for table `tbl_user_log`
--
ALTER TABLE `tbl_user_log`
  ADD PRIMARY KEY (`ulog_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_cut_group`
--
ALTER TABLE `tbl_cut_group`
  MODIFY `group_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_cut_lot`
--
ALTER TABLE `tbl_cut_lot`
  MODIFY `clot_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_cut_plan_header`
--
ALTER TABLE `tbl_cut_plan_header`
  MODIFY `cph_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_cut_plan_marker`
--
ALTER TABLE `tbl_cut_plan_marker`
  MODIFY `cpm_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_cut_plan_ratio`
--
ALTER TABLE `tbl_cut_plan_ratio`
  MODIFY `cpr_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_menu`
--
ALTER TABLE `tbl_menu`
  MODIFY `mn_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_permission`
--
ALTER TABLE `tbl_permission`
  MODIFY `pms_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `tbl_ticket_detail`
--
ALTER TABLE `tbl_ticket_detail`
  MODIFY `tktd_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_ticket_header`
--
ALTER TABLE `tbl_ticket_header`
  MODIFY `tkth_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `usr_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_user_log`
--
ALTER TABLE `tbl_user_log`
  MODIFY `ulog_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
