{* This template file utilizes system's bootstrap and language translation functionality *}
<h3>{lang key='domainDnsSec.management'}</h3>

{if $successful}
    <div class="alert alert-success text-center">
        {lang key='changessavedsuccessfully'}
    </div>
{/if}

{if $error}
    <div class="alert alert-danger text-center">{$error}</div>
{/if}

<div class="alert alert-info text-center">
    {lang key='domainDnsSec.warning'}
</div>

<h4>{lang key='domainDnsSec.dsRecords'}</h4>
<div class="table-responsive">
    <table class="table table-striped">
        <thead>
        <tr>
            <th style="width:100px;;white-space: nowrap;">{lang key='domainDnsSec.keyTag'}</th>
            <th style="width:100px;">{lang key='domainDnsSec.algorithm'}</th>
            <th style="width:100px;white-space: nowrap;">{lang key='domainDnsSec.digestType'}</th>
            <th>{lang key='domainDnsSec.digest'}</th>
        </tr>
        </thead>
        <tbody>
        {foreach item=ds from=$dsdata name=dsdata}
            <tr>
                <td>{$ds.keyTag}</td>
                <td>{$algOptions[$ds.alg]}</td>
                <td>{$digestOptions[$ds.digestType]}</td>
                <td style="word-break: break-all;">{$ds.digest}</td>
            </tr>
            {foreachelse}
            <tr>
                <td colspan="4">No records</td>
            </tr>
        {/foreach}
        </tbody>
    </table>
</div>

<h4>{lang key='domainDnsSec.keyRecords'}</h4>
<form method="POST" action="">
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
            <tr>
                <th style="width:170px;">{lang key='domainDnsSec.flags'}</th>
                <th style="width:120px;">{lang key='domainDnsSec.protocol'}</th>
                <th style="width:200px;">{lang key='domainDnsSec.algorithm'}</th>
                <th>{lang key='domainDnsSec.publicKey'}</th>
            </tr>
            </thead>
            <tbody>
            {foreach item=key from=$ksdata name=ksdata}
                <tr>
                    <td>
                        <select name="DNSSEC[{$smarty.foreach.ksdata.index}][flag]" class="form-control">
                            {foreach $flagOptions as $flag => $name}
                                <option value="{$flag}"{if $key.flag eq $flag} selected{/if}>{$name}</option>
                            {/foreach}
                        </select>
                    </td>
                    <td>
                        <select name="DNSSEC[{$smarty.foreach.ksdata.index}][protocol]" class="form-control">
                            {foreach $protocols as $number => $protocol}
                                <option value="{$number}"{if $key.protocol eq $number} selected{/if}>{$protocol}</option>
                            {/foreach}
                        </select>
                    </td>
                    <td>
                        <select name="DNSSEC[{$smarty.foreach.ksdata.index}][alg]" class="form-control">
                            {foreach $algOptions as $alg => $name}
                                <option value="{$alg}"{if $key.alg eq $alg} selected{/if}>{$name}</option>
                            {/foreach}
                        </select>
                    </td>
                    <td>
                        <input class="form-control" type="text" name="DNSSEC[{$smarty.foreach.ksdata.index}][pubKey]" value="{$key.pubKey}" />
                    </td>
                </tr>
            {/foreach}
            <tr>
                <td>
                    <select name="DNSSEC[{$smarty.foreach.ksdata.index+1}][flag]" class="form-control">
                        {foreach $flagOptions as $flag => $name}
                            <option value="{$flag}">{$name}</option>
                        {/foreach}
                    </select>
                </td>
                <td>
                    <select name="DNSSEC[{$smarty.foreach.ksdata.index+1}][protocol]" class="form-control">
                        {foreach $protocols as $number => $protocol}
                            <option value="{$number}">{$protocol}</option>
                        {/foreach}
                    </select>
                </td>
                <td>
                    <select name="DNSSEC[{$smarty.foreach.ksdata.index+1}][alg]" class="form-control">
                        {foreach $algOptions as $alg => $name}
                            <option value="{$alg}">{$name}</option>
                        {/foreach}
                    </select>
                </td>
                <td>
                    <input class="form-control" type="text" name="DNSSEC[{$smarty.foreach.ksdata.index+1}][pubKey]" value="">
                </td>
            </tr>
            </tbody>
        </table>
    </div>
    <p class="text-center">
        <input type="submit" value="{lang key='clientareasavechanges'}" class="btn btn-primary">
        <input type="reset" value="{lang key='clientareacancel'}" class="btn btn-default">
    </p>
</form>
