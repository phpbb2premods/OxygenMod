<?php
/**
 *	Sexy Administrator Index, Core Functions
 *	@ Author : (1) Dean Newman
 *	@ Licence: GNU/General Public Licence (GPL) v2
 */

define('MODSEARCH_PHPBB', 0);
define('MODSEARCH_PHPBBHACKS', 1);
define('MODSEARCH_PHPBBDE', 2);

class sexy_admin_index
{
	// Alter language in index.php
	function sexy_admin_index(&$lang)
	{
		global $phpbb_root_path, $phpEx, $board_config;
		$this->init();
	}

	// Initiate SAI.
	function init()
	{
		global $HTTP_GET_VARS, $HTTP_POST_VARS, $lang, $phpEx, $board_config;

		if ( $HTTP_GET_VARS['mode'] && !$HTTP_GET_VARS['ajax'] )
		{
			switch ( $HTTP_GET_VARS['mode'] )
			{
				default:
					$url = append_sid("index.$phpEx?pane=right");
					$message = $lang['invalid_mode'] . sprintf($lang['Click_return_index'], '<a href=" ' . $url . '">', '</a>');
					message_die(GENERAL_MESSAGE, $message, $lang['TPL']['control_panel']);
					break;
				case 'mod_search':
					if ( isset ( $HTTP_POST_VARS['new_id_ms'] ) )
					{
						$this->update_modsearch($HTTP_POST_VARS['new_id_ms']);
					}
					else
					{
						$this->error_empty();
					}
					break;
				case 'mod_search':
					if ( isset ( $HTTP_POST_VARS['new_id_ms'] ) )
					{
						$this->update_modsearch($HTTP_POST_VARS['new_id_ms']);
					}
					else
					{
						$this->error_empty();
					}
					break;
				case 'default_style':
					if ( isset ( $HTTP_POST_VARS['new_id_ds'] ) )
					{
						$this->update_default_style($HTTP_POST_VARS['new_id_ds']);
					}
					else
					{
						$this->error_empty();
					}
					break;
				case 'change_version':
					if ( isset ( $HTTP_POST_VARS['new_ver'] ) )
					{
						$this->update_version($HTTP_POST_VARS['new_ver']);
					}
					else
					{
						$this->error_empty();
					}
					break;
				case 'notepad_p';
					if ( isset ( $HTTP_POST_VARS['personal'] ) )
					{
						$this->update_notepad($HTTP_POST_VARS['personal']);
					}
					else
					{
						$this->error_empty();
					}
					break;
				case 'notepad_g':
					if ( isset ( $HTTP_POST_VARS['global'] ) )
					{
						$this->update_notepad_global($HTTP_POST_VARS['global']);
					}
					else
					{
						$this->error_empty();
					}
					break;
			}
		}
	}

	// Fetch data for forum staff
	// Mr. Newman was on crack and decided to use 2 querys when only 1 was needed.
	function users_staff()
	{
		global $db, $lang, $board_config;
		$staff = array();
		$sql = 'SELECT user_id, username, user_level
			FROM ' . USERS_TABLE . '
			WHERE user_level != ' . USER . '
				AND user_id <> ' . ANONYMOUS . '
				ORDER BY username';
//-- mod : rank color system ---------------------------------------------------
//-- add
		$sql = str_replace('SELECT ', 'SELECT user_level, user_color, user_group_id, ', $sql);
//-- fin mod : rank color system -----------------------------------------------
		if ( ! $result = $db->sql_query($sql) )
		{
			message_die(GENERAL_ERROR,$lang['sql_error'], __LINE__, __FILE__, $sql);
		}
		while ( $row = $db->sql_fetchrow($result) )
		{
			if( $row['user_level'] == MOD )
			{
				$staff['mod'][] = $row;
			}
			else if ( $row['user_level'] == ADMIN )
			{
				$staff['admin'][] = $row;
			}
		}
		$db->sql_freeresult($result);
		return $staff;
	}

