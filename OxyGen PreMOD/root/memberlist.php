<?php
/***************************************************************************
 *                              memberlist.php
 *                            -------------------
 *   begin                : Friday, May 11, 2001
 *   copyright            : (C) 2001 The phpBB Group
 *   email                : support@phpbb.com
 *
 *   $Id: memberlist.php,v 1.36.2.12 2006/02/07 20:42:51 grahamje Exp $
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
$userdata = session_pagestart($user_ip, PAGE_VIEWMEMBERS);
init_userprefs($userdata);
//
// End session management
//

//-- mod : sort memberlist per letter ------------------------------------------
//-- add
if(isset($HTTP_POST_VARS['letter']))
{
	$by_letter = ($HTTP_POST_VARS['letter']) ? $HTTP_POST_VARS['letter'] : 'all';
}
else if(isset($HTTP_GET_VARS['letter']))
{
	$by_letter = ($HTTP_GET_VARS['letter']) ? $HTTP_GET_VARS['letter'] : 'all';
}
//-- fin mod : sort memberlist per letter --------------------------------------

//-- mod : access limitation ---------------------------------------------------
//-- add
if( $board_config['memberlist_access'] == ADMIN && $userdata['user_level'] != ADMIN )
{
	message_die(GENERAL_MESSAGE, $lang['Not_Authorised']);
}
else if ( $board_config['memberlist_access'] == MOD && ( $userdata['user_level'] != MOD && $userdata['user_level'] != ADMIN ) )
{
	message_die(GENERAL_MESSAGE, $lang['Not_Authorised']);
}
else if( $board_config['memberlist_access'] == USER && !$userdata['session_logged_in'] )
{
	message_die(GENERAL_MESSAGE, $lang['Not_Authorised']);
}
//-- fin mod : access limitation -----------------------------------------------

$start = ( isset($HTTP_GET_VARS['start']) ) ? intval($HTTP_GET_VARS['start']) : 0;
$start = ($start < 0) ? 0 : $start;

if ( isset($HTTP_GET_VARS['mode']) || isset($HTTP_POST_VARS['mode']) )
{
	$mode = ( isset($HTTP_POST_VARS['mode']) ) ? htmlspecialchars($HTTP_POST_VARS['mode']) : htmlspecialchars($HTTP_GET_VARS['mode']);
}
else
{
	$mode = 'joined';
}

if(isset($HTTP_POST_VARS['order']))
{
	$sort_order = ($HTTP_POST_VARS['order'] == 'ASC') ? 'ASC' : 'DESC';
}
else if(isset($HTTP_GET_VARS['order']))
{
	$sort_order = ($HTTP_GET_VARS['order'] == 'ASC') ? 'ASC' : 'DESC';
}
else
{
	$sort_order = 'ASC';
}

//
// Memberlist sorting
//
//-- mod : ip country flag -----------------------------------------------------
// here we added
//	, $lang['Sort_Country']
//	, 'country'
//-- modify
//-- mod : mini last visit -----------------------------------------------------
// here we added
//	, $lang['Sort_Visited']
//	, 'lastlogin'
//-- modify
//-- mod : points system -------------------------------------------------------
// here we added
//	, $board_config['points_name']
//	, 'points'
//-- modify
//-- mod : online offline hidden -----------------------------------------------
// here we added
//	, $lang['Online_status']
//	, 'online'
//-- modify
//-- mod : topics a user has started -------------------------------------------
// here we added
//	, $lang['Sort_Topics']
//	, 'topics'
//-- modify
$mode_types_text = array($lang['Sort_Joined'], $lang['Sort_Visited'], $lang['Sort_Username'], $lang['Sort_Location'], $lang['Sort_Posts'], $lang['Sort_Topics'], $lang['Sort_Email'],  $lang['Sort_Website'], $lang['Sort_Top_Ten'], $board_config['points_name'], $lang['Sort_Country'], $lang['Online_status']);
$mode_types = array('joined', 'lastlogin', 'username', 'location', 'posts', 'topics', 'email', 'website', 'topten', 'points', 'country', 'online');
//-- fin mod : topics a user has started ---------------------------------------
//-- fin mod : online offline hidden -------------------------------------------
//-- fin mod : points system ---------------------------------------------------
//-- fin mod : mini last visit -------------------------------------------------
//-- fin mod : ip country flag -------------------------------------------------

$select_sort_mode = '<select name="mode">';
for($i = 0; $i < count($mode_types_text); $i++)
{
	$selected = ( $mode == $mode_types[$i] ) ? ' selected="selected"' : '';
	$select_sort_mode .= '<option value="' . $mode_types[$i] . '"' . $selected . '>' . $mode_types_text[$i] . '</option>';
}
$select_sort_mode .= '</select>';

$select_sort_order = '<select name="order">';
if($sort_order == 'ASC')
{
	$select_sort_order .= '<option value="ASC" selected="selected">' . $lang['Sort_Ascending'] . '</option><option value="DESC">' . $lang['Sort_Descending'] . '</option>';
}
else
{
	$select_sort_order .= '<option value="ASC">' . $lang['Sort_Ascending'] . '</option><option value="DESC" selected="selected">' . $lang['Sort_Descending'] . '</option>';
}
$select_sort_order .= '</select>';

//
// Generate page
//
$page_title = $lang['Memberlist'];
include($phpbb_root_path . 'includes/page_header.'.$phpEx);

$template->set_filenames(array(
	'body' => 'memberlist_body.tpl')
);
make_jumpbox('viewforum.'.$phpEx);

$template->assign_vars(array(
	'L_SELECT_SORT_METHOD' => $lang['Select_sort_method'],
	'L_EMAIL' => $lang['Email'],
	'L_WEBSITE' => $lang['Website'],
	'L_FROM' => $lang['Location'],
	'L_ORDER' => $lang['Order'],
	'L_SORT' => $lang['Sort'],
	'L_SUBMIT' => $lang['Sort'],
	'L_AIM' => $lang['AIM'],
	'L_YIM' => $lang['YIM'],
	'L_MSNM' => $lang['MSNM'],
	'L_ICQ' => $lang['ICQ'], 
	'L_JOINED' => $lang['Joined'],
	'L_POSTS' => $lang['Posts'], 
	'L_PM' => $lang['Private_Message'], 

//-- mod : topics a user has started -------------------------------------------
//-- add
	'L_TOPICS' => $lang['Topics'],
//-- fin mod : topics a user has started ---------------------------------------

//-- mod : mini last visit -----------------------------------------------------
//-- add
	'L_VISITED' => $lang['Visited'],
//-- fin mod : mini last visit -------------------------------------------------
//-- mod : online offline hidden -----------------------------------------------
//-- add
	'L_ONLINE_STATUS' => $lang['Online_status'],
//-- fin mod : online offline hidden -------------------------------------------
//-- mod : points system -------------------------------------------------------
//-- add
	'L_POINTS' => $board_config['points_name'],
//-- fin mod : points system ---------------------------------------------------
//-- mod : ip country flag -----------------------------------------------------
//-- add
	'L_COUNTRY' => $lang['Country'],
//-- fin mod : ip country flag -------------------------------------------------

	'S_MODE_SELECT' => $select_sort_mode,
	'S_ORDER_SELECT' => $select_sort_order,
	'S_MODE_ACTION' => append_sid('memberlist.'.$phpEx))
);

switch( $mode )
{
	case 'joined':
		$order_by = 'user_regdate '.$sort_order.' LIMIT '.$start.', ' . $board_config['topics_per_page'];
		break;
//-- mod : mini last visit -----------------------------------------------------
//-- add
	case 'lastlogin':
		$order_by = 'user_lastlogin ' . $sort_order . ' LIMIT ' . $start . ', ' . $board_config['topics_per_page'];
		break;
//-- fin mod : mini last visit -------------------------------------------------
	case 'username':
		$order_by = 'username '.$sort_order.'  LIMIT '.$start.', ' . $board_config['topics_per_page'];
		break;
	case 'location':
		$order_by ='user_from '.$sort_order.'  LIMIT '.$start.', ' . $board_config['topics_per_page'];
		break;
	case 'posts':
		$order_by = 'user_posts '.$sort_order.'  LIMIT '.$start.', ' . $board_config['topics_per_page'];
		break;
//-- mod : topics a user has started -------------------------------------------
//-- add
	case 'topics':
		$order_by = 'user_topics '.$sort_order.'  LIMIT '.$start.', ' . $board_config['topics_per_page'];
		break;
//-- fin mod : topics a user has started ---------------------------------------
	case 'email':
		$order_by = 'user_email '.$sort_order.'  LIMIT '.$start.', ' . $board_config['topics_per_page'];
		break;
	case 'website':
		$order_by = 'user_website '.$sort_order.'  LIMIT '.$start.', ' . $board_config['topics_per_page'];
		break;
	case 'topten':
		$order_by = 'user_posts '.$sort_order.' LIMIT 10';
		break;
//-- mod : points system -------------------------------------------------------
//-- add
	case 'points':
		$order_by = 'user_points '.$sort_order.' LIMIT '.$start.', ' . $board_config['topics_per_page'];
		break;
//-- fin mod : points system ---------------------------------------------------
//-- mod : ip country flag -----------------------------------------------------
//-- add
	case 'country':
		$order_by = 'user_cf_iso3661_1 '.$sort_order.' LIMIT '.$start.', ' . $board_config['topics_per_page'];
		break;
//-- fin mod : ip country flag -------------------------------------------------
//-- mod : online offline hidden -----------------------------------------------
//-- add
	case 'online':
		$order_by = 'user_session_time '.$sort_order.' LIMIT '.$start.', ' . $board_config['topics_per_page'];
		break;
//-- fin mod : online offline hidden -------------------------------------------
	default:
		$order_by = 'user_regdate '.$sort_order.' LIMIT '.$start.', ' . $board_config['topics_per_page'];
		break;
}

//-- mod : sort memberlist per letter ------------------------------------------
//-- add
$others_sql = '';
$select_letter = '';
for ($i = 97; $i <= 122; $i++)
{
	$others_sql .= " AND username NOT LIKE '" . chr($i) . "%' ";
	$select_letter .= ( $by_letter == chr($i) ) ? chr($i) . '&nbsp;' : '<a href="' . append_sid("memberlist.$phpEx?letter=" . chr($i) . "&amp;mode=$mode&amp;order=$sort_order&amp;start=$start") . '">' . chr($i) . '</a>&nbsp;';
}
$select_letter .= ( $by_letter == 'others' ) ? $lang['Others'] . '&nbsp;' : '<a href="' . append_sid("memberlist.$phpEx?letter=others&amp;mode=$mode&amp;order=$sort_order&amp;start=$start") . '">' . $lang['Others'] . '</a>&nbsp;';
$select_letter .= ( $by_letter == 'all' ) ? $lang['All'] : '<a href="' . append_sid("memberlist.$phpEx?letter=all&amp;mode=$mode&amp;order=$sort_order&amp;start=$start") . '">' . $lang['All'] . '</a>';

$template->assign_vars(array(
	'L_SORT_PER_LETTER' => $lang['Sort_per_letter'],
	'S_LETTER_SELECT' => $select_letter,
	'S_LETTER_HIDDEN' => '<input type="hidden" name="letter" value="' . $by_letter . '">')
);

if($by_letter == 'all')
{
	$letter_sql = '';
}
else if($by_letter == 'others')
{
	$letter_sql = $others_sql;
}
else
{
	$letter_sql = " AND username LIKE '$by_letter%' ";
}

// here we added
//	' . $letter_sql . '
//-- modify
$sql = 'SELECT username, user_id, user_viewemail, user_posts, user_regdate, user_from, user_website, user_email, user_icq, user_aim, user_yim, user_msnm, user_avatar, user_avatar_type, user_allowavatar
	FROM ' . USERS_TABLE . '
	WHERE user_id <> ' . ANONYMOUS . '
	' . $letter_sql . '
	ORDER BY ' . $order_by;
//-- fin mod : sort memberlist per letter --------------------------------------
//-- mod : mini last visit -----------------------------------------------------
//-- add
$sql = str_replace('SELECT ', 'SELECT user_lastlogin, user_allow_viewonline, ', $sql);
//-- fin mod : mini last visit -------------------------------------------------

//-- mod : ip country flag -----------------------------------------------------
//-- add
$sql = str_replace('SELECT ', 'SELECT user_cf_iso3661_1, ', $sql);
//-- fin mod : ip country flag -------------------------------------------------

//-- mod : points system -------------------------------------------------------
//-- add
$sql = str_replace('SELECT ', 'SELECT user_points, ', $sql);
//-- fin mod : points system ---------------------------------------------------

//-- mod : online offline hidden -----------------------------------------------
//-- add
	$sql = str_replace('SELECT ', 'SELECT user_allow_viewonline, user_session_time, ', $sql);
//-- fin mod : online offline hidden -------------------------------------------

//-- mod : topics a user has started -------------------------------------------
//-- add
	$sql = str_replace('SELECT ', 'SELECT user_topics, ', $sql);
//-- fin mod : topics a user has started ---------------------------------------

//-- mod : rank color system ---------------------------------------------------
//-- add
$sql = str_replace('SELECT ', 'SELECT user_level, user_color, user_group_id, ', $sql);
//-- fin mod : rank color system -----------------------------------------------
if( !($result = $db->sql_query($sql)) )
{
	message_die(GENERAL_ERROR, 'Could not query users', '', __LINE__, __FILE__, $sql);
}

if ( $row = $db->sql_fetchrow($result) )
{
	$i = 0;
	do
	{
		$username = $row['username'];
		$user_id = $row['user_id'];

		$from = ( !empty($row['user_from']) ) ? $row['user_from'] : '&nbsp;';
		$joined = create_date($lang['DATE_FORMAT'], $row['user_regdate'], $board_config['board_timezone']);
		$posts = ( $row['user_posts'] ) ? $row['user_posts'] : 0;

//-- mod : topics a user has started -------------------------------------------
//-- add
		$topics = ( $row['user_topics'] ) ? $row['user_topics'] : 0;
//-- fin mod : topics a user has started ---------------------------------------

		$poster_avatar = '';
		if ( $row['user_avatar_type'] && $user_id != ANONYMOUS && $row['user_allowavatar'] )
		{
			switch( $row['user_avatar_type'] )
			{
//-- mod : resize avatars based on max width and heignt ------------------------
//-- delete
/*-MOD
				case USER_AVATAR_UPLOAD:
					$poster_avatar = ( $board_config['allow_avatar_upload'] ) ? '<img src="' . $board_config['avatar_path'] . '/' . $row['user_avatar'] . '" alt="" border="0" />' : '';
					break;
				case USER_AVATAR_REMOTE:
					$poster_avatar = ( $board_config['allow_avatar_remote'] ) ? '<img src="' . $row['user_avatar'] . '" alt="" border="0" />' : '';
					break;
				case USER_AVATAR_GALLERY:
					$poster_avatar = ( $board_config['allow_avatar_local'] ) ? '<img src="' . $board_config['avatar_gallery_path'] . '/' . $row['user_avatar'] . '" alt="" border="0" />' : '';
					break;
MOD-*/
//-- add
				case USER_AVATAR_UPLOAD:
					$poster_avatar = ( $board_config['allow_avatar_upload'] ) ? '<img onload="rmwa_img_loaded(this,' .  $board_config['avatar_max_width'] . ',' .  $board_config['avatar_max_height'] . ')"' . ' src="' . $board_config['avatar_path'] . '/' . $row['user_avatar'] . '" alt="" border="0" />' : '';
					break;
				case USER_AVATAR_REMOTE:
					$poster_avatar = ( $board_config['allow_avatar_remote'] ) ? '<img onload="rmwa_img_loaded(this,' .  $board_config['avatar_max_width'] . ',' .  $board_config['avatar_max_height'] . ')"' . ' src="' . $row['user_avatar'] . '" alt="" border="0" />' : '';
					break;
				case USER_AVATAR_GALLERY:
					$poster_avatar = ( $board_config['allow_avatar_local'] ) ? '<img onload="rmwa_img_loaded(this,' .  $board_config['avatar_max_width'] . ',' .  $board_config['avatar_max_height'] . ')"' . ' src="' . $board_config['avatar_gallery_path'] . '/' . $row['user_avatar'] . '" alt="" border="0" />' : '';
					break;
