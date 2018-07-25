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
$lang['mod_qte_explain'] = 'Permet d\'appliquer un attribut, comme <font color="006600">[R&eacute;gl&eacute;]</font>, aux titres des sujets. L\'attribut peut, selon le choix de l\'administrateur lors de la cr&eacute;ation, être appliqu&eacute; par l\'administrateur, le mod&eacute;rateur ou l\'auteur du sujet.';

/**
* admin part
*/
if ( $lang_extend_admin )
{
	$lang['Attributes'] = 'Attributs';
	$lang['Attributes_System'] = 'Gestion du syst&egrave;me d\'attributs';
	$lang['Attributes_System_Explain'] = 'Vous pouvez ici &eacute;diter, supprimer et cr&eacute;er des attributs.';

	// list
	$lang['Attribute'] = 'Attribut';
	$lang['Attribute_Color'] = 'Couleur de l\'attribut';
	$lang['Attribute_None'] = '<em>N/A</em>';

	// permissions
	$lang['Attribute_Permissions'] = 'Permissions';
		$lang['Administrator'] = 'Administrateur';
		$lang['Moderator'] = 'Mod&eacute;rateur';
		$lang['Author'] = 'Auteur';

	// editor
	$lang['New_Attribute'] = 'Ajouter un nouvel attribut';
	$lang['Attribute_Edit'] = '&Eacute;dition de l\'attribut <span style="color:%s">%s</span>';

	// position
	$lang['Attribute_Position'] = 'Position';
		$lang['Left'] = 'Gauche';
		$lang['Right'] = 'Droite';

	// messages
	$lang['Click_Return_Attributes_Management'] = 'Cliquez %sici%s pour retourner au gestionnaire du syst&egrave;me d\'attributs';
	$lang['Attribute_Added'] = 'Attribut ajout&eacute;';
	$lang['Attribute_Updated'] = 'Attribut mis &agrave; jour';
	$lang['Attribute_Removed'] = 'Attribut supprim&eacute;';
	$lang['Field_error'] = 'Entr&eacute;e invalide sur le champ: ';
	$lang['Attribute_Order_Updated'] = 'Le positionnement de l\'attribut a &eacute;t&eacute; mis &agrave; jour.';
	$lang['Attribute_Confirm_Delete'] = 'Confirmez-vous la suppression de cet attribut ?';

	// explanations
	$lang['Attribute_Explain'] = '- Vous pouvez aussi utiliser une cl&eacute; du tableau <strong>$lang[]</strong>, ou entrer le nom en clair<br />- Ins&eacute;rer <b>%mod%</b> affichera le nom de la personne ayant appliqu&eacute; l\'attribut<br />- Ins&eacute;rer <strong>%date%</strong> affichera la date du jour o&ugrave; l\'attribut a &eacute;t&eacute; appliqu&eacute;<br /><br />- Exemple : <strong>[R&eacute;gl&eacute; par %mod%]</strong> affichera <strong>[R&eacute;gl&eacute; par <strong>NomDuMod&eacute;rateur</strong>]';
	$lang['New_Attribute_Explain'] = 'Vous pouvez cr&eacute;er de courts morceaux de phrases informatives que vous pourrez ensuite ajouter au titre d\'un sujet en cliquant simplement sur un bouton.';
	$lang['Attribute_Edit_Explain'] = 'Vous pouvez ici modifier les champs de l\'attribut s&eacute;lectionn&eacute;.';
	$lang['Attribute_Permissions_Explain'] = 'Les membres ayant ce niveau pourront appliquer des attributs';
	$lang['Attribute_Color_Explain'] = 'Vous pouvez modifier la valeur de la couleur du texte de l\'attribut.<br />Cette valeur doit &ecirc;tre sous forme hexad&eacute;cimale sans le # devant.<br />Si vous voulez afficher le texte avec la couleur par d&eacute;faut, laissez ce champ vide.';
	$lang['Attribute_Position_Explain'] = 'Choisissez si l\'attribut sera situ&eacute; &agrave; gauche ou &agrave; droite du titre du sujet';
	$lang['Must_Select_Attribute'] = 'Vous devez s&eacute;lectionner un attribut';
}

/*
* Moderation
*/
$lang['No_Attribute'] = 'Aucun';
$lang['Attribute_apply'] = 'Appliquer';
$lang['Attribute_Edited'] = 'L\'attribut a &eacute;t&eacute; appliqu&eacute;/modifi&eacute;.';

?>
