/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : library

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2017-01-20 00:48:05
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for admin
-- ----------------------------
DROP TABLE IF EXISTS `admin`;
CREATE TABLE `admin` (
  `adminId` varchar(100) NOT NULL,
  `adminName` varchar(100) DEFAULT NULL,
  `passwd` varchar(100) NOT NULL,
  `adminType` varchar(100) NOT NULL,
  `tel` varchar(100) DEFAULT NULL,
  `campusId` int(11) DEFAULT NULL,
  `memo` text,
  PRIMARY KEY (`adminId`),
  KEY `asd` (`campusId`),
  CONSTRAINT `asd` FOREIGN KEY (`campusId`) REFERENCES `campus` (`campusId`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of admin
-- ----------------------------
INSERT INTO `admin` VALUES ('zz', 'sxh', 'zz', '超级管理员', null, null, null);

-- ----------------------------
-- Table structure for agrees
-- ----------------------------
DROP TABLE IF EXISTS `agrees`;
CREATE TABLE `agrees` (
  `agreeId` int(11) NOT NULL AUTO_INCREMENT,
  `studentsId` varchar(100) NOT NULL,
  `recomId` int(11) NOT NULL DEFAULT '0',
  `memo` text,
  PRIMARY KEY (`agreeId`),
  KEY `cxv` (`studentsId`),
  KEY `ccc` (`recomId`),
  CONSTRAINT `ccc` FOREIGN KEY (`recomId`) REFERENCES `recommends` (`recomId`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `cxv` FOREIGN KEY (`studentsId`) REFERENCES `students` (`studentId`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of agrees
-- ----------------------------
INSERT INTO `agrees` VALUES ('1', '95827', '1', null);
INSERT INTO `agrees` VALUES ('2', '95108', '1', null);
INSERT INTO `agrees` VALUES ('3', '95108', '5', null);

-- ----------------------------
-- Table structure for books
-- ----------------------------
DROP TABLE IF EXISTS `books`;
CREATE TABLE `books` (
  `bookId` varchar(100) NOT NULL,
  `bookName` varchar(100) NOT NULL,
  `author` varchar(100) DEFAULT NULL,
  `press` varchar(100) DEFAULT NULL,
  `pressDate` date DEFAULT NULL,
  `pages` int(11) DEFAULT NULL,
  `language` varchar(100) DEFAULT NULL,
  `ibsn` varchar(100) DEFAULT NULL,
  `price` float DEFAULT NULL,
  `theme` varchar(100) DEFAULT NULL,
  `series` varchar(100) DEFAULT NULL,
  `summary` varchar(100) DEFAULT NULL,
  `number` int(11) DEFAULT NULL,
  `authorIntr` text,
  `menu` text,
  `cateId` int(11) NOT NULL,
  `floorId` int(11) NOT NULL,
  `addr` varchar(100) NOT NULL,
  `keyword` varchar(100) DEFAULT NULL,
  `inputDate` date DEFAULT NULL,
  `adminId` varchar(100) NOT NULL,
  `memo` text,
  PRIMARY KEY (`bookId`),
  KEY `a1` (`adminId`),
  KEY `a2` (`cateId`),
  KEY `a3` (`floorId`),
  CONSTRAINT `a1` FOREIGN KEY (`adminId`) REFERENCES `admin` (`adminId`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `a2` FOREIGN KEY (`cateId`) REFERENCES `category` (`cateId`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `a3` FOREIGN KEY (`floorId`) REFERENCES `floors` (`floorId`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of books
-- ----------------------------
INSERT INTO `books` VALUES ('t123', '图解CSS3', '大漠', '机械工业出版社', '2014-01-01', '10000', '中文', '978-7-111-46920-9', '79', null, null, null, null, null, null, '1', '1', '35架', null, '2017-01-15', 'zz', null);

-- ----------------------------
-- Table structure for campus
-- ----------------------------
DROP TABLE IF EXISTS `campus`;
CREATE TABLE `campus` (
  `campusId` int(11) NOT NULL AUTO_INCREMENT,
  `campusName` varchar(100) NOT NULL,
  `memo` text,
  PRIMARY KEY (`campusId`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of campus
-- ----------------------------
INSERT INTO `campus` VALUES ('1', '花溪校区', null);
INSERT INTO `campus` VALUES ('2', '两江校区', null);

-- ----------------------------
-- Table structure for category
-- ----------------------------
DROP TABLE IF EXISTS `category`;
CREATE TABLE `category` (
  `cateId` int(11) NOT NULL AUTO_INCREMENT,
  `cateName` varchar(100) NOT NULL,
  `memo` text,
  PRIMARY KEY (`cateId`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of category
-- ----------------------------
INSERT INTO `category` VALUES ('1', '计算机类', null);
INSERT INTO `category` VALUES ('2', '数学类', null);

-- ----------------------------
-- Table structure for default
-- ----------------------------
DROP TABLE IF EXISTS `default`;
CREATE TABLE `default` (
  `key_` varchar(100) DEFAULT NULL,
  `value_` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of default
-- ----------------------------
INSERT INTO `default` VALUES ('时长', '1');
INSERT INTO `default` VALUES ('超期单价', '0.1');

-- ----------------------------
-- Table structure for floors
-- ----------------------------
DROP TABLE IF EXISTS `floors`;
CREATE TABLE `floors` (
  `floorId` int(11) NOT NULL AUTO_INCREMENT,
  `floorName` varchar(100) NOT NULL,
  `shelf` int(11) NOT NULL,
  `campusId` int(11) NOT NULL,
  `memo` text,
  PRIMARY KEY (`floorId`),
  KEY `qwe` (`campusId`),
  CONSTRAINT `qwe` FOREIGN KEY (`campusId`) REFERENCES `campus` (`campusId`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of floors
-- ----------------------------
INSERT INTO `floors` VALUES ('1', '一楼', '50', '1', null);

-- ----------------------------
-- Table structure for keyvalues
-- ----------------------------
DROP TABLE IF EXISTS `keyvalues`;
CREATE TABLE `keyvalues` (
  `kvId` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `content` text NOT NULL,
  `kvDate` date NOT NULL,
  `memo` text,
  PRIMARY KEY (`kvId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of keyvalues
-- ----------------------------

-- ----------------------------
-- Table structure for loginfo
-- ----------------------------
DROP TABLE IF EXISTS `loginfo`;
CREATE TABLE `loginfo` (
  `logId` int(11) NOT NULL AUTO_INCREMENT,
  `studentId` varchar(100) NOT NULL,
  `logDate` datetime NOT NULL,
  `logAddr` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`logId`),
  KEY `asdasd` (`studentId`),
  CONSTRAINT `asdasd` FOREIGN KEY (`studentId`) REFERENCES `students` (`studentId`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of loginfo
-- ----------------------------
INSERT INTO `loginfo` VALUES ('24', '95827', '2017-01-19 00:00:00', '');
INSERT INTO `loginfo` VALUES ('25', '95827', '2017-01-19 17:04:50', '');
INSERT INTO `loginfo` VALUES ('26', '95827', '2017-01-19 17:05:25', '');
INSERT INTO `loginfo` VALUES ('27', '95827', '2017-01-19 17:06:51', '');
INSERT INTO `loginfo` VALUES ('28', '95827', '2017-01-20 00:08:19', '');
INSERT INTO `loginfo` VALUES ('29', '95827', '2017-01-20 00:43:54', '');
INSERT INTO `loginfo` VALUES ('30', '95827', '2017-01-20 00:44:53', '');
INSERT INTO `loginfo` VALUES ('31', '95827', '2017-01-20 00:45:33', '');
INSERT INTO `loginfo` VALUES ('32', '95827', '2017-01-20 00:46:11', '');

-- ----------------------------
-- Table structure for news
-- ----------------------------
DROP TABLE IF EXISTS `news`;
CREATE TABLE `news` (
  `newId` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `content` text NOT NULL,
  `newsDate` date NOT NULL,
  `newsType` varchar(100) NOT NULL,
  `adminId` varchar(100) NOT NULL,
  `memo` text,
  PRIMARY KEY (`newId`),
  KEY `asdff` (`adminId`),
  CONSTRAINT `asdff` FOREIGN KEY (`adminId`) REFERENCES `admin` (`adminId`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of news
-- ----------------------------

-- ----------------------------
-- Table structure for options
-- ----------------------------
DROP TABLE IF EXISTS `options`;
CREATE TABLE `options` (
  `image` varchar(100) DEFAULT NULL,
  `footer` text,
  `memo` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of options
-- ----------------------------

-- ----------------------------
-- Table structure for orders
-- ----------------------------
DROP TABLE IF EXISTS `orders`;
CREATE TABLE `orders` (
  `orderId` int(11) NOT NULL AUTO_INCREMENT,
  `studentsId` varchar(100) NOT NULL,
  `bookId` varchar(100) DEFAULT NULL,
  `orderDate` date NOT NULL,
  `orderType` varchar(100) NOT NULL,
  `memo` text,
  PRIMARY KEY (`orderId`),
  KEY `ddd` (`studentsId`),
  KEY `xc` (`bookId`),
  CONSTRAINT `ddd` FOREIGN KEY (`studentsId`) REFERENCES `students` (`studentId`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `xc` FOREIGN KEY (`bookId`) REFERENCES `books` (`bookId`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of orders
-- ----------------------------
INSERT INTO `orders` VALUES ('1', '95827', 't123', '2017-01-15', '已取消', null);
INSERT INTO `orders` VALUES ('2', '95827', 't123', '2017-01-14', '待生效', null);

-- ----------------------------
-- Table structure for owe
-- ----------------------------
DROP TABLE IF EXISTS `owe`;
CREATE TABLE `owe` (
  `oweId` int(11) NOT NULL AUTO_INCREMENT,
  `recordId` int(100) NOT NULL,
  `season` text NOT NULL,
  `oweMoney` float NOT NULL,
  `repay` float NOT NULL,
  `oweDate` date NOT NULL,
  `memo` text,
  PRIMARY KEY (`oweId`),
  KEY `asdasdasd` (`recordId`),
  CONSTRAINT `asdasdasd` FOREIGN KEY (`recordId`) REFERENCES `records` (`recordId`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of owe
-- ----------------------------
INSERT INTO `owe` VALUES ('6', '6', '所借书籍超期', '0.5', '0.5', '0000-00-00', null);
INSERT INTO `owe` VALUES ('7', '9', '所借书籍超期', '0.1', '0.1', '0000-00-00', null);

-- ----------------------------
-- Table structure for recommends
-- ----------------------------
DROP TABLE IF EXISTS `recommends`;
CREATE TABLE `recommends` (
  `recomId` int(11) NOT NULL AUTO_INCREMENT,
  `studentId` varchar(100) NOT NULL,
  `bookName` varchar(100) NOT NULL,
  `author` varchar(255) DEFAULT NULL,
  `language` varchar(100) DEFAULT NULL,
  `ibsn` varchar(100) NOT NULL,
  `reason` text NOT NULL,
  `press` varchar(100) DEFAULT NULL,
  `recomDate` date NOT NULL,
  `agree` int(11) NOT NULL,
  `recomType` varchar(255) NOT NULL,
  `memo` text,
  PRIMARY KEY (`recomId`),
  KEY `fa` (`studentId`),
  CONSTRAINT `fa` FOREIGN KEY (`studentId`) REFERENCES `students` (`studentId`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of recommends
-- ----------------------------
INSERT INTO `recommends` VALUES ('1', '95827', 'javascript从入门到放弃', '雷迪嘎嘎', '英文', '123-456-789-123', '这这本书啊非常的好这本书啊非常的好本书啊非常的这这本书啊非常的好这本书啊非常的好本书啊非常的好这这本书啊非常的好这本书啊非常的好本书啊非常的好好', '人民出版社', '2017-01-18', '2', '未购买', null);
INSERT INTO `recommends` VALUES ('3', '95827', '浅谈css', '泵下卡拉卡', '中文', '456-14231-132', '这这本书啊非常的好这本书啊非常的好本书啊非常的这这本书啊非常的好这本书啊非常的好本书啊非常的好这这本书啊非常的好这本书啊非常的好本书啊非常的好好', '上海出版社', '2017-01-17', '0', '已购买', null);
INSERT INTO `recommends` VALUES ('4', '95827', 'javascript从入门到放弃', '雷迪嘎嘎', '英文', '123-456-789-123', '这这本书啊非常的好这本书啊非常的好本书啊非常的这这本书啊非常的好这本书啊非常的好本书啊非常的好这这本书啊非常的好这本书啊非常的好本书啊非常的好好', '人民出版社', '2017-01-18', '0', '未购买', '');
INSERT INTO `recommends` VALUES ('5', '95108', '红楼梦', '施耐庵', null, '1123-45664-213', '去玩儿退欧浦自行车VB你们爱上对方过后就哭了', '北京出版社', '2017-01-18', '1', '未购买', null);

-- ----------------------------
-- Table structure for records
-- ----------------------------
DROP TABLE IF EXISTS `records`;
CREATE TABLE `records` (
  `recordId` int(11) NOT NULL AUTO_INCREMENT,
  `studentId` varchar(100) NOT NULL,
  `bookId` varchar(100) NOT NULL,
  `startDate` date NOT NULL,
  `destine` date NOT NULL,
  `endDate` date DEFAULT NULL,
  `renew` int(11) DEFAULT '0',
  `memo` text,
  PRIMARY KEY (`recordId`),
  KEY `c` (`studentId`),
  KEY `cc` (`bookId`),
  CONSTRAINT `c` FOREIGN KEY (`studentId`) REFERENCES `students` (`studentId`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `cc` FOREIGN KEY (`bookId`) REFERENCES `books` (`bookId`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of records
-- ----------------------------
INSERT INTO `records` VALUES ('3', '95827', 't123', '2016-12-15', '2017-01-01', null, '1', null);
INSERT INTO `records` VALUES ('4', '95827', 't123', '2017-01-12', '2017-02-17', null, '1', null);
INSERT INTO `records` VALUES ('5', '95827', 't123', '2016-12-01', '2017-01-17', '2017-01-16', '1', null);
INSERT INTO `records` VALUES ('6', '95827', 't123', '2016-11-24', '2017-01-12', '2017-01-17', '2', null);
INSERT INTO `records` VALUES ('9', '95827', 't123', '2016-12-22', '2017-01-17', '2017-01-18', '2', null);
INSERT INTO `records` VALUES ('10', '95108', 't123', '2017-01-19', '2017-01-19', '2017-01-19', '0', null);

-- ----------------------------
-- Table structure for students
-- ----------------------------
DROP TABLE IF EXISTS `students`;
CREATE TABLE `students` (
  `studentId` varchar(100) NOT NULL,
  `studentName` varchar(100) NOT NULL,
  `passwd` varchar(100) NOT NULL,
  `photo` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  `qq` varchar(100) DEFAULT NULL,
  `tel` varchar(100) DEFAULT NULL,
  `money` float NOT NULL DEFAULT '0',
  `memo` text,
  PRIMARY KEY (`studentId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of students
-- ----------------------------
INSERT INTO `students` VALUES ('95108', '崽崽', '123456', 'imgs/header.png', null, null, null, null, '0', null);
INSERT INTO `students` VALUES ('95827', '昵好', '123456', 'imgs/h2.png', '1607074855@qq.com', '重庆理工大学', '1607074855', '15310274364', '0', null);
