-- Add new index (tblcreditcards_last_four) for last_four column in tblcreditcards
set @query = if ((SELECT count(INDEX_NAME) FROM INFORMATION_SCHEMA.STATISTICS WHERE TABLE_SCHEMA = database() AND TABLE_NAME = 'tblcreditcards' AND INDEX_NAME = 'tblcreditcards_last_four') = 0, 'CREATE INDEX `tblcreditcards_last_four` ON `tblcreditcards` (`last_four`(4))', 'DO 0');
prepare statement from @query;
execute statement;
deallocate prepare statement;
