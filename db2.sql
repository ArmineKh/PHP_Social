/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 100121
Source Host           : localhost:3306
Source Database       : db2

Target Server Type    : MYSQL
Target Server Version : 100121
File Encoding         : 65001

Date: 2019-03-01 18:56:53
*/

SET FOREIGN_KEY_CHECKS=0;

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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of friends
-- ----------------------------
INSERT INTO `friends` VALUES ('1', '4', '5');
INSERT INTO `friends` VALUES ('2', '4', '6');
INSERT INTO `friends` VALUES ('3', '4', '7');
INSERT INTO `friends` VALUES ('4', '4', '8');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of request
-- ----------------------------

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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of status
-- ----------------------------
INSERT INTO `status` VALUES ('1', '4', 'hgbiuygf', '2019-01-17 17:46:09');
INSERT INTO `status` VALUES ('2', '4', 'gikgfy', '2019-01-25 18:46:09');
INSERT INTO `status` VALUES ('3', '9', 'hujhuj', '2019-03-01 18:46:09');
INSERT INTO `status` VALUES ('4', '7', 'eekjejire', '2019-03-01 18:46:09');

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
INSERT INTO `user` VALUES ('3', 'Karen', 'Achoyan', '12', 'narek1990099@gmail.com', '$2y$10$cyPGhCiTYHOUCMSsvd91guQn.xU1rExOgLyh/EqaeMx7nReboLOmy', 'images/1550669518Koala.jpg');
INSERT INTO `user` VALUES ('4', 'Narek', 'Achoyan', '2055', 'a@mail.ru', '$2y$10$dhFydWYY66ru/dI2vYP6be76bwq6ZofIiwquba4XAIfG9wh89irhC', 'images/1551105193Hydrangeas.jpg');
INSERT INTO `user` VALUES ('5', 'Karine', 'Achoyan', '20', 'a@mail.ru', '$2y$10$mJFQfnGRF8xR4ukFcK3.aOQiq2SV5D0E.Eupg8XqfQhShwO.SlZsi', 'images/1550669518Koala.jpg');
INSERT INTO `user` VALUES ('6', 'Karen', 'Achoyan', '20', 'a@mail.ru', '$2y$10$d1W23VNePmMrNCFhwGv9euUyxv2LWVuJ6hkdwn474X07J9GIXZ/x.', 'images/1550669518Koala.jpg');
INSERT INTO `user` VALUES ('7', 'asd', 'Achoyan', '18', 'a@mail.ru', '$2y$10$QKpNmPVmUdZzMELc7oewQeXoFgl2BmXyL6F394wGVSTGu.7n2gbmu', '');
INSERT INTO `user` VALUES ('8', 'Karen', 'Achoyan', '12', 'narek1990099@gmail.com', '$2y$10$poWtMgZyUGpt65ywbbo0TuATwyCScuX3o0zUdyxuk.2qBboIZWWGe', '');
INSERT INTO `user` VALUES ('9', 'Karen', 'Achoyan', '20', 'narek1990099@gmail.com', '$2y$10$6yz4xIRwCHP0cH8gRYiiJOSDD0IVierxz5WQxWXCzVZ8nmnPCJ25W', '');
SET FOREIGN_KEY_CHECKS=1;
