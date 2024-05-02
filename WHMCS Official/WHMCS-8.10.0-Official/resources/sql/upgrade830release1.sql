-- Create indices to improve cart performance
set @query = if ((SELECT count(*) FROM (SELECT GROUP_CONCAT(COLUMN_NAME ORDER BY SEQ_IN_INDEX) idx_cols FROM information_schema.statistics WHERE table_schema=database() AND TABLE_NAME='tblpricing' GROUP BY INDEX_NAME) i WHERE idx_cols = 'relid') = 0, 'ALTER TABLE `tblpricing` ADD INDEX `pricing_relid_idx` (`relid`);', 'DO 0');
prepare statement from @query;
execute statement;
deallocate prepare statement;

set @query = if ((SELECT count(*) FROM (SELECT GROUP_CONCAT(COLUMN_NAME ORDER BY SEQ_IN_INDEX) idx_cols FROM information_schema.statistics WHERE table_schema=database() AND TABLE_NAME='tblpricing' GROUP BY INDEX_NAME) i WHERE idx_cols = 'currency') = 0, 'ALTER TABLE `tblpricing` ADD INDEX `pricing_currency_idx` (`currency`);', 'DO 0');
prepare statement from @query;
execute statement;
deallocate prepare statement;

set @query = if ((SELECT count(*) FROM (SELECT GROUP_CONCAT(COLUMN_NAME ORDER BY SEQ_IN_INDEX) idx_cols FROM information_schema.statistics WHERE table_schema=database() AND TABLE_NAME='tblpricing' GROUP BY INDEX_NAME) i WHERE idx_cols = 'type') = 0, 'ALTER TABLE `tblpricing` ADD INDEX `pricing_type_idx` (`type`);', 'DO 0');
prepare statement from @query;
execute statement;
deallocate prepare statement;