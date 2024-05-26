-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 26, 2024 at 04:22 AM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 8.0.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `auction`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `AdminID` int(2) NOT NULL,
  `Username` varchar(225) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Password` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`AdminID`, `Username`, `Email`, `Password`) VALUES
(1, 'Mithushan', 'smtn5431@gmial.com', 'Admin115');

-- --------------------------------------------------------

--
-- Table structure for table `auctionproducts`
--

CREATE TABLE `auctionproducts` (
  `auction_id` int(11) NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `status` enum('auction time','solved') DEFAULT 'auction time'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `auctionproducts`
--

INSERT INTO `auctionproducts` (`auction_id`, `product_id`, `price`, `start_date`, `end_date`, `status`) VALUES
(45, 17, '4500.00', '2024-05-20', '2024-05-22', 'solved'),
(47, 19, '1000.00', '2024-05-20', '2024-05-21', 'solved'),
(48, 18, '10800.00', '2024-05-22', '2024-05-25', 'solved'),
(52, 20, '1600.00', '2024-05-24', '2024-05-29', 'auction time'),
(54, 25, '110000.00', '2024-05-25', '2024-06-04', 'auction time');

-- --------------------------------------------------------

--
-- Table structure for table `auction_users`
--

CREATE TABLE `auction_users` (
  `id` int(11) NOT NULL,
  `buyer_id` int(11) NOT NULL,
  `auction_id` int(11) NOT NULL,
  `price` float NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `auction_users`
--

INSERT INTO `auction_users` (`id`, `buyer_id`, `auction_id`, `price`, `date`) VALUES
(27, 8, 52, 1000, '2024-05-24 11:57:56'),
(28, 8, 48, 10500, '2024-05-24 15:14:23'),
(29, 5, 52, 1200, '2024-05-24 15:15:00'),
(30, 5, 48, 10800, '2024-05-24 15:15:13'),
(31, 8, 52, 1500, '2024-05-24 15:16:21'),
(34, 11, 52, 1600, '2024-05-25 05:00:30'),
(35, 5, 54, 110000, '2024-05-25 05:26:57');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `seller_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `reserve_price` decimal(10,2) NOT NULL,
  `currentCondition` varchar(50) NOT NULL,
  `delivery_type` varchar(50) NOT NULL,
  `category` varchar(100) NOT NULL,
  `days` int(11) NOT NULL,
  `city` varchar(100) NOT NULL,
  `area` varchar(20) NOT NULL,
  `description` text NOT NULL,
  `admin_approve_status` enum('pending','approved','rejected') DEFAULT 'pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `seller_id`, `title`, `reserve_price`, `currentCondition`, `delivery_type`, `category`, `days`, `city`, `area`, `description`, `admin_approve_status`, `created_at`) VALUES
(17, 4, 'Camera', '4000.00', 'used', 'collection', 'electronics', 2, 'Jaffna', 'kondavil', 'A camera is an instrument used to capture and store images and videos, either digitally via an electronic image sensor', 'approved', '2024-05-18 15:37:44'),
(18, 1, 'LCD Monitor', '10000.00', 'used', 'collection', 'electronics', 3, 'Jaffna', 'kondavil', '12 Inch 1024x768 800x600 Industrial LCD Monitor Display For CCTV Car DVR Microscope Camera Built-In Speaker', 'approved', '2024-05-19 01:14:57'),
(19, 2, 'Ponniyin Selvan (பொன்னியின் செல்வன்) full collection', '1000.00', 'new', 'delivery', 'arts', 1, 'vavuniya', 'pandarikulam', 'Ponniyin Selvan is a Tamil historical fiction novel written by Kalki based on real events. It narrates the story of Arulmozhivarman\r\nset of 5 volumes.', 'approved', '2024-05-19 01:36:30'),
(20, 4, 'முள்ளில்லா வேலி', '500.00', 'new', 'collection', 'arts', 5, 'vavuniya', 'kondavil', 'முள்ளில்லா வேலி| என்ற இந்த நூல் நெடுந்தீவு மக்களின் வாழ்வியலின் ஒரு அம்சத்தைப் பிரதிபலிக்கிறது.  நெடுந்தீவு மக்களின் நாட்டார் பாடல்கள்', 'approved', '2024-05-19 01:51:02'),
(22, 1, 'desk computer', '5000.00', 'new', 'collection', 'electronics', 5, 'Jaffna', 'kondavil', 'PayLessHere Computer Desk 39 in Length Study Writing Table, Adjustable feet, Modern Furniture for Home Office, Nature ... Gaming Desk Computer Desk 47 Inch Home', 'rejected', '2024-05-19 03:01:53'),
(23, 7, 'Watch', '1000000.00', 'new', 'delivery', 'fashion', 5, 'Jaffna', 'Nallur', 'Hiii', 'rejected', '2024-05-22 10:13:03'),
(24, 8, 'Appa', '10.00', 'used', 'collection', 'wares', 10, 'Jaffna', 'Kondavil', 'Kanchaa kudukkii ,lavede kebal ', 'rejected', '2024-05-22 10:19:00'),
(25, 11, 'Computer', '100000.00', 'used', 'collection', 'electronics', 10, 'Jaffna', 'pointpedro', 'A personal computer (PC) is a digital device designed for personal purposes, such as working, studying, gaming, and browsing the internet.', 'approved', '2024-05-25 05:22:55');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `Name` varchar(100) DEFAULT NULL,
  `Email` varchar(255) NOT NULL,
  `Password` varchar(20) DEFAULT NULL,
  `AddressL` varchar(255) DEFAULT NULL,
  `City` varchar(255) DEFAULT NULL,
  `Zipcode` int(5) DEFAULT NULL,
  `ProfilepicName` varchar(255) NOT NULL,
  `Usertype` int(1) DEFAULT NULL,
  `Status` tinyint(1) DEFAULT NULL,
  `NICnumber` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `Name`, `Email`, `Password`, `AddressL`, `City`, `Zipcode`, `ProfilepicName`, `Usertype`, `Status`, `NICnumber`) VALUES
