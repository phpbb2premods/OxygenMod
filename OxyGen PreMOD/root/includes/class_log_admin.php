<?php
/** 
 * class_log_admin.php
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
if( class_exists( 'log_handler_admin' ) )
{
	return;
}

/**
 * Include the XML parser
 */
/*include_once( "{$phpbb_root_path}includes/class_xml.$phpEx" );
$xml = new xml_parser ( 'http://www.phpbb.com/mods/modx/sample.xml' );
print_r( $xml->data );*/

/**
 * The log admin class
 * 
 * This class extends the log handler
 * 
 */
class log_handler_admin extends log_handler
{
	var $config_cfg;
	var $log_types_nummeric;
	
	/**
	 * Constructor
	 *
	 * @return void
	 */
	function log_handler_admin()
	{
		global $phpbb_root_path, $lang, $template, $images;
		
		$this->log_handler();
		$this->load_lang( 'log_admin' );
		$this->config_cfg = "{$phpbb_root_path}includes/log_config.xml";
		$this->log_types_nummeric = array(
			LOG_TYPE_USER	=> $lang['log_type_user'],
			LOG_TYPE_MOD	=> $lang['log_type_mod'],
			LOG_TYPE_ADMIN	=> $lang['log_type_admin'],
			LOG_TYPE_ERROR	=> $lang['log_type_error'],
		);
		
		//$check_version	= ( $this->config['log_mod_version_check'] ) ? $this->check_version() : '';
		$check_version		= '';
		
		$template->assign_vars( array(
			'LOGGER_IMG'	=> $phpbb_root_path . $images['logger_acp'],
			'L_THELOGGER'	=> $lang['the_logger'],
			'CHECK_VERSION'	=> $check_version,
			)
		);
	}
	
	/**
	 * Remove Log entry
	 * 
	 * This function is used to remove logs from the database.
	 * 
	 * @param	array $remove_ary
	 * @param	int $type
	 * @global	db $db
	 * @return	bool log removed
	 */
	function remove( $remove_ary, $type = -1 )
	{
		global $db;
		
		$remove_count = sizeof( $remove_ary );
		$type = (int) $type;
		
		if( !$remove_count )
		{
			return;
		}
		
		if( $type == -1 )
		{
			$remove_list = '';
			for( $i = 0; $i < $remove_count; $i++ )
			{
				$remove_list .= ( $i != 0 ) ? ', ' . (int) $remove_ary[$i] : (int) $remove_ary[$i];
			}
			$sql_where = ' log_id IN ( ' . $remove_list . ' )';
		}
		else
		{
			$sql_where = ' log_type = ' . $type;
		}
		
		/**
		 * The SQL Query
		 */
		$sql = 'DELETE FROM ' . LOG_TABLE . '
			WHERE' . $sql_where;
		
		if( !$db->sql_query( $sql ) )
		{
			return false;
		}
		else
		{
			return true;
		}
	}
	
	/**
	 * Read options
	 * 
	 * Very many thanks to Lord Le Brand for putting this together for
	 * me. He's not only sometimes an SQL lord, but now he's even a PCRE
	 * lord!
	 * 
	 * The function reads the config def file.
	 * 
	 * @author	Lord Le Brand
	 * @param	string $file
	 * @return	array $logging_options
	 */
	function read_options ( $file )
	{
		if ( !( $f_logging_options = fopen( $file, 'r' ) ) )
		{
			return false;
		}
		
		$logging_options = array();
		$line = array();
		
		while ( ! feof( $f_logging_options ) ) 
		{ 
			$current_line = fgets( $f_logging_options );
		     
			$current_line = preg_replace('#<category title="(.*)">#si', "\$logging_options[] = array('title' => '\\1', 'content' => array(", $current_line);
			$current_line = preg_replace('#<entry>(.*)</entry>#si', "array( 'entry' => '\\1' ),", $current_line);
			$current_line = preg_replace('#<entry type="(.*)">(.*)</entry>#si', "array( 'entry' => '\\2', 'type' => '\\1' ),", $current_line);
			$current_line = preg_replace('#</category>#si', "));", $current_line);
			
			$line[] = $current_line;
		} 
		
		$settings = implode('', $line);
		$settings = preg_replace ( '/(<!--)(.*?)(-->)/is', '', $settings );
		
		eval($settings);
		
		fclose( $f_logging_options );
		
		return $logging_options;
	}
	
