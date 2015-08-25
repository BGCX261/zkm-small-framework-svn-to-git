<?php

require_once('src/init.php');

$babelTools = new babelTools(
	$path			= __dir__.'/lang',
	$langAvailble	= array('en', 'it', 'de', 'fr'),
	$langDefault	= 'en'
);

function __($key)
{
	global $babelTools;
	return $babelTools->getLabel($key, true);
}

echo __('label 1').'<br/>';
echo __('label 2 אטילעש ÀÈÉÌÒÙ').'<br/>';
echo htmlentities(__('label 3')).'<br/>';
echo htmlentities(__('label 4 אטילעש ÀÈÉÌÒÙ')).'<br/>';

?>