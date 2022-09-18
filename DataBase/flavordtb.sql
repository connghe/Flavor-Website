-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th9 10, 2022 lúc 04:38 PM
-- Phiên bản máy phục vụ: 10.4.24-MariaDB
-- Phiên bản PHP: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `flavordtb`
--
CREATE DATABASE IF NOT EXISTS `flavordtb` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `flavordtb`;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `adminuser`
--

CREATE TABLE IF NOT EXISTS `adminuser` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(30) DEFAULT NULL,
  `hash_password` char(40) DEFAULT NULL,
  `firstname` varchar(30) NOT NULL,
  `lastname` varchar(30) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `phone` char(15) DEFAULT NULL,
  `avatar` text DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `adminuser`
--

INSERT INTO `adminuser` (`id`, `username`, `hash_password`, `firstname`, `lastname`, `email`, `phone`, `avatar`) VALUES
(1, 'admin', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'Trần', 'Duy Anh', 'admin@gmail.com', '0903232394', 'avatar.png');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `category`
--

CREATE TABLE IF NOT EXISTS `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `category`
--

INSERT INTO `category` (`id`, `name`) VALUES
(1, 'Dry'),
(2, 'Liquid');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `contactus`
--

CREATE TABLE IF NOT EXISTS `contactus` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `phone` char(10) NOT NULL,
  `title` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `message` text DEFAULT NULL,
  `date` date DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `contactus`
--

INSERT INTO `contactus` (`id`, `name`, `phone`, `title`, `email`, `message`, `date`) VALUES
(1, 'Trần Duy Anh', '0903232394', 'mua hang', 'saolaithe201@gmail.com', 'toi muon mua hang', '2022-08-25');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `orderdetail`
--

CREATE TABLE IF NOT EXISTS `orderdetail` (
  `product_id` int(11) DEFAULT NULL,
  `order_id` varchar(100) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  KEY `Fk_ordercart_products` (`product_id`),
  KEY `Fk_ordercart_orders` (`order_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `orderdetail`
--

INSERT INTO `orderdetail` (`product_id`, `order_id`, `quantity`, `price`) VALUES
(1, '202208251661385360', 1, 10),
(3, '202208251661385360', 1, 6),
(5, '202208251661385432', 1, 3),
(6, '202208251661385432', 1, 15),
(1, '202208251661390119', 4, 10),
(1, '20220827166160319319', 3, 8);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `orders`
--

