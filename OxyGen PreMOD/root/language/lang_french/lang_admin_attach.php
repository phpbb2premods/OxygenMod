<?php
/** 
*
* attachment mod admin [French]
*
* @package attachment_mod
* @version $Id: lang_admin_attach.php,v 1.3 2005/11/27 19:15:09 kooky Exp $
* @copyright (c) 2002 Meik Sievertsen
* @license http://opensource.org/licenses/gpl-license.php GNU Public License 
*
*/

/**
* DO NOT CHANGE
*/
if (!isset($lang) || !is_array($lang))
{
	$lang = array();
}

//
// Attachment Mod Admin Language Variables
//

// Modules, this replaces the keys used
$lang['Control_Panel'] = 'Panneau de Contr&ocirc;le';
$lang['Shadow_attachments'] = 'Fichiers joints perdus';
$lang['Forbidden_extensions'] = 'Extensions interdites';
$lang['Extension_control'] = 'Extensions';
$lang['Extension_group_manage'] = 'Groupes d\'extensions';
$lang['Special_categories'] = 'Cat&eacute;gories sp&eacute;ciales';
$lang['Sync_attachments'] = 'Synchroniser les fichiers joints';
$lang['Quota_limits'] = 'Limites des Quotas';

// Attachments -> Management
$lang['Attach_settings'] = 'Configuration des fichiers joints';
$lang['Manage_attachments_explain'] = 'Ici, vous pouvez configurer les options principales pour le Mod Attachement. Si vous cliquez sur le bouton <ins>Tester les Options</ins>, le Mod Attachement effectuera quelques tests du syt&egrave;me pour &ecirc;tre sûr que le Mod fonctionnera correctement. Si vous rencontrez des probl&egrave;mes en uploadant des fichiers, veuillez utiliser ce test pour obtenir un message d\'erreur plus d&eacute;taill&eacute;.';
$lang['Attach_filesize_settings'] = 'Configuration de la taille des fichiers joints';
$lang['Attach_number_settings'] = 'Configuration du nombre de fichiers joints';
$lang['Attach_options_settings'] = 'Options des fichiers joints';

$lang['Upload_directory'] = 'R&eacute;pertoire d\'upload';
$lang['Upload_directory_explain'] = 'Entrez le chemin relatif &agrave; votre r&eacute;pertoire d\'installation de phpBB2 vers le r&eacute;pertoire d\'upload des fichiers joints. Par exemple, entrez \'files\' si votre r&eacute;pertoire d\'installation de phpBB2 est situ&eacute; &agrave; http://www.votredomaine.com/phpBB2 et que le r&eacute;pertoire d\'upload des fichiers joints est situ&eacute; &agrave; http://www.votredomaine.com/phpBB2/files.';
$lang['Attach_img_path'] = 'Ic&ocirc;ne d\'un message avec un fichier joint';
$lang['Attach_img_path_explain'] = 'Cette image est affich&eacute;e &agrave; la suite du lien du fichier joint dans un message individuel. Laissez ce champ vide si vous ne souhaitez pas qu\'une ic&ocirc;ne soit affich&eacute;e. Cette option sera remplac&eacute;e par les options dans la gestion des groupes d\'extensions.';
$lang['Attach_topic_icon'] = 'Ic&ocirc;ne d\'un sujet avec un fichier joint';
$lang['Attach_topic_icon_explain'] = 'Cette image est affich&eacute;e avant le titre des sujets dans lesquels sont joints des fichiers. Laissez ce champ vide si vous ne souhaitez pas qu\'une ic&ocirc;ne soit affich&eacute;e.';
$lang['Attach_display_order'] = 'Ordre d\'affichage des fichiers joints';
$lang['Attach_display_order_explain'] = 'Ici, vous pouvez choisir si les fichiers joints dans des messages et messages priv&eacute;s seront affich&eacute;s suivant la date du fichier par ordre d&eacute;croissant (nouveau fichier en premier) ou par ordre croissant (plus ancien fichier en premier).';
$lang['Show_apcp'] = 'Afficher le nouveau Panneau de Contr&ocirc;le des fichiers joints';
$lang['Show_apcp_explain'] = 'Choisissez si vous souhaitez afficher le nouveau panneau de contr&ocirc;le des fichiers joints (Oui) ou l\'ancienne m&eacute;thode avec les deux boîtes de dialogue pour joindre des fichiers et les &eacute;diter (Non) &agrave; partir de votre formulaire de r&eacute;daction du message. La visualisation de ceci &eacute;tant tr&egrave;s difficile &agrave; expliquer, par cons&eacute;quent le mieux est de l\'essayer par vous-m&ecirc;me.';

