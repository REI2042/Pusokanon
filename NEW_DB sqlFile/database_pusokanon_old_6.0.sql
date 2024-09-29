-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Generation Time: Aug 19, 2024 at 09:19 AM
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
(3, 'secretary'),
(4, 'officials'),
(5, 'document processing'),
(6, 'Collabs'),
(7, 'Blotter Officer');

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
  `user_name` varchar(100) NOT NULL,
  `staff_password` varchar(100) NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `barangay_staff`
--

INSERT INTO `barangay_staff` (`staff_id`, `staff_fname`, `staff_lname`, `staff_midname`, `staff_suffix`, `birth_date`, `gender`, `contact_no`, `userRole_id`, `staff_email`, `user_name`, `staff_password`, `status`) VALUES
(17, '7QXDtZUbkEGvyt0/vp6biA==', 'GybcJWzThnPH77KVLDS+ig==', '+b0go2IGA68MwefHI3QKrw==', '', '0000-00-00', 'Male', '09347334823', 1, 'nEI84/Ehh2SZZEUMNzkDLw==', 'BjfCK8M0mubh7rmg4W5sug==', '$2y$10$i.WeCn6b5U2osAgLTbo/vOTBJidppS9DP7nVWKzMkqDWcT9t8O172', 'ACTIVE'),
(60, 't+FxILiWLXP/QiR6U/tPTQ==', '4bRlCdKuqV93r2XA+QypfA==', 'L0VNWzJdF6FyKgU3hfoloA==', '', '0000-00-00', 'Female', '09472340876', 3, '8pPI8TOCQfYSelCcQ21ss111JZhQCV8iJPI1rp8KhR0=', 'FLFydCCa0k1u9NOmNdmbTg==', '$2y$10$sA0UTCGbfUidCv337Re77ODGGqlDo9z.dKiYj8AXes3dYDlxWQS1G', 'ACTIVE'),
(61, 'RzzeyROKFU0TExhG+qYaBw==', 'Y2fEy5soB5k8MsJX/Qc6kw==', 'IEHazRM6gmMJE4IV5NnQ5A==', 'IV', '0000-00-00', 'Male', '+1 (528) 591-4175', 4, 'PTjNhBq8gjrJJYFTNAAwkOEydIx00EFgJIKhPjnoRPk=', 'wIA87kaTuB5G1JyZugB+oA==', '$2y$10$eaD1FkJgt9f9/a9tP.FuJe01dv2iAGMRyfTbhKnF9VRbph/rNCW0W', 'ACTIVE'),
(63, 'vxLAysrYz1s7BVT7rLvN5Q==', 's8ihuIr3QN/p0QMzN3LgFw==', 'jhyQwPQ7jASNmvj8aRepnw==', 'II', '0000-00-00', 'Male', '+1 (859) 728-1592', 5, 'fve0NnVWQjo4FrP5myOVcM+A4raMWpIM0R5f/iUyo8w=', '9AZHLHTYHG6rjqfw/H3jQA==', '$2y$10$ksH7aaJXYP2ltqcnBzjx9u.AGUL9b.EKeXsUnfAvf9qBZajE.DY.a', 'ACTIVE');

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
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `post_id` int(11) NOT NULL,
  `staff_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `pinned` tinyint(1) NOT NULL DEFAULT 0,
  `upvotes` int(11) NOT NULL DEFAULT 0,
  `downvotes` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `post_media`
--

CREATE TABLE `post_media` (
  `media_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `media_type` enum('image','video') NOT NULL,
  `media_path` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `post_reactions`
--

