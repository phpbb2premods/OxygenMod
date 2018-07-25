<?php
/** 
*
* @package smiley categories [french]
* @version $Id: lang_extend_smiley_categories.php,v 1.0.0 2007/03/11 02:43 EzCom Exp $
* @copyright (c) 2007 EzCom - http://www.ezcom-fr.com/
* @license http://opensource.org/licenses/gpl-license.php GNU Public License 
*
*/

// Category Configuration Page
$lang['smiley_title_main'] = 'Page de configuration des cat�gories';
$lang['smiley_desc_main'] = 'Ici, vous pouvez ajouter ou �diter les cat�gories.<br />Sit�t que vous avez cr�� au moins une cat�gorie, vous pouvez commencer � y ajouter des smilies.<br />Si il y en a plus d\'une, alors vous pouvez les mettre dans l\'ordre que vous souhaitez les voir appara�tre dans le posting.<br />Une cat�gorie o� <strong>personne</strong> n\'a la permission de voir ne sera vue par aucun utilisateur du forum et les smilies n\'appara�tront dans aucun message.';

// Add
$lang['add_title'] = 'Ajouter une cat�gorie';
$lang['add_description'] = 'Vous pouvez ajouter une nouvelle cat�gorie gr�ce � ce formulaire. Ecrivez simplement un nom et une description puis cliquez sur le bouton Soumettre. L\'ic�ne de cat�gorie est exig�e si vous utilisez des boutons et souhaitez que ce bouton soit une image.<br /><br /><span style="color: red;">*Utilisez seulement des lettres et des nombres !</span>';
$lang['add_success'] = 'Ajout de la cat�gorie';
$lang['add_fail'] = 'Erreur: vous avez omis de saisir un nom et/ou une description !';
$lang['cat_name'] = 'Nom de la vat�gorie';
$lang['cat_description'] = 'Description de la cat�gorie';

// Edit
$lang['edit_title'] = 'Editer une Cat�gorie';
$lang['edit_description'] = 'S�lectionnez la cat�gorie que vous souhaitez �diter en bas du menu d�roulant. Les d�tails appara�tront dans les champs ci-dessous, vous pourrez les �diter et cliquer sur le bouton Soumettre pour sauvegarder les modifications. Vous ne devez pas soumettre des modifications afin de tester la taille de la Popup.';
$lang['edit_success'] = 'Cat�gorie �dit�e avec succ�s';
$lang['edit_success_up'] = 'Cat�gorie �dit�e et remont�e avec succ�s';
$lang['edit_success_down'] = 'Cat�gorie �dit�e et descendue avec succ�s';
$lang['edit_fail'] = 'Erreur: Vous avez omis de saisir un nom et/ou une description !';
$lang['select_cat'] = 'S�lectionner une Cat�gorie';
$lang['edit_delete'] = 'Cochez cet interrupteur pour supprimer la cat�gorie s�lectionn�e - ';
$lang['smiley_cat_del_fail'] = 'Erreur: La cat�gorie n\'existe pas !';

