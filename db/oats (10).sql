-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 03, 2021 at 10:53 AM
-- Server version: 10.4.20-MariaDB
-- PHP Version: 7.3.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `oats`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `a_id` int(11) NOT NULL,
  `a_email` varchar(100) NOT NULL,
  `a_password` varchar(255) NOT NULL,
  `a_vpwd` varchar(100) NOT NULL,
  `a_desig` varchar(100) NOT NULL,
  `a_name` varchar(100) NOT NULL,
  `a_phone` varchar(15) NOT NULL,
  `a_address` tinytext NOT NULL,
  `a_company` tinytext NOT NULL,
  `a_usertype` varchar(10) NOT NULL COMMENT 'For User Privilege 1 for Admin',
  `a_status` varchar(2) NOT NULL COMMENT '1 Approve/ 2 Not Approve',
  `a_dob` date NOT NULL DEFAULT '1970-01-01',
  `a_doj` date NOT NULL DEFAULT '1970-01-01',
  `a_date` datetime NOT NULL DEFAULT '1970-01-01 00:00:01',
  `a_pagepermission` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`a_id`, `a_email`, `a_password`, `a_vpwd`, `a_desig`, `a_name`, `a_phone`, `a_address`, `a_company`, `a_usertype`, `a_status`, `a_dob`, `a_doj`, `a_date`, `a_pagepermission`) VALUES
(1, 'admin@oats.in', 'e10adc3949ba59abbe56e057f20f883e', '123456', '', 'oats', '', '', 'oats', '1', '1', '2021-08-24', '2021-08-24', '2021-08-24 00:00:00', '1,2,3,4,5'),
(3, 'test@gmail.com', '9fae51dfc99c42d34c9e0048fbde7f95', 'h210909', 'test desig', 'TEST', '7504889447', 'test addr', 'OATS', '2', '1', '2021-09-09', '2021-09-09', '2021-09-09 11:18:58', '1');

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `ea_id` int(11) NOT NULL,
  `ea_department` varchar(100) NOT NULL,
  `ea_employee` varchar(100) NOT NULL,
  `ea_date` date NOT NULL DEFAULT '1970-01-01',
  `ea_astatus` varchar(100) NOT NULL,
  `ea_reason` varchar(100) NOT NULL,
  `ea_user` int(11) NOT NULL,
  `ea_status` varchar(11) NOT NULL,
  `ea_cdate` date NOT NULL DEFAULT '1970-01-01'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `attendance`
--

