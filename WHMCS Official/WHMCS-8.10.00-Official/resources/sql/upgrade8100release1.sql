-- Create tblservicedata table
CREATE TABLE IF NOT EXISTS `tblservicedata` (
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
