<?php

require_once('src/init.php');

$zsfManager = new zsfManager();
$actionKey = $zsfManager->getSelected_actionKey();

try
{
	$zsfManager->actionExec($actionKey);
}
catch (Exception $e)
{
	$msgReporting = $action->getMsgReporting();
	echo ('Error! ');
	print_r($msgReporting);
	exit;
}

echo 'action exec';

?>