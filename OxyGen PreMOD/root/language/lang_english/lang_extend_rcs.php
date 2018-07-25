<?php
/**
*
* @package rank_color_system_mod [English]
* @version $Id: lang_extend_rcs.php,v 0.10 21/12/2006 09:48 reddog Exp $
* @copyright (c) 2006 reddog - http://www.reddevboard.com/
* @license http://opensource.org/licenses/gpl-license.php GNU Public License 
*
*/

if ( !defined('IN_PHPBB') )
{
	die('Hacking attempt');
}

/**
* description
*/
$lang['mod_rcs_title'] = 'Rank Color System';
$lang['mod_rcs_explain'] = 'Allows to create and manage color ranks for groups and users which will be displayed on your whole board, and also adds several other features.';

/**
* admin part
*/
if ( $lang_extend_admin )
{
	// versions check
	$lang['Versions'] = 'Versions';
	$lang['versions_check'] = 'Versions check';
	$lang['versions_check_explain'] = 'Checks to see if the version of phpBB and other applications you are currently running are up to date.';
	$lang['version_information'] = 'Version Information';
	$lang['version_check'] = 'Check for latest versions';
	$lang['version_current_info'] = 'Version currently installed';
	$lang['version_stable_info'] = 'Latest stable version';
	$lang['version_not_stable'] = 'The version you are currently using is not up to date : please upgrade this application to at least the latest stable release.';
	$lang['version_stable'] = 'The version you are currently using is up to date with the latest stable release.';
	$lang['version_announcement'] = 'Please read the <a href="http://%s" target="_new">release announcement</a> for the latest version before you continue your update process, it may contain useful information.';
	$lang['version_socket_error'] = 'Unable to open connection to the server, reported error is:<br />%s';
	$lang['version_socket_disabled'] = 'Unable to use socket functions.';
	$lang['click_check_versions'] = '<p>Click %sHere%s to check if the version of phpBB and other applications you are currently running are up to date.</p>';

	// acp menu
	$lang['Color_Ranks'] = 'Color Ranks';
	$lang['rcs_a_settings'] = 'Settings';
	$lang['rcs_b_manage'] = 'Manage';

	// rcs settings part
	$lang['rcs_settings_title'] = 'Rank Color System Settings';
	$lang['rcs_settings_title_desc'] = 'Using this form you can manage Rank Color System settings.';
	$lang['rcs_style_settings'] = 'Style settings';
	$lang['rcs_cache_settings'] = 'Cache settings';
	$lang['rcs_main_settings'] = 'Main settings';

	$lang['rcs_enable'] = 'Enable rank color system';
	$lang['rcs_enable_desc'] = 'Display users and groups colors on the whole board.';
	$lang['rcs_ranks_stats'] = 'Color ranks';
	$lang['rcs_ranks_stats_desc'] = 'Display color ranks in the legend on the board index.';
	$lang['rcs_level_ranks'] = 'Level ranks';
	$lang['rcs_level_ranks_desc'] = 'Display level ranks in the legend on the board index.';
	$lang['rcs_level_admin'] = 'Administrator';
	$lang['rcs_level_mod'] = 'Moderator';

	$lang['rcs_select_style'] = 'Select style';
	$lang['rcs_admincolor'] = 'Administrator group colour';
	$lang['rcs_modcolor'] = 'Moderator group colour';
	$lang['rcs_usercolor'] = 'User group colour';

//-- mod : bot indexing mod ----------------------------------------------------
//-- add
	$lang['rcs_botcolor'] = 'Bots colour';
//-- fin mod : bot indexing mod ------------------------------------------------

	$lang['rcs_cache_regen'] = 'Regenerate the cache';
	$lang['rcs_cache_last_generation'] = 'Data last regeneration';
	$lang['rcs_cache'] = 'Enable rank color system cache';

	// rcs management part
	$lang['rcs_manage_title'] = 'Rank Color System Management';
	$lang['rcs_manage_title_desc'] = 'Here you can edit, delete, create and re-order color ranks.';
	$lang['rcs_add_title'] = 'Add a new color rank';
	$lang['rcs_add_title_desc'] = 'Here you can define the new color rank fields.';
	$lang['rcs_edit_title'] = 'Edit <span%s>%s</span> color rank';
	$lang['rcs_edit_title_desc'] = 'Here you can modify the fields of the selected color rank.';

	$lang['rcs_name'] = 'Rank name';
	$lang['rcs_name_desc'] = 'You can use a lang entry key (check your language/lang_<i>your_language</i>/lang_*.php), or enter directly the rank name.';
	$lang['rcs_color'] = 'Rank color';
	$lang['rcs_color_desc'] = 'Select a value from the color picker or enter manually it (without #). Leave blank to use a CSS class named like the rank.';
	$lang['rcs_single'] = 'Individual rank';
	$lang['rcs_single_desc'] = 'this rank could be only selected for users.';
	$lang['rcs_display'] = 'Display rank';
	$lang['rcs_display_desc'] = 'Display the rank on the board index.';
	$lang['rcs_move_after'] = 'Move this rank after';

	$lang['rcs_pick_color'] = 'Pick a color';

	// actions
	$lang['rcs_updated'] = 'The rank was successfully updated.';
	$lang['rcs_added'] = 'The rank was successfully added.';
	$lang['rcs_removed'] = 'The rank was successfully removed.';
	$lang['rcs_order_updated'] = 'Ranks order was successfully updated.';
	$lang['rcs_confirm_delete'] = 'Are you sure you want to delete this rank?';
	$lang['rcs_confirm_delete_selected'] = 'Are you sure you want to delete the selected ranks?';

	$lang['rcs_setup_updated'] = 'The rank color system setup has been updated.';
	$lang['rcs_cache_succeed'] = 'Rank color system cache succeed.';
	$lang['rcs_cache_failed'] = 'Rank color system cache failed. The cache has been disabled.';
	$lang['rcs_cache_disabled'] = 'The cache is disabled. Enable before regenerating it.';
	$lang['rcs_style_updated'] = 'Level groups colors succeed.';

	$lang['rcs_click_return'] = 'Click %sHere%s to return to the previous page.';
	$lang['rcs_click_return_settings'] = 'Click %sHere%s to return to the rank color system settings.';
	$lang['rcs_click_return_manage'] = 'Click %sHere%s to return to rank color system management.';

	// errors
	$lang['rcs_not_exists'] = 'This rank does not exist.';
	$lang['rcs_must_select'] = 'You must select a rank.';
	$lang['rcs_must_fill'] = 'You must fill all fields.';
	$lang['rcs_no_valid_action'] = 'The action you are trying to perform is not supported.';
	$lang['rcs_no_ranks_create'] = 'No ranks are available. Please hit "Create" to add some.';

	// groups and users edition
	$lang['Top'] = '___Top___';
	$lang['rcs_select_rank'] = 'Select Rank Color';
}

