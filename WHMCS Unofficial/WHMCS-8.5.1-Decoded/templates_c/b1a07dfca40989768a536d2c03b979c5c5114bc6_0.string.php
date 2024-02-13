<?php
/* Smarty version 3.1.36, created on 2022-09-24 19:31:51
  from 'b1a07dfca40989768a536d2c03b979c5c5114bc6' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.36',
  'unifunc' => 'content_632f5b270667c4_14732665',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_632f5b270667c4_14732665 (Smarty_Internal_Template $_smarty_tpl) {
?>
<div class="alert alert-warning info-alert"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['lang'][0], array( array('key'=>"wizard.gatewaysIntro"),$_smarty_tpl ) );?>
</div>

<div class="clearfix">
    <div style="float:left;"><img src="<?php echo $_smarty_tpl->tpl_vars['BASE_PATH_IMG']->value;?>
/wizard/paypal.png" alt="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['lang'][0], array( array('key'=>"wizard.paypal"),$_smarty_tpl ) );?>
"></div>
    <div style="float:left;padding:20px;width:390px;"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['lang'][0], array( array('key'=>"wizard.paypalDescription"),$_smarty_tpl ) );?>
</div>
</div>

<div class="row">
    <div class="col-sm-3 text-right">
        <label>
            <input id="checkboxPayPalEnable" type="checkbox" name="PayPalEnable" checked>
            <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['lang'][0], array( array('key'=>"wizard.enable"),$_smarty_tpl ) );?>

        </label>
    </div>
    <div class="col-sm-9">
        <input id="fieldPayPalEmailAddress" type="email" name="PayPalEmailAddress" class="form-control" placeholder="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['lang'][0], array( array('key'=>"wizard.paypalEnterEmail"),$_smarty_tpl ) );?>
">
    </div>
</div>
<div style="padding:15px 0 20px;font-size:0.9em;font-style:italic;">
    <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['lang'][0], array( array('key'=>"wizard.paypalDontHaveAccount"),$_smarty_tpl ) );?>

</div>

<div id="wizardCreditCardSignup" class="credit-card clearfix<?php if (!in_array($_smarty_tpl->tpl_vars['DefaultCountry']->value,$_smarty_tpl->tpl_vars['allowedCcSignupCountries']->value)) {?> hidden<?php }?>">
    <div style="float:left;"><img src="<?php echo $_smarty_tpl->tpl_vars['BASE_PATH_IMG']->value;?>
/wizard/creditcard.png" alt="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['lang'][0], array( array('key'=>"wizard.creditCard"),$_smarty_tpl ) );?>
"></div>
    <div style="float:left;padding:20px;width:390px;"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['lang'][0], array( array('key'=>"wizard.creditCardDescription"),$_smarty_tpl ) );?>
</div>
</div>

<div id="wizardCreditCardEnable" class="row bottom-margin-5 credit-card<?php if (!in_array($_smarty_tpl->tpl_vars['DefaultCountry']->value,$_smarty_tpl->tpl_vars['allowedCcSignupCountries']->value)) {?> hidden<?php }?>">
    <div class="col-sm-3 text-right">
        <label>
            <input id="checkboxCreditCardEnable" type="checkbox" name="CreditCardEnable" <?php if (in_array($_smarty_tpl->tpl_vars['DefaultCountry']->value,$_smarty_tpl->tpl_vars['allowedCcSignupCountries']->value)) {?> checked<?php }?>>
            <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['lang'][0], array( array('key'=>"wizard.enable"),$_smarty_tpl ) );?>

        </label>
    </div>
    <div class="col-sm-9">
        <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['lang'][0], array( array('key'=>"wizard.creditCardApply"),$_smarty_tpl ) );?>

    </div>
</div>

<div class="clearfix" style="margin-top:22px;">
    <div style="float:left;"><img src="<?php echo $_smarty_tpl->tpl_vars['BASE_PATH_IMG']->value;?>
/wizard/mailin.png" alt="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['lang'][0], array( array('key'=>"wizard.mailIn"),$_smarty_tpl ) );?>
"></div>
    <div style="float:left;padding:10px 20px;width:390px;">
        <label>
            <input id="checkboxMailInEnable" type="checkbox" name="MailInEnable" checked>
            <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['lang'][0], array( array('key'=>"wizard.enable"),$_smarty_tpl ) );?>

        </label>
        <div style="display:inline-block;padding-left:25px;"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['lang'][0], array( array('key'=>"wizard.mailInDescription"),$_smarty_tpl ) );?>
</div>
    </div>
</div><?php }
}
