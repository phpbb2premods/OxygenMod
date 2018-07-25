<?php
/***************************************************************************
 *                            functions_post.php
 *                            -------------------
 *   begin                : Saturday, Feb 13, 2001
 *   copyright            : (C) 2001 The phpBB Group
 *   email                : support@phpbb.com
 *
 *   $Id: functions_post.php,v 1.9.2.52 2006/05/06 13:38:55 grahamje Exp $
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

if (!defined('IN_PHPBB'))
{
	die('Hacking attempt');
}

$html_entities_match = array('#&(?!(\#[0-9]+;))#', '#<#', '#>#', '#"#');
$html_entities_replace = array('&amp;', '&lt;', '&gt;', '&quot;');

$unhtml_specialchars_match = array('#&gt;#', '#&lt;#', '#&quot;#', '#&amp;#');
$unhtml_specialchars_replace = array('>', '<', '"', '&');

//
// This function will prepare a posted message for
// entry into the database.
//
function prepare_message($message, $html_on, $bbcode_on, $smile_on, $bbcode_uid = 0)
{
	global $board_config, $html_entities_match, $html_entities_replace;

	//
	// Clean up the message
	//
	$message = trim($message);

	if ($html_on)
	{
		// If HTML is on, we try to make it safe
		// This approach is quite agressive and anything that does not look like a valid tag
		// is going to get converted to HTML entities
		$message = stripslashes($message);
		$html_match = '#<[^\w<]*(\w+)((?:"[^"]*"|\'[^\']*\'|[^<>\'"])+)?>#';
		$matches = array();

		$message_split = preg_split($html_match, $message);
		preg_match_all($html_match, $message, $matches);

		$message = '';

		foreach ($message_split as $part)
		{
			$tag = array(array_shift($matches[0]), array_shift($matches[1]), array_shift($matches[2]));
			$message .= preg_replace($html_entities_match, $html_entities_replace, $part) . clean_html($tag);
		}

		$message = addslashes($message);
		$message = str_replace('&quot;', '\&quot;', $message);
	}
	else
	{
		$message = preg_replace($html_entities_match, $html_entities_replace, $message);
	}

	if($bbcode_on && $bbcode_uid != '')
	{
		$message = bbencode_first_pass($message, $bbcode_uid);
	}

	return $message;
}

function unprepare_message($message)
{
	global $unhtml_specialchars_match, $unhtml_specialchars_replace;

	return preg_replace($unhtml_specialchars_match, $unhtml_specialchars_replace, $message);
}

//
// Prepare a message for posting
// 
function prepare_post(&$mode, &$post_data, &$bbcode_on, &$html_on, &$smilies_on, &$error_msg, &$username, &$bbcode_uid, &$subject, &$message, &$poll_title, &$poll_options, &$poll_length)
{
	global $board_config, $userdata, $lang, $phpEx, $phpbb_root_path;

	// Check username
//-- mod : force guests to enter their username --------------------------------
//-- delete
/*-MOD
	if (!empty($username))
MOD-*/
//-- add
	if ($board_config['guests_need_name'] && empty($username) && !$userdata['session_logged_in'])
	{
		$error_msg .= (!empty($error_msg)) ? '<br />' . $lang['Username_needed'] : $lang['Username_needed'];
	}
	else if (!empty($username))
//-- fin mod : force guests to enter their username ----------------------------
	{
		$username = phpbb_clean_username($username);

		if (!$userdata['session_logged_in'] || ($userdata['session_logged_in'] && $username != $userdata['username']))
		{
			include($phpbb_root_path . 'includes/functions_validate.'.$phpEx);

			$result = validate_username($username);
			if ($result['error'])
			{
				$error_msg .= (!empty($error_msg)) ? '<br />' . $result['error_msg'] : $result['error_msg'];
			}
		}
		else
		{
			$username = '';
		}
	}

//-- mod : limit smilies per post ----------------------------------------------
//-- add
	if (substr_count(smilies_pass($message), '<img src="'. $board_config['smilies_path']) > $board_config['max_smilies'] )
	{
		$to_much_smilies = substr_count(smilies_pass($message), '<img src="'. $board_config['smilies_path']) - $board_config['max_smilies'];
		$to_many_smilies = sprintf($lang['Max_smilies_per_post'], $board_config['max_smilies'], $to_much_smilies);
		$error_msg .= ( !empty($error_msg) ) ? '<br />' . $to_many_smilies : $to_many_smilies;
	}
//-- fin mod : limit smilies per post ------------------------------------------

	// Check subject
	if (!empty($subject))
	{
		$subject = htmlspecialchars(trim($subject));
	}
	else if ($mode == 'newtopic' || ($mode == 'editpost' && $post_data['first_post']))
	{
		$error_msg .= (!empty($error_msg)) ? '<br />' . $lang['Empty_subject'] : $lang['Empty_subject'];
	}

	// Check message
	if (!empty($message))
	{
		$bbcode_uid = ($bbcode_on) ? make_bbcode_uid() : '';
		$message = prepare_message(trim($message), $html_on, $bbcode_on, $smilies_on, $bbcode_uid);
	}
	else if ($mode != 'delete' && $mode != 'poll_delete') 
	{
		$error_msg .= (!empty($error_msg)) ? '<br />' . $lang['Empty_message'] : $lang['Empty_message'];
	}

	//
	// Handle poll stuff
	//
	if ($mode == 'newtopic' || ($mode == 'editpost' && $post_data['first_post']))
	{
		$poll_length = (isset($poll_length)) ? max(0, intval($poll_length)) : 0;

		if (!empty($poll_title))
		{
			$poll_title = htmlspecialchars(trim($poll_title));
		}

		if(!empty($poll_options))
		{
			$temp_option_text = array();
			while(list($option_id, $option_text) = @each($poll_options))
			{
				$option_text = trim($option_text);
				if (!empty($option_text))
				{
					$temp_option_text[intval($option_id)] = htmlspecialchars($option_text);
				}
			}
			$option_text = $temp_option_text;

			if (count($poll_options) < 2)
			{
				$error_msg .= (!empty($error_msg)) ? '<br />' . $lang['To_few_poll_options'] : $lang['To_few_poll_options'];
			}
			else if (count($poll_options) > $board_config['max_poll_options']) 
			{
				$error_msg .= (!empty($error_msg)) ? '<br />' . $lang['To_many_poll_options'] : $lang['To_many_poll_options'];
			}
			else if ($poll_title == '')
			{
				$error_msg .= (!empty($error_msg)) ? '<br />' . $lang['Empty_poll_title'] : $lang['Empty_poll_title'];
			}
		}
	}

	return;
}

