/*
 Navicat Premium Data Transfer

 Source Server         : Home Dev Env
 Source Server Type    : MySQL
 Source Server Version : 80023
 Source Host           : 192.168.0.77:3306
 Source Schema         : export

 Target Server Type    : MySQL
 Target Server Version : 80023
 File Encoding         : 65001

 Date: 17/05/2021 06:21:48
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for buyer
-- ----------------------------
DROP TABLE IF EXISTS `buyer`;
CREATE TABLE `buyer`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `business_name` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL,
  `update_by` int NULL DEFAULT NULL,
  `update_on` datetime(0) NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP(0),
  `update_type` enum('edit','removed') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `created_by` int NULL DEFAULT NULL,
  `created_on` datetime(0) NOT NULL DEFAULT CURRENT_TIMESTAMP(0),
  `status` int NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `user_id`(`user_id`) USING BTREE,
  INDEX `update_by`(`update_by`) USING BTREE,
  INDEX `created_by`(`created_by`) USING BTREE,
  CONSTRAINT `buyer_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `buyer_ibfk_2` FOREIGN KEY (`update_by`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `buyer_ibfk_3` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of buyer
-- ----------------------------
INSERT INTO `buyer` VALUES (1, 57, 'buyer test IT solutions', 'This is the buyer test account', NULL, NULL, NULL, 46, '2021-05-16 19:03:12', 1);
INSERT INTO `buyer` VALUES (2, 59, 'Gwens Pizza', NULL, NULL, NULL, NULL, 59, '2021-05-17 05:37:37', 2);
INSERT INTO `buyer` VALUES (3, 60, '', NULL, NULL, NULL, NULL, 60, '2021-05-17 05:52:00', 2);

-- ----------------------------
-- Table structure for company
-- ----------------------------
DROP TABLE IF EXISTS `company`;
CREATE TABLE `company`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NULL DEFAULT NULL,
  `name` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL,
  `website_link` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `nit` int NULL DEFAULT NULL,
  `phone` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `email` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `ctv` char(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL COMMENT 'city/town/village',
  `address` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `current_seat_capacity` int NULL DEFAULT NULL,
  `expansion_potential` int NULL DEFAULT NULL,
  `established_on` int NULL DEFAULT NULL,
  `district` char(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `logo_img_path` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `company_type_id` int NULL DEFAULT 0,
  `mib_catalogue_status` int NOT NULL DEFAULT 0 COMMENT 'Made in Belize Catalogue status',
  `trade_type` enum('local','export','both','none') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT 'none',
  `is_featured` int NULL DEFAULT 0,
  `status` int NULL DEFAULT 0,
  `created_on` datetime(0) NULL DEFAULT 'now()',
  `created_by` int NULL DEFAULT 0,
  `update_by` int NULL DEFAULT NULL,
  `update_type` enum('edit','removed','rejected') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `update_on` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `user_id`(`user_id`) USING BTREE,
  INDEX `company_type_id`(`company_type_id`) USING BTREE,
  INDEX `created_by`(`created_by`) USING BTREE,
  CONSTRAINT `company_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `company_ibfk_2` FOREIGN KEY (`company_type_id`) REFERENCES `company_type` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `company_ibfk_3` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 48 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of company
-- ----------------------------
INSERT INTO `company` VALUES (35, 40, '506', NULL, NULL, NULL, NULL, 'danielsoncorrea@gmail.com', 'Ladyville', '56 Quilter Avenue', NULL, NULL, NULL, 'Belize', NULL, 2, 0, 'local', 0, 3, '2021-03-01 15:53:27', NULL, NULL, NULL, NULL);
INSERT INTO `company` VALUES (39, 44, 'SOG-Fixes', NULL, NULL, NULL, NULL, 'danielson@belizeinvest.org.bz', 'Ladyville', '56 Quilter Avenue', NULL, NULL, NULL, 'Belize', NULL, 2, 0, 'local', 0, 2, '2021-03-01 16:47:32', NULL, NULL, NULL, NULL);
INSERT INTO `company` VALUES (40, 45, 'BELTRAIDE', 'In early 1998, TIPS was renamed the Belize Trade and Investment Development Service (BELTRAIDE) and with that came a greater mandate. BELTRAIDE is a statutory body under the Ministry with responsibility for Investment, Trade and Commerce.', 'http://www.belizeinvest.org.bz/', NULL, '255-2323', 'beltraide.export.belize@gmail.com', 'Belize City', '56 Quilter Avenue', NULL, NULL, 1998, 'Belize', './uploads/companyLogos/beltraidelogo.jpg', 2, 1, 'export', 1, 1, '2021-03-01 21:47:59', NULL, 46, 'edit', '2021-05-17 05:18:49');
INSERT INTO `company` VALUES (42, 48, '506 IT Solutions', 'We are here to provide you with what you need, if you have a budget let us know and we can work it out. Providing the best IT solutions in Belize.  Our Goal it to help you improve your business with the best prices.', NULL, NULL, NULL, '506itsolutions@gmail.com', 'Ladyville', '4456 Quilter Avenue', NULL, NULL, NULL, 'Belize', NULL, 2, 1, 'local', 1, 1, '2021-04-26 14:09:37', 46, NULL, NULL, NULL);
INSERT INTO `company` VALUES (43, 49, 'John Doe IT Solutions', '', NULL, NULL, NULL, 'johndoe@gmail.com', 'Santa Familia', '45 Santa Familia', NULL, NULL, NULL, 'Corozal', NULL, 2, 1, 'local', 0, 1, '2021-04-26 14:53:39', 46, NULL, NULL, NULL);
INSERT INTO `company` VALUES (44, 51, 'Lino\'s IT Solution', 'We provide the best IT solution in Belize!!! From software development installing your companies network infrastructure.', NULL, NULL, '1234 1234', 'linitocorea@gmail.com', 'Ladyville', '4456 Quilter Avenue', 1, 5, 2021, 'Belize', './images/business_icon.png', 3, 1, 'both', 0, 1, '2021-05-03 10:26:41', 51, 46, 'edit', '2021-05-17 05:14:23');
INSERT INTO `company` VALUES (45, 52, 'chilino\'s IT Solution', NULL, NULL, NULL, NULL, 'chilinitocorea@gmail.com', 'Ladyville', '4456 Quilter Avenue', NULL, NULL, NULL, 'Belize', NULL, 3, 0, 'local', 0, 1, '2021-05-03 10:58:01', 52, NULL, NULL, NULL);
INSERT INTO `company` VALUES (47, 54, 'University of Belize', 'This is a test with main focuse and main trade added to add users', NULL, NULL, NULL, '2016114269@ub.edu.bz', 'Belmopan City', 'some address', NULL, NULL, NULL, 'Cayo', NULL, 3, 0, 'local', 0, 1, '2021-05-03 14:39:58', 46, NULL, NULL, NULL);
INSERT INTO `company` VALUES (48, 55, 'test company', '', NULL, NULL, NULL, 'testcompany@test.com', 'Ladyville', '4456 Quilter Avenue', NULL, NULL, NULL, 'Belize', NULL, 3, 0, 'local', 0, 1, '2021-05-16 18:34:01', 46, NULL, NULL, NULL);

-- ----------------------------
-- Table structure for company_approval_list
-- ----------------------------
DROP TABLE IF EXISTS `company_approval_list`;
CREATE TABLE `company_approval_list`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `company_id` int NOT NULL,
  `approved_by` int NOT NULL,
  `approved_on` datetime(0) NULL DEFAULT NULL,
  `status` int NULL DEFAULT 1,
  `created_on` datetime(0) NULL DEFAULT 'now()',
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `company_id`(`company_id`) USING BTREE,
  INDEX `approved_by`(`approved_by`) USING BTREE,
  CONSTRAINT `company_approval_list_ibfk_1` FOREIGN KEY (`company_id`) REFERENCES `company` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `company_approval_list_ibfk_2` FOREIGN KEY (`approved_by`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 10 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of company_approval_list
-- ----------------------------
INSERT INTO `company_approval_list` VALUES (3, 40, 46, '2021-03-05 15:57:42', 1, '2021-03-05 15:57:42');
INSERT INTO `company_approval_list` VALUES (4, 42, 46, '2021-04-26 14:09:37', 1, '2021-04-26 14:09:37');
INSERT INTO `company_approval_list` VALUES (5, 43, 46, '2021-04-26 14:53:39', 1, '2021-04-26 14:53:39');
INSERT INTO `company_approval_list` VALUES (6, 44, 46, '2021-05-03 10:30:52', 1, '2021-05-03 10:30:52');
INSERT INTO `company_approval_list` VALUES (7, 45, 46, '2021-05-03 10:59:06', 1, '2021-05-03 10:59:06');
INSERT INTO `company_approval_list` VALUES (9, 47, 46, '2021-05-03 14:39:58', 1, '2021-05-03 14:39:58');
INSERT INTO `company_approval_list` VALUES (10, 48, 46, '2021-05-16 18:34:01', 1, '2021-05-16 18:34:01');

-- ----------------------------
-- Table structure for company_type
-- ----------------------------
DROP TABLE IF EXISTS `company_type`;
CREATE TABLE `company_type`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `type` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `display_name` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `icon` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `display_order` int NULL DEFAULT NULL,
  `status` int NOT NULL DEFAULT 1,
  `update_by` int NULL DEFAULT NULL,
  `update_type` enum('removed','edit') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `update_on` datetime(0) NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP(0),
  `created_by` int NULL DEFAULT NULL,
  `created_on` datetime(0) NOT NULL DEFAULT CURRENT_TIMESTAMP(0),
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `update_by`(`update_by`) USING BTREE,
  INDEX `created_by`(`created_by`) USING BTREE,
  CONSTRAINT `company_type_ibfk_1` FOREIGN KEY (`update_by`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `company_type_ibfk_2` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of company_type
-- ----------------------------
INSERT INTO `company_type` VALUES (1, 'music', 'Music', 'fas fa-music', 1, 1, NULL, NULL, '2021-05-03 12:00:46', 46, '2021-04-29 14:30:17');
INSERT INTO `company_type` VALUES (2, 'supplier', 'Making Products', 'fa fa-shopping-cart', 3, 1, NULL, NULL, '2021-05-03 12:01:52', 46, '2021-04-29 14:30:36');
INSERT INTO `company_type` VALUES (3, 'services', 'Services', 'far fa-hand-holding-box', 2, 1, NULL, NULL, '2021-05-03 12:01:09', 46, '2021-04-29 14:31:47');

-- ----------------------------
-- Table structure for export_market
-- ----------------------------
DROP TABLE IF EXISTS `export_market`;
CREATE TABLE `export_market`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL COMMENT 'name of the market they export to',
  `status` int NULL DEFAULT 1,
  `created_on` datetime(0) NOT NULL DEFAULT CURRENT_TIMESTAMP(0),
  `created_by` int NULL DEFAULT NULL,
  `removed_by` int NULL DEFAULT NULL,
  `removed_on` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `removed_by`(`removed_by`) USING BTREE,
  INDEX `created_by`(`created_by`) USING BTREE,
  CONSTRAINT `export_market_ibfk_1` FOREIGN KEY (`removed_by`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `export_market_ibfk_2` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 12 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of export_market
-- ----------------------------
INSERT INTO `export_market` VALUES (1, 'South Korea', 1, '2021-03-09 09:47:39', NULL, NULL, NULL);
INSERT INTO `export_market` VALUES (2, 'Japan', 1, '2021-03-09 09:47:47', NULL, NULL, NULL);
INSERT INTO `export_market` VALUES (3, 'Jamaica', 0, '2021-03-09 09:48:14', NULL, 46, '2021-04-27 11:01:24');
INSERT INTO `export_market` VALUES (4, 'jamica', 0, '2021-04-27 09:38:15', NULL, 46, '2021-04-27 10:39:49');
INSERT INTO `export_market` VALUES (5, 'jamica', 0, '2021-04-27 10:40:10', 46, 46, '2021-04-27 10:41:33');
INSERT INTO `export_market` VALUES (6, 'Jamaica', 1, '2021-04-27 10:41:47', 46, NULL, NULL);
INSERT INTO `export_market` VALUES (7, 'jamica', 0, '2021-04-27 11:01:36', 46, 46, '2021-04-27 11:01:46');
INSERT INTO `export_market` VALUES (8, 'Costa Rica', 1, '2021-04-27 11:03:32', 46, NULL, NULL);
INSERT INTO `export_market` VALUES (9, 'Tiwan', 1, '2021-04-27 11:03:49', 46, NULL, NULL);
INSERT INTO `export_market` VALUES (10, 'St. Vincent', 1, '2021-04-27 11:04:05', 46, NULL, NULL);
INSERT INTO `export_market` VALUES (11, 'Guatemala', 1, '2021-04-27 11:04:19', 46, NULL, NULL);

-- ----------------------------
-- Table structure for export_market_list
-- ----------------------------
DROP TABLE IF EXISTS `export_market_list`;
CREATE TABLE `export_market_list`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `export_market_id` int NOT NULL,
  `company_id` int NOT NULL,
  `status` int NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `export_market_id`(`export_market_id`) USING BTREE,
  INDEX `company_id`(`company_id`) USING BTREE,
  CONSTRAINT `export_market_list_ibfk_1` FOREIGN KEY (`export_market_id`) REFERENCES `export_market` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `export_market_list_ibfk_2` FOREIGN KEY (`company_id`) REFERENCES `company` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 23 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of export_market_list
-- ----------------------------
INSERT INTO `export_market_list` VALUES (18, 1, 40, 1);
INSERT INTO `export_market_list` VALUES (22, 2, 40, 1);

-- ----------------------------
-- Table structure for favorites
-- ----------------------------
DROP TABLE IF EXISTS `favorites`;
CREATE TABLE `favorites`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `product_id` int NOT NULL,
  `status` int NOT NULL DEFAULT 1,
  `created_on` datetime(0) NOT NULL DEFAULT 'now()',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of favorites
-- ----------------------------

-- ----------------------------
-- Table structure for forgot_password_activity
-- ----------------------------
DROP TABLE IF EXISTS `forgot_password_activity`;
CREATE TABLE `forgot_password_activity`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `date_requested` timestamp(0) NULL DEFAULT CURRENT_TIMESTAMP(0),
  `date_completed` timestamp(0) NULL DEFAULT NULL,
  `reset_code` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL,
  `status` int NULL DEFAULT 2,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `user_id`(`user_id`) USING BTREE,
  CONSTRAINT `forgot_password_activity_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of forgot_password_activity
-- ----------------------------

-- ----------------------------
-- Table structure for hs_code
-- ----------------------------
DROP TABLE IF EXISTS `hs_code`;
CREATE TABLE `hs_code`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL,
  `hs_code` int NULL DEFAULT NULL,
  `sector_id` int NULL DEFAULT NULL,
  `created_on` datetime(0) NULL DEFAULT CURRENT_TIMESTAMP(0),
  `created_by` int NOT NULL,
  `update_by` int NULL DEFAULT NULL,
  `update_type` enum('edit','removed') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `update_on` datetime(0) NULL DEFAULT NULL,
  `status` int NULL DEFAULT 1,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `sector_id`(`sector_id`) USING BTREE,
  INDEX `created_by`(`created_by`) USING BTREE,
  INDEX `update_by`(`update_by`) USING BTREE,
  CONSTRAINT `hs_code_ibfk_1` FOREIGN KEY (`sector_id`) REFERENCES `sector` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `hs_code_ibfk_2` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `hs_code_ibfk_3` FOREIGN KEY (`update_by`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of hs_code
-- ----------------------------
INSERT INTO `hs_code` VALUES (1, 'Rice', 100630, 3, '2021-03-17 11:13:36', 46, 46, 'edit', '2021-03-17 17:00:32', 1);
INSERT INTO `hs_code` VALUES (2, 'Cacao Beans', 180100, 3, '2021-03-17 14:55:48', 46, 46, 'edit', '2021-03-18 16:39:00', 1);
INSERT INTO `hs_code` VALUES (3, 'Yellow Corn', 100500, 3, '2021-03-17 14:56:17', 46, NULL, NULL, NULL, 1);

-- ----------------------------
-- Table structure for industries_serviced
-- ----------------------------
DROP TABLE IF EXISTS `industries_serviced`;
CREATE TABLE `industries_serviced`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `industry_id` int NULL DEFAULT NULL,
  `company_id` int NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `industry_id`(`industry_id`) USING BTREE,
  INDEX `company_id`(`company_id`) USING BTREE,
  CONSTRAINT `industries_serviced_ibfk_1` FOREIGN KEY (`industry_id`) REFERENCES `industry` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `industries_serviced_ibfk_2` FOREIGN KEY (`company_id`) REFERENCES `company` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of industries_serviced
-- ----------------------------

-- ----------------------------
-- Table structure for industry
-- ----------------------------
DROP TABLE IF EXISTS `industry`;
CREATE TABLE `industry`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL,
  `update_by` int NOT NULL,
  `update_type` enum('edit','removed') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `update_on` datetime(0) NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP(0),
  `created_by` int NULL DEFAULT NULL,
  `created_on` datetime(0) NOT NULL DEFAULT CURRENT_TIMESTAMP(0),
  `status` int NULL DEFAULT 1,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `update_by`(`update_by`) USING BTREE,
  INDEX `created_by`(`created_by`) USING BTREE,
  CONSTRAINT `industry_ibfk_1` FOREIGN KEY (`update_by`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `industry_ibfk_2` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of industry
-- ----------------------------

-- ----------------------------
-- Table structure for interest
-- ----------------------------
DROP TABLE IF EXISTS `interest`;
CREATE TABLE `interest`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `sector_id` int NOT NULL,
  `user_id` int NOT NULL,
  `status` int NOT NULL DEFAULT 1,
  `created_on` datetime(0) NOT NULL DEFAULT 'now()',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of interest
-- ----------------------------

-- ----------------------------
-- Table structure for product_image
-- ----------------------------
DROP TABLE IF EXISTS `product_image`;
CREATE TABLE `product_image`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `product_id` int NOT NULL,
  `path` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `file_name` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `type` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `size` int NULL DEFAULT NULL,
  `status` int NULL DEFAULT 1,
  `created_on` datetime(0) NULL DEFAULT 'now()',
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `product_id`(`product_id`) USING BTREE,
  CONSTRAINT `product_image_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 9 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of product_image
-- ----------------------------
INSERT INTO `product_image` VALUES (1, 15, 'uploads/products/rice_4_1620340516.jpg', 'rice_4.jpg', 'jpeg', 107828, 1, '2021-05-06 16:35:16');
INSERT INTO `product_image` VALUES (5, 15, 'uploads/products/rice_4_1620675668.jpg', 'rice_4.jpg', 'jpeg', 107828, 1, '2021-05-10 13:41:08');
INSERT INTO `product_image` VALUES (6, 15, 'uploads/products/food-proper-rice_1620676642.png', 'food-proper-rice.png', 'png', 69012, 1, '2021-05-10 13:57:22');
INSERT INTO `product_image` VALUES (7, 15, 'uploads/products/featured-white-rice-1_1620677784.jpg', 'featured-white-rice-1.jpg', 'jpeg', 477242, 1, '2021-05-10 14:16:24');
INSERT INTO `product_image` VALUES (8, 3, 'uploads/products/brown_rice_4_1620940008.jpg', 'brown_rice_4.jpg', 'jpeg', 144652, 1, '2021-05-13 15:06:48');

-- ----------------------------
-- Table structure for products
-- ----------------------------
DROP TABLE IF EXISTS `products`;
CREATE TABLE `products`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `company_id` int NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `tariff_code` int NULL DEFAULT NULL,
  `is_featured` int NOT NULL DEFAULT 0,
  `hs_code_id` int NOT NULL,
  `update_by` int NULL DEFAULT NULL,
  `update_type` enum('edit','removed') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `update_on` datetime(0) NULL DEFAULT NULL,
  `created_by` int NOT NULL,
  `created_on` datetime(0) NULL DEFAULT 'now()',
  `status` int NULL DEFAULT 1,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `id`(`id`) USING BTREE,
  INDEX `company_id`(`company_id`) USING BTREE,
  INDEX `hs_code_id`(`hs_code_id`) USING BTREE,
  INDEX `update_by`(`update_by`) USING BTREE,
  INDEX `created_by`(`created_by`) USING BTREE,
  CONSTRAINT `products_ibfk_1` FOREIGN KEY (`company_id`) REFERENCES `company` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `products_ibfk_2` FOREIGN KEY (`hs_code_id`) REFERENCES `hs_code` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `products_ibfk_3` FOREIGN KEY (`update_by`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `products_ibfk_4` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 20 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of products
-- ----------------------------
INSERT INTO `products` VALUES (3, 40, 'M&M Brown Rice', 'The best Brown Rice in BELIZE.................................yayayayayarrrrr', NULL, 1, 1, 46, 'edit', '2021-05-13 14:37:03', 45, '2021-04-13 12:24:55', 1);
INSERT INTO `products` VALUES (4, 40, 'M&M White Rice ', 'This is white rice', NULL, 1, 1, NULL, NULL, NULL, 45, '2021-04-13 12:24:55', 1);
INSERT INTO `products` VALUES (5, 40, 'M&M Yellow Rice', 'This is yellow rice', NULL, 0, 1, NULL, NULL, NULL, 45, '2021-04-13 12:47:23', 1);
INSERT INTO `products` VALUES (6, 40, 'M&M Organic Cacao Beans', 'THis is organic cacao beans', NULL, 0, 2, NULL, NULL, NULL, 45, '2021-04-13 13:17:59', 1);
INSERT INTO `products` VALUES (7, 40, 'M&M Organic Yellow Corn', 'this is yellow corn', NULL, 0, 3, NULL, NULL, NULL, 45, '2021-04-13 13:19:16', 1);
INSERT INTO `products` VALUES (15, 40, 'BELTRAIDE White Rice', 'THE BEST WHITE RICE IN THE COUNTRY OF BELIZE................................................test', NULL, 1, 1, 45, 'edit', '2021-05-10 13:15:51', 45, '2021-05-06 16:35:16', 1);

-- ----------------------------
-- Table structure for registration_activity
-- ----------------------------
DROP TABLE IF EXISTS `registration_activity`;
CREATE TABLE `registration_activity`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `date_started` datetime(0) NOT NULL DEFAULT CURRENT_TIMESTAMP(0),
  `date_completed` datetime(0) NULL DEFAULT NULL,
  `activation_code` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL,
  `status` int NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `user_id`(`user_id`) USING BTREE,
  CONSTRAINT `registration_activity_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 48 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of registration_activity
-- ----------------------------
INSERT INTO `registration_activity` VALUES (35, 40, '2021-03-01 15:53:27', NULL, '5278f7586afaa7e9140c5cb23f282426', 1);
INSERT INTO `registration_activity` VALUES (39, 44, '2021-03-01 16:47:32', NULL, '31e49bc12560f305b0a0a6e5a6a7ee1a', 2);
INSERT INTO `registration_activity` VALUES (40, 45, '2021-03-01 21:47:59', '2021-03-01 21:50:50', '344e363149e883e11532d123b841240c', 1);
INSERT INTO `registration_activity` VALUES (42, 48, '2021-04-26 14:09:37', '2021-04-26 14:09:37', '7af30666991d53fdbf58d91e406d6af8', 1);
INSERT INTO `registration_activity` VALUES (43, 49, '2021-04-26 14:53:39', '2021-04-26 14:53:39', '9bed066ac2e3e49606341485bb8966bd', 1);
INSERT INTO `registration_activity` VALUES (44, 51, '2021-05-03 10:26:41', '2021-05-03 10:28:57', 'fb5eb82ea211a02e0ce1e0a40ab23425', 1);
INSERT INTO `registration_activity` VALUES (45, 52, '2021-05-03 10:58:01', '2021-05-03 10:58:19', 'b7357d5d6899edf838cbeaf572b92a29', 1);
INSERT INTO `registration_activity` VALUES (47, 54, '2021-05-03 14:39:58', '2021-05-03 14:39:58', '8196b5965b335d0f175e584951efdef9', 1);
INSERT INTO `registration_activity` VALUES (48, 55, '2021-05-16 18:34:01', '2021-05-16 18:34:01', 'ed14877309e7b6f05d7a357272a9bee7', 1);
INSERT INTO `registration_activity` VALUES (49, 57, '2021-05-16 19:03:12', '2021-05-16 19:03:12', '1fbe34df5f614ebbcf26661ec4962480', 1);
INSERT INTO `registration_activity` VALUES (50, 59, '2021-05-17 05:37:37', NULL, 'e0f23f13ec6a9a61764747705a58c46d', 2);
INSERT INTO `registration_activity` VALUES (51, 60, '2021-05-17 05:52:00', NULL, '666a4116731c19aa634a26ededdcfb32', 2);

-- ----------------------------
-- Table structure for sector
-- ----------------------------
DROP TABLE IF EXISTS `sector`;
CREATE TABLE `sector`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` char(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL,
  `is_featured` int NOT NULL DEFAULT 0,
  `created_by` int NOT NULL,
  `created_on` datetime(0) NULL DEFAULT 'now()',
  `img_path` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `status` int NULL DEFAULT 1,
  `update_by` int NULL DEFAULT NULL,
  `update_type` enum('edit','removed') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `update_on` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `created_by_fk`(`created_by`) USING BTREE,
  INDEX `update_by_fk`(`update_by`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 13 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of sector
-- ----------------------------
INSERT INTO `sector` VALUES (3, 'Agriculture', 'this is a test for agriculture description', 1, 0, '2021-03-09 10:14:52', 'uploads/sectors/agro-processing_1616398331.jpg', 1, NULL, NULL, NULL);
INSERT INTO `sector` VALUES (5, 'Rum & Liqueurs', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Maxime mollitia,\r\nmolestiae quas vel sint commodi repudiandae consequuntur voluptatum laborum\r\nnumquam blanditiis harum quisquam eius sed odit fugiat iusto fuga praesentium\r\noptio, eaque rerum! Provident similique accusantium nemo autem. Veritatis\r\nobcaecati tenetur iure eius earum ut molestias architecto voluptate aliquam\r\nnihil, eveniet aliquid culpa officia aut! Impedit sit sunt quaerat, odit,\r\ntenetur error, harum nesciunt ipsum debitis quas aliquid. Reprehenderit,\r\nquia.', 1, 0, '2021-03-12 10:16:17', 'uploads/sectors/travellers-beliezean-rum_1616541243.jpg', 1, 46, 'edit', '2021-03-23 17:14:03');
INSERT INTO `sector` VALUES (6, 'Light Manufactoring', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Maxime mollitia,\r\nmolestiae quas vel sint commodi repudiandae consequuntur voluptatum laborum\r\nnumquam blanditiis harum quisquam eius sed odit fugiat iusto fuga praesentium\r\noptio, eaque rerum! Provident similique accusantium nemo autem. Veritatis\r\nobcaecati tenetur iure eius earum ut molestias architecto voluptate aliquam\r\nnihil, eveniet aliquid culpa officia aut! Impedit sit sunt quaerat, odit,\r\ntenetur error, harum nesciunt ipsum debitis quas aliquid. Reprehenderit,\r\nquia.', 0, 0, '2021-03-12 10:16:32', NULL, 1, 46, 'edit', '2021-03-23 17:01:33');
INSERT INTO `sector` VALUES (7, 'Forestry', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Maxime mollitia,\r\nmolestiae quas vel sint commodi repudiandae consequuntur voluptatum laborum\r\nnumquam blanditiis harum quisquam eius sed odit fugiat iusto fuga praesentium\r\noptio, eaque rerum! Provident similique accusantium nemo autem. Veritatis\r\nobcaecati tenetur iure eius earum ut molestias architecto voluptate aliquam\r\nnihil, eveniet aliquid culpa officia aut! Impedit sit sunt quaerat, odit,\r\ntenetur error, harum nesciunt ipsum debitis quas aliquid. Reprehenderit,\r\nquia.', 1, 0, '2021-03-12 10:17:04', 'uploads/sectors/forestry_1616540241.jpg', 1, 46, 'edit', '2021-03-23 16:57:21');
INSERT INTO `sector` VALUES (8, 'Fisheries and Marine', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Maxime mollitia,\r\nmolestiae quas vel sint commodi repudiandae consequuntur voluptatum laborum\r\nnumquam blanditiis harum quisquam eius sed odit fugiat iusto fuga praesentium\r\noptio, eaque rerum! Provident similique accusantium nemo autem. Veritatis\r\nobcaecati tenetur iure eius earum ut molestias architecto voluptate aliquam\r\nnihil, eveniet aliquid culpa officia aut! Impedit sit sunt quaerat, odit,\r\ntenetur error, harum nesciunt ipsum debitis quas aliquid. Reprehenderit,\r\nquia.', 1, 0, '2021-03-12 10:17:24', 'uploads/sectors/Shrimp_1616540125.jpg', 1, 46, 'edit', '2021-03-23 16:55:25');
INSERT INTO `sector` VALUES (11, 'Agro-Processing updated 7', 'this is an update test 7', 0, 46, '2021-03-22 01:32:11', 'uploads/sectors/agro-processing-02_1616522228.png', 0, 46, 'removed', '2021-03-23 15:08:23');
INSERT INTO `sector` VALUES (12, 'Agro-Processing', 'This is the new sector agro processing', 1, 46, '2021-03-23 16:48:41', 'uploads/sectors/agro-processing-02_1616539721.png', 1, 46, 'edit', '2021-03-23 16:51:06');

-- ----------------------------
-- Table structure for services
-- ----------------------------
DROP TABLE IF EXISTS `services`;
CREATE TABLE `services`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL,
  `update_by` int NOT NULL,
  `update_type` enum('edit','removed') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `update_on` datetime(0) NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP(0),
  `created_by` int NULL DEFAULT NULL,
  `created_on` datetime(0) NOT NULL DEFAULT CURRENT_TIMESTAMP(0),
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `update_by`(`update_by`) USING BTREE,
  INDEX `created_by`(`created_by`) USING BTREE,
  CONSTRAINT `services_ibfk_1` FOREIGN KEY (`update_by`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `services_ibfk_2` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of services
-- ----------------------------

-- ----------------------------
-- Table structure for session_activity
-- ----------------------------
DROP TABLE IF EXISTS `session_activity`;
CREATE TABLE `session_activity`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `creation_date` datetime(0) NOT NULL DEFAULT CURRENT_TIMESTAMP(0),
  `logout_session_date` datetime(0) NULL DEFAULT NULL,
  `access_token` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL,
  `status` int NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `user_id`(`user_id`) USING BTREE,
  CONSTRAINT `session_activity_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of session_activity
-- ----------------------------

-- ----------------------------
-- Table structure for social_contact_list
-- ----------------------------
DROP TABLE IF EXISTS `social_contact_list`;
CREATE TABLE `social_contact_list`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `social_contact_id` int NULL DEFAULT NULL,
  `company_id` int NOT NULL,
  `link` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL,
  `status` int NULL DEFAULT 1,
  `created_on` datetime(0) NULL DEFAULT 'now()',
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `id`(`id`) USING BTREE,
  INDEX `social_contact_id`(`social_contact_id`) USING BTREE,
  INDEX `company_id`(`company_id`) USING BTREE,
  CONSTRAINT `social_contact_list_ibfk_1` FOREIGN KEY (`social_contact_id`) REFERENCES `social_contacts` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `social_contact_list_ibfk_2` FOREIGN KEY (`company_id`) REFERENCES `company` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 28 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of social_contact_list
-- ----------------------------
INSERT INTO `social_contact_list` VALUES (25, 4, 40, 'https://www.facebook.com/BELTRAIDE/', 1, '2021-04-06 14:09:39');
INSERT INTO `social_contact_list` VALUES (26, 5, 40, 'https://www.instagram.com/beltraide/', 1, '2021-04-06 14:09:39');
INSERT INTO `social_contact_list` VALUES (27, 6, 40, 'https://twitter.com/beltraide', 1, '2021-04-06 14:09:39');
INSERT INTO `social_contact_list` VALUES (28, 7, 40, 'https://www.linkedin.com/', 1, '2021-04-07 09:00:03');
INSERT INTO `social_contact_list` VALUES (29, 4, 44, NULL, 1, '2021-05-17 05:08:27');
INSERT INTO `social_contact_list` VALUES (30, 5, 44, NULL, 1, '2021-05-17 05:08:27');
INSERT INTO `social_contact_list` VALUES (31, 6, 44, NULL, 1, '2021-05-17 05:08:27');
INSERT INTO `social_contact_list` VALUES (32, 7, 44, NULL, 1, '2021-05-17 05:08:27');
INSERT INTO `social_contact_list` VALUES (33, 4, 44, NULL, 1, '2021-05-17 05:10:00');
INSERT INTO `social_contact_list` VALUES (34, 5, 44, NULL, 1, '2021-05-17 05:10:00');
INSERT INTO `social_contact_list` VALUES (35, 6, 44, NULL, 1, '2021-05-17 05:10:00');
INSERT INTO `social_contact_list` VALUES (36, 7, 44, NULL, 1, '2021-05-17 05:10:00');
INSERT INTO `social_contact_list` VALUES (37, 4, 44, NULL, 1, '2021-05-17 05:10:40');
INSERT INTO `social_contact_list` VALUES (38, 5, 44, NULL, 1, '2021-05-17 05:10:40');
INSERT INTO `social_contact_list` VALUES (39, 6, 44, NULL, 1, '2021-05-17 05:10:40');
INSERT INTO `social_contact_list` VALUES (40, 7, 44, NULL, 1, '2021-05-17 05:10:40');
INSERT INTO `social_contact_list` VALUES (41, 4, 44, NULL, 1, '2021-05-17 05:11:55');
INSERT INTO `social_contact_list` VALUES (42, 5, 44, NULL, 1, '2021-05-17 05:11:55');
INSERT INTO `social_contact_list` VALUES (43, 6, 44, NULL, 1, '2021-05-17 05:11:55');
INSERT INTO `social_contact_list` VALUES (44, 7, 44, NULL, 1, '2021-05-17 05:11:55');
INSERT INTO `social_contact_list` VALUES (45, 4, 44, NULL, 1, '2021-05-17 05:12:39');
INSERT INTO `social_contact_list` VALUES (46, 5, 44, NULL, 1, '2021-05-17 05:12:39');
INSERT INTO `social_contact_list` VALUES (47, 6, 44, NULL, 1, '2021-05-17 05:12:39');
INSERT INTO `social_contact_list` VALUES (48, 7, 44, NULL, 1, '2021-05-17 05:12:39');

-- ----------------------------
-- Table structure for social_contacts
-- ----------------------------
DROP TABLE IF EXISTS `social_contacts`;
CREATE TABLE `social_contacts`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` char(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `icon` char(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `status` int NULL DEFAULT 1,
  `created_on` datetime(0) NULL DEFAULT 'now()',
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `id`(`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of social_contacts
-- ----------------------------
INSERT INTO `social_contacts` VALUES (4, 'Facebook', 'fab fa-facebook-f', 1, '2021-03-24 15:51:39');
INSERT INTO `social_contacts` VALUES (5, 'Instagram', 'fab fa-instagram', 1, '2021-03-24 15:53:13');
INSERT INTO `social_contacts` VALUES (6, 'Twitter', 'fab fa-twitter', 1, '2021-03-24 15:54:23');
INSERT INTO `social_contacts` VALUES (7, 'LinkedIn', 'fab fa-linkedin-in', 1, '2021-04-06 15:18:38');

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `full_name` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `email` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `user_type` enum('admin','buyer','company','su') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `salt` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `password` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `status` int NULL DEFAULT 1,
  `created_on` datetime(0) NULL DEFAULT 'now()',
  `created_by` int NULL DEFAULT 0,
  `update_by` int NULL DEFAULT NULL,
  `update_type` enum('edit','removed','rejected') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `update_on` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `id`(`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 55 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES (40, 'Danielson Correa', 'danielsoncorrea@gmail.com', 'company', '20140a3655e69e', 'de96dca64576736f9dfe4a983252f769', 3, '2021-03-01 15:53:27', 0, NULL, NULL, NULL);
INSERT INTO `users` VALUES (44, 'daniels corea', 'danielson@belizeinvest.org.bz', 'company', '9bdd2ccbf70482', 'abdfdef727da22557110376dcbeee295', 2, '2021-03-01 16:47:32', 0, NULL, NULL, NULL);
INSERT INTO `users` VALUES (45, 'It Department', 'beltraide.export.belize@gmail.com', 'company', '9f6004245112ee', '5ce4b59712a0d660e0c7f1bb20514f0d', 1, '2021-03-01 21:47:59', 0, 46, 'removed', '2021-04-14 16:35:35');
INSERT INTO `users` VALUES (46, 'Dan Corea', 'admin@admin.com', 'admin', '9f6004245112ee', '5ce4b59712a0d660e0c7f1bb20514f0d', 1, '2021-03-02 15:40:04', 0, 46, 'edit', '2021-05-14 11:42:52');
INSERT INTO `users` VALUES (48, 'IT Solutions', '506itsolutions@gmail.com', 'company', '4de72695c48fd1', '95076b8b3644a0d43d07aeefc250eb58', 1, '2021-04-26 14:09:37', 46, NULL, NULL, NULL);
INSERT INTO `users` VALUES (49, 'John Doe', 'johndoe@gmail.com', 'company', '54353dfacd5266', 'dbdffaa9f2ef286ecbb3c59cd06f5a67', 1, '2021-04-26 14:53:39', 46, NULL, NULL, NULL);
INSERT INTO `users` VALUES (51, 'Linito Corea', 'linitocorea@gmail.com', 'company', 'be2b912b7f1ef2', '83bb4a6489aedbef3b6d9d25b2a1e09a', 1, '2021-05-03 10:26:41', 51, NULL, NULL, NULL);
INSERT INTO `users` VALUES (52, 'Linito Corea', 'chilinitocorea@gmail.com', 'company', '63e5a5af6a91ef', '79c019045a11b07e1247f5784ab4164a', 1, '2021-05-03 10:58:01', 52, NULL, NULL, NULL);
INSERT INTO `users` VALUES (54, 'Add User', '2016114269@ub.edu.bz', 'company', '7bd1b5f1b03c6f', 'c587c115a12ed8b965ed38b10dcc4722', 1, '2021-05-03 14:39:58', 46, NULL, NULL, NULL);
INSERT INTO `users` VALUES (55, 'test_company Test_company_lastname', 'testcompany@test.com', 'company', '63f4a1bc6967161621211641', '480423fad7b86d5bf3c5e4714e541eab', 1, '2021-05-16 18:34:01', 46, NULL, NULL, NULL);
INSERT INTO `users` VALUES (57, 'buyer test', 'buyertest@gmail.com', 'buyer', '7e1d42348971b71621213392', 'c14bcc042a0a1451b939c3bacf69e283', 1, '2021-05-16 19:03:12', 46, 46, 'edit', '2021-05-17 00:40:05');
INSERT INTO `users` VALUES (59, 'Gwen Correa', 'correagwendolin@gmail.com', 'buyer', '8a98106be350b11621251457', '0d73c72dc5676ba72976fb293b299be2', 2, '2021-05-17 05:37:37', 0, NULL, NULL, NULL);
INSERT INTO `users` VALUES (60, 'Leonor Correa', 'jesusthesonofgodloveme@gmail.com', 'buyer', 'a2879cb06ccfdb1621252320', '3555db6d112d7c861adc779f84e1a804', 2, '2021-05-17 05:52:00', 0, NULL, NULL, NULL);

-- ----------------------------
-- Procedure structure for activate_account
-- ----------------------------
DROP PROCEDURE IF EXISTS `activate_account`;
delimiter ;;
CREATE PROCEDURE `activate_account`(in p_activation_code text)
  SQL SECURITY INVOKER
BEGIN
	
	declare d_activation_code text;

	DECLARE exit handler for sqlexception
	BEGIN
		
		GET DIAGNOSTICS CONDITION 1
		@p1 = RETURNED_SQLSTATE,
		@p2 = MESSAGE_TEXT;
		
        SELECT @p1 as res_code  , @p2 as message;
		ROLLBACK;
	END;    
    start transaction;
    
    set @user_id := 0;
    set @code_status := 5;
    
    UPDATE 
			registration_activity
		SET 
			status = (
				select @code_status := 
				if(date_started + interval 24 hour >= now(), 1 , 5)
			),
			date_completed = now()
        
    WHERE 
			status = 2 and  
      activation_code = p_activation_code and 
			(select @user_id := user_id) 
		;
    
    if @user_id = 0 then 
			signal sqlstate '42000' set message_text = 'Activation code does not exist!';
    end if;
    
		
    if @code_status = 5 then 
		
		
        
        set d_activation_code = md5(concat(now(), RAND()));
        				
				
				INSERT INTO
							registration_activity(user_id, date_started, activation_code, status)
				VALUES(
					@user_id,
					now(),
					d_activation_code,
					2 
				);
        
       select 5 as res_code, 'Activation code has expired!' as message, @user_id as user_id, d_activation_code as activation_code;
           
		else 
		
    
		
			set @user_type := (
				select
					user_type 
				from 
					users
				where 
					id = @user_id
			);
		
			
			update 
				users as u
			set 
				status = (
					if (@user_type = 'company', 3, 1) 
	 			)
			where 
				u.id = @user_id;
				
			
			update 
				company as c
			set 
				status = (
					if (@user_type= 'company', 3, 1) 
	 			)
			where 
				c.user_id = @user_id;


			select 1 as res_code, 'Account verification complete!' as message, @user_id as user_id, @user_type as user_type;

    end if;
		
		commit;
    
END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for add_user
-- ----------------------------
DROP PROCEDURE IF EXISTS `add_user`;
delimiter ;;
CREATE PROCEDURE `add_user`(in p_created_by int,
		in p_user_type varchar(50),
	  in p_full_name varchar(150),
    in p_email varchar(255),
    in p_b_name varchar(150),
		in p_b_descr text,
    in p_b_ctv varchar(200),
    in p_b_address varchar(150),
    in p_b_district char(100),
		in p_b_type int,
		in p_trade_type varchar(50),
    in p_password varchar(200),
    in p_salt varchar(70))
  SQL SECURITY INVOKER
BEGIN

	declare d_user_id int;
	declare d_company_id int;
	declare d_activation_code text;
    
	DECLARE EXIT HANDLER FOR SQLEXCEPTION 
		BEGIN
			GET DIAGNOSTICS CONDITION 1
			@p1 = RETURNED_SQLSTATE,
			@p2 = MESSAGE_TEXT;
			
			SELECT @p1 as res_code, @p2 as message;
			ROLLBACK;
		END;
	 
		start transaction;
		set @user_exist := (
			select 
				count(id)
            from 
				users 
            where
				email = p_email
		);
        
		set @valid_approver := (select count(id) from users where id = p_created_by and user_type = 'admin' or user_type = 'su' and status = 1);
			
		if @valid_approver = 0 then 
			signal sqlstate '42000' set message_text = 'Sorry but you are not allowed to add users';
		end if;
		
    if @user_exist > 0 then 
			signal sqlstate '42000' set message_text = 'The email entered has already been used to create an account';
		end if;
        
    if p_email is null or length(p_email) < 3 then 
			signal sqlstate '42000' set message_text = 'Email specified is not valid';
		end if;
        
		set d_activation_code = md5(concat(now(), RAND()));
        
		INSERT INTO
			users(full_name, email,	user_type, salt, password, created_by, created_on, status)
		VALUES(p_full_name, p_email, p_user_type, p_salt, md5(p_password), p_created_by, now(), 1);

		set d_user_id = last_insert_id();
        
		if p_user_type = 'company' then
		
				INSERT INTO
					company(user_id, name, email, description, ctv, address, district, company_type_id, trade_type, created_by, created_on, status)
				VALUES(
					d_user_id,
					p_b_name,
					p_email,
					p_b_descr,
					p_b_ctv,
					p_b_address,
					p_b_district,
					p_b_type,
					p_trade_type,
					p_created_by,
					now(),
					1 
				);
				set d_company_id = last_insert_id();
				
				INSERT INTO
					registration_activity(user_id, date_started, date_completed, activation_code, status)
				VALUES(
						d_user_id,
						now(),
						now(),
						d_activation_code,
						1
					);
					
					insert into company_approval_list(
					company_id,
					approved_by,
					approved_on,
					status,
					created_on
					) 
					values(
							d_company_id,
							p_created_by,
							now(),
							1,
							now()
					);
							
		end if;
					
		if p_user_type = 'buyer' then 

				INSERT INTO
					buyer(user_id, business_name, description, created_by, created_on, status)
				VALUES(
					d_user_id,
					p_b_name,
					p_b_descr,
					p_created_by,
					now(),
					1 
				);
				set d_company_id = last_insert_id();
				
				INSERT INTO
					registration_activity(user_id, date_started, date_completed, activation_code, status)
				VALUES(
						d_user_id,
						now(),
						now(),
						d_activation_code,
						1
					);
		end if;
			

			select 1 as res_code, 'success' as message, d_user_id as user_id;
        
			commit;
	
END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for approve_company_account
-- ----------------------------
DROP PROCEDURE IF EXISTS `approve_company_account`;
delimiter ;;
CREATE PROCEDURE `approve_company_account`(IN p_company_id int,
	IN p_approved_by int,
	IN p_approval_status int)
BEGIN

	DECLARE exit handler for sqlexception
	BEGIN
		
		GET DIAGNOSTICS CONDITION 1
		@p1 = RETURNED_SQLSTATE,
		@p2 = MESSAGE_TEXT;
		
        SELECT @p1 as res_code  , @p2 as message;
		ROLLBACK;
	END;    
  start transaction;
	
		
		if p_approval_status = 1 or p_approval_status = 4 then 
			
			set @user_id := 0;
			set @is_approved := 0;
			set @valid_approver := 0;
			set @company_email := '';
			set @company_name := '';
			
			set @valid_approver := (select count(id) from users where id = p_approved_by and user_type = 'admin' or user_type = 'su' and status = 1);
			
			if @valid_approver = 0 then 
				signal sqlstate '42000' set message_text = 'Sorry but you are not allowed to perform that action';
			end if;
			
			-- checking if the company is pedding approval 
			set @valid_user_status := 0;
			set @valid_company_status := 0;
			
			select 
				c.status,
				u.status,
				c.email,
				c.name
			into 
				@valid_company_status,
				@valid_user_status,
				@company_email,
				@company_name
			
			from 
				company c,
				users u
			where 
				c.user_id = u.id and 
				c.id = p_company_id 
			;
				
			if @valid_user_status <> 3 or @valid_company_status <> 3 then 
			
				signal sqlstate '42000' set message_text = 'The specified company is not pending approval or does not exist';
				
			end if;
				
				
			set @is_approved := (
				select 
					COALESCE(id, 0)
				from 
					company_approval_list 
				where
					company_id = p_company_id and
					status = 1 or 
					status = 4
					
			);

			if @is_approved > 0 then
				signal SQLSTATE '42000' set message_text = 'Action has been taken for the selected company';			
			else 
				-- setting status to approved
				
				insert into company_approval_list(
					company_id,
					approved_by,
					approved_on,
					status,
					created_on
					) 
					values(
							p_company_id,
							p_approved_by,
							now(),
							p_approval_status,
							now()
					);
				-- updating company profile
				update 
					company c
				set
					c.status = p_approval_status
				where 
					id = p_company_id and 
					(select @user_id := c.user_id);
					
				update 
					users u
				set
					u.status = p_approval_status
				where 
					id = @user_id;
				
			end if;

			select '1' as res_code, 'success' as message, @company_email as company_email, @company_name as company_name;	
		
		else 
		
			signal sqlstate '42000' set message_text = 'Please enter a valid action';
			
		end if;
		
		
		
	commit;
END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for change_account_status
-- ----------------------------
DROP PROCEDURE IF EXISTS `change_account_status`;
delimiter ;;
CREATE PROCEDURE `change_account_status`(IN p_user_id INT,
	IN p_code varchar(200),
	IN p_status INT,
    IN p_update_by INT,
    IN p_update_type char(50))
  SQL SECURITY INVOKER
BEGIN
	
	declare d_ra_user_id int default null;
    declare d_ra_code_status int default 5;
    
	DECLARE exit handler for sqlexception
	BEGIN
		
		GET DIAGNOSTICS CONDITION 1
		@p1 = RETURNED_SQLSTATE,
		@p2 = MESSAGE_TEXT;
		
        SELECT @p1 as res_code  , @p2 as message;
		ROLLBACK;
	END;
    
    start transaction;
    
		set @d_status := 0;
		set @d_update_on := null;
		set @is_found := null;
        
        if p_update_by <> null then
			set @d_update_on := now();
        end if ;
        
        if p_status is not null then
			set @d_status := p_status;
        end if ;
        
        
        set @is_found := (Select id from users where id = p_user_id);
        
        if @is_found is null then
			signal sqlstate '45000' set message_text = 'The user specified does not exist';
        end if;
		
        
        UPDATE 
			users
		set 
			status = @d_status,
            update_by = p_update_by,
            update_type = p_update_type,
            update_on = @d_update_on
		where 
				id = p_user_id;
                
		
        UPDATE 
			company
		set 
			status = @d_status,
            update_by = p_update_by,
            update_type = p_update_type,
            update_on = @d_update_on
		where 
			user_id = p_user_id;
		
		if p_code <> '' then
        
			    select 
					user_id ,
				    if(NOW() < DATE_ADD(date_started, INTERVAL 30 MINUTE), 1, 5) as code_status
				into 
					d_ra_user_id,
                    d_ra_code_status
				from 
					registration_activity 
				where 
					user_id = p_user_id and 
					activation_code = p_code and 
					status = 2;

			
			if d_ra_user_id is null then
				signal sqlstate '45001' set message_text = 'Activation was code not found';
            end if;
           
            
            if d_ra_code_status = 5 then
				
				Update 
					registration_activity
				set 
					status = 5
				where 
					user_id = p_user_id and 
                    activation_code = p_code;
                    
                select 45002 as res_code, 'Activation Code has expired!' as message;
			else 
            
					UPDATE
						registration_activity
					SET
						status = 1,
						date_completed = now()
					WHERE 
						u.id = @d_user_id and
						activation_code = p_code;
                        
					select 1 as res_code, 'Account Verification has be completed!' as message;
                        
            end if;
            
		else 
			select 1 as res_code, 'success' as message;
		end if;        
        
	commit;
END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for confirm_password_reset
-- ----------------------------
DROP PROCEDURE IF EXISTS `confirm_password_reset`;
delimiter ;;
CREATE PROCEDURE `confirm_password_reset`(IN p_reset_code text,
 in p_password varchar(200),
 in p_pepper varchar(200))
  SQL SECURITY INVOKER
BEGIN

	declare d_reset_code text;

	DECLARE exit handler for sqlexception
	BEGIN
		
		GET DIAGNOSTICS CONDITION 1
		@p1 = RETURNED_SQLSTATE,
		@p2 = MESSAGE_TEXT;
		
        SELECT @p1 as res_code  , @p2 as message;
		ROLLBACK;
	END;    
    start transaction;

		if p_reset_code is null then
			-- checking if email was passed	
			signal sqlstate '42000' set message_text = 'Please enter a valid reset code!'; 
		end if;
		
		if p_password is null or LENGTH(p_password) < 8 then
			-- checking if email was passed	
			signal sqlstate '42000' set message_text = 'Please enter a valid password that is 8 or more characters long!'; 
		end if;
		
		set @user_id := 0;
		set @code_status := 5;
		
		update 
			forgot_password_activity
		set 
			status = (select @code_status := if(date_requested + interval 24 hour >= now(), 1 , 5)),
			date_completed = now()
		where 
			status = 2 and 
			reset_code = p_reset_code and 
			(select @user_id := user_id);
			
		
		if @user_id = 0 then
			signal sqlstate '42000' set message_text = 'The reset code was not found!';
		end if;
		
		if @code_status = 5 then
		
			 /*set d_reset_code = md5(concat(now(), RAND()));
        				
				-- insert registration activity
				INSERT INTO
							forgot_password_activity(user_id, date_requested, reset_code, status)
				VALUES(
					@user_id,
					now(),
					d_reset_code,
					2 
				);*/
        
       select 5 as res_code, 'Password reset code has expired!' as message, @user_id as user_id;
			 
	  else
			set @user_salt := (select salt from users where id = @user_id);

			update 
				users
			set 
				password = md5(
					CONCAT(
						p_password,
						@user_salt,
						p_pepper
						)
				)
			where
				id = @user_id;
				
			select 1 as res_code, 'Success' as message, @user_id as user_id;
		end if;
				
		commit;
