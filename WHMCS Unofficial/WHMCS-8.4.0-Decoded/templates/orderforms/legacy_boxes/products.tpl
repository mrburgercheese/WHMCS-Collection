<link rel="stylesheet" type="text/css" href="{assetPath file="style.css"}" />

<div id="order-boxes">

    <div class="pull-md-right float-md-right col-md-9">

        <div class="header-lined">
            <h1 class="font-size-36">{$groupname}</h1>
        </div>

    </div>

    <div class="col-md-3 pull-md-left sidebar hidden-xs hidden-sm d-none d-md-block float-md-left">

        {include file="orderforms/standard_cart/sidebar-categories.tpl"}

    </div>

    <div class="col-md-9 pull-md-right float-md-right">

        <div class="line-padded visible-xs visible-sm d-block d-md-none clearfix">

            {include file="orderforms/standard_cart/sidebar-categories-collapsed.tpl"}

        </div>

        {if !$products && !$errormessage}
            <div class="alert alert-info">
                {lang key='orderForm.selectCategory'}
            </div>
        {else}
            <form method="post" action="{$WEB_ROOT}/cart.php?a=add">

                <div class="fields-container">
                    {foreach from=$products item=product}
                        <div class="field-row clearfix">
                            <div class="col-xs-12 col-12">
                                <label class="radio-inline product-radio"><input type="radio" name="pid" id="pid{$product.pid}" value="{if $product.bid}b{$product.bid}{else}{$product.pid}{/if}"{if $product.qty eq "0"} disabled{/if} /> <strong>{$product.name}</strong> {if $product.stockControlEnabled}<em>({$product.qty} {$LANG.orderavailable})</em>{/if}{if $product.description} - {$product.description}{/if}</label>
                            </div>
                        </div>
                    {/foreach}
                </div>

                <div class="line-padded text-center">
                    <button type="submit" class="btn btn-primary btn-lg">{$LANG.continue} &nbsp;<i class="fas fa-arrow-circle-right"></i></button>
                </div>

            </form>
        {/if}

    </div>

    <div class="clearfix"></div>

    <div class="secure-warning">
        <img src="assets/img/padlock.gif" align="absmiddle" border="0" alt="Secure Transaction" /> &nbsp;{$LANG.ordersecure} (<strong>{$ipaddress}</strong>) {$LANG.ordersecure2}
    </div>

</div>
