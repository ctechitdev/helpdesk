-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 22, 2023 at 05:26 AM
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
(3, 'ບຸກຄະລາກອນ'),
(4, 'BSD'),
(5, 'Shell'),
(6, 'FMCG'),
(8, 'Kubota'),
(9, 'KPTL'),
(10, 'Logistic'),
(11, 'Toto'),
(12, 'Yamaha');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_issue_category`
--

INSERT INTO `tbl_issue_category` (`isc_id`, `isc_name`) VALUES
(1, 'ບັນຫາຄອມພິວເຕີ'),
(2, 'ບັນຫາລະບົບ');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_issue_history`
--

INSERT INTO `tbl_issue_history` (`ih_id`, `ir_id`, `ir_state`, `ih_detail`, `update_by`, `update_date`) VALUES
(1, 1, 1, 'ຄອມເປີດບໍ່ຂື້ນ', NULL, NULL),
(2, 1, 1, 'ຕິດຕາມ', 3, '2023-05-22'),
(3, 1, 2, 'ຕິດຕາມ 1', 3, '2023-05-22'),
(4, 1, 2, 'ຕິດຕາມ 2', 3, '2023-05-22'),
(5, 1, 4, 'ລໍຖ້າອາໄຫຼ່', 3, '2023-05-22'),
(6, 2, 1, 'ເຂົ້າບໍ່ໄດ້', NULL, NULL),
(7, 2, 2, 'ກຳລັງແກ້ໄຂ', 4, '2023-05-22'),
(8, 2, 3, 'ປິດສຳເລັດ', NULL, NULL),
(9, 1, 3, 'ແກ້ແລ້ວ', 3, '2023-05-22');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_issue_request`
--

CREATE TABLE `tbl_issue_request` (
  `ir_id` int(11) NOT NULL,
  `ist_id` int(11) DEFAULT NULL,
  `ir_state` int(11) DEFAULT NULL,
  `ir_detail` text DEFAULT NULL,
  `reqeust_by` int(11) DEFAULT NULL,
  `request_date` date DEFAULT NULL,
  `assign_by` int(11) DEFAULT NULL,
  `assign_date` date DEFAULT NULL,
  `rate_point` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_issue_request`
--

INSERT INTO `tbl_issue_request` (`ir_id`, `ist_id`, `ir_state`, `ir_detail`, `reqeust_by`, `request_date`, `assign_by`, `assign_date`, `rate_point`) VALUES
(1, 1, 3, 'ຄອມເປີດບໍ່ຂື້ນ', 2, '2023-05-22', 3, '2023-05-22', 5),
(2, 3, 3, 'ເຂົ້າບໍ່ໄດ້', 2, '2023-05-22', 4, '2023-05-22', 3);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_issue_status`
--

CREATE TABLE `tbl_issue_status` (
  `is_id` int(11) NOT NULL,
  `is_name` varchar(300) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_issue_status`
--

INSERT INTO `tbl_issue_status` (`is_id`, `is_name`) VALUES
(1, 'ລໍຖ້າຮັບ'),
(2, 'ກຳລັງດຳເນີນການ'),
(3, 'ປິດບັນຫາ'),
(4, 'ລໍຖ້າແກ້ໄຂ');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_issue_type`
--

CREATE TABLE `tbl_issue_type` (
  `ist_id` int(11) NOT NULL,
  `isc_id` int(11) DEFAULT NULL,
  `ist_name` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_issue_type`
--

INSERT INTO `tbl_issue_type` (`ist_id`, `isc_id`, `ist_name`) VALUES
(1, 1, 'ຄອມເປີດບໍ່ໄດ້'),
(2, 1, 'ບໍມີໂປແກຣມ'),
(3, 2, 'ໂປຣແກມລາພັກ'),
(4, 2, 'ໂປຣແກມຂາຍ');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_item_data`
--

CREATE TABLE `tbl_item_data` (
  `item_id` int(11) NOT NULL,
  `item_name` varchar(300) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_item_data`
--

INSERT INTO `tbl_item_data` (`item_id`, `item_name`) VALUES
(1, 'ບິກ'),
(2, 'ສໍ');

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
(5, 'ຈັດການສິດ', 'role-manage.php ', 3),
(15, 'ແຈ້ງບ້ນຫາ', 'issue-request.php', 1),
(17, 'ຮັບບັນຫາ', 'issue-recieve.php', 1),
(18, 'ຄຳຂໍນຳໃຊ້ອີເມວ', 'form-request-email.php', 2),
(19, 'ລາຍລະອຽດອີເມວ', 'form-email-update.php', 2),
(20, 'ປິດບັນຫາ', 'Closing-rating.php', 1),
(21, 'ອັຟເດດບັນຫາ', 'issue-update-follow.php', 1),
(22, 'ຟອມຄຳຂໍນຳໃຊ້ອຸປະກອນ', 'form-request-item-use.php', 2);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_request_email`
--

INSERT INTO `tbl_request_email` (`re_id`, `user_id`, `user_email`, `pass_email`, `date_request`, `update_by`, `date_update`, `state`) VALUES
(6, 2, NULL, NULL, '2023-05-22', NULL, NULL, 2),
(7, 5, NULL, NULL, '2023-05-22', NULL, NULL, NULL),
(8, 3, NULL, NULL, '2023-05-22', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_request_status`
--

