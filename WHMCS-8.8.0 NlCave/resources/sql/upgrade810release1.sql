-- Update tblmodulelog to have mediumtext columns
ALTER table `tblmodulelog`
modify `request` mediumtext not null,
modify `response` mediumtext not null,
modify `arrdata` mediumtext not null;