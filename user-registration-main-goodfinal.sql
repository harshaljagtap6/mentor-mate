-- phpMyAdmin SQL Dump
-- version 5.3.0-dev+20221010.6785c97d22
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 13, 2022 at 07:56 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `user-registration-main`
--

-- --------------------------------------------------------

--
-- Table structure for table `appointment`
--

CREATE TABLE `appointment` (
  `appointment_id` int(11) NOT NULL,
  `student_user` varchar(50) NOT NULL,
  `mentor_user` varchar(50) NOT NULL,
  `note` varchar(100) NOT NULL,
  `appointment_accepted` int(1) NOT NULL DEFAULT 0,
  `appointment_declined` int(1) NOT NULL DEFAULT 0,
  `appointment_status` int(1) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `college_id` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `authentication_code`
--

CREATE TABLE `authentication_code` (
  `id` int(4) NOT NULL,
  `authen_code` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `authentication_code`
--

INSERT INTO `authentication_code` (`id`, `authen_code`) VALUES
(1, 'LJPOLY633');

-- --------------------------------------------------------

--
-- Table structure for table `college_id_table`
--

CREATE TABLE `college_id_table` (
  `id` int(3) NOT NULL,
  `college_id` varchar(10) DEFAULT NULL,
  `college_authentication_code` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `college_id_table`
--

INSERT INTO `college_id_table` (`id`, `college_id`, `college_authentication_code`) VALUES
(1, 'LJP633', 'LJPOLY6'),
(3, 'SAL69', 'SALUNI69'),
(4, 'IND11', 'INDUS11');

-- --------------------------------------------------------

--
-- Table structure for table `mentor_users`
--

CREATE TABLE `mentor_users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `email` varchar(255) DEFAULT NULL,
  `authen_code` varchar(10) DEFAULT NULL,
  `college_id` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mentor_users`
--

INSERT INTO `mentor_users` (`id`, `username`, `password`, `created_at`, `email`, `authen_code`, `college_id`) VALUES
(1, 'hirenmentorI', '$2y$10$Mw04PumL0Q1o.NnDn5R9n.rkuE4MVd2ZPrherqmLY.Jv/RGcOknGK', '2022-10-13 23:10:52', 'hirenmentor1@gmail.com', 'INDUS11', 'IND11'),
(2, 'hirenmentorS', '$2y$10$sZHQNRC8PZMifl4edJuS3uvP1lP/curE8VfWcEj/PbZDxYBwXN7ly', '2022-10-13 23:15:32', 'hirenmentorS@gmail.com', 'SALUNI69', 'SAL69');

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `questions` varchar(255) DEFAULT NULL,
  `questions_heading` varchar(50) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `answer` varchar(700) NOT NULL,
  `college_id` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`id`, `username`, `questions`, `questions_heading`, `created_at`, `answer`, `college_id`) VALUES
(1, 'hirenstudentI', 'This is the description for the first question on this site after final edits.', 'The first question ever', '2022-10-13 23:12:33', '', 'IND11'),
(2, 'hirenstudentS', 'This is the description for the question asked for the students of SAL university.', 'This is the question for the users of SAL universi', '2022-10-13 23:14:51', '', 'SAL69');

-- --------------------------------------------------------

--
-- Table structure for table `quiz`
--

CREATE TABLE `quiz` (
  `quiz_id` int(11) NOT NULL,
  `quiz_by` varchar(50) NOT NULL,
  `quiz_name` varchar(20) NOT NULL,
  `quiz_subject` varchar(20) NOT NULL,
  `total_questions` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `college_id` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `quiz_questions`
--

CREATE TABLE `quiz_questions` (
  `id` int(11) NOT NULL,
  `quiz_id` int(11) NOT NULL,
  `quiz_name` varchar(250) NOT NULL,
  `quiz_subject` varchar(250) NOT NULL,
  `quiz_by` varchar(250) NOT NULL,
  `question_id` int(250) NOT NULL,
  `question` varchar(250) NOT NULL,
  `option_a` varchar(250) NOT NULL,
  `option_b` varchar(250) NOT NULL,
  `option_c` varchar(250) NOT NULL,
  `option_d` varchar(250) NOT NULL,
  `answer` varchar(250) NOT NULL,
  `college_id` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `quiz_results`
--

CREATE TABLE `quiz_results` (
  `id` int(11) NOT NULL,
  `quiz_id` int(11) NOT NULL,
  `quiz_name` varchar(250) NOT NULL,
  `quiz_subject` varchar(250) NOT NULL,
  `quiz_by` varchar(250) NOT NULL,
  `correct_answers` int(250) NOT NULL,
  `incorrect_answers` int(250) NOT NULL,
  `total_questions` int(250) NOT NULL,
  `student_username` varchar(250) NOT NULL,
  `college_id` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `quiz_solved`
--

CREATE TABLE `quiz_solved` (
  `id` int(250) NOT NULL,
  `quiz_id` int(11) NOT NULL,
  `quiz_name` varchar(250) NOT NULL,
  `quiz_subject` varchar(250) NOT NULL,
  `quiz_by` varchar(250) NOT NULL,
  `username` varchar(250) NOT NULL,
  `solved` int(1) NOT NULL DEFAULT 0,
  `college_id` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `student_solve_quiz`
--

CREATE TABLE `student_solve_quiz` (
  `id` int(11) NOT NULL,
  `quiz_id` int(11) NOT NULL,
  `quiz_name` varchar(250) NOT NULL,
  `quiz_subject` varchar(250) NOT NULL,
  `quiz_by` varchar(250) NOT NULL,
  `question_id` int(250) NOT NULL,
  `question` varchar(250) NOT NULL,
  `answer` varchar(250) NOT NULL,
  `username` varchar(250) NOT NULL,
  `college_id` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `student_users`
--

CREATE TABLE `student_users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `email` varchar(255) DEFAULT NULL,
  `college_id` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `student_users`
--

INSERT INTO `student_users` (`id`, `username`, `password`, `created_at`, `email`, `college_id`) VALUES
(1, 'hirenstudentI', '$2y$10$Y9nOd.HtFjKlAZ0qJf/DlOzdJnIih/s/OZmxOSMpkXT0LQLxS.Yka', '2022-10-13 23:11:49', 'hirenstudentI@gmail.com', 'IND11'),
(2, 'hirenstudentS', '$2y$10$Ljnz8fPoas1FLqi1KTndo.wnBHWLF9kZzIjwAMzkjpEY1bvJyC3Hi', '2022-10-13 23:13:14', 'hirenstudentS@gmail.com', 'SAL69');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appointment`
--
ALTER TABLE `appointment`
  ADD PRIMARY KEY (`appointment_id`);

--
-- Indexes for table `authentication_code`
--
ALTER TABLE `authentication_code`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `college_id_table`
--
ALTER TABLE `college_id_table`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mentor_users`
--
ALTER TABLE `mentor_users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `quiz`
--
ALTER TABLE `quiz`
  ADD PRIMARY KEY (`quiz_id`);

--
-- Indexes for table `quiz_questions`
--
ALTER TABLE `quiz_questions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `test` (`quiz_id`);

--
-- Indexes for table `quiz_results`
--
ALTER TABLE `quiz_results`
  ADD PRIMARY KEY (`id`),
  ADD KEY `quiz_id` (`quiz_id`);

--
-- Indexes for table `quiz_solved`
--
ALTER TABLE `quiz_solved`
  ADD PRIMARY KEY (`id`),
  ADD KEY `quiz_id` (`quiz_id`);

--
-- Indexes for table `student_solve_quiz`
--
ALTER TABLE `student_solve_quiz`
  ADD PRIMARY KEY (`id`),
  ADD KEY `quiz_id` (`quiz_id`);

--
-- Indexes for table `student_users`
--
ALTER TABLE `student_users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD KEY `username_2` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `appointment`
--
ALTER TABLE `appointment`
  MODIFY `appointment_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `authentication_code`
--
ALTER TABLE `authentication_code`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `college_id_table`
--
ALTER TABLE `college_id_table`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `mentor_users`
--
ALTER TABLE `mentor_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `quiz`
--
ALTER TABLE `quiz`
  MODIFY `quiz_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `quiz_questions`
--
ALTER TABLE `quiz_questions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `quiz_results`
--
ALTER TABLE `quiz_results`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `quiz_solved`
--
ALTER TABLE `quiz_solved`
  MODIFY `id` int(250) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `student_solve_quiz`
--
ALTER TABLE `student_solve_quiz`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `student_users`
--
ALTER TABLE `student_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `quiz_questions`
--
ALTER TABLE `quiz_questions`
  ADD CONSTRAINT `test` FOREIGN KEY (`quiz_id`) REFERENCES `quiz` (`quiz_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `quiz_results`
--
ALTER TABLE `quiz_results`
  ADD CONSTRAINT `quiz_results_ibfk_1` FOREIGN KEY (`quiz_id`) REFERENCES `quiz` (`quiz_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `quiz_solved`
--
ALTER TABLE `quiz_solved`
  ADD CONSTRAINT `quiz_solved_ibfk_1` FOREIGN KEY (`quiz_id`) REFERENCES `quiz` (`quiz_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `student_solve_quiz`
--
ALTER TABLE `student_solve_quiz`
  ADD CONSTRAINT `student_solve_quiz_ibfk_1` FOREIGN KEY (`quiz_id`) REFERENCES `quiz` (`quiz_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
