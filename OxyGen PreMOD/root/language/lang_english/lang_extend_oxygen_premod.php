<?php
/** 
*
* @package oxygen premodded board [english]
* @version $Id: lang_extend_oxygen_premod.php,v 1.1.0 2007/02/04 16:38 EzCom Exp $
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
	$lang['User_authorizations'] = 'Authorizations';
	$lang['Security_settings'] = 'Security';
	$lang['Suscribe_settings'] = 'Registrations';
	$lang['Time_settings'] = 'Time management';
	$lang['Messages_settings'] = 'Messages';
	$lang['Div_Settings'] = 'Miscellaneous';

	/**
	* Board Favicon
	*/
	$lang['Favicon_icon'] = 'Site favorite icon';
	$lang['Favicon_icon_explain'] = 'This icon is the one appearing in front of the site name of your browser bookmarks. It has to be a .ico file, 16x16 pixels.';

	/**
	* Instant MSG
	*/
	$lang['Instant_msg_enable'] = 'Allow the sending of instantaneous messages between members';
	$lang['Instant_msg_autoprune'] = 'Instantaneous messages automatic prune [hours]';
	$lang['Instant_msg_auto_refresh'] = 'New messages automatic check [seconds]';

	/**
	* Forum as Category
	*/
	$lang['forum_as_category'] = 'Consider this forum as being a subcategory';

	/**
	* Overall Forum Permissions
	*/
	$lang['Overall_Permissions'] = 'Interactive Permissions';
	$lang['Forum_auth_explain_overall'] = 'Here you can alter the authorisation levels of each forum. Remember that changing the permission level of forums will affect which users can carry out the various operations within them.';
	$lang['Forum_auth_explain_overall_edit'] = 'First click on the swatch in the key, then click on the forum swatch you want to change. Use <strong><em>Restore Original</em></strong> to undo changes. Use <strong><em>Stop Editing</em></strong> to turn off further editing.';
	$lang['Forum_auth_overall_restore'] = 'Restore Original';
	$lang['Forum_auth_overall_stop'] = 'Stop Editing';

	/**
	* Access Limitation
	*/
	$lang['Restriction_Settings'] = 'Restrictions';
	$lang['All'] = 'Everyone';
	$lang['Reg'] = 'Registered Users';
	$lang['Mod'] = 'Moderators';
	$lang['Memberlist_access'] = 'Who can access the <i>Memberlist</i> ?';
	$lang['Faq_access'] = 'Who can access the <i>FAQ</i> ?';
	$lang['Cell_access'] = 'Who can access the <i>Courthouse</i> ?';
	$lang['Groups_access'] = 'Who can access the <i>Usergroups</i> ?';
	$lang['Search_access'] = 'Who can access the <i>Search</i> ?';
	$lang['Profile_access'] = 'Who can access the <i>Profiles</i> ?';
	$lang['Shoutbox_access'] = 'Who can access <i>MiniChat</i> ?';
	$lang['Viewonline_access'] = 'Who can access the <i>Who is Online</i> ?';

	/**
	* Hide Profile Options
	*/
	$lang['Hide_Elements'] = 'Profile Admin';
	$lang['Hide_Entries_Config'] = 'Profile Admin';
	$lang['Hide_Entries_explain'] = 'The form below will allow you to customize all the profile options';
	$lang['Account_Informations'] = 'These authorizations are individual.<br />You must activ them via the profile editor of the concerned user.';
	$lang['Click_return_profile_config'] = 'Click %sHere%s to return to the profile administration';
	$lang['override_user_icq'] = 'Hide the field <em>' . $lang['ICQ'] . '</em>';
	$lang['override_user_aim'] = 'Hide the field <em>' . $lang['AIM'] . '</em>';
	$lang['override_user_msn'] = 'Hide the field <em>' . $lang['MSNM'] . '</em>';
	$lang['override_user_skype'] = 'Hide the field <em>' . $lang['SKYPE'] . '</em>';
	$lang['override_user_yahoo'] = 'Hide the field <em>' . $lang['YIM'] . '</em>';
	$lang['override_user_website'] = 'Hide the field <em>' . $lang['Website'] . '</em>';
	$lang['override_user_location'] = 'Hide the field <em>' . $lang['Location'] . '</em>';
	$lang['override_user_occupation'] = 'Hide the field <em>' . $lang['Occupation'] . '</em>';
	$lang['override_user_interests'] = 'Hide the field <em>' . $lang['Interests'] . '</em>';
	$lang['override_user_birthday'] = 'Hide the combo boxes <em>' . $lang['bday_birthdate'] . '</em>';
	$lang['override_user_gender'] = 'Hide the switches <em>' . $lang['Gender'] . '</em>';
	$lang['override_user_signature'] = 'Hide the Signature Editor';
	$lang['override_user_quick_post'] = 'Hide the <em>Quick Reply Settings</em>';
	$lang['override_user_public_view_mail'] = 'Hide the switches <em>' . $lang['Public_view_email'] . '</em>';
	$lang['override_user_hide_online'] = 'Hide the switches <em>' . $lang['Hide_user'] . '</em>';
	$lang['override_user_notify_on_reply'] = 'Hide the switches <em>' . $lang['Always_notify'] . '</em>';
	$lang['override_user_notify_pm'] = 'Hide the switches <em>' . $lang['Notify_on_privmsg'] . '</em>';
	$lang['override_user_popup_pm'] = 'Hide the switches <em>' . $lang['Popup_on_privmsg'] . '</em>';
	$lang['override_user_notify_on_donation'] = 'Hide the switches <em>' . $lang['Points_notify'] . '</em>';
	$lang['override_user_always_add_signature'] = 'Hide the switches <em>' . $lang['Always_add_sig'] . '</em>';
	$lang['override_user_bbcode'] = 'Hide the switches <em>' . $lang['Always_bbcode'] . '</em>';
	$lang['override_user_html'] = 'Hide the switches <em>' . $lang['Always_html'] . '</em>';
	$lang['override_user_smilies'] = 'Hide the switches <em>' . $lang['Always_smile'] . '</em>';
	$lang['override_user_language'] = 'Hide the combo box <em>' . $lang['Board_lang'] . '</em>';
	$lang['override_user_board_style'] = 'Hide the combo box <em>' . $lang['Board_style'] . '</em>';
	$lang['override_user_time_mode'] = 'Hide the combo box <em>' . $lang['Timezone'] . '</em>';
	$lang['override_user_date_format'] = 'Hide the combo box <em>' . $lang['Date_format'] . '</em>';
	$lang['override_user_posts_per_page'] = 'Hide the field <em>' . $lang['Posts_per_page'] . '</em>';
	$lang['override_user_topics_per_page'] = 'Hide the field <em>' . $lang['Topics_per_page'] . '</em>';

	/**
	* Disallow Editing/Deleting Administrator Posts
	*/
	$lang['Disallow_Edition_Deleting_Admin_Messages'] = 'Allow the moderators to modify/to delete the messages emitted by the administrators';

	/**
	* MiniChat
	*/
	$lang['Shoutbox_Settings'] = 'MiniChat';
	$lang['shoutbox_on'] = 'MiniChat On';
	$lang['date_on'] = 'Show date';
	$lang['sb_make_links'] = 'Make links';
	$lang['sb_links_names'] = 'Username link to profile';
	$lang['sb_allow_edit'] = 'Allow administrators and moderators to edit messages';
	$lang['sb_allow_edit_all'] = 'Allow to edit own messages';
	$lang['sb_allow_delete'] = 'Allow administrators and moderators to delete messages';
	$lang['sb_allow_delete_all'] = 'Allow to delete own messages';
	$lang['sb_allow_guest'] = 'Allow the guests to send messages in MiniChat';
	$lang['sb_allow_guest_view'] = 'Allow the guests to see MiniChat';
	$lang['delete_days'] = 'Amount of days after messages will be deleted';
	$lang['sb_text_lenght'] = 'Max messages letters';
	$lang['sb_word_lenght'] = 'Max word letters';
	$lang['shout_size'] = 'MiniChat size';
	$lang['sb_banned_user_send'] = 'Disallow send messages for user';
	$lang['sb_banned_user_send_e'] = 'User IDs of users who can\'t send messages to MiniChat. Separate multiple user IDs with commas, for example: <strong>18, 124</strong>';
	$lang['sb_banned_user_view'] = 'Disallow MiniChat for user';
	$lang['sb_banned_user_view_e'] = 'User IDs of users who can\'t view and use MiniChat. Separate multiple user IDs with commas, for example: <strong>18, 124</strong>';
	$lang['sb_refresh_time'] = 'MiniChat automatic refresh time (in seconds)';
	$lang['sb_messages_number_on_index'] = 'Displayed messages number in MiniChat on the forum index';

	/**
	* Split Topic Type
	*/
	$lang['split_global_announce'] = 'Split global announcement';
	$lang['split_announce']	= 'Split announcement';
	$lang['split_sticky']	= 'Split sticky';
	$lang['split_topic_split'] = 'Seperate topic types in different boxes';

	/**
	* Admin Userlist
	*/
	$lang['Userlist'] = 'User list';
	$lang['Userlist_description'] = 'View a complete list of your users and perform various actions on them';
	$lang['Add_group'] = 'Add to a Group';
	$lang['Add_group_explain'] = 'Select which group to add the selected users to';
	$lang['Open_close'] = 'Open/Close';
	$lang['Active'] = 'Active';
	$lang['Group'] = 'Group(s)';
	$lang['Rank'] = 'Rank';
	$lang['Last_activity'] = 'Last Activity';
	$lang['Never'] = 'Never';
	$lang['User_manage'] = 'Manage';
	$lang['Find_all_posts'] = 'Find All Posts';
	$lang['Select_one'] = 'Select One';
	$lang['Ban'] = 'Ban';
	$lang['Is_Banned'] = 'Banned!'; 
	$lang['UnBan'] = 'Un-Ban';
	$lang['Activate_deactivate'] = 'Activate/De-activate';
	$lang['Select_All'] = 'Select All';
	$lang['Deselect_All'] = 'Deselect All';
	$lang['User_id'] = 'User id';
	$lang['User_level'] = 'User Level';
	$lang['Ascending'] = 'Ascending';
	$lang['Descending'] = 'Descending';
	$lang['Show'] = 'Show';
	$lang['All'] = 'All';
	$lang['Member'] = 'Member';
	$lang['Pending'] = 'Pending';
	$lang['Confirm_user_ban'] = 'Are you sure you want to ban the selected user(s)?';
	$lang['Confirm_user_un_ban'] = 'Are you sure you want to unban the selected user(s)?';
	$lang['Confirm_user_deleted'] = 'Are you sure you want to delete the selected user(s)?';
	$lang['User_status_updated'] = 'User(s) status updated successfully!';
	$lang['User_banned_successfully'] = 'User(s) banned successfully!';
	$lang['User_un_banned_successfully'] = 'User(s) unbanned successfully!';
	$lang['User_deleted_successfully'] = 'User(s) deleted successfully!';
	$lang['User_add_group_successfully'] = 'User(s) added to group successfully!';
	$lang['Click_return_userlist'] = 'Click %shere%s to return to the User List';

	/**
	* Log IP Address On Registration
	*/
	$lang['Registration_IP'] = 'Registration IP Address';

	/**
	* Main Admin Security
	*/
	$lang['Main_Admin_Undeleted'] = 'Main Admin can\'t be deleted !';
	$lang['Main_Admin_Unchanged_Profile'] = 'You can\'t modify Main Admin\'s profile !';
	$lang['Main_Admin_Unchanged_Level'] = 'Main Admin can\'t become a simple user !';

	/**
	* Quick Administrator User Options and Informations
	*/
	$lang['Click_return_userprofile'] = 'Click %sHere%s to return to the user\'s profile';

	/**
	* Block The Index to The Guests
	*/
	$lang['No_Guest_on_Index'] = 'Allow the guests to go on the Board Index';

	/**
	* Forum Meta Tags
	*/
	$lang['Meta_Tags'] = 'Forum Meta Tags';
	$lang['Meta_Tags_Explain'] = 'Use the below to add meta tags to all of your forum pages. Meta tags are used by search engines. You can learn more about meta tags <a target="_blank" href="http://searchenginewatch.com/webmasters/article.php/2167931">here</a>.';
	$lang['Meta_Language'] = 'Board Language:';
	$lang['Meta_Language_Explain'] = 'Your board\'s language. To learn more, and supported languages click <a target="_blank" href="http://www.submitcorner.com/Guide/Meta/language.shtml">here</a>.';
	$lang['Meta_Author'] = 'Author:';
	$lang['Meta_Author_Explain'] = 'Author of the document being read (your forum). To learn more click <a target="_blank" href="http://www.submitcorner.com/Guide/Meta/author.shtml">here</a>.';
	$lang['Meta_Description'] = 'Description:';
	$lang['Meta_Description_Explain'] = 'Description of your site/forum.';
	$lang['Meta_Keywords'] = 'Keywords:';
	$lang['Meta_Keywords_Explain'] = 'Forum/site keywords. Seperate with a comma.';
	$lang['Meta_Robots'] = 'Robots:';
	$lang['Meta_Robots_Explain'] = 'Tells the robots what to do. Example: index, follow. Possible entries are: index, follow; index, nofollow; noindex, nofollow; noindex, follow. (without ; of course) You can visit this <a target="_blank" href="http://www.searchengineworld.com/metatag/robots.htm">link</a> to learn more.';
	$lang['Meta_Rating'] = 'Rating:';
	$lang['Meta_Rating_Explain'] = 'Tells the SEs your forum/site rating. Example: General. Possible entries are: General, Safe For Kids, 14 years, Mature, or Restricted.';
	$lang['Meta_Visit_After'] = 'Re-visit after:';
	$lang['Meta_Visit_After_Explain'] = 'Tells the robot when to re-visit your site/forum. In days. Possible entries are: 2 days, 7 days, 15 days, 30 days, or 60 days.';

	/**
	* User Post Count Editor
	*/
	$lang['Set_posts'] = 'User Posts';

	/**
	* Boulet
	*/
	$lang['user_boulet_title'] = 'Naab status';
	$lang['user_boulet_type_0'] = '- Is not a naab -';
	$lang['user_boulet_type_1'] = 'Is a naab to redirect to :';
	$lang['user_boulet_type_2'] = 'Is a naab who will read the post :';
	$lang['user_boulet_type_3'] = 'Is a naab who will read in a blank page the post :';

	/**
	* Disallow Mail and Password Changes
	*/
	$lang['Allow_mail_change'] = 'Allow E-mail changes';
	$lang['Allow_password_change'] = 'Allow Password changes';

	/**
	* Annonce Globale
	*/
	$lang['Annonce_Globale_Index'] = 'Display global announcement on the Index';

	/**
	* Smiley Categories
	*/
	$lang['Smiley_Config'] = 'Smiley Configuration';
	$lang['Smiley_table_columns'] = 'Smiley Table Columns';
	$lang['Smiley_table_rows'] = 'Smiley Table Rows';
	$lang['Smiley_posting'] = 'On posting page, show categories in the form of...';
	$lang['Smiley_popup'] = 'On popup window, show categories in the form of...';
	$lang['smiley_nothing'] = 'Nothing';
	$lang['Smiley_button'] = 'Buttons';
	$lang['Smiley_dropdown'] = 'Dropdown Menu';
	$lang['Smiley_buttons'] = 'When displaying buttons, use the following';
	$lang['Smiley_buttons_icon'] = 'Icon';
	$lang['Smiley_buttons_name'] = 'Name';
	$lang['Smiley_buttons_number'] = 'Number';
	$lang['Smilies_icon_path'] = 'Smilies Icon Storage Path';
	$lang['Smilies_icon_path_explain'] = 'Path under your phpBB root dir, e.g. images/smiles';

	/**
	* Limit Smilies Per Post
	*/
	$lang['Max_smilies'] = 'Maximum smilies limit per post';

	/**
	* Forum Icon With ACP Control
	*/
	$lang['Forum_icon'] = 'Forum icon';
	$lang['Forum_icon_path'] = 'Forum Icon Storage Path';
	$lang['Forum_icon_path_explain'] = 'Path under your phpBB root dir, e.g. images/forum_icons';

	/**
	* Categories Hierarchy
	*/
	$lang['Last_topic_title_length'] = 'Title length of the last topic on index';
	$lang['Last_topic_title_length_explain'] = 'Set the number of chars you want to display for the last topic title on index to prevent the layer to be screw with too long titles. Set it to 0 if you don\'t want to cut the titles.';

	/**
	* Colorize Forumtitle
	*/
	$lang['Forum_color'] = 'Set a color for the forum title';
	$lang['Forum_color_explain'] = 'Leave this field blank to use the default color. Just enter the color number without leading \'#\'!';

	/**
	* Disable Word Censor For Single Forums
	*/
	$lang['Disable_word_censor'] = 'Disable word censors on this forum';

	/**
	* Rank Image Display
	*/
	$lang['Rank_img'] = 'Rank Image';

	/**
	* Inactive Users
	*/
	$lang['Users_Inactive'] = 'Inactive Users';
	$lang['Users_Inactive_Explain'] = 'If in "Enable account activation" you have selected "User" or "Admin", in this list you will have the Users who have never been activated.<br /><br />By clicking on "Contact" you will send a contact e-mail to all the selected Users.<br />By clicking on "Activate" you will activate all the selected Users.<br />By clicking on "Delete" you will send an e-mail and delete all the selected Users.';
	$lang['UI_Check_None'] = '"Enable account activation" is on <b>None</b>.';
	$lang['UI_Check_User'] = '"Enable account activation" is on <b>User</b>';
	$lang['UI_Check_Admin'] = '"Enable account activation" is on <b>Admin</b>.';
	$lang['UI_Check_Recom'] = '%sChange it%s.';
	$lang['UI_Removed_Users'] = 'Removed Users';
	$lang['UI_User'] = 'User';
	$lang['UI_Registration_Date'] = 'Registration Date';
	$lang['UI_Last_Visit'] = 'Last Visit';
	$lang['UI_Active'] = 'Active';
	$lang['UI_Email_Sents'] = 'Email Sents';
	$lang['UI_Last_Email_Sents'] = 'Last Email';
	$lang['UI_CheckColor'] = 'Check';
	$lang['UI_CheckAll'] = 'Check All';
	$lang['UI_UncheckAll'] = 'Uncheck All';
	$lang['UI_InvertChecked'] = 'Invert Checked';
	$lang['UI_Contact_Users'] = 'Contact';
	$lang['UI_Delete_Users'] = 'Delete';
	$lang['UI_Activate_Users'] = 'Activate';
	$lang['UI_select_user_first'] = 'You must to select a User before';
	$lang['UI_return'] = 'Click %sHere%s to return to the Inactive Users';
	$lang['UI_Deleted_Users'] = 'The Users has been removed';
	$lang['UI_Activated_Users'] = 'The Users has been actived';
	$lang['UI_Alert_Days'] = 'days';
	$lang['UI_with_zero_messages'] = 'with zero messages';
	$lang['UI_Alert_Every'] = 'Every';
	$lang['UI_Alert_UpTo'] = 'Up to';
	$lang['UI_Alert_Over'] = 'Over';

	/**
	* Jail MOD
	*/
	$lang['Jail'] = 'Jail';
	$lang['Jail_settings'] = 'General settings';

	/**
	* Online Offline Hidden
	*/
	$lang['Online_time'] = 'Online status time';
	$lang['Online_time_explain'] = 'Number of seconds a user must be displayed online (do not use lower value than 60).';
	$lang['Online_setting'] = 'Online Status Setting';
	$lang['Online_color'] = 'Online text color';
	$lang['Offline_color'] = 'Offline text color';
	$lang['Hidden_color'] = 'Hidden text color';
	$lang['xs_data_online_color'] = $lang['Online_color'];
	$lang['xs_data_offline_color'] = $lang['Offline_color'];
	$lang['xs_data_hidden_color'] = $lang['Hidden_color'];

	/**
	* Move Forum Logo Settings To ...
	*/
	$lang['Theme_logo'] = 'Forum logo path';
	$lang['Theme_logo_explain'] = 'The path where your theme-specific forum logo graphic is located relative to the domain name.';

	/**
	* Disable Board Message
	*/
	$lang['Board_disable_caption'] = 'Disabled board caption';
	$lang['Board_disable_text'] = 'Disabled board message';

	/**
	* Disable Registration
	*/
	$lang['disable_registration_status'] = 'Disable registrations';
	$lang['disable_registration_status_explain'] = 'This will disable all new registrations to your board.';
	$lang['registration_closed'] = 'Reason of closed registrations';
	$lang['registration_closed_explain'] = 'Text that explain why are the registrations closed, that would appear if a user try to register. Leave blank to show default explanation text.';

	/**
	* Disable Registration
	*/
	$lang['pm_allow_threshold'] = 'Allow PM threshold';
	$lang['pm_allow_threshold_explain'] = 'Set here the minimal amount of posts the user has to write before being able to use the private messages.';

	/**
	* Restrict Account to IP
	*/
	$lang['iprange'] = 'IP Range';
	$lang['restrictip'] = 'Restrict to IP';
	$lang['about_restrictip'] = 'Restrict Account To IP';
	$lang['about_range'] = 'Enter the following formats seperated by a comma:<ul><li>Single IP</li><li>Subnet: 192.168.1</li><li>Range: 192.167.0.0-192.168.8.1</li></ul>';

	/**
	* Double Post Merge
	*/
	$lang['Join_Interval'] = 'Join messages in: (hours)';
	$lang['Join_Interval_explain'] = 'Join messages of the same poster if interval between them is less than this quantity in hours';

	/**
	* BBCode Box Reloaded
	*/
	$lang['BBcode_Box'] = 'BBcode Box';
	$lang['bbc_box_a_settings'] = 'Settings';
	$lang['bbc_box_b_list'] = 'BBcode list';
	$lang['bbc_box_c_manage'] = 'Manage';

	/**
	* Forumtitle as Weblink
	*/
	$lang['Forum_is_link'] = 'Change the forumtitle in a weblink';
	$lang['Forum_weblink'] = 'Weblink (inclusive http://)';
	$lang['Forum_link_target'] = 'Link open a new window';

	/**
	* Maxi Simple Subforums
	*/
	$lang['Max_subforums'] = 'Subforums Total';
	$lang['Max_subforums_explain'] = 'Maximum number of Subforums to display on index';

	/**
	* Password Protected Forums
	*/
	$lang['Forum_password'] = 'Forum password';

	/**
	* Recycle Bin Hack
	*/
	$lang['Bin_forum'] = 'Bin forum';
	$lang['Bin_forum_explain'] = 'Fill with the forum ID where topics moved to bin, a value of 0 will disable this feature. You should edit this forum permissions to allow or not view/post/reply... by users or forbid access to this forum.';

	/**
	* Resize Posted Images Based on Max Width
	*/
	$lang['Images_max_size'] = 'Seize the maximum size in pixels<br />Any image exceeding this value will be automatically reduced.';

	/**
	* Force Guests to Enter Their Usernames
	*/
	$lang['guests_need_name'] = 'Force guests to fill in their username in every posting';

	/**
	* Points System
	*/
	$lang['Points_Configuration'] = 'Points System';
	$lang['Points_enable_post']= 'Earn %s by posting';
	$lang['Points_enable_browse'] = 'Earn %s by browsing';
	$lang['Points_enable_donation'] = 'Enable Donation';
	$lang['Points_name'] = 'Points Name';
	$lang['Points_per_reply'] = 'Points Per Reply';
	$lang['Points_per_topic'] = 'Points Per New Topic';
	$lang['Points_per_page'] = 'Points Per Page';
	$lang['Points_user_group_auth'] = 'Authorized Groups';
	$lang['Points_enable_post_explain']	= 'Let users earn %s by posting new topics and replies';
	$lang['Points_enable_browse_explain']		= 'Let users earn %s by browsing the forums';
	$lang['Points_enable_donation_explain']	= 'Let users donate %s to their friends';
	$lang['Points_name_explain'] = 'Whatever you call your points on your board e.g. (money, gil, gold)';
	$lang['Points_per_reply_explain'] = 'The amount of %s they earn per reply';
	$lang['Points_per_topic_explain'] = 'The amount of %s they earn per new topic';
	$lang['Points_per_page_explain'] = 'The amount of %s they earn for each page they view';
	$lang['Points_user_group_auth_explain'] = 'Enter ids of groups who are authorized to access the points control panel, one id per line.';
	$lang['Points_reset'] = 'Reset everyone\'s Points';
	$lang['Points_reset_explain'] = 'Input a number and submit. Everyone\'s points will become the number you entered.';
	$lang['Points_disabled'] = 'Disable %s';
	$lang['Allow_Points'] = 'Use the Points System?';

	/**
	* Gender
	*/
	$lang['Gender_required'] = 'Force users to submit their gender';

	/**
	* Presentation
	*/
	$lang['present_required'] = 'Oblige the members to appear';
	$lang['present_forum'] = 'Presentation forum ID';
	$lang['present_explain'] = 'The ID is situated after <em>f=</em> in the link of the concerned forum.';

	/**
	* Account Self-Delete
	*/
	$lang['account_delete'] = 'Allows users to delete their own accounts';
	$lang['Allow_account_delete'] = 'Allow this user to delete his own account';

	/**
	* Admin Voting
	*/
	$lang['Admin_Vote_Title'] = 'Poll Administration';
	$lang['Admin_Vote_Explain'] = 'Poll Results (who voted and how they voted).';
	$lang['Vote_id'] = '#';
	$lang['Poll_topic'] = 'Poll Topic';
	$lang['Vote_username'] = 'Voter(s)';
	$lang['Vote_end_date'] = 'Vote Duration';
	$lang['Sort_vote_id'] = 'Poll Number';
	$lang['Sort_poll_topic'] = 'Poll Topic';
	$lang['Sort_vote_start'] = 'Start Date';
	$lang['Submit'] = 'Submit';
	$lang['Select_sort_field'] = 'Select sort field';
	$lang['Sort_order'] = 'Order';
	$lang['Sort_ascending'] = 'Ascending';
	$lang['Sort_descending'] = 'Descending';

	/**
	* Configure Member Profile Required Fields
	*/
	$lang['user_field_required'] = 'Force the members to fill this field';

	/**
	* Seperate PM Limits for Admins and Mods
	*/
	$lang['Administrator_Inbox_limits'] = 'Max posts in Administrator Inbox';
	$lang['Administrator_Sentbox_limits'] = 'Max posts in Administrator SentBox';
	$lang['Administrator_Savebox_limits'] = 'Max posts in Administrator Savebox';
	$lang['Moderator_Inbox_limits'] = 'Max posts in Moderator Inbox';
	$lang['Moderator_Sentbox_limits'] = 'Max posts in Moderator Sentbox';
	$lang['Moderator_Savebox_limits'] = 'Max posts in Moderator Savebox';
	$lang['Inbox_limits'] = 'Max posts in Members Inbox';
	$lang['Sentbox_limits'] = 'Max posts in Members Sentbox';
	$lang['Savebox_limits'] = 'Max posts in Members Savebox';
	$lang['Trashbox_limits'] = 'Max posts in Members Trashbox';
	$lang['Administrator_Trashbox_limits'] = 'Max posts in Administrator Trashbox';
	$lang['Moderator_Trashbox_limits'] = 'Max posts in Moderator Trashbox';

	/**
	* Mini Card
	*/
	$lang['card_warn_level'] = 'Maximum of yellow cards which can be assigned to a user';

	/**
	* Simple Subtemplates
	*/
	$lang['Subtemplate'] = 'Set a template to display for this forum';

	/**
	* Welcome Private Message
	*/
	$lang['wpm'] = 'Welcome private message';
	$lang['wpm_active'] = 'Send a welcome private message at the registration';
	$lang['wpm_name'] = 'Send by:';
	$lang['wpm_subject'] = 'Subject:';
	$lang['wpm_message'] = 'Message:';
}

