-- MySQL dump 10.13  Distrib 5.5.46, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: workshop
-- ------------------------------------------------------
-- Server version	5.5.46-0ubuntu0.14.04.2

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `items`
--

DROP TABLE IF EXISTS `items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `items` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `approve` tinyint(1) DEFAULT NULL,
  `image_url` text COLLATE utf8_unicode_ci NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `items_user_id_foreign` (`user_id`),
  CONSTRAINT `items_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `items`
--

LOCK TABLES `items` WRITE;
/*!40000 ALTER TABLE `items` DISABLE KEYS */;
INSERT INTO `items` VALUES (1,'2016-04-01 22:37:36','2016-04-01 22:37:36','Burnice Wisoky V','Tenetur porro omnis omnis. Voluptatem et in earum maiores et odio sapiente.',NULL,'http://www.atlas-admin.com/images/placeholder.png',1),(2,'2016-04-01 22:37:36','2016-04-01 22:37:36','Robert Satterfield','Repudiandae in quibusdam expedita exercitationem nobis. Labore sunt ad ea est. Aut rerum velit quos dolores eligendi et iusto.',NULL,'http://www.atlas-admin.com/images/placeholder.png',10),(3,'2016-04-01 22:37:36','2016-04-01 22:37:36','Minnie Herzog','Laborum expedita exercitationem amet adipisci beatae consequuntur consequatur. Dicta distinctio et dolores.',NULL,'http://www.atlas-admin.com/images/placeholder.png',2),(4,'2016-04-01 22:37:37','2016-04-01 22:37:37','Janiya Lang I','Maxime fuga sint culpa enim ut. Enim et consequatur soluta cumque facilis explicabo cum rem.',NULL,'http://www.atlas-admin.com/images/placeholder.png',7),(5,'2016-04-01 22:37:37','2016-04-01 22:37:37','Mrs. Yasmeen Lowe DVM','Aut est earum exercitationem ea libero qui. Quia amet molestiae voluptates eaque non pariatur hic. In vel quis voluptatem quis.',NULL,'http://www.atlas-admin.com/images/placeholder.png',6),(6,'2016-04-01 22:37:37','2016-04-01 22:37:37','Ms. Marianna Bartell','Ipsa accusantium quibusdam error est. Rerum qui qui ipsum amet est doloribus. Temporibus laudantium reiciendis omnis possimus fuga excepturi. Ut veritatis dicta quis nihil non minima.',NULL,'http://www.atlas-admin.com/images/placeholder.png',5),(7,'2016-04-01 22:37:37','2016-04-01 22:37:37','Alvah Schowalter','Odio qui nihil magni distinctio et. Facilis rerum rerum ut qui ut. Ducimus nulla beatae ducimus explicabo qui.',NULL,'http://www.atlas-admin.com/images/placeholder.png',3),(8,'2016-04-01 22:37:37','2016-04-01 22:37:37','Peyton Graham','Esse quasi optio sequi voluptate. Voluptas veniam rerum esse nihil. Dolor aliquid quia tempore quia dicta. Repellendus natus eum impedit dolor dolorem.',NULL,'http://www.atlas-admin.com/images/placeholder.png',5),(9,'2016-04-01 22:37:37','2016-04-01 22:37:37','Mr. Milford Feeney','Possimus ut est reprehenderit ad et. Ipsa dolorem sunt architecto est quia dolor voluptatem. Fuga explicabo ut iusto in qui. Et vitae omnis excepturi voluptatum saepe.',NULL,'http://www.atlas-admin.com/images/placeholder.png',3),(10,'2016-04-01 22:37:37','2016-04-01 22:37:37','Michael Stroman II','Rem facere quia tenetur modi enim. Deserunt quibusdam voluptatibus ad ut. In velit saepe velit a aut temporibus architecto.',NULL,'http://www.atlas-admin.com/images/placeholder.png',2),(11,'2016-04-01 22:37:37','2016-04-01 22:37:37','Mr. Efren Mann DVM','Qui pariatur repudiandae voluptas rerum sit fugit incidunt. Ut est aut tempora consequatur dignissimos. Ea voluptatum sunt ad cumque.',NULL,'http://www.atlas-admin.com/images/placeholder.png',2),(12,'2016-04-01 22:37:37','2016-04-01 22:37:37','Amani Donnelly DVM','Id culpa est voluptatem necessitatibus. Laudantium doloribus quo sint quas officia. Tempora natus dolorum in fugit ducimus tenetur ut.',NULL,'http://www.atlas-admin.com/images/placeholder.png',7),(13,'2016-04-01 22:37:37','2016-04-01 22:37:37','Coty Beatty','Nobis assumenda deserunt ad exercitationem illo culpa. Molestias eum vel nulla iusto qui nam ut. Doloremque veniam rerum eveniet recusandae accusamus minima nemo omnis.',NULL,'http://www.atlas-admin.com/images/placeholder.png',3),(14,'2016-04-01 22:37:37','2016-04-01 22:37:37','Adella Predovic','Eum et ipsam nesciunt perspiciatis. Velit ipsa aliquam doloribus in suscipit reprehenderit sed exercitationem. Omnis ea quos est iste voluptatem aut.',NULL,'http://www.atlas-admin.com/images/placeholder.png',8),(15,'2016-04-01 22:37:37','2016-04-01 22:37:37','Timmothy Grant','Dolor aut dolor voluptatum modi aperiam aliquam nobis. Rerum ab autem et esse et eum quo. Tenetur quia et sed aperiam. Fugiat esse necessitatibus rerum.',NULL,'http://www.atlas-admin.com/images/placeholder.png',5),(16,'2016-04-01 22:37:37','2016-04-01 22:37:37','Prof. Thea Stokes Sr.','Placeat beatae maiores ex numquam minima. Nostrum qui occaecati animi placeat consequuntur omnis quia. Repellendus nulla et fuga at officia. Voluptatem quos nisi ad assumenda totam.',NULL,'http://www.atlas-admin.com/images/placeholder.png',1),(17,'2016-04-01 22:37:37','2016-04-01 22:37:37','Alfreda Raynor','Reprehenderit explicabo aspernatur sit nemo eos quos. Sequi dolor odio officiis iusto rerum numquam. Non excepturi voluptatem autem.',NULL,'http://www.atlas-admin.com/images/placeholder.png',8),(18,'2016-04-01 22:37:37','2016-04-01 22:37:37','Dr. Celine O\'Conner','Aut eos molestiae quisquam dolor. Nemo eum non ut veritatis architecto. Eveniet ipsam sit aliquam dolorem tenetur ducimus.',NULL,'http://www.atlas-admin.com/images/placeholder.png',9),(19,'2016-04-01 22:37:37','2016-04-01 22:37:37','Jeanie Grimes','Magni aut qui consequatur non ut animi. Est laboriosam sint ullam. Est voluptatum iure dolores sed.',NULL,'http://www.atlas-admin.com/images/placeholder.png',8),(20,'2016-04-01 22:37:37','2016-04-01 22:37:37','Era Lynch','Et iste ea minima eligendi perspiciatis accusantium voluptatibus. Nihil harum possimus architecto provident. Libero sed iusto velit hic. Quasi quo quia accusantium ab ratione ullam recusandae.',NULL,'http://www.atlas-admin.com/images/placeholder.png',5),(21,'2016-04-01 22:37:37','2016-04-01 22:37:37','Mr. Myrl Friesen','Quo assumenda molestiae quasi et expedita voluptas corporis. Rem et id iure iure enim est a. Eum adipisci atque omnis. Quis modi aperiam est atque quisquam.',NULL,'http://www.atlas-admin.com/images/placeholder.png',9),(22,'2016-04-01 22:37:38','2016-04-01 22:45:07','Dr. Margot Gaylord DDS','Ea beatae similique accusamus et. Quam omnis quasi esse nihil minus et. Et voluptatem et ipsa deleniti dolor maxime accusamus.',0,'http://www.atlas-admin.com/images/placeholder.png',2),(23,'2016-04-01 22:37:38','2016-04-01 22:37:38','Ms. Gretchen Jones','Architecto architecto aut sint ratione quo. Sequi aut eaque et consequuntur.\nQui placeat deleniti doloribus. Et velit cupiditate praesentium culpa eaque. Suscipit qui dolorem voluptatum suscipit.',NULL,'http://www.atlas-admin.com/images/placeholder.png',2),(24,'2016-04-01 22:37:38','2016-04-01 22:37:38','Dr. Katharina Nitzsche','Animi assumenda amet nostrum nisi. Voluptatem repellat et suscipit necessitatibus. Consequatur saepe autem minus laborum sed fuga. Qui ea cumque quidem voluptas.',NULL,'http://www.atlas-admin.com/images/placeholder.png',1),(25,'2016-04-01 22:37:38','2016-04-01 22:37:38','Zaria Metz I','Dicta dicta sint qui. Quia et libero aliquam odio id dolor autem minus. Eum corporis sunt blanditiis quasi.',NULL,'http://www.atlas-admin.com/images/placeholder.png',5),(26,'2016-04-01 22:37:38','2016-04-01 22:37:38','Avery Herzog','At exercitationem enim et quae. Dolores non cupiditate aut ipsam. Dolorem omnis modi velit corporis. Nesciunt odio cum nam velit.',NULL,'http://www.atlas-admin.com/images/placeholder.png',9),(27,'2016-04-01 22:37:38','2016-04-01 22:37:38','Dr. Alanna Tromp','Cumque quia totam atque recusandae a sint laboriosam. Vel delectus labore iste non ea facilis. Beatae quia quis perferendis quae inventore.',NULL,'http://www.atlas-admin.com/images/placeholder.png',10),(28,'2016-04-01 22:37:38','2016-04-01 22:37:38','Ms. Chanel Williamson II','Possimus dolores illum excepturi aut deserunt deserunt. Explicabo eos reprehenderit dolor aspernatur dolor quaerat odit. Velit omnis voluptates assumenda doloremque dolores. Beatae amet non non quia.',NULL,'http://www.atlas-admin.com/images/placeholder.png',6),(29,'2016-04-01 22:37:38','2016-04-01 22:37:38','Myriam Buckridge','Ullam est et repellendus error asperiores aut aut. Veniam est debitis molestiae. Ut non maxime quo et dolorem. Aut et omnis numquam dolores beatae.',NULL,'http://www.atlas-admin.com/images/placeholder.png',3),(30,'2016-04-01 22:37:38','2016-04-01 22:37:38','Myrna Kunze','Voluptates cum labore laborum explicabo iusto iste. Sit voluptatem beatae ducimus porro omnis et. Numquam odio odit quibusdam non dicta.',NULL,'http://www.atlas-admin.com/images/placeholder.png',8);
/*!40000 ALTER TABLE `items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES ('2016_02_19_163606_create_users_table',1),('2016_03_29_120653_create_items_table',1),('2016_03_31_130055_create_votes_table',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `full_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `mobile_number` int(11) NOT NULL,
  `is_staff` tinyint(1) NOT NULL DEFAULT '0',
  `token` char(36) COLLATE utf8_unicode_ci NOT NULL,
  `token_updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  UNIQUE KEY `users_token_unique` (`token`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'2016-04-01 22:37:36','2016-04-01 22:37:36','Carmela Harvey','Dawson.Gerhold@yahoo.com','10',4774449,0,'bb620291-5a51-3bed-92c2-014e70ad53a6','0000-00-00 00:00:00'),(2,'2016-04-01 22:37:36','2016-04-01 22:37:36','Emerald Schroeder','xThiel@yahoo.com','5',4566279,0,'eca801a8-270d-3daf-b09e-0fef11ff7387','0000-00-00 00:00:00'),(3,'2016-04-01 22:37:36','2016-04-01 22:37:36','Rico Torphy','Barrows.Meghan@Wilderman.com','6',5960970,0,'d6b52a94-c4b2-39f0-ba0c-d3afa3e5fe17','0000-00-00 00:00:00'),(4,'2016-04-01 22:37:36','2016-04-01 22:37:36','Vesta Romaguera','Ashtyn.Gleichner@hotmail.com','1',5496334,0,'df876d1a-5786-3468-b7b1-918d06b9a6b6','0000-00-00 00:00:00'),(5,'2016-04-01 22:37:36','2016-04-01 22:37:36','Mrs. Hassie Block','eMante@Doyle.com','1',1104350,0,'21f45ee1-59f8-3360-a204-a642ea0ab594','0000-00-00 00:00:00'),(6,'2016-04-01 22:37:36','2016-04-01 22:37:36','Cesar White','Vida.Hyatt@gmail.com','3',2049834,0,'a9c0d7aa-02bf-372c-bd80-06a82692c1af','0000-00-00 00:00:00'),(7,'2016-04-01 22:37:36','2016-04-01 22:37:36','Nellie Leannon','Glenda.Glover@hotmail.com','5',1773584,0,'bfca7901-f4e3-31af-92af-9b9da0a58051','0000-00-00 00:00:00'),(8,'2016-04-01 22:37:36','2016-04-01 22:37:36','Dr. Arnoldo Daugherty','wBechtelar@Koelpin.com','7',4139704,0,'5974c2d6-f821-3cc8-a28d-6a0eefd51d75','0000-00-00 00:00:00'),(9,'2016-04-01 22:37:36','2016-04-01 22:37:36','Corbin Schumm','sKeeling@Keebler.com','2',532760,0,'cf107c05-31c2-32cf-b313-d0afe3ced436','0000-00-00 00:00:00'),(10,'2016-04-01 22:37:36','2016-04-01 22:37:36','Prof. Gage Smith','Cole.Dangelo@hotmail.com','1',5744866,0,'dce6b4ba-173f-31f6-9ed1-06950f024edc','0000-00-00 00:00:00'),(11,'2016-04-01 22:44:26','2016-04-01 22:44:26','admin','admin@admin.com','$2y$10$pt24rxVomXy6dpcFjA5aHuUMy3N22NEcDJcV5otd01gV9RnL5S7Y6',123465456,1,'79b359c9-c83f-47d9-9b8d-b99bceef978b','0000-00-00 00:00:00');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `votes`
--

DROP TABLE IF EXISTS `votes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `votes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `value` tinyint(1) NOT NULL,
  `item_id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `votes_item_id_foreign` (`item_id`),
  KEY `votes_user_id_foreign` (`user_id`),
  CONSTRAINT `votes_item_id_foreign` FOREIGN KEY (`item_id`) REFERENCES `items` (`id`),
  CONSTRAINT `votes_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `votes`
--

LOCK TABLES `votes` WRITE;
/*!40000 ALTER TABLE `votes` DISABLE KEYS */;
/*!40000 ALTER TABLE `votes` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-04-02 19:01:12
