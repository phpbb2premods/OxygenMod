<?php
/** 
*
* @package oxygen premodded board [french]
* @version $Id: lang_extend_oxygen_premod.php,v 1.1.0 2007/02/03 14:51 EzCom Exp $
* @copyright (c) 2006 EzCom - http://www.ezcom-fr.com/
* @license http://opensource.org/licenses/gpl-license.php GNU Public License 
*
*/

if ( !defined('IN_PHPBB') )
{
	die('Hacking attempt');
}

/**
* admin part
*/
if ( $lang_extend_admin )
{
	/**
	* OxyGen PreMOD
	*/
	$lang['User_authorizations'] = 'Autorisations';
	$lang['Security_settings'] = 'Sécurité';
	$lang['Suscribe_settings'] = 'Inscriptions';
	$lang['Time_settings'] = 'Gestion du temps';
	$lang['Messages_settings'] = 'Messages';
	$lang['Div_Settings'] = 'Divers';

	/**
	* Board Favicon
	*/
	$lang['Favicon_icon'] = 'Icône du site pour les favoris des navigateurs ("favicon")';
	$lang['Favicon_icon_explain'] = 'Cette icône apparaîtra dans les "favoris" du navigateur de vos visiteurs devant le nom de votre site. Elle doit être un fichier .ico, de taille 16x16 pixels.';

	/**
	* Instant MSG
	*/
	$lang['Instant_msg_enable'] = 'Autoriser l\'envoi de messages instantanés entre membres';
	$lang['Instant_msg_autoprune'] = 'Délestage automatique des messages instantanés [heures]';
	$lang['Instant_msg_auto_refresh'] = 'Vérification automatique des nouveaux messages [secondes]';

	/**
	* Forum as Category
	*/
	$lang['forum_as_category'] = 'Considérer ce forum comme étant une sous-catégorie';

	/**
	* Overall Forum Permissions
	*/
	$lang['Overall_Permissions'] = 'Permissions interactives';
	$lang['Forum_auth_explain_overall'] = 'Ici vous pouvez changer les niveaux d\'autorisations pour chaque forum. Rappelez vous bien que changer les niveaux de permission des forums affectera les membres qui peuvent faire des opérations diverses dans ceux-ci.';
	$lang['Forum_auth_explain_overall_edit'] = 'Premièrement cliquez sur la couleur de la clé, ensuite cliquez sur la clé du forum que vous voulez changer. Utilisez "Restaurer" pour annuler les changements. Utilisez "Arrêter l\'édition" pour cesser de faire d\'autres changements.';
	$lang['Forum_auth_overall_restore'] = 'Restaurer';
	$lang['Forum_auth_overall_stop'] = 'Arrêter l\'édition';

	/**
	* Access Limitation
	*/
	$lang['Restriction_Settings'] = 'Restrictions';
	$lang['All'] = 'Tous';
	$lang['Reg'] = 'Membres enregistrés';
	$lang['Mod'] = 'Modérateurs';
	$lang['Memberlist_access'] = 'Qui peut accéder à la <i>Liste des membres</i> ?';
	$lang['Faq_access'] = 'Qui peut accéder à la <i>FAQ</i> ?';
	$lang['Cell_access'] = 'Qui peut accéder au <i>Tribunal</i> ?';
	$lang['Groups_access'] = 'Qui peut accéder aux <i>Groupes d\'utilisateurs</i> ?';
	$lang['Search_access'] = 'Qui peut accéder à <i>Rechercher</i> ?';
	$lang['Profile_access'] = 'Qui peut accéder aux <i>Profils</i> ?';
	$lang['Shoutbox_access'] = 'Qui peut accéder à <i>MiniChat</i> ?';
	$lang['Viewonline_access'] = 'Qui peut accéder au <i>Qui est en ligne</i> ?';

	/**
	* Hide Profile Options
	*/
	$lang['Hide_Elements'] = 'Profil';
	$lang['Hide_Entries_Config'] = 'Gestion du profil';
	$lang['Hide_Entries_explain'] = 'Le formulaire ci-dessous vous permettra de personnaliser toutes les options du profil.';
	$lang['Account_Informations'] = 'Ces autorisations sont individuelles.<br />Vous devez les activer via l\'éditeur de profil de l\'utilisateur concerné.';
	$lang['Click_return_profile_config'] = 'Cliquez %sici%s pour revenir à l\'administration du profil';
	$lang['override_user_icq'] = 'Masquer le champ <em>' . $lang['ICQ'] . '</em>';
	$lang['override_user_aim'] = 'Masquer le champ <em>' . $lang['AIM'] . '</em>';
	$lang['override_user_msn'] = 'Masquer le champ <em>' . $lang['MSNM'] . '</em>';
	$lang['override_user_skype'] = 'Masquer le champ <em>' . $lang['SKYPE'] . '</em>';
	$lang['override_user_yahoo'] = 'Masquer le champ <em>' . $lang['YIM'] . '</em>';
	$lang['override_user_website'] = 'Masquer le champ <em>' . $lang['Website'] . '</em>';
	$lang['override_user_location'] = 'Masquer le champ <em>' . $lang['Location'] . '</em>';
	$lang['override_user_occupation'] = 'Masquer le champ <em>' . $lang['Occupation'] . '</em>';
	$lang['override_user_interests'] = 'Masquer le champ <em>' . $lang['Interests'] . '</em>';
	$lang['override_user_birthday'] = 'Masquer les combos <em>' . $lang['bday_birthdate'] . '</em>';
	$lang['override_user_gender'] = 'Masquer les interrupteurs <em>' . $lang['Gender'] . '</em>';
	$lang['override_user_signature'] = 'Masquer l\'éditeur de signature';
	$lang['override_user_quick_post'] = 'Masquer les <em>Options de la Réponse Rapide</em>';
	$lang['override_user_public_view_mail'] = 'Masquer les interrupteurs <em>' . $lang['Public_view_email'] . '</em>';
	$lang['override_user_hide_online'] = 'Masquer les interrupteurs <em>' . $lang['Hide_user'] . '</em>';
	$lang['override_user_notify_on_reply'] = 'Masquer les interrupteurs <em>' . $lang['Always_notify'] . '</em>';
	$lang['override_user_notify_pm'] = 'Masquer les interrupteurs <em>' . $lang['Notify_on_privmsg'] . '</em>';
	$lang['override_user_popup_pm'] = 'Masquer les interrupteurs <em>' . $lang['Popup_on_privmsg'] . '</em>';
	$lang['override_user_notify_on_donation'] = 'Masquer les interrupteurs <em>' . $lang['Points_notify'] . '</em>';
	$lang['override_user_always_add_signature'] = 'Masquer les interrupteurs <em>' . $lang['Always_add_sig'] . '</em>';
	$lang['override_user_bbcode'] = 'Masquer les interrupteurs <em>' . $lang['Always_bbcode'] . '</em>';
	$lang['override_user_html'] = 'Masquer les interrupteurs <em>' . $lang['Always_html'] . '</em>';
	$lang['override_user_smilies'] = 'Masquer les interrupteurs <em>' . $lang['Always_smile'] . '</em>';
	$lang['override_user_language'] = 'Masquer les combos <em>' . $lang['Board_lang'] . '</em>';
	$lang['override_user_board_style'] = 'Masquer les combos <em>' . $lang['Board_style'] . '</em>';
	$lang['override_user_time_mode'] = 'Masquer les combos <em>' . $lang['Timezone'] . '</em>';
	$lang['override_user_date_format'] = 'Masquer les combos <em>' . $lang['Date_format'] . '</em>';
	$lang['override_user_posts_per_page'] = 'Masquer le champ <em>' . $lang['Posts_per_page'] . '</em>';
	$lang['override_user_topics_per_page'] = 'Masquer le champ <em>' . $lang['Topics_per_page'] . '</em>';

	/**
	* Disallow Editing/Deleting Administrator Posts
	*/
	$lang['Disallow_Edition_Deleting_Admin_Messages'] = 'Autoriser les modérateurs à modifier/supprimer les messages émis par les administrateurs';

	/**
	* MiniChat
	*/
	$lang['Shoutbox_Settings'] = 'MiniChat';
	$lang['shoutbox_on'] = 'Activer MiniChat';
	$lang['date_on'] = 'Afficher la date';
	$lang['sb_make_links'] = 'Faire des liens';
	$lang['sb_links_names'] = 'Lier le nom d\'utilisateur à son profil';
	$lang['sb_allow_edit'] = 'Autoriser les administrateurs et les modérateurs à éditer les messages';
	$lang['sb_allow_edit_all'] = 'Autoriser les utilisateurs à éditer leurs messages';
	$lang['sb_allow_delete'] = 'Autoriser les administrateurs et les modérateurs à supprimer les messages';
	$lang['sb_allow_delete_all'] = 'Autoriser les utilisateurs à supprimer leurs messages';
	$lang['sb_allow_guest'] = 'Autoriser les invités à émettre des messages dans MiniChat';
	$lang['sb_allow_guest_view'] = 'Autoriser les invités à voir MiniChat';
	$lang['delete_days'] = 'Nombre de jours avant que les messages ne soient supprimés';
	$lang['sb_text_lenght'] = 'Nombre maximal de lettres par message';
	$lang['sb_word_lenght'] = 'Nombre maximal de lettres par mot';
	$lang['shout_size'] = 'Dimensions de MiniChat';
	$lang['sb_banned_user_send'] = 'Désactiver l\'envoi de messages pour cet utilisateur';
	$lang['sb_banned_user_send_e'] = 'ID des utilisateurs ne pouvant pas émettre de messages dans MiniChat.<br />Séparez les IDs par des virgules (<strong>18, 124</strong>)';
	$lang['sb_banned_user_view'] = 'Désactiver MiniChat pour cet utilisateur';
	$lang['sb_banned_user_view_e'] = 'ID des utilisateurs ne pouvant pas voir MiniChat.<br />Séparez les IDs par des virgules (<strong>18, 124</strong>)';
	$lang['sb_refresh_time'] = 'Temps de rafraîchissement automatique de MiniChat (en secondes)';
	$lang['sb_messages_number_on_index'] = 'Nombre de messages affichés dans MiniChat sur l\'index du forum';

	/**
	* Split Topic Type
	*/
	$lang['split_global_announce'] = 'Séparer les annonces générales';
	$lang['split_announce']	= 'Séparer les annonces standards';
	$lang['split_sticky']	= 'Séparer les sujets permanents';
	$lang['split_topic_split'] = 'Séparer dans des boîtes différentes chaque type de sujets';

	/**
	* Admin Userlist
	*/
	$lang['Userlist'] = 'Liste des utilisateurs';
	$lang['Userlist_description'] = 'Ce formulaire affiche la liste complète des utilisateurs du forum et permet d\'effectuer plusieurs actions';
	$lang['Add_group'] = 'Ajouter à un groupe';
	$lang['Add_group_explain'] = 'Sélectionnez le groupe dans lequel vous voulez ajouter cet utilisateur';
	$lang['Open_close'] = 'Ouvrir/Fermer';
	$lang['Active'] = 'Actif';
	$lang['Group'] = 'Groupe(s)';
	$lang['Rank'] = 'Rang';
	$lang['Last_activity'] = 'Dernière visite';
	$lang['Never'] = 'Jamais';
	$lang['User_manage'] = 'Gestion';
	$lang['Find_all_posts'] = 'Trouver tous les messages';
	$lang['Select_one'] = 'Choisissez une option';
	$lang['Ban'] = 'Bannir';
	$lang['Is_Banned'] = 'est banni !'; 
	$lang['UnBan'] = 'Débannir';
	$lang['Activate_deactivate'] = 'Actif/Inactif';
	$lang['Select_All'] = 'Sélectionner tout';
	$lang['Deselect_All'] = 'Désélectionner tout';
	$lang['User_id'] = 'ID de l\'utilisateur';
	$lang['User_level'] = 'Niveau de l\'utilisateur';
	$lang['Ascending'] = 'Croissant';
	$lang['Descending'] = 'Décroissant';
	$lang['Show'] = 'Voir';
	$lang['All'] = 'Tous';
	$lang['Member'] = 'Utilisateur';
	$lang['Pending'] = 'En attente';
	$lang['Confirm_user_ban'] = 'Êtes-vous sûr de vouloir bannir le(s) membre(s) sélectionné(s) ?';
	$lang['Confirm_user_un_ban'] = 'Êtes-vous sûr de vouloir débannir le(s) membre(s) sélectionné(s) ?';
	$lang['Confirm_user_deleted'] = 'Êtes-vous sûr de vouloir supprimer le(s) membre(s) sélectionné(s) ?';
	$lang['User_status_updated'] = 'Statut de l\'utilisateur mis à jour !';
	$lang['User_banned_successfully'] = 'Utilisateur(s) banni(s) !';
	$lang['User_un_banned_successfully'] = 'Utilisateur(s) débanni(s) !';
	$lang['User_deleted_successfully'] = 'Utilisateur(s) supprimé(s) !';
	$lang['User_add_group_successfully'] = 'Utilisateur(s) ajouté(s) au groupe !';
	$lang['Click_return_userlist'] = 'Cliquez %sici%s pour retourner à la liste des utilisateurs';

	/**
	* Log IP Address On Registration
	*/
	$lang['Registration_IP'] = 'Adresse IP à l\'inscription';

	/**
	* Main Admin Security
	*/
	$lang['Main_Admin_Undeleted'] = 'Le compte de l\'administrateur principal ne peut pas être supprimé !';
	$lang['Main_Admin_Unchanged_Profile'] = 'Vous ne pouvez pas modifier le profil de l\'administrateur principal !';
	$lang['Main_Admin_Unchanged_Level'] = 'L\'administrateur principal ne peut pas devenir un simple membre !';

	/**
	* Quick Administrator User Options and Informations
	*/
	$lang['Click_return_userprofile'] = 'Cliquez %sici%s pour revenir au profil de l\'utilisateur';

	/**
	* Block The Index to The Guests
	*/
	$lang['No_Guest_on_Index'] = 'Autoriser les invités à aller sur l\'index du forum';

	/**
	* Forum Meta Tags
	*/
	$lang['Meta_Tags'] = 'Meta Tags';
	$lang['Meta_Tags_Explain'] = 'Depuis ce formulaire, vous pouvez ajouter des Meta Tags à l\'ensemble des pages de votre forum.<br />Les Meta Tags sont utilisés par les moteur de recherche. Vous pouvez en apprendre plus sur les Meta Tags <a target="_blank" href="http://searchenginewatch.com/webmasters/article.php/2167931">ici</a>.';
	$lang['Meta_Language'] = 'Langue du forum:';
	$lang['Meta_Language_Explain'] = 'La langue de votre forum. Pour en savoir plus, et connaître les langues supportées cliquez <a target="_blank" href="http://www.submitcorner.com/Guide/Meta/language.shtml">ici</a>.';
	$lang['Meta_Author'] = 'Auteur:';
	$lang['Meta_Author_Explain'] = 'Auteur du document en train d\'être lu (votre forum). Pour en savoir plus cliquez <a target="_blank" href="http://www.submitcorner.com/Guide/Meta/author.shtml">ici</a>.';
	$lang['Meta_Description'] = 'Description:';
	$lang['Meta_Description_Explain'] = 'Description de votre site/forum.';
	$lang['Meta_Keywords'] = 'Mots-clés:';
	$lang['Meta_Keywords_Explain'] = 'Mots-clés de votre site/forum. Séparez chacun d\'entre eux par une virgule.';
	$lang['Meta_Robots'] = 'Robots:';
	$lang['Meta_Robots_Explain'] = 'Dit aux robots ce qu\'ils doivent indexer.<br />Exemple: index, follow.<br />Les entrées possibles sont: index, follow; index, nofollow; noindex, nofollow; noindex, follow;<br />Vous pouvez visiter ce <a target="_blank" href="http://www.searchengineworld.com/metatag/robots.htm">lien</a> pour en savoir plus.';
	$lang['Meta_Rating'] = 'Evaluation:';
	$lang['Meta_Rating_Explain'] = 'Dit aux robots comment évaluer votre site/forum. Exemple: Général.';
	$lang['Meta_Visit_After'] = 'Revisiter après:';
	$lang['Meta_Visit_After_Explain'] = 'Dit aux robots quand ils doivent revisiter votre site/forum en jours.<br />Les entrées possibles sont: 2 days, 7 days, 15 days, 30 days, ou 60 days.';

	/**
	* User Post Count Editor
	*/
	$lang['Set_posts'] = 'Nombre de messages de l\'utilisateur';

	/**
	* Boulet
	*/
	$lang['user_boulet_title'] = 'Statut de boulet';
	$lang['user_boulet_type_0'] = '- N\'est pas un boulet -';
	$lang['user_boulet_type_1'] = 'Est un boulet à rediriger vers :';
	$lang['user_boulet_type_2'] = 'Est un boulet qui lira le message :';
	$lang['user_boulet_type_3'] = 'Est un boulet qui lira dans une page vierge le message :';

	/**
	* Disallow Mail and Password Changes
	*/
	$lang['Allow_mail_change'] = 'Autoriser les changements d\'adresse e-mail';
	$lang['Allow_password_change'] = 'Autoriser les changements de mot de passe';

	/**
	* Annonce Globale
	*/
	$lang['Annonce_Globale_Index'] = 'Afficher les annonces générales sur l\'index du forum';

	/**
	* Smiley Categories
	*/
	$lang['Smiley_Config'] = 'Smiles';
	$lang['Smiley_table_columns'] = 'Nombre de colonnes de smiles';
	$lang['Smiley_table_rows'] = 'Nombre de rangées de smiles';
	$lang['Smiley_posting'] = 'Dans le Posting, afficher les catégories sous forme de ...';
	$lang['Smiley_popup'] = 'Dans la Popup, afficher les catégories sous forme de ...';
	$lang['smiley_nothing'] = 'Rien';
	$lang['Smiley_button'] = 'Boutons';
	$lang['Smiley_dropdown'] = 'Menu déroulant';
	$lang['Smiley_buttons'] = 'En affichant des boutons, employer le suivant';
	$lang['Smiley_buttons_icon'] = 'Icône';
	$lang['Smiley_buttons_name'] = 'Nom';
	$lang['Smiley_buttons_number'] = 'Nombre';
	$lang['Smilies_icon_path'] = 'Dossier de stockage smiles';
	$lang['Smilies_icon_path_explain'] = 'Chemin relatif, exemple : images/smiles';

	/**
	* Limit Smilies Per Post
	*/
	$lang['Max_smilies'] = 'Nombre maximal de smiles par message';

	/**
	* Forum Icon With ACP Control
	*/
	$lang['Forum_icon'] = 'Icône du forum';
	$lang['Forum_icon_path'] = 'Dossier de stockage des icônes de forum';
	$lang['Forum_icon_path_explain'] = 'Chemin depuis la racine du dossier du forum, exemple : <em>images/forum_icons</em>';

	/**
	* Categories Hierarchy
	*/
	$lang['Last_topic_title_length'] = 'Longueur du titre du dernier sujet sur l\'index';
	$lang['Last_topic_title_length_explain'] = 'Choisissez la longueur en nombre de caractères des titres des derniers messages affichés sur la page d\'index, de manière à éviter une déformation de celle-ci dûe à des titres trop long. Renseignez cette valeur à 0 si vous ne désirez pas raccourcir ces titres.';

	/**
	* Colorize Forumtitle
	*/
	$lang['Forum_color'] = 'Mettre une couleur pour le titre du forum';
	$lang['Forum_color_explain'] = 'Laissez ce champ vide pour utiliser la couleur par défaut.';

	/**
	* Disable Word Censor For Single Forums
	*/
	$lang['Disable_word_censor'] = 'Désactiver la censure dans ce forum';

	/**
	* Rank Image Display
	*/
	$lang['Rank_img'] = 'Image';

	/**
	* Inactive Users
	*/
	$lang['Users_Inactive'] = 'Utilisateurs inactifs';
	$lang['Users_Inactive_Explain'] = 'Si dans la partie "Activation du compte" vous avez sélectionné "Membre" ou "Admin", dans cette liste vous aurez les utilisateurs qui n\'ont jamais été activé.<br /><br />En cliquant sur "Contacter", un email sera envoyé aux utilisateurs sélectionnés.<br />En cliquant sur "Activer", les utilisateurs sélectionnés seront activés.<br />En cliquant sur "Supprimer", un email sera envoyé aux utilisateurs sélectionnés et leurs comptes seront supprimés.';
	$lang['UI_Check_None'] = 'Aucune activation du compte';
	$lang['UI_Check_User'] = 'Activation du compte par l\'<strong>utilisateur</strong>';
	$lang['UI_Check_Admin'] = 'Activation du compte par l\'<strong>administrateur</strong>';
	$lang['UI_Check_Recom'] = '%s(Cliquez ici pour la changer)%s.';
	$lang['UI_Removed_Users'] = 'Utilisateurs supprimés';
	$lang['UI_User'] = 'Utilisateur';
	$lang['UI_Registration_Date'] = 'Date d\'enregistrement';
	$lang['UI_Last_Visit'] = 'Dernière visite';
	$lang['UI_Active'] = 'Actif';
	$lang['UI_Email_Sents'] = 'Envoyer un email';
	$lang['UI_Last_Email_Sents'] = 'Dernier email';
	$lang['UI_CheckColor'] = 'Selectionner';
	$lang['UI_CheckAll'] = 'Sélectionner tout';
	$lang['UI_UncheckAll'] = 'Désélectionner tout';
	$lang['UI_InvertChecked'] = 'Inverser la sélection';
	$lang['UI_Contact_Users'] = 'Contacter';
	$lang['UI_Delete_Users'] = 'Supprimer';
	$lang['UI_Activate_Users'] = 'Activer';
	$lang['UI_select_user_first'] = 'Vous devez sélectionner un utilisateur avant d\'effectuer cette action';
	$lang['UI_return'] = 'Cliquez %sici%s pour revenir à la page des utilisateurs inactifs';
	$lang['UI_Deleted_Users'] = 'Cet utilisateur à été supprimé';
	$lang['UI_Activated_Users'] = 'Le compte de cet utilisateur à été activé';
	$lang['UI_Alert_Days'] = 'jours';
	$lang['UI_with_zero_messages'] = 'sans messages';
	$lang['UI_Alert_Every'] = 'Chaque';
	$lang['UI_Alert_UpTo'] = 'Tous les ';
	$lang['UI_Alert_Over'] = 'Plus de';

	/**
	* Jail MOD
	*/
	$lang['Jail'] = 'Prison';
	$lang['Jail_settings'] = 'Configuration';

	/**
	* Online Offline Hidden
	*/
	$lang['Online_time'] = 'Durée du statut en ligne';
	$lang['Online_time_explain'] = 'Nombre de secondes durant lequel un membre doit être affiché en ligne (ne pas utiliser une valeur inférieure à 60).';
	$lang['Online_setting'] = 'Menu du Satut';
	$lang['Online_color'] = 'Couleur du texte En ligne';
	$lang['Offline_color'] = 'Couleur du texte Absent';
	$lang['Hidden_color'] = 'Couleur du texte Invisible';
	$lang['xs_data_online_color'] = $lang['Online_color'];
	$lang['xs_data_offline_color'] = $lang['Offline_color'];
	$lang['xs_data_hidden_color'] = $lang['Hidden_color'];

	/**
	* Move Forum Logo Settings To ...
	*/
	$lang['Theme_logo'] = 'Chemin du Logo du forum';
	$lang['Theme_logo_explain'] = 'Mettre l\'adresse relative du Logo de votre forum';

	/**
	* Disable Board Message
	*/
	$lang['Board_disable_caption'] = 'Titre du forum désactivé';
	$lang['Board_disable_text'] = 'Message du forum désactivé';

	/**
	* Disable Registration
	*/
	$lang['disable_registration_status'] = 'Désactiver les inscriptions';
	$lang['disable_registration_status_explain'] = 'Ceci permet de désactiver momentanément les inscriptions à votre forum.';
	$lang['registration_closed'] = 'Raison de la clotûre des inscriptions';
	$lang['registration_closed_explain'] = 'Texte expliquant la raison de la fermeture des inscriptions, qui s\'affichera lorsqu\'un utilisateur voudra s\'inscrire. Laisser blanc pour afficher le texte par défaut.';

	/**
	* Disable Registration
	*/
	$lang['pm_allow_threshold'] = 'Seuil avant autorisation des Messages Privés';
	$lang['pm_allow_threshold_explain'] = 'Indiquez ici le nombre minimal de messages qu\'un utilisateur doit avoir émis afin de pouvoir utiliser les Messages Privés.';

	/**
	* Restrict Account to IP
	*/
	$lang['iprange'] = 'Rangées d\'IP';
	$lang['restrictip'] = 'Restreindre le compte via l\'IP';
	$lang['about_restrictip'] = 'Restreindre le compte à l\'IP';
	$lang['about_range'] = 'Insérez les différents formats séparées par une virgule:<ul><li>IP simple</li><li>Sous-réseau: 192.168.1</li><li>Rangée: 192.167.0.0-192.168.8.1</li></ul>';

	/**
	* Double Post Merge
	*/
	$lang['Join_Interval'] = 'Période de regroupement des messages (en heures):';
	$lang['Join_Interval_explain'] = 'Si un même membre répond plusieurs fois à la suite de son dernier message, ceux-ci seront tous regroupés durant la période saisie';

	/**
	* BBCode Box Reloaded
	*/
	$lang['BBcode_Box'] = 'BBcode Box';
	$lang['bbc_box_a_settings'] = 'Configuration';
	$lang['bbc_box_b_list'] = 'Liste des bbcodes';
	$lang['bbc_box_c_manage'] = 'Gestion';

	/**
	* Forumtitle as Weblink
	*/
	$lang['Forum_is_link'] = 'Changer le titre du forum en tant que lien';
	$lang['Forum_weblink'] = 'Lien (en incluant <i>http://</i>):';
	$lang['Forum_link_target'] = 'Ouvrir dans une nouvelle fenêtre';

	/**
	* Maxi Simple Subforums
	*/
	$lang['Max_subforums'] = 'Nombre de sous-forums affichés';
	$lang['Max_subforums_explain'] = 'Nombre maximal de sous-forums à afficher sur l\'index';

	/**
	* Password Protected Forums
	*/
	$lang['Forum_password'] = 'Mot de passe du forum';

	/**
	* Recycle Bin Hack
	*/
	$lang['Bin_forum'] = 'Forum Corbeille';
	$lang['Bin_forum_explain'] = 'ID du forum Corbeille où les sujets seront déplacés, une valeur de 0 désactivera cette option. Vous devriez éditer les permissions de ce forum pour interdire aux utilisateur l\'accès à ce forum.';

	/**
	* Resize Posted Images Based on Max Width
	*/
	$lang['Images_max_size'] = 'Veuillez saisir la taille maximale en pixels<br />Toute image dépassant cette valeur sera réduite automatiquement.';

	/**
	* Force Guests to Enter Their Usernames
	*/
	$lang['guests_need_name'] = 'Obliger les invités à indiquer un nom d\'utilisateur pour poster'; 

	/**
	* Points System
	*/
	$lang['Points_Configuration'] = 'Système de points';
	$lang['Points_enable_post']	= 'Gagner des %s en émettant';
	$lang['Points_enable_post_explain']	= 'Permet aux utilisateurs de gagner des %s en postant des nouveaux sujets et en répondant à ceux existants';
	$lang['Points_enable_browse'] = 'Gagner des %s en naviguant';
	$lang['Points_enable_browse_explain'] = 'Permet aux utilisateurs de gagner des %s en naviguant sur les forums';
	$lang['Points_enable_donation']	= 'Autoriser les dons';
	$lang['Points_enable_donation_explain']	= 'Permet aux utilisateurs de se donner des %s entre eux';
	$lang['Points_name'] = 'Nom des points';
	$lang['Points_name_explain'] = 'Appelation des points sur votre forum';
	$lang['Points_per_reply'] = 'Points par réponse';
	$lang['Points_per_reply_explain'] = 'Montant de %s gagné(s) par réponse';
	$lang['Points_per_topic'] = 'Points par nouveaux sujets';
	$lang['Points_per_topic_explain'] = 'Montant de %s gagné(s) pour chaque nouveau sujet créé';
	$lang['Points_per_page'] = 'Points par page';
	$lang['Points_per_page_explain'] = 'Montant de %s gagné(s) pour chaque page affichée';
	$lang['Points_user_group_auth'] = 'Groupes autorisés';
	$lang['Points_user_group_auth_explain'] = 'Entrez les IDs des groupes autorisés à accéder au panneau de contrôle des points. Une seule ID par ligne.';
	$lang['Points_reset'] = 'Réinitialiser les points de tous les utilisateurs';
	$lang['Points_reset_explain'] = 'Entrez un nombre puis validez : cela deviendra le nombre de points de tous les utilisateurs.';
	$lang['Points_disabled'] = 'Désactiver les %s';
	$lang['Allow_Points'] = 'Utiliser le système de points ?';

	/**
	* Gender
	*/
	$lang['Gender_required'] = 'Forcer les utilisateurs à indiquer leur sexe';

	/**
	* Presentation
	*/
	$lang['present_required'] = 'Obliger les membres à se présenter';
	$lang['present_forum'] = 'ID du Forum de présentation';
	$lang['present_explain'] = 'L\'ID se situe juste après <em>f=</em> dans le lien du forum concerné.';

	/**
	* Account Self-Delete
	*/
	$lang['account_delete'] = 'Permettre aux membres de supprimer leurs propres comptes';
	$lang['Allow_account_delete'] = 'Autoriser ce membre à supprimer son propre compte';

	/**
	* Admin Voting
	*/
	$lang['Admin_Vote_Title'] = 'Sondages';
	$lang['Admin_Vote_Explain'] = 'Résultats des sondages (qui a voté et quel a été son vote).';
	$lang['Vote_id'] = '#';
	$lang['Poll_topic'] = 'Sujet du sondage';
	$lang['Vote_username'] = 'Voteur(s) / Voteuse(s)';
	$lang['Vote_end_date'] = 'Durée de vote';
	$lang['Sort_vote_id'] = 'Numéro de sondage';
	$lang['Sort_poll_topic'] = 'Sujet du sondage';
	$lang['Sort_vote_start'] = 'Date de début';
	$lang['Submit'] = 'Envoyer';
	$lang['Select_sort_field'] = 'Sélectionner la méthode de tri';
	$lang['Sort_order'] = 'Ordre';
	$lang['Sort_ascending'] = 'Croissant';
	$lang['Sort_descending'] = 'Décroissant';

	/**
	* Configure Member Profile Required Fields
	*/
	$lang['user_field_required'] = 'Forcer les membres à remplir ce champ';

	/**
	* Seperate PM Limits for Admins and Mods
	*/
	$lang['Administrator_Inbox_limits'] = 'Nombre maximal de messages dans la boîte de réception des administrateurs';
	$lang['Administrator_Sentbox_limits'] = 'Nombre maximal de messages dans la boîte des messages envoyés des administrateurs';
	$lang['Administrator_Savebox_limits'] = 'Nombre maximal de messages dans la boîte des archives des administrateurs';
	$lang['Moderator_Inbox_limits'] = 'Nombre maximal de messages dans la boîte de réception des modérateurs';
	$lang['Moderator_Sentbox_limits'] = 'Nombre maximal de messages dans la boîte des messages envoyés des modérateurs';
	$lang['Moderator_Savebox_limits'] = 'Nombre maximal de messages dans la boîte des archives des modérateurs';
	$lang['Inbox_limits'] = 'Nombre maximal de messages dans la boîte de réception des membres';
	$lang['Sentbox_limits'] = 'Nombre maximal de messages dans la boîte des messages envoyés des membres';
	$lang['Savebox_limits'] = 'Nombre maximal de messages dans la boîte des archives des membres';
	$lang['Trashbox_limits'] = 'Nombre maximal de messages dans la corbeille des membres';
	$lang['Administrator_Trashbox_limits'] = 'Nombre maximal de messages dans la corbeille des administrateurs';
	$lang['Moderator_Trashbox_limits'] = 'Nombre maximal de messages dans la corbeille des modérateurs';

	/**
	* Mini Card
	*/
	$lang['card_warn_level'] = 'Nombre maximal d\'avertissements qu\'un utilisateur peut recevoir';

	/**
	* Simple Subtemplates
	*/
	$lang['Subtemplate'] = 'Thème à afficher dans ce forum';

	/**
	* Welcome Private Message
	*/
	$lang['wpm'] = 'Message privé de bienvenue';
	$lang['wpm_active'] = 'Envoyer un message privé de bienvenue à l\'enregistrement';
	$lang['wpm_name'] = 'Envoyé par:';
	$lang['wpm_subject'] = 'Sujet:';
	$lang['wpm_message'] = 'Message:';
}

