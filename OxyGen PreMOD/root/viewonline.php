<?php
/***************************************************************************
 *                              viewonline.php
 *                            -------------------
 *   begin                : Saturday, Feb 13, 2001
 *   copyright            : (C) 2001 The phpBB Group
 *   email                : support@phpbb.com
 *
 *   $Id: viewonline.php,v 1.54.2.4 2005/05/06 20:50:10 acydburn Exp $
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
$userdata = session_pagestart($user_ip, PAGE_VIEWONLINE);
init_userprefs($userdata);
//
// End session management
//

//-- mod : access limitation ---------------------------------------------------
//-- add
if( $board_config['viewonline_access'] == ADMIN && $userdata['user_level'] != ADMIN )
{
	message_die(GENERAL_MESSAGE, $lang['Not_Authorised']);
}
else if ( $board_config['viewonline_access'] == MOD && ( $userdata['user_level'] != MOD && $userdata['user_level'] != ADMIN ) )
{
	message_die(GENERAL_MESSAGE, $lang['Not_Authorised']);
}
else if( $board_config['viewonline_access'] == USER && !$userdata['session_logged_in'] )
{
	message_die(GENERAL_MESSAGE, $lang['Not_Authorised']);
}
//-- fin mod : access limitation -----------------------------------------------

//
// Output page header and load viewonline template
//
$page_title = $lang['Who_is_Online'];
include($phpbb_root_path . 'includes/page_header.'.$phpEx);

$template->set_filenames(array('body' => 'viewonline_body.tpl'));
make_jumpbox('viewforum.'.$phpEx);

$template->assign_vars(array(
	'L_WHOSONLINE' => $lang['Who_is_Online'],
	'L_ONLINE_EXPLAIN' => $lang['Online_explain'],
	'L_USERNAME' => $lang['Username'],
	'L_FORUM_LOCATION' => $lang['Forum_Location'],
	'L_LAST_UPDATE' => $lang['Last_updated'])
);

//
// Forum info
//
$sql = 'SELECT forum_name, forum_id FROM ' . FORUMS_TABLE;
if ( $result = $db->sql_query($sql) )
{
	while( $row = $db->sql_fetchrow($result) )
	{
		$forum_data[$row['forum_id']] = $row['forum_name'];
	}
}
else
{
	message_die(GENERAL_ERROR, 'Could not obtain user/online forums information', '', __LINE__, __FILE__, $sql);
}

//
// Get auth data
//
$is_auth_ary = array();
$is_auth_ary = auth(AUTH_VIEW, AUTH_LIST_ALL, $userdata);

//
// Get user list
//
$sql = 'SELECT u.user_id, u.username, u.user_allow_viewonline, u.user_level, s.session_logged_in, s.session_time, s.session_page, s.session_ip
	FROM ' . USERS_TABLE . ' u, ' . SESSIONS_TABLE . ' s
	WHERE u.user_id = s.session_user_id
		AND s.session_time >= ' . ( time() - 300 ) . '
	ORDER BY u.username ASC, s.session_ip ASC';
//-- mod : rank color system ---------------------------------------------------
//-- add
$sql = str_replace('SELECT ', 'SELECT u.user_color, u.user_group_id, ', $sql);
//-- fin mod : rank color system -----------------------------------------------

//-- mod : box indexing mod ----------------------------------------------------
//-- add
$sql = str_replace('SELECT ', 'SELECT s.is_robot, ', $sql);
//-- fin mod : box indexing mod ------------------------------------------------

//-- mod : ip country flag -----------------------------------------------------
//-- add
$sql = str_replace('SELECT ', 'SELECT s.session_cf_iso3661_1, ', $sql);
//-- fin mod : ip country flag -------------------------------------------------

if ( !($result = $db->sql_query($sql)) )
{
	message_die(GENERAL_ERROR, 'Could not obtain regd user/online information', '', __LINE__, __FILE__, $sql);
}

$guest_users = 0;
$registered_users = 0;
$hidden_users = 0;

$reg_counter = 0;
$guest_counter = 0;
$prev_user = 0;
$prev_ip = '';

while ( $row = $db->sql_fetchrow($result) )
{
	$view_online = false;

	if ( $row['session_logged_in'] ) 
	{
		$user_id = $row['user_id'];

		if ( $user_id != $prev_user )
		{
			$username = $row['username'];

//-- mod : rank color system ---------------------------------------------------
//-- delete
/*-MOD
			$style_color = '';
			if ( $row['user_level'] == ADMIN )
			{
				$username = '<b style="color:#' . $theme['fontcolor3'] . '">' . $username . '</b>';
			}
			else if ( $row['user_level'] == MOD )
			{
				$username = '<b style="color:#' . $theme['fontcolor2'] . '">' . $username . '</b>';
			}
MOD-*/
//-- fin mod : rank color system -----------------------------------------------

			if ( !$row['user_allow_viewonline'] )
			{
//-- mod : online offline hidden -----------------------------------------------
// here we added
//	|| $userdata['user_id'] == $user_id 
//-- modify
				$view_online = ( $userdata['user_level'] == ADMIN || $userdata['user_id'] == $user_id ) ? true : false;
//-- fin mod : online offline hidden -------------------------------------------
				$hidden_users++;

				$username = '<i>' . $username . '</i>';
			}
			else
			{
				$view_online = true;
				$registered_users++;
			}

			$which_counter = 'reg_counter';
			$which_row = 'reg_user_row';
			$prev_user = $user_id;
		}
	}
	else
	{
		if ( $row['session_ip'] != $prev_ip )
		{
//-- mod : box indexing mod ----------------------------------------------------
//-- delete
/*-MOD
			$username = $lang['Guest'];
MOD-*/
//-- add
			$username = ( $row['is_robot'] ) ? $row['is_robot'] : $lang['Guest'];
//-- fin mod : box indexing mod ------------------------------------------------
			$view_online = true;
			$guest_users++;
	
			$which_counter = 'guest_counter';
			$which_row = 'guest_user_row';
		}
	}

	$prev_ip = $row['session_ip'];

	if ( $view_online )
	{
		if ( $row['session_page'] < 1 || !$is_auth_ary[$row['session_page']]['auth_view'] )
		{
			switch( $row['session_page'] )
			{
				case PAGE_INDEX:
					$location = $lang['Forum_index'];
					$location_url = 'index.'.$phpEx;
					break;
				case PAGE_POSTING:
					$location = $lang['Posting_message'];
					$location_url = 'index.'.$phpEx;
					break;
				case PAGE_LOGIN:
					$location = $lang['Logging_on'];
					$location_url = 'index.'.$phpEx;
					break;
				case PAGE_SEARCH:
					$location = $lang['Searching_forums'];
					$location_url = 'search.'.$phpEx;
					break;
				case PAGE_PROFILE:
					$location = $lang['Viewing_profile'];
					$location_url = 'index.'.$phpEx;
					break;
				case PAGE_VIEWONLINE:
					$location = $lang['Viewing_online'];
					$location_url = 'viewonline.'.$phpEx;
					break;
				case PAGE_VIEWMEMBERS:
					$location = $lang['Viewing_member_list'];
					$location_url = 'memberlist.'.$phpEx;
					break;
				case PAGE_PRIVMSGS:
					$location = $lang['Viewing_priv_msgs'];
					$location_url = 'privmsg.'.$phpEx;
					break;
				case PAGE_FAQ:
					$location = $lang['Viewing_FAQ'];
					$location_url = 'faq.'.$phpEx;
					break;
				default:
					$location = $lang['Forum_index'];
					$location_url = 'index.'.$phpEx;
			}
		}
		else
		{
			$location_url = append_sid('viewforum.' . $phpEx . '?' . POST_FORUM_URL . '=' . $row['session_page']);
			$location = $forum_data[$row['session_page']];
		}

		$row_color = ( $$which_counter % 2 ) ? $theme['td_color1'] : $theme['td_color2'];
		$row_class = ( $$which_counter % 2 ) ? $theme['td_class1'] : $theme['td_class2'];

//-- mod : ip country flag -----------------------------------------------------
//-- add
		$tpl_guests_flags = array('FLAG' => $row['session_cf_iso3661_1']);
//-- fin mod : ip country flag -------------------------------------------------

		$template->assign_block_vars("$which_row", array(
			'L_VIEWPROFILE' => $lang['Read_profile'],

			'ROW_COLOR' => '#' . $row_color,
			'ROW_CLASS' => $row_class,
//-- mod : rank color system ---------------------------------------------------
//-- add
			'STYLE' => $rcs->get_colors($row),
//-- fin mod : rank color system -----------------------------------------------
			'USERNAME' => $username,
			'LASTUPDATE' => create_date($board_config['default_dateformat'], $row['session_time'], $board_config['board_timezone']),
			'FORUM_LOCATION' => $location,

//-- mod : ip country flag -----------------------------------------------------
//-- add
			'FLAG' => $row['session_cf_iso3661_1'],
			'COUNTRY' => $lang['IP2Country'][$row['session_cf_iso3661_1']],
//-- fin mod : ip country flag -------------------------------------------------

//-- mod : rank color system ---------------------------------------------------
//-- delete
/*-MOD
			'U_USER_PROFILE' => append_sid('profile.'.$phpEx . '?mode=viewprofile&amp;' . POST_USERS_URL . '=' . $user_id),
MOD-*/
//-- add
			'U_USER_PROFILE' => $get->url('profile', array('mode' => 'viewprofile', POST_USERS_URL => $user_id), true),
//-- fin mod : rank color system -----------------------------------------------

			'U_FORUM_LOCATION' => append_sid($location_url))
		);

		$$which_counter++;
	}
}

