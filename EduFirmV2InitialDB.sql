-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 04, 2020 at 07:55 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `test`
--

-- --------------------------------------------------------

--
-- Table structure for table `academic_infos`
--

CREATE TABLE `academic_infos` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` int(10) UNSIGNED NOT NULL,
  `last_updated_by` int(10) UNSIGNED DEFAULT NULL,
  `students_id` int(10) UNSIGNED NOT NULL,
  `institution` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `board` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pass_year` varchar(4) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `symbol_no` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `percentage` int(11) DEFAULT NULL,
  `division_grade` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `major_subjects` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remark` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sorting_order` int(10) UNSIGNED DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `account_categories`
--

CREATE TABLE `account_categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` int(10) UNSIGNED NOT NULL,
  `last_updated_by` int(10) UNSIGNED DEFAULT NULL,
  `ac_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ac_type` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dr` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cr` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `account_categories`
--

INSERT INTO `account_categories` (`id`, `created_at`, `updated_at`, `created_by`, `last_updated_by`, `ac_name`, `ac_type`, `dr`, `cr`, `status`) VALUES
(1, '2020-05-04 17:10:07', '2020-05-04 17:10:07', 1, NULL, 'ACCOUNTS PAYABLE', 'Liability', 'Decrease', 'Increase', 1),
(2, '2020-05-04 17:10:07', '2020-05-04 17:10:07', 1, NULL, 'ACCOUNTS RECEIVABLE', 'Asset', 'Increase', 'Decrease', 1),
(3, '2020-05-04 17:10:07', '2020-05-04 17:10:07', 1, NULL, 'ACCUMULATED DEPRECIATION', 'Contra Asset', 'Decrease', 'Increase', 1),
(4, '2020-05-04 17:10:07', '2020-05-04 17:10:07', 1, NULL, 'ADVERTISING EXPENSE', 'Expense', 'Increase', 'Decrease', 1),
(5, '2020-05-04 17:10:07', '2020-05-04 17:10:07', 1, NULL, 'ALLOWANCE FOR UNCOLLECTIBLE ACCOUNTS', 'Contra Asset', 'Decrease', 'Increase', 1),
(6, '2020-05-04 17:10:07', '2020-05-04 17:10:07', 1, NULL, 'AMORTIZATION EXPENSE', 'Expense', 'Increase', 'Decrease', 1),
(7, '2020-05-04 17:10:07', '2020-05-04 17:10:07', 1, NULL, 'AVAILABLE FOR SALE SECURITIES', 'Asset', 'Increase', 'Decrease', 1),
(8, '2020-05-04 17:10:07', '2020-05-04 17:10:07', 1, NULL, 'Bank Accounts', 'Asset', 'Increase', 'Decrease', 1),
(9, '2020-05-04 17:10:07', '2020-05-04 17:10:07', 1, NULL, 'Bank OD A/c', 'Liability', 'Decrease', 'Increase', 1),
(10, '2020-05-04 17:10:07', '2020-05-04 17:10:07', 1, NULL, 'BONDS PAYABLE', 'Liability', 'Decrease', 'Increase', 1),
(11, '2020-05-04 17:10:07', '2020-05-04 17:10:07', 1, NULL, 'BUILDING', 'Asset', 'Increase', 'Decrease', 1),
(12, '2020-05-04 17:10:07', '2020-05-04 17:10:07', 1, NULL, 'CAPITAL STOCK', 'Equity', 'Decrease', 'Increase', 1),
(13, '2020-05-04 17:10:07', '2020-05-04 17:10:07', 1, NULL, 'CASH', 'Asset', 'Increase', 'Decrease', 1),
(14, '2020-05-04 17:10:07', '2020-05-04 17:10:07', 1, NULL, 'CASH OVER', 'Revenue', 'Decrease', 'Increase', 1),
(15, '2020-05-04 17:10:07', '2020-05-04 17:10:07', 1, NULL, 'CASH SHORT', 'Expense', 'Increase', 'Decrease', 1),
(16, '2020-05-04 17:10:07', '2020-05-04 17:10:07', 1, NULL, 'CHARITABLE CONTRIBUTIONS PAYABLE', 'Liability', 'Decrease', 'Increase', 1),
(17, '2020-05-04 17:10:07', '2020-05-04 17:10:07', 1, NULL, 'COMMON STOCK', 'Equity', 'Decrease', 'Increase', 1),
(18, '2020-05-04 17:10:07', '2020-05-04 17:10:07', 1, NULL, 'COST OF GOODS SOLD', 'Expense', 'Increase', 'Decrease', 1),
(19, '2020-05-04 17:10:07', '2020-05-04 17:10:07', 1, NULL, 'CURRENCY EXCHANGE GAIN', 'Gain', 'Decrease', 'Increase', 1),
(20, '2020-05-04 17:10:07', '2020-05-04 17:10:07', 1, NULL, 'CURRENCY EXCHANGE LOSS', 'Loss', 'Increase', 'Decrease', 1),
(21, '2020-05-04 17:10:07', '2020-05-04 17:10:07', 1, NULL, 'DEPRECIATION EXPENSE', 'Expense', 'Increase', 'Decrease', 1),
(22, '2020-05-04 17:10:07', '2020-05-04 17:10:07', 1, NULL, 'DISCOUNT ON BONDS PAYABLE', 'Liability', 'Decrease', 'Increase', 1),
(23, '2020-05-04 17:10:07', '2020-05-04 17:10:07', 1, NULL, 'DISCOUNT ON NOTES PAYABLE', 'Contra Liability', 'Increase', 'Decrease', 1),
(24, '2020-05-04 17:10:07', '2020-05-04 17:10:07', 1, NULL, 'DIVIDEND INCOME', 'Revenue', 'Decrease', 'Increase', 1),
(25, '2020-05-04 17:10:07', '2020-05-04 17:10:07', 1, NULL, 'DIVIDENDS', 'Dividend', 'Increase', 'Decrease', 1),
(26, '2020-05-04 17:10:07', '2020-05-04 17:10:07', 1, NULL, 'DIVIDENDS PAYABLE', 'Liability', 'Decrease', 'Increase', 1),
(27, '2020-05-04 17:10:07', '2020-05-04 17:10:07', 1, NULL, 'DOMAIN NAME', 'Asset', 'Increase', 'Decrease', 1),
(28, '2020-05-04 17:10:07', '2020-05-04 17:10:07', 1, NULL, 'EMPLOYEE BENEFITS EXPENSE', 'Expense', 'Increase', 'Decrease', 1),
(29, '2020-05-04 17:10:07', '2020-05-04 17:10:07', 1, NULL, 'EQUIPMENT', 'Asset', 'Increase', 'Decrease', 1),
(30, '2020-05-04 17:10:07', '2020-05-04 17:10:07', 1, NULL, 'FEDERAL INCOME TAX PAYABLE', 'Liability', 'Decrease', 'Increase', 1),
(31, '2020-05-04 17:10:07', '2020-05-04 17:10:07', 1, NULL, 'FEDERAL UNEMPLOYMENT TAX PAYABLE', 'Liability', 'Decrease', 'Increase', 1),
(32, '2020-05-04 17:10:07', '2020-05-04 17:10:07', 1, NULL, 'FREIGHT-IN', 'Part of Calculation of Net Purchases', 'Increase', 'Decrease', 1),
(33, '2020-05-04 17:10:07', '2020-05-04 17:10:07', 1, NULL, 'FREIGHT-OUT', 'Expense', 'Increase', 'Decrease', 1),
(34, '2020-05-04 17:10:07', '2020-05-04 17:10:07', 1, NULL, 'FUEL EXPENSE', 'Expense', 'Increase', 'Decrease', 1),
(35, '2020-05-04 17:10:07', '2020-05-04 17:10:07', 1, NULL, 'GAIN', 'Gain', 'Decrease', 'Increase', 1),
(36, '2020-05-04 17:10:07', '2020-05-04 17:10:07', 1, NULL, 'HEALTH/CHILD FLEX PAYABLE', 'Liability', 'Decrease', 'Increase', 1),
(37, '2020-05-04 17:10:07', '2020-05-04 17:10:07', 1, NULL, 'INCOME SUMMARY', 'Not a Financial Statement Account', 'Debited for Total Expenses', 'Credited for Total Revenues', 1),
(38, '2020-05-04 17:10:07', '2020-05-04 17:10:07', 1, NULL, 'INSURANCE EXPENSE', 'Expense', 'Increase', 'Decrease', 1),
(39, '2020-05-04 17:10:07', '2020-05-04 17:10:07', 1, NULL, 'INSURANCE PAYABLE', 'Liability', 'Decrease', 'Increase', 1),
(40, '2020-05-04 17:10:07', '2020-05-04 17:10:07', 1, NULL, 'INTEREST EXPENSE', 'Expense', 'Increase', 'Decrease', 1),
(41, '2020-05-04 17:10:07', '2020-05-04 17:10:07', 1, NULL, 'INTEREST INCOME', 'Revenue', 'Decrease', 'Increase', 1),
(42, '2020-05-04 17:10:07', '2020-05-04 17:10:07', 1, NULL, 'INTEREST PAYABLE', 'Liability', 'Decrease', 'Increase', 1),
(43, '2020-05-04 17:10:07', '2020-05-04 17:10:07', 1, NULL, 'INTEREST RECEIVABLE', 'Asset', 'Increase', 'Decrease', 1),
(44, '2020-05-04 17:10:07', '2020-05-04 17:10:07', 1, NULL, 'INVENTORY', 'Asset', 'Increase', 'Decrease', 1),
(45, '2020-05-04 17:10:07', '2020-05-04 17:10:07', 1, NULL, 'INVESTMENT IN BONDS', 'Asset', 'Increase', 'Decrease', 1),
(46, '2020-05-04 17:10:07', '2020-05-04 17:10:07', 1, NULL, 'INVESTMENT INCOME', 'Revenue', 'Decrease', 'Increase', 1),
(47, '2020-05-04 17:10:07', '2020-05-04 17:10:07', 1, NULL, 'INVESTMENTS', 'Asset', 'Increase', 'Decrease', 1),
(48, '2020-05-04 17:10:07', '2020-05-04 17:10:07', 1, NULL, 'LAND', 'Asset', 'Increase', 'Decrease', 1),
(49, '2020-05-04 17:10:07', '2020-05-04 17:10:07', 1, NULL, 'LOAN PAYABLE', 'Liability', 'Decrease', 'Increase', 1),
(50, '2020-05-04 17:10:07', '2020-05-04 17:10:07', 1, NULL, 'LOAN & ADVANCE', 'Asset', 'Increase', 'Decrease', 1),
(51, '2020-05-04 17:10:07', '2020-05-04 17:10:07', 1, NULL, 'LOSS', 'Loss', 'Increase', 'Decrease', 1),
(52, '2020-05-04 17:10:07', '2020-05-04 17:10:07', 1, NULL, 'MEDICARE/MEDICAID PAYABLE', 'Liability', 'Decrease', 'Increase', 1),
(53, '2020-05-04 17:10:07', '2020-05-04 17:10:07', 1, NULL, 'MISCELLANEOUS EXPENSE', 'Expense', 'Increase', 'Decrease', 1),
(54, '2020-05-04 17:10:07', '2020-05-04 17:10:07', 1, NULL, 'NOTES PAYABLE', 'Liability', 'Decrease', 'Increase', 1),
(55, '2020-05-04 17:10:07', '2020-05-04 17:10:07', 1, NULL, 'NOTES RECEIVABLE', 'Asset', 'Increase', 'Decrease', 1),
(56, '2020-05-04 17:10:07', '2020-05-04 17:10:07', 1, NULL, 'OBLIGATION UNDER CAPITAL LEASE', 'Liability', 'Decrease', 'Increase', 1),
(57, '2020-05-04 17:10:07', '2020-05-04 17:10:07', 1, NULL, 'PAID-IN CAPITAL IN EXCESS OF PAR – COMMON', 'Equity', 'Decrease', 'Increase', 1),
(58, '2020-05-04 17:10:07', '2020-05-04 17:10:07', 1, NULL, 'PAID-IN CAPITAL IN EXCESS OF PAR – PREFERRED', 'Equity', 'Decrease', 'Increase', 1),
(59, '2020-05-04 17:10:07', '2020-05-04 17:10:07', 1, NULL, 'PATENT', 'Asset', 'Increase', 'Decrease', 1),
(60, '2020-05-04 17:10:07', '2020-05-04 17:10:07', 1, NULL, 'PAYROLL TAX EXPENSE', 'Expense', 'Increase', 'Decrease', 1),
(61, '2020-05-04 17:10:07', '2020-05-04 17:10:07', 1, NULL, 'PETTY CASH', 'Asset', 'Increase', 'Decrease', 1),
(62, '2020-05-04 17:10:07', '2020-05-04 17:10:07', 1, NULL, 'POSTAGE EXPENSE', 'Expense', 'Increase', 'Decrease', 1),
(63, '2020-05-04 17:10:07', '2020-05-04 17:10:07', 1, NULL, 'PREMIUM ON BONDS PAYABLE', 'Liability Adjunct Account', 'Decrease', 'Increase', 1),
(64, '2020-05-04 17:10:07', '2020-05-04 17:10:07', 1, NULL, 'PREPAID INSURANCE', 'Asset', 'Increase', 'Decrease', 1),
(65, '2020-05-04 17:10:07', '2020-05-04 17:10:07', 1, NULL, 'PREPAID RENT', 'Asset', 'Increase', 'Decrease', 1),
(66, '2020-05-04 17:10:07', '2020-05-04 17:10:07', 1, NULL, 'PURCHASE DISCOUNTS', 'Reduces Calculation of Net Purchases', 'Decrease', 'Increase', 1),
(67, '2020-05-04 17:10:07', '2020-05-04 17:10:07', 1, NULL, 'PURCHASE DISCOUNTS LOST', 'Expense', 'Increase', 'Decrease', 1),
(68, '2020-05-04 17:10:07', '2020-05-04 17:10:07', 1, NULL, 'PURCHASES', 'Part of Calculation of Net Purchases', 'Increase', 'Decrease', 1),
(69, '2020-05-04 17:10:07', '2020-05-04 17:10:07', 1, NULL, 'PURCHASE RETURNS', 'Reduces Calculation of Net Purchases', 'Decrease', 'Increase', 1),
(70, '2020-05-04 17:10:07', '2020-05-04 17:10:07', 1, NULL, 'RENT EXPENSE', 'Expense', 'Increase', 'Decrease', 1),
(71, '2020-05-04 17:10:07', '2020-05-04 17:10:07', 1, NULL, 'REPAIR EXPENSE', 'Expense', 'Increase', 'Decrease', 1),
(72, '2020-05-04 17:10:07', '2020-05-04 17:10:07', 1, NULL, 'RETAINED EARNINGS', 'Equity', 'Decrease', 'Increase', 1),
(73, '2020-05-04 17:10:07', '2020-05-04 17:10:07', 1, NULL, 'RETIREMENT CONTRIBUTION PAYABLE', 'Liability', 'Decrease', 'Increase', 1),
(74, '2020-05-04 17:10:07', '2020-05-04 17:10:07', 1, NULL, 'REVENUE', 'Revenue', 'Decrease', 'Increase', 1),
(75, '2020-05-04 17:10:07', '2020-05-04 17:10:07', 1, NULL, 'SALARIES EXPENSE', 'Expense', 'Increase', 'Decrease', 1),
(76, '2020-05-04 17:10:07', '2020-05-04 17:10:07', 1, NULL, 'SALARIES PAYABLE', 'Liability', 'Decrease', 'Increase', 1),
(77, '2020-05-04 17:10:07', '2020-05-04 17:10:07', 1, NULL, 'SALES', 'Revenue', 'Decrease', 'Increase', 1),
(78, '2020-05-04 17:10:07', '2020-05-04 17:10:07', 1, NULL, 'SALES DISCOUNTS', 'Contra Revenue', 'Increase', 'Decrease', 1),
(79, '2020-05-04 17:10:07', '2020-05-04 17:10:07', 1, NULL, 'SALES RETURNS', 'Contra Revenue', 'Increase', 'Decrease', 1),
(80, '2020-05-04 17:10:07', '2020-05-04 17:10:07', 1, NULL, 'SERVICE CHARGE', 'Expense', 'Increase', 'Decrease', 1),
(81, '2020-05-04 17:10:07', '2020-05-04 17:10:07', 1, NULL, 'SERVICE REVENUE', 'Revenue', 'Decrease', 'Increase', 1),
(82, '2020-05-04 17:10:07', '2020-05-04 17:10:07', 1, NULL, 'SOCIAL SECURITY PAYABLE', 'Liability', 'Decrease', 'Increase', 1),
(83, '2020-05-04 17:10:07', '2020-05-04 17:10:07', 1, NULL, 'STATE INCOME TAX PAYABLE', 'Liability', 'Decrease', 'Increase', 1),
(84, '2020-05-04 17:10:07', '2020-05-04 17:10:07', 1, NULL, 'STATE UNEMPLOYMENT TAX PAYABLE', 'Liability', 'Decrease', 'Increase', 1),
(85, '2020-05-04 17:10:07', '2020-05-04 17:10:07', 1, NULL, 'SUNDRY CREDITORS', 'Current liabilities', 'Decrease', 'Increase', 1),
(86, '2020-05-04 17:10:07', '2020-05-04 17:10:07', 1, NULL, 'SUNDRY DEBTORS', 'Current Assets', 'Increase', 'Decrease', 1),
(87, '2020-05-04 17:10:07', '2020-05-04 17:10:07', 1, NULL, 'SUPPLIES', 'Asset', 'Increase', 'Decrease', 1),
(88, '2020-05-04 17:10:07', '2020-05-04 17:10:07', 1, NULL, 'SUPPLIES EXPENSE', 'Expense', 'Increase', 'Decrease', 1),
(89, '2020-05-04 17:10:07', '2020-05-04 17:10:07', 1, NULL, 'TRADING SECURITIES', 'Asset', 'Increase', 'Decrease', 1),
(90, '2020-05-04 17:10:07', '2020-05-04 17:10:07', 1, NULL, 'TREASURY STOCK', 'Contra Equity', 'Increase', 'Decrease', 1),
(91, '2020-05-04 17:10:07', '2020-05-04 17:10:07', 1, NULL, 'UNCOLLECTIBLE ACCOUNTS EXPENSE', 'Expense', 'Increase', 'Decrease', 1),
(92, '2020-05-04 17:10:07', '2020-05-04 17:10:07', 1, NULL, 'UNEARNED REVENUE', 'Liability', 'Decrease', 'Increase', 1),
(93, '2020-05-04 17:10:07', '2020-05-04 17:10:07', 1, NULL, 'UNREALIZED GAIN', 'Gain', 'Decrease', 'Increase', 1),
(94, '2020-05-04 17:10:07', '2020-05-04 17:10:07', 1, NULL, 'UNREALIZED LOSS', 'Loss', 'Increase', 'Decrease', 1),
(95, '2020-05-04 17:10:07', '2020-05-04 17:10:07', 1, NULL, 'UNREALIZED GAIN – OTHER COMPREHENSIVE INCOME', 'Increase in Equity Via Other Comprehensive Income', 'Decrease', 'Increase', 1),
(96, '2020-05-04 17:10:07', '2020-05-04 17:10:07', 1, NULL, 'UNREALIZED LOSS – OTHER COMPREHENSIVE INCOME', 'Decrease in Equity Via Other Comprehensive Income', 'Increase', 'Decrease', 1),
(97, '2020-05-04 17:10:07', '2020-05-04 17:10:07', 1, NULL, 'UTILITIES EXPENSE', 'Expense', 'Increase', 'Decrease', 1),
(98, '2020-05-04 17:10:07', '2020-05-04 17:10:07', 1, NULL, 'WARRANTY EXPENSE', 'Expense', 'Increase', 'Decrease', 1),
(99, '2020-05-04 17:10:07', '2020-05-04 17:10:07', 1, NULL, 'WARRANTY LIABILITY', 'Liability', 'Decrease', 'Increase', 1);

-- --------------------------------------------------------

--
-- Table structure for table `addressinfos`
--

CREATE TABLE `addressinfos` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` int(10) UNSIGNED NOT NULL,
  `last_updated_by` int(10) UNSIGNED DEFAULT NULL,
  `students_id` int(10) UNSIGNED NOT NULL,
  `address` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `state` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `temp_address` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `temp_state` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `temp_country` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `home_phone` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile_1` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile_2` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `alert_settings`
--

CREATE TABLE `alert_settings` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` int(10) UNSIGNED NOT NULL,
  `last_updated_by` int(10) UNSIGNED DEFAULT NULL,
  `event` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sms` tinyint(1) NOT NULL DEFAULT 1,
  `email` tinyint(1) NOT NULL DEFAULT 1,
  `subject` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `template` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `alert_settings`
--

INSERT INTO `alert_settings` (`id`, `created_at`, `updated_at`, `created_by`, `last_updated_by`, `event`, `sms`, `email`, `subject`, `template`, `status`) VALUES
(1, '2020-05-04 17:10:05', '2020-05-04 17:10:05', 1, NULL, 'BirthdayWish', 0, 0, 'Wish Your Birthday Dear', 'Dear {{first_name}}, Sending you smiles for every moment of your special day…Have a wonderful time and a very happy birthday!', 1),
(2, '2020-05-04 17:10:05', '2020-05-04 17:10:05', 1, NULL, 'StudentRegistration', 0, 0, 'Registration Information', 'Dear {{first_name}}, you are successfully registered in our institution with RegNo.{{reg_no}}. Thank You.', 1),
(3, '2020-05-04 17:10:05', '2020-05-04 17:10:05', 1, NULL, 'StudentTransfer', 0, 0, 'Transfer Information', 'Dear {{first_name}}, We would like to inform you are successfully transferred to {{semester}}. Thank You.', 1),
(4, '2020-05-04 17:10:05', '2020-05-04 17:10:05', 1, NULL, 'FeeReceive', 0, 0, 'Fees Receive Information', 'Dear {{first_name}}, We would like to inform you we are successfully received {{amount}} on {{date}}. Thank you for the Deposit.', 1),
(5, '2020-05-04 17:10:05', '2020-05-04 17:10:05', 1, NULL, 'BalanceFees', 0, 0, 'Balance Fees Information', 'Dear {{first_name}}, you have {{due_amount}} balance fees. please deposit on time. For more info contact the Account Department.', 1),
(6, '2020-05-04 17:10:05', '2020-05-04 17:10:05', 1, NULL, 'SubjectAttendance', 0, 0, 'Student Subject Wise Attendance Information', 'Dear {{guardian_name}}, your child {{first_name}} was Absent in {{absent_status}} subjects attendance on {{date}}.', 1),
(7, '2020-05-04 17:10:05', '2020-05-04 17:10:05', 1, NULL, 'StudentAttendance', 0, 0, 'Student Attendance Information', 'Dear Guardian, This is to inform you that {{first_name}} is {{status}} on {{date}}.', 1),
(8, '2020-05-04 17:10:05', '2020-05-04 17:10:05', 1, NULL, 'StaffAttendance', 0, 0, 'Staff Attendance Information', 'Dear {{first_name}}, This is to inform you are {{status}} on {{date}}.', 1),
(9, '2020-05-04 17:10:05', '2020-05-04 17:10:05', 1, NULL, 'StaffAbsentNotification', 0, 0, 'Staff Absent Information', 'Dear Sir, This is to inform you following staffs are absent today. {{staffs_name}}', 1),
(10, '2020-05-04 17:10:05', '2020-05-04 17:10:05', 1, NULL, 'ExamScoreForGuardian', 0, 0, 'Exam Score Information', 'Dear Guardian, {{first_name}} has obtained the following marks in {{exam_mark_detail}}.', 1),
(11, '2020-05-04 17:10:05', '2020-05-04 17:10:05', 1, NULL, 'ExamScoreForStudent', 0, 0, 'Exam Score Information', 'Dear {{first_name}}, you have obtained following marks in {{exam_mark_detail}}.', 1),
(12, '2020-05-04 17:10:05', '2020-05-04 17:10:05', 1, NULL, 'LibraryRegistration', 0, 0, 'Library Registration Information', 'Dear {{first_name}}, Congratulation! You are successfully registered in our library.', 1),
(13, '2020-05-04 17:10:05', '2020-05-04 17:10:05', 1, NULL, 'LibraryReturnPeriodOver', 0, 0, 'Library Clearance Reminder', 'Dear {{first_name}}, We would like to inform you have some books return time period is over. So, please return as soon as possible.', 1),
(14, '2020-05-04 17:10:05', '2020-05-04 17:10:05', 1, NULL, 'HostelRegistration', 0, 0, 'Hostel Registration Information', 'Dear {{first_name}}, Congratulation! You are successfully registered in our hostel.', 1),
(15, '2020-05-04 17:10:05', '2020-05-04 17:10:05', 1, NULL, 'HostelShift', 0, 0, 'Hostel Shift Information', 'Dear {{first_name}}, Congratulation! You are successfully shifted in {{new_hostel}}.', 1),
(16, '2020-05-04 17:10:05', '2020-05-04 17:10:05', 1, NULL, 'HostelLeave', 0, 0, 'Hostel Leave Information', 'Dear {{first_name}}, You are successfully leaving from our hostel. Thank you.', 1),
(17, '2020-05-04 17:10:05', '2020-05-04 17:10:05', 1, NULL, 'HostelActive', 0, 0, 'Hostel Active Again Information', 'Dear {{first_name}}, You are successfully re-Activated for our hostel service in {{new_hostel}}.', 1),
(18, '2020-05-04 17:10:05', '2020-05-04 17:10:05', 1, NULL, 'TransportRegistration', 0, 0, 'Transport Service Registration Information', 'Dear {{first_name}}, You are successfully registered for our transport service in {{transport}}.', 1),
(19, '2020-05-04 17:10:05', '2020-05-04 17:10:05', 1, NULL, 'TransportShift', 0, 0, 'Transport Shift Information', 'Dear {{first_name}}, Congratulation! You are successfully shifted in {{transport}}.', 1),
(20, '2020-05-04 17:10:05', '2020-05-04 17:10:05', 1, NULL, 'TransportLeave', 0, 0, 'Transport Leave Information', 'Dear {{first_name}}, You are successfully deactivated for transport service. Thank you.', 1),
(21, '2020-05-04 17:10:05', '2020-05-04 17:10:05', 1, NULL, 'TransportActive', 0, 0, 'Transport Active Again Information', 'Dear {{first_name}}, You are successfully re-Activated for our transport service in {{transport}}.', 1),
(22, '2020-05-04 17:10:05', '2020-05-04 17:10:05', 1, NULL, 'CustomerRegistration', 0, 0, 'Customer Registration Information', 'Dear {name}, you are successfully registered in our CRM with RegNo.{reg_no}.', 1),
(23, '2020-05-04 17:10:05', '2020-05-04 17:10:05', 1, NULL, 'VendorRegistration', 0, 0, 'Vendor Registration Information', 'Dear {name}, you are successfully registered in our CRM with RegNo.{reg_no}.', 1);

-- --------------------------------------------------------

--
-- Table structure for table `assets`
--

CREATE TABLE `assets` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` int(10) UNSIGNED NOT NULL,
  `last_updated_by` int(10) UNSIGNED DEFAULT NULL,
  `title` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 0,
  `rate` int(11) NOT NULL DEFAULT 0,
  `status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `assignments`
--

CREATE TABLE `assignments` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` int(10) UNSIGNED NOT NULL,
  `last_updated_by` int(10) UNSIGNED DEFAULT NULL,
  `years_id` int(10) UNSIGNED NOT NULL,
  `semesters_id` int(10) UNSIGNED NOT NULL,
  `subjects_id` int(10) UNSIGNED NOT NULL,
  `publish_date` datetime NOT NULL,
  `end_date` datetime NOT NULL,
  `title` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `file` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `assignment_answers`
--

CREATE TABLE `assignment_answers` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` int(10) UNSIGNED NOT NULL,
  `last_updated_by` int(10) UNSIGNED DEFAULT NULL,
  `assignments_id` int(10) UNSIGNED NOT NULL,
  `students_id` int(10) UNSIGNED NOT NULL,
  `answer_text` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `file` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `approve_status` tinyint(1) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `attendances`
--

CREATE TABLE `attendances` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` int(10) UNSIGNED NOT NULL,
  `last_updated_by` int(10) UNSIGNED DEFAULT NULL,
  `attendees_type` int(11) NOT NULL,
  `link_id` int(10) UNSIGNED NOT NULL,
  `years_id` int(10) UNSIGNED NOT NULL,
  `months_id` int(10) UNSIGNED NOT NULL,
  `day_1` int(11) NOT NULL DEFAULT 0,
  `day_2` int(11) NOT NULL DEFAULT 0,
  `day_3` int(11) NOT NULL DEFAULT 0,
  `day_4` int(11) NOT NULL DEFAULT 0,
  `day_5` int(11) NOT NULL DEFAULT 0,
  `day_6` int(11) NOT NULL DEFAULT 0,
  `day_7` int(11) NOT NULL DEFAULT 0,
  `day_8` int(11) NOT NULL DEFAULT 0,
  `day_9` int(11) NOT NULL DEFAULT 0,
  `day_10` int(11) NOT NULL DEFAULT 0,
  `day_11` int(11) NOT NULL DEFAULT 0,
  `day_12` int(11) NOT NULL DEFAULT 0,
  `day_13` int(11) NOT NULL DEFAULT 0,
  `day_14` int(11) NOT NULL DEFAULT 0,
  `day_15` int(11) NOT NULL DEFAULT 0,
  `day_16` int(11) NOT NULL DEFAULT 0,
  `day_17` int(11) NOT NULL DEFAULT 0,
  `day_18` int(11) NOT NULL DEFAULT 0,
  `day_19` int(11) NOT NULL DEFAULT 0,
  `day_20` int(11) NOT NULL DEFAULT 0,
  `day_21` int(11) NOT NULL DEFAULT 0,
  `day_22` int(11) NOT NULL DEFAULT 0,
  `day_23` int(11) NOT NULL DEFAULT 0,
  `day_24` int(11) NOT NULL DEFAULT 0,
  `day_25` int(11) NOT NULL DEFAULT 0,
  `day_26` int(11) NOT NULL DEFAULT 0,
  `day_27` int(11) NOT NULL DEFAULT 0,
  `day_28` int(11) NOT NULL DEFAULT 0,
  `day_29` int(11) NOT NULL DEFAULT 0,
  `day_30` int(11) NOT NULL DEFAULT 0,
  `day_31` int(11) NOT NULL DEFAULT 0,
  `day_32` int(11) NOT NULL DEFAULT 0,
  `status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `attendance_certificates`
--

CREATE TABLE `attendance_certificates` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` int(10) UNSIGNED NOT NULL,
  `last_updated_by` int(10) UNSIGNED DEFAULT NULL,
  `students_id` int(10) UNSIGNED NOT NULL,
  `date_of_issue` date NOT NULL,
  `year_of_study` varchar(9) COLLATE utf8mb4_unicode_ci NOT NULL,
  `percentage_of_attendance` varchar(3) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ref_text` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `attendance_masters`
--

CREATE TABLE `attendance_masters` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` int(10) UNSIGNED NOT NULL,
  `last_updated_by` int(10) UNSIGNED DEFAULT NULL,
  `year` int(10) UNSIGNED NOT NULL,
  `month` int(10) UNSIGNED NOT NULL,
  `day_in_month` int(11) NOT NULL,
  `holiday` int(11) NOT NULL,
  `open` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `attendance_statuses`
--

CREATE TABLE `attendance_statuses` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` int(10) UNSIGNED NOT NULL,
  `last_updated_by` int(10) UNSIGNED DEFAULT NULL,
  `title` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_class` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `attendance_statuses`
--

INSERT INTO `attendance_statuses` (`id`, `created_at`, `updated_at`, `created_by`, `last_updated_by`, `title`, `display_class`, `status`) VALUES
(1, '2020-05-04 17:10:05', '2020-05-04 17:10:05', 1, NULL, 'PRESENT', 'btn-primary', 1),
(2, '2020-05-04 17:10:05', '2020-05-04 17:10:05', 1, NULL, 'ABSENT', 'btn-danger', 1),
(3, '2020-05-04 17:10:05', '2020-05-04 17:10:05', 1, NULL, 'LATE', 'btn-warning', 1),
(4, '2020-05-04 17:10:05', '2020-05-04 17:10:05', 1, NULL, 'LEAVE', 'btn-success', 1),
(5, '2020-05-04 17:10:05', '2020-05-04 17:10:05', 1, NULL, 'HOLIDAY', 'btn-info', 1);

-- --------------------------------------------------------

--
-- Table structure for table `audits`
--

CREATE TABLE `audits` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `event` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `auditable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `auditable_id` bigint(20) UNSIGNED NOT NULL,
  `old_values` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `new_values` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `url` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tags` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `banks`
--

CREATE TABLE `banks` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` int(10) UNSIGNED NOT NULL,
  `last_updated_by` int(10) UNSIGNED DEFAULT NULL,
  `bank_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ac_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ac_number` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `branch` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `bank_transactions`
--

CREATE TABLE `bank_transactions` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` int(10) UNSIGNED NOT NULL,
  `last_updated_by` int(10) UNSIGNED DEFAULT NULL,
  `banks_id` int(10) UNSIGNED NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deposit_id` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` datetime NOT NULL,
  `dr_amt` int(11) NOT NULL DEFAULT 0,
  `cr_amt` int(11) NOT NULL DEFAULT 0,
  `amount` int(11) NOT NULL DEFAULT 0,
  `status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `beds`
--

CREATE TABLE `beds` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` int(10) UNSIGNED NOT NULL,
  `last_updated_by` int(10) UNSIGNED DEFAULT NULL,
  `hostels_id` int(10) UNSIGNED NOT NULL,
  `rooms_id` int(10) UNSIGNED NOT NULL,
  `bed_number` int(11) NOT NULL,
  `bed_status` int(10) UNSIGNED NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `bed_statuses`
--

CREATE TABLE `bed_statuses` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` int(10) UNSIGNED NOT NULL,
  `last_updated_by` int(10) UNSIGNED DEFAULT NULL,
  `title` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_class` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bed_statuses`
--

INSERT INTO `bed_statuses` (`id`, `created_at`, `updated_at`, `created_by`, `last_updated_by`, `title`, `display_class`, `status`) VALUES
(1, '2020-05-04 17:10:05', '2020-05-04 17:10:05', 1, NULL, 'Available', 'btn-success', 1),
(2, '2020-05-04 17:10:05', '2020-05-04 17:10:05', 1, NULL, 'Occupied', 'btn-primary', 1),
(3, '2020-05-04 17:10:05', '2020-05-04 17:10:05', 1, NULL, 'Damage', 'btn-danger', 1),
(4, '2020-05-04 17:10:05', '2020-05-04 17:10:05', 1, NULL, 'UnderConstruction', 'btn-default', 1),
(5, '2020-05-04 17:10:05', '2020-05-04 17:10:05', 1, NULL, 'UnderMaintinance', 'btn-default', 1),
(6, '2020-05-04 17:10:05', '2020-05-04 17:10:05', 1, NULL, 'NeedMaintinance', 'btn-default', 1);

-- --------------------------------------------------------

--
-- Table structure for table `bonafide_certificates`
--

CREATE TABLE `bonafide_certificates` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` int(10) UNSIGNED NOT NULL,
  `last_updated_by` int(10) UNSIGNED DEFAULT NULL,
  `students_id` int(10) UNSIGNED NOT NULL,
  `date_of_issue` date NOT NULL,
  `course` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `period` varchar(9) COLLATE utf8mb4_unicode_ci NOT NULL,
  `character` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ref_text` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` int(10) UNSIGNED NOT NULL,
  `last_updated_by` int(10) UNSIGNED DEFAULT NULL,
  `book_masters_id` int(10) UNSIGNED NOT NULL,
  `book_code` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `book_status` int(10) UNSIGNED NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `book_categories`