	/**
	 * View logs
	 * 
	 * This function will get the data from the db, in order to
	 * view the logs.
	 * 
	 * @global	db $db
	 * @param	int $type
	 * @param	int $start
	 * @return	array $logging_entries
	 */
	function view ( $type, $start = 0 )
	{
		global $db;
		$type = (int) $type;
		
		$sql_select	= '';
		$sql_tables	= '';
		$sql_where	= '';
		$sql_oderby	= '';
		
		switch( true )
		{
			case ( isset( $userdata['user_gender'] ) && isset( $board_config['gender_display'] ) && $board_config['gender_display'] ):
				$sql_select	.= ',	u.user_gender';
				
		}
		
		/**
		 * Big SQL Query with left joins and stuff :)
		 */
		$sql = 'SELECT
				l.log_id,
				l.user_id,
				l.forum_id,
				l.topic_id,
				l.log_ip,
				l.log_time,
				l.log_operation,
				l.log_data,
				f.forum_name,
				t.topic_title,
				u.username
				' . $sql_select . '
			FROM ' .			LOG_TABLE . '		l
				' . $sql_tables . '
				LEFT JOIN ' .	FORUMS_TABLE . '	f ON l.forum_id = f.forum_id 
				LEFT JOIN ' .	TOPICS_TABLE . '	t ON l.topic_id = t.topic_id
				LEFT JOIN ' .	USERS_TABLE . '		u ON l.user_id = u.user_id
			WHERE	l.log_type = ' . $type . '
				' . $sql_where . '
			ORDER BY l.log_time DESC
				' . $sql_oderby . "
			LIMIT {$start}, {$this->config['log_view_per_page']}";
//-- mod : rank color system ---------------------------------------------------
//-- add
		$sql = str_replace('u.username', 'u.username, u.user_level, u.user_color, u.user_group_id', $sql);
//-- fin mod : rank color system -----------------------------------------------
//-- mod : the logger - proxy detection ----------------------------------------
//-- add
		$sql = str_replace('l.log_ip,', 'l.log_ip, l.log_ip_real,', $sql);
//-- fin mod : the logger - proxy detection ------------------------------------
		if( !( $result = $db->sql_query( $sql ) ) )
		{
			return false;
		}
		
		$logging_entries = $db->sql_fetchrowset( $result );
		
		return( $logging_entries );
	}
	
	/**
	 * Make Viewselect
	 * 
	 * Builds a select box to select a logtype
	 * 
	 * @param	string $location
	 * @param	string $select_name
	 * @param	int $type
	 * @global	array $lang
	 * @return	array $logging_entries
	 */
	function make_viewselect ( $location, $select_name = false, $type = false )
	{
		global $lang;
		
		$types_ary = array(
			'log_type_user'		=> 3,
			'log_type_mod'		=> 1,
			'log_type_admin'	=> 0,
			'log_type_error'	=> 2,
		);
		
		$selectbox = '<select name="' . $select_name . '" onchange="window.location.href = \'' . append_sid( $location ) . '&type=\'+(this.options[this.selectedIndex].value)" size="1">';
		while( list( $key, $val ) = each( $types_ary ) )
		{
			$selected	= ( $type === $val ) ? ' selected="selected"' : '';
			$selectbox	.= '<option value="' . $val . '"' . $selected . '>' . $lang[$key] . '</option>';
		}
		$selectbox .= '</select>';
		
		return $selectbox;
	}
	
	/**
	 * Make hidden fields
	 * 
	 * Generates hidden fields from an array
	 * 
	 * @param	array $fields_ary
	 * @return	string $fields
	 */
	function make_hidden_fields ( $fields_ary )
	{
		if( !sizeof( $fields_ary ) )
		{
			return false;
		}
		
		$fields = '';
		while ( list( $key, $val ) = each( $fields_ary ) )
		{
			$fields .= '<input type="hidden" name="' . $key . '" value="'. $val . '" />';
		}
		
		return $fields;
	}
	
	/**
	 * Get the total log count for a specific type
	 *
	 * @param int $type
	 * @return the count
	 */
	function get_log_count ( $type )
	{
		global $db;
		
		$sql = 'SELECT COUNT( log_id ) AS count
			FROM ' . LOG_TABLE . '
			WHERE log_type = ' . (int) $type;
		
		if( !( $result = $db->sql_query( $sql ) ) )
		{
			return false;
		}
		
		$data = $db->sql_fetchrow( $result );
		
		return $data['count'];
	}
	
	/**
	 * Show a confirmation page
	 *
	 * @global	template $template
	 * @global	array $lang
	 * @param	string $form_action
	 * @param	string $msg_title
	 * @param	string $msg_txt
	 * @param	array $hidden_fields_ary
	 * @param	string $tpl
	 * @return	void
	 */
	function show_confirm_admin ( $form_action, $msg_title, $msg_txt, $hidden_fields_ary = array(), $tpl = 'admin/confirm_body.tpl' )
	{
		global $template, $lang;
		
		$template->set_filenames(array(
			'body' => $tpl,
			)
		);
		
		$template->assign_vars(array(
			'MESSAGE_TITLE'	=> $msg_title,
			'MESSAGE_TEXT'	=> $msg_txt,
		
			'L_YES'	=> $lang['Yes'],
			'L_NO'	=> $lang['No'],
		
			'S_CONFIRM_ACTION'	=> $form_action,
			'S_HIDDEN_FIELDS'	=> $this->make_hidden_fields( $hidden_fields_ary ),
			)
		);
		
		/**
		 * Parse it
		 */
		$template->pparse('body');
		
		return;
	}
	
	/**
	 * Get the auth permissions
	 *
	 * @global	array $userdata
	 * @return	auth array
	 */
	function check_logs_auth( )
	{
		global $userdata;
		
		if( !in_array( $userdata['user_id'], explode( ',', $this->config['log_super_admins'] ) ) )
		{
			$logs_auth['view']		= ( $this->config['log_admins_view'] ) ? true : false;
			$logs_auth['delete']	= ( $this->config['log_admins_del'] ) ? true : false;
			$logs_auth['config']	= ( $this->config['log_admins_config'] ) ? true : false;
		}
		else
		{
			$logs_auth = array(
				'view'		=> true,
				'delete'	=> true,
				'config'	=> true,
			);
		}
		
		return $logs_auth;
	}
}

?>
