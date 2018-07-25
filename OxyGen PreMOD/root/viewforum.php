<?php
/***************************************************************************
 *                               viewforum.php
 *                            -------------------
 *   begin                : Saturday, Feb 13, 2001
 *   copyright            : (C) 2001 The phpBB Group
 *   email                : support@phpbb.com
 *
 *   $Id: viewforum.php,v 1.139.2.12 2004/03/13 15:08:23 acydburn Exp $
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

define('IN_PHPBB', true);
$phpbb_root_path = './';
include($phpbb_root_path . 'extension.inc');
include($phpbb_root_path . 'common.'.$phpEx);

//-- mod : post icon -----------------------------------------------------------
//-- add
include($phpbb_root_path . 'includes/def_icons.'. $phpEx);
//-- fin mod : post icon -------------------------------------------------------

//-- mod : split topic type ----------------------------------------------------
//-- add
include_once($phpbb_root_path . 'includes/functions_topics_list.'. $phpEx);
//-- fin mod : split topic type ------------------------------------------------

//
// Start initial var setup
//
if ( isset($HTTP_GET_VARS[POST_FORUM_URL]) || isset($HTTP_POST_VARS[POST_FORUM_URL]) )
{
	$forum_id = ( isset($HTTP_GET_VARS[POST_FORUM_URL]) ) ? intval($HTTP_GET_VARS[POST_FORUM_URL]) : intval($HTTP_POST_VARS[POST_FORUM_URL]);
}
else if ( isset($HTTP_GET_VARS['forum']))
{
	$forum_id = intval($HTTP_GET_VARS['forum']);
}
else
{
	$forum_id = '';
}

$start = ( isset($HTTP_GET_VARS['start']) ) ? intval($HTTP_GET_VARS['start']) : 0;
$start = ($start < 0) ? 0 : $start;

if ( isset($HTTP_GET_VARS['mark']) || isset($HTTP_POST_VARS['mark']) )
{
	$mark_read = (isset($HTTP_POST_VARS['mark'])) ? $HTTP_POST_VARS['mark'] : $HTTP_GET_VARS['mark'];
}
else
{
	$mark_read = '';
}
//
// End initial var setup
//

//
// Check if the user has actually sent a forum ID with his/her request
// If not give them a nice error page.
//
if ( !empty($forum_id) )
{
	$sql = 'SELECT * FROM ' . FORUMS_TABLE . ' WHERE forum_id = ' . $forum_id;
	if ( !($result = $db->sql_query($sql)) )
	{
		message_die(GENERAL_ERROR, 'Could not obtain forums information', '', __LINE__, __FILE__, $sql);
	}
}
else
{
	message_die(GENERAL_MESSAGE, 'Forum_not_exist');
}

//
// If the query doesn't return any rows this isn't a valid forum. Inform
// the user.
//
if ( !($forum_row = $db->sql_fetchrow($result)) )
{
	message_die(GENERAL_MESSAGE, 'Forum_not_exist');
}

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

//
// Start auth check
//
$is_auth = array();
$is_auth = auth(AUTH_ALL, $forum_id, $userdata, $forum_row);

if ( !$is_auth['auth_read'] || !$is_auth['auth_view'] )
{
	if ( !$userdata['session_logged_in'] )
	{
		$redirect = POST_FORUM_URL . '=' . $forum_id . ( ( isset($start) ) ? '&start=' . $start : '' );
		redirect(append_sid('login.' . $phpEx . '?redirect=viewforum.' . $phpEx . '&' . $redirect, true));
	}
	//
	// The user is not authed to read this forum ...
	//
	$message = ( !$is_auth['auth_view'] ) ? $lang['Forum_not_exist'] : sprintf($lang['Sorry_auth_read'], $is_auth['auth_read_type']);

	message_die(GENERAL_MESSAGE, $message);
}
//
// End of auth check
//

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
		if( $forum_row['forum_password'] != '' )
		{
			password_check('forum', $forum_id, $HTTP_POST_VARS['password'], $redirect);
		}
	}

	$passdata = ( isset($HTTP_COOKIE_VARS[$board_config['cookie_name'] . '_fpass']) ) ? unserialize(stripslashes($HTTP_COOKIE_VARS[$board_config['cookie_name'] . '_fpass'])) : '';
	if( $forum_row['forum_password'] != '' && ($passdata[$forum_id] != md5($forum_row['forum_password'])) )
	{
		password_box('forum', $redirect);
	}
}
//-- fin mod : password protected forums ---------------------------------------

//-- mod : keep unread flags ---------------------------------------------------
//-- delete
/*-MOD
//
// Handle marking posts
//
if ( $mark_read == 'topics' )
{
	if ( $userdata['session_logged_in'] )
	{
		$sql = "SELECT MAX(post_time) AS last_post 
			FROM " . POSTS_TABLE . " 
			WHERE forum_id = $forum_id";
		if ( !($result = $db->sql_query($sql)) )
		{
			message_die(GENERAL_ERROR, 'Could not obtain forums information', '', __LINE__, __FILE__, $sql);
		}

		if ( $row = $db->sql_fetchrow($result) )
		{
			$tracking_forums = ( isset($HTTP_COOKIE_VARS[$board_config['cookie_name'] . '_f']) ) ? unserialize($HTTP_COOKIE_VARS[$board_config['cookie_name'] . '_f']) : array();
			$tracking_topics = ( isset($HTTP_COOKIE_VARS[$board_config['cookie_name'] . '_t']) ) ? unserialize($HTTP_COOKIE_VARS[$board_config['cookie_name'] . '_t']) : array();

			if ( ( count($tracking_forums) + count($tracking_topics) ) >= 150 && empty($tracking_forums[$forum_id]) )
			{
				asort($tracking_forums);
				unset($tracking_forums[key($tracking_forums)]);
			}

			if ( $row['last_post'] > $userdata['user_lastvisit'] )
			{
				$tracking_forums[$forum_id] = time();

				setcookie($board_config['cookie_name'] . '_f', serialize($tracking_forums), 0, $board_config['cookie_path'], $board_config['cookie_domain'], $board_config['cookie_secure']);
			}
		}

		$template->assign_vars(array(
			'META' => '<meta http-equiv="refresh" content="3;url=' . append_sid("viewforum.$phpEx?" . POST_FORUM_URL . "=$forum_id") . '">')
		);
	}

	$message = $lang['Topics_marked_read'] . '<br /><br />' . sprintf($lang['Click_return_forum'], '<a href="' . append_sid("viewforum.$phpEx?" . POST_FORUM_URL . "=$forum_id") . '">', '</a> ');
	message_die(GENERAL_MESSAGE, $message);
}
//
// End handle marking posts
//

$tracking_topics = ( isset($HTTP_COOKIE_VARS[$board_config['cookie_name'] . '_t']) ) ? unserialize($HTTP_COOKIE_VARS[$board_config['cookie_name'] . '_t']) : '';
$tracking_forums = ( isset($HTTP_COOKIE_VARS[$board_config['cookie_name'] . '_f']) ) ? unserialize($HTTP_COOKIE_VARS[$board_config['cookie_name'] . '_f']) : '';
MOD-*/
//-- add
if ( $mark_read == 'topics' )
{
//-- mod : simple subforums ----------------------------------------------------
//-- add
	$mark_list = ( isset($HTTP_GET_VARS['mark_list']) ) ? explode(',', $HTTP_GET_VARS['mark_list']) : array($forum_id);
	$old_forum_id = $forum_id;
//-- fin mod : simple subforums ------------------------------------------------

	$board_config['tracking_forums'][$forum_id] = time();
	$list_topics = implode(',', array_keys($board_config['tracking_unreads']));
	if ($list_topics)
	{
		$sql = 'SELECT topic_id
			FROM ' . TOPICS_TABLE . '
			WHERE topic_id IN (' . $list_topics . ')
			AND forum_id = ' . $forum_id . ' AND topic_moved_id = 0';
		if ( !$result = $db->sql_query($sql) )
		{
			message_die(GENERAL_ERROR, 'Could not access topics', '', __LINE__, __FILE__, $sql);
		}
		while ( $row = $db->sql_fetchrow($result) )
		{
			$id = $row['topic_id'];
			if ( isset($board_config['tracking_unreads'][$id]) )	unset($board_config['tracking_unreads'][$id]);
		}
	}
	write_cookies($userdata);

	$template->assign_vars(array(
		'META' => '<meta http-equiv="refresh" content="3;url=' . append_sid('index.'.$phpEx) . '">')
		);
	$message = $lang['Topics_marked_read'] . '<br /><br />' . sprintf($lang['Click_return_forum'], '<a href="' . append_sid('viewforum.'.$phpEx . '?' . POST_FORUM_URL . '=' . $forum_id) . '">', '</a> ');
	$message .= '<br /><br />' . sprintf($lang['Click_return_index'], '<a href="' . append_sid('index.'.$phpEx) . '">', '</a> ');
	message_die(GENERAL_MESSAGE, $message);
}
//-- fin mod : keep unread flags -----------------------------------------------

