-- Modify hours columns to DECIMAL(5,2)
alter table `tblbillableitems` modify `hours` decimal(5,2) not null;

-- Add new index for relid column in tblcustomfieldsvalues
set @query = if ((SELECT count(INDEX_NAME) FROM INFORMATION_SCHEMA.STATISTICS WHERE TABLE_SCHEMA = database() AND TABLE_NAME = 'tblcustomfieldsvalues' AND INDEX_NAME = 'relid') = 0, 'CREATE INDEX `relid` ON `tblcustomfieldsvalues` (`relid`)', 'DO 0');
prepare statement from @query;
execute statement;
deallocate prepare statement;