	// Fetch data for inactive users
	function users_inactive()
	{
		global $db, $lang, $board_config;
		$inactive_users = array();
		$sql = 'SELECT user_id, username
			FROM ' . USERS_TABLE . '
				WHERE user_active = 0
					AND user_id <> ' . ANONYMOUS . '
						ORDER BY username';
//-- mod : rank color system ---------------------------------------------------
//-- add
		$sql = str_replace('SELECT ', 'SELECT user_level, user_color, user_group_id, ', $sql);
//-- fin mod : rank color system -----------------------------------------------
		if ( ! $result = $db->sql_query($sql) )
		{
			message_die(GENERAL_ERROR,$lang['sql_error'], __LINE__, __FILE__, $sql);
		}
		while ( $row = $db->sql_fetchrow($result) )
		{
			$inactive_users[] = $row;
		}
		$db->sql_freeresult($result);
		return $inactive_users;
	}

	// Fetch data for banned users
	function users_banned()
	{
		global $db, $lang, $board_config;
		$banned = array();
		$sql = 'SELECT u.user_id, u.username, b.ban_userid
			FROM ' . BANLIST_TABLE . ' b, ' . USERS_TABLE . ' u
				WHERE b.ban_userid <> ' . ANONYMOUS . '
					AND b.ban_userid = u.user_id
						ORDER BY u.username';
//-- mod : rank color system ---------------------------------------------------
//-- add
		$sql = str_replace('SELECT ', 'SELECT user_level, user_color, user_group_id, ', $sql);
//-- fin mod : rank color system -----------------------------------------------
		if ( ! $result = $db->sql_query($sql) )
		{
			message_die(GENERAL_ERROR,$lang['sql_error'], __LINE__, __FILE__, $sql);
		}
		while ( $row = $db->sql_fetchrow($result) )
		{
			$banned[] = $row;
		}
		$db->sql_freeresult($result);
		return $banned;
	}

	// Fetch phpBB version
	function version_phpbb($raw = false)
	{
		global $db, $lang, $board_config;

		if ( $raw )
		{
			return '2' . $board_config['version'];
		}

		$latest_version	= @file_get_contents('http://www.phpbb.com/updatecheck/20x.txt');
		$latest			= intval(str_replace("\n", '', $latest_version));
		$current		= intval(str_replace('.', '', '2' . $board_config['version']));
		$higher			= FALSE;

		// check for errors
		if ( empty( $latest_version ) || $latest == 0 )
		{
			$error = TRUE;
		}
		else
		{
			$error = FALSE;
		}
		if ( $latest <> $current )
		{
			if ( $latest > $current )
			{
				$valid = FALSE;
			}
			if ( $latest < $current )
			{
				$valid = FALSE;
				$higher = TRUE;
			}
		}
		else
		{
			$valid = TRUE;
		}

		if ( $error == TRUE )
		{
			$output = '<span style="color:orange">' . '2' . $board_config['version'] . '</span> ' . $lang['sai_error_version'];
		}
		else if ( $higher == TRUE )
		{
			$output = '<span style="color:orange">' . '2' . $board_config['version'] . '</span> ' . $lang['sai_higher_version'];
		}
		else if ( $valid == FALSE )
		{
			$output = '<span style="color:red">' . '2' . $board_config['version'] . '</span> ' . $lang['sai_latest_version'];
		}
		else
		{
			$output = '<span style="color:green">' . '2' . $board_config['version'] . '</span> ';
		}

		return $output;
	}

//-- mod : oxygen version checker ----------------------------------------------
//-- add
	function version_oxygen($raw = false)
	{
		global $db, $lang, $board_config;
		if ( $raw )
		{
			return $board_config['oxygen_version'];
		}
		$latest_version = @file_get_contents('http://www.oxygen-powered.net/oxygen_premodded_board/update.txt');
		$latest = intval(str_replace("\n", '', $latest_version));
		$current = intval(str_replace('.', '', $board_config['oxygen_version']));
		$higher = FALSE;
		if($latest <> $current)
		{
			if($latest > $current)
			{
				$valid = FALSE;
			}
			if($latest < $current)
			{
				$valid = FALSE;
				$higher = TRUE;
			}
		}
		else
		{
			$valid = TRUE;
		}

		if ( $higher == TRUE )
		{
			$output = '<span style="color:orange">' . $board_config['oxygen_version'] . '</span> ' . $lang['sai_higher_version'];
		}
		else if ( $valid == FALSE )
		{
			$output = '<span style="color:red">' . $board_config['oxygen_version'] . '</span> ' . $lang['sai_latest_version'];
		}
		else
		{
			$output = '<span style="color:green">' . $board_config['oxygen_version'] . '</span> ';
		}

		return $output;
	}
//-- fin mod : oxygen version checker ------------------------------------------

