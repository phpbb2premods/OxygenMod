<?php
/**
*
* @version $Id: admin_bots.php,v 1.5.5a 2007/04/08 xx:xx:xx ABDev Exp $
* @copyright (c) 2007 ABDev, EzCom
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
*
* Original author : Adam Marcus, adam_marcus@btinternet.com, 2004
*/

define('IN_PHPBB', 1);

if( !empty($setmodules) )
{
	$filename = basename(__FILE__);
	$module['General']['Manage_Bots'] = $filename;

	return;
}

// load default header
$phpbb_root_path = './../';
require($phpbb_root_path . 'extension.inc');
require('./pagestart.' . $phpEx);

$bot_errors = '';
$submit = isset($HTTP_POST_VARS['submit']) ? true : false;

if (isset($HTTP_GET_VARS['action']) || isset($HTTP_POST_VARS['action']))
{
	$action = isset($HTTP_POST_VARS['action']) ? $HTTP_POST_VARS['action'] : $HTTP_GET_VARS['action'];
}
else
{
	$action = '';
}

$id = isset($HTTP_GET_VARS['id']) ? $HTTP_GET_VARS['id'] : 0;
$mark = isset($HTTP_POST_VARS['mark']) ? $HTTP_POST_VARS['mark'] : 0;
if (isset($_POST['add']))
{
	$action = 'add';
}

if ((sizeof($mark) != 1) && $action == 'edit')
{
	$action = '';
}

if (((sizeof($mark)) ? $mark != '' : false) && $action == 'edit') 
{
	$id = $mark[0];
	$submit = false;
}

