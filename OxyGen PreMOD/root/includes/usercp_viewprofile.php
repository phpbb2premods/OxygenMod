<?php
/***************************************************************************
 *                           usercp_viewprofile.php
 *                            -------------------
 *   begin                : Saturday, Feb 13, 2001
 *   copyright            : (C) 2001 The phpBB Group
 *   email                : support@phpbb.com
 *
 *   $Id: usercp_viewprofile.php,v 1.5.2.6 2005/09/14 18:14:30 acydburn Exp $
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
 *
 ***************************************************************************/

if ( !defined('IN_PHPBB') )
{
	die('Hacking attempt');
	exit;
}

if ( empty($HTTP_GET_VARS[POST_USERS_URL]) || $HTTP_GET_VARS[POST_USERS_URL] == ANONYMOUS )
{
	message_die(GENERAL_MESSAGE, $lang['No_user_id_specified']);
}
$profiledata = get_userdata($HTTP_GET_VARS[POST_USERS_URL]);

if (!$profiledata)
{
	message_die(GENERAL_MESSAGE, $lang['No_user_id_specified']);
}

$sql = 'SELECT *
	FROM ' . RANKS_TABLE . '
	ORDER BY rank_special, rank_min';
if ( !($result = $db->sql_query($sql)) )
{
	message_die(GENERAL_ERROR, 'Could not obtain ranks information', '', __LINE__, __FILE__, $sql);
}

$ranksrow = array();
while ( $row = $db->sql_fetchrow($result) )
{
	$ranksrow[] = $row;
}
$db->sql_freeresult($result);

//
// Output page header and profile_view template
//
$template->set_filenames(array(
	'body' => 'profile_view_body.tpl')
);
make_jumpbox('viewforum.'.$phpEx);

//
// Calculate the number of days this user has been a member ($memberdays)
// Then calculate their posts per day
//
$regdate = $profiledata['user_regdate'];
$memberdays = max(1, round( ( time() - $regdate ) / 86400 ));
$posts_per_day = $profiledata['user_posts'] / $memberdays;

//-- mod : topics a user has started -------------------------------------------
//-- add
$topics_per_day = $profiledata['user_topics'] / $memberdays;

// Get the users percentage of total topics
if ( $profiledata['user_topics'] != 0  )
{
	$total_topics = get_db_stat('topiccount');
	$topics_percentage = ( $total_topics ) ? min(100, ($profiledata['user_topics'] / $total_topics) * 100) : 0;
}
else
{
	$topics_percentage = 0;
}
//-- fin mod : topics a user has started ---------------------------------------

// Get the users percentage of total posts
if ( $profiledata['user_posts'] != 0  )
{
	$total_posts = get_db_stat('postcount');
	$percentage = ( $total_posts ) ? min(100, ($profiledata['user_posts'] / $total_posts) * 100) : 0;
}
else
{
	$percentage = 0;
}

//-- mod : jail mod ------------------------------------------------------------
//-- add
if ( $board_config['cell_allow_display_celleds'] && $profiledata['user_cell_celleds'] ) 
{
	$template->assign_block_vars('celleds', array());
}
//-- fin mod : jail mod --------------------------------------------------------