END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for get_buyer_list
-- ----------------------------
DROP PROCEDURE IF EXISTS `get_buyer_list`;
delimiter ;;
CREATE PROCEDURE `get_buyer_list`(IN p_name varchar(200),
	IN p_user_id int,
	IN p_status int,
	IN p_limit int)
BEGIN

	declare d_limit int default 0;
	
	if p_limit is null or p_limit = 0 then 
		set d_limit = 1000000;
	else
		set d_limit = p_limit;
	end if;
	
	
	SELECT
			u.id as user_id,
			u.full_name as full_name,
			u.email as buyer_email,
			u.status as user_status,
			u.created_by,
			(select uCreated.full_name from users as uCreated where uCreated.id = u.created_by) as created_by_name,
			DATE_FORMAT(u.created_on, "%M %d %Y") as created_on,
			u.update_by,
			(select uUpdate.full_name from users as uUpdate where uUpdate.id = u.update_by) as update_by_name,
			DATE_FORMAT(u.update_on, "%M %d %Y") as update_on,
			u.update_type,
			b.id as buyer_id,
			b.business_name as business_name,
			b.description as buyer_description,
			b.status as buyer_status,
			DATE_FORMAT(ra.date_completed, "%M %d %Y") as date_joined

	FROM
			users as u,
			buyer as b,
			registration_activity as ra
	WHERE
			b.user_id = u.id and
			ra.user_id = u.id and  
			(
				case 
					when p_user_id is null then true
					else u.id = p_user_id 
				end
			)AND
			u.user_type = "buyer" AND
			(
				case 
					when p_status = -1 then true
					else 
						u.status = p_status and 
						b.status = p_status
				end 
			) and 
			(
				case 
					when p_name is null then true
					else 
						u.full_name like CONCAT('%',p_name,'%')
				end 
			)
			limit d_limit;

