<?php
/** 
 * class_log.php
 * 
 * @package		The Logger
 * @author		eviL3 <evil@phpbbmodders.net>
 * @author		Brainy
 * @copyright	(c) 2006 eviL3 and Brainy
 * @license		http://opensource.org/licenses/gpl-license.php GNU Public License 
 *
 */

/**  
 * Make sure the file isn't called directly
 */
if (!defined('IN_PHPBB'))
{
	die('Hacking attempt');
}

/**  
 * If file was already included, return
 */
/*if( class_exists( 'log_handler' ) )
{
	return;
}*/

/**  
 * This is to check if it's been installed
 */
define( 'LOG_MOD_INSTALLED', true );

/**  
 * The log class
 * 
 * This class contains all important methods
 * for the logger. Such as insert(), get_config(),
 * remove(), prune()...
 * 
 */
class log_handler
{
	var $config;
	
	/**
	 * Constructor
	 *
	 * @return void
	 */
	function log_handler()
	{
		$this->get_config();
//		$this->load_lang( 'log_main' );
//		$this->load_mod_langs();
	}
	
	/**
	 * Insert Log
	 * 
	 * This function is used to insert logs to the database.
	 * 
	 * @param	int $log_type
	 * @param	mixed $operation
	 * @param	array $data
	 * @param	int $forum_id
	 * @param	int $topic_id
	 * @param	int $user_id
	 * @global	array $userdata
	 * @global	string $user_ip
	 * @global	db $db
	 * @global	array $lang
	 * @return	bool log inserted
	 */
	function insert( $log_type, $operation, $data = '', $forum_id = 0, $topic_id = 0, $user_id = 0 )
	{
		global $userdata, $user_ip, $db, $lang, $board_config;
//-- mod : Modification logMod -------------------------------------------------
//-- add
		global $user_ip_real;
//-- fin mod : Modification logMod ---------------------------------------------
		
		if ( empty( $user_id ) )
		{
			$user_id = $userdata['user_id'];
		}
		else
		{
			$user_id = (int) $user_id;
		}
		$data	= ( sizeof($data) ) ? serialize( $data ) : '';
		$time	= time();
		
		/**
		 * Make sure these are only numbers
		 */
		$forum_id	= (int) $forum_id;
		$topic_id	= (int) $topic_id;
		
		/**
		 * Check the configuration settings
		 * Is this log type totally disabled?
		 */
		switch( $log_type )
		{
			case LOG_TYPE_USER:
				$disabled = ( $this->config['log_user'] ) ? false : true;
			break;
			
			case LOG_TYPE_MOD:
				$disabled = ( $this->config['log_mod'] ) ? false : true;
			break;
				
			case LOG_TYPE_ADMIN:
				$disabled = ( $this->config['log_admin'] ) ? false : true;
			break;
			
			case LOG_TYPE_ERROR:
				$disabled = ( $this->config['log_error'] ) ? false : true;
			break;
			
			default:
				$disabled = true;
		}
		
		if( $disabled )
		{
			return false;
		}
		
		/**
		 * The SQL Query
		 */
		$sql2 = '';
		$sql3 = '';
		$email_msg = '';
		
		$sql_ary = array(
			'log_type'	=> $log_type,
			'user_id'	=> $user_id,
			'forum_id'	=> $forum_id,
			'topic_id'	=> $topic_id,
			'log_ip'	=> $user_ip,
//-- mod : Modification logMod -------------------------------------------------
//-- add
			'log_ip_real'	=> $user_ip_real,
//-- fin mod : Modification logMod ---------------------------------------------
			'log_time'	=> $time,
			'log_operation'	=> $operation,
			'log_data'	=> $data,
		);
		
		$temp = true;
		while( list( $key, $val ) = each( $sql_ary ) )
		{
			//$val = str_replace("\'", "''", $val);
			$val = addslashes( $val );
			$sql2 .= ( isset($temp) ) ? $key : ", $key";
			$sql3 .= ( isset($temp) ) ? "'$val'" : ", '$val'";
			unset( $temp );
			
			$email_msg .= "$key => $val\n";
		}
		
		$sql = 'INSERT INTO ' . LOG_TABLE . '
				( ' . $sql2 . ' )
			VALUES
				( ' . $sql3 . ' ) ';
		
		if( !$db->sql_query( $sql ) )
		{
			/**
			 * If it's impossible to log, attempty to email
			 */
			if( $this->config['log_email_send'] )
			{
				$title = sprintf( $lang['Log_failed_log_title'], $board_config['board_name'] );
				$this->email( $email_msg, $title );
			}

			return false;
		}
		else
		{
			return true;
		}
	}
	
	/**
	 * Update a log config entry
	 *
	 * @param string $config_name
	 * @param string $config_value
	 * @return bool updated
	 */
	function update_config ( $config_name, $config_value )
	{
		global $db;
		
		$sql = 'UPDATE ' . LOG_CONFIG_TABLE . "
			SET config_value = '" . str_replace("\'", "''", $config_value) . "'
			WHERE config_name = '$config_name'";
		
		if( !( $db->sql_query( $sql ) ) )
		{
			return false;
		}
		
		return true;
	}
	