$avatar_img = '';
if ( $profiledata['user_avatar_type'] && $profiledata['user_allowavatar'] )
{
	switch( $profiledata['user_avatar_type'] )
	{
//-- mod : resize avatars based on max width and heignt ------------------------
//-- delete
/*-MOD
		case USER_AVATAR_UPLOAD:
			$avatar_img = ( $board_config['allow_avatar_upload'] ) ? '<img src="' . $board_config['avatar_path'] . '/' . $profiledata['user_avatar'] . '" alt="" border="0" />' : '';
			break;
		case USER_AVATAR_REMOTE:
			$avatar_img = ( $board_config['allow_avatar_remote'] ) ? '<img src="' . $profiledata['user_avatar'] . '" alt="" border="0" />' : '';
			break;
		case USER_AVATAR_GALLERY:
			$avatar_img = ( $board_config['allow_avatar_local'] ) ? '<img src="' . $board_config['avatar_gallery_path'] . '/' . $profiledata['user_avatar'] . '" alt="" border="0" />' : '';
			break;
MOD-*/
//-- add
		case USER_AVATAR_UPLOAD:
			$avatar_img = ( $board_config['allow_avatar_upload'] ) ? '<img onload="rmwa_img_loaded(this,' .  $board_config['avatar_max_width'] . ',' .  $board_config['avatar_max_height'] . ')"' . ' src="' . $board_config['avatar_path'] . '/' . $profiledata['user_avatar'] . '" alt="" border="0" />' : '';
//-- mod : jail mod ------------------------------------------------------------
//-- add
			$avatar_img = ( ($profiledata['user_cell_time'] > 0) && $board_config['cell_allow_display_bars']) ? '<img src="images/cell.gif" style="position: absolute; filter: alpha(opacity=65); width: ' . $board_config['avatar_max_width'] . '; height: ' . $board_config['avatar_max_height'] . '" border="0"><img src="' . $board_config['avatar_path'] . '/' . $profiledata['user_avatar'] . '"  style="width: ' . $board_config['avatar_max_width'] . '; height: ' . $board_config['avatar_max_height'] . '" border="0" >' : $avatar_img;
//-- fin mod : jail mod --------------------------------------------------------
			break;
		case USER_AVATAR_REMOTE:
			$avatar_img = ( $board_config['allow_avatar_remote'] ) ? '<img onload="rmwa_img_loaded(this,' .  $board_config['avatar_max_width'] . ',' .  $board_config['avatar_max_height'] . ')"' . ' src="' . $profiledata['user_avatar'] . '" alt="" border="0" />' : '';
//-- mod : jail mod ------------------------------------------------------------
//-- add
			$avatar_img = ( ($profiledata['user_cell_time'] > 0) && $board_config['cell_allow_display_bars'] ) ? '<img src="images/cell.gif" style="position: absolute; filter: alpha(opacity=65); width: ' . $board_config['avatar_max_width'] . '; height: ' . $board_config['avatar_max_height'] . '" border="0"><img src="' . $profiledata['user_avatar'] . '"  style="width: ' . $board_config['avatar_max_width'] . '; height: ' . $board_config['avatar_max_height'] . '" border="0" >' : $avatar_img;
//-- fin mod : jail mod --------------------------------------------------------
			break;
		case USER_AVATAR_GALLERY:
			$avatar_img = ( $board_config['allow_avatar_local'] ) ? '<img onload="rmwa_img_loaded(this,' .  $board_config['avatar_max_width'] . ',' .  $board_config['avatar_max_height'] . ')"' . ' src="' . $board_config['avatar_gallery_path'] . '/' . $profiledata['user_avatar'] . '" alt="" border="0" />' : '';
//-- mod : jail mod ------------------------------------------------------------
//-- add
			$avatar_img = ( ($profiledata['user_cell_time'] > 0) && $board_config['cell_allow_display_bars'] ) ? '<img src="images/cell.gif" style="position: absolute; filter: alpha(opacity=65); width: ' . $board_config['avatar_max_width'] . '; height: ' . $board_config['avatar_max_height'] . '" border="0"><img src="' . $board_config['avatar_gallery_path'] . '/' . $profiledata['user_avatar'] . '" style="width: ' . $board_config['avatar_max_width'] . '; height: ' . $board_config['avatar_max_height'] . '" border="0" >' : $avatar_img;
//-- fin mod : jail mod --------------------------------------------------------
			break;
//-- fin mod : resize avatars based on max width and heignt --------------------
	}
}

//-- mod : ip country flag -----------------------------------------------------
//-- add
$ipcfguest = 'guest';
$ipcfguestalt = $lang['IPCF_Guest'];

if ($profiledata['user_id'] == -1)
{
	$avatar_img = '<img src="images/avatars/gallery/ipcf_flags/' . $ipcfguest . '.gif" alt="' . $ipcfguestalt . '" title="' . $ipcfguestalt . '" border="0" />';
}
else if ($profiledata['user_avatar_type'] == 0)
{
	$avatar_img = '<img src="images/avatars/gallery/ipcf_flags/' . $profiledata['user_cf_iso3661_1'] . '.gif" alt="' .  $lang['IP2Country'][$profiledata['user_cf_iso3661_1']] . '" title="' .  $lang['IP2Country'][$profiledata['user_cf_iso3661_1']] . '" border="0" />';
}
//-- fin mod : ip country flag -------------------------------------------------

$poster_rank = '';
$rank_image = '';
if ( $profiledata['user_rank'] )
{
	for($i = 0; $i < count($ranksrow); $i++)
	{
		if ( $profiledata['user_rank'] == $ranksrow[$i]['rank_id'] && $ranksrow[$i]['rank_special'] )
		{
			$poster_rank = $ranksrow[$i]['rank_title'];
			$rank_image = ( $ranksrow[$i]['rank_image'] ) ? '<img src="' . $ranksrow[$i]['rank_image'] . '" alt="' . $poster_rank . '" title="' . $poster_rank . '" border="0" /><br />' : '';
		}
	}
}
else
{
	for($i = 0; $i < count($ranksrow); $i++)
	{
		if ( $profiledata['user_posts'] >= $ranksrow[$i]['rank_min'] && !$ranksrow[$i]['rank_special'] )
		{
			$poster_rank = $ranksrow[$i]['rank_title'];
			$rank_image = ( $ranksrow[$i]['rank_image'] ) ? '<img src="' . $ranksrow[$i]['rank_image'] . '" alt="' . $poster_rank . '" title="' . $poster_rank . '" border="0" /><br />' : '';
		}
	}
}

$temp_url = append_sid("privmsg.$phpEx?mode=post&amp;" . POST_USERS_URL . "=" . $profiledata['user_id']);
$pm_img = '<a href="' . $temp_url . '"><img src="' . $images['icon_pm'] . '" alt="' . $lang['Send_private_message'] . '" title="' . $lang['Send_private_message'] . '" border="0" /></a>';
$pm = '<a href="' . $temp_url . '">' . $lang['Send_private_message'] . '</a>';

