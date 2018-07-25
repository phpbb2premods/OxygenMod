<?php
/**
*
* @version $Id: shoutbox_max.php,v 1.0.5 11/02/2006 23:16 PastisD Exp $
* @copyright (c) 2006 PastisD
* @license http://opensource.org/licenses/gpl-license.php GNU Public License 
*
* Original author : Malach, http://www.phantasia-fr.com, 2006
*
*/

define('IN_PHPBB', true);
$phpbb_root_path = './';
$phpEx = substr(strrchr(__FILE__, '.'), 1);

include($phpbb_root_path . 'common.'.$phpEx);
require_once($phpbb_root_path . 'includes/bbcode.'.$phpEx);
include($phpbb_root_path . 'includes/functions_post.'.$phpEx);

$userdata = session_pagestart($user_ip, PAGE_INDEX);
init_userprefs($userdata);

switch ($userdata['user_level'])
{
	case ADMIN : 
	case MOD :
		$is_auth['auth_mod'] = 1;
	default:
		$is_auth['auth_read'] = 1;
		$is_auth['auth_view'] = 1;
		if ($userdata['user_id'] == ANONYMOUS)
		{
			$is_auth['auth_delete'] = 0;
			$is_auth['auth_post'] = 0;
		} 
		else
		{
			$is_auth['auth_delete'] = 1;
			$is_auth['auth_post'] = 1;
		}
}

if( !$is_auth['auth_read'] )
{
	message_die(GENERAL_MESSAGE, $lang['Not_Authorised']);
}

$forum_id = PAGE_INDEX;

$refresh = (isset($HTTP_POST_VARS['auto_refresh']) || isset($HTTP_POST_VARS['refresh'])) ? 1 : 0;
$preview = (isset($HTTP_POST_VARS['preview'])) ? 1 : 0;
$submit = (isset($HTTP_POST_VARS['shout']) && isset($HTTP_POST_VARS['message'])) ? 1 : 0;

if ( isset($HTTP_POST_VARS['mode']) || isset($HTTP_GET_VARS['mode']) )
{
	$mode = ( isset($HTTP_POST_VARS['mode']) ) ? $HTTP_POST_VARS['mode'] : $HTTP_GET_VARS['mode'];
}
else
{
	$mode = '';
}

if ( !$board_config['allow_html'] )
{
	$html_on = 0;
}
else
{
	$html_on = ( $submit || $refresh || preview) ? ( ( !empty($HTTP_POST_VARS['disable_html']) ) ? 0 : TRUE ) : ( ( $userdata['user_id'] == ANONYMOUS ) ? $board_config['allow_html'] : $userdata['user_allowhtml'] );
}

if ( !$board_config['allow_bbcode'] )
{
	$bbcode_on = 0;
}
else
{
	$bbcode_on = ( $submit || $refresh || preview) ? ( ( !empty($HTTP_POST_VARS['disable_bbcode']) ) ? 0 : TRUE ) : ( ( $userdata['user_id'] == ANONYMOUS ) ? $board_config['allow_bbcode'] : $userdata['user_allowbbcode'] );
}

if ( !$board_config['allow_smilies'] )
{
	$smilies_on = 0;
}
else
{
	$smilies_on = ( $submit || $refresh || preview) ? ( ( !empty($HTTP_POST_VARS['disable_smilies']) ) ? 0 : TRUE ) : ( ( $userdata['user_id'] == ANONYMOUS ) ? $board_config['allow_smilies'] : $userdata['user_allowsmile'] );
}

if( !$userdata['session_logged_in'] || ( $mode == 'editpost' && $post_info['poster_id'] == ANONYMOUS ) )
{
	$template->assign_block_vars('switch_username_select', array());
}

$username = ( !empty($HTTP_POST_VARS['username']) ) ? $HTTP_POST_VARS['username'] : '';

if (!empty($username))
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

