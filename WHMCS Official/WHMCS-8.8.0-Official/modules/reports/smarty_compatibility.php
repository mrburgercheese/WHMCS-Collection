<?php

use WHMCS\Carbon;
use WHMCS\Config\Setting;
use WHMCS\Utility\Environment\WebHelper;
use WHMCS\Utility\Smarty\TagScanner;

if (!defined('WHMCS')) {
    die('This file cannot be accessed directly.');
}

$rescanRequested = (App::getFromRequest('rescan') && !$print);
$tagUsageOutput = (new TagScanner())->findTagUsageAndRequeue(
    TagScanner::DEPRECATED_SMARTY_BC_TAGS,
    TagScanner::DEPRECATED_SMARTY_BC_TAGS_CACHE_KEY,
    $rescanRequested
);
$isAllowSmartyPhpTagsEnabled = (bool) Setting::getValue('AllowSmartyPhpTags');

$lastScanned = (new Carbon($tagUsageOutput['timestamp']))->toAdminDateTimeFormat();

$tagList = TagScanner::DEPRECATED_SMARTY_BC_TAGS;
$tagList = array_map(
    static function (string $tag) {
        $tag = trim(trim($tag), '{}');
        return "{{$tag}}";
    },
    $tagList
);
$lastTag = array_pop($tagList);
$tagList = implode(', ', $tagList);
$tagList = "{$tagList} and $lastTag";

$reportdata['title'] = 'Smarty Compatibility';
$reportdata['description'] = '';
if ($isAllowSmartyPhpTagsEnabled) {
    $settingsUrl = WebHelper::getAdminBaseUrl(). '/configgeneral.php?tab=10';
    $transParams= [
        ':anchorSettings' => "<a href=\"{$settingsUrl}\">",
        ':anchorDocs' => '<a href="https://go.whmcs.com/1733/legacy-smarty-tags">',
        ':anchorClose' => '</a>',
    ];
    $settingsString = AdminLang::trans('healthCheck.legacySmartyTags.body.settingOnly', $transParams);
    $reportdata['description'] .= <<<HTML
<h3>Smarty PHP Tags Setting</h3>
<p>{$settingsString}</p>
HTML;
}
$reportdata['description'] .= <<<HTML
<h3>Smarty Template Compatibility</h3>
<p>This report lists the Smarty {$tagList} tags that the system detected within your templates and provides an indication of whether the Allow Smarty PHP Tags setting is enabled on the installation.<br>
<small>Last Scanned: {$lastScanned}</small></p>
HTML;
if (!$print) {
    $reportdata['description'] .= <<<HTML
<p><form method="post" action="?report={$report}" id="smartyPhpTagReport">
    <input type="hidden" name="rescan" value="1">
    <button type="submit" class="btn btn-primary btn-rescan" id="btnRescan">
        Rescan Now
        <span class="hidden">
            <i class="fas fa-spinner fa-spin" aria-hidden="true"></i>
            <span class="sr-only">Performing rescan.</span>
        </span>
    </button>
</form></p>
HTML;
}
$reportdata['tableheadings'] = [
    'File Name/Email Template Name',
    'File Path/Email Template Type',
    'Line Numbers',
];

$tagUsageResultsCollection = collect($tagUsageOutput['results']);
$fileTagUsageCollection = $tagUsageResultsCollection->where('type', TagScanner::TYPE_FILE);
$emailTagUsageCollection = $tagUsageResultsCollection->where('type', TagScanner::TYPE_EMAIL);
$noRecordsArray = ['No Records Found', '', ''];

$reportdata['tablevalues'][] = ['**<strong>Template Files</strong>'];
foreach ($fileTagUsageCollection->sortBy('filePath')->all() as $fileTagUsageItem) {
    $reportdata['tablevalues'][] = [
        basename($fileTagUsageItem['filePath']),
        dirname($fileTagUsageItem['filePath']),
        implode(', ', $fileTagUsageItem['lineNumbers']),
    ];
}
if ($fileTagUsageCollection->count() === 0) {
    $reportdata['tablevalues'][] = $noRecordsArray;
}

$reportdata['tablevalues'][] = ['**<strong>Email Templates</strong>'];
foreach ($emailTagUsageCollection->sortBy('templateType')->all() as $emailTagUsageItem) {
    $templateName = $emailTagUsageItem['templateName'];
    if ($emailTagUsageItem['templateLanguage']) {
        $languageString = ucfirst($emailTagUsageItem['templateLanguage']);
        $templateName .= " ($languageString Version)";
    }

    if ($aInt->hasPermission('View Email Templates')) {
        $templateName = "<a href=\"configemailtemplates.php?action=edit&id={$emailTagUsageItem['templateId']}\" target='_blank'>{$templateName}</a>";
    }
    $reportdata['tablevalues'][] = [
        $templateName,
        AdminLang::trans("emailtpls.type.{$emailTagUsageItem['templateType']}"),
        implode(', ', $emailTagUsageItem['lineNumbers']),
    ];
}
if ($emailTagUsageCollection->count() === 0) {
    $reportdata['tablevalues'][] = $noRecordsArray;
}

$reportdata['footertext'] = <<<HTML
<script>
    jQuery('#smartyPhpTagReport').submit(function() {
        var submitButton = jQuery('.btn-rescan');

        submitButton.find('span').removeClass('hidden');
        submitButton.attr('disabled', 'disabled');
    });
</script>
HTML;
