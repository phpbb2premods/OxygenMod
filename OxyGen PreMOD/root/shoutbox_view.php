<?php
/**
*
* @version $Id: shoutbox_view.php,v 1.0.5 11/02/2006 23:16 PastisD Exp $
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
include($phpbb_root_path . 'includes/bbcode.'.$phpEx);

define('NUM_SHOUT', $board_config['shoutbox_messages_number_on_index']);

$userdata = session_pagestart($user_ip, PAGE_INDEX);
init_userprefs($userdata);

if ( isset($HTTP_GET_VARS['mode']) || isset($HTTP_POST_VARS['mode']) )
{
	$mode = ( isset($HTTP_GET_VARS['mode']) ) ? $HTTP_GET_VARS['mode'] : $HTTP_POST_VARS['mode'];
}

if ( isset($HTTP_GET_VARS['name']) || isset($HTTP_POST_VARS['name']) )
{
	$name = ( isset($HTTP_GET_VARS['name']) ) ? $HTTP_GET_VARS['name'] : $HTTP_POST_VARS['name'];
}

if ( isset($HTTP_GET_VARS['message']) || isset($HTTP_POST_VARS['message']) )
{
	$message = ( isset($HTTP_GET_VARS['message']) ) ? $HTTP_GET_VARS['message'] : $HTTP_POST_VARS['message'];
}

if ( isset($HTTP_GET_VARS['msg']) || isset($HTTP_POST_VARS['msg']) )
{
	$msg = ( isset($HTTP_GET_VARS['msg']) ) ? $HTTP_GET_VARS['msg'] : $HTTP_POST_VARS['msg'];
}

if ( isset($HTTP_GET_VARS['id']) || isset($HTTP_POST_VARS['id']) )
{
	$id = ( isset($HTTP_GET_VARS['id']) ) ? $HTTP_GET_VARS['id'] : $HTTP_POST_VARS['id'];
}

if ( isset($HTTP_GET_VARS['del_sb_id']) || isset($HTTP_POST_VARS['del_sb_id']) )
{
	$del_sb_id = ( isset($HTTP_GET_VARS['del_sb_id']) ) ? $HTTP_GET_VARS['del_sb_id'] : $HTTP_POST_VARS['del_sb_id'];
}

if ( isset($HTTP_GET_VARS['name_id']) || isset($HTTP_POST_VARS['name_id']) )
{
	$name_id = ( isset($HTTP_GET_VARS['name_id']) ) ? $HTTP_GET_VARS['name_id'] : $HTTP_POST_VARS['name_id'];
}

if ( isset($HTTP_GET_VARS['date_edit']) || isset($HTTP_POST_VARS['date_edit']) )
{
	$date_edit = ( isset($HTTP_GET_VARS['date_edit']) ) ? $HTTP_GET_VARS['date_edit'] : $HTTP_POST_VARS['date_edit'];
}

if ( isset($HTTP_GET_VARS['name_edit']) || isset($HTTP_POST_VARS['name_edit']) )
{
	$name_edit = ( isset($HTTP_GET_VARS['name_edit']) ) ? $HTTP_GET_VARS['name_edit'] : $HTTP_POST_VARS['name_edit'];
}

if ( isset($HTTP_GET_VARS['clean_msg']) || isset($HTTP_POST_VARS['clean_msg']) )
{
	$clean_msg = ( isset($HTTP_GET_VARS['clean_msg']) ) ? $HTTP_GET_VARS['clean_msg'] : $HTTP_POST_VARS['clean_msg'];
}

if ( isset($HTTP_GET_VARS['submit_button']) || isset($HTTP_POST_VARS['submit_button']) )
{
	$submit_button = ( isset($HTTP_GET_VARS['submit_button']) ) ? $HTTP_GET_VARS['submit_button'] : $HTTP_POST_VARS['submit_button'];
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

require_once($phpbb_root_path . 'includes/functions_post.'.$phpEx);

$bbcode_uid = ( $bbcode_on ) ? make_bbcode_uid() : '';
$sb_user_id = $userdata['user_id'];

if ( $mode == 'show' )
{
	@setcookie('shoutbox',on , (time()+3600*9000), $board_config['cookie_path'], $board_config['cookie_domain'], $board_config['cookie_secure']);
	header("Location: " . append_sid('index.'.$phpEx . '?redirect=shoutbox_view.'.$phpEx, true));
}

if ( $mode == 'submit' && $msg )
{
	if ( !$board_config['shoutbox_allow_guest'] && !$userdata['session_logged_in'] )
	{
		$template->assign_block_vars('login_to_shoutcast', array('LANG_LOGIN_TO_SHOUT'=> $lang['login_to_shoutcast']));
	}

	$check_lenght = explode(' ', $msg);
	$total = sizeof($check_lenght);
	for($i = 0; $total > $i; $i++)
	if (strlen($check_lenght[$i]) > $board_config['shoutbox_word_lenght'])
	{
		$too_long = true;
		$template->assign_block_vars('too_long_word', array('LANG_TOO_LONG_WORD'=> $lang['too_long_word']));
	}

	$current_time = time();

//-- mod : no flood limit for admins & mods ------------------------------------
//-- add
	if($userdata['user_level'] != ADMIN && $userdata['user_level'] != MOD)
	{
//-- mod : no flood limit for admins & mods ------------------------------------
		$sql = 'SELECT MAX(timestamp) AS last_msg_time
			FROM ' . SHOUTBOX_TABLE . '
			WHERE sb_user_id = ' . $sb_user_id;
		if ( $result = $db->sql_query($sql) )
		{
			if ( $row = $db->sql_fetchrow($result) )
			{
				if ( $row['last_msg_time'] > 0 && ( $current_time - $row['last_msg_time'] ) < $board_config['flood_interval'] )
				{
					$flood_msg = true;
					$template->assign_block_vars('flood', array('LANG_FLOOD'=> $lang['Flood']));
				}
			}
		}
//-- mod : no flood limit for admins & mods ------------------------------------
//-- add
	}
//-- mod : no flood limit for admins & mods ------------------------------------

	$board_config['shoutbox_banned_user_id'] = $GLOBALS['boardconfig']['shoutbox_banned_user_id'];
	if( strstr($board_config['shoutbox_banned_user_id'], ',') )
	{
		$fids = explode(',', $board_config['shoutbox_banned_user_id']);
		while( list($foo, $id) = each($fids) )
		{
			$fid[] = intval( trim($id) );
		}
	}
	else
	{
		$fid[] = intval( trim($board_config['shoutbox_banned_user_id']) );
	}

	reset($fid);

	if ( in_array($sb_user_id, $fid) != false )
	{
		$shoutbox_banned = true;
		$template->assign_block_vars('sb_banned_send', array('LANG_SB_BANNED_SEND'=> $lang['sb_banned_send']));
	}

	if ( !$too_long && !$flood_msg && !$shoutbox_banned ) if ( $board_config['shoutbox_allow_guest'] || $userdata['session_logged_in'] )
	{
		$sql = "INSERT INTO " . SHOUTBOX_TABLE . "
			VALUES('', '$sb_user_id', '$msg', '".time()."', '$name', '".$bbcode_uid."', $bbcode_on, $html_on, $smilies_on, '$user_ip', '$shout_group_id')";
		if( !($result = $db->sql_query($sql)) )
		{ 
			message_die(GENERAL_ERROR, 'Could not insert shoutbox message', '', __LINE__, __FILE__, $sql); 
		}

		$start = time() - $board_config['shoutbox_delete_days'] * 86400;
		$sql = "DELETE FROM " . SHOUTBOX_TABLE . "
			WHERE timestamp < $start";
		if( !($result = $db->sql_query($sql)) )
		{ 
			message_die(GENERAL_ERROR, 'Could not delete shoutbox messages', '', __LINE__, __FILE__, $sql); 
		}
	}
}

$aedit = ( $board_config['shoutbox_allow_edit_all'] && $username != Anonymous ) ? 1 : 0;
$adel = ( $board_config['shoutbox_allow_delete_all'] && $username != Anonymous ) ? 1 : 0;

if (( $board_config['shoutbox_allow_edit'] ) &&( $userdata['user_level'] == MOD || $userdata['user_level'] == ADMIN ))
{
	$aedit = 1;
}

if (( $board_config['shoutbox_allow_delete'] ) && ( $userdata['user_level'] == MOD || $userdata['user_level'] == ADMIN ))
{
	$adel = 1;
}
else
{
	$del_mod = "AND sb_user_id = $sb_user_id";
}

if ( $mode == "delete" && $adel )
{
	$sql = "DELETE FROM " . SHOUTBOX_TABLE . "
		WHERE id = $id $del_mod";
	if( !($result = $db->sql_query($sql)) )
	{ 
		message_die(GENERAL_ERROR, 'Could not delete shoutbox message', '', __LINE__, __FILE__, $sql); 
	}
}

if ( $mode == "edit" && $aedit )
{
	$maxlengh = $shoutbox_config['text_lenght'];
	$clean_msg = str_replace("\'", '\'', $clean_msg);
	echo '<body onload="window.scrollTo(0,0);" />
				<table>
				<tr>
					<form name="post" action="shoutbox_view.php" method="POST">
					<td align="left"><span class="gensmall">' . $lang['Edit_pm'] . ': <input type="text" name="message" style="height:15px" size="60" maxlength="' . $maxlengh . '" " value="' . $clean_msg . '" class="editbox"><input type="hidden" name="mode" value="edited_msg"><input type="hidden" name="id" value="' . $id . '"><input type="hidden" name="name_edit" value="' . $name_edit . '"><input type="hidden" name="date_edit" value="' . $date_edit . '"><input type="hidden" name="name_id" value="' . $name_id . '"><input type="submit" name="submit_button" value="' . $lang['Submit'] . '" style="font-size:9px; height:16px;" class="button"></span></td>
					</form>
				</tr>
				</table>';
}

if ( $mode == "edited_msg" && $aedit )
{
	$sql = "REPLACE INTO " . SHOUTBOX_TABLE . "
		VALUES('$id', '$name_id', '$message', '$date_edit', '$name_edit', '".$bbcode_uid."', $bbcode_on, $html_on, $smilies_on, '$user_ip', '$shout_group_id')";
	if( !($result = $db->sql_query($sql)) )
	{ 
		message_die(GENERAL_ERROR, 'Could not replace shoutbox message', '', __LINE__, __FILE__, $sql); 
	}
}

$template->set_filenames(array(
	'body' => 'shoutbox_view_body.tpl',
	'header' => 'simple_header.tpl'
));

$board_config['shoutbox_banned_user_id_view'] = $GLOBALS['shoutbox_config']['banned_user_id_view'];
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

if ( in_array($sb_user_id, $fid) != false )
{
	$shoutbox_banned_view = true;
}

if ( $board_config['shoutbox_on'] && $shoutbox != "off" && !$shoutbox_banned_view ) if ( $board_config['shoutbox_allow_guest'] || $board_config['shoutbox_allow_guest_view'] || $userdata['session_logged_in'] )
{
//-- mod : rank color system ---------------------------------------------------
//-- delete
/*-MOD
	$sql = 'SELECT id, sb_user_id, msg, timestamp, sb_username, shout_bbcode_uid, enable_bbcode, enable_html, enable_smilies
		FROM ' . SHOUTBOX_TABLE . '
		ORDER by timestamp LIMIT ' . $start . ', ' . $number;
MOD-*/
//-- add
	$sql = 'SELECT sb.id, sb.sb_user_id, sb.msg, sb.timestamp, sb.sb_username, sb.shout_bbcode_uid, sb.enable_bbcode, sb.enable_html, sb.enable_smilies, u.user_level, u.user_color, u.user_group_id
		FROM (' . SHOUTBOX_TABLE . ' sb
		LEFT JOIN ' . USERS_TABLE . ' u
			ON u.user_id = sb.sb_user_id)
		ORDER by timestamp DESC LIMIT 0, ' . NUM_SHOUT;
