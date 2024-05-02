-- Add new index to tbllog_register for namespace_id
set @query = if ((select count(*) from information_schema.statistics where table_schema=database() and table_name='tbllog_register' and column_name='namespace_id') = 0, 'CREATE INDEX tbllog_register_namespace_id_index ON tbllog_register (namespace_id);', 'DO 0');
prepare statement from @query;
execute statement;
deallocate prepare statement;

-- Add new index to tbllog_register for namespace
set @query = if ((select count(*) from information_schema.statistics where table_schema=database() and table_name='tbllog_register' and column_name='namespace') = 0, 'CREATE INDEX tbllog_register_namespace_index ON tbllog_register (namespace(32));', 'DO 0');
prepare statement from @query;
execute statement;
deallocate prepare statement;

-- Add new index to tbllog_register for created_at
set @query = if ((select count(*) from information_schema.statistics where table_schema=database() and table_name='tbllog_register' and column_name='created_at') = 0, 'CREATE INDEX tbllog_register_created_at_index ON tbllog_register (created_at);', 'DO 0');
prepare statement from @query;
execute statement;
deallocate prepare statement;
