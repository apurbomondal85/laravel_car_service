-- phpMyAdmin SQL Dump
-- version 5.1.1deb5ubuntu1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Oct 02, 2023 at 10:31 AM
-- Server version: 8.0.34-0ubuntu0.22.04.1
-- PHP Version: 8.1.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rainbow23_rainbow`
--

-- --------------------------------------------------------

--
-- Table structure for table `activity_logs`
--

CREATE TABLE `activity_logs` (
  `id` bigint UNSIGNED NOT NULL,
  `action_by` bigint UNSIGNED DEFAULT NULL,
  `action` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Create, Update, Delete',
  `subject` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Model name',
  `log_time` datetime NOT NULL,
  `ip` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `browser` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `changes` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `note` text COLLATE utf8mb4_unicode_ci,
  `status` tinyint DEFAULT NULL,
  `record_id` bigint NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `activity_logs`
--

INSERT INTO `activity_logs` (`id`, `action_by`, `action`, `subject`, `log_time`, `ip`, `browser`, `changes`, `note`, `status`, `record_id`, `created_at`, `updated_at`) VALUES
(1, NULL, 'Created', 'Member', '2023-08-10 12:11:13', '127.0.0.1', 'Symfony', '{\"before\":{\"f_name\":\"DW\",\"l_name\":\"Admin\",\"email\":\"admin@example.com\",\"mobile\":\"+880 1700000000\",\"dob\":\"2000-02-02\",\"user_type\":\"admin\",\"status\":2,\"login_access\":true,\"updated_at\":\"2023-08-10T12:11:13.000000Z\",\"created_at\":\"2023-08-10T12:11:13.000000Z\",\"id\":1},\"after\":\"\"}', NULL, NULL, 1, '2023-08-10 06:11:13', '2023-08-10 06:11:13'),
(2, NULL, 'Created', 'Email Template', '2023-08-10 12:11:18', '127.0.0.1', 'Symfony', '{\"before\":{\"name\":\"Ticket Create\",\"key\":\"ticket_create\",\"subject\":\"You have been opened a ticket\",\"message\":\"Dear Sir,\\nYou have received a mail.\\n\",\"shortcodes\":\"receiver_name,ticket_id\",\"updated_at\":\"2023-08-10T12:11:18.000000Z\",\"created_at\":\"2023-08-10T12:11:18.000000Z\",\"id\":1},\"after\":\"\"}', NULL, NULL, 1, '2023-08-10 06:11:18', '2023-08-10 06:11:18'),
(3, NULL, 'Created', 'Email Template', '2023-08-10 12:11:18', '127.0.0.1', 'Symfony', '{\"before\":{\"name\":\"Ticket Assign\",\"key\":\"ticket_assign\",\"subject\":\"You have been assigned a ticket\",\"message\":\"\\u003C?php\\n\",\"updated_at\":\"2023-08-10T12:11:18.000000Z\",\"created_at\":\"2023-08-10T12:11:18.000000Z\",\"id\":2},\"after\":\"\"}', NULL, NULL, 2, '2023-08-10 06:11:18', '2023-08-10 06:11:18'),
(4, 1, 'Created', 'Member', '2023-08-10 14:06:46', '118.179.96.220', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/115.0.0.0 Safari/537.36', '{\"before\":{\"f_name\":\"Mohammad\",\"m_name\":\"Ziaur\",\"l_name\":\"Rahman (Zia)\",\"email\":\"befytyf@mailinator.com\",\"dob\":\"2023-03-25\",\"user_type\":\"admin\",\"operator_id\":1,\"updated_at\":\"2023-08-10T14:06:46.000000Z\",\"created_at\":\"2023-08-10T14:06:46.000000Z\",\"id\":2},\"after\":\"\"}', NULL, NULL, 2, '2023-08-10 06:06:46', '2023-08-10 06:06:46'),
(5, 1, 'Updated', 'Member', '2023-08-10 14:08:44', '118.179.96.220', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/115.0.0.0 Safari/537.36', '{\"before\":{\"status\":1,\"updated_at\":\"2023-08-10T14:06:46.000000Z\"},\"after\":{\"status\":\"2\",\"updated_at\":\"2023-08-10 14:08:44\"}}', NULL, NULL, 2, '2023-08-10 06:08:44', '2023-08-10 06:08:44'),
(6, 1, 'Created', 'Member', '2023-08-10 14:09:16', '118.179.96.220', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/115.0.0.0 Safari/537.36', '{\"before\":{\"f_name\":\"Md\",\"m_name\":\"Wasim\",\"l_name\":\"Sarder\",\"email\":\"lynoke@mailinator.com\",\"dob\":\"1988-07-24\",\"user_type\":\"admin\",\"operator_id\":1,\"updated_at\":\"2023-08-10T14:09:16.000000Z\",\"created_at\":\"2023-08-10T14:09:16.000000Z\",\"id\":3},\"after\":\"\"}', NULL, NULL, 3, '2023-08-10 06:09:16', '2023-08-10 06:09:16'),
(7, 1, 'Created', 'Member', '2023-08-10 14:09:51', '118.179.96.220', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/115.0.0.0 Safari/537.36', '{\"before\":{\"f_name\":\"Sharif\",\"m_name\":null,\"l_name\":\"Sarker\",\"email\":\"gudu@mailinator.com\",\"dob\":\"1991-09-12\",\"user_type\":\"admin\",\"operator_id\":1,\"updated_at\":\"2023-08-10T14:09:51.000000Z\",\"created_at\":\"2023-08-10T14:09:51.000000Z\",\"id\":4},\"after\":\"\"}', NULL, NULL, 4, '2023-08-10 06:09:51', '2023-08-10 06:09:51'),
(8, 1, 'Created', 'Member', '2023-08-10 14:10:31', '118.179.96.220', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/115.0.0.0 Safari/537.36', '{\"before\":{\"f_name\":\"Mohammad\",\"m_name\":\"Saddam\",\"l_name\":\"Hossain\",\"email\":\"vyxufotuda@mailinator.com\",\"dob\":\"1980-05-05\",\"user_type\":\"admin\",\"operator_id\":1,\"updated_at\":\"2023-08-10T14:10:31.000000Z\",\"created_at\":\"2023-08-10T14:10:31.000000Z\",\"id\":5},\"after\":\"\"}', NULL, NULL, 5, '2023-08-10 06:10:31', '2023-08-10 06:10:31'),
(9, 1, 'Updated', 'Member', '2023-08-10 14:10:43', '118.179.96.220', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/115.0.0.0 Safari/537.36', '{\"before\":{\"status\":1,\"updated_at\":\"2023-08-10T14:10:31.000000Z\"},\"after\":{\"status\":\"2\",\"updated_at\":\"2023-08-10 14:10:43\"}}', NULL, NULL, 5, '2023-08-10 06:10:43', '2023-08-10 06:10:43'),
(10, 1, 'Updated', 'Member', '2023-08-10 14:10:54', '118.179.96.220', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/115.0.0.0 Safari/537.36', '{\"before\":{\"status\":1,\"updated_at\":\"2023-08-10T14:09:51.000000Z\"},\"after\":{\"status\":\"2\",\"updated_at\":\"2023-08-10 14:10:54\"}}', NULL, NULL, 4, '2023-08-10 06:10:54', '2023-08-10 06:10:54'),
(11, 1, 'Updated', 'Member', '2023-08-10 14:11:06', '118.179.96.220', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/115.0.0.0 Safari/537.36', '{\"before\":{\"status\":1,\"updated_at\":\"2023-08-10T14:09:16.000000Z\"},\"after\":{\"status\":\"2\",\"updated_at\":\"2023-08-10 14:11:06\"}}', NULL, NULL, 3, '2023-08-10 06:11:06', '2023-08-10 06:11:06'),
(12, 1, 'Updated', 'Member', '2023-08-10 14:19:01', '118.179.96.220', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/115.0.0.0 Safari/537.36', '{\"before\":{\"avatar\":null,\"operator_id\":\"1\",\"updated_at\":\"2023-08-10T14:10:43.000000Z\"},\"after\":{\"avatar\":\"storage\\/user\\/profile\\/1691677140919.jpg\",\"operator_id\":5,\"updated_at\":\"2023-08-10 14:19:01\"}}', NULL, NULL, 5, '2023-08-10 06:19:01', '2023-08-10 06:19:01'),
(13, 1, 'Updated', 'Member', '2023-08-10 14:19:24', '118.179.96.220', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/115.0.0.0 Safari/537.36', '{\"before\":{\"avatar\":null,\"operator_id\":\"1\",\"updated_at\":\"2023-08-10T14:10:54.000000Z\"},\"after\":{\"avatar\":\"storage\\/user\\/profile\\/1691677164735.jpg\",\"operator_id\":4,\"updated_at\":\"2023-08-10 14:19:24\"}}', NULL, NULL, 4, '2023-08-10 06:19:24', '2023-08-10 06:19:24'),
(14, 1, 'Updated', 'Member', '2023-08-10 14:19:44', '118.179.96.220', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/115.0.0.0 Safari/537.36', '{\"before\":{\"avatar\":null,\"operator_id\":\"1\",\"updated_at\":\"2023-08-10T14:11:06.000000Z\"},\"after\":{\"avatar\":\"storage\\/user\\/profile\\/1691677184584.jpg\",\"operator_id\":3,\"updated_at\":\"2023-08-10 14:19:44\"}}', NULL, NULL, 3, '2023-08-10 06:19:44', '2023-08-10 06:19:44'),
(15, 1, 'Updated', 'Member', '2023-08-10 14:20:06', '118.179.96.220', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/115.0.0.0 Safari/537.36', '{\"before\":{\"avatar\":null,\"operator_id\":\"1\",\"updated_at\":\"2023-08-10T14:08:44.000000Z\"},\"after\":{\"avatar\":\"storage\\/user\\/profile\\/1691677206308.jpg\",\"operator_id\":2,\"updated_at\":\"2023-08-10 14:20:06\"}}', NULL, NULL, 2, '2023-08-10 06:20:06', '2023-08-10 06:20:06'),
(16, 1, 'Updated', 'Member', '2023-08-10 14:21:23', '118.179.96.220', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/115.0.0.0 Safari/537.36', '{\"before\":{\"avatar\":\"storage\\/user\\/profile\\/1691677164735.jpg\",\"updated_at\":\"2023-08-10T14:19:24.000000Z\"},\"after\":{\"avatar\":\"storage\\/user\\/profile\\/1691677283469.jpg\",\"updated_at\":\"2023-08-10 14:21:23\"}}', NULL, NULL, 4, '2023-08-10 06:21:23', '2023-08-10 06:21:23'),
(17, 1, 'Updated', 'Member', '2023-08-12 05:17:02', '118.179.96.220', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/115.0.0.0 Safari/537.36', '{\"before\":{\"avatar\":\"storage\\/user\\/profile\\/1691677206308.jpg\",\"updated_at\":\"2023-08-10T14:20:06.000000Z\"},\"after\":{\"avatar\":\"storage\\/user\\/profile\\/1691817422553.png\",\"updated_at\":\"2023-08-12 05:17:02\"}}', NULL, NULL, 2, '2023-08-11 21:17:02', '2023-08-11 21:17:02'),
(18, 1, 'Updated', 'Member', '2023-08-12 05:17:26', '118.179.96.220', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/115.0.0.0 Safari/537.36', '{\"before\":{\"avatar\":\"storage\\/user\\/profile\\/1691677184584.jpg\",\"updated_at\":\"2023-08-10T14:19:44.000000Z\"},\"after\":{\"avatar\":\"storage\\/user\\/profile\\/1691817446267.png\",\"updated_at\":\"2023-08-12 05:17:26\"}}', NULL, NULL, 3, '2023-08-11 21:17:26', '2023-08-11 21:17:26'),
(19, 1, 'Updated', 'Member', '2023-08-12 05:19:41', '118.179.96.220', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/115.0.0.0 Safari/537.36', '{\"before\":{\"avatar\":\"storage\\/user\\/profile\\/1691677283469.jpg\",\"updated_at\":\"2023-08-10T14:21:23.000000Z\"},\"after\":{\"avatar\":\"storage\\/user\\/profile\\/1691817581937.jpg\",\"updated_at\":\"2023-08-12 05:19:41\"}}', NULL, NULL, 4, '2023-08-11 21:19:41', '2023-08-11 21:19:41'),
(20, 1, 'Updated', 'Member', '2023-08-12 05:19:58', '118.179.96.220', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/115.0.0.0 Safari/537.36', '{\"before\":{\"avatar\":\"storage\\/user\\/profile\\/1691677140919.jpg\",\"updated_at\":\"2023-08-10T14:19:01.000000Z\"},\"after\":{\"avatar\":\"storage\\/user\\/profile\\/1691817598117.jpg\",\"updated_at\":\"2023-08-12 05:19:58\"}}', NULL, NULL, 5, '2023-08-11 21:19:58', '2023-08-11 21:19:58'),
(21, 1, 'Updated', 'Member', '2023-08-12 05:26:52', '118.179.96.220', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/115.0.0.0 Safari/537.36', '{\"before\":{\"password\":\"$2y$10$9\\/y1NEYt1cfdxxX6Hbjp9OxUra3yquMtfioknJQBoVu8S0f6dvj1u\",\"updated_at\":\"2023-08-10T14:11:13.000000Z\"},\"after\":{\"password\":\"$2y$10$yDNbAy3D8dBAnPv\\/Ww3IOe514E182EJfcOeDzYKbCqmRTBK9LAC16\",\"updated_at\":\"2023-08-12 05:26:52\"}}', NULL, NULL, 1, '2023-08-11 21:26:52', '2023-08-11 21:26:52'),
(22, 1, 'Created', 'Career', '2023-09-26 05:01:51', '127.0.0.1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/116.0.0.0 Safari/537.36', '{\"before\":{\"job_type\":\"Shannon Adkins\",\"title\":\"Ratione cum corporis\",\"company_name\":\"Necessitatibus verit\",\"deadline\":\"2024-10-05\",\"location\":\"Dillon Moon\",\"short_description\":\"Ut sint dolorem non\",\"description\":\"Est facilis sunt, do. cvxcvxc\",\"operator_id\":1,\"updated_at\":\"2023-09-26T05:01:51.000000Z\",\"created_at\":\"2023-09-26T05:01:51.000000Z\",\"id\":1},\"after\":\"\"}', NULL, NULL, 1, '2023-09-25 23:01:51', '2023-09-25 23:01:51'),
(23, 1, 'Created', 'Career', '2023-09-26 05:02:00', '127.0.0.1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/116.0.0.0 Safari/537.36', '{\"before\":{\"job_type\":\"Stacey Sullivan\",\"title\":\"Commodi nostrum comm\",\"company_name\":\"At deserunt repudian\",\"deadline\":\"2024-09-13\",\"location\":\"Dillon Moon\",\"short_description\":\"Harum qui a ut qui v\",\"description\":null,\"operator_id\":1,\"updated_at\":\"2023-09-26T05:02:00.000000Z\",\"created_at\":\"2023-09-26T05:02:00.000000Z\",\"id\":2},\"after\":\"\"}', NULL, NULL, 2, '2023-09-25 23:02:00', '2023-09-25 23:02:00'),
(24, 1, 'Updated', 'Career', '2023-09-27 06:25:47', '127.0.0.1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/116.0.0.0 Safari/537.36', '{\"before\":{\"description\":null,\"updated_at\":\"2023-09-26T05:02:00.000000Z\"},\"after\":{\"description\":\"\\u003Cdiv class=\\\"vac\\\" style=\\\"color: rgb(51, 51, 51); font-family: Inter, &quot;Noto Sans Bengali UI&quot;, ui-icon, sans-serif; font-size: 14px;\\\"\\u003E\\u003Ch4 style=\\\"font-family: inherit; font-weight: bold; line-height: 1.1; color: rgb(92, 92, 92); margin: 20px 0px 6px; font-size: 14px;\\\"\\u003EVacancy\\u003C\\/h4\\u003E\\u003Cp style=\\\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding: 0px 0px 0px 20px; line-height: 24px; color: rgb(92, 92, 92);\\\"\\u003ENot specific\\u003C\\/p\\u003E\\u003C\\/div\\u003E\\u003Cdiv class=\\\"job_des\\\" style=\\\"color: rgb(51, 51, 51); font-family: Inter, &quot;Noto Sans Bengali UI&quot;, ui-icon, sans-serif; font-size: 14px;\\\"\\u003E\\u003Ch4 style=\\\"font-family: inherit; font-weight: bold; line-height: 1.1; color: rgb(92, 92, 92); margin: 20px 0px 6px; font-size: 14px;\\\"\\u003EJob Context\\u003C\\/h4\\u003E\\u003Cul style=\\\"margin-right: 0px; margin-bottom: 0px; margin-left: 40px; padding: 0px;\\\"\\u003E\\u003Cli style=\\\"color: rgb(92, 92, 92); line-height: 24px; padding-bottom: 5px;\\\"\\u003EAn established chemical company \\\"Radiant Chemtech Co Ltd.\\\" invites applications from qualified candidates for the following posts\\u003C\\/li\\u003E\\u003Cli style=\\\"color: rgb(92, 92, 92); line-height: 24px; padding-bottom: 5px;\\\"\\u003EWe are looking for a permanent and full-time accounts Executive\\/ Sr. Executive. Candidate should be proficient in Excel and software.\\u003C\\/li\\u003E\\u003C\\/ul\\u003E\\u003C\\/div\\u003E\\u003Cdiv class=\\\"job_des\\\" style=\\\"color: rgb(51, 51, 51); font-family: Inter, &quot;Noto Sans Bengali UI&quot;, ui-icon, sans-serif; font-size: 14px;\\\"\\u003E\\u003Ch4 style=\\\"font-family: inherit; font-weight: bold; line-height: 1.1; color: rgb(92, 92, 92); margin: 20px 0px 6px; font-size: 14px;\\\"\\u003EJob Responsibilities\\u003C\\/h4\\u003E\\u003Cul style=\\\"margin-right: 0px; margin-bottom: 0px; margin-left: 40px; padding: 0px;\\\"\\u003E\\u003Cli style=\\\"color: rgb(92, 92, 92); line-height: 24px; padding-bottom: 5px;\\\"\\u003EMust be Maintaining (Voucher, Inventory, Cash budget, Cash book, Bank book etc.)\\u003C\\/li\\u003E\\u003Cli style=\\\"color: rgb(92, 92, 92); line-height: 24px; padding-bottom: 5px;\\\"\\u003ECarry out\\/Record financial transaction following the standard accounting practices.\\u003C\\/li\\u003E\\u003Cli style=\\\"color: rgb(92, 92, 92); line-height: 24px; padding-bottom: 5px;\\\"\\u003ECheck and expenditure, voucher, requisition, and cash\\/bank transactions.\\u003C\\/li\\u003E\\u003Cli style=\\\"color: rgb(92, 92, 92); line-height: 24px; padding-bottom: 5px;\\\"\\u003EEnsure record keeping of all transactions and ensure accurate provisioning.\\u003C\\/li\\u003E\\u003Cli style=\\\"color: rgb(92, 92, 92); line-height: 24px; padding-bottom: 5px;\\\"\\u003ETo look after Accounts activities.\\u003C\\/li\\u003E\\u003Cli style=\\\"color: rgb(92, 92, 92); line-height: 24px; padding-bottom: 5px;\\\"\\u003EConfirm Tax, Vat and other regulatory compliance of the organization for all kind of transactions.\\u003C\\/li\\u003E\\u003Cli style=\\\"color: rgb(92, 92, 92); line-height: 24px; padding-bottom: 5px;\\\"\\u003EMaintain Daily &amp; Monthly Statement.\\u003C\\/li\\u003E\\u003Cli style=\\\"color: rgb(92, 92, 92); line-height: 24px; padding-bottom: 5px;\\\"\\u003ECapable to work under pressure.\\u003C\\/li\\u003E\\u003Cli style=\\\"color: rgb(92, 92, 92); line-height: 24px; padding-bottom: 5px;\\\"\\u003EAny others job related to finance and accounts as assigned by management.\\u003C\\/li\\u003E\\u003Cli style=\\\"color: rgb(92, 92, 92); line-height: 24px; padding-bottom: 5px;\\\"\\u003EChecking all kinds of bill &amp; voucher.\\u003C\\/li\\u003E\\u003Cli style=\\\"color: rgb(92, 92, 92); line-height: 24px; padding-bottom: 5px;\\\"\\u003EPreparing Bank &amp; Party reconciliation statement monthly basis.\\u003C\\/li\\u003E\\u003Cli style=\\\"color: rgb(92, 92, 92); line-height: 24px; padding-bottom: 5px;\\\"\\u003EPreparing daily expenditure summary sheet and cash denomination sheet.\\u003C\\/li\\u003E\\u003Cli style=\\\"color: rgb(92, 92, 92); line-height: 24px; padding-bottom: 5px;\\\"\\u003EDevelop and maintain financial models to support business decisions as needed.\\u003C\\/li\\u003E\\u003Cli style=\\\"color: rgb(92, 92, 92); line-height: 24px; padding-bottom: 5px;\\\"\\u003EGenerate various finance and accounting related reports.\\u003C\\/li\\u003E\\u003Cli style=\\\"color: rgb(92, 92, 92); line-height: 24px; padding-bottom: 5px;\\\"\\u003EMaintain petty cash fund for disbursements and keep proper records and keep department property ledger up to date.\\u003C\\/li\\u003E\\u003Cli style=\\\"color: rgb(92, 92, 92); line-height: 24px; padding-bottom: 5px;\\\"\\u003EUpdating the Accounts in ERP software on a regular basis.\\u003C\\/li\\u003E\\u003Cli style=\\\"color: rgb(92, 92, 92); line-height: 24px; padding-bottom: 5px;\\\"\\u003EWell documentation of all accounting and financial papers.\\u003C\\/li\\u003E\\u003Cli style=\\\"color: rgb(92, 92, 92); line-height: 24px; padding-bottom: 5px;\\\"\\u003EOther works as per management decision.\\u003C\\/li\\u003E\\u003C\\/ul\\u003E\\u003C\\/div\\u003E\\u003Cdiv class=\\\"job_nat\\\" style=\\\"color: rgb(51, 51, 51); font-family: Inter, &quot;Noto Sans Bengali UI&quot;, ui-icon, sans-serif; font-size: 14px;\\\"\\u003E\\u003Ch4 style=\\\"font-family: inherit; font-weight: bold; line-height: 1.1; color: rgb(92, 92, 92); margin: 20px 0px 6px; font-size: 14px;\\\"\\u003EEmployment Status\\u003C\\/h4\\u003E\\u003Cp style=\\\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding: 0px 0px 0px 20px; line-height: 24px; color: rgb(92, 92, 92);\\\"\\u003EFull-time\\u003C\\/p\\u003E\\u003C\\/div\\u003E\\u003Cdiv class=\\\"edu_req\\\" style=\\\"color: rgb(51, 51, 51); font-family: Inter, &quot;Noto Sans Bengali UI&quot;, ui-icon, sans-serif; font-size: 14px;\\\"\\u003E\\u003Ch4 style=\\\"font-family: inherit; font-weight: bold; line-height: 1.1; color: rgb(92, 92, 92); margin: 20px 0px 6px; font-size: 14px;\\\"\\u003EEducational Requirements\\u003C\\/h4\\u003E\\u003Cul style=\\\"margin-right: 0px; margin-bottom: 0px; margin-left: 40px; padding: 0px;\\\"\\u003E\\u003Cli style=\\\"color: rgb(92, 92, 92); line-height: 24px; padding-bottom: 5px;\\\"\\u003EBachelor of Commerce (BCom) in Accounting, Bachelor of Business Administration (BBA) in Accounting, Bachelor of Commerce (BCom) in Finance, Bachelor of Business Administration (BBA) in Finance\\u003C\\/li\\u003E\\u003Cli style=\\\"color: rgb(92, 92, 92); line-height: 24px; padding-bottom: 5px;\\\"\\u003EMaster\'s degree in any discipline\\u003C\\/li\\u003E\\u003C\\/ul\\u003E\\u003C\\/div\\u003E\\u003Cdiv class=\\\"job_req\\\" style=\\\"color: rgb(51, 51, 51); font-family: Inter, &quot;Noto Sans Bengali UI&quot;, ui-icon, sans-serif; font-size: 14px;\\\"\\u003E\\u003Ch4 style=\\\"font-family: inherit; font-weight: bold; line-height: 1.1; color: rgb(92, 92, 92); margin: 20px 0px 6px; font-size: 14px;\\\"\\u003EAdditional Requirements\\u003C\\/h4\\u003E\\u003Cul style=\\\"margin-right: 0px; margin-bottom: 0px; margin-left: 40px; padding: 0px;\\\"\\u003E\\u003Cli style=\\\"color: rgb(92, 92, 92); line-height: 24px; padding-bottom: 5px;\\\"\\u003ESkills Required: Good English communication skills (Written), Knowledge of ERP Software will get preference, Quick learner and hard working.\\u003C\\/li\\u003E\\u003C\\/ul\\u003E\\u003C\\/div\\u003E\\u003Cdiv class=\\\"job_loc \\\" style=\\\"color: rgb(51, 51, 51); font-family: Inter, &quot;Noto Sans Bengali UI&quot;, ui-icon, sans-serif; font-size: 14px; line-height: 24px;\\\"\\u003E\\u003Ch4 style=\\\"font-family: inherit; font-weight: bold; line-height: 1.1; color: rgb(92, 92, 92); margin: 20px 0px 6px; font-size: 14px;\\\"\\u003EJob Location\\u003C\\/h4\\u003E\\u003Cp style=\\\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding: 0px 0px 0px 20px; line-height: 24px; color: rgb(92, 92, 92);\\\"\\u003EDhaka (Uttara)\\u003C\\/p\\u003E\\u003C\\/div\\u003E\\u003Cp\\u003E\\u003Cdiv class=\\\"oth_ben\\\" style=\\\"color: rgb(51, 51, 51); font-family: Inter, &quot;Noto Sans Bengali UI&quot;, ui-icon, sans-serif;\\\"\\u003E\\u003C\\/div\\u003E\\u003C\\/p\\u003E\\u003Cdiv class=\\\"salary_range\\\" style=\\\"box-sizing: border-box; color: rgb(51, 51, 51); font-family: Inter, &quot;Noto Sans Bengali UI&quot;, ui-icon, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; white-space: normal; background-color: rgb(255, 255, 255); text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial;\\\"\\u003E\\u003Ch4 style=\\\"box-sizing: border-box; font-family: inherit; font-weight: bold; line-height: 1.1; color: rgb(92, 92, 92); margin: 20px 0px 6px; font-size: 14px;\\\"\\u003ESalary\\u003C\\/h4\\u003E\\u003Cul style=\\\"box-sizing: border-box; margin: 0px 0px 0px 40px; padding: 0px;\\\"\\u003ENegotiable\\u003C\\/ul\\u003E\\u003C\\/div\\u003E\",\"updated_at\":\"2023-09-27 06:25:47\"}}', NULL, NULL, 2, '2023-09-27 00:25:47', '2023-09-27 00:25:47'),
(25, 1, 'Updated', 'Career', '2023-09-27 06:26:00', '127.0.0.1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/116.0.0.0 Safari/537.36', '{\"before\":{\"description\":\"Est facilis sunt, do. cvxcvxc\",\"updated_at\":\"2023-09-26T05:01:51.000000Z\"},\"after\":{\"description\":\"\\u003Cdiv class=\\\"vac\\\" style=\\\"color: rgb(51, 51, 51); font-family: Inter, &quot;Noto Sans Bengali UI&quot;, ui-icon, sans-serif; font-size: 14px;\\\"\\u003E\\u003Ch4 style=\\\"font-family: inherit; font-weight: bold; line-height: 1.1; color: rgb(92, 92, 92); margin: 20px 0px 6px; font-size: 14px;\\\"\\u003EVacancy\\u003C\\/h4\\u003E\\u003Cp style=\\\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding: 0px 0px 0px 20px; line-height: 24px; color: rgb(92, 92, 92);\\\"\\u003ENot specific\\u003C\\/p\\u003E\\u003C\\/div\\u003E\\u003Cdiv class=\\\"job_des\\\" style=\\\"color: rgb(51, 51, 51); font-family: Inter, &quot;Noto Sans Bengali UI&quot;, ui-icon, sans-serif; font-size: 14px;\\\"\\u003E\\u003Ch4 style=\\\"font-family: inherit; font-weight: bold; line-height: 1.1; color: rgb(92, 92, 92); margin: 20px 0px 6px; font-size: 14px;\\\"\\u003EJob Context\\u003C\\/h4\\u003E\\u003Cul style=\\\"margin-right: 0px; margin-bottom: 0px; margin-left: 40px; padding: 0px;\\\"\\u003E\\u003Cli style=\\\"color: rgb(92, 92, 92); line-height: 24px; padding-bottom: 5px;\\\"\\u003EAn established chemical company \\\"Radiant Chemtech Co Ltd.\\\" invites applications from qualified candidates for the following posts\\u003C\\/li\\u003E\\u003Cli style=\\\"color: rgb(92, 92, 92); line-height: 24px; padding-bottom: 5px;\\\"\\u003EWe are looking for a permanent and full-time accounts Executive\\/ Sr. Executive. Candidate should be proficient in Excel and software.\\u003C\\/li\\u003E\\u003C\\/ul\\u003E\\u003C\\/div\\u003E\\u003Cdiv class=\\\"job_des\\\" style=\\\"color: rgb(51, 51, 51); font-family: Inter, &quot;Noto Sans Bengali UI&quot;, ui-icon, sans-serif; font-size: 14px;\\\"\\u003E\\u003Ch4 style=\\\"font-family: inherit; font-weight: bold; line-height: 1.1; color: rgb(92, 92, 92); margin: 20px 0px 6px; font-size: 14px;\\\"\\u003EJob Responsibilities\\u003C\\/h4\\u003E\\u003Cul style=\\\"margin-right: 0px; margin-bottom: 0px; margin-left: 40px; padding: 0px;\\\"\\u003E\\u003Cli style=\\\"color: rgb(92, 92, 92); line-height: 24px; padding-bottom: 5px;\\\"\\u003EMust be Maintaining (Voucher, Inventory, Cash budget, Cash book, Bank book etc.)\\u003C\\/li\\u003E\\u003Cli style=\\\"color: rgb(92, 92, 92); line-height: 24px; padding-bottom: 5px;\\\"\\u003ECarry out\\/Record financial transaction following the standard accounting practices.\\u003C\\/li\\u003E\\u003Cli style=\\\"color: rgb(92, 92, 92); line-height: 24px; padding-bottom: 5px;\\\"\\u003ECheck and expenditure, voucher, requisition, and cash\\/bank transactions.\\u003C\\/li\\u003E\\u003Cli style=\\\"color: rgb(92, 92, 92); line-height: 24px; padding-bottom: 5px;\\\"\\u003EEnsure record keeping of all transactions and ensure accurate provisioning.\\u003C\\/li\\u003E\\u003Cli style=\\\"color: rgb(92, 92, 92); line-height: 24px; padding-bottom: 5px;\\\"\\u003ETo look after Accounts activities.\\u003C\\/li\\u003E\\u003Cli style=\\\"color: rgb(92, 92, 92); line-height: 24px; padding-bottom: 5px;\\\"\\u003EConfirm Tax, Vat and other regulatory compliance of the organization for all kind of transactions.\\u003C\\/li\\u003E\\u003Cli style=\\\"color: rgb(92, 92, 92); line-height: 24px; padding-bottom: 5px;\\\"\\u003EMaintain Daily &amp; Monthly Statement.\\u003C\\/li\\u003E\\u003Cli style=\\\"color: rgb(92, 92, 92); line-height: 24px; padding-bottom: 5px;\\\"\\u003ECapable to work under pressure.\\u003C\\/li\\u003E\\u003Cli style=\\\"color: rgb(92, 92, 92); line-height: 24px; padding-bottom: 5px;\\\"\\u003EAny others job related to finance and accounts as assigned by management.\\u003C\\/li\\u003E\\u003Cli style=\\\"color: rgb(92, 92, 92); line-height: 24px; padding-bottom: 5px;\\\"\\u003EChecking all kinds of bill &amp; voucher.\\u003C\\/li\\u003E\\u003Cli style=\\\"color: rgb(92, 92, 92); line-height: 24px; padding-bottom: 5px;\\\"\\u003EPreparing Bank &amp; Party reconciliation statement monthly basis.\\u003C\\/li\\u003E\\u003Cli style=\\\"color: rgb(92, 92, 92); line-height: 24px; padding-bottom: 5px;\\\"\\u003EPreparing daily expenditure summary sheet and cash denomination sheet.\\u003C\\/li\\u003E\\u003Cli style=\\\"color: rgb(92, 92, 92); line-height: 24px; padding-bottom: 5px;\\\"\\u003EDevelop and maintain financial models to support business decisions as needed.\\u003C\\/li\\u003E\\u003Cli style=\\\"color: rgb(92, 92, 92); line-height: 24px; padding-bottom: 5px;\\\"\\u003EGenerate various finance and accounting related reports.\\u003C\\/li\\u003E\\u003Cli style=\\\"color: rgb(92, 92, 92); line-height: 24px; padding-bottom: 5px;\\\"\\u003EMaintain petty cash fund for disbursements and keep proper records and keep department property ledger up to date.\\u003C\\/li\\u003E\\u003Cli style=\\\"color: rgb(92, 92, 92); line-height: 24px; padding-bottom: 5px;\\\"\\u003EUpdating the Accounts in ERP software on a regular basis.\\u003C\\/li\\u003E\\u003Cli style=\\\"color: rgb(92, 92, 92); line-height: 24px; padding-bottom: 5px;\\\"\\u003EWell documentation of all accounting and financial papers.\\u003C\\/li\\u003E\\u003Cli style=\\\"color: rgb(92, 92, 92); line-height: 24px; padding-bottom: 5px;\\\"\\u003EOther works as per management decision.\\u003C\\/li\\u003E\\u003C\\/ul\\u003E\\u003C\\/div\\u003E\\u003Cdiv class=\\\"job_nat\\\" style=\\\"color: rgb(51, 51, 51); font-family: Inter, &quot;Noto Sans Bengali UI&quot;, ui-icon, sans-serif; font-size: 14px;\\\"\\u003E\\u003Ch4 style=\\\"font-family: inherit; font-weight: bold; line-height: 1.1; color: rgb(92, 92, 92); margin: 20px 0px 6px; font-size: 14px;\\\"\\u003EEmployment Status\\u003C\\/h4\\u003E\\u003Cp style=\\\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding: 0px 0px 0px 20px; line-height: 24px; color: rgb(92, 92, 92);\\\"\\u003EFull-time\\u003C\\/p\\u003E\\u003C\\/div\\u003E\\u003Cdiv class=\\\"edu_req\\\" style=\\\"color: rgb(51, 51, 51); font-family: Inter, &quot;Noto Sans Bengali UI&quot;, ui-icon, sans-serif; font-size: 14px;\\\"\\u003E\\u003Ch4 style=\\\"font-family: inherit; font-weight: bold; line-height: 1.1; color: rgb(92, 92, 92); margin: 20px 0px 6px; font-size: 14px;\\\"\\u003EEducational Requirements\\u003C\\/h4\\u003E\\u003Cul style=\\\"margin-right: 0px; margin-bottom: 0px; margin-left: 40px; padding: 0px;\\\"\\u003E\\u003Cli style=\\\"color: rgb(92, 92, 92); line-height: 24px; padding-bottom: 5px;\\\"\\u003EBachelor of Commerce (BCom) in Accounting, Bachelor of Business Administration (BBA) in Accounting, Bachelor of Commerce (BCom) in Finance, Bachelor of Business Administration (BBA) in Finance\\u003C\\/li\\u003E\\u003Cli style=\\\"color: rgb(92, 92, 92); line-height: 24px; padding-bottom: 5px;\\\"\\u003EMaster\'s degree in any discipline\\u003C\\/li\\u003E\\u003C\\/ul\\u003E\\u003C\\/div\\u003E\\u003Cdiv class=\\\"job_req\\\" style=\\\"color: rgb(51, 51, 51); font-family: Inter, &quot;Noto Sans Bengali UI&quot;, ui-icon, sans-serif; font-size: 14px;\\\"\\u003E\\u003Ch4 style=\\\"font-family: inherit; font-weight: bold; line-height: 1.1; color: rgb(92, 92, 92); margin: 20px 0px 6px; font-size: 14px;\\\"\\u003EAdditional Requirements\\u003C\\/h4\\u003E\\u003Cul style=\\\"margin-right: 0px; margin-bottom: 0px; margin-left: 40px; padding: 0px;\\\"\\u003E\\u003Cli style=\\\"color: rgb(92, 92, 92); line-height: 24px; padding-bottom: 5px;\\\"\\u003ESkills Required: Good English communication skills (Written), Knowledge of ERP Software will get preference, Quick learner and hard working.\\u003C\\/li\\u003E\\u003C\\/ul\\u003E\\u003C\\/div\\u003E\\u003Cdiv class=\\\"job_loc \\\" style=\\\"color: rgb(51, 51, 51); font-family: Inter, &quot;Noto Sans Bengali UI&quot;, ui-icon, sans-serif; font-size: 14px; line-height: 24px;\\\"\\u003E\\u003Ch4 style=\\\"font-family: inherit; font-weight: bold; line-height: 1.1; color: rgb(92, 92, 92); margin: 20px 0px 6px; font-size: 14px;\\\"\\u003EJob Location\\u003C\\/h4\\u003E\\u003Cp style=\\\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding: 0px 0px 0px 20px; line-height: 24px; color: rgb(92, 92, 92);\\\"\\u003EDhaka (Uttara)\\u003C\\/p\\u003E\\u003C\\/div\\u003E\\u003Cdiv class=\\\"salary_range\\\" style=\\\"color: rgb(51, 51, 51); font-family: Inter, &quot;Noto Sans Bengali UI&quot;, ui-icon, sans-serif; font-size: 14px;\\\"\\u003E\\u003Ch4 style=\\\"font-family: inherit; font-weight: bold; line-height: 1.1; color: rgb(92, 92, 92); margin: 20px 0px 6px; font-size: 14px;\\\"\\u003ESalary\\u003C\\/h4\\u003E\\u003Cul style=\\\"margin-right: 0px; margin-bottom: 0px; margin-left: 40px; padding: 0px;\\\"\\u003ENegotiable\\u003C\\/ul\\u003E\\u003Cdiv\\u003E\\u003Cbr\\u003E\\u003C\\/div\\u003E\\u003C\\/div\\u003E\\u003Cdiv class=\\\"oth_ben\\\" style=\\\"color: rgb(51, 51, 51); font-family: Inter, &quot;Noto Sans Bengali UI&quot;, ui-icon, sans-serif; font-size: 14px;\\\"\\u003E\\u003C\\/div\\u003E\",\"updated_at\":\"2023-09-27 06:26:00\"}}', NULL, NULL, 1, '2023-09-27 00:26:00', '2023-09-27 00:26:00');

-- --------------------------------------------------------

--
-- Table structure for table `assets`
--

CREATE TABLE `assets` (
  `id` bigint UNSIGNED NOT NULL,
  `parent_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `asset_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('0','1','2') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0' COMMENT '0 = good, 1 = damaged, 2 = lost',
  `quantity` int NOT NULL,
  `price` double(8,2) NOT NULL,
  `total` double(8,2) NOT NULL,
  `stock` int NOT NULL,
  `purchased_date` date NOT NULL,
  `warranty_date` date DEFAULT NULL,
  `vender_info` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `attachments` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `operator_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `asset_sales`
