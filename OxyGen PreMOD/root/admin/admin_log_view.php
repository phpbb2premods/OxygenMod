<?php
/** 
 * admin_log_view.php
 * 
 * @package		The Logger
 * @author		eviL3 <evil@phpbbmodders.net>
 * @author		Brainy
 * @copyright	(c) 2006 eviL3 and Brainy
 * @license		http://opensource.org/licenses/gpl-license.php GNU Public License
 * 
 */

define( 'IN_PHPBB', 1 );

if( !empty($setmodules) )
{
	$file = basename(__FILE__);
	$module['Logging']['Log_view']	= $file;
	return;
}

/**
 * Include default files
 */
$phpbb_root_path = './../';
$phpEx = substr(strrchr(__FILE__, '.'), 1);
require('./pagestart.' . $phpEx);

/**
 * Special logging stuff
 */
unset( $log );
include( "{$phpbb_root_path}includes/class_log_admin.$phpEx" );
$log = new log_handler_admin();

/**
 * Auth
 */
$log_auth = $log->check_logs_auth();

if( !$log_auth['view'] )
{
	message_die( GENERAL_MESSAGE, 'log_view_not_allowed' );
}

/**
 * Request variables (POST/GET)
 */
if ( isset( $HTTP_GET_VARS['type'] ) )
{
	$type = (int) $HTTP_GET_VARS['type'];
}
elseif ( isset( $HTTP_POST_VARS['type'] ) )
{
	$type = (int) $HTTP_POST_VARS['type'];
}
else
{
	$type = 3;
}

/**
 * Confirm and cancel
 */
$cancel		= ( isset($HTTP_POST_VARS['cancel']) )	? true : false;
$confirm	= ( isset($HTTP_POST_VARS['confirm']) )	? true : false;

/**
 * Set the mode
 */
if ( isset( $HTTP_POST_VARS['delete'] ) && sizeof( $HTTP_POST_VARS['deletelogs'] ) != 0 && $log_auth['delete'] )
{
	$mode = 'delete';
}
elseif ( isset( $HTTP_POST_VARS['deleteall'] ) && !$cancel && $log_auth['delete'] )
{
	$mode = 'deleteall';
}
else
{
	$mode = 'view';
}

/**
 * Start for the SQL
 */
$start = ( isset ( $HTTP_GET_VARS['start'] ) ) ? (int) $HTTP_GET_VARS['start'] : 0;

/**
 * The hidden fields for the form
 */
$hidden_fields_ary = array(
	'sid'	=> $userdata['session_id'],
	'type'	=> $type,
);

/**
 * Delete logs
 */