//-- fin mod : resize avatars based on max width and heignt --------------------
			}
		}

		if ( !empty($row['user_viewemail']) || $userdata['user_level'] == ADMIN )
		{
			$email_uri = ( $board_config['board_email_form'] ) ? append_sid("profile.$phpEx?mode=email&amp;" . POST_USERS_URL .'=' . $user_id) : 'mailto:' . $row['user_email'];

			$email_img = '<a href="' . $email_uri . '"><img src="' . $images['icon_email'] . '" alt="' . $lang['Send_email'] . '" title="' . $lang['Send_email'] . '" border="0" /></a>';
			$email = '<a href="' . $email_uri . '">' . $lang['Send_email'] . '</a>';
		}
		else
		{
			$email_img = '&nbsp;';
			$email = '&nbsp;';
		}

		$temp_url = append_sid("profile.$phpEx?mode=viewprofile&amp;" . POST_USERS_URL . "=$user_id");
		$profile_img = '<a href="' . $temp_url . '"><img src="' . $images['icon_profile'] . '" alt="' . $lang['Read_profile'] . '" title="' . $lang['Read_profile'] . '" border="0" /></a>';
		$profile = '<a href="' . $temp_url . '">' . $lang['Read_profile'] . '</a>';

		$temp_url = append_sid("privmsg.$phpEx?mode=post&amp;" . POST_USERS_URL . "=$user_id");
		$pm_img = '<a href="' . $temp_url . '"><img src="' . $images['icon_pm'] . '" alt="' . $lang['Send_private_message'] . '" title="' . $lang['Send_private_message'] . '" border="0" /></a>';
		$pm = '<a href="' . $temp_url . '">' . $lang['Send_private_message'] . '</a>';

		$www_img = ( $row['user_website'] ) ? '<a href="' . $row['user_website'] . '" target="_userwww"><img src="' . $images['icon_www'] . '" alt="' . $lang['Visit_website'] . '" title="' . $lang['Visit_website'] . '" border="0" /></a>' : '';
		$www = ( $row['user_website'] ) ? '<a href="' . $row['user_website'] . '" target="_userwww">' . $lang['Visit_website'] . '</a>' : '';

		if ( !empty($row['user_icq']) )
		{
			$icq_status_img = '<a href="http://wwp.icq.com/' . $row['user_icq'] . '#pager"><img src="http://web.icq.com/whitepages/online?icq=' . $row['user_icq'] . '&img=5" width="18" height="18" border="0" /></a>';
			$icq_img = '<a href="http://wwp.icq.com/scripts/search.dll?to=' . $row['user_icq'] . '"><img src="' . $images['icon_icq'] . '" alt="' . $lang['ICQ'] . '" title="' . $lang['ICQ'] . '" border="0" /></a>';
			$icq =  '<a href="http://wwp.icq.com/scripts/search.dll?to=' . $row['user_icq'] . '">' . $lang['ICQ'] . '</a>';
		}
		else
		{
			$icq_status_img = '';
			$icq_img = '';
			$icq = '';
		}

		$aim_img = ( $row['user_aim'] ) ? '<a href="aim:goim?screenname=' . $row['user_aim'] . '&amp;message=Hello+Are+you+there?"><img src="' . $images['icon_aim'] . '" alt="' . $lang['AIM'] . '" title="' . $lang['AIM'] . '" border="0" /></a>' : '';
		$aim = ( $row['user_aim'] ) ? '<a href="aim:goim?screenname=' . $row['user_aim'] . '&amp;message=Hello+Are+you+there?">' . $lang['AIM'] . '</a>' : '';

		$temp_url = append_sid("profile.$phpEx?mode=viewprofile&amp;" . POST_USERS_URL . "=$user_id");
		$msn_img = ( $row['user_msnm'] ) ? '<a href="' . $temp_url . '"><img src="' . $images['icon_msnm'] . '" alt="' . $lang['MSNM'] . '" title="' . $lang['MSNM'] . '" border="0" /></a>' : '';
		$msn = ( $row['user_msnm'] ) ? '<a href="' . $temp_url . '">' . $lang['MSNM'] . '</a>' : '';

		$yim_img = ( $row['user_yim'] ) ? '<a href="http://edit.yahoo.com/config/send_webmesg?.target=' . $row['user_yim'] . '&amp;.src=pg"><img src="' . $images['icon_yim'] . '" alt="' . $lang['YIM'] . '" title="' . $lang['YIM'] . '" border="0" /></a>' : '';
		$yim = ( $row['user_yim'] ) ? '<a href="http://edit.yahoo.com/config/send_webmesg?.target=' . $row['user_yim'] . '&amp;.src=pg">' . $lang['YIM'] . '</a>' : '';

		$temp_url = append_sid("search.$phpEx?search_author=" . urlencode($username) . "&amp;showresults=posts");
		$search_img = '<a href="' . $temp_url . '"><img src="' . $images['icon_search'] . '" alt="' . sprintf($lang['Search_user_posts'], $username) . '" title="' . sprintf($lang['Search_user_posts'], $username) . '" border="0" /></a>';
		$search = '<a href="' . $temp_url . '">' . sprintf($lang['Search_user_posts'], $username) . '</a>';