// Add & Edit
$lang['smilies_per_page'] = 'Nombre de Smilies par page';
$lang['smilies_no_limit'] = '(entrez 0 pour illimit�)';
$lang['viewable_by'] = 'Vue par';
$lang['viewable_in'] = 'Vue dans';
$lang['viewable_forum_select'] = 'Choisissez un Forum';
$lang['viewable_forum_all'] = 'Tous les Forums et Messagerie Priv�e';
$lang['viewable_category_select'] = 'Ou s�lectionnez une Cat�gorie';
$lang['viewable_category_all'] = 'Tous les Cat�gories et Messagerie Priv�e';
$lang['perms']['5'] = 'Personne';
$lang['perms']['1'] = 'Tout le monde';
$lang['perms']['2'] = 'Enregistr�s et sup�rieurs';
$lang['perms']['3'] = 'Mod�rateurs et sup�rieurs';
$lang['perms']['4'] = 'Administrateurs seulement';
$lang['popup_x'] = 'Position de la Popup';
$lang['popup_size'] = 'Taille de la Popup';
$lang['popup_size_attribs'] = '(Largeur x Hauteur)';
$lang['popup_columns'] = 'Nombre de Colonnes de la Popup';
$lang['popup_size_test'] = 'Cliquez sur ce lien pour examiner la taille de la Popup';
$lang['popup_alert'] = 'S�lectionnez avant tout une Cat�gorie !';
$lang['order_position'] = 'Position';
$lang['order_first'] = 'Premier';
$lang['order_last'] = 'Dernier';
$lang['order_after'] = 'Apr�s';
$lang['order_change'] = '(S�lectionnez un nouvel position)';
$lang['cat_icon'] = 'Ic�ne de Cat�gorie';
$lang['select_cat_icon'] = 'S�lectionnez ou laissez vide';
$lang['submit'] = 'Soumettre';

// Import
$lang['import_title'] = 'Importation de Packs de Smilies';
$lang['import_description'] = 'Si vos fichiers *.pak, *.pak2 n\'apparaissent pas dans la liste ci-dessous, assurez-vous que vous les avez bien upload� dans le bon r�pertoire, qui est <b>/%s</b>.<br /><br /><span style="color: red;">*Ces options ne sont pas obligatoires si ce sont des fichiers *.pak2.</span>';
$lang['import_button'] = 'Importer';
$lang['select_paks'] = 'S�lectionnez un Pack (*.pak, *.pak2)';
$lang['choose_smiley_pak'] = 'S�lectionnez un Pack de Smilies';
$lang['smiley_conflicts'] = 'Ce qui devrait �tre fait en cas de conflit';
$lang['delete_smiley'] = 'Supprimer les Smilies existants avant l\'importation';
$lang['delete_all'] = 'Supprimer les Cat�gories existantes avant l\'importation';
$lang['existing_replace'] = 'Remplacer le Smilie existant';
$lang['existing_keep'] = 'Conserver le Smilie existant';
$lang['import_cat'] = 'Importer vers la cat�gorie suivante';
$lang['smiley_import_success1'] = 'Le Pack Standard de Smilies a �t� import� avec succ�s !<br />%s nouveaux %s ont �t� ajout�s et %s existants remplac�s.';
$lang['smiley_import_success2'] = 'Le Pack Avanc� de Smilies a �t� import� avec succ�s !<br />Vous avez maintenant %s nouveaux %s et %s nouveaux %s.';
$lang['smiley_import_fail'] = 'Erreur: Aucun fichier *.pak, *.pak2 n\'a �t� selectionn� !';

// Export
$lang['export_title'] = 'Exportation du Pack de Smilies';
$lang['export_description'] = 'Exportez une cat�gorie � la fois en la s�lectionnant � partir de la liste ci-dessous, ou exportez tous les Smilies dans un dossier. Si vous souhaitez sauvegarder les informations des Cat�gories , s�lectionnez <b>Avanc�e (.pak2)</b> au-dessous.';
$lang['export_button'] = 'Exporter';
$lang['export_type'] = 'Type d\'exportation';
$lang['export_type_pak'] = 'Standard (.pak)';
$lang['export_type_cat'] = 'Avanc�e (.pak2)';
$lang['export_all'] = 'Tout exporter';
$lang['export_cat'] = 'Exporter cette Cat�gorie';
$lang['export_smiles1'] = 'Pour cr�er un Pack de Smilies depuis vos Smilies actuels, cliquez %sici%s afin de t�l�charger le fichier smiles.pak2. Nommez ce fichier en faisant bien attention � conserver l\'extention .pak2. Puis cr�ez un fichier compress� contenant tous vos Smilies ainsi que le fichier de configuration .pak2.';
$lang['export_smiles2'] = 'Pour cr�er un Pack de Smilies depuis vos Smilies actuels, cliquez %sici%s afin de t�l�charger le fichier smiles.pak. Nommez ce fichier en faisant bien attention � conserver l\'extention .pak. Puis cr�ez un fichier compress� contenant tous vos Smilies ainsi que le fichier de configuration .pak.';

