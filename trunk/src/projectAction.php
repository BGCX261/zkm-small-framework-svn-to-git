<?php

class projectAction
{
	var $isOk		= false;
	var $msgLevel	= null;
	var $msgText	= '';
	var $msgHtml	 ='';

	function throwException($msgLevel, $msgMessage, $isHtml=false)
	{
		$this->msgLevel = $msgLevel;
		$this->msgText = ($isHtml ? strip_tags($msgMessage) : $msgMessage);
		$this->msgHtml = ($isHtml ? $msgMessage : htmlentities($msgMessage));
		throw new Exception($this->msgText);
	}

	function getMsgReporting()
	{
		$result['msgLevel']	= $this->msgLevel;
		$result['msgText']	= $this->msgText;
		$result['msgHtml']	= $this->msgHtml;
		return $result;
	}
}

?>