	// Fetch PHP Version
	function version_php()
	{
		global $db, $lang, $board_config;
		return phpversion();
	}

	// Fetch MySQL Version
	function version_mysql()
	{
		global $db, $lang, $board_config;

		$sql = 'SELECT VERSION() AS mysql_version';
		if ( ! $result = $db->sql_query($sql) )
		{
			message_die(GENERAL_ERROR, $lang['sql_error'], __LINE__, __FILE__, $sql);
		}

		$row = $db->sql_fetchrow($result);
		$db->sql_freeresult($result);

		return $row['mysql_version'];
	}

	// Fetch EasyMOD Version
	function version_easymod()
	{
		global $db, $lang, $board_config;
		return $board_config['EM_version'];
	}
	
	// Fetch Server version
	function version_server()
	{
		global $HTTP_SERVER_VARS;
		return $HTTP_SERVER_VARS['SERVER_SOFTWARE'];
	}
	
	// Fetch own version
	function version_sai()
	{
		global $db, $lang, $board_config;
		
 		$fp = fsockopen($lang['sai_verchk_url']['host'], 80, $errno, $errstr, 30);
		
		// fetch version number
		if (!$fp)
		{
			$error = TRUE;
		} 
		else 
		{
			$out  = "GET " . $lang['sai_verchk_url']['path'] . " HTTP/1.1\r\n";
			$out .= "User-Agent: Sexy Administration Index\r\n";
			$out .= "Host: " . $lang['sai_verchk_url']['host'] . "\r\n";
			$out .= "Connection: Close\r\n\r\n";

			fwrite($fp, $out);
			while (!feof($fp))
			{
				$latest_version = fgets($fp, 128);
			}
			fclose($fp);
		} 
		
		$latest			= intval(str_replace('.', '', $latest_version));
		$current		= intval(str_replace('.', '', $lang['sai_version']));
		
		// check for errors
		if ( empty( $latest_version ) || $latest == 0 )
		{
			$error = TRUE;
		}
		else
		{
			$error = FALSE;
		}

		// check version
		if ( $latest > $current )
		{
			$valid = FALSE;
		}
		else
		{
			$valid = TRUE;
		}

		return ( $error ) ? '<span style="color:orange">' . $lang['sai_version'] . '</span> ' . $lang['sai_error_version'] : ( ( $valid == FALSE ) ? '<span style="color:red">' . $lang['sai_version'] . '</span> ' . $lang['sai_latest_version'] : '<span style="color:green">' . $lang['sai_version'] . '</span>' );
	}

