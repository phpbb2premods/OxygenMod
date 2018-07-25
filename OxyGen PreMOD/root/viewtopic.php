<?php
/**
*
* @version $Id: viewtopic.php,v 1.186.2.47 2006/12/16 13:11:25 acydburn Exp $
* @copyright (C) 2001 The phpBB Group, support@phpbb.com
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
*
*/

define('IN_PHPBB', true);
$phpbb_root_path = './';
include($phpbb_root_path . 'extension.inc');
include($phpbb_root_path . 'common.'.$phpEx);
include($phpbb_root_path . 'includes/bbcode.'.$phpEx);

//-- mod : post icon -----------------------------------------------------------
//-- add
include($phpbb_root_path . 'includes/def_icons.'. $phpEx);
//-- fin mod : post icon -------------------------------------------------------

//
// Start initial var setup
//
$topic_id = $post_id = 0;
if ( isset($HTTP_GET_VARS[POST_TOPIC_URL]) )
{
	$topic_id = intval($HTTP_GET_VARS[POST_TOPIC_URL]);
}
else if ( isset($HTTP_GET_VARS['topic']) )
{
	$topic_id = intval($HTTP_GET_VARS['topic']);
}

if ( isset($HTTP_GET_VARS[POST_POST_URL]))
{
	$post_id = intval($HTTP_GET_VARS[POST_POST_URL]);
}

$start = isset($HTTP_GET_VARS['start']) ? intval($HTTP_GET_VARS['start']) : 0;
$start = ($start < 0) ? 0 : $start;

//-- mod : keep unread flags ---------------------------------------------------
//-- delete
/*-MOD
if (!$topic_id && !$post_id)
{
	message_die(GENERAL_MESSAGE, 'Topic_post_not_exist');
}

//
// Find topic id if user requested a newer
// or older topic
//
if ( isset($HTTP_GET_VARS['view']) && empty($HTTP_GET_VARS[POST_POST_URL]) )
{
	if ( $HTTP_GET_VARS['view'] == 'newest' )
	{
		if ( isset($HTTP_COOKIE_VARS[$board_config['cookie_name'] . '_sid']) || isset($HTTP_GET_VARS['sid']) )
		{
			$session_id = isset($HTTP_COOKIE_VARS[$board_config['cookie_name'] . '_sid']) ? $HTTP_COOKIE_VARS[$board_config['cookie_name'] . '_sid'] : $HTTP_GET_VARS['sid'];

			if (!preg_match('/^[A-Za-z0-9]*$/', $session_id)) 
			{
				$session_id = '';
			}

			if ( $session_id )
			{
				$sql = "SELECT p.post_id
					FROM " . POSTS_TABLE . " p, " . SESSIONS_TABLE . " s,  " . USERS_TABLE . " u
					WHERE s.session_id = '$session_id'
						AND u.user_id = s.session_user_id
						AND p.topic_id = $topic_id
						AND p.post_time >= u.user_lastvisit
					ORDER BY p.post_time ASC
					LIMIT 1";
				if ( !($result = $db->sql_query($sql)) )
				{
					message_die(GENERAL_ERROR, 'Could not obtain newer/older topic information', '', __LINE__, __FILE__, $sql);
				}

				if ( !($row = $db->sql_fetchrow($result)) )
				{
					message_die(GENERAL_MESSAGE, 'No_new_posts_last_visit');
				}

				$post_id = $row['post_id'];

				if (isset($HTTP_GET_VARS['sid']))
				{
					redirect("viewtopic.$phpEx?sid=$session_id&" . POST_POST_URL . "=$post_id#$post_id");
				}
				else
				{
					redirect("viewtopic.$phpEx?" . POST_POST_URL . "=$post_id#$post_id");
				}
			}
		}

		redirect(append_sid("viewtopic.$phpEx?" . POST_TOPIC_URL . "=$topic_id", true));
	}
MOD-*/
//-- add
$mode = isset($HTTP_GET_VARS['mode']) ? htmlspecialchars( $HTTP_GET_VARS['mode'] ) : '';

if ( !empty($post_id) )
{
	$sql = 'SELECT t.forum_id, t.topic_id, t.topic_last_post_id, p.post_time
		FROM ' . TOPICS_TABLE . ' t, ' . POSTS_TABLE . ' p
		WHERE t.topic_id = p.topic_id AND t.topic_moved_id = 0 AND p.post_id = ' . $post_id;
}
else if ( !empty($topic_id) )
{
	$sql = 'SELECT t.forum_id, t.topic_id, t.topic_last_post_id
		FROM ' . TOPICS_TABLE . ' t
		WHERE t.topic_moved_id = 0 AND t.topic_id = ' . $topic_id;
}
else
{
	message_die(GENERAL_MESSAGE, 'Topic_post_not_exist');
}
if ( !$result = $db->sql_query($sql) )
{
	message_die(GENERAL_ERROR, 'Could not obtain topic information', '', __LINE__, __FILE__, $sql);
}
if ( !$row = $db->sql_fetchrow($result) )
{
	message_die(GENERAL_MESSAGE, 'Topic_post_not_exist');
}
$forum_id = $row['forum_id'];
$topic_id = $row['topic_id'];
$post_time = $row['post_time'];
$topic_last_post_id = $row['topic_last_post_id'];

//-- mod : simple subtemplates -------------------------------------------------
//-- add
setup_forum_style($forum_id);
//-- fin mod : simple subtemplates ---------------------------------------------

//
// Start session management
//
$userdata = session_pagestart($user_ip, $forum_id);
init_userprefs($userdata);
//
// End session management
//

//-- mod : jail mod ------------------------------------------------------------
//-- add
if ( $userdata['user_cell_time'] > 0 && !defined('CELL') && $userdata['session_logged_in'] && $userdata['user_level'] != ADMIN && $userdata['user_cell_punishment'] == 3 )
{
	redirect(append_sid('cell.'.$phpEx, true));
}
//-- fin mod : jail mod --------------------------------------------------------

if ($mode == 'unread')
{
	$board_config['tracking_unreads'][$topic_id] = $post_time-1;
	write_cookies($userdata);
	$message = $lang['keep_unread_done'] . '<br /><br />' .
	sprintf($lang['Click_return_forum'], '<a href="' . append_sid('viewforum.' . $phpEx . '?' . POST_FORUM_URL . '=' . $forum_id) . '">', '</a> ') . '<br /><br />' .
	sprintf($lang['Click_return_index'], '<a href="' . append_sid('index.' . $phpEx) . '">', '</a> ');
	message_die(GENERAL_MESSAGE, $message);
}
$topic_last_read = topic_last_read($forum_id, $topic_id);

//
// Find topic id if user requested a newer
// or older topic
//
if ( isset($HTTP_GET_VARS['view']) && empty($HTTP_GET_VARS[POST_POST_URL]) )
{
	if ( $HTTP_GET_VARS['view'] == 'newest' )
	{
		$sql = 'SELECT p.post_id, t.topic_last_post_id
			FROM (' . TOPICS_TABLE . ' t
				LEFT JOIN ' . POSTS_TABLE . ' p ON p.topic_id = t.topic_id AND p.post_time > ' . $topic_last_read . ')
			WHERE t.topic_id = ' . $topic_id . ' AND t.topic_moved_id = 0
			ORDER BY p.post_time';
		if ( !$result = $db->sql_query($sql) )
		{
			message_die(GENERAL_ERROR, 'Could not obtain newer/older topic information', '', __LINE__, __FILE__, $sql);
		}

		if ( !$row = $db->sql_fetchrow($result) )
		{
			message_die(GENERAL_MESSAGE, 'No_new_posts_last_visit');
		}
		$post_id = empty($row['post_id']) ? $row['topic_last_post_id'] : $row['post_id'];
		redirect(append_sid('./viewtopic.' . $phpEx . '?' . POST_POST_URL . '=' . $post_id . '#' . $post_id, true));
	}
//-- fin mod : keep unread flags -----------------------------------------------
	else if ( $HTTP_GET_VARS['view'] == 'next' || $HTTP_GET_VARS['view'] == 'previous' )
	{
		$sql_condition = ( $HTTP_GET_VARS['view'] == 'next' ) ? '>' : '<';
		$sql_ordering = ( $HTTP_GET_VARS['view'] == 'next' ) ? 'ASC' : 'DESC';

		$sql = 'SELECT t.topic_id
			FROM ' . TOPICS_TABLE . ' t, ' . TOPICS_TABLE . ' t2
			WHERE t2.topic_id = ' . $topic_id . ' AND t.forum_id = t2.forum_id AND t.topic_moved_id = 0 AND t.topic_last_post_id
			' . $sql_condition . ' t2.topic_last_post_id
			ORDER BY t.topic_last_post_id ' . $sql_ordering . '
			LIMIT 1';
		if ( !$result = $db->sql_query($sql) )
		{
			message_die(GENERAL_ERROR, 'Could not obtain newer/older topic information', '', __LINE__, __FILE__, $sql);
		}

		if ( $row = $db->sql_fetchrow($result) )
		{
			$topic_id = intval($row['topic_id']);
//-- mod : keep unread flags ---------------------------------------------------
//-- add
			redirect(append_sid('viewtopic.' . $phpEx . '?' . POST_TOPIC_URL . '=' . $topic_id, true));
//-- fin mod : keep unread flags -----------------------------------------------
		}
		else
		{
			$message = ( $HTTP_GET_VARS['view'] == 'next' ) ? 'No_newer_topics' : 'No_older_topics';
			message_die(GENERAL_MESSAGE, $message);
		}
	}
}

//
// This rather complex gaggle of code handles querying for topics but
// also allows for direct linking to a post (and the calculation of which
// page the post is on and the correct display of viewtopic)
//
$join_sql_table = !$post_id ? '' : ', ' . POSTS_TABLE . ' p, ' . POSTS_TABLE . ' p2 ';
$join_sql = !$post_id ? 't.topic_id = ' . $topic_id : 'p.post_id = ' . $post_id . ' AND t.topic_id = p.topic_id AND p2.topic_id = p.topic_id AND p2.post_id <= ' . $post_id;
$count_sql = !$post_id ? '' : ', COUNT(p2.post_id) AS prev_posts';

$order_sql = !$post_id ? '' : 'GROUP BY p.post_id, t.topic_id, t.topic_title, t.topic_status, t.topic_replies, t.topic_time, t.topic_type, t.topic_vote, t.topic_last_post_id, f.forum_name, f.forum_status, f.forum_id, f.auth_view, f.auth_read, f.auth_post, f.auth_reply, f.auth_edit, f.auth_delete, f.auth_sticky, f.auth_announce, f.auth_pollcreate, f.auth_vote, f.auth_attachments ORDER BY p.post_id ASC';

$sql = 'SELECT t.topic_id, t.topic_title, t.topic_status, t.topic_replies, t.topic_time, t.topic_type, t.topic_vote, t.topic_last_post_id, f.forum_name, f.forum_status, f.forum_id, f.auth_view, f.auth_read, f.auth_post, f.auth_reply, f.auth_edit, f.auth_delete, f.auth_sticky, f.auth_announce, f.auth_pollcreate, f.auth_vote, f.auth_attachments' . $count_sql . '
	FROM ' . TOPICS_TABLE . ' t, ' . FORUMS_TABLE . ' f' . $join_sql_table . '
	WHERE ' . $join_sql . '
		AND f.forum_id = t.forum_id
		' . $order_sql;
//-- mod : bump topic ----------------------------------------------------------
//-- add
$sql = str_replace('SELECT ', 'SELECT t.topic_poster, t.topic_last_post_time, t.topic_bumped, t.topic_bumper, ', $sql);
$sql = str_replace(', f.auth_edit', ', f.auth_edit, f.auth_bump', $sql);
$order_sql = !$post_id ? '' : str_replace(', f.auth_edit', ', f.auth_edit, f.auth_bump', $order_sql);
//-- fin mod : bump topic ------------------------------------------------------

//-- mod : oxygen premod -------------------------------------------------------
//-- add
$sql = str_replace(', f.forum_id', ', f.forum_id, f.disable_word_censor, f.forum_password, f.forum_qpes, f.cat_id', $sql);
$sql = str_replace(', t.topic_id', ', t.topic_id, t.topic_attribute, t.topic_attribute_color, t.topic_attribute_position, t.topic_attribute_username, t.topic_attribute_date', $sql);
//-- fin mod : oxygen premod ---------------------------------------------------

//-- mod : attachment mod ------------------------------------------------------
//-- add
attach_setup_viewtopic_auth($order_sql, $sql);
//-- fin mod : attachment mod --------------------------------------------------

if ( !$result = $db->sql_query($sql) )
{
	message_die(GENERAL_ERROR, 'Could not obtain topic information', '', __LINE__, __FILE__, $sql);
}

if ( !$forum_topic_data = $db->sql_fetchrow($result) )
{
	message_die(GENERAL_MESSAGE, 'Topic_post_not_exist');
}

$forum_id = intval($forum_topic_data['forum_id']);

//-- mod : smiley categories ---------------------------------------------------
//-- add
$forum_cat_id = intval($forum_topic_data['cat_id']);
//-- fin mod : smiley categories -----------------------------------------------

