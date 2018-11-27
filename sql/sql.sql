-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 27, 2018 at 12:53 PM
-- Server version: 5.6.38
-- PHP Version: 7.2.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `lsl_application`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `ID` varchar(20) NOT NULL,
  `pass` varchar(15) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`ID`, `pass`, `name`, `email`) VALUES
('', '+5065565', 'LSL Help Center', 'lslhelpcenter.com'),
('1', '+1587455', 'Dinmukhammad Rakhimov', 'dinmuhammad.rahimov@mail.ru');

-- --------------------------------------------------------

--
-- Table structure for table `applicant`
--

CREATE TABLE `applicant` (
  `ID` int(11) NOT NULL,
  `pass` varchar(15) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `email_verf` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `applicant`
--

INSERT INTO `applicant` (`ID`, `pass`, `name`, `email`, `email_verf`) VALUES
(0, '+1587455', 'DeenMuhammad Rahimov', 'dinmuhammad.rahimov@mail.ru', 1),
(2, '122222', 'Tom Jerry', 'tom-jerry@mail.ru', 1),
(86, '123', ' Tokhirbek Ergashaliev', 'toxirbek.96@mail.ru', 1),
(89, '123', 'Yuldoshev Azizbek', 'yuldoshev_95@inbox.ru', 1),
(96, 'o3xwT9aR', 'Ibrohim Bahromov', 'hadus_bi@mail.ru', 1),
(97, '123', 'Bobur Kobulov', 'bobur0114@yahoo.com', NULL),
(98, '123', 'Sirojiddin Karimov', 'herodot.sk@mail.ru', 1),
(99, '123', 'Temurbek Jumaboev', 'ezrecruiter21@gmail.com', 1),
(100, '123', 'Deen Rakhimov', 'zorro199696@gmail.com', 1),
(101, '+5065565', 'Dinmukhammad Rakhimov', '123@mail.ru', NULL),
(103, 'IHWQsc35', 'Deen Mukhammad ', 'mrdonny1996@gmail.com', 1),
(104, '123', 'LSL Help Center', 'lslhelpcenter@gmail.com', 1);

-- --------------------------------------------------------

--
-- Stand-in structure for view `applicants_view`
-- (See below for the actual view)
--
CREATE TABLE `applicants_view` (
`name` varchar(100)
,`photo` varchar(200)
,`appl_course` varchar(20)
,`enr_course` varchar(20)
,`total_spent_amount` decimal(10,2)
);

-- --------------------------------------------------------

--
-- Table structure for table `applicant_photo`
--

CREATE TABLE `applicant_photo` (
  `ID` int(11) NOT NULL,
  `photo` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `applicant_photo`
--

INSERT INTO `applicant_photo` (`ID`, `photo`) VALUES
(0, '0deen.jpg'),
(86, '86fullsizeoutput_8.jpeg'),
(89, '89IMG_0672.JPG'),
(96, '96IMG_0441.JPG'),
(98, '98fullsizeoutput_8.jpeg'),
(99, '99IMG_0700.JPG'),
(100, '100IMG_0703.JPG'),
(104, '104LSL.png');

-- --------------------------------------------------------

--
-- Table structure for table `applied`
--

CREATE TABLE `applied` (
  `ID` int(11) DEFAULT NULL,
  `course_id` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `cancelled_applications`
--

CREATE TABLE `cancelled_applications` (
  `ID` int(11) DEFAULT NULL,
  `course_id` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cancelled_applications`
--

INSERT INTO `cancelled_applications` (`ID`, `course_id`) VALUES
(0, 'PHY-1'),
(0, 'ENG-1'),
(0, 'PHY-2'),
(0, 'MTH-2'),
(86, 'ENG-2'),
(0, 'PHY-1'),
(0, 'PHY-1');

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `course_id` varchar(20) NOT NULL,
  `title` varchar(50) DEFAULT NULL,
  `cost` decimal(10,2) DEFAULT NULL,
  `duration` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`course_id`, `title`, `cost`, `duration`) VALUES
('ACT-1', 'ACT 1', '300000.00', 30),
('ACT-2', 'ACT 2', '200000.00', 30),
('DTB', 'Database', '200000.00', 30),
('EILTS-W', 'IELTS Academic Writing', '200000.00', 30),
('ENG-1', 'English 1', '200000.00', 30),
('ENG-2', 'English 2', '250000.00', 30),
('ENG-3', 'English 3', '200000.00', 30),
('GMAT-1', 'GMAT 1', '300000.00', 30),
('MOT-1', 'Mother Tongue 1', '180000.00', 30),
('MTH-1', 'Math 1', '200000.00', 30),
('MTH-2', 'Math 2', '250000.00', 30),
('PHY-1', 'Physics 1', '200000.00', 30),
('PHY-2', 'Physics 2', '250000.00', 30),
('SAT-1', 'SAT 1', '300000.00', 30),
('UBK-1', 'Understanding Business 1', '200000.00', 40),
('UBK-2', 'Understanding Business 2', '250000.00', 40),
('UBK-3', 'Understanding Business 3', '300000.00', 40);

-- --------------------------------------------------------

--
-- Table structure for table `enrolled`
--

CREATE TABLE `enrolled` (
  `ID` int(11) DEFAULT NULL,
  `course_id` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `enrolled`
--

INSERT INTO `enrolled` (`ID`, `course_id`) VALUES
(89, 'PHY-1'),
(0, 'PHY-1'),
(0, 'ENG-1'),
(0, 'ENG-2'),
(0, 'UBK-1'),
(86, 'ENG-1'),
(100, 'ENG-1'),
(100, 'DTB'),
(0, 'UBK-2'),
(0, 'UBK-3'),
(0, 'ENG-3'),
(103, 'ENG-1');

-- --------------------------------------------------------

--
-- Table structure for table `mailing_list`
--

CREATE TABLE `mailing_list` (
  `ID` int(11) NOT NULL,
  `email` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mailing_list`
--

INSERT INTO `mailing_list` (`ID`, `email`) VALUES
(4, 'zorro199696@gmail.com'),
(6, 'lslhelpcenter@gmail.com'),
(7, 'dinmuhammad.rahimov@mail.ru');

-- --------------------------------------------------------

--
-- Table structure for table `messages_to_admin`
--

CREATE TABLE `messages_to_admin` (
  `message_ID` int(11) NOT NULL,
  `ID` int(11) DEFAULT NULL,
  `message` varchar(1000) DEFAULT NULL,
  `answer` varchar(1000) DEFAULT NULL,
  `subject` varchar(50) DEFAULT NULL,
  `seen` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `messages_to_admin`
--

INSERT INTO `messages_to_admin` (`message_ID`, `ID`, `message`, `answer`, `subject`, `seen`) VALUES
(87, 0, 'message 1', 'cxcvcv', 'About Course Registration', 1),
(88, 0, 'message 2', 'cxcvcv', 'About Course Registration', 1),
(89, 0, 'message 3', 'cxcvcv', 'About Course Registration', 1);

-- --------------------------------------------------------

--
-- Table structure for table `results`
--

CREATE TABLE `results` (
  `ID` int(11) NOT NULL,
  `course_id` varchar(20) DEFAULT NULL,
  `result` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `spent`
--

CREATE TABLE `spent` (
  `ID` int(11) DEFAULT NULL,
  `total_spent_amount` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `spent`
--

INSERT INTO `spent` (`ID`, `total_spent_amount`) VALUES
(89, '200000.00'),
(0, '1600000.00'),
(86, '200000.00'),
(100, '400000.00'),
(103, '200000.00');

-- --------------------------------------------------------

--
-- Table structure for table `teachers`
--

CREATE TABLE `teachers` (
  `ID` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `contact` varchar(100) DEFAULT NULL,
  `photo` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `teachers`
--

INSERT INTO `teachers` (`ID`, `name`, `contact`, `photo`) VALUES
(1, 'Anvarjon Urinov', 'urinov@mail.ru', 'anvarjon_urinov.png'),
(2, 'Umarkhon Bobokhujaev', 'bobokhujaev@mail.ru', 'umarkhon_bobokhujaev.png'),
(3, 'Otamirza Domla', 'otamirza@mail.ru', NULL),
(4, 'Osiyo Oya', 'osiyo@mail.ru', 'osiyo_oya.png'),
(6, 'Md. Jalil Piran', 'piran@sejong.ac.kr', 'jalilpiran.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `teacher_info`
--

CREATE TABLE `teacher_info` (
  `ID` int(11) NOT NULL,
  `about` varchar(1000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `teacher_info`
--

INSERT INTO `teacher_info` (`ID`, `about`) VALUES
(1, 'He is the CEO of LSL Education. He has been teaching Engilsh for 15 years. Which is very speacial about him is that most of his students have studied abroad. He personally likes to teach students in a friendly manner. He likes to play football with his students from time to time! This makes his courses extra interesting!'),
(2, 'Phd. Umarkhon Bobokhujaev is the VP of LSL Education. He has been teaching Physics for 30 years. Which is very speacial about him is that most of his students have become leaders of Engineering field. He personally likes to teach students in a friendly manner.He is very strict when he teaches which is positive for students who can not improve in a loose classroom!'),
(3, 'He is the Mathematics teacher of LSL Education. He has been teaching Math for almpst 20 years. Which is very speacial about him is that most of his students have studied abroad. He personally likes to teach students in a friendly manner. He likes to play football with his students from time to time! This makes his courses extra interesting!'),
(4, 'Osiyo Oya is LSL Mother Tongue teacher. She has been teaching Uzbek Language and Uzbek Litrature for 25 years. Her creeer peak has been achieved when she was teaching at Academic Lyceum under Namangan State University. She still teaches in that academic lyceum! Personally she likes to become friends with her students while she is teaching!'),
(6, 'Dr Jalil Piran is an Ass. Professor at Sejong University, Seoul. He is also an active member of IEEE committee since 2013. He has graduated his PhD from Kyung Hee University. ');

-- --------------------------------------------------------

--
-- Table structure for table `teaches`
--

CREATE TABLE `teaches` (
  `ID` int(11) DEFAULT NULL,
  `course_id` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `teaches`
--

INSERT INTO `teaches` (`ID`, `course_id`) VALUES
(1, 'ENG-1'),
(1, 'ENG-2'),
(2, 'PHY-1'),
(2, 'PHY-2'),
(3, 'MTH-1'),
(3, 'MTH-2'),
(4, 'MOT-1'),
(3, 'UBK-1'),
(1, 'UBK-2'),
(3, 'SAT-1'),
(2, 'ACT-1'),
(1, 'GMAT-1'),
(6, 'DTB'),
(1, 'ENG-3'),
(1, 'EILTS-W'),
(1, 'UBK-3'),
(3, 'ACT-2');

-- --------------------------------------------------------

--
-- Structure for view `applicants_view`
--
DROP TABLE IF EXISTS `applicants_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `applicants_view`  AS  (select `applicant`.`name` AS `name`,`applicant_photo`.`photo` AS `photo`,`applied`.`course_id` AS `appl_course`,`applied`.`course_id` AS `enr_course`,`spent`.`total_spent_amount` AS `total_spent_amount` from ((((`applicant` left join `applicant_photo` on((`applicant`.`ID` = `applicant_photo`.`ID`))) left join `applied` on((`applicant`.`ID` = `applied`.`ID`))) left join `enrolled` on(((`applicant`.`ID` = `enrolled`.`ID`) and (`applied`.`course_id` = `enrolled`.`course_id`)))) left join `spent` on((`applicant`.`ID` = `spent`.`ID`)))) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `applicant`
--
ALTER TABLE `applicant`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `applicant_photo`
--
ALTER TABLE `applicant_photo`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `applied`
--
ALTER TABLE `applied`
  ADD KEY `ID` (`ID`),
  ADD KEY `course_id` (`course_id`);

--
-- Indexes for table `cancelled_applications`
--
ALTER TABLE `cancelled_applications`
  ADD KEY `ID` (`ID`),
  ADD KEY `course_id` (`course_id`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`course_id`);

--
-- Indexes for table `enrolled`
--
ALTER TABLE `enrolled`
  ADD KEY `ID` (`ID`),
  ADD KEY `course_id` (`course_id`);

--
-- Indexes for table `mailing_list`
--
ALTER TABLE `mailing_list`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `messages_to_admin`
--
ALTER TABLE `messages_to_admin`
  ADD PRIMARY KEY (`message_ID`),
  ADD KEY `ID` (`ID`);

--
-- Indexes for table `results`
--
ALTER TABLE `results`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `course_id` (`course_id`);

--
-- Indexes for table `spent`
--
ALTER TABLE `spent`
  ADD KEY `ID` (`ID`);

--
-- Indexes for table `teachers`
--
ALTER TABLE `teachers`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `teacher_info`
--
ALTER TABLE `teacher_info`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `teaches`
--
ALTER TABLE `teaches`
  ADD KEY `ID` (`ID`),
  ADD KEY `course_id` (`course_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `mailing_list`
--
ALTER TABLE `mailing_list`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `messages_to_admin`
--
ALTER TABLE `messages_to_admin`
  MODIFY `message_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=90;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `applicant_photo`
--
ALTER TABLE `applicant_photo`
  ADD CONSTRAINT `applicant_photo_ibfk_1` FOREIGN KEY (`ID`) REFERENCES `applicant` (`ID`);

--
-- Constraints for table `applied`
--
ALTER TABLE `applied`
  ADD CONSTRAINT `applied_ibfk_1` FOREIGN KEY (`ID`) REFERENCES `applicant` (`ID`),
  ADD CONSTRAINT `applied_ibfk_2` FOREIGN KEY (`course_id`) REFERENCES `courses` (`course_id`);

--
-- Constraints for table `cancelled_applications`
--
ALTER TABLE `cancelled_applications`
  ADD CONSTRAINT `cancelled_applications_ibfk_1` FOREIGN KEY (`ID`) REFERENCES `applicant` (`ID`),
  ADD CONSTRAINT `cancelled_applications_ibfk_2` FOREIGN KEY (`course_id`) REFERENCES `courses` (`course_id`);

--
-- Constraints for table `enrolled`
--
ALTER TABLE `enrolled`
  ADD CONSTRAINT `enrolled_ibfk_1` FOREIGN KEY (`ID`) REFERENCES `applicant` (`ID`),
  ADD CONSTRAINT `enrolled_ibfk_2` FOREIGN KEY (`course_id`) REFERENCES `courses` (`course_id`);

--
-- Constraints for table `messages_to_admin`
--
ALTER TABLE `messages_to_admin`
  ADD CONSTRAINT `messages_to_admin_ibfk_1` FOREIGN KEY (`ID`) REFERENCES `applicant` (`ID`);

--
-- Constraints for table `results`
--
ALTER TABLE `results`
  ADD CONSTRAINT `results_ibfk_1` FOREIGN KEY (`course_id`) REFERENCES `courses` (`course_id`),
  ADD CONSTRAINT `results_ibfk_2` FOREIGN KEY (`ID`) REFERENCES `applicant` (`ID`),
  ADD CONSTRAINT `results_ibfk_3` FOREIGN KEY (`ID`) REFERENCES `teachers` (`ID`);

--
-- Constraints for table `spent`
--
ALTER TABLE `spent`
  ADD CONSTRAINT `spent_ibfk_1` FOREIGN KEY (`ID`) REFERENCES `applicant` (`ID`);

--
-- Constraints for table `teacher_info`
--
ALTER TABLE `teacher_info`
  ADD CONSTRAINT `teacher_info_ibfk_1` FOREIGN KEY (`ID`) REFERENCES `teachers` (`ID`);

--
-- Constraints for table `teaches`
--
ALTER TABLE `teaches`
  ADD CONSTRAINT `teaches_ibfk_1` FOREIGN KEY (`course_id`) REFERENCES `courses` (`course_id`),
  ADD CONSTRAINT `teaches_ibfk_2` FOREIGN KEY (`ID`) REFERENCES `teachers` (`ID`),
  ADD CONSTRAINT `teaches_ibfk_3` FOREIGN KEY (`course_id`) REFERENCES `courses` (`course_id`);
