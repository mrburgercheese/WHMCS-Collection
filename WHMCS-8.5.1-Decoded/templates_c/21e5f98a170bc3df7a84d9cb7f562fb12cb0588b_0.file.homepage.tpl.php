<?php
/* Smarty version 3.1.36, created on 2022-09-24 19:31:49
  from '/home/whmnodec/public_html/manage/templates/twenty-one/homepage.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.36',
  'unifunc' => 'content_632f5b25c545e1_92542142',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '21e5f98a170bc3df7a84d9cb7f562fb12cb0588b' => 
    array (
      0 => '/home/whmnodec/public_html/manage/templates/twenty-one/homepage.tpl',
      1 => 1655190152,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_632f5b25c545e1_92542142 (Smarty_Internal_Template $_smarty_tpl) {
if (!empty($_smarty_tpl->tpl_vars['productGroups']->value) || $_smarty_tpl->tpl_vars['registerdomainenabled']->value || $_smarty_tpl->tpl_vars['transferdomainenabled']->value) {?>
    <h2 class="text-center m-4"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['lang'][0], array( array('key'=>'clientHomePanels.productsAndServices'),$_smarty_tpl ) );?>
</h2>

    <div class="card-columns home">
        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['productGroups']->value, 'productGroup');
$_smarty_tpl->tpl_vars['productGroup']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['productGroup']->value) {
$_smarty_tpl->tpl_vars['productGroup']->do_else = false;
?>

            <div class="card mb-3">
                <div class="card-body p-lg-4 p-xl-5 text-center">
                    <h3 class="card-title pricing-card-title">
                        <?php echo $_smarty_tpl->tpl_vars['productGroup']->value->name;?>

                    </h3>
                    <p><?php echo $_smarty_tpl->tpl_vars['productGroup']->value->tagline;?>
</p>
                    <a href="<?php echo $_smarty_tpl->tpl_vars['productGroup']->value->getRoutePath();?>
" class="btn btn-block btn-outline-primary">
                        <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['lang'][0], array( array('key'=>'browseProducts'),$_smarty_tpl ) );?>

                    </a>
                </div>
            </div>

        <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>

        <?php if ($_smarty_tpl->tpl_vars['registerdomainenabled']->value) {?>
            <div class="card mb-3">
                <div class="card-body p-lg-4 p-xl-5 text-center">
                    <h3 class="card-title pricing-card-title">
                        <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['lang'][0], array( array('key'=>'orderregisterdomain'),$_smarty_tpl ) );?>

                    </h3>
                    <p><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['lang'][0], array( array('key'=>'secureYourDomain'),$_smarty_tpl ) );?>
</p>
                    <a href="<?php echo $_smarty_tpl->tpl_vars['WEB_ROOT']->value;?>
/cart.php?a=add&domain=register" class="btn btn-block btn-outline-primary">
                        <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['lang'][0], array( array('key'=>'navdomainsearch'),$_smarty_tpl ) );?>

                    </a>
                </div>
            </div>
        <?php }?>
        <?php if ($_smarty_tpl->tpl_vars['transferdomainenabled']->value) {?>
            <div class="card mb-3">
                <div class="card-body p-lg-4 p-xl-5 text-center">
                    <h3 class="card-title pricing-card-title">
                        <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['lang'][0], array( array('key'=>'transferYourDomain'),$_smarty_tpl ) );?>

                    </h3>
                    <p><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['lang'][0], array( array('key'=>'transferExtend'),$_smarty_tpl ) );?>
</p>
                    <a href="<?php echo $_smarty_tpl->tpl_vars['WEB_ROOT']->value;?>
/cart.php?a=add&domain=transfer" class="btn btn-block btn-outline-primary">
                        <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['lang'][0], array( array('key'=>'transferYourDomain'),$_smarty_tpl ) );?>

                    </a>
                </div>
            </div>
        <?php }?>
    </div>
<?php }?>

<h2 class="text-center m-4"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['lang'][0], array( array('key'=>'howCanWeHelp'),$_smarty_tpl ) );?>
</h2>

<div class="row my-5 action-icon-btns">
    <div class="col-6 col-md-4 col-lg">
        <a href="<?php echo routePath('announcement-index');?>
" class="card-accent-teal">
            <figure class="ico-container">
                <i class="fal fa-bullhorn"></i>
            </figure>
            <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['lang'][0], array( array('key'=>'announcementstitle'),$_smarty_tpl ) );?>

        </a>
    </div>
    <div class="col-6 col-md-4 col-lg">
        <a href="serverstatus.php" class="card-accent-pomegranate">
            <figure class="ico-container">
                <i class="fal fa-server"></i>
            </figure>
            <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['lang'][0], array( array('key'=>'networkstatustitle'),$_smarty_tpl ) );?>

        </a>
    </div>
    <div class="col-6 col-md-4 col-lg">
        <a href="<?php echo routePath('knowledgebase-index');?>
" class="card-accent-sun-flower">
            <figure class="ico-container">
                <i class="fal fa-book"></i>
            </figure>
            <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['lang'][0], array( array('key'=>'knowledgebasetitle'),$_smarty_tpl ) );?>

        </a>
    </div>
    <div class="col-6 col-md-4 offset-md-2 offset-lg-0 col-lg">
        <a href="<?php echo routePath('download-index');?>
" class="card-accent-asbestos">
            <figure class="ico-container">
                <i class="fal fa-download"></i>
            </figure>
            <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['lang'][0], array( array('key'=>'downloadstitle'),$_smarty_tpl ) );?>

        </a>
    </div>
    <div class="col-6 offset-3 offset-md-0 col-md-4 col-lg">
        <a href="submitticket.php" class="card-accent-green">
            <figure class="ico-container">
                <i class="fal fa-life-ring"></i>
            </figure>
            <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['lang'][0], array( array('key'=>'homepage.submitTicket'),$_smarty_tpl ) );?>

        </a>
    </div>
</div>

<h2 class="text-center m-4"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['lang'][0], array( array('key'=>'homepage.yourAccount'),$_smarty_tpl ) );?>
</h2>

<div class="row my-5 action-icon-btns">
    <div class="col-6 col-md-4 col-lg">
        <a href="clientarea.php" class="card-accent-midnight-blue">
            <figure class="ico-container">
                <i class="fal fa-home"></i>
            </figure>
            <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['lang'][0], array( array('key'=>'homepage.yourAccount'),$_smarty_tpl ) );?>

        </a>
    </div>
    <div class="col-6 col-md-4 col-lg">
        <a href="clientarea.php?action=services" class="card-accent-midnight-blue">
            <figure class="ico-container">
                <i class="far fa-cubes"></i>
            </figure>
            <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['lang'][0], array( array('key'=>'homepage.manageServices'),$_smarty_tpl ) );?>

        </a>
    </div>
    <?php if ($_smarty_tpl->tpl_vars['registerdomainenabled']->value || $_smarty_tpl->tpl_vars['transferdomainenabled']->value || $_smarty_tpl->tpl_vars['numberOfDomains']->value) {?>
        <div class="col-6 col-md-4 col-lg">
            <a href="clientarea.php?action=domains" class="card-accent-midnight-blue">
                <figure class="ico-container">
                    <i class="fal fa-globe"></i>
                </figure>
                <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['lang'][0], array( array('key'=>'homepage.manageDomains'),$_smarty_tpl ) );?>

            </a>
        </div>
    <?php }?>
    <div class="col-6 col-md-4 offset-md-2 offset-lg-0 col-lg">
        <a href="supporttickets.php" class="card-accent-midnight-blue">
            <figure class="ico-container">
                <i class="fal fa-comments"></i>
            </figure>
            <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['lang'][0], array( array('key'=>'homepage.supportRequests'),$_smarty_tpl ) );?>

        </a>
    </div>
    <div class="col-6 offset-3 offset-md-0 col-md-4 col-lg">
        <a href="clientarea.php?action=masspay&all=true" class="card-accent-midnight-blue">
            <figure class="ico-container">
                <i class="fal fa-credit-card"></i>
            </figure>
            <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['lang'][0], array( array('key'=>'homepage.makeAPayment'),$_smarty_tpl ) );?>

        </a>
    </div>
</div>
<?php }
}
