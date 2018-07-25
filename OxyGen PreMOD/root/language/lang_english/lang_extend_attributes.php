<?php
/**
*
* @package quick title edition
* @version $Id: lang_extend_attributes.php,v 1.0.5 2007/02/24 ABDev Exp $
* @copyright (c) 2007 ABDev, OxyGen Powered
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
*
* Original author : Xavier Olive, xavier@2037.biz, 2003
*/

if ( !defined('IN_PHPBB') )
{
	die('Hacking attempt');
}

/**
* description
*/
$lang['mod_qte_title'] = 'Quick Title Edition';
$lang['mod_qte_explain'] = 'Allows to apply an attribute, like <font color="006600">[Solved]</font>, to the topics titles. According to the administrator choice during the creation, the attribute can be applied by the administrator, the moderator or the topic poster.';

/**
* admin part
*/
if ( $lang_extend_admin )
{
	$lang['Attributes'] = 'Attributes';
	$lang['Attributes_System'] = 'Attributes Management';
	$lang['Attributes_System_Explain'] = 'Here you can edit, delete and create attributes.';

	// list
	$lang['Attribute'] = 'Attribute';
	$lang['Attribute_Color'] = 'Attribute color';
	$lang['Attribute_None'] = '<em>N/A</em>';

	// permissions
	$lang['Attribute_Permissions'] = 'Permissions';
		$lang['Administrator'] = 'Administrator';
		$lang['Moderator'] = 'Moderator';
		$lang['Author'] = 'Author';

	// editor
	$lang['New_Attribute'] = 'Add a new attribute';
	$lang['Attribute_Edit'] = 'Edit <span style="color:%s">%s</span> attribute';

	// position
	$lang['Attribute_Position'] = 'Position';
		$lang['Left'] = 'Left';
		$lang['Right'] = 'Right';

	// messages
	$lang['Click_Return_Attributes_Management'] = 'Click %shere%s to return to the attributes management';
	$lang['Attribute_Added'] = 'Attribut added';
	$lang['Attribute_Updated'] = 'Attribut updated';
	$lang['Attribute_Removed'] = 'Attribute removed';
	$lang['Field_error'] = 'Invalid entry on the field: ';
	$lang['Attribute_Order_Updated'] = 'Attribute order updated.';
	$lang['Attribute_Confirm_Delete'] = 'Are you sure you want to delete this attribute ?';

	// explanations
	$lang['Attribute_Explain'] = '- You can use too a lang entry key, or enter directly the rank name<br />- Insert <b>%mod%</b> will display the user name who applied the attribute<br />- Insert <strong>%date%</strong> will display the day date when the attribute was applied<br /><br />- Example : <strong>[Solved by %mod%]</strong> will display <strong>[Solved by <strong>ModeratorName</strong>]';
	$lang['New_Attribute_Explain'] = 'You can create short bits of text wich you will be able to add to the title of a topic, by pushing a single button.';
	$lang['Attribute_Edit_Explain'] = 'Here, you can modify the fields of the selected attribute.';
	$lang['Attribute_Permissions_Explain'] = 'Users with these levels will be able to apply attributes';
	$lang['Attribute_Color_Explain'] = 'Here, you can modify the value of the attribute color.<br />This value must be in hexadecimal form without # in front.<br />If you do not want to display text information with default color, leave the field blank.';
	$lang['Attribute_Position_Explain'] = 'Choose if the attribute has to be placed on the left or on the right from the topic title';
	$lang['Must_Select_Attribute'] = 'You have to select an attribute';
}

/*
* Moderation
*/
$lang['No_Attribute'] = 'None';
$lang['Attribute_apply'] = 'Apply';
$lang['Attribute_Edited'] = 'The attribute has been added/modified.';

?>