switch ($action)
{
	case 'ignore_pending':
	case 'add_pending':
		$pending_number = $HTTP_GET_VARS['pending']; 
		$pending_data = $HTTP_GET_VARS['data']; 

		$sql = "SELECT pending_" . $pending_data . " FROM " . BOTS_TABLE . " WHERE bot_id = " . $id;
		if (!$result = $db->sql_query($sql))
		{
			message_die(GENERAL_ERROR, 'Could not obtain bot data', '', __LINE__, __FILE__, $sql);
		}

		$row = $db->sql_fetchrow($result);
		$pending_array = explode('|', $row['pending_' . $pending_data]);

		if ($action == 'add_pending')
		{
			$new_data = $pending_array[($pending_number-1) * 2];
		}

		array_splice($pending_array, ($pending_number-1) * 2, 2);
		$pending = implode('|', $pending_array);

		$sql = "UPDATE " . BOTS_TABLE . " SET pending_" . $pending_data . "='$pending' WHERE bot_id = " . $id;
		if (!$result = $db->sql_query($sql))
		{
			message_die(GENERAL_ERROR, 'Could not update data in bots table', '', __LINE__, __FILE__, $sql);
		}

		if ($action == 'add_pending')
		{
			$sql = "SELECT bot_" . $pending_data . " FROM " . BOTS_TABLE . " WHERE bot_id = " . $id;
			if (!$result = $db->sql_query($sql))
			{
				message_die(GENERAL_ERROR, 'Could not obtain bot data.', '', __LINE__, __FILE__, $sql);
			}

			$row = $db->sql_fetchrow($result);
			$pending_array = explode('|', $row['bot_' . $pending_data]);
			$new_data = str_replace('|', "&#124;", $new_data);
			$pending_added = false;

			if ($pending_data == 'ip')
			{
				for ($loop = 0; $loop < count($pending_array); $loop++)
				{
					$ip_found = false;
					for ($limit = 9; $limit <= 15; $limit++)
					{
						if (strcmp(substr($pending_array[$loop], 0, $limit), substr($new_data, 0, $limit)) != 0)
						{
							if ($ip_found == true)
							{
								$pending_array[$loop] = substr($pending_array[$loop], 0, ($limit - 1));
								$pending_added = true;
							}
						}
						else
						{
							$ip_found = true;
						}
					}
				}
			}
			else
			{
				for ( $loop = 0; $loop < count($pending_array); $loop++)
				{
					$smaller_string = ((strlen($pending_array[$loop]) > strlen($new_data)) ? $new_data : $pending_array[$loop]);
					$larger_string = ((strlen($pending_array[$loop]) < strlen($new_data)) ? $new_data : $pending_array[$loop]);

					if (strlen($smaller_string) <= 6)
					{
						continue;
					}

					for ($limit = strlen($smaller_string); $limit > 6; $limit--)
					{
						for ($loop2 = 0; $loop2 < (strlen($smaller_string)-$limit) + 1; $loop2++)
						{
							if (strstr($larger_string, substr($smaller_string, $loop2, $limit)))
							{
								$pending_array[$loop] = $smaller_string;
								$pending_added = true;
							}
						}
					}
				}
			}

			if (!$pending_added)
			{
				$pending_array[] = $new_data;
			}

			$pending = implode('|', $pending_array);
			$sql = "UPDATE " . BOTS_TABLE . " SET bot_" . $pending_data . "='$pending' WHERE bot_id = " . $id;
			if (!$result = $db->sql_query($sql))
			{
				message_die(GENERAL_ERROR, 'Could not update data in bots table.', '', __LINE__, __FILE__, $sql);
			}
		}

		$template->set_filenames(array('body' => 'admin/bots_added.tpl'));
		$template->assign_vars(array(
			'S_BOTS_ACTION' => append_sid('admin_bots.' . $phpEx),
			'L_BOT_OK' => $lang['Ok'],
			'L_BOT_RESULT' => $lang['Information'],
			'L_BOT_ADDED' => ($action == 'add_pending') ? $lang['Added_bot'] : $lang['Ignored_bot'],
		));

		$template->pparse('body');
		include('./page_footer_admin.'.$phpEx);
		break;

	case 'delete':
		if ($id || $mark)
		{
			$id = ($id) ? ' = ' . $id : ' IN (' . implode(', ', $mark) . ')';
			$sql = "DELETE FROM " . BOTS_TABLE . " WHERE bot_id $id";
			if (!$result = $db->sql_query($sql))
			{
				message_die(GENERAL_ERROR, 'Could not delete data from bots table', '', __LINE__, __FILE__, $sql);
			}
		}
		break;

	case 'add':
	case 'edit':
		if ($submit)
		{
			if ($HTTP_POST_VARS['bot_ip'] == '')
			{
				if ($HTTP_POST_VARS['bot_agent'] == '')
				{
					$bot_errors = $lang['Error_No_Agent_Or_Ip'];
				}
			}

			if ($_SERVER['REMOTE_ADDR'] == $HTTP_POST_VARS['bot_ip'])
			{
				$bot_errors = $lang['Error_Own_Ip'];
			}

			$bot_name = ($HTTP_POST_VARS['bot_name'] != '') ? $HTTP_POST_VARS['bot_name'] : $lang['Error_No_Bot_Name'];
			
			if ($action == 'edit')
			{
				$sql = "SELECT bot_name FROM " . BOTS_TABLE . " WHERE bot_id = $id";
				if (!$result = $db->sql_query($sql))
				{
					message_die(GENERAL_ERROR, 'Could not delete data from bots table', '', __LINE__, __FILE__, $sql);
				}

				$row = $db->sql_fetchrow($result);
				$current_name = $row['bot_name'];
				$db->sql_freeresult($result);

				$sql = "SELECT bot_name FROM " . BOTS_TABLE . " WHERE bot_name = '$bot_name'";
				if (!$result = $db->sql_query($sql))
				{
					message_die(GENERAL_ERROR, 'Could not delete data from bots table', '', __LINE__, __FILE__, $sql);
				}
			
				$sql_bot_name_check = $db->sql_numrows($result);
				$db->sql_freeresult($result);

				if(($sql_bot_name_check > 0) && ($current_name != $bot_name))
				{
					$bot_errors = $lang['Error_Bot_Name_Taken'];
				}
			}

			if ($action == 'add')
			{
				$sql = "SELECT bot_name FROM " . BOTS_TABLE . " WHERE bot_name = '$bot_name'";
				if (!$result = $db->sql_query($sql))
				{
					message_die(GENERAL_ERROR, 'Could not delete data from bots table', '', __LINE__, __FILE__, $sql);
				}

				$sql_bot_name_check = $db->sql_numrows($result);

				if($sql_bot_name_check > 0)
				{
					$bot_errors = $lang['Error_Bot_Name_Taken'];
				}
			}

			if (!$bot_errors)
			{
				$bot_agent = ($HTTP_POST_VARS['bot_agent'] != '') ? $HTTP_POST_VARS['bot_agent'] : '';
				$bot_ip = ($HTTP_POST_VARS['bot_ip'] != '') ? $HTTP_POST_VARS['bot_ip'] : '';
				$bot_style = $HTTP_POST_VARS['style'];
				$bot_ip = str_replace(' ', '', $bot_ip);

				if ($action == 'add')
				{
					$sql = "INSERT INTO " . BOTS_TABLE . " (bot_name, bot_agent, bot_ip, bot_style)
						VALUES ('$bot_name', '$bot_agent', '$bot_ip', '$bot_style')";
					if (!$result = $db->sql_query($sql))
					{
						message_die(GENERAL_ERROR, 'Could not insert data into bots table', '', __LINE__, __FILE__, $sql);
					}
				}
				else
				{
					$sql = "UPDATE " . BOTS_TABLE . " 
						SET bot_name='$bot_name', bot_agent='$bot_agent', bot_ip='$bot_ip', bot_style='$bot_style' 
						WHERE bot_id = $id";
					if (!$result = $db->sql_query($sql))
					{
						message_die(GENERAL_ERROR, 'Could not update data in bots table', '', __LINE__, __FILE__, $sql);
					}
				}

				$template->set_filenames(array('body' => 'admin/bots_added.tpl'));

				$template->assign_vars(array(
					'S_BOTS_ACTION' => append_sid('admin_bots.' . $phpEx),
					'L_BOT_OK' => $lang['Ok'],
					'L_BOT_RESULT' => $lang['Information'],
					'L_BOT_ADDED' => ($action == 'edit') ? $lang['Modified_bot'] : $lang['Added_bot'],
				));

				$template->pparse('body');
				include('./page_footer_admin.'.$phpEx);
				$db->sql_freeresult($result);
			}
		}

		if (!$submit || $bot_errors)
		{
			$template->set_filenames(array('body' => 'admin/bots_add_body.tpl'));

			if ($id)
			{
				$sql = "SELECT bot_name, bot_agent, bot_ip, bot_style FROM " . BOTS_TABLE . " WHERE bot_id = $id";
				if (!$result = $db->sql_query($sql))
				{
					message_die(GENERAL_ERROR, 'Could not get data from bots table', '', __LINE__, __FILE__, $sql);
				}

				$row = $db->sql_fetchrow($result);
				$db->sql_freeresult($result);

				$sql = 'SELECT template_name FROM ' . THEMES_TABLE;
				if (!$result = $db->sql_query($sql))
				{
					message_die(GENERAL_ERROR, 'Could not get data from themes table', '', __LINE__, __FILE__, $sql);
				}

				$loop = 0;
				$bot_style = '';
				while ($row2 = $db->sql_fetchrow($result))
				{
					$loop++;
					$bot_style .= '<option "' . (($loop == $row['bot_style']) ? "selected" : '') . '" value="' . $loop . '">' . $row2['template_name'] . '</option>';
				}

				$template->assign_vars(array(
					'BOT_NAME' => $row['bot_name'],
					'BOT_AGENT' => $row['bot_agent'],
					'BOT_IP' => $row['bot_ip'],
				));
			}
		}

		if ($bot_errors)
		{
			$template->assign_block_vars('errorrow', array('BOT_ERROR' => $bot_errors));
		}

		if (!$bot_style)
		{
			$sql = 'SELECT template_name FROM ' . THEMES_TABLE;
			if (!$result = $db->sql_query($sql))
			{
				message_die(GENERAL_ERROR, 'Could not get data from themes table', '', __LINE__, __FILE__, $sql);
			}

			$loop = 0;
			$bot_style = '';
			while ($row2 = $db->sql_fetchrow($result))
			{
				$loop++;
				$bot_style .= '<option value="' . $loop . '">' . $row2['template_name'] . '</option>';
			}
		}

		$template->assign_vars(array(
			'S_BOTS_ACTION' => append_sid('admin_bots.' . $phpEx) . '&action=' . $action . '&id=' . $id,

			'BOT_STYLE' => $bot_style,

			'L_BOTS_TITLE' => ($action == 'edit') ? $lang['Bots_edit'] : $lang['Bots_add'],
			'L_BOTS_TITLE_EXPLAIN' => ($action == 'edit') ? $lang['Bots_edit_explain'] : $lang['Bots_add_explain'],
			'L_BOT_SUBMIT' => $lang['Submit'],
			'L_BOT_RESET' => $lang['Reset'],
			'L_BOT_NAME' => $lang['Bot_Name'],
			'L_BOT_AGENT' => $lang['Bot_Agent'],
			'L_BOT_IP' => $lang['Bot_Ip'],
			'L_BOT_STYLE' => $lang['Bot_Style'],
			'L_BOT_NAME_EXPLAIN' => $lang['Bot_Name_Explain'],
			'L_BOT_AGENT_EXPLAIN' => $lang['Bot_Agent_Explain'],
			'L_BOT_IP_EXPLAIN' => $lang['Bot_Ip_Explain'],
			'L_BOT_STYLE_EXPLAIN' => $lang['Bot_Style_Explain']
		));

		$template->pparse('body');
		include('./page_footer_admin.'.$phpEx);
		break;
}

