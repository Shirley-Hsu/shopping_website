-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- 主機： 127.0.0.1
-- 產生時間： 
-- 伺服器版本： 10.1.38-MariaDB
-- PHP 版本： 7.3.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫： `group_23`
--

-- --------------------------------------------------------

--
-- 資料表結構 `cart`
--

CREATE TABLE `cart` (
  `username` varchar(20) NOT NULL,
  `product_no` int(11) NOT NULL,
  `kind` varchar(10) NOT NULL,
  `count` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=big5;

-- --------------------------------------------------------

--
-- 資料表結構 `member`
--

CREATE TABLE `member` (
  `account` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  `level` int(11) NOT NULL,
  `email` varchar(35) NOT NULL,
  `id_number` varchar(10) NOT NULL,
  `gender` varchar(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=big5;

--
-- 傾印資料表的資料 `member`
--

INSERT INTO `member` (`account`, `password`, `level`, `email`, `id_number`, `gender`) VALUES
('admin', 'admin123456', 1, '', '', ''),
('member', 'member123456', 2, 'shirley41825@gmail.com', 'F230000000', '男'),
('shirley', 'dd900314', 2, 'shirley41825@gmail.com', 'F230567000', '女'),
('test', 'test1234', 2, '', '', ''),
('test1', 'test123', 2, 'shirley41825@gmail.com', 'F123456789', '男'),
('test2', '000000', 2, 'shirley41825@gmail.com', 'F123456789', '男');

-- --------------------------------------------------------

--
-- 資料表結構 `product`
--

CREATE TABLE `product` (
  `number` int(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  `price` int(11) NOT NULL,
  `classify` varchar(20) NOT NULL,
  `kind1` varchar(20) NOT NULL,
  `kind2` varchar(20) NOT NULL,
  `image` varchar(16) NOT NULL,
  `picture1` varchar(16) NOT NULL,
  `picture2` varchar(16) NOT NULL,
  `picture3` varchar(16) NOT NULL,
  `picture4` varchar(16) NOT NULL,
  `picture5` varchar(16) NOT NULL,
  `sales` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=big5;

--
-- 傾印資料表的資料 `product`
--

INSERT INTO `product` (`number`, `name`, `price`, `classify`, `kind1`, `kind2`, `image`, `picture1`, `picture2`, `picture3`, `picture4`, `picture5`, `sales`) VALUES
(1, '寵物涼涼墊', 355, '生活用品', '兩面靠', '三面靠', 'doggy1.jpg', 'doggy1-1.jpg', 'doggy1-2.jpg', 'doggy1-3.jpg', 'doggy1-4.jpg', 'doggy1-5.jpg', 72),
(2, '牙刷牙膏套組', 299, '清潔用品', '草莓口味', '薄荷口味', 'doggy2.jpg', 'doggy2-1.jpg', 'doggy2-2.jpg', 'doggy2-3.jpg', 'doggy2-4.jpg', 'doggy2-5.jpg', 37),
(3, '寵物洗腳杯', 350, '清潔用品', '灰色', '粉色', 'doggy3.jpg', 'doggy3-1.jpg', 'doggy3-2.jpg', 'doggy3-3.jpg', 'doggy3-4.jpg', 'doggy3-5.jpg', 56),
(4, '四腳全包雨衣', 350, '外出用具', '黃色', '黑色', 'doggy4.jpg', 'doggy4-1.jpg', 'doggy4-2.jpg', 'doggy4-3.jpg', 'doggy4-4.jpg', 'doggy4-5.jpg', 17),
(5, '狗狗益智漏食盤', 455, '玩具', '綠色', '粉色', 'doggy5.jpg', 'doggy5-1.jpg', 'doggy5-2.jpg', 'doggy5-3.jpg', 'doggy5-4.jpg', 'doggy5-5.jpg', 50),
(6, 'dog狗衣服', 1750, '衣服', '紅色', '黑色', 'doggy6.jpg', 'doggy6-1.jpg', 'doggy6-2.jpg', 'doggy6-3.jpg', 'doggy6-4.jpg', 'doggy6-5.jpg', 16),
(7, '益智不倒翁', 250, '玩具', '綠色', '黃色', 'doggy7.jpg', 'doggy7-1.jpg', 'doggy7-2.jpg', 'doggy7-3.jpg', 'doggy7-4.jpg', 'doggy7-5.jpg', 22),
(8, '寵物移動城堡', 750, '外出用具', '橘色', '黃色', 'doggy8.jpg', 'doggy8-1.jpg', 'doggy8-2.jpg', 'doggy8-3.jpg', 'doggy8-4.jpg', 'doggy8-5.jpg', 43),
(9, '寵物全效洗潔劑', 950, '清潔用品', '300ml*2', '600ml*1', 'doggy9.jpg', 'doggy9-1.jpg', 'doggy9-2.jpg', 'doggy9-3.jpg', 'doggy9-4.jpg', 'doggy9-5.jpg', 72),
(10, '寵物牽引繩', 175, '外出用具', '藍色', '白色', 'doggy10.jpg', 'doggy10-1.jpg', 'doggy10-2.jpg', 'doggy10-3.jpg', 'doggy10-4.jpg', 'doggy10-5.jpg', 49);

-- --------------------------------------------------------

--
-- 資料表結構 `userorder`
--

CREATE TABLE `userorder` (
  `username` varchar(20) NOT NULL,
  `state` int(11) NOT NULL,
  `order_no` int(11) NOT NULL,
  `buy` varchar(100) NOT NULL,
  `total` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=big5;

--
-- 傾印資料表的資料 `userorder`
--

INSERT INTO `userorder` (`username`, `state`, `order_no`, `buy`, `total`) VALUES
('shirley', 2, 3, '寵物涼涼墊--*2<br>寵物移動城堡--*2<br>寵物洗腳杯--*2<br>', 2900),
('shirley', 2, 7, '寵物涼涼墊--隨機*2<br>狗狗益智漏食盤--粉色*2<br>', 1600),
('member', 2, 12, '寵物全效洗潔劑--隨機*2<br>寵物涼涼墊--隨機*1<br>', 2255),
('member', 1, 13, '牙刷牙膏套組--隨機*1<br>狗狗益智漏食盤--隨機*1<br>', 754);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
