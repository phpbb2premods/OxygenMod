<?php
/**
*
* @version $Id: instant_msg_view.php,v 1.2 16/09/2004 Spitfire Pat Exp $
* @version $Id: instant_msg_view.php,v 1.4 14/03/2007 00:27 PastisD Exp $
* @copyright (c) 2006 PastisD - http://www.oxytanium.com/
* @license http://opensource.org/licenses/gpl-license.php GNU Public License 
*
*/

define('IN_PHPBB', true);
$phpbb_root_path = './';

include($phpbb_root_path . 'extension.inc');
include($phpbb_root_path . 'common.'.$phpEx);
include($phpbb_root_path . 'includes/bbcode.'.$phpEx);
include($phpbb_root_path . 'includes/functions_post.'.$phpEx);

//
// Start session management
//
$userdata = session_pagestart($user_ip, PAGE_INDEX);
init_userprefs($userdata);
//
// End session management
//

$html_on = !$board_config['allow_html'] ? 0 : 1;
$bbcode_on = !$board_config['allow_bbcode'] ? 0 : 1;
$smilies_on = !$board_config['allow_smilies'] ? 0 : 1;

$template->set_filenames(array('body' => 'instant_msg_view.tpl'));

if (isset($HTTP_GET_VARS['read']))
{
	$id_msg=$HTTP_GET_VARS['read'];

	/*
	* Define censored word matches
	*/
	$orig_word = array();
	$replacement_word = array();
	obtain_word_list($orig_word, $replacement_word);

	$sql = 'SELECT * FROM ' . INSTANTMSG_TABLE . ' WHERE id_msg = ' . $id_msg;
	if(!$result=$db->sql_query($sql))
	{
		message_die(GENERAL_ERROR, 'Could not query message information', '', __LINE__, __FILE__, $sql);
	}

	if($row=$db->sql_fetchrow($result))
	{
		$template->assign_block_vars('Switch_MSG_Read',array());
		$id_sender = $row['id_sender'];
		$dest = $id_sender;
		$date_message = create_date($board_config['default_dateformat'], $row['date_msg'], $board_config['board_timezone']);
		$message = $row['message'];

		if ( $board_config['allow_smilies'] && $row['enable_smilies'])
		{
			$message = smilies_pass($message);
		}

		$message = preg_replace($orig_word, $replacement_word, $message);
		$message = bbencode_second_pass($message,$row['bbcode_uid']);

		$sql = 'SELECT user_id, username FROM ' . USERS_TABLE . ' WHERE user_id = ' . $id_sender;
//-- mod : rank color system ---------------------------------------------------
//-- add
		$sql = str_replace('SELECT ', 'SELECT user_level, user_color, user_group_id, ', $sql);
//-- fin mod : rank color system -----------------------------------------------

		if (!$result=$db->sql_query($sql))
		{
			message_die(GENERAL_ERROR, 'Could not query users information', '', __LINE__, __FILE__, $sql);
		}
		$row = $db->sql_fetchrow($result);

//-- mod : rank color system ---------------------------------------------------
//-- delete
/*-MOD
		$sender = $row['username'];
MOD-*/
		$sender = $rcs->get_colors($row, $row['username']);
//-- fin mod : rank color system -----------------------------------------------

		$title = $lang['Instant_msg_received_message'];

		$sql = 'DELETE FROM ' . INSTANTMSG_TABLE . ' WHERE id_msg = ' . $id_msg;
		if(!$result=$db->sql_query($sql))
		{
			message_die(GENERAL_ERROR, 'Could not update messages information', '', __LINE__, __FILE__, $sql);
		}
	}
	else
	{
		$message_fin = $lang['Instant_msg_erased_message'];
	}
}
elseif(isset($HTTP_POST_VARS['send']))
{
	$dest = $HTTP_POST_VARS['msg_dest'];
	$sender = $HTTP_POST_VARS['msg_sender'];
	$message = $HTTP_POST_VARS['message'];

	if(!empty($message))
	{
		require_once($phpbb_root_path . 'includes/functions_post.'.$phpEx);
		$bbcode_uid = ( $bbcode_on ) ? make_bbcode_uid() : '';
		$message = prepare_message(trim($message), $html_on, $bbcode_on, $smilies_on, $bbcode_uid);

		$sql = 'INSERT INTO ' . INSTANTMSG_TABLE . " (id_msg, id_sender, id_dest, date_msg, message, bbcode_uid, enable_bbcode, enable_smilies) 
			VALUES ('', '" . $sender . "', '" . $dest . "', '" . time() . "', '" . $message . "', '$bbcode_uid', $bbcode_on, $smilies_on)";
		if (!$result=$db->sql_query($sql))
		{
			$message_fin = $lang['Instant_msg_error_reg_message'];
			$message_retour = $lang['Instant_msg_recommence'];
			$url_retour = append_sid('instant_msg.'.$phpEx . '?dest=' . $dest);
		}
		else
		{
			$message_fin = $lang['Instant_msg_message_send'];
			$message_retour = $lang['Instant_msg_quit'];
			$url_retour = "javascript:window.close();";
		}
	}
	else
	{
		$message_fin = $lang['Instant_msg_empty_message'];
		$message_retour = $lang['Instant_msg_recommence'];
		$url_retour = append_sid('instant_msg.'.$phpEx . '?dest=' . $dest);
	}
	$message_fin .= '<br /><a href="' . $url_retour . '">' . $message_retour . '</a>';
}
elseif(isset($HTTP_GET_VARS['dest']) || isset($HTTP_POST_VARS['reply']))
{
	$dest = (isset($HTTP_GET_VARS['dest'])) ? $HTTP_GET_VARS['dest'] : $HTTP_POST_VARS['msg_dest'];
	$sql = 'SELECT user_id, username FROM ' . USERS_TABLE . ' WHERE user_id = ' . $dest;
//-- mod : rank color system ---------------------------------------------------
//-- add
	$sql = str_replace('SELECT ', 'SELECT user_level, user_color, user_group_id, ', $sql);
//-- fin mod : rank color system -----------------------------------------------

	if(!$result = $db->sql_query($sql))
	{
		message_die(GENERAL_ERROR, 'Could not query user information', '', __LINE__, __FILE__, $sql);
	}
	$row = $db->sql_fetchrow($result);
	$title = $lang['Instant_msg_send_message'];
	$template->assign_block_vars('Switch_Msg_Send',array());
}
else
{
	$title = $lang['Instant_msg_no_action'];
}

//-- mod : rank color system ---------------------------------------------------
//-- delete
/*-MOD
$username = $row['username'];
MOD-*/
//--add
$username = $rcs->get_colors($row, $row['username']);
//-- fin mod : rank color system -----------------------------------------------

$template->assign_vars(array(
	'T_HEAD_STYLESHEET' => $theme['head_stylesheet'],
	'T_THEME_NAME' => $theme['template_name'],

	'TITLE' => $title,
	'MESSAGE' => $message_fin,
	'SENDER' => $sender,
	'DATE' => $date_message,
	'N_DEST' => $dest,
	'N_SENDER' => $userdata['user_id'],

	'L_DEST' => sprintf($lang['You_send_a_message_to'], $username),
	'L_REPLY' => $lang['Reply_instant_msg'],
	'L_SEND' => $lang['Send_instant_msg'],
	'L_AUTHOR' => $lang['Author'],
	'L_YOUR_MESSAGE' => $lang['Your_message'],
	'L_DATE' => $lang['Date'],
	'L_SENDER' => $sender,
	'L_MESSAGE' => $message,

	'U_ACTION' => append_sid('instant_msg_view.' . $phpEx),
));

$template->pparse('body');

?>
