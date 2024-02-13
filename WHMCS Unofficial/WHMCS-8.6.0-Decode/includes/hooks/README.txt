The hooks system allows you to extend WHMCS functionality by placing files in the /includes/hooks directory.
WHMCS has a variety of hook points that run when specific events occur (for example, generating an invoice).
To use this system, write your own code and register it with a hook point. WHMCS will execute that code when the hook runs.
For a list of available hook points, see https://developers.whmcs.com/hooks/hook-index/.

To use the example hook code below, copy the code, beginning with '<?php', and paste it into a file in the /includes/hooks directory.
The filename must use the '.php' extension (for example, create_forum_account.php).
Filenames beginning with an underscore '_' will not be loaded.

<?php

if (!defined('WHMCS'))
    die('You cannot access this file directly.');

function create_forum_account($vars) {

    $firstname = $vars['firstname'];
    $lastname = $vars['lastname'];
    $email = $vars['email'];

    // Add the code to create a remote forum account here.

}

add_hook('ClientAdd', 1, 'create_forum_account');