CREATE TABLE `tbl_request_status` (
  `rs_id` int(11) NOT NULL,
  `rs_name` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_request_use_item`
--

INSERT INTO `tbl_request_use_item` (`rui_id`, `rui_bill_number`, `rs_id`, `depart_id`, `request_by`, `reqeust_date`) VALUES
(1, NULL, 1, 2, 2, '2023-05-22'),
(2, NULL, 1, 3, 5, '2023-05-22');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_request_use_item_detail`
--

CREATE TABLE `tbl_request_use_item_detail` (
  `riud_id` int(11) NOT NULL,
  `rui_id` int(11) DEFAULT NULL,
  `item_id` int(11) DEFAULT NULL,
  `item_value` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_request_use_item_detail`
--

INSERT INTO `tbl_request_use_item_detail` (`riud_id`, `rui_id`, `item_id`, `item_value`) VALUES
(1, 1, 1, 10),
(2, 1, 2, 10),
(3, 2, 1, 2),
(4, 2, 2, 3);

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
(2, 'ຜູ້ແຈ້ງບັນຫາ', 5),
(3, 'ຜູ້ແກ້ບັນຫາ', 2);

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
(1, 1, 1, 1, 15),
(2, 1, 1, 1, 17),
(3, 1, 1, 1, 20),
(4, 1, 1, 1, 21),
(5, 1, 1, 2, 18),
(6, 1, 1, 2, 19),
(7, 1, 1, 2, 22),
(8, 1, 2, 3, 3),
(9, 1, 2, 3, 4),
(10, 1, 2, 3, 5),
(11, 1, 3, 4, 1),
(12, 1, 3, 4, 2),
(13, 2, 1, 1, 15),
(14, 2, 1, 2, 18),
(15, 2, 1, 2, 22),
(16, 3, 1, 1, 15),
(17, 3, 1, 1, 17),
(18, 3, 1, 1, 20),
(19, 3, 1, 1, 21),
(20, 3, 1, 2, 18),
(21, 3, 1, 2, 19),
(22, 3, 1, 2, 22),
(23, 3, 2, 3, 3),
(24, 3, 2, 3, 4),
(25, 3, 2, 3, 5),
(26, 3, 3, 4, 1),
(27, 3, 3, 4, 2);

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
  `date_register` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`usid`, `full_name`, `user_name`, `user_password`, `role_id`, `depart_id`, `user_status`, `add_by`, `date_register`) VALUES
(1, 'ຊຸບເປິແອັດມີນ', 'superadmin', '123', 1, 1, 1, 1, '2023-05-22'),
(2, 'ບິນລີ້1', 'Testing', '123', 2, 2, 1, 1, '2023-05-22'),
(3, 'ບິນລີ້2', 'admin', '123', 3, 1, 1, 1, '2023-05-22'),
(4, 'ບິນລີ້3', 'admin2', '123', 3, 1, 1, 3, '2023-05-22'),
(5, 'ບັນຊີ2', 'testing2', '123', 2, 3, 1, 3, '2023-05-22');

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
  MODIFY `dp_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tbl_header_title`
--
ALTER TABLE `tbl_header_title`
  MODIFY `ht_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_issue_category`
--
ALTER TABLE `tbl_issue_category`
  MODIFY `isc_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_issue_history`
--
ALTER TABLE `tbl_issue_history`
  MODIFY `ih_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tbl_issue_request`
--
ALTER TABLE `tbl_issue_request`
  MODIFY `ir_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_issue_status`
--
ALTER TABLE `tbl_issue_status`
  MODIFY `is_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_issue_type`
--
ALTER TABLE `tbl_issue_type`
  MODIFY `ist_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_item_data`
--
ALTER TABLE `tbl_item_data`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_page_title`
--
ALTER TABLE `tbl_page_title`
  MODIFY `pt_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `tbl_request_email`
--
ALTER TABLE `tbl_request_email`
  MODIFY `re_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tbl_request_status`
--
ALTER TABLE `tbl_request_status`
  MODIFY `rs_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_request_use_item`
--
ALTER TABLE `tbl_request_use_item`
  MODIFY `rui_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_request_use_item_detail`
--
ALTER TABLE `tbl_request_use_item_detail`
  MODIFY `riud_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

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
  MODIFY `rp_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `tbl_sub_title`
--
ALTER TABLE `tbl_sub_title`
  MODIFY `st_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `usid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
