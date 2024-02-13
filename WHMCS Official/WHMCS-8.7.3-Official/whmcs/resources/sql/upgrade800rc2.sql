-- Add new field to tblhosting for qty
set @query = if ((select count(*) from information_schema.columns where table_schema=database() and table_name='tblhosting' and column_name='qty') = 0, 'ALTER TABLE `tblhosting` ADD `qty` INT(10) UNSIGNED NOT NULL DEFAULT \'1\' AFTER `paymentmethod`', 'DO 0');
prepare statement from @query;
execute statement;
deallocate prepare statement;

-- Add new field to tblhostingaddons for qty
set @query = if ((select count(*) from information_schema.columns where table_schema=database() and table_name='tblhostingaddons' and column_name='qty') = 0, 'ALTER TABLE `tblhostingaddons` ADD `qty` INT(10) UNSIGNED NOT NULL DEFAULT \'1\' AFTER `name`', 'DO 0');
prepare statement from @query;
execute statement;
deallocate prepare statement;

-- Add new field to tbladdons for allowqty
set @query = if ((select count(*) from information_schema.columns where table_schema=database() and table_name='tbladdons' and column_name='allowqty') = 0, 'ALTER TABLE `tbladdons` ADD `allowqty` TINYINT(1) UNSIGNED NOT NULL DEFAULT \'0\' AFTER `billingcycle`', 'DO 0');
prepare statement from @query;
execute statement;
deallocate prepare statement;
