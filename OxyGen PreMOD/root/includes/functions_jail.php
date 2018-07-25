<?php
/**
*
* @version $Id: functions_jail.php,v 1.2.1 2007/04/07 02:01:25 ABDev Exp $
* @copyright (c) 2007 ABDev, EzCom
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
*
* Original author : Dr DLP
*/

if (!defined('IN_PHPBB'))
{
	die('Hacking attempt');
}

/**
* define the points name, adds it if not defined (Cash Mod compliance)
*/
$board_config['points_name'] = ($board_config['points_name']) ? $board_config['points_name'] : $lang['Cell_default_points_name'];

function cell_create_time($cell_time)
{
	global $lang;

	$time_remaining = '';
	$stamp_age = $cell_time;
	$days = floor($stamp_age/86400);
	$stamp_age = $stamp_age - ($days * 86400);
	$hours = floor($stamp_age/3600);
	$stamp_age = $stamp_age - ($hours * 3600);
	$minutes = floor($stamp_age/60);

	$time_remaining .= ($days <= 1) ? $days . '&nbsp;' . $lang['Cell_day'] . '&nbsp;' : $days . '&nbsp;' . $lang['Cell_days'] . '&nbsp;';
	$time_remaining .= ($hours <= 1) ? $hours . '&nbsp;' . $lang['Cell_hour'] . '&nbsp;' : $hours . '&nbsp;' . $lang['Cell_hours'] . '&nbsp;';
	$time_remaining .= ($minutes <= 1) ? $minutes . '&nbsp;' . $lang['Cell_minute'] . '&nbsp;' : $minutes . '&nbsp;' . $lang['Cell_minutes'] . '&nbsp;';

	return $time_remaining;
}

function cell_update_users()
{
	global $db, $lang;

	$sql = 'SELECT * FROM ' . USERS_TABLE . ' WHERE user_cell_time > 0 ORDER BY username';
	if (!$result = $db->sql_query($sql))
	{
		message_die(GENERAL_ERROR, 'Could not obtain celled list', '', __LINE__, __FILE__, $sql);
	}
	$celleds = $db->sql_fetchrowset($result);

	for ($i = 0; $i < count($celleds); $i++)
	{
		$less_time = (time() - $celleds[$i]['user_cell_time_judgement']);
		if (($celleds[$i]['user_cell_time'] - $less_time) < 60)
		{
			$sql = 'UPDATE ' . JAIL_USERS_TABLE . ' SET user_freed_by = 1 WHERE user_id = ' . intval($celleds[$i]['user_id']);
			if (!$result = $db->sql_query($sql))
			{
				message_die(GENERAL_ERROR, '', __LINE__, __FILE__, $sql);
			}

			$sql = 'DELETE FROM ' . JAIL_VOTES_TABLE . ' WHERE vote_id = ' . intval($celleds[$i]['user_id']);
			if (!$result = $db->sql_query($sql))
			{
				message_die(GENERAL_ERROR, '', __LINE__, __FILE__, $sql);
			}

			$sql = 'UPDATE ' . USERS_TABLE . "
				SET user_cell_time = 0, user_cell_time_judgement = 0, user_cell_enable_caution = 0, user_cell_enable_free = 0, user_cell_sentence = '', user_cell_caution = 0
				WHERE user_id = $celleds[$i]['user_id']";
			if (!$result = $db->sql_query($sql))
			{
				message_die(GENERAL_ERROR, '', __LINE__, __FILE__, $sql);
			}
			$free .= sprintf($celleds[$i]['username']) . '<br />';
		}
		else
		{
			$sql = 'UPDATE ' . USERS_TABLE . ' 
				SET user_cell_time = user_cell_time - ' . $less_time . ', user_cell_time_judgement = ' . time() . '
				WHERE user_id = ' . intval($celleds[$i]['user_id']);
			if (!$result = $db->sql_query($sql))
			{
				message_die(GENERAL_ERROR, '', __LINE__, __FILE__, $sql);
			}
		}
	}
	return $free;
}

function cell_imprison_user($celled_id, $time_day, $time_hour, $time_minute, $caution, $cautionable, $freeable, $sentence, $punishment)
{
	global $db, $lang ;

	$time = ($time_day * 86400) + ($time_hour * 3600) + ($time_minute * 60);

	$ssql = 'SELECT celled_id FROM ' . JAIL_USERS_TABLE . ' ORDER BY celled_id DESC LIMIT 1';
	if (!$db->sql_query($ssql))
	{
		message_die(GENERAL_ERROR, 'Could not update user\'s jail infos', '', __LINE__, __FILE__, $ssql);
	}
	$total = $db->sql_fetchrow($sresult);

	$cell_id = $total['celled_id'] +1;

	$sql = 'INSERT INTO ' . JAIL_USERS_TABLE . ' (celled_id, user_id, user_cell_date, user_freed_by, user_sentence, user_caution, user_time)
		VALUES (' . $cell_id . ', ' . $celled_id . ', ' . time() . ', 0, \'' . $sentence . '\', ' . $caution . ', ' . $time . ')';
	if (!$db->sql_query($sql))
	{
		message_die(GENERAL_ERROR, 'Could not update user\'s jail infos', '', __LINE__, __FILE__, $sql);
	}

	$sql = 'UPDATE ' . USERS_TABLE . '
		SET user_cell_time = ' . $time . ', user_cell_time_judgement = ' . time() . ', user_cell_caution = ' . $caution . ', user_cell_enable_caution = ' . $cautionable . ', user_cell_enable_free = ' . $freeable . ', user_cell_celleds = user_cell_celleds + 1, user_cell_punishment = ' . $punishment . ', user_cell_sentence = \'' . $sentence . '\'
		WHERE user_id = ' . intval($celled_id);
	if (!$db->sql_query($sql))
	{
		message_die(GENERAL_ERROR, 'Could not update user\'s jail infos', '', __LINE__, __FILE__, $sql);
	}
	else
	{
		message_die(GENERAL_MESSAGE, $lang['Cell_admin_celled_ok'] . $lang['Cell_admin_general_return']);
	}
}

function cell_free_user($celled_id, $freed_by)
{
	global $db;

	$celled_id = intval($celled_id); 
	$freed_by = intval($freed_by);

	$sql = 'UPDATE ' . JAIL_USERS_TABLE . ' SET user_freed_by = ' . $freed_by . ' WHERE user_id = ' . intval($celled_id);
	if (!$result = $db->sql_query($sql))
	{
		message_die(GENERAL_ERROR, '', __LINE__, __FILE__, $sql);
	}
	
	$sql = 'DELETE FROM ' . JAIL_VOTES_TABLE . ' WHERE vote_id = ' . intval($celled_id);
	if (!$result = $db->sql_query($sql))
	{
		message_die(GENERAL_ERROR, '', __LINE__, __FILE__, $sql);
	}

	$sql = 'UPDATE ' . USERS_TABLE . " 
		SET user_cell_time = 0, user_cell_time_judgement = 0, user_cell_enable_caution = 0, user_cell_enable_free = 0, user_cell_sentence = '', user_cell_punishment = 0, user_cell_caution = 0
		WHERE user_id = $celled_id";
	if (!$result = $db->sql_query($sql))
	{
		message_die(GENERAL_ERROR, '', __LINE__, __FILE__, $sql);
	}
}

?>
