<?php

class babelTools
{
	const sessionKey = '_babelTools_';

	function __construct($filePath, $langAvailble, $langDefault)
	{
		$this->filePath		= $filePath;
		$this->langAvailble	= $langAvailble;
		$this->langDefault	= $langDefault;

		$this->lang = $this->getSelectedLang();
		$thid->keys = $this->loadKeys_byFilePath();
	}

	public
	function add($key, $value)
	{
		$this->keys[$key] = $value;
	}

	public
	function isSetKey($key)
	{
		return isset($this->keys[$key]);
	}

	function getLabel($key, $autoUpdate=true)
	{
		if (!isset($this->keys[$key]))
		{
			$this->add($key, $key);
			if ($autoUpdate)
			{
				$this->updateFileKeys();
			}
		}
		$result = $this->keys[$key];
		return $result;
	}

	function getSelectedLang()
	{
		if (!isset($_SESSION[self::sessionKey]['lang']))
		{
			$_SESSION[self::sessionKey]['lang'] = $this->langDefault;
		}
		$lang = $_SESSION[self::sessionKey]['lang'];
		return $lang;
	}

	private
	function get_filename()
	{
		$filename = $this->filePath.'/'.$this->lang.'.php';
		return $filename;
	}

	private
	function loadKeys_byFilePath()
	{
		$this->lang = $this->getSelectedLang();
		$filename = $this->get_filename();
		if (!is_file($filename))
		{
			$this->updateFileKeys();
		}
		require_once($filename);
	}

	public
	function updateFileKeys()
	{
		if (!is_dir($this->filePath))
		{
			mkdir($this->filePath) or die('Path "'.($this->filePath).'" is not available for writing');
		}
		$filename = $this->get_filename();
		$handle = fopen($filename, 'w+') or die('File not writeable!');
		if (!empty($this->keys))
		{
			fwrite($handle, "<?php\n");
			foreach ($this->keys as $key => $label)
			{
				$str_key	= str_replace("\n", '\n', addslashes(utf8_encode($key)));
				$str_label	= str_replace("\n", '\n', addslashes(utf8_encode($label)));
				$line = 'babelTools::add(\''.$key.'\', \''.$label.'\');'."\n";
				fwrite($handle, $line);
			}
			fwrite($handle, "?>");
		}
		fclose($handle);
		chmod($filename, 0777);
	}
}

function __($key)
{
	if (!$GLOBALS['babelTools']->isSetKey($key))
	{
		$GLOBALS['babelTools']->add($key, $key);
		$GLOBALS['babelTools']->updateFileKeys();
	}
	else
	{
		$label = $GLOBALS['babelTools']->getLabel($key, true);
	}

	return $label;
}

?>