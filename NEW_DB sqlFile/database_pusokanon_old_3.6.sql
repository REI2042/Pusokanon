-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Generation Time: Aug 10, 2024 at 02:29 PM
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
(5, 'document processing'),
(6, 'Collabs');

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
  `contact_no` varchar(20) NOT NULL,
  `userRole_id` int(11) NOT NULL,
  `staff_email` varchar(100) NOT NULL,
  `user_name` varchar(30) NOT NULL,
  `staff_password` varchar(100) NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `barangay_staff`
--

INSERT INTO `barangay_staff` (`staff_id`, `staff_fname`, `staff_lname`, `staff_midname`, `staff_suffix`, `birth_date`, `gender`, `contact_no`, `userRole_id`, `staff_email`, `user_name`, `staff_password`, `status`) VALUES
(14, 'y6uepI9zt4ZrJ9xmLmSsjw==', '+MFss/zNRoJECy4hrlzhXw==', 'ecq8+4XRxyX+47+406+RHA==', 'k07qP+bfUh+lLEH/Lmle', '0000-00-00', '/E6zUxtovr16bzf1hwX8', '0', 1, '0P1kRNo3yJAG64fgWjSxPoH8uQl1+qDaXx7uaeIuW3w=', 'administrator', '$2y$10$BfdBmc07XyEbG7R8b0YrBeGWPRwjuRXkhurNUtMT8u45iBW7lH7ji', 'ACTIVE'),
(17, '7QXDtZUbkEGvyt0/vp6biA==', 'GybcJWzThnPH77KVLDS+ig==', '+b0go2IGA68MwefHI3QKrw==', 'aSoXP6qGxdcVAIvtlLiF', '0000-00-00', '7GppKkCbhvktizXpUSh8', '7', 1, 'nEI84/Ehh2SZZEUMNzkDLw==', 'admin', '$2y$10$i.WeCn6b5U2osAgLTbo/vOTBJidppS9DP7nVWKzMkqDWcT9t8O172', 'ACTIVE'),
(27, '6yqR0+QnKEQKGklXwgYQFw==', 'ClfEGy92wGUptxvQ/sDVNA==', 'A2El/BB9CpPVj1/1oLwIfg==', 'aSoXP6qGxdcVAIvtlLiF', '0000-00-00', 'Jq8oRXsIDZDVZbhgkps4', 'lX9uRkOLyAUEq', 5, 'QjTXcXAD5IsHQWthU6LmWDDnsja1SaOsCANi4WM7n0Y=', 'BjfCK8M0mubh7rmg4W5sug==', '$2y$10$J55/p2klvElde.VNS2sDXuLlQG7iMF05GfbYE0DY3ytNd8tMcVBqq', 'ACTIVE'),
(29, 'Ha4jBGu2NEg0QyJ3/Kyc/Q==', 'gEJCqgGWo6QR19aJayv8wA==', 'deiLYiv5zbk2emLeViY8aQ==', 'k07qP+bfUh+lLEH/Lmle', '0000-00-00', 'Jq8oRXsIDZDVZbhgkps4', 'FZdl2jRhNsMk8CY3CxDR', 4, '3XlSZ5/Q1HcH2KC49ksEksj8gEBxNN/Lq6l5ENIHJSw=', 'ntXzhG2Xrvj3tOFjdOKb8w==', '$2y$10$G4unqKfon0LcRc/liP3xDeNdQJGJn5yS1.3s.mLppeYVvaED7hEnK', 'ACTIVE'),
(30, 'q6E+lEiMRAxiOkbyhAJftg==', 'Il46pdjnqXE739N8htOZxQ==', 'KZeQrP2ldQ9xvnWUtmtQAg==', 'k07qP+bfUh+lLEH/Lmle', '0000-00-00', '7GppKkCbhvktizXpUSh8', 'uaIuxojn4ri1I58sdsKS', 4, '7fOzNU79FDIoQBub5mikrHeKHDwoSx16NzGt3qkqNRo=', 'mbXK/ZRnm82MFHkj6dgCPQ==', '$2y$10$EcCeTHsns1p6Rvym9o6vdOJzFCGQVK7ZfKIGxzRlqWiI1GKvJjJdm', 'ACTIVE'),
(31, '2DJvNPK8g+ZpBKtcpmBgoQ==', 'HBQdKFOXc/UTLlAvkNU7oA==', 'AfEgoLHA9w5wWe8uU/Q8Uw==', 'lhUQKW2T9Bnf87FizXwX', '0000-00-00', '/E6zUxtovr16bzf1hwX8', 'xgiR0XtioRaxA4nZ0jwb', 5, 'p/O2J6yMLMPrxL2tuOrHyf/O4VdvOE0jhSNF6cal2mk=', 'C9EIrvGC72kO44xqenIGtw==', '$2y$10$v.0amzZsgUWxtB9Q3MOPzuvNk0XYTznIhfsjLFO3XqkvVfSLNoTT6', 'ACTIVE');

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
(1, 1, 'Meghan', 'Alea Bailey', 'Marsh', 'Sr.', 'Female', 64, '2007-12-22', '02:09:00', '2024-08-09 08:41:32', 'Mustang', 'Theft', 'Dignissimos eius ani', 'complaints_evidence/66b5d63c1b9dd.png', 18, '2024-08-28', '20:42:00', 'Approved', 'akgasdj', 'CASE CLOSED', '2024-08-09');

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
(1, 'Arca', 33),
(2, 'Cemento', 0),
(3, 'Chumba-Chumba', 0),
(4, 'Ibabao', 0),
(5, 'Lawis', 0),
(6, 'Matumbo', 0),
(7, 'Mustang', 0),
(8, 'New Lipata', 0),
(9, 'San Roque', 21),
(10, 'Seabreeze', 0),
(11, 'Seaside', 0),
(12, 'Sewage', 0),
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
(1, 2, 4, 1, 'Employment', 'Done', '2024-08-07 19:05:19', '2024-08-07 19:20:45', 'Released', '<HkD0K5l7wv>', '1723057519.png', ''),
(2, 2, 9, 2, 'Students Scholarship', 'Done', '2024-08-07 19:16:28', '2024-08-07 19:19:31', 'Released', '|7z)6SiD}k', '1723058188.png', ''),
(3, 2, 3, 5, 'work load', 'Done', '2024-08-08 09:47:46', '2024-08-08 10:11:57', 'Released', 'B)386.>p4c', '1723110467.png', '80474a83035db7945c8c29f7148a599f.png'),
(4, 1, 3, 5, 'qwwqe', 'Pending', '2024-08-08 10:25:52', '2024-08-08 10:25:53', 'Not released', '$2scDoAwOc@V', '1723112753.png', 'a42a9235a408fb46c4df453fd662f4da.png');

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
(1, 'Niño Rey', 'Cabunilas', 'Yonson', ' ', 'Male', '2002-10-03', 'Married', 'Obcaecati neque nequ', 'seawage', '09682027920', '4wJSXG/iBtqzVJb3OXrX4REKkFkB00P2o7j+uJN4Pbw=', 'Mustang', '', '$2y$10$a7DBbqhQHyHNIBcE0j16a.66omRrmRZW.wo1Ad/FtizGZdYLtvbA.', '449158623_460991273210301_5060266438973425229_n.jpg', 'Registered', 2, 'Wz7nmKAasaOTVRliZYj5dQ==', '2024-08-08 05:10:01', 1),
(2, 'Christine', 'Baxter', 'Forrest Armstrong', ' ', 'Female', '2018-11-13', 'Married', 'filipino', 'Pariatur Necessitat', '09234587556', 'PJ6J915x8o9TOAacnxoyYeBgMb+kOu5rhxPo4s+u8J0=', 'Mustang', '', '$2y$10$oMBsO2ZS6kSlSwrJoEypOuIz8ZfUgP.4kNHqEMBASapYI/OJga4dG', '449126806_2136792833367260_1623341819262103114_n.jpg', 'Registered', 2, NULL, NULL, 1),
(3, 'Wendy', 'Burch', 'Kay Bartlett', 'II.', 'Male', '1979-03-02', 'Single', 'Explicabo Quia est', 'Consequatur Nam rep', 'Et cum deleni', 'RttvRYF8taWyJoweINRR7bQg0nhSGo7KfmGgEY5s5hA=', 'Cemento', '', '$2y$10$g6iI4wwyXjyUChHUVhpzwuq9DdKFzgrF2hbZYYOQd8GyruoXUA.4C', NULL, 'Registered', 2, NULL, NULL, 1),
(4, 'Marshall', 'Hubbard', 'Constance Clarke', 'II.', 'Female', '1977-10-02', 'Married', 'Aut laudantium quae', 'Voluptate et laborum', 'Aut veritatis', 'poSNMVCNkI+6/0L8PxHRYMPxCDKu2KziMSfnr3zt4KQ=', 'Seaside', '', '$2y$10$PbGt4D.ZmA1qk2IBbMsdRu/LWs1yQREJs.cuUyds..4TPKxkELu2G', NULL, 'Registered', 2, NULL, NULL, 1);

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
  MODIFY `userRole_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `barangay_staff`
--
ALTER TABLE `barangay_staff`
  MODIFY `staff_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `complaints_tbl`
--
ALTER TABLE `complaints_tbl`
  MODIFY `complaint_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

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
  MODIFY `res_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `request_doc`
--
ALTER TABLE `request_doc`
  MODIFY `doc_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `resident_users`
--
ALTER TABLE `resident_users`
  MODIFY `res_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `barangay_staff`
--
ALTER TABLE `barangay_staff`
  ADD CONSTRAINT `barangay_staff_ibfk_1` FOREIGN KEY (`userRole_id`) REFERENCES `account_role` (`userRole_id`);

--
-- Constraints for table `resident_users`
--
ALTER TABLE `resident_users`
  ADD CONSTRAINT `resident_users_ibfk_1` FOREIGN KEY (`userRole_id`) REFERENCES `account_role` (`userRole_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
