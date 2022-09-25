<?php
/* Smarty version 3.1.36, created on 2022-09-24 19:53:29
  from '/home/whmnodec/public_html/manage/templates/orderforms/standard_cart/includes/product-recommendations.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.36',
  'unifunc' => 'content_632f6039840fb6_59640990',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'a31f903ead2b52bafa4fb37a9efe431e5e872598' => 
    array (
      0 => '/home/whmnodec/public_html/manage/templates/orderforms/standard_cart/includes/product-recommendations.tpl',
      1 => 1655190152,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_632f6039840fb6_59640990 (Smarty_Internal_Template $_smarty_tpl) {
if (!empty($_smarty_tpl->tpl_vars['lastProduct']->value)) {?>
<div class="product-added-panel panel card">
    <div class="panel-body card-body">
        <span class="text-muted">
            <i class="far fa-check"></i>&nbsp;<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['lang'][0], array( array('key'=>"recommendations.productAdded"),$_smarty_tpl ) );?>

        </span>
        <div>
            <span class="product-name">&nbsp;<?php echo $_smarty_tpl->tpl_vars['lastProduct']->value['product']['name'];?>
</span>
            <span class="product-group">&nbsp;<?php echo $_smarty_tpl->tpl_vars['lastProduct']->value['product']['productGroup']['name'];?>
</span>
        </div>
        <div>
            <span class="product-price">
                <?php if (!$_smarty_tpl->tpl_vars['lastProduct']->value['pricing']->isFree()) {?>
                    &nbsp;<?php echo $_smarty_tpl->tpl_vars['lastProduct']->value['pricing']->price()->toFull();?>

                    <?php if ($_smarty_tpl->tpl_vars['lastProduct']->value['pricing']->setup() && $_smarty_tpl->tpl_vars['lastProduct']->value['pricing']->setup()->toNumeric() > 0) {?>
                        + <?php echo $_smarty_tpl->tpl_vars['lastProduct']->value['pricing']->setup()->toFull();?>
 <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['lang'][0], array( array('key'=>"ordersetupfee"),$_smarty_tpl ) );?>

                    <?php }?>
                <?php }?>
            </span>
            <span class="product-cycle">&nbsp;<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['lang'][0], array( array('key'=>('orderpaymentterm').($_smarty_tpl->tpl_vars['lastProduct']->value['pricing']->cycle())),$_smarty_tpl ) );?>
</span>
        </div>
    </div>
</div>
<?php }?>
<div class="product-recommendations-container">
    <div class="product-recommendations">
        <?php if (!in_array($_smarty_tpl->tpl_vars['templatefile']->value,array('viewcart','checkout','complete'))) {?>
            <p><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['lang'][0], array( array('key'=>"recommendations.explain.product"),$_smarty_tpl ) );?>
</p>
        <?php } elseif (!$_smarty_tpl->tpl_vars['recommendStyle']->value && $_smarty_tpl->tpl_vars['templatefile']->value != 'complete') {?>
            <p><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['lang'][0], array( array('key'=>"recommendations.explain.generic"),$_smarty_tpl ) );?>
</p>
        <?php } elseif ($_smarty_tpl->tpl_vars['templatefile']->value == 'complete') {?>
            <div>
                <h4 class="float-left pull-left"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['lang'][0], array( array('key'=>"recommendations.title.generic"),$_smarty_tpl ) );?>
</h4>
                <h4 class="text-muted float-right pull-right">
                    <small>
                        <?php if (!empty($_smarty_tpl->tpl_vars['productRecommendations']->value['order'])) {?>
                            <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['lang'][0], array( array('key'=>"recommendations.title.yourOrder"),$_smarty_tpl ) );?>

                        <?php } else { ?>
                            <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['lang'][0], array( array('key'=>"recommendations.title.yourProducts"),$_smarty_tpl ) );?>

                        <?php }?>
                    </small>
                </h4>
                <div class="clearfix"></div>
            </div>
        <?php }?>
        <?php if ($_smarty_tpl->tpl_vars['productRecommendations']->value) {?>
            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['productRecommendations']->value, 'categoryRecommendations', false, 'categoryKey');
$_smarty_tpl->tpl_vars['categoryRecommendations']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['categoryKey']->value => $_smarty_tpl->tpl_vars['categoryRecommendations']->value) {
$_smarty_tpl->tpl_vars['categoryRecommendations']->do_else = false;
?>
                <?php if ($_smarty_tpl->tpl_vars['templatefile']->value == 'complete' && $_smarty_tpl->tpl_vars['categoryKey']->value == 'own' && !empty($_smarty_tpl->tpl_vars['productRecommendations']->value['own']) && !empty($_smarty_tpl->tpl_vars['productRecommendations']->value['order'])) {?>
                    <h4 class="text-muted float-right pull-right">
                        <small><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['lang'][0], array( array('key'=>"recommendations.title.yourProducts"),$_smarty_tpl ) );?>
</small>
                    </h4>
                    <div class="clearfix"></div>
                <?php }?>
                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['categoryRecommendations']->value, 'categoryRecommendation');
$_smarty_tpl->tpl_vars['categoryRecommendation']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['categoryRecommendation']->value) {
$_smarty_tpl->tpl_vars['categoryRecommendation']->do_else = false;
?>
                    <?php if ($_smarty_tpl->tpl_vars['recommendStyle']->value && $_smarty_tpl->tpl_vars['templatefile']->value != 'complete') {?>
                        <p><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['lang'][0], array( array('key'=>"recommendations.explain.ordered",'productName'=>$_smarty_tpl->tpl_vars['categoryRecommendation']->value['name']),$_smarty_tpl ) );?>
</p>
                    <?php }?>
                    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['categoryRecommendation']->value['recommendations'], 'recommendation');
$_smarty_tpl->tpl_vars['recommendation']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['recommendation']->value) {
$_smarty_tpl->tpl_vars['recommendation']->do_else = false;
?>
                        <?php $_smarty_tpl->_assignInScope('price', $_smarty_tpl->tpl_vars['recommendation']->value->pricing()->first());?>
                        <div class="product-recommendation" data-color="<?php echo $_smarty_tpl->tpl_vars['recommendation']->value['color'];?>
" style="border-color:<?php echo $_smarty_tpl->tpl_vars['recommendation']->value->color;?>
;">
                            <div class="header<?php if (!$_smarty_tpl->tpl_vars['recommendation']->value['shortDescription']) {?> header-static<?php }?>">
                                <div class="cta">
                                    <div class="price" style="color:<?php echo $_smarty_tpl->tpl_vars['recommendation']->value->color;?>
;">
                                        <span <?php if (!$_smarty_tpl->tpl_vars['recommendation']->value->isFree()) {?>class="w-hidden hidden"<?php }?>><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['lang'][0], array( array('key'=>"orderfree"),$_smarty_tpl ) );?>
</span>
                                        <?php if (!$_smarty_tpl->tpl_vars['recommendation']->value->isFree() && $_smarty_tpl->tpl_vars['price']->value) {?>
                                            <span class="breakdown-price">
                                            <?php if ($_smarty_tpl->tpl_vars['price']->value->isOneTime()) {?>
                                                <?php echo $_smarty_tpl->tpl_vars['price']->value->price()->toFull();?>

                                            <?php } elseif ($_smarty_tpl->tpl_vars['price']->value->isRecurring()) {?>
                                                <?php echo $_smarty_tpl->tpl_vars['price']->value->breakdownPrice();?>

                                            <?php }?>
                                        </span>
                                        <?php }?>
                                        <?php if (!$_smarty_tpl->tpl_vars['recommendation']->value->isFree() && !is_null($_smarty_tpl->tpl_vars['price']->value->setup()) && $_smarty_tpl->tpl_vars['price']->value->setup()->toNumeric() > 0) {?>
                                            <span class="setup-fee"><small><?php echo $_smarty_tpl->tpl_vars['price']->value->setup()->toFull();?>
&nbsp;<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['lang'][0], array( array('key'=>"ordersetupfee"),$_smarty_tpl ) );?>
</small></span>
                                        <?php }?>
                                    </div>
                                    <a type="button" class="btn btn-sm btn-add" href="<?php echo $_smarty_tpl->tpl_vars['recommendation']->value->getRoutePath();?>
" role="button" style="background-color:<?php echo $_smarty_tpl->tpl_vars['recommendation']->value->color;?>
;">
                                        <span class="text">
                                            <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['lang'][0], array( array('key'=>"addtocart"),$_smarty_tpl ) );?>

                                        </span>
                                            <span class="arrow" style="background-color:<?php echo $_smarty_tpl->tpl_vars['recommendation']->value->color;?>
;">
                                            <i class="fas fa-chevron-right"></i>
                                        </span>
                                    </a>
                                </div>
                                <div class="expander" style="color:<?php echo $_smarty_tpl->tpl_vars['recommendation']->value->color;?>
;">
                                    <?php if ($_smarty_tpl->tpl_vars['recommendation']->value['shortDescription']) {?>
                                        <i class="fas fa-chevron-right rotate" data-toggle="tooltip" data-placement="right" title="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['lang'][0], array( array('key'=>"recommendations.learnMore"),$_smarty_tpl ) );?>
"></i>
                                    <?php } else { ?>
                                        <i class="fas fa-square fa-xs"></i>
                                    <?php }?>
                                </div>
                                <div class="content">
                                    <div class="headline truncate"><?php echo $_smarty_tpl->tpl_vars['recommendation']->value['productGroup']['name'];?>
 - <?php echo $_smarty_tpl->tpl_vars['recommendation']->value['name'];?>
</div>
                                    <div class="tagline truncate">
                                        <?php if (empty($_smarty_tpl->tpl_vars['recommendation']->value['tagline'])) {?>
                                            <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['lang'][0], array( array('key'=>"recommendations.taglinePlaceholder"),$_smarty_tpl ) );?>

                                        <?php } else { ?>
                                            <?php echo $_smarty_tpl->tpl_vars['recommendation']->value['tagline'];?>

                                        <?php }?>
                                    </div>
                                </div>
                            </div>
                            <div class="body clearfix">
                                <p><?php echo $_smarty_tpl->tpl_vars['recommendation']->value['shortDescription'];?>
</p>
                            </div>
                        </div>
                    <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
            <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
        <?php }?>
    </div>
</div>
<?php }
}
