<?php
/***************************************************************************
 *						lang_extend_external_hosting.php 
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

// admin part

	// menu - titles - explain
	$lang['ext_adm_hosting'] = 'Ext. hosting';
	$lang['ext_adm_hosting_title'] = 'Admin external hosting';
	$lang['ext_adm_explain'] = 'Here you can set the configuration for external hosting.<br />One hoster should at least always be activated.';
	$lang['ext_adm_chg_hoster'] = 'Change / delete existing hoster';
	$lang['ext_adm_new_hoster'] = 'Set new hoster';

	// titles and explanations for hosters
	$lang['ext_adm_hoster_enable'] = 'Active';
	$lang['ext_adm_hoster_name'] = 'Hoster name';
	$lang['ext_adm_hoster_name_explain'] = 'Fill in the name of the hoster.';
	$lang['ext_adm_hoster_url'] = 'Hoster URL';
	$lang['ext_adm_hoster_url_explain'] = 'Fill in the URL of the hoster, if possible direct to the upload page.<br />Start with "http://".';
	$lang['ext_adm_hoster_ub'] = 'Use Uploadbox';
	$lang['ext_adm_hoster_ubc'] = 'Uploadbox Code';
	$lang['ext_adm_hoster_ubc_explain'] = 'Fill in the code you received from the hoster.';
	$lang['ext_adm_change'] = 'Change';
	$lang['ext_adm_delete'] = 'Delete';
	$lang['ext_adm_new'] = 'Save';
	$lang['ext_adm_reset'] = 'Reset';
	
	// return page
	$lang['ext_adm_change_done'] = 'Data for external hoster succesfully changed.';
	$lang['ext_adm_delete_done'] = 'Data for external hoster succesfully deleted.';
	$lang['ext_adm_insert_done'] = 'Data for external hoster succesfully inserted.';
	$lang['ext_adm_click_return'] = 'Click %shere%s to go back to the hosting settings .';
	$lang['ext_adm_index_return'] = 'Click %shere%s to go back to the index.';
	
	
// main language
	
	// titles - explain
	$lang['ext_hosting_title'] = 'External file hosting';
	$lang['ext_host_explain'] = 'Here you can choose an external hoster for your files. Please take note about the different ToS for each provider.';
	$lang['ext_host_button'] = 'Open in new window';
	
?>