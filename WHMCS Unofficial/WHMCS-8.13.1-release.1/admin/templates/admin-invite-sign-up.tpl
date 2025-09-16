<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>WHMCS - {lang key='apicreds.adminInviteAccept'}</title>

        {\WHMCS\View\Asset::fontCssInclude('open-sans-family.css')}
        <link href="{\WHMCS\Utility\Environment\WebHelper::getAdminBaseUrl()}/templates/login.min.css" rel="stylesheet" />
    </head>
    <body>
        <div class="login-container">
            <h1 class="logo">
                <a href="login.php">
                    <img src="{$BASE_PATH_IMG}/whmcs.png" alt="WHMCS">
                </a>
            </h1>
            <div class="login-body">
                <h4>{lang key='apicreds.setCreds'}</h4>
                {if !empty($errorMsg)}
                    <div id="alertLoginError" class="alert alert-danger text-center" role="alert">
                        {$errorMsg}
                    </div>
                {/if}
                <form method="post" action="{routePathWithQuery('admin-invite-accept', null, "auth_token={$adminInvite['token']}")}">
                    <input type="hidden" name="token" value="{$csrfToken}">
                    <div class="form-group">
                    {if $adminInvite['username']}
                        <input type="text" name="username" class="form-control" placeholder="{$adminInvite['username']}" disabled value="" autofocus="">
                    {else}
                        <input type="text" name="username" class="form-control" placeholder="{lang key='fields.username'}" value="{$username}" autofocus="">
                    {/if}
                    </div>
                    <div class="form-group">
                        <input type="password" name="password" class="form-control" placeholder="{lang key='fields.password'}">
                    </div>
                    <div class="form-group">
                        <input type="password" name="confirmPassword" id="confirmPassword" class="form-control" placeholder="{lang key='login.newpasswordverify'}">
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                        </div>
                        <div class="col-sm-6">
                            <input type="submit" value="{lang key='marketConnect.createAccount'}" class="btn btn-primary btn-block">
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="poweredby text-center">
            <a href="http://www.whmcs.com/" target="_blank">Powered by WHMCS</a>
        </div>
        <script type="text/javascript" src="{\WHMCS\Utility\Environment\WebHelper::getAdminBaseUrl()}/templates/login.min.js"></script>
    </body>
</html>