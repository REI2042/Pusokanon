-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Generation Time: Jul 03, 2024 at 04:36 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `database_pusokanon`
--

-- --------------------------------------------------------

--
-- Table structure for table `account_role`
--

CREATE TABLE `account_role` (
  `userRole_id` int(11) NOT NULL,
  `role_definition` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `account_role`
--

INSERT INTO `account_role` (`userRole_id`, `role_definition`) VALUES
(1, 'Captain'),
(2, 'Resident'),
(3, 'secretary');

-- --------------------------------------------------------

--
-- Table structure for table `barangay_staff`
--

CREATE TABLE `barangay_staff` (
  `staff_id` int(11) NOT NULL,
  `staff_fname` varchar(50) NOT NULL,
  `staff_lname` varchar(50) NOT NULL,
  `staff_midname` varchar(50) NOT NULL,
  `staff_suffix` varchar(20) DEFAULT NULL,
  `birth_date` date NOT NULL,
  `gender` varchar(20) NOT NULL,
  `year_of_service` date NOT NULL,
  `contact_no` varchar(13) NOT NULL,
  `userRole_id` int(11) NOT NULL,
  `registered_voters` varchar(10) NOT NULL,
  `addr_sitio` text NOT NULL,
  `addr_purok` text NOT NULL,
  `staff_email` varchar(100) NOT NULL,
  `staff_password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `barangay_staff`
--

INSERT INTO `barangay_staff` (`staff_id`, `staff_fname`, `staff_lname`, `staff_midname`, `staff_suffix`, `birth_date`, `gender`, `year_of_service`, `contact_no`, `userRole_id`, `registered_voters`, `addr_sitio`, `addr_purok`, `staff_email`, `staff_password`) VALUES
(2, 'Ranie', 'Godinez', 'EMPERIO', NULL, '0000-00-00', '', '0000-00-00', '', 1, '', '', '', 'Admin', '2402'),
(3, 'airene', 'mabulay', 'cabunilas', NULL, '0000-00-00', '', '0000-00-00', '', 3, '', '', '', 'secretary', '2402');

-- --------------------------------------------------------

--
-- Table structure for table `complaints_tbl`
--

CREATE TABLE `complaints_tbl` (
  `complaint_id` int(11) NOT NULL,
  `res_id` int(11) NOT NULL,
  `respondent_fname` varchar(50) NOT NULL,
  `respondent_mname` varchar(50) DEFAULT NULL,
  `respondent_lname` varchar(50) NOT NULL,
  `respondent_suffix` varchar(10) DEFAULT NULL,
  `respondent_gender` varchar(10) NOT NULL,
  `respondent_age` int(11) NOT NULL,
  `incident_date` date NOT NULL,
  `incident_time` time NOT NULL,
  `date_filed` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `incident_place` varchar(50) NOT NULL,
  `case_type` varchar(50) NOT NULL,
  `narrative` text DEFAULT NULL,
  `staff_id` int(11) NOT NULL,
  `status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `complaints_tbl`
--

INSERT INTO `complaints_tbl` (`complaint_id`, `res_id`, `respondent_fname`, `respondent_mname`, `respondent_lname`, `respondent_suffix`, `respondent_gender`, `respondent_age`, `incident_date`, `incident_time`, `date_filed`, `incident_place`, `case_type`, `narrative`, `staff_id`, `status`) VALUES
(1, 21, 'Nino Rey', '', 'Cabunilas', ' ', 'Male', 22, '2024-05-24', '18:30:00', '2024-07-02 11:06:36', 'Sewage', 'Threat', 'hakdog.', 2, 'pending'),
(2, 21, 'Nino Rey', '', 'Cabunilas', ' ', 'Male', 22, '2024-05-24', '18:30:00', '2024-07-02 11:08:07', 'Sewage', 'Threat', 'hakdog.', 2, 'pending'),
(3, 21, 'Demi', 'The', 'Great', ' ', 'Female', 26, '2024-03-20', '10:30:00', '2024-07-02 11:08:53', 'Lawis', 'Physical Abuse', 'She slapped me in the face.', 2, 'pending'),
(4, 21, 'Dwight', '', 'Callahan', 'II.', 'Male', 24, '2024-06-30', '03:02:00', '2024-07-02 11:09:58', 'Sta. Maria', 'Bullying', 'Bullied my forehead', 2, 'pending'),
(5, 21, 'Dwight', '', 'Callahan', 'II.', 'Male', 24, '2024-06-30', '03:02:00', '2024-07-02 17:12:10', 'Sta. Maria', 'Bullying', 'Bullied my forehead', 2, 'pending'),
(6, 21, 'Regina', '', 'Cotoner', ' ', 'Female', 32, '2024-03-26', '17:25:00', '2024-07-02 17:13:41', 'Chumba-Chumba', 'Physical Abuse', 'she broke my ankleeeeeeeeeeeeeee', 2, 'pending'),
(7, 21, 'Demitria', '', 'Mabulay', ' ', 'Female', 25, '2024-05-15', '16:06:00', '2024-07-02 17:15:40', 'Arca', 'Bullying', 'hiihpop', 2, 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `docs_purpose`
--

CREATE TABLE `docs_purpose` (
  `purpose_id` int(11) NOT NULL,
  `purpose_name` varchar(50) NOT NULL,
  `pupose_fee` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `docs_purpose`
--

INSERT INTO `docs_purpose` (`purpose_id`, `purpose_name`, `pupose_fee`) VALUES
(1, 'Employment', 0),
(2, 'Students Scholarship', 0),
(3, 'Person With Disability Assistance', 0),
(4, 'Senior Citizen Assistance', 0),
(5, 'Other', 80);

-- --------------------------------------------------------

--
-- Table structure for table `doc_type`
--

CREATE TABLE `doc_type` (
  `docType_id` int(11) NOT NULL,
  `doc_name` varchar(100) NOT NULL,
  `doc_amount` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `doc_type`
--

INSERT INTO `doc_type` (`docType_id`, `doc_name`, `doc_amount`) VALUES
(1, 'Barangay Clearance', 80),
(2, 'Barangay Indigency', 50),
(3, 'Cedula', 50),
(4, 'Barangay Residency', 50),
(5, 'Barangay Electrical Permit', 500),
(6, 'Barangay Construction Permit', 500),
(7, 'Barangay Fencing Permit', 500),
(8, 'Barangay Business Clearance', 630);

-- --------------------------------------------------------

--
-- Table structure for table `registration_tbl`
--

CREATE TABLE `registration_tbl` (
  `res_ID` int(11) NOT NULL,
  `res_fname` varchar(50) DEFAULT NULL,
  `res_lname` varchar(50) DEFAULT NULL,
  `res_midname` varchar(50) DEFAULT NULL,
  `res_suffix` varchar(50) DEFAULT NULL,
  `gender` varchar(10) DEFAULT NULL,
  `birth_date` date DEFAULT NULL,
  `civil_status` varchar(20) DEFAULT NULL,
  `registered_voter` varchar(15) DEFAULT NULL,
  `citizenship` varchar(50) DEFAULT NULL,
  `contact_no` varchar(13) DEFAULT NULL,
  `place_birth` varchar(100) DEFAULT NULL,
  `addr_sitio` varchar(100) DEFAULT NULL,
  `addr_purok` varchar(100) DEFAULT NULL,
  `res_email` varchar(100) DEFAULT NULL,
  `res_password` varchar(100) DEFAULT NULL,
  `userRole_id` int(11) DEFAULT NULL,
  `verification_image` varchar(200) DEFAULT NULL,
  `register_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `registration_tbl`
--

INSERT INTO `registration_tbl` (`res_ID`, `res_fname`, `res_lname`, `res_midname`, `res_suffix`, `gender`, `birth_date`, `civil_status`, `registered_voter`, `citizenship`, `contact_no`, `place_birth`, `addr_sitio`, `addr_purok`, `res_email`, `res_password`, `userRole_id`, `verification_image`, `register_at`) VALUES
(22, 'jgajsd', 'a,jsdhkasd', 'akasihasd', 'Sr.', 'Male', '2007-11-02', 'Single', 'Registered', '2342342', '3t463523', 'wefs', 'sfsdf', '', 'asd@gailcom', '1234', 2, 'draw.jpg', '2024-05-07 17:32:02'),
(23, 'sdfsdf', 'dfgfdg', 'dfgdfgd', 'Jr', 'Female', '2007-01-11', 'Single', 'Not-registered', 'xxv', 'cvbc', 'dfgdf', 'dfg', 'dfgh', 'yow@gmail.com', '2402', 2, 'browsing.jpg', '2024-05-22 10:18:55');

-- --------------------------------------------------------

--
-- Table structure for table `request_doc`
--

CREATE TABLE `request_doc` (
  `doc_ID` int(11) NOT NULL,
  `res_id` int(11) NOT NULL,
  `docType_id` int(11) NOT NULL,
  `purpose_id` int(11) NOT NULL,
  `purpose_name` varchar(255) DEFAULT NULL,
  `stat` varchar(50) NOT NULL DEFAULT 'pending',
  `date_req` timestamp NOT NULL DEFAULT current_timestamp(),
  `date_processed` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `remarks` varchar(100) DEFAULT 'Not released',
  `request_id` varchar(20) NOT NULL,
  `qrCode_image` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `request_doc`
--

INSERT INTO `request_doc` (`doc_ID`, `res_id`, `docType_id`, `purpose_id`, `purpose_name`, `stat`, `date_req`, `date_processed`, `remarks`, `request_id`, `qrCode_image`) VALUES
(1, 21, 1, 1, 'Employment', 'pending', '2024-06-26 12:31:51', '2024-06-26 12:31:51', 'Not released', 'O4nx3jm-dA$b=', '1719405111.png'),
(2, 21, 1, 4, 'Senior Citizen Assistance', 'pending', '2024-06-26 12:32:49', '2024-06-26 12:32:50', 'Not released', 'OYA;F7Ny', '1719405169.png'),
(3, 21, 1, 4, 'Senior Citizen Assistance', 'pending', '2024-06-26 13:21:44', '2024-06-26 13:21:44', 'Not released', '2ztQ-Mq?.d', '1719408104.png'),
(4, 13, 1, 4, 'Senior Citizen Assistance', 'pending', '2024-06-27 07:32:31', '2024-06-27 07:32:31', 'Not released', '<+5pzI}4G4qo;', '1719473551.png'),
(5, 21, 1, 1, 'Employment', 'pending', '2024-06-30 14:32:09', '2024-06-30 14:35:00', 'Not released', 'Ht^XHi3Qn<y', '1719758100.png'),
(6, 21, 1, 1, 'Employment', 'pending', '2024-07-01 09:00:01', '2024-07-01 09:00:02', 'Not released', 'M;SL*:Yqwj', '1719824402.png'),
(7, 21, 1, 4, 'Senior Citizen Assistance', 'pending', '2024-07-01 09:09:35', '2024-07-01 09:10:14', 'Released', 'gS!bOhinB', '1719824976.png'),
(8, 25, 1, 1, 'Employment', 'pending', '2024-07-03 13:44:03', '2024-07-03 13:44:04', 'Not released', 'c@IQ*;>Gyn7Gt', '1720014244.png');

-- --------------------------------------------------------

--
-- Table structure for table `resident_users`
--

CREATE TABLE `resident_users` (
  `res_ID` int(11) NOT NULL,
  `res_fname` varchar(50) NOT NULL,
  `res_lname` varchar(50) NOT NULL,
  `res_midname` varchar(50) NOT NULL,
  `res_suffix` varchar(10) DEFAULT NULL,
  `gender` varchar(10) NOT NULL,
  `birth_date` date NOT NULL,
  `civil_status` varchar(20) NOT NULL,
  `citizenship` varchar(30) NOT NULL,
  `place_birth` varchar(100) NOT NULL,
  `contact_no` varchar(13) NOT NULL,
  `res_email` varchar(100) NOT NULL,
  `addr_sitio` varchar(50) NOT NULL,
  `addr_purok` varchar(50) NOT NULL,
  `res_password` varchar(100) NOT NULL,
  `profile_picture` varchar(200) DEFAULT NULL,
  `registered_voter` varchar(15) NOT NULL,
  `userRole_id` int(11) NOT NULL,
  `reset_token_hash` varchar(64) DEFAULT NULL,
  `reset_token_expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `resident_users`
--

INSERT INTO `resident_users` (`res_ID`, `res_fname`, `res_lname`, `res_midname`, `res_suffix`, `gender`, `birth_date`, `civil_status`, `citizenship`, `place_birth`, `contact_no`, `res_email`, `addr_sitio`, `addr_purok`, `res_password`, `profile_picture`, `registered_voter`, `userRole_id`, `reset_token_hash`, `reset_token_expires_at`) VALUES
(10, 'nino rey', 'cabunilas', 'yonson', ' ', 'Male', '2002-05-24', 'Single', 'Filipino', 'sewage, pusok, llc', '09682027920', 'cabunilasninorey@gmail.com', 'sewage', '', '2402', NULL, 'Registered', 2, NULL, NULL),
(11, 'airene marie', 'mabulay', 'banajos', ' ', 'Female', '2003-01-05', 'Single', 'Korean', 'sewage, pusok, llc', '09876571324', 'airene@gmail.com', 'sta. losia', '', '2402', NULL, 'Registered', 2, NULL, NULL),
(13, 'yuna', 'cabunilas', 'mabulay', ' ', 'Female', '2003-03-08', 'Single', 'Filipino', 'sewage', '09682027920', 'yuna@gmail.com', 'sewage', 'blck 6', '2402', NULL, 'Not-registered', 2, NULL, NULL),
(18, 'rei', 'cabunilas', 'yonson', 'Jr', 'Female', '2006-11-03', 'Married', 'filipino', 'sewage', '092374823243', 'rei@gmail.com', 'sewage', '', '2402', NULL, 'Registered', 2, NULL, NULL),
(21, 'Maria Irenea', 'Bebanco', 'Asne', ' ', 'Female', '2003-01-05', 'Single', 'Spanish', 'Cebu City', '09954702461', 'renmarie153@gmail.com', 'Sewage', '4', 'indayamm153', NULL, 'Registered', 2, NULL, NULL),
(24, 'ninis', 'cabus', 'Yalall', 'Jr', 'Male', '2003-02-23', 'Married', 'Filipino', 'Pusok, sewage', '09682027910', 'myname@gmail.com', 'Sewage', '', '2402', NULL, 'Registered', 2, NULL, NULL),
(25, 'Walter', 'Bejo', 'Ologuinsan', 'Jr', 'Male', '2002-09-28', 'Single', 'Filipino', 'Cebu', '09329464', 'PJ6J915x8o9TOAacnxoyYeBgMb+kOu5rhxPo4s+u8J0=', 'San Roque', '', '$2y$10$5Di9MKY337fGDf3iT4i5fOUBfLuHQxlHotnHfNw0Yeh6/1ILJMQx2', NULL, 'Not-registered', 2, NULL, NULL),
(26, 'Test', 'Test', 'Test', ' ', 'Female', '1997-01-01', 'Single', 'Filipino', 'Cebu', '09329465', '0N2y6dgHJtA+EGEpfGDHyQ==', 'Seaside', '', '$2y$10$E3z70iGSNNUry..guP4rwem3xw578vhK1r7gKdTLF54M7gX6G8chy', NULL, 'Registered', 2, NULL, NULL),
(27, 'Test2', 'Test2', 'Test2', ' ', 'Female', '2007-01-15', 'Single', 'Filipino', 'Cebu', '12346579810', 'BLMOeJFhqAS/+uo5FHGcrQ==', 'Arca', '', '$2y$10$tJU/gJGvD05EZWUJiiLMUOMlal5Pr3QKyv4VJ30UAYi670DugZC/q', NULL, 'Not-registered', 2, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account_role`
--
ALTER TABLE `account_role`
  ADD PRIMARY KEY (`userRole_id`);

--
-- Indexes for table `barangay_staff`
--
ALTER TABLE `barangay_staff`
  ADD PRIMARY KEY (`staff_id`),
  ADD KEY `userRole_id` (`userRole_id`);

--
-- Indexes for table `complaints_tbl`
--
ALTER TABLE `complaints_tbl`
  ADD PRIMARY KEY (`complaint_id`),
  ADD KEY `res_id` (`res_id`),
  ADD KEY `staff_id` (`staff_id`);

--
-- Indexes for table `docs_purpose`
--
ALTER TABLE `docs_purpose`
  ADD PRIMARY KEY (`purpose_id`);

--
-- Indexes for table `doc_type`
--
ALTER TABLE `doc_type`
  ADD PRIMARY KEY (`docType_id`);

--
-- Indexes for table `registration_tbl`
--
ALTER TABLE `registration_tbl`
  ADD PRIMARY KEY (`res_ID`);

--
-- Indexes for table `request_doc`
--
ALTER TABLE `request_doc`
  ADD PRIMARY KEY (`doc_ID`),
  ADD KEY `FK_RESIDENT` (`res_id`),
  ADD KEY `FK_doc_type` (`docType_id`),
  ADD KEY `FK_PUPOSE` (`purpose_id`);

--
-- Indexes for table `resident_users`
--
ALTER TABLE `resident_users`
  ADD PRIMARY KEY (`res_ID`),
  ADD UNIQUE KEY `reset_token_hash` (`reset_token_hash`),
  ADD KEY `role_ID` (`userRole_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `account_role`
--
ALTER TABLE `account_role`
  MODIFY `userRole_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `barangay_staff`
--
ALTER TABLE `barangay_staff`
  MODIFY `staff_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `complaints_tbl`
--
ALTER TABLE `complaints_tbl`
  MODIFY `complaint_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `docs_purpose`
--
ALTER TABLE `docs_purpose`
  MODIFY `purpose_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `doc_type`
--
ALTER TABLE `doc_type`
  MODIFY `docType_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `registration_tbl`
--
ALTER TABLE `registration_tbl`
  MODIFY `res_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `request_doc`
--
ALTER TABLE `request_doc`
  MODIFY `doc_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `resident_users`
--
ALTER TABLE `resident_users`
  MODIFY `res_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `barangay_staff`
--
ALTER TABLE `barangay_staff`
  ADD CONSTRAINT `barangay_staff_ibfk_1` FOREIGN KEY (`userRole_id`) REFERENCES `account_role` (`userRole_id`);

--
-- Constraints for table `complaints_tbl`
--
ALTER TABLE `complaints_tbl`
  ADD CONSTRAINT `complaints_tbl_ibfk_1` FOREIGN KEY (`res_id`) REFERENCES `resident_users` (`res_ID`),
  ADD CONSTRAINT `complaints_tbl_ibfk_2` FOREIGN KEY (`staff_id`) REFERENCES `barangay_staff` (`staff_id`);

--
-- Constraints for table `request_doc`
--
ALTER TABLE `request_doc`
  ADD CONSTRAINT `FK_PUPOSE` FOREIGN KEY (`purpose_id`) REFERENCES `docs_purpose` (`purpose_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_RESIDENT` FOREIGN KEY (`res_id`) REFERENCES `resident_users` (`res_ID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_doc_type` FOREIGN KEY (`docType_id`) REFERENCES `doc_type` (`docType_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `resident_users`
--
ALTER TABLE `resident_users`
  ADD CONSTRAINT `resident_users_ibfk_1` FOREIGN KEY (`userRole_id`) REFERENCES `account_role` (`userRole_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
