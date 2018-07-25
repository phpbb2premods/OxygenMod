<?php
/**
*
* @version $Id: admin_cell.php,v 0.2.1 2007/03/28 00:04:59 ABDev Exp $
* @copyright (c) 2007 ABDev, EzCom
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
*
* Original author : Dr DLP
*/

define('IN_PHPBB', 1);

if (!empty($setmodules))
{
	$file = basename(__FILE__);
	$module['Users']['Cell'] = $file;

	return;
}

$phpbb_root_path = './../';
require($phpbb_root_path . 'extension.inc');
require('pagestart.' . $phpEx);

$template->set_filenames(array('body' => 'admin/config_cell_body.tpl'));

include($phpbb_root_path . 'includes/functions_jail.'.$phpEx);

$submit = isset($HTTP_POST_VARS['submit']); 
$update = isset($HTTP_POST_VARS['update']); 
$manual_update = isset($HTTP_POST_VARS['manual_update']); 
$user_update = isset($HTTP_POST_VARS['user_update']); 

if (isset($HTTP_POST_VARS['from']))
{
	$user = ($HTTP_POST_VARS['from'] == 'list') ? TRUE : FALSE;
}
else if (isset($HTTP_GET_VARS['from']))
{
	$user = ($HTTP_GET_VARS['from'] == 'list') ? TRUE : FALSE;
}

$sql = 'SELECT * FROM ' . USERS_TABLE . ' WHERE user_cell_time = 0 AND user_id > 1 ORDER by username';
if ( !$result = $db->sql_query($sql) )
{
	message_die(GENERAL_ERROR, 'Could not obtain group list', '', __LINE__, __FILE__, $sql);
}

$select_list = '';
if ($row = $db->sql_fetchrow($result))
{
	$select_list .= '<select name="celled_id">';
	do
	{
		$select_list .= '<option value="' . $row['user_id'] . '">' . $row['username'] . '</option>';
	}
	while ( $row = $db->sql_fetchrow($result) );
	$select_list .= '</select>';
}

