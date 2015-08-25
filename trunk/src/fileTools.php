<?php

function split_filenameExt($filename)
{
	$dot = strrpos($filename, '.');

	$name = substr($filename, 0, $dot);
	$ext = substr($filename, $dot-strlen($filename)+1);
	$result = array($name, $ext);

	return $result;
}

function isOk_pathFilename($filename, $create_if_not_exists=false)
{
	$path = dirname($filename);

	$isOk = is_dir($path);
	if (!$isOk && $create_if_not_exists)
	{
		$isOk = mkdir($path);
	}
	return $isOk;
}

?>