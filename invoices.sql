-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 14, 2022 at 02:21 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `invoices`
--

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `invoices`
--

CREATE TABLE IF NOT EXISTS `invoices` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `invoice_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `invoice_date` date NOT NULL,
  `due_date` date DEFAULT NULL,
  `product` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `section_id` bigint(20) UNSIGNED NOT NULL,
  `amount_collection` decimal(8,2) DEFAULT NULL,
  `amount_commission` decimal(8,2) NOT NULL,
  `discount` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value_vat` decimal(8,2) NOT NULL,
  `rate_vate` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total` decimal(8,2) NOT NULL,
  `status` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value_status` int(11) NOT NULL,
  `note` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_date` date DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `invoices_section_id_foreign` (`section_id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `invoices`
--

INSERT INTO `invoices` (`id`, `invoice_number`, `invoice_date`, `due_date`, `product`, `section_id`, `amount_collection`, `amount_commission`, `discount`, `value_vat`, `rate_vate`, `total`, `status`, `value_status`, `note`, `payment_date`, `deleted_at`, `created_at`, `updated_at`) VALUES
(15, '552211', '2022-09-05', '2022-09-07', 'Personal Loans', 2, '15000.00', '1000.00', '500', '25.00', '5%', '525.00', 'not paid', 2, NULL, NULL, NULL, '2022-09-05 16:10:45', '2022-09-05 16:10:45'),
(16, '63521', '2022-09-05', '2022-09-10', 'ٍStumbled Loans', 1, '35000.00', '15000.00', '2000', '1300.00', '10%', '14300.00', 'not paid', 2, NULL, NULL, NULL, '2022-09-05 16:36:55', '2022-09-05 16:36:55'),
(17, '36521', '2022-09-05', '2022-09-10', 'Credit Cards', 1, '20000.00', '3000.00', '1500', '75.00', '5%', '1575.00', 'not paid', 2, NULL, NULL, NULL, '2022-09-05 17:01:55', '2022-09-05 17:01:55'),
(18, 'R50121', '2022-09-05', '2022-09-06', 'Credit Cards', 1, '10000.00', '1500.00', '1000', '25.00', '5%', '525.00', 'not paid', 2, NULL, NULL, NULL, '2022-09-05 17:17:32', '2022-09-05 17:17:32'),
(19, 'B5050', '2022-09-05', '2022-09-07', 'Credit Cards', 1, '30000.00', '10000.00', '1000', '450.00', '5%', '9450.00', 'not paid', 2, NULL, NULL, NULL, '2022-09-05 17:20:51', '2022-09-05 17:20:51'),
(20, '3251', '2022-09-06', '2022-09-14', 'Personal Loans', 2, '15000.00', '1000.00', '300', '35.00', '5%', '735.00', 'not paid', 2, NULL, NULL, NULL, '2022-09-06 13:30:49', '2022-09-06 13:30:49'),
(21, '20214', '2022-09-06', '2022-09-08', 'Personal Loans', 2, '15000.00', '1000.00', '0200', '40.00', '5%', '840.00', 'not paid', 2, NULL, NULL, NULL, '2022-09-06 13:51:26', '2022-09-06 13:51:26');

-- --------------------------------------------------------

--
-- Table structure for table `invoice_attachments`
--

