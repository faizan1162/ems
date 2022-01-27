-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 27, 2022 at 01:47 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `event_management`
--

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` int(11) NOT NULL,
  `event_title` varchar(255) NOT NULL,
  `event_description` text DEFAULT NULL,
  `event_avatar` varchar(255) DEFAULT NULL,
  `event_start_date` date DEFAULT NULL,
  `event_start_time` varchar(50) DEFAULT NULL,
  `event_end_date` date DEFAULT NULL,
  `event_end_time` varchar(50) DEFAULT NULL,
  `event_lat` float DEFAULT NULL,
  `event_lng` float DEFAULT NULL,
  `event_location` text DEFAULT NULL,
  `is_active` tinyint(4) DEFAULT 1,
  `created_by` int(11) DEFAULT 0,
  `updated_by` int(11) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `event_title`, `event_description`, `event_avatar`, `event_start_date`, `event_start_time`, `event_end_date`, `event_end_time`, `event_lat`, `event_lng`, `event_location`, `is_active`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 'Fever Club Service new', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 'tefliyrso1643240323.jpeg', '2022-01-28', '08:00', '2022-01-29', '08:00', NULL, NULL, 'Sea View Beach Clifton Karachi., Sea View Road, D.H.A. Phase 8 Phase 8 Ext Defence Housing Authority, Karachi, Pakistan', 1, 1, 0, '2022-01-26 18:38:43', '2022-01-26 18:38:43'),
(2, 'Dinner Party & Gif Voucher', 'Reference site about Lorem Ipsum, giving information on its origins, as well as a random Lipsum generator.', 'toeisfryl1643240507.jpg', '2022-01-29', '08:45', '2022-01-30', '10:47', NULL, NULL, 'Beach Luxury Hotel - Karachi', 1, 1, 0, '2022-01-26 18:41:47', '2022-01-26 18:41:47'),
(3, 'Testing Event three', 'testing descriptions', 'tseoilfyr1643241358.png', '2022-01-27', '07:58', '2022-01-28', '06:57', NULL, NULL, 'testing location three', 1, 1, 0, '2022-01-26 18:55:58', '2022-01-26 18:55:58');

-- --------------------------------------------------------

--
-- Table structure for table `event_participants`
--

CREATE TABLE `event_participants` (
  `id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `event_participants`
--

