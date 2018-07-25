<?php
/***************************************************************************
 *                             password.php
 *                            -------------------
 *   begin                : Friday, Jan 13, 2006
 *   copyright            : (C) 2005 - 2006 Dmitry Shechtman
 *   email                : damnian@damnian.com
 *
 *   $Id: password.php,v 2.0.1.0 2006/03/26 00:00:00 damnian Exp $
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

// Check for administrator permissions
$userdata = session_pagestart($user_ip, PAGE_INDEX);

if ( $userdata['user_level'] != ADMIN )
{
	message_die(GENERAL_MESSAGE, 'You must be logged in as the board administrator', 'Password MOD');
}

// Check for previous installation
if ( $board_config['password_security_startdate'] )
{
	message_die(GENERAL_MESSAGE, 'Already installed', 'Password MOD');
}

// Replace user passwords
switch ( SQL_LAYER )
{
	case 'mssql':
	case 'mssql-odbc':
		// Get old ones
		$sql = "SELECT user_id, user_password, user_regdate 
			FROM " . USERS_TABLE;

		if ( !($result = $db->sql_query($sql)) ) 
		{ 
			message_die(GENERAL_ERROR, 'Could not obtain user_password information', 'Password MOD', __LINE__, __FILE__, $sql); 
		} 

		// Replace with new ones
		while ( $row = $db->sql_fetchrow($result) ) 
		{ 
			$new_password = md5($row['user_password'] . $row['user_regdate']); 

			$sql = 'UPDATE ' . USERS_TABLE . ' 
				SET user_password = \'' . $new_password . '\' 
				WHERE user_id = ' . $row['user_id']; 

			if ( !($db->sql_query($sql)) ) 
			{ 
				message_die(GENERAL_ERROR, 'Could not update user_password for user_id=' . $row['user_id'], 'Password MOD', __LINE__, __FILE__, $sql); 
			} 
		}
		break;
		
	default:
		// Replace all at once
		$sql = "UPDATE " . USERS_TABLE . " 
			SET user_password = MD5( CONCAT( user_password, user_regdate ) )";
		if ( !($db->sql_query($sql)) ) 
		{ 
			message_die(GENERAL_ERROR, 'Could not replace user passwords', 'Password MOD', __LINE__, __FILE__, $sql); 
		}
}

// Update password security date
$sql = "INSERT INTO " . CONFIG_TABLE . " 
	( config_name, config_value ) 
	VALUES ( 'password_security_startdate', " . time() . " )";

if( !($db->sql_query($sql, BEGIN_TRANSACTION)) )
{
	message_die(GENERAL_ERROR, 'Could not update date', 'Password MOD', __LINE__, __FILE__, $sql);
}

// Update password security method
$sql = "INSERT INTO " . CONFIG_TABLE . " 
	( config_name, config_value ) 
	VALUES ( 'password_security_method', 'double_md5' )";

if( !$db->sql_query($sql, END_TRANSACTION) )
{
	message_die(GENERAL_ERROR, 'Could not update method', 'Password MOD', __LINE__, __FILE__, $sql);
}

message_die(GENERAL_MESSAGE, 'Successfully installed.<br/>You may now delete ' . $HTTP_ENV_VARS['SCRIPT_NAME'], 'Password MOD');

?>
