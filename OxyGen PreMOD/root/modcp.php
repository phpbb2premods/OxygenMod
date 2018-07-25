<?php
/***************************************************************************
 *                                 modcp.php
 *                            -------------------
 *   begin                : July 4, 2001
 *   copyright            : (C) 2001 The phpBB Group
 *   email                : support@phpbb.com
 *
 *   $Id: modcp.php,v 1.71.2.28 2006/01/20 19:50:27 grahamje Exp $
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

/**
 * Moderator Control Panel
 *
 * From this 'Control Panel' the moderator of a forum will be able to do
 * mass topic operations (locking/unlocking/moving/deleteing), and it will
 * provide an interface to do quick locking/unlocking/moving/deleting of
 * topics via the moderator operations buttons on all of the viewtopic pages.
 */

define('IN_PHPBB', true);
$phpbb_root_path = './';
include($phpbb_root_path . 'extension.inc');
include($phpbb_root_path . 'common.'.$phpEx);

//-- mod : post icon -----------------------------------------------------------
//-- add
include($phpbb_root_path . 'includes/def_icons.'. $phpEx);
//-- fin mod : post icon -------------------------------------------------------

include($phpbb_root_path . 'includes/bbcode.'.$phpEx);
include($phpbb_root_path . 'includes/functions_admin.'.$phpEx);

//
// Obtain initial var settings
//
if ( isset($HTTP_GET_VARS[POST_FORUM_URL]) || isset($HTTP_POST_VARS[POST_FORUM_URL]) )
{
	$forum_id = (isset($HTTP_POST_VARS[POST_FORUM_URL])) ? intval($HTTP_POST_VARS[POST_FORUM_URL]) : intval($HTTP_GET_VARS[POST_FORUM_URL]);
}
else
{
	$forum_id = '';
}

if ( isset($HTTP_GET_VARS[POST_POST_URL]) || isset($HTTP_POST_VARS[POST_POST_URL]) )
{
	$post_id = (isset($HTTP_POST_VARS[POST_POST_URL])) ? intval($HTTP_POST_VARS[POST_POST_URL]) : intval($HTTP_GET_VARS[POST_POST_URL]);
}
else
{
	$post_id = '';
}

if ( isset($HTTP_GET_VARS[POST_TOPIC_URL]) || isset($HTTP_POST_VARS[POST_TOPIC_URL]) )
{
	$topic_id = (isset($HTTP_POST_VARS[POST_TOPIC_URL])) ? intval($HTTP_POST_VARS[POST_TOPIC_URL]) : intval($HTTP_GET_VARS[POST_TOPIC_URL]);
}
else
{
	$topic_id = '';
}

$confirm = ( $HTTP_POST_VARS['confirm'] ) ? TRUE : 0;

//-- mod : quick split ---------------------------------------------------------
//-- add
$quick_split = ( $HTTP_GET_VARS['quick_split'] ) ? TRUE : FALSE;
//-- fin mod : quick split -----------------------------------------------------

//-- mod : recycle bin hack ----------------------------------------------------
//-- add
$confirm_recycle = TRUE;
//-- fin mod : recycle bin hack ------------------------------------------------

//
// Continue var definitions
//
$start = ( isset($HTTP_GET_VARS['start']) ) ? intval($HTTP_GET_VARS['start']) : 0;
$start = ($start < 0) ? 0 : $start;

$delete = ( isset($HTTP_POST_VARS['delete']) ) ? TRUE : FALSE;
$move = ( isset($HTTP_POST_VARS['move']) ) ? TRUE : FALSE;
$lock = ( isset($HTTP_POST_VARS['lock']) ) ? TRUE : FALSE;
$unlock = ( isset($HTTP_POST_VARS['unlock']) ) ? TRUE : FALSE;

//-- mod : modcp merge hack ----------------------------------------------------
//-- add
$merge = ( isset($HTTP_POST_VARS['merge']) ) ? TRUE : FALSE;
//-- fin mod : modcp merge hack ------------------------------------------------

//-- mod : recycle bin hack ----------------------------------------------------
//-- add
$recycle = ( isset($HTTP_POST_VARS['recycle']) ) ? TRUE : FALSE;
//-- fin mod : recycle bin hack ------------------------------------------------

//-- mod : quick title edition -------------------------------------------------
//-- add
$quick_title_edit = isset($HTTP_POST_VARS['quick_title_edit']) ? TRUE : FALSE;
$qtnum = isset($HTTP_POST_VARS['qtnum']) ? intval($HTTP_POST_VARS['qtnum']) : 0;
//-- fin mod : quick title edition ---------------------------------------------

if ( isset($HTTP_POST_VARS['mode']) || isset($HTTP_GET_VARS['mode']) )
{
	$mode = ( isset($HTTP_POST_VARS['mode']) ) ? $HTTP_POST_VARS['mode'] : $HTTP_GET_VARS['mode'];
	$mode = htmlspecialchars($mode);
}
else
{
	if ( $delete )
	{
		$mode = 'delete';
	}
	else if ( $move )
	{
		$mode = 'move';
	}
	else if ( $lock )
	{
		$mode = 'lock';
	}
	else if ( $unlock )
	{
		$mode = 'unlock';
	}
//-- mod : modcp merge hack ----------------------------------------------------
//-- add
	else if ( $merge )
	{
		$mode = 'merge';
	}
//-- fin mod : modcp merge hack ------------------------------------------------
//-- mod : recycle bin hack ----------------------------------------------------
//-- add
	else if ( $recycle )
	{
		$mode = 'recycle';
	}
//-- fin mod : recycle bin hack ------------------------------------------------
//-- mod : quick title edition -------------------------------------------------
//-- add
	else if ( $quick_title_edit )
	{
		$mode = 'quick_title_edit';
	}
//-- fin mod : quick title edition ---------------------------------------------
	else
	{
		$mode = '';
	}
}

// session id check
if (!empty($HTTP_POST_VARS['sid']) || !empty($HTTP_GET_VARS['sid']))
{
	$sid = (!empty($HTTP_POST_VARS['sid'])) ? $HTTP_POST_VARS['sid'] : $HTTP_GET_VARS['sid'];
}
else
{
	$sid = '';
}

//
// Obtain relevant data
//
if ( !empty($topic_id) )
{
	$sql = 'SELECT f.forum_id, f.forum_name, f.forum_topics
		FROM ' . TOPICS_TABLE . ' t, ' . FORUMS_TABLE . ' f
		WHERE t.topic_id = ' . $topic_id . '
			AND f.forum_id = t.forum_id';
//-- mod : quick title edition -------------------------------------------------
//-- add
	$sql = str_replace('SELECT ', 'SELECT t.topic_poster, ', $sql);
//-- fin mod : quick title edition ---------------------------------------------
//-- mod : smiley categories ---------------------------------------------------
//-- add
	$sql = str_replace('SELECT ', 'SELECT f.cat_id, ', $sql);
//-- fin mod : smiley categories -----------------------------------------------
	if ( !($result = $db->sql_query($sql)) )
	{
		message_die(GENERAL_MESSAGE, 'Topic_post_not_exist');
	}
	$topic_row = $db->sql_fetchrow($result);
	$db->sql_freeresult($result);
	if (!$topic_row)
	{
		message_die(GENERAL_MESSAGE, 'Topic_post_not_exist');
	}

	$forum_topics = ( $topic_row['forum_topics'] == 0 ) ? 1 : $topic_row['forum_topics'];
	$forum_id = $topic_row['forum_id'];

//-- mod : smiley categories ---------------------------------------------------
//-- add
	$forum_cat_id = $topic_row['cat_id'];
//-- fin mod : smiley categories -----------------------------------------------

	$forum_name = $topic_row['forum_name'];
}
else if ( !empty($forum_id) )
{
	$sql = 'SELECT forum_name, forum_topics
		FROM ' . FORUMS_TABLE . '
		WHERE forum_id = ' . $forum_id;
//-- mod : smiley categories ---------------------------------------------------
//-- add
	$sql = str_replace('SELECT ', 'SELECT cat_id, ', $sql);
//-- fin mod : smiley categories -----------------------------------------------
	if ( !($result = $db->sql_query($sql)) )
	{
		message_die(GENERAL_MESSAGE, 'Forum_not_exist');
	}
	$topic_row = $db->sql_fetchrow($result);

	if (!$topic_row)
	{
		message_die(GENERAL_MESSAGE, 'Forum_not_exist');
	}

	$forum_topics = ( $topic_row['forum_topics'] == 0 ) ? 1 : $topic_row['forum_topics'];
	$forum_name = $topic_row['forum_name'];
}
else
{
	message_die(GENERAL_MESSAGE, 'Forum_not_exist');
}

//-- mod : view category name --------------------------------------------------
//-- add
$cat_info = get_category($forum_id);
//-- fin mod : view category name ----------------------------------------------

//
// Start session management
//
$userdata = session_pagestart($user_ip, $forum_id);
init_userprefs($userdata);
//
// End session management
//

// session id check
if ($sid == '' || $sid != $userdata['session_id'])
{
	message_die(GENERAL_ERROR, 'Invalid_session');
}

//
// Check if user did or did not confirm
// If they did not, forward them to the last page they were on
//
if ( isset($HTTP_POST_VARS['cancel']) )
{
	if ( $topic_id )
	{
		$redirect = 'viewtopic.'.$phpEx.'?' . POST_TOPIC_URL .'=' . $topic_id;
	}
	else if ( $forum_id )
	{
		$redirect = 'viewforum.'.$phpEx.'?' . POST_FORUM_URL . '=' . $forum_id;
	}
	else
	{
		$redirect = 'index.'.$phpEx;
	}

	redirect(append_sid($redirect, true));
}

//
// Start auth check
//
//-- mod : quick title edition -------------------------------------------------
//-- delete
/*-MOD
$is_auth = auth(AUTH_ALL, $forum_id, $userdata);

if ( !$is_auth['auth_mod'] )
{
	message_die(GENERAL_MESSAGE, $lang['Not_Moderator'], $lang['Not_Authorised']);
}
MOD-*/
//-- add
if ($mode != 'quick_title_edit')
{
	$is_auth = auth(AUTH_ALL, $forum_id, $userdata);
	if ( !$is_auth['auth_mod'] )
	{
		message_die(GENERAL_MESSAGE, $lang['Not_Moderator'], $lang['Not_Authorised']);
	}
}
else
{
	if ( $qtnum > -1 )
	{
		$sql_qt = 'SELECT * FROM ' . ATTRIBUTES_TABLE . ' WHERE attribute_id = ' . $qtnum;
		if (!$result_qt = $db->sql_query($sql_qt))
		{
			message_die(GENERAL_MESSAGE, 'This attribute does not exist');
		}

		$qt_row = $db->sql_fetchrow($result_qt);

		if (($userdata['user_level'] == ADMIN && !$qt_row['attribute_administrator']) || ($userdata['user_level'] == MOD && !$qt_row['attribute_moderator']) || ($userdata['user_level'] == USER && !$qt_row['attribute_author']) || ($userdata['user_level'] == USER && $qt_row['attribute_author'] && $userdata['user_id'] != $topic_row['topic_poster'] ))
		{
			message_die(GENERAL_MESSAGE, $lang['Not_Authorised']);
		}
	}
	else
	{
		if ($userdata['user_level'] == USER && $userdata['user_id'] != $topic_row['topic_poster'])
		{	
			message_die(GENERAL_MESSAGE, $lang['Not_Authorised']);
		}
		$qt_row = array('title_info' => '');
	}
}
//-- fin mod : quick title edition ---------------------------------------------
//
// End Auth Check
//

