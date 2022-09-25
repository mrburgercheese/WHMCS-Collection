<?php
/* Smarty version 3.1.36, created on 2022-09-24 19:31:49
  from '/home/whmnodec/public_html/manage/admin/templates/blend/includes.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.36',
  'unifunc' => 'content_632f5b25e28c91_66876896',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '79f3641fa015075c7b7e223fc5f2927cc2d09592' => 
    array (
      0 => '/home/whmnodec/public_html/manage/admin/templates/blend/includes.tpl',
      1 => 1655190152,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_632f5b25e28c91_66876896 (Smarty_Internal_Template $_smarty_tpl) {
?><form method="post" action="<?php echo routePath('admin-notes-save');?>
" id="frmMyNotes">
    <input type="hidden" name="action" value="savenotes" />
    <input type="hidden" name="token" value="<?php echo $_smarty_tpl->tpl_vars['csrfToken']->value;?>
" />
    <div class="modal fade modal-my-notes" id="modalMyNotes">
        <div class="modal-dialog">
            <div class="modal-content panel-primary">
                <div class="modal-header panel-heading">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title"><?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['global']['mynotes'];?>
</h4>
                </div>
                <div class="modal-body">
                    <textarea id="mynotesbox" name="notes" rows="12" class="form-control"><?php echo $_smarty_tpl->tpl_vars['admin_notes']->value;?>
</textarea>
                </div>
                <div class="modal-footer panel-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['global']['cancel'];?>
</button>
                    <button type="submit" class="btn btn-primary" id="btnMyNotesSave"><?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['global']['savechanges'];?>
</button>
                </div>
            </div>
        </div>
    </div>
</form>

<?php if ($_smarty_tpl->tpl_vars['clientLimitNotification']->value) {?>
    <div class="client-limit-notification client-limit-notification-form panel panel-<?php echo $_smarty_tpl->tpl_vars['clientLimitNotification']->value['class'];?>
" id="clientLimitNotification">
        <div class="panel-heading">
            <button type="button" class="close" id="btnClientLimitNotificationDismiss"><span aria-hidden="true">&times;</span></button>
            <h3 class="panel-title">
                <i class="fas <?php echo $_smarty_tpl->tpl_vars['clientLimitNotification']->value['icon'];?>
"></i>
                <span><?php echo $_smarty_tpl->tpl_vars['clientLimitNotification']->value['title'];?>
</span>
                <small>(<?php echo $_smarty_tpl->tpl_vars['clientLimitNotification']->value['numberOfActiveClients'];?>
 / <?php echo $_smarty_tpl->tpl_vars['clientLimitNotification']->value['clientLimit'];?>
)</small>
            </h3>
        </div>
        <div class="panel-body">
            <p><?php echo $_smarty_tpl->tpl_vars['clientLimitNotification']->value['body'];?>
</p>
            <form method="post" action="<?php echo $_smarty_tpl->tpl_vars['clientLimitNotification']->value['upgradeUrl'];?>
" target="_blank" data-fetch-url="<?php echo routePath('admin-help-license-upgrade-data');?>
">
                <input type="hidden" name="token" value="<?php echo $_smarty_tpl->tpl_vars['csrfToken']->value;?>
">
                <input type="hidden" name="getupgradedata" value="1">
                <input type="hidden" name="license_key" value="" class="input-license-key">
                <input type="hidden" name="member_data" value="" class="input-member-data">
                <div class="links">
                    <a href="#" id="btnClientLimitNotificationDontShowAgain" class="btn btn-xs btn-link pull-right">Don't show this again</a>
                    <button type="submit" class="btn btn-xs btn-<?php echo $_smarty_tpl->tpl_vars['clientLimitNotification']->value['class'];
if ($_smarty_tpl->tpl_vars['clientLimitNotification']->value['autoUpgradeEnabled']) {?> hidden<?php }?>" id="btnClientLimitNotificationUpgrade">Upgrade Now</button>
                    <?php if ($_smarty_tpl->tpl_vars['clientLimitNotification']->value['learnMoreUrl']) {?>
                        <a href="<?php echo $_smarty_tpl->tpl_vars['clientLimitNotification']->value['learnMoreUrl'];?>
" class="btn btn-xs <?php if ($_smarty_tpl->tpl_vars['clientLimitNotification']->value['autoUpgradeEnabled']) {?>btn-<?php echo $_smarty_tpl->tpl_vars['clientLimitNotification']->value['class'];
} else { ?>btn-link<?php }?>" target="_blank">Learn more &raquo;</a>
                    <?php }?>
                </div>
            </form>
        </div>
    </div>
<?php }?>

<div class="modal whmcs-modal fade" id="modalAjax" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content panel panel-primary">
            <div class="modal-header panel-heading" id="modalAjaxHeader">
                <button id="modalAjaxCloseSmall" type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                    <span class="sr-only"><?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['global']['close'];?>
</span>
                </button>
                <h4 class="modal-title" id="modalAjaxTitle"></h4>
            </div>
            <div class="modal-body panel-body" id="modalAjaxBody">
                <?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['global']['loading'];?>

            </div>
            <div class="modal-footer panel-footer" id="modalAjaxFooter">
                <div id="modalFooterLeft"></div>
                <div class="pull-left loader" id="modalAjaxLoader">
                    <i class="fas fa-circle-notch fa-spin"></i>
                    <?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['global']['loading'];?>

                </div>
                <button id="modalAjaxClose" type="button" class="btn btn-default" data-dismiss="modal">
                    <?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['global']['close'];?>

                </button>
                <button type="button" class="btn btn-primary modal-submit" id="modalAjaxSubmit">
                    <?php echo $_smarty_tpl->tpl_vars['_ADMINLANG']->value['global']['submit'];?>

                </button>
            </div>
        </div>
    </div>
</div>
<?php }
}
