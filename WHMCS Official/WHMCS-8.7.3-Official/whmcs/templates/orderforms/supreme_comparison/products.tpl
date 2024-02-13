<!-- Product Recommendations CSS -->
<link type="text/css" rel="stylesheet" href="{$BASE_PATH_CSS}/recommendations.min.css" property="stylesheet" />
<!-- Core CSS -->
<link rel="stylesheet" type="text/css" href="{assetPath file="style.css"}" property="stylesheet" />
<script>
    jQuery(document).ready(function () {
        jQuery('#btnShowSidebar').click(function () {
            if (jQuery(".product-selection-sidebar").is(":visible")) {
                jQuery('.row-product-selection').css('left','0');
                jQuery('.product-selection-sidebar').fadeOut();
                jQuery('#btnShowSidebar').html('<i class="fas fa-arrow-circle-right"></i> {$LANG.showMenu}');
            } else {
                jQuery('.product-selection-sidebar').fadeIn();
                jQuery('.row-product-selection').css('left','300px');
                jQuery('#btnShowSidebar').html('<i class="fas fa-arrow-circle-left"></i> {$LANG.hideMenu}');
            }
        });
    });
</script>

{if $showSidebarToggle}
    <button type="button" class="btn btn-default btn-sm" id="btnShowSidebar">
        <i class="fas fa-arrow-circle-right"></i>
        {$LANG.showMenu}
    </button>
{/if}
<div class="row row-product-selection">
    <div class="col-md-3 sidebar product-selection-sidebar" id="supremeComparisonSidebar">
        {include file="orderforms/standard_cart/sidebar-categories.tpl"}
    </div>
    <div class="col-md-12">
        <div id="order-supreme_comparison">
            <div class="product-group-heading">
                <div class="product-group-headline">
                    {if $productGroup.headline}
                        {$productGroup.headline}
                    {else}
                        {$productGroup.name}
                    {/if}
                </div>
                {if $productGroup.tagline}
                    <div class="product-group-tagline">
                        {$productGroup.tagline}
                    </div>
                {/if}
                {if $errormessage}
                    <div class="alert alert-danger">
                        {$errormessage}
                    </div>
                {elseif !$productGroup}
                    <div class="alert alert-info">
                        {lang key='orderForm.selectCategory'}
                    </div>
                {/if}
            </div>
            <div id="products" class="price-table-container">
                <ul>
                    {$count = 1}
                    {foreach $products as $product}
                        {$idPrefix = ($product.bid) ? ("bundle"|cat:$product.bid) : ("product"|cat:$product.pid)}
                        <li id="{$idPrefix}">
                            <div class="price-table">
                                <div class="product-icon">
                                    <img src="{assetPath ns="img" file="bg{$count}.png"}" width="155" height="95" alt="Product {$product@iteration}" />
                                </div>
                                <div class="product-title">
                                    <h3 id="{$idPrefix}-name" class="font-size-24">
                                        {$product.name}
                                    </h3>
                                    {if $product.tagLine}
                                        <p id="{$idPrefix}-tag-line">
                                            {$product.tagLine}
                                        </p>
                                    {/if}
                                </div>
                                {if $product.isFeatured}
                                    <div class="featured-product-background">
                                        <span class="featured-product">{$LANG.featuredProduct|upper}</span>
                                    </div>
                                {/if}
                                <div class="product-body">
                                    <ul id="{$idPrefix}-description">
                                        {foreach $product.features as $feature => $value}
                                            <li id="{$idPrefix}-feature{$value@iteration}">
                                                <span>{$value}</span> {$feature}
                                            </li>
                                        {foreachelse}
                                            <li id="{$idPrefix}-description">
                                                {$product.description}
                                            </li>
                                        {/foreach}
                                        {if !empty($product.features) && $product.featuresdesc}
                                            <li id="{$idPrefix}-feature-description">
                                                {$product.featuresdesc}
                                            </li>
                                        {/if}
                                    </ul>
                                    <div class="price-area">
                                        <div class="price" id="{$idPrefix}-price">
                                            {if $product.bid}
                                                {if $product.displayprice}
                                                    <div class="price-label">{$LANG.bundledeal}</div>
                                                    <span>{$product.displayPriceSimple}</span>
                                                {else}
                                                    <div class="price-single-line">
                                                        {$LANG.bundledeal}
                                                    </div>
                                                {/if}
                                            {elseif $product.paytype eq "free"}
                                                <div class="price-single-line">
                                                    <span>{$LANG.orderfree}</span>
                                                </div>
                                            {elseif $product.paytype eq "onetime"}
                                                <div class="price-label">{$LANG.orderpaymenttermonetime}</div>
                                                <span>{$product.pricing.onetime}</span>
                                            {else}
                                                {if $product.pricing.hasconfigoptions}
                                                    <div class="price-label">{$LANG.startingat}</div>
                                                {else}
                                                    <div class="price-label">{$LANG.only}</div>
                                                {/if}
                                                {$product.pricing.minprice.cycleText}
                                                <br>
                                                {if $product.pricing.minprice.setupFee}
                                                    <small>{$product.pricing.minprice.setupFee->toPrefixed()} {$LANG.ordersetupfee}</small>
                                                {/if}
                                            {/if}
                                        </div>
                                        {if $product.qty eq "0"}
                                            <div id="{$idPrefix}-unavailable">
                                                <div class="order-unavailable">
                                                    {$LANG.outofstock}
                                                </div>
                                            </div>
                                        {else}
                                            <a href="{$product.productUrl}" class="btn-order-now" id="{$idPrefix}-order-button"{if $product.hasRecommendations} data-has-recommendations="1"{/if}>
                                                <div class="order-now">
                                                    {$LANG.ordernowbutton}
                                                </div>
                                            </a>
                                        {/if}

                                    </div>
                                </div>
                            </div>
                        </li>
                        {if $count eq 6}
                            {$count = 1}
                        {else}
                            {$count = $count + 1}
                        {/if}
                    {/foreach}
                </ul>
            </div>
            {if count($productGroup.features) > 0}
                <div class="includes-features">
                    <div class="row clearfix">
                        <div class="col-md-12">
                            <div class="head-area">
                                <span class="primary-bg-color">
                                    {$LANG.orderForm.includedWithPlans}
                                </span>
                            </div>
                            <ul class="list-features">
                                {foreach $productGroup.features as $features}
                                    <li>{$features.feature}</li>
                                {/foreach}
                            </ul>
                        </div>
                    </div>
                </div>
            {/if}
        </div>
    </div>
</div>

{include file="orderforms/supreme_comparison/recommendations-modal.tpl"}

<script src="{$BASE_PATH_JS}/whmcs/recommendations.min.js"></script>
