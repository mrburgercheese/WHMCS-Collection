<link href="modules/servers/plesk/css/client.css" rel="stylesheet">
<script src="modules/servers/plesk/js/client.js"></script>

<div class="row">
    <div class="col-md-6">

        <div class="panel panel-default card mb-3">
            <div class="panel-heading card-header">
                <h3 class="panel-title card-title m-0">{lang key='packageDomain'}</h3>
            </div>
            <div class="panel-body card-body text-center">

                <div class="plesk-package-details">
                    <em>{$groupname|escape}</em>
                    <h4 style="margin:0;">{$product|escape}</h4>
                    <a href="http://{$domain}" target="_blank">www.{$domain}</a>
                </div>

                <p>
                    <a href="http://{$domain}" class="btn btn-default btn-sm" target="_blank">{lang key='visitwebsite'}</a>
                    <a href="{$ssoLoginUrl}" class="btn btn-success btn-sm" target="_blank">{lang key='plesk.manageDomains'}</a>
                </p>

            </div>
        </div>

        {if $availableAddonProducts}
            <div class="panel panel-default card mb-3">
                <div class="panel-heading card-header">
                    <h3 class="panel-title card-title m-0">{lang key='addonsExtras'}</h3>
                </div>
                <div class="panel-body card-body text-center mx-auto">

                    <form method="post" action="{$WEB_ROOT}/cart.php?a=add" class="form-inline">
                        <input type="hidden" name="serviceid" value="{$serviceid}" />
                        <select name="aid" class="form-control custom-select w-100 input-sm form-control-sm mr-2">
                        {foreach $availableAddonProducts as $addonId => $addonName}
                            <option value="{$addonId}">{$addonName|escape}</option>
                        {/foreach}
                        </select>
                        <button type="submit" class="btn btn-default btn-sm btn-block mt-1">
                            <i class="fas fa-shopping-cart"></i>
                            {lang key='purchaseActivate'}
                        </button>
                    </form>

                </div>
            </div>
        {/if}

    </div>
    <div class="col-md-6">

        <div class="panel card panel-default mb-3">
            <div class="panel-heading card-header">
                <h3 class="panel-title card-title m-0">{lang key='usageStats'}</h3>
            </div>
            <div class="panel-body card-body text-center plesk-usage-stats">

                <div class="row">
                    <div class="col-md-6" id="diskUsage">
                        <strong>{lang key='diskUsage'}</strong>
                        <br/><br/>
                        <input type="text" value="{$diskpercent|substr:0:-1}" class="usage-dial" data-fgColor="#444"
                               data-angleOffset="-125" data-angleArc="250" data-min="0"
                               data-max="{$diskPercentMax}"
                               data-readOnly="true" data-width="100" data-height="80"/>
                        <br/><br/>
                        {$diskusage} M / {$disklimit} M
                    </div>
                    <div class="col-md-6" id="bandwidthUsage">
                        <strong>{lang key='bandwidthUsage'}</strong>
                        <br/><br/>
                        <input type="text" value="{$bwpercent|substr:0:-1}" class="usage-dial" data-fgColor="#d9534f"
                               data-angleOffset="-125" data-angleArc="250" data-min="0"
                               data-max="{$bwPercentMax}"
                               data-readOnly="true" data-width="100" data-height="80"/>
                        <br/><br/>
                        {$bwusage} M / {$bwlimit} M
                    </div>
                </div>
                {if $bwpercent|substr:0:-1 > 75}
                    <div class="text-danger limit-near">
                        {if $bwpercent|substr:0:-1 > 100}
                            {lang key='usageStatsBwOverLimit'}
                        {else}
                            {lang key='usageStatsBwLimitNear'}
                        {/if}
                        {if $packagesupgrade}
                            <a href="upgrade.php?type=package&id={$serviceid}" class="btn btn-sm btn-danger">
                                <i class="fas fa-arrow-circle-up"></i>
                                {lang key='usageUpgradeNow'}
                            </a>
                        {/if}
                    </div>
                {elseif $diskpercent|substr:0:-1 > 75}
                    <div class="text-danger limit-near">
                        {if $diskpercent|substr:0:-1 > 100}
                            {lang key='usageStatsDiskOverLimit'}
                        {else}
                            {lang key='usageStatsDiskLimitNear'}
                        {/if}
                        {if $packagesupgrade}
                            <a href="upgrade.php?type=package&id={$serviceid}" class="btn btn-sm btn-danger">
                                <i class="fas fa-arrow-circle-up"></i>
                                {lang key='usageUpgradeNow'}
                            </a>
                        {/if}
                    </div>
                {else}
                    <div class="text-info limit-near">
                        {lang key='usageLastUpdated'} {$lastupdate}
                    </div>
                {/if}

                <script src="{$BASE_PATH_JS}/jquery.knob.js"></script>
                <script type="text/javascript">
                  jQuery(function () {
                    jQuery(".usage-dial").knob({
                      'format': function (value) {
                        return value + '%';
                      }
                    });
                  });
                </script>

            </div>
        </div>

    </div>