//
// Do the forum Prune
//
if ( $is_auth['auth_mod'] && $board_config['prune_enable'] )
{
	if ( $forum_row['prune_next'] < time() && $forum_row['prune_enable'] )
	{
		include($phpbb_root_path . 'includes/prune.'.$phpEx);
		require($phpbb_root_path . 'includes/functions_admin.'.$phpEx);
		auto_prune($forum_id);
	}
}
//
// End of forum prune
//

//-- mod : annonce globale -----------------------------------------------------
//-- add
// Is there any global announcement ?
if ( $board_config['annonce_globale_index'] )
{
	get_annonce_list();
}
//-- fin mod : annonce globale -------------------------------------------------

//
// Obtain list of moderators of each forum
// First users, then groups ... broken into two queries
//
$sql = 'SELECT u.user_id, u.username 
	FROM ' . AUTH_ACCESS_TABLE . ' aa, ' . USER_GROUP_TABLE . ' ug, ' . GROUPS_TABLE . ' g, ' . USERS_TABLE . ' u
	WHERE aa.forum_id = ' . $forum_id . '
		AND aa.auth_mod = ' . TRUE . ' 
		AND g.group_single_user = 1
		AND ug.group_id = aa.group_id 
		AND g.group_id = aa.group_id 
		AND u.user_id = ug.user_id 
	GROUP BY u.user_id, u.username  
	ORDER BY u.user_id';
//-- mod : rank color system ---------------------------------------------------
//-- add
$sql = str_replace('SELECT ', 'SELECT u.user_level, u.user_color, u.user_group_id, ', $sql);
//-- fin mod : rank color system -----------------------------------------------

//-- mod : ip country flag -----------------------------------------------------
//-- add
$sql = str_replace('SELECT ', 'SELECT u.user_cf_iso3661_1, ', $sql);
//-- fin mod : ip country flag -------------------------------------------------
if ( !($result = $db->sql_query($sql)) )
{
	message_die(GENERAL_ERROR, 'Could not query forum moderator information', '', __LINE__, __FILE__, $sql);
}

$moderators = array();
while( $row = $db->sql_fetchrow($result) )
{
//-- mod : rank color system ---------------------------------------------------
//-- delete
/*-MOD
	$moderators[] = '<a href="' . append_sid("profile.$phpEx?mode=viewprofile&amp;" . POST_USERS_URL . "=" . $row['user_id']) . '">' . $row['username'] . '</a>';
MOD-*/
//-- add
	$style_color = $rcs->get_colors($row);
	$moderators[] = '<a href="' . $get->url('profile', array('mode' => 'viewprofile', POST_USERS_URL => $row['user_id']), true) . '" title="' . $lang['Read_profile'] . '" ' . $style_color . '>' . $row['username'] . '</a>';
//-- fin mod : rank color system -----------------------------------------------
}

$sql = 'SELECT g.group_id, g.group_name 
	FROM ' . AUTH_ACCESS_TABLE . ' aa, ' . USER_GROUP_TABLE . ' ug, ' . GROUPS_TABLE . ' g 
	WHERE aa.forum_id = ' . $forum_id . '
		AND aa.auth_mod = ' . TRUE . ' 
		AND g.group_single_user = 0
		AND g.group_type <> '. GROUP_HIDDEN .'
		AND ug.group_id = aa.group_id 
		AND g.group_id = aa.group_id 
	GROUP BY g.group_id, g.group_name  
	ORDER BY g.group_id';
if ( !($result = $db->sql_query($sql)) )
{
	message_die(GENERAL_ERROR, 'Could not query forum moderator information', '', __LINE__, __FILE__, $sql);
}

while( $row = $db->sql_fetchrow($result) )
{
//-- mod : rank color system ---------------------------------------------------
//-- delete
/*-MOD
	$moderators[] = '<a href="' . append_sid("groupcp.$phpEx?" . POST_GROUPS_URL . "=" . $row['group_id']) . '">' . $row['group_name'] . '</a>';
MOD-*/
//-- add
	$style_color = $rcs->get_group_class($row['group_id']);
	$moderators[] = '<a href="' . $get->url('groupcp', array(POST_GROUPS_URL => $row['group_id']), true) . '"' . $style_color . '>' . $row['group_name'] . '</a>';
//-- fin mod : rank color system -----------------------------------------------
}
	
$l_moderators = ( count($moderators) == 1 ) ? $lang['Moderator'] : $lang['Moderators'];
$forum_moderators = ( count($moderators) ) ? implode(', ', $moderators) : $lang['None'];
unset($moderators);

//
// Generate a 'Show topics in previous x days' select box. If the topicsdays var is sent
// then get it's value, find the number of topics with dates newer than it (to properly
// handle pagination) and alter the main query
//
$previous_days = array(0, 1, 7, 14, 30, 90, 180, 364);
$previous_days_text = array($lang['All_Topics'], $lang['1_Day'], $lang['7_Days'], $lang['2_Weeks'], $lang['1_Month'], $lang['3_Months'], $lang['6_Months'], $lang['1_Year']);

if ( !empty($HTTP_POST_VARS['topicdays']) || !empty($HTTP_GET_VARS['topicdays']) )
{
	$topic_days = ( !empty($HTTP_POST_VARS['topicdays']) ) ? intval($HTTP_POST_VARS['topicdays']) : intval($HTTP_GET_VARS['topicdays']);
	$min_topic_time = time() - ($topic_days * 86400);

	$sql = 'SELECT COUNT(t.topic_id) AS forum_topics 
		FROM ' . TOPICS_TABLE . ' t, ' . POSTS_TABLE . ' p 
		WHERE t.forum_id = ' . $forum_id . ' 
			AND p.post_id = t.topic_last_post_id
			AND p.post_time >= ' . $min_topic_time;
	if ( !($result = $db->sql_query($sql)) )
	{
		message_die(GENERAL_ERROR, 'Could not obtain limited topics count information', '', __LINE__, __FILE__, $sql);
	}
	$row = $db->sql_fetchrow($result);

	$topics_count = ( $row['forum_topics'] ) ? $row['forum_topics'] : 1;
	$limit_topics_time = 'AND p.post_time >= ' . $min_topic_time;

	if ( !empty($HTTP_POST_VARS['topicdays']) )
	{
		$start = 0;
	}
}
else
{
	$topics_count = ( $forum_row['forum_topics'] ) ? $forum_row['forum_topics'] : 1;

	$limit_topics_time = '';
	$topic_days = 0;
}

