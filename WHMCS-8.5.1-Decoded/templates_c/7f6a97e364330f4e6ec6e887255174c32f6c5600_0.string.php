<?php
/* Smarty version 3.1.36, created on 2022-09-24 19:31:51
  from '7f6a97e364330f4e6ec6e887255174c32f6c5600' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.36',
  'unifunc' => 'content_632f5b2704c5f1_71073049',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_632f5b2704c5f1_71073049 (Smarty_Internal_Template $_smarty_tpl) {
?><div class="alert alert-info info-alert"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['lang'][0], array( array('key'=>"wizard.settingsIntro"),$_smarty_tpl ) );?>
</div>

<div class="form-horizontal">
    <div class="form-group">
        <label for="inputCompanyName" class="col-sm-3 control-label"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['lang'][0], array( array('key'=>"fields.companyname"),$_smarty_tpl ) );?>
</label>
        <div class="col-sm-9">
            <input id="inputCompanyName" type="text" name="CompanyName" class="form-control" value="<?php echo $_smarty_tpl->tpl_vars['CompanyName']->value;?>
">
        </div>
    </div>
    <div class="form-group">
        <label for="inputLogo" class="col-sm-3 control-label"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['lang'][0], array( array('key'=>"fields.logo"),$_smarty_tpl ) );?>
</label>
        <div class="col-sm-9">
            <input type="file" id="inputLogo" name="Logo" class="form-control" accept="image/*">
        </div>
    </div>
    <div class="form-group">
        <label for="inputEmail" class="col-sm-3 control-label"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['lang'][0], array( array('key'=>"fields.email"),$_smarty_tpl ) );?>
</label>
        <div class="col-sm-9">
            <input id="inputEmail" type="email" name="Email" class="form-control" value="<?php echo $_smarty_tpl->tpl_vars['Email']->value;?>
">
            <p class="help-block"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['lang'][0], array( array('key'=>"wizard.settingsEmailDescription"),$_smarty_tpl ) );?>
</p>
        </div>
    </div>
    <div class="form-group">
        <label for="inputAddress" class="col-sm-3 control-label"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['lang'][0], array( array('key'=>"fields.address"),$_smarty_tpl ) );?>
</label>
        <div class="col-sm-9">
            <textarea id="inputAddress" name="Address" class="form-control" style="height:68px;"><?php echo $_smarty_tpl->tpl_vars['Address']->value;?>
</textarea>
            <p class="help-block"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['lang'][0], array( array('key'=>"wizard.settingsAddressDescription"),$_smarty_tpl ) );?>
</p>
        </div>
    </div>
    <div class="form-group">
        <label for="inputCountry" class="col-sm-3 control-label"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['lang'][0], array( array('key'=>"fields.country"),$_smarty_tpl ) );?>
</label>
        <div class="col-sm-9">
            <select name="Country" id="inputCountry" class="form-control select-inline">
                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['AvailableCountries']->value, 'country', true, 'code');
$_smarty_tpl->tpl_vars['country']->iteration = 0;
$_smarty_tpl->tpl_vars['country']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['code']->value => $_smarty_tpl->tpl_vars['country']->value) {
$_smarty_tpl->tpl_vars['country']->do_else = false;
$_smarty_tpl->tpl_vars['country']->iteration++;
$_smarty_tpl->tpl_vars['country']->last = $_smarty_tpl->tpl_vars['country']->iteration === $_smarty_tpl->tpl_vars['country']->total;
$__foreach_country_0_saved = $_smarty_tpl->tpl_vars['country'];
?>
                    <option value="<?php echo $_smarty_tpl->tpl_vars['code']->value;?>
"<?php if ($_smarty_tpl->tpl_vars['code']->value == $_smarty_tpl->tpl_vars['DefaultCountry']->value) {?> selected="selected"<?php }?>><?php echo $_smarty_tpl->tpl_vars['country']->value;?>
</option>
                <?php
$_smarty_tpl->tpl_vars['country'] = $__foreach_country_0_saved;
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
            </select>
            <p class="help-block"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['lang'][0], array( array('key'=>"wizard.settingsCountryDescription"),$_smarty_tpl ) );?>
</p>
        </div>
    </div>
    <div class="form-group">
        <label for="inputLanguage" class="col-sm-3 control-label"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['lang'][0], array( array('key'=>"fields.language"),$_smarty_tpl ) );?>
</label>
        <div class="col-sm-9">
            <select name="Language" id="inputLanguage" class="form-control select-inline">
                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['AvailableLanguages']->value, 'language', false, 'discard');
$_smarty_tpl->tpl_vars['language']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['discard']->value => $_smarty_tpl->tpl_vars['language']->value) {
$_smarty_tpl->tpl_vars['language']->do_else = false;
?>
                    <option value="<?php echo $_smarty_tpl->tpl_vars['language']->value;?>
"<?php if ($_smarty_tpl->tpl_vars['language']->value == $_smarty_tpl->tpl_vars['Language']->value) {?> selected="selected"<?php }?>><?php echo ucfirst($_smarty_tpl->tpl_vars['language']->value);?>
</option>
                <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
            </select>
            <p class="help-block"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['lang'][0], array( array('key'=>"wizard.settingsLanguageDescription"),$_smarty_tpl ) );?>
</p>
        </div>
    </div>
</div>

<?php echo '<script'; ?>
 type="text/javascript">
    jQuery(document).ready(function(){
        jQuery('.company').val(jQuery('#fieldCompanyName').val());
    });
    jQuery('#fieldCompanyName').keydown(function() {
        jQuery('.company').val(jQuery(this).val());
    });
    jQuery('#inputCountry').change(function() {
        var allowedCountries = [<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['allowedCcSignupCountries']->value, 'country', true);
$_smarty_tpl->tpl_vars['country']->iteration = 0;
$_smarty_tpl->tpl_vars['country']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['country']->value) {
$_smarty_tpl->tpl_vars['country']->do_else = false;
$_smarty_tpl->tpl_vars['country']->iteration++;
$_smarty_tpl->tpl_vars['country']->last = $_smarty_tpl->tpl_vars['country']->iteration === $_smarty_tpl->tpl_vars['country']->total;
$__foreach_country_2_saved = $_smarty_tpl->tpl_vars['country'];
?>'<?php echo $_smarty_tpl->tpl_vars['country']->value;?>
'<?php if (!$_smarty_tpl->tpl_vars['country']->last) {?>,<?php }
$_smarty_tpl->tpl_vars['country'] = $__foreach_country_2_saved;
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>],
            isAllowed = jQuery.inArray(jQuery(this).val(), allowedCountries);
            
        if (isAllowed < 0) {
            jQuery('.wizard-content').find('.credit-card').addClass('hidden');
            jQuery('#checkboxCreditCardEnable').iCheck('uncheck');
        } else {
            jQuery('.wizard-content').find('credit-card').removeClass('hidden');
            jQuery('#checkboxCreditCardEnable').iCheck('check');
        }
    });
<?php echo '</script'; ?>
><?php }
}
