<div class="card">
    <div class="card-body">
        <div class="licensing-verification">
            <div class="alert alert-info text-center">
                <div class="row">
                    <div class="col-12 pb-2">
                        {$ADDONLANG.licenseVerificationToolInfo}
                    </div>
                    <div class="col-12">
                        {$ADDONLANG.reportUnlicensed}
                    </div>
                </div>
            </div>

            <h3>{$ADDONLANG.enterDomain}</h3>

            <form method="post" action="index.php?m=licensing">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="input-group input-group-lg">
                            <div class="input-group-addon input-group-prepend" id="sizing-addon1">
                                <span class="input-group-text">http://</span>
                            </div>
                            <input type="text" name="domain" class="form-control" placeholder="support.domain.com" value="{$domain}">
                            <div class="input-group-btn input-group-append">
                                <input type="submit" value="{$ADDONLANG.check}" class="btn btn-danger btn-lg btn-block" />
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 secondary-input-submit">
                        <input type="submit" value="{$ADDONLANG.check}" class="btn btn-danger btn-lg btn-block" />
                    </div>
                </div>
            </form>

            <br />

            {if !$check}

                <h3>{$ADDONLANG.howToUse}:</h3>

                <ul>
                    <li>{$ADDONLANG.enterDomain}</li>
                    <li>{$ADDONLANG.domainExample}</li>
                    <li>{$ADDONLANG.noWWW}</li>
                </ul>

            {else}

                <h2>Search Results</h2>

                {if $results}

                    <div class="alert alert-success text-center">
                        <div class="row">
                            <div class="col-12 pb-2">
                                <strong>{$ADDONLANG.licenseMatch}</strong>
                            </div>
                            <div class="col-12">
                                {$ADDONLANG.licenseMatchInfo}
                            </div>
                        </div>
                    </div>

                {else}

                    <div class="alert alert-warning text-center">
                        <div class="row">
                            <div class="col-12 pb-2">
                                <strong>{$ADDONLANG.noLicenseMatch}</strong>
                            </div>
                            <div class="col-12">
                                {$ADDONLANG.noLicenseMatchInfo}
                            </div>
                        </div>
                    </div>

                {/if}

            {/if}

            <br />

            <h2 class="text-center">{$ADDONLANG.thankYou}</h2>

            <br />
            <br />
            <br />
        </div>
    </div>
</div>