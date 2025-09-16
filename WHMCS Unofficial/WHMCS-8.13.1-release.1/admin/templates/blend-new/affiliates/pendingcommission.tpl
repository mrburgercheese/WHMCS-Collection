<table width="100%" class="form">
    <tr><td align="center">
            <table id="summaryPending"
                   class="table table-themed display data-driven filterable"
                   data-ajax-url="{routePath('admin-table-affiliate-pending', $affiliateId)}"
                   data-dom='<"listtable"t><"row"<"text-left col-sm-4"l><"#summaryServicesInfo.text-center col-sm-4"i><"text-right col-sm-4"p>>'
                   data-ordering="true"
                   data-info="true"
                   data-searching="true"
                   data-paging="true"
                   data-length-change="true"
                   data-auto-width="true"
                   data-order='[[6, "desc"]]'
                   data-defer-render="true"
                   data-defer-loading="[{$filteredPending}, {$totalPending}]"
                   data-server-side="true"
                   data-page-length="{$AffiliatesPageLength}"
                   width="100%"
            >
                <thead>
                <tr>
                    <th data-name="affaccid" data-searchable="false" data-orderable="false">{lang key='affiliates.refid'}</th>
                    <th data-name="clientname" data-searchable="false" data-orderable="false">{lang key='fields.clientname'}</th>
                    <th data-name="product" data-searchable="false" data-orderable="false">{lang key='fields.product'}</th>
                    <th data-name="productstatus" data-searchable="false" data-orderable="false">{lang key='affiliates.productstatus'}</th>
                    <th data-name="invoicenum" data-searchable="false" data-orderable="false">{lang key='fields.invoicenum'}</th>
                    <th data-name="amount" data-searchable="false" data-orderable="false">{lang key='fields.amount'}</th>
                    <th data-name="clearingdate" data-searchable="false" data-orderable="false">{lang key='affiliates.clearingdate'}</th>
                    <th data-name="actions" data-class-name="delete text-center" data-searchable="false" data-orderable="false" data-width="20"></th>
                </tr>
                </thead>
                <tbody>
                {foreach key=num from=$pending item=item}
                    <tr id="history{$item.affaccid}">
                        <td>{$item.affaccid}</a></td>
                        <td>{$item.clientname}</td>
                        <td><a href="clientshosting.php?userid={$item.userid}&id={$item.relid}">{$item.product}</a></td>
                        <td>{$item.productstatus}</td>
                        <td>{$item.invoicenum}</td>
                        <td>{$item.amount}</td>
                        <td>{$item.clearingdate}</td>
                        <td>
                            <a href="#" onClick="doPendingCommissionDelete('{$item.pendingid}');return false">
                                <img src="images/delete.gif" border="0">
                            </a>
                        </td>
                    </tr>
                {/foreach}
                </tbody>
            </table>
        </td></tr>
</table>