/**
* OxyGen PreMOD
*/
$lang['OxyGen_PreMOD'] = '<a href="http://www.ezcom-fr.com/" target="_blank" class="copyright" alt="EzCom Community" title="EzCom Community">OxyGen PreMOD</a> %s';

/**
* Instant MSG
*/
$lang['Send_instant_msg_to'] = 'Send a flash message to %s';
$lang['Send_instant_msg'] = 'Send';
$lang['Reply_instant_msg'] = 'Reply';
$lang['Instant_msg_recommence'] = 'Begin again';
$lang['Instant_msg_quit'] = 'Quit';
$lang['You_send_a_message_to'] = 'Send a message to %s';
$lang['Your_message'] = 'Your message';
$lang['Instant_msg_error_reg_message'] = 'Error in the recording of the message';
$lang['Instant_msg_message_send'] = 'Sent message';
$lang['Instant_msg_empty_message'] = 'Your message is empty';
$lang['Instant_msg_no_action'] = 'No action';
$lang['Instant_msg_send_message'] = 'Send message';
$lang['Instant_msg_erased_message'] = 'Erased message';
$lang['Instant_msg_received_message'] = 'Successful message';

/**
* vBulletin Who Is Online
*/
$lang['Who_was_Online'] = 'Who was Online ?';
$lang['Statistics'] = 'Board Statistics';

