<form action="clientarea.php" method="post" target="_blank">
    <input type="hidden" name="action" value="productdetails" />
    <input type="hidden" name="id" value="{$serviceid}" />
    <input type="hidden" name="dosinglesignon" value="1" />
    <input type="submit" value="{if $producttype=="hostingaccount"}{$LANG.wpsquared.login}{else}{$LANG.cpanelwhmlogin}{/if}" class="btn btn-primary modulebutton" />
</form>
