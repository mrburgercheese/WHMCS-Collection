<?php
/* Smarty version 3.1.36, created on 2022-09-24 20:16:39
  from 'mailMessage:message' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.36',
  'unifunc' => 'content_632f65a7a75651_88202590',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '652e3de8ff57f412acf7c0a8dadc70dc1a7637b6' => 
    array (
      0 => 'mailMessage:message',
      1 => 1664050599,
      2 => 'mailMessage',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_632f65a7a75651_88202590 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
        <title>WHMCS New Order Notification</title>
        <style type="text/css">
            [EmailCSS]
        </style>
    </head>
    <body leftmargin="0" marginwidth="0" topmargin="0" marginheight="0" offset="0">
        <center>
            <table align="center" border="0" cellpadding="0" cellspacing="0" height="100%" width="100%" id="bodyTable">
                <tr>
                    <td align="center" valign="top" id="bodyCell">
                        <table border="0" cellpadding="0" cellspacing="0" id="templateContainer">
                            <tr>
                                <td align="center" valign="top">
                                    <table border="0" cellpadding="0" cellspacing="0" width="100%" id="templateHeader">
                                        <tr>
                                            <td valign="top" class="headerContent">
                                                <img src="https://whmnode.com/manage/assets/img/logo.png" style="max-width:600px;padding:20px 20px 0 20px" id="headerImage" alt="WHMNODE HOSTING" />
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td align="center" valign="top">
                                    <table border="0" cellpadding="0" cellspacing="0" width="100%" id="templateBody">
                                        <tr>
                                            <td valign="top" class="bodyContent">
                                                <?php $_smarty_tpl->_assignInScope('displayTotalToday', 'true');?>
<p><strong>Order Information</strong></p>
<p>Order ID: <?php echo $_smarty_tpl->tpl_vars['order_id']->value;?>
<br />
Order Number: <?php echo $_smarty_tpl->tpl_vars['order_number']->value;?>
<br />
Date/Time: <?php echo $_smarty_tpl->tpl_vars['order_date']->value;?>
<br />
Invoice Number: <?php if ($_smarty_tpl->tpl_vars['custom_invoice_number']->value) {
echo $_smarty_tpl->tpl_vars['custom_invoice_number']->value;
} else {
echo $_smarty_tpl->tpl_vars['invoice_id']->value;
}?><br />
Payment Method: <?php echo $_smarty_tpl->tpl_vars['order_payment_method']->value;?>
</p>
<p><strong>Customer Information</strong></p>
<p>Customer ID: <?php echo $_smarty_tpl->tpl_vars['client_id']->value;?>
<br />
Name: <?php echo $_smarty_tpl->tpl_vars['client_first_name']->value;?>
 <?php echo $_smarty_tpl->tpl_vars['client_last_name']->value;?>
<br />
Email: <?php echo $_smarty_tpl->tpl_vars['client_email']->value;?>
<br />
Company: <?php echo $_smarty_tpl->tpl_vars['client_company_name']->value;?>
<br />
Address 1: <?php echo $_smarty_tpl->tpl_vars['client_address1']->value;?>
<br />
Address 2: <?php echo $_smarty_tpl->tpl_vars['client_address2']->value;?>
<br />
City: <?php echo $_smarty_tpl->tpl_vars['client_city']->value;?>
<br />
State: <?php echo $_smarty_tpl->tpl_vars['client_state']->value;?>
<br />
Postcode: <?php echo $_smarty_tpl->tpl_vars['client_postcode']->value;?>
<br />
Country: <?php echo $_smarty_tpl->tpl_vars['client_country']->value;?>
<br />
Phone Number: <?php echo $_smarty_tpl->tpl_vars['client_phonenumber']->value;?>
</p>
<p><strong>Order Items</strong></p>
<p><?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['order_items_array']->value, 'value', false, 'key');
$_smarty_tpl->tpl_vars['value']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['key']->value => $_smarty_tpl->tpl_vars['value']->value) {
$_smarty_tpl->tpl_vars['value']->do_else = false;
?>
    <?php if ($_smarty_tpl->tpl_vars['value']->value['service']) {?>
        Product/Service: <?php echo $_smarty_tpl->tpl_vars['value']->value['service'];?>
<br>
        <?php if ($_smarty_tpl->tpl_vars['value']->value['domain']) {?>Domain: <?php echo $_smarty_tpl->tpl_vars['value']->value['domain'];?>
<br><?php }?>
        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['value']->value['extra'], 'extra');
$_smarty_tpl->tpl_vars['extra']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['extra']->value) {
$_smarty_tpl->tpl_vars['extra']->do_else = false;
echo $_smarty_tpl->tpl_vars['extra']->value;?>
<br><?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
        First Payment Amount: <?php echo $_smarty_tpl->tpl_vars['value']->value['firstPayment'];?>
<br>
        <?php if ($_smarty_tpl->tpl_vars['value']->value['recurringPayment']) {?>Recurring Amount: <?php echo $_smarty_tpl->tpl_vars['value']->value['recurringPayment'];?>
<br><?php }?>
        Billing Cycle: <?php echo $_smarty_tpl->tpl_vars['value']->value['cycle'];?>
<br>
        <?php if ($_smarty_tpl->tpl_vars['value']->value['qty']) {?>
            Quantity: <?php echo $_smarty_tpl->tpl_vars['value']->value['qty'];?>
<br>
            Total: <?php echo $_smarty_tpl->tpl_vars['value']->value['totalDue'];?>
<br>
        <?php }?><br>
    <?php } elseif ($_smarty_tpl->tpl_vars['value']->value['domain']) {?>
        Domain Action: <?php echo $_smarty_tpl->tpl_vars['value']->value['type'];?>
<br>
        Domain: <?php echo $_smarty_tpl->tpl_vars['value']->value['domain'];?>
<br>
        <?php if ($_smarty_tpl->tpl_vars['value']->value['firstPayment']) {?>First Payment Amount: <?php echo $_smarty_tpl->tpl_vars['value']->value['firstPayment'];?>
<br><?php }?>
        <?php if ($_smarty_tpl->tpl_vars['value']->value['recurringPayment']) {?>Recurring Amount: <?php echo $_smarty_tpl->tpl_vars['value']->value['recurringPayment'];?>
<br><?php }?>
        Registration Period: <?php echo $_smarty_tpl->tpl_vars['value']->value['registrationPeriod'];?>
<br>
        <?php if ($_smarty_tpl->tpl_vars['value']->value['dnsManagement']) {?>DNS Management<br><?php }?>
        <?php if ($_smarty_tpl->tpl_vars['value']->value['emailForwarding']) {?>Email Forwarding<br><?php }?>
        <?php if ($_smarty_tpl->tpl_vars['value']->value['idProtection']) {?>ID Protection<br><?php }?>
    <?php } elseif ($_smarty_tpl->tpl_vars['value']->value['addon']) {?>
        <?php if ($_smarty_tpl->tpl_vars['value']->value['qty']) {
echo $_smarty_tpl->tpl_vars['value']->value['qty'];?>
 x <?php }?>Addon: <?php echo $_smarty_tpl->tpl_vars['value']->value['addon'];?>
<br>
        Setup Fee: <?php echo $_smarty_tpl->tpl_vars['value']->value['setupFee'];?>
<br>
        <?php if ($_smarty_tpl->tpl_vars['value']->value['recurringPayment']) {?>Recurring Amount: <?php echo $_smarty_tpl->tpl_vars['value']->value['recurringPayment'];?>
<br><?php }?>
        Billing Cycle: <?php echo $_smarty_tpl->tpl_vars['value']->value['cycle'];?>
<br>
    <?php } elseif ($_smarty_tpl->tpl_vars['value']->value['upgrade']) {
echo $_smarty_tpl->tpl_vars['value']->value['upgrade'];?>

<?php $_smarty_tpl->_assignInScope('displayTotalToday', false);
}?><br>
<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);
if ($_smarty_tpl->tpl_vars['displayTotalToday']->value == true) {?>Total Due Today: <?php echo $_smarty_tpl->tpl_vars['total_due_today']->value;
}?></p>
<?php if ($_smarty_tpl->tpl_vars['order_notes']->value) {?><p><strong>Order Notes</strong></p>
<p><?php echo $_smarty_tpl->tpl_vars['order_notes']->value;?>
</p><?php }?>
<p><strong>ISP Information</strong></p>
<p>IP: <?php echo $_smarty_tpl->tpl_vars['client_ip']->value;?>
<br />
Host: <?php echo $_smarty_tpl->tpl_vars['client_hostname']->value;?>
</p><p><a href="<?php echo $_smarty_tpl->tpl_vars['whmcs_admin_url']->value;?>
orders.php?action=view&id=<?php echo $_smarty_tpl->tpl_vars['order_id']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['whmcs_admin_url']->value;?>
orders.php?action=view&id=<?php echo $_smarty_tpl->tpl_vars['order_id']->value;?>
</a></p>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td align="center" valign="top">
                                    <table border="0" cellpadding="0" cellspacing="0" width="100%" id="templateFooter">
                                        <tr>
                                            <td valign="top" class="footerContent">
                                                <a href="https://www.whmcs.com/"><img src="https://cdn.whmcs.com/images/whmcs_email_footer.png" id="footerImage" alt="WHMCS" /></a>
                                                This notification was automatically generated by WHMCS<br />
                                                &nbsp;<a href="https://whmnode.com/">https://whmnode.com/</a>
                                                <span class="hide-mobile"> | </span>
                                                <a href="https://whmnode.com/manage/admin/">log in to the admin area</a>&nbsp;
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </center>
    </body>
</html><?php }
}
