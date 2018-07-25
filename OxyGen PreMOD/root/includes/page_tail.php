<?php
/***************************************************************************
 *                              page_tail.php
 *                            -------------------
 *   begin                : Saturday, Feb 13, 2001
 *   copyright            : (C) 2001 The phpBB Group
 *   email                : support@phpbb.com
 *
 *   $Id: page_tail.php,v 1.27.2.4 2005/09/14 18:14:30 acydburn Exp $
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
	die('Hacking attempt');
}

global $do_gzip_compress;

//
// Show the overall footer.
//
$admin_link = ( $userdata['user_level'] == ADMIN ) ? '<a href="admin/index.' . $phpEx . '?sid=' . $userdata['session_id'] . '" title="' . $lang['Admin_panel'] . '">' . $lang['Admin_panel'] . '</a><br /><br />' : '';

$template->set_filenames(array(
	'overall_footer' => ( empty($gen_simple_header) ) ? 'overall_footer.tpl' : 'simple_footer.tpl')
);

$template->assign_vars(array(
	'TRANSLATION_INFO' => (isset($lang['TRANSLATION_INFO'])) ? $lang['TRANSLATION_INFO'] : ((isset($lang['TRANSLATION'])) ? $lang['TRANSLATION'] : ''),
	'ADMIN_LINK' => $admin_link)
);

//-- mod : board generation time info ------------------------------------------
//-- add
$endtime = microtime();
$endtime = explode(' ', microtime());
$endtime = $endtime[1] + $endtime[0];
$gentime = round(($endtime - $starttime), 5);

$gzip_status = ($board_config['gzip_compress']) ? $lang['Gzip_on'] : '';
$debug_status = (DEBUG) ? $lang['Debug_on'] : $lang['Debug_off'];
$queries_display = sprintf($lang['Queries'], $db->num_queries);
$generation_time = sprintf($lang['Generation_time'], $gentime);

$template->assign_vars(array(
	'STATISTICS' => '[ ' . $generation_time . ' ][ ' . $queries_display . ' ][ ' . $gzip_status . $debug_status . ' ]')
);
//-- fin mod : board generation time info --------------------------------------

$template->pparse('overall_footer');

//-- mod : oxygen premod -------------------------------------------------------
//-- add
$oxygen_version = sprintf($lang['OxyGen_PreMOD'], $board_config['oxygen_version']);
$oxygen_display = '<br class="nav" /><table cellpadding="2" cellspacing="1" border="0" width="100%" class="bodyline"><tr><td class="gensmall" colspan="2" align="center"><span class="copyright">' . $oxygen_version . '</span></td></tr></table>';
echo $oxygen_display;
//-- fin mod : oxygen premod ---------------------------------------------------

//
// Close our DB connection.
//
$db->sql_close();

//
// Compress buffered output if required and send to browser
//
//-- mod : oxygen premod -------------------------------------------------------
//-- delete
/*-MOD
if ( $do_gzip_compress )
{
	//
	// Borrowed from php.net!
	//
	$gzip_contents = ob_get_contents();
	ob_end_clean();

	$gzip_size = strlen($gzip_contents);
	$gzip_crc = crc32($gzip_contents);
	$gzip_contents = gzcompress($gzip_contents, 9);
	$gzip_contents = substr($gzip_contents, 0, strlen($gzip_contents) - 4);

	echo "\x1f\x8b\x08\x00\x00\x00\x00\x00";
	echo $gzip_contents;
	echo pack('V', $gzip_crc);
	echo pack('V', $gzip_size);
}
MOD-*/
//-- add
header ('Expires: 0');
header ('Pragma: no-cache');
header ('X-Powered-By:');
header ('Server:');

if( function_exists(ob_gzhandler) && $board_config['gzip_compress'])
{
	$gzip_contents = ob_get_contents();

	ob_end_clean();
	ob_start('ob_gzhandler');

	echo $gzip_contents;

	Header('Vary: Accept-Encoding');

	ob_end_flush();
}
else
{
	$contents = ob_get_contents();
	ob_end_clean();
	echo $contents;
	global $dbg_starttime;
}
//-- fin mod : oxygen premod ---------------------------------------------------

exit;

?>
