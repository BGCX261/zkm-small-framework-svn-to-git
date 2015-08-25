<?php

class defineTools
{
	function define($group, $key, $value, $label)
	{
		if (isset($GLOBALS['defineTools'][$group][$value]))
		{
			BugTRACK('['.__class__.'::'.__function__.'] redeclared ('."$group, $key, $value, $label".')');
			die;
		}

		$GLOBALS['defineTools'][$group][$value]['value'] = $value;
		$GLOBALS['defineTools'][$group][$value]['label'] = $label;
		$GLOBALS['defineTools'][$group][$value]['key'] = $key;
		define($key, $value);
	}

	function get_groupList($group)
	{
		return $GLOBALS['defineTools'][$group];
	}
}

?>