/**
* OxyGen PreMOD
*/
$lang['OxyGen_PreMOD'] = '<a href="http://www.ezcom-fr.com/" target="_blank" class="copyright" alt="Communauté EzCom" title="Communauté EzCom">OxyGen PreMOD</a> %s';

/**
* Instant MSG
*/
$lang['Send_instant_msg_to'] = 'Envoyer un message éclair à %s';
$lang['Send_instant_msg'] = 'Envoyer';
$lang['Reply_instant_msg'] = 'Répondre';
$lang['Instant_msg_recommence'] = 'Recommencer';
$lang['Instant_msg_quit'] = 'Quitter';
$lang['You_send_a_message_to'] = 'Vous envoyez un message à %s';
$lang['Your_message'] = 'Votre message';
$lang['Instant_msg_error_reg_message'] = 'Erreur dans l\'enregistrement du message';
$lang['Instant_msg_message_send'] = 'Message envoyé';
$lang['Instant_msg_empty_message'] = 'Votre message est vide';
$lang['Instant_msg_no_action'] = 'Pas d\'action';
$lang['Instant_msg_send_message'] = 'Envoyer message';
$lang['Instant_msg_erased_message'] = 'Message effacé';
$lang['Instant_msg_received_message'] = 'Message reçu';

/**
* vBulletin Who Is Online
*/
$lang['Who_was_Online'] = 'Qui était en ligne ?';
$lang['Statistics'] = 'Statistiques du forum';