$lang['Max_filesize_attach'] = 'Taille d\'un fichier';
$lang['Max_filesize_attach_explain'] = 'Taille maximale pour les fichiers joints (en octets). Une valeur de 0 signifie \'illimit&eacute;e\'. Cette option est restreinte par la configuration de votre serveur. Par exemple, si votre configuration de PHP autorise seulement un maximum de 2 Mo en upload, ceci ne pourra pas &ecirc;tre remplac&eacute; par le Mod.';
$lang['Attach_quota'] = 'Quota des fichiers joints';
$lang['Attach_quota_explain'] = 'Espace disque maximum pour TOUS les fichiers pouvant &ecirc;tre joints sur votre serveur. Une valeur de 0 signifie \'illimit&eacute;\'.';
$lang['Max_filesize_pm'] = 'Taille maximale des fichiers dans la Boîte des Messages Priv&eacute;s';
$lang['Max_filesize_pm_explain'] = 'Espace disque maximum des fichiers pouvant &ecirc;tre utilis&eacute;s pour la Boîte des Messages Priv&eacute;s de chaque utilisateur. Une valeur de 0 signifie \'illimit&eacute;e\'.';
$lang['Default_quota_limit'] = 'Limite des Quotas par d&eacute;faut';
$lang['Default_quota_limit_explain'] = 'Ici, vous &ecirc;tes autoris&eacute; &agrave; s&eacute;lectionner la limite des Quotas par d&eacute;faut assign&eacute;e automatiquement aux nouveaux utilisateurs enregistr&eacute;s et aux utilisateurs n\'ayant pas de limite de Quota d&eacute;finie. L\'option \'Aucune limite de Quota\' permet de ne pas utiliser les quotas des fichiers joints; au lieu d\'utiliser l\'option par d&eacute;faut, vous pouvez la d&eacute;finir dans ce panneau de gestion.';

$lang['Max_attachments'] = 'Nombre maximum de fichiers joints';
$lang['Max_attachments_explain'] = 'Nombre maximum de fichiers joints autoris&eacute; dans un message.';
$lang['Max_attachments_pm'] = 'D&eacute;finir le nombre maximum de fichiers joints dans un Message Priv&eacute;';
$lang['Max_attachments_pm_explain'] = 'D&eacute;fini le nombre maximum de fichiers joints qu\'un utilisateur est autoris&eacute; &agrave; inclure dans un message priv&eacute;.';

$lang['Disable_mod'] = 'D&eacute;sactiver le Mod Attachement';
$lang['Disable_mod_explain'] = 'Cette option est essentiellement faite pour effectuer des tests avec de nouveaux templates ou th&egrave;mes; cela d&eacute;sactive toutes les fonctions des fichiers joints &agrave; l\'exception du Panneau d\'Administration.';
$lang['PM_Attachments'] = 'Autoriser les fichiers joints dans les Messages Priv&eacute;s';
$lang['PM_Attachments_explain'] = 'Autoriser/Interdire les fichiers joints dans les Messages Priv&eacute;s.';
$lang['Ftp_upload'] = 'Activer l\'Upload par FTP';
$lang['Ftp_upload_explain'] = 'Activer/D&eacute;sactiver l\'option d\'upload par FTP. Si vous l\'activez (Oui), vous devez d&eacute;finir les param&egrave;tres du FTP et le r&eacute;pertoire d\'Upload qui sera utilis&eacute; pour les fichiers joints.';
$lang['Attachment_topic_review'] = 'Souhaitez-vous afficher les fichiers joints dans la Pr&eacute;visualisation  du message ?';
$lang['Attachment_topic_review_explain'] = 'Si vous choisissez Oui, tous les fichiers joints seront affich&eacute;s dans la Pr&eacute;visualisation du message lorsque vous posterez une r&eacute;ponse.';

