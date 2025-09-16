<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="{$charset}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="referrer" content="same-origin">

    <title>WHMCS - {$pagetitle}</title>

    {\WHMCS\View\Asset::fontCssInclude('open-sans-family.css')}
    <link href="templates/{$template}/css/all.min.css?v={$versionHash}" rel="stylesheet" />
    <link href="templates/{$template}/css/theme.min.css?v={$versionHash}" rel="stylesheet" />
    <link href="{\WHMCS\Utility\Environment\WebHelper::getBaseUrl()}/assets/css/fontawesome-all.min.css" rel="stylesheet" />
    <script type="text/javascript" src="templates/{$template}/js/vendor.min.js?v={$versionHash}"></script>
    <script type="text/javascript" src="templates/{$template}/js/scripts.min.js?v={$versionHash}"></script>
    <script src="https://unpkg.com/@phosphor-icons/web@2.1.1/src/index.js"></script>
    <script>
        var datepickerformat = "{$datepickerformat}",
            csrfToken="{$csrfToken}",
            adminBaseRoutePath = "{\WHMCS\Admin\AdminServiceProvider::getAdminRouteBase()}",
            whmcsBaseUrl = "{\WHMCS\Utility\Environment\WebHelper::getBaseUrl()}";

        {if $jquerycode}
            $(document).ready(function(){ldelim}
                {$jquerycode}
            {rdelim});
        {/if}
        {if $jscode}
            {$jscode}
        {/if}
    </script>

    {$headoutput}

</head>
<body class="{if empty($sidebar)}no-sidebar{/if}{if !empty($globalAdminWarningMsg)} has-warning-banner{/if}" data-phone-cc-input="{if !empty($phoneNumberInputStyle)}{$phoneNumberInputStyle}{/if}">
<div id="overlay"></div>
    {$headeroutput}

    <div class="alert alert-warning global-admin-warning">
        {$globalAdminWarningMsg}
    </div>

    <div class="navigation">
        {include file="$template/nav.tpl"}
    </div>

    <div class="sidebar{if $minsidebar} minimized{/if}" id="sidebar">
        <a href="#" class="sidebar-collapse-expand" id="sidebarCollapseExpand">
            <i class="fa fa-chevron-down"></i>
        </a>
        <div class="sidebar-collapse">
            {include file="$template/sidebar.tpl"}
        </div>
    </div>
    <a href="#" class="sidebar-opener{if $minsidebar} minimized{/if}" id="sidebarOpener">
        {$_ADMINLANG.openSidebar}
    </a>

    <div class="{$contentAreaClasses}" id="contentarea">
        <div style="float:left;width:100%;">
            {if !$isCustomHeader}
                <h1{if $pagetitle == $_ADMINLANG.global.hometitle} class="pull-left"{/if}>{$pagetitle}</h1>
            {/if}
