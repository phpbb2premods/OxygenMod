<?php
/***************************************************************************
 *				 functions_wpm.php
 *			     --------------------
 *   copyright	  : (C) 2003, 2005 Duvelske
 *   email		  : duvelske@planet.nl
 *   	 version mod  : 1.09
 *	 For updates please visit: http://www.vitrax.vze.com
 ***************************************************************************/

/***************************************************************************
 *
 *   This program is free software; you can redistribute it and/or modify
 *   it under the terms of the GNU General Public License as published by
 *   the Free Software Foundation; either version 2 of the License, or
 *   (at your option) any later version.
 *
 ***************************************************************************/

function wpm_send_pm($user_to_id, $wpm_subject, $wpm_message, $send_email)
{
	global $board_config, $lang, $db, $phpbb_root_path, $phpEx;

	$sql = 'SELECT * FROM ' . USERS_TABLE . ' WHERE user_id = ' . intval($user_to_id) . ' AND user_id <> ' . ANONYMOUS;
	if ( !$result = $db->sql_query($sql) )
	{
		message_die(GENERAL_ERROR, $lang['non_existing_user'], '', __LINE__, __FILE__, $sql);
	}
	$usertodata = $db->sql_fetchrow($result);

	// prepare wpm message
	$bbcode_uid = make_bbcode_uid();
	$wpm_message = str_replace("'", "''", $board_config['wpm_message']);

	$wpm_message = str_replace('[username]', $usertodata['username'], $wpm_message);
	$wpm_message = str_replace('[user_id]', $usertodata['user_id'], $wpm_message);
	$wpm_message = str_replace('[sitename]', $board_config['sitename'], $wpm_message);

	if (empty($wpm_message))
	{
		$wpm_message = $lang['No_entry_wpm'];
	}

	$wpm_message = prepare_message(trim($wpm_message), 0, 1, 1, $bbcode_uid);
	$msg_time = time();

	// Do inbox limit stuff
	$sql = "SELECT COUNT(privmsgs_id) AS inbox_items, MIN(privmsgs_date) AS oldest_post_time 
		FROM " . PRIVMSGS_TABLE . " 
		WHERE ( privmsgs_type = " . PRIVMSGS_NEW_MAIL . " 
			OR privmsgs_type = " . PRIVMSGS_READ_MAIL . "  
			OR privmsgs_type = " . PRIVMSGS_UNREAD_MAIL . " ) 
			AND privmsgs_to_userid = " . $usertodata['user_id'];
	if ( !($result = $db->sql_query($sql)) )
	{
		message_die(GENERAL_MESSAGE, $lang['No_such_user']);
	}

	$sql_priority = ( SQL_LAYER == 'mysql' ) ? 'LOW_PRIORITY' : '';

	if ( $inbox_info = $db->sql_fetchrow($result) )
	{
		if ( $inbox_info['inbox_items'] >= $board_config['max_inbox_privmsgs'] )
		{
			$sql = "DELETE $sql_priority FROM " . PRIVMSGS_TABLE . " 
				WHERE ( privmsgs_type = " . PRIVMSGS_NEW_MAIL . " 
					OR privmsgs_type = " . PRIVMSGS_READ_MAIL . " 
					OR privmsgs_type = " . PRIVMSGS_UNREAD_MAIL . "  ) 
					AND privmsgs_date = " . $inbox_info['oldest_post_time'] . " 
					AND privmsgs_to_userid = " . $usertodata['user_id'];
			if ( !$db->sql_query($sql) )
			{
				message_die(GENERAL_ERROR, $lang['not_delete_pm'], '', __LINE__, __FILE__, $sql);
			}
		}
	}

	$sql_info = "INSERT INTO " . PRIVMSGS_TABLE . " (privmsgs_type, privmsgs_subject, privmsgs_from_userid, privmsgs_to_userid, privmsgs_date, privmsgs_ip, privmsgs_enable_html, privmsgs_enable_bbcode, privmsgs_enable_smilies, privmsgs_attach_sig)
		VALUES (" . PRIVMSGS_NEW_MAIL . ", '" . str_replace("\'", "''", $wpm_subject) . "', " . $board_config['wpm_userid'] . ", " . $usertodata['user_id'] . ", $msg_time, '$user_ip', 0, 1, 1, 1)";

	if ( !($result = $db->sql_query($sql_info, BEGIN_TRANSACTION)) )
	{
		message_die(GENERAL_ERROR, $lang['no_sent_pm_insert'], "", __LINE__, __FILE__, $sql_info);
	}

	$privmsg_sent_id = $db->sql_nextid();

	$sql = "INSERT INTO " . PRIVMSGS_TEXT_TABLE . " (privmsgs_text_id, privmsgs_bbcode_uid, privmsgs_text)
		VALUES ($privmsg_sent_id, '" . $bbcode_uid . "', '" . str_replace("\'", "''", $wpm_message) . "')";

	if ( !$db->sql_query($sql, END_TRANSACTION) )
	{
		message_die(GENERAL_ERROR, $lang['no_sent_pm_insert'], "", __LINE__, __FILE__, $sql_info);
	}

	// Add to the users new pm counter
	$sql = "UPDATE " . USERS_TABLE . "
		SET user_new_privmsg = user_new_privmsg + 1, user_last_privmsg = '9999999999'
		WHERE user_id = " . $usertodata['user_id']; 
	if ( !$status = $db->sql_query($sql) )
	{
		message_die(GENERAL_ERROR, $lang['no_sent_pm_insert'], '', __LINE__, __FILE__, $sql);
	}

	if ( $send_email && $usertodata['user_notify_pm'] && !empty($usertodata['user_email']) && $usertodata['user_active'] )
	{
		$email_headers = 'From: ' . $board_config['board_email'] . "\nReturn-Path: " . $board_config['board_email'] . "\r\n";

		$script_name = preg_replace('/^\/?(.*?)\/?$/', "\\1", trim($board_config['script_path']));
		$script_name = ( $script_name != '' ) ? $script_name . '/privmsg.'.$phpEx : 'privmsg.'.$phpEx;
		$server_name = trim($board_config['server_name']);
		$server_protocol = ( $board_config['cookie_secure'] ) ? 'https://' : 'http://';
		$server_port = ( $board_config['server_port'] <> 80 ) ? ':' . trim($board_config['server_port']) . '/' : '/';

		include($phpbb_root_path . 'includes/emailer.'.$phpEx);
		$emailer = new emailer($board_config['smtp_delivery']);
			
		$emailer->use_template('privmsg_notify', $usertodata['user_lang']);
		$emailer->extra_headers($email_headers);
		$emailer->email_address($usertodata['user_email']);
		$emailer->set_subject();
			
		$emailer->assign_vars(array(
			'USERNAME' => $usertodata['username'], 
			'SITENAME' => $board_config['sitename'],
			'EMAIL_SIG' => str_replace('<br />', "\n", "-- \n" . $board_config['board_email_sig']), 

			'U_INBOX' => $server_protocol . $server_name . $server_port . $script_name . '?folder=inbox',
		));

		$emailer->send();
		$emailer->reset();
	}

	return;
}