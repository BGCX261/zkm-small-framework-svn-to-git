<?php

require_once('src/init.php');

$zsfManager = new zsfManager();
$actionKey = $zsfManager->getSelected_actionKey();

try
{
	$zsfAction->actionExec($actionKey);
}
catch (Exception $e)
{
	msgReporting::addMsg_byProjectAction($action);
	msgReporting::redirectTo($urlRedirect);
	exit;
}

msgReporting::addMsgText(msgLevel_green, __('Welcome to Iride Call.'));
msgReporting::redirectTo($urlRedirect);
exit;

?>