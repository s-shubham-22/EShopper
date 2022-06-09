-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 09, 2022 at 02:14 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `eshopper`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(80) NOT NULL,
  `fname` varchar(80) NOT NULL,
  `lname` varchar(80) NOT NULL,
  `email` varchar(80) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `fname`, `lname`, `email`, `password`) VALUES
(1, 'admin', 'Shubham', 'Sareliya', 'abc@xyz.com', '$2y$10$IEty4B3tHJ2WmQmhYn3RoOAGk2JLkthUHUvrGtkYoP45VDcMujt3a');

-- --------------------------------------------------------

--
-- Table structure for table `brand`
--

CREATE TABLE `brand` (
  `id` int(11) NOT NULL,
  `title` varchar(80) NOT NULL,
  `slug` varchar(80) NOT NULL,
  `status` int(11) NOT NULL,
  `img_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `brand`
--

INSERT INTO `brand` (`id`, `title`, `slug`, `status`, `img_name`) VALUES
(5, 'Loius Philippe', 'loius-philippe', 1, 'brand62989137680cd7.20680302.png'),
(6, 'Ray Ban', 'ray-ban', 1, 'brand62989143e094b6.19342978.png'),
(7, 'Skybags', 'skybags', 1, 'brand6298914df35ea9.57206163.png'),
(8, 'Safari', 'safari', 1, 'brand629891573aec19.81478794.jpg'),
(9, 'Raymond', 'raymond', 1, 'brand6298916423ade8.83832447.png'),
(10, 'Nike', 'nike', 1, 'brand629891e899b356.47651724.png'),
(11, 'Adidas', 'adidas', 1, 'brand629891f3a15142.09580074.png');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `cart_id` int(11) NOT NULL,
  `id` int(11) NOT NULL,
  `pid` int(11) NOT NULL,
  `color` int(11) NOT NULL,
  `size` int(11) NOT NULL,
  `qty` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `title` varchar(80) NOT NULL,
  `slug` varchar(80) NOT NULL,
  `status` int(11) NOT NULL,
  `img_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `title`, `slug`, `status`, `img_name`) VALUES
(3, 'Pants', 'pants', 1, 'category6295c44b937a61.15574469.jpg'),
(4, 'Shirts', 'shirts', 1, 'category6295c458ac74f9.25312281.jpg'),
(5, 'Sunglasses', 'sunglasses', 1, 'category6295c465338f49.43344440.jpg'),
(6, 'Shoes', 'shoes', 1, 'category6295c46ee11a70.29556663.jpg'),
(7, 'Bags', 'bags', 1, 'category6295c47a63cca6.05201817.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `id` int(11) NOT NULL,
  `email` varchar(80) NOT NULL,
  `mobile` int(10) NOT NULL,
  `address` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`id`, `email`, `mobile`, `address`) VALUES
(1, '20ce123@charusat.edu.in', 2147483647, '334 - City Centre, Raiya Road, Rajkot.');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `b_fname` varchar(80) NOT NULL,
  `b_lname` varchar(80) NOT NULL,
  `b_email` varchar(80) NOT NULL,
  `b_mobile` int(80) NOT NULL,
  `b_addr_1` varchar(80) NOT NULL,
  `b_addr_2` varchar(80) NOT NULL,
  `b_country` varchar(80) NOT NULL,
  `b_city` varchar(80) NOT NULL,
  `b_state` varchar(80) NOT NULL,
  `b_zip` varchar(6) NOT NULL,
  `s_fname` varchar(80) NOT NULL,
  `s_lname` varchar(80) NOT NULL,
  `s_email` varchar(80) NOT NULL,
  `s_mobile` int(80) NOT NULL,
  `s_addr_1` varchar(80) NOT NULL,
  `s_addr_2` varchar(80) NOT NULL,
  `s_country` varchar(80) NOT NULL,
  `s_city` varchar(80) NOT NULL,
  `s_state` varchar(80) NOT NULL,
  `s_zip` int(6) NOT NULL,
  `order_date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `pid` int(11) NOT NULL,
  `title` varchar(80) NOT NULL,
  `color` int(11) NOT NULL,
  `size` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `title` varchar(80) NOT NULL,
  `slug` varchar(80) NOT NULL,
  `cid` int(11) NOT NULL,
  `bid` int(11) NOT NULL,
  `stock` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `sale_price` int(11) NOT NULL,
  `img_name` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `title`, `slug`, `cid`, `bid`, `stock`, `price`, `sale_price`, `img_name`, `status`, `description`) VALUES
(2, 'Sunglasses 1', 'sunglasses-1', 5, 6, 14, 699, 599, 'product62972389e36dd2.96053887.jpg', 1, 'This is Sunglasses 1.'),
(5, 'Shirt', 'shirt', 4, 5, 12, 699, 599, 'product62988e04300815.11299729.jpg', 1, 'This is a Shirt\r\n'),
(6, 'Pant 1', 'pant-1', 3, 9, 10, 699, 699, 'product62988e2a2b1859.09255658.jpg', 1, 'This is a Pant 1'),
(7, 'Shoes 1', 'shoes-1', 6, 10, 12, 1049, 599, 'product62988e4c7731f2.45598861.jpg', 1, 'This is Shoes 1'),
(8, 'Bag 1', 'bag-1', 7, 7, 12, 759, 699, 'product62988e6dd39cb3.38362067.jpg', 1, 'This is Bag 1'),
(9, 'Shirt 2', 'shirt-2', 4, 9, 14, 699, 599, 'product62988e9a21f061.32461939.jpg', 1, 'This is Shirt 2'),
(10, 'Sun Glasss 2', 'sun-glasss-2', 5, 6, 12, 759, 599, 'product62988ebe2173e5.43162501.jpg', 1, 'This is Sun Glasses 2'),
(11, 'Shoes 2', 'shoes-2', 6, 11, 12, 699, 599, 'product62988edc18fca3.25714556.jpg', 1, 'This is Shoes 2'),
(12, 'Bag 2', 'bag-2', 7, 8, 12, 759, 599, 'product62988efdc15624.63494315.jpg', 1, 'This is Bag 2');

-- --------------------------------------------------------

--
-- Table structure for table `product_variant`
--

CREATE TABLE `product_variant` (
  `id` int(11) NOT NULL,
  `pid` int(11) NOT NULL,
  `size` int(11) NOT NULL,
  `color` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `stock` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `img_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product_variant`
--

INSERT INTO `product_variant` (`id`, `pid`, `size`, `color`, `price`, `stock`, `status`, `img_name`) VALUES
(1, 2, 7, 3, 899, 10, 1, 'product_variant62976658ed37b3.27685478.jpg'),
(3, 2, 9, 2, 759, 12, 1, 'product_variant6297697247bd72.95018728.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `query`
--

CREATE TABLE `query` (
  `id` int(11) NOT NULL,
  `name` varchar(80) NOT NULL,
  `email` varchar(80) NOT NULL,
  `subject` varchar(200) NOT NULL,
  `message` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `sliders`
--

CREATE TABLE `sliders` (
  `id` int(11) NOT NULL,
  `title` varchar(80) NOT NULL,
  `img_name` varchar(80) NOT NULL,
  `slug` varchar(80) NOT NULL,
  `status` int(11) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sliders`
