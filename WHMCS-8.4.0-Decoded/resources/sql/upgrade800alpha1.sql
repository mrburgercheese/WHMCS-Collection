-- Modify the datatype of tbltax.taxrate
alter table `tbltax` modify `taxrate` DECIMAL(10,3) NOT NULL default '0.000';

-- Modify the datatype of tblinvoices.taxrate
alter table `tblinvoices` modify `taxrate` DECIMAL(10,3) NOT NULL default '0.000';

-- Modify the datatype of tblinvoices.taxrate2
alter table `tblinvoices` modify `taxrate2` DECIMAL(10,3) NOT NULL default '0.000';

-- Modify pricing columns to DECIMAL(16,2)
alter table `tblaccounts` modify `amountin` decimal(16,2) default 0.00 not null;

alter table `tblaccounts` modify `fees` decimal(16,2) default 0.00 not null;

alter table `tblaccounts` modify `amountout` decimal(16,2) default 0.00 not null;

alter table `tblaccounts` modify `rate` decimal(16,5) default 1.00000 not null;

alter table `tblaffiliates` modify `payamount` decimal(16,2) not null;

alter table `tblaffiliates` modify `balance` decimal(16,2) default 0.00 not null;

alter table `tblaffiliates` modify `withdrawn` decimal(16,2) default 0.00 not null;

alter table `tblaffiliateshistory` modify `amount` decimal(16,2) not null;

alter table `tblaffiliatespending` modify `amount` decimal(16,2) not null;

alter table `tblaffiliateswithdrawals` modify `amount` decimal(16,2) not null;

alter table `tblbillableitems` modify `amount` decimal(16,2) not null;

alter table `tblbundles` modify `displayprice` decimal(16,2) not null;

alter table `tblclients` modify `credit` decimal(16,2) not null;

alter table `tblcredit` modify `amount` decimal(16,2) not null;

alter table `tbldomainpricing` modify `grace_period_fee` decimal(16,2) default 0.00 not null;

alter table `tbldomainpricing` modify `redemption_grace_period_fee` decimal(16,2) default -1.00 not null;

alter table `tbldomainpricing_premium` modify `to_amount` decimal(16,2) default 0.00 not null;

alter table `tbldomains` modify `firstpaymentamount` decimal(16,2) default 0.00 not null;

alter table `tbldomains` modify `recurringamount` decimal(16,2) not null;

alter table `tblhosting` modify `firstpaymentamount` decimal(16,2) default 0.00 not null;

alter table `tblhosting` modify `amount` decimal(16,2) default 0.00 not null;

alter table `tblhostingaddons` modify `setupfee` decimal(16,2) default 0.00 not null;

alter table `tblhostingaddons` modify `recurring` decimal(16,2) default 0.00 not null;

alter table `tblinvoiceitems` modify `amount` decimal(16,2) default 0.00 not null;

alter table `tblinvoices` modify `subtotal` decimal(16,2) not null;

alter table `tblinvoices` modify `credit` decimal(16,2) not null;

alter table `tblinvoices` modify `tax` decimal(16,2) not null;

alter table `tblinvoices` modify `tax2` decimal(16,2) not null;

alter table `tblinvoices` modify `total` decimal(16,2) default 0.00 not null;

alter table `tblorders` modify `amount` decimal(16,2) not null;

alter table `tblpricing` modify `msetupfee` decimal(16,2) not null;

alter table `tblpricing` modify `qsetupfee` decimal(16,2) not null;

alter table `tblpricing` modify `ssetupfee` decimal(16,2) not null;

alter table `tblpricing` modify `asetupfee` decimal(16,2) not null;

alter table `tblpricing` modify `bsetupfee` decimal(16,2) not null;

alter table `tblpricing` modify `tsetupfee` decimal(16,2) not null;

alter table `tblpricing` modify `monthly` decimal(16,2) not null;

alter table `tblpricing` modify `quarterly` decimal(16,2) not null;

alter table `tblpricing` modify `semiannually` decimal(16,2) not null;

alter table `tblpricing` modify `annually` decimal(16,2) not null;

alter table `tblpricing` modify `biennially` decimal(16,2) not null;

alter table `tblpricing` modify `triennially` decimal(16,2) not null;

alter table `tblproducts` modify `affiliatepayamount` decimal(16,2) not null;

alter table `tblpromotions` modify `value` decimal(16,2) default 0.00 not null;

alter table `tblquoteitems` modify `unitprice` decimal(16,2) not null;

alter table `tblquoteitems` modify `discount` decimal(16,2) not null;

alter table `tblquotes` modify `subtotal` decimal(16,2) not null;

alter table `tblquotes` modify `tax1` decimal(16,2) not null;

alter table `tblquotes` modify `tax2` decimal(16,2) not null;