	// Update phpBB version number
	function update_version($new_version_number)
	{
		global $db, $lang, $board_config, $phpEx;

		$url_redir		= append_sid("index.$phpEx?pane=right");
		$new_version	= explode('.', $new_version_number);

		if ( $new_version[0] != '2' || sizeof($new_version) > 3 )
		{
			$message = sprintf($lang['error_change_version_blank'],"<a href=\"" . $url_redir . "\">",'</a>');
			message_die(GENERAL_MESSAGE, $message );
		}

		while ( list ( , $ver_section ) = @each ( $new_version ) )
		{
			$ver_output .= '.' . $ver_section;
		}

		$new_version	= addslashes(substr($new_version_number, 1));
		unset($ver_output);

		if ( empty ( $new_version ) )
		{
			$url = append_sid("index.$phpEx?pane=right");
			$message = $lang['modsearch_changed'] . sprintf($lang['Click_return_index'], '<a href=" ' . $url . '">', '</a>');
			message_die(GENERAL_MESSAGE, $lang['error_change_version_blank'], $lang['TPL']['control_panel']);
		}

		$sql = 'UPDATE ' . CONFIG_TABLE . " SET config_value = '$new_version' WHERE config_name = 'version'";
		if( ! $result = $db->sql_query($sql) )
		{
			message_die(GENERAL_ERROR, $lang['sql_error'], __LINE__, __FILE__, $sql);
		}

		$url		= append_sid("index.$phpEx?pane=right");
		$message	= $lang['version_changed'] . '<br /><br />' . sprintf($lang['Click_return_index'], '<a href=" ' . $url . '">', '</a>');
		message_die(GENERAL_MESSAGE, $message, $lang['TPL']['control_panel']);
	}

	// Update personal notepad.
	function update_notepad($new_notepad_data)
	{
		global $db, $lang, $board_config, $userdata, $phpEx;

		$user_notes	= addslashes($new_notepad_data);
		$user_notes	= htmlspecialchars($user_notes);

		$sql = 'UPDATE ' . USERS_TABLE . " SET user_admin_notes = '$user_notes' WHERE user_id = '{$userdata['user_id']}'";
		if( ! $result = $db->sql_query($sql) )
		{
			message_die(GENERAL_ERROR, $lang['sql_error'], __LINE__, __FILE__, $sql);
		}

		$url		= append_sid("index.$phpEx?pane=right");
		$message	= $lang['notepad_updated'] . '<br /><br />' . sprintf($lang['Click_return_index'], '<a href=" ' . $url . '">', '</a>');
		message_die(GENERAL_MESSAGE, $message, $lang['TPL']['control_panel']);
	}

	// Update global admin notepad
	function update_notepad_global($new_notepad_data)
	{
		global $db, $lang, $board_config, $phpEx;

		$user_notes	= addslashes($new_notepad_data);
		$user_notes	= htmlspecialchars($user_notes);

		$sql = 'UPDATE ' . USERS_TABLE . " SET user_admin_notes = '$user_notes' WHERE user_id = '-1'";
		if( ! $result = $db->sql_query($sql) )
		{
			message_die(GENERAL_ERROR, $lang['sql_error'], __LINE__, __FILE__, $sql);
		}

		$url		= append_sid("index.$phpEx?pane=right");
		$message	= $lang['notepad_updated_g'] . '<br /><br />' . sprintf($lang['Click_return_index'], '<a href=" ' . $url . '">', '</a>');
		message_die(GENERAL_MESSAGE, $message, $lang['TPL']['control_panel']);
	}

	// Update Modsearch provider
	function update_modsearch($new_modsearch_value)
	{
		global $db, $lang, $board_config, $phpEx;

		$change_search	= intval($new_modsearch_value);
		$ms_array		= $this->get_modsearch(true);
		$valid			= false;

		for ( $i = 0; $i < sizeof ( $ms_array ); $i++ )
		{
			if ( $ms_array[$i]['id'] == $change_search )
			{
				$valid = true;
			}
		}

		if( ! $valid )
		{
			$url		= append_sid("index.$phpEx?pane=right");
			$message	= $lang['modsearch_error'] . sprintf($lang['Click_return_index'], '<a href=" ' . $url . '">', '</a>');
			message_die(GENERAL_MESSAGE, $message, $lang['TPL']['control_panel']);
		}

		$sql = 'UPDATE ' . CONFIG_TABLE . " SET config_value = '$change_search' WHERE config_name = 'mod_search_engine'";
		
		if( ! $result = $db->sql_query($sql) )
		{
			message_die(GENERAL_ERROR,$lang['sql_error'], __LINE__, __FILE__, $sql);
		}

		$url = append_sid("index.$phpEx?pane=right");
		$message = $lang['modsearch_changed'] . '<br /><br />' . sprintf($lang['Click_return_index'], '<a href=" ' . $url . '">', '</a>');
		message_die(GENERAL_MESSAGE, $message, $lang['TPL']['control_panel']);
	}

