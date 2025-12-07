-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 06, 2025 at 02:57 PM
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
-- Database: `user_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `grades`
--

CREATE TABLE `grades` (
  `id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `subject` varchar(100) NOT NULL,
  `grade` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `grades`
--

INSERT INTO `grades` (`id`, `student_id`, `subject`, `grade`) VALUES
(1, 7, 'MATH', 99),
(2, 7, 'PAGMAMAHAL KO', 1),
(3, 10, 'FUNDAMENTALS OF PROGRAMMING', 99),
(4, 10, 'MATH', 99);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `description`) VALUES
(1, 'applicant', 'Applicant user role'),
(2, 'student', 'Student user role'),
(3, 'faculty', 'Faculty user role'),
(4, 'admin', 'Administrator user role');

-- --------------------------------------------------------

--
-- Table structure for table `system_settings`
--

CREATE TABLE `system_settings` (
  `id` int(11) NOT NULL,
  `results_released` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `system_settings`
--

INSERT INTO `system_settings` (`id`, `results_released`) VALUES
(1, 1),
(2, 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `student_id` varchar(20) DEFAULT NULL,
  `fullname` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role_id` int(11) NOT NULL,
  `passed` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `student_id`, `fullname`, `email`, `password`, `role_id`, `passed`) VALUES
(2, '65-9959', 'Rhejie Carl M. Cabrera', 'rhejiecarl@gmail.com', '$2y$10$baj3P0wLMR7LsqqyzUaJKeOUckADtw/1Jbha26zfc/.lZURL30.fe', 4, 0),
(3, '48-3591', 'applicant123', 'applicant@gmail.com', '$2y$10$eirMybCRlgQrLpvI7aSgzuLRDBirmvz0Gav2Av2hdnlX38sRe3SYm', 2, 1),
(4, '26-4352', 'facultyy', 'faculty@gmail.com', '$2y$10$FpRbmENQQQNqGI3SQvvRk.ikq8MuUBWOYQYiHi5a0iCgk5gBkfK62', 3, 0),
(5, '55-1636', 'student1', 'student1@gmail.com', '$2y$10$56voY/466NYeRkwWfFVhQuWmxCmNlKREcWANn5wJ0Qq7DI1TJaIWy', 2, 0),
(6, '74-9133', 'appli', 'app1@gmail.cpm', '$2y$10$Fns8f9ZwEakQLxWk285vaOEeKn.VhSYwB8nTrn0SnIZSzxFcZR3lG', 2, 1),
(7, '95-2057', 'DARWIN', 'darwin@gmail.com', '$2y$10$nCywa28Bb3kl4EvIw5dsvuyky7n3B2iGDb7LmnXwsoq64K4w03im6', 2, 1),
(8, '55-5146', 'test2', 'test2@gmail.com', '$2y$10$9AInVWMvwMp/fxrpl2va4uyMPzu5qUd3.YvoyAGgNzb7xroJYb5my', 1, 1),
(9, '39-9491', 'applicant', 'applicant1@gmail.com', '$2y$10$5SJc4FJAoTQlpxBbpuV6x.YVcdMuZ4EdYzyda.doFBc1y4okYIxfG', 1, 0),
(10, '35-7669', 'Chloe Bianca Choa', 'bianca@gmail.com', '$2y$10$VYOhY8jQZWjvftycdxo6RuZR7R88.4fa9/nlWaOCPufFm5gDEc/vq', 2, 1),
(11, '38-5407', 'sadsadsa', 'app2@gmail.com', '$2y$10$b14OkDFzZ/E2VTLdl4LveuzSru.x1OTmZLVueZXNG98/eadaDSJBK', 1, 1),
(12, '93-9835', 'Vincent John Maranga', 'vincent@gmail.com', '$2y$10$YX7zmKZfkM6nGodEQterfeyNL5lAyzuSgK8qaEvB3TnEZIMvDOD4y', 2, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `grades`
--
ALTER TABLE `grades`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `student_id` (`student_id`,`subject`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `system_settings`
--
ALTER TABLE `system_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `role_id` (`role_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `grades`
--
ALTER TABLE `grades`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `system_settings`
--
ALTER TABLE `system_settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `grades`
--
ALTER TABLE `grades`
  ADD CONSTRAINT `grades_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
