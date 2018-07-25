<?php
/***************************************************************************
*                               admin_smilies.php
*                              -------------------
*     begin                : Wed January 28, 2004
*     copyright            : (C) 2001 The phpBB Group, Afkamm
*     email                : support@phpbb.com, phpbb@afkamm.co.uk
*     website		   : http://www.phpbb.com, http://mods.afkamm.co.uk
*
*     Some code on this page belongs to The phpBB group, which is
*     why I've listed them in the copyright field above. - Afkamm :)
*
****************************************************************************/

define('IN_PHPBB', 1);

//
// First we do the setmodules stuff for the admin cp.
//
if (!empty($setmodules))
{
	$file = basename(__FILE__);
	$module['General']['smiley_categories'] = $file;

	return;
}

//
// Load the default header for when you create a exported *.pak file.
//
if( isset($HTTP_GET_VARS['export_pack']) )
{
	if( $HTTP_GET_VARS['export_pack'] == "send" )
	{	
		$no_page_header = true;
	}
}

//
// Paths and included files...... well duh.
//
$phpbb_root_path = "./../";
require($phpbb_root_path . 'extension.inc');
require('./pagestart.' . $phpEx);

//
// Check to see what mode we should operate in.
//
if( isset($HTTP_POST_VARS['mode']) || isset($HTTP_GET_VARS['mode']) )
{
	$mode = ( isset($HTTP_POST_VARS['mode']) ) ? $HTTP_POST_VARS['mode'] : $HTTP_GET_VARS['mode'];
}
else
{
	$mode = "";
}

//
// Used to separate the smiley fields for import/export *.pak files..
//
$delimeter  = '=+:';

//
// Function for reading the smilies/paks in the smiley directory.
//
function read_smiles_directory($path)
{
	global $smiley_images, $smiley_paks, $phpbb_root_path;

	$dir = $phpbb_root_path . $path;
	$dir2 = @opendir($dir);

	$array_count = 0;
	while( $file = @readdir($dir2) )
	{
		if( !@is_dir(phpbb_realpath($dir . '/' . $file)) )
		{
			$img_size = @getimagesize($dir . '/' . $file);

			if( $img_size[0] && $img_size[1] )
			{
				$smiley_images[] = $file;
				$array_count++;
			}
			else if( eregi('.pak$', $file) )
			{	
				$smiley_paks[] = $file;
			}
			else if( eregi('.pak2$', $file) )
			{	
				$smiley_paks[] = $file;
			}
		}
	}

	@closedir($dir);

	// Sorting an empty array sends out a PHP error message. :-/
	if( $array_count )
	{
		sort($smiley_images);
	}
}

//
// Get all the data for the categories and put them into arrays.
//
$sql = "SELECT *
	FROM " . SMILIES_CAT_TABLE . "
	ORDER BY cat_order
	ASC";
if( $result = $db->sql_query($sql) )
{
	$num_cats = 0;

	$array_cat_data = array();

	while( $cats = $db->sql_fetchrow($result) )
	{
		// Note to self, multi-array is ordered by cat_order 
		// and because arrays start at '0', use '-1' to get correct data!

		$array_cat_data[$num_cats]['cat_id'] = $cats['cat_id'];
		$array_cat_data[$num_cats]['cat_name'] = stripslashes($cats['cat_name']);
		$array_cat_data[$num_cats]['description'] = stripslashes($cats['description']);
		$array_cat_data[$num_cats]['cat_order'] = $cats['cat_order'];
		$array_cat_data[$num_cats]['cat_perms'] = $cats['cat_perms'];
		$array_cat_data[$num_cats]['cat_forum'] = $cats['cat_forum'];
		$array_cat_data[$num_cats]['cat_category'] = $cats['cat_category'];
		$array_cat_data[$num_cats]['cat_icon_url'] = $cats['cat_icon_url'];
		$array_cat_data[$num_cats]['smilies_per_page'] = $cats['smilies_per_page'];
		$array_cat_data[$num_cats]['smilies_popup'] = $cats['smilies_popup'];

		$num_cats++;
	}
}
else
{
	message_die(GENERAL_ERROR, "Couldn't obtain smiley category data for arrays from database", "", __LINE__, __FILE__, $sql);
}

