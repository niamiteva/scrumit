-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 27, 2019 at 02:59 PM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `scrumit`
--

-- --------------------------------------------------------

--
-- Table structure for table `positions`
--

CREATE TABLE `positions` (
  `position_id` varchar(255) NOT NULL,
  `position` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE `projects` (
  `project_id` varchar(255) NOT NULL,
  `projectName` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`project_id`, `projectName`) VALUES
('a76c6aff-afe7-11e9-bbb3-c85b76dc7a47', 'Scrum.it');

-- --------------------------------------------------------

--
-- Table structure for table `sprints`
--

CREATE TABLE `sprints` (
  `sprint_id` varchar(255) NOT NULL,
  `project` varchar(255) NOT NULL,
  `sprintName` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sprints`
--

INSERT INTO `sprints` (`sprint_id`, `project`, `sprintName`) VALUES
('a76cf979-afe7-11e9-bbb3-c85b76dc7a47', 'a76c6aff-afe7-11e9-bbb3-c85b76dc7a47', 'Backlog'),
('da28c0d2-b05e-11e9-bbb3-c85b76dc7a47', 'a76c6aff-afe7-11e9-bbb3-c85b76dc7a47', 'Scrum.it_v11');

-- --------------------------------------------------------

--
-- Table structure for table `status`
--

CREATE TABLE `status` (
  `id` int(11) NOT NULL,
  `status_id` varchar(255) NOT NULL,
  `status` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `status`
--

INSERT INTO `status` (`id`, `status_id`, `status`) VALUES
(1, '70beaa19-893e-11e9-832e-c85b76dc7a47', 'To do'),
(2, '825d0fcd-893e-11e9-832e-c85b76dc7a47', 'In development'),
(3, '8f07b6c7-893e-11e9-832e-c85b76dc7a47', 'Testing'),
(4, '97f36b51-893e-11e9-832e-c85b76dc7a47', 'Done');

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

CREATE TABLE `tasks` (
  `id` int(16) NOT NULL,
  `task_id` varchar(255) NOT NULL,
  `sprint` varchar(255) NOT NULL,
  `user` varchar(255) DEFAULT NULL,
  `taskName` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `type` varchar(255) NOT NULL,
  `value` int(11) NOT NULL,
  `priority` int(11) NOT NULL,
  `status` varchar(255) DEFAULT 'To do',
  `complete` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tasks`
--

INSERT INTO `tasks` (`id`, `task_id`, `sprint`, `user`, `taskName`, `description`, `type`, `value`, `priority`, `status`, `complete`) VALUES
(29, 'a050f0e7-b05e-11e9-bbb3-c85b76dc7a47', 'a76cf979-afe7-11e9-bbb3-c85b76dc7a47', '6fbbbfbe-b05d-11e9-bbb3-c85b76dc7a47', 'add task form', 'add it', 'd813f711-893e-11e9-832e-c85b76dc7a47', 1, 1, '70beaa19-893e-11e9-832e-c85b76dc7a47', 1),
(31, 'ab4112a6-b061-11e9-bbb3-c85b76dc7a47', 'a76cf979-afe7-11e9-bbb3-c85b76dc7a47', '6fbbbfbe-b05d-11e9-bbb3-c85b76dc7a47', 'feature task', 'asd', 'b849c6fc-893e-11e9-832e-c85b76dc7a47', 1, 1, '70beaa19-893e-11e9-832e-c85b76dc7a47', 1),
(32, 'c40f0e2b-b061-11e9-bbb3-c85b76dc7a47', 'a76cf979-afe7-11e9-bbb3-c85b76dc7a47', '6fbbbfbe-b05d-11e9-bbb3-c85b76dc7a47', 'story item', 'sorry story', 'c15c6bfb-893e-11e9-832e-c85b76dc7a47', 1, 1, '70beaa19-893e-11e9-832e-c85b76dc7a47', 1),
(30, 'e7fd3268-b05e-11e9-bbb3-c85b76dc7a47', 'da28c0d2-b05e-11e9-bbb3-c85b76dc7a47', '6fbbbfbe-b05d-11e9-bbb3-c85b76dc7a47', 'test 3', 'тест', 'afa5d61a-893e-11e9-832e-c85b76dc7a47', 1, 1, '70beaa19-893e-11e9-832e-c85b76dc7a47', 1);

-- --------------------------------------------------------

--
-- Table structure for table `type`
--

CREATE TABLE `type` (
  `type_id` varchar(255) NOT NULL,
  `type` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `type`
--

INSERT INTO `type` (`type_id`, `type`) VALUES
('afa5d61a-893e-11e9-832e-c85b76dc7a47', 'bug'),
('b849c6fc-893e-11e9-832e-c85b76dc7a47', 'feature'),
('c15c6bfb-893e-11e9-832e-c85b76dc7a47', 'story'),
('d813f711-893e-11e9-832e-c85b76dc7a47', 'task');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` varchar(255) NOT NULL,
  `project` varchar(255) NOT NULL,
  `user` varchar(100) NOT NULL,
  `email` varchar(200) NOT NULL,
  `position` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `project`, `user`, `email`, `position`) VALUES
('6fbbbfbe-b05d-11e9-bbb3-c85b76dc7a47', 'a76c6aff-afe7-11e9-bbb3-c85b76dc7a47', 'nia mietva', 'mitevania@gmail.com', 'Owner');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `positions`
--
ALTER TABLE `positions`
  ADD PRIMARY KEY (`position_id`),
  ADD UNIQUE KEY `pos` (`position`);

--
-- Indexes for table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`project_id`),
  ADD UNIQUE KEY `project_id` (`project_id`),
  ADD UNIQUE KEY `projectName` (`projectName`);

--
-- Indexes for table `sprints`
--
ALTER TABLE `sprints`
  ADD PRIMARY KEY (`sprint_id`),
  ADD UNIQUE KEY `sprint_id` (`sprint_id`),
  ADD KEY `fk_project_id` (`project`);

--
-- Indexes for table `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`status_id`),
  ADD UNIQUE KEY `status_id` (`status_id`),
  ADD UNIQUE KEY `status` (`status`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`task_id`),
  ADD UNIQUE KEY `taskName` (`taskName`),
  ADD UNIQUE KEY `id` (`id`),
  ADD UNIQUE KEY `task_id` (`task_id`),
  ADD KEY `fk_sprint_id` (`sprint`),
  ADD KEY `fk_status_id` (`status`),
  ADD KEY `fk_type_id` (`type`),
  ADD KEY `fk_user_id` (`user`);

--
-- Indexes for table `type`
--
ALTER TABLE `type`
  ADD PRIMARY KEY (`type_id`),
  ADD UNIQUE KEY `type` (`type`),
  ADD UNIQUE KEY `type_id` (`type_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `user` (`user`),
  ADD UNIQUE KEY `user_id` (`user_id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `project` (`project`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `status`
--
ALTER TABLE `status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id` int(16) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `sprints`
--
ALTER TABLE `sprints`
  ADD CONSTRAINT `fk_project_id` FOREIGN KEY (`project`) REFERENCES `projects` (`project_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tasks`
--
ALTER TABLE `tasks`
  ADD CONSTRAINT `fk_sprint_id` FOREIGN KEY (`sprint`) REFERENCES `sprints` (`sprint_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_status_id` FOREIGN KEY (`status`) REFERENCES `status` (`status_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_type_id` FOREIGN KEY (`type`) REFERENCES `type` (`type_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_user_id` FOREIGN KEY (`user`) REFERENCES `users` (`user_id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `project` FOREIGN KEY (`project`) REFERENCES `projects` (`project_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