	/**
	 * Prune log entries
	 * 
	 * Prune old logs with this function
	 * 
	 * @param	int $prune_time
	 * @param	array $prune_types
	 * @global	db $db
	 * @return	bool logs pruned
	 */
	function prune( $prune_time, $prune_types )
	{
		global $db;
		
		if( !sizeof( $prune_types ) || empty( $prune_time ) )
		{
			return;
		}
		
		/**
		 * Typecast array
		 */
		while( list( $key, $val ) = each( $prune_types ) )
		{
			$prune_types[$key] = (int) $val;
		}
			
		/**
		 * The SQL Query
		 */
		$sql = 'DELETE FROM ' . LOG_TABLE . '
			WHERE log_type IN (' . implode( ', ', $prune_types ) . ' )
			AND log_time < ' . (int) $prune_types;
		
		if( !$db->sql_query( $sql ) )
		{
			return false;
		}
		
		$this->update_config( 'log_last_prune', time() );
		
		return true;
	}
	
	/**
	 * Get config function
	 * 
	 * This function is used to obtain the Log configuration
	 * 
	 * @global	db $db
	 * @return	bool log info obtained
	 */
	function get_config( )
	{
		global $db;
	
		if( isset( $this->config ) )
		{
			return;
		}
		
		$sql = 'SELECT * FROM ' . LOG_CONFIG_TABLE;
		
		$this->config = array();
		if( !$result = $db->sql_query($sql) )
		{
			$this->insert( LOG_TYPE_ERROR, 'LOG_E_LOGGING_CONFIG_ERROR' );
			return false;
		}
		else
		{
			while( $row = $db->sql_fetchrow($result) )
			{
				$this->config[$row['config_name']] = $row['config_value'];
			}
		}
		
		return true;
	}
	
	/**
	 * Emailing Function
	 * 
	 * This is used for sending mails easier.
	 * 
	 * @param	string $message
	 * @param	string $subject
	 * @param	string $to
	 * @param	string $replyto
	 * @param	string $from
	 * @param	array $bcc_list
	 * @param	string $tpl
	 * @param	string $lang
	 * @global	array $board_config
	 * @global	mixed $user_ip
	 * @global	array $userdata
	 */
	function email( $message, $subject, $to = '', $replyto = '', $from = '', $bcc_list = '', $tpl = 'admin_send_log', $lang = '' )
	{
		global $board_config, $user_ip, $userdata, $phpbb_root_path, $phpEx;
		
		$default_ary = array(
			'from'		=> $board_config['board_email'],
			'replyto'	=> $board_config['board_email'],
			'lang'		=> $userdata['user_language'],
			'to'		=> $board_config['board_email'],
		);
		
		while ( list( $key, $val ) = @each( $default_ary ) )
		{
			${$key}	= ( empty( ${$key} ) ) ? $val : '';
		}
		
		if( !class_exists( 'emailer' ) )
		{
			include_once( "{$phpbb_root_path}includes/emailer.$phpEx" );
		}
		
		$emailer = new emailer( $board_config['smtp_delivery'] );
		
		$emailer->from( $from );
		$emailer->replyto( $replyto );
		
		if ( !$bcc_list )
		{
			for ( $i = 0; $i < count( $bcc_list ); $i++ )
			{
				$emailer->bcc( $bcc_list[$i] );
			}
		}
		
		$emailer->use_template( $tpl, $lang );
		$emailer->email_address( $to );
		$emailer->set_subject( $subject );
		
		$emailer->assign_vars(array(
			'SITENAME'		=> $board_config['sitename'], 
			'BOARD_EMAIL'	=> $board_config['board_email'], 
			'MESSAGE'		=> $message,
			)
		);
		
		$emailer->send();
		$emailer->reset();
	}
	
	/**
	 * Load language function
	 * 
	 * The function checks if the file exists, and includes it.
	 * If the file gets included, it returns true, if it doesn't
	 * exist, or couldn't get included, it returns false.
	 * 
	 * @param	string $lang_file
	 * @param	string $language
	 * @global	array $board_config
	 * @global	string $phpbb_root_path
	 * @global	string $phpEx
	 * @global	array $lang
	 * @return	bool file included
	 */
	function load_lang( $lang_file, $language = '' )
	{
		global $board_config, $phpbb_root_path, $phpEx, $lang;
		
		if( empty( $language ) )
		{
			$language = $board_config['default_lang'];
		}
		
		$file = "{$phpbb_root_path}language/lang_$language/lang_$lang_file.{$phpEx}";
		if ( file_exists( $file ) )
		{
			if( include_once( $file ) )
			{
				return true;
			}
			else
			{
				return false;
			}
		}
		else
		{
			return false;
		}
		
	}
	