--

CREATE TABLE `asset_sales` (
  `id` bigint UNSIGNED NOT NULL,
  `asset_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantity` int NOT NULL,
  `price` double(8,2) NOT NULL,
  `total` double(8,2) NOT NULL,
  `lose_or_profit` double(8,2) NOT NULL,
  `sale_to` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sale_date` date DEFAULT NULL,
  `note` text COLLATE utf8mb4_unicode_ci,
  `operator_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `careers`
--

CREATE TABLE `careers` (
  `id` bigint UNSIGNED NOT NULL,
  `job_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `company_name` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `deadline` date NOT NULL,
  `location` text COLLATE utf8mb4_unicode_ci,
  `short_description` text COLLATE utf8mb4_unicode_ci,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `operator_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `careers`
--

INSERT INTO `careers` (`id`, `job_type`, `title`, `company_name`, `deadline`, `location`, `short_description`, `description`, `is_active`, `operator_id`, `created_at`, `updated_at`) VALUES
(1, 'Shannon Adkins', 'Ratione cum corporis', 'Necessitatibus verit', '2024-10-05', 'Dillon Moon', 'Ut sint dolorem non', '<div class=\"vac\" style=\"color: rgb(51, 51, 51); font-family: Inter, &quot;Noto Sans Bengali UI&quot;, ui-icon, sans-serif; font-size: 14px;\"><h4 style=\"font-family: inherit; font-weight: bold; line-height: 1.1; color: rgb(92, 92, 92); margin: 20px 0px 6px; font-size: 14px;\">Vacancy</h4><p style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding: 0px 0px 0px 20px; line-height: 24px; color: rgb(92, 92, 92);\">Not specific</p></div><div class=\"job_des\" style=\"color: rgb(51, 51, 51); font-family: Inter, &quot;Noto Sans Bengali UI&quot;, ui-icon, sans-serif; font-size: 14px;\"><h4 style=\"font-family: inherit; font-weight: bold; line-height: 1.1; color: rgb(92, 92, 92); margin: 20px 0px 6px; font-size: 14px;\">Job Context</h4><ul style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 40px; padding: 0px;\"><li style=\"color: rgb(92, 92, 92); line-height: 24px; padding-bottom: 5px;\">An established chemical company \"Radiant Chemtech Co Ltd.\" invites applications from qualified candidates for the following posts</li><li style=\"color: rgb(92, 92, 92); line-height: 24px; padding-bottom: 5px;\">We are looking for a permanent and full-time accounts Executive/ Sr. Executive. Candidate should be proficient in Excel and software.</li></ul></div><div class=\"job_des\" style=\"color: rgb(51, 51, 51); font-family: Inter, &quot;Noto Sans Bengali UI&quot;, ui-icon, sans-serif; font-size: 14px;\"><h4 style=\"font-family: inherit; font-weight: bold; line-height: 1.1; color: rgb(92, 92, 92); margin: 20px 0px 6px; font-size: 14px;\">Job Responsibilities</h4><ul style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 40px; padding: 0px;\"><li style=\"color: rgb(92, 92, 92); line-height: 24px; padding-bottom: 5px;\">Must be Maintaining (Voucher, Inventory, Cash budget, Cash book, Bank book etc.)</li><li style=\"color: rgb(92, 92, 92); line-height: 24px; padding-bottom: 5px;\">Carry out/Record financial transaction following the standard accounting practices.</li><li style=\"color: rgb(92, 92, 92); line-height: 24px; padding-bottom: 5px;\">Check and expenditure, voucher, requisition, and cash/bank transactions.</li><li style=\"color: rgb(92, 92, 92); line-height: 24px; padding-bottom: 5px;\">Ensure record keeping of all transactions and ensure accurate provisioning.</li><li style=\"color: rgb(92, 92, 92); line-height: 24px; padding-bottom: 5px;\">To look after Accounts activities.</li><li style=\"color: rgb(92, 92, 92); line-height: 24px; padding-bottom: 5px;\">Confirm Tax, Vat and other regulatory compliance of the organization for all kind of transactions.</li><li style=\"color: rgb(92, 92, 92); line-height: 24px; padding-bottom: 5px;\">Maintain Daily &amp; Monthly Statement.</li><li style=\"color: rgb(92, 92, 92); line-height: 24px; padding-bottom: 5px;\">Capable to work under pressure.</li><li style=\"color: rgb(92, 92, 92); line-height: 24px; padding-bottom: 5px;\">Any others job related to finance and accounts as assigned by management.</li><li style=\"color: rgb(92, 92, 92); line-height: 24px; padding-bottom: 5px;\">Checking all kinds of bill &amp; voucher.</li><li style=\"color: rgb(92, 92, 92); line-height: 24px; padding-bottom: 5px;\">Preparing Bank &amp; Party reconciliation statement monthly basis.</li><li style=\"color: rgb(92, 92, 92); line-height: 24px; padding-bottom: 5px;\">Preparing daily expenditure summary sheet and cash denomination sheet.</li><li style=\"color: rgb(92, 92, 92); line-height: 24px; padding-bottom: 5px;\">Develop and maintain financial models to support business decisions as needed.</li><li style=\"color: rgb(92, 92, 92); line-height: 24px; padding-bottom: 5px;\">Generate various finance and accounting related reports.</li><li style=\"color: rgb(92, 92, 92); line-height: 24px; padding-bottom: 5px;\">Maintain petty cash fund for disbursements and keep proper records and keep department property ledger up to date.</li><li style=\"color: rgb(92, 92, 92); line-height: 24px; padding-bottom: 5px;\">Updating the Accounts in ERP software on a regular basis.</li><li style=\"color: rgb(92, 92, 92); line-height: 24px; padding-bottom: 5px;\">Well documentation of all accounting and financial papers.</li><li style=\"color: rgb(92, 92, 92); line-height: 24px; padding-bottom: 5px;\">Other works as per management decision.</li></ul></div><div class=\"job_nat\" style=\"color: rgb(51, 51, 51); font-family: Inter, &quot;Noto Sans Bengali UI&quot;, ui-icon, sans-serif; font-size: 14px;\"><h4 style=\"font-family: inherit; font-weight: bold; line-height: 1.1; color: rgb(92, 92, 92); margin: 20px 0px 6px; font-size: 14px;\">Employment Status</h4><p style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding: 0px 0px 0px 20px; line-height: 24px; color: rgb(92, 92, 92);\">Full-time</p></div><div class=\"edu_req\" style=\"color: rgb(51, 51, 51); font-family: Inter, &quot;Noto Sans Bengali UI&quot;, ui-icon, sans-serif; font-size: 14px;\"><h4 style=\"font-family: inherit; font-weight: bold; line-height: 1.1; color: rgb(92, 92, 92); margin: 20px 0px 6px; font-size: 14px;\">Educational Requirements</h4><ul style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 40px; padding: 0px;\"><li style=\"color: rgb(92, 92, 92); line-height: 24px; padding-bottom: 5px;\">Bachelor of Commerce (BCom) in Accounting, Bachelor of Business Administration (BBA) in Accounting, Bachelor of Commerce (BCom) in Finance, Bachelor of Business Administration (BBA) in Finance</li><li style=\"color: rgb(92, 92, 92); line-height: 24px; padding-bottom: 5px;\">Master\'s degree in any discipline</li></ul></div><div class=\"job_req\" style=\"color: rgb(51, 51, 51); font-family: Inter, &quot;Noto Sans Bengali UI&quot;, ui-icon, sans-serif; font-size: 14px;\"><h4 style=\"font-family: inherit; font-weight: bold; line-height: 1.1; color: rgb(92, 92, 92); margin: 20px 0px 6px; font-size: 14px;\">Additional Requirements</h4><ul style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 40px; padding: 0px;\"><li style=\"color: rgb(92, 92, 92); line-height: 24px; padding-bottom: 5px;\">Skills Required: Good English communication skills (Written), Knowledge of ERP Software will get preference, Quick learner and hard working.</li></ul></div><div class=\"job_loc \" style=\"color: rgb(51, 51, 51); font-family: Inter, &quot;Noto Sans Bengali UI&quot;, ui-icon, sans-serif; font-size: 14px; line-height: 24px;\"><h4 style=\"font-family: inherit; font-weight: bold; line-height: 1.1; color: rgb(92, 92, 92); margin: 20px 0px 6px; font-size: 14px;\">Job Location</h4><p style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding: 0px 0px 0px 20px; line-height: 24px; color: rgb(92, 92, 92);\">Dhaka (Uttara)</p></div><div class=\"salary_range\" style=\"color: rgb(51, 51, 51); font-family: Inter, &quot;Noto Sans Bengali UI&quot;, ui-icon, sans-serif; font-size: 14px;\"><h4 style=\"font-family: inherit; font-weight: bold; line-height: 1.1; color: rgb(92, 92, 92); margin: 20px 0px 6px; font-size: 14px;\">Salary</h4><ul style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 40px; padding: 0px;\">Negotiable</ul><div><br></div></div><div class=\"oth_ben\" style=\"color: rgb(51, 51, 51); font-family: Inter, &quot;Noto Sans Bengali UI&quot;, ui-icon, sans-serif; font-size: 14px;\"></div>', 1, 1, '2023-09-25 23:01:51', '2023-09-27 00:26:00'),
(2, 'Stacey Sullivan', 'Commodi nostrum comm', 'At deserunt repudian', '2024-09-13', 'Dillon Moon', 'Harum qui a ut qui v', '<div class=\"vac\" style=\"color: rgb(51, 51, 51); font-family: Inter, &quot;Noto Sans Bengali UI&quot;, ui-icon, sans-serif; font-size: 14px;\"><h4 style=\"font-family: inherit; font-weight: bold; line-height: 1.1; color: rgb(92, 92, 92); margin: 20px 0px 6px; font-size: 14px;\">Vacancy</h4><p style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding: 0px 0px 0px 20px; line-height: 24px; color: rgb(92, 92, 92);\">Not specific</p></div><div class=\"job_des\" style=\"color: rgb(51, 51, 51); font-family: Inter, &quot;Noto Sans Bengali UI&quot;, ui-icon, sans-serif; font-size: 14px;\"><h4 style=\"font-family: inherit; font-weight: bold; line-height: 1.1; color: rgb(92, 92, 92); margin: 20px 0px 6px; font-size: 14px;\">Job Context</h4><ul style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 40px; padding: 0px;\"><li style=\"color: rgb(92, 92, 92); line-height: 24px; padding-bottom: 5px;\">An established chemical company \"Radiant Chemtech Co Ltd.\" invites applications from qualified candidates for the following posts</li><li style=\"color: rgb(92, 92, 92); line-height: 24px; padding-bottom: 5px;\">We are looking for a permanent and full-time accounts Executive/ Sr. Executive. Candidate should be proficient in Excel and software.</li></ul></div><div class=\"job_des\" style=\"color: rgb(51, 51, 51); font-family: Inter, &quot;Noto Sans Bengali UI&quot;, ui-icon, sans-serif; font-size: 14px;\"><h4 style=\"font-family: inherit; font-weight: bold; line-height: 1.1; color: rgb(92, 92, 92); margin: 20px 0px 6px; font-size: 14px;\">Job Responsibilities</h4><ul style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 40px; padding: 0px;\"><li style=\"color: rgb(92, 92, 92); line-height: 24px; padding-bottom: 5px;\">Must be Maintaining (Voucher, Inventory, Cash budget, Cash book, Bank book etc.)</li><li style=\"color: rgb(92, 92, 92); line-height: 24px; padding-bottom: 5px;\">Carry out/Record financial transaction following the standard accounting practices.</li><li style=\"color: rgb(92, 92, 92); line-height: 24px; padding-bottom: 5px;\">Check and expenditure, voucher, requisition, and cash/bank transactions.</li><li style=\"color: rgb(92, 92, 92); line-height: 24px; padding-bottom: 5px;\">Ensure record keeping of all transactions and ensure accurate provisioning.</li><li style=\"color: rgb(92, 92, 92); line-height: 24px; padding-bottom: 5px;\">To look after Accounts activities.</li><li style=\"color: rgb(92, 92, 92); line-height: 24px; padding-bottom: 5px;\">Confirm Tax, Vat and other regulatory compliance of the organization for all kind of transactions.</li><li style=\"color: rgb(92, 92, 92); line-height: 24px; padding-bottom: 5px;\">Maintain Daily &amp; Monthly Statement.</li><li style=\"color: rgb(92, 92, 92); line-height: 24px; padding-bottom: 5px;\">Capable to work under pressure.</li><li style=\"color: rgb(92, 92, 92); line-height: 24px; padding-bottom: 5px;\">Any others job related to finance and accounts as assigned by management.</li><li style=\"color: rgb(92, 92, 92); line-height: 24px; padding-bottom: 5px;\">Checking all kinds of bill &amp; voucher.</li><li style=\"color: rgb(92, 92, 92); line-height: 24px; padding-bottom: 5px;\">Preparing Bank &amp; Party reconciliation statement monthly basis.</li><li style=\"color: rgb(92, 92, 92); line-height: 24px; padding-bottom: 5px;\">Preparing daily expenditure summary sheet and cash denomination sheet.</li><li style=\"color: rgb(92, 92, 92); line-height: 24px; padding-bottom: 5px;\">Develop and maintain financial models to support business decisions as needed.</li><li style=\"color: rgb(92, 92, 92); line-height: 24px; padding-bottom: 5px;\">Generate various finance and accounting related reports.</li><li style=\"color: rgb(92, 92, 92); line-height: 24px; padding-bottom: 5px;\">Maintain petty cash fund for disbursements and keep proper records and keep department property ledger up to date.</li><li style=\"color: rgb(92, 92, 92); line-height: 24px; padding-bottom: 5px;\">Updating the Accounts in ERP software on a regular basis.</li><li style=\"color: rgb(92, 92, 92); line-height: 24px; padding-bottom: 5px;\">Well documentation of all accounting and financial papers.</li><li style=\"color: rgb(92, 92, 92); line-height: 24px; padding-bottom: 5px;\">Other works as per management decision.</li></ul></div><div class=\"job_nat\" style=\"color: rgb(51, 51, 51); font-family: Inter, &quot;Noto Sans Bengali UI&quot;, ui-icon, sans-serif; font-size: 14px;\"><h4 style=\"font-family: inherit; font-weight: bold; line-height: 1.1; color: rgb(92, 92, 92); margin: 20px 0px 6px; font-size: 14px;\">Employment Status</h4><p style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding: 0px 0px 0px 20px; line-height: 24px; color: rgb(92, 92, 92);\">Full-time</p></div><div class=\"edu_req\" style=\"color: rgb(51, 51, 51); font-family: Inter, &quot;Noto Sans Bengali UI&quot;, ui-icon, sans-serif; font-size: 14px;\"><h4 style=\"font-family: inherit; font-weight: bold; line-height: 1.1; color: rgb(92, 92, 92); margin: 20px 0px 6px; font-size: 14px;\">Educational Requirements</h4><ul style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 40px; padding: 0px;\"><li style=\"color: rgb(92, 92, 92); line-height: 24px; padding-bottom: 5px;\">Bachelor of Commerce (BCom) in Accounting, Bachelor of Business Administration (BBA) in Accounting, Bachelor of Commerce (BCom) in Finance, Bachelor of Business Administration (BBA) in Finance</li><li style=\"color: rgb(92, 92, 92); line-height: 24px; padding-bottom: 5px;\">Master\'s degree in any discipline</li></ul></div><div class=\"job_req\" style=\"color: rgb(51, 51, 51); font-family: Inter, &quot;Noto Sans Bengali UI&quot;, ui-icon, sans-serif; font-size: 14px;\"><h4 style=\"font-family: inherit; font-weight: bold; line-height: 1.1; color: rgb(92, 92, 92); margin: 20px 0px 6px; font-size: 14px;\">Additional Requirements</h4><ul style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 40px; padding: 0px;\"><li style=\"color: rgb(92, 92, 92); line-height: 24px; padding-bottom: 5px;\">Skills Required: Good English communication skills (Written), Knowledge of ERP Software will get preference, Quick learner and hard working.</li></ul></div><div class=\"job_loc \" style=\"color: rgb(51, 51, 51); font-family: Inter, &quot;Noto Sans Bengali UI&quot;, ui-icon, sans-serif; font-size: 14px; line-height: 24px;\"><h4 style=\"font-family: inherit; font-weight: bold; line-height: 1.1; color: rgb(92, 92, 92); margin: 20px 0px 6px; font-size: 14px;\">Job Location</h4><p style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding: 0px 0px 0px 20px; line-height: 24px; color: rgb(92, 92, 92);\">Dhaka (Uttara)</p></div><p><div class=\"oth_ben\" style=\"color: rgb(51, 51, 51); font-family: Inter, &quot;Noto Sans Bengali UI&quot;, ui-icon, sans-serif;\"></div></p><div class=\"salary_range\" style=\"box-sizing: border-box; color: rgb(51, 51, 51); font-family: Inter, &quot;Noto Sans Bengali UI&quot;, ui-icon, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; white-space: normal; background-color: rgb(255, 255, 255); text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial;\"><h4 style=\"box-sizing: border-box; font-family: inherit; font-weight: bold; line-height: 1.1; color: rgb(92, 92, 92); margin: 20px 0px 6px; font-size: 14px;\">Salary</h4><ul style=\"box-sizing: border-box; margin: 0px 0px 0px 40px; padding: 0px;\">Negotiable</ul></div>', 1, 1, '2023-09-25 23:02:00', '2023-09-27 00:25:47');

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `logo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `client_type` enum('client','partner') COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'partner/client',
  `is_featured` tinyint(1) NOT NULL DEFAULT '0',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `operator_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`id`, `name`, `logo`, `description`, `client_type`, `is_featured`, `is_active`, `operator_id`, `created_at`, `updated_at`) VALUES
(2, 'Sade Santos', 'storage/client_partner/1695704313653.JPG', 'Saepe et itaque volu', 'client', 1, 1, 1, '2023-09-25 22:58:33', '2023-09-25 22:58:33'),
(3, 'Caesar Rush', 'storage/client_partner/1695704323848.png', 'Officia quae rem ali', 'client', 1, 1, 1, '2023-09-25 22:58:43', '2023-09-25 22:58:43'),
(4, 'Ian Phelps', 'storage/client_partner/1696238071127.png', 'Voluptatum in corrup', 'client', 1, 1, 1, '2023-10-02 03:14:31', '2023-10-02 03:14:31'),
(5, 'Hanae Trevino', 'storage/client_partner/1696238142580.png', 'Vel nulla perspiciat', 'client', 1, 1, 1, '2023-10-02 03:15:42', '2023-10-02 03:16:24');

-- --------------------------------------------------------

--
-- Table structure for table `clubs`
--

CREATE TABLE `clubs` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slogan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cover_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `operator_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `club_members`
--

CREATE TABLE `club_members` (
  `id` bigint UNSIGNED NOT NULL,
  `club_id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `user_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'committee, member',
  `designation` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `note` longtext COLLATE utf8mb4_unicode_ci,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `operator_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `committees`
--

CREATE TABLE `committees` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `year` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_current` tinyint NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_by` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `committee_members`
--

CREATE TABLE `committee_members` (
  `id` bigint UNSIGNED NOT NULL,
  `committee_id` bigint NOT NULL,
  `user_id` bigint NOT NULL,
  `designation` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `vote` int DEFAULT NULL,
  `role_id` bigint UNSIGNED NOT NULL,
  `created_by` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `configs`
--

CREATE TABLE `configs` (
  `id` bigint UNSIGNED NOT NULL,
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `configs`
--

INSERT INTO `configs` (`id`, `key`, `value`, `created_at`, `updated_at`) VALUES
(1, 'ticket_department', '[\"Customer Service\",\"On Field Service\",\"Accounts Service\"]', '2023-08-10 06:11:13', '2023-08-10 06:11:13'),
(2, 'notification_type', '[\"Weekly Announcement\",\"Monthly Announcement\",\"Daily Announcement\"]', '2023-08-10 06:11:13', '2023-08-10 06:11:13'),
(3, 'gender', '[\"Male\",\"FeMale\",\"Others\"]', '2023-08-10 06:11:13', '2023-08-10 06:11:13'),
(4, 'pronoun', '[\"He\",\"She\",\"Other\"]', '2023-08-10 06:11:13', '2023-08-10 06:11:13'),
(5, 'user_title', '[\"Mr.\",\"Mrs.\",\"Other\"]', '2023-08-10 06:11:13', '2023-08-10 06:11:13'),
(6, 'app_title', 'West Coast Management', NULL, '2023-09-25 21:50:35'),
(7, 'email', 'info.masikurrahman@gmail.com', NULL, '2023-09-25 21:50:35'),
(8, 'country_code', '+64', NULL, '2023-09-25 21:50:35'),
(9, 'phone', '+64-0275318868', NULL, '2023-09-25 21:50:35'),
(10, 'logo', 'storage/config/1695700059884.png', NULL, '2023-09-25 21:47:40'),
(11, 'favicon', 'storage/config/1695700235416.png', NULL, '2023-09-25 21:50:35'),
(12, 'og_image', 'storage/config/1695700235648.png', NULL, '2023-09-25 21:50:35'),
(13, 'address', NULL, NULL, '2023-09-25 21:50:35'),
(14, 'city', NULL, NULL, '2023-09-25 21:50:35'),
(15, 'state', NULL, NULL, '2023-09-25 21:50:35'),
(16, 'zip_code', NULL, NULL, '2023-09-25 21:50:35'),
(17, 'country', NULL, NULL, '2023-09-25 21:50:35'),
(18, 'copyright', 'Copyright@2023', NULL, '2023-09-25 21:50:35'),
(19, 'currency_name', NULL, NULL, '2023-09-25 21:50:35'),
(20, 'currency_symbol', NULL, NULL, '2023-09-25 21:50:35'),
(21, 'version', 'v-1', NULL, '2023-09-25 21:50:35'),
(22, 'admin_prefix', '', NULL, NULL),
(23, 'user_quota', '1', NULL, '2023-09-25 21:50:35'),
(24, 'membership_type', '{\"general\":\"100\",\"premium\":\"200\",\"lifetime\":\"500\"}', NULL, NULL),
(25, 'team_designation', '[\"Director\",\"Site Foreman\"]', '2023-08-10 04:35:06', '2023-08-10 06:03:32'),
(26, 'project_category', '[\"Residential\",\"Commercial\"]', '2023-08-25 21:06:30', '2023-08-25 21:06:43'),
(27, 'blog_tag', '[\"Imelda Blanchard\",\"Carla Nelson\",\"Adele Mckay\"]', '2023-09-25 04:02:08', '2023-09-25 04:02:14'),
(28, 'blog_type', '[\"Kevyn Shaw\",\"Blaze Nieves\"]', '2023-09-25 04:03:09', '2023-09-25 04:03:13'),
(29, 'gallery_category', '[\"Sylvester Madden\"]', '2023-09-25 04:18:26', '2023-09-25 04:18:26'),
(30, 'job_type', '[\"Stacey Sullivan\",\"Emma Blanchard\",\"Shannon Adkins\"]', '2023-09-25 23:01:13', '2023-09-25 23:01:20'),
(31, 'job_location', '[\"Dillon Moon\",\"Shad Simon\",\"Jamal Mckay\"]', '2023-09-25 23:01:28', '2023-09-25 23:01:34');

-- --------------------------------------------------------

--
-- Table structure for table `emails`
--

CREATE TABLE `emails` (
  `id` bigint UNSIGNED NOT NULL,
  `subject` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `operator_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `email_histories`
--

CREATE TABLE `email_histories` (
  `id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `email_recipients`
--

CREATE TABLE `email_recipients` (
  `id` bigint UNSIGNED NOT NULL,
  `email_id` bigint UNSIGNED NOT NULL,
  `subscriber_id` bigint UNSIGNED NOT NULL,
  `is_sent` tinyint(1) NOT NULL DEFAULT '0',
  `try` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `email_templates`
--

CREATE TABLE `email_templates` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subject` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `shortcodes` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `email_templates`
--

INSERT INTO `email_templates` (`id`, `name`, `key`, `subject`, `message`, `shortcodes`, `created_at`, `updated_at`) VALUES
(1, 'Ticket Create', 'ticket_create', 'You have been opened a ticket', 'Dear Sir,\nYou have received a mail.\n', 'receiver_name,ticket_id', '2023-08-10 06:11:18', '2023-08-10 06:11:18'),
(2, 'Ticket Assign', 'ticket_assign', 'You have been assigned a ticket', '<?php\n', NULL, '2023-08-10 06:11:18', '2023-08-10 06:11:18');

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` bigint UNSIGNED NOT NULL,
  `event_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `short_description` text COLLATE utf8mb4_unicode_ci,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `start` datetime NOT NULL,
  `end` datetime NOT NULL,
  `featured_image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `is_featured` tinyint(1) NOT NULL DEFAULT '0',
  `operator_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `expenses`
--

CREATE TABLE `expenses` (
  `id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expense_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'come form config',
  `date` date NOT NULL,
  `amount` double(8,2) NOT NULL,
  `note` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `attachment` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `operator_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `faqs`
--

CREATE TABLE `faqs` (
  `id` bigint UNSIGNED NOT NULL,
  `question` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `answer` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `operator_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `galleries`
--

CREATE TABLE `galleries` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'come from config',
  `description` text COLLATE utf8mb4_unicode_ci,
  `is_featured` tinyint(1) NOT NULL DEFAULT '1',
  `operator_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `galleries`
--

INSERT INTO `galleries` (`id`, `name`, `category`, `description`, `is_featured`, `operator_id`, `created_at`, `updated_at`) VALUES
(1, 'Ifeoma Jordan', 'Sylvester Madden', 'Quia laborum qui eiu.fgdfgh', 1, 1, '2023-09-25 04:18:51', '2023-09-25 04:18:51'),
(2, 'Jameson Barron', 'Sylvester Madden', 'Dolor tempor consequ.Dolor tempor consequ.Dolor tempor consequ.Dolor tempor consequ.Dolor tempor consequ.Dolor tempor consequ.Dolor tempor consequ.Dolor tempor consequ.Dolor tempor consequ.Dolor tempor consequ.Dolor tempor consequ.Dolor tempor consequ.Dolor tempor consequ.Dolor tempor consequ.Dolor tempor consequ.Dolor tempor consequ.Dolor tempor consequ.Dolor tempor consequ.Dolor tempor consequ.Dolor tempor consequ.Dolor tempor consequ.Dolor tempor consequ.Dolor tempor consequ.Dolor tempor consequ.Dolor tempor consequ.Dolor tempor consequ.Dolor tempor consequ.Dolor tempor consequ.Dolor tempor consequ.Dolor tempor consequ.Dolor tempor consequ.Dolor tempor consequ.Dolor tempor consequ.Dolor tempor consequ.Dolor tempor consequ.Dolor tempor consequ.Dolor tempor consequ.Dolor tempor consequ.Dolor tempor consequ.Dolor tempor consequ.Dolor tempor consequ.Dolor tempor consequ.Dolor tempor consequ.Dolor tempor consequ.Dolor tempor consequ.Dolor tempor consequ.Dolor tempor consequ.Dolor tempor consequ.Dolor tempor consequ.Dolor tempor consequ.Dolor tempor consequ.Dolor tempor consequ.Dolor tempor consequ.Dolor tempor consequ.Dolor tempor consequ.Dolor tempor consequ.Dolor tempor consequ.Dolor tempor consequ.Dolor tempor consequ.Dolor tempor consequ.Dolor tempor consequ.Dolor tempor consequ.Dolor tempor consequ.Dolor tempor consequ.Dolor tempor consequ.Dolor tempor consequ.Dolor tempor consequ.Dolor tempor consequ.Dolor tempor consequ.Dolor tempor consequ.Dolor tempor consequ.Dolor tempor consequ.Dolor tempor consequ.Dolor tempor consequ.Dolor tempor consequ.Dolor tempor consequ.Dolor tempor consequ.Dolor tempor consequ.Dolor tempor consequ.Dolor tempor consequ.Dolor tempor consequ.Dolor tempor consequ.Dolor tempor consequ.Dolor tempor consequ.Dolor tempor consequ.Dolor tempor consequ.', 1, 1, '2023-10-02 03:21:39', '2023-10-02 03:21:39');

-- --------------------------------------------------------

--
-- Table structure for table `gallery_images`
--

CREATE TABLE `gallery_images` (
  `id` bigint UNSIGNED NOT NULL,
  `gallery_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `operator_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `gallery_images`
--

INSERT INTO `gallery_images` (`id`, `gallery_id`, `name`, `image`, `operator_id`, `created_at`, `updated_at`) VALUES
(1, 1, 'Hayley Hines', 'storage/attachment/1695637131714.jpg', 1, '2023-09-25 04:18:51', '2023-09-25 04:18:51'),
(2, 1, 'dfsdf', 'storage/attachment/1695637131689.jpg', 1, '2023-09-25 04:18:51', '2023-09-25 04:18:51'),
(3, 1, 'sdfsdf', 'storage/attachment/1695637131601.jpg', 1, '2023-09-25 04:18:51', '2023-09-25 04:18:51'),
(4, 1, 'sdfsdfsdf', 'storage/attachment/1695637131544.jpg', 1, '2023-09-25 04:18:51', '2023-09-25 04:18:51'),
(5, 2, 'Hayley Hines', 'storage/attachment/1696238499114.jpg', 1, '2023-10-02 03:21:39', '2023-10-02 03:21:39');

-- --------------------------------------------------------

--
-- Table structure for table `login_histories`
--

CREATE TABLE `login_histories` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('success','failed') COLLATE utf8mb4_unicode_ci NOT NULL,
  `ip` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `region` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `geo_details` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `login_histories`
--

INSERT INTO `login_histories` (`id`, `user_id`, `email`, `password`, `status`, `ip`, `country`, `region`, `city`, `geo_details`, `created_at`, `updated_at`) VALUES
(1, 1, 'admin@example.com', NULL, 'success', '118.179.96.220', 'Bangladesh', 'Dhaka Division', 'Azimpur', '{\"status\":\"success\",\"country\":\"Bangladesh\",\"countryCode\":\"BD\",\"region\":\"C\",\"regionName\":\"Dhaka Division\",\"city\":\"Azimpur\",\"zip\":\"1205\",\"lat\":23.729800000000000892441676114685833454132080078125,\"lon\":90.3854000000000041836756281554698944091796875,\"timezone\":\"Asia\\/Dhaka\",\"isp\":\"Dhakacom Limited\",\"org\":\"AmberIT Boject\",\"as\":\"AS23956 AmberIT Limited\",\"query\":\"118.179.96.220\"}', '2023-08-10 04:33:17', '2023-08-10 04:33:17'),
(2, 1, 'admin@example.com', NULL, 'success', '118.179.96.220', 'Bangladesh', 'Dhaka Division', 'Azimpur', '{\"status\":\"success\",\"country\":\"Bangladesh\",\"countryCode\":\"BD\",\"region\":\"C\",\"regionName\":\"Dhaka Division\",\"city\":\"Azimpur\",\"zip\":\"1205\",\"lat\":23.729800000000000892441676114685833454132080078125,\"lon\":90.3854000000000041836756281554698944091796875,\"timezone\":\"Asia\\/Dhaka\",\"isp\":\"Dhakacom Limited\",\"org\":\"AmberIT Boject\",\"as\":\"AS23956 AmberIT Limited\",\"query\":\"118.179.96.220\"}', '2023-08-10 04:52:17', '2023-08-10 04:52:17'),
(3, 1, 'admin@example.com', NULL, 'success', '118.179.96.220', 'Bangladesh', 'Dhaka Division', 'Azimpur', '{\"status\":\"success\",\"country\":\"Bangladesh\",\"countryCode\":\"BD\",\"region\":\"C\",\"regionName\":\"Dhaka Division\",\"city\":\"Azimpur\",\"zip\":\"1205\",\"lat\":23.729800000000000892441676114685833454132080078125,\"lon\":90.3854000000000041836756281554698944091796875,\"timezone\":\"Asia\\/Dhaka\",\"isp\":\"Dhakacom Limited\",\"org\":\"AmberIT Boject\",\"as\":\"AS23956 AmberIT Limited\",\"query\":\"118.179.96.220\"}', '2023-08-10 05:58:02', '2023-08-10 05:58:02'),
(4, NULL, 'admin@example.com', '12345678', 'failed', '121.75.128.250', 'New Zealand', 'Waikato', 'Taupo', '{\"status\":\"success\",\"country\":\"New Zealand\",\"countryCode\":\"NZ\",\"region\":\"WKO\",\"regionName\":\"Waikato\",\"city\":\"Taupo\",\"zip\":\"3330\",\"lat\":-38.730400000000003046807250939309597015380859375,\"lon\":176.0706000000000130967237055301666259765625,\"timezone\":\"Pacific\\/Auckland\",\"isp\":\"Vodafone New Zealand Limited\",\"org\":\"\",\"as\":\"AS9500 One New Zealand Group Limited\",\"query\":\"121.75.128.250\"}', '2023-08-11 18:24:58', '2023-08-11 18:24:58'),
(5, 1, 'admin@example.com', NULL, 'success', '121.75.128.250', 'New Zealand', 'Waikato', 'Taupo', '{\"status\":\"success\",\"country\":\"New Zealand\",\"countryCode\":\"NZ\",\"region\":\"WKO\",\"regionName\":\"Waikato\",\"city\":\"Taupo\",\"zip\":\"3330\",\"lat\":-38.730400000000003046807250939309597015380859375,\"lon\":176.0706000000000130967237055301666259765625,\"timezone\":\"Pacific\\/Auckland\",\"isp\":\"Vodafone New Zealand Limited\",\"org\":\"\",\"as\":\"AS9500 One New Zealand Group Limited\",\"query\":\"121.75.128.250\"}', '2023-08-11 18:25:09', '2023-08-11 18:25:09'),
(6, 1, 'admin@example.com', NULL, 'success', '118.179.96.220', 'Bangladesh', 'Dhaka Division', 'Azimpur', '{\"status\":\"success\",\"country\":\"Bangladesh\",\"countryCode\":\"BD\",\"region\":\"C\",\"regionName\":\"Dhaka Division\",\"city\":\"Azimpur\",\"zip\":\"1205\",\"lat\":23.729800000000000892441676114685833454132080078125,\"lon\":90.3854000000000041836756281554698944091796875,\"timezone\":\"Asia\\/Dhaka\",\"isp\":\"Dhakacom Limited\",\"org\":\"AmberIT Boject\",\"as\":\"AS23956 AmberIT Limited\",\"query\":\"118.179.96.220\"}', '2023-08-11 20:38:36', '2023-08-11 20:38:36'),
(7, 1, 'admin@example.com', NULL, 'success', '118.179.96.220', 'Bangladesh', 'Dhaka Division', 'Azimpur', '{\"status\":\"success\",\"country\":\"Bangladesh\",\"countryCode\":\"BD\",\"region\":\"C\",\"regionName\":\"Dhaka Division\",\"city\":\"Azimpur\",\"zip\":\"1205\",\"lat\":23.729800000000000892441676114685833454132080078125,\"lon\":90.3854000000000041836756281554698944091796875,\"timezone\":\"Asia\\/Dhaka\",\"isp\":\"Dhakacom Limited\",\"org\":\"AmberIT Boject\",\"as\":\"AS23956 AmberIT Limited\",\"query\":\"118.179.96.220\"}', '2023-08-11 21:14:19', '2023-08-11 21:14:19'),
(8, 1, 'dev@websolutionfirm.com', NULL, 'success', '118.179.96.220', 'Bangladesh', 'Dhaka Division', 'Azimpur', '{\"status\":\"success\",\"country\":\"Bangladesh\",\"countryCode\":\"BD\",\"region\":\"C\",\"regionName\":\"Dhaka Division\",\"city\":\"Azimpur\",\"zip\":\"1205\",\"lat\":23.729800000000000892441676114685833454132080078125,\"lon\":90.3854000000000041836756281554698944091796875,\"timezone\":\"Asia\\/Dhaka\",\"isp\":\"Dhakacom Limited\",\"org\":\"AmberIT Boject\",\"as\":\"AS23956 AmberIT Limited\",\"query\":\"118.179.96.220\"}', '2023-08-11 21:26:17', '2023-08-11 21:26:17'),
(9, 1, 'dev@websolutionfirm.com', NULL, 'success', '118.179.96.220', 'Bangladesh', 'Dhaka Division', 'Azimpur', '{\"status\":\"success\",\"country\":\"Bangladesh\",\"countryCode\":\"BD\",\"region\":\"C\",\"regionName\":\"Dhaka Division\",\"city\":\"Azimpur\",\"zip\":\"1205\",\"lat\":23.729800000000000892441676114685833454132080078125,\"lon\":90.3854000000000041836756281554698944091796875,\"timezone\":\"Asia\\/Dhaka\",\"isp\":\"Dhakacom Limited\",\"org\":\"AmberIT Boject\",\"as\":\"AS23956 AmberIT Limited\",\"query\":\"118.179.96.220\"}', '2023-08-11 21:27:35', '2023-08-11 21:27:35'),
(10, 1, 'dev@websolutionfirm.com', NULL, 'success', '118.179.96.220', 'Bangladesh', 'Dhaka Division', 'Azimpur', '{\"status\":\"success\",\"country\":\"Bangladesh\",\"countryCode\":\"BD\",\"region\":\"C\",\"regionName\":\"Dhaka Division\",\"city\":\"Azimpur\",\"zip\":\"1205\",\"lat\":23.729800000000000892441676114685833454132080078125,\"lon\":90.3854000000000041836756281554698944091796875,\"timezone\":\"Asia\\/Dhaka\",\"isp\":\"Dhakacom Limited\",\"org\":\"AmberIT Boject\",\"as\":\"AS23956 AmberIT Limited\",\"query\":\"118.179.96.220\"}', '2023-08-13 03:51:45', '2023-08-13 03:51:45'),
(11, 1, 'dev@websolutionfirm.com', NULL, 'success', '118.179.96.220', 'Bangladesh', 'Dhaka Division', 'Azimpur', '{\"status\":\"success\",\"country\":\"Bangladesh\",\"countryCode\":\"BD\",\"region\":\"C\",\"regionName\":\"Dhaka Division\",\"city\":\"Azimpur\",\"zip\":\"1205\",\"lat\":23.729800000000000892441676114685833454132080078125,\"lon\":90.3854000000000041836756281554698944091796875,\"timezone\":\"Asia\\/Dhaka\",\"isp\":\"Dhakacom Limited\",\"org\":\"AmberIT Boject\",\"as\":\"AS23956 AmberIT Limited\",\"query\":\"118.179.96.220\"}', '2023-08-22 00:07:05', '2023-08-22 00:07:05'),
(12, NULL, 'dev@websolutionfirm.com', '12345678', 'failed', '121.75.128.250', 'New Zealand', 'Waikato', 'Taupo', '{\"status\":\"success\",\"country\":\"New Zealand\",\"countryCode\":\"NZ\",\"region\":\"WKO\",\"regionName\":\"Waikato\",\"city\":\"Taupo\",\"zip\":\"3330\",\"lat\":-38.730400000000003046807250939309597015380859375,\"lon\":176.0706000000000130967237055301666259765625,\"timezone\":\"Pacific\\/Auckland\",\"isp\":\"Vodafone New Zealand Limited\",\"org\":\"\",\"as\":\"AS9500 One New Zealand Group Limited\",\"query\":\"121.75.128.250\"}', '2023-08-25 18:49:48', '2023-08-25 18:49:48'),
(13, NULL, 'admin@example.com', '123456', 'failed', '121.75.128.250', 'New Zealand', 'Waikato', 'Taupo', '{\"status\":\"success\",\"country\":\"New Zealand\",\"countryCode\":\"NZ\",\"region\":\"WKO\",\"regionName\":\"Waikato\",\"city\":\"Taupo\",\"zip\":\"3330\",\"lat\":-38.730400000000003046807250939309597015380859375,\"lon\":176.0706000000000130967237055301666259765625,\"timezone\":\"Pacific\\/Auckland\",\"isp\":\"Vodafone New Zealand Limited\",\"org\":\"\",\"as\":\"AS9500 One New Zealand Group Limited\",\"query\":\"121.75.128.250\"}', '2023-08-25 18:50:37', '2023-08-25 18:50:37'),
(14, NULL, 'admin@example.com', '123456', 'failed', '121.75.128.250', 'New Zealand', 'Waikato', 'Taupo', '{\"status\":\"success\",\"country\":\"New Zealand\",\"countryCode\":\"NZ\",\"region\":\"WKO\",\"regionName\":\"Waikato\",\"city\":\"Taupo\",\"zip\":\"3330\",\"lat\":-38.730400000000003046807250939309597015380859375,\"lon\":176.0706000000000130967237055301666259765625,\"timezone\":\"Pacific\\/Auckland\",\"isp\":\"Vodafone New Zealand Limited\",\"org\":\"\",\"as\":\"AS9500 One New Zealand Group Limited\",\"query\":\"121.75.128.250\"}', '2023-08-25 18:51:06', '2023-08-25 18:51:06'),
(15, NULL, 'dev@wsf.com', '123456', 'failed', '121.75.128.250', 'New Zealand', 'Waikato', 'Taupo', '{\"status\":\"success\",\"country\":\"New Zealand\",\"countryCode\":\"NZ\",\"region\":\"WKO\",\"regionName\":\"Waikato\",\"city\":\"Taupo\",\"zip\":\"3330\",\"lat\":-38.730400000000003046807250939309597015380859375,\"lon\":176.0706000000000130967237055301666259765625,\"timezone\":\"Pacific\\/Auckland\",\"isp\":\"Vodafone New Zealand Limited\",\"org\":\"\",\"as\":\"AS9500 One New Zealand Group Limited\",\"query\":\"121.75.128.250\"}', '2023-08-25 18:51:43', '2023-08-25 18:51:43'),
(16, NULL, 'dev@websolutionfirm.com', '12345678', 'failed', '121.75.128.250', 'New Zealand', 'Waikato', 'Taupo', '{\"status\":\"success\",\"country\":\"New Zealand\",\"countryCode\":\"NZ\",\"region\":\"WKO\",\"regionName\":\"Waikato\",\"city\":\"Taupo\",\"zip\":\"3330\",\"lat\":-38.730400000000003046807250939309597015380859375,\"lon\":176.0706000000000130967237055301666259765625,\"timezone\":\"Pacific\\/Auckland\",\"isp\":\"Vodafone New Zealand Limited\",\"org\":\"\",\"as\":\"AS9500 One New Zealand Group Limited\",\"query\":\"121.75.128.250\"}', '2023-08-25 18:52:11', '2023-08-25 18:52:11'),
(17, NULL, 'dev@websolutionfirm.com', '123456789', 'failed', '121.75.128.250', 'New Zealand', 'Waikato', 'Taupo', '{\"status\":\"success\",\"country\":\"New Zealand\",\"countryCode\":\"NZ\",\"region\":\"WKO\",\"regionName\":\"Waikato\",\"city\":\"Taupo\",\"zip\":\"3330\",\"lat\":-38.730400000000003046807250939309597015380859375,\"lon\":176.0706000000000130967237055301666259765625,\"timezone\":\"Pacific\\/Auckland\",\"isp\":\"Vodafone New Zealand Limited\",\"org\":\"\",\"as\":\"AS9500 One New Zealand Group Limited\",\"query\":\"121.75.128.250\"}', '2023-08-25 18:52:19', '2023-08-25 18:52:19'),
(18, NULL, 'admin@example.com', '123456', 'failed', '121.75.128.250', 'New Zealand', 'Waikato', 'Taupo', '{\"status\":\"success\",\"country\":\"New Zealand\",\"countryCode\":\"NZ\",\"region\":\"WKO\",\"regionName\":\"Waikato\",\"city\":\"Taupo\",\"zip\":\"3330\",\"lat\":-38.730400000000003046807250939309597015380859375,\"lon\":176.0706000000000130967237055301666259765625,\"timezone\":\"Pacific\\/Auckland\",\"isp\":\"Vodafone New Zealand Limited\",\"org\":\"\",\"as\":\"AS9500 One New Zealand Group Limited\",\"query\":\"121.75.128.250\"}', '2023-08-25 18:53:57', '2023-08-25 18:53:57'),
(19, NULL, 'admin@example.com', '123456', 'failed', '121.75.128.250', 'New Zealand', 'Waikato', 'Taupo', '{\"status\":\"success\",\"country\":\"New Zealand\",\"countryCode\":\"NZ\",\"region\":\"WKO\",\"regionName\":\"Waikato\",\"city\":\"Taupo\",\"zip\":\"3330\",\"lat\":-38.730400000000003046807250939309597015380859375,\"lon\":176.0706000000000130967237055301666259765625,\"timezone\":\"Pacific\\/Auckland\",\"isp\":\"Vodafone New Zealand Limited\",\"org\":\"\",\"as\":\"AS9500 One New Zealand Group Limited\",\"query\":\"121.75.128.250\"}', '2023-08-25 18:54:09', '2023-08-25 18:54:09'),
(20, NULL, 'admin@example.com', '12345678', 'failed', '121.75.128.250', 'New Zealand', 'Waikato', 'Taupo', '{\"status\":\"success\",\"country\":\"New Zealand\",\"countryCode\":\"NZ\",\"region\":\"WKO\",\"regionName\":\"Waikato\",\"city\":\"Taupo\",\"zip\":\"3330\",\"lat\":-38.730400000000003046807250939309597015380859375,\"lon\":176.0706000000000130967237055301666259765625,\"timezone\":\"Pacific\\/Auckland\",\"isp\":\"Vodafone New Zealand Limited\",\"org\":\"\",\"as\":\"AS9500 One New Zealand Group Limited\",\"query\":\"121.75.128.250\"}', '2023-08-25 18:56:12', '2023-08-25 18:56:12'),
(21, NULL, 'admin@example.com', '123456789', 'failed', '121.75.128.250', 'New Zealand', 'Waikato', 'Taupo', '{\"status\":\"success\",\"country\":\"New Zealand\",\"countryCode\":\"NZ\",\"region\":\"WKO\",\"regionName\":\"Waikato\",\"city\":\"Taupo\",\"zip\":\"3330\",\"lat\":-38.730400000000003046807250939309597015380859375,\"lon\":176.0706000000000130967237055301666259765625,\"timezone\":\"Pacific\\/Auckland\",\"isp\":\"Vodafone New Zealand Limited\",\"org\":\"\",\"as\":\"AS9500 One New Zealand Group Limited\",\"query\":\"121.75.128.250\"}', '2023-08-25 18:56:19', '2023-08-25 18:56:19'),
(22, NULL, 'dev@websolutionfirm.com', '123456789', 'failed', '121.75.128.250', 'New Zealand', 'Waikato', 'Taupo', '{\"status\":\"success\",\"country\":\"New Zealand\",\"countryCode\":\"NZ\",\"region\":\"WKO\",\"regionName\":\"Waikato\",\"city\":\"Taupo\",\"zip\":\"3330\",\"lat\":-38.730400000000003046807250939309597015380859375,\"lon\":176.0706000000000130967237055301666259765625,\"timezone\":\"Pacific\\/Auckland\",\"isp\":\"Vodafone New Zealand Limited\",\"org\":\"\",\"as\":\"AS9500 One New Zealand Group Limited\",\"query\":\"121.75.128.250\"}', '2023-08-25 18:56:34', '2023-08-25 18:56:34'),
(23, NULL, 'dev@websolutionfirm.com', '12345678', 'failed', '121.75.128.250', 'New Zealand', 'Waikato', 'Taupo', '{\"status\":\"success\",\"country\":\"New Zealand\",\"countryCode\":\"NZ\",\"region\":\"WKO\",\"regionName\":\"Waikato\",\"city\":\"Taupo\",\"zip\":\"3330\",\"lat\":-38.730400000000003046807250939309597015380859375,\"lon\":176.0706000000000130967237055301666259765625,\"timezone\":\"Pacific\\/Auckland\",\"isp\":\"Vodafone New Zealand Limited\",\"org\":\"\",\"as\":\"AS9500 One New Zealand Group Limited\",\"query\":\"121.75.128.250\"}', '2023-08-25 18:56:41', '2023-08-25 18:56:41'),
(24, NULL, 'admin@example.com', '123456', 'failed', '121.75.128.250', 'New Zealand', 'Waikato', 'Taupo', '{\"status\":\"success\",\"country\":\"New Zealand\",\"countryCode\":\"NZ\",\"region\":\"WKO\",\"regionName\":\"Waikato\",\"city\":\"Taupo\",\"zip\":\"3330\",\"lat\":-38.730400000000003046807250939309597015380859375,\"lon\":176.0706000000000130967237055301666259765625,\"timezone\":\"Pacific\\/Auckland\",\"isp\":\"Vodafone New Zealand Limited\",\"org\":\"\",\"as\":\"AS9500 One New Zealand Group Limited\",\"query\":\"121.75.128.250\"}', '2023-08-25 18:57:47', '2023-08-25 18:57:47'),
(25, 1, 'dev@websolutionfirm.com', NULL, 'success', '118.179.96.220', 'Bangladesh', 'Dhaka Division', 'Azimpur', '{\"status\":\"success\",\"country\":\"Bangladesh\",\"countryCode\":\"BD\",\"region\":\"C\",\"regionName\":\"Dhaka Division\",\"city\":\"Azimpur\",\"zip\":\"1205\",\"lat\":23.729800000000000892441676114685833454132080078125,\"lon\":90.3854000000000041836756281554698944091796875,\"timezone\":\"Asia\\/Dhaka\",\"isp\":\"Dhakacom Limited\",\"org\":\"AmberIT Boject\",\"as\":\"AS23956 AmberIT Limited\",\"query\":\"118.179.96.220\"}', '2023-08-25 19:11:13', '2023-08-25 19:11:13'),
(26, NULL, 'admin@example.com', '123456', 'failed', '118.179.96.220', 'Bangladesh', 'Dhaka Division', 'Azimpur', '{\"status\":\"success\",\"country\":\"Bangladesh\",\"countryCode\":\"BD\",\"region\":\"C\",\"regionName\":\"Dhaka Division\",\"city\":\"Azimpur\",\"zip\":\"1205\",\"lat\":23.729800000000000892441676114685833454132080078125,\"lon\":90.3854000000000041836756281554698944091796875,\"timezone\":\"Asia\\/Dhaka\",\"isp\":\"Dhakacom Limited\",\"org\":\"AmberIT Boject\",\"as\":\"AS23956 AmberIT Limited\",\"query\":\"118.179.96.220\"}', '2023-08-25 19:11:29', '2023-08-25 19:11:29'),
(27, 1, 'dev@websolutionfirm.com', NULL, 'success', '118.179.96.220', 'Bangladesh', 'Dhaka Division', 'Azimpur', '{\"status\":\"success\",\"country\":\"Bangladesh\",\"countryCode\":\"BD\",\"region\":\"C\",\"regionName\":\"Dhaka Division\",\"city\":\"Azimpur\",\"zip\":\"1205\",\"lat\":23.729800000000000892441676114685833454132080078125,\"lon\":90.3854000000000041836756281554698944091796875,\"timezone\":\"Asia\\/Dhaka\",\"isp\":\"Dhakacom Limited\",\"org\":\"AmberIT Boject\",\"as\":\"AS23956 AmberIT Limited\",\"query\":\"118.179.96.220\"}', '2023-08-25 19:14:14', '2023-08-25 19:14:14'),
(28, 1, 'dev@websolutionfirm.com', NULL, 'success', '121.75.128.250', 'New Zealand', 'Waikato', 'Taupo', '{\"status\":\"success\",\"country\":\"New Zealand\",\"countryCode\":\"NZ\",\"region\":\"WKO\",\"regionName\":\"Waikato\",\"city\":\"Taupo\",\"zip\":\"3330\",\"lat\":-38.730400000000003046807250939309597015380859375,\"lon\":176.0706000000000130967237055301666259765625,\"timezone\":\"Pacific\\/Auckland\",\"isp\":\"Vodafone New Zealand Limited\",\"org\":\"\",\"as\":\"AS9500 One New Zealand Group Limited\",\"query\":\"121.75.128.250\"}', '2023-08-25 19:14:49', '2023-08-25 19:14:49'),
(29, 1, 'dev@websolutionfirm.com', NULL, 'success', '121.75.128.250', 'New Zealand', 'Waikato', 'Taupo', '{\"status\":\"success\",\"country\":\"New Zealand\",\"countryCode\":\"NZ\",\"region\":\"WKO\",\"regionName\":\"Waikato\",\"city\":\"Taupo\",\"zip\":\"3330\",\"lat\":-38.730400000000003046807250939309597015380859375,\"lon\":176.0706000000000130967237055301666259765625,\"timezone\":\"Pacific\\/Auckland\",\"isp\":\"Vodafone New Zealand Limited\",\"org\":\"\",\"as\":\"AS9500 One New Zealand Group Limited\",\"query\":\"121.75.128.250\"}', '2023-08-25 20:12:57', '2023-08-25 20:12:57'),
(30, 1, 'dev@websolutionfirm.com', NULL, 'success', '118.179.96.220', 'Bangladesh', 'Dhaka Division', 'Azimpur', '{\"status\":\"success\",\"country\":\"Bangladesh\",\"countryCode\":\"BD\",\"region\":\"C\",\"regionName\":\"Dhaka Division\",\"city\":\"Azimpur\",\"zip\":\"1205\",\"lat\":23.729800000000000892441676114685833454132080078125,\"lon\":90.3854000000000041836756281554698944091796875,\"timezone\":\"Asia\\/Dhaka\",\"isp\":\"Dhakacom Limited\",\"org\":\"AmberIT Boject\",\"as\":\"AS23956 AmberIT Limited\",\"query\":\"118.179.96.220\"}', '2023-08-29 22:01:22', '2023-08-29 22:01:22'),
(31, 1, 'dev@websolutionfirm.com', NULL, 'success', '118.179.96.220', 'Bangladesh', 'Dhaka Division', 'Azimpur', '{\"status\":\"success\",\"country\":\"Bangladesh\",\"countryCode\":\"BD\",\"region\":\"C\",\"regionName\":\"Dhaka Division\",\"city\":\"Azimpur\",\"zip\":\"1205\",\"lat\":23.729800000000000892441676114685833454132080078125,\"lon\":90.3854000000000041836756281554698944091796875,\"timezone\":\"Asia\\/Dhaka\",\"isp\":\"Dhakacom Limited\",\"org\":\"AmberIT Boject\",\"as\":\"AS23956 AmberIT Limited\",\"query\":\"118.179.96.220\"}', '2023-08-29 23:03:26', '2023-08-29 23:03:26'),
(32, 1, 'dev@websolutionfirm.com', NULL, 'success', '121.75.128.250', 'New Zealand', 'Waikato', 'Taupo', '{\"status\":\"success\",\"country\":\"New Zealand\",\"countryCode\":\"NZ\",\"region\":\"WKO\",\"regionName\":\"Waikato\",\"city\":\"Taupo\",\"zip\":\"3330\",\"lat\":-38.730400000000003046807250939309597015380859375,\"lon\":176.0706000000000130967237055301666259765625,\"timezone\":\"Pacific\\/Auckland\",\"isp\":\"Vodafone New Zealand Limited\",\"org\":\"\",\"as\":\"AS9500 One New Zealand Group Limited\",\"query\":\"121.75.128.250\"}', '2023-09-15 02:20:38', '2023-09-15 02:20:38'),
(33, 1, 'dev@websolutionfirm.com', NULL, 'success', '123.255.63.193', 'New Zealand', 'Canterbury', 'Christchurch', '{\"status\":\"success\",\"country\":\"New Zealand\",\"countryCode\":\"NZ\",\"region\":\"CAN\",\"regionName\":\"Canterbury\",\"city\":\"Christchurch\",\"zip\":\"8011\",\"lat\":-43.54189999999999827196006663143634796142578125,\"lon\":172.614000000000004320099833421409130096435546875,\"timezone\":\"Pacific\\/Auckland\",\"isp\":\"Two Degrees Mobile Limited\",\"org\":\"Snapnet\",\"as\":\"AS23655 2degrees Networks Limited\",\"query\":\"123.255.63.193\"}', '2023-09-19 19:17:44', '2023-09-19 19:17:44'),
(34, NULL, 'admin@example.com', '123456', 'failed', NULL, NULL, NULL, NULL, 'false', '2023-09-25 04:00:47', '2023-09-25 04:00:47'),
(35, NULL, 'dev@websolutionfirm.com', '123456789', 'failed', NULL, NULL, NULL, NULL, 'false', '2023-09-25 04:01:08', '2023-09-25 04:01:08'),
(36, NULL, 'dev@websolutionfirm.com', '12345678', 'failed', NULL, NULL, NULL, NULL, 'false', '2023-09-25 04:01:13', '2023-09-25 04:01:13'),
(37, 1, 'dev@websolutionfirm.com', NULL, 'success', NULL, NULL, NULL, NULL, 'false', '2023-09-25 04:01:49', '2023-09-25 04:01:49'),
(38, 1, 'dev@websolutionfirm.com', NULL, 'success', NULL, NULL, NULL, NULL, 'false', '2023-09-25 21:42:54', '2023-09-25 21:42:54'),
(39, 1, 'dev@websolutionfirm.com', NULL, 'success', NULL, NULL, NULL, NULL, 'false', '2023-09-26 04:13:07', '2023-09-26 04:13:07'),
(40, 1, 'dev@websolutionfirm.com', NULL, 'success', NULL, NULL, NULL, NULL, 'false', '2023-09-27 00:20:12', '2023-09-27 00:20:12'),
(41, 1, 'dev@websolutionfirm.com', NULL, 'success', NULL, NULL, NULL, NULL, 'false', '2023-10-02 03:12:22', '2023-10-02 03:12:22');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2022_08_13_122557_create_roles_table', 1),
(6, '2022_08_14_073856_create_permissions_table', 1),
(7, '2022_08_14_073906_create_user_permissions_table', 1),
(8, '2022_08_14_073915_create_role_permissions_table', 1),
(9, '2022_08_14_073929_create_user_roles_table', 1),
(10, '2022_10_26_042411_create_tickets_table', 1),
(11, '2022_10_26_042412_create_ticket_assigns_table', 1),
(12, '2022_10_26_042413_create_ticket_replies_table', 1),
(13, '2022_10_26_042447_create_activity_logs_table', 1),
(14, '2022_10_26_042513_create_login_histories_table', 1),
(15, '2022_10_26_042536_create_subscribers_table', 1),
(16, '2022_10_26_042537_create_email_histories_table', 1),
(17, '2022_11_22_051159_create_email_templates_table', 1),
(18, '2022_12_13_102630_create_configs_table', 1),
(19, '2023_01_03_060653_create_emails_table', 1),
(20, '2023_01_03_061135_create_email_recipients_table', 1),
(21, '2023_01_04_070249_create_assets_table', 1),
(22, '2023_01_04_114114_create_asset_sales_table', 1),
(23, '2023_01_05_110838_create_careers_table', 1),
(24, '2023_01_07_062646_create_expenses_table', 1),
(25, '2023_01_07_101946_create_events_table', 1),
(26, '2023_01_07_113203_create_notices_table', 1),
(27, '2023_01_19_112801_create_committees_table', 1),
(28, '2023_01_19_113813_create_committee_members_table', 1),
(29, '2023_01_26_111403_create_clubs_table', 1),
(30, '2023_01_26_112923_create_club_members_table', 1),
(31, '2023_02_22_034014_create_posts_table', 1),
(32, '2023_07_30_114837_create_user_profiles_table', 1),
(33, '2023_07_31_051651_create_faqs_table', 1),
(34, '2023_07_31_051830_create_projects_table', 1),
(35, '2023_07_31_052137_create_project_images_table', 1),
(36, '2023_07_31_053056_create_clients_table', 1),
(37, '2023_07_31_055437_create_testimonials_table', 1),
(38, '2023_07_31_055702_create_pricing_plans_table', 1),
(39, '2023_07_31_055913_create_galleries_table', 1),
(40, '2023_07_31_060054_create_gallery_images_table', 1),
(41, '2023_07_31_060620_create_teams_table', 1),
(42, '2023_07_31_061109_create_team_members_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `notices`
--

CREATE TABLE `notices` (
  `id` bigint UNSIGNED NOT NULL,
  `notice_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `short_description` text COLLATE utf8mb4_unicode_ci,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `featured_image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `is_featured` tinyint(1) NOT NULL DEFAULT '1',
  `operator_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `group` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `slug`, `group`, `created_at`, `updated_at`) VALUES
(1, 'List', 'role_index', 'role', '2023-08-10 06:11:13', '2023-08-10 06:11:13'),
(2, 'Create', 'role_create', 'role', '2023-08-10 06:11:13', '2023-08-10 06:11:13'),
(3, 'Show', 'role_show', 'role', '2023-08-10 06:11:13', '2023-08-10 06:11:13'),
(4, 'Update', 'role_update', 'role', '2023-08-10 06:11:13', '2023-08-10 06:11:13'),
(5, 'Delete', 'role_delete', 'role', '2023-08-10 06:11:13', '2023-08-10 06:11:13'),
(6, 'Permission', 'role_permission', 'role', '2023-08-10 06:11:13', '2023-08-10 06:11:13'),
(7, 'Permission Update', 'role_permission_update', 'role', '2023-08-10 06:11:13', '2023-08-10 06:11:13'),
(8, 'List', 'dropdown_index', 'dropdown', '2023-08-10 06:11:13', '2023-08-10 06:11:13'),
(9, 'Create', 'dropdown_create', 'dropdown', '2023-08-10 06:11:13', '2023-08-10 06:11:13'),
(10, 'Show', 'dropdown_show', 'dropdown', '2023-08-10 06:11:13', '2023-08-10 06:11:13'),
(11, 'Update', 'dropdown_update', 'dropdown', '2023-08-10 06:11:13', '2023-08-10 06:11:13'),
(12, 'Delete', 'dropdown_delete', 'dropdown', '2023-08-10 06:11:14', '2023-08-10 06:11:14'),
(13, 'Show', 'general_settings_show', 'general_settings', '2023-08-10 06:11:14', '2023-08-10 06:11:14'),
(14, 'Update', 'general_settings_update', 'general_settings', '2023-08-10 06:11:14', '2023-08-10 06:11:14'),
(15, 'List', 'user_index', 'user', '2023-08-10 06:11:14', '2023-08-10 06:11:14'),
(16, 'Create', 'user_create', 'user', '2023-08-10 06:11:14', '2023-08-10 06:11:14'),
(17, 'Update', 'user_update', 'user', '2023-08-10 06:11:14', '2023-08-10 06:11:14'),
(18, 'Delete', 'user_delete', 'user', '2023-08-10 06:11:14', '2023-08-10 06:11:14'),
(19, 'Show', 'user_show', 'user', '2023-08-10 06:11:14', '2023-08-10 06:11:14'),
(20, 'Restore', 'user_restore', 'user', '2023-08-10 06:11:14', '2023-08-10 06:11:14'),
(21, 'Update Status', 'user_update_status', 'user', '2023-08-10 06:11:14', '2023-08-10 06:11:14'),
(22, 'Update Password', 'user_update_password', 'user', '2023-08-10 06:11:14', '2023-08-10 06:11:14'),
(23, 'List', 'blog_index', 'blog', '2023-08-10 06:11:14', '2023-08-10 06:11:14'),
(24, 'Create', 'blog_create', 'blog', '2023-08-10 06:11:14', '2023-08-10 06:11:14'),
(25, 'Update', 'blog_update', 'blog', '2023-08-10 06:11:14', '2023-08-10 06:11:14'),
(26, 'Delete', 'blog_delete', 'blog', '2023-08-10 06:11:14', '2023-08-10 06:11:14'),
(27, 'Update Status', 'blog_update_status', 'blog', '2023-08-10 06:11:14', '2023-08-10 06:11:14'),
(28, 'Show', 'blog_show', 'blog', '2023-08-10 06:11:14', '2023-08-10 06:11:14'),
(29, 'List', 'notice_index', 'notice', '2023-08-10 06:11:14', '2023-08-10 06:11:14'),
(30, 'Create', 'notice_create', 'notice', '2023-08-10 06:11:14', '2023-08-10 06:11:14'),
(31, 'Update', 'notice_update', 'notice', '2023-08-10 06:11:14', '2023-08-10 06:11:14'),
(32, 'Delete', 'notice_delete', 'notice', '2023-08-10 06:11:14', '2023-08-10 06:11:14'),
(33, 'Show', 'notice_show', 'notice', '2023-08-10 06:11:14', '2023-08-10 06:11:14'),
(34, 'Update Status', 'notice_update_status', 'notice', '2023-08-10 06:11:14', '2023-08-10 06:11:14'),
(35, 'List', 'news_index', 'news', '2023-08-10 06:11:14', '2023-08-10 06:11:14'),
(36, 'Create', 'news_create', 'news', '2023-08-10 06:11:14', '2023-08-10 06:11:14'),
(37, 'Update', 'news_update', 'news', '2023-08-10 06:11:14', '2023-08-10 06:11:14'),
(38, 'Delete', 'news_delete', 'news', '2023-08-10 06:11:14', '2023-08-10 06:11:14'),
(39, 'Show', 'news_show', 'news', '2023-08-10 06:11:14', '2023-08-10 06:11:14'),
(40, 'List', 'faqs_index', 'faqs', '2023-08-10 06:11:14', '2023-08-10 06:11:14'),
(41, 'Create', 'faqs_create', 'faqs', '2023-08-10 06:11:14', '2023-08-10 06:11:14'),
(42, 'Update', 'faqs_update', 'faqs', '2023-08-10 06:11:14', '2023-08-10 06:11:14'),
(43, 'Delete', 'faqs_delete', 'faqs', '2023-08-10 06:11:14', '2023-08-10 06:11:14'),
(44, 'Show', 'faqs_show', 'faqs', '2023-08-10 06:11:14', '2023-08-10 06:11:14'),
(45, 'List', 'subscribers_index', 'subscribers', '2023-08-10 06:11:14', '2023-08-10 06:11:14'),
(46, 'Create', 'subscribers_create', 'subscribers', '2023-08-10 06:11:14', '2023-08-10 06:11:14'),
(47, 'Update', 'subscribers_update', 'subscribers', '2023-08-10 06:11:14', '2023-08-10 06:11:14'),
(48, 'Delete', 'subscribers_delete', 'subscribers', '2023-08-10 06:11:14', '2023-08-10 06:11:14'),
(49, 'Show', 'subscribers_show', 'subscribers', '2023-08-10 06:11:14', '2023-08-10 06:11:14'),
(50, 'List', 'event_index', 'event', '2023-08-10 06:11:14', '2023-08-10 06:11:14'),
(51, 'Create', 'event_create', 'event', '2023-08-10 06:11:15', '2023-08-10 06:11:15'),
(52, 'Update', 'event_update', 'event', '2023-08-10 06:11:15', '2023-08-10 06:11:15'),
(53, 'Delete', 'event_delete', 'event', '2023-08-10 06:11:15', '2023-08-10 06:11:15'),
(54, 'Show', 'event_show', 'event', '2023-08-10 06:11:15', '2023-08-10 06:11:15'),
(55, 'Status Update', 'event_status', 'event', '2023-08-10 06:11:15', '2023-08-10 06:11:15'),
(56, 'List', 'asset_index', 'asset', '2023-08-10 06:11:15', '2023-08-10 06:11:15'),
(57, 'Create', 'asset_create', 'asset', '2023-08-10 06:11:15', '2023-08-10 06:11:15'),
(58, 'Update', 'asset_update', 'asset', '2023-08-10 06:11:15', '2023-08-10 06:11:15'),
(59, 'Delete', 'asset_delete', 'asset', '2023-08-10 06:11:15', '2023-08-10 06:11:15'),
(60, 'Show', 'asset_show', 'asset', '2023-08-10 06:11:15', '2023-08-10 06:11:15'),
(61, 'List', 'asset_sale_index', 'asset_sale', '2023-08-10 06:11:15', '2023-08-10 06:11:15'),
(62, 'Create', 'asset_sale_create', 'asset_sale', '2023-08-10 06:11:15', '2023-08-10 06:11:15'),
(63, 'Update', 'asset_sale_update', 'asset_sale', '2023-08-10 06:11:15', '2023-08-10 06:11:15'),
(64, 'Delete', 'asset_sale_delete', 'asset_sale', '2023-08-10 06:11:15', '2023-08-10 06:11:15'),
(65, 'Show', 'asset_sale_show', 'asset_sale', '2023-08-10 06:11:15', '2023-08-10 06:11:15'),
(66, 'List', 'committee_index', 'committee', '2023-08-10 06:11:15', '2023-08-10 06:11:15'),
(67, 'Create', 'committee_create', 'committee', '2023-08-10 06:11:15', '2023-08-10 06:11:15'),
(68, 'Update', 'committee_update', 'committee', '2023-08-10 06:11:15', '2023-08-10 06:11:15'),
(69, 'Delete', 'committee_delete', 'committee', '2023-08-10 06:11:15', '2023-08-10 06:11:15'),
(70, 'Show', 'committee_show', 'committee', '2023-08-10 06:11:15', '2023-08-10 06:11:15'),
(71, 'Update Status', 'committee_change_status', 'committee', '2023-08-10 06:11:15', '2023-08-10 06:11:15'),
(72, 'Set Current', 'committee_set_current', 'committee', '2023-08-10 06:11:15', '2023-08-10 06:11:15'),
(73, 'List', 'committee_member_index', 'committee_member', '2023-08-10 06:11:15', '2023-08-10 06:11:15'),
(74, 'Create', 'committee_member_create', 'committee_member', '2023-08-10 06:11:15', '2023-08-10 06:11:15'),
(75, 'Update', 'committee_member_update', 'committee_member', '2023-08-10 06:11:15', '2023-08-10 06:11:15'),
(76, 'Delete', 'committee_member_delete', 'committee_member', '2023-08-10 06:11:15', '2023-08-10 06:11:15'),
(77, 'Show', 'committee_member_show', 'committee_member', '2023-08-10 06:11:15', '2023-08-10 06:11:15'),
(78, 'List', 'club_index', 'club', '2023-08-10 06:11:15', '2023-08-10 06:11:15'),
(79, 'Create', 'club_create', 'club', '2023-08-10 06:11:15', '2023-08-10 06:11:15'),
(80, 'Update', 'club_update', 'club', '2023-08-10 06:11:15', '2023-08-10 06:11:15'),
(81, 'Delete', 'club_delete', 'club', '2023-08-10 06:11:15', '2023-08-10 06:11:15'),
(82, 'Show', 'club_show', 'club', '2023-08-10 06:11:15', '2023-08-10 06:11:15'),
(83, 'List', 'club_committee_index', 'club_committee', '2023-08-10 06:11:15', '2023-08-10 06:11:15'),
(84, 'Create', 'club_committee_create', 'club_committee', '2023-08-10 06:11:15', '2023-08-10 06:11:15'),
(85, 'Update', 'club_committee_update', 'club_committee', '2023-08-10 06:11:15', '2023-08-10 06:11:15'),
(86, 'Delete', 'club_committee_delete', 'club_committee', '2023-08-10 06:11:15', '2023-08-10 06:11:15'),
(87, 'Show', 'club_committee_show', 'club_committee', '2023-08-10 06:11:15', '2023-08-10 06:11:15'),
(88, 'List', 'club_member_index', 'club_member', '2023-08-10 06:11:15', '2023-08-10 06:11:15'),
(89, 'Create', 'club_member_create', 'club_member', '2023-08-10 06:11:15', '2023-08-10 06:11:15'),
(90, 'Update', 'club_member_update', 'club_member', '2023-08-10 06:11:15', '2023-08-10 06:11:15'),
(91, 'Delete', 'club_member_delete', 'club_member', '2023-08-10 06:11:16', '2023-08-10 06:11:16'),
(92, 'Show', 'club_member_show', 'club_member', '2023-08-10 06:11:16', '2023-08-10 06:11:16'),
(93, 'List', 'business_index', 'business', '2023-08-10 06:11:16', '2023-08-10 06:11:16'),
(94, 'Create', 'business_create', 'business', '2023-08-10 06:11:16', '2023-08-10 06:11:16'),
(95, 'Update', 'business_update', 'business', '2023-08-10 06:11:16', '2023-08-10 06:11:16'),
(96, 'Delete', 'business_delete', 'business', '2023-08-10 06:11:16', '2023-08-10 06:11:16'),
(97, 'Show', 'business_show', 'business', '2023-08-10 06:11:16', '2023-08-10 06:11:16'),
(98, 'Change Status', 'business_change_status', 'business', '2023-08-10 06:11:16', '2023-08-10 06:11:16'),
(99, 'Confirm Payment', 'business_confirm_payment', 'business', '2023-08-10 06:11:16', '2023-08-10 06:11:16'),
(100, 'List', 'career_index', 'career', '2023-08-10 06:11:16', '2023-08-10 06:11:16'),
(101, 'Create', 'career_create', 'career', '2023-08-10 06:11:16', '2023-08-10 06:11:16'),
(102, 'Update', 'career_update', 'career', '2023-08-10 06:11:16', '2023-08-10 06:11:16'),
(103, 'Delete', 'career_delete', 'career', '2023-08-10 06:11:16', '2023-08-10 06:11:16'),
(104, 'Show', 'career_show', 'career', '2023-08-10 06:11:16', '2023-08-10 06:11:16'),
(105, 'List', 'transaction_index', 'transaction', '2023-08-10 06:11:16', '2023-08-10 06:11:16'),
(106, 'Create', 'transaction_create', 'transaction', '2023-08-10 06:11:16', '2023-08-10 06:11:16'),
(107, 'Update Status', 'transaction_update_status', 'transaction', '2023-08-10 06:11:16', '2023-08-10 06:11:16'),
(108, 'Delete', 'transaction_delete', 'transaction', '2023-08-10 06:11:16', '2023-08-10 06:11:16'),
(109, 'Show', 'transaction_show', 'transaction', '2023-08-10 06:11:16', '2023-08-10 06:11:16'),
(110, 'List', 'subscription_index', 'subscription', '2023-08-10 06:11:16', '2023-08-10 06:11:16'),
(111, 'Create', 'subscription_create', 'subscription', '2023-08-10 06:11:16', '2023-08-10 06:11:16'),
(112, 'Update', 'subscription_update', 'subscription', '2023-08-10 06:11:16', '2023-08-10 06:11:16'),
(113, 'Delete', 'subscription_delete', 'subscription', '2023-08-10 06:11:16', '2023-08-10 06:11:16'),
(114, 'Show', 'subscription_show', 'subscription', '2023-08-10 06:11:16', '2023-08-10 06:11:16'),
(115, 'List', 'report_login', 'log', '2023-08-10 06:11:16', '2023-08-10 06:11:16'),
(116, 'List', 'log_login', 'log', '2023-08-10 06:11:16', '2023-08-10 06:11:16'),
(117, 'Delete', 'log_delete_login', 'log', '2023-08-10 06:11:16', '2023-08-10 06:11:16'),
(118, 'Show', 'profile_index', 'profile', '2023-08-10 06:11:16', '2023-08-10 06:11:16'),
(119, 'Update', 'profile_update', 'profile', '2023-08-10 06:11:16', '2023-08-10 06:11:16'),
(120, 'Update Password', 'profile_update_password', 'profile', '2023-08-10 06:11:16', '2023-08-10 06:11:16'),
(121, 'List', 'payment_index', 'payment', '2023-08-10 06:11:16', '2023-08-10 06:11:16'),
(122, 'Create', 'payment_create', 'payment', '2023-08-10 06:11:16', '2023-08-10 06:11:16'),
(123, 'Email Setting List', 'setting_email', 'setting', '2023-08-10 06:11:16', '2023-08-10 06:11:16'),
(124, 'Email Setting Update', 'setting_email_update', 'setting', '2023-08-10 06:11:16', '2023-08-10 06:11:16'),
(125, 'List', 'notification_index', 'notification', '2023-08-10 06:11:16', '2023-08-10 06:11:16'),
(126, 'Create', 'notification_create', 'notification', '2023-08-10 06:11:16', '2023-08-10 06:11:16'),
(127, 'Delete', 'notification_delete', 'notification', '2023-08-10 06:11:16', '2023-08-10 06:11:16'),
(128, 'List', 'activity_log_index', 'activity_log', '2023-08-10 06:11:16', '2023-08-10 06:11:16'),
(129, 'Show', 'activity_log_details', 'activity_log', '2023-08-10 06:11:16', '2023-08-10 06:11:16'),
(130, 'Delete', 'activity_log_delete', 'activity_log', '2023-08-10 06:11:16', '2023-08-10 06:11:16'),
(131, 'List', 'email_index', 'email', '2023-08-10 06:11:17', '2023-08-10 06:11:17'),
(132, 'Create', 'email_create', 'email', '2023-08-10 06:11:17', '2023-08-10 06:11:17'),
(133, 'Recipent', 'email_recipient', 'email', '2023-08-10 06:11:17', '2023-08-10 06:11:17'),
(134, 'Show', 'email_show', 'email', '2023-08-10 06:11:17', '2023-08-10 06:11:17'),
(135, 'Asset Reports', 'report_assets', 'report', '2023-08-10 06:11:17', '2023-08-10 06:11:17'),
(136, 'Transaction Reports', 'report_transactions', 'report', '2023-08-10 06:11:17', '2023-08-10 06:11:17'),
(137, 'Member Status Report', 'report_member_status', 'report', '2023-08-10 06:11:17', '2023-08-10 06:11:17'),
(138, 'Member Signup Report', 'report_member_signup', 'report', '2023-08-10 06:11:17', '2023-08-10 06:11:17'),
(139, 'List', 'pricing_plan_index', 'pricing_plan', '2023-08-10 06:11:17', '2023-08-10 06:11:17'),
(140, 'Create', 'pricing_plan_create', 'pricing_plan', '2023-08-10 06:11:17', '2023-08-10 06:11:17'),
(141, 'Update', 'pricing_plan_update', 'pricing_plan', '2023-08-10 06:11:17', '2023-08-10 06:11:17'),
(142, 'Delete', 'pricing_plan_delete', 'pricing_plan', '2023-08-10 06:11:17', '2023-08-10 06:11:17'),
(143, 'Show', 'pricing_plan_show', 'pricing_plan', '2023-08-10 06:11:17', '2023-08-10 06:11:17'),
(144, 'Change Status', 'pricing_plan_change_status', 'pricing_plan', '2023-08-10 06:11:17', '2023-08-10 06:11:17'),
(145, 'List', 'project_index', 'project', '2023-08-10 06:11:17', '2023-08-10 06:11:17'),
(146, 'Create', 'project_create', 'project', '2023-08-10 06:11:17', '2023-08-10 06:11:17'),
(147, 'Update', 'project_update', 'project', '2023-08-10 06:11:17', '2023-08-10 06:11:17'),
(148, 'Delete', 'project_delete', 'project', '2023-08-10 06:11:17', '2023-08-10 06:11:17'),
(149, 'Update Status', 'project_update_status', 'project', '2023-08-10 06:11:17', '2023-08-10 06:11:17'),
(150, 'Show', 'project_show', 'project', '2023-08-10 06:11:17', '2023-08-10 06:11:17'),
(151, 'Create Project Image', 'project_image_create', 'project', '2023-08-10 06:11:17', '2023-08-10 06:11:17'),
(152, 'Delete Project Image', 'project_image_delete', 'project', '2023-08-10 06:11:17', '2023-08-10 06:11:17'),
(153, 'List', 'gallery_index', 'gallery', '2023-08-10 06:11:17', '2023-08-10 06:11:17'),
(154, 'Create', 'gallery_create', 'gallery', '2023-08-10 06:11:17', '2023-08-10 06:11:17'),
(155, 'Update', 'gallery_update', 'gallery', '2023-08-10 06:11:17', '2023-08-10 06:11:17'),
(156, 'Delete', 'gallery_delete', 'gallery', '2023-08-10 06:11:17', '2023-08-10 06:11:17'),
(157, 'Update Status', 'gallery_update_status', 'gallery', '2023-08-10 06:11:17', '2023-08-10 06:11:17'),
(158, 'Show', 'gallery_show', 'gallery', '2023-08-10 06:11:17', '2023-08-10 06:11:17'),
(159, 'Create Gallery Image', 'gallery_image_create', 'gallery', '2023-08-10 06:11:17', '2023-08-10 06:11:17'),
(160, 'Delete Gallery Image', 'gallery_image_delete', 'gallery', '2023-08-10 06:11:17', '2023-08-10 06:11:17'),
(161, 'List', 'testimonial_index', 'testimonial', '2023-08-10 06:11:17', '2023-08-10 06:11:17'),
(162, 'Create', 'testimonial_create', 'testimonial', '2023-08-10 06:11:17', '2023-08-10 06:11:17'),
(163, 'Update', 'testimonial_update', 'testimonial', '2023-08-10 06:11:17', '2023-08-10 06:11:17'),
(164, 'Delete', 'testimonial_delete', 'testimonial', '2023-08-10 06:11:17', '2023-08-10 06:11:17'),
(165, 'Update Status', 'testimonial_update_status', 'testimonial', '2023-08-10 06:11:17', '2023-08-10 06:11:17'),
(166, 'Show', 'testimonial_show', 'testimonial', '2023-08-10 06:11:17', '2023-08-10 06:11:17'),
(167, 'List', 'client_index', 'client', '2023-08-10 06:11:17', '2023-08-10 06:11:17'),
(168, 'Create', 'client_create', 'client', '2023-08-10 06:11:17', '2023-08-10 06:11:17'),
(169, 'Update', 'client_update', 'client', '2023-08-10 06:11:17', '2023-08-10 06:11:17'),
(170, 'Delete', 'client_delete', 'client', '2023-08-10 06:11:17', '2023-08-10 06:11:17'),
(171, 'Update Status', 'client_update_status', 'client', '2023-08-10 06:11:17', '2023-08-10 06:11:17'),
(172, 'Show', 'client_show', 'client', '2023-08-10 06:11:18', '2023-08-10 06:11:18'),
(173, 'List', 'partner_index', 'partner', '2023-08-10 06:11:18', '2023-08-10 06:11:18'),
(174, 'Create', 'partner_create', 'partner', '2023-08-10 06:11:18', '2023-08-10 06:11:18'),
(175, 'Update', 'partner_update', 'partner', '2023-08-10 06:11:18', '2023-08-10 06:11:18'),
(176, 'Delete', 'partner_delete', 'partner', '2023-08-10 06:11:18', '2023-08-10 06:11:18'),
(177, 'Update Status', 'partner_update_status', 'partner', '2023-08-10 06:11:18', '2023-08-10 06:11:18'),
(178, 'Show', 'partner_show', 'partner', '2023-08-10 06:11:18', '2023-08-10 06:11:18'),
(179, 'List', 'team_index', 'team', '2023-08-10 06:11:18', '2023-08-10 06:11:18'),
(180, 'Create', 'team_create', 'team', '2023-08-10 06:11:18', '2023-08-10 06:11:18'),
(181, 'Update', 'team_update', 'team', '2023-08-10 06:11:18', '2023-08-10 06:11:18'),
(182, 'Delete', 'team_delete', 'team', '2023-08-10 06:11:18', '2023-08-10 06:11:18'),
(183, 'Update Status', 'team_update_status', 'team', '2023-08-10 06:11:18', '2023-08-10 06:11:18'),
(184, 'Show', 'team_show', 'team', '2023-08-10 06:11:18', '2023-08-10 06:11:18'),
(185, 'Manage People', 'menu_manage_people', 'menu', '2023-08-10 06:11:18', '2023-08-10 06:11:18'),
(186, 'Manage Post', 'menu_manage_post', 'menu', '2023-08-10 06:11:18', '2023-08-10 06:11:18'),
(187, 'Manage User', 'menu_manage_user', 'menu', '2023-08-10 06:11:18', '2023-08-10 06:11:18'),
(188, 'Bulk Email', 'menu_bulk_email', 'menu', '2023-08-10 06:11:18', '2023-08-10 06:11:18'),
(189, 'Asset', 'menu_asset', 'menu', '2023-08-10 06:11:18', '2023-08-10 06:11:18'),
(190, 'Footprint', 'menu_footprint', 'menu', '2023-08-10 06:11:18', '2023-08-10 06:11:18'),
(191, 'Configuration', 'menu_configuration', 'menu', '2023-08-10 06:11:18', '2023-08-10 06:11:18');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `post_type` enum('blog','news') COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'come from enum, blog/news',
  `category` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tags` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `short_description` text COLLATE utf8mb4_unicode_ci,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `featured_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_featured` tinyint(1) NOT NULL DEFAULT '0',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `operator_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `title`, `post_type`, `category`, `tags`, `short_description`, `description`, `featured_image`, `link`, `is_featured`, `is_active`, `operator_id`, `created_at`, `updated_at`) VALUES
(1, 'Sunt in officiis ut', 'news', NULL, NULL, NULL, 'Eveniet, quis aut es.zxvfdxgb', NULL, 'https://www.firajusoqagesu.me.uk', 1, 1, 1, '2023-09-25 04:03:52', '2023-09-25 04:03:52'),
(2, 'Eos consequat Quas', 'blog', 'Blaze Nieves', '[\"Carla Nelson\",\"Adele Mckay\"]', 'Non sint ex officia cvbcvb', 'Laboris sunt, eaque . bcfbcvb', 'storage/blog/1695636321948.jpg', NULL, 1, 1, 1, '2023-09-25 04:05:22', '2023-09-25 04:05:22'),
(3, 'Reprehenderit rerum', 'blog', 'Blaze Nieves', '[\"Kevyn Shaw\",\"Blaze Nieves\"]', 'Debitis quisquam comcvxcvxc', 'Eligendi consequatur.cvxcvxxv', 'storage/blog/1695636337561.jpg', NULL, 0, 1, 1, '2023-09-25 04:05:38', '2023-09-27 00:21:43'),
(4, 'natural resources of new Zealand', 'blog', 'Blaze Nieves', NULL, 'new Zealand is very popular for natural resources', '<p style=\"margin: 0.5em 0px; color: rgb(32, 33, 34); font-family: sans-serif; font-size: 14px;\"><b>Mining in New Zealand</b>&nbsp;began when the&nbsp;<a href=\"https://en.wikipedia.org/wiki/M%C4%81ori_people\" title=\"Māori people\" style=\"color: rgb(51, 102, 204); background-image: none; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; overflow-wrap: break-word;\">Māori</a>&nbsp;quarried rock such as&nbsp;<a href=\"https://en.wikipedia.org/wiki/Argillite\" title=\"Argillite\" style=\"color: rgb(51, 102, 204); background-image: none; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; overflow-wrap: break-word;\">argillite</a>&nbsp;in times prior to European colonisation.<sup id=\"cite_ref-1\" class=\"reference\" style=\"line-height: 1; unicode-bidi: isolate; text-wrap: nowrap; font-size: 11.2px;\"><a href=\"https://en.wikipedia.org/wiki/Mining_in_New_Zealand#cite_note-1\" style=\"color: rgb(51, 102, 204); background-image: none; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; overflow-wrap: break-word;\">[1]</a></sup>&nbsp;<a href=\"https://en.wikipedia.org/wiki/Mining\" title=\"Mining\" style=\"color: rgb(51, 102, 204); background-image: none; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; overflow-wrap: break-word;\">Mining</a>&nbsp;by Europeans began in the latter half of the 19th century.</p><p style=\"margin: 0.5em 0px; color: rgb(32, 33, 34); font-family: sans-serif; font-size: 14px;\"><a href=\"https://en.wikipedia.org/wiki/New_Zealand\" title=\"New Zealand\" style=\"color: rgb(51, 102, 204); background-image: none; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; overflow-wrap: break-word;\">New Zealand</a>&nbsp;has abundant resources of&nbsp;<a href=\"https://en.wikipedia.org/wiki/Coal\" title=\"Coal\" style=\"color: rgb(51, 102, 204); background-image: none; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; overflow-wrap: break-word;\">coal</a>,&nbsp;<a href=\"https://en.wikipedia.org/wiki/Silver\" title=\"Silver\" style=\"color: rgb(51, 102, 204); background-image: none; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; overflow-wrap: break-word;\">silver</a>,&nbsp;<a href=\"https://en.wikipedia.org/wiki/Iron_ore\" title=\"Iron ore\" style=\"color: rgb(51, 102, 204); background-image: none; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; overflow-wrap: break-word;\">iron ore</a>,&nbsp;<a href=\"https://en.wikipedia.org/wiki/Limestone\" title=\"Limestone\" style=\"color: rgb(51, 102, 204); background-image: none; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; overflow-wrap: break-word;\">limestone</a>&nbsp;and&nbsp;<a href=\"https://en.wikipedia.org/wiki/Gold\" title=\"Gold\" style=\"color: rgb(51, 102, 204); background-image: none; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; overflow-wrap: break-word;\">gold</a>. It ranked 22 in the world in terms of iron ore production and 29th in gold production. The total value of&nbsp;<a href=\"https://en.wikipedia.org/wiki/Mineral\" title=\"Mineral\" style=\"color: rgb(51, 102, 204); background-image: none; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; overflow-wrap: break-word;\">mineral</a>&nbsp;production in New Zealand was $1.5 billion in 2006 (excluding oil and gas). The most important metallic minerals produced are gold (10.62 tonnes), silver (27.2 tonnes) and titanomagnetite&nbsp;<a href=\"https://en.wikipedia.org/wiki/Ironsand\" title=\"Ironsand\" style=\"color: rgb(51, 102, 204); background-image: none; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; overflow-wrap: break-word;\">ironsand</a>&nbsp;(2.15 million tonnes). A 2008 report estimated that the unexploited resources of just seven core minerals (including gold, copper, iron and&nbsp;<a href=\"https://en.wikipedia.org/wiki/Molybdenum\" title=\"Molybdenum\" style=\"color: rgb(51, 102, 204); background-image: none; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; overflow-wrap: break-word;\">molybdenum</a>) totalled around $140 billion in worth.<sup id=\"cite_ref-GREENZONE_2-0\" class=\"reference\" style=\"line-height: 1; unicode-bidi: isolate; text-wrap: nowrap; font-size: 11.2px;\"><a href=\"https://en.wikipedia.org/wiki/Mining_in_New_Zealand#cite_note-GREENZONE-2\" style=\"color: rgb(51, 102, 204); background-image: none; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; overflow-wrap: break-word;\">[2]</a></sup></p><p style=\"margin: 0.5em 0px; color: rgb(32, 33, 34); font-family: sans-serif; font-size: 14px;\">The mining sector makes a significant contribution to the&nbsp;<a href=\"https://en.wikipedia.org/wiki/New_Zealand_economy\" class=\"mw-redirect\" title=\"New Zealand economy\" style=\"color: rgb(51, 102, 204); background-image: none; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; overflow-wrap: break-word;\">New Zealand economy</a>. In 2004 the value of production from mining (excluding oil and gas) was $1,142 million, or just under 1% of&nbsp;<a href=\"https://en.wikipedia.org/wiki/Economy_of_New_Zealand#Overview\" title=\"Economy of New Zealand\" style=\"color: rgb(51, 102, 204); background-image: none; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; overflow-wrap: break-word;\">gross domestic product</a>.<sup id=\"cite_ref-3\" class=\"reference\" style=\"line-height: 1; unicode-bidi: isolate; text-wrap: nowrap; font-size: 11.2px;\"><a href=\"https://en.wikipedia.org/wiki/Mining_in_New_Zealand#cite_note-3\" style=\"color: rgb(51, 102, 204); background-image: none; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; overflow-wrap: break-word;\">[3]</a></sup>&nbsp;In 2017 mining contributed $3,079m (1.3%) to a GDP of $235,945m.<sup id=\"cite_ref-:0_4-0\" class=\"reference\" style=\"line-height: 1; unicode-bidi: isolate; text-wrap: nowrap; font-size: 11.2px;\"><a href=\"https://en.wikipedia.org/wiki/Mining_in_New_Zealand#cite_note-:0-4\" style=\"color: rgb(51, 102, 204); background-image: none; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; overflow-wrap: break-word;\">[4]</a></sup></p><p style=\"margin: 0.5em 0px; color: rgb(32, 33, 34); font-family: sans-serif; font-size: 14px;\">In 2009 there were 6,800 people employed directly in mining, and 8,000 people, indirectly, flowing from the economic activity of the 6,800. The median wage for a mining employee was $57,320 in 2008, compared to the New Zealand median of $33,530.<sup class=\"noprint Inline-Template Template-Fact\" style=\"line-height: 1; font-size: 11.2px; text-wrap: nowrap;\">[<i><a href=\"https://en.wikipedia.org/wiki/Wikipedia:Citation_needed\" title=\"Wikipedia:Citation needed\" style=\"color: rgb(51, 102, 204); background-image: none; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; overflow-wrap: break-word;\"><span title=\"This claim needs references to reliable sources. (August 2011)\">citation needed</span></a></i>]</sup>&nbsp;In 2017 mining employed 5,300 (0.2%), out of a total workforce of 2,593,000.<sup id=\"cite_ref-5\" class=\"reference\" style=\"line-height: 1; unicode-bidi: isolate; text-wrap: nowrap; font-size: 11.2px;\"><a href=\"https://en.wikipedia.org/wiki/Mining_in_New_Zealand#cite_note-5\" style=\"color: rgb(51, 102, 204); background-image: none; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; overflow-wrap: break-word;\">[5]</a></sup>&nbsp;In 2015 miners\' earnings average hourly earnings were $39.86 and median hourly earnings $31.33, though the number of miners had fallen to 6,300, compared to nationwide figures of $27.49, $22.92 and 2,004,100 (3%).<sup id=\"cite_ref-6\" class=\"reference\" style=\"line-height: 1; unicode-bidi: isolate; text-wrap: nowrap; font-size: 11.2px;\"><a href=\"https://en.wikipedia.org/wiki/Mining_in_New_Zealand#cite_note-6\" style=\"color: rgb(51, 102, 204); background-image: none; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; overflow-wrap: break-word;\">[6]</a></sup>&nbsp;These figures may though need to be treated with caution, as miners appear to have been earning 5% of total income (average earnings x employees), though GDP contribution in 2015 was only 1.6%.<sup id=\"cite_ref-:0_4-1\" class=\"reference\" style=\"line-height: 1; unicode-bidi: isolate; text-wrap: nowrap; font-size: 11.2px;\"><a href=\"https://en.wikipedia.org/wiki/Mining_in_New_Zealand#cite_note-:0-4\" style=\"color: rgb(51, 102, 204); background-image: none; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; overflow-wrap: break-word;\">[4]</a></sup></p>', 'storage/blog/1695701083614.JPG', NULL, 0, 0, 1, '2023-09-25 22:04:43', '2023-09-25 22:05:52'),
(6, 'Cupiditate placeat', 'blog', 'Kevyn Shaw', '[\"Adele Mckay\"]', 'Enim nostrud dolor p', 'Dignissimos ipsum te.xvcxv', 'storage/blog/1695795765221.jpg', NULL, 0, 1, 1, '2023-09-27 00:22:45', '2023-09-27 00:22:45');

-- --------------------------------------------------------

--
-- Table structure for table `pricing_plans`
--

CREATE TABLE `pricing_plans` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` double(8,2) NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `is_featured` tinyint(1) NOT NULL DEFAULT '1',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `operator_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE `projects` (
  `id` bigint UNSIGNED NOT NULL,
  `category` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `short_description` text COLLATE utf8mb4_unicode_ci,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `featured_image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date` date DEFAULT NULL,
  `is_featured` tinyint(1) NOT NULL DEFAULT '0',
  `is_active` tinyint(1) NOT NULL DEFAULT '0',
  `operator_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`id`, `category`, `slug`, `name`, `short_description`, `description`, `featured_image`, `url`, `date`, `is_featured`, `is_active`, `operator_id`, `created_at`, `updated_at`) VALUES
(1, 'Residential', 'residential', 'Re-roof project at  Methuen road in New Windsor', 'The  successful completion of a residential re-roof project at  Methuen road in New Windsor.', '<p>The&nbsp; successful completion of a residential re-roof project at&nbsp; Methuen road in New Windsor. As the roofing contractor, we were entrusted with replacing the old roof, which covered an area of approximately 190 square meters. Our team diligently removed the worn-out roofing materials and installed new, top-quality materials in their place. Throughout the project, we adhered to all safety regulations and industry standards to ensure a seamless and secure installation. The newly completed roof not only enhances the aesthetic appeal of the property but also provides enhanced insulation and protection against the elements. We take pride in delivering a durable and weather-resistant roof that will serve the homeowner for many&nbsp;years&nbsp;to&nbsp;come.<br></p>', 'storage/project/1693024083749.jpg', NULL, NULL, 1, 1, 1, '2023-08-25 20:28:03', '2023-08-25 21:08:44'),
(2, 'Residential', 'residential', 'The  residential re-roof project at Eban Ave, Hilcrest!', 'The area covered in this project was approximately 175 square meters,', '<p>The area covered in this project was approximately 175 square meters, and the roof type chosen was a sleek and modern Standing Seam design. With a pitch of just 1 degree, this roof not only adds a touch of elegance to the property but also ensures efficient water drainage.<br><br>💪 Our team worked diligently to replace the old roof with the new Standing Seam system, using high-quality materials and adhering to industry standards. The chosen color, Grey Friars, adds a sophisticated touch to the overall aesthetic of the house.<br><br>🌧 With its durable construction and weather-resistant properties, this new roof will provide long-lasting protection against the elements, ensuring peace of mind for&nbsp;the&nbsp;homeowners.<br></p>', 'storage/project/1693024494986.jpg', NULL, NULL, 1, 1, 1, '2023-08-25 20:34:54', '2023-08-25 21:08:36'),
(3, 'Residential', 'residential', 'Residential re-roof project at Rosalind Road, Glenfield.', 'We are pleased to announce the successful completion of a residential re-roof project at Rosalind Road, Glenfield.', '<p>We are pleased to announce the successful completion of a residential re-roof project at Rosalind Road, Glenfield. This project involved re-roofing an area of 200m2, ensuring the utmost quality and durability for our valued client. Our team of experienced professionals worked diligently to deliver exceptional results, providing a new and improved roof that will protect the home for years to come. We take pride in our commitment to excellence and customer satisfaction, and this project is a testament to&nbsp;our&nbsp;dedication.<br></p>', 'storage/project/1693024644869.jpg', NULL, NULL, 1, 1, 1, '2023-08-25 20:37:25', '2023-08-25 21:06:59'),
(4, 'Commercial', 'commercial', 'Successful Completion of a Commercial Roofing Project: 5-Unit Warehouse at Rosedale, North Shore', NULL, '<p><b>Introduction:</b><br>We are thrilled to announce the successful completion of our recent commercial roofing project as a trusted roofing contractor. Our team has recently wrapped up an impressive roofing endeavor, involving a 5-unit warehouse development located in the bustling neighborhood of Rosedale, North Shore. We take immense pride in delivering exceptional quality and productivity, resulting in a highly satisfied client.<br><br><b>Exemplary Quality and Craftsmanship:</b><br>As a reputable roofing contractor, we understand the significance of a durable and reliable roofing system for commercial properties. Our team of skilled professionals has meticulously executed the project, ensuring exemplary quality and craftsmanship at every step. We have employed industry-leading techniques and utilized top-grade roofing materials to guarantee a long-lasting and aesthetically pleasing roofing solution.<br><br><b>Client Satisfaction as Our Top Priority:</b><br>At the core of our roofing services lies a commitment to client satisfaction. We are delighted to report that our client for the 5-unit warehouse project at Rosedale, North Shore is extremely pleased with the outcome. By maintaining open lines of communication, actively listening to their requirements, and providing regular updates, we have fostered a strong partnership built on trust and transparency.<br><b><br>Efficiency and Productivity:</b><br>We understand the importance of completing projects within the agreed-upon timelines while maintaining the highest standards of quality. Our team of dedicated professionals worked diligently to ensure optimal productivity throughout the roofing project. By employing efficient project management techniques and leveraging our expertise, we were able to deliver the roofing solution promptly, exceeding our client\'s expectations.<br><br><b>Tailored Solutions for Unique Requirements:</b><br>Each unit within the warehouse complex presented unique roofing requirements. Our team conducted thorough assessments and collaborated closely with the client to understand their specific needs. By tailoring our roofing solutions to meet these individual requirements, we were able to provide a customized roofing system that perfectly aligns with the intended use of each unit.<br><b><br>Client Testimonial:</b><br>Our client\'s satisfaction is the ultimate testament to our commitment to excellence. They have expressed their utmost satisfaction with the quality and productivity of our roofing services. Their positive feedback reinforces our dedication to delivering exceptional results and exceeding client expectations. Here\'s what our client had to say:<br><br>\"We are extremely pleased with the roofing services provided by Rainbow Roofing .The team demonstrated exceptional professionalism, attention to detail, and expertise throughout the project. The quality of their workmanship and the efficiency with which they completed the roofing project exceeded our expectations. We highly recommend Rainbow Roofing&nbsp; for any commercial roofing needs.\"<br><br><b>Conclusion:</b><br>The successful completion of our commercial roofing project at Rosedale, North Shore is a testament to our expertise, dedication, and commitment to client satisfaction. We take immense pride in delivering top-notch roofing solutions that not only meet but exceed the unique requirements of our clients. We extend our gratitude to our client for their trust and collaboration throughout the project.<br><br>As a roofing contractor, we remain committed to providing exceptional quality, productivity, and customer service. We look forward to continuing our mission of delivering outstanding roofing solutions for commercial properties in the North Shore area&nbsp;and&nbsp;beyond.<br></p>', 'storage/project/1694773501165.jpg', NULL, '2023-10-13', 0, 1, 1, '2023-09-15 02:25:03', '2023-09-15 02:26:28');

-- --------------------------------------------------------

--
-- Table structure for table `project_images`
--

CREATE TABLE `project_images` (
  `id` bigint UNSIGNED NOT NULL,
  `project_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `operator_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `project_images`
--

INSERT INTO `project_images` (`id`, `project_id`, `name`, `image`, `operator_id`, `created_at`, `updated_at`) VALUES
(1, 1, 'A', 'storage/attachment/1693024083490.jpg', 1, '2023-08-25 20:28:03', '2023-08-25 20:28:03'),
(2, 1, 'B', 'storage/attachment/1693024083779.jpg', 1, '2023-08-25 20:28:03', '2023-08-25 20:28:03'),
(3, 1, 'C', 'storage/attachment/1693024083181.jpg', 1, '2023-08-25 20:28:03', '2023-08-25 20:28:03'),
(4, 2, 'B', 'storage/attachment/1693024494407.jpg', 1, '2023-08-25 20:34:54', '2023-08-25 20:34:54'),
(5, 2, 'G', 'storage/attachment/1693024494565.jpg', 1, '2023-08-25 20:34:54', '2023-08-25 20:34:54'),
(6, 2, 'F', 'storage/attachment/1693024494836.jpg', 1, '2023-08-25 20:34:54', '2023-08-25 20:34:54'),
(7, 3, 'T', 'storage/attachment/1693024645654.jpg', 1, '2023-08-25 20:37:25', '2023-08-25 20:37:25'),
(8, 3, 'H', 'storage/attachment/1693024645574.jpg', 1, '2023-08-25 20:37:25', '2023-08-25 20:37:25'),
(9, 3, 'E', 'storage/attachment/1693024645445.jpg', 1, '2023-08-25 20:37:25', '2023-08-25 20:37:25'),
(10, 4, '1', 'storage/attachment/1694773503558.jpg', 1, '2023-09-15 02:25:03', '2023-09-15 02:25:03'),
(11, 4, '2', 'storage/attachment/1694773503702.jpg', 1, '2023-09-15 02:25:03', '2023-09-15 02:25:03'),
(12, 4, '3', 'storage/attachment/1694773503586.jpg', 1, '2023-09-15 02:25:03', '2023-09-15 02:25:03');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `slug`, `created_at`, `updated_at`) VALUES
(1, 'Administrator', 'super-admin', '2023-08-10 06:11:13', '2023-08-10 06:11:13'),
(2, 'Admin', 'admin', '2023-08-10 06:05:33', '2023-08-10 06:05:33'),
(3, 'Member', 'member', '2023-08-10 06:05:47', '2023-08-10 06:05:47');

-- --------------------------------------------------------

--
-- Table structure for table `role_permissions`
--

CREATE TABLE `role_permissions` (
  `role_id` bigint UNSIGNED NOT NULL,
  `permission_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_permissions`
--

INSERT INTO `role_permissions` (`role_id`, `permission_id`) VALUES
(1, 1),
(1, 2),
(1, 3),
(1, 4),
(1, 5),
(1, 6),
(1, 7),
(1, 8),
(1, 9),
(1, 10),
(1, 11),
(1, 12),
(1, 13),
(1, 14),
(1, 15),
(1, 16),
(1, 17),
(1, 18),
(1, 19),
(1, 20),
(1, 21),
(1, 22),
(1, 23),
(1, 24),
(1, 25),
(1, 26),
(1, 27),
(1, 28),
(1, 29),
(1, 30),
(1, 31),
(1, 32),
(1, 33),
(1, 34),
(1, 35),
(1, 36),
(1, 37),
(1, 38),
(1, 39),
(1, 40),
(1, 41),
(1, 42),
(1, 43),
(1, 44),
(1, 45),
(1, 46),
(1, 47),
(1, 48),
(1, 49),
(1, 50),
(1, 51),
(1, 52),
(1, 53),
(1, 54),
(1, 55),
(1, 56),
(1, 57),
(1, 58),
(1, 59),
(1, 60),
(1, 61),
(1, 62),
(1, 63),
(1, 64),
(1, 65),
(1, 66),
(1, 67),
(1, 68),
(1, 69),
(1, 70),
(1, 71),
(1, 72),
(1, 73),
(1, 74),
(1, 75),
(1, 76),
(1, 77),
(1, 78),
(1, 79),
(1, 80),
(1, 81),
(1, 82),
(1, 83),
(1, 84),
(1, 85),
(1, 86),
(1, 87),
(1, 88),
(1, 89),
(1, 90),
(1, 91),
(1, 92),
(1, 93),
(1, 94),
(1, 95),
(1, 96),
(1, 97),
(1, 98),
(1, 99),
(1, 100),
(1, 101),
(1, 102),
(1, 103),
(1, 104),
(1, 105),
(1, 106),
(1, 107),
(1, 108),
(1, 109),
(1, 110),
(1, 111),
(1, 112),
(1, 113),
(1, 114),
(1, 115),
(1, 116),
(1, 117),
(1, 118),
(1, 119),
(1, 120),
(1, 121),
(1, 122),
(1, 123),
(1, 124),
(1, 125),
(1, 126),
(1, 127),
(1, 128),
(1, 129),
(1, 130),
(1, 131),
(1, 132),
(1, 133),
(1, 134),
(1, 135),
(1, 136),
(1, 137),
(1, 138),
(1, 139),
(1, 140),
(1, 141),
(1, 142),
(1, 143),
(1, 144),
(1, 145),
(1, 146),
(1, 147),
(1, 148),
(1, 149),
(1, 150),
(1, 151),
(1, 152),
(1, 153),
(1, 154),
(1, 155),
(1, 156),
(1, 157),
(1, 158),
(1, 159),
(1, 160),
(1, 161),
(1, 162),
(1, 163),
(1, 164),
(1, 165),
(1, 166),
(1, 167),
(1, 168),
(1, 169),
(1, 170),
(1, 171),
(1, 172),
(1, 173),
(1, 174),
(1, 175),
(1, 176),
(1, 177),
(1, 178),
(1, 179),
(1, 180),
(1, 181),
(1, 182),
(1, 183),
(1, 184),
(1, 185),
(1, 186),
(1, 187),
(1, 188),
(1, 189),
(1, 190),
(1, 191);

-- --------------------------------------------------------

--
-- Table structure for table `subscribers`
--

CREATE TABLE `subscribers` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `operator_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `teams`
--

CREATE TABLE `teams` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `short_description` text COLLATE utf8mb4_unicode_ci,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `is_featured` tinyint(1) NOT NULL DEFAULT '1',
  `operator_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `teams`
--

INSERT INTO `teams` (`id`, `name`, `short_description`, `is_active`, `is_featured`, `operator_id`, `created_at`, `updated_at`) VALUES
(2, 'Rainbow Roofing', NULL, 1, 1, 1, '2023-08-10 06:11:41', '2023-08-10 06:11:41');

-- --------------------------------------------------------

--
-- Table structure for table `team_members`
--

CREATE TABLE `team_members` (
  `id` bigint UNSIGNED NOT NULL,
  `team_id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `operator_id` bigint UNSIGNED NOT NULL,
  `member_note` text COLLATE utf8mb4_unicode_ci,
  `team_designation` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `is_featured` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `team_members`
--

INSERT INTO `team_members` (`id`, `team_id`, `user_id`, `operator_id`, `member_note`, `team_designation`, `is_active`, `is_featured`, `created_at`, `updated_at`) VALUES
(2, 2, 2, 1, 'Your one stop shop for all Roofing Solutions, your trusted and reliable local roofing specialist! We take pride in providing top-notch roofing services for residential and commercial properties, ensuring that your roof remains strong, secure, and beautiful.\r\nAny query please email me at zia@rainbowroofing.nz', 'Director', 1, 1, '2023-08-10 06:12:47', '2023-08-11 18:36:00'),
(3, 2, 3, 1, 'He has worked in Singapore as a fabricator and welder . From 2018 to till now working here in NZ as a roofer.', 'Site Foreman', 1, 1, '2023-08-10 06:13:14', '2023-08-10 06:13:14'),
(4, 2, 4, 1, 'He has more than 10 years experience in construction and Roofing industry here in NZ and Singapore.', 'Site Foreman', 1, 1, '2023-08-10 06:13:44', '2023-08-10 06:13:44'),
(5, 2, 5, 1, 'He used work in construction sector in Singapore and since 2019 he started work in Roofing Industry here in NZ.', 'Site Foreman', 1, 1, '2023-08-10 06:14:02', '2023-08-10 06:14:02');

-- --------------------------------------------------------

--
-- Table structure for table `testimonials`
--

CREATE TABLE `testimonials` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `designation` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `message` text COLLATE utf8mb4_unicode_ci,
  `is_featured` tinyint(1) NOT NULL DEFAULT '0',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `operator_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tickets`
--

CREATE TABLE `tickets` (
  `id` bigint UNSIGNED NOT NULL,
  `org_id` bigint UNSIGNED DEFAULT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `full_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `assign_to_id` bigint UNSIGNED DEFAULT NULL,
  `subject` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attachment` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `department` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('1','2','3') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `priority` enum('1','2','3') COLLATE utf8mb4_unicode_ci NOT NULL,
  `operator_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ticket_assigns`
--

CREATE TABLE `ticket_assigns` (
  `id` bigint UNSIGNED NOT NULL,
  `ticket_id` bigint UNSIGNED NOT NULL,
  `assigned_by` bigint UNSIGNED NOT NULL,
  `assigned_by_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `assigned_to` bigint UNSIGNED NOT NULL,
  `assign_to_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notes` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ticket_replies`
--

CREATE TABLE `ticket_replies` (
  `id` bigint UNSIGNED NOT NULL,
  `ticket_id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `user_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_admin_reply` tinyint NOT NULL COMMENT '0 = Others, 1 = Admin reply',
  `comment` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attachment` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `f_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `m_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `l_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_type` enum('admin','committee','member') COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('1','2','3','4') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `login_access` tinyint(1) NOT NULL DEFAULT '0',
  `operator_id` bigint UNSIGNED DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `f_name`, `m_name`, `l_name`, `email`, `mobile`, `password`, `user_type`, `status`, `avatar`, `dob`, `login_access`, `operator_id`, `email_verified_at`, `remember_token`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'DW', NULL, 'Admin', 'dev@websolutionfirm.com', '+880 1700000000', '$2y$10$YGsG8jTRkfnIrvTL7fnP1.evm9mItXNCfy7B79mzHqwS8OJA.PmZO', 'admin', '2', NULL, '2000-02-02', 1, NULL, NULL, NULL, '2023-08-10 06:11:13', '2023-08-11 21:26:52', NULL),
(2, 'Mohammad', 'Ziaur', 'Rahman (Zia)', 'befytyf@mailinator.com', NULL, '$2y$10$aB1cm8dLojbARagibVFHDeQ9EuYd6qbBkF8.FZlr01OUIYG6WYT16', 'admin', '2', 'storage/user/profile/1691817422553.png', '2023-03-25', 0, 2, NULL, NULL, '2023-08-10 06:06:46', '2023-08-11 21:17:02', NULL),
(3, 'Md', 'Wasim', 'Sarder', 'lynoke@mailinator.com', NULL, '$2y$10$qihYYRGyVHlKXWr8Qr9Bq.0curBBLEAcGdK6/Bq1Hgo7YFYAItRG.', 'admin', '2', 'storage/user/profile/1691817446267.png', '1988-07-24', 0, 3, NULL, NULL, '2023-08-10 06:09:16', '2023-08-11 21:17:26', NULL),
(4, 'Sharif', NULL, 'Sarker', 'gudu@mailinator.com', NULL, '$2y$10$KiLZY7gDhWgvoSpFdh7d9.XiMggT.wISDJu6Za/flmAf7t0Pz.oRi', 'admin', '2', 'storage/user/profile/1691817581937.jpg', '1991-09-12', 0, 4, NULL, NULL, '2023-08-10 06:09:51', '2023-08-11 21:19:41', NULL),
(5, 'Mohammad', 'Saddam', 'Hossain', 'vyxufotuda@mailinator.com', NULL, '$2y$10$EdZ93cxajWIN79pz0E7EEeYhy8neumRKC/mgk8g41fQpe7pxyas6a', 'admin', '2', 'storage/user/profile/1691817598117.jpg', '1980-05-05', 0, 5, NULL, NULL, '2023-08-10 06:10:31', '2023-08-11 21:19:58', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_permissions`
--

CREATE TABLE `user_permissions` (
  `user_id` bigint UNSIGNED NOT NULL,
  `permission_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_permissions`
--

INSERT INTO `user_permissions` (`user_id`, `permission_id`) VALUES
(1, 1),
(1, 2),
(1, 3),
(1, 4),
(1, 5),
(1, 6),
(1, 7),
(1, 8),
(1, 9),
(1, 10),
(1, 11),
(1, 12),
(1, 13),
(1, 14),
(1, 15),
(1, 16),
(1, 17),
(1, 18),
(1, 19),
(1, 20),
(1, 21),
(1, 22),
(1, 23),
(1, 24),
(1, 25),
(1, 26),
(1, 27),
(1, 28),
(1, 29),
(1, 30),
(1, 31),
(1, 32),
(1, 33),
(1, 34),
(1, 35),
(1, 36),
(1, 37),
(1, 38),
(1, 39),
(1, 40),
(1, 41),
(1, 42),
(1, 43),
(1, 44),
(1, 45),
(1, 46),
(1, 47),
(1, 48),
(1, 49),
(1, 50),
(1, 51),
(1, 52),
(1, 53),
(1, 54),
(1, 55),
(1, 56),
(1, 57),
(1, 58),
(1, 59),
(1, 60),
(1, 61),
(1, 62),
(1, 63),
(1, 64),
(1, 65),
(1, 66),
(1, 67),
(1, 68),
(1, 69),
(1, 70),
(1, 71),
(1, 72),
(1, 73),
(1, 74),
(1, 75),
(1, 76),
(1, 77),
(1, 78),
(1, 79),
(1, 80),
(1, 81),
(1, 82),
(1, 83),
(1, 84),
(1, 85),
(1, 86),
(1, 87),
(1, 88),
(1, 89),
(1, 90),
(1, 91),
(1, 92),
(1, 93),
(1, 94),
(1, 95),
(1, 96),
(1, 97),
(1, 98),
(1, 99),
(1, 100),
(1, 101),
(1, 102),
(1, 103),
(1, 104),
(1, 105),
(1, 106),
(1, 107),
(1, 108),
(1, 109),
(1, 110),
(1, 111),
(1, 112),
(1, 113),
(1, 114),
(1, 115),
(1, 116),
(1, 117),
(1, 118),
(1, 119),
(1, 120),
(1, 121),
(1, 122),
(1, 123),
(1, 124),
(1, 125),
(1, 126),
(1, 127),
(1, 128),
(1, 129),
(1, 130),
(1, 131),
(1, 132),
(1, 133),
(1, 134),
(1, 135),
(1, 136),
(1, 137),
(1, 138),
(1, 139),
(1, 140),
(1, 141),
(1, 142),
(1, 143),
(1, 144),
(1, 145),
(1, 146),
(1, 147),
(1, 148),
(1, 149),
(1, 150),
(1, 151),
(1, 152),
(1, 153),
(1, 154),
(1, 155),
(1, 156),
(1, 157),
(1, 158),
(1, 159),
(1, 160),
(1, 161),
(1, 162),
(1, 163),
(1, 164),
(1, 165),
(1, 166),
(1, 167),
(1, 168),
(1, 169),
(1, 170),
(1, 171),
(1, 172),
(1, 173),
(1, 174),
(1, 175),
(1, 176),
(1, 177),
(1, 178),
(1, 179),
(1, 180),
(1, 181),
(1, 182),
(1, 183),
(1, 184),
(1, 185),
(1, 186),
(1, 187),
(1, 188),
(1, 189),
(1, 190),
(1, 191);

-- --------------------------------------------------------

--
-- Table structure for table `user_profiles`
--

CREATE TABLE `user_profiles` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Mr, Mrs, Others',
  `gender` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pro_noun` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'come from config',
  `address` text COLLATE utf8mb4_unicode_ci,
  `suburb` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `state` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `post_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `facebook_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `linkedin_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `instagram_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `twitter_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_profiles`
--

INSERT INTO `user_profiles` (`id`, `user_id`, `title`, `gender`, `pro_noun`, `address`, `suburb`, `city`, `state`, `post_code`, `country`, `facebook_url`, `linkedin_url`, `instagram_url`, `twitter_url`, `created_at`, `updated_at`) VALUES
(1, 1, 'Mr.', 'Male', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-08-10 06:11:13', '2023-08-10 06:11:13'),
(2, 2, 'Mrs.', 'Male', 'He', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-08-10 06:06:46', '2023-08-10 06:06:46'),
(3, 3, 'Mrs.', 'Others', 'He', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-08-10 06:09:16', '2023-08-10 06:09:16'),
(4, 4, 'Other', 'Others', 'Other', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-08-10 06:09:51', '2023-08-11 21:19:41'),
(5, 5, 'Other', 'Others', 'Other', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-08-10 06:10:31', '2023-08-10 06:19:01');

-- --------------------------------------------------------

--
-- Table structure for table `user_roles`
--

CREATE TABLE `user_roles` (
  `user_id` bigint UNSIGNED NOT NULL,
  `role_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_roles`
--

INSERT INTO `user_roles` (`user_id`, `role_id`) VALUES
(1, 1),
(2, 3),
(3, 3),
(4, 3),
(5, 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activity_logs`
--
ALTER TABLE `activity_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `activity_logs_action_by_foreign` (`action_by`);

--
-- Indexes for table `assets`
--
ALTER TABLE `assets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `asset_sales`
--
ALTER TABLE `asset_sales`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `careers`
--
ALTER TABLE `careers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `clubs`
--
ALTER TABLE `clubs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `clubs_operator_id_foreign` (`operator_id`);

--
-- Indexes for table `club_members`
--
ALTER TABLE `club_members`
  ADD PRIMARY KEY (`id`),
  ADD KEY `club_members_club_id_foreign` (`club_id`),
  ADD KEY `club_members_user_id_foreign` (`user_id`),
  ADD KEY `club_members_operator_id_foreign` (`operator_id`);

--
-- Indexes for table `committees`
--
ALTER TABLE `committees`
  ADD PRIMARY KEY (`id`),
  ADD KEY `committees_created_by_foreign` (`created_by`);

--
-- Indexes for table `committee_members`
--
ALTER TABLE `committee_members`
  ADD PRIMARY KEY (`id`),
  ADD KEY `committee_members_created_by_foreign` (`created_by`),
  ADD KEY `committee_members_role_id_foreign` (`role_id`);

--
-- Indexes for table `configs`
--
ALTER TABLE `configs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `configs_key_unique` (`key`);

--
-- Indexes for table `emails`
--
ALTER TABLE `emails`
  ADD PRIMARY KEY (`id`),
  ADD KEY `emails_operator_id_foreign` (`operator_id`);

--
-- Indexes for table `email_histories`
--
ALTER TABLE `email_histories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `email_recipients`
--
ALTER TABLE `email_recipients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `email_recipients_email_id_foreign` (`email_id`),
  ADD KEY `email_recipients_subscriber_id_foreign` (`subscriber_id`);

--
-- Indexes for table `email_templates`
--
ALTER TABLE `email_templates`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email_templates_key_unique` (`key`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
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
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `faqs`
--
ALTER TABLE `faqs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `faqs_operator_id_foreign` (`operator_id`);

--
-- Indexes for table `galleries`
--
ALTER TABLE `galleries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gallery_images`
--
ALTER TABLE `gallery_images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `login_histories`
--
ALTER TABLE `login_histories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `login_histories_user_id_foreign` (`user_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notices`
--
ALTER TABLE `notices`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_slug_unique` (`slug`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `posts_operator_id_foreign` (`operator_id`);

--
-- Indexes for table `pricing_plans`
--
ALTER TABLE `pricing_plans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `project_images`
--
ALTER TABLE `project_images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_slug_unique` (`slug`);

--
-- Indexes for table `role_permissions`
--
ALTER TABLE `role_permissions`
  ADD PRIMARY KEY (`role_id`,`permission_id`),
  ADD KEY `role_permissions_permission_id_foreign` (`permission_id`);

--
-- Indexes for table `subscribers`
--
ALTER TABLE `subscribers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `subscribers_email_unique` (`email`),
  ADD KEY `subscribers_operator_id_foreign` (`operator_id`);

--
-- Indexes for table `teams`
--
ALTER TABLE `teams`
  ADD PRIMARY KEY (`id`),
  ADD KEY `teams_operator_id_foreign` (`operator_id`);

--
-- Indexes for table `team_members`
--
ALTER TABLE `team_members`
  ADD PRIMARY KEY (`id`),
  ADD KEY `team_members_team_id_foreign` (`team_id`),
  ADD KEY `team_members_user_id_foreign` (`user_id`),
  ADD KEY `team_members_operator_id_foreign` (`operator_id`);

--
-- Indexes for table `testimonials`
--
ALTER TABLE `testimonials`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tickets`
--
ALTER TABLE `tickets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tickets_user_id_foreign` (`user_id`),
  ADD KEY `tickets_operator_id_foreign` (`operator_id`);

--
-- Indexes for table `ticket_assigns`
--
ALTER TABLE `ticket_assigns`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ticket_assigns_ticket_id_foreign` (`ticket_id`),
  ADD KEY `ticket_assigns_assigned_by_foreign` (`assigned_by`),
  ADD KEY `ticket_assigns_assigned_to_foreign` (`assigned_to`);

--
-- Indexes for table `ticket_replies`
--
ALTER TABLE `ticket_replies`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ticket_replies_ticket_id_foreign` (`ticket_id`),
  ADD KEY `ticket_replies_user_id_foreign` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `user_permissions`
--
ALTER TABLE `user_permissions`
  ADD PRIMARY KEY (`user_id`,`permission_id`),
  ADD KEY `user_permissions_permission_id_foreign` (`permission_id`);

--
-- Indexes for table `user_profiles`
--
ALTER TABLE `user_profiles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_roles`
--
ALTER TABLE `user_roles`
  ADD PRIMARY KEY (`user_id`,`role_id`),
  ADD KEY `user_roles_role_id_foreign` (`role_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activity_logs`
--
ALTER TABLE `activity_logs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `assets`
--
ALTER TABLE `assets`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `asset_sales`
--
ALTER TABLE `asset_sales`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `careers`
--
ALTER TABLE `careers`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `clubs`
--
ALTER TABLE `clubs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `club_members`
--
ALTER TABLE `club_members`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `committees`
--
ALTER TABLE `committees`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `committee_members`
--
ALTER TABLE `committee_members`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `configs`
--
ALTER TABLE `configs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `emails`
--
ALTER TABLE `emails`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `email_histories`
--
ALTER TABLE `email_histories`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `email_recipients`
--
ALTER TABLE `email_recipients`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `email_templates`
--
ALTER TABLE `email_templates`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `expenses`
--
ALTER TABLE `expenses`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `faqs`
--
ALTER TABLE `faqs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `galleries`
--
ALTER TABLE `galleries`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `gallery_images`
--
ALTER TABLE `gallery_images`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `login_histories`
--
ALTER TABLE `login_histories`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `notices`
--
ALTER TABLE `notices`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=192;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `pricing_plans`
--
ALTER TABLE `pricing_plans`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `project_images`
--
ALTER TABLE `project_images`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `subscribers`
--
ALTER TABLE `subscribers`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `teams`
--
ALTER TABLE `teams`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `team_members`
--
ALTER TABLE `team_members`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `testimonials`
--
ALTER TABLE `testimonials`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tickets`
--
ALTER TABLE `tickets`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ticket_assigns`
--
ALTER TABLE `ticket_assigns`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ticket_replies`
--
ALTER TABLE `ticket_replies`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user_profiles`
--
ALTER TABLE `user_profiles`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `activity_logs`
--
ALTER TABLE `activity_logs`
  ADD CONSTRAINT `activity_logs_action_by_foreign` FOREIGN KEY (`action_by`) REFERENCES `users` (`id`);

--
-- Constraints for table `clubs`
--
ALTER TABLE `clubs`
  ADD CONSTRAINT `clubs_operator_id_foreign` FOREIGN KEY (`operator_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `club_members`
--
ALTER TABLE `club_members`
  ADD CONSTRAINT `club_members_club_id_foreign` FOREIGN KEY (`club_id`) REFERENCES `clubs` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `club_members_operator_id_foreign` FOREIGN KEY (`operator_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `club_members_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `committees`
--
ALTER TABLE `committees`
  ADD CONSTRAINT `committees_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `committee_members`
--
ALTER TABLE `committee_members`
  ADD CONSTRAINT `committee_members_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `committee_members_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `emails`
--
ALTER TABLE `emails`
  ADD CONSTRAINT `emails_operator_id_foreign` FOREIGN KEY (`operator_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `email_recipients`
--
ALTER TABLE `email_recipients`
  ADD CONSTRAINT `email_recipients_email_id_foreign` FOREIGN KEY (`email_id`) REFERENCES `emails` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `email_recipients_subscriber_id_foreign` FOREIGN KEY (`subscriber_id`) REFERENCES `subscribers` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `faqs`
--
ALTER TABLE `faqs`
  ADD CONSTRAINT `faqs_operator_id_foreign` FOREIGN KEY (`operator_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `login_histories`
--
ALTER TABLE `login_histories`
  ADD CONSTRAINT `login_histories_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_operator_id_foreign` FOREIGN KEY (`operator_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `role_permissions`
--
ALTER TABLE `role_permissions`
  ADD CONSTRAINT `role_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `subscribers`
--
ALTER TABLE `subscribers`
  ADD CONSTRAINT `subscribers_operator_id_foreign` FOREIGN KEY (`operator_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `teams`
--
ALTER TABLE `teams`
  ADD CONSTRAINT `teams_operator_id_foreign` FOREIGN KEY (`operator_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `team_members`
--
ALTER TABLE `team_members`
  ADD CONSTRAINT `team_members_operator_id_foreign` FOREIGN KEY (`operator_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `team_members_team_id_foreign` FOREIGN KEY (`team_id`) REFERENCES `teams` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `team_members_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `tickets`
--
ALTER TABLE `tickets`
  ADD CONSTRAINT `tickets_operator_id_foreign` FOREIGN KEY (`operator_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `tickets_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `ticket_assigns`
--
ALTER TABLE `ticket_assigns`
  ADD CONSTRAINT `ticket_assigns_assigned_by_foreign` FOREIGN KEY (`assigned_by`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `ticket_assigns_assigned_to_foreign` FOREIGN KEY (`assigned_to`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `ticket_assigns_ticket_id_foreign` FOREIGN KEY (`ticket_id`) REFERENCES `tickets` (`id`);

--
-- Constraints for table `ticket_replies`
--
ALTER TABLE `ticket_replies`
  ADD CONSTRAINT `ticket_replies_ticket_id_foreign` FOREIGN KEY (`ticket_id`) REFERENCES `tickets` (`id`),
  ADD CONSTRAINT `ticket_replies_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `user_permissions`
--
ALTER TABLE `user_permissions`
  ADD CONSTRAINT `user_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `user_permissions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `user_roles`
--
ALTER TABLE `user_roles`
  ADD CONSTRAINT `user_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `user_roles_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