if ( !empty($profiledata['user_viewemail']) || $userdata['user_level'] == ADMIN )
{
	$email_uri = ( $board_config['board_email_form'] ) ? append_sid("profile.$phpEx?mode=email&amp;" . POST_USERS_URL .'=' . $profiledata['user_id']) : 'mailto:' . $profiledata['user_email'];

	$email_img = '<a href="' . $email_uri . '"><img src="' . $images['icon_email'] . '" alt="' . $lang['Send_email'] . '" title="' . $lang['Send_email'] . '" border="0" /></a>';
	$email = '<a href="' . $email_uri . '">' . $lang['Send_email'] . '</a>';
}
else
{
//-- mod : invision view profile -----------------------------------------------
//-- delete
/*-MOD
	$email_img = '&nbsp;';
	$email = '&nbsp;';
MOD-*/
//-- add
	$email_img = $lang['Invision_Empty_field'];
	$email = $lang['Invision_Empty_field'];
//-- fin mod : invision view profile -------------------------------------------
}

//-- mod : invision view profile -----------------------------------------------
//-- delete
/*-MOD
$www_img = ( $profiledata['user_website'] ) ? '<a href="' . $profiledata['user_website'] . '" target="_userwww"><img src="' . $images['icon_www'] . '" alt="' . $lang['Visit_website'] . '" title="' . $lang['Visit_website'] . '" border="0" /></a>' : '&nbsp;';
$www = ( $profiledata['user_website'] ) ? '<a href="' . $profiledata['user_website'] . '" target="_userwww">' . $profiledata['user_website'] . '</a>' : '&nbsp;';
MOD-*/
//-- add
$www_img = ( $profiledata['user_website'] ) ? '<a href="' . $profiledata['user_website'] . '" target="_userwww"><img src="' . $images['icon_www'] . '" alt="' . $lang['Visit_website'] . '" title="' . $lang['Visit_website'] . '" border="0" /></a>' : $lang['Invision_Empty_field'];
$www = $www_img;
//-- fin mod : invision view profile -------------------------------------------

if ( !empty($profiledata['user_icq']) )
{
	$icq_status_img = '<a href="http://wwp.icq.com/' . $profiledata['user_icq'] . '#pager"><img src="http://web.icq.com/whitepages/online?icq=' . $profiledata['user_icq'] . '&img=5" width="18" height="18" border="0" /></a>';
	$icq_img = '<a href="http://wwp.icq.com/scripts/search.dll?to=' . $profiledata['user_icq'] . '"><img src="' . $images['icon_icq'] . '" alt="' . $lang['ICQ'] . '" title="' . $lang['ICQ'] . '" border="0" /></a>';
	$icq =  '<a href="http://wwp.icq.com/scripts/search.dll?to=' . $profiledata['user_icq'] . '">' . $lang['ICQ'] . '</a>';
}
else
{
//-- mod : invision view profile -----------------------------------------------
//-- delete
/*-MOD
	$icq_status_img = '&nbsp;';
	$icq_img = '&nbsp;';
	$icq = '&nbsp;';
MOD-*/
//-- add
	$icq_status_img = $lang['Invision_Empty_field'];
	$icq_img = $lang['Invision_Empty_field'];
	$icq = $lang['Invision_Empty_field'];
//-- fin mod : invision view profile -------------------------------------------
}

//-- mod : invision view profile -----------------------------------------------
//-- delete
/*-MOD
$aim_img = ( $profiledata['user_aim'] ) ? '<a href="aim:goim?screenname=' . $profiledata['user_aim'] . '&amp;message=Hello+Are+you+there?"><img src="' . $images['icon_aim'] . '" alt="' . $lang['AIM'] . '" title="' . $lang['AIM'] . '" border="0" /></a>' : '&nbsp;';
$aim = ( $profiledata['user_aim'] ) ? '<a href="aim:goim?screenname=' . $profiledata['user_aim'] . '&amp;message=Hello+Are+you+there?">' . $lang['AIM'] . '</a>' : '&nbsp;';
MOD-*/
//-- add
$aim_img = ( $profiledata['user_aim'] ) ? '<a href="aim:goim?screenname=' . $profiledata['user_aim'] . '&amp;message=Hello+Are+you+there?"><img src="' . $images['icon_aim'] . '" alt="' . $lang['AIM'] . '" title="' . $lang['AIM'] . '" border="0" /></a>' : $lang['Invision_Empty_field'];
$aim = ( $profiledata['user_aim'] ) ? '<a href="aim:goim?screenname=' . $profiledata['user_aim'] . '&amp;message=Hello+Are+you+there?">' . $lang['AIM'] . '</a>' : $lang['Invision_Empty_field'];
//-- fin mod : invision view profile -------------------------------------------

//-- mod : invision view profile -----------------------------------------------
//-- delete
/*-MOD
$msn_img = ( $profiledata['user_msnm'] ) ? $profiledata['user_msnm'] : '&nbsp;';
$msn = $msn_img;
MOD-*/
//-- add
$msn_img = ( $profiledata['user_msnm'] ) ? '<a href="http://members.msn.com/' . $profiledata['user_msnm'] . '" target="_blank"><img src="' . $images['icon_msnm'] . '" alt="' . $lang['MSNM'] . '" title="' . $lang['MSNM'] . '" border="0" /></a>' : $lang['Invision_Empty_field']; 
$msn = ( $profiledata['user_msnm'] ) ? $profiledata['user_msnm'] : $lang['Invision_Empty_field'];
//-- fin mod : invision view profile -------------------------------------------