INSERT INTO `attendance` (`ea_id`, `ea_department`, `ea_employee`, `ea_date`, `ea_astatus`, `ea_reason`, `ea_user`, `ea_status`, `ea_cdate`) VALUES
(70, '1', '8', '2021-09-01', 'P', '', 1, '1', '2021-11-02'),
(71, '1', '9', '2021-09-01', 'P', '', 1, '1', '2021-11-02'),
(72, '1', '10', '2021-09-01', 'P', '', 1, '1', '2021-11-02'),
(73, '1', '8', '2021-09-02', 'P', '', 1, '1', '2021-11-02'),
(74, '1', '9', '2021-09-02', 'P', '', 1, '1', '2021-11-02'),
(75, '1', '10', '2021-09-02', 'P', '', 1, '1', '2021-11-02'),
(76, '1', '8', '2021-09-03', 'P', '', 1, '1', '2021-11-02'),
(77, '1', '9', '2021-09-03', 'P', '', 1, '1', '2021-11-02'),
(78, '1', '10', '2021-09-03', 'P', '', 1, '1', '2021-11-02'),
(79, '1', '8', '2021-11-04', 'H', 'Diwali', 1, '1', '2021-11-02'),
(80, '1', '9', '2021-11-04', 'H', 'Diwali', 1, '1', '2021-11-02'),
(81, '1', '10', '2021-11-04', 'H', 'Diwali', 1, '1', '2021-11-02'),
(82, '1', '8', '2021-09-04', 'P', '', 1, '1', '2021-11-02'),
(83, '1', '9', '2021-09-04', 'P', '', 1, '1', '2021-11-02'),
(84, '1', '10', '2021-09-04', 'P', '', 1, '1', '2021-11-02'),
(85, '1', '8', '2021-09-05', 'O', 'Sunday', 1, '1', '2021-11-02'),
(86, '1', '9', '2021-09-05', 'O', 'Sunday', 1, '1', '2021-11-02'),
(87, '1', '10', '2021-09-05', 'O', 'Sunday', 1, '1', '2021-11-02'),
(88, '1', '8', '2021-09-06', 'P', '', 1, '1', '2021-11-02'),
(89, '1', '9', '2021-09-06', 'P', '', 1, '1', '2021-11-02'),
(90, '1', '10', '2021-09-06', 'P', '', 1, '1', '2021-11-02'),
(91, '1', '8', '2021-09-07', 'P', '', 1, '1', '2021-11-02'),
(92, '1', '9', '2021-09-07', 'P', '', 1, '1', '2021-11-02'),
(93, '1', '10', '2021-09-07', 'P', '', 1, '1', '2021-11-02'),
(94, '1', '8', '2021-09-08', 'P', '', 1, '1', '2021-11-02'),
(95, '1', '9', '2021-09-08', 'P', '', 1, '1', '2021-11-02'),
(96, '1', '10', '2021-09-08', 'P', '', 1, '1', '2021-11-02'),
(97, '1', '8', '2021-11-09', 'P', '', 1, '1', '2021-11-02'),
(98, '1', '9', '2021-11-09', 'P', '', 1, '1', '2021-11-02'),
(99, '1', '10', '2021-11-09', 'P', '', 1, '1', '2021-11-02'),
(100, '1', '8', '2021-11-10', 'P', '', 1, '1', '2021-11-02'),
(101, '1', '9', '2021-11-10', 'P', '', 1, '1', '2021-11-02'),
(102, '1', '10', '2021-11-10', 'P', '', 1, '1', '2021-11-02'),
(103, '1', '8', '2021-11-11', 'P', '', 1, '1', '2021-11-02'),
(104, '1', '9', '2021-11-11', 'P', '', 1, '1', '2021-11-02'),
(105, '1', '10', '2021-11-11', 'P', '', 1, '1', '2021-11-02'),
(106, '1', '8', '2021-11-12', 'P', '', 1, '1', '2021-11-02'),
(107, '1', '9', '2021-11-12', 'P', '', 1, '1', '2021-11-02'),
(108, '1', '10', '2021-11-12', 'P', '', 1, '1', '2021-11-02'),
(109, '1', '8', '2021-09-12', 'O', 'Sunday', 1, '1', '2021-11-02'),
(110, '1', '9', '2021-09-12', 'O', 'Sunday', 1, '1', '2021-11-02'),
(111, '1', '10', '2021-09-12', 'O', 'Sunday', 1, '1', '2021-11-02'),
(112, '1', '8', '2021-09-11', 'P', '', 1, '1', '2021-11-02'),
(113, '1', '9', '2021-09-11', 'P', '', 1, '1', '2021-11-02'),
(114, '1', '10', '2021-09-11', 'P', '', 1, '1', '2021-11-02'),
(115, '1', '8', '2021-09-13', 'P', '', 1, '1', '2021-11-02'),
(116, '1', '9', '2021-09-13', 'P', '', 1, '1', '2021-11-02'),
(117, '1', '10', '2021-09-13', 'P', '', 1, '1', '2021-11-02'),
(118, '1', '8', '2021-09-14', 'P', '', 1, '1', '2021-11-02'),
(119, '1', '9', '2021-09-14', 'P', '', 1, '1', '2021-11-02'),
(120, '1', '10', '2021-09-14', 'P', '', 1, '1', '2021-11-02'),
(121, '1', '8', '2021-09-15', 'P', '', 1, '1', '2021-11-02'),
(122, '1', '9', '2021-09-15', 'P', '', 1, '1', '2021-11-02'),
(123, '1', '10', '2021-09-15', 'P', '', 1, '1', '2021-11-02'),
(124, '1', '8', '2021-09-16', 'P', '', 1, '1', '2021-11-02'),
(125, '1', '9', '2021-09-16', 'P', '', 1, '1', '2021-11-02'),
(126, '1', '10', '2021-09-16', 'P', '', 1, '1', '2021-11-02'),
(127, '1', '8', '2021-09-17', 'P', '', 1, '1', '2021-11-02'),
(128, '1', '9', '2021-09-17', 'P', '', 1, '1', '2021-11-02'),
(129, '1', '10', '2021-09-17', 'P', '', 1, '1', '2021-11-02'),
(130, '1', '8', '2021-09-18', 'P', '', 1, '1', '2021-11-02'),
(131, '1', '9', '2021-09-18', 'P', '', 1, '1', '2021-11-02'),
(132, '1', '10', '2021-09-18', 'P', '', 1, '1', '2021-11-02'),
(133, '1', '8', '2021-09-20', 'P', '', 1, '1', '2021-11-02'),
(134, '1', '9', '2021-09-20', 'P', '', 1, '1', '2021-11-02'),
(135, '1', '10', '2021-09-20', 'P', '', 1, '1', '2021-11-02'),
(136, '1', '8', '2021-11-21', 'O', 'Sunday', 1, '1', '2021-11-02'),
(137, '1', '9', '2021-11-21', 'O', 'Sunday', 1, '1', '2021-11-02'),
(138, '1', '10', '2021-11-21', 'O', 'Sunday', 1, '1', '2021-11-02'),
(139, '1', '8', '2021-09-21', 'P', '', 1, '1', '2021-11-02'),
(140, '1', '9', '2021-09-21', 'P', '', 1, '1', '2021-11-02'),
(141, '1', '10', '2021-09-21', 'P', '', 1, '1', '2021-11-02'),
(142, '1', '8', '2021-09-22', 'P', '', 1, '1', '2021-11-02'),
(143, '1', '9', '2021-09-22', 'P', '', 1, '1', '2021-11-02'),
(144, '1', '10', '2021-09-22', 'P', '', 1, '1', '2021-11-02'),
(145, '1', '8', '2021-09-23', 'P', '', 1, '1', '2021-11-02'),
(146, '1', '9', '2021-09-23', 'P', '', 1, '1', '2021-11-02'),
(147, '1', '10', '2021-09-23', 'P', '', 1, '1', '2021-11-02'),
(148, '1', '8', '2021-09-24', 'P', '', 1, '1', '2021-11-02'),
(149, '1', '9', '2021-09-24', 'P', '', 1, '1', '2021-11-02'),
(150, '1', '10', '2021-09-24', 'P', '', 1, '1', '2021-11-02'),
(151, '1', '8', '2021-09-25', 'P', '', 1, '1', '2021-11-02'),
(152, '1', '9', '2021-09-25', 'P', '', 1, '1', '2021-11-02'),
(153, '1', '10', '2021-09-25', 'P', '', 1, '1', '2021-11-02'),
(154, '1', '8', '2021-09-26', 'O', 'Sunday', 1, '1', '2021-11-02'),
(155, '1', '9', '2021-09-26', 'O', 'Sunday', 1, '1', '2021-11-02'),
(156, '1', '10', '2021-09-26', 'O', 'Sunday', 1, '1', '2021-11-02'),
(157, '1', '8', '2021-09-27', 'P', '', 1, '1', '2021-11-02'),
(158, '1', '9', '2021-09-27', 'P', '', 1, '1', '2021-11-02'),
(159, '1', '10', '2021-09-27', 'P', '', 1, '1', '2021-11-02'),
(160, '1', '8', '2021-09-28', 'P', '', 1, '1', '2021-11-02'),
(161, '1', '9', '2021-09-28', 'P', '', 1, '1', '2021-11-02'),
(162, '1', '10', '2021-09-28', 'P', '', 1, '1', '2021-11-02'),
(163, '1', '8', '2021-09-29', 'P', '', 1, '1', '2021-11-02'),
(164, '1', '9', '2021-09-29', 'P', '', 1, '1', '2021-11-02'),
(165, '1', '10', '2021-09-29', 'P', '', 1, '1', '2021-11-02'),
(166, '1', '8', '2021-09-30', 'P', '', 1, '1', '2021-11-02'),
(167, '1', '9', '2021-09-30', 'P', '', 1, '1', '2021-11-02'),
(168, '1', '10', '2021-09-30', 'P', '', 1, '1', '2021-11-02'),
(169, '1', '8', '2021-09-09', 'P', '', 1, '1', '2021-11-02'),
(170, '1', '9', '2021-09-09', 'P', '', 1, '1', '2021-11-02'),
(171, '1', '10', '2021-09-09', 'P', '', 1, '1', '2021-11-02'),
(172, '1', '8', '2021-09-10', 'P', '', 1, '1', '2021-11-02'),
(173, '1', '9', '2021-09-10', 'P', '', 1, '1', '2021-11-02'),
(174, '1', '10', '2021-09-10', 'P', '', 1, '1', '2021-11-02'),
(175, '1', '8', '2021-09-19', 'O', 'Sunday', 1, '1', '2021-11-02'),
(176, '1', '9', '2021-09-19', 'O', 'Sunday', 1, '1', '2021-11-02'),
(177, '1', '10', '2021-09-19', 'O', 'Sunday', 1, '1', '2021-11-02');

