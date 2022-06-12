-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 28, 2022 at 10:21 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.3.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pos`
--

-- --------------------------------------------------------

--
-- Table structure for table `assets`
--

CREATE TABLE `assets` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `store_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `purchase_date` date NOT NULL,
  `unit_price` double(8,2) NOT NULL,
  `qty` double(8,2) NOT NULL,
  `amount` double(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `assets`
--

INSERT INTO `assets` (`id`, `store_id`, `name`, `purchase_date`, `unit_price`, `qty`, `amount`, `created_at`, `updated_at`) VALUES
(1, 2, 'Scarlet Hahn', '1980-08-29', 5470.00, 964.00, 76.00, '2021-08-08 03:04:56', '2021-08-08 03:09:10'),
(2, 3, 'Jarrod Griffith', '1990-11-04', 20.00, 10.00, 200.00, '2021-08-08 03:41:18', '2021-08-08 03:41:18');

-- --------------------------------------------------------

--
-- Table structure for table `bank_accounts`
--

CREATE TABLE `bank_accounts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `bank_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `account_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `account_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'genaral',
  `initial_balance` double(8,2) NOT NULL DEFAULT 0.00,
  `store_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bank_accounts`
--

INSERT INTO `bank_accounts` (`id`, `bank_name`, `account_no`, `account_type`, `initial_balance`, `store_id`, `created_at`, `updated_at`) VALUES
(1, 'City', '45645', 'bank', 500.00, 2, '2021-08-04 06:37:36', '2021-08-05 06:10:21'),
(2, 'Counter1', '0', 'cash', 1000.00, 2, '2021-08-08 12:29:46', '2021-08-08 12:29:46');

-- --------------------------------------------------------

--
-- Table structure for table `batches`
--

CREATE TABLE `batches` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `store_id` int(11) NOT NULL,
  `invoice_no` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stock_date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `batches`
--

INSERT INTO `batches` (`id`, `store_id`, `invoice_no`, `stock_date`, `created_at`, `updated_at`) VALUES
(1, 2, '44545869', '2021-09-06', '2021-09-06 09:14:40', '2021-09-06 09:14:40'),
(2, 2, '44545869', '2021-09-06', '2021-09-06 09:15:14', '2021-09-06 09:15:14'),
(3, 2, '44545869', '2021-09-06', '2021-09-06 09:16:34', '2021-09-06 09:16:34'),
(4, 2, '44545869', '2021-09-06', '2021-09-06 09:19:45', '2021-09-06 09:19:45'),
(5, 2, '445', '2021-09-06', '2021-09-06 09:26:43', '2021-09-06 09:26:43'),
(6, 3, '8952', '2021-09-09', '2021-09-09 03:15:09', '2021-09-09 03:15:09'),
(7, 2, '54545', '2021-11-01', '2021-11-01 06:04:53', '2021-11-01 06:04:53'),
(8, 2, '8952', '2022-04-14', '2022-04-22 03:48:26', '2022-04-22 03:48:26');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `img` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `name`, `phone`, `email`, `address`, `img`, `created_at`, `updated_at`) VALUES
(1, 'Quin Cote', '+1 (381) 387-7822', 'zihi@mailinator.com', 'Beatae sed et pariat', '1627990501.jpg', '2021-08-03 05:35:06', '2021-08-03 05:35:06');

-- --------------------------------------------------------

--
-- Table structure for table `customer_payments`
--

CREATE TABLE `customer_payments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `invoice_id` int(11) NOT NULL DEFAULT 0,
  `cash_amount` double(8,2) NOT NULL DEFAULT 0.00,
  `card_amount` double(8,2) NOT NULL DEFAULT 0.00,
  `mobile_amount` double(8,2) NOT NULL DEFAULT 0.00,
  `payment_doc` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `employee_salaries`
--

CREATE TABLE `employee_salaries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `bank_account_id` int(11) NOT NULL,
  `pay_for_month` date NOT NULL,
  `paid_date` date NOT NULL,
  `amount` double(8,2) NOT NULL,
  `note` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `employee_salaries`
--

INSERT INTO `employee_salaries` (`id`, `user_id`, `bank_account_id`, `pay_for_month`, `paid_date`, `amount`, `note`, `created_at`, `updated_at`) VALUES
(1, 12, 1, '2012-04-04', '1981-08-16', 56.00, 'Laboris voluptatibus', '2021-08-09 05:19:32', '2021-08-09 05:19:32');

-- --------------------------------------------------------

--
-- Table structure for table `expenses`
--

