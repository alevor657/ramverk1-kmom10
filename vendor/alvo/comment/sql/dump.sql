/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Book` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(256) COLLATE utf8_swedish_ci NOT NULL,
  `author` varchar(256) COLLATE utf8_swedish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Comment` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `text` longtext NOT NULL,
  `heading` varchar(45) NOT NULL,
  `created` datetime DEFAULT CURRENT_TIMESTAMP,
  `userId` int(11) NOT NULL,
  `updated` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `deleted` datetime DEFAULT NULL,
  `tags` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  UNIQUE KEY `idReply_UNIQUE` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;
INSERT INTO `Comment` VALUES (28,'ASD','TESTHEADING2','2017-09-29 21:09:30',47,'2017-09-29 21:28:15','2017-09-29 21:28:19','A S D DD');
INSERT INTO `Comment` VALUES (29,'ASD','TESTHEADING3','2017-09-29 21:29:29',47,NULL,NULL,'D S A');
INSERT INTO `Comment` VALUES (30,'ASDSAD','TESTHEADING2','2017-10-01 17:59:45',51,'2017-10-01 17:59:57',NULL,'A S D DD');
INSERT INTO `Comment` VALUES (31,'ASDDDDDDDDDDDDDBB\r\nbbb','TESTHEADING34','2017-10-12 14:50:00',52,'2017-10-12 14:52:29',NULL,'AA SSS      SAD');
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `User` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(80) COLLATE utf8_swedish_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_swedish_ci NOT NULL,
  `created` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `deleted` datetime DEFAULT NULL,
  `admin` tinyint(4) DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `acronym` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=53 DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
INSERT INTO `User` VALUES (50,'alevor657@gmail.com','$2y$10$j8Hg.IkZVf43PFImWWEzL.0gWQPvvHaR2SNpoJy4S1DOqQUnlstSq','2017-10-01 17:31:29','2017-10-01 17:53:19',NULL,1);
INSERT INTO `User` VALUES (51,'test@asd.aa','$2y$10$Xh/FIAjl.cYo4QNZNMYIUOYlT/zXckFBSisxoRjrGvRqyoel1IfNm','2017-10-01 17:31:32','2017-10-01 17:58:18',NULL,NULL);
INSERT INTO `User` VALUES (52,'test@asd.a','$2y$10$zp2mYt5q9r/8DrJHxTwC..Zu4GqrPp2F9fwaz8W.SATipGOCEa5E2','2017-10-12 14:49:43',NULL,NULL,NULL);
