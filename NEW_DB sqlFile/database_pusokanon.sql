-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Generation Time: Sep 29, 2024 at 09:25 AM
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
(11, 8, 7, 5, 'asdagfh', 500, 'Pending', '2024-09-29 07:20:14', '2024-09-29 07:20:17', 'Not released', '<1qT|r.Lw', '1727594417.png', 'ccebc96b5ce58299.jpg'),
(12, 8, 2, 3, 'Person With Disability Assistance', 0, 'Pending', '2024-09-29 07:23:22', '2024-09-29 07:23:24', 'Not released', '9nL%)ivb]', '1727594604.png', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `request_doc`
--
ALTER TABLE `request_doc`
  ADD PRIMARY KEY (`doc_ID`),
  ADD KEY `FK_RESIDENT` (`res_id`),
  ADD KEY `FK_doc_type` (`docType_id`),
  ADD KEY `FK_PUPOSE` (`purpose_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `request_doc`
--
ALTER TABLE `request_doc`
  MODIFY `doc_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `request_doc`
--
ALTER TABLE `request_doc`
  ADD CONSTRAINT `doctype_fk` FOREIGN KEY (`docType_id`) REFERENCES `doc_type` (`docType_id`),
  ADD CONSTRAINT `pupose_fk` FOREIGN KEY (`purpose_id`) REFERENCES `docs_purpose` (`purpose_id`),
  ADD CONSTRAINT `userDocs request` FOREIGN KEY (`res_id`) REFERENCES `resident_users` (`res_ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
