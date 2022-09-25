<?php
/* Smarty version 3.1.36, created on 2022-09-24 19:57:04
  from '/home/whmnodec/public_html/manage/templates/twenty-one/knowledgebase.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.36',
  'unifunc' => 'content_632f61106565c6_75197973',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'cb06941450011ac085f51569bc09f971b3478770' => 
    array (
      0 => '/home/whmnodec/public_html/manage/templates/twenty-one/knowledgebase.tpl',
      1 => 1655190152,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_632f61106565c6_75197973 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'/home/whmnodec/public_html/manage/vendor/smarty/smarty/libs/plugins/modifier.truncate.php','function'=>'smarty_modifier_truncate',),));
?>
<form role="form" method="post" action="<?php echo routePath('knowledgebase-search');?>
" class="mb-4">
    <div class="input-group input-group-lg kb-search">
        <input type="text" id="inputKnowledgebaseSearch" name="search" class="form-control font-weight-light" placeholder="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['lang'][0], array( array('key'=>'clientHomeSearchKb'),$_smarty_tpl ) );?>
" />
        <div class="input-group-append">
            <button type="submit" id="btnKnowledgebaseSearch" class="btn btn-primary btn-input-padded-responsive">
                <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['lang'][0], array( array('key'=>'search'),$_smarty_tpl ) );?>

            </button>
        </div>
    </div>
</form>

<?php if ($_smarty_tpl->tpl_vars['kbcats']->value) {?>
    <div class="row">
        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['kbcats']->value, 'category');
$_smarty_tpl->tpl_vars['category']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['category']->value) {
$_smarty_tpl->tpl_vars['category']->do_else = false;
?>
            <div class="col-xl-6">
                <div class="card kb-category mb-4">
                    <a href="<?php ob_start();
echo $_smarty_tpl->tpl_vars['category']->value['id'];
$_prefixVariable1 = ob_get_clean();
ob_start();
echo $_smarty_tpl->tpl_vars['category']->value['urlfriendlyname'];
$_prefixVariable2 = ob_get_clean();
echo routePath('knowledgebase-category-view',$_prefixVariable1,$_prefixVariable2);?>
" class="card-body" data-id="<?php echo $_smarty_tpl->tpl_vars['category']->value['id'];?>
">
                        <span class="h5 m-0">
                            <span class="badge badge-info float-right">
                                <?php ob_start();
if ($_smarty_tpl->tpl_vars['category']->value['numarticles'] != 1) {
echo "s";
}
$_prefixVariable3=ob_get_clean();
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['lang'][0], array( array('key'=>"knowledgebase.numArticle".$_prefixVariable3,'num'=>$_smarty_tpl->tpl_vars['category']->value['numarticles']),$_smarty_tpl ) );?>

                            </span>
                            <i class="fal fa-folder fa-fw"></i>
                            <?php echo $_smarty_tpl->tpl_vars['category']->value['name'];?>

                            <?php if ($_smarty_tpl->tpl_vars['category']->value['editLink']) {?>
                                <button class="btn btn-sm btn-default show-on-card-hover" id="btnEditCategory-<?php echo $_smarty_tpl->tpl_vars['category']->value['id'];?>
" data-url="<?php echo $_smarty_tpl->tpl_vars['category']->value['editLink'];?>
" type="button">
                                    <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['lang'][0], array( array('key'=>"edit"),$_smarty_tpl ) );?>

                                </button>
                            <?php }?>
                        </span>
                        <p class="m-0 text-muted"><small><?php echo $_smarty_tpl->tpl_vars['category']->value['description'];?>
</small></p>
                    </a>
                </div>
            </div>
        <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
    </div>
<?php } else { ?>
    <?php ob_start();
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['lang'][0], array( array('key'=>'knowledgebasenoarticles'),$_smarty_tpl ) );
$_prefixVariable4=ob_get_clean();
$_smarty_tpl->_subTemplateRender(((string)$_smarty_tpl->tpl_vars['template']->value)."/includes/alert.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('type'=>"info",'msg'=>$_prefixVariable4,'textcenter'=>true), 0, true);
}?>

<?php if ($_smarty_tpl->tpl_vars['kbmostviews']->value) {?>
    <div class="card">
        <div class="card-body">
            <h3 class="card-title m-0">
                <i class="fal fa-star fa-fw"></i>
                <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['lang'][0], array( array('key'=>'knowledgebasepopular'),$_smarty_tpl ) );?>

            </h3>
        </div>
        <div class="list-group list-group-flush">
            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['kbmostviews']->value, 'kbarticle');
$_smarty_tpl->tpl_vars['kbarticle']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['kbarticle']->value) {
$_smarty_tpl->tpl_vars['kbarticle']->do_else = false;
?>
                <a href="<?php ob_start();
echo $_smarty_tpl->tpl_vars['kbarticle']->value['id'];
$_prefixVariable5 = ob_get_clean();
ob_start();
echo $_smarty_tpl->tpl_vars['kbarticle']->value['urlfriendlytitle'];
$_prefixVariable6 = ob_get_clean();
echo routePath('knowledgebase-article-view',$_prefixVariable5,$_prefixVariable6);?>
" class="list-group-item kb-article-item" data-id="<?php echo $_smarty_tpl->tpl_vars['kbarticle']->value['id'];?>
">
                    <i class="fal fa-file-alt fa-fw text-black-50"></i>
                    <?php echo $_smarty_tpl->tpl_vars['kbarticle']->value['title'];?>

                    <?php if ($_smarty_tpl->tpl_vars['kbarticle']->value['editLink']) {?>
                        <button class="btn btn-sm btn-default show-on-card-hover" id="btnEditArticle-<?php echo $_smarty_tpl->tpl_vars['kbarticle']->value['id'];?>
" data-url="<?php echo $_smarty_tpl->tpl_vars['kbarticle']->value['editLink'];?>
" type="button">
                            <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['lang'][0], array( array('key'=>"edit"),$_smarty_tpl ) );?>

                        </button>
                    <?php }?>
                    <small><?php echo smarty_modifier_truncate($_smarty_tpl->tpl_vars['kbarticle']->value['article'],100,"...");?>
</small>
                </a>
            <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
        </div>
    </div>
<?php }
}
}
