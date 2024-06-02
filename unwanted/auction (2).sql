-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 13, 2024 at 07:13 AM
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
  `end_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `auctionproducts`
--

INSERT INTO `auctionproducts` (`auction_id`, `product_id`, `price`, `start_date`, `end_date`) VALUES
(35, 11, '12000.00', '2024-05-07', '2024-06-01'),
(37, 12, '300000.00', '2024-05-07', '2024-05-26'),
(38, 13, '65500.00', '2024-05-07', '2024-05-28'),
(39, 14, '60800.00', '2024-05-07', '2024-05-12');

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
(2, 4, 35, 10500, '2024-05-07 07:17:36'),
(3, 4, 39, 5500, '2024-05-07 07:18:35'),
(4, 5, 39, 6000, '2024-05-10 06:07:11'),
(5, 2, 35, 10800, '2024-05-11 15:38:14'),
(6, 5, 38, 65500, '2024-05-12 09:24:07'),
(7, 2, 39, 60500, '2024-05-12 09:58:22'),
(8, 2, 39, 60500, '2024-05-12 09:59:26'),
(9, 2, 39, 60500, '2024-05-12 09:59:42'),
(10, 2, 39, 60800, '2024-05-12 10:00:13'),
(11, 2, 35, 11000, '2024-05-12 16:51:45'),
(12, 4, 35, 12000, '2024-05-12 16:51:57');

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
  `image_folder_name` varchar(255) NOT NULL,
  `admin_approve_status` enum('pending','approved','rejected') DEFAULT 'pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `seller_id`, `title`, `reserve_price`, `currentCondition`, `delivery_type`, `category`, `days`, `city`, `area`, `description`, `image_folder_name`, `admin_approve_status`, `created_at`) VALUES
(11, 5, 'High End Modmo Electric Bikes', '10000.00', 'used', 'collection', 'electronics', 25, 'Jaffna', 'kondavil', 'High End Modmo Electric Bikes | Clearance Prices | Overstock Liquidation Sale', 'High End Modmo Electric Bikes', 'approved', '2024-04-24 09:54:24'),
(12, 2, 'ACER 58GM-50AQ-13th Gen Intel Core i5 Laptop', '300000.00', 'new', 'collection', 'electronics', 19, 'Jaffna', 'kondavil', ' Brand	 ACER\r\n Processor	 Intel 13th Gen i5\r\n Display	 15.6\" FHD IPS SlimBezel\r\n Gen 	 13th Gen\r\n OS	 Windows 11 Home Single Language\r\n RAM	 8 GB DDR4 Memory\r\n GRAPHIC	 NVIDIA® GeForce RTX™ 2050\r\n VRAM	 4G-GDDR6\r\n Storage Type 	 512GB PCIe NVMe SSD\r\n Backlit Keyboard 	 Backlit KB\r\n Warranty 	 2 Years(System) , 1 year (Battery & Adapter)  ', 'ACER 58GM-50AQ-13th Gen Intel Core i5 Laptop', 'approved', '2024-04-27 07:28:25'),
(13, 1, 'i phone x (2019)', '65000.00', 'used', 'collection', 'electronics', 21, 'Jaffna', 'urumpirai', ' 5.8\" Retina-Display, 12 MP Camera, up to 256GB ✓ refurbished\r\n', 'i phone x (2019)', 'approved', '2024-04-28 14:47:47'),
(14, 1, 'Computer Table', '5000.00', 'used', 'delivery', 'arts', 5, 'Jaffna', 'kondavil', 'Modern computer table for efficient workspace. Sleek design, sturdy construction', 'Computer Table', 'approved', '2024-05-06 09:41:31'),
(15, 5, 'camera', '6465.00', 'new', 'collection', 'electronics', 3, 'Jaffna', 'kondavil', ' vrgwethbv tyjnh etvnte tm eb en tyj', 'camera', 'pending', '2024-05-06 19:27:23');

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
(5, 'Mithushan', 'ssmithushan115@gmail.com', 'Mithu~shan115', 'gulabemillroad, pandarikulam', 'jaffna', 43000, 'uploads/ATI02.PNG', 3, 1, '200010501470');

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
  MODIFY `auction_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `auction_users`
--
ALTER TABLE `auction_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

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