$select_topic_days = '<select name="topicdays">';
for($i = 0; $i < count($previous_days); $i++)
{
	$selected = ($topic_days == $previous_days[$i]) ? ' selected="selected"' : '';
	$select_topic_days .= '<option value="' . $previous_days[$i] . '"' . $selected . '>' . $previous_days_text[$i] . '</option>';
}
$select_topic_days .= '</select>';


//
// All announcement data, this keeps announcements
// on each viewforum page ...
//
//-- mod : annonce globale -----------------------------------------------------
//-- delete
/*-MOD
$sql = "SELECT t.*, u.username, u.user_id, u2.username as user2, u2.user_id as id2, p.post_time, p.post_username
	FROM " . TOPICS_TABLE . " t, " . USERS_TABLE . " u, " . POSTS_TABLE . " p, " . USERS_TABLE . " u2
	WHERE t.forum_id = $forum_id 
		AND t.topic_poster = u.user_id
		AND p.post_id = t.topic_last_post_id
		AND p.poster_id = u2.user_id
		AND t.topic_type = " . POST_ANNOUNCE . " 
	ORDER BY t.topic_last_post_id DESC ";
MOD-*/
//-- add
$sql = "SELECT t.*, u.username, u.user_id, u2.username as user2, u2.user_id as id2, p.post_time, p.post_username, f.forum_name, f.forum_id
	FROM " . TOPICS_TABLE . " t, " . USERS_TABLE . " u, " . POSTS_TABLE . " p, " . USERS_TABLE . " u2, " . FORUMS_TABLE . " f
	WHERE (t.forum_id = $forum_id OR t.topic_type = " . POST_GLOBAL_ANNOUNCE . ") 
		AND t.topic_poster = u.user_id
		AND p.post_id = t.topic_last_post_id
		AND p.poster_id = u2.user_id
		AND (t.topic_type = " . POST_ANNOUNCE . " OR t.topic_type = " . POST_GLOBAL_ANNOUNCE . ") 
		AND f.forum_id = t.forum_id
	ORDER BY t.topic_type DESC, t.topic_last_post_id DESC";
//-- fin mod : annonce globale -------------------------------------------------

//-- mod : rank color system ---------------------------------------------------
//-- add
$sql = str_replace(', u.user_id', ', u.user_id, u.user_level, u.user_color, u.user_group_id', $sql);
$sql = str_replace(', u2.user_id as id2', ', u2.user_id as id2, u2.user_level as level2, u2.user_color as color2, u2.user_group_id as group_id2', $sql);
//-- fin mod : rank color system -----------------------------------------------

//-- mod : ip country flag -----------------------------------------------------
//-- add
$sql = str_replace('SELECT ', 'SELECT u.user_cf_iso3661_1, u2.user_cf_iso3661_1 as user2flag, ', $sql);
//-- fin mod : ip country flag -------------------------------------------------
if ( !($result = $db->sql_query($sql)) )
{
   message_die(GENERAL_ERROR, 'Could not obtain topic information', '', __LINE__, __FILE__, $sql);
}

$topic_rowset = array();
$total_announcements = 0;

//-- mod : annonce globale -----------------------------------------------------
//-- delete
/*-MOD
while( $row = $db->sql_fetchrow($result) )
{
	$topic_rowset[] = $row;
	$total_announcements++;
}
MOD-*/
//-- add
while( $row = $db->sql_fetchrow($result) )
{
	$is_auth = auth(AUTH_READ, $row['forum_id'], $userdata, $forum_topic_data);

	if( $is_auth['auth_read'] )
	{
		$topic_rowset[] = $row;
		$total_announcements++;
	}
}
//-- fin mod : annonce globale -------------------------------------------------

$db->sql_freeresult($result);

//
// Grab all the basic data (all topics except announcements)
// for this forum
//
//-- mod : topic display order -------------------------------------------------
//-- add
// default forum values
$dft_sort = $forum_row['forum_display_sort'];
$dft_order = $forum_row['forum_display_order'];

// Sort def
$sort_value = $dft_sort;
if ( isset($HTTP_GET_VARS['sort']) || isset($HTTP_POST_VARS['sort']) )
{
	$sort_value = isset($HTTP_GET_VARS['sort']) ? intval($HTTP_GET_VARS['sort']) : intval($HTTP_POST_VARS['sort']);
}
$sort_list = '<select name="sort">' . get_forum_display_sort_option($sort_value, 'list', 'sort') . '</select>';

// Order def
$order_value = $dft_order;
if ( isset($HTTP_GET_VARS['order']) || isset($HTTP_POST_VARS['order']) )
{
	$order_value = isset($HTTP_GET_VARS['order']) ? intval($HTTP_GET_VARS['order']) : intval($HTTP_POST_VARS['order']);
}
$order_list = '<select name="order">' . get_forum_display_sort_option($order_value, 'list', 'order') . '</select>';

// display
$s_display_order = '&nbsp;' . $lang['Sort_by'] . ':&nbsp;' . $sort_list . '&nbsp;' . $order_list . '&nbsp;';

// selected method
$sort_method = get_forum_display_sort_option($sort_value, 'field', 'sort');
$order_method = get_forum_display_sort_option($order_value, 'field', 'order');

// here we added 
//	, ' . $sort_method . ' ' . $order_method . '
//-- modify
//-- mod : annonce globale -----------------------------------------------------
// here we added
//	AND t.topic_type <> " . POST_GLOBAL_ANNOUNCE . " 
//-- modify
$sql = 'SELECT t.*, u.username, u.user_id, u2.username as user2, u2.user_id as id2, p.post_username, p2.post_username AS post_username2, p2.post_time 
	FROM ' . TOPICS_TABLE . ' t, ' . USERS_TABLE . ' u, ' . POSTS_TABLE . ' p, ' . POSTS_TABLE . ' p2, ' . USERS_TABLE . ' u2
	WHERE t.forum_id = ' . $forum_id . '
		AND t.topic_poster = u.user_id
		AND p.post_id = t.topic_first_post_id
		AND p2.post_id = t.topic_last_post_id
		AND u2.user_id = p2.poster_id 
		AND t.topic_type <> ' . POST_ANNOUNCE . '
		AND t.topic_type <> ' . POST_GLOBAL_ANNOUNCE . '
		' . $limit_topics_time . '
	ORDER BY t.topic_type DESC, ' . $sort_method . ' ' . $order_method . ', t.topic_last_post_id DESC 
	LIMIT ' . $start . ', ' . $board_config['topics_per_page'];
//-- fin mod : annonce globale -------------------------------------------------
//-- fin mod : topic display order ---------------------------------------------
//-- mod : rank color system ---------------------------------------------------
//-- add
$sql = str_replace(', u.user_id', ', u.user_id, u.user_level, u.user_color, u.user_group_id', $sql);
$sql = str_replace(', u2.user_id as id2', ', u2.user_id as id2, u2.user_level as level2, u2.user_color as color2, u2.user_group_id as group_id2', $sql);
//-- fin mod : rank color system -----------------------------------------------

//-- mod : ip country flag -----------------------------------------------------
//-- add
$sql = str_replace('SELECT ', 'SELECT u.user_cf_iso3661_1, u2.user_cf_iso3661_1 as user2flag, ', $sql);
//-- fin mod : ip country flag -------------------------------------------------

//-- mod : bump topic ----------------------------------------------------------
//-- add
$sql = str_replace(', t.topic_last_post_id DESC', ', p2.post_time DESC', $sql);
//-- fin mod : bump topic ------------------------------------------------------
if ( !($result = $db->sql_query($sql)) )
{
   message_die(GENERAL_ERROR, 'Could not obtain topic information', '', __LINE__, __FILE__, $sql);
}

$total_topics = 0;
while( $row = $db->sql_fetchrow($result) )
{
	$topic_rowset[] = $row;
	$total_topics++;
}

$db->sql_freeresult($result);

