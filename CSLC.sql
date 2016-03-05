-- phpMyAdmin SQL Dump
-- version 4.4.10
-- http://www.phpmyadmin.net
--
-- Host: localhost:3306
-- Generation Time: Mar 01, 2016 at 11:50 PM
-- Server version: 5.5.42
-- PHP Version: 5.6.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `CSLc_Tutoring_System`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `admin_id` char(8) COLLATE latin1_general_ci NOT NULL,
  `FirstName` varchar(45) COLLATE latin1_general_ci NOT NULL,
  `LastName` varchar(45) COLLATE latin1_general_ci NOT NULL,
  `email` varchar(120) COLLATE latin1_general_ci NOT NULL,
  `phone` varchar(15) COLLATE latin1_general_ci NOT NULL,
  `LastLogin` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `get_hash` varchar(256) COLLATE latin1_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`admin_id`, `FirstName`, `LastName`, `email`, `phone`, `LastLogin`, `get_hash`) VALUES
('a1065958', 'Brad', 'Alexander', 'yjf85821667@126.com', '', '2016-02-12 10:56:36', '$1$Wr9hi1sf$0hFoM1ikIr4d8k.wJeYrg0'),
('a1066092', 'Cheryl', 'Pope', 'yjf85821667@126.com', '', '2016-02-12 10:56:42', '$1$SN2MOXOR$Iiqb8d/i6gOvQA45lH.O51'),
('a1620009', 'mathi', 'Sankarkumar', 'yjf85821667@126.com', '', '2016-02-12 10:56:55', '$1$dwqR6QHL$kQN.mJskqwwWtc6msh5cN.');

-- --------------------------------------------------------

--
-- Table structure for table `applicant_language`
--

