-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.0.31 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             12.3.0.6589
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for bookshop
CREATE DATABASE IF NOT EXISTS `bookshop` /*!40100 DEFAULT CHARACTER SET utf8mb3 */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `bookshop`;

-- Dumping structure for table bookshop.admin
CREATE TABLE IF NOT EXISTS `admin` (
  `fname` varchar(45) DEFAULT NULL,
  `lname` varchar(45) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `vcode` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- Dumping data for table bookshop.admin: ~2 rows (approximately)
INSERT INTO `admin` (`fname`, `lname`, `email`, `vcode`) VALUES
	('Sahan', 'Perera', 'sandeepaherath2001@gmail.com', '660f94ec2116c'),
	('Namal', 'Pethum', 'worasolutionslk@gmail.com', '674c0a2aa8c5e');

-- Dumping structure for table bookshop.author
CREATE TABLE IF NOT EXISTS `author` (
  `author_id` int NOT NULL AUTO_INCREMENT,
  `author_name` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`author_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table bookshop.author: ~7 rows (approximately)
INSERT INTO `author` (`author_id`, `author_name`) VALUES
	(1, 'Chandana Mendis'),
	(2, 'Sudath Rohan'),
	(3, 'SRD Rosa'),
	(8, 'Martin Wickramasinghe'),
	(9, 'Ediriweera Sarachchandra'),
	(10, 'Herman Melville'),
	(11, 'D. M. Anura Dissanayaka');

-- Dumping structure for table bookshop.author_has_publisher
CREATE TABLE IF NOT EXISTS `author_has_publisher` (
  `author_author_id` int NOT NULL,
  `publisher_publisher_id` int NOT NULL,
  `id` int NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`),
  KEY `fk_model_has_brand_brand1_idx` (`publisher_publisher_id`),
  KEY `fk_model_has_brand_model1_idx` (`author_author_id`),
  CONSTRAINT `fk_model_has_brand_brand1` FOREIGN KEY (`publisher_publisher_id`) REFERENCES `publisher` (`publisher_id`),
  CONSTRAINT `fk_model_has_brand_model1` FOREIGN KEY (`author_author_id`) REFERENCES `author` (`author_id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table bookshop.author_has_publisher: ~8 rows (approximately)
INSERT INTO `author_has_publisher` (`author_author_id`, `publisher_publisher_id`, `id`) VALUES
	(1, 1, 1),
	(2, 2, 2),
	(2, 3, 8),
	(3, 2, 9),
	(8, 1, 10),
	(9, 8, 11),
	(10, 9, 12),
	(11, 2, 13),
	(2, 1, 14);

-- Dumping structure for table bookshop.cart
CREATE TABLE IF NOT EXISTS `cart` (
  `cart_id` int NOT NULL AUTO_INCREMENT,
  `qty` int DEFAULT NULL,
  `user_email` varchar(100) NOT NULL,
  `product_id` int NOT NULL,
  PRIMARY KEY (`cart_id`),
  KEY `fk_cart_user1_idx` (`user_email`),
  KEY `fk_cart_product1_idx` (`product_id`),
  CONSTRAINT `fk_cart_product1` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`),
  CONSTRAINT `fk_cart_user1` FOREIGN KEY (`user_email`) REFERENCES `user` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table bookshop.cart: ~6 rows (approximately)
INSERT INTO `cart` (`cart_id`, `qty`, `user_email`, `product_id`) VALUES
	(5, 2, 'worasolutionslk@gmail.com', 8),
	(7, 1, 'worasolutionslk@gmail.com', 1),
	(11, 1, 'worasolutionslk@gmail.com', 10),
	(12, 3, 'worasolutionslk@gmail.com', 14),
	(13, 1, 'worasolutionslk@gmail.com', 18);

-- Dumping structure for table bookshop.category
CREATE TABLE IF NOT EXISTS `category` (
  `cat_id` int NOT NULL AUTO_INCREMENT,
  `cat_name` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`cat_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table bookshop.category: ~6 rows (approximately)
INSERT INTO `category` (`cat_id`, `cat_name`) VALUES
	(1, 'Novels'),
	(2, 'Short Stories'),
	(3, 'Educational'),
	(4, 'Language'),
	(5, 'Religion'),
	(7, 'Translations');

-- Dumping structure for table bookshop.category_has_publisher
CREATE TABLE IF NOT EXISTS `category_has_publisher` (
  `category_cat_id` int NOT NULL,
  `publisher_publisher_id` int NOT NULL,
  KEY `fk_category_has_brand_brand1_idx` (`publisher_publisher_id`),
  KEY `fk_category_has_brand_category1_idx` (`category_cat_id`),
  CONSTRAINT `fk_category_has_brand_brand1` FOREIGN KEY (`publisher_publisher_id`) REFERENCES `publisher` (`publisher_id`),
  CONSTRAINT `fk_category_has_brand_category1` FOREIGN KEY (`category_cat_id`) REFERENCES `category` (`cat_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- Dumping data for table bookshop.category_has_publisher: ~0 rows (approximately)

-- Dumping structure for table bookshop.chat
CREATE TABLE IF NOT EXISTS `chat` (
  `chat_id` int NOT NULL AUTO_INCREMENT,
  `content` text,
  `date_time` datetime DEFAULT NULL,
  `status` int DEFAULT NULL,
  `from` varchar(100) NOT NULL,
  `to` varchar(100) NOT NULL,
  PRIMARY KEY (`chat_id`),
  KEY `fk_chat_user1_idx` (`from`),
  KEY `fk_chat_admin1_idx` (`to`),
  CONSTRAINT `fk_chat_admin1` FOREIGN KEY (`to`) REFERENCES `admin` (`email`),
  CONSTRAINT `fk_chat_user1` FOREIGN KEY (`from`) REFERENCES `user` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table bookshop.chat: ~1 rows (approximately)
INSERT INTO `chat` (`chat_id`, `content`, `date_time`, `status`, `from`, `to`) VALUES
	(17, 'Hi', '2024-06-26 18:36:02', 2, 'worasolutionslk@gmail.com', 'sandeepaherath2001@gmail.com'),
	(18, 'How to help', '2024-12-01 08:03:52', 3, 'worasolutionslk@gmail.com', 'sandeepaherath2001@gmail.com');

-- Dumping structure for table bookshop.city
CREATE TABLE IF NOT EXISTS `city` (
  `city_id` int NOT NULL AUTO_INCREMENT,
  `city_name` varchar(45) DEFAULT NULL,
  `district_district_id` int NOT NULL,
  PRIMARY KEY (`city_id`),
  KEY `fk_city_district1_idx` (`district_district_id`),
  CONSTRAINT `fk_city_district1` FOREIGN KEY (`district_district_id`) REFERENCES `district` (`district_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table bookshop.city: ~8 rows (approximately)
INSERT INTO `city` (`city_id`, `city_name`, `district_district_id`) VALUES
	(1, 'Kurunegala', 1),
	(2, 'Kuliyapaitiya', 1),
	(3, 'Colombo', 4),
	(4, 'Baththaramulla', 4),
	(5, 'Sri Jayawardhanapura', 4),
	(6, 'Anamaduwa', 2),
	(7, 'Kaluthara', 5),
	(8, 'Anuradhapura', 3);

-- Dumping structure for table bookshop.district
CREATE TABLE IF NOT EXISTS `district` (
  `district_id` int NOT NULL AUTO_INCREMENT,
  `district_name` varchar(45) DEFAULT NULL,
  `province_province_id` int NOT NULL,
  PRIMARY KEY (`district_id`),
  KEY `fk_district_province1_idx` (`province_province_id`),
  CONSTRAINT `fk_district_province1` FOREIGN KEY (`province_province_id`) REFERENCES `province` (`province_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table bookshop.district: ~4 rows (approximately)
INSERT INTO `district` (`district_id`, `district_name`, `province_province_id`) VALUES
	(1, 'Kurunegala', 2),
	(2, 'Puttlam', 2),
	(3, 'Anuradhapura', 4),
	(4, 'Colombo', 1),
	(5, 'Kaluthara', 1);

-- Dumping structure for table bookshop.feedback
CREATE TABLE IF NOT EXISTS `feedback` (
  `feed_id` int NOT NULL AUTO_INCREMENT,
  `type` int DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `feed` varchar(250) DEFAULT NULL,
  `product_id` int NOT NULL,
  `user_email` varchar(100) NOT NULL,
  PRIMARY KEY (`feed_id`),
  KEY `fk_feedback_product1_idx` (`product_id`),
  KEY `fk_feedback_user1_idx` (`user_email`),
  CONSTRAINT `fk_feedback_product1` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`),
  CONSTRAINT `fk_feedback_user1` FOREIGN KEY (`user_email`) REFERENCES `user` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table bookshop.feedback: ~4 rows (approximately)
INSERT INTO `feedback` (`feed_id`, `type`, `date`, `feed`, `product_id`, `user_email`) VALUES
	(1, 1, '2024-06-11 12:29:33', 'Good book ever read', 11, 'worasolutionslk@gmail.com'),
	(2, 1, '2024-06-11 13:58:31', 'Good book for reading', 8, 'worasolutionslk@gmail.com'),
	(4, 1, '2024-06-11 21:06:43', 'Good book for science students', 12, 'worasolutionslk@gmail.com');

-- Dumping structure for table bookshop.gender
CREATE TABLE IF NOT EXISTS `gender` (
  `gender_id` int NOT NULL AUTO_INCREMENT,
  `gender_name` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`gender_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table bookshop.gender: ~1 rows (approximately)
INSERT INTO `gender` (`gender_id`, `gender_name`) VALUES
	(1, 'Male'),
	(2, 'Female');

-- Dumping structure for table bookshop.invoice
CREATE TABLE IF NOT EXISTS `invoice` (
  `invoice_id` int NOT NULL AUTO_INCREMENT,
  `order_id` varchar(20) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `total` double DEFAULT NULL,
  `qty` int DEFAULT NULL,
  `product_id` int NOT NULL,
  `user_email` varchar(100) NOT NULL,
  `order_status_status_id` int NOT NULL,
  PRIMARY KEY (`invoice_id`),
  KEY `fk_invoice_product1_idx` (`product_id`),
  KEY `fk_invoice_user1_idx` (`user_email`),
  KEY `fk_invoice_order_status1_idx` (`order_status_status_id`),
  CONSTRAINT `fk_invoice_order_status1` FOREIGN KEY (`order_status_status_id`) REFERENCES `order_status` (`status_id`),
  CONSTRAINT `fk_invoice_product1` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`),
  CONSTRAINT `fk_invoice_user1` FOREIGN KEY (`user_email`) REFERENCES `user` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table bookshop.invoice: ~5 rows (approximately)
INSERT INTO `invoice` (`invoice_id`, `order_id`, `date`, `total`, `qty`, `product_id`, `user_email`, `order_status_status_id`) VALUES
	(4, '66646c36a51d8', '2024-06-08 20:06:16', 750, 1, 9, 'worasolutionslk@gmail.com', 3),
	(5, '666863c1991b4', '2024-06-11 20:19:22', 900, 1, 12, 'worasolutionslk@gmail.com', 2),
	(7, '667a86a6af501', '2024-06-25 14:28:59', 800, 1, 10, 'worasolutionslk@gmail.com', 2),
	(8, '667d02b7c2824', '2024-06-27 11:43:01', 1100, 1, 13, 'worasolutionslk@gmail.com', 1),
	(9, '667dbc00ca73f', '2024-06-28 00:53:34', 1700, 3, 18, 'worasolutionslk@gmail.com', 3),
	(10, '674c092f96541', '2024-12-01 12:29:32', 800, 1, 18, 'worasolutionslk@gmail.com', 1);

-- Dumping structure for table bookshop.order_status
CREATE TABLE IF NOT EXISTS `order_status` (
  `status_id` int NOT NULL,
  `status` varchar(45) NOT NULL,
  PRIMARY KEY (`status_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- Dumping data for table bookshop.order_status: ~2 rows (approximately)
INSERT INTO `order_status` (`status_id`, `status`) VALUES
	(1, 'Waiting for accept'),
	(2, 'Order Placed'),
	(3, 'Delivered');

-- Dumping structure for table bookshop.product
CREATE TABLE IF NOT EXISTS `product` (
  `id` int NOT NULL AUTO_INCREMENT,
  `price` double DEFAULT NULL,
  `qty` int DEFAULT NULL,
  `description` text,
  `title` varchar(100) DEFAULT NULL,
  `datetime_added` datetime DEFAULT NULL,
  `delivery_fee_colombo` double DEFAULT NULL,
  `delivery_fee_other` double DEFAULT NULL,
  `category_cat_id` int NOT NULL,
  `author_has_publisher_id` int NOT NULL,
  `status_status_id` int NOT NULL,
  `admin_email` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_product_category1_idx` (`category_cat_id`),
  KEY `fk_product_model_has_brand1_idx` (`author_has_publisher_id`),
  KEY `fk_product_status1_idx` (`status_status_id`),
  KEY `fk_product_admin1_idx` (`admin_email`),
  CONSTRAINT `fk_product_admin1` FOREIGN KEY (`admin_email`) REFERENCES `admin` (`email`),
  CONSTRAINT `fk_product_category1` FOREIGN KEY (`category_cat_id`) REFERENCES `category` (`cat_id`),
  CONSTRAINT `fk_product_model_has_brand1` FOREIGN KEY (`author_has_publisher_id`) REFERENCES `author_has_publisher` (`id`),
  CONSTRAINT `fk_product_status1` FOREIGN KEY (`status_status_id`) REFERENCES `status` (`status_id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table bookshop.product: ~11 rows (approximately)
INSERT INTO `product` (`id`, `price`, `qty`, `description`, `title`, `datetime_added`, `delivery_fee_colombo`, `delivery_fee_other`, `category_cat_id`, `author_has_publisher_id`, `status_status_id`, `admin_email`) VALUES
	(1, 560, 10, 'This is the famous book of world Sherlock Holmes', 'Sherlock Holmes and hount of the Bascawil', '2024-03-28 17:59:44', 200, 350, 1, 1, 1, 'sandeepaherath2001@gmail.com'),
	(8, 450, 30, 'Apuru iskole is a translated book translated by Mr. Sudath Rohan.', 'Apuru Iskole', '2024-04-04 22:57:27', 250, 300, 1, 8, 1, 'worasolutionslk@gmail.com'),
	(9, 500, 0, 'Physics Past paper rewiew 2020 ', 'Physics Paper Rewiew 2020', '2024-04-05 11:49:55', 250, 300, 3, 9, 1, 'sandeepaherath2001@gmail.com'),
	(10, 550, 32, 'Sherlock holmes new book 1', 'Sherlock Holmes 1', '2024-04-10 14:56:55', 250, 300, 1, 1, 1, 'worasolutionslk@gmail.com'),
	(11, 600, 40, 'Sherlock homes new book 2', 'Sherlock Holmes 2', '2024-04-10 14:58:16', 250, 300, 1, 1, 1, 'worasolutionslk@gmail.com'),
	(12, 650, 23, 'Mechanical science book wrote by Mr. Rosa', 'Mechanical Science', '2024-06-10 13:50:02', 250, 350, 3, 9, 1, 'worasolutionslk@gmail.com'),
	(13, 750, 9, 'Kaliyugaya is a novel written by Sinhala writer Martin Wickremasinghe and first published in 1957. It is the second book of Wickremasinghe trilogy that started with Gamperaliya - transformation of a village. The final book of the trilogy is Yuganthaya. It was adapted into a movie by Lester James Peries in 1981.', 'Kaliyugaya', '2024-06-26 21:44:12', 350, 400, 1, 10, 1, 'worasolutionslk@gmail.com'),
	(14, 660, 10, 'Gamperaliya is a novel written by Sri Lankan writer Martin Wickremasinghe and first published in 1944.', 'Gamperaliya', '2024-06-26 21:46:14', 350, 400, 1, 10, 1, 'worasolutionslk@gmail.com'),
	(15, 700, 12, 'Veditantirige Ediriweera Ranjitha Sarachchandra, popularly known as Ediriweera Sarachchandra Sinhala: එදිරිවීර සරච්චන්ද්‍ර, was a Sri Lankan playwright, novelist, poet, literary critic, essayist and social commentator.', 'Malagiya Atto', '2024-06-26 21:50:29', 350, 400, 1, 11, 1, 'worasolutionslk@gmail.com'),
	(16, 300, 5, 'Bartleby, the Scrivener: A Story of Wall Street is a short story by the American writer Herman Melville, first serialized anonymously in two parts in the November and December 1853 issues of Putnams Magazine and reprinted with minor textual alterations in his The Piazza Tales in 1856.', 'Bartleby, the Scrivener', '2024-06-26 21:57:44', 300, 350, 2, 12, 1, 'worasolutionslk@gmail.com'),
	(17, 1755, 12, 'ISBN 	9786245829019', 'Kalu Palama', '2024-06-26 22:02:05', 350, 400, 7, 13, 1, 'worasolutionslk@gmail.com'),
	(18, 450, 8, 'asdsfsdf fdgfd', 'Thummanhandiya', '2024-06-28 00:49:23', 350, 400, 1, 14, 1, 'worasolutionslk@gmail.com');

-- Dumping structure for table bookshop.product_img
CREATE TABLE IF NOT EXISTS `product_img` (
  `img_path` varchar(100) NOT NULL,
  `product_id` int NOT NULL,
  PRIMARY KEY (`img_path`),
  KEY `fk_product_img_product1_idx` (`product_id`),
  CONSTRAINT `fk_product_img_product1` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- Dumping data for table bookshop.product_img: ~32 rows (approximately)
INSERT INTO `product_img` (`img_path`, `product_id`) VALUES
	('resource//product_img//Apuru Iskole_1_660ee2ffba6f1.jpeg', 1),
	('resource//product_img//Apuru Iskole_0_6666b47ed451c.jpeg', 8),
	('resource//product_img//Apuru Iskole_1_6666b47edaf3c.jpeg', 8),
	('resource//product_img//Apuru Iskole_2_6666b47ee00aa.jpeg', 8),
	('resource//product_img//Physics Paper Rewiew 2020_0_660f980b08d7a.jpeg', 9),
	('resource//product_img//Physics Paper Rewiew 2020_1_660f980b0c9a0.jpeg', 9),
	('resource//product_img//Physics Paper Rewiew 2020_2_660f980b0da55.jpeg', 9),
	('resource//product_img//Sherlock Holmes 1_0_66165b5f94464.jpeg', 10),
	('resource//product_img//Sherlock Holmes 1_1_66165b5f97d1d.jpeg', 10),
	('resource//product_img//Sherlock Holmes 1_2_66165b5f9bad2.jpeg', 10),
	('resource//product_img//Sherlock Holmes 2_0_66165bb03ae09.jpeg', 11),
	('resource//product_img//Sherlock Holmes 2_1_66165bb04025a.jpeg', 11),
	('resource//product_img//Sherlock Holmes 2_2_66165bb044036.jpeg', 11),
	('resource//product_img//Mechanical Science_0_6666b732a75ea.jpeg', 12),
	('resource//product_img//Mechanical Science_1_6666b732abc38.jpeg', 12),
	('resource//product_img//Mechanical Science_2_6666b732af910.jpeg', 12),
	('resource//product_img//Kaliyugaya_0_667c3e5472806.jpeg', 13),
	('resource//product_img//Kaliyugaya_1_667c3e5473b6f.jpeg', 13),
	('resource//product_img//Kaliyugaya_2_667c3e547475b.jpeg', 13),
	('resource//product_img//Gamperaliya_0_667c3ecea03d4.jpeg', 14),
	('resource//product_img//Gamperaliya_1_667c3ecea1547.jpeg', 14),
	('resource//product_img//Gamperaliya_2_667c3ecea7c80.jpeg', 14),
	('resource//product_img//Malagiya Atto_0_667c3fcd0ab8c.jpeg', 15),
	('resource//product_img//Malagiya Atto_1_667c3fcd0e8a7.jpeg', 15),
	('resource//product_img//Malagiya Atto_2_667c3fcd12728.jpeg', 15),
	('resource//product_img//Bartleby, the Scrivener_0_667c418017519.jpeg', 16),
	('resource//product_img//Bartleby, the Scrivener_1_667c41801b451.jpeg', 16),
	('resource//product_img//Bartleby, the Scrivener_2_667c41801f081.jpeg', 16),
	('resource//product_img//Kalu Palama_0_667c4285e38e8.jpeg', 17),
	('resource//product_img//Kalu Palama_1_667c4285e4b65.jpeg', 17),
	('resource//product_img//Kalu Palama_2_667c4285eb06f.jpeg', 17),
	('resource//product_img//Thummanhandiya_0_667dbb3baf4fd.jpeg', 18),
	('resource//product_img//Thummanhandiya_1_667dbb3bb07a2.jpeg', 18),
	('resource//product_img//Thummanhandiya_2_667dbb3bb18da.jpeg', 18);

-- Dumping structure for table bookshop.profile_img
CREATE TABLE IF NOT EXISTS `profile_img` (
  `path` varchar(100) NOT NULL,
  `user_email` varchar(100) NOT NULL,
  PRIMARY KEY (`path`),
  KEY `fk_profile_img_user1_idx` (`user_email`),
  CONSTRAINT `fk_profile_img_user1` FOREIGN KEY (`user_email`) REFERENCES `user` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- Dumping data for table bookshop.profile_img: ~1 rows (approximately)
INSERT INTO `profile_img` (`path`, `user_email`) VALUES
	('resource//profile_images//Sandeepa_66686504bab96.png', 'worasolutionslk@gmail.com');

-- Dumping structure for table bookshop.province
CREATE TABLE IF NOT EXISTS `province` (
  `province_id` int NOT NULL AUTO_INCREMENT,
  `province_name` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`province_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table bookshop.province: ~4 rows (approximately)
INSERT INTO `province` (`province_id`, `province_name`) VALUES
	(1, 'Western'),
	(2, 'North Western'),
	(3, 'Central'),
	(4, 'North Central'),
	(5, 'South');

-- Dumping structure for table bookshop.publisher
CREATE TABLE IF NOT EXISTS `publisher` (
  `publisher_id` int NOT NULL AUTO_INCREMENT,
  `publisher_name` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`publisher_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table bookshop.publisher: ~5 rows (approximately)
INSERT INTO `publisher` (`publisher_id`, `publisher_name`) VALUES
	(1, 'Gunasena'),
	(2, 'Sarasavi'),
	(3, 'Malpiyali'),
	(7, 'Atlas'),
	(8, 'Ashirwada'),
	(9, 'Putnams Magazine');

-- Dumping structure for table bookshop.recent
CREATE TABLE IF NOT EXISTS `recent` (
  `r_id` int NOT NULL AUTO_INCREMENT,
  `product_id` int NOT NULL,
  `user_email` varchar(100) NOT NULL,
  PRIMARY KEY (`r_id`),
  KEY `fk_recent_product1_idx` (`product_id`),
  KEY `fk_recent_user1_idx` (`user_email`),
  CONSTRAINT `fk_recent_product1` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`),
  CONSTRAINT `fk_recent_user1` FOREIGN KEY (`user_email`) REFERENCES `user` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table bookshop.recent: ~4 rows (approximately)
INSERT INTO `recent` (`r_id`, `product_id`, `user_email`) VALUES
	(1, 8, 'worasolutionslk@gmail.com'),
	(3, 9, 'worasolutionslk@gmail.com'),
	(4, 1, 'worasolutionslk@gmail.com'),
	(5, 12, 'worasolutionslk@gmail.com'),
	(6, 11, 'worasolutionslk@gmail.com');

-- Dumping structure for table bookshop.status
CREATE TABLE IF NOT EXISTS `status` (
  `status_id` int NOT NULL AUTO_INCREMENT,
  `status` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`status_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table bookshop.status: ~1 rows (approximately)
INSERT INTO `status` (`status_id`, `status`) VALUES
	(1, 'Active'),
	(2, 'Inactive');

-- Dumping structure for table bookshop.user
CREATE TABLE IF NOT EXISTS `user` (
  `fname` varchar(50) NOT NULL,
  `lname` varchar(45) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(20) NOT NULL,
  `mobile` varchar(10) NOT NULL,
  `joined_date` datetime NOT NULL,
  `verification_code` varchar(20) DEFAULT NULL,
  `gender_gender_id` int NOT NULL,
  `status_status_id` int NOT NULL,
  PRIMARY KEY (`email`),
  KEY `fk_user_gender_idx` (`gender_gender_id`),
  KEY `fk_user_status1_idx` (`status_status_id`),
  CONSTRAINT `fk_user_gender` FOREIGN KEY (`gender_gender_id`) REFERENCES `gender` (`gender_id`),
  CONSTRAINT `fk_user_status1` FOREIGN KEY (`status_status_id`) REFERENCES `status` (`status_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- Dumping data for table bookshop.user: ~1 rows (approximately)
INSERT INTO `user` (`fname`, `lname`, `email`, `password`, `mobile`, `joined_date`, `verification_code`, `gender_gender_id`, `status_status_id`) VALUES
	('Sandeepa', 'Herath', 'worasolutionslk@gmail.com', '12345', '0771234567', '2024-03-23 12:04:06', '667dba67a063d', 1, 1);

-- Dumping structure for table bookshop.user_has_address
CREATE TABLE IF NOT EXISTS `user_has_address` (
  `user_email` varchar(100) NOT NULL,
  `city_city_id` int NOT NULL,
  `address_id` int NOT NULL AUTO_INCREMENT,
  `line1` text,
  `line2` text,
  `postal_code` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`address_id`),
  KEY `fk_user_has_city_city1_idx` (`city_city_id`),
  KEY `fk_user_has_city_user1_idx` (`user_email`),
  CONSTRAINT `fk_user_has_city_city1` FOREIGN KEY (`city_city_id`) REFERENCES `city` (`city_id`),
  CONSTRAINT `fk_user_has_city_user1` FOREIGN KEY (`user_email`) REFERENCES `user` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table bookshop.user_has_address: ~0 rows (approximately)
INSERT INTO `user_has_address` (`user_email`, `city_city_id`, `address_id`, `line1`, `line2`, `postal_code`) VALUES
	('worasolutionslk@gmail.com', 2, 3, 'Meenewa', 'Ilukhena', '60200');

-- Dumping structure for table bookshop.watchlist
CREATE TABLE IF NOT EXISTS `watchlist` (
  `w_id` int NOT NULL AUTO_INCREMENT,
  `user_email` varchar(100) NOT NULL,
  `product_id` int NOT NULL,
  PRIMARY KEY (`w_id`) USING BTREE,
  KEY `fk_watchlist_user1_idx` (`user_email`),
  KEY `fk_watchlist_product1_idx` (`product_id`),
  CONSTRAINT `fk_watchlist_product1` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`),
  CONSTRAINT `fk_watchlist_user1` FOREIGN KEY (`user_email`) REFERENCES `user` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table bookshop.watchlist: ~2 rows (approximately)
INSERT INTO `watchlist` (`w_id`, `user_email`, `product_id`) VALUES
	(39, 'worasolutionslk@gmail.com', 16),
	(40, 'worasolutionslk@gmail.com', 14);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
