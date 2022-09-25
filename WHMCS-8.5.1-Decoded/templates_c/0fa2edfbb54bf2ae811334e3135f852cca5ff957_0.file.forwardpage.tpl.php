<?php
/* Smarty version 3.1.36, created on 2022-09-24 20:16:41
  from '/home/whmnodec/public_html/manage/templates/twenty-one/forwardpage.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.36',
  'unifunc' => 'content_632f65a96c3138_38538678',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '0fa2edfbb54bf2ae811334e3135f852cca5ff957' => 
    array (
      0 => '/home/whmnodec/public_html/manage/templates/twenty-one/forwardpage.tpl',
      1 => 1655190152,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_632f65a96c3138_38538678 (Smarty_Internal_Template $_smarty_tpl) {
?><div class="my-2">
    <?php $_smarty_tpl->_subTemplateRender(((string)$_smarty_tpl->tpl_vars['template']->value)."/includes/alert.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('type'=>"info",'msg'=>$_smarty_tpl->tpl_vars['message']->value,'textcenter'=>true), 0, true);
?>
</div>

<div class="mb-5 d-flex flex-column justify-content-center align-items-center">

    <div class="progress w-25 my-4">
        <div class="progress-bar progress-bar-striped progress-bar-animated bg-color-blue w-100" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">
            <span class="sr-only"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['lang'][0], array( array('key'=>'loading'),$_smarty_tpl ) );?>
</span>
        </div>
    </div>

    <div id="frmPayment">

        <?php echo $_smarty_tpl->tpl_vars['code']->value;?>


        <form method="post" action="<?php if ($_smarty_tpl->tpl_vars['invoiceid']->value) {?>viewinvoice.php?id=<?php echo $_smarty_tpl->tpl_vars['invoiceid']->value;
} else { ?>clientarea.php<?php }?>">
        </form>

    </div>

</div>

<?php echo '<script'; ?>
>
    setTimeout("autoSubmitFormByContainer('frmPayment')", 5000);
<?php echo '</script'; ?>
>
<?php }
}