INSERT INTO `event_participants` (`id`, `event_id`, `user_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 2, 522, 0, '2022-01-26 18:53:30', '2022-01-26 18:53:30'),
(2, 2, 523, 1, '2022-01-26 18:53:35', '2022-01-26 18:54:41'),
(3, 2, 521, 1, '2022-01-26 18:53:40', '2022-01-26 18:54:23'),
(4, 3, 515, 0, '2022-01-26 18:56:11', '2022-01-26 18:56:11'),
(5, 3, 520, 0, '2022-01-26 18:56:16', '2022-01-26 18:56:16');

-- --------------------------------------------------------

--
-- Table structure for table `event_tickets`
--

CREATE TABLE `event_tickets` (
  `id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `ticket_type_id` int(11) NOT NULL,
  `ticket_price` float NOT NULL DEFAULT 0,
  `qty` int(11) NOT NULL DEFAULT 0,
  `sold_qty` int(11) NOT NULL DEFAULT 0,
  `created_by` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `event_tickets`
--

INSERT INTO `event_tickets` (`id`, `event_id`, `ticket_type_id`, `ticket_price`, `qty`, `sold_qty`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 20, 50, 0, 1, '2022-01-26 23:38:43', '2022-01-26 23:38:43'),
(2, 1, 2, 50, 30, 0, 1, '2022-01-26 23:38:43', '2022-01-26 23:38:43'),
(3, 1, 3, 100, 20, 0, 1, '2022-01-26 23:38:43', '2022-01-26 23:38:43'),
(4, 2, 1, 10, 50, 0, 1, '2022-01-26 23:41:47', '2022-01-26 23:41:47'),
(5, 2, 2, 20, 30, 0, 1, '2022-01-26 23:41:47', '2022-01-26 23:41:47'),
(6, 2, 3, 10, 20, 2, 1, '2022-01-26 23:41:47', '2022-01-26 18:54:41'),
(7, 3, 1, 20, 20, 0, 1, '2022-01-26 23:55:58', '2022-01-26 23:55:58'),
(8, 3, 2, 25, 10, 0, 1, '2022-01-26 23:55:58', '2022-01-26 23:55:58'),
(9, 3, 3, 30, 5, 0, 1, '2022-01-26 23:55:58', '2022-01-26 23:55:58');

-- --------------------------------------------------------

--
-- Table structure for table `event_ticket_bookings`
--

CREATE TABLE `event_ticket_bookings` (
  `id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `total_price` float NOT NULL DEFAULT 0,
  `vat` float NOT NULL DEFAULT 0,
  `discount` float NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `event_ticket_bookings`
--

INSERT INTO `event_ticket_bookings` (`id`, `event_id`, `user_id`, `total_price`, `vat`, `discount`, `created_at`, `updated_at`) VALUES
(1, 2, 521, 10, 0, 0, '2022-01-26 18:54:23', '2022-01-26 18:54:23'),
(2, 2, 523, 10, 0, 0, '2022-01-26 18:54:41', '2022-01-26 18:54:41');

-- --------------------------------------------------------

--
-- Table structure for table `event_ticket_booking_details`
--

CREATE TABLE `event_ticket_booking_details` (
  `id` int(11) NOT NULL,
  `event_ticket_booking_id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `event_ticket_type_id` int(11) NOT NULL DEFAULT 0,
  `event_ticket_type` varchar(255) DEFAULT NULL,
  `event_ticket_price` float NOT NULL DEFAULT 0,
  `event_ticket_qty` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `event_ticket_booking_details`
--

INSERT INTO `event_ticket_booking_details` (`id`, `event_ticket_booking_id`, `event_id`, `user_id`, `event_ticket_type_id`, `event_ticket_type`, `event_ticket_price`, `event_ticket_qty`, `created_at`, `updated_at`) VALUES
(1, 1, 2, 521, 3, 'Platinum', 10, 1, '2022-01-26 18:54:23', '2022-01-26 18:54:23'),
(2, 2, 2, 523, 3, 'Platinum', 10, 1, '2022-01-26 18:54:41', '2022-01-26 18:54:41');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2016_06_01_000001_create_oauth_auth_codes_table', 1),
(4, '2016_06_01_000002_create_oauth_access_tokens_table', 1),
(5, '2016_06_01_000003_create_oauth_refresh_tokens_table', 1),
(6, '2016_06_01_000004_create_oauth_clients_table', 1),
(7, '2016_06_01_000005_create_oauth_personal_access_clients_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `id` int(10) UNSIGNED NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ticket_types`
--

CREATE TABLE `ticket_types` (
  `id` int(11) NOT NULL,
  `type` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ticket_types`
--

INSERT INTO `ticket_types` (`id`, `type`, `created_at`, `updated_at`) VALUES
(1, 'Silver', '2022-01-24 20:51:27', '2022-01-24 20:51:27'),
(2, 'Gold', '2022-01-24 20:51:27', '2022-01-24 20:51:27'),
(3, 'Platinum', '2022-01-24 20:51:27', '2022-01-24 20:51:27');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `utype` varchar(20) DEFAULT 'user',
  `password` varchar(255) DEFAULT NULL,
  `api_token` varchar(80) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `full_name` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `avatar` varchar(255) DEFAULT 'avatar.png',
  `remember_token` varchar(255) DEFAULT NULL,
  `lat` varchar(20) DEFAULT NULL,
  `lng` varchar(20) DEFAULT NULL,
  `bio` text DEFAULT NULL,
  `device_type` varchar(20) DEFAULT NULL,
  `device_token` varchar(255) DEFAULT NULL,
  `is_active` tinyint(4) DEFAULT 0,
  `is_blocked` tinyint(4) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `utype`, `password`, `api_token`, `email`, `full_name`, `phone`, `avatar`, `remember_token`, `lat`, `lng`, `bio`, `device_type`, `device_token`, `is_active`, `is_blocked`, `created_at`, `updated_at`) VALUES
(1, 'admin', '$2y$10$SSWHmzaoX8cOJ9SNZXsWyOAsIpVPfmTc1duBatlAeI1d8GSPbdl8W', 'Nwpl5FlbfT6qCBZ3ThbvRCJqa8o7GbuuTO58jGnUEjMYMiHnXK9wWebbNwhI', 'admin@admin.com', 'Admin', '00000000', 'sthlolgleoe1638282111.jpg', '3B0jRQ4j5HmMyWGuTPtlDXmCfcN94DEaLKWG7zZApwp9MzoOYSY4alO5KSTD', NULL, NULL, NULL, NULL, NULL, 1, 0, '2019-09-16 13:26:54', '2022-01-26 19:14:34'),
(505, 'user', '$2y$10$69vM6yofA6xhUR0LqfLOUu3vPReCJ5fp65EJjDAaM2zTK96CSdCWC', 'BvWuD4lvQ0hY8MPwpxtKNIWQHy6gAAd5bATNb4o4eQiOJbRkcyCOcwoBwzi4', 'kim@yopmail.com', 'hii', '2385', 'ehlltgeoslo1605014896.jpeg', NULL, '24.9025', '67.0729', 'b I did did a good job and I', NULL, NULL, 1, 0, '2020-09-17 12:27:23', '2021-11-30 11:00:48'),
(506, 'user', '$2y$10$SeCBpQyhtj4q2Uh090v8Yeh7d5Kx9SWUhwbyU1A8ACDUdyM9jhErq', '0HYnswOYSeXS4thd5sOyzuQsuYm1FeUyGBMzwiifFwoWC2En3gfJnUO81j77', 'test@yopmail.com', 'Abc Test', '84', 'geslololhet1610007192.jpeg', NULL, NULL, NULL, 'testing', '', '', 1, 0, '2020-09-17 12:30:59', '2021-10-14 05:52:07'),
(507, 'user', '$2y$10$7Nl9EgJL4bWr7T1MZ1zjpe9jsdAhVS1IzUG0gasANZos1YYywr3t2', 'Vo9JHxmFQM3yG7kdHwnKwVjOof8NLXv3tiISRjoGnROqYBLzf7r14UW45OrC', 'megan@yopmail.com', 'saen q', '123456', 'looeelhgslt1601640597.jpg', NULL, '24.8709', '67.0961', 'saaaen jamshoro wala', NULL, NULL, 1, 0, '2020-09-17 13:23:26', '2021-06-21 11:17:36'),
(508, 'user', '$2y$10$6r1L0pJS0h2kfoXDondxhuAe3CaS4WB375maY5UvlPnMu1T5ZD/IS', 'qLuz0NVZrRHGLO2hijImSF0UlaYM7yz1erIDJ7OcZ2M5zxzry7dc7PsOKjay', 'testing12@yopmail.com', 'Testing12', '03172548568', 'soheleollgt1600873651.jpg', NULL, NULL, NULL, 'Hi boost your time for the next few days and I hope you have a great day and I will see you tomorrow', NULL, NULL, 1, 0, '2020-09-23 14:56:58', '2021-06-21 11:16:48'),
(509, 'user', '$2y$10$M9XWpSS/8aAy/eeZPRr0puV0W1YdmW/KNTnUFegRNpy1gh4uD3ghC', 'ZzZATogSLGBi7GNc6IFRU7ok32Xcy04y9gInmAOOiKOxSTO8nb6YOQbY55fM', 'adam@yopmail.com', 'adam', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2020-09-29 13:54:50', '2020-09-29 13:54:50'),
(510, 'user', '$2y$10$mGqfKHDQFaYNwqlCXDJYG.nm2kYQYNV9B7rpt44O1BvKAnnp1Sz.K', NULL, 'ali@yopmail.com', 'ali', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, '2020-10-20 12:00:29', '2020-10-21 08:43:32'),
(511, 'user', '$2y$10$p2CrO9B7gaBGTm0eXN6Bpe2y266ThusjPngeeVFgbOB4zbuFOF.4i', 'cjYsbIEflQWj42DNJhyMMZKWjG4zbk5H6EYTupuuf2ozq4SgHLCRABYL92va', 'subhan@yopmail.com', 'subhee', NULL, 'olsolghelet1610111426.jpg', NULL, NULL, NULL, 'Parsa Bazar Station', NULL, NULL, 1, 0, '2020-10-20 13:12:50', '2021-01-08 13:20:24'),
(512, 'user', '$2y$10$YeQQzROm4rO0fMkcmUOOUuyhhgrmiwKHWFrN2y1t5vfOevrL/NLYy', 'AVLkatRhRF3OL40NiBGUVRe6dyPFaf12Xpd2YX62HdBgw6EX9iMpZuIKYMhi', 'jim@yopmail.com', 'kkk', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2020-10-20 14:12:53', '2020-10-20 14:12:53'),
(513, 'user', '$2y$10$zx8RR7Ci6PFxgNDWpk7wVeN9W8gSU7kp6EFbSm.rPEPPDe3u4ojAO', 'BwfkZhjiWu50Tl1Ggo1mfZeYcCklX4VxseNOWgosxWMDQGIunmkKKGWD6DkM', 'test1@yopmail.com', 'Abc Test', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2020-10-27 10:17:51', '2020-10-27 10:17:51'),
(514, 'user', '$2y$10$Q0wQnIKIAHX3D3ZwXKFxr.jvVov4qVW7BUUpqZRH2VJvs0.OkULfO', 'G2JVcM5l8mHJzqoHn1jbrqV7mQ5IIBOT87Vx0oFur9RPKmF4aUwU6k03nRg1', 'cagatoy@yopmail.com', 'cagatoy william', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, '2020-10-27 10:18:35', '2020-10-27 11:00:15'),
(515, 'user', '$2y$10$SNzvoLRIr3Pg1TmrLA0aeevGH0ko446tRzt9o8SJ5ymF3Lfe3UuXm', 'INyt3d6P7TBs0n0S3m7w4u9YskZO7f27OIeYhrnaBOGRmnxRMeWzPKuwGcXJ', 'test1r4@yopmail.com', 'Abc Test', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, '2020-10-27 13:17:00', '2020-10-27 13:17:39'),
(516, 'user', '$2y$10$FrFZ.o9xWoB./zqXQnoQROXAYWrooZJanJwg9jhQ.Iy5AC2XamkLK', 'axLAvpoHV7gkdCdIdEIPiAqTsSJRBxKiIHaucRRjUmbYgCxeu246PKheYgYM', 'zubairabdullah662@gmail.com', 'zaid', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2020-10-27 14:05:24', '2020-10-27 14:05:24'),
(517, 'user', '$2y$10$KsBd07vG9XvITD4KbVnrtu1WqBx9FasdVx32pwR13/e1pjAKmg7GW', 'VQTBzuzmqv3pKGQAZ4qUGVvmXrLTtQ21sOpR2Qxn87DyZFrUPUk6w1fghmhm', 'ali123@yopmail.com', 'Ali', '+586565686568', NULL, NULL, NULL, NULL, 'Xgxgzgz', NULL, NULL, 1, 0, '2020-10-27 14:10:11', '2020-10-28 14:50:20'),
(518, 'user', '$2y$10$ZPRpvOYiOrh..N1fwAbLYeVG5MwuPclrIYtZGzCrS3bztCROUhJxi', 'DGHmmHXskPG3rILHBvByHrCrSsjzQ1FGi33M9ARaRIa7wKn9UXvn6FYXD9kW', 'testing2@yopmail.com', 'Testing', '03172458842', 'hoegtsllole1604321945.jpg', NULL, NULL, NULL, 'Grhrheeghddgsfegfe\nGrrgggefstye\nThhrrhhrdh', NULL, NULL, 1, 0, '2020-11-02 12:55:29', '2021-01-08 11:36:31'),
(519, 'user', '$2y$10$0C5PH3vjDDj5YU81ghs3ZuaDR8Ck/fkb8zxgnU8MCNMOaqvKzLVUu', 'kLwHSOo1xAFUqvbPlSmDj1qyqcedyrQUU7GZkiiFBYMH4X52RMG9fFxOkRgw', 'bassginger1@yahoo.com', 'Andres', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2020-12-15 16:42:04', '2020-12-15 16:42:04'),
(520, 'user', '$2y$10$81Ba5AN4XuVg.Cpade/lNeiUZdgv25cbIuT7Kr5RaRL5prjabDi1u', 'A3l2Vvtz1fw00EgPgpFVbIDz8M8buPRRGPqqZazsqlujiJaGppPMq1YlgKJA', 'bassfinger1@yahoo.com', 'Paul Hernandez', '5555555555', 'eehtslloolg1610733049.jpeg', NULL, NULL, NULL, 'bruh what is going on here. take it to the moon!', NULL, NULL, 1, 0, '2020-12-15 16:54:54', '2021-03-04 21:23:26'),
(521, 'user', '$2y$10$88dJ9HutXC1vey9rFAC3MOsny6XQVzBV.cqAhQe0u3qbBfsc23FvG', 'rkCOCW0deROMC4wrfy7upoXn8rhRdreZW0UDtOo4PavT32rpN6KwyWJjvWND', 'john@yopmail.com', 'John Williams', NULL, NULL, NULL, NULL, NULL, 'hggg', NULL, NULL, 1, 0, '2021-01-08 11:01:31', '2021-01-11 07:40:48'),
(522, 'user', '$2y$10$bSHG7kb5MsD0VX9GlPE25u2oXFa1CprDNkedlG0nyRJ.wnpHR8tYi', 'fCSnAznh6HOUvZbFNW837TpDzvRPviwJeDwOuYKp85D12dEWqoWJnBVX7qoB', 'parsa@yopmail.com', 'Parsa', '', NULL, NULL, '', '', '', NULL, NULL, 1, 0, '2021-01-08 11:49:22', '2021-01-08 13:31:05'),
(523, 'user', '$2y$10$aYzggb1omeUoq/m.B/kzoOsXitn.c5konOcmL/QCDM0bOp00tHKO.', NULL, 'shahzad@yopmail.com', 'Shahzad', NULL, 'hgtlloleseo1610112866.jpeg', NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, '2021-01-08 13:34:27', '2021-01-08 13:39:33'),
(524, 'user', '$2y$10$2Yx9pK5SWJpVVPAO0VWD.Oqs.PI9PTQb3Nzc3QVmjHfXEqrrKyEUK', 'Fapnp9p5njlJ2VigravBOwcGtRqFaSbKjkRYwfHh4NOvjpZaQPODf6EV2hO4', 'test2@yopmail.com', 'Test2', '', NULL, NULL, '', '', 'hello', NULL, NULL, 0, 0, '2021-01-18 08:33:02', '2021-05-28 08:24:39');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`),
  ADD KEY `events_user_table` (`created_by`);

--
-- Indexes for table `event_participants`
--
ALTER TABLE `event_participants`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `event_tickets`
--
ALTER TABLE `event_tickets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `event_ticket_bookings`
--
ALTER TABLE `event_ticket_bookings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `event_interests_events_table` (`event_id`),
  ADD KEY `event_interests_users_table` (`user_id`);

--
-- Indexes for table `event_ticket_booking_details`
--
ALTER TABLE `event_ticket_booking_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `event_interests_events_table` (`event_id`),
  ADD KEY `event_interests_users_table` (`user_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `ticket_types`
--
ALTER TABLE `ticket_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `utype` (`utype`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `event_participants`
--
ALTER TABLE `event_participants`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `event_tickets`
--
ALTER TABLE `event_tickets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `event_ticket_bookings`
--
ALTER TABLE `event_ticket_bookings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `event_ticket_booking_details`
--
ALTER TABLE `event_ticket_booking_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `password_resets`
--
ALTER TABLE `password_resets`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ticket_types`
--
ALTER TABLE `ticket_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=525;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
