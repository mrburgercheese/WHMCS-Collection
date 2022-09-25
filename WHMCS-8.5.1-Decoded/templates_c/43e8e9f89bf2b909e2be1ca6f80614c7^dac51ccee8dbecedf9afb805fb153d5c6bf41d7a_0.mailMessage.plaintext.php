<?php
/* Smarty version 3.1.36, created on 2022-09-24 20:14:58
  from 'mailMessage:plaintext' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.36',
  'unifunc' => 'content_632f6542185b01_66634740',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'dac51ccee8dbecedf9afb805fb153d5c6bf41d7a' => 
    array (
      0 => 'mailMessage:plaintext',
      1 => 1664050498,
      2 => 'mailMessage',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_632f6542185b01_66634740 (Smarty_Internal_Template $_smarty_tpl) {
?>Welcome to <?php echo $_smarty_tpl->tpl_vars['company_name']->value;?>



Please click on the link below to verify your email address. This is required to confirm ownership of the email address.


<?php echo $_smarty_tpl->tpl_vars['verification_url']->value;?>



If you're having trouble, try copying and pasting the following URL into your browser:
<?php echo $_smarty_tpl->tpl_vars['verification_url']->value;?>



This link is valid for 60 minutes only. If it has expired, login to our <?php echo $_smarty_tpl->tpl_vars['whmcs_url']->value;?>
 to request a new link.


<?php echo $_smarty_tpl->tpl_vars['signature']->value;
}
}
