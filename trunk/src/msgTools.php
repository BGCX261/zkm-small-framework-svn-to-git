<?php

define('msgLevel_green',	1, true);
define('msgLevel_yellow',	2, true);
define('msgLevel_red',		3, true);

class msgReporting
{
	static
	function redirectTo($url)
	{
		if (!headers_sent())
		{
			header('Location: '.$url);
		}
		else
		{
			echo '<div>redirect to: <a href="'.$url.'">'.$url.'</a></div>';
		}
		exit;
	}

	static
	function getAllMsg($purgeAll=true)
	{
		$result = @$_SESSION['msgReporting'];
		if ($purgeAll)
		{
			unset($_SESSION['msgReporting']);
		}
		return $result;
	}

	static
	function addMsgText($msgLevel, $msgText)
	{
		$_SESSION['msgReporting'][] = self::packMsg($msgLevel, $msgText, htmlentities($msgText));
	}

	static
	function addMsgHtml($msgLevel, $msgHtml)
	{
		$_SESSION['msgReporting'][] = self::packMsg($msgLevel, strip_tags($msgHtml), $msgText);
	}

	static
	function addMsg_byProjectAction(projectAction $projectAction)
	{
		$msgInfo = $projectAction->getMsgReporting();
		$_SESSION['msgReporting'][] = self::packMsg($msgInfo['msgLevel'], $msgInfo['msgText'], $msgInfo['msgHtml']);
	}

	static
	function packMsg($msgLevel, $msgText, $html)
	{
		$result['mtime'] = microtime();
		$result['level'] = $msgLevel;
		$result['text'] = $msgText;
		$result['html'] = $html;
		return $result;
	}
}

?>