--

CREATE TABLE `book_categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` int(10) UNSIGNED NOT NULL,
  `last_updated_by` int(10) UNSIGNED DEFAULT NULL,
  `title` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `book_issues`
--

CREATE TABLE `book_issues` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` int(10) UNSIGNED NOT NULL,
  `last_updated_by` int(10) UNSIGNED DEFAULT NULL,
  `member_id` int(10) UNSIGNED NOT NULL,
  `book_id` int(10) UNSIGNED NOT NULL,
  `issued_on` datetime NOT NULL,
  `due_date` datetime NOT NULL,
  `return_date` datetime DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `book_masters`
--

CREATE TABLE `book_masters` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` int(10) UNSIGNED NOT NULL,
  `last_updated_by` int(10) UNSIGNED DEFAULT NULL,
  `categories` int(10) UNSIGNED DEFAULT NULL,
  `isbn_number` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `code` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sub_title` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `language` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `editor` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `edition` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `edition_year` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `publisher` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `publish_year` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `series` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `author` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rack_location` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_pages` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `source` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `notes` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `book_requests`
--

CREATE TABLE `book_requests` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` int(10) UNSIGNED NOT NULL,
  `last_updated_by` int(10) UNSIGNED DEFAULT NULL,
  `book_masters_id` int(10) UNSIGNED NOT NULL,
  `member_id` int(10) UNSIGNED NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `book_statuses`
--

CREATE TABLE `book_statuses` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` int(10) UNSIGNED NOT NULL,
  `last_updated_by` int(10) UNSIGNED DEFAULT NULL,
  `title` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_class` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `book_statuses`
--

INSERT INTO `book_statuses` (`id`, `created_at`, `updated_at`, `created_by`, `last_updated_by`, `title`, `display_class`, `status`) VALUES
(1, '2020-05-04 17:10:05', '2020-05-04 17:10:05', 1, NULL, 'Available', 'btn-success', 1),
(2, '2020-05-04 17:10:05', '2020-05-04 17:10:05', 1, NULL, 'Issued', 'btn-primary', 1),
(3, '2020-05-04 17:10:05', '2020-05-04 17:10:05', 1, NULL, 'Damage', 'btn-danger', 1),
(4, '2020-05-04 17:10:05', '2020-05-04 17:10:05', 1, NULL, 'Lost', 'btn-default', 1);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` int(10) UNSIGNED NOT NULL,
  `last_updated_by` int(10) UNSIGNED DEFAULT NULL,
  `title` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `certificate_histories`
--

CREATE TABLE `certificate_histories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` int(10) UNSIGNED NOT NULL,
  `last_updated_by` int(10) UNSIGNED DEFAULT NULL,
  `students_id` int(10) UNSIGNED NOT NULL,
  `certificate` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `certificate_id` int(10) UNSIGNED NOT NULL,
  `history_type` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `ref_text` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `certificate_templates`
--

CREATE TABLE `certificate_templates` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` int(10) UNSIGNED NOT NULL,
  `last_updated_by` int(10) UNSIGNED DEFAULT NULL,
  `certificate` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `template` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `background_image` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `custom_css` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `student_photo` tinyint(1) NOT NULL DEFAULT 1,
  `background_status` tinyint(1) NOT NULL DEFAULT 0,
  `status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `certificate_templates`
--

INSERT INTO `certificate_templates` (`id`, `created_at`, `updated_at`, `created_by`, `last_updated_by`, `certificate`, `template`, `background_image`, `custom_css`, `student_photo`, `background_status`, `status`) VALUES
(1, '2020-05-04 17:10:07', '2020-05-04 17:10:07', 1, NULL, 'ATTENDANCE', '<table class=\"table table-bordered\"> <tbody> <tr> <td>01.</td> <td style=\"text-align: right; \">Name of Student :&nbsp;</td> <td width=\"50%\" style=\"text-align: left;\"><b>{{student_name}}</b><br></td> </tr> <tr> <td>02.</td> <td style=\"text-align: right; \">Reg. No.&nbsp;:&nbsp;</td> <td width=\"50%\" style=\"text-align: left;\"><span style=\"font-weight: 700;\">{{reg_no}}</span><br></td> </tr> <tr> <td>03.</td> <td style=\"text-align: right; \">University Reg. No.&nbsp;:&nbsp;</td> <td width=\"50%\" style=\"text-align: left;\"><span style=\"font-weight: 700;\">{{university_reg}}</span><br></td> </tr> <tr> <td>04.</td> <td style=\"text-align: right; \">Faculty/Level&nbsp;:&nbsp;</td> <td width=\"50%\" style=\"text-align: left;\"><span style=\"font-weight: 700;\">{{faculty}}</span><br></td> </tr><tr><td>05.</td><td style=\"text-align: right; \">Batch :&nbsp;<br></td><td width=\"50%\" style=\"text-align: left;\"><span style=\"font-weight: 700;\">{{batch}}</span><br></td></tr> <tr> <td>06.</td> <td style=\"text-align: right; \">Year of Study&nbsp;:&nbsp;</td> <td width=\"50%\" style=\"text-align: left;\"><span style=\"font-weight: 700;\">{{year_of_study}}</span><br></td> </tr> <tr> <td>07.</td> <td style=\"text-align: right; \">Percentage of Attendance Secured&nbsp;:&nbsp;</td> <td width=\"50%\" style=\"text-align: left;\"><b>{{percentage_of_attendance}}%</b><br></td> </tr> </tbody></table>', NULL, '.subpage{padding: 100px;}', 0, 0, 1),
(2, '2020-05-04 17:10:07', '2020-05-04 17:10:07', 1, NULL, 'TRANSFER', '<table class=\"table table-bordered\"> <tbody> <tr> <td style=\"text-align: right;\"><span style=\"text-align: right;\">TC No. :&nbsp;</span><br></td> <td style=\"text-align: left;\"><span style=\"font-weight: 700;\">{{tc_num}}</span><br></td> <td rowspan=\"5\">{{student_image}}</td> </tr> <tr> <td style=\"text-align: right; \"><span style=\"text-align: right;\">Faculty/Level :&nbsp;</span><br></td> <td style=\"text-align: left;\"><span style=\"font-weight: 700;\">{{faculty}}</span><br></td> </tr> <tr> <td style=\"text-align: right; \"><span style=\"text-align: right;\">Admission No./Reg.No. :</span><br></td> <td style=\"text-align: left;\"><span style=\"font-weight: 700;\">{{reg_no}}</span><br></td> </tr> <tr> <td style=\"text-align: right;\"><span style=\"text-align: right;\">University Reg. No. :</span><br></td> <td style=\"text-align: left;\"><b>{{university_reg}}</b><br></td> </tr><tr><td style=\"text-align: right;\">Batch. :<br></td><td style=\"text-align: left;\"><span style=\"font-weight: 700;\">{{batch}}</span><br></td></tr> </tbody></table><table class=\"table table-bordered\"> <tbody> <tr> <td>01.</td> <td style=\"text-align: right; \">Name of Student :&nbsp;</td> <td width=\"50%\" style=\"text-align: left;\"><b>{{student_name}}</b><br></td> </tr> <tr> <td>02.</td> <td style=\"text-align: right; \">Name of Father.&nbsp;:&nbsp;</td> <td width=\"50%\" style=\"text-align: left;\"><b>{{parents_name}}</b><br></td> </tr> <tr> <td>03.</td> <td style=\"text-align: right; \">Date of Birth :&nbsp;</td> <td width=\"50%\" style=\"text-align: left;\"><span style=\"font-weight: 700;\">{{date_of_birth}}</span><br></td> </tr> <tr> <td>04.</td> <td style=\"text-align: right; \">Gender :&nbsp;</td> <td width=\"50%\" style=\"text-align: left;\"><span style=\"font-weight: 700;\">{{gender}}</span><br></td> </tr> <tr> <td>05.</td> <td style=\"text-align: right; \">Nationality :&nbsp;</td> <td width=\"50%\" style=\"text-align: left;\"><span style=\"font-weight: 700;\">{{nationality}}</span><br></td> </tr> <tr> <td>06.</td> <td style=\"text-align: right; \">Religion :&nbsp;</td> <td width=\"50%\" style=\"text-align: left;\"><b>{{religion}}</b><br></td> </tr> <tr> <td>07.</td> <td style=\"text-align: right; \">Community &amp; Caste :&nbsp;</td> <td width=\"50%\" style=\"text-align: left;\"><span style=\"font-weight: 700;\">{{caste}}</span><br></td> </tr> <tr> <td>08.</td> <td style=\"text-align: right; \">Date of Admission :&nbsp;</td> <td width=\"50%\" style=\"text-align: left;\"><span style=\"font-weight: 700;\">{{reg_date}}</span><br></td> </tr> <tr> <td>09.</td> <td style=\"text-align: right; \">Date of Leaving :&nbsp;</td> <td width=\"50%\" style=\"text-align: left;\"><b>{{date_of_leaving}}</b><br></td> </tr> <tr> <td>10.</td> <td style=\"text-align: right;\">Class studied at the time of leaving :&nbsp;</td> <td width=\"50%\" style=\"text-align: left;\"><b>{{leaving_time_class}}</b><br></td> </tr> <tr> <td>11.</td> <td style=\"text-align: right; \">Whether qualified for promotion to higher class :&nbsp;</td> <td width=\"50%\" style=\"text-align: left;\"><b>{{qualified_to_promote}}</b><br></td> </tr> <tr> <td>12.</td> <td style=\"text-align: right; \">Whether the student has paid all Balance fees to the college :&nbsp;</td> <td width=\"50%\" style=\"text-align: left;\"><b>{{paid_fee_status}}</b><br></td> </tr> <tr> <td>13.</td> <td style=\"text-align: right; \">Conduct and Character :&nbsp;</td> <td width=\"50%\" style=\"text-align: left;\"><span style=\"font-weight: 700;\">{{character}}</span><br></td> </tr> </tbody></table>', NULL, '.subpage{padding: 100px;}', 0, 0, 1),
(3, '2020-05-04 17:10:07', '2020-05-04 17:10:07', 1, NULL, 'CHARACTER', '<p>This is to certify that&nbsp;<span style=\"color: rgb(57, 57, 57);\"><b>{{student_name}}</b></span>&nbsp;Son of&nbsp;<span style=\"color: rgb(57, 57, 57);\"><b>{{father_name}}</b> </span>&amp;&nbsp;<span style=\"color: rgb(57, 57, 57);\"><b>{{mother_name}}</b></span>, Permanent Address<b>&nbsp;<span style=\"color: rgb(57, 57, 57);\">{{address}}</span></b>, is known to me for about&nbsp;<span style=\"color: rgb(57, 57, 57);\"><b>{{year}}</b></span>&nbsp;years. He is a citizen of&nbsp;<span style=\"color: rgb(57, 57, 57);\"><b>{{country}}</b>&nbsp;</span>by birth.</p><p><br></p><p>To the best of my knowledge, he bears a <b>{{character}}</b> character and is not involved in such activities which are against the state freedom and peace. I wish all success and prosperity in his life.</p>', NULL, '.subpage{padding: 100px;}', 0, 0, 1),
(4, '2020-05-04 17:10:07', '2020-05-04 17:10:07', 1, NULL, 'BONAFIDE', 'This is to certify that <b>{{student_name}} </b>Reg No. <b>{{reg_no}}</b>   Son of <b>{{parents_name}}</b> is a bonafide student of this College in the <b>{{course}}</b> course during the period <b>{{period}}</b>. His/Her Date of Birth as per our School/College record is <b>{{date_of_birth}}</b>.His/Her Conduct and Character are <b>{{character}}</b>.', NULL, '.subpage{padding: 100px;}', 0, 0, 1),
(5, '2020-05-04 17:10:07', '2020-05-04 17:10:07', 1, NULL, 'COURSE COMPLETION', '<p>This is to certify that <b>{{student_name}}</b> Reg No. <b>{{reg_no}}</b>&nbsp; Son of <b>{{parents_name}} </b>has studied <b>{{course}}</b> in our college during the <b>{{period}}</b>. His/Her Date of Birth as per our School/College record is <b>{{date_of_birth}}</b>.His/Her Conduct and Character are <b>{{character}}</b> during the tenure of his studies.<br></p>', NULL, '.subpage{padding: 100px;}', 0, 0, 1),
(6, '2020-05-04 17:10:07', '2020-05-04 17:10:07', 1, NULL, 'GENERAL TEMPLATE', '<p style=\"text-align: center; \">REG.NO.:<b>{{reg_no}}</b>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;REG.DATE: <b>{{reg_date}}</b></p><p style=\"text-align: center; \"><b><br></b></p><p style=\"text-align: center; \">This is to certify that <b>{{student_name}}</b> son/daughter of <b>{{parents_name}}</b> Residing at <b>{{address}}</b> is bonafide Student of our school.</p><p style=\"text-align: center; \"><br></p><p style=\"text-align: center; \">He/She is /was very obedient, sincere and hardworking.</p><p style=\"text-align: center; \"><br></p><p style=\"text-align: center; \">He/She bears a good moral character. His/Her Date of Birth is <b>{{date_of_birth}}</b> and Place of Birth is <b>{{address}}</b>.<br></p>', NULL, '.subpage{padding: 100px;}', 1, 0, 1),
(7, '2020-05-04 17:10:07', '2020-05-04 17:10:07', 1, NULL, 'IDENTITY CARD', '<h5 style=\"text-align: center;\"><b>{{student_name}}</b></h5><h6 style=\"text-align: center; \"><b>{{faculty}}-</b><b>{{semester}}</b></h6><p></p><p><b>PARENT : {{parents_name}}</b></p><p></p><p><b>ADDRESS : {{address}}</b></p><p><b>CONTACT : {{guardian_mobile_1}}</b></p><p><b>VALID DATE : JAN 2019-  FEB 2020</b></p><p></p>', NULL, '.subpage{padding:83px 5px 5px;color:#000!important}.page-content{padding:8px 20px 24px}h5{font-size:14px;margin:2px auto}h6{font-size:12px;margin:2px auto}.student_image{border-radius:0;width:100px;height:auto;border:2px #438eb9 solid}p{margin:1px 0 0;font-size:10px;text-align:left!important}', 1, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `character_certificates`
--

CREATE TABLE `character_certificates` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` int(10) UNSIGNED NOT NULL,
  `last_updated_by` int(10) UNSIGNED DEFAULT NULL,
  `students_id` int(10) UNSIGNED NOT NULL,
  `date_of_issue` date NOT NULL,
  `cc_num` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `year` varchar(4) COLLATE utf8mb4_unicode_ci NOT NULL,
  `character` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ref_text` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `course_completion_certificates`
--

CREATE TABLE `course_completion_certificates` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` int(10) UNSIGNED NOT NULL,
  `last_updated_by` int(10) UNSIGNED DEFAULT NULL,
  `students_id` int(10) UNSIGNED NOT NULL,
  `date_of_issue` date NOT NULL,
  `course` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `period` varchar(9) COLLATE utf8mb4_unicode_ci NOT NULL,
  `character` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ref_text` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` int(10) UNSIGNED NOT NULL,
  `last_updated_by` int(10) UNSIGNED DEFAULT NULL,
  `reg_no` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tel` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile_1` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile_2` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `extra_info` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `customer_image` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `customer_status` int(10) UNSIGNED DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `customer_statuses`
--

CREATE TABLE `customer_statuses` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` int(10) UNSIGNED NOT NULL,
  `last_updated_by` int(10) UNSIGNED DEFAULT NULL,
  `title` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customer_statuses`
--

INSERT INTO `customer_statuses` (`id`, `created_at`, `updated_at`, `created_by`, `last_updated_by`, `title`, `status`) VALUES
(1, '2020-05-04 17:10:07', '2020-05-04 17:10:07', 1, 1, 'New Customer', 1),
(2, '2020-05-04 17:10:07', '2020-05-04 17:10:07', 1, 1, 'Annual Contract', 1),
(3, '2020-05-04 17:10:07', '2020-05-04 17:10:07', 1, 1, 'Office Contract', 1),
(4, '2020-05-04 17:10:07', '2020-05-04 17:10:07', 1, 1, 'Individual', 1),
(5, '2020-05-04 17:10:07', '2020-05-04 17:10:07', 1, 1, 'inquiry/Lead', 1);

-- --------------------------------------------------------

--
-- Table structure for table `days`
--

CREATE TABLE `days` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` int(10) UNSIGNED NOT NULL,
  `last_updated_by` int(10) UNSIGNED DEFAULT NULL,
  `title` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `days`
--

INSERT INTO `days` (`id`, `created_at`, `updated_at`, `created_by`, `last_updated_by`, `title`, `status`) VALUES
(1, '2020-05-04 17:10:05', '2020-05-04 17:10:05', 1, NULL, 'Sunday', 1),
(2, '2020-05-04 17:10:05', '2020-05-04 17:10:05', 1, NULL, 'Monday', 1),
(3, '2020-05-04 17:10:05', '2020-05-04 17:10:05', 1, NULL, 'Tuesday', 1),
(4, '2020-05-04 17:10:05', '2020-05-04 17:10:05', 1, NULL, 'Wednesday', 1),
(5, '2020-05-04 17:10:05', '2020-05-04 17:10:05', 1, NULL, 'Thursday', 1),
(6, '2020-05-04 17:10:05', '2020-05-04 17:10:05', 1, NULL, 'Friday', 1),
(7, '2020-05-04 17:10:05', '2020-05-04 17:10:05', 1, NULL, 'Saturday', 1);

-- --------------------------------------------------------

--
-- Table structure for table `documents`
--

CREATE TABLE `documents` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` int(10) UNSIGNED NOT NULL,
  `last_updated_by` int(10) UNSIGNED DEFAULT NULL,
  `member_type` varchar(8) COLLATE utf8mb4_unicode_ci NOT NULL,
  `member_id` int(10) UNSIGNED NOT NULL,
  `title` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `downloads`
--

CREATE TABLE `downloads` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` int(10) UNSIGNED NOT NULL,
  `last_updated_by` int(10) UNSIGNED DEFAULT NULL,
  `semesters_id` int(10) UNSIGNED DEFAULT NULL,
  `subjects_id` int(10) UNSIGNED DEFAULT NULL,
  `title` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `eating_times`
--

CREATE TABLE `eating_times` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` int(10) UNSIGNED NOT NULL,
  `last_updated_by` int(10) UNSIGNED DEFAULT NULL,
  `title` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `time` time DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `email_settings`
--

CREATE TABLE `email_settings` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` int(10) UNSIGNED NOT NULL,
  `last_updated_by` int(10) UNSIGNED DEFAULT NULL,
  `driver` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `host` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `port` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `encryption` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `exams`
--

CREATE TABLE `exams` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` int(10) UNSIGNED NOT NULL,
  `last_updated_by` int(10) UNSIGNED DEFAULT NULL,
  `title` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `exam_mark_ledgers`
--

CREATE TABLE `exam_mark_ledgers` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` int(10) UNSIGNED NOT NULL,
  `last_updated_by` int(10) UNSIGNED DEFAULT NULL,
  `exam_schedule_id` int(10) UNSIGNED NOT NULL,
  `students_id` int(10) UNSIGNED NOT NULL,
  `obtain_mark_theory` int(11) NOT NULL DEFAULT 0,
  `absent_theory` tinyint(1) NOT NULL DEFAULT 0,
  `obtain_mark_practical` int(11) NOT NULL DEFAULT 0,
  `absent_practical` tinyint(1) NOT NULL DEFAULT 0,
  `sorting_order` int(10) UNSIGNED NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `exam_schedules`
--

CREATE TABLE `exam_schedules` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` int(10) UNSIGNED NOT NULL,
  `last_updated_by` int(10) UNSIGNED DEFAULT NULL,
  `years_id` int(10) UNSIGNED NOT NULL,
  `months_id` int(10) UNSIGNED NOT NULL,
  `exams_id` int(10) UNSIGNED NOT NULL,
  `faculty_id` int(10) UNSIGNED NOT NULL,
  `semesters_id` int(10) UNSIGNED NOT NULL,
  `subjects_id` int(10) UNSIGNED NOT NULL,
  `date` datetime NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `full_mark_theory` int(11) NOT NULL DEFAULT 0,
  `pass_mark_theory` int(11) NOT NULL DEFAULT 0,
  `full_mark_practical` int(11) NOT NULL DEFAULT 0,
  `pass_mark_practical` int(11) NOT NULL DEFAULT 0,
  `sorting_order` int(10) UNSIGNED NOT NULL,
  `publish_status` tinyint(1) NOT NULL DEFAULT 0,
  `status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `faculties`
--

CREATE TABLE `faculties` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` int(10) UNSIGNED NOT NULL,
  `last_updated_by` int(10) UNSIGNED DEFAULT NULL,
  `faculty` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `faculty_code` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `faculty_semester`
--

CREATE TABLE `faculty_semester` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `faculty_id` int(10) UNSIGNED NOT NULL,
  `semester_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `fee_collections`
--

CREATE TABLE `fee_collections` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` int(10) UNSIGNED NOT NULL,
  `last_updated_by` int(10) UNSIGNED DEFAULT NULL,
  `students_id` int(10) UNSIGNED NOT NULL,
  `fee_masters_id` int(10) UNSIGNED NOT NULL,
  `date` datetime NOT NULL,
  `paid_amount` int(11) NOT NULL,
  `discount` int(11) DEFAULT NULL,
  `fine` int(11) DEFAULT NULL,
  `payment_mode` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `note` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `response` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `fee_heads`
--

CREATE TABLE `fee_heads` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` int(10) UNSIGNED NOT NULL,
  `last_updated_by` int(10) UNSIGNED DEFAULT NULL,
  `fee_head_title` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fee_head_amount` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `fee_masters`
--

CREATE TABLE `fee_masters` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` int(10) UNSIGNED NOT NULL,
  `last_updated_by` int(10) UNSIGNED DEFAULT NULL,
  `students_id` int(10) UNSIGNED NOT NULL,
  `semester` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fee_head` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fee_due_date` datetime NOT NULL,
  `fee_amount` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `food_categories`
--

CREATE TABLE `food_categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` int(10) UNSIGNED NOT NULL,
  `last_updated_by` int(10) UNSIGNED DEFAULT NULL,
  `title` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `food_items`
--

CREATE TABLE `food_items` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` int(10) UNSIGNED NOT NULL,
  `last_updated_by` int(10) UNSIGNED DEFAULT NULL,
  `foodCategories_id` int(10) UNSIGNED NOT NULL,
  `title` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` int(11) DEFAULT NULL,
  `image` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `food_item_food_schedule`
--

CREATE TABLE `food_item_food_schedule` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `food_schedule_id` int(10) UNSIGNED NOT NULL,
  `food_item_id` int(10) UNSIGNED NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `food_schedules`
--

CREATE TABLE `food_schedules` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` int(10) UNSIGNED NOT NULL,
  `last_updated_by` int(10) UNSIGNED DEFAULT NULL,
  `hostels_id` int(10) UNSIGNED NOT NULL,
  `days_id` int(10) UNSIGNED NOT NULL,
  `eating_times_id` int(10) UNSIGNED NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `general_settings`
--

CREATE TABLE `general_settings` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` int(10) UNSIGNED NOT NULL,
  `last_updated_by` int(10) UNSIGNED DEFAULT NULL,
  `institute` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `salogan` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `copyright` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `website` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `favicon` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `logo` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `print_header` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `print_footer` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `facebook` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `twitter` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `linkedIn` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `youtube` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `googlePlus` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `instagram` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `whatsApp` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `skype` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pinterest` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `wordpress` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `time_zones_id` int(10) UNSIGNED DEFAULT NULL,
  `quick_menu` tinyint(1) NOT NULL DEFAULT 1,
  `public_registration` tinyint(1) NOT NULL DEFAULT 1,
  `front_desk` tinyint(1) NOT NULL DEFAULT 1,
  `student_staff` tinyint(1) NOT NULL DEFAULT 1,
  `account` tinyint(1) NOT NULL DEFAULT 1,
  `inventory` tinyint(1) NOT NULL DEFAULT 1,
  `library` tinyint(1) NOT NULL DEFAULT 1,
  `attendance` tinyint(1) NOT NULL DEFAULT 1,
  `exam` tinyint(1) NOT NULL DEFAULT 1,
  `certificate` tinyint(1) NOT NULL DEFAULT 1,
  `hostel` tinyint(1) NOT NULL DEFAULT 1,
  `transport` tinyint(1) NOT NULL DEFAULT 1,
  `assignment` tinyint(1) NOT NULL DEFAULT 1,
  `upload_download` tinyint(1) NOT NULL DEFAULT 1,
  `meeting` tinyint(1) NOT NULL DEFAULT 1,
  `alert` tinyint(1) NOT NULL DEFAULT 1,
  `academic` tinyint(1) NOT NULL DEFAULT 1,
  `help` tinyint(1) NOT NULL DEFAULT 1,
  `status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `general_settings`
--

INSERT INTO `general_settings` (`id`, `created_at`, `updated_at`, `created_by`, `last_updated_by`, `institute`, `salogan`, `copyright`, `address`, `phone`, `email`, `website`, `favicon`, `logo`, `print_header`, `print_footer`, `facebook`, `twitter`, `linkedIn`, `youtube`, `googlePlus`, `instagram`, `whatsApp`, `skype`, `pinterest`, `wordpress`, `time_zones_id`, `quick_menu`, `public_registration`, `front_desk`, `student_staff`, `account`, `inventory`, `library`, `attendance`, `exam`, `certificate`, `hostel`, `transport`, `assignment`, `upload_download`, `meeting`, `alert`, `academic`, `help`, `status`) VALUES
(1, '2020-05-04 17:10:05', '2020-05-04 17:10:05', 1, 1, 'Unlimited EduFirm', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `grading_scales`
--

CREATE TABLE `grading_scales` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` int(10) UNSIGNED NOT NULL,
  `last_updated_by` int(10) UNSIGNED DEFAULT NULL,
  `gradingType_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(2) COLLATE utf8mb4_unicode_ci NOT NULL,
  `percentage_from` int(11) NOT NULL,
  `percentage_to` int(11) NOT NULL,
  `grade_point` int(11) DEFAULT NULL,
  `description` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `grading_types`
--

CREATE TABLE `grading_types` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` int(10) UNSIGNED NOT NULL,
  `last_updated_by` int(10) UNSIGNED DEFAULT NULL,
  `title` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `guardian_details`
--

CREATE TABLE `guardian_details` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` int(10) UNSIGNED NOT NULL,
  `last_updated_by` int(10) UNSIGNED DEFAULT NULL,
  `guardian_first_name` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guardian_middle_name` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `guardian_last_name` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guardian_eligibility` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `guardian_occupation` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `guardian_office` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `guardian_office_number` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `guardian_residence_number` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `guardian_mobile_1` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `guardian_mobile_2` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `guardian_email` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `guardian_relation` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guardian_address` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `guardian_image` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `hostels`
--

CREATE TABLE `hostels` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` int(10) UNSIGNED NOT NULL,
  `last_updated_by` int(10) UNSIGNED DEFAULT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact_detail` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `warden` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `warden_contact` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `hostel_meals`
--

CREATE TABLE `hostel_meals` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` int(10) UNSIGNED NOT NULL,
  `last_updated_by` int(10) UNSIGNED DEFAULT NULL,
  `hostels_id` int(10) UNSIGNED NOT NULL,
  `days_id` int(10) UNSIGNED NOT NULL,
  `foods_id` int(10) UNSIGNED NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `institutions`
--

CREATE TABLE `institutions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `library_circulations`
--

CREATE TABLE `library_circulations` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` int(10) UNSIGNED NOT NULL,
  `last_updated_by` int(10) UNSIGNED DEFAULT NULL,
  `user_type` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code_prefix` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `issue_limit_days` int(10) UNSIGNED DEFAULT NULL,
  `issue_limit_books` int(10) UNSIGNED DEFAULT NULL,
  `fine_per_day` int(10) UNSIGNED DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `library_circulations`
--

INSERT INTO `library_circulations` (`id`, `created_at`, `updated_at`, `created_by`, `last_updated_by`, `user_type`, `slug`, `code_prefix`, `issue_limit_days`, `issue_limit_books`, `fine_per_day`, `status`) VALUES
(1, '2020-05-04 17:10:05', '2020-05-04 17:10:05', 1, NULL, 'Student', 'student', 'STUDLIB', 7, 5, 5, 1),
(2, '2020-05-04 17:10:05', '2020-05-04 17:10:05', 1, NULL, 'Staff', 'staff', 'STALIB', 15, 5, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `library_members`
--

CREATE TABLE `library_members` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` int(10) UNSIGNED NOT NULL,
  `last_updated_by` int(10) UNSIGNED DEFAULT NULL,
  `user_type` int(10) UNSIGNED NOT NULL,
  `member_id` int(10) UNSIGNED NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `meetings`
--

CREATE TABLE `meetings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` int(10) UNSIGNED NOT NULL,
  `last_updated_by` int(10) UNSIGNED DEFAULT NULL,
  `semesters_id` int(10) UNSIGNED NOT NULL,
  `subjects_id` int(10) UNSIGNED NOT NULL,
  `meeting_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `topic` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `start_time` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `duration` int(11) NOT NULL,
  `timezone` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `start_url` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `join_url` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `history_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ref_text` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `meeting_settings`
--

CREATE TABLE `meeting_settings` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `identity` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `logo` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `link` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `config` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `meeting_settings`
--

INSERT INTO `meeting_settings` (`id`, `created_at`, `updated_at`, `identity`, `logo`, `link`, `config`, `status`) VALUES
(1, NULL, NULL, 'Zoom', 'zoom', 'https://zoom.us', '{\"Key\":\"\",\"Secret\":\"\",\"Email\":\"\"}', 1);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2017_10_04_100236_create_staff_designations_table', 1),
(4, '2017_10_05_003733_create_grading_types_table', 1),
(5, '2017_10_05_003849_create_grading_scales_table', 1),
(6, '2017_10_05_072329_create_staff_table', 1),
(7, '2017_10_06_085150_create_faculties_table', 1),
(8, '2017_10_06_085202_create_semesters_table', 1),
(9, '2017_10_09_094821_create_attendance_statuses_table', 1),
(10, '2017_10_10_083645_create_time_zones_table', 1),
(11, '2017_10_21_012144_create_bed_statuses_table', 1),
(12, '2017_10_27_010354_create_student_statuses_table', 1),
(13, '2017_10_28_060832_create_book_statuses_table', 1),
(14, '2017_10_29_074155_create_student_batches_table', 1),
(15, '2017_11_06_084909_create_customers_table', 1),
(16, '2017_11_06_084909_create_students_table', 1),
(17, '2017_11_06_085106_create_parent_details_table', 1),
(18, '2017_11_06_085135_create_guardian_details_table', 1),
(19, '2017_11_07_091332_create_faculty_semester_table', 1),
(20, '2017_11_11_120928_create_addressinfos_table', 1),
(21, '2017_11_17_011606_create_documents_table', 1),
(22, '2017_11_18_005300_create_notes_table', 1),
(23, '2017_11_19_055352_create_fee_heads_table', 1),
(24, '2017_11_20_012242_create_fee_masters_table', 1),
(25, '2017_11_21_035458_create_fee_collections_table', 1),
(26, '2017_11_26_014317_create_book_categories_table', 1),
(27, '2017_11_27_010354_create_customer_statuses_table', 1),
(28, '2017_11_27_094949_create_book_masters_table', 1),
(29, '2017_11_27_095001_create_books_table', 1),
(30, '2017_11_29_084116_create_library_circulations_table', 1),
(31, '2017_11_30_015025_create_library_members_table', 1),
(32, '2017_12_02_010529_create_book_issues_table', 1),
(33, '2017_12_06_005401_create_transaction_heads_table', 1),
(34, '2017_12_06_012542_create_transactions_table', 1),
(35, '2017_12_08_084025_create_payroll_heads_table', 1),
(36, '2017_12_08_090233_create_payroll_masters_table', 1),
(37, '2017_12_08_090813_create_salary_pays_table', 1),
(38, '2017_12_13_084859_create_years_table', 1),
(39, '2017_12_13_084925_create_months_table', 1),
(40, '2017_12_14_062342_create_attendance_masters_table', 1),
(41, '2017_12_14_063449_create_attendances_table', 1),
(42, '2018_02_15_104206_create_settings_table', 1),
(43, '2018_02_18_061426_create_sms_emails_table', 1),
(44, '2018_02_18_061538_create_notices_table', 1),
(45, '2018_03_02_003733_create_categories_table', 1),
(46, '2018_03_02_003849_create_sub_categories_table', 1),
(47, '2018_03_02_173947_create_subjects_table', 1),
(48, '2018_03_02_180148_create_semester_subject_table', 1),
(49, '2018_03_03_140508_create_exams_table', 1),
(50, '2018_03_03_140529_create_exam_schedules_table', 1),
(51, '2018_03_03_140543_create_exam_mark_ledgers_table', 1),
(52, '2018_03_09_155741_create_hostels_table', 1),
(53, '2018_03_10_002019_create_room_types_table', 1),
(54, '2018_03_18_233110_create_rooms_table', 1),
(55, '2018_03_20_175730_create_beds_table', 1),
(56, '2018_03_21_181903_create_residents_table', 1),
(57, '2018_03_21_190050_create_resident_histories_table', 1),
(58, '2018_03_26_233817_create_days_table', 1),
(59, '2018_03_27_045931_create_food_categories_table', 1),
(60, '2018_03_27_050051_create_food_items_table', 1),
(61, '2018_03_27_050835_create_hostel_meals_table', 1),
(62, '2018_03_27_223813_create_eating_times_table', 1),
(63, '2018_03_27_225950_create_food_schedules_table', 1),
(64, '2018_03_30_001832_create_food_item_food_schedule_table', 1),
(65, '2018_03_30_234754_create_routes_table', 1),
(66, '2018_03_30_234825_create_vehicles_table', 1),
(67, '2018_03_30_234840_create_route_vehicles_table', 1),
(68, '2018_03_31_000843_create_vehicle_staffs_table', 1),
(69, '2018_04_02_062605_create_general_settings_table', 1),
(70, '2018_04_03_054649_create_email_settings_table', 1),
(71, '2018_04_03_054651_create_meeting_settings_table', 1),
(72, '2018_04_03_054708_create_sms_settings_table', 1),
(73, '2018_04_03_055400_create_alert_settings_table', 1),
(74, '2018_04_29_234215_create_academic_infos_table', 1),
(75, '2018_05_22_001204_entrust_setup_tables', 1),
(76, '2018_05_28_101725_create_student_guardians_table', 1),
(77, '2018_05_30_141644_create_payment_settings_table', 1),
(78, '2018_06_04_091509_create_transport_users_table', 1),
(79, '2018_06_04_092336_create_transport_histories_table', 1),
(80, '2018_06_06_055405_create_assignments_table', 1),
(81, '2018_06_06_055442_create_assignment_answers_table', 1),
(82, '2018_06_06_055503_create_download_table', 1),
(83, '2019_01_18_065901_create_products_table', 1),
(84, '2019_01_29_032038_create_vendors_table', 1),
(85, '2019_01_29_042314_create_stocks_table', 1),
(86, '2019_01_29_042738_create_product_prices_table', 1),
(87, '2019_04_06_021557_create_payment_methods_table', 1),
(88, '2019_04_06_031653_create_banks_table', 1),
(89, '2019_04_06_031713_create_bank_transactions_table', 1),
(90, '2019_04_08_063125_create_account_categories_table', 1),
(91, '2019_04_11_090124_create_jobs_table', 1),
(92, '2019_05_04_152142_create_certificate_templates_table', 1),
(93, '2019_05_10_192213_create_subject_attendances_table', 1),
(94, '2019_07_08_064020_create_audits_table', 1),
(95, '2019_08_10_065318_create_attendance_certificates_table', 1),
(96, '2019_08_10_205022_create_certificate_histories_table', 1),
(97, '2019_08_12_081920_create_transfer_certificates_table', 1),
(98, '2019_08_14_070841_create_bonafide_certificates_table', 1),
(99, '2019_08_14_203420_create_course_completion_certificates_table', 1),
(100, '2019_10_08_205822_create_book_requests_table', 1),
(101, '2019_11_24_184741_create_assets_table', 1),
(102, '2019_11_24_184850_create_semester_assets_table', 1),
(103, '2020_01_16_223708_create_purchases_table', 1),
(104, '2020_01_16_223806_create_purchase_details_table', 1),
(105, '2020_01_16_223831_create_purchase_returns_table', 1),
(106, '2020_01_16_223855_create_sales_table', 1),
(107, '2020_01_16_223910_create_sales_details_table', 1),
(108, '2020_01_16_223928_create_sales_returns_table', 1),
(109, '2020_02_18_004730_create_postal_exchange_types_table', 1),
(110, '2020_02_19_011008_create_postal_exchanges_table', 1),
(111, '2020_02_20_073315_create_visitor_purposes_table', 1),
(112, '2020_02_20_073316_create_visitor_logs_table', 1),
(113, '2020_02_25_192332_create_online_payments_table', 1),
(114, '2020_04_12_165239_create_meetings_table', 1),
(115, '2020_04_21_115723_create_character_certificates_table', 1),
(116, '2020_04_27_084132_create_institutions_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `months`
--

CREATE TABLE `months` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` int(10) UNSIGNED NOT NULL,
  `last_updated_by` int(10) UNSIGNED DEFAULT NULL,
  `title` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `months`
--

INSERT INTO `months` (`id`, `created_at`, `updated_at`, `created_by`, `last_updated_by`, `title`, `status`) VALUES
(1, '2020-05-04 17:10:05', '2020-05-04 17:10:05', 1, NULL, 'January', 1),
(2, '2020-05-04 17:10:05', '2020-05-04 17:10:05', 1, NULL, 'February', 1),
(3, '2020-05-04 17:10:05', '2020-05-04 17:10:05', 1, NULL, 'March', 1),
(4, '2020-05-04 17:10:05', '2020-05-04 17:10:05', 1, NULL, 'April', 1),
(5, '2020-05-04 17:10:05', '2020-05-04 17:10:05', 1, NULL, 'May', 1),
(6, '2020-05-04 17:10:05', '2020-05-04 17:10:05', 1, NULL, 'June', 1),
(7, '2020-05-04 17:10:05', '2020-05-04 17:10:05', 1, NULL, 'July', 1),
(8, '2020-05-04 17:10:05', '2020-05-04 17:10:05', 1, NULL, 'August', 1),
(9, '2020-05-04 17:10:05', '2020-05-04 17:10:05', 1, NULL, 'September', 1),
(10, '2020-05-04 17:10:05', '2020-05-04 17:10:05', 1, NULL, 'October', 1),
(11, '2020-05-04 17:10:05', '2020-05-04 17:10:05', 1, NULL, 'November', 1),
(12, '2020-05-04 17:10:05', '2020-05-04 17:10:05', 1, NULL, 'December', 1);

-- --------------------------------------------------------

--
-- Table structure for table `notes`
--

CREATE TABLE `notes` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` int(10) UNSIGNED NOT NULL,
  `last_updated_by` int(10) UNSIGNED DEFAULT NULL,
  `member_type` varchar(8) COLLATE utf8mb4_unicode_ci NOT NULL,
  `member_id` int(10) UNSIGNED NOT NULL,
  `subject` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `note` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `notices`
--

CREATE TABLE `notices` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` int(10) UNSIGNED NOT NULL,
  `last_updated_by` int(10) UNSIGNED DEFAULT NULL,
  `title` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `publish_date` datetime NOT NULL,
  `end_date` datetime NOT NULL,
  `display_group` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `online_payments`
--

CREATE TABLE `online_payments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` int(10) UNSIGNED NOT NULL,
  `last_updated_by` int(10) UNSIGNED DEFAULT NULL,
  `students_id` int(10) UNSIGNED NOT NULL,
  `date` datetime NOT NULL,
  `amount` int(11) NOT NULL,
  `payment_gateway` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ref_no` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ref_text` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `note` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `parent_details`
--

CREATE TABLE `parent_details` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` int(10) UNSIGNED NOT NULL,
  `last_updated_by` int(10) UNSIGNED DEFAULT NULL,
  `students_id` int(10) UNSIGNED NOT NULL,
  `grandfather_first_name` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `grandfather_middle_name` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `grandfather_last_name` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `father_first_name` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `father_middle_name` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `father_last_name` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `father_eligibility` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `father_occupation` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `father_office` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `father_office_number` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `father_residence_number` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `father_mobile_1` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `father_mobile_2` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `father_email` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mother_first_name` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mother_middle_name` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mother_last_name` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mother_eligibility` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mother_occupation` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mother_office` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mother_office_number` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mother_residence_number` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mother_mobile_1` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mother_mobile_2` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mother_email` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `father_image` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mother_image` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payment_methods`
--

CREATE TABLE `payment_methods` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` int(10) UNSIGNED NOT NULL,
  `last_updated_by` int(10) UNSIGNED DEFAULT NULL,
  `title` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payment_methods`
--

INSERT INTO `payment_methods` (`id`, `created_at`, `updated_at`, `created_by`, `last_updated_by`, `title`, `status`) VALUES
(1, '2020-05-04 17:10:06', '2020-05-04 17:10:06', 1, 1, 'Cash', 1),
(2, '2020-05-04 17:10:06', '2020-05-04 17:10:06', 1, 1, 'Bank', 1),
(3, '2020-05-04 17:10:06', '2020-05-04 17:10:06', 1, 1, 'Online Payment', 1);

-- --------------------------------------------------------

--
-- Table structure for table `payment_settings`
--

CREATE TABLE `payment_settings` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `identity` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `logo` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `link` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `config` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payment_settings`
--

INSERT INTO `payment_settings` (`id`, `created_at`, `updated_at`, `identity`, `logo`, `link`, `config`, `status`) VALUES
(1, NULL, NULL, 'Stripe', 'stripe', 'https://stripe.com', '{\"Publishable_Key\":\"\",\"Secret_Key\":\"\"}', 0),
(2, NULL, NULL, 'Instamojo', 'instamojo', 'https://www.instamojo.com', '{\"API_KEY\":\"\",\"AUTH_TOKEN\":\"\"}', 0),
(3, NULL, NULL, 'PayUMoney', 'payumoney', 'https://www.payumoney.com', '{\"Merchant_Key\":\"\",\"Merchant_Salt\":\"\",\"Auth_Header\":\"\"}', 0),
(4, NULL, NULL, 'RozorPay', 'rozorpay', 'https://razorpay.com', '{\"Key\":\"\",\"Secret\":\"\"}', 0),
(5, NULL, NULL, 'PayStack', 'paystack', 'https://paystack.co', '{\"publicKey\":\"\",\"secretKey\":\"\",\"merchantEmail\":\"\"}', 0);

-- --------------------------------------------------------

--
-- Table structure for table `payroll_heads`
--

CREATE TABLE `payroll_heads` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` int(10) UNSIGNED NOT NULL,
  `last_updated_by` int(10) UNSIGNED DEFAULT NULL,
  `title` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payroll_masters`
--

CREATE TABLE `payroll_masters` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` int(10) UNSIGNED NOT NULL,
  `last_updated_by` int(10) UNSIGNED DEFAULT NULL,
  `staff_id` int(10) UNSIGNED NOT NULL,
  `tag_line` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payroll_head` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `due_date` datetime NOT NULL,
  `amount` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` int(10) UNSIGNED NOT NULL,
  `group` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `group_head` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `group`, `name`, `display_name`, `description`, `group_head`, `created_at`, `updated_at`) VALUES
