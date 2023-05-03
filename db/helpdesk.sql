-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 03, 2023 at 05:25 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `helpdesk`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_depart`
--

CREATE TABLE `tbl_depart` (
  `dp_id` int(11) NOT NULL,
  `dp_name` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_depart`
--

INSERT INTO `tbl_depart` (`dp_id`, `dp_name`) VALUES
(1, 'ໄອທີ'),
(2, 'ບັນຊີ'),
(3, 'ແອັດມີນ'),
(4, 'ການຂາຍ'),
(5, 'ແຟນຊາຍ'),
(6, 'ບໍລິຫານ');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_header_title`
--

CREATE TABLE `tbl_header_title` (
  `ht_id` int(11) NOT NULL,
  `ht_name` varchar(300) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_header_title`
--

INSERT INTO `tbl_header_title` (`ht_id`, `ht_name`) VALUES
(1, 'Master Data'),
(2, 'User Data'),
(3, 'System Data'),
(4, 'Sale Data');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_page_title`
--

CREATE TABLE `tbl_page_title` (
  `pt_id` int(11) NOT NULL,
  `pt_name` varchar(300) DEFAULT NULL,
  `ptf_name` varchar(100) DEFAULT NULL,
  `st_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_page_title`
--

INSERT INTO `tbl_page_title` (`pt_id`, `pt_name`, `ptf_name`, `st_id`) VALUES
(1, 'ພະແນກ', 'depart.php', 4),
(2, 'ຫນ້າຟັງຊັ້ນ', 'page-function.php', 4),
(3, 'ສ້າງສິດ', 'roles.php', 3),
(4, 'ຜູ້ໃຊ້', 'user-staff.php', 3),
(5, 'ຈັດການສິດ', 'role-manage.php ', 3);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_roles`
--

