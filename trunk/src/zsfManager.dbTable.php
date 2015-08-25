<?php

class zsfManager_dbTable extends zsfManager
{
	function __construct(&$dbTools)
	{
		self::__construct();
		$this->setup_dbTools($dbTools);
	}
}

?>