<?php
/***************************************************************************
 *						admin_external_hosting.php 
 *						------------------------
 *	begin				: 10/09/2005
 *	copyright			: Budman	
 *	email				: n/a
 *
 *	version				: 0.0.1 - 10/09/2005 - 14:26
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
 ***************************************************************************/

define('IN_PHPBB', 1);

if( !empty($setmodules) )
{
	$filename = basename(__FILE__);
	$module['General']['ext_adm_hosting'] = $filename;
	
	return;
}

//
// Load default header
//
$no_page_header = TRUE;
$phpbb_root_path = './../';
require($phpbb_root_path . 'extension.inc');
require('./pagestart.' . $phpEx);

include('./page_header_admin.'.$phpEx);

//
// set filename
//
$template->set_filenames(array(
	'body' => 'admin/admin_external_hosting.tpl')
);

//
// sanitize the form inputs
//
$ext_id = intval($HTTP_POST_VARS['ext_id']);
$ext_name = ( isset($HTTP_POST_VARS['ext_name']) ) ? trim($HTTP_POST_VARS['ext_name']) : "";
$ext_url = ( isset($HTTP_POST_VARS['ext_url']) ) ? trim($HTTP_POST_VARS['ext_url']) : "";
$ext_ub = (isset($HTTP_POST_VARS['ext_ub'])) ? TRUE : FALSE;
$ext_ubc = ( isset($HTTP_POST_VARS['ext_ubc']) ) ? trim($HTTP_POST_VARS['ext_ubc']) : "";
$ext_enabled = (isset($HTTP_POST_VARS['ext_enabled'])) ? TRUE : FALSE;

$ext_name = str_replace("\'", "''", $ext_name);
$ext_url = str_replace("\'", "''", $ext_url);
$ext_ubc = str_replace("\'", "''", $ext_ubc);

$ext_ubc = htmlspecialchars($ext_ubc);


//
// change hoster
//
if ( isset($HTTP_POST_VARS['change']) )
{
	$sql = 'UPDATE ' . EXT_HOST_TABLE . " 
			SET ext_id = '$ext_id', ext_name = '$ext_name', ext_url = '$ext_url', ext_ub = '$ext_ub', ext_ubc = '$ext_ubc', ext_enabled = '$ext_enabled' 
			WHERE ext_id = $ext_id ";
		
	if(!$db->sql_query($sql))
	{
		message_die(CRITICAL_ERROR, 'Could not update external hosts information', '', __LINE__, __FILE__, $sql);
	}
	else
	{
		$message = $lang['ext_adm_change_done'];
		$message .= '<br /><br />' . sprintf($lang['ext_adm_click_return'], '<a href="' . append_sid("admin_external_hosting.$phpEx?") . '">', '</a>');
		$message .= '<br /><br />' . sprintf($lang['ext_adm_index_return'], '<a href="' . append_sid("index." .$phpEx."?pane=right") . '">', '</a>');
		
		message_die(GENERAL_MESSAGE, $message);
	} 
}

//
// delete hoster
//
if ( isset($HTTP_POST_VARS['delete']) )
{
	$sql = 'DELETE FROM ' . EXT_HOST_TABLE . '
			WHERE ext_id = ' . $ext_id;
		
	if(!$db->sql_query($sql))
	{
		message_die(CRITICAL_ERROR, 'Could not delete external hosts information', '', __LINE__, __FILE__, $sql);
	}
	else
	{
		$message = $lang['ext_adm_delete_done'];
		$message .= '<br /><br />' . sprintf($lang['ext_adm_click_return'], '<a href="' . append_sid("admin_external_hosting.$phpEx?") . '">', '</a>');
		$message .= '<br /><br />' . sprintf($lang['ext_adm_index_return'], '<a href="' . append_sid("index." .$phpEx."?pane=right") . '">', '</a>');
		
		message_die(GENERAL_MESSAGE, $message);
	} 
}