//
// Post a new topic/reply/poll or edit existing post/poll
//
//-- mod : double post merge ---------------------------------------------------
// here we added
//	, &$added
//-- modify
//-- mod : post icon -----------------------------------------------------------
// here we added
//	, $post_icon = 0
//-- modify
//-- mod : lock during posting -------------------------------------------------
// here we added
//	, &$lock_status, $current_lock_status = 0
//-- modify
//-- mod : post description ----------------------------------------------------
// here we added
//	, $post_sub_title
//-- modify
function submit_post($mode, &$post_data, &$message, &$meta, &$forum_id, &$topic_id, &$post_id, &$poll_id, &$topic_type, &$bbcode_on, &$html_on, &$smilies_on, &$attach_sig, &$bbcode_uid, $post_username, $post_subject, $post_sub_title, $post_message, $poll_title, &$poll_options, &$poll_length, &$lock_status, $current_lock_status = 0, &$added, $post_icon = 0)
//-- fin mod : post description ------------------------------------------------
//-- fin mod : lock during posting ---------------------------------------------
//-- fin mod : post icon -------------------------------------------------------
//-- fin mod : double post merge -----------------------------------------------
{
	global $board_config, $lang, $db, $phpbb_root_path, $phpEx;
	global $userdata, $user_ip;

//-- mod : points system -------------------------------------------------------
//-- add
	global $post_info;
//-- fin mod : points system ---------------------------------------------------

	include($phpbb_root_path . 'includes/functions_search.'.$phpEx);

	$current_time = time();

	if ($mode == 'newtopic' || $mode == 'reply' || $mode == 'editpost') 
	{
		//
		// Flood control
		//
//-- mod : no flood limit for admins & mods ------------------------------------
//-- add
		if($userdata['user_level'] != ADMIN && $userdata['user_level'] != MOD)
		{
//-- mod : no flood limit for admins & mods ------------------------------------
			$where_sql = ($userdata['user_id'] == ANONYMOUS) ? "poster_ip = '$user_ip'" : 'poster_id = ' . $userdata['user_id'];
			$sql = 'SELECT MAX(post_time) AS last_post_time
				FROM ' . POSTS_TABLE . '
				WHERE ' . $where_sql;
			if ($result = $db->sql_query($sql))
			{
				if ($row = $db->sql_fetchrow($result))
				{
					if (intval($row['last_post_time']) > 0 && ($current_time - intval($row['last_post_time'])) < intval($board_config['flood_interval']))
					{
						message_die(GENERAL_MESSAGE, $lang['Flood_Error']);
					}
				}
			}
//-- mod : no flood limit for admins & mods ------------------------------------
//-- add
		}
//-- mod : no flood limit for admins & mods ------------------------------------
	}

//-- mod : double post merge ---------------------------------------------------
//-- add
	if ( $added && $mode == 'editpost' )
	{
		$sql = 'UPDATE ' . POSTS_TABLE . ' SET post_time = ' . $current_time . ' WHERE post_id = ' . $post_id;
		if ( !($result = $db->sql_query($sql)) )
		{
			message_die(GENERAL_ERROR, 'Could not update last post time', '', __LINE__, __FILE__, $sql);
		}
	}
//-- fin mod : double post merge -----------------------------------------------

	if ($mode == 'editpost')
	{
		remove_search_post($post_id);
	}

//-- mod : lock during posting -------------------------------------------------
//-- add
	// This part of the code handles updates to the topic
	// if a post OTHER than the first post is edited and
	// the lock status is changed.
	if ($mode == 'editpost' && !($post_data['first_post']) && $current_lock_status <> $lock_status)
	{
		$sql  = 'UPDATE ' . TOPICS_TABLE . '
			SET topic_status = ' . $lock_status . '
			WHERE topic_id = ' . $topic_id;
		if (!$db->sql_query($sql))
		{
			message_die(GENERAL_ERROR, 'Error in posting', '', __LINE__, __FILE__, $sql);
		}
	}
//-- fin mod : lock during posting ---------------------------------------------

//-- mod : post description ----------------------------------------------------
//-- add
	// prepare sub-title data
	$common = new common();
	$post_sub_title = $common->sql_type_cast($post_sub_title, true);
	unset($common);
//-- fin mod : post description ------------------------------------------------

	if ($mode == 'newtopic' || ($mode == 'editpost' && $post_data['first_post']))
	{
		$topic_vote = (!empty($poll_title) && count($poll_options) >= 2) ? 1 : 0;

//-- mod : lock during posting -------------------------------------------------
//-- delete
/*-MOD
		$sql  = ($mode != "editpost") ? "INSERT INTO " . TOPICS_TABLE . " (topic_title, topic_poster, topic_time, forum_id, topic_status, topic_type, topic_vote) VALUES ('$post_subject', " . $userdata['user_id'] . ", $current_time, $forum_id, " . TOPIC_UNLOCKED . ", $topic_type, $topic_vote)" : "UPDATE " . TOPICS_TABLE . " SET topic_title = '$post_subject', topic_type = $topic_type " . (($post_data['edit_vote'] || !empty($poll_title)) ? ", topic_vote = " . $topic_vote : "") . " WHERE topic_id = $topic_id";
MOD-*/
//-- add
//-- mod : post icon -----------------------------------------------------------
// here we added
//	, topic_icon
//	, $post_icon
//	, topic_icon = $post_icon
//-- modify
		$sql  = ($mode != "editpost") ? "INSERT INTO " . TOPICS_TABLE . " (topic_title, topic_poster, topic_time, forum_id, topic_status, topic_type, topic_icon, topic_vote) VALUES ('$post_subject', " . $userdata['user_id'] . ", $current_time, $forum_id, $lock_status, $topic_type, $post_icon, $topic_vote)" : "UPDATE " . TOPICS_TABLE . " SET topic_title = '$post_subject', topic_type = $topic_type, topic_status = $lock_status, topic_icon = $post_icon " . (($post_data['edit_vote'] || !empty($poll_title)) ? ", topic_vote = " . $topic_vote : "") . " WHERE topic_id = $topic_id";
//-- fin mod : post icon -------------------------------------------------------
//-- fin mod : lock during posting ---------------------------------------------

//-- mod : post description ----------------------------------------------------
//-- add
		// send topic sub-title data
		if ( $mode != 'editpost' )
		{
			$sql = str_replace('INSERT INTO ' . TOPICS_TABLE . ' (', 'INSERT INTO ' . TOPICS_TABLE . ' (topic_sub_title, ', $sql);
			$sql = str_replace('VALUES (', 'VALUES (' . $post_sub_title . ', ', $sql);
		}
		else
		{
			$sql = str_replace('SET ', 'SET topic_sub_title = ' . $post_sub_title . ', ', $sql);
		}
//-- fin mod : post description ------------------------------------------------

		if (!$db->sql_query($sql))
		{
			message_die(GENERAL_ERROR, 'Error in posting', '', __LINE__, __FILE__, $sql);
		}

		if ($mode == 'newtopic')
		{
			$topic_id = $db->sql_nextid();
		}
	}

//-- mod : topics a user has started -------------------------------------------
//-- add
	if ($mode == 'newtopic')
	{
		$sql = 'UPDATE ' . USERS_TABLE . '
			SET user_topics = user_topics + 1
			WHERE user_id = ' . $userdata['user_id'];
		if (!$db->sql_query($sql))
		{
			message_die(GENERAL_ERROR, 'Error in posting', '', __LINE__, __FILE__, $sql);
		}
	}
//-- fin mod : topics a user has started ---------------------------------------

	$edited_sql = ($mode == 'editpost' && !$post_data['last_post'] && $post_data['poster_post']) ? ", post_edit_time = $current_time, post_edit_count = post_edit_count + 1 " : "";

//-- mod : post icon -----------------------------------------------------------
// here we added
// , post_icon
// , $post_icon
//  , post_icon = $post_icon
//-- modify
	$sql = ($mode != "editpost") ? "INSERT INTO " . POSTS_TABLE . " (topic_id, forum_id, poster_id, post_username, post_time, poster_ip, enable_bbcode, enable_html, enable_smilies, enable_sig, post_icon) VALUES ($topic_id, $forum_id, " . $userdata['user_id'] . ", '$post_username', $current_time, '$user_ip', $bbcode_on, $html_on, $smilies_on, $attach_sig, $post_icon)" : "UPDATE " . POSTS_TABLE . " SET post_username = '$post_username', enable_bbcode = $bbcode_on, enable_html = $html_on, enable_smilies = $smilies_on, enable_sig = $attach_sig, post_icon = $post_icon" . $edited_sql . " WHERE post_id = $post_id";
//-- fin mod : post icon -------------------------------------------------------

	if (!$db->sql_query($sql, BEGIN_TRANSACTION))
	{
		message_die(GENERAL_ERROR, 'Error in posting', '', __LINE__, __FILE__, $sql);
	}

	if ($mode != 'editpost')
	{
		$post_id = $db->sql_nextid();
	}

//-- mod : post description ----------------------------------------------------
// here we added
//	, post_sub_title
//	, $post_sub_title
//	, post_sub_title = $post_sub_title
//-- modify
	$sql = ($mode != 'editpost') ? "INSERT INTO " . POSTS_TEXT_TABLE . " (post_id, post_subject, post_sub_title, bbcode_uid, post_text) VALUES ($post_id, '$post_subject', $post_sub_title, '$bbcode_uid', '$post_message')" : "UPDATE " . POSTS_TEXT_TABLE . " SET post_text = '$post_message',  bbcode_uid = '$bbcode_uid', post_subject = '$post_subject', post_sub_title = $post_sub_title WHERE post_id = $post_id";
	//-- fin mod : post description ------------------------------------------------

	if (!$db->sql_query($sql))
	{
		message_die(GENERAL_ERROR, 'Error in posting', '', __LINE__, __FILE__, $sql);
	}

//-- mod : bump topic ----------------------------------------------------------
//-- add
	if ( $mode == 'newtopic' || $mode == 'reply' || ($mode == 'editpost' && $post_data['last_post']) )
	{
		reset_topic_bumped($mode, $topic_id, $current_time);
	}
//-- fin mod : bump topic ------------------------------------------------------

	add_search_words('single', $post_id, stripslashes($post_message), stripslashes($post_subject));

	//
	// Add poll
	// 
	if (($mode == 'newtopic' || ($mode == 'editpost' && $post_data['edit_poll'])) && !empty($poll_title) && count($poll_options) >= 2)
	{
		$sql = (!$post_data['has_poll']) ? "INSERT INTO " . VOTE_DESC_TABLE . " (topic_id, vote_text, vote_start, vote_length) VALUES ($topic_id, '$poll_title', $current_time, " . ($poll_length * 86400) . ")" : "UPDATE " . VOTE_DESC_TABLE . " SET vote_text = '$poll_title', vote_length = " . ($poll_length * 86400) . " WHERE topic_id = $topic_id";
		if (!$db->sql_query($sql))
		{
			message_die(GENERAL_ERROR, 'Error in posting', '', __LINE__, __FILE__, $sql);
		}

		$delete_option_sql = '';
		$old_poll_result = array();
		if ($mode == 'editpost' && $post_data['has_poll'])
		{
			$sql = 'SELECT vote_option_id, vote_result  
				FROM ' . VOTE_RESULTS_TABLE . ' 
				WHERE vote_id = ' . $poll_id . '
				ORDER BY vote_option_id ASC';
			if (!($result = $db->sql_query($sql)))
			{
				message_die(GENERAL_ERROR, 'Could not obtain vote data results for this topic', '', __LINE__, __FILE__, $sql);
			}

			while ($row = $db->sql_fetchrow($result))
			{
				$old_poll_result[$row['vote_option_id']] = $row['vote_result'];

				if (!isset($poll_options[$row['vote_option_id']]))
				{
					$delete_option_sql .= ($delete_option_sql != '') ? ', ' . $row['vote_option_id'] : $row['vote_option_id'];
				}
			}
		}
		else
		{
			$poll_id = $db->sql_nextid();
		}

		@reset($poll_options);

		$poll_option_id = 1;
		while (list($option_id, $option_text) = each($poll_options))
		{
			if (!empty($option_text))
			{
				$option_text = str_replace("\'", "''", htmlspecialchars($option_text));
				$poll_result = ($mode == "editpost" && isset($old_poll_result[$option_id])) ? $old_poll_result[$option_id] : 0;

				$sql = ($mode != "editpost" || !isset($old_poll_result[$option_id])) ? "INSERT INTO " . VOTE_RESULTS_TABLE . " (vote_id, vote_option_id, vote_option_text, vote_result) VALUES ($poll_id, $poll_option_id, '$option_text', $poll_result)" : "UPDATE " . VOTE_RESULTS_TABLE . " SET vote_option_text = '$option_text', vote_result = $poll_result WHERE vote_option_id = $option_id AND vote_id = $poll_id";
				if (!$db->sql_query($sql))
				{
					message_die(GENERAL_ERROR, 'Error in posting', '', __LINE__, __FILE__, $sql);
				}
				$poll_option_id++;
			}
		}

		if ($delete_option_sql != '')
		{
			$sql = 'DELETE FROM ' . VOTE_RESULTS_TABLE . ' 
				WHERE vote_option_id IN (' . $delete_option_sql . ') 
					AND vote_id = ' . $poll_id;
			if (!$db->sql_query($sql))
			{
				message_die(GENERAL_ERROR, 'Error deleting pruned poll options', '', __LINE__, __FILE__, $sql);
			}
		}
	}

//-- mod : points system -------------------------------------------------------
//-- add
	if ($board_config['points_post'] && !$post_info['points_disabled'] && (($mode == 'newtopic') || ($mode == 'reply')) )
	{
		$points = abs(($mode == 'newtopic') ? $board_config['points_topic'] : $board_config['points_reply']);

		if (($userdata['user_id'] != ANONYMOUS) && ($userdata['admin_allow_points']))
		{
			add_points($userdata['user_id'], $points);
		}
	}
//-- fin mod : points system ---------------------------------------------------

	$meta = '<meta http-equiv="refresh" content="3;url=' . append_sid("viewtopic.$phpEx?" . POST_POST_URL . "=" . $post_id) . '#' . $post_id . '">';

	$message = $lang['Stored'] . '<br /><br />' . sprintf($lang['Click_view_message'], '<a href="' . append_sid("viewtopic.$phpEx?" . POST_POST_URL . "=" . $post_id) . '#' . $post_id . '">', '</a>') . '<br /><br />' . sprintf($lang['Click_return_forum'], '<a href="' . append_sid("viewforum.$phpEx?" . POST_FORUM_URL . "=$forum_id") . '">', '</a>');

	return false;
}

