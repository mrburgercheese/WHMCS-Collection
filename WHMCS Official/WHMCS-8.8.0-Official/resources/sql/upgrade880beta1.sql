-- Add new configuration value for OnDemandRenewalsEnabled
set @query = if ((select count(*) from `tblconfiguration` where `setting` = 'OnDemandRenewalsEnabled') = 0, "INSERT INTO `tblconfiguration` (`setting`, `value`, `created_at`, `updated_at`) VALUES ('OnDemandRenewalsEnabled', 0, now(), now());",'DO 0;');
prepare statement from @query;
execute statement;
deallocate prepare statement;

-- Add new configuration value for OnDemandRenewalPeriodMonthly
set @query = if ((select count(*) from `tblconfiguration` where `setting` = 'OnDemandRenewalPeriodMonthly') = 0, "INSERT INTO `tblconfiguration` (`setting`, `value`, `created_at`, `updated_at`) VALUES ('OnDemandRenewalPeriodMonthly', 31, now(), now());",'DO 0;');
prepare statement from @query;
execute statement;
deallocate prepare statement;

-- Add new configuration value for OnDemandRenewalPeriodQuarterly
set @query = if ((select count(*) from `tblconfiguration` where `setting` = 'OnDemandRenewalPeriodQuarterly') = 0, "INSERT INTO `tblconfiguration` (`setting`, `value`, `created_at`, `updated_at`) VALUES ('OnDemandRenewalPeriodQuarterly', 92, now(), now());",'DO 0;');
prepare statement from @query;
execute statement;
deallocate prepare statement;

-- Add new configuration value for OnDemandRenewalPeriodSemiAnnually
set @query = if ((select count(*) from `tblconfiguration` where `setting` = 'OnDemandRenewalPeriodSemiAnnually') = 0, "INSERT INTO `tblconfiguration` (`setting`, `value`, `created_at`, `updated_at`) VALUES ('OnDemandRenewalPeriodSemiAnnually', 183, now(), now());",'DO 0;');
prepare statement from @query;
execute statement;
deallocate prepare statement;

-- Add new configuration value for OnDemandRenewalPeriodAnnually
set @query = if ((select count(*) from `tblconfiguration` where `setting` = 'OnDemandRenewalPeriodAnnually') = 0, "INSERT INTO `tblconfiguration` (`setting`, `value`, `created_at`, `updated_at`) VALUES ('OnDemandRenewalPeriodAnnually', 366, now(), now());",'DO 0;');
prepare statement from @query;
execute statement;
deallocate prepare statement;

-- Add new configuration value for OnDemandRenewalPeriodBiennially
set @query = if ((select count(*) from `tblconfiguration` where `setting` = 'OnDemandRenewalPeriodBiennially') = 0, "INSERT INTO `tblconfiguration` (`setting`, `value`, `created_at`, `updated_at`) VALUES ('OnDemandRenewalPeriodBiennially', 731, now(), now());",'DO 0;');
prepare statement from @query;
execute statement;
deallocate prepare statement;

-- Add new configuration value for OnDemandRenewalPeriodTriennially
set @query = if ((select count(*) from `tblconfiguration` where `setting` = 'OnDemandRenewalPeriodTriennially') = 0, "INSERT INTO `tblconfiguration` (`setting`, `value`, `created_at`, `updated_at`) VALUES ('OnDemandRenewalPeriodTriennially', 1096, now(), now());",'DO 0;');
prepare statement from @query;
execute statement;
deallocate prepare statement;

-- Add new composite index for (merged_ticket_id, status, userid) columns in tbltickets
set @query = if ((SELECT count(INDEX_NAME) FROM INFORMATION_SCHEMA.STATISTICS WHERE TABLE_SCHEMA = database() AND TABLE_NAME = 'tbltickets' AND INDEX_NAME = 'merged_status_userid') = 0, 'CREATE INDEX `merged_status_userid` ON `tbltickets` (`merged_ticket_id`, `status`, `userid`)', 'DO 0');
prepare statement from @query;
execute statement;
deallocate prepare statement;
