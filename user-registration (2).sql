-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 24, 2021 at 07:35 AM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 7.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `user-registration`
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
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `appointment`
--

INSERT INTO `appointment` (`appointment_id`, `student_user`, `mentor_user`, `note`, `appointment_accepted`, `appointment_declined`, `appointment_status`, `created_at`) VALUES
(2, 'student1', 'deep', 'deep chal daru la', 0, 0, 0, '2021-04-12 00:00:00'),
(3, 'student2', 'mentor3', 'mentor3 chal daru la.', 1, 0, 1, '2021-04-12 00:00:00'),
(4, 'student2', 'mentor2', 'mentorrrr2', 0, 0, 0, '2021-04-12 00:00:00'),
(5, 'harshal', 'deep', 'yo deep help meeeeee.', 0, 0, 0, '2021-04-12 15:42:01'),
(6, 'harshal', 'harshalmentor', 'Lol both the persons student and mentor are the same lmaoooo.', 0, 0, 1, '2021-04-12 16:08:29'),
(7, 'student1', 'harshalmentor', 'hey harshalmentor id like to meet you at blah blah place or at college after study hours.', 0, 1, 1, '2021-04-12 16:56:39'),
(8, 'student1', 'mentor1', 'appoint accept kar de', 1, 0, 1, '2021-04-12 17:22:21'),
(9, 'student1', 'harshalmentor', 'accept this', 1, 0, 1, '2021-04-12 17:25:06'),
(10, 'student1', 'harshalmentor', 'maalav yayyyy.', 1, 0, 1, '2021-04-12 17:38:37'),
(11, 'student1', 'harshalmentor', 'we are debugging i love coding <3 .', 1, 0, 1, '2021-04-12 18:03:37'),
(12, 'student1', 'mentor1', 'wallah mai ganda huuuuu', 0, 1, 1, '2021-04-12 18:22:00'),
(13, 'student2', 'mentor3', 'it is maalav not malav', 1, 0, 1, '2021-04-12 19:19:09'),
(14, 'student1', 'harshalmentor', 'yay deep', 1, 0, 1, '2021-04-13 17:15:23'),
(15, 'student1', 'mentor3', 'kuch bhi', 1, 0, 1, '2021-04-13 22:06:05'),
(16, 'student1', 'harshalmentor', 'something note.', 1, 0, 1, '2021-04-17 13:30:13'),
(17, 'student1', 'mentor1', 'yessss', 0, 1, 1, '2021-04-20 13:39:47'),
(18, 'orange', 'orangementor', 'doobeedoobeeda', 0, 1, 1, '2021-04-20 14:21:23'),
(19, 'orange', 'orangementor', 'blah blah', 1, 0, 1, '2021-04-20 14:23:09'),
(20, 'boogeyman', 'Ankit', 'su che be randu.', 0, 1, 1, '2021-04-21 00:43:16'),
(21, 'boogeyman', 'Ankit', 'gandu', 1, 0, 1, '2021-04-21 00:43:52');

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
  `authen_code` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mentor_users`
--

INSERT INTO `mentor_users` (`id`, `username`, `password`, `created_at`, `email`, `authen_code`) VALUES
(4, 'mentor1', '$2y$10$EbfnVR9CK4ci9JD1lM0H1uLG7QceyMuYcZdpJqkKdVTX0d8fdMIna', '2020-02-28 02:23:11', 'mentor1@', 'LJPOLY633'),
(5, 'deep', '$2y$10$nE4GTPR7AOLPsssF5B9z7OWoFo41j6l3mDwYJyzbg.eLrNJ445JbO', '2020-02-28 02:27:29', 'deep@', 'LJPOLY633'),
(6, 'mentor2', '$2y$10$hMKdI2qA7hc9tyBpeyy3uuaWdvSVE6R5q6rG6OjBhFiAjGQ/i.Lr.', '2020-02-28 08:30:59', 'mentor2@', 'LJPOLY633'),
(7, 'Ankit', '$2y$10$JRVent3Ht/YwSxVPenWqfeR9WY4yn8cjMDLK6iqMRecZ9/T52gj9i', '2020-07-16 14:40:02', 'ankit@gmail.com', 'LJPOLY633'),
(8, 'mentor3', '$2y$10$cozizaVpwKdWoHJ/5I4oZOqkoQF0qPNkXHsCTIcyAbp3oSSnUDc7y', '2020-07-16 14:51:59', 'mentor3@gmail.com', 'LJPOLY633'),
(9, 'harshalmentor', '$2y$10$4C3XrwP80SBnXygzZ/Wnuuh/NuXTLgaoYrQ8bcmgfryMoW9Nq1PNy', '2021-04-12 16:07:33', 'harshalmentor@gmail.com', 'LJPOLY633'),
(10, 'orangementor', '$2y$10$MXqWd8LioN3QfxWNnX5Tre4.PHSZHb2i07VOvHU8AwUP78V89ao12', '2021-04-20 14:08:04', 'dstormpatel@gmail.com', 'LJPOLY633');

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
  `answer` varchar(700) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`id`, `username`, `questions`, `questions_heading`, `created_at`, `answer`) VALUES
(43, 'student1', 'ewr234', 'asdf', '2021-04-08 11:11:41', 'asdasd'),
(44, 'student1', 'question3 description is here.................', 'question3', '2021-04-08 11:47:37', 'me sad'),
(45, 'student1', 'and ma boi here is the explanation for the question. fullistop', 'here\'s the heading', '2021-04-08 20:16:50', 'answer for the fullistop'),
(47, 'student1', 'The student here asks another question', 'Another question', '2021-04-08 22:55:17', 'The mentor then provides the answer for the question. this is editted'),
(55, 'orange', 'desc of test question 1', 'this is test question 1', '2021-04-20 14:01:40', ''),
(57, 'boogeyman', 'universe', 'what is universe?', '2021-04-21 00:31:16', '');

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
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `quiz`
--

INSERT INTO `quiz` (`quiz_id`, `quiz_by`, `quiz_name`, `quiz_subject`, `total_questions`, `created_at`) VALUES
(29, 'mentor1', 'Quiz1', 'Quiz subject', 2, '2021-04-21 00:37:07');

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
  `answer` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `quiz_questions`
--

INSERT INTO `quiz_questions` (`id`, `quiz_id`, `quiz_name`, `quiz_subject`, `quiz_by`, `question_id`, `question`, `option_a`, `option_b`, `option_c`, `option_d`, `answer`) VALUES
(47, 29, 'Quiz1', 'Quiz subject', 'mentor1', 0, 'question1', 'OA', 'OB', 'OC', 'OD', 'option_a'),
(48, 29, 'Quiz1', 'Quiz subject', 'mentor1', 1, 'question2', 'OA', 'OB', 'OC', 'OD', 'option_b');

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
  `student_username` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `quiz_results`
--

INSERT INTO `quiz_results` (`id`, `quiz_id`, `quiz_name`, `quiz_subject`, `quiz_by`, `correct_answers`, `incorrect_answers`, `total_questions`, `student_username`) VALUES
(24, 29, 'Quiz1', 'Quiz subject', 'mentor1', 1, 1, 2, 'student1'),
(25, 29, 'Quiz1', 'Quiz subject', 'mentor1', 0, 2, 2, 'boogeyman');

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
  `solved` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `quiz_solved`
--

INSERT INTO `quiz_solved` (`id`, `quiz_id`, `quiz_name`, `quiz_subject`, `quiz_by`, `username`, `solved`) VALUES
(24, 29, 'Quiz1', 'Quiz subject', 'mentor1', 'student1', 1),
(25, 29, 'Quiz1', 'Quiz subject', 'mentor1', 'boogeyman', 1);

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
  `username` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `student_solve_quiz`
--

INSERT INTO `student_solve_quiz` (`id`, `quiz_id`, `quiz_name`, `quiz_subject`, `quiz_by`, `question_id`, `question`, `answer`, `username`) VALUES
(31, 29, 'Quiz1', 'Quiz subject', 'mentor1', 0, 'question1', 'option_a', 'student1'),
(32, 29, 'Quiz1', 'Quiz subject', 'mentor1', 1, 'question2', 'option_c', 'student1'),
(33, 29, 'Quiz1', 'Quiz subject', 'mentor1', 0, 'question1', 'option_c', 'boogeyman'),
(34, 29, 'Quiz1', 'Quiz subject', 'mentor1', 1, 'question2', 'option_d', 'boogeyman');

-- --------------------------------------------------------

--
-- Table structure for table `student_users`
--

CREATE TABLE `student_users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `email` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `student_users`
--