$lang['Ftp_server'] = 'Serveur FTP d\'Upload';
$lang['Ftp_server_explain'] = 'Ici, vous pouvez entrer l\'adresse IP ou le nom de domaine du serveur FTP utilis&eacute; pour uploader vos fichiers. Si vous laissez ce champ vide, le serveur sur lequel votre forum phpBB2 est install&eacute; sera utilis&eacute;. Veuillez noter qu\'il n\'est pas autoris&eacute; d\'ajouter ftp:// ou quelque chose de similaire &agrave; votre adresse; uniquement ftp.foo.com ou quelque chose de plus rapide, comme l\'adresse IP compl&egrave;te.';

$lang['Attach_ftp_path'] = 'Chemin de votre r&eacute;pertoire d\'upload du FTP';
$lang['Attach_ftp_path_explain'] = 'R&eacute;pertoire où vos fichiers joints seront conserv&eacute;s. Ce r&eacute;pertoire n\'a pas besoin de permissions (CHMOD). Veuillez ne pas entrer votre adresse IP ou une adresse FTP ici, ce champ est uniquement pour le chemin vers le FTP.<br />Par exemple: /home/web/uploads';
$lang['Ftp_download_path'] = 'Chemin du FTP pour le t&eacute;l&eacute;chargement';
$lang['Ftp_download_path_explain'] = 'Entrez le chemin relatif &agrave; votre FTP, où vos fichiers joints sont conserv&eacute;s.<br />Si vous utilisez un serveur FTP distant, veuillez entrer l\'url compl&egrave;te, par exemple http://www.monstockage.com/phpBB2/upload.<br />Si vous utilisez votre h&eacute;bergement local pour sauvegarder vos fichiers, vous pouvez entrer le chemin relatif vers votre r&eacute;pertoire phpBB2, par exemple \'upload\'.<br />Un slash invers&eacute; sera supprim&eacute;. Laissez ce champ vide, si le chemin du FTP n\'est pas accessible &agrave; partir d\'Internet. En laissant ce champ vide vous ne pourrez pas utiliser la m&eacute;thode de t&eacute;l&eacute;chargement physique.';
$lang['Ftp_passive_mode'] = 'Activer le Mode passif du FTP';
$lang['Ftp_passive_mode_explain'] = 'La commande PASV requiert que le serveur distant ouvre un port pour la connexion des informations et renvoie l\'adresse de ce port. Le serveur distant tient compte de ce port pour que le client se connecte &agrave; lui.';

$lang['No_ftp_extensions_installed'] = 'Vous ne pouvez pas utiliser la m&eacute;thode d\'upload par FTP, car les extensions FTP ne sont pas compil&eacute;es dans votre installation de PHP.';

// Attachments -> Shadow Attachments
$lang['Shadow_attachments_explain'] = 'Ici, vous pouvez supprimer les informations des fichiers li&eacute;s &agrave; des messages lorsque les fichiers ont disparu de votre serveur, et supprimer les fichiers qui ne sont plus li&eacute;s &agrave; des messages. Vous pouvez t&eacute;l&eacute;charger ou voir un fichier en cliquant dessus; s\'il n\'y a aucun lien pr&eacute;sent, le fichier n\'existe plus.';
$lang['Shadow_attachments_file_explain'] = 'Supprimer tous les fichiers joints existant sur votre serveur et qui ne sont plus li&eacute;s &agrave; un message existant.';
$lang['Shadow_attachments_row_explain'] = 'Supprimer toutes les informations concernant les fichiers joints n\'existant plus sur votre serveur.';
$lang['Empty_file_entry'] = 'Entr&eacute;e du fichier vide';