//-- mod : skype ---------------------------------------------------------------
//-- add
//-- mod : invision view profile -----------------------------------------------
//-- delete
/*-MOD
$skype_img = ( $profiledata['user_skype'] ) ? '<a href="callto://' . $profiledata['user_skype'] . '"><img src="' . $images['icon_skype'] . '" alt="' . $lang['SKYPE'] . '" title="' . $lang['SKYPE'] . '" border="0" /></a>' : '';
$skype = ( $profiledata['user_skype'] ) ? '<a href="callto://' . $profiledata['user_skype'] . '">' . $lang['SKYPE'] . '</a>' : '';
MOD-*/
//-- add
$skype_img = ( $profiledata['user_skype'] ) ? '<a href="callto://' . $profiledata['user_skype'] . '"><img src="' . $images['icon_skype'] . '" alt="' . $lang['SKYPE'] . '" title="' . $lang['SKYPE'] . '" border="0" /></a>' : $lang['Invision_Empty_field'];
$skype = ( $profiledata['user_skype'] ) ? '<a href="callto://' . $profiledata['user_skype'] . '">' . $lang['SKYPE'] . '</a>' : $lang['Invision_Empty_field'];
//-- fin mod : skype -----------------------------------------------------------

//-- mod : invision view profile -----------------------------------------------
//-- delete
/*-MOD
$yim_img = ( $profiledata['user_yim'] ) ? '<a href="http://edit.yahoo.com/config/send_webmesg?.target=' . $profiledata['user_yim'] . '&amp;.src=pg"><img src="' . $images['icon_yim'] . '" alt="' . $lang['YIM'] . '" title="' . $lang['YIM'] . '" border="0" /></a>' : '';
$yim = ( $profiledata['user_yim'] ) ? '<a href="http://edit.yahoo.com/config/send_webmesg?.target=' . $profiledata['user_yim'] . '&amp;.src=pg">' . $lang['YIM'] . '</a>' : '';
MOD-*/
//-- add
$yim_img = ( $profiledata['user_yim'] ) ? '<a href="http://edit.yahoo.com/config/send_webmesg?.target=' . $profiledata['user_yim'] . '&amp;.src=pg"><img src="' . $images['icon_yim'] . '" alt="' . $lang['YIM'] . '" title="' . $lang['YIM'] . '" border="0" /></a>' : $lang['Invision_Empty_field'];
$yim = ( $profiledata['user_yim'] ) ? '<a href="http://edit.yahoo.com/config/send_webmesg?.target=' . $profiledata['user_yim'] . '&amp;.src=pg">' . $lang['YIM'] . '</a>' : $lang['Invision_Empty_field'];
//-- fin mod : invision view profile -------------------------------------------

$temp_url = append_sid("search.$phpEx?search_author=" . urlencode($profiledata['username']) . "&amp;showresults=posts");
$search_img = '<a href="' . $temp_url . '"><img src="' . $images['icon_search'] . '" alt="' . sprintf($lang['Search_user_posts'], $profiledata['username']) . '" title="' . sprintf($lang['Search_user_posts'], $profiledata['username']) . '" border="0" /></a>';
$search = '<a href="' . $temp_url . '">' . sprintf($lang['Search_user_posts'], $profiledata['username']) . '</a>';

//-- mod : points system -------------------------------------------------------
//-- add
$user_points = ($userdata['user_level'] == ADMIN || user_is_authed($userdata['user_id'])) ? '<a href="' . append_sid("pointscp.$phpEx?" . POST_USERS_URL . "=" . $profiledata['user_id']) . '" class="gen" title="' . sprintf($lang['Points_link_title'], $board_config['points_name']) . '">' . $profiledata['user_points'] . '</a>' : $profiledata['user_points'];

if ($board_config['points_donate'] && $userdata['user_id'] != ANONYMOUS && $userdata['user_id'] != $profiledata['user_id'])
{
	$donate_points = '<br />' . sprintf($lang['Points_donate'], '<a href="' . append_sid("pointscp.$phpEx?mode=donate&amp;" . POST_USERS_URL . "=" . $profiledata['user_id']) . '" class="genmed" title="' . sprintf($lang['Points_link_title_2'], $board_config['points_name']) . '">', '</a>');
}
else
{
	$donate_points = '';
}
//-- fin mod : points system ---------------------------------------------------

