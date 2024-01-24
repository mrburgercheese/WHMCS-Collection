<div class="alert alert-success">
    <i class="fas fa-check fa-fw"></i>
    {lang key='ssl.reissueSuccess'}
</div>

{if $approverEmail}
{lang key="ssl.reissueSuccessInfo" approverEmail=$approverEmail}
{else}
{lang key="ssl.reissueSuccessInfo" approverEmail={lang key='ssl.defaultcontacts'}}
{/if}

<br>

<div class="well">
    {lang key='ssl.approverEmailProcess'}
</div>