// Attachments -> Sync
$lang['Sync_thumbnail_resetted'] = 'Miniature r&eacute;initialis&eacute;e pour le fichier joint: %s'; // replace %s with physical Filename
$lang['Attach_sync_finished'] = 'Synchronisation des fichiers joints termin&eacute;e.';
$lang['Sync_topics'] = 'Synchronisation :: sujets';
$lang['Sync_posts'] = 'Synchronisation :: messages';
$lang['Sync_thumbnails'] = 'Synchronisation :: miniatures';

// Extensions -> Extension Control
$lang['Manage_extensions'] = 'Gestion des extensions';
$lang['Manage_extensions_explain'] = 'Ici, vous pouvez g&eacute;rer les extensions de vos fichiers. Si vous souhaitez autoriser/interdire l\'upload d\'une extension, veuillez utiliser la gestion des groupes d\'extensions.';
$lang['Explanation'] = 'Explication';
$lang['Extension_group'] = 'Groupe d\'extensions';
$lang['Invalid_extension'] = 'Extension invalide';
$lang['Extension_exist'] = 'L\'extension %s existe d&eacute;j&agrave;'; // replace %s with the Extension
$lang['Unable_add_forbidden_extension'] = 'L\'Extension %s est interdite, vous ne pouvez pas l\'ajouter aux extensions autoris&eacute;es'; // replace %s with Extension

// Extensions -> Extension Groups Management
$lang['Manage_extension_groups'] = 'Gestion des Groupes d\'extensions';
$lang['Manage_extension_groups_explain'] = 'Ici, vous pouvez ajouter, supprimer et modifier vos groupes d\'extensions, vous pouvez d&eacute;sactiver les groupes d\'extensions, leurs assigner une cat&eacute;gorie sp&eacute;ciale, modifier le m&eacute;canisme de t&eacute;l&eacute;chargement et vous pouvez d&eacute;finir une ic&ocirc;ne d\'Upload qui sera affich&eacute;e en face d\'un fichier joint appartenant &agrave; ce groupe.';
$lang['Special_category'] = 'Cat&eacute;gorie Sp&eacute;ciale';
$lang['Category_images'] = 'Images';
$lang['Category_stream_files'] = 'Fichiers Stream';
$lang['Category_swf_files'] = 'Fichiers Flash';
$lang['Allowed'] = 'Autoris&eacute;';
$lang['Allowed_forums'] = 'Forums autoris&eacute;s';
$lang['Ext_group_permissions'] = 'Permissions du groupe';
$lang['Download_mode'] = 'Mode de t&eacute;l&eacute;chargement';
$lang['Upload_icon'] = 'Ic&ocirc;ne d\'upload';
$lang['Max_groups_filesize'] = 'Taille maximale';
$lang['Extension_group_exist'] = 'Le groupe d\'extensions %s existe d&eacute;j&agrave;'; // replace %s with the group name
$lang['Collapse'] = '+';
$lang['Decollapse'] = '-';

// Extensions -> Special Categories
$lang['Manage_categories'] = 'Gestion des Cat&eacute;gories Sp&eacute;ciales';
$lang['Manage_categories_explain'] = 'Ici, vous pouvez configurer les cat&eacute;gories sp&eacute;ciales. Vous pouvez organiser les param&egrave;tres sp&eacute;ciaux et les conditions pour les cat&eacute;gories sp&eacute;ciales assign&eacute;es &agrave; un groupe d\'extensions.';
$lang['Settings_cat_images'] = 'Configuration pour la cat&eacute;gorie sp&eacute;ciale: Images';
$lang['Settings_cat_streams'] = 'Configuration pour la cat&eacute;gorie sp&eacute;ciale: Fichiers Stream';
$lang['Settings_cat_flash'] = 'Configuration pour la cat&eacute;gorie sp&eacute;ciale: Fichiers Flash';
$lang['Display_inlined'] = 'Afficher les images dans le message';
$lang['Display_inlined_explain'] = 'Choisissez si les images doivent &ecirc;tre affich&eacute;es directement dans le message (Oui) ou affich&eacute;es comme un lien (Non) ?';
$lang['Max_image_size'] = 'Dimensions maximales de l\'image';
$lang['Max_image_size_explain'] = 'Ici, vous pouvez d&eacute;finir la dimension maximale autoris&eacute;e pour les images jointes (largeur x hauteur en pixels).<br />Si elle est mise sur 0x0, cette option sera d&eacute;sactiv&eacute;e. Avec certaines images, cette option ne fonctionnera pas &agrave; cause de limitations dans PHP.';
$lang['Image_link_size'] = 'Dimensions de l\'image affich&eacute;e avec un lien';
$lang['Image_link_size_explain'] = 'Si la dimension d\'une image d&eacute;finie est atteinte, l\'image sera affich&eacute;e comme un lien, plut&ocirc;t que de l\'afficher dans un message,<br />si \'Afficher l\'image dans le message\' est activ&eacute; (largeur x hauteur en pixels).<br />Si elle est mise sur 0x0, cette option sera d&eacute;sactiv&eacute;e. Avec certaines images, cette option ne fonctionnera pas &agrave; cause de limitations dans PHP.';
$lang['Assigned_group'] = 'Groupe assign&eacute;';

