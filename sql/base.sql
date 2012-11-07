-- Tables for timeline. Probably could use a smarter method :/
-- Contributor: Paolo :D
-- Written By Aditya Jain

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `timeline`
-- ----------------------------
DROP TABLE IF EXISTS `timeline`;
CREATE TABLE `timeline` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `year` int(11) NOT NULL,
  `suffix` tinytext NOT NULL,
  `invention` text NOT NULL,
  `desc` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for `timeline_bc`
-- ----------------------------
DROP TABLE IF EXISTS `timeline_bc`;
CREATE TABLE `timeline_bc` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `year` int(11) NOT NULL,
  `suffix` tinytext NOT NULL,
  `invention` text NOT NULL,
  `desc` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;