//-- mod : invision view profile -----------------------------------------------
//-- add
$user_sig = '';
if ( $profiledata['user_attachsig'] && $board_config['allow_sig'] )
{
	include($phpbb_root_path . 'includes/bbcode.'.$phpEx);
	$user_sig = $profiledata['user_sig'];
	$user_sig_bbcode_uid = $profiledata['user_sig_bbcode_uid'];
	if ( $user_sig != '' )
	{
		if ( !$board_config['allow_html'] && $profiledata['user_allowhtml'] )
		{
			$user_sig = preg_replace('#(<)([\/]?.*?)(>)#is', "&lt;\\2&gt;", $user_sig);
		}

		if ( $board_config['allow_bbcode'] && $user_sig_bbcode_uid != '' )
		{
			$user_sig = ( $board_config['allow_bbcode'] ) ? bbencode_second_pass($user_sig, $user_sig_bbcode_uid) : preg_replace('/\:[0-9a-z\:]+\]/si', ']', $user_sig);
		}

		$user_sig = make_clickable($user_sig);

		if ( !$userdata['user_allowswearywords'] )
		{
			$orig_word = !empty($orig_word) ? $orig_word : array();
			$replacement_word = !empty($replacement_word) ? $replacement_word : array();
			obtain_word_list($orig_word, $replacement_word);
			$user_sig = preg_replace($orig_word, $replacement_word, $user_sig);
		}

		if ( $profiledata['user_allowsmile'] )
		{
			$user_sig = smilies_pass($user_sig);
		}

		$user_sig = str_replace("\n", "\n<br />\n", $user_sig);
	}

	$template->assign_block_vars('switch_user_sig_block', array());
}
//-- fin mod : invision view profile -------------------------------------------

//-- mod : rank color system ---------------------------------------------------
//-- add
$username_color = $rcs->get_colors($profiledata, $profiledata['username']);
//-- fin mod : rank color system -----------------------------------------------

//-- mod : birthday ------------------------------------------------------------
//-- add
$bdays->get_user_bday($profiledata['user_birthday'], $profiledata['username']);
//-- fin mod : birthday --------------------------------------------------------

//-- mod : gender --------------------------------------------------------------
//-- add
if ( !empty($profiledata['user_gender']) )
{
	switch ($profiledata['user_gender'])
	{
		case 1:
			$gender = $lang['Male'];
			break;
		case 2:
			$gender = $lang['Female'];
			break;
		default:
			$gender = $lang['No_gender_specify'];
	}
}
else
{
	$gender = $lang['No_gender_specify'];
}
//-- fin mod : gender ----------------------------------------------------------

//
// Generate page
//
$page_title = $lang['Viewing_profile'];
include($phpbb_root_path . 'includes/page_header.'.$phpEx);

//-- mod : online offline hidden -----------------------------------------------
//-- add
if ($profiledata['user_session_time'] >= (time()-$board_config['online_time']))
{
	if ($profiledata['user_allow_viewonline'])
	{
		$online_status_img = '<a href="' . append_sid("viewonline.$phpEx") . '"><img src="' . $images['icon_online_bull'] . '" alt="' . sprintf($lang['is_online'], $profiledata['username']) . '" title="' . sprintf($lang['is_online'], $profiledata['username']) . '" /></a>';
		$online_status = '<strong><a href="' . append_sid("viewonline.$phpEx") . '" title="' . sprintf($lang['is_online'], $profiledata['username']) . '"' . $online_color . '>' . $lang['Online'] . '</a></strong>';
	}
	else if ($userdata['user_level'] == ADMIN || $userdata['user_id'] == $profiledata['user_id'])
	{
		$online_status_img = '<a href="' . append_sid("viewonline.$phpEx") . '"><img src="' . $images['icon_hidden_bull'] . '" alt="' . sprintf($lang['is_hidden'], $profiledata['username']) . '" title="' . sprintf($lang['is_hidden'], $profiledata['username']) . '" /></a>';
		$online_status = '<strong><em><a href="' . append_sid("viewonline.$phpEx") . '" title="' . sprintf($lang['is_hidden'], $profiledata['username']) . '"' . $hidden_color . '>' . $lang['Hidden'] . '</a></em></strong>';
	}
	else
	{
		$online_status_img = '<img src="' . $images['icon_offline_bull'] . '" alt="' . sprintf($lang['is_offline'], $profiledata['username']) . '" title="' . sprintf($lang['is_offline'], $profiledata['username']) . '" />';
		$online_status = '<span title="' . sprintf($lang['is_offline'], $profiledata['username']) . '"' . $offline_color . '><strong>' . $lang['Offline'] . '</strong></span>';
	}
}
else
{
	$online_status_img = '<img src="' . $images['icon_offline_bull'] . '" alt="' . sprintf($lang['is_offline'], $profiledata['username']) . '" title="' . sprintf($lang['is_offline'], $profiledata['username']) . '" />';
	$online_status = '<span title="' . sprintf($lang['is_offline'], $profiledata['username']) . '"' . $offline_color . '><strong>' . $lang['Offline'] . '</strong></span>';
}
//-- fin mod : online offline hidden -------------------------------------------

//-- mod : attachment mod ------------------------------------------------------
//-- add
display_upload_attach_box_limits($profiledata['user_id']);
//-- fin mod : attachment mod --------------------------------------------------

if (function_exists('get_html_translation_table'))
{
	$u_search_author = urlencode(strtr($profiledata['username'], array_flip(get_html_translation_table(HTML_ENTITIES))));
}
else
{
	$u_search_author = urlencode(str_replace(array('&amp;', '&#039;', '&quot;', '&lt;', '&gt;'), array('&', "'", '"', '<', '>'), $profiledata['username']));
}

