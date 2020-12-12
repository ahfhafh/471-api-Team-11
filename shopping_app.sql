-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 12, 2020 at 12:04 AM
-- Server version: 8.0.17
-- PHP Version: 7.3.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shopping_app`
--

-- --------------------------------------------------------

--
-- Table structure for table `accesses`
--

CREATE TABLE `accesses` (
  `accesses_id` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `store_id` int(11) DEFAULT NULL,
  `item_obtained` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `accesses`
--

INSERT INTO `accesses` (`accesses_id`, `admin_id`, `store_id`, `item_obtained`) VALUES
(1, 1, 1, 1),
(2, 1, 1, 1),
(6, 1, 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `email` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `email`) VALUES
(1, 'admin.1@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `department_id` int(11) NOT NULL,
  `name` varchar(45) DEFAULT NULL,
  `store` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`department_id`, `name`, `store`) VALUES
(1, 'Department 3', 1),
(2, 'Not a department', 1),
(4, 'Department 3', 2);

-- --------------------------------------------------------

--
-- Table structure for table `discount`
--

CREATE TABLE `discount` (
  `discount_id` int(11) NOT NULL,
  `store` int(11) NOT NULL,
  `item_id` int(11) DEFAULT NULL,
  `name` varchar(45) DEFAULT NULL,
  `date_end` date DEFAULT NULL,
  `owner` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `discount`
--

INSERT INTO `discount` (`discount_id`, `store`, `item_id`, `name`, `date_end`, `owner`) VALUES
(1, 1, 2, '25% off beverages', '2020-12-11', 'User1.One'),
(4, 1, 2, 'scam', '2020-12-11', 'User1.One'),
(5, 1, 2, 'Not a scam', '2020-12-11', 'User1.One');

-- --------------------------------------------------------

--
-- Table structure for table `inventory`
--

CREATE TABLE `inventory` (
  `inventory_id` int(11) NOT NULL,
  `item_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `inventory`
--

INSERT INTO `inventory` (`inventory_id`, `item_id`) VALUES
(1, 1),
(4, 1),
(2, 2);

-- --------------------------------------------------------

--
-- Table structure for table `item`
--

