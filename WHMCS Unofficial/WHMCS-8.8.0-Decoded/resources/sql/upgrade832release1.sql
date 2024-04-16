-- Remove orphaned affiliate data
DELETE FROM tblaffiliatespending WHERE `affaccid` IN (SELECT acc.id FROM tblaffiliatesaccounts acc LEFT JOIN tblaffiliates aff ON aff.id = acc.affiliateid WHERE aff.id IS NULL);
DELETE FROM tblaffiliates_hits WHERE `affiliate_id` NOT IN (SELECT id FROM tblaffiliates);
DELETE FROM tblaffiliates_referrers WHERE `affiliate_id` NOT IN (SELECT id FROM tblaffiliates);
DELETE FROM tblaffiliatesaccounts WHERE `affiliateid` NOT IN (SELECT id FROM tblaffiliates);
DELETE FROM tblaffiliateshistory WHERE `affiliateid` NOT IN (SELECT id FROM tblaffiliates);
DELETE FROM tblaffiliateswithdrawals WHERE `affiliateid` NOT IN (SELECT id FROM tblaffiliates);