alter table `tblquotes` modify `total` decimal(16,2) not null;

alter table `tblservers` modify `monthlycost` decimal(16,2) default 0.00 not null;

alter table `tbltransaction_history` modify `amount` decimal(16,2) default 0.00 not null;

alter table `tblupgrades` modify `amount` decimal(16,2) not null;

alter table `tblupgrades` modify `credit_amount` decimal(16,2) not null;

alter table `tblupgrades` modify `new_recurring_amount` decimal(16,2) not null;

alter table `tblupgrades` modify `recurringchange` decimal(16,2) not null;

-- Multi-user auth changes
-- Add new field to tblactivitylog for user_id
set @query = if ((select count(*) from information_schema.columns where table_schema=database() and table_name='tblactivitylog' and column_name='user_id') = 0, 'ALTER TABLE `tblactivitylog` ADD `user_id` INT(10) UNSIGNED NOT NULL DEFAULT \'0\' AFTER `userid`', 'DO 0');
prepare statement from @query;
execute statement;
deallocate prepare statement;

-- Add new field to tblactivitylog for admin_id
set @query = if ((select count(*) from information_schema.columns where table_schema=database() and table_name='tblactivitylog' and column_name='admin_id') = 0, 'ALTER TABLE `tblactivitylog` ADD `admin_id` INT(10) UNSIGNED NOT NULL DEFAULT \'0\' AFTER `user_id`', 'DO 0');
prepare statement from @query;
execute statement;
deallocate prepare statement;

-- Add new index to tblactivitylog for user_id
set @query = if ((select count(*) from information_schema.statistics where table_schema=database() and table_name='tblactivitylog' and column_name='user_id') = 0, 'CREATE INDEX `user_id` ON tblactivitylog(user_id)', 'DO 0');
prepare statement from @query;
execute statement;
deallocate prepare statement;

-- Add new index to tblactivitylog for admin_id
set @query = if ((select count(*) from information_schema.statistics where table_schema=database() and table_name='tblactivitylog' and column_name='admin_id') = 0, 'CREATE INDEX `admin_id` ON tblactivitylog(admin_id)', 'DO 0');
prepare statement from @query;
execute statement;
deallocate prepare statement;

-- Add new field to tbltickets for requestor_id
set @query = if ((select count(*) from information_schema.columns where table_schema=database() and table_name='tbltickets' and column_name='requestor_id') = 0, 'ALTER TABLE `tbltickets` ADD `requestor_id` INT(10) UNSIGNED NOT NULL DEFAULT \'0\' AFTER `contactid`', 'DO 0');
prepare statement from @query;
execute statement;
deallocate prepare statement;

-- Add new field to tblticketreplies for requestor_id
set @query = if ((select count(*) from information_schema.columns where table_schema=database() and table_name='tblticketreplies' and column_name='requestor_id') = 0, 'ALTER TABLE `tblticketreplies` ADD `requestor_id` INT(10) UNSIGNED NOT NULL DEFAULT \'0\' AFTER `contactid`', 'DO 0');
prepare statement from @query;
execute statement;
deallocate prepare statement;

-- Add new field to tblauthn_account_links for user_id
set @query = if ((select count(*) from information_schema.columns where table_schema=database() and table_name='tblauthn_account_links' and column_name='user_id') = 0, 'ALTER TABLE `tblauthn_account_links` ADD `user_id` INT(11) DEFAULT NULL AFTER `remote_user_id`', 'DO 0');
prepare statement from @query;
execute statement;
deallocate prepare statement;

-- User related email template removals
DELETE FROM tblemailtemplates WHERE name='Automated Password Reset';
DELETE FROM tblemailtemplates WHERE name='Client Email Address Verification';
DELETE FROM tblemailtemplates WHERE name='Password Reset Confirmation';
DELETE FROM tblemailtemplates WHERE name='Password Reset Validation';

-- permission for View and Manage Users
INSERT INTO `tbladminperms` (`roleid`, `permid`) VALUES (1, 150), (1, 151);

-- Create index to speed up username based lookups CORE-14623
set @query = if ((select count(*) from information_schema.statistics where table_schema=database() and table_name='tblhosting' and column_name = 'username') = 0, 'create index `username` on `tblhosting` (`username`(8))', 'DO 0');
prepare statement from @query;
execute statement;
deallocate prepare statement;

-- Add slug field to products and groups
set @query = if ((select count(*) from information_schema.columns where table_schema=database() and table_name='tblproducts' and column_name='slug') = 0, 'ALTER TABLE `tblproducts` ADD `slug` VARCHAR(128) NOT NULL DEFAULT \'\'  AFTER `name`', 'DO 0');
prepare statement from @query;
execute statement;
deallocate prepare statement;

