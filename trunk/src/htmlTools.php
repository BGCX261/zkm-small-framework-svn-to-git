<?php

function getHtml_select($id, $name, $dataList, $idKey, $idLabel, $defaultValue, $class, $normalizeHtml, $htmlEmptyValue, $options=null)
{
	$html = '';

	$htmlExtra = '';
	if (!empty($options))
	{
		foreach ($options as $key => $value)
		{
			$htmlExtra .= ' '.$key.'="'.$value.'" ';
		}
	}

	$html .= '<select name="'.$name.'" class="'.$class.'" id="'.$id.'" '.$htmlExtra.'>';
	if (!empty($htmlEmptyValue))
	{
		$html .= '<option value="">'.$htmlEmptyValue.'</option>';
	}
	if ($dataList)
	{
		foreach ($dataList as $temp)
		{
			$value = $temp[$idKey];
			$label = ($normalizeHtml ? htmlentities($temp[$idLabel]) : $temp[$idLabel]);
			$isSelected = ($value === $defaultValue);
			$html .= '<option value="'.$value.'" '.($isSelected ? ' selected="selected"' : '').'>'.$label.'</option>';
		}
	}
	$html .= '</select>';
	return $html;
}

?>