$template->set_filenames(array('body' => 'admin/bots_body.tpl'));

$total_posts = get_db_stat('postcount');
$total_users = get_db_stat('usercount');
$total_topics = get_db_stat('topiccount');
$total_pages = floor($total_topics / $board_config['topics_per_page']);
$total_pages += floor($total_posts / $board_config['posts_per_page']);
$total_pages += $total_users + floor($total_users / 50);
$total_pages = floor($total_pages * 1.35);

$sql = "SELECT bot_id, bot_name, last_visit, bot_visits, bot_pages FROM " . BOTS_TABLE;
if (!$result = $db->sql_query($sql))
{
	message_die(GENERAL_ERROR, 'Could not query bots', '', __LINE__, __FILE__, $sql);
}
while ($row = $db->sql_fetchrow($result))
{
	$row_class = ( ($row_class == $theme['td_class2']) ? $theme['td_class1'] : $theme['td_class2']);
	$last_visits = explode('|', $row['last_visit']);

	if (empty($last_visits[0]))
	{
		$last_visit = $lang['Never'];
	}
	else
	{
		$last_visit = '<select>';
		foreach ($last_visits as $visit)
		{
			$last_visit .= '<option>' . date('j M y H:i:s', $visit) . '</option>';
		}
		$last_visit .= '</select>';
	}

	$bot_pages = $row['bot_pages'];
	$percentage = round(($bot_pages / $total_pages) * 100);
	$bot_pages .= ' (' . (($percentage < 100) ? $percentage : 100)  . '%)';

	$template->assign_block_vars('botrow', array(
		'ROW_NUMBER' => $row['bot_id'],
		'ROW_CLASS' => $row_class,
		'BOT_NAME' => $row['bot_name'],
		'PAGES' => $bot_pages,
		'VISITS' => $row['bot_visits'],
		'LAST_VISIT' => $last_visit,
	));
}