/**
* group control panel
*/

// usergroups selection
$lang['usergroups_list'] = 'Usergroups List';
$lang['select_usergroup'] = 'Select Usergroup';
$lang['select_usergroup_details'] = 'select an usergroup to view information of them.';

/**
* userlist
*/

// display
$lang['userlist'] = 'Userlist';
$lang['click_return_userlist'] = 'Click %sHere%s to return to the userlist.';
$lang['no_members_match'] = 'No members found for this search criteria';

// usergroups
$lang['groups'] = 'Usergroups';
$lang['group_is_open'] = 'This is an open group';
$lang['group_is_hidden'] = 'This is a hidden group';
$lang['group_is_closed'] = 'This is a closed group';

$lang['change_default_group'] = 'Change default group';
$lang['changed_default_group'] = 'Successfully changed default group for all selected members.';
$lang['already_default_group'] = 'This group is already the default group for all selected members.';
$lang['click_return_usergroup'] = 'Click %sHere%s to return to the usergroup.';

// leaders
$lang['the_team'] = 'The team';
$lang['moderate_forums'] = 'Moderate forums';
$lang['primary_group'] = 'Primary group';

$lang['all_forums'] = 'All forums';
$lang['forum_undisclosed'] = 'Moderating hidden forum(s)';
$lang['group_undisclosed'] = 'Hidden group';

$lang['Administrators'] = 'Administrators';
$lang['Moderators'] = 'Moderators';
$lang['no_administrators'] = 'No administrators assigned at this board.';
$lang['no_moderators'] = 'No moderators assigned at this board.';

// viewprofile
$lang['user_statistics'] = 'User statistics';

$lang['rcs_rank'] = 'Rank color';
$lang['post_pct_active'] = '%.2f%% of its posts';
$lang['active_in_forum'] = 'Most active forum';
$lang['active_in_topic'] = 'Most active topic';

$lang['change_individual_rank'] = 'Change individual rank';
$lang['changed_individual_rank'] = 'Successfully changed individual color rank for the selected user.';
$lang['removed_individual_rank'] = 'Successfully removed individual color rank for the selected user.';
$lang['click_return_viewprofile'] = 'Click %sHere%s to return to the user\'s profile.';

// count
$lang['users_count'] = '[%d Users]';
$lang['users_count_1'] = '[%d User]';
$lang['posts_count'] = '[%d Posts]';
$lang['posts_count_1'] = '[%d Post]';
$lang['user_posts'] = '%d Posts';
$lang['user_posts_1'] = '%d Post';

// visited
$lang['Visited'] = 'Last visited';
$lang['Hidden_last_visit'] = 'Hidden';
$lang['Never_last_visit'] = 'Never';

// errors
$lang['no_users_selected'] = 'You haven\'t selected any users.';
$lang['option_assigned_user'] = 'The selected option is already assigned to this user.';
$lang['not_admin_of_board'] = 'The requested operation cannot be taken because you are not an administrator on this board.';

/**
* legend
*/

// display
$lang['Legend'] = 'Legend';
$lang['Administrator'] = 'Administrator';
$lang['Moderator'] = 'Moderator';
$lang['User'] = 'User';

?>