if ($submit || isset($HTTP_POST_VARS['message']))
{
	$current_time = time();

//-- mod : no flood limit for admins & mods ------------------------------------
//-- add
	if($userdata['user_level'] != ADMIN && $userdata['user_level'] != MOD)
	{
//-- mod : no flood limit for admins & mods ------------------------------------
		$where_sql = ( $userdata['user_id'] == ANONYMOUS ) ? "shout_ip = '$user_ip'" : 'sb_user_id = ' . $userdata['user_id'];
		$sql = "SELECT MAX(timestamp) AS last_post_time
			FROM " . SHOUTBOX_TABLE . "
			WHERE $where_sql";
		if ( $result = $db->sql_query($sql) )
		{
			if ( $row = $db->sql_fetchrow($result) )
			{
				if ( $row['last_post_time'] > 0 && ( $current_time - $row['last_post_time'] ) < $board_config['flood_interval'] )
				{
					$error = true;
					$error_msg .= ( !empty($error_msg) ) ? '<br />' . $lang['Flood_Error'] : $lang['Flood_Error'];
				}
			}
		}
//-- mod : no flood limit for admins & mods ------------------------------------
//-- add
	}
//-- mod : no flood limit for admins & mods ------------------------------------

	$message = (isset($HTTP_POST_VARS['message'])) ? trim($HTTP_POST_VARS['message']) : '';

	if (!empty($message) && $is_auth['auth_post'] && !$error)
	{
		require_once($phpbb_root_path . 'includes/functions_post.'.$phpEx);

		$bbcode_uid = ( $bbcode_on ) ? make_bbcode_uid() : '';
		$message = prepare_message(trim($message), $html_on, $bbcode_on, $smilies_on, $bbcode_uid);
		$username = $userdata['username'];

		$sql = "INSERT INTO " . SHOUTBOX_TABLE. " (msg, timestamp, sb_user_id, shout_ip, sb_username, shout_bbcode_uid, enable_bbcode, enable_html, enable_smilies) 
			VALUES ('$message', '" . time() . "', '" . $userdata['user_id'] . "', '$user_ip', '" . $username . "', '" . $bbcode_uid . "', $bbcode_on, $html_on, $smilies_on)";
		if (!$result = $db->sql_query($sql)) 
		{
			message_die(GENERAL_ERROR, 'Error inserting shout.', '', __LINE__, __FILE__, $sql);
		}
	}
}
else if ($mode=='delete' || $mode=='censor')
{
	if ( isset($HTTP_GET_VARS[POST_POST_URL]) || isset($HTTP_POST_VARS[POST_POST_URL]))
	{
		$post_id = (isset($HTTP_POST_VARS[POST_POST_URL])) ? intval($HTTP_POST_VARS[POST_POST_URL]) : intval($HTTP_GET_VARS[POST_POST_URL]);
	}
	else
	{
		message_die(GENERAL_ERROR, 'Error no shout id specifyed for delete/censor.', '', __LINE__, __FILE__);
	}

	$sql = "SELECT s.sb_user_id, shout_ip
		FROM " . SHOUTBOX_TABLE . " s
		WHERE s.id = '$post_id'";
	if ( !($result = $db->sql_query($sql)) )
	{
		message_die(GENERAL_ERROR, 'Could not get shoutbox information', '', __LINE__, __FILE__, $sql);
	}

	$shout_identifyer = $db->sql_fetchrow($result);
	$user_id = $shout_identifyer['sb_user_id'];

	if (($userdata['user_id'] != ANONYMOUS || ( $userdata['user_id'] == ANONYMOUS && $userdata['session_ip'] == $shout_identifyer['shout_ip'])) && (($userdata['user_id'] == $user_id && $is_auth['auth_delete']) || $is_auth['auth_mod']) && $mode=='censor')
	{
		$sql = "UPDATE " . SHOUTBOX_TABLE . "
			SET msg ='" . Censuré . "' WHERE id = '$post_id'";
		if (!$result = $db->sql_query($sql))
		{
			message_die(GENERAL_ERROR, 'Error censor shout.', '', __LINE__, __FILE__, $sql);
		}
	}
	else if ( $is_auth['auth_mod'] && $mode=='delete')
	{
		$sql = "DELETE FROM " . SHOUTBOX_TABLE . "
			WHERE id = '$post_id'";
		if (!$result = $db->sql_query($sql)) 
		{
			message_die(GENERAL_ERROR, 'Error removing shout.', '', __LINE__, __FILE__, $sql);
		}
	}
	else
	{
		message_die(GENERAL_MESSAGE, 'Not allowed.', '', __LINE__, __FILE__);
	}
}
else if ($mode=='ip')
{
	if ( !$is_auth['auth_mod'])
	{
		message_die(GENERAL_MESSAGE, 'Not allowed.', '', __LINE__, __FILE__);
	}

	if ( isset($HTTP_GET_VARS[POST_POST_URL]) || isset($HTTP_POST_VARS[POST_POST_URL]))
	{
		$post_id = (isset($HTTP_POST_VARS[POST_POST_URL])) ? intval($HTTP_POST_VARS[POST_POST_URL]) : intval($HTTP_GET_VARS[POST_POST_URL]);
	}
	else
	{
		message_die(GENERAL_ERROR, 'Error no shout id specifyed for show ip', '', __LINE__, __FILE__);
	}

	$sql = "SELECT s.sb_user_id, sb_username, shout_ip
		FROM " . SHOUTBOX_TABLE . " s
		WHERE s.id = '$post_id'";
	if ( !($result = $db->sql_query($sql)) )
	{
		message_die(GENERAL_ERROR, 'Could not get shoutbox information', '', __LINE__, __FILE__, $sql);
	}

	$shout_identifyer = $db->sql_fetchrow($result);
	$poster_id = $shout_identifyer['sb_user_id'];
	$rdns_ip_num = ( isset($HTTP_GET_VARS['rdns']) ) ? $HTTP_GET_VARS['rdns'] : "";

	$ip_this_post = decode_ip($shout_identifyer['shout_ip']);
	$ip_this_post = ( $rdns_ip_num == $ip_this_post ) ? gethostbyaddr($ip_this_post) : $ip_this_post;

	require_once($phpbb_root_path . 'includes/page_header.'.$phpEx);

	$template->set_filenames(array('viewip' => 'modcp_viewip.tpl'));

	$template->assign_vars(array(
		'L_IP_INFO' => $lang['IP_info'],
		'L_THIS_POST_IP' => $lang['This_posts_IP'],
		'L_OTHER_IPS' => $lang['Other_IP_this_user'],
		'L_OTHER_USERS' => $lang['Users_this_IP'],
		'L_LOOKUP_IP' => $lang['Lookup_IP'],
		'L_SEARCH' => $lang['Search'],
		'SEARCH_IMG' => $images['icon_search'],
		'IP' => $ip_this_post, 
		'U_LOOKUP_IP' => append_sid('shoutbox_max.'.$phpEx . '?mode=ip&amp;' . POST_POST_URL . '=' . $post_id . '&amp;rdns=' . $ip_this_post)
	));

	$sql = "SELECT shout_ip, COUNT(*) AS postings 
		FROM " . SHOUTBOX_TABLE . " 
		WHERE sb_user_id = $poster_id 
		GROUP BY shout_ip 
		ORDER BY " . (( SQL_LAYER == 'msaccess' ) ? 'COUNT(*)' : 'postings' ) . " DESC";
	if ( !($result = $db->sql_query($sql)) )
	{
		message_die(GENERAL_ERROR, 'Could not get IP information for this user', '', __LINE__, __FILE__, $sql);
	}

	if ( $row = $db->sql_fetchrow($result) )
	{
		$i = 0;
		do
		{
			if ( $row['shout_ip'] == $post_row['shout_ip'] )
			{
				$template->assign_vars(array('POSTS' => $row['postings'] . ' ' . ( ( $row['postings'] == 1 ) ? $lang['Post'] : $lang['Posts'] )));
				continue;
			}

			$ip = decode_ip($row['shout_ip']);
			$ip = ( $rdns_ip_num == $row['shout_ip'] || $rdns_ip_num == 'all') ? gethostbyaddr($ip) : $ip;
			$row_color = ( !($i % 2) ) ? $theme['td_color1'] : $theme['td_color2'];
			$row_class = ( !($i % 2) ) ? $theme['td_class1'] : $theme['td_class2'];

			$template->assign_block_vars('iprow', array(
				'ROW_COLOR' => '#' . $row_color, 
				'ROW_CLASS' => $row_class, 
				'IP' => $ip,
				'POSTS' => $row['postings'] . ' ' . ( ( $row['postings'] == 1 ) ? $lang['Post'] : $lang['Posts'] ),
				'U_LOOKUP_IP' => append_sid('shoutbox_max.'.$phpEx . '?mode=ip&amp;' . POST_POST_URL . '=' . $post_id . '&amp;rdns=' . $row['shout_ip'])
			));
			$i++; 
		}
		while ( $row = $db->sql_fetchrow($result) );
	}

	$sql = "SELECT u.user_id, u.username, COUNT(*) as postings 
		FROM " . USERS_TABLE ." u, " . POSTS_TABLE . " p 
		WHERE p.poster_id = u.user_id 
			AND p.poster_ip = '" . $shout_identifyer['shout_ip'] . "'
		GROUP BY u.user_id, u.username
		ORDER BY " . (( SQL_LAYER == 'msaccess' ) ? 'COUNT(*)' : 'postings' ) . " DESC";
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
			$sb_username = ( $id == ANONYMOUS && $row['username'] == '' ) ? $lang['Guest'] : $row['username'];
			$row_color = ( !($i % 2) ) ? $theme['td_color1'] : $theme['td_color2'];
			$row_class = ( !($i % 2) ) ? $theme['td_class1'] : $theme['td_class2'];

			$template->assign_block_vars('userrow', array(
				'ROW_COLOR' => '#' . $row_color, 
				'ROW_CLASS' => $row_class, 
				'SB_USERNAME' => $sb_username,
				'USERNAME' => $username,
				'POSTS' => $row['postings'] . ' ' . ( ( $row['postings'] == 1 ) ? $lang['Post'] : $lang['Posts'] ),
				'L_SEARCH_POSTS' => sprintf($lang['Search_user_posts'], $sb_username), 
				'U_PROFILE' => append_sid('profile.'.$phpEx . '?mode=viewprofile&amp;' . POST_USERS_URL . '=' . $id),
				'U_SEARCHPOSTS' => append_sid('search.'.$phpEx . '?search_author=' . urlencode($sb_username) . '&amp;showresults=topics')
			));
			$i++; 
		}
		while ( $row = $db->sql_fetchrow($result) );
	}

	$template->pparse('viewip');
	require_once($phpbb_root_path . 'includes/page_tail.'.$phpEx);
	exit;
}

