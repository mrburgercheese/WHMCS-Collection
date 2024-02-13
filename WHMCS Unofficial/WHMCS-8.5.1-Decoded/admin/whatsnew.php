<?php
define("ADMINAREA", true);
require "../init.php";
$aInt = new WHMCS\Admin("View What's New");
$smarty = new WHMCS\Smarty(true);
$highlightTracker = new WHMCS\Notification\VersionFeatureHighlights();
$smarty->assign("features", $highlightTracker->getFeatureHighlights());
if (App::getFromRequest("modal")) {
    $smarty->assign("dismissedForAdmin", $aInt->isFeatureHighlightsDismissedUntilUpdate() ? "1" : "0");
    $response = ['title' => "Thank you for Whmcs WHMNODE", 'body' => "Have fun with this fine release."];
    $aInt->setBodyContent($response);
    $aInt->output();
}
if (App::getFromRequest("dismiss")) {
    check_token("WHMCS.admin.default");
    if (App::getFromRequest("until_next_update")) {
        $aInt->dismissFeatureHighlightsUntilUpdate();
    } else {
        $aInt->dismissFeatureHighlightsForSession();
        $aInt->removeFeatureHighlightsPermanentDismissal();
    }
    $aInt->setBodyContent(["result" => true]);
    $aInt->output();
}

?>