// Unused
$lang['smilies_unused'] = 'Voir les Smilies non-utilis�s';
$lang['smilies_unused_title'] = 'Voir les Smilies Inutilis�s';
$lang['smilies_unused_desc'] = 'Si vous n\'avez pas de fichier *.pak, utilisez cette option. Vous y verrez seulement les Smilies qui ne sont pas encore install�s. Ainsi, vous n\'aurez pas de doublon et pourrez alors les ajouter dans une Cat�gorie.';
$lang['smilies_unused_num'] = 'Smilies non-install�s';
$lang['smiley_filename_code'] = 'Utilisez le nom du fichier comme code';

// View
$lang['view_title'] = 'Voir les Cat�gories';
$lang['view_description'] = 'Selectionnez les Cat�gories que vous souhaitez voir (CTRL + CLIC GAUCHE : S�lectionnez / D�s�lectionnez). Si vous avez plus ou moins cent Smilies, et une bande passsante �lev�e, voir toutes les Cat�gories ne sera pas un probl�me. Si vous avez quelques centaines de Smilies, vous ne pourrez regarder qu\'une paire de Cat�gories � la fois.';
$lang['view_button'] = 'Voir les Cat�gories';

// Category Viewing Page
$lang['smiley_cat_title'] = 'Page de Visualisation des Cat�gories';
$lang['smiley_cat_description'] = 'Cliquez sur n\importe quel Smilie pour �diter ses d�tails. Cliquez sur le lien sous la colonne des options pour n\'importe quelle Cat�gorie donn�e afin de voir une liste d�taill�e des Smilies se trouvant � l\'int�rieur et autoriser l\'�dition de masse. Les Cat�gories vides ont un lien de suppression disponible, ainsi pour supprimer une Cat�gorie supprimez auparavant tous les Smilies contenus dans ladite Cat�gorie.  Les Cat�gories cach�es ne peuvent �tre vues par les membres du forum et aucun Smilie de ce type de Cat�gorie n\appara�tra dans les messages du forum.';
$lang['smiley_count'] = 'Compte';
$lang['smiley_cat_options'] = 'Options';
$lang['smiley_cat_del_success'] = 'Cat�gorie supprim�e avec succ�s';
$lang['smiley_cat_empty'] = '<span style="color: red">Il n\'y a pas de Smilies dans cette Cat�gorie.</span>';
$lang['smiley_cat_select'] = 'S�lectionnez une Cat�gorie';

// Smiley Editing Page
$lang['smiley_cat_list_title'] = 'Page d\'�dition des Smilies';
$lang['smiley_cat_list_description'] = 'Ici vous pouvez �diter l\'ensemble de vos Smilies en une seule fois plut�t qu\'un par un. Si vous voyez un fond rose dans la section Code, C\'est que le code attribu� au Smilie a d�j� �t� r�serv� ailleurs, dans cette Cat�gorie ou dans une autre. Deux Smilies ne peuvent pas avoir le m�me code !.<br /><br /><span style="color: red;">Attention:  Le menu du bas utilise JavaScript, lequel soumettra le nouvel ordre d�s que celui-ci est s�lectionn�. Ils ne font pas partie de la forme principale donc n\'�ditez pas les codes ... il mettra � jour l\'ordre au fur et � mesure de vos changements.</span>';
$lang['smiley_cat_move'] = 'Mouvement';
$lang['multi_edit_submit'] = 'Soumettre';
$lang['multi_delete1'] = '%s smilie a �t� effac�.';
$lang['multi_delete2'] = '%s smilies ont �t� effac�s.';
$lang['multi_updated1'] = '%s smilie a �t� import�.';
$lang['multi_updated2'] = '%s smilies ont �t� import�s.';
$lang['order_num'] = '#';
$lang['order'] = 'Ordre';
$lang['smiley_order_success'] = 'Le smilie a �t� d�plac� de la position %s vers %s avec succ�s.';
$lang['smiley_order_nochange'] = 'La position du smilie n\'a pas �t� modifi�e.';
$lang['click_edit'] = 'Cliquez pour �diter';

