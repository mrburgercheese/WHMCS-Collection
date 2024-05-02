<table width="100%" class="form">
    <tr><td align="center">
            <table id="summaryAccounts"
                   class="table table-themed display data-driven filterable"
                   data-ajax-url="{routePath('admin-table-affiliate-accounts', $affiliateId)}"
                   data-dom='<"listtable"t><"row"<"text-left col-sm-4"l><"#summaryServicesInfo.text-center col-sm-4"i><"text-right col-sm-4"p>>'
                   data-ordering="true"
                   data-info="true"
                   data-searching="true"
                   data-paging="true"
                   data-length-change="true"
                   data-auto-width="true"
                   data-order='[[0, "desc"]]'
                   data-defer-render="true"
                   data-defer-loading="[{$filteredSignups}, {$totalSignups}]"
                   data-server-side="true"
                   data-page-length="{$AffiliatesPageLength}"
                   width="100%"
            >
                <thead>
                <tr>
                    <th data-name="id" data-searchable="false">{lang key='fields.id'}</th>
                    <th data-name="regdate" data-searchable="false" >{lang key='affiliates.signupdate'}</th>
                    <th data-name="clientname" data-searchable="false">{lang key='fields.clientname'}</th>
                    <th data-name="name" data-searchable="false" >{lang key='fields.product'}</th>
                    <th data-name="amount" data-searchable="false">{lang key='affiliates.commission'}</th>
                    <th data-name="lastpaid" data-searchable="false" >{lang key='affiliates.lastpaid'}</th>
                    <th data-name="productstatus" data-searchable="false">{lang key='affiliates.productstatus'}</th>
                    <th data-name="other" data-class-name="delete text-center" data-searchable="false" data-orderable="false" data-width="20"></th>
                    <th data-name="actions" data-class-name="delete text-center" data-searchable="false" data-orderable="false" data-width="20"></th>
                </tr>
                </thead>
                <tbody>
                {foreach key=num from=$accounts item=item}
                    <tr id="history{$item.affaccid}">
                        <td>{$item.affaccid}</td>
                        <td>{$item.signupdate}</td>
                        <td>{$item.clientname}</td>
                        <td><a href="clientshosting.php?userid={$item.userid}&id={$item.relid}">{$item.product}</a><br>{$item.amountdesc}</td>
                        <td>{$item.commission}</a></td>
                        <td>{$item.lastpaid}</td>
                        <td>{$item.productstatus}</td>
                        <td>
                            <a href="affiliates.php?action=edit&id={$item.id}&pay=true&affaccid={$item.affaccid}&serviceid={$item.relid}&userid={$item.userid}">
                                {lang key='affiliates.manual'}<br>{lang key='affiliates.payout'}
                            </a>
                        </td>
                        <td>
                            <a href="#" onClick="doAccDelete('{$item.affaccid}');return false">
                                <img src="images/delete.gif" border="0">
                            </a>
                        </td>
                    </tr>
                {/foreach}
                </tbody>
            </table>
        </td></tr>
</table>
