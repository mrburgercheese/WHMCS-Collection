-- Modify invoice id column and relations to unsigned
ALTER TABLE `tblinvoices` MODIFY `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT;
ALTER TABLE `tblaccounts` MODIFY `invoiceid` INT(10) UNSIGNED NOT NULL DEFAULT '0';
ALTER TABLE `tblinvoiceitems` MODIFY `invoiceid` INT(10) UNSIGNED NOT NULL DEFAULT '0';
ALTER TABLE `tblorders` MODIFY `invoiceid` INT(10) UNSIGNED NOT NULL DEFAULT '0';
ALTER TABLE `mod_invoicedata` MODIFY `invoiceid` INT(10) UNSIGNED NOT NULL;

-- Add new index (lastlogin) for date column in tblclients
set @query = if ((SELECT count(INDEX_NAME) FROM INFORMATION_SCHEMA.STATISTICS WHERE TABLE_SCHEMA = database() AND TABLE_NAME = 'tblclients' AND INDEX_NAME = 'lastlogin') = 0, 'CREATE INDEX `lastlogin` ON `tblclients` (`lastlogin`)', 'DO 0');
prepare statement from @query;
execute statement;
deallocate prepare statement;

-- Add new index (lastvisit) for date column in tbladminlog
set @query = if ((SELECT count(INDEX_NAME) FROM INFORMATION_SCHEMA.STATISTICS WHERE TABLE_SCHEMA = database() AND TABLE_NAME = 'tbladminlog' AND INDEX_NAME = 'lastvisit') = 0, 'CREATE INDEX `lastvisit` ON `tbladminlog` (`lastvisit`)', 'DO 0');
prepare statement from @query;
execute statement;
deallocate prepare statement;

-- Add new configuration value for UndefinedProductAddonOnDemandRenewalOption default to global
set @query = if ((select count(*) from `tblconfiguration` where `setting` = 'UndefinedProductAddonOnDemandRenewalOption') = 0, "INSERT INTO `tblconfiguration` (`setting`, `value`, `created_at`, `updated_at`) VALUES ('UndefinedProductAddonOnDemandRenewalOption', 'global', now(), now());",'DO 0;');
prepare statement from @query;
execute statement;
deallocate prepare statement;
