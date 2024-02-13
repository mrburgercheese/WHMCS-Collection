<?php
/* Smarty version 3.1.36, created on 2022-09-24 19:31:47
  from '/home/whmnodec/public_html/manage/admin/templates/blend/nav.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.36',
  'unifunc' => 'content_632f5b233f2c67_76435178',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'fa4eed5c6b30cebc6b618dea5472a779843ea863' => 
    array (
      0 => '/home/whmnodec/public_html/manage/admin/templates/blend/nav.tpl',
      1 => 1655190152,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_632f5b233f2c67_76435178 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'/home/whmnodec/public_html/manage/vendor/smarty/smarty/libs/plugins/modifier.replace.php','function'=>'smarty_modifier_replace',),));
?>
<a href="index.php" class="logo" title="<?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['home']['title'];?>
">
    <img src="templates/<?php echo $_smarty_tpl->tpl_vars['template']->value;?>
/images/logo.png">
</a>

<ul class="left-nav">
    <li class="bt visible-sidebar">
        <a href="#" class="nav-toggle" id="btnNavbarToggle" aria-label="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['lang'][0], array( array('key'=>'global.navigation'),$_smarty_tpl ) );?>
">
            <i aria-hidden="true" class="fas fa-bars always"></i>
        </a>
    </li>
</ul>

<div class="navbar-collapse">
    <ul>
        <?php if (in_array("Add New Client",$_smarty_tpl->tpl_vars['admin_perms']->value) || in_array("Add New Order",$_smarty_tpl->tpl_vars['admin_perms']->value) || in_array("Create Invoice",$_smarty_tpl->tpl_vars['admin_perms']->value) || in_array("Manage Quotes",$_smarty_tpl->tpl_vars['admin_perms']->value) || in_array("Open New Ticket",$_smarty_tpl->tpl_vars['admin_perms']->value)) {?>
            <li class="bt has-dropdown">
                <a href="#" onclick="return false;">
                    <i class="fas fa-plus always"></i>
                    <span class="visible-sidebar"><?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['addNew']['title'];?>
</span>
                </a>
                <ul class="slim">
                    <?php if (in_array("Add New Client",$_smarty_tpl->tpl_vars['admin_perms']->value)) {?>
                        <li><a href="clientsadd.php"><?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['addNew']['client'];?>
</a></li>
                    <?php }?>
                    <?php if (in_array("Add New Order",$_smarty_tpl->tpl_vars['admin_perms']->value)) {?>
                        <li><a href="ordersadd.php"><?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['addNew']['order'];?>
</a></li>
                    <?php }?>
                    <?php if (in_array("Create Invoice",$_smarty_tpl->tpl_vars['admin_perms']->value)) {?>
                        <li>
                            <a href="<?php echo routePath('admin-billing-invoice-new');?>
" class="open-modal" data-modal-title="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['lang'][0], array( array('key'=>'addNew.invoice'),$_smarty_tpl ) );?>
" <?php if ($_smarty_tpl->tpl_vars['anyGatewaysActivated']->value) {?>data-btn-submit-id="btnCreateInvoice" data-btn-submit-label="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['lang'][0], array( array('key'=>'invoices.create'),$_smarty_tpl ) );?>
"<?php }?>>
                                <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['lang'][0], array( array('key'=>'addNew.invoice'),$_smarty_tpl ) );?>

                            </a>
                        </li>
                    <?php }?>
                    <?php if (in_array("Manage Quotes",$_smarty_tpl->tpl_vars['admin_perms']->value)) {?>
                        <li><a href="quotes.php?action=manage"><?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['addNew']['quote'];?>
</a></li>
                    <?php }?>
                    <?php if (in_array("Open New Ticket",$_smarty_tpl->tpl_vars['admin_perms']->value)) {?>
                        <li><a href="supporttickets.php?action=open"><?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['addNew']['ticket'];?>
</a></li>
                    <?php }?>
                </ul>
            </li>
        <?php }?>
        <li class="has-dropdown">
            <a id="Menu-Clients" href="#" onclick="return false;">
                <i class="fas fa-user"></i>
                <?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['clients']['title'];?>

                <span class="caret"></span>
            </a>
            <ul>
                <?php if (in_array("List Clients",$_smarty_tpl->tpl_vars['admin_perms']->value)) {?>
                    <li>
                        <a id="Menu-Clients-View_Search_Clients" href="clients.php">
                            <?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['clients']['viewsearch'];?>

                        </a>
                    </li>
                <?php }?>
                <?php if (in_array("List Users",$_smarty_tpl->tpl_vars['admin_perms']->value)) {?>
                    <li>
                        <a id="Menu-Clients-View_Search_Users" href="<?php echo routePath('admin-user-list');?>
">
                            <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['lang'][0], array( array('key'=>'user.manageUsers'),$_smarty_tpl ) );?>

                        </a>
                    </li>
                <?php }?>
                <?php if (in_array("Add New Client",$_smarty_tpl->tpl_vars['admin_perms']->value)) {?>
                    <li>
                        <a id="Menu-Clients-Add_New_Client" href="clientsadd.php">
                            <?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['clients']['addnew'];?>

                        </a>
                    </li>
                <?php }?>
                <?php if (in_array("List Services",$_smarty_tpl->tpl_vars['admin_perms']->value)) {?>
                    <li class="has-dropdown sub-menu expand">
                        <a id="Menu-Clients-Products_Services" href="<?php echo routePath('admin-services-index');?>
">
                            <?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['services']['title'];?>

                        </a>
                        <ul>
                            <li>
                                <a id="Menu-Clients-Products_Services-Shared_Hosting" href="<?php echo routePath('admin-services-shared');?>
">
                                    -
                                    <?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['services']['listhosting'];?>

                                </a>
                            </li>
                            <li>
                                <a id="Menu-Clients-Products_Services-Reseller_Accounts" href="<?php echo routePath('admin-services-reseller');?>
">
                                    -
                                    <?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['services']['listreseller'];?>

                                </a>
                            </li>
                            <li>
                                <a id="Menu-Clients-Products_Services-VPS_Servers" href="<?php echo routePath('admin-services-server');?>
">
                                    -
                                    <?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['services']['listservers'];?>

                                </a>
                            </li>
                            <li>
                                <a id="Menu-Clients-Products_Services-Other_Services" href="<?php echo routePath('admin-services-other');?>
">
                                    -
                                    <?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['services']['listother'];?>

                                </a>
                            </li>
                        </ul>
                    </li>
                <?php }?>
                <?php if (in_array("List Addons",$_smarty_tpl->tpl_vars['admin_perms']->value)) {?>
                    <li><a id="Menu-Clients-Service_Addons" href="<?php echo routePath('admin-addons-index');?>
">
                        <?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['services']['listaddons'];?>
</a>
                    </li>
                <?php }?>
                <?php if (in_array("List Domains",$_smarty_tpl->tpl_vars['admin_perms']->value)) {?>
                    <li>
                        <a id="Menu-Clients-Domain_Registration" href="<?php echo routePath('admin-domains-index');?>
">
                            <?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['services']['listdomains'];?>

                        </a>
                    </li>
                <?php }?>
                <?php if (in_array("View Cancellation Requests",$_smarty_tpl->tpl_vars['admin_perms']->value)) {?>
                    <li>
                        <a id="Menu-Clients-Cancelation_Requests" href="cancelrequests.php">
                            <?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['clients']['cancelrequests'];?>

                        </a>
                    </li>
                <?php }?>
                <?php if (in_array("Manage Affiliates",$_smarty_tpl->tpl_vars['admin_perms']->value)) {?>
                    <li>
                        <a id="Menu-Clients-Manage_Affiliates" href="affiliates.php">
                            <?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['affiliates']['manage'];?>

                        </a>
                    </li>
                <?php }?>
            </ul>
        </li>
        <li class="has-dropdown">
            <a id="Menu-Orders" href="#" onclick="return false;">
                <i class="fas fa-shopping-cart"></i>
                <?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['orders']['title'];?>

                <span class="caret"></span>
            </a>
            <ul>
                <?php if (in_array("View Orders",$_smarty_tpl->tpl_vars['admin_perms']->value)) {?>
                    <li>
                        <a id="Menu-Orders-List_All_Orders" href="orders.php">
                            <?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['orders']['listall'];?>

                        </a>
                    </li>
                    <li>
                        <a id="Menu-Orders-Pending_Orders" href="orders.php?status=Pending">
                            -
                            <?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['orders']['listpending'];?>

                        </a>
                    </li>
                    <li>
                        <a id="Menu-Orders-Active_Orders" href="orders.php?status=Active">
                            -
                            <?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['orders']['listactive'];?>

                        </a>
                    </li>
                    <li>
                        <a id="Menu-Orders-Fraud_Orders" href="orders.php?status=Fraud">
                            -
                            <?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['orders']['listfraud'];?>

                        </a>
                    </li>
                    <li>
                        <a id="Menu-Orders-Cancelled_Orders" href="orders.php?status=Cancelled">
                            -
                            <?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['orders']['listcancelled'];?>

                        </a>
                    </li>
                <?php }?>
                <?php if (in_array("Add New Order",$_smarty_tpl->tpl_vars['admin_perms']->value)) {?>
                    <li>
                        <a id="Menu-Orders-Add_New_Order" href="ordersadd.php">
                            <?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['orders']['addnew'];?>

                        </a>
                    </li>
                <?php }?>
            </ul>
        </li>
        <li class="has-dropdown">
            <a id="Menu-Billing" href="#" onclick="return false;">
                <i class="fas fa-credit-card"></i>
                <?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['billing']['title'];?>

                <span class="caret"></span>
            </a>
            <ul>
                <?php if (in_array("List Transactions",$_smarty_tpl->tpl_vars['admin_perms']->value)) {?>
                    <li>
                        <a id="Menu-Billing-Transactions_List" href="transactions.php">
                            <?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['billing']['transactionslist'];?>

                        </a>
                    </li>
                <?php }?>
                <?php if (in_array("List Invoices",$_smarty_tpl->tpl_vars['admin_perms']->value)) {?>
                    <li class="has-dropdown expand">
                        <a id="Menu-Billing-Invoices" href="invoices.php">
                            <?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['invoices']['title'];?>

                        </a>
                        <ul>
                            <li><a id="Menu-Billing-Invoices-Paid" href="invoices.php?status=Paid">- <?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['status']['paid'];?>
</a></li>
                            <li><a id="Menu-Billing-Invoices-Draft" href="invoices.php?status=Draft">- <?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['status']['draft'];?>
</a></li>
                            <li><a id="Menu-Billing-Invoices-Unpaid" href="invoices.php?status=Unpaid">- <?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['status']['unpaid'];?>
</a></li>
                            <li><a id="Menu-Billing-Invoices-Overdue" href="invoices.php?status=Overdue">- <?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['status']['overdue'];?>
</a></li>
                            <li><a id="Menu-Billing-Invoices-Cancelled" href="invoices.php?status=Cancelled">- <?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['status']['cancelled'];?>
</a></li>
                            <li><a id="Menu-Billing-Invoices-Refunded" href="invoices.php?status=Refunded">- <?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['status']['refunded'];?>
</a></li>
                            <li><a id="Menu-Billing-Invoices-Collections" href="invoices.php?status=Collections">- <?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['status']['collections'];?>
</a></li>
                            <li><a id="Menu-Billing-Invoices-Payment_Pending" href="invoices.php?status=Payment%20Pending">- <?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['status']['paymentpending'];?>
</a></li>
                        </ul>
                    </li>
                <?php }?>
                <?php if (in_array("View Billable Items",$_smarty_tpl->tpl_vars['admin_perms']->value)) {?>
                    <li class="has-dropdown expand">
                        <a id="Menu-Billing-Billable_Items" href="billableitems.php">
                            <?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['billableitems']['title'];?>

                        </a>
                        <ul>
                            <li><a id="Menu-Billing-Billable_Items-Uninvoiced_Items" href="billableitems.php?status=Uninvoiced">- <?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['billableitems']['uninvoiced'];?>
</a></li>
                            <li><a id="Menu-Billing-Billable_Items-Recurring_Items" href="billableitems.php?status=Recurring">- <?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['billableitems']['recurring'];?>
</a></li>
                            <?php if (in_array("Manage Billable Items",$_smarty_tpl->tpl_vars['admin_perms']->value)) {?><li><a id="Menu-Billing-Billable_Items-Add_New" href="billableitems.php?action=manage">- <?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['billableitems']['addnew'];?>
</a></li><?php }?>
                        </ul>
                    </li>
                <?php }?>
                <?php if (in_array("Manage Quotes",$_smarty_tpl->tpl_vars['admin_perms']->value)) {?>
                    <li class="expand">
                        <a id="Menu-Billing-Quotes" href="quotes.php">
                            <?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['quotes']['title'];?>

                        </a>
                        <ul>
                            <li><a id="Menu-Billing-Quotes-Valid" href="quotes.php?validity=Valid">- <?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['status']['valid'];?>
</a></li>
                            <li><a id="Menu-Billing-Quotes-Expired" href="quotes.php?validity=Expired">- <?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['status']['expired'];?>
</a></li>
                            <li><a id="Menu-Billing-Quotes-Create_New_Quote" href="quotes.php?action=manage">- <?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['quotes']['createnew'];?>
</a></li>
                        </ul>
                    </li>
                <?php }?>
                <?php if (in_array("Offline Credit Card Processing",$_smarty_tpl->tpl_vars['admin_perms']->value)) {?>
                    <li><a id="Menu-Billing-Offline_CC_Processing" href="offlineccprocessing.php"><?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['billing']['offlinecc'];?>
</a></li>
                <?php }?>

                <?php if (in_array("List Disputes",$_smarty_tpl->tpl_vars['admin_perms']->value)) {?>
                    <li><a id="Menu-Billing-Disputes" href="<?php echo routePath('admin-billing-disputes-index');?>
"><?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['disputes']['title'];?>
</a></li>
                <?php }?>
                <?php if (in_array("View Gateway Log",$_smarty_tpl->tpl_vars['admin_perms']->value)) {?>
                    <li><a id="Menu-Billing-Gateway_Log" href="gatewaylog.php"><?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['billing']['gatewaylog'];?>
</a></li>
                <?php }?>
            </ul>
        </li>
        <li class="has-dropdown">
            <a id="Menu-Support" href="#" onclick="return false;">
                <i class="fas fa-life-ring"></i>
                <?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['support']['title'];?>

                <span class="caret"></span>
            </a>
            <ul>
                <?php if (in_array("Support Center Overview",$_smarty_tpl->tpl_vars['admin_perms']->value)) {?>
                    <li><a id="Menu-Support-Support_Overview" href="supportcenter.php"><?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['support']['supportoverview'];?>
</a></li>
                <?php }?>
                <?php if (in_array("List Support Tickets",$_smarty_tpl->tpl_vars['admin_perms']->value)) {?>
                    <li class="has-dropdown expand">
                        <a id="Menu-Support-Support_Tickets" href="supporttickets.php">
                            <?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['support']['supporttickets'];?>

                        </a>
                        <ul>
                            <li><a id="Menu-Support-Support_Tickets-Flagged_Tickets" href="supporttickets.php?view=flagged">- <?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['support']['flagged'];?>
</a></li>
                            <li><a id="Menu-Support-Support_Tickets-All_Active_Tickets" href="supporttickets.php?view=active">- <?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['support']['allactive'];?>
</a></li>
                            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['menuticketstatuses']->value, 'status');
$_smarty_tpl->tpl_vars['status']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['status']->value) {
$_smarty_tpl->tpl_vars['status']->do_else = false;
?>
                                <li><a id="Menu-Support-Support_Tickets-<?php echo smarty_modifier_replace($_smarty_tpl->tpl_vars['status']->value,' ','_');?>
" href="supporttickets.php?view=<?php echo $_smarty_tpl->tpl_vars['status']->value;?>
">- <?php echo $_smarty_tpl->tpl_vars['status']->value;?>
</a></li>
                            <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                        </ul>
                    </li>
                <?php }?>
                <?php if (in_array("Open New Ticket",$_smarty_tpl->tpl_vars['admin_perms']->value)) {?>
                    <li><a id="Menu-Support-Open_New_Ticket" href="supporttickets.php?action=open"><?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['support']['opennewticket'];?>
</a></li>
                <?php }?>
                <?php if (in_array("Manage Predefined Replies",$_smarty_tpl->tpl_vars['admin_perms']->value)) {?>
                    <li><a id="Menu-Support-Predefined_Replies" href="supportticketpredefinedreplies.php"><?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['support']['predefreplies'];?>
</a></li>
                <?php }?>
                <?php if (in_array("Manage Announcements",$_smarty_tpl->tpl_vars['admin_perms']->value)) {?>
                    <li><a id="Menu-Support-Announcements" href="supportannouncements.php"><?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['support']['announcements'];?>
</a></li>
                <?php }?>
                <?php if (in_array("Manage Downloads",$_smarty_tpl->tpl_vars['admin_perms']->value)) {?>
                    <li><a id="Menu-Support-Downloads" href="supportdownloads.php"><?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['support']['downloads'];?>
</a></li>
                <?php }?>
                <?php if (in_array("Manage Knowledgebase",$_smarty_tpl->tpl_vars['admin_perms']->value)) {?>
                    <li><a id="Menu-Support-Knowledgebase" href="supportkb.php"><?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['support']['knowledgebase'];?>
</a></li>
                <?php }?>
                <?php if (in_array("Manage Network Issues",$_smarty_tpl->tpl_vars['admin_perms']->value)) {?>
                    <li class="has-dropdown expand">
                        <a id="Menu-Support-Network_Issues" href="networkissues.php">
                            <?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['networkissues']['title'];?>

                        </a>
                        <ul>
                            <li><a id="Menu-Support-Network_Issues-Open" href="networkissues.php">- <?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['networkissues']['open'];?>
</a></li>
                            <li><a id="Menu-Support-Network_Issues-Scheduled" href="networkissues.php?view=scheduled">- <?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['networkissues']['scheduled'];?>
</a></li>
                            <li><a id="Menu-Support-Network_Issues-Resolved" href="networkissues.php?view=resolved">- <?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['networkissues']['resolved'];?>
</a></li>
                            <li><a id="Menu-Support-Network_Issues-Create_New" href="networkissues.php?action=manage">- <?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['networkissues']['addnew'];?>
</a></li>
                        </ul>
                    </li>
                <?php }?>
            </ul>
        </li>
        <?php if (in_array("View Reports",$_smarty_tpl->tpl_vars['admin_perms']->value)) {?>
            <li class="has-dropdown">
                <a id="Menu-Reports" href="#" onclick="return false;">
                    <i class="fas fa-chart-bar"></i>
                    <?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['reports']['title'];?>

                    <span class="caret"></span>
                </a>
                <ul>
                    <li><a id="Menu-Reports-Home" href="reports.php"><?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['reports']['title'];?>
</a></li>
                    <li><a id="Menu-Reports-Daily_Performance" href="reports.php?report=daily_performance">Daily Performance</a></li>
                    <li><a id="Menu-Reports-Income_Forecast" href="reports.php?report=income_forecast">Income Forecast</a></li>
                    <li><a id="Menu-Reports-Annual_Income_Report" href="reports.php?report=annual_income_report">Annual Income Report</a></li>
                    <li><a id="Menu-Reports-New_Customers" href="reports.php?report=new_customers">New Customers</a></li>
                    <li><a id="Menu-Reports-Ticket_Feedback_Scores" href="reports.php?report=ticket_feedback_scores">Ticket Feedback Scores</a></li>
                    <li><a id="Menu-Reports-Batch_Invoice_PDF_Export" href="reports.php?report=pdf_batch">Batch Invoice PDF Export</a></li>
                    <li><a id="Menu-Reports-More..." href="reports.php">More...</a></li>
                </ul>
            </li>
        <?php }?>
        <li class="has-dropdown">
            <a id="Menu-Utilities" href="#" onclick="return false;">
                <i class="fas fa-file-alt"></i>
                <?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['utilities']['title'];?>

                <span class="caret"></span>
            </a>
            <ul>
                <?php if (in_array("Update WHMCS",$_smarty_tpl->tpl_vars['admin_perms']->value)) {?>
                    <li><a id="Menu-Utilities-Update" href="update.php"><?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['update']['title'];?>
</a></li>
                <?php }?>
                <?php if (in_array("WHMCSConnect",$_smarty_tpl->tpl_vars['admin_perms']->value)) {?>
                    <li><a id="Menu-Utilities-WHMCS_Connect" href="whmcsconnect.php"><?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['whmcsConnect']['whmcsConnectName'];?>
</a></li>
                <?php }?>
                <?php if (in_array("Automation Status",$_smarty_tpl->tpl_vars['admin_perms']->value)) {?>
                    <li><a id="Menu-Utilities-System-Automation_Status" href="automationstatus.php"><?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['utilities']['automationStatus'];?>
</a></li>
                <?php }?>
                <?php if (in_array("View Module Queue",$_smarty_tpl->tpl_vars['admin_perms']->value)) {?>
                    <li><a id="Menu-Utilities-Module_Queue" href="modulequeue.php"><?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['utilities']['moduleQueue'];?>
</a></li>
                <?php }?>
                <?php if (in_array("Configure Domain Pricing",$_smarty_tpl->tpl_vars['admin_perms']->value)) {?>
                    <li><a id="Menu-Utilities-Tld_Sync" href="<?php echo routePath('admin-utilities-tools-tld-import-step-one');?>
"><?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['utilities']['tldImport'];?>
</a></li>
                <?php }?>
                <?php if (in_array("Mass Mail",$_smarty_tpl->tpl_vars['admin_perms']->value)) {?>
                    <li><a id="Menu-Utilities-Email_Campaigns" href="<?php echo routePath('admin-utilities-tools-email-campaigns');?>
"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['lang'][0], array( array('key'=>'utilities.emailCampaigns.title'),$_smarty_tpl ) );?>
</a></li>
                <?php }?>
                <?php if (in_array("Email Marketer",$_smarty_tpl->tpl_vars['admin_perms']->value)) {?>
                    <li><a id="Menu-Utilities-Email_Marketer" href="utilitiesemailmarketer.php"><?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['utilities']['emailmarketer'];?>
</a></li>
                <?php }?>
                <?php if (in_array("Link Tracking",$_smarty_tpl->tpl_vars['admin_perms']->value)) {?>
                    <li><a id="Menu-Utilities-Link_Tracking" href="utilitieslinktracking.php"><?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['utilities']['linktracking'];?>
</a></li>
                <?php }?>
                <?php if (in_array("Calendar",$_smarty_tpl->tpl_vars['admin_perms']->value)) {?>
                    <li><a id="Menu-Utilities-Calendar" href="calendar.php"><?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['utilities']['calendar'];?>
</a></li>
                <?php }?>
                <?php if (in_array("To-Do List",$_smarty_tpl->tpl_vars['admin_perms']->value)) {?>
                    <li><a id="Menu-Utilities-To-Do_List" href="todolist.php"><?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['utilities']['todolist'];?>
</a></li>
                <?php }?>
                <?php if (in_array("WHOIS Lookups",$_smarty_tpl->tpl_vars['admin_perms']->value)) {?>
                    <li><a id="Menu-Utilities-WHOIS_Lookups" href="whois.php"><?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['utilities']['whois'];?>
</a></li>
                <?php }?>
                <?php if (in_array("Domain Resolver Checker",$_smarty_tpl->tpl_vars['admin_perms']->value)) {?>
                    <li><a id="Menu-Utilities-Domain_Resolver" href="utilitiesresolvercheck.php"><?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['utilities']['domainresolver'];?>
</a></li>
                <?php }?>
                <?php if (in_array("View Integration Code",$_smarty_tpl->tpl_vars['admin_perms']->value)) {?>
                    <li><a id="Menu-Utilities-Integration_Code" href="systemintegrationcode.php"><?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['utilities']['integrationcode'];?>
</a></li>
                <?php }?>
                <?php if (in_array("Automation Status",$_smarty_tpl->tpl_vars['admin_perms']->value) || in_array("Database Status",$_smarty_tpl->tpl_vars['admin_perms']->value) || in_array("System Cleanup Operations",$_smarty_tpl->tpl_vars['admin_perms']->value) || in_array("View PHP Info",$_smarty_tpl->tpl_vars['admin_perms']->value)) {?>
                    <li class="has-dropdown expand">
                        <a id="Menu-Utilities-System" href="#">
                            <?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['utilities']['system'];?>

                        </a>
                        <ul>
                            <?php if (in_array("Database Status",$_smarty_tpl->tpl_vars['admin_perms']->value)) {?><li><a id="Menu-Utilities-System-Database_Status" href="systemdatabase.php"><?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['utilities']['dbstatus'];?>
</a></li><?php }?>
                            <?php if (in_array("System Cleanup Operations",$_smarty_tpl->tpl_vars['admin_perms']->value)) {?><li><a id="Menu-Utilities-System-System_Cleanup" href="systemcleanup.php"><?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['utilities']['syscleanup'];?>
</a></li><?php }?>
                            <?php if (in_array("View PHP Info",$_smarty_tpl->tpl_vars['admin_perms']->value)) {?><li><a id="Menu-Utilities-System-PHP_Info" href="systemphpinfo.php"><?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['utilities']['phpinfo'];?>
</a></li><?php }?>
                            <?php if (in_array("View PHP Info",$_smarty_tpl->tpl_vars['admin_perms']->value)) {?><li><a id="Menu-Utilities-System-PhpCompat" href="<?php echo routePath('admin-utilities-system-phpcompat');?>
"><?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['utilities']['phpcompat'];?>
</a></li><?php }?>
                        </ul>
                    </li>
                <?php }?>
            </ul>
        </li>
        <li class="has-dropdown">
            <a id="Menu-Addons" href="#" onclick="return false;">
                <i class="fas fa-cube"></i>
                <?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['utilities']['addonmodules'];?>

                <span class="caret"></span>
            </a>
            <ul>
                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['addon_modules']->value, 'displayname', false, 'module');
$_smarty_tpl->tpl_vars['displayname']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['module']->value => $_smarty_tpl->tpl_vars['displayname']->value) {
$_smarty_tpl->tpl_vars['displayname']->do_else = false;
?>
                    <li><a id="Menu-Addons-<?php echo $_smarty_tpl->tpl_vars['displayname']->value;?>
" href="addonmodules.php?module=<?php echo $_smarty_tpl->tpl_vars['module']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['displayname']->value;?>
</a></li>
                <?php
}
if ($_smarty_tpl->tpl_vars['displayname']->do_else) {
?>
                    <li><a id="Menu-Addons-AppsAndIntegrations" href="<?php echo routePath('admin-apps-index');?>
"><?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['setup']['appsAndIntegrations'];?>
</a></li>
                    <li><a id="Menu-Addons-Marketplace-Link" class="autoLinked" href="https://marketplace.whmcs.com">Visit WHMCS Marketplace</a></li>
                <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
            </ul>
        </li>
    </ul>

    <ul class="right-nav">
        <?php if (in_array("Automation Status",$_smarty_tpl->tpl_vars['admin_perms']->value)) {?>
            <li class="bt">
                <a href="automationstatus.php" id="Menu-Automation-Status" data-toggle="tooltip" data-placement="bottom" title="<?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['utilities']['automationStatus'];?>
">
                    <?php if (!$_smarty_tpl->tpl_vars['isNewInstallation']->value && ($_smarty_tpl->tpl_vars['isCronError']->value || $_smarty_tpl->tpl_vars['isCronWarning']->value)) {?>
                        <div class="badge-container">
                            <i class="fas fa-cogs always"></i>
                            <span class="badge"><span class="fas fa-<?php if ($_smarty_tpl->tpl_vars['isCronError']->value) {?>times<?php } else { ?>exclamation<?php }?>"></span></span>
                        </div>
                    <?php } else { ?>
                        <i class="fas fa-cogs always"></i>
                    <?php }?>
                    <span class="visible-sidebar"><?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['utilities']['automationStatus'];?>
</span>
                </a>
            </li>
        <?php }?>
        <?php if ($_smarty_tpl->tpl_vars['showUpdateAvailable']->value) {?>
            <li class="bt">
                <a href="update.php" class="update-btn" data-toggle="tooltip" data-placement="bottom" title="<?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['license']['updateavailable'];?>
">
                    <i class="fas fa-download always"></i>
                    <span class="visible-sidebar"><?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['global']['updateAvailabile'];?>
</span>
                </a>
            </li>
        <?php }?>
        <li class="bt has-dropdown">
            <a id="Menu-Setup" href="#" onclick="return false;">
                <i class="fas fa-wrench always"></i>
                <span class="visible-sidebar"><?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['setup']['config'];?>
</span>
            </a>
            <ul class="drop-icons">
                <?php if ($_smarty_tpl->tpl_vars['hasSetupMenuAccess']->value) {?>
                    <li>
                        <a id="Menu-Config-Setup" href="<?php echo routePath('admin-setup-index');?>
">
                            <span class="ico-container"><i class="fad fa-sliders-h"></i></span>
                            <?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['setup']['title'];?>

                        </a>
                    </li>
                <?php }?>
                <li>
                    <a id="Menu-Config-Apps-Integrations" href="<?php echo routePath('admin-apps-index');?>
">
                        <span class="ico-container wizard"><i class="fad fa-cubes"></i></span>
                        <?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['setup']['appsAndIntegrations'];?>

                    </a>
                </li>
                <?php if (in_array("Configure Administrators",$_smarty_tpl->tpl_vars['admin_perms']->value)) {?>
                    <li>
                        <a id="Menu-Config-Admins" href="configadmins.php">
                            <span class="ico-container health"><i class="fad fa-user-friends"></i></span>
                            <?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['config']['manageAdmins'];?>

                        </a>
                    </li>
                <?php }?>
                <?php if (in_array("Health and Updates",$_smarty_tpl->tpl_vars['admin_perms']->value)) {?>
                    <li>
                        <a id="Menu-Config-HealthStatus" href="systemhealthandupdates.php">
                            <span class="ico-container health"><i class="fad fa-heart-rate"></i></span>
                            <?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['healthCheck']['menuTitle'];?>

                        </a>
                    </li>
                <?php }?>
                <?php if (in_array("Configure General Settings",$_smarty_tpl->tpl_vars['admin_perms']->value)) {?>
                    <li>
                        <a id="Menu-Config-SetupWizard" href="#" onclick="openSetupWizard();return false;">
                            <span class="ico-container wizard"><i class="fad fa-magic"></i></span>
                            <?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['help']['setupWizard'];?>

                        </a>
                    </li>
                <?php }?>
                <?php if (in_array("View Activity Log",$_smarty_tpl->tpl_vars['admin_perms']->value) || in_array("View Admin Log",$_smarty_tpl->tpl_vars['admin_perms']->value) || in_array("View Module Debug Log",$_smarty_tpl->tpl_vars['admin_perms']->value) || in_array("View Email Message Log",$_smarty_tpl->tpl_vars['admin_perms']->value) || in_array("View Ticket Mail Import Log",$_smarty_tpl->tpl_vars['admin_perms']->value) || in_array("View WHOIS Lookup Log",$_smarty_tpl->tpl_vars['admin_perms']->value)) {?>
                    <li>
                        <a id="Menu-Config-SysLogs" href="systemactivitylog.php">
                            <span class="ico-container logs"><i class="fad fa-copy"></i></span>
                            <?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['config']['sysLogs'];?>

                        </a>
                    </li>
                <?php }?>
            </ul>
        </li>
        <li class="bt account has-dropdown">
            <a id="Menu-Account" href="#" onclick="return false;">
                <img src="https://www.gravatar.com/avatar/<?php echo md5(\WHMCS\User\Admin::getAuthenticatedUser()->email);?>
?s=25&d=mp" class="profile-icon" alt="Gravatar">
                <span class="visible-sidebar"><?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['account'];?>
</span>
            </a>
            <ul class="slim drop-left">
                <li><a href="myaccount.php"><?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['global']['myaccount'];?>
</a></li>
                <li><a href="#" data-toggle="modal" data-target="#modalMyNotes"><?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['global']['mynotes'];?>
</a></li>
                <li role="separator" class="divider"></li>
                <li><a href="../"><?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['global']['clientarea'];?>
</a></li>
                <li role="separator" class="divider"></li>
                <li><a id="Menu-Account-Logout" href="logout.php"><?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['global']['logout'];?>
</a></li>
            </ul>
        </li>
        <li class="bt help has-dropdown">
            <a id="Menu-Help" href="#" onclick="return false;">
                <i class="far fa-question-circle always"></i>
                <span class="visible-sidebar"><?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['help']['title'];?>
</span>
            </a>
            <ul class="drop-left">
                <li><a href="https://docs.whmcs.com/<?php echo $_smarty_tpl->tpl_vars['helplink']->value;?>
" target="_blank"><?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['help']['docs'];?>
</a></li>
                <li><a href="systemsupportrequest.php"><?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['help']['techSupport'];?>
</a></li>
                <li><a id="Menu-Help-Community_Forums" href="https://whmcs.community/?utm_source=InApp&utm_medium=Help_Menu" target="_blank"><?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['help']['forums'];?>
</a></li>
                <?php if (in_array("View What's New",$_smarty_tpl->tpl_vars['admin_perms']->value)) {?>
                    <li><a href="javascript:openFeatureHighlights()"><?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['whatsNew']['menuTitle'];?>
</a></li>
                <?php }?>
                <?php if (in_array("Main Homepage",$_smarty_tpl->tpl_vars['admin_perms']->value)) {?>
                    <li role="separator" class="divider"></li>
                    <li><a href="<?php echo routePath('admin-help-license');?>
"><?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['help']['licenseinfo'];?>
</a></li>
                <?php }?>
            </ul>
        </li>
    </ul>
</div>

<div class="intellisearch" id="intelliSearchForm">
    <form method="post" action="<?php echo routePath('admin-search-intellisearch');?>
">
        <input type="hidden" id="intelliSearchHideInactive" name="hide_inactive" value="1">
        <i class="fas fa-search loader"></i>
        <div class="input-group">
            <input type="text" name="searchterm" class="form-control" id="inputIntelliSearchValue" placeholder="<?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['searchPlaceholder'];?>
">
            <span class="input-group-btn">
                <button class="btn btn-default" type="button" id="btnIntelliSearchClose">
                    <i class="far fa-times closer"></i>
                </button>
            </span>
        </div>
        <input type="hidden" id="intelliSearchExpand" name="more" value="">
    </form>
</div>
<?php }
}
