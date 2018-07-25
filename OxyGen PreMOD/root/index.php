<?php
/***************************************************************************
 *                                index.php
 *                            -------------------
 *   begin                : Saturday, Feb 13, 2001
 *   copyright            : (C) 2001 The phpBB Group
 *   email                : support@phpbb.com
 *
 *   $Id: index.php,v 1.99.2.7 2006/01/28 11:13:39 acydburn Exp $
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

//
// Start session management
//
$userdata = session_pagestart($user_ip, PAGE_INDEX);
init_userprefs($userdata);
//
// End session management
//

//-- mod : block the index to the guests ---------------------------------------
//-- add
if( !$board_config['no_guest_on_index'] && !$userdata['session_logged_in'] )
{
	header("Location: " . append_sid('login.'.$phpEx . '?redirect=index.'.$phpEx, true));
}
//-- fin mod : block the index to the guests -----------------------------------

//-- mod : forumtitle as weblink -----------------------------------------------
//-- add
$forum_id = isset($HTTP_GET_VARS[POST_FORUM_URL]) ? intval($HTTP_GET_VARS[POST_FORUM_URL]) : 0;
$forum_link = isset($HTTP_GET_VARS['forum_link']) ? intval($HTTP_GET_VARS['forum_link']) : 0;

if ($forum_link && $forum_id)
{
	$sql = 'UPDATE ' . FORUMS_TABLE . '
		SET forum_link_count = forum_link_count + 1
		WHERE forum_id = ' . intval($forum_id);
	if ( !$db->sql_query($sql) )
	{
		message_die(GENERAL_ERROR, 'Could not update link counter', '', __LINE__, __FILE__, $sql);
	}

	$sql = 'SELECT weblink FROM ' . FORUMS_TABLE . ' WHERE forum_id = ' . intval($forum_id);
	if ( !$result = $db->sql_query($sql) )
	{
		message_die(GENERAL_ERROR, 'Could not read forum weblink', '', __LINE__, __FILE__, $sql);
	}

	while ( $row = $db->sql_fetchrow($result) )
	{
		$forum_weblink = $row['weblink'];
	}

	header('Location: ' . $forum_weblink);
	exit;
}
//-- fin mod : forumtitle as weblink -------------------------------------------

//-- mod : keep unread flags ---------------------------------------------------
//-- add
$toggle_unreads_link = true;
//-- fin mod : keep unread flags -----------------------------------------------

$viewcat = ( !empty($HTTP_GET_VARS[POST_CAT_URL]) ) ? $HTTP_GET_VARS[POST_CAT_URL] : -1;

if( isset($HTTP_GET_VARS['mark']) || isset($HTTP_POST_VARS['mark']) )
{
	$mark_read = ( isset($HTTP_POST_VARS['mark']) ) ? $HTTP_POST_VARS['mark'] : $HTTP_GET_VARS['mark'];
}
else
{
	$mark_read = '';
}

//
// Handle marking posts
//
if( $mark_read == 'forums' )
{
//-- mod : keep unread flags ---------------------------------------------------
//-- delete
/*-MOD
	if( $userdata['session_logged_in'] )
	{
		setcookie($board_config['cookie_name'] . '_f_all', time(), 0, $board_config['cookie_path'], $board_config['cookie_domain'], $board_config['cookie_secure']);
	}
MOD-*/
//-- add
	$board_config['tracking_time'] = time();
	$board_config['tracking_forums'] = array();
	$board_config['tracking_unreads'] = array();
	write_cookies($userdata);
//-- fin mod : keep unread flags -----------------------------------------------

	$template->assign_vars(array(
		'META' => '<meta http-equiv="refresh" content="3;url='  .append_sid('index.'.$phpEx) . '">')
	);

	$message = $lang['Forums_marked_read'] . '<br /><br />' . sprintf($lang['Click_return_index'], '<a href="' . append_sid('index.'.$phpEx) . '">', '</a> ');

	message_die(GENERAL_MESSAGE, $message);
}
//
// End handle marking posts
//

//-- mod : keep unread flags ---------------------------------------------------
//-- delete
/*-MOD
$tracking_topics = ( isset($HTTP_COOKIE_VARS[$board_config['cookie_name'] . '_t']) ) ? unserialize($HTTP_COOKIE_VARS[$board_config['cookie_name'] . "_t"]) : array();
$tracking_forums = ( isset($HTTP_COOKIE_VARS[$board_config['cookie_name'] . '_f']) ) ? unserialize($HTTP_COOKIE_VARS[$board_config['cookie_name'] . "_f"]) : array();
MOD-*/
//-- fin mod : keep unread flags -----------------------------------------------

