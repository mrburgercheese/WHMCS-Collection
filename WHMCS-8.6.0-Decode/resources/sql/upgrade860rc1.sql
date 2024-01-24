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

-- Add new column (version) to mod_invoicedata
set @query = if ((SELECT COUNT(*) FROM INFORMATION_SCHEMA.COLUMNS WHERE table_schema = database() AND TABLE_NAME = 'mod_invoicedata' AND COLUMN_NAME  = 'version') = 0, 'ALTER TABLE `mod_invoicedata` ADD `version` VARCHAR(255) COLLATE utf8_unicode_ci NULL AFTER `customfields`', 'DO 0');
prepare statement from @query;
execute statement;
deallocate prepare statement;