if ((isset($HTTP_POST_VARS['start']) || isset($HTTP_GET_VARS['start'])) && !$submit)
{
	$start = (isset($HTTP_POST_VARS['start'])) ? intval($HTTP_POST_VARS['start']) : intval($HTTP_GET_VARS['start']);
} 
else
{
	$start = 0;
}

$page_title = $lang['Shoutbox'];

require_once($phpbb_root_path . 'includes/functions_post.'.$phpEx);
require_once($phpbb_root_path . 'includes/page_header.'.$phpEx);

//-- mod : bbcode box reloaded -------------------------------------------------
//-- add
include($phpbb_root_path . 'includes/bbc_box_tags.'.$phpEx);
//-- fin mod : bbcode box reloaded ---------------------------------------------

$highlight_match = $highlight = '';
if (isset($HTTP_GET_VARS['highlight']))
{
	$highlight = trim(strip_tags(htmlspecialchars($HTTP_GET_VARS['highlight'])));
	$words = explode(' ', $highlight);
	for($i = 0; $i < count($words); $i++)
	{
		if ( trim($words[$i]) != '' )
		{
			$highlight_match .= (($highlight_match != '') ? '|' : '') . str_replace('*', '\w*', phpbb_preg_quote($words[$i], '#'));
		}
	}
	unset($words);
	$highlight = urlencode($highlight);
}

