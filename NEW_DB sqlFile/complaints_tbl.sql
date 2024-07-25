-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 25, 2024 at 11:55 AM
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

--
-- Indexes for dumped tables
--

--
-- Indexes for table `complaints_tbl`
--
ALTER TABLE `complaints_tbl`
  ADD PRIMARY KEY (`complaint_id`),
  ADD KEY `res_id` (`res_id`),
  ADD KEY `staff_id` (`staff_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `complaints_tbl`
--
ALTER TABLE `complaints_tbl`
  MODIFY `complaint_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
