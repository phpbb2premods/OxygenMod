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
$lang['smiley_title_main'] = 'Page de configuration des catégories';
$lang['smiley_desc_main'] = 'Ici, vous pouvez ajouter ou éditer les catégories.<br />Sitôt que vous avez créé au moins une catégorie, vous pouvez commencer à y ajouter des smilies.<br />Si il y en a plus d\'une, alors vous pouvez les mettre dans l\'ordre que vous souhaitez les voir apparaître dans le posting.<br />Une catégorie où <strong>personne</strong> n\'a la permission de voir ne sera vue par aucun utilisateur du forum et les smilies n\'apparaîtront dans aucun message.';

// Add
$lang['add_title'] = 'Ajouter une catégorie';
$lang['add_description'] = 'Vous pouvez ajouter une nouvelle catégorie grâce à ce formulaire. Ecrivez simplement un nom et une description puis cliquez sur le bouton Soumettre. L\'icône de catégorie est exigée si vous utilisez des boutons et souhaitez que ce bouton soit une image.<br /><br /><span style="color: red;">*Utilisez seulement des lettres et des nombres !</span>';
$lang['add_success'] = 'Ajout de la catégorie';
$lang['add_fail'] = 'Erreur: vous avez omis de saisir un nom et/ou une description !';
$lang['cat_name'] = 'Nom de la vatégorie';
$lang['cat_description'] = 'Description de la catégorie';

// Edit
$lang['edit_title'] = 'Editer une Catégorie';
$lang['edit_description'] = 'Sélectionnez la catégorie que vous souhaitez éditer en bas du menu déroulant. Les détails apparaîtront dans les champs ci-dessous, vous pourrez les éditer et cliquer sur le bouton Soumettre pour sauvegarder les modifications. Vous ne devez pas soumettre des modifications afin de tester la taille de la Popup.';
$lang['edit_success'] = 'Catégorie éditée avec succès';
$lang['edit_success_up'] = 'Catégorie éditée et remontée avec succès';
$lang['edit_success_down'] = 'Catégorie éditée et descendue avec succès';
$lang['edit_fail'] = 'Erreur: Vous avez omis de saisir un nom et/ou une description !';
$lang['select_cat'] = 'Sélectionner une Catégorie';
$lang['edit_delete'] = 'Cochez cet interrupteur pour supprimer la catégorie sélectionnée - ';
$lang['smiley_cat_del_fail'] = 'Erreur: La catégorie n\'existe pas !';

// Add & Edit
$lang['smilies_per_page'] = 'Nombre de Smilies par page';
$lang['smilies_no_limit'] = '(entrez 0 pour illimité)';
$lang['viewable_by'] = 'Vue par';
$lang['viewable_in'] = 'Vue dans';
$lang['viewable_forum_select'] = 'Choisissez un Forum';
$lang['viewable_forum_all'] = 'Tous les Forums et Messagerie Privée';
$lang['viewable_category_select'] = 'Ou sélectionnez une Catégorie';
$lang['viewable_category_all'] = 'Tous les Catégories et Messagerie Privée';
$lang['perms']['5'] = 'Personne';
$lang['perms']['1'] = 'Tout le monde';
$lang['perms']['2'] = 'Enregistrés et supérieurs';
$lang['perms']['3'] = 'Modérateurs et supérieurs';
$lang['perms']['4'] = 'Administrateurs seulement';
$lang['popup_x'] = 'Position de la Popup';
$lang['popup_size'] = 'Taille de la Popup';
$lang['popup_size_attribs'] = '(Largeur x Hauteur)';
$lang['popup_columns'] = 'Nombre de Colonnes de la Popup';
$lang['popup_size_test'] = 'Cliquez sur ce lien pour examiner la taille de la Popup';
$lang['popup_alert'] = 'Sélectionnez avant tout une Catégorie !';
$lang['order_position'] = 'Position';
$lang['order_first'] = 'Premier';
$lang['order_last'] = 'Dernier';
$lang['order_after'] = 'Après';
$lang['order_change'] = '(Sélectionnez un nouvel position)';
$lang['cat_icon'] = 'Icône de Catégorie';
$lang['select_cat_icon'] = 'Sélectionnez ou laissez vide';
$lang['submit'] = 'Soumettre';

