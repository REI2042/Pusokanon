-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Generation Time: Oct 09, 2024 at 01:41 PM
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
-- Table structure for table `announcement_comments`
--

CREATE TABLE `announcement_comments` (
  `comment_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `res_id` int(11) NOT NULL,
  `comment_content` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `announcement_posts`
--

CREATE TABLE `announcement_posts` (
  `post_id` int(11) NOT NULL,
  `staff_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `pinned` tinyint(1) NOT NULL DEFAULT 0,
  `upvotes` int(11) DEFAULT 0,
  `downvotes` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `announcement_posts`
--

INSERT INTO `announcement_posts` (`post_id`, `staff_id`, `title`, `content`, `created_at`, `pinned`, `upvotes`, `downvotes`) VALUES
(57, 17, 'This is a test pinned post', 'body on the pinned post', '2024-08-22 17:32:50', 1, 1, 0),
(71, 17, 'This is a test post', 'Body of the test post', '2024-09-27 11:13:42', 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `announcement_posts_media`
--

CREATE TABLE `announcement_posts_media` (
  `media_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `media_type` enum('image','video') NOT NULL,
  `media_path` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `announcement_posts_reactions`
--

CREATE TABLE `announcement_posts_reactions` (
  `reaction_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `res_id` int(11) NOT NULL,
  `reaction_type` enum('upvote','downvote') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `announcement_posts_reactions`
--

INSERT INTO `announcement_posts_reactions` (`reaction_id`, `post_id`, `res_id`, `reaction_type`, `created_at`) VALUES
(44, 57, 11, 'upvote', '2024-08-22 17:33:21');

-- --------------------------------------------------------

--
-- Table structure for table `appointment_tbl`
--

CREATE TABLE `appointment_tbl` (
  `appt_ID` int(11) NOT NULL,
  `res_ID` int(11) NOT NULL,
  `doc_ID` int(11) NOT NULL,
  `appt_date` date NOT NULL,
  `appt_time` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `appointment_tbl`
--

INSERT INTO `appointment_tbl` (`appt_ID`, `res_ID`, `doc_ID`, `appt_date`, `appt_time`) VALUES
(1, 6, 3, '2024-10-30', '19:40:00'),
(2, 6, 4, '2024-10-16', '09:37:00'),
(3, 14, 7, '2024-10-25', '19:53:00'),
(4, 11, 8, '2024-10-09', '18:57:00');

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
(63, 'vxLAysrYz1s7BVT7rLvN5Q==', 's8ihuIr3QN/p0QMzN3LgFw==', 'jhyQwPQ7jASNmvj8aRepnw==', 'II', '0000-00-00', 'Male', '+1 (859) 728-1592', 5, 'fve0NnVWQjo4FrP5myOVcM+A4raMWpIM0R5f/iUyo8w=', '9AZHLHTYHG6rjqfw/H3jQA==', '$2y$10$ksH7aaJXYP2ltqcnBzjx9u.AGUL9b.EKeXsUnfAvf9qBZajE.DY.a', 'ACTIVE'),
(64, 'zygy0fIiL4SULibC1B7lfA==', 'dXRL7w90efhLfcbyjcx0ng==', 'q0uVhQcUaKOyJQAAQ8teVw==', 'Jr.', '0000-00-00', 'Male', '0943 532 4512', 4, 'e731S3PtsUSAYCdJ2Q4fXup5oKh3Eko9whk3/VHpipk=', 'ZqVC8f4iI/jqL402o8rdMw==', '$2y$10$SsBeEUT0s.YWAFd84wpwGONoiT8.AlR8srB5tw3HG4ScGt1s4Eq2q', 'ACTIVE');

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
(9, 11, 'Gwapo', 'sdadsa', 'dasdasdas', 'Jr', 'Male', 21, '2024-09-12', '14:17:00', '2024-09-12 06:17:57', 'Arca', 'Bullying', 'Test', NULL, 17, '2024-09-20', '08:30:00', 'Approved', 'Test', 'CASE CLOSED', '2024-09-13'),
(10, 14, 'Cameron', 'Quintessa Terrell', 'Griffith', ' ', 'Male', 61, '1979-12-29', '01:10:00', '2024-10-06 11:49:59', 'Lawis', 'Theft', 'Aliqua In veniam i', 'complaints_evidence/6702796735d8e.jpg', 17, NULL, NULL, 'Rejected', 'lack of supporting evidence', 'CASE CLOSED', '2024-10-06');

-- --------------------------------------------------------

--
-- Table structure for table `docs_purpose`
--

CREATE TABLE `docs_purpose` (
  `purpose_id` int(11) NOT NULL,
  `purpose_name` varchar(50) NOT NULL,
  `purpose_fee` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `docs_purpose`
--

INSERT INTO `docs_purpose` (`purpose_id`, `purpose_name`, `purpose_fee`) VALUES
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
-- Table structure for table `request_doc`
--

CREATE TABLE `request_doc` (
  `doc_ID` int(11) NOT NULL,
  `res_id` int(11) NOT NULL,
  `docType_id` int(11) NOT NULL,
  `purpose_id` int(11) NOT NULL,
  `purpose_name` varchar(255) DEFAULT NULL,
  `doc_amount` int(11) NOT NULL,
  `stat` varchar(50) NOT NULL DEFAULT 'Pending',
  `date_req` timestamp NOT NULL DEFAULT current_timestamp(),
  `date_processed` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `remarks` varchar(100) DEFAULT 'Not released',
  `request_id` varchar(20) NOT NULL,
  `qrCode_image` varchar(200) DEFAULT NULL,
  `document_requirements` varchar(64) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `request_doc`
--

INSERT INTO `request_doc` (`doc_ID`, `res_id`, `docType_id`, `purpose_id`, `purpose_name`, `doc_amount`, `stat`, `date_req`, `date_processed`, `remarks`, `request_id`, `qrCode_image`, `document_requirements`) VALUES
(1, 6, 2, 1, 'Employment', 0, 'Pending', '2024-10-06 11:36:40', '2024-10-06 11:36:41', 'Not released', 'wLZp|Soh', '1728214601.png', NULL),
(2, 6, 4, 3, 'Person With Disability Assistance', 0, 'Ready to pickup', '2024-10-06 11:36:48', '2024-10-06 11:59:41', 'Not released', 'LW5bXuo]', '1728214610.png', NULL),
(3, 6, 5, 5, 'business', 500, 'Pending', '2024-10-06 11:37:20', '2024-10-06 11:37:29', 'Not released', '!ld=sB4M+]]', '1728214649.png', 'aaf9c80aba92506e.png,7a992ab4ee0820c2.png'),
(4, 6, 6, 5, 'Business', 500, 'Pending', '2024-10-06 11:37:45', '2024-10-06 11:37:54', 'Not released', 'F@3]*=M67-', '1728214674.png', '3077bfd50ed66369.png'),
(5, 6, 1, 5, 'travel', 80, 'Pending', '2024-10-06 11:39:26', '2024-10-06 11:39:28', 'Not released', ']QQ[Nx|g[', '1728214768.png', 'fa19cf87557ffa7e.png'),
(6, 14, 2, 4, 'Senior Citizen Assistance', 0, 'Pending', '2024-10-06 11:48:58', '2024-10-06 11:49:00', 'Not released', 'tfe1J6T.K<P>', '1728215340.png', NULL),
(7, 14, 7, 5, 'Privacy', 500, 'Pending', '2024-10-06 11:49:21', '2024-10-06 11:49:31', 'Not released', 'K.d*cw;sz5', '1728215371.png', 'a40b237e192abb14.jpg,b1019c1f06491949.jpg'),
(8, 11, 6, 5, 'Barangay Construction Permit', 500, 'Pending', '2024-10-09 09:57:34', '2024-10-09 09:57:43', 'Not released', '[qmcH#1sc', '1728467863.png', '7e44ad3a4095ea1f.jpg');

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
(10, 'Hiroko', 'Rutledge', 'Derek Blevins', 'II.', 'Male', '1982-02-27', 'Single', 'Canadian', 'Maxime et et id qui ', '0968 202 7920', '4wJSXG/iBtqzVJb3OXrX4REKkFkB00P2o7j+uJN4Pbw=', 'Cemento', '$2y$10$VE8y80aZ7J08NUoMQttGCeY/l5osNs5G7PWlbvkVJCgus0MlfM2HS', NULL, 'Not-registered', 2, '380145502_11_n.jpg', '2024-08-15 19:37:13', NULL, NULL, 'Unregistered'),
(11, 'Walter', 'Bejo', 'Ologuinsan', 'Jr', 'Male', '2002-09-28', 'Single', 'Filipino', 'Mandaue', '0932 946 4196', 'PJ6J915x8o9TOAacnxoyYeBgMb+kOu5rhxPo4s+u8J0=', 'Arca', '$2y$10$Q4cYh/WVDeOk0G.s/VSHaunHTkiNUR.Da//XDcjcu8c5uKVG6YepS', NULL, 'Not-registered', 2, 'Image1.jpg', '2024-08-20 15:01:18', 'qP2R57MZWPdHm+V7oRFBcw==', '2024-09-12 08:12:28', 'Active'),
(12, 'Ogie', 'Bejo', 'Ologuinsan', 'Jr', 'Male', '2002-09-28', 'Single', 'Filipino', 'Mandaue', '0932 946 4191', 'BPPezEwW6I07bl5XMk0Bzph8EONPVuaFNh4y9dKRFBU=', 'Arca', '$2y$10$wbusHhlvH3D/Bv7gsoNRTe3zkiO7lMoyjwSkUjesax.1D..Uqcfom', NULL, 'Not-registered', 2, 'Image1.jpg', '2024-08-22 09:28:15', NULL, NULL, 'Active'),
(13, 'Milenia', 'Ella', 'Blade', ' ', 'Female', '2002-09-28', 'Single', 'Filipino', 'Mandaue', '0933 949 6996', 'v1SpLVQwr1zmURk9o7e4jsDzT9SKlFUTmG+13H8ARms=', 'Arca', '$2y$10$GUY7lR5Au6hVYnMBw0a0POGPq68s.iBE.DWRgmtsXvc7T.a6Wt0Jy', NULL, 'Not-registered', 2, 'QR_Code_10.png', '2024-09-12 15:12:40', NULL, NULL, 'Unregistered'),
(14, 'Mariene', 'Lune', 'Mabulay', ' ', 'Female', '2003-01-05', 'Single', 'Filipino', 'Cebu City', '0995 470 2461', 'Ogcgi6CXZHvyGzIAHfOfxTZgViV8YCewXvpvWNuascA=', 'Sewage', '$2y$10$dMYgyi4ltRFsYm7tczLG.upxLmHdbkL5VZKfI706G.fr/k0pQcy5O', 'WIN_20240129_15_10_00_Pro.jpg', 'Registered', 2, 'Screenshot (792).png', '2024-10-06 19:43:24', NULL, NULL, 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `user_posts`
--

CREATE TABLE `user_posts` (
  `post_id` int(11) NOT NULL,
  `res_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `upvotes` int(11) NOT NULL DEFAULT 0,
  `downvotes` int(11) NOT NULL DEFAULT 0,
  `approval_status` enum('pending','approved','rejected','resubmitted') NOT NULL DEFAULT 'pending',
  `rejection_reason` text DEFAULT NULL,
  `approved_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_posts`
--

INSERT INTO `user_posts` (`post_id`, `res_id`, `title`, `content`, `created_at`, `upvotes`, `downvotes`, `approval_status`, `rejection_reason`, `approved_by`) VALUES
(1, 14, 'I LOVE MY CATS.', 'Cats have a unique way of capturing our hearts with their playful antics and soothing purrs. Each of my feline companions brings a distinct personality to our home. From the curious and adventurous spirit of my tabby to the gentle and affectionate nature of my calico, they have a special ability to brighten my day. Watching them chase after a toy or curl up in a sunbeam fills my heart with joy. Their independent nature allows them to explore the world on their terms, and I admire their confidence and grace.\n\nBeyond their charming behaviors, my cats provide an unmatched sense of comfort and companionship. There\'s something incredibly calming about having them curl up beside me while I read or work. Their soft purring serves as a gentle reminder to slow down and appreciate the little moments. Whether it’s their mischievous antics or the way they nuzzle against me for affection, my cats enrich my life in countless ways. I cherish the bond we share and feel grateful for their unconditional love and companionship.', '2024-10-06 11:46:42', 1, 0, 'approved', NULL, NULL),
(2, 11, 'Lorem Ipsum', '\nfreestar \n\nfreestar\n \nLorem ipsum dolor sit amet, consectetur adipiscing elit. Sed condimentum sem id ante condimentum, non suscipit sapien consectetur. Maecenas varius mauris at lectus ultricies, vitae feugiat odio dignissim. Sed elementum sed neque ac venenatis. Aliquam erat volutpat. Duis molestie non risus eu volutpat. Phasellus urna libero, porta a fermentum nec, tempus eget purus. Donec at convallis orci, sed venenatis diam. Aliquam dignissim erat et est venenatis molestie.\n\nFusce nec pretium ligula. Curabitur consectetur diam erat, non efficitur tortor euismod et. Aliquam molestie quam porta velit semper venenatis. Proin eu egestas nibh, blandit vulputate felis. Nam felis justo, varius in ipsum eget, ornare varius arcu. Vivamus suscipit turpis at ante suscipit, at iaculis nunc varius. Nulla egestas sollicitudin tellus sed consectetur. Phasellus dictum ex quis orci auctor, vitae auctor neque rhoncus. Duis viverra turpis nec mauris molestie interdum. Duis pulvinar tellus ac orci pharetra, quis condimentum purus ultrices.', '2024-10-09 10:02:52', 0, 0, 'pending', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_posts_comments`
--

CREATE TABLE `user_posts_comments` (
  `comment_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `res_id` int(11) NOT NULL,
  `comment_content` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_posts_comments`
--

INSERT INTO `user_posts_comments` (`comment_id`, `post_id`, `res_id`, `comment_content`, `created_at`, `updated_at`) VALUES
(1, 1, 11, 'Wow Grape :D', '2024-10-09 11:38:43', '2024-10-09 11:38:43');

-- --------------------------------------------------------

--
-- Table structure for table `user_posts_media`
--

CREATE TABLE `user_posts_media` (
  `media_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `media_type` enum('image','video') NOT NULL,
  `media_path` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_posts_media`
--

INSERT INTO `user_posts_media` (`media_id`, `post_id`, `media_type`, `media_path`) VALUES
(1, 1, 'image', '670278a2a50d8.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `user_posts_reactions`
--

CREATE TABLE `user_posts_reactions` (
  `reaction_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `res_id` int(11) NOT NULL,
  `reaction_type` enum('upvote','downvote') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_posts_reactions`
--

INSERT INTO `user_posts_reactions` (`reaction_id`, `post_id`, `res_id`, `reaction_type`, `created_at`) VALUES
(1, 1, 11, 'upvote', '2024-10-09 11:38:26');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account_role`
--
ALTER TABLE `account_role`
  ADD PRIMARY KEY (`userRole_id`);

--
-- Indexes for table `announcement_comments`
--
ALTER TABLE `announcement_comments`
  ADD PRIMARY KEY (`comment_id`),
  ADD KEY `post_id` (`post_id`),
  ADD KEY `res_id` (`res_id`);

--
-- Indexes for table `announcement_posts`
--
ALTER TABLE `announcement_posts`
  ADD PRIMARY KEY (`post_id`),
  ADD KEY `staff_id` (`staff_id`);

--
-- Indexes for table `announcement_posts_media`
--
ALTER TABLE `announcement_posts_media`
  ADD PRIMARY KEY (`media_id`),
  ADD KEY `post_id` (`post_id`);

--
-- Indexes for table `announcement_posts_reactions`
--
ALTER TABLE `announcement_posts_reactions`
  ADD PRIMARY KEY (`reaction_id`),
  ADD KEY `post_id` (`post_id`),
  ADD KEY `res_id` (`res_id`);

--
-- Indexes for table `appointment_tbl`
--
ALTER TABLE `appointment_tbl`
  ADD PRIMARY KEY (`appt_ID`),
  ADD KEY `res_ID` (`res_ID`),
  ADD KEY `doc_ID` (`doc_ID`);

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
-- Indexes for table `user_posts`
--
ALTER TABLE `user_posts`
  ADD PRIMARY KEY (`post_id`),
  ADD KEY `res_id` (`res_id`),
  ADD KEY `fk_approved_by` (`approved_by`);

--
-- Indexes for table `user_posts_comments`
--
ALTER TABLE `user_posts_comments`
  ADD PRIMARY KEY (`comment_id`),
  ADD KEY `post_id` (`post_id`),
  ADD KEY `res_id` (`res_id`);

--
-- Indexes for table `user_posts_media`
--
ALTER TABLE `user_posts_media`
  ADD PRIMARY KEY (`media_id`),
  ADD KEY `post_id` (`post_id`);

--
-- Indexes for table `user_posts_reactions`
--
ALTER TABLE `user_posts_reactions`
  ADD PRIMARY KEY (`reaction_id`),
  ADD KEY `post_id` (`post_id`),
  ADD KEY `res_id` (`res_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `account_role`
--
ALTER TABLE `account_role`
  MODIFY `userRole_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `announcement_comments`
--
ALTER TABLE `announcement_comments`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `announcement_posts`
--
ALTER TABLE `announcement_posts`
  MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT for table `announcement_posts_media`
--
ALTER TABLE `announcement_posts_media`
  MODIFY `media_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=103;

--
-- AUTO_INCREMENT for table `announcement_posts_reactions`
--
ALTER TABLE `announcement_posts_reactions`
  MODIFY `reaction_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `appointment_tbl`
--
ALTER TABLE `appointment_tbl`
  MODIFY `appt_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `barangay_staff`
--
ALTER TABLE `barangay_staff`
  MODIFY `staff_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT for table `complaints_tbl`
--
ALTER TABLE `complaints_tbl`
  MODIFY `complaint_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

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
-- AUTO_INCREMENT for table `request_doc`
--
ALTER TABLE `request_doc`
  MODIFY `doc_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `resident_users`
--
ALTER TABLE `resident_users`
  MODIFY `res_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `user_posts`
--
ALTER TABLE `user_posts`
  MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user_posts_comments`
--
ALTER TABLE `user_posts_comments`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user_posts_media`
--
ALTER TABLE `user_posts_media`
  MODIFY `media_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user_posts_reactions`
--
ALTER TABLE `user_posts_reactions`
  MODIFY `reaction_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `announcement_comments`
--
ALTER TABLE `announcement_comments`
  ADD CONSTRAINT `fk_post_id_comments` FOREIGN KEY (`post_id`) REFERENCES `announcement_posts` (`post_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_res_id_comments` FOREIGN KEY (`res_id`) REFERENCES `resident_users` (`res_ID`);

--
-- Constraints for table `announcement_posts`
--
ALTER TABLE `announcement_posts`
  ADD CONSTRAINT `announcement_posts_ibfk_1` FOREIGN KEY (`staff_id`) REFERENCES `barangay_staff` (`staff_id`) ON DELETE CASCADE;

--
-- Constraints for table `announcement_posts_media`
--
ALTER TABLE `announcement_posts_media`
  ADD CONSTRAINT `announcement_posts_media_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `announcement_posts` (`post_id`) ON DELETE CASCADE;

--
-- Constraints for table `announcement_posts_reactions`
--
ALTER TABLE `announcement_posts_reactions`
  ADD CONSTRAINT `announcement_posts_reactions_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `announcement_posts` (`post_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `announcement_posts_reactions_ibfk_2` FOREIGN KEY (`res_id`) REFERENCES `resident_users` (`res_ID`);

--
-- Constraints for table `appointment_tbl`
--
ALTER TABLE `appointment_tbl`
  ADD CONSTRAINT `appointment_tbl_ibfk_1` FOREIGN KEY (`res_ID`) REFERENCES `resident_users` (`res_ID`),
  ADD CONSTRAINT `appointment_tbl_ibfk_2` FOREIGN KEY (`doc_ID`) REFERENCES `request_doc` (`doc_ID`);

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

--
-- Constraints for table `user_posts`
--
ALTER TABLE `user_posts`
  ADD CONSTRAINT `fk_approved_by` FOREIGN KEY (`approved_by`) REFERENCES `barangay_staff` (`staff_id`),
  ADD CONSTRAINT `fk_res_id_posts` FOREIGN KEY (`res_id`) REFERENCES `resident_users` (`res_ID`) ON DELETE CASCADE;

--
-- Constraints for table `user_posts_comments`
--
ALTER TABLE `user_posts_comments`
  ADD CONSTRAINT `user_post_id_comments` FOREIGN KEY (`post_id`) REFERENCES `user_posts` (`post_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `user_res_id_comments` FOREIGN KEY (`res_id`) REFERENCES `resident_users` (`res_ID`);

--
-- Constraints for table `user_posts_media`
--
ALTER TABLE `user_posts_media`
  ADD CONSTRAINT `fk_res_id_media` FOREIGN KEY (`post_id`) REFERENCES `user_posts` (`post_id`) ON DELETE CASCADE;

--
-- Constraints for table `user_posts_reactions`
--
ALTER TABLE `user_posts_reactions`
  ADD CONSTRAINT `fk_post_id_reactions` FOREIGN KEY (`post_id`) REFERENCES `user_posts` (`post_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_res_id_reactions` FOREIGN KEY (`res_id`) REFERENCES `resident_users` (`res_ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
