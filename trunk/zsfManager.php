<?php
require_once('src/init.php');

$GLOBALS['babelTools'] = new babelTools($filePath=__DIR__.'/lang', $langAvailble=array('EN', 'IT', 'FR'), $langDefault='EN');

$zsfManager = new zsfManager();
$actionKey = $zsfManager->getSelected_actionKey();

$urlRedirect = './';

try
{
	$zsfManager->actionExec($actionKey);
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