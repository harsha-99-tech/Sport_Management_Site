-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 17, 2024 at 12:20 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sms`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `AdminID` int(11) NOT NULL,
  `Username` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `FirstName` varchar(50) NOT NULL,
  `LastName` varchar(50) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `CreatedAt` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`AdminID`, `Username`, `Password`, `FirstName`, `LastName`, `Email`, `CreatedAt`) VALUES
(1, 'admin', '$2y$10$by2k4Can7nnLwlcHxq9Q0en4w82AHu/4FVXhvkB6EJOBbenBy59pS', 'Kasun', 'Silva', 'kasun.silva@example.com', '2023-11-09 18:28:37'),
(2, 'admin2', '$2y$10$by2k4Can7nnLwlcHxq9Q0en4w82AHu/4FVXhvkB6EJOBbenBy59pS', 'Malini', 'Fernando', 'malini.fernando@example.com', '2023-11-09 18:28:37');

-- --------------------------------------------------------

--
-- Table structure for table `coaches`
--

CREATE TABLE `coaches` (
  `CoachID` int(11) NOT NULL,
  `FirstName` varchar(50) DEFAULT NULL,
  `LastName` varchar(50) DEFAULT NULL,
  `DateOfBirth` date DEFAULT NULL,
  `Gender` varchar(20) DEFAULT NULL,
  `Email` varchar(100) DEFAULT NULL,
  `PhoneNumber` varchar(20) DEFAULT NULL,
  `Address` text DEFAULT NULL,
  `Specialty` varchar(100) DEFAULT NULL,
  `Certifications` text DEFAULT NULL,
  `SportID` int(11) DEFAULT NULL,
  `Password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `coaches`
--

INSERT INTO `coaches` (`CoachID`, `FirstName`, `LastName`, `DateOfBirth`, `Gender`, `Email`, `PhoneNumber`, `Address`, `Specialty`, `Certifications`, `SportID`, `Password`) VALUES
(200, 'Rohan', 'Silva', '1980-05-15', 'Male', 'rohan.silva@emcscail.com', '909090', '10 Galle Road, Colombo, Sri Lanka', 'Cricket Coaching', 'Level 2 Coaching Certificate', 101, '$2y$10$by2k4Can7nnLwlcHxq9Q0en4w82AHu/4FVXhvkB6EJOBbenBy59pS'),
(201, 'Dilini', 'Fernando', '1975-06-20', 'Female', 'dilini.fernando@email.com', '777-201-2010', '22 Kandy Road, Kandy, Sri Lanka', 'Tennis Coaching', 'Tennis Pro Certification', 102, '$2y$10$by2k4Can7nnLwlcHxq9Q0en4w82AHu/4FVXhvkB6EJOBbenBy59pS'),
(213, 'Kamal', 'Perera', '1980-05-15', 'Male', 'kamal.perera@example.com', '+94 77 123 4567', '123 Main St, Colombo', 'Football', 'UEFA Coaching License', 101, '$2y$10$by2k4Can7nnLwlcHxq9Q0en4w82AHu/4FVXhvkB6EJOBbenBy59pS'),
(214, 'Niluka', 'Fernando', '1975-08-20', 'Female', 'niluka.fernando@example.com', '+94 71 987 6543', '456 Park Rd, Kandy', 'Basketball', 'Basketball Coaching Certification', 102, '$2y$10$by2k4Can7nnLwlcHxq9Q0en4w82AHu/4FVXhvkB6EJOBbenBy59pS'),
(215, 'Saman', 'Silva', '1972-02-10', 'Male', 'saman.silva@example.com', '+94 76 234 5678', '789 Lake View, Galle', 'Cricket', 'Level 3 Cricket Coaching', 103, '1234'),
(216, 'Dilhani', 'Wickramasinghe', '1978-11-25', 'Female', 'dilhani.w@example.com', '+94 72 876 5432', '101 Hillside Ave, Nuwara Eliya', 'Swimming', 'Swimming Coach Certification', 104, '1234'),
(217, 'Chathura', 'Gunawardena', '1970-07-03', 'Male', 'chathura.g@example.com', '+94 70 345 6789', '456 Sunset Blvd, Matara', 'Tennis', 'Tennis Coaching Certification', 105, '1234'),
(218, 'Sanduni', 'Fernando', '1974-09-18', 'Female', 'sanduni.f@example.com', '+94 75 876 5432', '789 Palm St, Jaffna', 'Volleyball', 'Volleyball Coaching License', 106, '1234'),
(219, 'Roshan', 'Samaraweera', '1977-04-12', 'Male', 'roshan.s@example.com', '+94 76 234 5678', '102 Sea View, Trincomalee', 'Badminton', 'Badminton Coach Certification', 107, '1234'),
(220, 'Anoma', 'Perera', '1973-06-30', 'Female', 'anoma.p@example.com', '+94 71 345 6789', '345 Hilltop Rd, Batticaloa', 'Athletics', 'Athletics Coaching Certification', 108, '1234'),
(221, 'Chandana', 'De Silva', '1976-12-08', 'Male', 'chandana.ds@example.com', '+94 70 987 6543', '789 Forest Lane, Anuradhapura', 'Rugby', 'World Rugby Coaching Certificate', 109, '1234'),
(222, 'Ishara', 'Jayasinghe', '1971-03-22', 'Female', 'ishara.j@example.com', '+94 72 123 4567', '456 River Rd, Polonnaruwa', 'Table Tennis', 'Table Tennis Coach Certification', 110, '1234'),
(252, 'Test fname', 'Test lname', '2023-11-28', 'Male', 'maleeshadmax@gmail.com', '0711231230', 'address test', 'spec test', 'certf test', NULL, '$2y$10$/LGkndPPMCx8NOF9qsfp4uHfpbDC5AU1Uw.xI0pbsmekRSTMS0pLS');

