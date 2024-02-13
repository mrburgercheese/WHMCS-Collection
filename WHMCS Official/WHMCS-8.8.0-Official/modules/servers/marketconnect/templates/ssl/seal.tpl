{if $errorMessage}
    <div class="alert alert-danger">
        <i class="fas fa-times fa-fw"></i>
        {$errorMessage}
    </div>
    <p>{lang key='ssl.siteSealError1'}</p>
    <p>{lang key='ssl.certError2'}</p>
    <p>{lang key='ssl.certError3'}</p>
    <br><br>
{else}
    <div class="alert alert-success">
        <i class="fas fa-check fa-fw"></i>
        {lang key='ssl.sealSuccess'}
    </div>
    <p>{lang key='ssl.copyTheSiteSeal'}</p>
    <textarea id="inputSiteSeal" rows="15" class="form-control" readonly="readonly">{$seal}</textarea>
    <br>
    <button type="button" class="btn btn-default btn-sm copy-to-clipboard float-right pull-right" data-clipboard-target="#inputSiteSeal">
        <i aria-hidden="true" class="far fa-clipboard-list fa-lg" title="{lang key='copyToClipboard'}"></i>
        {lang key='copyToClipboard'}
    </button>
    <div class="clearfix"></div>
    <br>
    <div class="well">
        <h4>{lang key='ssl.howToUseSiteSeal'}</h4>
        {if $rapidCertificate}
            <p>{lang key='ssl.rapidSslInstructions'}</p>
        {else}
            <p>{lang key='ssl.siteSealInstructions1'}</p>
            <p>{lang key='ssl.siteSealInstructions2'}</p>
        {/if}
    </div>
{/if}
