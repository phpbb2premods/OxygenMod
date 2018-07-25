<?php
/**
*
* @version $Id: admin_quick_title.php,v 1.5.5a 2007/04/06 17:26:45 ABDev Exp $
* @copyright (c) 2007 ABDev, OxyGen Powered
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
*
* Original author : Xavier Olive, xavier@2037.biz, 2003
*/

/**
* begin process
*/
define('IN_PHPBB', 1);

if (!empty($setmodules))
{
	$file = basename(__FILE__);
	$module['General']['Attributes'] = $file;

	return;
}

/**
* Let's set the root dir for phpBB
*/
$phpbb_root_path = './../';
require($phpbb_root_path . 'extension.inc');
require('./pagestart.' . $phpEx);

$cancel = isset($HTTP_POST_VARS['cancel']) ? true : false;

if ($cancel)
{
	redirect('admin/' . append_sid('admin_quick_title.' . $phpEx, true));
}

/**
* Get parms
*/
if( isset($HTTP_GET_VARS['mode']) || isset($HTTP_POST_VARS['mode']) )
{
	$mode = ($HTTP_GET_VARS['mode']) ? $HTTP_GET_VARS['mode'] : $HTTP_POST_VARS['mode'];
	$mode = htmlspecialchars($mode);
}
$mode = ( _button('submit_form') ) ? 'save' : ( ( _button('cancel_form') ) ? '' : $mode );

/**
* _button() function from CH 2.1.x by Ptirhiik
*/
function _button($var)
{
	global $HTTP_POST_VARS, $HTTP_GET_VARS;

	// image buttons return an _x and _y value in the $_POST array
	if ( isset($HTTP_POST_VARS[$var . '_x']) && isset($HTTP_POST_VARS[$var . '_y']) )
	{
		$HTTP_POST_VARS[$var] = true;
		unset($HTTP_POST_VARS[$var . '_x']);
		unset($HTTP_POST_VARS[$var . '_y']);
	}
	return (isset($HTTP_POST_VARS[$var]) && !empty($HTTP_POST_VARS[$var])) || (isset($HTTP_GET_VARS[$var]) && intval($HTTP_GET_VARS[$var]));
}