if ( $mode == 'delete' || $mode == 'deleteall' )
{
	if( $mode == 'delete' )
	{
		$del_ary	= $HTTP_POST_VARS['deletelogs'];
		$check		= $log->remove( $del_ary );
	}
	elseif( $mode == 'deleteall' )
	{
		if( !$confirm )
		{
			$log->show_confirm_admin( append_sid( "admin_log_view.$phpEx" ), $lang['Confirm'], $lang['log_confirm_deleteall'], array( 'deleteall' => true, 'type' => $type ) );

			$log->copyright();
			include('./page_footer_admin.'.$phpEx);
			
			exit;
		}
		
		$check		= $log->remove( '', $type );
	}
	
	if( $check )
	{
		$message = sprintf( $lang['log_logs_deleted'], '<a href="' . append_sid( "admin_log_view.$phpEx?type=$type" ) . '">', '</a>' );
	}
	else
	{
		$message = $lang['log_error_delete'];
	}
	
	message_die( GENERAL_MESSAGE, $message );
}
elseif( $mode == 'view' )
{
	/**
	 * Set a template file
	 */
	$template->set_filenames(array(
		'body' => 'admin/log_view_body.tpl')
	);

	$log_data = $log->view( $type, $start );
	
	if( sizeof( $log_data ) )
	{
		/**
		 * Check if this MOD exists:
		 * http://www.phpbb.com/phpBB/viewtopic.php?t=409711
		 */
		$lookup = 'http://www.nwtools.com/default.asp?host=';
		if( isset( $board_config['net_lookup'] ) )
		{
			$lookup = ( !empty( $board_config['net_lookup'] ) ) ? $board_config['net_lookup'] : $lookup;
		}
		
		/**
		 * Let's loop through the log data
		 */
		for( $i = 0; $i < sizeof( $log_data ); $i++ )
		{
			$log_id		= (int) $log_data[$i]['log_id'];
			$user_id	= (int) $log_data[$i]['user_id'];
			$username	= $log_data[$i]['username'];
			$user_ip	= decode_ip( $log_data[$i]['log_ip'] );

//-- mod : the logger - proxy detection ----------------------------------------
//-- add
			$user_ip_real	= (!empty($log_data[$i]['log_ip_real']) && ($log_data[$i]['log_ip_real'] != $log_data[$i]['log_ip']) ) ? decode_ip( $log_data[$i]['log_ip_real'] ) : '';
//-- fin mod : the logger - proxy detection ------------------------------------

			/**
			 * Check if this MOD exists:
			 * http://www.phpbb.com/phpBB/viewtopic.php?t=467168
			 */
			$user_gender = '';
			if( $log_data['user_gender'] )
			{
				switch ( $log_data[$i]['user_gender'] )
				{
					case GENDER_M:
						$user_gender_img	= $images['gender_m'];
						$l_user_gender		= $lang['gender_m'];
					break;
					
					case GENDER_F:
						$user_gender_img	= $images['gender_f'];
						$l_user_gender		= $lang['gender_f'];
					break;
					
					default:
						$user_gender_img	= $images['gender_x'];
						$l_user_gender		= $lang['gender_x'];
				}
				
				$user_gender = '<img src="' . $user_gender_img . '" alt="' . $l_user_gender . '" title="' . $l_user_gender . '" border="0" />';
			}
			
			/**
			 * Check if this MOD exists:
			 * http://www.phpbb.com/phpBB/viewtopic.php?t=459966
			 */
			$time = create_date( $userdata['user_dateformat'], $log_data[$i]['log_time'], $userdata['user_timezone'] );
			if( isset( $board_config['smart_dates_allow'] ) )
			{
				$time = create_date( $userdata['user_dateformat'], $log_data[$i]['log_time'], $userdata['user_timezone'], true );
			}
			
			/**
			 * Check if this MOD exists:
			 * http://www.phpbb.com/phpBB/viewtopic.php?t=416842
			 */
//-- mod : rank color system ---------------------------------------------------
//-- delete
/*-MOD
			$user_color = '';
			if( function_exists( 'color_groups' ) )
			{
				$user_color = ( $temp = color_groups_user($log_data[$i]['user_id']) ) ? 'style="font-weight:bold;color:' . $temp . '" ' : '';
			}
MOD-*/
//-- add
			$user_color = $rcs->get_colors($log_data[$i]);
//-- fin mod : rank color system -----------------------------------------------

			$username	= ( $user_id ) ? '<a href="' . append_sid( "{$phpbb_root_path}profile.$phpEx?mode=viewprofile&" . POST_USERS_URL . "=$user_id" ) . '"' . $user_color . '>' . $username . '</a>' : $lang['Guest'];
			
			/**
			 * Check if there's any log data provided
			 */
			if( !empty( $log_data[$i]['log_data'] ) )
			{
				$log_data[$i]['log_data'] = unserialize( $log_data[$i]['log_data'] );
				
				if( isset( $log_data[$i]['log_data']['post_id'] ) )
				{
					$temp = $log_data[$i]['log_data']['post_id'];
					$log_data[$i]['log_data']['post_id'] = '<a href="' . append_sid( "{$phpbb_root_path}viewtopic.php?p=" . $temp ) . "#$temp" . '">#</a>';
				}
						
				if( isset( $log_data[$i]['log_data']['user_id'] ) && isset( $log_data[$i]['log_data']['user'] ) && !empty( $log_data[$i]['log_data']['user_id'] ) && !empty( $log_data[$i]['log_data']['user'] ) )
				{
					$temp1 = $log_data[$i]['log_data']['user_id'];
					$temp2 = $log_data[$i]['log_data']['user'];
					$log_data[$i]['log_data']['user'] = '<a href="' . append_sid( "{$phpbb_root_path}profile.$phpEx?mode=viewprofile&" . POST_USERS_URL . "=$temp1", true ) . '">' . $temp2 . '</a>';
					unset( $log_data[$i]['log_data']['user_id'] );
				}
			}
			else
			{
				$log_data[$i]['log_data'] = array();
			}
			
			/**
			 * Add forum and topic data
			 */
			if ( !empty( $log_data[$i]['forum_id'] ) )
			{
				$log_data[$i]['log_data'][] = '<a href="' . append_sid( "{$phpbb_root_path}viewforum.php?t={$log_data[$i]['forum_id']}" ) . '">' . $log_data[$i]['forum_name'] . '</a>';
			}
			
			if ( !empty( $log_data[$i]['topic_id'] ) )
			{
				$log_data[$i]['log_data'][] = '<a href="' . append_sid( "{$phpbb_root_path}viewtopic.php?t={$log_data[$i]['topic_id']}" ) . '">' . $log_data[$i]['topic_title'] . '</a>';
			}
			
			$log_operation	= $lang[$log_data[$i]['log_operation']];
			$log_action		= ( $log_data[$i]['log_data'] ) ? vsprintf( $log_operation, $log_data[$i]['log_data'] ) : $log_operation;
			
			$row_class = ( !($i % 2) ) ? $theme['td_class1'] : $theme['td_class2'];
			
			/**
			 * Block variables
			 */
			$template->assign_block_vars( 'log_row', array(
				'ROW_CLASS'	=> $row_class,	
				
				'U_USER_PROFILE'	=> $u_user_profile,
				
				//Part of Gender addon
				'GENDER'		=> $user_gender,
				
				'USERNAME'		=> $username,
				'USER_IP'		=> $user_ip,
//-- mod : the logger - proxy detection ----------------------------------------
//-- add
				'USER_IP_REAL'		=> $user_ip_real,
//-- fin mod : the logger - proxy detection ------------------------------------
				'TIME'			=> $time,
				'ACTION'		=> $log_action,
				'ID'			=> $log_id,
				)
			);
		}
	}
	else
	{
		/**
		 * Show the "No logs exist" message
		 */
		$template->assign_block_vars( 'no_logs', array() );
	}
	
	$total_logs = $log->get_log_count( $type );
	
	/**
	 * Assign the global variables
	 */
	$template->assign_vars(array(
	
		'SWITCHBOX'	=> $log->make_viewselect ( basename(__FILE__), 'type', $type ),
		'LOG_TYPE'	=> $log->log_types_nummeric[$type],
		'PAGINATION'	=> generate_pagination("admin_log_view.{$phpEx}?mode=$mode&amp;type=$type", $total_logs, $log->config['log_view_per_page'], $start),
		
		'LOOKUP'	=> $lookup,
		
		'L_LOG_VIEW'			=> $lang['log_view'],
		'L_LOG_VIEW_EXPLAIN'	=> $lang['log_view_explain'],
		
		'L_USERNAME'	=> $lang['Username'],
		'L_USER_IP'		=> $lang['IP_Address'],
//-- mod : the logger - proxy detection ----------------------------------------
//-- add
		'L_USER_IP_REAL'		=> $lang['log_real_ip'],
//-- fin mod : the logger - proxy detection ------------------------------------
		'L_TIME'		=> $lang['Time'],
		'L_ACTION'		=> $lang['Action'],
		'L_MARK'		=> $lang['Mark'],
		
		'L_NO_LOGS'		=> $lang['Log_no_logs'],
		
		'L_MARK_ALL'	=> $lang['Mark_all'],
		'L_UNMARK_ALL'	=> $lang['Unmark_all'],
		
		'L_GO'		=> $lang['Go'],
		'L_SUBMIT'	=> $lang['Submit'],
		'L_DELETE'	=> $lang['Delete_marked'],
		'L_DELETE_ALL'	=> $lang['Delete_all'],
		'L_RESET'	=> $lang['Reset'],
		
		'S_FORM_ACTION'		=> append_sid( "admin_log_view.$phpEx" ),
		'S_FORM_GET_ACTION'	=> "admin_log_view.$phpEx",
		'S_HIDDEN_FIELDS'	=> $log->make_hidden_fields( $hidden_fields_ary ),
		)
	);
}


/**
 * Parse it
 */
$template->pparse('body');

/**
 * Credit is important!
 */
$log->copyright();

/**
 * Teh footer
 */
include('./page_footer_admin.'.$phpEx);

?>