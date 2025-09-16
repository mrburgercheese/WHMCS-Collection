-- Add table tblticketactions
CREATE TABLE IF NOT EXISTS `tblticketactions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `ticket_id` int(10) NOT NULL,
  `action` varchar(256) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `status` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `parameters` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `scheduled` datetime NOT NULL,
  `created_by_admin_id` int(10) DEFAULT NULL,
  `updated_by_admin_id` int(10) DEFAULT NULL,
  `skip_flags` smallint(5) unsigned NOT NULL DEFAULT '0',
  `status_at` datetime NOT NULL,
  `processor_id` varchar(32) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `ticket_id_idx` (`ticket_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Lower the priority of Ticket Escalation Rules task
UPDATE tbltask SET priority = 1750 where name = 'Ticket Escalation Rules';

-- Add Ticket Scheduled Actions task
set @query = if ((select count(*) from `tbltask` where `name` = 'Ticket Scheduled Actions') = 0, "INSERT INTO `tbltask` VALUES (0,1720,'WHMCS\\\\Cron\\\\Task\\\\TicketScheduledActions',1,1,1,'Ticket Scheduled Actions','Process Ticket Scheduled Actions',now(),now());",'DO 0;');
PREPARE statement FROM @query;
EXECUTE statement;
DEALLOCATE PREPARE statement;

-- Add Ticket Scheduled Actions task tracker
set @task_id = (select id from `tbltask` where `name` = 'Ticket Scheduled Actions' LIMIT 1);
set @query = if ((select @task_id) and (select count(*) from `tbltask_status` where task_id = @task_id) = 0, "INSERT INTO `tbltask_status` VALUES (0, @task_id,0,'0000-00-00 00:00:00','0000-00-00 00:00:00',now(),now());",'DO 0;');
PREPARE statement FROM @query;
EXECUTE statement;
DEALLOCATE PREPARE statement;
