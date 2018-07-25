<?php 
/*************************************************************************** 
* 						lang_jail.php [French] 
* 							------------------- 
*
* 						Translation : 
* 					Forums : 
* 
****************************************************************************/ 

$lang['Cell'] = 'Prison';
$lang['Cell_admin_title'] = 'Prison';
$lang['Cell_admin_title_explain'] = 'Ici vous pouvez emprisonner ou libérer des membress , et définir le temps de leur peine et le montant de leur caution';
$lang['Cell_admin_select_user'] = 'Sélectionnez un membre à emprisonner';
$lang['Cell_admin_select'] = 'Emprisonner cet membre';
$lang['Cell_admin_time'] = 'Durée d\'emprisonnement';
$lang['Cell_admin_time_explain'] = 'Ceci représente le temps durant lequel le membre n\'aura plus accès à votre forum';
$lang['Cell_admin_caution'] = 'Montant de la caution';
$lang['Cell_admin_caution_explain'] = 'Somme que le membre devra payer pour sa libération . Laissez cette valeur nulle si vous n\'utilisez pas de mod de système de points ou si vous ne désirez pas fixer une caution';
$lang['Cell_admin_celled_ok'] = 'Le membre sélectionné a été emprisonné avec succès';
$lang['Cell_admin_uncelled_ok'] = 'Les membress sélectionnés ont été libérés avec succès';
$lang['Cell_admin_general_return'] = '<br /><br /> Cliquez <a href="' . append_sid('admin_cell.'.$phpEx) . '">ici</a> pour retourner à la gestion de la prison<br /><br />Cliquez <a href="' . append_sid('index.'.$phpEx . '?pane=right') . '">ici</a> pour retourner à l\'index d\'administration';
$lang['Cell_admin_celled_users'] = 'Membres emprisonnés';
$lang['Cell_admin_celled_name'] = 'Nom';
$lang['Cell_admin_celled_caution'] = 'Caution';
$lang['Cell_admin_celled_time'] = 'Temps restant';
$lang['Cell_admin_celled_free'] = 'Libérer';
$lang['Cell_admin_manual_update'] = 'Mettre à jour le temps d\'emprisonnement restant';
$lang['Cell_admin_manual_update_explain'] = 'La mise à jour du temps d\'emprisonnement restant se fait lorsque le membre emprisonné se connecte sur le forum . En conséquence , les durées de peine restantes que vous voyez peuvent ne pas être à jour si le membre ne s\'est pas connecté depuis quelque temps . Cliquez sur le bouton ci-dessous pour corriger cela .';
$lang['Cell_admin_celled_manual_update_ok'] = 'Mise à jour manuelle des temps d\'emprisonnement effectuée avec succès . Les membres suivants ont été libérés :<br />';
$lang['Cell_sentence_example'] = 'Vous avez été emprisonné pour non respect du règlement';
$lang['Cell_sentence'] = 'Sentence';
$lang['Cell_sentence_explain'] = 'Ce texte expliquera au membre emprisonné la raison de sa détention';
$lang['Cell_title'] = 'Emprisonnement';
$lang['Cell_explain'] = 'Un des administrateurs du forum a décidé de vous emprisonner durant';
$lang['Cell_time_explain'] = 'Durant cette période vous ne pouvez plus accéder au forum';
$lang['Cell_day'] = 'Jour';
$lang['Cell_hour'] = 'Heure';
$lang['Cell_minute'] = 'Minute';
$lang['Cell_days'] = 'Jours';
$lang['Cell_hours'] = 'Heures';
$lang['Cell_minutes'] = 'Minutes';
$lang['Cell_caution'] = 'Il vous est possible de sortir de prison en payant une caution d\'un montant de ';
$lang['Cell_caution_pay'] = 'Payer la caution';
$lang['Cell_free'] = 'Vous êtes maintenant libéré de prison . Veillez à ne pas y retourner . <br /><br />Cliquez <a href="' . append_sid('admin_cell.'.$phpEx) . '">ici</a> pour aller sur l\'index du forum';

