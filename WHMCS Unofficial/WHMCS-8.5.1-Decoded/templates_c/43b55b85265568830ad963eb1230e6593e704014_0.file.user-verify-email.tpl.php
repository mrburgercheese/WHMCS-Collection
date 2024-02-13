<?php
/* Smarty version 3.1.36, created on 2022-09-24 20:15:15
  from '/home/whmnodec/public_html/manage/templates/twenty-one/user-verify-email.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.36',
  'unifunc' => 'content_632f65532019c6_78348406',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '43b55b85265568830ad963eb1230e6593e704014' => 
    array (
      0 => '/home/whmnodec/public_html/manage/templates/twenty-one/user-verify-email.tpl',
      1 => 1655190152,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_632f65532019c6_78348406 (Smarty_Internal_Template $_smarty_tpl) {
?><div class="card mw-540 mb-md-4 mt-md-4">
    <div class="card-body px-sm-5 py-5 text-center">
        <?php if ($_smarty_tpl->tpl_vars['success']->value) {?>
            <h2>
                <i class="fas fa-check fa-2x text-success"></i><br>
                <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['lang'][0], array( array('key'=>"emailVerification.success"),$_smarty_tpl ) );?>

            </h2>
        <?php } elseif ($_smarty_tpl->tpl_vars['expired']->value) {?>
            <h2>
                <i class="far fa-clock fa-2x text-warning"></i><br>
                <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['lang'][0], array( array('key'=>"emailVerification.expired"),$_smarty_tpl ) );?>

            </h2>

            <?php if ($_smarty_tpl->tpl_vars['loggedin']->value) {?>
                <button class="btn btn-default btn-lg btn-resend-verify-email" data-email-sent="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['lang'][0], array( array('key'=>'emailSent'),$_smarty_tpl ) );?>
" data-error-msg="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['lang'][0], array( array('key'=>'error'),$_smarty_tpl ) );?>
" data-uri="<?php echo routePath('user-email-verification-resend');?>
">
                    <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['lang'][0], array( array('key'=>'resendEmail'),$_smarty_tpl ) );?>

                </button>
            <?php } else { ?>
                <p><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['lang'][0], array( array('key'=>"emailVerification.loginToRequest"),$_smarty_tpl ) );?>
</p>
            <?php }?>
        <?php } else { ?>
            <h2>
                <i class="fas fa-times fa-2x text-danger"></i><br>
                <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['lang'][0], array( array('key'=>"emailVerification.notFound"),$_smarty_tpl ) );?>

            </h2>

            <?php if (!$_smarty_tpl->tpl_vars['loggedin']->value) {?>
                <p><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['lang'][0], array( array('key'=>"emailVerification.loginToRequest"),$_smarty_tpl ) );?>
</p>
            <?php }?>
        <?php }?>

        <a href="<?php echo routePath('login-index');?>
" class="btn btn-primary btn-lg mt-4">
            <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['lang'][0], array( array('key'=>"orderForm.continueToClientArea"),$_smarty_tpl ) );?>

            &nbsp;
            <i class="fa fa-arrow-right"></i>
        </a>

    </div>
</div>
<?php }
}
