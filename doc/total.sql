/*
Navicat MySQL Data Transfer

Source Server         : local
Source Server Version : 50720
Source Host           : localhost:3306
Source Database       : total

Target Server Type    : MYSQL
Target Server Version : 50720
File Encoding         : 65001

Date: 2018-09-27 11:08:58
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for coupons
-- ----------------------------
DROP TABLE IF EXISTS `coupons`;
CREATE TABLE `coupons` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `appid` char(30) NOT NULL,
  `coupon_name` varchar(255) NOT NULL,
  `icon` varchar(255) DEFAULT NULL,
  `condition` int(10) NOT NULL,
  `reduce` int(10) NOT NULL,
  `addtime` varchar(255) NOT NULL,
  `endtime` varchar(255) NOT NULL,
  `num` int(11) NOT NULL,
  `receive_num` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `appid` (`appid`),
  KEY `coupon_name` (`coupon_name`),
  KEY `addtime` (`addtime`),
  KEY `endtime` (`endtime`),
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of coupons
-- ----------------------------
INSERT INTO `coupons` VALUES ('8', '222', '按时232224', null, '111', '2', '1535846400', '1538265600', '1', '2');
INSERT INTO `coupons` VALUES ('9', 'wxa03a920155fd067e', '噶23111', null, '0', '100', '1535760000', '1535846400', '40', '1');
INSERT INTO `coupons` VALUES ('16', '333', '吱吱吱', null, '111', '11', '1535846340', '1537142340', '111', '1');
INSERT INTO `coupons` VALUES ('17', '333', '嘻嘻嘻', null, '111', '22', '1537055940', '1537660800', '222', '2');
INSERT INTO `coupons` VALUES ('18', 'wxa03a920155fd067e', '踩踩踩', null, '111', '22', '1537657200', '1538179140', '333', '1');
INSERT INTO `coupons` VALUES ('20', '444', '打ads', null, '123', '142', '1535763660', '1537664460', '142', '124');
INSERT INTO `coupons` VALUES ('21', '555', '555测试', null, '200', '10', '1535763660', '1538269260', '900', '1');
INSERT INTO `coupons` VALUES ('23', 'wxa03a920155fd067e', 'wxa03a920155fd067e', null, '0', '100', '1535842860', '1538269260', '20', '1');
INSERT INTO `coupons` VALUES ('24', 'wxa03a920155fd067e', '00000', null, '0', '100', '1535763660', '1538269260', '100', '1');

-- ----------------------------
-- Table structure for dealer
-- ----------------------------
DROP TABLE IF EXISTS `dealer`;
CREATE TABLE `dealer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `level` char(5) NOT NULL,
  `area` varchar(255) CHARACTER SET utf8 NOT NULL,
  `cs_id` int(11) DEFAULT NULL,
  `name` varchar(255) CHARACTER SET utf8 NOT NULL,
  `program_num` int(11) unsigned DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `level` (`level`),
  KEY `area` (`area`),
  KEY `cs_id` (`cs_id`),
  KEY `name` (`name`)
) ENGINE=MyISAM AUTO_INCREMENT=107 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of dealer
-- ----------------------------
INSERT INTO `dealer` VALUES ('75', '1', '阿斯顿', '1', '张康152', '2');
INSERT INTO `dealer` VALUES ('76', '1', '阿斯顿', '1', '张康1', '1');
INSERT INTO `dealer` VALUES ('77', '1', '阿斯顿', '1', '张康1', '0');
INSERT INTO `dealer` VALUES ('78', '1', '阿斯顿', '1', '张康1', '0');
INSERT INTO `dealer` VALUES ('79', '1', '阿斯顿', '1', '张康1', '0');
INSERT INTO `dealer` VALUES ('103', '251', '215', '215', '521', '0');
INSERT INTO `dealer` VALUES ('104', '251', '251', '251', '521', '0');
INSERT INTO `dealer` VALUES ('82', '1', '阿斯顿', '1', '张康1', '0');
INSERT INTO `dealer` VALUES ('83', '1', '阿斯顿', '1', '张康1', '0');
INSERT INTO `dealer` VALUES ('105', '241', '214', '421', '21', '0');
INSERT INTO `dealer` VALUES ('99', '412', '521', '6423', '412', '0');
INSERT INTO `dealer` VALUES ('100', '521', '613', '136', '521', '0');
INSERT INTO `dealer` VALUES ('106', '1', '123', '1', '214', '0');

-- ----------------------------
-- Table structure for login
-- ----------------------------
DROP TABLE IF EXISTS `login`;
CREATE TABLE `login` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `type` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `username` (`username`),
  KEY `password` (`password`),
  KEY `type` (`type`),
  KEY `userid` (`userid`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of login
-- ----------------------------
INSERT INTO `login` VALUES ('1', 'admin', 'e10adc3949ba59abbe56e057f20f883e', '1', '0');

-- ----------------------------
-- Table structure for merchant
-- ----------------------------
DROP TABLE IF EXISTS `merchant`;
CREATE TABLE `merchant` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 NOT NULL,
  `phone` char(11) NOT NULL,
  `business_license` varchar(255) NOT NULL COMMENT '营业执照',
  `company` varchar(255) CHARACTER SET utf8 NOT NULL,
  `address` varchar(255) CHARACTER SET utf8 NOT NULL,
  `dealer_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `name` (`name`),
  KEY `phone` (`phone`),
  KEY `business_license` (`business_license`),
  KEY `company` (`company`),
  KEY `address` (`address`),
  KEY `dealer_id` (`dealer_id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of merchant
-- ----------------------------
INSERT INTO `merchant` VALUES ('3', '章抗', '13195520860', '13195520860', '章抗', '章抗', '75');
INSERT INTO `merchant` VALUES ('4', '张康152', '13195520860', '13195520860', '张康152', '张康152', '75');
INSERT INTO `merchant` VALUES ('5', '张康1', '13195520860', '13195520860', '张康1', '张康1', '76');
INSERT INTO `merchant` VALUES ('6', '张康1132', '13195520860', '13195520860', '张康1', '张康1', '77');
INSERT INTO `merchant` VALUES ('7', '1张康152', '13195520860', '13195520860', '1张康152', '1张康152', '100');
INSERT INTO `merchant` VALUES ('12', '`144', '4235', '235532', '235', '235', '75');

-- ----------------------------
-- Table structure for program
-- ----------------------------
DROP TABLE IF EXISTS `program`;
CREATE TABLE `program` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `appid` char(30) NOT NULL,
  `merchant_id` int(11) NOT NULL,
  `name` varchar(255) CHARACTER SET utf8 NOT NULL,
  `type` int(1) NOT NULL,
  `secret` varchar(255) NOT NULL,
  `mchid` int(11) NOT NULL,
  `paykey` varchar(255) NOT NULL,
  `rate` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `appid` (`appid`),
  KEY `merchant_id` (`merchant_id`),
  KEY `name` (`name`),
  KEY `type` (`type`),
  KEY `secret` (`secret`),
  KEY `mchid` (`mchid`),
  KEY `paykey` (`paykey`),
  KEY `rate` (`rate`)
) ENGINE=MyISAM AUTO_INCREMENT=31 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of program
-- ----------------------------
INSERT INTO `program` VALUES ('1', 'wxa03a920155fd067e', '4', '测试', '1', '124214', '124', '124', '6');
INSERT INTO `program` VALUES ('2', '222', '5', '啊啊啊', '2', '123123', '421421', '421', '3');
INSERT INTO `program` VALUES ('3', '333', '6', '嘻嘻嘻嘻', '3', '123321', '213213', '132321', '3');
INSERT INTO `program` VALUES ('4', '444', '7', '阿斯頓', '1', '223231', '421', '12', '3');
INSERT INTO `program` VALUES ('15', 'sasd', '12', 'sad', '1', '214', '124', '124', '3');
INSERT INTO `program` VALUES ('13', '555', '3', '章抗1', '2', '5656', '5656', '5656', '3');
INSERT INTO `program` VALUES ('14', '124142', '12', '512', '1', '124', '251', '125', '3');
INSERT INTO `program` VALUES ('16', '421', '3', '214', '4', '214', '241', '214', '241');
INSERT INTO `program` VALUES ('17', '241', '3', '241', '1', '214', '241', '124', '124');
INSERT INTO `program` VALUES ('18', '521', '3', '125', '4', '215', '521', '521', '215');
INSERT INTO `program` VALUES ('19', '124', '3', '412', '3', '412', '421', '412', '124');
INSERT INTO `program` VALUES ('20', '124', '3', '412', '2', '421', '214', '421', '421');
INSERT INTO `program` VALUES ('30', '142', '5', '124', '1', '241', '421', '214', '421');
INSERT INTO `program` VALUES ('29', '23', '4', '12', '3', '124', '214', '241', '421');

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `faceimg` varchar(255) DEFAULT NULL,
  `nickname` varchar(50) DEFAULT NULL,
  `sex` int(1) DEFAULT NULL,
  `phone` char(11) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `openid` char(28) NOT NULL,
  `addtime` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`),
  KEY `phone` (`phone`),
  KEY `openid` (`openid`)
) ENGINE=InnoDB AUTO_INCREMENT=140 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES ('131', 'https://wx.qlogo.cn/mmopen/vi_32/Q0j4TwGTfTIqVfNK7RM8aPrV2badpCpAMibw8qjK2PXaTo2MHfUcsYLzVwjvOxGr53FCbKvTiaeJKpiaOgbgGJRUQ/132', 'Wk9LTw==', '1', '13195520860', '1', 'oWgbH5UbksALuGiPWafp3F0ozjfI', '1537926669');
INSERT INTO `users` VALUES ('132', 'https://wx.qlogo.cn/mmopen/vi_32/QGjrTLmkicj9hxJEu5tA0PH4icuTe5d255xkm2eYlmToeevsY2ibfPIAibCEB5PIWia0VIcByCYQwSxypKg7x2nWGzA/132', '6Ieq54S25qK16JKC5YaI', '1', '17621711660', 'Jiaxing', 'oWgbH5fypV8_DSjg1tSmovNlxOfA', '1537927037');
INSERT INTO `users` VALUES ('134', 'https://wx.qlogo.cn/mmopen/vi_32/Q0j4TwGTfTJHkKW3Qj0Jjq9LiaeS01AzQ2XyicduemLgYAz2vAib2QrXicZE4GVTMmaDTAgI0cKwoTHN1dvOlbuwYw/132', 'QW5zd2Vy', '1', '13277675919', 'Qianjiang', 'oWgbH5Z5CkYVcDrHEhVZw5wRWBO0', '1537930099');
INSERT INTO `users` VALUES ('137', 'https://wx.qlogo.cn/mmopen/vi_32/Q0j4TwGTfTLg9K3fgoDJ3sfibcNuljxyod2NXQQ4JScTpfGNd126766ROyHHIzx2IbmAYFqzz6R3E0hk7f97ZAA/132', '6ZW/5Y2/', '1', '15000717175', 'Hangzhou', 'oXxhW43VeXelwgyMm-BTtfIUCsuA', '1538015333');
INSERT INTO `users` VALUES ('138', 'https://wx.qlogo.cn/mmopen/vi_32/Q0j4TwGTfTLErrYJcYIjkj3ZRq5BmbefvCAOAotBF5PQMYRvaS2QcVIkCtItgj3X8XuqIJnoibNpgvt5PR2mribg/132', 'QW5zd2Vy', '1', '13277675918', 'Qianjiang', 'oXxhW43R1FbZH3_ldEds_0KQLYFc', '1538016132');

-- ----------------------------
-- Table structure for user_coupon
-- ----------------------------
DROP TABLE IF EXISTS `user_coupon`;
CREATE TABLE `user_coupon` (
  `userid` int(11) NOT NULL,
  `coupon_id` int(11) NOT NULL,
  `usetime` varchar(255) DEFAULT NULL,
  `order_num` varchar(25) DEFAULT NULL,
  KEY `userid` (`userid`),
  KEY `coupon_id` (`coupon_id`),
  KEY `usetime` (`usetime`),
  KEY `order_num` (`order_num`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of user_coupon
-- ----------------------------
INSERT INTO `user_coupon` VALUES ('135', '17', null, null);
INSERT INTO `user_coupon` VALUES ('134', '17', null, null);
INSERT INTO `user_coupon` VALUES ('134', '16', null, null);
INSERT INTO `user_coupon` VALUES ('134', '21', null, null);
INSERT INTO `user_coupon` VALUES ('132', '21', null, null);
INSERT INTO `user_coupon` VALUES ('135', '21', null, null);
INSERT INTO `user_coupon` VALUES ('133', '21', null, null);
INSERT INTO `user_coupon` VALUES ('135', '17', null, null);
INSERT INTO `user_coupon` VALUES ('135', '17', null, null);
INSERT INTO `user_coupon` VALUES ('131', '9', null, null);
INSERT INTO `user_coupon` VALUES ('135', '16', null, null);
INSERT INTO `user_coupon` VALUES ('138', '16', null, null);
INSERT INTO `user_coupon` VALUES ('132', '16', null, null);
INSERT INTO `user_coupon` VALUES ('132', '17', null, null);
INSERT INTO `user_coupon` VALUES ('132', '17', null, null);

-- ----------------------------
-- Table structure for user_pro
-- ----------------------------
DROP TABLE IF EXISTS `user_pro`;
CREATE TABLE `user_pro` (
  `userid` int(11) NOT NULL,
  `openid` char(28) NOT NULL,
  `appid` char(18) NOT NULL,
  KEY `userid` (`userid`),
  KEY `openid` (`openid`),
  KEY `appid` (`appid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of user_pro
-- ----------------------------
INSERT INTO `user_pro` VALUES ('137', 'oXxhW43VeXelwgyMm-BTtfIUCsuA', 'wx02b49e01264b7b85');
INSERT INTO `user_pro` VALUES ('132', 'oWgbH5fypV8_DSjg1tSmovNlxOfA', 'wxa03a920155fd067e');
INSERT INTO `user_pro` VALUES ('131', 'oWgbH5UbksALuGiPWafp3F0ozjfI', 'wxa03a920155fd067e');
INSERT INTO `user_pro` VALUES ('134', 'oWgbH5Z5CkYVcDrHEhVZw5wRWBO0', 'wxa03a920155fd067e');
INSERT INTO `user_pro` VALUES ('138', 'oXxhW43R1FbZH3_ldEds_0KQLYFc', 'wxa03a920155fd067e');
INSERT INTO `user_pro` VALUES ('139', 'oXxhW4zKRgSQ_9Fe5Z0GWzeF78dc', 'wxa03a920155fd067e');
