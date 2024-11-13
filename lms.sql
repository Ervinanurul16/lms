/*
 Navicat Premium Data Transfer

 Source Server         : Localhost
 Source Server Type    : MySQL
 Source Server Version : 80030
 Source Host           : localhost:3306
 Source Schema         : lms

 Target Server Type    : MySQL
 Target Server Version : 80030
 File Encoding         : 65001

 Date: 22/10/2024 16:18:11
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for announcements
-- ----------------------------
DROP TABLE IF EXISTS `announcements`;
CREATE TABLE `announcements`  (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` int UNSIGNED NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `excerpt` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` date NULL DEFAULT NULL,
  `start_time` time NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `announcements_user_id_foreign`(`user_id`) USING BTREE,
  CONSTRAINT `announcements_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of announcements
-- ----------------------------
INSERT INTO `announcements` VALUES (1, 1, 'Afadsfadsfads', '<p>asdfsdfasdfasdfasdf</p>', '<p>asdfsdfasdfasdfasdf</p>', '2024-10-07', '13:49:00', '2024-10-06 13:49:41', '2024-10-06 13:49:41');

-- ----------------------------
-- Table structure for answer_choices
-- ----------------------------
DROP TABLE IF EXISTS `answer_choices`;
CREATE TABLE `answer_choices`  (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `label` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `text` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `question_id` int UNSIGNED NOT NULL,
  `is_answer` tinyint NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `answer_choices_question_id_foreign`(`question_id`) USING BTREE,
  CONSTRAINT `answer_choices_question_id_foreign` FOREIGN KEY (`question_id`) REFERENCES `questions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 71 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of answer_choices
-- ----------------------------
INSERT INTO `answer_choices` VALUES (17, 'A', '2', 14, 1, '2024-10-06 10:10:15', '2024-10-06 10:10:15');
INSERT INTO `answer_choices` VALUES (18, 'B', '3', 14, 0, '2024-10-06 10:10:15', '2024-10-06 10:10:15');
INSERT INTO `answer_choices` VALUES (19, 'C', '4', 14, 0, '2024-10-06 10:10:15', '2024-10-06 10:10:15');
INSERT INTO `answer_choices` VALUES (20, 'D', '5', 14, 0, '2024-10-06 10:10:15', '2024-10-06 10:10:15');
INSERT INTO `answer_choices` VALUES (21, 'A', '2', 15, 1, '2024-10-06 10:11:30', '2024-10-06 10:11:30');
INSERT INTO `answer_choices` VALUES (22, 'B', '3', 15, 0, '2024-10-06 10:11:30', '2024-10-06 10:11:30');
INSERT INTO `answer_choices` VALUES (23, 'C', '4', 15, 0, '2024-10-06 10:11:30', '2024-10-06 10:11:30');
INSERT INTO `answer_choices` VALUES (24, 'D', '5', 15, 0, '2024-10-06 10:11:30', '2024-10-06 10:11:30');
INSERT INTO `answer_choices` VALUES (25, 'A', '1', 16, 1, '2024-10-06 10:12:15', '2024-10-06 10:12:15');
INSERT INTO `answer_choices` VALUES (26, 'B', '3', 16, 0, '2024-10-06 10:12:15', '2024-10-06 10:12:15');
INSERT INTO `answer_choices` VALUES (27, 'C', '2', 16, 0, '2024-10-06 10:12:15', '2024-10-06 10:12:15');
INSERT INTO `answer_choices` VALUES (28, 'D', '4', 16, 0, '2024-10-06 10:12:15', '2024-10-06 10:12:15');
INSERT INTO `answer_choices` VALUES (29, 'A', '3', 17, 0, '2024-10-06 10:12:47', '2024-10-06 10:12:47');
INSERT INTO `answer_choices` VALUES (30, 'B', '5', 17, 0, '2024-10-06 10:12:47', '2024-10-06 10:12:47');
INSERT INTO `answer_choices` VALUES (31, 'C', '6', 17, 0, '2024-10-06 10:12:47', '2024-10-06 10:12:47');
INSERT INTO `answer_choices` VALUES (32, 'D', '4', 17, 1, '2024-10-06 10:12:47', '2024-10-06 10:12:47');
INSERT INTO `answer_choices` VALUES (33, 'A', '5', 18, 0, '2024-10-06 10:13:17', '2024-10-06 10:13:17');
INSERT INTO `answer_choices` VALUES (34, 'B', '6', 18, 1, '2024-10-06 10:13:17', '2024-10-06 10:13:17');
INSERT INTO `answer_choices` VALUES (35, 'C', '7', 18, 0, '2024-10-06 10:13:17', '2024-10-06 10:13:17');
INSERT INTO `answer_choices` VALUES (36, 'D', '8', 18, 0, '2024-10-06 10:13:17', '2024-10-06 10:13:17');
INSERT INTO `answer_choices` VALUES (37, 'A', '1', 19, 0, '2024-10-06 10:13:43', '2024-10-06 10:13:43');
INSERT INTO `answer_choices` VALUES (38, 'B', '2', 19, 0, '2024-10-06 10:13:43', '2024-10-06 10:13:43');
INSERT INTO `answer_choices` VALUES (39, 'C', '0', 19, 1, '2024-10-06 10:13:43', '2024-10-06 10:13:43');
INSERT INTO `answer_choices` VALUES (40, 'D', '3', 19, 0, '2024-10-06 10:13:43', '2024-10-06 10:13:43');
INSERT INTO `answer_choices` VALUES (41, 'A', '1', 20, 1, '2024-10-06 10:14:08', '2024-10-06 10:14:08');
INSERT INTO `answer_choices` VALUES (42, 'B', '2', 20, 0, '2024-10-06 10:14:08', '2024-10-06 10:14:08');
INSERT INTO `answer_choices` VALUES (43, 'C', '3', 20, 0, '2024-10-06 10:14:08', '2024-10-06 10:14:08');
INSERT INTO `answer_choices` VALUES (44, 'D', '4', 20, 0, '2024-10-06 10:14:08', '2024-10-06 10:14:08');
INSERT INTO `answer_choices` VALUES (45, 'A', '1', 21, 1, '2024-10-06 10:14:29', '2024-10-06 10:14:29');
INSERT INTO `answer_choices` VALUES (46, 'B', '2', 21, 0, '2024-10-06 10:14:29', '2024-10-06 10:14:29');
INSERT INTO `answer_choices` VALUES (47, 'C', '3', 21, 0, '2024-10-06 10:14:29', '2024-10-06 10:14:29');
INSERT INTO `answer_choices` VALUES (48, 'D', '4', 21, 0, '2024-10-06 10:14:29', '2024-10-06 10:14:29');
INSERT INTO `answer_choices` VALUES (49, 'A', '23234', 22, 0, '2024-10-06 10:16:16', '2024-10-06 10:16:16');
INSERT INTO `answer_choices` VALUES (50, 'B', '453', 22, 0, '2024-10-06 10:16:16', '2024-10-06 10:16:16');
INSERT INTO `answer_choices` VALUES (51, 'C', '54334', 22, 0, '2024-10-06 10:16:16', '2024-10-06 10:16:16');
INSERT INTO `answer_choices` VALUES (52, 'D', '111750', 22, 1, '2024-10-06 10:16:16', '2024-10-06 10:16:16');
INSERT INTO `answer_choices` VALUES (53, 'A', '1', 23, 1, '2024-10-06 10:16:47', '2024-10-06 10:16:47');
INSERT INTO `answer_choices` VALUES (54, 'B', '1', 23, 0, '2024-10-06 10:16:47', '2024-10-06 10:16:47');
INSERT INTO `answer_choices` VALUES (55, 'C', '1', 23, 0, '2024-10-06 10:16:47', '2024-10-06 10:16:47');
INSERT INTO `answer_choices` VALUES (56, 'D', '1', 23, 0, '2024-10-06 10:16:47', '2024-10-06 10:16:47');
INSERT INTO `answer_choices` VALUES (57, 'A', 'sdfa', 24, 0, '2024-10-06 13:21:15', '2024-10-06 13:21:15');
INSERT INTO `answer_choices` VALUES (58, 'B', 'sdfa', 24, 1, '2024-10-06 13:21:15', '2024-10-06 13:21:15');
INSERT INTO `answer_choices` VALUES (59, 'C', 'sdafa', 24, 0, '2024-10-06 13:21:15', '2024-10-06 13:21:15');
INSERT INTO `answer_choices` VALUES (60, 'D', 'fdgs', 24, 0, '2024-10-06 13:21:15', '2024-10-06 13:21:15');
INSERT INTO `answer_choices` VALUES (62, 'A', 'ghgvjhg', 45, 0, '2024-10-20 01:06:24', '2024-10-20 01:06:24');
INSERT INTO `answer_choices` VALUES (63, 'B', 'kgfy', 45, 0, '2024-10-20 01:06:24', '2024-10-20 01:06:24');
INSERT INTO `answer_choices` VALUES (64, 'C', 'jkhh', 45, 1, '2024-10-20 01:06:24', '2024-10-20 01:06:24');
INSERT INTO `answer_choices` VALUES (65, 'D', 'hj', 45, 0, '2024-10-20 01:06:24', '2024-10-20 01:06:24');
INSERT INTO `answer_choices` VALUES (66, 'E', 'jh', 45, 0, '2024-10-20 01:06:24', '2024-10-20 01:06:24');
INSERT INTO `answer_choices` VALUES (67, 'A', 'd', 46, 0, '2024-10-20 01:07:58', '2024-10-20 01:07:58');
INSERT INTO `answer_choices` VALUES (68, 'B', 'd', 46, 0, '2024-10-20 01:07:58', '2024-10-20 01:07:58');
INSERT INTO `answer_choices` VALUES (69, 'C', 'd', 46, 0, '2024-10-20 01:07:58', '2024-10-20 01:07:58');
INSERT INTO `answer_choices` VALUES (70, 'D', 'd', 46, 0, '2024-10-20 01:07:58', '2024-10-20 01:07:58');
INSERT INTO `answer_choices` VALUES (71, 'E', 'd', 46, 0, '2024-10-20 01:07:58', '2024-10-20 01:07:58');

-- ----------------------------
-- Table structure for basic_competencies
-- ----------------------------
DROP TABLE IF EXISTS `basic_competencies`;
CREATE TABLE `basic_competencies`  (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `subject_id` tinyint UNSIGNED NOT NULL,
  `grade_level` tinyint NOT NULL,
  `competency` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `basic_competencies_subject_id_foreign`(`subject_id`) USING BTREE,
  CONSTRAINT `basic_competencies_subject_id_foreign` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of basic_competencies
-- ----------------------------
INSERT INTO `basic_competencies` VALUES (6, 2, 7, 'asfadsfdas', '2024-10-05 10:53:01', '2024-10-05 10:53:01');
INSERT INTO `basic_competencies` VALUES (7, 1, 7, 'asdfadsfadsf', '2024-10-06 00:30:40', '2024-10-06 00:30:40');
INSERT INTO `basic_competencies` VALUES (8, 1, 7, 'afafdasfadsf', '2024-10-06 00:30:50', '2024-10-06 00:30:50');
INSERT INTO `basic_competencies` VALUES (9, 1, 7, 'adfadsf', '2024-10-06 13:03:37', '2024-10-06 13:03:37');

-- ----------------------------
-- Table structure for basic_competency_topic
-- ----------------------------
DROP TABLE IF EXISTS `basic_competency_topic`;
CREATE TABLE `basic_competency_topic`  (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `basic_competency_id` int UNSIGNED NOT NULL,
  `learning_topic_id` int UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `basic_competency_topic_basic_competency_id_foreign`(`basic_competency_id`) USING BTREE,
  INDEX `basic_competency_topic_learning_topic_id_foreign`(`learning_topic_id`) USING BTREE,
  CONSTRAINT `basic_competency_topic_basic_competency_id_foreign` FOREIGN KEY (`basic_competency_id`) REFERENCES `basic_competencies` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `basic_competency_topic_learning_topic_id_foreign` FOREIGN KEY (`learning_topic_id`) REFERENCES `learning_topics` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of basic_competency_topic
-- ----------------------------
INSERT INTO `basic_competency_topic` VALUES (4, 6, 4, NULL, NULL);
INSERT INTO `basic_competency_topic` VALUES (5, 7, 5, NULL, NULL);
INSERT INTO `basic_competency_topic` VALUES (6, 8, 5, NULL, NULL);
INSERT INTO `basic_competency_topic` VALUES (7, 7, 6, NULL, NULL);
INSERT INTO `basic_competency_topic` VALUES (8, 8, 6, NULL, NULL);
INSERT INTO `basic_competency_topic` VALUES (9, 9, 7, NULL, NULL);
INSERT INTO `basic_competency_topic` VALUES (10, 7, 8, NULL, NULL);
INSERT INTO `basic_competency_topic` VALUES (11, 8, 8, NULL, NULL);

-- ----------------------------
-- Table structure for exam_grade
-- ----------------------------
DROP TABLE IF EXISTS `exam_grade`;
CREATE TABLE `exam_grade`  (
  `exam_id` int UNSIGNED NOT NULL,
  `grade_id` tinyint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  INDEX `exam_grade_exam_id_foreign`(`exam_id`) USING BTREE,
  INDEX `exam_grade_grade_id_foreign`(`grade_id`) USING BTREE,
  CONSTRAINT `exam_grade_exam_id_foreign` FOREIGN KEY (`exam_id`) REFERENCES `exams` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `exam_grade_grade_id_foreign` FOREIGN KEY (`grade_id`) REFERENCES `grades` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of exam_grade
-- ----------------------------
INSERT INTO `exam_grade` VALUES (3, 25, NULL, NULL);
INSERT INTO `exam_grade` VALUES (4, 25, NULL, NULL);
INSERT INTO `exam_grade` VALUES (7, 25, NULL, NULL);

-- ----------------------------
-- Table structure for exam_question
-- ----------------------------
DROP TABLE IF EXISTS `exam_question`;
CREATE TABLE `exam_question`  (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `question_id` int UNSIGNED NOT NULL,
  `exam_id` int UNSIGNED NOT NULL,
  `number` tinyint NOT NULL,
  `basic_competency_id` int UNSIGNED NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `exam_question_question_id_foreign`(`question_id`) USING BTREE,
  INDEX `exam_question_exam_id_foreign`(`exam_id`) USING BTREE,
  INDEX `exam_question_basic_competency_id_foreign`(`basic_competency_id`) USING BTREE,
  CONSTRAINT `exam_question_basic_competency_id_foreign` FOREIGN KEY (`basic_competency_id`) REFERENCES `basic_competencies` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE,
  CONSTRAINT `exam_question_exam_id_foreign` FOREIGN KEY (`exam_id`) REFERENCES `exams` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `exam_question_question_id_foreign` FOREIGN KEY (`question_id`) REFERENCES `questions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 47 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of exam_question
-- ----------------------------
INSERT INTO `exam_question` VALUES (15, 14, 3, 1, NULL, NULL, NULL);
INSERT INTO `exam_question` VALUES (16, 15, 3, 2, NULL, NULL, NULL);
INSERT INTO `exam_question` VALUES (17, 16, 3, 3, NULL, NULL, NULL);
INSERT INTO `exam_question` VALUES (18, 17, 3, 4, NULL, NULL, NULL);
INSERT INTO `exam_question` VALUES (19, 18, 3, 5, NULL, NULL, NULL);
INSERT INTO `exam_question` VALUES (20, 19, 3, 6, NULL, NULL, NULL);
INSERT INTO `exam_question` VALUES (21, 20, 3, 7, NULL, NULL, NULL);
INSERT INTO `exam_question` VALUES (22, 21, 3, 8, NULL, NULL, NULL);
INSERT INTO `exam_question` VALUES (23, 22, 3, 9, NULL, NULL, NULL);
INSERT INTO `exam_question` VALUES (24, 23, 3, 10, NULL, NULL, NULL);
INSERT INTO `exam_question` VALUES (25, 14, 4, 1, NULL, NULL, NULL);
INSERT INTO `exam_question` VALUES (26, 15, 4, 2, NULL, NULL, NULL);
INSERT INTO `exam_question` VALUES (27, 16, 4, 3, NULL, NULL, NULL);
INSERT INTO `exam_question` VALUES (28, 17, 4, 4, NULL, NULL, NULL);
INSERT INTO `exam_question` VALUES (29, 18, 4, 5, NULL, NULL, NULL);
INSERT INTO `exam_question` VALUES (30, 19, 4, 6, NULL, NULL, NULL);
INSERT INTO `exam_question` VALUES (31, 20, 4, 7, NULL, NULL, NULL);
INSERT INTO `exam_question` VALUES (32, 21, 4, 8, NULL, NULL, NULL);
INSERT INTO `exam_question` VALUES (33, 22, 4, 9, NULL, NULL, NULL);
INSERT INTO `exam_question` VALUES (34, 23, 4, 10, NULL, NULL, NULL);
INSERT INTO `exam_question` VALUES (36, 14, 7, 1, NULL, NULL, NULL);
INSERT INTO `exam_question` VALUES (37, 15, 7, 2, NULL, NULL, NULL);
INSERT INTO `exam_question` VALUES (38, 16, 7, 3, NULL, NULL, NULL);
INSERT INTO `exam_question` VALUES (39, 17, 7, 4, NULL, NULL, NULL);
INSERT INTO `exam_question` VALUES (40, 18, 7, 5, NULL, NULL, NULL);
INSERT INTO `exam_question` VALUES (41, 19, 7, 6, NULL, NULL, NULL);
INSERT INTO `exam_question` VALUES (42, 20, 7, 7, NULL, NULL, NULL);
INSERT INTO `exam_question` VALUES (43, 21, 7, 8, NULL, NULL, NULL);
INSERT INTO `exam_question` VALUES (44, 22, 7, 9, NULL, NULL, NULL);
INSERT INTO `exam_question` VALUES (45, 23, 7, 10, NULL, NULL, NULL);
INSERT INTO `exam_question` VALUES (46, 45, 4, 11, NULL, NULL, NULL);
INSERT INTO `exam_question` VALUES (47, 46, 7, 11, NULL, NULL, NULL);

-- ----------------------------
-- Table structure for exam_responses
-- ----------------------------
DROP TABLE IF EXISTS `exam_responses`;
CREATE TABLE `exam_responses`  (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `answer` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `user_id` int UNSIGNED NOT NULL,
  `question_id` int UNSIGNED NOT NULL,
  `basic_competency_id` int UNSIGNED NULL DEFAULT NULL,
  `answer_choice_id` int UNSIGNED NULL DEFAULT NULL,
  `exam_id` int UNSIGNED NOT NULL,
  `exam_result_id` int UNSIGNED NOT NULL,
  `status` tinyint NOT NULL DEFAULT 0,
  `score` tinyint NOT NULL DEFAULT 0,
  `feedback` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `exam_responses_user_id_foreign`(`user_id`) USING BTREE,
  INDEX `exam_responses_question_id_foreign`(`question_id`) USING BTREE,
  INDEX `exam_responses_answer_choice_id_foreign`(`answer_choice_id`) USING BTREE,
  INDEX `exam_responses_exam_id_foreign`(`exam_id`) USING BTREE,
  INDEX `exam_responses_exam_result_id_foreign`(`exam_result_id`) USING BTREE,
  INDEX `exam_responses_basic_competency_id_foreign`(`basic_competency_id`) USING BTREE,
  CONSTRAINT `exam_responses_answer_choice_id_foreign` FOREIGN KEY (`answer_choice_id`) REFERENCES `answer_choices` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `exam_responses_basic_competency_id_foreign` FOREIGN KEY (`basic_competency_id`) REFERENCES `basic_competencies` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE,
  CONSTRAINT `exam_responses_exam_id_foreign` FOREIGN KEY (`exam_id`) REFERENCES `exams` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `exam_responses_exam_result_id_foreign` FOREIGN KEY (`exam_result_id`) REFERENCES `exam_results` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `exam_responses_question_id_foreign` FOREIGN KEY (`question_id`) REFERENCES `questions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `exam_responses_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of exam_responses
-- ----------------------------
INSERT INTO `exam_responses` VALUES (2, NULL, 4, 14, NULL, 17, 3, 2, 1, 1, NULL, '2024-10-06 10:21:48', '2024-10-06 10:21:48');
INSERT INTO `exam_responses` VALUES (3, NULL, 4, 15, NULL, 21, 3, 2, 1, 1, NULL, '2024-10-06 10:21:54', '2024-10-06 10:21:54');
INSERT INTO `exam_responses` VALUES (4, NULL, 4, 16, NULL, 27, 3, 2, 0, 0, NULL, '2024-10-06 10:21:58', '2024-10-06 10:21:58');
INSERT INTO `exam_responses` VALUES (5, NULL, 4, 17, NULL, 30, 3, 2, 0, 0, NULL, '2024-10-06 10:22:01', '2024-10-06 10:22:01');
INSERT INTO `exam_responses` VALUES (6, NULL, 4, 18, NULL, 36, 3, 2, 0, 0, NULL, '2024-10-06 10:22:03', '2024-10-06 10:22:03');
INSERT INTO `exam_responses` VALUES (7, NULL, 4, 19, NULL, 38, 3, 2, 0, 0, NULL, '2024-10-06 10:22:10', '2024-10-06 10:22:10');
INSERT INTO `exam_responses` VALUES (8, NULL, 4, 20, NULL, 41, 3, 2, 1, 1, NULL, '2024-10-06 10:22:13', '2024-10-06 10:22:13');
INSERT INTO `exam_responses` VALUES (9, NULL, 4, 21, NULL, 48, 3, 2, 0, 0, NULL, '2024-10-06 10:22:18', '2024-10-06 10:22:18');
INSERT INTO `exam_responses` VALUES (10, NULL, 4, 22, NULL, 52, 3, 2, 1, 1, NULL, '2024-10-06 10:22:20', '2024-10-06 10:22:20');
INSERT INTO `exam_responses` VALUES (11, NULL, 4, 23, NULL, 55, 3, 2, 0, 0, NULL, '2024-10-06 10:22:24', '2024-10-06 10:22:24');
INSERT INTO `exam_responses` VALUES (12, NULL, 7, 14, NULL, 18, 3, 3, 0, 0, NULL, '2024-10-06 10:12:01', '2024-10-06 10:12:01');
INSERT INTO `exam_responses` VALUES (13, NULL, 7, 15, NULL, 22, 3, 3, 0, 0, NULL, '2024-10-06 10:12:16', '2024-10-06 10:12:16');
INSERT INTO `exam_responses` VALUES (14, NULL, 7, 16, NULL, 27, 3, 3, 0, 0, NULL, '2024-10-06 10:12:18', '2024-10-06 10:12:18');
INSERT INTO `exam_responses` VALUES (15, NULL, 7, 17, NULL, 31, 3, 3, 0, 0, NULL, '2024-10-06 10:12:20', '2024-10-06 10:12:20');
INSERT INTO `exam_responses` VALUES (16, NULL, 7, 18, NULL, 36, 3, 3, 0, 0, NULL, '2024-10-06 10:12:22', '2024-10-06 10:12:22');
INSERT INTO `exam_responses` VALUES (17, NULL, 7, 19, NULL, 37, 3, 3, 0, 0, NULL, '2024-10-06 10:12:26', '2024-10-06 10:12:26');
INSERT INTO `exam_responses` VALUES (18, NULL, 7, 20, NULL, 44, 3, 3, 0, 0, NULL, '2024-10-06 10:12:28', '2024-10-06 10:12:28');
INSERT INTO `exam_responses` VALUES (19, NULL, 7, 21, NULL, 45, 3, 3, 1, 1, NULL, '2024-10-06 10:12:30', '2024-10-06 10:12:30');
INSERT INTO `exam_responses` VALUES (20, NULL, 7, 22, NULL, 52, 3, 3, 1, 1, NULL, '2024-10-06 10:12:33', '2024-10-06 10:12:33');
INSERT INTO `exam_responses` VALUES (21, NULL, 7, 23, NULL, 53, 3, 3, 1, 1, NULL, '2024-10-06 10:12:36', '2024-10-06 10:12:36');
INSERT INTO `exam_responses` VALUES (22, NULL, 12, 14, NULL, 17, 3, 4, 1, 1, NULL, '2024-10-06 10:13:16', '2024-10-06 10:13:16');
INSERT INTO `exam_responses` VALUES (23, NULL, 12, 15, NULL, 23, 3, 4, 0, 0, NULL, '2024-10-06 10:13:19', '2024-10-06 10:13:19');
INSERT INTO `exam_responses` VALUES (24, NULL, 12, 16, NULL, 28, 3, 4, 0, 0, NULL, '2024-10-06 10:13:22', '2024-10-06 10:13:22');
INSERT INTO `exam_responses` VALUES (25, NULL, 12, 17, NULL, 31, 3, 4, 0, 0, NULL, '2024-10-06 10:13:24', '2024-10-06 10:13:24');
INSERT INTO `exam_responses` VALUES (26, NULL, 12, 18, NULL, 34, 3, 4, 1, 1, NULL, '2024-10-06 10:13:26', '2024-10-06 10:13:26');
INSERT INTO `exam_responses` VALUES (27, NULL, 12, 19, NULL, 39, 3, 4, 1, 1, NULL, '2024-10-06 10:13:28', '2024-10-06 10:13:28');
INSERT INTO `exam_responses` VALUES (28, NULL, 12, 20, NULL, 41, 3, 4, 1, 1, NULL, '2024-10-06 10:13:30', '2024-10-06 10:13:30');
INSERT INTO `exam_responses` VALUES (29, NULL, 12, 21, NULL, 48, 3, 4, 0, 0, NULL, '2024-10-06 10:13:33', '2024-10-06 10:13:33');
INSERT INTO `exam_responses` VALUES (30, NULL, 12, 22, NULL, 50, 3, 4, 0, 0, NULL, '2024-10-06 10:13:37', '2024-10-06 10:13:37');
INSERT INTO `exam_responses` VALUES (31, NULL, 12, 23, NULL, 56, 3, 4, 0, 0, NULL, '2024-10-06 10:13:40', '2024-10-06 10:13:40');
INSERT INTO `exam_responses` VALUES (32, NULL, 11, 14, NULL, 17, 3, 5, 1, 1, NULL, '2024-10-06 10:14:06', '2024-10-06 10:14:06');
INSERT INTO `exam_responses` VALUES (33, NULL, 11, 15, NULL, 24, 3, 5, 0, 0, NULL, '2024-10-06 10:14:09', '2024-10-06 10:14:09');
INSERT INTO `exam_responses` VALUES (34, NULL, 11, 16, NULL, 26, 3, 5, 0, 0, NULL, '2024-10-06 10:14:11', '2024-10-06 10:14:11');
INSERT INTO `exam_responses` VALUES (35, NULL, 11, 17, NULL, 31, 3, 5, 0, 0, NULL, '2024-10-06 10:14:13', '2024-10-06 10:14:13');
INSERT INTO `exam_responses` VALUES (36, NULL, 11, 18, NULL, 36, 3, 5, 0, 0, NULL, '2024-10-06 10:14:29', '2024-10-06 10:14:29');
INSERT INTO `exam_responses` VALUES (37, NULL, 11, 19, NULL, 40, 3, 5, 0, 0, NULL, '2024-10-06 10:14:32', '2024-10-06 10:14:32');
INSERT INTO `exam_responses` VALUES (38, NULL, 11, 20, NULL, 42, 3, 5, 0, 0, NULL, '2024-10-06 10:14:35', '2024-10-06 10:14:35');
INSERT INTO `exam_responses` VALUES (39, NULL, 11, 21, NULL, 47, 3, 5, 0, 0, NULL, '2024-10-06 10:14:38', '2024-10-06 10:14:38');
INSERT INTO `exam_responses` VALUES (40, NULL, 11, 22, NULL, 51, 3, 5, 0, 0, NULL, '2024-10-06 10:14:40', '2024-10-06 10:14:40');
INSERT INTO `exam_responses` VALUES (41, NULL, 11, 23, NULL, 53, 3, 5, 1, 1, NULL, '2024-10-06 10:14:42', '2024-10-06 10:14:42');
INSERT INTO `exam_responses` VALUES (42, NULL, 4, 14, NULL, 17, 4, 6, 1, 1, NULL, '2024-10-06 14:02:51', '2024-10-06 14:02:51');
INSERT INTO `exam_responses` VALUES (43, NULL, 4, 15, NULL, 21, 4, 6, 1, 1, NULL, '2024-10-06 14:02:54', '2024-10-06 14:02:54');
INSERT INTO `exam_responses` VALUES (44, NULL, 4, 16, NULL, 25, 4, 6, 1, 1, NULL, '2024-10-06 14:02:57', '2024-10-06 14:02:57');
INSERT INTO `exam_responses` VALUES (45, NULL, 4, 17, NULL, 32, 4, 6, 1, 1, NULL, '2024-10-06 14:03:02', '2024-10-06 14:03:02');
INSERT INTO `exam_responses` VALUES (46, NULL, 4, 18, NULL, 34, 4, 6, 1, 1, NULL, '2024-10-06 14:03:06', '2024-10-06 14:03:06');
INSERT INTO `exam_responses` VALUES (47, NULL, 4, 19, NULL, 39, 4, 6, 1, 1, NULL, '2024-10-06 14:03:08', '2024-10-06 14:03:08');
INSERT INTO `exam_responses` VALUES (48, NULL, 4, 20, NULL, 41, 4, 6, 1, 1, NULL, '2024-10-06 14:03:12', '2024-10-06 14:03:12');
INSERT INTO `exam_responses` VALUES (49, NULL, 4, 21, NULL, 45, 4, 6, 1, 1, NULL, '2024-10-06 14:03:14', '2024-10-06 14:03:14');
INSERT INTO `exam_responses` VALUES (50, NULL, 4, 22, NULL, 52, 4, 6, 1, 1, NULL, '2024-10-06 14:03:17', '2024-10-06 14:03:17');
INSERT INTO `exam_responses` VALUES (51, NULL, 4, 23, NULL, 53, 4, 6, 1, 1, NULL, '2024-10-06 14:03:21', '2024-10-06 14:03:21');
INSERT INTO `exam_responses` VALUES (52, NULL, 4, 14, NULL, 17, 7, 7, 1, 1, NULL, '2024-10-08 16:23:04', '2024-10-08 16:23:04');
INSERT INTO `exam_responses` VALUES (53, NULL, 4, 15, NULL, 21, 7, 7, 1, 1, NULL, '2024-10-08 16:23:07', '2024-10-08 16:23:07');
INSERT INTO `exam_responses` VALUES (54, NULL, 4, 16, NULL, 25, 7, 7, 1, 1, NULL, '2024-10-08 16:23:10', '2024-10-08 16:23:10');
INSERT INTO `exam_responses` VALUES (55, NULL, 4, 17, NULL, 31, 7, 7, 0, 0, NULL, '2024-10-08 16:23:12', '2024-10-08 16:23:12');
INSERT INTO `exam_responses` VALUES (56, NULL, 4, 18, NULL, 34, 7, 7, 1, 1, NULL, '2024-10-08 16:23:15', '2024-10-08 16:23:15');
INSERT INTO `exam_responses` VALUES (57, NULL, 4, 19, NULL, 40, 7, 7, 0, 0, NULL, '2024-10-08 16:23:17', '2024-10-08 16:23:17');
INSERT INTO `exam_responses` VALUES (58, NULL, 4, 20, NULL, 41, 7, 7, 1, 1, NULL, '2024-10-08 16:23:20', '2024-10-08 16:23:20');
INSERT INTO `exam_responses` VALUES (59, NULL, 4, 21, NULL, 45, 7, 7, 1, 1, NULL, '2024-10-08 16:23:23', '2024-10-08 16:23:23');
INSERT INTO `exam_responses` VALUES (60, NULL, 4, 22, NULL, 52, 7, 7, 1, 1, NULL, '2024-10-08 16:23:26', '2024-10-08 16:23:26');
INSERT INTO `exam_responses` VALUES (61, NULL, 4, 23, NULL, 53, 7, 7, 1, 1, NULL, '2024-10-08 16:23:29', '2024-10-08 16:23:29');
INSERT INTO `exam_responses` VALUES (62, NULL, 12, 14, NULL, 17, 7, 8, 1, 1, NULL, '2024-10-08 16:24:24', '2024-10-08 16:24:24');
INSERT INTO `exam_responses` VALUES (63, NULL, 12, 15, NULL, 21, 7, 8, 1, 1, NULL, '2024-10-08 16:24:26', '2024-10-08 16:24:26');
INSERT INTO `exam_responses` VALUES (64, NULL, 12, 16, NULL, 25, 7, 8, 1, 1, NULL, '2024-10-08 16:24:28', '2024-10-08 16:24:28');
INSERT INTO `exam_responses` VALUES (65, NULL, 12, 17, NULL, 31, 7, 8, 0, 0, NULL, '2024-10-08 16:24:34', '2024-10-08 16:24:34');
INSERT INTO `exam_responses` VALUES (66, NULL, 12, 18, NULL, 33, 7, 8, 0, 0, NULL, '2024-10-08 16:24:36', '2024-10-08 16:24:36');
INSERT INTO `exam_responses` VALUES (67, NULL, 12, 19, NULL, 39, 7, 8, 1, 1, NULL, '2024-10-08 16:24:39', '2024-10-08 16:24:39');
INSERT INTO `exam_responses` VALUES (68, NULL, 12, 20, NULL, 41, 7, 8, 1, 1, NULL, '2024-10-08 16:24:41', '2024-10-08 16:24:41');
INSERT INTO `exam_responses` VALUES (69, NULL, 12, 21, NULL, 45, 7, 8, 1, 1, NULL, '2024-10-08 16:24:44', '2024-10-08 16:24:44');
INSERT INTO `exam_responses` VALUES (70, NULL, 12, 22, NULL, 52, 7, 8, 1, 1, NULL, '2024-10-08 16:24:47', '2024-10-08 16:24:47');
INSERT INTO `exam_responses` VALUES (71, NULL, 12, 23, NULL, 53, 7, 8, 1, 1, NULL, '2024-10-08 16:24:49', '2024-10-08 16:24:49');
INSERT INTO `exam_responses` VALUES (72, NULL, 7, 14, NULL, 17, 7, 9, 1, 1, NULL, '2024-10-08 16:25:33', '2024-10-08 16:25:33');
INSERT INTO `exam_responses` VALUES (73, NULL, 7, 15, NULL, 21, 7, 9, 1, 1, NULL, '2024-10-08 16:25:36', '2024-10-08 16:25:36');
INSERT INTO `exam_responses` VALUES (74, NULL, 7, 16, NULL, 25, 7, 9, 1, 1, NULL, '2024-10-08 16:25:39', '2024-10-08 16:25:39');
INSERT INTO `exam_responses` VALUES (75, NULL, 7, 17, NULL, 29, 7, 9, 0, 0, NULL, '2024-10-08 16:25:41', '2024-10-08 16:25:41');
INSERT INTO `exam_responses` VALUES (76, NULL, 7, 18, NULL, 33, 7, 9, 0, 0, NULL, '2024-10-08 16:25:45', '2024-10-08 16:25:45');
INSERT INTO `exam_responses` VALUES (77, NULL, 7, 19, NULL, 37, 7, 9, 0, 0, NULL, '2024-10-08 16:25:48', '2024-10-08 16:25:48');
INSERT INTO `exam_responses` VALUES (78, NULL, 7, 20, NULL, 41, 7, 9, 1, 1, NULL, '2024-10-08 16:25:50', '2024-10-08 16:25:50');
INSERT INTO `exam_responses` VALUES (79, NULL, 7, 21, NULL, 45, 7, 9, 1, 1, NULL, '2024-10-08 16:25:52', '2024-10-08 16:25:52');
INSERT INTO `exam_responses` VALUES (80, NULL, 7, 22, NULL, 49, 7, 9, 0, 0, NULL, '2024-10-08 16:25:55', '2024-10-08 16:25:55');
INSERT INTO `exam_responses` VALUES (81, NULL, 7, 23, NULL, 53, 7, 9, 1, 1, NULL, '2024-10-08 16:25:57', '2024-10-08 16:25:57');

-- ----------------------------
-- Table structure for exam_results
-- ----------------------------
DROP TABLE IF EXISTS `exam_results`;
CREATE TABLE `exam_results`  (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` int UNSIGNED NOT NULL,
  `exam_id` int UNSIGNED NOT NULL,
  `score` tinyint NOT NULL DEFAULT 0,
  `is_remedial` tinyint NOT NULL DEFAULT 1,
  `remedial_score` tinyint NOT NULL DEFAULT 0,
  `final_score` double(8, 2) NOT NULL DEFAULT 0.00,
  `correction_status` tinyint NOT NULL DEFAULT 0,
  `total_answered_question` tinyint NOT NULL DEFAULT 0,
  `total_correct_answer` tinyint NOT NULL DEFAULT 0,
  `total_wrong_answer` tinyint NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `exam_results_user_id_foreign`(`user_id`) USING BTREE,
  INDEX `exam_results_exam_id_foreign`(`exam_id`) USING BTREE,
  CONSTRAINT `exam_results_exam_id_foreign` FOREIGN KEY (`exam_id`) REFERENCES `exams` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `exam_results_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of exam_results
-- ----------------------------
INSERT INTO `exam_results` VALUES (2, 4, 3, 4, 0, 100, 52.00, 1, 10, 4, 6, '2024-10-06 10:21:34', '2024-10-07 22:44:54');
INSERT INTO `exam_results` VALUES (3, 7, 3, 3, 0, 100, 51.50, 0, 10, 3, 7, '2024-10-06 10:11:55', '2024-10-06 13:28:41');
INSERT INTO `exam_results` VALUES (4, 12, 3, 4, 0, 100, 52.00, 0, 10, 4, 6, '2024-10-06 10:13:12', '2024-10-06 13:28:41');
INSERT INTO `exam_results` VALUES (5, 11, 3, 2, 0, 100, 51.00, 0, 10, 2, 8, '2024-10-06 10:14:02', '2024-10-06 13:28:40');
INSERT INTO `exam_results` VALUES (6, 4, 4, 10, 1, 0, 10.00, 1, 10, 10, 0, '2024-10-06 14:02:14', '2024-10-07 22:45:17');
INSERT INTO `exam_results` VALUES (7, 4, 7, 8, 0, 0, 8.00, 1, 10, 8, 2, '2024-10-08 16:22:57', '2024-10-16 19:22:18');
INSERT INTO `exam_results` VALUES (8, 12, 7, 8, 0, 0, 8.00, 1, 10, 8, 2, '2024-10-08 16:24:17', '2024-10-16 19:22:18');
INSERT INTO `exam_results` VALUES (9, 7, 7, 6, 0, 0, 6.00, 1, 10, 6, 4, '2024-10-08 16:25:29', '2024-10-16 19:22:18');

-- ----------------------------
-- Table structure for exams
-- ----------------------------
DROP TABLE IF EXISTS `exams`;
CREATE TABLE `exams`  (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` int UNSIGNED NOT NULL,
  `subject_id` tinyint UNSIGNED NOT NULL,
  `enroll_code` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint NOT NULL DEFAULT 0,
  `publish_status` tinyint NOT NULL DEFAULT 0,
  `date` date NOT NULL,
  `time_start` time NOT NULL,
  `time_end` time NOT NULL,
  `total_question` tinyint NOT NULL DEFAULT 0,
  `kkm_score` tinyint NOT NULL,
  `max_score` tinyint NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `exams_user_id_foreign`(`user_id`) USING BTREE,
  INDEX `exams_subject_id_foreign`(`subject_id`) USING BTREE,
  CONSTRAINT `exams_subject_id_foreign` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `exams_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 13 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of exams
-- ----------------------------
INSERT INTO `exams` VALUES (3, 3, 1, '6701ff', 'Pretest - pertemuan 1', 1, 1, '2024-10-06', '10:09:00', '12:09:00', 10, 50, 100, '2024-10-06 10:09:39', '2024-10-16 19:35:16');
INSERT INTO `exams` VALUES (4, 3, 1, '670201', 'Posttest - Pertemuan 1', 1, 1, '2024-10-06', '10:18:00', '12:18:00', 11, 50, 100, '2024-10-06 10:18:41', '2024-10-20 01:06:24');
INSERT INTO `exams` VALUES (7, 3, 1, '6704f9', 'umbro', 1, 0, '2024-10-08', '16:21:00', '18:21:00', 11, 5, 10, '2024-10-08 16:21:17', '2024-10-20 01:07:58');

-- ----------------------------
-- Table structure for failed_jobs
-- ----------------------------
DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE `failed_jobs`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of failed_jobs
-- ----------------------------

-- ----------------------------
-- Table structure for grades
-- ----------------------------
DROP TABLE IF EXISTS `grades`;
CREATE TABLE `grades`  (
  `id` tinyint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `grade_level` tinyint NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of grades
-- ----------------------------
INSERT INTO `grades` VALUES (25, 'VIIZ', 7, NULL, NULL);
INSERT INTO `grades` VALUES (26, 'VIIX', 7, '2024-10-05 20:52:02', '2024-10-05 20:52:02');

-- ----------------------------
-- Table structure for jobs
-- ----------------------------
DROP TABLE IF EXISTS `jobs`;
CREATE TABLE `jobs`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `queue` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED NULL DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `jobs_queue_index`(`queue`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of jobs
-- ----------------------------

-- ----------------------------
-- Table structure for learning_materials
-- ----------------------------
DROP TABLE IF EXISTS `learning_materials`;
CREATE TABLE `learning_materials`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_path` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `content` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `learning_topic_id` int UNSIGNED NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `learning_materials_learning_topic_id_foreign`(`learning_topic_id`) USING BTREE,
  CONSTRAINT `learning_materials_learning_topic_id_foreign` FOREIGN KEY (`learning_topic_id`) REFERENCES `learning_topics` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of learning_materials
-- ----------------------------
INSERT INTO `learning_materials` VALUES (2, 'pendidikan', 'uploads/materials/[Template] Laporan Akhir_[Magang_Studi Independed]_[Nama]_[NIM]_[Judul Kegiatan] (2)-6700b835aaf66.docx', '<p>ffsgsfdgsfdgsdfgsg</p>', 4, '2024-10-05 10:53:25', '2024-10-05 10:53:25');
INSERT INTO `learning_materials` VALUES (3, 'Rukun Iman', 'uploads/materials/[Template] Laporan Akhir_[Magang_Studi Independed]_[Nama]_[NIM]_[Judul Kegiatan] (1)-6701780d3aeda.docx', '<p>qdfioaifuhasdfadsfadsfas</p>\r\n<p>asd</p>\r\n<p>fas</p>\r\n<p>df</p>\r\n<p>asdf</p>\r\n<p>ads</p>\r\n<p>fa</p>\r\n<p>sdf</p>\r\n<p>ads</p>\r\n<p>fads</p>\r\n<p>f</p>\r\n<p>adsf</p>\r\n<p>a</p>', 5, '2024-10-06 00:31:57', '2024-10-06 00:31:57');
INSERT INTO `learning_materials` VALUES (4, 'Rukun islam', 'uploads/materials/[Template] Laporan Akhir_[Magang_Studi Independed]_[Nama]_[NIM]_[Judul Kegiatan] (1)-670178b2aef6e.docx', '<p>asdfadsfadsfasd</p>\r\n<p>f</p>\r\n<p>ads</p>\r\n<p>fasd</p>\r\n<p>f</p>\r\n<p>asd</p>\r\n<p>fa</p>', 6, '2024-10-06 00:34:42', '2024-10-06 00:34:42');
INSERT INTO `learning_materials` VALUES (5, 'dfagasdfasdf', 'uploads/materials/[Template] Laporan Akhir_[Magang_Studi Independed]_[Nama]_[NIM]_[Judul Kegiatan] (1)-670228bcc484e.docx', '<p>sdfasdfadsfasdf</p>', 7, '2024-10-06 13:05:49', '2024-10-06 13:05:49');

-- ----------------------------
-- Table structure for learning_topic_grade
-- ----------------------------
DROP TABLE IF EXISTS `learning_topic_grade`;
CREATE TABLE `learning_topic_grade`  (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `grade_id` tinyint UNSIGNED NOT NULL,
  `learning_topic_id` int UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `learning_topic_grade_grade_id_foreign`(`grade_id`) USING BTREE,
  INDEX `learning_topic_grade_learning_topic_id_foreign`(`learning_topic_id`) USING BTREE,
  CONSTRAINT `learning_topic_grade_grade_id_foreign` FOREIGN KEY (`grade_id`) REFERENCES `grades` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `learning_topic_grade_learning_topic_id_foreign` FOREIGN KEY (`learning_topic_id`) REFERENCES `learning_topics` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of learning_topic_grade
-- ----------------------------
INSERT INTO `learning_topic_grade` VALUES (4, 25, 4, NULL, NULL);
INSERT INTO `learning_topic_grade` VALUES (5, 25, 5, NULL, NULL);
INSERT INTO `learning_topic_grade` VALUES (6, 25, 6, NULL, NULL);
INSERT INTO `learning_topic_grade` VALUES (7, 26, 7, NULL, NULL);
INSERT INTO `learning_topic_grade` VALUES (8, 26, 8, NULL, NULL);

-- ----------------------------
-- Table structure for learning_topic_visitor
-- ----------------------------
DROP TABLE IF EXISTS `learning_topic_visitor`;
CREATE TABLE `learning_topic_visitor`  (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` int UNSIGNED NOT NULL,
  `learning_topic_id` int UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `learning_topic_visitor_user_id_foreign`(`user_id`) USING BTREE,
  INDEX `learning_topic_visitor_learning_topic_id_foreign`(`learning_topic_id`) USING BTREE,
  CONSTRAINT `learning_topic_visitor_learning_topic_id_foreign` FOREIGN KEY (`learning_topic_id`) REFERENCES `learning_topics` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `learning_topic_visitor_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of learning_topic_visitor
-- ----------------------------
INSERT INTO `learning_topic_visitor` VALUES (2, 4, 4, '2024-10-05 11:10:46', '2024-10-05 11:10:46');
INSERT INTO `learning_topic_visitor` VALUES (3, 1, 4, '2024-10-05 21:01:48', '2024-10-05 21:01:48');
INSERT INTO `learning_topic_visitor` VALUES (4, 4, 5, '2024-10-06 10:23:14', '2024-10-06 10:23:14');
INSERT INTO `learning_topic_visitor` VALUES (5, 7, 7, '2024-10-06 13:51:55', '2024-10-06 13:51:55');
INSERT INTO `learning_topic_visitor` VALUES (6, 7, 5, '2024-10-06 13:52:14', '2024-10-06 13:52:14');
INSERT INTO `learning_topic_visitor` VALUES (7, 7, 4, '2024-10-06 13:54:11', '2024-10-06 13:54:11');
INSERT INTO `learning_topic_visitor` VALUES (8, 7, 6, '2024-10-06 18:57:48', '2024-10-06 18:57:48');
INSERT INTO `learning_topic_visitor` VALUES (9, 12, 4, '2024-10-06 18:58:23', '2024-10-06 18:58:23');
INSERT INTO `learning_topic_visitor` VALUES (10, 12, 5, '2024-10-06 18:58:43', '2024-10-06 18:58:43');
INSERT INTO `learning_topic_visitor` VALUES (11, 12, 6, '2024-10-06 18:59:02', '2024-10-06 18:59:02');
INSERT INTO `learning_topic_visitor` VALUES (12, 11, 4, '2024-10-06 18:59:35', '2024-10-06 18:59:35');
INSERT INTO `learning_topic_visitor` VALUES (13, 11, 5, '2024-10-06 18:59:57', '2024-10-06 18:59:57');

-- ----------------------------
-- Table structure for learning_topics
-- ----------------------------
DROP TABLE IF EXISTS `learning_topics`;
CREATE TABLE `learning_topics`  (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `subject_id` tinyint UNSIGNED NOT NULL,
  `grade_level` tinyint NOT NULL,
  `school_year` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '2019/2020',
  `user_id` int UNSIGNED NOT NULL,
  `rpp_file` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `semester` tinyint NOT NULL,
  `enroll_code` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `learning_topics_subject_id_foreign`(`subject_id`) USING BTREE,
  INDEX `learning_topics_user_id_foreign`(`user_id`) USING BTREE,
  CONSTRAINT `learning_topics_subject_id_foreign` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `learning_topics_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of learning_topics
-- ----------------------------
INSERT INTO `learning_topics` VALUES (4, 'Pertemuan 1', 2, 7, '2019/2020', 3, 'uploads/rpp-files/[Template] Laporan Akhir_[Magang_Studi Independed]_[Nama]_[NIM]_[Judul Kegiatan] (1)-6700b82228d65.docx', 1, '6700b82234eab', '2024-10-05 10:53:06', '2024-10-05 10:53:06');
INSERT INTO `learning_topics` VALUES (5, 'Pertemuan 1 - Rukun Iman', 1, 7, '2024/2025', 3, 'uploads/rpp-files/[Template] Laporan Akhir_[Magang_Studi Independed]_[Nama]_[NIM]_[Judul Kegiatan]-670177f8111b3.docx', 1, '670177f84ffcd', '2024-10-06 00:31:36', '2024-10-06 00:31:36');
INSERT INTO `learning_topics` VALUES (6, 'Pertemuan 2 - Rukun Islam', 1, 7, '2024/2025', 3, 'uploads/rpp-files/[Template] Laporan Akhir_[Magang_Studi Independed]_[Nama]_[NIM]_[Judul Kegiatan]-6701789c66b6b.docx', 1, '6701789c6870d', '2024-10-06 00:34:20', '2024-10-06 00:34:20');
INSERT INTO `learning_topics` VALUES (7, 'Sdfadsf', 1, 7, '2025/2026', 3, NULL, 1, '6702283c5ed0c', '2024-10-06 13:03:40', '2024-10-06 13:03:40');
INSERT INTO `learning_topics` VALUES (8, 'Fdgsfdg', 1, 7, '2019/2020', 3, NULL, 1, '6704f4bec4db5', '2024-10-08 16:00:46', '2024-10-08 16:00:46');

-- ----------------------------
-- Table structure for members
-- ----------------------------
DROP TABLE IF EXISTS `members`;
CREATE TABLE `members`  (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `identity_number` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `grade` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `pob` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_account_created` tinyint NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of members
-- ----------------------------
INSERT INTO `members` VALUES (1, '11111111', 'Admin', NULL, 'SEMARANG', 1, NULL, NULL);
INSERT INTO `members` VALUES (2, '11111112', 'Supervisor', NULL, 'SEMARANG', 1, NULL, NULL);
INSERT INTO `members` VALUES (3, '11111113', 'Pengajar', NULL, 'SEMARANG', 1, NULL, NULL);
INSERT INTO `members` VALUES (4, '11111114', 'Siswa', 'VIIZ', 'SEMARANG', 1, NULL, NULL);
INSERT INTO `members` VALUES (6, '12312321', 'UDIN PETOT', 'VIIX', 'SEMARANG', 1, '2024-10-05 20:55:33', '2024-10-05 20:55:33');
INSERT INTO `members` VALUES (7, '1234123412', 'JAMALUDIN', 'VIIZ', 'CILACAP', 1, '2024-10-05 20:56:55', '2024-10-05 20:56:55');
INSERT INTO `members` VALUES (8, '1234231', 'IRFAN', 'VIIX', 'PATI', 1, '2024-10-05 20:57:49', '2024-10-05 20:57:49');
INSERT INTO `members` VALUES (9, '856867', 'ANTO', 'VIIX', 'PATI', 1, '2024-10-05 20:58:35', '2024-10-05 20:58:35');
INSERT INTO `members` VALUES (10, '876585686', 'UPIN', 'VIIX', 'BANDUNG', 1, '2024-10-05 20:59:14', '2024-10-05 20:59:14');
INSERT INTO `members` VALUES (11, '458906', 'IPIN', 'VIIZ', 'BANDUNG', 1, '2024-10-05 20:59:45', '2024-10-05 20:59:45');
INSERT INTO `members` VALUES (12, '34587643', 'MAIL', 'VIIZ', 'BANDUNG', 1, '2024-10-05 21:00:24', '2024-10-05 21:00:24');

-- ----------------------------
-- Table structure for migrations
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations`  (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of migrations
-- ----------------------------
INSERT INTO `migrations` VALUES (1, '2014_02_28_064534_create_grades_table', 1);
INSERT INTO `migrations` VALUES (2, '2014_02_28_064912_create_members_table', 1);
INSERT INTO `migrations` VALUES (3, '2014_10_12_000000_create_users_table', 1);
INSERT INTO `migrations` VALUES (4, '2014_10_12_100000_create_password_resets_table', 1);
INSERT INTO `migrations` VALUES (5, '2019_08_19_000000_create_failed_jobs_table', 1);
INSERT INTO `migrations` VALUES (6, '2020_03_03_060509_create_jobs_table', 1);
INSERT INTO `migrations` VALUES (7, '2020_03_04_105339_add_avatar_field_table_users', 1);
INSERT INTO `migrations` VALUES (8, '2020_03_09_145427_create_subjects_table', 1);
INSERT INTO `migrations` VALUES (9, '2020_03_12_062043_create_announcements_table', 1);
INSERT INTO `migrations` VALUES (10, '2020_03_13_145220_create_learning_topics_table', 1);
INSERT INTO `migrations` VALUES (11, '2020_03_13_145614_create_learning_materials_table', 1);
INSERT INTO `migrations` VALUES (12, '2020_03_21_153617_create_tasks_table', 1);
INSERT INTO `migrations` VALUES (13, '2020_03_21_155423_create_task_submissions_table', 1);
INSERT INTO `migrations` VALUES (14, '2020_03_23_201607_create_standard_operation_procedures_table', 1);
INSERT INTO `migrations` VALUES (15, '2020_03_24_190049_create_permission_tables', 1);
INSERT INTO `migrations` VALUES (16, '2020_04_01_092125_create_question_types_table', 1);
INSERT INTO `migrations` VALUES (17, '2020_04_01_092322_create_questions_table', 1);
INSERT INTO `migrations` VALUES (18, '2020_04_01_095228_create_answer_choices_table', 1);
INSERT INTO `migrations` VALUES (19, '2020_04_01_100102_create_exams_table', 1);
INSERT INTO `migrations` VALUES (20, '2020_04_01_112228_create_exam_question_table', 1);
INSERT INTO `migrations` VALUES (21, '2020_04_04_210958_create_exam_results_table', 1);
INSERT INTO `migrations` VALUES (22, '2020_04_05_001417_create_exam_responses_table', 1);
INSERT INTO `migrations` VALUES (23, '2020_04_06_213635_create_exam_grade_table', 1);
INSERT INTO `migrations` VALUES (24, '2020_05_08_215625_create_learning_topic_visitor_table', 1);
INSERT INTO `migrations` VALUES (25, '2020_05_09_193553_add_remidial_and_final_score', 1);
INSERT INTO `migrations` VALUES (26, '2020_05_10_222218_create_student_learning_topic_table', 1);
INSERT INTO `migrations` VALUES (27, '2020_05_12_225247_add_grade_id_school_year_and_rpp_column', 1);
INSERT INTO `migrations` VALUES (28, '2020_05_15_153302_create_basic_competencies_table', 1);
INSERT INTO `migrations` VALUES (29, '2020_05_15_154323_create_basic_competency_topic_table', 1);
INSERT INTO `migrations` VALUES (30, '2020_05_15_192958_drop_basic_competency_column', 1);
INSERT INTO `migrations` VALUES (31, '2020_05_16_041229_create_learning_topic_grade_table', 1);
INSERT INTO `migrations` VALUES (32, '2020_05_16_041414_drop_grade_id_column', 1);
INSERT INTO `migrations` VALUES (33, '2020_05_17_045555_add_learning_topic_foreign_key_exam_question_table', 1);
INSERT INTO `migrations` VALUES (34, '2020_05_21_054138_add_basic_competency_foreign_key_exam_responses_table', 1);
INSERT INTO `migrations` VALUES (35, '2020_09_16_203943_add_date_and_start_time_field_to_table_announcements', 1);
INSERT INTO `migrations` VALUES (36, '2020_10_06_201806_add_student_foreign_key_tbl_users', 1);

-- ----------------------------
-- Table structure for model_has_permissions
-- ----------------------------
DROP TABLE IF EXISTS `model_has_permissions`;
CREATE TABLE `model_has_permissions`  (
  `permission_id` bigint UNSIGNED NOT NULL,
  `model_type` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint UNSIGNED NOT NULL,
  PRIMARY KEY (`permission_id`, `model_id`, `model_type`) USING BTREE,
  INDEX `model_has_permissions_model_id_model_type_index`(`model_id`, `model_type`) USING BTREE,
  CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of model_has_permissions
-- ----------------------------

-- ----------------------------
-- Table structure for model_has_roles
-- ----------------------------
DROP TABLE IF EXISTS `model_has_roles`;
CREATE TABLE `model_has_roles`  (
  `role_id` bigint UNSIGNED NOT NULL,
  `model_type` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint UNSIGNED NOT NULL,
  PRIMARY KEY (`role_id`, `model_id`, `model_type`) USING BTREE,
  INDEX `model_has_roles_model_id_model_type_index`(`model_id`, `model_type`) USING BTREE,
  CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of model_has_roles
-- ----------------------------
INSERT INTO `model_has_roles` VALUES (4, 'App\\User', 1);
INSERT INTO `model_has_roles` VALUES (3, 'App\\User', 2);
INSERT INTO `model_has_roles` VALUES (2, 'App\\User', 3);
INSERT INTO `model_has_roles` VALUES (1, 'App\\User', 4);
INSERT INTO `model_has_roles` VALUES (5, 'App\\User', 5);
INSERT INTO `model_has_roles` VALUES (1, 'App\\User', 6);
INSERT INTO `model_has_roles` VALUES (1, 'App\\User', 7);
INSERT INTO `model_has_roles` VALUES (1, 'App\\User', 8);
INSERT INTO `model_has_roles` VALUES (1, 'App\\User', 9);
INSERT INTO `model_has_roles` VALUES (1, 'App\\User', 10);
INSERT INTO `model_has_roles` VALUES (1, 'App\\User', 11);
INSERT INTO `model_has_roles` VALUES (1, 'App\\User', 12);

-- ----------------------------
-- Table structure for password_resets
-- ----------------------------
DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE `password_resets`  (
  `email` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  INDEX `password_resets_email_index`(`email`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of password_resets
-- ----------------------------

-- ----------------------------
-- Table structure for permissions
-- ----------------------------
DROP TABLE IF EXISTS `permissions`;
CREATE TABLE `permissions`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of permissions
-- ----------------------------

-- ----------------------------
-- Table structure for question_types
-- ----------------------------
DROP TABLE IF EXISTS `question_types`;
CREATE TABLE `question_types`  (
  `id` tinyint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of question_types
-- ----------------------------
INSERT INTO `question_types` VALUES (1, 'Multiple Choice', NULL, NULL);
INSERT INTO `question_types` VALUES (2, 'Essay', NULL, NULL);

-- ----------------------------
-- Table structure for questions
-- ----------------------------
DROP TABLE IF EXISTS `questions`;
CREATE TABLE `questions`  (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `excerpt` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `question` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int UNSIGNED NOT NULL,
  `subject_id` tinyint UNSIGNED NOT NULL,
  `question_type_id` tinyint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `questions_user_id_foreign`(`user_id`) USING BTREE,
  INDEX `questions_subject_id_foreign`(`subject_id`) USING BTREE,
  INDEX `questions_question_type_id_foreign`(`question_type_id`) USING BTREE,
  CONSTRAINT `questions_question_type_id_foreign` FOREIGN KEY (`question_type_id`) REFERENCES `question_types` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `questions_subject_id_foreign` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `questions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 46 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of questions
-- ----------------------------
INSERT INTO `questions` VALUES (14, 'Pretest - Pertemuan 1', '1 +1 =', '<p>1 +1 =</p>', 3, 1, 1, '2024-10-06 10:10:15', '2024-10-06 10:10:15');
INSERT INTO `questions` VALUES (15, 'Pretest - Pertemuan 1', '1 + 1 =', '<p>1 + 1 =</p>', 3, 1, 1, '2024-10-06 10:11:30', '2024-10-06 10:11:30');
INSERT INTO `questions` VALUES (16, 'Pretest - Pertemuan 1', '1 x 1 =', '<p>1 x 1 =</p>', 3, 1, 1, '2024-10-06 10:12:15', '2024-10-06 10:12:15');
INSERT INTO `questions` VALUES (17, 'Pretest - Pertemuan 1', '2 x 2 =', '<p>2 x 2 =</p>', 3, 1, 1, '2024-10-06 10:12:47', '2024-10-06 10:12:47');
INSERT INTO `questions` VALUES (18, 'Pretest - Pertemuan 1', '3 + 3 =', '<p>3 + 3 =</p>', 3, 1, 1, '2024-10-06 10:13:17', '2024-10-06 10:13:17');
INSERT INTO `questions` VALUES (19, 'Pretest - Pertemuan 1', '1 - 1 =', '<p>1 - 1 =</p>', 3, 1, 1, '2024-10-06 10:13:43', '2024-10-06 10:13:43');
INSERT INTO `questions` VALUES (20, 'Pretest - Pertemuan 1', '1 : 1 =&nbsp;', '<p>1 : 1 =&nbsp;</p>', 3, 1, 1, '2024-10-06 10:14:08', '2024-10-06 10:14:08');
INSERT INTO `questions` VALUES (21, 'Pretest - Pertemuan 1', '2 : 2 =', '<p>2 : 2 =</p>', 3, 1, 1, '2024-10-06 10:14:29', '2024-10-06 10:14:29');
INSERT INTO `questions` VALUES (22, 'Pretest - Pertemuan 1', '5 x 22.350 =', '<p>5 x 22.350 =</p>', 3, 1, 1, '2024-10-06 10:16:16', '2024-10-06 10:16:16');
INSERT INTO `questions` VALUES (23, 'Pretest - Pertemuan 1', '67 : 67 =', '<p>67 : 67 =</p>', 3, 1, 1, '2024-10-06 10:16:47', '2024-10-06 10:16:47');
INSERT INTO `questions` VALUES (24, 'askdflkadsjfa', 'afadsfdsafgasd', '<p>afadsfdsafgasd</p>', 3, 1, 1, '2024-10-06 13:21:15', '2024-10-06 13:21:15');
INSERT INTO `questions` VALUES (45, 'kkhbbjkh', 'vjhgc', '<p>vjhgc</p>', 3, 1, 1, '2024-10-20 01:06:24', '2024-10-20 01:06:24');
INSERT INTO `questions` VALUES (46, 'bv', 'b', '<p>b</p>', 3, 1, 1, '2024-10-20 01:07:58', '2024-10-20 01:07:58');

-- ----------------------------
-- Table structure for role_has_permissions
-- ----------------------------
DROP TABLE IF EXISTS `role_has_permissions`;
CREATE TABLE `role_has_permissions`  (
  `permission_id` bigint UNSIGNED NOT NULL,
  `role_id` bigint UNSIGNED NOT NULL,
  PRIMARY KEY (`permission_id`, `role_id`) USING BTREE,
  INDEX `role_has_permissions_role_id_foreign`(`role_id`) USING BTREE,
  CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of role_has_permissions
-- ----------------------------

-- ----------------------------
-- Table structure for roles
-- ----------------------------
DROP TABLE IF EXISTS `roles`;
CREATE TABLE `roles`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of roles
-- ----------------------------
INSERT INTO `roles` VALUES (1, 'Siswa', 'web', '2024-10-04 09:48:34', '2024-10-04 09:48:34');
INSERT INTO `roles` VALUES (2, 'Pengajar', 'web', '2024-10-04 09:48:34', '2024-10-04 09:48:34');
INSERT INTO `roles` VALUES (3, 'Supervisor', 'web', '2024-10-04 09:48:34', '2024-10-04 09:48:34');
INSERT INTO `roles` VALUES (4, 'Admin', 'web', '2024-10-04 09:48:34', '2024-10-04 09:48:34');
INSERT INTO `roles` VALUES (5, 'Wali Siswa', 'web', '2024-10-04 09:48:34', '2024-10-04 09:48:34');

-- ----------------------------
-- Table structure for skill_submissions
-- ----------------------------
DROP TABLE IF EXISTS `skill_submissions`;
CREATE TABLE `skill_submissions`  (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `skill_id` int UNSIGNED NOT NULL,
  `grade_id` int NULL DEFAULT NULL,
  `user_id` int UNSIGNED NOT NULL,
  `mark` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `indikator_1` int NULL DEFAULT NULL,
  `indikator_2` int NULL DEFAULT NULL,
  `indikator_3` int NULL DEFAULT NULL,
  `indikator_4` int NULL DEFAULT NULL,
  `indikator_5` int NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `task_submissions_task_id_foreign`(`skill_id`) USING BTREE,
  INDEX `task_submissions_user_id_foreign`(`user_id`) USING BTREE,
  CONSTRAINT `skill_submissions_ibfk_1` FOREIGN KEY (`skill_id`) REFERENCES `skills` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `skill_submissions_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of skill_submissions
-- ----------------------------
INSERT INTO `skill_submissions` VALUES (1, 5, 25, 4, NULL, '2024-10-21 01:44:12', '2024-10-21 01:44:12', 4, 4, 5, 5, 5);
INSERT INTO `skill_submissions` VALUES (2, 5, 25, 7, NULL, '2024-10-21 02:11:59', '2024-10-21 02:11:59', 5, 5, 5, 5, 5);
INSERT INTO `skill_submissions` VALUES (3, 11, 26, 9, NULL, '2024-10-22 02:39:25', '2024-10-22 02:39:25', 5, 1, 1, 1, 1);

-- ----------------------------
-- Table structure for skills
-- ----------------------------
DROP TABLE IF EXISTS `skills`;
CREATE TABLE `skills`  (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `deadline` datetime NOT NULL,
  `status` tinyint NOT NULL,
  `user_id` int UNSIGNED NOT NULL,
  `subject_id` tinyint UNSIGNED NOT NULL,
  `grade_id` tinyint NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `tasks_user_id_foreign`(`user_id`) USING BTREE,
  INDEX `tasks_subject_id_foreign`(`subject_id`) USING BTREE,
  CONSTRAINT `skills_ibfk_2` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `skills_ibfk_3` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 11 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of skills
-- ----------------------------
INSERT INTO `skills` VALUES (5, 'Ketrampilan 1', '2024-10-20 18:11:00', 1, 3, 1, 25, '2024-10-20 18:16:09', '2024-10-20 18:16:09');
INSERT INTO `skills` VALUES (11, 'Keterampilan w', '2024-10-22 02:23:00', 1, 3, 1, 26, '2024-10-22 02:25:14', '2024-10-22 02:25:14');

-- ----------------------------
-- Table structure for standard_operation_procedures
-- ----------------------------
DROP TABLE IF EXISTS `standard_operation_procedures`;
CREATE TABLE `standard_operation_procedures`  (
  `id` smallint UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` int UNSIGNED NOT NULL,
  `file_path` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `filename` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `standard_operation_procedures_user_id_foreign`(`user_id`) USING BTREE,
  CONSTRAINT `standard_operation_procedures_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of standard_operation_procedures
-- ----------------------------

-- ----------------------------
-- Table structure for student_learning_topic
-- ----------------------------
DROP TABLE IF EXISTS `student_learning_topic`;
CREATE TABLE `student_learning_topic`  (
  `user_id` int UNSIGNED NOT NULL,
  `learning_topic_id` int UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  INDEX `student_learning_topic_user_id_foreign`(`user_id`) USING BTREE,
  INDEX `student_learning_topic_learning_topic_id_foreign`(`learning_topic_id`) USING BTREE,
  CONSTRAINT `student_learning_topic_learning_topic_id_foreign` FOREIGN KEY (`learning_topic_id`) REFERENCES `learning_topics` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `student_learning_topic_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of student_learning_topic
-- ----------------------------

-- ----------------------------
-- Table structure for subjects
-- ----------------------------
DROP TABLE IF EXISTS `subjects`;
CREATE TABLE `subjects`  (
  `id` tinyint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 18 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of subjects
-- ----------------------------
INSERT INTO `subjects` VALUES (1, 'Pendidikan Agama  dan Budi Pekerti', NULL, NULL);
INSERT INTO `subjects` VALUES (2, 'Pendidikan Pancasila dan Kewarganegaraan', NULL, NULL);
INSERT INTO `subjects` VALUES (18, 'Keterampilan', '2024-10-19 14:55:57', '2024-10-19 14:55:57');

-- ----------------------------
-- Table structure for task_submissions
-- ----------------------------
DROP TABLE IF EXISTS `task_submissions`;
CREATE TABLE `task_submissions`  (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `task_id` int UNSIGNED NOT NULL,
  `user_id` int UNSIGNED NOT NULL,
  `submission_path` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `submission_filename` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint NOT NULL DEFAULT 3,
  `mark` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `teacher_notes` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `task_submissions_task_id_foreign`(`task_id`) USING BTREE,
  INDEX `task_submissions_user_id_foreign`(`user_id`) USING BTREE,
  CONSTRAINT `task_submissions_task_id_foreign` FOREIGN KEY (`task_id`) REFERENCES `tasks` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `task_submissions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 9 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of task_submissions
-- ----------------------------
INSERT INTO `task_submissions` VALUES (9, 1, 7, 'uploads/task-submissionss/Rosyid_et_al_ICHBS-67151e4d0ceb2.docx', 'Rosyid_et_al_ICHBS.docx', 2, '49', 'ghhgfgf', '2024-10-20 22:14:21', '2024-10-20 22:21:37');

-- ----------------------------
-- Table structure for tasks
-- ----------------------------
DROP TABLE IF EXISTS `tasks`;
CREATE TABLE `tasks`  (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `instruction` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `deadline` datetime NOT NULL,
  `status` tinyint NOT NULL,
  `attachment_path` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `attachment_filename` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `user_id` int UNSIGNED NOT NULL,
  `learning_topic_id` int UNSIGNED NOT NULL,
  `subject_id` tinyint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `tasks_user_id_foreign`(`user_id`) USING BTREE,
  INDEX `tasks_learning_topic_id_foreign`(`learning_topic_id`) USING BTREE,
  INDEX `tasks_subject_id_foreign`(`subject_id`) USING BTREE,
  CONSTRAINT `tasks_learning_topic_id_foreign` FOREIGN KEY (`learning_topic_id`) REFERENCES `learning_topics` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tasks_subject_id_foreign` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tasks_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tasks
-- ----------------------------
INSERT INTO `tasks` VALUES (1, 'PRETEST', '<p>ASDFGADSFASDFASDF</p>', '2024-10-05 10:54:00', 1, 'uploads/task-attachments/[Template] Laporan Akhir_[Magang_Studi Independed]_[Nama]_[NIM]_[Judul Kegiatan] (1)-6700b87e9e872.docx', '[Template] Laporan Akhir_[Magang_Studi Independed]_[Nama]_[NIM]_[Judul Kegiatan] (1).docx', 3, 4, 2, '2024-10-05 10:54:38', '2024-10-05 10:54:38');
INSERT INTO `tasks` VALUES (2, 'adfgafasdfads', '<p>dfadsfasdf</p>', '2024-10-07 13:10:00', 1, 'uploads/task-attachments/[Template] Laporan Akhir_[Magang_Studi Independed]_[Nama]_[NIM]_[Judul Kegiatan] (1)-670229feedb05.docx', '[Template] Laporan Akhir_[Magang_Studi Independed]_[Nama]_[NIM]_[Judul Kegiatan] (1).docx', 3, 5, 1, '2024-10-06 13:11:10', '2024-10-06 13:11:10');

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users`  (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `grade_id` tinyint UNSIGNED NULL DEFAULT NULL,
  `member_id` int UNSIGNED NULL DEFAULT NULL,
  `student_id` int UNSIGNED NULL DEFAULT NULL,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `avatar` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `users_email_unique`(`email`) USING BTREE,
  INDEX `users_grade_id_foreign`(`grade_id`) USING BTREE,
  INDEX `users_member_id_foreign`(`member_id`) USING BTREE,
  INDEX `users_student_id_foreign`(`student_id`) USING BTREE,
  CONSTRAINT `users_grade_id_foreign` FOREIGN KEY (`grade_id`) REFERENCES `grades` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `users_member_id_foreign` FOREIGN KEY (`member_id`) REFERENCES `members` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `users_student_id_foreign` FOREIGN KEY (`student_id`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES (1, NULL, 1, NULL, 'Admin', 'admin@gmail.com', '2024-10-04 09:48:34', '$2y$10$ezXE/5O9dxtPmFYySk4QceiNAugMUw2iLUZvJcWBEMJLFnC1XkdBe', NULL, 'kMdcNo0hKznO0dqSrjX0xH6F4xQVly6QOJqgUXBaHDTHFPCYTJ4GFHbLPZXs', '2024-10-04 09:48:34', '2024-10-04 09:48:34');
INSERT INTO `users` VALUES (2, NULL, 2, NULL, 'Supervisor', 'supervisor@gmail.com', '2024-10-04 09:48:34', '$2y$10$Qll8IZ.SeutsklBAm94qo.AX2.IeQD8iUD8XINtzpTM0ppC8wcOW6', NULL, 'a6IP4y5KEA', '2024-10-04 09:48:34', '2024-10-04 09:48:34');
INSERT INTO `users` VALUES (3, NULL, 3, NULL, 'Pengajar', 'teacher@gmail.com', '2024-10-04 09:48:34', '$2y$10$Qll8IZ.SeutsklBAm94qo.AX2.IeQD8iUD8XINtzpTM0ppC8wcOW6', NULL, '4wDt6d2Gq2QKYVuMZmOMIHMXG4jWTOmVbmg4UZSucc1K703Fybv8dx4JeZcg', '2024-10-04 09:48:34', '2024-10-04 09:48:34');
INSERT INTO `users` VALUES (4, 25, 4, NULL, 'Siswa', 'student@gmail.com', '2024-10-04 09:48:34', '$2y$10$Qll8IZ.SeutsklBAm94qo.AX2.IeQD8iUD8XINtzpTM0ppC8wcOW6', NULL, '0fhduwwWbB8vxj1lmUgBXmLO54yxjJgXxtjsOSrPLm5Gtzp3vafuUELbPBsr', '2024-10-04 09:48:34', '2024-10-04 09:48:34');
INSERT INTO `users` VALUES (5, NULL, NULL, 4, 'Wali Siswa', 'parent@gmail.com', '2024-10-04 09:48:34', '$2y$10$Qll8IZ.SeutsklBAm94qo.AX2.IeQD8iUD8XINtzpTM0ppC8wcOW6', NULL, 'FRfWquSFQ2GG8HVQqRNHzMq5JOGBwHvgyJv6neIXNjZaiiQYVYzCG3m0RixA', '2024-10-04 09:48:34', '2024-10-04 09:48:34');
INSERT INTO `users` VALUES (6, 26, 6, NULL, 'UDIN PETOT', 'udin@gmail.com', NULL, '$2y$10$C5bs0qWP8m0.D3xaQtqMm.rlKBk.YCOELoEDDEuKOC6y597Y0qcDG', NULL, NULL, '2024-10-05 20:55:34', '2024-10-05 20:55:34');
INSERT INTO `users` VALUES (7, 25, 7, NULL, 'JAMALUDIN', 'jamal@gmail.com', NULL, '$2y$10$FPU.UArlq7O03M0IiHTSdON8dEL5mFj0M1ZVxBC3LscAISlKmXyra', NULL, NULL, '2024-10-05 20:56:55', '2024-10-05 20:56:55');
INSERT INTO `users` VALUES (8, 26, 8, NULL, 'IRFAN', 'irfan@gmail.com', NULL, '$2y$10$bN4aUHsUhI/5Y1RxvX7SnebaylUtGLTbh.J.zGaGEdfmySnaVob92', NULL, NULL, '2024-10-05 20:57:49', '2024-10-05 20:57:49');
INSERT INTO `users` VALUES (9, 26, 9, NULL, 'ANTO', 'anto@gmail.com', NULL, '$2y$10$1RJ.l5jm2OzdbtmNPEdKVe2D.zJ3nsxXyl1pAMWAUj1dj.VZTO9KO', NULL, NULL, '2024-10-05 20:58:35', '2024-10-05 20:58:35');
INSERT INTO `users` VALUES (10, 26, 10, NULL, 'UPIN', 'upin@gmail.com', NULL, '$2y$10$R7LWYXtgOHDnYrVETkc.xuo66mLgv9itD3Ei6440Vg5LCjGjPMg8.', NULL, NULL, '2024-10-05 20:59:14', '2024-10-05 20:59:14');
INSERT INTO `users` VALUES (11, 25, 11, NULL, 'IPIN', 'ipin@gmail.com', NULL, '$2y$10$JNT1xOk6KsYw7BBPvGjjj.UMVN4cyMmvrNsc54XKawnm.OKw3q66G', NULL, NULL, '2024-10-05 20:59:45', '2024-10-05 20:59:45');
INSERT INTO `users` VALUES (12, 25, 12, NULL, 'MAIL', 'mail@gmail.com', NULL, '$2y$10$2FmgDx5dbLvYvhLMNVhakOsb2Vw6/tTo7yQ2Bswbtvn0vomxD//Hm', NULL, NULL, '2024-10-05 21:00:24', '2024-10-05 21:00:24');

SET FOREIGN_KEY_CHECKS = 1;
