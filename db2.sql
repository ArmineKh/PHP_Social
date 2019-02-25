/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 100121
Source Host           : localhost:3306
Source Database       : db2

Target Server Type    : MYSQL
Target Server Version : 100121
File Encoding         : 65001

Date: 2019-02-25 19:02:20
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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of friends
-- ----------------------------
INSERT INTO `friends` VALUES ('1', '4', '5');

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
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of request
-- ----------------------------
INSERT INTO `request` VALUES ('14', '3', '4');
INSERT INTO `request` VALUES ('15', '6', '4');
INSERT INTO `request` VALUES ('16', '8', '4');

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
