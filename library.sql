/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : library

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2017-01-10 21:37:38
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

-- ----------------------------
-- Table structure for agrees
-- ----------------------------
DROP TABLE IF EXISTS `agrees`;
CREATE TABLE `agrees` (
  `agreeId` int(11) NOT NULL AUTO_INCREMENT,
  `studentsId` varchar(100) NOT NULL,
  `recomId` int(11) NOT NULL,
  `memo` text,
  PRIMARY KEY (`agreeId`),
  KEY `cxv` (`studentsId`),
  KEY `ccc` (`recomId`),
  CONSTRAINT `ccc` FOREIGN KEY (`recomId`) REFERENCES `recommends` (`recomId`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `cxv` FOREIGN KEY (`studentsId`) REFERENCES `students` (`studentId`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of agrees
-- ----------------------------

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

-- ----------------------------
-- Table structure for campus
-- ----------------------------
DROP TABLE IF EXISTS `campus`;
CREATE TABLE `campus` (
  `campusId` int(11) NOT NULL AUTO_INCREMENT,
  `campusName` varchar(100) NOT NULL,
  `memo` text,
  PRIMARY KEY (`campusId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of campus
-- ----------------------------

-- ----------------------------
-- Table structure for category
-- ----------------------------
DROP TABLE IF EXISTS `category`;
CREATE TABLE `category` (
  `cateId` int(11) NOT NULL AUTO_INCREMENT,
  `cateName` varchar(100) NOT NULL,
  `memo` text,
  PRIMARY KEY (`cateId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of category
-- ----------------------------

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of floors
-- ----------------------------

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
  `logDate` date NOT NULL,
  `logAddr` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`logId`),
  KEY `asdasd` (`studentId`),
  CONSTRAINT `asdasd` FOREIGN KEY (`studentId`) REFERENCES `students` (`studentId`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of loginfo
-- ----------------------------

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of orders
-- ----------------------------

-- ----------------------------
-- Table structure for owe
-- ----------------------------
DROP TABLE IF EXISTS `owe`;
CREATE TABLE `owe` (
  `oweId` int(11) NOT NULL AUTO_INCREMENT,
  `studentId` varchar(100) NOT NULL,
  `bookId` varchar(100) NOT NULL,
  `season` text NOT NULL,
  `oweMoney` float NOT NULL,
  `repay` float NOT NULL,
  `memo` text,
  PRIMARY KEY (`oweId`),
  KEY `ds` (`studentId`),
  KEY `asdsa` (`bookId`),
  CONSTRAINT `asdsa` FOREIGN KEY (`bookId`) REFERENCES `books` (`bookId`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `ds` FOREIGN KEY (`studentId`) REFERENCES `students` (`studentId`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of owe
-- ----------------------------

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
  `recomDate` date NOT NULL,
  `agree` int(11) NOT NULL,
  `recomType` varchar(255) NOT NULL,
  `memo` text,
  PRIMARY KEY (`recomId`),
  KEY `fa` (`studentId`),
  CONSTRAINT `fa` FOREIGN KEY (`studentId`) REFERENCES `students` (`studentId`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of recommends
-- ----------------------------

-- ----------------------------
-- Table structure for records
-- ----------------------------
DROP TABLE IF EXISTS `records`;
CREATE TABLE `records` (
  `recordId` int(11) NOT NULL AUTO_INCREMENT,
  `studentId` varchar(100) NOT NULL,
  `bookId` varchar(100) NOT NULL,
  `startDate` date NOT NULL,
  `endDate` date DEFAULT NULL,
  `orverdu` int(11) DEFAULT NULL,
  `memo` text,
  PRIMARY KEY (`recordId`),
  KEY `c` (`studentId`),
  KEY `cc` (`bookId`),
  CONSTRAINT `c` FOREIGN KEY (`studentId`) REFERENCES `students` (`studentId`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `cc` FOREIGN KEY (`bookId`) REFERENCES `books` (`bookId`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of records
-- ----------------------------

-- ----------------------------
-- Table structure for students
-- ----------------------------
DROP TABLE IF EXISTS `students`;
CREATE TABLE `students` (
  `studentId` varchar(100) NOT NULL,
  `studentName` varchar(100) NOT NULL,
  `passwd` varchar(100) NOT NULL,
  `photo` varchar(100) DEFAULT NULL,
  `tel` varchar(100) DEFAULT NULL,
  `memo` text,
  PRIMARY KEY (`studentId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of students
-- ----------------------------
