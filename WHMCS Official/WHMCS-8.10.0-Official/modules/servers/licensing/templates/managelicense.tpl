<div class="card">
    <div class="card-body">
        {if $status == "Reissued"}
            <div class="alert alert-success text-center">
                {$LANG.licensingaddon.reissuestatusmsg}
            </div>
        {/if}

        {if $downloads}
            <div class="alert alert-warning text-center licensing-addon-latest-download">
                <h3>{$LANG.licensingaddon.latestdownload}</h3>
                <p>{$downloads.0.description|nl2br|escape}</p>
                <p><a href="{$downloads.0.link}" class="btn btn-default">
                    <i class="fas fa-fw fa-download"></i>
                    {$LANG.licensingaddon.downloadnow}
                </a></p>
            </div>
        {/if}

        {foreach $hookOutput as $output}
            <div>
                {$output}
            </div>
        {/foreach}

        <div class="row d-block clearfix mb-2">
            {if $allowreissues || $packagesupgrade || $showCancellationButton}
                <div class="col-md-4 pull-md-right float-md-right">

                    <div class="row">

                        {if $allowreissues}
                            <div class="col-xs-4 col-4 col-md-12 margin-bottom-5 mb-1">
                                <form method="post" action="clientarea.php?action=productdetails">
                                    <input type="hidden" name="id" value="{$id}" />
                                    <input type="hidden" name="serveraction" value="custom" />
                                    <input type="hidden" name="a" value="reissue" />
                                    <button type="submit" class="btn btn-success btn-lg btn-block"{if $status != "Active"} disabled{/if}>
                                        <i class="fas fa-sync fa-2x"></i><br />
                                        {$LANG.licensingaddon.reissue}
                                    </button>
                                </form>
                            </div>
                        {/if}

                        {if $packagesupgrade}
                            <div class="col-xs-4 col-4 col-md-12 margin-bottom-5 mb-1">
                                <a href="upgrade.php?type=package&id={$id}" role="button" class="btn btn-info btn-lg btn-block">
                                    <i class="fas fa-arrow-up fa-2x"></i><br />
                                    {$LANG.upgrade}
                                </a>
                            </div>
                        {/if}

                        {if $showCancellationButton}
                            <div class="col-xs-4 col-4 col-md-12 margin-bottom-5 mb-1">
                                <form method="post" action="clientarea.php?action=cancel">
                                    <input type="hidden" name="id" value="{$id}" />
                                    <button type="submit" class="btn btn-danger btn-lg btn-block{if $pendingcancellation} disabled{/if}">
                                        <i class="fas fa-times fa-2x"></i><br />
                                        {if $pendingcancellation}
                                            {$LANG.cancellationrequested}
                                        {else}
                                            {$LANG.cancel}
                                        {/if}
                                    </button>
                                </form>
                            </div>
                        {/if}
                    </div>
                </div>
            {/if}

            {if $allowreissues || $packagesupgrade || $showCancellationButton}
                <div class="col-md-8">
            {else}
                <div class="col-md-12">
            {/if}

                <div class="mb-2">
                    <h4>{$LANG.licensingaddon.licensekey}</h4>
                    <input type="text" class="form-control" readonly="true" value="{$licensekey}" />
                </div>

                {if $configurableoptions}
                    <div class="alert alert-info margin-top-5">
                        {foreach from=$configurableoptions item=configoption}
                            <div class="row">
                                <div class="col-xs-5 col-5 text-right">
                                    <strong>{$configoption.optionname|escape}</strong>
                                </div>
                                <div class="col-xs-7 col-7">
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
                {/if}

                {if !$allowDomainConflicts}
                    <div class="mb-2">
                        <h4>{$LANG.licensingaddon.validdomains}</h4>
                        <textarea rows="2" class="form-control" readonly="true">{$validdomain|escape}</textarea>
                    </div>
                {/if}

                {if !$allowIpConflicts}
                    <div class="mb-2">
                        <h4>{$LANG.licensingaddon.validips}</h4>
                        <textarea rows="2" class="form-control" readonly="true">{$validip|escape}</textarea>
                    </div>
                {/if}

                {if !$allowDirectoryConflicts}
                    <div class="mb-2">
                        <h4>{$LANG.licensingaddon.validdirectory}</h4>
                        <textarea rows="2" class="form-control" readonly="true">{$validdirectory|escape}</textarea>
                    </div>
                {/if}

                <div class="mb-2">
                    <h4>{$LANG.licensingaddon.status}</h4>
                    <p>
                        {$status}
                        {if $suspendreason}({$suspendreason}){/if}
                    </p>
                </div>
            </div>
        </div>

        <div class="row mb-2">
            <div class="col-sm-4 text-center">
                <h4>{$LANG.clientareahostingregdate}</h4>
                {$regdate}
            </div>
            <div class="col-sm-4 text-center">
                <h4>{$LANG.clientareahostingnextduedate}</h4>
                {$nextduedate}
            </div>
            <div class="col-sm-4 text-center">
                <h4>{$LANG.orderbillingcycle}</h4>
                {$billingcycle}
            </div>
        </div>

        <div class="row mb-2">
            {if $firstpaymentamount neq $recurringamount}
            <div class="col-sm-4 text-center">
                <h4>{$LANG.firstpaymentamount}</h4>
                {$firstpaymentamount}
            </div>
            {/if}
            {if $billingcycle != $LANG.orderpaymenttermonetime && $billingcycle != $LANG.orderpaymenttermfreeaccount}
            <div class="col-sm-4 text-center">
                <h4>{$LANG.recurringamount}</h4>
                {$recurringamount}
            </div>
            {/if}
            {if $firstpaymentamount neq $recurringamount || ($billingcycle != $LANG.orderpaymenttermonetime && $billingcycle != $LANG.orderpaymenttermfreeaccount)}
            <div class="col-sm-4 text-center">
                <h4>{$LANG.orderpaymentmethod}</h4>
                {$paymentmethod}
            </div>
            {/if}
        </div>

        {if $customfields}
            <div class="row mb-2">
                {foreach from=$customfields item=field}
                    <div class="col-sm-4 text-center">
                        <h4>{$field.name|escape}</h4>
                        {if $field.value}{$field.value|escape}{else}-{/if}
                    </div>
                {/foreach}
            </div>
        {/if}
    </div>
</div>