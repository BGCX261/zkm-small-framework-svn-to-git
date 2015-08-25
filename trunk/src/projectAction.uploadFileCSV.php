<?php

class projectAction_uploadFileCSV extends projectAction
{
	var $isOk = false;
	var $errorMessage = '';
	var $extention = '';
	var $name = '';

	function __construct($SYS_FILE, $newFilename)
	{
		$this->isOk = (trim($SYS_FILE["name"]) != "");
		if (!$this->isOk)
		{
			$this->errorMessage = __("Missing parameter");
			return null;
		}

		// check extention name
		$this->extention	= substr($SYS_FILE["name"], -4);
		$this->name			= substr($SYS_FILE["name"], 0, -4);

		$this->isOk = (strtolower($this->extention) == ".csv");
		if (!$this->isOk)
		{
			$this->errorMessage = __("List must be a .csv formatted file");
			return null;
		}

		// move file
		if (@is_uploaded_file($SYS_FILE["tmp_name"]))
		{
			$this->isOk = @move_uploaded_file($SYS_FILE["tmp_name"], $newFilename);
			if (!$this->isOk)
			{
				$this->errorReporting = __("Impossibile spostare la lista, controlla l'esistenza o i permessi della directory dove fare l'upload.");
			}
		}
		return $this->isOk;
	}
}

?>