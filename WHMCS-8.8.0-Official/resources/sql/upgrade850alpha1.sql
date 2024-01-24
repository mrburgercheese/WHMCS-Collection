-- Add new configuration value for ProductRecommendationEnable
set @query = if ((select count(*) from `tblconfiguration` where `setting` = 'ProductRecommendationEnable') = 0, "INSERT INTO `tblconfiguration` (`setting`, `value`, `created_at`, `updated_at`) VALUES ('ProductRecommendationEnable', 0, now(), now());",'DO 0;');
prepare statement from @query;
execute statement;
deallocate prepare statement;

-- Add new configuration value for ProductRecommendationLocationAfterAdd
set @query = if ((select count(*) from `tblconfiguration` where `setting` = 'ProductRecommendationLocationAfterAdd') = 0, "INSERT INTO `tblconfiguration` (`setting`, `value`, `created_at`, `updated_at`) VALUES ('ProductRecommendationLocationAfterAdd', 0, now(), now());",'DO 0;');
prepare statement from @query;
execute statement;
deallocate prepare statement;

-- Add new configuration value for ProductRecommendationLocationViewCart
set @query = if ((select count(*) from `tblconfiguration` where `setting` = 'ProductRecommendationLocationViewCart') = 0, "INSERT INTO `tblconfiguration` (`setting`, `value`, `created_at`, `updated_at`) VALUES ('ProductRecommendationLocationViewCart', 0, now(), now());",'DO 0;');
prepare statement from @query;
execute statement;
deallocate prepare statement;

-- Add new configuration value for ProductRecommendationLocationCheckout
set @query = if ((select count(*) from `tblconfiguration` where `setting` = 'ProductRecommendationLocationCheckout') = 0, "INSERT INTO `tblconfiguration` (`setting`, `value`, `created_at`, `updated_at`) VALUES ('ProductRecommendationLocationCheckout', 0, now(), now());",'DO 0;');
prepare statement from @query;
execute statement;
deallocate prepare statement;

-- Add new configuration value for ProductRecommendationLocationOrderComplete
set @query = if ((select count(*) from `tblconfiguration` where `setting` = 'ProductRecommendationLocationOrderComplete') = 0, "INSERT INTO `tblconfiguration` (`setting`, `value`, `created_at`, `updated_at`) VALUES ('ProductRecommendationLocationOrderComplete', 0, now(), now());",'DO 0;');
prepare statement from @query;
execute statement;
deallocate prepare statement;

-- Add new configuration value for ProductRecommendationCount
set @query = if ((select count(*) from `tblconfiguration` where `setting` = 'ProductRecommendationCount') = 0, "INSERT INTO `tblconfiguration` (`setting`, `value`, `created_at`, `updated_at`) VALUES ('ProductRecommendationCount', 10, now(), now());",'DO 0;');
prepare statement from @query;
execute statement;
deallocate prepare statement;

-- Add new configuration value for ProductRecommendationExisting
set @query = if ((select count(*) from `tblconfiguration` where `setting` = 'ProductRecommendationExisting') = 0, "INSERT INTO `tblconfiguration` (`setting`, `value`, `created_at`, `updated_at`) VALUES ('ProductRecommendationExisting', 0, now(), now());",'DO 0;');
prepare statement from @query;
execute statement;
deallocate prepare statement;

-- Add new configuration value for ProductRecommendationStyle
set @query = if ((select count(*) from `tblconfiguration` where `setting` = 'ProductRecommendationStyle') = 0, "INSERT INTO `tblconfiguration` (`setting`, `value`, `created_at`, `updated_at`) VALUES ('ProductRecommendationStyle', 0, now(), now());",'DO 0;');
prepare statement from @query;
execute statement;
deallocate prepare statement;

-- Add new columns to tblproducts table
set @query = if ((select count(*) from information_schema.columns where table_schema=database() and table_name='tblproducts' and column_name='short_description') = 0, 'ALTER TABLE `tblproducts` ADD `short_description` text COLLATE utf8_unicode_ci NOT NULL AFTER `is_featured`', 'DO 0');
prepare statement from @query;
execute statement;
deallocate prepare statement;

set @query = if ((select count(*) from information_schema.columns where table_schema=database() and table_name='tblproducts' and column_name='tagline') = 0, 'ALTER TABLE `tblproducts` ADD `tagline` text COLLATE utf8_unicode_ci NOT NULL AFTER `is_featured`', 'DO 0');
prepare statement from @query;
execute statement;
deallocate prepare statement;