END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for get_company_list
-- ----------------------------
DROP PROCEDURE IF EXISTS `get_company_list`;
delimiter ;;
CREATE PROCEDURE `get_company_list`(IN p_name varchar(200),
	IN p_company_id int,
	IN p_status int,
	IN p_limit int)
BEGIN

	declare d_limit int default 0;
	
	if p_limit is null or p_limit = 0 then 
		set d_limit = 1000000;
	else
		set d_limit = p_limit;
	end if;
	
	
	SELECT
			u.id as user_id,
			u.full_name as full_name,
			u.status as user_status,			
			c.id as company_id,
			c.name as company_name,
			c.established_on, 
			c.current_seat_capacity,
			c.expansion_potential,
			c.mib_catalogue_status,
			c.company_type_id,
			(select display_name from company_type as ct where ct.id = c.company_type_id) as company_type_name,
			(select icon from company_type as ct where ct.id = c.company_type_id) as company_type_icon,
			c.trade_type,
			c.description,
			c.website_link,
			c.phone,
			c.email as company_email,
			c.status as company_status,
			c.ctv,
			c.address,
			c.district,
			c.is_featured,
			c.logo_img_path as logo_img,
			c.created_by,
			(select cCreated.full_name from users as cCreated where cCreated.id = c.created_by) as created_by_name,
			DATE_FORMAT(c.created_on, "%M %d %Y") as created_on,
			c.update_by,
			(select cUpdate.full_name from users as cUpdate where cUpdate.id = c.update_by) as update_by_name,
			DATE_FORMAT(c.update_on, "%M %d %Y") as update_on,
			c.update_type,
			(select full_name from users where id = cal.approved_by) as approved_by,
			DATE_FORMAT(cal.approved_on, "%M %d %Y") as date_approved
	FROM
			users as u,
			company as c
		
	left join company_approval_list as cal on cal.company_id = c.id
	
	WHERE
			c.user_id = u.id AND
			u.user_type = "company" AND
			(
				case 
					when p_status = -1 then true
					else 
						u.status = p_status and 
						c.status = p_status
				end 
			) and 
			(
				case
					when p_company_id is null then true
					else c.id = p_company_id
				end
			)and
			(
				case 
					when p_name is null then true
					else 
						c.name like CONCAT('%',p_name,'%')
				end 
			)
			limit d_limit;
			
			

