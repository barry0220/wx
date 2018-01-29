/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50553
Source Host           : localhost:3306
Source Database       : db_gym_database

Target Server Type    : MYSQL
Target Server Version : 50553
File Encoding         : 65001

Date: 2018-01-29 14:54:00
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for a_user
-- ----------------------------
DROP TABLE IF EXISTS `a_user`;
CREATE TABLE `a_user` (
  `id` int(11) NOT NULL,
  `open_id` int(11) NOT NULL COMMENT '用户openID 唯一',
  `vip_card` varchar(255) NOT NULL DEFAULT '' COMMENT 'VIP卡号',
  `user_name` varchar(255) NOT NULL DEFAULT '' COMMENT '用户名称',
  `head_image` varchar(255) NOT NULL DEFAULT '' COMMENT '用户头像',
  `location_sheng` varchar(255) NOT NULL DEFAULT '' COMMENT '微信省位置',
  `location_shi` varchar(255) NOT NULL DEFAULT '' COMMENT '微信市位置',
  `real_name` varchar(255) NOT NULL DEFAULT '' COMMENT '真实姓名',
  `phone` varchar(255) NOT NULL DEFAULT '' COMMENT '手机号码',
  `birthday` varchar(255) NOT NULL DEFAULT '' COMMENT '出生日期',
  `sheng` varchar(255) NOT NULL DEFAULT '' COMMENT '所在省',
  `shi` varchar(255) NOT NULL DEFAULT '' COMMENT '所在市',
  `address` varchar(255) NOT NULL DEFAULT '' COMMENT '详细地址/收货地址',
  `effect` varchar(255) NOT NULL DEFAULT '' COMMENT '影响力指数',
  `is_first` int(11) NOT NULL DEFAULT '1' COMMENT '是否首次分享 1首次分享 2非首次',
  `is_active` int(11) NOT NULL DEFAULT '1' COMMENT '是否激活 1未激活 2已激活',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of a_user
-- ----------------------------