CREATE TABLE `item` (
  `item_id` int(11) NOT NULL,
  `brand` varchar(45) DEFAULT NULL,
  `price` float DEFAULT NULL,
  `description` varchar(45) DEFAULT NULL,
  `in_stock` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `type` int(11) DEFAULT NULL,
  `section` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `item`
--

INSERT INTO `item` (`item_id`, `brand`, `price`, `description`, `in_stock`, `type`, `section`) VALUES
(1, 'Nestle', 12.99, 'coffee', 'Y', 1, 'Beverages'),
(2, 'Lays', 5.99, 'chips', 'Y', 1, 'Beverages'),
(3, 'Pepsi', 2.98, 'not coke', 'Y', 1, 'Beverages'),
(4, 'Coca-cola', 2.99, 'coke', 'Y', 1, 'Beverages'),
(5, 'Coca-cola', 2.98, 'coke', 'Y', 4, 'Beverages'),
(6, 'Coca-cola', 5, 'coke', 'Y', 4, 'Beverages');

-- --------------------------------------------------------

--
-- Table structure for table `promotion`
--

CREATE TABLE `promotion` (
  `promotion_id` int(11) NOT NULL,
  `date` date DEFAULT NULL,
  `name` varchar(45) DEFAULT NULL,
  `item` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `promotion`
--

INSERT INTO `promotion` (`promotion_id`, `date`, `name`, `item`) VALUES
(1, '2020-12-24', 'Beverage 25% off', 1),
(2, '2020-12-24', 'Beverages 25% off', 3),
(3, '2020-12-24', 'Snacks 25% off', 2),
(5, '2020-12-31', 'Snacks BOGO store wide', 2);

-- --------------------------------------------------------

--
-- Table structure for table `section`
--

CREATE TABLE `section` (
  `name` varchar(45) NOT NULL,
  `inventory` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `section`
--

INSERT INTO `section` (`name`, `inventory`) VALUES
('Beverages', 1),
('Snacks', 1),
('Socks', 2);

-- --------------------------------------------------------

--
-- Table structure for table `shopper`
--

CREATE TABLE `shopper` (
  `username` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `lists` int(11) DEFAULT NULL,
  `shopper_email` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `shopper`
--

INSERT INTO `shopper` (`username`, `lists`, `shopper_email`) VALUES
('User1.One', 1, 'user1.one@gmail.com'),
('User2.Two', 2, 'user2.two@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `shopping_list`
--

CREATE TABLE `shopping_list` (
  `list_id` int(11) NOT NULL,
  `name` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `shopping_list`
--

INSERT INTO `shopping_list` (`list_id`, `name`) VALUES
(1, 'The list'),
(2, 'List 2'),
(3, 'General List');

-- --------------------------------------------------------

--
-- Table structure for table `shopping_list_items`
--

CREATE TABLE `shopping_list_items` (
  `id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `list_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `shopping_list_items`
--

INSERT INTO `shopping_list_items` (`id`, `item_id`, `list_id`) VALUES
(1, 2, 1),
(2, 1, 1),
(3, 5, 1),
(4, 5, 1);

-- --------------------------------------------------------

--
-- Table structure for table `store`
--

CREATE TABLE `store` (
  `store_id` int(11) NOT NULL,
  `location` varchar(45) DEFAULT NULL,
  `name` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `store`
--

INSERT INTO `store` (`store_id`, `location`, `name`) VALUES
(1, 'south west', 'Walmart'),
(2, 'south', 'Sobeys'),
(3, 'North', 'Co-op');

-- --------------------------------------------------------

--
-- Table structure for table `updates`
--

CREATE TABLE `updates` (
  `item_added` int(11) NOT NULL,
  `inventory` int(11) DEFAULT NULL,
  `admin_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `updates`
--

INSERT INTO `updates` (`item_added`, `inventory`, `admin_id`) VALUES
(1, 1, 1),
(2, 2, 1),
(3, 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `email` varchar(45) NOT NULL,
  `Fname` varchar(45) DEFAULT NULL,
  `Lname` varchar(45) DEFAULT NULL,
  `phone` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`email`, `Fname`, `Lname`, `phone`) VALUES
('admin.1@gmail.com', 'Admin', 'One', 0),
('user1.one@gmail.com', 'User1', 'One', 1),
('user2.two@gmail.com', 'User2', 'Two', 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accesses`
--
ALTER TABLE `accesses`
  ADD PRIMARY KEY (`accesses_id`),
  ADD KEY `admin_id` (`admin_id`),
  ADD KEY `store_id` (`store_id`),
  ADD KEY `item_obtained` (`item_obtained`);

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`),
  ADD KEY `email` (`email`);

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`department_id`),
  ADD KEY `store` (`store`);

--
-- Indexes for table `discount`
--
ALTER TABLE `discount`
  ADD PRIMARY KEY (`discount_id`),
  ADD KEY `owner` (`owner`) USING BTREE,
  ADD KEY `item_id` (`item_id`) USING BTREE,
  ADD KEY `store_id` (`store`) USING BTREE;

--
-- Indexes for table `inventory`
--
ALTER TABLE `inventory`
  ADD PRIMARY KEY (`inventory_id`),
  ADD KEY `item_id` (`item_id`);

--
-- Indexes for table `item`
--
ALTER TABLE `item`
  ADD PRIMARY KEY (`item_id`),
  ADD KEY `type` (`type`),
  ADD KEY `section` (`section`);

--
-- Indexes for table `promotion`
--
ALTER TABLE `promotion`
  ADD PRIMARY KEY (`promotion_id`),
  ADD KEY `item` (`item`);

--
-- Indexes for table `section`
--
ALTER TABLE `section`
  ADD PRIMARY KEY (`name`),
  ADD KEY `inventory` (`inventory`);

--
-- Indexes for table `shopper`
--
ALTER TABLE `shopper`
  ADD PRIMARY KEY (`username`),
  ADD UNIQUE KEY `shopper_email` (`shopper_email`) USING BTREE,
  ADD KEY `lists` (`lists`);

--
-- Indexes for table `shopping_list`
--
ALTER TABLE `shopping_list`
  ADD PRIMARY KEY (`list_id`);

--
-- Indexes for table `shopping_list_items`
--
ALTER TABLE `shopping_list_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `item_id` (`item_id`),
  ADD KEY `list_id` (`list_id`);

--
-- Indexes for table `store`
--
ALTER TABLE `store`
  ADD PRIMARY KEY (`store_id`);

--
-- Indexes for table `updates`
--
ALTER TABLE `updates`
  ADD PRIMARY KEY (`item_added`),
  ADD KEY `inventory` (`inventory`),
  ADD KEY `admin_id` (`admin_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accesses`
--
ALTER TABLE `accesses`
  MODIFY `accesses_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `department_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `discount`
--
ALTER TABLE `discount`
  MODIFY `discount_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `inventory`
--
ALTER TABLE `inventory`
  MODIFY `inventory_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `item`
--
ALTER TABLE `item`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `promotion`
--
ALTER TABLE `promotion`
  MODIFY `promotion_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `shopping_list`
--
ALTER TABLE `shopping_list`
  MODIFY `list_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `shopping_list_items`
--
ALTER TABLE `shopping_list_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `store`
--
ALTER TABLE `store`
  MODIFY `store_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `updates`
--
ALTER TABLE `updates`
  MODIFY `item_added` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `accesses`
--
ALTER TABLE `accesses`
  ADD CONSTRAINT `admin_id_fk` FOREIGN KEY (`admin_id`) REFERENCES `admin` (`admin_id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `item_id_fk` FOREIGN KEY (`item_obtained`) REFERENCES `item` (`item_id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `store_id_fk` FOREIGN KEY (`store_id`) REFERENCES `store` (`store_id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `admin`
--
ALTER TABLE `admin`
  ADD CONSTRAINT `admin_email_fk` FOREIGN KEY (`email`) REFERENCES `user` (`email`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `department`
--
ALTER TABLE `department`
  ADD CONSTRAINT `store_fk` FOREIGN KEY (`store`) REFERENCES `store` (`store_id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `discount`
--
ALTER TABLE `discount`
  ADD CONSTRAINT `discount_item_id_fk` FOREIGN KEY (`item_id`) REFERENCES `item` (`item_id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `discount_owner_fk` FOREIGN KEY (`owner`) REFERENCES `shopper` (`username`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `discount_store_fk` FOREIGN KEY (`store`) REFERENCES `store` (`store_id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `inventory`
--
ALTER TABLE `inventory`
  ADD CONSTRAINT `item_id_inv_fk` FOREIGN KEY (`item_id`) REFERENCES `updates` (`item_added`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `item`
--
ALTER TABLE `item`
  ADD CONSTRAINT `section_fk` FOREIGN KEY (`section`) REFERENCES `section` (`name`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `type_fk` FOREIGN KEY (`type`) REFERENCES `department` (`department_id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `promotion`
--
ALTER TABLE `promotion`
  ADD CONSTRAINT `item_fk` FOREIGN KEY (`item`) REFERENCES `item` (`item_id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `section`
--
ALTER TABLE `section`
  ADD CONSTRAINT `inventory_section_fk` FOREIGN KEY (`inventory`) REFERENCES `inventory` (`inventory_id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `shopping_list_items`
--
ALTER TABLE `shopping_list_items`
  ADD CONSTRAINT `sli_item_fk` FOREIGN KEY (`item_id`) REFERENCES `item` (`item_id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `sli_list_fk` FOREIGN KEY (`list_id`) REFERENCES `shopping_list` (`list_id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `updates`
--
ALTER TABLE `updates`
  ADD CONSTRAINT `admin_id_update_fk` FOREIGN KEY (`admin_id`) REFERENCES `admin` (`admin_id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `inventory_fk` FOREIGN KEY (`inventory`) REFERENCES `inventory` (`inventory_id`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
