<?php

class dbTools
{
	function __construct($host, $db_user, $db_psw, $db_name)
	{
		$this->db = mysql_connect($host, $db_user, $db_psw);
		if ($this->db == FALSE)
		{
			die ('Errore nella connessione. Verificare i parametri nel file "config.inc.php"');
		}
		mysql_select_db($db_name, $this->db) or die ('Errore nella selezione del database. Verificare i parametri nel file config.inc.php');

		// set default charset for MySQL
		$this->sqlExec("SET CHARACTER SET utf8");

		// FIX compatibilità
		$GLOBALS['db'] =& $this->db;
		register_shutdown_function(array($this, 'dbClose'));
	}

	function dbClose()
	{
		if (!empty($this->db))
		{
			mysql_close($this->db);
		}
	}

	public
	function getList($sqlQuery, $idKey=null)
	{
		$result = null;
		$rs = mysql_query($sqlQuery, $this->db) or die('['.__function__.'] Query non valida: ' . mysql_error().'<pre>'.$sqlQuery.'</pre>');
		if ($idKey)
		{
			while ($temp = mysql_fetch_assoc($rs))
			{
				$result[$temp[$idKey]] = $temp;
			}
		}
		else
		{
			while ($temp = mysql_fetch_assoc($rs))
			{
				$result[] = $temp;
			}
		}
		return $result;
	}

	public
	function getList_grouBy($sqlQuery, $idGroup, $idKey=null)
	{
		$result = null;
		$rs = mysql_query($sqlQuery, $this->db) or die('['.__function__.'] Query non valida: ' . mysql_error().'<pre>'.$sqlQuery.'</pre>');
		if ($idKey)
		{
			while ($temp = mysql_fetch_assoc($rs))
			{
				$result[$temp[$idGroup]][$temp[$idKey]] = $temp;
			}
		}
		else
		{
			while ($temp = mysql_fetch_assoc($rs))
			{
				$result[$temp[$idGroup]][] = $temp;
			}
		}
		return $result;
	}

	public
	function getRecord($sqlQuery)
	{
		$rs = mysql_query($sqlQuery, $this->db) or die('['.__function__.'] Query non valida: ' . mysql_error().'<pre>'.$sqlQuery.'</pre>');
		$result = mysql_fetch_assoc($rs);
		return $result;
	}

	public
	function getValue($sqlQuery, $idKey)
	{
		$rs = mysql_query($sqlQuery, $this->db) or die('['.__function__.'] Query non valida: ' . mysql_error().'<pre>'.$sqlQuery.'</pre>');
		$temp = mysql_fetch_assoc($rs);
		$result = $temp[$idKey];
		return $result;
	}

	public
	function insertRow($sqlQuery)
	{
		mysql_query($sqlQuery, $this->db) or die('['.__function__.'] Query non valida: ' . mysql_error().'<pre>'.$sqlQuery.'</pre>');
		$result = mysql_insert_id($this->db);
		return $result;
	}

	public
	function sqlExec($sqlQuery)
	{
		$isOk = mysql_query($sqlQuery, $this->db) or die('['.__function__.'] Query non valida: ' . mysql_error().'<pre>'.$sqlQuery.'</pre>');
		return $isOk;
	}
}

?>