</div>

{if count($wpInstances) || $allowWpClientInstall}
    <div class="panel card panel-default mb-3" id="pleskWordPress" data-service-id="{$serviceId}" data-wp-domain="{$wpDomain}">
        <div class="panel-heading card-header">
            <h3 class="panel-title card-title m-0">WordPress®</h3>
        </div>
        <div class="panel-body card-body">
            <div class="row{if !$allowWpClientInstall} no-margin{/if}" id="wordpressInstanceRow" {if !count($wpInstances)}style="display: none" {/if}>
                <div class="col-md-4">
                    <select class="form-control" id="wordPressInstances">
                        {foreach $wpInstances as $wpInstance}
                            <option value="{$wpInstance.instanceUrl}">
                                {$wpInstance.blogTitle}
                                {if $wpInstance.path} ({$wpInstance.path}){/if}
                            </option>
                        {/foreach}
                    </select>
                </div>
                <div class="col-md-4">
                    <button class="btn btn-default btn-block" id="btnGoToWordPressHome">
                        <i class="fab fa-wordpress"></i>
                        {lang key='wptk.goToWebsite'}
                    </button>
                </div>
                <div class="col-md-4">
                    <button class="btn btn-default btn-block" id="btnGoToWordPressAdmin">
                        <i class="fas fa-users-cog"></i>
                        {lang key='wptk.goToAdmin'}
                    </button>
                </div>
            </div>
            <div class="row" {if !$allowWpClientInstall}style="display: none"{/if}>
                <div class="col-md-12">
                    <h5>{lang key='wptk.createNew'}</h5>
                    <p class="small" id="newWordPressFullUrlPreview">https://{$wpDomain}/</p>
                </div>
                <div class="col-md-12" id="wordPressInstallResultRow" style="display: none">
                    <div class="alert alert-success" style="display: none">
                        {lang key='wptk.installationSuccess'}
                    </div>
                    <div class="alert alert-danger" style="display: none">
                    </div>
                </div>
                <div class="col-md-3">
                    <input type="text" class="form-control" id="wpNewBlogTitle" placeholder="New Blog Title" />
                </div>
                <div class="col-md-3">
                    <input type="text" class="form-control" id="wpNewPath" placeholder="Path (optional)" />
                </div>
                <div class="col-md-3">
                    <input type="password" class="form-control" id="wpAdminPass" placeholder="Admin Password" />
                </div>
                <div class="col-md-3">
                    <button class="btn btn-default btn-block" id="btnInstallWordpress">
                        <i class="far fa-fw fa-plus"></i>
                        {lang key='wptk.installWordPressShort'}
                    </button>
                </div>
            </div>
        </div>
    </div>
{/if}

