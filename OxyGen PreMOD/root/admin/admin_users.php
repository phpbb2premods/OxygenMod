<?php
/***************************************************************************
 *                              admin_users.php
 *                            -------------------
 *   begin                : Saturday, Feb 13, 2001
 *   copyright            : (C) 2001 The phpBB Group
 *   email                : support@phpbb.com
 *
 *   $Id: admin_users.php,v 1.57.2.35 2006/03/26 14:43:24 grahamje Exp $
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

define('IN_PHPBB', 1);

if( !empty($setmodules) )
{
	$filename = basename(__FILE__);
//-- mod : admin userlist ------------------------------------------------------
//-- delete
/*-MOD
	$module['Users']['Manage'] = $filename;
MOD-*/
//-- fin mod : admin userlist --------------------------------------------------
	return;
}

$phpbb_root_path = './../';
require($phpbb_root_path . 'extension.inc');
require('./pagestart.' . $phpEx);
require($phpbb_root_path . 'includes/bbcode.'.$phpEx);
require($phpbb_root_path . 'includes/functions_post.'.$phpEx);
require($phpbb_root_path . 'includes/functions_selects.'.$phpEx);
require($phpbb_root_path . 'includes/functions_validate.'.$phpEx);

$html_entities_match = array('#<#', '#>#');
$html_entities_replace = array('&lt;', '&gt;');

//
// Set mode
//
if( isset( $HTTP_POST_VARS['mode'] ) || isset( $HTTP_GET_VARS['mode'] ) )
{
	$mode = ( isset( $HTTP_POST_VARS['mode']) ) ? $HTTP_POST_VARS['mode'] : $HTTP_GET_VARS['mode'];
	$mode = htmlspecialchars($mode);
}
else
{
	$mode = '';
}

//-- mod : quick administrator user options and informations -------------------
//-- add
if ( isset( $HTTP_POST_VARS['returntoprofile'] ) || isset( $HTTP_GET_VARS['returntoprofile'] ) )
{
	$return_to_profile = ( isset( $HTTP_POST_VARS['returntoprofile'] ) ) ? $HTTP_POST_VARS['returntoprofile'] : $HTTP_GET_VARS['returntoprofile'];
	$return_to_profile = intval($return_to_profile);
}

else
{
	$return_to_profile = 0;
}
//-- fin mod : quick administrator user options and informations ---------------

//-- mod : inactive users ------------------------------------------------------
//-- add
if (isset($HTTP_GET_VARS['username']))
{
	$HTTP_POST_VARS['username'] = $HTTP_GET_VARS['username'];
}
//-- fin mod : inactive users --------------------------------------------------