CREATE TABLE `applicant_language` (
  `Applicant_Id` int(11) NOT NULL,
  `tutor_Id` char(8) COLLATE latin1_general_ci NOT NULL,
  `language` varchar(45) COLLATE latin1_general_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=304 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `applicant_language`
--

INSERT INTO `applicant_language` (`Applicant_Id`, `tutor_Id`, `language`) VALUES
(280, 'a1620009', 'C'),
(281, 'a1620009', 'Câœšâœš'),
(282, 'a1620009', 'Matlab'),
(303, 'a1641575', 'Laravel');

-- --------------------------------------------------------

--
-- Table structure for table `attendees`
--

CREATE TABLE `attendees` (
  `ID` int(11) NOT NULL,
  `student_Id` char(8) COLLATE latin1_general_ci NOT NULL,
  `book_Id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `available_time`
--

CREATE TABLE `available_time` (
  `id` int(11) unsigned NOT NULL,
  `tutor_Id` char(8) COLLATE latin1_general_ci NOT NULL,
  `mon` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `tue` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `wed` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `thu` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `fri` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `week_Id` set('1','2','3','4','5','6','7','8','9','10','11','12') COLLATE latin1_general_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=50 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `available_time`
--

INSERT INTO `available_time` (`id`, `tutor_Id`, `mon`, `tue`, `wed`, `thu`, `fri`, `week_Id`) VALUES
(38, 'a1643178', '11.00,11.30,2.00,2.30', '', '12.00,12.30,1.00,1.30,2.00,2.30,3.00,3.30', '', '10.00,10.30,11.00,11.30,12.00,12.30,3.00,3.30,4.00,4.30', ''),
(39, 'a1631060', '10.00,10.30,11.00,11.30,12.00,12.30,3.00,3.30', '11.00,11.30,12.00,12.30,1.00,1.30,2.00,2.30,3.00,3.30,4.00,4.30', '2.00,2.30,3.00,3.30,4.00,4.30', '12.00,12.30,1.00,1.30', '12.00,12.30,3.00,3.30,4.00,4.30', ''),
(49, 'a1641575', '', '', '', '11.30,12.00', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `booking-history`
--

CREATE TABLE `booking-history` (
  `history_Id` int(11) NOT NULL,
  `book_Id` int(11) NOT NULL,
  `stud_f_name` varchar(45) COLLATE latin1_general_ci NOT NULL,
  `stud_L_name` varchar(45) COLLATE latin1_general_ci DEFAULT NULL,
  `Studemail` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `Studmobile` varchar(10) COLLATE latin1_general_ci NOT NULL,
  `language` varchar(45) COLLATE latin1_general_ci NOT NULL,
  `Time` datetime DEFAULT NULL,
  `other_class` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `topic` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `place` varchar(45) COLLATE latin1_general_ci DEFAULT NULL,
  `class` varchar(60) COLLATE latin1_general_ci DEFAULT NULL,
  `comments` varchar(125) COLLATE latin1_general_ci DEFAULT NULL,
  `tutor_Id` char(8) COLLATE latin1_general_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=190 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `booking-history`
--

INSERT INTO `booking-history` (`history_Id`, `book_Id`, `stud_f_name`, `stud_L_name`, `Studemail`, `Studmobile`, `language`, `Time`, `other_class`, `topic`, `place`, `class`, `comments`, `tutor_Id`) VALUES
(93, 0, 'Hawraa', 'Abumustafa', 'a1686578@student.adeliade.edu.au', '0420508977', 'Câœšâœš', '2015-08-03 00:00:00', '', '', 'EM110', 'Object Oriented Programming', '', 'a1643178'),
(94, 0, 'Nick', 'Blewett', 'blewett@hotmail.com.au', '0428774022', 'SVN', '2015-08-03 00:00:00', '', 'SVN', 'EM110', 'Object Oriented Programming', '', 'a1643178'),
(112, 0, 'Tin', 'Do', 'tindo8@gmail.com', '0434817164', 'Java', '2015-08-17 00:00:00', '', 'Java Basics', 'EM110', 'Algorithm Design and Data Structure', '', 'a1643178'),
(159, 0, 'han', 'li', 'a1215118@student.adelaide.edu.au', '0410746739', 'Câœšâœš', '2015-10-05 00:00:00', '', '', 'x', 'Foundation of Computer Science', '', 'a1631060'),
(171, 0, 'yajie', 'xu', '728987279@qq.com', '0405585996', 'Câœšâœš', '2015-10-20 00:00:00', '', '', 'EM110', 'Algorithm Design and Data Structure', '', 'a1631060'),
(172, 0, 'hoa', 'truong', 'a1683931@student.adelaide.edu.au', '0401717677', 'C', '2015-10-22 00:00:00', '', '', 'EM110', 'Introduction to Programming for Engineers', '', 'a1631060'),
(173, 0, 'Pranjal', 'Chowdhury', 'pranjal.chowdhury@student.adelaide.edu.au', '0470139383', 'Câœšâœš', '2015-10-19 00:00:00', '', 'practical', 'EM110', 'Algorithm Design and Data Structure', '', 'a1643178'),
(189, 0, 'XIZI', 'CHEN', 'yjf85821667@126.com', '1111111', 'Laravel', '0000-00-00 00:00:00', '', '', '', 'Foundation of Computer Science', '', 'a1641575');

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `corse_Id` varchar(45) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `get_hash` varchar(256) COLLATE latin1_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`corse_Id`, `get_hash`) VALUES
('Foundation of Computer Science', '$1$oZ9oG6Vh$9aSdQAeQptVxxKl.7bUr4/'),
('Object Oriented Programming', '$1$fLH6JU6r$s4ubno9fQF9GCCY3uh9PV.'),
('Algorithm Design and Data Structure', '$1$S/yHVpTJ$KqCzSRj16fIo9cJ.4UGgm1'),
('Introduction to Programming', '$1$TQbJgN0S$c7oFvsRF5m/aKqJxDFO6//'),
('Scientific Computing', '$1$wNLsxBf6$R13vUZFcamj16QT4IBZh.0'),
('Introduction to Programming for Engineers', '$1$tHtjufCI$vAv9Fqo2DPZaZl50QtV7l0'),
('Web and Database Computing', '$1$WurIH6Sw$/CH0niBsvV8hNB0P.Oz7i.'),
('Others', '$1$5/duG7yB$KuQY.3rMa9cf.uEMPpNmN.'),
('Computer System', '$1$dmoFuWeE$NrXK/Fq4ahR43iutNOIDy.');

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `event_Id` int(11) NOT NULL,
  `StudFname` varchar(30) COLLATE latin1_general_ci NOT NULL,
  `StudLname` varchar(30) COLLATE latin1_general_ci NOT NULL,
  `Studemail` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `Studmobile` varchar(10) COLLATE latin1_general_ci NOT NULL,
  `date_time1` text COLLATE latin1_general_ci,
  `other_class` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `topic` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `location` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `class` varchar(60) COLLATE latin1_general_ci DEFAULT NULL,
  `language` varchar(45) COLLATE latin1_general_ci DEFAULT NULL,
  `tutor_Id` char(8) COLLATE latin1_general_ci DEFAULT NULL,
  `comments` varchar(125) COLLATE latin1_general_ci DEFAULT NULL,
  `tutorId` char(8) COLLATE latin1_general_ci NOT NULL,
  `dismiss` enum('Yes','No') COLLATE latin1_general_ci NOT NULL DEFAULT 'No',
  `get_hash` varchar(256) COLLATE latin1_general_ci NOT NULL,
  `student_id` char(8) COLLATE latin1_general_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=249 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`event_Id`, `StudFname`, `StudLname`, `Studemail`, `Studmobile`, `date_time1`, `other_class`, `topic`, `location`, `class`, `language`, `tutor_Id`, `comments`, `tutorId`, `dismiss`, `get_hash`, `student_id`) VALUES
(246, 'XIZI', 'CHEN', 'yjf85821667@126.com', '11111', '18/02/2016Thu12.00', '', '', '', 'Foundation of Computer Science', 'Laravel', 'a1641575', '', '', 'No', '$1$EOATW3rB$u39WkeRCKeqUGxZeQOo8P.', ''),
(247, 'laolao', 'liu', 'yjf85821667@126.com', '11111', '18/02/2016Thu11.30', '', '', '', 'Foundation of Computer Science', 'Laravel', 'a1641575', NULL, '', 'No', '$1$RvJj9JoR$UJueiC7PsLlmxsD380j2i/', ''),
(248, 'XIZI', 'Yang', 'yjf85821667@126.com', '11111', '18/02/2016Thu11.30', '', '', '', 'Foundation of Computer Science', 'Laravel', 'a1641575', NULL, '', 'No', '$1$o1HPVK6t$XDAVshnwC9ZK64os3P6HI1', '');

-- --------------------------------------------------------

--
-- Table structure for table `files`
--

CREATE TABLE `files` (
  `file_Id` int(10) unsigned NOT NULL,
  `tutor_Id` char(8) COLLATE latin1_general_ci NOT NULL,
  `link` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `catagory` enum('resume','image') COLLATE latin1_general_ci NOT NULL,
  `type` varchar(45) COLLATE latin1_general_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2132347899 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `files`
--

INSERT INTO `files` (`file_Id`, `tutor_Id`, `link`, `catagory`, `type`) VALUES
(167818064, 'a1643178', 'resumes/55a21e076a698.pdf', 'resume', 'pdf'),
(336676491, 'a1675754', 'resumes/559ca4df72367.pdf', 'resume', 'pdf'),
(1213251266, 'a1631060', 'resumes/55a30ee55f7ca.pdf', 'resume', 'pdf'),
(1872156076, 'a1641575', '../resumes/56c18acfc087c.pdf', 'resume', 'pdf'),
(2132347893, 'a1643178', 'tutors_images/a1643178.jpeg', 'image', 'jpeg'),
(2132347898, 'a1641575', '../tutors_images/a1641575.jpeg', 'image', 'jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `hours`
--

CREATE TABLE `hours` (
  `hours_Id` int(11) NOT NULL,
  `total_H` int(11) NOT NULL DEFAULT '0',
  `h_Left` int(11) NOT NULL DEFAULT '0',
  `h_Used` int(11) NOT NULL DEFAULT '0',
  `h_claimed` int(11) NOT NULL DEFAULT '0',
  `h_unclaimed` int(11) NOT NULL DEFAULT '0',
  `tutor_Id` char(8) COLLATE latin1_general_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `hours`
--

INSERT INTO `hours` (`hours_Id`, `total_H`, `h_Left`, `h_Used`, `h_claimed`, `h_unclaimed`, `tutor_Id`) VALUES
(36, 0, 0, 0, 0, 0, 'a1643178'),
(37, 10, 10, 0, 0, 0, 'a1631060'),
(41, 0, 0, 0, 0, 0, 'a1675754'),
(45, 10, 9, 1, 0, 1, 'a1641575');

-- --------------------------------------------------------

--
-- Table structure for table `job-booked`
--

CREATE TABLE `job-booked` (
  `book_Id` int(11) NOT NULL,
  `event_Id` int(11) NOT NULL,
  `stud_f_name` varchar(45) COLLATE latin1_general_ci NOT NULL,
  `stud_L_name` varchar(45) COLLATE latin1_general_ci DEFAULT NULL,
  `Studemail` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `Studmobile` varchar(10) COLLATE latin1_general_ci NOT NULL,
  `language` varchar(45) COLLATE latin1_general_ci NOT NULL,
  `Time` text COLLATE latin1_general_ci,
  `other_class` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `topic` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `place` varchar(45) COLLATE latin1_general_ci DEFAULT NULL,
  `class` varchar(60) COLLATE latin1_general_ci DEFAULT NULL,
  `comments` varchar(125) COLLATE latin1_general_ci DEFAULT NULL,
  `tutor_Id` char(8) COLLATE latin1_general_ci NOT NULL,
  `get_hash` varchar(256) COLLATE latin1_general_ci NOT NULL,
  `attendees` int(2) NOT NULL DEFAULT '1',
  `time_stamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Stand-in structure for view `job-bookings`
--
CREATE TABLE `job-bookings` (
`language` varchar(45)
,`Time` text
,`topic` varchar(100)
,`place` varchar(45)
,`attendees` int(2)
,`time_stamp` timestamp
,`book_Id` int(11)
,`FirstName` varchar(45)
,`LastName` varchar(45)
);

-- --------------------------------------------------------

--
-- Table structure for table `languages`
--

CREATE TABLE `languages` (
  `language` varchar(45) COLLATE latin1_general_ci NOT NULL,
  `get_hash` varchar(256) COLLATE latin1_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `languages`
--

INSERT INTO `languages` (`language`, `get_hash`) VALUES
(' MySQL', '$1$YZ2NLT3n$3iuGmF6uuTFTgrw1nvE10/'),
('AngularJS', '$1$G1.1atjz$K9nsQOrF7GXovog6peBa/.'),
('C', '$1$8c9z1xBi$nJqkv48b4YKY16OzEJlP9.'),
('Câ™¯', ''),
('Câœšâœš', ''),
('DLX', '$1$Cjttbaq4$hFVpS6sgsBy9SkXWA7l6u/'),
('Hibernate', '$1$ocUetDFh$BMa1DEdAzJsDS5JsYDhAJ/'),
('HTML/CSS/XML', '$1$nqfjSeWz$kTBPDfMzqmTea2U/d7Pv7.'),
('Java', 'asdasd'),
('Javascript', '$1$qEwZXRlh$BwFC7ykEcYWVrG0JVmCc//'),
('jQuery_UI', '$1$9T03GpWs$qcOJUaZ4kMDkq8woHekoY/'),
('Laravel', '$1$eNyrJl3n$FOxkJFNqFZOgGH6xAwHVr/'),
('Lua', '$1$cHW77DYN$RU4r2tOxlX90ZyDJzi0yv/'),
('Matlab', '$1$fChUyD7P$BeYXnj3qnLAgpRe8NBRpr1'),
('Network', '$1$mH0lYUs5$/ZUWioDDU01SqXwn5X0/n1'),
('Objective-C', '$1$r.WCorJJ$oUW6uBe06oKZKliPaJ7bw0'),
('PHP', '$1$B5g0Al.B$VTpuXE6BSknnYVMFumxOR0'),
('Python', '$1$nni.p.fM$FqlGOyyuVwpwVcGsE25Zi0'),
('Shell_Script', '$1$wbXdk3OG$afYgF5WMeaxaGSOZIoISH/'),
('spring', '$1$9O/jwUjo$pD63cPpLX5e0AWE/7bEIK/'),
('SQL', '$1$oVpPdYmH$1mWQoj0B.28IsHxxkIllZ1'),
('SVN', '$1$P35F3Odq$IP4/JqfiS9cKdtDmAEnbN0'),
('Swift', '$1$IzJPr.Et$dlycORPpHwTNjtTwBnXJq/'),
('Unix', '$1$hz5Q/DTm$p691qkUezf5kyvgPZ.Ec2.'),
('wordpress', '$1$4N4ON5l4$ZVgyll94yH.tXbX/oz0PN0');

-- --------------------------------------------------------

--
-- Stand-in structure for view `language_view`
--
CREATE TABLE `language_view` (
`tutor_Id` char(8)
,`lang` text
,`FirstName` varchar(45)
,`LastName` varchar(45)
,`email` varchar(120)
,`phone` varchar(15)
,`status` enum('Enabled','Disabled')
,`hash` varchar(256)
,`hired` enum('Yes','No')
);

-- --------------------------------------------------------

--
-- Table structure for table `logins`
--

CREATE TABLE `logins` (
  `log_Id` int(11) NOT NULL,
  `ID` char(8) COLLATE latin1_general_ci NOT NULL,
  `type` enum('admin','tutor') COLLATE latin1_general_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=852 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `logins`
--

INSERT INTO `logins` (`log_Id`, `ID`, `type`) VALUES
(816, 'a1643178', 'tutor'),
(817, 'a1631060', 'tutor'),
(820, 'a1066092', 'admin'),
(821, 'a1620009', 'admin'),
(825, 'a1065958', 'admin'),
(826, 'a1675754', 'tutor'),
(851, 'a1641575', 'tutor');

-- --------------------------------------------------------

--
-- Stand-in structure for view `resume_links`
--
CREATE TABLE `resume_links` (
`tutor_Id` char(8)
,`link` varchar(50)
);

-- --------------------------------------------------------

--
-- Table structure for table `semesterhours`
--

CREATE TABLE `semesterhours` (
  `semester_hour` int(11) NOT NULL,
  `hours_left` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `semesterhours`
--

INSERT INTO `semesterhours` (`semester_hour`, `hours_left`) VALUES
(120, 100);

-- --------------------------------------------------------

--
-- Table structure for table `student_management`
--

CREATE TABLE `student_management` (
  `student_Id` char(8) COLLATE latin1_general_ci NOT NULL,
  `first_name` varchar(45) COLLATE latin1_general_ci NOT NULL,
  `last_name` varchar(45) COLLATE latin1_general_ci NOT NULL,
  `allowance` int(2) NOT NULL DEFAULT '2',
  `used` int(2) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `teaching`
--

CREATE TABLE `teaching` (
  `teach_Id` int(11) NOT NULL,
  `tutor_Id` char(8) COLLATE latin1_general_ci DEFAULT NULL,
  `language` varchar(45) COLLATE latin1_general_ci DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=704 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `teaching`
--

INSERT INTO `teaching` (`teach_Id`, `tutor_Id`, `language`) VALUES
(453, 'a1631060', 'C'),
(454, 'a1631060', 'Câœšâœš'),
(455, 'a1631060', 'DLX'),
(456, 'a1631060', 'HTML/CSS/XML'),
(458, 'a1631060', 'PHP'),
(459, 'a1631060', 'Python'),
(460, 'a1631060', 'Unix'),
(503, 'a1643178', 'C'),
(504, 'a1643178', 'Câœšâœš'),
(505, 'a1643178', 'DLX'),
(506, 'a1643178', 'Java'),
(507, 'a1643178', 'Python'),
(508, 'a1643178', 'Shell_Script'),
(509, 'a1643178', 'SVN'),
(510, 'a1643178', 'Unix'),
(699, 'a1675754', 'Network'),
(700, 'a1675754', 'Java'),
(701, 'a1675754', 'Python'),
(702, 'a1675754', 'Laravel'),
(703, 'a1675754', 'HTML/CSS/XML');

-- --------------------------------------------------------

--
-- Table structure for table `tutors`
--

CREATE TABLE `tutors` (
  `tutor_Id` char(8) COLLATE latin1_general_ci NOT NULL,
  `FirstName` varchar(45) COLLATE latin1_general_ci NOT NULL,
  `LastName` varchar(45) COLLATE latin1_general_ci NOT NULL,
  `email` varchar(120) COLLATE latin1_general_ci NOT NULL,
  `phone` varchar(15) COLLATE latin1_general_ci NOT NULL,
  `status` enum('Enabled','Disabled') COLLATE latin1_general_ci NOT NULL DEFAULT 'Enabled',
  `hired` enum('Yes','No') COLLATE latin1_general_ci NOT NULL DEFAULT 'No',
  `get_hash` varchar(256) COLLATE latin1_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `tutors`
--

INSERT INTO `tutors` (`tutor_Id`, `FirstName`, `LastName`, `email`, `phone`, `status`, `hired`, `get_hash`) VALUES
('a1620009', 'Rengamathi', 'Sankarkumar', 'rengamathi.sankarkumar@adelaide.edu.au', '0413663012', 'Enabled', 'No', '$1$/oy5J8te$0FYB6kt.Qem.MGaBw1h8N0'),
('a1631060', 'Taran', 'Furnell', 'a1631060@student.adelaide.edu.au', '0407975997', 'Enabled', 'Yes', '$1$hw/PUT18$PsS9U7nL3Aq/ZlP.l/23H1'),
('a1641575', 'Jiefu', 'Yang', 'yjf85821667@126.com', '12345', 'Enabled', 'Yes', '$1$XxamtV25$SLd9VZIERjqDDrdaUrlOJ.'),
('a1643178', 'Katrina', 'Le', 'maikhanh.le@student.adelaide.edu.au', '0423411978', 'Enabled', 'Yes', '$1$vTYiFf28$N16jWWHDEIuPPRnDdanP2/'),
('a1675754', 'Minming', 'Qian', 'yjf85821667@126.com', '0416333851', 'Enabled', 'Yes', '$1$ix3.vU.s$EafLMP1mn/6WB94qivY8V/');

-- --------------------------------------------------------

--
-- Stand-in structure for view `tut_per_language`
--
CREATE TABLE `tut_per_language` (
`COUNT` bigint(21)
,`language` varchar(45)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `unhired`
--
CREATE TABLE `unhired` (
`tutor_Id` char(8)
,`lang` text
,`FirstName` varchar(45)
,`LastName` varchar(45)
,`email` varchar(120)
,`phone` varchar(15)
,`status` enum('Enabled','Disabled')
,`hired` enum('Yes','No')
,`link` varchar(50)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `unhired_language_view`
--
CREATE TABLE `unhired_language_view` (
`tutor_Id` char(8)
,`lang` text
,`FirstName` varchar(45)
,`LastName` varchar(45)
,`email` varchar(120)
,`phone` varchar(15)
,`status` enum('Enabled','Disabled')
,`hash` varchar(256)
,`hired` enum('Yes','No')
,`link` varchar(50)
);

-- --------------------------------------------------------

--
-- Structure for view `job-bookings`
--
DROP TABLE IF EXISTS `job-bookings`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `cslc_tutoring_system`.`job-bookings` AS select `cslc_tutoring_system`.`job-booked`.`language` AS `language`,`cslc_tutoring_system`.`job-booked`.`Time` AS `Time`,`cslc_tutoring_system`.`job-booked`.`topic` AS `topic`,`cslc_tutoring_system`.`job-booked`.`place` AS `place`,`cslc_tutoring_system`.`job-booked`.`attendees` AS `attendees`,`cslc_tutoring_system`.`job-booked`.`time_stamp` AS `time_stamp`,`cslc_tutoring_system`.`job-booked`.`book_Id` AS `book_Id`,`cslc_tutoring_system`.`tutors`.`FirstName` AS `FirstName`,`cslc_tutoring_system`.`tutors`.`LastName` AS `LastName` from (`cslc_tutoring_system`.`tutors` join `cslc_tutoring_system`.`job-booked`) where (`cslc_tutoring_system`.`tutors`.`tutor_Id` = `cslc_tutoring_system`.`job-booked`.`tutor_Id`);

-- --------------------------------------------------------

--
-- Structure for view `language_view`
--
DROP TABLE IF EXISTS `language_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `cslc_tutoring_system`.`language_view` AS select distinct `cslc_tutoring_system`.`teaching`.`tutor_Id` AS `tutor_Id`,group_concat(distinct `cslc_tutoring_system`.`teaching`.`language` separator ',') AS `lang`,`cslc_tutoring_system`.`tutors`.`FirstName` AS `FirstName`,`cslc_tutoring_system`.`tutors`.`LastName` AS `LastName`,`cslc_tutoring_system`.`tutors`.`email` AS `email`,`cslc_tutoring_system`.`tutors`.`phone` AS `phone`,`cslc_tutoring_system`.`tutors`.`status` AS `status`,`cslc_tutoring_system`.`tutors`.`get_hash` AS `hash`,`cslc_tutoring_system`.`tutors`.`hired` AS `hired` from (`cslc_tutoring_system`.`teaching` join `cslc_tutoring_system`.`tutors` on((`cslc_tutoring_system`.`tutors`.`tutor_Id` = `cslc_tutoring_system`.`teaching`.`tutor_Id`))) group by `cslc_tutoring_system`.`teaching`.`tutor_Id` order by `cslc_tutoring_system`.`teaching`.`tutor_Id`;

-- --------------------------------------------------------

--
-- Structure for view `resume_links`
--
DROP TABLE IF EXISTS `resume_links`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `cslc_tutoring_system`.`resume_links` AS select distinct `cslc_tutoring_system`.`files`.`tutor_Id` AS `tutor_Id`,`cslc_tutoring_system`.`files`.`link` AS `link` from `cslc_tutoring_system`.`files` where (`cslc_tutoring_system`.`files`.`catagory` = 'resume');

-- --------------------------------------------------------

--
-- Structure for view `tut_per_language`
--
DROP TABLE IF EXISTS `tut_per_language`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `cslc_tutoring_system`.`tut_per_language` AS select count(`cslc_tutoring_system`.`teaching`.`tutor_Id`) AS `COUNT`,`cslc_tutoring_system`.`languages`.`language` AS `language` from (`cslc_tutoring_system`.`languages` left join `cslc_tutoring_system`.`teaching` on((`cslc_tutoring_system`.`teaching`.`language` = `cslc_tutoring_system`.`languages`.`language`))) group by `cslc_tutoring_system`.`languages`.`language` order by count(`cslc_tutoring_system`.`teaching`.`tutor_Id`) desc;

-- --------------------------------------------------------

--
-- Structure for view `unhired`
--
DROP TABLE IF EXISTS `unhired`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `cslc_tutoring_system`.`unhired` AS select `language_view`.`tutor_Id` AS `tutor_Id`,`language_view`.`lang` AS `lang`,`language_view`.`FirstName` AS `FirstName`,`language_view`.`LastName` AS `LastName`,`language_view`.`email` AS `email`,`language_view`.`phone` AS `phone`,`language_view`.`status` AS `status`,`language_view`.`hired` AS `hired`,`resume_links`.`link` AS `link` from (`cslc_tutoring_system`.`language_view` join `cslc_tutoring_system`.`resume_links` on((`language_view`.`tutor_Id` = `resume_links`.`tutor_Id`))) where (`language_view`.`hired` = 'No');

-- --------------------------------------------------------

--
-- Structure for view `unhired_language_view`
--
DROP TABLE IF EXISTS `unhired_language_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `cslc_tutoring_system`.`unhired_language_view` AS select distinct `cslc_tutoring_system`.`applicant_language`.`tutor_Id` AS `tutor_Id`,group_concat(distinct `cslc_tutoring_system`.`applicant_language`.`language` separator ',') AS `lang`,`cslc_tutoring_system`.`tutors`.`FirstName` AS `FirstName`,`cslc_tutoring_system`.`tutors`.`LastName` AS `LastName`,`cslc_tutoring_system`.`tutors`.`email` AS `email`,`cslc_tutoring_system`.`tutors`.`phone` AS `phone`,`cslc_tutoring_system`.`tutors`.`status` AS `status`,`cslc_tutoring_system`.`tutors`.`get_hash` AS `hash`,`cslc_tutoring_system`.`tutors`.`hired` AS `hired`,`resume_links`.`link` AS `link` from ((`cslc_tutoring_system`.`applicant_language` join `cslc_tutoring_system`.`tutors` on((`cslc_tutoring_system`.`tutors`.`tutor_Id` = `cslc_tutoring_system`.`applicant_language`.`tutor_Id`))) join `cslc_tutoring_system`.`resume_links` on((`cslc_tutoring_system`.`applicant_language`.`tutor_Id` = `resume_links`.`tutor_Id`))) group by `cslc_tutoring_system`.`applicant_language`.`tutor_Id` order by `cslc_tutoring_system`.`applicant_language`.`tutor_Id`;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `applicant_language`
--
ALTER TABLE `applicant_language`
  ADD PRIMARY KEY (`Applicant_Id`),
  ADD UNIQUE KEY `teach_Id_UNIQUE` (`Applicant_Id`),
  ADD KEY `tutor_Id_idx` (`tutor_Id`);

--
-- Indexes for table `attendees`
--
ALTER TABLE `attendees`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `book_Id_idx` (`book_Id`);

--
-- Indexes for table `available_time`
--
ALTER TABLE `available_time`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tutor_Id` (`tutor_Id`);

--
-- Indexes for table `booking-history`
--
ALTER TABLE `booking-history`
  ADD PRIMARY KEY (`history_Id`),
  ADD KEY `tutor_Id` (`tutor_Id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`event_Id`),
  ADD KEY `tutor_Id_idx` (`tutor_Id`),
  ADD KEY `lan_Id_idx` (`language`);

--
-- Indexes for table `files`
--
ALTER TABLE `files`
  ADD PRIMARY KEY (`file_Id`),
  ADD UNIQUE KEY `file_Id_UNIQUE` (`file_Id`),
  ADD KEY `tutor_Id_idx` (`tutor_Id`);

--
-- Indexes for table `hours`
--
ALTER TABLE `hours`
  ADD PRIMARY KEY (`hours_Id`);

--
-- Indexes for table `job-booked`
--
ALTER TABLE `job-booked`
  ADD PRIMARY KEY (`book_Id`),
  ADD KEY `tutor_Id` (`tutor_Id`);

--
-- Indexes for table `languages`
--
ALTER TABLE `languages`
  ADD PRIMARY KEY (`language`),
  ADD UNIQUE KEY `language` (`language`) USING BTREE;

--
-- Indexes for table `logins`
--
ALTER TABLE `logins`
  ADD PRIMARY KEY (`log_Id`),
  ADD UNIQUE KEY `ID` (`ID`);

--
-- Indexes for table `student_management`
--
ALTER TABLE `student_management`
  ADD PRIMARY KEY (`student_Id`);

--
-- Indexes for table `teaching`
--
ALTER TABLE `teaching`
  ADD PRIMARY KEY (`teach_Id`),
  ADD UNIQUE KEY `teach_Id_UNIQUE` (`teach_Id`),
  ADD KEY `tutor_Id_idx` (`tutor_Id`),
  ADD KEY `language_idx` (`language`);

--
-- Indexes for table `tutors`
--
ALTER TABLE `tutors`
  ADD PRIMARY KEY (`tutor_Id`),
  ADD UNIQUE KEY `tutor_Id` (`tutor_Id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `applicant_language`
--
ALTER TABLE `applicant_language`
  MODIFY `Applicant_Id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=304;
--
-- AUTO_INCREMENT for table `attendees`
--
ALTER TABLE `attendees`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `available_time`
--
ALTER TABLE `available_time`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=50;
--
-- AUTO_INCREMENT for table `booking-history`
--
ALTER TABLE `booking-history`
  MODIFY `history_Id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=190;
--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `event_Id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=249;
--
-- AUTO_INCREMENT for table `files`
--
ALTER TABLE `files`
  MODIFY `file_Id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2132347899;
--
-- AUTO_INCREMENT for table `hours`
--
ALTER TABLE `hours`
  MODIFY `hours_Id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=46;
--
-- AUTO_INCREMENT for table `job-booked`
--
ALTER TABLE `job-booked`
  MODIFY `book_Id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `logins`
--
ALTER TABLE `logins`
  MODIFY `log_Id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=852;
--
-- AUTO_INCREMENT for table `teaching`
--
ALTER TABLE `teaching`
  MODIFY `teach_Id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=704;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `applicant_language`
--
ALTER TABLE `applicant_language`
  ADD CONSTRAINT `Applicant_language_ibfk_1` FOREIGN KEY (`tutor_Id`) REFERENCES `tutors` (`tutor_Id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `attendees`
--
ALTER TABLE `attendees`
  ADD CONSTRAINT `book_Id` FOREIGN KEY (`book_Id`) REFERENCES `job-booked` (`book_Id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `available_time`
--
ALTER TABLE `available_time`
  ADD CONSTRAINT `available_time_ibfk_1` FOREIGN KEY (`tutor_Id`) REFERENCES `tutors` (`tutor_Id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `booking-history`
--
ALTER TABLE `booking-history`
  ADD CONSTRAINT `booking-history_ibfk_1` FOREIGN KEY (`tutor_Id`) REFERENCES `tutors` (`tutor_Id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `events`
--
ALTER TABLE `events`
  ADD CONSTRAINT `events_ibfk_1` FOREIGN KEY (`tutor_Id`) REFERENCES `tutors` (`tutor_Id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `files`
--
ALTER TABLE `files`
  ADD CONSTRAINT `files_ibfk_1` FOREIGN KEY (`tutor_Id`) REFERENCES `tutors` (`tutor_Id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `job-booked`
--
ALTER TABLE `job-booked`
  ADD CONSTRAINT `job-Boked_ibfk_1` FOREIGN KEY (`tutor_Id`) REFERENCES `tutors` (`tutor_Id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `teaching`
--
ALTER TABLE `teaching`
  ADD CONSTRAINT `language` FOREIGN KEY (`language`) REFERENCES `languages` (`language`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tutor_Id` FOREIGN KEY (`tutor_Id`) REFERENCES `tutors` (`tutor_Id`) ON DELETE CASCADE ON UPDATE CASCADE;