	// Update forums default style
	function update_default_style($new_style_id)
	{
		global $db, $lang, $board_config, $phpEx;

		$new_style = intval($new_style_id);

		$sql = 'UPDATE ' . CONFIG_TABLE . " SET config_value = '$new_style' WHERE config_name = 'default_style'";
		if( ! $result = $db->sql_query($sql) )
		{
			message_die(GENERAL_ERROR,$lang['sql_error'], __LINE__, __FILE__, $sql);
		}

		$url		= append_sid("index.$phpEx?pane=right");
		$message	= $lang['default_style_changed'] . '<br /><br />' . sprintf($lang['Click_return_index'], '<a href=" ' . $url . '">', '</a>');
		message_die(GENERAL_MESSAGE, $message, $lang['TPL']['control_panel']);
	}
	
	// Display list of users from array
	function display_users($userlist)
	{
		global $db, $lang, $board_config, $phpEx;
//-- mod : rank color system ---------------------------------------------------
//-- add
		global $rcs;
//-- fin mod : rank color system -----------------------------------------------

		$user_list_built = '';
		for ( $i = 0; $i < sizeof($userlist); $i++ )
		{
			$edit_user = append_sid("admin_users.$phpEx?mode=edit&amp;" . POST_USERS_URL . "=" . $userlist[$i]['user_id']);
//-- mod : rank color system ---------------------------------------------------
//-- delete
/*-MOD
			$user_list_built .= ( $i == 0 ) ? '<a class="gensmall" href="' . $edit_user . '">' . $userlist[$i]['username'] . '</a>' : ', <a class="gensmall" href="' . $edit_user . '">' . $userlist[$i]['username'] . '</a>';
MOD-*/
//-- add
			$user_list_built .= ( $i == 0 ) ? '<a class="gensmall" href="' . $edit_user . '">' . $rcs->get_colors($userlist[$i], $userlist[$i]['username']) . '</a>' : ', <a class="gensmall" href="' . $edit_user . '">' . $rcs->get_colors($userlist[$i], $userlist[$i]['username']) . '</a>';
//-- fin mod : rank color system -----------------------------------------------
		}

		return $user_list_built;
	}

	// Display the users personal notepad.
	function display_personal_notes()
	{
		global $db, $lang, $board_config, $userdata;
		return stripslashes($userdata['user_admin_notes']);
	}

	// Display the global admin notepad.
	function display_admin_notes()
	{
		global $db, $lang;

		$user_notes	= stripslashes($new_notepad_data);
		$user_notes	= addslashes($user_notes);
		$user_notes	= htmlspecialchars($user_notes);

		$sql = 'SELECT user_admin_notes FROM ' . USERS_TABLE . ' WHERE user_id = \'-1\'';
		if( ! $result = $db->sql_query($sql) )
		{
			message_die(GENERAL_ERROR, $lang['sql_error'], __LINE__, __FILE__, $sql);
		}

		$row = $db->sql_fetchrow($result);
		$db->sql_freeresult($result);

		return stripslashes( $row['user_admin_notes'] );
	}