//-- mod : online offline hidden -----------------------------------------------
//-- add
		if ($row['user_session_time'] >= (time()-$board_config['online_time']))
		{
			if ($row['user_allow_viewonline'])
			{
				$online_status_img = '<a href="' . append_sid("viewonline.$phpEx") . '"><img src="' . $images['icon_online'] . '" alt="' . sprintf($lang['is_online'], $username) . '" title="' . sprintf($lang['is_online'], $username) . '" /></a>';
				$online_status = '<strong><a href="' . append_sid("viewonline.$phpEx") . '" title="' . sprintf($lang['is_online'], $username) . '"' . $online_color . '>' . $lang['Online'] . '</a></strong>';
			}
			else if ($userdata['user_level'] == ADMIN || $userdata['user_id'] == $user_id)
			{
				$online_status_img = '<a href="' . append_sid("viewonline.$phpEx") . '"><img src="' . $images['icon_hidden'] . '" alt="' . sprintf($lang['is_hidden'], $username) . '" title="' . sprintf($lang['is_hidden'], $username) . '" /></a>';
				$online_status = '<strong><em><a href="' . append_sid("viewonline.$phpEx") . '" title="' . sprintf($lang['is_hidden'], $username) . '"' . $hidden_color . '>' . $lang['Hidden'] . '</a></em></strong>';
			}
			else
			{
				$online_status_img = '<img src="' . $images['icon_offline'] . '" alt="' . sprintf($lang['is_offline'], $username) . '" title="' . sprintf($lang['is_offline'], $username) . '" />';
				$online_status = '<span title="' . sprintf($lang['is_offline'], $username) . '"' . $offline_color . '><strong>' . $lang['Offline'] . '</strong></span>';
			}
		}
		else
		{
			$online_status_img = '<img src="' . $images['icon_offline'] . '" alt="' . sprintf($lang['is_offline'], $username) . '" title="' . sprintf($lang['is_offline'], $username) . '" />';
			$online_status = '<span title="' . sprintf($lang['is_offline'], $username) . '"' . $offline_color . '><strong>' . $lang['Offline'] . '</strong></span>';
		}