(1, 'Super Admin Setup Permission', 'super-admin-index', 'Super Admin Setup Permission', 'Super Admin Setup Permission', 1, '2020-05-04 17:10:02', '2020-05-04 17:10:02'),
(2, 'Menu', 'expand-action-menu', 'Expand Nav Menu', 'Expand Nav Menu', 0, '2020-05-04 17:10:02', '2020-05-04 17:10:02'),
(3, 'Menu', 'admin-control', 'Admin Control', 'Admin Control Menu', 0, '2020-05-04 17:10:02', '2020-05-04 17:10:02'),
(4, 'Menu', 'dashboard', 'Dashboard', 'Dashboard Menu', 0, '2020-05-04 17:10:02', '2020-05-04 17:10:02'),
(5, 'Menu', 'front-office', 'Front Office', 'Front Office Menu', 0, '2020-05-04 17:10:02', '2020-05-04 17:10:02'),
(6, 'Menu', 'student-staff', 'Student-Staff', 'Student-Staff Menu', 0, '2020-05-04 17:10:02', '2020-05-04 17:10:02'),
(7, 'Menu', 'account', 'Account', 'Account Menu', 0, '2020-05-04 17:10:02', '2020-05-04 17:10:02'),
(8, 'Menu', 'inventory', 'Inventory', 'Inventory Menu', 0, '2020-05-04 17:10:02', '2020-05-04 17:10:02'),
(9, 'Menu', 'library', 'Library', 'Libaray Menu', 0, '2020-05-04 17:10:02', '2020-05-04 17:10:02'),
(10, 'Menu', 'attendance', 'Attendance', 'Attendance Menu', 0, '2020-05-04 17:10:02', '2020-05-04 17:10:02'),
(11, 'Menu', 'examination', 'Examination', 'Examination Menu', 0, '2020-05-04 17:10:02', '2020-05-04 17:10:02'),
(12, 'Menu', 'certificate', 'Certificate', 'Certificate Menu', 0, '2020-05-04 17:10:02', '2020-05-04 17:10:02'),
(13, 'Menu', 'hostel', 'Hostel', 'Hostel Menu', 0, '2020-05-04 17:10:02', '2020-05-04 17:10:02'),
(14, 'Menu', 'transport', 'Transport', 'Transport Menu', 0, '2020-05-04 17:10:02', '2020-05-04 17:10:02'),
(15, 'Menu', 'assignment', 'Assignment', 'Assignment Menu', 0, '2020-05-04 17:10:02', '2020-05-04 17:10:02'),
(16, 'Menu', 'download', 'Download', 'Download Menu', 0, '2020-05-04 17:10:02', '2020-05-04 17:10:02'),
(17, 'Menu', 'meeting', 'Meeting', 'Meeting Menu', 0, '2020-05-04 17:10:02', '2020-05-04 17:10:02'),
(18, 'Menu', 'report', 'Report', 'Report Menu', 0, '2020-05-04 17:10:02', '2020-05-04 17:10:02'),
(19, 'Menu', 'alert-center', 'Alert Center', 'Alert Center Menu', 0, '2020-05-04 17:10:02', '2020-05-04 17:10:02'),
(20, 'Menu', 'academic', 'Academic Setup', 'Academic Setup Menu', 0, '2020-05-04 17:10:02', '2020-05-04 17:10:02'),
(21, 'Menu', 'help', 'Help', 'Help Menu', 0, '2020-05-04 17:10:02', '2020-05-04 17:10:02'),
(22, 'Student Menu', 'student-dashboard', 'Dashboard', 'Dashboard Student Menu', 0, '2020-05-04 17:10:02', '2020-05-04 17:10:02'),
(23, 'Student Menu', 'student-profile', 'Profile', 'Profile Student Menu', 0, '2020-05-04 17:10:02', '2020-05-04 17:10:02'),
(24, 'Student Menu', 'student-profile-edit', 'Profile Edit', 'Profile Edit Student Menu', 0, '2020-05-04 17:10:02', '2020-05-04 17:10:02'),
(25, 'Student Menu', 'student-fees', 'Fees', 'Fees Student Menu', 0, '2020-05-04 17:10:02', '2020-05-04 17:10:02'),
(26, 'Student Menu', 'student-library', 'Library', 'Library Student Menu', 0, '2020-05-04 17:10:02', '2020-05-04 17:10:02'),
(27, 'Student Menu', 'student-attendance', 'Attendance', 'Attendance Student Menu', 0, '2020-05-04 17:10:02', '2020-05-04 17:10:02'),
(28, 'Student Menu', 'student-exam', 'Exam', 'Exam Student Menu', 0, '2020-05-04 17:10:02', '2020-05-04 17:10:02'),
(29, 'Student Menu', 'student-hostel', 'Hostel', 'Hostel Student Menu', 0, '2020-05-04 17:10:02', '2020-05-04 17:10:02'),
(30, 'Student Menu', 'student-transport', 'Transport', 'Transport Student Menu', 0, '2020-05-04 17:10:02', '2020-05-04 17:10:02'),
(31, 'Student Menu', 'student-course', 'Course', 'Course Student Menu', 0, '2020-05-04 17:10:02', '2020-05-04 17:10:02'),
(32, 'Student Menu', 'student-notice', 'Notice', 'Notice Student Menu', 0, '2020-05-04 17:10:02', '2020-05-04 17:10:02'),
(33, 'Student Menu', 'student-download', 'Download', 'Download Student Menu', 0, '2020-05-04 17:10:02', '2020-05-04 17:10:02'),
(34, 'Student Menu', 'student-assignment', 'Assignment', 'Assignment Student Menu', 0, '2020-05-04 17:10:02', '2020-05-04 17:10:02'),
(35, 'Student Menu', 'student-meeting', 'Meeting', 'Meeting Student Menu', 0, '2020-05-04 17:10:02', '2020-05-04 17:10:02'),
(36, 'Guardian Menu', 'guardian-dashboard', 'Dashboard', 'Dashboard Guardian Menu', 0, '2020-05-04 17:10:02', '2020-05-04 17:10:02'),
(37, 'Guardian Menu', 'guardian-profile-edit', 'Profile Edit', 'Profile Edit Guardian Menu', 0, '2020-05-04 17:10:02', '2020-05-04 17:10:02'),
(38, 'Guardian Menu', 'guardian-notice', 'Notice', 'Notice Guardian Menu', 0, '2020-05-04 17:10:02', '2020-05-04 17:10:02'),
(39, 'Guardian Menu', 'guardian-student-list', 'Student List', 'Student List Guardian Menu', 0, '2020-05-04 17:10:02', '2020-05-04 17:10:02'),
(40, 'Guardian Menu', 'guardian-student-profile', 'Student Profile', 'Student Profile Guardian Menu', 0, '2020-05-04 17:10:02', '2020-05-04 17:10:02'),
(41, 'Guardian Menu', 'guardian-student-fees', 'Fees', 'Fees Guardian Menu', 0, '2020-05-04 17:10:02', '2020-05-04 17:10:02'),
(42, 'Guardian Menu', 'guardian-student-library', 'Library', 'Library Guardian Menu', 0, '2020-05-04 17:10:02', '2020-05-04 17:10:02'),
(43, 'Guardian Menu', 'guardian-student-attendance', 'Attendance', 'Attendance Guardian Menu', 0, '2020-05-04 17:10:02', '2020-05-04 17:10:02'),
(44, 'Guardian Menu', 'guardian-student-hostel', 'Hostel', 'Hostel Guardian Menu', 0, '2020-05-04 17:10:02', '2020-05-04 17:10:02'),
(45, 'Guardian Menu', 'guardian-student-transport', 'Transport', 'Transport Guardian Menu', 0, '2020-05-04 17:10:02', '2020-05-04 17:10:02'),
(46, 'Guardian Menu', 'guardian-student-course', 'Course', 'Course Guardian Menu', 0, '2020-05-04 17:10:02', '2020-05-04 17:10:02'),
(47, 'Guardian Menu', 'guardian-student-download', 'Download', 'Download Guardian Menu', 0, '2020-05-04 17:10:02', '2020-05-04 17:10:02'),
(48, 'Guardian Menu', 'guardian-student-exam', 'Exam', 'Exam Guardian Menu', 0, '2020-05-04 17:10:02', '2020-05-04 17:10:02'),
(49, 'Guardian Menu', 'guardian-student-assignment', 'Assignment', 'Assignment Guardian Menu', 0, '2020-05-04 17:10:02', '2020-05-04 17:10:02'),
(50, 'Super Suit', 'super-suit', 'Super Suit', 'Super Suit', 0, '2020-05-04 17:10:02', '2020-05-04 17:10:02'),
(51, 'User Activity', 'user-activity-index', 'Index', 'User Activity Index', 0, '2020-05-04 17:10:02', '2020-05-04 17:10:02'),
(52, 'User Activity', 'user-activity-delete', 'Delete', 'Delete User Activity', 0, '2020-05-04 17:10:02', '2020-05-04 17:10:02'),
(53, 'User Activity', 'user-activity-bulk-action', 'Bulk(Active,InActive,Delete)', 'User Activity Bulk Action', 0, '2020-05-04 17:10:02', '2020-05-04 17:10:02'),
(54, 'Role', 'role-index', 'Index', 'Role Index', 0, '2020-05-04 17:10:02', '2020-05-04 17:10:02'),
(55, 'Role', 'role-add', 'Add', 'Role Add', 0, '2020-05-04 17:10:02', '2020-05-04 17:10:02'),
(56, 'Role', 'role-view', 'View', 'View Role', 0, '2020-05-04 17:10:02', '2020-05-04 17:10:02'),
(57, 'Role', 'role-edit', 'Edit', 'Edit Role', 0, '2020-05-04 17:10:02', '2020-05-04 17:10:02'),
(58, 'Role', 'role-delete', 'Delete', 'Delete Role', 0, '2020-05-04 17:10:02', '2020-05-04 17:10:02'),
(59, 'User', 'user-index', 'Index', 'User Index', 0, '2020-05-04 17:10:02', '2020-05-04 17:10:02'),
(60, 'User', 'user-add', 'Add', 'User Add', 0, '2020-05-04 17:10:02', '2020-05-04 17:10:02'),
(61, 'User', 'user-edit', 'Edit', 'Edit User', 0, '2020-05-04 17:10:02', '2020-05-04 17:10:02'),
(62, 'User', 'user-delete', 'Delete', 'Delete User', 0, '2020-05-04 17:10:02', '2020-05-04 17:10:02'),
(63, 'User', 'user-active', 'Active', 'Active User', 0, '2020-05-04 17:10:02', '2020-05-04 17:10:02'),
(64, 'User', 'user-in-active', 'In-Active', 'In-Active User', 0, '2020-05-04 17:10:02', '2020-05-04 17:10:02'),
(65, 'User', 'user-bulk-action', 'Bulk(Active,InActive,Delete)', 'User Bulk Action', 0, '2020-05-04 17:10:02', '2020-05-04 17:10:02'),
(66, 'General Setting', 'general-setting-index', 'Index', 'General Setting Index', 0, '2020-05-04 17:10:02', '2020-05-04 17:10:02'),
(67, 'General Setting', 'general-setting-add', 'Add', 'General Setting Add', 0, '2020-05-04 17:10:02', '2020-05-04 17:10:02'),
(68, 'General Setting', 'general-setting-edit', 'Edit', 'Edit General Setting', 0, '2020-05-04 17:10:02', '2020-05-04 17:10:02'),
(69, 'Alert Setting', 'alert-setting-index', 'Index', 'Alert Setting Index', 0, '2020-05-04 17:10:02', '2020-05-04 17:10:02'),
(70, 'Alert Setting', 'alert-setting-add', 'Add', 'Alert Setting Add', 0, '2020-05-04 17:10:02', '2020-05-04 17:10:02'),
(71, 'Alert Setting', 'alert-setting-edit', 'Edit', 'Edit Alert Setting', 0, '2020-05-04 17:10:02', '2020-05-04 17:10:02'),
(72, 'SMS Setting', 'sms-setting-index', 'Index', 'SMS Setting Index', 0, '2020-05-04 17:10:02', '2020-05-04 17:10:02'),
(73, 'SMS Setting', 'sms-setting-add', 'Add', 'SMS Setting Add', 0, '2020-05-04 17:10:02', '2020-05-04 17:10:02'),
(74, 'SMS Setting', 'sms-setting-edit', 'Edit', 'Edit SMS Setting', 0, '2020-05-04 17:10:02', '2020-05-04 17:10:02'),
(75, 'SMS Setting', 'sms-setting-active', 'Active', 'Active SMS', 0, '2020-05-04 17:10:02', '2020-05-04 17:10:02'),
(76, 'SMS Setting', 'sms-setting-in-active', 'In-Active', 'In-Active SMS', 0, '2020-05-04 17:10:02', '2020-05-04 17:10:02'),
(77, 'Email Setting', 'email-setting-index', 'Index', 'Email Setting Index', 0, '2020-05-04 17:10:02', '2020-05-04 17:10:02'),
(78, 'Email Setting', 'email-setting-add', 'Add', 'Email Setting Add', 0, '2020-05-04 17:10:02', '2020-05-04 17:10:02'),
(79, 'Email Setting', 'email-setting-edit', 'Edit', 'Edit Email Setting', 0, '2020-05-04 17:10:02', '2020-05-04 17:10:02'),
(80, 'Email Setting', 'email-setting-status-change', 'Status', 'Change Status', 0, '2020-05-04 17:10:02', '2020-05-04 17:10:02'),
(81, 'Payment Gateway Setting', 'payment-gateway-setting-index', 'Index', 'Payment Gateway Setting Index', 0, '2020-05-04 17:10:02', '2020-05-04 17:10:02'),
(82, 'Payment Gateway Setting', 'payment-gateway-setting-add', 'Add', 'Payment Gateway Setting Add', 0, '2020-05-04 17:10:02', '2020-05-04 17:10:02'),
(83, 'Payment Gateway Setting', 'payment-gateway-setting-edit', 'Edit', 'Edit Payment Gateway Setting', 0, '2020-05-04 17:10:02', '2020-05-04 17:10:02'),
(84, 'Payment Gateway Setting', 'payment-gateway-active', 'Active', 'Active Payment Gateway', 0, '2020-05-04 17:10:02', '2020-05-04 17:10:02'),
(85, 'Payment Gateway Setting', 'payment-gateway-in-active', 'In-Active', 'In-Active Payment Gateway', 0, '2020-05-04 17:10:02', '2020-05-04 17:10:02'),
(86, 'Meeting Setting', 'meeting-setting-index', 'Index', 'Meeting Setting Index', 0, '2020-05-04 17:10:02', '2020-05-04 17:10:02'),
(87, 'Meeting Setting', 'meeting-setting-add', 'Add', 'Meeting Setting Add', 0, '2020-05-04 17:10:02', '2020-05-04 17:10:02'),
(88, 'Meeting Setting', 'meeting-setting-edit', 'Edit', 'Edit Meeting Setting', 0, '2020-05-04 17:10:02', '2020-05-04 17:10:02'),
(89, 'Meeting Setting', 'meeting-setting-active', 'Active', 'Active SMS', 0, '2020-05-04 17:10:02', '2020-05-04 17:10:02'),
(90, 'Meeting Setting', 'meeting-setting-in-active', 'In-Active', 'In-Active SMS', 0, '2020-05-04 17:10:02', '2020-05-04 17:10:02'),
(91, 'Academic Management Permission', 'academic-index', 'Academic Permission', 'Academic Permission', 1, '2020-05-04 17:10:02', '2020-05-04 17:10:02'),
(92, 'Faculty', 'faculty-index', 'Index', 'Faculty Index', 0, '2020-05-04 17:10:02', '2020-05-04 17:10:02'),
(93, 'Faculty', 'faculty-add', 'Add', 'Faculty Add', 0, '2020-05-04 17:10:02', '2020-05-04 17:10:02'),
(94, 'Faculty', 'faculty-edit', 'Edit', 'Edit Faculty', 0, '2020-05-04 17:10:02', '2020-05-04 17:10:02'),
(95, 'Faculty', 'faculty-delete', 'Delete', 'Delete Faculty', 0, '2020-05-04 17:10:02', '2020-05-04 17:10:02'),
(96, 'Faculty', 'faculty-active', 'Active', 'Active Faculty', 0, '2020-05-04 17:10:02', '2020-05-04 17:10:02'),
(97, 'Faculty', 'faculty-in-active', 'In-Active', 'In-Active Faculty', 0, '2020-05-04 17:10:02', '2020-05-04 17:10:02'),
(98, 'Faculty', 'faculty-bulk-action', 'Bulk(Active,InActive,Delete)', 'Faculty Bulk Action', 0, '2020-05-04 17:10:02', '2020-05-04 17:10:02'),
(99, 'Semester', 'semester-index', 'Index', 'Semester Index', 0, '2020-05-04 17:10:02', '2020-05-04 17:10:02'),
(100, 'Semester', 'semester-add', 'Add', 'Semester Add', 0, '2020-05-04 17:10:02', '2020-05-04 17:10:02'),
(101, 'Semester', 'semester-edit', 'Edit', 'Edit Semester', 0, '2020-05-04 17:10:02', '2020-05-04 17:10:02'),
(102, 'Semester', 'semester-delete', 'Delete', 'Delete Semester', 0, '2020-05-04 17:10:02', '2020-05-04 17:10:02'),
(103, 'Semester', 'semester-active', 'Active', 'Active Semester', 0, '2020-05-04 17:10:02', '2020-05-04 17:10:02'),
(104, 'Semester', 'semester-in-active', 'In-Active', 'In-Active Semester', 0, '2020-05-04 17:10:02', '2020-05-04 17:10:02'),
(105, 'Semester', 'semester-bulk-action', 'Bulk(Active,InActive,Delete)', 'Semester Bulk Action', 0, '2020-05-04 17:10:02', '2020-05-04 17:10:02'),
(106, 'Student Batch', 'student-batch-index', 'Index', 'Student Batch Index', 0, '2020-05-04 17:10:02', '2020-05-04 17:10:02'),
(107, 'Student Batch', 'student-batch-add', 'Add', 'Student Batch Add', 0, '2020-05-04 17:10:02', '2020-05-04 17:10:02'),
(108, 'Student Batch', 'student-batch-edit', 'Edit', 'Edit Student Batch', 0, '2020-05-04 17:10:02', '2020-05-04 17:10:02'),
(109, 'Student Batch', 'student-batch-delete', 'Delete', 'Delete Student Batch', 0, '2020-05-04 17:10:02', '2020-05-04 17:10:02'),
(110, 'Student Batch', 'student-batch-active', 'Active', 'Active Student Batch', 0, '2020-05-04 17:10:02', '2020-05-04 17:10:02'),
(111, 'Student Batch', 'student-batch-in-active', 'In-Active', 'In-Active Student Batch', 0, '2020-05-04 17:10:02', '2020-05-04 17:10:02'),
(112, 'Student Batch', 'student-batch-bulk-action', 'Bulk(Active,InActive,Delete)', 'Student Status Bulk Action', 0, '2020-05-04 17:10:02', '2020-05-04 17:10:02'),
(113, 'Grading', 'grading-index', 'Index', 'Grading Index', 0, '2020-05-04 17:10:02', '2020-05-04 17:10:02'),
(114, 'Grading', 'grading-add', 'Add', 'Grading Add', 0, '2020-05-04 17:10:02', '2020-05-04 17:10:02'),
(115, 'Grading', 'grading-edit', 'Edit', 'Edit Grading', 0, '2020-05-04 17:10:02', '2020-05-04 17:10:02'),
(116, 'Grading', 'grading-delete', 'Delete', 'Delete Grading', 0, '2020-05-04 17:10:02', '2020-05-04 17:10:02'),
(117, 'Grading', 'grading-active', 'Active', 'Active Grading', 0, '2020-05-04 17:10:02', '2020-05-04 17:10:02'),
(118, 'Grading', 'grading-in-active', 'In-Active', 'In-Active Grading', 0, '2020-05-04 17:10:02', '2020-05-04 17:10:02'),
(119, 'Grading', 'grading-bulk-action', 'Bulk(Active,InActive,Delete)', 'Grading Bulk Action', 0, '2020-05-04 17:10:02', '2020-05-04 17:10:02'),
(120, 'Subject / Course', 'subject-index', 'Index', 'Subject / Course Index', 0, '2020-05-04 17:10:02', '2020-05-04 17:10:02'),
(121, 'Subject / Course', 'subject-add', 'Add', 'Subject / Course Add', 0, '2020-05-04 17:10:02', '2020-05-04 17:10:02'),
(122, 'Subject / Course', 'subject-edit', 'Edit', 'Edit Subject / Course', 0, '2020-05-04 17:10:02', '2020-05-04 17:10:02'),
(123, 'Subject / Course', 'subject-delete', 'Delete', 'Delete Subject / Course', 0, '2020-05-04 17:10:02', '2020-05-04 17:10:02'),
(124, 'Subject / Course', 'subject-active', 'Active', 'Active Subject / Course', 0, '2020-05-04 17:10:02', '2020-05-04 17:10:02'),
(125, 'Subject / Course', 'subject-in-active', 'In-Active', 'In-Active Subject / Course', 0, '2020-05-04 17:10:02', '2020-05-04 17:10:02'),
(126, 'Subject / Course', 'subject-bulk-action', 'Bulk(Active,InActive,Delete)', 'Subject / Course Bulk Action', 0, '2020-05-04 17:10:02', '2020-05-04 17:10:02'),
(127, 'Student Status', 'student-status-index', 'Index', 'Student Status Index', 0, '2020-05-04 17:10:02', '2020-05-04 17:10:02'),
(128, 'Student Status', 'student-status-add', 'Add', 'Student Status Add', 0, '2020-05-04 17:10:02', '2020-05-04 17:10:02'),
(129, 'Student Status', 'student-status-edit', 'Edit', 'Edit Student Status', 0, '2020-05-04 17:10:02', '2020-05-04 17:10:02'),
(130, 'Student Status', 'student-status-delete', 'Delete', 'Delete Student Status', 0, '2020-05-04 17:10:02', '2020-05-04 17:10:02'),
(131, 'Student Status', 'student-status-active', 'Active', 'Active Student Status', 0, '2020-05-04 17:10:02', '2020-05-04 17:10:02'),
(132, 'Student Status', 'student-status-in-active', 'In-Active', 'In-Active Student Status', 0, '2020-05-04 17:10:02', '2020-05-04 17:10:02'),
(133, 'Student Status', 'student-status-bulk-action', 'Bulk(Active,InActive,Delete)', 'Student Status Bulk Action', 0, '2020-05-04 17:10:02', '2020-05-04 17:10:02'),
(134, 'Book Status', 'book-status-index', 'Index', 'Book Status Index', 0, '2020-05-04 17:10:02', '2020-05-04 17:10:02'),
(135, 'Book Status', 'book-status-add', 'Add', 'Book Status Add', 0, '2020-05-04 17:10:02', '2020-05-04 17:10:02'),
(136, 'Book Status', 'book-status-edit', 'Edit', 'Edit Book Status', 0, '2020-05-04 17:10:02', '2020-05-04 17:10:02'),
(137, 'Book Status', 'book-status-delete', 'Delete', 'Delete Book Status', 0, '2020-05-04 17:10:02', '2020-05-04 17:10:02'),
(138, 'Book Status', 'book-status-active', 'Active', 'Active Book Status', 0, '2020-05-04 17:10:02', '2020-05-04 17:10:02'),
(139, 'Book Status', 'book-status-in-active', 'In-Active', 'In-Active Book Status', 0, '2020-05-04 17:10:02', '2020-05-04 17:10:02'),
(140, 'Book Status', 'book-status-bulk-action', 'Bulk(Active,InActive,Delete)', 'Book Status Bulk Action', 0, '2020-05-04 17:10:02', '2020-05-04 17:10:02'),
(141, 'Bed Status', 'bed-status-index', 'Index', 'Bed Status Index', 0, '2020-05-04 17:10:02', '2020-05-04 17:10:02'),
(142, 'Bed Status', 'bed-status-add', 'Add', 'Bed Status Add', 0, '2020-05-04 17:10:02', '2020-05-04 17:10:02'),
(143, 'Bed Status', 'bed-status-edit', 'Edit', 'Edit Bed Status', 0, '2020-05-04 17:10:02', '2020-05-04 17:10:02'),
(144, 'Bed Status', 'bed-status-delete', 'Delete', 'Delete Bed Status', 0, '2020-05-04 17:10:02', '2020-05-04 17:10:02'),
(145, 'Bed Status', 'bed-status-active', 'Active', 'Active Bed Status', 0, '2020-05-04 17:10:02', '2020-05-04 17:10:02'),
(146, 'Bed Status', 'bed-status-in-active', 'In-Active', 'In-Active Bed Status', 0, '2020-05-04 17:10:02', '2020-05-04 17:10:02'),
(147, 'Bed Status', 'bed-status-bulk-action', 'Bulk(Active,InActive,Delete)', 'Bed Status Bulk Action', 0, '2020-05-04 17:10:02', '2020-05-04 17:10:02'),
(148, 'Year', 'year-index', 'Index', 'Year Index', 0, '2020-05-04 17:10:02', '2020-05-04 17:10:02'),
(149, 'Year', 'year-add', 'Add', 'Year Add', 0, '2020-05-04 17:10:02', '2020-05-04 17:10:02'),
(150, 'Year', 'year-edit', 'Edit', 'Edit Year', 0, '2020-05-04 17:10:02', '2020-05-04 17:10:02'),
(151, 'Year', 'year-delete', 'Delete', 'Delete Year', 0, '2020-05-04 17:10:02', '2020-05-04 17:10:02'),
(152, 'Year', 'year-active', 'Active', 'Active Year', 0, '2020-05-04 17:10:02', '2020-05-04 17:10:02'),
(153, 'Year', 'year-in-active', 'In-Active', 'In-Active Year', 0, '2020-05-04 17:10:02', '2020-05-04 17:10:02'),
(154, 'Year', 'year-bulk-action', 'Bulk(Active,InActive,Delete)', 'Year Bulk Action', 0, '2020-05-04 17:10:02', '2020-05-04 17:10:02'),
(155, 'Year', 'year-active-status', 'Make Active', 'Year Make Active', 0, '2020-05-04 17:10:02', '2020-05-04 17:10:02'),
(156, 'Month', 'month-index', 'Index', 'Month Index', 0, '2020-05-04 17:10:02', '2020-05-04 17:10:02'),
(157, 'Month', 'month-add', 'Add', 'Month Add', 0, '2020-05-04 17:10:02', '2020-05-04 17:10:02'),
(158, 'Month', 'month-edit', 'Edit', 'Edit Month', 0, '2020-05-04 17:10:02', '2020-05-04 17:10:02'),
(159, 'Month', 'month-delete', 'Delete', 'Delete Month', 0, '2020-05-04 17:10:02', '2020-05-04 17:10:02'),
(160, 'Month', 'month-active', 'Active', 'Active Month', 0, '2020-05-04 17:10:02', '2020-05-04 17:10:02'),
(161, 'Month', 'month-in-active', 'In-Active', 'In-Active Month', 0, '2020-05-04 17:10:02', '2020-05-04 17:10:02'),
(162, 'Month', 'month-bulk-action', 'Bulk(Active,InActive,Delete)', 'Month Bulk Action', 0, '2020-05-04 17:10:02', '2020-05-04 17:10:02'),
(163, 'Day', 'day-index', 'Index', 'Day Index', 0, '2020-05-04 17:10:02', '2020-05-04 17:10:02'),
(164, 'Day', 'day-add', 'Add', 'Day Add', 0, '2020-05-04 17:10:02', '2020-05-04 17:10:02'),
(165, 'Day', 'day-edit', 'Edit', 'Edit Day', 0, '2020-05-04 17:10:02', '2020-05-04 17:10:02'),
(166, 'Day', 'day-delete', 'Delete', 'Delete Day', 0, '2020-05-04 17:10:02', '2020-05-04 17:10:02'),
(167, 'Day', 'day-active', 'Active', 'Active Day', 0, '2020-05-04 17:10:02', '2020-05-04 17:10:02'),
(168, 'Day', 'day-in-active', 'In-Active', 'In-Active Day', 0, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(169, 'Day', 'day-bulk-action', 'Bulk(Active,InActive,Delete)', 'Day Bulk Action', 0, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(170, 'Front Office Permission', 'front-office-index', 'Front Office Management', 'Front Office Management', 1, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(171, 'Postal Exchange', 'postal-exchange-index', 'Index', 'Postal Exchange Index', 0, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(172, 'Postal Exchange', 'postal-exchange-add', 'Add', 'Postal Exchange Add', 0, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(173, 'Postal Exchange', 'postal-exchange-edit', 'Edit', 'Edit Postal Exchange', 0, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(174, 'Postal Exchange', 'postal-exchange-delete', 'Delete', 'Delete Postal Exchange', 0, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(175, 'Postal Exchange', 'postal-exchange-bulk-action', 'Bulk(Active,InActive,Delete)', 'Postal Exchange Bulk Action', 0, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(176, 'Exchange Type', 'postal-exchange-type-index', 'Index', 'Exchange Type Index', 0, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(177, 'Exchange Type', 'postal-exchange-type-add', 'Add', 'Exchange Type Add', 0, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(178, 'Exchange Type', 'postal-exchange-type-edit', 'Edit', 'Edit Exchange Type', 0, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(179, 'Exchange Type', 'postal-exchange-type-active', 'Active', 'Active Exchange Type', 0, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(180, 'Exchange Type', 'postal-exchange-type-in-active', 'In-Active', 'In-Active Exchange Type', 0, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(181, 'Exchange Type', 'postal-exchange-type-delete', 'Delete', 'Delete Exchange Type', 0, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(182, 'Exchange Type', 'postal-exchange-type-bulk-action', 'Bulk(Active,InActive,Delete)', 'Exchange Type Bulk Action', 0, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(183, 'Visitor Log', 'visitor-index', 'Index', 'Visitor Log Index', 0, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(184, 'Visitor Log', 'visitor-add', 'Add', 'Visitor Log Add', 0, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(185, 'Visitor Log', 'visitor-edit', 'Edit', 'Edit Visitor Log', 0, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(186, 'Visitor Log', 'visitor-active', 'Active', 'Active Visitor Log', 0, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(187, 'Visitor Log', 'visitor-in-active', 'In-Active', 'In-Active Visitor Log', 0, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(188, 'Visitor Log', 'visitor-delete', 'Delete', 'Delete Visitor Log', 0, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(189, 'Visitor Log', 'visitor-bulk-action', 'Bulk(Active,InActive,Delete)', 'Visitor Log Bulk Action', 0, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(190, 'Visit Purpose', 'visitor-purpose-index', 'Index', 'Visit Purpose Index', 0, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(191, 'Visit Purpose', 'visitor-purpose-add', 'Add', 'Visit Purpose Add', 0, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(192, 'Visit Purpose', 'visitor-purpose-edit', 'Edit', 'Edit Visit Purpose', 0, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(193, 'Visit Purpose', 'visitor-purpose-active', 'Active', 'Active Visit Purpose', 0, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(194, 'Visit Purpose', 'visitor-purpose-in-active', 'In-Active', 'In-Active Visit Purpose', 0, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(195, 'Visit Purpose', 'visitor-purpose-delete', 'Delete', 'Delete Visit Purpose', 0, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(196, 'Visit Purpose', 'visitor-purpose-bulk-action', 'Bulk(Active,InActive,Delete)', 'Visit Purpose Bulk Action', 0, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(197, 'Student Management Permission', 'student-management-index', 'Student Management', 'Student Management', 1, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(198, 'Student', 'student-index', 'Index', 'Student Index', 0, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(199, 'Student', 'student-registration', 'Registration', 'Student Registration', 0, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(200, 'Student', 'student-view', 'View', 'View Student', 0, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(201, 'Student', 'student-edit', 'Edit', 'Edit Student', 0, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(202, 'Student', 'student-delete', 'Delete', 'Delete Student', 0, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(203, 'Student', 'student-active', 'Active', 'Active Student', 0, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(204, 'Student', 'student-in-active', 'In-Active', 'In-Active Student', 0, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(205, 'Student', 'student-bulk-action', 'Bulk(Active,InActive,Delete)', 'Student Bulk Action', 0, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(206, 'Student', 'student-delete-academic-info', 'Delete Academic Info', 'Student Delete Academic Info', 0, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(207, 'Student', 'student-transfer', 'Transfer', 'Transfer Student', 0, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(208, 'Student Document', 'student-document-index', 'Index', 'Student Document Index', 0, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(209, 'Student Document', 'student-document-add', 'Add', 'Student Document Add', 0, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(210, 'Student Document', 'student-document-edit', 'Edit', 'Edit Student Document', 0, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(211, 'Student Document', 'student-document-delete', 'Delete', 'Delete Student Document', 0, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(212, 'Student Document', 'student-document-active', 'Active', 'Active Student Document', 0, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(213, 'Student Document', 'student-document-in-active', 'In-Active', 'In-Active Student Document', 0, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(214, 'Student Document', 'student-document-bulk-action', 'Bulk(Active,InActive,Delete)', 'Student Document Bulk Action', 0, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(215, 'Student Note', 'student-note-index', 'Index', 'Student Note Index', 0, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(216, 'Student Note', 'student-note-add', 'Add', 'Student Note Add', 0, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(217, 'Student Note', 'student-note-edit', 'Edit', 'Edit Student Note', 0, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(218, 'Student Note', 'student-note-delete', 'Delete', 'Delete Student Note', 0, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(219, 'Student Note', 'student-note-active', 'Active', 'Active Student Note', 0, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(220, 'Student Note', 'student-note-in-active', 'In-Active', 'In-Active Student Note', 0, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(221, 'Student Note', 'student-note-bulk-action', 'Bulk(Active,InActive,Delete)', 'Student Note Bulk Action', 0, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(222, 'Report', 'student-report', 'Student', 'Student Report', 0, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(223, 'Guardian Management Permission', 'guardian-management-index', 'Guardian Management', 'Guardian Management', 1, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(224, 'Guardian', 'guardian-index', 'Index', 'Guardian Index', 0, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(225, 'Guardian', 'guardian-registration', 'Registration', 'Guardian Registration', 0, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(226, 'Guardian', 'guardian-view', 'View', 'View Guardian', 0, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(227, 'Guardian', 'guardian-edit', 'Edit', 'Edit Guardian', 0, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(228, 'Guardian', 'guardian-delete', 'Delete', 'Delete Guardian', 0, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(229, 'Guardian', 'guardian-active', 'Active', 'Active Guardian', 0, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(230, 'Guardian', 'guardian-in-active', 'In-Active', 'In-Active Guardian', 0, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(231, 'Guardian', 'guardian-bulk-action', 'Bulk(Active,InActive,Delete)', 'Guardian Bulk Action', 0, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(232, 'Guardian', 'guardian-link', 'Link Student', 'Guardian Link Student', 0, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(233, 'Guardian', 'guardian-unlink', 'UnLink Student', 'Guardian UnLink Student', 0, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(234, 'Staff Management Permission', 'staff-management-index', 'Staff Management', 'Staff Management', 1, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(235, 'Staff', 'staff-index', 'Index', 'Staff Index', 0, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(236, 'Staff', 'staff-add', 'Add', 'Staff Registration', 0, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(237, 'Staff', 'staff-view', 'View', 'View Staff', 0, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(238, 'Staff', 'staff-edit', 'Edit', 'Edit Staff', 0, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(239, 'Staff', 'staff-delete', 'Delete', 'Delete Staff', 0, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(240, 'Staff', 'staff-active', 'Active', 'Active Staff', 0, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(241, 'Staff', 'staff-in-active', 'In-Active', 'In-Active Staff', 0, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(242, 'Staff', 'staff-bulk-action', 'Bulk(Active,InActive,Delete)', 'Staff Bulk Action', 0, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(243, 'Staff Document', 'staff-document-index', 'Index', 'Staff Document Index', 0, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(244, 'Staff Document', 'staff-document-add', 'Add', 'Staff Document Add', 0, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(245, 'Staff Document', 'staff-document-edit', 'Edit', 'Edit Staff Document', 0, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(246, 'Staff Document', 'staff-document-delete', 'Delete', 'Delete Staff Document', 0, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(247, 'Staff Document', 'staff-document-active', 'Active', 'Active Staff Document', 0, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(248, 'Staff Document', 'staff-document-in-active', 'In-Active', 'In-Active Staff Document', 0, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(249, 'Staff Document', 'staff-document-bulk-action', 'Bulk(Active,InActive,Delete)', 'Staff Document Bulk Action', 0, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(250, 'Staff Note', 'staff-note-index', 'Index', 'Staff Note Index', 0, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(251, 'Staff Note', 'staff-note-add', 'Add', 'Staff Note Add', 0, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(252, 'Staff Note', 'staff-note-edit', 'Edit', 'Edit Staff Note', 0, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(253, 'Staff Note', 'staff-note-delete', 'Delete', 'Delete Staff Note', 0, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(254, 'Staff Note', 'staff-note-active', 'Active', 'Active Staff Note', 0, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(255, 'Staff Note', 'staff-note-in-active', 'In-Active', 'In-Active Staff Note', 0, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(256, 'Staff Note', 'staff-note-bulk-action', 'Bulk(Active,InActive,Delete)', 'Staff Note Bulk Action', 0, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(257, 'Staff Designation', 'staff-designation-index', 'Index', 'Staff Designation Index', 0, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(258, 'Staff Designation', 'staff-designation-add', 'Add', 'Staff Designation Add', 0, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(259, 'Staff Designation', 'staff-designation-edit', 'Edit', 'Edit Staff Designation', 0, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(260, 'Staff Designation', 'staff-designation-delete', 'Delete', 'Delete Staff Designation', 0, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(261, 'Staff Designation', 'staff-designation-active', 'Active', 'Active Staff Designation', 0, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(262, 'Staff Designation', 'staff-designation-in-active', 'In-Active', 'In-Active Staff Designation', 0, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(263, 'Staff Designation', 'staff-designation-bulk-action', 'Bulk(Active,InActive,Delete)', 'Staff Designation Bulk Action', 0, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(264, 'Report', 'staff-report', 'Staff', 'Staff Report', 0, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(265, 'Account Management Permission', 'account-management-index', 'Account Management', 'Account Management', 1, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(266, 'Fees', 'fees-index', 'Index', 'Student Fees Index', 0, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(267, 'Fees', 'fees-balance', 'Balance', 'Fees Balance', 0, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(268, 'Fees Head', 'fees-head-index', 'Index', 'Fees Head Index', 0, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(269, 'Fees Head', 'fees-head-add', 'Add', 'Fees Head Add', 0, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(270, 'Fees Head', 'fees-head-edit', 'Edit', 'Edit Fees Head', 0, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(271, 'Fees Head', 'fees-head-delete', 'Delete', 'Delete Fees Head', 0, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(272, 'Fees Head', 'fees-head-active', 'Active', 'Active Fees Head', 0, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(273, 'Fees Head', 'fees-head-in-active', 'In-Active', 'In-Active Fees Head', 0, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(274, 'Fees Head', 'fees-head-bulk-action', 'Bulk(Active,InActive,Delete)', 'Fees Head Bulk Action', 0, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(275, 'Fees Master', 'fees-master-index', 'Index', 'Fees Master Index', 0, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(276, 'Fees Master', 'fees-master-add', 'Add', 'Fees Master Add', 0, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(277, 'Fees Master', 'fees-master-edit', 'Edit', 'Edit Fees Master', 0, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(278, 'Fees Master', 'fees-master-delete', 'Delete', 'Delete Fees Master', 0, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(279, 'Fees Master', 'fees-master-active', 'Active', 'Active Fees Master', 0, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(280, 'Fees Master', 'fees-master-in-active', 'In-Active', 'In-Active Fees Master', 0, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(281, 'Fees Master', 'fees-master-bulk-action', 'Bulk(Active,InActive,Delete)', 'Fees Master Bulk Action', 0, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(282, 'Quick Fee Receive', 'fees-quick-receive-add', 'Collect', 'Quick Fee Receive Index', 0, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(283, 'Fees Collection', 'fees-collection-index', 'Index', 'Fees Collection Index', 0, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(284, 'Fees Collection', 'fees-collection-add', 'Add', 'Fees Collection Add', 0, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(285, 'Fees Collection', 'fees-collection-view', 'View', 'View Fees Collection', 0, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(286, 'Fees Collection', 'fees-collection-delete', 'Delete', 'Delete Fees Collection', 0, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(287, 'Online Fee Payment', 'fees-online-payment-pay', 'Pay', 'Pay Online Fee', 0, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(288, 'Online Fee Payment', 'fees-online-payment-index', 'Index', 'Index Online Fee Payment', 0, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(289, 'Online Fee Payment', 'fees-online-payment-view', 'View', 'View Online Fee Payment', 0, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(290, 'Online Fee Payment', 'fees-online-payment-verify', 'Verify', 'Verify Online Fee Payment', 0, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(291, 'Payroll', 'payroll-index', 'Index', 'Staff Payroll Index', 0, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(292, 'Payroll', 'payroll-balance', 'Balance', 'Payroll Balance', 0, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(293, 'Payroll Head', 'payroll-head-index', 'Index', 'Payroll Head Index', 0, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(294, 'Payroll Head', 'payroll-head-add', 'Add', 'Payroll Head Add', 0, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(295, 'Payroll Head', 'payroll-head-edit', 'Edit', 'Edit Payroll Head', 0, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(296, 'Payroll Head', 'payroll-head-delete', 'Delete', 'Delete Payroll Head', 0, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(297, 'Payroll Head', 'payroll-head-active', 'Active', 'Active Payroll Head', 0, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(298, 'Payroll Head', 'payroll-head-in-active', 'In-Active', 'In-Active Payroll Head', 0, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(299, 'Payroll Head', 'payroll-head-bulk-action', 'Bulk(Active,InActive,Delete)', 'Payroll Head Bulk Action', 0, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(300, 'Payroll Master', 'payroll-master-index', 'Index', 'Payroll Master Index', 0, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(301, 'Payroll Master', 'payroll-master-add', 'Add', 'Payroll Master Add', 0, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(302, 'Payroll Master', 'payroll-master-edit', 'Edit', 'Edit Payroll Master', 0, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(303, 'Payroll Master', 'payroll-master-delete', 'Delete', 'Delete Payroll Master', 0, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(304, 'Payroll Master', 'payroll-master-active', 'Active', 'Active Payroll Master', 0, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(305, 'Payroll Master', 'payroll-master-in-active', 'In-Active', 'In-Active Payroll Master', 0, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(306, 'Payroll Master', 'payroll-master-bulk-action', 'Bulk(Active,InActive,Delete)', 'Payroll Master Bulk Action', 0, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(307, 'Salary Pay', 'salary-payment-index', 'Index', 'Salary Pay Index', 0, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(308, 'Salary Pay', 'salary-payment-add', 'Add', 'Salary Pay Add', 0, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(309, 'Salary Pay', 'salary-payment-view', 'View', 'View Salary Pay', 0, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(310, 'Salary Pay', 'salary-payment-delete', 'Delete', 'Delete Salary Pay', 0, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(311, 'Account Group', 'account-group-index', 'Index', 'Account Group Index', 0, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(312, 'Account Group', 'account-group-add', 'Add', 'Account Group Add', 0, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(313, 'Account Group', 'account-group-edit', 'Edit', 'Edit Account Group', 0, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(314, 'Account Group', 'account-group-delete', 'Delete', 'Delete Account Group', 0, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(315, 'Account Group', 'account-group-active', 'Active', 'Active Account Group', 0, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(316, 'Account Group', 'account-group-in-active', 'In-Active', 'In-Active Account Group', 0, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(317, 'Account Group', 'account-group-bulk-action', 'Bulk(Active,InActive,Delete)', 'Account Group Bulk Action', 0, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(318, 'Account Group', 'account-group-chart-of-account', 'Chart of Account', 'Account Group Chart of Account', 0, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(319, 'Transaction Head', 'transaction-head-index', 'Index', 'Transaction Head Index', 0, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(320, 'Transaction Head', 'transaction-head-add', 'Add', 'Transaction Head Add', 0, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(321, 'Transaction Head', 'transaction-head-edit', 'Edit', 'Edit Transaction Head', 0, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(322, 'Transaction Head', 'transaction-head-delete', 'Delete', 'Delete Transaction Head', 0, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(323, 'Transaction Head', 'transaction-head-active', 'Active', 'Active Transaction Head', 0, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(324, 'Transaction Head', 'transaction-head-in-active', 'In-Active', 'In-Active Transaction Head', 0, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(325, 'Transaction Head', 'transaction-head-bulk-action', 'Bulk(Active,InActive,Delete)', 'Payroll Head Bulk Action', 0, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(326, 'Transaction', 'transaction-index', 'Index', 'Transaction Index', 0, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(327, 'Transaction', 'transaction-add', 'Add', 'Transaction Add', 0, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(328, 'Transaction', 'transaction-edit', 'Edit', 'Edit Transaction', 0, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(329, 'Transaction', 'transaction-delete', 'Delete', 'Delete Transaction', 0, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(330, 'Transaction', 'transaction-active', 'Active', 'Active Transaction', 0, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(331, 'Transaction', 'transaction-in-active', 'In-Active', 'In-Active Transaction', 0, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(332, 'Transaction', 'transaction-bulk-action', 'Bulk(Active,InActive,Delete)', 'Transaction Bulk Action', 0, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(333, 'Bank', 'bank-index', 'Index', 'Bank Index', 0, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(334, 'Bank', 'bank-add', 'Add', 'Bank Add', 0, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(335, 'Bank', 'bank-edit', 'Edit', 'Edit Bank', 0, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(336, 'Bank', 'bank-view', 'View', 'View Bank', 0, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(337, 'Bank', 'bank-delete', 'Delete', 'Delete Bank', 0, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(338, 'Bank', 'bank-active', 'Active', 'Active Bank', 0, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(339, 'Bank', 'bank-in-active', 'In-Active', 'In-Active Bank', 0, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(340, 'Bank', 'bank-bulk-action', 'Bulk(Active,InActive,Delete)', 'Bank Bulk Action', 0, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(341, 'Bank Transaction', 'bank-transaction-index', 'Index', 'Bank Transaction Index', 0, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(342, 'Bank Transaction', 'bank-transaction-add', 'Add', 'Bank Transaction Add', 0, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(343, 'Bank Transaction', 'bank-transaction-delete', 'Delete', 'Delete Bank Transaction', 0, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(344, 'Bank Transaction', 'bank-transaction-bulk-action', 'Bulk(Active,InActive,Delete)', 'Bank Transaction Bulk Action', 0, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(345, 'Account Print', 'fee-print-master', 'Master Slip', 'Fee Master Slip', 0, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(346, 'Account Print', 'fee-print-collection', 'Collection', 'Print Fee Collection', 0, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(347, 'Account Print', 'fee-print-today-receipt', 'Today Short Receipt', 'Print Today Short Receipt', 0, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(348, 'Account Print', 'fee-print-today-detail-receipt', 'Today Detail Receipt', 'Print Today Detail Receip', 0, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(349, 'Account Print', 'fee-print-student-ledger', 'Student Ledger', 'Print Student Ledger', 0, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(350, 'Account Print', 'fee-print-student-due', 'Due Short Slip', 'Print Due Short Slip', 0, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(351, 'Account Print', 'fee-print-student-due-detail', 'Due Detail Slip', 'Print Due Detail Slip', 0, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(352, 'Account Print', 'fee-print-bulk-due-slip', 'Bulk Due Short Slip', 'Print Bulk Due Short Slip', 0, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(353, 'Account Print', 'fee-print-bulk-due-detail-slip', 'Bulk Due Detail SLip', 'Print Bulk Due Detail SLip', 0, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(354, 'Account Report', 'report-cash-book', 'Cashbook', 'Cashbook Detail', 0, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(355, 'Account Report', 'report-fee-collection', 'Fee Collection', 'Fee Collection Detail', 0, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(356, 'Account Report', 'report-fee-collection-head', 'Fee Collection Head', 'Fee Collection Head Detail', 0, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(357, 'Account Report', 'report.fee-online-payment', 'Online Payment', 'Fee Online Payment', 0, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(358, 'Account Report', 'report.balance-fee', 'Fee Balance Statement', 'Fee Balance Statement', 0, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(359, 'Account Report', 'transaction-head-view', 'Statement of Ledger', 'View Transaction Head', 0, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(360, 'Account Report', 'transaction-head-balance-statement', 'Ledger Balance Statement', 'View Transaction Head', 0, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(361, 'Inventory Management Permission', 'inventory-index', 'Inventory Management', 'Inventory Management', 1, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(362, 'Assets', 'assets-index', 'Index', 'Assets Index', 0, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(363, 'Assets', 'assets-add', 'Add', 'Assets Add', 0, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(364, 'Assets', 'assets-edit', 'Edit', 'Edit Assets', 0, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(365, 'Assets', 'assets-view', 'View', 'View Assets', 0, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(366, 'Assets', 'assets-delete', 'Delete', 'Delete Assets', 0, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(367, 'Assets', 'assets-active', 'Active', 'Active Assets', 0, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(368, 'Assets', 'assets-in-active', 'In-Active', 'In-Active Assets', 0, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(369, 'Assets', 'assets-bulk-action', 'Bulk(Active,InActive,Delete)', 'Bank Bulk Action', 0, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(370, 'SemesterAssets', 'sem-assets-index', 'Index', 'SemesterAssets Index', 0, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(371, 'SemesterAssets', 'sem-assets-add', 'Add', 'SemesterAssets Add', 0, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(372, 'SemesterAssets', 'sem-assets-delete', 'Delete', 'Delete SemesterAssets', 0, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(373, 'Product', 'product-index', 'Index', 'Product Index', 0, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(374, 'Product', 'product-add', 'Add', 'Product Add', 0, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(375, 'Product', 'product-view', 'View', 'Product View', 0, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(376, 'Product', 'product-edit', 'Edit', 'Edit Product', 0, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(377, 'Product', 'product-delete', 'Delete', 'Delete Product', 0, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(378, 'Product', 'product-active', 'Active', 'Active Product', 0, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(379, 'Product', 'product-in-active', 'In-Active', 'In-Active Product', 0, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(380, 'Product', 'product-bulk-action', 'Bulk(Active,InActive,Delete)', 'Product Bulk Action', 0, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(381, 'Product Category', 'product-category-index', 'Index', 'Product Category Index', 0, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(382, 'Product Category', 'product-category-add', 'Add', 'Product Category Add', 0, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(383, 'Product Category', 'product-category-edit', 'Edit', 'Edit Product Category', 0, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(384, 'Product Category', 'product-category-delete', 'Delete', 'Delete Product Category', 0, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(385, 'Product Category', 'product-category-active', 'Active', 'Active Product Category', 0, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(386, 'Product Category', 'product-category-in-active', 'In-Active', 'In-Active Product Category', 0, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(387, 'Product Category', 'product-category-bulk-action', 'Bulk(Active,InActive,Delete)', 'Product Category Bulk Action', 0, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(388, 'Customer', 'customer-index', 'Index', 'Customer Index', 0, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(389, 'Customer', 'customer-registration', 'Registration', 'Customer Registration', 0, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(390, 'Customer', 'customer-view', 'View', 'View Customer', 0, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(391, 'Customer', 'customer-edit', 'Edit', 'Edit Customer', 0, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(392, 'Customer', 'customer-delete', 'Delete', 'Delete Customer', 0, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(393, 'Customer', 'customer-active', 'Active', 'Active Customer', 0, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(394, 'Customer', 'customer-in-active', 'In-Active', 'In-Active Customer', 0, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(395, 'Customer', 'customer-bulk-action', 'Bulk(Active,InActive,Delete)', 'Customer Bulk Action', 0, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(396, 'Customer', 'customer-bulk-registration', 'Bulk Registration', 'Bulk Registration', 0, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(397, 'Customer Document', 'customer-document-index', 'Index', 'Customer Document Index', 0, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(398, 'Customer Document', 'customer-document-add', 'Add', 'Customer Document Add', 0, '2020-05-04 17:10:03', '2020-05-04 17:10:03');
INSERT INTO `permissions` (`id`, `group`, `name`, `display_name`, `description`, `group_head`, `created_at`, `updated_at`) VALUES
(399, 'Customer Document', 'customer-document-edit', 'Edit', 'Edit Customer Document', 0, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(400, 'Customer Document', 'customer-document-delete', 'Delete', 'Delete Customer Document', 0, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(401, 'Customer Document', 'customer-document-active', 'Active', 'Active Customer Document', 0, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(402, 'Customer Document', 'customer-document-in-active', 'In-Active', 'In-Active Customer Document', 0, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(403, 'Customer Document', 'customer-document-bulk-action', 'Bulk(Active,InActive,Delete)', 'Customer Document Bulk Action', 0, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(404, 'Customer Note', 'customer-note-index', 'Index', 'Customer Note Index', 0, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(405, 'Customer Note', 'customer-note-add', 'Add', 'Customer Note Add', 0, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(406, 'Customer Note', 'customer-note-edit', 'Edit', 'Edit Customer Note', 0, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(407, 'Customer Note', 'customer-note-delete', 'Delete', 'Delete Customer Note', 0, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(408, 'Customer Note', 'customer-note-active', 'Active', 'Active Customer Note', 0, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(409, 'Customer Note', 'customer-note-in-active', 'In-Active', 'In-Active Customer Note', 0, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(410, 'Customer Note', 'customer-note-bulk-action', 'Bulk(Active,InActive,Delete)', 'Customer Note Bulk Action', 0, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(411, 'Customer Status', 'customer-status-index', 'Index', 'Customer Status Index', 0, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(412, 'Customer Status', 'customer-status-add', 'Add', 'Customer Status Add', 0, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(413, 'Customer Status', 'customer-status-edit', 'Edit', 'Edit Customer Status', 0, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(414, 'Customer Status', 'customer-status-delete', 'Delete', 'Delete Customer Status', 0, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(415, 'Customer Status', 'customer-status-active', 'Active', 'Active Customer Status', 0, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(416, 'Customer Status', 'customer-status-in-active', 'In-Active', 'In-Active Customer Status', 0, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(417, 'Customer Status', 'customer-status-bulk-action', 'Bulk(Active,InActive,Delete)', 'Customer Status Bulk Action', 0, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(418, 'Vendor', 'vendor-index', 'Index', 'Vendor Index', 0, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(419, 'Vendor', 'vendor-registration', 'Registration', 'Vendor Registration', 0, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(420, 'Vendor', 'vendor-view', 'View', 'View Vendor', 0, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(421, 'Vendor', 'vendor-edit', 'Edit', 'Edit Vendor', 0, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(422, 'Vendor', 'vendor-delete', 'Delete', 'Delete Vendor', 0, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(423, 'Vendor', 'vendor-active', 'Active', 'Active Vendor', 0, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(424, 'Vendor', 'vendor-in-active', 'In-Active', 'In-Active Vendor', 0, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(425, 'Vendor', 'vendor-bulk-action', 'Bulk(Active,InActive,Delete)', 'Vendor Bulk Action', 0, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(426, 'Vendor', 'vendor-bulk-registration', 'Bulk Registration', 'Bulk Registration', 0, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(427, 'Vendor Document', 'vendor-document-index', 'Index', 'Vendor Document Index', 0, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(428, 'Vendor Document', 'vendor-document-add', 'Add', 'Vendor Document Add', 0, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(429, 'Vendor Document', 'vendor-document-edit', 'Edit', 'Edit Vendor Document', 0, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(430, 'Vendor Document', 'vendor-document-delete', 'Delete', 'Delete Vendor Document', 0, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(431, 'Vendor Document', 'vendor-document-active', 'Active', 'Active Vendor Document', 0, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(432, 'Vendor Document', 'vendor-document-in-active', 'In-Active', 'In-Active Vendor Document', 0, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(433, 'Vendor Document', 'vendor-document-bulk-action', 'Bulk(Active,InActive,Delete)', 'Vendor Document Bulk Action', 0, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(434, 'Vendor Note', 'vendor-note-index', 'Index', 'Vendor Note Index', 0, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(435, 'Vendor Note', 'vendor-note-add', 'Add', 'Vendor Note Add', 0, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(436, 'Vendor Note', 'vendor-note-edit', 'Edit', 'Edit Vendor Note', 0, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(437, 'Vendor Note', 'vendor-note-delete', 'Delete', 'Delete Vendor Note', 0, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(438, 'Vendor Note', 'vendor-note-active', 'Active', 'Active Vendor Note', 0, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(439, 'Vendor Note', 'vendor-note-in-active', 'In-Active', 'In-Active Vendor Note', 0, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(440, 'Vendor Note', 'vendor-note-bulk-action', 'Bulk(Active,InActive,Delete)', 'Vendor Note Bulk Action', 0, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(441, 'Library Management Permission', 'library-management-index', 'Library Management', 'Library Management', 1, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(442, 'Library', 'library-index', 'Index', 'Library Index', 0, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(443, 'Library', 'library-book-issue', 'Book Issue', 'Book Issue', 0, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(444, 'Library', 'library-book-return', 'Book Return', 'Return Book', 0, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(445, 'Library', 'library-return-over', 'Return Period Over', 'Return Period Over', 0, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(446, 'Library', 'library-issue-history', 'History', 'Issue History', 0, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(447, 'Book', 'book-index', 'Index', 'Book Index', 0, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(448, 'Book', 'book-add', 'Add', 'Book Add', 0, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(449, 'Book', 'book-edit', 'Edit', 'Edit Book', 0, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(450, 'Book', 'book-view', 'View', 'View Book', 0, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(451, 'Book', 'book-delete', 'Delete', 'Delete Book', 0, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(452, 'Book', 'book-active', 'Active', 'Active Book', 0, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(453, 'Book', 'book-in-active', 'In-Active', 'In-Active Book', 0, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(454, 'Book', 'book-bulk-action', 'Bulk(Active,InActive,Delete)', 'Book Bulk Action', 0, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(455, 'Book', 'book-add-copies', 'Add Book Copies', 'Add Book Copies', 0, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(456, 'Book', 'book-status', 'Status', 'Book Status', 0, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(457, 'Book', 'book-bulk-copies-delete', 'Delete Bulk Copies', 'Delete Bulk Copes', 0, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(458, 'Book Category', 'book-category-index', 'Index', 'Book Category Index', 0, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(459, 'Book Category', 'book-category-add', 'Add', 'Book Category Add', 0, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(460, 'Book Category', 'book-category-edit', 'Edit', 'Edit Book Category', 0, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(461, 'Book Category', 'book-category-delete', 'Delete', 'Delete Book Category', 0, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(462, 'Book Category', 'book-category-active', 'Active', 'Active Book Category', 0, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(463, 'Book Category', 'book-category-in-active', 'In-Active', 'In-Active Book Category', 0, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(464, 'Book Category', 'book-category-bulk-action', 'Bulk(Active,InActive,Delete)', 'Book Category Bulk Action', 0, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(465, 'Library Circulation', 'library-circulation-index', 'Index', 'Library Circulation Index', 0, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(466, 'Library Circulation', 'library-circulation-add', 'Add', 'Library Circulation Add', 0, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(467, 'Library Circulation', 'library-circulation-edit', 'Edit', 'Edit Library Circulation', 0, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(468, 'Library Circulation', 'library-circulation-delete', 'Delete', 'Delete Library Circulation', 0, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(469, 'Library Circulation', 'library-circulation-active', 'Active', 'Active Library Circulation', 0, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(470, 'Library Circulation', 'library-circulation-in-active', 'In-Active', 'In-Active Library Circulation', 0, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(471, 'Library Circulation', 'library-circulation-bulk-action', 'Bulk(Active,InActive,Delete)', 'Library Circulation Bulk Action', 0, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(472, 'Library Member', 'library-member-index', 'Index', 'Library Member Index', 0, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(473, 'Library Member', 'library-member-add', 'Add', 'Library Member Add', 0, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(474, 'Library Member', 'library-member-edit', 'Edit', 'Edit Library Member', 0, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(475, 'Library Member', 'library-member-delete', 'Delete', 'Delete Library Member', 0, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(476, 'Library Member', 'library-member-active', 'Active', 'Active Library Member', 0, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(477, 'Library Member', 'library-member-in-active', 'In-Active', 'In-Active Library Member', 0, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(478, 'Library Member', 'library-member-bulk-action', 'Bulk(Active,InActive,Delete)', 'Library Member Bulk Action', 0, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(479, 'Library Member', 'library-member-staff', 'Staff Index', 'Library Member Staff', 0, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(480, 'Library Member', 'library-member-staff-view', 'Staff View', 'Library Member Staff', 0, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(481, 'Library Member', 'library-member-student', 'Student Index', 'Library Member Student', 0, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(482, 'Library Member', 'library-member-student-view', 'Student View', 'Library Member Student', 0, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(483, 'Attendance Management Permission', 'attendance-management-index', 'Attendance Management', 'Attendance Management', 1, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(484, 'Attendance Master', 'attendance-master-index', 'Index', 'Attendance Master Index', 0, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(485, 'Attendance Master', 'attendance-master-add', 'Add', 'Attendance Master Add', 0, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(486, 'Attendance Master', 'attendance-master-edit', 'Edit', 'Edit Attendance Master', 0, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(487, 'Attendance Master', 'attendance-master-delete', 'Delete', 'Delete Attendance Master', 0, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(488, 'Attendance Master', 'attendance-master-active', 'Active', 'Active Attendance Master', 0, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(489, 'Attendance Master', 'attendance-master-in-active', 'In-Active', 'In-Active Attendance Master', 0, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(490, 'Attendance Master', 'attendance-master-bulk-action', 'Bulk(Active,InActive,Delete)', 'Attendance Master Bulk Action', 0, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(491, 'Student Regular Attendance', 'student-attendance-index', 'Index', 'Student Regular Attendance Index', 0, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(492, 'Student Regular Attendance', 'student-attendance-add', 'Add', 'Student Regular Attendance Add', 0, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(493, 'Student Regular Attendance', 'student-attendance-delete', 'Delete', 'Delete Student Regular Attendance', 0, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(494, 'Student Regular Attendance', 'student-attendance-bulk-action', 'Bulk(Active,InActive,Delete)', 'Student Regular Attendance Bulk Action', 0, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(495, 'Student SubjectWise Attendance', 'subject-attendance-index', 'Index', 'Student SubjectWise Attendance Index', 0, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(496, 'Student SubjectWise Attendance', 'subject-attendance-add', 'Add', 'Student SubjectWise Attendance Add', 0, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(497, 'Student SubjectWise Attendance', 'subject-attendance-delete', 'Delete', 'Delete Student SubjectWise Attendance', 0, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(498, 'Student SubjectWise Attendance', 'subject-attendance-bulk-action', 'Bulk(Active,InActive,Delete)', 'Student SubjectWise Attendance Bulk Action', 0, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(499, 'Student SubjectWise Attendance', 'subject-attendance-alert', 'Alert', 'Student SubjectWise Attendance Alert', 0, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(500, 'Staff Attendance', 'staff-attendance-index', 'Index', 'Staff Attendance Index', 0, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(501, 'Staff Attendance', 'staff-attendance-add', 'Add', 'Staff Attendance Add', 0, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(502, 'Staff Attendance', 'staff-attendance-delete', 'Delete', 'Delete Staff Attendance', 0, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(503, 'Staff Attendance', 'staff-attendance-bulk-action', 'Bulk(Active,InActive,Delete)', 'Staff Attendance Bulk Action', 0, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(504, 'Exam Management Permission', 'exam-management-index', 'Exam Management', 'Exam Management', 1, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(505, 'Exam', 'exam-index', 'Index', 'Exam Index', 0, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(506, 'Exam', 'exam-add', 'Add', 'Exam Add', 0, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(507, 'Exam', 'exam-edit', 'Edit', 'Edit Exam', 0, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(508, 'Exam', 'exam-delete', 'Delete', 'Delete Exam', 0, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(509, 'Exam', 'exam-active', 'Active', 'Active Exam', 0, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(510, 'Exam', 'exam-in-active', 'In-Active', 'In-Active Exam', 0, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(511, 'Exam', 'exam-bulk-action', 'Bulk(Active,InActive,Delete)', 'Exam Bulk Action', 0, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(512, 'Exam', 'exam-admit-card', 'Admit Card', 'Exam Admit Card', 0, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(513, 'Exam', 'exam-exam-routine', 'Routin/Schedule', 'Exam Routine/Schedule', 0, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(514, 'Exam', 'exam-mark-ledger', 'MarkLedger', 'Exam Mark Ledger', 0, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(515, 'Exam', 'exam-result-publish', 'Result Publish', 'Exam Result Publish', 0, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(516, 'Exam', 'exam-result-un-publish', 'Result UnPublish', 'Exam Result UnPublish', 0, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(517, 'Exam Schedule', 'exam-schedule-index', 'Index', 'Exam Schedule Index', 0, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(518, 'Exam Schedule', 'exam-schedule-add', 'Add', 'Exam Schedule Add', 0, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(519, 'Exam Schedule', 'exam-schedule-edit', 'Edit', 'Edit Exam Schedule', 0, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(520, 'Exam Schedule', 'exam-schedule-delete', 'Delete', 'Delete Exam Schedule', 0, '2020-05-04 17:10:03', '2020-05-04 17:10:03'),
(521, 'Exam Schedule', 'exam-schedule-active', 'Active', 'Active Exam Schedule', 0, '2020-05-04 17:10:04', '2020-05-04 17:10:04'),
(522, 'Exam Schedule', 'exam-schedule-in-active', 'In-Active', 'In-Active Exam Schedule', 0, '2020-05-04 17:10:04', '2020-05-04 17:10:04'),
(523, 'Exam Mark Ledger', 'exam-mark-ledger-index', 'Index', 'Exam Mark Ledger Index', 0, '2020-05-04 17:10:04', '2020-05-04 17:10:04'),
(524, 'Exam Mark Ledger', 'exam-mark-ledger-add', 'Add', 'Exam Mark Ledger Add', 0, '2020-05-04 17:10:04', '2020-05-04 17:10:04'),
(525, 'Exam Mark Ledger', 'exam-mark-ledger-edit', 'Edit', 'Edit Exam Mark Ledger', 0, '2020-05-04 17:10:04', '2020-05-04 17:10:04'),
(526, 'Exam Mark Ledger', 'exam-mark-ledger-delete', 'Delete', 'Delete Exam Mark Ledger', 0, '2020-05-04 17:10:04', '2020-05-04 17:10:04'),
(527, 'Exam Mark Ledger', 'exam-mark-ledger-active', 'Active', 'Active Exam Mark Ledger', 0, '2020-05-04 17:10:04', '2020-05-04 17:10:04'),
(528, 'Exam Mark Ledger', 'exam-mark-ledger-in-active', 'In-Active', 'In-Active Exam Mark Ledger', 0, '2020-05-04 17:10:04', '2020-05-04 17:10:04'),
(529, 'Exam Print', 'exam-print-admitcard', 'Admit Card', 'Exam Admit Card', 0, '2020-05-04 17:10:04', '2020-05-04 17:10:04'),
(530, 'Exam Print', 'exam-print-routine', 'Routine/Schedule', 'Exam Routine/Schedule', 0, '2020-05-04 17:10:04', '2020-05-04 17:10:04'),
(531, 'Exam Print', 'exam-print-mark-sheet', 'Mark/Grade Sheet', 'Exam Mark/Grade Sheet', 0, '2020-05-04 17:10:04', '2020-05-04 17:10:04'),
(532, 'Exam Print', 'exam-print-mark-ledger', 'Mark Ledger', 'Exam Mark Ledger Sheet', 0, '2020-05-04 17:10:04', '2020-05-04 17:10:04'),
(533, 'Certificate Management Permission', 'certificate-management-index', 'Certificate Management', 'Certificate Management', 1, '2020-05-04 17:10:04', '2020-05-04 17:10:04'),
(534, 'Certificate', 'issue-certificate', 'Certificate Issue', 'Certificate Issue', 0, '2020-05-04 17:10:04', '2020-05-04 17:10:04'),
(535, 'Certificate', 'certificate-history', 'Certificate History', 'Certificate History', 0, '2020-05-04 17:10:04', '2020-05-04 17:10:04'),
(536, 'General Certificate', 'certificate-generate', 'General Certificate Generate', 'General Certificate Generate', 0, '2020-05-04 17:10:04', '2020-05-04 17:10:04'),
(537, 'General Certificate', 'general-certificate-print', 'General Certificate Print', 'General Certificate Print', 0, '2020-05-04 17:10:04', '2020-05-04 17:10:04'),
(538, 'Certificate Template', 'certificate-template-index', 'Index', 'Certificate Template Index', 0, '2020-05-04 17:10:04', '2020-05-04 17:10:04'),
(539, 'Certificate Template', 'certificate-template-add', 'Add', 'Certificate Template Add', 0, '2020-05-04 17:10:04', '2020-05-04 17:10:04'),
(540, 'Certificate Template', 'certificate-template-edit', 'Edit', 'Edit Certificate Template', 0, '2020-05-04 17:10:04', '2020-05-04 17:10:04'),
(541, 'Certificate Template', 'certificate-template-view', 'View', 'View Certificate Template', 0, '2020-05-04 17:10:04', '2020-05-04 17:10:04'),
(542, 'Certificate Template', 'certificate-template-delete', 'Delete', 'Delete Certificate Template', 0, '2020-05-04 17:10:04', '2020-05-04 17:10:04'),
(543, 'Certificate Template', 'certificate-template-active', 'Active', 'Active Certificate Template', 0, '2020-05-04 17:10:04', '2020-05-04 17:10:04'),
(544, 'Certificate Template', 'certificate-template-in-active', 'In-Active', 'In-Active Certificate Template', 0, '2020-05-04 17:10:04', '2020-05-04 17:10:04'),
(545, 'Certificate Template', 'certificate-template-bulk-action', 'Bulk(Active,InActive,Delete', 'Bulk Certificate Template', 0, '2020-05-04 17:10:04', '2020-05-04 17:10:04'),
(546, 'Attendance Certificate', 'attendance-certificate-index', 'Index', 'Attendance Certificate Index', 0, '2020-05-04 17:10:04', '2020-05-04 17:10:04'),
(547, 'Attendance Certificate', 'attendance-certificate-add', 'Add', 'Attendance Certificate Add', 0, '2020-05-04 17:10:04', '2020-05-04 17:10:04'),
(548, 'Attendance Certificate', 'attendance-certificate-edit', 'Edit', 'Edit Attendance Certificate', 0, '2020-05-04 17:10:04', '2020-05-04 17:10:04'),
(549, 'Attendance Certificate', 'attendance-certificate-view', 'View', 'View Attendance Certificate', 0, '2020-05-04 17:10:04', '2020-05-04 17:10:04'),
(550, 'Attendance Certificate', 'attendance-certificate-delete', 'Delete', 'Delete Attendance Certificate', 0, '2020-05-04 17:10:04', '2020-05-04 17:10:04'),
(551, 'Attendance Certificate', 'attendance-certificate-bulk-action', 'Bulk(Active,InActive,Delete', 'Bulk Attendance Certificate', 0, '2020-05-04 17:10:04', '2020-05-04 17:10:04'),
(552, 'Attendance Certificate', 'attendance-certificate-print', 'Print', 'Print Attendance Certificate', 0, '2020-05-04 17:10:04', '2020-05-04 17:10:04'),
(553, 'Attendance Certificate', 'attendance-certificate-bulk-print', 'Bulk Print', 'Bulk Print Attendance Certificate', 0, '2020-05-04 17:10:04', '2020-05-04 17:10:04'),
(554, 'Transfer Certificate', 'transfer-certificate-index', 'Index', 'Transfer Certificate Index', 0, '2020-05-04 17:10:04', '2020-05-04 17:10:04'),
(555, 'Transfer Certificate', 'transfer-certificate-add', 'Add', 'Transfer Certificate Add', 0, '2020-05-04 17:10:04', '2020-05-04 17:10:04'),
(556, 'Transfer Certificate', 'transfer-certificate-edit', 'Edit', 'Edit Transfer Certificate', 0, '2020-05-04 17:10:04', '2020-05-04 17:10:04'),
(557, 'Transfer Certificate', 'transfer-certificate-view', 'View', 'View Transfer Certificate', 0, '2020-05-04 17:10:04', '2020-05-04 17:10:04'),
(558, 'Transfer Certificate', 'transfer-certificate-delete', 'Delete', 'Delete Transfer Certificate', 0, '2020-05-04 17:10:04', '2020-05-04 17:10:04'),
(559, 'Transfer Certificate', 'transfer-certificate-bulk-action', 'Bulk(Active,InActive,Delete', 'Bulk Transfer Certificate', 0, '2020-05-04 17:10:04', '2020-05-04 17:10:04'),
(560, 'Transfer Certificate', 'transfer-certificate-print', 'Print', 'Print Transfer Certificate', 0, '2020-05-04 17:10:04', '2020-05-04 17:10:04'),
(561, 'Transfer Certificate', 'transfer-certificate-bulk-print', 'Bulk Print', 'Bulk Print Transfer Certificate', 0, '2020-05-04 17:10:04', '2020-05-04 17:10:04'),
(562, 'Bonafide Certificate', 'bonafide-certificate-index', 'Index', 'Bonafide Certificate Index', 0, '2020-05-04 17:10:04', '2020-05-04 17:10:04'),
(563, 'Bonafide Certificate', 'bonafide-certificate-add', 'Add', 'Bonafide Certificate Add', 0, '2020-05-04 17:10:04', '2020-05-04 17:10:04'),
(564, 'Bonafide Certificate', 'bonafide-certificate-edit', 'Edit', 'Edit Bonafide Certificate', 0, '2020-05-04 17:10:04', '2020-05-04 17:10:04'),
(565, 'Bonafide Certificate', 'bonafide-certificate-view', 'View', 'View Bonafide Certificate', 0, '2020-05-04 17:10:04', '2020-05-04 17:10:04'),
(566, 'Bonafide Certificate', 'bonafide-certificate-delete', 'Delete', 'Delete Bonafide Certificate', 0, '2020-05-04 17:10:04', '2020-05-04 17:10:04'),
(567, 'Bonafide Certificate', 'bonafide-certificate-bulk-action', 'Bulk(Active,InActive,Delete', 'Bulk Bonafide Certificate', 0, '2020-05-04 17:10:04', '2020-05-04 17:10:04'),
(568, 'Bonafide Certificate', 'bonafide-certificate-print', 'Print', 'Print Bonafide Certificate', 0, '2020-05-04 17:10:04', '2020-05-04 17:10:04'),
(569, 'Bonafide Certificate', 'bonafide-certificate-bulk-print', 'Bulk Print', 'Bulk Print Bonafide Certificate', 0, '2020-05-04 17:10:04', '2020-05-04 17:10:04'),
(570, 'Course Completion Certificate', 'course-completion-certificate-index', 'Index', 'Course Completion Certificate Index', 0, '2020-05-04 17:10:04', '2020-05-04 17:10:04'),
(571, 'Course Completion Certificate', 'course-completion-certificate-add', 'Add', 'Course Completion Certificate Add', 0, '2020-05-04 17:10:04', '2020-05-04 17:10:04'),
(572, 'Course Completion Certificate', 'course-completion-certificate-edit', 'Edit', 'Edit Course Completion Certificate', 0, '2020-05-04 17:10:04', '2020-05-04 17:10:04'),
(573, 'Course Completion Certificate', 'course-completion-certificate-view', 'View', 'View Course Completion Certificate', 0, '2020-05-04 17:10:04', '2020-05-04 17:10:04'),
(574, 'Course Completion Certificate', 'course-completion-certificate-delete', 'Delete', 'Delete Course Completion Certificate', 0, '2020-05-04 17:10:04', '2020-05-04 17:10:04'),
(575, 'Course Completion Certificate', 'course-completion-certificate-bulk-action', 'Bulk(Active,InActive,Delete', 'Bulk Course Completion Certificate', 0, '2020-05-04 17:10:04', '2020-05-04 17:10:04'),
(576, 'Course Completion Certificate', 'course-completion-certificate-print', 'Print', 'Print Course Completion Certificate', 0, '2020-05-04 17:10:04', '2020-05-04 17:10:04'),
(577, 'Course Completion Certificate', 'course-completion-certificate-bulk-print', 'Bulk Print', 'Bulk Print Course Completion Certificate', 0, '2020-05-04 17:10:04', '2020-05-04 17:10:04'),
(578, 'Hostel Management Permission', 'hostel-management-index', 'Hostel Management', 'Hostel Management', 1, '2020-05-04 17:10:04', '2020-05-04 17:10:04'),
(579, 'Hostel', 'hostel-index', 'Index', 'Hostel Index', 0, '2020-05-04 17:10:04', '2020-05-04 17:10:04'),
(580, 'Hostel', 'hostel-add', 'Add', 'Hostel Add', 0, '2020-05-04 17:10:04', '2020-05-04 17:10:04'),
(581, 'Hostel', 'hostel-view', 'view', 'Hostel View', 0, '2020-05-04 17:10:04', '2020-05-04 17:10:04'),
(582, 'Hostel', 'hostel-edit', 'Edit', 'Edit Hostel', 0, '2020-05-04 17:10:04', '2020-05-04 17:10:04'),
(583, 'Hostel', 'hostel-delete', 'Delete', 'Delete Hostel', 0, '2020-05-04 17:10:04', '2020-05-04 17:10:04'),
(584, 'Hostel', 'hostel-active', 'Active', 'Active Hostel', 0, '2020-05-04 17:10:04', '2020-05-04 17:10:04'),
(585, 'Hostel', 'hostel-in-active', 'In-Active', 'In-Active Hostel', 0, '2020-05-04 17:10:04', '2020-05-04 17:10:04'),
(586, 'Hostel', 'hostel-bulk-action', 'Bulk(Active,InActive,Delete)', 'Hostel Bulk Action', 0, '2020-05-04 17:10:04', '2020-05-04 17:10:04'),
(587, 'Room', 'room-add', 'Add', 'Room Add', 0, '2020-05-04 17:10:04', '2020-05-04 17:10:04'),
(588, 'Room', 'room-view', 'View', 'Room View', 0, '2020-05-04 17:10:04', '2020-05-04 17:10:04'),
(589, 'Room', 'room-edit', 'Edit', 'Edit Room', 0, '2020-05-04 17:10:04', '2020-05-04 17:10:04'),
(590, 'Room', 'room-delete', 'Delete', 'Delete Room', 0, '2020-05-04 17:10:04', '2020-05-04 17:10:04'),
(591, 'Room', 'room-active', 'Active', 'Active Room', 0, '2020-05-04 17:10:04', '2020-05-04 17:10:04'),
(592, 'Room', 'room-in-active', 'In-Active', 'In-Active Room', 0, '2020-05-04 17:10:04', '2020-05-04 17:10:04'),
(593, 'Room', 'room-bulk-action', 'Bulk(Active,InActive,Delete)', 'Room Bulk Action', 0, '2020-05-04 17:10:04', '2020-05-04 17:10:04'),
(594, 'Bed', 'bed-add', 'Add', 'Bed Add', 0, '2020-05-04 17:10:04', '2020-05-04 17:10:04'),
(595, 'Bed', 'bed-status', 'Status', 'Bed Status', 0, '2020-05-04 17:10:04', '2020-05-04 17:10:04'),
(596, 'Bed', 'bed-delete', 'Delete', 'Delete Bed', 0, '2020-05-04 17:10:04', '2020-05-04 17:10:04'),
(597, 'Bed', 'bed-active', 'Active', 'Active Bed', 0, '2020-05-04 17:10:04', '2020-05-04 17:10:04'),
(598, 'Bed', 'bed-in-active', 'In-Active', 'In-Active Bed', 0, '2020-05-04 17:10:04', '2020-05-04 17:10:04'),
(599, 'Bed', 'bed-bulk-action', 'Bulk(Active,InActive,Delete)', 'Bed Bulk Action', 0, '2020-05-04 17:10:04', '2020-05-04 17:10:04'),
(600, 'Room Type', 'room-type-index', 'Index', 'Room Type Index', 0, '2020-05-04 17:10:04', '2020-05-04 17:10:04'),
(601, 'Room Type', 'room-type-add', 'Add', 'Room Type Add', 0, '2020-05-04 17:10:04', '2020-05-04 17:10:04'),
(602, 'Room Type', 'room-type-edit', 'Edit', 'Edit Room Type', 0, '2020-05-04 17:10:04', '2020-05-04 17:10:04'),
(603, 'Room Type', 'room-type-delete', 'Delete', 'Delete Room Type', 0, '2020-05-04 17:10:04', '2020-05-04 17:10:04'),
(604, 'Room Type', 'room-type-active', 'Active', 'Active Room Type', 0, '2020-05-04 17:10:04', '2020-05-04 17:10:04'),
(605, 'Room Type', 'room-type-in-active', 'In-Active', 'In-Active Room Type', 0, '2020-05-04 17:10:04', '2020-05-04 17:10:04'),
(606, 'Room Type', 'room-type-bulk-action', 'Bulk(Active,InActive,Delete)', 'Room Type Bulk Action', 0, '2020-05-04 17:10:04', '2020-05-04 17:10:04'),
(607, 'Resident', 'resident-index', 'Index', 'Resident Index', 0, '2020-05-04 17:10:04', '2020-05-04 17:10:04'),
(608, 'Resident', 'resident-add', 'Add', 'Resident Add', 0, '2020-05-04 17:10:04', '2020-05-04 17:10:04'),
(609, 'Resident', 'resident-edit', 'Edit', 'Edit Resident', 0, '2020-05-04 17:10:04', '2020-05-04 17:10:04'),
(610, 'Resident', 'resident-delete', 'Delete', 'Delete Resident', 0, '2020-05-04 17:10:04', '2020-05-04 17:10:04'),
(611, 'Resident', 'resident-bulk-action', 'Bulk(Active,InActive,Delete)', 'Resident Bulk Action', 0, '2020-05-04 17:10:04', '2020-05-04 17:10:04'),
(612, 'Resident', 'resident-renew', 'Renew', 'Renew Resident', 0, '2020-05-04 17:10:04', '2020-05-04 17:10:04'),
(613, 'Resident', 'resident-leave', 'Leave', 'Leave Resident', 0, '2020-05-04 17:10:04', '2020-05-04 17:10:04'),
(614, 'Resident', 'resident-shift', 'Shift', 'Shift Resident', 0, '2020-05-04 17:10:04', '2020-05-04 17:10:04'),
(615, 'Resident', 'resident-history', 'History', 'Resident History', 0, '2020-05-04 17:10:04', '2020-05-04 17:10:04'),
(616, 'Food', 'food-index', 'Index', 'Food Index', 0, '2020-05-04 17:10:04', '2020-05-04 17:10:04'),
(617, 'Food', 'food-add', 'Add', 'Food Add', 0, '2020-05-04 17:10:04', '2020-05-04 17:10:04'),
(618, 'Food', 'food-edit', 'Edit', 'Edit Food', 0, '2020-05-04 17:10:04', '2020-05-04 17:10:04'),
(619, 'Food', 'food-delete', 'Delete', 'Delete Food', 0, '2020-05-04 17:10:04', '2020-05-04 17:10:04'),
(620, 'Food', 'food-active', 'Active', 'Active Food', 0, '2020-05-04 17:10:04', '2020-05-04 17:10:04'),
(621, 'Food', 'food-in-active', 'In-Active', 'In-Active Food', 0, '2020-05-04 17:10:04', '2020-05-04 17:10:04'),
(622, 'Food', 'food-bulk-action', 'Bulk(Active,InActive,Delete)', 'Food Bulk Action', 0, '2020-05-04 17:10:04', '2020-05-04 17:10:04'),
(623, 'Food Category', 'food-category-index', 'Index', 'Food Category Index', 0, '2020-05-04 17:10:04', '2020-05-04 17:10:04'),
(624, 'Food Category', 'food-category-add', 'Add', 'Food Category Add', 0, '2020-05-04 17:10:04', '2020-05-04 17:10:04'),
(625, 'Food Category', 'food-category-edit', 'Edit', 'Edit Food Category', 0, '2020-05-04 17:10:04', '2020-05-04 17:10:04'),
(626, 'Food Category', 'food-category-delete', 'Delete', 'Delete Food Category', 0, '2020-05-04 17:10:04', '2020-05-04 17:10:04'),
(627, 'Food Category', 'food-category-active', 'Active', 'Active Food Category', 0, '2020-05-04 17:10:04', '2020-05-04 17:10:04'),
(628, 'Food Category', 'food-category-in-active', 'In-Active', 'In-Active Food Category', 0, '2020-05-04 17:10:04', '2020-05-04 17:10:04'),
(629, 'Food Category', 'food-category-bulk-action', 'Bulk(Active,InActive,Delete)', 'Food Category Bulk Action', 0, '2020-05-04 17:10:04', '2020-05-04 17:10:04'),
(630, 'Food Item', 'food-item-index', 'Index', 'Food Item Index', 0, '2020-05-04 17:10:04', '2020-05-04 17:10:04'),
(631, 'Food Item', 'food-item-add', 'Add', 'Food Item Add', 0, '2020-05-04 17:10:04', '2020-05-04 17:10:04'),
(632, 'Food Item', 'food-item-edit', 'Edit', 'Edit Food Item', 0, '2020-05-04 17:10:04', '2020-05-04 17:10:04'),
(633, 'Food Item', 'food-item-delete', 'Delete', 'Delete Food Item', 0, '2020-05-04 17:10:04', '2020-05-04 17:10:04'),
(634, 'Food Item', 'food-item-active', 'Active', 'Active Food Item', 0, '2020-05-04 17:10:04', '2020-05-04 17:10:04'),
(635, 'Food Item', 'food-item-in-active', 'In-Active', 'In-Active Food Item', 0, '2020-05-04 17:10:04', '2020-05-04 17:10:04'),
(636, 'Food Item', 'food-item-bulk-action', 'Bulk(Active,InActive,Delete)', 'Food Item Bulk Action', 0, '2020-05-04 17:10:04', '2020-05-04 17:10:04'),
(637, 'Eating Time', 'eating-time-index', 'Index', 'Eating Time Index', 0, '2020-05-04 17:10:04', '2020-05-04 17:10:04'),
(638, 'Eating Time', 'eating-time-add', 'Add', 'Eating Time Add', 0, '2020-05-04 17:10:04', '2020-05-04 17:10:04'),
(639, 'Eating Time', 'eating-time-edit', 'Edit', 'Edit Eating Time', 0, '2020-05-04 17:10:04', '2020-05-04 17:10:04'),
(640, 'Eating Time', 'eating-time-delete', 'Delete', 'Delete Eating Time', 0, '2020-05-04 17:10:04', '2020-05-04 17:10:04'),
(641, 'Eating Time', 'eating-time-active', 'Active', 'Active Eating Time', 0, '2020-05-04 17:10:04', '2020-05-04 17:10:04'),
(642, 'Eating Time', 'eating-time-in-active', 'In-Active', 'In-Active Eating Time', 0, '2020-05-04 17:10:04', '2020-05-04 17:10:04'),
(643, 'Eating Time', 'eating-time-bulk-action', 'Bulk(Active,InActive,Delete)', 'Eating Time Bulk Action', 0, '2020-05-04 17:10:04', '2020-05-04 17:10:04'),
(644, 'Transport Management Permission', 'transport-management-index', 'Transport Management', 'Transport Management', 1, '2020-05-04 17:10:04', '2020-05-04 17:10:04'),
(645, 'Transport Route', 'transport-route-index', 'Index', 'Transport Route Index', 0, '2020-05-04 17:10:04', '2020-05-04 17:10:04'),
(646, 'Transport Route', 'transport-route-add', 'Add', 'Transport Route Add', 0, '2020-05-04 17:10:04', '2020-05-04 17:10:04'),
(647, 'Transport Route', 'transport-route-edit', 'Edit', 'Edit Transport Route', 0, '2020-05-04 17:10:04', '2020-05-04 17:10:04'),
(648, 'Transport Route', 'transport-route-delete', 'Delete', 'Delete Transport Route', 0, '2020-05-04 17:10:04', '2020-05-04 17:10:04'),
(649, 'Transport Route', 'transport-route-active', 'Active', 'Active Transport Route', 0, '2020-05-04 17:10:04', '2020-05-04 17:10:04'),
(650, 'Transport Route', 'transport-route-in-active', 'In-Active', 'In-Active Transport Route', 0, '2020-05-04 17:10:04', '2020-05-04 17:10:04'),
(651, 'Transport Route', 'transport-route-bulk-action', 'Bulk(Active,InActive,Delete)', 'Transport Route Bulk Action', 0, '2020-05-04 17:10:04', '2020-05-04 17:10:04'),
(652, 'Vehicle', 'vehicle-index', 'Index', 'Vehicle Index', 0, '2020-05-04 17:10:04', '2020-05-04 17:10:04'),
(653, 'Vehicle', 'vehicle-add', 'Add', 'Vehicle Add', 0, '2020-05-04 17:10:04', '2020-05-04 17:10:04'),
(654, 'Vehicle', 'vehicle-edit', 'Edit', 'Edit Vehicle', 0, '2020-05-04 17:10:04', '2020-05-04 17:10:04'),
(655, 'Vehicle', 'vehicle-delete', 'Delete', 'Delete Vehicle', 0, '2020-05-04 17:10:04', '2020-05-04 17:10:04'),
(656, 'Vehicle', 'vehicle-active', 'Active', 'Active Vehicle', 0, '2020-05-04 17:10:04', '2020-05-04 17:10:04'),
(657, 'Vehicle', 'vehicle-in-active', 'In-Active', 'In-Active Vehicle', 0, '2020-05-04 17:10:04', '2020-05-04 17:10:04'),
(658, 'Vehicle', 'vehicle-bulk-action', 'Bulk(Active,InActive,Delete)', 'Vehicle Bulk Action', 0, '2020-05-04 17:10:04', '2020-05-04 17:10:04'),
(659, 'Transport User/Traveller', 'transport-user-index', 'Index', 'Transport User/Traveller Index', 0, '2020-05-04 17:10:04', '2020-05-04 17:10:04'),
(660, 'Transport User/Traveller', 'transport-user-add', 'Add', 'Transport User/Traveller Add', 0, '2020-05-04 17:10:04', '2020-05-04 17:10:04'),
(661, 'Transport User/Traveller', 'transport-user-edit', 'Edit', 'Edit Transport User/Traveller', 0, '2020-05-04 17:10:04', '2020-05-04 17:10:04'),
(662, 'Transport User/Traveller', 'transport-user-delete', 'Delete', 'Delete Transport User/Traveller', 0, '2020-05-04 17:10:04', '2020-05-04 17:10:04'),
(663, 'Transport User/Traveller', 'transport-user-bulk-action', 'Bulk(Active,InActive,Delete)', 'Transport User/Traveller Bulk Action', 0, '2020-05-04 17:10:04', '2020-05-04 17:10:04'),
(664, 'Transport User/Traveller', 'transport-user-renew', 'Renew', 'Renew Transport User/Traveller', 0, '2020-05-04 17:10:04', '2020-05-04 17:10:04'),
(665, 'Transport User/Traveller', 'transport-user-leave', 'Leave', 'Leave Transport User/Traveller', 0, '2020-05-04 17:10:04', '2020-05-04 17:10:04'),
(666, 'Transport User/Traveller', 'transport-user-shift', 'Shift', 'Shift Transport User/Traveller', 0, '2020-05-04 17:10:04', '2020-05-04 17:10:04'),
(667, 'Transport User/Traveller', 'transport-user-history', 'History', 'Resident History', 0, '2020-05-04 17:10:04', '2020-05-04 17:10:04'),
(668, 'Notice & Alert Management Permission', 'notice-group-index', 'Notice & Alert Permission', 'Notice & Alert Permission', 1, '2020-05-04 17:10:04', '2020-05-04 17:10:04'),
(669, 'Notice', 'notice-index', 'Index', 'Notice Index', 0, '2020-05-04 17:10:04', '2020-05-04 17:10:04'),
(670, 'Notice', 'notice-add', 'Add', 'Notice Add', 0, '2020-05-04 17:10:04', '2020-05-04 17:10:04'),
(671, 'Notice', 'notice-edit', 'Edit', 'Edit Notice', 0, '2020-05-04 17:10:04', '2020-05-04 17:10:04'),
(672, 'Notice', 'notice-delete', 'Delete', 'Delete Notice', 0, '2020-05-04 17:10:04', '2020-05-04 17:10:04'),
(673, 'SMS/E-Mail', 'sms-email-index', 'Index', 'SMS/E-Mail Index', 0, '2020-05-04 17:10:04', '2020-05-04 17:10:04'),
(674, 'SMS/E-Mail', 'sms-email-delete', 'Delete', 'SMS/E-Mail Delete', 0, '2020-05-04 17:10:04', '2020-05-04 17:10:04'),
(675, 'SMS/E-Mail', 'sms-email-bulk-action', 'Bulk(Active,InActive,Delete)', 'Bulk SMS/E-Mail', 0, '2020-05-04 17:10:04', '2020-05-04 17:10:04'),
(676, 'SMS/E-Mail', 'sms-email-create', 'Create', 'Create SMS/E-Mail', 0, '2020-05-04 17:10:04', '2020-05-04 17:10:04'),
(677, 'SMS/E-Mail', 'sms-email-send', 'Send', 'Send SMS/E-Mail', 0, '2020-05-04 17:10:04', '2020-05-04 17:10:04'),
(678, 'SMS/E-Mail', 'sms-email-student-guardian-send', 'Student & Guardian', 'Student & Guardian SMS/E-Mail', 0, '2020-05-04 17:10:04', '2020-05-04 17:10:04'),
(679, 'SMS/E-Mail', 'sms-email-staff-send', 'Staff', 'Staff SMS/E-Mail', 0, '2020-05-04 17:10:04', '2020-05-04 17:10:04'),
(680, 'SMS/E-Mail', 'sms-email-individual-send', 'Individual', 'Individual SMS/E-Mail', 0, '2020-05-04 17:10:04', '2020-05-04 17:10:04'),
(681, 'SMS/E-Mail', 'sms-email-fee-receipt', 'Fee Receipt', 'Fee ReceiptSMS/E-Mail', 0, '2020-05-04 17:10:04', '2020-05-04 17:10:04'),
(682, 'SMS/E-Mail', 'sms-email-due-reminder', 'Due Reminder', 'Due Reminder SMS/E-Mail', 0, '2020-05-04 17:10:04', '2020-05-04 17:10:04'),
(683, 'SMS/E-Mail', 'sms-email-book-return-reminder', 'Book Return Reminder', 'Book Return Reminder', 0, '2020-05-04 17:10:04', '2020-05-04 17:10:04'),
(684, 'More(Assignment & Download) Management Permission', 'more-index', 'More(Assignment & Download) Permission', 'More(Assignment & Download) Permission', 1, '2020-05-04 17:10:04', '2020-05-04 17:10:04'),
(685, 'Assignment', 'assignment-index', 'Index', 'Assignment Index', 0, '2020-05-04 17:10:04', '2020-05-04 17:10:04'),
(686, 'Assignment', 'assignment-add', 'Add', 'Assignment Add', 0, '2020-05-04 17:10:04', '2020-05-04 17:10:04'),
(687, 'Assignment', 'assignment-edit', 'Edit', 'Edit Assignment', 0, '2020-05-04 17:10:04', '2020-05-04 17:10:04'),
(688, 'Assignment', 'assignment-view', 'View', 'View Assignment', 0, '2020-05-04 17:10:04', '2020-05-04 17:10:04'),
(689, 'Assignment', 'assignment-delete', 'Delete', 'Delete Assignment', 0, '2020-05-04 17:10:04', '2020-05-04 17:10:04'),
(690, 'Assignment', 'assignment-active', 'Active', 'Active Assignment', 0, '2020-05-04 17:10:04', '2020-05-04 17:10:04'),
(691, 'Assignment', 'assignment-in-active', 'In-Active', 'In-Active Assignment', 0, '2020-05-04 17:10:04', '2020-05-04 17:10:04'),
(692, 'Assignment', 'assignment-bulk-action', 'Bulk(Active,InActive,Delete)', 'Assignment Bulk Action', 0, '2020-05-04 17:10:04', '2020-05-04 17:10:04'),
(693, 'Assignment Answer', 'assignment-answer-view', 'View', 'Assignment Answer View', 0, '2020-05-04 17:10:04', '2020-05-04 17:10:04'),
(694, 'Assignment Answer', 'assignment-answer-approve', 'Approve', 'Approve Assignment Answer', 0, '2020-05-04 17:10:04', '2020-05-04 17:10:04'),
(695, 'Assignment Answer', 'assignment-answer-reject', 'Reject', 'Reject Assignment Answer', 0, '2020-05-04 17:10:04', '2020-05-04 17:10:04'),
(696, 'Assignment Answer', 'assignment-answer-delete', 'Delete', 'Delete Assignment Answer', 0, '2020-05-04 17:10:04', '2020-05-04 17:10:04'),
(697, 'Assignment Answer', 'assignment-answer-bulk-action', 'Bulk(Approve, Reject,Delete)', 'Assignment Answer Bulk Action', 0, '2020-05-04 17:10:04', '2020-05-04 17:10:04'),
(698, 'Download', 'download-index', 'Index', 'Download Index', 0, '2020-05-04 17:10:04', '2020-05-04 17:10:04'),
(699, 'Download', 'download-add', 'Add', 'Download Add', 0, '2020-05-04 17:10:04', '2020-05-04 17:10:04'),
(700, 'Download', 'download-edit', 'Edit', 'Edit Download', 0, '2020-05-04 17:10:04', '2020-05-04 17:10:04'),
(701, 'Download', 'download-delete', 'Delete', 'Delete Download', 0, '2020-05-04 17:10:04', '2020-05-04 17:10:04'),
(702, 'Download', 'download-active', 'Active', 'Active Download', 0, '2020-05-04 17:10:04', '2020-05-04 17:10:04'),
(703, 'Download', 'download-in-active', 'In-Active', 'In-Active Download', 0, '2020-05-04 17:10:04', '2020-05-04 17:10:04'),
(704, 'Download', 'download-bulk-action', 'Bulk(Active,InActive,Delete)', 'Download Bulk Action', 0, '2020-05-04 17:10:04', '2020-05-04 17:10:04'),
(705, 'Meeting', 'meeting-index', 'Index', 'Meeting Index', 0, '2020-05-04 17:10:04', '2020-05-04 17:10:04'),
(706, 'Meeting', 'meeting-add', 'Add', 'Meeting Add', 0, '2020-05-04 17:10:04', '2020-05-04 17:10:04'),
(707, 'Meeting', 'meeting-delete', 'Delete', 'Delete Meeting', 0, '2020-05-04 17:10:04', '2020-05-04 17:10:04'),
(708, 'Meeting', 'meeting-complete', 'Complete', 'Complete Meeting', 0, '2020-05-04 17:10:04', '2020-05-04 17:10:04'),
(709, 'Meeting', 'meeting-start', 'Start', 'Start Meeting', 0, '2020-05-04 17:10:04', '2020-05-04 17:10:04'),
(710, 'Meeting', 'meeting-pending', 'Pending', 'Pending Meeting', 0, '2020-05-04 17:10:04', '2020-05-04 17:10:04'),
(711, 'Meeting', 'meeting-bulk-action', 'Bulk(Active,InActive,Delete)', 'Meeting Bulk Action', 0, '2020-05-04 17:10:04', '2020-05-04 17:10:04'),
(712, 'Meeting', 'meeting-zoom-index', 'Zoom Server Index', 'Meeting Index', 0, '2020-05-04 17:10:04', '2020-05-04 17:10:04'),
(713, 'Meeting', 'sms-email-meeting', 'Send Meeting Alert', 'Meeting Alert Sending', 0, '2020-05-04 17:10:04', '2020-05-04 17:10:04');

-- --------------------------------------------------------

--
-- Table structure for table `permission_role`
--

CREATE TABLE `permission_role` (
  `permission_id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permission_role`
--

INSERT INTO `permission_role` (`permission_id`, `role_id`) VALUES
(1, 1),
(2, 1),
(3, 1),
(4, 1),
(5, 1),
(6, 1),
(7, 1),
(8, 1),
(9, 1),
(10, 1),
(11, 1),
(12, 1),
(13, 1),
(14, 1),
(15, 1),
(16, 1),
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
(35, 1),
(36, 1),
(37, 1),
(38, 1),
(39, 1),
(40, 1),
(41, 1),
(42, 1),
(43, 1),
(44, 1),
(45, 1),
(46, 1),
(47, 1),
(48, 1),
(49, 1),
(50, 1),
(51, 1),
(52, 1),
(53, 1),
(54, 1),
(55, 1),
(56, 1),
(57, 1),
(58, 1),
(59, 1),
(60, 1),
(61, 1),
(62, 1),
(63, 1),
(64, 1),
(65, 1),
(66, 1),
(67, 1),
(68, 1),
(69, 1),
(70, 1),
(71, 1),
(72, 1),
(73, 1),
(74, 1),
(75, 1),
(76, 1),
(77, 1),
(78, 1),
(79, 1),
(80, 1),
(81, 1),
(82, 1),
(83, 1),
(84, 1),
(85, 1),
(86, 1),
(87, 1),
(88, 1),
(89, 1),
(90, 1),
(91, 1),
(92, 1),
(93, 1),
(94, 1),
(95, 1),
(96, 1),
(97, 1),
(98, 1),
(99, 1),
(100, 1),
(101, 1),
(102, 1),
(103, 1),
(104, 1),
(105, 1),
(106, 1),
(107, 1),
(108, 1),
(109, 1),
(110, 1),
(111, 1),
(112, 1),
(113, 1),
(114, 1),
(115, 1),
(116, 1),
(117, 1),
(118, 1),
(119, 1),
(120, 1),
(121, 1),
(122, 1),
(123, 1),
(124, 1),
(125, 1),
(126, 1),
(127, 1),
(128, 1),
(129, 1),
(130, 1),
(131, 1),
(132, 1),
(133, 1),
(134, 1),
(135, 1),
(136, 1),
(137, 1),
(138, 1),
(139, 1),
(140, 1),
(141, 1),
(142, 1),
(143, 1),
(144, 1),
(145, 1),
(146, 1),
(147, 1),
(148, 1),
(149, 1),
(150, 1),
(151, 1),
(152, 1),
(153, 1),
(154, 1),
(155, 1),
(156, 1),
(157, 1),
(158, 1),
(159, 1),
(160, 1),
(161, 1),
(162, 1),
(163, 1),
(164, 1),
(165, 1),
(166, 1),
(167, 1),
(168, 1),
(169, 1),
(170, 1),
(171, 1),
(172, 1),
(173, 1),
(174, 1),
(175, 1),
(176, 1),
(177, 1),
(178, 1),
(179, 1),
(180, 1),
(181, 1),
(182, 1),
(183, 1),
(184, 1),
(185, 1),
(186, 1),
(187, 1),
(188, 1),
(189, 1),
(190, 1),
(191, 1),
(192, 1),
(193, 1),
(194, 1),
(195, 1),
(196, 1),
(197, 1),
(198, 1),
(199, 1),
(200, 1),
(201, 1),
(202, 1),
(203, 1),
(204, 1),
(205, 1),
(206, 1),
(207, 1),
(208, 1),
(209, 1),
(210, 1),
(211, 1),
(212, 1),
(213, 1),
(214, 1),
(215, 1),
(216, 1),
(217, 1),
(218, 1),
(219, 1),
(220, 1),
(221, 1),
(222, 1),
(223, 1),
(224, 1),
(225, 1),
(226, 1),
(227, 1),
(228, 1),
(229, 1),
(230, 1),
(231, 1),
(232, 1),
(233, 1),
(234, 1),
(235, 1),
(236, 1),
(237, 1),
(238, 1),
(239, 1),
(240, 1),
(241, 1),
(242, 1),
(243, 1),
(244, 1),
(245, 1),
(246, 1),
(247, 1),
(248, 1),
(249, 1),
(250, 1),
(251, 1),
(252, 1),
(253, 1),
(254, 1),
(255, 1),
(256, 1),
(257, 1),
(258, 1),
(259, 1),
(260, 1),
(261, 1),
(262, 1),
(263, 1),
(264, 1),
(265, 1),
(266, 1),
(267, 1),
(268, 1),
(269, 1),
(270, 1),
(271, 1),
(272, 1),
(273, 1),
(274, 1),
(275, 1),
(276, 1),
(277, 1),
(278, 1),
(279, 1),
(280, 1),
(281, 1),
(282, 1),
(283, 1),
(284, 1),
(285, 1),
(286, 1),
(287, 1),
(288, 1),
(289, 1),
(290, 1),
(291, 1),
(292, 1),
(293, 1),
(294, 1),
(295, 1),
(296, 1),
(297, 1),
(298, 1),
(299, 1),
(300, 1),
(301, 1),
(302, 1),
(303, 1),
(304, 1),
(305, 1),
(306, 1),
(307, 1),
(308, 1),
(309, 1),
(310, 1),
(311, 1),
(312, 1),
(313, 1),
(314, 1),
(315, 1),
(316, 1),
(317, 1),
(318, 1),
(319, 1),
(320, 1),
(321, 1),
(322, 1),
(323, 1),
(324, 1),
(325, 1),
(326, 1),
(327, 1),
(328, 1),
(329, 1),
(330, 1),
(331, 1),
(332, 1),
(333, 1),
(334, 1),
(335, 1),
(336, 1),
(337, 1),
(338, 1),
(339, 1),
(340, 1),
(341, 1),
(342, 1),
(343, 1),
(344, 1),
(345, 1),
(346, 1),
(347, 1),
(348, 1),
(349, 1),
(350, 1),
(351, 1),
(352, 1),
(353, 1),
(354, 1),
(355, 1),
(356, 1),
(357, 1),
(358, 1),
(359, 1),
(360, 1),
(361, 1),
(362, 1),
(363, 1),
(364, 1),
(365, 1),
(366, 1),
(367, 1),
(368, 1),
(369, 1),
(370, 1),
(371, 1),
(372, 1),
(373, 1),
(374, 1),
(375, 1),
(376, 1),
(377, 1),
(378, 1),
(379, 1),
(380, 1),
(381, 1),
(382, 1),
(383, 1),
(384, 1),
(385, 1),
(386, 1),
(387, 1),
(388, 1),
(389, 1),
(390, 1),
(391, 1),
(392, 1),
(393, 1),
(394, 1),
(395, 1),
(396, 1),
(397, 1),
(398, 1),
(399, 1),
(400, 1),
(401, 1),
(402, 1),
(403, 1),
(404, 1),
(405, 1),
(406, 1),
(407, 1),
(408, 1),
(409, 1),
(410, 1),
(411, 1),
(412, 1),
(413, 1),
(414, 1),
(415, 1),
(416, 1),
(417, 1),
(418, 1),
(419, 1),
(420, 1),
(421, 1),
(422, 1),
(423, 1),
(424, 1),
(425, 1),
(426, 1),
(427, 1),
(428, 1),
(429, 1),
(430, 1),
(431, 1),
(432, 1),
(433, 1),
(434, 1),
(435, 1),
(436, 1),
(437, 1),
(438, 1),
(439, 1),
(440, 1),
(441, 1),
(442, 1),
(443, 1),
(444, 1),
(445, 1),
(446, 1),
(447, 1),
(448, 1),
(449, 1),
(450, 1),
(451, 1),
(452, 1),
(453, 1),
(454, 1),
(455, 1),
(456, 1),
(457, 1),
(458, 1),
(459, 1),
(460, 1),
(461, 1),
(462, 1),
(463, 1),
(464, 1),
(465, 1),
(466, 1),
(467, 1),
(468, 1),
(469, 1),
(470, 1),
(471, 1),
(472, 1),
(473, 1),
(474, 1),
(475, 1),
(476, 1),
(477, 1),
(478, 1),
(479, 1),
(480, 1),
(481, 1),
(482, 1),
(483, 1),
(484, 1),
(485, 1),
(486, 1),
(487, 1),
(488, 1),
(489, 1),
(490, 1),
(491, 1),
(492, 1),
(493, 1),
(494, 1),
(495, 1),
(496, 1),
(497, 1),
(498, 1),
(499, 1),
(500, 1),
(501, 1),
(502, 1),
(503, 1),
(504, 1),
(505, 1),
(506, 1),
(507, 1),
(508, 1),
(509, 1),
(510, 1),
(511, 1),
(512, 1),
(513, 1),
(514, 1),
(515, 1),
(516, 1),
(517, 1),
(518, 1),
(519, 1),
(520, 1),
(521, 1),
(522, 1),
(523, 1),
(524, 1),
(525, 1),
(526, 1),
(527, 1),
(528, 1),
(529, 1),
(530, 1),
(531, 1);

-- --------------------------------------------------------

--
-- Table structure for table `postal_exchanges`
--

CREATE TABLE `postal_exchanges` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` int(10) UNSIGNED NOT NULL,
  `last_updated_by` int(10) UNSIGNED DEFAULT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` datetime NOT NULL,
  `ref_no` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subject` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `to` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `from` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `note` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `attachment` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `postal_exchange_types`
--

CREATE TABLE `postal_exchange_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` int(10) UNSIGNED NOT NULL,
  `last_updated_by` int(10) UNSIGNED DEFAULT NULL,
  `title` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `postal_exchange_types`
--

INSERT INTO `postal_exchange_types` (`id`, `created_at`, `updated_at`, `created_by`, `last_updated_by`, `title`, `status`) VALUES
(1, '2020-05-04 17:10:05', '2020-05-04 17:10:05', 1, NULL, 'LETTER DISPATCH', 1),
(2, '2020-05-04 17:10:05', '2020-05-04 17:10:05', 1, NULL, 'LETTER RECEIVE', 1),
(3, '2020-05-04 17:10:05', '2020-05-04 17:10:05', 1, NULL, 'COURIER RECEIVE', 1);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` int(10) UNSIGNED NOT NULL,
  `last_updated_by` int(10) UNSIGNED DEFAULT NULL,
  `code` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_id` int(10) UNSIGNED DEFAULT 0,
  `sub_category_id` int(10) UNSIGNED DEFAULT 0,
  `warranty` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_image` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product_prices`
--

CREATE TABLE `product_prices` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` int(10) UNSIGNED NOT NULL,
  `last_updated_by` int(10) UNSIGNED DEFAULT NULL,
  `products_id` int(10) UNSIGNED NOT NULL,
  `cost_price` double(10,2) DEFAULT 0.00,
  `sale_price` double(10,2) DEFAULT 0.00,
  `status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `purchases`
--

CREATE TABLE `purchases` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` int(10) UNSIGNED NOT NULL,
  `last_updated_by` int(10) UNSIGNED DEFAULT NULL,
  `invoice_no` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `vendors_id` int(10) UNSIGNED NOT NULL,
  `purchase_date` datetime NOT NULL,
  `grand_total_amount` int(11) NOT NULL,
  `total_discount` int(11) NOT NULL,
  `purchase_details` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `purchase_details`
--

CREATE TABLE `purchase_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` int(10) UNSIGNED NOT NULL,
  `last_updated_by` int(10) UNSIGNED DEFAULT NULL,
  `purchase_id` int(10) UNSIGNED NOT NULL,
  `products_id` int(10) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL,
  `rate` int(11) NOT NULL,
  `total_amount` int(11) NOT NULL,
  `discount` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `purchase_returns`
--

CREATE TABLE `purchase_returns` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` int(10) UNSIGNED NOT NULL,
  `last_updated_by` int(10) UNSIGNED DEFAULT NULL,
  `purchase_date` datetime NOT NULL,
  `invoice_no` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `purchase_id` int(10) UNSIGNED NOT NULL,
  `vendors_id` int(10) UNSIGNED NOT NULL,
  `purchase_detail_id` int(10) UNSIGNED NOT NULL,
  `products_id` int(10) UNSIGNED NOT NULL,
  `qty` int(11) NOT NULL,
  `rate` int(11) NOT NULL,
  `total_amount` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `residents`
--

CREATE TABLE `residents` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` int(10) UNSIGNED NOT NULL,
  `last_updated_by` int(10) UNSIGNED DEFAULT NULL,
  `hostels_id` int(10) UNSIGNED NOT NULL,
  `rooms_id` int(10) UNSIGNED DEFAULT NULL,
  `beds_id` int(10) UNSIGNED DEFAULT NULL,
  `user_type` int(10) UNSIGNED NOT NULL,
  `member_id` int(10) UNSIGNED NOT NULL,
  `register_date` datetime NOT NULL,
  `leave_date` datetime DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `resident_histories`
--

CREATE TABLE `resident_histories` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` int(10) UNSIGNED NOT NULL,
  `last_updated_by` int(10) UNSIGNED DEFAULT NULL,
  `years_id` int(10) UNSIGNED NOT NULL,
  `hostels_id` int(10) UNSIGNED NOT NULL,
  `rooms_id` int(10) UNSIGNED DEFAULT NULL,
  `beds_id` int(10) UNSIGNED DEFAULT NULL,
  `residents_id` int(10) UNSIGNED NOT NULL,
  `history_type` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `display_name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'super-admin', 'Super Admin', 'Super Admin', '2020-05-04 17:10:02', '2020-05-04 17:10:02'),
(2, 'admin', 'Administrator', 'Administrator', '2020-05-04 17:10:02', '2020-05-04 17:10:02'),
(3, 'account', 'Accountant', 'Accountant', '2020-05-04 17:10:02', '2020-05-04 17:10:02'),
(4, 'library', 'Librarian', 'Librarian', '2020-05-04 17:10:02', '2020-05-04 17:10:02'),
(5, 'staff', 'Staff', 'Staff', '2020-05-04 17:10:02', '2020-05-04 17:10:02'),
(6, 'student', 'Student', 'Student', '2020-05-04 17:10:02', '2020-05-04 17:10:02'),
(7, 'guardian', 'Guardian', 'Guardian', '2020-05-04 17:10:02', '2020-05-04 17:10:02'),
(8, 'teacher', 'Teacher', 'Teacher', '2020-05-04 17:10:02', '2020-05-04 17:10:02');

-- --------------------------------------------------------

--
-- Table structure for table `role_user`
--

CREATE TABLE `role_user` (
  `user_id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_user`
--

INSERT INTO `role_user` (`user_id`, `role_id`) VALUES
(1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE `rooms` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` int(10) UNSIGNED NOT NULL,
  `last_updated_by` int(10) UNSIGNED DEFAULT NULL,
  `hostels_id` int(10) UNSIGNED NOT NULL,
  `room_type` int(10) UNSIGNED NOT NULL,
  `room_number` int(11) NOT NULL,
  `rate_perbed` int(11) NOT NULL DEFAULT 0,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `room_types`
--

CREATE TABLE `room_types` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` int(10) UNSIGNED NOT NULL,
  `last_updated_by` int(10) UNSIGNED DEFAULT NULL,
  `title` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `routes`
--

CREATE TABLE `routes` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` int(10) UNSIGNED NOT NULL,
  `last_updated_by` int(10) UNSIGNED DEFAULT NULL,
  `title` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rent` int(11) NOT NULL DEFAULT 0,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `route_vehicles`
--

CREATE TABLE `route_vehicles` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `routes_id` int(10) UNSIGNED NOT NULL,
  `vehicles_id` int(10) UNSIGNED NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `salary_pays`
--

CREATE TABLE `salary_pays` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` int(10) UNSIGNED NOT NULL,
  `last_updated_by` int(10) UNSIGNED DEFAULT NULL,
  `staff_id` int(10) UNSIGNED NOT NULL,
  `salary_masters_id` int(10) UNSIGNED NOT NULL,
  `date` datetime NOT NULL,
  `paid_amount` int(11) NOT NULL,
  `allowance` int(11) DEFAULT NULL,
  `fine` int(11) DEFAULT NULL,
  `payment_mode` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `note` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sales_details`
--

CREATE TABLE `sales_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sales_returns`
--

CREATE TABLE `sales_returns` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `semesters`
--

CREATE TABLE `semesters` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` int(10) UNSIGNED NOT NULL,
  `last_updated_by` int(10) UNSIGNED DEFAULT NULL,
  `semester` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `staff_id` int(10) UNSIGNED DEFAULT NULL,
  `gradingType_id` int(10) UNSIGNED DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `semester_assets`
--

CREATE TABLE `semester_assets` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` int(10) UNSIGNED NOT NULL,
  `last_updated_by` int(10) UNSIGNED DEFAULT NULL,
  `semesters_id` int(10) UNSIGNED NOT NULL,
  `assets_id` int(10) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 0,
  `status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `semester_subject`
--

CREATE TABLE `semester_subject` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` int(10) UNSIGNED NOT NULL,
  `last_updated_by` int(10) UNSIGNED DEFAULT NULL,
  `semester_id` int(10) UNSIGNED NOT NULL,
  `subject_id` int(10) UNSIGNED NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sms_emails`
--

CREATE TABLE `sms_emails` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` int(10) UNSIGNED NOT NULL,
  `last_updated_by` int(10) UNSIGNED DEFAULT NULL,
  `subject` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `message` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `sms` tinyint(1) NOT NULL DEFAULT 0,
  `email` tinyint(1) NOT NULL DEFAULT 0,
  `group` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sms_settings`
--

CREATE TABLE `sms_settings` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `identity` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `logo` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `link` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `config` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sms_settings`
--

INSERT INTO `sms_settings` (`id`, `created_at`, `updated_at`, `identity`, `logo`, `link`, `config`, `status`) VALUES
(1, NULL, NULL, 'Msg91', 'msg91', 'https://msg91.com', '{\"Authkey\":\"\",\"Sender\":\"\",\"Route\":\"\",\"Country\":\"\"}', 0),
(2, NULL, NULL, 'Msg94', 'msg94', 'http://www.msg94.com', '{\"Authkey\":\"\",\"Sender\":\"\",\"Route\":\"\",\"Country\":\"\"}', 0),
(3, NULL, NULL, 'KeswaTech', 'keswasms', 'http://ktsms.keswatech.com', '{\"Sender\":\"\",\"apiKey\":\"\"}', 0),
(4, NULL, NULL, 'Twilio', 'twilio', 'https://www.twilio.com', '{\"SID\":\"\",\"Token\":\"\",\"FromNumber\":\"\"}', 0),
(5, NULL, NULL, 'MessageBird', 'messagebird', 'https://www.messagebird.com', '{\"Originator\":\"\",\"AcccessKey\":\"\"}', 0),
(6, NULL, NULL, 'Clickatell', 'clickatell', 'http://clickatell.com', '{\"API_ID\":\"\",\"User\":\"\",\"Password\":\"\",\"Unicode\":\"0\"}', 0),
(7, NULL, NULL, 'BudgetSmsNet', 'budgetsms', 'https://www.budgetsms.net', '{\"Username\":\"\",\"UserID\":\"\",\"Handle\":\"\",\"From\":\"\"}', 0),
(8, NULL, NULL, 'Nexmo', 'nexmo', 'https://www.nexmo.com', '{\"From\":\"\",\"API_KEY\":\"\",\"API_SECRET\":\"\"}', 0),
(9, NULL, NULL, 'smsCountry', 'smscountry', 'https://www.smscountry.com', '{\"UserName\":\"\",\"Password\":\"\",\"SenderId\":\"\",\"Token\":\"\"}', 0),
(10, NULL, NULL, 'MsgClub', 'msgclub', 'http://msg.msgclub.net', '{\"AUTH_KEY\":\"\",\"senderId\":\"\",\"routeId\":\"\"}', 0),
(11, NULL, NULL, 'Digimiles', 'digimiles', 'http://www.digimiles.in', '{\"UserName\":\"\",\"Password\":\"\",\"Type\":0,\"Sender_ID\":\"\"}', 0),
(12, NULL, NULL, 'Textlocal', 'textlocal', 'https://www.textlocal.in', '{\"apiKey\":\"\",\"sender\":\"\"}', 0),
(13, NULL, NULL, 'SmartSMS', 'smartsms', 'https://smartsmssolutions.com/', '{\"ACCESS_TOKEN\":\"\",\"Sender\":\"\",\"Routing\":\"2\",\"Type\":\"0\"}', 0),
(14, NULL, NULL, 'Sparrow', 'sparrow', 'http://sparrowsms.com', '{\"From\":\"\",\"Token\":\"\"}', 0),
(15, NULL, NULL, 'InitiativeNepal', 'aayosms', 'https://www.ininepal.com', '{\"Sender\":\"\",\"UserName\":\"\",\"Password\":\"\"}', 0),
(16, NULL, NULL, 'SendPK', 'sendpk', 'https://sendpk.com/api.php', '{\"UserName\":\"\",\"Password\":\"\",\"Sender\":\"\",\"Type\":\"\"}', 0),
(17, NULL, NULL, 'LifetimeSMS', 'lifetimesms', 'http://lifetimesms.com', '{\"ApiToken\":\"\",\"ApiSecret\":\"\",\"From\":\"\"}', 0),
(18, NULL, NULL, 'SmsCluster', 'smscluster', 'http://www.smscluster.com', '{\"AUTH_KEY\":\"\",\"senderId\":\"\",\"routeId\":\"\",\"smsContentType\":\"English\"}', 0),
(19, NULL, NULL, 'marketsmsPK', 'marketsms', 'http://www.marketsms.pk', '{\"UserName\":\"\",\"Password\":\"\",\"From\":\"\"}', 0),
(20, NULL, NULL, 'springEdge', 'springedge', 'http://springedge.com', '{\"API_KEY\":\"\",\"SenderID\":\"\"}', 0),
(21, NULL, NULL, 'africastalking', 'africastalking', 'https://africastalking.com', '{\"API_KEY\":\"\",\"UserName\":\"\"}', 0),
(22, NULL, NULL, 'TheSMSCentral', 'thesmscentral', 'https://thesmscentral.com', '{\"ApiToken\":\"\",\"Sender\":\"\"}', 0),
(23, NULL, NULL, 'AakashNepal', 'aakashsms', 'https://aakashsms.com', '{\"AuthToken\":\"\"}', 0),
(24, NULL, NULL, 'FullTimeBulk', 'fulltimesms', 'http://www.sms.fulltimesms.com', '{\"ApiToken\":\"\",\"ApiSecret\":\"\",\"From\":\"\"}', 0);

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` int(10) UNSIGNED NOT NULL,
  `last_updated_by` int(10) UNSIGNED DEFAULT NULL,
  `reg_no` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `join_date` datetime NOT NULL,
  `designation` int(10) UNSIGNED NOT NULL,
  `first_name` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `middle_name` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_name` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `father_name` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mother_name` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_of_birth` datetime NOT NULL,
  `gender` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `blood_group` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nationality` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `state` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `temp_address` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `temp_state` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `temp_country` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `home_phone` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile_1` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile_2` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mother_tongue` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `qualification` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `experience` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `experience_info` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `other_info` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `staff_image` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `staff_designations`
--

CREATE TABLE `staff_designations` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` int(10) UNSIGNED NOT NULL,
  `last_updated_by` int(10) UNSIGNED DEFAULT NULL,
  `title` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `stocks`
--

CREATE TABLE `stocks` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` int(10) UNSIGNED NOT NULL,
  `last_updated_by` int(10) UNSIGNED DEFAULT NULL,
  `products_id` int(10) UNSIGNED NOT NULL,
  `transaction_type` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date` datetime NOT NULL,
  `qty_in` int(11) DEFAULT 0,
  `qty_out` int(11) DEFAULT 0,
  `status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` int(10) UNSIGNED NOT NULL,
  `last_updated_by` int(10) UNSIGNED DEFAULT NULL,
  `reg_no` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `reg_date` datetime NOT NULL,
  `university_reg` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `faculty` int(10) UNSIGNED DEFAULT NULL,
  `semester` int(10) UNSIGNED DEFAULT NULL,
  `academic_status` int(10) UNSIGNED DEFAULT NULL,
  `batch` int(10) UNSIGNED DEFAULT NULL,
  `first_name` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `middle_name` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_name` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_of_birth` datetime NOT NULL,
  `gender` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `blood_group` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `religion` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `caste` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nationality` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mother_tongue` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `extra_info` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `student_image` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `student_signature` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `student_batches`
--

CREATE TABLE `student_batches` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` int(10) UNSIGNED NOT NULL,
  `last_updated_by` int(10) UNSIGNED DEFAULT NULL,
  `title` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `student_guardians`
--

CREATE TABLE `student_guardians` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `students_id` int(10) UNSIGNED NOT NULL,
  `guardians_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `student_statuses`
--

CREATE TABLE `student_statuses` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` int(10) UNSIGNED NOT NULL,
  `last_updated_by` int(10) UNSIGNED DEFAULT NULL,
  `title` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `student_statuses`
--

INSERT INTO `student_statuses` (`id`, `created_at`, `updated_at`, `created_by`, `last_updated_by`, `title`, `status`) VALUES
(1, '2020-05-04 17:10:05', '2020-05-04 17:10:05', 1, 1, 'New Admission', 1),
(2, '2020-05-04 17:10:05', '2020-05-04 17:10:05', 1, 1, 'Continue', 1),
(3, '2020-05-04 17:10:05', '2020-05-04 17:10:05', 1, 1, 'Pass Out', 1),
(4, '2020-05-04 17:10:05', '2020-05-04 17:10:05', 1, 1, 'Back Continue', 1),
(5, '2020-05-04 17:10:05', '2020-05-04 17:10:05', 1, 1, 'Drop Out', 1),
(6, '2020-05-04 17:10:05', '2020-05-04 17:10:05', 1, 1, 'Transfer in', 1),
(7, '2020-05-04 17:10:05', '2020-05-04 17:10:05', 1, 1, 'Transfer Out', 1),
(8, '2020-05-04 17:10:05', '2020-05-04 17:10:05', 1, 1, 'Online Registration', 1);

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE `subjects` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` int(10) UNSIGNED NOT NULL,
  `last_updated_by` int(10) UNSIGNED DEFAULT NULL,
  `title` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `full_mark_theory` int(11) DEFAULT NULL,
  `pass_mark_theory` int(11) DEFAULT NULL,
  `full_mark_practical` int(11) DEFAULT NULL,
  `pass_mark_practical` int(11) DEFAULT NULL,
  `credit_hour` int(11) DEFAULT NULL,
  `sub_type` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `class_type` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `staff_id` int(10) UNSIGNED DEFAULT NULL,
  `description` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `subject_attendances`
--

CREATE TABLE `subject_attendances` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` int(10) UNSIGNED NOT NULL,
  `last_updated_by` int(10) UNSIGNED DEFAULT NULL,
  `link_id` int(10) UNSIGNED NOT NULL,
  `subjects_id` int(10) UNSIGNED NOT NULL,
  `attendance_type` int(11) NOT NULL,
  `years_id` int(10) UNSIGNED NOT NULL,
  `months_id` int(10) UNSIGNED NOT NULL,
  `day_1` int(11) NOT NULL DEFAULT 0,
  `day_2` int(11) NOT NULL DEFAULT 0,
  `day_3` int(11) NOT NULL DEFAULT 0,
  `day_4` int(11) NOT NULL DEFAULT 0,
  `day_5` int(11) NOT NULL DEFAULT 0,
  `day_6` int(11) NOT NULL DEFAULT 0,
  `day_7` int(11) NOT NULL DEFAULT 0,
  `day_8` int(11) NOT NULL DEFAULT 0,
  `day_9` int(11) NOT NULL DEFAULT 0,
  `day_10` int(11) NOT NULL DEFAULT 0,
  `day_11` int(11) NOT NULL DEFAULT 0,
  `day_12` int(11) NOT NULL DEFAULT 0,
  `day_13` int(11) NOT NULL DEFAULT 0,
  `day_14` int(11) NOT NULL DEFAULT 0,
  `day_15` int(11) NOT NULL DEFAULT 0,
  `day_16` int(11) NOT NULL DEFAULT 0,
  `day_17` int(11) NOT NULL DEFAULT 0,
  `day_18` int(11) NOT NULL DEFAULT 0,
  `day_19` int(11) NOT NULL DEFAULT 0,
  `day_20` int(11) NOT NULL DEFAULT 0,
  `day_21` int(11) NOT NULL DEFAULT 0,
  `day_22` int(11) NOT NULL DEFAULT 0,
  `day_23` int(11) NOT NULL DEFAULT 0,
  `day_24` int(11) NOT NULL DEFAULT 0,
  `day_25` int(11) NOT NULL DEFAULT 0,
  `day_26` int(11) NOT NULL DEFAULT 0,
  `day_27` int(11) NOT NULL DEFAULT 0,
  `day_28` int(11) NOT NULL DEFAULT 0,
  `day_29` int(11) NOT NULL DEFAULT 0,
  `day_30` int(11) NOT NULL DEFAULT 0,
  `day_31` int(11) NOT NULL DEFAULT 0,
  `day_32` int(11) NOT NULL DEFAULT 0,
  `status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sub_categories`
--

CREATE TABLE `sub_categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` int(10) UNSIGNED NOT NULL,
  `last_updated_by` int(10) UNSIGNED DEFAULT NULL,
  `category_id` int(10) UNSIGNED NOT NULL,
  `title` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `time_zones`
--

CREATE TABLE `time_zones` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `timezone` varchar(35) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `time_zones`
--

INSERT INTO `time_zones` (`id`, `created_at`, `updated_at`, `timezone`, `status`) VALUES
(1, NULL, NULL, 'Africa/Abidjan', 0),
(2, NULL, NULL, 'Africa/Accra', 0),
(3, NULL, NULL, 'Africa/Addis_Ababa', 0),
(4, NULL, NULL, 'Africa/Algiers', 0),
(5, NULL, NULL, 'Africa/Asmara', 0),
(6, NULL, NULL, 'Africa/Asmera', 0),
(7, NULL, NULL, 'Africa/Bamako', 0),
(8, NULL, NULL, 'Africa/Bangui', 0),
(9, NULL, NULL, 'Africa/Banjul', 0),
(10, NULL, NULL, 'Africa/Bissau', 0),
(11, NULL, NULL, 'Africa/Blantyre', 0),
(12, NULL, NULL, 'Africa/Brazzaville', 0),
(13, NULL, NULL, 'Africa/Bujumbura', 0),
(14, NULL, NULL, 'Africa/Cairo', 0),
(15, NULL, NULL, 'Africa/Casablanca', 0),
(16, NULL, NULL, 'Africa/Ceuta', 0),
(17, NULL, NULL, 'Africa/Conakry', 0),
(18, NULL, NULL, 'Africa/Dakar', 0),
(19, NULL, NULL, 'Africa/Dar_es_Salaam', 0),
(20, NULL, NULL, 'Africa/Djibouti', 0),
(21, NULL, NULL, 'Africa/Douala', 0),
(22, NULL, NULL, 'Africa/El_Aaiun', 0),
(23, NULL, NULL, 'Africa/Freetown', 0),
(24, NULL, NULL, 'Africa/Gaborone', 0),
(25, NULL, NULL, 'Africa/Harare', 0),
(26, NULL, NULL, 'Africa/Johannesburg', 0),
(27, NULL, NULL, 'Africa/Juba', 0),
(28, NULL, NULL, 'Africa/Kampala', 0),
(29, NULL, NULL, 'Africa/Khartoum', 0),
(30, NULL, NULL, 'Africa/Kigali', 0),
(31, NULL, NULL, 'Africa/Kinshasa', 0),
(32, NULL, NULL, 'Africa/Lagos', 0),
(33, NULL, NULL, 'Africa/Libreville', 0),
(34, NULL, NULL, 'Africa/Lome', 0),
(35, NULL, NULL, 'Africa/Luanda', 0),
(36, NULL, NULL, 'Africa/Lubumbashi', 0),
(37, NULL, NULL, 'Africa/Lusaka', 0),
(38, NULL, NULL, 'Africa/Malabo', 0),
(39, NULL, NULL, 'Africa/Maputo', 0),
(40, NULL, NULL, 'Africa/Maseru', 0),
(41, NULL, NULL, 'Africa/Mbabane', 0),
(42, NULL, NULL, 'Africa/Mogadishu', 0),
(43, NULL, NULL, 'Africa/Monrovia', 0),
(44, NULL, NULL, 'Africa/Nairobi', 0),
(45, NULL, NULL, 'Africa/Ndjamena', 0),
(46, NULL, NULL, 'Africa/Niamey', 0),
(47, NULL, NULL, 'Africa/Nouakchott', 0),
(48, NULL, NULL, 'Africa/Ouagadougou', 0),
(49, NULL, NULL, 'Africa/Porto-Novo', 0),
(50, NULL, NULL, 'Africa/Sao_Tome', 0),
(51, NULL, NULL, 'Africa/Timbuktu', 0),
(52, NULL, NULL, 'Africa/Tripoli', 0),
(53, NULL, NULL, 'Africa/Tunis', 0),
(54, NULL, NULL, 'Africa/Windhoek', 0),
(55, NULL, NULL, 'America/Adak', 0),
(56, NULL, NULL, 'America/Anchorage', 0),
(57, NULL, NULL, 'America/Anguilla', 0),
(58, NULL, NULL, 'America/Antigua', 0),
(59, NULL, NULL, 'America/Araguaina', 0),
(60, NULL, NULL, 'America/Argentina/Buenos_Aires', 0),
(61, NULL, NULL, 'America/Argentina/Catamarca', 0),
(62, NULL, NULL, 'America/Argentina/ComodRivadavia', 0),
(63, NULL, NULL, 'America/Argentina/Cordoba', 0),
(64, NULL, NULL, 'America/Argentina/Jujuy', 0),
(65, NULL, NULL, 'America/Argentina/La_Rioja', 0),
(66, NULL, NULL, 'America/Argentina/Mendoza', 0),
(67, NULL, NULL, 'America/Argentina/Rio_Gallegos', 0),
(68, NULL, NULL, 'America/Argentina/Salta', 0),
(69, NULL, NULL, 'America/Argentina/San_Juan', 0),
(70, NULL, NULL, 'America/Argentina/San_Luis', 0),
(71, NULL, NULL, 'America/Argentina/Tucuman', 0),
(72, NULL, NULL, 'America/Argentina/Ushuaia', 0),
(73, NULL, NULL, 'America/Aruba', 0),
(74, NULL, NULL, 'America/Asuncion', 0),
(75, NULL, NULL, 'America/Atikokan', 0),
(76, NULL, NULL, 'America/Atka', 0),
(77, NULL, NULL, 'America/Bahia', 0),
(78, NULL, NULL, 'America/Bahia_Banderas', 0),
(79, NULL, NULL, 'America/Barbados', 0),
(80, NULL, NULL, 'America/Belem', 0),
(81, NULL, NULL, 'America/Belize', 0),
(82, NULL, NULL, 'America/Blanc-Sablon', 0),
(83, NULL, NULL, 'America/Boa_Vista', 0),
(84, NULL, NULL, 'America/Bogota', 0),
(85, NULL, NULL, 'America/Boise', 0),
(86, NULL, NULL, 'America/Buenos_Aires', 0),
(87, NULL, NULL, 'America/Cambridge_Bay', 0),
(88, NULL, NULL, 'America/Campo_Grande', 0),
(89, NULL, NULL, 'America/Cancun', 0),
(90, NULL, NULL, 'America/Caracas', 0),
(91, NULL, NULL, 'America/Catamarca', 0),
(92, NULL, NULL, 'America/Cayenne', 0),
(93, NULL, NULL, 'America/Cayman', 0),
(94, NULL, NULL, 'America/Chicago', 0),
(95, NULL, NULL, 'America/Chihuahua', 0),
(96, NULL, NULL, 'America/Coral_Harbour', 0),
(97, NULL, NULL, 'America/Cordoba', 0),
(98, NULL, NULL, 'America/Costa_Rica', 0),
(99, NULL, NULL, 'America/Creston', 0),
(100, NULL, NULL, 'America/Cuiaba', 0),
(101, NULL, NULL, 'America/Curacao', 0),
(102, NULL, NULL, 'America/Danmarkshavn', 0),
(103, NULL, NULL, 'America/Dawson', 0),
(104, NULL, NULL, 'America/Dawson_Creek', 0),
(105, NULL, NULL, 'America/Denver', 0),
(106, NULL, NULL, 'America/Detroit', 0),
(107, NULL, NULL, 'America/Dominica', 0),
(108, NULL, NULL, 'America/Edmonton', 0),
(109, NULL, NULL, 'America/Eirunepe', 0),
(110, NULL, NULL, 'America/El_Salvador', 0),
(111, NULL, NULL, 'America/Ensenada', 0),
(112, NULL, NULL, 'America/Fort_Wayne', 0),
(113, NULL, NULL, 'America/Fortaleza', 0),
(114, NULL, NULL, 'America/Glace_Bay', 0),
(115, NULL, NULL, 'America/Godthab', 0),
(116, NULL, NULL, 'America/Goose_Bay', 0),
(117, NULL, NULL, 'America/Grand_Turk', 0),
(118, NULL, NULL, 'America/Grenada', 0),
(119, NULL, NULL, 'America/Guadeloupe', 0),
(120, NULL, NULL, 'America/Guatemala', 0),
(121, NULL, NULL, 'America/Guayaquil', 0),
(122, NULL, NULL, 'America/Guyana', 0),
(123, NULL, NULL, 'America/Halifax', 0),
(124, NULL, NULL, 'America/Havana', 0),
(125, NULL, NULL, 'America/Hermosillo', 0),
(126, NULL, NULL, 'America/Indiana/Indianapolis', 0),
(127, NULL, NULL, 'America/Indiana/Knox', 0),
(128, NULL, NULL, 'America/Indiana/Marengo', 0),
(129, NULL, NULL, 'America/Indiana/Petersburg', 0),
(130, NULL, NULL, 'America/Indiana/Tell_City', 0),
(131, NULL, NULL, 'America/Indiana/Vevay', 0),
(132, NULL, NULL, 'America/Indiana/Vincennes', 0),
(133, NULL, NULL, 'America/Indiana/Winamac', 0),
(134, NULL, NULL, 'America/Indianapolis', 0),
(135, NULL, NULL, 'America/Inuvik', 0),
(136, NULL, NULL, 'America/Iqaluit', 0),
(137, NULL, NULL, 'America/Jamaica', 0),
(138, NULL, NULL, 'America/Jujuy', 0),
(139, NULL, NULL, 'America/Juneau', 0),
(140, NULL, NULL, 'America/Kentucky/Louisville', 0),
(141, NULL, NULL, 'America/Kentucky/Monticello', 0),
(142, NULL, NULL, 'America/Knox_IN', 0),
(143, NULL, NULL, 'America/Kralendijk', 0),
(144, NULL, NULL, 'America/La_Paz', 0),
(145, NULL, NULL, 'America/Lima', 0),
(146, NULL, NULL, 'America/Los_Angeles', 0),
(147, NULL, NULL, 'America/Louisville', 0),
(148, NULL, NULL, 'America/Lower_Princes', 0),
(149, NULL, NULL, 'America/Maceio', 0),
(150, NULL, NULL, 'America/Managua', 0),
(151, NULL, NULL, 'America/Manaus', 0),
(152, NULL, NULL, 'America/Marigot', 0),
(153, NULL, NULL, 'America/Martinique', 0),
(154, NULL, NULL, 'America/Matamoros', 0),
(155, NULL, NULL, 'America/Mazatlan', 0),
(156, NULL, NULL, 'America/Mendoza', 0),
(157, NULL, NULL, 'America/Menominee', 0),
(158, NULL, NULL, 'America/Merida', 0),
(159, NULL, NULL, 'America/Metlakatla', 0),
(160, NULL, NULL, 'America/Mexico_City', 0),
(161, NULL, NULL, 'America/Miquelon', 0),
(162, NULL, NULL, 'America/Moncton', 0),
(163, NULL, NULL, 'America/Monterrey', 0),
(164, NULL, NULL, 'America/Montevideo', 0),
(165, NULL, NULL, 'America/Montreal', 0),
(166, NULL, NULL, 'America/Montserrat', 0),
(167, NULL, NULL, 'America/Nassau', 0),
(168, NULL, NULL, 'America/New_York', 0),
(169, NULL, NULL, 'America/Nipigon', 0),
(170, NULL, NULL, 'America/Nome', 0),
(171, NULL, NULL, 'America/Noronha', 0),
(172, NULL, NULL, 'America/North_Dakota/Beulah', 0),
(173, NULL, NULL, 'America/North_Dakota/Center', 0),
(174, NULL, NULL, 'America/North_Dakota/New_Salem', 0),
(175, NULL, NULL, 'America/Ojinaga', 0),
(176, NULL, NULL, 'America/Panama', 0),
(177, NULL, NULL, 'America/Pangnirtung', 0),
(178, NULL, NULL, 'America/Paramaribo', 0),
(179, NULL, NULL, 'America/Phoenix', 0),
(180, NULL, NULL, 'America/Port-au-Prince', 0),
(181, NULL, NULL, 'America/Port_of_Spain', 0),
(182, NULL, NULL, 'America/Porto_Acre', 0),
(183, NULL, NULL, 'America/Porto_Velho', 0),
(184, NULL, NULL, 'America/Puerto_Rico', 0),
(185, NULL, NULL, 'America/Rainy_River', 0),
(186, NULL, NULL, 'America/Rankin_Inlet', 0),
(187, NULL, NULL, 'America/Recife', 0),
(188, NULL, NULL, 'America/Regina', 0),
(189, NULL, NULL, 'America/Resolute', 0),
(190, NULL, NULL, 'America/Rio_Branco', 0),
(191, NULL, NULL, 'America/Rosario', 0),
(192, NULL, NULL, 'America/Santa_Isabel', 0),
(193, NULL, NULL, 'America/Santarem', 0),
(194, NULL, NULL, 'America/Santiago', 0),
(195, NULL, NULL, 'America/Santo_Domingo', 0),
(196, NULL, NULL, 'America/Sao_Paulo', 0),
(197, NULL, NULL, 'America/Scoresbysund', 0),
(198, NULL, NULL, 'America/Shiprock', 0),
(199, NULL, NULL, 'America/Sitka', 0),
(200, NULL, NULL, 'America/St_Barthelemy', 0),
(201, NULL, NULL, 'America/St_Johns', 0),
(202, NULL, NULL, 'America/St_Kitts', 0),
(203, NULL, NULL, 'America/St_Lucia', 0),
(204, NULL, NULL, 'America/St_Thomas', 0),
(205, NULL, NULL, 'America/St_Vincent', 0),
(206, NULL, NULL, 'America/Swift_Current', 0),
(207, NULL, NULL, 'America/Tegucigalpa', 0),
(208, NULL, NULL, 'America/Thule', 0),
(209, NULL, NULL, 'America/Thunder_Bay', 0),
(210, NULL, NULL, 'America/Tijuana', 0),
(211, NULL, NULL, 'America/Toronto', 0),
(212, NULL, NULL, 'America/Tortola', 0),
(213, NULL, NULL, 'America/Vancouver', 0),
(214, NULL, NULL, 'America/Virgin', 0),
(215, NULL, NULL, 'America/Whitehorse', 0),
(216, NULL, NULL, 'America/Winnipeg', 0),
(217, NULL, NULL, 'America/Yakutat', 0),
(218, NULL, NULL, 'America/Yellowknife', 0),
(219, NULL, NULL, 'Antarctica/Casey', 0),
(220, NULL, NULL, 'Antarctica/Davis', 0),
(221, NULL, NULL, 'Antarctica/DumontDUrville', 0),
(222, NULL, NULL, 'Antarctica/Macquarie', 0),
(223, NULL, NULL, 'Antarctica/Mawson', 0),
(224, NULL, NULL, 'Antarctica/McMurdo', 0),
(225, NULL, NULL, 'Antarctica/Palmer', 0),
(226, NULL, NULL, 'Antarctica/Rothera', 0),
(227, NULL, NULL, 'Antarctica/South_Pole', 0),
(228, NULL, NULL, 'Antarctica/Syowa', 0),
(229, NULL, NULL, 'Antarctica/Vostok', 0),
(230, NULL, NULL, 'Arctic/Longyearbyen', 0),
(231, NULL, NULL, 'Asia/Aden', 0),
(232, NULL, NULL, 'Asia/Almaty', 0),
(233, NULL, NULL, 'Asia/Amman', 0),
(234, NULL, NULL, 'Asia/Anadyr', 0),
(235, NULL, NULL, 'Asia/Aqtau', 0),
(236, NULL, NULL, 'Asia/Aqtobe', 0),
(237, NULL, NULL, 'Asia/Ashgabat', 0),
(238, NULL, NULL, 'Asia/Ashkhabad', 0),
(239, NULL, NULL, 'Asia/Baghdad', 0),
(240, NULL, NULL, 'Asia/Bahrain', 0),
(241, NULL, NULL, 'Asia/Baku', 0),
(242, NULL, NULL, 'Asia/Bangkok', 0),
(243, NULL, NULL, 'Asia/Beirut', 0),
(244, NULL, NULL, 'Asia/Bishkek', 0),
(245, NULL, NULL, 'Asia/Brunei', 0),
(246, NULL, NULL, 'Asia/Calcutta', 0),
(247, NULL, NULL, 'Asia/Choibalsan', 0),
(248, NULL, NULL, 'Asia/Chongqing', 0),
(249, NULL, NULL, 'Asia/Chungking', 0),
(250, NULL, NULL, 'Asia/Colombo', 0),
(251, NULL, NULL, 'Asia/Dacca', 0),
(252, NULL, NULL, 'Asia/Damascus', 0),
(253, NULL, NULL, 'Asia/Dhaka', 0),
(254, NULL, NULL, 'Asia/Dili', 0),
(255, NULL, NULL, 'Asia/Dubai', 0),
(256, NULL, NULL, 'Asia/Dushanbe', 0),
(257, NULL, NULL, 'Asia/Gaza', 0),
(258, NULL, NULL, 'Asia/Harbin', 0),
(259, NULL, NULL, 'Asia/Hebron', 0),
(260, NULL, NULL, 'Asia/Ho_Chi_Minh', 0),
(261, NULL, NULL, 'Asia/Hong_Kong', 0),
(262, NULL, NULL, 'Asia/Hovd', 0),
(263, NULL, NULL, 'Asia/Irkutsk', 0),
(264, NULL, NULL, 'Asia/Istanbul', 0),
(265, NULL, NULL, 'Asia/Jakarta', 0),
(266, NULL, NULL, 'Asia/Jayapura', 0),
(267, NULL, NULL, 'Asia/Jerusalem', 0),
(268, NULL, NULL, 'Asia/Kabul', 0),
(269, NULL, NULL, 'Asia/Kamchatka', 0),
(270, NULL, NULL, 'Asia/Karachi', 0),
(271, NULL, NULL, 'Asia/Kashgar', 0),
(272, NULL, NULL, 'Asia/Kathmandu', 0),
(273, NULL, NULL, 'Asia/Khandyga', 0),
(274, NULL, NULL, 'Asia/Kolkata', 0),
(275, NULL, NULL, 'Asia/Krasnoyarsk', 0),
(276, NULL, NULL, 'Asia/Kuala_Lumpur', 0),
(277, NULL, NULL, 'Asia/Kuching', 0),
(278, NULL, NULL, 'Asia/Kuwait', 0),
(279, NULL, NULL, 'Asia/Macao', 0),
(280, NULL, NULL, 'Asia/Macau', 0),
(281, NULL, NULL, 'Asia/Magadan', 0),
(282, NULL, NULL, 'Asia/Makassar', 0),
(283, NULL, NULL, 'Asia/Manila', 0),
(284, NULL, NULL, 'Asia/Muscat', 0),
(285, NULL, NULL, 'Asia/Nicosia', 0),
(286, NULL, NULL, 'Asia/Novokuznetsk', 0),
(287, NULL, NULL, 'Asia/Novosibirsk', 0),
(288, NULL, NULL, 'Asia/Omsk', 0),
(289, NULL, NULL, 'Asia/Oral', 0),
(290, NULL, NULL, 'Asia/Phnom_Penh', 0),
(291, NULL, NULL, 'Asia/Pontianak', 0),
(292, NULL, NULL, 'Asia/Pyongyang', 0),
(293, NULL, NULL, 'Asia/Qatar', 0),
(294, NULL, NULL, 'Asia/Qyzylorda', 0),
(295, NULL, NULL, 'Asia/Rangoon', 0),
(296, NULL, NULL, 'Asia/Riyadh', 0),
(297, NULL, NULL, 'Asia/Saigon', 0),
(298, NULL, NULL, 'Asia/Sakhalin', 0),
(299, NULL, NULL, 'Asia/Samarkand', 0),
(300, NULL, NULL, 'Asia/Seoul', 0),
(301, NULL, NULL, 'Asia/Shanghai', 0),
(302, NULL, NULL, 'Asia/Singapore', 0),
(303, NULL, NULL, 'Asia/Taipei', 0),
(304, NULL, NULL, 'Asia/Tashkent', 0),
(305, NULL, NULL, 'Asia/Tbilisi', 0),
(306, NULL, NULL, 'Asia/Tehran', 0),
(307, NULL, NULL, 'Asia/Tel_Aviv', 0),
(308, NULL, NULL, 'Asia/Thimbu', 0),
(309, NULL, NULL, 'Asia/Thimphu', 0),
(310, NULL, NULL, 'Asia/Tokyo', 0),
(311, NULL, NULL, 'Asia/Ujung_Pandang', 0),
(312, NULL, NULL, 'Asia/Ulaanbaatar', 0),
(313, NULL, NULL, 'Asia/Ulan_Bator', 0),
(314, NULL, NULL, 'Asia/Urumqi', 0),
(315, NULL, NULL, 'Asia/Ust-Nera', 0),
(316, NULL, NULL, 'Asia/Vientiane', 0),
(317, NULL, NULL, 'Asia/Vladivostok', 0),
(318, NULL, NULL, 'Asia/Yakutsk', 0),
(319, NULL, NULL, 'Asia/Yekaterinburg', 0),
(320, NULL, NULL, 'Asia/Yerevan', 0),
(321, NULL, NULL, 'Atlantic/Azores', 0),
(322, NULL, NULL, 'Atlantic/Bermuda', 0),
(323, NULL, NULL, 'Atlantic/Canary', 0),
(324, NULL, NULL, 'Atlantic/Cape_Verde', 0),
(325, NULL, NULL, 'Atlantic/Faeroe', 0),
(326, NULL, NULL, 'Atlantic/Faroe', 0),
(327, NULL, NULL, 'Atlantic/Jan_Mayen', 0),
(328, NULL, NULL, 'Atlantic/Madeira', 0),
(329, NULL, NULL, 'Atlantic/Reykjavik', 0),
(330, NULL, NULL, 'Atlantic/South_Georgia', 0),
(331, NULL, NULL, 'Atlantic/St_Helena', 0),
(332, NULL, NULL, 'Atlantic/Stanley', 0),
(333, NULL, NULL, 'Australia/ACT', 0),
(334, NULL, NULL, 'Australia/Adelaide', 0),
(335, NULL, NULL, 'Australia/Brisbane', 0),
(336, NULL, NULL, 'Australia/Broken_Hill', 0),
(337, NULL, NULL, 'Australia/Canberra', 0),
(338, NULL, NULL, 'Australia/Currie', 0),
(339, NULL, NULL, 'Australia/Darwin', 0),
(340, NULL, NULL, 'Australia/Eucla', 0),
(341, NULL, NULL, 'Australia/Hobart', 0),
(342, NULL, NULL, 'Australia/LHI', 0),
(343, NULL, NULL, 'Australia/Lindeman', 0),
(344, NULL, NULL, 'Australia/Lord_Howe', 0),
(345, NULL, NULL, 'Australia/Melbourne', 0),
(346, NULL, NULL, 'Australia/North', 0),
(347, NULL, NULL, 'Australia/NSW', 0),
(348, NULL, NULL, 'Australia/Perth', 0),
(349, NULL, NULL, 'Australia/Queensland', 0),
(350, NULL, NULL, 'Australia/South', 0),
(351, NULL, NULL, 'Australia/Sydney', 0),
(352, NULL, NULL, 'Australia/Tasmania', 0),
(353, NULL, NULL, 'Australia/Victoria', 0),
(354, NULL, NULL, 'Australia/West', 0),
(355, NULL, NULL, 'Australia/Yancowinna', 0),
(356, NULL, NULL, 'Europe/Amsterdam', 0),
(357, NULL, NULL, 'Europe/Andorra', 0),
(358, NULL, NULL, 'Europe/Athens', 0),
(359, NULL, NULL, 'Europe/Belfast', 0),
(360, NULL, NULL, 'Europe/Belgrade', 0),
(361, NULL, NULL, 'Europe/Berlin', 0),
(362, NULL, NULL, 'Europe/Bratislava', 0),
(363, NULL, NULL, 'Europe/Brussels', 0),
(364, NULL, NULL, 'Europe/Bucharest', 0),
(365, NULL, NULL, 'Europe/Budapest', 0),
(366, NULL, NULL, 'Europe/Busingen', 0),
(367, NULL, NULL, 'Europe/Chisinau', 0),
(368, NULL, NULL, 'Europe/Copenhagen', 0),
(369, NULL, NULL, 'Europe/Dublin', 0),
(370, NULL, NULL, 'Europe/Gibraltar', 0),
(371, NULL, NULL, 'Europe/Guernsey', 0),
(372, NULL, NULL, 'Europe/Helsinki', 0),
(373, NULL, NULL, 'Europe/Isle_of_Man', 0),
(374, NULL, NULL, 'Europe/Istanbul', 0),
(375, NULL, NULL, 'Europe/Jersey', 0),
(376, NULL, NULL, 'Europe/Kaliningrad', 0),
(377, NULL, NULL, 'Europe/Kiev', 0),
(378, NULL, NULL, 'Europe/Lisbon', 0),
(379, NULL, NULL, 'Europe/Ljubljana', 0),
(380, NULL, NULL, 'Europe/London', 0),
(381, NULL, NULL, 'Europe/Luxembourg', 0),
(382, NULL, NULL, 'Europe/Madrid', 0),
(383, NULL, NULL, 'Europe/Malta', 0),
(384, NULL, NULL, 'Europe/Mariehamn', 0),
(385, NULL, NULL, 'Europe/Minsk', 0),
(386, NULL, NULL, 'Europe/Monaco', 0),
(387, NULL, NULL, 'Europe/Moscow', 0),
(388, NULL, NULL, 'Europe/Nicosia', 0),
(389, NULL, NULL, 'Europe/Oslo', 0),
(390, NULL, NULL, 'Europe/Paris', 0),
(391, NULL, NULL, 'Europe/Podgorica', 0),
(392, NULL, NULL, 'Europe/Prague', 0),
(393, NULL, NULL, 'Europe/Riga', 0),
(394, NULL, NULL, 'Europe/Rome', 0),
(395, NULL, NULL, 'Europe/Samara', 0),
(396, NULL, NULL, 'Europe/San_Marino', 0),
(397, NULL, NULL, 'Europe/Sarajevo', 0),
(398, NULL, NULL, 'Europe/Simferopol', 0),
(399, NULL, NULL, 'Europe/Skopje', 0),
(400, NULL, NULL, 'Europe/Sofia', 0),
(401, NULL, NULL, 'Europe/Stockholm', 0),
(402, NULL, NULL, 'Europe/Tallinn', 0),
(403, NULL, NULL, 'Europe/Tirane', 0),
(404, NULL, NULL, 'Europe/Tiraspol', 0),
(405, NULL, NULL, 'Europe/Uzhgorod', 0),
(406, NULL, NULL, 'Europe/Vaduz', 0),
(407, NULL, NULL, 'Europe/Vatican', 0),
(408, NULL, NULL, 'Europe/Vienna', 0),
(409, NULL, NULL, 'Europe/Vilnius', 0),
(410, NULL, NULL, 'Europe/Volgograd', 0),
(411, NULL, NULL, 'Europe/Warsaw', 0),
(412, NULL, NULL, 'Europe/Zagreb', 0),
(413, NULL, NULL, 'Europe/Zaporozhye', 0),
(414, NULL, NULL, 'Europe/Zurich', 0),
(415, NULL, NULL, 'Indian/Antananarivo', 0),
(416, NULL, NULL, 'Indian/Chagos', 0),
(417, NULL, NULL, 'Indian/Christmas', 0),
(418, NULL, NULL, 'Indian/Cocos', 0),
(419, NULL, NULL, 'Indian/Comoro', 0),
(420, NULL, NULL, 'Indian/Kerguelen', 0),
(421, NULL, NULL, 'Indian/Mahe', 0),
(422, NULL, NULL, 'Indian/Maldives', 0),
(423, NULL, NULL, 'Indian/Mauritius', 0),
(424, NULL, NULL, 'Indian/Mayotte', 0),
(425, NULL, NULL, 'Indian/Reunion', 0),
(426, NULL, NULL, 'Pacific/Apia', 0),
(427, NULL, NULL, 'Pacific/Auckland', 0),
(428, NULL, NULL, 'Pacific/Chatham', 0),
(429, NULL, NULL, 'Pacific/Chuuk', 0),
(430, NULL, NULL, 'Pacific/Easter', 0),
(431, NULL, NULL, 'Pacific/Efate', 0),
(432, NULL, NULL, 'Pacific/Enderbury', 0),
(433, NULL, NULL, 'Pacific/Fakaofo', 0),
(434, NULL, NULL, 'Pacific/Fiji', 0),
(435, NULL, NULL, 'Pacific/Funafuti', 0),
(436, NULL, NULL, 'Pacific/Galapagos', 0),
(437, NULL, NULL, 'Pacific/Gambier', 0),
(438, NULL, NULL, 'Pacific/Guadalcanal', 0),
(439, NULL, NULL, 'Pacific/Guam', 0),
(440, NULL, NULL, 'Pacific/Honolulu', 0),
(441, NULL, NULL, 'Pacific/Johnston', 0),
(442, NULL, NULL, 'Pacific/Kiritimati', 0),
(443, NULL, NULL, 'Pacific/Kosrae', 0),
(444, NULL, NULL, 'Pacific/Kwajalein', 0),
(445, NULL, NULL, 'Pacific/Majuro', 0),
(446, NULL, NULL, 'Pacific/Marquesas', 0),
(447, NULL, NULL, 'Pacific/Midway', 0),
(448, NULL, NULL, 'Pacific/Nauru', 0),
(449, NULL, NULL, 'Pacific/Niue', 0),
(450, NULL, NULL, 'Pacific/Norfolk', 0),
(451, NULL, NULL, 'Pacific/Noumea', 0),
(452, NULL, NULL, 'Pacific/Pago_Pago', 0),
(453, NULL, NULL, 'Pacific/Palau', 0),
(454, NULL, NULL, 'Pacific/Pitcairn', 0),
(455, NULL, NULL, 'Pacific/Pohnpei', 0),
(456, NULL, NULL, 'Pacific/Ponape', 0),
(457, NULL, NULL, 'Pacific/Port_Moresby', 0),
(458, NULL, NULL, 'Pacific/Rarotonga', 0),
(459, NULL, NULL, 'Pacific/Saipan', 0),
(460, NULL, NULL, 'Pacific/Samoa', 0),
(461, NULL, NULL, 'Pacific/Tahiti', 0),
(462, NULL, NULL, 'Pacific/Tarawa', 0),
(463, NULL, NULL, 'Pacific/Tongatapu', 0),
(464, NULL, NULL, 'Pacific/Truk', 0),
(465, NULL, NULL, 'Pacific/Wake', 0),
(466, NULL, NULL, 'Pacific/Wallis', 0),
(467, NULL, NULL, 'Pacific/Yap', 0);

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` int(10) UNSIGNED NOT NULL,
  `last_updated_by` int(10) UNSIGNED DEFAULT NULL,
  `tr_head_id` int(10) UNSIGNED NOT NULL,
  `date` datetime NOT NULL,
  `dr_amount` int(11) DEFAULT NULL,
  `cr_amount` int(11) DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `transaction_heads`
--

CREATE TABLE `transaction_heads` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` int(10) UNSIGNED NOT NULL,
  `last_updated_by` int(10) UNSIGNED DEFAULT NULL,
  `tr_head` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ref_id` int(10) UNSIGNED DEFAULT NULL,
  `acc_id` int(10) UNSIGNED NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `transaction_heads`
--

INSERT INTO `transaction_heads` (`id`, `created_at`, `updated_at`, `created_by`, `last_updated_by`, `tr_head`, `ref_id`, `acc_id`, `status`) VALUES
(1, '2020-05-04 17:10:07', '2020-05-04 17:10:07', 1, NULL, 'Cash A/C', NULL, 13, 1),
(2, '2020-05-04 17:10:07', '2020-05-04 17:10:07', 1, NULL, 'Purchase A/C', NULL, 68, 1),
(3, '2020-05-04 17:10:07', '2020-05-04 17:10:07', 1, NULL, 'Sales A/C', NULL, 77, 1);

-- --------------------------------------------------------

--
-- Table structure for table `transfer_certificates`
--

CREATE TABLE `transfer_certificates` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` int(10) UNSIGNED NOT NULL,
  `last_updated_by` int(10) UNSIGNED DEFAULT NULL,
  `students_id` int(10) UNSIGNED NOT NULL,
  `date_of_issue` date NOT NULL,
  `date_of_leaving` date NOT NULL,
  `tc_num` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `leaving_time_class` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `qualified_to_promote` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `paid_fee_status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `character` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ref_text` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `transport_histories`
--

CREATE TABLE `transport_histories` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` int(10) UNSIGNED NOT NULL,
  `last_updated_by` int(10) UNSIGNED DEFAULT NULL,
  `years_id` int(10) UNSIGNED NOT NULL,
  `routes_id` int(10) UNSIGNED DEFAULT NULL,
  `vehicles_id` int(10) UNSIGNED DEFAULT NULL,
  `travellers_id` int(10) UNSIGNED NOT NULL,
  `history_type` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `transport_users`
--

CREATE TABLE `transport_users` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` int(10) UNSIGNED NOT NULL,
  `last_updated_by` int(10) UNSIGNED DEFAULT NULL,
  `routes_id` int(10) UNSIGNED DEFAULT NULL,
  `vehicles_id` int(10) UNSIGNED DEFAULT NULL,
  `user_type` int(10) UNSIGNED NOT NULL,
  `member_id` int(10) UNSIGNED NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_login_at` timestamp NULL DEFAULT NULL,
  `last_login_ip` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `contact_number` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `profile_image` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role_id` int(10) UNSIGNED DEFAULT NULL,
  `hook_id` int(10) UNSIGNED DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `remember_token`, `last_login_at`, `last_login_ip`, `created_at`, `updated_at`, `contact_number`, `address`, `profile_image`, `role_id`, `hook_id`, `status`) VALUES
(1, 'Super Admin', 'superadmin@edufirm.com', '$2y$10$nbriw3XLSot3o4fj8QwCku2nI55AGj3Ot0I05khpDVeNRcUMq8pNW', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `vehicles`
--

CREATE TABLE `vehicles` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` int(10) UNSIGNED NOT NULL,
  `last_updated_by` int(10) UNSIGNED DEFAULT NULL,
  `number` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `vehicle_staffs`
--

CREATE TABLE `vehicle_staffs` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `vehicles_id` int(10) UNSIGNED NOT NULL,
  `staffs_id` int(10) UNSIGNED NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `vendors`
--

CREATE TABLE `vendors` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` int(10) UNSIGNED NOT NULL,
  `last_updated_by` int(10) UNSIGNED DEFAULT NULL,
  `reg_no` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tel` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile_1` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile_2` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `extra_info` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `vendor_image` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `visitor_logs`
--

CREATE TABLE `visitor_logs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` int(10) UNSIGNED NOT NULL,
  `last_updated_by` int(10) UNSIGNED DEFAULT NULL,
  `date` datetime NOT NULL,
  `purpose` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_doc` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_num` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `in_time` time NOT NULL,
  `out_time` time DEFAULT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `note` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `attachment` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `visitor_purposes`
--

CREATE TABLE `visitor_purposes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` int(10) UNSIGNED NOT NULL,
  `last_updated_by` int(10) UNSIGNED DEFAULT NULL,
  `title` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `years`
--

CREATE TABLE `years` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` int(10) UNSIGNED NOT NULL,
  `last_updated_by` int(10) UNSIGNED DEFAULT NULL,
  `title` varchar(4) COLLATE utf8mb4_unicode_ci NOT NULL,
  `active_status` tinyint(1) NOT NULL DEFAULT 0,
  `status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `years`
--

INSERT INTO `years` (`id`, `created_at`, `updated_at`, `created_by`, `last_updated_by`, `title`, `active_status`, `status`) VALUES
(1, '2020-05-04 17:10:05', '2020-05-04 17:10:05', 1, NULL, '2018', 0, 0),
(2, '2020-05-04 17:10:05', '2020-05-04 17:10:05', 1, NULL, '2019', 0, 0),
(3, '2020-05-04 17:10:05', '2020-05-04 17:10:05', 1, NULL, '2020', 1, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `academic_infos`
--
ALTER TABLE `academic_infos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `academic_infos_students_id_foreign` (`students_id`);

--
-- Indexes for table `account_categories`
--
ALTER TABLE `account_categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `account_categories_ac_name_unique` (`ac_name`);

--
-- Indexes for table `addressinfos`
--
ALTER TABLE `addressinfos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `addressinfos_students_id_foreign` (`students_id`);

--
-- Indexes for table `alert_settings`
--
ALTER TABLE `alert_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `assets`
--
ALTER TABLE `assets`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `assets_title_unique` (`title`);

--
-- Indexes for table `assignments`
--
ALTER TABLE `assignments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `assignments_years_id_foreign` (`years_id`),
  ADD KEY `assignments_semesters_id_foreign` (`semesters_id`),
  ADD KEY `assignments_subjects_id_foreign` (`subjects_id`);

--
-- Indexes for table `assignment_answers`
--
ALTER TABLE `assignment_answers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `assignment_answers_assignments_id_foreign` (`assignments_id`),
  ADD KEY `assignment_answers_students_id_foreign` (`students_id`);

--
-- Indexes for table `attendances`
--
ALTER TABLE `attendances`
  ADD PRIMARY KEY (`id`),
  ADD KEY `attendances_years_id_foreign` (`years_id`),
  ADD KEY `attendances_months_id_foreign` (`months_id`);

--
-- Indexes for table `attendance_certificates`
--
ALTER TABLE `attendance_certificates`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `attendance_certificates_students_id_unique` (`students_id`);

--
-- Indexes for table `attendance_masters`
--
ALTER TABLE `attendance_masters`
  ADD PRIMARY KEY (`id`),
  ADD KEY `attendance_masters_year_foreign` (`year`),
  ADD KEY `attendance_masters_month_foreign` (`month`);

--
-- Indexes for table `attendance_statuses`
--
ALTER TABLE `attendance_statuses`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `attendance_statuses_title_unique` (`title`);

--
-- Indexes for table `audits`
--
ALTER TABLE `audits`
  ADD PRIMARY KEY (`id`),
  ADD KEY `audits_auditable_type_auditable_id_index` (`auditable_type`,`auditable_id`),
  ADD KEY `audits_user_id_user_type_index` (`user_id`,`user_type`);

--
-- Indexes for table `banks`
--
ALTER TABLE `banks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bank_transactions`
--
ALTER TABLE `bank_transactions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bank_transactions_banks_id_foreign` (`banks_id`);

--
-- Indexes for table `beds`
--
ALTER TABLE `beds`
  ADD PRIMARY KEY (`id`),
  ADD KEY `beds_hostels_id_foreign` (`hostels_id`),
  ADD KEY `beds_rooms_id_foreign` (`rooms_id`),
  ADD KEY `beds_bed_status_foreign` (`bed_status`);

--
-- Indexes for table `bed_statuses`
--
ALTER TABLE `bed_statuses`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `bed_statuses_title_unique` (`title`);

--
-- Indexes for table `bonafide_certificates`
--
ALTER TABLE `bonafide_certificates`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `bonafide_certificates_students_id_unique` (`students_id`);

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `books_book_code_unique` (`book_code`),
  ADD KEY `books_book_masters_id_foreign` (`book_masters_id`),
  ADD KEY `books_book_status_foreign` (`book_status`);

--
-- Indexes for table `book_categories`
--
ALTER TABLE `book_categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `book_categories_title_unique` (`title`),
  ADD UNIQUE KEY `book_categories_slug_unique` (`slug`);

--
-- Indexes for table `book_issues`
--
ALTER TABLE `book_issues`
  ADD PRIMARY KEY (`id`),
  ADD KEY `book_issues_book_id_foreign` (`book_id`);

--
-- Indexes for table `book_masters`
--
ALTER TABLE `book_masters`
  ADD PRIMARY KEY (`id`),
  ADD KEY `book_masters_categories_foreign` (`categories`);

--
-- Indexes for table `book_requests`
--
ALTER TABLE `book_requests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `book_statuses`
--
ALTER TABLE `book_statuses`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `book_statuses_title_unique` (`title`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `categories_title_unique` (`title`);

--
-- Indexes for table `certificate_histories`
--
ALTER TABLE `certificate_histories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `certificate_histories_students_id_foreign` (`students_id`);

--
-- Indexes for table `certificate_templates`
--
ALTER TABLE `certificate_templates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `character_certificates`
--
ALTER TABLE `character_certificates`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `character_certificates_students_id_unique` (`students_id`),
  ADD UNIQUE KEY `character_certificates_cc_num_unique` (`cc_num`);

--
-- Indexes for table `course_completion_certificates`
--
ALTER TABLE `course_completion_certificates`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `course_completion_certificates_students_id_unique` (`students_id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `customers_reg_no_unique` (`reg_no`);

--
-- Indexes for table `customer_statuses`
--
ALTER TABLE `customer_statuses`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `customer_statuses_title_unique` (`title`);

--
-- Indexes for table `days`
--
ALTER TABLE `days`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `days_title_unique` (`title`);

--
-- Indexes for table `documents`
--
ALTER TABLE `documents`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `downloads`
--
ALTER TABLE `downloads`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `eating_times`
--
ALTER TABLE `eating_times`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `eating_times_title_unique` (`title`);

--
-- Indexes for table `email_settings`
--
ALTER TABLE `email_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `exams`
--
ALTER TABLE `exams`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `exams_title_unique` (`title`);

--
-- Indexes for table `exam_mark_ledgers`
--
ALTER TABLE `exam_mark_ledgers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `exam_mark_ledgers_students_id_foreign` (`students_id`);

--
-- Indexes for table `exam_schedules`
--
ALTER TABLE `exam_schedules`
  ADD PRIMARY KEY (`id`),
  ADD KEY `exam_schedules_years_id_foreign` (`years_id`),
  ADD KEY `exam_schedules_months_id_foreign` (`months_id`),
  ADD KEY `exam_schedules_exams_id_foreign` (`exams_id`),
  ADD KEY `exam_schedules_faculty_id_foreign` (`faculty_id`),
  ADD KEY `exam_schedules_semesters_id_foreign` (`semesters_id`),
  ADD KEY `exam_schedules_subjects_id_foreign` (`subjects_id`);

--
-- Indexes for table `faculties`
--
ALTER TABLE `faculties`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `faculties_faculty_unique` (`faculty`),
  ADD UNIQUE KEY `faculties_faculty_code_unique` (`faculty_code`);

--
-- Indexes for table `faculty_semester`
--
ALTER TABLE `faculty_semester`
  ADD PRIMARY KEY (`id`),
  ADD KEY `faculty_semester_faculty_id_foreign` (`faculty_id`),
  ADD KEY `faculty_semester_semester_id_foreign` (`semester_id`);

--
-- Indexes for table `fee_collections`
--
ALTER TABLE `fee_collections`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fee_collections_students_id_foreign` (`students_id`),
  ADD KEY `fee_collections_fee_masters_id_foreign` (`fee_masters_id`);

--
-- Indexes for table `fee_heads`
--
ALTER TABLE `fee_heads`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `fee_heads_fee_head_title_unique` (`fee_head_title`);

--
-- Indexes for table `fee_masters`
--
ALTER TABLE `fee_masters`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fee_masters_students_id_foreign` (`students_id`);

--
-- Indexes for table `food_categories`
--
ALTER TABLE `food_categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `food_categories_title_unique` (`title`);

--
-- Indexes for table `food_items`
--
ALTER TABLE `food_items`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `food_items_title_unique` (`title`);

--
-- Indexes for table `food_item_food_schedule`
--
ALTER TABLE `food_item_food_schedule`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `food_schedules`
--
ALTER TABLE `food_schedules`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `general_settings`
--
ALTER TABLE `general_settings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `general_settings_time_zones_id_foreign` (`time_zones_id`);

--
-- Indexes for table `grading_scales`
--
ALTER TABLE `grading_scales`
  ADD PRIMARY KEY (`id`),
  ADD KEY `grading_scales_gradingtype_id_foreign` (`gradingType_id`);

--
-- Indexes for table `grading_types`
--
ALTER TABLE `grading_types`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `grading_types_title_unique` (`title`),
  ADD UNIQUE KEY `grading_types_slug_unique` (`slug`);

--
-- Indexes for table `guardian_details`
--
ALTER TABLE `guardian_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hostels`
--
ALTER TABLE `hostels`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `hostels_name_unique` (`name`);

--
-- Indexes for table `hostel_meals`
--
ALTER TABLE `hostel_meals`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `institutions`
--
ALTER TABLE `institutions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `library_circulations`
--
ALTER TABLE `library_circulations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `library_circulations_user_type_unique` (`user_type`),
  ADD UNIQUE KEY `library_circulations_slug_unique` (`slug`),
  ADD UNIQUE KEY `library_circulations_code_prefix_unique` (`code_prefix`);

--
-- Indexes for table `library_members`
--
ALTER TABLE `library_members`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `meetings`
--
ALTER TABLE `meetings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `meetings_semesters_id_foreign` (`semesters_id`),
  ADD KEY `meetings_subjects_id_foreign` (`subjects_id`);

--
-- Indexes for table `meeting_settings`
--
ALTER TABLE `meeting_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `months`
--
ALTER TABLE `months`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `months_title_unique` (`title`);

--
-- Indexes for table `notes`
--
ALTER TABLE `notes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notices`
--
ALTER TABLE `notices`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `online_payments`
--
ALTER TABLE `online_payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `parent_details`
--
ALTER TABLE `parent_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `parent_details_students_id_foreign` (`students_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `payment_methods`
--
ALTER TABLE `payment_methods`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `payment_methods_title_unique` (`title`);

--
-- Indexes for table `payment_settings`
--
ALTER TABLE `payment_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payroll_heads`
--
ALTER TABLE `payroll_heads`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `payroll_heads_title_unique` (`title`),
  ADD UNIQUE KEY `payroll_heads_slug_unique` (`slug`);

--
-- Indexes for table `payroll_masters`
--
ALTER TABLE `payroll_masters`
  ADD PRIMARY KEY (`id`),
  ADD KEY `payroll_masters_staff_id_foreign` (`staff_id`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_unique` (`name`);

--
-- Indexes for table `permission_role`
--
ALTER TABLE `permission_role`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `permission_role_role_id_foreign` (`role_id`);

--
-- Indexes for table `postal_exchanges`
--
ALTER TABLE `postal_exchanges`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `postal_exchanges_ref_no_unique` (`ref_no`);

--
-- Indexes for table `postal_exchange_types`
--
ALTER TABLE `postal_exchange_types`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `postal_exchange_types_title_unique` (`title`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `products_code_unique` (`code`);

--
-- Indexes for table `product_prices`
--
ALTER TABLE `product_prices`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `product_prices_products_id_unique` (`products_id`);

--
-- Indexes for table `purchases`
--
ALTER TABLE `purchases`
  ADD PRIMARY KEY (`id`),
  ADD KEY `purchases_vendors_id_foreign` (`vendors_id`);

--
-- Indexes for table `purchase_details`
--
ALTER TABLE `purchase_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `purchase_details_products_id_foreign` (`products_id`);

--
-- Indexes for table `purchase_returns`
--
ALTER TABLE `purchase_returns`
  ADD PRIMARY KEY (`id`),
  ADD KEY `purchase_returns_vendors_id_foreign` (`vendors_id`),
  ADD KEY `purchase_returns_products_id_foreign` (`products_id`);

--
-- Indexes for table `residents`
--
ALTER TABLE `residents`
  ADD PRIMARY KEY (`id`),
  ADD KEY `residents_hostels_id_foreign` (`hostels_id`),
  ADD KEY `residents_rooms_id_foreign` (`rooms_id`),
  ADD KEY `residents_beds_id_foreign` (`beds_id`);

--
-- Indexes for table `resident_histories`
--
ALTER TABLE `resident_histories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `resident_histories_years_id_foreign` (`years_id`),
  ADD KEY `resident_histories_hostels_id_foreign` (`hostels_id`),
  ADD KEY `resident_histories_rooms_id_foreign` (`rooms_id`),
  ADD KEY `resident_histories_beds_id_foreign` (`beds_id`),
  ADD KEY `resident_histories_residents_id_foreign` (`residents_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_unique` (`name`);

--
-- Indexes for table `role_user`
--
ALTER TABLE `role_user`
  ADD PRIMARY KEY (`user_id`,`role_id`),
  ADD KEY `role_user_role_id_foreign` (`role_id`);

--
-- Indexes for table `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rooms_hostels_id_foreign` (`hostels_id`),
  ADD KEY `rooms_room_type_foreign` (`room_type`);

--
-- Indexes for table `room_types`
--
ALTER TABLE `room_types`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `room_types_title_unique` (`title`);

--
-- Indexes for table `routes`
--
ALTER TABLE `routes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `routes_title_unique` (`title`);

--
-- Indexes for table `route_vehicles`
--
ALTER TABLE `route_vehicles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `salary_pays`
--
ALTER TABLE `salary_pays`
  ADD PRIMARY KEY (`id`),
  ADD KEY `salary_pays_staff_id_foreign` (`staff_id`),
  ADD KEY `salary_pays_salary_masters_id_foreign` (`salary_masters_id`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sales_details`
--
ALTER TABLE `sales_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sales_returns`
--
ALTER TABLE `sales_returns`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `semesters`
--
ALTER TABLE `semesters`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `semesters_semester_unique` (`semester`),
  ADD UNIQUE KEY `semesters_slug_unique` (`slug`);

--
-- Indexes for table `semester_assets`
--
ALTER TABLE `semester_assets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `semester_subject`
--
ALTER TABLE `semester_subject`
  ADD PRIMARY KEY (`id`),
  ADD KEY `semester_subject_semester_id_foreign` (`semester_id`),
  ADD KEY `semester_subject_subject_id_foreign` (`subject_id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sms_emails`
--
ALTER TABLE `sms_emails`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sms_settings`
--
ALTER TABLE `sms_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `staff_reg_no_unique` (`reg_no`),
  ADD KEY `staff_designation_foreign` (`designation`);

--
-- Indexes for table `staff_designations`
--
ALTER TABLE `staff_designations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `staff_designations_title_unique` (`title`);

--
-- Indexes for table `stocks`
--
ALTER TABLE `stocks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `students_reg_no_unique` (`reg_no`),
  ADD KEY `students_faculty_foreign` (`faculty`),
  ADD KEY `students_semester_foreign` (`semester`),
  ADD KEY `students_academic_status_foreign` (`academic_status`),
  ADD KEY `students_batch_foreign` (`batch`);

--
-- Indexes for table `student_batches`
--
ALTER TABLE `student_batches`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `student_batches_title_unique` (`title`);

--
-- Indexes for table `student_guardians`
--
ALTER TABLE `student_guardians`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_guardians_students_id_foreign` (`students_id`),
  ADD KEY `student_guardians_guardians_id_foreign` (`guardians_id`);

--
-- Indexes for table `student_statuses`
--
ALTER TABLE `student_statuses`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `student_statuses_title_unique` (`title`);

--
-- Indexes for table `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subject_attendances`
--
ALTER TABLE `subject_attendances`
  ADD PRIMARY KEY (`id`),
  ADD KEY `subject_attendances_years_id_foreign` (`years_id`),
  ADD KEY `subject_attendances_months_id_foreign` (`months_id`),
  ADD KEY `subject_attendances_subjects_id_foreign` (`subjects_id`);

--
-- Indexes for table `sub_categories`
--
ALTER TABLE `sub_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `time_zones`
--
ALTER TABLE `time_zones`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `transactions_tr_head_id_foreign` (`tr_head_id`);

--
-- Indexes for table `transaction_heads`
--
ALTER TABLE `transaction_heads`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transfer_certificates`
--
ALTER TABLE `transfer_certificates`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `transfer_certificates_students_id_unique` (`students_id`),
  ADD UNIQUE KEY `transfer_certificates_tc_num_unique` (`tc_num`);

--
-- Indexes for table `transport_histories`
--
ALTER TABLE `transport_histories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `transport_histories_travellers_id_foreign` (`travellers_id`);

--
-- Indexes for table `transport_users`
--
ALTER TABLE `transport_users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `transport_users_routes_id_foreign` (`routes_id`),
  ADD KEY `transport_users_vehicles_id_foreign` (`vehicles_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `vehicles`
--
ALTER TABLE `vehicles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `vehicles_number_unique` (`number`);

--
-- Indexes for table `vehicle_staffs`
--
ALTER TABLE `vehicle_staffs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `vehicle_staffs_staffs_id_foreign` (`staffs_id`),
  ADD KEY `vehicle_staffs_vehicles_id_foreign` (`vehicles_id`);

--
-- Indexes for table `vendors`
--
ALTER TABLE `vendors`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `vendors_reg_no_unique` (`reg_no`);

--
-- Indexes for table `visitor_logs`
--
ALTER TABLE `visitor_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `visitor_purposes`
--
ALTER TABLE `visitor_purposes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `visitor_purposes_title_unique` (`title`);

--
-- Indexes for table `years`
--
ALTER TABLE `years`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `years_title_unique` (`title`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `academic_infos`
--
ALTER TABLE `academic_infos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `account_categories`
--
ALTER TABLE `account_categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100;

--
-- AUTO_INCREMENT for table `addressinfos`
--
ALTER TABLE `addressinfos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `alert_settings`
--
ALTER TABLE `alert_settings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `assets`
--
ALTER TABLE `assets`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `assignments`
--
ALTER TABLE `assignments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `assignment_answers`
--
ALTER TABLE `assignment_answers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `attendances`
--
ALTER TABLE `attendances`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `attendance_certificates`
--
ALTER TABLE `attendance_certificates`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `attendance_masters`
--
ALTER TABLE `attendance_masters`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `attendance_statuses`
--
ALTER TABLE `attendance_statuses`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `audits`
--
ALTER TABLE `audits`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `banks`
--
ALTER TABLE `banks`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bank_transactions`
--
ALTER TABLE `bank_transactions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `beds`
--
ALTER TABLE `beds`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bed_statuses`
--
ALTER TABLE `bed_statuses`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `bonafide_certificates`
--
ALTER TABLE `bonafide_certificates`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `book_categories`
--
ALTER TABLE `book_categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `book_issues`
--
ALTER TABLE `book_issues`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `book_masters`
--
ALTER TABLE `book_masters`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `book_requests`
--
ALTER TABLE `book_requests`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `book_statuses`
--
ALTER TABLE `book_statuses`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `certificate_histories`
--
ALTER TABLE `certificate_histories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `certificate_templates`
--
ALTER TABLE `certificate_templates`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `character_certificates`
--
ALTER TABLE `character_certificates`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `course_completion_certificates`
--
ALTER TABLE `course_completion_certificates`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `customer_statuses`
--
ALTER TABLE `customer_statuses`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `days`
--
ALTER TABLE `days`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `documents`
--
ALTER TABLE `documents`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `downloads`
--
ALTER TABLE `downloads`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `eating_times`
--
ALTER TABLE `eating_times`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `email_settings`
--
ALTER TABLE `email_settings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `exams`
--
ALTER TABLE `exams`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `exam_mark_ledgers`
--
ALTER TABLE `exam_mark_ledgers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `exam_schedules`
--
ALTER TABLE `exam_schedules`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `faculties`
--
ALTER TABLE `faculties`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `faculty_semester`
--
ALTER TABLE `faculty_semester`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `fee_collections`
--
ALTER TABLE `fee_collections`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `fee_heads`
--
ALTER TABLE `fee_heads`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `fee_masters`
--
ALTER TABLE `fee_masters`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `food_categories`
--
ALTER TABLE `food_categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `food_items`
--
ALTER TABLE `food_items`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `food_item_food_schedule`
--
ALTER TABLE `food_item_food_schedule`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `food_schedules`
--
ALTER TABLE `food_schedules`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `general_settings`
--
ALTER TABLE `general_settings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `grading_scales`
--
ALTER TABLE `grading_scales`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `grading_types`
--
ALTER TABLE `grading_types`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `guardian_details`
--
ALTER TABLE `guardian_details`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hostels`
--
ALTER TABLE `hostels`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hostel_meals`
--
ALTER TABLE `hostel_meals`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `institutions`
--
ALTER TABLE `institutions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `library_circulations`
--
ALTER TABLE `library_circulations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `library_members`
--
ALTER TABLE `library_members`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `meetings`
--
ALTER TABLE `meetings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `meeting_settings`
--
ALTER TABLE `meeting_settings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=117;

--
-- AUTO_INCREMENT for table `months`
--
ALTER TABLE `months`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `notes`
--
ALTER TABLE `notes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `notices`
--
ALTER TABLE `notices`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `online_payments`
--
ALTER TABLE `online_payments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `parent_details`
--
ALTER TABLE `parent_details`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payment_methods`
--
ALTER TABLE `payment_methods`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `payment_settings`
--
ALTER TABLE `payment_settings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `payroll_heads`
--
ALTER TABLE `payroll_heads`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payroll_masters`
--
ALTER TABLE `payroll_masters`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=714;

--
-- AUTO_INCREMENT for table `postal_exchanges`
--
ALTER TABLE `postal_exchanges`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `postal_exchange_types`
--
ALTER TABLE `postal_exchange_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product_prices`
--
ALTER TABLE `product_prices`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `purchases`
--
ALTER TABLE `purchases`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `purchase_details`
--
ALTER TABLE `purchase_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `purchase_returns`
--
ALTER TABLE `purchase_returns`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `residents`
--
ALTER TABLE `residents`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `resident_histories`
--
ALTER TABLE `resident_histories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `rooms`
--
ALTER TABLE `rooms`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `room_types`
--
ALTER TABLE `room_types`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `routes`
--
ALTER TABLE `routes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `route_vehicles`
--
ALTER TABLE `route_vehicles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `salary_pays`
--
ALTER TABLE `salary_pays`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sales_details`
--
ALTER TABLE `sales_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sales_returns`
--
ALTER TABLE `sales_returns`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `semesters`
--
ALTER TABLE `semesters`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `semester_assets`
--
ALTER TABLE `semester_assets`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `semester_subject`
--
ALTER TABLE `semester_subject`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sms_emails`
--
ALTER TABLE `sms_emails`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sms_settings`
--
ALTER TABLE `sms_settings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `staff_designations`
--
ALTER TABLE `staff_designations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `stocks`
--
ALTER TABLE `stocks`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `student_batches`
--
ALTER TABLE `student_batches`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `student_guardians`
--
ALTER TABLE `student_guardians`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `student_statuses`
--
ALTER TABLE `student_statuses`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `subject_attendances`
--
ALTER TABLE `subject_attendances`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sub_categories`
--
ALTER TABLE `sub_categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `time_zones`
--
ALTER TABLE `time_zones`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=468;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `transaction_heads`
--
ALTER TABLE `transaction_heads`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `transfer_certificates`
--
ALTER TABLE `transfer_certificates`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `transport_histories`
--
ALTER TABLE `transport_histories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `transport_users`
--
ALTER TABLE `transport_users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `vehicles`
--
ALTER TABLE `vehicles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `vehicle_staffs`
--
ALTER TABLE `vehicle_staffs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `vendors`
--
ALTER TABLE `vendors`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `visitor_logs`
--
ALTER TABLE `visitor_logs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `visitor_purposes`
--
ALTER TABLE `visitor_purposes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `years`
--
ALTER TABLE `years`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `academic_infos`
--
ALTER TABLE `academic_infos`
  ADD CONSTRAINT `academic_infos_students_id_foreign` FOREIGN KEY (`students_id`) REFERENCES `students` (`id`);

--
-- Constraints for table `addressinfos`
--
ALTER TABLE `addressinfos`
  ADD CONSTRAINT `addressinfos_students_id_foreign` FOREIGN KEY (`students_id`) REFERENCES `students` (`id`);

--
-- Constraints for table `assignments`
--
ALTER TABLE `assignments`
  ADD CONSTRAINT `assignments_semesters_id_foreign` FOREIGN KEY (`semesters_id`) REFERENCES `semesters` (`id`),
  ADD CONSTRAINT `assignments_subjects_id_foreign` FOREIGN KEY (`subjects_id`) REFERENCES `subjects` (`id`),
  ADD CONSTRAINT `assignments_years_id_foreign` FOREIGN KEY (`years_id`) REFERENCES `years` (`id`);

--
-- Constraints for table `assignment_answers`
--
ALTER TABLE `assignment_answers`
  ADD CONSTRAINT `assignment_answers_assignments_id_foreign` FOREIGN KEY (`assignments_id`) REFERENCES `assignments` (`id`),
  ADD CONSTRAINT `assignment_answers_students_id_foreign` FOREIGN KEY (`students_id`) REFERENCES `students` (`id`);

--
-- Constraints for table `attendances`
--
ALTER TABLE `attendances`
  ADD CONSTRAINT `attendances_months_id_foreign` FOREIGN KEY (`months_id`) REFERENCES `months` (`id`),
  ADD CONSTRAINT `attendances_years_id_foreign` FOREIGN KEY (`years_id`) REFERENCES `years` (`id`);

--
-- Constraints for table `attendance_certificates`
--
ALTER TABLE `attendance_certificates`
  ADD CONSTRAINT `attendance_certificates_students_id_foreign` FOREIGN KEY (`students_id`) REFERENCES `students` (`id`);

--
-- Constraints for table `attendance_masters`
--
ALTER TABLE `attendance_masters`
  ADD CONSTRAINT `attendance_masters_month_foreign` FOREIGN KEY (`month`) REFERENCES `months` (`id`),
  ADD CONSTRAINT `attendance_masters_year_foreign` FOREIGN KEY (`year`) REFERENCES `years` (`id`);

--
-- Constraints for table `bank_transactions`
--
ALTER TABLE `bank_transactions`
  ADD CONSTRAINT `bank_transactions_banks_id_foreign` FOREIGN KEY (`banks_id`) REFERENCES `banks` (`id`);

--
-- Constraints for table `beds`
--
ALTER TABLE `beds`
  ADD CONSTRAINT `beds_bed_status_foreign` FOREIGN KEY (`bed_status`) REFERENCES `bed_statuses` (`id`),
  ADD CONSTRAINT `beds_hostels_id_foreign` FOREIGN KEY (`hostels_id`) REFERENCES `hostels` (`id`),
  ADD CONSTRAINT `beds_rooms_id_foreign` FOREIGN KEY (`rooms_id`) REFERENCES `rooms` (`id`);

--
-- Constraints for table `bonafide_certificates`
--
ALTER TABLE `bonafide_certificates`
  ADD CONSTRAINT `bonafide_certificates_students_id_foreign` FOREIGN KEY (`students_id`) REFERENCES `students` (`id`);

--
-- Constraints for table `books`
--
ALTER TABLE `books`
  ADD CONSTRAINT `books_book_masters_id_foreign` FOREIGN KEY (`book_masters_id`) REFERENCES `book_masters` (`id`),
  ADD CONSTRAINT `books_book_status_foreign` FOREIGN KEY (`book_status`) REFERENCES `book_statuses` (`id`);

--
-- Constraints for table `book_issues`
--
ALTER TABLE `book_issues`
  ADD CONSTRAINT `book_issues_book_id_foreign` FOREIGN KEY (`book_id`) REFERENCES `books` (`id`);

--
-- Constraints for table `book_masters`
--
ALTER TABLE `book_masters`
  ADD CONSTRAINT `book_masters_categories_foreign` FOREIGN KEY (`categories`) REFERENCES `book_categories` (`id`);

--
-- Constraints for table `certificate_histories`
--
ALTER TABLE `certificate_histories`
  ADD CONSTRAINT `certificate_histories_students_id_foreign` FOREIGN KEY (`students_id`) REFERENCES `students` (`id`);

--
-- Constraints for table `character_certificates`
--
ALTER TABLE `character_certificates`
  ADD CONSTRAINT `character_certificates_students_id_foreign` FOREIGN KEY (`students_id`) REFERENCES `students` (`id`);

--
-- Constraints for table `course_completion_certificates`
--
ALTER TABLE `course_completion_certificates`
  ADD CONSTRAINT `course_completion_certificates_students_id_foreign` FOREIGN KEY (`students_id`) REFERENCES `students` (`id`);

--
-- Constraints for table `exam_mark_ledgers`
--
ALTER TABLE `exam_mark_ledgers`
  ADD CONSTRAINT `exam_mark_ledgers_students_id_foreign` FOREIGN KEY (`students_id`) REFERENCES `students` (`id`);

--
-- Constraints for table `exam_schedules`
--
ALTER TABLE `exam_schedules`
  ADD CONSTRAINT `exam_schedules_exams_id_foreign` FOREIGN KEY (`exams_id`) REFERENCES `exams` (`id`),
  ADD CONSTRAINT `exam_schedules_faculty_id_foreign` FOREIGN KEY (`faculty_id`) REFERENCES `faculties` (`id`),
  ADD CONSTRAINT `exam_schedules_months_id_foreign` FOREIGN KEY (`months_id`) REFERENCES `months` (`id`),
  ADD CONSTRAINT `exam_schedules_semesters_id_foreign` FOREIGN KEY (`semesters_id`) REFERENCES `semesters` (`id`),
  ADD CONSTRAINT `exam_schedules_subjects_id_foreign` FOREIGN KEY (`subjects_id`) REFERENCES `subjects` (`id`),
  ADD CONSTRAINT `exam_schedules_years_id_foreign` FOREIGN KEY (`years_id`) REFERENCES `years` (`id`);

--
-- Constraints for table `faculty_semester`
--
ALTER TABLE `faculty_semester`
  ADD CONSTRAINT `faculty_semester_faculty_id_foreign` FOREIGN KEY (`faculty_id`) REFERENCES `faculties` (`id`),
  ADD CONSTRAINT `faculty_semester_semester_id_foreign` FOREIGN KEY (`semester_id`) REFERENCES `semesters` (`id`);

--
-- Constraints for table `fee_collections`
--
ALTER TABLE `fee_collections`
  ADD CONSTRAINT `fee_collections_fee_masters_id_foreign` FOREIGN KEY (`fee_masters_id`) REFERENCES `fee_masters` (`id`),
  ADD CONSTRAINT `fee_collections_students_id_foreign` FOREIGN KEY (`students_id`) REFERENCES `students` (`id`);

--
-- Constraints for table `fee_masters`
--
ALTER TABLE `fee_masters`
  ADD CONSTRAINT `fee_masters_students_id_foreign` FOREIGN KEY (`students_id`) REFERENCES `students` (`id`);

--
-- Constraints for table `general_settings`
--
ALTER TABLE `general_settings`
  ADD CONSTRAINT `general_settings_time_zones_id_foreign` FOREIGN KEY (`time_zones_id`) REFERENCES `time_zones` (`id`);

--
-- Constraints for table `grading_scales`
--
ALTER TABLE `grading_scales`
  ADD CONSTRAINT `grading_scales_gradingtype_id_foreign` FOREIGN KEY (`gradingType_id`) REFERENCES `grading_types` (`id`);

--
-- Constraints for table `meetings`
--
ALTER TABLE `meetings`
  ADD CONSTRAINT `meetings_semesters_id_foreign` FOREIGN KEY (`semesters_id`) REFERENCES `semesters` (`id`),
  ADD CONSTRAINT `meetings_subjects_id_foreign` FOREIGN KEY (`subjects_id`) REFERENCES `subjects` (`id`);

--
-- Constraints for table `parent_details`
--
ALTER TABLE `parent_details`
  ADD CONSTRAINT `parent_details_students_id_foreign` FOREIGN KEY (`students_id`) REFERENCES `students` (`id`);

--
-- Constraints for table `payroll_masters`
--
ALTER TABLE `payroll_masters`
  ADD CONSTRAINT `payroll_masters_staff_id_foreign` FOREIGN KEY (`staff_id`) REFERENCES `staff` (`id`);

--
-- Constraints for table `permission_role`
--
ALTER TABLE `permission_role`
  ADD CONSTRAINT `permission_role_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `permission_role_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `purchases`
--
ALTER TABLE `purchases`
  ADD CONSTRAINT `purchases_vendors_id_foreign` FOREIGN KEY (`vendors_id`) REFERENCES `vendors` (`id`);

--
-- Constraints for table `purchase_details`
--
ALTER TABLE `purchase_details`
  ADD CONSTRAINT `purchase_details_products_id_foreign` FOREIGN KEY (`products_id`) REFERENCES `products` (`id`);

--
-- Constraints for table `purchase_returns`
--
ALTER TABLE `purchase_returns`
  ADD CONSTRAINT `purchase_returns_products_id_foreign` FOREIGN KEY (`products_id`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `purchase_returns_vendors_id_foreign` FOREIGN KEY (`vendors_id`) REFERENCES `vendors` (`id`);

--
-- Constraints for table `residents`
--
ALTER TABLE `residents`
  ADD CONSTRAINT `residents_beds_id_foreign` FOREIGN KEY (`beds_id`) REFERENCES `beds` (`id`),
  ADD CONSTRAINT `residents_hostels_id_foreign` FOREIGN KEY (`hostels_id`) REFERENCES `hostels` (`id`),
  ADD CONSTRAINT `residents_rooms_id_foreign` FOREIGN KEY (`rooms_id`) REFERENCES `rooms` (`id`);

--
-- Constraints for table `resident_histories`
--
ALTER TABLE `resident_histories`
  ADD CONSTRAINT `resident_histories_beds_id_foreign` FOREIGN KEY (`beds_id`) REFERENCES `beds` (`id`),
  ADD CONSTRAINT `resident_histories_hostels_id_foreign` FOREIGN KEY (`hostels_id`) REFERENCES `hostels` (`id`),
  ADD CONSTRAINT `resident_histories_residents_id_foreign` FOREIGN KEY (`residents_id`) REFERENCES `residents` (`id`),
  ADD CONSTRAINT `resident_histories_rooms_id_foreign` FOREIGN KEY (`rooms_id`) REFERENCES `rooms` (`id`),
  ADD CONSTRAINT `resident_histories_years_id_foreign` FOREIGN KEY (`years_id`) REFERENCES `years` (`id`);

--
-- Constraints for table `role_user`
--
ALTER TABLE `role_user`
  ADD CONSTRAINT `role_user_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `role_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `rooms`
--
ALTER TABLE `rooms`
  ADD CONSTRAINT `rooms_hostels_id_foreign` FOREIGN KEY (`hostels_id`) REFERENCES `hostels` (`id`),
  ADD CONSTRAINT `rooms_room_type_foreign` FOREIGN KEY (`room_type`) REFERENCES `room_types` (`id`);

--
-- Constraints for table `salary_pays`
--
ALTER TABLE `salary_pays`
  ADD CONSTRAINT `salary_pays_salary_masters_id_foreign` FOREIGN KEY (`salary_masters_id`) REFERENCES `payroll_masters` (`id`),
  ADD CONSTRAINT `salary_pays_staff_id_foreign` FOREIGN KEY (`staff_id`) REFERENCES `staff` (`id`);

--
-- Constraints for table `semester_subject`
--
ALTER TABLE `semester_subject`
  ADD CONSTRAINT `semester_subject_semester_id_foreign` FOREIGN KEY (`semester_id`) REFERENCES `semesters` (`id`),
  ADD CONSTRAINT `semester_subject_subject_id_foreign` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`id`);

--
-- Constraints for table `staff`
--
ALTER TABLE `staff`
  ADD CONSTRAINT `staff_designation_foreign` FOREIGN KEY (`designation`) REFERENCES `staff_designations` (`id`);

--
-- Constraints for table `students`
--
ALTER TABLE `students`
  ADD CONSTRAINT `students_academic_status_foreign` FOREIGN KEY (`academic_status`) REFERENCES `student_statuses` (`id`),
  ADD CONSTRAINT `students_batch_foreign` FOREIGN KEY (`batch`) REFERENCES `student_batches` (`id`),
  ADD CONSTRAINT `students_faculty_foreign` FOREIGN KEY (`faculty`) REFERENCES `faculties` (`id`),
  ADD CONSTRAINT `students_semester_foreign` FOREIGN KEY (`semester`) REFERENCES `semesters` (`id`);

--
-- Constraints for table `student_guardians`
--
ALTER TABLE `student_guardians`
  ADD CONSTRAINT `student_guardians_guardians_id_foreign` FOREIGN KEY (`guardians_id`) REFERENCES `guardian_details` (`id`),
  ADD CONSTRAINT `student_guardians_students_id_foreign` FOREIGN KEY (`students_id`) REFERENCES `students` (`id`);

--
-- Constraints for table `subject_attendances`
--
ALTER TABLE `subject_attendances`
  ADD CONSTRAINT `subject_attendances_months_id_foreign` FOREIGN KEY (`months_id`) REFERENCES `months` (`id`),
  ADD CONSTRAINT `subject_attendances_subjects_id_foreign` FOREIGN KEY (`subjects_id`) REFERENCES `subjects` (`id`),
  ADD CONSTRAINT `subject_attendances_years_id_foreign` FOREIGN KEY (`years_id`) REFERENCES `years` (`id`);

--
-- Constraints for table `transactions`
--
ALTER TABLE `transactions`
  ADD CONSTRAINT `transactions_tr_head_id_foreign` FOREIGN KEY (`tr_head_id`) REFERENCES `transaction_heads` (`id`);

--
-- Constraints for table `transfer_certificates`
--
ALTER TABLE `transfer_certificates`
  ADD CONSTRAINT `transfer_certificates_students_id_foreign` FOREIGN KEY (`students_id`) REFERENCES `students` (`id`);

--
-- Constraints for table `transport_histories`
--
ALTER TABLE `transport_histories`
  ADD CONSTRAINT `transport_histories_travellers_id_foreign` FOREIGN KEY (`travellers_id`) REFERENCES `transport_users` (`id`);

--
-- Constraints for table `transport_users`
--
ALTER TABLE `transport_users`
  ADD CONSTRAINT `transport_users_routes_id_foreign` FOREIGN KEY (`routes_id`) REFERENCES `routes` (`id`),
  ADD CONSTRAINT `transport_users_vehicles_id_foreign` FOREIGN KEY (`vehicles_id`) REFERENCES `vehicles` (`id`);

--
-- Constraints for table `vehicle_staffs`
--
ALTER TABLE `vehicle_staffs`
  ADD CONSTRAINT `vehicle_staffs_staffs_id_foreign` FOREIGN KEY (`staffs_id`) REFERENCES `staff` (`id`),
  ADD CONSTRAINT `vehicle_staffs_vehicles_id_foreign` FOREIGN KEY (`vehicles_id`) REFERENCES `vehicles` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