END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for get_products
-- ----------------------------
DROP PROCEDURE IF EXISTS `get_products`;
delimiter ;;
CREATE PROCEDURE `get_products`(IN p_name varchar(200),
	IN p_hs_code varchar(100),
	IN p_product_id int,
	IN p_sector_id int,
	IN p_export_id int,
	IN p_status int,
	IN p_limit int)
BEGIN

	declare d_limit int default 0;
	
	if p_limit is null or p_limit = 0 then 
		set d_limit = 1000000;
	else
		set d_limit = p_limit;
	end if;

	
	SELECT 
				prod.id as product_id,
				prod.company_id,
				prod.is_featured,
				prod.name as product_name,
				prod.description as product_description,
				(select cCreated.full_name from users as cCreated where cCreated.id = prod.created_by) as created_by_name,
				DATE_FORMAT(prod.created_on, "%M %d %Y") as created_on,
				prod.update_by,
				(select cUpdate.full_name from users as cUpdate where cUpdate.id = prod.update_by) as update_by_name,
				DATE_FORMAT(prod.update_on, "%M %d %Y") as update_on,
				prod.update_type,
				prod.hs_code_id,
				hsc.name as hs_code_name,
				hsc.hs_code as hs_code,
				com.name as company_name,
				sec.id as sector_id,
				sec.name as sector_name,
				e.export_market_id,
				e.name as export_market_name
				-- em.id as export_market_id,
				-- em.name as export_market_name					
				
		from
				products as prod,
			  hs_code as hsc,
				sector as sec,
				company as com		
				
		left outer join
		(		
			select 
				em.name,
				em.id as export_market_id,
				eml.company_id
	
			from 
				export_market_list as eml,
				export_market as em
			where
				eml.export_market_id = em.id and 
				(
					case 
						when p_export_id is null then 
							false
						else 
							eml.export_market_id = p_export_id
					end
				)and 
				eml.status = 1 and 
				em.status = 1
		) e on (com.id = e.company_id)
	  
		-- left join export_market_list eml on eml.company_id = com.id
		-- left join export_market em on em.id = eml.export_market_id
			
		where
				prod.hs_code_id = hsc.id  and
				hsc.sector_id = sec.id and
				prod.company_id = com.id and
				(
					case 
						when p_product_id is null then true
						else prod.id = p_product_id
					end
				) and 
				(
					case 
						when p_sector_id is null then 
							hsc.sector_id = sec.id 
						else hsc.sector_id = p_sector_id
					end 
				) and
				(
					case 
						when p_export_id is not null and e.export_market_id is null then 
							false
						else 
							true 
					end 
				) and 
				/*(
					case 
						when p_export_id is null then true
						else 
							eml.export_market_id = p_export_id and 
							eml.status = 1 and 
							em.status = 1
					end 
				) and */
				(
					case
						when p_status = -1 then true
						else prod.status = 1
					end
				) and 
				(
					case 
						when p_hs_code is null then true
						else 
							hsc.hs_code like CONCAT(p_hs_code,'%')
					end 
				)and 
				(
					case 
						when p_name is null then true
						else 
							prod.name like CONCAT(p_name,'%')
					end 
				)and 
				com.status = 1 and
				hsc.status = 1 and
				sec.status = 1
				
				LIMIT d_limit;

