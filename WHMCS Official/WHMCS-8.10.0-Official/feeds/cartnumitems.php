<?php

use WHMCS\OrderForm;

require("../init.php");

/*
*** USAGE SAMPLES ***

<script language="javascript" src="feeds/cartnumitems.php"></script>

*/
$cartitems = (new OrderForm())->getNumItemsInCart();

$items = ($cartitems == 1) ? 'item' : 'items';

widgetoutput('' . \Lang::trans('feeds.itemsInBasket', [':count' => $cartitems]) . '');

function widgetoutput($value) {
    echo "document.write('".addslashes($value)."');";
    exit;
}

?>
