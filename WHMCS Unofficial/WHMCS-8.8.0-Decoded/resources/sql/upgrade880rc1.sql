-- Add new index (date) for date column in tblinvoices
set @query = if ((SELECT count(INDEX_NAME) FROM INFORMATION_SCHEMA.STATISTICS WHERE TABLE_SCHEMA = database() AND TABLE_NAME = 'tblinvoices' AND INDEX_NAME = 'duedate') = 0, 'CREATE INDEX `duedate` ON `tblinvoices` (`duedate`)', 'DO 0');
prepare statement from @query;
execute statement;
deallocate prepare statement;

-- Add composite index for client id and client status in tblclients;
set @query = if ((SELECT count(INDEX_NAME) FROM INFORMATION_SCHEMA.STATISTICS WHERE TABLE_SCHEMA = database() AND TABLE_NAME = 'tblclients' AND INDEX_NAME = 'client_status_id') = 0, 'CREATE INDEX `client_status_id` ON `tblclients` (`status`, `id`)', 'DO 0');
prepare statement from @query;
execute statement;
deallocate prepare statement;

-- Add index for product type in tblproducts;
set @query = if ((SELECT count(INDEX_NAME) FROM INFORMATION_SCHEMA.STATISTICS WHERE TABLE_SCHEMA = database() AND TABLE_NAME = 'tblproducts' AND INDEX_NAME = 'type') = 0, 'CREATE INDEX `type` ON `tblproducts` (`type`(4))', 'DO 0');
prepare statement from @query;
execute statement;
deallocate prepare statement;