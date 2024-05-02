/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
DROP TABLE IF EXISTS `tblondemandrenewals`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tblondemandrenewals` (
    `id` int unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `rel_type` enum('Product', 'Addon') NOT NULL,
    `rel_id` int NOT NULL DEFAULT '0',
    `enabled` tinyint NOT NULL DEFAULT '0',
    `monthly` tinyint NOT NULL DEFAULT '0',
    `quarterly` tinyint NOT NULL DEFAULT '0',
    `semiannually` smallint NOT NULL DEFAULT '0',
    `annually` smallint NOT NULL DEFAULT '0',
    `biennially` smallint NOT NULL DEFAULT '0',
    `triennially` smallint NOT NULL DEFAULT '0',
    UNIQUE KEY `tblondemandrenewals_rel_type_rel_id_unique` (`rel_type`, `rel_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