if (!$db->sql_numrows($result))
{
	$template->assign_block_vars('nobotrow', array('NO_BOTS' => $lang['No_Bots']));
}

$db->sql_freeresult($result);

$sql = "SELECT bot_id, bot_name, pending_agent, pending_ip FROM " . BOTS_TABLE;
if (!$result = $db->sql_query($sql))
{
	message_die(GENERAL_ERROR, 'Could not query bots.', '', __LINE__, __FILE__, $sql);
}

$pending_bots = 0;
while ($row = $db->sql_fetchrow($result))
{
	if ($row['pending_agent'])
	{
		$pending_array = explode('|', $row['pending_agent']);
		if ($pending_array)
		{
			$pending_bots = 1;
		}

		for ($loop = 0; $loop < count($pending_array); $loop+=2)
		{
			$row_class = (($row_class == $theme['td_class2']) ? $theme['td_class1'] : $theme['td_class2']);

			$template->assign_block_vars('pendingrow', array(
				'ROW_NUMBER' => $row['bot_id'],
				'PENDING_NUMBER' => ($loop/2) + 1,
				'PENDING_DATA' => 'agent',
				'ROW_CLASS' => $row_class,
				'BOT_NAME' => $row['bot_name'],
				'AGENT' => '<b>' . $pending_array[$loop] . '</b>',
				'IP' => '<a href="http://network-tools.com/default.asp?host="' . $pending_array[$loop+1] . '" target="_phpbbwhois">' . $pending_array[$loop+1] . '</a>',
			));	
		}
	}

	if ($row['pending_ip'])
	{
		$pending_array = explode('|', $row['pending_ip']);
		if ($pending_array)
		{
			$pending_bots = 1;
		}

		for ($loop = 0; $loop < count($pending_array); $loop+=2)
		{
			$row_class = (($row_class == $theme['td_class2']) ? $theme['td_class1'] : $theme['td_class2']);

			$template->assign_block_vars('pendingrow', array(
				'ROW_NUMBER' => $row['bot_id'],
				'PENDING_NUMBER' => ($loop/2) + 1,
				'PENDING_DATA' => 'ip',
				'ROW_CLASS' => $row_class,
				'BOT_NAME' => $row['bot_name'],
				'AGENT' => $pending_array[$loop+1],
				'IP' => '<b><a href="http://network-tools.com/default.asp?host="' . $pending_array[$loop] . '" target="_phpbbwhois">' . $pending_array[$loop] . '</a></b>',
			));	
		}
	}
}

