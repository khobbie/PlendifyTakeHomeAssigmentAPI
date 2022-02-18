-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 18, 2022 at 03:20 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `plendify`
--

-- --------------------------------------------------------

--
-- Table structure for table `currencies`
--

CREATE TABLE `currencies` (
  `id` int(15) NOT NULL,
  `base_currency` varchar(5) DEFAULT NULL,
  `currency_rates` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT current_timestamp(),
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `currencies`
--

INSERT INTO `currencies` (`id`, `base_currency`, `currency_rates`, `updated_at`, `created_at`) VALUES
(1, 'USD', '{\"AED\":3.6731,\"AFN\":92.000005,\"ALL\":106.79,\"AMD\":480.387389,\"ANG\":1.801163,\"AOA\":515.041,\"ARS\":106.670302,\"AUD\":1.389132,\"AWG\":1.80025,\"AZN\":1.7,\"BAM\":1.719804,\"BBD\":2,\"BDT\":85.922466,\"BGN\":1.721755,\"BHD\":0.37697,\"BIF\":2019,\"BMD\":1,\"BND\":1.343111,\"BOB\":6.880894,\"BRL\":5.1669,\"BSD\":1,\"BTC\":2.3868895e-5,\"BTN\":74.934868,\"BWP\":11.45475,\"BYN\":2.571466,\"BZD\":2.014535,\"CAD\":1.269357,\"CDF\":2015,\"CHF\":0.920116,\"CLF\":0.028906,\"CLP\":797,\"CNH\":6.334152,\"CNY\":6.3373,\"COP\":3956,\"CRC\":638.67573,\"CUC\":1,\"CUP\":25.75,\"CVE\":97.4,\"CZK\":21.443657,\"DJF\":177.922727,\"DKK\":6.54203,\"DOP\":56.83,\"DZD\":140.67,\"EGP\":15.7343,\"ERN\":15.00001,\"ETB\":50.525,\"EUR\":0.879553,\"FJD\":2.1475,\"FKP\":0.734201,\"GBP\":0.734201,\"GEL\":2.99,\"GGP\":0.734201,\"GHS\":6.5,\"GIP\":0.734201,\"GMD\":53.125,\"GNF\":8999,\"GTQ\":7.685503,\"GYD\":208.992684,\"HKD\":7.799448,\"HNL\":24.59,\"HRK\":6.6275,\"HTG\":103.278116,\"HUF\":314.171481,\"IDR\":14343.8,\"ILS\":3.209997,\"IMP\":0.734201,\"INR\":75.065749,\"IQD\":1460.5,\"IRR\":42250,\"ISK\":124.38,\"JEP\":0.734201,\"JMD\":156.699969,\"JOD\":0.709,\"JPY\":114.9655,\"KES\":113.65,\"KGS\":84.799702,\"KHR\":4067,\"KMF\":432.850154,\"KPW\":900,\"KRW\":1197.970436,\"KWD\":0.302412,\"KYD\":0.832879,\"KZT\":428.799515,\"LAK\":11444.752526,\"LBP\":1514,\"LKR\":202.625281,\"LRD\":154.000004,\"LSL\":15.06,\"LYD\":4.585,\"MAD\":9.3645,\"MDL\":17.834945,\"MGA\":3979.718219,\"MKD\":54.179893,\"MMK\":1776.958729,\"MNT\":2865.605582,\"MOP\":8.030603,\"MRU\":36.4,\"MUR\":43.149999,\"MVR\":15.45,\"MWK\":803.5,\"MXN\":20.297554,\"MYR\":4.18525,\"MZN\":63.850001,\"NAD\":15.06,\"NGN\":415.87,\"NIO\":35.434757,\"NOK\":8.915677,\"NPR\":119.896094,\"NZD\":1.491755,\"OMR\":0.384985,\"PAB\":1,\"PEN\":3.744246,\"PGK\":3.515,\"PHP\":51.305998,\"PKR\":175.75,\"PLN\":3.98031,\"PYG\":6939.443105,\"QAR\":3.641,\"RON\":4.3471,\"RSD\":103.433532,\"RUB\":76.334,\"RWF\":1019,\"SAR\":3.752173,\"SBD\":8.080841,\"SCR\":12.87059,\"SDG\":444,\"SEK\":9.334678,\"SGD\":1.342969,\"SHP\":0.734201,\"SLL\":11423.74999,\"SOS\":584,\"SRD\":20.6345,\"SSP\":130.26,\"STD\":21146.190504,\"STN\":21.8,\"SVC\":8.744818,\"SYP\":2512,\"SZL\":14.968807,\"THB\":32.126663,\"TJS\":11.278485,\"TMT\":3.51,\"TND\":2.8725,\"TOP\":2.254145,\"TRY\":13.583,\"TTD\":6.782676,\"TWD\":27.8745,\"TZS\":2314,\"UAH\":28.318399,\"UGX\":3507.985373,\"USD\":1,\"UYU\":43.053599,\"UZS\":10850,\"VES\":4.43135,\"VND\":22784.234493,\"VUV\":113.920207,\"WST\":2.622912,\"XAF\":576.949197,\"XAG\":0.04205221,\"XAU\":0.00052769,\"XCD\":2.70255,\"XDR\":0.7129,\"XOF\":576.949197,\"XPD\":0.0004239,\"XPF\":104.958637,\"XPT\":0.00092274,\"YER\":250.249937,\"ZAR\":14.946516,\"ZMW\":17.489965,\"ZWL\":322}', '2022-02-17 16:18:54', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(15) NOT NULL,
  `product_uuid` varchar(225) DEFAULT NULL,
  `name` text DEFAULT NULL,
  `description` text DEFAULT NULL,
  `price` double DEFAULT 0,
  `currency` varchar(5) DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `product_uuid`, `name`, `description`, `price`, `currency`, `updated_at`, `created_at`) VALUES
(27, 'e7b4683d90b911ecad2854ee75bcf4ce', 'Laptop', 'Thinkpad Carbon X1', 56, NULL, '2022-02-18 12:54:27', '2022-02-18 12:54:27'),
(28, 'd370579890ba11ecad2854ee75bcf4ce', 'Dream', 'Sleeping in the bed room', 45, NULL, '2022-02-18 13:01:02', '2022-02-18 13:01:02');

--
-- Triggers `products`
--
DELIMITER $$
CREATE TRIGGER `generate_uuid_for_products_trig` BEFORE INSERT ON `products` FOR EACH ROW SET new.product_uuid = replace(uuid(), '-', '')
$$
DELIMITER ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `currencies`
--
ALTER TABLE `currencies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `currencies`
--
ALTER TABLE `currencies`
  MODIFY `id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