/**
* Board Generation Time Info
*/
$lang['Gzip_on'] = 'GZIP actif - ';
$lang['Debug_on'] = 'Débogage actif';
$lang['Debug_off'] = 'Débogage inactif';
$lang['Queries'] = 'Requêtes: %s';
$lang['Generation_time'] = 'Temps: %s secondes';

/**
* Topics A User Has Started
*/
$lang['Posted_topics_zero_total'] = ' dans <strong>aucun</strong> sujet';
$lang['Posted_topics_total'] = ' dans <strong>%d</strong> sujets';
$lang['Posted_topic_total'] = ' dans <strong>%d</strong> sujet';
$lang['Topics_Started'] = 'Sujets';
$lang['Search_user_topics'] = 'Trouver tous les sujets de %s';
$lang['User_topic_pct_stats'] = '%.2f%% du total';
$lang['User_topic_day_stats'] = '%.2f sujets par jour';
$lang['Sort_Topics'] = 'Sujets';
$lang['Search_your_topics'] = 'Voir ses sujets';

/**
* Quick Administrator User Options and Informations
*/
$lang['Quick_admin_options'] = 'Options rapides de l\'administrateur';
$lang['Admin_edit_profile'] = 'Éditer le profil de %s';
$lang['Admin_edit_permissions'] = 'Éditer les permissions de %s';
$lang['User_active'] = '%s <strong>est</strong> actif';
$lang['User_not_active'] = '%s <strong>n\'est pas</strong> actif';
$lang['Username_banned'] = '%s <strong>est</strong> banni';
$lang['Username_not_banned'] = '%s <strong>n\'est pas</strong> banni';
$lang['User_email_banned'] = 'L\'e-mail (%s) de %s <strong>est</strong> banni';
$lang['User_email_not_banned'] = 'L\'e-mail de %s <strong>n\'est pas</strong> banni';