$lang['Image_create_thumbnail'] = 'Cr&eacute;er une miniature';
$lang['Image_create_thumbnail_explain'] = 'Toujours cr&eacute;er une miniature. Cette option passe outre presque toutes les configurations des cat&eacute;gories sp&eacute;ciales, &agrave; l\'exception des dimensions maximales d\'une image. Avec cette option, une miniature sera affich&eacute;e dans le message et l\'utilisateur pourra cliquer dessus pour ouvrir l\'image r&eacute;elle.<br />Veuillez noter que cette option requiert que ImageMagick soit install&eacute;, s\'il n\'est pas install&eacute; ou si le Safe-Mode est activ&eacute;, la librairie GD de PHP sera utilis&eacute;e. Si le type d\'image n\'est pas support&eacute; par PHP, cette option ne sera pas utilis&eacute;e.';
$lang['Image_min_thumb_filesize'] = 'Taille minimale d\'une miniature';
$lang['Image_min_thumb_filesize_explain'] = 'Si une image est plus petite que la taille d&eacute;finie, aucune miniature ne sera cr&eacute;&eacute;e, car elle sera trop petite.';
$lang['Image_imagick_path'] = 'Programme ImageMagick (chemin complet)';
$lang['Image_imagick_path_explain'] = 'Entrez le chemin vers le programme ImageMagick, normalement /usr/bin/convert (dans windows C:/imagemagick/convert.exe).';
$lang['Image_search_imagick'] = 'Rechercher ImageMagick';

$lang['Use_gd2'] = 'Utiliser la librairie GD2';
$lang['Use_gd2_explain'] = 'PHP est autoris&eacute; &agrave; compiler les images avec les librairies GD1 ou GD2. Pour cr&eacute;er correctement des miniatures sans ImageMagick, le Mod Attachement utilise 2 m&eacute;thodes diff&eacute;rentes bas&eacute;es sur votre choix ici. Si vos miniatures ont une mauvaise qualit&eacute; ou sont d&eacute;form&eacute;es, essayez de changer cette option.';
$lang['Attachment_version'] = 'Attachment Mod Version %s'; // %s is the version number

// Extensions -> Forbidden Extensions
$lang['Manage_forbidden_extensions'] = 'Gestion des extensions interdites';
$lang['Manage_forbidden_extensions_explain'] = 'Ici, vous pouvez ajouter ou supprimer les extensions interdites. Les extensions php, php3 et php4 sont interdites par d&eacute;faut pour des raisons de s&eacute;curit&eacute;; vous ne pouvez pas les supprimer.';
$lang['Forbidden_extension_exist'] = 'L\'extension interdite %s existe d&eacute;j&agrave;'; // replace %s with the extension
$lang['Extension_exist_forbidden'] = 'L\'extension %s est d&eacute;finie dans vos extensions autoris&eacute;es; veuillez la supprimer, ensuite vous pourrez l\'ajouter ici.';  // replace %s with the extension