--

INSERT INTO `sliders` (`id`, `title`, `img_name`, `slug`, `status`, `description`) VALUES
(3, 'Slider 1', 'slider629862156681e9.09737916.jpg', 'slider-1', 1, 'This is Slider 1'),
(5, 'Slider 2', 'slider62986292689375.13015853.jpg', 'slider-2', 1, 'This is Slider 2'),
(6, 'Slider 3', 'slider629862b83538d1.83769796.png', 'slider-3', 1, 'This is Slider 3');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(80) NOT NULL,
  `fname` varchar(80) NOT NULL,
  `lname` varchar(80) NOT NULL,
  `mobile` int(10) NOT NULL,
  `email` varchar(80) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `address` text NOT NULL,
  `password` varchar(80) NOT NULL,
  `join_date` datetime NOT NULL DEFAULT current_timestamp(),
  `last_login` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `fname`, `lname`, `mobile`, `email`, `gender`, `address`, `password`, `join_date`, `last_login`) VALUES
(1, 's_shubham_22', 'Shubham', 'Sareliya', 2147483647, '20ce123@ch', 'male', 'fsdf', '$2y$10$15f1Z8WcV1q/uDTg9hIpJexHm6HZ/vMP8bUq6A.Qsb5/A01nuHxLa', '2022-06-07 15:47:20', '2022-06-07 15:47:20');

-- --------------------------------------------------------

--
-- Table structure for table `variant`
--

CREATE TABLE `variant` (
  `id` int(11) NOT NULL,
  `title` varchar(80) NOT NULL,
  `slug` varchar(80) NOT NULL,
  `type` varchar(80) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `variant`
--

INSERT INTO `variant` (`id`, `title`, `slug`, `type`, `status`) VALUES
(1, 'Color', 'color', 'color', 1),
(2, 'Size', 'size', 'text', 1);

-- --------------------------------------------------------

--
-- Table structure for table `variant_details`
--

CREATE TABLE `variant_details` (
  `id` int(11) NOT NULL,
  `vid` int(11) NOT NULL,
  `type` varchar(80) NOT NULL,
  `v_value` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `variant_details`
--

INSERT INTO `variant_details` (`id`, `vid`, `type`, `v_value`) VALUES
(1, 1, 'color', '#ff0000'),
(2, 1, 'color', '#ee00ff'),
(3, 1, 'color', '#00ffaa'),
(4, 1, 'color', '#e1ff00'),
(5, 1, 'color', '#04ff00'),
(6, 2, 'text', 'S'),
(7, 2, 'text', 'M'),
(8, 2, 'text', 'L'),
(9, 2, 'text', 'XL'),
(10, 2, 'text', 'XXL');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `brand`
--
ALTER TABLE `brand`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cart_id`,`id`,`pid`,`color`,`size`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_variant`
--
ALTER TABLE `product_variant`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `query`
--
ALTER TABLE `query`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sliders`
--
ALTER TABLE `sliders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `variant`
--
ALTER TABLE `variant`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `variant_details`
--
ALTER TABLE `variant_details`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `brand`
--
ALTER TABLE `brand`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `product_variant`
--
ALTER TABLE `product_variant`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `query`
--
ALTER TABLE `query`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sliders`
--
ALTER TABLE `sliders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `variant`
--
ALTER TABLE `variant`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `variant_details`
--
ALTER TABLE `variant_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
