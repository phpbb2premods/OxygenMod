<?php
/***************************************************************************
 *                            usercp_register.php
 *                            -------------------
 *   begin                : Saturday, Feb 13, 2001
 *   copyright            : (C) 2001 The phpBB Group
 *   email                : support@phpbb.com
 *
 *   $Id: usercp_register.php,v 1.20.2.76 2006/05/30 19:29:43 grahamje Exp $
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

/*

	This code has been modified from its original form by psoTFX @ phpbb.com
	Changes introduce the back-ported phpBB 2.2 visual confirmation code. 

	NOTE: Anyone using the modified code contained within this script MUST include
	a relevant message such as this in usercp_register.php ... failure to do so 
	will affect a breach of Section 2a of the GPL and our copyright

	png visual confirmation system : (c) phpBB Group, 2003 : All Rights Reserved

*/

if ( !defined('IN_PHPBB') )
{
	die('Hacking attempt');
	exit;
}

//-- mod : pastisd - signature editor ------------------------------------------
//-- add
$style_display_tpl = "style=\"display:none\"";
$style_row_actif = 'row1';
$style_row_non_actif = 'row2';
$style_font_actif = "style=\"font-weight: bold;\"";
//-- fin mod : pastisd - signature editor --------------------------------------

$unhtml_specialchars_match = array('#&gt;#', '#&lt;#', '#&quot;#', '#&amp;#');
$unhtml_specialchars_replace = array('>', '<', '"', '&');

//-- mod : pastisd - signature editor ------------------------------------------
//-- add
$preview = isset($HTTP_POST_VARS['preview']) ? TRUE : FALSE;
//-- fin mod : pastisd - signature editor --------------------------------------

//-- mod : disable registration ------------------------------------------------
//-- add
if( $board_config['registration_status'] && !$userdata['session_logged_in'] )
{
	if( $board_config['registration_closed'] == '' )
	{
		message_die(GENERAL_MESSAGE, 'registration_status', 'Information');
	}
	else
	{
		message_die(GENERAL_MESSAGE, $board_config['registration_closed'], 'Information');
	}
}
//-- fin mod : disable registration --------------------------------------------

// ---------------------------------------
// Load agreement template since user has not yet
// agreed to registration conditions/coppa
//
function show_coppa()
{
	global $userdata, $template, $lang, $phpbb_root_path, $phpEx;

//-- mod : vAgreement terms ----------------------------------------------------
//-- add
	global $board_config;
//-- fin mod : vAgreement terms ------------------------------------------------

	$template->set_filenames(array(
//-- mod : vAgreement terms ----------------------------------------------------
//-- delete
/*-MOD
		'body' => 'agreement.tpl')
MOD-*/
//-- add
		'body' => 'agreement_new.tpl')
//-- fin mod : vAgreement terms ------------------------------------------------
	);

	$template->assign_vars(array(
		'REGISTRATION' => $lang['Registration'],
		'AGREEMENT' => $lang['Reg_agreement'],

//-- mod : vAgreement terms ----------------------------------------------------
//-- add
		'FORUM_RULES' => $lang['Forum_Rules'],
		'TO_JOIN' => $lang['To_Join'],
		'AGREE_CHECKBOX' => sprintf($lang['Agree_checkbox'], $board_config['sitename']),
		'L_REGISTER' => $lang['Register'],
//-- fin mod : vAgreement terms ------------------------------------------------

		'AGREE_OVER_13' => $lang['Agree_over_13'],
		'AGREE_UNDER_13' => $lang['Agree_under_13'],
		'DO_NOT_AGREE' => $lang['Agree_not'],

//-- mod : vAgreement terms ----------------------------------------------------
//-- add
		'S_AGREE' => append_sid('profile.'.$phpEx . '?mode=register'),
//-- fin mod : vAgreement terms ------------------------------------------------

		'U_AGREE_OVER13' => append_sid('profile.'.$phpEx . '?mode=register&amp;agreed=true'),
		'U_AGREE_UNDER13' => append_sid('profile.'.$phpEx . '?mode=register&amp;agreed=true&amp;coppa=true'))
	);

	$template->pparse('body');

}
//
// ---------------------------------------

$error = FALSE;

//-- mod : configure member profile required fields ----------------------------
//-- add
$fields_empty = FALSE;
//-- fin mod : configure member profile required fields ------------------------

$error_msg = '';
$page_title = ( $mode == 'editprofile' ) ? $lang['Edit_profile'] : $lang['Register'];

//-- mod : vAgreement terms ----------------------------------------------------
//-- delete
/*-MOD
if ( $mode == 'register' && !isset($HTTP_POST_VARS['agreed']) && !isset($HTTP_GET_VARS['agreed']) )
{
	include($phpbb_root_path . 'includes/page_header.'.$phpEx);

	show_coppa();

	include($phpbb_root_path . 'includes/page_tail.'.$phpEx);
}
MOD-*/
//-- add
if ( $mode == 'register' && !isset($HTTP_POST_VARS['agreed']) && !isset($HTTP_POST_VARS['not_agreed']) )
{
	include($phpbb_root_path . 'includes/page_header.'.$phpEx);
	show_coppa();
	include($phpbb_root_path . 'includes/page_tail.'.$phpEx);
}

//-- mod : salt password -------------------------------------------------------
//-- add
if ( $board_config['password_security_startdate'] && $mode == 'register')
{
	$regdate = time();
}
//-- fin mod : salt password ---------------------------------------------------

else if ( $mode == 'register' && !isset($HTTP_POST_VARS['agreed']) && isset($HTTP_POST_VARS['not_agreed']) )
{
	redirect(append_sid($phpbb_root_path . 'index.' . $phpEx, true));
	exit;
}
//-- fin mod : vAgreement terms ------------------------------------------------

$coppa = ( empty($HTTP_POST_VARS['coppa']) && empty($HTTP_GET_VARS['coppa']) ) ? 0 : TRUE;

