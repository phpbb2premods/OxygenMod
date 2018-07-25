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
	die('Hacking attempt');
}

// admin part

	// menu - titles - explain
	$lang['ext_adm_hosting'] = 'Hébergement externe';
	$lang['ext_adm_hosting_title'] = 'Administration de l\'hébergement externe';
	$lang['ext_adm_explain'] = 'Depuis ce panneau vous pouvez régler la configuration de l\'hébergement externe.<br />Au moins un hébergeur devra être activé.';
	$lang['ext_adm_chg_hoster'] = 'Modifier / supprimer un hébergeur existant';
	$lang['ext_adm_new_hoster'] = 'Inscrire un nouvel hébergeur';

	// titles and explanations for hosters
	$lang['ext_adm_hoster_enable'] = 'Activé';
	$lang['ext_adm_hoster_name'] = 'Nom de l\'hébergeur';
	$lang['ext_adm_hoster_name_explain'] = 'Remplir ce champ avec le nom de l\'hébergeur.';
	$lang['ext_adm_hoster_url'] = 'URL de l\'hébergeur';
	$lang['ext_adm_hoster_url_explain'] = 'Remplir ce champ avec l\'URL de l\'hébergeur, si possible le lien direct vers la page prévu à l\'envoi de données.<br />Commencez avec "http://".';
	$lang['ext_adm_hoster_ub'] = 'Utiliser la boite d\'envoi de données';
	$lang['ext_adm_hoster_ubc'] = 'Code de la boite';
	$lang['ext_adm_hoster_ubc_explain'] = 'Remplir ce champ avec le code envoyé par l\'hébergeur.';
	$lang['ext_adm_change'] = 'Modifier';
	$lang['ext_adm_delete'] = 'Supprimer';
	$lang['ext_adm_new'] = 'Sauvegarder';
	$lang['ext_adm_reset'] = 'Initialiser';
	
	// return page
	$lang['ext_adm_change_done'] = 'Données de l\'hébergeur externe modifiées avec succès.';
	$lang['ext_adm_delete_done'] = 'Données de l\'hébergeur externe supprimées avec succès.';
	$lang['ext_adm_insert_done'] = 'Données de l\'hébergeur externe insérées avec succès.';
	$lang['ext_adm_click_return'] = 'Cliquez %sici%s pour revenir aux réglages de l\'hébergement externe.';
	$lang['ext_adm_index_return'] = 'Cliquez %sici%s pour revenir à l\'Index d\'Administration';
	
	
// main language
	
	// titles - explain
	$lang['ext_hosting_title'] = 'Hébergement externe de fichiers';
	$lang['ext_host_explain'] = 'Vous pouvez choisir un hébergeur externe pour vos fichiers. Au préalable, prenez connaissances des différentes conditions de chaque hébergeur.';
	$lang['ext_host_button'] = 'Ouvrir dans une nouvelle fenêtre';
	
?>