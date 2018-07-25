<?php
/***************************************************************************
 *                            def_icons.php
 *                            -------------
 *	begin			: 06/09/2003
 *	copyright		: Ptirhiik
 *	email			: admin@rpgnet-fr.com
 *	version			: 1.0.0 - 06/09/2003
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

$icones = array(
		array(
			'ind'	=> 1,
			'img'	=> 'images/icon/icon1.gif',
			'alt'	=> 'icon_funny',
			'auth'	=> AUTH_ALL,
	),
		array(
			'ind'	=> 2,
			'img'	=> 'images/icon/icon2.gif',
			'alt'	=> 'icon_unhappy',
			'auth'	=> AUTH_ALL,
	),
		array(
			'ind'	=> 3,
			'img'	=> 'images/icon/icon3.gif',
			'alt'	=> 'icon_sleepy',
			'auth'	=> AUTH_ALL,
	),
		array(
			'ind'	=> 4,
			'img'	=> 'images/icon/icon4.gif',
			'alt'	=> 'icon_complicity',
			'auth'	=> AUTH_ALL,
	),
		array(
			'ind'	=> 5,
			'img'	=> 'images/icon/icon5.gif',
			'alt'	=> 'icon_shocked',
			'auth'	=> AUTH_ALL,
	),
		array(
			'ind'	=> 6,
			'img'	=> 'images/icon/icon6.gif',
			'alt'	=> 'icon_mocker',
			'auth'	=> AUTH_ALL,
	),
		array(
			'ind'	=> 7,
			'img'	=> 'images/icon/icon7.gif',
			'alt'	=> 'icon_angry',
			'auth'	=> AUTH_ALL,
	),
		array(
			'ind'	=> 8,
			'img'	=> 'images/icon/icon8.gif',
			'alt'	=> 'icon_disgusting',
			'auth'	=> AUTH_ALL,
	),
		array(
			'ind'	=> 9,
			'img'	=> 'images/icon/icon9.gif',
			'alt'	=> 'icon_impressed',
			'auth'	=> AUTH_ALL,
	),
		array(
			'ind'	=> 10,
			'img'	=> 'images/icon/icon10.gif',
			'alt'	=> 'icon_cool',
			'auth'	=> AUTH_ALL,
	),
		array(
			'ind'	=> 11,
			'img'	=> 'images/icon/icon11.gif',
			'alt'	=> 'icon_important',
			'auth'	=> AUTH_ALL,
	),
		array(
			'ind'	=> 12,
			'img'	=> 'images/icon/icon12.gif',
			'alt'	=> 'icon_love',
			'auth'	=> AUTH_ALL,
	),
		array(
			'ind'	=> 13,
			'img'	=> 'images/icon/icon13.gif',
			'alt'	=> 'icon_warning',
			'auth'	=> AUTH_ALL,
	),
		array(
			'ind'	=> 14,
			'img'	=> 'images/icon/icon14.gif',
			'alt'	=> 'icon_question',
			'auth'	=> AUTH_ALL,
	),
	);

// definition of special topic
$icon_defined_special = array(
		'POST_GLOBAL_ANNOUNCE' => array(
		'lang_key'	=> 'Post_Global_Announcement',
		'icon'		=> 0,
	),
		'POST_ANNOUNCE' => array(
		'lang_key'	=> 'Post_Announcement',
		'icon'		=> 0,
	),
		'POST_STICKY' => array(
		'lang_key'	=> 'Post_Sticky',
		'icon'		=> 0,
	),
		'POST_NORMAL' => array(
		'lang_key'	=> 'Post_Normal',
		'icon'		=> 0,
	),
	);

?>