//-- mod : keep unread flags ---------------------------------------------------
//-- delete
/*-MOD
//
// Start session management
//
$userdata = session_pagestart($user_ip, $forum_id);
init_userprefs($userdata);
//
// End session management
//
MOD-*/
//-- fin mod : keep unread flags -----------------------------------------------

//
// Start auth check
//
$is_auth = array();
$is_auth = auth(AUTH_ALL, $forum_id, $userdata, $forum_topic_data);

if( !$is_auth['auth_view'] || !$is_auth['auth_read'] )
{
	if ( !$userdata['session_logged_in'] )
	{
		$redirect = ($post_id) ? POST_POST_URL . '=' . $post_id : POST_TOPIC_URL . '=' . $topic_id;
		$redirect .= ($start) ? '&start=' . $start : '';
		redirect(append_sid('login.' . $phpEx . '?redirect=viewtopic.' . $phpEx . '&' . $redirect, true));
	}

	$message = ( !$is_auth['auth_view'] ) ? $lang['Topic_post_not_exist'] : sprintf($lang['Sorry_auth_read'], $is_auth['auth_read_type']);

	message_die(GENERAL_MESSAGE, $message);
}
//
// End auth check
//

$forum_name = $forum_topic_data['forum_name'];
$topic_title = $forum_topic_data['topic_title'];

//-- mod : quick title edition -------------------------------------------------
//-- add
colorize_title($topic_title, $forum_topic_data['topic_attribute'], $forum_topic_data['topic_attribute_position'], $forum_topic_data['topic_attribute_color'], $forum_topic_data['topic_attribute_username'], $forum_topic_data['topic_attribute_date']);
//-- fin mod : quick title edition ---------------------------------------------

$topic_id = intval($forum_topic_data['topic_id']);
$topic_time = $forum_topic_data['topic_time'];

//-- mod : password protected forums -------------------------------------------
//-- add
if( !$is_auth['auth_mod'] && $userdata['user_level'] != ADMIN )
{
	$redirect = str_replace("&amp;", "&", preg_replace('#.*?([a-z]+?\.' . $phpEx . '.*?)$#i', '\1', htmlspecialchars($HTTP_SERVER_VARS['REQUEST_URI'])));

	if( $HTTP_POST_VARS['cancel'] )
	{
		redirect(append_sid('index.'.$phpEx));
	}
	else if( $HTTP_POST_VARS['pass_login'] )
	{
		if( $forum_topic_data['topic_password'] != '' )
		{
			password_check('topic', $topic_id, $HTTP_POST_VARS['password'], $redirect);
		}
		else if( $forum_topic_data['forum_password'] != '' )
		{
			password_check('forum', $forum_id, $HTTP_POST_VARS['password'], $redirect);
		}
	}

	if( $forum_topic_data['topic_password'] != '' )
	{
		$passdata = ( isset($HTTP_COOKIE_VARS[$board_config['cookie_name'] . '_tpass']) ) ? unserialize(stripslashes($HTTP_COOKIE_VARS[$board_config['cookie_name'] . '_tpass'])) : '';
		if( $passdata[$topic_id] != md5($forum_topic_data['topic_password']) )
		{
			password_box('topic', $redirect);
		}
	}
	else if( $forum_topic_data['forum_password'] != '' )
	{
		$passdata = isset($HTTP_COOKIE_VARS[$board_config['cookie_name'] . '_fpass']) ? unserialize(stripslashes($HTTP_COOKIE_VARS[$board_config['cookie_name'] . '_fpass'])) : '';
		if( $passdata[$forum_id] != md5($forum_topic_data['forum_password']) )
		{
			password_box('forum', $redirect);
		}
	}
}
//-- fin mod : password protected forums ---------------------------------------

if ($post_id)
{
	$start = floor(($forum_topic_data['prev_posts'] - 1) / intval($board_config['posts_per_page'])) * intval($board_config['posts_per_page']);
}

//
// Is user watching this thread?
//
if( $userdata['session_logged_in'] )
{
	$can_watch_topic = TRUE;

	$sql = 'SELECT notify_status
		FROM ' . TOPICS_WATCH_TABLE . '
		WHERE topic_id = ' . $topic_id . '
			AND user_id = ' . $userdata['user_id'];
	if ( !$result = $db->sql_query($sql) )
	{
		message_die(GENERAL_ERROR, 'Could not obtain topic watch information', '', __LINE__, __FILE__, $sql);
	}

	if ( $row = $db->sql_fetchrow($result) )
	{
		if ( isset($HTTP_GET_VARS['unwatch']) )
		{
			if ( $HTTP_GET_VARS['unwatch'] == 'topic' )
			{
				$is_watching_topic = 0;

				$sql_priority = (SQL_LAYER == "mysql") ? "LOW_PRIORITY" : '';
				$sql = 'DELETE ' . $sql_priority . ' FROM ' . TOPICS_WATCH_TABLE . '
					WHERE topic_id = ' . $topic_id . '
						AND user_id = ' . $userdata['user_id'];
				if ( !$result = $db->sql_query($sql) )
				{
					message_die(GENERAL_ERROR, 'Could not delete topic watch information', '', __LINE__, __FILE__, $sql);
				}
			}

			$template->assign_vars(array(
				'META' => '<meta http-equiv="refresh" content="3;url=' . append_sid('viewtopic.' . $phpEx . '?' . POST_TOPIC_URL . '=' . $topic_id . '&amp;start=' . $start) . '">')
			);

			$message = $lang['No_longer_watching'] . '<br /><br />' . sprintf($lang['Click_return_topic'], '<a href="' . append_sid('viewtopic.' . $phpEx . '?' . POST_TOPIC_URL . '=' . $topic_id . '&amp;start=' . $start) . '">', '</a>');
			message_die(GENERAL_MESSAGE, $message);
		}
		else
		{
			$is_watching_topic = TRUE;

			if ( $row['notify_status'] )
			{
				$sql_priority = (SQL_LAYER == "mysql") ? "LOW_PRIORITY" : '';
				$sql = 'UPDATE ' . $sql_priority . ' ' . TOPICS_WATCH_TABLE . '
					SET notify_status = 0
					WHERE topic_id = ' . $topic_id . '
						AND user_id = ' . $userdata['user_id'];
				if ( !$result = $db->sql_query($sql) )
				{
					message_die(GENERAL_ERROR, 'Could not update topic watch information', '', __LINE__, __FILE__, $sql);
				}
			}
		}
	}
	else
	{
		if ( isset($HTTP_GET_VARS['watch']) )
		{
			if ( $HTTP_GET_VARS['watch'] == 'topic' )
			{
				$is_watching_topic = TRUE;

				$sql_priority = (SQL_LAYER == "mysql") ? "LOW_PRIORITY" : '';
				$sql = 'INSERT ' . $sql_priority . ' INTO ' . TOPICS_WATCH_TABLE . ' (user_id, topic_id, notify_status)
					VALUES (' . $userdata['user_id'] . ', ' . $topic_id . ', 0)';
				if ( !$result = $db->sql_query($sql) )
				{
					message_die(GENERAL_ERROR, 'Could not insert topic watch information', '', __LINE__, __FILE__, $sql);
				}
			}

			$template->assign_vars(array(
				'META' => '<meta http-equiv="refresh" content="3;url=' . append_sid('viewtopic.' . $phpEx . '?' . POST_TOPIC_URL . '=' . $topic_id . '&amp;start=' . $start) . '">')
			);

			$message = $lang['You_are_watching'] . '<br /><br />' . sprintf($lang['Click_return_topic'], '<a href="' . append_sid('viewtopic.' . $phpEx . '?' . POST_TOPIC_URL . '=' . $topic_id . '&amp;start=' . $start) . '">', '</a>');
			message_die(GENERAL_MESSAGE, $message);
		}
		else
		{
			$is_watching_topic = 0;
		}
	}
}
else
{
	if ( isset($HTTP_GET_VARS['unwatch']) )
	{
		if ( $HTTP_GET_VARS['unwatch'] == 'topic' )
		{
			redirect(append_sid('login.' . $phpEx . '?redirect=viewtopic.' . $phpEx . '&' . POST_TOPIC_URL . '=' . $topic_id . '&unwatch=topic', true));
		}
	}
	else
	{
		$can_watch_topic = 0;
		$is_watching_topic = 0;
	}
}

//
// Generate a 'Show posts in previous x days' select box. If the postdays var is POSTed
// then get it's value, find the number of topics with dates newer than it (to properly
// handle pagination) and alter the main query
//
$previous_days = array(0, 1, 7, 14, 30, 90, 180, 364);
$previous_days_text = array($lang['All_Posts'], $lang['1_Day'], $lang['7_Days'], $lang['2_Weeks'], $lang['1_Month'], $lang['3_Months'], $lang['6_Months'], $lang['1_Year']);

if( !empty($HTTP_POST_VARS['postdays']) || !empty($HTTP_GET_VARS['postdays']) )
{
	$post_days = ( !empty($HTTP_POST_VARS['postdays']) ) ? intval($HTTP_POST_VARS['postdays']) : intval($HTTP_GET_VARS['postdays']);
	$min_post_time = time() - (intval($post_days) * 86400);

	$sql = 'SELECT COUNT(p.post_id) AS num_posts
		FROM ' . TOPICS_TABLE . ' t, ' . POSTS_TABLE . ' p
		WHERE t.topic_id = ' . $topic_id . '
			AND p.topic_id = t.topic_id
			AND p.post_time >= ' . $min_post_time;
	if ( !$result = $db->sql_query($sql) )
	{
		message_die(GENERAL_ERROR, 'Could not obtain limited topics count information', '', __LINE__, __FILE__, $sql);
	}

	$total_replies = ( $row = $db->sql_fetchrow($result) ) ? intval($row['num_posts']) : 0;

	$limit_posts_time = 'AND p.post_time >= ' . $min_post_time;

	if ( !empty($HTTP_POST_VARS['postdays']))
	{
		$start = 0;
	}
}
else
{
	$total_replies = intval($forum_topic_data['topic_replies']) + 1;

	$limit_posts_time = '';
	$post_days = 0;
}

$select_post_days = '<select name="postdays">';
for($i = 0; $i < count($previous_days); $i++)
{
	$selected = ($post_days == $previous_days[$i]) ? ' selected="selected"' : '';
	$select_post_days .= '<option value="' . $previous_days[$i] . '"' . $selected . '>' . $previous_days_text[$i] . '</option>';
}
$select_post_days .= '</select>';

//
// Decide how to order the post display
//
if ( !empty($HTTP_POST_VARS['postorder']) || !empty($HTTP_GET_VARS['postorder']) )
{
	$post_order = (!empty($HTTP_POST_VARS['postorder'])) ? htmlspecialchars($HTTP_POST_VARS['postorder']) : htmlspecialchars($HTTP_GET_VARS['postorder']);
	$post_time_order = ($post_order == 'asc') ? 'ASC' : 'DESC';
}
else
{
	$post_order = 'asc';
	$post_time_order = 'ASC';
}

$select_post_order = '<select name="postorder">';
if ( $post_time_order == 'ASC' )
{
	$select_post_order .= '<option value="asc" selected="selected">' . $lang['Oldest_First'] . '</option><option value="desc">' . $lang['Newest_First'] . '</option>';
}
else
{
	$select_post_order .= '<option value="asc">' . $lang['Oldest_First'] . '</option><option value="desc" selected="selected">' . $lang['Newest_First'] . '</option>';
}
$select_post_order .= '</select>';

//
// Go ahead and pull all data for this topic
//
$sql = 'SELECT u.username, u.user_id, u.user_posts, u.user_from, u.user_website, u.user_email, u.user_icq, u.user_aim, u.user_yim, u.user_regdate, u.user_msnm, u.user_viewemail, u.user_rank, u.user_sig, u.user_sig_bbcode_uid, u.user_avatar, u.user_avatar_type, u.user_allowavatar, u.user_allowsmile, p.*,  pt.post_text, pt.post_subject, pt.bbcode_uid
	FROM ' . POSTS_TABLE . ' p, ' . USERS_TABLE . ' u, ' . POSTS_TEXT_TABLE . ' pt
	WHERE p.topic_id = ' . $topic_id . '
		' . $limit_posts_time . '
		AND pt.post_id = p.post_id
		AND u.user_id = p.poster_id
	ORDER BY p.post_time ' . $post_time_order . '
	LIMIT ' . $start . ', ' . $board_config['posts_per_page'];
//-- mod : quick title edition -------------------------------------------------
//-- add
$sql = str_replace('pt.bbcode_uid', 'pt.bbcode_uid, t.topic_poster', $sql);
$sql = str_replace(POSTS_TEXT_TABLE . ' pt', POSTS_TEXT_TABLE . ' pt, ' . TOPICS_TABLE . ' t', $sql);
$sql = str_replace('WHERE p.topic_id = ' . $topic_id, 'WHERE p.topic_id = ' . $topic_id . ' AND t.topic_id = p.topic_id', $sql);
//-- fin mod : quick title edition ---------------------------------------------

