-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Generation Time: Jul 31, 2024 at 08:38 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

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
(3, 'secretary'),
(4, 'officials'),
(5, 'document processing');

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
  `contact_no` varchar(13) NOT NULL,
  `userRole_id` int(11) NOT NULL,
  `staff_email` varchar(100) NOT NULL,
  `user_name` varchar(30) NOT NULL,
  `staff_password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `barangay_staff`
--

INSERT INTO `barangay_staff` (`staff_id`, `staff_fname`, `staff_lname`, `staff_midname`, `staff_suffix`, `birth_date`, `gender`, `contact_no`, `userRole_id`, `staff_email`, `user_name`, `staff_password`) VALUES
(14, 'y6uepI9zt4ZrJ9xmLmSsjw==', '+MFss/zNRoJECy4hrlzhXw==', 'ecq8+4XRxyX+47+406+RHA==', 'k07qP+bfUh+lLEH/Lmle', '0000-00-00', '/E6zUxtovr16bzf1hwX8', 'ZFdRdXN6phKHg', 1, '0P1kRNo3yJAG64fgWjSxPoH8uQl1+qDaXx7uaeIuW3w=', 'administrator', '$2y$10$BfdBmc07XyEbG7R8b0YrBeGWPRwjuRXkhurNUtMT8u45iBW7lH7ji'),
(17, '7QXDtZUbkEGvyt0/vp6biA==', 'GybcJWzThnPH77KVLDS+ig==', '+b0go2IGA68MwefHI3QKrw==', 'aSoXP6qGxdcVAIvtlLiF', '0000-00-00', '7GppKkCbhvktizXpUSh8', '7EmYfvxuEWHbV', 1, 'nEI84/Ehh2SZZEUMNzkDLw==', 'admin', '$2y$10$i.WeCn6b5U2osAgLTbo/vOTBJidppS9DP7nVWKzMkqDWcT9t8O172'),
(18, 'slMIwOL0Ac7TZlgUoWCibg==', '8IYqHYelARTZzYfZo+lqig==', 'RoAS9dOqf118NORNXd1X3w==', '8ftK2n94Fv7Ym/bhA9JC', '0000-00-00', '/E6zUxtovr16bzf1hwX8', 'CNaMzHs8uuS1o', 3, 'M1UgoWz+nWh05sZtodnuQ8PnFi8qTDXMbncq05Q/ydY=', 'airene', '$2y$10$ndRBn8Q7dG4IMdWEnWv9D.ZPZ385uYnLb7b9Tq/KmDO8fiZV3uPM6');

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
  `date_filed` timestamp NOT NULL DEFAULT current_timestamp(),
  `incident_place` varchar(50) NOT NULL,
  `case_type` varchar(50) NOT NULL,
  `narrative` text DEFAULT NULL,
  `evidence` varchar(200) DEFAULT NULL,
  `staff_id` int(11) NOT NULL,
  `hearing_date` date DEFAULT NULL,
  `hearing_time` time DEFAULT NULL,
  `status` varchar(10) NOT NULL,
  `comment` text DEFAULT NULL,
  `remarks` varchar(200) NOT NULL,
  `date_closed` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `complaints_tbl`
--

INSERT INTO `complaints_tbl` (`complaint_id`, `res_id`, `respondent_fname`, `respondent_mname`, `respondent_lname`, `respondent_suffix`, `respondent_gender`, `respondent_age`, `incident_date`, `incident_time`, `date_filed`, `incident_place`, `case_type`, `narrative`, `evidence`, `staff_id`, `hearing_date`, `hearing_time`, `status`, `comment`, `remarks`, `date_closed`) VALUES
(1, 28, 'Dwight', '', 'Callahan', ' ', 'Male', 25, '2024-07-01', '21:30:00', '2024-07-19 08:33:51', 'Seabreeze', 'Threat', 'hi dwight', 'complaints_evidence/669a24ef0ffb2.png', 2, '2024-07-24', '09:30:00', 'Approved', '--', '', NULL),
(2, 28, 'Nino', '', 'Cabunilas', ' ', 'Male', 25, '2024-06-13', '19:30:00', '2024-07-19 08:34:30', 'Sewage', 'Trespassing', 'hellooooo', 'complaints_evidence/669a25164b228.png', 2, NULL, NULL, 'Pending', '--', '', NULL),
(3, 28, 'Demitria', '', 'Bebanco', ' ', 'Female', 22, '2024-04-27', '11:30:00', '2024-07-19 08:35:04', 'Mustang', 'Theft', 'nangawat samo sud an', 'complaints_evidence/669a2538a5906.png', 2, NULL, NULL, 'Rejected', 'lack of evidence to support the claim', 'CASE CLOSED', '2024-07-19'),
(4, 28, 'Marienne Lune', 'Penales', 'Bebanco', ' ', 'Female', 23, '2024-04-28', '08:00:00', '2024-07-19 08:35:46', 'Cemento', 'Bullying', 'ambott gikapoy nakog type', 'complaints_evidence/669a2562ec5cc.png', 2, NULL, NULL, 'Pending', '--', '', NULL),
(5, 28, 'Rejie', 'Rey', 'Callahan', 'III', 'Male', 39, '2024-07-01', '18:03:00', '2024-07-19 08:36:25', 'Arca', 'Bullying', 'sige pa cute2 lol', 'complaints_evidence/669a2589a3875.png', 2, NULL, NULL, 'Pending', '--', '', NULL),
(6, 28, 'Renee', '', 'Descartez', ' ', 'Female', 27, '2024-06-22', '18:30:00', '2024-07-19 08:37:10', 'Sta. Maria', 'Libel', 'ga buot2 og storya', 'complaints_evidence/669a25b644736.png', 2, '2024-08-07', '08:00:00', 'Approved', '', 'CASE CLOSED', '2024-07-25'),
(7, 28, 'Nino', '', 'Riego', ' ', 'Male', 22, '2024-07-13', '14:30:00', '2024-07-19 08:38:16', 'Mustang', 'Damaging Properties', 'samokkk', 'complaints_evidence/669a25f8d5eba.png', 2, NULL, NULL, 'Rejected', 'ambot gasakit na akoa kamot !!!!', 'CASE CLOSED', '2024-07-19'),
(8, 28, 'Wensly ', '', 'Sacay', ' ', 'Male', 29, '2024-06-29', '13:00:00', '2024-07-19 08:39:00', 'Matumbo', 'Threat', 'sobraan ka introvert', 'complaints_evidence/669a262494c30.png', 2, NULL, NULL, 'Rejected', 'pagination testing', 'CASE CLOSED', '2024-07-22'),
(9, 28, 'walter', '', 'bejo', ' ', 'Male', 36, '2024-06-18', '17:26:00', '2024-07-19 08:39:44', 'Chumba-Chumba', 'Physical Abuse', 'iya gituok si dwight', 'complaints_evidence/669a2650a7f1d.png', 2, NULL, NULL, 'Pending', '--', '', NULL),
(10, 28, 'Nino Rey', 'Yunson', 'Cabunilas', ' ', 'Male', 28, '2024-07-16', '19:30:00', '2024-07-19 08:40:38', 'Seabreeze', 'Theft', 'ambot. reklamo ni nako kay ano...', 'complaints_evidence/669a268639b74.png', 2, NULL, NULL, 'Pending', '--', '', NULL),
(11, 28, 'Jaryl Jane', '', 'Baroro', ' ', 'Female', 23, '2024-07-18', '11:15:00', '2024-07-19 08:41:33', 'Seaside', 'Theft', 'sobraan ka gwapa', 'complaints_evidence/669a26bdcda63.png', 2, NULL, NULL, 'Pending', '--', '', NULL),
(12, 28, 'Demi', '', 'Bebanco', ' ', 'Female', 29, '2024-06-01', '21:30:00', '2024-07-19 08:42:16', 'San Roque', 'Theft', 'kawatan og sud an', 'complaints_evidence/669a26e8edbe5.png', 2, NULL, NULL, 'Pending', '--', '', NULL),
(13, 28, 'Demitria', '', 'Mabulay', ' ', 'Female', 23, '2024-07-06', '14:30:00', '2024-07-19 08:42:54', 'Arca', 'Trespassing', 'hilasan rko. maldita kaayo bisan wala unsaa', 'complaints_evidence/669a270ee3607.png', 2, '2024-08-09', '09:30:00', 'Approved', 'q', 'CASE CLOSED', '2024-07-25');

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
(8, 'Barangay Business Clearance', 630),
(9, 'Barangay Certificate', 50);

-- --------------------------------------------------------

--
-- Table structure for table `initial_sitio_population`
--

CREATE TABLE `initial_sitio_population` (
  `sitio_id` int(11) NOT NULL,
  `sitio_name` varchar(50) NOT NULL,
  `total_initial_residents` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `initial_sitio_population`
--

INSERT INTO `initial_sitio_population` (`sitio_id`, `sitio_name`, `total_initial_residents`) VALUES
(1, 'Arca', 234),
(2, 'Cemento', 0),
(3, 'Chumba-Chumba', 0),
(4, 'Ibabao', 0),
(5, 'Lawis', 0),
(6, 'Matumbo', 0),
(7, 'Mustang', 0),
(8, 'New Lipata', 0),
(9, 'San Roque', 0),
(10, 'Seabreeze', 0),
(11, 'Seaside', 0),
(12, 'Sewage', 234),
(13, 'Sta. Maria', 0);

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
  `stat` varchar(50) NOT NULL DEFAULT 'Pending',
  `date_req` timestamp NOT NULL DEFAULT current_timestamp(),
  `date_processed` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `remarks` varchar(100) DEFAULT 'Not released',
  `request_id` varchar(20) NOT NULL,
  `qrCode_image` varchar(200) NOT NULL,
  `document_requirements` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `request_doc`
--

INSERT INTO `request_doc` (`doc_ID`, `res_id`, `docType_id`, `purpose_id`, `purpose_name`, `stat`, `date_req`, `date_processed`, `remarks`, `request_id`, `qrCode_image`, `document_requirements`) VALUES
(1, 29, 1, 5, 'damnnn', 'pending', '2024-07-17 18:09:27', '2024-07-31 04:16:44', 'Not released', '!>W$PYst#s}', '1721239768.png', ''),
(2, 29, 2, 5, 'For scholarship', 'pending', '2024-07-17 18:12:25', '2024-07-17 18:12:26', 'Not released', '|50{md?ciQ[8b', '1721239946.png', ''),
(3, 29, 1, 4, 'Senior Citizen Assistance', 'pending\n', '2024-07-20 05:26:56', '2024-07-31 04:16:51', 'Released', '@vn(r>@#N8ksO', '1721453216.png', ''),
(4, 29, 1, 5, 'TRAVEL', 'pending\n', '2024-07-22 11:43:44', '2024-07-31 04:16:55', 'Not released', 'Pt.i?qOaY9', '1721648624.png', ''),
(5, 29, 2, 4, 'Senior Citizen Assistance', 'pending\n', '2024-07-22 12:35:07', '2024-07-31 04:16:59', 'Not released', ';b.D1.j8?*8jW', '1721651707.png', ''),
(6, 25, 3, 5, 'traveelwerr', 'pending', '2024-07-31 03:55:05', '2024-07-31 04:09:46', 'Not released', 'oH3*.;TMhg,XU', '1722398986.png', 'ee3996499b4db9e0e4c36549b9fa54ee.jpg'),
(8, 25, 9, 5, 'am,ndvbajkcsvia', 'pending', '2024-07-31 04:11:11', '2024-07-31 04:11:11', 'Not released', 'EfZ@hxO;+', '1722399071.png', ''),
(9, 25, 9, 5, 'asdasdqw234434', 'pending', '2024-07-31 04:19:45', '2024-07-31 04:19:45', 'Not released', '=F<Wnn7X,o', '1722399585.png', ''),
(10, 25, 4, 3, 'Person With Disability Assistance', 'Pending', '2024-07-31 05:09:34', '2024-07-31 05:09:34', 'Not released', 'Ha71_S;pL@:', '1722402574.png', ''),
(11, 25, 1, 5, 'asdadse3453', 'Pending', '2024-07-31 05:52:27', '2024-07-31 05:52:27', 'Not released', 'fRxGpKkH0', '1722405147.png', '996e5760d976176dfae187a6a8d82b3f.jpg'),
(12, 25, 5, 5, 'seawge', 'Pending', '2024-07-31 06:26:08', '2024-07-31 06:26:08', 'Not released', '*Az(v=%8D9]G', '1722407168.png', 'a31f3a8a09a8a60a183e033e29680501.jpg'),
(13, 25, 6, 5, 'looc', 'Pending', '2024-07-31 06:27:35', '2024-07-31 06:27:35', 'Not released', 'BWSPL<xospdr', '1722407255.png', 'c509ad0c22bed603cfe079b76e6a6023.jpg'),
(14, 25, 7, 5, 'adiahdfushiasdf67856', 'Pending', '2024-07-31 06:28:19', '2024-07-31 06:28:19', 'Not released', 'I[$ni0s{<5$CG', '1722407299.png', '00165f9b0f09c0166b216adc7e103d79.png'),
(15, 25, 8, 5, 'mn sddkjhzx43as', 'Pending', '2024-07-31 06:29:17', '2024-07-31 06:29:18', 'Not released', '6l@s1I[lgWd<m', '1722407358.png', '885060bce4fd96c6179b0ed6840ef609.png');

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
  `reset_token_expires_at` datetime DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `resident_users`
--

INSERT INTO `resident_users` (`res_ID`, `res_fname`, `res_lname`, `res_midname`, `res_suffix`, `gender`, `birth_date`, `civil_status`, `citizenship`, `place_birth`, `contact_no`, `res_email`, `addr_sitio`, `addr_purok`, `res_password`, `profile_picture`, `registered_voter`, `userRole_id`, `reset_token_hash`, `reset_token_expires_at`, `is_active`) VALUES
(10, 'nino rey', 'cabunilas', 'yonson', ' ', 'Male', '2002-05-24', 'Single', 'Filipino', 'sewage, pusok, llc', '09682027920', 'cabunilasninorey@gmail.com', 'sewage', '', '2402', NULL, 'Registered', 2, NULL, NULL, 1),
(11, 'airene marie', 'mabulay', 'banajos', ' ', 'Female', '2003-01-05', 'Single', 'Korean', 'sewage, pusok, llc', '09876571324', 'airene@gmail.com', 'sta. losia', '', '2402', NULL, 'Registered', 2, NULL, NULL, 1),
(13, 'yuna', 'cabunilas', 'mabulay', ' ', 'Female', '2003-03-08', 'Single', 'Filipino', 'sewage', '09682027920', 'yuna@gmail.com', 'sewage', 'blck 6', '2402', NULL, 'Not-registered', 2, NULL, NULL, 1),
(18, 'rei', 'cabunilas', 'yonson', 'Jr', 'Female', '2006-11-03', 'Married', 'filipino', 'sewage', '092374823243', 'rei@gmail.com', 'sewage', '', '2402', NULL, 'Registered', 2, NULL, NULL, 1),
(21, 'Maria Irenea', 'Bebanco', 'Asne', ' ', 'Female', '2003-01-05', 'Single', 'Spanish', 'Cebu City', '09954702461', 'renmarie153@gmail.com', 'Sewage', '4', 'indayamm153', NULL, 'Registered', 2, NULL, NULL, 1),
(24, 'ninis', 'cabus', 'Yalall', 'Jr', 'Male', '2003-02-23', 'Married', 'Filipino', 'Pusok, sewage', '09682027910', 'myname@gmail.com', 'Sewage', '', '2402', NULL, 'Registered', 2, NULL, NULL, 1),
(25, 'Walter', 'Bejo', 'Ologuinsan', 'Jr', 'Male', '2002-09-28', 'Single', 'Filipino', 'Cebu', '09329464', 'PJ6J915x8o9TOAacnxoyYeBgMb+kOu5rhxPo4s+u8J0=', 'San Roque', '', '$2y$10$5Di9MKY337fGDf3iT4i5fOUBfLuHQxlHotnHfNw0Yeh6/1ILJMQx2', 'Walter.png', 'Not-registered', 2, '493298', '2024-07-18 21:32:46', 1),
(26, 'Test', 'Test', 'Test', ' ', 'Female', '1997-01-01', 'Single', 'Filipino', 'Cebu', '09329465', '0N2y6dgHJtA+EGEpfGDHyQ==', 'Seaside', '', '$2y$10$E3z70iGSNNUry..guP4rwem3xw578vhK1r7gKdTLF54M7gX6G8chy', NULL, 'Registered', 2, NULL, NULL, 1),
(27, 'Test2', 'Test2', 'Test2', ' ', 'Female', '2007-01-15', 'Single', 'Filipino', 'Cebu', '12346579810', 'BLMOeJFhqAS/+uo5FHGcrQ==', 'Arca', '', '$2y$10$tJU/gJGvD05EZWUJiiLMUOMlal5Pr3QKyv4VJ30UAYi670DugZC/q', NULL, 'Not-registered', 2, NULL, NULL, 1),
(28, 'Renee', 'Descartez', '', ' ', 'Female', '2003-10-15', 'Single', 'Filipino', 'Cebu City', '09433930847', 'Ym4cQe4NxD4QWMQz7zFwQBvTR++2kIzfhEAVy/6AK8U=', 'Sewage', '', '$2y$10$xHiGNL3QgFtAc0UkrmYkg.uqJSOpgSNo.wbtEA2M.Tn23FPbT14H6', NULL, 'Registered', 2, NULL, NULL, 1),
(29, 'Suki', 'Edwards', 'Chantale Buckley', 'III', 'Male', '1991-03-17', 'Married', 'filipino', 'A occaecat aut eos e', '09873452342', 'RttvRYF8taWyJoweINRR7bQg0nhSGo7KfmGgEY5s5hA=', 'Ibabao', '', '$2y$10$2TP4r7zelxwFo4nacwLGCu5yMQh/SQojFUgpRsKLHzrKSqVUHsjnm', NULL, 'Registered', 2, '202669', '2024-07-18 21:34:15', 1),
(31, 'Milenia', 'Blade', 'Ella', ' ', 'Female', '2001-01-24', 'Single', 'Filipino', 'Mandaue', '12345678910', 'v1SpLVQwr1zmURk9o7e4jsDzT9SKlFUTmG+13H8ARms=', 'Mustang', '', '$2y$10$t9xhXXhxvQSzo9Jfcdc/u.JGRg05fv6Xx3yHO2ZWIoreemn5m9vhm', 'image_2024-07-19_203400685.png', 'Not-registered', 2, NULL, NULL, 1);

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
-- Indexes for table `initial_sitio_population`
--
ALTER TABLE `initial_sitio_population`
  ADD PRIMARY KEY (`sitio_id`);

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
  MODIFY `userRole_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `barangay_staff`
--
ALTER TABLE `barangay_staff`
  MODIFY `staff_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `complaints_tbl`
--
ALTER TABLE `complaints_tbl`
  MODIFY `complaint_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `docs_purpose`
--
ALTER TABLE `docs_purpose`
  MODIFY `purpose_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `doc_type`
--
ALTER TABLE `doc_type`
  MODIFY `docType_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `initial_sitio_population`
--
ALTER TABLE `initial_sitio_population`
  MODIFY `sitio_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `registration_tbl`
--
ALTER TABLE `registration_tbl`
  MODIFY `res_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `request_doc`
--
ALTER TABLE `request_doc`
  MODIFY `doc_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `resident_users`
--
ALTER TABLE `resident_users`
  MODIFY `res_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `barangay_staff`
--
ALTER TABLE `barangay_staff`
  ADD CONSTRAINT `barangay_staff_ibfk_1` FOREIGN KEY (`userRole_id`) REFERENCES `account_role` (`userRole_id`);

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
