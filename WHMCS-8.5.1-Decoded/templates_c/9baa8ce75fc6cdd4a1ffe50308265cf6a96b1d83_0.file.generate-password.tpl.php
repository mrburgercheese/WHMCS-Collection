<?php
/* Smarty version 3.1.36, created on 2022-09-24 19:53:03
  from '/home/whmnodec/public_html/manage/templates/six/includes/generate-password.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.36',
  'unifunc' => 'content_632f601fe842d4_73088268',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '9baa8ce75fc6cdd4a1ffe50308265cf6a96b1d83' => 
    array (
      0 => '/home/whmnodec/public_html/manage/templates/six/includes/generate-password.tpl',
      1 => 1655190152,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_632f601fe842d4_73088268 (Smarty_Internal_Template $_smarty_tpl) {
?><form action="#" id="frmGeneratePassword" class="form-horizontal">
    <div class="modal fade" id="modalGeneratePassword">
        <div class="modal-dialog">
            <div class="modal-content panel-primary">
                <div class="modal-header panel-heading">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">
                        <?php echo $_smarty_tpl->tpl_vars['LANG']->value['generatePassword']['title'];?>

                    </h4>
                </div>
                <div class="modal-body">
                    <div class="alert alert-danger hidden" id="generatePwLengthError">
                        <?php echo $_smarty_tpl->tpl_vars['LANG']->value['generatePassword']['lengthValidationError'];?>

                    </div>
                    <div class="form-group">
                        <label for="generatePwLength" class="col-sm-4 control-label"><?php echo $_smarty_tpl->tpl_vars['LANG']->value['generatePassword']['pwLength'];?>
</label>
                        <div class="col-sm-8">
                            <input type="number" min="8" max="64" value="12" step="1" class="form-control input-inline input-inline-100" id="inputGeneratePasswordLength">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="generatePwOutput" class="col-sm-4 control-label"><?php echo $_smarty_tpl->tpl_vars['LANG']->value['generatePassword']['generatedPw'];?>
</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="inputGeneratePasswordOutput">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-8 col-sm-offset-4">
                            <button type="submit" class="btn btn-default btn-sm">
                                <i class="fas fa-plus fa-fw"></i>
                                <?php echo $_smarty_tpl->tpl_vars['LANG']->value['generatePassword']['generateNew'];?>

                            </button>
                            <button type="button" class="btn btn-default btn-sm copy-to-clipboard" data-clipboard-target="#inputGeneratePasswordOutput">
                                <img src="<?php echo $_smarty_tpl->tpl_vars['WEB_ROOT']->value;?>
/assets/img/clippy.svg" alt="Copy to clipboard" width="15">
                                <?php echo $_smarty_tpl->tpl_vars['LANG']->value['copy'];?>

                            </button>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">
                        <?php echo $_smarty_tpl->tpl_vars['LANG']->value['close'];?>

                    </button>
                    <button type="button" class="btn btn-primary" id="btnGeneratePasswordInsert" data-clipboard-target="#inputGeneratePasswordOutput">
                        <?php echo $_smarty_tpl->tpl_vars['LANG']->value['generatePassword']['copyAndInsert'];?>

                    </button>
                </div>
            </div>
        </div>
    </div>
</form>
<?php }
}
