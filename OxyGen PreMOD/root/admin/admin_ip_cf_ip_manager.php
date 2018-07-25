<?php
/***************************************************************************
 *                        admin_ip_cf_ip_manager.php
 *                            -------------------
 *   begin                : 02-Dec-2006
 *   copyright            : (C) 2006 3Di (aka 3D)
 *   email                : N/A
 *
 *   $Id: admin_ip_cf_ip_manager.php, 1.0.0, 01-Dec-2006 11.30.00, 3Di Exp $
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

if ( !empty($setmodules) )
{
	$filename = basename(__FILE__);
	$module['General']['IP_Management'] = $filename;
	return;
}

//
// Load default header
//
$phpbb_root_path = './../';
require($phpbb_root_path . 'extension.inc');
require('./pagestart.' . $phpEx);

//
// the crap goes here.. ;-)
//
$dot_ip_from = sprintf($HTTP_POST_VARS['ip_cf_dot_ip_from']);
$dot_ip_to = sprintf($HTTP_POST_VARS['ip_cf_dot_ip_to']);
$ip_cf_iso3661_1 = strtoupper(sprintf($HTTP_POST_VARS['ip_cf_iso_3661_1']));
$ip_cf_from = sprintf("%u", ip2long($dot_ip_from));
$ip_cf_to = sprintf("%u", ip2long($dot_ip_to));

if( isset($HTTP_POST_VARS['submit']) )
{
	$sql = "INSERT INTO " . CF_ISO_TABLE . " (`ip_from`, `ip_to`, `iso3661_1`)
		VALUES ('$ip_cf_from', '$ip_cf_to', '$ip_cf_iso3661_1')";
	if ( !$db->sql_query($sql) )
	{
		message_die(GENERAL_ERROR, 'Could not insert new IPs into your database', '', __LINE__, __FILE__, $sql);
	}
}

if( isset($HTTP_POST_VARS['submit']) )
{
	$message = $lang['IP_CF_IP_inserted'] . '<br /><br />' . sprintf($lang['IP_CF_Click_return_admin_ip_cf_ip_manager'], '<a href="' . append_sid('admin_ip_cf_ip_manager.'.$phpEx) . '">', '</a>') . '<br /><br />' . sprintf($lang['IP_CF_Click_return_admin_index'], '<a href="' . append_sid('index.'.$phpEx . '?pane=right') . '">', '</a>');
	message_die(GENERAL_MESSAGE, $message);
}

$template->set_filenames(array('body' => 'admin/admin_ip_cf_ip_manager.tpl'));

$template->assign_vars(array(
	'L_IP_CF_FROM' => $lang['IP_CF_from'],
	'L_IP_CF_TO' => $lang['IP_CF_to'],
	'L_IP_CF_COUNTRY_ISO' => $lang['IP_CF_iso3661_1'],
	'L_SUBMIT' => $lang['Submit'],
	'L_RESET' => $lang['Reset'],
	'L_IP_CF_DB_TITLE' => $lang['Ip_cf_title'],
	'L_IP_CF_DB_EXPLAIN' => $lang['Ip_cf_db_explain'],
	'S_CONFIRM_ACTION' => append_sid('admin_ip_cf_ip_manager.'.$phpEx))
);

$template->pparse('body');

?>
