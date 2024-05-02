-- Add new field to tbladmins for user_preferences
set @query = if ((select count(*) from information_schema.columns where table_schema=database() and table_name='tbladmins' and column_name='user_preferences') = 0, 'ALTER table `tbladmins` ADD `user_preferences` mediumtext COLLATE utf8_unicode_ci DEFAULT NULL AFTER `widget_order`', 'DO 0');
prepare statement from @query;
execute statement;
deallocate prepare statement;
-- Add new permissions for Disputes
INSERT INTO `tbladminperms` (`roleid` ,`permid` ) VALUES ('1', '155'),('1', '156'),('1', '157');

-- Add new fields to affiliates tables
set @query = if ((select count(*) from information_schema.columns where table_schema=database() and table_name='tblaffiliatespending' and column_name='invoice_id') = 0, 'ALTER TABLE `tblaffiliatespending` ADD `invoice_id` int(10) unsigned NOT NULL DEFAULT 0 AFTER `affaccid`', 'DO 0');
prepare statement from @query;
execute statement;
deallocate prepare statement;

set @query = if ((select count(*) from information_schema.columns where table_schema=database() and table_name='tblaffiliatespending' and column_name='created_at') = 0, 'ALTER TABLE `tblaffiliatespending` ADD COLUMN `created_at` timestamp NOT NULL DEFAULT \'0000-00-00 00:00:00\'', 'DO 0');
prepare statement from @query;
execute statement;
deallocate prepare statement;

set @query = if ((select count(*) from information_schema.columns where table_schema=database() and table_name='tblaffiliatespending' and column_name='updated_at') = 0, 'ALTER TABLE `tblaffiliatespending` ADD COLUMN `updated_at` timestamp NOT NULL DEFAULT \'0000-00-00 00:00:00\'', 'DO 0');
prepare statement from @query;
execute statement;
deallocate prepare statement;

set @query = if ((select count(*) from information_schema.columns where table_schema=database() and table_name='tblaffiliateshistory' and column_name='invoice_id') = 0, 'ALTER TABLE `tblaffiliateshistory` ADD `invoice_id` int(10) unsigned NOT NULL DEFAULT 0 AFTER `affaccid`', 'DO 0');
prepare statement from @query;
execute statement;
deallocate prepare statement;

set @query = if ((select count(*) from information_schema.columns where table_schema=database() and table_name='tblaffiliateshistory' and column_name='created_at') = 0, 'ALTER TABLE `tblaffiliateshistory` ADD COLUMN `created_at` timestamp NOT NULL DEFAULT \'0000-00-00 00:00:00\'', 'DO 0');
prepare statement from @query;
execute statement;
deallocate prepare statement;

set @query = if ((select count(*) from information_schema.columns where table_schema=database() and table_name='tblaffiliateshistory' and column_name='updated_at') = 0, 'ALTER TABLE `tblaffiliateshistory` ADD COLUMN `updated_at` timestamp NOT NULL DEFAULT \'0000-00-00 00:00:00\'', 'DO 0');
prepare statement from @query;
execute statement;
deallocate prepare statement;

set @query = if ((select count(*) from information_schema.columns where table_schema=database() and table_name='tblaffiliatesaccounts' and column_name='created_at') = 0, 'ALTER TABLE `tblaffiliatesaccounts` ADD COLUMN `created_at` timestamp NOT NULL DEFAULT \'0000-00-00 00:00:00\'', 'DO 0');
prepare statement from @query;
execute statement;
deallocate prepare statement;

set @query = if ((select count(*) from information_schema.columns where table_schema=database() and table_name='tblaffiliatesaccounts' and column_name='updated_at') = 0, 'ALTER TABLE `tblaffiliatesaccounts` ADD COLUMN `updated_at` timestamp NOT NULL DEFAULT \'0000-00-00 00:00:00\'', 'DO 0');
prepare statement from @query;
execute statement;
deallocate prepare statement;

set @query = if ((select count(*) from information_schema.columns where table_schema=database() and table_name='tblaffiliateswithdrawals' and column_name='created_at') = 0, 'ALTER TABLE `tblaffiliateswithdrawals` ADD COLUMN `created_at` timestamp NOT NULL DEFAULT \'0000-00-00 00:00:00\'', 'DO 0');
prepare statement from @query;
execute statement;
deallocate prepare statement;

set @query = if ((select count(*) from information_schema.columns where table_schema=database() and table_name='tblaffiliateswithdrawals' and column_name='updated_at') = 0, 'ALTER TABLE `tblaffiliateswithdrawals` ADD COLUMN `updated_at` timestamp NOT NULL DEFAULT \'0000-00-00 00:00:00\'', 'DO 0');
prepare statement from @query;
execute statement;
deallocate prepare statement;

-- Add new field to capture SSL domain validation options
set @query = if ((select count(*) from information_schema.columns where table_schema=database() and table_name='tblsslorders' and column_name='authdata') = 0, 'ALTER table `tblsslorders` ADD `authdata` text COLLATE utf8_unicode_ci DEFAULT NULL AFTER `configdata`', 'DO 0');
prepare statement from @query;
execute statement;
deallocate prepare statement;