set @query = if ((select count(*) from information_schema.columns where table_schema=database() and table_name='tblproductgroups' and column_name='slug') = 0, 'ALTER TABLE `tblproductgroups` ADD `slug` VARCHAR(128) NOT NULL DEFAULT \'\' AFTER `name`', 'DO 0');
prepare statement from @query;
execute statement;
deallocate prepare statement;

-- Add new field to tblemails for attachments
set @query = if ((select count(*) from information_schema.columns where table_schema=database() and table_name='tblemails' and column_name='attachments') = 0, 'alter table `tblemails` add `attachments` TEXT COLLATE utf8_unicode_ci DEFAULT NULL AFTER `bcc`', 'DO 0');
prepare statement from @query;
execute statement;
deallocate prepare statement;

-- Add new field to tblemails for pending
set @query = if ((select count(*) from information_schema.columns where table_schema=database() and table_name='tblemails' and column_name='pending') = 0, 'alter table `tblemails` add `pending` tinyint(1) NOT NULL DEFAULT \'0\' AFTER `attachments`', 'DO 0');
prepare statement from @query;
execute statement;
deallocate prepare statement;

-- Add new field to tblemails for message_data
set @query = if ((select count(*) from information_schema.columns where table_schema=database() and table_name='tblemails' and column_name='message_data') = 0, 'alter table `tblemails` add `message_data` MEDIUMTEXT COLLATE utf8_unicode_ci DEFAULT NULL AFTER `pending`', 'DO 0');
prepare statement from @query;
execute statement;
deallocate prepare statement;

-- Add new field to tblemails for failed
set @query = if ((select count(*) from information_schema.columns where table_schema=database() and table_name='tblemails' and column_name='failed') = 0, 'alter table `tblemails` add `failed` tinyint(1) NOT NULL DEFAULT \'0\' AFTER `message_data`', 'DO 0');
prepare statement from @query;
execute statement;
deallocate prepare statement;

-- Add new field to tblemails for failure_reason
set @query = if ((select count(*) from information_schema.columns where table_schema=database() and table_name='tblemails' and column_name='failure_reason') = 0, 'alter table `tblemails` add `failure_reason` VARCHAR(250) COLLATE utf8_unicode_ci NOT NULL DEFAULT \'\' AFTER `failed`', 'DO 0');
prepare statement from @query;
execute statement;
deallocate prepare statement;

-- Add new field to tblemails for retry_count
set @query = if ((select count(*) from information_schema.columns where table_schema=database() and table_name='tblemails' and column_name='retry_count') = 0, 'alter table `tblemails` add `retry_count` tinyint(1) NOT NULL DEFAULT \'0\' AFTER `failure_reason`', 'DO 0');
prepare statement from @query;
execute statement;
deallocate prepare statement;

-- Add new field to tblemails for campaign_id
set @query = if ((select count(*) from information_schema.columns where table_schema=database() and table_name='tblemails' and column_name='campaign_id') = 0, 'alter table `tblemails` add `campaign_id` int(10) NOT NULL DEFAULT \'0\' AFTER `retry_count`', 'DO 0');
prepare statement from @query;
execute statement;
deallocate prepare statement;

-- Add new field to tblemails for created_at
set @query = if ((select count(*) from information_schema.columns where table_schema=database() and table_name='tblemails' and column_name='created_at') = 0, 'alter table `tblemails` add `created_at` timestamp NULL DEFAULT NULL AFTER `retry_count`', 'DO 0');
prepare statement from @query;
execute statement;
deallocate prepare statement;

-- Add new field to tblemails for updated_at
set @query = if ((select count(*) from information_schema.columns where table_schema=database() and table_name='tblemails' and column_name='updated_at') = 0, 'alter table `tblemails` add `updated_at` timestamp NULL DEFAULT NULL AFTER `created_at`', 'DO 0');
prepare statement from @query;
execute statement;
deallocate prepare statement;

-- Add new index to tblemails for pending
set @query = if ((select count(*) from information_schema.statistics where table_schema=database() and table_name='tblemails' and column_name='pending') = 0, 'CREATE INDEX `pending` ON tblemails(pending)', 'DO 0');
prepare statement from @query;
execute statement;
deallocate prepare statement;

-- Add new index to tblemails for campaign_id
set @query = if ((select count(*) from information_schema.statistics where table_schema=database() and table_name='tblemails' and column_name='campaign_id') = 0, 'CREATE INDEX `campaign_id` ON tblemails(campaign_id)', 'DO 0');
prepare statement from @query;
execute statement;
deallocate prepare statement;

CREATE TABLE IF NOT EXISTS `tblerrorlog` (
   `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
   `severity` varchar(16) NOT NULL,
   `exception_class` varchar(255),
   `message` varchar(255),
   `filename` varchar(255),
   `line` int(10) unsigned,
   `details` mediumtext,
   `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
   `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
   PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