CREATE TABLE `post_reactions` (
  `reaction_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `res_id` int(11) NOT NULL,
  `reaction_type` enum('upvote','downvote') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
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
  `qrCode_image` varchar(200) DEFAULT NULL,
  `document_requirements` varchar(64) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
  `res_password` varchar(100) NOT NULL,
  `profile_picture` varchar(200) DEFAULT NULL,
  `registered_voter` varchar(15) NOT NULL,
  `userRole_id` int(11) NOT NULL,
  `verification_image` varchar(128) DEFAULT NULL,
  `register_at` datetime NOT NULL DEFAULT current_timestamp(),
  `reset_token_hash` varchar(64) DEFAULT NULL,
  `reset_token_expires_at` datetime DEFAULT NULL,
  `account_active_status` varchar(16) NOT NULL DEFAULT 'Unregistered'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `resident_users`
--

INSERT INTO `resident_users` (`res_ID`, `res_fname`, `res_lname`, `res_midname`, `res_suffix`, `gender`, `birth_date`, `civil_status`, `citizenship`, `place_birth`, `contact_no`, `res_email`, `addr_sitio`, `res_password`, `profile_picture`, `registered_voter`, `userRole_id`, `verification_image`, `register_at`, `reset_token_hash`, `reset_token_expires_at`, `account_active_status`) VALUES
(6, 'niorey', 'cabunilas', 'yonson', 'I', 'Male', '1988-10-09', 'Married', 'Filipino', 'Rerum proident modi', '0989 345 9842', 'RttvRYF8taWyJoweINRR7bQg0nhSGo7KfmGgEY5s5hA=', 'Ibabao', '$2y$10$HmLy7vQ97oYIeJ0zJk23VusdnmvaA4PruQgcLDC1KwsQUAJPK7Ty6', '44912_n.jpg', 'Registered', 2, '380145502_11_n.jpg', '2024-08-14 21:12:40', NULL, NULL, 'Active'),
(8, 'Vivien', 'Lane', 'Reagan Ruiz', 'I', 'Female', '1999-12-15', 'Single', 'Eius ut quis perspic', 'Vero consectetur con', '09873459873', '4wJSXG/iBtqzVJb3OXrX4REKkFkB00P2o7j+uJN4Pbw=', 'New Lipata', '$2y$10$wI0zj6LSsq47hgThyawF9ufUPlsV/VhZ9sh/aP7/oTYvbeywMqvAi', NULL, 'Not-registered', 2, '380145502_11_n.jpg', '2024-08-14 22:53:53', NULL, NULL, 'Active'),
(10, 'Hiroko', 'Rutledge', 'Derek Blevins', 'II.', 'Male', '1982-02-27', 'Single', 'Canadian', 'Maxime et et id qui ', '0968 202 7920', '4wJSXG/iBtqzVJb3OXrX4REKkFkB00P2o7j+uJN4Pbw=', 'Cemento', '$2y$10$VE8y80aZ7J08NUoMQttGCeY/l5osNs5G7PWlbvkVJCgus0MlfM2HS', NULL, 'Not-registered', 2, '380145502_11_n.jpg', '2024-08-15 19:37:13', NULL, NULL, 'Unregistered');

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
  ADD KEY `staff_id` (`staff_id`),
  ADD KEY `fk_res` (`res_id`);

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
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`post_id`),
  ADD KEY `staff_id` (`staff_id`);

--
-- Indexes for table `post_media`
--
ALTER TABLE `post_media`
  ADD PRIMARY KEY (`media_id`),
  ADD KEY `post_id` (`post_id`);

--
-- Indexes for table `post_reactions`
--
ALTER TABLE `post_reactions`
  ADD PRIMARY KEY (`reaction_id`),
  ADD KEY `post_id` (`post_id`),
  ADD KEY `res_id` (`res_id`);

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
  MODIFY `userRole_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `barangay_staff`
--
ALTER TABLE `barangay_staff`
  MODIFY `staff_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

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
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `post_media`
--
ALTER TABLE `post_media`
  MODIFY `media_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `post_reactions`
--
ALTER TABLE `post_reactions`
  MODIFY `reaction_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `request_doc`
--
ALTER TABLE `request_doc`
  MODIFY `doc_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `resident_users`
--
ALTER TABLE `resident_users`
  MODIFY `res_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

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
  ADD CONSTRAINT `fk_res` FOREIGN KEY (`res_id`) REFERENCES `resident_users` (`res_ID`),
  ADD CONSTRAINT `staff_fk` FOREIGN KEY (`staff_id`) REFERENCES `barangay_staff` (`staff_id`);

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`staff_id`) REFERENCES `barangay_staff` (`staff_id`) ON DELETE CASCADE;

--
-- Constraints for table `post_media`
--
ALTER TABLE `post_media`
  ADD CONSTRAINT `post_media_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `posts` (`post_id`) ON DELETE CASCADE;

--
-- Constraints for table `post_reactions`
--
ALTER TABLE `post_reactions`
  ADD CONSTRAINT `post_reactions_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `posts` (`post_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `post_reactions_ibfk_2` FOREIGN KEY (`res_id`) REFERENCES `resident_users` (`res_ID`);

--
-- Constraints for table `request_doc`
--
ALTER TABLE `request_doc`
  ADD CONSTRAINT `doctype_fk` FOREIGN KEY (`docType_id`) REFERENCES `doc_type` (`docType_id`),
  ADD CONSTRAINT `pupose_fk` FOREIGN KEY (`purpose_id`) REFERENCES `docs_purpose` (`purpose_id`),
  ADD CONSTRAINT `userDocs request` FOREIGN KEY (`res_id`) REFERENCES `resident_users` (`res_ID`);

--
-- Constraints for table `resident_users`
--
ALTER TABLE `resident_users`
  ADD CONSTRAINT `resident_users_ibfk_1` FOREIGN KEY (`userRole_id`) REFERENCES `account_role` (`userRole_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
