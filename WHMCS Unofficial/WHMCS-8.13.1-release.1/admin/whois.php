<?php

use WHMCS\Admin;
use WHMCS\Domain\Checker;
use WHMCS\Domains;
use WHMCS\Domains\Domain;
use WHMCS\View\Helper;
use WHMCS\WHOIS;

define("ADMINAREA",true);

require("../init.php");

$aInt = new Admin("WHOIS Lookups");

$aInt->title = $aInt->lang('whois','title');
$aInt->sidebar = "utilities";
$aInt->icon = "domains";
$aInt->requiredFiles(array("domainfunctions"));

$action = App::getFromRequest('action');

if ($action=="checkavailability") {
    check_token('WHMCS.admin.default');
    $whois = new WHOIS();
    $result = $whois->lookup(array('sld' => $sld, 'tld' => $tld));
    $whois->logLookup();
    echo $result['result'];
    exit;
}

$code = '';

if ($domain = $whmcs->get_req_var('domain')) {
    check_token('WHMCS.admin.default');

    $domains = new Domains();

    /**
     * A space in a domain name is always invalid. Strip whitespace to
     * be sure the following method does not throw if a space is present.
     *
     * @see https://jira.whmcs.com/browse/CORE-16013
     */
    $domain = str_replace(' ', '', $domain);

    $domainparts = $domains->splitAndCleanDomainInput($domain);
    $isValid = $domains->checkDomainisValid($domainparts);

    if ($isValid) {

        $whois = new WHOIS();
        if ($whois->canLookup($domainparts['tld'])) {

            $result = $whois->lookup($domainparts);
            $whois->logLookup();

            if ($result['result'] == "available") {
                $code .= '<div class="alert alert-success text-center" role="alert" style="font-size:18px;">'
                    . sprintf($aInt->lang('whois', 'available'), $domain)
                    . '</div>';
            } elseif ($result['result'] == "unavailable") {
                $code .= '<div class="alert alert-danger text-center" role="alert" style="font-size:18px;">'
                    . sprintf($aInt->lang('whois', 'unavailable'), $domain)
                    . '</div>';
            } else {
                $code .= '<div class="alert alert-danger text-center" role="alert" style="font-size:18px;">'
                    . $aInt->lang('whois', 'error')
                    . '</div>'
                    . '<p align="text-center">' . $result['errordetail'] . '</p>';
            }

        } else {

            $code .= '<div class="alert alert-danger text-center" role="alert" style="font-size:18px;">'
                . sprintf($aInt->lang('whois', 'invalidtld'), $domainparts['tld'])
                . '</div>';

        }

    } else {

        $code .= '<div class="alert alert-danger text-center" role="alert" style="font-size:18px;">'
            . $aInt->lang('whois', 'invaliddomain')
            . '</div>';

    }

}

$code = '<form method="post" action="'.$_SERVER['PHP_SELF'].'">
    <div class="row clearfix">
        <div class="col-md-8 col-md-offset-2 col-sm-10 col-sm-offset-1">
            <div class="input-group input-group-lg">
                <input type="text" name="domain" value="' . $domain . '" class="form-control" placeholder="domaintolookup.com" />
                <div class="input-group-btn">
                    <input type="submit" value="Lookup Domain" class="btn btn-primary" />
                </div>
            </div>
        </div>
    </div>
</form><br>' . $code;

$code .= '<div class="row">';
$isUnavailable = false;

if ($domain && $isValid && $result['result'] == 'unavailable') {
    $isUnavailable = true;
    $code .= '<div class="col-md-6 col-sm-12"><h2>' . $aInt->lang('whois', 'whois') . '</h2>
<div class="well well-lg">
    ' . $result['whois'] . '
</div></div>';
}

$checker = new Checker();

if (!empty($domain)) {
    $suggestions = $checker->getLookupProvider()->getSuggestions((new Domain($domain)));

    if ($suggestions->count()) {
        $outputCount = 0;
        $class = 'col-md-12';
        $columns = 4;
        $suggestionLimit = 52;
        if ($isUnavailable) {
            $class = 'col-md-6 col-sm-12';
            $columns = 2;
            $suggestionLimit = 30;
        }
        $code .= '<div class="' . $class . '"><h2>' . AdminLang::trans('whois.suggestions') . '</h2>'
            . '<table class="table"><tr>';
        /** @var Domains\DomainLookup\SearchResult $suggestion */
        $count = 1;
        foreach ($suggestions as $suggestion) {
            if ($outputCount >= $suggestionLimit) {
                break;
            }
            if ($count > $columns) {
                $count = 1;
                $code .= '</tr><tr>';
            }
            $label = $suggestion->getDomain();
            if ($suggestion->group()) {
                $label .= ' ' . Helper::getDomainGroupLabel($suggestion->group());
            }
            $code .= '<td>' . $label . '</td>';
            $count++;
            $outputCount++;
        }
        $code .= '</tr></table></div>';
    }
}
$code .= '</div>';

$aInt->content = $code;
$aInt->display();