//
// Begin program
//
if ( $mode == 'edit' || $mode == 'save' && ( isset($HTTP_POST_VARS['username']) || isset($HTTP_GET_VARS[POST_USERS_URL]) || isset( $HTTP_POST_VARS[POST_USERS_URL]) ) )
{
//-- mod : attachment mod ------------------------------------------------------
//-- add
	attachment_quota_settings('user', $HTTP_POST_VARS['submit'], $mode);
//-- fin mod : attachment mod --------------------------------------------------

	//
	// Ok, the profile has been modified and submitted, let's update
	//
	if ( ( $mode == 'save' && isset( $HTTP_POST_VARS['submit'] ) ) || isset( $HTTP_POST_VARS['avatargallery'] ) || isset( $HTTP_POST_VARS['submitavatar'] ) || isset( $HTTP_POST_VARS['cancelavatar'] ) )
	{
		$user_id = intval($HTTP_POST_VARS['id']);

		if (!($this_userdata = get_userdata($user_id)))
		{
			message_die(GENERAL_MESSAGE, $lang['No_user_id_specified'] );
		}

//-- mod : fix delete user bug -------------------------------------------------
//-- add
		$username = $this_userdata['username'];
//-- fin mod : fix delete user bug ---------------------------------------------

//-- mod : main admin security -------------------------------------------------
//-- delete
/*-MOD
		if( $HTTP_POST_VARS['deleteuser'] && ( $userdata['user_id'] != $user_id ) )
MOD-*/
//-- add
		if( $HTTP_POST_VARS['deleteuser'] && $user_id == 2)
		{
			message_die(GENERAL_ERROR, $lang['Main_Admin_Undeleted'] );
		}
		if( $HTTP_POST_VARS['deleteuser'] && $user_id != 2 && ( $userdata['user_id'] != $user_id ) )
//-- fin mod : main admin security ---------------------------------------------
		{
			$sql = 'SELECT g.group_id 
				FROM ' . USER_GROUP_TABLE . ' ug, ' . GROUPS_TABLE . ' g  
				WHERE ug.user_id = ' . $user_id . '
					AND g.group_id = ug.group_id 
					AND g.group_single_user = 1';
			if( !$result = $db->sql_query($sql) )
			{
				message_die(GENERAL_ERROR, 'Could not obtain group information for this user', '', __LINE__, __FILE__, $sql);
			}

			$row = $db->sql_fetchrow($result);
			
			$sql = 'UPDATE ' . POSTS_TABLE . "
				SET poster_id = " . DELETED . ", post_username = '" . str_replace("\\'", "''", addslashes($this_userdata['username'])) . "' 
				WHERE poster_id = $user_id";
			if( !$db->sql_query($sql) )
			{
				message_die(GENERAL_ERROR, 'Could not update posts for this user', '', __LINE__, __FILE__, $sql);
			}

			$sql = 'UPDATE ' . TOPICS_TABLE . '
				SET topic_poster = ' . DELETED . ' 
				WHERE topic_poster = ' . $user_id;
			if( !$db->sql_query($sql) )
			{
				message_die(GENERAL_ERROR, 'Could not update topics for this user', '', __LINE__, __FILE__, $sql);
			}
			
			$sql = 'UPDATE ' . VOTE_USERS_TABLE . '
				SET vote_user_id = ' . DELETED . '
				WHERE vote_user_id = ' . $user_id;
			if( !$db->sql_query($sql) )
			{
				message_die(GENERAL_ERROR, 'Could not update votes for this user', '', __LINE__, __FILE__, $sql);
			}
			
			$sql = 'SELECT group_id
				FROM ' . GROUPS_TABLE . '
				WHERE group_moderator = ' . $user_id;
			if( !($result = $db->sql_query($sql)) )
			{
				message_die(GENERAL_ERROR, 'Could not select groups where user was moderator', '', __LINE__, __FILE__, $sql);
			}
			
			while ( $row_group = $db->sql_fetchrow($result) )
			{
				$group_moderator[] = $row_group['group_id'];
			}
			
			if ( count($group_moderator) )
			{
				$update_moderator_id = implode(', ', $group_moderator);
				
				$sql = 'UPDATE ' . GROUPS_TABLE . '
					SET group_moderator = ' . $userdata['user_id'] . '
					WHERE group_moderator IN (' . $update_moderator_id . ')';
				if( !$db->sql_query($sql) )
				{
					message_die(GENERAL_ERROR, 'Could not update group moderators', '', __LINE__, __FILE__, $sql);
				}
			}

//-- mod : don't delete admin --------------------------------------------------
//-- delete
/*-MOD
			$sql = 'DELETE FROM ' . USERS_TABLE . '
				WHERE user_id = ' . $user_id;
			if( !$db->sql_query($sql) )
			{
				message_die(GENERAL_ERROR, 'Could not delete user', '', __LINE__, __FILE__, $sql);
			}
MOD-*/
//-- add
			if( $this_userdata['user_level'] == ADMIN )
			{
				message_die(GENERAL_ERROR, 'Does your administrator know you are doing this ?');
			}
			else
			{
				$sql = 'DELETE FROM ' . USERS_TABLE . '
					WHERE user_id = ' . $user_id;
				if( !$db->sql_query($sql) )
				{
					message_die(GENERAL_ERROR, 'Could not delete user', '', __LINE__, __FILE__, $sql);
				}
			}
//-- fin mod : don't delete admin ----------------------------------------------

			$sql = 'DELETE FROM ' . USER_GROUP_TABLE . '
				WHERE user_id = ' . $user_id;
			if( !$db->sql_query($sql) )
			{
				message_die(GENERAL_ERROR, 'Could not delete user from user_group table', '', __LINE__, __FILE__, $sql);
			}

			$sql = 'DELETE FROM ' . GROUPS_TABLE . '
				WHERE group_id = ' . $row['group_id'];
			if( !$db->sql_query($sql) )
			{
				message_die(GENERAL_ERROR, 'Could not delete group for this user', '', __LINE__, __FILE__, $sql);
			}

			$sql = 'DELETE FROM ' . AUTH_ACCESS_TABLE . '
				WHERE group_id = ' . $row['group_id'];
			if( !$db->sql_query($sql) )
			{
				message_die(GENERAL_ERROR, 'Could not delete group for this user', '', __LINE__, __FILE__, $sql);
			}

			$sql = 'DELETE FROM ' . TOPICS_WATCH_TABLE . '
				WHERE user_id = ' . $user_id;
			if ( !$db->sql_query($sql) )
			{
				message_die(GENERAL_ERROR, 'Could not delete user from topic watch table', '', __LINE__, __FILE__, $sql);
			}
			
			$sql = 'DELETE FROM ' . BANLIST_TABLE . '
				WHERE ban_userid = ' . $user_id;
			if ( !$db->sql_query($sql) )
			{
				message_die(GENERAL_ERROR, 'Could not delete user from banlist table', '', __LINE__, __FILE__, $sql);
			}

			$sql = 'DELETE FROM ' . SESSIONS_TABLE . '
				WHERE session_user_id = ' . $user_id;
			if ( !$db->sql_query($sql) )
			{
				message_die(GENERAL_ERROR, 'Could not delete sessions for this user', '', __LINE__, __FILE__, $sql);
			}
			
			$sql = 'DELETE FROM ' . SESSIONS_KEYS_TABLE . '
				WHERE user_id = ' . $user_id;
			if ( !$db->sql_query($sql) )
			{
				message_die(GENERAL_ERROR, 'Could not delete auto-login keys for this user', '', __LINE__, __FILE__, $sql);
			}

			$sql = 'SELECT privmsgs_id
				FROM ' . PRIVMSGS_TABLE . '
				WHERE privmsgs_from_userid = ' . $user_id . '
					OR privmsgs_to_userid = ' . $user_id;
			if ( !($result = $db->sql_query($sql)) )
			{
				message_die(GENERAL_ERROR, 'Could not select all users private messages', '', __LINE__, __FILE__, $sql);
			}

			// This little bit of code directly from the private messaging section.
			while ( $row_privmsgs = $db->sql_fetchrow($result) )
			{
				$mark_list[] = $row_privmsgs['privmsgs_id'];
			}
			
			if ( count($mark_list) )
			{
				$delete_sql_id = implode(', ', $mark_list);
				
				$delete_text_sql = 'DELETE FROM ' . PRIVMSGS_TEXT_TABLE . '
					WHERE privmsgs_text_id IN (' . $delete_sql_id . ')';
				$delete_sql = 'DELETE FROM ' . PRIVMSGS_TABLE . '
					WHERE privmsgs_id IN (' . $delete_sql_id . ')';
				
				if ( !$db->sql_query($delete_sql) )
				{
					message_die(GENERAL_ERROR, 'Could not delete private message info', '', __LINE__, __FILE__, $delete_sql);
				}
				
				if ( !$db->sql_query($delete_text_sql) )
				{
					message_die(GENERAL_ERROR, 'Could not delete private message text', '', __LINE__, __FILE__, $delete_text_sql);
				}
			}

//-- mod : admin userlist ------------------------------------------------------
//-- delete
/*-MOD
			$message = $lang['User_deleted'] . '<br /><br />' . sprintf($lang['Click_return_useradmin'], '<a href="' . append_sid("admin_users.$phpEx") . '">', '</a>') . '<br /><br />' . sprintf($lang['Click_return_admin_index'], '<a href="' . append_sid("index.$phpEx?pane=right") . '">', '</a>');
MOD-*/
//-- add
			$message = $lang['User_deleted'] . '<br /><br />' . sprintf($lang['Click_return_userlist'], '<a href="' . append_sid('admin_userlist.'.$phpEx) . '">', '</a>') . '<br /><br />' . sprintf($lang['Click_return_admin_index'], '<a href="' . append_sid('index.'.$phpEx . '?pane=right') . '">', '</a>');
//-- fin mod : admin userlist --------------------------------------------------

			message_die(GENERAL_MESSAGE, $message);
		}

//-- mod : main admin security -------------------------------------------------
//-- add
		if ( $user_id == 2 && $userdata['user_id'] != 2 )
		{
			message_die(GENERAL_ERROR, $lang['Main_Admin_Unchanged_Profile'] );
		}
//-- fin mod : main admin security ---------------------------------------------

		$username = ( !empty($HTTP_POST_VARS['username']) ) ? phpbb_clean_username($HTTP_POST_VARS['username']) : '';
		$email = ( !empty($HTTP_POST_VARS['email']) ) ? trim(strip_tags(htmlspecialchars( $HTTP_POST_VARS['email'] ) )) : '';
		$password = ( !empty($HTTP_POST_VARS['password']) ) ? trim(strip_tags(htmlspecialchars( $HTTP_POST_VARS['password'] ) )) : '';
		$password_confirm = ( !empty($HTTP_POST_VARS['password_confirm']) ) ? trim(strip_tags(htmlspecialchars( $HTTP_POST_VARS['password_confirm'] ) )) : '';

//-- mod : points system -------------------------------------------------------
//-- add
		$points = intval($HTTP_POST_VARS['points']);
		$allow_points = ( !empty($HTTP_POST_VARS['allow_points']) ) ? intval( $HTTP_POST_VARS['allow_points'] ) : 0;
//-- fin mod : points system ---------------------------------------------------

		$icq = ( !empty($HTTP_POST_VARS['icq']) ) ? trim(strip_tags( $HTTP_POST_VARS['icq'] ) ) : '';
		$aim = ( !empty($HTTP_POST_VARS['aim']) ) ? trim(strip_tags( $HTTP_POST_VARS['aim'] ) ) : '';
		$msn = ( !empty($HTTP_POST_VARS['msn']) ) ? trim(strip_tags( $HTTP_POST_VARS['msn'] ) ) : '';

//-- mod : skype ---------------------------------------------------------------
//-- add
		$skype = ( !empty($HTTP_POST_VARS['skype']) ) ? trim(strip_tags( $HTTP_POST_VARS['skype'] ) ) : '';
//-- fin mod : skype -----------------------------------------------------------

		$yim = ( !empty($HTTP_POST_VARS['yim']) ) ? trim(strip_tags( $HTTP_POST_VARS['yim'] ) ) : '';

		$website = ( !empty($HTTP_POST_VARS['website']) ) ? trim(strip_tags( $HTTP_POST_VARS['website'] ) ) : '';
		$location = ( !empty($HTTP_POST_VARS['location']) ) ? trim(strip_tags( $HTTP_POST_VARS['location'] ) ) : '';
		$occupation = ( !empty($HTTP_POST_VARS['occupation']) ) ? trim(strip_tags( $HTTP_POST_VARS['occupation'] ) ) : '';
		$interests = ( !empty($HTTP_POST_VARS['interests']) ) ? trim(strip_tags( $HTTP_POST_VARS['interests'] ) ) : '';

//-- mod : gender --------------------------------------------------------------
//-- add
		$gender = isset($HTTP_POST_VARS['gender']) ? intval ($HTTP_POST_VARS['gender']) : 0;
//-- fin mod : gender ----------------------------------------------------------

//-- mod : birthday ------------------------------------------------------------
//-- add
		$bday_day = isset($HTTP_POST_VARS['bday_day']) ? intval($HTTP_POST_VARS['bday_day']) : 0;
		$bday_month = isset($HTTP_POST_VARS['bday_month']) ? intval($HTTP_POST_VARS['bday_month']) : 0;
		$bday_year = isset($HTTP_POST_VARS['bday_year']) ? intval($HTTP_POST_VARS['bday_year']) : 0;
//-- fin mod : birthday --------------------------------------------------------

		$signature = ( !empty($HTTP_POST_VARS['signature']) ) ? trim(str_replace('<br />', "\n", $HTTP_POST_VARS['signature'] ) ) : '';

//-- mod : skype ---------------------------------------------------------------
// here we added
//	, $skype
//-- modify
		validate_optional_fields($icq, $aim, $msn, $skype, $yim, $website, $location, $occupation, $interests, $signature);
//-- fin mod : skype -----------------------------------------------------------

		$viewemail = isset( $HTTP_POST_VARS['viewemail']) ? ( ( $HTTP_POST_VARS['viewemail'] ) ? TRUE : 0 ) : 0;
		$allowviewonline = isset( $HTTP_POST_VARS['hideonline']) ? ( ( $HTTP_POST_VARS['hideonline'] ) ? 0 : TRUE ) : TRUE;
		$notifyreply = isset( $HTTP_POST_VARS['notifyreply']) ? ( ( $HTTP_POST_VARS['notifyreply'] ) ? TRUE : 0 ) : 0;
		$notifypm = isset( $HTTP_POST_VARS['notifypm']) ? ( ( $HTTP_POST_VARS['notifypm'] ) ? TRUE : 0 ) : TRUE;
		$popuppm = isset( $HTTP_POST_VARS['popup_pm']) ? ( ( $HTTP_POST_VARS['popup_pm'] ) ? TRUE : 0 ) : TRUE;
		$attachsig = isset( $HTTP_POST_VARS['attachsig']) ? ( ( $HTTP_POST_VARS['attachsig'] ) ? TRUE : 0 ) : 0;

//-- mod : quick post es -------------------------------------------------------
//-- add
		$params = array('user_qp', 'user_qp_show', 'user_qp_subject', 'user_qp_bbcode', 'user_qp_smilies', 'user_qp_more');
		for ($i = 0; $i < count($params); $i++)
		{
			$$params[$i] = isset($HTTP_POST_VARS[$params[$i]]) ? intval($HTTP_POST_VARS[$params[$i]]) : $$params[$i];
		}
//-- fin mod : quick post es ---------------------------------------------------

		$allowhtml = isset( $HTTP_POST_VARS['allowhtml']) ? intval( $HTTP_POST_VARS['allowhtml'] ) : $board_config['allow_html'];
		$allowbbcode = isset( $HTTP_POST_VARS['allowbbcode']) ? intval( $HTTP_POST_VARS['allowbbcode'] ) : $board_config['allow_bbcode'];
		$allowsmilies = isset( $HTTP_POST_VARS['allowsmilies']) ? intval( $HTTP_POST_VARS['allowsmilies'] ) : $board_config['allow_smilies'];

//-- mod : users set posts & topics count --------------------------------------
//-- add
		$postspp = ( !empty($HTTP_POST_VARS['postspp']) ) ? trim(strip_tags( $HTTP_POST_VARS['postspp'] ) ) : '';
		$topicspp = ( !empty($HTTP_POST_VARS['topicspp']) ) ? trim(strip_tags( $HTTP_POST_VARS['topicspp'] ) ) : '';
//-- fin mod : users set posts & topics count ----------------------------------

		$user_style = isset( $HTTP_POST_VARS['style'] ) ? intval( $HTTP_POST_VARS['style'] ) : $board_config['default_style'];
		$user_lang = ( $HTTP_POST_VARS['language'] ) ? $HTTP_POST_VARS['language'] : $board_config['default_lang'];
		$user_timezone = isset( $HTTP_POST_VARS['timezone']) ? doubleval( $HTTP_POST_VARS['timezone'] ) : $board_config['board_timezone'];

		$user_dateformat = ( $HTTP_POST_VARS['dateformat'] ) ? trim( $HTTP_POST_VARS['dateformat'] ) : $board_config['default_dateformat'];

		$user_avatar_local = ( isset( $HTTP_POST_VARS['avatarselect'] ) && !empty($HTTP_POST_VARS['submitavatar'] ) && $board_config['allow_avatar_local'] ) ? $HTTP_POST_VARS['avatarselect'] : ( ( isset( $HTTP_POST_VARS['avatarlocal'] )  ) ? $HTTP_POST_VARS['avatarlocal'] : '' );
		$user_avatar_category = ( isset($HTTP_POST_VARS['avatarcatname']) && $board_config['allow_avatar_local'] ) ? htmlspecialchars($HTTP_POST_VARS['avatarcatname']) : '' ;

		$user_avatar_remoteurl = ( !empty($HTTP_POST_VARS['avatarremoteurl']) ) ? trim( $HTTP_POST_VARS['avatarremoteurl'] ) : '';
		$user_avatar_url = ( !empty($HTTP_POST_VARS['avatarurl']) ) ? trim( $HTTP_POST_VARS['avatarurl'] ) : '';
		$user_avatar_loc = ( $HTTP_POST_FILES['avatar']['tmp_name'] != "none") ? $HTTP_POST_FILES['avatar']['tmp_name'] : '';
		$user_avatar_name = ( !empty($HTTP_POST_FILES['avatar']['name']) ) ? $HTTP_POST_FILES['avatar']['name'] : '';
		$user_avatar_size = ( !empty($HTTP_POST_FILES['avatar']['size']) ) ? $HTTP_POST_FILES['avatar']['size'] : 0;
		$user_avatar_filetype = ( !empty($HTTP_POST_FILES['avatar']['type']) ) ? $HTTP_POST_FILES['avatar']['type'] : '';

		$user_avatar = ( empty($user_avatar_loc) ) ? $this_userdata['user_avatar'] : '';
		$user_avatar_type = ( empty($user_avatar_loc) ) ? $this_userdata['user_avatar_type'] : '';		

		$user_status = ( !empty($HTTP_POST_VARS['user_status']) ) ? intval( $HTTP_POST_VARS['user_status'] ) : 0;

		$user_allowpm = ( !empty($HTTP_POST_VARS['user_allowpm']) ) ? intval( $HTTP_POST_VARS['user_allowpm'] ) : 0;
		$user_rank = ( !empty($HTTP_POST_VARS['user_rank']) ) ? intval( $HTTP_POST_VARS['user_rank'] ) : 0;

//-- mod : boulet --------------------------------------------------------------
//-- add
		$user_boulet_type = ( !empty($HTTP_POST_VARS['user_boulet_type']) ) ? intval( $HTTP_POST_VARS['user_boulet_type'] ) : false;
		$user_boulet_value = ( !empty($HTTP_POST_VARS['user_boulet_value']) ) ? trim( $HTTP_POST_VARS['user_boulet_value'] ) : '';
		$user_boulet = $user_boulet_type . '|' . (( $user_boulet_type == 0 ) ? '' : $user_boulet_value );
//-- fin mod : boulet ----------------------------------------------------------

		$user_allowavatar = ( !empty($HTTP_POST_VARS['user_allowavatar']) ) ? intval( $HTTP_POST_VARS['user_allowavatar'] ) : 0;

//-- mod : user post count editor ----------------------------------------------
//-- add
		$user_posts = ( !empty($HTTP_POST_VARS['user_posts']) ) ?  intval( $HTTP_POST_VARS['user_posts'] ) : 0;
//-- fin mod : user post count editor ------------------------------------------

//-- mod : restrict account to ip ----------------------------------------------
//-- add
		$user_restrictip = ( !empty($HTTP_POST_VARS['user_restrictip']) ) ? intval( $HTTP_POST_VARS['user_restrictip']) : 0;
		$user_iprange = ( !empty($HTTP_POST_VARS['user_iprange']) ) ? trim(strip_tags(htmlspecialchars($HTTP_POST_VARS['user_iprange']))) : '';
//-- fin mod : restrict account to ip ------------------------------------------

//-- mod : don't delete admin --------------------------------------------------
//-- add
		$user_level = ( !empty($HTTP_POST_VARS['user_level']) ) ? intval( $HTTP_POST_VARS['user_level'] ) : 0;
//-- fin mod : don't delete admin ----------------------------------------------

//-- mod : allow single namechange ---------------------------------------------
//-- add
		$user_namechange = ( !empty($HTTP_POST_VARS['user_namechange']) ) ? intval( $HTTP_POST_VARS['user_namechange'] ) : 0;
//-- fin mod : allow single namechange -----------------------------------------

//-- mod : disallow mail and password changes ----------------------------------
//-- add
		$user_mailchange = ( !empty($HTTP_POST_VARS['user_mailchange']) ) ? intval( $HTTP_POST_VARS['user_mailchange'] ) : 0;
		$user_passwordchange = ( !empty($HTTP_POST_VARS['user_passwordchange']) ) ? intval( $HTTP_POST_VARS['user_passwordchange'] ) : 0;
//-- fin mod : disallow mail and password changes ------------------------------

//-- mod : account self-delete -------------------------------------------------
//-- add
		$user_account_delete = ( !empty($HTTP_POST_VARS['user_account_delete']) ) ? intval( $HTTP_POST_VARS['user_account_delete'] ) : 0;
//-- fin mod : account self-delete ---------------------------------------------

		if( isset( $HTTP_POST_VARS['avatargallery'] ) || isset( $HTTP_POST_VARS['submitavatar'] ) || isset( $HTTP_POST_VARS['cancelavatar'] ) )
		{
			$username = stripslashes($username);
			$email = stripslashes($email);
			$password = '';
			$password_confirm = '';

//-- mod : points system -------------------------------------------------------
//-- add
			$points = intval($points);
//-- fin mod : points system ---------------------------------------------------

			$icq = stripslashes($icq);
			$aim = htmlspecialchars(stripslashes($aim));
			$msn = htmlspecialchars(stripslashes($msn));

//-- mod : skype ---------------------------------------------------------------
//-- add
			$skype = htmlspecialchars(stripslashes($skype));
//-- fin mod : skype -----------------------------------------------------------

			$yim = htmlspecialchars(stripslashes($yim));

			$website = htmlspecialchars(stripslashes($website));
			$location = htmlspecialchars(stripslashes($location));
			$occupation = htmlspecialchars(stripslashes($occupation));
			$interests = htmlspecialchars(stripslashes($interests));
			$signature = htmlspecialchars(stripslashes($signature));

//-- mod : users set posts & topics count --------------------------------------
//-- add
			$postspp = htmlspecialchars(stripslashes($postspp));
			$topicspp = htmlspecialchars(stripslashes($topicspp));
//-- fin mod : users set posts & topics count ----------------------------------

			$user_lang = stripslashes($user_lang);
			$user_dateformat = htmlspecialchars(stripslashes($user_dateformat));

			if ( !isset($HTTP_POST_VARS['cancelavatar'])) 
			{
				$user_avatar = $user_avatar_category . '/' . $user_avatar_local;
				$user_avatar_type = USER_AVATAR_GALLERY;
			}
		}
	}

	if( isset( $HTTP_POST_VARS['submit'] ) )
	{
		include($phpbb_root_path . 'includes/usercp_avatar.'.$phpEx);

		$error = FALSE;

		if (stripslashes($username) != $this_userdata['username'])
		{
			unset($rename_user);

			if ( stripslashes(strtolower($username)) != strtolower($this_userdata['username']) ) 
			{
				$result = validate_username($username);
				if ( $result['error'] )
				{
					$error = TRUE;
					$error_msg .= ( ( isset($error_msg) ) ? '<br />' : '' ) . $result['error_msg'];
				}
				else if ( strtolower(str_replace("\\'", "''", $username)) == strtolower($userdata['username']) )
				{
					$error = TRUE;
					$error_msg .= ( ( isset($error_msg) ) ? '<br />' : '' ) . $lang['Username_taken'];
				}
			}

			if (!$error)
			{
				$username_sql = "username = '" . str_replace("\\'", "''", $username) . "', ";
				$rename_user = $username; // Used for renaming usergroup
			}
		}

		$passwd_sql = '';
		if( !empty($password) && !empty($password_confirm) )
		{
			//
			// Awww, the user wants to change their password, isn't that cute..
			//
			if($password != $password_confirm)
			{
				$error = TRUE;
				$error_msg .= ( ( isset($error_msg) ) ? '<br />' : '' ) . $lang['Password_mismatch'];
			}
			else
			{
//-- mod : salt password -------------------------------------------------------
//-- delete
/*-MOD
				$password = md5($password);
MOD-*/
//-- add
				if ( $board_config['password_security_startdate'] )
				{
					$sql = 'SELECT user_regdate FROM ' . USERS_TABLE . ' WHERE user_id = ' . $user_id;
					if( !$result = $db->sql_query($sql) )
					{
						message_die(GENERAL_ERROR, 'Could not obtain user data', '', __LINE__, __FILE__, $sql);
					}

					$row = $db->sql_fetchrow($result);
					$password = md5(md5($password) . $row['user_regdate']);
				}
				else
				{
					$password = md5($password);
				}
//-- fin mod : salt password ---------------------------------------------------
				$passwd_sql = "user_password = '$password', ";
			}
		}
		else if( $password && !$password_confirm )
		{
			$error = TRUE;
			$error_msg .= ( ( isset($error_msg) ) ? '<br />' : '' ) . $lang['Password_mismatch'];
		}
		else if( !$password && $password_confirm )
		{
			$error = TRUE;
			$error_msg .= ( ( isset($error_msg) ) ? '<br />' : '' ) . $lang['Password_mismatch'];
		}

		if ($signature != '')
		{
			$sig_length_check = preg_replace('/(\[.*?)(=.*?)\]/is', '\\1]', stripslashes($signature));
			if ( $allowhtml )
			{
				$sig_length_check = preg_replace('/(\<.*?)(=.*?)( .*?=.*?)?([ \/]?\>)/is', '\\1\\3\\4', $sig_length_check);
			}

			// Only create a new bbcode_uid when there was no uid yet.
			if ( $signature_bbcode_uid == '' )
			{
				$signature_bbcode_uid = ( $allowbbcode ) ? make_bbcode_uid() : '';
			}
			$signature = prepare_message($signature, $allowhtml, $allowbbcode, $allowsmilies, $signature_bbcode_uid);

			if ( strlen($sig_length_check) > $board_config['max_sig_chars'] )
			{ 
				$error = TRUE;
				$error_msg .=  ( ( isset($error_msg) ) ? '<br />' : '' ) . $lang['Signature_too_long'];
			}
		}

		//
		// Avatar stuff
		//
		$avatar_sql = '';
		if( isset($HTTP_POST_VARS['avatardel']) )
		{
			if( $this_userdata['user_avatar_type'] == USER_AVATAR_UPLOAD && $this_userdata['user_avatar'] != '' )
			{
				if( @file_exists(@phpbb_realpath('./../' . $board_config['avatar_path'] . '/' . $this_userdata['user_avatar'])) )
				{
					@unlink('./../' . $board_config['avatar_path'] . '/' . $this_userdata['user_avatar']);
				}
			}
			$avatar_sql = ", user_avatar = '', user_avatar_type = " . USER_AVATAR_NONE;
		}
		else if( ( $user_avatar_loc != '' || !empty($user_avatar_url) ) && !$error )
		{
			//
			// Only allow one type of upload, either a
			// filename or a URL
			//
			if( !empty($user_avatar_loc) && !empty($user_avatar_url) )
			{
				$error = TRUE;
				if( isset($error_msg) )
				{
					$error_msg .= '<br />';
				}
				$error_msg .= $lang['Only_one_avatar'];
			}

			if( $user_avatar_loc != '' )
			{
				if( file_exists(@phpbb_realpath($user_avatar_loc)) && ereg(".jpg$|.gif$|.png$", $user_avatar_name) )
				{
					if( $user_avatar_size <= $board_config['avatar_filesize'] && $user_avatar_size > 0)
					{
						$error_type = false;

						//
						// Opera appends the image name after the type, not big, not clever!
						//
						preg_match("'image\/[x\-]*([a-z]+)'", $user_avatar_filetype, $user_avatar_filetype);
						$user_avatar_filetype = $user_avatar_filetype[1];

						switch( $user_avatar_filetype )
						{
							case 'jpeg':
							case 'pjpeg':
							case 'jpg':
								$imgtype = '.jpg';
								break;
							case 'gif':
								$imgtype = '.gif';
								break;
							case 'png':
								$imgtype = '.png';
								break;
							default:
								$error = true;
								$error_msg = (!empty($error_msg)) ? $error_msg . '<br />' . $lang['Avatar_filetype'] : $lang['Avatar_filetype'];
								break;
						}

						if( !$error )
						{
							list($width, $height) = @getimagesize($user_avatar_loc);

							if( $width <= $board_config['avatar_max_width'] && $height <= $board_config['avatar_max_height'] )
							{
								$user_id = $this_userdata['user_id'];

								$avatar_filename = $user_id . $imgtype;

								if( $this_userdata['user_avatar_type'] == USER_AVATAR_UPLOAD && $this_userdata['user_avatar'] != '' )
								{
									if( @file_exists(@phpbb_realpath('./../' . $board_config['avatar_path'] . '/' . $this_userdata['user_avatar'])) )
									{
										@unlink('./../' . $board_config['avatar_path'] . '/'. $this_userdata['user_avatar']);
									}
								}
								@copy($user_avatar_loc, './../' . $board_config['avatar_path'] . '/$avatar_filename');

								$avatar_sql = ", user_avatar = '$avatar_filename', user_avatar_type = " . USER_AVATAR_UPLOAD;
							}
							else
							{
								$l_avatar_size = sprintf($lang['Avatar_imagesize'], $board_config['avatar_max_width'], $board_config['avatar_max_height']);

								$error = true;
								$error_msg = ( !empty($error_msg) ) ? $error_msg . "<br />" . $l_avatar_size : $l_avatar_size;
							}
						}
					}
					else
					{
						$l_avatar_size = sprintf($lang['Avatar_filesize'], round($board_config['avatar_filesize'] / 1024));

						$error = true;
						$error_msg = ( !empty($error_msg) ) ? $error_msg . '<br />' . $l_avatar_size : $l_avatar_size;
					}
				}
				else
				{
					$error = true;
					$error_msg = ( !empty($error_msg) ) ? $error_msg . '<br />' . $lang['Avatar_filetype'] : $lang['Avatar_filetype'];
				}
			}
			else if( !empty($user_avatar_url) )
			{
				//
				// First check what port we should connect
				// to, look for a :[xxxx]/ or, if that doesn't
				// exist assume port 80 (http)
				//
				preg_match("/^(http:\/\/)?([\w\-\.]+)\:?([0-9]*)\/(.*)$/", $user_avatar_url, $url_ary);

				if( !empty($url_ary[4]) )
				{
					$port = (!empty($url_ary[3])) ? $url_ary[3] : 80;

					$fsock = @fsockopen($url_ary[2], $port, $errno, $errstr);
					if( $fsock )
					{
						$base_get = '/' . $url_ary[4];

						//
						// Uses HTTP 1.1, could use HTTP 1.0 ...
						//
						@fputs($fsock, "GET $base_get HTTP/1.1\r\n");
						@fputs($fsock, "HOST: " . $url_ary[2] . "\r\n");
						@fputs($fsock, "Connection: close\r\n\r\n");

						unset($avatar_data);
						while( !@feof($fsock) )
						{
							$avatar_data .= @fread($fsock, $board_config['avatar_filesize']);
						}
						@fclose($fsock);

						if( preg_match("/Content-Length\: ([0-9]+)[^\/ ][\s]+/i", $avatar_data, $file_data1) && preg_match("/Content-Type\: image\/[x\-]*([a-z]+)[\s]+/i", $avatar_data, $file_data2) )
						{
							$file_size = $file_data1[1]; 
							$file_type = $file_data2[1];

							switch( $file_type )
							{
								case 'jpeg':
								case 'pjpeg':
								case 'jpg':
									$imgtype = '.jpg';
									break;
								case 'gif':
									$imgtype = '.gif';
									break;
								case 'png':
									$imgtype = '.png';
									break;
								default:
									$error = true;
									$error_msg = (!empty($error_msg)) ? $error_msg . '<br />' . $lang['Avatar_filetype'] : $lang['Avatar_filetype'];
									break;
							}

							if( !$error && $file_size > 0 && $file_size < $board_config['avatar_filesize'] )
							{
								$avatar_data = substr($avatar_data, strlen($avatar_data) - $file_size, $file_size);

								$tmp_filename = tempnam ('/tmp', $this_userdata['user_id'] . '-');
								$fptr = @fopen($tmp_filename, 'wb');
								$bytes_written = @fwrite($fptr, $avatar_data, $file_size);
								@fclose($fptr);

								if( $bytes_written == $file_size )
								{
									list($width, $height) = @getimagesize($tmp_filename);

									if( $width <= $board_config['avatar_max_width'] && $height <= $board_config['avatar_max_height'] )
									{
										$user_id = $this_userdata['user_id'];

										$avatar_filename = $user_id . $imgtype;

										if( $this_userdata['user_avatar_type'] == USER_AVATAR_UPLOAD && $this_userdata['user_avatar'] != '')
										{
											if( file_exists(@phpbb_realpath('./../' . $board_config['avatar_path'] . '/' . $this_userdata['user_avatar'])) )
											{
												@unlink('./../' . $board_config['avatar_path'] . '/' . $this_userdata['user_avatar']);
											}
										}
										@copy($tmp_filename, './../' . $board_config['avatar_path'] . '/$avatar_filename');
										@unlink($tmp_filename);

										$avatar_sql = ", user_avatar = '$avatar_filename', user_avatar_type = " . USER_AVATAR_UPLOAD;
									}
									else
									{
										$l_avatar_size = sprintf($lang['Avatar_imagesize'], $board_config['avatar_max_width'], $board_config['avatar_max_height']);

										$error = true;
										$error_msg = ( !empty($error_msg) ) ? $error_msg . '<br />' . $l_avatar_size : $l_avatar_size;
									}
								}
								else
								{
									//
									// Error writing file
									//
									@unlink($tmp_filename);
									message_die(GENERAL_ERROR, 'Could not write avatar file to local storage. Please contact the board administrator with this message', '', __LINE__, __FILE__);
								}
							}
						}
						else
						{
							//
							// No data
							//
							$error = true;
							$error_msg = ( !empty($error_msg) ) ? $error_msg . '<br />' . $lang['File_no_data'] : $lang['File_no_data'];
						}
					}
					else
					{
						//
						// No connection
						//
						$error = true;
						$error_msg = ( !empty($error_msg) ) ? $error_msg . '<br />' . $lang['No_connection_URL'] : $lang['No_connection_URL'];
					}
				}
				else
				{
					$error = true;
					$error_msg = ( !empty($error_msg) ) ? $error_msg . '<br />' . $lang['Incomplete_URL'] : $lang['Incomplete_URL'];
				}
			}
			else if( !empty($user_avatar_name) )
			{
				$l_avatar_size = sprintf($lang['Avatar_filesize'], round($board_config['avatar_filesize'] / 1024));

				$error = true;
				$error_msg = ( !empty($error_msg) ) ? $error_msg . '<br />' . $l_avatar_size : $l_avatar_size;
			}
		}
		else if( $user_avatar_remoteurl != '' && $avatar_sql == '' && !$error )
		{
			if( !preg_match("#^http:\/\/#i", $user_avatar_remoteurl) )
			{
				$user_avatar_remoteurl = "http://" . $user_avatar_remoteurl;
			}

			if( preg_match("#^(http:\/\/[a-z0-9\-]+?\.([a-z0-9\-]+\.)*[a-z]+\/.*?\.(gif|jpg|png)$)#is", $user_avatar_remoteurl) )
			{
				$avatar_sql = ", user_avatar = '" . str_replace("\'", "''", $user_avatar_remoteurl) . "', user_avatar_type = " . USER_AVATAR_REMOTE;
			}
			else
			{
				$error = true;
				$error_msg = ( !empty($error_msg) ) ? $error_msg . '<br />' . $lang['Wrong_remote_avatar_format'] : $lang['Wrong_remote_avatar_format'];
			}
		}
		else if( $user_avatar_local != '' && $avatar_sql == '' && !$error )
		{
			$avatar_sql = ", user_avatar = '" . str_replace("\'", "''", phpbb_ltrim(basename($user_avatar_category), "'") . '/' . phpbb_ltrim(basename($user_avatar_local), "'")) . "', user_avatar_type = " . USER_AVATAR_GALLERY;
		}
	
		//
		// Update entry in DB
		//
		if( !$error )
		{

//-- mod : quick post es -------------------------------------------------------
//-- add
			$qp_data = array($user_qp, $user_qp_show, $user_qp_subject, $user_qp_bbcode, $user_qp_smilies, $user_qp_more);
			$user_qp_settings = implode('-', $qp_data);
//-- fin mod : quick post es ---------------------------------------------------

//-- mod : birthday ------------------------------------------------------------
//-- add
			$bday_data = array($bday_day, $bday_month, $bday_year);
			$user_birthday = ($bday_day && $bday_month && $bday_year) ? implode('-', $bday_data) : '';
//-- fin mod : birthday --------------------------------------------------------

			$sql = "UPDATE " . USERS_TABLE . "
				SET " . $username_sql . $passwd_sql . "user_email = '" . str_replace("\'", "''", $email) . "', user_icq = '" . str_replace("\'", "''", $icq) . "', user_website = '" . str_replace("\'", "''", $website) . "', user_occ = '" . str_replace("\'", "''", $occupation) . "', user_from = '" . str_replace("\'", "''", $location) . "', user_interests = '" . str_replace("\'", "''", $interests) . "', user_sig = '" . str_replace("\'", "''", $signature) . "', user_viewemail = $viewemail, user_aim = '" . str_replace("\'", "''", $aim) . "', user_yim = '" . str_replace("\'", "''", $yim) . "', user_msnm = '" . str_replace("\'", "''", $msn) . "', user_attachsig = $attachsig, user_sig_bbcode_uid = '$signature_bbcode_uid', user_allowsmile = $allowsmilies, user_allowhtml = $allowhtml, user_allowavatar = $user_allowavatar, user_allowbbcode = $allowbbcode, user_allow_viewonline = $allowviewonline, user_notify = $notifyreply, user_allow_pm = $user_allowpm, user_notify_pm = $notifypm, user_popup_pm = $popuppm, user_lang = '" . str_replace("\'", "''", $user_lang) . "', user_style = $user_style, user_timezone = $user_timezone, user_dateformat = '" . str_replace("\'", "''", $user_dateformat) . "', user_active = $user_status, user_rank = $user_rank" . $avatar_sql . "
				WHERE user_id = $user_id";

//-- mod : oxygen premod -------------------------------------------------------
//-- add
			$sql = str_replace('SET ', 'SET user_qp_settings = \'' . $user_qp_settings . '\', user_skype = \'' . str_replace("\'", "''", $skype) . '\', user_birthday = \'' . $user_birthday . '\', user_namechange = ' . $user_namechange . ', user_points = ' . $points . ', admin_allow_points = ' . $allow_points . ', user_gender = \'' . $gender . '\', user_postspp = \'' . str_replace("\'", "''", $postspp) . '\', user_topicspp = \'' . str_replace("\'", "''", $topicspp) . '\', user_restrictip = ' . $user_restrictip . ', user_iprange = \'' . str_replace("\'", "''", $user_iprange) . '\', user_posts = ' . $user_posts . ', user_boulet = \'' . str_replace("\'", "''", $user_boulet) . '\', user_mailchange = ' . $user_mailchange . ', user_passwordchange = ' . $user_passwordchange . ', user_account_delete = ' . $user_account_delete . ', ', $sql);
//-- fin mod : oxygen premod ---------------------------------------------------

			if( $result = $db->sql_query($sql) )
			{
//-- mod : the logger ----------------------------------------------------------
//-- add
				if( defined( 'LOG_MOD_INSTALLED' ) )
				{
					if( $log->config['log_admin_user_manage'] )
					{
						$log->insert( LOG_TYPE_ADMIN, 'LOG_A_USER_MANAGE', array( 'user' => $log->convert_user_id($user_id), 'user_id' => $user_id ) );
					}
				}
//-- fin mod : the logger ------------------------------------------------------

				if( isset($rename_user) )
				{
					$sql = 'UPDATE ' . GROUPS_TABLE . "
						SET group_name = '".str_replace("\'", "''", $rename_user)."'
						WHERE group_name = '".str_replace("'", "''", $this_userdata['username'] )."'";
					if( !$result = $db->sql_query($sql) )
					{
						message_die(GENERAL_ERROR, 'Could not rename users group', '', __LINE__, __FILE__, $sql);
					}
				}
				
				// Delete user session, to prevent the user navigating the forum (if logged in) when disabled
				if (!$user_status)
				{
					$sql = 'DELETE FROM ' . SESSIONS_TABLE . ' 
						WHERE session_user_id = ' . $user_id;

					if ( !$db->sql_query($sql) )
					{
						message_die(GENERAL_ERROR, 'Error removing user session', '', __LINE__, __FILE__, $sql);
					}
				}

				// We remove all stored login keys since the password has been updated
				// and change the current one (if applicable)
				if ( !empty($passwd_sql) )
				{
					session_reset_keys($user_id, $user_ip);
				}
				
				$message .= $lang['Admin_user_updated'];
			}
			else
			{
				message_die(GENERAL_ERROR, 'Admin_user_fail', '', __LINE__, __FILE__, $sql);
			}

//-- mod : admin userlist ------------------------------------------------------
//-- delete
/*-MOD
			$message .= '<br /><br />' . sprintf($lang['Click_return_useradmin'], '<a href="' . append_sid("admin_users.$phpEx") . '">', '</a>') . '<br /><br />' . sprintf($lang['Click_return_admin_index'], '<a href="' . append_sid("index.$phpEx?pane=right") . '">', '</a>');
MOD-*/
//-- add
			$message .= '<br /><br />' . sprintf($lang['Click_return_userlist'], '<a href="' . append_sid('admin_userlist.'.$phpEx) . '">', '</a>') . '<br /><br />' . sprintf($lang['Click_return_admin_index'], '<a href="' . append_sid('index.'.$phpEx . '?pane=right') . '">', '</a>');
//-- fin mod : admin userlist --------------------------------------------------

//-- mod : quick administrator user options and informations -------------------
//-- add
			if ( $return_to_profile )
			{
				$message = $lang['Admin_user_updated'] . '<br /><br />' . sprintf($lang['Click_return_userprofile'], '<a href="' . append_sid('../profile.' . $phpEx . '?mode=viewprofile&amp;' . POST_USERS_URL . '=' . $user_id) . '">', '</a>') . '<br /><br />' . sprintf($lang['Click_return_admin_index'], '<a href="' . append_sid('index.' . $phpEx) . '">', '</a>');
			}
//-- fin mod : quick administrator user options and informations ---------------

			message_die(GENERAL_MESSAGE, $message);
		}
		else
		{
			$template->set_filenames(array('reg_header' => 'error_body.tpl'));
			$template->assign_vars(array('ERROR_MESSAGE' => $error_msg));
			$template->assign_var_from_handle('ERROR_BOX', 'reg_header');

			$username = htmlspecialchars(stripslashes($username));
			$email = stripslashes($email);
			$password = '';
			$password_confirm = '';

//-- mod : points system -------------------------------------------------------
//-- add
			$points = intval($points);
//-- fin mod : points system ---------------------------------------------------

			$icq = stripslashes($icq);
			$aim = htmlspecialchars(str_replace('+', ' ', stripslashes($aim)));
			$msn = htmlspecialchars(stripslashes($msn));

//-- mod : skype ---------------------------------------------------------------
//-- add
			$skype = htmlspecialchars(stripslashes($skype));
//-- fin mod : skype -----------------------------------------------------------

			$yim = htmlspecialchars(stripslashes($yim));

			$website = htmlspecialchars(stripslashes($website));
			$location = htmlspecialchars(stripslashes($location));
			$occupation = htmlspecialchars(stripslashes($occupation));
			$interests = htmlspecialchars(stripslashes($interests));
			$signature = htmlspecialchars(stripslashes($signature));

			$user_lang = stripslashes($user_lang);
			$user_dateformat = htmlspecialchars(stripslashes($user_dateformat));
		}
	}
	else if( !isset( $HTTP_POST_VARS['submit'] ) && $mode != 'save' && !isset( $HTTP_POST_VARS['avatargallery'] ) && !isset( $HTTP_POST_VARS['submitavatar'] ) && !isset( $HTTP_POST_VARS['cancelavatar'] ) )
	{
		if( isset( $HTTP_GET_VARS[POST_USERS_URL]) || isset( $HTTP_POST_VARS[POST_USERS_URL]) )
		{
			$user_id = ( isset( $HTTP_POST_VARS[POST_USERS_URL]) ) ? intval( $HTTP_POST_VARS[POST_USERS_URL]) : intval( $HTTP_GET_VARS[POST_USERS_URL]);
			$this_userdata = get_userdata($user_id);
			if( !$this_userdata )
			{
				message_die(GENERAL_MESSAGE, $lang['No_user_id_specified'] );
			}
		}
		else
		{
			$this_userdata = get_userdata($HTTP_POST_VARS['username'], true);
			if( !$this_userdata )
			{
				message_die(GENERAL_MESSAGE, $lang['No_user_id_specified'] );
			}
		}

		//
		// Now parse and display it as a template
		//
		$user_id = $this_userdata['user_id'];
		$username = $this_userdata['username'];
		$email = $this_userdata['user_email'];
		$password = '';
		$password_confirm = '';

//-- mod : points system -------------------------------------------------------
//-- add
		$points = $this_userdata['user_points'];
		$allow_points = $this_userdata['admin_allow_points'];
//-- fin mod : points system ---------------------------------------------------

//-- mod : log ip address on registration --------------------------------------
//-- add
		$user_regip = decode_ip($this_userdata['user_regip']);
//-- fin mod : log ip address on registration ----------------------------------

		$icq = $this_userdata['user_icq'];
		$aim = htmlspecialchars(str_replace('+', ' ', $this_userdata['user_aim'] ));
		$msn = htmlspecialchars($this_userdata['user_msnm']);

//-- mod : skype ---------------------------------------------------------------
//-- add
		$skype = htmlspecialchars($this_userdata['user_skype']);
//-- fin mod : skype -----------------------------------------------------------

		$yim = htmlspecialchars($this_userdata['user_yim']);

		$website = htmlspecialchars($this_userdata['user_website']);
		$location = htmlspecialchars($this_userdata['user_from']);
		$occupation = htmlspecialchars($this_userdata['user_occ']);
		$interests = htmlspecialchars($this_userdata['user_interests']);

//-- mod : gender --------------------------------------------------------------
//-- add
		$gender = $this_userdata['user_gender'];
//-- fin mod : gender ----------------------------------------------------------

//-- mod : birthday ------------------------------------------------------------
//-- add
		$bday_day = $bday_month = $bday_year = 0;
		if (!empty($this_userdata['user_birthday']))
		{
			list($bday_day, $bday_month, $bday_year) = explode('-', $this_userdata['user_birthday']);
		}
//-- fin mod : birthday --------------------------------------------------------

		$signature = ($this_userdata['user_sig_bbcode_uid'] != '') ? preg_replace('#:' . $this_userdata['user_sig_bbcode_uid'] . '#si', '', $this_userdata['user_sig']) : $this_userdata['user_sig'];
		$signature = preg_replace($html_entities_match, $html_entities_replace, $signature);

//-- mod : quick post es -------------------------------------------------------
//-- add
		$user_qp = $user_qp_show = $user_qp_subject = $user_qp_bbcode = $user_qp_smilies = $user_qp_more = 0;
		if (!empty($this_userdata['user_qp_settings']))
		{
			list($user_qp, $user_qp_show, $user_qp_subject, $user_qp_bbcode, $user_qp_smilies, $user_qp_more) = explode('-', $this_userdata['user_qp_settings']);
		}
//-- fin mod : quick post es ---------------------------------------------------

		$viewemail = $this_userdata['user_viewemail'];
		$notifypm = $this_userdata['user_notify_pm'];
		$popuppm = $this_userdata['user_popup_pm'];

		$notifyreply = $this_userdata['user_notify'];
		$attachsig = $this_userdata['user_attachsig'];
		$allowhtml = $this_userdata['user_allowhtml'];
		$allowbbcode = $this_userdata['user_allowbbcode'];
		$allowsmilies = $this_userdata['user_allowsmile'];

//-- mod : users set posts & topics count --------------------------------------
//-- add
		$postspp = htmlspecialchars($this_userdata['user_postspp']);
		$topicspp = htmlspecialchars($this_userdata['user_topicspp']);
//-- fin mod : users set posts & topics count ----------------------------------

		$allowviewonline = $this_userdata['user_allow_viewonline'];

		$user_avatar = $this_userdata['user_avatar'];
		$user_avatar_type = $this_userdata['user_avatar_type'];
		$user_style = $this_userdata['user_style'];
		$user_lang = $this_userdata['user_lang'];
		$user_timezone = $this_userdata['user_timezone'];

		$user_dateformat = htmlspecialchars($this_userdata['user_dateformat']);
		
		$user_status = $this_userdata['user_active'];

		$user_allowavatar = $this_userdata['user_allowavatar'];

//-- mod : user post count editor ----------------------------------------------
//-- add
		$user_posts = $this_userdata['user_posts'];
//-- fin mod : user post count editor ------------------------------------------

//-- mod : allow single namechange ---------------------------------------------
//-- add
		$user_namechange = $this_userdata['user_namechange'];
//-- fin mod : allow single namechange -----------------------------------------

//-- mod : disallow mail and password changes ----------------------------------
//-- add
		$user_mailchange = $this_userdata['user_mailchange'];
		$user_passwordchange = $this_userdata['user_passwordchange'];
//-- fin mod : disallow mail and password changes ------------------------------

//-- mod : account self-delete -------------------------------------------------
//-- add
		$user_account_delete = $this_userdata['user_account_delete'];
//-- fin mod : account self-delete ---------------------------------------------

		$user_allowpm = $this_userdata['user_allow_pm'];

//-- mod : boulet --------------------------------------------------------------
//-- add
		$user_boulet = $this_userdata['user_boulet'];
		preg_match('`^([0-3]{1})\|(.*?)$`', $user_boulet, $matches);
		$user_boulet_type = $matches[1];
		$user_boulet_value = $matches[2];
//-- fin mod : boulet ----------------------------------------------------------

//-- mod : restrict account to ip ----------------------------------------------
//-- add
		$user_restrictip = $this_userdata['user_restrictip'];
		$user_iprange = $this_userdata['user_iprange'];
//-- fin mod : restrict account to ip ------------------------------------------

		$COPPA = false;

		$html_status =  ($this_userdata['user_allowhtml'] ) ? $lang['HTML_is_ON'] : $lang['HTML_is_OFF'];
		$bbcode_status = ($this_userdata['user_allowbbcode'] ) ? $lang['BBCode_is_ON'] : $lang['BBCode_is_OFF'];
		$smilies_status = ($this_userdata['user_allowsmile'] ) ? $lang['Smilies_are_ON'] : $lang['Smilies_are_OFF'];
	}

	if( isset($HTTP_POST_VARS['avatargallery']) && !$error )
	{
		if( !$error )
		{
			$user_id = intval($HTTP_POST_VARS['id']);

			$template->set_filenames(array('body' => 'admin/user_avatar_gallery.tpl'));

			$dir = @opendir('../' . $board_config['avatar_gallery_path']);

			$avatar_images = array();
			while( $file = @readdir($dir) )
			{
				if( $file != '.' && $file != '..' && !is_file(phpbb_realpath('./../' . $board_config['avatar_gallery_path'] . '/' . $file)) && !is_link(phpbb_realpath('./../' . $board_config['avatar_gallery_path'] . '/' . $file)) )
				{
					$sub_dir = @opendir('../' . $board_config['avatar_gallery_path'] . '/' . $file);

					$avatar_row_count = 0;
					$avatar_col_count = 0;

					while( $sub_file = @readdir($sub_dir) )
					{
						if( preg_match("/(\.gif$|\.png$|\.jpg)$/is", $sub_file) )
						{
							$avatar_images[$file][$avatar_row_count][$avatar_col_count] = $sub_file;

							$avatar_col_count++;
							if( $avatar_col_count == 5 )
							{
								$avatar_row_count++;
								$avatar_col_count = 0;
							}
						}
					}
				}
			}
	
			@closedir($dir);

			if( isset($HTTP_POST_VARS['avatarcategory']) )
			{
				$category = htmlspecialchars($HTTP_POST_VARS['avatarcategory']);
			}
			else
			{
				list($category, ) = each($avatar_images);
			}
			@reset($avatar_images);

			$s_categories = '';
			while( list($key) = each($avatar_images) )
			{
				$selected = ( $key == $category ) ? 'selected="selected"' : '';
				if( count($avatar_images[$key]) )
				{
					$s_categories .= '<option value="' . $key . '"' . $selected . '>' . ucfirst($key) . '</option>';
				}
			}

			$s_colspan = 0;
			for($i = 0; $i < count($avatar_images[$category]); $i++)
			{
				$template->assign_block_vars('avatar_row', array());

				$s_colspan = max($s_colspan, count($avatar_images[$category][$i]));

				for($j = 0; $j < count($avatar_images[$category][$i]); $j++)
				{
					$template->assign_block_vars('avatar_row.avatar_column', array(
						'AVATAR_IMAGE' => "../" . $board_config['avatar_gallery_path'] . '/' . $category . '/' . $avatar_images[$category][$i][$j])
					);

					$template->assign_block_vars('avatar_row.avatar_option_column', array(
						'S_OPTIONS_AVATAR' => $avatar_images[$category][$i][$j])
					);
				}
			}

			$coppa = ( ( !$HTTP_POST_VARS['coppa'] && !$HTTP_GET_VARS['coppa'] ) || $mode == "register") ? 0 : TRUE;

			$s_hidden_fields = '<input type="hidden" name="mode" value="edit" /><input type="hidden" name="agreed" value="true" /><input type="hidden" name="coppa" value="' . $coppa . '" /><input type="hidden" name="avatarcatname" value="' . $category . '" />';
			$s_hidden_fields .= '<input type="hidden" name="id" value="' . $user_id . '" />';

			$s_hidden_fields .= '<input type="hidden" name="username" value="' . str_replace("\"", "&quot;", $username) . '" />';
			$s_hidden_fields .= '<input type="hidden" name="email" value="' . str_replace("\"", "&quot;", $email) . '" />';
			$s_hidden_fields .= '<input type="hidden" name="icq" value="' . str_replace("\"", "&quot;", $icq) . '" />';
			$s_hidden_fields .= '<input type="hidden" name="aim" value="' . str_replace("\"", "&quot;", $aim) . '" />';
			$s_hidden_fields .= '<input type="hidden" name="msn" value="' . str_replace("\"", "&quot;", $msn) . '" />';

//-- mod : skype ---------------------------------------------------------------
//-- add
			$s_hidden_fields .= '<input type="hidden" name="skype" value="' . str_replace("\"", "&quot;", $skype) . '" />';
//-- fin mod : skype -----------------------------------------------------------

			$s_hidden_fields .= '<input type="hidden" name="yim" value="' . str_replace("\"", "&quot;", $yim) . '" />';
			$s_hidden_fields .= '<input type="hidden" name="website" value="' . str_replace("\"", "&quot;", $website) . '" />';
			$s_hidden_fields .= '<input type="hidden" name="location" value="' . str_replace("\"", "&quot;", $location) . '" />';
			$s_hidden_fields .= '<input type="hidden" name="occupation" value="' . str_replace("\"", "&quot;", $occupation) . '" />';
			$s_hidden_fields .= '<input type="hidden" name="interests" value="' . str_replace("\"", "&quot;", $interests) . '" />';

//-- mod : gender --------------------------------------------------------------
//-- add
			$s_hidden_fields .= '<input type="hidden" name="gender" value="' . $gender . '" />';
//-- fin mod : gender ----------------------------------------------------------

//-- mod : birthday ------------------------------------------------------------
//-- add
			$s_hidden_fields .= '<input type="hidden" name="bday_day" value="' . $bday_day . '" />';
			$s_hidden_fields .= '<input type="hidden" name="bday_month" value="' . $bday_month . '" />';
			$s_hidden_fields .= '<input type="hidden" name="bday_year" value="' . $bday_year . '" />';
//-- fin mod : birthday --------------------------------------------------------

			$s_hidden_fields .= '<input type="hidden" name="signature" value="' . str_replace("\"", "&quot;", $signature) . '" />';
			$s_hidden_fields .= '<input type="hidden" name="viewemail" value="' . $viewemail . '" />';
			$s_hidden_fields .= '<input type="hidden" name="notifypm" value="' . $notifypm . '" />';
			$s_hidden_fields .= '<input type="hidden" name="popup_pm" value="' . $popuppm . '" />';

			$s_hidden_fields .= '<input type="hidden" name="notifyreply" value="' . $notifyreply . '" />';
			$s_hidden_fields .= '<input type="hidden" name="attachsig" value="' . $attachsig . '" />';

//-- mod : quick post es -------------------------------------------------------
//-- add
			$params = array('user_qp', 'user_qp_show', 'user_qp_subject', 'user_qp_bbcode', 'user_qp_smilies', 'user_qp_more');
			for($i = 0; $i < count($params); $i++)
			{
				$s_hidden_fields .= '<input type="hidden" name="' . $params[$i] . '" value="' . $$params[$i] . '" />';
			}
//-- fin mod : quick post es ---------------------------------------------------

			$s_hidden_fields .= '<input type="hidden" name="allowhtml" value="' . $allowhtml . '" />';
			$s_hidden_fields .= '<input type="hidden" name="allowbbcode" value="' . $allowbbcode . '" />';
			$s_hidden_fields .= '<input type="hidden" name="allowsmilies" value="' . $allowsmilies . '" />';

//-- mod : users set posts & topics count --------------------------------------
//-- add
			$s_hidden_fields .= '<input type="hidden" name="postspp" value="' . str_replace("\"", "&quot;", $postspp) . '" />';
			$s_hidden_fields .= '<input type="hidden" name="topicspp" value="' . str_replace("\"", "&quot;", $topicspp) . '" />';
//-- fin mod : users set posts & topics count ----------------------------------

			$s_hidden_fields .= '<input type="hidden" name="hideonline" value="' . !$allowviewonline . '" />';

			$s_hidden_fields .= '<input type="hidden" name="style" value="' . $user_style . '" />'; 
			$s_hidden_fields .= '<input type="hidden" name="language" value="' . $user_lang . '" />';
			$s_hidden_fields .= '<input type="hidden" name="timezone" value="' . $user_timezone . '" />';
			$s_hidden_fields .= '<input type="hidden" name="dateformat" value="' . str_replace("\"", "&quot;", $user_dateformat) . '" />';

			$s_hidden_fields .= '<input type="hidden" name="user_status" value="' . $user_status . '" />';
			$s_hidden_fields .= '<input type="hidden" name="user_allowpm" value="' . $user_allowpm . '" />';
			$s_hidden_fields .= '<input type="hidden" name="user_allowavatar" value="' . $user_allowavatar . '" />';

//-- mod : allow single namechange ---------------------------------------------
//-- add
			$s_hidden_fields .= '<input type="hidden" name="user_namechange" value="' . $user_namechange . '" />';
//-- fin mod : allow single namechange -----------------------------------------

//-- mod : disallow mail and password changes ----------------------------------
//-- add
			$s_hidden_fields .= '<input type="hidden" name="user_mailchange" value="' . $user_mailchange . '" />';
			$s_hidden_fields .= '<input type="hidden" name="user_passwordchange" value="' . $user_passwordchange . '" />';
//-- fin mod : disallow mail and password changes ------------------------------

//-- mod : account self-delete -------------------------------------------------
//-- add
			$s_hidden_fields .= '<input type="hidden" name="user_account_delete" value="' . $user_account_delete . '" />';
//-- fin mod : account self-delete ---------------------------------------------

			$s_hidden_fields .= '<input type="hidden" name="user_rank" value="' . $user_rank . '" />';

//-- mod : boulet --------------------------------------------------------------
//-- add
			$s_hidden_fields .= '<input type="hidden" name="user_boulet_type" value="' . $user_boulet_type . '" />';
			$s_hidden_fields .= '<input type="hidden" name="user_boulet_value" value="' . $user_boulet_value . '" />';
//-- fin mod : boulet ----------------------------------------------------------

//-- mod : restrict account to ip ----------------------------------------------
//-- add
			$s_hidden_fields .= '<input type="hidden" name="user_restrictip" value="' . $user_restrictip . '" />';
			$s_hidden_fields .= '<input type="hidden" name="user_iprange" value="' . $user_iprange . '" />';
//-- fin mod : restrict account to ip ------------------------------------------

//-- mod : points system -------------------------------------------------------
//-- add
			$s_hidden_fields .= '<input type="hidden" name="points" value="' . $points . '" />';
			$s_hidden_fields .= '<input type="hidden" name="allow_points" value="' . $allow_points . '" />';
//-- fin mod : points system ---------------------------------------------------

			$template->assign_vars(array(
				'L_USER_TITLE' => $lang['User_admin'],
				'L_USER_EXPLAIN' => $lang['User_admin_explain'],
				'L_AVATAR_GALLERY' => $lang['Avatar_gallery'], 
				'L_SELECT_AVATAR' => $lang['Select_avatar'], 
				'L_RETURN_PROFILE' => $lang['Return_profile'], 
				'L_CATEGORY' => $lang['Select_category'], 
				'L_GO' => $lang['Go'],

				'S_OPTIONS_CATEGORIES' => $s_categories, 
				'S_COLSPAN' => $s_colspan, 
				'S_PROFILE_ACTION' => append_sid('admin_users.' . $phpEx . '?mode=' . $mode), 
				'S_HIDDEN_FIELDS' => $s_hidden_fields,
			));
		}
	}
	else
	{
		$s_hidden_fields = '<input type="hidden" name="mode" value="save" /><input type="hidden" name="agreed" value="true" /><input type="hidden" name="coppa" value="' . $coppa . '" />';
		$s_hidden_fields .= '<input type="hidden" name="id" value="' . $this_userdata['user_id'] . '" />';

//-- mod : quick administrator user options and informations -------------------
//-- add
		$s_hidden_fields .= '<input type="hidden" name="returntoprofile" value="' . $return_to_profile .'" />';
//-- fin mod : quick administrator user options and informations ---------------

		if( !empty($user_avatar_local) )
		{
			$s_hidden_fields .= '<input type="hidden" name="avatarlocal" value="' . $user_avatar_local . '" /><input type="hidden" name="avatarcatname" value="' . $user_avatar_category . '" />';
		}

		if( $user_avatar_type )
		{
			switch( $user_avatar_type )
			{
//-- mod : resize avatars based on max width and heignt ------------------------
//-- delete
/*-MOD
				case USER_AVATAR_UPLOAD:
					$avatar = '<img src="../' . $board_config['avatar_path'] . '/' . $user_avatar . '" alt="" />';
					break;
				case USER_AVATAR_REMOTE:
					$avatar = '<img src="' . $user_avatar . '" alt="" />';
					break;
				case USER_AVATAR_GALLERY:
					$avatar = '<img src="../' . $board_config['avatar_gallery_path'] . '/' . $user_avatar . '" alt="" />';
					break;
MOD-*/
//-- add
				case USER_AVATAR_UPLOAD:
					$avatar = '<img onload="rmwa_img_loaded(this,' .  $board_config['avatar_max_width'] . ',' .  $board_config['avatar_max_height'] . ')"' . ' src="../' . $board_config['avatar_path'] . '/' . $user_avatar . '" alt="" />';
					break;
				case USER_AVATAR_REMOTE:
					$avatar = '<img onload="rmwa_img_loaded(this,' .  $board_config['avatar_max_width'] . ',' .  $board_config['avatar_max_height'] . ')"' . ' src="' . $user_avatar . '" alt="" />';
					break;
				case USER_AVATAR_GALLERY:
					$avatar = '<img onload="rmwa_img_loaded(this,' .  $board_config['avatar_max_width'] . ',' .  $board_config['avatar_max_height'] . ')"' . ' src="../' . $board_config['avatar_gallery_path'] . '/' . $user_avatar . '" alt="" />';
					break;
//-- fin mod : resize avatars based on max width and heignt --------------------
			}
		}
		else
		{
//-- mod : ip country flag -----------------------------------------------------
//-- delete
/*-MOD
			$avatar = '';
MOD-*/
//-- add
			$avatar = '<img src="../images/avatars/gallery/ipcf_flags/' . $this_userdata['user_cf_iso3661_1'] . '.gif" alt="' .  $lang['IP2Country'][$this_userdata['user_cf_iso3661_1']] . '" title="' .  $lang['IP2Country'][$this_userdata['user_cf_iso3661_1']] . '" border="0" />';
//-- fin mod : ip country flag -------------------------------------------------
		}

		$sql = 'SELECT * FROM ' . RANKS_TABLE . ' WHERE rank_special = 1 ORDER BY rank_title';
		if ( !($result = $db->sql_query($sql)) )
		{
			message_die(GENERAL_ERROR, 'Could not obtain ranks data', '', __LINE__, __FILE__, $sql);
		}

		$rank_select_box = '<option value="0">' . $lang['No_assigned_rank'] . '</option>';
		while( $row = $db->sql_fetchrow($result) )
		{
			$rank = $row['rank_title'];
			$rank_id = $row['rank_id'];
			
			$selected = ( $this_userdata['user_rank'] == $rank_id ) ? ' selected="selected"' : '';
			$rank_select_box .= '<option value="' . $rank_id . '"' . $selected . '>' . $rank . '</option>';
		}
		$db->sql_freeresult($result);

		$template->set_filenames(array('body' => 'admin/user_edit_body.tpl'));

//-- mod : birthday ------------------------------------------------------------
//-- add
		$bdays->select_birthdate();
//-- fin mod : birthday --------------------------------------------------------

//-- mod : quick post es -------------------------------------------------------
//-- add
		display_qpes_data(true);
//-- fin mod : quick post es ---------------------------------------------------

//-- mod : gender --------------------------------------------------------------
//-- add
		switch ($gender)
		{
			case 1:
				$gender_male_checked = 'checked="checked"';
				break;
			case 2:
				$gender_female_checked = 'checked="checked"';
				break;
			default:
				$gender_no_specify_checked = 'checked="checked"';
		}
//-- fin mod : gender ----------------------------------------------------------

		//
		// Let's do an overall check for settings/versions which would prevent
		// us from doing file uploads....
		//
		$ini_val = ( phpversion() >= '4.0.0' ) ? 'ini_get' : 'get_cfg_var';
		$form_enctype = ( !@$ini_val('file_uploads') || phpversion() == '4.0.4pl1' || !$board_config['allow_avatar_upload'] || ( phpversion() < '4.0.3' && @$ini_val('open_basedir') != '' ) ) ? '' : 'enctype="multipart/form-data"';

		$template->assign_vars(array(
			'USERNAME' => $username,
			'EMAIL' => $email,
			'YIM' => $yim,
			'ICQ' => $icq,
			'MSN' => $msn,
			'AIM' => $aim,
			'OCCUPATION' => $occupation,
			'INTERESTS' => $interests,
			'LOCATION' => $location,
			'WEBSITE' => $website,
			'SIGNATURE' => str_replace('<br />', "\n", $signature),
			'VIEW_EMAIL_YES' => ($viewemail) ? 'checked="checked"' : '',
			'VIEW_EMAIL_NO' => (!$viewemail) ? 'checked="checked"' : '',
			'HIDE_USER_YES' => (!$allowviewonline) ? 'checked="checked"' : '',
			'HIDE_USER_NO' => ($allowviewonline) ? 'checked="checked"' : '',
			'NOTIFY_PM_YES' => ($notifypm) ? 'checked="checked"' : '',
			'NOTIFY_PM_NO' => (!$notifypm) ? 'checked="checked"' : '',
			'POPUP_PM_YES' => ($popuppm) ? 'checked="checked"' : '',
			'POPUP_PM_NO' => (!$popuppm) ? 'checked="checked"' : '',
			'ALWAYS_ADD_SIGNATURE_YES' => ($attachsig) ? 'checked="checked"' : '',
			'ALWAYS_ADD_SIGNATURE_NO' => (!$attachsig) ? 'checked="checked"' : '',
			'NOTIFY_REPLY_YES' => ( $notifyreply ) ? 'checked="checked"' : '',
			'NOTIFY_REPLY_NO' => ( !$notifyreply ) ? 'checked="checked"' : '',
			'ALWAYS_ALLOW_BBCODE_YES' => ($allowbbcode) ? 'checked="checked"' : '',
			'ALWAYS_ALLOW_BBCODE_NO' => (!$allowbbcode) ? 'checked="checked"' : '',
			'ALWAYS_ALLOW_HTML_YES' => ($allowhtml) ? 'checked="checked"' : '',
			'ALWAYS_ALLOW_HTML_NO' => (!$allowhtml) ? 'checked="checked"' : '',
			'ALWAYS_ALLOW_SMILIES_YES' => ($allowsmilies) ? 'checked="checked"' : '',
			'ALWAYS_ALLOW_SMILIES_NO' => (!$allowsmilies) ? 'checked="checked"' : '',
			'AVATAR' => $avatar,
			'LANGUAGE_SELECT' => language_select($user_lang),
			'TIMEZONE_SELECT' => tz_select($user_timezone),

			'STYLE_SELECT' => style_select($user_style, 'style'),
			'DATE_FORMAT' => $user_dateformat,
			'ALLOW_PM_YES' => ($user_allowpm) ? 'checked="checked"' : '',
			'ALLOW_PM_NO' => (!$user_allowpm) ? 'checked="checked"' : '',
			'ALLOW_AVATAR_YES' => ($user_allowavatar) ? 'checked="checked"' : '',
			'ALLOW_AVATAR_NO' => (!$user_allowavatar) ? 'checked="checked"' : '',
			'USER_ACTIVE_YES' => ($user_status) ? 'checked="checked"' : '',
			'USER_ACTIVE_NO' => (!$user_status) ? 'checked="checked"' : '',
			'RANK_SELECT_BOX' => $rank_select_box,

//-- mod : boulet --------------------------------------------------------------
//-- add
			'BOULET_SELECT_BOX' => '<option value="0"' . (( !$user_boulet_type ) ? ' selected="selected"' : '' ) . '>' . $lang['user_boulet_type_0'] . '</option><option value="1"' . (( $user_boulet_type == 1 ) ? ' selected="selected"' : '' ) . '>' . $lang['user_boulet_type_1'] . '</option><option value="2"' . (( $user_boulet_type == 2 ) ? ' selected="selected"' : '' ) . '>' . $lang['user_boulet_type_2'] . '</option><option value="3"' . (( $user_boulet_type == 3 ) ? ' selected="selected"' : '' ) . '>' . $lang['user_boulet_type_3'] . '</option>',
			'USER_BOULET_VALUE' => $user_boulet_value,
			'L_USER_BOULET' => $lang['user_boulet_title'],
//-- fin mod : boulet ----------------------------------------------------------

//-- mod : restrict account to ip ----------------------------------------------
//-- add
			'USER_RESTRICTIP_YES' => ($user_restrictip) ? 'checked="checked"' : '',
			'USER_RESTRICTIP_NO' => (!$user_restrictip) ? 'checked="checked"' : '', 
			'USER_IPRANGE' => $user_iprange,
			'L_USER_RESTRICTIP' => $lang['restrictip'],
			'L_USER_IPRANGE' => $lang['iprange'],
			'L_ABOUTRESTRICTIP' => $lang['about_restrictip'],
			'L_ABOUT_IPRANGE' => $lang['about_range'],
//-- fin mod : restrict account to ip ------------------------------------------

//-- mod : points system -------------------------------------------------------
//-- add
			'POINTS' => $points,
			'ALLOW_POINTS_YES' => ($allow_points) ? 'checked="checked"' : '',
			'ALLOW_POINTS_NO' => (!$allow_points) ? 'checked="checked"' : '',
			'L_POINTS' => $board_config['points_name'],
			'L_ALLOW_POINTS' => $lang['Allow_Points'],
//-- fin mod : points system ---------------------------------------------------

//-- mod : gender --------------------------------------------------------------
//-- add
			'GENDER' => $gender,
			'GENDER_NO_SPECIFY_CHECKED' => $gender_no_specify_checked,
			'GENDER_MALE_CHECKED' => $gender_male_checked,
			'GENDER_FEMALE_CHECKED' => $gender_female_checked,

			'L_GENDER' => $lang['Gender'],
			'L_GENDER_MALE' => $lang['Male'],
			'L_GENDER_FEMALE' => $lang['Female'],
			'L_GENDER_NOT_SPECIFY' => $lang['No_gender_specify'],
//-- fin mod : gender ----------------------------------------------------------

//-- mod : skype ---------------------------------------------------------------
//-- add
			'SKYPE' => $skype,
//-- fin mod : skype -----------------------------------------------------------

//-- mod : log ip address on registration --------------------------------------
//-- add
			'USER_REGIP' => $user_regip,
			'L_REGIP' => $lang['Registration_IP'],
//-- fin mod : log ip address on registration ----------------------------------

//-- mod : users set posts & topics count --------------------------------------
//-- add
			'POSTS_PER_PAGE' => $postspp,
			'TOPICS_PER_PAGE' => $topicspp,
			'L_TOPICS_PER_PAGE' => $lang['Topics_per_page'],
			'L_TOPICS_PER_PAGE_EXPLAIN' => $lang['Topics_per_page_explain'],
			'L_POSTS_PER_PAGE' => $lang['Posts_per_page'],
			'L_POSTS_PER_PAGE_EXPLAIN' => $lang['Posts_per_page_explain'],
//-- fin mod : users set posts & topics count ----------------------------------

//-- mod : user post count editor ----------------------------------------------
//-- add
			'USER_POSTS' => $user_posts,
			'L_SET_POSTS' => $lang['Set_posts'],
//-- fin mod : user post count editor ------------------------------------------

//-- mod : account self-delete -------------------------------------------------
//-- add
			'ALLOW_ACCOUNT_DELETE_YES' => ($user_account_delete) ? 'checked="checked"' : '',
			'ALLOW_ACCOUNT_DELETE_NO' => (!$user_account_delete) ? 'checked="checked"' : '',
			'L_ALLOW_ACCOUNT_DELETE' => $lang['Allow_account_delete'],
//-- fin mod : account self-delete ---------------------------------------------

//-- mod : allow single namechange ---------------------------------------------
//-- add
			'ALLOW_NAMECHANGE_YES' => ($user_namechange) ? 'checked="checked"' : '',
			'ALLOW_NAMECHANGE_NO' => (!$user_namechange) ? 'checked="checked"' : '',
			'L_ALLOW_NAMECHANGE' => $lang['Allow_name_change'],
//-- fin mod : allow single namechange -----------------------------------------

//-- mod : disallow mail and password changes ----------------------------------
//-- add
			'ALLOW_MAILCHANGE_YES' => ($user_mailchange) ? 'checked="checked"' : '',
			'ALLOW_MAILCHANGE_NO' => (!$user_mailchange) ? 'checked="checked"' : '',
			'ALLOW_PASSWORDCHANGE_YES' => ($user_passwordchange) ? 'checked="checked"' : '',
			'ALLOW_PASSWORDCHANGE_NO' => (!$user_passwordchange) ? 'checked="checked"' : '',
			'L_ALLOW_MAILCHANGE' => $lang['Allow_mail_change'],
			'L_ALLOW_PASSWORDCHANGE' => $lang['Allow_password_change'],
//-- fin mod : disallow mail and password changes ------------------------------

//-- mod : oxygen premod -------------------------------------------------------
//-- add
			'L_AUTHORIZATIONS' => $lang['User_authorizations'],
//-- fin mod : oxygen premod ---------------------------------------------------

//-- mod : quick post es -------------------------------------------------------
//-- add
			'L_QP_SETTINGS' => $lang['qp_settings'],
//-- fin mod : quick post es ---------------------------------------------------

			'L_USERNAME' => $lang['Username'],
			'L_USER_TITLE' => $lang['User_admin'],
			'L_USER_EXPLAIN' => $lang['User_admin_explain'],
			'L_NEW_PASSWORD' => $lang['New_password'], 
			'L_PASSWORD_IF_CHANGED' => $lang['password_if_changed'],
			'L_CONFIRM_PASSWORD' => $lang['Confirm_password'],
			'L_PASSWORD_CONFIRM_IF_CHANGED' => $lang['password_confirm_if_changed'],
			'L_SUBMIT' => $lang['Submit'],
			'L_RESET' => $lang['Reset'],

//-- mod : configure member profile required fields ----------------------------
//-- delete
/*-MOD
			'L_ICQ_NUMBER' => $lang['ICQ'],
			'L_MESSENGER' => $lang['MSNM'],
			'L_YAHOO' => $lang['YIM'],
			'L_WEBSITE' => $lang['Website'],
			'L_AIM' => $lang['AIM'],
			'L_LOCATION' => $lang['Location'],
			'L_OCCUPATION' => $lang['Occupation'],
MOD-*/
//-- add
			'L_ICQ_NUMBER' => ($board_config['required_icq']) ? $lang['ICQ'] . ' * ' : $lang['ICQ'],
			'L_MESSENGER' => ($board_config['required_msn']) ? $lang['MSNM'] . ' * ' : $lang['MSNM'],
			'L_SKYPE' => ($board_config['required_skype']) ? $lang['SKYPE'] . ' * ' : $lang['SKYPE'],
			'L_YAHOO' => ($board_config['required_yim']) ? $lang['YIM'] . ' * ' : $lang['YIM'],
			'L_WEBSITE' => ($board_config['required_website']) ? $lang['Website'] . ' * ' : $lang['Website'],
			'L_AIM' => ($board_config['required_aim']) ? $lang['AIM'] . ' * ' : $lang['AIM'],
			'L_LOCATION' => ($board_config['required_location']) ? $lang['Location'] . ' * ' : $lang['Location'],
			'L_OCCUPATION' => ($board_config['required_occupation']) ? $lang['Occupation'] . ' * ' : $lang['Occupation'],
//-- fin mod : configure member profile required fields ------------------------

			'L_BOARD_LANGUAGE' => $lang['Board_lang'],
			'L_BOARD_STYLE' => $lang['Board_style'],
			'L_TIMEZONE' => $lang['Timezone'],
			'L_DATE_FORMAT' => $lang['Date_format'],
			'L_DATE_FORMAT_EXPLAIN' => $lang['Date_format_explain'],
			'L_YES' => $lang['Yes'],
			'L_NO' => $lang['No'],

//-- mod : configure member profile required fields ----------------------------
//-- delete
/*-MOD
			'L_INTERESTS' => $lang['Interests'],
MOD-*/
//-- add
			'L_INTERESTS' => ($board_config['required_interests']) ? $lang['Interests'] . ' * ' : $lang['Interests'],
//-- fin mod : configure member profile required fields ------------------------

			'L_ALWAYS_ALLOW_SMILIES' => $lang['Always_smile'],
			'L_ALWAYS_ALLOW_BBCODE' => $lang['Always_bbcode'],
			'L_ALWAYS_ALLOW_HTML' => $lang['Always_html'],
			'L_HIDE_USER' => $lang['Hide_user'],
			'L_ALWAYS_ADD_SIGNATURE' => $lang['Always_add_sig'],
			'L_SPECIAL' => $lang['User_special'],
			'L_SPECIAL_EXPLAIN' => $lang['User_special_explain'],
			'L_USER_ACTIVE' => $lang['User_status'],
			'L_ALLOW_PM' => $lang['User_allowpm'],
			'L_ALLOW_AVATAR' => $lang['User_allowavatar'],
			'L_AVATAR_PANEL' => $lang['Avatar_panel'],
			'L_AVATAR_EXPLAIN' => $lang['Admin_avatar_explain'],
			'L_DELETE_AVATAR' => $lang['Delete_Image'],
			'L_CURRENT_IMAGE' => $lang['Current_Image'],
			'L_UPLOAD_AVATAR_FILE' => $lang['Upload_Avatar_file'],
			'L_UPLOAD_AVATAR_URL' => $lang['Upload_Avatar_URL'],
			'L_AVATAR_GALLERY' => $lang['Select_from_gallery'],
			'L_SHOW_GALLERY' => $lang['View_avatar_gallery'],
			'L_LINK_REMOTE_AVATAR' => $lang['Link_remote_Avatar'],

//-- mod : configure member profile required fields ----------------------------
//-- delete
/*-MOD
			'L_SIGNATURE' => $lang['Signature'],
MOD-*/
//-- add
			'L_SIGNATURE' => ($board_config['required_signature']) ? $lang['Signature'] . ' * ' : $lang['Signature'],
//-- fin mod : configure member profile required fields ------------------------

			'L_SIGNATURE_EXPLAIN' => sprintf($lang['Signature_explain'], $board_config['max_sig_chars'] ),
			'L_NOTIFY_ON_PRIVMSG' => $lang['Notify_on_privmsg'],
			'L_NOTIFY_ON_REPLY' => $lang['Always_notify'],
			'L_POPUP_ON_PRIVMSG' => $lang['Popup_on_privmsg'],

			'L_PREFERENCES' => $lang['Preferences'],
			'L_PUBLIC_VIEW_EMAIL' => $lang['Public_view_email'],
			'L_ITEMS_REQUIRED' => $lang['Items_required'],
			'L_REGISTRATION_INFO' => $lang['Registration_info'],
			'L_PROFILE_INFO' => $lang['Profile_info'],
			'L_PROFILE_INFO_NOTICE' => $lang['Profile_info_warn'],
			'L_EMAIL_ADDRESS' => $lang['Email_address'],

			'S_FORM_ENCTYPE' => $form_enctype,

			'HTML_STATUS' => $html_status,
			'BBCODE_STATUS' => sprintf($bbcode_status, '<a href="../' . append_sid('faq.' . $phpEx . '?mode=bbcode') . '" target="_phpbbcode">', '</a>'), 
			'SMILIES_STATUS' => $smilies_status,

			'L_DELETE_USER' => $lang['User_delete'],
			'L_DELETE_USER_EXPLAIN' => $lang['User_delete_explain'],
			'L_SELECT_RANK' => $lang['Rank_title'],

			'S_HIDDEN_FIELDS' => $s_hidden_fields,
			'S_PROFILE_ACTION' => append_sid('admin_users.' . $phpEx),
		));

//-- mod : date format evolved -------------------------------------------------
//-- add
		dateformat_select($user_dateformat);
//-- fin mod : date format evolved ---------------------------------------------

		if( file_exists(@phpbb_realpath('./../' . $board_config['avatar_path'])) && ($board_config['allow_avatar_upload'] == TRUE) )
		{
			if ( $form_enctype != '' )
			{
				$template->assign_block_vars('avatar_local_upload', array() );
			}
			$template->assign_block_vars('avatar_remote_upload', array() );
		}

		if( file_exists(@phpbb_realpath('./../' . $board_config['avatar_gallery_path'])) && ($board_config['allow_avatar_local'] == TRUE) )
		{
			$template->assign_block_vars('avatar_local_gallery', array() );
		}
		
		if( $board_config['allow_avatar_remote'] == TRUE )
		{
			$template->assign_block_vars('avatar_remote_link', array() );
		}
	}

	$template->pparse('body');
}
else
{
	//
	// Default user selection box
	//
	$template->set_filenames(array('body' => 'admin/user_select_body.tpl'));

	$template->assign_vars(array(
		'L_USER_TITLE' => $lang['User_admin'],
		'L_USER_EXPLAIN' => $lang['User_admin_explain'],
		'L_USER_SELECT' => $lang['Select_a_User'],
		'L_LOOK_UP' => $lang['Look_up_user'],
		'L_FIND_USERNAME' => $lang['Find_username'],

//-- mod : rank color system ---------------------------------------------------
//-- add
		'I_SELECT' => $phpbb_root_path . $images['cmd_select'],
		'I_SEARCH' => $phpbb_root_path . $images['cmd_search'],
//-- fin mod : rank color system -----------------------------------------------

		'U_SEARCH_USER' => append_sid('./../search.' . $phpEx . '?mode=searchuser'), 

		'S_USER_ACTION' => append_sid('admin_users.' . $phpEx),
		'S_USER_SELECT' => $select_list,
	));
	$template->pparse('body');

}

include('./page_footer_admin.'.$phpEx);

?>
