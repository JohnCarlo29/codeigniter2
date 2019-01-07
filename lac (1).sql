-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 11, 2018 at 04:25 PM
-- Server version: 10.1.32-MariaDB
-- PHP Version: 7.2.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lac`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `category` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `category`) VALUES
(2, 'Pharmaceutical'),
(3, 'Facilities Supplies');

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `id` int(11) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `mi` varchar(1) NOT NULL,
  `address` text NOT NULL,
  `contact` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`id`, `lastname`, `firstname`, `mi`, `address`, `contact`) VALUES
(1, 'cuaresma', 'amado raul', 'c', 'bilibid gilid lang', '09977114455 / 888-5454');

-- --------------------------------------------------------

--
-- Table structure for table `grooming_revenue`
--

CREATE TABLE `grooming_revenue` (
  `id` int(11) NOT NULL,
  `invoice_no` varchar(11) NOT NULL,
  `grooming_id` int(11) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `pet` varchar(255) NOT NULL,
  `groomer` varchar(255) DEFAULT NULL,
  `date_availed` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `grooming_revenue`
--

INSERT INTO `grooming_revenue` (`id`, `invoice_no`, `grooming_id`, `owner`, `pet`, `groomer`, `date_availed`) VALUES
(1, 'S-201805301', 3, '1', '1', 'gemmar', '2018-05-30'),
(2, 'S-201805301', 3, '1', '1', 'gemmar', '2018-05-30');

-- --------------------------------------------------------

--
-- Table structure for table `grooming_services`
--

CREATE TABLE `grooming_services` (
  `id` int(11) NOT NULL,
  `type` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `grooming_services`
--

INSERT INTO `grooming_services` (`id`, `type`, `description`, `price`) VALUES
(3, 'service 1', 'kalbo pwera pwet', '200.00');

-- --------------------------------------------------------

--
-- Table structure for table `health_services`
--

CREATE TABLE `health_services` (
  `id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `pet_id` int(11) NOT NULL,
  `service` varchar(255) NOT NULL,
  `complaint` text NOT NULL,
  `diagnosis` text,
  `recommendation` text,
  `medication` text NOT NULL,
  `prescribe` text NOT NULL,
  `blood` varchar(255) NOT NULL,
  `distemper` varchar(255) NOT NULL,
  `parvo` varchar(255) NOT NULL,
  `ehrlichia` varchar(255) NOT NULL,
  `heartworm` varchar(255) NOT NULL,
  `ultrasound` varchar(255) NOT NULL,
  `urine` varchar(255) NOT NULL,
  `vaginal_smear` varchar(255) NOT NULL,
  `xrays` varchar(255) NOT NULL,
  `skin_scrapping` varchar(255) NOT NULL,
  `ear_swabbing` varchar(255) NOT NULL,
  `stool` varchar(255) NOT NULL,
  `other_test` varchar(255) NOT NULL,
  `date_admit` date NOT NULL,
  `date_release` date NOT NULL,
  `fee` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `health_services`
--

INSERT INTO `health_services` (`id`, `client_id`, `pet_id`, `service`, `complaint`, `diagnosis`, `recommendation`, `medication`, `prescribe`, `blood`, `distemper`, `parvo`, `ehrlichia`, `heartworm`, `ultrasound`, `urine`, `vaginal_smear`, `xrays`, `skin_scrapping`, `ear_swabbing`, `stool`, `other_test`, `date_admit`, `date_release`, `fee`) VALUES
(1, 1, 1, 'Check-up', 'nagtatae', 'nagtatae', 'pasok ang banana sa pwet', 'banana', 'banana na mahaba', '', '', '', '', '', '', '', '', '', '', '', '', '', '2018-05-30', '2018-05-30', '2500');

-- --------------------------------------------------------

--
-- Table structure for table `orderitems`
--

CREATE TABLE `orderitems` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `total_order` varchar(255) NOT NULL,
  `ordered_date` date NOT NULL,
  `received_date` date NOT NULL,
  `received` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orderitems`
--

INSERT INTO `orderitems` (`id`, `product_id`, `supplier_id`, `quantity`, `total_order`, `ordered_date`, `received_date`, `received`) VALUES
(1, 1, 1, 5, '35', '2018-05-17', '2018-05-17', 1);

-- --------------------------------------------------------

--
-- Table structure for table `pets`
--

CREATE TABLE `pets` (
  `id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `breed` varchar(255) NOT NULL,
  `sex` varchar(255) NOT NULL,
  `birthday` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pets`
--

INSERT INTO `pets` (`id`, `client_id`, `name`, `breed`, `sex`, `birthday`) VALUES
(1, 1, 'ronald', 'shitzu', 'male', '2018-01-05');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `sku` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `category_id` int(11) NOT NULL,
  `initial_price` decimal(10,0) DEFAULT NULL,
  `price` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `sku`, `name`, `description`, `category_id`, `initial_price`, `price`) VALUES
(1, '12345', 'product 1', 'tablet', 3, '5', '7');

-- --------------------------------------------------------

--
-- Table structure for table `retail`
--

CREATE TABLE `retail` (
  `id` int(11) NOT NULL,
  `invoice_no` varchar(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `subtotal` decimal(10,0) NOT NULL,
  `customer` varchar(255) NOT NULL DEFAULT 'Clinic Customer',
  `purchased_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `retail`