CREATE TABLE `tbl_roles` (
  `r_id` int(11) NOT NULL,
  `role_name` varchar(150) DEFAULT NULL,
  `role_level` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_roles`
--

INSERT INTO `tbl_roles` (`r_id`, `role_name`, `role_level`) VALUES
(1, 'ຊຸບເປີແອັດມີນ', 1),
(2, 'ບັນຊີ', 4),
(3, 'ແອັດມີນສາງ', 3),
(4, 'ແອັດມີນລະບົບ', 2),
(5, 'ການຂາຍ', 3),
(6, 'ແຟນຊາຍ', 5),
(7, 'ແອັດມີນແຟນຊາຍ', 5);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_role_level`
--

CREATE TABLE `tbl_role_level` (
  `rl_id` int(11) NOT NULL,
  `rl_name` varchar(90) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_role_level`
--

INSERT INTO `tbl_role_level` (`rl_id`, `rl_name`) VALUES
(1, 'Level 1'),
(2, 'Level 2'),
(3, 'Level 3'),
(4, 'Level 4'),
(5, 'Level 5');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_role_page`
--

CREATE TABLE `tbl_role_page` (
  `rp_id` int(11) NOT NULL,
  `role_id` int(11) DEFAULT NULL,
  `ht_id` int(11) DEFAULT NULL,
  `st_id` int(11) DEFAULT NULL,
  `pt_id` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_role_page`
--

INSERT INTO `tbl_role_page` (`rp_id`, `role_id`, `ht_id`, `st_id`, `pt_id`) VALUES
(111, 6, 2, 3, 4),
(21, 7, 2, 3, 4),
(22, 7, 3, 4, 6),
(23, 4, 2, 3, 4),
(24, 4, 2, 3, 5),
(25, 4, 3, 4, 1),
(26, 4, 3, 4, 2),
(27, 4, 3, 4, 6),
(28, 4, 3, 4, 7),
(124, 1, 3, 4, 2),
(123, 1, 3, 4, 1),
(122, 1, 2, 3, 5),
(121, 1, 2, 3, 4),
(120, 1, 2, 3, 3),
(110, 6, 1, 2, 12),
(109, 6, 1, 2, 11),
(112, 6, 3, 4, 6),
(113, 3, 1, 2, 8),
(114, 3, 1, 2, 10),
(115, 3, 1, 2, 12),
(116, 3, 1, 2, 13),
(117, 3, 1, 2, 14),
(118, 3, 2, 3, 4),
(119, 3, 3, 4, 6);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_sub_title`
--

CREATE TABLE `tbl_sub_title` (
  `st_id` int(11) NOT NULL,
  `st_name` varchar(300) DEFAULT NULL,
  `icon_code` varchar(100) DEFAULT NULL,
  `ht_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_sub_title`
--

INSERT INTO `tbl_sub_title` (`st_id`, `st_name`, `icon_code`, `ht_id`) VALUES
(1, 'ລູກຄ້າ', 'mdi-home-account', 1),
(2, 'ສິນຄ້າ', 'mdi-expand-all', 1),
(3, 'ຜູ້ໃຊ້', 'mdi-account-supervisor', 2),
(4, 'ຂໍ້ມູນລະບົບ', 'mdi-server', 3),
(5, 'ການຂາຍ', 'mdi-palette-swatch', 4),
(6, 'ຢ້ຽມຢາມ', 'mdi-flag-variant', 4);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `usid` int(11) NOT NULL,
  `full_name` varchar(300) DEFAULT NULL,
  `user_name` varchar(30) DEFAULT NULL,
  `user_password` varchar(30) DEFAULT NULL,
  `role_id` int(11) DEFAULT NULL,
  `depart_id` int(11) DEFAULT NULL,
  `br_id` int(11) DEFAULT NULL,
  `user_status` int(11) DEFAULT NULL,
  `add_by` int(11) DEFAULT NULL,
  `date_register` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`usid`, `full_name`, `user_name`, `user_password`, `role_id`, `depart_id`, `br_id`, `user_status`, `add_by`, `date_register`) VALUES
(1, 'ຊຸບເປິແອັດມີນ', 'superadmin', '123', 1, 1, 1, 1, 1, '2023-03-13'),
(2, 'ບັນຊີ', 'accountant', '123', 2, 2, 1, 1, 1, '2023-03-13'),
(3, 'ແອັດມີນສາງ', 'adminstock', '123', 3, 3, 1, 1, 1, '2023-03-13'),
(4, 'ແອັດມິນລະບົບ', 'adminsystem', '123', 4, 1, 1, 1, 1, '2023-03-13'),
(5, 'ການຂາຍ', 'sale', '123', 5, 4, 1, 1, 1, '2023-03-13'),
(6, 'ສາຂາໜອງດ້ວງ', 'nongduang', '123', 6, 5, 2, 1, 1, '2023-03-13'),
(7, 'billy', 'billy', '123', 7, 5, 2, 1, 6, '2023-03-13');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_depart`
--
ALTER TABLE `tbl_depart`
  ADD PRIMARY KEY (`dp_id`);

--
-- Indexes for table `tbl_header_title`
--
ALTER TABLE `tbl_header_title`
  ADD PRIMARY KEY (`ht_id`);

--
-- Indexes for table `tbl_page_title`
--
ALTER TABLE `tbl_page_title`
  ADD PRIMARY KEY (`pt_id`);

--
-- Indexes for table `tbl_roles`
--
ALTER TABLE `tbl_roles`
  ADD PRIMARY KEY (`r_id`);

--
-- Indexes for table `tbl_role_level`
--
ALTER TABLE `tbl_role_level`
  ADD PRIMARY KEY (`rl_id`);

--
-- Indexes for table `tbl_role_page`
--
ALTER TABLE `tbl_role_page`
  ADD PRIMARY KEY (`rp_id`);

--
-- Indexes for table `tbl_sub_title`
--
ALTER TABLE `tbl_sub_title`
  ADD PRIMARY KEY (`st_id`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`usid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_depart`
--
ALTER TABLE `tbl_depart`
  MODIFY `dp_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tbl_header_title`
--
ALTER TABLE `tbl_header_title`
  MODIFY `ht_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_page_title`
--
ALTER TABLE `tbl_page_title`
  MODIFY `pt_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `tbl_roles`
--
ALTER TABLE `tbl_roles`
  MODIFY `r_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tbl_role_level`
--
ALTER TABLE `tbl_role_level`
  MODIFY `rl_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_role_page`
--
ALTER TABLE `tbl_role_page`
  MODIFY `rp_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=125;

--
-- AUTO_INCREMENT for table `tbl_sub_title`
--
ALTER TABLE `tbl_sub_title`
  MODIFY `st_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `usid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