set @query = if ((select count(*) from information_schema.columns where table_schema=database() and table_name='tblproducts' and column_name='color') = 0, 'ALTER TABLE `tblproducts` ADD `color` text COLLATE utf8_unicode_ci NOT NULL AFTER `is_featured`', 'DO 0');
prepare statement from @query;
execute statement;
deallocate prepare statement;

-- Add new enum values to tbldynamic_translations.related_type column
set @query = if ((select md5(substring(column_type,5)) from information_schema.columns where table_schema=database() and table_name='tbldynamic_translations' and column_name='related_type') != 'b91f10ba1f03adf3e7dfd3a10fcd0d7c', 'ALTER TABLE `tbldynamic_translations` MODIFY COLUMN `related_type` ENUM ("configurable_option.{id}.name","configurable_option_option.{id}.name","custom_field.{id}.description","custom_field.{id}.name","download.{id}.description","download.{id}.title","product.{id}.description","product.{id}.name","product.{id}.tagline","product.{id}.short_description","product_addon.{id}.description","product_addon.{id}.name","product_bundle.{id}.description","product_bundle.{id}.name","product_group.{id}.headline","product_group.{id}.name","product_group.{id}.tagline","product_group_feature.{id}.feature","ticket_department.{id}.description","ticket_department.{id}.name")', 'DO 0');
prepare statement from @query;
execute statement;
deallocate prepare statement;

-- Create new tblproduct_recommendations table
CREATE TABLE IF NOT EXISTS `tblproduct_recommendations` (
    `id` int(10) NOT NULL,
    `product_id` int(10) NOT NULL,
    `sortorder` int(10) NOT NULL DEFAULT '0',
    PRIMARY KEY `id_product_id` (`id`, `product_id`),
    INDEX `product_id` (`product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Rename and add new columns to tblapilog table START
set @query = if ((select count(*) from information_schema.columns where table_schema=database() and table_name='tblapilog' and column_name='endpoint') = 0,
    'ALTER TABLE `tblapilog` ADD `endpoint` varchar(255) NULL AFTER `action`','DO 0');
prepare statement from @query;
execute statement;
deallocate prepare statement;

set @query = if ((select count(*) from information_schema.columns where table_schema=database() and table_name='tblapilog' and column_name='method') = 0,
    'ALTER TABLE `tblapilog` ADD `method` enum (''GET'', ''POST'', ''PUT'', ''PATCH'', ''DELETE'') NULL AFTER `endpoint`', 'DO 0');
prepare statement from @query;
execute statement;
deallocate prepare statement;

set @query = if ((select count(*) from information_schema.columns where table_schema=database() and table_name='tblapilog' and column_name='status') = 1,
    'ALTER TABLE `tblapilog` CHANGE COLUMN `status` `response_status` int(11) NOT NULL DEFAULT ''0''', 'DO 0');
prepare statement from @query;
execute statement;
deallocate prepare statement;

set @query = if ((select count(*) from information_schema.columns where table_schema=database() and table_name='tblapilog' and column_name='headers') = 1,
    'ALTER TABLE `tblapilog` CHANGE COLUMN `headers` `response_headers` text COLLATE utf8_unicode_ci NOT NULL', 'DO 0');
prepare statement from @query;
execute statement;
deallocate prepare statement;

set @query = if ((select count(*) from information_schema.columns where table_schema=database() and table_name='tblapilog' and column_name='request_headers') = 0,
    'ALTER TABLE `tblapilog` ADD `request_headers` text NULL AFTER `request`', 'DO 0');
prepare statement from @query;
execute statement;
deallocate prepare statement;
-- Rename and add new columns to tblapilog table END

-- Add new fields to tblsslorders table
set @query = if ((select count(*) from information_schema.columns where table_schema=database() and table_name='tblsslorders' and column_name='certificate_expiry_date') = 0, 'ALTER TABLE `tblsslorders` ADD `certificate_expiry_date` timestamp NULL DEFAULT NULL', 'DO 0');
prepare statement from @query;
execute statement;
deallocate prepare statement;

set @query = if ((select count(*) from information_schema.columns where table_schema=database() and table_name='tblsslorders' and column_name='created_at') = 0, 'ALTER TABLE `tblsslorders` ADD `created_at` timestamp NULL DEFAULT NULL', 'DO 0');
prepare statement from @query;
execute statement;
deallocate prepare statement;

set @query = if ((select count(*) from information_schema.columns where table_schema=database() and table_name='tblsslorders' and column_name='updated_at') = 0, 'ALTER TABLE `tblsslorders` ADD `updated_at` timestamp NULL DEFAULT NULL', 'DO 0');
prepare statement from @query;
execute statement;
deallocate prepare statement;
