<p>{lang key='ssl.reissueInfo1'}</p>

<div class="alert alert-info">
    <i class="fas fa-info-circle fa-fw"></i>
    {lang key='ssl.reissueInfo2'}
</div>

<h2>{lang key='sslserverinfo'}</h2>

<p>{lang key='sslserverinfodetails'}</p>

{if $errorMessage}
    <div class="alert alert-danger">
        <i class="fas fa-times"></i>
        {$errorMessage}
    </div>
{/if}

<form method="post" action="clientarea.php?action=productdetails">
    <input type="hidden" name="id" value="{$serviceid}">
    <input type="hidden" name="addonId" value="{$addonid}">
    <input type="hidden" name="modop" value="custom">
    <input type="hidden" name="a" value="{$actionName}">

    <div class="form-group">
        <label for="inputCsr">{lang key='sslcsr'}</label>
        <textarea name="csr" id="inputCsr" rows="10" class="form-control">{if $csr}{$csr}{else}-----BEGIN CERTIFICATE REQUEST-----
-----END CERTIFICATE REQUEST-----{/if}</textarea>
    </div>

    <p class="text-center">
        <button type="submit" class="btn btn-primary">
            Continue
        </button>
        <button type="reset" class="btn btn-default">
            Cancel
        </button>
    </p>

</form>

<br><br>
