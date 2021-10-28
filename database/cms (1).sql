-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Dec 22, 2020 at 08:38 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cms`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_credentials`
--

DROP TABLE IF EXISTS `admin_credentials`;
CREATE TABLE IF NOT EXISTS `admin_credentials` (
  `ID` varchar(20) NOT NULL,
  `Password` varchar(50) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin_credentials`
--

INSERT INTO `admin_credentials` (`ID`, `Password`) VALUES
('sparx_admin', '12345'),
('sparx_admin2', '54321');

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

DROP TABLE IF EXISTS `attendance`;
CREATE TABLE IF NOT EXISTS `attendance` (
  `Date` date NOT NULL,
  `SID` varchar(20) NOT NULL,
  `CID` varchar(20) NOT NULL,
  `Section` varchar(20) NOT NULL,
  `Status` varchar(20) NOT NULL,
  `TID` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `attendance`
--

INSERT INTO `attendance` (`Date`, `SID`, `CID`, `Section`, `Status`, `TID`) VALUES
('2020-12-17', '18F-0339', 'SS-113', 'C', 'P', 'BBA-3'),
('2020-12-03', '18F-0339', 'SS-113', 'C', 'P', 'BBA-3'),
('2020-12-02', '18F-0339', 'SS-113', 'C', 'P', 'BBA-3'),
('2020-12-09', '18F-0339', 'SS-113', 'C', 'P', 'BBA-3'),
('2020-12-03', '18F-0339', 'SS-113', 'C', 'A', 'BBA-3'),
('2020-12-02', '18F-0339', 'SS-113', 'C', 'A', 'BBA-3'),
('2020-12-02', '18F-2', 'SS-113', 'C', 'P', 'BBA-3'),
('2020-12-10', '18F-0339', 'SS-113', 'C', 'A', 'BBA-3'),
('2020-12-10', '18F-2', 'SS-113', 'C', 'P', 'BBA-3'),
('2020-12-10', '18F-3', 'SS-113', 'C', 'P', 'BBA-3'),
('2020-12-10', '18F-0339', 'SS-113', 'C', 'P', 'BBA-3'),
('2020-12-10', '18F-2', 'SS-113', 'C', 'P', 'BBA-3'),
('2020-12-10', '18F-3', 'SS-113', 'C', 'P', 'BBA-3'),
('2020-12-09', '18F-0339', 'SS-113', 'C', 'P', 'BBA-3'),
('2020-12-09', '18F-2', 'SS-113', 'C', 'P', 'BBA-3'),
('2020-12-09', '18F-3', 'SS-113', 'C', 'P', 'BBA-3'),
('2020-12-02', '18F-0339', 'CS-200', 'A', 'P', 'CS-1'),
('2020-12-02', '18F-2', 'CS-200', 'A', 'A', 'CS-1'),
('2020-12-02', '18F-3', 'CS-200', 'A', 'L', 'CS-1'),
('2020-12-23', '', 'CS-200', 'A', '', 'CS-1'),
('2020-12-23', '', 'CS-200', 'A', '', 'CS-1'),
('2020-12-23', '', 'CS-200', 'A', '', 'CS-1'),
('2020-12-23', '', 'CS-200', 'A', '', 'CS-1'),
('2020-12-23', '', 'CS-200', 'A', '', 'CS-1'),
('2020-12-23', '', 'CS-200', 'A', '', 'CS-1'),
('2020-12-23', '', 'CS-200', 'A', '', 'CS-1'),
('2020-12-23', '', 'CS-200', 'A', '', 'CS-1'),
('2020-12-23', '', 'CS-200', 'A', '', 'CS-1'),
('2020-12-23', '', 'CS-200', 'A', '', 'CS-1'),
('2020-12-23', '', 'CS-200', 'A', '', 'CS-1'),
('2020-12-23', '', 'CS-200', 'A', '', 'CS-1'),
('2020-12-23', '18F-0339', 'CS-200', 'A', 'P', 'CS-1'),
('2020-12-23', '18F-2', 'CS-200', 'A', 'P', 'CS-1'),
('2020-12-23', '18F-3', 'CS-200', 'A', 'P', 'CS-1'),
('2020-12-26', '', 'CS-200', 'A', '', 'CS-1'),
('2020-12-26', '', 'CS-200', 'A', '', 'CS-1'),
('2020-12-26', '', 'CS-200', 'A', '', 'CS-1'),
('2020-12-26', '', 'CS-200', 'A', '', 'CS-1'),
('2020-12-26', '', 'CS-200', 'A', '', 'CS-1'),
('2020-12-26', '', 'CS-200', 'A', '', 'CS-1'),
('2020-12-26', '', 'CS-200', 'A', '', 'CS-1'),
('2020-12-26', '', 'CS-200', 'A', '', 'CS-1'),
('2020-12-26', '', 'CS-200', 'A', '', 'CS-1'),
('2020-12-26', '', 'CS-200', 'A', '', 'CS-1'),
('2020-12-26', '', 'CS-200', 'A', '', 'CS-1'),
('2020-12-26', '', 'CS-200', 'A', '', 'CS-1'),
('2020-12-26', '', 'CS-200', 'A', '', 'CS-1'),
('2020-12-26', '', 'CS-200', 'A', '', 'CS-1'),
('2020-12-26', '', 'CS-200', 'A', '', 'CS-1'),
('2020-12-26', '', 'CS-200', 'A', '', 'CS-1'),
('2020-12-26', '', 'CS-200', 'A', '', 'CS-1'),
('2020-12-26', '', 'CS-200', 'A', '', 'CS-1'),
('2020-12-26', '18F-0339', 'CS-200', 'A', 'P', 'CS-1'),
('2020-12-26', '18F-2', 'CS-200', 'A', 'P', 'CS-1'),
('2020-12-26', '18F-3', 'CS-200', 'A', 'P', 'CS-1'),
('2020-12-28', '', 'CS-200', 'A', '', 'CS-1'),
('2020-12-28', '', 'CS-200', 'A', '', 'CS-1'),
('2020-12-28', '', 'CS-200', 'A', '', 'CS-1'),
('2020-12-28', '', 'CS-200', 'A', '', 'CS-1'),
('2020-12-28', '', 'CS-200', 'A', '', 'CS-1'),
('2020-12-28', '', 'CS-200', 'A', '', 'CS-1'),
('2020-12-28', '', 'CS-200', 'A', '', 'CS-1'),
('2020-12-28', '', 'CS-200', 'A', '', 'CS-1'),
('2020-12-28', '', 'CS-200', 'A', '', 'CS-1'),
('2020-12-28', '', 'CS-200', 'A', '', 'CS-1'),
('2020-12-28', '', 'CS-200', 'A', '', 'CS-1'),
('2020-12-28', '', 'CS-200', 'A', '', 'CS-1'),
('2020-12-28', '', 'CS-200', 'A', '', 'CS-1'),
('2020-12-28', '', 'CS-200', 'A', '', 'CS-1'),
('2020-12-28', '', 'CS-200', 'A', '', 'CS-1'),
('2020-12-28', '', 'CS-200', 'A', '', 'CS-1'),
('2020-12-28', '', 'CS-200', 'A', '', 'CS-1'),
('2020-12-28', '', 'CS-200', 'A', '', 'CS-1'),
('2020-12-28', '', 'CS-200', 'A', '', 'CS-1'),
('2020-12-28', '', 'CS-200', 'A', '', 'CS-1'),
('2020-12-28', '', 'CS-200', 'A', '', 'CS-1'),
('2020-12-28', '', 'CS-200', 'A', '', 'CS-1'),
('2020-12-28', '', 'CS-200', 'A', '', 'CS-1'),
('2020-12-28', '', 'CS-200', 'A', '', 'CS-1'),
('2020-12-28', '18F-0339', 'CS-200', 'A', 'P', 'CS-1'),
('2020-12-28', '18F-2', 'CS-200', 'A', 'P', 'CS-1'),
('2020-12-28', '18F-3', 'CS-200', 'A', 'P', 'CS-1'),
('2020-12-23', '18F-0339', 'CS-200', 'A', 'P', 'CS-1'),
('2020-12-23', '18F-2', 'CS-200', 'A', 'P', 'CS-1'),
('2020-12-23', '18F-3', 'CS-200', 'A', 'P', 'CS-1'),
('2020-12-02', '18F-2', 'EE-117', 'B', 'P', 'CS-2'),
('2020-12-02', '18F-3', 'EE-117', 'B', 'P', 'CS-2'),
('2020-12-02', '18F-0339', 'EE-117', 'B', 'P', 'CS-2'),
('2020-12-10', '', 'EE-117', 'B', '', 'CS-2'),
('2020-12-10', '', 'EE-117', 'B', '', 'CS-2'),
('2020-12-10', '', 'EE-117', 'B', '', 'CS-2'),
('2020-12-10', '18F-2', 'EE-117', 'B', 'P', 'CS-2'),
('2020-12-10', '18F-3', 'EE-117', 'B', 'P', 'CS-2'),
('2020-12-10', '18F-0339', 'EE-117', 'B', 'P', 'CS-2'),
('2020-12-24', '', 'EE-117', 'B', '', 'CS-2'),
('2020-12-24', '', 'EE-117', 'B', '', 'CS-2'),
('2020-12-24', '', 'EE-117', 'B', '', 'CS-2'),
('2020-12-24', '', 'EE-117', 'B', '', 'CS-2'),
('2020-12-24', '', 'EE-117', 'B', '', 'CS-2'),
('2020-12-24', '', 'EE-117', 'B', '', 'CS-2'),
('2020-12-24', '18F-2', 'EE-117', 'B', 'P', 'CS-2'),
('2020-12-24', '18F-3', 'EE-117', 'B', 'P', 'CS-2'),
('2020-12-24', '18F-0339', 'EE-117', 'B', 'P', 'CS-2'),
('2020-12-25', '', 'EE-117', 'B', '', 'CS-2'),
('2020-12-25', '', 'EE-117', 'B', '', 'CS-2'),
('2020-12-25', '', 'EE-117', 'B', '', 'CS-2'),
('2020-12-25', '', 'EE-117', 'B', '', 'CS-2'),
('2020-12-25', '', 'EE-117', 'B', '', 'CS-2'),
('2020-12-25', '', 'EE-117', 'B', '', 'CS-2'),
('2020-12-25', '', 'EE-117', 'B', '', 'CS-2'),
('2020-12-25', '', 'EE-117', 'B', '', 'CS-2'),
('2020-12-25', '', 'EE-117', 'B', '', 'CS-2'),
('2020-12-25', '18F-2', 'EE-117', 'B', 'P', 'CS-2'),
('2020-12-25', '18F-3', 'EE-117', 'B', 'P', 'CS-2'),
('2020-12-25', '18F-0339', 'EE-117', 'B', 'P', 'CS-2'),
('2020-12-29', '', 'EE-117', 'B', '', 'CS-2'),
('2020-12-29', '', 'EE-117', 'B', '', 'CS-2'),
('2020-12-29', '', 'EE-117', 'B', '', 'CS-2'),
('2020-12-29', '', 'EE-117', 'B', '', 'CS-2'),
('2020-12-29', '', 'EE-117', 'B', '', 'CS-2'),
('2020-12-29', '', 'EE-117', 'B', '', 'CS-2'),
('2020-12-29', '', 'EE-117', 'B', '', 'CS-2'),
('2020-12-29', '', 'EE-117', 'B', '', 'CS-2'),
('2020-12-29', '', 'EE-117', 'B', '', 'CS-2'),
('2020-12-29', '', 'EE-117', 'B', '', 'CS-2'),
('2020-12-29', '', 'EE-117', 'B', '', 'CS-2'),
('2020-12-29', '', 'EE-117', 'B', '', 'CS-2'),
('2020-12-29', '18F-2', 'EE-117', 'B', 'P', 'CS-2'),
('2020-12-29', '18F-3', 'EE-117', 'B', 'P', 'CS-2'),
('2020-12-29', '18F-0339', 'EE-117', 'B', 'P', 'CS-2'),
('2020-12-23', '18F-0339', 'SS-113', 'C', 'A', 'BBA-3'),
('2020-12-23', '18F-2', 'SS-113', 'C', 'P', 'BBA-3'),
('2020-12-23', '18F-3', 'SS-113', 'C', 'L', 'BBA-3'),
('2020-12-17', '', 'SS-113', 'C', '', 'BBA-3'),
('2020-12-17', '', 'SS-113', 'C', '', 'BBA-3'),
('2020-12-17', '', 'SS-113', 'C', '', 'BBA-3'),
('2020-12-17', '18F-0339', 'SS-113', 'C', 'P', 'BBA-3'),
('2020-12-17', '18F-2', 'SS-113', 'C', 'P', 'BBA-3'),
('2020-12-17', '18F-3', 'SS-113', 'C', 'P', 'BBA-3');

-- --------------------------------------------------------

--
-- Table structure for table `course_information`
--

DROP TABLE IF EXISTS `course_information`;
CREATE TABLE IF NOT EXISTS `course_information` (
  `ID` varchar(20) NOT NULL,
  `Name` varchar(50) NOT NULL,
  `Semester` int(11) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `course_information`
--

INSERT INTO `course_information` (`ID`, `Name`, `Semester`) VALUES
('CS-200', 'Programming Fundamentals', 1),
('EE-117', 'Applied Physics', 1),
('SS-113', 'Pakistan Studies', 1);

-- --------------------------------------------------------

--
-- Table structure for table `course_registration`
--

DROP TABLE IF EXISTS `course_registration`;
CREATE TABLE IF NOT EXISTS `course_registration` (
  `CID` varchar(20) NOT NULL,
  `SID` varchar(20) NOT NULL,
  `Section` varchar(20) NOT NULL,
  `TID` varchar(20) NOT NULL,
  `Stu_name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `course_registration`
--

INSERT INTO `course_registration` (`CID`, `SID`, `Section`, `TID`, `Stu_name`) VALUES
('CS-200', '18F-0339', 'A', 'CS-1', 'Ali'),
('SS-113', '18F-0339', 'C', 'BBA-3', 'Ali'),
('CS-200', '18F-2', 'A', 'CS-1', 'Asad'),
('EE-117', '18F-2', 'B', 'CS-2', 'Asad'),
('SS-113', '18F-2', 'C', 'BBA-3', 'Asad'),
('CS-200', '18F-3', 'A', 'CS-1', 'James'),
('EE-117', '18F-3', 'B', 'CS-2', 'James'),
('SS-113', '18F-3', 'C', 'BBA-3', 'James'),
('EE-117', '18F-0339', 'B', 'CS-2', 'Ali');

-- --------------------------------------------------------

--
-- Table structure for table `course_teacher`
--

DROP TABLE IF EXISTS `course_teacher`;
CREATE TABLE IF NOT EXISTS `course_teacher` (
  `CID` varchar(20) NOT NULL,
  `TID` varchar(20) NOT NULL,
  `section` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `course_teacher`
--

INSERT INTO `course_teacher` (`CID`, `TID`, `section`) VALUES
('CS-200', 'CS-1', 'A'),
('EE-117', 'CS-2', 'B'),
('SS-113', 'BBA-3', 'C'),
('SS-113', 'CS-2', 'A');

-- --------------------------------------------------------

--
-- Table structure for table `student_credentials`
--

DROP TABLE IF EXISTS `student_credentials`;
CREATE TABLE IF NOT EXISTS `student_credentials` (
  `ID` varchar(20) NOT NULL,
  `Password` int(50) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `student_credentials`
--

INSERT INTO `student_credentials` (`ID`, `Password`) VALUES
('18F-0339', 12345),
('18F-2', 12345);

-- --------------------------------------------------------

--
-- Table structure for table `student_information`
--

DROP TABLE IF EXISTS `student_information`;
CREATE TABLE IF NOT EXISTS `student_information` (
  `ID` varchar(20) NOT NULL,
  `Name` varchar(50) NOT NULL,
  `Father_Name` varchar(50) NOT NULL,
  `DOB` date NOT NULL,
  `Blood_Group` varchar(3) NOT NULL,
  `CNIC` int(20) NOT NULL,
  `Gender` varchar(10) NOT NULL,
  `Contact` int(14) NOT NULL,
  `Batch` int(20) NOT NULL,
  `Semester` int(20) NOT NULL,
  `Department` varchar(20) NOT NULL,
  `Degree` varchar(10) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `Registration` date NOT NULL,
  `Picture` varchar(200) NOT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `CNIC` (`CNIC`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `student_information`
--

INSERT INTO `student_information` (`ID`, `Name`, `Father_Name`, `DOB`, `Blood_Group`, `CNIC`, `Gender`, `Contact`, `Batch`, `Semester`, `Department`, `Degree`, `Email`, `Registration`, `Picture`) VALUES
('18F-0339', 'Ali', 'Zahid', '2000-02-22', 'A+', 1234567, 'Male', 1234567, 18, 1, 'CS', 'BS-SE', 'ali111zahid@gmail.com', '2020-12-18', '../GRAPHICS/user_pics/IMG_6832.JPG'),
('18F-2', 'Asad', 'Mehmood', '2020-12-19', 'A+', 12375543, 'Male', 7654321, 18, 1, 'BS', 'BS-CS', 'asad111mehmod@gmail.com', '2020-12-19', '../GRAPHICS/user_pics/1.PNG');

-- --------------------------------------------------------

--
-- Table structure for table `teacher_credentials`
--

DROP TABLE IF EXISTS `teacher_credentials`;
CREATE TABLE IF NOT EXISTS `teacher_credentials` (
  `ID` varchar(20) NOT NULL,
  `Password` varchar(50) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `teacher_credentials`
--

INSERT INTO `teacher_credentials` (`ID`, `Password`) VALUES
('BBA-3 ', '11096 '),
('CS-2', '54321'),
('CS-3 ', '25956 ');

-- --------------------------------------------------------

--
-- Table structure for table `teacher_information`
--

DROP TABLE IF EXISTS `teacher_information`;
CREATE TABLE IF NOT EXISTS `teacher_information` (
  `Name` varchar(50) NOT NULL,
  `Father_Name` varchar(50) NOT NULL,
  `DOB` date NOT NULL,
  `Blood_Group` varchar(3) NOT NULL,
  `CNIC` int(20) NOT NULL,
  `Gender` varchar(20) NOT NULL,
  `Contact` int(14) NOT NULL,
  `Department` varchar(50) NOT NULL,
  `Designation` varchar(50) NOT NULL,
  `Registration` date NOT NULL,
  `Email` varchar(50) NOT NULL,
  `Salary` int(11) NOT NULL,
  `Picture` varchar(200) NOT NULL,
  `ID` varchar(20) NOT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `CNIC` (`CNIC`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `teacher_information`
--

INSERT INTO `teacher_information` (`Name`, `Father_Name`, `DOB`, `Blood_Group`, `CNIC`, `Gender`, `Contact`, `Department`, `Designation`, `Registration`, `Email`, `Salary`, `Picture`, `ID`) VALUES
('John', 'Wick', '2020-12-19', 'A+', 342312, 'Male', 52524344, 'BBA', 'HOD', '2020-12-19', 'john.wick@gmail.com', 23423, '../GRAPHICS/user_pics/5.jpg', 'BBA-3'),
('Max', 'Miller', '2020-12-19', 'A+', 4253542, 'Male', 343545, 'CS', 'Professor', '2020-12-19', 'max.miller@gmail.com', 87689, '../GRAPHICS/user_pics/3.jpg', 'CS-2'),
('asad', 'khan', '2020-12-03', 'B+', 123456776, 'Male', 2147483647, 'CS', 'teacher', '2020-12-08', 'qwerty@gmail.com', 345642, '../GRAPHICS/user_pics/edit1.jpg', 'CS-3');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
