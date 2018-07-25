<?php
/** 
 * admin_log_config.php
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
	$module['Logging']['Configuration'] = $file;
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

if( !$log_auth['config'] )
{
	message_die( GENERAL_MESSAGE, 'log_config_not_allowed' );
}

/**
 * Pull all logging config data
 * This taken from admin_board.php
 */
$sql = 'SELECT *
	FROM ' . LOG_CONFIG_TABLE;

if(!$result = $db->sql_query($sql))
{
	message_die(CRITICAL_ERROR, 'Could not query config information for Logging Config', '', __LINE__, __FILE__, $sql);
}
else
{
	while( $row = $db->sql_fetchrow($result) )
	{
		$config_name	= $row['config_name'];
		$config_value	= $row['config_value'];
		$default_config[$config_name] = isset($HTTP_POST_VARS['submit']) ? str_replace("'", "\'", $config_value) : $config_value;
		
		$new[$config_name] = ( isset($HTTP_POST_VARS[$config_name]) ) ? $HTTP_POST_VARS[$config_name] : $default_config[$config_name];

		if( isset($HTTP_POST_VARS['submit']) )
		{
			$sql = 'UPDATE ' . LOG_CONFIG_TABLE . " SET
				config_value = '" . str_replace("\'", "''", $new[$config_name]) . "'
				WHERE config_name = '$config_name'";
			if( !$db->sql_query($sql) )
			{
				message_die(GENERAL_ERROR, "Failed to update general configuration for $config_name", '', __LINE__, __FILE__, $sql);
			}
		}
	}

	if( isset($HTTP_POST_VARS['submit']) )
	{
		if( $log->config['log_admin_config'] )
		{
			$log->insert( LOG_TYPE_ADMIN, 'LOG_A_UPDATE_LOG_CONFIG' );
		}
		
		$message = $lang['Config_updated'] . '<br /><br />' . sprintf($lang['log_click_return_config'], '<a href="' . append_sid("admin_log_config.$phpEx") . '">', '</a>') . '<br /><br />' . sprintf($lang['Click_return_admin_index'], '<a href="' . append_sid("index.$phpEx?pane=right") . '">', '</a>');
		message_die(GENERAL_MESSAGE, $message);
	}
}


/**
 * This is used for the (Disabled) part in the cat titles.
 * It's in following format:
 * -----
 * $new => $remind
 * -----
 * $new is the config value, and 'log_error_log_config' is
 * the language entry for that title.
 */
$remind_ary = array(
	'log_user'	=> 'log_user_log_config',
	'log_mod'	=> 'log_mod_mog_config',
	'log_admin'	=> 'log_admin_log_config',
	'log_error'	=> 'log_error_log_config',
);
while( list( $key, $val ) = each( $remind_ary ) )
{
	$remind[$val]	= ( !$new[$key] ) ? true : false;
}


/**
 * Get all config options
 */
$logging_options = $log->read_options( $log->config_cfg );

/**
 * Loop through the array specified before
 */
for( $i = 0; $i < sizeof($logging_options); $i++ )
{
	$template->assign_block_vars( 'log', array() );
	
	if ( isset( $logging_options[$i]['title'] ) && isset( $lang[$logging_options[$i]['title']] ) )
	{
		$temp_title		= $logging_options[$i]['title'];
		$opt_cat_title	= $lang[$temp_title];
		
		if( $remind[$temp_title] )
		{
			$opt_cat_title .= ' (' . $lang['Disabled'] . ')';
		}
	}

	if ( isset( $opt_cat_title ) )
	{
		$template->assign_block_vars( 'log.title', array(
			'title' => $opt_cat_title)
		);
		
		if ( isset( $lang[$logging_options[$i]['title'] . '_explain'] ) )
		{
			$template->assign_block_vars( 'log.title.desc', array(
				'desc' => $lang[$logging_options[$i]['title'] . '_explain'])
			);
		}
	}
	
	for( $j = 0; $j < sizeof($logging_options[$i]['content']); $j++ )
	{
		$type	= ( isset( $logging_options[$i]['content'][$j]['type'] ) ) ? $logging_options[$i]['content'][$j]['type'] : '';
		$entry	= $logging_options[$i]['content'][$j]['entry'];
		
		switch( $type )
		{
			case 'text':
				$tpl_switch[0] = 'text';

				$tpl_switch[1] = array(
					'value'	=> htmlspecialchars( $new[$entry] ),
				);
			break;
			
			case 'string':
				$tpl_switch[0] = 'string';
				
				$tpl_switch[1] = array(
					'value'	=> htmlspecialchars( $new[$entry] ),
				);
			break;
			
			case 'bigstring':
				$tpl_switch[0] = 'bigstring';
				
				$tpl_switch[1] = array(
					'value'	=> htmlspecialchars( $new[$entry] ),
				);
			break;
			
			case 'hidden':
				$hidden_fields_ary[$entry] = $new[$entry];
				$no_tpl = true;
			break;
			
			case 'bool':
			default:
				$tpl_switch = array( 'bool', array(
					'select_yes'	=> ( $new[$entry] )	? ' checked="checked"' : '',
					'select_no'		=> ( !$new[$entry] )	? ' checked="checked"' : '',
					)
				);
			break;
		}
		
		if ( !$no_tpl )
		{
			$template->assign_block_vars( 'log.row', array(
				'title'			=> $lang[$entry],
				'name'			=> $entry,
				)
			);
			
			$template->assign_block_vars( 'log.row.' . $tpl_switch[0], $tpl_switch[1] );
			
			if( isset( $lang[$entry . '_explain'] ) )
			{
				$template->assign_block_vars( 'log.row.desc', array(
					'desc' => $lang[$entry . '_explain'])
				);
			}
		}
		else
		{
			$no_tpl = false;
		}
	}
}


/**
 * Set the template file
 */
$template->set_filenames(array(
	'body' => 'admin/log_config_body.tpl')
);

/**
 * Assign some template variables
 */
$template->assign_vars( array(
	'S_CONFIG_ACTION' => append_sid("admin_log_config.$phpEx"),

	'L_ENABLED'		=> $lang['Enabled'],
	'L_DISABLED'	=> $lang['Disabled'],
	'L_SUBMIT'		=> $lang['Submit'], 
	'L_RESET'		=> $lang['Reset'], 
	
	'L_CONFIGURATION_TITLE'		=> $lang['log_config'],
	'L_CONFIGURATION_EXPLAIN'	=> $lang['log_config_explain'],
	'S_HIDDEN_FIELDS'			=> $log->make_hidden_fields( $hidden_fields_ary ),
	)
);

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