//
// Update post stats and details
//
//-- mod : lock during posting -------------------------------------------------
// here we added
//	, &$lock_status
//-- modify
function update_post_stats(&$mode, &$post_data, &$forum_id, &$topic_id, &$post_id, &$user_id, &$lock_status)
//-- fin mod : lock during posting ---------------------------------------------
{
	global $db;

	$sign = ($mode == 'delete') ? '- 1' : '+ 1';
	$forum_update_sql = "forum_posts = forum_posts $sign";
	$topic_update_sql = '';

	if ($mode == 'delete')
	{
		if ($post_data['last_post'])
		{
			if ($post_data['first_post'])
			{
				$forum_update_sql .= ', forum_topics = forum_topics - 1';

//-- mod : topics a user has started -------------------------------------------
//-- add
				$sql = 'UPDATE ' . USERS_TABLE . '
					SET user_topics = user_topics - 1
					WHERE user_id = ' . $user_id;
				if (!$db->sql_query($sql))
				{
					message_die(GENERAL_ERROR, 'Error in deleting post', '', __LINE__, __FILE__, $sql);
				}
//-- fin mod : topics a user has started ---------------------------------------

			}
			else
			{

				$topic_update_sql .= 'topic_replies = topic_replies - 1';

				$sql = 'SELECT MAX(post_id) AS last_post_id
					FROM ' . POSTS_TABLE . ' 
					WHERE topic_id = ' . $topic_id;
//-- mod : bump topic ----------------------------------------------------------
//-- add
				$sql = str_replace('SELECT ', 'SELECT MAX(post_time) as last_post_time, ', $sql);
//-- fin mod : bump topic ------------------------------------------------------
				if (!($result = $db->sql_query($sql)))
				{
					message_die(GENERAL_ERROR, 'Error in deleting post', '', __LINE__, __FILE__, $sql);
				}

				if ($row = $db->sql_fetchrow($result))
				{
					$topic_update_sql .= ', topic_last_post_id = ' . $row['last_post_id'];
//-- mod : bump topic ----------------------------------------------------------
//-- add
					$topic_update_sql .= ', topic_last_post_time = ' . $row['last_post_time'] . ', topic_bumped = 0, topic_bumper = 0';
//-- fin mod : bump topic ------------------------------------------------------
				}
			}

			if ($post_data['last_topic'])
			{
				$sql = 'SELECT MAX(post_id) AS last_post_id
					FROM ' . POSTS_TABLE . ' 
					WHERE forum_id = ' . $forum_id; 
				if (!($result = $db->sql_query($sql)))
				{
					message_die(GENERAL_ERROR, 'Error in deleting post', '', __LINE__, __FILE__, $sql);
				}

				if ($row = $db->sql_fetchrow($result))
				{
					$forum_update_sql .= ($row['last_post_id']) ? ', forum_last_post_id = ' . $row['last_post_id'] : ', forum_last_post_id = 0';
				}
			}
		}
		else if ($post_data['first_post']) 
		{
			$sql = 'SELECT MIN(post_id) AS first_post_id
				FROM ' . POSTS_TABLE . ' 
				WHERE topic_id = ' . $topic_id;
			if (!($result = $db->sql_query($sql)))
			{
				message_die(GENERAL_ERROR, 'Error in deleting post', '', __LINE__, __FILE__, $sql);
			}

			if ($row = $db->sql_fetchrow($result))
			{
				$topic_update_sql .= 'topic_replies = topic_replies - 1, topic_first_post_id = ' . $row['first_post_id'];
			}
		}
		else
		{
			$topic_update_sql .= 'topic_replies = topic_replies - 1';
		}
	}
	else if ($mode != 'poll_delete')
	{
		$forum_update_sql .= ", forum_last_post_id = $post_id" . (($mode == 'newtopic') ? ", forum_topics = forum_topics $sign" : ""); 
//-- mod : lock during posting -------------------------------------------------
// here we added
//	topic_status = $lock_status, 
//-- modify
		$topic_update_sql = "topic_status = $lock_status, topic_last_post_id = $post_id" . (($mode == 'reply') ? ", topic_replies = topic_replies $sign" : ", topic_first_post_id = $post_id");
//-- fin mod : lock during posting ---------------------------------------------
	}
	else 
	{
		$topic_update_sql .= 'topic_vote = 0';
	}

	if ($mode != 'poll_delete')
	{
		$sql = 'UPDATE ' . FORUMS_TABLE . ' SET 
			' . $forum_update_sql . '
			WHERE forum_id = ' . $forum_id;
		if (!$db->sql_query($sql))
		{
			message_die(GENERAL_ERROR, 'Error in posting', '', __LINE__, __FILE__, $sql);
		}
	}

	if ($topic_update_sql != '')
	{
		$sql = 'UPDATE ' . TOPICS_TABLE . ' SET 
			' . $topic_update_sql . '
			WHERE topic_id = ' . $topic_id;
		if (!$db->sql_query($sql))
		{
			message_die(GENERAL_ERROR, 'Error in posting', '', __LINE__, __FILE__, $sql);
		}
	}

	if ($mode != 'poll_delete')
	{
		$sql = 'UPDATE ' . USERS_TABLE . '
			SET user_posts = user_posts ' . $sign . '
			WHERE user_id = ' . $user_id;
		if (!$db->sql_query($sql, END_TRANSACTION))
		{
			message_die(GENERAL_ERROR, 'Error in posting', '', __LINE__, __FILE__, $sql);
		}
	}

	return;
}