// Extensions -> Extension Groups Control -> Group Permissions
$lang['Group_permissions_title'] = 'Permissions du groupe d\'extensions -> \'%s\''; // Replace %s with the Groups Name
$lang['Group_permissions_explain'] = 'Ici, vous pouvez restreindre le groupe d\'extensions s&eacute;lectionn&eacute; &agrave; des forums de votre choix (d&eacute;fini dans la boîte de dialogue des forums autoris&eacute;s). Par d&eacute;faut les groupes d\'extensions sont autoris&eacute;s sur tous les forums où l\'utilisateur peut joindre des fichiers (de la m&ecirc;me façon que le Mod Attachement a fonctionn&eacute; depuis le d&eacute;but). Ajoutez uniquement les forums où vous souhaitez autoriser le groupe d\'extensions (les extensions comprises par ce groupe), l\'option par d&eacute;faut TOUS LES FORUMS disparaîtra lorsque vous ajouterez des forums &agrave; la liste. Vous pourrez revenir &agrave; l\'option TOUS LES FORUMS &agrave; n\'importe quel moment donn&eacute;. Si vous ajoutez un forum &agrave; votre site et que les permissions sont r&eacute;gl&eacute;es sur TOUS LES FORUMS rien ne sera chang&eacute;. Mais si vous modifiez et limitez l\'acc&egrave;s &agrave; certains forums, vous devrez revenir ici afin d\'ajouter votre nouveau forum cr&eacute;&eacute;. Cela serait facile de le faire automatiquement, mais cela vous obligerait &agrave; &eacute;diter un grand nombre de fichiers, c\'est pourquoi cette m&eacute;thode a &eacute;t&eacute; choisie. Veuillez garder &agrave; l\'esprit que tous vos forums seront list&eacute;s ici.';
$lang['Note_admin_empty_group_permissions'] = 'NOTE:<br />Avec la liste des forums ci-dessous, vos utilisateurs peuvent joindre normalement des fichiers; mais tant qu\'aucun groupe d\'extensions n\'est autoris&eacute; &agrave; &ecirc;tre joint ici, vos utilisateurs ne pourront joindre aucun fichier. S\'ils essaient, ils auront un message d\'erreur. Peut-&ecirc;tre souhaiterez-vous r&eacute;gler la permission de \'Joindre des fichiers\' sur ADMIN pour ces forums.<br /><br />';
$lang['Add_forums'] = 'Ajouter les forums';
$lang['Add_selected'] = 'Ajouter la s&eacute;lection';
$lang['Perm_all_forums'] = 'TOUS LES FORUMS';

// Attachments -> Quota Limits
$lang['Manage_quotas'] = 'G&eacute;rer les limites de Quotas des fichiers joints';
$lang['Manage_quotas_explain'] = 'Ici, vous pouvez ajouter/supprimer/modifier les limites de Quotas. Vous pourrez assigner ces limites de quotas &agrave; des utilisateurs et des groupes par la suite. Pour assigner une limite de Quota &agrave; un utilisateur, vous devez aller dans le panneau de gestion des utilisateurs; s&eacute;lectionnez l\'utilisateur et vous verrez les options en bas de page. Pour assigner une limite de Quota &agrave; un groupe, allez dans le panneau de gestion des groupes; s&eacute;lectionnez le groupe &agrave; &eacute;diter et vous verrez les options de configuration. Si vous souhaitez voir quels sont les utilisateurs et groupes assign&eacute;s &agrave; une limite sp&eacute;cifique de Quota, cliquez sur \'Voir\' &agrave; gauche de la description du Quota.';
$lang['Assigned_users'] = 'Utilisateurs assign&eacute;s';
$lang['Assigned_groups'] = 'Groupes assign&eacute;s';
$lang['Quota_limit_exist'] = 'La limite de Quota %s existe d&eacute;j&agrave;.'; // Replace %s with the Quota Description

// Attachments -> Control Panel
$lang['Control_panel_title'] = 'Panneau de Contr&ocirc;le des fichiers joints';
$lang['Control_panel_explain'] = 'Ici, vous pouvez voir et g&eacute;rer tous les fichiers joints en fonction des utilisateurs, fichiers joints, t&eacute;l&eacute;chargements, etc...';
$lang['File_comment_cp'] = 'Commentaire';

