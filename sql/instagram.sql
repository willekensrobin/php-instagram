# ************************************************************
# Sequel Pro SQL dump
# Version 4541
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: localhost (MySQL 5.5.38)
# Database: instagram
# Generation Time: 2016-04-18 18:29:18 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table db_comments
# ------------------------------------------------------------

DROP TABLE IF EXISTS `db_comments`;

CREATE TABLE `db_comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `comment` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



# Dump of table db_following
# ------------------------------------------------------------

DROP TABLE IF EXISTS `db_following`;

CREATE TABLE `db_following` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `id_follower` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



# Dump of table db_likes
# ------------------------------------------------------------

DROP TABLE IF EXISTS `db_likes`;

CREATE TABLE `db_likes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `id_voterequest` int(11) NOT NULL,
  `id_picture` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Dump of table db_picture
# ------------------------------------------------------------

DROP TABLE IF EXISTS `db_picture`;

CREATE TABLE `db_picture` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `picture` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT '',
  `description` varchar(1000) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



# Dump of table db_tags
# ------------------------------------------------------------

DROP TABLE IF EXISTS `db_tags`;

CREATE TABLE `db_tags` (
  `id` int(11) NOT NULL,
  `id_picture` int(11) NOT NULL,
  `tag` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



# Dump of table db_users
# ------------------------------------------------------------

DROP TABLE IF EXISTS `db_users`;

CREATE TABLE `db_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `fullname` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `picture` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `role` int(3) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `db_users` WRITE;
/*!40000 ALTER TABLE `db_users` DISABLE KEYS */;

INSERT INTO `db_users` (`id`, `username`, `fullname`, `email`, `password`, `picture`, `role`)
VALUES
	(1,X'526F62696E',X'526F62696E2057696C6C656B656E73','willekensrobin@hotmail.com',X'24327924313024395075615A575175634A33506C33755957614943784F70507846764138574D3046304A4169343461425370553759417A4E61576771',X'',0),
	(2,X'4A756E74',X'526F62696E2057696C6C656B656E73','robinwillekens@hotmail.com',X'243279243130246A592E74302F75587773644842666A4D7548386B34753459656143725230326935574B484C4A576A7031486C553361793463703743',X'',0);

/*!40000 ALTER TABLE `db_users` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