//
// Delete a post/poll
//
function delete_post($mode, &$post_data, &$message, &$meta, &$forum_id, &$topic_id, &$post_id, &$poll_id)
{
	global $board_config, $lang, $db, $phpbb_root_path, $phpEx;
	global $userdata, $user_ip;

	if ($mode != 'poll_delete')
	{
		include($phpbb_root_path . 'includes/functions_search.'.$phpEx);

		$sql = 'DELETE FROM ' . POSTS_TABLE . ' 
			WHERE post_id = ' . $post_id;
		if (!$db->sql_query($sql))
		{
			message_die(GENERAL_ERROR, 'Error in deleting post', '', __LINE__, __FILE__, $sql);
		}

		$sql = 'DELETE FROM ' . POSTS_TEXT_TABLE . ' 
			WHERE post_id = ' . $post_id;
		if (!$db->sql_query($sql))
		{
			message_die(GENERAL_ERROR, 'Error in deleting post', '', __LINE__, __FILE__, $sql);
		}

		if ($post_data['last_post'])
		{
			if ($post_data['first_post'])
			{
				$forum_update_sql .= ', forum_topics = forum_topics - 1';
				$sql = 'DELETE FROM ' . TOPICS_TABLE . ' 
					WHERE topic_id = ' . $topic_id . '
						OR topic_moved_id = ' . $topic_id;
				if (!$db->sql_query($sql))
				{
					message_die(GENERAL_ERROR, 'Error in deleting post', '', __LINE__, __FILE__, $sql);
				}

				$sql = 'DELETE FROM ' . TOPICS_WATCH_TABLE . '
					WHERE topic_id = ' . $topic_id;
				if (!$db->sql_query($sql))
				{
					message_die(GENERAL_ERROR, 'Error in deleting post', '', __LINE__, __FILE__, $sql);
				}
			}
		}

		remove_search_post($post_id);
	}

	if ($mode == 'poll_delete' || ($mode == 'delete' && $post_data['first_post'] && $post_data['last_post']) && $post_data['has_poll'] && $post_data['edit_poll'])
	{
		$sql = 'DELETE FROM ' . VOTE_DESC_TABLE . ' 
			WHERE topic_id = ' . $topic_id;
		if (!$db->sql_query($sql))
		{
			message_die(GENERAL_ERROR, 'Error in deleting poll', '', __LINE__, __FILE__, $sql);
		}

		$sql = 'DELETE FROM ' . VOTE_RESULTS_TABLE . ' 
			WHERE vote_id = ' . $poll_id;
		if (!$db->sql_query($sql))
		{
			message_die(GENERAL_ERROR, 'Error in deleting poll', '', __LINE__, __FILE__, $sql);
		}

		$sql = 'DELETE FROM ' . VOTE_USERS_TABLE . ' 
			WHERE vote_id = ' . $poll_id;
		if (!$db->sql_query($sql))
		{
			message_die(GENERAL_ERROR, 'Error in deleting poll', '', __LINE__, __FILE__, $sql);
		}
	}

	if ($mode == 'delete' && $post_data['first_post'] && $post_data['last_post'])
	{
		$meta = '<meta http-equiv="refresh" content="3;url=' . append_sid("viewforum.$phpEx?" . POST_FORUM_URL . '=' . $forum_id) . '">';
		$message = $lang['Deleted'];
	}
	else
	{
		$meta = '<meta http-equiv="refresh" content="3;url=' . append_sid("viewtopic.$phpEx?" . POST_TOPIC_URL . '=' . $topic_id) . '">';
		$message = (($mode == 'poll_delete') ? $lang['Poll_delete'] : $lang['Deleted']) . '<br /><br />' . sprintf($lang['Click_return_topic'], '<a href="' . append_sid("viewtopic.$phpEx?" . POST_TOPIC_URL . "=$topic_id") . '">', '</a>');
	}

//-- mod : points system -------------------------------------------------------
//-- add
	if ($board_config['points_post'] && !$post_info['points_disabled'] && ($mode == 'delete' || $mode == 'poll_delete') )
	{
		if (($userdata['user_id'] == $post_data['first_post']) && (($userdata['user_id'] != ANONYMOUS) && ($userdata['admin_allow_points'])))
		{
			subtract_points($userdata['user_id'], $board_config['points_topic']);
		}
		else if (($userdata['user_id'] != ANONYMOUS) && ($userdata['admin_allow_points']))
		{
			subtract_points($userdata['user_id'], $board_config['points_reply']);
		}
	}
//-- fin mod : points system ---------------------------------------------------

	$message .=  '<br /><br />' . sprintf($lang['Click_return_forum'], '<a href="' . append_sid("viewforum.$phpEx?" . POST_FORUM_URL . "=$forum_id") . '">', '</a>');

	return;
}