(1, 'Theva', 'jeyaraja.thevaraja16@gmail.com', 'rajaTheva16!', 'gulabemillroad, pandarikulam', 'vavuniya', 43000, 'uploads/IMG_3531.JPG', 3, 1, '200104700779'),
(2, 'purus', 'purus5718@gmail.com', 'Black01^', 'kokuvil, jaffna', 'jaffna', 40000, 'uploads/IMG_3343.JPG', 2, 1, '200135100984'),
(3, 'Admin', 'rasalingamkugatharshan15@gmail.com', 'SMtn#115', 'gulabemillroad, pandarikulam', 'vavuniya', 43000, 'uploads/ATI02.PNG', 4, 1, '991973419V'),
(4, 'Sathu', 'sathusathurjan2001@gmail.com', 'Sathur456@', 'Kopay center, kopay', 'jaffna', 40000, 'uploads/IMG_3370.JPG', 2, 1, '200102900649'),
(5, 'Mithushan', 'ssmithushan115@gmail.com', 'mithu#shan115', 'gulabemillroad, pandarikulam', 'jaffna', 43000, 'uploads/ATI02.PNG', 3, 1, '200010501470'),
(6, 'Nitharsan', 'niththav2001@gmail.com', '#Niththa08', 'Urumpirai, Amman road', 'jaffna', 40000, 'uploads/IMG_0303.jpeg', 3, 1, '200119000793'),
(7, 'Shanuja', 'rshanushanuja@gmail.com', '12345', 'Chemmany road, Nallur', 'Jaffna', 40000, 'uploads/IMG-20240505-WA0035.jpg', 1, 1, '200158601466'),
(8, 'A.Kishani', 'akishakishani99@gmail.com', 'kisha0099', 'Gurunagar, Jaffna', 'Jaffna', 40000, 'uploads/eafd9a78-0ff1-4c81-8cee-9b212e8f8dab.jpeg', 1, 1, '996290468v'),
(10, 'Mithushan', 'mithu@gmail.com', '123456~h', 'no98, kondavil', 'Jaffna', 40000, 'uploads/IMG_0970.jpg', 3, 1, '200010501748'),
(11, 'panu', 'passhanth28@gmail.com', 'panu123', 'Alvai, Pointpedro', 'jaffna', 40000, 'uploads/WhatsApp Image 2024-05-05 at 5.30.00 PM.jpeg', 1, 1, '200027200383');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`AdminID`);

--
-- Indexes for table `auctionproducts`
--
ALTER TABLE `auctionproducts`
  ADD PRIMARY KEY (`auction_id`),
  ADD UNIQUE KEY `product_id` (`product_id`);

--
-- Indexes for table `auction_users`
--
ALTER TABLE `auction_users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `buyer_id` (`buyer_id`),
  ADD KEY `auction_id` (`auction_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `seller_id` (`seller_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `Email` (`Email`),
  ADD UNIQUE KEY `NICnumber` (`NICnumber`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `AdminID` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `auctionproducts`
--
ALTER TABLE `auctionproducts`
  MODIFY `auction_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `auction_users`
--
ALTER TABLE `auction_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `auctionproducts`
--
ALTER TABLE `auctionproducts`
  ADD CONSTRAINT `auctionproducts_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`);

--
-- Constraints for table `auction_users`
--
ALTER TABLE `auction_users`
  ADD CONSTRAINT `auction_users_ibfk_1` FOREIGN KEY (`buyer_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `auction_users_ibfk_2` FOREIGN KEY (`auction_id`) REFERENCES `auctionproducts` (`auction_id`);

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`seller_id`) REFERENCES `users` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