END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for register_buyer_account
-- ----------------------------
DROP PROCEDURE IF EXISTS `register_buyer_account`;
delimiter ;;
CREATE PROCEDURE `register_buyer_account`(in p_full_name varchar(150),
    in p_email varchar(255),
    in p_b_name varchar(150),
    in p_password varchar(200),
    in p_salt varchar(70))
  SQL SECURITY INVOKER
BEGIN

	declare d_user_id int;
	declare d_activation_code text;
    
	DECLARE EXIT HANDLER FOR SQLEXCEPTION 
		BEGIN
			GET DIAGNOSTICS CONDITION 1
			@p1 = RETURNED_SQLSTATE,
			@p2 = MESSAGE_TEXT;
			
			SELECT @p1 as res_code, @p2 as message;
			ROLLBACK;
		END;
	 
		start transaction;
			set @user_exist := (
				select 
					count(id)
							from 
					users 
							where
					email = p_email
			);
					
			if @user_exist > 0 then 
				signal sqlstate '42000' set message_text = 'Email specified has been used to create an account!';
			end if;

					if p_email is null or length(p_email) < 3 then 
				signal sqlstate '42000' set message_text = 'Email specified is not valid';
			end if;
					
			set d_activation_code = md5(concat(now(), RAND()));
					
			INSERT INTO
				users(full_name, email,	user_type, salt, password, status)
			VALUES(p_full_name, p_email, 'buyer', p_salt, md5(p_password), 2);

			set d_user_id = last_insert_id();
					
			INSERT INTO
				buyer(user_id, business_name, created_on, created_by, status)
			VALUES(d_user_id, p_b_name, now(), d_user_id, 2);
					
			INSERT INTO
				registration_activity(user_id, date_started, activation_code, status)
			VALUES(
				d_user_id,
				now(),
							d_activation_code,
							2 
			);
					
					
			select 1 as res_code, 'success' as message, d_user_id as user_id, d_activation_code as activation_code;
		
		commit;
	