//-- mod : oxygen premod -------------------------------------------------------
//-- add
$sql = str_replace('SELECT ', 'SELECT u.user_level, u.user_color, u.user_group_id, u.user_skype, u.user_cf_iso3661_1, u.user_birthday, u.user_points, u.user_cell_time, u.user_cell_celleds, u.user_allow_viewonline, u.user_session_time, u.user_gender, u.user_topics, u.user_warn, u.user_level, ', $sql);
$sql = str_replace(', pt.post_subject', ', pt.post_subject, pt.post_sub_title', $sql);
//-- fin mod : oxygen premod ---------------------------------------------------

if ( !$result = $db->sql_query($sql) )
{
	message_die(GENERAL_ERROR, 'Could not obtain post/user information.', '', __LINE__, __FILE__, $sql);
}

$postrow = array();
if ($row = $db->sql_fetchrow($result))
{
	do
	{
		$postrow[] = $row;
	}
	while ($row = $db->sql_fetchrow($result));
	$db->sql_freeresult($result);

	$total_posts = count($postrow);
}
else 
{ 
   include($phpbb_root_path . 'includes/functions_admin.' . $phpEx); 
   sync('topic', $topic_id); 

   message_die(GENERAL_MESSAGE, $lang['No_posts_topic']); 
} 

$resync = FALSE; 
if ($forum_topic_data['topic_replies'] + 1 < $start + count($postrow)) 
{ 
   $resync = TRUE; 
} 
elseif ($start + $board_config['posts_per_page'] > $forum_topic_data['topic_replies']) 
{ 
   $row_id = intval($forum_topic_data['topic_replies']) % intval($board_config['posts_per_page']); 
   if ($postrow[$row_id]['post_id'] != $forum_topic_data['topic_last_post_id'] || $start + count($postrow) < $forum_topic_data['topic_replies']) 
   { 
      $resync = TRUE; 
   } 
} 
elseif (count($postrow) < $board_config['posts_per_page']) 
{ 
   $resync = TRUE; 
} 

if ($resync) 
{ 
   include($phpbb_root_path . 'includes/functions_admin.' . $phpEx); 
   sync('topic', $topic_id); 

   $result = $db->sql_query('SELECT COUNT(post_id) AS total FROM ' . POSTS_TABLE . ' WHERE topic_id = ' . $topic_id); 
   $row = $db->sql_fetchrow($result); 
   $total_replies = $row['total']; 
}

$sql = 'SELECT * FROM ' . RANKS_TABLE . ' ORDER BY rank_special, rank_min';
if ( !$result = $db->sql_query($sql) )
{
	message_die(GENERAL_ERROR, 'Could not obtain ranks information.', '', __LINE__, __FILE__, $sql);
}

$ranksrow = array();
while ( $row = $db->sql_fetchrow($result) )
{
	$ranksrow[] = $row;
}
$db->sql_freeresult($result);

//
// Define censored word matches
//
$orig_word = array();
$replacement_word = array();
obtain_word_list($orig_word, $replacement_word);

//
// Censor topic title
//
//-- mod : disable word censor for single forums -------------------------------
//-- delete
/*-MOD
if ( count($orig_word) )
MOD-*/
//-- add
if ( count($orig_word) && (!$forum_topic_data['disable_word_censor']) )
//-- fin mod : disable word censor for single forums ---------------------------
{
	$topic_title = preg_replace($orig_word, $replacement_word, $topic_title);
}

//
// Was a highlight request part of the URI?
//
$highlight_match = $highlight = '';
if (isset($HTTP_GET_VARS['highlight']))
{
	// Split words and phrases
	$words = explode(' ', trim(htmlspecialchars($HTTP_GET_VARS['highlight'])));

	for($i = 0; $i < sizeof($words); $i++)
	{
		if (trim($words[$i]) != '')
		{
			$highlight_match .= (($highlight_match != '') ? '|' : '') . str_replace('*', '\w*', preg_quote($words[$i], '#'));
		}
	}
	unset($words);

	$highlight = urlencode($HTTP_GET_VARS['highlight']);
	$highlight_match = phpbb_rtrim($highlight_match, '\\');
}

//
// Post, reply and other URL generation for
// templating vars
//
$new_topic_url = append_sid('posting.' . $phpEx . '?mode=newtopic&amp;' . POST_FORUM_URL . '=' . $forum_id);
$reply_topic_url = append_sid('posting.' . $phpEx . '?mode=reply&amp;' . POST_TOPIC_URL . '=' . $topic_id);
$view_forum_url = append_sid('viewforum.' . $phpEx . '?' . POST_FORUM_URL . '=' . $forum_id);
$view_prev_topic_url = append_sid('viewtopic.' . $phpEx . '?' . POST_TOPIC_URL . '=' . $topic_id . '&amp;view=previous');
$view_next_topic_url = append_sid('viewtopic.' . $phpEx . '?' . POST_TOPIC_URL . '=' . $topic_id . '&amp;view=next');

//
// Mozilla navigation bar
//
$nav_links['prev'] = array(
	'url' => $view_prev_topic_url,
	'title' => $lang['View_previous_topic']
);
$nav_links['next'] = array(
	'url' => $view_next_topic_url,
	'title' => $lang['View_next_topic']
);
$nav_links['up'] = array(
	'url' => $view_forum_url,
	'title' => $forum_name
);

$reply_img = ( $forum_topic_data['forum_status'] == FORUM_LOCKED || $forum_topic_data['topic_status'] == TOPIC_LOCKED ) ? $images['reply_locked'] : $images['reply_new'];
$reply_alt = ( $forum_topic_data['forum_status'] == FORUM_LOCKED || $forum_topic_data['topic_status'] == TOPIC_LOCKED ) ? $lang['Topic_locked'] : $lang['Reply_to_topic'];
$post_img = ( $forum_topic_data['forum_status'] == FORUM_LOCKED ) ? $images['post_locked'] : $images['post_new'];
$post_alt = ( $forum_topic_data['forum_status'] == FORUM_LOCKED ) ? $lang['Forum_locked'] : $lang['Post_new_topic'];

//
// Set a cookie for this topic
//
//-- mod : keep unread flags ---------------------------------------------------
//-- delete
/*-MOD
if ( $userdata['session_logged_in'] )
{
	$tracking_topics = ( isset($HTTP_COOKIE_VARS[$board_config['cookie_name'] . '_t']) ) ? unserialize($HTTP_COOKIE_VARS[$board_config['cookie_name'] . '_t']) : array();
	$tracking_forums = ( isset($HTTP_COOKIE_VARS[$board_config['cookie_name'] . '_f']) ) ? unserialize($HTTP_COOKIE_VARS[$board_config['cookie_name'] . '_f']) : array();

	if ( !empty($tracking_topics[$topic_id]) && !empty($tracking_forums[$forum_id]) )
	{
		$topic_last_read = ( $tracking_topics[$topic_id] > $tracking_forums[$forum_id] ) ? $tracking_topics[$topic_id] : $tracking_forums[$forum_id];
	}
	else if ( !empty($tracking_topics[$topic_id]) || !empty($tracking_forums[$forum_id]) )
	{
		$topic_last_read = ( !empty($tracking_topics[$topic_id]) ) ? $tracking_topics[$topic_id] : $tracking_forums[$forum_id];
	}
	else
	{
		$topic_last_read = $userdata['user_lastvisit'];
	}

	if ( count($tracking_topics) >= 150 && empty($tracking_topics[$topic_id]) )
	{
		asort($tracking_topics);
		unset($tracking_topics[key($tracking_topics)]);
	}

	$tracking_topics[$topic_id] = time();

	setcookie($board_config['cookie_name'] . '_t', serialize($tracking_topics), 0, $board_config['cookie_path'], $board_config['cookie_domain'], $board_config['cookie_secure']);
}
MOD-*/
//-- add 
$lastpost = $postrow[0]['post_time'] < $postrow[($total_posts-1)]['post_time'] ? $total_posts-1 : 0;
if ($topic_last_post_id == $postrow[$lastpost]['post_id']) 
{
	$board_config['tracking_unreads'][$topic_id] = time();
}
elseif (isset($board_config['tracking_unreads'][$topic_id]))
{
	$board_config['tracking_unreads'][$topic_id] = max($topic_last_read, $postrow[$lastpost]['post_time']);  
}
write_cookies($userdata);
//-- fin mod : keep unread flags -----------------------------------------------

//
// Load templates
//
$template->set_filenames(array('body' => 'viewtopic_body.tpl'));
//-- mod : simple subforums ----------------------------------------------------
//-- delete
/*-MOD
make_jumpbox('viewforum.'.$phpEx, $forum_id);
MOD-*/
//-- add
$all_forums = array();
make_jumpbox_ref('viewforum.' . $phpEx, $forum_id, $all_forums);

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
	for( $i = 0; $i < count($all_forums); $i++ )
	{
		if( $all_forums[$i]['forum_id'] == $parent_id )
		{
			$template->assign_vars(array(
				'PARENT_FORUM' => 1,
				'U_VIEW_PARENT_FORUM'	=> append_sid('viewforum.' . $phpEx . '?' . POST_FORUM_URL . '=' . $all_forums[$i]['forum_id']),
				'PARENT_FORUM_NAME'		=> $all_forums[$i]['forum_name'],
			));
		}
	}
}
//-- fin mod : simple subforums ------------------------------------------------

//
// Output page header
//
//-- mod : quick title edition -------------------------------------------------
//-- delete
/*-MOD
$page_title = $lang['View_topic'] .' - ' . $topic_title;
MOD-*/
//-- add
$page_title = $lang['View_topic'] . ' - ' . $forum_topic_data['topic_title'];
//-- fin mod : quick title edition ---------------------------------------------

include($phpbb_root_path . 'includes/page_header.'.$phpEx);

//-- mod : quick post es -------------------------------------------------------
//-- add
$forum_qpes = intval($forum_topic_data['forum_qpes']);
if (!empty($forum_qpes))
{
	include($phpbb_root_path . 'qpes.' . $phpEx);
}
//-- fin mod : quick post es ---------------------------------------------------

//-- mod : toolbar -------------------------------------------------------------
//-- add
if ( $can_watch_topic )
{
	$uw_parm = $is_watching_topic ? 'unwatch' : 'watch';
	$tlbr_more = array(
		'watch' => array('link_pgm' => 'viewtopic', 'link_parms' => array(POST_TOPIC_URL => intval($topic_id), $uw_parm => 'topic', 'start' => intval($start)), 'txt' => $is_watching_topic ? 'Stop_watching_topic' : 'Start_watching_topic', 'img' => $is_watching_topic ? 'tlbr_un_watch' : 'tlbr_watch'),
	);
}
build_toolbar('viewtopic', $l_privmsgs_text, $s_privmsg_new, $forum_id, $tlbr_more);
//-- fin mod : toolbar ---------------------------------------------------------

//
// User authorisation levels output
//
$s_auth_can = ( ( $is_auth['auth_post'] ) ? $lang['Rules_post_can'] : $lang['Rules_post_cannot'] ) . '<br />';
$s_auth_can .= ( ( $is_auth['auth_reply'] ) ? $lang['Rules_reply_can'] : $lang['Rules_reply_cannot'] ) . '<br />';
$s_auth_can .= ( ( $is_auth['auth_edit'] ) ? $lang['Rules_edit_can'] : $lang['Rules_edit_cannot'] ) . '<br />';
$s_auth_can .= ( ( $is_auth['auth_delete'] ) ? $lang['Rules_delete_can'] : $lang['Rules_delete_cannot'] ) . '<br />';
$s_auth_can .= ( ( $is_auth['auth_vote'] ) ? $lang['Rules_vote_can'] : $lang['Rules_vote_cannot'] ) . '<br />';

//-- mod : bump topic ----------------------------------------------------------
//-- add
$s_auth_can .= ( $is_auth['auth_bump'] ? $lang['rules_bump_can'] : $lang['rules_bump_cannot'] ) . '<br />';
//-- fin mod : bump topic ------------------------------------------------------

//-- mod : attachment mod ------------------------------------------------------
//-- add
attach_build_auth_levels($is_auth, $s_auth_can);
//-- fin mod : attachment mod --------------------------------------------------

$topic_mod = '';