//
// Handle user notification on new post
//
function user_notification($mode, &$post_data, &$topic_title, &$forum_id, &$topic_id, &$post_id, &$notify_user)
{
	global $board_config, $lang, $db, $phpbb_root_path, $phpEx;
	global $userdata, $user_ip;

	$current_time = time();

	if ($mode != 'delete')
	{
		if ($mode == 'reply')
		{
			$sql = 'SELECT ban_userid 
				FROM ' . BANLIST_TABLE;
			if (!($result = $db->sql_query($sql)))
			{
				message_die(GENERAL_ERROR, 'Could not obtain banlist', '', __LINE__, __FILE__, $sql);
			}

			$user_id_sql = '';
			while ($row = $db->sql_fetchrow($result))
			{
				if (isset($row['ban_userid']) && !empty($row['ban_userid']))
				{
					$user_id_sql .= ', ' . $row['ban_userid'];
				}
			}

			$sql = 'SELECT u.user_id, u.user_email, u.user_lang 
				FROM ' . TOPICS_WATCH_TABLE . ' tw, ' . USERS_TABLE . ' u 
				WHERE tw.topic_id = ' . $topic_id . '
					AND tw.user_id NOT IN (' . $userdata['user_id'] . ', ' . ANONYMOUS . $user_id_sql . ') 
					AND tw.notify_status = ' . TOPIC_WATCH_UN_NOTIFIED . ' 
					AND u.user_id = tw.user_id';
			if (!($result = $db->sql_query($sql)))
			{
				message_die(GENERAL_ERROR, 'Could not obtain list of topic watchers', '', __LINE__, __FILE__, $sql);
			}

			$update_watched_sql = '';
			$bcc_list_ary = array();
			
			if ($row = $db->sql_fetchrow($result))
			{
				// Sixty second limit
				@set_time_limit(60);

				do
				{
					if ($row['user_email'] != '')
					{
						$bcc_list_ary[$row['user_lang']][] = $row['user_email'];
					}
					$update_watched_sql .= ($update_watched_sql != '') ? ', ' . $row['user_id'] : $row['user_id'];
				}
				while ($row = $db->sql_fetchrow($result));

				//
				// Let's do some checking to make sure that mass mail functions
				// are working in win32 versions of php.
				//
				if (preg_match('/[c-z]:\\\.*/i', getenv('PATH')) && !$board_config['smtp_delivery'])
				{
					$ini_val = (@phpversion() >= '4.0.0') ? 'ini_get' : 'get_cfg_var';

					// We are running on windows, force delivery to use our smtp functions
					// since php's are broken by default
					$board_config['smtp_delivery'] = 1;
					$board_config['smtp_host'] = @$ini_val('SMTP');
				}

				if (sizeof($bcc_list_ary))
				{
					include($phpbb_root_path . 'includes/emailer.'.$phpEx);
					$emailer = new emailer($board_config['smtp_delivery']);

					$script_name = preg_replace('/^\/?(.*?)\/?$/', '\1', trim($board_config['script_path']));
					$script_name = ($script_name != '') ? $script_name . '/viewtopic.'.$phpEx : 'viewtopic.'.$phpEx;
					$server_name = trim($board_config['server_name']);
					$server_protocol = ($board_config['cookie_secure']) ? 'https://' : 'http://';
					$server_port = ($board_config['server_port'] <> 80) ? ':' . trim($board_config['server_port']) . '/' : '/';

					$orig_word = array();
					$replacement_word = array();
					obtain_word_list($orig_word, $replacement_word);

					$emailer->from($board_config['board_email']);
					$emailer->replyto($board_config['board_email']);

					$topic_title = (count($orig_word)) ? preg_replace($orig_word, $replacement_word, unprepare_message($topic_title)) : unprepare_message($topic_title);

					@reset($bcc_list_ary);
					while (list($user_lang, $bcc_list) = each($bcc_list_ary))
					{
						$emailer->use_template('topic_notify', $user_lang);
		
						for ($i = 0; $i < count($bcc_list); $i++)
						{
							$emailer->bcc($bcc_list[$i]);
						}

						// The Topic_reply_notification lang string below will be used
						// if for some reason the mail template subject cannot be read 
						// ... note it will not necessarily be in the posters own language!
						$emailer->set_subject($lang['Topic_reply_notification']); 
						
						// This is a nasty kludge to remove the username var ... till (if?)
						// translators update their templates
						$emailer->msg = preg_replace('#[ ]?{USERNAME}#', '', $emailer->msg);

						$emailer->assign_vars(array(
							'EMAIL_SIG' => (!empty($board_config['board_email_sig'])) ? str_replace('<br />', "\n", "-- \n" . $board_config['board_email_sig']) : '',
							'SITENAME' => $board_config['sitename'],
							'TOPIC_TITLE' => $topic_title, 

							'U_TOPIC' => $server_protocol . $server_name . $server_port . $script_name . '?' . POST_POST_URL . "=$post_id#$post_id",
							'U_STOP_WATCHING_TOPIC' => $server_protocol . $server_name . $server_port . $script_name . '?' . POST_TOPIC_URL . "=$topic_id&unwatch=topic")
						);

						$emailer->send();
						$emailer->reset();
					}
				}
			}
			$db->sql_freeresult($result);

			if ($update_watched_sql != '')
			{
				$sql = 'UPDATE ' . TOPICS_WATCH_TABLE . '
					SET notify_status = ' . TOPIC_WATCH_NOTIFIED . '
					WHERE topic_id = ' . $topic_id . '
						AND user_id IN (' . $update_watched_sql . ')';
				$db->sql_query($sql);
			}
		}

		$sql = 'SELECT topic_id 
			FROM ' . TOPICS_WATCH_TABLE . '
			WHERE topic_id = ' . $topic_id . '
				AND user_id = ' . $userdata['user_id'];
		if (!($result = $db->sql_query($sql)))
		{
			message_die(GENERAL_ERROR, 'Could not obtain topic watch information', '', __LINE__, __FILE__, $sql);
		}

		$row = $db->sql_fetchrow($result);

		if (!$notify_user && !empty($row['topic_id']))
		{
			$sql = 'DELETE FROM ' . TOPICS_WATCH_TABLE . '
				WHERE topic_id = ' . $topic_id . '
					AND user_id = ' . $userdata['user_id'];
			if (!$db->sql_query($sql))
			{
				message_die(GENERAL_ERROR, 'Could not delete topic watch information', '', __LINE__, __FILE__, $sql);
			}
		}
		else if ($notify_user && empty($row['topic_id']))
		{
			$sql = 'INSERT INTO ' . TOPICS_WATCH_TABLE . ' (user_id, topic_id, notify_status)
				VALUES (' . $userdata['user_id'] . ', ' . $topic_id . ', 0)';
			if (!$db->sql_query($sql))
			{
				message_die(GENERAL_ERROR, 'Could not insert topic watch information', '', __LINE__, __FILE__, $sql);
			}
		}
	}
}

