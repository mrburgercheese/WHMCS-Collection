-- Alter slug field to products and groups
ALTER TABLE `tblproducts` MODIFY `slug` VARCHAR(128) NOT NULL DEFAULT '';
ALTER TABLE `tblproductgroups` MODIFY COLUMN `slug` VARCHAR(128) NOT NULL DEFAULT '';
