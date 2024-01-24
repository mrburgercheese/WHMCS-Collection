<?php

use WHMCS\Carbon;
use WHMCS\Database\Capsule;

if (!defined("WHMCS")) {
    die("This file cannot be accessed directly");
}

$reportdata["title"] = "Client Account Register Balance";
$reportdata["description"] = "This report provides a statement of account for individual client accounts.";

$userid = '';
if (App::isInRequest('userid') && App::getFromRequest('userid')) {
    $userid = App::getFromRequest('userid');
}
$range = App::getFromRequest('range');

$reportdata['headertext'] = '';
if (!$print) {
    $reportdata["headertext"] = <<<HTML
<form method="post" action="reports.php?report={$report}">
    <div class="report-filters-wrapper">
        <div class="inner-container">
            <h3>Filters</h3>
            <div class="row">
                <div class="col-md-3 col-sm-6">
                    <div class="form-group">
                        <label for="inputFilterClient">{$aInt->lang('fields', 'client')}</label>
                        {$aInt->clientsDropDown($userid)}
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="form-group">
                        <label for="inputFilterDate">{$dateRangeText}</label>
                        <div class="form-group date-picker-prepend-icon">
                            <label for="inputFilterDate" class="field-icon">
                                <i class="fal fa-calendar-alt"></i>
                            </label>
                            <input id="inputFilterDate"
                                   type="text"
                                   name="range"
                                   value="{$range}"
                                   class="form-control date-picker-search"
                                   placeholder="{$optionalText}"
                            />
                        </div>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">
                {$aInt->lang('global', 'apply')}
            </button>
        </div>
    </div>
</form>
HTML;
}

$currency = getCurrency($userid);
$statement = array();
$count = $balance = $totalcredits = $totaldebits = 0;

if ($userid) {
    $results = Capsule::table('tblinvoices')
        ->where('userid', '=', $userid)
        ->whereIn(
            'status',
            [
                'Unpaid',
                'Paid',
                'Collections',
            ]
        )
        ->orderBy('date', 'asc')
        ->get()
        ->all();
    foreach ($results as $result) {
        $invoiceid = $result->id;
        $date = $result->date;
        $total = ($result->credit + $result->total);

        $addfunds = Capsule::table('tblinvoiceitems')
            ->where('invoiceid', '=', $invoiceid)
            ->whereIn(
                'type',
                [
                    'AddFunds',
                    'Invoice',
                ]
            )
            ->value('id');
        if (!$addfunds) {
            $statement[str_replace('-', '', $date) . "_" . $count] = [
                'type' => 'Invoice',
                'date' => Carbon::safeCreateFromMySqlDate($date),
                'description' => "<a href=\"invoices.php?action=edit&id={$invoiceid}\" target=\"_blank\">#{$invoiceid}</a>",
                'credits' => 0,
                'debits' => $total,
            ];
        }

        $count++;
    }

    $results = Capsule::table('tblaccounts')
        ->where('userid', '=', $userid)
        ->orderBy('date', 'asc')
        ->get()
        ->all();
    foreach ($results as $result) {
        $transid = $result->id;
        $date = $result->date;
        $description = $result->description;
        $amountin = $result->amountin;
        $amountout = $result->amountout;
        $invoiceid = $result->invoiceid;
        $date = substr($date, 0, 10);

        $itemtype = Capsule::table('tblinvoiceitems')
            ->where('invoiceid', '=', $invoiceid)
            ->value('type');
        if ($itemtype == "AddFunds") {
            $description = "Credit Prefunding";
        } elseif ($itemtype == "Invoice") {
            $description = "Mass Invoice Payment - ";

            $relids = Capsule::table('tblinvoiceitems')
                ->where('invoiceid', '=', $invoiceid)
                ->orderBy('relid', 'asc')
                ->pluck('relid')
                ->all();
            foreach ($relids as $relid) {
                $description .= "<a href=\"invoices.php?action=edit&id={$relid}\" target=\"_blank\">#{$relid}</a>, ";
            }
            $description = substr($description, 0, -2);
        } else {
            if ($invoiceid) {
                $description .= " - <a href=\"invoices.php?action=edit&id=$invoiceid\" target=\"_blank\">"
                    . "#$invoiceid</a>";
            }
        }

        $statement[str_replace('-', '', $date) . "_" . $count] = [
            'type' => 'Transaction',
            'date' => Carbon::safeCreateFromMySqlDate($date),
            'description' => $description,
            'credits' => $amountin,
            'debits' => $amountout,
        ];
        $count++;
    }
}

$datefrom = $dateto = '';
if ($range) {
    $dateRange = Carbon::parseDateRangeValue($range);
    $datefrom = $dateRange['from'];
    $dateto = $dateRange['to'];
}

$reportdata['tableheadings'] = ['Type', 'Date', 'Description', 'Credits', 'Debits', 'Balance'];
ksort($statement);
$previousBalance = null;
foreach ($statement as $entry) {
    /** @var Carbon $carbonDate */
    $carbonDate = $entry['date'];
    // only update the total balance to include previous balance through to ending date of report
    if ($carbonDate->lte($dateto)) {
        $balance += ($entry['credits'] - $entry['debits']);
    }

    if (!empty($range) && $carbonDate->lt($datefrom)) {
        $previousBalance = $balance;
    }

    if (empty($range) || $carbonDate->betweenIncluded($datefrom, $dateto)) {
        $reportdata['tablevalues'][] = [
            $entry['type'],
            $carbonDate->toClientDateFormat(),
            $entry['description'],
            formatCurrency($entry['credits']),
            formatCurrency($entry['debits']),
            formatCurrency($balance),
        ];

        $totalcredits += $entry['credits'];
        $totaldebits -= $entry['debits'];
    }
}

if (!empty($previousBalance)) {
    $previousBalance = formatCurrency($previousBalance);
} else {
    $previousBalance = AdminLang::trans('global.na');
}

$previousBalanceLabel = AdminLang::trans('reports.clientStatement.previousBalance');
$reportdata['tablePreface'] = <<<PREFACE
    <p id="clientSummaryPreviousBalance" style="float:right">
        <strong>{$previousBalanceLabel}:</strong> {$previousBalance}
    </p>
PREFACE;


$reportdata["tablevalues"][] = array(
    '#efefef',
    '',
    '',
    '<b>Ending Balance</b>',
    '<b>'.formatCurrency($totalcredits).'</b>',
    '<b>'.formatCurrency($totaldebits).'</b>',
    '<b>'.formatCurrency($balance).'</b>'
);
