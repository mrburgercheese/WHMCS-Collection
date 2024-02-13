-- Add new fields to tbljobs_queue table
set @query = if ((select count(*) from information_schema.columns where table_schema=database() and table_name='tbljobs_queue' and column_name='async') = 0, 'ALTER TABLE `tbljobs_queue` ADD `async` tinyint(1) unsigned NOT NULL DEFAULT 0 AFTER `digest_hash`', 'DO 0');
prepare statement from @query;
execute statement;
deallocate prepare statement;

set @query = if ((select count(*) from information_schema.columns where table_schema=database() and table_name='tbljobs_queue' and column_name='started_at') = 0, 'ALTER TABLE `tbljobs_queue` ADD `started_at` datetime DEFAULT NULL AFTER `available_at`', 'DO 0');
prepare statement from @query;
execute statement;
deallocate prepare statement;

-- realign upgrades with fresh install schema for tblactivitylog
ALTER TABLE tblactivitylog MODIFY `userid` int unsigned NOT NULL DEFAULT '0';

-- realign upgrades with fresh install schema for tblorders
set @query = if ((select count(*) from information_schema.statistics where table_schema=database() and table_name='tblorders' and index_name='requestor_id') = 0, 'ALTER TABLE tblorders ADD KEY `requestor_id` (`requestor_id`)', 'DO 0');
prepare statement from @query;
execute statement;
deallocate prepare statement;

-- realign upgrades with fresh install schema for tblusers
ALTER TABLE tblusers MODIFY `reset_token` varchar(255) NOT NULL DEFAULT '';