CREATE TABLE `expenses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `store_id` int(11) NOT NULL,
  `bank_account_id` int(11) NOT NULL,
  `expense_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` double(8,2) NOT NULL,
  `expense_date` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `expenses`
--

INSERT INTO `expenses` (`id`, `store_id`, `bank_account_id`, `expense_type`, `amount`, `expense_date`, `created_at`, `updated_at`) VALUES
(1, 3, 1, 'Nostrud unde quibusd', 900.00, '2004-08-21', '2021-08-08 01:47:05', '2021-08-08 01:52:05'),
(3, 2, 1, 'Perferendis quaerat', 75.00, '2002-03-19', '2021-08-08 03:34:56', '2021-08-08 03:34:56');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `invoices`
--

CREATE TABLE `invoices` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `customer_id` int(11) NOT NULL DEFAULT 0,
  `total_bill` double(8,2) NOT NULL DEFAULT 0.00,
  `discount` double(8,2) NOT NULL DEFAULT 0.00,
  `vat` double(8,2) NOT NULL DEFAULT 0.00,
  `less_amount` double(8,2) NOT NULL DEFAULT 0.00,
  `paid_amount` double(8,2) NOT NULL DEFAULT 0.00,
  `return_amount` double(8,2) NOT NULL DEFAULT 0.00,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2021_07_14_123051_create_stores_table', 1),
(5, '2021_07_14_123411_create_customers_table', 1),
(6, '2021_07_14_123611_create_invoices_table', 1),
(7, '2021_07_14_125238_create_customer_payments_table', 1),
(8, '2021_07_14_131708_create_product_categories_table', 1),
(9, '2021_07_14_132112_create_product_brands_table', 1),
(10, '2021_07_14_132322_create_suppliers_table', 1),
(11, '2021_07_14_132723_create_supplier_payments_table', 1),
(12, '2021_07_14_133405_create_products_table', 1),
(13, '2021_07_14_133858_create_batches_table', 1),
(14, '2021_07_14_134110_create_stock_ins_table', 1),
(15, '2021_07_14_134545_create_racks_table', 1),
(16, '2021_07_14_134744_create_sell_products_table', 1),
(17, '2021_07_14_135147_create_expenses_table', 1),
(18, '2021_07_14_135551_create_bank_accounts_table', 1),
(19, '2021_07_14_140134_create_payment_card_types_table', 1),
(20, '2021_07_14_140304_create_employee_salaries_table', 1),
(21, '2021_07_14_154909_create_assets_table', 1),
(22, '2021_07_19_125134_create_supplier_payment_alerts_table', 1),
(23, '2021_07_19_125252_create_supplier_return_products_table', 1),
(24, '2021_07_26_130141_create_site_infos_table', 2),
(26, '2021_07_28_124550_create_roles_table', 3);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payment_card_types`
--

CREATE TABLE `payment_card_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `card_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payment_card_types`
--

INSERT INTO `payment_card_types` (`id`, `card_type`, `created_at`, `updated_at`) VALUES
(1, 'VISA', '2021-08-04 06:33:12', '2021-09-09 07:25:06'),
(2, 'Master', '2021-08-04 06:33:27', '2021-09-09 07:25:23');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_category_id` int(11) NOT NULL DEFAULT 0,
  `product_sub_category_id` int(11) NOT NULL DEFAULT 0,
  `brand_id` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `product_category_id`, `product_sub_category_id`, `brand_id`, `created_at`, `updated_at`) VALUES
(1, 'Hanae Glass', 1, 2, 1, '2021-08-09 09:26:11', '2021-08-09 09:26:11'),
(2, 'Pant', 1, 3, 1, '2021-08-26 07:19:40', '2021-08-26 07:19:40'),
(3, 'Hi-School', 6, 7, 2, '2021-11-01 05:58:02', '2021-11-01 05:58:02');

-- --------------------------------------------------------

--
-- Table structure for table `product_brands`
--

CREATE TABLE `product_brands` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_brands`
--

INSERT INTO `product_brands` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Pran', '2021-08-03 04:46:46', '2021-08-03 04:46:46'),
(2, 'Matador', '2021-11-01 05:49:26', '2021-11-01 05:49:26');

-- --------------------------------------------------------

--
-- Table structure for table `product_categories`
--

CREATE TABLE `product_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parent_id` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_categories`
--

