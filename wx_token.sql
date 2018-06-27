/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50553
Source Host           : localhost:3306
Source Database       : wx_token

Target Server Type    : MYSQL
Target Server Version : 50553
File Encoding         : 65001

Date: 2018-04-04 16:28:33
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for wx_info
-- ----------------------------
DROP TABLE IF EXISTS `wx_info`;
CREATE TABLE `wx_info` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `url` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `key` varchar(100) NOT NULL,
  `token` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of wx_info
-- ----------------------------
INSERT INTO `wx_info` VALUES ('2', 'www.lexong.com', '宁化通', 'C3A85C384206440ADF8B7EFCDF7C5FB7', '21FCC98376B0E6EF22E5E4282BB306BD');

-- ----------------------------
-- Table structure for wx_info_order
-- ----------------------------
DROP TABLE IF EXISTS `wx_info_order`;
CREATE TABLE `wx_info_order` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `order_sn` varchar(100) NOT NULL,
  `token` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of wx_info_order
-- ----------------------------
INSERT INTO `wx_info_order` VALUES ('1', 'des3', 'B429789EB692567BC52000F6A732C661');