//
// Check and initialize some variables if needed
//
if (isset($HTTP_POST_VARS['submit']) || isset($HTTP_POST_VARS['avatargallery']) || isset($HTTP_POST_VARS['submitavatar']) || isset($HTTP_POST_VARS['cancelavatar']) || $mode == 'register' )
{
	include($phpbb_root_path . 'includes/functions_validate.'.$phpEx);
	include($phpbb_root_path . 'includes/bbcode.'.$phpEx);
	include($phpbb_root_path . 'includes/functions_post.'.$phpEx);

	if ( $mode == 'editprofile' )
	{
		$user_id = intval($HTTP_POST_VARS['user_id']);
		$current_email = trim(htmlspecialchars($HTTP_POST_VARS['current_email']));
	}

//-- mod : account self-delete -------------------------------------------------
//-- add
	if( $HTTP_POST_VARS['deleteuser'] )
	{
		$message = '<form action="' . append_sid('profile.'.$phpEx . '?mode=editprofile') . '" method="post">' . $lang['Delete_account_question'] . '<br /><br /><input type="submit" name="delete_confirm" value="' . $lang['Yes'] . '" class="mainoption" />&nbsp;&nbsp;<input type="submit" name="delete_cancel" value="' . $lang['No'] . '" class="liteoption" /><input type="hidden" name="user_id" value="$user_id" /></form>';
		message_die(GENERAL_MESSAGE, $message);
	}
//-- fin mod : account self-delete ---------------------------------------------

//-- mod : skype ---------------------------------------------------------------
// here we added
//	, 'skype' => 'skype'
//-- modify
//-- mod : users set posts & topics count --------------------------------------
// here we added
//	, 'postspp' => 'postspp', 'topicspp' => 'topicspp'
//-- modify
	$strip_var_list = array('email' => 'email', 'icq' => 'icq', 'aim' => 'aim', 'msn' => 'msn', 'skype' => 'skype', 'yim' => 'yim', 'website' => 'website', 'location' => 'location', 'occupation' => 'occupation', 'interests' => 'interests', 'postspp' => 'postspp', 'topicspp' => 'topicspp', 'confirm_code' => 'confirm_code');
//-- fin mod : users set posts & topics count ----------------------------------
//-- fin mod : skype -----------------------------------------------------------

	// Strip all tags from data ... may p**s some people off, bah, strip_tags is
	// doing the job but can still break HTML output ... have no choice, have
	// to use htmlspecialchars ... be prepared to be moaned at.
	while( list($var, $param) = @each($strip_var_list) )
	{
		if ( !empty($HTTP_POST_VARS[$param]) )
		{
			$$var = trim(htmlspecialchars($HTTP_POST_VARS[$param]));
		}
	}

	$username = ( !empty($HTTP_POST_VARS['username']) ) ? phpbb_clean_username($HTTP_POST_VARS['username']) : '';

//-- mod : pastisd - signature editor ------------------------------------------
//-- delete
/*-MOD
	$trim_var_list = array('cur_password' => 'cur_password', 'new_password' => 'new_password', 'password_confirm' => 'password_confirm', 'signature' => 'signature');
MOD-*/
//-- add
	$trim_var_list = array('cur_password' => 'cur_password', 'new_password' => 'new_password', 'password_confirm' => 'password_confirm', 'message' => 'message');
//-- fin mod : pastisd - signature editor --------------------------------------

	while( list($var, $param) = @each($trim_var_list) )
	{
		if ( !empty($HTTP_POST_VARS[$param]) )
		{
			$$var = trim($HTTP_POST_VARS[$param]);
		}
	}

//-- mod : pastisd - signature editor ------------------------------------------
//-- delete
/*-MOD
	$signature = (isset($signature)) ? str_replace('<br />', "\n", $signature) : '';
	$signature_bbcode_uid = '';
MOD-*/
//-- add
	$message = (isset($message)) ? str_replace('<br />', "\n", $message) : '';
	$message_bbcode_uid = '';
//-- fin mod : pastisd - signature editor --------------------------------------

//-- mod : gender --------------------------------------------------------------
//-- add
	$gender = ( isset($HTTP_POST_VARS['gender']) ) ? intval ($HTTP_POST_VARS['gender']) : 0;
//-- fin mod : gender ----------------------------------------------------------

	// Run some validation on the optional fields. These are pass-by-ref, so they'll be changed to
	// empty strings if they fail.
//-- mod : skype ---------------------------------------------------------------
// here we added
//	, $skype
//-- modify
//-- mod : pastisd - signature editor ------------------------------------------
// here we replaced
//	$signature
//	by
//	$message
//-- modify
	validate_optional_fields($icq, $aim, $msn, $skype, $yim, $website, $location, $occupation, $interests, $message);
//-- fin mod : pastisd - signature editor --------------------------------------
//-- fin mod : skype -----------------------------------------------------------

	$viewemail = ( isset($HTTP_POST_VARS['viewemail']) ) ? ( ($HTTP_POST_VARS['viewemail']) ? TRUE : 0 ) : 0;
	$allowviewonline = ( isset($HTTP_POST_VARS['hideonline']) ) ? ( ($HTTP_POST_VARS['hideonline']) ? 0 : TRUE ) : TRUE;
	$notifyreply = ( isset($HTTP_POST_VARS['notifyreply']) ) ? ( ($HTTP_POST_VARS['notifyreply']) ? TRUE : 0 ) : 0;
	$notifypm = ( isset($HTTP_POST_VARS['notifypm']) ) ? ( ($HTTP_POST_VARS['notifypm']) ? TRUE : 0 ) : TRUE;

//-- mod : points system -------------------------------------------------------
//-- add
	$notifydonation = ( isset($HTTP_POST_VARS['notifydonation']) ) ? ( ($HTTP_POST_VARS['notifydonation']) ? TRUE : 0 ) : TRUE;
//-- fin mod : points system ---------------------------------------------------

	$popup_pm = ( isset($HTTP_POST_VARS['popup_pm']) ) ? ( ($HTTP_POST_VARS['popup_pm']) ? TRUE : 0 ) : TRUE;
	$sid = (isset($HTTP_POST_VARS['sid'])) ? $HTTP_POST_VARS['sid'] : 0;

	if ( $mode == 'register' )
	{
		$attachsig = ( isset($HTTP_POST_VARS['attachsig']) ) ? ( ($HTTP_POST_VARS['attachsig']) ? TRUE : 0 ) : $board_config['allow_sig'];

		$allowhtml = ( isset($HTTP_POST_VARS['allowhtml']) ) ? ( ($HTTP_POST_VARS['allowhtml']) ? TRUE : 0 ) : $board_config['allow_html'];
		$allowbbcode = ( isset($HTTP_POST_VARS['allowbbcode']) ) ? ( ($HTTP_POST_VARS['allowbbcode']) ? TRUE : 0 ) : $board_config['allow_bbcode'];
		$allowsmilies = ( isset($HTTP_POST_VARS['allowsmilies']) ) ? ( ($HTTP_POST_VARS['allowsmilies']) ? TRUE : 0 ) : $board_config['allow_smilies'];
	}
	else
	{
		$attachsig = ( isset($HTTP_POST_VARS['attachsig']) ) ? ( ($HTTP_POST_VARS['attachsig']) ? TRUE : 0 ) : $userdata['user_attachsig'];

		$allowhtml = ( isset($HTTP_POST_VARS['allowhtml']) ) ? ( ($HTTP_POST_VARS['allowhtml']) ? TRUE : 0 ) : $userdata['user_allowhtml'];
		$allowbbcode = ( isset($HTTP_POST_VARS['allowbbcode']) ) ? ( ($HTTP_POST_VARS['allowbbcode']) ? TRUE : 0 ) : $userdata['user_allowbbcode'];
		$allowsmilies = ( isset($HTTP_POST_VARS['allowsmilies']) ) ? ( ($HTTP_POST_VARS['allowsmilies']) ? TRUE : 0 ) : $userdata['user_allowsmile'];
	}

	$user_style = ( isset($HTTP_POST_VARS['style']) ) ? intval($HTTP_POST_VARS['style']) : $board_config['default_style'];

	if ( !empty($HTTP_POST_VARS['language']) )
	{
		if ( preg_match('/^[a-z_]+$/i', $HTTP_POST_VARS['language']) )
		{
			$user_lang = htmlspecialchars($HTTP_POST_VARS['language']);
		}
		else
		{
			$error = true;
			$error_msg = $lang['Fields_empty'];

//-- mod : configure member profile required fields ----------------------------
//-- add
			$fields_empty = TRUE;
//-- fin mod : configure member profile required fields ------------------------
		}
	}
	else
	{
		$user_lang = $board_config['default_lang'];
	}

	$user_timezone = ( isset($HTTP_POST_VARS['timezone']) ) ? doubleval($HTTP_POST_VARS['timezone']) : $board_config['board_timezone'];

	$sql = 'SELECT config_value FROM ' . CONFIG_TABLE . ' WHERE config_name = \'default_dateformat\'';
	if ( !$result = $db->sql_query($sql) )
	{
		message_die(GENERAL_ERROR, 'Could not select default dateformat', '', __LINE__, __FILE__, $sql);
	}
	$row = $db->sql_fetchrow($result);
	$board_config['default_dateformat'] = $row['config_value'];
	$user_dateformat = ( !empty($HTTP_POST_VARS['dateformat']) ) ? trim(htmlspecialchars($HTTP_POST_VARS['dateformat'])) : $board_config['default_dateformat'];

	$user_avatar_local = ( isset($HTTP_POST_VARS['avatarselect']) && !empty($HTTP_POST_VARS['submitavatar']) && $board_config['allow_avatar_local'] ) ? htmlspecialchars($HTTP_POST_VARS['avatarselect']) : ( ( isset($HTTP_POST_VARS['avatarlocal'])  ) ? htmlspecialchars($HTTP_POST_VARS['avatarlocal']) : '' );
	$user_avatar_category = ( isset($HTTP_POST_VARS['avatarcatname']) && $board_config['allow_avatar_local'] ) ? htmlspecialchars($HTTP_POST_VARS['avatarcatname']) : '' ;

	$user_avatar_remoteurl = ( !empty($HTTP_POST_VARS['avatarremoteurl']) ) ? trim(htmlspecialchars($HTTP_POST_VARS['avatarremoteurl'])) : '';
	$user_avatar_upload = ( !empty($HTTP_POST_VARS['avatarurl']) ) ? trim($HTTP_POST_VARS['avatarurl']) : ( ( $HTTP_POST_FILES['avatar']['tmp_name'] != "none") ? $HTTP_POST_FILES['avatar']['tmp_name'] : '' );
	$user_avatar_name = ( !empty($HTTP_POST_FILES['avatar']['name']) ) ? $HTTP_POST_FILES['avatar']['name'] : '';
	$user_avatar_size = ( !empty($HTTP_POST_FILES['avatar']['size']) ) ? $HTTP_POST_FILES['avatar']['size'] : 0;
	$user_avatar_filetype = ( !empty($HTTP_POST_FILES['avatar']['type']) ) ? $HTTP_POST_FILES['avatar']['type'] : '';

	$user_avatar = ( empty($user_avatar_local) && $mode == 'editprofile' ) ? $userdata['user_avatar'] : '';
	$user_avatar_type = ( empty($user_avatar_local) && $mode == 'editprofile' ) ? $userdata['user_avatar_type'] : '';

//-- mod : birthday ------------------------------------------------------------
//-- add
	$bday_day = ( isset($HTTP_POST_VARS['bday_day']) ) ? intval($HTTP_POST_VARS['bday_day']) : $bday_day;
	$bday_month = ( isset($HTTP_POST_VARS['bday_month']) ) ? intval($HTTP_POST_VARS['bday_month']) : $bday_month;
	$bday_year = ( isset($HTTP_POST_VARS['bday_year']) ) ? intval($HTTP_POST_VARS['bday_year']) : $bday_year;
//-- fin mod : birthday --------------------------------------------------------

//-- mod : quick post es -------------------------------------------------------
//-- add
	// config data
	if (!empty($board_config['users_qp_settings']))
	{
		list($board_config['user_qp'], $board_config['user_qp_show'], $board_config['user_qp_subject'], $board_config['user_qp_bbcode'], $board_config['user_qp_smilies'], $board_config['user_qp_more']) = explode('-', $board_config['users_qp_settings']);
	}

	$params = array('user_qp', 'user_qp_show', 'user_qp_subject', 'user_qp_bbcode', 'user_qp_smilies', 'user_qp_more');
	for($i = 0; $i < count($params); $i++)
	{
		$qp_config = ($mode == 'register') ? intval($board_config[$params[$i]]) : intval($userdata[$params[$i]]);
		$$params[$i] = (isset($HTTP_POST_VARS[$params[$i]])) ? (!empty($HTTP_POST_VARS[$params[$i]]) ? intval($HTTP_POST_VARS[$params[$i]]) : intval($$params[$i])) : $qp_config;
	}
//-- fin mod : quick post es ---------------------------------------------------

	if ( (isset($HTTP_POST_VARS['avatargallery']) || isset($HTTP_POST_VARS['submitavatar']) || isset($HTTP_POST_VARS['cancelavatar'])) && (!isset($HTTP_POST_VARS['submit'])) )
	{
//-- mod : pastisd - signature editor ------------------------------------------
//-- delete
/*-MOD
		$username = stripslashes($username);
		$email = stripslashes($email);
		$cur_password = htmlspecialchars(stripslashes($cur_password));
		$new_password = htmlspecialchars(stripslashes($new_password));
		$password_confirm = htmlspecialchars(stripslashes($password_confirm));

		$icq = stripslashes($icq);
		$aim = stripslashes($aim);
		$msn = stripslashes($msn);
		$yim = stripslashes($yim);

		$website = stripslashes($website);
		$location = stripslashes($location);
		$occupation = stripslashes($occupation);
		$interests = stripslashes($interests);
		$signature = htmlspecialchars(stripslashes($signature));

		$user_lang = stripslashes($user_lang);
		$user_dateformat = stripslashes($user_dateformat);
MOD-*/
//-- add
		$username = stripslashes(stripslashes($username));
		$email = stripslashes(stripslashes($email));
		$cur_password = htmlspecialchars(stripslashes(stripslashes($cur_password)));
		$new_password = htmlspecialchars(stripslashes(stripslashes($new_password)));
		$password_confirm = htmlspecialchars(stripslashes(stripslashes($password_confirm)));

		$icq = stripslashes(stripslashes($icq));
		$aim = stripslashes(stripslashes($aim));
		$msn = stripslashes(stripslashes($msn));

//-- mod : skype ---------------------------------------------------------------
//-- add
		$skype = stripslashes(stripslashes($skype));
//-- fin mod : skype -----------------------------------------------------------

		$yim = stripslashes(stripslashes($yim));
		$website = stripslashes(stripslashes($website));
		$location = stripslashes(stripslashes($location));
		$occupation = stripslashes(stripslashes($occupation));
		$interests = stripslashes(stripslashes($interests));

//-- mod : users set posts & topics count --------------------------------------
//-- add
		$postspp = stripslashes(stripslashes($postspp));
		$topicspp = stripslashes(stripslashes($topicspp));
//-- fin mod : users set posts & topics count ----------------------------------

		$message = htmlspecialchars(stripslashes(stripslashes($message)));

		$user_lang = stripslashes(stripslashes($user_lang));
		$user_dateformat = stripslashes(stripslashes($user_dateformat));

		$location = str_replace("'", "\'", $location);
		$occupation = str_replace("'", "\'", $occupation);
		$interests = str_replace("'", "\'", $interests);
		$aim = str_replace("'", "\'", $aim);
		$msn = str_replace("'", "\'", $msn);
		$yim = str_replace("'", "\'", $yim);
		$skype = str_replace("'", "\'", $skype);

		$website = str_replace("'", "\'", $website); 
//-- fin mod : pastisd - signature editor --------------------------------------

		if ( !isset($HTTP_POST_VARS['cancelavatar']))
		{
			$user_avatar = $user_avatar_category . '/' . $user_avatar_local;
			$user_avatar_type = USER_AVATAR_GALLERY;
		}
	}
}

//-- mod : account self-delete -------------------------------------------------
//-- add
if( isset($HTTP_POST_VARS['delete_confirm']) )
{  
	$user_id = intval($HTTP_POST_VARS['user_id']);

  $sql = 'SELECT username FROM ' . USERS_TABLE . ' WHERE user_id = ' . intval($user_id);
  if( !$result = $db->sql_query($sql) )
  {
    message_die(GENERAL_ERROR, 'Could not obtain username for this user', '', __LINE__, __FILE__, $sql);
  }

  while ($row = $db->sql_fetchrow($result))
  {
     $username = $row['username'];
  }
  $db->sql_freeresult($result);

	$sql = 'SELECT g.group_id
		FROM ' . USER_GROUP_TABLE . ' ug, ' . GROUPS_TABLE . ' g
		WHERE ug.user_id = ' . intval($user_id) . '
			AND g.group_id = ug.group_id
			AND g.group_single_user = 1';
	if( !($result = $db->sql_query($sql)) )
	{
		message_die(GENERAL_ERROR, 'Could not obtain group information for this user', '', __LINE__, __FILE__, $sql);
	}

	$row = $db->sql_fetchrow($result);

	$sql = 'UPDATE ' . POSTS_TABLE . '
		SET poster_id = ' . DELETED . ', post_username = \'' . $username . '\'
		WHERE poster_id = ' . intval($user_id);
	if( !$db->sql_query($sql) )
	{
		message_die(GENERAL_ERROR, 'Could not update posts for this user', '', __LINE__, __FILE__, $sql);
	}

	$sql = 'UPDATE ' . TOPICS_TABLE . '
		SET topic_poster = ' . DELETED . '
		WHERE topic_poster = ' . intval($user_id);
	if( !$db->sql_query($sql) )
	{
		message_die(GENERAL_ERROR, 'Could not update topics for this user', '', __LINE__, __FILE__, $sql);
	}

	$sql = 'UPDATE ' . VOTE_USERS_TABLE . '
		SET vote_user_id = ' . DELETED . '
		WHERE vote_user_id = ' . intval($user_id);
	if( !$db->sql_query($sql) )
	{
		message_die(GENERAL_ERROR, 'Could not update votes for this user', '', __LINE__, __FILE__, $sql);
	}

	$sql = 'SELECT group_id
		FROM ' . GROUPS_TABLE . '
		WHERE group_moderator = ' . intval($user_id);
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

	$sql = 'DELETE FROM ' . USERS_TABLE . '
		WHERE user_id = ' . intval($user_id);
	if( !$db->sql_query($sql) )
	{
		message_die(GENERAL_ERROR, 'Could not delete user', '', __LINE__, __FILE__, $sql);
	}

	$sql = 'DELETE FROM ' . USER_GROUP_TABLE . '
		WHERE user_id = ' . intval($user_id);
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
		WHERE user_id = ' . intval($user_id);
	if ( !$db->sql_query($sql) )
	{
		message_die(GENERAL_ERROR, 'Could not delete user from topic watch table', '', __LINE__, __FILE__, $sql);
	}
			
	$sql = 'DELETE FROM ' . BANLIST_TABLE . '
		WHERE ban_userid = ' . intval($user_id);
	if ( !$db->sql_query($sql) )
	{
		message_die(GENERAL_ERROR, 'Could not delete user from banlist table', '', __LINE__, __FILE__, $sql);
	}

	$sql = 'SELECT privmsgs_id
		FROM ' . PRIVMSGS_TABLE . '
		WHERE privmsgs_from_userid = ' . intval($user_id) . '
		OR privmsgs_to_userid = ' . intval($user_id);
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

	$message = $lang['User_deleted'] . '<br /><br />' . sprintf($lang['Click_return_index'], '<a href="' . append_sid('index.'.$phpEx) . '">', '</a>');
	message_die(GENERAL_MESSAGE, $message);
}
//-- fin mod : account self-delete ---------------------------------------------

//
// Let's make sure the user isn't logged in while registering,
// and ensure that they were trying to register a second time
// (Prevents double registrations)
//
if ($mode == 'register' && ($userdata['session_logged_in'] || $username == $userdata['username']))
{
	message_die(GENERAL_MESSAGE, $lang['Username_taken'], '', __LINE__, __FILE__);
}