//-- fin mod : online offline hidden -------------------------------------------

//-- mod : points system -------------------------------------------------------
//-- add
		$user_points = $row['user_points'];
//-- fin mod : points system ---------------------------------------------------

//-- mod : ip country flag -----------------------------------------------------
//-- add
		$iso3661_1 = $row['user_cf_iso3661_1'];
//-- fin mod : ip country flag -------------------------------------------------

		$row_color = ( !($i % 2) ) ? $theme['td_color1'] : $theme['td_color2'];
		$row_class = ( !($i % 2) ) ? $theme['td_class1'] : $theme['td_class2'];

		$template->assign_block_vars('memberrow', array(
			'L_VIEWPROFILE' => $lang['Read_profile'], 

			'ROW_NUMBER' => $i + ( $start + 1 ),
			'ROW_COLOR' => '#' . $row_color,
			'ROW_CLASS' => $row_class,
//-- mod : rank color system ---------------------------------------------------
//-- add
			'STYLE' => $rcs->get_colors($row),
//-- fin mod : rank color system -----------------------------------------------
			'USERNAME' => $username,
			'FROM' => $from,
			'JOINED' => $joined,

//-- mod : mini last visit -----------------------------------------------------
//-- add
			'VISITED' => display_last_visit($row['user_id'], $row['user_lastlogin'], $row['user_allow_viewonline']),
//-- fin mod : mini last visit -------------------------------------------------

			'POSTS' => $posts,

//-- mod : topics a user has started -------------------------------------------
//-- add
			'TOPICS' => $topics,
//-- fin mod : topics a user has started ---------------------------------------

			'AVATAR_IMG' => $poster_avatar,
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
			'YIM_IMG' => $yim_img,
			'YIM' => $yim,

//-- mod : online offline hidden -----------------------------------------------
//-- add
			'ONLINE_STATUS_IMG' => $online_status_img,
			'ONLINE_STATUS' => $online_status,
//-- fin mod : online offline hidden -------------------------------------------
//-- mod : points system -------------------------------------------------------
//-- add
			'POINTS' => $user_points,
//-- fin mod : points system ---------------------------------------------------
//-- mod : ip country flag -----------------------------------------------------
//-- add
			'FLAG' => $iso3661_1,
			'COUNTRY' => $lang['IP2Country'][$iso3661_1],
//-- fin mod : ip country flag -------------------------------------------------

			'U_VIEWPROFILE' => append_sid('profile.'.$phpEx . '?mode=viewprofile&amp;' . POST_USERS_URL . '=' . $user_id))
		);

		$i++;
	}
	while ( $row = $db->sql_fetchrow($result) );
	$db->sql_freeresult($result);
}