/**
* Sort Memberlist Per Letter
*/
$lang['Sort_per_letter'] = 'N\'afficher que les noms d\'utilisateur commençant par';
$lang['Others'] = 'autres';
$lang['All'] = 'tous';

/**
* Topics Nav Buttons
*/
$lang['View_previous_post'] = 'Voir le message précédent';
$lang['View_next_post'] = 'Voir le message suivant';
$lang['Go_to_bottom'] = 'Aller en bas';

/**
* Bottom Tabs
*/
$lang['bt_title'] = 'Informations';
$lang['bt_perms'] = 'Permissions du forum';
$lang['bt_icons'] = 'Icônes des messages';
$lang['bt_showhide_alt'] = 'Voir ou cacher les informations';

/**
* Disallow Mail and Password Changes
*/
$lang['mail_explain'] = 'Si vous souhaitez changer d\'adresse e-mail, faites en la demande auprès de l\'administrateur.';
$lang['password_explain'] = 'Si vous souhaitez changer de mot de passe, faites en la demande auprès de l\'administrateur.';

/**
* Annonce Globale
*/
$lang['Global_Announce'] = 'Annonce générale';
$lang['Topic_Global_Announcement'] = '<strong>Annonce générale : </strong>';
$lang['Post_Global_Announcement'] = 'Annonce générale';
$lang['Post_Global_Announcements'] = 'Annonces générales';
$lang['Post_Announcement'] = 'Annonce';