INSERT INTO `student_users` (`id`, `username`, `password`, `created_at`, `email`) VALUES
(1, 'student1', '$2y$10$qjFpilGWszT/9FYvszpnouvUYc640JKmI63fSOM.bN/558umYCgSS', '2020-02-28 01:58:04', 'student1@'),
(2, 'vrutant', '$2y$10$ZlxLV9lUN06Zfp0eIAEbreaZWM7dJDY7VBOHxeAavutdg.5DgD/Qu', '2020-02-28 19:53:28', 'vrutant@'),
(3, 'prashant', '$2y$10$0GSVwKTupmClHvplKOaemuCPCEfz/.e21OP4h3XCCkCkxjMSTlAFO', '2020-02-28 21:34:24', 'ppjagtap72@ymail.com'),
(4, 'student2', '$2y$10$nX2RCIzFAlgwvW4lwhLh7umOiGsk8K2da2TU1A83ITzBTz7k8WIyq', '2020-03-01 22:32:35', 'student2@'),
(5, 'seudent3', '$2y$10$r2M52LJTwNMEO/XAAK2GR.0.XLhEcF89/4e44WvwBakRf9uXSlWQC', '2020-03-01 22:32:51', 'student3@'),
(6, 'student4', '$2y$10$rtkhHWEPTYJbKzYDzjBTtOrf0jOPR5nrvl1nAwENqoKnqmh10Rlbu', '2020-03-01 22:33:10', 'student4@'),
(7, 'Wallah', '$2y$10$jnzJV.tpBWEfoVIOtk6z2uWjGgVsyHu7xWi5dq20J9jvLTs4Mm5RK', '2020-03-11 12:59:05', 'Wallah@'),
(8, 'Aamandra Thakur', '$2y$10$H3MHKjK5o2KY04G.2YzcjewvITvqMMUi3v.sZp7nATOX.LPlO8SOa', '2020-03-11 12:59:09', 'aamandra0512@gmail.com'),
(9, 'harshal', '$2y$10$LG6kQGeCon5X0jHmKPIxROoPkuQAQLsJKnbI7HtnH31KQRfDzkGWO', '2020-03-11 13:57:17', 'harshal@'),
(10, 'ankit', '$2y$10$1O4uPa9Bo500d1gV6maG9eSawDGoiYKGnCpWLg0kaU7jBQ.ta1y0m', '2020-07-10 11:58:07', 'ankit@abc.com'),
(11, 'RusheelSharma', '$2y$10$fG/G1iW77ppdwy7vRihSpuTI/Ko6g4PKhSqTXKP0yhd6eoJE/.OrK', '2021-04-08 21:08:37', 'rusheel9sharma@gmail.com'),
(12, 'babayaga', '$2y$10$zFBj2gzQ4oadlnZpz4jj6.lF92C7INwKX81j4i7c1ZIxsS/shWKWa', '2021-04-09 09:48:23', 'jaymin274.soni@gmail.com'),
(14, 'orange', '$2y$10$r.g80wZ.lOjYtYDdKHtl9ukfnrQ7yyC4w/z45vcdTzF8FTEiUOi4C', '2021-04-20 14:00:31', 'dstormpatel@gmail.com'),
(15, 'boogeyman', '$2y$10$R7W86X9uGA3jSExG5dL7X.3U2JEsg7jigNH24JQoMAcjXjIV.Uhzy', '2021-04-21 00:26:51', 'jaymin@gmail.com'),
(16, 'studenthere', '$2y$10$vN5AMDY3/AYDDRO1gYXLw.0uBTj.3D4WoMbgqLI8N8YG/AP5lhYVi', '2021-04-21 00:28:12', 'student');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appointment`
--
ALTER TABLE `appointment`
  ADD PRIMARY KEY (`appointment_id`);

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
  MODIFY `appointment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `mentor_users`
--
ALTER TABLE `mentor_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `quiz`
--
ALTER TABLE `quiz`
  MODIFY `quiz_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `quiz_questions`
--
ALTER TABLE `quiz_questions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `quiz_results`
--
ALTER TABLE `quiz_results`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `quiz_solved`
--
ALTER TABLE `quiz_solved`
  MODIFY `id` int(250) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `student_solve_quiz`
--
ALTER TABLE `student_solve_quiz`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `student_users`
--
ALTER TABLE `student_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

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