	/**
	 * Load MOD languages
	 * 
	 * This is for loading all language files named 'lang_log_*.php';
	 * 
	 * @param	string $dir
	 * @param	string $language
	 * @global	array $board_config
	 * @global	string $phpbb_root_path
	 * @global	string $phpEx
	 * @return	bool false if failed
	 */
	function load_mod_langs( $dir = '', $language = '' )
	{
		global $board_config, $phpbb_root_path, $phpEx;
		
		$language	= ( empty( $language ) ) ? $board_config['default_lang'] : $language;
		$dir		= ( empty( $dir ) ) ? "{$phpbb_root_path}language/lang_$language/" : $dir;
		
		if( !$handle = opendir( $dir ) )
		{
			return false;
		}
		
		$exclude_ary = array(
			'log_admin',
//			'log_main',
		);
		
		while( $file = readdir( $handle ) )
		{
			if( preg_match( "#lang_log_(.*).$phpEx#si", $file, $matches ) )
			{
				if( !in_array( 'log_' . $matches[1], $exclude_ary ) )
				{
					$this->load_lang( 'log_' . $matches[1] );
				}
			}
		}
		
		closedir( $handle );
		
		return true;
	}
	
	/**
	 * Convert forum id to name
	 * 
	 * Function by war-hawk at phpBB.com
	 *
	 * @global	db $db
	 * @param	int $id
	 * @return	Forum Name
	 */
	function convert_forum_id ( $id )
	{
		global $db;
		
		$id = (int) $id;
		
		$sql = 'SELECT forum_name FROM ' . FORUMS_TABLE . '
			WHERE forum_id = ' . $id . '
			LIMIT 1';
		
		if ( !$result = $db->sql_query($sql) )
		{
			message_die(GENERAL_ERROR, 'Log_failed_get_f_name', '', __LINE__, __FILE__, $sql);
		}
		
		while ( $row = $db->sql_fetchrow($result) )
		{
			$forum_name = $row['forum_name'];
		}
		
		return $forum_name;
	}
	
	/**
	 * Convert a user id to a username
	 * 
	 * Function by battye
	 *
	 * @param	int $id
	 * @return	Username
	 */
	function convert_user_id ( $id )
	{
		global $db;
			
		$id = (int) $id;
		
		$sql = 'SELECT username FROM ' . USERS_TABLE . '
			WHERE user_id = ' . $id;
		
		if ( !$result = $db->sql_query($sql) )
		{
			message_die(GENERAL_ERROR, 'Log_failed_get_u_name', '', __LINE__, __FILE__, $sql);
		}
		
		while ( $row = $db->sql_fetchrow($result) )
		{
			$username = $row['username'];
		}
		
		return $username;
	}
	
	/**
	 * Convert ban id to any id
	 *
	 * @global	db $db
	 * @param	int $ban_id
	 * @return	user id
	 */
	function ban2id ( $ban_id, $type )
	{
		global $db;
		
		$sql = 'SELECT ' . $type . ' FROM ' . BANLIST_TABLE . '
			WHERE ban_id = ' . (int) $ban_id . '
			LIMIT 1';
		if( !( $result = $db->sql_query( $sql ) ) )
		{
			return false;
		}
		$temp = $db->sql_fetchrow( $result );
		
		return $temp[$type];
	}
	
	/**
	 * Convert post id to title
	 *
	 * @global	db $db
	 * @param	int $post_id
	 * @return	topic title
	 */
	function convert_post_id( $post_id )
	{
		global $db;
		
		$post_id = (int) $post_id;
		
		$sql = 'SELECT t.topic_title
			FROM ' . TOPICS_TABLE . ' t, ' . POSTS_TABLE . ' p
				WHERE p.post_id = ' . $post_id . '
				AND t.topic_id = p.topic_id
				LIMIT 1';
		
		if ( !$result = $db->sql_query( $sql ) )
		{
			return false;
		}		
		$row = $db->sql_fetchrow( $result );
		
		return $row['topic_title'];
	}
	
	/**
	 * Convert topic id to title
	 *
	 * @global	db $db
	 * @param	int $topic_id
	 * @return	topic title
	 */
	function convert_topic_id( $topic_id )
	{
		global $db;
		
		$topic_id = (int) $topic_id;
		
		$sql = 'SELECT topic_title
			FROM ' . TOPICS_TABLE . '
				WHERE topic_id = ' . $topic_id . '
				LIMIT 1';
		
		if ( !$result = $db->sql_query( $sql ) )
		{
			return false;;
		}		
		$row = $db->sql_fetchrow( $result );
		
		return $row['topic_title'];
	}
	
	/**
	 * Copyright function
	 * 
	 * Why not? :P Displayed in admin footer... giving credit is always nice.
	 * 
	 * @param	string $echo
	 * @return	string Copyright link for the footer
	 */
	function copyright( $echo = true )
	{
		$version	= $this->config['log_mod_version'];
//		$link		= '<br /><br />';
		$link		.= '<div style="text-align: center;">';
		$link		.= '<span class="copyright">';
		$link		.= '<a href="http://phpbbmodders.net/goto.php?l=thelogger" class="copyright">The Logger</a> &copy; 2006 eviL&lt;3 &amp; Brainy';
		$link		.= '</span>';
		$link		.= '</div>';
		
		if( $echo )
		{
			echo( $link );
		}
		
		return $link;
	}
}

?>