if (!$pending_bots)
{
	$template->assign_block_vars('nopendingrow', array('NO_BOTS' => $lang['No_Pending_Bots']));
}

$db->sql_freeresult($result);

$template->assign_vars(array(
	'S_BOTS_ACTION' => append_sid('admin_bots.' . $phpEx),

	'L_BOTS_TITLE' => $lang['Manage_Bots'],
	'L_BOTS_EXPLAIN' => $lang['Bot_Explain'],
	'L_BOTS_TITLE_PENDING' => $lang['Pending_Bots'],
	'L_BOTS_EXPLAIN_PENDING' => $lang['Pending_Explain'],
	'L_BOT_IP' => $lang['Bot_Ip'],
	'L_BOT_AGENT' => $lang['Bot_Agent'],
	'L_BOT_NAME' => $lang['Bot_Name'],
	'L_BOT_LAST_VISIT' => $lang['Last_Visit'],
	'L_BOT_VISITS' => $lang['Visits'],
	'L_BOT_PAGES' => $lang['Pages'],
	'L_BOT_OPTIONS' => $lang['Options'],
	'L_BOT_MARK' => $lang['Mark'],
	'L_BOT_IGNORE' => $lang['Delete'],
	'L_BOT_ADD' => $lang['Create'],
	'L_BOT_SUBMIT' => $lang['Submit'],
	'L_BOT_DELETE' => $lang['Delete'],
	'L_BOT_EDIT' => $lang['Edit'],
));


$template->pparse('body');

include('./page_footer_admin.'.$phpEx);

?>
