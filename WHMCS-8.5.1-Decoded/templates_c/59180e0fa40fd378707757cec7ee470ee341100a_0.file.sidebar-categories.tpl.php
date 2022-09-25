<?php
/* Smarty version 3.1.36, created on 2022-09-24 19:53:29
  from '/home/whmnodec/public_html/manage/templates/orderforms/standard_cart/sidebar-categories.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.36',
  'unifunc' => 'content_632f603979dc59_49597803',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '59180e0fa40fd378707757cec7ee470ee341100a' => 
    array (
      0 => '/home/whmnodec/public_html/manage/templates/orderforms/standard_cart/sidebar-categories.tpl',
      1 => 1655190152,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:orderforms/standard_cart/sidebar-categories-selector.tpl' => 1,
  ),
),false)) {
function content_632f603979dc59_49597803 (Smarty_Internal_Template $_smarty_tpl) {
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['secondarySidebar']->value, 'panel');
$_smarty_tpl->tpl_vars['panel']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['panel']->value) {
$_smarty_tpl->tpl_vars['panel']->do_else = false;
?>
    <div menuItemName="<?php echo $_smarty_tpl->tpl_vars['panel']->value->getName();?>
" class="panel card card-sidebar mb-3 <?php if ($_smarty_tpl->tpl_vars['panel']->value->getClass()) {
echo $_smarty_tpl->tpl_vars['panel']->value->getClass();
} else { ?>panel-sidebar<?php }
if ($_smarty_tpl->tpl_vars['panel']->value->getExtra('mobileSelect') && $_smarty_tpl->tpl_vars['panel']->value->hasChildren()) {?> hidden-sm hidden-xs d-none d-md-block<?php }?>"<?php if ($_smarty_tpl->tpl_vars['panel']->value->getAttribute('id')) {?> id="<?php echo $_smarty_tpl->tpl_vars['panel']->value->getAttribute('id');?>
"<?php }?>>
        <div class="panel-heading card-header">
            <h3 class="panel-title">
                <?php if ($_smarty_tpl->tpl_vars['panel']->value->hasIcon()) {?>
                    <i class="<?php echo $_smarty_tpl->tpl_vars['panel']->value->getIcon();?>
"></i>&nbsp;
                <?php }?>

                <?php echo $_smarty_tpl->tpl_vars['panel']->value->getLabel();?>


                <?php if ($_smarty_tpl->tpl_vars['panel']->value->hasBadge()) {?>
                    &nbsp;<span class="badge"><?php echo $_smarty_tpl->tpl_vars['panel']->value->getBadge();?>
</span>
                <?php }?>

                <i class="fas fa-chevron-up card-minimise panel-minimise pull-right float-right"></i>
            </h3>
        </div>

        <?php if ($_smarty_tpl->tpl_vars['panel']->value->hasBodyHtml()) {?>
            <div class="panel-body card-body collapsable-card-body">
                <?php echo $_smarty_tpl->tpl_vars['panel']->value->getBodyHtml();?>

            </div>
        <?php }?>

        <?php if ($_smarty_tpl->tpl_vars['panel']->value->hasChildren()) {?>
            <div class="list-group collapsable-card-body<?php if ($_smarty_tpl->tpl_vars['panel']->value->getChildrenAttribute('class')) {?> <?php echo $_smarty_tpl->tpl_vars['panel']->value->getChildrenAttribute('class');
}?>">
                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['panel']->value->getChildren(), 'child');
$_smarty_tpl->tpl_vars['child']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['child']->value) {
$_smarty_tpl->tpl_vars['child']->do_else = false;
?>
                    <?php if ($_smarty_tpl->tpl_vars['child']->value->getUri()) {?>
                        <a menuItemName="<?php echo $_smarty_tpl->tpl_vars['child']->value->getName();?>
" href="<?php echo $_smarty_tpl->tpl_vars['child']->value->getUri();?>
" class="list-group-item list-group-item-action<?php if ($_smarty_tpl->tpl_vars['child']->value->isDisabled()) {?> disabled<?php }
if ($_smarty_tpl->tpl_vars['child']->value->getClass()) {?> <?php echo $_smarty_tpl->tpl_vars['child']->value->getClass();
}
if ($_smarty_tpl->tpl_vars['child']->value->isCurrent()) {?> active<?php }?>"<?php if ($_smarty_tpl->tpl_vars['child']->value->getAttribute('dataToggleTab')) {?> data-toggle="tab"<?php }
if ($_smarty_tpl->tpl_vars['child']->value->getAttribute('target')) {?> target="<?php echo $_smarty_tpl->tpl_vars['child']->value->getAttribute('target');?>
"<?php }?> id="<?php echo $_smarty_tpl->tpl_vars['child']->value->getId();?>
">
                            <?php if ($_smarty_tpl->tpl_vars['child']->value->hasIcon()) {?>
                                <i class="<?php echo $_smarty_tpl->tpl_vars['child']->value->getIcon();?>
"></i>&nbsp;
                            <?php }?>

                            <?php echo $_smarty_tpl->tpl_vars['child']->value->getLabel();?>


                            <?php if ($_smarty_tpl->tpl_vars['child']->value->hasBadge()) {?>
                                &nbsp;<span class="badge"><?php echo $_smarty_tpl->tpl_vars['child']->value->getBadge();?>
</span>
                            <?php }?>
                        </a>
                    <?php } else { ?>
                        <div menuItemName="<?php echo $_smarty_tpl->tpl_vars['child']->value->getName();?>
" class="list-group-item<?php if ($_smarty_tpl->tpl_vars['child']->value->getClass()) {?> <?php echo $_smarty_tpl->tpl_vars['child']->value->getClass();
}?>" id="<?php echo $_smarty_tpl->tpl_vars['child']->value->getId();?>
">
                            <?php if ($_smarty_tpl->tpl_vars['child']->value->hasIcon()) {?>
                                <i class="<?php echo $_smarty_tpl->tpl_vars['child']->value->getIcon();?>
"></i>&nbsp;
                            <?php }?>

                            <?php echo $_smarty_tpl->tpl_vars['child']->value->getLabel();?>


                            <?php if ($_smarty_tpl->tpl_vars['child']->value->hasBadge()) {?>
                                &nbsp;<span class="badge"><?php echo $_smarty_tpl->tpl_vars['child']->value->getBadge();?>
</span>
                            <?php }?>
                        </div>
                    <?php }?>
                <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
            </div>
        <?php }?>

        <?php if ($_smarty_tpl->tpl_vars['panel']->value->hasFooterHtml()) {?>
            <div class="panel-footer card-footer clearfix">
                <?php echo $_smarty_tpl->tpl_vars['panel']->value->getFooterHtml();?>

            </div>
        <?php }?>
    </div>

    <?php if ($_smarty_tpl->tpl_vars['panel']->value->getExtra('mobileSelect') && $_smarty_tpl->tpl_vars['panel']->value->hasChildren()) {?>
                <div class="panel card hidden-lg hidden-md d-md-none<?php if ($_smarty_tpl->tpl_vars['panel']->value->getClass()) {
echo $_smarty_tpl->tpl_vars['panel']->value->getClass();
} else { ?> panel-default<?php }?>"<?php if ($_smarty_tpl->tpl_vars['panel']->value->getAttribute('id')) {?> id="<?php echo $_smarty_tpl->tpl_vars['panel']->value->getAttribute('id');?>
"<?php }?>>
            <?php $_smarty_tpl->_subTemplateRender("file:orderforms/standard_cart/sidebar-categories-selector.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?>
        </div>
    <?php }
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);
}
}
