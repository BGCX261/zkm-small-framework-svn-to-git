<?php

function BugTRACK($values, $label='')
{
	echo '<div style="height:auto;"><strong>'.$label.'</strong><pre style="height:auto;">';
	print_r($values);
	echo '</pre></div>';
}

function tests_isOk(array $testList, $debugValue=false)
{
	$isOk = true;
	if (!empty($testList))
	{
		foreach ($testList as $label => $value)
		{
			$isOk &= $value;
		}
	}

	if ($debugValue)
	{
		BugTRACK(__function__.' --> '.($isOk+0));
		BugTRACK($testList);
		exit;
	}

	return $isOk;
}

?>