if ( $is_auth['auth_mod'] )
{
	$s_auth_can .= sprintf($lang['Rules_moderate'], '<a href="modcp.' . $phpEx . '?' . POST_FORUM_URL . '=' . $forum_id . '&amp;sid=' . $userdata['session_id'] . '">', '</a>');

	$topic_mod .= '<a href="modcp.' . $phpEx . '?' . POST_TOPIC_URL . '=' . $topic_id . '&amp;mode=delete&amp;sid=' . $userdata['session_id'] . '"><img src="' . $images['topic_mod_delete'] . '" alt="' . $lang['Delete_topic'] . '" title="' . $lang['Delete_topic'] . '" border="0" /></a>&nbsp;';

	$topic_mod .= '<a href="modcp.' . $phpEx . '?' . POST_TOPIC_URL . '=' . $topic_id . '&amp;mode=move&amp;sid=' . $userdata['session_id'] . '"><img src="' . $images['topic_mod_move'] . '" alt="' . $lang['Move_topic'] . '" title="' . $lang['Move_topic'] . '" border="0" /></a>&nbsp;';

	$topic_mod .= ($forum_topic_data['topic_status'] == TOPIC_UNLOCKED) ? '<a href="modcp.' . $phpEx . '?' . POST_TOPIC_URL . '=' . $topic_id . '&amp;mode=lock&amp;sid=' . $userdata['session_id'] . '"><img src="' . $images['topic_mod_lock'] . '" alt="' . $lang['Lock_topic'] . '" title="' . $lang['Lock_topic'] . '" border="0" /></a>&nbsp;' : "<a href=\"modcp.$phpEx?" . POST_TOPIC_URL . "=$topic_id&amp;mode=unlock&amp;sid=" . $userdata['session_id'] . '"><img src="' . $images['topic_mod_unlock'] . '" alt="' . $lang['Unlock_topic'] . '" title="' . $lang['Unlock_topic'] . '" border="0" /></a>&nbsp;';

	$topic_mod .= '<a href="modcp.' . $phpEx . '?' . POST_TOPIC_URL . '=' . $topic_id . '&amp;mode=split&amp;sid=' . $userdata['session_id'] . '"><img src="' . $images['topic_mod_split'] . '" alt="' . $lang['Split_topic'] . '" title="' . $lang['Split_topic'] . '" border="0" /></a>&nbsp;';

//-- mod : modcp merge hack ----------------------------------------------------
//-- add
	$topic_mod .= '<a href="modcp.' . $phpEx . '?' . POST_TOPIC_URL . '=' . $topic_id . '&amp;mode=merge&amp;sid=' . $userdata['session_id'] . '"><img src="' . $images['topic_mod_merge'] . '" alt="' . $lang['Merge_topic'] . '" title="' . $lang['Merge_topic'] . '" border="0" /></a>&nbsp;';
//-- fin mod : modcp merge hack ------------------------------------------------

//-- mod : recycle bin hack ----------------------------------------------------
//-- add
	$topic_mod .= '<a href="bin.' . $phpEx . '?' . POST_TOPIC_URL . '=' . $topic_id . '&amp;sid=' . $userdata['session_id'] . '"><img src="' . $images['topic_mod_bin'] . '" alt="' . $lang['Move_bin'] . '" title="' . $lang['Move_bin'] . '" border="0" /></a>&nbsp;';
//-- fin mod : recycle bin hack ------------------------------------------------
}

//-- mod : quick title edition -------------------------------------------------
//-- add
if ($userdata['session_logged_in'] && ($userdata['user_level'] == ADMIN || $userdata['user_level'] == MOD || $userdata['user_id'] == $postrow[$row_id]['topic_poster']))
{
	$sql = 'SELECT * FROM ' . ATTRIBUTES_TABLE . ' ORDER BY attribute_order ASC';
	if ( !$result = $db->sql_query($sql))
	{
		message_die(GENERAL_MESSAGE, 'Could not query attributes table');
	}

	$select_title = '<form action="modcp.' . $phpEx . '?sid=' . $userdata['session_id'] . '" method="POST"><select name="qtnum"><option value="-1" style="font-weight: bold;">' . $lang['No_Attribute'] . '</option>';
	while ( $row = $db->sql_fetchrow($result) )
	{
		if (($row['attribute_author'] && $userdata['user_level'] == USER) || ($row['attribute_moderator'] && $userdata['user_level'] == MOD) || ($row['attribute_administrator'] && $userdata['user_level'] == ADMIN))
		{
			$attribute = isset($lang[$row['attribute']]) ? $lang[$row['attribute']] : $row['attribute'];
			$attribute = str_replace('%mod%', addslashes($userdata['username']), $attribute);
			$date = (!empty($row['attribute_date_format'])) ? create_date($row['attribute_date_format'], time(), $board_config['board_timezone']) : '';
			$attribute = str_replace('%date%', $date, $attribute);
			$select_title .= '<option value="' . $row['attribute_id'] . '" style="font-weight: bold; color:#' . $row['attribute_color'] . '">' . $attribute . '</option>';
		}
	}
	$select_title .= '</select>&nbsp;
		<input type="submit" name="quick_title_edit" class="liteoption" value="' . $lang['Attribute_apply'] . '"/>
		<input type="hidden" name="' . POST_TOPIC_URL . '" value="' . $topic_id . '"/>
		</form>';
}
//-- fin mod : quick title edition ---------------------------------------------

//
// Topic watch information
//
$s_watching_topic = '';
if ( $can_watch_topic )
{
	if ( $is_watching_topic )
	{
		$s_watching_topic = '<a href="viewtopic.' . $phpEx . '?' . POST_TOPIC_URL . '=' . $topic_id . '&amp;unwatch=topic&amp;start=' . $start . '&amp;sid=' . $userdata['session_id'] . '">' . $lang['Stop_watching_topic'] . '</a>';
		$s_watching_topic_img = ( isset($images['topic_un_watch']) ) ? '<a href="viewtopic.' . $phpEx . '?' . POST_TOPIC_URL . '=' . $topic_id . '&amp;unwatch=topic&amp;start=' . $start . '&amp;sid=' . $userdata['session_id'] . '"><img src="' . $images['topic_un_watch'] . '" alt="' . $lang['Stop_watching_topic'] . '" title="' . $lang['Stop_watching_topic'] . '" border="0"></a>' : '';
	}
	else
	{
		$s_watching_topic = '<a href="viewtopic.' . $phpEx . '?' . POST_TOPIC_URL . '=' . $topic_id . '&amp;watch=topic&amp;start=' . $start . '&amp;sid=' . $userdata['session_id'] . '">' . $lang['Start_watching_topic'] . '</a>';
		$s_watching_topic_img = ( isset($images['Topic_watch']) ) ? '<a href="viewtopic.' . $phpEx . '?' . POST_TOPIC_URL . '=' . $topic_id . '&amp;watch=topic&amp;start=' . $start . '&amp;sid=' . $userdata['session_id'] . '"><img src="' . $images['Topic_watch'] . '" alt="' . $lang['Start_watching_topic'] . '" title="' . $lang['Start_watching_topic'] . '" border="0"></a>' : '';
	}
}

//
// If we've got a hightlight set pass it on to pagination,
// I get annoyed when I lose my highlight after the first page.
//
$pagination = ( $highlight != '' ) ? generate_pagination('viewtopic.' . $phpEx . '?' . POST_TOPIC_URL . '=' . $topic_id . '&amp;postdays=' . $post_days . '&amp;postorder=' . $post_order . '&amp;highlight=' . $highlight, $total_replies, $board_config['posts_per_page'], $start) : generate_pagination('viewtopic.' . $phpEx . '?' . POST_TOPIC_URL . '=' . $topic_id . '&amp;postdays=' . $post_days . '&amp;postorder=' . $post_order, $total_replies, $board_config['posts_per_page'], $start);

//-- mod : view category name --------------------------------------------------
//-- add
$cat_info = get_category($forum_id);
//-- fin mod : view category name ----------------------------------------------

//
// Send vars to template
//
$template->assign_vars(array(
//-- mod : view category name --------------------------------------------------
//-- add
	'CAT_NAME' => $cat_info['title'],
	'U_CAT' => append_sid($phpbb_root_path . 'index.' . $phpEx . '?' . POST_CAT_URL . '=' . $cat_info['id']),
//-- fin mod : view category name ----------------------------------------------

	'FORUM_ID' => $forum_id,
	'FORUM_NAME' => $forum_name,
	'TOPIC_ID' => $topic_id,
	'TOPIC_TITLE' => $topic_title,
	'PAGINATION' => $pagination,
	'PAGE_NUMBER' => sprintf($lang['Page_of'], ( floor( $start / intval($board_config['posts_per_page']) ) + 1 ), ceil( $total_replies / intval($board_config['posts_per_page']) )),

	'POST_IMG' => $post_img,
	'REPLY_IMG' => $reply_img,

	'L_AUTHOR' => $lang['Author'],
	'L_MESSAGE' => $lang['Message'],
	'L_POSTED' => $lang['Posted'],
	'L_POST_SUBJECT' => $lang['Post_subject'],
	'L_VIEW_NEXT_TOPIC' => $lang['View_next_topic'],
	'L_VIEW_PREVIOUS_TOPIC' => $lang['View_previous_topic'],
	'L_POST_NEW_TOPIC' => $post_alt,
	'L_POST_REPLY_TOPIC' => $reply_alt,
	'L_BACK_TO_TOP' => $lang['Back_to_top'],
	'L_DISPLAY_POSTS' => $lang['Display_posts'],
	'L_LOCK_TOPIC' => $lang['Lock_topic'],
	'L_UNLOCK_TOPIC' => $lang['Unlock_topic'],
	'L_MOVE_TOPIC' => $lang['Move_topic'],
	'L_SPLIT_TOPIC' => $lang['Split_topic'],
	'L_DELETE_TOPIC' => $lang['Delete_topic'],
	'L_GOTO_PAGE' => $lang['Goto_page'],

	'S_TOPIC_LINK' => POST_TOPIC_URL,
	'S_SELECT_POST_DAYS' => $select_post_days,
	'S_SELECT_POST_ORDER' => $select_post_order,
	'S_POST_DAYS_ACTION' => append_sid('viewtopic.' . $phpEx . '?' . POST_TOPIC_URL . '=' . $topic_id . '&amp;start=' . $start),
	'S_AUTH_LIST' => $s_auth_can,
	'S_TOPIC_ADMIN' => $topic_mod,
	'S_WATCH_TOPIC' => $s_watching_topic,
	'S_WATCH_TOPIC_IMG' => $s_watching_topic_img,

//-- mod : quick title edition -------------------------------------------------
//-- add
	'SELECT_TITLE' => $select_title,
//-- fin mod : quick title edition ---------------------------------------------

	'U_VIEW_TOPIC' => append_sid('viewtopic.' . $phpEx . '?' . POST_TOPIC_URL . '=' . $topic_id . '&amp;start=' . $start . '&amp;postdays=' . $post_days . '&amp;postorder=' . $post_order . '&amp;highlight=' . $highlight),
	'U_VIEW_FORUM' => $view_forum_url,
	'U_VIEW_OLDER_TOPIC' => $view_prev_topic_url,
	'U_VIEW_NEWER_TOPIC' => $view_next_topic_url,
	'U_POST_NEW_TOPIC' => $new_topic_url,
	'U_POST_REPLY_TOPIC' => $reply_topic_url)
);

//-- mod : bump topic ----------------------------------------------------------
//-- add
$bumper_data = get_bumper_stats($forum_id, $topic_id);
$bump_topic_allowed = bump_topic_allowed($forum_topic_data['topic_bumped'], $forum_topic_data['topic_last_post_time'], $forum_topic_data['topic_poster'], $bumper_data['poster_id']);
if ( !empty($bump_topic_allowed) )
{
	$template->assign_block_vars('bump_topic', array(
		'I_BUMP_TOPIC' => $images['bump_topic'],
		'L_BUMP_TOPIC' => $lang['bump_topic'],
		'U_BUMP_TOPIC' => append_sid('posting.' . $phpEx . '?mode=bump&amp;' . POST_FORUM_URL . '=' . $forum_id . '&amp;' . POST_TOPIC_URL . '=' . $topic_id),
	));
}
//-- fin mod : bump topic ------------------------------------------------------