// Control Panel -> Search
$lang['Search_wildcard_explain'] = 'Utilisez * comme un joker pour des recherches partielles';
$lang['Size_smaller_than'] = 'Taille du fichier joint inf&eacute;rieure &agrave; (en octets)';
$lang['Size_greater_than'] = 'Taille du fichier joint sup&eacute;rieure &agrave; (en octets)';
$lang['Count_smaller_than'] = 'Nombre de t&eacute;l&eacute;chargements inf&eacute;rieur &agrave;';
$lang['Count_greater_than'] = 'Nombre de t&eacute;l&eacute;chargements sup&eacute;rieur &agrave;';
$lang['More_days_old'] = 'Ancien de plus de (en jours)';
$lang['No_attach_search_match'] = 'Aucun fichier joint ne correspond &agrave; vos crit&egrave;res de recherche';

// Control Panel -> Statistics
$lang['Number_of_attachments'] = 'Nombre de fichiers joints';
$lang['Total_filesize'] = 'Taille totale des fichiers joints';
$lang['Number_posts_attach'] = 'Nombre de messages avec des fichiers joints';
$lang['Number_topics_attach'] = 'Nombre de sujets avec des fichiers joints';
$lang['Number_users_attach'] = 'Nombre d\'utilisateurs ayant joint des fichiers';
$lang['Number_pms_attach'] = 'Nombre total de fichiers joints dans les Messages Priv&eacute;s';

// Control Panel -> Attachments
$lang['Statistics_for_user'] = 'Statistiques des fichiers joints pour %s'; // replace %s with username
$lang['Size_in_kb'] = 'Taille (Ko)';
$lang['Downloads'] = 'T&eacute;l&eacute;chargements';
$lang['Post_time'] = 'Date';
$lang['Posted_in_topic'] = 'Sujet';
$lang['Submit_changes'] = 'Envoyer';

// Sort Types
$lang['Sort_Attachments'] = 'Fichiers joints';
$lang['Sort_Size'] = 'Taille';
$lang['Sort_Filename'] = 'Nom du fichier';
$lang['Sort_Comment'] = 'Commentaire';
$lang['Sort_Extension'] = 'Extension';
$lang['Sort_Downloads'] = 'T&eacute;l&eacute;chargements';
$lang['Sort_Posttime'] = 'Date';
$lang['Sort_Posts'] = 'Messages';

// View Types
$lang['View_Statistic'] = 'Statistiques';
$lang['View_Search'] = 'Rechercher';
$lang['View_Username'] = 'Nom d\'utilisateur';
$lang['View_Attachments'] = 'Fichiers joints';

// Successfully updated
$lang['Attach_config_updated'] = 'La configuration des fichiers joints a &eacute;t&eacute; mise &agrave; jour avec succ&egrave;s';
$lang['Click_return_attach_config'] = 'Cliquez %sici%s pour revenir &agrave; la configuration des fichiers joints';
$lang['Test_settings_successful'] = 'Tests des options termin&eacute;es; la configuration semble &ecirc;tre correcte.';

// Some basic definitions
$lang['Attachments'] = 'Fichiers joints';
$lang['Attachment'] = 'Fichier joint';
$lang['Extensions'] = 'Extensions';
$lang['Extension'] = 'Extension';

// Auth pages
$lang['Auth_attach'] = 'Joindre';
$lang['Auth_download'] = 'T&eacute;l&eacute;charger';

//-- mod : thumbnail-on-dimensions ---------------------------------------------
//-- add
$lang['Image_link_size'] = 'Dimensions d\'image';
$lang['Image_link_size_explain'] = 'Si cette dimension définie qu\'une image est atteinte, l\'image sera montrée comme plus petite, plutôt que normal (taille de largeur X en Pixel). <br/> s\'il est placé à 0x0, ce dispositif est handicapé. Avec quelques images ce dispositif ne fonctionnera pas en raison des limitations dans PHP .';
//-- fin mod : thumbnail-on-dimensions -----------------------------------------

?>
