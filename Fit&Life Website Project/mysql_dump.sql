-- phpMyAdmin SQL Dump
-- version 4.9.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: May 05, 2020 at 03:48 PM
-- Server version: 5.7.26
-- PHP Version: 7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `gym`
--

-- --------------------------------------------------------

--
-- Table structure for table `class`
--

CREATE TABLE `class` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `summary` text NOT NULL,
  `day` varchar(9) NOT NULL,
  `photo_url` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `class`
--

INSERT INTO `class` (`id`, `name`, `summary`, `day`, `photo_url`) VALUES
(1, 'Pilates', 'Pilates benefits your core (or, in Pilates speak, your \"powerhouse\") unlike any other workout. In fact, after completing 36 weeks of Pilates training, women strengthened their rectus abdominis (the muscle responsible for six-packs) by an average of 21 percent, while eliminating muscle imbalances between the right and left sides of their cores, according to a Medicine & Science in Sports & Exercise study. (And yes, core strength is super important.)', 'Monday', '/img/5eb160882224c.jpeg'),
(2, 'Zumba', 'What makes Zumba different than most dance classes is the variety of music and dance styles in one class. Each Zumba class will include Salsa (the evolution of a traditional Cuban dance), Merengue (which originated in the Dominican Republic), Cumbia (from Cuba), Reggaeton (a dance from the underground music scene in Puerto Rico) and even a few pop songs, depending on the instructor.\r\n\r\nZumba is also unique in that students follow the lead of the instructor rather than learning the choreography step-by-step so the class keeps moving and students don’t have to stop to ‘break down’ any steps or movements. So even if you don’t know how to Zumba, you’ll learn on the fly.', 'Friday', '/img/zumba.jpg'),
(3, 'Cardio', 'In a nutshell, the term aerobic means \"with oxygen.\" Aerobic exercise and activities are also called cardio, short for \"cardiovascular.\" During aerobic activity, you repeatedly move large muscles in your arms, legs and hips. Your heart rate increases and you breathe faster and more deeply. This maximizes the amount of oxygen in your blood and ultimately helps you use oxygen more efficiently.', 'Saturday', '/img/cardio.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `feature`
--

CREATE TABLE `feature` (
  `id` int(11) NOT NULL,
  `title` text NOT NULL,
  `body` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `feature`
--

INSERT INTO `feature` (`id`, `title`, `body`) VALUES
(1, 'Push-up Challenge Event!.', 'Many people ask for the challenge of this month. The winner will be get one month membership free! For further information, stay in touch with us.'),
(2, 'All gyms closed. Thursday 23th March - ?', 'Fit&Life fully supports the national effort to control the spread and impact of the virus and to do whatever we can to protect public health, including the health of our members and staff.');

-- --------------------------------------------------------

--
-- Table structure for table `membership_type`
--

CREATE TABLE `membership_type` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `sub_type` text NOT NULL,
  `price` float NOT NULL,
  `detail` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `membership_type`
--

INSERT INTO `membership_type` (`id`, `name`, `sub_type`, `price`, `detail`) VALUES
(1, 'Gold Membership', 'Adult', 40, 'Gold Membership entitles you to unlimited use of Free Weights Gym, ALL Fitness Classes and Personal Training. Also included is use of the sauna.'),
(2, 'Gold Membership', 'Student', 35, 'Gold Membership entitles you to unlimited use of Free Weights Gym, ALL Fitness Classes and Personal Training. Also included is use of the sauna.'),
(3, 'Gold Membership', 'Elderly (over 50\'s)', 30, 'Gold Membership entitles you to unlimited use of Free Weights Gym, ALL Fitness Classes and Personal Training. Also included is use of the sauna.'),
(4, 'Silver Membership', 'Adult', 35, 'Silver Membership entitles you to unlimited use of Free Weights Gym and ALL Fitness Classes. Also included is use of the sauna.'),
(5, 'Silver Membership', 'Student', 30, 'Silver Membership entitles you to unlimited use of Free Weights Gym and ALL Fitness Classes. Also included is use of the sauna.'),
(6, 'Silver Membership', 'Elderly (over 50\'s)', 25, 'Silver Membership entitles you to unlimited use of Free Weights Gym and ALL Fitness Classes. Also included is use of the sauna.'),
(7, 'Bronze Membership', 'Adult', 30, 'Bronze Membership entitles you to unlimited use of Free Weights Gym. Also included is use of the café.'),
(8, 'Bronze Membership', 'Student', 20, 'Bronze Membership entitles you to unlimited use of Free Weights Gym. Also included is use of the café.'),
(10, 'Bronze Membership', 'Elderly (over 50\'s)', 15, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE `message` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `email` text NOT NULL,
  `phone` text NOT NULL,
  `message` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `message`
--

INSERT INTO `message` (`id`, `name`, `email`, `phone`, `message`) VALUES
(2, 'No Name', 'me@google.com', '02345832234', 'Naber?');

-- --------------------------------------------------------

--
-- Table structure for table `testimonial`
--

CREATE TABLE `testimonial` (
  `id` int(11) NOT NULL,
  `username` varchar(25) NOT NULL,
  `testimonial` text NOT NULL,
  `is_visible` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `testimonial`
--

INSERT INTO `testimonial` (`id`, `username`, `testimonial`, `is_visible`) VALUES
(1, 'admin', 'My husband and I were staying in Ireland for 5 days and travelling from Australia we were seeking a gym we could work out at that was easy and somewhere we felt comfortable. As soon as we walked into the gym it felt like we were home. The staff were so friendly and the facilities were impressive. We would highly recommend this gym to anyone like us travelling around Dublin. Thank you to the staff.', 1),
(2, 'admin', 'The staff is incredibly friendly and accommodating, the overall environment is welcoming, and the equipment is in excellent condition. The PTs are knowledgeable and, though I have yet to try out the classes, they look interesting and I\'ve heard good things. And, it should be mentioned, that they always play a great music selection so you can be unencumbered by that constrictor knot headphones always seem to get themselves into.', 1),
(3, 'admin', 'All of the staff are welcoming and professional. The equipment is up to date and well maintained. Free guided tours are offered to all visitors and and it is dishonest to report that this was refused. Enjoy your workout.', 0),
(4, 'johndoe', 'Good', 0),
(5, 'johndoe', 'The atmosphere in the gym is fantastic great sound tracks to keep you motivated and ready to work.\nPlenty of equipment was always able to do the workout I wanted without having to wait for someone else to be finished with any equipment. Lots of machines too!!!\nOverall very happy with this gym and will be going here regularly.\n', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `username` varchar(25) NOT NULL,
  `password_hash` text NOT NULL,
  `user_type` enum('admin','member') NOT NULL,
  `name` text NOT NULL,
  `email` text NOT NULL,
  `gender` enum('Female','Male','Other') NOT NULL,
  `membership_type_id` int(11) DEFAULT NULL,
  `birth_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`username`, `password_hash`, `user_type`, `name`, `email`, `gender`, `membership_type_id`, `birth_date`) VALUES
('admin', '$2y$10$cic1I2yPw0CO2Ccd48j0rO478PxTZG2AbLanXBu7zLXREUYJ8s5WK', 'admin', 'Admin User', 'admin@gym.com', 'Female', 1, '1997-10-15'),
('asdasdasd', '$2y$10$2z.b.QSsABcG4eybZaqRduQtTpEGsjXR.TASKmwWkJ5QZ6LRA47Tu', 'member', 'teset awrqw', 'qweqwe@qwe.ads', 'Female', 1, '2020-05-03'),
('johndoe', '$2y$10$cic1I2yPw0CO2Ccd48j0rO478PxTZG2AbLanXBu7zLXREUYJ8s5WK', 'member', 'John Doe', 'john@gym.com', 'Male', 4, '1997-10-15');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `class`
--
ALTER TABLE `class`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `feature`
--
ALTER TABLE `feature`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `membership_type`
--
ALTER TABLE `membership_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `testimonial`
--
ALTER TABLE `testimonial`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_testimonial` (`username`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`username`),
  ADD KEY `fk_membership` (`membership_type_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `class`
--
ALTER TABLE `class`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `feature`
--
ALTER TABLE `feature`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `membership_type`
--
ALTER TABLE `membership_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `testimonial`
--
ALTER TABLE `testimonial`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `testimonial`
--
ALTER TABLE `testimonial`
  ADD CONSTRAINT `fk_testimonial` FOREIGN KEY (`username`) REFERENCES `user` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `fk_membership` FOREIGN KEY (`membership_type_id`) REFERENCES `membership_type` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