$orig_word = $replacement_word = array();
obtain_word_list($orig_word, $replacement_word);

$sql = 'SELECT COUNT(*) as total
	FROM ' . SHOUTBOX_TABLE; 
if ( !($result = $db->sql_query($sql)) )
{
	message_die(GENERAL_ERROR, 'Could not get shoutbox stat information', '', __LINE__, __FILE__, $sql);
}

$total_shouts = $db->sql_fetchrow($result);
$total_shouts = $total_shouts['total'];

if ($is_auth['auth_post'])
{
	$template->set_filenames(array('body' => 'shoutbox_max_body.tpl'));
} 
else
{
	$template->set_filenames(array('body' => 'shoutbox_max_guest_body.tpl'));
}

$pagination = ( $highlight_match ) ? generate_pagination('shoutbox_max.'.$phpEx . '?highlight=' . $highlight, $total_shouts, $board_config['posts_per_page'], $start) : generate_pagination('shoutbox_max.'.$phpEx . '?dummy=1', $total_shouts, $board_config['posts_per_page'], $start);
generate_smilies('inline', PAGE_INDEX);

if ( $board_config['allow_html'] )
{
	$html_status = $lang['HTML_is_ON'];
	$template->assign_block_vars('switch_html_checkbox', array());
}
else
{
	$html_status = $lang['HTML_is_OFF'];
}