$template->assign_vars(array(
//-- mod : rank color system ---------------------------------------------------
//-- delete
/*-MOD
	'USERNAME' => $profiledata['username'],
MOD-*/
//-- add
	'USERNAME' => $username_color,
//-- fin mod : rank color system -----------------------------------------------
	'JOINED' => create_date($lang['DATE_FORMAT'], $profiledata['user_regdate'], $board_config['board_timezone']),

//-- mod : mini last visit -----------------------------------------------------
//-- add
	'L_VISITED' => $lang['Visited'],
	'VISITED' => display_last_visit($profiledata['user_id'], $profiledata['user_lastlogin'], $profiledata['user_allow_viewonline']),
//-- fin mod : mini last visit -------------------------------------------------

	'POSTER_RANK' => $poster_rank,
	'RANK_IMAGE' => $rank_image,
	'POSTS_PER_DAY' => $posts_per_day,
	'POSTS' => $profiledata['user_posts'],
	'PERCENTAGE' => $percentage . '%', 
	'POST_DAY_STATS' => sprintf($lang['User_post_day_stats'], $posts_per_day), 
	'POST_PERCENT_STATS' => sprintf($lang['User_post_pct_stats'], $percentage), 

//-- mod : ip country flag -----------------------------------------------------
//-- add
	'COUNTRY' => $lang['IP2Country'][$profiledata['user_cf_iso3661_1']],
	'FLAG' => $profiledata['user_cf_iso3661_1'],
	'L_COUNTRY' => $lang['Country'],
//-- fin mod : ip country flag -------------------------------------------------

//-- mod : invision view profile -----------------------------------------------
//-- add
	'INVISION_MOST_ACTIVE_FORUM_URL' => $user_most_active_forum_url,
	'INVISION_MOST_ACTIVE_FORUM_NAME' => $user_most_active_forum_name,
	'INVISION_POST_DAY_STATS' => sprintf($lang['Invision_User_post_day_stats'], $posts_per_day), 
	'INVISION_POST_PERCENT_STATS' => sprintf($lang['Invision_User_post_pct_stats'], $percentage),
	'INVISION_USER_SIG' => $user_sig,
//-- fin mod : invision view profile -------------------------------------------

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

//-- mod : topics a user has started -------------------------------------------
//-- add
	'TOPICS' => $profiledata['user_topics'],
	'L_TOPICS' => $lang['Topics_Started'],
//-- mod : rank color system ---------------------------------------------------
//-- delete
/*-MOD
	'L_SEARCH_USER_TOPICS' => sprintf($lang['Search_user_topics'], $profiledata['username']),
MOD-*/
//-- add
	'L_SEARCH_USER_TOPICS' => sprintf($lang['Search_user_topics'], $username_color),
//-- fin mod : rank color system -----------------------------------------------
	'U_SEARCH_USER_TOPICS' => append_sid("search.$phpEx?search_id=usertopics&user=" . $profiledata['user_id']),
	'TOPIC_DAY_STATS' => sprintf($lang['User_topic_day_stats'], $topics_per_day),
	'TOPIC_PERCENT_STATS' => sprintf($lang['User_topic_pct_stats'], $topics_percentage), 
//-- fin mod : topics a user has started ---------------------------------------

//-- mod : jail mod ------------------------------------------------------------
//-- add
	'CELLEDS' => $profiledata['user_cell_celleds'],
	'L_CELLEDS' => $lang['Celleds_time'],
	'U_CELLEDS' => append_sid("courthouse.$phpEx?from=celleds_list"),
//-- fin mod : jail mod --------------------------------------------------------

//-- mod : points system -------------------------------------------------------
//-- add
	'POINTS' => $user_points,
	'DONATE_POINTS' => $donate_points,
//-- fin mod : points system ---------------------------------------------------

//-- mod : gender --------------------------------------------------------------
//-- add
	'GENDER' => $gender,
	'L_GENDER' => $lang['Gender'],
//-- fin mod : gender ----------------------------------------------------------

//-- mod : invision view profile -----------------------------------------------
//-- delete
/*-MOD
	'LOCATION' => ( $profiledata['user_from'] ) ? $profiledata['user_from'] : '&nbsp;',
	'OCCUPATION' => ( $profiledata['user_occ'] ) ? $profiledata['user_occ'] : '&nbsp;',
	'INTERESTS' => ( $profiledata['user_interests'] ) ? $profiledata['user_interests'] : '&nbsp;',
MOD-*/
//-- add
	'LOCATION' => ( $profiledata['user_from'] ) ? $profiledata['user_from'] : $lang['Invision_Empty_field'],
	'OCCUPATION' => ( $profiledata['user_occ'] ) ? $profiledata['user_occ'] : $lang['Invision_Empty_field'],
	'INTERESTS' => ( $profiledata['user_interests'] ) ? $profiledata['user_interests'] : $lang['Invision_Empty_field'],
//-- fin mod : invision view profile -------------------------------------------
	'AVATAR_IMG' => $avatar_img,

//-- mod : rank color system ---------------------------------------------------
//-- delete
/*-MOD
	'L_VIEWING_PROFILE' => sprintf($lang['Viewing_user_profile'], $profiledata['username']),
	'L_ABOUT_USER' => sprintf($lang['About_user'], $profiledata['username']),
MOD-*/
//-- add
	'L_VIEWING_PROFILE' => sprintf($lang['Viewing_user_profile'], $username_color),
	'L_ABOUT_USER' => sprintf($lang['About_user'], $username_color),
//-- fin mod : rank color system -----------------------------------------------
	'L_AVATAR' => $lang['Avatar'], 
	'L_POSTER_RANK' => $lang['Poster_rank'], 
	'L_JOINED' => $lang['Joined'], 
	'L_TOTAL_POSTS' => $lang['Total_posts'], 
//-- mod : rank color system ---------------------------------------------------
//-- delete
/*-MOD
	'L_SEARCH_USER_POSTS' => sprintf($lang['Search_user_posts'], $profiledata['username']),
MOD-*/
//-- add
	'L_SEARCH_USER_POSTS' => sprintf($lang['Search_user_posts'], $username_color),
//-- fin mod : rank color system ----------------------------------------------- 
	'L_CONTACT' => $lang['Contact'],
	'L_EMAIL_ADDRESS' => $lang['Email_address'],
	'L_EMAIL' => $lang['Email'],
	'L_PM' => $lang['Private_Message'],
	'L_ICQ_NUMBER' => $lang['ICQ'],
	'L_YAHOO' => $lang['YIM'],
	'L_AIM' => $lang['AIM'],
	'L_MESSENGER' => $lang['MSNM'],

//-- mod : skype ---------------------------------------------------------------
//-- add
	'L_SKYPE' => $lang['SKYPE'],
//-- fin mod : skype -----------------------------------------------------------

	'L_WEBSITE' => $lang['Website'],
	'L_LOCATION' => $lang['Location'],
	'L_OCCUPATION' => $lang['Occupation'],
	'L_INTERESTS' => $lang['Interests'],

//-- mod : online offline hidden -----------------------------------------------
//-- add
	'ONLINE_STATUS_IMG' => $online_status_img,
	'ONLINE_STATUS' => $online_status,
	'L_ONLINE_STATUS' => $lang['Online_status'],
//-- fin mod : online offline hidden -------------------------------------------

//-- mod : points system -------------------------------------------------------
//-- add
	'L_POINTS' => $board_config['points_name'],
//-- fin mod : points system ---------------------------------------------------

//-- mod : invision view profile -----------------------------------------------
//-- add
	'L_INVISION_A_STATS' => $lang['Invision_Active_Stats'],
	'L_INVISION_COMMUNICATE' => $lang['Invision_Communicate'],
	'L_INVISION_INFO' => $lang['Invision_Info'],
	'L_INVISION_MEMBER_TITLE' => $lang['Invision_Member_Title'],
	'L_INVISION_MEMBER_GROUP' => $lang['Invision_Member_Group'],
	'L_INVISION_MOST_ACTIVE' => $lang['Invision_Most_Active'],
	'L_INVISION_MOST_ACTIVE_POSTS' => sprintf($lang['Invision_Most_Active_Posts'], $user_most_active_posts),
	'L_INVISION_P_DETAILS' => $lang['Invision_Details'],
	'L_INVISION_POSTS' => $lang['Invision_Total_Posts'],
	'L_INVISION_PPD_STATS' => $lang['Invision_PPD_Stats'],
	'L_INVISION_SIGNATURE' => $lang['Invision_Signature'],
	'L_INVISION_WEBSITE' => $lang['Invision_Website'],
//-- fin mod : invision view profile -------------------------------------------

	'U_SEARCH_USER' => append_sid("search.$phpEx?search_author=" . $u_search_author),

	'S_PROFILE_ACTION' => append_sid('profile.'.$phpEx))
);