//
// Does this topic contain a poll?
//
if ( !empty($forum_topic_data['topic_vote']) )
{
	$s_hidden_fields = '';

	$sql = 'SELECT vd.vote_id, vd.vote_text, vd.vote_start, vd.vote_length, vr.vote_option_id, vr.vote_option_text, vr.vote_result
		FROM ' . VOTE_DESC_TABLE . ' vd, ' . VOTE_RESULTS_TABLE . ' vr
		WHERE vd.topic_id = ' . $topic_id . '
			AND vr.vote_id = vd.vote_id
		ORDER BY vr.vote_option_id ASC';
	if ( !$result = $db->sql_query($sql) )
	{
		message_die(GENERAL_ERROR, 'Could not obtain vote data for this topic', '', __LINE__, __FILE__, $sql);
	}

	if ( $vote_info = $db->sql_fetchrowset($result) )
	{
		$db->sql_freeresult($result);
		$vote_options = count($vote_info);

		$vote_id = $vote_info[0]['vote_id'];
		$vote_title = $vote_info[0]['vote_text'];

		$sql = 'SELECT vote_id
			FROM ' . VOTE_USERS_TABLE . '
			WHERE vote_id = ' . $vote_id . '
				AND vote_user_id = ' . intval($userdata['user_id']);
		if ( !$result = $db->sql_query($sql) )
		{
			message_die(GENERAL_ERROR, 'Could not obtain user vote data for this topic', '', __LINE__, __FILE__, $sql);
		}

		$user_voted = ( $row = $db->sql_fetchrow($result) ) ? TRUE : 0;
		$db->sql_freeresult($result);

		if ( isset($HTTP_GET_VARS['vote']) || isset($HTTP_POST_VARS['vote']) )
		{
			$view_result = ( ( ( isset($HTTP_GET_VARS['vote']) ) ? $HTTP_GET_VARS['vote'] : $HTTP_POST_VARS['vote'] ) == 'viewresult' ) ? TRUE : 0;
		}
		else
		{
			$view_result = 0;
		}

		$poll_expired = ( $vote_info[0]['vote_length'] ) ? ( ( $vote_info[0]['vote_start'] + $vote_info[0]['vote_length'] < time() ) ? TRUE : 0 ) : 0;

		if ( $user_voted || $view_result || $poll_expired || !$is_auth['auth_vote'] || $forum_topic_data['topic_status'] == TOPIC_LOCKED )
		{
			$template->set_filenames(array('pollbox' => 'viewtopic_poll_result.tpl'));

			$vote_results_sum = 0;

			for($i = 0; $i < $vote_options; $i++)
			{
				$vote_results_sum += $vote_info[$i]['vote_result'];
			}

			$vote_graphic = 0;
			$vote_graphic_max = count($images['voting_graphic']);

			for($i = 0; $i < $vote_options; $i++)
			{
				$vote_percent = ( $vote_results_sum > 0 ) ? $vote_info[$i]['vote_result'] / $vote_results_sum : 0;
				$vote_graphic_length = round($vote_percent * $board_config['vote_graphic_length']);

				$vote_graphic_img = $images['voting_graphic'][$vote_graphic];
				$vote_graphic = ($vote_graphic < $vote_graphic_max - 1) ? $vote_graphic + 1 : 0;

//-- mod : disable word censor for single forums -------------------------------
//-- delete
/*-MOD
				if ( count($orig_word) )
MOD-*/
//-- add
				if ( count($orig_word) && (!$forum_topic_data['disable_word_censor']) )
//-- fin mod : disable word censor for single forums ---------------------------
				{
					$vote_info[$i]['vote_option_text'] = preg_replace($orig_word, $replacement_word, $vote_info[$i]['vote_option_text']);
				}

				$template->assign_block_vars('poll_option', array(
					'POLL_OPTION_CAPTION' => $vote_info[$i]['vote_option_text'],
					'POLL_OPTION_RESULT' => $vote_info[$i]['vote_result'],
					'POLL_OPTION_PERCENT' => sprintf("%.1d%%", ($vote_percent * 100)),

					'POLL_OPTION_IMG' => $vote_graphic_img,
					'POLL_OPTION_IMG_WIDTH' => $vote_graphic_length)
				);
			}

			$template->assign_vars(array(
				'L_TOTAL_VOTES' => $lang['Total_votes'],
				'TOTAL_VOTES' => $vote_results_sum)
			);

		}
		else
		{
			$template->set_filenames(array('pollbox' => 'viewtopic_poll_ballot.tpl'));

			for($i = 0; $i < $vote_options; $i++)
			{
//-- mod : disable word censor for single forums -------------------------------
//-- delete
/*-MOD
				if ( count($orig_word) )
MOD-*/
//-- add
				if ( count($orig_word) && (!$forum_topic_data['disable_word_censor']) )
//-- fin mod : disable word censor for single forums ---------------------------
				{
					$vote_info[$i]['vote_option_text'] = preg_replace($orig_word, $replacement_word, $vote_info[$i]['vote_option_text']);
				}

				$template->assign_block_vars('poll_option', array(
					'POLL_OPTION_ID' => $vote_info[$i]['vote_option_id'],
					'POLL_OPTION_CAPTION' => $vote_info[$i]['vote_option_text'])
				);
			}

			$template->assign_vars(array(
				'L_SUBMIT_VOTE' => $lang['Submit_vote'],
				'L_VIEW_RESULTS' => $lang['View_results'],

				'U_VIEW_RESULTS' => append_sid('viewtopic.' . $phpEx . '?' . POST_TOPIC_URL . '=' . $topic_id . '&amp;postdays=' . $post_days . '&amp;postorder=' . $post_order . '&amp;vote=viewresult'))
			);

			$s_hidden_fields = '<input type="hidden" name="topic_id" value="' . $topic_id . '" /><input type="hidden" name="mode" value="vote" />';
		}

//-- mod : disable word censor for single forums -------------------------------
//-- delete
/*-MOD
		if ( count($orig_word) )
MOD-*/
//-- add
		if ( count($orig_word) && (!$forum_topic_data['disable_word_censor']) )
//-- fin mod : disable word censor for single forums ---------------------------
		{
			$vote_title = preg_replace($orig_word, $replacement_word, $vote_title);
		}

		$s_hidden_fields .= '<input type="hidden" name="sid" value="' . $userdata['session_id'] . '" />';

		$template->assign_vars(array(
			'POLL_QUESTION' => $vote_title,

			'S_HIDDEN_FIELDS' => $s_hidden_fields,
			'S_POLL_ACTION' => append_sid('posting.' . $phpEx . '?mode=vote&amp;' . POST_TOPIC_URL . '=' . $topic_id))
		);

		$template->assign_var_from_handle('POLL_DISPLAY', 'pollbox');
	}
}

//-- mod : attachment mod ------------------------------------------------------
//-- add
init_display_post_attachments($forum_topic_data['topic_attachment']);
//-- fin mod : attachment mod --------------------------------------------------

//
// Update the topic view counter
//
$sql = 'UPDATE ' . TOPICS_TABLE . '
	SET topic_views = topic_views + 1
	WHERE topic_id = ' . $topic_id;
if ( !$db->sql_query($sql) )
{
	message_die(GENERAL_ERROR, 'Could not update topic views.', '', __LINE__, __FILE__, $sql);
}

//-- mod : topics enhanced -----------------------------------------------------
//-- add
//-- topics nav buttons
$num_row = 0;
//-- fin mod : topics enhanced -------------------------------------------------

