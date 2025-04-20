-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 26, 2025 at 09:07 AM
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
-- Database: `database`
--

-- --------------------------------------------------------

--
-- Table structure for table `adminlogin`
--

CREATE TABLE `adminlogin` (
  `id` int(11) NOT NULL,
  `fullName` varchar(20) DEFAULT NULL,
  `username` varchar(20) NOT NULL,
  `gmail` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `adminlogin`
--

INSERT INTO `adminlogin` (`id`, `fullName`, `username`, `gmail`, `password`, `phone`) VALUES
(5, 'Harshkumar rana', 'Harsh810', 'hr810004@gmail.com', '$2y$10$pT6C3a28lBBt2tfANOrBsO7a19u4HRNTVQyuwuTWrSUIAq6IWEQfO', 2147483647),
(7, 'JeetP', 'Jeet', 'Jeet@gmail.com', '$2y$10$NWND1NGRO0bNWYBx585ule9BMHamXLduCdxWF6sKAV8kjvQ/Cd1ku', 2147483647);

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

CREATE TABLE `booking` (
  `book_id` int(100) NOT NULL,
  `book_seat` varchar(100) DEFAULT NULL,
  `user_id` int(100) DEFAULT NULL,
  `mov_id` int(100) DEFAULT NULL,
  `cin_id` int(100) DEFAULT NULL,
  `show_id` int(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cinema`
--

CREATE TABLE `cinema` (
  `cin_id` int(10) NOT NULL,
  `cin_name` varchar(200) DEFAULT NULL,
  `cin_address` varchar(200) DEFAULT NULL,
  `cin_image` varchar(200) DEFAULT NULL,
  `cin_description` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `cinema`
--

INSERT INTO `cinema` (`cin_id`, `cin_name`, `cin_address`, `cin_image`, `cin_description`) VALUES
(8, 'Rajhans Cinemas', 'J229+822, APPLE PLAZA Park, Shree Rameswar Mahadev Mandir Rd, Patiya, near Kapodra, Ankleshwar GIDC, Ankleshwar, Gujarat 393001', 'cinema/c1.jpg', 'Movie theater in Ankleshwar, Gujarat'),
(9, 'Ragini Multiplex', 'near Satyam Complex, Bhadkodra, Ankleshwar, Gujarat 393002', 'cinema/c2.jpg', 'Movie theater in Ankleshwar, Gujarat'),
(10, 'Shilpi Multiplex Fun Cinemas', '1st Floor Shilpi Multiplex Building Shilpi Square, Dahej Bypass Rd, Bharuch, Gujarat 392001', 'cinema/c3.jpg', 'Movie theater in Bharuch, Gujarat'),
(11, 'INOX', '2nd Floor, Blue Chip Mall, Sevashram Rd, Moti Doongri, Bharuch, Gujarat 392001', 'cinema/c4.jpg', 'Movie theater in Bharuch, Gujarat');

-- --------------------------------------------------------

--
-- Table structure for table `movie`
--

CREATE TABLE `movie` (
  `mov_id` int(10) NOT NULL,
  `mov_name` varchar(200) NOT NULL,
  `mov_released_date` date NOT NULL,
  `mov_status` varchar(200) NOT NULL,
  `mov_type` varchar(200) NOT NULL,
  `mov_trend` varchar(200) DEFAULT NULL,
  `mov_description` varchar(500) NOT NULL,
  `mov_image` varchar(200) DEFAULT NULL,
  `mov_tailor` varchar(255) DEFAULT NULL,
  `mov_cast` varchar(500) DEFAULT NULL,
  `mov_banner_image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `movie`
--

INSERT INTO `movie` (`mov_id`, `mov_name`, `mov_released_date`, `mov_status`, `mov_type`, `mov_trend`, `mov_description`, `mov_image`, `mov_tailor`, `mov_cast`, `mov_banner_image`) VALUES
(42, 'Last Christmas', '2019-11-15', 'Comming Soon', 'Hollywood', 'Non-Trending movie', 'Kate is a young woman subscribed to bad decisions. Her last date with disaster? That of having accepted to work as Santa\'s elf for a department store. However, she meets Tom there. Her life takes a new turn. For Kate, it seems too good to be true.', 'movieImage/lastchristmas.jpg', 'https://www.youtube.com/watch?v=z9CEIcmWmtA', ' Emilia Clarke, Henry Golding, Emma Thompson | See full cast & crew ', 'bannerImage/lastbanner.jfif'),
(43, 'articdoga.jpg', '2019-11-05', 'Comming Soon', 'Hollyhood', 'Non_Trending ', 'An Arctic fox works in the mailroom of a package delivery service, but wants to be doing the deliveries.', 'movieImage/articdoga.jpg', 'https://www.youtube.com/watch?v=_2Wn0mwoJJA', 'Anjelica Huston, James Franco, Jeremy Renner, Alec Baldwin', NULL),
(44, 'Mr Toilet', '2019-11-15', 'Comming Soon', 'Hollywood', 'Non-Trending movie', 'What do you get when you cross an eccentric self-made man with a load of crap? Jack Sim. To a stranger, he\'s a guy obsessed with toilets, but to those who know him, he\'s \"Mr. Toilet,\"', 'movieImage/mrtoilet.jpg', 'https://www.youtube.com/watch?v=lgfvED5KYAo', ' Lily Zepeda,Tchavdar Georgiev, Hee-Jae Park | 2 more credits \r\nStar: Jack Sim', 'bannerImage/mrtoilet.jpg'),
(45, 'Ekta', '2019-11-15', 'Comming Soon', 'Bollywood', 'Non-Trending movie', 'A young lady cop tries to solve a murder mystery and why it is happening.', 'movieImage/ekta.jpg', 'https://www.youtube.com/watch?v=BywLe4m2j2I', ' Salil Ankola, Navneet Kaur Dhillon, Avneet Kaur', 'bannerImage/mrtoilet.jpg'),
(46, 'Aditya Verma', '2019-11-29', 'Comming Soon', 'Bollywood', 'Non-Trending movie', 'Adithya Varma is an upcoming Indian Tamil-language romantic drama film directed by Gireesaaya (in his directorial debut) and produced by Mukesh Mehta under E4 Entertainment. The film stars newcomer Dhruv Vikram and Banita Sandhu in the lead roles while Priya Anand appears in a supporting role.', 'movieImage/adityavarma.jpg', 'https://www.youtube.com/watch?v=MQEuFT5DUeY', 'Directed by: Bala, Gireesaaya\r\nActor: Dhruv\r\nProduced by: Mukesh Mehta\r\nLanguage: Tamil language', 'bannerImage/adityavarma.jpg'),
(47, 'Charlie\'s Angels', '2019-12-01', 'Comming Soon', 'Hollywood', 'Non-Trending movie', 'Charlie\'s Angels is an upcoming American action comedy film directed by Elizabeth Banks, who also wrote the screenplay, from a story by Evan Spiliotopoulo', 'movieImage/charlies.jpg', 'https://www.youtube.com/watch?v=RSUq4VfWfjE', 'Story byâ€Ž: â€ŽEvan Spiliotopoulosâ€Ž; â€ŽDavid Auburn	Release dateâ€Ž: â€ŽNovember 15, 2019\r\nDistributed byâ€Ž: â€ŽSony Pictures Releasing	\r\nProduced byâ€Ž: â€ŽElizabeth Banksâ€Ž; â€ŽMax Handelmanâ€Ž; \r\n Cameron Diaz, Drew Barrymore, Lucy Liu ', 'bannerImage/charlies.jpg'),
(49, 'articdoga.jpg', '2019-11-05', 'Comming Soon', 'Hollyhood', 'Non_Trending ', 'An Arctic fox works in the mailroom of a package delivery service, but wants to be doing the deliveries.', 'movieImage/articdoga.jpg', 'https://www.youtube.com/watch?v=_2Wn0mwoJJA', 'Anjelica Huston, James Franco, Jeremy Renner, Alec Baldwin', NULL),
(50, 'Chhaava', '2025-02-14', 'Running Movies', 'Bollywood', 'Trending movie', 'After Chhatrapati Shivaji Maharaj`s death, the Mughals aim to expand into the Deccan, only to face his fearless son, Chhatrapati Sambhaji Maharaj. Chhaava, inspired by Shivaji Sawant`s novel, chronicles Chhatrapati Sambhaji Maharaj`s unwavering resistance against Aurangzeb, marked by courage, strategy, and betrayal.', 'movieImage/chaava.jpeg', 'https://youtu.be/77vRyWNqZjM?si=NbduUwODsOsF-PnC', 'Vicky Kaushal as Chhatrapati Sambhaji Maharaj\r\nRashmika Mandanna as Yesubai Bhonsale\r\nAkshaye Khanna as Aurangzeb\r\n', 'bannerImage/chava.jpg'),
(51, 'Mere Husband Ki Biwi', '2025-02-21', 'Running Movies', 'Bollywood', 'Trending movie', 'A lovelorn Delhi realtor, Ankur, finally finds new love after a bitter divorce. But when his amnesiac ex-wife, stuck in a blissful memory of their past, stumbles back into his life, Ankur is caught in a hilarious and heart-warming tug-of-war between past and present love, forcing him to navigate wedding plans and rekindled memories in a desperate bid to choose his future.', 'movieImage/merehusband.jpg', 'https://youtu.be/kPDPBU8eVuo?si=DO0B1QQi1J1a5owJ', 'Arjun Kapoor\r\nActor\r\nBhumi Pednekar\r\nActor\r\nRakul Preet Singh\r\nActor\r\nHarsh Gujral\r\nActor\r\nShakti Kapoor\r\nActor\r\nAnita Raj\r\nActor', 'bannerImage/merehusband.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `showtime`
--

CREATE TABLE `showtime` (
  `show_id` int(30) NOT NULL,
  `show_starttime` time DEFAULT NULL,
  `show_endtime` time DEFAULT NULL,
  `show_date` date DEFAULT NULL,
  `mov_id` int(30) DEFAULT NULL,
  `cin_id` int(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `showtime`
--

INSERT INTO `showtime` (`show_id`, `show_starttime`, `show_endtime`, `show_date`, `mov_id`, `cin_id`) VALUES
(155, '09:00:00', '12:00:00', '2025-02-23', 50, 8),
(156, '10:00:00', '01:00:00', '2025-02-24', 50, 8),
(157, '07:00:00', '10:00:00', '2025-02-23', 50, 9),
(158, '07:00:00', '10:00:00', '2025-02-23', 50, 8),
(159, '06:00:00', '09:00:00', '2025-02-23', 50, 9),
(160, '07:00:00', '10:00:00', '2025-02-24', 50, 11),
(161, '07:00:00', '10:00:00', '2025-02-24', 50, 10),
(162, '06:00:00', '09:00:00', '2025-02-24', 50, 9),
(163, '04:15:00', '07:30:00', '2025-02-23', 50, 10),
(164, '07:00:00', '10:00:00', '2025-02-23', 50, 11),
(165, '06:00:00', '09:00:00', '2025-02-23', 50, 11),
(166, '07:00:00', '10:00:00', '2025-02-25', 50, 8),
(167, '06:00:00', '09:00:00', '2025-02-26', 50, 11),
(168, '10:00:00', '01:00:00', '2025-02-27', 50, 10),
(169, '04:15:00', '07:30:00', '2025-02-25', 50, 9),
(170, '06:00:00', '09:00:00', '2025-02-25', 50, 10),
(171, '10:00:00', '01:00:00', '2025-02-25', 50, 11),
(172, '07:00:00', '10:00:00', '2025-02-26', 50, 8),
(173, '06:00:00', '09:00:00', '2025-02-26', 50, 9),
(174, '04:15:00', '07:30:00', '2025-02-26', 50, 10);

-- --------------------------------------------------------

--
-- Table structure for table `userlogin`
--

CREATE TABLE `userlogin` (
  `user_id` int(100) NOT NULL,
  `name` varchar(200) DEFAULT NULL,
  `username` varchar(200) DEFAULT NULL,
  `password` varchar(200) DEFAULT NULL,
  `email` varchar(200) DEFAULT NULL,
  `phone` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `userlogin`
--

INSERT INTO `userlogin` (`user_id`, `name`, `username`, `password`, `email`, `phone`) VALUES
(13, 'Harshkumar rana', 'Harsh810', '$2y$10$Rg7j7LHOQshsALQpVEquq.sjbUt8joQYWI44B13qU1pTy0OlCw6sO', 'hr810004@gmail.com', 2147483647),
(14, 'Rishi', 'Rishi4evr', '$2y$10$r.XIZy3BOmzwSVCq49EAquXtDBbSO6CCFRZDz5DkTjPtfD5/5hSuS', 'someone@example.com', 2147483647);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `adminlogin`
--
ALTER TABLE `adminlogin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`book_id`),
  ADD KEY `fk_book_cin` (`cin_id`),
  ADD KEY `fk_book_mov` (`mov_id`),
  ADD KEY `fk_book_user` (`user_id`),
  ADD KEY `fk_book_show` (`show_id`);

--
-- Indexes for table `cinema`
--
ALTER TABLE `cinema`
  ADD PRIMARY KEY (`cin_id`);

--
-- Indexes for table `movie`
--
ALTER TABLE `movie`
  ADD PRIMARY KEY (`mov_id`);

--
-- Indexes for table `showtime`
--
ALTER TABLE `showtime`
  ADD PRIMARY KEY (`show_id`),
  ADD KEY `fk_show_cin` (`cin_id`),
  ADD KEY `fk_show_mov` (`mov_id`);

--
-- Indexes for table `userlogin`
--
ALTER TABLE `userlogin`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `adminlogin`
--
ALTER TABLE `adminlogin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `booking`
--
ALTER TABLE `booking`
  MODIFY `book_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `cinema`
--
ALTER TABLE `cinema`
  MODIFY `cin_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `movie`
--
ALTER TABLE `movie`
  MODIFY `mov_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `showtime`
--
ALTER TABLE `showtime`
  MODIFY `show_id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=175;

--
-- AUTO_INCREMENT for table `userlogin`
--
ALTER TABLE `userlogin`
  MODIFY `user_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `booking`
--
ALTER TABLE `booking`
  ADD CONSTRAINT `fk_book_cin` FOREIGN KEY (`cin_id`) REFERENCES `cinema` (`cin_id`),
  ADD CONSTRAINT `fk_book_mov` FOREIGN KEY (`mov_id`) REFERENCES `movie` (`mov_id`),
  ADD CONSTRAINT `fk_book_show` FOREIGN KEY (`show_id`) REFERENCES `showtime` (`show_id`),
  ADD CONSTRAINT `fk_book_user` FOREIGN KEY (`user_id`) REFERENCES `userlogin` (`user_id`);

--
-- Constraints for table `showtime`
--
ALTER TABLE `showtime`
  ADD CONSTRAINT `fk_show_cin` FOREIGN KEY (`cin_id`) REFERENCES `cinema` (`cin_id`),
  ADD CONSTRAINT `fk_show_mov` FOREIGN KEY (`mov_id`) REFERENCES `movie` (`mov_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