//
// Fill smiley templates (or just the variables) with smileys
// Either in a window or inline
//
//-- mod : smiley categories ---------------------------------------------------
//-- delete
/*-MOD
function generate_smilies($mode, $page_id)
MOD-*/
//-- add
function generate_smilies_old($mode, $page_id)
//-- fin mod : smiley categories -----------------------------------------------
{
	global $db, $board_config, $template, $lang, $images, $theme, $phpEx, $phpbb_root_path;
	global $user_ip, $session_length, $starttime;
	global $userdata;

//-- mod : rank color system ---------------------------------------------------
//-- add
	global $get;
//-- fin mod : rank color system -----------------------------------------------

	$inline_columns = 4;
	$inline_rows = 5;
	$window_columns = 8;

	if ($mode == 'window')
	{
		$userdata = session_pagestart($user_ip, $page_id);
		init_userprefs($userdata);

		$gen_simple_header = TRUE;

		$page_title = $lang['Emoticons'];
		include($phpbb_root_path . 'includes/page_header.'.$phpEx);

		$template->set_filenames(array(
			'smiliesbody' => 'posting_smilies.tpl')
		);
	}

	$sql = 'SELECT emoticon, code, smile_url   
		FROM ' . SMILIES_TABLE . ' 
		ORDER BY smilies_id';
	if ($result = $db->sql_query($sql))
	{
		$num_smilies = 0;
		$rowset = array();
		while ($row = $db->sql_fetchrow($result))
		{
			if (empty($rowset[$row['smile_url']]))
			{
				$rowset[$row['smile_url']]['code'] = str_replace("'", "\\'", str_replace('\\', '\\\\', $row['code']));
				$rowset[$row['smile_url']]['emoticon'] = $row['emoticon'];
				$num_smilies++;
			}
		}

		if ($num_smilies)
		{
			$smilies_count = ($mode == 'inline') ? min(19, $num_smilies) : $num_smilies;
			$smilies_split_row = ($mode == 'inline') ? $inline_columns - 1 : $window_columns - 1;

			$s_colspan = 0;
			$row = 0;
			$col = 0;

			while (list($smile_url, $data) = @each($rowset))
			{
				if (!$col)
				{
					$template->assign_block_vars('smilies_row', array());
				}

				$template->assign_block_vars('smilies_row.smilies_col', array(
					'SMILEY_CODE' => $data['code'],
					'SMILEY_IMG' => $board_config['smilies_path'] . '/' . $smile_url,
					'SMILEY_DESC' => $data['emoticon'])
				);

				$s_colspan = max($s_colspan, $col + 1);

				if ($col == $smilies_split_row)
				{
					if ($mode == 'inline' && $row == $inline_rows - 1)
					{
						break;
					}
					$col = 0;
					$row++;
				}
				else
				{
					$col++;
				}
			}

			if ($mode == 'inline' && $num_smilies > $inline_rows * $inline_columns)
			{
				$template->assign_block_vars('switch_smilies_extra', array());

				$template->assign_vars(array(
					'L_MORE_SMILIES' => $lang['More_emoticons'], 
					'U_MORE_SMILIES' => append_sid("posting.$phpEx?mode=smilies"))
				);
			}

			$template->assign_vars(array(
				'L_EMOTICONS' => $lang['Emoticons'], 
				'L_CLOSE_WINDOW' => $lang['Close_window'], 
				'S_SMILIES_COLSPAN' => $s_colspan)
			);
		}
	}

	if ($mode == 'window')
	{
		$template->pparse('smiliesbody');

		include($phpbb_root_path . 'includes/page_tail.'.$phpEx);
	}
}

/**
* Called from within prepare_message to clean included HTML tags if HTML is
* turned on for that post
* @param array $tag Matching text from the message to parse
*/
function clean_html($tag)
{
	global $board_config;

	if (empty($tag[0]))
	{
		return '';
	}

	$allowed_html_tags = preg_split('/, */', strtolower($board_config['allow_html_tags']));
	$disallowed_attributes = '/^(?:style|on)/i';

	// Check if this is an end tag
	preg_match('/<[^\w\/]*\/[\W]*(\w+)/', $tag[0], $matches);
	if (sizeof($matches))
	{
		if (in_array(strtolower($matches[1]), $allowed_html_tags))
		{
			return  '</' . $matches[1] . '>';
		}
		else
		{
			return  htmlspecialchars('</' . $matches[1] . '>');
		}
	}

	// Check if this is an allowed tag
	if (in_array(strtolower($tag[1]), $allowed_html_tags))
	{
		$attributes = '';
		if (!empty($tag[2]))
		{
			preg_match_all('/[\W]*?(\w+)[\W]*?=[\W]*?(["\'])((?:(?!\2).)*)\2/', $tag[2], $test);
			for ($i = 0; $i < sizeof($test[0]); $i++)
			{
				if (preg_match($disallowed_attributes, $test[1][$i]))
				{
					continue;
				}
				$attributes .= ' ' . $test[1][$i] . '=' . $test[2][$i] . str_replace(array('[', ']'), array('&#91;', '&#93;'), htmlspecialchars($test[3][$i])) . $test[2][$i];
			}
		}
		if (in_array(strtolower($tag[1]), $allowed_html_tags))
		{
			return '<' . $tag[1] . $attributes . '>';
		}
		else
		{
			return htmlspecialchars('<' . $tag[1] . $attributes . '>');
		}
	}
	// Finally, this is not an allowed tag so strip all the attibutes and escape it
	else
	{
		return htmlspecialchars('<' .   $tag[1] . '>');
	}
}