CREATE TABLE IF NOT EXISTS `invoice_attachments` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `file_name` varchar(999) COLLATE utf8mb4_unicode_ci NOT NULL,
  `invoice_number` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` varchar(999) COLLATE utf8mb4_unicode_ci NOT NULL,
  `invoice_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `invoice_attachments_invoice_id_foreign` (`invoice_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `invoice_details`
--

CREATE TABLE IF NOT EXISTS `invoice_details` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `invoice_id` bigint(20) UNSIGNED NOT NULL,
  `invoice_number` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `section` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status_value` int(11) NOT NULL,
  `note` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payment_date` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `invoice_details_invoice_id_foreign` (`invoice_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `invoice_details`
--

INSERT INTO `invoice_details` (`id`, `invoice_id`, `invoice_number`, `product`, `section`, `status`, `status_value`, `note`, `user`, `payment_date`, `created_at`, `updated_at`) VALUES
(4, 15, '552211', 'Personal Loans', '2', 'not paid', 2, NULL, 'Karim Tarek', NULL, '2022-09-05 16:10:45', '2022-09-05 16:10:45'),
(5, 16, '63521', 'ٍStumbled Loans', '1', 'not paid', 2, NULL, 'Karim Tarek', NULL, '2022-09-05 16:36:55', '2022-09-05 16:36:55'),
(6, 17, '36521', 'Credit Cards', '1', 'not paid', 2, NULL, 'Ahmed Tamer', NULL, '2022-09-05 17:01:56', '2022-09-05 17:01:56'),
(7, 18, 'R50121', 'Credit Cards', '1', 'not paid', 2, NULL, 'Karim Tarek', NULL, '2022-09-05 17:17:32', '2022-09-05 17:17:32'),
(8, 19, 'B5050', 'Credit Cards', '1', 'not paid', 2, NULL, 'Karim Tarek', NULL, '2022-09-05 17:20:51', '2022-09-05 17:20:51'),
(9, 20, '3251', 'Personal Loans', '2', 'not paid', 2, NULL, 'Ali Salem', NULL, '2022-09-06 13:30:49', '2022-09-06 13:30:49'),
(10, 21, '20214', 'Personal Loans', '2', 'not paid', 2, NULL, 'Ali Salem', NULL, '2022-09-06 13:51:26', '2022-09-06 13:51:26');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2022_08_25_122623_create_sections_table', 1),
(6, '2022_08_26_002629_create_invoices_table', 1),
(7, '2022_08_26_131203_create_products_table', 1),
(8, '2022_08_27_203417_create_invoice_details_table', 1),
(9, '2022_08_27_204809_create_invoice_attachments_table', 1),
(10, '2022_08_31_215907_create_permission_tables', 1),
(11, '2022_09_05_121701_create_notifications_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE IF NOT EXISTS `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL,
  PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE IF NOT EXISTS `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL,
  PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\User', 1),
(3, 'App\\Models\\User', 3),
(3, 'App\\Models\\User', 4);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE IF NOT EXISTS `notifications` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_id` bigint(20) UNSIGNED NOT NULL,
  `data` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `notifications_notifiable_type_notifiable_id_index` (`notifiable_type`,`notifiable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `type`, `notifiable_type`, `notifiable_id`, `data`, `read_at`, `created_at`, `updated_at`) VALUES
('12dc5456-2b88-47d0-8f86-3fe2a3342461', 'App\\Notifications\\AddInvoiceDB', 'App\\Models\\User', 3, '{\"id\":16,\"title\":\"New Invoice Added By :\",\"user\":\"Karim Tarek\"}', NULL, '2022-09-05 16:36:58', '2022-09-05 16:36:58'),
('138e31e6-aba0-49be-9d75-b9fac36a0ef5', 'App\\Notifications\\AddInvoiceDB', 'App\\Models\\User', 1, '{\"id\":19,\"title\":\"New Invoice Added By :\",\"user\":\"Karim Tarek\"}', '2022-09-06 13:31:52', '2022-09-05 17:20:51', '2022-09-06 13:31:52'),
('1eb98133-3171-4266-8443-5d4f7e619513', 'App\\Notifications\\AddInvoiceDB', 'App\\Models\\User', 1, '{\"id\":17,\"title\":\"New Invoice Added By :\",\"user\":\"Ahmed Tamer\"}', '2022-09-06 13:31:52', '2022-09-05 17:01:57', '2022-09-06 13:31:52'),
('39c31db4-f6a4-4d2f-ab1d-8facfa0a24f8', 'App\\Notifications\\AddInvoiceDB', 'App\\Models\\User', 1, '{\"id\":20,\"title\":\"New Invoice Added By :\",\"user\":\"Ali Salem\"}', '2022-09-06 13:31:52', '2022-09-06 13:30:50', '2022-09-06 13:31:52'),
('75ad762d-8780-48d6-9cc6-f832af9066d1', 'App\\Notifications\\AddInvoiceDB', 'App\\Models\\User', 3, '{\"id\":20,\"title\":\"New Invoice Added By :\",\"user\":\"Ali Salem\"}', NULL, '2022-09-06 13:30:50', '2022-09-06 13:30:50'),
('803b51b3-4217-4de0-a825-06463602ab03', 'App\\Notifications\\AddInvoiceDB', 'App\\Models\\User', 3, '{\"id\":21,\"title\":\"New Invoice Added By :\",\"user\":\"Ali Salem\"}', NULL, '2022-09-06 13:51:26', '2022-09-06 13:51:26'),
('d3649e72-a1c4-4c41-9174-b4ab93ee74e8', 'App\\Notifications\\AddInvoiceDB', 'App\\Models\\User', 4, '{\"id\":19,\"title\":\"New Invoice Added By :\",\"user\":\"Karim Tarek\"}', '2022-09-05 18:21:51', '2022-09-05 17:20:51', '2022-09-05 18:21:51'),
('eafeab8a-5999-4e1c-9f3e-c3485b139626', 'App\\Notifications\\AddInvoiceDB', 'App\\Models\\User', 3, '{\"id\":15,\"title\":\"New Invoice Added By :\",\"user\":\"Karim Tarek\"}', NULL, '2022-09-05 16:10:46', '2022-09-05 16:10:46'),
('fd96e9e2-a6d4-4a08-96a2-a9f7a361241c', 'App\\Notifications\\AddInvoiceDB', 'App\\Models\\User', 3, '{\"id\":19,\"title\":\"New Invoice Added By :\",\"user\":\"Karim Tarek\"}', NULL, '2022-09-05 17:20:51', '2022-09-05 17:20:51'),
('ffa45d8e-90b5-41b1-8ee5-395e45035672', 'App\\Notifications\\AddInvoiceDB', 'App\\Models\\User', 1, '{\"id\":21,\"title\":\"New Invoice Added By :\",\"user\":\"Ali Salem\"}', NULL, '2022-09-06 13:51:26', '2022-09-06 13:51:26');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE IF NOT EXISTS `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'Invoices', 'web', '2022-09-01 15:26:11', '2022-09-01 15:26:11'),
(2, 'Invoices List', 'web', '2022-09-01 15:26:11', '2022-09-01 15:26:11'),
(3, 'Paid Invoices', 'web', '2022-09-01 15:26:11', '2022-09-01 15:26:11'),
(4, 'Partially Paid Invoices', 'web', '2022-09-01 15:26:12', '2022-09-01 15:26:12'),
(5, 'Unpaid Invoices', 'web', '2022-09-01 15:26:12', '2022-09-01 15:26:12'),
(6, 'Invoices Archive', 'web', '2022-09-01 15:26:12', '2022-09-01 15:26:12'),
(7, 'Reports', 'web', '2022-09-01 15:26:12', '2022-09-01 15:26:12'),
(8, 'Invoices Report', 'web', '2022-09-01 15:26:12', '2022-09-01 15:26:12'),
(9, 'Customers Report', 'web', '2022-09-01 15:26:12', '2022-09-01 15:26:12'),
(10, 'Users', 'web', '2022-09-01 15:26:12', '2022-09-01 15:26:12'),
(11, 'Users List', 'web', '2022-09-01 15:26:12', '2022-09-01 15:26:12'),
(12, 'Users Privileges', 'web', '2022-09-01 15:26:12', '2022-09-01 15:26:12'),
(13, 'Settings', 'web', '2022-09-01 15:26:12', '2022-09-01 15:26:12'),
(14, 'Products', 'web', '2022-09-01 15:26:12', '2022-09-01 15:26:12'),
(15, 'Sections', 'web', '2022-09-01 15:26:12', '2022-09-01 15:26:12'),
(16, 'Add Invoice', 'web', '2022-09-01 15:26:12', '2022-09-01 15:26:12'),
(17, 'Delete Invoice', 'web', '2022-09-01 15:26:12', '2022-09-01 15:26:12'),
(18, 'Export Invoice', 'web', '2022-09-01 15:26:12', '2022-09-01 15:26:12'),
(19, 'Change Payment Status', 'web', '2022-09-01 15:26:13', '2022-09-01 15:26:13'),
(20, 'Edit Invoice', 'web', '2022-09-01 15:26:13', '2022-09-01 15:26:13'),
(21, 'Add Attachment', 'web', '2022-09-01 15:26:13', '2022-09-01 15:26:13'),
(22, 'Delete Attachment', 'web', '2022-09-01 15:26:13', '2022-09-01 15:26:13'),
(23, 'Add User', 'web', '2022-09-01 15:26:13', '2022-09-01 15:26:13'),
(24, 'Edit User', 'web', '2022-09-01 15:26:13', '2022-09-01 15:26:13'),
(25, 'Delete User', 'web', '2022-09-01 15:26:13', '2022-09-01 15:26:13'),
(26, 'Show Privilege', 'web', '2022-09-01 15:26:13', '2022-09-01 15:26:13'),
(27, 'Add Privilege', 'web', '2022-09-01 15:26:13', '2022-09-01 15:26:13'),
(28, 'Edit Privilege', 'web', '2022-09-01 15:26:13', '2022-09-01 15:26:13'),
(29, 'Delete Privilege', 'web', '2022-09-01 15:26:13', '2022-09-01 15:26:13'),
(30, 'Add Product', 'web', '2022-09-01 15:26:14', '2022-09-01 15:26:14'),
(31, 'Edit Product', 'web', '2022-09-01 15:26:14', '2022-09-01 15:26:14'),
(32, 'Delete Product', 'web', '2022-09-01 15:26:14', '2022-09-01 15:26:14'),
(33, 'Add Section', 'web', '2022-09-01 15:26:14', '2022-09-01 15:26:14'),
(34, 'Edit Section', 'web', '2022-09-01 15:26:14', '2022-09-01 15:26:14'),
(35, 'Delete Section', 'web', '2022-09-01 15:26:14', '2022-09-01 15:26:14');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE IF NOT EXISTS `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE IF NOT EXISTS `products` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `product_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `section_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `products_section_id_foreign` (`section_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `product_name`, `description`, `section_id`, `created_at`, `updated_at`) VALUES
(1, 'Credit Cards', 'cc', 1, '2022-09-04 11:42:44', '2022-09-04 11:42:44'),
(2, 'Personal Loans', 'PL', 2, '2022-09-04 11:43:05', '2022-09-04 11:43:05'),
(3, 'ٍStumbled Loans', 'SL', 1, '2022-09-04 11:43:17', '2022-09-04 11:43:17'),
(4, 'investment certificates', 'IC', 3, '2022-09-04 11:43:33', '2022-09-04 11:43:33');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE IF NOT EXISTS `roles` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'owner', 'web', '2022-09-01 15:27:36', '2022-09-01 15:27:36'),
(3, 'user', 'web', '2022-09-02 15:21:59', '2022-09-02 15:21:59');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE IF NOT EXISTS `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `role_has_permissions_role_id_foreign` (`role_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(1, 1),
(1, 3),
(2, 1),
(2, 3),
(3, 1),
(3, 3),
(4, 1),
(5, 1),
(6, 1),
(7, 1),
(7, 3),
(8, 1),
(8, 3),
(9, 1),
(10, 1),
(11, 1),
(12, 1),
(13, 1),
(14, 1),
(15, 1),
(16, 1),
(16, 3),
(17, 1),
(18, 1),
(19, 1),
(20, 1),
(21, 1),
(22, 1),
(23, 1),
(24, 1),
(25, 1),
(26, 1),
(27, 1),
(28, 1),
(29, 1),
(30, 1),
(31, 1),
(32, 1),
(33, 1),
(34, 1),
(35, 1);