END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for register_company_account
-- ----------------------------
DROP PROCEDURE IF EXISTS `register_company_account`;
delimiter ;;
CREATE PROCEDURE `register_company_account`(in p_full_name varchar(150),
    in p_email varchar(255),
    in p_b_name varchar(150),
    in p_b_ctv varchar(200),
    in p_b_address varchar(150),
    in p_b_district char(100),
		in p_b_description text,
		in p_b_type int,
		in p_trade_type varchar(50),
    in p_password varchar(200),
    in p_salt varchar(70))
  SQL SECURITY INVOKER
BEGIN

	declare d_user_id int;
	declare d_activation_code text;
    
	DECLARE EXIT HANDLER FOR SQLEXCEPTION 
		BEGIN
			GET DIAGNOSTICS CONDITION 1
			@p1 = RETURNED_SQLSTATE,
			@p2 = MESSAGE_TEXT;
			
			SELECT @p1 as res_code, @p2 as message;
			ROLLBACK;
		END;
	 
		start transaction;
		set @user_exist := (
			select 
				count(id)
            from 
				users 
            where
				email = p_email
		);
        
        if @user_exist > 0 then 
			signal sqlstate '42000' set message_text = 'User already exists';
		end if;
        
        if p_email is null or length(p_email) < 3 then 
			signal sqlstate '42000' set message_text = 'Email specified is not valid';
		end if;
        
        set d_activation_code = md5(concat(now(), RAND()));
        
		INSERT INTO
			users(full_name, email,	user_type, salt, password, created_on, status)
		VALUES(p_full_name, p_email, 'company', p_salt, md5(p_password), now(), 2);

		set d_user_id = last_insert_id();
		
		UPDATE 
			users u
		SET 
			u.created_by = d_user_id		
		WHERE 
			u.id = d_user_id;
			
		INSERT INTO
			company(user_id, name, email, ctv, address, district, description, company_type_id, trade_type, created_by, created_on, status)
		VALUES(
			d_user_id,
			p_b_name,
			p_email,
			p_b_ctv,
			p_b_address,
			p_b_district,
			p_b_description,
			p_b_type,
			p_trade_type,
			d_user_id,
			now(),
			2 
		);
        
        INSERT INTO
			registration_activity(user_id, date_started, activation_code, status)
		VALUES(
						d_user_id,
						now(),
            d_activation_code,
            2 
        );
        
		select 1 as res_code, 'success' as message, d_user_id as user_id, d_activation_code as activation_code;
        
        commit;
	
