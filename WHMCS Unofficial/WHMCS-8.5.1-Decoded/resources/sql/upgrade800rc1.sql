-- permission for List Users
INSERT INTO `tbladminperms` (`roleid`, `permid`) VALUES (1, 152);

UPDATE `tblusers` SET `last_login`=NULL WHERE `last_login`='0000-00-00 00:00:00';
UPDATE `tblusers_clients` SET `last_login`=NULL WHERE `last_login`='0000-00-00 00:00:00';

UPDATE `tblemails` SET `attachments`='[]' WHERE `attachments` IS NULL;