/**
* Board Generation Time Info
*/
$lang['Gzip_on'] = 'GZIP on - ';
$lang['Debug_on'] = 'Debug on';
$lang['Debug_off'] = 'Debug off';
$lang['Queries'] = 'Queries: %s';
$lang['Generation_time'] = 'Time: %s seconds';

/**
* Topics A User Has Started
*/
$lang['Posted_topics_zero_total'] = ' in <b>0</b> topics';
$lang['Posted_topics_total'] = ' in <b>%d</b> topics';
$lang['Posted_topic_total'] = ' in <b>%d</b> topic';
$lang['Topics_Started'] = 'Topics started';
$lang['Search_user_topics'] = 'Find all topics started by %s';
$lang['User_topic_pct_stats'] = '%.2f%% of total';
$lang['User_topic_day_stats'] = '%.2f topics per day';
$lang['Sort_Topics'] = 'Total topics';
$lang['Search_your_topics'] = 'View your topics';

/**
* Quick Administrator User Options and Informations
*/
$lang['Quick_admin_options'] = 'Quick Administrator Options';
$lang['Admin_edit_profile'] = 'Edit %s Profile';
$lang['Admin_edit_permissions'] = 'Edit %s Permissions';
$lang['User_active'] = '%s <b>is</b> active';
$lang['User_not_active'] = '%s <b>is not</b> active';
$lang['Username_banned'] = '%s <b>is</b> banned';
$lang['Username_not_banned'] = '%s <b>is not</b> banned';
$lang['User_email_banned'] = '%s\'s email (%s) <b>is</b> banned';
$lang['User_email_not_banned'] = '%s\'s email <b>is not</b> banned';

