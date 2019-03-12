/*
Navicat MySQL Data Transfer

Source Server         : MyConnection
Source Server Version : 100137
Source Host           : localhost:3306
Source Database       : db

Target Server Type    : MYSQL
Target Server Version : 100137
File Encoding         : 65001

Date: 2019-03-12 22:43:13
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for comment
-- ----------------------------
DROP TABLE IF EXISTS `comment`;
CREATE TABLE `comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `my_id` int(11) DEFAULT NULL,
  `post_id` int(11) DEFAULT NULL,
  `comment` varchar(255) DEFAULT NULL,
  `time` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `my_id` (`my_id`),
  CONSTRAINT `comment_ibfk_1` FOREIGN KEY (`my_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of comment
-- ----------------------------
INSERT INTO `comment` VALUES ('1', '4', '6', 'zhx', '2019-03-04 18:27:32');
INSERT INTO `comment` VALUES ('2', '4', '6', 'sxfh', '2019-03-04 18:27:34');
INSERT INTO `comment` VALUES ('3', '4', '1', 'ohy[h0[', '2019-03-12 22:42:21');

-- ----------------------------
-- Table structure for friends
-- ----------------------------
DROP TABLE IF EXISTS `friends`;
CREATE TABLE `friends` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `my_id` int(11) NOT NULL,
  `friend_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `my_id` (`my_id`),
  KEY `friend_id` (`friend_id`),
  CONSTRAINT `friends_ibfk_1` FOREIGN KEY (`my_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `friends_ibfk_2` FOREIGN KEY (`friend_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of friends
-- ----------------------------
INSERT INTO `friends` VALUES ('1', '4', '5');
INSERT INTO `friends` VALUES ('2', '4', '6');
INSERT INTO `friends` VALUES ('3', '7', '4');
INSERT INTO `friends` VALUES ('4', '4', '8');
INSERT INTO `friends` VALUES ('5', '5', '4');

-- ----------------------------
-- Table structure for like
-- ----------------------------
DROP TABLE IF EXISTS `like`;
CREATE TABLE `like` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `my_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `my_id` (`my_id`),
  CONSTRAINT `like_ibfk_1` FOREIGN KEY (`my_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=55 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of like
-- ----------------------------
INSERT INTO `like` VALUES ('1', '4', '5');
INSERT INTO `like` VALUES ('2', '4', '7');
INSERT INTO `like` VALUES ('26', '5', '4');
INSERT INTO `like` VALUES ('45', '4', '4');
INSERT INTO `like` VALUES ('49', '4', '6');
INSERT INTO `like` VALUES ('50', '4', '6');
INSERT INTO `like` VALUES ('51', '4', '6');
INSERT INTO `like` VALUES ('52', '4', '6');
INSERT INTO `like` VALUES ('53', '4', '6');
INSERT INTO `like` VALUES ('54', '4', '6');

-- ----------------------------
-- Table structure for message
-- ----------------------------
DROP TABLE IF EXISTS `message`;
CREATE TABLE `message` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `my_id` int(11) NOT NULL,
  `friend_id` int(11) NOT NULL,
  `message` varchar(255) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `my_id` (`my_id`),
  KEY `friend_id` (`friend_id`),
  CONSTRAINT `message_ibfk_1` FOREIGN KEY (`my_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `message_ibfk_2` FOREIGN KEY (`friend_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of message
-- ----------------------------
INSERT INTO `message` VALUES ('1', '4', '5', 'iku', '2019-02-27 18:55:29');
INSERT INTO `message` VALUES ('2', '4', '6', 'hjghj', '2019-02-27 18:56:12');
INSERT INTO `message` VALUES ('3', '5', '4', 'yhtu', '2019-02-27 18:57:53');
INSERT INTO `message` VALUES ('4', '4', '7', 'zhbz', '2019-03-01 17:18:08');
INSERT INTO `message` VALUES ('5', '4', '6', 'cncmncmk\n', '2019-03-01 17:20:05');
INSERT INTO `message` VALUES ('6', '5', '4', 'tsduy', '2019-03-01 17:35:37');
INSERT INTO `message` VALUES ('7', '5', '4', 'vfuft', '2019-03-01 17:35:38');
INSERT INTO `message` VALUES ('8', '5', '4', 'hougig', '2019-03-01 17:35:38');
INSERT INTO `message` VALUES ('9', '4', '6', 'ukiyhui', '2019-03-01 17:32:47');
INSERT INTO `message` VALUES ('10', '4', '5', 'hkjgk', '2019-03-01 17:43:08');
INSERT INTO `message` VALUES ('11', '4', '5', 'jkjk', '2019-03-01 17:43:15');
INSERT INTO `message` VALUES ('12', '4', '5', 'jkj', '2019-03-01 17:43:17');

-- ----------------------------
-- Table structure for photos
-- ----------------------------
DROP TABLE IF EXISTS `photos`;
CREATE TABLE `photos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `photos` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `photos_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of photos
-- ----------------------------
INSERT INTO `photos` VALUES ('1', '5', 'images/1550669518Koala.jpg');
INSERT INTO `photos` VALUES ('2', '5', 'images/1551105193Hydrangeas.jpg');
INSERT INTO `photos` VALUES ('3', '5', 'images/1550669518Koala.jpg');

-- ----------------------------
-- Table structure for request
-- ----------------------------
DROP TABLE IF EXISTS `request`;
CREATE TABLE `request` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `my_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `my_id` (`my_id`),
  CONSTRAINT `request_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `request_ibfk_2` FOREIGN KEY (`my_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of request
-- ----------------------------
INSERT INTO `request` VALUES ('1', '4', '3');
INSERT INTO `request` VALUES ('2', '4', '9');
INSERT INTO `request` VALUES ('3', '4', '3');
INSERT INTO `request` VALUES ('4', '4', '3');
INSERT INTO `request` VALUES ('5', '4', '3');
INSERT INTO `request` VALUES ('6', '4', '3');
INSERT INTO `request` VALUES ('7', '4', '3');
INSERT INTO `request` VALUES ('8', '4', '3');
INSERT INTO `request` VALUES ('9', '4', '3');
INSERT INTO `request` VALUES ('10', '4', '3');
INSERT INTO `request` VALUES ('11', '4', '9');
INSERT INTO `request` VALUES ('12', '4', '9');

-- ----------------------------
-- Table structure for status
-- ----------------------------
DROP TABLE IF EXISTS `status`;
CREATE TABLE `status` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `my_id` int(11) NOT NULL,
  `status` varchar(255) NOT NULL,
  `time` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `my_id` (`my_id`),
  CONSTRAINT `status_ibfk_1` FOREIGN KEY (`my_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of status
-- ----------------------------
INSERT INTO `status` VALUES ('1', '5', 'hgbiuygf', '2019-03-08 18:00:29');
INSERT INTO `status` VALUES ('2', '5', 'gikgfy', '2019-03-08 18:00:29');
INSERT INTO `status` VALUES ('3', '5', 'hujhuj', '2019-03-08 18:00:29');
INSERT INTO `status` VALUES ('4', '7', 'eekjejire', '2019-03-01 18:46:09');
INSERT INTO `status` VALUES ('5', '4', 'rusr6oito\n', '2019-03-04 17:32:08');
INSERT INTO `status` VALUES ('6', '4', 'vgjmfvj', '2019-03-04 17:32:19');

-- ----------------------------
-- Table structure for user
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(55) NOT NULL,
  `surname` varchar(55) NOT NULL,
  `age` int(11) NOT NULL,
  `email` varchar(55) NOT NULL,
  `password` varchar(60) NOT NULL,
  `photo` varchar(60) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES ('3', 'Ani', 'Achoyan', '12', 'narek1990099@gmail.com', '$2y$10$cyPGhCiTYHOUCMSsvd91guQn.xU1rExOgLyh/EqaeMx7nReboLOmy', 'images/1550669518Koala.jpg');
INSERT INTO `user` VALUES ('4', 'Anna', 'Grigoryan', '25', 'a@mail.ru', '$2y$10$dhFydWYY66ru/dI2vYP6be76bwq6ZofIiwquba4XAIfG9wh89irhC', 'images/1550669518Koala.jpg');
INSERT INTO `user` VALUES ('5', 'Armine', 'Manukyan', '20', 'a@mail.ru', '$2y$10$mJFQfnGRF8xR4ukFcK3.aOQiq2SV5D0E.Eupg8XqfQhShwO.SlZsi', 'images/1550900964Hydrangeas.jpg');
INSERT INTO `user` VALUES ('6', 'Aren', 'Margaryan', '20', 'a@mail.ru', '$2y$10$d1W23VNePmMrNCFhwGv9euUyxv2LWVuJ6hkdwn474X07J9GIXZ/x.', 'images/1550668480Lighthouse.jpg');
INSERT INTO `user` VALUES ('7', 'Karen', 'Vardanyan', '40', 'a@mail.ru', '$2y$10$QKpNmPVmUdZzMELc7oewQeXoFgl2BmXyL6F394wGVSTGu.7n2gbmu', 'images/1550668320Jellyfish.jpg');
INSERT INTO `user` VALUES ('8', 'Ashot', 'Avagyan', '35', 'narek1990099@gmail.com', '$2y$10$poWtMgZyUGpt65ywbbo0TuATwyCScuX3o0zUdyxuk.2qBboIZWWGe', 'images/1550668253Penguins.jpg');
INSERT INTO `user` VALUES ('9', 'Alla', 'Hovhannisyan', '20', 'narek1990099@gmail.com', '$2y$10$6yz4xIRwCHP0cH8gRYiiJOSDD0IVierxz5WQxWXCzVZ8nmnPCJ25W', 'images/1550668521Jellyfish.jpg');
SET FOREIGN_KEY_CHECKS=1;
