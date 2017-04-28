/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : library

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2017-04-28 17:17:27
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
  `memo` text,
  PRIMARY KEY (`adminId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of admin
-- ----------------------------
INSERT INTO `admin` VALUES ('weish', 'wsj', 'wwwwww', '超级管理员', null);
INSERT INTO `admin` VALUES ('zz', 'sxh', 'zzzzzz', '超级管理员', null);

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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of agrees
-- ----------------------------
INSERT INTO `agrees` VALUES ('1', '95827', '1', null);
INSERT INTO `agrees` VALUES ('2', '95108', '1', null);
INSERT INTO `agrees` VALUES ('3', '95108', '5', null);
INSERT INTO `agrees` VALUES ('4', '95827', '4', null);
INSERT INTO `agrees` VALUES ('5', '95108', '4', null);
INSERT INTO `agrees` VALUES ('6', '95827', '5', null);

-- ----------------------------
-- Table structure for books
-- ----------------------------
DROP TABLE IF EXISTS `books`;
CREATE TABLE `books` (
  `booksId` varchar(100) NOT NULL,
  `bookName` varchar(100) NOT NULL,
  `img` varchar(100) DEFAULT NULL,
  `author` varchar(100) NOT NULL,
  `press` varchar(100) DEFAULT NULL,
  `pressDate` date DEFAULT NULL,
  `pages` int(11) DEFAULT NULL,
  `language` varchar(100) DEFAULT NULL,
  `ibsn` varchar(100) DEFAULT NULL,
  `price` float DEFAULT NULL,
  `theme` varchar(100) DEFAULT NULL,
  `series` varchar(100) DEFAULT NULL,
  `summary` varchar(100) DEFAULT NULL,
  `cateId` int(11) NOT NULL,
  `keyword` varchar(100) DEFAULT NULL,
  `inputDate` date DEFAULT NULL,
  `adminId` varchar(100) NOT NULL,
  `memo` text,
  PRIMARY KEY (`booksId`),
  KEY `a1` (`adminId`),
  KEY `a2` (`cateId`),
  CONSTRAINT `a1` FOREIGN KEY (`adminId`) REFERENCES `admin` (`adminId`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `a2` FOREIGN KEY (`cateId`) REFERENCES `category` (`cateId`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of books
-- ----------------------------
INSERT INTO `books` VALUES ('61493359998', '111', 'imgs/7.png', 'wei', '', '0000-00-00', '0', '泰语', '', '0', '', '', '', '6', '', '2017-04-28', 'zz', null);
INSERT INTO `books` VALUES ('t123', '图解CSS3123', 'imgs/1.png', '大漠', '机械工业出版社', '2014-01-01', '10000', '中文', '978-7-111-46920-9', '79', '123', '123', '123', '5', 'css', '2017-04-28', 'zz', null);
INSERT INTO `books` VALUES ('t124', 'javascript从入门到放弃', 'imgs/book-hongloumeng.jpg', '莫言', '清华大学出版社', '2017-04-19', '20000', '泰语', '879-312-1234', '68', '', '', '', '1', 'js  javascript', '2017-04-28', 'zz', null);
INSERT INTO `books` VALUES ('t125', '网络安全从入门到入狱', 'imgs/book-sanguoyanyi.jpg', '莫言', '机械工业出版社', '2014-01-01', '10000', '中文', '978-7-111-46920-9009', '79', '', '', '', '1', '网络安全', '2017-04-28', 'zz', '');
INSERT INTO `books` VALUES ('t126', '23天精通PHP', 'imgs/book-shuihuzhuan.jpg', '莫言', '清华大学出版社', '2017-04-19', '20000', '中文', '879-312-1234', '68', '', '', '', '2', '', '2017-04-19', 'zz', '');
INSERT INTO `books` VALUES ('t127', '西游记', 'imgs/book-xiyouji.jpg', '吴承恩', '机械工业出版社', null, null, '英文', null, null, null, null, null, '2', null, '2017-04-12', 'zz', null);
INSERT INTO `books` VALUES ('t128', '红楼梦', 'imgs/book-hongloumeng.jpg', '曹雪芹', '机械工业出版社', '2014-01-01', '10000', '中文', '978-7-111-46920-9', '79', '', '', '', '1', '', '2017-01-15', 'zz', '');
INSERT INTO `books` VALUES ('t130', '三国演义', 'imgs/book-sanguoyanyi.jpg', '罗贯中', '清华大学出版社', '2017-04-19', '20000', '中文', '879-312-1234', '68', '', '', '', '2', '', '2017-04-19', 'zz', '');
INSERT INTO `books` VALUES ('t131', '水浒传', 'imgs/book-shuihuzhuan.jpg', '施耐庵', '机械工业出版社', '2014-01-01', '10000', '中文', '978-7-111-46920-9', '79', '', '', '', '1', '', '2017-01-15', 'zz', '');
INSERT INTO `books` VALUES ('t132', '红高粱', 'imgs/book-shuihuzhuan.jpg', '莫言', '清华大学出版社', '2017-04-19', '20000', '中文', '879-312-1234', '68', '', '', '', '2', '', '2017-04-19', 'zz', '');
INSERT INTO `books` VALUES ('t133', '背影', 'imgs/book-xiyouji.jpg', '老舍', '机械工业出版社', '0000-00-00', null, '英文', '', null, '', '', '', '2', '', '2017-04-12', 'zz', '');
INSERT INTO `books` VALUES ('t134', '老人与海', 'imgs/book-shuihuzhuan.jpg', '海明威', '机械工业出版社', '2014-01-01', '10000', '中文', '978-7-111-46920-9', '79', '', '', '', '1', '', '2017-01-15', 'zz', '');
INSERT INTO `books` VALUES ('t135', '21天精通ASP', 'imgs/book-xiyouji.jpg', '老舍', '清华大学出版社', '2017-04-19', '20000', '中文', '879-312-1234', '68', '', '', '', '2', '', '2017-04-19', 'zz', '');
INSERT INTO `books` VALUES ('t136', 'react新手入门', 'imgs/book-xiyouji.jpg', '老舍', '机械工业出版社', '2014-01-01', '10000', '中文', '978-7-111-46920-9', '79', '', '', '', '1', '', '2017-01-15', 'zz', '');
INSERT INTO `books` VALUES ('t137', 'jquery经典', 'imgs/book-xiyouji.jpg', '老舍', '清华大学出版社', '2017-04-19', '20000', '中文', '879-312-1234', '68', '', '', '', '2', '', '2017-04-19', 'zz', '');
INSERT INTO `books` VALUES ('t138', 'JavaScript高级程序设计第三版', 'imgs/book-xiyouji.jpg', '莫言', '机械工业出版社', '0000-00-00', null, '英文', '', null, '', '', '', '2', '', '2017-04-12', 'zz', '');

-- ----------------------------
-- Table structure for category
-- ----------------------------
DROP TABLE IF EXISTS `category`;
CREATE TABLE `category` (
  `cateId` int(11) NOT NULL AUTO_INCREMENT,
  `cateName` varchar(100) NOT NULL,
  `memo` text,
  PRIMARY KEY (`cateId`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of category
-- ----------------------------
INSERT INTO `category` VALUES ('1', '计算机类', null);
INSERT INTO `category` VALUES ('2', '数学类', null);
INSERT INTO `category` VALUES ('3', '文言文1', null);
INSERT INTO `category` VALUES ('4', '小说', null);
INSERT INTO `category` VALUES ('5', '瓜皮小说', null);
INSERT INTO `category` VALUES ('6', '神话故事', null);
INSERT INTO `category` VALUES ('7', '政治文明', null);
INSERT INTO `category` VALUES ('8', '自然科学', null);
INSERT INTO `category` VALUES ('9', '动物世界', null);
INSERT INTO `category` VALUES ('10', '心理学123', null);

-- ----------------------------
-- Table structure for default
-- ----------------------------
DROP TABLE IF EXISTS `default`;
CREATE TABLE `default` (
  `key_` varchar(100) DEFAULT NULL,
  `value_` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of default
-- ----------------------------
INSERT INTO `default` VALUES ('时长', '1');
INSERT INTO `default` VALUES ('超期单价', '0.1');
INSERT INTO `default` VALUES ('图书馆概况', '<p class=\"MsoNormal\" style=\"text-align:left;LAYOUT-GRID-MODE: char; MARGIN: 0cm 0cm 0pt; LINE-HEIGHT: 20pt; TEXT-INDENT: 24pt; mso-char-indent-count: 2.0; mso-layout-grid-align: none\"><span style=\"FONT-SIZE: 12pt; FONT-FAMILY: 宋体; mso-ascii-font-family: Calibri; mso-hansi-font-family: Calibri; mso-fareast-font-family: 宋体; mso-bidi-font-weight: bold; mso-ascii-theme-font: minor-latin; mso-fareast-theme-font: minor-fareast; mso-hansi-theme-font: minor-latin\"></span><span style=\"FONT-SIZE: 12pt; mso-bidi-font-weight: bold\"></span></p><p><strong><span style=\"font-family:宋体;FONT-SIZE: 12pt\">1.理工图书馆</span></strong></p><p><span style=\"font-family:宋体;FONT-SIZE: 12pt\">&nbsp;&nbsp;&nbsp; </span><span style=\"font-family: 宋体; font-size: 12pt; text-decoration: underline;\">理工图书馆前身是原重庆大学图书馆，始建于1930年。2014年11月理工图书馆东楼顺利完成装修，整体风格为文艺复古风格，11月3日正式试运行开放。逸夫楼于2015年6月开始装修，11月完工，11月16日正式开放。目前馆舍总面积为17980平方米，提供1185个阅览座位，重点收藏机械、电气、计算机、动力、冶金、咨询、环境、生物、管理工程类，以及社会科学等门类的书刊，基本形成了与我校专业设置相适应，能满足社会多方需求的文献体系。现有中文图书78万余册，外文图书16.7万余册，中文期刊2000余种。此外，还藏有线装古籍近3000册，抗战版书刊4000多册，极具参考价值。馆内设有国家教育部机械类外国教材中心（位于理工图书馆逸夫楼四楼），藏书7.4万余册。</span></p><p><span style=\"font-family:宋体;FONT-SIZE: 12pt\"><br/></span></p><p><strong><span style=\"font-family:宋体;FONT-SIZE: 12pt\">2.建筑图书馆</span></strong></p><p><span style=\"font-family:宋体;FONT-SIZE: 12pt\">&nbsp;&nbsp;&nbsp; 建筑图书馆成立于1952年10月，面积为6196平方米，前身为原重庆建筑大学图书馆。原重庆建筑大学由原西南地区的重庆大学、川北大学、西南工业高等专科学校、成都艺术专科学校等8所大专院校的10个土木、建筑系（科）合并组建，是新中国创办的第一所建筑工程院校。1978年被确定为全国重点大学，在学校成立的同时，集中了上述院校的有关土木、建筑类的图书资料，筹建了该图书馆。建筑图书馆重点收藏土木、建筑类及相关专业的图书文献资料。2000年，原重庆建筑大学合并进入重庆大学。经过2007年的书库改造，建筑图书馆拥有5层书库、3层阅览区（中文建筑图书阅览区、外文建筑书刊阅览区、中文社科期刊阅览区）、研修室3间、无字书屋、建筑类师生作品展室。馆藏书刊均为建筑类学科书刊，与学校建筑类专业设置相适应，现收藏中外文建筑类图书13.6万种、33.37万册，其中中文图书10.2万种、28万册，外文图书3.4万种、5.37万册；并有中外文报刊920种，中外文过刊2906种，中外文过刊合订本49896册。目前，建筑图书馆是西南地区建筑学科重要的图书文献中心。</span></p><p><span style=\"font-family:宋体;FONT-SIZE: 12pt\"><br/></span></p><p><strong><span style=\"font-family:宋体;FONT-SIZE: 12pt\">3.虎溪图书馆</span></strong></p><p><span style=\"font-family:宋体;FONT-SIZE: 12pt\">&nbsp;&nbsp;&nbsp; 虎溪图书馆于于2010年6月正式投入使用，坐落于重庆大学虎溪校区纭湖湖畔，建筑面积约3.6万平方米，大写“L”造型取自英文Library，如“一本打开的红皮书、一把舒适的椅子，一架浪漫的钢琴”。虎溪图书馆现有馆藏图书约96万册，中文期刊1295种，设有自然科学、国家地理、外语专题、特藏图书、期刊、捐赠图书等阅览室，无线网络覆盖所有阅览室及办公区，并拥有多功能报告厅、会议室、研修室等设施。全馆提供4000余个座位供读者阅览使用，同时提供笔记本、学习本、电视机、投影仪、自助打印机、自助复印机等服务设备，研修室、讨论室和会议室等空间服务。</span></p><p><span style=\"font-family:宋体;FONT-SIZE: 12pt\"><br/></span></p><p><strong><span style=\"font-family:宋体;FONT-SIZE: 12pt\">4.历史文献中心</span></strong></p><p><span style=\"font-family:宋体;FONT-SIZE: 12pt\">&nbsp;&nbsp;&nbsp; 历史文献中心位于重庆大学C校区，前身是重庆建筑高等专科学校图书馆，建于1978年，建筑面积5538平方米。目前主要收藏利用率低和出版年份较早的图书、期刊和报纸。现有中文图书14.3万余册、英文图书2.6万余册、日文图书1.2万余册、俄文图书5.9万余册、中文期刊（合订本）10.1万余册、英文期刊（合订本）7.9万余册、俄文期刊（合订本）1.4万余册，另有报纸合订本5284余册。历史文献书刊阅览室有期刊229种、报纸16种，新进畅销类图书约7282册。重大文库新增硕士论文612册，博士论文2806册，博士后论文296册。</span></p><p><span style=\"font-family:宋体;FONT-SIZE: 12pt\"><br/></span></p><p><strong><span style=\"font-family:宋体;FONT-SIZE: 12pt\">5.人文社科图书馆</span></strong></p><p><span style=\"font-family:宋体;FONT-SIZE: 12pt\">&nbsp;&nbsp;&nbsp; 人文社科图书馆成立于2012年6月18日，以虎溪图书馆二楼和四楼作为阅览和藏书场所，系统收藏人文社科类图书。虎溪图书馆二楼作为文科馆基本书库和阅览室，共收藏人文社科类图书18.9万种、33.7万册。虎溪图书馆四楼人文社科特藏阅览室，收藏重要文科图书共计34018种、34221册，主要包括《四库全书》系列、《丛书集成初编》、《二十四史》、《中国地方志丛书》、《中华再造善本》和近现代翻译文学丛书等经典文科图书，还收藏和展示“重大记忆”等特色文献。</span></p><p><span style=\"font-family:宋体;FONT-SIZE: 12pt\"><br/></span></p><p><strong><span style=\"font-family:宋体;FONT-SIZE: 12pt\">6.理学分馆</span></strong></p><p><span style=\"font-family:宋体;FONT-SIZE: 12pt\">&nbsp;&nbsp;&nbsp; 理学分馆由虎溪校区管委会、理学部和图书馆共建，于2015年11月20日正式开馆。作为理学类的专业图书馆，理学分馆建设在虎溪校区新落成的理学院负一楼（如图2.18所示），按照理学部“五个学院、三个中心”的学科设置及文献需求，在理学部师生的帮助下，精选理科类专业书籍万余册，期刊60余种。理学图书馆内布局精致用心，提供阅览座位50余个，配备单人阅览座位和四人阅览座位，另有团队讨论桌、一体机检索台、舒适讨论区。还提供图书借还、打印复印、团队讨论、图书推荐、文献检索、读者培训与咨询等服务。</span></p><p><span style=\"font-family:宋体;FONT-SIZE: 12pt\"><br/></span></p><p><strong><span style=\"font-family:宋体;FONT-SIZE: 12pt\">7.松园书屋</span></strong></p><p><span style=\"font-family:宋体;FONT-SIZE: 12pt\">&nbsp;&nbsp;&nbsp; 松园书屋位于虎溪校区松园一栋一楼（近西一门），是由重大校友捐赠建设，2016年11月8日开馆试运行。现有人文社科类书籍7370册，期刊40余种。松园书屋提供阅览座位80个，并配置自助借还机。读者在这里就如坐在家中的休憩书房，暖洋洋的黄色灯光、厚重复古的木头桌椅、柔软舒适的特制抱枕，还有活泼伶俐的书架布偶和生意盎然的绿色植物。</span></p><p style=\"text-align: center;\"><span style=\"font-family:宋体;FONT-SIZE: 12pt\"><br/></span></p><p style=\"text-align: center;\"><span style=\"font-size: 12pt; font-family: Calibri;\">&nbsp;<img src=\"/ueditor/php/upload/image/20170424/1493026118102088.jpg\" title=\"1493026118102088.jpg\" alt=\"1.jpg\" width=\"889\" height=\"421\"/></span></p><p><span class=\"edui-editor-imagescale-hand1\" style=\"margin: -4px 0px 0px -4px; padding: 0px; position: absolute; width: 6px; height: 6px; overflow: hidden; font-size: 0px; display: block; background-color: rgb(60, 157, 208); cursor: n-resize; top: 0px; left: 640px; font-family: &quot;Microsoft Yahei&quot;;\"></span><span class=\"edui-editor-imagescale-hand2\" style=\"margin: -4px 0px 0px -3px; padding: 0px; position: absolute; width: 6px; height: 6px; overflow: hidden; font-size: 0px; display: block; background-color: rgb(60, 157, 208); cursor: ne-resize; top: 0px; left: 1280px; font-family: &quot;Microsoft Yahei&quot;;\"></span><span class=\"edui-editor-imagescale-hand3\" style=\"margin: -4px 0px 0px -4px; padding: 0px; position: absolute; width: 6px; height: 6px; overflow: hidden; font-size: 0px; display: block; background-color: rgb(60, 157, 208); cursor: w-resize; top: 286px; left: 0px; font-family: &quot;Microsoft Yahei&quot;;\"></span><span class=\"edui-editor-imagescale-hand4\" style=\"margin: -4px 0px 0px -3px; padding: 0px; position: absolute; width: 6px; height: 6px; overflow: hidden; font-size: 0px; display: block; background-color: rgb(60, 157, 208); cursor: e-resize; top: 286px; left: 1280px; font-family: &quot;Microsoft Yahei&quot;;\"></span><span class=\"edui-editor-imagescale-hand5\" style=\"margin: -3px 0px 0px -4px; padding: 0px; position: absolute; width: 6px; height: 6px; overflow: hidden; font-size: 0px; display: block; background-color: rgb(60, 157, 208); cursor: sw-resize; top: 572px; left: 0px; font-family: &quot;Microsoft Yahei&quot;;\"></span></p><p><span style=\"font-size: 12pt; font-family: Calibri;\"></span></p><p class=\"MsoNormal\" style=\"text-align:left;LAYOUT-GRID-MODE: char; MARGIN: 0cm 0cm 0pt; LINE-HEIGHT: 20pt; TEXT-INDENT: 24pt; mso-char-indent-count: 2.0; mso-layout-grid-align: none\">&nbsp;</p><h2 style=\"margin: 0cm 0cm 0pt; line-height: 20pt;\">&nbsp;</h2>');
INSERT INTO `default` VALUES ('电话', '400-8888-888');
INSERT INTO `default` VALUES ('地址', '重庆理工大学花溪校区a');
INSERT INTO `default` VALUES ('楼层数', '12');
INSERT INTO `default` VALUES ('书架数', '60');

-- ----------------------------
-- Table structure for eachbooks
-- ----------------------------
DROP TABLE IF EXISTS `eachbooks`;
CREATE TABLE `eachbooks` (
  `eachId` varchar(100) NOT NULL,
  `booksId` varchar(100) NOT NULL,
  `floor` int(11) NOT NULL,
  `shelfNo` int(11) NOT NULL,
  `addr` varchar(100) NOT NULL,
  `status` varchar(100) NOT NULL DEFAULT '',
  `memo` text,
  PRIMARY KEY (`eachId`),
  KEY `qqqqq` (`booksId`),
  KEY `eeeeeeeee` (`floor`),
  CONSTRAINT `qqqqq` FOREIGN KEY (`booksId`) REFERENCES `books` (`booksId`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of eachbooks
-- ----------------------------
INSERT INTO `eachbooks` VALUES ('614933599984', '61493359998', '6', '15', 'B面1-2', '在馆', null);
INSERT INTO `eachbooks` VALUES ('614933599987', '61493359998', '4', '14', 'A面4-5', '在馆', null);
INSERT INTO `eachbooks` VALUES ('t1232', 't123', '7', '18', 'A面5-6', '预约中', null);
INSERT INTO `eachbooks` VALUES ('t1241', 't124', '1', '22', 'A面5-6', '预约中', null);
INSERT INTO `eachbooks` VALUES ('t1251', 't125', '6', '22', 'A面5-6', '预约中', '');
INSERT INTO `eachbooks` VALUES ('t1262', 't126', '1', '22', 'A面5-6', '在馆', '');
INSERT INTO `eachbooks` VALUES ('t1271', 't127', '1', '22', 'A面5-6', '在馆', '');
INSERT INTO `eachbooks` VALUES ('t1281', 't128', '1', '22', 'A面5-6', '在馆', '');
INSERT INTO `eachbooks` VALUES ('t1301', 't130', '1', '22', 'A面5-6', '在馆', '');
INSERT INTO `eachbooks` VALUES ('t1302', 't130', '1', '22', 'A面5-6', '在馆', '');
INSERT INTO `eachbooks` VALUES ('t1311', 't131', '1', '22', 'A面5-6', '在馆', '');
INSERT INTO `eachbooks` VALUES ('t1322', 't132', '1', '22', 'A面5-6', '在馆', '');
INSERT INTO `eachbooks` VALUES ('t1331', 't133', '1', '22', 'A面5-6', '在馆', '');
INSERT INTO `eachbooks` VALUES ('t1351', 't135', '1', '22', 'A面5-6', '在馆', '');
INSERT INTO `eachbooks` VALUES ('t1361', 't136', '1', '22', 'A面5-6', '在馆', '');
INSERT INTO `eachbooks` VALUES ('t1372', 't137', '1', '22', 'A面5-6', '在馆', '');
INSERT INTO `eachbooks` VALUES ('t1381', 't138', '1', '22', 'A面5-6', '在馆', '');

-- ----------------------------
-- Table structure for floors
-- ----------------------------
DROP TABLE IF EXISTS `floors`;
CREATE TABLE `floors` (
  `floorId` int(11) NOT NULL AUTO_INCREMENT,
  `floorName` varchar(100) NOT NULL,
  `shelf` int(11) NOT NULL,
  `memo` text,
  PRIMARY KEY (`floorId`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of floors
-- ----------------------------
INSERT INTO `floors` VALUES ('1', '一楼', '50', null);

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
) ENGINE=InnoDB AUTO_INCREMENT=66 DEFAULT CHARSET=utf8;

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
INSERT INTO `loginfo` VALUES ('33', '95827', '2017-02-20 10:10:52', '');
INSERT INTO `loginfo` VALUES ('34', '95827', '2017-02-20 10:43:36', '');
INSERT INTO `loginfo` VALUES ('35', '95108', '2017-02-23 13:04:16', '');
INSERT INTO `loginfo` VALUES ('36', '95108', '2017-02-23 13:05:35', '');
INSERT INTO `loginfo` VALUES ('37', '95108', '2017-04-05 22:55:29', '');
INSERT INTO `loginfo` VALUES ('38', '95108', '2017-04-05 22:59:30', '');
INSERT INTO `loginfo` VALUES ('39', '95108', '2017-04-12 16:08:51', '');
INSERT INTO `loginfo` VALUES ('40', '95827', '2017-04-12 20:17:33', '');
INSERT INTO `loginfo` VALUES ('41', '95108', '2017-04-13 14:07:00', '');
INSERT INTO `loginfo` VALUES ('42', '95827', '2017-04-17 09:35:09', '');
INSERT INTO `loginfo` VALUES ('43', '95827', '2017-04-18 08:57:36', '');
INSERT INTO `loginfo` VALUES ('44', '95827', '2017-04-18 10:20:39', '');
INSERT INTO `loginfo` VALUES ('45', '95827', '2017-04-18 10:21:38', '');
INSERT INTO `loginfo` VALUES ('46', '95827', '2017-04-18 13:16:40', '');
INSERT INTO `loginfo` VALUES ('47', '95827', '2017-04-18 13:44:58', '');
INSERT INTO `loginfo` VALUES ('48', '95827', '2017-04-18 13:53:18', '');
INSERT INTO `loginfo` VALUES ('49', '95827', '2017-04-18 14:14:11', '');
INSERT INTO `loginfo` VALUES ('50', '95827', '2017-04-18 14:32:03', '');
INSERT INTO `loginfo` VALUES ('51', '95827', '2017-04-20 16:26:31', '');
INSERT INTO `loginfo` VALUES ('52', '95827', '2017-04-21 09:51:58', '');
INSERT INTO `loginfo` VALUES ('53', '95827', '2017-04-21 04:01:03', '');
INSERT INTO `loginfo` VALUES ('54', '95827', '2017-04-21 04:02:00', '');
INSERT INTO `loginfo` VALUES ('55', '95827', '2017-04-21 09:12:47', '');
INSERT INTO `loginfo` VALUES ('56', '95827', '2017-04-21 09:14:52', '');
INSERT INTO `loginfo` VALUES ('57', '95827', '2017-04-21 11:08:19', '');
INSERT INTO `loginfo` VALUES ('58', '95827', '2017-04-24 02:56:48', '');
INSERT INTO `loginfo` VALUES ('59', '95108', '2017-04-24 02:58:15', '');
INSERT INTO `loginfo` VALUES ('60', '95827', '2017-04-24 03:06:34', '');
INSERT INTO `loginfo` VALUES ('61', '95827', '2017-04-24 03:29:43', '');
INSERT INTO `loginfo` VALUES ('62', '95827', '2017-04-24 04:29:10', '');
INSERT INTO `loginfo` VALUES ('63', '95827', '2017-04-24 08:27:28', '');
INSERT INTO `loginfo` VALUES ('64', '95827', '2017-04-24 08:31:51', '');
INSERT INTO `loginfo` VALUES ('65', '95827', '2017-04-24 09:03:20', '');

-- ----------------------------
-- Table structure for news
-- ----------------------------
DROP TABLE IF EXISTS `news`;
CREATE TABLE `news` (
  `newId` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `content` text NOT NULL,
  `newsDate` date NOT NULL,
  `newsSrc` varchar(100) DEFAULT NULL,
  `newsType` varchar(100) NOT NULL,
  `adminId` varchar(100) NOT NULL,
  `memo` text,
  PRIMARY KEY (`newId`),
  KEY `asdff` (`adminId`),
  CONSTRAINT `asdff` FOREIGN KEY (`adminId`) REFERENCES `admin` (`adminId`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of news
-- ----------------------------
INSERT INTO `news` VALUES ('3', '我校成功举行2017届毕业生“社会工作类”双选会123', '<p style=\"text-align:center;\">　　4月17日下午，由学校招就处主办、重庆知识产权学院承办的2017届毕业生“社会工作类”双选会在第三实验楼招聘大厅成功举行。本次专场双选会聚集了深圳市南山区南风社会工作服务社、重庆市第一社会福利院、重庆仁爱社会工作服务中心、重庆市民悦社会工作服务中心、重庆春语社会工作服务中心、重庆卓越社会组织服务中心、重庆巴南企航社会工作服务中心等43家社会工作专业机构来校延揽人才，提供了全职工作岗位400余个和实习岗位80余个。</p><p style=\"margin-left: auto\">\r\n	　　招聘会场人头攒动，气氛热烈，不少企业展位前都排着长队。学生踊跃投递简历，大方自信地向心仪的招聘单位进行自荐，认真询问招聘需求，自信从容地应对考官的提问。</p><p style=\"margin-left: auto\">\r\n	　　招就处处长赵毅、副处长粟道平、知识产权学院院长苏平、党总支书记龙思红、社会工作系教师、学办老师来到双选会现场与招聘单位面对面深入交流，细致地介绍了社会工作专业人才培养与教学特色，积极向用人单位推荐毕业生和实习生，认真听取招聘单位的用人需求和对人才培养工作的建议；现场为学生开展就业指导和职业发展咨询，勉励学生顺利觅得合适的工作岗位。</p><p style=\"margin-left: auto\">\r\n	　　双选会上，用人单位对我校社会工作专业学生纷纷表示赞赏，普遍认为他们专业知识扎实，实务能力较强，综合素质较高，同时也对专业人才培养工作提出了诸多建议。深圳市南山区南风社会工作服务社面试官指出，社会工作强调实务取向，要求学生能力与知识并重，建议学校强化实习环节的教育，延长实习训练时间；重庆仁爱社会工作服务中心、重庆春语社会工作服务中心、重庆卓越社会组织服务中心等单位的负责人认为，社会工作行业正处于创业的关键时期，在人才培养中，要引导社会工作专业的学生放宽视野，确立大格局意识，培育创新思维，树立创业意识，以创业带动就业，积极主动的推动社会工作事业的发展进步。知识产权学院院长苏平表示，用人单位的意见与建议是对人才培养工作的精准化把脉和诊断，是进一步优化人才培养模式，提升人才培养质量，提高就业竞争力的指南针和方向标。</p><p style=\"margin-left: auto\">\r\n	　　为提升学生实践能力与职业素养，知识产权学院通过多种方法齐抓并举，一是持续开展服务—学习，通过“学校+机构”联合培养，增强学生整合理论与实务的能力；二是抓住应用转型的契机，改革课程教学，切实提升学生的社会工作综合素质；三是强化政产学研联合办学模式，与巴南区政府共建重庆市巴南区社会工作实习（训）基地，通过服务地方，提升师生社会工作专业服务能力，提高学生专业核心竞争力。</p><p style=\"margin-left: auto\">\r\n	　　党的十八大以来，我国社会工作事业发展迅猛，方兴未艾，对社会工作专业人才需求不断增大。本次双选会上已有数十名社会工作专业毕业生和高年级学生与用人单位初步达成了就业与实习意向。知识产权学院领导、学办老师和社会工作专业系教师将持续跟进后续的面试、录用情况，及时掌握社会工作专业机构的需求信息和学生求职动向，全面提升就业工作成效和学生就业质量。</p><p>\r\n	&nbsp;&nbsp;&nbsp;&nbsp;</p><p style=\"text-align: center; margin-left: auto\">\r\n	（文、图/重庆知识产权学院&nbsp;&nbsp;　　　　&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;责编/陈磊）</p><p style=\"text-align: center; margin-left: auto\">\r\n	&nbsp;</p><p style=\"text-align: center\"><a class=\"pic\" href=\"http://news.cqut.edu.cn/attachment/201704/18143044_2017届毕业生社会工作类双选会成功举行.jpg\" target=\"_blank\" title=\"点击查看原图\"><img alt=\"2017届毕业生社会工作类双选会成功举行\" class=\"pic\" src=\"http://news.cqut.edu.cn/attachment/201704/18143044_2017届毕业生社会工作类双选会成功举行_thumb_3.jpg\"/></a></p><p class=\"description\" style=\"text-align: center\">\r\n		我校成功举行2017届毕业生“社会工作类”双选会</p><p style=\"text-align: center\"><a class=\"pic\" href=\"http://news.cqut.edu.cn/attachment/201704/18143049_招就处领导和知产学院领导交流就业工作.jpg\" target=\"_blank\" title=\"点击查看原图\"><img alt=\"招就处领导和知产学院领导交流就业工作\" class=\"pic\" src=\"http://news.cqut.edu.cn/attachment/201704/18143049_招就处领导和知产学院领导交流就业工作_thumb_3.jpg\"/></a></p><p class=\"description\" style=\"text-align: center\">\r\n		招就处领导和知产学院领导交流就业工作</p><p style=\"text-align: center\"><a class=\"pic\" href=\"http://news.cqut.edu.cn/attachment/201704/18143054_知产学院毕业生认真参与面试.jpg\" target=\"_blank\" title=\"点击查看原图\"><img alt=\"知产学院毕业生认真参与面试\" class=\"pic\" src=\"http://news.cqut.edu.cn/attachment/201704/18143054_知产学院毕业生认真参与面试_thumb_3.jpg\"/></a></p><p class=\"description\" style=\"text-align: center\">\r\n		知产学院毕业生认真参与面试</p><p class=\"description\" style=\"text-align: center\">\r\n		&nbsp;</p><p class=\"description\" style=\"text-align: center\">\r\n		&nbsp;</p><p class=\"description\">\r\n		&nbsp;</p><p class=\"description\">\r\n		&nbsp;</p>', '2017-04-26', null, '新闻通知', 'zz', null);
INSERT INTO `news` VALUES ('5', '重庆理工大学老年高等教育工作者协会赴潼南调研考察23', '<p>　　最美人间四月天，重庆直辖二十年；鹤发童颜人未老，一路高歌到潼南。4月13日至14日，重庆理工大学高教老协一行32人，在会长饶宁华率领下，专程前往潼南调研考察。 &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;<br/></p><p>\r\n	　　潼南，是渝西重镇。这里，是中国共产党早期领导人杨闇公烈士诞生地，是中华人民共和国已故主席杨尚昆故里。这里，涪江平阔，大佛庄严，双山拱卫双江古镇，家风清白子承孙传。自重庆直辖二十年来，潼南人民发扬“马蹄铁磨平方休”的奋进精神，勇于开拓，拼搏奋进，使潼南的山河换了新颜。昔日传统的农粮之乡，已经崛起了一座现代工贸果蔬蚕桑新城。此次调研考察，得到了潼南党政领导的热情关怀和大力支持。中共潼南区委副书记江志斌、中共潼南区纪委书记于贵生接待了全体同志，并精心安排考察调研单位，规划出行路线。</p><p>\r\n	　　4月13日，老协一行考察了重庆汇达柠檬集团有限公司及中国柠檬交易中心，潼南玫瑰种植加工基地；参观了著名的潼南大佛寺，潼南现代工业园区。4月14日，老协一行考察了潼南航电枢纽工程并参观了杨尚昆主席故居，瞻仰了杨闇公烈士纪念馆。在历史名镇双江，真切感受到了代代传承的家风民俗。</p><p>\r\n	　　老协很多同志表示，潼南这片希望田野上的巨大变化，折射出了中国改革开放的丰功伟业，让大家不仅看到了美好的希望，更加坚定了中国特色社会主义理想信念。同时也纷纷表示要发挥自身优势，积极传播正能量，为实现中华复兴的中国梦，发挥余热，贡献力量。</p><p>\r\n	&nbsp;</p><p>\r\n	（文、图/老年高等教育工作者协会&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 责编/陈磊）</p><p>\r\n	&nbsp;</p><p style=\"text-align: center\"><a class=\"pic\" href=\"http://news.cqut.edu.cn/attachment/201704/17191406_IMG_0212.jpg\" target=\"_blank\" title=\"点击查看原图\"><img alt=\"IMG_0212\" class=\"pic\" src=\"http://news.cqut.edu.cn/attachment/201704/17191406_IMG_0212_thumb_3.jpg\"/></a></p><p class=\"description\" style=\"text-align: center\">\r\n		老年高等教育工作者协会赴潼南调研考察</p><p style=\"text-align: center\"><a class=\"pic\" href=\"http://news.cqut.edu.cn/attachment/201704/17191349_IMG_0167.jpg\" target=\"_blank\" title=\"点击查看原图\"><img alt=\"IMG_0167\" class=\"pic\" src=\"http://news.cqut.edu.cn/attachment/201704/17191349_IMG_0167_thumb_3.jpg\"/></a></p><p class=\"description\" style=\"text-align: center\">\r\n		重庆理工大学老年高等教育工作者协会赴潼南调研考察</p><p style=\"text-align: center\"><a class=\"pic\" href=\"http://news.cqut.edu.cn/attachment/201704/17191359_IMG_0199.jpg\" target=\"_blank\" title=\"点击查看原图\"><img alt=\"IMG_0199\" class=\"pic\" src=\"http://news.cqut.edu.cn/attachment/201704/17191359_IMG_0199_thumb_3.jpg\"/></a></p><p class=\"description\" style=\"text-align: center\">\r\n		重庆理工大学老年高等教育工作者协会一行合影留念</p><p class=\"description\" style=\"text-align: center\">\r\n		&nbsp;</p><p class=\"description\" style=\"text-align: center\">\r\n		&nbsp;</p><p class=\"description\" style=\"text-align: center\">\r\n		&nbsp;</p><p class=\"description\">\r\n		&nbsp;</p><p> 			</p>', '2017-04-27', null, '新闻通知', 'zz', null);
INSERT INTO `news` VALUES ('8', '重庆理工大学第八届田径运动会圆满落幕', '<p align=\"center\">\r\n	<span style=\"font-size: 14px\"><strong>重庆理工大学第八届田径运动会圆满落幕</strong></span></p>\r\n<p>\r\n	&nbsp;&nbsp;&nbsp;</p>\r\n<p align=\"justify\">\r\n	　　4月14日下午，在全校师生的热情参与和共同努力下，经过两天半的角逐，重庆理工大学第八届田径运动会圆满完成所有赛事和项目，在花溪校区运动场顺利闭幕。副校长何建国、校纪委书记李蕾，各职能部门和学院负责人、裁判员、运动员等参加闭幕式。闭幕式由校纪委书记李蕾主持。</p>\r\n<p align=\"justify\">\r\n	　　在奏唱重庆理工大学校歌后，校体委副主任黄毅和本届运动会裁判长邓文冲分别宣布了本届运动会各项体育道德风尚奖和本届运动会团体总成绩。管理学院、材料科学与工程学院、会计学院、应用技术学院、电气与电子工程学院、经济金融学院、车辆工程学院七支学生代表队获体育道德风尚奖；车辆工程学院工会、材料科学与工程学院工会、两江校区工会、机械工程学院工会、重庆理工大资产经营管理有限责任公司工会、机关第一工会等6个教工集体获得体育道德风尚奖。在团体成绩方面，两江校区工会代表队获教工团体总分第一名，会计学院学生代表队分别获学生男子总分第一名和学生女子团体总分第一名。</p>\r\n<p align=\"justify\">\r\n	　　校领导为获得“体育道德风尚奖”以及团体总分前六名的各单位颁了奖。</p>\r\n<p align=\"justify\">\r\n	　　副校长、校体委主任何建国致闭幕词。何校长代表学校党政以及大会组委会向本届运动会上取得优异成绩的运动员表示热烈祝贺，向本届运动会付出辛勤劳动的裁判员以及为大会服务的老师和同学们表示衷心感谢！他指出，在这两天半的精彩赛事中，我们看到的不仅仅是运动场上的汗水和掌声，更是看到了重在参与、自强不息、顽强拼搏的“奥运精神”在参赛者身上的集中体现。他希望以本次运动会为契机，进一步发扬“自强不息、求实创新”的“重理工精神”，学习运动员们重在参与的积极心态，学习他们为团队争光的集体主义情怀，学习他们积极向上的拼搏精神，以更加健康的体魄、更加饱满的热情投入到学校各项事业中去，为早日建成特色鲜明的教学研究型大学而努力奋斗！</p>\r\n<p align=\"justify\">\r\n	　　据了解，本次运动会共有17个学院43个分工会约2100名运动员参加，设有54个比赛项目，取得了运动成绩与精神文明双丰收，充分展现了我校师生员工优良的精神风貌。</p>\r\n<p align=\"justify\">\r\n	&nbsp;</p>\r\n<p style=\"text-align: center\">\r\n	（文、图/校学生新闻中心 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;　　　&nbsp;&nbsp;责编/陈磊）</p>\r\n<p style=\"text-align: center\">\r\n	&nbsp;</p>\r\n<div class=\"attch_item\">\r\n	<p style=\"text-align: center\">\r\n		<a class=\"pic\" href=\"http://news.cqut.edu.cn/attachment/201704/17184649_IMG_2737.jpg\" target=\"_blank\" title=\"点击查看原图\"><img alt=\"IMG_2737\" class=\"pic\" src=\"http://news.cqut.edu.cn/attachment/201704/17184649_IMG_2737_thumb_3.jpg\"></a></p>\r\n	<p class=\"description\" style=\"text-align: center\">\r\n		重庆理工大学第八届田径运动会圆满落幕</p>\r\n</div>\r\n<div class=\"attch_item\">\r\n	<p style=\"text-align: center\">\r\n		<a class=\"pic\" href=\"http://news.cqut.edu.cn/attachment/201704/17184643_IMG_1727.jpg\" target=\"_blank\" title=\"点击查看原图\"><img alt=\"IMG_1727\" class=\"pic\" src=\"http://news.cqut.edu.cn/attachment/201704/17184643_IMG_1727_thumb_3.jpg\"></a></p>\r\n	<p class=\"description\" style=\"text-align: center\">\r\n		副校长、校体委主任何建国致闭幕词</p>\r\n</div>\r\n<div class=\"attch_item\">\r\n	<p style=\"text-align: center\">\r\n		<a class=\"pic\" href=\"http://news.cqut.edu.cn/attachment/201704/17184622_IMG_1713.jpg\" target=\"_blank\" title=\"点击查看原图\"><img alt=\"IMG_1713\" class=\"pic\" src=\"http://news.cqut.edu.cn/attachment/201704/17184622_IMG_1713_thumb_3.jpg\"></a></p>\r\n	<p class=\"description\" style=\"text-align: center\">\r\n		闭幕式由校纪委书记李蕾主持</p>\r\n</div>\r\n<div class=\"attch_item\">\r\n	<p style=\"text-align: center\">\r\n		<a class=\"pic\" href=\"http://news.cqut.edu.cn/attachment/201704/17184632_IMG_1718.jpg\" target=\"_blank\" title=\"点击查看原图\"><img alt=\"IMG_1718\" class=\"pic\" src=\"http://news.cqut.edu.cn/attachment/201704/17184632_IMG_1718_thumb_3.jpg\"></a></p>\r\n	<p class=\"description\" style=\"text-align: center\">\r\n		校体委副主任黄毅宣布本届运动会各项体育道德风尚奖</p>\r\n	<p class=\"description\" style=\"text-align: center\">\r\n		<a class=\"pic\" href=\"http://news.cqut.edu.cn/attachment/201704/17184637_IMG_1719.jpg\" target=\"_blank\" title=\"点击查看原图\"><img alt=\"IMG_1719\" class=\"pic\" src=\"http://news.cqut.edu.cn/attachment/201704/17184637_IMG_1719_thumb_3.jpg\"></a></p>\r\n</div>\r\n<div class=\"attch_item\">\r\n	<p class=\"description\" style=\"text-align: center\">\r\n		本届运动会裁判长邓文冲宣布本届运动会团体总成绩</p>\r\n</div>\r\n<div class=\"attch_item\">\r\n	<p style=\"text-align: center\">\r\n		<a class=\"pic\" href=\"http://news.cqut.edu.cn/attachment/201704/17184600_DSC03504.jpg\" target=\"_blank\" title=\"点击查看原图\"><img alt=\"DSC03504\" class=\"pic\" src=\"http://news.cqut.edu.cn/attachment/201704/17184600_DSC03504_thumb_3.jpg\"></a></p>\r\n	<p class=\"description\" style=\"text-align: center\">\r\n		体育道德风尚奖获奖单位领奖</p>\r\n</div>\r\n<div class=\"attch_item\">\r\n	<p style=\"text-align: center\">\r\n		<a class=\"pic\" href=\"http://news.cqut.edu.cn/attachment/201704/17184606_DSC03511.jpg\" target=\"_blank\" title=\"点击查看原图\"><img alt=\"DSC03511\" class=\"pic\" src=\"http://news.cqut.edu.cn/attachment/201704/17184606_DSC03511_thumb_3.jpg\"></a></p>\r\n	<p class=\"description\" style=\"text-align: center\">\r\n		男子团体总分前六名单位领奖</p>\r\n	<p style=\"text-align: center\">\r\n		<a class=\"pic\" href=\"http://news.cqut.edu.cn/attachment/201704/17184616_DSC03514.jpg\" target=\"_blank\" title=\"点击查看原图\"><img alt=\"DSC03514\" class=\"pic\" src=\"http://news.cqut.edu.cn/attachment/201704/17184616_DSC03514_thumb_3.jpg\"></a></p>\r\n	<p class=\"description\" style=\"text-align: center\">\r\n		女子团体总分前六名单位领奖</p>\r\n	<p class=\"description\">\r\n		&nbsp;</p>\r\n	<p class=\"description\">\r\n		&nbsp;</p>\r\n</div>', '2017-04-12', null, '新闻通知', 'zz', null);
INSERT INTO `news` VALUES ('9', '寻找“理”的盖世“音”雄——我校第二十八届校园之春之校园“十佳歌手”大赛圆满落幕', '<p align=\"center\">\r\n	<span style=\"font-size: 14px\"><strong>寻找“理”的盖世“音”雄——</strong><strong>我校第二十八届校园之春之校园“十佳歌手”大赛圆满落幕</strong></span></p>\r\n<p align=\"center\">\r\n	&nbsp;</p>\r\n<p>\r\n	　　4月16日晚7：00，由校团委主办、校学生会承办的我校第二十八届校园之春之第二十二届校园“十佳歌手”大赛决赛在学生活动中心如期唱响。校团委书记韩博、副书记刘彦涵、及各学院团总支老师莅临现场，与1500余同学共享这场视听盛宴。</p>\r\n<p>\r\n	<strong>　　情系理工校园，唱出青春梦想</strong></p>\r\n<p>\r\n	　　活动现场座无虚席，挥舞着的荧光棒，此起彼伏的呐喊声，在不断沸腾的气氛中，比赛正式开始。比赛中，选手们被分为60-70年代组、80-90年代组、00-10年代组。不同于现代流行音乐，我们的选手以过硬的实力完美演绎经典。来自两江校区的吴宗柯激昂演唱《我坚决在农村干他一百年》，原腔原调的民族戏曲，带我们重温老一辈人的无私奉献，重现新中国成立时人民的热血与激情。你问我《花儿为什么这样红》？机械工程学院的王天泽告诉你，沉稳敦厚的嗓音将友谊和爱情完美诠释，朵朵飘香，异域风情的花儿点亮了今晚的舞台。人生得以须尽欢，何不《潇洒走一回》！电气学院的CAD乐队，只愿看淡红尘滚滚，痴情深深，就此潇洒走一回。计算机科学与工程学院的王源，铿锵有力的粤语惊艳全场，怡情励志，带我们再次体验那段积极向上，为了理想奋斗不息的青春年华。来自理学院的宗传昊，实力挑战歌曲《野子》，看似凌乱的曲调实则别具魅力，前方再大的逆境，都毁不灭我的骄傲放纵。第二轮一开始，流行、摇滚、爵士等各种曲风瞬间引爆全场，气氛直达高潮。来自管理学院的廖俊博激情献唱《只要有你一起唱》，这加倍嘹亮的歌声拥有带给人们勇气的力量，只要用力闯，梦想总会被点亮，看见满天星光。两江的小学妹李欣霖，一身纯白素雅的白裙，自弹自唱一副《画》，如水彩画一般的情歌，以温柔和眷恋为画笔，画下思念，画出期许。</p>\r\n<p>\r\n	　　最终，计算机科学与工程学院王源，两江校区李欣霖，机械工程学院王天泽，分别斩获冠、亚、季军。理学院的宗传昊通过前期微信投票获得最佳人气奖。两江校区的吴宗柯，管理学院廖俊博，机械工程学院王天泽，电气与电子学院CAD乐队，会计学院聂鑫，计算机科学与工程学院王源，机械工程学院尹天佑，知识产权学院朱洲，药学与生物工程学院王梦凡，以及来自两江校区的李欣霖成为第22届十佳歌手。</p>\r\n<p>\r\n	<strong>　　留一份纪念给现在，送一片歌声寄明天</strong></p>\r\n<p>\r\n	　　本次凭借两首粤语歌荣获“歌王”的王源表示：平时就喜欢听各种流行歌，慢慢的，就会和音乐产生了共鸣。当问到他此次比赛最深的感受时，他说：第一次站在这么大的舞台，非常激动，感谢学校提供这么好的平台，感谢老师同学对我的认可，一步步走来，也很庆幸自己对音乐的坚持，希望能一直这样唱下去。</p>\r\n<p>\r\n	　　同时，校团委充分结合学风建设年的主题，以青年朋友喜闻乐见的歌手赛为契机，运用线上平台，如青年之声、青春重理工等，积极开辟寻找理工好声音、音乐的力量、唱响青春等讨论专区和投票区，调动了学生参与的积极性和主动性，为学风建设积蓄力量，也更好的拉近了团委与基层团组织、基层团支部以及青年团员之间的距离。</p>\r\n<p>\r\n	　　<strong>有一种声音能直达人心，那是音乐蕴藏的力量</strong></p>\r\n<p>\r\n	　　音乐家冼星海说过：“音乐，是人生最大的快乐；音乐，是生活中的一股清泉；音乐，是陶冶情操的熔炉。”音乐，确实有着改变世界的力量，在理工校园，音乐正让理工学子们变得更加意气风发，青春阳光，在这最美的年华，就应该放声歌唱。不是任何人都能成为歌手，但成为歌声可以属于任何人。相信我们的十佳歌手，会在“校园之春”的舞台上再创辉煌，相信理工声音会在青春的舞台上更加绚烂。</p>\r\n<p>\r\n	&nbsp;</p>\r\n<p align=\"center\">\r\n	（文、图/校团委传媒中心 &nbsp;　　　　　　　　　&nbsp;责编/陈磊）</p>\r\n<p>\r\n	&nbsp;</p>\r\n<div>\r\n	<p style=\"text-align: center\">\r\n		<a href=\"http://news.cqut.edu.cn/attachment/201704/17160959_1现场观众热情高涨.jpg\" target=\"_blank\" title=\"点击查看原图\"><img alt=\"1现场观众热情高涨\" src=\"http://news.cqut.edu.cn/attachment/201704/17160959_1现场观众热情高涨_thumb_3.jpg\"></a></p>\r\n	<p style=\"text-align: center\">\r\n		我校第二十八届校园之春之校园“十佳歌手”大赛圆满落幕</p>\r\n</div>\r\n<div>\r\n	<p style=\"text-align: center\">\r\n		<a href=\"http://news.cqut.edu.cn/attachment/201704/17161005_2主持人宣布比赛开始.jpg\" target=\"_blank\" title=\"点击查看原图\"><img alt=\"2主持人宣布比赛开始\" src=\"http://news.cqut.edu.cn/attachment/201704/17161005_2主持人宣布比赛开始_thumb_3.jpg\"></a></p>\r\n	<p style=\"text-align: center\">\r\n		主持人宣布比赛开始&nbsp;</p>\r\n</div>\r\n<div>\r\n	<p style=\"text-align: center\">\r\n		<a href=\"http://news.cqut.edu.cn/attachment/201704/17161011_3本届“歌王”王源投入演唱.jpg\" target=\"_blank\" title=\"点击查看原图\"><img alt=\"3本届“歌王”王源投入演唱\" src=\"http://news.cqut.edu.cn/attachment/201704/17161011_3本届“歌王”王源投入演唱_thumb_3.jpg\"></a></p>\r\n	<p style=\"text-align: center\">\r\n		本届“歌王”王源投入演唱</p>\r\n</div>\r\n<div>\r\n	<p style=\"text-align: center\">\r\n		<a href=\"http://news.cqut.edu.cn/attachment/201704/17161015_4CAD乐队激情演唱.jpg\" target=\"_blank\" title=\"点击查看原图\"><img alt=\"4CAD乐队激情演唱\" src=\"http://news.cqut.edu.cn/attachment/201704/17161015_4CAD乐队激情演唱_thumb_3.jpg\"></a></p>\r\n	<p style=\"text-align: center\">\r\n		CAD乐队激情演唱</p>\r\n</div>\r\n<div>\r\n	<p style=\"text-align: center\">\r\n		<a href=\"http://news.cqut.edu.cn/attachment/201704/17161049_5机械工程学院王天泽与搭档载歌载舞.jpg\" target=\"_blank\" title=\"点击查看原图\"><img alt=\"5机械工程学院王天泽与搭档载歌载舞\" src=\"http://news.cqut.edu.cn/attachment/201704/17161049_5机械工程学院王天泽与搭档载歌载舞_thumb_3.jpg\"></a></p>\r\n	<p style=\"text-align: center\">\r\n		机械工程学院王天泽与搭档载歌载舞</p>\r\n</div>\r\n<div>\r\n	<p style=\"text-align: center\">\r\n		<a href=\"http://news.cqut.edu.cn/attachment/201704/17161023_6知产学院朱洲深情献唱.jpg\" target=\"_blank\" title=\"点击查看原图\"><img alt=\"6知产学院朱洲深情献唱\" src=\"http://news.cqut.edu.cn/attachment/201704/17161023_6知产学院朱洲深情献唱_thumb_3.jpg\"></a></p>\r\n	<p style=\"text-align: center\">\r\n		知产学院朱洲深情献唱</p>\r\n</div>\r\n<div>\r\n	<p style=\"text-align: center\">\r\n		<a href=\"http://news.cqut.edu.cn/attachment/201704/17161028_7所有选手和领导老师合影.jpg\" target=\"_blank\" title=\"点击查看原图\"><img alt=\"7所有选手和领导老师合影\" src=\"http://news.cqut.edu.cn/attachment/201704/17161028_7所有选手和领导老师合影_thumb_3.jpg\"></a></p>\r\n	<p style=\"text-align: center\">\r\n		所有选手和领导老师合影</p>\r\n	<p class=\"description\">\r\n		&nbsp;</p>\r\n	<p class=\"description\">\r\n		&nbsp;</p>\r\n</div>', '2017-04-03', null, '新闻通知', 'zz', null);
INSERT INTO `news` VALUES ('10', '我校成功举办2017届毕业生理学类专场双选会', '<p align=\"center\">\r\n	<span style=\"font-size: 14px\"><strong>我校成功举办</strong><strong>2017届毕业生</strong><strong>理学类专场双选会</strong></span></p>\r\n<p>\r\n	&nbsp;&nbsp;&nbsp;&nbsp;</p>\r\n<p>\r\n	　　为进一步推进就业工作，加强就业工作针对性，更好地为毕业生就业提供精准服务，学校招生就业处、理学学院联合组织的2017届毕业生理学类专场双选会，于4月12日在第三实验楼A栋大厅举行。</p>\r\n<p>\r\n	　　据了解，本次专场双选会汇聚了重庆平伟实业股份有限公司、重庆四联光电科技有限公司、重庆联导金宏实业有限公司、重庆中显智能科技有限公司、爱建证券有限责任公司、、重庆市庆安电力安装工程有限公司、重庆大帝教育科技有限公司、中国人寿渝北支公司、重庆百年金福健康管理有限公司等近20家企业，为毕业生提供了涵盖大数据分析、应用物理、信息与计算科学、金融数学、电子、机械、车辆、计算机、外语、经管等多个领域共200余个优质岗位。</p>\r\n<p>\r\n	　　双选会现场，招就处相关领导、部分学院党总支书记、副书记、负责学生就业的学办老师，理学院党政领导、各专业系系主任、辅导员、毕业班班导师到场与招聘单位面对面交流，听取了招聘企业的用人需求和建议反馈，在现场为同学们进行就业指导和职业咨询，积极向用人单位推荐毕业生，鼓励毕业生在春季校园招聘的后期及时调整心态，吸取前阶段求职面试的经验教训，在激烈的就业竞争下顶住压力、积极主动、突破自我，结合自身情况不断调整、成熟，顺利求得合适的就业岗位。理学院举办本次双选会，旨在大力开拓就业渠道，搭建毕业生与用人单位的联系平台，切实促进学生就业。</p>\r\n<p>\r\n	　　据悉，本次双选会已有近50名毕业生与用人单位达成就业意向，理学院相关领导及老师将持续跟进后续的企业面试、录用情况，及时掌握企业用人需求和学生求职意向，有针对性地优化毕业生就业指导和服务工作，为2017届毕业生就业工作助力。</p>\r\n<p>\r\n	&nbsp;</p>\r\n<p style=\"text-align: center\">\r\n	（文、图/理学院 &nbsp;&nbsp;　　　　　　&nbsp;责编/陈磊）&nbsp;</p>\r\n<p>\r\n	&nbsp;</p>\r\n<div class=\"attch_item\">\r\n	<p style=\"text-align: center\">\r\n		<a class=\"pic\" href=\"http://news.cqut.edu.cn/attachment/201704/17144129_我校成功举办2017届毕业生理学类专场双选会.jpg\" target=\"_blank\" title=\"点击查看原图\"><img alt=\"我校成功举办2017届毕业生理学类专场双选会\" class=\"pic\" src=\"http://news.cqut.edu.cn/attachment/201704/17144129_我校成功举办2017届毕业生理学类专场双选会_thumb_3.jpg\"></a></p>\r\n	<p class=\"description\" style=\"text-align: center\">\r\n		我校成功举办2017届毕业生理学类专场双选会</p>\r\n</div>\r\n<div class=\"attch_item\">\r\n	<p style=\"text-align: center\">\r\n		<a class=\"pic\" href=\"http://news.cqut.edu.cn/attachment/201704/17144134_招就处与理学院相关领导在双选会现场指导就业.jpg\" target=\"_blank\" title=\"点击查看原图\"><img alt=\"招就处与理学院相关领导在双选会现场指导就业\" class=\"pic\" src=\"http://news.cqut.edu.cn/attachment/201704/17144134_招就处与理学院相关领导在双选会现场指导就业_thumb_3.jpg\"></a></p>\r\n	<p class=\"description\" style=\"text-align: center\">\r\n		招就处与理学院相关领导在双选会现场指导就业</p>\r\n</div>\r\n<div class=\"attch_item\">\r\n	<p style=\"text-align: center\">\r\n		<a class=\"pic\" href=\"http://news.cqut.edu.cn/attachment/201704/17144138_招聘单位现场为毕业生做招聘宣讲.jpg\" target=\"_blank\" title=\"点击查看原图\"><img alt=\"招聘单位现场为毕业生做招聘宣讲\" class=\"pic\" src=\"http://news.cqut.edu.cn/attachment/201704/17144138_招聘单位现场为毕业生做招聘宣讲_thumb_3.jpg\"></a></p>\r\n	<p class=\"description\" style=\"text-align: center\">\r\n		招聘单位现场为毕业生做招聘宣讲</p>\r\n</div>\r\n<div class=\"attch_item\">\r\n	<p style=\"text-align: center\">\r\n		<a class=\"pic\" href=\"http://news.cqut.edu.cn/attachment/201704/17144125_理学类双选会现场.jpg\" target=\"_blank\" title=\"点击查看原图\"><img alt=\"理学类双选会现场\" class=\"pic\" src=\"http://news.cqut.edu.cn/attachment/201704/17144125_理学类双选会现场_thumb_3.jpg\"></a></p>\r\n	<p class=\"description\" style=\"text-align: center\">\r\n		理学类双选会现场</p>\r\n	<p class=\"description\">\r\n		&nbsp;</p>\r\n	<p class=\"description\">\r\n		&nbsp;</p>\r\n</div>', '2017-03-31', null, '新闻通知', 'zz', null);
INSERT INTO `news` VALUES ('11', '我校成功举办2017届毕业生理学123类专场双选会', '<p>\r\n	&nbsp;&nbsp;&nbsp;&nbsp;</p>\r\n<p>\r\n	　　为进一步推进就业工作，加强就业工作针对性，更好地为毕业生就业提供精准服务，学校招生就业处、理学学院联合组织的2017届毕业生理学类专场双选会，于4月12日在第三实验楼A栋大厅举行。</p>\r\n<p>\r\n	　　据了解，本次专场双选会汇聚了重庆平伟实业股份有限公司、重庆四联光电科技有限公司、重庆联导金宏实业有限公司、重庆中显智能科技有限公司、爱建证券有限责任公司、、重庆市庆安电力安装工程有限公司、重庆大帝教育科技有限公司、中国人寿渝北支公司、重庆百年金福健康管理有限公司等近20家企业，为毕业生提供了涵盖大数据分析、应用物理、信息与计算科学、金融数学、电子、机械、车辆、计算机、外语、经管等多个领域共200余个优质岗位。</p>\r\n<p>\r\n	　　双选会现场，招就处相关领导、部分学院党总支书记、副书记、负责学生就业的学办老师，理学院党政领导、各专业系系主任、辅导员、毕业班班导师到场与招聘单位面对面交流，听取了招聘企业的用人需求和建议反馈，在现场为同学们进行就业指导和职业咨询，积极向用人单位推荐毕业生，鼓励毕业生在春季校园招聘的后期及时调整心态，吸取前阶段求职面试的经验教训，在激烈的就业竞争下顶住压力、积极主动、突破自我，结合自身情况不断调整、成熟，顺利求得合适的就业岗位。理学院举办本次双选会，旨在大力开拓就业渠道，搭建毕业生与用人单位的联系平台，切实促进学生就业。</p>\r\n<p>\r\n	　　据悉，本次双选会已有近50名毕业生与用人单位达成就业意向，理学院相关领导及老师将持续跟进后续的企业面试、录用情况，及时掌握企业用人需求和学生求职意向，有针对性地优化毕业生就业指导和服务工作，为2017届毕业生就业工作助力。</p>\r\n<p>\r\n	&nbsp;</p>\r\n<p style=\"text-align: center\">\r\n	（文、图/理学院 &nbsp;&nbsp;　　　　　　&nbsp;责编/陈磊）&nbsp;</p>\r\n<p>\r\n	&nbsp;</p>\r\n<div class=\"attch_item\">\r\n	<p style=\"text-align: center\">\r\n		<a class=\"pic\" href=\"http://news.cqut.edu.cn/attachment/201704/17144129_我校成功举办2017届毕业生理学类专场双选会.jpg\" target=\"_blank\" title=\"点击查看原图\"><img alt=\"我校成功举办2017届毕业生理学类专场双选会\" class=\"pic\" src=\"http://news.cqut.edu.cn/attachment/201704/17144129_我校成功举办2017届毕业生理学类专场双选会_thumb_3.jpg\"></a></p>\r\n	<p class=\"description\" style=\"text-align: center\">\r\n		我校成功举办2017届毕业生理学类专场双选会</p>\r\n</div>\r\n<div class=\"attch_item\">\r\n	<p style=\"text-align: center\">\r\n		<a class=\"pic\" href=\"http://news.cqut.edu.cn/attachment/201704/17144134_招就处与理学院相关领导在双选会现场指导就业.jpg\" target=\"_blank\" title=\"点击查看原图\"><img alt=\"招就处与理学院相关领导在双选会现场指导就业\" class=\"pic\" src=\"http://news.cqut.edu.cn/attachment/201704/17144134_招就处与理学院相关领导在双选会现场指导就业_thumb_3.jpg\"></a></p>\r\n	<p class=\"description\" style=\"text-align: center\">\r\n		招就处与理学院相关领导在双选会现场指导就业</p>\r\n</div>\r\n<div class=\"attch_item\">\r\n	<p style=\"text-align: center\">\r\n		<a class=\"pic\" href=\"http://news.cqut.edu.cn/attachment/201704/17144138_招聘单位现场为毕业生做招聘宣讲.jpg\" target=\"_blank\" title=\"点击查看原图\"><img alt=\"招聘单位现场为毕业生做招聘宣讲\" class=\"pic\" src=\"http://news.cqut.edu.cn/attachment/201704/17144138_招聘单位现场为毕业生做招聘宣讲_thumb_3.jpg\"></a></p>\r\n	<p class=\"description\" style=\"text-align: center\">\r\n		招聘单位现场为毕业生做招聘宣讲</p>\r\n</div>\r\n<div class=\"attch_item\">\r\n	<p style=\"text-align: center\">\r\n		<a class=\"pic\" href=\"http://news.cqut.edu.cn/attachment/201704/17144125_理学类双选会现场.jpg\" target=\"_blank\" title=\"点击查看原图\"><img alt=\"理学类双选会现场\" class=\"pic\" src=\"http://news.cqut.edu.cn/attachment/201704/17144125_理学类双选会现场_thumb_3.jpg\"></a></p>\r\n	<p class=\"description\" style=\"text-align: center\">\r\n		理学类双选会现场</p>\r\n	<p class=\"description\">\r\n		&nbsp;</p>\r\n	<p class=\"description\">\r\n		&nbsp;</p>\r\n</div>', '2017-04-06', null, '新闻通知', 'zz', null);
INSERT INTO `news` VALUES ('12', '双选会', '<p align=\"center\">\r\n	<span style=\"font-size: 14px\"><strong>我校成功</strong><strong>举行2017届</strong><strong>毕业生</strong><strong>“</strong><strong>社会工作类</strong><strong>”</strong><strong>双选会</strong></span></p>\r\n<p style=\"margin-left: auto\">\r\n	&nbsp;</p>\r\n<p style=\"margin-left: auto\">\r\n	　　4月17日下午，由学校招就处主办、重庆知识产权学院承办的2017届毕业生“社会工作类”双选会在第三实验楼招聘大厅成功举行。本次专场双选会聚集了深圳市南山区南风社会工作服务社、重庆市第一社会福利院、重庆仁爱社会工作服务中心、重庆市民悦社会工作服务中心、重庆春语社会工作服务中心、重庆卓越社会组织服务中心、重庆巴南企航社会工作服务中心等43家社会工作专业机构来校延揽人才，提供了全职工作岗位400余个和实习岗位80余个。</p>\r\n<p style=\"margin-left: auto\">\r\n	　　招聘会场人头攒动，气氛热烈，不少企业展位前都排着长队。学生踊跃投递简历，大方自信地向心仪的招聘单位进行自荐，认真询问招聘需求，自信从容地应对考官的提问。</p>\r\n<p style=\"margin-left: auto\">\r\n	　　招就处处长赵毅、副处长粟道平、知识产权学院院长苏平、党总支书记龙思红、社会工作系教师、学办老师来到双选会现场与招聘单位面对面深入交流，细致地介绍了社会工作专业人才培养与教学特色，积极向用人单位推荐毕业生和实习生，认真听取招聘单位的用人需求和对人才培养工作的建议；现场为学生开展就业指导和职业发展咨询，勉励学生顺利觅得合适的工作岗位。</p>\r\n<p style=\"margin-left: auto\">\r\n	　　双选会上，用人单位对我校社会工作专业学生纷纷表示赞赏，普遍认为他们专业知识扎实，实务能力较强，综合素质较高，同时也对专业人才培养工作提出了诸多建议。深圳市南山区南风社会工作服务社面试官指出，社会工作强调实务取向，要求学生能力与知识并重，建议学校强化实习环节的教育，延长实习训练时间；重庆仁爱社会工作服务中心、重庆春语社会工作服务中心、重庆卓越社会组织服务中心等单位的负责人认为，社会工作行业正处于创业的关键时期，在人才培养中，要引导社会工作专业的学生放宽视野，确立大格局意识，培育创新思维，树立创业意识，以创业带动就业，积极主动的推动社会工作事业的发展进步。知识产权学院院长苏平表示，用人单位的意见与建议是对人才培养工作的精准化把脉和诊断，是进一步优化人才培养模式，提升人才培养质量，提高就业竞争力的指南针和方向标。</p>\r\n<p style=\"margin-left: auto\">\r\n	　　为提升学生实践能力与职业素养，知识产权学院通过多种方法齐抓并举，一是持续开展服务—学习，通过“学校+机构”联合培养，增强学生整合理论与实务的能力；二是抓住应用转型的契机，改革课程教学，切实提升学生的社会工作综合素质；三是强化政产学研联合办学模式，与巴南区政府共建重庆市巴南区社会工作实习（训）基地，通过服务地方，提升师生社会工作专业服务能力，提高学生专业核心竞争力。</p>\r\n<p style=\"margin-left: auto\">\r\n	　　党的十八大以来，我国社会工作事业发展迅猛，方兴未艾，对社会工作专业人才需求不断增大。本次双选会上已有数十名社会工作专业毕业生和高年级学生与用人单位初步达成了就业与实习意向。知识产权学院领导、学办老师和社会工作专业系教师将持续跟进后续的面试、录用情况，及时掌握社会工作专业机构的需求信息和学生求职动向，全面提升就业工作成效和学生就业质量。</p>\r\n<p>\r\n	&nbsp;&nbsp;&nbsp;&nbsp;</p>\r\n<p style=\"text-align: center; margin-left: auto\">\r\n	（文、图/重庆知识产权学院&nbsp;&nbsp;　　　　&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;责编/陈磊）</p>\r\n<p style=\"text-align: center; margin-left: auto\">\r\n	&nbsp;</p>\r\n<div class=\"attch_item\">\r\n	<p style=\"text-align: center\">\r\n		<a class=\"pic\" href=\"http://news.cqut.edu.cn/attachment/201704/18143044_2017届毕业生社会工作类双选会成功举行.jpg\" target=\"_blank\" title=\"点击查看原图\"><img alt=\"2017届毕业生社会工作类双选会成功举行\" class=\"pic\" src=\"http://news.cqut.edu.cn/attachment/201704/18143044_2017届毕业生社会工作类双选会成功举行_thumb_3.jpg\"></a></p>\r\n	<p class=\"description\" style=\"text-align: center\">\r\n		我校成功举行2017届毕业生“社会工作类”双选会</p>\r\n</div>\r\n<div class=\"attch_item\">\r\n	<p style=\"text-align: center\">\r\n		<a class=\"pic\" href=\"http://news.cqut.edu.cn/attachment/201704/18143049_招就处领导和知产学院领导交流就业工作.jpg\" target=\"_blank\" title=\"点击查看原图\"><img alt=\"招就处领导和知产学院领导交流就业工作\" class=\"pic\" src=\"http://news.cqut.edu.cn/attachment/201704/18143049_招就处领导和知产学院领导交流就业工作_thumb_3.jpg\"></a></p>\r\n	<p class=\"description\" style=\"text-align: center\">\r\n		招就处领导和知产学院领导交流就业工作</p>\r\n</div>\r\n<div class=\"attch_item\">\r\n	<p style=\"text-align: center\">\r\n		<a class=\"pic\" href=\"http://news.cqut.edu.cn/attachment/201704/18143054_知产学院毕业生认真参与面试.jpg\" target=\"_blank\" title=\"点击查看原图\"><img alt=\"知产学院毕业生认真参与面试\" class=\"pic\" src=\"http://news.cqut.edu.cn/attachment/201704/18143054_知产学院毕业生认真参与面试_thumb_3.jpg\"></a></p>\r\n	<p class=\"description\" style=\"text-align: center\">\r\n		知产学院毕业生认真参与面试</p>\r\n	<p class=\"description\" style=\"text-align: center\">\r\n		&nbsp;</p>\r\n	<p class=\"description\" style=\"text-align: center\">\r\n		&nbsp;</p>\r\n	<p class=\"description\">\r\n		&nbsp;</p>\r\n	<p class=\"description\">\r\n		&nbsp;</p>\r\n</div>', '2017-04-04', null, '新闻通知', 'zz', null);
INSERT INTO `news` VALUES ('13', '调研考察', '<div style=\"text-align: center\">\r\n	<strong>重庆理工大学老年高等教育工作者协会赴潼南调研考察</strong></div>\r\n<div style=\"white-space: normal; word-spacing: 0px; text-transform: none; color: rgb(0,0,0); font: 14px \'lucida grande\', verdana; widows: 1; letter-spacing: normal; background-color: rgb(255,255,255); text-indent: 0px; -webkit-text-stroke-width: 0px\">\r\n	&nbsp;</div>\r\n<div style=\"white-space: normal; word-spacing: 0px; text-transform: none; color: rgb(0,0,0); font: 14px \'lucida grande\', verdana; widows: 1; letter-spacing: normal; background-color: rgb(255,255,255); text-indent: 0px; -webkit-text-stroke-width: 0px\">\r\n	&nbsp;</div>\r\n<div style=\"white-space: normal; word-spacing: 0px; text-transform: none; color: rgb(0,0,0); font: 14px \'lucida grande\', verdana; widows: 1; letter-spacing: normal; background-color: rgb(255,255,255); text-indent: 0px; -webkit-text-stroke-width: 0px\">\r\n	　　最美人间四月天，重庆直辖二十年；鹤发童颜人未老，一路高歌到潼南。4月13日至14日，重庆理工大学高教老协一行32人，在会长饶宁华率领下，专程前往潼南调研考察。 &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</div>\r\n<div style=\"white-space: normal; word-spacing: 0px; text-transform: none; color: rgb(0,0,0); font: 14px \'lucida grande\', verdana; widows: 1; letter-spacing: normal; background-color: rgb(255,255,255); text-indent: 0px; -webkit-text-stroke-width: 0px\">\r\n	　　潼南，是渝西重镇。这里，是中国共产党早期领导人杨闇公烈士诞生地，是中华人民共和国已故主席杨尚昆故里。这里，涪江平阔，大佛庄严，双山拱卫双江古镇，家风清白子承孙传。自重庆直辖二十年来，潼南人民发扬“马蹄铁磨平方休”的奋进精神，勇于开拓，拼搏奋进，使潼南的山河换了新颜。昔日传统的农粮之乡，已经崛起了一座现代工贸果蔬蚕桑新城。此次调研考察，得到了潼南党政领导的热情关怀和大力支持。中共潼南区委副书记江志斌、中共潼南区纪委书记于贵生接待了全体同志，并精心安排考察调研单位，规划出行路线。</div>\r\n<div style=\"white-space: normal; word-spacing: 0px; text-transform: none; color: rgb(0,0,0); font: 14px \'lucida grande\', verdana; widows: 1; letter-spacing: normal; background-color: rgb(255,255,255); text-indent: 0px; -webkit-text-stroke-width: 0px\">\r\n	　　4月13日，老协一行考察了重庆汇达柠檬集团有限公司及中国柠檬交易中心，潼南玫瑰种植加工基地；参观了著名的潼南大佛寺，潼南现代工业园区。4月14日，老协一行考察了潼南航电枢纽工程并参观了杨尚昆主席故居，瞻仰了杨闇公烈士纪念馆。在历史名镇双江，真切感受到了代代传承的家风民俗。</div>\r\n<div style=\"white-space: normal; word-spacing: 0px; text-transform: none; color: rgb(0,0,0); font: 14px \'lucida grande\', verdana; widows: 1; letter-spacing: normal; background-color: rgb(255,255,255); text-indent: 0px; -webkit-text-stroke-width: 0px\">\r\n	　　老协很多同志表示，潼南这片希望田野上的巨大变化，折射出了中国改革开放的丰功伟业，让大家不仅看到了美好的希望，更加坚定了中国特色社会主义理想信念。同时也纷纷表示要发挥自身优势，积极传播正能量，为实现中华复兴的中国梦，发挥余热，贡献力量。</div>\r\n<div style=\"white-space: normal; word-spacing: 0px; text-transform: none; color: rgb(0,0,0); font: 14px \'lucida grande\', verdana; widows: 1; letter-spacing: normal; background-color: rgb(255,255,255); text-indent: 0px; -webkit-text-stroke-width: 0px\">\r\n	&nbsp;</div>\r\n<div style=\"white-space: normal; word-spacing: 0px; text-transform: none; color: rgb(0,0,0); text-align: center; font: 14px \'lucida grande\', verdana; widows: 1; letter-spacing: normal; background-color: rgb(255,255,255); text-indent: 0px; -webkit-text-stroke-width: 0px\">\r\n	（文、图/老年高等教育工作者协会&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 责编/陈磊）</div>\r\n<div style=\"white-space: normal; word-spacing: 0px; text-transform: none; color: rgb(0,0,0); text-align: center; font: 14px \'lucida grande\', verdana; widows: 1; letter-spacing: normal; background-color: rgb(255,255,255); text-indent: 0px; -webkit-text-stroke-width: 0px\">\r\n	&nbsp;</div>\r\n<div class=\"attch_item\">\r\n	<p style=\"text-align: center\">\r\n		<a class=\"pic\" href=\"http://news.cqut.edu.cn/attachment/201704/17191406_IMG_0212.jpg\" target=\"_blank\" title=\"点击查看原图\"><img alt=\"IMG_0212\" class=\"pic\" src=\"http://news.cqut.edu.cn/attachment/201704/17191406_IMG_0212_thumb_3.jpg\"></a></p>\r\n	<p class=\"description\" style=\"text-align: center\">\r\n		老年高等教育工作者协会赴潼南调研考察</p>\r\n</div>\r\n<div class=\"attch_item\">\r\n	<p style=\"text-align: center\">\r\n		<a class=\"pic\" href=\"http://news.cqut.edu.cn/attachment/201704/17191349_IMG_0167.jpg\" target=\"_blank\" title=\"点击查看原图\"><img alt=\"IMG_0167\" class=\"pic\" src=\"http://news.cqut.edu.cn/attachment/201704/17191349_IMG_0167_thumb_3.jpg\"></a></p>\r\n	<p class=\"description\" style=\"text-align: center\">\r\n		重庆理工大学老年高等教育工作者协会赴潼南调研考察</p>\r\n</div>\r\n<div class=\"attch_item\">\r\n	<p style=\"text-align: center\">\r\n		<a class=\"pic\" href=\"http://news.cqut.edu.cn/attachment/201704/17191359_IMG_0199.jpg\" target=\"_blank\" title=\"点击查看原图\"><img alt=\"IMG_0199\" class=\"pic\" src=\"http://news.cqut.edu.cn/attachment/201704/17191359_IMG_0199_thumb_3.jpg\"></a></p>\r\n	<p class=\"description\" style=\"text-align: center\">\r\n		重庆理工大学老年高等教育工作者协会一行合影留念</p>\r\n	<p class=\"description\" style=\"text-align: center\">\r\n		&nbsp;</p>\r\n	<p class=\"description\" style=\"text-align: center\">\r\n		&nbsp;</p>\r\n	<p class=\"description\" style=\"text-align: center\">\r\n		&nbsp;</p>\r\n	<p class=\"description\">\r\n		&nbsp;</p>\r\n</div>\r\n     ', '2017-04-18', null, '新闻通知', 'zz', null);
INSERT INTO `news` VALUES ('14', '圆满落幕', '<p align=\"center\">\r\n	<span style=\"font-size: 14px\"><strong>重庆理工大学第八届田径运动会圆满落幕</strong></span></p>\r\n<p>\r\n	&nbsp;&nbsp;&nbsp;</p>\r\n<p align=\"justify\">\r\n	　　4月14日下午，在全校师生的热情参与和共同努力下，经过两天半的角逐，重庆理工大学第八届田径运动会圆满完成所有赛事和项目，在花溪校区运动场顺利闭幕。副校长何建国、校纪委书记李蕾，各职能部门和学院负责人、裁判员、运动员等参加闭幕式。闭幕式由校纪委书记李蕾主持。</p>\r\n<p align=\"justify\">\r\n	　　在奏唱重庆理工大学校歌后，校体委副主任黄毅和本届运动会裁判长邓文冲分别宣布了本届运动会各项体育道德风尚奖和本届运动会团体总成绩。管理学院、材料科学与工程学院、会计学院、应用技术学院、电气与电子工程学院、经济金融学院、车辆工程学院七支学生代表队获体育道德风尚奖；车辆工程学院工会、材料科学与工程学院工会、两江校区工会、机械工程学院工会、重庆理工大资产经营管理有限责任公司工会、机关第一工会等6个教工集体获得体育道德风尚奖。在团体成绩方面，两江校区工会代表队获教工团体总分第一名，会计学院学生代表队分别获学生男子总分第一名和学生女子团体总分第一名。</p>\r\n<p align=\"justify\">\r\n	　　校领导为获得“体育道德风尚奖”以及团体总分前六名的各单位颁了奖。</p>\r\n<p align=\"justify\">\r\n	　　副校长、校体委主任何建国致闭幕词。何校长代表学校党政以及大会组委会向本届运动会上取得优异成绩的运动员表示热烈祝贺，向本届运动会付出辛勤劳动的裁判员以及为大会服务的老师和同学们表示衷心感谢！他指出，在这两天半的精彩赛事中，我们看到的不仅仅是运动场上的汗水和掌声，更是看到了重在参与、自强不息、顽强拼搏的“奥运精神”在参赛者身上的集中体现。他希望以本次运动会为契机，进一步发扬“自强不息、求实创新”的“重理工精神”，学习运动员们重在参与的积极心态，学习他们为团队争光的集体主义情怀，学习他们积极向上的拼搏精神，以更加健康的体魄、更加饱满的热情投入到学校各项事业中去，为早日建成特色鲜明的教学研究型大学而努力奋斗！</p>\r\n<p align=\"justify\">\r\n	　　据了解，本次运动会共有17个学院43个分工会约2100名运动员参加，设有54个比赛项目，取得了运动成绩与精神文明双丰收，充分展现了我校师生员工优良的精神风貌。</p>\r\n<p align=\"justify\">\r\n	&nbsp;</p>\r\n<p style=\"text-align: center\">\r\n	（文、图/校学生新闻中心 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;　　　&nbsp;&nbsp;责编/陈磊）</p>\r\n<p style=\"text-align: center\">\r\n	&nbsp;</p>\r\n<div class=\"attch_item\">\r\n	<p style=\"text-align: center\">\r\n		<a class=\"pic\" href=\"http://news.cqut.edu.cn/attachment/201704/17184649_IMG_2737.jpg\" target=\"_blank\" title=\"点击查看原图\"><img alt=\"IMG_2737\" class=\"pic\" src=\"http://news.cqut.edu.cn/attachment/201704/17184649_IMG_2737_thumb_3.jpg\"></a></p>\r\n	<p class=\"description\" style=\"text-align: center\">\r\n		重庆理工大学第八届田径运动会圆满落幕</p>\r\n</div>\r\n<div class=\"attch_item\">\r\n	<p style=\"text-align: center\">\r\n		<a class=\"pic\" href=\"http://news.cqut.edu.cn/attachment/201704/17184643_IMG_1727.jpg\" target=\"_blank\" title=\"点击查看原图\"><img alt=\"IMG_1727\" class=\"pic\" src=\"http://news.cqut.edu.cn/attachment/201704/17184643_IMG_1727_thumb_3.jpg\"></a></p>\r\n	<p class=\"description\" style=\"text-align: center\">\r\n		副校长、校体委主任何建国致闭幕词</p>\r\n</div>\r\n<div class=\"attch_item\">\r\n	<p style=\"text-align: center\">\r\n		<a class=\"pic\" href=\"http://news.cqut.edu.cn/attachment/201704/17184622_IMG_1713.jpg\" target=\"_blank\" title=\"点击查看原图\"><img alt=\"IMG_1713\" class=\"pic\" src=\"http://news.cqut.edu.cn/attachment/201704/17184622_IMG_1713_thumb_3.jpg\"></a></p>\r\n	<p class=\"description\" style=\"text-align: center\">\r\n		闭幕式由校纪委书记李蕾主持</p>\r\n</div>\r\n<div class=\"attch_item\">\r\n	<p style=\"text-align: center\">\r\n		<a class=\"pic\" href=\"http://news.cqut.edu.cn/attachment/201704/17184632_IMG_1718.jpg\" target=\"_blank\" title=\"点击查看原图\"><img alt=\"IMG_1718\" class=\"pic\" src=\"http://news.cqut.edu.cn/attachment/201704/17184632_IMG_1718_thumb_3.jpg\"></a></p>\r\n	<p class=\"description\" style=\"text-align: center\">\r\n		校体委副主任黄毅宣布本届运动会各项体育道德风尚奖</p>\r\n	<p class=\"description\" style=\"text-align: center\">\r\n		<a class=\"pic\" href=\"http://news.cqut.edu.cn/attachment/201704/17184637_IMG_1719.jpg\" target=\"_blank\" title=\"点击查看原图\"><img alt=\"IMG_1719\" class=\"pic\" src=\"http://news.cqut.edu.cn/attachment/201704/17184637_IMG_1719_thumb_3.jpg\"></a></p>\r\n</div>\r\n<div class=\"attch_item\">\r\n	<p class=\"description\" style=\"text-align: center\">\r\n		本届运动会裁判长邓文冲宣布本届运动会团体总成绩</p>\r\n</div>\r\n<div class=\"attch_item\">\r\n	<p style=\"text-align: center\">\r\n		<a class=\"pic\" href=\"http://news.cqut.edu.cn/attachment/201704/17184600_DSC03504.jpg\" target=\"_blank\" title=\"点击查看原图\"><img alt=\"DSC03504\" class=\"pic\" src=\"http://news.cqut.edu.cn/attachment/201704/17184600_DSC03504_thumb_3.jpg\"></a></p>\r\n	<p class=\"description\" style=\"text-align: center\">\r\n		体育道德风尚奖获奖单位领奖</p>\r\n</div>\r\n<div class=\"attch_item\">\r\n	<p style=\"text-align: center\">\r\n		<a class=\"pic\" href=\"http://news.cqut.edu.cn/attachment/201704/17184606_DSC03511.jpg\" target=\"_blank\" title=\"点击查看原图\"><img alt=\"DSC03511\" class=\"pic\" src=\"http://news.cqut.edu.cn/attachment/201704/17184606_DSC03511_thumb_3.jpg\"></a></p>\r\n	<p class=\"description\" style=\"text-align: center\">\r\n		男子团体总分前六名单位领奖</p>\r\n	<p style=\"text-align: center\">\r\n		<a class=\"pic\" href=\"http://news.cqut.edu.cn/attachment/201704/17184616_DSC03514.jpg\" target=\"_blank\" title=\"点击查看原图\"><img alt=\"DSC03514\" class=\"pic\" src=\"http://news.cqut.edu.cn/attachment/201704/17184616_DSC03514_thumb_3.jpg\"></a></p>\r\n	<p class=\"description\" style=\"text-align: center\">\r\n		女子团体总分前六名单位领奖</p>\r\n	<p class=\"description\">\r\n		&nbsp;</p>\r\n	<p class=\"description\">\r\n		&nbsp;</p>\r\n</div>', '2017-04-12', null, '新闻通知', 'zz', null);
INSERT INTO `news` VALUES ('16', '专场双选会', '<p align=\"center\">\r\n	<span style=\"font-size: 14px\"><strong>我校成功举办</strong><strong>2017届毕业生</strong><strong>理学类专场双选会</strong></span></p>\r\n<p>\r\n	&nbsp;&nbsp;&nbsp;&nbsp;</p>\r\n<p>\r\n	　　为进一步推进就业工作，加强就业工作针对性，更好地为毕业生就业提供精准服务，学校招生就业处、理学学院联合组织的2017届毕业生理学类专场双选会，于4月12日在第三实验楼A栋大厅举行。</p>\r\n<p>\r\n	　　据了解，本次专场双选会汇聚了重庆平伟实业股份有限公司、重庆四联光电科技有限公司、重庆联导金宏实业有限公司、重庆中显智能科技有限公司、爱建证券有限责任公司、、重庆市庆安电力安装工程有限公司、重庆大帝教育科技有限公司、中国人寿渝北支公司、重庆百年金福健康管理有限公司等近20家企业，为毕业生提供了涵盖大数据分析、应用物理、信息与计算科学、金融数学、电子、机械、车辆、计算机、外语、经管等多个领域共200余个优质岗位。</p>\r\n<p>\r\n	　　双选会现场，招就处相关领导、部分学院党总支书记、副书记、负责学生就业的学办老师，理学院党政领导、各专业系系主任、辅导员、毕业班班导师到场与招聘单位面对面交流，听取了招聘企业的用人需求和建议反馈，在现场为同学们进行就业指导和职业咨询，积极向用人单位推荐毕业生，鼓励毕业生在春季校园招聘的后期及时调整心态，吸取前阶段求职面试的经验教训，在激烈的就业竞争下顶住压力、积极主动、突破自我，结合自身情况不断调整、成熟，顺利求得合适的就业岗位。理学院举办本次双选会，旨在大力开拓就业渠道，搭建毕业生与用人单位的联系平台，切实促进学生就业。</p>\r\n<p>\r\n	　　据悉，本次双选会已有近50名毕业生与用人单位达成就业意向，理学院相关领导及老师将持续跟进后续的企业面试、录用情况，及时掌握企业用人需求和学生求职意向，有针对性地优化毕业生就业指导和服务工作，为2017届毕业生就业工作助力。</p>\r\n<p>\r\n	&nbsp;</p>\r\n<p style=\"text-align: center\">\r\n	（文、图/理学院 &nbsp;&nbsp;　　　　　　&nbsp;责编/陈磊）&nbsp;</p>\r\n<p>\r\n	&nbsp;</p>\r\n<div class=\"attch_item\">\r\n	<p style=\"text-align: center\">\r\n		<a class=\"pic\" href=\"http://news.cqut.edu.cn/attachment/201704/17144129_我校成功举办2017届毕业生理学类专场双选会.jpg\" target=\"_blank\" title=\"点击查看原图\"><img alt=\"我校成功举办2017届毕业生理学类专场双选会\" class=\"pic\" src=\"http://news.cqut.edu.cn/attachment/201704/17144129_我校成功举办2017届毕业生理学类专场双选会_thumb_3.jpg\"></a></p>\r\n	<p class=\"description\" style=\"text-align: center\">\r\n		我校成功举办2017届毕业生理学类专场双选会</p>\r\n</div>\r\n<div class=\"attch_item\">\r\n	<p style=\"text-align: center\">\r\n		<a class=\"pic\" href=\"http://news.cqut.edu.cn/attachment/201704/17144134_招就处与理学院相关领导在双选会现场指导就业.jpg\" target=\"_blank\" title=\"点击查看原图\"><img alt=\"招就处与理学院相关领导在双选会现场指导就业\" class=\"pic\" src=\"http://news.cqut.edu.cn/attachment/201704/17144134_招就处与理学院相关领导在双选会现场指导就业_thumb_3.jpg\"></a></p>\r\n	<p class=\"description\" style=\"text-align: center\">\r\n		招就处与理学院相关领导在双选会现场指导就业</p>\r\n</div>\r\n<div class=\"attch_item\">\r\n	<p style=\"text-align: center\">\r\n		<a class=\"pic\" href=\"http://news.cqut.edu.cn/attachment/201704/17144138_招聘单位现场为毕业生做招聘宣讲.jpg\" target=\"_blank\" title=\"点击查看原图\"><img alt=\"招聘单位现场为毕业生做招聘宣讲\" class=\"pic\" src=\"http://news.cqut.edu.cn/attachment/201704/17144138_招聘单位现场为毕业生做招聘宣讲_thumb_3.jpg\"></a></p>\r\n	<p class=\"description\" style=\"text-align: center\">\r\n		招聘单位现场为毕业生做招聘宣讲</p>\r\n</div>\r\n<div class=\"attch_item\">\r\n	<p style=\"text-align: center\">\r\n		<a class=\"pic\" href=\"http://news.cqut.edu.cn/attachment/201704/17144125_理学类双选会现场.jpg\" target=\"_blank\" title=\"点击查看原图\"><img alt=\"理学类双选会现场\" class=\"pic\" src=\"http://news.cqut.edu.cn/attachment/201704/17144125_理学类双选会现场_thumb_3.jpg\"></a></p>\r\n	<p class=\"description\" style=\"text-align: center\">\r\n		理学类双选会现场</p>\r\n	<p class=\"description\">\r\n		&nbsp;</p>\r\n	<p class=\"description\">\r\n		&nbsp;</p>\r\n</div>', '2017-03-31', null, '新闻通知', 'zz', null);
INSERT INTO `news` VALUES ('17', '理学类专场双选会', '<p>\r\n	&nbsp;&nbsp;&nbsp;&nbsp;</p>\r\n<p>\r\n	　　为进一步推进就业工作，加强就业工作针对性，更好地为毕业生就业提供精准服务，学校招生就业处、理学学院联合组织的2017届毕业生理学类专场双选会，于4月12日在第三实验楼A栋大厅举行。</p>\r\n<p>\r\n	　　据了解，本次专场双选会汇聚了重庆平伟实业股份有限公司、重庆四联光电科技有限公司、重庆联导金宏实业有限公司、重庆中显智能科技有限公司、爱建证券有限责任公司、、重庆市庆安电力安装工程有限公司、重庆大帝教育科技有限公司、中国人寿渝北支公司、重庆百年金福健康管理有限公司等近20家企业，为毕业生提供了涵盖大数据分析、应用物理、信息与计算科学、金融数学、电子、机械、车辆、计算机、外语、经管等多个领域共200余个优质岗位。</p>\r\n<p>\r\n	　　双选会现场，招就处相关领导、部分学院党总支书记、副书记、负责学生就业的学办老师，理学院党政领导、各专业系系主任、辅导员、毕业班班导师到场与招聘单位面对面交流，听取了招聘企业的用人需求和建议反馈，在现场为同学们进行就业指导和职业咨询，积极向用人单位推荐毕业生，鼓励毕业生在春季校园招聘的后期及时调整心态，吸取前阶段求职面试的经验教训，在激烈的就业竞争下顶住压力、积极主动、突破自我，结合自身情况不断调整、成熟，顺利求得合适的就业岗位。理学院举办本次双选会，旨在大力开拓就业渠道，搭建毕业生与用人单位的联系平台，切实促进学生就业。</p>\r\n<p>\r\n	　　据悉，本次双选会已有近50名毕业生与用人单位达成就业意向，理学院相关领导及老师将持续跟进后续的企业面试、录用情况，及时掌握企业用人需求和学生求职意向，有针对性地优化毕业生就业指导和服务工作，为2017届毕业生就业工作助力。</p>\r\n<p>\r\n	&nbsp;</p>\r\n<p style=\"text-align: center\">\r\n	（文、图/理学院 &nbsp;&nbsp;　　　　　　&nbsp;责编/陈磊）&nbsp;</p>\r\n<p>\r\n	&nbsp;</p>\r\n<div class=\"attch_item\">\r\n	<p style=\"text-align: center\">\r\n		<a class=\"pic\" href=\"http://news.cqut.edu.cn/attachment/201704/17144129_我校成功举办2017届毕业生理学类专场双选会.jpg\" target=\"_blank\" title=\"点击查看原图\"><img alt=\"我校成功举办2017届毕业生理学类专场双选会\" class=\"pic\" src=\"http://news.cqut.edu.cn/attachment/201704/17144129_我校成功举办2017届毕业生理学类专场双选会_thumb_3.jpg\"></a></p>\r\n	<p class=\"description\" style=\"text-align: center\">\r\n		我校成功举办2017届毕业生理学类专场双选会</p>\r\n</div>\r\n<div class=\"attch_item\">\r\n	<p style=\"text-align: center\">\r\n		<a class=\"pic\" href=\"http://news.cqut.edu.cn/attachment/201704/17144134_招就处与理学院相关领导在双选会现场指导就业.jpg\" target=\"_blank\" title=\"点击查看原图\"><img alt=\"招就处与理学院相关领导在双选会现场指导就业\" class=\"pic\" src=\"http://news.cqut.edu.cn/attachment/201704/17144134_招就处与理学院相关领导在双选会现场指导就业_thumb_3.jpg\"></a></p>\r\n	<p class=\"description\" style=\"text-align: center\">\r\n		招就处与理学院相关领导在双选会现场指导就业</p>\r\n</div>\r\n<div class=\"attch_item\">\r\n	<p style=\"text-align: center\">\r\n		<a class=\"pic\" href=\"http://news.cqut.edu.cn/attachment/201704/17144138_招聘单位现场为毕业生做招聘宣讲.jpg\" target=\"_blank\" title=\"点击查看原图\"><img alt=\"招聘单位现场为毕业生做招聘宣讲\" class=\"pic\" src=\"http://news.cqut.edu.cn/attachment/201704/17144138_招聘单位现场为毕业生做招聘宣讲_thumb_3.jpg\"></a></p>\r\n	<p class=\"description\" style=\"text-align: center\">\r\n		招聘单位现场为毕业生做招聘宣讲</p>\r\n</div>\r\n<div class=\"attch_item\">\r\n	<p style=\"text-align: center\">\r\n		<a class=\"pic\" href=\"http://news.cqut.edu.cn/attachment/201704/17144125_理学类双选会现场.jpg\" target=\"_blank\" title=\"点击查看原图\"><img alt=\"理学类双选会现场\" class=\"pic\" src=\"http://news.cqut.edu.cn/attachment/201704/17144125_理学类双选会现场_thumb_3.jpg\"></a></p>\r\n	<p class=\"description\" style=\"text-align: center\">\r\n		理学类双选会现场</p>\r\n	<p class=\"description\">\r\n		&nbsp;</p>\r\n	<p class=\"description\">\r\n		&nbsp;</p>\r\n</div>', '2017-04-06', null, '新闻通知', 'zz', null);
INSERT INTO `news` VALUES ('18', '我校成功举行2017届毕业生“社会工作类”双选会123', '寒假期间，图书馆将集中开放主馆部分区域，实时监测入馆人数，并灵活调整开放形式。同时，拟关闭包玉刚图书馆和李政道图书馆，以进一步节约能源。21', '2017-04-27', 'imgs/3.png', '资源下载', 'zz', '');
INSERT INTO `news` VALUES ('19', '重庆理工大学老年高等教育工作者协会赴潼南调研考察', '寒假期间，图书馆将集中开放主馆部分区域，实时监测入馆人数，并灵活调整开放形式。同时，拟关闭包玉刚图书馆和李政道图书馆，以进一步节约能源。			    ', '2017-04-27', 'imgs/return.jpg', '资源下载', 'zz', '');
INSERT INTO `news` VALUES ('20', '重庆理工大学第八届田径运动会圆满落幕', '寒假期间，图书馆将集中开放主馆部分区域，实时监测入馆人数，并灵活调整开放形式。同时，拟关闭包玉刚图书馆和李政道图书馆，以进一步节约能源。', '2017-04-12', 'imgs/return.jpg', '资源下载', 'zz', '');
INSERT INTO `news` VALUES ('21', '寻找“理”的盖世“音”雄——我校第二十八届校园之春之校园“十佳歌手”大赛圆满落幕', '寒假期间，图书馆将集中开放主馆部分区域，实时监测入馆人数，并灵活调整开放形式。同时，拟关闭包玉刚图书馆和李政道图书馆，以进一步节约能源。', '2017-04-03', 'imgs/return.jpg', '资源下载', 'zz', '');
INSERT INTO `news` VALUES ('22', '我校成功举办2017届毕业生理学类专场双选会', '寒假期间，图书馆将集中开放主馆部分区域，实时监测入馆人数，并灵活调整开放形式。同时，拟关闭包玉刚图书馆和李政道图书馆，以进一步节约能源。', '2017-03-31', 'imgs/return.jpg', '资源下载', 'zz', '');
INSERT INTO `news` VALUES ('23', '我校成功举办2017届毕业生理学123类专场双选会', '寒假期间，图书馆将集中开放主馆部分区域，实时监测入馆人数，并灵活调整开放形式。同时，拟关闭包玉刚图书馆和李政道图书馆，以进一步节约能源。', '2017-04-06', 'imgs/return.jpg', '资源下载', 'zz', '');
INSERT INTO `news` VALUES ('25', '调研考察', '寒假期间，图书馆将集中开放主馆部分区域，实时监测入馆人数，并灵活调整开放形式。同时，拟关闭包玉刚图书馆和李政道图书馆，以进一步节约能源。', '2017-04-18', 'imgs/return.jpg', '资源下载', 'zz', '');
INSERT INTO `news` VALUES ('26', '圆满落幕', '寒假期间，图书馆将集中开放主馆部分区域，实时监测入馆人数，并灵活调整开放形式。同时，拟关闭包玉刚图书馆和李政道图书馆，以进一步节约能源。', '2017-04-12', 'imgs/return.jpg', '资源下载', 'zz', '');
INSERT INTO `news` VALUES ('28', '专场双选会', '寒假期间，图书馆将集中开放主馆部分区域，实时监测入馆人数，并灵活调整开放形式。同时，拟关闭包玉刚图书馆和李政道图书馆，以进一步节约能源。', '2017-03-31', 'imgs/return.jpg', '资源下载', 'zz', '');
INSERT INTO `news` VALUES ('29', '理学类专场双选会', '寒假期间，图书馆将集中开放主馆部分区域，实时监测入馆人数，并灵活调整开放形式。同时，拟关闭包玉刚图书馆和李政道图书馆，以进一步节约能源。', '2017-04-06', 'imgs/return.jpg', '资源下载', 'zz', '');
INSERT INTO `news` VALUES ('30', '123', '123123123', '2017-04-27', 'imgs/2.png', '资源下载', 'zz', null);
INSERT INTO `news` VALUES ('31', '32', '<p>12</p>', '2017-04-27', null, '新闻通知', 'zz', null);

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
  `eachId` varchar(100) DEFAULT NULL,
  `orderDate` date NOT NULL,
  `orderType` varchar(100) NOT NULL,
  `memo` text,
  PRIMARY KEY (`orderId`),
  KEY `ddd` (`studentsId`),
  KEY `xxxxx` (`eachId`),
  CONSTRAINT `ddd` FOREIGN KEY (`studentsId`) REFERENCES `students` (`studentId`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `xxxxx` FOREIGN KEY (`eachId`) REFERENCES `eachbooks` (`eachId`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of orders
-- ----------------------------
INSERT INTO `orders` VALUES ('1', '95827', 't1232', '2017-01-15', '已取消', null);
INSERT INTO `orders` VALUES ('6', '95827', 't1232', '2017-04-20', '生效中', null);
INSERT INTO `orders` VALUES ('8', '95827', 't1241', '2017-04-21', '生效中', null);
INSERT INTO `orders` VALUES ('9', '95827', 't1251', '2017-04-21', '生效中', null);

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
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of owe
-- ----------------------------
INSERT INTO `owe` VALUES ('16', '6', '所借书籍超期', '0.5', '0.5', '2017-01-17', null);
INSERT INTO `owe` VALUES ('17', '9', '所借书籍超期', '0.1', '0.1', '2017-01-18', null);
INSERT INTO `owe` VALUES ('19', '12', '所借书籍超期', '0.5', '0.5', '2017-01-17', null);
INSERT INTO `owe` VALUES ('20', '13', '所借书籍超期', '0.1', '0.1', '2017-01-18', null);
INSERT INTO `owe` VALUES ('21', '15', '所借书籍超期', '6.1', '6.1', '2017-04-19', null);
INSERT INTO `owe` VALUES ('22', '17', '所借书籍超期', '0.5', '0.5', '2017-01-17', null);
INSERT INTO `owe` VALUES ('23', '18', '所借书籍超期', '0.1', '0.1', '2017-01-18', null);
INSERT INTO `owe` VALUES ('24', '21', '所借书籍超期', '0.5', '0.5', '2017-01-17', null);
INSERT INTO `owe` VALUES ('25', '22', '所借书籍超期', '0.1', '0.1', '2017-01-18', null);
INSERT INTO `owe` VALUES ('26', '10', '所借书籍超期', '6', '6', '2017-03-20', null);
INSERT INTO `owe` VALUES ('27', '14', '所借书籍超期', '7.5', '7.5', '2017-04-05', null);
INSERT INTO `owe` VALUES ('28', '19', '所借书籍超期', '3.5', '3.5', '2017-02-23', null);
INSERT INTO `owe` VALUES ('29', '23', '所借书籍超期', '3.5', '3.5', '2017-02-23', null);

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
INSERT INTO `recommends` VALUES ('4', '95827', 'javascript从入门到放弃', '雷迪嘎嘎', '英文', '123-456-789-123', '这这本书啊非常的好这本书啊非常的好本书啊非常的这这本书啊非常的好这本书啊非常的好本书啊非常的好这这本书啊非常的好这本书啊非常的好本书啊非常的好好', '人民出版社', '2017-01-18', '2', '未购买', '');
INSERT INTO `recommends` VALUES ('5', '95108', '红楼梦', '施耐庵', null, '1123-45664-213', '去玩儿退欧浦自行车VB你们爱上对方过后就哭了', '北京出版社', '2017-01-18', '2', '未购买', null);

-- ----------------------------
-- Table structure for records
-- ----------------------------
DROP TABLE IF EXISTS `records`;
CREATE TABLE `records` (
  `recordId` int(11) NOT NULL AUTO_INCREMENT,
  `studentId` varchar(100) NOT NULL,
  `eachId` varchar(100) NOT NULL,
  `startDate` date NOT NULL,
  `destine` date NOT NULL,
  `endDate` date DEFAULT NULL,
  `renew` int(11) DEFAULT '0',
  `memo` text,
  PRIMARY KEY (`recordId`),
  KEY `c` (`studentId`),
  KEY `cccc` (`eachId`),
  CONSTRAINT `c` FOREIGN KEY (`studentId`) REFERENCES `students` (`studentId`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `cccc` FOREIGN KEY (`eachId`) REFERENCES `eachbooks` (`eachId`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of records
-- ----------------------------
INSERT INTO `records` VALUES ('5', '95827', 't1232', '2016-12-01', '2017-01-17', '2017-01-16', '1', null);
INSERT INTO `records` VALUES ('6', '95827', 't1281', '2016-11-24', '2017-01-12', '2017-01-17', '2', null);
INSERT INTO `records` VALUES ('9', '95827', 't1271', '2016-12-22', '2017-01-17', '2017-01-18', '2', null);
INSERT INTO `records` VALUES ('10', '95108', 't1302', '2017-01-19', '2017-01-19', '2017-03-20', '0', null);
INSERT INTO `records` VALUES ('11', '95827', 't1322', '2016-12-01', '2017-01-17', '2017-01-16', '1', '');
INSERT INTO `records` VALUES ('12', '95827', 't1241', '2016-11-24', '2017-01-12', '2017-01-17', '2', '');
INSERT INTO `records` VALUES ('13', '95827', 't1251', '2016-12-22', '2017-01-17', '2017-01-18', '2', '');
INSERT INTO `records` VALUES ('14', '95108', 't1262', '2017-01-19', '2017-01-19', '2017-04-05', '0', '');
INSERT INTO `records` VALUES ('15', '95827', 't1381', '2017-01-12', '2017-02-17', '2017-04-19', '1', '');
INSERT INTO `records` VALUES ('16', '95827', 't1372', '2016-12-01', '2017-01-17', '2017-01-16', '1', '');
INSERT INTO `records` VALUES ('17', '95827', 't1262', '2016-11-24', '2017-01-12', '2017-01-17', '2', '');
INSERT INTO `records` VALUES ('18', '95827', 't1262', '2016-12-22', '2017-01-17', '2017-01-18', '2', '');
INSERT INTO `records` VALUES ('19', '95108', 't1331', '2017-01-19', '2017-01-19', '2017-02-23', '0', '');
INSERT INTO `records` VALUES ('20', '95827', 't1351', '2016-12-01', '2017-01-17', '2017-01-16', '1', '');
INSERT INTO `records` VALUES ('21', '95827', 't1322', '2016-11-24', '2017-01-12', '2017-01-17', '2', '');
INSERT INTO `records` VALUES ('22', '95827', 't1331', '2016-12-22', '2017-01-17', '2017-01-18', '2', '');
INSERT INTO `records` VALUES ('23', '95108', 't1351', '2017-01-19', '2017-01-19', '2017-02-23', '0', '');

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
INSERT INTO `students` VALUES ('95108', '崽崽z', '123456z', 'imgs/4.jpg', '123z@11.com', '重庆理工z大学花溪校区', '123456z', '15178744811z', '0', null);
INSERT INTO `students` VALUES ('9555', '昵好', 'weishuangjian', 'imgs/nav6.png', '', '', '', '', '0', null);
INSERT INTO `students` VALUES ('95827', '昵好', '123456', 'imgs/timg.jpg', '1607074855@qq.com', '重庆理工大学', '1607074855', '15310274364', '0', null);
INSERT INTO `students` VALUES ('t123', '图解CSS3', '', '', '', '', '', '', '0', null);
