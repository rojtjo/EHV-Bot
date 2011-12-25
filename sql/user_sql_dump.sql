SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `salt` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

INSERT INTO `users` VALUES(1, 'rojtjo@gmail.com', 'Rojtjo', '3c5ad935df69297bbe4841b61c8bdbf2687f6cc9', '19e03573cea82a707f631336867ba119d04acaff');