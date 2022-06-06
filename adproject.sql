/*
 Navicat Premium Data Transfer

 Source Server         : adproject
 Source Server Type    : MySQL
 Source Server Version : 100417
 Source Host           : localhost:3306
 Source Schema         : adproject

 Target Server Type    : MySQL
 Target Server Version : 100417
 File Encoding         : 65001

 Date: 20/12/2021 20:49:58
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for checkout
-- ----------------------------
DROP TABLE IF EXISTS `checkout`;
CREATE TABLE `checkout`  (
  `UserID` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `date` datetime NULL DEFAULT NULL,
  `productID` int NULL DEFAULT NULL,
  `total` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`UserID`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of checkout
-- ----------------------------

-- ----------------------------
-- Table structure for event
-- ----------------------------
DROP TABLE IF EXISTS `event`;
CREATE TABLE `event`  (
  `event_id` int NOT NULL,
  `title` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `location` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `date` date NOT NULL,
  `time` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `contact` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `banner` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`event_id`) USING BTREE,
  INDEX `id`(`event_id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_bin ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of event
-- ----------------------------
INSERT INTO `event` VALUES (1, '22222222', '222222222', '2021-12-21', '222222', '2222222222', 'all-bg-title.jpg');
INSERT INTO `event` VALUES (2, 'rrrrrrrr', 'rrrrrrrrrr', '2021-12-24', 'rrrrrrr', 'rrrrrrrrrrr', 'blog-img.jpg');
INSERT INTO `event` VALUES (3, 'uuu', 'uuu', '2021-12-29', 'uuu', 'uuu', 'men-fotwear.jpg');
INSERT INTO `event` VALUES (5, 'oooooooo', 'oooooo', '2021-12-04', 'oooooo', 'ooooo', 'blog-img-01.jpg');
INSERT INTO `event` VALUES (6, 'hahah', 'ahahah', '2021-12-31', 'ahaha', 'hahah', 'shirt.jpg');
INSERT INTO `event` VALUES (7, 'ioioioi', 'oioio', '2021-12-22', 'ioio', 'ioioi', 'img-pro-01.jpg');
INSERT INTO `event` VALUES (8, 'Go green', 'KTDI, UTM', '2022-01-15', '8.30 a.m.', '011-1213432', 'meow.jpg');

-- ----------------------------
-- Table structure for participant
-- ----------------------------
DROP TABLE IF EXISTS `participant`;
CREATE TABLE `participant`  (
  `event_id` int NOT NULL,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `email` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `participant_type` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  INDEX `event_id`(`event_id`) USING BTREE,
  CONSTRAINT `participant_ibfk_1` FOREIGN KEY (`event_id`) REFERENCES `event` (`event_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_bin ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of participant
-- ----------------------------
INSERT INTO `participant` VALUES (1, 'Iris', 'irisng000@gmail.com', 'seller');
INSERT INTO `participant` VALUES (1, 'Iris', 'irisng000@gmail.com', 'buyer');
INSERT INTO `participant` VALUES (8, 'Mei Hui Ng', 'ZHAZHA@gmail.com', 'buyer');
INSERT INTO `participant` VALUES (7, 'as as', 'as@gmail.com', 'buyer');

-- ----------------------------
-- Table structure for security_question
-- ----------------------------
DROP TABLE IF EXISTS `security_question`;
CREATE TABLE `security_question`  (
  `questionID` int NOT NULL,
  `question` varchar(255) CHARACTER SET utf32 COLLATE utf32_bin NULL DEFAULT NULL,
  PRIMARY KEY (`questionID`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf32 COLLATE = utf32_bin ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of security_question
-- ----------------------------
INSERT INTO `security_question` VALUES (1, 'What Is your favorite book?');
INSERT INTO `security_question` VALUES (2, 'What is the name of the road you grew up on?');
INSERT INTO `security_question` VALUES (3, 'What was the name of your first pet?');
INSERT INTO `security_question` VALUES (4, 'Where did you go to high school/college?');
INSERT INTO `security_question` VALUES (5, 'What city were you born in?');
INSERT INTO `security_question` VALUES (6, 'What is your favorite food?');
INSERT INTO `security_question` VALUES (7, 'What is your mother’s name?');
INSERT INTO `security_question` VALUES (8, 'What was the first company that you worked for?');

-- ----------------------------
-- Table structure for table_category
-- ----------------------------
DROP TABLE IF EXISTS `table_category`;
CREATE TABLE `table_category`  (
  `UserType` varchar(1) CHARACTER SET utf32 COLLATE utf32_bin NOT NULL,
  `Description` varchar(255) CHARACTER SET utf32 COLLATE utf32_bin NULL DEFAULT NULL,
  `Interface` varchar(255) CHARACTER SET utf32 COLLATE utf32_bin NULL DEFAULT NULL,
  PRIMARY KEY (`UserType`) USING BTREE,
  INDEX `UserType`(`UserType`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf32 COLLATE = utf32_bin ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of table_category
-- ----------------------------
INSERT INTO `table_category` VALUES ('A', 'Admin', 'admin_index.php');
INSERT INTO `table_category` VALUES ('U', 'User', 'userindex.php');

-- ----------------------------
-- Table structure for table_profile
-- ----------------------------
DROP TABLE IF EXISTS `table_profile`;
CREATE TABLE `table_profile`  (
  `Email` varchar(255) CHARACTER SET utf32 COLLATE utf32_bin NOT NULL,
  `Phone` varchar(255) CHARACTER SET utf32 COLLATE utf32_bin NULL DEFAULT '',
  `Address` varchar(255) CHARACTER SET utf32 COLLATE utf32_bin NULL DEFAULT NULL,
  `Postcode` varchar(255) CHARACTER SET utf32 COLLATE utf32_bin NULL DEFAULT NULL,
  `City` varchar(255) CHARACTER SET utf32 COLLATE utf32_bin NULL DEFAULT NULL,
  `State` varchar(255) CHARACTER SET utf32 COLLATE utf32_bin NULL DEFAULT NULL,
  `Avatar` varchar(255) CHARACTER SET utf32 COLLATE utf32_bin NULL DEFAULT NULL,
  PRIMARY KEY (`Email`) USING BTREE,
  CONSTRAINT `table_profile_ibfk_1` FOREIGN KEY (`Email`) REFERENCES `table_user` (`Email`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB CHARACTER SET = utf32 COLLATE = utf32_bin ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of table_profile
-- ----------------------------
INSERT INTO `table_profile` VALUES ('admin@gmail.com', '+60166376037', 'No 4 Jalan Teratai 48', '81100', 'Taman Johor Jaya Johor Bahru', 'Johor', '../images/avatar/cat1.jpg');
INSERT INTO `table_profile` VALUES ('cq@gmail.com', '0123339999', 'taman mutiara indah', '08000', 'Sungai Petani', 'Kedah', 'images/avatar/avatar1.jpg');
INSERT INTO `table_profile` VALUES ('lala@gmail.com', '0128887777', 'taman sentosa', '09888', 'Alor Setar', 'Kedah', 'images/avatar/about-img.jpg');
INSERT INTO `table_profile` VALUES ('mh@gmail.com', '', '', '', '', 'Choose...', 'images/avatar/37191160_2240845145931854_206234833381228544_o.jpg');
INSERT INTO `table_profile` VALUES ('simon@gmail.com', '12345678', '213, Jalan Johor Jaya, Taman Sakura', '82000', 'Johor Jaya', 'Johor', 'images/avatar/avatar1.jpg');
INSERT INTO `table_profile` VALUES ('sy@gmail.com', '013769532', '234, Jalan Bunga, Taman Muhibah', '81000', 'Kulai', 'Johor', 'images/avatar/avatar1.jpg');
INSERT INTO `table_profile` VALUES ('xk@gmail.com', '+60163632949', '2906,jln cempaka,36/19,tmn indahpura,81000,kulai,johor', '81000', 'Kulai', 'Johor', 'images/avatar/ass1.png');

-- ----------------------------
-- Table structure for table_user
-- ----------------------------
DROP TABLE IF EXISTS `table_user`;
CREATE TABLE `table_user`  (
  `UserID` varchar(255) CHARACTER SET utf32 COLLATE utf32_bin NOT NULL,
  `Password` varchar(255) CHARACTER SET utf32 COLLATE utf32_bin NULL DEFAULT NULL,
  `cPassword` varchar(255) CHARACTER SET utf32 COLLATE utf32_bin NULL DEFAULT NULL,
  `UserType` varchar(1) CHARACTER SET utf32 COLLATE utf32_bin NULL DEFAULT NULL,
  `fName` varchar(255) CHARACTER SET utf32 COLLATE utf32_bin NULL DEFAULT '',
  `lName` varchar(255) CHARACTER SET utf32 COLLATE utf32_bin NULL DEFAULT NULL,
  `Email` varchar(255) CHARACTER SET utf32 COLLATE utf32_bin NULL DEFAULT NULL,
  `questionID` int NULL DEFAULT NULL,
  `answer` varchar(255) CHARACTER SET utf32 COLLATE utf32_bin NULL DEFAULT NULL,
  PRIMARY KEY (`UserID`) USING BTREE,
  INDEX `UserType`(`UserType`) USING BTREE,
  INDEX `questionID`(`questionID`) USING BTREE,
  INDEX `Email`(`Email`) USING BTREE,
  CONSTRAINT `table_user_ibfk_1` FOREIGN KEY (`UserType`) REFERENCES `table_category` (`UserType`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `table_user_ibfk_2` FOREIGN KEY (`questionID`) REFERENCES `security_question` (`questionID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB CHARACTER SET = utf32 COLLATE = utf32_bin ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of table_user
-- ----------------------------
INSERT INTO `table_user` VALUES ('admin@gmail.com', '123', '123', 'A', 'Mei', 'Ng', 'admin@gmail.com', 1, 'oop');
INSERT INTO `table_user` VALUES ('cq@gmail.com', '123', '123', 'U', 'Chin Qing', 'Kiew', 'cq@gmail.com', 1, 'OOP');
INSERT INTO `table_user` VALUES ('lala@gmail.com', '123', '123', 'U', 'LALA', 'LA', 'lala@gmail.com', 1, 'lala');
INSERT INTO `table_user` VALUES ('mh@gmail.com', '123', '123', 'U', '', '', 'mh@gmail.com', 1, 'mh');
INSERT INTO `table_user` VALUES ('simon@gmail.com', '123', '123', 'U', 'Simon', 'Chong', 'simon@gmail.com', 1, 'simon');
INSERT INTO `table_user` VALUES ('sy@gmail.com', '123', '123', 'U', 'Shu Yu', 'Ng', 'sy@gmail.com', 1, 'sy');
INSERT INTO `table_user` VALUES ('xk@gmail.com', '1234', '1234', 'U', 'Xue Kee', 'Lim', 'xk@gmail.com', 1, 'xk');

-- ----------------------------
-- Table structure for tbl_cart
-- ----------------------------
DROP TABLE IF EXISTS `tbl_cart`;
CREATE TABLE `tbl_cart`  (
  `cartID` int NOT NULL,
  `productID` int NULL DEFAULT NULL,
  `orderQuantity` int NULL DEFAULT NULL,
  `UserID` varchar(255) CHARACTER SET utf32 COLLATE utf32_bin NULL DEFAULT NULL,
  INDEX `productID`(`productID`) USING BTREE,
  INDEX `UserID`(`UserID`) USING BTREE,
  CONSTRAINT `tbl_cart_ibfk_1` FOREIGN KEY (`productID`) REFERENCES `tblproduct` (`productID`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tbl_cart_ibfk_2` FOREIGN KEY (`UserID`) REFERENCES `table_user` (`UserID`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of tbl_cart
-- ----------------------------
INSERT INTO `tbl_cart` VALUES (1, 1, 1, 'lala@gmail.com');
INSERT INTO `tbl_cart` VALUES (3, 3, 1, 'lala@gmail.com');

-- ----------------------------
-- Table structure for tblproduct
-- ----------------------------
DROP TABLE IF EXISTS `tblproduct`;
CREATE TABLE `tblproduct`  (
  `productID` int NOT NULL,
  `productName` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NULL DEFAULT NULL,
  `stock` int UNSIGNED NULL DEFAULT 1,
  `price` decimal(10, 2) NULL DEFAULT NULL,
  `productDescription` varchar(300) CHARACTER SET utf8 COLLATE utf8_bin NULL DEFAULT NULL,
  `productCategory1` int NULL DEFAULT NULL,
  `productCategory2` int NULL DEFAULT NULL,
  `productOrigin` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NULL DEFAULT NULL,
  `productBrand` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NULL DEFAULT NULL,
  `postage` decimal(10, 2) NULL DEFAULT NULL,
  `productBox` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NULL DEFAULT NULL,
  `productOwner` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NULL DEFAULT NULL,
  PRIMARY KEY (`productID`) USING BTREE,
  INDEX `productCategory2`(`productCategory2`) USING BTREE,
  INDEX `productCategory1`(`productCategory1`) USING BTREE,
  CONSTRAINT `tblproduct_ibfk_2` FOREIGN KEY (`productCategory2`) REFERENCES `tblproduct_category2` (`categoryID2`) ON DELETE SET NULL ON UPDATE SET NULL,
  CONSTRAINT `tblproduct_ibfk_3` FOREIGN KEY (`productCategory1`) REFERENCES `tblproduct_category1` (`categoryID`) ON DELETE SET NULL ON UPDATE SET NULL
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_bin ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of tblproduct
-- ----------------------------
INSERT INTO `tblproduct` VALUES (1, 'Stylish T-shirt Red', 1, 80.00, 'Condition: 10/10', 1, 1, 'Kulai, Johor', 'LALA', 6.00, 'T-shirt x1', 'lala@gmail.com');
INSERT INTO `tblproduct` VALUES (2, 'Men\'s Wallet', 1, 54.30, 'Only used a few times. Therefore the wallet is quite new.', 2, 5, 'Kuching, Sarawak', 'OHMYGOD', 8.00, 'Wallet x1', 'lala@gmail.com');
INSERT INTO `tblproduct` VALUES (3, 'Women bag', 1, 22.00, '', 2, 6, 'Kuala Lumpur', 'ALOHA', 4.50, '', 'lala@gmail.com');
INSERT INTO `tblproduct` VALUES (4, 'sdddddddddddddd', 1, 2222.00, 'effffffffffffffffffffffffffffffffffffffffffffffffffffffffffffff', 2, 6, 'ew', 'ALOHA', 22.00, 'fefe', 'lala@gmail.com');
INSERT INTO `tblproduct` VALUES (5, 'Women Blouse Red', 1, 36.20, 'Suitable for any formal or informal situations. Only worn a few times. Please iron it before wearing. Condition: 10/10.', 1, 1, 'Kulai, Johor', 'ZAZA', 5.00, 'Blouse x1', 'lala@gmail.com');
INSERT INTO `tblproduct` VALUES (6, 'Watch White Unisex Used', 1, 13.20, 'An used watch. Been wearing for one and a half year. Still working good.', 2, 8, 'Sungai Petani, Kedah', 'CHAR', 5.00, 'Watch x1\r\nBox x1', 'lala@gmail.com');
INSERT INTO `tblproduct` VALUES (7, 'Watch Unisex Used', 1, 78.00, 'An used watch. Been wearing for one and a half year. Still working good.', 2, 8, 'Sungai Petani, Kedah', 'CHAR', 5.00, 'Watch x1\r\nBox x1', 'lala@gmail.com');
INSERT INTO `tblproduct` VALUES (8, 'Random Shirt Male', 1, 48.00, 'Only selling the shirt.', 1, 1, 'Kulim, Kedah', '3333', 4.50, 'Shirt x1', 'lala@gmail.com');
INSERT INTO `tblproduct` VALUES (9, 'sdddddddddddddd', 1, 66.00, 'gfgfg', 3, 11, 'ew', '3333', 22.00, 'gdg', 'lala@gmail.com');
INSERT INTO `tblproduct` VALUES (10, 'Earphone White', 1, 15.00, 'Haven\'t use it. 100% new.', 2, 8, 'Klang, Selangor', 'ZZ', 4.50, 'Earphone x1', 'cq@gmail.com');

-- ----------------------------
-- Table structure for tblproduct_category1
-- ----------------------------
DROP TABLE IF EXISTS `tblproduct_category1`;
CREATE TABLE `tblproduct_category1`  (
  `categoryID` int NOT NULL AUTO_INCREMENT,
  `productCategory1` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NULL DEFAULT NULL,
  PRIMARY KEY (`categoryID`) USING BTREE,
  INDEX `categoryID`(`categoryID`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8 COLLATE = utf8_bin ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of tblproduct_category1
-- ----------------------------
INSERT INTO `tblproduct_category1` VALUES (1, 'Clothing');
INSERT INTO `tblproduct_category1` VALUES (2, 'Accessories');
INSERT INTO `tblproduct_category1` VALUES (3, 'Hobbies/Leisure');

-- ----------------------------
-- Table structure for tblproduct_category2
-- ----------------------------
DROP TABLE IF EXISTS `tblproduct_category2`;
CREATE TABLE `tblproduct_category2`  (
  `categoryID2` int NOT NULL AUTO_INCREMENT,
  `categoryID` int NULL DEFAULT NULL,
  `productCategory2` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NULL DEFAULT NULL,
  PRIMARY KEY (`categoryID2`) USING BTREE,
  INDEX `categoryID`(`categoryID`) USING BTREE,
  CONSTRAINT `tblproduct_category2_ibfk_1` FOREIGN KEY (`categoryID`) REFERENCES `tblproduct_category1` (`categoryID`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE = InnoDB AUTO_INCREMENT = 13 CHARACTER SET = utf8 COLLATE = utf8_bin ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of tblproduct_category2
-- ----------------------------
INSERT INTO `tblproduct_category2` VALUES (1, 1, 'Top Wear');
INSERT INTO `tblproduct_category2` VALUES (2, 1, 'Bottom Wear');
INSERT INTO `tblproduct_category2` VALUES (3, 1, 'Party Wear');
INSERT INTO `tblproduct_category2` VALUES (4, 1, 'Sports Wear');
INSERT INTO `tblproduct_category2` VALUES (5, 2, 'Wallets');
INSERT INTO `tblproduct_category2` VALUES (6, 2, 'Bags');
INSERT INTO `tblproduct_category2` VALUES (7, 2, 'Sunglasses');
INSERT INTO `tblproduct_category2` VALUES (8, 2, 'Other Accessories');
INSERT INTO `tblproduct_category2` VALUES (9, 3, 'Pets');
INSERT INTO `tblproduct_category2` VALUES (10, 3, 'Books');
INSERT INTO `tblproduct_category2` VALUES (11, 3, 'Music Instruments');
INSERT INTO `tblproduct_category2` VALUES (12, 3, 'Tickets & Vouchers');

-- ----------------------------
-- Table structure for tblproduct_image
-- ----------------------------
DROP TABLE IF EXISTS `tblproduct_image`;
CREATE TABLE `tblproduct_image`  (
  `productID` int NOT NULL,
  `image1` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `imageID` int NOT NULL,
  PRIMARY KEY (`imageID`, `productID`) USING BTREE,
  INDEX `tblproduct_image_ibfk_1`(`productID`) USING BTREE,
  CONSTRAINT `tblproduct_image_ibfk_1` FOREIGN KEY (`productID`) REFERENCES `tblproduct` (`productID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_bin ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of tblproduct_image
-- ----------------------------
INSERT INTO `tblproduct_image` VALUES (1, 'products/1/style-shirt-01.jpg', 1);
INSERT INTO `tblproduct_image` VALUES (1, 'products/1/style-shirt-02.jpg', 2);
INSERT INTO `tblproduct_image` VALUES (1, 'products/1/style-shirt-03.jpg', 3);
INSERT INTO `tblproduct_image` VALUES (2, 'products/2/wallet-img.jpg', 4);
INSERT INTO `tblproduct_image` VALUES (3, 'products/3/women-bag-img.jpg', 5);
INSERT INTO `tblproduct_image` VALUES (4, 'products/4/album_2021-08-25_16-01-16.gif', 6);
INSERT INTO `tblproduct_image` VALUES (5, 'products/5/smp-img-01.jpg', 7);
INSERT INTO `tblproduct_image` VALUES (5, 'products/5/smp-img-02.jpg', 8);
INSERT INTO `tblproduct_image` VALUES (6, 'products/6/watch-elegant.png', 9);
INSERT INTO `tblproduct_image` VALUES (7, 'products/7/img-pro-04.jpg', 10);
INSERT INTO `tblproduct_image` VALUES (8, 'products/8/img-pro-01.jpg', 11);
INSERT INTO `tblproduct_image` VALUES (9, 'products/9/big-img-01.jpg', 12);
INSERT INTO `tblproduct_image` VALUES (9, 'products/9/big-img-02.jpg', 13);
INSERT INTO `tblproduct_image` VALUES (9, 'products/9/big-img-03.jpg', 14);
INSERT INTO `tblproduct_image` VALUES (10, 'products/10/earphones-white.jpg', 15);

SET FOREIGN_KEY_CHECKS = 1;
