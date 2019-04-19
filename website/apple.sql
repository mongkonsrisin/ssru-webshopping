-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 24, 2017 at 05:35 PM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `apple`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_cart`
--

CREATE TABLE `tbl_cart` (
  `cart_id` int(11) NOT NULL,
  `cart_member` int(11) NOT NULL,
  `cart_product` int(11) NOT NULL,
  `cart_quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `tbl_cart`
--

INSERT INTO `tbl_cart` (`cart_id`, `cart_member`, `cart_product`, `cart_quantity`) VALUES
(1, 10, 58, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_category`
--

CREATE TABLE `tbl_category` (
  `cat_id` int(11) NOT NULL,
  `cat_name` varchar(50) NOT NULL,
  `cat_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_category`
--

INSERT INTO `tbl_category` (`cat_id`, `cat_name`, `cat_status`) VALUES
(1, 'iPhone', 1),
(2, 'iPad', 1),
(3, 'iPod', 1),
(4, 'Mac', 1),
(5, 'Accessories', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_comment`
--

CREATE TABLE `tbl_comment` (
  `com_id` int(11) NOT NULL,
  `com_content` varchar(500) NOT NULL,
  `com_product` int(11) NOT NULL,
  `com_member` int(11) NOT NULL,
  `com_date` date NOT NULL,
  `com_time` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_config`
--

CREATE TABLE `tbl_config` (
  `cfg_id` int(11) NOT NULL,
  `cfg_key` varchar(30) NOT NULL,
  `cfg_value` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_config`
--

INSERT INTO `tbl_config` (`cfg_id`, `cfg_key`, `cfg_value`) VALUES
(1, 'ALLOW_REGISTRATION', '1'),
(2, 'MAINTENANCE_MODE', '0');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_feedback`
--

CREATE TABLE `tbl_feedback` (
  `feed_id` int(11) NOT NULL,
  `feed_fullname` varchar(100) NOT NULL,
  `feed_email` varchar(100) NOT NULL,
  `feed_content` varchar(500) NOT NULL,
  `feed_date` date NOT NULL,
  `feed_time` time NOT NULL,
  `feed_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_feedback`
--

INSERT INTO `tbl_feedback` (`feed_id`, `feed_fullname`, `feed_email`, `feed_content`, `feed_date`, `feed_time`, `feed_status`) VALUES
(3, 'test99', 'test99', 'qwertyuiop', '2017-05-16', '15:39:59', 3),
(4, 'Tete', 'suanigniter@gmail.com', 'Print this page to PDF for the complete set of vectors. Or to use on the desktop, install FontAwesome.otf, set it as the font in your application, and copy and paste the icons (not the unicode) directly from this page into your designs.', '2017-05-16', '15:42:43', 3),
(5, 'kkkkkk', 'suanigniter@outlook.com', 'Of course, I put the files verdanab.php and verdanab.z in the fonts directory. But I get the same error. What I\'m missing or how to use both Verdana fonts (normal and bold)?', '2017-05-16', '15:46:39', 1),
(6, 'test', 'suanigniter@gmail.com', '1234', '2017-05-17', '18:28:12', 1),
(7, 'Test', 's58122202060@ssru.ac.th', 'test1234', '2017-05-17', '18:28:43', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_member`
--

CREATE TABLE `tbl_member` (
  `mem_id` int(11) NOT NULL,
  `mem_username` varchar(30) NOT NULL,
  `mem_password` varchar(30) NOT NULL,
  `mem_fullname` varchar(50) NOT NULL,
  `mem_email` varchar(30) NOT NULL,
  `mem_phone` varchar(20) NOT NULL,
  `mem_token` varchar(70) NOT NULL,
  `mem_status` int(11) NOT NULL,
  `mem_photo` varchar(100) NOT NULL,
  `mem_registerdate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_member`
--

INSERT INTO `tbl_member` (`mem_id`, `mem_username`, `mem_password`, `mem_fullname`, `mem_email`, `mem_phone`, `mem_token`, `mem_status`, `mem_photo`, `mem_registerdate`) VALUES
(1, 'harry', '1234', 'Harry Potter', 'harry@gmail.com', '0881234567', '0a4utltd71cclnzm01ejvcuy6307ef45hxw3wnlxm9vx5sz0evnhvl27jiyivrk8', 1, 'f30e9efde56de7d0ed6b0769a7c6346b.jpg', '0000-00-00'),
(2, 'ron', '1234', 'Ron Weasley', 'ron@gmail.com', '0864480461', '', 1, '8c24044fde31687c207ba2d8d44d63f3.jpg', '0000-00-00'),
(3, 'hermione', '1234', 'Hermione Granger', 'hermione@gmail.com', '0931309308', '', 1, '7d3bd2461ab77535b73e0c562caf41dc.jpg', '0000-00-00'),
(4, 'snape', '1234', 'Severus Snape', 'snape@gmail.com', '025250925', '', 1, '379071eef14504d2f3750c2f461c29f1.jpg', '0000-00-00'),
(5, 'malfoy', '1234', 'Draco Malfoy', 'malfoy@gmail.com', '0812345678', 'go7tyemimbitxk4jvq51wwt5zot8m5f3qvb4t0p4u4chaaf024o1qpcg6n3kw168', 1, 'b80eccfdf5e1081057125c5e5b70c725.jpg', '0000-00-00'),
(6, 'tu', '1234', 'Prayuth Chanocha', 'tu44@thaimail.com', '191', '', 1, 'f68a42acdffc7f6626f1f6b3f67692fb.jpg', '0000-00-00'),
(7, 'swift', '1234', 'Taylor Swift', 'swift@gmail.com', '0898765432', '', 0, '2173d25d490a69d655b1d8ff80f27587.jpg', '0000-00-00'),
(8, 'jobs', '1234', 'Steve Jobs', 'jobs@apple.com', '021234567', '', 1, 'ab57b1e2ed8f44ff536e4d035c2b936d.jpg', '0000-00-00'),
(9, 'kendo', '1234', 'Mongkon Srisin', 'suan@gmail.com', '0819337031', '', 1, '5a91e58e877c3aae3fb6a1f2fbac8f6a.jpg', '0000-00-00'),
(10, 'tete', '1234', 'Tete Komkhuam', 'tete@gmail.com', '0891231234', 'xjfmata2frvhmu94r23o5wfdo9uxnogjx2vyvx5ea8wkjg8ogjqheyh58p2f97mj', 1, '20c4cd3febffdd7e4a2cda0876b19b47.jpg', '2017-05-01'),
(11, 'sehun', '1234', 'Sehun EXO', 'sehun94@gmail.com', '0855055555', '', 1, '60523a0b4e7e013458d9b7b3a99907cd.jpg', '0000-00-00'),
(12, 'garfield', '1234', 'Garfield', 'garfield@gmail.com', '0866966969', '', 0, 'f7efbbacb8c1fea94359159a5e8bed85.jpg', '0000-00-00'),
(14, 'durian', '1234', 'หน้ากากทุเรียน', 'tom@gmail.com', '0881911001', '', 0, 'c4c91b18f87e48af57da8b5c3a9df84b.jpg', '0000-00-00'),
(15, 'peck', '1234', 'เป๊ก ผลิตโชค', 'peck@gmail.com', '026239529', '', 0, '7668b37e73d92b3593c07e8c3548799d.jpg', '0000-00-00'),
(18, 'araya', '1234', 'อารยา', 'araya@gmail.com', '020001111', '', 0, '11d119fad450e3af2125ed2c65c5858f.jpg', '0000-00-00'),
(19, 'judy', '1234', 'Judy Hopps', 'judy@gmail.com', '0897897899', '', 1, '8fa907dbe8bb8c8e847b78e7ce434b09.jpg', '2017-05-22'),
(42, 'percy', '1234', 'Percy Weasley', 'suanigniter@yahoo.com', '0864480461', '4kwtksv2iwvsvgld5lalawmvrgvzkvqc58eqh4mi0mljqd254f864ftz7e1fdzmt', 0, '9b1ea86765c4ddce584e405305cb1384.jpg', '2017-05-23'),
(50, 'ssru', '1234', 'SSRU SSRU', 'ssru@ssru.com', '021234567', '', 0, 'profile.png', '2017-05-24');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_order`
--

CREATE TABLE `tbl_order` (
  `or_id` int(11) NOT NULL,
  `or_member` int(11) NOT NULL,
  `or_date` date NOT NULL,
  `or_time` time NOT NULL,
  `or_receivename` varchar(50) NOT NULL,
  `or_receiveaddress` varchar(800) NOT NULL,
  `or_status` int(11) NOT NULL,
  `or_paybank` varchar(10) NOT NULL,
  `or_payslip` varchar(80) NOT NULL,
  `or_tracking` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_order`
--

INSERT INTO `tbl_order` (`or_id`, `or_member`, `or_date`, `or_time`, `or_receivename`, `or_receiveaddress`, `or_status`, `or_paybank`, `or_payslip`, `or_tracking`) VALUES
(10044, 10, '2016-05-10', '23:14:51', 'Tete Komkhuam', '789 ถ.สุขุมวิท ปากน้ำ เมืองสมุทรปราการ สมุทรปราการ 10270', 4, 'kbank', '75c9e2b009145c300b7ef9d94477382a.png', 'EJ123456789TH'),
(10045, 10, '2017-01-25', '00:44:30', 'Tete Komkhuam', '123/456 หมู่บ้านศุภาลัยบุรี คลอง4 ถ.รังสิต-นครนายก ประชาธิปัตย์ ธัญบุรี ปทุมธานี 12130', 4, 'scb', 'facfc8a7d09d150314c6686e32b74075.png', 'RG123412349TH'),
(10046, 10, '2017-05-11', '00:47:44', 'Tete Komkhuam', '123/456 หมู่บ้านศุภาลัยบุรี คลอง4 ถ.รังสิต-นครนายก ประชาธิปัตย์ ธัญบุรี ปทุมธานี 12130', 2, 'scb', '2a53fbab4e0fa4b4571c608ba4099d18.jpg', ''),
(10047, 1, '2017-05-11', '00:59:50', 'Harry Potter', '999 ถ.อีผี วังบูรพาภิรมย์ พระนคร กรุงเทพมหานคร 10200', 4, 'tmb', 'd05438c0a43cc2b86e2fb2da86ae35e9.jpg', 'RG123456789TH'),
(10048, 2, '2017-05-11', '23:46:42', 'Ron Weasley', '9999 ถ.บลาๆๆๆ ลานสกา ลานสกา นครศรีธรรมราช 80230', 4, 'scb', '3050379a4723883191ae6a418494a87e.jpg', 'RR123456789TH'),
(10049, 1, '2017-05-15', '11:42:58', 'Harry Potter', '999 ถ.อีผี วังบูรพาภิรมย์ พระนคร กรุงเทพมหานคร 10200', 4, '', '', 'EEEE'),
(10050, 2, '2017-05-15', '13:49:36', 'Ron Weasley', '5555 หมู่บ้านศุภาลัยบุรี ถ.รังสิตนครนายก คลองสี่ คลองหลวง ปทุมธานี 12120', 4, 'scb', 'aeb9979fe0e9917b921ee143593d9def.jpg', 'EG987654321TH'),
(10051, 19, '2017-05-16', '13:12:14', 'Judy Hopps', '5679 ถ.อีผี หล่มสัก หล่มสัก เพชรบูรณ์ 67110', 4, 'scb', 'b69fceae37c990f536f3d2660949956b.jpg', 'EJ55555555TH'),
(10052, 10, '2017-05-18', '11:47:30', 'Tete Komkhuam', '789 ถ.สุขุมวิท ปากน้ำ เมืองสมุทรปราการ สมุทรปราการ 10270', 4, 'kbank', '434fc9d8f6052e0154eaa5c2cbdc68e1.jpg', '123345'),
(10053, 14, '2017-05-18', '12:06:38', 'หน้ากากทุเรียน', 'หหหหห ทุ่งคา เมืองชุมพร ชุมพร 86100', 3, 'kbank', 'e0cbfedf216e5419d9f2f8c52634700e.jpg', ''),
(10054, 14, '2017-05-18', '12:10:20', 'หน้ากากทุเรียน', 'หหหหห ลานสกา ลานสกา นครศรีธรรมราช 80230', 1, '', '', ''),
(10055, 14, '2017-05-18', '12:27:41', '', '', 1, '', '', ''),
(10056, 14, '2017-05-18', '12:45:29', 'หน้ากากทุเรียน', '9999 ถ.อิอิ ลมศักดิ์ ขุขันธ์ ศรีสะเกษ 33140', 1, '', '', ''),
(10057, 14, '2017-05-18', '12:53:45', 'หน้ากากทุเรียน', '1234 กกกกก ปงดอน แจ้ห่ม ลำปาง 52120', 1, '', '', ''),
(10058, 14, '2017-05-18', '12:54:15', '', '', 1, '', '', ''),
(10059, 10, '2017-05-21', '20:43:56', 'Tete Komkhuam', '123/456 หมู่บ้านศุภาลัยบุรี คลอง4 ถ.รังสิต-นครนายก ประชาธิปัตย์ ธัญบุรี ปทุมธานี 12130', 1, '', '', ''),
(10060, 50, '2017-05-24', '14:43:07', '', '', 1, '', '', ''),
(10061, 50, '2017-05-24', '14:43:40', 'SSRU SSRU', '1234 ดงกระทงยาม ศรีมหาโพธิ ปราจีนบุรี 25140', 1, '', '', ''),
(10062, 50, '2017-05-24', '14:43:51', 'SSRU SSRU', '1234 สุเทพ เมืองเชียงใหม่ เชียงใหม่ 50200', 3, '', '', ''),
(10063, 19, '2017-05-24', '14:55:16', 'Judy Hopps', '1234 ถ.บลาๆๆ มาบยางพร ปลวกแดง ระยอง 21140', 1, '', '', ''),
(10064, 19, '2017-05-24', '14:55:40', 'Judy Hopps', '1234 ถ.บลาๆๆ บางแค บางแค กรุงเทพมหานคร 10160', 4, 'kbank', '76beca57868938b8887274c4cc330040.jpg', ''),
(10065, 19, '2017-05-24', '15:01:26', 'Judy Hopps', '1234 ถ.บลาๆๆ มาบยางพร ปลวกแดง ระยอง 21140', 1, '', '', ''),
(10066, 19, '2017-05-24', '21:29:14', 'Judy Hopps', '1234 ถ.บลาๆๆ มาบยางพร ปลวกแดง ระยอง 21140', 2, 'scb', '8a0a9deaa37692a96965a8a648eb5871.JPG', '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_order_detail`
--

CREATE TABLE `tbl_order_detail` (
  `detail_id` int(11) NOT NULL,
  `detail_product` int(11) NOT NULL,
  `detail_amount` int(11) NOT NULL,
  `detail_order` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_order_detail`
--

INSERT INTO `tbl_order_detail` (`detail_id`, `detail_product`, `detail_amount`, `detail_order`) VALUES
(29149, 58, 5, 10044),
(29150, 59, 5, 10044),
(29151, 61, 1, 10045),
(29152, 63, 3, 10046),
(29153, 59, 2, 10046),
(29154, 62, 50, 10047),
(29155, 78, 3, 10048),
(29156, 79, 3, 10048),
(29157, 80, 6, 10048),
(29158, 59, 100, 10049),
(29159, 60, 1, 10050),
(29160, 80, 1, 10050),
(29161, 78, 1, 10050),
(29162, 80, 2, 10051),
(29163, 78, 1, 10051),
(29164, 79, 1, 10051),
(29165, 74, 3, 10051),
(29166, 75, 3, 10051),
(29167, 58, 1, 10052),
(29168, 70, 2, 10052),
(29169, 75, 1, 10052),
(29170, 80, 1, 10052),
(29171, 58, 1, 10053),
(29172, 62, 1, 10053),
(29173, 74, 1, 10053),
(29174, 70, 1, 10053),
(29175, 61, 1, 10054),
(29176, 58, 1, 10055),
(29177, 61, 1, 10056),
(29178, 70, 1, 10057),
(29179, 58, 1, 10058),
(29180, 74, 1, 10059),
(29181, 58, 4, 10060),
(29182, 58, 92, 10061),
(29183, 58, 1, 10062),
(29184, 58, 1, 10063),
(29185, 60, 1, 10064),
(29186, 86, 3, 10065),
(29187, 58, 1, 10066),
(29188, 75, 1, 10066),
(29189, 63, 1, 10066);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_osk`
--

CREATE TABLE `tbl_osk` (
  `osk_id` int(11) NOT NULL,
  `osk_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_osk`
--

INSERT INTO `tbl_osk` (`osk_id`, `osk_name`) VALUES
(1, 'สร้างเมือง'),
(2, 'สร้างเมือง2'),
(3, 'ตึกเก้าชั้น'),
(4, 'ขึ้นบ้านใหม่'),
(5, 'เสาธงทอง'),
(6, 'อะเมซิ่ง สวนฯ รังสิต'),
(7, 'พระบารมีปกเกล้า'),
(8, 'อาคารเฉลิมพระเกียรติ'),
(9, 'มังกรทอง'),
(10, 'ทศวรรษสวนฯ รังสิต'),
(11, 'เสด็จพระราชดำเนิน'),
(12, '72พรรษามหาราชินี'),
(13, 'ขยายเมือง'),
(14, 'ฉลองราชย์ครบ 60 ปี'),
(15, 'เฉลิม 80 พรรษามหามงคล'),
(16, 'เชื่อมประสานอาคารสิรินธร'),
(17, 'สมานฉันท์'),
(18, 'มาตรฐานสากล'),
(19, '84 พรรษามหาราชา'),
(20, 'วีสวรรษสวนฯรังสิต'),
(21, 'พัฒนาเมือง'),
(22, 'เมืองก้าวไกล'),
(23, '60พรรษาเจ้าฟ้าสิรินธร');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_product`
--

CREATE TABLE `tbl_product` (
  `pro_id` int(11) NOT NULL,
  `pro_name` varchar(30) NOT NULL,
  `pro_description` text NOT NULL,
  `pro_price` float NOT NULL,
  `pro_image` varchar(80) NOT NULL,
  `pro_year` int(11) NOT NULL,
  `pro_quantity` int(11) NOT NULL,
  `pro_status` int(11) NOT NULL,
  `pro_category` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_product`
--

INSERT INTO `tbl_product` (`pro_id`, `pro_name`, `pro_description`, `pro_price`, `pro_image`, `pro_year`, `pro_quantity`, `pro_status`, `pro_category`) VALUES
(58, 'iPhone 7', 'iPhone 7 and iPhone 7 Plus are smartphones designed, developed, and marketed by Apple Inc. They were announced on September 7, 2016, at the Bill Graham Civic Auditorium in San Francisco by Apple CEO Tim Cook, and were released on September 16, 2016, succeeding the iPhone 6S and iPhone 6S Plus as the current flagship devices in the iPhone series. Apple also released the iPhone 7 and 7 Plus in numerous countries worldwide throughout September and October 2016.', 18900, 'iphone-7.jpg', 58, 697, 1, 1),
(59, 'iPhone 7 Plus', 'iPhone 7 and iPhone 7 Plus are smartphones designed, developed, and marketed by Apple Inc. They were announced on September 7, 2016, at the Bill Graham Civic Auditorium in San Francisco by Apple CEO Tim Cook, and were released on September 16, 2016, succeeding the iPhone 6S and iPhone 6S Plus as the current flagship devices in the iPhone series. Apple also released the iPhone 7 and 7 Plus in numerous countries worldwide throughout September and October 2016.', 35000, 'iphone-7-plus.jpg', 58, 0, 1, 1),
(60, 'iPhone SE', 'iPhone 7 and iPhone 7 Plus are smartphones designed, developed, and marketed by Apple Inc. They were announced on September 7, 2016, at the Bill Graham Civic Auditorium in San Francisco by Apple CEO Tim Cook, and were released on September 16, 2016, succeeding the iPhone 6S and iPhone 6S Plus as the current flagship devices in the iPhone series. Apple also released the iPhone 7 and 7 Plus in numerous countries worldwide throughout September and October 2016.', 15000, 'iphone-se.jpg', 58, 98, 1, 1),
(61, 'iPad Mini 4', 'iPhone 7 and iPhone 7 Plus are smartphones designed, developed, and marketed by Apple Inc. They were announced on September 7, 2016, at the Bill Graham Civic Auditorium in San Francisco by Apple CEO Tim Cook, and were released on September 16, 2016, succeeding the iPhone 6S and iPhone 6S Plus as the current flagship devices in the iPhone series. Apple also released the iPhone 7 and 7 Plus in numerous countries worldwide throughout September and October 2016.', 14000, 'ipad-mini-4.jpg', 59, 798, 1, 2),
(62, 'iPad Pro 9.7', 'iPhone 7 and iPhone 7 Plus are smartphones designed, developed, and marketed by Apple Inc. They were announced on September 7, 2016, at the Bill Graham Civic Auditorium in San Francisco by Apple CEO Tim Cook, and were released on September 16, 2016, succeeding the iPhone 6S and iPhone 6S Plus as the current flagship devices in the iPhone series. Apple also released the iPhone 7 and 7 Plus in numerous countries worldwide throughout September and October 2016.', 20500, 'ipad-pro-97.jpg', 59, 899, 1, 2),
(63, 'iPad Pro 12.9', 'iPhone 7 and iPhone 7 Plus are smartphones designed, developed, and marketed by Apple Inc. They were announced on September 7, 2016, at the Bill Graham Civic Auditorium in San Francisco by Apple CEO Tim Cook, and were released on September 16, 2016, succeeding the iPhone 6S and iPhone 6S Plus as the current flagship devices in the iPhone series. Apple also released the iPhone 7 and 7 Plus in numerous countries worldwide throughout September and October 2016.', 29000, 'ipad-pro-129.jpg', 59, 4999, 1, 2),
(70, 'Mac Mini', 'iPhone 7 and iPhone 7 Plus are smartphones designed, developed, and marketed by Apple Inc. They were announced on September 7, 2016, at the Bill Graham Civic Auditorium in San Francisco by Apple CEO Tim Cook, and were released on September 16, 2016, succeeding the iPhone 6S and iPhone 6S Plus as the current flagship devices in the iPhone series. Apple also released the iPhone 7 and 7 Plus in numerous countries worldwide throughout September and October 2016.', 10500, 'ac9b67842f9083938df5481549f3e9fd.jpg', 0, 496, 1, 4),
(71, 'Macbook Pro', 'iPhone 7 and iPhone 7 Plus are smartphones designed, developed, and marketed by Apple Inc. They were announced on September 7, 2016, at the Bill Graham Civic Auditorium in San Francisco by Apple CEO Tim Cook, and were released on September 16, 2016, succeeding the iPhone 6S and iPhone 6S Plus as the current flagship devices in the iPhone series. Apple also released the iPhone 7 and 7 Plus in numerous countries worldwide throughout September and October 2016.', 49500, '5ce61c63b6cea8f54e12f8478ae99542.jpg', 0, 900, 1, 4),
(72, 'iMac', 'iPhone 7 and iPhone 7 Plus are smartphones designed, developed, and marketed by Apple Inc. They were announced on September 7, 2016, at the Bill Graham Civic Auditorium in San Francisco by Apple CEO Tim Cook, and were released on September 16, 2016, succeeding the iPhone 6S and iPhone 6S Plus as the current flagship devices in the iPhone series. Apple also released the iPhone 7 and 7 Plus in numerous countries worldwide throughout September and October 2016.', 59900, '3a5088d0ad66b084d97691eb73061700.jpg', 0, 9000, 1, 4),
(73, 'Mac Pro', 'iPhone 7 and iPhone 7 Plus are smartphones designed, developed, and marketed by Apple Inc. They were announced on September 7, 2016, at the Bill Graham Civic Auditorium in San Francisco by Apple CEO Tim Cook, and were released on September 16, 2016, succeeding the iPhone 6S and iPhone 6S Plus as the current flagship devices in the iPhone series. Apple also released the iPhone 7 and 7 Plus in numerous countries worldwide throughout September and October 2016.', 89000, 'ed4d07cce7176463ad1fe5dcf7d21f61.jpg', 0, 0, 1, 4),
(74, 'iPod Classic', '', 5900, '7ac01c4d78672d397050c160afcfe328.jpg', 0, 495, 1, 3),
(75, 'iPod Nano', '', 6900, 'e7343f2953693364e447a79c0734ab88.jpg', 0, 45, 1, 3),
(76, 'iPod  Shuffle', '', 990, '00b595e793cfd38d37da901dd4ebd1c4.jpg', 0, 50, 1, 3),
(77, 'iPod Touch', '', 6000, 'ba51e955f452552f184dcb28adc72075.jpg', 0, 5000, 1, 3),
(78, '5W USB ', '', 890, 'e2701e1c6a7da8ac11aa1977f3f622e2.jpg', 0, 79995, 1, 5),
(79, '12W USB ', '', 990, 'b0bdc045f9698d1392d43a853087ce9b.jpg', 0, 899996, 1, 5),
(80, 'Lightning', 'bbbb', 590, 'b1c8ffae9372e3afdf3812d5af03bdb0.jpg', 0, 99990, 1, 5),
(81, 'Bear', '', 112, 'f6965da4b7f23a52afaed3c9397b615f.jpg', 0, 9, 0, 5),
(82, 'Lightning TO HDMI Adapter', 'sghslgsgsaghiawbhoaebeih', 1200, '6285bbd91a6affcda2781b4eb8b3038d.', 0, 5000, 0, 5),
(83, 'zzzzzz', 'xxx', 99, '1125f2fba82666d30932a513f8c10b4e.jpg', 0, 99, 0, 1),
(84, 'pp', 'xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx', 123, '91296671bf940289ee00b162fe3da3c6.jpg', 0, 78, 0, 1),
(85, 'pp', 'ooo3iro', 29000, '67cf7f64c6a45dbdfa7104fc8fdfcd2e.jpg', 0, 0, 0, 1),
(86, 'ipod 1', 'xxxxxxxxxxxxxxxxxx', 100, 'f0716f3f4147a77e977a44313a779efe.jpg', 0, 2, 0, 3);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_shipping`
--

CREATE TABLE `tbl_shipping` (
  `ship_id` int(11) NOT NULL,
  `ship_name` varchar(50) NOT NULL,
  `ship_address` varchar(1000) NOT NULL,
  `ship_district` varchar(30) NOT NULL,
  `ship_amphoe` varchar(30) NOT NULL,
  `ship_province` varchar(30) NOT NULL,
  `ship_zipcode` varchar(30) NOT NULL,
  `ship_phone` varchar(20) NOT NULL,
  `ship_member` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_shipping`
--

INSERT INTO `tbl_shipping` (`ship_id`, `ship_name`, `ship_address`, `ship_district`, `ship_amphoe`, `ship_province`, `ship_zipcode`, `ship_phone`, `ship_member`) VALUES
(26, 'Tete Komkhuam', '123/456 หมู่บ้านศุภาลัยบุรี คลอง4 ถ.รังสิต-นครนายก', 'ประชาธิปัตย์', 'ธัญบุรี', 'ปทุมธานี', '12130', '0891231234', 10),
(27, 'Tete Komkhuam', '789 ถ.สุขุมวิท', 'ปากน้ำ', 'เมืองสมุทรปราการ', 'สมุทรปราการ', '10270', '021234567', 10),
(31, 'Harry Potter', '999 ถ.อีผี', 'วังบูรพาภิรมย์', 'พระนคร', 'กรุงเทพมหานคร', '10200', '0881234567', 1),
(32, 'Ron Weasley', '9999 ถ.บลาๆๆๆ', 'ลานสกา', 'ลานสกา', 'นครศรีธรรมราช', '80230', '0864480461', 2),
(33, 'Ron Weasley', '5555 หมู่บ้านศุภาลัยบุรี ถ.รังสิตนครนายก', 'คลองสี่', 'คลองหลวง', 'ปทุมธานี', '12120', '0864480461', 2),
(34, 'Judy Hopps', '1234 ถ.บลาๆๆ', 'มาบยางพร', 'ปลวกแดง', 'ระยอง', '21140', '0897897899', 19),
(35, 'Judy Hopps', '5679 ถ.อีผี', 'หล่มสัก', 'หล่มสัก', 'เพชรบูรณ์', '67110', '0897897899', 19),
(36, 'oak1234', '1234 ถ.สุขุมวิท', 'ลำลูกกา', 'ลำลูกกา', 'ปทุมธานี', '12150', '1234', 45),
(37, 'หน้ากากทุเรียน', '9999 ถ.อิอิ', 'บ้านโป่ง', 'บ้านโป่ง', 'ราชบุรี', '70110', '0881911001', 14),
(38, 'หน้ากากทุเรียน', '9999', 'ดงกลาง', 'จตุรพักตร์พิมาน', 'ร้อยเอ็ด', '45180', '0881911001', 14),
(39, 'fffgd', '1234567890-', 'ทุ่งคา', 'เมืองชุมพร', 'ชุมพร', '86100', '02128520852052', 46),
(40, 'asdfg', '125454125', 'ทุ่งคา', 'เมืองชุมพร', 'ชุมพร', '86100', '1254985', 47),
(41, 'SSRU SSRU', '1234', 'ดงกระทงยาม', 'ศรีมหาโพธิ', 'ปราจีนบุรี', '25140', '021234567', 50);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_cart`
--
ALTER TABLE `tbl_cart`
  ADD PRIMARY KEY (`cart_id`);

--
-- Indexes for table `tbl_category`
--
ALTER TABLE `tbl_category`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `tbl_comment`
--
ALTER TABLE `tbl_comment`
  ADD PRIMARY KEY (`com_id`);

--
-- Indexes for table `tbl_config`
--
ALTER TABLE `tbl_config`
  ADD PRIMARY KEY (`cfg_id`);

--
-- Indexes for table `tbl_feedback`
--
ALTER TABLE `tbl_feedback`
  ADD PRIMARY KEY (`feed_id`);

--
-- Indexes for table `tbl_member`
--
ALTER TABLE `tbl_member`
  ADD PRIMARY KEY (`mem_id`);

--
-- Indexes for table `tbl_order`
--
ALTER TABLE `tbl_order`
  ADD PRIMARY KEY (`or_id`);

--
-- Indexes for table `tbl_order_detail`
--
ALTER TABLE `tbl_order_detail`
  ADD PRIMARY KEY (`detail_id`);

--
-- Indexes for table `tbl_osk`
--
ALTER TABLE `tbl_osk`
  ADD PRIMARY KEY (`osk_id`);

--
-- Indexes for table `tbl_product`
--
ALTER TABLE `tbl_product`
  ADD PRIMARY KEY (`pro_id`);

--
-- Indexes for table `tbl_shipping`
--
ALTER TABLE `tbl_shipping`
  ADD PRIMARY KEY (`ship_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_cart`
--
ALTER TABLE `tbl_cart`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `tbl_category`
--
ALTER TABLE `tbl_category`
  MODIFY `cat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `tbl_comment`
--
ALTER TABLE `tbl_comment`
  MODIFY `com_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_config`
--
ALTER TABLE `tbl_config`
  MODIFY `cfg_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tbl_feedback`
--
ALTER TABLE `tbl_feedback`
  MODIFY `feed_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `tbl_member`
--
ALTER TABLE `tbl_member`
  MODIFY `mem_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;
--
-- AUTO_INCREMENT for table `tbl_order`
--
ALTER TABLE `tbl_order`
  MODIFY `or_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10067;
--
-- AUTO_INCREMENT for table `tbl_order_detail`
--
ALTER TABLE `tbl_order_detail`
  MODIFY `detail_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29190;
--
-- AUTO_INCREMENT for table `tbl_product`
--
ALTER TABLE `tbl_product`
  MODIFY `pro_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=87;
--
-- AUTO_INCREMENT for table `tbl_shipping`
--
ALTER TABLE `tbl_shipping`
  MODIFY `ship_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
