<?php
/**
*
* @package post_description_mod [english]
* @version $Id: lang_extend_sub_title.php,v 1.0 24/08/2006 17:18 reddog Exp $
* @copyright (c) 2006 reddog - http://www.reddevboard.com/
* @license http://opensource.org/licenses/gpl-license.php GNU Public License 
*
*/

if (!defined('IN_PHPBB'))
{
	die('Hacking attempt');
}

// admin part
if ( $lang_extend_admin )
{
	// sub-title
	$lang['Sub_title_length'] = 'Title length of the sub-title (description)';
	$lang['Sub_title_length_explain'] = 'Set the number of chars you want to display for the sub-title (description). Set it to 0 if you doesn\'t want to use the sub-title on the board.';
}

// main
$lang['Sub_title'] = 'Subject description';

?>