// Import
$lang['import_title'] = 'Importation de Packs de Smilies';
$lang['import_description'] = 'Si vos fichiers *.pak, *.pak2 n\'apparaissent pas dans la liste ci-dessous, assurez-vous que vous les avez bien uploadé dans le bon répertoire, qui est <b>/%s</b>.<br /><br /><span style="color: red;">*Ces options ne sont pas obligatoires si ce sont des fichiers *.pak2.</span>';
$lang['import_button'] = 'Importer';
$lang['select_paks'] = 'Sélectionnez un Pack (*.pak, *.pak2)';
$lang['choose_smiley_pak'] = 'Sélectionnez un Pack de Smilies';
$lang['smiley_conflicts'] = 'Ce qui devrait être fait en cas de conflit';
$lang['delete_smiley'] = 'Supprimer les Smilies existants avant l\'importation';
$lang['delete_all'] = 'Supprimer les Catégories existantes avant l\'importation';
$lang['existing_replace'] = 'Remplacer le Smilie existant';
$lang['existing_keep'] = 'Conserver le Smilie existant';
$lang['import_cat'] = 'Importer vers la catégorie suivante';
$lang['smiley_import_success1'] = 'Le Pack Standard de Smilies a été importé avec succès !<br />%s nouveaux %s ont été ajoutés et %s existants remplacés.';
$lang['smiley_import_success2'] = 'Le Pack Avancé de Smilies a été importé avec succès !<br />Vous avez maintenant %s nouveaux %s et %s nouveaux %s.';
$lang['smiley_import_fail'] = 'Erreur: Aucun fichier *.pak, *.pak2 n\'a été selectionné !';

// Export
$lang['export_title'] = 'Exportation du Pack de Smilies';
$lang['export_description'] = 'Exportez une catégorie à la fois en la sélectionnant à partir de la liste ci-dessous, ou exportez tous les Smilies dans un dossier. Si vous souhaitez sauvegarder les informations des Catégories , sélectionnez <b>Avancée (.pak2)</b> au-dessous.';
$lang['export_button'] = 'Exporter';
$lang['export_type'] = 'Type d\'exportation';
$lang['export_type_pak'] = 'Standard (.pak)';
$lang['export_type_cat'] = 'Avancée (.pak2)';
$lang['export_all'] = 'Tout exporter';
$lang['export_cat'] = 'Exporter cette Catégorie';
$lang['export_smiles1'] = 'Pour créer un Pack de Smilies depuis vos Smilies actuels, cliquez %sici%s afin de télécharger le fichier smiles.pak2. Nommez ce fichier en faisant bien attention à conserver l\'extention .pak2. Puis créez un fichier compressé contenant tous vos Smilies ainsi que le fichier de configuration .pak2.';
$lang['export_smiles2'] = 'Pour créer un Pack de Smilies depuis vos Smilies actuels, cliquez %sici%s afin de télécharger le fichier smiles.pak. Nommez ce fichier en faisant bien attention à conserver l\'extention .pak. Puis créez un fichier compressé contenant tous vos Smilies ainsi que le fichier de configuration .pak.';

// Unused
$lang['smilies_unused'] = 'Voir les Smilies non-utilisés';
$lang['smilies_unused_title'] = 'Voir les Smilies Inutilisés';
$lang['smilies_unused_desc'] = 'Si vous n\'avez pas de fichier *.pak, utilisez cette option. Vous y verrez seulement les Smilies qui ne sont pas encore installés. Ainsi, vous n\'aurez pas de doublon et pourrez alors les ajouter dans une Catégorie.';
$lang['smilies_unused_num'] = 'Smilies non-installés';
$lang['smiley_filename_code'] = 'Utilisez le nom du fichier comme code';

// View
$lang['view_title'] = 'Voir les Catégories';
$lang['view_description'] = 'Selectionnez les Catégories que vous souhaitez voir (CTRL + CLIC GAUCHE : Sélectionnez / Désélectionnez). Si vous avez plus ou moins cent Smilies, et une bande passsante élevée, voir toutes les Catégories ne sera pas un problème. Si vous avez quelques centaines de Smilies, vous ne pourrez regarder qu\'une paire de Catégories à la fois.';
$lang['view_button'] = 'Voir les Catégories';

// Category Viewing Page
$lang['smiley_cat_title'] = 'Page de Visualisation des Catégories';
$lang['smiley_cat_description'] = 'Cliquez sur n\importe quel Smilie pour éditer ses détails. Cliquez sur le lien sous la colonne des options pour n\'importe quelle Catégorie donnée afin de voir une liste détaillée des Smilies se trouvant à l\'intérieur et autoriser l\'édition de masse. Les Catégories vides ont un lien de suppression disponible, ainsi pour supprimer une Catégorie supprimez auparavant tous les Smilies contenus dans ladite Catégorie.  Les Catégories cachées ne peuvent être vues par les membres du forum et aucun Smilie de ce type de Catégorie n\apparaîtra dans les messages du forum.';
$lang['smiley_count'] = 'Compte';
$lang['smiley_cat_options'] = 'Options';
$lang['smiley_cat_del_success'] = 'Catégorie supprimée avec succès';
$lang['smiley_cat_empty'] = '<span style="color: red">Il n\'y a pas de Smilies dans cette Catégorie.</span>';
$lang['smiley_cat_select'] = 'Sélectionnez une Catégorie';