/**
* Smiley Categories
*/
$lang['smiley_categories'] = 'Catégories de Smiles';
$lang['no_smilies'] = 'Désolé, il n\'y a pas de smiles :(';
$lang['smiley_help'] = 'Choisissez la catégorie que vous souhaitez voir apparaître dans la popup.';

/**
* Limit Smilies Per Post
*/
$lang['Max_smilies_per_post'] = 'Vous pouvez mettre au maximum %s smiles par message.<br />Vous avez mis %s smiles de trop.';

/**
* Online Offline Hidden
*/
$lang['Online'] = 'En ligne';
$lang['Offline'] = 'Absent';
$lang['Hidden'] = 'Invisible';
$lang['is_online'] = '%s est actuellement en ligne';
$lang['is_offline'] = '%s est absent';
$lang['is_hidden'] = '%s est invisible';
$lang['Online_status'] = 'Statut';

/**
* Disable Registration
*/
$lang['registration_status'] = 'Désolé, mais les inscriptions à ce forum sont actuellement fermées. Veuillez réessayer ultérieurement.';

/**
* Keep Unread Flags
*/
$lang['Search_new'] = 'Nouveaux messages';
$lang['keep_post_unread_explain'] = 'Marquer les messages de ce sujet comme non-lus';
$lang['keep_unread_done'] = 'Le sujet a été marqué comme non-lu.';
$lang['View_unread_posts'] = 'Messages non-lus';
$lang['No_unread_posts'] = 'Aucun message non-lu';

