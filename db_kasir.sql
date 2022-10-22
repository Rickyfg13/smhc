-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 01, 2021 at 05:35 AM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 7.4.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_kasir`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` varchar(10) NOT NULL,
  `slug` varchar(100) NOT NULL,
  `title` varchar(60) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `slug`, `title`, `created_at`, `updated_at`) VALUES
('102001', 'treatment', 'Treatment', '2021-01-27 14:09:06', '2021-01-27 14:22:17'),
('102002', 'product', 'Product', '2021-01-27 14:28:53', '2021-01-27 14:28:53');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `id` varchar(100) NOT NULL,
  `id_store` int(11) NOT NULL DEFAULT 1,
  `identity_number` varchar(50) NOT NULL,
  `name` varchar(255) NOT NULL,
  `birth_date` date DEFAULT NULL,
  `phone` varchar(15) NOT NULL,
  `email` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `job` varchar(200) NOT NULL,
  `previous_skincare` varchar(200) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `discount`
--

CREATE TABLE `discount` (
  `id` bigint(20) NOT NULL,
  `title_discount` varchar(255) NOT NULL,
  `value` int(11) NOT NULL,
  `tgl_start` date NOT NULL,
  `tgl_end` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `doctor`
--

CREATE TABLE `doctor` (
  `id` varchar(100) NOT NULL,
  `name` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `birth_date` date NOT NULL,
  `identity_number` varchar(50) NOT NULL,
  `idi_number` varchar(50) NOT NULL,
  `sip_number` varchar(50) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `email` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `id` varchar(100) NOT NULL,
  `note` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `items_detail`
--

CREATE TABLE `items_detail` (
  `id` varchar(100) NOT NULL,
  `id_product` varchar(20) NOT NULL,
  `qty` int(11) NOT NULL,
  `id_items` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `medical_records`
--

CREATE TABLE `medical_records` (
  `id` varchar(255) NOT NULL,
  `id_doctor` varchar(100) NOT NULL,
  `id_customer` varchar(100) NOT NULL,
  `id_store` int(11) NOT NULL DEFAULT 1,
  `id_queue` varchar(100) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `medical_records_detail`
--

CREATE TABLE `medical_records_detail` (
  `id` varchar(100) NOT NULL,
  `id_medical_records` varchar(255) NOT NULL,
  `anamnesa` text NOT NULL,
  `pemeriksaan` text NOT NULL,
  `diagnosa` text NOT NULL,
  `id_therapies` varchar(100) NOT NULL,
  `id_items` varchar(100) DEFAULT NULL,
  `id_queue` varchar(100) NOT NULL,
  `image_before` varchar(255) DEFAULT NULL,
  `image_after` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` varchar(20) NOT NULL,
  `id_category` varchar(10) NOT NULL,
  `id_store` int(11) NOT NULL DEFAULT 1,
  `slug` varchar(200) NOT NULL,
  `title` varchar(200) NOT NULL,
  `stock` int(11) NOT NULL DEFAULT 0,
  `price` int(11) NOT NULL,
  `purchase_price` int(11) NOT NULL DEFAULT 0,
  `is_available` tinyint(4) NOT NULL DEFAULT 1,
  `image` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `id_category`, `id_store`, `slug`, `title`, `stock`, `price`, `purchase_price`, `is_available`, `image`, `created_at`, `updated_at`) VALUES
('1020010001', '102001', 1, 'basic-facial-1', 'Basic Facial', 0, 100000, 0, 1, '', '2021-07-01 09:00:36', '2021-07-01 09:00:36'),
('1020010002', '102001', 1, 'basic-facial-paket-5x-1', 'Basic Facial Paket 5x', 0, 500000, 0, 1, '', '2021-07-01 09:02:57', '2021-07-01 09:02:57'),
('1020010003', '102001', 1, 'acne-brightening-facial-1', 'Acne/Brightening Facial', 0, 250000, 0, 1, '', '2021-07-01 09:03:33', '2021-07-01 09:03:33'),
('1020010004', '102001', 1, 'acne-brightening-facial-paket-5x-1', 'Acne/Brightening Facial Paket 5x', 0, 1250000, 0, 1, '', '2021-07-01 09:03:50', '2021-07-01 09:03:50'),
('1020010005', '102001', 1, 'rejuve-facial-1', 'Rejuve Facial', 0, 390000, 0, 1, '', '2021-07-01 09:06:03', '2021-07-01 09:06:03'),
('1020010006', '102001', 1, 'rejuve-facial-paket-5x-1', 'Rejuve Facial Paket 5x', 0, 1950000, 0, 1, '', '2021-07-01 09:07:19', '2021-07-01 09:07:19'),
('1020010007', '102001', 1, 'gold-facial-1', 'GOLD Facial', 0, 600000, 0, 1, '', '2021-07-01 09:07:45', '2021-07-01 09:07:45'),
('1020010008', '102001', 1, 'gold-facial-paket-5x-1', 'GOLD Facial Paket 5x', 0, 3000000, 0, 1, '', '2021-07-01 09:08:07', '2021-07-01 09:08:07'),
('1020010009', '102001', 1, 'oxygeneo-1', 'Oxygeneo', 0, 600000, 0, 1, '', '2021-07-01 09:09:00', '2021-07-01 09:09:00'),
('1020010010', '102001', 1, 'oxygeneo-paket-5x-1', 'Oxygeneo Paket 5x', 0, 3000000, 0, 1, '', '2021-07-01 09:09:15', '2021-07-01 09:09:15'),
('1020010011', '102001', 1, 'biolight-therapy-1', 'BioLight Therapy', 0, 100000, 0, 1, '', '2021-07-01 09:09:33', '2021-07-01 09:09:33'),
('1020010012', '102001', 1, 'totok-wajah-1', 'Totok Wajah', 0, 35000, 0, 1, '', '2021-07-01 09:09:59', '2021-07-01 09:09:59'),
('1020010013', '102001', 1, 'premium-organic-mask-1', 'Premium Organic Mask', 0, 225000, 0, 1, '', '2021-07-01 09:10:21', '2021-07-01 09:10:21'),
('1020010014', '102001', 1, 'brightening-peeling-1', 'Brightening Peeling', 0, 350000, 0, 1, '', '2021-07-01 09:11:15', '2021-07-01 09:11:15'),
('1020010015', '102001', 1, 'lifting-peeling-1', 'Lifting Peeling', 0, 350000, 0, 1, '', '2021-07-01 09:11:29', '2021-07-01 09:11:29'),
('1020010016', '102001', 1, 'clarfying-peel-1', 'Clarfying Peel', 0, 350000, 0, 1, '', '2021-07-01 09:12:43', '2021-07-01 09:12:43'),
('1020010017', '102001', 1, 'acne-blue-light-peel-1', 'Acne Blue Light Peel', 0, 300000, 0, 1, '', '2021-07-01 09:13:04', '2021-07-01 09:13:04'),
('1020010018', '102001', 1, 'hands-feet-peel-body-peel-1', 'Hands & Feet Peel (Body Peel)', 0, 500000, 0, 1, '', '2021-07-01 09:13:51', '2021-07-01 09:13:51'),
('1020010019', '102001', 1, 'arm-peel-body-peel-1', 'Arm Peel (Body Peel)', 0, 500000, 0, 1, '', '2021-07-01 09:14:10', '2021-07-01 09:14:10'),
('1020010020', '102001', 1, 'leg-peel-1', 'Leg Peel', 0, 500000, 0, 1, '', '2021-07-01 09:14:22', '2021-07-01 09:14:22'),
('1020010021', '102001', 1, 'flek-peel-1', 'Flek Peel', 0, 700000, 0, 1, '', '2021-07-01 09:14:49', '2021-07-01 09:14:49'),
('1020010022', '102001', 1, 'radio-fraquency-1-1', 'Radio Fraquency 1', 0, 250000, 0, 1, '', '2021-07-01 09:17:49', '2021-07-01 09:17:49'),
('1020010023', '102001', 1, 'radio-fraquency-1-paket-5x-1', 'Radio Fraquency 1 Paket 5x', 0, 1250000, 0, 1, '', '2021-07-01 09:18:04', '2021-07-01 09:18:04'),
('1020010024', '102001', 1, 'radio-fraquency-2-1', 'Radio Fraquency 2', 0, 400000, 0, 1, '', '2021-07-01 09:18:20', '2021-07-01 09:18:20'),
('1020010025', '102001', 1, 'radio-fraquency-2-paket-5x-1', 'Radio Fraquency 2 Paket 5x', 0, 2000000, 0, 1, '', '2021-07-01 09:20:22', '2021-07-01 09:20:22'),
('1020010026', '102001', 1, 'skin-booster-1', 'Skin Booster', 0, 1300000, 0, 1, '', '2021-07-01 09:20:44', '2021-07-01 09:20:44'),
('1020010027', '102001', 1, 'korean-infusion-1', 'Korean Infusion', 0, 450000, 0, 1, '', '2021-07-01 09:22:15', '2021-07-01 09:22:15'),
('1020010028', '102001', 1, 'glow-infusion-1', 'Glow Infusion', 0, 700000, 0, 1, '', '2021-07-01 09:22:32', '2021-07-01 09:22:32'),
('1020010029', '102001', 1, 'premium-infusion-1', 'Premium Infusion', 0, 2000000, 0, 1, '', '2021-07-01 09:22:45', '2021-07-01 09:22:45'),
('1020010030', '102001', 1, 'chromosom-infusion-1', 'Chromosom Infusion', 0, 5000000, 0, 1, '', '2021-07-01 09:23:00', '2021-07-01 09:23:00'),
('1020010031', '102001', 1, 'meso-slimming-1', 'Meso Slimming', 0, 200000, 0, 1, '', '2021-07-01 09:37:02', '2021-07-01 09:37:02'),
('1020010032', '102001', 1, 'meso-chubby-cheek-1', 'Meso Chubby Cheek', 0, 500000, 0, 1, '', '2021-07-01 09:37:21', '2021-07-01 09:37:21'),
('1020010033', '102001', 1, 'meso-double-chin-1', 'Meso Double Chin', 0, 500000, 0, 1, '', '2021-07-01 09:37:36', '2021-07-01 09:37:36'),
('1020010034', '102001', 1, 'meso-bright-1', 'Meso Bright', 0, 600000, 0, 1, '', '2021-07-01 09:37:54', '2021-07-01 09:37:54'),
('1020010035', '102001', 1, 'meso-flek-1', 'Meso Flek', 0, 600000, 0, 1, '', '2021-07-01 09:38:09', '2021-07-01 09:38:09'),
('1020010036', '102001', 1, 'meso-pdrn-dna-salmon-1', 'Meso PDRN (DNA Salmon)', 0, 800000, 0, 1, '', '2021-07-01 09:38:28', '2021-07-01 09:38:28'),
('1020010037', '102001', 1, 'meso-scar-prp-1', 'Meso Scar PRP', 0, 600000, 0, 1, '', '2021-07-01 09:39:10', '2021-07-01 09:39:10'),
('1020010038', '102001', 1, 'growth-factor-serum-1', 'Growth Factor Serum', 0, 200000, 0, 1, '', '2021-07-01 09:39:31', '2021-07-01 09:39:31'),
('1020010039', '102001', 1, 'hyperpigmentation-c-plus-ruikd-laser', 'Hyperpigmentation (C Plus RUIKD Laser)', 0, 750000, 0, 1, '', '2021-07-01 09:41:16', '2021-07-01 09:42:40'),
('1020010040', '102001', 1, 'hyperpigmentation-paket-5x-c-plus-ruikd-laser', 'Hyperpigmentation Paket 5x (C Plus RUIKD Laser)', 0, 2500000, 0, 1, '', '2021-07-01 09:41:32', '2021-07-01 09:42:49'),
('1020010041', '102001', 1, 'skin-rejuve-whitening-c-plus-ruikd-laser', 'Skin Rejuve + Whitening (C Plus RUIKD Laser)', 0, 750000, 0, 1, '', '2021-07-01 09:41:57', '2021-07-01 09:42:58'),
('1020010042', '102001', 1, 'skin-rejuve-whitening-paket-5x-c-plus-ruikd-laser', 'Skin Rejuve + Whitening Paket 5x (C Plus RUIKD Laser)', 0, 2500000, 0, 1, '', '2021-07-01 09:42:09', '2021-07-01 09:43:05'),
('1020010043', '102001', 1, 'bibir-c-plus-ruikd-laser-1', 'Bibir (C Plus RUIKD Laser)', 0, 500000, 0, 1, '', '2021-07-01 09:43:57', '2021-07-01 09:43:57'),
('1020010044', '102001', 1, 'bibir-paket-5x-c-plus-ruikd-laser-1', 'Bibir Paket 5x (C Plus RUIKD Laser)', 0, 2000000, 0, 1, '', '2021-07-01 09:44:11', '2021-07-01 09:44:11'),
('1020010045', '102001', 1, 'acne-i-toning-ruikd-1', 'Acne (I-Toning RUIKD)', 0, 750000, 0, 1, '', '2021-07-01 09:44:49', '2021-07-01 09:44:49'),
('1020010046', '102001', 1, 'acne-paket-5x-i-toning-ruikd-1', 'Acne Paket 5x (I-Toning RUIKD)', 0, 2500000, 0, 1, '', '2021-07-01 09:45:04', '2021-07-01 09:45:04'),
('1020010047', '102001', 1, 'brightening-i-toning-ruikd-1', 'Brightening (I-Toning RUIKD)', 0, 750000, 0, 1, '', '2021-07-01 09:45:20', '2021-07-01 09:45:20'),
('1020010048', '102001', 1, 'brightening-paket-5x-i-toning-ruikd-1', 'Brightening Paket 5x (I-Toning RUIKD)', 0, 2500000, 0, 1, '', '2021-07-01 09:45:35', '2021-07-01 09:45:35'),
('1020010049', '102001', 1, 'rejuve-i-toning-ruikd-1', 'Rejuve (I-Toning RUIKD)', 0, 750000, 0, 1, '', '2021-07-01 09:45:49', '2021-07-01 09:45:49'),
('1020010050', '102001', 1, 'rejuve-paket-5x-i-toning-ruikd-1', 'Rejuve Paket 5x (I-Toning RUIKD)', 0, 2500000, 0, 1, '', '2021-07-01 09:46:02', '2021-07-01 09:46:02'),
('1020010051', '102001', 1, 'kumis-i-toning-ruikd-hair-removal-1', 'Kumis (I-Toning RUIKD Hair Removal)', 0, 500000, 0, 1, '', '2021-07-01 09:51:30', '2021-07-01 09:51:30'),
('1020010052', '102001', 1, 'kumis-paket-5x-i-toning-ruikd-hair-removal-1', 'Kumis Paket 5x (I-Toning RUIKD Hair Removal)', 0, 2000000, 0, 1, '', '2021-07-01 09:51:44', '2021-07-01 09:51:44'),
('1020010053', '102001', 1, 'janggut-i-toning-ruikd-hair-removal-1', 'Janggut (I-Toning RUIKD Hair Removal)', 0, 500000, 0, 1, '', '2021-07-01 09:52:01', '2021-07-01 09:52:01'),
('1020010054', '102001', 1, 'janggut-paket-5x-i-toning-ruikd-hair-removal-1', 'Janggut Paket 5x (I-Toning RUIKD Hair Removal)', 0, 2000000, 0, 1, '', '2021-07-01 09:52:13', '2021-07-01 09:52:13'),
('1020010055', '102001', 1, 'ketiak-i-toning-ruikd-hair-removal-1', 'Ketiak (I-Toning RUIKD Hair Removal)', 0, 500000, 0, 1, '', '2021-07-01 09:55:38', '2021-07-01 09:55:38'),
('1020010056', '102001', 1, 'ketiak-paket-5x-i-toning-ruikd-hair-removal-1', 'Ketiak Paket 5x (I-Toning RUIKD Hair Removal)', 0, 2000000, 0, 1, '', '2021-07-01 09:55:53', '2021-07-01 09:55:53'),
('1020010057', '102001', 1, 'bikini-line-i-toning-ruikd-hair-removal-1', 'Bikini Line (I-Toning RUIKD Hair Removal)', 0, 500000, 0, 1, '', '2021-07-01 09:56:07', '2021-07-01 09:56:07'),
('1020010058', '102001', 1, 'bikini-line-paket-5x-i-toning-ruikd-hair-removal-1', 'Bikini Line Paket 5x (I-Toning RUIKD Hair Removal)', 0, 2000000, 0, 1, '', '2021-07-01 09:56:33', '2021-07-01 09:56:33'),
('1020010059', '102001', 1, 'betis-i-toning-ruikd-hair-removal-1', 'Betis (I-Toning RUIKD Hair Removal)', 0, 750000, 0, 1, '', '2021-07-01 09:56:46', '2021-07-01 09:56:46'),
('1020010060', '102001', 1, 'betis-paket-5x-i-toning-ruikd-hair-removal-1', 'Betis Paket 5x (I-Toning RUIKD Hair Removal)', 0, 2750000, 0, 1, '', '2021-07-01 09:57:01', '2021-07-01 09:57:01'),
('1020010061', '102001', 1, 'upper-face-hifu-1', 'Upper Face HIFU', 0, 800000, 0, 1, '', '2021-07-01 09:57:27', '2021-07-01 09:57:27'),
('1020010062', '102001', 1, 'upper-face-paket-5x-hifu-1', 'Upper Face Paket 5x HIFU', 0, 3000000, 0, 1, '', '2021-07-01 09:57:53', '2021-07-01 09:57:53'),
('1020010063', '102001', 1, 'cheek-hifu-1', 'Cheek HIFU', 0, 800000, 0, 1, '', '2021-07-01 09:59:06', '2021-07-01 09:59:06'),
('1020010064', '102001', 1, 'cheek-paket-5x-hifu-1', 'Cheek Paket 5x HIFU', 0, 3000000, 0, 1, '', '2021-07-01 09:59:22', '2021-07-01 09:59:22'),
('1020010065', '102001', 1, 'double-chin-hifu-1', 'Double Chin HIFU', 0, 800000, 0, 1, '', '2021-07-01 09:59:35', '2021-07-01 09:59:35'),
('1020010066', '102001', 1, 'double-chin-paket-5x-hifu-1', 'Double Chin Paket 5x HIFU', 0, 3000000, 0, 1, '', '2021-07-01 09:59:53', '2021-07-01 09:59:53'),
('1020010067', '102001', 1, 'neck-hifu-1', 'Neck HIFU', 0, 800000, 0, 1, '', '2021-07-01 10:00:10', '2021-07-01 10:00:10'),
('1020010068', '102001', 1, 'neck-paket-5x-hifu-1', 'Neck Paket 5x HIFU', 0, 3000000, 0, 1, '', '2021-07-01 10:00:21', '2021-07-01 10:00:21'),
('1020010069', '102001', 1, 'vaginal-tightening-hifu-1', 'Vaginal Tightening HIFU', 0, 1000000, 0, 1, '', '2021-07-01 10:00:43', '2021-07-01 10:00:43'),
('1020010070', '102001', 2, 'basic-facial-1-2', 'Basic Facial', 0, 100000, 0, 1, NULL, '2021-07-01 10:05:57', '2021-07-01 10:05:57'),
('1020010071', '102001', 2, 'basic-facial-paket-5x-1-2', 'Basic Facial Paket 5x', 0, 500000, 0, 1, NULL, '2021-07-01 10:05:57', '2021-07-01 10:05:57'),
('1020010072', '102001', 2, 'acne-brightening-facial-1-2', 'Acne/Brightening Facial', 0, 250000, 0, 1, NULL, '2021-07-01 10:05:57', '2021-07-01 10:05:57'),
('1020010073', '102001', 2, 'acne-brightening-facial-paket-5x-1-2', 'Acne/Brightening Facial Paket 5x', 0, 1250000, 0, 1, NULL, '2021-07-01 10:05:57', '2021-07-01 10:05:57'),
('1020010074', '102001', 2, 'rejuve-facial-1-2', 'Rejuve Facial', 0, 390000, 0, 1, NULL, '2021-07-01 10:05:57', '2021-07-01 10:05:57'),
('1020010075', '102001', 2, 'rejuve-facial-paket-5x-1-2', 'Rejuve Facial Paket 5x', 0, 1950000, 0, 1, NULL, '2021-07-01 10:05:57', '2021-07-01 10:05:57'),
('1020010076', '102001', 2, 'gold-facial-1-2', 'GOLD Facial', 0, 600000, 0, 1, NULL, '2021-07-01 10:05:57', '2021-07-01 10:05:57'),
('1020010077', '102001', 2, 'gold-facial-paket-5x-1-2', 'GOLD Facial Paket 5x', 0, 3000000, 0, 1, NULL, '2021-07-01 10:05:57', '2021-07-01 10:05:57'),
('1020010078', '102001', 2, 'oxygeneo-1-2', 'Oxygeneo', 0, 600000, 0, 1, NULL, '2021-07-01 10:05:57', '2021-07-01 10:05:57'),
('1020010079', '102001', 2, 'oxygeneo-paket-5x-1-2', 'Oxygeneo Paket 5x', 0, 3000000, 0, 1, NULL, '2021-07-01 10:05:57', '2021-07-01 10:05:57'),
('1020010080', '102001', 2, 'biolight-therapy-1-2', 'BioLight Therapy', 0, 100000, 0, 1, NULL, '2021-07-01 10:05:57', '2021-07-01 10:05:57'),
('1020010081', '102001', 2, 'totok-wajah-1-2', 'Totok Wajah', 0, 35000, 0, 1, NULL, '2021-07-01 10:05:57', '2021-07-01 10:05:57'),
('1020010082', '102001', 2, 'premium-organic-mask-1-2', 'Premium Organic Mask', 0, 225000, 0, 1, NULL, '2021-07-01 10:05:57', '2021-07-01 10:05:57'),
('1020010083', '102001', 2, 'brightening-peeling-1-2', 'Brightening Peeling', 0, 350000, 0, 1, NULL, '2021-07-01 10:05:57', '2021-07-01 10:05:57'),
('1020010084', '102001', 2, 'lifting-peeling-1-2', 'Lifting Peeling', 0, 350000, 0, 1, NULL, '2021-07-01 10:05:57', '2021-07-01 10:05:57'),
('1020010085', '102001', 2, 'clarfying-peel-1-2', 'Clarfying Peel', 0, 350000, 0, 1, NULL, '2021-07-01 10:05:57', '2021-07-01 10:05:57'),
('1020010086', '102001', 2, 'acne-blue-light-peel-1-2', 'Acne Blue Light Peel', 0, 300000, 0, 1, NULL, '2021-07-01 10:05:57', '2021-07-01 10:05:57'),
('1020010087', '102001', 2, 'hands-feet-peel-body-peel-1-2', 'Hands & Feet Peel (Body Peel)', 0, 500000, 0, 1, NULL, '2021-07-01 10:05:57', '2021-07-01 10:05:57'),
('1020010088', '102001', 2, 'arm-peel-body-peel-1-2', 'Arm Peel (Body Peel)', 0, 500000, 0, 1, NULL, '2021-07-01 10:05:57', '2021-07-01 10:05:57'),
('1020010089', '102001', 2, 'leg-peel-1-2', 'Leg Peel', 0, 500000, 0, 1, NULL, '2021-07-01 10:05:57', '2021-07-01 10:05:57'),
('1020010090', '102001', 2, 'flek-peel-1-2', 'Flek Peel', 0, 700000, 0, 1, NULL, '2021-07-01 10:05:57', '2021-07-01 10:05:57'),
('1020010091', '102001', 2, 'radio-fraquency-1-1-2', 'Radio Fraquency 1', 0, 250000, 0, 1, NULL, '2021-07-01 10:05:57', '2021-07-01 10:05:57'),
('1020010092', '102001', 2, 'radio-fraquency-1-paket-5x-1-2', 'Radio Fraquency 1 Paket 5x', 0, 1250000, 0, 1, NULL, '2021-07-01 10:05:57', '2021-07-01 10:05:57'),
('1020010093', '102001', 2, 'radio-fraquency-2-1-2', 'Radio Fraquency 2', 0, 400000, 0, 1, NULL, '2021-07-01 10:05:57', '2021-07-01 10:05:57'),
('1020010094', '102001', 2, 'radio-fraquency-2-paket-5x-1-2', 'Radio Fraquency 2 Paket 5x', 0, 2000000, 0, 1, NULL, '2021-07-01 10:05:57', '2021-07-01 10:05:57'),
('1020010095', '102001', 2, 'skin-booster-1-2', 'Skin Booster', 0, 1300000, 0, 1, NULL, '2021-07-01 10:05:57', '2021-07-01 10:05:57'),
('1020010096', '102001', 2, 'korean-infusion-1-2', 'Korean Infusion', 0, 450000, 0, 1, NULL, '2021-07-01 10:05:57', '2021-07-01 10:05:57'),
('1020010097', '102001', 2, 'glow-infusion-1-2', 'Glow Infusion', 0, 700000, 0, 1, NULL, '2021-07-01 10:05:57', '2021-07-01 10:05:57'),
('1020010098', '102001', 2, 'premium-infusion-1-2', 'Premium Infusion', 0, 2000000, 0, 1, NULL, '2021-07-01 10:05:57', '2021-07-01 10:05:57'),
('1020010099', '102001', 2, 'chromosom-infusion-1-2', 'Chromosom Infusion', 0, 5000000, 0, 1, NULL, '2021-07-01 10:05:57', '2021-07-01 10:05:57'),
('1020010100', '102001', 2, 'meso-slimming-1-2', 'Meso Slimming', 0, 200000, 0, 1, NULL, '2021-07-01 10:05:57', '2021-07-01 10:05:57'),
('1020010101', '102001', 2, 'meso-chubby-cheek-1-2', 'Meso Chubby Cheek', 0, 500000, 0, 1, NULL, '2021-07-01 10:05:57', '2021-07-01 10:05:57'),
('1020010102', '102001', 2, 'meso-double-chin-1-2', 'Meso Double Chin', 0, 500000, 0, 1, NULL, '2021-07-01 10:05:57', '2021-07-01 10:05:57'),
('1020010103', '102001', 2, 'meso-bright-1-2', 'Meso Bright', 0, 600000, 0, 1, NULL, '2021-07-01 10:05:57', '2021-07-01 10:05:57'),
('1020010104', '102001', 2, 'meso-flek-1-2', 'Meso Flek', 0, 600000, 0, 1, NULL, '2021-07-01 10:05:57', '2021-07-01 10:05:57'),
('1020010105', '102001', 2, 'meso-pdrn-dna-salmon-1-2', 'Meso PDRN (DNA Salmon)', 0, 800000, 0, 1, NULL, '2021-07-01 10:05:57', '2021-07-01 10:05:57'),
('1020010106', '102001', 2, 'meso-scar-prp-1-2', 'Meso Scar PRP', 0, 600000, 0, 1, NULL, '2021-07-01 10:05:57', '2021-07-01 10:05:57'),
('1020010107', '102001', 2, 'growth-factor-serum-1-2', 'Growth Factor Serum', 0, 200000, 0, 1, NULL, '2021-07-01 10:05:57', '2021-07-01 10:05:57'),
('1020010108', '102001', 2, 'hyperpigmentation-c-plus-ruikd-laser-2', 'Hyperpigmentation (C Plus RUIKD Laser)', 0, 750000, 0, 1, NULL, '2021-07-01 10:05:57', '2021-07-01 10:05:57'),
('1020010109', '102001', 2, 'hyperpigmentation-paket-5x-c-plus-ruikd-laser-2', 'Hyperpigmentation Paket 5x (C Plus RUIKD Laser)', 0, 2500000, 0, 1, NULL, '2021-07-01 10:05:57', '2021-07-01 10:05:57'),
('1020010110', '102001', 2, 'skin-rejuve-whitening-c-plus-ruikd-laser-2', 'Skin Rejuve + Whitening (C Plus RUIKD Laser)', 0, 750000, 0, 1, NULL, '2021-07-01 10:05:57', '2021-07-01 10:05:57'),
('1020010111', '102001', 2, 'skin-rejuve-whitening-paket-5x-c-plus-ruikd-laser-2', 'Skin Rejuve + Whitening Paket 5x (C Plus RUIKD Laser)', 0, 2500000, 0, 1, NULL, '2021-07-01 10:05:57', '2021-07-01 10:05:57'),
('1020010112', '102001', 2, 'bibir-c-plus-ruikd-laser-1-2', 'Bibir (C Plus RUIKD Laser)', 0, 500000, 0, 1, NULL, '2021-07-01 10:05:57', '2021-07-01 10:05:57'),
('1020010113', '102001', 2, 'bibir-paket-5x-c-plus-ruikd-laser-1-2', 'Bibir Paket 5x (C Plus RUIKD Laser)', 0, 2000000, 0, 1, NULL, '2021-07-01 10:05:57', '2021-07-01 10:05:57'),
('1020010114', '102001', 2, 'acne-i-toning-ruikd-1-2', 'Acne (I-Toning RUIKD)', 0, 750000, 0, 1, NULL, '2021-07-01 10:05:57', '2021-07-01 10:05:57'),
('1020010115', '102001', 2, 'acne-paket-5x-i-toning-ruikd-1-2', 'Acne Paket 5x (I-Toning RUIKD)', 0, 2500000, 0, 1, NULL, '2021-07-01 10:05:57', '2021-07-01 10:05:57'),
('1020010116', '102001', 2, 'brightening-i-toning-ruikd-1-2', 'Brightening (I-Toning RUIKD)', 0, 750000, 0, 1, NULL, '2021-07-01 10:05:57', '2021-07-01 10:05:57'),
('1020010117', '102001', 2, 'brightening-paket-5x-i-toning-ruikd-1-2', 'Brightening Paket 5x (I-Toning RUIKD)', 0, 2500000, 0, 1, NULL, '2021-07-01 10:05:57', '2021-07-01 10:05:57'),
('1020010118', '102001', 2, 'rejuve-i-toning-ruikd-1-2', 'Rejuve (I-Toning RUIKD)', 0, 750000, 0, 1, NULL, '2021-07-01 10:05:57', '2021-07-01 10:05:57'),
('1020010119', '102001', 2, 'rejuve-paket-5x-i-toning-ruikd-1-2', 'Rejuve Paket 5x (I-Toning RUIKD)', 0, 2500000, 0, 1, NULL, '2021-07-01 10:05:57', '2021-07-01 10:05:57'),
('1020010120', '102001', 2, 'kumis-i-toning-ruikd-hair-removal-1-2', 'Kumis (I-Toning RUIKD Hair Removal)', 0, 500000, 0, 1, NULL, '2021-07-01 10:05:57', '2021-07-01 10:05:57'),
('1020010121', '102001', 2, 'kumis-paket-5x-i-toning-ruikd-hair-removal-1-2', 'Kumis Paket 5x (I-Toning RUIKD Hair Removal)', 0, 2000000, 0, 1, NULL, '2021-07-01 10:05:57', '2021-07-01 10:05:57'),
('1020010122', '102001', 2, 'janggut-i-toning-ruikd-hair-removal-1-2', 'Janggut (I-Toning RUIKD Hair Removal)', 0, 500000, 0, 1, NULL, '2021-07-01 10:05:57', '2021-07-01 10:05:57'),
('1020010123', '102001', 2, 'janggut-paket-5x-i-toning-ruikd-hair-removal-1-2', 'Janggut Paket 5x (I-Toning RUIKD Hair Removal)', 0, 2000000, 0, 1, NULL, '2021-07-01 10:05:57', '2021-07-01 10:05:57'),
('1020010124', '102001', 2, 'ketiak-i-toning-ruikd-hair-removal-1-2', 'Ketiak (I-Toning RUIKD Hair Removal)', 0, 500000, 0, 1, NULL, '2021-07-01 10:05:57', '2021-07-01 10:05:57'),
('1020010125', '102001', 2, 'ketiak-paket-5x-i-toning-ruikd-hair-removal-1-2', 'Ketiak Paket 5x (I-Toning RUIKD Hair Removal)', 0, 2000000, 0, 1, NULL, '2021-07-01 10:05:57', '2021-07-01 10:05:57'),
('1020010126', '102001', 2, 'bikini-line-i-toning-ruikd-hair-removal-1-2', 'Bikini Line (I-Toning RUIKD Hair Removal)', 0, 500000, 0, 1, NULL, '2021-07-01 10:05:57', '2021-07-01 10:05:57'),
('1020010127', '102001', 2, 'bikini-line-paket-5x-i-toning-ruikd-hair-removal-1-2', 'Bikini Line Paket 5x (I-Toning RUIKD Hair Removal)', 0, 2000000, 0, 1, NULL, '2021-07-01 10:05:57', '2021-07-01 10:05:57'),
('1020010128', '102001', 2, 'betis-i-toning-ruikd-hair-removal-1-2', 'Betis (I-Toning RUIKD Hair Removal)', 0, 750000, 0, 1, NULL, '2021-07-01 10:05:57', '2021-07-01 10:05:57'),
('1020010129', '102001', 2, 'betis-paket-5x-i-toning-ruikd-hair-removal-1-2', 'Betis Paket 5x (I-Toning RUIKD Hair Removal)', 0, 2750000, 0, 1, NULL, '2021-07-01 10:05:57', '2021-07-01 10:05:57'),
('1020010130', '102001', 2, 'upper-face-hifu-1-2', 'Upper Face HIFU', 0, 800000, 0, 1, NULL, '2021-07-01 10:05:57', '2021-07-01 10:05:57'),
('1020010131', '102001', 2, 'upper-face-paket-5x-hifu-1-2', 'Upper Face Paket 5x HIFU', 0, 3000000, 0, 1, NULL, '2021-07-01 10:05:57', '2021-07-01 10:05:57'),
('1020010132', '102001', 2, 'cheek-hifu-1-2', 'Cheek HIFU', 0, 800000, 0, 1, NULL, '2021-07-01 10:05:57', '2021-07-01 10:05:57'),
('1020010133', '102001', 2, 'cheek-paket-5x-hifu-1-2', 'Cheek Paket 5x HIFU', 0, 3000000, 0, 1, NULL, '2021-07-01 10:05:57', '2021-07-01 10:05:57'),
('1020010134', '102001', 2, 'double-chin-hifu-1-2', 'Double Chin HIFU', 0, 800000, 0, 1, NULL, '2021-07-01 10:05:57', '2021-07-01 10:05:57'),
('1020010135', '102001', 2, 'double-chin-paket-5x-hifu-1-2', 'Double Chin Paket 5x HIFU', 0, 3000000, 0, 1, NULL, '2021-07-01 10:05:57', '2021-07-01 10:05:57'),
('1020010136', '102001', 2, 'neck-hifu-1-2', 'Neck HIFU', 0, 800000, 0, 1, NULL, '2021-07-01 10:05:57', '2021-07-01 10:05:57'),
('1020010137', '102001', 2, 'neck-paket-5x-hifu-1-2', 'Neck Paket 5x HIFU', 0, 3000000, 0, 1, NULL, '2021-07-01 10:05:57', '2021-07-01 10:05:57'),
('1020010138', '102001', 2, 'vaginal-tightening-hifu-1-2', 'Vaginal Tightening HIFU', 0, 1000000, 0, 1, NULL, '2021-07-01 10:05:57', '2021-07-01 10:05:57'),
('1020020001', '102002', 1, 'acne-ct', 'Acne CT', 0, 120000, 38500, 1, '', '2021-07-01 08:08:04', '2021-07-01 08:08:04'),
('1020020002', '102002', 1, 'acne-night-cream', 'Acne Night Cream', 0, 120000, 21600, 1, '', '2021-07-01 08:08:48', '2021-07-01 08:08:48'),
('1020020003', '102002', 1, 'acne-serum-1', 'Acne Serum 1', 0, 150000, 46200, 1, '', '2021-07-01 08:09:18', '2021-07-01 08:09:18'),
('1020020004', '102002', 1, 'acne-serum-2', 'Acne Serum 2', 0, 150000, 86000, 1, '', '2021-07-01 08:09:46', '2021-07-01 08:09:46'),
('1020020005', '102002', 1, 'befit-suplement', 'Befit Suplement', 0, 800000, 500000, 1, '', '2021-07-01 08:11:04', '2021-07-01 08:11:04'),
('1020020006', '102002', 1, 'brightening-serum', 'Brightening Serum', 0, 300000, 170000, 1, '', '2021-07-01 08:11:47', '2021-07-01 08:11:47'),
('1020020007', '102002', 1, 'celetuque-eye-cream', 'Celetuque Eye Cream', 0, 160000, 103840, 1, '', '2021-07-01 08:12:35', '2021-07-01 08:12:35'),
('1020020008', '102002', 1, 'centella-asiatica', 'Centella Asiatica', 0, 100000, 49000, 1, '', '2021-07-01 08:13:09', '2021-07-01 08:13:09'),
('1020020009', '102002', 1, 'daily-sunscreen-2', 'Daily Sunscreen 2', 0, 100000, 27500, 1, '', '2021-07-01 08:14:01', '2021-07-01 08:14:01'),
('1020020010', '102002', 1, 'fair-skin-suplement', 'Fair Skin Suplement', 0, 250000, 145200, 1, '', '2021-07-01 08:14:44', '2021-07-01 08:14:44'),
('1020020011', '102002', 1, 'fbg', 'FBG', 0, 120000, 33500, 1, '', '2021-07-01 08:15:02', '2021-07-01 08:15:02'),
('1020020012', '102002', 1, 'gentle-skin-cleanser', 'Gentle Skin Cleanser', 0, 100000, 15700, 1, '', '2021-07-01 08:15:42', '2021-07-01 08:15:42'),
('1020020013', '102002', 1, 'glowing-white-serum', 'Glowing White Serum', 0, 200000, 81000, 1, '', '2021-07-01 08:16:17', '2021-07-01 08:16:17'),
('1020020014', '102002', 1, 'gold-serum', 'Gold Serum', 0, 150000, 66550, 1, '', '2021-07-01 08:17:14', '2021-07-01 08:17:14'),
('1020020015', '102002', 1, 'green-mask', 'Green Mask', 0, 225000, 110000, 1, '', '2021-07-01 08:17:35', '2021-07-01 08:17:35'),
('1020020016', '102002', 1, 'h1-whitening-racikan', 'H1 Whitening Racikan', 0, 140000, 25410, 1, '', '2021-07-01 08:18:32', '2021-07-01 08:18:32'),
('1020020017', '102002', 1, 'hi-d-1000', 'Hi D 1000', 0, 200000, 86000, 1, '', '2021-07-01 08:19:08', '2021-07-01 08:19:08'),
('1020020018', '102002', 1, 'hi-d-5000', 'Hi D 5000', 0, 230000, 109000, 1, '', '2021-07-01 08:19:33', '2021-07-01 08:19:33'),
('1020020019', '102002', 1, 'moisturizer-serum', 'Moisturizer Serum', 0, 180000, 108900, 1, '', '2021-07-01 08:20:13', '2021-07-01 08:20:13'),
('1020020020', '102002', 1, 'moisturizing-lotion-100-ml', 'Moisturizing Lotion 100 Ml', 0, 200000, 72800, 1, '', '2021-07-01 08:20:53', '2021-07-01 08:20:53'),
('1020020021', '102002', 1, 'moisturizing-lotion-30-ml', 'Moisturizing Lotion 30 Ml', 0, 120000, 37000, 1, '', '2021-07-01 08:21:26', '2021-07-01 08:21:26'),
('1020020022', '102002', 1, 'pure-skin-suplement', 'Pure Skin Suplement', 0, 250000, 145200, 1, '', '2021-07-01 08:22:13', '2021-07-01 08:22:13'),
('1020020023', '102002', 1, 'pure-whitening', 'Pure Whitening', 0, 140000, 80300, 1, '', '2021-07-01 08:22:34', '2021-07-01 08:22:34'),
('1020020024', '102002', 1, 'reaffirming-mask', 'Reaffirming Mask', 0, 225000, 110000, 1, '', '2021-07-01 08:23:12', '2021-07-01 08:23:12'),
('1020020025', '102002', 1, 'rgnerin-mask', 'Rgnerin Mask', 0, 225000, 100000, 1, '', '2021-07-01 08:23:33', '2021-07-01 08:23:33'),
('1020020026', '102002', 1, 'exclusive-serum', 'Exclusive Serum', 0, 150000, 37250, 1, '', '2021-07-01 08:24:10', '2021-07-01 08:24:10'),
('1020020027', '102002', 1, 'super-whitening', 'Super Whitening', 0, 140000, 72000, 1, '', '2021-07-01 08:24:31', '2021-07-01 08:24:31'),
('1020020028', '102002', 1, 'toner-acne', 'Toner Acne', 0, 85000, 16720, 1, '', '2021-07-01 08:25:15', '2021-07-01 08:25:15'),
('1020020029', '102002', 1, 'back-acne-spary-celetuque', 'Back Acne Spary Celetuque', 0, 200000, 109670, 1, '', '2021-07-01 08:25:39', '2021-07-01 08:25:39'),
('1020020030', '102002', 1, 'toner-lightening', 'Toner Lightening', 0, 85000, 15180, 1, '', '2021-07-01 08:27:02', '2021-07-01 08:27:02'),
('1020020031', '102002', 1, 'vegetable-mask', 'Vegetable Mask', 0, 225000, 123750, 1, '', '2021-07-01 08:27:28', '2021-07-01 08:27:28'),
('1020020032', '102002', 1, 'brightening-night-cream-1', 'Brightening Night Cream 1', 0, 130000, 31250, 1, '', '2021-07-01 08:28:28', '2021-07-01 08:28:28'),
('1020020033', '102002', 1, 'zink-suplement', 'Zink Suplement', 0, 250000, 121000, 1, '', '2021-07-01 08:29:01', '2021-07-01 08:29:01'),
('1020020034', '102002', 1, 'oil-control-toner-celetuque', 'Oil Control Toner Celetuque', 0, 100000, 41400, 1, '', '2021-07-01 08:29:59', '2021-07-01 08:29:59'),
('1020020035', '102002', 1, 'moisturizer-cream', 'Moisturizer Cream', 0, 100000, 44000, 1, '', '2021-07-01 08:31:23', '2021-07-01 08:31:23'),
('1020020036', '102002', 1, 'acne-spot-serum', 'Acne Spot Serum', 0, 150000, 35000, 1, '', '2021-07-01 08:32:39', '2021-07-01 08:32:39'),
('1020020037', '102002', 1, 'daily-facial-cleanser', 'Daily Facial Cleanser', 0, 100000, 29500, 1, '', '2021-07-01 08:33:02', '2021-07-01 08:33:02'),
('1020020038', '102002', 1, 'goji-mask-premium', 'Goji Mask Premium', 0, 250000, 132840, 1, '', '2021-07-01 08:33:30', '2021-07-01 08:33:30'),
('1020020039', '102002', 1, 'underarm-h4', 'Underarm +H4', 0, 150000, 46500, 1, '', '2021-07-01 08:34:01', '2021-07-01 08:34:01'),
('1020020040', '102002', 2, 'acne-ct-2', 'Acne CT', 0, 120000, 38500, 1, NULL, '2021-07-01 08:43:42', '2021-07-01 08:43:42'),
('1020020041', '102002', 2, 'acne-night-cream-2', 'Acne Night Cream', 0, 120000, 21600, 1, NULL, '2021-07-01 08:43:42', '2021-07-01 08:43:42'),
('1020020042', '102002', 2, 'acne-serum-1-2', 'Acne Serum 1', 0, 150000, 46200, 1, NULL, '2021-07-01 08:43:42', '2021-07-01 08:43:42'),
('1020020043', '102002', 2, 'acne-serum-2-2', 'Acne Serum 2', 0, 150000, 86000, 1, NULL, '2021-07-01 08:43:42', '2021-07-01 08:43:42'),
('1020020044', '102002', 2, 'befit-suplement-2', 'Befit Suplement', 0, 800000, 500000, 1, NULL, '2021-07-01 08:43:42', '2021-07-01 08:43:42'),
('1020020045', '102002', 2, 'brightening-serum-2', 'Brightening Serum', 0, 300000, 170000, 1, NULL, '2021-07-01 08:43:42', '2021-07-01 08:43:42'),
('1020020046', '102002', 2, 'celetuque-eye-cream-2', 'Celetuque Eye Cream', 0, 160000, 103840, 1, NULL, '2021-07-01 08:43:42', '2021-07-01 08:43:42'),
('1020020047', '102002', 2, 'centella-asiatica-2', 'Centella Asiatica', 0, 100000, 49000, 1, NULL, '2021-07-01 08:43:42', '2021-07-01 08:43:42'),
('1020020048', '102002', 2, 'daily-sunscreen-2-2', 'Daily Sunscreen 2', 0, 100000, 27500, 1, NULL, '2021-07-01 08:43:42', '2021-07-01 08:43:42'),
('1020020049', '102002', 2, 'fair-skin-suplement-2', 'Fair Skin Suplement', 0, 250000, 145200, 1, NULL, '2021-07-01 08:43:42', '2021-07-01 08:43:42'),
('1020020050', '102002', 2, 'fbg-2', 'FBG', 0, 120000, 33500, 1, NULL, '2021-07-01 08:43:42', '2021-07-01 08:43:42'),
('1020020051', '102002', 2, 'gentle-skin-cleanser-2', 'Gentle Skin Cleanser', 0, 100000, 15700, 1, NULL, '2021-07-01 08:43:42', '2021-07-01 08:43:42'),
('1020020052', '102002', 2, 'glowing-white-serum-2', 'Glowing White Serum', 0, 200000, 81000, 1, NULL, '2021-07-01 08:43:42', '2021-07-01 08:43:42'),
('1020020053', '102002', 2, 'gold-serum-2', 'Gold Serum', 0, 150000, 66550, 1, NULL, '2021-07-01 08:43:42', '2021-07-01 08:43:42'),
('1020020054', '102002', 2, 'green-mask-2', 'Green Mask', 0, 225000, 110000, 1, NULL, '2021-07-01 08:43:42', '2021-07-01 08:43:42'),
('1020020055', '102002', 2, 'h1-whitening-racikan-2', 'H1 Whitening Racikan', 0, 140000, 25410, 1, NULL, '2021-07-01 08:43:42', '2021-07-01 08:43:42'),
('1020020056', '102002', 2, 'hi-d-1000-2', 'Hi D 1000', 0, 200000, 86000, 1, NULL, '2021-07-01 08:43:42', '2021-07-01 08:43:42'),
('1020020057', '102002', 2, 'hi-d-5000-2', 'Hi D 5000', 0, 230000, 109000, 1, NULL, '2021-07-01 08:43:42', '2021-07-01 08:43:42'),
('1020020058', '102002', 2, 'moisturizer-serum-2', 'Moisturizer Serum', 0, 180000, 108900, 1, NULL, '2021-07-01 08:43:42', '2021-07-01 08:43:42'),
('1020020059', '102002', 2, 'moisturizing-lotion-100-ml-2', 'Moisturizing Lotion 100 Ml', 0, 200000, 72800, 1, NULL, '2021-07-01 08:43:42', '2021-07-01 08:43:42'),
('1020020060', '102002', 2, 'moisturizing-lotion-30-ml-2', 'Moisturizing Lotion 30 Ml', 0, 120000, 37000, 1, NULL, '2021-07-01 08:43:42', '2021-07-01 08:43:42'),
('1020020061', '102002', 2, 'pure-skin-suplement-2', 'Pure Skin Suplement', 0, 250000, 145200, 1, NULL, '2021-07-01 08:43:42', '2021-07-01 08:43:42'),
('1020020062', '102002', 2, 'pure-whitening-2', 'Pure Whitening', 0, 140000, 80300, 1, NULL, '2021-07-01 08:43:42', '2021-07-01 08:43:42'),
('1020020063', '102002', 2, 'reaffirming-mask-2', 'Reaffirming Mask', 0, 225000, 110000, 1, NULL, '2021-07-01 08:43:42', '2021-07-01 08:43:42'),
('1020020064', '102002', 2, 'rgnerin-mask-2', 'Rgnerin Mask', 0, 225000, 100000, 1, NULL, '2021-07-01 08:43:42', '2021-07-01 08:43:42'),
('1020020065', '102002', 2, 'exclusive-serum-2', 'Exclusive Serum', 0, 150000, 37250, 1, NULL, '2021-07-01 08:43:42', '2021-07-01 08:43:42'),
('1020020066', '102002', 2, 'super-whitening-2', 'Super Whitening', 0, 140000, 72000, 1, NULL, '2021-07-01 08:43:42', '2021-07-01 08:43:42'),
('1020020067', '102002', 2, 'toner-acne-2', 'Toner Acne', 0, 85000, 16720, 1, NULL, '2021-07-01 08:43:42', '2021-07-01 08:43:42'),
('1020020068', '102002', 2, 'back-acne-spary-celetuque-2', 'Back Acne Spary Celetuque', 0, 200000, 109670, 1, NULL, '2021-07-01 08:43:42', '2021-07-01 08:43:42'),
('1020020069', '102002', 2, 'toner-lightening-2', 'Toner Lightening', 0, 85000, 15180, 1, NULL, '2021-07-01 08:43:42', '2021-07-01 08:43:42'),
('1020020070', '102002', 2, 'vegetable-mask-2', 'Vegetable Mask', 0, 225000, 123750, 1, NULL, '2021-07-01 08:43:42', '2021-07-01 08:43:42'),
('1020020071', '102002', 2, 'brightening-night-cream-1-2', 'Brightening Night Cream 1', 0, 130000, 31250, 1, NULL, '2021-07-01 08:43:42', '2021-07-01 08:43:42'),
('1020020072', '102002', 2, 'zink-suplement-2', 'Zink Suplement', 0, 250000, 121000, 1, NULL, '2021-07-01 08:43:42', '2021-07-01 08:43:42'),
('1020020073', '102002', 2, 'oil-control-toner-celetuque-2', 'Oil Control Toner Celetuque', 0, 100000, 41400, 1, NULL, '2021-07-01 08:43:42', '2021-07-01 08:43:42'),
('1020020074', '102002', 2, 'moisturizer-cream-2', 'Moisturizer Cream', 0, 100000, 44000, 1, NULL, '2021-07-01 08:43:42', '2021-07-01 08:43:42'),
('1020020075', '102002', 2, 'acne-spot-serum-2', 'Acne Spot Serum', 0, 150000, 35000, 1, NULL, '2021-07-01 08:43:42', '2021-07-01 08:43:42'),
('1020020076', '102002', 2, 'daily-facial-cleanser-2', 'Daily Facial Cleanser', 0, 100000, 29500, 1, NULL, '2021-07-01 08:43:42', '2021-07-01 08:43:42'),
('1020020077', '102002', 2, 'goji-mask-premium-2', 'Goji Mask Premium', 0, 250000, 132840, 1, NULL, '2021-07-01 08:43:42', '2021-07-01 08:43:42'),
('1020020078', '102002', 2, 'underarm-h4-2', 'Underarm +H4', 0, 150000, 46500, 1, NULL, '2021-07-01 08:43:42', '2021-07-01 08:43:42');

-- --------------------------------------------------------

--
-- Table structure for table `product_in`
--

CREATE TABLE `product_in` (
  `id` varchar(100) NOT NULL,
  `id_product` varchar(20) NOT NULL,
  `stock_in` int(11) NOT NULL,
  `curr_stock` int(11) NOT NULL,
  `total_purchase` int(11) DEFAULT 0,
  `note` text NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `queue`
--

CREATE TABLE `queue` (
  `id` varchar(100) NOT NULL,
  `id_customer` varchar(100) NOT NULL,
  `id_store` int(11) NOT NULL DEFAULT 1,
  `status` enum('waiting','on_consult','on_progress','paid','done') NOT NULL DEFAULT 'waiting',
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `store`
--

CREATE TABLE `store` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `phone` varchar(16) NOT NULL,
  `address` text NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `store`
--

INSERT INTO `store` (`id`, `name`, `phone`, `address`, `created_at`, `updated_at`) VALUES
(1, 'Hers Clinic Siteba', '08221231112321', 'Jl. Raya Siteba No.26, Surau Gadang, Kec. Nanggalo, Kota Padang', '2021-06-10 14:04:45', '2021-06-10 14:40:56'),
(2, 'Hers Clinic Bandar Damar', '08213214233432', 'Jln. Bandar Damar, Padang Barat, Padang', '2021-06-10 14:09:30', '2021-06-10 14:40:44');

-- --------------------------------------------------------

--
-- Table structure for table `therapies`
--

CREATE TABLE `therapies` (
  `id` varchar(100) NOT NULL,
  `note` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `therapies_detail`
--

CREATE TABLE `therapies_detail` (
  `id` varchar(100) NOT NULL,
  `id_product` varchar(20) NOT NULL,
  `id_therapies` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `therapist`
--

CREATE TABLE `therapist` (
  `id` varchar(100) NOT NULL,
  `name` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `birth_date` date NOT NULL,
  `identity_number` varchar(50) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `email` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

CREATE TABLE `transaction` (
  `invoice` varchar(100) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `id_customer` varchar(100) DEFAULT NULL,
  `id_store` int(11) NOT NULL DEFAULT 1,
  `subtotal` int(11) NOT NULL,
  `purchase_price_total` int(11) NOT NULL,
  `discount_total` int(11) DEFAULT NULL,
  `total` int(11) NOT NULL,
  `cash_payment` int(11) NOT NULL,
  `money_change` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `transaction_detail`
--

CREATE TABLE `transaction_detail` (
  `invoice_transaction` varchar(100) NOT NULL,
  `id_product` varchar(20) NOT NULL,
  `qty` int(11) NOT NULL,
  `subtotal` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `id_doctor` varchar(100) DEFAULT NULL,
  `id_therapist` varchar(100) DEFAULT NULL,
  `name` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','cashier','doctor','front_officer','therapist','admin_store') NOT NULL,
  `is_active` int(11) NOT NULL,
  `id_store` int(11) NOT NULL DEFAULT 1,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `id_doctor`, `id_therapist`, `name`, `username`, `password`, `role`, `is_active`, `id_store`, `created_at`, `updated_at`) VALUES
(1, NULL, NULL, 'Rio Pambudhi', 'riobrotha', '$2y$10$lD4EWwKMt5QoGkxviVzjMecDiCoESr7LQ45cEPn9KehrccdMUydEm', 'admin', 1, 1, '2021-02-22 11:47:36', '2021-02-22 11:47:36'),
(2, NULL, NULL, 'Chandra', 'chandra', '$2y$10$lD4EWwKMt5QoGkxviVzjMecDiCoESr7LQ45cEPn9KehrccdMUydEm', 'cashier', 1, 1, '2021-02-23 08:51:35', '2021-06-11 11:56:04'),
(4, NULL, NULL, 'Jane', 'front_office', '$2y$10$lD4EWwKMt5QoGkxviVzjMecDiCoESr7LQ45cEPn9KehrccdMUydEm', 'front_officer', 1, 1, '2021-04-29 11:42:05', '2021-04-29 11:42:05'),
(5, NULL, NULL, 'Michael', 'michael', '$2y$10$lD4EWwKMt5QoGkxviVzjMecDiCoESr7LQ45cEPn9KehrccdMUydEm', 'cashier', 1, 2, '2021-06-11 11:55:13', '2021-06-11 11:55:23'),
(8, NULL, NULL, 'Admin Siteba', 'siteba', '$2y$10$HFf1XPubSE3LfUydmZh0yeOYPN1LB/nigymx7qpMBmGSrRvaN4znC', 'admin_store', 1, 1, '2021-06-30 15:10:56', '2021-06-30 15:10:56');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_store` (`id_store`);

--
-- Indexes for table `discount`
--
ALTER TABLE `discount`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `doctor`
--
ALTER TABLE `doctor`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `items_detail`
--
ALTER TABLE `items_detail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_product` (`id_product`),
  ADD KEY `qty` (`qty`),
  ADD KEY `id_items` (`id_items`);

--
-- Indexes for table `medical_records`
--
ALTER TABLE `medical_records`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_doctor` (`id_doctor`),
  ADD KEY `id_customer` (`id_customer`),
  ADD KEY `id_store` (`id_store`);

--
-- Indexes for table `medical_records_detail`
--
ALTER TABLE `medical_records_detail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_medical_records` (`id_medical_records`),
  ADD KEY `id_therapies` (`id_therapies`),
  ADD KEY `id_queue` (`id_queue`),
  ADD KEY `id_items` (`id_items`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_category` (`id_category`),
  ADD KEY `id_store` (`id_store`);

--
-- Indexes for table `product_in`
--
ALTER TABLE `product_in`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_product` (`id_product`);

--
-- Indexes for table `queue`
--
ALTER TABLE `queue`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_customer` (`id_customer`),
  ADD KEY `id_store` (`id_store`);

--
-- Indexes for table `store`
--
ALTER TABLE `store`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `therapies`
--
ALTER TABLE `therapies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `therapies_detail`
--
ALTER TABLE `therapies_detail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_product` (`id_product`),
  ADD KEY `id_therapies` (`id_therapies`);

--
-- Indexes for table `therapist`
--
ALTER TABLE `therapist`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transaction`
--
ALTER TABLE `transaction`
  ADD PRIMARY KEY (`invoice`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_customer` (`id_customer`),
  ADD KEY `id_store` (`id_store`);

--
-- Indexes for table `transaction_detail`
--
ALTER TABLE `transaction_detail`
  ADD KEY `invoice_transaction` (`invoice_transaction`),
  ADD KEY `id_product` (`id_product`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_doctor` (`id_doctor`),
  ADD KEY `id_store` (`id_store`),
  ADD KEY `id_therapist` (`id_therapist`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `discount`
--
ALTER TABLE `discount`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `store`
--
ALTER TABLE `store`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `customer`
--
ALTER TABLE `customer`
  ADD CONSTRAINT `customer_ibfk_1` FOREIGN KEY (`id_store`) REFERENCES `store` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `items_detail`
--
ALTER TABLE `items_detail`
  ADD CONSTRAINT `items_detail_ibfk_1` FOREIGN KEY (`id_product`) REFERENCES `product` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `items_detail_ibfk_2` FOREIGN KEY (`id_items`) REFERENCES `items` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `medical_records`
--
ALTER TABLE `medical_records`
  ADD CONSTRAINT `medical_records_ibfk_1` FOREIGN KEY (`id_customer`) REFERENCES `customer` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `medical_records_ibfk_2` FOREIGN KEY (`id_doctor`) REFERENCES `doctor` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `medical_records_detail`
--
ALTER TABLE `medical_records_detail`
  ADD CONSTRAINT `medical_records_detail_ibfk_1` FOREIGN KEY (`id_medical_records`) REFERENCES `medical_records` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `medical_records_detail_ibfk_2` FOREIGN KEY (`id_therapies`) REFERENCES `therapies` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `medical_records_detail_ibfk_3` FOREIGN KEY (`id_items`) REFERENCES `items` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`id_category`) REFERENCES `category` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `product_ibfk_2` FOREIGN KEY (`id_store`) REFERENCES `store` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `product_in`
--
ALTER TABLE `product_in`
  ADD CONSTRAINT `product_in_ibfk_1` FOREIGN KEY (`id_product`) REFERENCES `product` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `queue`
--
ALTER TABLE `queue`
  ADD CONSTRAINT `queue_ibfk_1` FOREIGN KEY (`id_customer`) REFERENCES `customer` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `queue_ibfk_2` FOREIGN KEY (`id_store`) REFERENCES `store` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `therapies_detail`
--
ALTER TABLE `therapies_detail`
  ADD CONSTRAINT `therapies_detail_ibfk_1` FOREIGN KEY (`id_product`) REFERENCES `product` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `therapies_detail_ibfk_2` FOREIGN KEY (`id_therapies`) REFERENCES `therapies` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `transaction`
--
ALTER TABLE `transaction`
  ADD CONSTRAINT `transaction_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `transaction_ibfk_2` FOREIGN KEY (`id_customer`) REFERENCES `customer` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `transaction_ibfk_3` FOREIGN KEY (`id_store`) REFERENCES `store` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `transaction_detail`
--
ALTER TABLE `transaction_detail`
  ADD CONSTRAINT `transaction_detail_ibfk_1` FOREIGN KEY (`invoice_transaction`) REFERENCES `transaction` (`invoice`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `transaction_detail_ibfk_2` FOREIGN KEY (`id_product`) REFERENCES `product` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`id_doctor`) REFERENCES `doctor` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_ibfk_2` FOREIGN KEY (`id_store`) REFERENCES `store` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `user_ibfk_3` FOREIGN KEY (`id_therapist`) REFERENCES `therapist` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