// Smiley Editing Page
$lang['smiley_cat_list_title'] = 'Page d\'Édition des Smilies';
$lang['smiley_cat_list_description'] = 'Ici vous pouvez éditer l\'ensemble de vos Smilies en une seule fois plutôt qu\'un par un. Si vous voyez un fond rose dans la section Code, C\'est que le code attribué au Smilie a déjà été réservé ailleurs, dans cette Catégorie ou dans une autre. Deux Smilies ne peuvent pas avoir le même code !.<br /><br /><span style="color: red;">Attention:  Le menu du bas utilise JavaScript, lequel soumettra le nouvel ordre dès que celui-ci est sélectionné. Ils ne font pas partie de la forme principale donc n\'éditez pas les codes ... il mettra à jour l\'ordre au fur et à mesure de vos changements.</span>';
$lang['smiley_cat_move'] = 'Mouvement';
$lang['multi_edit_submit'] = 'Soumettre';
$lang['multi_delete1'] = '%s smilie a été effacé.';
$lang['multi_delete2'] = '%s smilies ont été effacés.';
$lang['multi_updated1'] = '%s smilie a été importé.';
$lang['multi_updated2'] = '%s smilies ont été importés.';
$lang['order_num'] = '#';
$lang['order'] = 'Ordre';
$lang['smiley_order_success'] = 'Le smilie a été déplacé de la position %s vers %s avec succès.';
$lang['smiley_order_nochange'] = 'La position du smilie n\'a pas été modifiée.';
$lang['click_edit'] = 'Cliquez pour éditer';

// Unused Smiley List Page
$lang['smiley_unused_title'] = 'Page des smilies inutilisés';
$lang['smiley_unused_desc'] = 'Ceci est la liste des smilies se situant dans le répertoire <i>/images/smiles/</i>, mais qui ne sont pas installés. Écrivez un code pour le smilie que vous souhaitez installer, sans oublier de le valider, puis choisissez une Catégorie une fois fini, et enfin cliquez sur le bouton Soumettre. Si vous essayez d\'ajouter un Smilie sans code, ce Smilie ne sera alors pas installé.';
$lang['smile_tick_add'] = 'Ajouter un Smilie';
$lang['category'] = 'Catégorie';
$lang['tick_all'] = 'Sélectionner tout';
$lang['untick_all'] = 'Désélectionner tout';
$lang['smiley_multi_add_success1'] = '%s Smilie a été ajouté avec succès.';
$lang['smiley_multi_add_success2'] = '%s Smilies ont été ajoutés avec succès.';
$lang['smiley_errors1'] = 'Il y a %s erreur d\'un possible %s.';
$lang['smiley_errors2'] = 'Il y a %s erreurs d\'un possible %s.';

// Smiley Add/Edit Utility Page
$lang['smiley_add_title'] = 'Utilitaire d\'ajout de smilie';
$lang['smiley_edit_title'] = 'Utilitaire d\'édition de smilie';
$lang['smiley_edit'] = 'Édition du smilie';
$lang['smiley_delete'] = 'Effacer ce smilie';

// Overall View of the Permissions
$lang['perms_title'] = 'Visualisation Générale des Permissions des Smilies';
$lang['perms_desc'] = 'Cette page vous permet de visualiser, d\'un seul coup, quelles Catégories de Smilies sont attribuées à chaque forum et qui peut les voir dans ce forum. Cliquer sur une Catégorie de Smilie vous redirigera directement à l\'éditeur.';
$lang['perms_header1'] = 'Catégories et Forums';
$lang['perms_header2'] = 'Smilies du Forum';
$lang['perms_header3'] = 'Catégorie des Smilies';
$lang['perms_header4'] = 'Smilies du Forum & Messagerie Privée';

// Return Links
$lang['Click_return_listadmin'] = 'Cliquez %sici%s pour retourner à la Page d\'Édition des Smilies';
$lang['Click_return_catadmin'] = 'Cliquez %sici%s pour retourner à la Page d\'Édition des Catégories';
$lang['Click_return_catlistadmin'] = 'Cliquez %sici%s pour retourner à la Page de Visualisation des Catégories';
$lang['Click_return_unusedadmin'] = 'Cliquez %sici%s pour retourner à la Page des Smilies non-utilisés';

// Misc.
$lang['category'] = 'catégorie';
$lang['categories'] = 'catégories';
$lang['smiley'] = 'smilie';
$lang['smilies'] = 'smilies';

// Advanced .pak2 file.
$lang['pak_header'] = "#############################################################\r\n## This file was produced using the Smiley Categories MOD for\r\n## phpBB2. DO NOT attempt to import it into a forum that does\r\n## not have this MOD installed. DO NOT alter any of the lines\r\n## below unless you know what you're doing and know how the\r\n## MOD works. Thankyou for using Smiley Categories -- Marc :)\r\n#############################################################\r\n";

?>