//
// Total topics ...
//
$total_topics += $total_announcements;

//
// Define censored word matches
//
$orig_word = array();
$replacement_word = array();
obtain_word_list($orig_word, $replacement_word);

//
// Post URL generation for templating vars
//
$template->assign_vars(array(
	'L_DISPLAY_TOPICS' => $lang['Display_topics'],

	'U_POST_NEW_TOPIC' => append_sid('posting.'.$phpEx . '?mode=newtopic&amp;' . POST_FORUM_URL . '=' . $forum_id),

	'S_SELECT_TOPIC_DAYS' => $select_topic_days,
	'S_POST_DAYS_ACTION' => append_sid('viewforum.'.$phpEx .'?' . POST_FORUM_URL . '=' . $forum_id . '&amp;start=' . $start))
);

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

if ( $is_auth['auth_mod'] )
{
	$s_auth_can .= sprintf($lang['Rules_moderate'], '<a href="' . 'modcp.'.$phpEx . '?' . POST_FORUM_URL . '='. $forum_id . '&amp;start=' . $start . '&amp;sid=' . $userdata['session_id'] . '">', '</a>');
}

//
// Mozilla navigation bar
//
$nav_links['up'] = array(
	'url' => append_sid('index.'.$phpEx),
	'title' => sprintf($lang['Forum_Index'], $board_config['sitename'])
);

//
// Dump out the page header and load viewforum template
//
define('SHOW_ONLINE', true);
$page_title = $lang['View_forum'] . ' - ' . $forum_row['forum_name'];
include($phpbb_root_path . 'includes/page_header.'.$phpEx);

//-- mod : toolbar -------------------------------------------------------------
//-- add
build_toolbar('viewforum', $l_privmsgs_text, $s_privmsg_new, $forum_id);
//-- fin mod : toolbar ---------------------------------------------------------

//-- mod : rank color system ---------------------------------------------------
//-- add
$rcs->display_legend();
//-- fin mod : rank color system -----------------------------------------------

$template->set_filenames(array(
//-- mod : forum as category ---------------------------------------------------
//-- delete
/*-MOD
	'body' => 'viewforum_body.tpl')
MOD-*/
//-- add
	'body' => ( $forum_row['forum_as_category'] ) ? 'forum_as_category_body.tpl' : 'viewforum_body.tpl' )
//-- fin mod : forum as category -----------------------------------------------
);

//-- mod : simple subforums ----------------------------------------------------
//-- delete
/*-MOD
make_jumpbox('viewforum.'.$phpEx);
MOD-*/
//-- add
$all_forums = array();
make_jumpbox_ref('viewforum.'.$phpEx, $forum_id, $all_forums);
//-- fin mod : simple subforums ------------------------------------------------

//-- mod : view category name --------------------------------------------------
//-- add
$cat_info = get_category($forum_id);
//-- fin mod : view category name ----------------------------------------------

$template->assign_vars(array(
//-- mod : view category name --------------------------------------------------
//-- add
	'CAT_NAME' => $cat_info['title'],
	'U_CAT' => append_sid($phpbb_root_path . 'index.'.$phpEx . '?' . POST_CAT_URL . '=' . $cat_info['id']),
//-- fin mod : view category name ----------------------------------------------

	'FORUM_ID' => $forum_id,
	'FORUM_NAME' => $forum_row['forum_name'],
	'MODERATORS' => $forum_moderators,
	'POST_IMG' => ( $forum_row['forum_status'] == FORUM_LOCKED ) ? $images['post_locked'] : $images['post_new'],

	'FOLDER_IMG' => $images['folder'],
	'FOLDER_NEW_IMG' => $images['folder_new'],
	'FOLDER_HOT_IMG' => $images['folder_hot'],
	'FOLDER_HOT_NEW_IMG' => $images['folder_hot_new'],
	'FOLDER_LOCKED_IMG' => $images['folder_locked'],
	'FOLDER_LOCKED_NEW_IMG' => $images['folder_locked_new'],
	'FOLDER_STICKY_IMG' => $images['folder_sticky'],
	'FOLDER_STICKY_NEW_IMG' => $images['folder_sticky_new'],
	'FOLDER_ANNOUNCE_IMG' => $images['folder_announce'],
	'FOLDER_ANNOUNCE_NEW_IMG' => $images['folder_announce_new'],

//-- mod : annonce globale -----------------------------------------------------
//-- add
	'FOLDER_GLOBAL_ANNOUNCE_IMG' => $images['folder_global_announce'],
	'FOLDER_GLOBAL_ANNOUNCE_NEW_IMG' => $images['folder_global_announce_new'],
	'L_GLOBAL_ANNOUNCEMENT' => $lang['Post_Global_Announcement'],
//-- fin mod : annonce globale -------------------------------------------------

	'L_TOPICS' => $lang['Topics'],
	'L_REPLIES' => $lang['Replies'],
	'L_VIEWS' => $lang['Views'],
	'L_POSTS' => $lang['Posts'],
	'L_LASTPOST' => $lang['Last_Post'], 
	'L_MODERATOR' => $l_moderators, 
	'L_MARK_TOPICS_READ' => $lang['Mark_all_topics'], 
	'L_POST_NEW_TOPIC' => ( $forum_row['forum_status'] == FORUM_LOCKED ) ? $lang['Forum_locked'] : $lang['Post_new_topic'], 
	'L_NO_NEW_POSTS' => $lang['No_new_posts'],
	'L_NEW_POSTS' => $lang['New_posts'],
	'L_NO_NEW_POSTS_LOCKED' => $lang['No_new_posts_locked'], 
	'L_NEW_POSTS_LOCKED' => $lang['New_posts_locked'], 
	'L_NO_NEW_POSTS_HOT' => $lang['No_new_posts_hot'],
	'L_NEW_POSTS_HOT' => $lang['New_posts_hot'],
	'L_ANNOUNCEMENT' => $lang['Post_Announcement'], 
	'L_STICKY' => $lang['Post_Sticky'], 
	'L_POSTED' => $lang['Posted'],
	'L_JOINED' => $lang['Joined'],
	'L_AUTHOR' => $lang['Author'],

//-- mod : first topic date ----------------------------------------------------
//-- add
	'L_CREATE_DATE'		=> $lang['Create_Date'],
//-- fin mod : first topic date ------------------------------------------------

	'S_AUTH_LIST' => $s_auth_can, 

	'U_VIEW_FORUM' => append_sid('viewforum.'.$phpEx . '?' . POST_FORUM_URL . '=' . $forum_id),

	'U_MARK_READ' => append_sid('viewforum.'.$phpEx . '?' . POST_FORUM_URL . '=' . $forum_id . '&amp;mark=topics'))
);
//
// End header
//