if ( $board_config['allow_bbcode'] )
{
	$bbcode_status = $lang['BBCode_is_ON'];
	$template->assign_block_vars('switch_bbcode_checkbox', array());
}
else
{
	$bbcode_status = $lang['BBCode_is_OFF'];
}

if ( $board_config['allow_smilies'] )
{
	$smilies_status = $lang['Smilies_are_ON'];
	$template->assign_block_vars('switch_smilies_checkbox', array());
}
else
{
	$smilies_status = $lang['Smilies_are_OFF'];
}

$sql = 'SELECT *
	FROM ' . RANKS_TABLE . '
	ORDER BY rank_special, rank_min';
if ( !($result = $db->sql_query($sql)) )
{
	message_die(GENERAL_ERROR, 'Could not obtain ranks information.', '', __LINE__, __FILE__, $sql);
}

$ranksrow = array();
while ( $row = $db->sql_fetchrow($result) )
{
	$ranksrow[] = $row;
}
$db->sql_freeresult($result);

$sql = 'SELECT s.*, u.*
	FROM ' . SHOUTBOX_TABLE . ' s, ' . USERS_TABLE . ' u
	WHERE s.sb_user_id = u.user_id
	ORDER BY s.timestamp
	DESC LIMIT ' . $start . ', ' . $board_config['posts_per_page'];
