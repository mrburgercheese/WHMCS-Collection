<?php
/* Smarty version 3.1.36, created on 2022-09-24 20:27:16
  from 'mailMessage:plaintext' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.36',
  'unifunc' => 'content_632f68244c4570_04535240',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'dac51ccee8dbecedf9afb805fb153d5c6bf41d7a' => 
    array (
      0 => 'mailMessage:plaintext',
      1 => 1664051236,
      2 => 'mailMessage',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_632f68244c4570_04535240 (Smarty_Internal_Template $_smarty_tpl) {
?>Dear <?php echo $_smarty_tpl->tpl_vars['client_name']->value;?>
,

PLEASE READ THIS EMAIL IN FULL AND PRINT IT FOR YOUR RECORDS

Thank you for your order from us! Your hosting account has now been setup and this email contains all the information you will need in order to begin using your account.

If you have requested a domain name during sign up, please keep in mind that your domain name will not be visible on the internet instantly. This process is called propagation and can take up to 48 hours. Until your domain has propagated, your website and email will not function, we have provided a temporary url which you may use to view your website and upload files in the meantime.

New Account Information

Hosting Package: <?php echo $_smarty_tpl->tpl_vars['service_product_name']->value;?>

Domain: <?php echo $_smarty_tpl->tpl_vars['service_domain']->value;?>

First Payment Amount: <?php echo $_smarty_tpl->tpl_vars['service_first_payment_amount']->value;?>

Recurring Amount: <?php echo $_smarty_tpl->tpl_vars['service_recurring_amount']->value;?>

Billing Cycle: <?php echo $_smarty_tpl->tpl_vars['service_billing_cycle']->value;?>

Next Due Date: <?php echo $_smarty_tpl->tpl_vars['service_next_due_date']->value;?>


Login Details

Username: <?php echo $_smarty_tpl->tpl_vars['service_username']->value;?>

Password: <?php echo $_smarty_tpl->tpl_vars['service_password']->value;?>


Control Panel URL: http://<?php echo $_smarty_tpl->tpl_vars['service_server_ip']->value;?>
:2082/
Once your domain has propagated, you may also use http://www.<?php echo $_smarty_tpl->tpl_vars['service_domain']->value;?>
:2082/

Server Information

Server Name: <?php echo $_smarty_tpl->tpl_vars['service_server_name']->value;?>

Server IP: <?php echo $_smarty_tpl->tpl_vars['service_server_ip']->value;?>


If you are using an existing domain with your new hosting account, you will need to update the nameservers to point to the nameservers listed below.

Nameserver 1: <?php echo $_smarty_tpl->tpl_vars['service_ns1']->value;?>
 (<?php echo $_smarty_tpl->tpl_vars['service_ns1_ip']->value;?>
)
Nameserver 2: <?php echo $_smarty_tpl->tpl_vars['service_ns2']->value;?>
 (<?php echo $_smarty_tpl->tpl_vars['service_ns2_ip']->value;?>
)<?php if ($_smarty_tpl->tpl_vars['service_ns3']->value) {?>
Nameserver 3: <?php echo $_smarty_tpl->tpl_vars['service_ns3']->value;?>
 (<?php echo $_smarty_tpl->tpl_vars['service_ns3_ip']->value;?>
)<?php }
if ($_smarty_tpl->tpl_vars['service_ns4']->value) {?>
Nameserver 4: <?php echo $_smarty_tpl->tpl_vars['service_ns4']->value;?>
 (<?php echo $_smarty_tpl->tpl_vars['service_ns4_ip']->value;?>
)<?php }?>

Uploading Your Website

Temporarily you may use one of the addresses given below to manage your web site:

Temporary FTP Hostname: <?php echo $_smarty_tpl->tpl_vars['service_server_ip']->value;?>

Temporary Webpage URL: http://<?php echo $_smarty_tpl->tpl_vars['service_server_ip']->value;?>
/~<?php echo $_smarty_tpl->tpl_vars['service_username']->value;?>
/

And once your domain has propagated you may use the details below:

FTP Hostname: <?php echo $_smarty_tpl->tpl_vars['service_domain']->value;?>

Webpage URL: http://www.<?php echo $_smarty_tpl->tpl_vars['service_domain']->value;?>


Email Settings

For email accounts that you setup, you should use the following connection details in your email program:

POP3 Host Address: mail.<?php echo $_smarty_tpl->tpl_vars['service_domain']->value;?>

SMTP Host Address: mail.<?php echo $_smarty_tpl->tpl_vars['service_domain']->value;?>

Username: The email address you are checking email for
Password: As specified in your control panel

Thank you for choosing us.

<?php echo $_smarty_tpl->tpl_vars['signature']->value;
}
}
