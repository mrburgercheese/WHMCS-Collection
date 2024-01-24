{if $approverEmailChangeSuccess}

    <div class="alert alert-success">
        <i class="fas fa-check"></i>
        {lang key='ssl.approverEmailUpdateSuccess'}
    </div>
    {lang key='ssl.approverEmailUpdateInfo' newApproverEmail=$newApproverEmail}
{else}

    <div class="alert alert-info">
        <i class="fas fa-exclamation-triangle"></i>
        {lang key='ssl.disableWhoisPrivacy'}
    </div>

    <p>{lang key='ssl.selectDcvEmail'}</p>

    {if $errorMessage}
        <div class="alert alert-danger">
            <i class="fas fa-times"></i>
            {$errorMessage} {lang key='errors.tryAgainOrSupport'}
        </div>
    {/if}

    {if count($approverEmails) > 0}

        <form method="post" action="clientarea.php?action=productdetails">
            <input type="hidden" name="id" value="{$serviceid}">
            <input type="hidden" name="modop" value="custom">
            <input type="hidden" name="a" value="{$actionName}">

            <blockquote>
                {foreach $approverEmails as $approverEmail}
                    <label class="radio-inline">
                        <input type="radio" name="approver_email" value="{$approverEmail}"{if $approverEmail@first} checked{/if}>
                        {$approverEmail}
                    </label>
                    <br>
                {/foreach}
            </blockquote>

            <p class="text-center">
                <button type="submit" class="btn btn-primary">
                    Update
                </button>
                <button type="reset" class="btn btn-default">
                    Cancel
                </button>
            </p>

        </form>

    {/if}

{/if}

<br>

<div class="well">
    {lang key='ssl.approverEmailProcess'}
</div>
