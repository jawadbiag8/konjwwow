-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 01, 2021 at 10:47 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cybemerce`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_accounts`
--

CREATE TABLE `tbl_accounts` (
  `acc_id` int(11) NOT NULL,
  `acc_number` varchar(255) NOT NULL,
  `acc_Ibn_number` varchar(255) NOT NULL,
  `acc_holder_name` varchar(255) NOT NULL,
  `acc_banks_name` varchar(255) NOT NULL,
  `acc_email` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `id` int(11) NOT NULL,
  `name` varchar(60) DEFAULT NULL,
  `personal_id` longtext DEFAULT NULL,
  `username` varchar(60) NOT NULL,
  `email` varchar(60) NOT NULL,
  `mobile_number` bigint(11) DEFAULT NULL,
  `password` varchar(60) NOT NULL,
  `profile_pic` longtext DEFAULT NULL,
  `role_id` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `added_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_admin`
--

INSERT INTO `tbl_admin` (`id`, `name`, `personal_id`, `username`, `email`, `mobile_number`, `password`, `profile_pic`, `role_id`, `status`, `added_date`) VALUES
(5, 'Admin', 'nothing is important', 'admin', 'admin@gmail.com', 32343343, '0192023a7bbd73250516f069df18b500', 'user.png', 7, 1, '2021-01-13 20:42:53'),
(13, 'osama', 'user', 'osama', 'osama@gmail.com', 3451215421, '7c4ab2635bc11858c6c26ccbadba065b', 'user.jpg', 125, 1, '2021-02-26 19:20:32'),
(14, 'dexter code', 'user', 'dextercode', 'dextercode@gmail.com', 3124512541, '91c83e9a392bb28ff42b79e52f404aaf', 'user.jpg', 125, 1, '2021-02-26 20:23:18'),
(15, 'developer', 'user', 'developer', 'developer@gmail.com', 123412341234, '5e8edd851d2fdfbd7415232c67367cc3', 'user.jpg', 125, 1, '2021-03-01 16:41:57');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_merchant`
--

CREATE TABLE `tbl_merchant` (
  `mer_id` int(11) NOT NULL,
  `mer_name` varchar(255) NOT NULL,
  `mer_email` varchar(255) NOT NULL,
  `mer_password` varchar(255) NOT NULL,
  `mer_phone` varchar(255) NOT NULL,
  `mer_business_name` longtext DEFAULT NULL,
  `mer_cnic` varchar(255) DEFAULT NULL,
  `mer_address` varchar(255) DEFAULT NULL,
  `mer_status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_merchant`
--

INSERT INTO `tbl_merchant` (`mer_id`, `mer_name`, `mer_email`, `mer_password`, `mer_phone`, `mer_business_name`, `mer_cnic`, `mer_address`, `mer_status`, `created_at`) VALUES
(1, 'Waleed', 'admin@gmail.com', '0192023a7bbd73250516f069df18b500', '00000000', 'Chai Khana', NULL, 'islamabad', 1, '2021-04-20 13:03:28');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_products`
--

CREATE TABLE `tbl_products` (
  `product_id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_desc` longtext NOT NULL,
  `product_feature_image` varchar(255) NOT NULL,
  `product_price` int(11) NOT NULL,
  `product_remarks` longtext NOT NULL,
  `product_quantity` int(11) NOT NULL,
  `vendor_id` bigint(20) NOT NULL,
  `prod_id_unique` varchar(255) NOT NULL,
  `product_status` enum('approved','rejected','pending','disabled') NOT NULL DEFAULT 'pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_products`
--

INSERT INTO `tbl_products` (`product_id`, `product_name`, `product_desc`, `product_feature_image`, `product_price`, `product_remarks`, `product_quantity`, `vendor_id`, `prod_id_unique`, `product_status`, `created_at`) VALUES
(1, 'Mobile Phone', 'ajanndndnd', '1618832603_logo.png', 3089, 'My Remarks', 0, 3, '', 'rejected', '2021-04-19 17:59:03'),
(6, 'Gray Salas', 'Occaecat ipsa fugia', '1618833018_Pdf-icon.png', 721, 'Remarks', 770, 3, 'KonJaei-1618857015', 'disabled', '2021-04-19 18:30:15'),
(8, 'Xena Woodward', 'Consectetur qui enim', '1618864996_layout11.jpg', 353, 'Suscipit dolor nisi ', 90, 3, 'KonJaei-1618864996', 'approved', '2021-04-19 20:43:16'),
(9, 'Allegra Miles', 'Delectus tempore h', '1619605910_logo.png', 762, 'Et error Nam molliti', 287, 3, 'KonJaei-1619605910', 'pending', '2021-04-28 10:31:50');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_roles`
--

CREATE TABLE `tbl_roles` (
  `role_id` int(11) NOT NULL,
  `role_name` varchar(255) NOT NULL,
  `role_status` tinyint(4) NOT NULL DEFAULT 1,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_roles`
--

INSERT INTO `tbl_roles` (`role_id`, `role_name`, `role_status`, `created_date`) VALUES
(1, 'Product Support', 1, '2021-01-12 22:39:17'),
(2, 'Customer Support', 1, '2021-01-12 22:39:17');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_staff`
--

CREATE TABLE `tbl_staff` (
  `staff_id` int(11) NOT NULL,
  `staff_name` varchar(255) NOT NULL,
  `mobile` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role_id` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_staff`
--

INSERT INTO `tbl_staff` (`staff_id`, `staff_name`, `mobile`, `email`, `password`, `role_id`, `status`, `created_at`) VALUES
(3, 'Zephania Terry', '747', 'hifi@mailinator.com', '585a097e7ec1f2ba93c7d066d6f7fc5e', 2, 0, '2021-04-19 11:09:19');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_vendors`
--

CREATE TABLE `tbl_vendors` (
  `vendor_id` int(11) NOT NULL,
  `vend_name` varchar(255) NOT NULL,
  `vend_mobile` varchar(255) NOT NULL,
  `vend_email` varchar(255) NOT NULL,
  `vend_pass` varchar(255) NOT NULL,
  `vend_business_name` varchar(255) DEFAULT NULL,
  `vend_logo` varchar(255) DEFAULT NULL,
  `vend_remarks` longtext DEFAULT NULL,
  `vend_memberships` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_vendors`
--

INSERT INTO `tbl_vendors` (`vendor_id`, `vend_name`, `vend_mobile`, `vend_email`, `vend_pass`, `vend_business_name`, `vend_logo`, `vend_remarks`, `vend_memberships`, `created_at`) VALUES
(2, 'Leslie Dale', '387000', 'gedara@mailinator.com', 'f3ed11bbdb94fd9ebdefbaf646ab94d3', 'Rylee Hubbard', '1618833018_Pdf-icon.png', 'Qui blanditiis occae', 1, '2021-04-19 11:50:18'),
(3, 'Dawn Howe', '178', 'admin@gmail.com', '2bc28e228525b75e14c07dbc14850c34', 'Ethan Newman', '', 'Ut suscipit eos aut', 1, '2021-04-19 14:32:53');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_accounts`
--
ALTER TABLE `tbl_accounts`
  ADD PRIMARY KEY (`acc_id`);

--
-- Indexes for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_merchant`
--
ALTER TABLE `tbl_merchant`
  ADD PRIMARY KEY (`mer_id`);

--
-- Indexes for table `tbl_products`
--
ALTER TABLE `tbl_products`
  ADD PRIMARY KEY (`product_id`),
  ADD UNIQUE KEY `prod_id_unique` (`prod_id_unique`);

--
-- Indexes for table `tbl_roles`
--
ALTER TABLE `tbl_roles`
  ADD PRIMARY KEY (`role_id`);

--
-- Indexes for table `tbl_staff`
--
ALTER TABLE `tbl_staff`
  ADD PRIMARY KEY (`staff_id`);

--
-- Indexes for table `tbl_vendors`
--
ALTER TABLE `tbl_vendors`
  ADD PRIMARY KEY (`vendor_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_accounts`
--
ALTER TABLE `tbl_accounts`
  MODIFY `acc_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `tbl_merchant`
--
ALTER TABLE `tbl_merchant`
  MODIFY `mer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_products`
--
ALTER TABLE `tbl_products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tbl_roles`
--
ALTER TABLE `tbl_roles`
  MODIFY `role_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tbl_staff`
--
ALTER TABLE `tbl_staff`
  MODIFY `staff_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_vendors`
--
ALTER TABLE `tbl_vendors`
  MODIFY `vendor_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
