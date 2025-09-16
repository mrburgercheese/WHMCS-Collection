-- Update tblconfiguration.value column type from text to mediumtext
SET @query = IF ((SELECT COUNT(*) FROM information_schema.columns WHERE table_schema = database() AND TABLE_NAME = 'tblconfiguration' AND COLUMN_NAME = 'value' and COLUMN_TYPE='text') = 1, 'ALTER TABLE `tblconfiguration` MODIFY `value` mediumtext NOT NULL', 'DO 0;');
PREPARE statement FROM @query;
EXECUTE statement;
DEALLOCATE PREPARE statement;

-- Add new upsell_from_products column to tblhostingaddons
SET @query = IF ((SELECT COUNT(*) FROM information_schema.columns WHERE table_schema = database() AND TABLE_NAME = 'tblhostingaddons' AND COLUMN_NAME = 'upsell_from_products') = 0, 'ALTER TABLE `tblhostingaddons` ADD `upsell_from_products` varchar(40) DEFAULT NULL AFTER `subscriptionid`', 'DO 0;');
PREPARE statement FROM @query;
EXECUTE statement;
DEALLOCATE PREPARE statement;

-- Adjust upsell_from_products column length to tblhosting
SET @query = 'ALTER TABLE `tblhosting` CHANGE `upsell_from_products` `upsell_from_products` varchar(40) DEFAULT NULL';
PREPARE statement FROM @query;
EXECUTE statement;
DEALLOCATE PREPARE statement;
