-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 25, 2020 at 05:49 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `chobani`
--

-- --------------------------------------------------------

--
-- Table structure for table `meals`
--

CREATE TABLE `meals` (
  `meal_id` int(11) NOT NULL,
  `meal_name` varchar(100) NOT NULL,
  `meal_price` decimal(8,2) NOT NULL,
  `meal_rating` decimal(9,1) NOT NULL,
  `meal_picture_name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `meals`
--

INSERT INTO `meals` (`meal_id`, `meal_name`, `meal_price`, `meal_rating`, `meal_picture_name`) VALUES
(1, 'Salad with tomatoes', '1.99', '3.0', ''),
(2, 'Fried chips', '2.49', '4.0', ''),
(3, 'Roastbeef and baked potatoes', '18.99', '3.0', ''),
(4, 'Chinese rice', '9.99', '3.0', ''),
(5, 'Indian rice', '12.99', '4.0', ''),
(6, 'Thai rice', '14.99', '5.0', ''),
(7, 'Coke', '1.99', '3.0', ''),
(8, 'Fanta', '1.99', '5.0', ''),
(9, 'Beer', '4.99', '2.0', ''),
(10, 'Sprite', '1.99', '4.0', ''),
(11, 'Water', '0.99', '4.0', ''),
(12, 'Tiramisù', '8.99', '5.0', ''),
(13, 'Pizza margherita', '5.99', '4.0', '');

-- --------------------------------------------------------

--
-- Table structure for table `meals_menus`
--

CREATE TABLE `meals_menus` (
  `mealmenumap_id` int(11) NOT NULL,
  `meal_id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `meals_menus`
--

INSERT INTO `meals_menus` (`mealmenumap_id`, `meal_id`, `menu_id`) VALUES
(1, 9, 1),
(2, 7, 1),
(3, 8, 1),
(4, 10, 1),
(5, 11, 1),
(6, 6, 1),
(7, 12, 1),
(8, 5, 2),
(9, 7, 2),
(10, 4, 3),
(11, 2, 3),
(12, 9, 3),
(13, 5, 3),
(14, 2, 3),
(15, 9, 3),
(16, 6, 3),
(17, 2, 3),
(18, 9, 3);

-- --------------------------------------------------------

--
-- Table structure for table `menus`
--

CREATE TABLE `menus` (
  `menu_id` int(11) NOT NULL,
  `menu_name` varchar(50) NOT NULL,
  `menu_description` varchar(255) NOT NULL,
  `menu_price` decimal(8,2) NOT NULL,
  `menu_rating` decimal(9,0) NOT NULL,
  `menu_picture_name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `menus`
--

INSERT INTO `menus` (`menu_id`, `menu_name`, `menu_description`, `menu_price`, `menu_rating`, `menu_picture_name`) VALUES
(1, 'Thai rice special', '2x Thai rice dishes + 2x water/coke/fanta/sprite or 1x water and 1x beer + 1x dessert of your choice!', '32.99', '5', 'thai-rice'),
(2, 'Indian rice + coke', 'If you order Indian rice dish and a can of coke you pay the coke only 1$', '13.99', '4', 'indian-rice'),
(3, 'Rice + chips + beer', 'Get a total discount of 2$ if you order this combination of meals', '15.99', '3', 'generic-rice');

-- --------------------------------------------------------

--
-- Table structure for table `menus_orders`
--

CREATE TABLE `menus_orders` (
  `order_id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL,
  `amount` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `menus_orders`
--

INSERT INTO `menus_orders` (`order_id`, `menu_id`, `amount`) VALUES
(3, 1, 2),
(4, 1, 1),
(4, 2, 2),
(4, 3, 3),
(5, 1, 3),
(5, 2, 5),
(5, 3, 5),
(6, 1, 3),
(6, 2, 5),
(6, 3, 5),
(7, 1, 2),
(7, 2, 2),
(7, 3, 3);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `order_date` date NOT NULL,
  `order_time` time NOT NULL,
  `order_price` decimal(8,2) NOT NULL,
  `order_datetime` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `user_id`, `order_date`, `order_time`, `order_price`, `order_datetime`) VALUES
(2, 1, '2020-09-25', '16:15:00', '131.96', '2020-09-25 16:15:46'),
(3, 1, '2020-09-25', '16:16:00', '65.98', '2020-09-25 16:16:43'),
(4, 3, '2020-09-25', '16:17:00', '108.94', '2020-09-25 16:17:35'),
(5, 1, '2020-10-03', '16:23:00', '248.87', '2020-09-25 16:18:51'),
(6, 1, '2020-10-03', '16:23:00', '248.87', '2020-09-25 16:24:27'),
(7, 6, '2020-09-25', '16:43:00', '141.93', '2020-09-25 16:37:48');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `first_name` varchar(30) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `email` varchar(150) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone` varchar(10) NOT NULL,
  `address` varchar(200) NOT NULL,
  `profile_pic` varchar(15) NOT NULL DEFAULT 'placeholder',
  `review` varchar(1000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `first_name`, `last_name`, `email`, `password`, `phone`, `address`, `profile_pic`, `review`) VALUES
(1, 'Ali', 'Taqi', 'alitaqi@gmail.com', 'password', '0123456789', '70  City Walls', '1', 'Food was great, service was a bit slow'),
(2, 'Richard', 'Moore', 'rmoore@protonmail.ch', 'Sarah1405', '0123456789', '1430  Poe Road', '2', 'Awesome quality for the price!'),
(3, 'Chiraq', 'Eleira', 'chirra56@outlook.com', 'u30hie6kq4d', '0123456789', '3323  Lincoln Street', '3', 'Both me and my wife loved it, will definitely visit again'),
(4, 'Michele', 'Micheli', 'brigante97@live.it', 'abgk576asbi0', '0123456789', 'Via XX Settembre 48', '4', 'Maybe a bit expensive, but the food was great'),
(5, 'Elizabeth ', 'Hicks', 'elihicks@harvard.uk', 'intothestorm1990', '0123456789', '4253  Tavern Place', 'placeholder', 'I had a good dinner with my students'),
(6, 'Paolo', 'Catanzaro', 'paoloilpazzo@gmail.it', 'catanzaro41', '0123456789', 'Via Ricca 18', 'placeholder', NULL),
(7, 'Beatrice', 'Lavatrice', 'bealava@montale.edu', 'beatric3', '0123456789', 'Via Maccaggi 56', 'placeholder', 'I didn\'t like the food at all and I will never visit this place again. Not recommended!');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `meals`
--
ALTER TABLE `meals`
  ADD PRIMARY KEY (`meal_id`);

--
-- Indexes for table `meals_menus`
--
ALTER TABLE `meals_menus`
  ADD PRIMARY KEY (`mealmenumap_id`),
  ADD KEY `meal_id` (`meal_id`),
  ADD KEY `menu_id` (`menu_id`);

--
-- Indexes for table `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`menu_id`);

--
-- Indexes for table `menus_orders`
--
ALTER TABLE `menus_orders`
  ADD PRIMARY KEY (`order_id`,`menu_id`),
  ADD KEY `menu_id` (`menu_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `meals`
--
ALTER TABLE `meals`
  MODIFY `meal_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `meals_menus`
--
ALTER TABLE `meals_menus`
  MODIFY `mealmenumap_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `menus`
--
ALTER TABLE `menus`
  MODIFY `menu_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `meals_menus`
--
ALTER TABLE `meals_menus`
  ADD CONSTRAINT `meals_menus_ibfk_1` FOREIGN KEY (`meal_id`) REFERENCES `meals` (`meal_id`),
  ADD CONSTRAINT `meals_menus_ibfk_2` FOREIGN KEY (`menu_id`) REFERENCES `menus` (`menu_id`);

--
-- Constraints for table `menus_orders`
--
ALTER TABLE `menus_orders`
  ADD CONSTRAINT `menus_orders_ibfk_1` FOREIGN KEY (`menu_id`) REFERENCES `menus` (`menu_id`),
  ADD CONSTRAINT `menus_orders_ibfk_2` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