if ($submit)
{
	$celled_id		= (!empty($HTTP_POST_VARS['celled_id'])) ? $HTTP_POST_VARS['celled_id'] : $HTTP_GET_VARS['celled_id'];
	$time_day		= intval($HTTP_POST_VARS['time_day']);
	$time_hour		= intval($HTTP_POST_VARS['time_hour']);
	$time_minute	= intval($HTTP_POST_VARS['time_minute']);
	$caution		= intval($HTTP_POST_VARS['caution']);
	$cautionable	= intval($HTTP_POST_VARS['cautionable']);
	$freeable		= intval($HTTP_POST_VARS['freeable']);
	$punishment		= intval($HTTP_POST_VARS['punishment']);
	$sentence		= addslashes(stripslashes($HTTP_POST_VARS['sentence']));

	if ((empty($time_day) && empty($time_hour) && empty($time_minute)) || !$punishment)
	{
		message_die(MESSAGE, $lang['Fields_empty']);
	}

	cell_imprison_user($celled_id, $time_day, $time_hour, $time_minute, $caution, $cautionable, $freeable, $sentence, $punishment);

}
else if ($user)
{
	$template->set_filenames(array('body' => 'admin/config_cell_users_body.tpl'));

	$user_id = ( !empty($HTTP_POST_VARS['id']) ) ? $HTTP_POST_VARS['id'] : $HTTP_GET_VARS['id'];

	$sql = 'SELECT * FROM ' . USERS_TABLE . ' WHERE user_id = ' . intval($user_id);
	if ( !$result = $db->sql_query($sql) )
	{
		message_die(GENERAL_ERROR, 'Could not obtain celled list', '', __LINE__, __FILE__, $sql);
	}
	$celled = $db->sql_fetchrow($result);

	$stamp_age =  $celled['user_cell_time'];
	$days = floor($stamp_age/86400);
	$stamp_age = $stamp_age - ( $days * 86400 );
	$hours = floor($stamp_age/3600);
	$stamp_age = $stamp_age - ( $hours * 3600 );
	$minutes = floor($stamp_age/60);

	$template->assign_vars(array(
		'DAY'					=> $days,
		'HOUR'					=> $hours,
		'MINUTE'				=> $minutes ,
		'FREEABLE'				=> ($celled['user_cell_enable_free']) ? 'CHECKED' : '',
		'CAUTIONNABLE'			=> ($celled['user_cell_enable_caution']) ? 'CHECKED' : '',
		'SELECTED_CELLED'		=> $celled['username'],
		'SELECTED_CELLED_ID'	=> $celled['user_id'],
		'CELLED_SENTENCE'		=> $celled['user_cell_sentence'],
		'CELLED_CAUTION'		=> $celled['user_cell_caution'],	
		'PUNISHMENT_GLOBAL'		=> ($celled['user_cell_punishment']) ? 'CHECKED' : '',
		'PUNISHMENT_POSTS'		=> ($celled['user_cell_punishment'] == 2) ? 'CHECKED' : '',
		'PUNISHMENT_READ'		=> ($celled['user_cell_punishment'] == 3) ? 'CHECKED' : '',
	));
}
else if ($user_update)
{
	$celled_id = (!empty($HTTP_POST_VARS['id'])) ? $HTTP_POST_VARS['id'] : $HTTP_GET_VARS['id'];
	$time_day = intval($HTTP_POST_VARS['time_day']);
	$time_hour = intval($HTTP_POST_VARS['time_hour']);
	$time_minute = intval($HTTP_POST_VARS['time_minute']);
	$caution = intval($HTTP_POST_VARS['caution']);
	$cautionable = intval($HTTP_POST_VARS['cautionable']);
	$freeable = intval($HTTP_POST_VARS['freeable']);
	$sentence = addslashes(stripslashes($HTTP_POST_VARS['sentence']));
	$blank = intval($HTTP_POST_VARS['blank']);
	$punishment = intval($HTTP_POST_VARS['punishment']);

	if ((empty($time_day) && empty($time_hour) && empty($time_minute)) || !$punishment)
	{
		message_die(MESSAGE, $lang['Fields_empty']);
	}

	$tsql = 'SELECT * FROM ' . JAIL_USERS_TABLE . ' WHERE user_id = ' . intval($celled_id) . ' ORDER BY celled_id DESC LIMIT 1';
	if ( !$tresult = $db->sql_query($tsql) )
	{
		message_die(GENERAL_ERROR, 'Could not update user\'s jail infos', '', __LINE__, __FILE__, $tsql);
	}
	$trow = $db->sql_fetchrow($tresult);
	$cell_id = intval($trow['celled_id']);

	if ($blank)
	{
		$sql = 'DELETE FROM ' . JAIL_USERS_TABLE . ' WHERE user_id = ' . intval($celled_id) . ' AND celled_id <> ' . intval($cell_id);
		if (!$result = $db->sql_query($sql))
		{
			message_die(GENERAL_ERROR, '', __LINE__, __FILE__, $sql);
		}

		$sql = 'UPDATE ' . USERS_TABLE . ' SET user_cell_celleds = 1 WHERE user_id = ' . intval($celled_id);
		if (!$db->sql_query($sql))
		{
			message_die(GENERAL_ERROR, 'Could not update user\'s jail infos', '', __LINE__, __FILE__, $sql);
		}
	}

	$time = ($time_day * 86400) + ($time_hour * 3600) + ($time_minute * 60);

	$sql = 'UPDATE ' . JAIL_USERS_TABLE . ' SET user_sentence = \'' . $sentence . '\', user_caution = ' . $caution . ' WHERE user_id = ' . intval($celled_id) . ' AND celled_id = ' . intval($cell_id);
	if ( !$result = $db->sql_query($sql) )
	{
		message_die(GENERAL_ERROR, 'Could not update user\'s jail infos', '', __LINE__, __FILE__, $sql);
	}

	$sql = 'UPDATE ' . USERS_TABLE . ' SET user_cell_time = ' . $time . ', user_cell_time_judgement = ' . time() . ', user_cell_caution = ' . $caution . ', user_cell_enable_caution = ' . $cautionable . ', user_cell_enable_free = ' . $freeable . ', user_cell_punishment = ' . $punishment . ', user_cell_sentence = \'' . $sentence . '\' WHERE user_id = ' . intval($celled_id);
	if (!$db->sql_query($sql))
	{
		message_die(GENERAL_ERROR, 'Could not update user\'s points', '', __LINE__, __FILE__, $sql);
	}
	else
	{
		message_die(GENERAL_MESSAGE, $lang['Cell_admin_celled_edited_ok'] . $lang['Cell_admin_general_return']);
	}
}
else if ($update)
{
	$sql = 'SELECT * FROM ' . USERS_TABLE . ' WHERE user_cell_time > 0 ORDER BY username';
	if ( !$result = $db->sql_query($sql) )
	{
		message_die(GENERAL_ERROR, 'Could not obtain celled list', '', __LINE__, __FILE__, $sql);
	}
	$celleds = $db->sql_fetchrowset($result);

	$sql = array();
	
	while (list(, $celled) = @each($celleds))
	{
		if (isset($HTTP_POST_VARS[$celled['user_id']]))
		{
			cell_free_user($celled['user_id'], 2);
		}
	}

	message_die(GENERAL_MESSAGE, $lang['Cell_admin_uncelled_ok'] . $lang['Cell_admin_general_return']);
}