//-- mod : hide empty fields in user profile -----------------------------------
//-- add
if (!$profiledata['user_viewemail'] || ($userdata['user_level'] == ADMIN ))
{	
	$template->assign_block_vars('hide_user_viewemail',array());
}
if (!empty($profiledata['user_msnm']))
{	
	$template->assign_block_vars('hide_user_msnm',array());
}
if (!empty($profiledata['user_yim']))
{	
	$template->assign_block_vars('hide_user_yim',array());
}
if (!empty($profiledata['user_aim']))
{	
	$template->assign_block_vars('hide_user_aim',array());
}
if (!empty($profiledata['user_icq']))
{	
	$template->assign_block_vars('hide_user_icq',array());
}
if (!empty($profiledata['user_from']))
{	
	$template->assign_block_vars('hide_user_from',array());
}
if (!empty($profiledata['user_website']))
{	
	$template->assign_block_vars('hide_user_website',array());
}
if (!empty($profiledata['user_occ']))
{	
	$template->assign_block_vars('hide_user_occ',array());
}
if (!empty($profiledata['user_interests']))
{	
	$template->assign_block_vars('hide_user_interests',array());
}
//-- mod : skype ---------------------------------------------------------------
//-- add
if (!empty($profiledata['user_skype']))
{	
	$template->assign_block_vars('hide_user_skype',array());
}
//-- fin mod : skype -----------------------------------------------------------
//-- mod : birthday ------------------------------------------------------------
//-- add
if (!empty($profiledata['user_birthday']))
{	
	$template->assign_block_vars('hide_user_birthday',array());
}
//-- fin mod : birthday --------------------------------------------------------
//-- mod : birthday ------------------------------------------------------------
//-- add
if (!$profiledata['user_gender'])
{	
	$template->assign_block_vars('hide_user_gender',array());
}
//-- fin mod : birthday --------------------------------------------------------
//-- fin mod : hide empty fields in user profile -------------------------------

