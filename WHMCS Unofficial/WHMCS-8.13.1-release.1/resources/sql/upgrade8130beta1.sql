-- Ensure old credit-applied entries that are lacking the invoice in the relid column are associated with the invoice from the description, so long as the parsed invoice belongs to the same client as the credit entry
UPDATE tblcredit SET relid = CAST(SUBSTRING_INDEX(description, '#', -1) AS UNSIGNED) WHERE relid = 0 AND admin_id = 0 AND TRIM(description) REGEXP 'Credit Applied.*Invoice #[0-9]+$' AND clientid IN (SELECT userid FROM tblinvoices WHERE id = CAST(SUBSTRING_INDEX(tblcredit.description, '#', -1) AS UNSIGNED));


-- Add new mixpanel_tracking_enabled column to tbladmins
SET @query = IF ((SELECT COUNT(*) FROM information_schema.columns WHERE table_schema = database() AND TABLE_NAME = 'tbladmins' AND COLUMN_NAME = 'mixpanel_tracking_enabled') = 0, 'ALTER TABLE `tbladmins` ADD `mixpanel_tracking_enabled` TINYINT(1) NOT NULL DEFAULT 0 AFTER `user_preferences`', 'DO 0;');
PREPARE statement FROM @query;
EXECUTE statement;
DEALLOCATE PREPARE statement;