//
// If you don't use these stats on your index you may want to consider
// removing them
//
$total_posts = get_db_stat('postcount');
$total_users = get_db_stat('usercount');
$newest_userdata = get_db_stat('newestuser');
$newest_user = $newest_userdata['username'];
$newest_uid = $newest_userdata['user_id'];

//-- mod : topics a user has started -------------------------------------------
//-- add
$total_topics = get_db_stat('topiccount');
$l_total_topic_s = ($total_topics) ? ( ( $total_topics == 1 ) ? $lang['Posted_topic_total'] : $lang['Posted_topics_total'] ) : $lang['Posted_topics_zero_total'];
//-- fin mod : topics a user has started ---------------------------------------

$l_total_post_s = ($total_posts) ? ( ( $total_posts == 1 ) ? $lang['Posted_article_total'] : $lang['Posted_articles_total'] ) : $lang['Posted_articles_zero_total'];
$l_total_user_s = ($total_users) ? ( ( $total_users == 1 ) ? $lang['Registered_user_total'] : $lang['Registered_users_total'] ) : $lang['Registered_users_zero_total'];

//-- mod : annonce globale -----------------------------------------------------
//-- add
// Is there any global announcement ?
if ( $board_config['annonce_globale_index'] )
{
	get_annonce_list();
}
//-- fin mod : annonce globale -------------------------------------------------

//-- mod : minichat ------------------------------------------------------------
//-- add
$board_config['shoutbox_banned_user_id_view'] = $GLOBALS['board_config']['shoutbox_banned_user_id_view'];
if( strstr($board_config['shoutbox_banned_user_id_view'], ',') )
{
	$fids = explode(',', $board_config['shoutbox_banned_user_id_view']);
	while( list($foo, $id) = each($fids) )
	{
		$fid[] = intval( trim($id) );
	}
}
else
{
	$fid[] = intval( trim($board_config['shoutbox_banned_user_id_view']) );
}

reset($fid);

if ( $board_config['shoutbox_on'] && in_array($userdata['user_id'], $fid) == false )
{
	include($phpbb_root_path . 'shoutbox_body.'.$phpEx);
}
//-- fin mod : minichat --------------------------------------------------------

//
// Start page proper
//
$sql = 'SELECT c.cat_id, c.cat_title, c.cat_order
	FROM ' . CATEGORIES_TABLE . ' c 
	ORDER BY c.cat_order';
if( !$result = $db->sql_query($sql))
{
	message_die(GENERAL_ERROR, 'Could not query categories list', '', __LINE__, __FILE__, $sql);
}

$category_rows = array();
while ($row = $db->sql_fetchrow($result))
{
	$category_rows[] = $row;
}
$db->sql_freeresult($result);

//-- mod : simple subforums ----------------------------------------------------
//-- add
$subforums_list = array();
//-- fin mod : simple subforums ------------------------------------------------