//-- mod : smiley categories ---------------------------------------------------
//-- add
function generate_smilies($mode, $page_id, $forum_id = FALSE, $forum_cat_id = FALSE)
{
	global $db, $board_config, $template, $lang, $images, $theme, $phpEx, $phpbb_root_path;
	global $user_ip, $session_length, $starttime;
	global $userdata;
	global $HTTP_GET_VARS;

	$inline_columns = $board_config['smilie_columns'];
	$inline_rows = $board_config['smilie_rows'];
	$cat_posting = $board_config['smilie_posting'];
	$cat_popup = $board_config['smilie_popup'];
	$cat_buttons = $board_config['smilie_buttons'];
	$cat_id = ( isset($HTTP_GET_VARS['scid']) ) ? intval($HTTP_GET_VARS['scid']) : FALSE;
	$start = ( isset($HTTP_GET_VARS['start']) ) ? intval($HTTP_GET_VARS['start']) : 0;

	if( !$forum_id )
	{
		$fid = ( isset($HTTP_GET_VARS['fid']) ) ? $HTTP_GET_VARS['fid'] : $HTTP_POST_VARS['fid'];
		if( $fid )
		{
			list($forum_id, $forum_cat_id) = explode("|", $fid);
		}
	}

	if( $mode == 'window' )
	{
		$userdata = session_pagestart($user_ip, $page_id);
		init_userprefs($userdata);
		$gen_simple_header = TRUE;
		$page_title = $lang['Emoticons'] . " - $topic_title";
		include($phpbb_root_path . 'includes/page_header.'.$phpEx);
		$template->set_filenames(array(
			'smiliesbody' => 'posting_smilies.tpl')
		);
		$sql_select = ', smilies_per_page, smilies_popup';
	}

	$perms = ( $userdata['session_logged_in'] ) ? (( $userdata['user_level'] == ADMIN ) ? '<= 4' : (( $userdata['user_level'] == MOD ) ? '<= 3' : (( $userdata['user_level'] == USER ) ? '<= 2' : '= 1'))) : '= 1';
	$which_forum = ( $forum_id ) ? '((cat_forum = -2 OR cat_forum = ' . $forum_id . ')' : '((cat_forum = -2)';
	$which_forum .= ( $forum_cat_id ) ? ' OR (cat_category = -2 OR cat_category = ' . $forum_cat_id . '))' : ' OR (cat_category = -2))';

	$sql = "SELECT cat_name, description, cat_order, cat_icon_url $sql_select
		FROM " . SMILIES_CAT_TABLE . "
		WHERE cat_perms $perms
			AND $which_forum
		ORDER BY cat_order ASC";
	if( $result = $db->sql_query($sql) )
	{
		if( $total_cats = $db->sql_numrows($result) )
		{
			$cat_count = 0;
			$rowset = array();
			$array_order = array();
			while( $row1 = $db->sql_fetchrow($result) )
			{
				$array_order[$row1['cat_order']] = $cat_count;
				$rowset[$cat_count]['cat_name'] = htmlspecialchars(str_replace("'", "\\'", str_replace('\\', '\\\\', $row1['cat_name'])));
				$rowset[$cat_count]['cat_order'] = $row1['cat_order'];
				$rowset[$cat_count]['smilies_per_page'] = $row1['smilies_per_page'];
				$rowset[$cat_count]['smilies_popup'] = $row1['smilies_popup'];

				if( $cat_buttons == 2 )
				{
					$rowset[$cat_count]['cat_icon_url'] = $row1['cat_icon_url'];
				}

				if( $mode == 'inline' && $cat_posting )
				{
					$rowset[$cat_count]['description'] = htmlspecialchars(str_replace("'", "\\'", str_replace('\\', '\\\\', $row1['description'])));
				}

				$cat_count++;
			}

			$cat = ( $cat_id ) ? $cat_id : $rowset[0]['cat_order'];

			if( ($cat_posting && $mode == 'inline') || ($cat_popup && $mode == 'window') )
			{
				$template->assign_block_vars('smiley_category', array());

				$template->assign_vars(array(
					'L_SMILEY_CATEGORIES' => $lang['smiley_categories'])
				);

				if( (($cat_posting == 1) && ($mode == 'inline')) || (($cat_popup == 1) && ($mode == 'window')) )
				{
					for( $i=0; $i<$cat_count; $i++ )
					{
						$j = $i+1;

						if( $mode == 'inline' )
						{
							$template->assign_block_vars('category_help', array(
								'NAME' => 'cat' . $j,
								'HELP' => $rowset[$i]['description'])
							);
						}

						if( $cat_buttons == 0 )
						{
							$value = 'value=" ' . $j . ' "';
							$type = 'type="button" class="button" title="' . $rowset[$i]['description'] . '"';
						}
						else if( $cat_buttons == 1 )
						{
							$value = 'value="' . $rowset[$i]['cat_name'] . '"';
							$type = 'type="button" class="button" title="' . $rowset[$i]['description'] . '"';
						}
						else if( $cat_buttons == 2 )
						{
							if( $rowset[$i]['cat_icon_url'] )
							{
								$value = 'src="' . $phpbb_root_path . $board_config['smilie_icon_path'] . '/' . $rowset[$i]['cat_icon_url'] . '"';
								$type = 'type="image" title="' . $rowset[$i]['description'] . '"';
							}
							else
							{
								$value = 'value="' . $rowset[$i]['cat_name'] . '"';
								$type = 'type="button" class="button" title="' . $rowset[$i]['description'] . '"';
							}
						}

						$template->assign_block_vars('smiley_category.buttons', array(
							'VALUE' => $value,
							'TYPE' => $type,
							'NAME' => 'cat' . $j,
							'CAT_MORE_SMILIES' => append_sid("posting.$phpEx?mode=smilies&amp;scid=" . $rowset[$i]['cat_order'] . "&amp;fid=" . $forum_id . "|" . $forum_cat_id))
						);
					}
				}
				else if( (($cat_posting == 2) && ($mode == 'inline')) || (($cat_popup == 2) && ($mode == 'window')) )
				{
					if( $mode == 'inline' )
					{
						$template->assign_block_vars('category_help', array(
							'NAME' => 'smile_cats',
							'HELP' => $lang['smiley_help'])
						);
					}

					$select_menu = ( $mode == 'inline' ) ? '<select name="cat" onChange="window.open(this.options[this.selectedIndex].value, \'_phpbbsmilies\', \'HEIGHT=300,resizable=yes,scrollbars=yes,WIDTH=410\'); return false;" onMouseOver="helpline(\'smile_cats\')">' : '<select name="cat" onChange="location.href=this.options[this.selectedIndex].value;">';
					$select_menu .= '<option value="' . append_sid("posting.$phpEx?mode=smilies&amp;scid=" . $cat . "&amp;fid=" . $forum_id . "|" . $forum_cat_id) . '">' . $lang['Select'] . '</option>';

					for( $i=0; $i<$cat_count; $i++ )
					{
						$selected = ( $rowset[$i]['cat_order'] == $cat_id ) ? ' selected="selected"' : '';
						$select_menu .= '<option value="' . append_sid("posting.$phpEx?mode=smilies&amp;scid=" . $rowset[$i]['cat_order'] . "&amp;fid=" . $forum_id . "|" . $forum_cat_id) . '"' . $selected . '>' . $rowset[$i]['cat_name'] . '</option>';
					}

					$select_menu .= '</select>';

					$template->assign_block_vars('smiley_category.dropdown', array(
						'OPTIONS' => $select_menu)
					);
				}
			}
			else
			{
				if( $mode == 'inline' )
				{
					$template->assign_block_vars('switch_smilies_extra', array());
					$template->assign_vars(array(
						'L_MORE_SMILIES' => $lang['More_emoticons'], 
						'U_MORE_SMILIES' => append_sid("posting.$phpEx?mode=smilies&amp;scid=" . $cat . "&amp;fid=" . $forum_id . "|" . $forum_cat_id))
					);
				}
			}

			$sql2 = "SELECT code, smile_url, emoticon
				FROM " . SMILIES_TABLE . "
				WHERE cat_id = $cat
				ORDER BY smilies_order
				ASC";
			if( $result2 = $db->sql_query($sql2) )
			{
				$num_smilies = 0;
				$rowset2 = array();
				$rowset3 = array();
				while( $row2 = $db->sql_fetchrow($result2) )
				{
					if( ($key = array_search($row2['smile_url'], $rowset3)) === FALSE )
					{
						$rowset3[$num_smilies] = $row2['smile_url'];
						$rowset2[$num_smilies]['code'] = str_replace("'", "\\'", str_replace('\\', '\\\\', $row2['code']));
						$rowset2[$num_smilies]['emoticon'] = $row2['emoticon'];

						$num_smilies++;
					}
				}
				if( $num_smilies )
				{
					list($width, $height, $window_columns) = explode("|", $rowset[$array_order[$cat]]['smilies_popup']);
					$smilies_split_row = ( $mode == 'inline' ) ? $inline_columns - 1 : $window_columns - 1;
					$s_colspan = 0;
					$row = 0;
					$col = 0;

					if ( ($mode == 'inline') || ($rowset[$array_order[$cat]]['smilies_per_page'] == 0) )
					{
						$per_page = $num_smilies;
						$smiley_start = 0;
						$smiley_stop = $num_smilies;
					}
					else
					{
						$per_page = ( $rowset[$array_order[$cat]]['smilies_per_page'] > $num_smilies ) ? $num_smilies : $rowset[$array_order[$cat]]['smilies_per_page'];
						$page_num = ( $start <= 0 ) ? 1 : ($start / $per_page) + 1;
						$smiley_start = ($per_page * $page_num) - $per_page;
						$smiley_stop = ( ($per_page * $page_num) > $num_smilies ) ? $num_smilies : $smiley_start + $per_page;
					}

					for( $i=$smiley_start; $i<$smiley_stop; $i++ )
					{

						if( !$col )
						{
							$template->assign_block_vars('smilies_row', array());
						}

						$template->assign_block_vars('smilies_row.smilies_col', array(
							'SMILEY_CODE' => $rowset2[$i]['code'],
							'SMILEY_IMG' => $board_config['smilies_path'] . '/' . $rowset3[$i],
							'SMILEY_DESC' => $rowset2[$i]['emoticon'])
						);

						$s_colspan = max($s_colspan, $col + 1);

						if( $col == $smilies_split_row )
						{
							if( $mode == 'inline' && $row == $inline_rows - 1 )
							{
								break;
							}
							$col = 0;
							$row++;
						}
						else
						{
							$col++;
						}
					}
				}

				$template->assign_vars(array(
					'L_EMOTICONS' => ( $num_smilies ) ? $lang['Emoticons'] : $lang['no_smilies'], 
					'S_SMILIES_COLSPAN' =>  ( $num_smilies ) ? $s_colspan : 1)
				);
			}

			if( $mode == 'window' )
			{
				if( $num_smilies )
				{
					$pagination = generate_pagination("posting.$phpEx?mode=smilies&amp;scid=$cat&amp;fid=$forum_id|$forum_cat_id", $num_smilies, $per_page, $start, FALSE);
				}

				$template->assign_vars(array(
					'L_CLOSE_WINDOW' => $lang['Close_window'], 
					'S_WIDTH' =>  $width,
					'S_HEIGHT' =>  $height,
					'PAGINATION' => $pagination)
				);

				$template->pparse('smiliesbody');
				include($phpbb_root_path . 'includes/page_tail.'.$phpEx);
			}
		}
		else
		{
			$template->assign_vars(array(
				'L_EMOTICONS' => $lang['no_smilies'], 
				'S_SMILIES_COLSPAN' => 1)
			);
		}
	}
}
//-- fin mod : smiley categories -----------------------------------------------