//
// Did the user submit? In this case build a query to update the users profile in the DB
//
//-- mod : pastisd - signature editor ------------------------------------------
//-- delete
/*-MOD
if ( isset($HTTP_POST_VARS['submit']) )
MOD-*/
//-- add
if ( isset($HTTP_POST_VARS['submit']) || isset($HTTP_POST_VARS['submitavatar']) )
//-- fin mod : pastisd - signature editor --------------------------------------
{
	include($phpbb_root_path . 'includes/usercp_avatar.'.$phpEx);

	// session id check
	if ($sid == '' || $sid != $userdata['session_id'])
	{
		$error = true;
		$error_msg .= ( ( isset($error_msg) ) ? '<br />' : '' ) . $lang['Session_invalid'];
	}

	$passwd_sql = '';
	if ( $mode == 'editprofile' )
	{
		if ( $user_id != $userdata['user_id'] )
		{
			$error = TRUE;
			$error_msg .= ( ( isset($error_msg) ) ? '<br />' : '' ) . $lang['Wrong_Profile'];
		}
	}
	else if ( $mode == 'register' )
	{
		if ( empty($username) || empty($new_password) || empty($password_confirm) || empty($email) )
		{
			$error = TRUE;
			$error_msg .= ( ( isset($error_msg) ) ? '<br />' : '' ) . $lang['Fields_empty'];

//-- mod : configure member profile required fields ----------------------------
//-- add
			$fields_empty = TRUE;
//-- fin mod : configure member profile required fields ------------------------
		}
	}

//-- mod : configure member profile required fields ----------------------------
//-- add
	if ( $board_config['required_yim'] && empty($yim))
	{
		$error = TRUE;
		if ( $fields_empty == FALSE )
		{
			$error_msg .= ( ( isset($error_msg) ) ? '<br />' : '' ) . $lang['Fields_empty'];
			$fields_empty = TRUE;
		}
	}
	if ( $board_config['required_icq'] && empty($icq))
	{
		$error = TRUE;
		if ( $fields_empty == FALSE )
		{
			$error_msg .= ( ( isset($error_msg) ) ? '<br />' : '' ) . $lang['Fields_empty'];
			$fields_empty = TRUE;
		}
	}
	if ( $board_config['required_msnm'] && empty($msn))
	{
		$error = TRUE;
		if ( $fields_empty == FALSE )
		{
			$error_msg .= ( ( isset($error_msg) ) ? '<br />' : '' ) . $lang['Fields_empty'];
			$fields_empty = TRUE;
		}
	}
	if ( $board_config['required_skype'] && empty($skype))
	{
		$error = TRUE;
		if ( $fields_empty == FALSE )
		{
			$error_msg .= ( ( isset($error_msg) ) ? '<br />' : '' ) . $lang['Fields_empty'];
			$fields_empty = TRUE;
		}
	}
	if ( $board_config['required_aim'] && empty($aim))
	{
		$error = TRUE;
		if ( $fields_empty == FALSE )
		{
			$error_msg .= ( ( isset($error_msg) ) ? '<br />' : '' ) . $lang['Fields_empty'];
			$fields_empty = TRUE;
		}
	}
	if ( $board_config['required_occupation'] && empty($occupation))
	{
		$error = TRUE;
		if ( $fields_empty == FALSE )
		{
			$error_msg .= ( ( isset($error_msg) ) ? '<br />' : '' ) . $lang['Fields_empty'];
			$fields_empty = TRUE;
		}
	}
	if ( $board_config['required_interests'] && empty($interests))
	{
		$error = TRUE;
		if ( $fields_empty == FALSE )
		{
			$error_msg .= ( ( isset($error_msg) ) ? '<br />' : '' ) . $lang['Fields_empty'];
			$fields_empty = TRUE;
		}
	}
	if ( $board_config['required_location'] && empty($location))
	{
		$error = TRUE;
		if ( $fields_empty == FALSE )
		{
			$error_msg .= ( ( isset($error_msg) ) ? '<br />' : '' ) . $lang['Fields_empty'];
			$fields_empty = TRUE;
		}
	}
	if ( $board_config['required_website'] && empty($website))
	{
		$error = TRUE;
		if ( $fields_empty == FALSE )
		{
			$error_msg .= ( ( isset($error_msg) ) ? '<br />' : '' ) . $lang['Fields_empty'];
			$fields_empty = TRUE;
		}
	}
//-- mod : pastisd - signature editor ------------------------------------------
//-- delete
/*-MOD
	if ( $board_config['required_signature'] && empty($signature))
MOD-*/
//-- add
	if ( $board_config['required_signature'] && empty($message))
//-- fin mod : pastisd - signature editor --------------------------------------
	{
		$error = TRUE;
		if ( $fields_empty == FALSE )
		{
			$error_msg .= ( ( isset($error_msg) ) ? '<br />' : '' ) . $lang['Fields_empty'];
			$fields_empty = TRUE;
		}
	}

	if ( $board_config['required_posts_per_page'] && empty($postspp))
	{
		$error = TRUE;
		if ( $fields_empty == FALSE )
		{
			$error_msg .= ( ( isset($error_msg) ) ? '<br />' : '' ) . $lang['Fields_empty'];
			$fields_empty = TRUE;
		}
	}
	if ( $board_config['required_topics_per_page'] && empty($topicspp))
	{
		$error = TRUE;
		if ( $fields_empty == FALSE )
		{
			$error_msg .= ( ( isset($error_msg) ) ? '<br />' : '' ) . $lang['Fields_empty'];
			$fields_empty = TRUE;
		}
	}
//-- fin mod : configure member profile required fields ------------------------

	if ($board_config['enable_confirm'] && $mode == 'register')
	{
		if (empty($HTTP_POST_VARS['confirm_id']))
		{
			$error = TRUE;
			$error_msg .= ( ( isset($error_msg) ) ? '<br />' : '' ) . $lang['Confirm_code_wrong'];
		}
		else
		{
			$confirm_id = htmlspecialchars($HTTP_POST_VARS['confirm_id']);
			if (!preg_match('/^[A-Za-z0-9]+$/', $confirm_id))
			{
				$confirm_id = '';
			}
			
			$sql = 'SELECT code 
				FROM ' . CONFIRM_TABLE . " 
				WHERE confirm_id = '$confirm_id' 
					AND session_id = '" . $userdata['session_id'] . "'";
			if (!($result = $db->sql_query($sql)))
			{
				message_die(GENERAL_ERROR, 'Could not obtain confirmation code', '', __LINE__, __FILE__, $sql);
			}

			if ($row = $db->sql_fetchrow($result))
			{
				if ($row['code'] != $confirm_code)
				{
					$error = TRUE;
					$error_msg .= ( ( isset($error_msg) ) ? '<br />' : '' ) . $lang['Confirm_code_wrong'];
				}
				else
				{
					$sql = 'DELETE FROM ' . CONFIRM_TABLE . " 
						WHERE confirm_id = '$confirm_id' 
							AND session_id = '" . $userdata['session_id'] . "'";
					if (!$db->sql_query($sql))
					{
						message_die(GENERAL_ERROR, 'Could not delete confirmation code', '', __LINE__, __FILE__, $sql);
					}
				}
			}
			else
			{		
				$error = TRUE;
				$error_msg .= ( ( isset($error_msg) ) ? '<br />' : '' ) . $lang['Confirm_code_wrong'];
			}
			$db->sql_freeresult($result);
		}
	}

	$passwd_sql = '';
	if ( !empty($new_password) && !empty($password_confirm) )
	{
		if ( $new_password != $password_confirm )
		{
			$error = TRUE;
			$error_msg .= ( ( isset($error_msg) ) ? '<br />' : '' ) . $lang['Password_mismatch'];
		}
		else if ( strlen($new_password) > 32 )
		{
			$error = TRUE;
			$error_msg .= ( ( isset($error_msg) ) ? '<br />' : '' ) . $lang['Password_long'];
		}
		else
		{
			if ( $mode == 'editprofile' )
			{
				$sql = 'SELECT user_password
					FROM ' . USERS_TABLE . '
					WHERE user_id = ' . intval($user_id);

//-- mod : salt password -------------------------------------------------------
//-- add
				if ( $board_config['password_security_startdate'] )
				{
					$sql = str_replace('user_password', 'user_password, user_regdate', $sql);
				}
//-- fin mod : salt password ---------------------------------------------------

				if ( !$result = $db->sql_query($sql) )
				{
					message_die(GENERAL_ERROR, 'Could not obtain user_password information', '', __LINE__, __FILE__, $sql);
				}

				$row = $db->sql_fetchrow($result);

//-- mod : salt password -------------------------------------------------------
//-- delete
/*-MOD
				if ( $row['user_password'] != md5($cur_password) )
				{
					$error = TRUE;
					$error_msg .= ( ( isset($error_msg) ) ? '<br />' : '' ) . $lang['Current_password_mismatch'];
				}
MOD-*/
//-- add
				if ( $board_config['password_security_startdate'] )
				{
					$regdate = $row['user_regdate'];
					if ( $row['user_password'] != md5(md5($cur_password) . $regdate) )
					{
						$error = TRUE;
						$error_msg .= ( ( isset($error_msg) ) ? '<br />' : '' ) . $lang['Current_password_mismatch'];
					}
				}
				else
				{
					if ( $row['user_password'] != md5($cur_password) )
					{
						$error = TRUE;
						$error_msg .= ( ( isset($error_msg) ) ? '<br />' : '' ) . $lang['Current_password_mismatch'];
					}
				}
//-- fin mod : salt password ---------------------------------------------------

			}

			if ( !$error )
			{
//-- mod : salt password -------------------------------------------------------
//-- delete
/*-MOD
				$new_password = md5($new_password);
MOD-*/
//-- add
				$new_password = ( $board_config['password_security_startdate'] ) ? md5(md5($new_password) . $regdate) : md5($new_password);
//-- fin mod : salt password ---------------------------------------------------
				$passwd_sql = "user_password = '$new_password', ";
			}
		}
	}
	else if ( ( empty($new_password) && !empty($password_confirm) ) || ( !empty($new_password) && empty($password_confirm) ) )
	{
		$error = TRUE;
		$error_msg .= ( ( isset($error_msg) ) ? '<br />' : '' ) . $lang['Password_mismatch'];
	}

	//
	// Do a ban check on this email address
	//
	if ( $email != $userdata['user_email'] || $mode == 'register' )
	{
		$result = validate_email($email);
		if ( $result['error'] )
		{
			$email = $userdata['user_email'];

			$error = TRUE;
			$error_msg .= ( ( isset($error_msg) ) ? '<br />' : '' ) . $result['error_msg'];
		}

		if ( $mode == 'editprofile' )
		{
			$sql = 'SELECT user_password
				FROM ' . USERS_TABLE . '
				WHERE user_id = ' . intval($user_id);

//-- mod : salt password -------------------------------------------------------
//-- add
			if ( $board_config['password_security_startdate'] )
			{
				$sql = str_replace('user_password', 'user_password, user_regdate', $sql);
			}
//-- fin mod : salt password ---------------------------------------------------

			if ( !$result = $db->sql_query($sql) )
			{
				message_die(GENERAL_ERROR, 'Could not obtain user_password information', '', __LINE__, __FILE__, $sql);
			}

			$row = $db->sql_fetchrow($result);

//-- mod : salt password -------------------------------------------------------
//-- delete
/*-MOD
			if ( $row['user_password'] != md5($cur_password) )
			{
				$email = $userdata['user_email'];

				$error = TRUE;
				$error_msg .= ( ( isset($error_msg) ) ? '<br />' : '' ) . $lang['Current_password_mismatch'];
			}
MOD-*/
//-- add
			if ( $board_config['password_security_startdate'] && ($row['user_password'] != md5(md5($cur_password) . $row['user_regdate']) ))
			{
				$email = $userdata['user_email'];
				$error = TRUE;
				$error_msg .= ( ( isset($error_msg) ) ? '<br />' : '' ) . $lang['Current_password_mismatch'];
			}
			else if ( $row['user_password'] != md5($cur_password) )
			{
				$email = $userdata['user_email'];
				$error = TRUE;
				$error_msg .= ( ( isset($error_msg) ) ? '<br />' : '' ) . $lang['Current_password_mismatch'];
			}
//-- fin mod : salt password ---------------------------------------------------

		}
	}

	$username_sql = '';
//-- mod : allow single namechange ---------------------------------------------
//-- delete
/*-MOD
	if ( $board_config['allow_namechange'] || $mode == 'register' )
MOD-*/
//-- add
	if ( $board_config['allow_namechange'] && $namechange || $mode == 'register' )
//-- fin mod : allow single namechange -----------------------------------------
	{
		if ( empty($username) )
		{
			// Error is already triggered, since one field is empty.
			$error = TRUE;
		}
		else if ( $username != $userdata['username'] || $mode == 'register')
		{
			if (strtolower($username) != strtolower($userdata['username']) || $mode == 'register')
			{
				$result = validate_username($username);
				if ( $result['error'] )
				{
					$error = TRUE;
					$error_msg .= ( ( isset($error_msg) ) ? '<br />' : '' ) . $result['error_msg'];
				}
			}

			if (!$error)
			{
				$username_sql = "username = '" . str_replace("\'", "''", $username) . "', ";
			}
		}
	}

//-- mod : pastisd - signature editor ------------------------------------------
//-- delete
/*-MOD
	if ( $signature != '' )
	{
		if ( strlen($signature) > $board_config['max_sig_chars'] )
		{
			$error = TRUE;
			$error_msg .= ( ( isset($error_msg) ) ? '<br />' : '' ) . $lang['Signature_too_long'];
		}

		if ( !isset($signature_bbcode_uid) || $signature_bbcode_uid == '' )
		{
			$signature_bbcode_uid = ( $allowbbcode ) ? make_bbcode_uid() : '';
		}
		$signature = prepare_message($signature, $allowhtml, $allowbbcode, $allowsmilies, $signature_bbcode_uid);
	}
MOD-*/
//-- add
	if ( $message != '' )
	{
		if ( strlen($message) > $board_config['max_sig_chars'] )
		{
			$error = TRUE;
			$error_msg .= ( ( isset($error_msg) ) ? '<br />' : '' ) . $lang['Signature_too_long'];
		}

		if ( !isset($message_bbcode_uid) || $message_bbcode_uid == '' )
		{
			$message_bbcode_uid = ( $allowbbcode ) ? make_bbcode_uid() : '';
		}
		$message = prepare_message($message, $allowhtml, $allowbbcode, $allowsmilies, $message_bbcode_uid);
	}
//-- fin mod : pastisd - signature editor --------------------------------------

	if ( $website != '' )
	{
		rawurlencode($website);
	}

	$avatar_sql = '';

	if ( isset($HTTP_POST_VARS['avatardel']) && $mode == 'editprofile' )
	{
		$avatar_sql = user_avatar_delete($userdata['user_avatar_type'], $userdata['user_avatar']);
	}
	else
	if ( ( !empty($user_avatar_upload) || !empty($user_avatar_name) ) && $board_config['allow_avatar_upload'] )
	{
		if ( !empty($user_avatar_upload) )
		{
			$avatar_mode = (empty($user_avatar_name)) ? 'remote' : 'local';
			$avatar_sql = user_avatar_upload($mode, $avatar_mode, $userdata['user_avatar'], $userdata['user_avatar_type'], $error, $error_msg, $user_avatar_upload, $user_avatar_name, $user_avatar_size, $user_avatar_filetype);
		}
		else if ( !empty($user_avatar_name) )
		{
			$l_avatar_size = sprintf($lang['Avatar_filesize'], round($board_config['avatar_filesize'] / 1024));

			$error = true;
			$error_msg .= ( ( !empty($error_msg) ) ? '<br />' : '' ) . $l_avatar_size;
		}
	}
	else if ( $user_avatar_remoteurl != '' && $board_config['allow_avatar_remote'] )
	{
		user_avatar_delete($userdata['user_avatar_type'], $userdata['user_avatar']);
		$avatar_sql = user_avatar_url($mode, $error, $error_msg, $user_avatar_remoteurl);
	}
	else if ( $user_avatar_local != '' && $board_config['allow_avatar_local'] )
	{
		user_avatar_delete($userdata['user_avatar_type'], $userdata['user_avatar']);
		$avatar_sql = user_avatar_gallery($mode, $error, $error_msg, $user_avatar_local, $user_avatar_category);
	}

//-- mod : gender --------------------------------------------------------------
//-- add
	if ( $board_config['gender_required'] )
	{
		if (!$gender)
		{
			$error = TRUE;
			$error_msg .= ( ( isset($error_msg) ) ? '<br />' : '' ) . $lang['Gender_require'];
		}
	}
//-- fin mod : gender ----------------------------------------------------------

//-- mod : birthday ------------------------------------------------------------
//-- add
	$bday_required = (int)substr($board_config['birthday_settings'], 0, 1);
	if ( (empty($bday_day) || empty($bday_month) || empty($bday_year)) && $bday_required )
	{
		$error = true;
		$error_msg .= ( ( isset($error_msg) ) ? '<br />' : '' ) . $lang['bday_required'];
	}
//-- fin mod : birthday --------------------------------------------------------

	if ( !$error )
	{
		if ( $avatar_sql == '' )
		{
			$avatar_sql = ( $mode == 'editprofile' ) ? '' : "'', " . USER_AVATAR_NONE;
		}

		if ( $mode == 'editprofile' )
		{
			if ( $email != $userdata['user_email'] && $board_config['require_activation'] != USER_ACTIVATION_NONE && $userdata['user_level'] != ADMIN )
			{
				$user_active = 0;

				$user_actkey = gen_rand_string(true);
				$key_len = 54 - ( strlen($server_url) );
				$key_len = ( $key_len > 6 ) ? $key_len : 6;
				$user_actkey = substr($user_actkey, 0, $key_len);

				if ( $userdata['session_logged_in'] )
				{
					session_end($userdata['session_id'], $userdata['user_id']);
				}
			}
			else
			{
				$user_active = 1;
				$user_actkey = '';
			}

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
				SET " . $username_sql . $passwd_sql . "user_email = '" . str_replace("\'", "''", $email) ."', user_icq = '" . str_replace("\'", "''", $icq) . "', user_website = '" . str_replace("\'", "''", $website) . "', user_occ = '" . str_replace("\'", "''", $occupation) . "', user_from = '" . str_replace("\'", "''", $location) . "', user_interests = '" . str_replace("\'", "''", $interests) . "', user_sig = '" . str_replace("\'", "''", $signature) . "', user_sig_bbcode_uid = '$signature_bbcode_uid', user_viewemail = $viewemail, user_aim = '" . str_replace("\'", "''", str_replace(' ', '+', $aim)) . "', user_yim = '" . str_replace("\'", "''", $yim) . "', user_msnm = '" . str_replace("\'", "''", $msn) . "', user_attachsig = $attachsig, user_allowsmile = $allowsmilies, user_allowhtml = $allowhtml, user_allowbbcode = $allowbbcode, user_allow_viewonline = $allowviewonline, user_notify = $notifyreply, user_notify_pm = $notifypm, user_popup_pm = $popup_pm, user_timezone = $user_timezone, user_dateformat = '" . str_replace("\'", "''", $user_dateformat) . "', user_lang = '" . str_replace("\'", "''", $user_lang) . "', user_style = $user_style, user_active = $user_active, user_actkey = '" . str_replace("\'", "''", $user_actkey) . "'" . $avatar_sql . "
				WHERE user_id = $user_id";

//-- mod : oxygen premod -------------------------------------------------------
//-- add
			$sql = str_replace('SET ', 'SET user_qp_settings = \'' . $user_qp_settings . '\', user_skype = \'' . str_replace("\'", "''", $skype) . '\', user_birthday = \'' . $user_birthday . '\', user_notify_donation = ' . $notifydonation . ', user_gender = \'' . $gender . '\', user_postspp = \'' . str_replace("\'", "''", $postspp) . '\', user_topicspp = \'' . str_replace("\'", "''", $topicspp) . '\', ', $sql);
//-- fin mod : oxygen premod ---------------------------------------------------

//-- mod : pastisd - signature editor ------------------------------------------
//-- add
			$sql = str_replace(', user_sig = \'' . str_replace("\'", "''", $signature) . '\', user_sig_bbcode_uid = \'' . $signature_bbcode_uid . '\'', ', user_sig = \'' . str_replace("\'", "''", $message) . '\', user_sig_bbcode_uid = \'' . $message_bbcode_uid . '\'', $sql);
//-- fin mod : pastisd - signature editor --------------------------------------

			if ( !$result = $db->sql_query($sql) )
			{
				message_die(GENERAL_ERROR, 'Could not update users table', '', __LINE__, __FILE__, $sql);
			}

//-- mod : the logger ----------------------------------------------------------
//-- add
			if( defined( 'LOG_MOD_INSTALLED' ) )
			{
				if( $log->config['log_user_profile'] )
				{
					$log->insert( LOG_TYPE_USER, 'LOG_U_PROFILE', array() );
				}
			}
//-- fin mod : the logger ------------------------------------------------------

			// We remove all stored login keys since the password has been updated
			// and change the current one (if applicable)
			if ( !empty($passwd_sql) )
			{
				session_reset_keys($user_id, $user_ip);
			}

			if ( !$user_active )
			{
				//
				// The users account has been deactivated, send them an email with a new activation key
				//
				include($phpbb_root_path . 'includes/emailer.'.$phpEx);
				$emailer = new emailer($board_config['smtp_delivery']);

 				if ( $board_config['require_activation'] != USER_ACTIVATION_ADMIN )
 				{
 					$emailer->from($board_config['board_email']);
 					$emailer->replyto($board_config['board_email']);
 
 					$emailer->use_template('user_activate', stripslashes($user_lang));
 					$emailer->email_address($email);
 					$emailer->set_subject($lang['Reactivate']);
  
 					$emailer->assign_vars(array(
 						'SITENAME' => $board_config['sitename'],
 						'USERNAME' => preg_replace($unhtml_specialchars_match, $unhtml_specialchars_replace, substr(str_replace("\'", "'", $username), 0, 25)),
 						'EMAIL_SIG' => (!empty($board_config['board_email_sig'])) ? str_replace('<br />', "\n", "-- \n" . $board_config['board_email_sig']) : '',

 						'U_ACTIVATE' => $server_url . '?mode=activate&' . POST_USERS_URL . '=' . $user_id . '&act_key=' . $user_actkey,
					));
 					$emailer->send();
 					$emailer->reset();
 				}
 				else if ( $board_config['require_activation'] == USER_ACTIVATION_ADMIN )
 				{
 					$sql = 'SELECT user_email, user_lang FROM ' . USERS_TABLE . ' WHERE user_level = ' . ADMIN;
 					if ( !($result = $db->sql_query($sql)) )
 					{
 						message_die(GENERAL_ERROR, 'Could not select Administrators', '', __LINE__, __FILE__, $sql);
 					}
 					
 					while ($row = $db->sql_fetchrow($result))
 					{
 						$emailer->from($board_config['board_email']);
 						$emailer->replyto($board_config['board_email']);
 						
 						$emailer->email_address(trim($row['user_email']));
 						$emailer->use_template("admin_activate", $row['user_lang']);
 						$emailer->set_subject($lang['Reactivate']);
 
 						$emailer->assign_vars(array(
 							'USERNAME' => preg_replace($unhtml_specialchars_match, $unhtml_specialchars_replace, substr(str_replace("\'", "'", $username), 0, 25)),
 							'EMAIL_SIG' => str_replace('<br />', "\n", "-- \n" . $board_config['board_email_sig']),
 
 							'U_ACTIVATE' => $server_url . '?mode=activate&' . POST_USERS_URL . '=' . $user_id . '&act_key=' . $user_actkey,
						));
 						$emailer->send();
 						$emailer->reset();
 					}
 					$db->sql_freeresult($result);
 				}

				$message = $lang['Profile_updated_inactive'] . '<br /><br />' . sprintf($lang['Click_return_index'],  '<a href="' . append_sid('index.' . $phpEx) . '">', '</a>');
			}
			else
			{
//-- mod : return to profile link ----------------------------------------------
// here we added
//	<br />' . sprintf($lang['Profile_see'],  '<a href="' . append_sid('profile.'.$phpEx.'?mode=editprofile&u='.$userdata['user_id']) . '">', '</a>') . '<br />
//-- modify
				$message = $lang['Profile_updated'] . '<br /><br />' . sprintf($lang['Profile_see'],  '<a href="' . append_sid('profile.'.$phpEx . '?mode=editprofile&u=' . $userdata['user_id']) . '">', '</a>') . '<br /><br />' . sprintf($lang['Click_return_index'],  '<a href="' . append_sid('index.'.$phpEx) . '">', '</a>');
//-- fin mod : return to profile link ------------------------------------------
			}

			$template->assign_vars(array(
				'META' => '<meta http-equiv="refresh" content="5;url=' . append_sid('index.'.$phpEx) . '">')
			);

			message_die(GENERAL_MESSAGE, $message);
		}
		else
		{
			$sql = 'SELECT MAX(user_id) AS total
				FROM ' . USERS_TABLE;
			if ( !($result = $db->sql_query($sql)) )
			{
				message_die(GENERAL_ERROR, 'Could not obtain next user_id information', '', __LINE__, __FILE__, $sql);
			}

			if ( !($row = $db->sql_fetchrow($result)) )
			{
				message_die(GENERAL_ERROR, 'Could not obtain next user_id information', '', __LINE__, __FILE__, $sql);
			}
			$user_id = $row['total'] + 1;

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

			//
			// Get current date
			//

//-- mod : pastisd - signature editor ------------------------------------------
//-- delete
/*-MOD
			$sql = "INSERT INTO " . USERS_TABLE . "	(user_id, username, user_regdate, user_password, user_email, user_icq, user_website, user_occ, user_from, user_interests, user_sig, user_sig_bbcode_uid, user_avatar, user_avatar_type, user_viewemail, user_aim, user_yim, user_msnm, user_attachsig, user_allowsmile, user_allowhtml, user_allowbbcode, user_allow_viewonline, user_notify, user_notify_pm, user_popup_pm, user_timezone, user_dateformat, user_lang, user_style, user_level, user_allow_pm, user_active, user_actkey)
				VALUES ($user_id, '" . str_replace("\'", "''", $username) . "', " . time() . ", '" . str_replace("\'", "''", $new_password) . "', '" . str_replace("\'", "''", $email) . "', '" . str_replace("\'", "''", $icq) . "', '" . str_replace("\'", "''", $website) . "', '" . str_replace("\'", "''", $occupation) . "', '" . str_replace("\'", "''", $location) . "', '" . str_replace("\'", "''", $interests) . "', '" . str_replace("\'", "''", $signature) . "', '$signature_bbcode_uid', $avatar_sql, $viewemail, '" . str_replace("\'", "''", str_replace(' ', '+', $aim)) . "', '" . str_replace("\'", "''", $yim) . "', '" . str_replace("\'", "''", $msn) . "', $attachsig, $allowsmilies, $allowhtml, $allowbbcode, $allowviewonline, $notifyreply, $notifypm, $popup_pm, $user_timezone, '" . str_replace("\'", "''", $user_dateformat) . "', '" . str_replace("\'", "''", $user_lang) . "', $user_style, 0, 1, ";
MOD-*/
//-- add
// here we added
//	, user_qp_settings, user_skype, user_birthday, user_notify_donation, user_gender, user_postspp, user_topicspp, user_regip
//	, '" . $user_qp_settings . "', '" . str_replace("\'", "''", $skype) . "', '" . $user_birthday . "', " . $notifydonation . ", '" . $gender . "', '" . str_replace("\'", "''", $postsspp) . "', '" . str_replace("\'", "''", $topicspp) . "', '" . $userdata['session_ip'] . "'
//-- modify
			$sql = "INSERT INTO " . USERS_TABLE . "	(user_id, username, user_regdate, user_password, user_email, user_icq, user_website, user_occ, user_from, user_interests, user_qp_settings, user_skype, user_birthday, user_notify_donation, user_gender, user_postspp, user_topicspp, user_regip, user_sig, user_sig_bbcode_uid, user_avatar, user_avatar_type, user_viewemail, user_aim, user_yim, user_msnm, user_attachsig, user_allowsmile, user_allowhtml, user_allowbbcode, user_allow_viewonline, user_notify, user_notify_pm, user_popup_pm, user_timezone, user_dateformat, user_lang, user_style, user_level, user_allow_pm, user_active, user_actkey)
				VALUES ($user_id, '" . str_replace("\'", "''", $username) . "', " . time() . ", '" . str_replace("\'", "''", $new_password) . "', '" . str_replace("\'", "''", $email) . "', '" . str_replace("\'", "''", $icq) . "', '" . str_replace("\'", "''", $website) . "', '" . str_replace("\'", "''", $occupation) . "', '" . str_replace("\'", "''", $location) . "', '" . str_replace("\'", "''", $interests) . "', '" . $user_qp_settings . "', '" . str_replace("\'", "''", $skype) . "', '" . $user_birthday . "', " . $notifydonation . ", '" . $gender . "', '" . str_replace("\'", "''", $postsspp) . "', '" . str_replace("\'", "''", $topicspp) . "', '" . $userdata['session_ip'] . "', '" . str_replace("\'", "''", $signature) . "', '$signature_bbcode_uid', $avatar_sql, $viewemail, '" . str_replace("\'", "''", str_replace(' ', '+', $aim)) . "', '" . str_replace("\'", "''", $yim) . "', '" . str_replace("\'", "''", $msn) . "', $attachsig, $allowsmilies, $allowhtml, $allowbbcode, $allowviewonline, $notifyreply, $notifypm, $popup_pm, $user_timezone, '" . str_replace("\'", "''", $user_dateformat) . "', '" . str_replace("\'", "''", $user_lang) . "', $user_style, 0, 1, ";
//-- fin mod : pastisd - signature editor --------------------------------------

//-- mod : salt password -------------------------------------------------------
//-- add
			if ( $board_config['password_security_startdate'] )
			{
				$sql = str_replace(', ' . time() . '', ', ' . $regdate . '', $sql);
			}
//-- fin mod : salt password ---------------------------------------------------

//-- mod : the logger ----------------------------------------------------------
//-- add
			if( defined( 'LOG_MOD_INSTALLED' ) )
			{
				if( $log->config['log_user_register'] )
				{
					$log->insert( LOG_TYPE_USER, 'LOG_U_REGISTER', array( $username, $email ) );
				}
			}
//-- fin mod : the logger ------------------------------------------------------

			if ( $board_config['require_activation'] == USER_ACTIVATION_SELF || $board_config['require_activation'] == USER_ACTIVATION_ADMIN || $coppa )
			{
				$user_actkey = gen_rand_string(true);
				$key_len = 54 - (strlen($server_url));
				$key_len = ( $key_len > 6 ) ? $key_len : 6;
				$user_actkey = substr($user_actkey, 0, $key_len);
				$sql .= "0, '" . str_replace("\'", "''", $user_actkey) . "')";
			}
			else
			{
				$sql .= "1, '')";
			}

			if ( !($result = $db->sql_query($sql, BEGIN_TRANSACTION)) )
			{
				message_die(GENERAL_ERROR, 'Could not insert data into users table', '', __LINE__, __FILE__, $sql);
			}

			$sql = 'INSERT INTO ' . GROUPS_TABLE . " (group_name, group_description, group_single_user, group_moderator)
				VALUES ('', 'Personal User', 1, 0)";
			if ( !($result = $db->sql_query($sql)) )
			{
				message_die(GENERAL_ERROR, 'Could not insert data into groups table', '', __LINE__, __FILE__, $sql);
			}

			$group_id = $db->sql_nextid();

			$sql = 'INSERT INTO ' . USER_GROUP_TABLE . ' (user_id, group_id, user_pending)
				VALUES (' . $user_id . ', ' . $group_id . ', 0)';
			if( !($result = $db->sql_query($sql, END_TRANSACTION)) )
			{
				message_die(GENERAL_ERROR, 'Could not insert data into user_group table', '', __LINE__, __FILE__, $sql);
			}

			if ( $coppa )
			{
				$message = $lang['COPPA'];
				$email_template = 'coppa_welcome_inactive';
			}
			else if ( $board_config['require_activation'] == USER_ACTIVATION_SELF )
			{
				$message = $lang['Account_inactive'];
				$email_template = 'user_welcome_inactive';
			}
			else if ( $board_config['require_activation'] == USER_ACTIVATION_ADMIN )
			{
				$message = $lang['Account_inactive_admin'];
				$email_template = 'admin_welcome_inactive';
			}
			else
			{
				$message = $lang['Account_added'];
				$email_template = 'user_welcome';
			}

			include($phpbb_root_path . 'includes/emailer.'.$phpEx);

			$emailer = new emailer($board_config['smtp_delivery']);

			$emailer->from($board_config['board_email']);
			$emailer->replyto($board_config['board_email']);

			$emailer->use_template($email_template, stripslashes($user_lang));
			$emailer->email_address($email);
			$emailer->set_subject(sprintf($lang['Welcome_subject'], $board_config['sitename']));

			if( $coppa )
			{
				$emailer->assign_vars(array(
					'SITENAME' => $board_config['sitename'],
					'WELCOME_MSG' => sprintf($lang['Welcome_subject'], $board_config['sitename']),
					'USERNAME' => preg_replace($unhtml_specialchars_match, $unhtml_specialchars_replace, substr(str_replace("\'", "'", $username), 0, 25)),
					'PASSWORD' => $password_confirm,
					'EMAIL_SIG' => str_replace('<br />', "\n", "-- \n" . $board_config['board_email_sig']),

					'FAX_INFO' => $board_config['coppa_fax'],
					'MAIL_INFO' => $board_config['coppa_mail'],
					'EMAIL_ADDRESS' => $email,
					'ICQ' => $icq,
					'AIM' => $aim,
					'YIM' => $yim,
					'MSN' => $msn,

//-- mod : skype ---------------------------------------------------------------
//-- add
					'SKYPE' => $skype,
//-- fin mod : skype -----------------------------------------------------------

					'WEB_SITE' => $website,
					'FROM' => $location,
					'OCC' => $occupation,
					'INTERESTS' => $interests,
					'SITENAME' => $board_config['sitename']));
			}
			else
			{
				$emailer->assign_vars(array(
					'SITENAME' => $board_config['sitename'],
					'WELCOME_MSG' => sprintf($lang['Welcome_subject'], $board_config['sitename']),
					'USERNAME' => preg_replace($unhtml_specialchars_match, $unhtml_specialchars_replace, substr(str_replace("\'", "'", $username), 0, 25)),
					'PASSWORD' => $password_confirm,
					'EMAIL_SIG' => str_replace('<br />', "\n", "-- \n" . $board_config['board_email_sig']),

					'U_ACTIVATE' => $server_url . '?mode=activate&' . POST_USERS_URL . '=' . $user_id . '&act_key=' . $user_actkey)
				);
			}

			$emailer->send();
			$emailer->reset();

			if ( $board_config['require_activation'] == USER_ACTIVATION_ADMIN )
			{
				$sql = 'SELECT user_email, user_lang FROM ' . USERS_TABLE . ' WHERE user_level = ' . ADMIN;
				if ( !($result = $db->sql_query($sql)) )
				{
					message_die(GENERAL_ERROR, 'Could not select Administrators', '', __LINE__, __FILE__, $sql);
				}
				
				while ($row = $db->sql_fetchrow($result))
				{
					$emailer->from($board_config['board_email']);
					$emailer->replyto($board_config['board_email']);
					
					$emailer->email_address(trim($row['user_email']));
					$emailer->use_template('admin_activate', $row['user_lang']);
					$emailer->set_subject($lang['New_account_subject']);

					$emailer->assign_vars(array(
						'USERNAME' => preg_replace($unhtml_specialchars_match, $unhtml_specialchars_replace, substr(str_replace("\'", "'", $username), 0, 25)),
						'EMAIL_SIG' => str_replace('<br />', "\n", "-- \n" . $board_config['board_email_sig']),

						'U_ACTIVATE' => $server_url . '?mode=activate&' . POST_USERS_URL . '=' . $user_id . '&act_key=' . $user_actkey,
					));
					$emailer->send();
					$emailer->reset();
				}
				$db->sql_freeresult($result);
			}

			$message = $message . '<br /><br />' . sprintf($lang['Click_return_index'],  '<a href="' . append_sid('index.'.$phpEx) . '">', '</a>');

//-- mod : welcome private message ---------------------------------------------
//-- add
			{
				if($board_config['wpm_active'])
				{
					include($phpbb_root_path . 'includes/functions_wpm.' . $phpEx);

					$wpm_subject = str_replace('[username]', $username, $board_config['wpm_subject']);
					$wpm_subject = str_replace('[user_id]', $user_id, $wpm_subject);
					$wpm_subject = str_replace('[sitename]', $board_config['sitename'], $wpm_subject);

					wpm_send_pm($user_id, $wpm_subject, $wpm_message, 0);
				}
			}
//-- fin mod : welcome private message -----------------------------------------

			message_die(GENERAL_MESSAGE, $message);
		} // if mode == register
	}
} // End of submit


if ( $error )
{
	//
	// If an error occured we need to stripslashes on returned data
	//
	$username = stripslashes($username);
	$email = stripslashes($email);
	$cur_password = '';
	$new_password = '';
	$password_confirm = '';

	$icq = stripslashes($icq);
	$aim = str_replace('+', ' ', stripslashes($aim));
	$msn = stripslashes($msn);

//-- mod : skype ---------------------------------------------------------------
//-- add
	$skype = stripslashes($skype);
//-- fin mod : skype -----------------------------------------------------------

	$yim = stripslashes($yim);

	$website = stripslashes($website);
	$location = stripslashes($location);
	$occupation = stripslashes($occupation);
	$interests = stripslashes($interests);

//-- mod : users set posts & topics count --------------------------------------
//-- add
	$postspp = stripslashes($postspp);
	$topicspp = stripslashes($topicspp);
//-- fin mod : users set posts & topics count ----------------------------------

//-- mod : pastisd - signature editor ------------------------------------------
//-- delete
/*-MOD
	$signature = stripslashes($signature);
	$signature = ($signature_bbcode_uid != '') ? preg_replace("/:(([a-z0-9]+:)?)$signature_bbcode_uid(=|\])/si", '\\3', $signature) : $signature;
MOD-*/
//-- add
	$message = stripslashes($message);
	$message = ($message_bbcode_uid != '') ? preg_replace("/:(([a-z0-9]+:)?)$message_bbcode_uid(=|\])/si", '\\3', $message) : $message;
//-- fin mod : pastisd - signature editor --------------------------------------

	$user_lang = stripslashes($user_lang);
	$user_dateformat = stripslashes($user_dateformat);

}
else if ( $mode == 'editprofile' && !isset($HTTP_POST_VARS['avatargallery']) && !isset($HTTP_POST_VARS['submitavatar']) && !isset($HTTP_POST_VARS['cancelavatar']) )
{
	$user_id = $userdata['user_id'];
	$username = $userdata['username'];
	$email = $userdata['user_email'];
	$cur_password = '';
	$new_password = '';
	$password_confirm = '';

	$icq = $userdata['user_icq'];
	$aim = str_replace('+', ' ', $userdata['user_aim']);
	$msn = $userdata['user_msnm'];

//-- mod : skype ---------------------------------------------------------------
//-- add
	$skype = $userdata['user_skype'];
//-- fin mod : skype -----------------------------------------------------------

	$yim = $userdata['user_yim'];

	$website = $userdata['user_website'];
	$location = $userdata['user_from'];
	$occupation = $userdata['user_occ'];
	$interests = $userdata['user_interests'];

//-- mod : gender --------------------------------------------------------------
//-- add
	$gender = $userdata['user_gender'];
//-- fin mod : gender ----------------------------------------------------------

//-- mod : pastisd - signature editor ------------------------------------------
//-- delete
/*-MOD
	$signature_bbcode_uid = $userdata['user_sig_bbcode_uid'];
	$signature = ($signature_bbcode_uid != '') ? preg_replace("/:(([a-z0-9]+:)?)$signature_bbcode_uid(=|\])/si", '\\3', $userdata['user_sig']) : $userdata['user_sig'];
MOD-*/
//-- add
	$message_bbcode_uid = $userdata['user_sig_bbcode_uid'];
	$message = ($message_bbcode_uid != '') ? preg_replace("/:(([a-z0-9]+:)?)$message_bbcode_uid(=|\])/si", '\\3', $userdata['user_sig']) : $userdata['user_sig'];
//-- fin mod : pastisd - signature editor --------------------------------------

	$viewemail = $userdata['user_viewemail'];
	$notifypm = $userdata['user_notify_pm'];
	$popup_pm = $userdata['user_popup_pm'];

	$notifyreply = $userdata['user_notify'];

//-- mod : points system -------------------------------------------------------
//-- add
	$notifydonation = $userdata['user_notify_donation'];
//-- fin mod : points system ---------------------------------------------------

	$attachsig = $userdata['user_attachsig'];

//-- mod : birthday ------------------------------------------------------------
//-- add
	$bday_day = $bday_month = $bday_year = 0;
	if (!empty($userdata['user_birthday']))
	{
		list($bday_day, $bday_month, $bday_year) = explode('-', $userdata['user_birthday']);
	}
//-- fin mod : birthday --------------------------------------------------------

//-- mod : quick post es -------------------------------------------------------
//-- add
	$user_qp = $user_qp_show = $user_qp_subject = $user_qp_bbcode = $user_qp_smilies = $user_qp_more = 0;
	if (!empty($userdata['user_qp_settings']))
	{
		list($user_qp, $user_qp_show, $user_qp_subject, $user_qp_bbcode, $user_qp_smilies, $user_qp_more) = explode('-', $userdata['user_qp_settings']);
	}
//-- fin mod : quick post es ---------------------------------------------------

	$allowhtml = $userdata['user_allowhtml'];
	$allowbbcode = $userdata['user_allowbbcode'];
	$allowsmilies = $userdata['user_allowsmile'];

//-- mod : users set posts & topics count --------------------------------------
//-- add
	$postspp = $userdata['user_postspp'];
	$topicspp = $userdata['user_topicspp'];
//-- fin mod : users set posts & topics count ----------------------------------

	$allowviewonline = $userdata['user_allow_viewonline'];

	$user_avatar = ( $userdata['user_allowavatar'] ) ? $userdata['user_avatar'] : '';
	$user_avatar_type = ( $userdata['user_allowavatar'] ) ? $userdata['user_avatar_type'] : USER_AVATAR_NONE;

	$user_style = $userdata['user_style'];
	$user_lang = $userdata['user_lang'];
	$user_timezone = $userdata['user_timezone'];

	$user_dateformat = $userdata['user_dateformat'];
}

//
// Default pages
//
include($phpbb_root_path . 'includes/page_header.'.$phpEx);

//-- mod : pastisd - signature editor ------------------------------------------
//-- add
//-- mod : bbcode box reloaded -------------------------------------------------
//-- add
include($phpbb_root_path . 'includes/bbc_box_tags.'.$phpEx);
//-- fin mod : bbcode box reloaded ---------------------------------------------

if ( !isset($HTTP_POST_VARS['submit']) && !isset($HTTP_POST_VARS['avatargallery']) && !isset($HTTP_POST_VARS['submitavatar']) && !isset($HTTP_POST_VARS['cancelavatar']) && $mode == 'editprofile')
{
	include($phpbb_root_path . 'includes/functions_post.'.$phpEx);
}
generate_smilies('inline', PAGE_REGISTER);
//-- fin mod : pastisd - signature editor --------------------------------------

make_jumpbox('viewforum.'.$phpEx);

if ( $mode == 'editprofile' )
{
	if ( $user_id != $userdata['user_id'] )
	{
		$error = TRUE;
		$error_msg = $lang['Wrong_Profile'];
	}
}

if( isset($HTTP_POST_VARS['avatargallery']) && !$error )
{
	include($phpbb_root_path . 'includes/usercp_avatar.'.$phpEx);

	$avatar_category = ( !empty($HTTP_POST_VARS['avatarcategory']) ) ? htmlspecialchars($HTTP_POST_VARS['avatarcategory']) : '';

	$template->set_filenames(array(
		'body' => 'profile_avatar_gallery.tpl')
	);

	$allowviewonline = !$allowviewonline;

//-- mod : quick post es -------------------------------------------------------
//-- add
	$qp_data = array($user_qp, $user_qp_show, $user_qp_subject, $user_qp_bbcode, $user_qp_smilies, $user_qp_more);
	$user_qp_settings = implode('-', $qp_data);
// here we added
//	, $user_qp_settings
//-- modify
//-- mod : skype ---------------------------------------------------------------
// here we added
//	, $skype
//-- modify
//-- mod : birthday ------------------------------------------------------------
//-- add
	$bday_data = array($bday_day, $bday_month, $bday_year);
	$bday_date = implode('-', $bday_data);
// here we added
//	, $bday_date
//-- modify
//-- mod : gender --------------------------------------------------------------
// here we added
//	, $gender
//-- modify
//-- mod : users set posts & topics count --------------------------------------
// here we added
//	, $postspp, $topicspp
//-- modify
//-- mod : pastisd - signature editor ------------------------------------------
// here we replaced
//	$signature
//	by
//	$message
//-- modify
	display_avatar_gallery($mode, $avatar_category, $user_id, $email, $current_email, $coppa, $username, $email, $new_password, $cur_password, $password_confirm, $icq, $aim, $msn, $skype, $yim, $website, $location, $occupation, $interests, $bday_date, $message, $viewemail, $notifypm, $popup_pm, $notifyreply, $attachsig, $allowhtml, $allowbbcode, $allowsmilies, $postspp, $topicspp, $allowviewonline, $user_style, $user_lang, $user_timezone, $user_dateformat, $userdata['session_id'], $user_qp_settings, $gender);
//-- fin mod : pastisd - signature editor --------------------------------------
//-- fin mod : users set posts & topics count ----------------------------------
//-- fin mod : gender ----------------------------------------------------------
//-- fin mod : birthday --------------------------------------------------------
//-- fin mod : skype -----------------------------------------------------------
//-- fin mod : quick post es ---------------------------------------------------
}
else
{
	include($phpbb_root_path . 'includes/functions_selects.'.$phpEx);

	if ( !isset($coppa) )
	{
		$coppa = FALSE;
	}

	if ( !isset($user_style) )
	{
		$user_style = $board_config['default_style'];
	}

	$avatar_img = '';
	if ( $user_avatar_type )
	{
		switch( $user_avatar_type )
		{
//-- mod : resize avatars based on max width and heignt ------------------------
//-- delete
/*-MOD
			case USER_AVATAR_UPLOAD:
				$avatar_img = ( $board_config['allow_avatar_upload'] ) ? '<img src="' . $board_config['avatar_path'] . '/' . $user_avatar . '" alt="" />' : '';
				break;
			case USER_AVATAR_REMOTE:
				$avatar_img = ( $board_config['allow_avatar_remote'] ) ? '<img src="' . $user_avatar . '" alt="" />' : '';
				break;
			case USER_AVATAR_GALLERY:
				$avatar_img = ( $board_config['allow_avatar_local'] ) ? '<img src="' . $board_config['avatar_gallery_path'] . '/' . $user_avatar . '" alt="" />' : '';
				break;
MOD-*/
//-- add
			case USER_AVATAR_UPLOAD:
				$avatar_img = ( $board_config['allow_avatar_upload'] ) ? '<img onload="rmwa_img_loaded(this,' .  $board_config['avatar_max_width'] . ',' .  $board_config['avatar_max_height'] . ')"' . ' src="' . $board_config['avatar_path'] . '/' . $user_avatar . '" alt="" />' : '';
				break;
			case USER_AVATAR_REMOTE:
				$avatar_img = ( $board_config['allow_avatar_remote'] ) ? '<img onload="rmwa_img_loaded(this,' .  $board_config['avatar_max_width'] . ',' .  $board_config['avatar_max_height'] . ')"' . ' src="' . $user_avatar . '" alt="" />' : '';
				break;
			case USER_AVATAR_GALLERY:
				$avatar_img = ( $board_config['allow_avatar_local'] ) ? '<img onload="rmwa_img_loaded(this,' .  $board_config['avatar_max_width'] . ',' .  $board_config['avatar_max_height'] . ')"' . ' src="' . $board_config['avatar_gallery_path'] . '/' . $user_avatar . '" alt="" />' : '';
				break;
//-- fin mod : resize avatars based on max width and heignt --------------------
		}
	}



	$s_hidden_fields = '<input type="hidden" name="mode" value="' . $mode . '" /><input type="hidden" name="agreed" value="true" /><input type="hidden" name="coppa" value="' . $coppa . '" />';
	$s_hidden_fields .= '<input type="hidden" name="sid" value="' . $userdata['session_id'] . '" />';

//-- mod : vAgreement terms ----------------------------------------------------
//-- add
	$s_hidden_fields .= '<input type="hidden" name="not_agreed" value="false" />';
//-- fin mod : vAgreement terms ------------------------------------------------

	if( $mode == 'editprofile' )
	{
		$s_hidden_fields .= '<input type="hidden" name="user_id" value="' . $userdata['user_id'] . '" />';
		//
		// Send the users current email address. If they change it, and account activation is turned on
		// the user account will be disabled and the user will have to reactivate their account.
		//
		$s_hidden_fields .= '<input type="hidden" name="current_email" value="' . $userdata['user_email'] . '" />';
	}

	if ( !empty($user_avatar_local) )
	{
		$s_hidden_fields .= '<input type="hidden" name="avatarlocal" value="' . $user_avatar_local . '" /><input type="hidden" name="avatarcatname" value="' . $user_avatar_category . '" />';
	}

	$html_status =  ( $userdata['user_allowhtml'] && $board_config['allow_html'] ) ? $lang['HTML_is_ON'] : $lang['HTML_is_OFF'];
	$bbcode_status = ( $userdata['user_allowbbcode'] && $board_config['allow_bbcode'] ) ? $lang['BBCode_is_ON'] : $lang['BBCode_is_OFF'];
	$smilies_status = ( $userdata['user_allowsmile'] && $board_config['allow_smilies'] ) ? $lang['Smilies_are_ON'] : $lang['Smilies_are_OFF'];

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

	if ( $error )
	{
		$template->set_filenames(array('reg_header' => 'error_body.tpl'));
		$template->assign_vars(array('ERROR_MESSAGE' => $error_msg));
		$template->assign_var_from_handle('ERROR_BOX', 'reg_header');
	}

	$template->set_filenames(array('body' => 'profile_add_body.tpl'));

//-- mod : disallow mail and password changes ----------------------------------
//-- delete
/*-MOD
	if ( $mode == 'editprofile' )
	{
		$template->assign_block_vars('switch_edit_profile', array());
	}
MOD-*/
//-- fin mod : disallow mail and password changes ------------------------------

//-- mod : allow single namechange ---------------------------------------------
//-- delete
/*-MOD
	if ( ($mode == 'register') || ($board_config['allow_namechange']) )
MOD-*/
//-- add
	$sql = 'SELECT user_namechange FROM ' . USERS_TABLE . ' WHERE user_id = ' . $userdata['user_id'];
//-- mod : disallow mail and password changes ----------------------------------
//-- add
	$sql = str_replace('SELECT ', 'SELECT user_mailchange, user_passwordchange, ', $sql);
//-- fin mod : disallow mail and password changes ------------------------------
	if( !($result = $db->sql_query($sql)) )
	{
		message_die(GENERAL_ERROR, 'Could not query user data', '', __LINE__, __FILE__, $sql);
	}
	$row = $db->sql_fetchrow($result);
	$namechange = $row['user_namechange'];

//-- mod : disallow mail and password changes ----------------------------------
//-- add
	$mailchange = $row['user_mailchange'];
	$passwordchange = $row['user_passwordchange'];
//-- fin mod : disallow mail and password changes ------------------------------

	if ( ($mode == 'register') || ($board_config['allow_namechange'] && $namechange) )
//-- fin mod : allow single namechange -----------------------------------------
	{
		$template->assign_block_vars('switch_namechange_allowed', array());
	}
	else
	{
		$template->assign_block_vars('switch_namechange_disallowed', array());
	}

//-- mod : disallow mail and password changes ----------------------------------
//-- add
	if ( ($mode == 'register') || $mailchange )
	{
		$template->assign_block_vars('switch_mailchange_allowed', array());
		if ( $mode == 'editprofile' )
		{
			$template->assign_block_vars('switch_edit_profile', array());
		}
	}
	else
	{
		$template->assign_block_vars('switch_mailchange_disallowed', array());
	}

	if ( ($mode == 'register') || $passwordchange )
	{
		$template->assign_block_vars('switch_passwordchange_allowed', array());
		if ( $mode == 'editprofile' )
		{
			$template->assign_block_vars('switch_edit_profile', array());
		}
	}
	else
	{
		$template->assign_block_vars('switch_passwordchange_disallowed', array());
	}
//-- fin mod : disallow mail and password changes ------------------------------

	// Visual Confirmation
	$confirm_image = '';
	if (!empty($board_config['enable_confirm']) && $mode == 'register')
	{
		$sql = 'SELECT session_id 
			FROM ' . SESSIONS_TABLE; 
		if (!($result = $db->sql_query($sql)))
		{
			message_die(GENERAL_ERROR, 'Could not select session data', '', __LINE__, __FILE__, $sql);
		}

		if ($row = $db->sql_fetchrow($result))
		{
			$confirm_sql = '';
			do
			{
				$confirm_sql .= (($confirm_sql != '') ? ', ' : '') . "'" . $row['session_id'] . "'";
			}
			while ($row = $db->sql_fetchrow($result));
		
			$sql = 'DELETE FROM ' .  CONFIRM_TABLE . " 
				WHERE session_id NOT IN ($confirm_sql)";
			if (!$db->sql_query($sql))
			{
				message_die(GENERAL_ERROR, 'Could not delete stale confirm data', '', __LINE__, __FILE__, $sql);
			}
		}
		$db->sql_freeresult($result);

		$sql = 'SELECT COUNT(session_id) AS attempts 
			FROM ' . CONFIRM_TABLE . " 
			WHERE session_id = '" . $userdata['session_id'] . "'";
		if (!($result = $db->sql_query($sql)))
		{
			message_die(GENERAL_ERROR, 'Could not obtain confirm code count', '', __LINE__, __FILE__, $sql);
		}

		if ($row = $db->sql_fetchrow($result))
		{
			if ($row['attempts'] > 3)
			{
				message_die(GENERAL_MESSAGE, $lang['Too_many_registers']);
			}
		}
		$db->sql_freeresult($result);
		
		// Generate the required confirmation code
		// NB 0 (zero) could get confused with O (the letter) so we make change it
		$code = dss_rand();
		$code = substr(str_replace('0', 'Z', strtoupper(base_convert($code, 16, 35))), 2, 6);

		$confirm_id = md5(uniqid($user_ip));

		$sql = 'INSERT INTO ' . CONFIRM_TABLE . " (confirm_id, session_id, code) 
			VALUES ('$confirm_id', '". $userdata['session_id'] . "', '$code')";
		if (!$db->sql_query($sql))
		{
			message_die(GENERAL_ERROR, 'Could not insert new confirm code information', '', __LINE__, __FILE__, $sql);
		}

		unset($code);
		
		$confirm_image = '<img src="' . append_sid("profile.$phpEx?mode=confirm&amp;id=$confirm_id") . '" alt="" title="" />';
		$s_hidden_fields .= '<input type="hidden" name="confirm_id" value="' . $confirm_id . '" />';

		$template->assign_block_vars('switch_confirm', array());
	}

	//
	// Let's do an overall check for settings/versions which would prevent
	// us from doing file uploads....
	//
	$ini_val = ( phpversion() >= '4.0.0' ) ? 'ini_get' : 'get_cfg_var';
	$form_enctype = ( @$ini_val('file_uploads') == '0' || strtolower(@$ini_val('file_uploads') == 'off') || phpversion() == '4.0.4pl1' || !$board_config['allow_avatar_upload'] || ( phpversion() < '4.0.3' && @$ini_val('open_basedir') != '' ) ) ? '' : 'enctype="multipart/form-data"';

	$template->assign_vars(array(
		'USERNAME' => isset($username) ? $username : '',
		'CUR_PASSWORD' => isset($cur_password) ? $cur_password : '',
		'NEW_PASSWORD' => isset($new_password) ? $new_password : '',
		'PASSWORD_CONFIRM' => isset($password_confirm) ? $password_confirm : '',
		'EMAIL' => isset($email) ? $email : '',
		'CONFIRM_IMG' => $confirm_image, 

		'YIM' => $yim,
		'ICQ' => $icq,
		'MSN' => $msn,

//-- mod : skype ---------------------------------------------------------------
//-- add
		'SKYPE' => $skype,
//-- fin mod : skype -----------------------------------------------------------

		'AIM' => $aim,
		'OCCUPATION' => $occupation,
		'INTERESTS' => $interests,
		'LOCATION' => $location,
		'WEBSITE' => $website,
//-- mod : pastisd - signature editor ------------------------------------------
//-- delete
/*-MOD
		'SIGNATURE' => str_replace('<br />', "\n", $signature),
MOD-*/
//-- add
		'SIGNATURE' => str_replace('<br />', "\n", $message),
//-- fin mod : pastisd - signature editor --------------------------------------

//-- mod : gender --------------------------------------------------------------
//-- add
		'LOCK_GENDER' => ($mode != 'register') ? 'DISABLED' : '',
		'GENDER' => $gender,
		'GENDER_REQUIRED' => ($board_config['gender_required']) ? ' *' : '',
		'GENDER_NO_SPECIFY_CHECKED' => $gender_no_specify_checked,
		'GENDER_MALE_CHECKED' => $gender_male_checked,
		'GENDER_FEMALE_CHECKED' => $gender_female_checked,

		'L_GENDER' => $lang['Gender'],
		'L_GENDER_MALE' => $lang['Male'],
		'L_GENDER_FEMALE' => $lang['Female'],
		'L_GENDER_NOT_SPECIFY' => $lang['No_gender_specify'],
//-- fin mod : gender ----------------------------------------------------------

		'VIEW_EMAIL_YES' => ( $viewemail ) ? 'checked="checked"' : '',
		'VIEW_EMAIL_NO' => ( !$viewemail ) ? 'checked="checked"' : '',
		'HIDE_USER_YES' => ( !$allowviewonline ) ? 'checked="checked"' : '',
		'HIDE_USER_NO' => ( $allowviewonline ) ? 'checked="checked"' : '',
		'NOTIFY_PM_YES' => ( $notifypm ) ? 'checked="checked"' : '',
		'NOTIFY_PM_NO' => ( !$notifypm ) ? 'checked="checked"' : '',
		'POPUP_PM_YES' => ( $popup_pm ) ? 'checked="checked"' : '',
		'POPUP_PM_NO' => ( !$popup_pm ) ? 'checked="checked"' : '',

		'ALWAYS_ADD_SIGNATURE_YES' => ( $attachsig ) ? 'checked="checked"' : '',
		'ALWAYS_ADD_SIGNATURE_NO' => ( !$attachsig ) ? 'checked="checked"' : '',
		'NOTIFY_REPLY_YES' => ( $notifyreply ) ? 'checked="checked"' : '',
		'NOTIFY_REPLY_NO' => ( !$notifyreply ) ? 'checked="checked"' : '',

//-- mod : points system -------------------------------------------------------
//-- add
		'NOTIFY_DONATION_YES' => ( $notifydonation ) ? 'checked="checked"' : '',
		'NOTIFY_DONATION_NO' => ( !$notifydonation ) ? 'checked="checked"' : '',
//-- fin mod : points system ---------------------------------------------------

		'ALWAYS_ALLOW_BBCODE_YES' => ( $allowbbcode ) ? 'checked="checked"' : '',
		'ALWAYS_ALLOW_BBCODE_NO' => ( !$allowbbcode ) ? 'checked="checked"' : '',
		'ALWAYS_ALLOW_HTML_YES' => ( $allowhtml ) ? 'checked="checked"' : '',
		'ALWAYS_ALLOW_HTML_NO' => ( !$allowhtml ) ? 'checked="checked"' : '',
		'ALWAYS_ALLOW_SMILIES_YES' => ( $allowsmilies ) ? 'checked="checked"' : '',
		'ALWAYS_ALLOW_SMILIES_NO' => ( !$allowsmilies ) ? 'checked="checked"' : '',

//-- mod : users set posts & topics count --------------------------------------
//-- add
		'POSTS_PER_PAGE' => $postspp,
		'TOPICS_PER_PAGE' => $topicspp,
//-- fin mod : users set posts & topics count ----------------------------------

		'ALLOW_AVATAR' => $board_config['allow_avatar_upload'],
		'AVATAR' => $avatar_img,
		'AVATAR_SIZE' => $board_config['avatar_filesize'],
		'LANGUAGE_SELECT' => language_select($user_lang, 'language'),
		'STYLE_SELECT' => style_select($user_style, 'style'),
		'TIMEZONE_SELECT' => tz_select($user_timezone, 'timezone'),
		'DATE_FORMAT' => $user_dateformat,
		'HTML_STATUS' => $html_status,
		'BBCODE_STATUS' => sprintf($bbcode_status, '<a href="' . append_sid('faq.'.$phpEx . '?mode=bbcode') . '" target="_phpbbcode">', '</a>'),
		'SMILIES_STATUS' => $smilies_status,

		'L_CURRENT_PASSWORD' => $lang['Current_password'],
		'L_NEW_PASSWORD' => ( $mode == 'register' ) ? $lang['Password'] : $lang['New_password'],
		'L_CONFIRM_PASSWORD' => $lang['Confirm_password'],
		'L_CONFIRM_PASSWORD_EXPLAIN' => ( $mode == 'editprofile' ) ? $lang['Confirm_password_explain'] : '',
		'L_PASSWORD_IF_CHANGED' => ( $mode == 'editprofile' ) ? $lang['password_if_changed'] : '',
		'L_PASSWORD_CONFIRM_IF_CHANGED' => ( $mode == 'editprofile' ) ? $lang['password_confirm_if_changed'] : '',
		'L_SUBMIT' => $lang['Submit'],
		'L_RESET' => $lang['Reset'],

//-- mod : pastisd - signature editor ------------------------------------------
//-- add
		'STYLE_DYSPLAY_REG' => '',
		'STYLE_DYSPLAY_SIG' => $style_display_tpl,
		'STYLE_ROW_REG' => $style_row_actif,
		'STYLE_ROW_SIG' => $style_row_non_actif,
		'STYLE_FONT_ACTIF_REG' => $style_font_actif,
		'STYLE_FONT_ACTIF_SIG' => '',
//-- fin mod : pastisd - signature editor --------------------------------------

//-- mod : configure member profile required fields ----------------------------
//-- delete
/*-MOD
		'L_ICQ_NUMBER' => $lang['ICQ'],
		'L_MESSENGER' => $lang['MSNM'],

//-- mod : skype ---------------------------------------------------------------
//-- add
		'L_SKYPE' => $lang['SKYPE'],
//-- fin mod : skype -----------------------------------------------------------

		'L_YAHOO' => $lang['YIM'],
		'L_WEBSITE' => $lang['Website'],
		'L_AIM' => $lang['AIM'],
		'L_LOCATION' => $lang['Location'],
		'L_OCCUPATION' => $lang['Occupation'],
MOD-*/
//-- add
		'L_ICQ_NUMBER' => ($board_config['required_icq']) ? $lang['ICQ'] . ' * ' : $lang['ICQ'],
		'L_MESSENGER' => ($board_config['required_msnm']) ? $lang['MSNM'] . ' * ' : $lang['MSNM'],

//-- mod : skype ---------------------------------------------------------------
//-- add
		'L_SKYPE' => ($board_config['required_skype']) ? $lang['SKYPE'] . ' * ' : $lang['SKYPE'],
//-- fin mod : skype -----------------------------------------------------------

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

//-- mod : disallow mail and password changes ----------------------------------
//-- add
		'L_EMAIL_EXPLAIN' => $lang['mail_explain'],
		'L_PASSWORD_EXPLAIN' => $lang['password_explain'],
//-- fin mod : disallow mail and password changes ------------------------------

		'L_ALWAYS_ALLOW_SMILIES' => $lang['Always_smile'],

//-- mod : users set posts & topics count --------------------------------------
//-- add

//-- mod : configure member profile required fields ----------------------------
//-- delete
/*-MOD
		'L_POSTS_PER_PAGE' => $lang['Posts_per_page'],
		'L_TOPICS_PER_PAGE' => $lang['Topics_per_page'],
MOD-*/
//-- add
		'L_POSTS_PER_PAGE' => ($board_config['required_posts_per_page']) ? $lang['Posts_per_page'] . ' * ' : $lang['Posts_per_page'],
		'L_TOPICS_PER_PAGE' => ($board_config['required_topics_per_page']) ? $lang['Topics_per_page'] . ' * ' : $lang['Topics_per_page'],
//-- fin mod : configure member profile required fields ------------------------

		'L_TOPICS_PER_PAGE_EXPLAIN' => $lang['Topics_per_page_explain'],
		'L_POSTS_PER_PAGE_EXPLAIN' => $lang['Posts_per_page_explain'],
//-- fin mod : users set posts & topics count ----------------------------------

		'L_ALWAYS_ALLOW_BBCODE' => $lang['Always_bbcode'],
		'L_ALWAYS_ALLOW_HTML' => $lang['Always_html'],
		'L_HIDE_USER' => $lang['Hide_user'],
		'L_ALWAYS_ADD_SIGNATURE' => $lang['Always_add_sig'],

//-- mod : account self-delete -------------------------------------------------
//-- add
		'L_ACCOUNT_DELETE' => $lang['Account_delete'],
		'L_DELETE_ACCOUNT_EXPLAIN' => $lang['Account_delete_explain'],
//-- fin mod : account self-delete ---------------------------------------------

		'L_AVATAR_PANEL' => $lang['Avatar_panel'],
		'L_AVATAR_EXPLAIN' => sprintf($lang['Avatar_explain'], $board_config['avatar_max_width'], $board_config['avatar_max_height'], (round($board_config['avatar_filesize'] / 1024))),
		'L_UPLOAD_AVATAR_FILE' => $lang['Upload_Avatar_file'],
		'L_UPLOAD_AVATAR_URL' => $lang['Upload_Avatar_URL'],
		'L_UPLOAD_AVATAR_URL_EXPLAIN' => $lang['Upload_Avatar_URL_explain'],
		'L_AVATAR_GALLERY' => $lang['Select_from_gallery'],
		'L_SHOW_GALLERY' => $lang['View_avatar_gallery'],
		'L_LINK_REMOTE_AVATAR' => $lang['Link_remote_Avatar'],
		'L_LINK_REMOTE_AVATAR_EXPLAIN' => $lang['Link_remote_Avatar_explain'],
		'L_DELETE_AVATAR' => $lang['Delete_Image'],
		'L_CURRENT_IMAGE' => $lang['Current_Image'],

//-- mod : configure member profile required fields ----------------------------
//-- delete
/*-MOD
		'L_SIGNATURE' => $lang['Signature'],
MOD-*/
//-- add
		'L_SIGNATURE' => ($board_config['required_signature']) ? $lang['Signature'] . ' * ' : $lang['Signature'],
//-- fin mod : configure member profile required fields ------------------------

		'L_SIGNATURE_EXPLAIN' => sprintf($lang['Signature_explain'], $board_config['max_sig_chars']),

//-- mod : quick post es -------------------------------------------------------
//-- add
		'L_QP_SETTINGS' => $lang['qp_settings'],
//-- fin mod : quick post es ---------------------------------------------------

		'L_NOTIFY_ON_REPLY' => $lang['Always_notify'],
		'L_NOTIFY_ON_REPLY_EXPLAIN' => $lang['Always_notify_explain'],
		'L_NOTIFY_ON_PRIVMSG' => $lang['Notify_on_privmsg'],
		'L_POPUP_ON_PRIVMSG' => $lang['Popup_on_privmsg'],
		'L_POPUP_ON_PRIVMSG_EXPLAIN' => $lang['Popup_on_privmsg_explain'],

		'L_PREFERENCES' => $lang['Preferences'],
		'L_PUBLIC_VIEW_EMAIL' => $lang['Public_view_email'],
		'L_ITEMS_REQUIRED' => $lang['Items_required'],
		'L_REGISTRATION_INFO' => $lang['Registration_info'],
		'L_PROFILE_INFO' => $lang['Profile_info'],
		'L_PROFILE_INFO_NOTICE' => $lang['Profile_info_warn'],
		'L_EMAIL_ADDRESS' => $lang['Email_address'],

//-- mod : points system -------------------------------------------------------
//-- add
		'L_NOTIFY_DONATION' => sprintf($lang['Points_notify'], $board_config['points_name']),
		'L_NOTIFY_DONATION_EXPLAIN' => sprintf($lang['Points_notify_explain'], $board_config['points_name']),
//-- fin mod : points system ---------------------------------------------------

		'L_CONFIRM_CODE_IMPAIRED'	=> sprintf($lang['Confirm_code_impaired'], '<a href="mailto:' . $board_config['board_email'] . '">', '</a>'), 
		'L_CONFIRM_CODE'			=> $lang['Confirm_code'], 
		'L_CONFIRM_CODE_EXPLAIN'	=> $lang['Confirm_code_explain'], 

		'S_ALLOW_AVATAR_UPLOAD' => $board_config['allow_avatar_upload'],
		'S_ALLOW_AVATAR_LOCAL' => $board_config['allow_avatar_local'],
		'S_ALLOW_AVATAR_REMOTE' => $board_config['allow_avatar_remote'],
		'S_HIDDEN_FIELDS' => $s_hidden_fields,
		'S_FORM_ENCTYPE' => $form_enctype,
		'S_PROFILE_ACTION' => append_sid('profile.' . $phpEx),
	));
//-- mod : date format evolved -------------------------------------------------
//-- add
	dateformat_select($user_dateformat);
//-- fin mod : date format evolved ---------------------------------------------

//-- mod : pastisd - signature editor ------------------------------------------
//-- add
	if( $preview )
	{
		include($phpbb_root_path . 'includes/bbcode.'.$phpEx);
		$preview_signature = ( !empty($HTTP_POST_VARS['message']) ) ? $HTTP_POST_VARS['message'] : '';

		$message = $preview_signature;
		if ($message || $message != '')
		{
			$html_on = !$board_config['allow_html'] ? 0 : 1;
			$bbcode_on = !$board_config['allow_bbcode'] ? 0 : 1;
			$smilies_on = !$board_config['allow_smilies'] ? 0 : 1;

			$orig_word = array();
			$replacement_word = array();
			obtain_word_list($orig_word, $replacement_word);

			if ($userdata['session_logged_in'])
			{
				$message_bbcode_uid = ( $allowbbcode ) ? make_bbcode_uid() : '';
			}
			else
			{
				$message_bbcode_uid = $userdata['user_sig_bbcode_uid'];
			}

			if (!$board_config['allow_html'])
			{
				$preview_signature = preg_replace('#(<)([\/]?.*?)(>)#is', "&lt;\\2&gt;", $preview_signature);
			}

			$preview_signature = stripslashes($preview_signature);
			$message = $preview_signature;

			if ( $board_config['allow_smilies'])
			{
				$preview_signature = smilies_pass($preview_signature);
			}

			$preview_signature = stripslashes($preview_signature);
			$preview_signature = preg_replace($orig_word, $replacement_word, $preview_signature);
			$preview_signature = str_replace("\n", "\n<br />\n", $preview_signature);

			if ($board_config['allow_bbcode'])
			{
				$preview_signature = bbencode_first_pass($preview_signature, $message_bbcode_uid);
				$preview_signature = bbencode_second_pass($preview_signature, $message_bbcode_uid);
			}
			else
			{
				$preview_signature = preg_replace("/\:$message_bbcode_uid/si", '', $preview_signature);
			}
		}

		$template->set_filenames(array('preview' => 'sig_preview.tpl'));

		$template->assign_vars(array(
			'PREVIEW_SIGNATURE' => $preview_signature,
			'SIGNATURE' => $message,
			'STYLE_DYSPLAY_REG' => $style_display_tpl,
			'STYLE_DYSPLAY_SIG' => '',
			'STYLE_ROW_REG' => $style_row_non_actif,
			'STYLE_ROW_SIG' => $style_row_actif,
			'STYLE_FONT_ACTIF_REG' => '',
			'STYLE_FONT_ACTIF_SIG' => $style_font_actif,)
		);

		$template->assign_var_from_handle('SIG_PREVIEW_BOX', 'preview');
	}
//-- fin mod : pastisd - signature editor --------------------------------------

//-- mod : birthday ------------------------------------------------------------
//-- add
	$bdays->select_birthdate();
//-- fin mod : birthday --------------------------------------------------------

//-- mod : quick post es -------------------------------------------------------
//-- add
	display_qpes_data();
//-- fin mod : quick post es ---------------------------------------------------

	//
	// This is another cheat using the block_var capability
	// of the templates to 'fake' an IF...ELSE...ENDIF solution
	// it works well :)
	//
	if ( $mode != 'register' )
	{
//-- mod : account self-delete -------------------------------------------------
//-- add
		if( $userdata['user_account_delete'] )
		{
			$template->assign_block_vars('account_delete_block', array() );
		}
//-- fin mod : account self-delete ---------------------------------------------

		if ( $userdata['user_allowavatar'] && ( $board_config['allow_avatar_upload'] || $board_config['allow_avatar_local'] || $board_config['allow_avatar_remote'] ) )
		{
			$template->assign_block_vars('switch_avatar_block', array() );

			if ( $board_config['allow_avatar_upload'] && file_exists(@phpbb_realpath('./' . $board_config['avatar_path'])) )
			{
				if ( $form_enctype != '' )
				{
					$template->assign_block_vars('switch_avatar_block.switch_avatar_local_upload', array() );
				}
				$template->assign_block_vars('switch_avatar_block.switch_avatar_remote_upload', array() );
			}

			if ( $board_config['allow_avatar_remote'] )
			{
				$template->assign_block_vars('switch_avatar_block.switch_avatar_remote_link', array() );
			}

			if ( $board_config['allow_avatar_local'] && file_exists(@phpbb_realpath('./' . $board_config['avatar_gallery_path'])) )
			{
				$template->assign_block_vars('switch_avatar_block.switch_avatar_local_gallery', array() );
			}
		}
	}

//-- mod : hide profile options ------------------------------------------------
//-- add

	/*
	* Profile options
	*/
	if( !$board_config['override_icq'] )
	{
		$template->assign_block_vars('override_icq_block', array() );
	}

	if( !$board_config['override_aim'] )
	{
		$template->assign_block_vars('override_aim_block', array() );
	}

	if( !$board_config['override_msn'] )
	{
		$template->assign_block_vars('override_msn_block', array() );
	}

	if( !$board_config['override_skype'] )
	{
		$template->assign_block_vars('override_skype_block', array() );
	}

	if( !$board_config['override_yahoo'] )
	{
		$template->assign_block_vars('override_yahoo_block', array() );
	}

	if( !$board_config['override_website'] )
	{
		$template->assign_block_vars('override_website_block', array() );
	}

	if( !$board_config['override_location'] )
	{
		$template->assign_block_vars('override_location_block', array() );
	}

	if( !$board_config['override_occupation'] )
	{
		$template->assign_block_vars('override_occupation_block', array() );
	}

	if( !$board_config['override_interests'] )
	{
		$template->assign_block_vars('override_interests_block', array() );
	}

	if( !$board_config['override_birthday'] )
	{
		$template->assign_block_vars('override_birthday_block', array() );
	}

	if( !$board_config['override_gender'] )
	{
		$template->assign_block_vars('override_gender_block', array() );
	}

	/*
	* Signature Editor
	*/
	if( !$board_config['override_signature'] )
	{
		$template->assign_block_vars('override_signature_block', array() );
	}

	/*
	* Quick Post ES
	*/
	if( !$board_config['override_quick_post'] )
	{
		$template->assign_block_vars('override_quick_post_block', array() );
	}

	/*
	* Preferences
	*/
	if( !$board_config['override_public_view_mail'] )
	{
		$template->assign_block_vars('override_public_view_mail_block', array() );
	}

	if( !$board_config['override_hide_online'] )
	{
		$template->assign_block_vars('override_hide_online_block', array() );
	}

	if( !$board_config['override_notify_on_reply'] )
	{
		$template->assign_block_vars('override_notify_on_reply_block', array() );
	}

	if( !$board_config['override_notify_pm'] )
	{
		$template->assign_block_vars('override_notify_pm_block', array() );
	}

	if( !$board_config['override_popup_pm'] )
	{
		$template->assign_block_vars('override_popup_pm_block', array() );
	}

	if( !$board_config['override_notify_on_donation'] )
	{
		$template->assign_block_vars('override_notify_on_donation_block', array() );
	}

	if( !$board_config['override_always_add_signature'] )
	{
		$template->assign_block_vars('override_always_add_signature_block', array() );
	}

	if( !$board_config['override_bbcode'] )
	{
		$template->assign_block_vars('override_bbcode_block', array() );
	}

	if( !$board_config['override_html'] )
	{
		$template->assign_block_vars('override_html_block', array() );
	}

	if( !$board_config['override_smilies'] )
	{
		$template->assign_block_vars('override_smilies_block', array() );
	}

	if( !$board_config['override_language'] )
	{
		$template->assign_block_vars('override_language_block', array() );
	}

	if( !$board_config['override_board_style'] )
	{
		$template->assign_block_vars('override_board_style_block', array() );
	}

	if( !$board_config['override_time_mode'] )
	{
		$template->assign_block_vars('override_time_mode_block', array() );
	}

	if( !$board_config['override_date_format'] )
	{
		$template->assign_block_vars('override_date_format_block', array() );
	}

	if( !$board_config['override_posts_per_page'] )
	{
		$template->assign_block_vars('override_posts_per_page_block', array() );
	}

	if( !$board_config['override_topics_per_page'] )
	{
		$template->assign_block_vars('override_topics_per_page_block', array() );
	}
//-- fin mod : hide profile options --------------------------------------------

}

$template->pparse('body');

include($phpbb_root_path . 'includes/page_tail.'.$phpEx);

?>