/**
* Simple Subforums
*/
$lang['Subforums'] = 'Sous-forums';

/**
* Double Post Merge
*/
$lang['Added_after'] = 'Ajouté après';
$lang['dpm_hours'] = ' %s heures';
$lang['dpm_minutes'] = ' %s minutes';
$lang['dpm_seconds'] = ' %s secondes';
$lang['dpm_hour'] = ' 1 heure';
$lang['dpm_minute'] = ' 1 minute';
$lang['dpm_second'] = ' 1 seconde';

/**
* BBCode Box Reloaded
*/
$lang['bbcbxr_spoil'] = 'Spoiler';
$lang['bbcbxr_show'] = 'voir';
$lang['bbcbxr_hide'] = 'cacher';
$lang['bbcbxr_expand'] = 'Agrandir';
$lang['bbcbxr_expand_more'] = 'Agrandir encore';
$lang['bbcbxr_contract'] = 'Réduire';
$lang['bbcbxr_select'] = 'Tout sélectionner';
$lang['Thumbnails_alt'] = 'Image postée, réduite en taille. Si aucune image n\'est visible le serveur est mort ou non liable à distance';
$lang['Thumbnails_title'] = 'Cliquez pour agrandir';
$lang['PHPCode'] = 'PHP';
$lang['youtube_link'] = 'Lien';

/**
* Forumtitle as Weblink
*/
$lang['Forum_link_count'] = 'Ce lien a été visité %s fois.';
$lang['Forum_is_a_link'] = 'Lien';