// Unused Smiley List Page
$lang['smiley_unused_title'] = 'Page des smilies inutilis�s';
$lang['smiley_unused_desc'] = 'Ceci est la liste des smilies se situant dans le r�pertoire <i>/images/smiles/</i>, mais qui ne sont pas install�s. �crivez un code pour le smilie que vous souhaitez installer, sans oublier de le valider, puis choisissez une Cat�gorie une fois fini, et enfin cliquez sur le bouton Soumettre. Si vous essayez d\'ajouter un Smilie sans code, ce Smilie ne sera alors pas install�.';
$lang['smile_tick_add'] = 'Ajouter un Smilie';
$lang['category'] = 'Cat�gorie';
$lang['tick_all'] = 'S�lectionner tout';
$lang['untick_all'] = 'D�s�lectionner tout';
$lang['smiley_multi_add_success1'] = '%s Smilie a �t� ajout� avec succ�s.';
$lang['smiley_multi_add_success2'] = '%s Smilies ont �t� ajout�s avec succ�s.';
$lang['smiley_errors1'] = 'Il y a %s erreur d\'un possible %s.';
$lang['smiley_errors2'] = 'Il y a %s erreurs d\'un possible %s.';

// Smiley Add/Edit Utility Page
$lang['smiley_add_title'] = 'Utilitaire d\'ajout de smilie';
$lang['smiley_edit_title'] = 'Utilitaire d\'�dition de smilie';
$lang['smiley_edit'] = '�dition du smilie';
$lang['smiley_delete'] = 'Effacer ce smilie';

// Overall View of the Permissions
$lang['perms_title'] = 'Visualisation G�n�rale des Permissions des Smilies';
$lang['perms_desc'] = 'Cette page vous permet de visualiser, d\'un seul coup, quelles Cat�gories de Smilies sont attribu�es � chaque forum et qui peut les voir dans ce forum. Cliquer sur une Cat�gorie de Smilie vous redirigera directement � l\'�diteur.';
$lang['perms_header1'] = 'Cat�gories et Forums';
$lang['perms_header2'] = 'Smilies du Forum';
$lang['perms_header3'] = 'Cat�gorie des Smilies';
$lang['perms_header4'] = 'Smilies du Forum & Messagerie Priv�e';

// Return Links
$lang['Click_return_listadmin'] = 'Cliquez %sici%s pour retourner � la Page d\'�dition des Smilies';
$lang['Click_return_catadmin'] = 'Cliquez %sici%s pour retourner � la Page d\'�dition des Cat�gories';
$lang['Click_return_catlistadmin'] = 'Cliquez %sici%s pour retourner � la Page de Visualisation des Cat�gories';
$lang['Click_return_unusedadmin'] = 'Cliquez %sici%s pour retourner � la Page des Smilies non-utilis�s';

// Misc.
$lang['category'] = 'cat�gorie';
$lang['categories'] = 'cat�gories';
$lang['smiley'] = 'smilie';
$lang['smilies'] = 'smilies';

// Advanced .pak2 file.
$lang['pak_header'] = "#############################################################\r\n## This file was produced using the Smiley Categories MOD for\r\n## phpBB2. DO NOT attempt to import it into a forum that does\r\n## not have this MOD installed. DO NOT alter any of the lines\r\n## below unless you know what you're doing and know how the\r\n## MOD works. Thankyou for using Smiley Categories -- Marc :)\r\n#############################################################\r\n";

?>
