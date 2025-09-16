-- Add new prevent_client_closure column to tbltickets
SET @query = IF ((SELECT COUNT(*) FROM information_schema.columns WHERE table_schema = database() AND TABLE_NAME = 'tbltickets' AND COLUMN_NAME = 'prevent_client_closure') = 0, 'ALTER TABLE `tbltickets` ADD `prevent_client_closure` TINYINT(1) NOT NULL DEFAULT \'0\' AFTER `requestor_id`', 'DO 0');
PREPARE statement FROM @query;
EXECUTE statement;
DEALLOCATE PREPARE statement;

-- Add new prevent_client_closure column to tblticketdepartments
SET @query = IF ((SELECT COUNT(*) FROM information_schema.columns WHERE table_schema = database() AND TABLE_NAME = 'tblticketdepartments' AND COLUMN_NAME = 'prevent_client_closure') = 0, 'ALTER TABLE `tblticketdepartments` ADD `prevent_client_closure` TINYINT(1) NOT NULL DEFAULT \'0\' AFTER `feedback_request`', 'DO 0');
PREPARE statement FROM @query;
EXECUTE statement;
DEALLOCATE PREPARE statement;