END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for reject_company_account
-- ----------------------------
DROP PROCEDURE IF EXISTS `reject_company_account`;
delimiter ;;
CREATE PROCEDURE `reject_company_account`(IN p_company_id int,
	IN p_approved_by int)
BEGIN

	DECLARE exit handler for sqlexception
	BEGIN
		
		GET DIAGNOSTICS CONDITION 1
		@p1 = RETURNED_SQLSTATE,
		@p2 = MESSAGE_TEXT;
		
        SELECT @p1 as res_code  , @p2 as message;
		ROLLBACK;
	END;    
  start transaction;
		
		set @user_id := 0;
		set @is_approved := 0;
		set @valid_approver := 0;
		
		set @valid_approver := (select count(id) from users where id = p_approved_by and user_type = 'admin' and status = 1);
		
		if @valid_approver = 0 then 
			signal sqlstate '42000' set message_text = 'Sorry but you are not allowed to perform that action';
		end if;
		
		set @is_approved := (
			select 
				COALESCE(id, 0)
			from 
				company_approval_list 
			where
				company_id = p_company_id and
				status = 1 or 
				status = 4
		);

		if @is_approved > 0 then
			signal SQLSTATE '42000' set message_text = 'Action has been taken for the selected company';			
		else 
			-- setting status to approved
			
			insert into company_approval_list(
				company_id,
				approved_by,
				approved_on,
				status,
				created_on
				) 
				values(
						p_company_id,
						p_approved_by,
						now(),
						4,
						now()
				);
			-- updating company profile
			update 
				company c
			set
				c.status = 4
			where 
				id = p_company_id and 
				(select @user_id := c.user_id);
				
			update 
				users u
			set
				u.status = 4
			where 
				id = @user_id;
			
		end if;

		
		
		
		select 1 as res_code, 'success!' as message;
	commit;