if ( !($result = $db->sql_query($sql)) )
{
	message_die(GENERAL_ERROR, 'Could not get shoutbox information', '', __LINE__, __FILE__, $sql);
}
while ($row = $db->sql_fetchrow($result))
{
	$i++;
	$row_color = ( !($i % 2) ) ? $theme['td_color1'] : $theme['td_color2'];
	$row_class = ( !($i % 2) ) ? $theme['td_class1'] : $theme['td_class2'];
	$user_id = $row['sb_user_id'];
	$msg = $row['msg'];

//-- mod : rank color system ---------------------------------------------------
//-- delete
/*-MOD
	$sb_username = ( $user_id == ANONYMOUS ) ? (( $row['sb_username'] == '' ) ? $lang['Guest'] : $row['sb_username'] ) : '<a href="' . append_sid('profile.'.$phpEx . '?mode=viewprofile&amp;' . POST_USERS_URL . '=' . $row['sb_user_id']) . '" alt="' . $lang['Read_profile'] . '" title="' . $lang['Read_profile'] . '" target="_top">' . $row['username'] . '</a>';
MOD-*/
//-- add
	$style_color = $rcs->get_colors($row);
	$sb_username = ( $user_id == ANONYMOUS ) ? (( $row['sb_username'] == '' ) ? $lang['Guest'] : $row['sb_username'] ) : '<a href="' . append_sid('profile.'.$phpEx . '?mode=viewprofile&amp;' . POST_USERS_URL . '=' . $row['sb_user_id']) . '" alt="' . $lang['Read_profile'] . '" title="' . $lang['Read_profile'] . '" ' . $style_color . '>' . $row['username'] . '</a>';
//-- fin mod : rank color system -----------------------------------------------

	$user_profile = append_sid('profile.'.$phpEx . '?mode=viewprofile&amp;' . POST_USERS_URL . '=' . $user_id);
	$user_joined = ( $row['user_id'] != ANONYMOUS ) ? $lang['Joined'] . ': ' . create_date($lang['DATE_FORMAT'], $row['user_regdate'], $board_config['board_timezone']) : '';

	$user_rank = '';
	$rank_image = '';

	if ( $row['user_id'] == ANONYMOUS )
	{
	}
	else if ( $row['user_rank'] )
	{
		for($j = 0; $j < count($ranksrow); $j++)
		{
			if ( $row['user_rank'] == $ranksrow[$j]['rank_id'] && $ranksrow[$j]['rank_special'] )
			{
				$user_rank = $ranksrow[$j]['rank_title'];
				$rank_image = ( $ranksrow[$j]['rank_image'] ) ? '<img src="' . $ranksrow[$j]['rank_image'] . '" alt="' . $user_rank . '" title="' . $user_rank . '" border="0" /><br />' : '';
			}
		}
	}
	else
	{
		for($j = 0; $j < count($ranksrow); $j++)
		{
			if ( $row['user_posts'] >= $ranksrow[$j]['rank_min'] && !$ranksrow[$j]['rank_special'] )
			{
				$user_rank = $ranksrow[$j]['rank_title'];
				$rank_image = ( $ranksrow[$j]['rank_image'] ) ? '<img src="' . $ranksrow[$j]['rank_image'] . '" alt="' . $user_rank . '" title="' . $user_rank . '" border="0" /><br />' : '';
			}
		}
	}

	if ( $row['user_avatar'] && $user_id != ANONYMOUS && $row['user_allowavatar'] )
	{
		switch( $row['user_avatar_type'] )
		{
			case USER_AVATAR_UPLOAD:
				$user_avatar = ( $board_config['allow_avatar_upload'] ) ? '<img src="' . $board_config['avatar_path'] . '/' . $row['user_avatar'] . '" alt="" border="0" />' : '';
				break;
			case USER_AVATAR_REMOTE:
				$user_avatar = ( $board_config['allow_avatar_remote'] ) ? '<img src="' . $row['user_avatar'] . '" alt="" border="0" />' : '';
				break;
			case USER_AVATAR_GALLERY:
				$user_avatar = ( $board_config['allow_avatar_local'] ) ? '<img src="' . $board_config['avatar_gallery_path'] . '/' . $row['user_avatar'] . '" alt="" border="0" />' : '';
				break;
		}
	}

	if ( !$board_config['allow_html'] || !$userdata['user_allowhtml'])
	{
		if ( !$row['enable_html'] )
		{
			$msg = preg_replace('#(<)([\/]?.*?)(>)#is', "&lt;\\2&gt;", $msg);
		}
	}

	if ($row['shout_bbcode_uid'])
	{
		$bbcode_uid = $row['shout_bbcode_uid'];
		$msg = ($board_config['allow_bbcode']) ? bbencode_second_pass($msg,$row['shout_bbcode_uid']) : preg_replace("/\:$bbcode_uid/si", '', $msg);
	}

	$msg = make_clickable($msg);

	if ( $smilies_on && $msg != '' && $row['enable_smilies'])
	{
		$msg = smilies_pass($msg);
	}

	if ($highlight_match)
	{
		$msg = str_replace('\"', '"', substr(preg_replace('#(\>(((?>([^><]+|(?R)))*)\<))#se', "preg_replace('#\b(" . $highlight_match . ")\b#i', '<span style=\"color:#" . $theme['fontcolor3'] . "\"><b>\\\\1</b></span>', '\\0')", '>' . $msg . '<'), 1, -1));
	}

	if ( count($orig_word) )
	{
		$msg = preg_replace($orig_word, $replacement_word, $msg);
		$msg = str_replace('\"', '"', substr(@preg_replace('#(\>(((?>([^><]+|(?R)))*)\<))#se', "@preg_replace(\$orig_word, \$replacement_word, '\\0')", '>' . $msg . '<'), 1, -1));
	}

	$msg = str_replace("\n", "\n<br />\n", $msg);

	if ( $is_auth['auth_mod'] && $is_auth['auth_delete'])
	{
		$temp_url = append_sid('shoutbox_max.'.$phpEx . '?mode=ip&amp;' . POST_POST_URL . '=' . $row['id']);
		$ip_img = '<a href="' . $temp_url . '"><img src="' . $images['icon_ip'] . '" alt="' . $lang['View_IP'] . '" title="' . $lang['View_IP'] . '" border="0" /></a>';
		$ip = '<a href="' . $temp_url . '">' . $lang['View_IP'] . '</a>';

		$temp_url = append_sid('shoutbox_max.'.$phpEx . '?mode=delete&amp;' . POST_POST_URL . '=' . $row['id']);
		$delshout_img = '<a href="' . $temp_url . '"><img src="' . $images['icon_delpost'] . '" alt="' . $lang['Delete_post'] . '" title="' . $lang['Delete_post'] . '" border="0" /></a>&nbsp;';
		$delshout = '<a href="' . $temp_url . '">' . $lang['Delete_post'] . '</a>';

		$temp_url = append_sid('shoutbox_max.'.$phpEx . '?mode=censor&amp;' . POST_POST_URL . '=' . $row['id']);
		$censorshout_img = '<a href="' . $temp_url . '"><img src="' . $images['icon_censor'] . '" alt="' . $lang['Censor'] . '" title="' . $lang['Censor'] . '" border="0" /></a>&nbsp;';
		$censorshout = '<a href="' . $temp_url . '">' . $lang['Delete_post'] . '</a>';
	}
	else
	{
		$ip_img = '';
		$ip = '';

		if ( ($userdata['user_id'] == $user_id && $is_auth['auth_delete'] ) && ($userdata['user_id'] != ANONYMOUS || ( $userdata['user_id'] == ANONYMOUS && $userdata['session_ip'] == $row['shout_ip'])))
		{
			$temp_url = append_sid('shoutbox_max.'.$phpEx . '?mode=censor&amp;' . POST_POST_URL . '=' . $row['id']);
			$censorshout_img = '<a href="' . $temp_url . '"><img src="' . $images['icon_censor'] . '" alt="' . $lang['Censor'] . '" title="' . $lang['Censor'] . '" border="0" /></a>&nbsp;';
			$censorshout = '<a href="' . $temp_url . '">' . $lang['Delete_post'] . '</a>';
		}
		else
		{
			$delshout_img = '';
			$delshout = '';
			$censorshout_img = '';
			$censorshout = '';
		}
	}

	$row_class = ( !($i % 2) ) ? 'row2' : 'row1';
	$template->assign_block_vars('shoutrow', array(
		'ROW_COLOR' => '#' . $row_color,
		'ROW_CLASS' => $row_class,
		'SHOUT' => $msg,
		'TIME' => create_date($board_config['default_dateformat'], $row['timestamp'], $board_config['board_timezone']),
		'SB_USERNAME' => $sb_username,
		'USER_RANK' => $user_rank,
		'RANK_IMAGE' => $rank_image,
		'IP_IMG' => $ip_img,
		'IP' => $ip,
		'DELETE_IMG' => $delshout_img, 
		'DELETE' => $delshout, 
		'CENSOR_IMG' => $censorshout_img, 
		'CENSOR' => $censorshout, 
		'USER_JOINED' => $user_joined,
		'USER_AVATAR' => $user_avatar,
		'U_ID' => $row['id'],
		'ROW_CLASS' => $row_class
	));
}

