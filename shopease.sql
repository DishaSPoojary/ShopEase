-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 24, 2026 at 06:51 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shopease`
--

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_email` varchar(100) NOT NULL,
  `product_name` varchar(100) NOT NULL,
  `price` int(11) NOT NULL,
  `order_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `name` varchar(100) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `payment` varchar(50) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_email`, `product_name`, `price`, `order_date`, `name`, `address`, `phone`, `payment`, `created_at`) VALUES
(29, 'disha77600@gmail.com', 'Smart Watch', 4497, '2026-04-19 13:08:34', 'disha', 'udupi', '1234321234', 'COD', '2026-04-19 13:08:34'),
(36, 'disha77600@gmail.com', 'Smart Watch', 2998, '2026-05-06 12:25:12', 'disha', 'Bajal, mangalore', '8904567342', 'COD', '2026-05-06 12:25:12'),
(37, 'disha77600@gmail.com', 'T-Shirt', 998, '2026-05-06 12:25:12', 'disha', 'Bajal, mangalore', '8904567342', 'COD', '2026-05-06 12:25:12'),
(38, 'disha77600@gmail.com', 'Kurta Set', 999, '2026-05-06 12:25:12', 'disha', 'Bajal, mangalore', '8904567342', 'COD', '2026-05-06 12:25:12'),
(39, 'vaish123@gmail.com', 'Headphones', 3998, '2026-05-14 12:02:54', 'Vaishnavi', 'Bejai,Mangalore', '4567890342', 'COD', '2026-05-14 12:02:54'),
(40, 'vaish123@gmail.com', 'Sunglasses', 699, '2026-05-14 12:02:54', 'Vaishnavi', 'Bejai,Mangalore', '4567890342', 'COD', '2026-05-14 12:02:54'),
(41, 'vaish123@gmail.com', 'Baggy jeans', 1598, '2026-05-14 12:02:54', 'Vaishnavi', 'Bejai,Mangalore', '4567890342', 'COD', '2026-05-14 12:02:54'),
(42, 'disha77600@gmail.com', 'Shoes', 2997, '2026-05-25 06:28:44', 'disha', 'udupi', '1234321234', 'COD', '2026-05-25 06:28:44'),
(43, 'disha77600@gmail.com', 'Smart Watch', 1499, '2026-05-25 06:28:44', 'disha', 'udupi', '1234321234', 'COD', '2026-05-25 06:28:44');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `price`, `image`, `description`) VALUES
(1, 'Shoes', 999, 'shoe.jpg', 'Comfortable shoes for daily use'),
(2, 'Smart Watch', 1499, 'watch.jpg', 'Smart watch with fitness tracking features'),
(4, 'Headphones', 1999, 'headphone.jpg', 'High quality sound headphones'),
(5, 'T-Shirt', 499, 'tshirt.jpg', 'Stylish cotton t-shirt for everyday use'),
(6, 'Sunglasses', 699, 'glass.jpg', 'UV protected sunglasses for outdoor use'),
(7, 'Lipstick', 299, 'lipstick.jpg', 'Long-lasting lipstick with smooth finish'),
(8, 'Kurta Set', 999, 'kurtaset.jpg', 'Traditional kurta set with elegant design'),
(9, 'Baggy jeans', 799, 'baggyjeans.jpg', 'Trendy and comfortable baggy jeans'),
(18, 'Travel Bag', 799, 'bag.jpg', 'Durable travel bag with large capacity');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(10) DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `role`) VALUES
(26, 'disha', 'disha77600@gmail.com', '$2y$10$DKqtj1gt8QSYKnSmPoPnX.P8jPngDuOE7FeyGqMR0baS0erJSJwsG', 'user'),
(29, 'disha', 'admin@gmail.com', '$2y$10$u1TmTX1r2.dGiV4efpcf9u9dOuwml8/cBced73bw0wJ0Y/u5AzNTC', 'admin'),
(30, 'disha', 'disha@gmail.com', '$2y$10$4blvH3s8Zk5wuk8ixpw3lOeegtuF7rG9J5b.oWl4CJYT2klxcuYQ2', 'user'),
(32, 'Vaishnavi', 'vaish123@gmail.com', '$2y$10$WtSAg/ibPMxO1Bg7vsOmrOfw9gNohPR6pMLAdo6PVoioj4Ev7QE/e', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
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
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
