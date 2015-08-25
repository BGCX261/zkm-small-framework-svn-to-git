<?php

require_once(__DIR__.'/manager/zsf_object.php');
require_once(__DIR__.'/manager/zsf_oNumber.class.php');
require_once(__DIR__.'/manager/zsf_oString.class.php');
require_once(__DIR__.'/manager/zsf_oHtml.class.php');
require_once(__DIR__.'/manager/zsf_oList.class.php');

require_once(__DIR__.'/manager/zsf_action.php');
require_once(__DIR__.'/manager/zsf_action.list.php');
require_once(__DIR__.'/manager/zsf_action.insert.php');
require_once(__DIR__.'/manager/zsf_action.modify.php');
require_once(__DIR__.'/manager/zsf_action.delete.php');
require_once(__DIR__.'/manager/zsf_action.xls.php');

defineTools::define('zsfManager', 'zsfActionType_page',		'page',		'page');
defineTools::define('zsfManager', 'zsfActionType_inline',	'inline',	'inline');

class zsfManager extends projectAction
{
	public
	function __construct()
	{
		$this->addAction($type='zsfActionType_page', new zsf_action_list($this, 'list', 'list'));
	}

	public
	function addField($actionType, zsfObject $zsfObject)
	{
		$this->actions[$actionType][] = $zsfAction;
	}

	public
	function addAction($actionType, zsf_action $zsfAction)
	{
		$this->actionKeys[$zsfAction->key] =& $zsfAction;
		$this->actions[$actionType][$zsfAction->key] =& $this->actionKeys[$zsfAction->key];
	}

	public
	function setup_dbTools(&$dbTools)
	{
		$this->dbTools =& $dbTools;
	}

	public
	function getSelected_actionKey()
	{
		$actKey = @$_REQUEST['actKey'];

		$isOk = !empty($this->actionKeys[$actKey]);
		$isOk &= @is_object($this->actionKeys[$actKey]);
		if (!$isOk)
		{
			if (!empty($this->actionKeys))
			{
				reset($this->actionKeys);
				$actKey = key($this->actionKeys);
			}
		}
		return $actKey;
	}

	public
	function actionExec($actionKey)
	{
		return $this->actionKeys[$actionKey]->zsfActionExec();
	}
}

?>