-- Add new index (date) for date column in tblactivitylog
set @query = if ((SELECT count(INDEX_NAME) FROM INFORMATION_SCHEMA.STATISTICS WHERE TABLE_SCHEMA = database() AND TABLE_NAME = 'tblactivitylog' AND INDEX_NAME = 'date') = 0, 'CREATE INDEX `date` ON `tblactivitylog` (`date`)', 'DO 0');
prepare statement from @query;
execute statement;
deallocate prepare statement;

-- Add new index (user) for user column in tblactivitylog
set @query = if ((SELECT count(INDEX_NAME) FROM INFORMATION_SCHEMA.STATISTICS WHERE TABLE_SCHEMA = database() AND TABLE_NAME = 'tblactivitylog' AND INDEX_NAME = 'user') = 0, 'CREATE INDEX `user` ON `tblactivitylog` (`user`(255))', 'DO 0');
prepare statement from @query;
execute statement;
deallocate prepare statement;

-- Reintroduce table mod_invoicedata in the event it went missing. It had a history of being related to an addon module, and being dynamically created.
CREATE TABLE IF NOT EXISTS `mod_invoicedata` (
    `id` int(10) NOT NULL AUTO_INCREMENT,
    `invoiceid` int(10) NOT NULL,
    `clientsdetails` text COLLATE utf8_unicode_ci NOT NULL,
    `customfields` text COLLATE utf8_unicode_ci NOT NULL,
    `version` varchar(255) COLLATE utf8_unicode_ci NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Add new column (version) to mod_invoicedata
set @query = if ((SELECT COUNT(*) FROM INFORMATION_SCHEMA.COLUMNS WHERE table_schema = database() AND TABLE_NAME = 'mod_invoicedata' AND COLUMN_NAME  = 'version') = 0, 'ALTER TABLE `mod_invoicedata` ADD `version` VARCHAR(255) COLLATE utf8_unicode_ci NULL AFTER `customfields`', 'DO 0');
prepare statement from @query;
execute statement;
deallocate prepare statement;