// Language keys added or modified for 0.1.0
$lang['Cell_celled_time'] = 'Durée de la peine';
$lang['Cell_judge_user'] = 'Juger ce membre';
$lang['Cell_judgement'] = 'Jugement';
$lang['Cell_freeable'] = 'Peut être libéré';
$lang['Cell_freeable_explain'] = 'Si vous cochez cette option , les autres membres pourront juger ce membre'; 
$lang['Cell_cautionnable'] = 'Possiblité de payer la caution par un tiers';
$lang['Cell_cautionnable_explain'] = 'Si vous cochez cette option , les autres membres pourront payer la caution de ceux emprisonnés';
$lang['Cell_admin_celled_users_explain'] = 'Vous pouvez éditer les membres emprisonnés en cliquant sur leur nom';
$lang['Cell_admin_celled_edited_ok'] = 'Ce membre a été édité avec succès';
$lang['Cell_selected_celled'] = 'Membre sélectionné :';
$lang['Cell_judgement_none'] = 'Aucun membre n\'est actuellement en prison';
$lang['Cell_celled_list'] = 'Voir l\'historique des emprisonnements';
$lang['Cell_celled_date'] = 'Date de la sentence';
$lang['Cell_freed_type'] = 'Libéré par';
$lang['Cell_judgement_never'] = 'Aucun membre n\'a été emprisonné à ce jour';
$lang['Cell_freed_type_still'] = 'Ce membre est toujours en prison';
$lang['Cell_freed_type_time'] = 'Echéance de la peine';
$lang['Cell_freed_type_admin'] = 'Jugement du tribunal';
$lang['Cell_celled_list_history'] = 'Historique';
$lang['Cell_imprisonments'] = 'Nombre d\'emprisonements';
$lang['Cell_admin_celled_blank'] = 'Effacer l\'historique de ce membre';
$lang['Cell_admin_celled_blank_explain'] = 'Si vous cochez cette option , l\'historique des emprisonnements de ce membre sera effacée';
$lang['Cell_admin_update_error'] = 'Erreut durant la mise à jour de la configuration générale de la prison';
$lang['Cell_updated_return_settings'] = 'La configuration générale de la prison a été mise à jour avec succès . <br /><br />Cliquez %sici%s pour retourner à la gestion de la prison'; 
$lang['Cell_settings_explain'] = 'Ici vous pouvez éditer les options générales du système de prison.';
$lang['Cell_settings_bars'] = 'Afficher l\'avatar des membres emprisonnés derrière des barreaux de prison';
$lang['Cell_settings_celleds'] = 'Afficher le nombre total d\'emprisonnements dans les messages et le profil des membres';
$lang['Cell_settings_caution'] = 'Autoriser les membres à payer les cautions des autres';
$lang['Cell_settings_judge'] = 'Autoriser les membres à juger les prisonniers';
$lang['Cell_settings_blank'] = 'Autoriser les membres à payer pour vider leur casier judiciaire';
$lang['Cell_settings_blank_sum'] = 'Montant à payer pour vider son casier judicaire';
$lang['Cell_judgement'] = 'Jugement';
$lang['Cell_judgement_pay_sledge'] = 'Payer la caution';
$lang['Cell_lack_money'] = 'Vous n\'avez pas assez de points pour effectuer cette action';
$lang['Cell_sledge_paid'] = 'La caution de ce membre a été payée avec succès';
$lang['Cell_return'] = 'Cliquez %sici%s pour retourner au tribunal';
$lang['Cell_settings_voters'] = 'Nombre minimal de votes pour qu\'un jugement soit validé'; 
$lang['Cell_settings_posts'] = 'Nombre minimal de messages qu\'un membre doit avoir posté pour avoir le droit de voter';
$lang['Cell_caution_not_authed'] = 'Ce membre ne peut pas être libéré par le paiement d\'une caution';
$lang['Cell_judgement_ever'] = 'Vous avez déjà jugé ce membre';
$lang['Cell_judgement_explain'] = 'Quel est votre verdict ?';
$lang['Cell_judgement_guilty'] = 'Coupable';
$lang['Cell_judgement_innocent'] = 'Innocent';
$lang['Cell_judgement_not_authed'] = 'Vous n\'êtes pas autorisé à juger ce membre';
$lang['Cell_judgement_done'] = 'Votre verdict a été enregistré avec succès';
$lang['Cell_blank_text'] = 'Vous pouvez effacer votre casier judiciaire si vous payez la somme de %s';
$lang['Cell_blank_explain'] = 'Effacer le casier judiciaire';
$lang['Cell_blank_done'] = 'Votre casier judiciaire est maintenant vierge';
$lang['Cell_judgement_ever_authed'] = 'Ce membre a été reconnu coupable par le tribunal';

// Language keys added or modified for 0.2.0
$lang['Cell_default_points_name'] = 'Points';
$lang['Cell_admin_punishment'] = 'Selectionnez les actions interdites pour ce membre :';
$lang['Cell_admin_punishment_global'] = 'Toutes';
$lang['Cell_admin_punishment_posts'] = 'Poster de nouveaux messages';
$lang['Cell_admin_punishment_read'] = 'Poster et lire des messages';
$lang['Cell_punishment'] = 'Punition';
$lang['Cell_punishment_global'] = 'Banni';
$lang['Cell_punishment_posts'] = 'Ne peut plus poster de messages';
$lang['Cell_punishment_read'] = 'Ne peut plus lire ou poster de messages';
$lang['Cell_time_explain_posts'] = 'Durant cette période vous n\'êtes pas autorisé à poster de nouveaux messages';
$lang['Cell_time_explain_read'] = 'Durant cette période vous n\'êtes pas autorisé à poster ou lire des messages';

?>
