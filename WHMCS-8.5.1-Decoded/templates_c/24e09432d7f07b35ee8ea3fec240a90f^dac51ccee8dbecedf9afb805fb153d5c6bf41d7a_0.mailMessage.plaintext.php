<?php
/* Smarty version 3.1.36, created on 2022-09-24 20:16:39
  from 'mailMessage:plaintext' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.36',
  'unifunc' => 'content_632f65a7a9d080_61584404',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'dac51ccee8dbecedf9afb805fb153d5c6bf41d7a' => 
    array (
      0 => 'mailMessage:plaintext',
      1 => 1664050599,
      2 => 'mailMessage',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_632f65a7a9d080_61584404 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_assignInScope('displayTotalToday', 'true');?>
Order Information


Order ID: <?php echo $_smarty_tpl->tpl_vars['order_id']->value;?>

Order Number: <?php echo $_smarty_tpl->tpl_vars['order_number']->value;?>

Date/Time: <?php echo $_smarty_tpl->tpl_vars['order_date']->value;?>

Invoice Number: <?php if ($_smarty_tpl->tpl_vars['custom_invoice_number']->value) {
echo $_smarty_tpl->tpl_vars['custom_invoice_number']->value;
} else {
echo $_smarty_tpl->tpl_vars['invoice_id']->value;
}?>
Payment Method: <?php echo $_smarty_tpl->tpl_vars['order_payment_method']->value;?>



Customer Information


Customer ID: <?php echo $_smarty_tpl->tpl_vars['client_id']->value;?>

Name: <?php echo $_smarty_tpl->tpl_vars['client_first_name']->value;?>
 <?php echo $_smarty_tpl->tpl_vars['client_last_name']->value;?>

Email: <?php echo $_smarty_tpl->tpl_vars['client_email']->value;?>

Company: <?php echo $_smarty_tpl->tpl_vars['client_company_name']->value;?>

Address 1: <?php echo $_smarty_tpl->tpl_vars['client_address1']->value;?>

Address 2: <?php echo $_smarty_tpl->tpl_vars['client_address2']->value;?>

City: <?php echo $_smarty_tpl->tpl_vars['client_city']->value;?>

State: <?php echo $_smarty_tpl->tpl_vars['client_state']->value;?>

Postcode: <?php echo $_smarty_tpl->tpl_vars['client_postcode']->value;?>

Country: <?php echo $_smarty_tpl->tpl_vars['client_country']->value;?>

Phone Number: <?php echo $_smarty_tpl->tpl_vars['client_phonenumber']->value;?>



Order Items


<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['order_items_array']->value, 'value', false, 'key');
$_smarty_tpl->tpl_vars['value']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['key']->value => $_smarty_tpl->tpl_vars['value']->value) {
$_smarty_tpl->tpl_vars['value']->do_else = false;
?>
    <?php if ($_smarty_tpl->tpl_vars['value']->value['service']) {?>
        Product/Service: <?php echo $_smarty_tpl->tpl_vars['value']->value['service'];?>

        <?php if ($_smarty_tpl->tpl_vars['value']->value['domain']) {?>Domain: <?php echo $_smarty_tpl->tpl_vars['value']->value['domain'];?>

<?php }?>
        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['value']->value['extra'], 'extra');
$_smarty_tpl->tpl_vars['extra']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['extra']->value) {
$_smarty_tpl->tpl_vars['extra']->do_else = false;
echo $_smarty_tpl->tpl_vars['extra']->value;?>

<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
        First Payment Amount: <?php echo $_smarty_tpl->tpl_vars['value']->value['firstPayment'];?>

        <?php if ($_smarty_tpl->tpl_vars['value']->value['recurringPayment']) {?>Recurring Amount: <?php echo $_smarty_tpl->tpl_vars['value']->value['recurringPayment'];?>

<?php }?>
        Billing Cycle: <?php echo $_smarty_tpl->tpl_vars['value']->value['cycle'];?>

        <?php if ($_smarty_tpl->tpl_vars['value']->value['qty']) {?>
            Quantity: <?php echo $_smarty_tpl->tpl_vars['value']->value['qty'];?>

            Total: <?php echo $_smarty_tpl->tpl_vars['value']->value['totalDue'];?>

        <?php }?>
    <?php } elseif ($_smarty_tpl->tpl_vars['value']->value['domain']) {?>
        Domain Action: <?php echo $_smarty_tpl->tpl_vars['value']->value['type'];?>

        Domain: <?php echo $_smarty_tpl->tpl_vars['value']->value['domain'];?>

        <?php if ($_smarty_tpl->tpl_vars['value']->value['firstPayment']) {?>First Payment Amount: <?php echo $_smarty_tpl->tpl_vars['value']->value['firstPayment'];?>

<?php }?>
        <?php if ($_smarty_tpl->tpl_vars['value']->value['recurringPayment']) {?>Recurring Amount: <?php echo $_smarty_tpl->tpl_vars['value']->value['recurringPayment'];?>

<?php }?>
        Registration Period: <?php echo $_smarty_tpl->tpl_vars['value']->value['registrationPeriod'];?>

        <?php if ($_smarty_tpl->tpl_vars['value']->value['dnsManagement']) {?>DNS Management
<?php }?>
        <?php if ($_smarty_tpl->tpl_vars['value']->value['emailForwarding']) {?>Email Forwarding
<?php }?>
        <?php if ($_smarty_tpl->tpl_vars['value']->value['idProtection']) {?>ID Protection
<?php }?>
    <?php } elseif ($_smarty_tpl->tpl_vars['value']->value['addon']) {?>
        <?php if ($_smarty_tpl->tpl_vars['value']->value['qty']) {
echo $_smarty_tpl->tpl_vars['value']->value['qty'];?>
 x <?php }?>Addon: <?php echo $_smarty_tpl->tpl_vars['value']->value['addon'];?>

        Setup Fee: <?php echo $_smarty_tpl->tpl_vars['value']->value['setupFee'];?>

        <?php if ($_smarty_tpl->tpl_vars['value']->value['recurringPayment']) {?>Recurring Amount: <?php echo $_smarty_tpl->tpl_vars['value']->value['recurringPayment'];?>

<?php }?>
        Billing Cycle: <?php echo $_smarty_tpl->tpl_vars['value']->value['cycle'];?>

    <?php } elseif ($_smarty_tpl->tpl_vars['value']->value['upgrade']) {
echo $_smarty_tpl->tpl_vars['value']->value['upgrade'];?>

<?php $_smarty_tpl->_assignInScope('displayTotalToday', false);
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);
if ($_smarty_tpl->tpl_vars['displayTotalToday']->value == true) {?>Total Due Today: <?php echo $_smarty_tpl->tpl_vars['total_due_today']->value;
}?>


<?php if ($_smarty_tpl->tpl_vars['order_notes']->value) {?>Order Notes


<?php echo $_smarty_tpl->tpl_vars['order_notes']->value;?>


<?php }?>
ISP Information


IP: <?php echo $_smarty_tpl->tpl_vars['client_ip']->value;?>

Host: <?php echo $_smarty_tpl->tpl_vars['client_hostname']->value;?>


<?php echo $_smarty_tpl->tpl_vars['whmcs_admin_url']->value;?>
orders.php?action=view&id=<?php echo $_smarty_tpl->tpl_vars['order_id']->value;
}
}
