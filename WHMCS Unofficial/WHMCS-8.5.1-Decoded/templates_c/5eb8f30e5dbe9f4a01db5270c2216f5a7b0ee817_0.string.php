<?php
/* Smarty version 3.1.36, created on 2022-09-24 19:31:51
  from '5eb8f30e5dbe9f4a01db5270c2216f5a7b0ee817' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.36',
  'unifunc' => 'content_632f5b2709acc4_72929775',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_632f5b2709acc4_72929775 (Smarty_Internal_Template $_smarty_tpl) {
?>
<div class="alert alert-info info-alert"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['lang'][0], array( array('key'=>"wizard.enomRecommended"),$_smarty_tpl ) );?>
</div>

<div class="clearfix">
    <div style="float:left;margin-top:-14px;"><img src="<?php echo $_smarty_tpl->tpl_vars['BASE_PATH_IMG']->value;?>
/wizard/enom.png" alt="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['lang'][0], array( array('key'=>"wizard.registrarEnom"),$_smarty_tpl ) );?>
"></div>
    <div style="float:left;padding:6px 20px;width:390px;"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['lang'][0], array( array('key'=>"wizard.registrarEnomCreateAccountDescription"),$_smarty_tpl ) );?>
</div>
</div>

<div id="enomSignupContainer">

    <div class="signup-frm">
        <div class="row">
            <div class="col-sm-6 bottom-margin-5">
                <input type="text" name="name" class="form-control" placeholder="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['lang'][0], array( array('key'=>"wizard.placeholderYourName"),$_smarty_tpl ) );?>
" />
            </div>
            <div class="col-sm-6 bottom-margin-5">
                <input type="text" name="email" class="form-control" placeholder="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['lang'][0], array( array('key'=>"wizard.placeholderEmail"),$_smarty_tpl ) );?>
" />
            </div>
            <div class="col-sm-6 bottom-margin-5">
                <input type="text" name="address" class="form-control" placeholder="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['lang'][0], array( array('key'=>"wizard.placeholderAddress"),$_smarty_tpl ) );?>
" />
            </div>
            <div class="col-sm-6 bottom-margin-5">
                <input type="text" name="city" class="form-control" placeholder="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['lang'][0], array( array('key'=>"wizard.placeholderCity"),$_smarty_tpl ) );?>
" />
            </div>
            <div class="col-sm-6 bottom-margin-5">
                <input type="text" name="state" class="form-control" placeholder="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['lang'][0], array( array('key'=>"wizard.placeholderState"),$_smarty_tpl ) );?>
" />
            </div>
            <div class="col-sm-6 bottom-margin-5">
                <input type="text" name="postcode" class="form-control" placeholder="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['lang'][0], array( array('key'=>"wizard.placeholderPostcode"),$_smarty_tpl ) );?>
" />
            </div>
            <div class="col-sm-6 bottom-margin-5">
                <select name="country" class="form-control enom-input">
                    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['clientCountries']->value, 'countryName', false, 'countryCode');
$_smarty_tpl->tpl_vars['countryName']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['countryCode']->value => $_smarty_tpl->tpl_vars['countryName']->value) {
$_smarty_tpl->tpl_vars['countryName']->do_else = false;
?>
                        <option value="<?php echo $_smarty_tpl->tpl_vars['countryCode']->value;?>
" <?php if (($_smarty_tpl->tpl_vars['countryCode']->value == $_smarty_tpl->tpl_vars['defaultCountry']->value)) {?>selected="selected"<?php }?>>
                            <?php echo $_smarty_tpl->tpl_vars['countryName']->value;?>

                        </option>
                    <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                </select>
            </div>
            <div class="col-sm-6 bottom-margin-5">
                <input type="text" name="phone" class="form-control" <?php if (($_smarty_tpl->tpl_vars['phoneNumberInputStyle']->value == 0)) {?>placeholder="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['lang'][0], array( array('key'=>"wizard.placeholderPhoneNumber"),$_smarty_tpl ) );?>
"<?php }?> />
            </div>
        </div>
    
        <p><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['lang'][0], array( array('key'=>"wizard.enomCredentials"),$_smarty_tpl ) );?>
</p>
    
        <div class="row">
            <div class="col-sm-6 bottom-margin-5">
                <input type="text" name="newusername" class="form-control" placeholder="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['lang'][0], array( array('key'=>"wizard.placeholderUsername"),$_smarty_tpl ) );?>
" />
            </div>
            <div class="col-sm-6 bottom-margin-5">
                <input type="password" name="newpassword" class="form-control" placeholder="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['lang'][0], array( array('key'=>"wizard.placeholderPassword"),$_smarty_tpl ) );?>
" />
            </div>
            <div class="col-sm-6 bottom-margin-5">
                <select name="securityq" class="form-control enom-input">
                    <option value=""><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['lang'][0], array( array('key'=>"wizard.enomSecurityQuestionSelectOne"),$_smarty_tpl ) );?>
</option>
                    <option value="fteach"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['lang'][0], array( array('key'=>"wizard.enomSecurityQuestionFavoriteTeacher"),$_smarty_tpl ) );?>
</option>
                    <option value="fvspot"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['lang'][0], array( array('key'=>"wizard.enomSecurityQuestionFavoriteVacationSpot"),$_smarty_tpl ) );?>
</option>
                    <option value="fpet"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['lang'][0], array( array('key'=>"wizard.enomSecurityQuestionFavoritePet"),$_smarty_tpl ) );?>
</option>
                    <option value="fmovie"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['lang'][0], array( array('key'=>"wizard.enomSecurityQuestionFavoriteMovie"),$_smarty_tpl ) );?>
</option>
                    <option value="fbook"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['lang'][0], array( array('key'=>"wizard.enomSecurityQuestionFavoriteBook"),$_smarty_tpl ) );?>
</option>
                </select>
            </div>
            <div class="col-sm-6 bottom-margin-5">
                <input type="password" name="securitya" class="form-control" placeholder="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['lang'][0], array( array('key'=>"wizard.placeholderSecurityQuestionAnswer"),$_smarty_tpl ) );?>
" />
            </div>
        </div>
    
        <div style="margin:10px 0 0 0;"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['lang'][0], array( array('key'=>"wizard.enomAlreadyHaveAccount"),$_smarty_tpl ) );?>
 <a href="#" class="enomUseExistingAcct"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['lang'][0], array( array('key'=>"wizard.loginUsingExistingAccount"),$_smarty_tpl ) );?>
</a></div> 
    </div>
    
    <div class="signup-frm-success hidden">
        <div class="row">
            <div class="col-sm-10 col-sm-offset-1">
                <div class="alert alert-success text-center">
                    <h2><i class="fas fa-check"></i> <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['lang'][0], array( array('key'=>"wizard.enomAccountCreated"),$_smarty_tpl ) );?>
</h2>
                    <p>
                        <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['lang'][0], array( array('key'=>"wizard.enomAccountManagementUrl"),$_smarty_tpl ) );?>

                    </p>
                </div>
            </div>
        </div>
    </div>
    
</div>

<div id="enomLoginContainer" class="hidden">

    <div style="margin:10px 0 0 0;">
        <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['lang'][0], array( array('key'=>"wizard.dontHaveAnEnomAccount"),$_smarty_tpl ) );?>
 <a href="#" class="enomCreateAcct"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['lang'][0], array( array('key'=>"wizard.createNewOneNow"),$_smarty_tpl ) );?>
</a>
    </div>

    <br>

    <div class="row">
        <div class="col-sm-10 col-sm-offset-1">
            <div class="form-horizontal">
                <div class="form-group">
                    <label for="inputUsername" class="col-sm-4 control-label"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['lang'][0], array( array('key'=>"wizard.enomApiUsername"),$_smarty_tpl ) );?>
</label>
                    <div class="col-sm-8">
                        <input type="text" name="username" class="form-control" id="inputUsername" placeholder="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['lang'][0], array( array('key'=>"wizard.enomApiUsername"),$_smarty_tpl ) );?>
">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputApiToken" class="col-sm-4 control-label"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['lang'][0], array( array('key'=>"wizard.enomApiToken"),$_smarty_tpl ) );?>
</label>
                    <div class="col-sm-8">
                        <input type="password" name="password" class="form-control" id="inputApiToken" placeholder="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['lang'][0], array( array('key'=>"wizard.enomApiToken"),$_smarty_tpl ) );?>
">
                        <br>
                        <div class="alert alert-warning info-alert">
                            Don't have an API Token? <a href="https://www.enom.com/apitokens" target="_blank"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['lang'][0], array( array('key'=>"wizard.enomCreateToken"),$_smarty_tpl ) );?>
</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<input type="hidden" name="accttype" id="inputEnomAccountType" value="new">

<?php echo '<script'; ?>
>
$(document).ready(function() {
    $('.enomUseExistingAcct').click(function(e) {
        e.preventDefault();
        $('#enomSignupContainer').slideUp('fast', function() {
            $('#enomLoginContainer').hide().removeClass('hidden').slideDown('fast');
            $('#inputEnomAccountType').val('existing');
        });
    });
    $('.enomCreateAcct').click(function(e) {
        e.preventDefault();
        $('#enomLoginContainer').slideUp('fast', function() {
            $('#enomSignupContainer').slideDown('fast');
            $('#inputEnomAccountType').val('new');
        });
    });
    $('body').on('click', '.modal-setup-wizard .modal-submit', function() {
        var accountType = $('#inputEnomAccountType').val();
            
            if (accountType == 'new') {
                var username = $('input[name="newusername"]').val(),
                    password = $('input[name="newpassword"]').val();
            } else {
                var username = $('#inputUsername').val(),
                    password = $('#inputApiToken').val();
            }
            if (username && password) {
                $('#enomEnabled').removeClass('hidden');
            }
        });
});
<?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['BASE_PATH_JS']->value;?>
/TelephoneCountryCodeDropdown.js"><?php echo '</script'; ?>
><?php }
}
