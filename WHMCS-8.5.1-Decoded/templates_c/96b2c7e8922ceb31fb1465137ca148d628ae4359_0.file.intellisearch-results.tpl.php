<?php
/* Smarty version 3.1.36, created on 2022-09-24 19:31:49
  from '/home/whmnodec/public_html/manage/admin/templates/blend/intellisearch-results.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.36',
  'unifunc' => 'content_632f5b25e14d33_32567218',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '96b2c7e8922ceb31fb1465137ca148d628ae4359' => 
    array (
      0 => '/home/whmnodec/public_html/manage/admin/templates/blend/intellisearch-results.tpl',
      1 => 1655190152,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_632f5b25e14d33_32567218 (Smarty_Internal_Template $_smarty_tpl) {
?><div class="intellisearchresults" id="intelligentSearchResults">
    <div class="search-header">
        <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['lang'][0], array( array('key'=>"global.numSearchResultsFound",'number'=>'<span class="search-result-count">0</span>'),$_smarty_tpl ) );?>

    </div>
    <div class="outcome search-results">
        <h5>
            <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['lang'][0], array( array('key'=>"clients.title"),$_smarty_tpl ) );?>

            (<span class="count"></span>)
            <i class="far fa-chevron-down"></i>
        </h5>
        <ul data-type="client">
            <li class="template">
                <a href="<?php echo $_smarty_tpl->tpl_vars['ADMIN_WEB_ROOT']->value;?>
/clientssummary.php?userid=[id]">
                    <span class="icon"><i class="fal fa-user"></i></span>
                    <strong>[name] [company_name]</strong>
                    #[id]
                    <span class="label [statusclass]">[status]</span>
                    <em>[email]</em>
                </a>
            </li>
        </ul>
        <h5>
            <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['lang'][0], array( array('key'=>"user.userTab"),$_smarty_tpl ) );?>

            (<span class="count"></span>)
            <i class="far fa-chevron-down"></i>
        </h5>
        <ul data-type="user">
            <li class="template">
                <a
                    [link]
                    class="open-modal"
                    data-modal-title="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['lang'][0], array( array('key'=>'user.manageUserEmail','email'=>'[email]'),$_smarty_tpl ) );?>
"
                    data-modal-size="modal-lg"
                    data-btn-submit-label="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['lang'][0], array( array('key'=>'global.save'),$_smarty_tpl ) );?>
"
                    data-btn-submit-id="btnUpdateUser"
                >
                    <span class="icon"><i class="fal fa-user"></i></span>
                    <strong>[name]</strong>
                    #[id]
                    <em>[email]</em>
                </a>
            </li>
        </ul>
        <h5>
            <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['lang'][0], array( array('key'=>"clientsummary.contacts"),$_smarty_tpl ) );?>

            (<span class="count"></span>)
            <i class="far fa-chevron-down"></i>
        </h5>
        <ul data-type="contact">
            <li class="template">
                <a href="<?php echo $_smarty_tpl->tpl_vars['ADMIN_WEB_ROOT']->value;?>
/clientscontacts.php?userid=[user_id]&contactid=[id]">
                    <span class="icon"><i class="fal fa-user"></i></span>
                    <strong>[name] [company_name]</strong>
                    #[id]
                    <em>[email]</em>
                </a>
            </li>
        </ul>
        <h5>
            <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['lang'][0], array( array('key'=>"services.title"),$_smarty_tpl ) );?>

            (<span class="count"></span>)
            <i class="far fa-chevron-down"></i>
        </h5>
        <ul data-type="service">
            <li class="template">
                <a href="<?php echo $_smarty_tpl->tpl_vars['ADMIN_WEB_ROOT']->value;?>
/clientsservices.php?userid=[user_id]&id=[id]">
                    <span class="icon"><i class="fal fa-cube"></i></span>
                    <strong>[product_name] - [domain]</strong>
                    <span class="label [statusclass]">[status]</span>
                    <em>[client_name] [client_company_name] #[user_id]</em>
                </a>
            </li>
        </ul>
        <h5>
            <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['lang'][0], array( array('key'=>"domains.title"),$_smarty_tpl ) );?>

            (<span class="count"></span>)
            <i class="far fa-chevron-down"></i>
        </h5>
        <ul data-type="domain">
            <li class="template">
                <a href="<?php echo $_smarty_tpl->tpl_vars['ADMIN_WEB_ROOT']->value;?>
/clientsdomains.php?userid=[user_id]&id=[id]">
                    <span class="icon"><i class="fal fa-globe-americas"></i></span>
                    <strong>[domain]</strong>
                    <span class="label [statusclass]">[status]</span>
                    <em>[client_name] [client_company_name] #[user_id]</em>
                </a>
            </li>
        </ul>
        <h5>
            <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['lang'][0], array( array('key'=>"invoices.title"),$_smarty_tpl ) );?>

            (<span class="count"></span>)
            <i class="far fa-chevron-down"></i>
        </h5>
        <ul data-type="invoice">
            <li class="template">
                <a href="<?php echo $_smarty_tpl->tpl_vars['ADMIN_WEB_ROOT']->value;?>
/invoices.php?action=edit&id=[id]">
                    <span class="icon"><i class="fal fa-file-invoice"></i></span>
                    <strong>Invoice #[number]</strong>
                    <span class="label [statusclass]">[status]</span>
                    <em>[client_name] [client_company_name] #[user_id]</em>
                </a>
            </li>
        </ul>
        <h5>
            <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['lang'][0], array( array('key'=>"support.supporttickets"),$_smarty_tpl ) );?>

            (<span class="count"></span>)
            <i class="far fa-chevron-down"></i>
        </h5>
        <ul data-type="ticket">
            <li class="template">
                <a href="<?php echo $_smarty_tpl->tpl_vars['ADMIN_WEB_ROOT']->value;?>
/supporttickets.php?action=view&id=[id]">
                    <span class="icon"><i class="fal fa-comments"></i></span>
                    <strong>Ticket #[mask]</strong>
                    <em>[subject]</em>
                </a>
            </li>
        </ul>
        <h5>
            <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['lang'][0], array( array('key'=>"search.otherResults"),$_smarty_tpl ) );?>

            (<span class="count"></span>)
            <i class="far fa-chevron-down"></i>
        </h5>
        <ul data-type="other">
            <li class="template">
                <a href="<?php echo $_smarty_tpl->tpl_vars['ADMIN_WEB_ROOT']->value;?>
/[href]">
                    <span class="icon"><i class="[icon]"></i></span>
                    <strong>[title]</strong>
                    <em>[subTitle]</em>
                </a>
            </li>
        </ul>
    </div>
    <div class="outcome search-in-progress">
        <i class="fas fa-spinner fa-spin"></i>
        <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['lang'][0], array( array('key'=>"search.performingSearch"),$_smarty_tpl ) );?>

    </div>
    <div class="outcome search-no-results">
        <i class="fas fa-exclamation-triangle"></i>
        <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['lang'][0], array( array('key'=>"search.noResultsFound"),$_smarty_tpl ) );?>
.<br>
        <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['lang'][0], array( array('key'=>"search.tryAlternativeSearchTerm"),$_smarty_tpl ) );?>
.
    </div>
    <div class="outcome session-expired">
        <i class="fas fa-exclamation-triangle"></i>
        <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['lang'][0], array( array('key'=>"search.sessionExpired"),$_smarty_tpl ) );?>
.<br>
        <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['lang'][0], array( array('key'=>"search.refreshAndRetry"),$_smarty_tpl ) );?>
.
    </div>
    <div class="outcome search-warning">
        <i class="fas fa-exclamation-triangle"></i>
        <span class="warning-msg"></span>
    </div>
    <div class="outcome error">
        <i class="fas fa-exclamation-triangle"></i>
        <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['lang'][0], array( array('key'=>"global.erroroccurred"),$_smarty_tpl ) );?>
.<br>
        <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['lang'][0], array( array('key'=>"global.seeConsoleLog"),$_smarty_tpl ) );?>
.
    </div>
    <div class="search-footer">
        <a href="#" class="collapse-toggle" data-lang-collapse="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['lang'][0], array( array('key'=>"global.collapseAll"),$_smarty_tpl ) );?>
" data-lang-expand="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['lang'][0], array( array('key'=>"global.expandAll"),$_smarty_tpl ) );?>
"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['lang'][0], array( array('key'=>"global.collapseAll"),$_smarty_tpl ) );?>
</a>
        <span class="realtime"><input type="checkbox" id="intelliSearchRealtime" data-size="mini" data-label-text="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['lang'][0], array( array('key'=>"search.autoSearchOnType"),$_smarty_tpl ) );?>
" data-on-color="info" data-url="<?php echo routePath('admin-search-intellisearch-settings-autosearch');?>
"<?php if ($_smarty_tpl->tpl_vars['intelligentSearch']->value['autoSearchEnabled']) {?> checked<?php }?>></span>
        <span class="hide-inactive"><input type="checkbox" id="intelliSearchHideInactiveSwitch" data-size="mini" data-label-text="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['lang'][0], array( array('key'=>"global.hideInactive"),$_smarty_tpl ) );?>
" checked="checked"></span>
    </div>
    <div class="hidden">
        <a class="search-more-results" data-type="placeholder">
            <i class="fas fa-info-circle"></i>
            <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['lang'][0], array( array('key'=>"search.showMoreResults"),$_smarty_tpl ) );?>
.
        </a>
    </div>
</div>
<?php }
}