/**
* Sort Memberlist Per Letter
*/
$lang['Sort_per_letter'] = 'Show only usernames starting with';
$lang['Others'] = 'others';
$lang['All'] = 'all';

/**
* Topics Nav Buttons
*/
$lang['View_previous_post'] = 'View previous post';
$lang['View_next_post'] = 'View next post';
$lang['Go_to_bottom'] = 'Go to bottom';

/**
* Bottom Tabs
*/
$lang['bt_title'] = 'Informations';
$lang['bt_perms'] = 'Forums Permissions';
$lang['bt_icons'] = 'Topics Icons';
$lang['bt_showhide_alt'] = 'show or hide informations';

/**
* Disallow Mail and Password Changes
*/
$lang['mail_explain'] = 'If you want to change your e-mail address, make by the demand with the administrator.';
$lang['password_explain'] = 'If you want to change your password, make by the demand with the administrator.';

/**
* Annonce Globale
*/
$lang['Global_Announce'] = 'Global Announce';
$lang['Topic_Global_Announcement'] = '<strong>Global Announce : </strong>';
$lang['Post_Global_Announcement'] = 'Global Announce';
$lang['Post_Global_Announcements'] = 'Global Announces';
$lang['Post_Announcement'] = 'Announce';

/**
* Smiley Categories
*/
$lang['smiley_categories'] = 'Smiley Categories';
$lang['no_smilies'] = 'Sorry, no smilies :(';
$lang['smiley_help'] = 'Select the category that you wish to have appear in the popup window.';