//-- mod : bump topic ----------------------------------------------------------
//-- add
function reset_topic_bumped($mode, $topic_id = false, $post_time = 0)
{
	global $db;

	if ( $topic_id === false )
	{
		return;
	}

	$post_time = !empty($post_time) ? $post_time : time();
	$update_last_post_time = ($mode == 'newtopic' || $mode == 'reply') ? 'topic_last_post_time = ' . $post_time . ', ' : '';

	$sql = 'UPDATE ' . TOPICS_TABLE . '
		SET ' . $update_last_post_time . 'topic_bumped = 0,
		topic_bumper = 0
		WHERE topic_id = ' . $topic_id;
	if (!$db->sql_query($sql))
	{
		message_die(GENERAL_ERROR, 'Error to reset bumped topic', '', __LINE__, __FILE__, $sql);
	}

	return;
}

function markread($topic_id, $post_time = 0)
{
	global $board_config;
	global $HTTP_COOKIE_VARS;

	$topic_id = !empty($topic_id) ? $topic_id : false;

	if ( $topic_id === false )
	{
		return;
	}

	$post_time = !empty($post_time) ? $post_time : time();

	$tracking_topics = !empty($HTTP_COOKIE_VARS[$board_config['cookie_name'] . '_t']) ? unserialize($HTTP_COOKIE_VARS[$board_config['cookie_name'] . '_t']) : array();
	$tracking_forums = !empty($HTTP_COOKIE_VARS[$board_config['cookie_name'] . '_f']) ? unserialize($HTTP_COOKIE_VARS[$board_config['cookie_name'] . '_f']) : array();

	if ( count($tracking_topics) + count($tracking_forums) == 100 && empty($tracking_topics[$topic_id]) )
	{
		asort($tracking_topics);
		unset($tracking_topics[key($tracking_topics)]);
	}

	$tracking_topics[$topic_id] = time();

	setcookie($board_config['cookie_name'] . '_t', serialize($tracking_topics), 0, $board_config['cookie_path'], $board_config['cookie_domain'], $board_config['cookie_secure']);

	return;
}
//-- fin mod : bump topic ------------------------------------------------------

?>