-- --------------------------------------------------------

--
-- Table structure for table `billing`
--

CREATE TABLE `billing` (
  `b_id` int(11) NOT NULL,
  `b_site` varchar(100) NOT NULL,
  `b_billno` varchar(100) NOT NULL,
  `b_billname` varchar(100) NOT NULL,
  `b_billamount` varchar(100) NOT NULL,
  `b_rdeductamount` varchar(100) NOT NULL,
  `b_tdeductamount` varchar(100) NOT NULL,
  `b_prdate` date NOT NULL DEFAULT '1970-01-01',
  `b_pramount` varchar(100) NOT NULL,
  `b_pstatus` varchar(100) NOT NULL,
  `b_remark` varchar(100) NOT NULL,
  `b_status` varchar(10) NOT NULL,
  `b_cdate` date NOT NULL DEFAULT '1970-01-01'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `billing`
--

INSERT INTO `billing` (`b_id`, `b_site`, `b_billno`, `b_billname`, `b_billamount`, `b_rdeductamount`, `b_tdeductamount`, `b_prdate`, `b_pramount`, `b_pstatus`, `b_remark`, `b_status`, `b_cdate`) VALUES
(4, 'A', 'OATS/1/21-22	', 'Electrical	', '4000	', '400', '100', '0000-00-00', '3500.00', '', '', '1', '2021-11-03');

-- --------------------------------------------------------

--
-- Table structure for table `circle`
--

CREATE TABLE `circle` (
  `c_id` int(11) NOT NULL,
  `c_name` varchar(100) NOT NULL,
  `c_status` varchar(11) NOT NULL,
  `c_date` date NOT NULL DEFAULT '1970-01-01'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `circle`
--

INSERT INTO `circle` (`c_id`, `c_name`, `c_status`, `c_date`) VALUES
(2, 'ODISHA', '1', '2021-08-25'),
(3, 'Bhubaneswar', '1', '2021-08-25'),
(4, 'CUTTACK', '1', '2021-08-25'),
(5, 'Balasore', '1', '2021-08-25');

-- --------------------------------------------------------

--
-- Table structure for table `cluster`
--

CREATE TABLE `cluster` (
  `c_id` int(11) NOT NULL,
  `c_name` varchar(100) NOT NULL,
  `c_status` varchar(11) NOT NULL,
  `c_date` date NOT NULL DEFAULT '1970-01-01'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cluster`
--

INSERT INTO `cluster` (`c_id`, `c_name`, `c_status`, `c_date`) VALUES
(2, 'test', '1', '2021-09-03'),
(3, 'Cutack', '1', '2021-09-03'),
(4, 'Bhubaneswar', '1', '2021-09-03'),
(5, 'Balasore', '1', '2021-09-03');

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `d_id` int(11) NOT NULL,
  `d_name` varchar(100) NOT NULL,
  `d_status` varchar(11) NOT NULL,
  `d_date` date NOT NULL DEFAULT '1970-01-01'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`d_id`, `d_name`, `d_status`, `d_date`) VALUES
(1, 'GAIL', '1', '2021-08-24'),
(2, 'TI', '1', '2021-08-24'),
(4, 'MCH', '1', '2021-08-27');

-- --------------------------------------------------------

--
-- Table structure for table `designation`
--

CREATE TABLE `designation` (
  `ds_id` int(11) NOT NULL,
  `ds_name` varchar(100) NOT NULL,
  `ds_status` varchar(11) NOT NULL,
  `ds_date` date NOT NULL DEFAULT '1970-01-01'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `designation`
--

INSERT INTO `designation` (`ds_id`, `ds_name`, `ds_status`, `ds_date`) VALUES
(1, 'Engineer', '1', '2021-08-24'),
(2, 'Project Manager', '1', '2021-08-24'),
(4, 'Supervisor', '1', '2021-10-26'),
(5, 'Secury Guard', '1', '2021-10-26'),
(6, 'Caretaker', '1', '2021-10-26'),
(7, 'Technician', '1', '2021-10-26'),
(8, 'field worker', '1', '2021-10-26'),
(9, 'Watch man', '1', '2021-10-26');

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `e_id` int(11) NOT NULL,
  `e_circle` varchar(100) NOT NULL,
  `e_location` varchar(100) NOT NULL,
  `e_department` varchar(100) NOT NULL,
  `e_name` varchar(100) NOT NULL,
  `e_fname` varchar(100) NOT NULL,
  `e_gender` varchar(100) NOT NULL,
  `e_bgroup` varchar(100) NOT NULL,
  `e_contact` varchar(100) NOT NULL,
  `e_acontact` varchar(100) NOT NULL,
  `e_email` varchar(100) NOT NULL,
  `e_paddr` text NOT NULL,
  `e_addr` text NOT NULL,
  `e_code` varchar(100) NOT NULL,
  `e_designation` varchar(100) NOT NULL,
  `e_jobcat` varchar(100) NOT NULL,
  `e_bdetails` varchar(100) NOT NULL,
  `e_esicno` varchar(100) NOT NULL,
  `e_epf` varchar(100) NOT NULL,
  `e_dob` date NOT NULL DEFAULT '1970-01-01',
  `e_doj` date NOT NULL DEFAULT '1970-01-01',
  `e_bsalary` varchar(100) NOT NULL,
  `e_allowance` varchar(100) NOT NULL,
  `e_gsalary` varchar(100) NOT NULL,
  `e_da` varchar(100) NOT NULL,
  `e_hra` varchar(100) NOT NULL,
  `e_sallowance` varchar(100) NOT NULL,
  `e_epfamount` varchar(100) NOT NULL,
  `e_esicamount` varchar(100) NOT NULL,
  `e_it` varchar(100) NOT NULL,
  `e_ptax` varchar(100) NOT NULL,
  `e_other` varchar(100) NOT NULL,
  `e_nsalary` varchar(100) NOT NULL,
  `e_pdaysalary` varchar(100) NOT NULL,
  `e_status` varchar(10) NOT NULL,
  `e_cdate` date NOT NULL DEFAULT '1970-01-01'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`e_id`, `e_circle`, `e_location`, `e_department`, `e_name`, `e_fname`, `e_gender`, `e_bgroup`, `e_contact`, `e_acontact`, `e_email`, `e_paddr`, `e_addr`, `e_code`, `e_designation`, `e_jobcat`, `e_bdetails`, `e_esicno`, `e_epf`, `e_dob`, `e_doj`, `e_bsalary`, `e_allowance`, `e_gsalary`, `e_da`, `e_hra`, `e_sallowance`, `e_epfamount`, `e_esicamount`, `e_it`, `e_ptax`, `e_other`, `e_nsalary`, `e_pdaysalary`, `e_status`, `e_cdate`) VALUES
(2, '3', '2', '1', 'test', 'test f name', 'Male', 'A+', '56546546456', '', '', '', 'fghfgh', 'OATS002', '1', 'P', 'fghfgh', 'fhgjghj', '56465456', '1999-10-14', '2021-08-20', '10000', '100', '10400.00', '100', '100', '100', '1200.00', '75.00', '100', '100', '100', '8825.00', '346.67', '2', '2021-08-26'),
(4, '2', '5', '1', 'test 12', 'test f name 12', 'Male', 'B+', '9776123456', '', '', '', 'rhyrt', 'OATS003', '2', 'P', 'rhyrt', 'fhgjghjrty', '56465456', '1993-06-17', '2021-08-04', '15000', '2000', '17000.00', '0', '0', '0', '1800.00', '112.50', '100', '0', '100', '14887.50', '', '2', '2021-08-26'),
(5, '4', '6', '2', 'Jyotsna Nayak', 'Sarat Ch nayak', 'Female', 'AB+', '7504885758', '', 'nayk@gmail.com', '', 'test addr', 'OATS004', '2', 'C', 'test bank details', '099hu89', 'hhhui88989', '1996-07-18', '2021-09-09', '10000', '1000', '11100.00', '100', '0', '0', '0', '0', '100', '500', '0', '10500.00', '', '2', '2021-09-16'),
(8, '2', '7', '1', 'Abinash Dwibedy', 'Anubhab Dwibedy', 'Male', 'A+', '8637212167', '8637212168', 'adwibedy2003 @gmail.com', '595,Sahidnagar,BBSR', '595,Sahidnagar,BBSR', 'OATS007', '1', 'P', 'Bank Name - HDFC Bank Ltd,  Duburi', '4405632195', '100222014026', '1990-03-20', '2021-08-01', '19000', '100', '20000.00', '100', '300', '500', '2280.00', '142.50', '0', '0', '0', '17577.50', '', '1', '2021-10-26'),
(9, '2', '7', '1', 'Manoranjan Swain', 'Mohan Kumar Swain', 'Male', 'O+', '9776635051', '9776635052', 'manoranjan.swain@gmail.com', '595,Sahidnagar,BBSR', '595,Sahidnagar,BBSR', 'OATS008', '2', 'C', 'ss', '4405632196', '100169825960', '1990-03-20', '2021-08-01', '50000', '0', '50100.00', '100', '0', '0', '0', '0', '0', '0', '0', '50100.00', '', '1', '2021-10-26'),
(10, '2', '7', '1', 'Samarendra Swain', 'Sidhanta Swain', 'Male', 'B+', '8249445013', '8249445011', 'samarendra92@gmail.com', '595,Sahidnagar,BBSR', '595,Sahidnagar,BBSR', 'OATS009', '4', 'P', '2487108006116(Canara Bank)', '4405632197', '100221194881', '1990-03-20', '2021-08-01', '7280', '10720', '18000.00', '0', '0', '0', '0', '0', '0', '0', '0', '18000.00', '', '1', '2021-10-26');

-- --------------------------------------------------------

--
-- Table structure for table `expense`
--

CREATE TABLE `expense` (
  `se_id` int(11) NOT NULL,
  `se_site` varchar(100) NOT NULL,
  `se_employee` varchar(100) NOT NULL,
  `se_eamount` varchar(100) NOT NULL DEFAULT '1970-01-01',
  `se_pamount` varchar(100) NOT NULL,
  `se_tabillno` varchar(100) NOT NULL,
  `se_tadate` date NOT NULL DEFAULT '1970-01-01',
  `se_rmaterial` varchar(100) NOT NULL,
  `se_mperticulars` varchar(100) NOT NULL,
  `se_uquantity` varchar(100) NOT NULL,
  `se_uom` varchar(100) NOT NULL,
  `se_uprice` varchar(100) NOT NULL,
  `se_totalprice` varchar(100) NOT NULL DEFAULT '1970-01-01',
  `se_rquantity` varchar(100) NOT NULL,
  `se_rdate` date NOT NULL DEFAULT '1970-01-01',
  `se_status` varchar(10) NOT NULL,
  `se_cdate` date NOT NULL DEFAULT '1970-01-01'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `expense`
--

INSERT INTO `expense` (`se_id`, `se_site`, `se_employee`, `se_eamount`, `se_pamount`, `se_tabillno`, `se_tadate`, `se_rmaterial`, `se_mperticulars`, `se_uquantity`, `se_uom`, `se_uprice`, `se_totalprice`, `se_rquantity`, `se_rdate`, `se_status`, `se_cdate`) VALUES
(4, 'A', '5', '700', '300.00', '1', '0000-00-00', '', '', '', '', '', '', '', '0000-00-00', '1', '2021-11-02');

-- --------------------------------------------------------

--
-- Table structure for table `finalattendance`
--

CREATE TABLE `finalattendance` (
  `fa_id` int(11) NOT NULL,
  `fa_department` varchar(100) NOT NULL,
  `fa_date` date NOT NULL DEFAULT '1970-01-01',
  `fa_user` varchar(100) NOT NULL,
  `fa_status` varchar(11) NOT NULL,
  `fa_cdate` date NOT NULL DEFAULT '1970-01-01'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `finalattendance`
--

INSERT INTO `finalattendance` (`fa_id`, `fa_department`, `fa_date`, `fa_user`, `fa_status`, `fa_cdate`) VALUES
(7, '1', '2021-09-01', '1', '1', '2021-11-02'),
(8, '1', '2021-09-02', '1', '1', '2021-11-02'),
(9, '1', '2021-09-03', '1', '1', '2021-11-02'),
(10, '1', '2021-09-04', '1', '1', '2021-11-02'),
(11, '1', '2021-09-06', '1', '1', '2021-11-02'),
(12, '1', '2021-09-07', '1', '1', '2021-11-02'),
(13, '1', '2021-09-08', '1', '1', '2021-11-02'),
(14, '1', '2021-11-09', '1', '1', '2021-11-02'),
(15, '1', '2021-11-10', '1', '1', '2021-11-02'),
(16, '1', '2021-11-11', '1', '1', '2021-11-02'),
(17, '1', '2021-09-11', '1', '1', '2021-11-02'),
(18, '1', '2021-09-13', '1', '1', '2021-11-02'),
(19, '1', '2021-09-14', '1', '1', '2021-11-02'),
(20, '1', '2021-09-15', '1', '1', '2021-11-02'),
(21, '1', '2021-09-16', '1', '1', '2021-11-02'),
(22, '1', '2021-09-17', '1', '1', '2021-11-02'),
(23, '1', '2021-09-18', '1', '1', '2021-11-02'),
(24, '1', '2021-09-20', '1', '1', '2021-11-02'),
(25, '1', '2021-09-21', '1', '1', '2021-11-02'),
(26, '1', '2021-09-23', '1', '1', '2021-11-02'),
(27, '1', '2021-09-22', '1', '1', '2021-11-02'),
(28, '1', '2021-09-24', '1', '1', '2021-11-02'),
(29, '1', '2021-09-25', '1', '1', '2021-11-02'),
(30, '1', '2021-09-27', '1', '1', '2021-11-02'),
(31, '1', '2021-09-28', '1', '1', '2021-11-02'),
(32, '1', '2021-09-29', '1', '1', '2021-11-02'),
(33, '1', '2021-09-30', '1', '1', '2021-11-02'),
(34, '1', '2021-09-09', '1', '1', '2021-11-02'),
(35, '1', '2021-09-10', '1', '1', '2021-11-02');

-- --------------------------------------------------------

--
-- Table structure for table `holiday`
--

CREATE TABLE `holiday` (
  `h_id` int(11) NOT NULL,
  `h_type` varchar(100) NOT NULL,
  `h_name` varchar(100) NOT NULL,
  `h_status` varchar(11) NOT NULL,
  `h_date` date NOT NULL DEFAULT '1970-01-01'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `holiday`
--

INSERT INTO `holiday` (`h_id`, `h_type`, `h_name`, `h_status`, `h_date`) VALUES
(1, 'Other', 'New year', '1', '2021-09-28'),
(2, 'National', 'Replubic Day', '1', '2021-09-28'),
(3, 'Other', 'Holi', '1', '2021-09-28'),
(4, 'National', 'Labour day', '1', '2021-10-26'),
(5, 'Other', '1st Raja', '1', '2021-10-26'),
(6, 'Other', 'Rajasankranti', '1', '2021-10-26'),
(7, 'Other', 'Ratha Yatra', '1', '2021-10-26'),
(8, 'National', 'Gandhi Jayanti', '1', '2021-10-26'),
(9, 'Other', 'Maha-Navami', '1', '2021-10-26'),
(10, 'Other', 'Dussehera', '1', '2021-10-26'),
(11, 'Other', 'Diwali', '1', '2021-10-26'),
(12, 'National', 'Indipendence day', '1', '2021-10-28');

-- --------------------------------------------------------

--
-- Table structure for table `holidaydetails`
--

CREATE TABLE `holidaydetails` (
  `hd_id` int(11) NOT NULL,
  `hd_name` varchar(100) NOT NULL,
  `hd_date` date NOT NULL DEFAULT '1970-01-01',
  `hd_status` int(11) NOT NULL,
  `hd_cdate` date NOT NULL DEFAULT '1970-01-01'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `holidaydetails`
--

INSERT INTO `holidaydetails` (`hd_id`, `hd_name`, `hd_date`, `hd_status`, `hd_cdate`) VALUES
(1, '1', '2021-01-01', 1, '2021-09-28'),
(2, '2', '2021-01-26', 2, '2021-09-28'),
(3, '3', '2021-03-29', 1, '2021-10-26'),
(4, '4', '2021-05-01', 2, '2021-10-26'),
(5, '5', '2021-06-14', 1, '2021-10-26'),
(6, '6', '2021-06-15', 1, '2021-10-26'),
(7, '7', '2021-07-12', 1, '2021-10-26'),
(8, '8', '2021-10-02', 2, '2021-10-26'),
(9, '9', '2021-10-14', 1, '2021-10-26'),
(10, '10', '2021-10-15', 1, '2021-10-26'),
(11, '11', '2021-11-04', 1, '2021-10-26'),
(12, '12', '2021-08-15', 2, '2021-10-28');

-- --------------------------------------------------------

--
-- Table structure for table `jobstatus`
--

CREATE TABLE `jobstatus` (
  `j_id` int(11) NOT NULL,
  `j_eid` varchar(100) NOT NULL,
  `j_date` date NOT NULL DEFAULT '1970-01-01',
  `j_status` varchar(11) NOT NULL,
  `j_cdate` date NOT NULL DEFAULT '1970-01-01'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `jobstatus`
--

INSERT INTO `jobstatus` (`j_id`, `j_eid`, `j_date`, `j_status`, `j_cdate`) VALUES
(3, '4', '2021-11-02', '1', '2021-11-02'),
(4, '5', '2021-11-02', '1', '2021-11-02');

-- --------------------------------------------------------

--
-- Table structure for table `location`
--

CREATE TABLE `location` (
  `l_id` int(11) NOT NULL,
  `l_name` varchar(100) NOT NULL,
  `l_circle` int(11) NOT NULL,
  `l_status` varchar(11) NOT NULL,
  `l_date` date NOT NULL DEFAULT '1970-01-01'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `location`
--

INSERT INTO `location` (`l_id`, `l_name`, `l_circle`, `l_status`, `l_date`) VALUES
(2, 'Patia', 3, '1', '2021-08-25'),
(3, 'Barmunda', 3, '1', '2021-08-25'),
(6, 'Cda', 4, '1', '2021-09-16'),
(7, 'BHUBANESWAR', 2, '1', '2021-10-26');

-- --------------------------------------------------------

--
-- Table structure for table `month`
--

CREATE TABLE `month` (
  `m_id` int(11) NOT NULL,
  `m_month` varchar(100) NOT NULL,
  `m_days` int(11) NOT NULL,
  `m_status` varchar(11) NOT NULL,
  `m_date` date NOT NULL DEFAULT '1970-01-01'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `month`
--

INSERT INTO `month` (`m_id`, `m_month`, `m_days`, `m_status`, `m_date`) VALUES
(1, '1', 26, '1', '2021-09-02'),
(2, '2', 24, '1', '2021-09-02'),
(3, '3', 27, '1', '2021-09-02'),
(4, '4', 30, '1', '2021-09-03'),
(5, '5', 26, '1', '2021-09-03'),
(6, '6', 26, '1', '2021-09-24'),
(7, '7', 27, '1', '2021-09-24'),
(8, '8', 26, '1', '2021-09-24'),
(9, '9', 26, '1', '2021-09-24'),
(10, '10', 26, '1', '2021-09-24'),
(11, '11', 26, '1', '2021-09-24'),
(13, '12', 27, '1', '2021-09-29');

-- --------------------------------------------------------

--
-- Table structure for table `monthdays`
--

CREATE TABLE `monthdays` (
  `d_id` int(11) NOT NULL,
  `d_date` varchar(100) NOT NULL,
  `d_status` int(11) NOT NULL,
  `d_cdate` date NOT NULL DEFAULT '1970-01-01'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `monthdays`
--

INSERT INTO `monthdays` (`d_id`, `d_date`, `d_status`, `d_cdate`) VALUES
(1, '1', 1, '2021-10-29'),
(2, '2', 1, '2021-10-29'),
(3, '3', 1, '2021-10-29'),
(4, '4', 1, '2021-10-29'),
(5, '5', 1, '2021-10-29'),
(6, '6', 1, '2021-10-29'),
(7, '7', 1, '2021-10-29'),
(8, '8', 1, '2021-10-29'),
(9, '9', 1, '2021-10-29'),
(10, '10', 1, '2021-10-29'),
(11, '11', 1, '2021-10-29'),
(12, '12', 1, '2021-10-29'),
(13, '13', 1, '2021-10-29'),
(14, '14', 1, '2021-10-29'),
(15, '15', 1, '2021-10-29'),
(16, '16', 1, '2021-10-29'),
(17, '17', 1, '2021-10-29'),
(18, '18', 1, '2021-10-29'),
(19, '19', 1, '2021-10-29'),
(20, '20', 1, '2021-10-29'),
(21, '21', 1, '2021-10-29'),
(22, '22', 1, '2021-10-29'),
(23, '23', 1, '2021-10-29'),
(24, '24', 1, '2021-10-29'),
(25, '25', 1, '2021-10-29'),
(26, '26', 1, '2021-10-29'),
(27, '27', 1, '2021-10-29'),
(28, '28', 1, '2021-10-29'),
(29, '29', 1, '2021-10-29'),
(30, '30', 1, '2021-10-29'),
(31, '31', 1, '2021-10-29');

-- --------------------------------------------------------

--
-- Table structure for table `reason`
--

CREATE TABLE `reason` (
  `r_id` int(11) NOT NULL,
  `r_type` varchar(100) NOT NULL,
  `r_days` varchar(100) NOT NULL,
  `r_status` varchar(11) NOT NULL,
  `r_date` date NOT NULL DEFAULT '1970-01-01'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `reason`
--

INSERT INTO `reason` (`r_id`, `r_type`, `r_days`, `r_status`, `r_date`) VALUES
(2, 'CL', '15', '1', '2021-09-21'),
(3, 'EL', '20', '1', '2021-09-21'),
(4, 'SPL', '10', '1', '2021-09-21');

-- --------------------------------------------------------

--
-- Table structure for table `requisition`
--

CREATE TABLE `requisition` (
  `sr_id` int(11) NOT NULL,
  `sr_site` varchar(100) NOT NULL,
  `sr_employee` varchar(100) NOT NULL,
  `sr_rdate` date NOT NULL DEFAULT '1970-01-01',
  `sr_subscope` varchar(100) NOT NULL,
  `sr_rapproval` varchar(100) NOT NULL,
  `sr_rpaiddate` date NOT NULL DEFAULT '1970-01-01',
  `sr_mparticulars` varchar(100) NOT NULL,
  `sr_quantity` varchar(100) NOT NULL,
  `sr_uom` varchar(100) NOT NULL,
  `sr_unitprice` varchar(100) NOT NULL,
  `sr_totalprice` varchar(100) NOT NULL,
  `sr_mpaiddate` date NOT NULL DEFAULT '1970-01-01',
  `sr_status` varchar(10) NOT NULL,
  `sr_cdate` date NOT NULL DEFAULT '1970-01-01'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `requisition`
--

INSERT INTO `requisition` (`sr_id`, `sr_site`, `sr_employee`, `sr_rdate`, `sr_subscope`, `sr_rapproval`, `sr_rpaiddate`, `sr_mparticulars`, `sr_quantity`, `sr_uom`, `sr_unitprice`, `sr_totalprice`, `sr_mpaiddate`, `sr_status`, `sr_cdate`) VALUES
(2, '2', '2', '2021-09-07', '4', '5000', '2021-09-07', 'testt', '5', 'pkt', '1000', '10000', '2021-09-07', '1', '2021-09-07'),
(3, 'A', '5', '2021-10-12', '5', '1000', '2021-10-12', '', '', '', '', '', '0000-00-00', '1', '2021-11-02');

-- --------------------------------------------------------

--
-- Table structure for table `salary`
--

CREATE TABLE `salary` (
  `es_id` int(11) NOT NULL,
  `es_department` varchar(100) NOT NULL,
  `es_employee` varchar(100) NOT NULL,
  `es_year` varchar(100) NOT NULL,
  `es_month` varchar(100) NOT NULL,
  `es_days` varchar(100) NOT NULL,
  `es_nbasic` varchar(100) NOT NULL,
  `es_nda` varchar(100) NOT NULL,
  `es_nhra` varchar(100) NOT NULL,
  `es_nallowance` varchar(100) NOT NULL,
  `es_nsallowance` varchar(100) NOT NULL,
  `es_ngsalary` varchar(100) NOT NULL,
  `es_fepf` varchar(100) NOT NULL,
  `es_fesic` varchar(100) NOT NULL,
  `es_fit` varchar(100) NOT NULL,
  `es_fptax` varchar(100) NOT NULL,
  `es_fother` varchar(100) NOT NULL,
  `es_tdeduction` varchar(100) NOT NULL,
  `es_fnsalary` varchar(100) NOT NULL,
  `es_status` varchar(11) NOT NULL,
  `es_cdate` date NOT NULL DEFAULT '1970-01-01'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `salary`
--

INSERT INTO `salary` (`es_id`, `es_department`, `es_employee`, `es_year`, `es_month`, `es_days`, `es_nbasic`, `es_nda`, `es_nhra`, `es_nallowance`, `es_nsallowance`, `es_ngsalary`, `es_fepf`, `es_fesic`, `es_fit`, `es_fptax`, `es_fother`, `es_tdeduction`, `es_fnsalary`, `es_status`, `es_cdate`) VALUES
(21, '1', '8', '2021', '9', '26', '19000', '100', '300', '100', '500', '20000', '2400', '150', '0', '0', '0', '2550', '17450', '1', '2021-11-02');

-- --------------------------------------------------------

--
-- Table structure for table `salryamount`
--

CREATE TABLE `salryamount` (
  `se_id` int(11) NOT NULL,
  `se_type` varchar(100) NOT NULL,
  `se_percentage` float NOT NULL,
  `se_status` varchar(11) NOT NULL,
  `se_date` date NOT NULL DEFAULT '1970-01-01'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `salryamount`
--

INSERT INTO `salryamount` (`se_id`, `se_type`, `se_percentage`, `se_status`, `se_date`) VALUES
(1, 'EPF', 12, '1', '2021-09-16'),
(3, 'ESIC', 0.75, '1', '2021-09-16');

-- --------------------------------------------------------

--
-- Table structure for table `scope`
--

CREATE TABLE `scope` (
  `s_id` int(11) NOT NULL,
  `s_name` varchar(100) NOT NULL,
  `s_status` varchar(11) NOT NULL,
  `s_date` date NOT NULL DEFAULT '1970-01-01'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `scope`
--

INSERT INTO `scope` (`s_id`, `s_name`, `s_status`, `s_date`) VALUES
(2, 'ODSC', '1', '2021-09-01'),
(3, 'UBR', '1', '2021-09-01');

-- --------------------------------------------------------

--
-- Table structure for table `site`
--

CREATE TABLE `site` (
  `s_id` int(11) NOT NULL,
  `s_allotto` varchar(100) NOT NULL,
  `s_circle` varchar(100) NOT NULL,
  `s_department` varchar(100) NOT NULL,
  `s_cluster` varchar(100) NOT NULL,
  `s_scope` varchar(100) NOT NULL,
  `s_date` varchar(100) NOT NULL,
  `s_siteid` varchar(100) NOT NULL,
  `s_sitename` varchar(100) NOT NULL,
  `s_addrs` varchar(100) NOT NULL,
  `s_workno` text NOT NULL,
  `s_cunitprice` varchar(100) NOT NULL,
  `s_vunitprice` varchar(100) NOT NULL,
  `s_cmpdate` date NOT NULL DEFAULT '1970-01-01',
  `s_remark` varchar(100) NOT NULL,
  `s_status` varchar(10) NOT NULL,
  `s_cdate` date NOT NULL DEFAULT '1970-01-01'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `site`
--

INSERT INTO `site` (`s_id`, `s_allotto`, `s_circle`, `s_department`, `s_cluster`, `s_scope`, `s_date`, `s_siteid`, `s_sitename`, `s_addrs`, `s_workno`, `s_cunitprice`, `s_vunitprice`, `s_cmpdate`, `s_remark`, `s_status`, `s_cdate`) VALUES
(2, 'OATS', '3', '2', '3', '2,3', '2021-09-03', 'I-100-000', 'test site', 'addr', 'wo no', '100', '1000', '2021-09-08', 'wrwerw', '1', '2021-09-03'),
(4, 'OATS', '3', '2', '3', '3', '2021-09-17', '101-m-000', 'test site2', 'cuttack', '1022', '1000', '1000', '1970-01-01', '', '1', '2021-09-23'),
(5, 'OATS', '3', '2', '4', '2', '2021-09-22', '202-l-3002', 'test site 3', 'bbsr', 'test', '1000', '1000', '1970-01-01', '', '1', '2021-09-23'),
(6, 'OATS', '5', '4', '5', '2,3', '2021-09-30', 'I-OR-BLTN-OSC-0007', 'SARKANA', 'bbsr', 'na', '1000', '1000', '1970-01-01', '', '1', '2021-09-30'),
(7, 'OATS', '2', '2', '3', '2', '2021-11-02', 'I-OR-NIRA-OSC-0014', 'A', 'A', '1', '1000', '0', '1970-01-01', '', '1', '2021-11-02');

-- --------------------------------------------------------

--
-- Table structure for table `subscope`
--

CREATE TABLE `subscope` (
  `sc_id` int(11) NOT NULL,
  `sc_name` varchar(100) NOT NULL,
  `sc_scope` int(11) NOT NULL,
  `sc_status` varchar(11) NOT NULL,
  `sc_date` date NOT NULL DEFAULT '1970-01-01'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `subscope`
--

INSERT INTO `subscope` (`sc_id`, `sc_name`, `sc_scope`, `sc_status`, `sc_date`) VALUES
(3, 'UBR Survey', 3, '1', '2021-09-02'),
(4, 'test', 3, '1', '2021-09-02'),
(5, 'test survey', 2, '1', '2021-09-30');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`a_id`);

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`ea_id`);

--
-- Indexes for table `billing`
--
ALTER TABLE `billing`
  ADD PRIMARY KEY (`b_id`);

--
-- Indexes for table `circle`
--
ALTER TABLE `circle`
  ADD PRIMARY KEY (`c_id`);

--
-- Indexes for table `cluster`
--
ALTER TABLE `cluster`
  ADD PRIMARY KEY (`c_id`);

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`d_id`);

--
-- Indexes for table `designation`
--
ALTER TABLE `designation`
  ADD PRIMARY KEY (`ds_id`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`e_id`);

--
-- Indexes for table `expense`
--
ALTER TABLE `expense`
  ADD PRIMARY KEY (`se_id`);

--
-- Indexes for table `finalattendance`
--
ALTER TABLE `finalattendance`
  ADD PRIMARY KEY (`fa_id`);

--
-- Indexes for table `holiday`
--
ALTER TABLE `holiday`
  ADD PRIMARY KEY (`h_id`);

--
-- Indexes for table `holidaydetails`
--
ALTER TABLE `holidaydetails`
  ADD PRIMARY KEY (`hd_id`);

--
-- Indexes for table `jobstatus`
--
ALTER TABLE `jobstatus`
  ADD PRIMARY KEY (`j_id`);

--
-- Indexes for table `location`
--
ALTER TABLE `location`
  ADD PRIMARY KEY (`l_id`);

--
-- Indexes for table `month`
--
ALTER TABLE `month`
  ADD PRIMARY KEY (`m_id`);

--
-- Indexes for table `monthdays`
--
ALTER TABLE `monthdays`
  ADD PRIMARY KEY (`d_id`);

--
-- Indexes for table `reason`
--
ALTER TABLE `reason`
  ADD PRIMARY KEY (`r_id`);

--
-- Indexes for table `requisition`
--
ALTER TABLE `requisition`
  ADD PRIMARY KEY (`sr_id`);

--
-- Indexes for table `salary`
--
ALTER TABLE `salary`
  ADD PRIMARY KEY (`es_id`);

--
-- Indexes for table `salryamount`
--
ALTER TABLE `salryamount`
  ADD PRIMARY KEY (`se_id`);

--
-- Indexes for table `scope`
--
ALTER TABLE `scope`
  ADD PRIMARY KEY (`s_id`);

--
-- Indexes for table `site`
--
ALTER TABLE `site`
  ADD PRIMARY KEY (`s_id`);

--
-- Indexes for table `subscope`
--
ALTER TABLE `subscope`
  ADD PRIMARY KEY (`sc_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `a_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `attendance`
--
ALTER TABLE `attendance`
  MODIFY `ea_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=178;

--
-- AUTO_INCREMENT for table `billing`
--
ALTER TABLE `billing`
  MODIFY `b_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `circle`
--
ALTER TABLE `circle`
  MODIFY `c_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `cluster`
--
ALTER TABLE `cluster`
  MODIFY `c_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `d_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `designation`
--
ALTER TABLE `designation`
  MODIFY `ds_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `e_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `expense`
--
ALTER TABLE `expense`
  MODIFY `se_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `finalattendance`
--
ALTER TABLE `finalattendance`
  MODIFY `fa_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `holiday`
--
ALTER TABLE `holiday`
  MODIFY `h_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `holidaydetails`
--
ALTER TABLE `holidaydetails`
  MODIFY `hd_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `jobstatus`
--
ALTER TABLE `jobstatus`
  MODIFY `j_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `location`
--
ALTER TABLE `location`
  MODIFY `l_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `month`
--
ALTER TABLE `month`
  MODIFY `m_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `monthdays`
--
ALTER TABLE `monthdays`
  MODIFY `d_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `reason`
--
ALTER TABLE `reason`
  MODIFY `r_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `requisition`
--
ALTER TABLE `requisition`
  MODIFY `sr_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `salary`
--
ALTER TABLE `salary`
  MODIFY `es_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `salryamount`
--
ALTER TABLE `salryamount`
  MODIFY `se_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `scope`
--
ALTER TABLE `scope`
  MODIFY `s_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `site`
--
ALTER TABLE `site`
  MODIFY `s_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `subscope`
--
ALTER TABLE `subscope`
  MODIFY `sc_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