//-- mod : simple subforums ----------------------------------------------------
//-- add
if( $forum_row['forum_parent'] )
{
	$parent_id = $forum_row['forum_parent'];
	for( $i = 0; $i < count($all_forums); $i++ )
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
else
{
	$sub_list = array();
	for( $i = 0; $i < count($all_forums); $i++ )
	{
		if( $all_forums[$i]['forum_parent'] == $forum_id )
		{
			$sub_list[] = $all_forums[$i]['forum_id'];
		}
	}
	if( count($sub_list) )
	{
		$sub_list[] = $forum_id;
		$template->vars['U_MARK_READ'] .= '&amp;mark_list=' . implode(',', $sub_list);
	}
}
// assign additional variables for subforums mod
$template->assign_vars(array(
	'NUM_TOPICS' => $forum_row['forum_topics'],
	'CAN_POST' => $is_auth['auth_post'] ? 1 : 0,
	'L_FORUM' => $lang['Forum'],
));
//-- fin mod : simple subforums ------------------------------------------------

//-- mod : split topic type ----------------------------------------------------
//-- add
// adjust the item id
for ($i=0; $i < count($topic_rowset); $i++)
{
	$topic_rowset[$i]['topic_id'] = POST_TOPIC_URL . $topic_rowset[$i]['topic_id'];
}

// set the bottom sort option
$footer = $lang['Display_topics'] . ':&nbsp;' . $select_topic_days . '&nbsp;' . ( !empty($s_display_order) ? $s_display_order : '') . '<input type="submit" class="liteoption" value="' . $lang['Go'] . '" name="submit" />';

// send the list
$allow_split_type = true;
$display_nav_tree = false;
topic_list('TOPICS_LIST_BOX', 'topics_list_box', $topic_rowset, '', $allow_split_type, $display_nav_tree, $footer);
//-- delete
/*-MOD
//
// Okay, lets dump out the page ...
//
if( $total_topics )
{
	for($i = 0; $i < $total_topics; $i++)
	{
		$topic_id = $topic_rowset[$i]['topic_id'];

		$topic_title = ( count($orig_word) ) ? preg_replace($orig_word, $replacement_word, $topic_rowset[$i]['topic_title']) : $topic_rowset[$i]['topic_title'];

		$replies = $topic_rowset[$i]['topic_replies'];

		$topic_type = $topic_rowset[$i]['topic_type'];

		if( $topic_type == POST_ANNOUNCE )
		{
			$topic_type = $lang['Topic_Announcement'] . ' ';
		}
		else if( $topic_type == POST_STICKY )
		{
			$topic_type = $lang['Topic_Sticky'] . ' ';
		}
		else
		{
			$topic_type = '';		
		}

		if( $topic_rowset[$i]['topic_vote'] )
		{
			$topic_type .= $lang['Topic_Poll'] . ' ';
		}
		
		if( $topic_rowset[$i]['topic_status'] == TOPIC_MOVED )
		{
			$topic_type = $lang['Topic_Moved'] . ' ';
			$topic_id = $topic_rowset[$i]['topic_moved_id'];

			$folder_image =  $images['folder'];
			$folder_alt = $lang['Topics_Moved'];
			$newest_post_img = '';
		}
		else
		{
			if( $topic_rowset[$i]['topic_type'] == POST_ANNOUNCE )
			{
				$folder = $images['folder_announce'];
				$folder_new = $images['folder_announce_new'];
			}
			else if( $topic_rowset[$i]['topic_type'] == POST_STICKY )
			{
				$folder = $images['folder_sticky'];
				$folder_new = $images['folder_sticky_new'];
			}
			else if( $topic_rowset[$i]['topic_status'] == TOPIC_LOCKED )
			{
				$folder = $images['folder_locked'];
				$folder_new = $images['folder_locked_new'];
			}
			else
			{
				if($replies >= $board_config['hot_threshold'])
				{
					$folder = $images['folder_hot'];
					$folder_new = $images['folder_hot_new'];
				}
				else
				{
					$folder = $images['folder'];
					$folder_new = $images['folder_new'];
				}
			}

			$newest_post_img = '';
			if( $userdata['session_logged_in'] )
			{
				if( $topic_rowset[$i]['post_time'] > $userdata['user_lastvisit'] ) 
				{
					if( !empty($tracking_topics) || !empty($tracking_forums) || isset($HTTP_COOKIE_VARS[$board_config['cookie_name'] . '_f_all']) )
					{
						$unread_topics = true;

						if( !empty($tracking_topics[$topic_id]) )
						{
							if( $tracking_topics[$topic_id] >= $topic_rowset[$i]['post_time'] )
							{
								$unread_topics = false;
							}
						}

						if( !empty($tracking_forums[$forum_id]) )
						{
							if( $tracking_forums[$forum_id] >= $topic_rowset[$i]['post_time'] )
							{
								$unread_topics = false;
							}
						}

						if( isset($HTTP_COOKIE_VARS[$board_config['cookie_name'] . '_f_all']) )
						{
							if( $HTTP_COOKIE_VARS[$board_config['cookie_name'] . '_f_all'] >= $topic_rowset[$i]['post_time'] )
							{
								$unread_topics = false;
							}
						}

						if( $unread_topics )
						{
							$folder_image = $folder_new;
							$folder_alt = $lang['New_posts'];

							$newest_post_img = '<a href="' . append_sid("viewtopic.$phpEx?" . POST_TOPIC_URL . "=$topic_id&amp;view=newest") . '"><img src="' . $images['icon_newest_reply'] . '" alt="' . $lang['View_newest_post'] . '" title="' . $lang['View_newest_post'] . '" border="0" /></a> ';
						}
						else
						{
							$folder_image = $folder;
							$folder_alt = ( $topic_rowset[$i]['topic_status'] == TOPIC_LOCKED ) ? $lang['Topic_locked'] : $lang['No_new_posts'];

							$newest_post_img = '';
						}
					}
					else
					{
						$folder_image = $folder_new;
						$folder_alt = ( $topic_rowset[$i]['topic_status'] == TOPIC_LOCKED ) ? $lang['Topic_locked'] : $lang['New_posts'];

						$newest_post_img = '<a href="' . append_sid("viewtopic.$phpEx?" . POST_TOPIC_URL . "=$topic_id&amp;view=newest") . '"><img src="' . $images['icon_newest_reply'] . '" alt="' . $lang['View_newest_post'] . '" title="' . $lang['View_newest_post'] . '" border="0" /></a> ';
					}
				}
				else 
				{
					$folder_image = $folder;
					$folder_alt = ( $topic_rowset[$i]['topic_status'] == TOPIC_LOCKED ) ? $lang['Topic_locked'] : $lang['No_new_posts'];

					$newest_post_img = '';
				}
			}
			else
			{
				$folder_image = $folder;
				$folder_alt = ( $topic_rowset[$i]['topic_status'] == TOPIC_LOCKED ) ? $lang['Topic_locked'] : $lang['No_new_posts'];

				$newest_post_img = '';
			}
		}

		if( ( $replies + 1 ) > $board_config['posts_per_page'] )
		{
			$total_pages = ceil( ( $replies + 1 ) / $board_config['posts_per_page'] );
			$goto_page = ' [ <img src="' . $images['icon_gotopost'] . '" alt="' . $lang['Goto_page'] . '" title="' . $lang['Goto_page'] . '" />' . $lang['Goto_page'] . ': ';

			$times = 1;
			for($j = 0; $j < $replies + 1; $j += $board_config['posts_per_page'])
			{
				$goto_page .= '<a href="' . append_sid('viewtopic.'.$phpEx . '?' . POST_TOPIC_URL . '=' . $topic_id . '&amp;start=' . $j) . '">' . $times . '</a>';
				if( $times == 1 && $total_pages > 4 )
				{
					$goto_page .= ' ... ';
					$times = $total_pages - 3;
					$j += ( $total_pages - 4 ) * $board_config['posts_per_page'];
				}
				else if ( $times < $total_pages )
				{
					$goto_page .= ', ';
				}
				$times++;
			}
			$goto_page .= ' ] ';
		}
		else
		{
			$goto_page = '';
		}
		
		$view_topic_url = append_sid("viewtopic.$phpEx?" . POST_TOPIC_URL . "=$topic_id");

		$topic_author = ( $topic_rowset[$i]['user_id'] != ANONYMOUS ) ? '<a href="' . append_sid("profile.$phpEx?mode=viewprofile&amp;" . POST_USERS_URL . '=' . $topic_rowset[$i]['user_id']) . '">' : '';

		$topic_author .= ( $topic_rowset[$i]['user_id'] != ANONYMOUS ) ? $topic_rowset[$i]['username'] : ( ( $topic_rowset[$i]['post_username'] != '' ) ? $topic_rowset[$i]['post_username'] : $lang['Guest'] );

		$topic_author .= ( $topic_rowset[$i]['user_id'] != ANONYMOUS ) ? '</a>' : '';

		$first_post_time = create_date($board_config['default_dateformat'], $topic_rowset[$i]['topic_time'], $board_config['board_timezone']);

		$last_post_time = create_date($board_config['default_dateformat'], $topic_rowset[$i]['post_time'], $board_config['board_timezone']);

		$last_post_author = ( $topic_rowset[$i]['id2'] == ANONYMOUS ) ? ( ($topic_rowset[$i]['post_username2'] != '' ) ? $topic_rowset[$i]['post_username2'] . ' ' : $lang['Guest'] . ' ' ) : '<a href="' . append_sid("profile.$phpEx?mode=viewprofile&amp;" . POST_USERS_URL . '='  . $topic_rowset[$i]['id2']) . '">' . $topic_rowset[$i]['user2'] . '</a>';

		$last_post_url = '<a href="' . append_sid('viewtopic.'.$phpEx . '?'  . POST_POST_URL . '=' . $topic_rowset[$i]['topic_last_post_id']) . '#' . $topic_rowset[$i]['topic_last_post_id'] . '"><img src="' . $images['icon_latest_reply'] . '" alt="' . $lang['View_latest_post'] . '" title="' . $lang['View_latest_post'] . '" border="0" /></a>';

		$views = $topic_rowset[$i]['topic_views'];
		
		$row_color = ( !($i % 2) ) ? $theme['td_color1'] : $theme['td_color2'];
		$row_class = ( !($i % 2) ) ? $theme['td_class1'] : $theme['td_class2'];

		$template->assign_block_vars('topicrow', array(
			'ROW_COLOR' => $row_color,
			'ROW_CLASS' => $row_class,
			'FORUM_ID' => $forum_id,
			'TOPIC_ID' => $topic_id,
			'TOPIC_FOLDER_IMG' => $folder_image,
			'TOPIC_AUTHOR' => $topic_author, 
			'GOTO_PAGE' => $goto_page,
			'REPLIES' => $replies,
			'NEWEST_POST_IMG' => $newest_post_img, 
			'TOPIC_TITLE' => $topic_title,
			'TOPIC_TYPE' => $topic_type,
			'VIEWS' => $views,
			'FIRST_POST_TIME' => $first_post_time, 
			'LAST_POST_TIME' => $last_post_time, 
			'LAST_POST_AUTHOR' => $last_post_author, 
			'LAST_POST_IMG' => $last_post_url, 

			'L_TOPIC_FOLDER_ALT' => $folder_alt, 

			'U_VIEW_TOPIC' => $view_topic_url)
		);
	}
MOD-*/
//-- fin mod : split topic type ------------------------------------------------

	$topics_count -= $total_announcements;

	$template->assign_vars(array(
//-- mod : topic display order -------------------------------------------------
// here we added 
//	&amp;sort=$sort_value&amp;order=$order_value
//-- modify
		'PAGINATION' => generate_pagination('viewforum.'.$phpEx . '?' . POST_FORUM_URL . '=' . $forum_id . '&amp;topicdays=' . $topic_days . '&amp;sort=' . $sort_value . '&amp;order=' . $order_value, $topics_count, $board_config['topics_per_page'], $start),
//-- fin mod : topic display order ---------------------------------------------
		'PAGE_NUMBER' => sprintf($lang['Page_of'], ( floor( $start / $board_config['topics_per_page'] ) + 1 ), ceil( $topics_count / $board_config['topics_per_page'] )), 

		'L_GOTO_PAGE' => $lang['Goto_page'])
	);

//-- mod : split topic type ----------------------------------------------------
//-- delete
/*-MOD
}
else
{
	//
	// No topics
	//
	$no_topics_msg = ( $forum_row['forum_status'] == FORUM_LOCKED ) ? $lang['Forum_locked'] : $lang['No_topics_post_one'];
	$template->assign_vars(array(
		'L_NO_TOPICS' => $no_topics_msg)
	);

	$template->assign_block_vars('switch_no_topics', array() );
}
MOD-*/
//-- fin mod : split topic type ------------------------------------------------

//-- mod : simple subforums ----------------------------------------------------
//-- add
switch(SQL_LAYER)
{
	default:
//-- mod : today-yesterday mod -------------------------------------------------
//-- delete
/*-MOD
		$sql = 'SELECT f.*, p.post_time, p.post_username, u.username, u.user_id
			FROM (( ' . FORUMS_TABLE . ' f
			LEFT JOIN ' . POSTS_TABLE . ' p ON p.post_id = f.forum_last_post_id )
			LEFT JOIN ' . USERS_TABLE . " u ON u.user_id = p.poster_id )
			WHERE f.forum_parent = {$forum_id}
			ORDER BY f.cat_id, f.forum_order";
MOD-*/
//-- add
		$sql = 'SELECT f.*, p.post_time, p.post_username, u.username, u.user_id, t.topic_title, t.topic_id 
			FROM ((( ' . FORUMS_TABLE . ' f
			LEFT JOIN ' . POSTS_TABLE . ' p ON p.post_id = f.forum_last_post_id )
			LEFT JOIN ' . TOPICS_TABLE . ' t ON t.topic_id = p.topic_id )  
			LEFT JOIN ' . USERS_TABLE . " u ON u.user_id = p.poster_id )
			WHERE f.forum_parent = '{$forum_id}'
			ORDER BY f.cat_id, f.forum_order";
//-- fin mod : today-yesterday mod ---------------------------------------------
		break;
}
//-- mod : rank color system ---------------------------------------------------
//-- add
$sql = str_replace(', u.user_id', ', u.user_id, u.user_level, u.user_color, u.user_group_id', $sql);
//-- fin mod : rank color system -----------------------------------------------
//-- mod : ip country flag -----------------------------------------------------
//-- add
$sql = str_replace(', u.user_id', ', u.user_id, u.user_cf_iso3661_1', $sql);
//-- fin mod : ip country flag -------------------------------------------------
if ( !($result = $db->sql_query($sql)) )
{
	message_die(GENERAL_ERROR, 'Could not query subforums information', '', __LINE__, __FILE__, $sql);
}

$subforum_data = array();
while( $row = $db->sql_fetchrow($result) )
{
	$subforum_data[] = $row;
}
$db->sql_freeresult($result);

if ( ($total_forums = count($subforum_data)) > 0 )
{
	//
	// Find which forums are visible for this user
	//
	$is_auth_ary = array();
	$is_auth_ary = auth(AUTH_VIEW, AUTH_LIST_ALL, $userdata, $subforum_data);

	$display_forums = false;
	for( $j = 0; $j < $total_forums; $j++ )
	{
		if ( $is_auth_ary[$subforum_data[$j]['forum_id']]['auth_view'] )
		{
			$display_forums = true;
		}
	}
	
	if( !$display_forums )
	{
		$total_forums = 0;
	}
}

if( $total_forums )
{
	$template->assign_var('HAS_SUBFORUMS', 1);
	$template->assign_block_vars('catrow', array(
		'CAT_ID'	=> $forum_id,
		'CAT_DESC'	=> $forum_row['forum_name'],
		'U_VIEWCAT' => append_sid('viewforum.'.$phpEx . '?' . POST_FORUM_URL . '=' . $forum_id),
		));

//-- mod : keep unread flags ---------------------------------------------------
//-- delete
/*-MOD
	//
	// Obtain a list of topic ids which contain
	// posts made since user last visited
	//
	if ( $userdata['session_logged_in'] )
	{
		$sql = "SELECT t.forum_id, t.topic_id, p.post_time 
			FROM " . TOPICS_TABLE . " t, " . POSTS_TABLE . " p 
			WHERE p.post_id = t.topic_last_post_id 
				AND p.post_time > " . $userdata['user_lastvisit'] . " 
				AND t.topic_moved_id = 0"; 
		if ( !($result = $db->sql_query($sql)) )
		{
			message_die(GENERAL_ERROR, 'Could not query new topic information', '', __LINE__, __FILE__, $sql);
		}

		$new_topic_data = array();
		while( $topic_data = $db->sql_fetchrow($result) )
		{
			$new_topic_data[$topic_data['forum_id']][$topic_data['topic_id']] = $topic_data['post_time'];
		}
		$db->sql_freeresult($result);
	}
MOD-*/
//-- add
	$new_unreads = list_new_unreads($forum_unreads);
//-- fin mod : keep unread flags -----------------------------------------------

	//
	// Obtain list of moderators of each forum
	// First users, then groups ... broken into two queries
	//
	$subforum_moderators = array();
	$sql = 'SELECT aa.forum_id, u.user_id, u.username 
		FROM ' . AUTH_ACCESS_TABLE . ' aa, ' . USER_GROUP_TABLE . ' ug, ' . GROUPS_TABLE . ' g, ' . USERS_TABLE . ' u
		WHERE aa.auth_mod = ' . TRUE . ' 
			AND g.group_single_user = 1 
			AND ug.group_id = aa.group_id 
			AND g.group_id = aa.group_id 
			AND u.user_id = ug.user_id 
		GROUP BY u.user_id, u.username, aa.forum_id 
		ORDER BY aa.forum_id, u.user_id';
//-- mod : rank color system ---------------------------------------------------
//-- add
	$sql = str_replace(', u.user_id', ', u.user_id, u.user_level, u.user_color, u.user_group_id', $sql);
//-- fin mod : rank color system -----------------------------------------------
//-- mod : ip country flag -----------------------------------------------------
//-- add
	$sql = str_replace(', u.user_id', ', u.user_id, u.user_cf_iso3661_1', $sql);
//-- fin mod : ip country flag -------------------------------------------------
	if ( !($result = $db->sql_query($sql, false, true)) )
	{
		message_die(GENERAL_ERROR, 'Could not query forum moderator information', '', __LINE__, __FILE__, $sql);
	}

	while( $row = $db->sql_fetchrow($result) )
	{
//-- mod : rank color system ---------------------------------------------------
//-- delete
/*-MOD
		$subforum_moderators[$row['forum_id']][] = '<a href="' . append_sid("profile.$phpEx?mode=viewprofile&amp;" . POST_USERS_URL . "=" . $row['user_id']) . '">' . $row['username'] . '</a>';
MOD-*/
//-- add
		$style_color = $rcs->get_colors($row);
		$subforum_moderators[$row['forum_id']][] = '<a href="' . $get->url('profile', array('mode' => 'viewprofile', POST_USERS_URL => $row['user_id']), true) . '" title="' . $lang['Read_profile'] . '" ' . $style_color . '>' . $row['username'] . '</a>';
//-- fin mod : rank color system -----------------------------------------------
	}
	$db->sql_freeresult($result);
	
	$sql = 'SELECT aa.forum_id, g.group_id, g.group_name 
		FROM ' . AUTH_ACCESS_TABLE . ' aa, ' . USER_GROUP_TABLE . ' ug, ' . GROUPS_TABLE . ' g 
		WHERE aa.auth_mod = ' . TRUE . ' 
			AND g.group_single_user = 0 
			AND g.group_type <> ' . GROUP_HIDDEN . '
			AND ug.group_id = aa.group_id 
			AND g.group_id = aa.group_id 
		GROUP BY g.group_id, g.group_name, aa.forum_id 
		ORDER BY aa.forum_id, g.group_id';
	if ( !($result = $db->sql_query($sql, false, true)) )
	{
		message_die(GENERAL_ERROR, 'Could not query forum moderator information', '', __LINE__, __FILE__, $sql);
	}

	while( $row = $db->sql_fetchrow($result) )
	{
//-- mod : rank color system ---------------------------------------------------
//-- delete
/*-MOD
		$subforum_moderators[$row['forum_id']][] = '<a href="' . append_sid("groupcp.$phpEx?" . POST_GROUPS_URL . "=" . $row['group_id']) . '">' . 	$row['group_name'] . '</a>';
MOD-*/
//-- add
		$style_color = $rcs->get_group_class($row['group_id']);
		$subforum_moderators[$row['forum_id']][] = '<a href="' . $get->url('groupcp', array(POST_GROUPS_URL => $row['group_id']), true) . '"' . $style_color . '>' . $row['group_name'] . '</a>';
//-- fin mod : rank color system -----------------------------------------------
	}
	$db->sql_freeresult($result);

	// show subforums
	for( $j = 0; $j < $total_forums; $j++ )
	{
		$subforum_id = $subforum_data[$j]['forum_id'];

		if ( $is_auth_ary[$subforum_id]['auth_view'] )
		{
			$unread_topics = false;
			if ( $subforum_data[$j]['forum_status'] == FORUM_LOCKED )
			{
				$folder_image = $images['forum_locked']; 
				$folder_alt = $lang['Forum_is_locked'];
			}
//-- mod : keep unread flags ---------------------------------------------------
//-- delete
/*-MOD
			else
			{
				if ( $userdata['session_logged_in'] )
				{
					if ( !empty($new_topic_data[$subforum_id]) )
					{
						$subforum_last_post_time = 0;

						while( list($check_topic_id, $check_post_time) = @each($new_topic_data[$subforum_id]) )
						{
							if ( empty($tracking_topics[$check_topic_id]) )
							{
								$unread_topics = true;
								$subforum_last_post_time = max($check_post_time, $subforum_last_post_time);
							}
							else
							{
								if ( $tracking_topics[$check_topic_id] < $check_post_time )
								{
									$unread_topics = true;
									$subforum_last_post_time = max($check_post_time, $subforum_last_post_time);
								}
							}
						}
						if ( !empty($tracking_forums[$subforum_id]) )
						{
							if ( $tracking_forums[$subforum_id] > $subforum_last_post_time )
							{
								$unread_topics = false;
							}
						}
						if ( isset($HTTP_COOKIE_VARS[$board_config['cookie_name'] . '_f_all']) )
						{
							if ( $HTTP_COOKIE_VARS[$board_config['cookie_name'] . '_f_all'] > $subforum_last_post_time )
							{
								$unread_topics = false;
							}
						}

					}
				}

				$folder_image = ( $unread_topics ) ? $images['forum_new'] : $images['forum']; 
				$folder_alt = ( $unread_topics ) ? $lang['New_posts'] : $lang['No_new_posts']; 
			}
MOD-*/
//-- add
			else
			{
				$unread_topics = $forum_unreads[$subforum_id];
//-- mod : forumtitle as weblink -----------------------------------------------
//-- delete
/*-MOD
				$folder_image = ( $unread_topics ) ? $images['forum_new'] : $images['forum'];
				$folder_alt = ( $unread_topics ) ? $lang['New_posts'] : $lang['No_new_posts'];
MOD-*/
//-- add
				if( $subforum_data[$j]['title_is_link'] )
				{
					$folder_alt = $lang['Forum_is_a_link'];
					$folder_image = $images['forum_link'];
				}
				else if( $unread_topics )
				{
					$folder_alt = $lang['New_posts'];
					$folder_image = $images['forum_new'];
				}
				else
				{
					$folder_alt = $lang['No_new_posts'];
					$folder_image = $images['forum'];
				}
//-- fin mod : forumtitle as weblink -------------------------------------------
			}
//-- fin mod : keep unread flags -----------------------------------------------

			$posts = $subforum_data[$j]['forum_posts'];
			$topics = $subforum_data[$j]['forum_topics'];
//-- mod : forum icon with acp control -----------------------------------------
//-- add
			$icon = $subforum_data[$j]['forum_icon'];
//-- fin mod : forum icon with acp control -------------------------------------

			if ( $subforum_data[$j]['forum_last_post_id'] )
			{
//-- mod : last active topic on index ------------------------------------------
//-- add
				$last_post = (strlen($subforum_data[$j]['topic_title']) > $board_config['last_topic_title_length']) ? '<a href="' . append_sid('viewtopic.'.$phpEx . '?' . POST_TOPIC_URL . '=' . $subforum_data[$j]['topic_id']) . '" title="' . $subforum_data[$j]['topic_title'] . '">' . substr($subforum_data[$j]['topic_title'], 0, $board_config['last_topic_title_length']) . '...</a><br />' : '<a href="' . append_sid('viewtopic.'.$phpEx . '?' . POST_TOPIC_URL . '=' . $subforum_data[$j]['topic_id']) . '" title="' . $subforum_data[$j]['topic_title'] . '">' . $subforum_data[$j]['topic_title'] . '</a><br />';
//-- fin mod : last active topic on index --------------------------------------

				$last_post_time = create_date($board_config['default_dateformat'], $subforum_data[$j]['post_time'], $board_config['board_timezone']);

//-- mod : today-yesterday mod -------------------------------------------------
//-- delete
/*-MOD
				$last_post = $last_post_time . '<br />';
MOD-*/
//-- add
				$last_post .= '<span class="date-general">' . $last_post_time . '</span><br />';
//-- fin mod : today-yesterday mod ---------------------------------------------

//-- mod : ip country flag -----------------------------------------------------
//-- add
				$lastpost_iso3661_1 = $subforum_data[$j]['user_cf_iso3661_1'];
				$last_post .= '<img src="images/flags/small/' . $lastpost_iso3661_1 . '.png" width="14" height="9" alt="' . $lang['IP2Country'][$lastpost_iso3661_1] . '" title="' . $lang['IP2Country'][$lastpost_iso3661_1] . '" />&nbsp;';
//-- fin mod : ip country flag -------------------------------------------------

//-- mod : rank color system ---------------------------------------------------
//-- delete
/*-MOD
				$last_post .= ( $subforum_data[$j]['user_id'] == ANONYMOUS ) ? ( ($subforum_data[$j]['post_username'] != '' ) ? $subforum_data[$j]['post_username'] . ' ' : $lang['Guest'] . ' ' ) : '<a href="' . append_sid("profile.$phpEx?mode=viewprofile&amp;" . POST_USERS_URL . '='  . $subforum_data[$j]['user_id']) . '">' . $subforum_data[$j]['username'] . '</a> ';
MOD-*/
//-- add
				$style_color = $rcs->get_colors($subforum_data[$j]);
				$last_post .= ($subforum_data[$j]['user_id'] == ANONYMOUS) ? ((($subforum_data[$j]['post_username'] != '') ? $subforum_data[$j]['post_username'] : $lang['Guest']) . '&nbsp;') : '<a href="' . $get->url('profile', array('mode' => 'viewprofile', POST_USERS_URL => $subforum_data[$j]['user_id']), true) . '" title="' . $lang['Read_profile'] . '" ' . $style_color . '>' . $subforum_data[$j]['username'] . '</a>&nbsp;';
//-- fin mod : rank color system -----------------------------------------------

				$last_post .= '<a href="' . append_sid('viewtopic.'.$phpEx . '?'  . POST_POST_URL . '=' . $subforum_data[$j]['forum_last_post_id']) . '#' . $subforum_data[$j]['forum_last_post_id'] . '"><img src="' . $images['icon_latest_reply'] . '" border="0" alt="' . $lang['View_latest_post'] . '" title="' . $lang['View_latest_post'] . '" /></a>';
			}
			else
			{
				$last_post = $lang['No_Posts'];
			}

			if ( count($subforum_moderators[$subforum_id]) > 0 )
			{
				$l_moderators = ( count($subforum_moderators[$subforum_id]) == 1 ) ? $lang['Moderator'] : $lang['Moderators'];
				$moderator_list = implode(', ', $subforum_moderators[$subforum_id]);
			}
			else
			{
				$l_moderators = '&nbsp;';
				$moderator_list = '';
			}

			$row_color = ( !($i % 2) ) ? $theme['td_color1'] : $theme['td_color2'];
			$row_class = ( !($i % 2) ) ? $theme['td_class1'] : $theme['td_class2'];

			$template->assign_block_vars('catrow.forumrow',	array(
				'ROW_COLOR' => '#' . $row_color,
				'ROW_CLASS' => $row_class,
				'FORUM_FOLDER_IMG' => $folder_image,
//-- mod : hypercell class -----------------------------------------------------
//-- add
				'HYPERCELL_CLASS' => get_hypercell_class($subforum_data[$j]['forum_status'], ($unread_topics || $unread_topic), 0, 0, $subforum_data[$j]['title_is_link']),
//-- fin mod : hypercell class -------------------------------------------------
//-- mod : forum icon with acp control -----------------------------------------
//-- add
				'FORUM_ICON_IMG' => ($icon) ? '<img src="' . $phpbb_root_path . $board_config['forum_icon_path'] . '/' . $icon . '" alt="' . $subforum_data[$j]['forum_name'] . '" title="' . $subforum_data[$j]['forum_name'] . '" border="0" />' : '',
//-- fin mod : forum icon with acp control -------------------------------------
//-- mod : forumtitle as weblink -----------------------------------------------
//-- add
				'FORUM_LINK_COUNT' => ($subforum_data[$j]['title_is_link']) ? sprintf($lang['Forum_link_count'], $subforum_data[$j]['forum_link_count']) : '',
				'FORUM_LINK_TARGET' => ($subforum_data[$j]['forum_link_target']) ? 'target="_blank"' : '',
//-- fin mod : forumtitle as weblink ------------------------------------------- 
				'FORUM_NAME' => $subforum_data[$j]['forum_name'],
//-- mod : colorize forum title ------------------------------------------------
//-- add
				'FORUM_COLOR' => (!empty($subforum_data[$j]['forum_color'])) ? 'style="color: #' . $subforum_data[$j]['forum_color'] . '"' : '',
//-- fin mod : colorize forum title --------------------------------------------
				'FORUM_DESC' => $subforum_data[$j]['forum_desc'],
				'POSTS' => $subforum_data[$j]['forum_posts'],
				'TOPICS' => $subforum_data[$j]['forum_topics'],
				'LAST_POST' => $last_post,
				'MODERATORS' => $moderator_list,
				'ID' => $subforum_data[$j]['forum_id'],
				'UNREAD' => intval($unread_topics),
				'LAST_POST_TIME' => $last_post_time,

				'L_MODERATOR' => $l_moderators, 
				'L_FORUM_FOLDER_ALT' => $folder_alt, 
//-- mod : forumtitle as weblink -----------------------------------------------
//-- delete
/*-MOD
				'U_VIEWFORUM' => append_sid("viewforum.$phpEx?" . POST_FORUM_URL . "=$subforum_id"))
			);
MOD-*/
//-- add
				'U_VIEWFORUM' => ( $subforum_data[$j]['title_is_link'] ) ? append_sid('index.'.$phpEx . '?' . POST_FORUM_URL . '=' . $subforum_id . '&amp;forum_link=1') : append_sid('viewforum.'.$phpEx . '?' . POST_FORUM_URL . '=' . $subforum_id))
			);

			if ( $subforum_data[$j]['title_is_link'] )
			{
				$template->assign_block_vars('catrow.forumrow.switch_forum_link_on', array());
			}
			else
			{
				$template->assign_block_vars('catrow.forumrow.switch_forum_link_off', array());
			}
//-- fin mod : forumtitle as weblink -------------------------------------------
		}
	}
}
//-- fin mod : simple subforums ------------------------------------------------

//
// Parse the page and print
//
$template->pparse('body');

//
// Page footer
//
include($phpbb_root_path . 'includes/page_tail.'.$phpEx);

?>