if ( $is_auth['auth_post'] )
{
	$template->assign_block_vars('switch_auth_post', array());
}	
else
{	
	$template->assign_block_vars('switch_auth_no_post', array());
}

$template->assign_vars(array( 
	'USERNAME' => $username,
	'PAGINATION' => $pagination,
	'NUMBER_OF_SHOUTS' => $total_shouts,
	'HTML_STATUS' => $html_status,
	'BBCODE_STATUS' => sprintf($bbcode_status, '<a href="' . append_sid('faq.'.$phpEx . '?mode=bbcode') . '" target="_phpbbcode">', '</a>'), 
	'L_SHOUTBOX_LOGIN' => 'Login_join',
	'L_POSTED' => $lang['Posted'],
	'L_AUTHOR' => $lang['Author'],
	'L_MESSAGE' => $lang['Message'],
	'U_SHOUTBOX' => append_sid('shoutbox_max.'.$phpEx . '?start=' . $start),
	'L_SHOUTBOX' => $lang['Shoutbox'],
	'L_SHOUT_PREVIEW' => $lang['Preview'],
	'L_SHOUT_SUBMIT' => $lang['Submit'],
	'L_MSG' => $lang['gg_mes'],
	'L_SHOUT_REFRESH' => $lang['shout_refresh'],
	'SMILIES_STATUS' => $smilies_status,
	'L_DISABLE_HTML' => $lang['Disable_HTML_post'], 
	'L_DISABLE_BBCODE' => $lang['Disable_BBCode_post'], 
	'L_DISABLE_SMILIES' => $lang['Disable_Smilies_post'], 
	'S_HTML_CHECKED' => ( !$html_on ) ? 'checked="checked"' : '', 
	'S_BBCODE_CHECKED' => ( !$bbcode_on ) ? 'checked="checked"' : '', 
	'S_SMILIES_CHECKED' => ( !$smilies_on ) ? 'checked="checked"' : ''
));

if( $error_msg != '' )
{
	$template->set_filenames(array('reg_header' => 'error_body.tpl'));
	$template->assign_vars(array('ERROR_MESSAGE' => $error_msg));
	$template->assign_var_from_handle('ERROR_BOX', 'reg_header');
	$message = ( !empty($HTTP_POST_VARS['message']) ) ? htmlspecialchars(trim(stripslashes($HTTP_POST_VARS['message']))) : '';
	$template->assign_vars(array('MESSAGE' => $message));
}

$template->pparse('body');

include($phpbb_root_path . 'includes/page_tail.'.$phpEx);

?>
