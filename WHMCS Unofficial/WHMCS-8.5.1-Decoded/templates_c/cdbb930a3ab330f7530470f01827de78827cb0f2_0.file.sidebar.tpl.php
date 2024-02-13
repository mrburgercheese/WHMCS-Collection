<?php
/* Smarty version 3.1.36, created on 2022-09-24 19:31:47
  from '/home/whmnodec/public_html/manage/admin/templates/blend/sidebar.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.36',
  'unifunc' => 'content_632f5b23533ec8_95023578',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'cdbb930a3ab330f7530470f01827de78827cb0f2' => 
    array (
      0 => '/home/whmnodec/public_html/manage/admin/templates/blend/sidebar.tpl',
      1 => 1655190152,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_632f5b23533ec8_95023578 (Smarty_Internal_Template $_smarty_tpl) {
if ($_smarty_tpl->tpl_vars['sidebar']->value == "home") {?>

<div class="sidebar-header">
    <i class="fas fa-star"></i>
    <?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['global']['shortcuts'];?>

</div>
<ul>
    <li><a href="clientsadd.php"><img src="images/icons/clientsadd.png" class="absmiddle" width="16" height="16" /> <?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['clients']['addnew'];?>
</a></li>
    <li><a href="ordersadd.php"><img src="images/icons/ordersadd.png" class="absmiddle" width="16" height="16" /> <?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['orders']['addnew'];?>
</a></li>
    <li><a href="quotes.php?action=manage"><img src="images/icons/quotes.png" class="absmiddle" width="16" height="16" /> <?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['quotes']['createnew'];?>
</a></li>
    <li><a href="todolist.php"><img src="images/icons/todolist.png" class="absmiddle" width="16" height="16" /> <?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['utilities']['todolistcreatenew'];?>
</a></li>
    <li><a href="supporttickets.php?action=open"><img src="images/icons/tickets.png" class="absmiddle" width="16" height="16" /> <?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['support']['opennewticket'];?>
</a></li>
    <li><a href="whois.php"><img src="images/icons/domains.png" class="absmiddle" width="16" height="16" /> <?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['utilities']['whois'];?>
</a></li>
    <li><a href="#" data-toggle="modal" data-target="#modalGenerateInvoices"><img src="images/icons/invoices.png" class="absmiddle" width="16" height="16" /> <?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['invoices']['geninvoices'];?>
</a></li>
    <li><a href="#" data-toggle="modal" data-target="#modalCreditCardCapture"><img src="images/icons/offlinecc.png" class="absmiddle" width="16" height="16" /> <?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['invoices']['attemptcccaptures'];?>
</a></li>
</ul>

<div class="sidebar-header">
    <i class="fas fa-home"></i>
    <?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['global']['systeminfo'];?>

</div>
<div class="content-padded small">
    <?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['license']['regto'];?>
: <?php echo $_smarty_tpl->tpl_vars['licenseinfo']->value['registeredname'];?>
<br /><?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['license']['type'];?>
: <?php echo $_smarty_tpl->tpl_vars['licenseinfo']->value['productname'];?>
<br /><?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['license']['expires'];?>
: <?php echo $_smarty_tpl->tpl_vars['licenseinfo']->value['expires'];?>
<br /><?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['global']['version'];?>
: <?php echo $_smarty_tpl->tpl_vars['licenseinfo']->value['currentversion'];
if ($_smarty_tpl->tpl_vars['licenseinfo']->value['updateavailable']) {?><br /><span class="textred"><b><?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['license']['updateavailable'];?>
</b></span><?php }?>
</div>

<?php } elseif ($_smarty_tpl->tpl_vars['sidebar']->value == "clients") {?>

<div class="sidebar-header">
    <i class="fas fa-users"></i>
    <?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['clients']['title'];?>

</div>
<ul class="menu">
    <li><a href="clients.php"><?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['clients']['viewsearch'];?>
</a></li>
    <li><a href="clientsadd.php"><?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['clients']['addnew'];?>
</a></li>
</ul>

<div class="sidebar-header">
    <i class="fas fa-cube"></i>
    <?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['services']['title'];?>

</div>
<ul class="menu">
    <li><a href="<?php echo routePath('admin-services-index');?>
"><?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['services']['listall'];?>
</a></li>
    <li><a href="<?php echo routePath('admin-services-shared');?>
">- <?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['services']['listhosting'];?>
</a></li>
    <li><a href="<?php echo routePath('admin-services-reseller');?>
">- <?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['services']['listreseller'];?>
</a></li>
    <li><a href="<?php echo routePath('admin-services-server');?>
">- <?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['services']['listservers'];?>
</a></li>
    <li><a href="<?php echo routePath('admin-services-other');?>
">- <?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['services']['listother'];?>
</a></li>
    <li><a href="<?php echo routePath('admin-addons-index');?>
"><?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['services']['listaddons'];?>
</a></li>
    <li><a href="<?php echo routePath('admin-domains-index');?>
"><?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['services']['listdomains'];?>
</a></li>
    <li><a href="cancelrequests.php"><?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['clients']['cancelrequests'];?>
</a></li>
</ul>

<div class="sidebar-header">
    <i class="fas fa-retweet"></i>
    <?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['affiliates']['title'];?>

</div>
<ul class="menu">
    <li><a href="affiliates.php"><?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['affiliates']['manage'];?>
</a></li>
</ul>

<?php } elseif ($_smarty_tpl->tpl_vars['sidebar']->value == "orders") {?>

<div class="sidebar-header">
    <i class="fas fa-shopping-cart"></i>
    <?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['orders']['title'];?>

</div>
<ul class="menu">
    <li><a href="orders.php"><?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['orders']['listall'];?>
</a></li>
    <li><a href="orders.php?status=Pending">- <?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['orders']['listpending'];?>
</a></li>
    <li><a href="orders.php?status=Active">- <?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['orders']['listactive'];?>
</a></li>
    <li><a href="orders.php?status=Fraud">- <?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['orders']['listfraud'];?>
</a></li>
    <li><a href="orders.php?status=Cancelled">- <?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['orders']['listcancelled'];?>
</a></li>
    <li><a href="ordersadd.php"><?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['orders']['addnew'];?>
</a></li>
</ul>

<?php } elseif ($_smarty_tpl->tpl_vars['sidebar']->value == "billing") {?>

<div class="sidebar-header">
    <i class="fas fa-money-bill-wave-alt"></i>
    <?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['billing']['title'];?>

</div>
<ul class="menu">
    <li><a href="transactions.php"><?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['billing']['transactionslist'];?>
</a></li>
    <li><a href="gatewaylog.php"><?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['billing']['gatewaylog'];?>
</a></li>
    <li><a href="offlineccprocessing.php"><?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['billing']['offlinecc'];?>
</a></li>
    <li><a href="<?php echo routePath('admin-billing-disputes-index');?>
"><?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['disputes']['title'];?>
</a></li>
</ul>

<div class="sidebar-header">
    <i class="fas fa-file-invoice"></i>
    <?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['invoices']['title'];?>

</div>
<ul class="menu">
    <li><a href="invoices.php"><?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['invoices']['listall'];?>
</a></li>
    <li><a href="invoices.php?status=Paid">- <?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['status']['paid'];?>
</a></li>
    <li><a href="invoices.php?status=Draft">- <?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['status']['draft'];?>
</a></li>
    <li><a href="invoices.php?status=Unpaid">- <?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['status']['unpaid'];?>
</a></li>
    <li><a href="invoices.php?status=Overdue">- <?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['status']['overdue'];?>
</a></li>
    <li><a href="invoices.php?status=Cancelled">- <?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['status']['cancelled'];?>
</a></li>
    <li><a href="invoices.php?status=Refunded">- <?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['status']['refunded'];?>
</a></li>
    <li><a href="invoices.php?status=Collections">- <?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['status']['collections'];?>
</a></li>
    <li><a href="invoices.php?status=Payment%20Pending">- <?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['status']['paymentpending'];?>
</a></li>
</ul>

<div class="sidebar-header">
    <i class="fas fa-user-clock"></i>
    <?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['billableitems']['title'];?>

</div>
<ul class="menu">
    <li><a href="billableitems.php"><?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['billableitems']['listall'];?>
</a></li>
    <li><a href="billableitems.php?status=Uninvoiced">- <?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['billableitems']['uninvoiced'];?>
</a></li>
    <li><a href="billableitems.php?status=Recurring">- <?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['billableitems']['recurring'];?>
</a></li>
    <li><a href="billableitems.php?action=manage"><?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['billableitems']['addnew'];?>
</a></li>
</ul>

<div class="sidebar-header">
    <i class="fas fa-file-signature"></i>
    <?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['quotes']['title'];?>

</div>
<ul class="menu">
    <li><a href="quotes.php"><?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['quotes']['listall'];?>
</a></li>
    <li><a href="quotes.php?validity=Valid">- <?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['status']['valid'];?>
</a></li>
    <li><a href="quotes.php?validity=Expired">- <?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['status']['expired'];?>
</a></li>
    <li><a href="quotes.php?action=manage"><?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['quotes']['createnew'];?>
</a></li>
</ul>

<?php } elseif ($_smarty_tpl->tpl_vars['sidebar']->value == "support") {?>

<?php if ($_smarty_tpl->tpl_vars['inticket']->value) {?>

<div class="sidebar-header">
    <i class="fas fa-comment-alt-check"></i>
    <?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['support']['ticketinfo'];?>

</div>
<div class="content-padded">
    <span class="sub-header"><?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['fields']['owner'];?>
</span>
    <div class="bottom-margin-5">
        <?php if ($_smarty_tpl->tpl_vars['userid']->value) {?>
            <a href="clientssummary.php?userid=<?php echo $_smarty_tpl->tpl_vars['userid']->value;?>
"<?php if ($_smarty_tpl->tpl_vars['clientgroupcolour']->value) {?> style="background-color:<?php echo $_smarty_tpl->tpl_vars['clientgroupcolour']->value;?>
"<?php }?> target="_blank">
                <?php echo $_smarty_tpl->tpl_vars['clientname']->value;?>

            </a>
            <?php if ($_smarty_tpl->tpl_vars['contactid']->value) {?>
                (<a href="clientscontacts.php?userid=<?php echo $_smarty_tpl->tpl_vars['userid']->value;?>
&contactid=<?php echo $_smarty_tpl->tpl_vars['contactid']->value;?>
"<?php if ($_smarty_tpl->tpl_vars['clientgroupcolour']->value) {?> style="background-color:<?php echo $_smarty_tpl->tpl_vars['clientgroupcolour']->value;?>
"<?php }?> target="_blank"><?php echo $_smarty_tpl->tpl_vars['contactname']->value;?>
</a>)
            <?php }?>
        <?php } else { ?>
            <a href="<?php echo $_smarty_tpl->tpl_vars['SCRIPT_NAME']->value;?>
?email=<?php echo urlencode($_smarty_tpl->tpl_vars['email']->value);?>
"><?php echo $_smarty_tpl->tpl_vars['name']->value;?>
</a><br />
            <div class="truncate" title="<?php echo $_smarty_tpl->tpl_vars['email']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['email']->value;?>
</div>
        <?php }?>
    </div>

    <span class="sub-header">
        <?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['fields']['requestor'];?>

    </span>
    <div class="bottom-margin-5">
        <?php echo $_smarty_tpl->tpl_vars['requestor']->value['name'];?>
<br>
        <span class="label requestor-type-<?php echo $_smarty_tpl->tpl_vars['requestor']->value['type_normalised'];?>
">
            <?php if ($_smarty_tpl->tpl_vars['requestor']->value['type_normalised'] == 'operator') {?>
                <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['lang'][0], array( array('key'=>'support.requestor.operator'),$_smarty_tpl ) );?>

            <?php } elseif ($_smarty_tpl->tpl_vars['requestor']->value['type_normalised'] == 'owner') {?>
                <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['lang'][0], array( array('key'=>'support.requestor.owner'),$_smarty_tpl ) );?>

            <?php } elseif ($_smarty_tpl->tpl_vars['requestor']->value['type_normalised'] == 'authorizeduser') {?>
                <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['lang'][0], array( array('key'=>'support.requestor.authorizeduser'),$_smarty_tpl ) );?>

            <?php } elseif ($_smarty_tpl->tpl_vars['requestor']->value['type_normalised'] == 'registereduser') {?>
                <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['lang'][0], array( array('key'=>'support.requestor.registereduser'),$_smarty_tpl ) );?>

            <?php } elseif ($_smarty_tpl->tpl_vars['requestor']->value['type_normalised'] == 'subaccount') {?>
                <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['lang'][0], array( array('key'=>'support.requestor.subaccount'),$_smarty_tpl ) );?>

            <?php } elseif ($_smarty_tpl->tpl_vars['requestor']->value['type_normalised'] == 'guest') {?>
                <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['lang'][0], array( array('key'=>'support.requestor.guest'),$_smarty_tpl ) );?>

            <?php }?>
        </span>
        <br>
        <div class="small truncate" title="<?php echo $_smarty_tpl->tpl_vars['requestor']->value['email'];?>
"><?php echo $_smarty_tpl->tpl_vars['requestor']->value['email'];?>
</div>
    </div>

    <span class="sub-header"><?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['support']['department'];?>
</span>
    <div class="bottom-margin-5">
        <input type="hidden" id="currentdeptid" value="<?php echo $_smarty_tpl->tpl_vars['deptid']->value;?>
" />
        <select id="deptid" data-update-type="deptid" class="form-control sidebar-ticket-ajax">
            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['departments']->value, 'department');
$_smarty_tpl->tpl_vars['department']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['department']->value) {
$_smarty_tpl->tpl_vars['department']->do_else = false;
?>
                <option value="<?php echo $_smarty_tpl->tpl_vars['department']->value['id'];?>
"<?php if ($_smarty_tpl->tpl_vars['department']->value['id'] == $_smarty_tpl->tpl_vars['deptid']->value) {?> selected<?php }?>><?php echo $_smarty_tpl->tpl_vars['department']->value['name'];?>
</option>
            <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
        </select>
    </div>
    <span class="sub-header">
        <?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['support']['assignedto'];?>

        <a href="#" onclick="$('#flagto').val(<?php echo $_smarty_tpl->tpl_vars['adminid']->value;?>
);$('#flagto').trigger('change');return false" class="pull-right"><?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['support']['me'];?>
</a>
    </span>
    <div class="bottom-margin-5">
        <input type="hidden" id="currentflagto" value="<?php echo $_smarty_tpl->tpl_vars['flag']->value;?>
" />
        <select id="flagto" data-update-type="flagto" class="form-control select-assignto sidebar-ticket-ajax">
            <option value="0"><?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['global']['none'];?>
</option>
            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['staff']->value, 'staffmember');
$_smarty_tpl->tpl_vars['staffmember']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['staffmember']->value) {
$_smarty_tpl->tpl_vars['staffmember']->do_else = false;
?>
                <option value="<?php echo $_smarty_tpl->tpl_vars['staffmember']->value['id'];?>
"<?php if ($_smarty_tpl->tpl_vars['staffmember']->value['id'] == $_smarty_tpl->tpl_vars['flag']->value) {?> selected<?php }?>><?php echo $_smarty_tpl->tpl_vars['staffmember']->value['name'];?>
</option>
            <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
        </select>
    </div>
    <span class="sub-header"><?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['support']['priority'];?>
</span>
    <div class="bottom-margin-5">
        <input type="hidden" id="currentpriority" value="<?php echo $_smarty_tpl->tpl_vars['priority']->value;?>
" />
        <select id="priority" data-update-type="priority" class="form-control sidebar-ticket-ajax">
            <option value="High"<?php if ($_smarty_tpl->tpl_vars['priority']->value == "High") {?> selected<?php }?>><?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['status']['high'];?>
</option>
            <option value="Medium"<?php if ($_smarty_tpl->tpl_vars['priority']->value == "Medium") {?> selected<?php }?>><?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['status']['medium'];?>
</option>
            <option value="Low"<?php if ($_smarty_tpl->tpl_vars['priority']->value == "Low") {?> selected<?php }?>><?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['status']['low'];?>
</option>
        </select>
    </div>
    <span class="sub-header"><?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['support']['staffparticipants'];?>
</span>
    <div class="bottom-margin-5">
        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['staffinvolved']->value, 'staffname');
$_smarty_tpl->tpl_vars['staffname']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['staffname']->value) {
$_smarty_tpl->tpl_vars['staffname']->do_else = false;
?>
            <?php echo $_smarty_tpl->tpl_vars['staffname']->value;?>
<br />
        <?php
}
if ($_smarty_tpl->tpl_vars['staffname']->do_else) {
?>
            No Replies Yet
        <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
    </div>
    <span class="sub-header"><?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['support']['tags'];?>
</span>
    <input id="ticketTags" value="<?php echo implode($_smarty_tpl->tpl_vars['tags']->value,',');?>
" class="selectize-tags" placeholder="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['lang'][0], array( array('key'=>'support.addTag'),$_smarty_tpl ) );?>
" />

    <div class="watch-ticket">
        <?php if ($_smarty_tpl->tpl_vars['watchingTicket']->value) {?>
            <button class="btn btn-danger btn-block btn-xs" id="watch-ticket" type="button" data-admin-full-name="<?php echo $_smarty_tpl->tpl_vars['adminFullName']->value;?>
" data-admin-id="<?php echo $_smarty_tpl->tpl_vars['adminid']->value;?>
" data-ticket-id="<?php echo $_smarty_tpl->tpl_vars['ticketid']->value;?>
" data-type="unwatch">
                <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['lang'][0], array( array('key'=>"support.unwatchTicket"),$_smarty_tpl ) );?>

            </button>
        <?php } else { ?>
            <button class="btn btn-info btn-block btn-xs" id="watch-ticket" type="button" data-admin-full-name="<?php echo $_smarty_tpl->tpl_vars['adminFullName']->value;?>
" data-admin-id="<?php echo $_smarty_tpl->tpl_vars['adminid']->value;?>
" data-ticket-id="<?php echo $_smarty_tpl->tpl_vars['ticketid']->value;?>
" data-type="watch">
                <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['lang'][0], array( array('key'=>"support.watchTicket"),$_smarty_tpl ) );?>

            </button>
        <?php }?>
    </div>
</div>

<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['sidebaroutput']->value, 'output');
$_smarty_tpl->tpl_vars['output']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['output']->value) {
$_smarty_tpl->tpl_vars['output']->do_else = false;
?>
    <div>
        <?php echo $_smarty_tpl->tpl_vars['output']->value;?>

    </div>
<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>

<div class="sidebar-header">
    <i class="fas fa-eye"></i>
    <?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['support']['ticketWatchers'];?>

</div>
<div class="content-padded small">
    <ol id="ticketWatchers">
        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['ticketWatchers']->value, 'ticketWatcher', false, 'k');
$_smarty_tpl->tpl_vars['ticketWatcher']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['k']->value => $_smarty_tpl->tpl_vars['ticketWatcher']->value) {
$_smarty_tpl->tpl_vars['ticketWatcher']->do_else = false;
?>
            <li id="ticket-watcher-<?php echo $_smarty_tpl->tpl_vars['k']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['ticketWatcher']->value;?>
</li>
        <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
        <li id="ticket-watcher-0"<?php if ($_smarty_tpl->tpl_vars['ticketWatchers']->value) {?> class="hidden"<?php }?>><?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['global']['none'];?>
</li>
    </ol>
</div>

<div class="sidebar-header">
    <i class="fad fa-copy"></i>
    <?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['support']['ccrecipients'];?>

</div>
<div class="content-padded small">
    <?php if (count($_smarty_tpl->tpl_vars['ticketCc']->value) > 0) {?>
        <ol>
            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['ticketCc']->value, 'cc', false, 'k');
$_smarty_tpl->tpl_vars['cc']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['k']->value => $_smarty_tpl->tpl_vars['cc']->value) {
$_smarty_tpl->tpl_vars['cc']->do_else = false;
?>
                <li><?php echo $_smarty_tpl->tpl_vars['cc']->value;?>
</li>
            <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
        </ol>
    <?php } else { ?>
        <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['lang'][0], array( array('key'=>"global.none"),$_smarty_tpl ) );?>

    <?php }?>
</div>

<?php } else { ?>

<div class="sidebar-header">
    <i class="fas fa-life-ring"></i>
    <?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['support']['title'];?>

</div>
<ul class="menu">
    <li><a href="supportannouncements.php"><?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['support']['announcements'];?>
</a></li>
    <li><a href="supportdownloads.php"><?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['support']['downloads'];?>
</a></li>
    <li><a href="supportkb.php"><?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['support']['knowledgebase'];?>
</a></li>
    <li><a href="supporttickets.php"><?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['support']['supporttickets'];?>
</a></li>
    <li><a href="supporttickets.php?action=open"><?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['support']['opennewticket'];?>
</a></li>
    <li><a href="supportticketpredefinedreplies.php"><?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['support']['predefreplies'];?>
</a></li>
</ul>

<?php }?>

<div class="sidebar-header">
    <i class="fas fa-search"></i>
    <?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['support']['filtertickets'];?>

</div>
<div class="content-padded">
<form method="post" action="supporttickets.php">
<span class="sub-header"><?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['fields']['status'];?>
</span>
<select name="view" class="form-control">
    <option value="any">- Any -</option>
    <option value=""<?php if ($_smarty_tpl->tpl_vars['ticketfilterdata']->value['view'] == '') {?> selected<?php }?>><?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['support']['awaitingreply'];?>
 (<?php echo $_smarty_tpl->tpl_vars['ticketsawaitingreply']->value;?>
)</option>
    <option value="flagged"<?php if ($_smarty_tpl->tpl_vars['ticketfilterdata']->value['view'] == "flagged") {?> selected<?php }?>><?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['support']['flagged'];?>
 (<?php echo $_smarty_tpl->tpl_vars['ticketsflagged']->value;?>
)</option>
    <option value="active"<?php if ($_smarty_tpl->tpl_vars['ticketfilterdata']->value['view'] == "active") {?> selected<?php }?>><?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['support']['allactive'];?>
 (<?php echo $_smarty_tpl->tpl_vars['ticketsallactive']->value;?>
)</option>
<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['ticketstatuses']->value, 'status');
$_smarty_tpl->tpl_vars['status']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['status']->value) {
$_smarty_tpl->tpl_vars['status']->do_else = false;
?>
    <option value="<?php echo $_smarty_tpl->tpl_vars['status']->value['title'];?>
"<?php if ($_smarty_tpl->tpl_vars['status']->value['title'] == $_smarty_tpl->tpl_vars['ticketfilterdata']->value['view']) {?> selected<?php }?>><?php echo $_smarty_tpl->tpl_vars['status']->value['title'];?>
 (<?php echo $_smarty_tpl->tpl_vars['status']->value['count'];?>
)</option>
<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
</select>
<span class="sub-header"><?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['support']['department'];?>
</span>
<select name="deptid" class="form-control">
    <option value="">- Any -</option>
<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['ticketdepts']->value, 'dept');
$_smarty_tpl->tpl_vars['dept']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['dept']->value) {
$_smarty_tpl->tpl_vars['dept']->do_else = false;
?>
    <option value="<?php echo $_smarty_tpl->tpl_vars['dept']->value['id'];?>
"<?php if ($_smarty_tpl->tpl_vars['dept']->value['id'] == $_smarty_tpl->tpl_vars['ticketfilterdata']->value['deptid']) {?> selected<?php }?>><?php echo $_smarty_tpl->tpl_vars['dept']->value['name'];?>
</option>
<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
</select>
<span class="sub-header"><?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['support']['subjectmessage'];?>
</span>
<input type="text" name="subject" value="<?php echo $_smarty_tpl->tpl_vars['ticketfilterdata']->value['subject'];?>
" class="form-control" />
<span class="sub-header"><?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['fields']['email'];?>
</span>
<input type="text" name="email" value="<?php echo $_smarty_tpl->tpl_vars['ticketfilterdata']->value['email'];?>
" class="form-control" />
<input type="submit" value="<?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['global']['filter'];?>
  &raquo;" class="btn btn-primary btn-block btn-sm top-margin-5" />
</form>
</div>

<?php if ($_smarty_tpl->tpl_vars['inticketlist']->value) {?>

<div class="sidebar-header">
    <i class="fas fa-tags"></i>
    <?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['support']['tagcloud'];?>

</div>
<div class="content-padded"><?php echo $_smarty_tpl->tpl_vars['tagcloud']->value;?>
</div>

<?php }?>

<?php if (!$_smarty_tpl->tpl_vars['inticket']->value) {?>

<div class="sidebar-header">
    <i class="fas fa-wifi"></i>
    <?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['networkissues']['title'];?>

</div>
<ul class="menu">
    <li><a href="networkissues.php">- <?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['networkissues']['open'];?>
</a></li>
    <li><a href="networkissues.php?view=scheduled">- <?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['networkissues']['scheduled'];?>
</a></li>
    <li><a href="networkissues.php?view=resolved">- <?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['networkissues']['resolved'];?>
</a></li>
    <li><a href="networkissues.php?action=manage"><?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['networkissues']['addnew'];?>
</a></li>
</ul>

<?php }?>

<?php } elseif ($_smarty_tpl->tpl_vars['sidebar']->value == "reports") {?>

<div class="sidebar-header">
    <i class="fas fa-chart-bar"></i>
    <?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['reports']['title'];?>

</div>
<ul class="menu">
    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['text_reports']->value, 'reporttitle', false, 'filename');
$_smarty_tpl->tpl_vars['reporttitle']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['filename']->value => $_smarty_tpl->tpl_vars['reporttitle']->value) {
$_smarty_tpl->tpl_vars['reporttitle']->do_else = false;
?>
        <?php if (!in_array($_smarty_tpl->tpl_vars['filename']->value,$_smarty_tpl->tpl_vars['denied_reports']->value)) {?>
            <li><a href="reports.php?report=<?php echo $_smarty_tpl->tpl_vars['filename']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['reporttitle']->value;?>
</a></li>
        <?php }?>
    <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
</ul>

<?php } elseif ($_smarty_tpl->tpl_vars['sidebar']->value == "utilities") {?>

<div class="sidebar-header">
    <i class="fas fa-cubes"></i>
    <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['lang'][0], array( array('key'=>'utilities.title'),$_smarty_tpl ) );?>

</div>
<ul class="menu">
    <?php if (in_array('Update WHMCS',$_smarty_tpl->tpl_vars['admin_perms']->value)) {?>
        <li><a href="update.php"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['lang'][0], array( array('key'=>'update.title'),$_smarty_tpl ) );?>
</a></li>
    <?php }?>
    <?php if (in_array('WHMCSConnect',$_smarty_tpl->tpl_vars['admin_perms']->value)) {?>
        <li><a href="whmcsconnect.php"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['lang'][0], array( array('key'=>'whmcsConnect.whmcsConnectName'),$_smarty_tpl ) );?>
</a></li>
    <?php }?>
    <?php if (in_array('Automation Status',$_smarty_tpl->tpl_vars['admin_perms']->value)) {?>
        <li><a href="automationstatus.php"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['lang'][0], array( array('key'=>'utilities.automationStatus'),$_smarty_tpl ) );?>
</a></li>
    <?php }?>
    <?php if (in_array('View Module Queue',$_smarty_tpl->tpl_vars['admin_perms']->value)) {?>
        <li><a href="modulequeue.php"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['lang'][0], array( array('key'=>'utilities.moduleQueue'),$_smarty_tpl ) );?>
</a></li>
    <?php }?>
    <?php if (in_array('Configure Domain Pricing',$_smarty_tpl->tpl_vars['admin_perms']->value)) {?>
        <li><a href="<?php echo routePath('admin-utilities-tools-tld-import-step-one');?>
"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['lang'][0], array( array('key'=>'utilities.tldImport'),$_smarty_tpl ) );?>
</a></li>
    <?php }?>
    <?php if (in_array('Mass Mail',$_smarty_tpl->tpl_vars['admin_perms']->value)) {?>
        <li>
            <a href="<?php echo routePath('admin-utilities-tools-email-campaigns');?>
">
                <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['lang'][0], array( array('key'=>'utilities.emailCampaigns.title'),$_smarty_tpl ) );?>

            </a>
        </li>
    <?php }?>
    <?php if (in_array('Email Marketer',$_smarty_tpl->tpl_vars['admin_perms']->value)) {?>
        <li><a href="utilitiesemailmarketer.php"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['lang'][0], array( array('key'=>'utilities.emailmarketer'),$_smarty_tpl ) );?>
</a></li>
    <?php }?>
    <?php if (in_array('Link Tracking',$_smarty_tpl->tpl_vars['admin_perms']->value)) {?>
        <li><a href="utilitieslinktracking.php"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['lang'][0], array( array('key'=>'utilities.linktracking'),$_smarty_tpl ) );?>
</a></li>
    <?php }?>
    <?php if (in_array('Calendar',$_smarty_tpl->tpl_vars['admin_perms']->value)) {?>
        <li><a href="calendar.php"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['lang'][0], array( array('key'=>'utilities.calendar'),$_smarty_tpl ) );?>
</a></li>
    <?php }?>
    <?php if (in_array('To-Do List',$_smarty_tpl->tpl_vars['admin_perms']->value)) {?>
        <li><a href="todolist.php"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['lang'][0], array( array('key'=>'utilities.todolist'),$_smarty_tpl ) );?>
</a></li>
    <?php }?>
    <?php if (in_array('WHOIS Lookups',$_smarty_tpl->tpl_vars['admin_perms']->value)) {?>
        <li><a href="whois.php"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['lang'][0], array( array('key'=>'utilities.whois'),$_smarty_tpl ) );?>
</a></li>
    <?php }?>
    <?php if (in_array('Domain Resolver Checker',$_smarty_tpl->tpl_vars['admin_perms']->value)) {?>
        <li><a href="utilitiesresolvercheck.php"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['lang'][0], array( array('key'=>'utilities.domainresolver'),$_smarty_tpl ) );?>
</a></li>
    <?php }?>
    <?php if (in_array('View Integration Code',$_smarty_tpl->tpl_vars['admin_perms']->value)) {?>
        <li><a href="systemintegrationcode.php"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['lang'][0], array( array('key'=>'utilities.integrationcode'),$_smarty_tpl ) );?>
</a></li>
    <?php }?>
    <?php if (in_array('Database Status',$_smarty_tpl->tpl_vars['admin_perms']->value)) {?>
        <li><a href="systemdatabase.php"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['lang'][0], array( array('key'=>'utilities.dbstatus'),$_smarty_tpl ) );?>
</a></li>
    <?php }?>
    <?php if (in_array('System Cleanup Operations',$_smarty_tpl->tpl_vars['admin_perms']->value)) {?>
        <li><a href="systemcleanup.php"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['lang'][0], array( array('key'=>'utilities.syscleanup'),$_smarty_tpl ) );?>
</a></li>
    <?php }?>
    <?php if (in_array('View PHP Info',$_smarty_tpl->tpl_vars['admin_perms']->value)) {?>
        <li><a href="systemphpinfo.php"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['lang'][0], array( array('key'=>'utilities.phpinfo'),$_smarty_tpl ) );?>
</a></li>
        <li><a href="<?php echo routePath('admin-utilities-system-phpcompat');?>
"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['lang'][0], array( array('key'=>'utilities.phpcompat'),$_smarty_tpl ) );?>
</a></li>
    <?php }?>
</ul>

<?php } elseif ($_smarty_tpl->tpl_vars['sidebar']->value == "logs") {?>
<div class="sidebar-header" style="word-wrap: break-word">
    <i class="fas fa-clock"></i>
    <?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['system']['currentTime'];?>

</div>
<div class="content-padded">
    <?php echo $_smarty_tpl->tpl_vars['dateTimeNowFormatted']->value;?>

</div>
<div class="sidebar-header">
    <i class="fas fa-file-alt"></i>
    <?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['utilities']['logs'];?>

</div>
<ul class="menu">
    <li><a href="systemactivitylog.php"><?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['utilities']['activitylog'];?>
</a></li>
    <li><a href="systemadminlog.php"><?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['utilities']['adminlog'];?>
</a></li>
    <li><a href="<?php echo routePath('admin-logs-module-log');?>
"><?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['utilities']['modulelog'];?>
</a></li>
    <li><a href="systememaillog.php"><?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['utilities']['emaillog'];?>
</a></li>
    <li><a href="<?php echo routePath('admin-logs-mail-import-log');?>
"><?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['utilities']['ticketmaillog'];?>
</a></li>
    <li><a href="systemwhoislog.php"><?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['utilities']['whoislog'];?>
</a></li>
</ul>

<?php } elseif ($_smarty_tpl->tpl_vars['sidebar']->value == "addonmodules") {?>

<?php echo $_smarty_tpl->tpl_vars['addon_module_sidebar']->value;?>


<div class="sidebar-header">
    <i class="fas fa-box-alt"></i>
    <?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['utilities']['addonmodules'];?>

</div>
<ul class="menu">
    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['addon_modules']->value, 'addontitle', false, 'filename');
$_smarty_tpl->tpl_vars['addontitle']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['filename']->value => $_smarty_tpl->tpl_vars['addontitle']->value) {
$_smarty_tpl->tpl_vars['addontitle']->do_else = false;
?>
    <li><a href="addonmodules.php?module=<?php echo $_smarty_tpl->tpl_vars['filename']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['addontitle']->value;?>
</a></li>
    <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
</ul>

<?php } elseif ($_smarty_tpl->tpl_vars['sidebar']->value == "config") {?>

<div class="sidebar-header">
    <i class="fas fa-wrench"></i>
    <?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['setup']['config'];?>

</div>
<ul class="menu">
    <li><a href="configgeneral.php"><?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['setup']['general'];?>
</a></li>
    <li><a href="<?php echo routePath('admin-apps-index');?>
"><?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['setup']['appsAndIntegrations'];?>
</a></li>
    <li><a href="<?php echo routePath('admin-setup-authn-view');?>
"><?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['setup']['signInIntegrations'];?>
</a></li>
    <li><a href="configauto.php"><?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['setup']['automation'];?>
</a></li>
    <li><a href="marketconnect.php"><?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['setup']['marketconnect'];?>
</a></li>
    <li><a href="<?php echo routePath('admin-setup-notifications-overview');?>
"><?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['setup']['notifications'];?>
</a></li>
    <li><a href="<?php echo routePath('admin-setup-storage-index');?>
"><?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['setup']['storage'];?>
</a></li>
    <li><a href="configapplinks.php"><?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['setup']['applicationLinks'];?>
</a></li>
    <li><a href="configopenid.php"><?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['setup']['openIdConnect'];?>
</a></li>
    <li><a href="configemailtemplates.php"><?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['setup']['emailtpls'];?>
</a></li>
    <li><a href="configaddonmods.php"><?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['setup']['addonmodules'];?>
</a></li>
    <li><a href="configclientgroups.php"><?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['setup']['clientgroups'];?>
</a></li>
    <li><a href="configcustomfields.php"><?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['setup']['customclientfields'];?>
</a></li>
    <li><a href="configfraud.php"><?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['setup']['fraud'];?>
</a></li>
</ul>

<div class="sidebar-header">
    <i class="fad fa-user-friends"></i>
    <?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['setup']['staff'];?>

</div>
<ul class="menu">
    <li><a href="configadmins.php"><?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['setup']['admins'];?>
</a></li>
    <li><a href="configadminroles.php"><?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['setup']['adminroles'];?>
</a></li>
    <li><a href="configtwofa.php"><?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['setup']['twofa'];?>
</a></li>
    <li><a href="configapicredentials.php"><?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['setup']['apicredentials'];?>
</a></li>
</ul>

<div class="sidebar-header">
    <i class="fad fa-coins"></i>
    <?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['setup']['payments'];?>

</div>
<ul class="menu">
    <li><a href="configcurrencies.php"><?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['setup']['currencies'];?>
</a></li>
    <li><a href="configgateways.php"><?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['setup']['gateways'];?>
</a></li>
    <li><a href="<?php echo routePath('admin-setup-payments-tax-index');?>
"><?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['setup']['tax'];?>
</a></li>
    <li><a href="configpromotions.php"><?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['setup']['promos'];?>
</a></li>
</ul>

<div class="sidebar-header">
    <i class="fad fa-cubes"></i>
    <?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['setup']['products'];?>

</div>
<ul class="menu">
    <li><a href="configproducts.php"><?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['setup']['products'];?>
</a></li>
    <li><a href="configproductoptions.php"><?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['setup']['configoptions'];?>
</a></li>
    <li><a href="configaddons.php"><?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['setup']['addons'];?>
</a></li>
    <li><a href="configbundles.php"><?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['setup']['bundles'];?>
</a></li>
    <li><a href="configdomains.php"><?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['setup']['domainpricing'];?>
</a></li>
    <li><a href="configregistrars.php"><?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['setup']['registrars'];?>
</a></li>
    <li><a href="configservers.php"><?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['setup']['servers'];?>
</a></li>
</ul>

<div class="sidebar-header">
    <i class="fad fa-life-ring"></i>
    <?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['support']['title'];?>

</div>
<ul class="menu">
    <li><a href="configticketdepartments.php"><?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['setup']['supportdepartments'];?>
</a></li>
    <li><a href="configticketstatuses.php"><?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['setup']['ticketstatuses'];?>
</a></li>
    <li><a href="configticketescalations.php"><?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['setup']['escalationrules'];?>
</a></li>
    <li><a href="configticketspamcontrol.php"><?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['setup']['spam'];?>
</a></li>
</ul>

<div class="sidebar-header">
    <i class="fad fa-cog"></i>
    <?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['setup']['other'];?>

</div>
<ul class="menu">
    <li><a href="configorderstatuses.php"><?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['setup']['orderstatuses'];?>
</a></li>
    <li><a href="configsecurityqs.php"><?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['setup']['securityqs'];?>
</a></li>
    <li><a href="configbannedips.php"><?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['setup']['bannedips'];?>
</a></li>
    <li><a href="configbannedemails.php"><?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['setup']['bannedemails'];?>
</a></li>
    <li><a href="configbackups.php"><?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['setup']['backups'];?>
</a></li>
</ul>

<?php }?>

<div class="sidebar-header">
    <i class="fas fa-binoculars"></i>
    <?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['global']['advancedsearch'];?>

</div>
<div class="content-padded">
    <form method="get" action="search.php">
        <select name="type" id="searchtype" onchange="populate(this)" class="form-control">
          <option value="clients">Clients </option>
          <option value="orders">Orders </option>
          <option value="services">Services </option>
          <option value="domains">Domains </option>
          <option value="invoices">Invoices </option>
          <option value="tickets">Tickets </option>
        </select>
        <select name="field" id="searchfield" class="form-control">
          <option>Client ID</option>
          <option selected="selected">Client Name</option>
          <option>Company Name</option>
          <option>Email Address</option>
          <option>Address 1</option>
          <option>Address 2</option>
          <option>City</option>
          <option>State</option>
          <option>Postcode</option>
          <option>Country</option>
          <option>Phone Number</option>
          <option>CC Last Four</option>
        </select>
        <div class="input-group">
            <input type="text" name="q" class="form-control" />
            <div class="input-group-btn">
                <input type="submit" value="<?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['global']['search'];?>
" class="btn btn-default" />
            </div>
        </div>
    </form>
</div>

<div class="sidebar-header">
    <i class="fas fa-users"></i>
    <?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['global']['staffonline'];?>

</div>
<div class="content-padded small">
    <?php echo $_smarty_tpl->tpl_vars['adminsonline']->value;?>

</div>

<a href="#" class="btn-min-sidebar" id="sidebarClose">
    &laquo; Minimise Sidebar
</a>
<?php }
}
