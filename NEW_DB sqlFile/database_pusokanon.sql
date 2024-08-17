-- MySQL dump 10.19  Distrib 10.3.38-MariaDB, for Linux (x86_64)
--
-- Host: localhost    Database: tlqwwemq_database_pusokanon
-- ------------------------------------------------------
-- Server version	10.3.38-MariaDB-cll-lve

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `account_role`
--

DROP TABLE IF EXISTS `account_role`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `account_role` (
  `userRole_id` int(11) NOT NULL AUTO_INCREMENT,
  `role_definition` varchar(50) NOT NULL,
  PRIMARY KEY (`userRole_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `account_role`
--

LOCK TABLES `account_role` WRITE;
/*!40000 ALTER TABLE `account_role` DISABLE KEYS */;
INSERT INTO `account_role` VALUES (1,'Captain'),(2,'Resident'),(3,'secretary'),(4,'officials'),(5,'document processing'),(6,'Collabs'),(7,'Blotter Officer');
/*!40000 ALTER TABLE `account_role` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `barangay_staff`
--

DROP TABLE IF EXISTS `barangay_staff`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `barangay_staff` (
  `staff_id` int(11) NOT NULL AUTO_INCREMENT,
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
  `status` varchar(20) NOT NULL,
  PRIMARY KEY (`staff_id`),
  KEY `userRole_id` (`userRole_id`),
  CONSTRAINT `barangay_staff_ibfk_1` FOREIGN KEY (`userRole_id`) REFERENCES `account_role` (`userRole_id`)
) ENGINE=InnoDB AUTO_INCREMENT=64 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `barangay_staff`
--

LOCK TABLES `barangay_staff` WRITE;
/*!40000 ALTER TABLE `barangay_staff` DISABLE KEYS */;
INSERT INTO `barangay_staff` VALUES (17,'7QXDtZUbkEGvyt0/vp6biA==','GybcJWzThnPH77KVLDS+ig==','+b0go2IGA68MwefHI3QKrw==','','0000-00-00','Male','09347334823',1,'nEI84/Ehh2SZZEUMNzkDLw==','BjfCK8M0mubh7rmg4W5sug==','$2y$10$i.WeCn6b5U2osAgLTbo/vOTBJidppS9DP7nVWKzMkqDWcT9t8O172','ACTIVE'),(60,'t+FxILiWLXP/QiR6U/tPTQ==','4bRlCdKuqV93r2XA+QypfA==','L0VNWzJdF6FyKgU3hfoloA==','','0000-00-00','Female','09472340876',3,'8pPI8TOCQfYSelCcQ21ss111JZhQCV8iJPI1rp8KhR0=','FLFydCCa0k1u9NOmNdmbTg==','$2y$10$sA0UTCGbfUidCv337Re77ODGGqlDo9z.dKiYj8AXes3dYDlxWQS1G','ACTIVE'),(61,'RzzeyROKFU0TExhG+qYaBw==','Y2fEy5soB5k8MsJX/Qc6kw==','IEHazRM6gmMJE4IV5NnQ5A==','IV','0000-00-00','Male','+1 (528) 591-4175',4,'PTjNhBq8gjrJJYFTNAAwkOEydIx00EFgJIKhPjnoRPk=','wIA87kaTuB5G1JyZugB+oA==','$2y$10$eaD1FkJgt9f9/a9tP.FuJe01dv2iAGMRyfTbhKnF9VRbph/rNCW0W','ACTIVE'),(63,'vxLAysrYz1s7BVT7rLvN5Q==','s8ihuIr3QN/p0QMzN3LgFw==','jhyQwPQ7jASNmvj8aRepnw==','II','0000-00-00','Male','+1 (859) 728-1592',5,'fve0NnVWQjo4FrP5myOVcM+A4raMWpIM0R5f/iUyo8w=','9AZHLHTYHG6rjqfw/H3jQA==','$2y$10$ksH7aaJXYP2ltqcnBzjx9u.AGUL9b.EKeXsUnfAvf9qBZajE.DY.a','ACTIVE');
/*!40000 ALTER TABLE `barangay_staff` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `complaints_tbl`
--

DROP TABLE IF EXISTS `complaints_tbl`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `complaints_tbl` (
  `complaint_id` int(11) NOT NULL AUTO_INCREMENT,
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
  `date_closed` date DEFAULT NULL,
  PRIMARY KEY (`complaint_id`),
  KEY `staff_id` (`staff_id`),
  KEY `fk_res` (`res_id`),
  CONSTRAINT `fk_res` FOREIGN KEY (`res_id`) REFERENCES `resident_users` (`res_ID`),
  CONSTRAINT `staff_fk` FOREIGN KEY (`staff_id`) REFERENCES `barangay_staff` (`staff_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `complaints_tbl`
--

LOCK TABLES `complaints_tbl` WRITE;
/*!40000 ALTER TABLE `complaints_tbl` DISABLE KEYS */;
/*!40000 ALTER TABLE `complaints_tbl` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `doc_type`
--

DROP TABLE IF EXISTS `doc_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `doc_type` (
  `docType_id` int(11) NOT NULL AUTO_INCREMENT,
  `doc_name` varchar(100) NOT NULL,
  `doc_amount` int(11) NOT NULL,
  PRIMARY KEY (`docType_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `doc_type`
--

LOCK TABLES `doc_type` WRITE;
/*!40000 ALTER TABLE `doc_type` DISABLE KEYS */;
INSERT INTO `doc_type` VALUES (1,'Barangay Clearance',80),(2,'Barangay Indigency',50),(3,'Cedula',50),(4,'Barangay Residency',50),(5,'Barangay Electrical Permit',500),(6,'Barangay Construction Permit',500),(7,'Barangay Fencing Permit',500),(8,'Barangay Business Clearance',630),(9,'Barangay Certificate',50);
/*!40000 ALTER TABLE `doc_type` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `docs_purpose`
--

DROP TABLE IF EXISTS `docs_purpose`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `docs_purpose` (
  `purpose_id` int(11) NOT NULL AUTO_INCREMENT,
  `purpose_name` varchar(50) NOT NULL,
  `pupose_fee` int(50) NOT NULL,
  PRIMARY KEY (`purpose_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `docs_purpose`
--

LOCK TABLES `docs_purpose` WRITE;
/*!40000 ALTER TABLE `docs_purpose` DISABLE KEYS */;
INSERT INTO `docs_purpose` VALUES (1,'Employment',0),(2,'Students Scholarship',0),(3,'Person With Disability Assistance',0),(4,'Senior Citizen Assistance',0),(5,'Other',80);
/*!40000 ALTER TABLE `docs_purpose` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `initial_sitio_population`
--

DROP TABLE IF EXISTS `initial_sitio_population`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `initial_sitio_population` (
  `sitio_id` int(11) NOT NULL AUTO_INCREMENT,
  `sitio_name` varchar(50) NOT NULL,
  `total_initial_residents` int(11) NOT NULL,
  PRIMARY KEY (`sitio_id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `initial_sitio_population`
--

LOCK TABLES `initial_sitio_population` WRITE;
/*!40000 ALTER TABLE `initial_sitio_population` DISABLE KEYS */;
INSERT INTO `initial_sitio_population` VALUES (1,'Arca',33),(2,'Cemento',0),(3,'Chumba-Chumba',0),(4,'Ibabao',0),(5,'Lawis',0),(6,'Matumbo',0),(7,'Mustang',0),(8,'New Lipata',0),(9,'San Roque',21),(10,'Seabreeze',0),(11,'Seaside',0),(12,'Sewage',0),(13,'Sta. Maria',0);
/*!40000 ALTER TABLE `initial_sitio_population` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `request_doc`
--

DROP TABLE IF EXISTS `request_doc`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `request_doc` (
  `doc_ID` int(11) NOT NULL AUTO_INCREMENT,
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
  `document_requirements` varchar(64) DEFAULT NULL,
  PRIMARY KEY (`doc_ID`),
  KEY `FK_RESIDENT` (`res_id`),
  KEY `FK_doc_type` (`docType_id`),
  KEY `FK_PUPOSE` (`purpose_id`),
  CONSTRAINT `doctype_fk` FOREIGN KEY (`docType_id`) REFERENCES `doc_type` (`docType_id`),
  CONSTRAINT `pupose_fk` FOREIGN KEY (`purpose_id`) REFERENCES `docs_purpose` (`purpose_id`),
  CONSTRAINT `userDocs request` FOREIGN KEY (`res_id`) REFERENCES `resident_users` (`res_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `request_doc`
--

LOCK TABLES `request_doc` WRITE;
/*!40000 ALTER TABLE `request_doc` DISABLE KEYS */;
/*!40000 ALTER TABLE `request_doc` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `resident_users`
--

DROP TABLE IF EXISTS `resident_users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `resident_users` (
  `res_ID` int(11) NOT NULL AUTO_INCREMENT,
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
  `account_active_status` varchar(16) NOT NULL DEFAULT 'Unregistered',
  PRIMARY KEY (`res_ID`),
  UNIQUE KEY `reset_token_hash` (`reset_token_hash`),
  KEY `role_ID` (`userRole_id`),
  CONSTRAINT `resident_users_ibfk_1` FOREIGN KEY (`userRole_id`) REFERENCES `account_role` (`userRole_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `resident_users`
--

LOCK TABLES `resident_users` WRITE;
/*!40000 ALTER TABLE `resident_users` DISABLE KEYS */;
INSERT INTO `resident_users` VALUES (6,'niorey','cabunilas','yonson','I','Male','1988-10-09','Married','Filipino','Rerum proident modi','0989 345 9842','RttvRYF8taWyJoweINRR7bQg0nhSGo7KfmGgEY5s5hA=','Ibabao','$2y$10$HmLy7vQ97oYIeJ0zJk23VusdnmvaA4PruQgcLDC1KwsQUAJPK7Ty6','44912_n.jpg','Registered',2,'380145502_11_n.jpg','2024-08-14 21:12:40',NULL,NULL,'Active'),(8,'Vivien','Lane','Reagan Ruiz','I','Female','1999-12-15','Single','Eius ut quis perspic','Vero consectetur con','09873459873','4wJSXG/iBtqzVJb3OXrX4REKkFkB00P2o7j+uJN4Pbw=','New Lipata','$2y$10$wI0zj6LSsq47hgThyawF9ufUPlsV/VhZ9sh/aP7/oTYvbeywMqvAi',NULL,'Not-registered',2,'380145502_11_n.jpg','2024-08-14 22:53:53',NULL,NULL,'Active'),(10,'Hiroko','Rutledge','Derek Blevins','II.','Male','1982-02-27','Single','Canadian','Maxime et et id qui ','0968 202 7920','4wJSXG/iBtqzVJb3OXrX4REKkFkB00P2o7j+uJN4Pbw=','Cemento','$2y$10$VE8y80aZ7J08NUoMQttGCeY/l5osNs5G7PWlbvkVJCgus0MlfM2HS',NULL,'Not-registered',2,'380145502_11_n.jpg','2024-08-15 19:37:13',NULL,NULL,'Unregistered');
/*!40000 ALTER TABLE `resident_users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping events for database 'tlqwwemq_database_pusokanon'
--

--
-- Dumping routines for database 'tlqwwemq_database_pusokanon'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-08-17 14:41:14
