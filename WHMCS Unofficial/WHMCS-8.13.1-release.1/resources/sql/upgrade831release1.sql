-- Add new index (date) for date column in tblticketmaillog
set @query = if ((SELECT count(INDEX_NAME) FROM INFORMATION_SCHEMA.STATISTICS WHERE TABLE_SCHEMA = database() AND TABLE_NAME = 'tblticketmaillog' AND INDEX_NAME = 'date') = 0, 'ALTER TABLE `tblticketmaillog` ADD INDEX `date` (`date`)', 'DO 0');
prepare statement from @query;
execute statement;
deallocate prepare statement;

-- Remove orphaned affiliate data
DELETE FROM tblaffiliatespending WHERE `affaccid` IN (SELECT acc.id FROM tblaffiliatesaccounts acc LEFT JOIN tblaffiliates aff ON aff.id = acc.affiliateid WHERE aff.id IS NULL);
DELETE FROM tblaffiliates_hits WHERE `affiliate_id` NOT IN (SELECT id FROM tblaffiliates);
DELETE FROM tblaffiliates_referrers WHERE `affiliate_id` NOT IN (SELECT id FROM tblaffiliates);
DELETE FROM tblaffiliatesaccounts WHERE `affiliateid` NOT IN (SELECT id FROM tblaffiliates);
DELETE FROM tblaffiliateshistory WHERE `affiliateid` NOT IN (SELECT id FROM tblaffiliates);
DELETE FROM tblaffiliateswithdrawals WHERE `affiliateid` NOT IN (SELECT id FROM tblaffiliates);

-- Remove unnecessary tracking column from tblproducts_slugs
set @query = if ((select count(*) from information_schema.columns where TABLE_NAME='tblproducts_slugs' and COLUMN_NAME='tracking' and TABLE_SCHEMA=database()) > 0, 'ALTER TABLE `tblproducts_slugs` DROP COLUMN `tracking`', 'DO 0');
prepare statement from @query;
execute statement;
deallocate prepare statement;