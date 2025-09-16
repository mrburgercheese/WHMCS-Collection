<link href="modules/servers/wpsquared/css/client.css" rel="stylesheet">

<div class="row">
    <div class="col-md-6">

        <div class="panel panel-default card mb-3" id="wpSquaredPackagePanel">
            <div class="panel-heading card-header">
                <h3 class="panel-title card-title m-0">{lang key='packageDomain'}</h3>
            </div>
            <div class="panel-body card-body text-center">

                <div class="wpsquared-package-details">
                    <em>{$groupname|escape}</em>
                    <h4 style="margin:0;">{$product|escape}</h4>
                    <a href="http://{$domain}" target="_blank">www.{$domain}</a>
                </div>

                <p>
                    <a href="http://{$domain}" class="btn btn-default btn-sm" target="_blank">{$LANG.visitwebsite}</a>
                    {if $domainId}
                        <a href="clientarea.php?action=domaindetails&id={$domainId}" class="btn btn-success btn-sm" target="_blank">{$LANG.managedomain}</a>
                    {/if}
                </p>

            </div>
        </div>

        {if $availableAddonProducts}
            <div class="panel panel-default card mb-3" id="wpSquaredExtrasPurchasePanel">
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

        <div class="panel card panel-default mb-3" id="wpSquaredUsagePanel">
            <div class="panel-heading card-header">
                <h3 class="panel-title card-title m-0">{lang key='usageStats'}</h3>
            </div>
            <div class="panel-body card-body text-center wpsquared-usage-stats">

                <div class="row">
                    <div class="col-md-6" id="diskUsage">
                        <strong>{lang key='diskUsage'}</strong>
                        <br /><br />
                        <input type="text" value="{$diskpercent|substr:0:-1}" class="usage-dial" data-fgColor="#444" data-angleOffset="-125" data-angleArc="250" data-min="0" data-max="{if substr($diskpercent, 0, -1) > 100}{$diskpercent|substr:0:-1}{else}100{/if}" data-readOnly="true" data-width="100" data-height="80" />
                        <br /><br />
                        {$diskusage} M / {$disklimit} M
                    </div>
                    <div class="col-md-6" id="bandwidthUsage">
                        <strong>{lang key='bandwidthUsage'}</strong>
                        <br /><br />
                        <input type="text" value="{$bwpercent|substr:0:-1}" class="usage-dial" data-fgColor="#d9534f" data-angleOffset="-125" data-angleArc="250" data-min="0" data-max="{if substr($bwpercent, 0, -1) > 100}{$bwpercent|substr:0:-1}{else}100{/if}" data-readOnly="true" data-width="100" data-height="80" />
                        <br /><br />
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
                jQuery(function() {
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

{foreach $hookOutput as $output}
    <div>
        {$output}
    </div>
{/foreach}

{if $systemStatus != 'Active'}
    <div class="alert alert-warning text-center" role="alert" id="wpSquaredSuspendReasonPanel">
        {if $suspendreason}
            <strong>{$suspendreason|escape}</strong><br />
        {/if}
        {$LANG.cPanel.packageNotActive} {$status}.<br />
        {if $systemStatus eq "Pending"}
            {$LANG.cPanel.statusPendingNotice}
        {elseif $systemStatus eq "Suspended"}
            {$LANG.cPanel.statusSuspendedNotice}
        {/if}
    </div>
{/if}

<div class="panel card panel-default mb-3" id="wpSquaredBillingOverviewPanel">
    <div class="panel-heading card-header">
        <h3 class="panel-title card-title m-0">{lang key='billingOverview'}</h3>
    </div>
    <div class="panel-body card-body">

        <div class="row">
            <div class="col-md-5">
                {if $firstpaymentamount neq $recurringamount}
                    <div class="row" id="firstPaymentAmount">
                        <div class="col-xs-6 col-6 text-right" >
                            {$LANG.firstpaymentamount}
                        </div>
                        <div class="col-xs-6 col-6">
                            {$firstpaymentamount}
                        </div>
                    </div>
                {/if}
                {if $billingcycle != $LANG.orderpaymenttermonetime && $billingcycle != $LANG.orderfree}
                    <div class="row" id="recurringAmount">
                        <div class="col-xs-6 col-6 text-right">
                            {$LANG.recurringamount}
                        </div>
                        <div class="col-xs-6 col-6">
                            {$recurringamount}
                        </div>
                    </div>
                {/if}
                <div class="row" id="billingCycle">
                    <div class="col-xs-6 col-6 text-right">
                        {$LANG.orderbillingcycle}
                    </div>
                    <div class="col-xs-6 col-6">
                        {$billingcycle}
                    </div>
                </div>
                <div class="row" id="paymentMethod">
                    <div class="col-xs-6 col-6 text-right">
                        {$LANG.orderpaymentmethod}
                    </div>
                    <div class="col-xs-6 col-6">
                        {$paymentmethod}
                    </div>
                </div>
            </div>
            <div class="col-md-7">
                <div class="row" id="registrationDate">
                    <div class="col-xs-6 col-6 col-xl-5 text-right">
                        {$LANG.clientareahostingregdate}
                    </div>
                    <div class="col-xs-6 col-6 col-xl-7">
                        {$regdate}
                    </div>
                </div>
                <div class="row" id="nextDueDate">
                    <div class="col-xs-6 col-6 col-xl-5 text-right">
                        {$LANG.clientareahostingnextduedate}
                    </div>
                    <div class="col-xs-6 col-6 col-xl-7">
                        {$nextduedate}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
{if $configurableoptions}
    <div class="panel card panel-default mb-3" id="wpSquaredConfigurableOptionsPanel">
        <div class="panel-heading card-header">
            <h3 class="panel-title card-title m-0">{$LANG.orderconfigpackage}</h3>
        </div>
        <div class="panel-body card-body">
            {foreach from=$configurableoptions item=configoption}
                <div class="row">
                    <div class="col-md-5 col-xs-6 col-6 text-right">
                        <strong>{$configoption.optionname|escape}</strong>
                    </div>
                    <div class="col-md-7 col-xs-6 col-6 text-left">
                        {if $configoption.optiontype eq 3}
                            {if $configoption.selectedqty}
                                {$LANG.yes}
                            {else}
                                {$LANG.no}
                            {/if}
                        {elseif $configoption.optiontype eq 4}
                            {$configoption.selectedqty} x {$configoption.selectedoption|escape}
                        {else}
                            {$configoption.selectedoption|escape}
                        {/if}
                    </div>
                </div>
            {/foreach}
        </div>
    </div>
{/if}
{if $metricStats}
    <div class="panel card panel-default mb-3" id="wpSquaredMetricStatsPanel">
        <div class="panel-heading card-header">
            <h3 class="panel-title card-title m-0">{$LANG.metrics.title}</h3>
        </div>
        <div class="panel-body card-body">
            {include file="$template/clientareaproductusagebilling.tpl"}
        </div>
    </div>
{/if}
{if $customfields}
    <div class="panel card panel-default mb-3" id="wpSquaredAdditionalInfoPanel">
        <div class="panel-heading card-header">
            <h3 class="panel-title card-title m-0">{$LANG.additionalInfo}</h3>
        </div>
        <div class="panel-body card-body">
            {foreach from=$customfields item=field}
                <div class="row">
                    <div class="col-md-5 col-xs-6 col-6 text-right">
                        <strong>{$field.name|escape}</strong>
                    </div>
                    <div class="col-md-7 col-xs-6 col-6 text-left">
                        {if empty($field.value)}
                            {$LANG.blankCustomField}
                        {else}
                            {$field.value|escape}
                        {/if}
                    </div>
                </div>
            {/foreach}
        </div>
    </div>
{/if}