/**
* Limit Smilies Per Post
*/
$lang['Max_smilies_per_post'] = 'You can only use maximum %s smilies per post.<br />You have %s smilies too much in use.';

/**
* Online Offline Hidden
*/
$lang['Online'] = 'Online';
$lang['Offline'] = 'Offline';
$lang['Hidden'] = 'Hidden';
$lang['is_online'] = '%s is online now';
$lang['is_offline'] = '%s is offline';
$lang['is_hidden'] = '%s is hidden';
$lang['Online_status'] = 'Status';

/**
* Disable Registration
*/
$lang['registration_status'] = 'Sorry, but registrations on this board are currently closed. Please try again later.';

/**
* Keep Unread Flags
*/
$lang['Search_new'] = 'View unread posts';
$lang['keep_post_unread_explain'] = 'Mark post as unread';
$lang['keep_unread_done'] = 'The post has been marked as unread.';
$lang['View_unread_posts'] = 'View unread posts';
$lang['No_unread_posts'] = 'You have no unread posts';

/**
* Simple Subforums
*/
$lang['Subforums'] = 'Subforums';

/**
* Double Post Merge
*/
$lang['Added_after'] = 'Added after';
$lang['dpm_hours'] = ' %s hours';
$lang['dpm_minutes'] = ' %s minutes';
$lang['dpm_seconds'] = ' %s seconds';
$lang['dpm_hour'] = ' 1 hour';
$lang['dpm_minute'] = ' 1 minute';
$lang['dpm_second'] = ' 1 second';

