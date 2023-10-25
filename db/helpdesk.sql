-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 25, 2023 at 08:03 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 7.4.33

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_depart`
--

INSERT INTO `tbl_depart` (`dp_id`, `dp_name`) VALUES
(1, 'ໄອທີ'),
(2, 'ບັນຊີ'),
(3, 'ບຸກຄະລາກອນ'),
(4, 'BSD'),
(5, 'Shell'),
(6, 'FMCG'),
(8, 'Kubota'),
(9, 'KPTL'),
(10, 'Logistic'),
(11, 'Toto'),
(12, 'Yamaha'),
(13, 'ຢາງ');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_email_status`
--

CREATE TABLE `tbl_email_status` (
  `email_status_id` int(11) NOT NULL,
  `email_status_name` varchar(120) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_email_status`
--

INSERT INTO `tbl_email_status` (`email_status_id`, `email_status_name`) VALUES
(1, 'ດຳເນີນການ'),
(2, 'ເປີດນຳໃຊ້'),
(3, 'ປີດນຳໃຊ້');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_header_title`
--

CREATE TABLE `tbl_header_title` (
  `ht_id` int(11) NOT NULL,
  `ht_name` varchar(300) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_header_title`
--

INSERT INTO `tbl_header_title` (`ht_id`, `ht_name`) VALUES
(1, 'Issue Data'),
(2, 'Form Data'),
(3, 'System Data'),
(4, 'Sale Data');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_issue_category`
--

CREATE TABLE `tbl_issue_category` (
  `isc_id` int(11) NOT NULL,
  `isc_name` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_issue_category`
--

INSERT INTO `tbl_issue_category` (`isc_id`, `isc_name`) VALUES
(1, 'ອຸປະກອນ'),
(2, 'ນຳໃຊ້ໂປຣແກຣມ'),
(3, 'ລະບົບ'),
(4, 'ການເຊື່ອມຕໍ່');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_issue_history`
--

CREATE TABLE `tbl_issue_history` (
  `ih_id` int(11) NOT NULL,
  `ir_id` int(11) DEFAULT NULL,
  `ir_state` int(11) DEFAULT NULL,
  `ih_detail` text DEFAULT NULL,
  `update_by` int(11) DEFAULT NULL,
  `update_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_issue_request`
--

CREATE TABLE `tbl_issue_request` (
  `ir_id` int(11) NOT NULL,
  `issue_category_id` int(11) DEFAULT NULL,
  `ist_id` int(11) DEFAULT NULL,
  `ir_state` int(11) DEFAULT NULL,
  `ir_detail` text DEFAULT NULL,
  `reqeust_by` int(11) DEFAULT NULL,
  `request_date` date DEFAULT NULL,
  `assign_by` int(11) DEFAULT NULL,
  `assign_date` date DEFAULT NULL,
  `rate_point` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_issue_status`
--

CREATE TABLE `tbl_issue_status` (
  `is_id` int(11) NOT NULL,
  `is_name` varchar(300) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_issue_status`
--

INSERT INTO `tbl_issue_status` (`is_id`, `is_name`) VALUES
(1, 'ກຳລັງດຳເນີນການ'),
(2, 'ປິດບັນຫາ'),
(3, 'ລໍຖ້າແກ້ໄຂ');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_issue_type`
--

CREATE TABLE `tbl_issue_type` (
  `ist_id` int(11) NOT NULL,
  `isc_id` int(11) DEFAULT NULL,
  `ist_name` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_issue_type`
--

INSERT INTO `tbl_issue_type` (`ist_id`, `isc_id`, `ist_name`) VALUES
(1, 1, 'ຄອມພິວເຕີ'),
(2, 1, 'ພິນເຕີ້'),
(3, 1, 'ກ້ອງ'),
(4, 2, 'MS Word'),
(5, 2, 'MS Exel'),
(8, 2, 'MS Outlook'),
(9, 2, 'MS Power Point'),
(10, 2, 'Line'),
(11, 2, 'Whatapp'),
(12, 2, 'PDF'),
(13, 3, 'SAPB1'),
(15, 3, 'Crystal report'),
(16, 3, 'Finger Scan'),
(17, 3, 'KPCR'),
(18, 3, 'Tyre Sales'),
(19, 3, 'ໂປຣແກຣມລາພັກ'),
(20, 4, 'ອິນເຕີເນັດ'),
(21, 4, 'ແຊຣເຊີບເວີ້');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_item_data`
--

CREATE TABLE `tbl_item_data` (
  `item_id` int(11) NOT NULL,
  `item_name` varchar(300) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_item_data`
--

INSERT INTO `tbl_item_data` (`item_id`, `item_name`) VALUES
(1, 'Server'),
(2, 'Desktop'),
(3, 'Notebook'),
(4, 'Netbook'),
(5, 'Tablet & Ipad'),
(6, 'Printer'),
(7, 'UPS'),
(8, 'Firewall'),
(9, 'Switch / Wifi'),
(10, 'Monitor'),
(11, 'N-Computing'),
(12, 'Scanner'),
(13, 'Sound Equipment'),
(14, 'Projector'),
(15, 'Screen'),
(16, 'Digital Video Recorder (DVR/XVR)'),
(17, 'CCTV'),
(18, 'Digital Camera'),
(19, 'Webcam'),
(20, 'Microphone Meeting 360 USB'),
(21, 'Finger Scanner'),
(22, 'Hard disk (Internal / External)'),
(23, 'Television (TV)'),
(24, 'Converter'),
(25, 'Laser Pointer'),
(26, 'Barcode Scanner'),
(27, 'Keyboard & Mouse USB'),
(28, 'Keyboard & Mouse wireless'),
(29, 'Mouse pad'),
(30, 'Telephone'),
(31, 'Adaptor (Notebook / AIO / Other)'),
(32, 'Notebook Battery'),
(33, 'Notebook Monitor'),
(34, 'Notebook Keyboard'),
(35, 'Plug Socket'),
(36, 'RAM'),
(37, 'Access control'),
(38, 'Win Server'),
(39, 'SQL Server'),
(40, 'SAP-B1'),
(41, 'Windows'),
(42, 'Ms Office'),
(43, 'Zoom meeting'),
(44, 'Vansales'),
(45, 'Firewall License');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_page_title`
--

CREATE TABLE `tbl_page_title` (
  `pt_id` int(11) NOT NULL,
  `pt_name` varchar(300) DEFAULT NULL,
  `ptf_name` varchar(100) DEFAULT NULL,
  `st_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_page_title`
--

INSERT INTO `tbl_page_title` (`pt_id`, `pt_name`, `ptf_name`, `st_id`) VALUES
(1, 'ພະແນກ', 'depart.php', 4),
(2, 'ຫນ້າຟັງຊັ້ນ', 'page-function.php', 4),
(3, 'ສ້າງສິດ', 'roles.php', 3),
(4, 'ຜູ້ໃຊ້', 'user-staff.php', 3),
(5, 'ຈັດການສິດ', 'role-manage.php ', 3),
(15, 'ແຈ້ງບ້ນຫາ', 'issue-request.php', 1),
(17, 'ລາຍການບັນຫາ', 'issue-list.php', 1),
(18, 'ຄຳຂໍນຳໃຊ້ອີເມວ', 'form-request-email.php', 2),
(19, 'ລາຍລະອຽດອີເມວ', 'form-email-update.php', 2),
(20, 'ອັຟເດດບັນຫາ', 'issue-update.php', 1),
(22, 'ຟອມຄຳຂໍນຳໃຊ້ອຸປະກອນ', 'form-request-item-use.php', 2),
(23, 'ລາຍການຂໍອຸປະກອນ', 'view-item-request-list.php', 2);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_request_email`
--

CREATE TABLE `tbl_request_email` (
  `re_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `user_email` varchar(100) DEFAULT NULL,
  `pass_email` varchar(30) DEFAULT NULL,
  `date_request` date DEFAULT NULL,
  `update_by` int(11) DEFAULT NULL,
  `date_update` date DEFAULT NULL,
  `state` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_request_email`
--

INSERT INTO `tbl_request_email` (`re_id`, `user_id`, `user_email`, `pass_email`, `date_request`, `update_by`, `date_update`, `state`) VALUES
(4, 3, 'soukthivavnh@kplaocompany.com', '1234', '2023-10-24', 3, '2023-10-24', 2),
(5, 15, 'mayeena@kplaocompany.com', '1234', '2023-10-24', 3, '2023-10-24', 2);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_request_status`
--

CREATE TABLE `tbl_request_status` (
  `rs_id` int(11) NOT NULL,
  `rs_name` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_request_status`
--

INSERT INTO `tbl_request_status` (`rs_id`, `rs_name`) VALUES
(1, 'ລໍຖ້າ'),
(2, 'ອານຸມັດ');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_request_use_item`
--

CREATE TABLE `tbl_request_use_item` (
  `rui_id` int(11) NOT NULL,
  `rui_bill_number` varchar(30) DEFAULT NULL,
  `rs_id` int(11) DEFAULT NULL,
  `depart_id` int(11) DEFAULT NULL,
  `request_by` int(11) DEFAULT NULL,
  `reqeust_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_request_use_item`
--

INSERT INTO `tbl_request_use_item` (`rui_id`, `rui_bill_number`, `rs_id`, `depart_id`, `request_by`, `reqeust_date`) VALUES
(2, NULL, 1, 3, 6, '2023-08-16'),
(3, NULL, 1, 1, 1, '2023-08-17'),
(4, '$', 1, 1, 1, '2023-08-17'),
(6, '$', 1, 1, 3, '2023-10-24');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_request_use_item_detail`
--

CREATE TABLE `tbl_request_use_item_detail` (
  `riud_id` int(11) NOT NULL,
  `rui_id` int(11) DEFAULT NULL,
  `item_id` int(11) DEFAULT NULL,
  `item_value` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_request_use_item_detail`
--

INSERT INTO `tbl_request_use_item_detail` (`riud_id`, `rui_id`, `item_id`, `item_value`) VALUES
(2, 2, 1, 123),
(3, 3, 37, 1),
(4, 3, 17, 3),
(5, 4, 17, 34),
(6, 4, 17, 12),
(9, 6, 37, 123),
(10, 6, 20, 12);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_roles`
--

CREATE TABLE `tbl_roles` (
  `r_id` int(11) NOT NULL,
  `role_name` varchar(150) DEFAULT NULL,
  `role_level` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_roles`
--

INSERT INTO `tbl_roles` (`r_id`, `role_name`, `role_level`) VALUES
(1, 'ຊຸບເປີແອັດມີນ', 1),
(2, 'ຜູ້ແຈ້ງບັນຫາ', 5),
(3, 'ຜູ້ແກ້ບັນຫາ', 2);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_role_level`
--

CREATE TABLE `tbl_role_level` (
  `rl_id` int(11) NOT NULL,
  `rl_name` varchar(90) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbl_role_page`
--

INSERT INTO `tbl_role_page` (`rp_id`, `role_id`, `ht_id`, `st_id`, `pt_id`) VALUES
(52, 1, 3, 4, 2),
(51, 1, 3, 4, 1),
(50, 1, 2, 3, 5),
(49, 1, 2, 3, 4),
(48, 1, 2, 3, 3),
(47, 1, 1, 2, 23),
(46, 1, 1, 2, 22),
(45, 1, 1, 2, 19),
(44, 1, 1, 2, 18),
(43, 1, 1, 1, 20),
(42, 1, 1, 1, 17),
(13, 2, 1, 1, 15),
(14, 2, 1, 2, 18),
(15, 2, 1, 2, 22),
(63, 3, 3, 4, 2),
(62, 3, 3, 4, 1),
(61, 3, 2, 3, 5),
(60, 3, 2, 3, 4),
(59, 3, 2, 3, 3),
(58, 3, 1, 2, 22),
(57, 3, 1, 2, 19),
(56, 3, 1, 2, 18),
(55, 3, 1, 1, 20),
(54, 3, 1, 1, 17),
(53, 3, 1, 1, 15),
(41, 1, 1, 1, 15);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_sub_title`
--

CREATE TABLE `tbl_sub_title` (
  `st_id` int(11) NOT NULL,
  `st_name` varchar(300) DEFAULT NULL,
  `icon_code` varchar(100) DEFAULT NULL,
  `ht_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_sub_title`
--

INSERT INTO `tbl_sub_title` (`st_id`, `st_name`, `icon_code`, `ht_id`) VALUES
(1, 'ບັນຫາ', 'mdi-home-account', 1),
(2, 'ຟອມ', 'mdi-expand-all', 1),
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
  `user_status` int(11) DEFAULT NULL,
  `add_by` int(11) DEFAULT NULL,
  `date_register` date DEFAULT NULL,
  `token_line` varchar(200) DEFAULT NULL,
  `active_status` int(11) DEFAULT NULL,
  `phone_number` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`usid`, `full_name`, `user_name`, `user_password`, `role_id`, `depart_id`, `user_status`, `add_by`, `date_register`, `token_line`, `active_status`, `phone_number`) VALUES
(1, 'ຊຸບເປິແອັດມີນ', 'superadmin', '123', 1, 1, 1, 1, '2023-05-22', NULL, NULL, NULL),
(2, 'ສຸກນາວີ', 'souknavy', '123', 3, 1, 1, 1, '2023-05-22', NULL, 1, 22224584),
(3, 'ສຸກທິວາວັນ', 'soukthivavanh', '123', 3, 1, 1, 1, '2023-05-22', '5ckKBtA2JoIlj7A2OyF6jXWgLSDJISQHdBry58WVPbI', 1, 55609011),
(4, 'ໂອເຄ', 'okay', '123', 3, 1, 1, 1, '2023-05-22', NULL, 1, 55110607),
(5, 'ພຸດທາ', 'phouttha', '123', 2, 1, 1, 1, '2023-05-22', NULL, 1, 77775829),
(6, 'ອານຸລັກ', 'anouluck@kplaocompany.com', '123', 2, 3, 1, 1, '2023-08-16', NULL, NULL, NULL),
(7, 'ເກດມະນີ', 'kedmany@kplaocompany.com', '123', 2, 6, 1, 1, '2023-08-16', NULL, NULL, NULL),
(8, 'ອານຸສອນ', 'anousone@kplaocompany.com', '123', 2, 13, 1, 1, '2023-08-16', NULL, NULL, NULL),
(9, 'ຄຳໝາຍ', 'khammaiy@kplaocompany.com', '123', 2, 6, 1, 1, '2023-08-16', NULL, NULL, NULL),
(10, 'ຄຳຫຼ້າ', 'khamla_s@kplaocompany.com', '123', 2, 6, 1, 1, '2023-08-16', NULL, NULL, NULL),
(11, 'ສຸກກິດຕາ', 'soukkitar@kplaocompany.com', '123', 2, 12, 1, 1, '2023-08-16', NULL, NULL, NULL),
(12, 'ພົງວະດີ', 'phongvady@kplaocompany.com', '123', 2, 13, 1, 1, '2023-08-16', NULL, NULL, NULL),
(13, 'ສຸກພະໄຊ', 'soukphaxay@kplaocompany.com', '123', 2, 6, 1, 1, '2023-08-16', NULL, NULL, NULL),
(14, 'ປານິນ', 'panin@kplaocompany.com', '123', 2, 11, 1, 1, '2023-08-16', NULL, NULL, NULL),
(15, 'ມາຢີນາ', 'mayeena@kplaocompany.com', '123', 2, 8, 1, 1, '2023-08-16', NULL, NULL, NULL),
(16, 'ອາລິສາ', 'alisa@kplaocompany.com', '123', 2, 6, 1, 1, '2023-08-16', NULL, NULL, NULL),
(17, 'ອຸໄທ', 'outhai@kplaocompany.com', '123', 2, 8, 1, 1, '2023-08-16', NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_depart`
--
ALTER TABLE `tbl_depart`
  ADD PRIMARY KEY (`dp_id`);

--
-- Indexes for table `tbl_email_status`
--
ALTER TABLE `tbl_email_status`
  ADD PRIMARY KEY (`email_status_id`);

--
-- Indexes for table `tbl_header_title`
--
ALTER TABLE `tbl_header_title`
  ADD PRIMARY KEY (`ht_id`);

--
-- Indexes for table `tbl_issue_category`
--
ALTER TABLE `tbl_issue_category`
  ADD PRIMARY KEY (`isc_id`);

--
-- Indexes for table `tbl_issue_history`
--
ALTER TABLE `tbl_issue_history`
  ADD PRIMARY KEY (`ih_id`);

--
-- Indexes for table `tbl_issue_request`
--
ALTER TABLE `tbl_issue_request`
  ADD PRIMARY KEY (`ir_id`);

--
-- Indexes for table `tbl_issue_status`
--
ALTER TABLE `tbl_issue_status`
  ADD PRIMARY KEY (`is_id`);

--
-- Indexes for table `tbl_issue_type`
--
ALTER TABLE `tbl_issue_type`
  ADD PRIMARY KEY (`ist_id`);

--
-- Indexes for table `tbl_item_data`
--
ALTER TABLE `tbl_item_data`
  ADD PRIMARY KEY (`item_id`);

--
-- Indexes for table `tbl_page_title`
--
ALTER TABLE `tbl_page_title`
  ADD PRIMARY KEY (`pt_id`);

--
-- Indexes for table `tbl_request_email`
--
ALTER TABLE `tbl_request_email`
  ADD PRIMARY KEY (`re_id`);

--
-- Indexes for table `tbl_request_status`
--
ALTER TABLE `tbl_request_status`
  ADD PRIMARY KEY (`rs_id`);

--
-- Indexes for table `tbl_request_use_item`
--
ALTER TABLE `tbl_request_use_item`
  ADD PRIMARY KEY (`rui_id`);

--
-- Indexes for table `tbl_request_use_item_detail`
--
ALTER TABLE `tbl_request_use_item_detail`
  ADD PRIMARY KEY (`riud_id`);

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
  MODIFY `dp_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `tbl_email_status`
--
ALTER TABLE `tbl_email_status`
  MODIFY `email_status_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_header_title`
--
ALTER TABLE `tbl_header_title`
  MODIFY `ht_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_issue_category`
--
ALTER TABLE `tbl_issue_category`
  MODIFY `isc_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_issue_history`
--
ALTER TABLE `tbl_issue_history`
  MODIFY `ih_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_issue_request`
--
ALTER TABLE `tbl_issue_request`
  MODIFY `ir_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_issue_status`
--
ALTER TABLE `tbl_issue_status`
  MODIFY `is_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_issue_type`
--
ALTER TABLE `tbl_issue_type`
  MODIFY `ist_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `tbl_item_data`
--
ALTER TABLE `tbl_item_data`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `tbl_page_title`
--
ALTER TABLE `tbl_page_title`
  MODIFY `pt_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `tbl_request_email`
--
ALTER TABLE `tbl_request_email`
  MODIFY `re_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_request_status`
--
ALTER TABLE `tbl_request_status`
  MODIFY `rs_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_request_use_item`
--
ALTER TABLE `tbl_request_use_item`
  MODIFY `rui_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_request_use_item_detail`
--
ALTER TABLE `tbl_request_use_item_detail`
  MODIFY `riud_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tbl_roles`
--
ALTER TABLE `tbl_roles`
  MODIFY `r_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_role_level`
--
ALTER TABLE `tbl_role_level`
  MODIFY `rl_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_role_page`
--
ALTER TABLE `tbl_role_page`
  MODIFY `rp_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT for table `tbl_sub_title`
--
ALTER TABLE `tbl_sub_title`
  MODIFY `st_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `usid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