//
// Do major work ...
//
switch( $mode )
{
	case 'delete':
		if (!$is_auth['auth_delete'])
		{
			message_die(GENERAL_MESSAGE, sprintf($lang['Sorry_auth_delete'], $is_auth['auth_delete_type']));
		}

//-- mod : disallow editing/deleting administrator posts -----------------------
//-- add
		if( !$board_config['disallow_edition_deleting_admin_messages'] && $userdata['user_level'] != ADMIN )
		{
			$topics_sql = ( isset($HTTP_POST_VARS['topic_id_list']) ) ? implode(',', $HTTP_POST_VARS['topic_id_list']) : $topic_id;
			$sql = 'SELECT t.topic_id
				FROM ' . TOPICS_TABLE . ' t, ' . USERS_TABLE . ' u
				WHERE u.user_id = t.topic_poster
				AND u.user_level = ' . ADMIN . '
				AND t.topic_id IN (' . $topics_sql . ')';
			if( !$result = $db->sql_query($sql) )
			{
				  message_die(GENERAL_ERROR, 'Could not retrieve topics list', '', __LINE__, __FILE__, $sql);
			}

			if( $db->sql_numrows($result) > 0 )
			{
				  message_die(GENERAL_MESSAGE, $lang['Not_auth_edit_delete_admin']);
			}
		}
//-- fin mod : disallow editing/deleting administrator posts -------------------

		$page_title = $lang['Mod_CP'];
		include($phpbb_root_path . 'includes/page_header.'.$phpEx);

		if ( $confirm )
		{
  			if ( empty($HTTP_POST_VARS['topic_id_list']) && empty($topic_id) )
			{
				message_die(GENERAL_MESSAGE, $lang['None_selected']);
			}

			include($phpbb_root_path . 'includes/functions_search.'.$phpEx);

			$topics = ( isset($HTTP_POST_VARS['topic_id_list']) ) ? $HTTP_POST_VARS['topic_id_list'] : array($topic_id);

			$topic_id_sql = '';
			for($i = 0; $i < count($topics); $i++)
			{
				$topic_id_sql .= ( ( $topic_id_sql != '' ) ? ', ' : '' ) . intval($topics[$i]);

//-- mod : the logger ----------------------------------------------------------
//-- add
				if( defined( 'LOG_MOD_INSTALLED' ) )
				{
					if( $log->config['log_mod_delete'] )
					{
						$log->insert( LOG_TYPE_MOD, 'LOG_M_DELETE_TOPIC', array( $log->convert_topic_id( $topics[$i] ) ) );
					}
				}
//-- fin mod : the logger ------------------------------------------------------
			}

//-- mod : topics a user has started -------------------------------------------
//-- add
			$sql = 'SELECT COUNT(topic_poster) AS topics, topic_poster
				FROM ' . TOPICS_TABLE . '
				WHERE topic_id IN (' . $topic_id_sql . ')
					AND forum_id = ' . $forum_id . '
					AND topic_moved_id = 0
				GROUP BY topic_poster';
			if ( !($result = $db->sql_query($sql)) )
			{
				message_die(GENERAL_ERROR, 'Could not get topic poster information', '', __LINE__, __FILE__, $sql);
			}

			while ($row = $db->sql_fetchrow($result))
			{
				$sql1= 'UPDATE ' . USERS_TABLE . '
					SET user_topics = user_topics - ' . $row['topics'] . '
					WHERE user_id = ' . $row['topic_poster'];
				if ( !$db->sql_query($sql1) )
				{
					message_die(GENERAL_ERROR, 'Could not update user topic count information', '', __LINE__, __FILE__, $sql1);
				}
			}
//-- fin mod : topics a user has started ---------------------------------------

			$sql = 'SELECT topic_id 
				FROM ' . TOPICS_TABLE . '
				WHERE topic_id IN (' . $topic_id_sql . ')
					AND forum_id = ' . $forum_id;
			if ( !($result = $db->sql_query($sql)) )
			{
				message_die(GENERAL_ERROR, 'Could not get topic id information', '', __LINE__, __FILE__, $sql);
			}
			
			$topic_id_sql = '';
			while ($row = $db->sql_fetchrow($result))
			{
				$topic_id_sql .= (($topic_id_sql != '') ? ', ' : '') . intval($row['topic_id']);
			}
			$db->sql_freeresult($result);

			if ( $topic_id_sql == '')
			{
				message_die(GENERAL_MESSAGE, $lang['None_selected']);
			}

			$sql = 'SELECT poster_id, COUNT(post_id) AS posts 
				FROM ' . POSTS_TABLE . ' 
				WHERE topic_id IN (' . $topic_id_sql . ') 
				GROUP BY poster_id';
			if ( !($result = $db->sql_query($sql)) )
			{
				message_die(GENERAL_ERROR, 'Could not get poster id information', '', __LINE__, __FILE__, $sql);
			}

			$count_sql = array();
			while ( $row = $db->sql_fetchrow($result) )
			{
				$count_sql[] = 'UPDATE ' . USERS_TABLE . ' 
					SET user_posts = user_posts - ' . $row['posts'] . ' 
					WHERE user_id = ' . $row['poster_id'];
			}
			$db->sql_freeresult($result);

			if ( sizeof($count_sql) )
			{
				for($i = 0; $i < sizeof($count_sql); $i++)
				{
					if ( !$db->sql_query($count_sql[$i]) )
					{
						message_die(GENERAL_ERROR, 'Could not update user post count information', '', __LINE__, __FILE__, $sql);
					}
				}
			}
			
			$sql = 'SELECT post_id 
				FROM ' . POSTS_TABLE . ' 
				WHERE topic_id IN (' . $topic_id_sql . ')';
			if ( !($result = $db->sql_query($sql)) )
			{
				message_die(GENERAL_ERROR, 'Could not get post id information', '', __LINE__, __FILE__, $sql);
			}

			$post_id_sql = '';
			while ( $row = $db->sql_fetchrow($result) )
			{
				$post_id_sql .= ( ( $post_id_sql != '' ) ? ', ' : '' ) . intval($row['post_id']);
			}
			$db->sql_freeresult($result);

			$sql = 'SELECT vote_id 
				FROM ' . VOTE_DESC_TABLE . ' 
				WHERE topic_id IN (' . $topic_id_sql . ')';
			if ( !($result = $db->sql_query($sql)) )
			{
				message_die(GENERAL_ERROR, 'Could not get vote id information', '', __LINE__, __FILE__, $sql);
			}

			$vote_id_sql = '';
			while ( $row = $db->sql_fetchrow($result) )
			{
				$vote_id_sql .= ( ( $vote_id_sql != '' ) ? ', ' : '' ) . $row['vote_id'];
			}
			$db->sql_freeresult($result);

			//
			// Got all required info so go ahead and start deleting everything
			//
			$sql = 'DELETE 
				FROM ' . TOPICS_TABLE . ' 
				WHERE topic_id IN (' . $topic_id_sql . ') 
					OR topic_moved_id IN (' . $topic_id_sql . ')';
			if ( !$db->sql_query($sql, BEGIN_TRANSACTION) )
			{
				message_die(GENERAL_ERROR, 'Could not delete topics', '', __LINE__, __FILE__, $sql);
			}

			if ( $post_id_sql != '' )
			{
				$sql = 'DELETE 
					FROM ' . POSTS_TABLE . ' 
					WHERE post_id IN (' . $post_id_sql . ')';
				if ( !$db->sql_query($sql) )
				{
					message_die(GENERAL_ERROR, 'Could not delete posts', '', __LINE__, __FILE__, $sql);
				}

				$sql = 'DELETE 
					FROM ' . POSTS_TEXT_TABLE . ' 
					WHERE post_id IN (' . $post_id_sql . ')';
				if ( !$db->sql_query($sql) )
				{
					message_die(GENERAL_ERROR, 'Could not delete posts text', '', __LINE__, __FILE__, $sql);
				}

				remove_search_post($post_id_sql);

//-- mod : attachment mod ------------------------------------------------------
//-- add
				delete_attachment(explode(', ', $post_id_sql));
//-- fin mod : attachment mod --------------------------------------------------

			}

			if ( $vote_id_sql != '' )
			{
				$sql = 'DELETE 
					FROM ' . VOTE_DESC_TABLE . ' 
					WHERE vote_id IN (' . $vote_id_sql . ')';
				if ( !$db->sql_query($sql) )
				{
					message_die(GENERAL_ERROR, 'Could not delete vote descriptions', '', __LINE__, __FILE__, $sql);
				}

				$sql = 'DELETE 
					FROM ' . VOTE_RESULTS_TABLE . ' 
					WHERE vote_id IN (' . $vote_id_sql . ')';
				if ( !$db->sql_query($sql) )
				{
					message_die(GENERAL_ERROR, 'Could not delete vote results', '', __LINE__, __FILE__, $sql);
				}

				$sql = 'DELETE 
					FROM ' . VOTE_USERS_TABLE . ' 
					WHERE vote_id IN (' . $vote_id_sql . ')';
				if ( !$db->sql_query($sql) )
				{
					message_die(GENERAL_ERROR, 'Could not delete vote users', '', __LINE__, __FILE__, $sql);
				}
			}

			$sql = 'DELETE 
				FROM ' . TOPICS_WATCH_TABLE . ' 
				WHERE topic_id IN (' . $topic_id_sql . ')';
			if ( !$db->sql_query($sql, END_TRANSACTION) )
			{
				message_die(GENERAL_ERROR, 'Could not delete watched post list', '', __LINE__, __FILE__, $sql);
			}

			sync('forum', $forum_id);

			if ( !empty($topic_id) )
			{
				$redirect_page = 'viewforum.'.$phpEx.'?' . POST_FORUM_URL . '=' . $forum_id . '&amp;sid=' . $userdata['session_id'];
				$l_redirect = sprintf($lang['Click_return_forum'], '<a href="' . $redirect_page . '">', '</a>');
			}
			else
			{
				$redirect_page = 'modcp.'.$phpEx.'?' . POST_FORUM_URL . '=' . $forum_id . '&amp;sid=' . $userdata['session_id'];
				$l_redirect = sprintf($lang['Click_return_modcp'], '<a href="' . $redirect_page . '">', '</a>');
			}

			$template->assign_vars(array(
				'META' => '<meta http-equiv="refresh" content="3;url=' . $redirect_page . '">')
			);

			message_die(GENERAL_MESSAGE, $lang['Topics_Removed'] . '<br /><br />' . $l_redirect);
		}
		else
		{
			// Not confirmed, show confirmation message
			if ( empty($HTTP_POST_VARS['topic_id_list']) && empty($topic_id) )
			{
				message_die(GENERAL_MESSAGE, $lang['None_selected']);
			}

			$hidden_fields = '<input type="hidden" name="sid" value="' . $userdata['session_id'] . '" /><input type="hidden" name="mode" value="' . $mode . '" /><input type="hidden" name="' . POST_FORUM_URL . '" value="' . $forum_id . '" />';

			if ( isset($HTTP_POST_VARS['topic_id_list']) )
			{
				$topics = $HTTP_POST_VARS['topic_id_list'];
				for($i = 0; $i < count($topics); $i++)
				{
					$hidden_fields .= '<input type="hidden" name="topic_id_list[]" value="' . intval($topics[$i]) . '" />';
				}
			}
			else
			{
				$hidden_fields .= '<input type="hidden" name="' . POST_TOPIC_URL . '" value="' . $topic_id . '" />';
			}

			//
			// Set template files
			//
			$template->set_filenames(array(
				'confirm' => 'confirm_body.tpl')
			);

			$template->assign_vars(array(
				'MESSAGE_TITLE' => $lang['Confirm'],
				'MESSAGE_TEXT' => $lang['Confirm_delete_topic'],

				'L_YES' => $lang['Yes'],
				'L_NO' => $lang['No'],

				'S_CONFIRM_ACTION' => append_sid("modcp.$phpEx"),
				'S_HIDDEN_FIELDS' => $hidden_fields)
			);

			$template->pparse('confirm');

			include($phpbb_root_path . 'includes/page_tail.'.$phpEx);
		}
		break;

	case 'move':
		$page_title = $lang['Mod_CP'];
		include($phpbb_root_path . 'includes/page_header.'.$phpEx);

		if ( $confirm )
		{
			if ( empty($HTTP_POST_VARS['topic_id_list']) && empty($topic_id) )
			{
				message_die(GENERAL_MESSAGE, $lang['None_selected']);
			}

			$new_forum_id = intval($HTTP_POST_VARS['new_forum']);
			$old_forum_id = $forum_id;

			$sql = 'SELECT forum_id FROM ' . FORUMS_TABLE . '
				WHERE forum_id = ' . $new_forum_id;
			if ( !($result = $db->sql_query($sql)) )
			{
				message_die(GENERAL_ERROR, 'Could not select from forums table', '', __LINE__, __FILE__, $sql);
			}
			
			if (!$db->sql_fetchrow($result))
			{
				message_die(GENERAL_MESSAGE, 'New forum does not exist');
			}

			$db->sql_freeresult($result);

			if ( $new_forum_id != $old_forum_id )
			{
				$topics = ( isset($HTTP_POST_VARS['topic_id_list']) ) ?  $HTTP_POST_VARS['topic_id_list'] : array($topic_id);

				$topic_list = '';
				for($i = 0; $i < count($topics); $i++)
				{
					$topic_list .= ( ( $topic_list != '' ) ? ', ' : '' ) . intval($topics[$i]);

//-- mod : the logger ----------------------------------------------------------
//-- add
					if( defined( 'LOG_MOD_INSTALLED' ) )
					{
						if( $log->config['log_mod_move'] )
						{
							$log->insert( LOG_TYPE_MOD, 'LOG_M_MOVE', array(), $new_forum_id, $topics[$i] );
						}
					}
//-- fin mod : the logger ------------------------------------------------------
				}

				$sql = 'SELECT * 
					FROM ' . TOPICS_TABLE . ' 
					WHERE topic_id IN (' . $topic_list . ')
						AND forum_id = ' . $old_forum_id . '
						AND topic_status <> ' . TOPIC_MOVED;
				if ( !($result = $db->sql_query($sql, BEGIN_TRANSACTION)) )
				{
					message_die(GENERAL_ERROR, 'Could not select from topic table', '', __LINE__, __FILE__, $sql);
				}

				$row = $db->sql_fetchrowset($result);
				$db->sql_freeresult($result);

				for($i = 0; $i < count($row); $i++)
				{
					$topic_id = $row[$i]['topic_id'];
					
					if ( isset($HTTP_POST_VARS['move_leave_shadow']) )
					{
						// Insert topic in the old forum that indicates that the forum has moved.
						$sql = 'INSERT INTO ' . TOPICS_TABLE . " (forum_id, topic_title, topic_poster, topic_time, topic_status, topic_type, topic_vote, topic_views, topic_replies, topic_first_post_id, topic_last_post_id, topic_moved_id)
							VALUES ($old_forum_id, '" . addslashes(str_replace("\'", "''", $row[$i]['topic_title'])) . "', '" . str_replace("\'", "''", $row[$i]['topic_poster']) . "', " . $row[$i]['topic_time'] . ", " . TOPIC_MOVED . ", " . POST_NORMAL . ", " . $row[$i]['topic_vote'] . ", " . $row[$i]['topic_views'] . ", " . $row[$i]['topic_replies'] . ", " . $row[$i]['topic_first_post_id'] . ", " . $row[$i]['topic_last_post_id'] . ", $topic_id)";
						if ( !$db->sql_query($sql) )
						{
							message_die(GENERAL_ERROR, 'Could not insert shadow topic', '', __LINE__, __FILE__, $sql);
						}
					}

					$sql = 'UPDATE ' . TOPICS_TABLE . ' 
						SET forum_id = ' . $new_forum_id . '
						WHERE topic_id = ' . $topic_id;
					if ( !$db->sql_query($sql) )
					{
						message_die(GENERAL_ERROR, 'Could not update old topic', '', __LINE__, __FILE__, $sql);
					}

					$sql = 'UPDATE ' . POSTS_TABLE . ' 
						SET forum_id = ' . $new_forum_id . '
						WHERE topic_id = ' . $topic_id;
					if ( !$db->sql_query($sql) )
					{
						message_die(GENERAL_ERROR, 'Could not update post topic ids', '', __LINE__, __FILE__, $sql);
					}
				}

				// Sync the forum indexes
				sync('forum', $new_forum_id);
				sync('forum', $old_forum_id);

				$message = $lang['Topics_Moved'] . '<br /><br />';

			}
			else
			{
				$message = $lang['No_Topics_Moved'] . '<br /><br />';
			}

			if ( !empty($topic_id) )
			{
				$redirect_page = 'viewtopic.'.$phpEx.'?' . POST_TOPIC_URL . '=' . $topic_id . '&amp;sid=' . $userdata['session_id'];
				$message .= sprintf($lang['Click_return_topic'], '<a href="' . $redirect_page . '">', '</a>');
			}
			else
			{
				$redirect_page = 'modcp.'.$phpEx.'?' . POST_FORUM_URL . '=' . $forum_id . '&amp;sid=' . $userdata['session_id'];
				$message .= sprintf($lang['Click_return_modcp'], '<a href="' . $redirect_page . '">', '</a>');
			}

			$message = $message . '<br \><br \>' . sprintf($lang['Click_return_forum'], '<a href="' . "viewforum.$phpEx?" . POST_FORUM_URL . "=$old_forum_id&amp;sid=" . $userdata['session_id'] . '">', '</a>');

			$template->assign_vars(array(
				'META' => '<meta http-equiv="refresh" content="3;url=' . $redirect_page . '">')
			);

			message_die(GENERAL_MESSAGE, $message);
		}
		else
		{
			if ( empty($HTTP_POST_VARS['topic_id_list']) && empty($topic_id) )
			{
				message_die(GENERAL_MESSAGE, $lang['None_selected']);
			}

			$hidden_fields = '<input type="hidden" name="sid" value="' . $userdata['session_id'] . '" /><input type="hidden" name="mode" value="' . $mode . '" /><input type="hidden" name="' . POST_FORUM_URL . '" value="' . $forum_id . '" />';

			if ( isset($HTTP_POST_VARS['topic_id_list']) )
			{
				$topics = $HTTP_POST_VARS['topic_id_list'];

				for($i = 0; $i < count($topics); $i++)
				{
					$hidden_fields .= '<input type="hidden" name="topic_id_list[]" value="' . intval($topics[$i]) . '" />';
				}
			}
			else
			{
				$hidden_fields .= '<input type="hidden" name="' . POST_TOPIC_URL . '" value="' . $topic_id . '" />';
			}

			//
			// Set template files
			//
			$template->set_filenames(array(
				'movetopic' => 'modcp_move.tpl')
			);

			$template->assign_vars(array(
				'MESSAGE_TITLE' => $lang['Confirm'],
				'MESSAGE_TEXT' => $lang['Confirm_move_topic'],

				'L_MOVE_TO_FORUM' => $lang['Move_to_forum'], 
				'L_LEAVESHADOW' => $lang['Leave_shadow_topic'], 
				'L_YES' => $lang['Yes'],
				'L_NO' => $lang['No'],

				'S_FORUM_SELECT' => make_forum_select('new_forum', $forum_id), 
				'S_MODCP_ACTION' => append_sid('modcp.'.$phpEx),
				'S_HIDDEN_FIELDS' => $hidden_fields)
			);

			$template->pparse('movetopic');

			include($phpbb_root_path . 'includes/page_tail.'.$phpEx);
		}
		break;

	case 'lock':
		if ( empty($HTTP_POST_VARS['topic_id_list']) && empty($topic_id) )
		{
			message_die(GENERAL_MESSAGE, $lang['None_selected']);
		}

		$topics = ( isset($HTTP_POST_VARS['topic_id_list']) ) ?  $HTTP_POST_VARS['topic_id_list'] : array($topic_id);

		$topic_id_sql = '';
		for($i = 0; $i < count($topics); $i++)
		{
			$topic_id_sql .= ( ( $topic_id_sql != '' ) ? ', ' : '' ) . intval($topics[$i]);

//-- mod : the logger ----------------------------------------------------------
//-- add
			if( defined( 'LOG_MOD_INSTALLED' ) )
			{
				if( $log->config['log_mod_lock'] )
				{
					$log->insert( LOG_TYPE_MOD, 'LOG_M_LOCK', array(), '', $topics[$i] );
				}
			}
//-- fin mod : the logger ------------------------------------------------------
		}

		$sql = 'UPDATE ' . TOPICS_TABLE . ' 
			SET topic_status = ' . TOPIC_LOCKED . ' 
			WHERE topic_id IN (' . $topic_id_sql . ') 
				AND forum_id = ' . $forum_id . '
				AND topic_moved_id = 0';
		if ( !($result = $db->sql_query($sql)) )
		{
			message_die(GENERAL_ERROR, 'Could not update topics table', '', __LINE__, __FILE__, $sql);
		}

		if ( !empty($topic_id) )
		{
			$redirect_page = 'viewtopic.'.$phpEx.'?' . POST_TOPIC_URL . '=' . $topic_id . '&amp;sid=' . $userdata['session_id'];
			$message = sprintf($lang['Click_return_topic'], '<a href="' . $redirect_page . '">', '</a>');
		}
		else
		{
			$redirect_page = 'modcp.'.$phpEx.'?' . POST_FORUM_URL . '=' . $forum_id . '&amp;sid=' . $userdata['session_id'];
			$message = sprintf($lang['Click_return_modcp'], '<a href="' . $redirect_page . '">', '</a>');
		}

		$message = $message . '<br \><br \>' . sprintf($lang['Click_return_forum'], '<a href="' . "viewforum.$phpEx?" . POST_FORUM_URL . "=$forum_id&amp;sid=" . $userdata['session_id'] . '">', '</a>');

		$template->assign_vars(array(
			'META' => '<meta http-equiv="refresh" content="3;url=' . $redirect_page . '">')
		);

		message_die(GENERAL_MESSAGE, $lang['Topics_Locked'] . '<br /><br />' . $message);

		break;

	case 'unlock':
		if ( empty($HTTP_POST_VARS['topic_id_list']) && empty($topic_id) )
		{
			message_die(GENERAL_MESSAGE, $lang['None_selected']);
		}

		$topics = ( isset($HTTP_POST_VARS['topic_id_list']) ) ?  $HTTP_POST_VARS['topic_id_list'] : array($topic_id);

		$topic_id_sql = '';
		for($i = 0; $i < count($topics); $i++)
		{
			$topic_id_sql .= ( ( $topic_id_sql != '') ? ', ' : '' ) . intval($topics[$i]);

//-- mod : the logger ----------------------------------------------------------
//-- add
			if( defined( 'LOG_MOD_INSTALLED' ) )
			{
				if( $log->config['log_mod_unlock'] )
				{
					$log->insert( LOG_TYPE_MOD, 'LOG_M_UNLOCK', array(), '', $topics[$i] );
				}
			}
//-- fin mod : the logger ------------------------------------------------------
		}

		$sql = 'UPDATE ' . TOPICS_TABLE . ' 
			SET topic_status = ' . TOPIC_UNLOCKED . ' 
			WHERE topic_id IN (' . $topic_id_sql . ') 
				AND forum_id = ' . $forum_id . '
				AND topic_moved_id = 0';
		if ( !($result = $db->sql_query($sql)) )
		{
			message_die(GENERAL_ERROR, 'Could not update topics table', '', __LINE__, __FILE__, $sql);
		}

		if ( !empty($topic_id) )
		{
			$redirect_page = 'viewtopic.'.$phpEx.'?' . POST_TOPIC_URL . '=' . $topic_id . '&amp;sid=' . $userdata['session_id'];
			$message = sprintf($lang['Click_return_topic'], '<a href="' . $redirect_page . '">', '</a>');
		}
		else
		{
			$redirect_page = 'modcp.'.$phpEx.'?' . POST_FORUM_URL .'=' . $forum_id . '&amp;sid=' . $userdata['session_id'];
			$message = sprintf($lang['Click_return_modcp'], '<a href="' . $redirect_page . '">', '</a>');
		}

		$message = $message . '<br \><br \>' . sprintf($lang['Click_return_forum'], '<a href="' . "viewforum.$phpEx?" . POST_FORUM_URL . "=$forum_id&amp;sid=" . $userdata['session_id'] . '">', '</a>');

		$template->assign_vars(array(
			'META' => '<meta http-equiv="refresh" content="3;url=' . $redirect_page . '">')
		);

		message_die(GENERAL_MESSAGE, $lang['Topics_Unlocked'] . '<br /><br />' . $message);

		break;

//-- mod : modcp merge hack ----------------------------------------------------
//-- add
	case 'merge':
		$page_title = $lang['Mod_CP'];
		include($phpbb_root_path . 'includes/page_header.'.$phpEx);

		if ( $confirm )
		{
			if ( empty($HTTP_POST_VARS['topic_id_list']) && empty($topic_id) )
			{
				message_die(GENERAL_MESSAGE, $lang['None_selected']);
			}

			$new_topic_id = $HTTP_POST_VARS['new_topic'];
      $topic_id_list = isset($HTTP_POST_VARS['topic_id_list']) ? $HTTP_POST_VARS['topic_id_list'] : array($topic_id);
			$old_forum_id = $forum_id;

			for ($i=0; $i < count($topic_id_list); $i++)
			{
				$old_topic_id = $topic_id_list[$i];

				if ( $new_topic_id != $old_topic_id )
				{
					$sql = 'UPDATE ' . POSTS_TABLE . '
					SET topic_id = ' . $new_topic_id . ' 
					WHERE topic_id = ' . $topic_id_list[$i];
					if ( !($result = $db->sql_query($sql, BEGIN_TRANSACTION)) )
					{
						message_die(GENERAL_ERROR, 'Could not update posts', '', __LINE__, __FILE__, $sql);
					}

					$sql = 'DELETE FROM ' . TOPICS_TABLE . '
						WHERE topic_id = ' . $topic_id_list[$i];
					if ( !($result = $db->sql_query($sql, BEGIN_TRANSACTION)) )
					{
						message_die(GENERAL_ERROR, 'Could not update posts', '', __LINE__, __FILE__, $sql);
					}

					$sql = 'DELETE FROM ' . TOPICS_WATCH_TABLE . '
						WHERE topic_id = ' . $topic_id_list[$i];
					if ( !($result = $db->sql_query($sql, BEGIN_TRANSACTION)) )
					{
						message_die(GENERAL_ERROR, 'Could not update posts', '', __LINE__, __FILE__, $sql);
					}

					sync('forum', $forum_id);
					sync('topic', $new_topic_id);

					$message = $lang['Topics_Moved'] . '<br /><br />';
				}
				else
				{
					$message = $lang['No_Topics_Moved'] . '<br /><br />';
				}
			}

			if ( !empty($topic_id) )
			{
				$redirect_page = 'viewtopic.'.$phpEx . '?' . POST_TOPIC_URL . '=' . $new_topic_id . '&amp;sid=' . $userdata['session_id'];
				$message .= sprintf($lang['Click_return_topic'], '<a href="' . $redirect_page . '">', '</a>');
			}
			else
			{
				$redirect_page = 'modcp.'.$phpEx . '?' . POST_FORUM_URL . '=' . $forum_id . '&amp;sid=' . $userdata['session_id'];
				$message .= sprintf($lang['Click_return_modcp'], '<a href="' . $redirect_page . '">', '</a>');
			}

			$message = $message . '<br \><br \>' . sprintf($lang['Click_return_forum'], '<a href="' . 'viewforum.'.$phpEx . '?' . POST_FORUM_URL . '=' . $old_forum_id . '&amp;sid=' . $userdata['session_id'] . '">', '</a>');

			$template->assign_vars(array(
				'META' => '<meta http-equiv="refresh" content="3;url=' . $redirect_page . '">')
			);

			message_die(GENERAL_MESSAGE, $message);
		}
		else
		{
			if ( empty($HTTP_POST_VARS['topic_id_list']) && empty($topic_id) )
			{
				message_die(GENERAL_MESSAGE, $lang['None_selected']);
			}

			$hidden_fields = '<input type="hidden" name="sid" value="' . $userdata['session_id'] . '" /><input type="hidden" name="mode" value="' . $mode . '" /><input type="hidden" name="' . POST_FORUM_URL . '" value="' . $forum_id . '" />';

			if ( isset($HTTP_POST_VARS['topic_id_list']) )
			{
				$topics = $HTTP_POST_VARS['topic_id_list'];

				for($i = 0; $i < count($topics); $i++)
				{
					$hidden_fields .= '<input type="hidden" name="topic_id_list[]" value="' . intval($topics[$i]) . '" />';
				}
			}
			else
			{
				$hidden_fields .= '<input type="hidden" name="' . POST_TOPIC_URL . '" value="' . $topic_id . '" />';
			}

			//
			// Set template files
			//
			$template->set_filenames(array(
				'mergetopic' => 'modcp_merge.tpl')
			);

			$template->assign_vars(array(
				'MESSAGE_TITLE' => $lang['Confirm'],
				'MESSAGE_TEXT' => $lang['Confirm_move_topic'],

				'L_MERGE_TOPIC' => $lang['Merge_topic'],
												
				'L_YES' => $lang['Yes'],
				'L_NO' => $lang['No'],

				'S_TOPIC_SELECT' => make_topic_select('new_topic', $forum_id),
				'S_MODCP_ACTION' => append_sid('modcp.'.$phpEx),
				'S_HIDDEN_FIELDS' => $hidden_fields)
			);

		$template->pparse('mergetopic');

		include($phpbb_root_path . 'includes/page_tail.'.$phpEx);
		}

		break;
//-- fin mod : modcp merge hack ------------------------------------------------

	case 'split':
		$page_title = $lang['Mod_CP'];
		include($phpbb_root_path . 'includes/page_header.'.$phpEx);

		$post_id_sql = '';

		if (isset($HTTP_POST_VARS['split_type_all']) || isset($HTTP_POST_VARS['split_type_beyond']))
		{
			$posts = $HTTP_POST_VARS['post_id_list'];

			for ($i = 0; $i < count($posts); $i++)
			{
				$post_id_sql .= (($post_id_sql != '') ? ', ' : '') . intval($posts[$i]);
			}
		}

		if ($post_id_sql != '')
		{
			$sql = 'SELECT post_id 
				FROM ' . POSTS_TABLE . '
				WHERE post_id IN (' . $post_id_sql . ')
					AND forum_id = ' . $forum_id;
			if ( !($result = $db->sql_query($sql)) )
			{
				message_die(GENERAL_ERROR, 'Could not get post id information', '', __LINE__, __FILE__, $sql);
			}
			
			$post_id_sql = '';
			while ($row = $db->sql_fetchrow($result))
			{
				$post_id_sql .= (($post_id_sql != '') ? ', ' : '') . intval($row['post_id']);
			}
			$db->sql_freeresult($result);

			if ($post_id_sql == '')
			{
				message_die(GENERAL_MESSAGE, $lang['None_selected']);
			}

			$sql = 'SELECT post_id, poster_id, topic_id, post_time
				FROM ' . POSTS_TABLE . '
				WHERE post_id IN (' . $post_id_sql . ') 
				ORDER BY post_time ASC';
			if (!($result = $db->sql_query($sql)))
			{
				message_die(GENERAL_ERROR, 'Could not get post information', '', __LINE__, __FILE__, $sql);
			}

			if ($row = $db->sql_fetchrow($result))
			{
				$first_poster = $row['poster_id'];
				$topic_id = $row['topic_id'];
				$post_time = $row['post_time'];

				$user_id_sql = '';
				$post_id_sql = '';
				do
				{
					$user_id_sql .= (($user_id_sql != '') ? ', ' : '') . intval($row['poster_id']);
					$post_id_sql .= (($post_id_sql != '') ? ', ' : '') . intval($row['post_id']);;
				}
				while ($row = $db->sql_fetchrow($result));

				$post_subject = trim(htmlspecialchars($HTTP_POST_VARS['subject']));
				if (empty($post_subject))
				{
					message_die(GENERAL_MESSAGE, $lang['Empty_subject']);
				}

				$new_forum_id = intval($HTTP_POST_VARS['new_forum_id']);
				$topic_time = time();
				
				$sql = 'SELECT forum_id FROM ' . FORUMS_TABLE . '
					WHERE forum_id = ' . $new_forum_id;
				if ( !($result = $db->sql_query($sql)) )
				{
					message_die(GENERAL_ERROR, 'Could not select from forums table', '', __LINE__, __FILE__, $sql);
				}
			
				if (!$db->sql_fetchrow($result))
				{
					message_die(GENERAL_MESSAGE, 'New forum does not exist');
				}

				$db->sql_freeresult($result);

				$sql  = 'INSERT INTO ' . TOPICS_TABLE . " (topic_title, topic_poster, topic_time, forum_id, topic_status, topic_type)
					VALUES ('" . str_replace("\'", "''", $post_subject) . "', $first_poster, " . $topic_time . ", $new_forum_id, " . TOPIC_UNLOCKED . ", " . POST_NORMAL . ")";
				if (!($db->sql_query($sql, BEGIN_TRANSACTION)))
				{
					message_die(GENERAL_ERROR, 'Could not insert new topic', '', __LINE__, __FILE__, $sql);
				}

				$new_topic_id = $db->sql_nextid();

//-- mod : topics a user has started -------------------------------------------
//-- add
				$sql = 'UPDATE ' . USERS_TABLE . '
					SET user_topics = user_topics + 1
					WHERE user_id = ' . $first_poster;
				if (!($db->sql_query($sql)))
				{
					message_die(GENERAL_ERROR, 'Could not update user topic count information', '', __LINE__, __FILE__, $sql);
				}
//-- fin mod : topics a user has started ---------------------------------------

				// Update topic watch table, switch users whose posts
				// have moved, over to watching the new topic
				$sql = 'UPDATE ' . TOPICS_WATCH_TABLE . ' 
					SET topic_id = ' . $new_topic_id . '
					WHERE topic_id = ' . $topic_id . '
						AND user_id IN (' . $user_id_sql . ')';
				if (!$db->sql_query($sql))
				{
					message_die(GENERAL_ERROR, 'Could not update topics watch table', '', __LINE__, __FILE__, $sql);
				}

				$sql_where = (!empty($HTTP_POST_VARS['split_type_beyond'])) ? 'post_time >= ' . $post_time . ' AND topic_id = ' . $topic_id : 'post_id IN (' . $post_id_sql . ')';

				$sql = 	'UPDATE ' . POSTS_TABLE . '
					SET topic_id = ' . $new_topic_id . ', forum_id = ' . $new_forum_id . '
					WHERE ' . $sql_where;
				if (!$db->sql_query($sql, END_TRANSACTION))
				{
					message_die(GENERAL_ERROR, 'Could not update posts table', '', __LINE__, __FILE__, $sql);
				}

				sync('topic', $new_topic_id);
				sync('topic', $topic_id);
				sync('forum', $new_forum_id);
				sync('forum', $forum_id);

				$template->assign_vars(array(
					'META' => '<meta http-equiv="refresh" content="3;url=' . "viewtopic.$phpEx?" . POST_TOPIC_URL . "=$topic_id&amp;sid=" . $userdata['session_id'] . '">')
				);

				$message = $lang['Topic_split'] . '<br /><br />' . sprintf($lang['Click_return_topic'], '<a href="' . "viewtopic.$phpEx?" . POST_TOPIC_URL . "=$topic_id&amp;sid=" . $userdata['session_id'] . '">', '</a>');
				message_die(GENERAL_MESSAGE, $message);
			}
		}
		else
		{
			//
			// Set template files
			//
			$template->set_filenames(array(
				'split_body' => 'modcp_split.tpl')
			);

//-- mod : quick split ---------------------------------------------------------
//-- add
			if($quick_split) 
			{ 
				$sql_split = 'AND p.post_id >= ' . $post_id; 
			}
			else 
			{ 
				$sql_split = ' '; 
			}
//-- fin mod : quick split -----------------------------------------------------

//-- mod : simple subforums ----------------------------------------------------
//-- add
			$all_forums = array();
			make_jumpbox_ref('modcp.'.$phpEx, $forum_id, $all_forums);

			$parent_id = 0;
			for( $i = 0; $i < count($all_forums); $i++ )
			{
				if( $all_forums[$i]['forum_id'] == $forum_id )
				{
					$parent_id = $all_forums[$i]['forum_parent'];
				}
			}

			if( $parent_id )
			{
				for( $i = 0; $i < count($all_forums); $i++)
				{
					if( $all_forums[$i]['forum_id'] == $parent_id )
					{
						$template->assign_vars(array(
							'PARENT_FORUM'			=> 1,
							'U_VIEW_PARENT_FORUM'	=> append_sid("viewforum.$phpEx?" . POST_FORUM_URL .'=' . $all_forums[$i]['forum_id']),
							'PARENT_FORUM_NAME'		=> $all_forums[$i]['forum_name'],
						));
					}
				}
			}
//-- fin mod : simple subforums ------------------------------------------------

//-- mod : quick split ---------------------------------------------------------
// here we added
//	' . $sql_split . '
//-- modify
			$sql = 'SELECT u.username, p.*, pt.post_text, pt.bbcode_uid, pt.post_subject, p.post_username
				FROM ' . POSTS_TABLE . ' p, ' . USERS_TABLE . ' u, ' . POSTS_TEXT_TABLE . ' pt
				WHERE p.topic_id = ' . $topic_id . '
					AND p.poster_id = u.user_id
					AND p.post_id = pt.post_id
				' . $sql_split . '
				ORDER BY p.post_time ASC';
//-- fin mod : quick split -----------------------------------------------------
//-- mod : rank color system ---------------------------------------------------
//-- add
			$sql = str_replace('SELECT ', 'SELECT u.user_level, u.user_color, u.user_group_id, ', $sql);
//-- fin mod : rank color system -----------------------------------------------

			if ( !($result = $db->sql_query($sql)) )
			{
				message_die(GENERAL_ERROR, 'Could not get topic/post information', '', __LINE__, __FILE__, $sql);
			}

			$s_hidden_fields = '<input type="hidden" name="sid" value="' . $userdata['session_id'] . '" /><input type="hidden" name="' . POST_FORUM_URL . '" value="' . $forum_id . '" /><input type="hidden" name="' . POST_TOPIC_URL . '" value="' . $topic_id . '" /><input type="hidden" name="mode" value="split" />';

			if( ( $total_posts = $db->sql_numrows($result) ) > 0 )
			{
				$postrow = $db->sql_fetchrowset($result);

				$template->assign_vars(array(
					'L_SPLIT_TOPIC' => $lang['Split_Topic'],
					'L_SPLIT_TOPIC_EXPLAIN' => $lang['Split_Topic_explain'],
					'L_AUTHOR' => $lang['Author'],
					'L_MESSAGE' => $lang['Message'],
					'L_SELECT' => $lang['Select'],
					'L_SPLIT_SUBJECT' => $lang['Split_title'],
					'L_SPLIT_FORUM' => $lang['Split_forum'],
					'L_POSTED' => $lang['Posted'],
					'L_SPLIT_POSTS' => $lang['Split_posts'],
					'L_SUBMIT' => $lang['Submit'],
					'L_SPLIT_AFTER' => $lang['Split_after'], 
					'L_POST_SUBJECT' => $lang['Post_subject'], 
					'L_MARK_ALL' => $lang['Mark_all'], 
					'L_UNMARK_ALL' => $lang['Unmark_all'], 
					'L_POST' => $lang['Post'], 

					'FORUM_NAME' => $forum_name, 

//-- mod : view category name --------------------------------------------------
//-- add
					'CAT_NAME' => $cat_info['title'],
					'U_CAT' => append_sid($phpbb_root_path . "index.$phpEx?" . POST_CAT_URL . "=" . $cat_info['id']),
//-- fin mod : view category name ----------------------------------------------

					'U_VIEW_FORUM' => append_sid("viewforum.$phpEx?" . POST_FORUM_URL . "=$forum_id"), 

					'S_SPLIT_ACTION' => append_sid('modcp.'.$phpEx),
					'S_HIDDEN_FIELDS' => $s_hidden_fields,
					'S_FORUM_SELECT' => make_forum_select("new_forum_id", false, $forum_id))
				);

				//
				// Define censored word matches
				//
				$orig_word = array();
				$replacement_word = array();
				obtain_word_list($orig_word, $replacement_word);

				for($i = 0; $i < $total_posts; $i++)
				{
					$post_id = $postrow[$i]['post_id'];
					$poster_id = $postrow[$i]['poster_id'];
					$poster = $postrow[$i]['username'];

					$post_date = create_date($board_config['default_dateformat'], $postrow[$i]['post_time'], $board_config['board_timezone']);

					$bbcode_uid = $postrow[$i]['bbcode_uid'];
					$message = $postrow[$i]['post_text'];
					$post_subject = ( $postrow[$i]['post_subject'] != '' ) ? $postrow[$i]['post_subject'] : $topic_title;

					//
					// If the board has HTML off but the post has HTML
					// on then we process it, else leave it alone
					//
					if ( !$board_config['allow_html'] )
					{
						if ( $postrow[$i]['enable_html'] )
						{
							$message = preg_replace('#(<)([\/]?.*?)(>)#is', '&lt;\\2&gt;', $message);
						}
					}

					if ( $bbcode_uid != '' )
					{
						$message = ( $board_config['allow_bbcode'] ) ? bbencode_second_pass($message, $bbcode_uid) : preg_replace('/\:[0-9a-z\:]+\]/si', ']', $message);
					}

					if ( count($orig_word) )
					{
						$post_subject = preg_replace($orig_word, $replacement_word, $post_subject);
						$message = preg_replace($orig_word, $replacement_word, $message);
					}

					$message = make_clickable($message);

					if ( $board_config['allow_smilies'] && $postrow[$i]['enable_smilies'] )
					{
//-- mod : smiley categories ---------------------------------------------------
//-- delete
/*-MOD
						$message = smilies_pass($message);
MOD-*/
//-- add
						$message = smilies_pass($message, $forum_id, $forum_cat_id);
//-- fin mod : smiley categories -----------------------------------------------
					}

					$message = str_replace("\n", '<br />', $message);
					
					$row_color = ( !($i % 2) ) ? $theme['td_color1'] : $theme['td_color2'];
					$row_class = ( !($i % 2) ) ? $theme['td_class1'] : $theme['td_class2'];

//-- mod : quick split ---------------------------------------------------------
//-- delete
/*-MOD
					$checkbox = ( $i > 0 ) ? '<input type="checkbox" name="post_id_list[]" value="' . $post_id . '" />' : '&nbsp;';
MOD-*/
//-- add
					$checkbox = ( $i > 0 || $quick_split ) ? '<input type="checkbox" name="post_id_list[]" value="' . $post_id . '" />' : '&nbsp;';
//-- fin mod : quick split -----------------------------------------------------

					$template->assign_block_vars('postrow', array(
						'ROW_COLOR' => '#' . $row_color,
						'ROW_CLASS' => $row_class,
//-- mod : rank color system ---------------------------------------------------
//-- delete
/*-MOD
						'POSTER_NAME' => $poster,
MOD-*/
						'POSTER_NAME' => ($poster_id == ANONYMOUS) ? (($postrow[$i]['post_username'] != '') ? $postrow[$i]['post_username'] : $lang['Guest']) : $rcs->get_colors($postrow[$i], $postrow[$i]['username']),
//-- fin mod : rank color system -----------------------------------------------
						'POST_DATE' => $post_date,
						'POST_SUBJECT' => $post_subject,
						'MESSAGE' => $message,
						'POST_ID' => $post_id,
						
						'S_SPLIT_CHECKBOX' => $checkbox)
					);
				}

				$template->pparse('split_body');
			}
		}
		break;

	case 'ip':
		$page_title = $lang['Mod_CP'];
		include($phpbb_root_path . 'includes/page_header.'.$phpEx);

		$rdns_ip_num = ( isset($HTTP_GET_VARS['rdns']) ) ? $HTTP_GET_VARS['rdns'] : "";

		if ( !$post_id )
		{
			message_die(GENERAL_MESSAGE, $lang['No_such_post']);
		}

		//
		// Set template files
		//
		$template->set_filenames(array(
			'viewip' => 'modcp_viewip.tpl')
		);

		// Look up relevent data for this post
		$sql = 'SELECT poster_ip, poster_id 
			FROM ' . POSTS_TABLE . ' 
			WHERE post_id = ' . $post_id . '
				AND forum_id = ' . $forum_id;
		if ( !($result = $db->sql_query($sql)) )
		{
			message_die(GENERAL_ERROR, 'Could not get poster IP information', '', __LINE__, __FILE__, $sql);
		}
		
		if ( !($post_row = $db->sql_fetchrow($result)) )
		{
			message_die(GENERAL_MESSAGE, $lang['No_such_post']);
		}

		$ip_this_post = decode_ip($post_row['poster_ip']);
		$ip_this_post = ( $rdns_ip_num == $ip_this_post ) ? htmlspecialchars(gethostbyaddr($ip_this_post)) : $ip_this_post;

		$poster_id = $post_row['poster_id'];

		$template->assign_vars(array(
			'L_IP_INFO' => $lang['IP_info'],
			'L_THIS_POST_IP' => $lang['This_posts_IP'],
			'L_OTHER_IPS' => $lang['Other_IP_this_user'],
			'L_OTHER_USERS' => $lang['Users_this_IP'],
			'L_LOOKUP_IP' => $lang['Lookup_IP'], 
			'L_SEARCH' => $lang['Search'],

			'SEARCH_IMG' => $images['icon_search'], 

			'IP' => $ip_this_post, 
				
			'U_LOOKUP_IP' => 'modcp.'.$phpEx.'?mode=ip&amp;' . POST_POST_URL . '=' . $post_id . '&amp;' . POST_TOPIC_URL . '=' . $topic_id . '&amp;rdns=' . $ip_this_post . '&amp;sid=' . $userdata['session_id'])
		);

		//
		// Get other IP's this user has posted under
		//
		$sql = 'SELECT poster_ip, COUNT(*) AS postings 
			FROM ' . POSTS_TABLE . ' 
			WHERE poster_id = ' . $poster_id . '
			GROUP BY poster_ip 
			ORDER BY ' . (( SQL_LAYER == 'msaccess' ) ? 'COUNT(*)' : 'postings' ) . ' DESC';
		if ( !($result = $db->sql_query($sql)) )
		{
			message_die(GENERAL_ERROR, 'Could not get IP information for this user', '', __LINE__, __FILE__, $sql);
		}

		if ( $row = $db->sql_fetchrow($result) )
		{
			$i = 0;
			do
			{
				if ( $row['poster_ip'] == $post_row['poster_ip'] )
				{
					$template->assign_vars(array(
						'POSTS' => $row['postings'] . ' ' . ( ( $row['postings'] == 1 ) ? $lang['Post'] : $lang['Posts'] ))
					);
					continue;
				}

				$ip = decode_ip($row['poster_ip']);
				$ip = ( $rdns_ip_num == $row['poster_ip'] || $rdns_ip_num == 'all') ? htmlspecialchars(gethostbyaddr($ip)) : $ip;

				$row_color = ( !($i % 2) ) ? $theme['td_color1'] : $theme['td_color2'];
				$row_class = ( !($i % 2) ) ? $theme['td_class1'] : $theme['td_class2'];

				$template->assign_block_vars('iprow', array(
					'ROW_COLOR' => '#' . $row_color, 
					'ROW_CLASS' => $row_class, 
					'IP' => $ip,
					'POSTS' => $row['postings'] . ' ' . ( ( $row['postings'] == 1 ) ? $lang['Post'] : $lang['Posts'] ),

					'U_LOOKUP_IP' => 'modcp.'.$phpEx.'?mode=ip&amp;' . POST_POST_URL . '=' . $post_id . '&amp;' . POST_TOPIC_URL . '=' . $topic_id . '&amp;rdns=' . $row['poster_ip'] . '&amp;sid=' . $userdata['session_id'])
				);

				$i++; 
			}
			while ( $row = $db->sql_fetchrow($result) );
		}

		//
		// Get other users who've posted under this IP
		//
		$sql = 'SELECT u.user_id, u.username, COUNT(*) as postings 
			FROM ' . USERS_TABLE . ' u, ' . POSTS_TABLE . ' p 
			WHERE p.poster_id = u.user_id 
				AND p.poster_ip = "' . $post_row['poster_ip'] . '"
			GROUP BY u.user_id, u.username
			ORDER BY ' . (( SQL_LAYER == 'msaccess' ) ? 'COUNT(*)' : 'postings' ) . ' DESC';
//-- mod : rank color system ---------------------------------------------------
//-- add
		$sql = str_replace('SELECT ', 'SELECT u.user_level, u.user_color, u.user_group_id, ', $sql);
//-- fin mod : rank color system -----------------------------------------------
		if ( !($result = $db->sql_query($sql)) )
		{
			message_die(GENERAL_ERROR, 'Could not get posters information based on IP', '', __LINE__, __FILE__, $sql);
		}

		if ( $row = $db->sql_fetchrow($result) )
		{
			$i = 0;
			do
			{
				$id = $row['user_id'];
				$username = ( $id == ANONYMOUS ) ? $lang['Guest'] : $row['username'];

				$row_color = ( !($i % 2) ) ? $theme['td_color1'] : $theme['td_color2'];
				$row_class = ( !($i % 2) ) ? $theme['td_class1'] : $theme['td_class2'];

				$template->assign_block_vars('userrow', array(
					'ROW_COLOR' => '#' . $row_color, 
					'ROW_CLASS' => $row_class, 
//-- mod : rank color system ---------------------------------------------------
//-- delete
/*-MOD
					'USERNAME' => $username,
MOD-*/
//-- add
					'USERNAME' => ($id == ANONYMOUS) ? $lang['Guest'] : $rcs->get_colors($row, $row['username']),
//-- fin mod : rank color system -----------------------------------------------
					'POSTS' => $row['postings'] . ' ' . ( ( $row['postings'] == 1 ) ? $lang['Post'] : $lang['Posts'] ),
					'L_SEARCH_POSTS' => sprintf($lang['Search_user_posts'], $username), 

//-- mod : rank color system ---------------------------------------------------
//-- delete
/*-MOD
					'U_PROFILE' => ($id == ANONYMOUS) ? "modcp.$phpEx?mode=ip&amp;" . POST_POST_URL . "=" . $post_id . "&amp;" . POST_TOPIC_URL . "=" . $topic_id . "&amp;sid=" . $userdata['session_id'] : append_sid("profile.$phpEx?mode=viewprofile&amp;" . POST_USERS_URL . "=$id"),
MOD-*/
//-- add
					'U_PROFILE' => ($id == ANONYMOUS) ? $get->url('modcp', array('mode' => 'ip', POST_POST_URL => $post_id, POST_TOPIC_URL => $topic_id, 'sid' => $userdata['session_id']), true) : $get->url('profile', array('mode' => 'viewprofile', POST_USERS_URL => $id), true),
//-- fin mod : rank color system -----------------------------------------------

					'U_SEARCHPOSTS' => append_sid("search.$phpEx?search_author=" . (($id == ANONYMOUS) ? 'Anonymous' : urlencode($username)) . "&amp;showresults=topics"))
				);

				$i++; 
			}
			while ( $row = $db->sql_fetchrow($result) );
		}

		$template->pparse('viewip');

		break;

//-- mod : recycle bin hack ----------------------------------------------------
//-- add
	case 'recycle':
		$page_title = $lang['Mod_CP'];
		include($phpbb_root_path . 'includes/page_header.'.$phpEx);

		if ( $confirm_recycle )
		{
			if ( ( $board_config['bin_forum'] == 0 ) || ( empty($HTTP_POST_VARS['topic_id_list']) && empty($topic_id) ) )
			{
				$redirect_page = "modcp.$phpEx?" . POST_FORUM_URL . "=$forum_id&amp;sid=" . $userdata['session_id'];
				$message = sprintf($lang['Click_return_modcp'], '<a href="' . $redirect_page . '">', '</a>');
				$message = $message . '<br /><br />' . sprintf($lang['Click_return_forum'], '<a href="' . "viewforum.$phpEx?" . POST_FORUM_URL . "=$forum_id&amp;sid=" . $userdata['session_id'] . '">', '</a>');

				$template->assign_vars(array(
					'META' => '<meta http-equiv="refresh" content="3;url=' . $redirect_page . '">')
				);

				message_die(GENERAL_MESSAGE, $lang['None_selected'] . '<br /><br />' . $message);
			}
			else if ( isset($HTTP_POST_VARS['topic_id_list']) )
			{
				// Define bin forum
				$new_forum_id = intval($board_config['bin_forum']);
				$old_forum_id = $forum_id;

				if ( $new_forum_id != $old_forum_id )
				{
					$topics = ( isset($HTTP_POST_VARS['topic_id_list']) ) ?  $HTTP_POST_VARS['topic_id_list'] : array($topic_id);

					$topic_list = '';
					for($i = 0; $i < count($topics); $i++)
					{
						$topic_list .= ( ( $topic_list != '' ) ? ', ' : '' ) . intval($topics[$i]);
					}

					$sql = 'SELECT * 
						FROM ' . TOPICS_TABLE . ' 
						WHERE topic_id IN (' . $topic_list . ')
							AND forum_id = ' . $old_forum_id . '
							AND topic_status <> ' . TOPIC_MOVED;
					if ( !($result = $db->sql_query($sql, BEGIN_TRANSACTION)) )
					{
						message_die(GENERAL_ERROR, 'Could not select from topic table', '', __LINE__, __FILE__, $sql);
					}

					$row = $db->sql_fetchrowset($result);
					$db->sql_freeresult($result);

					for($i = 0; $i < count($row); $i++)
					{
						$topic_id = $row[$i]['topic_id'];

						if ( isset($HTTP_POST_VARS['move_leave_shadow']) )
						{
							// Insert topic in the old forum that indicates that the forum has moved.
							$sql = 'INSERT INTO ' . TOPICS_TABLE . " (forum_id, topic_title, topic_poster, topic_time, topic_status, topic_type, topic_vote, topic_views, topic_replies, topic_first_post_id, topic_last_post_id, topic_moved_id)
								VALUES ($old_forum_id, '" . addslashes(str_replace("\'", "''", $row[$i]['topic_title'])) . "', '" . str_replace("\'", "''", $row[$i]['topic_poster']) . "', " . $row[$i]['topic_time'] . ", " . TOPIC_MOVED . ", " . POST_NORMAL . ", " . $row[$i]['topic_vote'] . ", " . $row[$i]['topic_views'] . ", " . $row[$i]['topic_replies'] . ", " . $row[$i]['topic_first_post_id'] . ", " . $row[$i]['topic_last_post_id'] . ", $topic_id)";
							if ( !$db->sql_query($sql) )
							{
								message_die(GENERAL_ERROR, 'Could not insert shadow topic', '', __LINE__, __FILE__, $sql);
							}
						}

						$sql = 'UPDATE ' . TOPICS_TABLE . ' 
							SET forum_id = ' . $new_forum_id . '  
							WHERE topic_id = ' . $topic_id;
						if ( !$db->sql_query($sql) )
						{
							message_die(GENERAL_ERROR, 'Could not update old topic', '', __LINE__, __FILE__, $sql);
						}

						$sql = 'UPDATE ' . POSTS_TABLE . ' 
							SET forum_id = ' . $new_forum_id . '
							WHERE topic_id = ' . $topic_id;
						if ( !$db->sql_query($sql) )
						{
							message_die(GENERAL_ERROR, 'Could not update post topic ids', '', __LINE__, __FILE__, $sql);
						}
					}

					// Sync the forum indexes
					sync('forum', $new_forum_id);
					sync('forum', $old_forum_id);

					$message = $lang['Topics_Moved_bin'];
				}
				else
				{
					$message = $lang['No_Topics_Moved'];
				}

				$redirect_page = 'modcp.'.$phpEx . '?' . POST_FORUM_URL . '=' . $forum_id . '&amp;sid=' . $userdata['session_id'];
				$message .= '<br /><br />' . sprintf($lang['Click_return_modcp'], '<a href="' . $redirect_page . '">', '</a>');

				$message = $message . '<br /><br />' . sprintf($lang['Click_return_forum'], '<a href="' . 'viewforum.'.$phpEx . '?' . POST_FORUM_URL . '=' . $old_forum_id . '&amp;sid=' . $userdata['session_id'] . '">', '</a>');

				$template->assign_vars(array(
					'META' => '<meta http-equiv="refresh" content="3;url=' . $redirect_page . '">')
				);

				message_die(GENERAL_MESSAGE, $message);
			}
		}
		include($phpbb_root_path . 'includes/page_tail.'.$phpEx);
		break;
//-- fin mod : recycle bin hack ------------------------------------------------

//-- mod : quick title edition -------------------------------------------------
//-- add
	case 'quick_title_edit':
		if ( empty($HTTP_POST_VARS['topic_id_list']) && empty($topic_id) )
		{
		  message_die(GENERAL_MESSAGE, $lang['None_selected']);
		}

		$attribute = addslashes($qt_row['attribute']);
		$attribute_username	= addslashes($userdata['username']);
		$date = (!empty($qt_row['attribute_date_format'])) ? create_date($qt_row['attribute_date_format'], time(), $board_config['board_timezone']) : '';
		$topics	= isset($HTTP_POST_VARS['topic_id_list']) ? $HTTP_POST_VARS['topic_id_list'] : array($topic_id);

		$topic_id_sql = '';
		for ($i = 0; $i < count($topics); $i++)
		{
			$topic_id_sql .= (($topic_id_sql != '') ? ', ' : '') . $topics[$i];
		}

		$sql = 'UPDATE ' . TOPICS_TABLE . ' 
			SET topic_attribute = \'' . $attribute . '\', topic_attribute_color = \'' . $qt_row['attribute_color'] . '\', topic_attribute_position = \'' . $qt_row['attribute_position'] . '\', topic_attribute_username = \'' . $attribute_username . '\', topic_attribute_date = \'' . $date . '\' 
			WHERE topic_id IN (' . $topic_id_sql . ') AND topic_moved_id = 0';
		if (!$result = $db->sql_query($sql))
		{
			message_die(GENERAL_ERROR, 'Could not update topics table', '', __LINE__, __FILE__, $sql);
		}

		if (!empty($topic_id))
		{
			$redirect_page = 'viewtopic.' . $phpEx.'?' . POST_TOPIC_URL . '=' . $topic_id . '&amp;sid=' . $userdata['session_id'];
			$message = sprintf($lang['Click_return_topic'], '<a href="' . $redirect_page . '">', '</a>');
		}
		else
		{
			$redirect_page = 'modcp.' . $phpEx.'?' . POST_FORUM_URL . '=' . $forum_id . '&amp;sid=' . $userdata['session_id'];
			$message = sprintf($lang['Click_return_modcp'], '<a href="' . $redirect_page . '">', '</a>');
		}

		$message = $message . '<br \><br \>' . sprintf($lang['Click_return_forum'], '<a href="' . 'viewforum.' . $phpEx . '?' . POST_FORUM_URL . '=' . $forum_id . '&amp;sid=' . $userdata['session_id'] . '">', '</a>');
		$template->assign_vars(array('META' => '<meta http-equiv="refresh" content="3;url=' . $redirect_page . '">'));

		message_die(GENERAL_MESSAGE, $lang['Attribute_Edited'] . '<br /><br />' . $message);
		break;
//-- fin mod : quick title edition ---------------------------------------------

	default:
		$page_title = $lang['Mod_CP'];
		include($phpbb_root_path . 'includes/page_header.'.$phpEx);

//-- mod : quick title edition -------------------------------------------------
//-- add
		$sql = 'SELECT * FROM ' . ATTRIBUTES_TABLE . ' ORDER BY attribute_order ASC';
		if (!$result = $db->sql_query($sql))
		{
			message_die(GENERAL_MESSAGE, 'Could not query attributes table');
		}

		$select_title = '<select name="qtnum"><option value="-1" style="font-weight: bold;">' . $lang['No_Attribute'] . '</option>';
		while ( $row = $db->sql_fetchrow($result) )
		{
			$attribute = isset($lang[$row['attribute']]) ? $lang[$row['attribute']] : $row['attribute'];
			$attribute = str_replace('%mod%', addslashes($userdata['username']), $attribute);
			$date = (!empty($row['attribute_date_format'])) ? create_date($row['attribute_date_format'], time(), $board_config['board_timezone']) : '';
			$attribute = str_replace('%date%', $date, $attribute);
			$select_title .= '<option value="' . $row['attribute_id'] . '" style="font-weight: bold; color:#' . $row['attribute_color'] . '">' . $attribute . '</option>';
		}
		$select_title .= '</select>';
//-- fin mod : quick title edition ---------------------------------------------

		$template->assign_vars(array(
			'FORUM_NAME' => $forum_name,
//-- mod : quick title edition -------------------------------------------------
//-- add
			'SELECT_TITLE' => $select_title,
			'L_EDIT_TITLE' => $lang['Attribute_apply'],
//-- fin mod : quick title edition ---------------------------------------------

//-- mod : view category name --------------------------------------------------
//-- add
			'CAT_NAME' => $cat_info['title'],
			'U_CAT' => append_sid($phpbb_root_path . "index.$phpEx?" . POST_CAT_URL . "=" . $cat_info['id']),
//-- fin mod : view category name ----------------------------------------------

			'L_MOD_CP' => $lang['Mod_CP'],
			'L_MOD_CP_EXPLAIN' => $lang['Mod_CP_explain'],
			'L_SELECT' => $lang['Select'],
			'L_DELETE' => $lang['Delete'],
			'L_MOVE' => $lang['Move'],
			'L_LOCK' => $lang['Lock'],
			'L_UNLOCK' => $lang['Unlock'],

//-- mod : modcp merge hack ----------------------------------------------------
//-- add
			'L_MERGE' => $lang['Merge'],
//-- fin mod : modcp merge hack ------------------------------------------------

			'L_TOPICS' => $lang['Topics'], 
			'L_REPLIES' => $lang['Replies'],
//-- mod : rank color system ---------------------------------------------------
//-- add
			'L_AUTHOR' => $lang['Author'],

//-- mod : first topic date ----------------------------------------------------
//-- add
			'L_CREATE_DATE'		=> $lang['Create_Date'],
//-- fin mod : first topic date ------------------------------------------------

			'L_VIEWS' => $lang['Views'],
//-- fin mod : rank color system ----------------------------------------------- 
			'L_LASTPOST' => $lang['Last_Post'], 
			'L_SELECT' => $lang['Select'], 

//-- mod : recycle bin hack ----------------------------------------------------
//-- add
			'L_RECYCLE' => $lang['Bin_recycle'],
			'L_MARK_ALL' => $lang['Mark_all'],
			'L_UNMARK_ALL' => $lang['Unmark_all'],
//-- fin mod : recycle bin hack ------------------------------------------------

			'U_VIEW_FORUM' => append_sid('viewforum.'.$phpEx.'?' . POST_FORUM_URL . '=' . $forum_id), 
			'S_HIDDEN_FIELDS' => '<input type="hidden" name="sid" value="' . $userdata['session_id'] . '" /><input type="hidden" name="' . POST_FORUM_URL . '" value="' . $forum_id . '" />',
			'S_MODCP_ACTION' => append_sid('modcp.'.$phpEx))
		);

		$template->set_filenames(array(
			'body' => 'modcp_body.tpl')
		);
//-- mod : simple subforums ----------------------------------------------------
//-- delete
/*-MOD
		make_jumpbox('modcp.'.$phpEx);
MOD-*/
//-- add
		$all_forums = array();
		make_jumpbox_ref('modcp.'.$phpEx, $forum_id, $all_forums);

		$parent_id = 0;
		for( $i = 0; $i < count($all_forums); $i++ )
		{
			if( $all_forums[$i]['forum_id'] == $forum_id )
			{
				$parent_id = $all_forums[$i]['forum_parent'];
			}
		}

		if( $parent_id )
		{
			for( $i = 0; $i < count($all_forums); $i++)
			{
				if( $all_forums[$i]['forum_id'] == $parent_id )
				{
					$template->assign_vars(array(
						'PARENT_FORUM'			=> 1,
						'U_VIEW_PARENT_FORUM'	=> append_sid('viewforum.'.$phpEx . '?' . POST_FORUM_URL . '=' . $all_forums[$i]['forum_id']),
						'PARENT_FORUM_NAME'		=> $all_forums[$i]['forum_name'],
					));
				}
			}
		}
//-- fin mod : simple subforums ------------------------------------------------

		//
		// Define censored word matches
		//
		$orig_word = array();
		$replacement_word = array();
		obtain_word_list($orig_word, $replacement_word);

//-- mod : rank color system ---------------------------------------------------
//-- delete
/*-MOD
		$sql = "SELECT t.*, u.username, u.user_id, p.post_time
			FROM " . TOPICS_TABLE . " t, " . USERS_TABLE . " u, " . POSTS_TABLE . " p
			WHERE t.forum_id = $forum_id
				AND t.topic_poster = u.user_id
				AND p.post_id = t.topic_last_post_id
			ORDER BY t.topic_type DESC, p.post_time DESC
			LIMIT $start, " . $board_config['topics_per_page'];
MOD-*/
//-- add
		$sql = 'SELECT t.*, u.username, u.user_id, u.user_level, u.user_color, u.user_group_id, u2.username as user2, u2.user_id as id2, u2.user_level as level2, u2.user_color as color2, u2.user_group_id as group_id2, p.post_username, p2.post_username AS post_username2, p2.post_time
			FROM ' . TOPICS_TABLE . ' t, ' . USERS_TABLE . ' u, ' . POSTS_TABLE . ' p, ' . POSTS_TABLE . ' p2, ' . USERS_TABLE . ' u2
			WHERE t.forum_id = ' . intval($forum_id) . '
				AND t.topic_poster = u.user_id
				AND p.post_id = t.topic_first_post_id
				AND p2.post_id = t.topic_last_post_id
				AND u2.user_id = p2.poster_id
			ORDER BY t.topic_type DESC, t.topic_last_post_id DESC
			LIMIT ' . $start . ', ' . $board_config['topics_per_page'];
//-- fin mod : rank color system ----------------------------------------------
		if ( !($result = $db->sql_query($sql)) )
		{
	   		message_die(GENERAL_ERROR, 'Could not obtain topic information', '', __LINE__, __FILE__, $sql);
		}

		while ( $row = $db->sql_fetchrow($result) )
		{
			$topic_title = '';

			if ( $row['topic_status'] == TOPIC_LOCKED )
			{
				$folder_img = $images['folder_locked'];
				$folder_alt = $lang['Topic_locked'];
			}
			else
			{
//-- mod : annonce globale -----------------------------------------------------
//-- delete
/*-MOD
				if ( $row['topic_type'] == POST_ANNOUNCE )
				{
					$folder_img = $images['folder_announce'];
					$folder_alt = $lang['Topic_Announcement'];
				}
MOD-*/
//-- add
				if ( $row['topic_type'] == POST_GLOBAL_ANNOUNCE )
				{
					$folder_img = $images['folder_global_announce'];
					$folder_alt = $lang['Topic_Global_Announcement'];
				}
				else if ( $row['topic_type'] == POST_ANNOUNCE )
				{
					$folder_img = $images['folder_announce'];
					$folder_alt = $lang['Topic_Announcement'];
				}
//-- fin mod : annonce globale -------------------------------------------------
				else if ( $row['topic_type'] == POST_STICKY )
				{
					$folder_img = $images['folder_sticky'];
					$folder_alt = $lang['Topic_Sticky'];
				}
				else 
				{
					$folder_img = $images['folder'];
					$folder_alt = $lang['No_new_posts'];
				}
			}

			$topic_id = $row['topic_id'];
			$topic_type = $row['topic_type'];

//-- mod : post icon -----------------------------------------------------------
//-- add
			$type = $row['topic_type'];
			$icon = get_icon_title($row['topic_icon'], 1, $type);
//-- fin mod : post icon -------------------------------------------------------

			$topic_status = $row['topic_status'];

//-- mod : annonce globale -----------------------------------------------------
//-- delete
/*-MOD
			if ( $topic_type == POST_ANNOUNCE )
			{
				$topic_type = $lang['Topic_Announcement'] . ' ';
			}
			else if ( $topic_type == POST_STICKY )
			{
				$topic_type = $lang['Topic_Sticky'] . ' ';
			}
			else if ( $topic_status == TOPIC_MOVED )
			{
				$topic_type = $lang['Topic_Moved'] . ' ';
			}
			else
			{
				$topic_type = '';		
			}
MOD-*/
//-- add
			if( $board_config['simple_split_topic_type'] )
			{
				if (( $topic_type == POST_GLOBAL_ANNOUNCE ) || ( $topic_type == POST_ANNOUNCE ) || ( $topic_type == POST_STICKY ))
				{
					$topic_type = '';
				}
				else if ( $topic_status == TOPIC_MOVED )
				{
					$topic_type = $lang['Topic_Moved'] . ' ';
				}
				else
				{
					$topic_type = '';
				}
			}
			else if( !$board_config['simple_split_topic_type'] )
			{
				if ( $topic_type == POST_GLOBAL_ANNOUNCE )
				{
					$topic_type = $lang['Topic_Global_Announcement'] . ' ';
				}
				else if ( $topic_type == POST_ANNOUNCE )
				{
					$topic_type = $lang['Topic_Announcement'] . ' ';
				}
				else if ( $topic_type == POST_STICKY )
				{
					$topic_type = $lang['Topic_Sticky'] . ' ';
				}
				else if ( $topic_status == TOPIC_MOVED )
				{
					$topic_type = $lang['Topic_Moved'] . ' ';
				}
				else
				{
					$topic_type = '';
				}
			}
//-- fin mod : annonce globale -------------------------------------------------

			if ( $row['topic_vote'] )
			{
//-- mod : inspired of categories hierarchy ------------------------------------
//-- delete
/*-MOD
				$topic_type .= $lang['Topic_Poll'] . ' ';
MOD-*/
//-- add
				$topic_type .= '<img src="' . $images['Topic_Poll'] . '" border="0" alt="' . $lang['Topic_Poll'] . '" title="' . $lang['Topic_Poll'] . '" />' . ' ';
//-- fin mod : inspired of categories hierarchy --------------------------------
			}
	
			$topic_title = $row['topic_title'];
//-- mod : quick title edition -------------------------------------------------
//-- add
			colorize_title($topic_title, $row['topic_attribute'], $row['topic_attribute_position'], $row['topic_attribute_color'], $row['topic_attribute_username'], $row['topic_attribute_date']);
//-- fin mod : quick title edition ---------------------------------------------

			if ( count($orig_word) )
			{
				$topic_title = preg_replace($orig_word, $replacement_word, $topic_title);
			}

			$u_view_topic = 'modcp.'.$phpEx.'?mode=split&amp;' . POST_TOPIC_URL . '=' . $topic_id . '&amp;sid=' . $userdata['session_id'];
			$topic_replies = $row['topic_replies'];

//-- mod : rank color system ---------------------------------------------------
//-- add
			$topic_author_color = $rcs->get_colors($row);
			$topic_author = ($row['user_id'] != ANONYMOUS) ? '<a href="' . $get->url('profile', array('mode' => 'viewprofile', POST_USERS_URL => $row['user_id']), true) . '"' . $topic_author_color .'>' : '';
			$topic_author .= ($row['user_id'] != ANONYMOUS) ? $row['username'] : (($row['post_username'] != '') ? $row['post_username'] : $lang['Guest']);
			$topic_author .= ($row['user_id'] != ANONYMOUS) ? '</a>' : '';

			$first_post_time = create_date($board_config['default_dateformat'], $row['topic_time'], $board_config['board_timezone']);

			$last_post_author_color = $rcs->get_colors($row, '', false, 'group_id2', 'color2', 'level2');
			$last_post_author = ($row['id2'] == ANONYMOUS) ? (($row['post_username2'] != '') ? $row['post_username2'] : $lang['Guest']) : '<a href="' . $get->url('profile', array('mode' => 'viewprofile', POST_USERS_URL => $row['id2']), true) . '"' . $last_post_author_color . '>' . $row['user2'] . '</a>';

			$last_post_url = '<a href="' . $get->url('viewtopic', array(POST_POST_URL => $row['topic_last_post_id']), true, $row['topic_last_post_id']) . '"><img src="' . $images['icon_latest_reply'] . '" alt="' . $lang['View_latest_post'] . '" title="' . $lang['View_latest_post'] . '" border="0" /></a>';

			$views = $row['topic_views'];
//-- fin mod : rank color system -----------------------------------------------

			$last_post_time = create_date($board_config['default_dateformat'], $row['post_time'], $board_config['board_timezone']);

			$template->assign_block_vars('topicrow', array(
				'U_VIEW_TOPIC' => $u_view_topic,

				'TOPIC_FOLDER_IMG' => $folder_img, 

//-- mod : hypercell class -----------------------------------------------------
//-- add
				'HYPERCELL_CLASS' => get_hypercell_class($row['topic_status'], false, $row['topic_type']),
//-- fin mod : hypercell class -------------------------------------------------

//-- mod : post icon -----------------------------------------------------------
//-- add
				'ICON' => $icon,
//-- fin mod : post icon -------------------------------------------------------

				'TOPIC_TYPE' => $topic_type, 
				'TOPIC_TITLE' => $topic_title,
				'REPLIES' => $topic_replies,
//-- mod : rank color system ---------------------------------------------------
//-- add
				'TOPIC_AUTHOR' => $topic_author,
				'VIEWS' => $views,
				'FIRST_POST_TIME' => $first_post_time,
				'LAST_POST_TIME' => $last_post_time,
				'LAST_POST_AUTHOR' => $last_post_author,
				'LAST_POST_IMG' => $last_post_url,
//-- fin mod : rank color system -----------------------------------------------
				'LAST_POST_TIME' => $last_post_time,
				'TOPIC_ID' => $topic_id,

//-- mod : attachment mod ------------------------------------------------------
//-- add
				'TOPIC_ATTACHMENT_IMG' => topic_attachment_image($row['topic_attachment']),
//-- fin mod : attachment mod --------------------------------------------------

				'L_TOPIC_FOLDER_ALT' => $folder_alt)
			);
		}

		$template->assign_vars(array(
			'PAGINATION' => generate_pagination('modcp.'.$phpEx.'?' . POST_FORUM_URL . '=' . $forum_id . '&amp;sid=' . $userdata['session_id'], $forum_topics, $board_config['topics_per_page'], $start),
			'PAGE_NUMBER' => sprintf($lang['Page_of'], ( floor( $start / $board_config['topics_per_page'] ) + 1 ), ceil( $forum_topics / $board_config['topics_per_page'] )), 
			'L_GOTO_PAGE' => $lang['Goto_page'])
		);

		$template->pparse('body');

		break;
}

include($phpbb_root_path . 'includes/page_tail.'.$phpEx);

?>
