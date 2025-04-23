/*
 Navicat Premium Data Transfer

 Source Server         : Milaravel11api
 Source Server Type    : MySQL
 Source Server Version : 80404
 Source Host           : 192.168.1.200:3384
 Source Schema         : milaravel11api_db

 Target Server Type    : MySQL
 Target Server Version : 80404
 File Encoding         : 65001

 Date: 04/04/2025 16:07:13
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for cms_post_category
-- ----------------------------
DROP TABLE IF EXISTS `cms_post_category`;
CREATE TABLE `cms_post_category`  (
  `category_id` smallint NOT NULL AUTO_INCREMENT,
  `category_name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'auto generated using category_name',
  `parent_category_id` smallint NULL DEFAULT NULL COMMENT 'NULL for Top Level Categories',
  `category_image` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `remarks` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `show_order` smallint NOT NULL,
  `publish` tinyint(1) NOT NULL DEFAULT 2 COMMENT '1:Yes; 2:No',
  `reserved` tinyint(1) NOT NULL DEFAULT 2 COMMENT '1:Yes; 2:No',
  `created_at` timestamp NOT NULL,
  `created_by` bigint NOT NULL DEFAULT 1 COMMENT '1:System',
  `updated_at` timestamp NULL DEFAULT NULL,
  `updated_by` bigint NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `deleted_by` bigint NULL DEFAULT NULL,
  PRIMARY KEY (`category_id`) USING BTREE,
  UNIQUE INDEX `unique_post_category_slug`(`slug` ASC) USING BTREE,
  UNIQUE INDEX `unique_post_category`(`parent_category_id` ASC, `category_name` ASC) USING BTREE,
  INDEX `parent_category_id`(`parent_category_id` ASC) USING BTREE,
  CONSTRAINT `cms_post_category_ibfk_1` FOREIGN KEY (`parent_category_id`) REFERENCES `cms_post_category` (`category_id`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 27 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of cms_post_category
-- ----------------------------
INSERT INTO `cms_post_category` VALUES (1, 'sujan', 'sujan', NULL, '1736229571_677cc2c3c6067.jpg', NULL, 1, 1, 1, '2025-01-06 09:57:09', 1, '2025-01-17 16:52:11', 8, '2025-01-17 16:52:11', NULL);
INSERT INTO `cms_post_category` VALUES (2, 'jamuna', 'jamuna', NULL, NULL, NULL, 2, 2, 1, '2025-01-06 09:35:32', 1, '2025-01-06 12:46:47', NULL, '2025-01-06 12:46:47', NULL);
INSERT INTO `cms_post_category` VALUES (3, 'miracle', 'miracle', 1, '1736166973_677bce3d27bf8.jpg', NULL, 3, 1, 1, '2025-01-06 12:28:28', 1, '2025-01-06 13:00:23', 1, '2025-01-06 13:00:23', NULL);
INSERT INTO `cms_post_category` VALUES (4, 'rachanaa', 'rachanaa', 11, '1737364355_678e138329a2c.png', 'is good', 2, 1, 2, '2025-01-06 13:01:06', 1, '2025-01-20 14:57:35', 1, NULL, NULL);
INSERT INTO `cms_post_category` VALUES (5, 'rachana', 'rachana', NULL, '1736229619_677cc2f3ef378.jpg', NULL, 3, 1, 1, '2025-01-07 06:00:19', 8, '2025-01-17 16:53:37', 8, '2025-01-17 16:53:37', NULL);
INSERT INTO `cms_post_category` VALUES (6, 'Nisha', 'nisha-test', NULL, NULL, NULL, 4, 1, 2, '2025-01-17 16:14:01', 1, '2025-01-17 16:14:01', NULL, NULL, NULL);
INSERT INTO `cms_post_category` VALUES (7, 'Nishas', 'nisha-tests', NULL, NULL, NULL, 5, 1, 2, '2025-01-17 16:14:36', 1, '2025-01-17 16:14:36', NULL, NULL, NULL);
INSERT INTO `cms_post_category` VALUES (8, 'Nishas2', 'nisha-tests2', NULL, NULL, NULL, 6, 1, 2, '2025-01-17 16:23:26', 1, '2025-01-17 16:23:26', NULL, NULL, NULL);
INSERT INTO `cms_post_category` VALUES (9, 'Travel', 'travel', NULL, 'D:\\wamp64\\tmp\\php11C0.tmp', NULL, 7, 1, 2, '2025-01-17 16:24:04', 1, '2025-01-17 16:24:04', NULL, NULL, NULL);
INSERT INTO `cms_post_category` VALUES (10, 'Sport', 'sport', NULL, 'D:\\wamp64\\tmp\\phpB371.tmp', NULL, 8, 1, 2, '2025-01-17 16:24:45', 1, '2025-01-17 16:24:45', NULL, NULL, NULL);
INSERT INTO `cms_post_category` VALUES (11, 'Food', 'food', NULL, 'D:\\wamp64\\tmp\\php7991.tmp', NULL, 9, 1, 2, '2025-01-17 16:25:36', 1, '2025-01-17 16:25:36', NULL, NULL, NULL);
INSERT INTO `cms_post_category` VALUES (12, 'Outing', 'outing', NULL, 'D:\\wamp64\\tmp\\phpFF6C.tmp', NULL, 10, 1, 2, '2025-01-17 16:26:10', 1, '2025-01-17 16:26:10', NULL, NULL, NULL);
INSERT INTO `cms_post_category` VALUES (13, 'Picnic', 'Picnic', NULL, '1737110496_678a33e011e3c.png', NULL, 11, 1, 2, '2025-01-17 16:26:36', 1, '2025-01-17 16:26:36', NULL, NULL, NULL);
INSERT INTO `cms_post_category` VALUES (14, 'Cricket', 'Cricket', NULL, '1737112194_678a3a824709f.png', NULL, 12, 1, 1, '2025-01-17 16:54:54', 1, '2025-01-17 16:55:05', NULL, '2025-01-17 16:55:05', NULL);
INSERT INTO `cms_post_category` VALUES (15, 'Football', 'Football', NULL, '1737357446_678df886c5393.png', 'This is the text', 12, 1, 2, '2025-01-20 13:02:26', 1, '2025-01-20 13:02:27', NULL, NULL, NULL);
INSERT INTO `cms_post_category` VALUES (16, 'rachanaawS', 'rachanaawS', 11, '1737365104_678e16707ce18.png', 'is good', 13, 1, 2, '2025-01-20 13:04:56', 1, '2025-01-20 15:10:04', 1, NULL, NULL);
INSERT INTO `cms_post_category` VALUES (17, 'Lash', 'laksh', NULL, '1737357725_678df99d25435.png', 'This is the text', 14, 1, 2, '2025-01-20 13:07:05', 1, '2025-01-20 13:07:05', NULL, NULL, NULL);
INSERT INTO `cms_post_category` VALUES (18, 'what', 'what', NULL, '1737357758_678df9bedf25b.png', 'This is the text', 15, 1, 2, '2025-01-20 13:07:38', 1, '2025-01-20 13:07:39', NULL, NULL, NULL);
INSERT INTO `cms_post_category` VALUES (19, 'whats', 'whats', NULL, '1737357792_678df9e042ae6.png', 'This is the text', 16, 1, 2, '2025-01-20 13:08:12', 1, '2025-01-20 13:08:12', NULL, NULL, NULL);
INSERT INTO `cms_post_category` VALUES (20, 'whatsss', 'whatsss', NULL, '1737363164_678e0edc8e9a4.png', 'This is the text', 17, 1, 2, '2025-01-20 14:37:44', 1, '2025-01-20 14:37:44', NULL, NULL, NULL);
INSERT INTO `cms_post_category` VALUES (21, 'rachanaawsssss', 'rachanaaw', NULL, '1738567367_67a06ec796399.png', 'is good', 18, 1, 2, '2025-01-20 14:42:02', 1, '2025-02-03 13:07:48', 1, NULL, NULL);
INSERT INTO `cms_post_category` VALUES (22, 'Climbing', 'Climbing', NULL, '1737363446_678e0ff636217.png', 'This is the text', 19, 1, 1, '2025-01-20 14:42:26', 1, '2025-01-20 14:43:14', NULL, '2025-01-20 14:43:14', NULL);
INSERT INTO `cms_post_category` VALUES (23, 'Climbings', 'Climbings', 21, '1737365240_678e16f8a543c.png', 'This is the text', 19, 1, 1, '2025-01-20 15:12:20', 1, '2025-01-20 15:12:20', NULL, NULL, NULL);
INSERT INTO `cms_post_category` VALUES (24, 'HelloS', 'HiS', NULL, '1737608837_6791ce85bf135.png', 'This is the text', 20, 1, 1, '2025-01-23 10:52:17', 1, '2025-01-23 10:52:18', NULL, NULL, NULL);
INSERT INTO `cms_post_category` VALUES (25, '', '', NULL, NULL, NULL, 21, 0, 0, '2025-02-03 12:55:21', 1, '2025-02-03 12:55:21', NULL, NULL, NULL);
INSERT INTO `cms_post_category` VALUES (26, 'rachanaawsss', 'rachanaawsss', 11, '1738567124_67a06dd43b2ff.png', 'is good', 22, 1, 2, '2025-02-03 13:03:44', 1, '2025-02-03 13:03:44', NULL, NULL, NULL);
INSERT INTO `cms_post_category` VALUES (27, 'rachanaawssssss', 'rachanaawssssss', 11, '1738567141_67a06de5b2d2b.png', 'is good', 23, 1, 2, '2025-02-03 13:04:01', 1, '2025-02-03 13:04:02', NULL, NULL, NULL);

SET FOREIGN_KEY_CHECKS = 1;