else if ($manual_update)
{
	$free = '';
	$free = cell_update_users();
	$free = empty($free) ? $lang['None'] : $free ;

	message_die(GENERAL_MESSAGE, $lang['Cell_admin_celled_manual_update_ok'] . '<br />' . $free . $lang['Cell_admin_general_return']);	
}
else
{
	$sql = 'SELECT * FROM ' . USERS_TABLE . ' WHERE user_cell_time > 0 AND user_id > 1 ORDER by username';
	if ( !$result = $db->sql_query($sql) )
	{
		message_die(GENERAL_ERROR, 'Could not obtain celled list', '', __LINE__, __FILE__, $sql);
	}
	$celled = $db->sql_fetchrowset($result);

	for ($i = 0; $i < count ($celled ); $i++)
	{
		$user_id = $celled[$i]['user_id'];
		$template->assign_block_vars('celled', array(
			'CELLED_ID'			=> $celled[$i]['user_id'],

//-- mod : rank color system ---------------------------------------------------
//-- delete
/*-MOD			
			'CELLED_NAME'		=> $celled[$i]['username'],
MOD-*/
//-- add
			'CELLED_NAME'		=> $rcs->get_colors($celled[$i], $celled[$i]['username']),
//-- fin mod : rank color system -----------------------------------------------

			'CELLED_SENTENCE'	=> $celled[$i]['user_cell_sentence'],
			'CELLED_TIME'		=> cell_create_time($celled[$i]['user_cell_time']),
			'CELLED_CAUTION'	=> $celled[$i]['user_cell_caution'],
			'U_EDIT'			=> append_sid('admin_cell.' . $phpEx . '?from=list&amp;id=' . $user_id),
		));
	}
}

$template->assign_vars(array(
	'L_CELL_TITLE'					=> $lang['Cell_admin_title'],
	'L_CELL_TEXT'					=> $lang['Cell_admin_title_explain'],
	'L_SUBMIT'						=> $lang['Submit'],
	'L_SELECT'						=> $lang['Cell_admin_select'],
	'L_SELECT_CELLED'				=> $lang['Cell_admin_select_user'],
	'L_DAY'							=> $lang['Cell_days'],
	'L_HOUR'						=> $lang['Cell_hours'],
	'L_MINUTE'						=> $lang['Cell_minutes'],
	'L_CELL_TIME'					=> $lang['Cell_admin_time'],
	'L_CELL_TIME_EXPLAIN'			=> $lang['Cell_admin_time_explain'],
	'L_CELL_CAUTION'				=> $lang['Cell_admin_caution'],
	'L_CELL_CAUTION_EXPLAIN'		=> $lang['Cell_admin_caution_explain'],
	'L_SENTENCE'					=> $lang['Cell_sentence_example'],
	'L_CELLED_SENTENCE'				=> $lang['Cell_sentence'],
	'L_CELLED_SENTENCE_EXPLAIN'		=> $lang['Cell_sentence_explain'],
	'L_CELLED_FREEABLE'				=> $lang['Cell_freeable'],
	'L_CELLED_FREEABLE_EXPLAIN'		=> $lang['Cell_freeable_explain'],
	'L_CELLED_CAUTIONNABLE'			=> $lang['Cell_cautionnable'],
	'L_CELLED_CAUTIONNABLE_EXPLAIN'	=> $lang['Cell_cautionnable_explain'],
	'L_CELLED_USERS'				=> $lang['Cell_admin_celled_users'],
	'L_CELLED_USERS_EXPLAIN'		=> $lang['Cell_admin_celled_users_explain'],
	'L_CELLED_NAME'					=> $lang['Cell_admin_celled_name'],
	'L_CELLED_CAUTION'				=> $lang['Cell_admin_celled_caution'],
	'L_CELLED_TIME'					=> $lang['Cell_admin_celled_time'],
	'L_CELLED_FREE'					=> $lang['Cell_admin_celled_free'],
	'L_MANUAL_UPDATE'				=> $lang['Cell_admin_manual_update'],
	'L_MANUAL_UPDATE_EXPLAIN'		=> $lang['Cell_admin_manual_update_explain'],
	'L_SELECTED_CELLED'				=> $lang['Cell_selected_celled'],
	'L_CELLED_BLANK'				=> $lang['Cell_admin_celled_blank'],
	'L_CELLED_BLANK_EXPLAIN'		=> $lang['Cell_admin_celled_blank_explain'],
	'L_PUNISHMENT'					=> $lang['Cell_admin_punishment'],
	'L_PUNISHMENT_GLOBAL'			=> $lang['Cell_admin_punishment_global'],
	'L_PUNISHMENT_POSTS'			=> $lang['Cell_admin_punishment_posts'],
	'L_PUNISHMENT_READ'				=> $lang['Cell_admin_punishment_read'],

	'S_SELECT_CELLED'				=> $select_list,
	'S_SUBMIT_ACTION'				=> append_sid('admin_cell.' . $phpEx),
));


$template->pparse('body');

include('./page_footer_admin.'.$phpEx);

?>
