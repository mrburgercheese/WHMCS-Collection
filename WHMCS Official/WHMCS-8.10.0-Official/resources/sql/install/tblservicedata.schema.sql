/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
DROP TABLE IF EXISTS `tblservicedata`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tblservicedata` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `service_id` int unsigned DEFAULT NULL,
  `addon_id` int unsigned DEFAULT NULL,
  `client_id` int unsigned NOT NULL,
  `actor` char(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `scope` char(32) COLLATE utf8_unicode_ci NOT NULL,
  `name` char(64) COLLATE utf8_unicode_ci NOT NULL,
  `value` char(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `expires_at` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `tblservicedata_service_id_index` (`service_id`),
  KEY `tblservicedata_addon_id_index` (`addon_id`),
  KEY `tblservicedata_client_id_index` (`client_id`),
  KEY `actor` (`actor`(16)),
  KEY `scope` (`scope`(16)),
  KEY `name` (`name`(16)),
  KEY `tblservicedata_expires_at_index` (`expires_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