/**
* BBCode Box Reloaded
*/
$lang['bbcbxr_spoil'] = 'Spoiler';
$lang['bbcbxr_show'] = 'show';
$lang['bbcbxr_hide'] = 'hide';
$lang['bbcbxr_expand'] = 'Expand';
$lang['bbcbxr_expand_more'] = 'Expand more';
$lang['bbcbxr_contract'] = 'Contract';
$lang['bbcbxr_select'] = 'Select all';
$lang['Thumbnails_alt'] = 'Posted Image, reduced in size. If no image is visible the server is dead or non-remote linkable';
$lang['Thumbnails_title'] = 'Click to view full-size';
$lang['PHPCode'] = 'PHP';
$lang['youtube_link'] = 'Link';

/**
* Forumtitle as Weblink
*/
$lang['Forum_link_count'] = 'Link was visited %s times.';
$lang['Forum_is_a_link'] = 'Link';

/**
* Invision View Profile
*/
$lang['Invision_Active_Stats'] = 'Active Stats';
$lang['Invision_Communicate'] = 'Communicate';
$lang['Invision_Info'] = 'Information';
$lang['Invision_Member_Group'] = 'Member Group';
$lang['Invision_Member_Title'] = 'Member Title';
$lang['Invision_Most_Active'] = 'Most Active In';
$lang['Invision_Most_Active_Posts'] = '%s posts in this forum';
$lang['Invision_Details'] = 'Posting Details';
$lang['Invision_PPD_Stats'] = 'Posts Per Day';
$lang['Invision_Signature'] = 'Signature';
$lang['Invision_Website'] = 'Home Page';
$lang['Invision_Total_Posts'] = 'Total Cumulative Posts';
$lang['Invision_User_post_pct_stats'] = '( %.2f%% of total forum posts )';
$lang['Invision_User_post_day_stats'] = '%.2f posts per day';
$lang['Invision_Search_user_posts'] = 'Find all posts by this member';
$lang['Invision_Posting_details'] = 'Posting Details';
$lang['Invision_Empty_field'] = '<em>No Information</em>';