<div class="panel card panel-default mb-3">
    <div class="panel-heading card-header">
        <h3 class="panel-title card-title m-0">{lang key='quickShortcuts'}</h3>
    </div>
    <div class="panel-body card-body text-center">
        <div class="row plesk-feature-row">
            <div class="col-sm-4 col-xs-6 col-6">
                <a href="clientarea.php?action=productdetails&id={$serviceid}&dosinglesignon=1&success_redirect_url=%2Fsmb%2Femail-address%2Flist"
                   target="_blank" class="d-block mb-3">
                    <img src="modules/servers/plesk/img/email_accounts.png"/>
                    {lang key='plesk.mail'}
                </a>
            </div>
            <div class="col-sm-4 col-xs-6 col-6">
                <a href="clientarea.php?action=productdetails&id={$serviceid}&dosinglesignon=1&success_redirect_url=%2Fsmb%2Fapp%2Finstalled"
                   target="_blank" class="d-block mb-3">
                    <img src="modules/servers/plesk/img/cron_jobs.png"/>
                    {lang key='plesk.applications'}
                </a>
            </div>
            <div class="col-sm-4 col-xs-6 col-6">
                <a href="clientarea.php?action=productdetails&id={$serviceid}&dosinglesignon=1&success_redirect_url=%2Fsmb%2Ffile-manager%2Flist"
                   target="_blank" class="d-block mb-3">
                    <img src="modules/servers/plesk/img/file_manager.png"/>
                    {lang key='fileManager'}
                </a>
            </div>
            <div class="col-sm-4 col-xs-6 col-6">
                <a href="clientarea.php?action=productdetails&id={$serviceid}&dosinglesignon=1&success_redirect_url=%2Fsmb%2Fdatabase%2Flist"
                   target="_blank" class="d-block mb-3">
                    <img src="modules/servers/plesk/img/mysql_databases.png"/>
                    {lang key='mysqlDatabases'}
                </a>
            </div>
            <div class="col-sm-4 col-xs-6 col-6">
                <a href="clientarea.php?action=productdetails&id={$serviceid}&dosinglesignon=1&success_redirect_url=%2Fsmb%2Fstatistics%2Fdetails"
                   target="_blank" class="d-block mb-3">
                    <img src="modules/servers/plesk/img/awstats.png"/>
                    {lang key='plesk.statistics'}
                </a>
            </div>
            <div class="col-sm-4 col-xs-6 col-6">
                <a href="clientarea.php?action=productdetails&id={$serviceid}&dosinglesignon=1&success_redirect_url=%2Fsmb%2Fuser%2Flist"
                   target="_blank" class="d-block mb-3">
                    <img src="modules/servers/plesk/img/email_accounts.png"/>
                    {lang key='plesk.users'}
                </a>
            </div>
        </div>
    </div>
</div>

<div class="panel card panel-default mb-3">
    <div class="panel-heading card-header">
        <h3 class="panel-title card-title m-0">{lang key='billingOverview'}</h3>
    </div>
    <div class="panel-body card-body">

        <div class="row">
            <div class="col-md-5">
                {if $firstpaymentamount neq $recurringamount}
                    <div class="row" id="firstPaymentAmount">
                        <div class="col-xs-6 col-6 text-right" >
                            {lang key='firstpaymentamount'}
                        </div>
                        <div class="col-xs-6 col-6">
                            {$firstpaymentamount}
                        </div>
                    </div>
                {/if}
                {if $billingcycle != $LANG.orderpaymenttermonetime && $billingcycle != $LANG.orderfree}
                    <div class="row" id="recurringAmount">
                        <div class="col-xs-6 col-6 text-right">
                            {lang key='recurringamount'}
                        </div>
                        <div class="col-xs-6 col-6">
                            {$recurringamount}
                        </div>
                    </div>
                {/if}
                <div class="row" id="billingCycle">
                    <div class="col-xs-6 col-6 text-right">
                        {lang key='orderbillingcycle'}
                    </div>
                    <div class="col-xs-6 col-6">
                        {$billingcycle}
                    </div>
                </div>
                <div class="row" id="paymentMethod">
                    <div class="col-xs-6 col-6 text-right">
                        {lang key='orderpaymentmethod'}
                    </div>
                    <div class="col-xs-6 col-6">
                        {$paymentmethod}
                    </div>
                </div>
            </div>
            <div class="col-md-7">
                <div class="row" id="registrationDate">
                    <div class="col-xs-6 col-6 col-xl-5 text-right">
                        {lang key='clientareahostingregdate'}
                    </div>
                    <div class="col-xs-6 col-6 col-xl-7">
                        {$regdate}
                    </div>
                </div>
                <div class="row" id="nextDueDate">
                    <div class="col-xs-6 col-6 col-xl-5 text-right">
                        {lang key='clientareahostingnextduedate'}
                    </div>
                    <div class="col-xs-6 col-6 col-xl-7">
                        {$nextduedate}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
