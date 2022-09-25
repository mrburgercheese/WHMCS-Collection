<?php
/* Smarty version 3.1.36, created on 2022-09-24 20:28:19
  from '/home/whmnodec/public_html/manage/admin/templates/blend/clientssummary.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.36',
  'unifunc' => 'content_632f6863d871d8_33761067',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '4f911402629aa385af6b2108a8249ffd244b44ab' => 
    array (
      0 => '/home/whmnodec/public_html/manage/admin/templates/blend/clientssummary.tpl',
      1 => 1655190152,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_632f6863d871d8_33761067 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'/home/whmnodec/public_html/manage/vendor/smarty/smarty/libs/plugins/function.cycle.php','function'=>'smarty_function_cycle',),1=>array('file'=>'/home/whmnodec/public_html/manage/vendor/smarty/smarty/libs/plugins/modifier.replace.php','function'=>'smarty_modifier_replace',),));
?>
<div id="clientsummarycontainer">

    <div class="clearfix">

        <div class="clientsummaryactions">
            <?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['clientsummary']['settingtaxexempt'];?>
: <span id="taxstatus" class="csajaxtoggle" style="text-decoration:underline;cursor:pointer"><strong class="<?php if ($_smarty_tpl->tpl_vars['clientsdetails']->value['taxstatus'] == "Yes") {?>textgreen<?php } else { ?>textred<?php }?>"><?php echo $_smarty_tpl->tpl_vars['clientsdetails']->value['taxstatus'];?>
</strong></span>
            &nbsp;&nbsp;
            <?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['clientsummary']['settingautocc'];?>
: <span id="autocc" class="csajaxtoggle" style="text-decoration:underline;cursor:pointer"><strong class="<?php if ($_smarty_tpl->tpl_vars['clientsdetails']->value['autocc'] == "Yes") {?>textgreen<?php } else { ?>textred<?php }?>"><?php echo $_smarty_tpl->tpl_vars['clientsdetails']->value['autocc'];?>
</strong></span>
            &nbsp;&nbsp;
            <?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['clientsummary']['settingreminders'];?>
: <span id="overduenotices" class="csajaxtoggle" style="text-decoration:underline;cursor:pointer"><strong class="<?php if ($_smarty_tpl->tpl_vars['clientsdetails']->value['overduenotices'] == "Yes") {?>textgreen<?php } else { ?>textred<?php }?>"><?php echo $_smarty_tpl->tpl_vars['clientsdetails']->value['overduenotices'];?>
</strong></span>
            &nbsp;&nbsp;
            <?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['clientsummary']['settinglatefees'];?>
: <span id="latefees" class="csajaxtoggle" style="text-decoration:underline;cursor:pointer"><strong class="<?php if ($_smarty_tpl->tpl_vars['clientsdetails']->value['latefees'] == "Yes") {?>textgreen<?php } else { ?>textred<?php }?>"><?php echo $_smarty_tpl->tpl_vars['clientsdetails']->value['latefees'];?>
</strong></span>
        </div>

        <div class="client-summary-name">
            #<span id="userId"><?php echo $_smarty_tpl->tpl_vars['clientsdetails']->value['userid'];?>
</span> - <?php echo $_smarty_tpl->tpl_vars['clientsdetails']->value['firstname'];?>
 <?php echo $_smarty_tpl->tpl_vars['clientsdetails']->value['lastname'];?>

        </div>

        <?php if ($_smarty_tpl->tpl_vars['emailVerificationEnabled']->value && $_smarty_tpl->tpl_vars['emailVerificationPending']->value) {?>
            <div class="verification-banner email-verification alert-warning" role="alert">
                <i class="fas fa-exclamation-triangle"></i>
                &nbsp;
                <?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['global']['emailAddressNotVerified'];?>

                <div class="pull-right">
                    <button id="btnResendVerificationEmail" class="btn btn-default btn-sm" data-clientid="<?php echo $_smarty_tpl->tpl_vars['clientsdetails']->value['userid'];?>
" data-successmsg="<?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['global']['emailSent'];?>
" data-errormsg="<?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['global']['erroroccurred'];?>
">
                        <?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['global']['resendEmail'];?>

                    </button>
                </div>
            </div>
        <?php }?>

        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['addons_html']->value, 'addon_html');
$_smarty_tpl->tpl_vars['addon_html']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['addon_html']->value) {
$_smarty_tpl->tpl_vars['addon_html']->do_else = false;
?>
            <div class="addon-html-output-container">
                <?php echo $_smarty_tpl->tpl_vars['addon_html']->value;?>

            </div>
        <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>

    </div>

    <div class="row client-summary-panels">
        <div class="col-lg-3 col-sm-6">

            <div class="clientssummarybox">
                <div class="title"><?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['clientsummary']['infoheading'];?>
</div>
                <table class="clientssummarystats" cellspacing="0" cellpadding="2">
                    <tr><td width="110"><?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['fields']['firstname'];?>
</td><td><?php echo $_smarty_tpl->tpl_vars['clientsdetails']->value['firstname'];?>
</td></tr>
                    <tr class="altrow"><td><?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['fields']['lastname'];?>
</td><td><?php echo $_smarty_tpl->tpl_vars['clientsdetails']->value['lastname'];?>
</td></tr>
                    <tr><td><?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['fields']['companyname'];?>
</td><td><?php echo $_smarty_tpl->tpl_vars['clientsdetails']->value['companyname'];?>
</td></tr>
                    <tr class="altrow"><td><?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['fields']['email'];?>
</td><td><?php echo $_smarty_tpl->tpl_vars['clientsdetails']->value['email'];?>
</td></tr>
                    <tr><td><?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['fields']['address1'];?>
</td><td><?php echo $_smarty_tpl->tpl_vars['clientsdetails']->value['address1'];?>
</td></tr>
                    <tr class="altrow"><td><?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['fields']['address2'];?>
</td><td><?php echo $_smarty_tpl->tpl_vars['clientsdetails']->value['address2'];?>
</td></tr>
                    <tr><td><?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['fields']['city'];?>
</td><td><?php echo $_smarty_tpl->tpl_vars['clientsdetails']->value['city'];?>
</td></tr>
                    <tr class="altrow"><td><?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['fields']['state'];?>
</td><td><?php echo $_smarty_tpl->tpl_vars['clientsdetails']->value['state'];?>
</td></tr>
                    <tr><td><?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['fields']['postcode'];?>
</td><td><?php echo $_smarty_tpl->tpl_vars['clientsdetails']->value['postcode'];?>
</td></tr>
                    <tr class="altrow"><td><?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['fields']['country'];?>
</td><td><?php echo $_smarty_tpl->tpl_vars['clientsdetails']->value['country'];?>
 - <?php echo $_smarty_tpl->tpl_vars['clientsdetails']->value['countrylong'];?>
</td></tr>
                    <tr><td><?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['fields']['phonenumber'];?>
</td><td><?php echo $_smarty_tpl->tpl_vars['clientsdetails']->value['phonenumber'];?>
</td></tr>
                    <?php if ($_smarty_tpl->tpl_vars['showTaxIdField']->value) {?>
                        <tr class="altrow">
                            <td><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['lang'][0], array( array('key'=>\WHMCS\Billing\Tax\Vat::getLabel('fields')),$_smarty_tpl ) );?>
</td>
                            <td><?php echo $_smarty_tpl->tpl_vars['clientsdetails']->value['tax_id'];?>
</td>
                        </tr>
                    <?php }?>
                </table>
                <ul>
                    <li>
                        <a id="summary-login-as-owner" class="summary-login-as-owner" data-new-window="0" href="#"><img src="images/icons/clientlogin.png" border="0" align="absmiddle" /> <?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['clientsummary']['loginasowner'];?>
</a>
                        <a id="summary-login-as-owner-new-window" class="summary-login-as-owner" data-new-window="1" href="#" title="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['lang'][0], array( array('key'=>'global.openInNewWindow'),$_smarty_tpl ) );?>
">
                            <i class="fas fa-window-restore"></i>
                        </a>
                    </li>
                </ul>
            </div>

            <div class="clientssummarybox">
                <div class="title"><?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['clientsummary']['contactsheading'];?>
</div>
                <table class="clientssummarystats" cellspacing="0" cellpadding="2">
                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['contacts']->value, 'contact', false, 'num');
$_smarty_tpl->tpl_vars['contact']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['num']->value => $_smarty_tpl->tpl_vars['contact']->value) {
$_smarty_tpl->tpl_vars['contact']->do_else = false;
?>
                    <tr class="<?php echo smarty_function_cycle(array('values'=>",altrow"),$_smarty_tpl);?>
"><td align="center"><a href="clientscontacts.php?userid=<?php echo $_smarty_tpl->tpl_vars['clientsdetails']->value['userid'];?>
&contactid=<?php echo $_smarty_tpl->tpl_vars['contact']->value['id'];?>
"><?php echo $_smarty_tpl->tpl_vars['contact']->value['firstname'];?>
 <?php echo $_smarty_tpl->tpl_vars['contact']->value['lastname'];?>
</a> - <?php echo $_smarty_tpl->tpl_vars['contact']->value['email'];?>
</td></tr>
                <?php
}
if ($_smarty_tpl->tpl_vars['contact']->do_else) {
?>
                    <tr><td align="center"><?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['clientsummary']['nocontacts'];?>
</td></tr>
                <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                </table>
                <ul>
                    <li><a href="clientscontacts.php?userid=<?php echo $_smarty_tpl->tpl_vars['clientsdetails']->value['userid'];?>
&contactid=addnew"><img src="images/icons/clientsadd.png" border="0" align="absmiddle" /> <?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['clients']['addcontact'];?>
</a></li>
                </ul>
            </div>
            <?php echo $_smarty_tpl->tpl_vars['paymethodsSummary']->value;?>


        </div>
        <div class="col-lg-3 col-sm-6">
            <div class="clientssummarybox">
                <div class="title"><?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['clientsummary']['billingheading'];?>
</div>
                <table class="clientssummarystats" cellspacing="0" cellpadding="2">
                    <tr>
                        <td width="110"><?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['status']['paid'];?>
</td>
                        <td><?php echo $_smarty_tpl->tpl_vars['stats']->value['numpaidinvoices'];?>
 (<?php echo $_smarty_tpl->tpl_vars['stats']->value['paidinvoicesamount'];?>
)</td>
                    </tr>
                    <tr class="altrow">
                        <td><?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['status']['draft'];?>
</td>
                        <td><?php echo $_smarty_tpl->tpl_vars['stats']->value['numDraftInvoices'];?>
 (<?php echo $_smarty_tpl->tpl_vars['stats']->value['draftInvoicesBalance'];?>
)</td>
                    </tr>
                    <tr>
                        <td><?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['status']['unpaid'];?>
/<?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['status']['due'];?>
</td>
                        <td><?php echo $_smarty_tpl->tpl_vars['stats']->value['numdueinvoices'];?>
 (<?php echo $_smarty_tpl->tpl_vars['stats']->value['dueinvoicesbalance'];?>
)</td>
                    </tr>
                    <tr class="altrow">
                        <td><?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['status']['cancelled'];?>
</td>
                        <td><?php echo $_smarty_tpl->tpl_vars['stats']->value['numcancelledinvoices'];?>
 (<?php echo $_smarty_tpl->tpl_vars['stats']->value['cancelledinvoicesamount'];?>
)</td>
                    </tr>
                    <tr>
                        <td><?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['status']['refunded'];?>
</td>
                        <td><?php echo $_smarty_tpl->tpl_vars['stats']->value['numrefundedinvoices'];?>
 (<?php echo $_smarty_tpl->tpl_vars['stats']->value['refundedinvoicesamount'];?>
)</td>
                    </tr>
                    <tr class="altrow">
                        <td><?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['status']['collections'];?>
</td>
                        <td><?php echo $_smarty_tpl->tpl_vars['stats']->value['numcollectionsinvoices'];?>
 (<?php echo $_smarty_tpl->tpl_vars['stats']->value['collectionsinvoicesamount'];?>
)</td>
                    </tr>
                    <tr>
                        <td colspan="2"><strong><?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['billing']['income'];?>
</strong></td>
                    </tr>
                    <tr class="altrow">
                        <td><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['lang'][0], array( array('key'=>'billing.grossRevenue'),$_smarty_tpl ) );?>
</td>
                        <td><?php echo $_smarty_tpl->tpl_vars['stats']->value['grossRevenue'];?>
</td>
                    </tr>
                    <tr>
                        <td><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['lang'][0], array( array('key'=>'billing.clientExpenses'),$_smarty_tpl ) );?>
</td>
                        <td><?php echo $_smarty_tpl->tpl_vars['stats']->value['expenses'];?>
</td>
                    </tr>
                    <tr class="altrow">
                        <td><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['lang'][0], array( array('key'=>'billing.netIncome'),$_smarty_tpl ) );?>
</td>
                        <td><strong><?php echo $_smarty_tpl->tpl_vars['stats']->value['income'];?>
</strong></td>
                    </tr>
                    <tr>
                        <td><?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['clients']['creditbalance'];?>
</td>
                        <td><?php echo $_smarty_tpl->tpl_vars['stats']->value['creditbalance'];?>
</td>
                    </tr>
                </table>
                <ul>
                    <?php if (in_array('Create Invoice',$_smarty_tpl->tpl_vars['admin_perms']->value)) {?>
                        <li><a href="invoices.php?action=createinvoice&userid=<?php echo $_smarty_tpl->tpl_vars['clientsdetails']->value['userid'];?>
&token=<?php echo $_smarty_tpl->tpl_vars['csrfToken']->value;?>
"><img src="images/icons/invoicesedit.png" border="0" align="absmiddle" /> <?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['invoices']['create'];?>
</a></li>
                    <?php }?>
                    <?php if (in_array('Create Add Funds Invoice',$_smarty_tpl->tpl_vars['admin_perms']->value)) {?>
                        <li><a href="#" data-toggle="modal" data-target="#modalAddFunds"><img src="images/icons/addfunds.png" border="0" align="absmiddle" /> <?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['clientsummary']['createaddfunds'];?>
</a></li>
                    <?php }?>
                    <?php if (in_array('Generate Due Invoices',$_smarty_tpl->tpl_vars['admin_perms']->value)) {?>
                        <li><a href="#" data-toggle="modal" data-target="#modalGenerateInvoices"><img src="images/icons/ticketspredefined.png" border="0" align="absmiddle" /> <?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['invoices']['geninvoices'];?>
</a></li>
                    <?php }?>
                    <li><a href="clientsbillableitems.php?userid=<?php echo $_smarty_tpl->tpl_vars['clientsdetails']->value['userid'];?>
&action=manage"><img src="images/icons/billableitems.png" border="0" align="absmiddle" /> <?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['billableitems']['additem'];?>
</a></li>
                    <li><a href="#" id="manageCredits" onClick="window.open('clientscredits.php?userid=<?php echo $_smarty_tpl->tpl_vars['clientsdetails']->value['userid'];?>
','','width=800,height=350,scrollbars=yes');return false"><img src="images/icons/income.png" border="0" align="absmiddle" /> <?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['clientsummary']['managecredits'];?>
</a></li>
                    <li><a href="quotes.php?action=manage&userid=<?php echo $_smarty_tpl->tpl_vars['clientsdetails']->value['userid'];?>
"><img src="images/icons/quotes.png" border="0" align="absmiddle" /> <?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['quotes']['createnew'];?>
</a></li>
                </ul>
            </div>

            <div class="clientssummarybox">
                <div class="title"><?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['clientsummary']['otherinfoheading'];?>
</div>
                <table class="clientssummarystats" cellspacing="0" cellpadding="2">
                    <tr><td width="110"><?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['fields']['status'];?>
</td><td><?php echo $_smarty_tpl->tpl_vars['clientsdetails']->value['status'];?>
</td></tr>
                    <tr class="altrow"><td><?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['fields']['clientgroup'];?>
</td><td><?php echo $_smarty_tpl->tpl_vars['clientgroup']->value['name'];?>
</td></tr>
                    <tr><td><?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['fields']['signupdate'];?>
</td><td><?php echo $_smarty_tpl->tpl_vars['signupdate']->value;?>
</td></tr>
                    <tr class="altrow"><td><?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['clientsummary']['clientfor'];?>
</td><td><?php echo $_smarty_tpl->tpl_vars['clientfor']->value;?>
</td></tr>
                    <tr><td width="110"><?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['clientsummary']['lastlogin'];?>
</td><td><?php echo $_smarty_tpl->tpl_vars['lastlogin']->value;?>
</td></tr>
                    <?php if ($_smarty_tpl->tpl_vars['emailVerificationEnabled']->value) {?>
                    <tr class="altrow"><td><?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['fields']['owner'];?>
 <?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['fields']['emailverified'];?>
</td><td><?php if ($_smarty_tpl->tpl_vars['emailVerified']->value) {
echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['global']['yes'];
} else {
echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['global']['no'];
}?></td></tr>
                    <?php }?>
                </table>
            </div>

        </div>
        <div class="col-lg-3 col-sm-6">

            <div class="clientssummarybox">
                <div class="title"><?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['services']['title'];?>
</div>
                <table class="clientssummarystats" cellspacing="0" cellpadding="2">
                    <tr><td width="140"><?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['orders']['sharedhosting'];?>
</td><td><?php echo $_smarty_tpl->tpl_vars['stats']->value['productsnumactivehosting'];?>
 (<?php echo $_smarty_tpl->tpl_vars['stats']->value['productsnumhosting'];?>
 Total)</td></tr>
                    <tr class="altrow"><td><?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['orders']['resellerhosting'];?>
</td><td><?php echo $_smarty_tpl->tpl_vars['stats']->value['productsnumactivereseller'];?>
 (<?php echo $_smarty_tpl->tpl_vars['stats']->value['productsnumreseller'];?>
 Total)</td></tr>
                    <tr><td><?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['orders']['server'];?>
</td><td><?php echo $_smarty_tpl->tpl_vars['stats']->value['productsnumactiveservers'];?>
 (<?php echo $_smarty_tpl->tpl_vars['stats']->value['productsnumservers'];?>
 Total)</td></tr>
                    <tr class="altrow"><td><?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['orders']['other'];?>
</td><td><?php echo $_smarty_tpl->tpl_vars['stats']->value['productsnumactiveother'];?>
 (<?php echo $_smarty_tpl->tpl_vars['stats']->value['productsnumother'];?>
 Total)</td></tr>
                    <tr><td><?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['domains']['title'];?>
</td><td><?php echo $_smarty_tpl->tpl_vars['stats']->value['numactivedomains'];?>
 (<?php echo $_smarty_tpl->tpl_vars['stats']->value['numdomains'];?>
 Total)</td></tr>
                    <tr class="altrow"><td><?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['stats']['acceptedquotes'];?>
</td><td><?php echo $_smarty_tpl->tpl_vars['stats']->value['numacceptedquotes'];?>
 (<?php echo $_smarty_tpl->tpl_vars['stats']->value['numquotes'];?>
 Total)</td></tr>
                    <tr><td><?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['support']['supporttickets'];?>
</td><td><?php echo $_smarty_tpl->tpl_vars['stats']->value['numactivetickets'];?>
 (<?php echo $_smarty_tpl->tpl_vars['stats']->value['numtickets'];?>
 Total)</td></tr>
                    <tr class="altrow"><td><?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['stats']['affiliatesignups'];?>
</td><td><?php echo $_smarty_tpl->tpl_vars['stats']->value['numaffiliatesignups'];?>
</td></tr>
                </table>
                <ul>
                    <li><a href="orders.php?clientid=<?php echo $_smarty_tpl->tpl_vars['clientsdetails']->value['userid'];?>
"><img src="images/icons/orders.png" border="0" align="absmiddle" /> <?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['clientsummary']['vieworders'];?>
</a></li>
                    <li><a href="ordersadd.php?userid=<?php echo $_smarty_tpl->tpl_vars['clientsdetails']->value['userid'];?>
"><img src="images/icons/ordersadd.png" border="0" align="absmiddle" /> <?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['orders']['addnew'];?>
</a></li>
                </ul>
            </div>

            <div class="clientssummarybox">
                <div class="title"><?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['clientsummary']['filesheading'];?>
</div>
                <table class="clientssummarystats" cellspacing="0" cellpadding="2">
                    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['files']->value, 'file', false, 'num');
$_smarty_tpl->tpl_vars['file']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['num']->value => $_smarty_tpl->tpl_vars['file']->value) {
$_smarty_tpl->tpl_vars['file']->do_else = false;
?>
                        <tr class="<?php echo smarty_function_cycle(array('values'=>",altrow"),$_smarty_tpl);?>
"><td align="center"><a href="../dl.php?type=f&id=<?php echo $_smarty_tpl->tpl_vars['file']->value['id'];?>
"><i class="far fa-file"></i> <?php echo $_smarty_tpl->tpl_vars['file']->value['title'];?>
</a> <?php if ($_smarty_tpl->tpl_vars['file']->value['adminonly']) {?>(<?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['clientsummary']['fileadminonly'];?>
)<?php }?> <img src="images/icons/delete.png" align="absmiddle" border="0" onClick="deleteFile('<?php echo $_smarty_tpl->tpl_vars['file']->value['id'];?>
')" /></td></tr>
                    <?php
}
if ($_smarty_tpl->tpl_vars['file']->do_else) {
?>
                        <tr><td align="center"><?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['clientsummary']['nofiles'];?>
</td></tr>
                    <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                </table>
                <ul>
                    <li><a href="#" id="addfile"><img src="images/icons/add.png" border="0" align="absmiddle" /> <?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['clientsummary']['fileadd'];?>
</a></li>
                </ul>
                <div id="addfileform" style="display:none;" class="top-margin-5">
                    <form method="post" action="clientssummary.php?userid=<?php echo $_smarty_tpl->tpl_vars['clientsdetails']->value['userid'];?>
&action=uploadfile" enctype="multipart/form-data">
                        <table class="clientssummarystats" cellspacing="0" cellpadding="2">
                            <tr><td width="40"><?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['clientsummary']['filetitle'];?>
</td><td class="fieldarea"><input type="text" name="title" style="width:90%" /></td></tr>
                            <tr><td><?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['clientsummary']['filename'];?>
</td><td class="fieldarea"><input type="file" name="uploadfile" style="width:90%" />
                                    <p class="text-muted">
                                        <small><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['lang'][0], array( array('key'=>"system.maxFileSize",'fileSize'=>((string)$_smarty_tpl->tpl_vars['uploadMaxFileSize']->value)),$_smarty_tpl ) );?>
</small>
                                    </p>
                                </td></tr>
                            <tr><td></td><td class="fieldarea"><input type="checkbox" name="adminonly" value="1" /> <?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['clientsummary']['fileadminonly'];?>
 &nbsp;&nbsp;&nbsp;&nbsp; <input type="submit" value="<?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['global']['submit'];?>
" /></td></tr>
                        </table>
                    </form>
                </div>
            </div>

            <div class="clientssummarybox">
                <div class="title"><?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['clientsummary']['emailsheading'];?>
</div>
                <table class="clientssummarystats" cellspacing="0" cellpadding="2">
                    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['lastfivemail']->value, 'email', false, 'num');
$_smarty_tpl->tpl_vars['email']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['num']->value => $_smarty_tpl->tpl_vars['email']->value) {
$_smarty_tpl->tpl_vars['email']->do_else = false;
?>
                        <tr class="<?php echo smarty_function_cycle(array('values'=>",altrow"),$_smarty_tpl);?>
">
                            <td align="center">
                                <?php echo $_smarty_tpl->tpl_vars['email']->value['date'];?>
 - <a href="clientsemails.php?&displaymessage=true&id=<?php echo $_smarty_tpl->tpl_vars['email']->value['id'];?>
" class="open-modal" data-modal-title="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['lang'][0], array( array('key'=>htmlspecialchars('emails.viewemailmessage', ENT_QUOTES, 'UTF-8', true)),$_smarty_tpl ) );?>
">
                                    <?php echo $_smarty_tpl->tpl_vars['email']->value['subject'];?>

                                </a>
                            </td>
                        </tr>
                    <?php
}
if ($_smarty_tpl->tpl_vars['email']->do_else) {
?>
                        <tr><td align="center"><?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['clientsummary']['noemails'];?>
</td></tr>
                    <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                </table>
            </div>

        </div>
        <div class="col-lg-3 col-sm-6">

            <div class="clientssummarybox">
                <div class="title"><?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['clientsummary']['actionsheading'];?>
</div>
                <ul>
                    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['customactionlinks']->value, 'customactionlink');
$_smarty_tpl->tpl_vars['customactionlink']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['customactionlink']->value) {
$_smarty_tpl->tpl_vars['customactionlink']->do_else = false;
?>
                        <li><?php echo $_smarty_tpl->tpl_vars['customactionlink']->value;?>
</li>
                    <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                    <li><a href="reports.php?report=client_statement&userid=<?php echo $_smarty_tpl->tpl_vars['clientsdetails']->value['userid'];?>
"><img src="images/icons/reports.png" border="0" align="absmiddle" /> <?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['clientsummary']['accountstatement'];?>
</a></li>
                    <li><a href="supporttickets.php?action=open&userid=<?php echo $_smarty_tpl->tpl_vars['clientsdetails']->value['userid'];?>
"><img src="images/icons/ticketsopen.png" border="0" align="absmiddle" /> <?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['clientsummary']['newticket'];?>
</a></li>
                    <li><a href="supporttickets.php?view=any&client=<?php echo $_smarty_tpl->tpl_vars['clientsdetails']->value['userid'];?>
"><img src="images/icons/ticketsother.png" border="0" align="absmiddle" /> <?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['clientsummary']['viewtickets'];?>
</a></li>
                    <li id="affiliateLink"><a href="<?php if ($_smarty_tpl->tpl_vars['affiliateid']->value) {?>affiliates.php?action=edit&id=<?php echo $_smarty_tpl->tpl_vars['affiliateid']->value;
} else { ?>clientssummary.php?userid=<?php echo $_smarty_tpl->tpl_vars['clientsdetails']->value['userid'];?>
&activateaffiliate=true&token=<?php echo $_smarty_tpl->tpl_vars['csrfToken']->value;
}?>"><img src="images/icons/affiliates.png" border="0" align="absmiddle" /> <?php if ($_smarty_tpl->tpl_vars['affiliateid']->value) {
echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['clientsummary']['viewaffiliate'];
} else {
echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['clientsummary']['activateaffiliate'];
}?></a></li>
                    <li>
                        <a href="clientsmerge.php?userid=<?php echo $_smarty_tpl->tpl_vars['clientsdetails']->value['userid'];?>
" class="open-modal" data-modal-title="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['lang'][0], array( array('key'=>'clients.mergeclient'),$_smarty_tpl ) );?>
" data-btn-submit-id="btnMerge" data-btn-submit-label="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['lang'][0], array( array('key'=>'invoices.merge'),$_smarty_tpl ) );?>
">
                            <img src="images/icons/clients.png" border="0" align="absmiddle" /> <?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['clientsummary']['mergeclients'];?>

                        </a>
                    </li>
                    <li><a href="#" onClick="closeClient();return false" style="color:#000000;"><img src="images/icons/delete.png" border="0" align="absmiddle" /> <?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['clientsummary']['closeclient'];?>
</a></li>
                    <li><a id="btnDeleteClient" href="#" style="color:#CC0000;"><img src="images/icons/delete.png" border="0" align="absmiddle" /> <?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['clientsummary']['deleteclient'];?>
</a></li>
                    <li>
                        <a href="reports.php?report=client&userid=<?php echo $_smarty_tpl->tpl_vars['clientsdetails']->value['userid'];?>
">
                            <img src="images/icons/csvexports.png" border="0" align="absmiddle" />
                            <?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['clientsummary']['export'];?>

                        </a>
                    </li>
                </ul>
            </div>

            <div class="clientssummarybox">
                <div class="title"><?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['clientsummary']['sendemailheading'];?>
</div>
                <form action="clientsemails.php?userid=<?php echo $_smarty_tpl->tpl_vars['clientsdetails']->value['userid'];?>
&action=send&type=general" method="post">
                    <input type="hidden" name="id" value="<?php echo $_smarty_tpl->tpl_vars['clientsdetails']->value['userid'];?>
">
                    <div align="center"><?php echo $_smarty_tpl->tpl_vars['messages']->value;?>
 <input type="submit" value="<?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['global']['go'];?>
" class="button btn btn-default"></div>
                </form>
            </div>

            <div class="clientssummarybox">
                <div class="title"><?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['fields']['adminnotes'];?>
</div>
                <form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>
?userid=<?php echo $_smarty_tpl->tpl_vars['clientsdetails']->value['userid'];?>
&action=savenotes">
                    <div align="center">
                        <textarea name="adminnotes" rows="5" class="form-control bottom-margin-5"><?php echo $_smarty_tpl->tpl_vars['clientsdetails']->value['notes'];?>
</textarea>
                        <input type="submit" value="<?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['global']['submit'];?>
" class="button btn btn-default" />
                    </div>
                </form>
            </div>

        </div>
    </div>

    <p align="right">
        <button id="btnStatusEnabled" type="button" value="filter" class="btn btn-xs btn-small" onclick="toggleStatusFilter()">
            <?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['clientsummary']['statusfilter'];?>
: <span class="on"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['lang'][0], array( array('key'=>'global.on'),$_smarty_tpl ) );?>
</span><span class="off"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['lang'][0], array( array('key'=>'global.off'),$_smarty_tpl ) );?>
</span>
        </button>
    </p>
    <div id="statusfilter">
        <form id="frmStatusFilter">
            <div class="checkall">
                <label class="checkbox-inline"><input type="checkbox" id="statusfiltercheckall" checked="checked"/> <?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['global']['checkall'];?>
</label>
            </div>
            <table class="datatable" width="100%" border="0" cellspacing="1" cellpadding="3">
                <tr>
                    <th></th>
                </tr>
    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['itemstatuses']->value, 'statuslang', false, 'itemstatus');
$_smarty_tpl->tpl_vars['statuslang']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['itemstatus']->value => $_smarty_tpl->tpl_vars['statuslang']->value) {
$_smarty_tpl->tpl_vars['statuslang']->do_else = false;
?>
                <tr>
                    <td><label class="checkbox-inline" style="display:block;"><input type="checkbox" name="statusfilter[]" value="<?php echo $_smarty_tpl->tpl_vars['itemstatus']->value;?>
"<?php if (in_array($_smarty_tpl->tpl_vars['itemstatus']->value,$_smarty_tpl->tpl_vars['statusFilterChecked']->value)) {?> checked="checked"<?php }?> /> <?php echo $_smarty_tpl->tpl_vars['statuslang']->value;?>
</label></td>
                </tr>
    <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                <tr>
                    <th></th>
                </tr>
            </table>
            <div class="applybtn">
                <button type="button" class="btn btn-xs btn-small btn-primary" id="btnApplyFilter">
                    <?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['global']['apply'];?>

                </button>
            </div>
        </form>
    </div>

    <form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>
?userid=<?php echo $_smarty_tpl->tpl_vars['clientsdetails']->value['userid'];?>
&action=massaction">
        <?php if (in_array('List Services',$_smarty_tpl->tpl_vars['admin_perms']->value)) {?>
        <table width="100%" class="form">
            <tr><td colspan="2" class="fieldarea" style="text-align:center;"><strong><?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['services']['title'];?>
</strong></td></tr>
            <tr><td align="center">
                <table id="summaryServices"
                       class="table table-themed display data-driven filterable"
                       data-ajax-url="<?php echo routePath('admin-table-client-services',$_smarty_tpl->tpl_vars['clientsdetails']->value['userid']);?>
"
                       data-dom='<"listtable"t><"row"<"text-left col-sm-4"l><"#summaryServicesInfo.text-center col-sm-4"i><"text-right col-sm-4"p>>'
                       data-ordering="true"
                       data-info="true"
                       data-searching="true"
                       data-paging="true"
                       data-length-change="true"
                       data-auto-width="true"
                       data-order='[[7, "asc"], [1, "desc"]]'
                       data-defer-render="true"
                       data-defer-loading="[<?php echo $_smarty_tpl->tpl_vars['filteredServices']->value;?>
, <?php echo $_smarty_tpl->tpl_vars['totalServices']->value;?>
]"
                       data-server-side="true"
                       data-page-length="<?php echo $_smarty_tpl->tpl_vars['servicePageLength']->value;?>
"
                >
                    <thead>
                        <tr>
                            <th data-name="checkbox" data-class-name="text-center" data-searchable="false" data-orderable="false" data-width="20"><input type="checkbox" id="prodsall" /></th>
                            <th data-name="id"><?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['fields']['id'];?>
</th>
                            <th data-name="name"><?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['fields']['product'];?>
</th>
                            <th data-name="amount"><?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['fields']['amount'];?>
</th>
                            <th data-name="billingcycle"><?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['fields']['billingcycle'];?>
</th>
                            <th data-name="regdate"><?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['fields']['signupdate'];?>
</th>
                            <th data-name="nextduedate"><?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['fields']['nextduedate'];?>
</th>
                            <th data-name="domainstatus" data-class-name="status"><?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['fields']['status'];?>
</th>
                            <th data-name="actions" data-class-name="edit text-center" data-searchable="false" data-orderable="false" data-width="20"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['productsummary']->value, 'product', false, 'num');
$_smarty_tpl->tpl_vars['product']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['num']->value => $_smarty_tpl->tpl_vars['product']->value) {
$_smarty_tpl->tpl_vars['product']->do_else = false;
?>
                            <tr id="service<?php echo $_smarty_tpl->tpl_vars['product']->value['id'];?>
">
                                <td><input type="checkbox" name="selproducts[]" value="<?php echo $_smarty_tpl->tpl_vars['product']->value['id'];?>
" class="checkprods" /></td>
                                <td><a href="clientsservices.php?userid=<?php echo $_smarty_tpl->tpl_vars['clientsdetails']->value['userid'];?>
&id=<?php echo $_smarty_tpl->tpl_vars['product']->value['id'];?>
"><?php echo $_smarty_tpl->tpl_vars['product']->value['idshort'];?>
</a></td>
                                <td style="padding-left:5px;padding-right:5px"><?php echo $_smarty_tpl->tpl_vars['product']->value['dpackage'];?>
 - <a href="<?php echo $_smarty_tpl->tpl_vars['product']->value['domainLink'];?>
" target="_blank"><?php echo $_smarty_tpl->tpl_vars['product']->value['domain'];?>
</a></td>
                                <td><?php echo $_smarty_tpl->tpl_vars['product']->value['amount'];?>
</td>
                                <td><?php echo $_smarty_tpl->tpl_vars['product']->value['dbillingcycle'];?>
</td>
                                <td><?php echo $_smarty_tpl->tpl_vars['product']->value['regdate'];?>
</td>
                                <td><?php echo $_smarty_tpl->tpl_vars['product']->value['nextduedate'];?>
</td>
                                <td data-filter-value="<?php echo $_smarty_tpl->tpl_vars['product']->value['domainoriginalstatus'];?>
"><?php echo $_smarty_tpl->tpl_vars['product']->value['domainstatus'];?>
</td>
                                <td><a href="clientsservices.php?userid=<?php echo $_smarty_tpl->tpl_vars['clientsdetails']->value['userid'];?>
&id=<?php echo $_smarty_tpl->tpl_vars['product']->value['id'];?>
"><img src="images/edit.gif" width="16" height="16" border="0" alt="Edit"></a></td>
                            </tr>
                        <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                    </tbody>
                </table>
            </td></tr>
        </table>
        <?php }?>
        <?php if (in_array('List Addons',$_smarty_tpl->tpl_vars['admin_perms']->value)) {?>
        <table width="100%" class="form">
            <tr><td colspan="2" class="fieldarea" style="text-align:center;"><strong><?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['addons']['title'];?>
</strong></td></tr>
            <tr><td align="center">
                <table id="summaryAddons"
                       class="table table-themed display data-driven filterable"
                       data-ajax-url="<?php echo routePath('admin-table-client-addons',$_smarty_tpl->tpl_vars['clientsdetails']->value['userid']);?>
"
                       data-dom='<"listtable"t><"row"<"text-left col-sm-4"l><"#summaryAddonsInfo.text-center col-sm-4"i><"text-right col-sm-4"p>>'
                       data-ordering="true"
                       data-info="true"
                       data-searching="true"
                       data-paging="true"
                       data-length-change="true"
                       data-auto-width="true"
                       data-order='[[ 7, "asc" ], [ 1, "desc"]]'
                       data-defer-render="true"
                       data-defer-loading="[<?php echo $_smarty_tpl->tpl_vars['filteredAddons']->value;?>
, <?php echo $_smarty_tpl->tpl_vars['totalAddons']->value;?>
]"
                       data-server-side="true"
                       data-page-length="<?php echo $_smarty_tpl->tpl_vars['addonPageLength']->value;?>
"
                >
                    <thead>
                        <tr>
                            <th data-name="checkbox" data-class="text-center" data-orderable="false" data-width="20"><input type="checkbox" id="addonsall" /></th>
                            <th data-name="id"><?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['fields']['id'];?>
</th>
                            <th data-name="name"><?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['addons']['name'];?>
</th>
                            <th data-name="recurring"><?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['fields']['amount'];?>
</th>
                            <th data-name="billingcycle"><?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['fields']['billingcycle'];?>
</th>
                            <th data-name="regdate"><?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['fields']['signupdate'];?>
</th>
                            <th data-name="nextduedate"><?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['fields']['nextduedate'];?>
</th>
                            <th data-name="status" data-class-name="status"><?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['fields']['status'];?>
</th>
                            <th data-name="actions" data-class-name="edit text-center" data-orderable="false" data-width="20"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['addonsummary']->value, 'addon', false, 'num');
$_smarty_tpl->tpl_vars['addon']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['num']->value => $_smarty_tpl->tpl_vars['addon']->value) {
$_smarty_tpl->tpl_vars['addon']->do_else = false;
?>
                            <tr id="addon<?php echo $_smarty_tpl->tpl_vars['addon']->value['id'];?>
">
                                <td><input type="checkbox" name="seladdons[]" value="<?php echo $_smarty_tpl->tpl_vars['addon']->value['id'];?>
" class="checkaddons" /></td>
                                <td><a href="clientsservices.php?userid=<?php echo $_smarty_tpl->tpl_vars['clientsdetails']->value['userid'];?>
&id=<?php echo $_smarty_tpl->tpl_vars['addon']->value['serviceid'];?>
&aid=<?php echo $_smarty_tpl->tpl_vars['addon']->value['id'];?>
"><?php echo $_smarty_tpl->tpl_vars['addon']->value['idshort'];?>
</a></td>
                                <td style="padding-left:5px;padding-right:5px"><?php echo $_smarty_tpl->tpl_vars['addon']->value['addonname'];?>
<br><?php echo $_smarty_tpl->tpl_vars['addon']->value['dpackage'];?>
 - <a href="<?php echo $_smarty_tpl->tpl_vars['addon']->value['domainLink'];?>
" target="_blank"><?php echo $_smarty_tpl->tpl_vars['addon']->value['domain'];?>
</a></td>
                                <td><?php echo $_smarty_tpl->tpl_vars['addon']->value['amount'];?>
</td>
                                <td><?php echo $_smarty_tpl->tpl_vars['addon']->value['dbillingcycle'];?>
</td>
                                <td><?php echo $_smarty_tpl->tpl_vars['addon']->value['regdate'];?>
</td>
                                <td><?php echo $_smarty_tpl->tpl_vars['addon']->value['nextduedate'];?>
</td>
                                <td data-filter-value="<?php echo $_smarty_tpl->tpl_vars['addon']->value['originalstatus'];?>
"><?php echo $_smarty_tpl->tpl_vars['addon']->value['status'];?>
</td>
                                <td><a href="clientsservices.php?userid=<?php echo $_smarty_tpl->tpl_vars['clientsdetails']->value['userid'];?>
&id=<?php echo $_smarty_tpl->tpl_vars['addon']->value['serviceid'];?>
&aid=<?php echo $_smarty_tpl->tpl_vars['addon']->value['id'];?>
"><img src="images/edit.gif" width="16" height="16" border="0" alt="Edit"></a></td>
                            </tr>
                        <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                    </tbody>
                </table>
            </td></tr>
        </table>
        <?php }?>
        <?php if (in_array('List Domains',$_smarty_tpl->tpl_vars['admin_perms']->value)) {?>
        <table width="100%" class="form">
            <tr><td colspan="2" class="fieldarea" style="text-align:center;"><strong><?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['domains']['title'];?>
</strong></td></tr>
            <tr><td align="center">
                <table id="summaryDomains"
                       class="table table-themed display data-driven filterable"
                       data-ajax-url="<?php echo routePath('admin-table-client-domains',$_smarty_tpl->tpl_vars['clientsdetails']->value['userid']);?>
"
                       data-dom='<"listtable"t><"row"<"text-left col-sm-4"l><"#summaryDomainsInfo.text-center col-sm-4"i><"text-right col-sm-4"p>>'
                       data-ordering="true"
                       data-info="true"
                       data-searching="true"
                       data-paging="true"
                       data-length-change="true"
                       data-auto-width="true"
                       data-order='[[ 7, "asc" ], [ 1, "desc"]]'
                       data-defer-render="true"
                       data-defer-loading="[<?php echo $_smarty_tpl->tpl_vars['filteredDomains']->value;?>
, <?php echo $_smarty_tpl->tpl_vars['totalDomains']->value;?>
]"
                       data-server-side="true"
                       data-page-length="<?php echo $_smarty_tpl->tpl_vars['domainPageLength']->value;?>
"
                >
                    <thead>
                        <tr>
                            <th data-name="checkbox" data-class="text-center" data-orderable="false" data-width="20"><input type="checkbox" id="domainsall" /></th>
                            <th data-name="id"><?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['fields']['id'];?>
</th>
                            <th data-name="domain"><?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['fields']['domain'];?>
</th>
                            <th data-name="registrar"><?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['fields']['registrar'];?>
</th>
                            <th data-name="registrationdate"><?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['fields']['regdate'];?>
</th>
                            <th data-name="nextduedate"><?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['fields']['nextduedate'];?>
</th>
                            <th data-name="expirydate"><?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['fields']['expirydate'];?>
</th>
                            <th data-name="status" data-class-name="status"><?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['fields']['status'];?>
</th>
                            <th data-name="actions" data-class-name="edit text-center" data-orderable="false" data-width="20"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['domainsummary']->value, 'domain', false, 'num');
$_smarty_tpl->tpl_vars['domain']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['num']->value => $_smarty_tpl->tpl_vars['domain']->value) {
$_smarty_tpl->tpl_vars['domain']->do_else = false;
?>
                            <tr id="domain<?php echo $_smarty_tpl->tpl_vars['domain']->value['id'];?>
">
                                <td><input type="checkbox" name="seldomains[]" value="<?php echo $_smarty_tpl->tpl_vars['domain']->value['id'];?>
" class="checkdomains" /></td>
                                <td><a href="clientsdomains.php?userid=<?php echo $_smarty_tpl->tpl_vars['clientsdetails']->value['userid'];?>
&domainid=<?php echo $_smarty_tpl->tpl_vars['domain']->value['id'];?>
"><?php echo $_smarty_tpl->tpl_vars['domain']->value['idshort'];?>
</a></td>
                                <td style="padding-left:5px;padding-right:5px"><a href="http://<?php echo $_smarty_tpl->tpl_vars['domain']->value['domain'];?>
" target="_blank"><?php echo $_smarty_tpl->tpl_vars['domain']->value['domain'];?>
</a></td>
                                <td><?php echo $_smarty_tpl->tpl_vars['domain']->value['registrar'];?>
</td>
                                <td><?php echo $_smarty_tpl->tpl_vars['domain']->value['registrationdate'];?>
</td>
                                <td><?php echo $_smarty_tpl->tpl_vars['domain']->value['nextduedate'];?>
</td>
                                <td><?php echo $_smarty_tpl->tpl_vars['domain']->value['expirydate'];?>
</td>
                                <td class="status" data-filter-value="<?php echo $_smarty_tpl->tpl_vars['domain']->value['originalstatus'];?>
"><?php echo $_smarty_tpl->tpl_vars['domain']->value['status'];?>
</td>
                                <td><a href="clientsdomains.php?userid=<?php echo $_smarty_tpl->tpl_vars['clientsdetails']->value['userid'];?>
&domainid=<?php echo $_smarty_tpl->tpl_vars['domain']->value['id'];?>
"><img src="images/edit.gif" width="16" height="16" border="0" alt="Edit"></a></td>
                            </tr>
                        <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                    </tbody>
                </table>
            </td></tr>
        </table>
        <?php }?>
        <?php if (in_array('Manage Quotes',$_smarty_tpl->tpl_vars['admin_perms']->value)) {?>
        <table width="100%" class="form">
            <tr><td colspan="2" class="fieldarea" style="text-align:center;"><strong><?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['clientsummary']['currentquotes'];?>
</strong></td></tr>
            <tr><td align="center">
                <table id="summaryQuotes"
                       class="table table-themed display data-driven"
                       data-ajax-url="<?php echo routePath('admin-table-client-quotes',$_smarty_tpl->tpl_vars['clientsdetails']->value['userid']);?>
"
                       data-dom='<"listtable"t><"row"<"text-left col-sm-4"l><"#summaryQuotesInfo.text-center col-sm-4"i><"text-right col-sm-4"p>>'
                       data-ordering="true"
                       data-info="true"
                       data-paging="true"
                       data-length-change="true"
                       data-searching="false"
                       data-auto-width="true"
                       data-order='[[ 5, "asc" ], [ 0, "desc"]]'
                       data-defer-render="true"
                       data-defer-loading="<?php echo $_smarty_tpl->tpl_vars['totalQuotes']->value;?>
"
                       data-server-side="true"
                       data-page-length="<?php echo $_smarty_tpl->tpl_vars['quotePageLength']->value;?>
"
                    >
                        <thead>
                        <tr>
                            <th data-name="id"><?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['fields']['id'];?>
</th>
                            <th data-name="subject"><?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['fields']['subject'];?>
</th>
                            <th data-name="datecreated"><?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['fields']['date'];?>
</th>
                            <th data-name="total"><?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['fields']['total'];?>
</th>
                            <th data-name="validuntil"><?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['fields']['validuntil'];?>
</th>
                            <th data-name="stage"><?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['fields']['status'];?>
</th>
                            <th data-name="actions" data-class-name="edit text-center" data-orderable="false" data-width="20"></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['quotes']->value, 'quote', false, 'num');
$_smarty_tpl->tpl_vars['quote']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['num']->value => $_smarty_tpl->tpl_vars['quote']->value) {
$_smarty_tpl->tpl_vars['quote']->do_else = false;
?>
                            <tr id="quote<?php echo $_smarty_tpl->tpl_vars['quote']->value['id'];?>
">
                                <td><a href="quotes.php?action=manage&id=<?php echo $_smarty_tpl->tpl_vars['quote']->value['id'];?>
"><?php echo $_smarty_tpl->tpl_vars['quote']->value['id'];?>
</a></td>
                                <td style="padding-left:5px;padding-right:5px"><?php echo $_smarty_tpl->tpl_vars['quote']->value['subject'];?>
</td>
                                <td><?php echo $_smarty_tpl->tpl_vars['quote']->value['datecreated'];?>
</td>
                                <td><?php echo $_smarty_tpl->tpl_vars['quote']->value['total'];?>
</td>
                                <td><?php echo $_smarty_tpl->tpl_vars['quote']->value['validuntil'];?>
</td>
                                <td><?php echo $_smarty_tpl->tpl_vars['quote']->value['stage'];?>
</td>
                                <td><a href="quotes.php?action=manage&id=<?php echo $_smarty_tpl->tpl_vars['quote']->value['id'];?>
"><img src="images/edit.gif" width="16" height="16" border="0" alt="Edit"></a></td>
                            </tr>
                        <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                        </tbody>
            </table>
            </td></tr>
        </table>
        <?php }?>

        <div class="bulk-action-btns">
            <?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['global']['withselected'];?>
:
            <button type="submit" name="inv" value="1" class="button btn btn-sm btn-default">
                <i class="fas fa-sync"></i>
                <?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['clientsummary']['invoiceselected'];?>

            </button>
            <button type="submit" name="del" value="1" class="button btn btn-sm btn-danger">
                <i class="fas fa-trash-alt"></i>
                <?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['clientsummary']['deleteselected'];?>

            </button>
        </div>

        <div class="bulk-actions">

            <div class="row">
                <div class="col-sm-6 hidden-lg">
                    <span class="heading"><?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['global']['bulkActions'];?>
</span>
                </div>
                <div class="col-lg-3 col-lg-push-9 col-sm-6 text-right">
                    <button id="massUpdateItems" type="button" class="btn btn-link" onclick="$('#bulkUpdateAdvancedOptions').slideToggle()">
                        <?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['global']['showAdvancedOptions'];?>

                    </button>
                    <button type="submit" id="massupdate" name="massupdate" value="1" class="btn btn-default">
                        <?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['global']['apply'];?>

                    </button>
                </div>
                <div class="col-lg-9 col-lg-pull-3 col-xs-12 form-inline">
                    <span class="heading visible-lg-inline-block"><?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['global']['bulkActions'];?>
</span>
                    <select name="status" class="form-control select-inline">
                        <option value="">- <?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['support']['setStatus'];?>
 -</option>
                        <option value="Pending"><?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['status']['pending'];?>
</option>
                        <option value="Active"><?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['status']['active'];?>
</option>
                        <option value="Completed"><?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['status']['completed'];?>
</option>
                        <option value="Suspended"><?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['status']['suspended'];?>
</option>
                        <option value="Terminated"><?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['status']['terminated'];?>
</option>
                        <option value="Cancelled"><?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['status']['cancelled'];?>
</option>
                        <option value="Fraud"><?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['status']['fraud'];?>
</option>
                    </select>
                    <?php echo smarty_modifier_replace($_smarty_tpl->tpl_vars['paymentmethoddropdown']->value,$_smarty_tpl->tpl_vars['_ADMINLANG']->value['global']['nochange'],$_smarty_tpl->tpl_vars['_ADMINLANG']->value['clientsummary']['setPaymentMethod']);?>

                    <div class="form-group">
                        <div class="form-inline">
                            <div class="form-group">
                                <label class="checkbox-inline">
                                    <input type="checkbox" name="overideautosuspend" id="overridesuspend" />
                                    <?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['services']['nosuspenduntil'];?>

                                </label>
                            </div>
                            <div class="form-group">
                                <div class="form-group date-picker-prepend-icon">
                                    <label for="overridesuspend" class="field-icon">
                                        <i class="fal fa-calendar-alt"></i>
                                    </label>
                                    <input type="text" name="overidesuspenduntil" class="form-control date-picker-single future" data-drops="up" data-original-value="" value="" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div id="bulkUpdateAdvancedOptions" class="advanced-options">
                <table class="form" width="100%" border="0" cellspacing="2" cellpadding="3">
                    <tr>
                        <td width="15%" class="fieldlabel" nowrap>
                            <?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['fields']['firstpaymentamount'];?>

                        </td>
                        <td class="fieldarea" width="35%">
                            <input type="text" name="firstpaymentamount" class="form-control input-200" />
                        </td>
                        <td width="15%" class="fieldlabel" nowrap>
                            <?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['fields']['recurringamount'];?>

                        </td>
                        <td class="fieldarea">
                            <input type="text" name="recurringamount" class="form-control input-200" />
                        </td>
                    </tr>
                    <tr>
                        <td class="fieldlabel" width="15%">
                            <?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['fields']['nextduedate'];?>

                        </td>
                        <td class="fieldarea">
                            <div class="form-group date-picker-prepend-icon">
                                <label for="inputDateCreated" class="field-icon">
                                    <i class="fal fa-calendar-alt"></i>
                                </label>
                                <input type="text" id="nextDueDate" name="nextduedate" class="input-inline form-control date-picker-single future" data-drops="up" data-original-value="" value="" />
                                &nbsp;&nbsp; <input type="checkbox" name="proratabill" id="proratabill" /> <?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['clientsummary']['createproratainvoice'];?>

                            </div>
                        </td>
                        <td width="15%" class="fieldlabel">
                            <?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['fields']['billingcycle'];?>

                        </td>
                        <td class="fieldarea">
                            <select name="billingcycle" class="form-control input-200">
                                <option value="">- <?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['global']['nochange'];?>
 -</option>
                                <option value="Free Account"><?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['billingcycles']['free'];?>
</option>
                                <option value="One Time"><?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['billingcycles']['onetime'];?>
</option>
                                <option value="Monthly"><?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['billingcycles']['monthly'];?>
</option>
                                <option value="Quarterly"><?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['billingcycles']['quarterly'];?>
</option>
                                <option value="Semi-Annually"><?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['billingcycles']['semiannually'];?>
</option>
                                <option value="Annually"><?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['billingcycles']['annually'];?>
</option>
                                <option value="Biennially"><?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['billingcycles']['biennially'];?>
</option>
                                <option value="Triennially"><?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['billingcycles']['triennially'];?>
</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td class="fieldlabel" width="15%">
                            <?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['services']['modulecommands'];?>

                        </td>
                        <td class="fieldarea" colspan="3">
                            <input type="submit" name="masscreate" value="<?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['modulebuttons']['create'];?>
" class="button btn btn-default" />
                            <input type="submit" name="masssuspend" value="<?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['modulebuttons']['suspend'];?>
" class="button btn btn-default" />
                            <input type="submit" name="massunsuspend" value="<?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['modulebuttons']['unsuspend'];?>
" class="button btn btn-default" />
                            <input type="submit" name="massterminate" value="<?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['modulebuttons']['terminate'];?>
" class="button btn btn-default" />
                            <input type="submit" name="masschangepackage" value="<?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['modulebuttons']['changepackage'];?>
" class="button btn btn-default" />
                            <input type="submit" name="masschangepw" value="<?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['modulebuttons']['changepassword'];?>
" class="button btn btn-default" />
                        </td>
                    </tr>
                </table>
            </div>

        </div>

    </form>

</div>

<form method="post" action="<?php echo routePath('admin-client-login',$_smarty_tpl->tpl_vars['clientsdetails']->value['id']);?>
" id="frmLoginAsOwner"></form>

<?php echo '<script'; ?>
>
    $(document).ready(function() {
        $('.summary-login-as-owner').click(function(e) {
            e.preventDefault();
            var newWindow = jQuery(this).data('new-window');
            submitForm('frmLoginAsOwner', newWindow);
        });
    });
<?php echo '</script'; ?>
>
<?php }
}
