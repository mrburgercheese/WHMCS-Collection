<?php
// Prevent sample file execution. Remove from live configuration.
return;

// The full WHMCS license key.
$license = '';

// Database connection settings.
$db_host = '';
$db_port = '';
$db_username = '';
$db_password = '';
$db_name = '';

// Optional values to enable and configure encrypted database connections.
// See https://go.whmcs.com/1781/.
$db_tls_ca = '';
$db_tls_ca_path = '';
$db_tls_cert = '';
$db_tls_cipher = '';
$db_tls_key = '';
$db_tls_verify_cert = '';

// The MySQL client character set. Caution: Changing the charset from the default database
// schema can result in unwanted behavior and data loss.
$mysql_charset = 'utf8';

// A value used during symmetric encryption of data at rest. This value must be 64 characters
// long and contain only  a–z, A–Z, and 0–9 ASCII values. It is recommended to generate this
// value with a high-entropy random data source or a cryptographic password generation tool.
$cc_encryption_hash = '';

// The directory to cache compiled templates.
$templates_compiledir = 'templates_c';