--

INSERT INTO `retail` (`id`, `invoice_no`, `product_id`, `quantity`, `subtotal`, `customer`, `purchased_date`) VALUES
(1, '1', 1, 0, '0', '', '0000-00-00'),
(2, '201805201', 1, 0, '0', '', '0000-00-00'),
(3, '201805202', 1, 1, '7', '', '2018-05-20'),
(4, '201805202', 1, 2, '14', '', '2018-05-20'),
(5, '201805203', 1, 1, '7', '', '2018-05-20'),
(6, '201805203', 1, 1, '7', '', '2018-05-20'),
(7, '201805203', 1, 1, '7', '', '2018-05-20'),
(8, '201805203', 1, 1, '7', '', '2018-05-20'),
(9, '201805204', 1, 1, '7', '', '2018-05-20'),
(10, '201805205', 1, 1, '7', '', '2018-05-20'),
(11, '201805205', 1, 2, '14', '', '2018-05-20'),
(12, '201805206', 1, 1, '7', '', '2018-05-20'),
(13, '201805206', 1, 2, '14', '', '2018-05-20'),
(14, '201805207', 1, 3, '21', '', '2018-05-20');

-- --------------------------------------------------------

--
-- Table structure for table `schedules`
--

CREATE TABLE `schedules` (
  `id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `pet_id` int(11) NOT NULL,
  `type` varchar(255) NOT NULL,
  `schedule` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `schedules`
--

INSERT INTO `schedules` (`id`, `client_id`, `pet_id`, `type`, `schedule`) VALUES
(1, 1, 1, 'value1, Value1, Eye Checking', '2018-05-31');

-- --------------------------------------------------------

--
-- Table structure for table `stocks`
--

CREATE TABLE `stocks` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stocks`
--

INSERT INTO `stocks` (`id`, `product_id`, `quantity`) VALUES
(2, 1, 15);

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE `suppliers` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `phone` varchar(255) NOT NULL,
  `contact_person` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `suppliers`
--

INSERT INTO `suppliers` (`id`, `name`, `address`, `phone`, `contact_person`) VALUES
(1, 'supplier one', 'p1 blk10, bayanan, muntinlupa', '09456569871', 'cardo');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`) VALUES
(1, 'admin', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `grooming_revenue`
--
ALTER TABLE `grooming_revenue`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `grooming_services`
--
ALTER TABLE `grooming_services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `health_services`
--
ALTER TABLE `health_services`
  ADD PRIMARY KEY (`id`),
  ADD KEY `client_id` (`client_id`),
  ADD KEY `pet_id` (`pet_id`);

--
-- Indexes for table `orderitems`
--
ALTER TABLE `orderitems`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pets`
--
ALTER TABLE `pets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `client_id` (`client_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `retail`
--
ALTER TABLE `retail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `schedules`
--
ALTER TABLE `schedules`
  ADD PRIMARY KEY (`id`),
  ADD KEY `client_id` (`client_id`),
  ADD KEY `pet_id` (`pet_id`);

--
-- Indexes for table `stocks`
--
ALTER TABLE `stocks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `grooming_revenue`
--
ALTER TABLE `grooming_revenue`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `grooming_services`
--
ALTER TABLE `grooming_services`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `health_services`
--
ALTER TABLE `health_services`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `orderitems`
--
ALTER TABLE `orderitems`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `pets`
--
ALTER TABLE `pets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `retail`
--
ALTER TABLE `retail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `schedules`
--
ALTER TABLE `schedules`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `stocks`
--
ALTER TABLE `stocks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `health_services`
--
ALTER TABLE `health_services`
  ADD CONSTRAINT `health_services_ibfk_1` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `health_services_ibfk_2` FOREIGN KEY (`pet_id`) REFERENCES `pets` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `pets`
--
ALTER TABLE `pets`
  ADD CONSTRAINT `pets_ibfk_1` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `schedules`
--
ALTER TABLE `schedules`
  ADD CONSTRAINT `schedules_ibfk_1` FOREIGN KEY (`pet_id`) REFERENCES `pets` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `schedules_ibfk_2` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
