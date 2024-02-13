<?php

use WHMCS\Billing\Cycles;
use WHMCS\Database\Capsule;

if (!defined("WHMCS")) {
    die("This file cannot be accessed directly");
}

$months = array('January','February','March','April','May','June','July','August','September','October','November','December');
$cyclesMax = 36; // in months

$reportdata["title"] = "Income Forecast";
$reportdata["description"] = "This report shows the projected income for each month of the year if all active services are renewed within that month";

$reportdata["currencyselections"] = true;

$reportdata['tableheadings'] = [
    'Month',
    'Monthly',
    'Quarterly',
    'Semi-Annual',
    'Annual',
    'Biennial',
    'Triennial',
    'Total',
];

$totals = array();

$cycles = new Cycles;

$results = Capsule::table('tblhosting')
    ->where('tblhosting.domainstatus', '=', 'Active')
    ->where('tblclients.currency', '=', (int) $currencyid)
    ->whereIn('tblhosting.billingcycle', array_values($cycles->getRecurringCycles()))
    ->join('tblclients', 'tblclients.id', '=', 'tblhosting.userid')
    ->get()
    ->all();
foreach ($results as $result) {
    $recurringamount = $result->amount;
    $nextduedate = $result->nextduedate;
    $billingcycle = $result->billingcycle;
    $nextduedate = explode("-", $nextduedate);
    $year = $nextduedate[0];
    $month = $nextduedate[1];
    if ($cycles->isFree($billingcycle)) {
        continue;
    }
    try {
        $recurrence = $cycles->getNumberOfMonths($billingcycle);
    } catch (Exception $e) {
        $recurrence = $cyclesMax;
    }
    for ($i = 0; $i <= $cyclesMax; $i += $recurrence) {
        $new_time = mktime(0, 0, 0, ($month + $i), 1, $year);
        if ($new_time === false) {
            continue;
        }
        $totals[date("Y", $new_time)][date("m", $new_time)][$recurrence] += $recurringamount;
    }
}

$results = Capsule::table('tbldomains')
    ->where('tbldomains.status', '=', 'Active')
    ->where('tblclients.currency', '=', (int) $currencyid)
    ->join('tblclients', 'tblclients.id', '=', 'tbldomains.userid')
    ->get()
    ->all();
foreach ($results as $result) {
    $recurringamount = $result->recurringamount;
    $nextduedate = $result->nextduedate;
    $regperiod = $result->registrationperiod;
    $nextduedate = explode("-", $nextduedate);
    $year = $nextduedate[0];
    $month = $nextduedate[1];
    if (!$regperiod) {
        $regperiod = 1;
    }
    $recurrence = ($regperiod * 12);
    for ($i = 0; $i <= $cyclesMax; $i += $recurrence) {
        $new_time = mktime(0, 0, 0, ($month + $i), 1, $year);
        if ($new_time === false) {
            continue;
        }
        $totals[date("Y", $new_time)][date("m", $new_time)][$recurrence] += $recurringamount;
    }
}

for ($i = 0; $i <= $cyclesMax; $i++) {
    $new_time = mktime(0,0,0,date("m")+$i,1,date("Y"));
    if ($new_time === false) {
        continue;
    }
    $months_array[date("Y",$new_time)][date("m",$new_time)] = "x";
}

$overallincome = 0;

foreach ($months_array AS $year=>$month) {
    foreach ($month AS $mon=>$x) {
        $monthlyincome = $totals[$year][$mon][1]
            + $totals[$year][$mon][3]
            + $totals[$year][$mon][6]
            + $totals[$year][$mon][12]
            + $totals[$year][$mon][24]
            + $totals[$year][$mon][$cyclesMax];
        $overallincome += $monthlyincome;
        $chartdata['rows'][] = array('c'=>array(array('v'=>$months[$mon-1]." ".$year),array('v'=>$overallincome,'f'=>formatCurrency($overallincome))));
        $reportdata["tablevalues"][] = array(
            $months[$mon-1]." ".$year,
            formatCurrency($totals[$year][$mon][1]),
            formatCurrency($totals[$year][$mon][3]),
            formatCurrency($totals[$year][$mon][6]),
            formatCurrency($totals[$year][$mon][12]),
            formatCurrency($totals[$year][$mon][24]),
            formatCurrency($totals[$year][$mon][$cyclesMax]),
            formatCurrency($monthlyincome));

    }
}

$reportdata["footertext"] = "<p align=\"center\"><b>Total Projected Income: ".formatCurrency($overallincome)."</b></p>";

$chartdata['cols'][] = array('label'=>'Month','type'=>'string');
$chartdata['cols'][] = array('label'=>'Cumulative Income Forecast Total','type'=>'number');

#$args['colors'] = '#80D044,#F9D88C,#CC0000';

$reportdata["headertext"] = $chart->drawChart('Area',$chartdata,$args,'450px');