	// Return data needed for modification search.
	function get_modsearch($full = false)
	{
		global $db, $lang, $board_config;

		$mod_search_data = array(
			array(
				'id' => MODSEARCH_PHPBB,
				'uri' => 'http://www.phpbb.com/phpBB/mod_search.php?mode=results&search_terms=any',
				'lang' =>  $lang['ms_phpbb'],
				'form' => 'search_keywords',
			),
			array(
				'id' => MODSEARCH_PHPBBHACKS,
				'uri' => 'http://phpbbhacks.com/searchresults.php?version=2&search_type=1&Submit=Go',
				'lang' => $lang['ms_phpbbhacks'],
				'form' => 'query',
			),
			array(
				'id' => MODSEARCH_PHPBBDE,
				'uri' => 'http://www.phpbb.de/moddb/suche.php',
				'lang' => $lang['ms_phpbbde'],
				'form' => 's',
			),
		);

		for ( $i = 0; $i < sizeof($mod_search_data); $i++ )
		{
			if ( $mod_search_data[$i]['id'] == $board_config['mod_search_engine'] )
			{
				$valid = true;
			}
		}

		if ( ! $valid )
		{
			$board_config['mod_search_engine'] = MODSEARCH_PHPBB;
		}

		if ( $full == false )
		{
			return $mod_search_data[ $board_config['mod_search_engine'] ];
		}

		return $mod_search_data;
	}
	
	function get_styles()
	{
		global $db, $lang, $board_config;

		$templatedata = array();

		$sql = 'SELECT themes_id AS style_id, style_name AS style_name FROM ' . THEMES_TABLE . ' ORDER BY style_name';
		if ( ! $result = $db->sql_query($sql) )
		{
			message_die(GENERAL_ERROR,$lang['sql_error'], __LINE__, __FILE__, $sql);
		}

		while ( $row = $db->sql_fetchrow($result) )
		{
			$templatedata[] = $row;
		}

		$db->sql_freeresult($result);

		return $templatedata;
	}
	