//-- fin mod : rank color system -----------------------------------------------

	if( !($result = $db->sql_query($sql)) )
	{ 
		message_die(GENERAL_ERROR, 'Could not query shoutbox messages', '', __LINE__, __FILE__, $sql); 
	}

	if ( $row = $db->sql_fetchrow($result) )
	{
		$i = 0;
		do
		{
			$name_id = $row['sb_user_id'];

//-- mod : rank color system ---------------------------------------------------
//-- delete
/*-MOD
			$username = $row['sb_username'];
			$username = stripslashes(htmlspecialchars(trim($username)));
MOD-*/
//-- add
			$username = $rcs->get_colors($row, $row['sb_username']);
//-- fin mod : rank color system -----------------------------------------------

			$name = ( $board_config['shoutbox_links_names'] ) ? '<a href="' . append_sid('profile.'.$phpEx . '?mode=viewprofile&u=' . $name_id) . '" target="_top" title="' . $lang['Read_profile'] . '">' . $username . '</a>' : $username;

			if ( $username == Anonymous )
			{
				$name = '' . $lang['Guest'] . '';
			}

			$row_color = ( !($i % 2) ) ? $theme['td_color1'] : $theme['td_color2'];
			$row_class = ( !($i % 2) ) ? $theme['td_class1'] : $theme['td_class2'];

			if ( $board_config['shoutbox_date_on'] )
			{
				$make_date = create_date($board_config['shoutbox_date_format'], $row['timestamp'], $board_config['board_timezone']);
				$date = '[' . $make_date . ']';
			}

			$msg = $row['msg'];
			$msg = htmlspecialchars(trim($msg));

			if ($highlight_match)
			{
				$msg = str_replace('\"', '"', substr(preg_replace('#(\>(((?>([^><]+|(?R)))*)\<))#se', "preg_replace('#\b(" . $highlight_match . ")\b#i', '<span style=\"color:#" . $theme['fontcolor3'] . "\"><b>\\\\1</b></span>', '\\0')", '>' . $msg . '<'), 1, -1));
			}

			if ( count($orig_word) )
			{
				$msg = preg_replace($orig_word, $replacement_word, $msg);
			}

			if ( $smilies_on && $msg != '' && $row['enable_smilies'])
			{
				$msg = smilies_pass($msg);
			} 

			$msg = bbencode_second_pass($msg,$row['shout_bbcode_uid']);
			$msg = str_replace("\n", "\n<br />\n", $msg);

			$id = $row['id'];
 
			$aedit = ( $board_config['shoutbox_allow_edit_all'] && $username != ANONYMOUS && $sb_user_id == $name_id ) ? 1 : 0;
			$adel = ( $board_config['shoutbox_allow_delete_all'] && $username != ANONYMOUS && $sb_user_id == $name_id ) ? 1 : 0; 

			if (( $board_config['shoutbox_allow_edit'] ) && ( $userdata['user_level'] == MOD || $userdata['user_level'] == ADMIN ))
			{
				$aedit = 1;
			}

			if (( $board_config['shoutbox_allow_delete'] ) && ( $userdata['user_level'] == MOD || $userdata['user_level'] == ADMIN ))
			{
				$adel = 1;
			}

			if ( $adel )
			{
				$temp_url = append_sid('shoutbox_view.'.$phpEx . '?mode=delete&id=' . $id . '&del_sb_id=' . $sb_user_id);
				$delmsg = '<a href="' . $temp_url . '" class="mainmenu"><img src="' . $images['icon_del_shout'] . '" alt="' . $lang['Delete_message'] . '" title="' . $lang['Delete_message'] . '" /></a>';
			}
			else
			{
				$delmsg = '';
			}

			if ( $aedit )
			{
				$date_edit = $row['timestamp'];
				$name_edit = $row['sb_username'];
				$clean_msg = $row['msg'];
				$temp_url_e = append_sid('shoutbox_view.'.$phpEx . '?mode=edit&id=' . $id . '&name_id=' . $name_id . '&date_edit=' . $date_edit . '&name_edit=' . $name_edit . '&clean_msg=' . $clean_msg);
				$editmsg = '<a href="' . $temp_url_e . '" class="mainmenu"><img src="' . $images['icon_edit_shout'] . '" alt="' . $lang['Edit_pm'] . '" title="' . $lang['Edit_pm'] . '" /></a>';
			}
			else
			{
				$editmsg = '';
			}

			$row_class = ( !($i % 2) ) ? 'row2' : 'row1';
			$template->assign_block_vars('shoutrow', array(
				'DELMSG' => $delmsg,
				'EDITMSG' => $editmsg,
				'ROW_COLOR' => '#' . $row_color,
				'ROW_CLASS' => $row_class,
				'NAME' => $name,
				'DATE' => $date,
				'MSG' => $msg,
				'ROW_CLASS' => $row_class
			));
			$i++;
		}
		while ( $row = $db->sql_fetchrow($result) );
	}
}

$template->assign_vars(array( 
	'S_CONTENT_ENCODING' => $lang['ENCODING'],
	'U_SHOUTBOX_VIEW' => append_sid('shoutbox_view.'.$phpEx . '?' . $start),
	'T_BODY_BGCOLOR' => '#'.$theme['body_bgcolor'],
	'T_BODY_TEXT' => '#'.$theme['body_text'],
	'T_BODY_LINK' => '#'.$theme['body_link'],
	'T_BODY_VLINK' => '#'.$theme['body_vlink'],
	'SHOUT_REFRESH_TIME' => $board_config['shoutbox_refresh_time'],

//-- mod : bbcode box reloaded -------------------------------------------------
//-- add
	'T_TEMPLATE_NAME' => $theme['template_name'],
	'BBC_BOX_SHEET' => $images['bbc_box_sheet'],
//-- fin mod : bbcode box reloaded ---------------------------------------------

	'T_HEAD_STYLESHEET' => $theme['head_stylesheet'],
));

$template->pparse('header');

$template->pparse('body');
?>
