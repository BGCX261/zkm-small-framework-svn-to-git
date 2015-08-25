<?php

class zsf_action extends projectAction
{
	public
	function __construct(zsfManager &$zsfManager, $key, $label)
	{
		$this->zsfManager =& $zsfManager;
		$this->key = $key;
		$this->label = $label;
	}

	function isEnable()
	{
		
	}

	function zsfActionExec()
	{
		$isOk = true;
		return $isOk;
	}
}

?>