	// Return the statistic variables for template assign.
	function vars_statistics()
	{
		global $db, $lang, $board_config, $userdata, $SID, $phpEx;
		
		// Fetch all the data required
		$ms_data		= $this->get_modsearch();
		$staff_data		= $this->users_staff();
		$admin_data		= $staff_data['admin'];
		$mod_data		= $staff_data['mod'];
		$inactive_data	= $this->users_inactive();
		$banned_data	= $this->users_banned();
		$tdata			= $this->get_styles();
		$msdata			= $this->get_modsearch(true);
		
		// Build the board style dropdown
		$styles_menu = '<select name="new_id_ds">';
		for ( $i = 0; $i < sizeof ( $tdata ); $i++ )
		{
			$selected		= ($board_config['default_style'] == $tdata[$i]['style_id']) ? 'selected="selected"' : '';
			$selected_l		= ($board_config['default_style'] == $tdata[$i]['style_id']) ? '*' : '';
			$styles_menu	.= '<option value="' . $tdata[$i]['style_id'] . '" ' . $selected . '>' . $tdata[$i]['style_name'] . $selected_l . '</option>';
		}
		$styles_menu .= '</select>';

		// Build the Mod-search dropdown
		$ms_menu = '<select name="new_id_ms">';
		for ( $i = 0; $i < sizeof ( $msdata ); $i++ )
		{
			$selected	= ($board_config['mod_search_engine'] == $msdata[$i]['id']) ? 'selected="selected"' : '';
			$selected_l	= ($board_config['mod_search_engine'] == $msdata[$i]['id']) ? '*' : '';
			$ms_menu	.= '<option value="' . $msdata[$i]['id'] . '" ' . $selected . '>' . $msdata[$i]['lang'] . $selected_l . '</option>';
		}
		$ms_menu .= '</select>';

		// Free some memory
		unset($tdata, $msdata, $staffdata);

		// Assign switchs if size is higher than 0.
		$this->assign_switchs(array(
			'list_admins'	=> sizeof($admin_data),
			'list_mods'		=> sizeof($mod_data),
			'list_inactive'	=> sizeof($inactive_data),
			'list_banned'	=> sizeof($banned_data),
		));

		$array = array(
			// Version information
			'SVR_VERSION'		=> $this->version_server(),
			'PHP_VERSION'		=> $this->version_php(),
			'SQL_VERSION'		=> $this->version_mysql(),
			'BB_VERSION_RAW'	=> $this->version_phpbb(true),
			'BB_VERSION'		=> $this->version_phpbb(),
//-- mod : oxygen version checker ----------------------------------------------
//-- add
			'OXYGEN_VERSION_RAW'	=> $this->version_oxygen(true),
			'OXYGEN_VERSION'		=> $this->version_oxygen(),
//-- fin mod : oxygen version checker ------------------------------------------
			'SAI_VERSION'		=> $this->version_sai(),
			'EM_VERSION'		=> ( $em_version = $this->version_easymod() ) ? $em_version : $lang['em_not_installed'],

			// User information counters
			'NUM_ADMINS'		=> sizeof($admin_data),
			'NUM_MODS'			=> sizeof($mod_data),
			'NUM_BANNED'		=> sizeof($banned_data),
			'NUM_INACTIVE'		=> sizeof($inactive_data),

			// User information list
			'LIST_ADMINS'		=> $this->display_users($admin_data),
			'LIST_MODS'			=> $this->display_users($mod_data),
			'LIST_BANNED'		=> $this->display_users($banned_data),
			'LIST_INACTIVE'		=> $this->display_users($inactive_data),

			// Notepad data
			'NOTEPAD_GLOBAL'	=> $this->display_admin_notes(),
			'NOTEPAD_PERSONAL'	=> $this->display_personal_notes(),

			// MOD-Search Information
			'MS_URL'			=> $ms_data['uri'],
			'MS_LANG'			=> $ms_data['lang'],
			'MS_FORM'			=> $ms_data['form'],

			// Random
			'PHP_SELF'			=> append_sid("index.$phpEx?pane=right"),
			'POST_USERS_URL'	=> POST_USERS_URL,

			// Form locations
			'U_MANAGE'			=> append_sid("admin_users.$phpEx?mode=edit"),
			'U_PERMISSIONS'		=> append_sid("admin_ug_auth.$phpEx?mode=user"),
			'U_BAN'				=> append_sid("admin_user_ban.$phpEx"),
			'U_MSCHANGE'		=> append_sid("index.$phpEx?pane=right&amp;mode=mod_search"),
			'U_STYLECHANGE'		=> append_sid("index.$phpEx?pane=right&amp;mode=default_style"),
			'U_VERCHANGE'		=> append_sid("index.$phpEx?pane=right&amp;mode=change_version"),
			'U_NOTEPAD_G'		=> append_sid("index.$phpEx?pane=right&amp;mode=notepad_g"),
			'U_NOTEPAD_P'		=> append_sid("index.$phpEx?pane=right&amp;mode=notepad_p"),
			'U_PHPFUNC'			=> 'http://php.net/manual-lookup.php',
			'U_SQLFUNC'			=> 'http://www.mysql.com/search/index.php',

			// Form elements
			'S_DEFAULT_STYLE'	=> $styles_menu,
			'S_DEFAULT_MS'		=> $ms_menu,

			// Javascript Includes
			'JS_FUNCS'			=> '<script src="../templates/sai_funcs.js" type="text/javascript"></script>',
		);

		// Free more memory
		unset($ms_data, $styles_menu, $ms_menu, $admin_data, $mod_data, $banned_data, $inactive_data);

		// Return results
		return $array;
	}

	// Return the language variables for template assign.
	function vars_language()
	{
		global $board_config, $lang;

		$array = array();
		while ( list ( $key, $data ) = @each ( $lang['TPL'] ) )
		{
			$array['L_' . strtoupper($key)] = $data;
		}

		return $array;
	}

	// Assign template switchs upon validating data
	function assign_switchs($array)
	{
		global $template;

		if ( !is_array ( $array ) )
		{
			return false;
		}

		while ( list ( $key, $size ) = @each ( $array ) )
		{
			if ( $size )
			{
				$template->assign_block_vars('switch_' . $key, array());
			}
		}
	}
	
	function error_empty()
	{
		global $lang, $board_config;

		$url		= append_sid("index.$phpEx?pane=right");
		$message	= $lang['sai_input_empty'] . '<br /><br />' . sprintf($lang['Click_return_index'], '<a href="' . $url . '">', '<a>');
		message_die(GENERAL_ERROR, $message);
	}
}

?>
