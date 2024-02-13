<div class="alert alert-success">
    <i class="fas fa-check fa-fw"></i>
    Reissue request submitted successfully!
</div>

<p>Your request to reissue your certificate has been submitted to the certificate authority.</p>

<p>You will receive an email shortly to <em>{if $approverEmail}{$approverEmail}{else}{lang key='ssl.defaultcontacts'}{/if}</em> to approve the certificate.</p>

<p>If you do not receive the email, please check any spam filters and virus protection folders in case the email has been quarantined. If you are still unable to find it, please <a href="submitticket.php">contact support</a>.</p>

<br>

<div class="well">
    <h4>About the Approver Email Process</h4>
    <p>In order to issue an SSL certificate, the Certificate Authority has to validate the authenticity of the certificate order to ensure the request is legitimate and comes from an authorized owner of the domain.</p>
    <p>Email-based domain validation is the most common certificate validation mechanism for certificate orders. The certificate authority compiles a list of approved email addresses using common administrative emails (e.g. admin or webmaster) in combination with the public whois data for the domain. Only one of these emails can be used to confirm ownership.</p>
</div>
