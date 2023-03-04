-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Feb 07, 2023 at 10:37 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `share-ride`
--

-- --------------------------------------------------------

--
-- Table structure for table `brand_types`
--

CREATE TABLE `brand_types` (
  `id` int(11) NOT NULL,
  `brand_types` varchar(255) NOT NULL,
  `cretaed_at` int(11) DEFAULT current_timestamp(),
  `updated_at` int(11) DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `brand_types`
--

INSERT INTO `brand_types` (`id`, `brand_types`, `cretaed_at`, `updated_at`) VALUES
(1, 'Sports', NULL, NULL),
(2, 'sedan', NULL, NULL),
(3, 'Suv', NULL, NULL),
(4, 'Hetchback', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `car_brands`
--

CREATE TABLE `car_brands` (
  `brand_id` int(11) NOT NULL,
  `brand_name` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `car_brands`
--

INSERT INTO `car_brands` (`brand_id`, `brand_name`, `created_at`, `updated_at`) VALUES
(1, 'Ford', '2023-02-03 03:56:46', '2023-01-27 07:15:27'),
(2, 'Chevrolet', '2023-02-03 03:56:46', '2023-01-27 07:15:27'),
(3, 'Toyota', '2023-02-03 03:56:46', '2023-01-27 07:15:27'),
(4, 'Honda', '2023-02-03 03:56:46', '2023-01-27 07:15:27'),
(5, 'Nissan', '2023-02-03 03:56:46', '2023-01-27 07:15:27'),
(6, 'Mitsubishi', '2023-02-03 03:56:46', '2023-01-27 07:15:27'),
(7, 'BMW', '2023-02-03 03:56:46', '2023-01-27 07:15:27'),
(8, 'Mercedes-Benz', '2023-02-03 03:56:46', '2023-01-27 07:15:27'),
(9, 'Volkswagen', '2023-02-03 03:56:46', '2023-01-27 07:15:27'),
(10, 'Audi', '2023-02-03 03:56:46', '2023-01-27 07:15:27');

-- --------------------------------------------------------

--
-- Table structure for table `colors`
--

CREATE TABLE `colors` (
  `id` int(11) NOT NULL,
  `color` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `colors`
--

INSERT INTO `colors` (`id`, `color`, `created_at`, `updated_at`) VALUES
(1, 'black', '2023-02-03 04:13:44', '2023-02-03 04:13:44'),
(2, 'white', '2023-02-03 04:13:44', '2023-02-03 04:13:44');

-- --------------------------------------------------------

--
-- Table structure for table `post_trips`
--

CREATE TABLE `post_trips` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `vehicle_id` int(11) DEFAULT NULL,
  `origin` varchar(255) DEFAULT NULL,
  `destination` varchar(255) DEFAULT NULL,
  `stop` varchar(255) DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `start_time` time DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `end_time` time DEFAULT NULL,
  `luggage` varchar(255) DEFAULT NULL,
  `back_row_seat` varchar(255) DEFAULT NULL,
  `other` varchar(255) DEFAULT NULL,
  `seats` varchar(255) DEFAULT NULL,
  `pricing` varchar(255) DEFAULT NULL,
  `description` longtext DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `post_trips`
--

INSERT INTO `post_trips` (`id`, `user_id`, `vehicle_id`, `origin`, `destination`, `stop`, `start_date`, `start_time`, `end_date`, `end_time`, `luggage`, `back_row_seat`, `other`, `seats`, `pricing`, `description`, `created_at`, `updated_at`) VALUES
(59, 39, 29, 'chandigarh', 'tohana', NULL, '2023-02-07', '23:30:00', NULL, NULL, 'No luggage', 'Max 2 people', '[\"Pets\"]', '2', NULL, NULL, '2023-02-06 22:59:52', '2023-02-06 22:59:52'),
(60, 41, 30, 'Alias esse sunt omn', 'Beatae natus optio', NULL, '2023-02-07', '09:09:00', NULL, NULL, 'L', 'Max 2 people', '[\"Skis & snowboards\",\"Pets\"]', '1', NULL, NULL, '2023-02-06 23:55:48', '2023-02-06 23:55:48'),
(61, 42, 31, 'chandigarh', 'Tohana', NULL, '2023-02-07', '14:30:00', NULL, NULL, 'S', '3 people', '[\"Bikes\",\"Skis & snowboards\",\"Pets\"]', '4', NULL, NULL, '2023-02-07 00:28:27', '2023-02-07 00:28:27');

-- --------------------------------------------------------

--
-- Table structure for table `trip_payments`
--

CREATE TABLE `trip_payments` (
  `id` int(11) NOT NULL,
  `trip_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `payment_method` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `trip_requests`
--

CREATE TABLE `trip_requests` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `pickup_location` varchar(255) NOT NULL,
  `drop_location` varchar(255) NOT NULL,
  `leaving` date NOT NULL,
  `seat` int(11) NOT NULL,
  `description` longtext DEFAULT NULL,
  `status` enum('pending','approved','cancelled') NOT NULL DEFAULT 'pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `trip_requests`
--

INSERT INTO `trip_requests` (`id`, `user_id`, `pickup_location`, `drop_location`, `leaving`, `seat`, `description`, `status`, `created_at`, `updated_at`) VALUES
(1, 36, 'bangalore', 'chennai', '2023-02-07', 3, 'adqadadadadada', 'pending', '2023-02-05 22:57:45', '2023-02-05 22:57:45'),
(2, 36, 'bangalore', 'chennai', '2023-02-07', 2, 'wqqeqedqdeq', 'pending', '2023-02-05 22:59:17', '2023-02-05 22:59:17'),
(3, 36, 'bangalore', 'Chandigarh', '2023-02-07', 2, 'adadadadadada', 'pending', '2023-02-05 23:12:29', '2023-02-05 23:12:29');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `verify_email` varchar(255) DEFAULT NULL,
  `mobile_no` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `gender` varchar(255) DEFAULT NULL,
  `img` varchar(255) DEFAULT NULL,
  `description` longtext DEFAULT NULL,
  `facebook_id` varchar(255) DEFAULT NULL,
  `social_type` varchar(255) DEFAULT NULL,
  `google_id` varchar(255) DEFAULT NULL,
  `status` enum('active','deleted','pending') DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `last_name`, `email`, `verify_email`, `mobile_no`, `password`, `dob`, `gender`, `img`, `description`, `facebook_id`, `social_type`, `google_id`, `status`, `created_at`, `updated_at`) VALUES
(39, 'vinay', 'raheja', 'vinay@gmail.com', NULL, NULL, '$2y$10$TWz8ifXr5YZFWelciEWhsOEX33Mz4KIks6mxX6Ri2sJdwrK4qn5Hm', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'active', '2023-02-06 00:23:56', '2023-02-06 00:23:56'),
(40, 'Idola Hickman', 'Idola Hickman', 'abc@mailinator.com', NULL, NULL, '$2y$10$M2y8er92HUQg4A.93SB7q.7NyFIMXoizu0coQkZnmdDhniEJXy2YW', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'active', '2023-02-06 06:36:37', '2023-02-06 06:36:37'),
(41, 'amit', 'kumar', 'amit@gmail.com', NULL, NULL, '$2y$10$c3qTy5qOhm5D69ieZmL3qe6ZUP46ty8zIvRacJmrhvX8I8Bg/fnRK', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'active', '2023-02-06 23:45:37', '2023-02-06 23:45:37'),
(42, 'sunil', 'kumar', 'sunil@gmail.com', NULL, NULL, '$2y$10$0b1k/9k4LsARzDaA5iTRiO3Qx07/1N6gQz1pC1FsA51Jyi7N2nB1.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'active', '2023-02-07 00:26:24', '2023-02-07 00:26:24');

-- --------------------------------------------------------

--
-- Table structure for table `vehicle_models`
--

CREATE TABLE `vehicle_models` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `model` varchar(255) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `color` varchar(255) DEFAULT NULL,
  `year` varchar(255) DEFAULT NULL,
  `img` varchar(255) DEFAULT NULL,
  `licence_no` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vehicle_models`
--

INSERT INTO `vehicle_models` (`id`, `user_id`, `model`, `type`, `color`, `year`, `img`, `licence_no`, `created_at`, `updated_at`) VALUES
(29, 39, NULL, 'hidden', 'hidden', NULL, '1675744192.jpeg', NULL, '2023-02-06 22:59:52', '2023-02-06 22:59:52'),
(30, 41, 'Ford', '2', '1', '1976', '1675747548.jpeg', '1988', '2023-02-06 23:55:48', '2023-02-06 23:55:48'),
(31, 42, 'Chevrolet', 'Sports', 'white', '1908', '1675749507.jpg', 'POP123', '2023-02-07 00:28:27', '2023-02-07 00:28:27');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `brand_types`
--
ALTER TABLE `brand_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `car_brands`
--
ALTER TABLE `car_brands`
  ADD PRIMARY KEY (`brand_id`);

--
-- Indexes for table `colors`
--
ALTER TABLE `colors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `post_trips`
--
ALTER TABLE `post_trips`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `vehicle_id` (`vehicle_id`);

--
-- Indexes for table `trip_payments`
--
ALTER TABLE `trip_payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `trip_requests`
--
ALTER TABLE `trip_requests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vehicle_models`
--
ALTER TABLE `vehicle_models`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `brand_types`
--
ALTER TABLE `brand_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `car_brands`
--
ALTER TABLE `car_brands`
  MODIFY `brand_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `colors`
--
ALTER TABLE `colors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `post_trips`
--
ALTER TABLE `post_trips`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `trip_payments`
--
ALTER TABLE `trip_payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `trip_requests`
--
ALTER TABLE `trip_requests`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `vehicle_models`
--
ALTER TABLE `vehicle_models`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `post_trips`
--
ALTER TABLE `post_trips`
  ADD CONSTRAINT `post_trips_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `post_trips_ibfk_2` FOREIGN KEY (`vehicle_id`) REFERENCES `vehicle_models` (`id`);

--
-- Constraints for table `vehicle_models`
--
ALTER TABLE `vehicle_models`
  ADD CONSTRAINT `vehicle_models_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