/**
* Invision View Profile
*/
$lang['Invision_Active_Stats'] = 'Statistiques';
$lang['Invision_Communicate'] = 'Communiquer';
$lang['Invision_Info'] = 'Informations';
$lang['Invision_Member_Group'] = 'Appartenance au(x) groupe(s)';
$lang['Invision_Member_Title'] = 'Rang du membre';
$lang['Invision_Most_Active'] = 'Le plus actif dans';
$lang['Invision_Most_Active_Posts'] = '%s message(s) dans ce forum';
$lang['Invision_Details'] = 'Détails supplémentaires';
$lang['Invision_PPD_Stats'] = 'Messages par jour';
$lang['Invision_Signature'] = 'Signature';
$lang['Invision_Website'] = 'Site web';
$lang['Invision_Total_Posts'] = 'Total des messages de ce membre';
$lang['Invision_User_post_pct_stats'] = '( %.2f%% du total des messages du forum )';
$lang['Invision_User_post_day_stats'] = '%.2f messages par jour';
$lang['Invision_Search_user_posts'] = 'Trouver tous les messages de ce membre';
$lang['Invision_Posting_details'] = 'Détails supplémentaires';
$lang['Invision_Empty_field'] = '<em>Aucune information</em>';

/**
* Inspired of Categories Hierarchy
*/
$lang['Topic_Poll'] = 'Sondage';

/**
* vAgreement Terms
*/
$lang['Reg_agreement'] = '<font class="gen"><b>Messages</b></font><br />Les administrateurs et modérateurs de ce forum s\'efforceront de supprimer ou éditer tous les messages à caractère répréhensible aussi rapidement que possible. Toutefois, il leur est impossible de passer en revue tous les messages. Vous admettez donc que tous les messages postés sur ces forums expriment la vue et opinion de leurs auteurs respectifs, et non pas des administrateurs, ou modérateurs, ou webmestres (excepté les messages postés par eux-même) et par conséquent ne peuvent pas être tenus pour responsables.<br /><br /><font class="gen"><b>Contenu de vos messages</b></font><br />Vous consentez à ne pas poster de messages injurieux, obscènes, vulgaires, diffamatoires, menaçants, sexuels ou tout autre message qui violeraient les lois applicables. Le faire peut vous conduire à être banni immédiatement de façon permanente (et votre fournisseur d\'accès à internet en sera informé). L\'adresse IP de chaque message est enregistrée afin d\'aider à faire respecter ces conditions. Vous êtes d\'accord sur le fait que le webmestre, l\'administrateur et les modérateurs de ce forum ont le droit de supprimer, éditer, déplacer ou verrouiller n\'importe quel sujet de discussion à tout moment. En tant qu\'utilisateur, vous êtes d\'accord sur le fait que toutes les informations que vous donnerez ci-après seront stockées dans une base de données. Cependant, ces informations ne seront divulguées à aucune tierce personne ou société sans votre accord. Le webmestre, l\'administrateur, et les modérateurs ne peuvent pas être tenus pour responsables si une tentative de piratage informatique conduit à l\'accès de ces données.<br /><br /><font class="gen"><b>Informations collectées et Cookies</b></font><br />Ce forum utilise les cookies pour stocker des informations sur votre ordinateur. Ces cookies ne contiendront aucune information que vous aurez entré ci-après; ils servent uniquement à améliorer le confort d\'utilisation. L\'adresse e-mail est uniquement utilisée afin de confirmer les détails de votre enregistrement ainsi que votre mot de passe (et aussi pour vous envoyer un nouveau mot de passe dans le cas où vous l\'oublieriez).<br /><br /><font class="gen"><b>Vous acceptez...</b></font><br />En vous enregistrant, vous vous portez garant du fait d\'être en accord avec le règlement ci-dessus.';
$lang['To_Join'] = 'Avant de procéder à votre inscription définitive, vous devez manifester votre accord avec les règles suivantes :';
$lang['Forum_Rules'] = 'Règles du forum';
$lang['Agree_checkbox'] = 'J\'ai lu les règles de %s et j\'accepte de les respecter.';

/**
* Force Guests to Enter Their Usernames
*/
$lang['Username_needed'] = 'Vous devez indiquer un nom d\'utilisateur !';

/**
* Maxi Simple Subforums
*/
$lang['More'] = '[Plus ...]';
$lang['More_HTML'] = 'Voir tous les sous-forums';

/**
* First Topic Date
*/
$lang['Create_Date'] = 'Créé le';

/**
* Password Protected Forums
*/
$lang['Incorrect_forum_password'] = 'Mot de passe incorrect';
$lang['Only_alpha_num_chars'] = 'Le mot de passe doit être entre 3 et 20 caractères et ne peut contenir que des caractères alphanumériques (A-Z, a-z, 0-9).';
$lang['Enter_forum_password'] = 'Entrez le mot de passe du forum';
$lang['Password_login_success'] = 'Vous pouvez désormais accéder au forum';
$lang['Click_return_page'] = 'Cliquez %sici%s pour revenir à la page';

/**
* Recycle Bin Hack
*/
$lang['Move_bin'] = 'Envoyer ce sujet à la corbeille';
$lang['Topics_Moved_bin'] = 'Les sujets sélectionnés ont été déplacés vers la corbeille';
$lang['Bin_disabled'] = 'La corbeille a été désactivée';
$lang['Bin_recycle'] = 'Recycler';

/**
* DHTML Collapsible FAQ
*/
$lang['dhtml_faq_noscript'] = 'Il semblerait que votre navigateur ne supporte pas JavaScript ou que celui-ci est désactivé dans les réglages de votre navigateur.<br /><br />Cliquez %sici%s afin de visualiser la version HTML de la FAQ.';

/**
* ModCP Merge Hack
*/
$lang['Merge'] = 'Fusionner';
$lang['Merge_topic'] = 'Fusionner au sujet';

/**
* Return to Profile Link
*/
$lang['Profile_see'] = 'Cliquez %sici%s pour retourner à votre profil';

/**
* Resize Posted Images Based on Max Width
*/
$lang['rmw_image_title'] = 'Cliquez pour agrandir';