//
// Select main mode
//
if( isset($HTTP_GET_VARS['import_pack']) || isset($HTTP_POST_VARS['import_pack']) )
{
	//
	// Admin is importing a list, a "Smiley Pack"
	//
	$smile_pak = ( isset($HTTP_POST_VARS['smile_pak']) ) ? $HTTP_POST_VARS['smile_pak'] : '';
	$cat_order = ( isset($HTTP_POST_VARS['import_cat']) ) ? intval($HTTP_POST_VARS['import_cat']) : '';
	$delete_smiley = ( isset($HTTP_POST_VARS['del_smiley']) ) ? intval($HTTP_POST_VARS['del_smiley']) : '';
	$delete_all = ( isset($HTTP_POST_VARS['del_all']) ) ? intval($HTTP_POST_VARS['del_all']) : '';
	$replace_existing = ( isset($HTTP_POST_VARS['replace']) ) ? intval($HTTP_POST_VARS['replace']) : '';

	list($name, $ext) = explode(".", $smile_pak);

	if( !empty($ext) && $ext == "pak" )
	{
		// Delete existing smilies before importing?
		if( $delete_smiley )
		{
			$sql = "DELETE FROM " . SMILIES_TABLE . "
				WHERE cat_id = " . $cat_order;
			$result = $db->sql_query($sql);
			if( !$result ) { message_die(GENERAL_ERROR, "Couldn't delete current smilies.", "", __LINE__, __FILE__, $sql); }

			$order_num = 0;
		}
		else
		{
			// Put all the codes for the category in an array.
			$sql = "SELECT code
				FROM " . SMILIES_TABLE . "
				WHERE cat_id = " . $cat_order;
			$result = $db->sql_query($sql);
			if( !$result ) { message_die(GENERAL_ERROR, "Couldn't get current smilies.", "", __LINE__, __FILE__, $sql); }
			$cur_smilies = $db->sql_fetchrowset($result);

			$order_num = count($cur_smilies);

			for( $i=0; $i<$order_num; $i++ )
			{
				$k = $cur_smilies[$i]['code'];
				$smiles[$k] = 1;
			}
		}

		// Open file, read contents.
		$fcontents = @file($phpbb_root_path . $board_config['smilies_path'] . '/'. $smile_pak);

		if( empty($fcontents) )
		{
			message_die(GENERAL_ERROR, "Couldn't read smiley pak file", "", __LINE__, __FILE__, $sql);
		}

		$replace_count = 0;
		$add_count = 0;

		for( $i=0; $i<count($fcontents); $i++ )
		{
			// Take each line and separate the fields.
			$smile_data = explode($delimeter, trim(addslashes($fcontents[$i])));

			for( $j=2; $j<count($smile_data); $j++ )
			{
				//
				// Replace > and < with the proper html_entities for matching.
				//
				$smile_data[$j] = str_replace("<", "&lt;", $smile_data[$j]);
				$smile_data[$j] = str_replace(">", "&gt;", $smile_data[$j]);
				$k = $smile_data[$j];

				if( $smiles[$k] == 1 )
				{
					// What should be done if there are conflicts?
					if( $replace_existing )
					{
						// Replace existing smiley.
						$sql = "UPDATE " . SMILIES_TABLE . " 
							SET smile_url = '" . str_replace("\'", "''", $smile_data[0]) . "', emoticon = '" . str_replace("\'", "''", $smile_data[1]) . "' 
							WHERE code = '" . str_replace("\'", "''", $smile_data[$j]) . "'
								AND cat_id = " . $cat_order;
						$result = $db->sql_query($sql);
						if( !$result ) { message_die(GENERAL_ERROR, "Couldn't update smiley database", "", __LINE__, __FILE__, $sql); }

						$replace_count++;
					}
				}
				else
				{
					// Add new smiley.
					$order_num++;

					$sql = "INSERT INTO " . SMILIES_TABLE . " (code, smile_url, emoticon, cat_id, smilies_order)
						VALUES('" . str_replace("\'", "''", $smile_data[$j]) . "', '" . str_replace("\'", "''", $smile_data[0]) . "', '" . str_replace("\'", "''", $smile_data[1]) . "', '" . $cat_order . "', '" . $order_num . "')";
					$result = $db->sql_query($sql);
					if( !$result ) { message_die(GENERAL_ERROR, "Couldn't insert smiley into database", "", __LINE__, __FILE__, $sql); }

					$add_count++;
				}
			}
		}

		$smiles = ( $add_count == 0 || $add_count >= 2 ) ? $lang['smilies'] : $lang['smiley'];

		$message = sprintf($lang['smiley_import_success1'], $add_count, $smiles, $replace_count) . "<br /><br />" . sprintf($lang['Click_return_catadmin'], "<a href=\"" . append_sid("admin_smilies.$phpEx") . "\">", "</a>");

	}
	else if( !empty($ext) && $ext == "pak2" )
	{
		// Delete all categories and smilies before importing.
		if( $delete_all )
		{
			$sql = "TRUNCATE " . SMILIES_TABLE;
			$result = $db->sql_query($sql);
			if( !$result ) { message_die(GENERAL_ERROR, "Couldn't delete smilies.", "", __LINE__, __FILE__, $sql); }

			$sql = "TRUNCATE " . SMILIES_CAT_TABLE;
			$result = $db->sql_query($sql);
			if( !$result ) { message_die(GENERAL_ERROR, "Couldn't delete categories.", "", __LINE__, __FILE__, $sql); }

			$num_cats = 0;
		}

		// Open file, read contents.
		$fcontents = @file($phpbb_root_path . $board_config['smilies_path'] . '/'. $smile_pak);

		if( empty($fcontents) )
		{
			message_die(GENERAL_ERROR, "Couldn't read smiley pak file", "", __LINE__, __FILE__, $sql);
		}

		$cat_count = 0;
		$order_array = array();

		// Import the categories.
		for( $i=0; $i<count($fcontents); $i++ )
		{
			if( ($fcontents[$i]{0} == '#') && ($fcontents[$i]{1} != '#') )
			{
				// Take each line and separate the fields.
				$cat_data = explode($delimeter, trim(addslashes($fcontents[$i])));

				$num_cats++;
				$cat_data[0] = str_replace('#', '', $cat_data[0]);

				$sql = "INSERT INTO " . SMILIES_CAT_TABLE . " (cat_name, description, cat_order, cat_perms, cat_forum, cat_category, cat_icon_url, smilies_per_page, smilies_popup)
					VALUES ('" . str_replace("\'", "''", $cat_data[0]) . "','" . str_replace("\'", "''", $cat_data[1]) . "','" . $num_cats . "','" . $cat_data[3] . "','" . $cat_data[4] . "','" . $cat_data[5] . "','" . str_replace("\'", "''", $cat_data[6]) . "','" . $cat_data[7] . "','" . $cat_data[8] . "')";
				if( !$result = $db->sql_query($sql) )
				{
					message_die(GENERAL_ERROR, "Couldn't insert new category into database.", "", __LINE__, __FILE__, $sql);
				}
				else
				{
					$cat_count++;
					$order_array[$cat_data[2]] = $num_cats;
				}
			}
		}

		$smiley_count = 0;

		// Import the smilies.
		for( $i=0; $i<count($fcontents); $i++ )
		{
			if( $fcontents[$i]{0} != '#' )
			{
				// Take each line and separate the fields.
				$smile_data = explode($delimeter, trim(addslashes($fcontents[$i])));

				$sql = "INSERT INTO " . SMILIES_TABLE . " (code, smile_url, emoticon, cat_id, smilies_order)
					VALUES('" . str_replace("\'", "''", $smile_data[2]) . "', '" . str_replace("\'", "''", $smile_data[0]) . "', '" . str_replace("\'", "''", $smile_data[1]) . "', '" . $order_array[$smile_data[3]] . "', '" . $smile_data[4] . "')";
				if( !$result = $db->sql_query($sql) )
				{
					message_die(GENERAL_ERROR, "Couldn't insert smiley into database", "", __LINE__, __FILE__, $sql);
				}
				else
				{
					$smiley_count++;
				}
			}
		}

		$cats = ( $cat_count == 0 || $cat_count >= 2 ) ? $lang['categories'] : $lang['category'];
		$smiles = ( $smiley_count == 0 || $smiley_count >= 2 ) ? $lang['smilies'] : $lang['smiley'];

		$message = sprintf($lang['smiley_import_success2'], $cat_count, $cats, $smiley_count, $smiles) . "<br /><br />" . sprintf($lang['Click_return_catadmin'], "<a href=\"" . append_sid("admin_smilies.$phpEx") . "\">", "</a>");

	}
	else
	{
		$message = $lang['smiley_import_fail'] . "<br /><br />" . sprintf($lang['Click_return_catadmin'], "<a href=\"" . append_sid("admin_smilies.$phpEx") . "\">", "</a>");
	}

	message_die(GENERAL_MESSAGE, $message);	

}
else if( isset($HTTP_POST_VARS['export_pack']) || isset($HTTP_GET_VARS['export_pack']) )
{
	//
	// Admin has selected to export a smiley pak.
	//
	$cat_order = ( isset($HTTP_POST_VARS['export_cat']) ) ? intval($HTTP_POST_VARS['export_cat']) : intval($HTTP_GET_VARS['cat']);
	$export_type = ( isset($HTTP_POST_VARS['export_type']) ) ? intval($HTTP_POST_VARS['export_type']) : intval($HTTP_GET_VARS['type']);

	if( $HTTP_GET_VARS['export_pack'] == "send" )
	{
		if( $export_type )
		{
			// Contains category data.
			if( $cat_order )
			{
				$sql1 = "SELECT *
					FROM " . SMILIES_CAT_TABLE . "
					WHERE cat_order = '" . $cat_order . "'
					ORDER BY cat_order
					ASC";

				$sql2 = "SELECT *
					FROM " . SMILIES_TABLE . "
					WHERE cat_id = '" . $cat_order . "'
					ORDER BY cat_id, smilies_order
					ASC";
			}
			else
			{
				$sql1 = "SELECT *
					FROM " . SMILIES_CAT_TABLE . "
					ORDER BY cat_order
					ASC";

				$sql2 = "SELECT *
					FROM " . SMILIES_TABLE . "
					ORDER BY cat_id, smilies_order
					ASC";
			}

			if( !$result1 = $db->sql_query($sql1) )
			{
				message_die(GENERAL_ERROR, "Could not get category list", "", __LINE__, __FILE__, $sql1);
			}
			else
			{
				if( !$result2 = $db->sql_query($sql2) )
				{
					message_die(GENERAL_ERROR, "Could not get smiley list", "", __LINE__, __FILE__, $sql2);
				}
				else
				{
					$resultset1 = $db->sql_fetchrowset($result1);
					$resultset2 = $db->sql_fetchrowset($result2);

					$smile_pak = $lang['pak_header'];

					for ($i=0; $i<count($resultset1); $i++ )
					{
						$smile_pak .= '#';
						$smile_pak .= $resultset1[$i]['cat_name'] . $delimeter;
						$smile_pak .= $resultset1[$i]['description'] . $delimeter;
						$smile_pak .= $resultset1[$i]['cat_order'] . $delimeter;
						$smile_pak .= $resultset1[$i]['cat_perms'] . $delimeter;
						$smile_pak .= $resultset1[$i]['cat_forum'] . $delimeter;
						$smile_pak .= $resultset1[$i]['cat_category'] . $delimeter;
						$smile_pak .= $resultset1[$i]['cat_icon_url'] . $delimeter;
						$smile_pak .= $resultset1[$i]['smilies_per_page'] . $delimeter;
						$smile_pak .= $resultset1[$i]['smilies_popup'] . "\r\n";
					}

					for ($i=0; $i<count($resultset2); $i++ )
					{
						$smile_pak .= $resultset2[$i]['smile_url'] . $delimeter;
						$smile_pak .= $resultset2[$i]['emoticon'] . $delimeter;
						$smile_pak .= $resultset2[$i]['code'] . $delimeter;
						$smile_pak .= $resultset2[$i]['cat_id'] . $delimeter;
						$smile_pak .= $resultset2[$i]['smilies_order'] . "\r\n";
					}

					header("Content-Type: text/x-delimtext; name=\"smiles.pak2\"");
					header("Content-disposition: attachment; filename=smiles.pak2");

					echo $smile_pak;
				}
			}
		}
		else
		{
			// No category data at all.
			if( $cat_order )
			{
				$where = ' WHERE cat_id = ' . $cat_order;
			}

			$sql = "SELECT code, smile_url, emoticon
				FROM " . SMILIES_TABLE . $where . "
				ORDER BY cat_id, smilies_order
				ASC";
			if( !$result = $db->sql_query($sql) )
			{
				message_die(GENERAL_ERROR, "Could not get smiley list", "", __LINE__, __FILE__, $sql);
			}
			else
			{
				$resultset = $db->sql_fetchrowset($result);

				$smile_pak = "";
				for ($i=0; $i<count($resultset); $i++ )
				{
					$smile_pak .= $resultset[$i]['smile_url'] . $delimeter;
					$smile_pak .= $resultset[$i]['emoticon'] . $delimeter;
					$smile_pak .= $resultset[$i]['code'] . "\r\n";
				}

				header("Content-Type: text/x-delimtext; name=\"smiles.pak\"");
				header("Content-disposition: attachment; filename=smiles.pak");

				echo $smile_pak;
			}
		}

		exit;
	}

	if( $export_type )
	{
		$message = sprintf($lang['export_smiles1'], "<a href=\"" . append_sid("admin_smilies.$phpEx?export_pack=send&amp;cat=" . $cat_order . "&amp;type=" . $export_type, true) . "\">", "</a>") . "<br /><br />" . sprintf($lang['Click_return_catadmin'], "<a href=\"" . append_sid("admin_smilies.$phpEx") . "\">", "</a>");
	}
	else
	{
		$message = sprintf($lang['export_smiles2'], "<a href=\"" . append_sid("admin_smilies.$phpEx?export_pack=send&amp;cat=" . $cat_order, true) . "\">", "</a>") . "<br /><br />" . sprintf($lang['Click_return_catadmin'], "<a href=\"" . append_sid("admin_smilies.$phpEx") . "\">", "</a>");
	}

	message_die(GENERAL_MESSAGE, $message);

}
else if( isset($HTTP_POST_VARS['cat_add']) || isset($HTTP_GET_VARS['cat_add']) )
{
	//
	// Admin has selected to add a category.
	//

	//
	// Get the submitted data being careful to ensure the the data
	// we recieve and process is only the data we are looking for.
	//
	$cat_name = ( isset($HTTP_POST_VARS['cat_name1']) ) ? trim($HTTP_POST_VARS['cat_name1']) : '';
	$cat_desc = ( isset($HTTP_POST_VARS['cat_desc1']) ) ? trim($HTTP_POST_VARS['cat_desc1']) : '';
	$cat_perms = ( isset($HTTP_POST_VARS['cat_view_perms1']) ) ? intval($HTTP_POST_VARS['cat_view_perms1']) : '5';
	$cat_forum = ( isset($HTTP_POST_VARS['cat_forum1']) ) ? $HTTP_POST_VARS['cat_forum1'] : '0';
	$per_page = ( isset($HTTP_POST_VARS['cat_per_page1']) ) ? intval($HTTP_POST_VARS['cat_per_page1']) : '0';
	$popup_width = ( isset($HTTP_POST_VARS['popup_width1']) ) ? intval($HTTP_POST_VARS['popup_width1']) : '410';
	$popup_height = ( isset($HTTP_POST_VARS['popup_height1']) ) ? intval($HTTP_POST_VARS['popup_height1']) : '300';
	$popup_cols = ( isset($HTTP_POST_VARS['popup_cols1']) ) ? intval($HTTP_POST_VARS['popup_cols1']) : '9';
	$order = ( isset($HTTP_POST_VARS['order1']) ) ? trim($HTTP_POST_VARS['order1']) : 'after';
	$cat_icon = ( isset($HTTP_POST_VARS['cat_icon1']) ) ? trim($HTTP_POST_VARS['cat_icon1']) : '';

	// Check to make sure that both boxes were filled, if not then complain.
	if( ($cat_name != '') || ($cat_desc != '') )
	{
		$cat_icon = ( $cat_icon == 'blank_icon.gif' ) ? '' : $cat_icon;

		list($forum, $category) = explode("|", $cat_forum);

		// Quotes aren't good, so remove them.
		$cat_name = str_replace("'", "", $cat_name);
		$cat_name = str_replace("\"", "", $cat_name);
		$cat_desc = str_replace("'", "", $cat_desc);
		$cat_desc = str_replace("\"", "", $cat_desc);

		if( $order == 'last' )
		{
			// Increase category total by 1.
			$num_cats++;

			// Insert the new category. cat_id is 'auto_increment' and hidden has a default value of 1 inserted.
			$sql = "INSERT INTO " . SMILIES_CAT_TABLE . " (cat_name, description, cat_order, cat_perms, cat_forum, cat_category, cat_icon_url, smilies_per_page, smilies_popup)
				VALUES ('" . $cat_name . "','" . $cat_desc . "','" . $num_cats . "','" . $cat_perms . "','" . $forum . "','" . $category . "','" . $cat_icon . "','" . $per_page . "','" . $popup_width . "|" . $popup_height . "|" . $popup_cols . "')";
			if( !$result = $db->sql_query($sql) )
			{
				message_die(GENERAL_ERROR, "Couldn't insert new category into database.", "", __LINE__, __FILE__, $sql);
			}
			else
			{
				$message = $lang['add_success']."<br /><br />" . sprintf($lang['Click_return_catadmin'], "<a href=\"" . append_sid("admin_smilies.$phpEx") . "\">", "</a>");
			}
		}
		else if( $order == 'first' )
		{
			// Update the category order.
			$sql = "UPDATE " . SMILIES_CAT_TABLE . "
				SET cat_order = cat_order + 1";
			if( !$result = $db->sql_query($sql) )
			{
				message_die(GENERAL_ERROR, "Couldn't update category database.", "", __LINE__, __FILE__, $sql);
			}
			else
			{
				// Update the smilies category order.
				$sql = "UPDATE " . SMILIES_TABLE . "
					SET cat_id = cat_id + 1";
				$result = $db->sql_query($sql);
				if( !$result ) { message_die(GENERAL_ERROR, "Couldn't update smiley database.", "", __LINE__, __FILE__, $sql); }

				$sql = "INSERT INTO " . SMILIES_CAT_TABLE . " (cat_name, description, cat_order, cat_perms, cat_forum, cat_category, cat_icon_url, smilies_per_page, smilies_popup)
					VALUES ('" . $cat_name . "','" . $cat_desc . "','1','" . $cat_perms . "','" . $forum . "','" . $category . "','" . $cat_icon . "','" . $per_page . "','" . $popup_width . "|" . $popup_height . "|" . $popup_cols . "')";
				$result = $db->sql_query($sql);
				if( !$result )
				{
					message_die(GENERAL_ERROR, "Couldn't insert new category into database.", "", __LINE__, __FILE__, $sql);
				}
				else
				{
					$message = $lang['add_success']."<br /><br />" . sprintf($lang['Click_return_catadmin'], "<a href=\"" . append_sid("admin_smilies.$phpEx") . "\">", "</a>");
				}
			}
		}
		else if( $order == 'after' )
		{
			$ordernum = ( isset($HTTP_POST_VARS['ordernum1']) ) ? $HTTP_POST_VARS['ordernum1'] : '';
			list($cat_id, $cat_order) = explode("|", $ordernum);

			// Update the category order.
			$sql = "UPDATE " . SMILIES_CAT_TABLE . "
				SET cat_order = cat_order + 1
				WHERE cat_order > '" . $cat_order . "'";
			if( !$result = $db->sql_query($sql) )
			{
				message_die(GENERAL_ERROR, "Couldn't update category database.", "", __LINE__, __FILE__, $sql);
			}
			else
			{
				// Update the smilies category order.
				$sql = "UPDATE " . SMILIES_TABLE . "
					SET cat_id = cat_id + 1
					WHERE cat_id > '" . $cat_order . "'";
				$result = $db->sql_query($sql);
				if( !$result ) { message_die(GENERAL_ERROR, "Couldn't update smiley database.", "", __LINE__, __FILE__, $sql); }

				$order = $cat_order+1;

				$sql = "INSERT INTO " . SMILIES_CAT_TABLE . " (cat_name, description, cat_order, cat_perms, cat_forum, cat_category, cat_icon_url, smilies_per_page, smilies_popup)
					VALUES ('" . $cat_name . "','" . $cat_desc . "','" . $order . "','" . $cat_perms . "','" . $forum . "','" . $category . "','" . $cat_icon . "','" . $per_page . "','" . $popup_width . "|" . $popup_height . "')";
				$result = $db->sql_query($sql);
				if( !$result )
				{
					message_die(GENERAL_ERROR, "Couldn't insert new category into database.", "", __LINE__, __FILE__, $sql);
				}
				else
				{
					$message = $lang['add_success']."<br /><br />" . sprintf($lang['Click_return_catadmin'], "<a href=\"" . append_sid("admin_smilies.$phpEx") . "\">", "</a>");
				}
			}
		}
	}
	else
	{
		$message = $lang['add_fail']."<br /><br />" . sprintf($lang['Click_return_catadmin'], "<a href=\"" . append_sid("admin_smilies.$phpEx") . "\">", "</a>");
	}

	message_die(GENERAL_MESSAGE, $message);

}
else if( isset($HTTP_POST_VARS['cat_edit']) || isset($HTTP_GET_VARS['cat_edit']) )
{
	//
	// Admin has selected to edit a category.
	//

	//
	// Get the submitted data being careful to ensure the the data
	// we recieve and process is only the data we are looking for.
	//
	$catid = ( isset($HTTP_POST_VARS['cat_id']) ) ? $HTTP_POST_VARS['cat_id'] : ''; // Mini array
	$cat_name = ( isset($HTTP_POST_VARS['cat_name2']) ) ? trim($HTTP_POST_VARS['cat_name2']) : '';
	$cat_desc = ( isset($HTTP_POST_VARS['cat_desc2']) ) ? trim($HTTP_POST_VARS['cat_desc2']) : '';
	$cat_perms = ( isset($HTTP_POST_VARS['cat_view_perms2']) ) ? intval($HTTP_POST_VARS['cat_view_perms2']) : '5';
	$cat_forum = ( isset($HTTP_POST_VARS['cat_forum2']) ) ? $HTTP_POST_VARS['cat_forum2'] : '0';
	$per_page = ( isset($HTTP_POST_VARS['cat_per_page2']) ) ? intval($HTTP_POST_VARS['cat_per_page2']) : '0';
	$popup_width = ( isset($HTTP_POST_VARS['popup_width2']) ) ? intval($HTTP_POST_VARS['popup_width2']) : '410';
	$popup_height = ( isset($HTTP_POST_VARS['popup_height2']) ) ? intval($HTTP_POST_VARS['popup_height2']) : '300';
	$popup_cols = ( isset($HTTP_POST_VARS['popup_cols2']) ) ? intval($HTTP_POST_VARS['popup_cols2']) : '9';
	$ordernum = ( isset($HTTP_POST_VARS['ordernum2']) ) ? $HTTP_POST_VARS['ordernum2'] : '';
	$cat_icon = ( isset($HTTP_POST_VARS['cat_icon2']) ) ? trim($HTTP_POST_VARS['cat_icon2']) : '';
	$delete = ( isset($HTTP_POST_VARS['delete']) ) ? intval($HTTP_POST_VARS['delete']) : '';

	list($cat_id, $cat_order) = explode("|", $catid);

	// Category has been given its marching orders?
	// If it still contains smilies then they can kiss their asses goodbye. :)
	if( $delete )
	{
		if( $cat_id )
		{
			// Delete category.
			$sql = "DELETE FROM " . SMILIES_CAT_TABLE . "
				WHERE cat_id = '" . $cat_id . "'";
			if( !$result = $db->sql_query($sql) )
			{
				message_die(GENERAL_ERROR, "Couldn't delete category from database.", "", __LINE__, __FILE__, $sql);
			}
			else
			{
				// Update the category order field.
				$sql = "UPDATE " . SMILIES_CAT_TABLE . "
					SET cat_order = cat_order - 1
					WHERE cat_order > '" . $cat_order . "'";
				if( !$result = $db->sql_query($sql) )
				{
					message_die(GENERAL_ERROR, "Couldn't update category database.", "", __LINE__, __FILE__, $sql);
				}

				// Delete smilies.
				$sql = "DELETE FROM " . SMILIES_TABLE . "
					WHERE cat_id = '" . $cat_order . "'";
				if( !$result = $db->sql_query($sql) )
				{
					message_die(GENERAL_ERROR, "Couldn't delete smilies from database.", "", __LINE__, __FILE__, $sql);
				}
				else
				{
					// Update the smilies category order field.
					$sql = "UPDATE " . SMILIES_TABLE . "
						SET cat_id = cat_id - 1
						WHERE cat_id > '" . $cat_order . "'";
					if( !$result = $db->sql_query($sql) )
					{
						message_die(GENERAL_ERROR, "Couldn't update smiley database.", "", __LINE__, __FILE__, $sql);
					}
					else
					{
						$message = $lang['smiley_cat_del_success'] . "<br /><br />" . sprintf($lang['Click_return_smileadmin'], "<a href=\"" . append_sid("admin_smilies.$phpEx") . "\">", "</a>");
					}
				}
			}
		}
		else
		{
			$message = $lang['smiley_cat_del_fail'] . "<br /><br />" . sprintf($lang['Click_return_smileadmin'], "<a href=\"" . append_sid("admin_smilies.$phpEx") . "\">", "</a>");
		}
	}
	else
	{
		// Check to make sure that both boxes were filled, if not then complain. Also check for category ID as you can't edit without it.
		if( ($cat_id != '') || ($cat_name != '') || ($cat_desc != '') )
		{
			$cat_icon = ( $cat_icon == 'blank_icon.gif' ) ? '' : $cat_icon;

			// The order position value. $new_cat_id is still the same as $cat_id!
			list($new_cat_id, $new_cat_order) = explode("|", $ordernum);

			// Check viewable by permissions is correct.
			$cat_perms = ( $cat_perms == '-1' ) ? 0 : $cat_perms;

			// Check viewable in permissions is correct.
			if( $cat_forum == '-1' )
			{
				$forum = '-1';
				$category = '-1';
			}
			else
			{
				list($forum, $category) = explode("|", $cat_forum);
			}

			// Quotes aren't good, so remove them.
			$cat_name = str_replace("'", "", $cat_name);
			$cat_name = str_replace("\"", "", $cat_name);
			$cat_desc = str_replace("'", "", $cat_desc);
			$cat_desc = str_replace("\"", "", $cat_desc);

			// If the category hasn't moved.
			if( $new_cat_order == $cat_order )
			{
				// Update the category's new details.
				$sql = "UPDATE " . SMILIES_CAT_TABLE . "
					SET cat_name = '" . $cat_name . "', description = '" . $cat_desc . "', cat_perms = '" . $cat_perms . "', cat_forum = '" . $forum . "', cat_category = '" . $category . "', cat_icon_url = '" . $cat_icon . "', smilies_per_page = '" . $per_page . "', smilies_popup = '" . $popup_width . "|" . $popup_height . "|" . $popup_cols . "'
					WHERE cat_id = '" . $cat_id . "'";
				if( !$result = $db->sql_query($sql) )
				{
					message_die(GENERAL_ERROR, "Couldn't update the category after it was edited.", "", __LINE__, __FILE__, $sql);
				}
				else
				{
					$message = $lang['edit_success'] . "<br /><br />" . sprintf($lang['Click_return_catadmin'], "<a href=\"" . append_sid("admin_smilies.$phpEx") . "\">", "</a>");
				}
			}

			// If the category been moved Up.
			if( $new_cat_order > $cat_order )
			{
				// First we update ALL the order values.
				$sql = "UPDATE " . SMILIES_CAT_TABLE . "
					SET cat_order = cat_order - 1
					WHERE cat_order >= '" . $cat_order . "'
						AND cat_order <= '" . $new_cat_order . "'";
				if( !$result = $db->sql_query($sql) )
				{
					message_die(GENERAL_ERROR, "Couldn't update category database.", "", __LINE__, __FILE__, $sql);
				}
				else
				{
					// Secondly we update only the affected category order value.
					$sql = "UPDATE " . SMILIES_CAT_TABLE . "
						SET cat_name = '" . $cat_name . "', description = '" . $cat_desc . "', cat_order = '" . $new_cat_order . "', cat_perms = '" . $cat_perms . "', cat_forum = '" . $forum . "', cat_category = '" . $category . "', cat_icon_url = '" . $cat_icon . "', smilies_per_page = '" . $per_page . "', smilies_popup = '" . $popup_width . "|" . $popup_height . "|" . $popup_cols . "'
						WHERE cat_id = '" . $cat_id . "'";
					$result = $db->sql_query($sql);
					if( !$result ) { message_die(GENERAL_ERROR, "Couldn't update category database.", "", __LINE__, __FILE__, $sql); }

					// Third we update only the smilies in the affected category.
					$sql = "UPDATE " . SMILIES_TABLE . "
						SET cat_id = -1
						WHERE cat_id = '" . $cat_order . "'";
					if( !$result = $db->sql_query($sql) )
					{
						message_die(GENERAL_ERROR, "Couldn't update smiley database.", "", __LINE__, __FILE__, $sql);
					}
					else
					{
						// Fourth we update all the smilies.
						$sql = "UPDATE " . SMILIES_TABLE . "
							SET cat_id = cat_id - 1
							WHERE cat_id >= '" . $cat_order . "'
								AND cat_id <= '" . $new_cat_order . "'";
						if( !$result = $db->sql_query($sql) )
						{
							message_die(GENERAL_ERROR, "Couldn't update smiley database.", "", __LINE__, __FILE__, $sql);
						}
						else
						{
							// Fifth we update only the smilies in the affected category.
							$sql = "UPDATE " . SMILIES_TABLE . "
								SET cat_id = '" . $new_cat_order . "'
								WHERE cat_id = -1";
							if( !$result = $db->sql_query($sql) )
							{
								message_die(GENERAL_ERROR, "Couldn't update smiley database.", "", __LINE__, __FILE__, $sql);
							}
							else
							{
								$message = $lang['edit_success_down'] . "<br /><br />" . sprintf($lang['Click_return_catadmin'], "<a href=\"" . append_sid("admin_smilies.$phpEx") . "\">", "</a>");
							}
						}
					}
				}
			}

			// If the category been moved Down.
			if( $new_cat_order < $cat_order )
			{
				// First we update ALL the order values.
				$sql = "UPDATE " . SMILIES_CAT_TABLE . "
					SET cat_order = cat_order + 1
					WHERE cat_order >= '" . $new_cat_order . "'
						AND cat_order <= '" . $cat_order . "'";
				if( !$result = $db->sql_query($sql) )
				{
					message_die(GENERAL_ERROR, "Couldn't update category database.", "", __LINE__, __FILE__, $sql);
				}
				else
				{
					// Secondly we update only the affected category order value.
					$sql = "UPDATE " . SMILIES_CAT_TABLE . "
						SET cat_name = '" . $cat_name . "', description = '" . $cat_desc . "', cat_order = '" . $new_cat_order . "', cat_perms = '" . $cat_perms . "', cat_forum = '" . $forum . "', cat_category = '" . $category . "', cat_icon_url = '" . $cat_icon . "', smilies_per_page = '" . $per_page . "', smilies_popup = '" . $popup_width . "|" . $popup_height . "|" . $popup_cols . "'
						WHERE cat_id = '" . $cat_id . "'";
					$result = $db->sql_query($sql);
					if( !$result ) { message_die(GENERAL_ERROR, "Couldn't update category database.", "", __LINE__, __FILE__, $sql); }

					// Third we update only the smilies in the affected category.
					$sql = "UPDATE " . SMILIES_TABLE . "
						SET cat_id = -1
						WHERE cat_id = '" . $cat_order . "'";
					if( !$result = $db->sql_query($sql) )
					{
						message_die(GENERAL_ERROR, "Couldn't update smiley database.", "", __LINE__, __FILE__, $sql);
					}
					else
					{
						// Fourth we update all the smilies.
						$sql = "UPDATE " . SMILIES_TABLE . "
							SET cat_id = cat_id + 1
							WHERE cat_id >= '" . $new_cat_order . "'
								AND cat_id <= '" . $cat_order . "'";
						if( !$result = $db->sql_query($sql) )
						{
							message_die(GENERAL_ERROR, "Couldn't update smiley database.", "", __LINE__, __FILE__, $sql);
						}
						else
						{
							// Fifth we update only the smilies in the affected category.
							$sql = "UPDATE " . SMILIES_TABLE . "
								SET cat_id = '" . $new_cat_order . "'
								WHERE cat_id = -1";
							if( !$result = $db->sql_query($sql) )
							{
								message_die(GENERAL_ERROR, "Couldn't update smiley database.", "", __LINE__, __FILE__, $sql);
							}
							else
							{
								$message = $lang['edit_success_up'] . "<br /><br />" . sprintf($lang['Click_return_catadmin'], "<a href=\"" . append_sid("admin_smilies.$phpEx") . "\">", "</a>");
							}
						}
					}
				}
			}
		}
		else
		{
			$message = $lang['edit_fail'] . "<br /><br />" . sprintf($lang['Click_return_catadmin'], "<a href=\"" . append_sid("admin_smilies.$phpEx") . "\">", "</a>");
		}
	}

	message_die(GENERAL_MESSAGE, $message);

}
else if( isset($HTTP_POST_VARS['cat_view']) || isset($HTTP_GET_VARS['cat_view']) )
{
	//
	// Admin has selected to view one or more categories. Category Viewing Utility Page.
	//

	//
	// Get the submitted data being careful to ensure the the data
	// we recieve and process is only the data we are looking for.
	//
	$catview = ( isset($HTTP_POST_VARS['catview']) ) ? $HTTP_POST_VARS['catview'] : '';
	$default = ( isset($HTTP_POST_VARS['default']) ) ? $HTTP_POST_VARS['default'] : $HTTP_GET_VARS['cat'];
	$multi_cat = ( isset($HTTP_GET_VARS['multi']) ) ? $HTTP_GET_VARS['multi'] : '';

	if( $catview )
	{
		// $catview is a multi-array from the main page.
		$count = count($catview);
		$cat = $catview;
	}
	else if( $multi_cat )
	{
		// $mutli_cat is a multi array that stores the category ids
		// for the cats you were viewing before you clicked a smiley.
		$cat_count = explode("|", $multi_cat);
		$cat = array();
		for( $i=1; $i<=$cat_count[0]; $i++ )
		{
			if( !($i % 2) )
			{

			}
			else
			{
				$cat[] = $cat_count[$i] . '|' . $cat_count[$i+1];
			}
		}

		$count = count($cat);
	}
	else
	{
		// Single array.
		$count = 1;
		$cat = array($default);
	}

	for( $i=0; $i<$count; $i++ )
	{
		// Get list of categories to display from array.
		list($cat_id, $cat_order) = explode("|", $cat[$i]);

		// Get all smiley data for the category.
		$sql = "SELECT smilies_id, code, smile_url, emoticon
			FROM " . SMILIES_TABLE . "
			WHERE cat_id = '" . $cat_order . "'
			ORDER BY smilies_order
			ASC";
		$result = $db->sql_query($sql);
		if( !$result ) { message_die(GENERAL_ERROR, "Couldn't obtain smilies from database", "", __LINE__, __FILE__, $sql); }
		$smile_row = $db->sql_fetchrowset($result);
		$smile_count = $db->sql_numrows($result);

		if( $smile_count )
		{
			$smiley_list = '';
			$rowset = array();
			$unique_smilies = 0;

			for( $j=0; $j<$smile_count; $j++ )
			{
				$smiley_list .= '<img src="' . $phpbb_root_path . $board_config['smilies_path'] . '/' . $smile_row[$j]['smile_url'] . '" title="' . $lang['click_edit'] . '" alt="' . $lang['click_edit'] . '" border="0" onmouseover="this.style.cursor=\'hand\';" onClick="editsmiley(\'' . append_sid("admin_smilies.$phpEx?smiley_edit&amp;id=" . $smile_row[$j]['smilies_id']) . '\')" /> ';

				if( empty($rowset[$smile_row[$j]['smile_url']]) )
				{
					$rowset[$smile_row[$j]['smile_url']]['emoticon'] = $smile_row[$j]['emoticon'];
					$unique_smilies++;
				}
			}
			unset($rowset);
		}
		else
		{
			$smiley_list = '';
			$unique_smilies = 0;
			$smiley_list = $lang['smiley_cat_empty'];
		}

		$cats_viewed = $count + $count;
		for( $k=0; $k<$count; $k++ )
		{
			list($id, $order) = explode("|", $cat[$k]);

			$cats_viewed .= '|' . $id . '|' . $order;
		}

		$template->set_filenames(array(
			"body" => "admin/smile_cat_list.tpl")
		);

		$template->assign_vars(array(
			"L_ORDER_NUM" => $lang['order_num'],
			"L_PAGE_TITLE" => $lang['smiley_cat_title'],
			"L_PAGE_DESCRIPTION" => $lang['smiley_cat_description'],
			"L_CATEGORY_NAME" => $lang['cat_name'],
			"L_CATEGORY_DESC" => $lang['cat_description'],
			"L_SMILEY_COUNT" => $lang['smiley_count'],
			"L_CATEGORY_OPTIONS" => $lang['smiley_cat_options'],
			"L_EDIT" => $lang['Edit'],

			"MULTI_CATS" => $cats_viewed)
		);

		$row_color = ( !($i % 2) ) ? $theme['td_color1'] : $theme['td_color2'];
		$row_class = ( !($i % 2) ) ? $theme['td_class1'] : $theme['td_class2'];
		
		$template->assign_block_vars("smile_categories", array(
			"ROW_COLOR" => "#" . $row_color,
			"ROW_CLASS" => $row_class,
			"CATEGORY_EDIT" => append_sid("admin_smilies.$phpEx?mode=edit&amp;cat=" . $cat_id . "|" . $cat_order),
			"CATEGORY_NUM" => $cat_order,
			"CATEGORY_NAME" => $array_cat_data[$cat_order-1]['cat_name'],
			"CATEGORY_DESC" => $array_cat_data[$cat_order-1]['description'],
			"SMILEY_COUNT" => $smile_count . '(' . $unique_smilies . ')',
			
			"S_SMILEY_LIST" => $smiley_list)
		);
	}

}
else if ( isset($HTTP_POST_VARS['smiley_edit']) || isset($HTTP_GET_VARS['smiley_edit']) )
{
	//
	// Admin has selected to edit/add a smiley.
	//

	//
	// Get the submitted data being careful to ensure the the data
	// we recieve and process is only the data we are looking for.
	//
	$smiley_id = ( isset($HTTP_GET_VARS['id']) ) ? intval($HTTP_GET_VARS['id']) : '';
	$add_smile = ( isset($HTTP_POST_VARS['add']) ) ? intval($HTTP_POST_VARS['add']) : '';
	$orig_cat = ( isset($HTTP_POST_VARS['orig_cat']) ) ? $HTTP_POST_VARS['orig_cat'] : '';

	read_smiles_directory($board_config['smilies_path']);

	// Are you editing or adding?
	if( $add_smile )
	{
		list($cat_id, $cat_order) = explode("|", $orig_cat);

		$category = $cat_order;
		$image_url = $smiley_images[0];

		$title = $lang['smile_add'];
		$smiley_title = $lang['smiley_add_title'];
		$disabled = 'disabled="disabled"';

		$s_hidden_fields = '<input type="hidden" name="mode" value="smiley_save" /><input type="hidden" name="add" value="1" />';
	}
	else
	{
		$multi_cats = ( isset($HTTP_GET_VARS['multi']) ) ? $HTTP_GET_VARS['multi'] : '';

		// If editing a smiley then get its details.
		$sql = "SELECT smilies_id, code, smile_url, emoticon, cat_id, smilies_order
			FROM " . SMILIES_TABLE . "
			WHERE smilies_id = " . $smiley_id;
		$result = $db->sql_query($sql);
		if( !$result ) { message_die(GENERAL_ERROR, 'Could not obtain emoticon information', "", __LINE__, __FILE__, $sql); }
		$smile_row = $db->sql_fetchrow($result);

		$category = $smile_row['cat_id'];
		$image_url = $smile_row['smile_url'];

		$title = $lang['smiley_edit'];
		$smiley_title = $lang['smiley_edit_title'];

		$s_hidden_fields = '<input type="hidden" name="mode" value="smiley_save" />
			<input type="hidden" name="id_order" value="' . $array_cat_data[$category-1]['cat_id'] . '|' . $smile_row['cat_id'] . '|' . $smile_row['smilies_order'] . '" />
			<input type="hidden" name="smile_id" value="' . $smile_row['smilies_id'] . '" />
			<input type="hidden" name="multi" value="' . $multi_cats . '" />';
	}

	// Create dropdown category list.
	$category_list = '';
	for( $i=0; $i<$num_cats; $i++ )
	{
		$smiley_selected = ( $array_cat_data[$i]['cat_order'] == $category ) ? ' selected="selected"' : '';

		// value = cat_id value | cat_order value.
		$category_list .= '<option value="' . $array_cat_data[$i]['cat_id'] . '|' . $array_cat_data[$i]['cat_order'] . '"' . $smiley_selected . '>' . $array_cat_data[$i]['cat_name'] . '</option>';
	}

	// Create dropdown smiley filename list.
	$filename_list = '';
	for( $i=0; $i<count($smiley_images); $i++ )
	{
		if ( $smiley_images[$i] == $image_url )
		{
			$smiley_selected = ' selected="selected"';
			$smiley_edit_img = $smiley_images[$i];
		}
		else
		{
			$smiley_selected = '';
		}

		$filename_list .= '<option value="' . $smiley_images[$i] . '"' . $smiley_selected . '>' . $smiley_images[$i] . '</option>';
	}

	$template->set_filenames(array(
		"body" => "admin/smile_edit_body.tpl")
	);

	$template->assign_vars(array(
		"L_SMILEY_TITLE" => $smiley_title,
		"L_SMILEY_DESCRIPTION" => $lang['smile_edit_desc'],
		"L_SMILEY_CONFIG" => $title,
		"L_SMILEY_CODE" => $lang['smiley_code'],
		"L_SMILEY_URL" => $lang['smiley_url'],
		"L_SMILEY_EMOTION" => $lang['smiley_emot'],
		"L_SMILEY_CATEGORY" => $lang['smiley_category'],
		"L_SUBMIT" => $lang['Submit'],
		"L_SMILEY_DELETE" => $lang['smiley_delete'],

		"DISABLED" => $disabled,
		"SMILEY_CODE" => $smile_row['code'],
		"SMILEY_EMOTICON" => $smile_row['emoticon'],
		"SMILEY_CATEGORY" => $smile_row['category'],
		"SMILEY_IMG" => $phpbb_root_path . $board_config['smilies_path'] . '/' . $image_url,

		"S_CATEGORY_OPTIONS" => $category_list,
		"S_HIDDEN_FIELDS" => $s_hidden_fields,
		"S_FILENAME_OPTIONS" => $filename_list,
		"S_SMILEY_BASEDIR" => $phpbb_root_path . $board_config['smilies_path'],
		"S_SMILEY_ACTION" => append_sid("admin_smilies.$phpEx"))
	);

}
else if ( isset($HTTP_POST_VARS['submit_all']) || isset($HTTP_GET_VARS['submit_all']) )
{
	//
	// Admin has submitted multiple changes.
	//

	// As of yet we don't know what the ids of the smilies are, we do however know how many there are.
	$total = ( isset($HTTP_POST_VARS['total']) ) ? intval($HTTP_POST_VARS['total']) : '';

	// This is the original cat_id.
	$orig_cat_data = ( isset($HTTP_POST_VARS['orig_cat']) ) ? $HTTP_POST_VARS['orig_cat'] : '';

	// $orig_cat_data contains two values, the original category's id and order values.
	list($cat_id, $cat_order) = explode("|", $orig_cat_data);

	$dels = 0;
	$edits = 0;
	$errors = 0;

	// For pagination
	$start = ( isset($HTTP_POST_VARS['start']) ) ? intval($HTTP_POST_VARS['start']) : '0';

	if( $start )
	{
		$start1 = $start + 1;
		$total1 = $total + $start;
	}
	else
	{
		$start1 = 1;
		$total1 = $total;
	}

	for( $i=$start1; $i<=$total1; $i++ )
	{
		// I can now start to receieve the smiley ids which will allow me to get the others.
		$smiley_id = ( isset($HTTP_POST_VARS["id$i"]) ) ? $HTTP_POST_VARS["id$i"] : $HTTP_GET_VARS["id$i"];

		// Get the submitted data from the other fields now.
		$smiley_code = ( isset($HTTP_POST_VARS["code$smiley_id"]) ) ? trim($HTTP_POST_VARS["code$smiley_id"]) : '';
		$smiley_emot = ( isset($HTTP_POST_VARS["emot$smiley_id"]) ) ? trim($HTTP_POST_VARS["emot$smiley_id"]) : '';
		$smiley_cat = ( isset($HTTP_POST_VARS["cat$smiley_id"]) ) ? $HTTP_POST_VARS["cat$smiley_id"] : '';
		$smiley_del = ( isset($HTTP_POST_VARS["del$smiley_id"]) ) ? intval($HTTP_POST_VARS["del$smiley_id"]) : '';

		// Get the order value for the smiley as it may have changed if there has been deletions.
		$sql = "SELECT smilies_order
			FROM " . SMILIES_TABLE . "
			WHERE smilies_id = " . $smiley_id;
		$result = $db->sql_query($sql);
		if( !$result ) { message_die(GENERAL_ERROR, "Couldn't select category database.", "", __LINE__, __FILE__, $sql); }
		$res = $db->sql_fetchrow($result);
		$smilies_order = $res['smilies_order'];

		// Has the smiley been selected for deletion?
		if( $smiley_del == 1 )
		{
			// Delete the smiley.
			$sql = "DELETE FROM " . SMILIES_TABLE . "
				WHERE smilies_id = " . $smiley_id;
			if( !$result = $db->sql_query($sql) )
			{
				message_die(GENERAL_ERROR, "Couldn't delete smiley from the database.", "", __LINE__, __FILE__, $sql);
			}
			else
			{
				// Update the smilies order.
				$sql = "UPDATE " . SMILIES_TABLE . "
					SET smilies_order = smilies_order - 1
					WHERE cat_id = '" . $cat_order . "'
						AND smilies_order > " . $smilies_order;
				$result = $db->sql_query($sql);
				if( !$result ) { message_die(GENERAL_ERROR, "Couldn't update smiley database.", "", __LINE__, __FILE__, $sql); }

				$dels++;
			}
		}
		else
		{
			if( $smiley_code )
			{
				// $smiley_cat contains two values, the new category's id and order values.
				list($cat_id2, $cat_order2) = explode("|", $smiley_cat);

				// Convert < and > to proper htmlentities for parsing.
				$smiley_code = str_replace('<', '&lt;', $smiley_code);
				$smiley_code = str_replace('>', '&gt;', $smiley_code);

				// Check to see if the category has changed.
				if ( $cat_id == $cat_id2 )
				{
					// Category hasn't changed. Update smiley details.
					$sql = "UPDATE " . SMILIES_TABLE . "
						SET code = '" . $smiley_code . "', emoticon = '" . $smiley_emot . "'
						WHERE smilies_id = " . $smiley_id;
					$result = $db->sql_query($sql);
					if( !$result ) { message_die(GENERAL_ERROR, "Couldn't update smiley database.", "", __LINE__, __FILE__, $sql); }
				}
				else
				{
					// Category has changed. Get smiley count for new category.
					$sql = "SELECT *
						FROM " . SMILIES_TABLE . "
						WHERE cat_id = " . $cat_order2;
					$result = $db->sql_query($sql);
					if( !$result ) { message_die(GENERAL_ERROR, "Couldn't select category database.", "", __LINE__, __FILE__, $sql); }
					$smile_count = $db->sql_numrows($result);

					$lastsmile = $smile_count + 1;
		
					// Move smiley to new category and update all the data.
					$sql = "UPDATE " . SMILIES_TABLE . "
						SET code = '" . $smiley_code . "', emoticon = '" . $smiley_emot . "', cat_id = '" . $cat_order2 . "', smilies_order='" . $lastsmile . "'
						WHERE smilies_id=" . $smiley_id;
					if( !$result = $db->sql_query($sql) )
					{
						message_die(GENERAL_ERROR, "Couldn't update smiley database.", "", __LINE__, __FILE__, $sql);
					}
					else
					{
						// Update the old category's smilies order.
						$sql = "UPDATE " . SMILIES_TABLE . "
							SET smilies_order = smilies_order - 1
							WHERE cat_id = '" . $cat_order . "'
								AND smilies_order > " . $smilies_order;
						$result = $db->sql_query($sql);
						if( !$result ) { message_die(GENERAL_ERROR, "Couldn't update smiley database.", "", __LINE__, __FILE__, $sql); }
					}
				}
				$edits++;
			}
			else
			{
				$errors++;
			}
		}
	}

	$plural1 = ( $dels == '1' ) ? $lang['multi_delete1'] : $lang['multi_delete2'];
	$plural2 = ( $edits == '1' ) ? $lang['multi_updated1'] : $lang['multi_updated2'];
	$plural3 = ( $errors == '1' ) ? $lang['smiley_errors1'] : $lang['smiley_errors2'];

	$message = sprintf($plural2, $edits) . sprintf($plural1, $dels) . "<br /><br />" . sprintf($plural3, $errors, $total) . "<br /><br />" . sprintf($lang['Click_return_listadmin'], "<a href=\"" . append_sid("admin_smilies.$phpEx?mode=edit&amp;cat=$cat_id|$cat_order&amp;start=$start") . "\">", "</a>") . "<br /><br />" . sprintf($lang['Click_return_catadmin'], "<a href=\"" . append_sid("admin_smilies.$phpEx") . "\">", "</a>");

	message_die(GENERAL_MESSAGE, $message);

}
else if( isset($HTTP_POST_VARS['unused_smilies']) || isset($HTTP_GET_VARS['unused_smilies']) )
{
	//
	// Admin has selected to display unused smilies.
	//

	//
	// Get the submitted data being careful to ensure the the data
	// we recieve and process is only the data we are looking for.
	//
	// Note to self, because of pagination, data comes in from POST *and* GET!
	//
	$cat = ( isset($HTTP_POST_VARS['cat']) ) ? intval($HTTP_POST_VARS['cat']) : intval($HTTP_GET_VARS['cat']);
	$code = ( isset($HTTP_POST_VARS['code']) ) ? intval($HTTP_POST_VARS['code']) : intval($HTTP_GET_VARS['code']);
	$start = ( isset($HTTP_GET_VARS['start']) ) ? intval($HTTP_GET_VARS['start']) : '0';

	// Read all the images in the smiles folder and put them into an array.
	read_smiles_directory($board_config['smilies_path']);

	// Get all installed smiley urls and put them into an array.
	$sql = "SELECT smile_url
		FROM " . SMILIES_TABLE;
	$result = $db->sql_query($sql);
	if( !$result ) { message_die(GENERAL_ERROR, "Couldn't get smiley data from database", "", __LINE__, __FILE__, $sql); }

	$array_urls = array();
	while( $row = $db->sql_fetchrow($result) )
	{
		if( empty($array_urls[$row['smile_url']]) )
		{
			$array_urls[] = $row['smile_url'];
		}
	}	

	// Find the differences between the two arrays.
	$smiley = array_diff($smiley_images, $array_urls);
	sort($smiley);
	$num_smilies = count($smiley);

	// Stops you being sent back to an empty page if you've
	// just added all the smilies from the last page.
	if( $start == $num_smilies )
	{
		$start = $start - $array_cat_data[$cat-1]['smilies_per_page'];
	}

	// Calculations for pagination.
	if( $array_cat_data[$cat-1]['smilies_per_page'] == 0 )
	{
		$per_page = $num_smilies;
		$smiley_start = 0;
		$smiley_stop = $num_smilies;
		$per_page_total = $num_smilies;
	}
	else
	{
		$per_page = ( $array_cat_data[$cat-1]['smilies_per_page'] > $num_smilies ) ? $num_smilies : $array_cat_data[$cat-1]['smilies_per_page'];
		$page_num = ( $start <= 0 ) ? 1 : ($start / $per_page) + 1;
		$smiley_start = ($per_page * $page_num) - $per_page;
		$smiley_stop = ( ($per_page * $page_num) > $num_smilies ) ? $num_smilies : $smiley_start + $per_page;
		$per_page_total = $smiley_stop - $smiley_start;
	}

	$template->set_filenames(array(
		"body" => "admin/smile_unused_body.tpl")
	);

	$s_hidden_fields = '<input type="hidden" name="start" value="' . $start . '" /><input type="hidden" name="cat" value="' . $cat . '" /><input type="hidden" name="code" value="' . $code . '" /><input type="hidden" name="total" value="' . $per_page_total . '" /><input type="hidden" name="mode" value="addunused" />';

	if( $num_smilies )
	{
		$pagination = generate_pagination("admin_smilies.$phpEx?unused_smilies&amp;code=$code&amp;cat=$cat", $num_smilies, $per_page, $start, FALSE);
	}

	$row_color = ( !($i % 2) ) ? $theme['td_color1'] : $theme['td_color2'];
	$row_class = ( !($i % 2) ) ? $theme['td_class1'] : $theme['td_class2'];

	$template->assign_vars(array(
		"ROW_COLOR" => "#" . $row_color,
		"ROW_CLASS" => $row_class,

		"L_ACTION" => $lang['Action'],
		"L_SMILEY_TITLE" => $lang['smiley_unused_title'],
		"L_SMILEY_TEXT" => $lang['smiley_unused_desc'],
		"L_CODE" => $lang['Code'],
		"L_EMOT" => $lang['Emotion'],
		"L_SMILE" => $lang['Smile'],
		"L_CATEGORY" => $lang['category'],
		"L_ORDER_NUM" => $lang['order_num'],
		"L_ADD" => $lang['smile_tick_add'],
		"L_SUBMIT" => $lang['submit'],
		'L_TICK_ALL' => $lang['tick_all'],
		'L_UNTICK_ALL' => $lang['untick_all'],

		"S_PAGINATION" => $pagination,
		"S_HIDDEN_FIELDS" => $s_hidden_fields,
		"S_SMILEY_ACTION" => append_sid("admin_smilies.$phpEx"))
	);


	//
	// Show a list of smilies that are not installed.
	//
	if( $num_smilies )
	{
		$image_count = 1;

		for( $i=$smiley_start; $i<$smiley_stop; $i++ )
		{
			// Setup the dropdown list of categories for each smiley.
			$category_list = '';
			for ($j=0; $j<$num_cats; $j++)
			{
				$selected = ( $array_cat_data[$j]['cat_order'] == $cat ) ? ' selected="selected"' : '';
				$category_list .= '<option value="' . $array_cat_data[$j]['cat_id'] . '|' . $array_cat_data[$j]['cat_order'] . '"' . $selected . '>' . $array_cat_data[$j]['cat_name'] . '</option>';
			}

			// Remove .gif from filename so filename can be used as the smiley code.
			$name = ( $code == 1 ) ? ':'.basename($smiley[$i], ".gif").':' : '';

			$row_color = ( !($i % 2) ) ? $theme['td_color1'] : $theme['td_color2'];
			$row_class = ( !($i % 2) ) ? $theme['td_class1'] : $theme['td_class2'];

			$template->assign_block_vars("smiles", array(
				"ROW_COLOR" => "#" . $row_color,
				"ROW_CLASS" => $row_class,

				"SMILEY_CODE" => $name,
				"SMILEY_IMG" => $phpbb_root_path . $board_config['smilies_path'] . '/' . $smiley[$i],
				"SMILEY_URL" => $smiley[$i],
				"SMILEY_ID" => $image_count,
				"SMILEY_ORDER" => $image_count,

				"CATEGORY_LIST" => $category_list)
			);

			$image_count++;
		}
	}
}
else if( $mode != "" )
{
	switch( $mode )
	{
		case 'edit':
			//
			// Admin has selected to show a category allowing multiply smiley edits. Smiley Editing Utility Page
			//

			//
			// Get the submitted data being careful to ensure the the data
			// we recieve and process is only the data we are looking for.
			//
			$cat = ( isset($HTTP_GET_VARS['cat']) ) ? $HTTP_GET_VARS['cat'] : 1;
			$start = ( isset($HTTP_GET_VARS['start']) ) ? intval($HTTP_GET_VARS['start']) : 0;

			// Get the two values from $cat variable.
			list($cat_id, $cat_order) = explode("|", $cat);

			// Get all the smilies for the selected category.
			$sql = "SELECT * 
				FROM " . SMILIES_TABLE . "
				WHERE cat_id = '" . $cat_order . "'
				ORDER BY smilies_order
				ASC";
			$result = $db->sql_query($sql);
			if( !$result ) { message_die(GENERAL_ERROR, "Couldn't select smilies from database.", "", __LINE__, __FILE__, $sql); }

			$smile_row = $db->sql_fetchrowset($result);
			$smile_count = $db->sql_numrows($result);

			// If the category contains no smilies then output this message.
			$cat_empty = ( !$smile_count ) ? '<tr><td colspan="6" class="row2"><span class="gen">' . $lang['smiley_cat_empty'] . '</span></td></tr>' : '';

			// Code for pagination.
			if( $array_cat_data[$cat_order-1]['smilies_per_page'] == 0 )
			{
				$per_page = $smile_count;
				$smiley_start = 0;
				$smiley_stop = $smile_count;
				$per_page_total = $smile_count;
			}
			else
			{
				$per_page = ( $array_cat_data[$cat_order-1]['smilies_per_page'] > $smile_count ) ? $smile_count : $array_cat_data[$cat_order-1]['smilies_per_page'];
				$page_num = ( $start <= 0 ) ? 1 : ($start / $per_page) + 1;
				$smiley_start = ($per_page * $page_num) - $per_page;
				$smiley_stop = ( ($per_page * $page_num) > $smile_count ) ? $smile_count : $smiley_start + $per_page;
				$per_page_total = $smiley_stop - $smiley_start;
			}

			if( $smile_count )
			{
				$pagination = generate_pagination("admin_smilies.$phpEx?mode=edit&amp;cat=$cat_id|$cat_order", $smile_count, $per_page, $start, FALSE);
			}

			$s_hidden_fields = '<input type="hidden" name="orig_cat" value="' . $cat_id . '|' . $cat_order . '" /><input type="hidden" name="start" value="' . $start . '" />
					<input type="hidden" name="add" value="1" /><input type="hidden" name="total" value="' . $per_page_total . '" />';

			$row_color = ( !($i % 2) ) ? $theme['td_color1'] : $theme['td_color2'];
			$row_class = ( !($i % 2) ) ? $theme['td_class1'] : $theme['td_class2'];

			$template->set_filenames(array(
				"body" => "admin/smile_list_body.tpl")
			);

			$template->assign_vars(array(
				"ROW_COLOR" => "#" . $row_color,
				"ROW_CLASS" => $row_class,
				"L_PAGE_TITLE" => $lang['smiley_cat_list_title'],
				"L_PAGE_DESCRIPTION" => $lang['smiley_cat_list_description'],
				"L_CATEGORY" => $lang['cat_name'],
				"L_CATEGORY_DESC" => $lang['cat_description'],
				"L_CATEGORY_OPTIONS" => $lang['smiley_cat_options'],

				"L_CODE" => $lang['Code'],
				"L_SMILE" => $lang['Smile'],
				"L_EMOT" => $lang['Emotion'],
				"L_MOVE" => $lang['smiley_cat_move'],
				"L_ORDER" => $lang['order'],
				"L_ORDER_NUM" => $lang['order_num'],
				"L_DELETE" => $lang['Delete'],

				"L_TICK_ALL" => $lang['tick_all'],
				"L_UNTICK_ALL" => $lang['untick_all'],
				"L_IMPORT_EXPORT" => $lang['import_export'],
				"L_SMILEY_ADD" => $lang['smile_add'],
				"L_MULTI_EDIT_SUBMIT" => $lang['multi_edit_submit'],

				"S_CAT_EMPTY" => $cat_empty,
				"S_CAT_NAME" => $array_cat_data[$cat_order-1]['cat_name'],
				"S_CAT_DESCRIPTION" => $array_cat_data[$cat_order-1]['description'],
				"S_HIDDEN_FIELDS" => $s_hidden_fields,
				"S_SMILEY_TOTAL" => $smile_count,
				"S_SMILEY_ACTION" => append_sid("admin_smilies.$phpEx"),
				"S_PAGINATION" => $pagination)
			);

			// Loop through the rows of smilies.
			for( $i=$smiley_start; $i<$smiley_stop; $i++ )
			{
				// Setup the drop down list of categories for each smiley.
				$category_list = '';
				for( $j=0; $j<$num_cats; $j++ )
				{
					$selected1 = ( $array_cat_data[$j]['cat_order'] == $cat_order ) ? ' selected="selected"' : '';
					$category_list .= '<option value="' . $array_cat_data[$j]['cat_id'] . '|' . $array_cat_data[$j]['cat_order'] . '"' . $selected1 . '>' . $array_cat_data[$j]['cat_name'] . '</option>';
				}

				// Setup the dropdown list of order numbers for each smiley.
				$order = '';
				for( $k=1; $k<=$smile_count; $k++ )
				{
					$selected2 = ( $k == $smile_row[$i]['smilies_order'] ) ? ' selected="selected"' : '';
					$order .= '<option value="' . $smile_row[$i]['smilies_order'] . '|' . $k . '"' . $selected2 . '>' . $k . '</option>';
				}

				// Replace htmlentites for < and > with actual character.
				$smile_row[$i]['code'] = str_replace('&lt;', '<', $smile_row[$i]['code']);
				$smile_row[$i]['code'] = str_replace('&gt;', '>', $smile_row[$i]['code']);

				$row_color = ( !($i % 2) ) ? $theme['td_color1'] : $theme['td_color2'];
				$row_class = ( !($i % 2) ) ? $theme['td_class1'] : $theme['td_class2'];

				$template->assign_block_vars("smiles", array(
					"ROW_COLOR" => "#" . $row_color,
					"ROW_CLASS" => $row_class,

					"SMILEY_CODE" => $smile_row[$i]['code'],
					"SMILEY_EMOTICON" => $smile_row[$i]['emoticon'],
					"SMILEY_IMG" => $phpbb_root_path . $board_config['smilies_path'] . '/' . $smile_row[$i]['smile_url'],
					"SMILEY_URL" => $smile_row[$i]['smile_url'],
					"SMILEY_ORDER" => $order,
					"SMILEY_COUNT" => $i+1,
					"SMILEY_ID" => $smile_row[$i]['smilies_id'],

					"CATEGORY_LIST" => $category_list,
					"SMILEY_ORDER_ACTION" => append_sid("admin_smilies.$phpEx?mode=smiley_order&amp;id=" . $smile_row[$i]['smilies_id'] . "&amp;cat=" . $cat_id . "|" . $cat_order . "&amp;start=" . $start))
				);
			}

		break;

		case "smiley_order":
			//
			// Admin has changed a smiley order. Smiley List Utility Page
			//

			//
			// Get the submitted data being careful to ensure the the data
			// we recieve and process is only the data we are looking for.
			//
			$smiley_id = ( isset($HTTP_GET_VARS['id']) ) ? intval($HTTP_GET_VARS['id']) : '';
			$cat = ( isset($HTTP_GET_VARS['cat']) ) ? $HTTP_GET_VARS['cat'] : '';
			$old_order = ( isset($HTTP_GET_VARS['old']) ) ? intval($HTTP_GET_VARS['old']) : '';
			$new_order = ( isset($HTTP_GET_VARS['new']) ) ? intval($HTTP_GET_VARS['new']) : '';
			$start = ( isset($HTTP_GET_VARS['start']) ) ? intval($HTTP_GET_VARS['start']) : 0;

			// Get the two values from $cat variable.
			list($cat_id, $cat_order) = explode("|", $cat);

			// Check for order change
			if( $old_order != $new_order )
			{
				// Has the smiley been moved Up?
				if( $new_order > $old_order )
				{
					// Update smilies order.
					$sql = "UPDATE " . SMILIES_TABLE . "
						SET smilies_order = smilies_order - 1
						WHERE cat_id = '" . $cat_order . "'
							AND smilies_order > '" . $old_order . "'
							AND smilies_order <= " . $new_order;
					if( !$result = $db->sql_query($sql) )
					{
						message_die(GENERAL_ERROR, "Couldn't update smiley database.", "", __LINE__, __FILE__, $sql);
					}
					else
					{
						// Now update smilies order to that what it was changed to.
						$sql = "UPDATE " . SMILIES_TABLE . "
							SET smilies_order = '" . $new_order . "'
							WHERE smilies_id = " . $smiley_id;
						if( !$result = $db->sql_query($sql) )
						{
							message_die(GENERAL_ERROR, "Couldn't update smiley database.", "", __LINE__, __FILE__, $sql);
						}
						else
						{
							$message = sprintf($lang['smiley_order_success'], $old_order, $new_order) . "<br /><br />" . sprintf($lang['Click_return_listadmin'], "<a href=\"" . append_sid("admin_smilies.$phpEx?mode=edit&amp;cat=$cat_id|$cat_order&amp;start=$start") . "\">", "</a>") . "<br /><br />" . sprintf($lang['Click_return_catadmin'], "<a href=\"" . append_sid("admin_smilies.$phpEx") . "\">", "</a>");
						}
					}
				}

				// Has the smiley been moved Down?
				if( $new_order < $old_order )
				{
					// Update smilies order.
					$sql = "UPDATE " . SMILIES_TABLE . "
						SET smilies_order = smilies_order + 1
						WHERE cat_id = '" . $cat_order . "'
							AND smilies_order >= '" . $new_order . "'
							AND smilies_order < " . $old_order;
					if( !$result = $db->sql_query($sql) )
					{
						message_die(GENERAL_ERROR, "Couldn't update smiley database.", "", __LINE__, __FILE__, $sql);
					}
					else
					{
						// Now update smilies order to that what it was changed to.
						$sql = "UPDATE " . SMILIES_TABLE . "
							SET smilies_order = '" . $new_order . "'
							WHERE smilies_id = " . $smiley_id;
						if( !$result = $db->sql_query($sql) )
						{
							message_die(GENERAL_ERROR, "Couldn't update smiley database.", "", __LINE__, __FILE__, $sql);
						}
						else
						{
							$message = sprintf($lang['smiley_order_success'], $old_order, $new_order) . "<br /><br />" . sprintf($lang['Click_return_listadmin'], "<a href=\"" . append_sid("admin_smilies.$phpEx?mode=edit&amp;cat=$cat_id|$cat_order&amp;start=$start") . "\">", "</a>") . "<br /><br />" . sprintf($lang['Click_return_catadmin'], "<a href=\"" . append_sid("admin_smilies.$phpEx") . "\">", "</a>");
						}
					}
				}
			}
			else
			{
				$message = sprintf($lang['smiley_order_nochange'], $old_order, $new_order) . "<br /><br />" . sprintf($lang['Click_return_listadmin'], "<a href=\"" . append_sid("admin_smilies.$phpEx?mode=edit&amp;cat=$cat_id|$cat_order&amp;start=$start") . "\">", "</a>") . "<br /><br />" . sprintf($lang['Click_return_catadmin'], "<a href=\"" . append_sid("admin_smilies.$phpEx") . "\">", "</a>");
			}
			message_die(GENERAL_MESSAGE, $message);

		break;

		case "smiley_save":
			//
			// Admin has submitted changes while editing a smiley.
			//

			//
			// Get the submitted data, being careful to ensure that we only
			// accept the data we are looking for.
			//
			$smile_id = ( isset($HTTP_POST_VARS['smile_id']) ) ? intval($HTTP_POST_VARS['smile_id']) : '';
			$smile_code = ( isset($HTTP_POST_VARS['smile_code']) ) ? trim($HTTP_POST_VARS['smile_code']) : '';
			$smile_url = ( isset($HTTP_POST_VARS['smile_url']) ) ? trim($HTTP_POST_VARS['smile_url']) : '';
			$smile_emoticon = ( isset($HTTP_POST_VARS['smile_emoticon']) ) ? trim($HTTP_POST_VARS['smile_emoticon']) : '';
			$smile_cat_name = ( isset($HTTP_POST_VARS['smile_category']) ) ? $HTTP_POST_VARS['smile_category'] : '';
			$smile_add = ( isset($HTTP_POST_VARS['add']) ) ? intval($HTTP_POST_VARS['add']) : '';
			$smile_delete = ( isset($HTTP_POST_VARS['delete']) ) ? intval($HTTP_POST_VARS['delete']) : '';
			$orig_id_order = ( isset($HTTP_POST_VARS['id_order']) ) ? $HTTP_POST_VARS['id_order'] : '';

			if( isset($HTTP_POST_VARS['multi']) )
			{
				$multi_cats = '&amp;multi=' . $HTTP_POST_VARS['multi'];
			}

			// If no code was entered complain ...
			if( ($smile_code == '') || ($smile_url == '') ) { message_die(MESSAGE, $lang['Fields_empty']); }

			// Convert < and > to proper htmlentities for parsing.
			$smile_code = str_replace('<', '&lt;', $smile_code);
			$smile_code = str_replace('>', '&gt;', $smile_code);

			// Get the two values from $smile_cat_name variable.
			list($cat_id, $cat_order) = explode("|", $smile_cat_name);

			// Get smiley count for category.
			$sql = "SELECT *
				FROM " . SMILIES_TABLE . "
				WHERE cat_id = " . $cat_order;
			$result = $db->sql_query($sql);
			if( !$result ) { message_die(GENERAL_ERROR, "Couldn't select category database.", "", __LINE__, __FILE__, $sql); }
			$smile_count = $db->sql_numrows($result);

			$lastsmiley = $smile_count + 1;

			if ( $smile_add == 1 )
			{
				// Create a new smiley.
				$sql = "INSERT INTO " . SMILIES_TABLE . " (code, smile_url, emoticon, cat_id, smilies_order) 
					VALUES('" . str_replace("\'", "''", $smile_code) . "', '" . str_replace("\'", "''", $smile_url) . "', '" . str_replace("\'", "''", $smile_emoticon) . "', '" . $cat_order . "', '" . $lastsmiley . "')";
				if( !$result = $db->sql_query($sql) )
				{
					message_die(GENERAL_ERROR, "Couldn't insert new smiley into database", "", __LINE__, __FILE__, $sql);
				}
				else
				{
					$message = $lang['smiley_add_success'] . "<br /><br />" . sprintf($lang['Click_return_smileadmin'], "<a href=\"" . append_sid("admin_smilies.$phpEx?mode=edit&amp;cat=$cat_id|$cat_order") . "\">", "</a>") . "<br /><br />" . sprintf($lang['Click_return_catadmin'], "<a href=\"" . append_sid("admin_smilies.$phpEx") . "\">", "</a>");
				}
			}
			else
			{
				// Get the three values from $orig_id_order variable. Original cat data.
				list($cat_id1, $cat_order1, $smilies_order1) = explode("|", $orig_id_order);

				// If smiley is selected for deletion...
				if ( $smile_delete == 1 )
				{
					// Delete smiley from the smiley table.
					$sql = "DELETE FROM " . SMILIES_TABLE . "
						WHERE smilies_id = " . $smile_id;
					if( !$result = $db->sql_query($sql) )
					{
						message_die(GENERAL_ERROR, "Couldn't delete smiley from database", "", __LINE__, __FILE__, $sql);
					}
					else
					{
						// Update the smilies order.
						$sql = "UPDATE " . SMILIES_TABLE . "
							SET smilies_order = smilies_order - 1
							WHERE cat_id = '" . $cat_order1 . "'
								AND smilies_order > " . $smilies_order1;
						$result = $db->sql_query($sql);
						if( !$result ) { message_die(GENERAL_ERROR, "Couldn't update smiley in database", "", __LINE__, __FILE__, $sql); }

						$message = $lang['smiley_del_success'] . "<br /><br />" . sprintf($lang['Click_return_catlistadmin'], "<a href=\"" . append_sid("admin_smilies.$phpEx?cat_view&amp;cat=$cat_id1|$cat_order1$multi_cats") . "\">", "</a>") . "<br /><br />" . sprintf($lang['Click_return_catadmin'], "<a href=\"" . append_sid("admin_smilies.$phpEx") . "\">", "</a>");

					}
				}
				else
				{
					if( $cat_id1 != $cat_id )
					{
						// A different category has been selected.

						// Update smiley details.
						$sql = "UPDATE " . SMILIES_TABLE . "
							SET code = '" . str_replace("\'", "''", $smile_code) . "', smile_url = '" . str_replace("\'", "''", $smile_url) . "', emoticon='" . str_replace("\'", "''", $smile_emoticon) . "', cat_id='" . $cat_order . "', smilies_order='" . $lastsmiley . "'
							WHERE smilies_id=" . $smile_id;
						if( !$result = $db->sql_query($sql) )
						{
							message_die(GENERAL_ERROR, "Couldn't update smiley database.", "", __LINE__, __FILE__, $sql);
						}
						else
						{
							// Update smiley order for old category.
							$sql = "UPDATE " . SMILIES_TABLE . "
								SET smilies_order = smilies_order - 1
								WHERE cat_id = '" . $cat_order1 . "'
									AND smilies_order > " . $smilies_order1;
							$result = $db->sql_query($sql);
							if( !$result ) { message_die(GENERAL_ERROR, "Couldn't update smiley database.", "", __LINE__, __FILE__, $sql); }
						}
					}
					else
					{
						// Still the same category.

						// Update smiley details.
						$sql = "UPDATE " . SMILIES_TABLE . "
							SET code = '" . str_replace("\'", "''", $smile_code) . "', smile_url = '" . str_replace("\'", "''", $smile_url) . "', emoticon = '" . str_replace("\'", "''", $smile_emoticon) . "'
							WHERE smilies_id = " . $smile_id;
						$result = $db->sql_query($sql);
						if( !$result ) { message_die(GENERAL_ERROR, "Couldn't update smilies info", "", __LINE__, __FILE__, $sql); }
					}

					$message = $lang['smiley_edit_success'] . "<br /><br />" . sprintf($lang['Click_return_catlistadmin'], "<a href=\"" . append_sid("admin_smilies.$phpEx?cat_view&amp;cat=$cat_id|$cat_order$multi_cats") . "\">", "</a>") . "<br /><br />" . sprintf($lang['Click_return_catadmin'], "<a href=\"" . append_sid("admin_smilies.$phpEx") . "\">", "</a>");
				}
			}

			message_die(GENERAL_MESSAGE, $message);

		break;

		case "addunused":
			//
			// Admin has selected unused smilies to add.
			//

			//
			// Get the submitted data, being careful to ensure that we only
			// accept the data we are looking for.
			//
			$total = ( isset($HTTP_POST_VARS['total']) ) ? intval($HTTP_POST_VARS['total']) : '';
			$code = ( isset($HTTP_POST_VARS['code']) ) ? intval($HTTP_POST_VARS['code']) : '0';
			$start = ( isset($HTTP_POST_VARS['start']) ) ? intval($HTTP_POST_VARS['start']) : '0';
			$cat = ( isset($HTTP_POST_VARS['cat']) ) ? intval($HTTP_POST_VARS['cat']) : '1';

			$additions = '0';
			$errors = '0';

			for( $i=1; $i<=$total; $i++ )
			{
				// Get the submitted data from the other fields now.
				$smiley_code = ( isset($HTTP_POST_VARS["code$i"]) ) ? trim($HTTP_POST_VARS["code$i"]) : '';
				$smiley_url = ( isset($HTTP_POST_VARS["url$i"]) ) ? trim($HTTP_POST_VARS["url$i"]) : '';
				$smiley_emot = ( isset($HTTP_POST_VARS["emot$i"]) ) ? trim($HTTP_POST_VARS["emot$i"]) : '';
				$smiley_cat = ( isset($HTTP_POST_VARS["cat$i"]) ) ? $HTTP_POST_VARS["cat$i"] : '';
				$smiley_add = ( isset($HTTP_POST_VARS["add$i"]) ) ? intval($HTTP_POST_VARS["add$i"]) : '';

				if( $smiley_add )
				{
					if( $smiley_code )
					{
						// $smiley_cat contains two values, the category's id and order values.
						list($cat_id, $cat_order) = explode("|", $smiley_cat);

						// If no code was entered complain ...
						if( $smiley_code == '' ) { message_die(MESSAGE, $lang['Fields_empty']); }

						// Convert < and > to proper htmlentities for parsing.
						$smiley_code = str_replace('<', '&lt;', $smiley_code);
						$smiley_code = str_replace('>', '&gt;', $smiley_code);

						// Get smiley count for category.
						$sql = "SELECT *
							FROM " . SMILIES_TABLE . "
							WHERE cat_id = " . $cat_order;
						$result = $db->sql_query($sql);
						if( !$result ) { message_die(GENERAL_ERROR, "Couldn't select category database.", "", __LINE__, __FILE__, $sql); }
						$smile_count = $db->sql_numrows($result);

						$lastsmiley = $smile_count + 1;

						// Insert a new smiley.
						$sql = "INSERT INTO " . SMILIES_TABLE . " (code, smile_url, emoticon, cat_id, smilies_order) 
							VALUES('" . str_replace("\'", "''", $smiley_code) . "', '" . str_replace("\'", "''", $smiley_url) . "', '" . str_replace("\'", "''", $smiley_emot) . "', '" . $cat_order . "', '" . $lastsmiley . "')";
						if( !$result = $db->sql_query($sql) )
						{
							message_die(GENERAL_ERROR, "Couldn't insert new smiley into database", "", __LINE__, __FILE__, $sql);
						}
						else
						{
							$additions++;
						}
					}
					else
					{
						$errors++;
					}
				}
			}

			$plural1 = ( $additions == '1' ) ? $lang['smiley_multi_add_success1'] : $lang['smiley_multi_add_success2'];
			$plural2 = ( $errors == '1' ) ? $lang['smiley_errors1'] : $lang['smiley_errors2'];

			$message = sprintf($plural1, $additions) . " " .  sprintf($plural2, $errors, $total) . "<br /><br />" . sprintf($lang['Click_return_unusedadmin'], "<a href=\"" . append_sid("admin_smilies.$phpEx?unused_smilies&amp;cat=$cat&amp;code=$code&amp;start=$start") . "\">", "</a>") . "<br /><br />" . sprintf($lang['Click_return_catadmin'], "<a href=\"" . append_sid("admin_smilies.$phpEx") . "\">", "</a>");

			message_die(GENERAL_MESSAGE, $message);

		break;

		case "view_perms":
			//
			// Admin has selected to view an overall view of smiley category permissions per forum.
			//

			// More or less took all this code from admin_forums.php.
			$template->set_filenames(array(
				'body' => 'admin/smile_perms_body.tpl')
			);

			$sql = "SELECT cat_id, cat_title, cat_order
				FROM " . CATEGORIES_TABLE . "
				ORDER BY cat_order";
			if( !$cat_result = $db->sql_query($sql) )
			{
				message_die(GENERAL_ERROR, "Could not query categories list", "", __LINE__, __FILE__, $sql);
			}

			if( $total_categories = $db->sql_numrows($cat_result) )
			{
				$category_rows = $db->sql_fetchrowset($cat_result);

				$sql = "SELECT forum_id, cat_id, forum_name, forum_desc
					FROM " . FORUMS_TABLE . "
					ORDER BY cat_id, forum_order";
				if( !$forum_result = $db->sql_query($sql) )
				{
					message_die(GENERAL_ERROR, "Could not query forums information", "", __LINE__, __FILE__, $sql);
				}

				if( $total_forums = $db->sql_numrows($forum_result) )
				{
					$forum_rows = $db->sql_fetchrowset($forum_result);
				}

				$viewable_in3 = '';
				for( $m=0; $m<$num_cats; $m++ )
				{
					if( ($array_cat_data[$m]['cat_category'] == -2) || ($array_cat_data[$m]['cat_forum'] == -2) )
					{
						$viewable_in3 .= '<tr><td width="50%" nowrap="nowrap"><a href="' . append_sid("admin_smilies.$phpEx?mode=edit&amp;cat=" . $array_cat_data[$m]['cat_id'] . '|' . $array_cat_data[$m]['cat_order']) . '" title="' . $lang['click_edit'] . '"><span class="gen">' . $array_cat_data[$m]['cat_name'] . '</span></a></td>';

						$num = $array_cat_data[$m]['cat_perms'];
						$viewable_in3 .= '<td width="50%" nowrap="nowrap"><span class="gen">-- ' . $lang['perms'][$num] . '</span></td></tr>';
					}
				}
				$viewable_in3 = ( $viewable_in3 ) ? $viewable_in3 : '<tr><td colspan="2" align="center" valign="middle">--</td></tr>';

				$template->assign_vars(array(
					'L_PAGE_TITLE' => $lang['perms_title'], 
					'L_PAGE_DESC' => $lang['perms_desc'],
					'L_HEADER1' => $lang['perms_header1'],
					'L_HEADER2' => $lang['perms_header2'],
					'L_HEADER3' => $lang['perms_header3'],
					'L_HEADER4' => $lang['perms_header4'],
					'ROW_SPAN3' => $total_forums + $total_categories + $total_categories + 1,
					'VIEWABLE_IN3' => $viewable_in3)
				);

				// Start outputting categories.
				for( $i=0; $i<$total_categories; $i++ )
				{
					$cat_id = $category_rows[$i]['cat_id'];

					$count2 = 0;
					for( $j=0; $j<$total_forums; $j++ )
					{
						if( $forum_rows[$j]['cat_id'] == $cat_id )
						{
							$count2++;
						}
					}

					$viewable_in2 = '';
					for( $m=0; $m<$num_cats; $m++ )
					{
						if( $array_cat_data[$m]['cat_category'] == $cat_id )
						{
							$viewable_in2 .= '<tr><td width="50%" nowrap="nowrap"><a href="' . append_sid("admin_smilies.$phpEx?mode=edit&amp;cat=" . $array_cat_data[$m]['cat_id'] . '|' . $array_cat_data[$m]['cat_order']) . '" title="' . $lang['click_edit'] . '"><span class="gen">' . $array_cat_data[$m]['cat_name'] . '</span></a></td>';

							$num = $array_cat_data[$m]['cat_perms'];
							$viewable_in2 .= '<td width="50%" nowrap="nowrap"><span class="gen">-- ' . $lang['perms'][$num] . '</span></td></tr>';
						}
					}
					$viewable_in2 = ( $viewable_in2 ) ? $viewable_in2 : '<tr><td colspan="2" align="center" valign="middle">--</td></tr>';

					$template->assign_block_vars("catrow", array( 
						'CAT_DESC' => $category_rows[$i]['cat_title'],
						'ROW_SPAN2' => $count2+1,
						'VIEWABLE_IN2' => $viewable_in2,

						'U_VIEWCAT' => append_sid($phpbb_root_path . "index.$phpEx?" . POST_CAT_URL . "=$cat_id"))
					);

					// Start outputting forums.
					for( $j=0; $j<$total_forums; $j++ )
					{
						$forum_id = $forum_rows[$j]['forum_id'];

						if( $forum_rows[$j]['cat_id'] == $cat_id )
						{
							$row_class = ( !($j % 2) ) ? $theme['td_class1'] : $theme['td_class2'];

							$viewable_in1 = '';
							for( $k=0; $k<$num_cats; $k++ )
							{
								if( $array_cat_data[$k]['cat_forum'] == $forum_id )
								{
									$viewable_in1 .= '<tr><td width="50%" nowrap="nowrap" class="' . $row_class . '"><a href="' . append_sid("admin_smilies.$phpEx?mode=edit&amp;cat=" . $array_cat_data[$k]['cat_id'] . '|' . $array_cat_data[$k]['cat_order']) . '" title="' . $lang['click_edit'] . '"><span class="gen">' . $array_cat_data[$k]['cat_name'] . '</span></a></td>';

									$num = $array_cat_data[$k]['cat_perms'];
									$viewable_in1 .= '<td width="50%" nowrap="nowrap" class="' . $row_class . '"><span class="gen">-- ' . $lang['perms'][$num] . '</span></td></tr>';
								}
							}
							$viewable_in1 = ( $viewable_in1 ) ? $viewable_in1 : '<tr><td colspan="2" align="center" valign="middle">--</td></tr>';

							$template->assign_block_vars("catrow.forumrow",	array(
								'FORUM_NAME' => $forum_rows[$j]['forum_name'],
								'FORUM_DESC' => $forum_rows[$j]['forum_desc'],
								'VIEWABLE_IN1' => $viewable_in1,
								'VIEWABLE_BY' => $viewable_by,
								'ROW_CLASS' => $row_class,

								'U_VIEWFORUM' => append_sid($phpbb_root_path."viewforum.$phpEx?" . POST_FORUM_URL . "=$forum_id"))
							);

						}
			
					}

				}

			}
		break;

		case "popup_test":
			//
			// Admin has selected to test the popup window size.
			//

			//
			// Get the submitted data, being careful to ensure that we only
			// accept the data we are looking for.
			//
			$cat = ( isset($HTTP_GET_VARS['cat']) ) ? intval($HTTP_GET_VARS['cat']) : '';
			$start = ( isset($HTTP_GET_VARS['start']) ) ? intval($HTTP_GET_VARS['start']) : '0';
			$width = ( isset($HTTP_GET_VARS['width']) ) ? intval($HTTP_GET_VARS['width']) : '410';
			$height = ( isset($HTTP_GET_VARS['height']) ) ? intval($HTTP_GET_VARS['height']) : '300';
			$window_columns = ( isset($HTTP_GET_VARS['col']) ) ? intval($HTTP_GET_VARS['col']) : '9';
			$pop_per_page = ( isset($HTTP_GET_VARS['perp']) ) ? intval($HTTP_GET_VARS['perp']) : '0';

			$gen_simple_header = TRUE;

			$template->set_filenames(array(
				'body' => 'admin/smile_popup_body.tpl')
			);

			$sql = "SELECT emoticon, code, smile_url   
				FROM " . SMILIES_TABLE . " 
				WHERE cat_id = $cat
				ORDER BY smilies_order
				ASC";
			if( $result = $db->sql_query($sql) )
			{
				$num_smilies = 0;
				$rowset = array();
				$rowset2 = array();
				while( $row = $db->sql_fetchrow($result) )
				{
					if( ($key = array_search($row['smile_url'], $rowset2)) === FALSE )
					{
						$rowset2[$num_smilies] = $row['smile_url'];
						$rowset[$num_smilies]['code'] = str_replace("'", "\\'", str_replace('\\', '\\\\', $row['code']));
						$rowset[$num_smilies]['emoticon'] = $row['emoticon'];
						$num_smilies++;
					}
				}

				if( $num_smilies )
				{
					$smilies_split_row = $window_columns - 1;
					$s_colspan = 0;
					$row = 0;
					$col = 0;

					if( $pop_per_page == 0 )
					{
						$per_page = $num_smilies;
						$smiley_start = 0;
						$smiley_stop = $num_smilies;
					}
					else
					{
						$per_page = ( $pop_per_page > $num_smilies ) ? $num_smilies : $pop_per_page;
						$page_num = ( $start <= 0 ) ? 1 : ($start / $per_page) + 1;
						$smiley_start = ($per_page * $page_num) - $per_page;
						$smiley_stop = ( ($per_page * $page_num) > $num_smilies ) ? $num_smilies : $smiley_start + $per_page;
					}

					for( $i=$smiley_start; $i<$smiley_stop; $i++ )
					{
						if( !$col )
						{
							$template->assign_block_vars('smilies_row', array());
						}

						$template->assign_block_vars('smilies_row.smilies_col', array(
							'SMILEY_CODE' => $rowset[$i]['code'],
							'SMILEY_IMG' => $phpbb_root_path . $board_config['smilies_path'] . '/' . $rowset2[$i],
							'SMILEY_DESC' => $rowset[$i]['emoticon'])
						);

						$s_colspan = max($s_colspan, $col + 1);

						if( $col == $smilies_split_row )
						{
							if( $mode == 'inline' && $row == $inline_rows - 1 )
							{
								break;
							}
							$col = 0;
							$row++;
						}
						else
						{
							$col++;
						}
					}

					$pagination = generate_pagination("admin_smilies.$phpEx?mode=popup_test&amp;cat=$cat&amp;perp=$pop_per_page&amp;width=$width&amp;height=$height&amp;col=$window_columns", $num_smilies, $per_page, $start, FALSE);

					$template->assign_vars(array(
						'S_WIDTH' =>  $width,
						'S_HEIGHT' =>  $height,
						'L_EMOTICONS' => $lang['Emoticons']. ' - ' . $lang['perms'][$array_cat_data[$cat-1]['cat_perms']],
						'L_CLOSE_WINDOW' => $lang['Close_window'],
						'PAGINATION' => $pagination,
						'S_SMILIES_COLSPAN' => $s_colspan)
					);
				}
			}
		break;
	}
}
else
{
	//
	// This is the main page before the admin has selected any options.
	//

	read_smiles_directory($board_config['smilies_path']);

	// If there are smilies, compare them with those in the database, how many are not installed?
	if( $total = count($smiley_images) )
	{
		// Put the smilies from the db in an array.
		$sql = "SELECT smile_url
			FROM " . SMILIES_TABLE;
		$result = $db->sql_query($sql);
		if( !$result ) { message_die(GENERAL_ERROR, "Couldn't get smiley data from database", "", __LINE__, __FILE__, $sql); }

		$rowset = array();
		while( $row = $db->sql_fetchrow($result) )
		{
			if( empty($rowset[$row['smile_url']]) )
			{
				$rowset[] = $row['smile_url'];
			}
		}

		// Find the differences between the two arrays.
		$counts = array_diff($smiley_images, $rowset);
		$image_count = count($counts);
	}

	// Get forum details for dropdown menu
	$sql = "SELECT c.cat_id, c.cat_title, f.forum_id, f.forum_name
		FROM " . CATEGORIES_TABLE . " c, " . FORUMS_TABLE . " f
		WHERE f.cat_id = c.cat_id
		ORDER BY c.cat_order, f.forum_order";
	if( !($result = $db->sql_query($sql)) )
	{
		message_die(GENERAL_ERROR, 'Could not obtain forums information', '', __LINE__, __FILE__, $sql);
	}

	$forum_ids = array();

	while( $row = $db->sql_fetchrow($result) )
	{
		$forum_ids[] = $row;
	}

	// Create forum dropdown menu
	$forum_list = '<option value="-1|-1">' . $lang['viewable_forum_select'] . '</option><option value="-1|-1">--------------------</option><option value="-2|-2">' . $lang['viewable_forum_all'] . '</option><option value="-1|-1">&nbsp;</option>';
	$forum_add = '<option value="-1|-1">&nbsp;</option><option value="-1|-1">' . $lang['viewable_category_select'] . '</option><option value="-1|-1">--------------------</option><option value="-2|-2">' . $lang['viewable_category_all'] . '</option><option value="-1|-1">&nbsp;</option>';

	if( $total_forums = count($forum_ids) )
	{
		for( $j=0; $j<$total_forums; $j++ )
		{
			$forum_list .=  '<option value="' . $forum_ids[$j]['forum_id'] . '|-1">' . $forum_ids[$j]['forum_name'] . '</option>';

			$id = ( $id != 0 ) ? $id : 0;
			if( $forum_ids[$j]['cat_id'] != $id )
			{
				$forum_list2 .=  '<option value="-1|' . $forum_ids[$j]['cat_id'] . '">' . $forum_ids[$j]['cat_title'] . '</option>';
				$id = $forum_ids[$j]['cat_id'];
			}
		}
	}

	$forum_list = $forum_list . $forum_add . $forum_list2;

	// Create other dropdown menus
	$category_info = '_A[0] = "";_B[0] = "";_C[0] = "";_D[0] = "";_E[0] = "";_F[0] = "";_G[0] = "";_H[0] = "";_I[0] = "";_J[0] = "";' . "\n";
	$category_edit = '';
	$category_view = '';
	$category_list = '';
	$category_import = '';
	$category_export = '<option value="0" selected="selected">' . $lang['export_all'] . '</option>';
	$category_num = '';

	for( $i=0; $i<$num_cats; $i++ )
	{
		list($width, $height, $cols) = explode("|", $array_cat_data[$i]['smilies_popup']);

		$j = $i + 1;
		$category_info .= '_A[' . $j . '] = "' . $array_cat_data[$i]['cat_name'] . '";_B[' . $j . '] = "' . $array_cat_data[$i]['description'] . '";_C[' . $j . '] = "' . $array_cat_data[$i]['cat_id'] . '|' . $array_cat_data[$i]['cat_order'] . '";_D[' . $j . '] = "' . $array_cat_data[$i]['cat_perms'] . '";_E[' . $j . '] = "' . $array_cat_data[$i]['cat_forum'] . '|' . $array_cat_data[$i]['cat_category'] . '";_F[' . $j . '] = "' . $array_cat_data[$i]['cat_icon_url'] . '";_G[' . $j . '] = "' . $array_cat_data[$i]['smilies_per_page'] . '";_H[' . $j . '] = "' . $width . '";_I[' . $j . '] = "' . $height . '";_J[' . $j . '] = "' . $cols . '";' . "\n";
		$category_view .= '<option value="' . $array_cat_data[$i]['cat_id'] . '|' . $array_cat_data[$i]['cat_order'] . '">' . $array_cat_data[$i]['cat_name'] . '</option>';
		$category_list .= '<option value="' . $j . '">' . $array_cat_data[$i]['cat_name'] . '</option>';
		$category_import .= '<option value="' . $array_cat_data[$i]['cat_order'] . '">' . $array_cat_data[$i]['cat_name'] . '</option>';
		$category_num .= '<option value="' . $array_cat_data[$i]['cat_id'] . '|' . $array_cat_data[$i]['cat_order'] . '">' . $j . '</option>';
	}

	$category_edit .= $category_list;
	$category_export .= $category_import;

	// Create *.PAK file dropdown list.
	$smile_paks_select = '<option value="0">' . $lang['select_paks'] . '</option>';
	while( list($key, $value) = @each($smiley_paks) )
	{
		if( !empty($value) )
		{
			$smile_paks_select .= '<option value="' . $value . '">' . $value . '</option>';
		}
	}

	// Create dropdown smiley filename list.
	if( $board_config['smilie_icon_path'] != $board_config['smilies_path'] )
	{
		unset($smiley_images);
		read_smiles_directory($board_config['smilies_icon_path']);
	}

	$category_icon = '';
	for( $i=0; $i<count($smiley_images); $i++ )
	{
		$category_icon .= '<option value="' . $smiley_images[$i] . '">' . $smiley_images[$i] . '</option>';
	}
	$category_icon2 = '<option value="blank_icon.gif">' . $lang['select_cat_icon'] . '</option>' . $category_icon;

	$template->set_filenames(array(
		"body" => "admin/smile_main_body.tpl")
	);

	$s_hidden_fields3 = '<input type="hidden" name="cat_id" value="" />';
	$s_hidden_fields4 = '<input type="hidden" name="default" value="' . $array_cat_data[0]['cat_id'] . '|' . $array_cat_data[0]['cat_order'] . '" />';

	$row_color = ( !($i % 2) ) ? $theme['td_color1'] : $theme['td_color2'];
	$row_class = ( !($i % 2) ) ? $theme['td_class1'] : $theme['td_class2'];

	$template->assign_vars(array(
		"ROW_COLOR" => "#" . $row_color,
		"ROW_CLASS" => $row_class,
		"CAT_COUNT" => $num_cats,

		"L_SMILEY_TITLE" => $lang['smiley_title_main'],
		"L_SMILEY_TEXT" => $lang['smiley_desc_main'],
		"L_ADD" => $lang['add_title'],
		"L_EDIT" => $lang['edit_title'],
		"L_ADD_DESC" => $lang['add_description'],
		"L_EDIT_DESC" => $lang['edit_description'],
		"L_CAT_NAME" => $lang['cat_name'],
		"L_CAT_DESC" => $lang['cat_description'],
		"L_PER_PAGE" => $lang['smilies_per_page'],
		"L_PER_PAGE_LIMIT" => $lang['smilies_no_limit'],
		"L_POPUP_X" => $lang['popup_x'],
		"L_POPUP_SIZE" => $lang['popup_size'],
		"L_POPUP_SIZE_ATTRIBS" => $lang['popup_size_attribs'],
		"L_POPUP_COLS" => $lang['popup_columns'],
		"L_POPUP_TEST" => $lang['popup_size_test'],
		"L_POPUP_ALERT" => $lang['popup_alert'],
		"L_VIEWABLE_BY" => $lang['viewable_by'],
		"L_VIEWABLE_IN" => $lang['viewable_in'],
		"L_PERMS0" => $lang['perms']['5'],
		"L_PERMS1" => $lang['perms']['1'],
		"L_PERMS2" => $lang['perms']['2'],
		"L_PERMS3" => $lang['perms']['3'],
		"L_PERMS4" => $lang['perms']['4'],
		"L_ORDER" => $lang['order_position'],
		"L_FIRST" => $lang['order_first'],
		"L_LAST" => $lang['order_last'],
		"L_AFTER" => $lang['order_after'],
		"L_ORDER_CHANGE" => $lang['order_change'],
		"L_CAT_ICON" => $lang['cat_icon'],
		"L_EDIT_DELETE" => $lang['edit_delete'],

		"L_SMILEY_IMPORT" => $lang['import_title'],
		"L_SMILEY_EXPORT" => $lang['export_title'],
		"L_SELECT_PAK" => $lang['choose_smiley_pak'],
		"L_SELECT_IMPORT" => $lang['import_cat'],
		"L_IMPORT" => $lang['import_button'],
		"L_IMPORT_DESCRIPTION" => sprintf($lang['import_description'], $board_config['smilies_path']),
		"L_CONFLICTS" => $lang['smiley_conflicts'],
		"L_DEL_EXISTING" => $lang['delete_smiley'],
		"L_DEL_EXISTING_ALL" => $lang['delete_all'],
		"L_REPLACE_EXISTING" => $lang['existing_replace'], 
		"L_KEEP_EXISTING" => $lang['existing_keep'],
		"L_EXPORT" => $lang['export_button'],
		"L_EXPORT_DESCRIPTION" => $lang['export_description'],
		"L_EXPORT_TYPE" => $lang['export_type'],
		"L_EXPORT_TYPE_PAK" => $lang['export_type_pak'],
		"L_EXPORT_TYPE_CAT" => $lang['export_type_cat'],
		"L_SELECT_EXPORT" => $lang['export_cat'],

		"L_UNUSED_SMILIES" => $lang['smilies_unused'],
		"L_UNUSED_SMILIES_TITLE" => $lang['smilies_unused_title'],
		"L_UNUSED_SMILIES_DESC" => $lang['smilies_unused_desc'],
		"L_SMILIES_UNUSED_NUM" => $lang['smilies_unused_num'],
		"L_SMILEY_FILENAME_CODE" => $lang['smiley_filename_code'],
		"L_SELECT_CAT" => $lang['select_cat'],
		"L_CAT_VIEW" => $lang['view_button'],
		"L_CAT_VIEW_TITLE" => $lang['view_title'],
		"L_CAT_VIEW_DESC" => $lang['view_description'],

		"L_NO" => $lang['No'],
		"L_YES" => $lang['Yes'],
		"L_SUBMIT" => $lang['submit'],

		"S_SMILIES_UNUSED_NUM" => $image_count,
		"S_HIDDEN_FIELDS3" => $s_hidden_fields3,
		"S_HIDDEN_FIELDS4" => $s_hidden_fields4,
		"S_CAT_FORUM" => $forum_list,
		"S_CAT_PAK" => $smile_paks_select,
		"S_CAT_IMPORT" => $category_import,
		"S_CAT_EXPORT" => $category_export,
		"S_CAT_EDIT" => $category_edit,
		"S_CAT_INFO" => $category_info,
		"S_CAT_LIST" => $category_list,
		"S_CAT_VIEW" => $category_view,
		"S_CAT_ORDER" => $category_num,
		"S_CAT_ICON1" => $category_icon,
		"S_CAT_ICON2" => $category_icon2,
		"SMILEY_IMG" => $phpbb_root_path . $board_config['smilie_icon_path'] . '/blank_icon.gif',
		"S_SMILEY_BASEDIR" => $phpbb_root_path . $board_config['smilie_icon_path'],
		"S_SMILEY_CAT_ACTION" => append_sid("admin_smilies.$phpEx"),
		"U_FORUM_PERMS" => append_sid("admin_smilies.$phpEx?mode=view_perms"),
		"U_MORE_SMILIES" => append_sid("admin_smilies.$phpEx?mode=popup_test"))
	);
}

//
// Spit out the page.
//
$template->pparse("body");

//
// Page Footer
//
include('./page_footer_admin.'.$phpEx);

//
// WOW!!! Can't believe there are 2305 lines in this file. :D
//
?>