$db->sql_freeresult($result);

$l_r_user_s = ($registered_users) ? ( ($registered_users == 1) ? $lang['Reg_user_online'] : $lang['Reg_users_online'] ) : $lang['Reg_users_zero_online'];
$l_h_user_s = ($hidden_users) ? ( ($hidden_users == 1) ? $lang['Hidden_user_online'] : $lang['Hidden_users_online'] ) : $lang['Hidden_users_zero_online'];
$l_g_user_s = ($guest_users) ? ( ($guest_users == 1) ? $lang['Guest_user_online'] : $lang['Guest_users_online'] ) : $lang['Guest_users_zero_online'];

$template->assign_vars(array(
	'TOTAL_REGISTERED_USERS_ONLINE' => sprintf($l_r_user_s, $registered_users) . sprintf($l_h_user_s, $hidden_users), 
	'TOTAL_GUEST_USERS_ONLINE' => sprintf($l_g_user_s, $guest_users))
);

if ( $registered_users + $hidden_users == 0 )
{
	$template->assign_vars(array(
		'L_NO_REGISTERED_USERS_BROWSING' => $lang['No_users_browsing'])
	);
}

if ( $guest_users == 0 )
{
	$template->assign_vars(array(
		'L_NO_GUESTS_BROWSING' => $lang['No_users_browsing'])
	);
}

$template->pparse('body');

include($phpbb_root_path . 'includes/page_tail.'.$phpEx);

?>
