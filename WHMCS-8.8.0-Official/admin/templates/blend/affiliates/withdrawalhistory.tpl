<table width="100%" class="form">
    <tr><td align="center">
            <table id="summaryWithdrawals"
                   class="table table-themed display data-driven filterable"
                   data-ajax-url="{routePath('admin-table-affiliate-withdrawals', $affiliateId)}"
                   data-dom='<"listtable"t><"row"<"text-left col-sm-4"l><"#summaryServicesInfo.text-center col-sm-4"i><"text-right col-sm-4"p>>'
                   data-ordering="true"
                   data-info="true"
                   data-searching="true"
                   data-paging="true"
                   data-length-change="true"
                   data-auto-width="true"
                   data-order='[[0, "desc"]]'
                   data-defer-render="true"
                   data-defer-loading="[{$filteredHistory}, {$totalHistory}]"
                   data-server-side="true"
                   data-page-length="{$AffiliatesPageLength}"
                   width="100%"
            >
                <thead>
                <tr>
                    <th data-name="date" data-searchable="false" data-orderable="false">{lang key='fields.date'}</th>
                    <th data-name="amount" data-searchable="false" data-orderable="false">{lang key='fields.amount'}</th>
                    <th data-name="actions" data-class-name="delete text-center" data-searchable="false" data-orderable="false" data-width="20"></th>
                </tr>
                </thead>
                <tbody>
                {foreach key=num from=$withdrawals item=item}
                    <tr id="history{$item.historyid}">
                        <td>{$item.date}</td>
                        <td>{$item.amount}</td>
                        <td>
                            <a href="#" onClick="doWithdrawHistoryDelete('{$item.historyid}');return false">
                                <img src="images/delete.gif" border="0">
                            </a>
                        </td>
                    </tr>
                {/foreach}
                </tbody>
            </table>
        </td></tr>
</table>
<br>
<form method="post" action="{$smarty.server.PHP_SELF}?action=withdraw&id={$affiliateId}">
    <p align="left"><b>{lang key='affiliates.makepayout'}</b></p>
    <table class="form" width="100%" border="0" cellspacing="2" cellpadding="3">
        <tr>
            <td class="fieldlabel">
               {lang key='fields.amount'}:
            </td>
            <td class="fieldarea">
                <input type="number" name="amount" class="form-control input-100" value="{$balance}" step="0.01"/>
            </td>
        </tr>
        <tr>
            <td class="fieldlabel">
                {lang key='affiliates.payouttype'}:
            </td>
            <td class="fieldarea">
                <select name="payouttype" class="form-control select-inline">
                    <option value="1">{lang key='affiliates.transactiontoclient'}</option>
                    <option value="2">{lang key='affiliates.addtocredit'}</option>
                    <option>{lang key='affiliates.withdrawalsonly'}</option>
                </select>
            </td>
        </tr>
        <tr>
            <td class="fieldlabel">
                {lang key='fields.transid'}:
            </td>
            <td class="fieldarea">
                <input type="text" name="transid" class="form-control input-inline input-200"/>
                ({lang key='affiliates.transactiontoclientinfo'})
            </td>
        </tr>
        <tr>
            <td class="fieldlabel">
                {lang key='fields.paymentmethod'}:
            </td>
            <td class="fieldarea">
                {paymentMethodsSelection({lang key='global.na'})}
            </td>
        </tr>
    </table>
    <div class="btn-container">
        <input type="submit" value="{lang key='global.submit'}" class="btn btn-primary" />
    </div>
</form>
