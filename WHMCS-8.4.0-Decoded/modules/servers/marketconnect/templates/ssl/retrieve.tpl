{if $errorMessage}

    <div class="alert alert-warning">
        <i class="fas fa-times fa-fw"></i>
        {$errorMessage}
    </div>

    <p>{lang key='ssl.certError1'}</p>
    <p>{lang key='ssl.certError2'}</p>
    <p>{lang key='ssl.certError3'}</p>
    <br><br>

{else}

    <div class="alert alert-success">
        <i class="fas fa-check fa-fw"></i>
        {lang key='ssl.retrieved'}
    </div>

    <p>{lang key='ssl.copyCert'}</p>

    <textarea id="inputCertificate" rows="15" class="form-control" readonly="readonly">{$certificate}</textarea>
    <br>
    <button type="button" class="btn btn-default btn-sm copy-to-clipboard pull-right float-right" data-clipboard-target="#inputCertificate">
        <i aria-hidden="true" class="far fa-clipboard-list fa-lg" title="{lang key='copyToClipboard'}"></i>
        {lang key='copyToClipboard'}
    </button>
    <div class="clearfix"></div>

    <br>

    <div class="well">
        <h4>{lang key='ssl.installing'}</h4>
        <p>{lang key='ssl.howToInstall'}</p>
        <p>{lang key='ssl.installFurtherInfo' anchor='<a href="https://knowledge.digicert.com/solution/SO16226.html" target="_blank">' endAnchor='</a>'}</p>
    </div>

{/if}
