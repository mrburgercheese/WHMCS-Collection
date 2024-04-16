<?php

use WHMCS\Application;
use WHMCS\Billing\Currency;
use WHMCS\Database\Capsule;

require("../init.php");

/*
*** USAGE SAMPLES ***

<script language="javascript" src="feeds/domainprice.php?tld=.com&type=register&regperiod=1"></script>

<script language="javascript" src="feeds/domainprice.php?tld=.com&type=register&regperiod=1&currency=1&format=1"></script>

*/
$whmcs = Application::getInstance();

$tld = $whmcs->get_req_var('tld');
$type = $whmcs->get_req_var('type');
$regperiod = $whmcs->get_req_var('regperiod');
$format = ($whmcs->get_req_var('format')) ? true : false;

if (!is_numeric($regperiod) || $regperiod < 1) {
    $regperiod = 1;
}

$did = Capsule::table('tbldomainpricing')
    ->where('extension', '=', $tld)
    ->value('id');

if (!empty($currency)) {
    $currency = getCurrency(null, $currency);
} else {
    $currency = Currency::factoryForClientArea();
}

$validDomainActionRequests = array('register','transfer','renew');

if (!in_array($type, $validDomainActionRequests)) {
    $type = 'register';
}

$data = Capsule::table('tblpricing')
    ->where('type', '=', 'domain' . $type)
    ->where('currency', '=', $currency['id'])
    ->where('relid', '=', $did)
    ->where('tsetupfee', '=', '0.00')
    ->first();

$pricingColumns = array(
    'msetupfee',
    'qsetupfee',
    'ssetupfee',
    'asetupfee',
    'bsetupfee',
    'monthly',
    'quarterly',
    'semiannually',
    'annually',
    'biennially',
);

$regperiod = $regperiod - 1;
$price = null;
if (
    isset($pricingColumns[$regperiod])
    && is_object($data)
    && property_exists($data, $pricingColumns[$regperiod])
) {
    $price = $data->{$pricingColumns[$regperiod]};
}

if ($format) {
    $price = formatCurrency($price);
}

echo "document.write('".$price."');";