-- --------------------------------------------------------

--
-- Table structure for table `sections`
--

CREATE TABLE IF NOT EXISTS `sections` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `section_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sections`
--

INSERT INTO `sections` (`id`, `section_name`, `description`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 'QNB Bank', 'qnb', 'Karim Tarek', '2022-09-04 11:41:57', '2022-09-04 11:41:57'),
(2, 'Banque Misr', 'BM', 'Karim Tarek', '2022-09-04 11:42:09', '2022-09-04 11:42:09'),
(3, 'NBE Bank', 'nbe', 'Karim Tarek', '2022-09-04 11:42:19', '2022-09-04 11:42:19'),
(5, 'Souq', 'Biggest e-commerce site', 'Karim Tarek', NULL, '2022-09-27 12:36:30');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles_name` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `roles_name`, `status`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Karim Tarek', 'karimabougom3@gmail.com', NULL, '$2y$10$as8s.52t.ntRygP462SFZ.TkUr4a.2DjcdUpAcbUI3aZl1hTxNkfS', '[\"owner\"]', 'Activated', NULL, '2022-09-01 15:27:36', '2022-09-01 15:27:36'),
(3, 'Ahmed Tamer', 'ahmed@gmail.com', NULL, '$2y$10$7cztRdatu4UEwTgRI0oo1uIihRtuh//Qk0MhLEkWkxld8/0hSALuy', '[\"user\"]', 'Activated', NULL, '2022-09-02 15:23:45', '2022-09-05 16:35:52'),
(4, 'Ali Salem', 'ali@gmail.com', NULL, '$2y$10$LlDVoDlaXLK.MZJCNPVh1OaMasnJ9dq8c3r632T5DfmPmrUYMygBS', '[\"user\"]', 'Activated', NULL, '2022-09-05 17:15:22', '2022-09-05 17:15:22');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `invoices`
--
ALTER TABLE `invoices`
  ADD CONSTRAINT `invoices_section_id_foreign` FOREIGN KEY (`section_id`) REFERENCES `sections` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `invoice_attachments`
--
ALTER TABLE `invoice_attachments`
  ADD CONSTRAINT `invoice_attachments_invoice_id_foreign` FOREIGN KEY (`invoice_id`) REFERENCES `invoices` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `invoice_details`
--
ALTER TABLE `invoice_details`
  ADD CONSTRAINT `invoice_details_invoice_id_foreign` FOREIGN KEY (`invoice_id`) REFERENCES `invoices` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_section_id_foreign` FOREIGN KEY (`section_id`) REFERENCES `sections` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