/**
* Inspired of Categories Hierarchy
*/
$lang['Topic_Poll'] = 'Poll';

/**
* vAgreement Terms
*/
$lang['Reg_agreement'] = '<font class="gen"><b>Message Reviews</b></font><br />While the administrators and moderators of this forum will attempt to remove or edit any generally objectionable material as quickly as possible, it is impossible to review every message. Therefore you acknowledge that all posts made to these forums express the views and opinions of the author and not the administrators, moderators or webmaster (except for posts by these people) and hence will not be held liable.<br /><br /><font class="gen"><b>Posting Regulations</b></font><br />You agree not to post any abusive, obscene, vulgar, slanderous, hateful, threatening, sexually-oriented or any other material that may violate any applicable laws. Doing so may lead to you being immediately and permanently banned (and your service provider being informed). The IP address of all posts is recorded to aid in enforcing these conditions. You agree that the webmaster, administrator and moderators of this forum have the right to remove, edit, move or close any topic at any time should they see fit. As a user you agree to any information you have entered above being stored in a database. While this information will not be disclosed to any third party without your consent the webmaster, administrator and moderators cannot be held responsible for any hacking attempt that may lead to the data being compromised.<br /><br /><font class="gen"><b>Collected Info and Cookies</b></font><br />This forum system uses cookies to store information on your local computer. These cookies do not contain any of the information you have entered above; they serve only to improve your viewing pleasure. The e-mail address is used only for confirming your registration details and password (and for sending new passwords should you forget your current one).<br /><br /><font class="gen"><b>You Agree...</b></font><br />By clicking Register below you agree to be bound by these conditions.';
$lang['To_Join'] = 'To join, you must read and agree to the terms:';
$lang['Forum_Rules'] = 'Forum Rules';
$lang['Agree_checkbox'] = 'I have read, and agree to abide by the %s Forum rules.';

/**
* Force Guests to Enter Their Usernames
*/
$lang['Username_needed'] = 'You have to enter an username !';

/**
* Maxi Simple Subforums
*/
$lang['More'] = '[ Show more... ]';
$lang['More_HTML'] = 'View ALL Subforums';

/**
* First Topic Date
*/
$lang['Create_Date'] = 'Created';

/**
* Password Protected Forums
*/
$lang['Incorrect_forum_password'] = 'Incorrect forum password';
$lang['Only_alpha_num_chars'] = 'The password must be between 3-20 characters and can only contain alphanumeric characters (A-Z, a-z, 0-9).';
$lang['Enter_forum_password'] = 'Enter forum password';
$lang['Password_login_success'] = 'Password login was successfull';
$lang['Click_return_page'] = 'Click %sHere%s to return to the page';

/**
* Recycle Bin Hack
*/
$lang['Move_bin'] = 'Move this topic to bin';
$lang['Topics_Moved_bin'] = 'The selected topics have been moved to bin.';
$lang['Bin_disabled'] = 'Bin has been disabled';
$lang['Bin_recycle'] = 'Recycle';

/**
* DHTML Collapsible FAQ
*/
$lang['dhtml_faq_noscript'] = 'It appears that your browser does not support javascript or it has been disabled in your browser\'s settings.<br /><br />Please, click %shere%s to view a plain HTML version of this FAQ.';

/**
* ModCP Merge Hack
*/
$lang['Merge'] = 'Merge';
$lang['Merge_topic'] = 'Merge to topic';

/**
* Return to Profile Link
*/
$lang['Profile_see'] = 'Click %sHere%s to see your profile';

/**
* Resize Posted Images Based on Max Width
*/
$lang['rmw_image_title'] = 'Click to view full-size';

