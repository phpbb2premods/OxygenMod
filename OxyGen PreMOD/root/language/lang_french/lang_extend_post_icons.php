<?php
/***************************************************************************
 *						lang_extend_post_icons.php [French]
 *						--------------------------
 *	begin				: 28/09/2003
 *	copyright			: Ptirhiik
 *	email				: ptirhiik@clanmckeen.com
 *
 *	version				: 1.0.1 - 28/10/2003
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
if ( $lang_extend_admin )
{
	$lang['Lang_extend_post_icons']		= 'Post Icons';

	$lang['Icons_settings_explain']		= 'Vous pourrez ici ajouter, �diter ou supprimer des ic�nes de messages.';
	$lang['Icons_auth']					= 'Niveau d\'autorisations';
	$lang['Icons_auth_explain']			= 'L\'ic�ne ne sera accessible seulement qu\'aux utilisateurs ayant au moins ce niveau d\'autorisation.';
	$lang['Icons_defaults']				= 'Utilis� par d�faut';
	$lang['Icons_defaults_explain']		= 'Cette valeur sera utilis�e sur la liste des sujets lorsqu\'aucune ic�ne n\'a �t� d�finie sp�cifiquement pour ce sujet.';
	$lang['Icons_delete']				= 'Supprimer une ic�ne';
	$lang['Icons_delete_explain']		= 'Choisissez une ic�ne de remplacement pour celle-ci :';
	$lang['Icons_confirm_delete']		= 'Etes vous s�r de vouloir supprimer cette ic�ne ?';

	$lang['Icons_lang_key']				= 'Nom de l\'ic�ne';
	$lang['Icons_lang_key_explain']		= 'Le contenu de cette zone sera affich� lorsque l\'utilisateur passera sa souris sur le lien ou sur l\'ic�ne (mot cl�s HTML : title & alt). Vous pouvez entrer ici du texte, ou une cl� du tableau des langues. <br />(se r�f�rer � language/lang_<i>votre_language</i>/lang_main.php)';
	$lang['Icons_icon_key']				= 'Icon';
	$lang['Icons_icon_key_explain']		= 'Lien vers une ic�ne ou une cl� du tableau des images ($images[]). <br />(se r�f�rer � templates/<i>votre_th�me</i>/<i>votre_th�me</i>.cfg)';

	$lang['Icons_error_title']			= 'Le nom de l\'ic�ne est vide';
	$lang['Icons_error_del_0']			= 'Vous ne pouvez pas supprimer l\'ic�ne vide par d�faut.';

	$lang['Refresh']					= 'R�afficher';
	$lang['Usage']						= 'Utilisation';

	$lang['Image_key_pick_up']			= 'Choisir une cl� du tableau des images';
	$lang['Lang_key_pick_up']			= 'Choisir une cl� du tableau des langues';
}

$lang['Icons_settings']			= 'Ic�nes de messages';
$lang['Icons_per_row']			= 'Nombre d\'ic�ne par lignes';
$lang['Icons_per_row_explain']	= 'Renseignez ici le nombre d\'ic�nes affich�es par ligne dans l\'�cran de postage.';
$lang['post_icon_title']		= 'Ic�ne de messages';
// icons

$lang['post_icon_title']		= 'Ic�ne de messages';
$lang['icon_none']				= 'pas d\'ic�ne';
$lang['icon_note']				= 'Note';
$lang['icon_important']			= 'Important';
$lang['icon_idea']				= 'Id�e';
$lang['icon_warning']			= 'Attention !';
$lang['icon_question']			= 'Question';
$lang['icon_cool']				= 'D�tente';
$lang['icon_funny']				= 'Marrant';
$lang['icon_angry']				= 'Grrrr !';
$lang['icon_sad']				= 'Snif !';
$lang['icon_mocker']			= 'H�h�h� !';
$lang['icon_shocked']			= 'Oooh !';
$lang['icon_complicity']		= 'Complice';
$lang['icon_bad']				= 'Nul !';
$lang['icon_great']				= 'G�nial !';
$lang['icon_disgusting']		= 'Beurk !';
$lang['icon_winner']			= 'Gniark !';
$lang['icon_impressed']			= 'Ah oui !';
$lang['icon_roleplay']			= 'Roleplay';
$lang['icon_fight']				= 'Combat';
$lang['icon_loot']				= 'Loot';
$lang['icon_picture']			= 'Image';
$lang['icon_calendar']			= 'Ev�nement du calendrier';
$lang['icon_love']			= 'Coup de coeur';
$lang['icon_unhappy']			= 'Pas content';
$lang['icon_sleepy']			= 'Endormi';

?>
