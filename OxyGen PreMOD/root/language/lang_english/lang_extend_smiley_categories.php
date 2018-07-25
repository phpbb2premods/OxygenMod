<?php
/***************************************************************************
 *                     lang_admin_smiley_categories.php [English]
 *                            -------------------
 *   begin                : Sunday, April 27th, 2004
 *   copyright            : (C) 2004 Afkamm
 *   email                : phpbb@afkamm.co.uk
 *   website		  : http://mods.afkamm.co.uk
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

//
// Category Configuration Page
//
$lang['smiley_title_main'] = 'Category Configuration Page';
$lang['smiley_desc_main'] = 'From this page you can add and edit categories. Once you have created at least 1 category you can begin adding smilies. If there is more than 1 then you can put them into an order as to how you wish them to appear on the Posting page. A category that "nobody" has permission to view will not be seen by any forum users and the smilies within will not appear in any posts.';
// Add
$lang['add_title'] = 'Add a Category';
$lang['add_description'] = 'You can add a new category with this form, just enter a name and a description and then click the submit button. The category icon is only required if you\'re using buttons and want that button to be an image.<br /><br /><span style="color: red;">*Use letters and numbers only!</span>';
$lang['add_success'] = 'Category added successfully';
$lang['add_fail'] = 'Error: You failed to enter a name and/or description!';
$lang['cat_name'] = 'Category Name';
$lang['cat_description'] = 'Category Description';
// Edit
$lang['edit_title'] = 'Edit a Category';
$lang['edit_description'] = 'Select the category that you wish to edit from the dropdown menu. The details should appear in the boxes below, edit them to your liking and click the submit button to save the changes. You do not have to submit changes to test the popup size.';
$lang['edit_success'] = 'Category edited successfully';
$lang['edit_success_up'] = 'Category edited and moved up successfully';
$lang['edit_success_down'] = 'Category edited and moved down successfully';
$lang['edit_fail'] = 'Error: You failed to enter a name and/or description!';
$lang['select_cat'] = 'Select a category';
$lang['edit_delete'] = 'Tick this box to delete the selected category - ';
$lang['smiley_cat_del_fail'] = 'Error: Category does not exist!';
// Add & Edit
$lang['smilies_per_page'] = 'Smilies per page';
$lang['smilies_no_limit'] = '(enter 0 for no limit)';
$lang['viewable_by'] = 'Viewable by';
$lang['viewable_in'] = 'Viewable in';
$lang['viewable_forum_select'] = 'Select a Forum';
$lang['viewable_forum_all'] = 'All Forums and PMs';
$lang['viewable_category_select'] = 'Or Select a Category';
$lang['viewable_category_all'] = 'All Categories and PMs';
$lang['perms']['5'] = 'Nobody';
$lang['perms']['1'] = 'Everyone';
$lang['perms']['2'] = 'Regs and up';
$lang['perms']['3'] = 'Mods and up';
$lang['perms']['4'] = 'Admins only';
$lang['popup_x'] = 'x';
$lang['popup_size'] = 'Popup window size';
$lang['popup_size_attribs'] = '(width x height)';
$lang['popup_columns'] = 'Popup window columns';
$lang['popup_size_test'] = 'Click this link to test the popup window size';
$lang['popup_alert'] = 'Please select a category first!';
$lang['order_position'] = 'Order position';
$lang['order_first'] = 'First';
$lang['order_last'] = 'Last';
$lang['order_after'] = 'After';
$lang['order_change'] = '(select a new position)';
$lang['cat_icon'] = 'Category icon';
$lang['select_cat_icon'] = 'Select or leave blank';
$lang['submit'] = 'Submit';
// Import
$lang['import_title'] = 'Smiley Pack Import';
$lang['import_description'] = 'If your *.pak, *.pak2 files don\'t show up in the list below, make sure that you have uploaded them to the correct directory which is <b>/%s</b>.<br /><br /><span style="color: red;">*These options are not required when importing a .pak2 file.</span>';
$lang['import_button'] = 'Import';
$lang['select_paks'] = 'Select Pack (.pak, .pak2) File';
$lang['choose_smiley_pak'] = 'Choose a smiley pack file';
$lang['smiley_conflicts'] = 'What should be done in case of conflicts';
$lang['delete_smiley'] = 'Delete existing smileys before import';
$lang['delete_all'] = 'Delete existing categories before import';
$lang['existing_replace'] = 'Replace Existing Smiley';
$lang['existing_keep'] = 'Keep Existing Smiley';
$lang['import_cat'] = 'Import to the following Category';
$lang['smiley_import_success1'] = 'The Standard Smiley Pack was imported successfully!<br />%s new %s were added and %s existing replaced.';
$lang['smiley_import_success2'] = 'The Advanced Smiley Pack was imported successfully!<br />You now have %s new %s and %s new %s.';
$lang['smiley_import_fail'] = 'Error: No *.pak, *.pak2 file was selected!';
// Export
$lang['export_title'] = 'Smiley Pack Export';
$lang['export_description'] = 'Export just one category at a time by selecting it from the list below, or export all the smilies in one file. If you want to save the category information as well, select <b>advanced (.pak2)</b> below.';
$lang['export_button'] = 'Export';
$lang['export_type'] = 'What type of Export';
$lang['export_type_pak'] = 'Standard (.pak)';
$lang['export_type_cat'] = 'Advanced (.pak2)';
$lang['export_all'] = 'Export all together';
$lang['export_cat'] = 'Export the following Category';
$lang['export_smiles1'] = 'To create a smiley pack from your currently installed smileys, click %sHere%s to download the smiles.pak2 file. Name this file appropriately making sure to keep the .pak2 file extension.  Then create a zip file containing all of your smiley images plus this .pak2 configuration file.';
$lang['export_smiles2'] = 'To create a smiley pack from your currently installed smileys, click %sHere%s to download the smiles.pak file. Name this file appropriately making sure to keep the .pak file extension.  Then create a zip file containing all of your smiley images plus this .pak configuration file.';
// Unused
$lang['smilies_unused'] = 'View Unused';
$lang['smilies_unused_title'] = 'View Unused Smilies';
$lang['smilies_unused_desc'] = 'If you don\'t have a *.pak file, then use this option. You\'ll only see the smilies that are not already installed. This way you wont get duplicates and can then go on to add them to a category.';
$lang['smilies_unused_num'] = 'Smilies not installed';
$lang['smiley_filename_code'] = 'Use filename for code';
// View
$lang['view_title'] = 'View Categories';
$lang['view_description'] = 'Select the categories that you wish to view. (CTRL+LEFT CLICK sets/clears selections). If you have a hundred smilies or less, or fast broadband, viewing all the categories at once shouldn\'t be a problem. If you have a few hundred smilies, you may wish to view a couple of categories at a time.';
$lang['view_button'] = 'View Categories';


//
// Category Viewing Page
//
$lang['smiley_cat_title'] = 'Category Viewing Page';
$lang['smiley_cat_description'] = 'Click any smiley to edit those details. Click the edit link under the options column for any given category to view a detailed list of the smilies that are inside and allow for mass editing. Only categories that are empty have a delete link available, so to delete a category first delete or more all the smilies that are inside it. Hidden categories cannot be seen by forum members and any smiley inside will not appear in the forum posts.';
$lang['smiley_count'] = 'Count';
$lang['smiley_cat_options'] = 'Options';
$lang['smiley_cat_del_success'] = 'Category deleted successfully';
$lang['smiley_cat_empty'] = '<span style="color: red">There are no smilies in this category.</span>';
$lang['smiley_cat_select'] = 'Select a Category';


//
// Smiley Editing Page
//
$lang['smiley_cat_list_title'] = 'Smiley Editing Page';
$lang['smiley_cat_list_description'] = 'From here you can edit multiple smilies at once instead of just one at a time. If you should see a pink background in the code section, this means that the code for this smiley has been matched elsewhere, either in this category or another. No two smilies may have the same code so please change them until all are unique.<br /><br /><span style="color: red;">Warning: The Order dropdown menu uses javascript which will submit the new order value as soon as it\'s selected. They are not part of the main form so don\'t go editing codes etc. and then try and change an order as you\'ll lose your changes.</span>';
$lang['smiley_cat_move'] = 'Move';
$lang['multi_edit_submit'] = 'Submit Changes';
$lang['multi_delete1'] = '%s smiley was deleted.';
$lang['multi_delete2'] = '%s smilies were deleted.';
$lang['multi_updated1'] = '%s smiley was updated. ';
$lang['multi_updated2'] = '%s smilies were updated. ';
$lang['order_num'] = '#';
$lang['order'] = 'Order';
$lang['smiley_order_success'] = 'The smiley was successfully moved from position %s to %s.';
$lang['smiley_order_nochange'] = 'The smiley position was not changed.';
$lang['click_edit'] = 'Click to edit';


//
// Unused Smiley List Page
//
$lang['smiley_unused_title'] = 'Unused Smiley Page';
$lang['smiley_unused_desc'] = 'This is the list of smilies that are in the smiley folder, but are not installed. Enter a code and emoticon for the smiley you wish to install, not forgetting to tick the box, select a category and then when finished, click the submit button. If you try to add a smiley with an empty code box, then that smiley will not get installed.';
$lang['smile_tick_add'] = 'Add Smiley';
$lang['category'] = 'Category';
$lang['tick_all'] = 'Tick all';
$lang['untick_all'] = 'Untick all';
$lang['smiley_multi_add_success1'] = '%s smiley was successfully added.';
$lang['smiley_multi_add_success2'] = '%s smilies were successfully added.';
$lang['smiley_errors1'] = 'There was %s error out of a possible %s.';
$lang['smiley_errors2'] = 'There were %s errors out of a possible %s.';


//
// Smiley Add/Edit Utility Page
//
$lang['smiley_add_title'] = 'Smiley Add Utility';
$lang['smiley_edit_title'] = 'Smiley Edit Utility';
$lang['smiley_edit'] = 'Edit Smiley';
$lang['smiley_delete'] = 'Delete this smiley';


//
// Overall View of the Permissions
//
$lang['perms_title'] = 'Overall View For Smiley Permissions';
$lang['perms_desc'] = 'This page allows you to see at a glance which smiley categories go with each forum and who is able to view them in that forum. Clicking a smiley category will take you straight to the editing page.';
$lang['perms_header1'] = 'Categories and Forums';
$lang['perms_header2'] = 'Forum Smilies';
$lang['perms_header3'] = 'Category Smilies';
$lang['perms_header4'] = 'Board Smilies & PMs';


//
// Return Links
//
$lang['Click_return_listadmin'] = 'Click %sHere%s to return to the Smiley Editing Page';
$lang['Click_return_catadmin'] = 'Click %sHere%s to return to the Category Configuration Page';
$lang['Click_return_catlistadmin'] = 'Click %sHere%s to return to the Category Viewing Page';
$lang['Click_return_unusedadmin'] = 'Click %sHere%s to return to the Unused Smiley Page';


//
// Misc.
//
$lang['category'] = 'category';
$lang['categories'] = 'categories';
$lang['smiley'] = 'smiley';
$lang['smilies'] = 'smilies';


//
// Advanced .pak2 file.
//
$lang['pak_header'] = "#############################################################\r\n## This file was produced using the Smiley Categories MOD for\r\n## phpBB2. DO NOT attempt to import it into a forum that does\r\n## not have this MOD installed. DO NOT alter any of the lines\r\n## below unless you know what you're doing and know how the\r\n## MOD works. Thankyou for using Smiley Categories -- Marc :)\r\n#############################################################\r\n";


//
// This is the end, beautiful friend,
// This is the end, my only friend,
// The end. -- The Doors
//
?>