INSERT INTO `product_categories` (`id`, `name`, `parent_id`, `created_at`, `updated_at`) VALUES
(1, 'Man\'s waree', 0, '2021-08-03 02:11:03', '2021-08-03 02:34:33'),
(2, 'T-shirt', 1, '2021-08-03 02:12:23', '2021-08-03 02:12:23'),
(3, 'Pant', 1, '2021-08-03 02:43:43', '2021-08-03 02:43:43'),
(6, 'Dept-Str', 0, '2021-11-01 05:57:21', '2021-11-01 05:57:21'),
(7, 'Pen', 6, '2021-11-01 05:57:51', '2021-11-01 05:57:51');

-- --------------------------------------------------------

--
-- Table structure for table `racks`
--

CREATE TABLE `racks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `racks`
--

INSERT INTO `racks` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'T-S-1', '2021-08-03 06:28:28', '2021-08-03 06:28:28');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'sell_person', NULL, NULL),
(2, 'station', NULL, NULL),
(3, 'admin', NULL, NULL),
(4, 'sub_admin', NULL, NULL),
(5, 'general_employee', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sell_products`
--

CREATE TABLE `sell_products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `invoice_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `qty` double(8,2) NOT NULL,
  `unit_price` double(8,2) NOT NULL,
  `discount` double(8,2) NOT NULL DEFAULT 0.00,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `site_infos`
--

CREATE TABLE `site_infos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `site_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `header_logo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `footer_logo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `short_about` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `map_embed` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `site_infos`
--

INSERT INTO `site_infos` (`id`, `site_name`, `header_logo`, `footer_logo`, `short_about`, `phone`, `email`, `address`, `map_embed`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'Shopno POS', 'mobile_logo.png', '16506252551.png', NULL, '+8801705-549900', 'shopnobdshop@gmail.com', 'Telkupi Pachani Para', NULL, 14, NULL, '2022-04-22 05:00:55');

-- --------------------------------------------------------

--
-- Table structure for table `stock_ins`
--

CREATE TABLE `stock_ins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `batch_id` int(11) NOT NULL DEFAULT 0,
  `product_id` int(11) NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `qty` float NOT NULL,
  `purchase_price` double(8,2) NOT NULL,
  `sell_price` double(8,2) NOT NULL,
  `rack_id` int(11) NOT NULL DEFAULT 0,
  `expiration_date` date DEFAULT NULL,
  `alert_date` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `stock_ins`
--

INSERT INTO `stock_ins` (`id`, `batch_id`, `product_id`, `supplier_id`, `qty`, `purchase_price`, `sell_price`, `rack_id`, `expiration_date`, `alert_date`, `created_at`, `updated_at`) VALUES
(1, 4, 1, 1, 120, 120.00, 200.00, 1, '0000-00-00', NULL, '2021-09-06 09:19:45', '2021-09-06 09:19:45'),
(2, 5, 1, 1, 80, 500.00, 1000.00, 1, '2022-08-06', '2021-09-22', '2021-09-06 09:26:43', '2021-09-06 09:26:43'),
(3, 6, 1, 1, 10, 1000.00, 1500.00, 1, '2022-03-09', '2022-07-09', '2021-09-09 03:15:09', '2021-09-09 03:15:09'),
(4, 6, 2, 1, 20, 1200.00, 2000.00, 1, '2022-10-27', '2022-05-09', '2021-09-09 03:15:09', '2021-09-09 03:15:09'),
(5, 7, 3, 1, 10, 4.00, 5.00, 1, NULL, NULL, '2021-11-01 06:04:53', '2021-11-01 06:04:53'),
(6, 8, 1, 1, 10, 100.00, 120.00, 0, '2022-04-22', '2022-06-03', '2022-04-22 03:48:26', '2022-04-22 03:48:26');

-- --------------------------------------------------------

--
-- Table structure for table `stores`
--

CREATE TABLE `stores` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `logo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `stores`
--

INSERT INTO `stores` (`id`, `name`, `phone`, `email`, `address`, `logo`, `created_at`, `updated_at`) VALUES
(2, 'Store1', '+1 (106) 794-3784', 'tonosez@mailinator.com', 'Aut eveniet do elig', '1627561477.jpg', NULL, '2021-08-05 06:11:03'),
(3, 'Store 2', '+1 (454) 873-4711', 'fykovap@mailinator.com', 'Soluta aut recusanda', '1627561347.jpg', '2021-07-29 06:22:28', '2021-08-05 06:13:41');

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE `suppliers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact_person` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `img` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `suppliers`
--