if ( $mode != 'topten' || $board_config['topics_per_page'] < 10 )
{
//-- mod : sort memberlist per letter ------------------------------------------
// here we added
//	 . $letter_sql
//-- modify
	$sql = 'SELECT count(*) AS total
		FROM ' . USERS_TABLE . '
		WHERE user_id <> ' . ANONYMOUS . $letter_sql;
//-- fin mod : sort memberlist per letter --------------------------------------

	if ( !($result = $db->sql_query($sql)) )
	{
		message_die(GENERAL_ERROR, 'Error getting total users', '', __LINE__, __FILE__, $sql);
	}

	if ( $total = $db->sql_fetchrow($result) )
	{
		$total_members = $total['total'];

//-- mod : sort memberlist per letter ------------------------------------------
// here we added
//	&amp;letter=$by_letter
//-- modify
		$pagination = generate_pagination("memberlist.$phpEx?mode=$mode&amp;order=$sort_order&amp;letter=$by_letter", $total_members, $board_config['topics_per_page'], $start). '&nbsp;';
//-- fin mod : sort memberlist per letter --------------------------------------
	}
	$db->sql_freeresult($result);
}
else
{
	$pagination = '&nbsp;';
	$total_members = 10;
}

$template->assign_vars(array(
	'PAGINATION' => $pagination,
	'PAGE_NUMBER' => sprintf($lang['Page_of'], ( floor( $start / $board_config['topics_per_page'] ) + 1 ), ceil( $total_members / $board_config['topics_per_page'] )), 

	'L_GOTO_PAGE' => $lang['Goto_page'])
);

$template->pparse('body');

include($phpbb_root_path . 'includes/page_tail.'.$phpEx);

?>