/**
* Points System
*/
$lang['Points_cp'] = 'Panneau de contrôle des points';
$lang['Points_sys']	= 'Système de points';
$lang['Points_donation'] = 'Don de points';
$lang['Points_method'] = 'Méthode';
$lang['Points_donate'] = '%sDonner%s';
$lang['Points_add_subtract'] = 'Ajouter ou soustraire des %s';
$lang['Points_amount'] = 'Montant';
$lang['Points_give_take'] = 'Montant de %s à donner ou à prendre';
$lang['Points_give'] = 'Montant de %s à donner';
$lang['Add'] = 'Ajouter';
$lang['Subtract'] = 'Soustraire';
$lang['Points_donate_to'] = 'La personne à qui vous voulez donner des %s ';
$lang['Points_no_username']	= 'Veuillez entrer un nom d\'utilisateur.';
$lang['Points_not_admin'] = 'Vous n\'êtes pas autorisé à administrer le système de points.';
$lang['Points_cant_take'] = 'Vous ne pouvez pas prendre cette somme de %s à cet utilisateur.'; //*
$lang['Points_thanks_donation']	= 'Merci pour votre don.';
$lang['Click_return_points_donate']	= 'Cliquez %sici%s pour retourner au don de points';
$lang['Points_cant_donate']	= 'Vous ne pouvez pas donner ce montant de %s à cet utilisateur.';
$lang['Points_cant_donate_self'] = 'Vous ne pouvez pas vous donner des %s .';
$lang['Points_user_donation_off'] = 'Le don n\'est pas autorisé actuellement.';
$lang['Click_return_pointscp'] = 'Cliquez %sici%s pour retourner au panneau de contrôle des points';
$lang['Points_user_updated'] = 'Les %s de cet utilisateur ont été mis à jour avec succès.';
$lang['Points_mass_edit'] = 'Edition de masse des utilisateurs';
$lang['Points_mass_edit_explain'] = 'Entrez un nom d\'utilisateur par ligne.';
$lang['Points_notify'] = 'Toujours m\'avertir des dons de %s ';
$lang['Points_notify_explain'] = 'M\'envoyer un e-mail quand quelqu\'un me donne des %s ';
$lang['Points_enter_some_donate'] = 'Entrez le montant de %s que vous désirez donner.';

/**
* Jail MOD
*/
$lang['Cell_courthouse'] = 'Tribunal';
$lang['Celleds_time'] = 'Emprisonnements';

/**
* Gender
*/
$lang['Gender'] = 'Sexe';
$lang['Male'] = 'Masculin';
$lang['Female'] = 'Féminin';
$lang['No_gender_specify'] = '<em>Non spécifié</em>';
$lang['Gender_require'] = 'Vous devez indiquer votre sexe.';

/**
* Export PMs to XML
*/
$lang['Export'] = 'Exporter';

/**
* Presentation
*/
$lang['presus']  = 'Vous devez vous présenter sur le forum prévu à cet effet avant de pouvoir poster';
$lang['presuscli'] = 'Cliquez %sici%s';

/**
* Account Self-Delete
*/
$lang['Account_delete'] = 'Voulez-vous supprimer votre compte sur ce forum ?';
$lang['Account_delete_explain'] = 'La suppression de votre compte sera définitive';
$lang['User_deleted'] = 'Votre compte a été supprimé avec succès.';
$lang['Delete_account_question'] = 'La suppression de votre compte entraînera la suppression de toutes les informations personnelles vous concernant inclus dans votre profil, au sein de la base de données de ce forum. Les messages que vous avez écrits dans ce forum verront leur auteur remplacés par un invité. <b>Attention !</b> Toute suppression sera définitive.<br /><br />Souhaitez-vous supprimer votre compte sur ce forum?';

/**
* Extended PM Notification
*/
$lang['List'] = 'Liste';
$lang['Ordered_list'] = 'Liste ordonnée';

/**
* Users Set Posts & Topics Count
*/
$lang['Posts_per_page'] = 'Messages par page';
$lang['Posts_per_page_explain'] = 'Saisissez le nombre de messages affichés par page. Laissez ce champ vide pour avoir les réglages par défaut.';
$lang['Topics_per_page'] = 'Sujets par page';
$lang['Topics_per_page_explain'] = 'Saisissez le nombre de sujets affichés par page. Laissez ce champ vide pour avoir les réglages par défaut.';

/**
* Restrict Account to IP
*/
$lang['restrict_ip'] = 'Vous ne pouvez pas vous connecter à ce compte depuis cette adresse IP/rangée d\'IP.';

/**
* Skype
*/
$lang['SKYPE'] = 'Skype Messenger';

/**
* Disallow Editing/Deleting Administrator Posts
*/
$lang['Not_auth_edit_delete_admin'] = 'Vous n\'êtes pas autorisé(e) à modifier/supprimer un message émis par un administrateur !';

/**
* MiniChat
*/
$lang['Shoutbox'] = 'MiniChat';
$lang['gg_mes'] = 'Message';
$lang['login_to_shoutcast'] = 'Vous devez être connecté pour utiliser MiniChat';
$lang['sb_show'] = '<strong>Afficher</strong>';
$lang['sb_hide'] = '<strong>Masquer</strong>';
$lang['sb_hide_done'] = 'Terminé';
$lang['too_long_word'] = 'Mot trop long';
$lang['sb_banned_send'] = 'Vous ne pouvez pas envoyer de messages';
$lang['shout_refresh'] = 'Rafraîchir';
$lang['Censor'] = 'Censurer';
$lang['Flood'] = 'Vous ne pouvez pas poster un autre sujet en si peu de temps après le dernier; veuillez réessayer dans un court instant.';
$lang['title_minichat'] = 'MiniChat';

/**
* Trashbox
*/
$lang['Trashbox'] = 'Corbeille';
$lang['Privmsg_Deleted'] = 'Supprimé';
$lang['Purge_marked'] = 'Supprimer la sélection';
$lang['Purge_all'] = 'Tout supprimer';
$lang['Undelete_marked'] = 'Ne pas supprimer la sélection';
$lang['Purge_message'] = 'Supprimer le message';
$lang['Undelete_message'] = 'Ne pas supprimer le message';
$lang['Trashbox_size'] = 'Votre corbeille est pleine à %d%%';

/**
* Seperate PM Limits for Admins and Mods
*/
$lang['Administrator_Inbox'] = 'Boîte de réception des administrateurs';
$lang['Administrator_Outbox'] = 'Boîte d\'envoi des administrateurs';
$lang['Administrator_Savebox'] = 'Archives des administrateurs';
$lang['Administrator_Sentbox'] = 'Messages envoyés des administrateurs';
$lang['Administrator_Trashbox'] = 'Corbeille des administrateurs';
$lang['Moderator_Inbox'] = 'Boîte de réception des modérateurs';
$lang['Moderator_Outbox'] = 'Boîte d\'envoi des modérateurs';
$lang['Moderator_Savebox'] = 'Archives des modérateurs';
$lang['Moderator_Sentbox'] = 'Messages envoyés des modérateurs';
$lang['Moderator_Trashbox'] = 'Corbeille des modérateurs';

/**
* Mini Card
*/
$lang['yellow_card'] = 'Avertissement';
$lang['red_card'] = 'Bannir';
$lang['green_card'] = 'Débannir';

/**
* Welcome Private Message
*/
$lang['not_delete_pm'] = 'Impossible de supprimer vos plus vieux messages privés';
$lang['non_existing_user'] = 'Tentative d\'obtention de données pour un utilisateur inexistant';
$lang['No_entry_wpm'] = 'Merci de votre inscription sur [sitename] !';
$lang['no_sent_pm_insert'] = 'Impossible d\'insérer les informations envoyées du message privé !';

?>