INSERT INTO `suppliers` (`id`, `name`, `contact_person`, `phone`, `email`, `address`, `img`, `created_at`, `updated_at`) VALUES
(1, 'Marshall Pacheco', 'Qui velit tempora te', '+1 (957) 149-3717', 'qudol@mailinator.com', 'Ducimus duis in cor', NULL, '2021-08-04 05:16:52', '2021-08-04 05:16:52');

-- --------------------------------------------------------

--
-- Table structure for table `supplier_payments`
--

CREATE TABLE `supplier_payments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `bank_account_id` int(11) NOT NULL,
  `amount` double(8,2) NOT NULL DEFAULT 0.00,
  `note` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `paid_date` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `supplier_payments`
--

INSERT INTO `supplier_payments` (`id`, `supplier_id`, `bank_account_id`, `amount`, `note`, `paid_date`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 10000.00, 'Sunt non dolores qui', '1977-03-28', '2021-08-05 05:31:47', '2021-08-05 05:31:47');

-- --------------------------------------------------------

--
-- Table structure for table `supplier_payment_alerts`
--

CREATE TABLE `supplier_payment_alerts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `store_id` int(11) NOT NULL DEFAULT 0,
  `supplier_id` int(11) NOT NULL,
  `notice_date` date NOT NULL,
  `pay_date` date NOT NULL,
  `amount` double(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `supplier_payment_alerts`
--

INSERT INTO `supplier_payment_alerts` (`id`, `store_id`, `supplier_id`, `notice_date`, `pay_date`, `amount`, `created_at`, `updated_at`) VALUES
(1, 0, 1, '1970-09-05', '1999-07-08', 64.00, '2021-08-05 12:33:05', '2021-08-05 12:33:05');

-- --------------------------------------------------------

--
-- Table structure for table `supplier_return_products`
--

CREATE TABLE `supplier_return_products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `batch_id` int(11) NOT NULL DEFAULT 0,
  `product_id` int(11) NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `purchase_price` double(8,2) NOT NULL,
  `sell_price` double(8,2) NOT NULL,
  `return_date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `store_id` int(11) NOT NULL DEFAULT 0,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `job_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `join_date` date DEFAULT NULL,
  `salary` double(8,2) NOT NULL DEFAULT 0.00,
  `nid` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `img` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `blood_group` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `username` varchar(70) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `store_id`, `name`, `phone`, `email`, `job_title`, `date_of_birth`, `join_date`, `salary`, `nid`, `img`, `blood_group`, `role`, `username`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(3, 2, 'Randall Kaufman', '+1 (796) 867-2851', 'mibekiwywe@mailinator.com', 'Eligendi voluptatibu', '1980-06-11', '1999-07-11', 62.00, '45645', NULL, 'AB+', '', 'lizire', NULL, '345234', NULL, '2021-07-27 07:31:01', '2021-07-27 07:31:01'),
(4, 2, 'Shelley Rice', '+1 (189) 658-2276', 'joqyg@mailinator.com', 'Ut architecto ducimu', '1999-12-02', '2015-10-20', 6.00, '343', NULL, 'A+', 'sell_person', 'puwudytyw', NULL, 'Pa$$w0rd!', NULL, '2021-07-28 05:03:11', '2021-07-28 05:03:11'),
(5, 2, 'Aspen Cervantes', '+1 (224) 248-1403', 'cuvefarego@mailinator.com', 'Possimus veniam eu', '2011-12-24', '2004-05-19', 92.00, '345', NULL, 'g', 'station', 'jejidag', NULL, 'Pa$$w0rd!', NULL, '2021-07-28 05:07:20', '2021-07-28 05:07:20'),
(6, 1, 'Cruz Blair', '+1 (223) 113-7761', 'vydaziqicu@mailinator.com', 'Vitae harum qui illo', '2004-12-01', '2000-02-25', 26.00, '56', NULL, 'R', 'general_employee', 'vyzifune', NULL, 'Pa$$w0rd!', NULL, '2021-07-28 05:07:37', '2021-07-28 05:07:37'),
(7, 2, 'Simone Craig', '+1 (376) 833-7947', 'sigyma@mailinator.com', 'Quod deserunt porro', '2014-11-12', '1980-08-03', 72.00, '5445', NULL, 'e', '', 'jaweg', NULL, 'Pa$$w0rd!', NULL, '2021-07-28 05:08:32', '2021-07-28 05:08:32'),
(8, 1, 'Kadeem Tillman', '+1 (192) 393-5332', 'kewyfa@mailinator.com', 'Sit rerum officiis', '2020-01-24', '1990-02-14', 77.00, '567', NULL, 'w', 'station', 'qekytyh', NULL, 'Pa$$w0rd!', NULL, '2021-07-28 05:08:48', '2021-07-28 05:08:48'),
(10, 2, 'Reese Hardin', '+1 (985) 952-8687', 'nyvej@mailinator.com', 'Quis rerum ad aut nu', '2004-03-03', '2013-03-07', 2.00, '87674823', NULL, 'A', 'sub_admin', 'getuby', NULL, 'Pa$$w0rd!', NULL, '2021-07-28 05:39:41', '2021-07-28 05:39:41'),
(11, 2, 'Alyssa Nixon', '+1 (873) 121-4844', 'qoluru@mailinator.com', 'Doloremque facere vo', '1994-04-27', '2003-10-15', 72.00, '454', NULL, 'AB+', 'sub_admin', 'debinexidu', NULL, 'Pa$$w0rd!', NULL, '2021-07-28 05:42:01', '2021-07-28 05:42:01'),
(12, 1, 'Ask', '+1 (613) 179-8138', 'guwyderine@mailinator.com', 'Suscipit quasi totam', '1995-04-09', '2014-07-18', 88.00, '5464', '1627480510.jpg', 'A', 'general_employee', 'temafaz', NULL, 'Pa$$w0rd!', NULL, '2021-07-28 05:51:42', '2021-07-28 07:55:10'),
(13, 0, 'Shop POS', '0173002123', 'ashikurashik.sc@gmail.com', NULL, NULL, NULL, 0.00, NULL, NULL, NULL, 'admin', NULL, NULL, NULL, NULL, NULL, NULL),
(14, 0, 'Sierra Herring', NULL, 'admin@gmail.com', NULL, NULL, NULL, 0.00, NULL, '1627482686.jpg', NULL, 'admin', NULL, NULL, '$2y$10$AL7sq26TfYO9/6tF6sSwzO7jf/CcqNPuc5rzLj1WfS6USnfJB2D6K', NULL, '2021-07-28 06:17:43', '2021-07-28 08:31:27');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `assets`
--
ALTER TABLE `assets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bank_accounts`
--
ALTER TABLE `bank_accounts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `batches`
--
ALTER TABLE `batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `customers_phone_unique` (`phone`),
  ADD UNIQUE KEY `customers_email_unique` (`email`);

--
-- Indexes for table `customer_payments`
--
ALTER TABLE `customer_payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employee_salaries`
--
ALTER TABLE `employee_salaries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `expenses`
--
ALTER TABLE `expenses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `invoices`
--
ALTER TABLE `invoices`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `payment_card_types`
--
ALTER TABLE `payment_card_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_brands`
--
ALTER TABLE `product_brands`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_categories`
--
ALTER TABLE `product_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `racks`
--
ALTER TABLE `racks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sell_products`
--
ALTER TABLE `sell_products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `site_infos`
--
ALTER TABLE `site_infos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stock_ins`
--
ALTER TABLE `stock_ins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stores`
--
ALTER TABLE `stores`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `stores_phone_unique` (`phone`),
  ADD UNIQUE KEY `stores_email_unique` (`email`);

--
-- Indexes for table `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `supplier_payments`
--
ALTER TABLE `supplier_payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `supplier_payment_alerts`
--
ALTER TABLE `supplier_payment_alerts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `supplier_return_products`
--
ALTER TABLE `supplier_return_products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_phone_unique` (`phone`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_username_unique` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `assets`
--
ALTER TABLE `assets`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `bank_accounts`
--
ALTER TABLE `bank_accounts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `batches`
--
ALTER TABLE `batches`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `customer_payments`
--
ALTER TABLE `customer_payments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `employee_salaries`
--
ALTER TABLE `employee_salaries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `expenses`
--
ALTER TABLE `expenses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `invoices`
--
ALTER TABLE `invoices`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `payment_card_types`
--
ALTER TABLE `payment_card_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `product_brands`
--
ALTER TABLE `product_brands`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `product_categories`
--
ALTER TABLE `product_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `racks`
--
ALTER TABLE `racks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `sell_products`
--
ALTER TABLE `sell_products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `site_infos`
--
ALTER TABLE `site_infos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `stock_ins`
--
ALTER TABLE `stock_ins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `stores`
--
ALTER TABLE `stores`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `supplier_payments`
--
ALTER TABLE `supplier_payments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `supplier_payment_alerts`
--
ALTER TABLE `supplier_payment_alerts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `supplier_return_products`
--
ALTER TABLE `supplier_return_products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
