<?php

class zsfManager_API extends zsfManager
{
	function __construct(&$urlAPI)
	{
		self::__construct();
		$this->urlAPI = $urlAPI;
	}
}

?>