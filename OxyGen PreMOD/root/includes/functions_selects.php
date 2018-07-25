<?php
/***************************************************************************
 *                            function_selects.php
 *                            -------------------
 *   begin                : Saturday, Feb 13, 2001
 *   copyright            : (C) 2001 The phpBB Group
 *   email                : support@phpbb.com
 *
 *   $Id: functions_selects.php,v 1.3.2.5 2005/05/06 20:50:11 acydburn Exp $
 *
 *
 ***************************************************************************/

/***************************************************************************
 *
 *   This program is free software; you can redistribute it and/or modify
 *   it under the terms of the GNU General Public License as published by
 *   the Free Software Foundation; either version 2 of the License, or
 *   (at your option) any later version.
 *
 *
 ***************************************************************************/

//
// Pick a language, any language ...
//
function language_select($default, $select_name = 'language', $dirname='language')
{
	global $phpEx, $phpbb_root_path;

	$dir = opendir($phpbb_root_path . $dirname);

	$lang = array();
	while ( $file = readdir($dir) )
	{
		if (preg_match('#^lang_#i', $file) && !is_file(@phpbb_realpath($phpbb_root_path . $dirname . '/' . $file)) && !is_link(@phpbb_realpath($phpbb_root_path . $dirname . '/' . $file)))
		{
			$filename = trim(str_replace('lang_', '', $file));
			$displayname = preg_replace("/^(.*?)_(.*)$/", "\\1 [ \\2 ]", $filename);
			$displayname = preg_replace("/\[(.*?)_(.*)\]/", "[ \\1 - \\2 ]", $displayname);
			$lang[$displayname] = $filename;
		}
	}

	closedir($dir);

	@asort($lang);
	@reset($lang);

	$lang_select = '<select name="' . $select_name . '">';
	while ( list($displayname, $filename) = @each($lang) )
	{
		$selected = ( strtolower($default) == strtolower($filename) ) ? ' selected="selected"' : '';
		$lang_select .= '<option value="' . $filename . '"' . $selected . '>' . ucwords($displayname) . '</option>';
	}
	$lang_select .= '</select>';

	return $lang_select;
}

//
// Pick a template/theme combo, 
//
function style_select($default_style, $select_name = 'style', $dirname = 'templates')
{
	global $db;

	$sql = 'SELECT themes_id, style_name
		FROM ' . THEMES_TABLE . '
		ORDER BY template_name, themes_id';
	if ( !($result = $db->sql_query($sql)) )
	{
		message_die(GENERAL_ERROR, 'Could not query themes table', '', __LINE__, __FILE__, $sql);
	}

	$style_select = '<select name="' . $select_name . '">';
	while ( $row = $db->sql_fetchrow($result) )
	{
		$selected = ( $row['themes_id'] == $default_style ) ? ' selected="selected"' : '';

		$style_select .= '<option value="' . $row['themes_id'] . '"' . $selected . '>' . $row['style_name'] . '</option>';
	}
	$style_select .= '</select>';
	
	$db->sql_freeresult($result);
	return $style_select;
}

//
// Pick a timezone
//
//-- mod : date format evolved -------------------------------------------------
//-- delete
/*-MOD
function tz_select($default, $select_name = 'timezone')
{
	global $sys_timezone, $lang;

	if ( !isset($default) )
	{
		$default == $sys_timezone;
	}
	$tz_select = '<select name="' . $select_name . '">';

	while( list($offset, $zone) = @each($lang['tz']) )
	{
		$selected = ( $offset == $default ) ? ' selected="selected"' : '';
		$tz_select .= '<option value="' . $offset . '"' . $selected . '>' . $zone . '</option>';
	}
	$tz_select .= '</select>';

	return $tz_select;
}
MOD-*/
//-- add
function tz_select($default, $select_name = 'timezone', $truncate = true)
{
	global $board_config, $lang;

	// fix parms with default
	$default = doubleval($default);

	$tz_select = '<select name="' . $select_name . '">';

	foreach ( $lang['tz_zones'] as $offset => $zone )
	{
		if ( $truncate )
		{
			$zone = (strlen($zone) > 70) ? substr($zone, 0, 70) . '...' : $zone;
		}

		if ( is_numeric($offset) )
		{
			$selected = ($offset == $default) ? ' selected="selected"' : '';
			$tz_select .= '<option value="' . doubleval($offset) . '"' . $selected . '>' . $zone . '</option>';
		}
	}

	$tz_select .= '</select>';

	return $tz_select;
}

/**
* dateformat_select
*
* This function is inspired by date format setting from phpBB3 (aka Olympus)
* Used to pick a date format from a dropdown menu (with a custom field)
*/
function dateformat_select($default, $select_name = 'dateoptions')
{
	global $board_config, $template, $lang;

	// fix parms with default
	$default = empty($default) ? $board_config['default_dateformat'] : $default;

	$dateformat_options = '';

	foreach ( $lang['dateformats'] as $format => $null )
	{
		$dateformat_options .= '<option value="' . $format . '"' . (($format == $default) ? ' selected="selected"' : '') . '>';
		$dateformat_options .= format_date(time(), $format, true) . ((strpos($format, '|') !== false) ? ' [' . $lang['relative_days'] . ']' : '');
		$dateformat_options .= '</option>';
	}

	$s_custom = false;

	$dateformat_options .= '<option value="custom"';
	if (!in_array($default, array_keys($lang['dateformats'])))
	{
		$dateformat_options .= ' selected="selected"';
		$s_custom = true;
	}
	$dateformat_options .= '>' . $lang['custom_dateformat'] . '</option>';

	$template->assign_vars(array(
		'S_DATEFORMAT_OPTIONS' => $dateformat_options,
		'S_CUSTOM_DATEFORMAT' => $s_custom ? '' : ' style="display:none;"',
		'A_DEFAULT_DATEFORMAT' => addslashes($board_config['default_dateformat']),
	));
}
//-- fin mod : date format evolved ---------------------------------------------

?>
