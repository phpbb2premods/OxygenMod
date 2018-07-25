<?php 
define('IN_PHPBB', true); 
$phpbb_root_path = './'; 
include($phpbb_root_path . 'extension.inc'); 
include($phpbb_root_path . 'common.'.$phpEx); 

$userdata = session_pagestart($user_ip, PAGE_INDEX); 
init_userprefs($userdata); 

$mode = $_GET['mode'];
$user = intval($_GET['user']);
$redirect = ( !empty($_GET['redirect']) ) ? $_GET['redirect'] : 'profile.'.$phpEx.'?mode=viewprofile&u='.$user;
if( $redirect != 'profile.'.$phpEx.'?mode=viewprofile&u='.$user )
{
	$redirecter = $redirect;
	$redirecter = str_replace('viewtopic.'.$phpEx.'?p=', '', $redirecter);
	
	$redirecter = "#".$redirecter;
}	

if( $userdata['user_level'] == ADMIN or $userdata['user_level'] == MOD )
{
	$sql = "SELECT u.user_warn, u.user_id, u.user_level FROM ".USERS_TABLE." u WHERE u.user_id = '$user' LIMIT 1";
	if( !( $result = $db->sql_query($sql) ))
	{
		message_die(GENERAL_ERROR, 'Could not read user warns', '', __LINE__, __FILE__, $sql);
	}
	$row = $db->sql_fetchrow($result);	
	
	if( $mode == 'warn' )
	{
		if( $row['user_warn'] + 1 == $board_config['card_max'] )
		{
			$mode = 'ban';
		}
		
		if( $mode == 'warn' )
		{
			$sql = "UPDATE ".USERS_TABLE." SET user_warn = user_warn + 1 WHERE user_id = '$user'";
			if( !( $result = $db->sql_query($sql) ))
			{
				message_die(GENERAL_ERROR, 'Could not warn user', '', __LINE__, __FILE__, $sql);
			}
		}
	}
	if( $mode == 'ban' )
	{
		$sql = "UPDATE ".USERS_TABLE." SET user_warn = '".$board_config['card_max']."', user_active = 0 WHERE user_id = '$user'";
		if( !( $result = $db->sql_query($sql) ))
		{
			message_die(GENERAL_ERROR, 'Could not ban user', '', __LINE__, __FILE__, $sql);
		}
		$sql = "INSERT INTO ". BANLIST_TABLE ." (ban_userid) VALUES ($user)";		
		if( !( $result = $db->sql_query($sql) ))
		{
			message_die(GENERAL_ERROR, 'Could not ban user', '', __LINE__, __FILE__, $sql);
		}
		
		// Destroy session
		$sql = "DELETE FROM ".SESSIONS_TABLE." WHERE session_user_id = '$user'";
		if( !$db->sql_query($sql) )
		{
			message_die(GENERAL_ERROR, 'Could not delete session', '', __LINE__, __FILE__, $sql);
		}	
	}
	if( $mode == 'green' )
	{
		$sql = "UPDATE ".USERS_TABLE." SET user_warn = 0, user_active = 1 WHERE user_id = $user";
		if( !( $result = $db->sql_query($sql) ))
		{
			message_die(GENERAL_ERROR, 'Could not unwarn user', '', __LINE__, __FILE__, $sql);
		}	
		
		$sql = "DELETE FROM ".BANLIST_TABLE." WHERE ban_userid = $user";
		if( !( $result = $db->sql_query($sql) ))
		{
			message_die(GENERAL_ERROR, 'Could not unwarn user', '', __LINE__, __FILE__, $sql);
		}
	}		
	
	$meta = append_sid($redirect).$redirecter;
	header("HTTP/1.1 301 Moved Permanently");
	header("Location: $meta");
	die('<html><head><title>Forward</title><meta http-equiv="refresh" content="0; url='.$meta.'" /></head><body><a href="'.$meta.'">Forward</a></body></html>');
}	
?>