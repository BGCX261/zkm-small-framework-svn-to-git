<?php

class projectInfo
{
	public
	function setValue($value)
	{
		$this->value = $value;
	}

	public
	function getValue()
	{
		return $this->value;
	}
}

class projectInfoDbRecord extends projectInfo
{
	var $dbRecord = null;

	function __construct($sqlQuery, $usrFn_packRecord='')
	{
		global $dbTools;

		$result = null;
		if ($sqlQuery)
		{
			$result = $dbTools->getRecord($sqlQuery);
			if (!empty($result) && !empty($usrFn_packRecord) && is_callable($usrFn_packRecord))
			{
				$usrFn($result, $dbRecord);
			}
		}

		$this->setValue($result);
	}
}

class projectInfoDbList extends projectInfo
{
	var $dbList = null;

	function __construct($sqlQuery, $usrFn_packRecord='')
	{
		global $dbTools;

		if ($sqlQuery)
		{
			$this->dbList = $dbTools->getList($sqlQuery);
			if (!empty($this->dbList) && !empty($usrFn_packRecord) && is_callable($usrFn_packRecord))
			{
				$tempDb = $this->dbList;
				$this->dbList = null;
				foreach ($tempDb as $dbRecord)
				{
					$usrFn($this->dbList, $dbRecord);
				}
			}
		}
	}

	function getList()
	{
		return $this->dbList;
	}
}

class projectInfoDbListGroupBy extends projectInfo
{
	function __construct($sqlQuery, $groupBy, $usrFn_packRecord='')
	{
		global $dbTools;

		if ($sqlQuery)
		{
			$this->dbList = $dbTools->getList_grouBy($sqlQuery, $groupBy);
			if (!empty($this->dbList) && !empty($usrFn_packRecord) && is_callable($usrFn_packRecord))
			{
				$tempDb = $this->dbList;
				$this->dbList = null;
				foreach ($tempDb as $dbRecord)
				{
					$usrFn($this->dbList, $dbRecord);
				}
			}
		}
	}

	function getList()
	{
		return $this->dbList;
	}
}

class projectInfo_selectList extends projectInfo
{
	var $dataList = array();

	function addToSelectList($id, $label, $options=null)
	{
		addToSelectList($this->dataList, $id, $label, $options);
	}

	function addDbList(projectInfoDbList $dbList, $id, $label, $options=null)
	{
		if ($dbList)
		{
			foreach ($dbList as $values)
			{
				addToSelectList($this->dataList, $values[$id], $values[$label], $options);
			}
		}
	}

	function getList()
	{
		return $this->dataList;
	}
}

function addToSelectList(&$list, $id, $label, $options=null)
{
	$list[$id]['id'] = $id;
	$list[$id]['label'] = $label;
	$list[$id]['options'] = $options;
}

?>