if( ( $total_categories = count($category_rows) ) )
{
	//
	// Define appropriate SQL
	//
	switch(SQL_LAYER)
	{
		default:
//-- mod : today-yesterday mod -------------------------------------------------
//-- delete
/*-MOD
			$sql = 'SELECT f.*, p.post_time, p.post_username, u.username, u.user_id
				FROM (( ' . FORUMS_TABLE . ' f
				LEFT JOIN ' . POSTS_TABLE . ' p ON p.post_id = f.forum_last_post_id )
				LEFT JOIN ' . USERS_TABLE . ' u ON u.user_id = p.poster_id )
				ORDER BY f.cat_id, f.forum_order';
MOD-*/
//-- add
			$sql = 'SELECT f.*, p.post_time, p.post_username, u.username, u.user_id, t.topic_title, t.topic_id  
				FROM ((( ' . FORUMS_TABLE . ' f  
				LEFT JOIN ' . POSTS_TABLE . ' p ON p.post_id = f.forum_last_post_id )  
				LEFT JOIN ' . TOPICS_TABLE . ' t ON t.topic_id = p.topic_id )  
				LEFT JOIN ' . USERS_TABLE . ' u ON u.user_id = p.poster_id )  
				ORDER BY f.cat_id, f.forum_order'; 
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

	if (!$result = $db->sql_query($sql))
	{
		message_die(GENERAL_ERROR, 'Could not query forums information', '', __LINE__, __FILE__, $sql);
	}

	$forum_data = array();
	while( $row = $db->sql_fetchrow($result) )
	{
		$forum_data[] = $row;
	}
	$db->sql_freeresult($result);

	if ( !($total_forums = count($forum_data)) )
	{
		message_die(GENERAL_MESSAGE, $lang['No_forums']);
	}

//-- mod : keep unread flags ---------------------------------------------------
//-- delete
/*-MOD
	//
	// Obtain a list of topic ids which contain
	// posts made since user last visited
	//
	if ($userdata['session_logged_in'])
	{
		// 60 days limit
		if ($userdata['user_lastvisit'] < (time() - 5184000))
		{
			$userdata['user_lastvisit'] = time() - 5184000;
		}

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
	$new_unreads = list_new_unreads($forum_unreads, $toggle_unreads_link);
//-- fin mod : keep unread flags -----------------------------------------------

	//
	// Obtain list of moderators of each forum
	// First users, then groups ... broken into two queries
	//
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

	if (!$result = $db->sql_query($sql))
	{
		message_die(GENERAL_ERROR, 'Could not query forum moderator information', '', __LINE__, __FILE__, $sql);
	}

	$forum_moderators = array();
	while( $row = $db->sql_fetchrow($result) )
	{
//-- mod : rank color system ---------------------------------------------------
//-- delete
/*-MOD
		$forum_moderators[$row['forum_id']][] = '<a href="' . append_sid("profile.$phpEx?mode=viewprofile&amp;" . POST_USERS_URL . "=" . $row['user_id']) . '">' . $row['username'] . '</a>';
MOD-*/
//-- add
		$style_color = $rcs->get_colors($row);
		$forum_moderators[$row['forum_id']][] = '<a href="' . $get->url('profile', array('mode' => 'viewprofile', POST_USERS_URL => $row['user_id']), true) . '" title="' . $lang['Read_profile'] . '" ' . $style_color . '>' . $row['username'] . '</a>';
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
	if (!$result = $db->sql_query($sql))
	{
		message_die(GENERAL_ERROR, 'Could not query forum moderator information', '', __LINE__, __FILE__, $sql);
	}

	while( $row = $db->sql_fetchrow($result) )
	{
//-- mod : rank color system ---------------------------------------------------
//-- delete
/*-MOD
		$forum_moderators[$row['forum_id']][] = '<a href="' . append_sid("groupcp.$phpEx?" . POST_GROUPS_URL . "=" . $row['group_id']) . '">' . $row['group_name'] . '</a>';
MOD-*/
//-- add
		$style_color = $rcs->get_group_class($row['group_id']);
		$forum_moderators[$row['forum_id']][] = '<a href="' . $get->url('groupcp', array(POST_GROUPS_URL => $row['group_id']), true) . '"' . $style_color . '>' . $row['group_name'] . '</a>';
//-- fin mod : rank color system -----------------------------------------------
	}
	$db->sql_freeresult($result);

	//
	// Find which forums are visible for this user
	//
	$is_auth_ary = array();
	$is_auth_ary = auth(AUTH_VIEW, AUTH_LIST_ALL, $userdata, $forum_data);

	//
	// Start output of page
	//
	define('SHOW_ONLINE', true);
	$page_title = $lang['Index'];
	include($phpbb_root_path . 'includes/page_header.'.$phpEx);

//-- mod : birthday ------------------------------------------------------------
//-- add
	$bdays->display_bdays();
//-- fin mod : birthday --------------------------------------------------------

//-- mod : ip country flag -----------------------------------------------------
//-- add
	$newest_iso3661_1 = $newest_userdata['user_cf_iso3661_1'];
	$newest_country = $lang['IP2Country'][$newest_userdata['user_cf_iso3661_1']];
//-- fin mod : ip country flag -------------------------------------------------

//-- mod : toolbar -------------------------------------------------------------
//-- add
	build_toolbar('index', $l_privmsgs_text, $s_privmsg_new);
//-- fin mod : toolbar ---------------------------------------------------------

//-- mod : today userlist ------------------------------------------------------
//-- add
	include($phpbb_root_path . 'includes/class_userlist.' . $phpEx);
	$today_userlist = new today_userlist();
	$today_userlist->display();
	unset($today_userlist);
//-- fin mod : today userlist --------------------------------------------------

//-- mod : rank color system ---------------------------------------------------
//-- add

//-- mod : access limitation ---------------------------------------------------
//-- delete
/*-MOD
	$rcs->display_legend();
MOD-*/
//-- add
	$rcs->display_legend('switch_viewonline', $viewonline_access); 
//-- fin mod : access limitation -----------------------------------------------

	$newest_color = $rcs->get_colors($newest_userdata);
//-- fin mod : rank color system -----------------------------------------------

	$template->set_filenames(array('body' => 'index_body.tpl'));

	$template->assign_vars(array(
		'TOTAL_POSTS' => sprintf($l_total_post_s, $total_posts),
//-- mod : topics a user has started -------------------------------------------
//-- add
		'TOTAL_TOPICS' => sprintf($l_total_topic_s, $total_topics),
//-- fin mod : topics a user has started ---------------------------------------
		'TOTAL_USERS' => sprintf($l_total_user_s, $total_users),
//-- mod : rank color system ---------------------------------------------------
//-- delete
/*-MOD
		'NEWEST_USER' => sprintf($lang['Newest_user'], '<a href="' . append_sid("profile.$phpEx?mode=viewprofile&amp;" . POST_USERS_URL . "=$newest_uid") . '">', $newest_user, '</a>'),
MOD-*/
//-- add
		'NEWEST_USER' => sprintf($lang['Newest_user'], '<a href="' . $get->url('profile', array('mode' => 'viewprofile', POST_USERS_URL => $newest_uid), true) . '" title="' . $lang['Read_profile'] . '" ' . $newest_color . '>', $newest_user, '</a>'),
//-- fin mod : rank color system -----------------------------------------------

		'FORUM_IMG' => $images['forum'],
		'FORUM_NEW_IMG' => $images['forum_new'],
		'FORUM_LOCKED_IMG' => $images['forum_locked'],

//-- mod : forumtitle as weblink -----------------------------------------------
//-- add
		'FORUM_LINK_IMG' => $images['forum_link'],
		'L_FORUM_LINK' => $lang['Forum_is_a_link'],
//-- fin mod : forumtitle as weblink -------------------------------------------

		'L_FORUM' => $lang['Forum'],
//-- mod : simple subforums ----------------------------------------------------
//-- add
		'L_SUBFORUMS' => $lang['Subforums'],
//-- fin mod : simple subforums ------------------------------------------------
		'L_TOPICS' => $lang['Topics'],
		'L_REPLIES' => $lang['Replies'],
		'L_VIEWS' => $lang['Views'],
		'L_POSTS' => $lang['Posts'],
		'L_LASTPOST' => $lang['Last_Post'], 
		'L_NO_NEW_POSTS' => $lang['No_new_posts'],
		'L_NEW_POSTS' => $lang['New_posts'],
		'L_NO_NEW_POSTS_LOCKED' => $lang['No_new_posts_locked'], 
		'L_NEW_POSTS_LOCKED' => $lang['New_posts_locked'], 
		'L_ONLINE_EXPLAIN' => $lang['Online_explain'], 

		'L_MODERATOR' => $lang['Moderators'], 
		'L_FORUM_LOCKED' => $lang['Forum_is_locked'],
		'L_MARK_FORUMS_READ' => $lang['Mark_all_forums'], 

//-- mod : ip country flag -----------------------------------------------------
//-- add
		'L_NEWEST_FROM' => $lang['IP_CF_Newest_Registered_From'],

		'NEWEST_FLAG' => $newest_iso3661_1,
		'NEWEST_COUNTRY' => $newest_country,
//-- fin mod : ip country flag -------------------------------------------------

		'U_MARK_READ' => append_sid('index.'.$phpEx.'?mark=forums'),
	));

	//
	// Let's decide which categories we should display
	//
	$display_categories = array();

	for ($i = 0; $i < $total_forums; $i++ )
	{
		if ($is_auth_ary[$forum_data[$i]['forum_id']]['auth_view'])
		{
			$display_categories[$forum_data[$i]['cat_id']] = true;
		}
	}

	//
	// Okay, let's build the index
	//
	for($i = 0; $i < $total_categories; $i++)
	{
		$cat_id = $category_rows[$i]['cat_id'];

		//
		// Yes, we should, so first dump out the category
		// title, then, if appropriate the forum list
		//
		if (isset($display_categories[$cat_id]) && $display_categories[$cat_id])
		{
			$template->assign_block_vars('catrow', array(
				'CAT_ID' => $cat_id,
				'CAT_DESC' => $category_rows[$i]['cat_title'],
				'U_VIEWCAT' => append_sid('index.'.$phpEx.'?' . POST_CAT_URL . '=' . $cat_id),
			));

			if ( $viewcat == $cat_id || $viewcat == -1 )
			{
				for($j = 0; $j < $total_forums; $j++)
				{
					if ( $forum_data[$j]['cat_id'] == $cat_id )
					{
						$forum_id = $forum_data[$j]['forum_id'];

						if ( $is_auth_ary[$forum_id]['auth_view'] )
						{
							if ( $forum_data[$j]['forum_status'] == FORUM_LOCKED )
							{
								$folder_image = $images['forum_locked']; 
								$folder_alt = $lang['Forum_is_locked'];
//-- mod : simple subforums ----------------------------------------------------
//-- add
								$unread_topic = false;
								$folder_images = array(
									'default'	=> $folder_image,
									'new'		=> $images['forum_locked'],
									'sub'		=> ( isset($images['forums_locked']) ) ? $images['forums_locked'] : $images['forum_locked'],
									'subnew'	=> ( isset($images['forums_locked']) ) ? $images['forums_locked'] : $images['forum_locked'],
									'subalt'	=> $lang['Forum_is_locked'],
									'subaltnew'	=> $lang['Forum_is_locked'],
								);
//-- fin mod : simple subforums ------------------------------------------------
							}
							else
							{
//-- mod : keep unread flags ---------------------------------------------------
//-- delete
/*-MOD
								$unread_topics = false;
								if ( $userdata['session_logged_in'] )
								{
									if ( !empty($new_topic_data[$forum_id]) )
									{
										$forum_last_post_time = 0;

										while( list($check_topic_id, $check_post_time) = @each($new_topic_data[$forum_id]) )
										{
											if ( empty($tracking_topics[$check_topic_id]) )
											{
												$unread_topics = true;
												$forum_last_post_time = max($check_post_time, $forum_last_post_time);

											}
											else
											{
												if ( $tracking_topics[$check_topic_id] < $check_post_time )
												{
													$unread_topics = true;
													$forum_last_post_time = max($check_post_time, $forum_last_post_time);
												}
											}
										}

										if ( !empty($tracking_forums[$forum_id]) )
										{
											if ( $tracking_forums[$forum_id] > $forum_last_post_time )
											{
												$unread_topics = false;
											}
										}

										if ( isset($HTTP_COOKIE_VARS[$board_config['cookie_name'] . '_f_all']) )
										{
											if ( $HTTP_COOKIE_VARS[$board_config['cookie_name'] . '_f_all'] > $forum_last_post_time )
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
								$unread_topic = $forum_unreads[$forum_id];
//-- mod : forumtitle as weblink -----------------------------------------------
//-- delete
/*-MOD
								$folder_image = ( $unread_topic ) ? $images['forum_new'] : $images['forum'];
								$folder_alt = ( $unread_topic ) ? $lang['New_posts'] : $lang['No_new_posts'];
MOD-*/
//-- add
								if( $forum_data[$j]['title_is_link'] )
								{
									$folder_alt = $lang['Forum_is_a_link'];
									$folder_image = $images['forum_link'];
								}
								else if( $unread_topic )
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
//-- mod : simple subforums ----------------------------------------------------
//-- add
								$folder_images = array( 
									'default'   => $folder_image,
									'new'      => $folder_image, 
									'sub'      => $folder_image,
									'subnew'   => $folder_image, 
									'subalt'   => $folder_alt, 
									'subaltnew'   => $folder_alt, 
								);
//-- fin mod : simple subforums ------------------------------------------------
							}
//-- fin mod : keep unread flags -----------------------------------------------

							$posts = $forum_data[$j]['forum_posts'];
							$topics = $forum_data[$j]['forum_topics'];
//-- mod : forum icon with acp control -----------------------------------------
//-- add
							$icon = $forum_data[$j]['forum_icon'];
//-- fin mod : forum icon with acp control -------------------------------------

							if ( $forum_data[$j]['forum_last_post_id'] )
							{
//-- mod : last active topic on index ------------------------------------------
//-- add
								$last_post = (strlen($forum_data[$j]['topic_title']) > $board_config['last_topic_title_length']) ? '<a href="' . append_sid('viewtopic.'.$phpEx . '?' . POST_TOPIC_URL . '=' . $forum_data[$j]['topic_id']) . '" title="' . $forum_data[$j]['topic_title'] . '">' . substr($forum_data[$j]['topic_title'], 0, $board_config['last_topic_title_length']) . '...</a><br />' : '<a href="' . append_sid('viewtopic.'.$phpEx . '?' . POST_TOPIC_URL . '=' . $forum_data[$j]['topic_id']) . '" title="' . $forum_data[$j]['topic_title'] . '">' . $forum_data[$j]['topic_title'] . '</a><br />';
//-- fin mod : last active topic on index --------------------------------------

								$last_post_time = create_date($board_config['default_dateformat'], $forum_data[$j]['post_time'], $board_config['board_timezone']);

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
								$lastpost_iso3661_1 = $forum_data[$j]['user_cf_iso3661_1'];
								$last_post .= '<img src="images/flags/small/' . $lastpost_iso3661_1 . '.png" width="14" height="9" alt="' . $lang['IP2Country'][$lastpost_iso3661_1] . '" title="' . $lang['IP2Country'][$lastpost_iso3661_1] . '" />&nbsp;';
//-- fin mod : ip country flag -------------------------------------------------

//-- mod : rank color system ---------------------------------------------------
//-- delete
/*-MOD
								$last_post .= ( $forum_data[$j]['user_id'] == ANONYMOUS ) ? ( ($forum_data[$j]['post_username'] != '' ) ? $forum_data[$j]['post_username'] . ' ' : $lang['Guest'] . ' ' ) : '<a href="' . append_sid("profile.$phpEx?mode=viewprofile&amp;" . POST_USERS_URL . '='  . $forum_data[$j]['user_id']) . '">' . $forum_data[$j]['username'] . '</a> ';
MOD-*/
//-- add
								$style_color = $rcs->get_colors($forum_data[$j]);
								$last_post .= ($forum_data[$j]['user_id'] == ANONYMOUS) ? ((($forum_data[$j]['post_username'] != '') ? $forum_data[$j]['post_username'] : $lang['Guest']) . '&nbsp;') : '<a href="' . $get->url('profile', array('mode' => 'viewprofile', POST_USERS_URL => $forum_data[$j]['user_id']), true) . '" title="' . $lang['Read_profile'] . '" ' . $style_color . '>' . $forum_data[$j]['username'] . '</a>&nbsp;';
//-- fin mod : rank color system -----------------------------------------------

								$last_post .= '<a href="' . append_sid('viewtopic.'.$phpEx . '?' . POST_POST_URL . '=' . $forum_data[$j]['forum_last_post_id']) . '#' . $forum_data[$j]['forum_last_post_id'] . '"><img src="' . $images['icon_latest_reply'] . '" border="0" alt="' . $lang['View_latest_post'] . '" title="' . $lang['View_latest_post'] . '" /></a>';

//-- mod : simple subforums ----------------------------------------------------
//-- add
								$last_post_sub = '<img src="' . ($unread_topic ? $images['icon_subforum_new'] : $images['icon_subforum']) . '" border="0" alt="' . ($unread_topic ? $lang['New_posts'] : $lang['No_new_posts']) . '" title="' . ($unread_topic ? $lang['New_posts'] : $lang['No_new_posts']) . '" />';
								$last_post_time = $forum_data[$j]['post_time'];
//-- fin mod : simple subforums ------------------------------------------------
							}
							else
							{
								$last_post = $lang['No_Posts'];
//-- mod : simple subforums ----------------------------------------------------
//-- add
								$last_post_sub = '<img src="' . $images['icon_subforum'] . '" border="0" alt="' . $lang['No_Posts'] . '" title="' . $lang['No_Posts'] . '" />';
								$last_post_time = 0;
//-- fin mod : simple subforums ------------------------------------------------
							}

//-- mod : locked subforums viewable -------------------------------------------
//-- add
							if ( $forum_data[$j]['forum_status'] == FORUM_LOCKED )
							{
								$last_post_sub = '<img src="' . $images['icon_subforum_locked'] . '" border="0" alt="' . $lang['Forum_is_locked'] . '" title="' . $lang['Forum_is_locked'] . '" />';
							}
//-- fin mod : locked subforums viewable ---------------------------------------

							if ( count($forum_moderators[$forum_id]) > 0 )
							{
								$l_moderators = ( count($forum_moderators[$forum_id]) == 1 ) ? $lang['Moderator'] : $lang['Moderators'];
								$moderator_list = implode(', ', $forum_moderators[$forum_id]);
							}
							else
							{
								$l_moderators = '&nbsp;';
//-- mod : simple subforums ----------------------------------------------------
//-- delete
/*-MOD
								$moderator_list = '&nbsp;';
MOD-*/
//-- add
								$moderator_list = '';
//-- fin mod : simple subforums ------------------------------------------------
							}

							$row_color = ( !($i % 2) ) ? $theme['td_color1'] : $theme['td_color2'];
							$row_class = ( !($i % 2) ) ? $theme['td_class1'] : $theme['td_class2'];

							$template->assign_block_vars('catrow.forumrow',	array(
								'ROW_COLOR' => '#' . $row_color,
								'ROW_CLASS' => $row_class,
								'FORUM_FOLDER_IMG' => $folder_image,
//-- mod : hypercell class -----------------------------------------------------
//-- add
								'HYPERCELL_CLASS' => get_hypercell_class($forum_data[$j]['forum_status'], ($unread_topics || $unread_topic), 0, 0, $forum_data[$j]['title_is_link']),
//-- fin mod : hypercell class ------------------------------------------------- 
//-- mod : forum icon with acp control -----------------------------------------
//-- add
								'FORUM_ICON_IMG' => $icon ? '<img src="' . $phpbb_root_path . $board_config['forum_icon_path'] . '/' . $icon . '" alt="' . $forum_data[$j]['forum_name'] . '" title="' . $forum_data[$j]['forum_name'] . '" border="0" />' : '',
//-- fin mod : forum icon with acp control -------------------------------------
//-- mod : forumtitle as weblink -----------------------------------------------
//-- add
								'FORUM_LINK_COUNT' => $forum_data[$j]['title_is_link'] ? sprintf($lang['Forum_link_count'], $forum_data[$j]['forum_link_count']) : '',
								'FORUM_LINK_TARGET' => $forum_data[$j]['forum_link_target'] ? 'target="_blank"' : '',
//-- fin mod : forumtitle as weblink -------------------------------------------
								'FORUM_NAME' => $forum_data[$j]['forum_name'],
//-- mod : colorize forum title ------------------------------------------------
//-- add
								'FORUM_COLOR' => (!empty($forum_data[$j]['forum_color'])) ? 'style="color: #' . $forum_data[$j]['forum_color'] . '"' : '',
//-- fin mod : colorize forum title --------------------------------------------
								'FORUM_DESC' => $forum_data[$j]['forum_desc'],
								'POSTS' => $forum_data[$j]['forum_posts'],
								'TOPICS' => $forum_data[$j]['forum_topics'],
								'LAST_POST' => $last_post,
								'MODERATORS' => $moderator_list,

								'L_MODERATOR' => $l_moderators, 
								'L_FORUM_FOLDER_ALT' => $folder_alt, 

//-- mod : simple subforums ----------------------------------------------------
//-- add
								'FORUM_FOLDERS' => serialize($folder_images),
								'HAS_SUBFORUMS' => 0,
								'PARENT' => $forum_data[$j]['forum_parent'],
								'ID' => $forum_data[$j]['forum_id'],
								'UNREAD' => intval($unread_topic),
								'TOTAL_UNREAD' => intval($unread_topic),
								'TOTAL_POSTS' => $forum_data[$j]['forum_posts'],
								'TOTAL_TOPICS' => $forum_data[$j]['forum_topics'],
								'LAST_POST_FORUM' => $last_post,
								'LAST_POST_TIME' => $last_post_time,
								'LAST_POST_TIME_FORUM' => $last_post_time,
//-- fin mod : simple subforums ------------------------------------------------

//-- mod : forumtitle as weblink -----------------------------------------------
//-- delete
/*-MOD
								'U_VIEWFORUM' => append_sid("viewforum.$phpEx?" . POST_FORUM_URL . "=$forum_id"))
							);
MOD-*/
//-- add
								'U_VIEWFORUM' => $forum_data[$j]['title_is_link'] ? append_sid('index.'.$phpEx . '?' . POST_FORUM_URL . '=' . $forum_id . '&amp;forum_link=1') : append_sid('viewforum.'.$phpEx . '?' . POST_FORUM_URL . '=' . $forum_id),
							));

							if ( $forum_data[$j]['title_is_link'] )
							{
								$template->assign_block_vars('catrow.forumrow.switch_forum_link_on', array());
								$last_post_sub = '<img src="' . $images['icon_minilink'] . '" border="0" alt="' . $lang['Forum_is_a_link'] . '" title="' . $lang['Forum_is_a_link'] . '" />';
							}
							else
							{
								$template->assign_block_vars('catrow.forumrow.switch_forum_link_off', array());
							}
//-- fin mod : forumtitle as weblink -------------------------------------------

//-- mod : simple subforums ----------------------------------------------------
//-- add
							if( $forum_data[$j]['forum_parent'] )
							{
								$subforums_list[] = array(
									'forum_data'	=> $forum_data[$j],
									'folder_image'	=> $folder_image,
									'last_post'		=> $last_post,
									'last_post_sub'	=> $last_post_sub,
									'moderator_list'	=> $moderator_list,
									'unread_topics'	=> $unread_topic,
									'l_moderators'	=> $l_moderators,
									'folder_alt'	=> $folder_alt,
									'last_post_time'	=> $last_post_time,
									'desc'			=> $forum_data[$j]['forum_desc'],
								);
							}
//-- fin mod : simple subforums ------------------------------------------------
						}
					}
				}
			}
		}
	} // for ... categories
}// if ... total_categories
else
{
	message_die(GENERAL_MESSAGE, $lang['No_forums']);
}

//-- mod : simple subforums ----------------------------------------------------
//-- add
unset($data);
unset($item);
unset($cat_item);
unset($row_item);
for( $i = 0; $i < count($subforums_list); $i++ )
{
	$forum_data = $subforums_list[$i]['forum_data'];
	$parent_id = $forum_data['forum_parent'];
	
	// Find parent item
	if( isset($template->_tpldata['catrow.']) )
	{
		$data = &$template->_tpldata['catrow.'];
		$count = count($data);
		for( $j = 0; $j < $count; $j++)
		{
			$cat_item = &$data[$j];
			$row_item = &$cat_item['forumrow.'];
			$count2 = count($row_item);
			for( $k = 0; $k < $count2; $k++)
			{
				if( $row_item[$k]['ID'] == $parent_id )
				{
					$item = &$row_item[$k];
					break;
				}
			}
			if( isset($item) )
			{
				break;
			}
		}
	}
	
	if( isset($item) )
	{
		if( isset($item['sub.']) )
		{
			$num = count($item['sub.']);
			$data = &$item['sub.'];
		}
		else
		{
			$num = 0;
			$item[] = 'sub.';
			$data = &$item['sub.'];
		}

//-- mod : maxi simple subforums -----------------------------------------------
//-- add
		if( $num < $board_config['max_subforums'] )
		{
//-- fin mod : maxi simple subforums -------------------------------------------

			// Append new entry
			$data[] = array(
				'NUM' => $num,
				'FORUM_FOLDER_IMG' => $subforums_list[$i]['folder_image'], 
//-- mod : forumtitle as weblink -----------------------------------------------
//-- add
				'FORUM_LINK_TARGET' => $forum_data['forum_link_target'] ? 'target="_blank"' : '',
//-- fin mod : forumtitle as weblink -------------------------------------------
				'FORUM_NAME' => $forum_data['forum_name'],
//-- mod : colorize forum title ------------------------------------------------
//-- add
				'FORUM_COLOR' => (!empty($forum_data['forum_color'])) ? 'style="color: #' . $forum_data['forum_color'] . '"' : '',
//-- fin mod : colorize forum title --------------------------------------------
				'FORUM_DESC' => $forum_data['forum_desc'],
				'FORUM_DESC_HTML' => htmlspecialchars(preg_replace('@<[\/\!]*?[^<>]*?>@si', '', $forum_data['forum_desc'])),
				'POSTS' => $forum_data['forum_posts'],
				'TOPICS' => $forum_data['forum_topics'],
				'LAST_POST' => $subforums_list[$i]['last_post'],
				'LAST_POST_SUB' => $subforums_list[$i]['last_post_sub'],
				'LAST_TOPIC' => $forum_data['topic_title'],
				'MODERATORS' => $subforums_list[$i]['moderator_list'],
				'PARENT' => $forum_data['forum_parent'],
				'ID' => $forum_data['forum_id'],
				'UNREAD' => intval($subforums_list[$i]['unread_topics']),
	
				'L_MODERATOR' => $subforums_list[$i]['l_moderators'], 
				'L_FORUM_FOLDER_ALT' => $subforums_list[$i]['folder_alt'], 

//-- mod : forumtitle as weblink -----------------------------------------------
//-- delete
/*-MOD
				'U_VIEWFORUM' => append_sid("viewforum.$phpEx?" . POST_FORUM_URL . '=' . $forum_data['forum_id'])
			);
MOD-*/
//-- add
				'U_VIEWFORUM' => ($forum_data['title_is_link']) ? append_sid('index.'.$phpEx . '?' . POST_FORUM_URL . '=' . $forum_data['forum_id'] . '&amp;forum_link=1') : append_sid('viewforum.'.$phpEx . '?' . POST_FORUM_URL . '=' . $forum_data['forum_id'])
			);
//-- fin mod : forumtitle as weblink -------------------------------------------

//-- mod : maxi simple subforums -----------------------------------------------
//-- add
		}
		elseif ( $num == $board_config['max_subforums'] )
		{
			// Append 'More...' entry
			$data[] = array(
				'NUM' => $num,
				'FORUM_NAME' => '<b>' . $lang['More'] . '</b>',
				'FORUM_DESC_HTML' => htmlspecialchars(preg_replace('@<[\/\!]*?[^<>]*?>@si', '', $lang['More_HTML'])),
				'PARENT' => $forum_data['forum_parent'],
				'ID' => $forum_data['forum_id'],
	
				'U_VIEWFORUM' => append_sid('viewforum.' . $phpEx . '?' . POST_FORUM_URL . '=' . $forum_data['forum_parent'])
			);
		}
//-- fin mod : maxi simple subforums -------------------------------------------

		$item['HAS_SUBFORUMS'] ++;
		$item['TOTAL_UNREAD'] += intval($subforums_list[$i]['unread_topics']);
		// Change folder image
		$images = unserialize($item['FORUM_FOLDERS']);
		$item['FORUM_FOLDER_IMG'] = $item['TOTAL_UNREAD'] ? $images['subnew'] : $images['sub'];
		$item['L_FORUM_FOLDER_ALT'] = $item['TOTAL_UNREAD'] ? $images['subaltnew'] : $images['subalt'];
		// Check last post
		if( $item['LAST_POST_TIME'] < $subforums_list[$i]['last_post_time'] )
		{
			$item['LAST_POST'] = $subforums_list[$i]['last_post'];
			$item['LAST_POST_TIME'] = $subforums_list[$i]['last_post_time'];
		}
		if( !$item['LAST_POST_TIME_FORUM'] )
		{
			$item['LAST_POST_FORUM'] = $item['LAST_POST'];
		}
		// Add topics/posts
		$item['TOTAL_POSTS'] += $forum_data['forum_posts'];
		$item['TOTAL_TOPICS'] += $forum_data['forum_topics'];
	}
	unset($item);
	unset($data);
	unset($cat_item);
	unset($row_item);
}
//-- fin mod : simple subforums ------------------------------------------------

//
// Generate the page
//
$template->pparse('body');

include($phpbb_root_path . 'includes/page_tail.'.$phpEx);

?>
