-- Add processor_id column to tblticketactions
SET @query = IF ((SELECT COUNT(*) FROM information_schema.columns WHERE table_schema = database() AND TABLE_NAME = 'tblticketactions' AND COLUMN_NAME = 'processor_id') = 0, 'ALTER TABLE `tblticketactions` ADD `processor_id` varchar(32) DEFAULT NULL AFTER `status_at`', 'DO 0');
PREPARE statement FROM @query;
EXECUTE statement;
DEALLOCATE PREPARE statement;

-- Add new pinned_at column to tbltickets
SET @query = IF ((SELECT COUNT(*) FROM information_schema.columns WHERE table_schema = database() AND TABLE_NAME = 'tbltickets' AND COLUMN_NAME = 'pinned_at') = 0, 'ALTER TABLE `tbltickets` ADD `pinned_at` datetime DEFAULT NULL AFTER `editor`', 'DO 0');
PREPARE statement FROM @query;
EXECUTE statement;
DEALLOCATE PREPARE statement;

set @query = if ((SELECT count(INDEX_NAME) FROM INFORMATION_SCHEMA.STATISTICS WHERE TABLE_SCHEMA = database() AND TABLE_NAME = 'tblticketactions' AND INDEX_NAME = 'stat_sched_idx') = 0, 'CREATE INDEX `stat_sched_idx` ON `tblticketactions` (`status`,`scheduled`);', 'DO 0');
prepare statement from @query;
execute statement;
deallocate prepare statement;

-- Add new purchase_source column to tblorders
SET @query = IF ((SELECT COUNT(*) FROM information_schema.columns WHERE table_schema = database() AND TABLE_NAME = 'tblorders' AND COLUMN_NAME = 'purchase_source') = 0, 'ALTER TABLE `tblorders` ADD `purchase_source` int(10) UNSIGNED NOT NULL DEFAULT 4 AFTER `notes`', 'DO 0;');
PREPARE statement FROM @query;
EXECUTE statement;
DEALLOCATE PREPARE statement;

-- Add new has_referral_products column to tblorders
SET @query = IF ((SELECT COUNT(*) FROM information_schema.columns WHERE table_schema = database() AND TABLE_NAME = 'tblorders' AND COLUMN_NAME = 'has_referral_products') = 0, 'ALTER TABLE `tblorders` ADD `has_referral_products` smallint(3) unsigned NOT NULL DEFAULT 0', 'DO 0;');
PREPARE statement FROM @query;
EXECUTE statement;
DEALLOCATE PREPARE statement;

-- Add new upsell_from_products column to tblhosting
SET @query = IF ((SELECT COUNT(*) FROM information_schema.columns WHERE table_schema = database() AND TABLE_NAME = 'tblhosting' AND COLUMN_NAME = 'upsell_from_products') = 0, 'ALTER TABLE `tblhosting` ADD `upsell_from_products` varchar(20) DEFAULT NULL AFTER `bwlimit`', 'DO 0;');
PREPARE statement FROM @query;
EXECUTE statement;
DEALLOCATE PREPARE statement;

-- Add new recommendation_source_product_id column to tblhosting
SET @query = IF ((SELECT COUNT(*) FROM information_schema.columns WHERE table_schema = database() AND TABLE_NAME = 'tblhosting' AND COLUMN_NAME = 'recommendation_source_product_id') = 0, 'ALTER TABLE `tblhosting` ADD `recommendation_source_product_id` INT(10) unsigned NULL DEFAULT NULL AFTER `subscriptionid`', 'DO 0;');
PREPARE statement FROM @query;
EXECUTE statement;
DEALLOCATE PREPARE statement;