CREATE TABLE IF NOT EXISTS `orders` (
  `id` varchar(100) NOT NULL,
  `date` date DEFAULT current_timestamp(),
  `rec_name` varchar(50) DEFAULT NULL,
  `rec_address` varchar(100) DEFAULT NULL,
  `rec_phone` char(15) DEFAULT NULL,
  `total_order` int(11) NOT NULL,
  `status` varchar(20) DEFAULT 'delivering',
  `user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `Fk_orders_users` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `orders`
--

INSERT INTO `orders` (`id`, `date`, `rec_name`, `rec_address`, `rec_phone`, `total_order`, `status`, `user_id`) VALUES
('202208251661385360', '2022-08-25', 'Nguyen Trong Duc', '905 De La Thanh', '0927023333', 16, 'received', 18),
('202208251661385432', '2022-08-25', 'Nguyen Trong Duc', '905 De La Thanh', '0927023333', 18, 'received', 18),
('202208251661390119', '2022-08-25', 'Nguyen Trong Duc', '905 De La Thanh', '0927023333', 40, 'delivering', 18),
('20220827166160319319', '2022-08-27', 'Trần Duy Anh', 'P329 Số 14 Ngách 65 Ngõ Thiên Hùng,Khâm Thiên,Đống Đa, Hà Nội', '0903232394', 24, 'delivering', 19);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `packing`
--

CREATE TABLE IF NOT EXISTS `packing` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `type` (`type`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `packing`
--

INSERT INTO `packing` (`id`, `type`) VALUES
(1, 'Bottle'),
(2, 'Package');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `products`
--

CREATE TABLE IF NOT EXISTS `products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `price` float DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `cateid` int(11) NOT NULL,
  `packingid` int(11) NOT NULL,
  `products_image` text DEFAULT NULL,
  `detail` text DEFAULT NULL,
  `sale` int(11) NOT NULL DEFAULT 0,
  `update_date` date NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`),
  KEY `Fk_products_packing` (`packingid`),
  KEY `Fk_products_category` (`cateid`)
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `products`
--

INSERT INTO `products` (`id`, `name`, `price`, `quantity`, `cateid`, `packingid`, `products_image`, `detail`, `sale`, `update_date`) VALUES
(1, 'Sauce BBQ', 10, 92, 2, 1, '6306327c5873b6.31644186.png', 'Corn sugar, water, fish sauce, refined vegetable oil, salt, onion, garlic, honey, lemongrass, flavor enhancer (INS 612, INS 635, INS 950, INS 955), mother oil, stabilizer (INS) 1422. INS 415), pepper, yeast extract, acidity regulator (INS 514(ii)), five-spice powder, synthetic color (group III caramel, allura red AC), preservative (INS 202) ).', 20, '2022-08-27'),
(2, ' Flour Stuffed Pancake', 5, 100, 1, 2, '630632fc40bab1.71751484.jpeg', 'Ingredients: Rice flour, tapioca starch. - The product has ingredients from rice flour and pure tapioca starch, very safe and nutritious. The powder has the characteristics of plasticity, toughness, natural white color. When processed, the cake powder gives pure white cake, soft meat and delicious and attractive taste.', 25, '2022-08-24'),
(3, 'Flour Pancake', 6, 100, 1, 2, '630633540cdf43.21876209.jpg', 'Rice starch, cornstarch, wheat flour, tapioca starch, salt, turmeric powder, food additive powder: foaming agent E (450i), (500ii).', 10, '2022-08-24'),
(4, 'Rice Bran Powder', 8, 100, 1, 2, '630633a1d26411.73750926.jpg', 'Rice bran is composed of layers of pericarp, aleurone, and subalerone, part of the germ and a small part of the starch-rich endosperm. Rice bran contains 12 - 22% oil, 11 - 17% protein, 6 - 14% fiber, vitamins such as vitamin E, thiamin, niacin and substances such as aluminum, calcium, chlorine, iron, magnesium, manganese, phosphorus, potassium, sodium and blood.', 12, '2022-08-24'),
(5, 'Soup VN', 3, 100, 1, 2, '6306341e89dfb3.46617996.jpg', 'Soup powder is a seasoning consisting of the main ingredients being sugar, pepper powder, salt, chili powder, garlic powder, dried scallions and flavor enhancers. The use of soup powder is used to season dishes, marinate ingredients and even dip fresh fruits and seafood to eat directly.', 0, '2022-08-21'),
(6, 'Cooking Oil', 15, 100, 2, 1, '630634505191b0.83433507.jpg', 'Cooking oil is a type of food containing high saturated fat including coconut oil, palm oil and palm kernel oil. Oils with lower amounts of saturated fat and higher amounts of unsaturated (or monounsaturated) fat are considered healthier.', 0, '2022-08-24'),
(7, 'Black  Sugar', 8, 100, 1, 2, '63063482479401.84974291.jpg', 'Refined sugar or black sugar are both sucrose, but black sugar contains added salt, iron, fiber, and is rich in B vitamins and energy. If black sugar is made from sugarcane grown by extensive method, it will contain higher nutritional content.', 0, '2022-08-24'),
(8, 'Hot Pot Seasoning', 12, 100, 2, 2, '630634cc1ad593.02191556.jpg', 'The product is made from a combination of chicken broth seasoning with powdered mushrooms such as shiitake, maitake and especially pine mushrooms (also known as boletus mushrooms) to bring a deep sweet and aromatic flavor. Besides, there are also dried shiitake mushrooms and goji berries, contributing to the richness and color of the hot pot. The small package of chicken fat attached will create a little bit of light fat to make the taste more attractive.', 0, '2022-08-24'),
(9, 'Spice seeds (Northwest - VietNam)', 18, 100, 1, 1, '6306355dc85a90.12707467.jpg', '\"Doi\" tree bark contains 0.24% alkaloids. The trunk mainly contains camphor 23.8%. Bark essential oil contains camphor 15.7%, safrol 14.3%. The above ingredients work as a digestive stimulant, treat abdominal pain, indigestion.\r\n\r\nThe ingredient that makes up the fragrance and value of the doi nut is Essential Oil. The pulp and seeds contain mainly safrol essential oil (70.2 and 72.9%, respectively). Older seeds have a higher oil content than young seeds. In addition, seeds also contain several types of flavonoids and alkanoids.', 0, '2022-08-24'),
(10, 'Broth Mix', 6, 100, 1, 2, '6306358a751fe4.84501756.jpg', 'Seasoning is a synthetic seasoning, the main ingredients are salt and MSG - flavor enhancer 621 and two flavor enhancers 627, 631. It is also possible that seasoning has some ingredients from bone broth, shrimp powder, chicken, straw mushrooms… for different flavors.', 0, '2022-08-24'),
(11, 'Oregano', 11, 100, 1, 1, '63063673f38490.13236721.jpg', 'Basil leaves are packed with antioxidants and essential oils that help produce substances like eugenol, methyl eugenol, and caryphyllene. These are all substances that support the normal functioning of the beta cells of the pancreas (cells with the function of storing and releasing insulin).', 0, '2022-08-10'),
(12, 'Fish Sauce', 7, 100, 2, 1, '630636ba2eb299.09807084.jpg', 'Fish Sauce is a type of fish sauce made from shrimp, also known as shrimp moi, sea shrimp that often live in brackish or salt water areas. The way to make fish sauce has to go through many stages, requiring high meticulousness to produce a batch of delicious and delicious fish sauce.', 0, '2022-08-24'),
(13, 'Shrimp Paste', 8, 100, 2, 1, '630636fa511047.24906776.jpg', 'Shrimp Paste is a type of fish sauce made mainly from shrimp or moi and table salt, through the fermentation process to create a characteristic flavor and color.', 0, '2022-08-24'),
(14, 'Fish Sauce (Nam Ngu)', 7, 100, 2, 1, '6306374d5fe2d1.38300654.jpg', 'Ingredients of fish sauce in fish sauce include: amino acids (total protein), mineral salts and vitamins... Protein in fish sauce is the amount of nitrogen in grams in a liter of fish sauce. Total protein proves the value of fish sauce, high total protein but low organic protein in fish sauce has poor value.', 0, '2022-08-24'),
(15, ' Green Pepper Sauce', 9, 100, 2, 1, '630637a9eda759.45912129.jpg', 'Green pepper: 20 grams. Horny chili: 1 fruit (can add dangerous chili if you want to eat spicy). White pepper: 3 grams. Green onions: 10 grams. Coriander: 20 grams. Purple onion: 35 grams. Garlic: 35 grams. Fish sauce: 50 grams.', 0, '2022-08-24'),
(16, 'Stir-fried Chili', 16, 100, 1, 1, '630637fb6b22e6.84555964.jpg', 'Lemongrass plants. Garlic bulbs. Ripe red seeds. Flessting. Seasoning: salt, sugar, soy sauce, cooking oil.', 0, '2022-08-24'),
(17, ' Peach Syrup', 13, 100, 2, 1, '6306385e001da3.76782602.jpg', 'Peach syrup is made from sugar, peaches, and water. To ferment for a period of time', 0, '2022-08-24'),
(18, ' Ketchup', 11, 100, 2, 1, '63063884a47b27.10643107.jpg', 'The ingredients of ketchup include: Tomato, cloves, vinegar, salt, sugar, pepper, celery, onion, cinnamon and spices such as basil, burdock... Usually, in the kitchen, the head The chef will choose the sweet tomato Lycopersicon pennellii to create a delicious ketchup.', 0, '2022-08-24'),
(19, 'Chili Sauce', 9, 100, 2, 1, '630638be839d03.76145116.jpg', 'The main ingredients of the product are carefully selected, including: Sugar, chili, water, modified starch, flavor enhancer, dextrose, maltodextrin, tomato concentrate, modified powder, garlic, mixed spices , preservative, stabilizer, synthetic sweetener, antioxidant, food color, acidity regulator, synthetic flavor, wasabi powder. Modern production lines and advanced technology have created Chinsu chili sauce with outstanding features.\r\n', 0, '2022-08-24'),
(20, 'Korean Soy Sauce', 19, 100, 2, 1, '630639038b95f1.07769998.jpg', 'Korean Soy Sauce has the main ingredients of fresh chili and fermented beans, so Gochujang has a characteristic aroma of fresh chili, a thick texture that is very suitable for soups, hot pot, grilled or stir-fried.', 0, '2022-08-24'),
(21, 'Salad Dressing', 6, 100, 2, 1, '630639577b76c9.52562984.jpg', 'Ingredients for this sauce include Dijon yellow mustard seeds, apple cider vinegar, vegetable oil, honey, salt and pepper.', 0, '2022-08-26');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `reviews`
--

CREATE TABLE IF NOT EXISTS `reviews` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `content` text DEFAULT NULL,
  `date` date DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `Fk_comment_products` (`product_id`),
  KEY `Fk_comment_users` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `reviews`
--

INSERT INTO `reviews` (`id`, `product_id`, `user_id`, `content`, `date`) VALUES
(2, 1, 18, '123123', '2022-09-10'),
(3, 1, 18, '345345345', '2022-09-10'),
(4, 1, 18, '234235235', '2022-09-10'),
(9, 1, 18, '234 234', '2022-09-10'),
(10, 2, 18, '235235235235', '2022-09-10');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(30) NOT NULL,
  `password_hash` char(40) NOT NULL,
  `firstname` varchar(30) DEFAULT NULL,
  `lastname` varchar(30) DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `phone` char(15) NOT NULL,
  `avatar` text DEFAULT 'defaultava.png',
  `birthday` date DEFAULT NULL,
  `verification_code` text NOT NULL,
  `email_verified_at` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `username`, `password_hash`, `firstname`, `lastname`, `address`, `email`, `phone`, `avatar`, `birthday`, `verification_code`, `email_verified_at`) VALUES
(18, 'admin', '601f1889667efaebb33b8c12572835da3f027f78', 'Nguyen', 'Duc Trong', '905 De La Thanh', 'duc.nt.2081@aptechlearning.edu.vn', '0927023333', 'defaultava.png', NULL, '256410', '2022-08-23'),
(19, 'trongduc', '601f1889667efaebb33b8c12572835da3f027f78', 'Nguyen', 'Trong Duc', '905 De La Thanh', 'duc1006a@gmail.com', '0927023333', 'defaultava.png', NULL, '348813', NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `visiter`
--

CREATE TABLE IF NOT EXISTS `visiter` (
  `count_visiter` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `visiter`
--

INSERT INTO `visiter` (`count_visiter`) VALUES
(2919);

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `orderdetail`
--
ALTER TABLE `orderdetail`
  ADD CONSTRAINT `Fk_ordercart_orders` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`),
  ADD CONSTRAINT `Fk_ordercart_products` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- Các ràng buộc cho bảng `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `Fk_orders_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Các ràng buộc cho bảng `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `Fk_products_category` FOREIGN KEY (`cateid`) REFERENCES `category` (`id`),
  ADD CONSTRAINT `Fk_products_packing` FOREIGN KEY (`packingid`) REFERENCES `packing` (`id`);

--
-- Các ràng buộc cho bảng `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `Fk_comment_products` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `Fk_comment_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