/**
* Points System
*/
$lang['Points_cp'] = 'Points Control Panel';
$lang['Points_sys']	= 'Points System';
$lang['Points_donation'] = 'Points Donation';
$lang['Points_method'] = 'Method';
$lang['Points_donate'] = '%sDonate%s';
$lang['Points_add_subtract'] = 'Add or subtract %s';
$lang['Points_amount'] = 'Amount';
$lang['Points_give_take'] = 'Amount of %s to give or take';
$lang['Points_give'] = 'Amount of %s to give';
$lang['Add'] = 'Add';
$lang['Subtract'] = 'Subtract';
$lang['Points_donate_to'] = 'The person you want to donate %s to';
$lang['Points_no_username']	= 'No username entered.';
$lang['Points_not_admin'] = 'You are not allowed to admin the points system.';
$lang['Points_cant_take'] = 'You can\'t take away that amount of %s from this user.'; //*
$lang['Points_thanks_donation']	= 'Thanks for your donation.';
$lang['Click_return_points_donate']	= 'Click %sHere%s to return to Points Donation';
$lang['Points_cant_donate']	= 'You can\'t donate that amount of %s to this user.';
$lang['Points_cant_donate_self'] = 'You can\'t donate %s to yourself.';
$lang['Points_user_donation_off'] = 'User donation is not enabled.';
$lang['Click_return_pointscp'] = 'Click %sHere%s to return to the Points Control Panel';
$lang['Points_user_updated'] = 'The user\'s %s has been updated successfully.';
$lang['Points_mass_edit'] = 'Mass Edit Usernames';
$lang['Points_mass_edit_explain'] = 'Enter one username per line.';
$lang['Points_notify'] = 'Always notify me of %s donations';
$lang['Points_notify_explain'] = 'Sends an e-mail when someone donates %s to you';
$lang['Points_enter_some_donate'] = 'Enter some %s to donate.';

/**
* Jail MOD
*/
$lang['Cell_courthouse'] = 'Courthouse';
$lang['Celleds_time'] = 'Imprisonments';

/**
* Gender
*/
$lang['Gender'] = 'Gender';
$lang['Male'] = 'Male';
$lang['Female'] = 'Female';
$lang['No_gender_specify'] = '<em>None Specified</em>';
$lang['Gender_require'] = 'Your Gender is required on this site.';

/**
* Export PMs to XML
*/
$lang['Export'] = 'Export';

/**
* Presentation
*/
$lang['presus']  = 'You have to appear on the forum foreseen for that purpose before being able to post';
$lang['presuscli'] = 'Click %sHere%s';

/**
* Account Self-Delete
*/
$lang['Account_delete'] = 'Do you want to delete your account on this board ?';
$lang['Account_delete_explain'] = 'Deletion of your account cannot be undone';
$lang['User_deleted'] = 'Your account has been sucessfully deleted !';
$lang['Delete_account_question'] = 'Deletion of your account will delete all personnal informations that concerns you in your profile,  inside the database of this board. The messages you wrote in this board will have as post author a guest. <b>Attention !</b> all deletion can not be undone.<br /><br />Do you want to delete your account in this board?';

/**
* Extended PM Notification
*/
$lang['List'] = 'List';
$lang['Ordered_list'] = 'Ordered list';

/**
* Users Set Posts & Topics Count
*/
$lang['Posts_per_page'] = 'Posts per Page';
$lang['Posts_per_page_explain'] = 'The amount of posts shown per page. Leave it empty for board default.';
$lang['Topics_per_page'] = 'Topics per Page';
$lang['Topics_per_page_explain'] = 'The amount of topics shown per page. Leave it empty for board default.';

/**
* Restrict Account to IP
*/
$lang['restrict_ip'] = 'You can not log into this account from this IP address/range.';

/**
* Skype
*/
$lang['SKYPE'] = 'Skype Messenger';

/**
* Disallow Editing/Deleting Administrator Posts
*/
$lang['Not_auth_edit_delete_admin'] = 'You cannot edit/delete an administrator\'s posts, sorry.';

/**
* MiniChat
*/
$lang['Shoutbox'] = 'MiniChat';
$lang['gg_mes'] = 'Message';
$lang['login_to_shoutcast'] = 'You must be logged in to use MiniChat';
$lang['sb_show'] = '<strong>Display</strong>';
$lang['sb_hide'] = '<strong>Hide</strong>';
$lang['sb_hide_done'] = 'Done';
$lang['too_long_word'] = 'Too long word';
$lang['sb_banned_send'] = 'You can\'t send messages';
$lang['shout_refresh'] = 'Refresh';
$lang['Censor'] = 'Censor';
$lang['Flood'] = 'You cannot make another post so soon after your last; please try again in a short while.';
$lang['title_minichat'] = 'MiniChat';

/**
* Trashbox
*/
$lang['Trashbox'] = 'Trashbox';
$lang['Privmsg_Deleted'] = 'Deleted';
$lang['Purge_marked'] = 'Purge Marked';
$lang['Purge_all'] = 'Purge All';
$lang['Undelete_marked'] = 'Undelete Marked';
$lang['Purge_message'] = 'Purge Message';
$lang['Undelete_message'] = 'Undelete Message';
$lang['Trashbox_size'] = 'Your Trashbox is %d%% full';

/**
* Seperate PM Limits for Admins and Mods
*/
$lang['Administrator_Inbox'] = 'Administrator Inbox';
$lang['Administrator_Outbox'] = 'Administrator Outbox';
$lang['Administrator_Savebox'] = 'Administrator Savebox';
$lang['Administrator_Sentbox'] = 'Administrator Sentbox';
$lang['Administrator_Trashbox'] = 'Administrator Trashbox';
$lang['Moderator_Inbox'] = 'Moderator Inbox';
$lang['Moderator_Outbox'] = 'Moderator Outbox';
$lang['Moderator_Savebox'] = 'Moderator Savebox';
$lang['Moderator_Sentbox'] = 'Moderator Sentbox';
$lang['Moderator_Trashbox'] = 'Moderator Trashbox';

/**
* Mini Card
*/
$lang['yellow_card'] = 'Caution';
$lang['red_card'] = 'Ban';
$lang['green_card'] = 'Unban';

/**
* Welcome Private Message
*/
$lang['not_delete_pm'] = 'Could not delete your oldest privmsgs';
$lang['non_existing_user'] = 'Tried obtaining data for a non-existent user';
$lang['No_entry_wpm'] = 'Thank you for register at [sitename]!';
$lang['no_sent_pm_insert'] = 'Could not insert private message sent info!';

?>