//-- mod : quick administrator user options and informations -------------------
//-- add
if ( $userdata['user_level'] == ADMIN )
{
	$template->assign_block_vars('switch_user_admin', array());

	$sql = 'SELECT ban_userid   
		FROM ' . BANLIST_TABLE . ' 
		WHERE ban_userid = ' . $profiledata['user_id'];
	if ( !($result = $db->sql_query($sql)) )
	{
		message_die(GENERAL_ERROR, 'Could not look up banned status', '', __LINE__, __FILE__, $sql);
	}
	
	if ( $row = $db->sql_fetchrow($result) )
	{
		$banned_username = $row['ban_userid'];
	}
	
	$db->sql_freeresult($result);
	
	$sql = 'SELECT ban_email  
		FROM ' . BANLIST_TABLE . ' 
		WHERE ban_email = "' . $profiledata['user_email'] . '"';
	if ( !($result = $db->sql_query($sql)) )
	{
		message_die(GENERAL_ERROR, 'Could not look up banned status', '', __LINE__, __FILE__, $sql);
	}
	
	if ( $row = $db->sql_fetchrow($result) )
	{
		$banned_email = $row['ban_email'];
	}

	$db->sql_freeresult($result);
	
	if ( $userdata['session_admin'] )
	{
		$u_edit_profile = 'admin/admin_users.' . $phpEx . '?' . POST_USERS_URL . '=' . $profiledata['user_id'] . '&amp;mode=edit&amp;returntoprofile=1&amp;sid=' . $userdata['session_id'];
		$u_edit_permissions = 'admin/admin_ug_auth.' . $phpEx . '?' . POST_USERS_URL . '=' . $profiledata['user_id'] . '&amp;mode=user&amp;returntoprofile=1&amp;sid=' . $userdata['session_id'];
	}
	else
	{
		$u_edit_profile = append_sid('login.' . $phpEx . '?redirect=admin/admin_users.' . $phpEx . '&amp;' . POST_USERS_URL . '=' . $profiledata['user_id'] . '&amp;mode=edit&amp;returntoprofile=1&amp;admin=1');
		$u_edit_permissions = append_sid('login.' . $phpEx . '?redirect=admin/admin_ug_auth.' . $phpEx . '&amp;' . POST_USERS_URL . '=' . $profiledata['user_id'] . '&amp;mode=user&amp;returntoprofile=1&amp;admin=1');
	}

	$template->assign_vars(array(
		'L_QUICK_ADMIN_OPTIONS' => $lang['Quick_admin_options'],
//-- mod : rank color system ---------------------------------------------------
//-- delete
/*-MOD
		'L_ADMIN_EDIT_PROFILE' => $lang['Admin_edit_profile'],
		'L_ADMIN_EDIT_PERMISSIONS' => $lang['Admin_edit_permissions'],
		'L_USER_ACTIVE_INACTIVE' => ($profiledata['user_active']) ? $lang['User_active'] : $lang['User_not_active'],
		'L_BANNED_USERNAME' => ($banned_username) ? $lang['Username_banned'] : $lang['Username_not_banned'],
		'L_BANNED_EMAIL' => ($banned_email) ? sprintf($lang['User_email_banned'], $profiledata['user_email']) : $lang['User_email_not_banned'],
MOD-*/
//-- add
		'L_ADMIN_EDIT_PROFILE' => sprintf($lang['Admin_edit_profile'], $username_color),
		'L_ADMIN_EDIT_PERMISSIONS' => sprintf($lang['Admin_edit_permissions'], $username_color),
		'L_USER_ACTIVE_INACTIVE' => ($profiledata['user_active']) ? sprintf($lang['User_active'], $username_color) : sprintf($lang['User_not_active'], $username_color),
		'L_BANNED_USERNAME' => ($banned_username) ? sprintf($lang['Username_banned'], $username_color) : sprintf($lang['Username_not_banned'], $username_color),
		'L_BANNED_EMAIL' => ($banned_email) ? sprintf($lang['User_email_banned'], $username_color, $profiledata['user_email']) : sprintf($lang['User_email_not_banned'], $username_color),
//-- fin mod : rank color system -----------------------------------------------
	
		'U_ADMIN_EDIT_PROFILE' => $u_edit_profile,
		'U_ADMIN_EDIT_PERMISSIONS' => $u_edit_permissions,
	));
}
//-- fin mod : quick administrator user options and informations ---------------

$template->pparse('body');

include($phpbb_root_path . 'includes/page_tail.'.$phpEx);

?>