-- --------------------------------------------------------

--
-- Table structure for table `coach_sports`
--

CREATE TABLE `coach_sports` (
  `CoachSportID` int(11) NOT NULL,
  `CoachID` int(11) NOT NULL,
  `SportID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `coach_sports`
--

INSERT INTO `coach_sports` (`CoachSportID`, `CoachID`, `SportID`) VALUES
(1, 210, 102),
(2, 210, 103),
(3, 211, 103),
(4, 212, 102),
(5, 212, 103),
(6, 212, 104),
(7, 202, 103),
(8, 203, 104),
(9, 204, 101),
(10, 205, 108),
(11, 206, 102),
(12, 207, 107),
(13, 208, 105),
(14, 209, 106),
(15, 210, 109),
(16, 211, 102),
(17, 223, 101),
(18, 226, 103),
(19, 227, 102),
(20, 227, 103),
(21, 228, 103),
(22, 229, 101),
(23, 229, 102),
(24, 230, 101),
(25, 230, 102),
(26, 230, 103),
(27, 231, 101),
(28, 231, 102),
(29, 231, 103),
(30, 232, 101),
(31, 232, 102),
(32, 232, 103),
(33, 233, 101),
(34, 233, 102),
(35, 233, 103),
(36, 234, 101),
(37, 234, 102),
(38, 234, 103),
(39, 235, 101),
(40, 235, 102),
(41, 235, 103),
(42, 236, 101),
(43, 236, 102),
(44, 236, 103),
(45, 237, 101),
(46, 237, 102),
(47, 237, 103),
(48, 238, 101),
(49, 238, 102),
(50, 238, 103),
(51, 239, 101),
(52, 239, 102),
(53, 239, 103),
(54, 240, 101),
(55, 241, 102),
(56, 242, 102),
(57, 243, 102),
(58, 244, 102),
(59, 245, 102),
(60, 246, 102),
(61, 247, 102),
(62, 248, 102),
(63, 249, 102),
(64, 250, 103),
(65, 251, 102),
(66, 252, 101),
(67, 252, 102);

-- --------------------------------------------------------

--
-- Table structure for table `inventory`
--

CREATE TABLE `inventory` (
  `EquipmentID` int(11) NOT NULL,
  `EquipmentName` varchar(255) NOT NULL,
  `Quantity` int(11) NOT NULL,
  `Availability` enum('Available','Not Available') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `inventory`
--

INSERT INTO `inventory` (`EquipmentID`, `EquipmentName`, `Quantity`, `Availability`) VALUES
(2, 'Knee Guards', 26, 'Available'),
(3, 'Gloves', 35, 'Available'),
(4, 'Soccer Balls', 10, 'Available'),
(5, 'Shin Guards', 0, 'Not Available'),
(6, 'Basketballs', 30, 'Available'),
(7, 'Tennis Rackets', 0, 'Not Available'),
(8, 'Tennis Balls', 100, 'Available'),
(9, 'Badminton Rackets', 40, 'Available'),
(10, 'Badminton Shuttles', 40, 'Available'),
(12, 'Baseballs', 15, 'Available'),
(13, 'Swimming Goggles', 30, 'Available'),
(14, 'Swim Caps', 0, 'Not Available'),
(15, 'Dumbbells', 50, 'Available'),
(16, 'Yoga Mats', 40, 'Available'),
(17, 'Ping Pong Paddles', 0, 'Not Available'),
(18, 'Ping Pong Balls', 100, 'Available'),
(19, 'Volleyballs', 30, 'Available'),
(20, 'Gymnastics Mats', 15, 'Available'),
(21, 'Gymnastics Rings', 10, 'Available'),
(23, 'Cricket Bats', 25, 'Available'),
(24, 'Hockey Sticks', 30, 'Available'),
(26, 'Rugby Balls', 5, 'Available');

-- --------------------------------------------------------

--
-- Table structure for table `matches`
--

CREATE TABLE `matches` (
  `MatchID` int(11) NOT NULL,
  `SportID` int(11) DEFAULT NULL,
  `Date` date DEFAULT NULL,
  `Location` varchar(255) DEFAULT NULL,
  `Teams` varchar(255) DEFAULT NULL,
  `Winners` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `matches`
--

INSERT INTO `matches` (`MatchID`, `SportID`, `Date`, `Location`, `Teams`, `Winners`) VALUES
(1001, 101, '2023-10-25', 'University of Colombo', 'Team A vs. Team B', 'Team A'),
(1002, 102, '2023-10-26', 'University of Peradeniya', 'Team X vs. Team Y', 'Team Y'),
(1003, 103, '2023-11-21', 'University of Kelaniya', 'Team P vs. Team Q', ''),
(1004, 104, '2023-10-28', 'University of Moratuwa', 'Team M vs. Team N', 'Team N'),
(1005, 101, '2023-11-18', 'University of Sri Jayewardenepura', 'Team C vs. Team D', 'Team D'),
(1006, 101, '2023-10-04', 'Rajarata University', 'A vs B', '');

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `id` int(11) NOT NULL,
  `important` tinyint(1) DEFAULT NULL,
  `newsTitle` text DEFAULT NULL,
  `newsBody` longtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`id`, `important`, `newsTitle`, `newsBody`) VALUES
(1, 1, 'University Sports Registration Now Open', 'Calling all sports enthusiasts! Registration is officially open for our university\'s intramural sports leagues.'),
(2, 0, 'New Vollyball Courts Now Open for the Students', 'We\'re thrilled to announce the grand opening of our brand-new, world-class tennis courts, exclusively for out students.'),
(3, 0, 'Football Fields Ready for Action!', 'Calling all football enthusiasts! It\'s time to don those cleats and dive into the thrill of the game because our state-of-the-art sports ground is now open and ready for action. ');

-- --------------------------------------------------------

--
-- Table structure for table `players`
--

CREATE TABLE `players` (
  `PlayerID` int(11) NOT NULL,
  `Password` text NOT NULL,
  `FirstName` varchar(50) DEFAULT NULL,
  `LastName` varchar(50) DEFAULT NULL,
  `DateOfBirth` date DEFAULT NULL,
  `Gender` varchar(20) DEFAULT NULL,
  `Email` varchar(100) DEFAULT NULL,
  `PhoneNumber` varchar(20) DEFAULT NULL,
  `Address` text DEFAULT NULL,
  `EmergencyContactName` varchar(100) DEFAULT NULL,
  `EmergencyContactNumber` varchar(20) DEFAULT NULL,
  `MedicalConditions` text DEFAULT NULL,
  `RegistrationNo` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `players`
--

INSERT INTO `players` (`PlayerID`, `Password`, `FirstName`, `LastName`, `DateOfBirth`, `Gender`, `Email`, `PhoneNumber`, `Address`, `EmergencyContactName`, `EmergencyContactNumber`, `MedicalConditions`, `RegistrationNo`) VALUES
(1, '$2y$10$by2k4Can7nnLwlcHxq9Q0en4w82AHu/4FVXhvkB6EJOBbenBy59pS', 'Maleesha', 'Dinuranga', '1998-10-28', 'Male', 'student1@gmail.com', '0761234567', 'No.32/A, Mihintale', 'Susil Perera', '0621234567', NULL, 1007),
(2, '$2y$10$by2k4Can7nnLwlcHxq9Q0en4w82AHu/4FVXhvkB6EJOBbenBy59pS', 'Kasun', 'Silva', '1997-08-15', 'Male', 'kasun.silva@gmail.com', '0712345678', 'No.45/B, Kandy', 'Lakshman Ranasinghe', '0777654321', 'Asthma', 1008),
(3, '$2y$10$by2k4Can7nnLwlcHxq9Q0en4w82AHu/4FVXhvkB6EJOBbenBy59pS', 'Nimasha', 'Fernando', '1999-05-22', 'Female', 'nimasha.fernando@gmail.com', '0755555555', 'No.15/C, Colombo', 'Chaminda Perera', '0789876543', NULL, 1009),
(4, '$2y$10$by2k4Can7nnLwlcHxq9Q0en4w82AHu/4FVXhvkB6EJOBbenBy59pS', 'Dilshan', 'Rajapakse', '1996-12-03', 'Male', 'dilshan.rajapakse@gmail.com', '0777777777', 'No.60/D, Galle', 'Sumithra Jayawardena', '0712345678', 'Diabetes', 1010),
(5, '$2y$10$by2k4Can7nnLwlcHxq9Q0en4w82AHu/4FVXhvkB6EJOBbenBy59pS', 'Sachini', 'Fernando', '1998-02-18', 'Female', 'sachini.fernando@gmail.com', '0766666666', 'No.25/E, Matara', 'Ruwan Silva', '0723456789', NULL, 1011),
(6, '$2y$10$by2k4Can7nnLwlcHxq9Q0en4w82AHu/4FVXhvkB6EJOBbenBy59pS', 'Tharindu', 'Perera', '1997-07-11', 'Male', 'tharindu.perera@gmail.com', '0788888888', 'No.20/F, Negombo', 'Samantha Kumara', '0754321098', 'Allergies', 1012),
(7, '1234', 'Madhavi', 'Rathnayake', '1999-11-30', 'Female', 'madhavi.rathnayake@gmail.com', '0711111111', 'No.18/G, Jaffna', 'Kamal Perera', '0765432109', NULL, 1013),
(8, '1234', 'Nishan', 'Fernando', '1998-04-25', 'Male', 'nishan.fernando@gmail.com', '0765432109', 'No.55/H, Badulla', 'Dinesh Kumara', '0777777777', 'Heart Condition', 1014),
(9, '1234', 'Anuradha', 'Silva', '1997-09-08', 'Female', 'anuradha.silva@gmail.com', '0722222222', 'No.10/I, Ratnapura', 'Malini Ranaweera', '0756789012', NULL, 1015),
(10, '1234', 'Chathura', 'Perera', '1996-06-14', 'Male', 'chathura.perera@gmail.com', '0754321098', 'No.30/J, Kegalle', 'Ranjan Jayasekara', '0787654321', 'High Blood Pressure', 1016),
(11, '1234', 'Dinusha', 'Fernando', '1999-03-07', 'Female', 'dinusha.fernando@gmail.com', '0776543210', 'No.5/K, Kurunegala', 'Kusum Jayawardena', '0722222222', 'Asthma', 1017),
(23, '1234', 'Test Fname', 'Test Lname', '2023-11-16', 'Male', 'maleeshadmax@gmail.com', '0761231230', 'test address', 'Eng contact ', '0761231230', 'Test medical', 0),
(24, '1234', 'Maleesha', 'Dinuranga', '2023-11-15', 'Male', 'maleeshadmax@gmail.com', '0761231230', '123, Adresss', 'Emg test name', '0760000006', 'Fever', 0),
(25, '1234', 'AX', 'a', '2023-11-06', 'Male', 'AD@FSDS', '0761231230', 'AD', 'Eng contact ', '0761231230', 'SDFASD', 0),
(26, '1234', 'Maleesha', 'Dinuranga', '2020-06-15', 'Male', 'maleeshadmax@gmail.com', '0711231230', 'Test Address', 'Kusal', '0771231230', 'Allergies', 0),
(27, '$2y$10$vNUgWQtEe4NPmwST4ljLWu7onKEsloU.3NknVEAKWd7hhHi5IQHOC', 'Test fname', 'Test lname', '2023-11-06', 'Male', 'maleeshadmax@gmail.com', '0711231230', 'test', 'wewe', '0771231230', 'qq', 0);

-- --------------------------------------------------------

--
-- Table structure for table `player_sports`
--

CREATE TABLE `player_sports` (
  `ID` int(11) NOT NULL,
  `PlayerID` int(11) NOT NULL,
  `SportID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `player_sports`
--

INSERT INTO `player_sports` (`ID`, `PlayerID`, `SportID`) VALUES
(21, 1, 101),
(22, 2, 102),
(23, 3, 103),
(24, 27, 102),
(25, 27, 103);

-- --------------------------------------------------------

--
-- Table structure for table `practices_schedule`
--

CREATE TABLE `practices_schedule` (
  `PracticeID` int(11) NOT NULL,
  `SportID` int(11) DEFAULT NULL,
  `CoachID` int(11) DEFAULT NULL,
  `PracticeDate` date DEFAULT NULL,
  `StartTime` time DEFAULT NULL,
  `EndTime` time DEFAULT NULL,
  `Location` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `practices_schedule`
--

INSERT INTO `practices_schedule` (`PracticeID`, `SportID`, `CoachID`, `PracticeDate`, `StartTime`, `EndTime`, `Location`) VALUES
(19, 104, 201, '2023-11-10', '15:45:00', '16:45:00', 'Basketball Court'),
(20, 101, 200, '2023-11-10', '15:45:00', '16:45:00', 'University Playground'),
(21, 104, 201, '2023-11-12', '15:45:00', '16:45:00', 'Basketball Court');

-- --------------------------------------------------------

--
-- Table structure for table `sports`
--

CREATE TABLE `sports` (
  `SportID` int(11) NOT NULL,
  `SportName` varchar(100) NOT NULL,
  `Description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sports`
--

INSERT INTO `sports` (`SportID`, `SportName`, `Description`) VALUES
(101, 'Cricekt', NULL),
(102, 'Tennis', NULL),
(103, 'Soccer', NULL),
(104, 'Basketball', NULL),
(105, 'Badminton', NULL),
(106, 'Athletics', NULL),
(107, 'Volleyball', NULL),
(108, 'Swimming', NULL),
(109, 'Rugby', NULL),
(110, 'Table Tennis', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`AdminID`),
  ADD UNIQUE KEY `Username` (`Username`),
  ADD UNIQUE KEY `Email` (`Email`);

--
-- Indexes for table `coaches`
--
ALTER TABLE `coaches`
  ADD PRIMARY KEY (`CoachID`),
  ADD KEY `SportID` (`SportID`);

--
-- Indexes for table `coach_sports`
--
ALTER TABLE `coach_sports`
  ADD PRIMARY KEY (`CoachSportID`),
  ADD KEY `CoachID` (`CoachID`),
  ADD KEY `SportID` (`SportID`);

--
-- Indexes for table `inventory`
--
ALTER TABLE `inventory`
  ADD PRIMARY KEY (`EquipmentID`);

--
-- Indexes for table `matches`
--
ALTER TABLE `matches`
  ADD PRIMARY KEY (`MatchID`),
  ADD KEY `SportID` (`SportID`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `players`
--
ALTER TABLE `players`
  ADD PRIMARY KEY (`PlayerID`);

--
-- Indexes for table `player_sports`
--
ALTER TABLE `player_sports`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `PlayerID` (`PlayerID`),
  ADD KEY `SportID` (`SportID`);

--
-- Indexes for table `practices_schedule`
--
ALTER TABLE `practices_schedule`
  ADD PRIMARY KEY (`PracticeID`),
  ADD KEY `SportID` (`SportID`),
  ADD KEY `CoachID` (`CoachID`);

--
-- Indexes for table `sports`
--
ALTER TABLE `sports`
  ADD PRIMARY KEY (`SportID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `AdminID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `coaches`
--
ALTER TABLE `coaches`
  MODIFY `CoachID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=253;

--
-- AUTO_INCREMENT for table `coach_sports`
--
ALTER TABLE `coach_sports`
  MODIFY `CoachSportID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT for table `inventory`
--
ALTER TABLE `inventory`
  MODIFY `EquipmentID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `matches`
--
ALTER TABLE `matches`
  MODIFY `MatchID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1009;

--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `players`
--
ALTER TABLE `players`
  MODIFY `PlayerID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `player_sports`
--
ALTER TABLE `player_sports`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `practices_schedule`
--
ALTER TABLE `practices_schedule`
  MODIFY `PracticeID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `sports`
--
ALTER TABLE `sports`
  MODIFY `SportID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=111;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `coaches`
--
ALTER TABLE `coaches`
  ADD CONSTRAINT `coaches_ibfk_1` FOREIGN KEY (`SportID`) REFERENCES `sports` (`SportID`);

--
-- Constraints for table `coach_sports`
--
ALTER TABLE `coach_sports`
  ADD CONSTRAINT `coach_sports_ibfk_2` FOREIGN KEY (`SportID`) REFERENCES `sports` (`SportID`);

--
-- Constraints for table `matches`
--
ALTER TABLE `matches`
  ADD CONSTRAINT `matches_ibfk_1` FOREIGN KEY (`SportID`) REFERENCES `sports` (`SportID`);

--
-- Constraints for table `player_sports`
--
ALTER TABLE `player_sports`
  ADD CONSTRAINT `player_sports_ibfk_1` FOREIGN KEY (`PlayerID`) REFERENCES `players` (`PlayerID`),
  ADD CONSTRAINT `player_sports_ibfk_2` FOREIGN KEY (`SportID`) REFERENCES `sports` (`SportID`);

--
-- Constraints for table `practices_schedule`
--
ALTER TABLE `practices_schedule`
  ADD CONSTRAINT `practices_schedule_ibfk_1` FOREIGN KEY (`SportID`) REFERENCES `sports` (`SportID`),
  ADD CONSTRAINT `practices_schedule_ibfk_2` FOREIGN KEY (`CoachID`) REFERENCES `coaches` (`CoachID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
