<?php
/* Smarty version 3.1.36, created on 2022-09-24 20:14:59
  from 'mailMessage:plaintext' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.36',
  'unifunc' => 'content_632f6543504b60_83076270',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'dac51ccee8dbecedf9afb805fb153d5c6bf41d7a' => 
    array (
      0 => 'mailMessage:plaintext',
      1 => 1664050499,
      2 => 'mailMessage',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_632f6543504b60_83076270 (Smarty_Internal_Template $_smarty_tpl) {
?>Dear <?php echo $_smarty_tpl->tpl_vars['client_first_name']->value;?>
,


Thank you for creating a <?php echo $_smarty_tpl->tpl_vars['companyname']->value;?>
 account. Please review this email in its entirety as it contains important information.


Logging In


You can access our client area at <?php echo $_smarty_tpl->tpl_vars['whmcs_link']->value;?>



You will need your email address and the password you chose during signup to login.


If you created an account as part of placing a new order with us, you will shortly receive an order confirmation email.


Getting Support


If you need any help or assistance, you can access our support resources below.



<?php echo $_smarty_tpl->tpl_vars['whmcs_url']->value;?>
/knowledgebase.php
<?php echo $_smarty_tpl->tpl_vars['whmcs_url']->value;?>
/submitticket.php

<?php echo $_smarty_tpl->tpl_vars['signature']->value;?>



You are receiving this email because you recently created an account. If you did not do this, please contact us.<?php }
}
