<?php
/***************************************************************************
 *						external_hosting.php
 *						------------------------
 *	begin				: 10/09/2005
 *	copyright			: Budman	
 *	email				: n/a
 *
 *	version				: 0.0.1 - 10/09/2005
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

if ( !defined('IN_PHPBB') )
{
   die("Hacking attempt");
}

//
// set template name
//
$template->set_filenames(array('ext_host_box' => 'posting_ext_host.tpl'));

//
// query the db for external hosters
//
$sql = "SELECT *
		FROM " . EXT_HOST_TABLE . "
		WHERE ext_enabled = 1
			ORDER BY ext_ub ASC, ext_name ASC";
		
if ( !$result = $db->sql_query($sql) )
{
	message_die(CRITICAL_ERROR, "Could not query external hosts information", "", __LINE__, __FILE__, $sql);
}
else
{
	while( $row = $db->sql_fetchrow($result) )
	{
		$exthost_ubc = htmlspecialchars_decode_php4($row['ext_ubc']);
		
		if ( !$row['ext_enabled'] == 0 )
		{
			$template->assign_block_vars('hoster_row', array(
				'L_EXT_HOST_NAME' => $row['ext_name'],
				'U_EXT_HOST_URL' => $row['ext_url'],
				'L_EXT_HOST_UBC' => $exthost_ubc
				)
			);
			
			if ( $row['ext_ub'] == 0 )
			{
				$template->assign_block_vars('hoster_row.switch_link', array() );
			}
			else
			{
				$template->assign_block_vars('hoster_row.switch_ubc', array() );
			}
		}
	}
}

//
// send titles and explain
//
$template->assign_vars(array(
	'L_EXT_HOST_TITLE' => $lang['ext_hosting_title'],
	'L_EXT_HOST_EXPLAIN' => $lang['ext_host_explain'],
	'L_EXT_HOST_BUTTON' => $lang['ext_host_button']
	)
);

//
// sent the display
//
$template->assign_var_from_handle('EXT_HOSTBOX', 'ext_host_box');

//
// html decode chars
//
function htmlspecialchars_decode_php4 ($str, $quote_style = ENT_COMPAT) 
{
   return strtr($str, array_flip(get_html_translation_table(HTML_SPECIALCHARS, $quote_style)));
}

?>