//
// Okay, let's do the loop, yeah come on baby let's do the loop
// and it goes like this ...
//
for($i = 0; $i < $total_posts; $i++)
{
//-- mod : mini card -----------------------------------------------------------
//-- add
	$cards = '';
	$red_card = false;
	$warn_level = '';
	$max_warn_level = '';
	$max_warn_level = $board_config['card_max'];

	$card_sql = 'SELECT ban_userid
		FROM ' . BANLIST_TABLE . '
		WHERE ban_userid = ' . $postrow[$i]['user_id'] . ' LIMIT 1';
	if( !( $card_result = $db->sql_query($card_sql) ))
	{
		message_die(GENERAL_ERROR, 'Could not read ban entry', '', __LINE__, __FILE__, $card_sql);
	}

	if( $db->sql_numrows($card_result) >= 1 )
	{
		$red_card = true;
	}
	else if( $postrow[$i]['user_warn'] == $max_warn_level )
	{
		$red_card = true;
	}
	else
	{
		$red_card = false;
		if( $postrow[$i]['user_warn'] > 0 )
		{
			$j = 1;
			$p = 1;
			while( $p <= $postrow[$i]['user_warn'] )
			{
				if( $j == 4 )
				{
					$j = 0;
					$br = '<br />';
				}
				else
				{
					$j++;
					$br = '';
				}
				$cards .= ' <img src="' . $images['icon_y_card'] . '" border="0" alt="' . $lang['yellow_card'] . '" title="' . $lang['yellow_card'] . '" />' . $br;
				$p++;  		
			}
		}
		else
		{
			$j = 1;
		}
	}

	if( $red_card === true )
	{
		$cards = '<img src="' . $images['icon_r_card'] . '" border="0" alt="' . $lang['red_card'] . '" title="' . $lang['red_card'] . '" />';
	}

	if( ( $userdata['user_level'] == ADMIN or $is_auth['auth_mod'] ) && $postrow[$i]['user_id'] != ANONYMOUS && $postrow[$i]['user_level'] != ADMIN )
	{
		$warn_red_card = '<a href="'. append_sid($phpbb_root_path . 'card_report.' . $phpEx . '?mode=ban&user=' . $postrow[$i]['user_id'] . '&redirect=viewtopic.' . $phpEx . '?p=' . $postrow[$i]['post_id']) . '"><img src="' . $images['icon_r_card'] . '" alt="' . $lang['red_card'] . '" title="' . $lang['red_card'] . '" border="0" /></a>';
		$warn_yellow_card = '<a href="'. append_sid($phpbb_root_path . 'card_report.' . $phpEx . '?mode=warn&user=' . $postrow[$i]['user_id'] . '&redirect=viewtopic.' . $phpEx . '?p=' . $postrow[$i]['post_id']) . '"><img src="' . $images['icon_y_card'] . '" alt="' . $lang['yellow_card'] . '" title="' . $lang['yellow_card'] . '" border="0" /></a>';
		$warn_green_card = '<a href="'. append_sid($phpbb_root_path . 'card_report.' . $phpEx . '?mode=green&user=' . $postrow[$i]['user_id'] . '&redirect=viewtopic.' . $phpEx . '?p=' . $postrow[$i]['post_id']) . '"><img src="' . $images['icon_g_card'] . '" alt="' . $lang['green_card'] . '" title="' . $lang['green_card'] . '" border="0" /></a>';
	}
	else
	{
		$warn_red_card = '';
		$warn_yellow_card = '';
		$warn_green_card = '';
	}
//-- fin mod : mini card -------------------------------------------------------

//-- mod : topics enhanced -----------------------------------------------------
//-- add
//-- topics nav buttons
	$num_row++;

	$nav_buttons = (empty($i)) ? '<a href="' . append_sid('viewtopic.' . $phpEx . '?' . POST_TOPIC_URL . '=' . $topic_id . '&amp;view=previous') . '"><img alt="" src="' . $images['nav_prev'] . '" title="' . $lang['View_previous_topic'] . '" border="0" /></a>' : '';
	$nav_buttons .= (($i == $total_posts - 1) && $total_posts != 1) ? '<a href="#top"><img alt="" src="' . $images['nav_top'] . '" title="' . $lang['Back_to_top'] . '" border="0" /></a>' : '';
	$nav_buttons .= (!empty($i)) ? '<a href="#' . ($num_row - 1) . '"><img alt="" src="' . $images['nav_prev_post'] . '" title="' . $lang['View_previous_post'] . '" border="0" /></a>' : '';
	$nav_buttons .= ($i != $total_posts - 1) ? '<a href="#' . ($num_row + 1) . '"><img alt="" src="' . $images['nav_next_post'] . '" title="' . $lang['View_next_post'] . '" border="0" /></a>' : '';
	$nav_buttons .= (empty($i)) ? '<a href="#bot"><img alt="" src="' . $images['nav_bot'] . '" title="' . $lang['Go_to_bottom'] . '" border="0" /></a>' : '';
	$nav_buttons .= (empty($i)) ? '<a href="' . append_sid('viewtopic.' . $phpEx . '?' . POST_TOPIC_URL . '=' . $topic_id . '&amp;view=next') . '"><img alt="" src="' . $images['nav_next'] . '" title="' . $lang['View_next_topic'] . '" border="0" /></a>' : '';
//-- fin mod : topics enhanced -------------------------------------------------

	$poster_id = $postrow[$i]['user_id'];
	$poster = ( $poster_id == ANONYMOUS ) ? $lang['Guest'] : $postrow[$i]['username'];

//-- mod : birthday ------------------------------------------------------------
//-- add
	$bdays->get_user_bday($postrow[$i]['user_birthday'], $postrow[$i]['username'], true);
	$poster_age = $bdays->data_age;
	$poster_cake = $bdays->data_cake;
//-- fin mod : birthday --------------------------------------------------------

	$post_date = create_date($board_config['default_dateformat'], $postrow[$i]['post_time'], $board_config['board_timezone']);

	$poster_posts = ( $postrow[$i]['user_id'] != ANONYMOUS ) ? $lang['Posts'] . ': ' . $postrow[$i]['user_posts'] : '';

//-- mod : topics a user has started -------------------------------------------
//-- add
	$poster_topics = ( $postrow[$i]['user_id'] != ANONYMOUS ) ? $lang['Topics'] . ': ' . (( $postrow[$i]['user_topics'] ) ? $postrow[$i]['user_topics'] : '0') : '';
//-- fin mod : topics a user has started ---------------------------------------

	$poster_from = ( $postrow[$i]['user_from'] && $postrow[$i]['user_id'] != ANONYMOUS ) ? $lang['Location'] . ': ' . $postrow[$i]['user_from'] : '';

	$poster_joined = ( $postrow[$i]['user_id'] != ANONYMOUS ) ? $lang['Joined'] . ': ' . create_date($lang['DATE_FORMAT'], $postrow[$i]['user_regdate'], $board_config['board_timezone']) : '';

//-- mod : jail mod ------------------------------------------------------------
//-- add
	$celleds =  ( $board_config['cell_allow_display_celleds'] && $postrow[$i]['user_cell_celleds'] ) ? sprintf('<br />'.$lang['Celleds_time'].'<a href="' . append_sid("courthouse.$phpEx?from=celleds_list") . '">'.$postrow[$i]['user_cell_celleds'].'</a>') : '';
//-- fin mod : jail mod --------------------------------------------------------

	$poster_avatar = '';
	if ( $postrow[$i]['user_avatar_type'] && $poster_id != ANONYMOUS && $postrow[$i]['user_allowavatar'] )
	{
		switch( $postrow[$i]['user_avatar_type'] )
		{
//-- mod : resize avatars based on max width and heignt ------------------------
//-- delete
/*-MOD
			case USER_AVATAR_UPLOAD:
				$poster_avatar = ( $board_config['allow_avatar_upload'] ) ? '<img src="' . $board_config['avatar_path'] . '/' . $postrow[$i]['user_avatar'] . '" alt="" border="0" />' : '';
				break;
			case USER_AVATAR_REMOTE:
				$poster_avatar = ( $board_config['allow_avatar_remote'] ) ? '<img src="' . $postrow[$i]['user_avatar'] . '" alt="" border="0" />' : '';
				break;
			case USER_AVATAR_GALLERY:
				$poster_avatar = ( $board_config['allow_avatar_local'] ) ? '<img src="' . $board_config['avatar_gallery_path'] . '/' . $postrow[$i]['user_avatar'] . '" alt="" border="0" />' : '';
				break;
MOD-*/
//-- add
			case USER_AVATAR_UPLOAD:
				$poster_avatar = ( $board_config['allow_avatar_upload'] ) ? '<img onload="rmwa_img_loaded(this,' .  $board_config['avatar_max_width'] . ',' .  $board_config['avatar_max_height'] . ')"' . ' src="' . $board_config['avatar_path'] . '/' . $postrow[$i]['user_avatar'] . '" alt="" border="0" />' : '';
//-- mod : jail mod ------------------------------------------------------------
//-- add
				$poster_avatar = ( ($postrow[$i]['user_cell_time'] > 0) && $board_config['cell_allow_display_bars']) ? '<img src="images/cell.gif" style="position: absolute; filter: alpha(opacity=65); width: ' . $board_config['avatar_max_width'] . '; height: ' . $board_config['avatar_max_height'] . '" border="0"><img src="' . $board_config['avatar_path'] . '/' . $postrow[$i]['user_avatar'] . '"  style="width: ' . $board_config['avatar_max_width'] . '; height: ' . $board_config['avatar_max_height'] . '" border="0" >' : $poster_avatar;
//-- fin mod : jail mod --------------------------------------------------------
				break;
			case USER_AVATAR_REMOTE:
				$poster_avatar = ( $board_config['allow_avatar_remote'] ) ? '<img onload="rmwa_img_loaded(this,' .  $board_config['avatar_max_width'] . ',' .  $board_config['avatar_max_height'] . ')"' . ' src="' . $postrow[$i]['user_avatar'] . '" alt="" border="0" />' : '';
//-- mod : jail mod ------------------------------------------------------------
//-- add
				$poster_avatar = ( ($postrow[$i]['user_cell_time'] > 0) && $board_config['cell_allow_display_bars'] ) ? '<img src="images/cell.gif" style="position: absolute; filter: alpha(opacity=65); width: ' . $board_config['avatar_max_width'] . '; height: ' . $board_config['avatar_max_height'] . '" border="0"><img src="' . $postrow[$i]['user_avatar'] . '"  style="width: ' . $board_config['avatar_max_width'] . '; height: ' . $board_config['avatar_max_height'] . '" border="0" >' : $poster_avatar;
//-- fin mod : jail mod --------------------------------------------------------
				break;
			case USER_AVATAR_GALLERY:
				$poster_avatar = ( $board_config['allow_avatar_local'] ) ? '<img onload="rmwa_img_loaded(this,' .  $board_config['avatar_max_width'] . ',' .  $board_config['avatar_max_height'] . ')"' . ' src="' . $board_config['avatar_gallery_path'] . '/' . $postrow[$i]['user_avatar'] . '" alt="" border="0" />' : '';
//-- mod : jail mod ------------------------------------------------------------
//-- add
				$poster_avatar = ( ($postrow[$i]['user_cell_time'] > 0) && $board_config['cell_allow_display_bars'] ) ? '<img src="images/cell.gif" style="position: absolute; filter: alpha(opacity=65); width: ' . $board_config['avatar_max_width'] . '; height: ' . $board_config['avatar_max_height'] . '" border="0"><img src="' . $board_config['avatar_gallery_path'] . '/' . $postrow[$i]['user_avatar'] . '" style="width: ' . $board_config['avatar_max_width'] . '; height: ' . $board_config['avatar_max_height'] . '" border="0" >' : $poster_avatar;
//-- fin mod : jail mod --------------------------------------------------------
				break;
//-- fin mod : resize avatars based on max width and heignt --------------------
		}
	}

//-- mod : ip country flag -----------------------------------------------------
//-- add
	$ipcfguest = 'guest';
	$ipcfguestalt = $lang['IPCF_Guest'];

	if ($postrow[$i]['user_id'] == -1)
	{
		$poster_avatar = '<img src="images/avatars/gallery/ipcf_flags/' . $ipcfguest . '.gif" alt="' . $ipcfguestalt . '" title="' . $ipcfguestalt . '" border="0" />';
	}
	else if (!$postrow[$i]['user_avatar_type'])
	{
		$poster_avatar = '<img src="images/avatars/gallery/ipcf_flags/' . $postrow[$i]['user_cf_iso3661_1'] . '.gif" alt="' . $lang['IP2Country'][$postrow[$i]['user_cf_iso3661_1']] . '" title="' . $lang['IP2Country'][$postrow[$i]['user_cf_iso3661_1']] . '" border="0" />';
	}
//-- fin mod : ip country flag -------------------------------------------------

	//
	// Define the little post icon
	//
//-- mod : keep unread flags ---------------------------------------------------
//-- delete
/*-MOD
	if ( $userdata['session_logged_in'] && $postrow[$i]['post_time'] > $userdata['user_lastvisit'] && $postrow[$i]['post_time'] > $topic_last_read )
	{
		$mini_post_img = $images['icon_minipost_new'];
		$mini_post_alt = $lang['New_post'];
	}
	else
	{
		$mini_post_img = $images['icon_minipost'];
		$mini_post_alt = $lang['Post'];
	}
MOD-*/
//-- add
	if ( $postrow[$i]['post_time'] > $topic_last_read )
	{
		$mini_post_img = $images['icon_minipost_new'];
		$mini_post_alt = $lang['New_post'];
	}
	else
	{
		$mini_post_img = $images['icon_minipost'];
		$mini_post_alt = $lang['Post'];
	}
//-- fin mod : keep unread flags -----------------------------------------------

	$mini_post_url = append_sid('viewtopic.' . $phpEx . '?' . POST_POST_URL . '=' . $postrow[$i]['post_id']) . '#' . $postrow[$i]['post_id'];

	//
	// Generate ranks, set them to empty string initially.
	//
	$poster_rank = '';
	$rank_image = '';
//-- mod : gender --------------------------------------------------------------
//-- add
	$gender_image = '';
//-- fin mod : gender ----------------------------------------------------------

	if ( $postrow[$i]['user_id'] == ANONYMOUS )
	{
	}
	else if ( $postrow[$i]['user_rank'] )
	{
		for($j = 0; $j < count($ranksrow); $j++)
		{
			if ( $postrow[$i]['user_rank'] == $ranksrow[$j]['rank_id'] && $ranksrow[$j]['rank_special'] )
			{
				$poster_rank = $ranksrow[$j]['rank_title'];
				$rank_image = ( $ranksrow[$j]['rank_image'] ) ? '<img src="' . $ranksrow[$j]['rank_image'] . '" alt="' . $poster_rank . '" title="' . $poster_rank . '" border="0" /><br />' : '';
			}
		}
	}
	else
	{
		for($j = 0; $j < count($ranksrow); $j++)
		{
			if ( $postrow[$i]['user_posts'] >= $ranksrow[$j]['rank_min'] && !$ranksrow[$j]['rank_special'] )
			{
				$poster_rank = $ranksrow[$j]['rank_title'];
				$rank_image = ( $ranksrow[$j]['rank_image'] ) ? '<img src="' . $ranksrow[$j]['rank_image'] . '" alt="' . $poster_rank . '" title="' . $poster_rank . '" border="0" /><br />' : '';
			}
		}
	}

	//
	// Handle anon users posting with usernames
	//
	if ( $poster_id == ANONYMOUS && $postrow[$i]['post_username'] != '' )
	{
		$poster = $postrow[$i]['post_username'];
		$poster_rank = $lang['Guest'];
//-- mod : birthday ------------------------------------------------------------
//-- add
		$poster_age = '';
		$poster_cake = '';
//-- fin mod : birthday --------------------------------------------------------
	}

	$temp_url = '';

	if ( $poster_id != ANONYMOUS )
	{
//-- mod : rank color system ---------------------------------------------------
//-- delete
/*-MOD
		$temp_url = append_sid('profile.' . $phpEx . '?mode=viewprofile&amp;' . POST_USERS_URL . '=' . $poster_id);
MOD-*/
//-- add
		$temp_url = $get->url('profile', array('mode' => 'viewprofile', POST_USERS_URL => $poster_id), true);
//-- fin mod : rank color system -----------------------------------------------

		$profile_img = '<a href="' . $temp_url . '"><img src="' . $images['icon_profile'] . '" alt="' . $lang['Read_profile'] . '" title="' . $lang['Read_profile'] . '" border="0" /></a>';
		$profile = '<a href="' . $temp_url . '">' . $lang['Read_profile'] . '</a>';

		$temp_url = append_sid('privmsg.' . $phpEx . '?mode=post&amp;' . POST_USERS_URL . '=' . $poster_id);
		$pm_img = '<a href="' . $temp_url . '"><img src="' . $images['icon_pm'] . '" alt="' . $lang['Send_private_message'] . '" title="' . $lang['Send_private_message'] . '" border="0" /></a>';
		$pm = '<a href="' . $temp_url . '">' . $lang['Send_private_message'] . '</a>';

//-- mod : gender --------------------------------------------------------------
//-- add
		switch ($postrow[$i]['user_gender'])
		{
			case 1 :
				$gender_image = $lang['Gender'] . ': <img src="' . $images['icon_minigender_male'] . '" alt="' . $lang['Male'] . '" title="' . $lang['Male'] . '" border="0" />';
				break;
			case 2 :
				$gender_image = $lang['Gender'] . ': <img src="' . $images['icon_minigender_female'] . '" alt="' . $lang['Female'] . '" title="' . $lang['Female'] . '" border="0" />';
				break;
			default :
				$gender_image = '';
		}
//-- fin mod : gender ----------------------------------------------------------

		if ( !empty($postrow[$i]['user_viewemail']) || $is_auth['auth_mod'] )
		{
			$email_uri = ( $board_config['board_email_form'] ) ? append_sid('profile.' . $phpEx . '?mode=email&amp;' . POST_USERS_URL . '=' . $poster_id) : 'mailto:' . $postrow[$i]['user_email'];

			$email_img = '<a href="' . $email_uri . '"><img src="' . $images['icon_email'] . '" alt="' . $lang['Send_email'] . '" title="' . $lang['Send_email'] . '" border="0" /></a>';
			$email = '<a href="' . $email_uri . '">' . $lang['Send_email'] . '</a>';
		}
		else
		{
			$email_img = '';
			$email = '';
		}

		$www_img = ( $postrow[$i]['user_website'] ) ? '<a href="' . $postrow[$i]['user_website'] . '" target="_userwww"><img src="' . $images['icon_www'] . '" alt="' . $lang['Visit_website'] . '" title="' . $lang['Visit_website'] . '" border="0" /></a>' : '';
		$www = ( $postrow[$i]['user_website'] ) ? '<a href="' . $postrow[$i]['user_website'] . '" target="_userwww">' . $lang['Visit_website'] . '</a>' : '';

		if ( !empty($postrow[$i]['user_icq']) )
		{
			$icq_status_img = '<a href="http://wwp.icq.com/' . $postrow[$i]['user_icq'] . '#pager"><img src="http://web.icq.com/whitepages/online?icq=' . $postrow[$i]['user_icq'] . '&img=5" width="18" height="18" border="0" /></a>';
			$icq_img = '<a href="http://wwp.icq.com/scripts/search.dll?to=' . $postrow[$i]['user_icq'] . '"><img src="' . $images['icon_icq'] . '" alt="' . $lang['ICQ'] . '" title="' . $lang['ICQ'] . '" border="0" /></a>';
			$icq =  '<a href="http://wwp.icq.com/scripts/search.dll?to=' . $postrow[$i]['user_icq'] . '">' . $lang['ICQ'] . '</a>';
		}
		else
		{
			$icq_status_img = '';
			$icq_img = '';
			$icq = '';
		}

		$aim_img = ( $postrow[$i]['user_aim'] ) ? '<a href="aim:goim?screenname=' . $postrow[$i]['user_aim'] . '&amp;message=Hello+Are+you+there?"><img src="' . $images['icon_aim'] . '" alt="' . $lang['AIM'] . '" title="' . $lang['AIM'] . '" border="0" /></a>' : '';
		$aim = ( $postrow[$i]['user_aim'] ) ? '<a href="aim:goim?screenname=' . $postrow[$i]['user_aim'] . '&amp;message=Hello+Are+you+there?">' . $lang['AIM'] . '</a>' : '';

//-- mod : rank color system ---------------------------------------------------
//-- delete
/*-MOD
		$temp_url = append_sid('profile.' . $phpEx . '?mode=viewprofile&amp;' . POST_USERS_URL . '=' . $poster_id);
MOD-*/
//-- add
		$temp_url = $get->url('profile', array('mode' => 'viewprofile', POST_USERS_URL => $poster_id), true);
//-- fin mod : rank color system -----------------------------------------------

//-- mod : invision view profile -----------------------------------------------
//-- delete
/*-MOD
		$msn_img = ( $postrow[$i]['user_msnm'] ) ? '<a href="' . $temp_url . '"><img src="' . $images['icon_msnm'] . '" alt="' . $lang['MSNM'] . '" title="' . $lang['MSNM'] . '" border="0" /></a>' : '';
MOD-*/
//-- add
		$msn_img = ( $postrow[$i]['user_msnm'] ) ? '<a href="http://members.msn.com/' . $postrow[$i]['user_msnm'] . '" target="_blank"><img src="' . $images['icon_msnm'] . '" alt="' . $lang['MSNM'] . '" title="' . $lang['MSNM'] . '" border="0" /></a>' : '';
//-- fin mod : invision view profile -------------------------------------------

		$msn = ( $postrow[$i]['user_msnm'] ) ? '<a href="' . $temp_url . '">' . $lang['MSNM'] . '</a>' : '';

//-- mod : skype ---------------------------------------------------------------
//-- add
		$skype_img = ( $postrow[$i]['user_skype'] ) ? '<a href="callto://' . $postrow[$i]['user_skype'] . '"><img src="' . $images['icon_skype'] . '" alt="' . $lang['SKYPE'] . '" title="' . $lang['SKYPE'] . '" border="0" /></a>' : '';
		$skype = ( $postrow[$i]['user_skype'] ) ? '<a href="callto://' . $postrow[$i]['user_skype'] . '">' . $lang['SKYPE'] . '</a>' : '';
//-- fin mod : skype -----------------------------------------------------------

		$yim_img = ( $postrow[$i]['user_yim'] ) ? '<a href="http://edit.yahoo.com/config/send_webmesg?.target=' . $postrow[$i]['user_yim'] . '&amp;.src=pg"><img src="' . $images['icon_yim'] . '" alt="' . $lang['YIM'] . '" title="' . $lang['YIM'] . '" border="0" /></a>' : '';
		$yim = ( $postrow[$i]['user_yim'] ) ? '<a href="http://edit.yahoo.com/config/send_webmesg?.target=' . $postrow[$i]['user_yim'] . '&amp;.src=pg">' . $lang['YIM'] . '</a>' : '';

//-- mod : online offline hidden -----------------------------------------------
//-- add
		if ($postrow[$i]['user_session_time'] >= (time()-$board_config['online_time']))
		{
			if ($postrow[$i]['user_allow_viewonline'])
			{
				$online_status_img = '<a href="' . append_sid('viewonline.' . $phpEx) . '"><img src="' . $images['icon_online'] . '" alt="' . sprintf($lang['is_online'], $poster) . '" title="' . sprintf($lang['is_online'], $poster) . '" /></a>&nbsp;';
				$online_status = '<br />' . $lang['Online_status'] . ': <strong><a href="' . append_sid('viewonline.' . $phpEx) . '" title="' . sprintf($lang['is_online'], $poster) . '"' . $online_color . '>' . $lang['Online'] . '</a></strong>';
			}
			else if ( $is_auth['auth_mod'] || $userdata['user_id'] == $poster_id )
			{
				$online_status_img = '<a href="' . append_sid('viewonline.' . $phpEx) . '"><img src="' . $images['icon_hidden'] . '" alt="' . sprintf($lang['is_hidden'], $poster) . '" title="' . sprintf($lang['is_hidden'], $poster) . '" /></a>&nbsp;';
				$online_status = '<br />' . $lang['Online_status'] . ': <strong><em><a href="' . append_sid('viewonline.' . $phpEx) . '" title="' . sprintf($lang['is_hidden'], $poster) . '"' . $hidden_color . '>' . $lang['Hidden'] . '</a></em></strong>';
			}
			else
			{
				$online_status_img = '<img src="' . $images['icon_offline'] . '" alt="' . sprintf($lang['is_offline'], $poster) . '" title="' . sprintf($lang['is_offline'], $poster) . '" />&nbsp;';
				$online_status = '<br />' . $lang['Online_status'] . ': <span title="' . sprintf($lang['is_offline'], $poster) . '"' . $offline_color . '><strong>' . $lang['Offline'] . '</strong></span>';
			}
		}
		else
		{
			$online_status_img = '<img src="' . $images['icon_offline'] . '" alt="' . sprintf($lang['is_offline'], $poster) . '" title="' . sprintf($lang['is_offline'], $poster) . '" />&nbsp;';
			$online_status = '<br />' . $lang['Online_status'] . ': <span title="' . sprintf($lang['is_offline'], $poster) . '"' . $offline_color . '><strong>' . $lang['Offline'] . '</strong></span>';
		}
//-- fin mod : online offline hidden -------------------------------------------

//-- mod : ip country flag -----------------------------------------------------
//-- add
		$flag = $lang['Country'] . ': <img src="images/flags/small/' . $postrow[$i]['user_cf_iso3661_1'] . '.png" alt="' . $lang['IP2Country'][$postrow[$i]['user_cf_iso3661_1']] . '" title="' . $lang['IP2Country'][$postrow[$i]['user_cf_iso3661_1']] . '" border="0" />';
		$country = $lang['Country'] . ': ' . $lang['IP2Country'][$postrow[$i]['user_cf_iso3661_1']];
//-- fin mod : ip country flag -------------------------------------------------
	}
	else
	{
		$profile_img = '';
		$profile = '';
		$pm_img = '';
		$pm = '';
		$email_img = '';
		$email = '';
		$www_img = '';
		$www = '';
		$icq_status_img = '';
		$icq_img = '';
		$icq = '';
		$aim_img = '';
		$aim = '';
		$msn_img = '';
		$msn = '';
//-- mod : skype ---------------------------------------------------------------
//-- add
		$skype_img = '';
		$skype = '';
//-- fin mod : skype -----------------------------------------------------------
		$yim_img = '';
		$yim = '';
//-- mod : online offline hidden -----------------------------------------------
//-- add
		$online_status_img = '';
		$online_status = '';
//-- fin mod : online offline hidden -------------------------------------------
//-- mod : ip country flag -----------------------------------------------------
//-- add
		$flag = $lang['Country'] . ': <img src="images/flags/small/wo.png" alt="' . $lang['IPCF_Guest'] . '" title="' . $lang['IPCF_Guest'] . '" border="0" />';
		$country = $lang['Country'] . ': ' . $lang['IPCF_Guest'];
//-- fin mod : ip country flag -------------------------------------------------
	}

	$temp_url = append_sid('posting.' . $phpEx . '?mode=quote&amp;' . POST_POST_URL . '=' . $postrow[$i]['post_id']);
	$quote_img = '<a href="' . $temp_url . '"><img src="' . $images['icon_quote'] . '" alt="' . $lang['Reply_with_quote'] . '" title="' . $lang['Reply_with_quote'] . '" border="0" /></a>';
	$quote = '<a href="' . $temp_url . '">' . $lang['Reply_with_quote'] . '</a>';

//-- mod : quick post es -------------------------------------------------------
//-- add
	$qp_quote_img = (!empty($qp_form) && empty($qp_lite)) ? '&nbsp;<img alt="' . $lang['Reply_with_quote'] . '" src="' . $images['qp_quote'] . '" title="' . $lang['Reply_with_quote'] . '" onmousedown="addquote(' . $postrow[$i]['post_id'] . ', \'' . str_replace('\'', '\\\'', (($poster_id == ANONYMOUS) ? (($postrow[$i]['post_username'] != '') ? $postrow[$i]['post_username'] : $lang['Guest']) : $postrow[$i]['username'])) . '\')" style="cursor:pointer;" border="0" />' : '';
//-- fin mod : quick post es ---------------------------------------------------

	$temp_url = append_sid('search.' . $phpEx . '?search_author=' . urlencode($postrow[$i]['username']) . '&amp;showresults=posts');
	$search_img = '<a href="' . $temp_url . '"><img src="' . $images['icon_search'] . '" alt="' . sprintf($lang['Search_user_posts'], $postrow[$i]['username']) . '" title="' . sprintf($lang['Search_user_posts'], $postrow[$i]['username']) . '" border="0" /></a>';
	$search = '<a href="' . $temp_url . '">' . sprintf($lang['Search_user_posts'], $postrow[$i]['username']) . '</a>';

//-- mod : keep unread flags ---------------------------------------------------
//-- add
	$temp_url = append_sid('viewtopic.' . $phpEx . '?mode=unread&amp;' . POST_POST_URL . '=' . $postrow[$i]['post_id']);
	$keep_unread_img = '<a href="' . $temp_url . '"><img src="' . $images['icon_keep_unread'] . '" title = "' . $lang['keep_post_unread_explain'] . '" border="0" /></a>';
//-- fin mod : keep unread flags -----------------------------------------------

	if ( ( $userdata['user_id'] == $poster_id && $is_auth['auth_edit'] ) || $is_auth['auth_mod'] )
	{
		$temp_url = append_sid('posting.' . $phpEx . '?mode=editpost&amp;' . POST_POST_URL . '=' . $postrow[$i]['post_id']);
		$edit_img = '<a href="' . $temp_url . '"><img src="' . $images['icon_edit'] . '" alt="' . $lang['Edit_delete_post'] . '" title="' . $lang['Edit_delete_post'] . '" border="0" /></a>';
		$edit = '<a href="' . $temp_url . '">' . $lang['Edit_delete_post'] . '</a>';
	}
	else
	{
		$edit_img = '';
		$edit = '';
	}

	if ( $is_auth['auth_mod'] )
	{
		$temp_url = 'modcp.' . $phpEx . '?mode=ip&amp;' . POST_POST_URL . '=' . $postrow[$i]['post_id'] . '&amp;' . POST_TOPIC_URL . '=' . $topic_id . '&amp;sid=' . $userdata['session_id'];
		$ip_img = '<a href="' . $temp_url . '"><img src="' . $images['icon_ip'] . '" alt="' . $lang['View_IP'] . '" title="' . $lang['View_IP'] . '" border="0" /></a>';
		$ip = '<a href="' . $temp_url . '">' . $lang['View_IP'] . '</a>';

		$temp_url = 'posting.' . $phpEx . '?mode=delete&amp;' . POST_POST_URL . '=' . $postrow[$i]['post_id'] . '&amp;sid=' . $userdata['session_id'];
		$delpost_img = '<a href="' . $temp_url . '"><img src="' . $images['icon_delpost'] . '" alt="' . $lang['Delete_post'] . '" title="' . $lang['Delete_post'] . '" border="0" /></a>';
		$delpost = '<a href="' . $temp_url . '">' . $lang['Delete_post'] . '</a>';

//-- mod : quick split ---------------------------------------------------------
//-- add
		if($forum_topic_data['topic_first_post_id'] != $postrow[$i]['post_id'])
		{
			$temp_url = 'modcp.' . $phpEx . '?quick_split=1&amp;' . POST_TOPIC_URL . '=' . $topic_id . '&amp;mode=split&amp;' . POST_POST_URL . '=' . $postrow[$i]['post_id'] . '&amp;sid=' . $userdata['session_id'];
			$split_img = '<a href="' . $temp_url . '"><img src="' . $images['QuSp_split'] . '" alt="' . $lang['Split_topic'] . '" title="' . $lang['Split_topic'] . '" border="0" /></a>';
			$split = '<a href="' . $temp_url . '">' . $lang['Split_topic'] . '</a>';
		}
		else
		{
			$split_img = '';
			$split = '';
		}
//-- fin mod : quick split -----------------------------------------------------
	}
	else
	{
		$ip_img = '';
		$ip = '';

//-- mod : quick split ---------------------------------------------------------
//-- add
		$split_img = '';
		$split = '';
//-- fin mod : quick split -----------------------------------------------------

		if ( $userdata['user_id'] == $poster_id && $is_auth['auth_delete'] && $forum_topic_data['topic_last_post_id'] == $postrow[$i]['post_id'] )
		{
			$temp_url = 'posting.' . $phpEx . '?mode=delete&amp;' . POST_POST_URL . '=' . $postrow[$i]['post_id'] . '&amp;sid=' . $userdata['session_id'];
			$delpost_img = '<a href="' . $temp_url . '"><img src="' . $images['icon_delpost'] . '" alt="' . $lang['Delete_post'] . '" title="' . $lang['Delete_post'] . '" border="0" /></a>';
			$delpost = '<a href="' . $temp_url . '">' . $lang['Delete_post'] . '</a>';
		}
		else
		{
			$delpost_img = '';
			$delpost = '';
		}
	}

	$post_subject = ( $postrow[$i]['post_subject'] != '' ) ? $postrow[$i]['post_subject'] : '';

//-- mod : post description ----------------------------------------------------
//-- add
	$post_sub_title = !empty($postrow[$i]['post_sub_title']) ? ( count($orig_word) ? preg_replace($orig_word, $replacement_word, $postrow[$i]['post_sub_title']) : $postrow[$i]['post_sub_title'] ) : '';
//-- fin mod : post description ------------------------------------------------

	$message = $postrow[$i]['post_text'];
	$bbcode_uid = $postrow[$i]['bbcode_uid'];

//-- mod : signature displayed once per page -----------------------------------
//-- delete
/*-MOD
	$user_sig = ( $postrow[$i]['enable_sig'] && $postrow[$i]['user_sig'] != '' && $board_config['allow_sig'] ) ? $postrow[$i]['user_sig'] : '';
MOD-*/
//-- add
	$user_sig = ( $postrow[$i]['enable_sig'] && $postrow[$i]['user_sig'] != '' && $board_config['allow_sig'] && !$signature[$poster_id] ) ? $postrow[$i]['user_sig'] : '';
//-- fin mod : signature displayed once per page -------------------------------

	$user_sig_bbcode_uid = $postrow[$i]['user_sig_bbcode_uid'];

//-- mod : points system -------------------------------------------------------
//-- add
	if ($poster_id != ANONYMOUS)
	{
		$user_points = ($userdata['user_level'] == ADMIN || user_is_authed($userdata['user_id'])) ? '<a href="' . append_sid('pointscp.' . $phpEx . '?' . POST_USERS_URL . '=' . $postrow[$i]['user_id']) . '" class="gensmall" title="' . sprintf($lang['Points_link_title'], $board_config['points_name']) . '">' . $board_config['points_name'] . '</a>' : $board_config['points_name'];
		$user_points = '<br />' . $user_points . ': ' . $postrow[$i]['user_points'];

		if ($board_config['points_donate'] && $userdata['user_id'] != ANONYMOUS && $userdata['user_id'] != $poster_id)
		{
			$donate_points = '<br />' . sprintf($lang['Points_donate'], '<a href="' . append_sid('pointscp.' . $phpEx . '?mode=donate&amp;' . POST_USERS_URL . '=' . $postrow[$i]['user_id']) . '" class="gensmall" title="' . sprintf($lang['Points_link_title_2'], $board_config['points_name']) . '">', '</a>');
		}
		else
		{
			$donate_points = '';
		}
	}
	else
	{
		$user_points = '';
		$donate_points = '';
	}
//-- fin mod : points system ---------------------------------------------------

	//
	// Note! The order used for parsing the message _is_ important, moving things around could break any
	// output
	//

	//
	// If the board has HTML off but the post has HTML
	// on then we process it, else leave it alone
	//
	if ( !$board_config['allow_html'] || !$userdata['user_allowhtml'])
	{
		if ( $user_sig != '' )
		{
			$user_sig = preg_replace('#(<)([\/]?.*?)(>)#is', "&lt;\\2&gt;", $user_sig);
		}

		if ( $postrow[$i]['enable_html'] )
		{
			$message = preg_replace('#(<)([\/]?.*?)(>)#is', "&lt;\\2&gt;", $message);
		}
	}

	//
	// Parse message and/or sig for BBCode if reqd
	//
	if ($user_sig != '' && $user_sig_bbcode_uid != '')
	{
		$user_sig = ($board_config['allow_bbcode']) ? bbencode_second_pass($user_sig, $user_sig_bbcode_uid) : preg_replace("/\:$user_sig_bbcode_uid/si", '', $user_sig);
	}

	if ($bbcode_uid != '')
	{
		$message = ($board_config['allow_bbcode']) ? bbencode_second_pass($message, $bbcode_uid) : preg_replace("/\:$bbcode_uid/si", '', $message);
	}

	if ( $user_sig != '' )
	{
		$user_sig = make_clickable($user_sig);
	}
	$message = make_clickable($message);

	//
	// Parse smilies
	//
	if ( $board_config['allow_smilies'] )
	{
		if ( $postrow[$i]['user_allowsmile'] && $user_sig != '' )
		{
//-- mod : smiley categories ---------------------------------------------------
//-- delete
/*-MOD
			$user_sig = smilies_pass($user_sig);
MOD-*/
//-- add
			$user_sig = smilies_pass($user_sig, $forum_id, $forum_cat_id);
//-- fin mod : smiley categories -----------------------------------------------
		}

		if ( $postrow[$i]['enable_smilies'] )
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
	}

	//
	// Highlight active words (primarily for search)
	//
	if ($highlight_match)
	{
		// This has been back-ported from 3.0 CVS
		$message = preg_replace('#(?!<.*)(?<!\w)(' . $highlight_match . ')(?!\w|[^<>]*>)#i', '<b style="color:#'.$theme['fontcolor3'].'">\1</b>', $message);
	}

	//
	// Replace naughty words
	//
//-- mod : disable word censor for single forums -------------------------------
//-- delete
/*-MOD
	if (count($orig_word))
MOD-*/
//-- add
	if (count($orig_word) && (!$forum_topic_data['disable_word_censor']))
//-- fin mod : disable word censor for single forums ---------------------------
	{
		$post_subject = preg_replace($orig_word, $replacement_word, $post_subject);

		if ($user_sig != '')
		{
			$user_sig = str_replace('\"', '"', substr(@preg_replace('#(\>(((?>([^><]+|(?R)))*)\<))#se', "@preg_replace(\$orig_word, \$replacement_word, '\\0')", '>' . $user_sig . '<'), 1, -1));
		}

		$message = str_replace('\"', '"', substr(@preg_replace('#(\>(((?>([^><]+|(?R)))*)\<))#se', "@preg_replace(\$orig_word, \$replacement_word, '\\0')", '>' . $message . '<'), 1, -1));
	}

	//
	// Replace newlines (we use this rather than nl2br because
	// till recently it wasn't XHTML compliant)
	//
	if ( $user_sig != '' )
	{
		$user_sig = '<br />_________________<br />' . str_replace("\n", "\n<br />\n", $user_sig);
//-- mod : signature displayed once per page -----------------------------------
//-- add
		$signature[$poster_id] = 1;
//-- fin mod : signature displayed once per page -------------------------------
	}

	$message = str_replace("\n", "\n<br />\n", $message);

	//
	// Editing information
	//
	if ( $postrow[$i]['post_edit_count'] )
	{
		$l_edit_time_total = ( $postrow[$i]['post_edit_count'] == 1 ) ? $lang['Edited_time_total'] : $lang['Edited_times_total'];

		$l_edited_by = '<br /><br />' . sprintf($l_edit_time_total, $poster, create_date($board_config['default_dateformat'], $postrow[$i]['post_edit_time'], $board_config['board_timezone']), $postrow[$i]['post_edit_count']);
	}
	else
	{
		$l_edited_by = '';
	}

//-- mod : bump topic ----------------------------------------------------------
//-- add
	// Bump information
	$l_bumped_by = '';
	if ( $forum_topic_data['topic_bumped'] && ($postrow[$i]['post_id'] == $forum_topic_data['topic_last_post_id']) )
	{
		$bumper_name = ($bumper_data['user_id'] == ANONYMOUS) ? ( ($bumper_data['post_username'] != '') ? $bumper_data['post_username'] : $lang['Guest'] ) : $bumper_data['username'];
		$bumper = ($forum_topic_data['topic_bumper'] == $forum_topic_data['topic_poster']) ? $bumper_name : $poster;

		$l_bumped_by = '<br /><br />' . sprintf($lang['bumped_by'], $bumper, create_date($board_config['default_dateformat'], $forum_topic_data['topic_last_post_time'], $board_config['board_timezone']));
	}
//-- fin mod : bump topic ------------------------------------------------------

//-- mod : post icon -----------------------------------------------------------
//-- add
	$post_subject = get_icon_title($postrow[$i]['post_icon']) . '&nbsp;' . $post_subject;
//-- fin mod : post icon -------------------------------------------------------

	//
	// Again this will be handled by the templating
	// code at some point
	//
	$row_color = ( !($i % 2) ) ? $theme['td_color1'] : $theme['td_color2'];
	$row_class = ( !($i % 2) ) ? $theme['td_class1'] : $theme['td_class2'];

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

//-- mod : birthday ------------------------------------------------------------
//-- add
		'POSTER_AGE' => $poster_age,
		'POSTER_CAKE' => $poster_cake,
//-- fin mod : birthday --------------------------------------------------------

//-- mod : gender --------------------------------------------------------------
//-- add
		'POSTER_GENDER' => $gender_image,
		'L_GENDER' => $lang['Gender'],
//-- fin mod : gender ----------------------------------------------------------

		'POSTER_RANK' => $poster_rank,
		'RANK_IMAGE' => $rank_image,
		'POSTER_JOINED' => $poster_joined,
		'POSTER_POSTS' => $poster_posts,

//-- mod : topics a user has started -------------------------------------------
//-- add
		'POSTER_TOPICS' => $poster_topics,
//-- fin mod : topics a user has started ---------------------------------------

		'POSTER_FROM' => $poster_from,
		'POSTER_AVATAR' => $poster_avatar,

//-- mod : online offline hidden -----------------------------------------------
//-- add
		'POSTER_ONLINE_STATUS_IMG' => $online_status_img,
		'POSTER_ONLINE_STATUS' => $online_status,
//-- fin mod : online offline hidden -------------------------------------------

		'POST_DATE' => $post_date,
		'POST_SUBJECT' => $post_subject,
		'MESSAGE' => $message,
		'SIGNATURE' => $user_sig,
		'EDITED_MESSAGE' => $l_edited_by,

//-- mod : mini card -----------------------------------------------------------
//-- add
		'WARN_RED_CARD' => $warn_red_card,
		'WARN_YELLOW_CARD' => $warn_yellow_card,
		'WARN_GREEN_CARD' => $warn_green_card,
		'WARN_CARDS' => $cards,
//-- fin mod : mini card -------------------------------------------------------

//-- mod : bump topic ----------------------------------------------------------
//-- add
		'BUMPED_MESSAGE' => $l_bumped_by,
//-- fin mod : bump topic ------------------------------------------------------

//-- mod : topics enhanced -----------------------------------------------------
//-- add
//-- topics nav buttons		
		'S_NUM_ROW' => $num_row,
		'S_NAV_BUTTONS' => $nav_buttons,
//-- minitime
		'I_MINITIME' => $images['icon_minitime'],
//-- fin mod : topics enhanced -------------------------------------------------

//-- mod : ip country flag -----------------------------------------------------
//-- add
		'FLAG' => $flag,
		'COUNTRY' => $country,
		'L_COUNTRY' => $lang['IP2Country'][$postrow[$i]['user_cf_iso3661_1']],
//-- fin mod : ip country flag -------------------------------------------------

		'MINI_POST_IMG' => $mini_post_img,
		'PROFILE_IMG' => $profile_img,
		'PROFILE' => $profile,
		'SEARCH_IMG' => $search_img,
		'SEARCH' => $search,
		'PM_IMG' => $pm_img,
		'PM' => $pm,
		'EMAIL_IMG' => $email_img,
		'EMAIL' => $email,
		'WWW_IMG' => $www_img,
		'WWW' => $www,
		'ICQ_STATUS_IMG' => $icq_status_img,
		'ICQ_IMG' => $icq_img,
		'ICQ' => $icq,
		'AIM_IMG' => $aim_img,
		'AIM' => $aim,
		'MSN_IMG' => $msn_img,
		'MSN' => $msn,

//-- mod : skype ---------------------------------------------------------------
//-- add
		'SKYPE_IMG' => $skype_img,
		'SKYPE' => $skype,
//-- fin mod : skype -----------------------------------------------------------

		'YIM_IMG' => $yim_img,
		'YIM' => $yim,
		'EDIT_IMG' => $edit_img,
		'EDIT' => $edit,
		'QUOTE_IMG' => $quote_img,
		'QUOTE' => $quote,
		'IP_IMG' => $ip_img,
		'IP' => $ip,
		'DELETE_IMG' => $delpost_img,
		'DELETE' => $delpost,

//-- mod : quick split ---------------------------------------------------------
//-- add
		'SPLIT_IMG' => $split_img,
		'SPLIT' => $split,
//-- fin mod : quick split -----------------------------------------------------

//-- mod : jail mod ------------------------------------------------------------
//-- add
		'CELLEDS' => $celleds,
//-- fin mod : jail mod --------------------------------------------------------

//-- mod : points system -------------------------------------------------------
//-- add
		'POINTS' => $user_points,
		'DONATE_POINTS' => $donate_points,
//-- fin mod : points system ---------------------------------------------------

//-- mod : quick post es -------------------------------------------------------
//-- add
		'I_QP_QUOTE' => $qp_quote_img,
//-- fin mod : quick post es ---------------------------------------------------

		'L_MINI_POST_ALT' => $mini_post_alt,

//-- mod : keep unread flags ---------------------------------------------------
//-- add
		'KEEP_UNREAD_IMG' => $keep_unread_img,
//-- fin mod : keep unread flags -----------------------------------------------

		'U_MINI_POST' => $mini_post_url,
		'U_POST_ID' => $postrow[$i]['post_id'])
	);
//-- mod : post description ----------------------------------------------------
//-- add
	display_sub_title('postrow', $post_sub_title, $board_config['sub_title_length']);
//-- fin mod : post description ------------------------------------------------
//-- mod : topics enhanced -----------------------------------------------------
//-- add
//-- split posts
	if ( $i != $total_posts - 1 )
	{
		$template->assign_block_vars('postrow.spacing', array());
	}
//-- fin mod : topics enhanced -------------------------------------------------
//-- mod : attachment mod ------------------------------------------------------
//-- add
	display_post_attachments($postrow[$i]['post_id'], $postrow[$i]['post_attachment']);
//-- fin mod : attachment mod --------------------------------------------------
}

$template->pparse('body');

include($phpbb_root_path . 'includes/page_tail.'.$phpEx);

?>
