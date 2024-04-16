<table width="100%" class="form">
    <tr><td align="center">
            <table id="summaryHistory"
                   class="table table-themed display data-driven filterable"
                   data-ajax-url="{routePath('admin-table-affiliate-history', $affiliateId)}"
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
                    <th data-name="affaccid" data-searchable="false" data-orderable="false">{lang key='affiliates.refid'}</th>
                    <th data-name="clientname" data-searchable="false" data-orderable="false">{lang key='fields.clientname'}</th>
                    <th data-name="product" data-searchable="false" data-orderable="false">{lang key='fields.product'}</th>
                    <th data-name="productstatus" data-searchable="false" data-orderable="false">{lang key='affiliates.productstatus'}</th>
                    <th data-name="description" data-searchable="false" data-orderable="false" >{lang key='fields.description'}</th>
                    <th data-name="invoicenum" data-searchable="false" data-orderable="false">{lang key='fields.invoicenum'}</th>
                    <th data-name="amount" data-searchable="false" data-orderable="false">{lang key='fields.amount'}</th>
                    <th data-name="actions" data-class-name="delete text-center" data-searchable="false" data-orderable="false" data-width="20"></th>
                </tr>
                </thead>
                <tbody>
                {foreach key=num from=$history item=item}
                    <tr id="history{$item.historyid}">
                        <td>{$item.date}</td>
                        <td>{$item.affaccid}</a></td>
                        <td>{$item.clientname}</td>
                        <td>{if $item.affaccid}<a href="clientshosting.php?userid={$item.userid}&id={$item.relid}">{$item.product}</a>{/if}</td>
                        <td>{$item.productstatus}</td>
                        <td>{$item.description}</td>
                        <td>{$item.invoicenum}</td>
                        <td>{$item.amount}</td>
                        <td>
                            <a href="#" onClick="doAffHistoryDelete('{$item.historyid}');return false">
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
<form method="post" action="{$smarty.server.PHP_SELF}?action=addcomm&id={$affiliateId}">
    <p align="left"><b>{lang key='affiliates.addmanualcommissionentry'}</b></p>
    <table class="form" width="100%" border="0" cellspacing="2" cellpadding="3">
        <tr>
            <td class="fieldlabel">{lang key='fields.date'}:</td>
            <td class="fieldarea">
                <div class="form-group date-picker-prepend-icon">
                    <label for="inputDate" class="field-icon">
                        <i class="fal fa-calendar-alt"></i>
                    </label>
                    <input id="inputDate"
                           type="text"
                           name="date"
                           value="{getTodaysDate()}"
                           class="form-control input-inline date-picker-single"
                    />
                </div>
            </td>
        </tr>
        <tr>
            <td class="fieldlabel">{lang key='affiliates.relatedreferral'}:</td>
            <td class="fieldarea">
                <select name="refid" class="form-control select-inline">
                    <option value="">None</option>
                    {foreach key=num from=$referralOptions item=referral}
                        <option value="{$referral.value}">{$referral.text}</option>
                    {/foreach}
                </select>
            </td>
        </tr>
        <tr>
            <td class="fieldlabel">
                {lang key='fields.description'}:
            </td>
            <td class="fieldarea">
                <input type="text" name="description" class="form-control input-inline input-400" /> (Optional)
            </td>
        </tr>
        <tr>
            <td class="fieldlabel">
                {lang key='fields.amount'}:
            </td>
            <td class="fieldarea">
                <input type="number" name="amount" class="form-control input-100" value="0.00" step="0.01" />
            </td>
        </tr>
    </table>
    <div class="btn-container">
        <input type="submit" value="{lang key='global.submit'}" class="btn btn-primary" />
    </div>
</form>
