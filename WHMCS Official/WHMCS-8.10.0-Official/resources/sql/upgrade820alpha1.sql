-- Add new field to tbltickets for ipaddress
set @query = if ((select count(*) from information_schema.columns where table_schema=database() and table_name='tbltickets' and column_name='ipaddress') = 0, 'ALTER table `tbltickets` ADD `ipaddress` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL AFTER `c`', 'DO 0');
prepare statement from @query;
execute statement;
deallocate prepare statement;

-- Create index to improve user/client lookups
set @query = if ((SELECT count(*) FROM (SELECT GROUP_CONCAT(COLUMN_NAME ORDER BY SEQ_IN_INDEX) idx_cols FROM information_schema.statistics WHERE table_schema=database() AND TABLE_NAME='tblusers_clients' GROUP BY INDEX_NAME) i WHERE idx_cols = 'client_id,owner') = 0, 'ALTER TABLE `tblusers_clients` ADD INDEX `client_id_owner_idx` (`client_id`, `owner`);', 'DO 0');
prepare statement from @query;
execute statement;
deallocate prepare statement;

-- Add new field to tblbillableitems for unit tracking
set @query = if ((select count(*) from information_schema.columns where table_schema=database() and table_name='tblbillableitems' and column_name='unit') = 0, 'ALTER table `tblbillableitems` ADD `unit` tinyint(1) NOT NULL DEFAULT \'0\' AFTER `invoiceaction`', 'DO 0');
prepare statement from @query;
execute statement;
deallocate prepare statement;
-- Add new field to tblorders to track associated Requestor ID
set @query = if ((select count(*) from information_schema.columns where table_schema=database() and table_name='tblorders' and column_name='requestor_id') = 0, 'ALTER TABLE `tblorders` ADD `requestor_id` INT(10) UNSIGNED NOT NULL DEFAULT \'0\' AFTER `contactid`', 'DO 0');
prepare statement from @query;
execute statement;
deallocate prepare statement;

-- Add new field to tblorders to track associated Admin Requestor ID
set @query = if ((select count(*) from information_schema.columns where table_schema=database() and table_name='tblorders' and column_name='admin_requestor_id') = 0, 'ALTER TABLE `tblorders` ADD `admin_requestor_id` INT(10) UNSIGNED NOT NULL DEFAULT \'0\' AFTER `requestor_id`', 'DO 0');
prepare statement from @query;
execute statement;
deallocate prepare statement;

-- Add new field to tbladdons for prorate
set @query = if ((select count(*) from information_schema.columns where table_schema=database() and table_name='tbladdons' and column_name='prorate') = 0, 'ALTER TABLE `tbladdons` ADD `prorate` TINYINT(1) NOT NULL DEFAULT \'0\' AFTER `server_group_id`', 'DO 0');
prepare statement from @query;
execute statement;
deallocate prepare statement;

-- Add new field to tblhostingaddons for proratadate
set @query = if ((select count(*) from information_schema.columns where table_schema=database() and table_name='tblhostingaddons' and column_name='proratadate') = 0, 'ALTER TABLE `tblhostingaddons` ADD `proratadate` DATE NOT NULL DEFAULT \'0000-00-00\' AFTER `termination_date`', 'DO 0');
prepare statement from @query;
execute statement;
deallocate prepare statement;

-- Add new field to tblhostingaddons for firstpaymentamount
set @query = if ((select count(*) from information_schema.columns where table_schema=database() and table_name='tblhostingaddons' and column_name='firstpaymentamount') = 0, 'ALTER TABLE `tblhostingaddons` ADD `firstpaymentamount` DECIMAL(16,2) NOT NULL DEFAULT \'0.00\' AFTER `qty`', 'DO 0');
prepare statement from @query;
execute statement;
deallocate prepare statement;

-- Add new permission for View Gateway Balance Data
INSERT INTO `tbladminperms` (`roleid` ,`permid` ) VALUES ('1', '154');
