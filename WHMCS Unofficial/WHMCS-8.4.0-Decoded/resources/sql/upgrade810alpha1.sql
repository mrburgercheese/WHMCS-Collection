-- Add new field to tblticketdepartments for mail_auth_config
set @query = if ((select count(*) from information_schema.columns where table_schema=database() and table_name='tblticketdepartments' and column_name='mail_auth_config') = 0, 'ALTER TABLE `tblticketdepartments` ADD `mail_auth_config` TEXT AFTER `password`', 'DO 0');
prepare statement from @query;
execute statement;
deallocate prepare statement;