END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for request_password_reset
-- ----------------------------
DROP PROCEDURE IF EXISTS `request_password_reset`;
delimiter ;;
CREATE PROCEDURE `request_password_reset`(IN p_email varchar(200))
  SQL SECURITY INVOKER
BEGIN

	declare d_reset_code text;
	declare d_user_id INT;
	declare d_user_status INT;

	DECLARE exit handler for sqlexception
	BEGIN
		
		GET DIAGNOSTICS CONDITION 1
		@p1 = RETURNED_SQLSTATE,
		@p2 = MESSAGE_TEXT;
		
        SELECT @p1 as res_code  , @p2 as message;
		ROLLBACK;
	END;    
    start transaction;

		if p_email is null then
			
			signal sqlstate '42000' set message_text = 'Email not valid!'; 
		end if;
				
		select 
			u.id,
			u.status
			
		into 
			d_user_id, 
			d_user_status 
		from 
			users u 
		where 
			u.email = p_email;
		
		if d_user_id is null then
			
				signal sqlstate '42000' set message_text = 'The email specified does not exist!';
		
		end if;
		
		set @active_request := (	-- checking if user has a pending password reset request 
				select 
					 if(fpa.date_requested + interval 24 hour >= now(), 2, 5) 
				from 
					forgot_password_activity fpa
				where 
					user_id = d_user_id and 
					fpa.status = 2
		);
		
		if @active_request <> 0 then 
			
			case 
				when @active_request = 2 then 
				
					signal sqlstate '42000' set message_text = 'A password reset request has already been requested!';
				
				when @active_request = 5 then 
					-- password request expired
					update forgot_password_activity set status = 5 where user_id = d_user_id and status = 2;
				
				else
					signal SQLSTATE '42000' set message_text = @active_request;
					
			end case;
		
		end if ;
		
		
		
		case 
		
			when d_user_status = '4' then 
				signal sqlstate '42000' set message_text = 'The email specified has been rejected by the administrators';
		
			when d_user_status = '3' then 
				signal sqlstate '42000' set message_text = 'The email specified is currently pending approval by our adminitrators';
				
			when d_user_status = '2' then 
				signal sqlstate '42000' set message_text = 'The email specified is currently pending account verification, please verify your account and try again later';
			
			when d_user_status = '1' then 
				set d_reset_code = md5(concat(now(), RAND()));
				
				insert into forgot_password_activity(user_id, date_requested, reset_code, status) values(d_user_id, now(), d_reset_code, 2);
				
				select 1 as res_code, 'success' as message, d_reset_code as reset_code;
				
			else 
				signal sqlstate '42000' set message_text = 'The email specified does not exist';
					
		end case;
		
		commit;
END
;;
delimiter ;

SET FOREIGN_KEY_CHECKS = 1;