//
// add new hoster
// 
if ( isset($HTTP_POST_VARS['new']) )
{
	$sql = "INSERT INTO " . EXT_HOST_TABLE . " (ext_id, ext_name, ext_url, ext_ub, ext_ubc, ext_enabled)
		VALUES ('', '$ext_name', '$ext_url', '$ext_ub', '$ext_ubc', '$ext_enabled') ";
		
	if(!$db->sql_query($sql))
	{
		message_die(CRITICAL_ERROR, "Could not insert external hosts information", "", __LINE__, __FILE__, $sql);
	}
	else
	{
		$message = $lang['ext_adm_insert_done'];
		$message .= '<br /><br />' . sprintf($lang['ext_adm_click_return'], '<a href="' . append_sid("admin_external_hosting.$phpEx?") . '">', '</a>');
		$message .= '<br /><br />' . sprintf($lang['ext_adm_index_return'], '<a href="' . append_sid("index." .$phpEx."?pane=right") . '">', '</a>');
		
		message_die(GENERAL_MESSAGE, $message);
	} 
}

//
// pull data from db
//
$sql = 'SELECT *
		FROM ' . EXT_HOST_TABLE . ' 
		ORDER BY ext_name ASC';

if ( !$result = $db->sql_query($sql) )
{
	message_die(CRITICAL_ERROR, "Could not query external hosts information", "", __LINE__, __FILE__, $sql);
}
if ( $row = $db->sql_fetchrow($result) )
{
	$i = 0;
	
	do
	{
		$exthost_enabled = ( $row['ext_enabled'] ) ? 'checked="checked"' : '';
		$exthost_ub = ( $row['ext_ub'] ) ? 'checked="checked"' : '';
		$row_class = ( !($i % 2) ) ? $theme['td_class1'] : $theme['td_class2'];
		
		$template -> assign_block_vars('hoster_row', array(
			'EXT_ROW_CLASS' => $row_class,
			'EXT_FORM_NAME' => $i,
			'EXT_ID' => $row['ext_id'],
			'EXT_ENA' => $exthost_enabled,
			'EXT_NAME' => $row['ext_name'],
			'EXT_URL' => $row['ext_url'],
			'EXT_UB' => $exthost_ub,
			'EXT_UBC' => $row['ext_ubc'],
			
			'S_EXT_HOST_ACT' => append_sid("admin_external_hosting.".$phpEx)
			));
		
		$i++;
		
	}
	
	while( $row = $db->sql_fetchrow($result) );
	$db->sql_freeresult($result);
}

//
// assign vars to template
//
$template -> assign_vars(array(		
		'L_EXT_TITLE' => $lang['ext_adm_hosting_title'],
		'L_EXT_EXPLAIN' => $lang['ext_adm_explain'],
		'L_EXT_CHG_HOSTER' => $lang['ext_adm_chg_hoster'],
		'L_EXT_NEW_HOSTER' => $lang['ext_adm_new_hoster'],
		'L_EXT_ENABLE' => $lang['ext_adm_hoster_enable'],
		'L_EXT_NAME' => $lang['ext_adm_hoster_name'],
		'L_EXT_NAME_EXPLAIN' => $lang['ext_adm_hoster_name_explain'],
		'L_EXT_URL' => $lang['ext_adm_hoster_url'],
		'L_EXT_URL_EXPLAIN' => $lang['ext_adm_hoster_url_explain'],
		'L_EXT_UB' => $lang['ext_adm_hoster_ub'],
		'L_EXT_UBC' => $lang['ext_adm_hoster_ubc'],
		'L_EXT_UBC_EXPLAIN' => $lang['ext_adm_hoster_ubc_explain'],
		'L_EXT_CHG' => $lang['ext_adm_change'],
		'L_EXT_DEL' => $lang['ext_adm_delete'],
		'L_EXT_NEW' => $lang['ext_adm_new'],
		'L_EXT_RESET' => $lang['ext_adm_reset'],
		
		'S_EXT_NEW_HOSTER' => append_sid("admin_external_hosting." .$phpEx)
	));



//
// parse body to template
//
$template->pparse('body');

include('./page_footer_admin.'.$phpEx);

?>