if (!empty($mode))
{
	if ($mode == 'edit' || $mode == 'add')
	{
		/**
		* They want to add a new title info, show the form
		*/
		$attribute_id = ( isset($HTTP_GET_VARS['id']) ) ? intval($HTTP_GET_VARS['id']) : 0;
		$s_hidden_fields = '';

		if ($mode == 'edit')
		{
		  if (empty($attribute_id))
			{
				message_die(GENERAL_MESSAGE, $lang['Must_Select_Attribute']);
			}

			$sql = 'SELECT * FROM ' . ATTRIBUTES_TABLE . ' WHERE attribute_id = ' . intval($attribute_id);
			if(!$result = $db->sql_query($sql))
			{
				message_die(GENERAL_ERROR, 'Could not obtain attribute data', '', __LINE__, __FILE__, $sql);
			}

			$attribute = $db->sql_fetchrow($result);

			$attribute_tmp_order = $attribute['attribute_order'];

			$s_hidden_fields .= '<input type="hidden" name="id" value="' . $attribute_id . '" /><input type="hidden" name="attribute_tmp_order" value="' . $attribute_tmp_order . '" />';

			$template->assign_block_vars('edit', array(
				'L_ATTRIBUTE_EDIT' => sprintf($lang['Attribute_Edit'], $attribute['attribute_color'], ((isset($lang[$attribute['attribute']])) ? $lang[$attribute['attribute']] : $attribute['attribute'])),
				'L_ATTRIBUTE_EDIT_EXPLAIN' => $lang['Attribute_Edit_Explain'],
			));
		}
		else
		{
			$sql = 'SELECT attribute_id, attribute_order FROM ' . ATTRIBUTES_TABLE . ' ORDER BY attribute_order DESC LIMIT 1';
			if (!$result = $db->sql_query($sql))
			{
				message_die(GENERAL_ERROR, 'Could not select attribute fields', '', __LINE__, __FILE__, $sql);
			}
			$attribute_disp = $db->sql_fetchrow($result);

			$attribute_last_id = $attribute_disp['attribute_id'];
			$attribute_tmp_order = $attribute_disp['attribute_order'];
			$s_hidden_fields .= '<input type="hidden" name="attribute_tmp_order" value="' . $attribute_tmp_order . '" />';

			$attribute_tmp_order += 10;

			$template->assign_block_vars('add', array(
				'L_ATTRIBUTE_ADD' => $lang['New_Attribute'],
				'L_ATTRIBUTE_ADD_EXPLAIN' => $lang['New_Attribute_Explain'],
			));
		}

		$s_hidden_fields .= '<input type="hidden" name="mode" value="save" />';
		$template->set_filenames(array('body' => 'admin/title_edit_body.tpl'));

		$template->assign_vars(array(
			'ATTRIBUTE'				=> str_replace("\"", "'", $attribute['attribute']),
			'ADMINISTRATOR_CHECKED'	=> $attribute['attribute_administrator'] ? 'CHECKED' : '',
			'MODERATOR_CHECKED'		=> $attribute['attribute_moderator'] ? 'CHECKED' : '',
			'AUTHOR_CHECKED'		=> $attribute['attribute_author'] ? 'CHECKED' : '',
			'DATE_FORMAT'			=> $attribute['attribute_date_format'],
			'LEFT'					=> !$attribute['attribute_position'] ? 'checked="checked"' : '',
			'RIGHT'					=> $attribute['attribute_position'] ? 'checked="checked"' : '',
			'COLOR'					=> str_replace("\"", "'", $attribute['attribute_color']),

			'L_ATTRIBUTE'			=> $lang['Attribute'],
			'L_ATTRIBUTE_EXPLAIN'	=> $lang['Attribute_Explain'],

			'L_PERMISSIONS'			=> $lang['Attribute_Permissions'],
			'L_PERMISSIONS_EXPLAIN'	=> $lang['Attribute_Permissions_Explain'],
				'ADMINISTRATOR'		=> $lang['Administrator'],
				'MODERATOR'			=> $lang['Moderator'],
				'AUTHOR'			=> $lang['Author'],

			'L_DATE_FORMAT'			=> $lang['Date_format'],
			'L_DATE_FORMAT_EXPLAIN'	=> $lang['Date_format_explain'],

			'L_POSITION'			=> $lang['Attribute_Position'],
			'L_POSITION_EXPLAIN'	=> $lang['Attribute_Position_Explain'],
				'L_LEFT'			=> $lang['Left'],
				'L_RIGHT'			=> $lang['Right'],

			'L_COLOR'				=> $lang['Attribute_Color'],
			'L_COLOR_EXPLAIN'		=> $lang['Attribute_Color_Explain'],

			'L_SUBMIT'				=> $lang['Submit'],
			'L_RESET'				=> $lang['Reset'],

			'I_SUBMIT'				=> $phpbb_root_path . $images['cmd_submit'],
			'I_CANCEL'				=> $phpbb_root_path . $images['cmd_cancel'],

			'S_HIDDEN_FIELDS'		=> $s_hidden_fields,
			'S_ATTRIBUTE_ACTION'	=> append_sid('admin_quick_title.'.$phpEx),
		));
	}
	else if ($mode == 'save')
	{
		/**
		* Ok, they sent us our info, let's update it
		*/
		$attribute_id	= isset($HTTP_POST_VARS['id']) ? intval($HTTP_POST_VARS['id']) : 0;
		$attribute		= isset($HTTP_POST_VARS['attribute']) ? trim($HTTP_POST_VARS['attribute']) : '';
		$administrator	= $HTTP_POST_VARS['attribute_administrator'] ? 1 : 0;
		$moderator		= $HTTP_POST_VARS['attribute_moderator'] ? 1 : 0;
		$author			= $HTTP_POST_VARS['attribute_author'] ? 1 : 0;
		$date			= isset($HTTP_POST_VARS['attribute_date_format']) ? trim($HTTP_POST_VARS['attribute_date_format']) : '';
		$position		= empty($HTTP_POST_VARS['attribute_position']) ? 0 : 1;
		$color			= isset($HTTP_POST_VARS['attribute_color']) ? trim($HTTP_POST_VARS['attribute_color']) : '';
		$tmp_order		= isset($HTTP_POST_VARS['attribute_tmp_order']) ? intval($HTTP_POST_VARS['attribute_tmp_order']) : 0;
		$order			= isset($HTTP_POST_VARS['attribute_order']) ? (intval($HTTP_POST_VARS['attribute_order']) + 1) : $tmp_order;

		if (empty($attribute))
		{
			message_die(GENERAL_MESSAGE, $lang['Must_Select_Attribute']);
		}

		/**
		* Format hexa no valid - User error
		*/
		if (!empty($color))
		{
			if (!preg_match('/^[A-Fa-f0-9]+$/', $color) || strlen($color) != 6)
			{
				message_die(GENERAL_MESSAGE, '<br />' . $lang['Field_error'] . $lang['Attribute_Color']);
			}
		}

		if ($attribute_id)
		{
			$sql = 'UPDATE ' . ATTRIBUTES_TABLE . ' 
				SET attribute = \'' . str_replace("\'", "''", $attribute) . '\', attribute_color = \'' . str_replace("\'", "''", $color) . '\', attribute_date_format = \'' . str_replace("\'", "''", $date) . '\', attribute_position = ' . $position . ', attribute_administrator = ' . $administrator . ', attribute_moderator = ' . $moderator . ', attribute_author = ' . $author . ', attribute_order = ' . $order . '
				WHERE attribute_id = ' . intval($attribute_id);
			$message = $lang['Attribute_Updated'];
		}
		else
		{
			$new_order = $order - 1;
			$order = ($tmp_order == $new_order) ? $order + 9 : $order;

			$sql = 'INSERT INTO ' . ATTRIBUTES_TABLE . ' (attribute, attribute_color, attribute_administrator, attribute_moderator, attribute_author, attribute_date_format, attribute_position, attribute_order)
				VALUES (\'' . str_replace("\'", "''", $attribute) . '\',\'' . str_replace("\'", "''", $color) . '\', ' . $administrator . ', ' . $moderator . ', ' . $author . ', \'' . str_replace("\'", "''", $date) . '\', ' . $position . ', ' . $order . ')';
			$message = $lang['Attribute_Added'];
		}

		if (!$result = $db->sql_query($sql))
		{
			message_die(GENERAL_ERROR, 'Could not update/insert into attributes table', '', __LINE__, __FILE__, $sql);
		}

		if ($order != $tmp_order)
		{
			$sql = 'SELECT attribute_id FROM ' . ATTRIBUTES_TABLE . ' ORDER BY attribute_order';
			if (!$result = $db->sql_query($sql))
			{
				message_die(GENERAL_ERROR, 'Could not select id field', '', __LINE__, __FILE__, $sql);
			}

			$inc = 0;
			while ($row = $db->sql_fetchrow($result))
			{
				$inc += 10;
				$sql = 'UPDATE ' . ATTRIBUTES_TABLE . ' SET attribute_order = ' . $inc . ' WHERE attribute_id = ' . $row['attribute_id'];
				if (!$db->sql_query($sql))
				{
					message_die(GENERAL_ERROR, 'Could not update order fields', '', __LINE__, __FILE__, $sql);
				}
			}
			$db->sql_freeresult($result);
		}

		$message .= '<br /><br />' . sprintf($lang['Click_Return_Attributes_Management'], '<a href="' . append_sid('admin_quick_title.'.$phpEx) . '">', '</a>') . '<br /><br />' . sprintf($lang['Click_return_admin_index'], '<a href="' . append_sid('index.'.$phpEx . '?pane=right') . '">', '</a>');
		message_die(GENERAL_MESSAGE, $message);
	}
	else if ($mode == 'delete')
	{
		/**
		* Ok, they want to delete their title
		*/
		if (isset($HTTP_POST_VARS['id']) || isset($HTTP_GET_VARS['id']))
		{
			$attribute_id = (isset($HTTP_POST_VARS['id'])) ? intval($HTTP_POST_VARS['id']) : intval($HTTP_GET_VARS['id']);
		}
		else
		{
			$attribute_id = 0;
		}

		$confirm = isset($HTTP_POST_VARS['confirm']);

		if ($attribute_id && $confirm)
		{
			$sql = 'DELETE FROM ' . ATTRIBUTES_TABLE . ' WHERE attribute_id = ' . intval($attribute_id);
			if (!$result = $db->sql_query($sql))
			{
				message_die(GENERAL_ERROR, 'Could not delete attribute data', '', __LINE__, __FILE__, $sql);
			}

			$sql = 'SELECT attribute_id FROM ' . ATTRIBUTES_TABLE . ' ORDER BY attribute_order';
			if (!$result = $db->sql_query($sql))
			{
				message_die(GENERAL_ERROR, 'Could not select id field', '', __LINE__, __FILE__, $sql);
			}

			$inc = 0;
			while ($row = $db->sql_fetchrow($result))
			{
				$inc += 10;
				$sql = 'UPDATE ' . ATTRIBUTES_TABLE . ' SET attribute_order = ' . $inc . ' WHERE attribute_id = ' . $row['attribute_id'];
				if( !$db->sql_query($sql) )
				{
					message_die(GENERAL_ERROR, 'Could not update order fields', '', __LINE__, __FILE__, $sql);
				}
			}
			$db->sql_freeresult($result);

			$message = $lang['Attribute_Removed'] . '<br /><br />' . sprintf($lang['Click_Return_Attributes_Management'], '<a href="' . append_sid('admin_quick_title.'.$phpEx) . '">', '</a>') . '<br /><br />' . sprintf($lang['Click_return_admin_index'], '<a href="' . append_sid('index.'.$phpEx . '?pane=right') . '">', '</a>');
			message_die(GENERAL_MESSAGE, $message);
		}
		elseif ($attribute_id && !$confirm)
		{
			/**
			* Present the confirmation screen to the user
			*/
			$template->set_filenames(array('body' => 'admin/confirm_body.tpl'));

			$hidden_fields = '<input type="hidden" name="mode" value="delete" /><input type="hidden" name="id" value="' . $attribute_id . '" />';

			$template->assign_vars(array(
				'MESSAGE_TITLE'		=> $lang['Confirm'],
				'MESSAGE_TEXT'		=> $lang['Attribute_Confirm_Delete'],
				'L_YES'				=> $lang['Yes'],
				'L_NO'				=> $lang['No'],
				'S_CONFIRM_ACTION'	=> append_sid('admin_quick_title.' . $phpEx),
				'S_HIDDEN_FIELDS'	=> $hidden_fields,
			));
		}
		else
		{
			message_die(GENERAL_MESSAGE, $lang['Must_Select_Attribute']);
		}
	}
	else if ($mode == 'moveup' || $mode == 'movedw')
	{
		$inc = ($mode == 'movedw') ? +15 : -15;
		$attribute_id = (isset($HTTP_GET_VARS['id'])) ? intval($HTTP_GET_VARS['id']) : 0;

		if ( empty($attribute_id) )
		{
			$message = $lang['Must_Select_Attribute'] . '<br /><br />' . sprintf($lang['Click_Return_Attributes_Management'], '<a href="' . append_sid('admin_quick_title.' . $phpEx) . '">', '</a>') . '<br /><br />' . sprintf($lang['Click_return_admin_index'], '<a href="' . append_sid('index.' . $phpEx . '?pane=right') . '">', '</a>');
			message_die(GENERAL_MESSAGE, $message);
		}

		$sql = 'UPDATE ' . ATTRIBUTES_TABLE . ' SET attribute_order = attribute_order + ' . $inc . ' WHERE attribute_id = ' . $attribute_id;
		if( !$db->sql_query($sql) )
		{
			message_die(GENERAL_ERROR, 'Could not update order fields', '', __LINE__, __FILE__, $sql);
		}

		$sql = 'SELECT attribute_id FROM ' . ATTRIBUTES_TABLE . ' ORDER BY attribute_order';
		if (!$result = $db->sql_query($sql))
		{
			message_die(GENERAL_ERROR, 'Could not select id field', '', __LINE__, __FILE__, $sql);
		}

		$inc = 0;
		while ( $row = $db->sql_fetchrow($result) )
		{
			$inc += 10;
			$sql = 'UPDATE ' . ATTRIBUTES_TABLE . ' SET attribute_order = ' . $inc . ' WHERE attribute_id = ' . $row['attribute_id'];
			if( !$db->sql_query($sql) )
			{
				message_die(GENERAL_ERROR, 'Could not update order fields', '', __LINE__, __FILE__, $sql);
			}
		}
		$db->sql_freeresult($result);

		$message = $lang['Attribute_Order_Updated'] . '<br /><br />' . sprintf($lang['Click_Return_Attributes_Management'], '<a href="' . append_sid('admin_quick_title.' . $phpEx) . '">', '</a>') . '<br /><br />' . sprintf($lang['Click_return_admin_index'], '<a href="' . append_sid('index.' . $phpEx . '?pane=right') . '">', '</a>');
		message_die(GENERAL_MESSAGE, $message);
	}
	else
	{
		/**
		* They didn't feel like giving us any information. Oh, too bad, we'll just display the list then...
		*/
		$template->set_filenames(array('body' => 'admin/title_list_body.tpl'));

		$sql = 'SELECT * FROM ' . ATTRIBUTES_TABLE . ' ORDER BY attribute_order ASC';
		if (!$result = $db->sql_query($sql))
		{
			message_die(GENERAL_ERROR, 'Could not obtain attribute data', '', __LINE__, __FILE__, $sql);
		}

		$attribute_rows  = $db->sql_fetchrowset($result);
		$attribute_count = count($attribute_rows);

		for ($i = 0; $i < $attribute_count; $i++)
		{
			$row_color		= ( !($i % 2) ) ? $theme['td_color1'] : $theme['td_color2'];
			$row_class		= ( !($i % 2) ) ? $theme['td_class1'] : $theme['td_class2'];

			$attribute_id	= $attribute_rows[$i]['attribute_id'];
			$attribute		= isset($lang[$attribute_rows[$i]['attribute']]) ? $lang[$attribute_rows[$i]['attribute']] : $attribute_rows[$i]['attribute'];
			$permissions	= $attribute_rows[$i]['attribute_administrator'] ? $lang['Administrator'] . '<br />' : '';
			$permissions	.= $attribute_rows[$i]['attribute_moderator'] ? $lang['Moderator'] . '<br />' : '';
			$permissions	.= $attribute_rows[$i]['attribute_author'] ? $lang['Author'] : '';
			$position		= !$attribute_rows[$i]['attribute_position'] ? 0 : 1;

			$template->assign_block_vars('attribute', array(
				'ROW_COLOR'				=> '#' . $row_color,
				'ROW_CLASS'				=> $row_class,

				'ATTRIBUTE'				=> $attribute,
				'COLOR'					=> trim($attribute_rows[$i]['attribute_color']),
				'PERMISSIONS'			=> $permissions,
				'DATE_FORMAT'			=> $attribute_rows[$i]['attribute_date_format'],
				'POSITION'				=> $position,

				'U_ATTRIBUTE_EDIT'		=> append_sid('admin_quick_title.' . $phpEx . '?mode=edit&amp;id=' . $attribute_id),
				'U_ATTRIBUTE_DELETE'	=> append_sid('admin_quick_title.' . $phpEx . '?mode=delete&amp;id=' . $attribute_id),
			));
		}
	}
}
else
{
	/**
	* Show the default page
	*/
	$template->set_filenames(array('body' => 'admin/title_list_body.tpl'));

	$sql = 'SELECT * FROM ' . ATTRIBUTES_TABLE . ' ORDER BY attribute_order ASC';
	if (!$result = $db->sql_query($sql))
	{
		message_die(GENERAL_ERROR, 'Could not obtain attribute data', '', __LINE__, __FILE__, $sql);
	}
		
	$attribute_rows  = $db->sql_fetchrowset($result);
	$attribute_count = count($attribute_rows);

	$sql = 'SELECT count(*) AS total FROM ' . ATTRIBUTES_TABLE;
	if (!$result = $db->sql_query($sql)) 
	{ 
	  message_die(GENERAL_ERROR, 'Error getting total informations for attribute', '', __LINE__, __FILE__, $sql); 
	}

	$template->assign_vars(array(
		'L_ATTRIBUTE_MANAGEMENT'	=> $lang['Attributes_System'],
		'L_ATTRIBUTE_EXPLAIN'		=> $lang['Attributes_System_Explain'],
		'L_ATTRIBUTE'				=> $lang['Attribute'],
		'L_COLOR'					=> $lang['Attribute_Color'],
		'L_PERMISSIONS'				=> $lang['Attribute_Permissions'],
		'L_DATE_FORMAT'				=> $lang['Date_format'],
		'L_POSITION'				=> $lang['Attribute_Position'],
		'L_MOVEUP'					=> $lang['Move_up'],
		'L_MOVEDW'					=> $lang['Move_down'],
		'L_CREATE'					=> $lang['Create_new'],
		'L_ACTION'					=> $lang['Action'],

		'I_MOVEUP'					=> $phpbb_root_path . $images['cmd_up_arrow'],
		'I_MOVEDW'					=> $phpbb_root_path . $images['cmd_down_arrow'],
		'I_DELETE'					=> $phpbb_root_path . $images['cmd_delete'],
		'I_EDIT'					=> $phpbb_root_path . $images['cmd_edit'],
		'I_CREATE'					=> $phpbb_root_path . $images['cmd_create'],

		'U_ATTRIBUTE_CREATE'		=> append_sid('admin_quick_title.' . $phpEx . '?mode=add'),
		'S_ATTRIBUTE_ACTION'		=> append_sid('admin_quick_title.' . $phpEx),
	));

	for ($i = 0; $i < $attribute_count; $i++)
	{
		$row_color		= ( !($i % 2) ) ? $theme['td_color1'] : $theme['td_color2'];
		$row_class		= ( !($i % 2) ) ? $theme['td_class1'] : $theme['td_class2'];

		$attribute_id 	= $attribute_rows[$i]['attribute_id'];
		$attribute		= isset($lang[$attribute_rows[$i]['attribute']]) ? $lang[$attribute_rows[$i]['attribute']] : $attribute_rows[$i]['attribute'];
		$color			= $attribute_rows[$i]['attribute_color'] ? trim($attribute_rows[$i]['attribute_color']) : $lang['Attribute_None'];
		$permissions	= $attribute_rows[$i]['attribute_administrator'] ? $lang['Administrator'] . '<br />' : '';
		$permissions	.= $attribute_rows[$i]['attribute_moderator'] ? $lang['Moderator'] . '<br />' : '';
		$permissions	.= $attribute_rows[$i]['attribute_author'] ? $lang['Author'] : '';
		$date_format	= $attribute_rows[$i]['attribute_date_format'] ? $attribute_rows[$i]['attribute_date_format'] : $lang['Attribute_None'];
		$position		= !$attribute_rows[$i]['attribute_position'] ? $lang['Left'] : $lang['Right'];

		$template->assign_block_vars('attribute', array(
			'ROW_COLOR'				=> '#' . $row_color,
			'ROW_CLASS'				=> $row_class,

			'ATTRIBUTE'				=> '<b style="color:#' . $color . '">' . $attribute . '</b>',
			'COLOR'					=> $color,
			'PERMISSIONS'			=> $permissions,
			'DATE_FORMAT'			=> $date_format,
			'POSITION'				=> $position,

			'U_ATTRIBUTE_MOVEUP'	=> append_sid('admin_quick_title.' . $phpEx . '?mode=moveup&amp;id=' . $attribute_id),
			'U_ATTRIBUTE_MOVEDW'	=> append_sid('admin_quick_title.' . $phpEx . '?mode=movedw&amp;id=' . $attribute_id),
			'U_ATTRIBUTE_EDIT'		=> append_sid('admin_quick_title.' . $phpEx . '?mode=edit&amp;id=' . $attribute_id),
			'U_ATTRIBUTE_DELETE'	=> append_sid('admin_quick_title.' . $phpEx . '?mode=delete&amp;id=' . $attribute_id),
		));
	}
}

$template->pparse('body');

include('./page_footer_admin.'.$phpEx);

?>
