<?php
/* Smarty version 3.1.36, created on 2022-09-24 20:16:10
  from '/home/whmnodec/public_html/manage/templates/twenty-one/includes/tablelist.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.36',
  'unifunc' => 'content_632f658a5f2824_20791365',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'cc3c3cf260197ca93915ae3e68882aba595e3840' => 
    array (
      0 => '/home/whmnodec/public_html/manage/templates/twenty-one/includes/tablelist.tpl',
      1 => 1655190152,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_632f658a5f2824_20791365 (Smarty_Internal_Template $_smarty_tpl) {
if ((isset($_smarty_tpl->tpl_vars['filterColumn']->value)) && $_smarty_tpl->tpl_vars['filterColumn']->value) {
echo '<script'; ?>
>
    if (typeof(buildFilterRegex) !== "function") {
        function buildFilterRegex(filterValue) {
            if (filterValue.indexOf('&') === -1) {
                return '[~>]\\s*' + jQuery.fn.dataTable.util.escapeRegex(filterValue) + '\\s*[<~]';
            } else {
                var tempDiv = document.createElement('div');
                tempDiv.innerHTML = filterValue;
                return '\\s*' + jQuery.fn.dataTable.util.escapeRegex(tempDiv.innerText) + '\\s*';
            }
        }
    }

    jQuery(document).ready(function () {
        jQuery(".view-filter-btns a").click(function (e) {
            var filterValue = jQuery(this).find("span").not('.badge').html().trim(),
                dataTable = jQuery('#table<?php echo $_smarty_tpl->tpl_vars['tableName']->value;?>
').DataTable(),
                filterValueRegex;
            if (jQuery(this).hasClass('active')) {
                <?php if (!(isset($_smarty_tpl->tpl_vars['dontControlActiveClass']->value)) || !$_smarty_tpl->tpl_vars['dontControlActiveClass']->value) {?>
                    jQuery(this).removeClass('active');
                    jQuery(this).find("i.far.fa-dot-circle").removeClass('fa-dot-circle').addClass('fa-circle');
                <?php }?>
                dataTable.column(<?php echo $_smarty_tpl->tpl_vars['filterColumn']->value;?>
).search('').draw();
            } else {
                <?php if (!(isset($_smarty_tpl->tpl_vars['dontControlActiveClass']->value)) || !$_smarty_tpl->tpl_vars['dontControlActiveClass']->value) {?>
                    jQuery('.view-filter-btns .list-group-item').removeClass('active');
                    jQuery('i.far.fa-dot-circle').removeClass('fa-dot-circle').addClass('fa-circle');
                    jQuery(this).addClass('active');
                    jQuery(this).find(jQuery("i.far.fa-circle")).removeClass('fa-circle').addClass('fa-dot-circle');
                <?php }?>
                filterValueRegex = buildFilterRegex(filterValue);
                dataTable.column(<?php echo $_smarty_tpl->tpl_vars['filterColumn']->value;?>
)
                    .search(filterValueRegex, true, false, false)
                    .draw();
            }

            // Prevent jumping to the top of the page when no matching tag is found.
            e.preventDefault();
        });
    });
<?php echo '</script'; ?>
>
<?php }?>

<?php echo '<script'; ?>
>
    // The ready function is being called twice on page load.
    var alreadyReady = false;
    jQuery(document).ready( function () {
        var table = jQuery("#table<?php echo $_smarty_tpl->tpl_vars['tableName']->value;?>
").DataTable({
            "dom": '<"listtable"fit>pl',<?php if ((isset($_smarty_tpl->tpl_vars['noPagination']->value)) && $_smarty_tpl->tpl_vars['noPagination']->value) {?>
            "paging": false,<?php }
if ((isset($_smarty_tpl->tpl_vars['noInfo']->value)) && $_smarty_tpl->tpl_vars['noInfo']->value) {?>
            "info": false,<?php }
if ((isset($_smarty_tpl->tpl_vars['noSearch']->value)) && $_smarty_tpl->tpl_vars['noSearch']->value) {?>
            "filter": false,<?php }
if ((isset($_smarty_tpl->tpl_vars['noOrdering']->value)) && $_smarty_tpl->tpl_vars['noOrdering']->value) {?>
            "ordering": false,<?php }?>
            "responsive": true,
            "oLanguage": {
                "sEmptyTable":     "<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['lang'][0], array( array('key'=>'norecordsfound'),$_smarty_tpl ) );?>
",
                "sInfo":           "<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['lang'][0], array( array('key'=>'tableshowing'),$_smarty_tpl ) );?>
",
                "sInfoEmpty":      "<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['lang'][0], array( array('key'=>'tableempty'),$_smarty_tpl ) );?>
",
                "sInfoFiltered":   "<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['lang'][0], array( array('key'=>'tablefiltered'),$_smarty_tpl ) );?>
",
                "sInfoPostFix":    "",
                "sInfoThousands":  ",",
                "sLengthMenu":     "<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['lang'][0], array( array('key'=>'tablelength'),$_smarty_tpl ) );?>
",
                "sLoadingRecords": "<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['lang'][0], array( array('key'=>'tableloading'),$_smarty_tpl ) );?>
",
                "sProcessing":     "<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['lang'][0], array( array('key'=>'tableprocessing'),$_smarty_tpl ) );?>
",
                "sSearch":         "",
                "sZeroRecords":    "<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['lang'][0], array( array('key'=>'norecordsfound'),$_smarty_tpl ) );?>
",
                "oPaginate": {
                    "sFirst":    "<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['lang'][0], array( array('key'=>'tablepagesfirst'),$_smarty_tpl ) );?>
",
                    "sLast":     "<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['lang'][0], array( array('key'=>'tablepageslast'),$_smarty_tpl ) );?>
",
                    "sNext":     "<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['lang'][0], array( array('key'=>'tablepagesnext'),$_smarty_tpl ) );?>
",
                    "sPrevious": "<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['lang'][0], array( array('key'=>'tablepagesprevious'),$_smarty_tpl ) );?>
"
                }
            },
            "pageLength": 10,
            "order": [
                [
                    <?php if ((isset($_smarty_tpl->tpl_vars['startOrderCol']->value)) && $_smarty_tpl->tpl_vars['startOrderCol']->value) {
echo $_smarty_tpl->tpl_vars['startOrderCol']->value;
} else { ?>0<?php }?>,
                    "asc"
                ]
            ],
            "lengthMenu": [
                [10, 25, 50, -1],
                [10, 25, 50, "<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['lang'][0], array( array('key'=>'tableviewall'),$_smarty_tpl ) );?>
"]
            ],
            "aoColumnDefs": [
                {
                    "bSortable": false,
                    "aTargets": [
                        <?php if ((isset($_smarty_tpl->tpl_vars['noSortColumns']->value)) && $_smarty_tpl->tpl_vars['noSortColumns']->value !== '') {
echo $_smarty_tpl->tpl_vars['noSortColumns']->value;
}?>
                    ]
                },
                {
                    "sType": "string",
                    "aTargets": [
                        <?php if ((isset($_smarty_tpl->tpl_vars['filterColumn']->value)) && $_smarty_tpl->tpl_vars['filterColumn']->value) {
echo $_smarty_tpl->tpl_vars['filterColumn']->value;
}?>
                    ]
                }
            ],
            "stateSave": true
        });

        <?php if ((isset($_smarty_tpl->tpl_vars['filterColumn']->value)) && $_smarty_tpl->tpl_vars['filterColumn']->value) {?>
        // Highlight remembered filter on page re-load
        var rememberedFilterTerm = table.state().columns[<?php echo $_smarty_tpl->tpl_vars['filterColumn']->value;?>
].search.search;
        if (rememberedFilterTerm && !alreadyReady) {
            // This should only run on the first "ready" event.
            jQuery(".view-filter-btns a span").each(function (index) {
                if (buildFilterRegex(jQuery(this).text().trim()) == rememberedFilterTerm) {
                    jQuery(this).parent('a').addClass('active');
                    jQuery(this).parent('a').find('i').removeClass('fa-circle').addClass('fa-dot-circle');
                }
            });
        }
        <?php }?>
    alreadyReady = true;
    });
<?php echo '</script'; ?>
>
<?php }
}
