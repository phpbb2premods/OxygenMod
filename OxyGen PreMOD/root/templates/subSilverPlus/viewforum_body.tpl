<form method="post" action="{S_POST_DAYS_ACTION}">

	<table width="100%" cellspacing="2" cellpadding="2" border="0">
	<tr>
		<td width="100%" align="left" valign="middle">
		<a href="{U_INDEX}" class="nav">{L_INDEX}</a> &raquo; <a href="{U_CAT}" class="nav">{CAT_NAME}</a> <!-- IF PARENT_FORUM --> &raquo; <a class="nav" href="{U_VIEW_PARENT_FORUM}">{PARENT_FORUM_NAME}</a> <!-- ENDIF --> &raquo; <a class="nav" href="{U_VIEW_FORUM}">{FORUM_NAME}</a>
		</td>
	</tr>
	</table>
	<!-- BEGIN catrow -->
	<table width="100%" cellpadding="2" cellspacing="1" border="0" class="forumline">
	<tr> 
		<th colspan="2" class="thCornerL" height="25" nowrap="nowrap">&nbsp;{L_FORUM}&nbsp;</th>
		<th width="70" class="thTop" nowrap="nowrap">&nbsp;{L_TOPICS}&nbsp;</th>
		<th width="70" class="thTop" nowrap="nowrap">&nbsp;{L_POSTS}&nbsp;</th>
		<th width="200" class="thCornerR" nowrap="nowrap">&nbsp;{L_LASTPOST}&nbsp;</th>
	</tr>
	<!-- BEGIN forumrow -->
	<tr> 
		<td class="row1" align="center" valign="middle" height="50">
		<a href="{catrow.forumrow.U_VIEWFORUM}" class="forumlink" {catrow.forumrow.FORUM_LINK_TARGET}><img src="{catrow.forumrow.FORUM_FOLDER_IMG}" alt="{catrow.forumrow.L_FORUM_FOLDER_ALT}" title="{catrow.forumrow.L_FORUM_FOLDER_ALT}" border="0" /></a></td>
		<td class="{catrow.forumrow.HYPERCELL_CLASS}" width="100%" height="50"><table width="100%" cellpadding="2" cellspacing="0" border="0">
		<tr>
		<td><a href="{catrow.forumrow.U_VIEWFORUM}" class="forumlink" {catrow.forumrow.FORUM_LINK_TARGET}>{catrow.forumrow.FORUM_ICON_IMG}</a></td>
		<td width="100%" valign="middle">
			<span {catrow.forumrow.FORUM_COLOR} class="forumlink"><a href="{catrow.forumrow.U_VIEWFORUM}" {catrow.forumrow.FORUM_COLOR} class="forumlink<!-- IF catrow.forumrow.UNREAD --> topic-new<!-- ENDIF -->" {catrow.forumrow.FORUM_LINK_TARGET}>{catrow.forumrow.FORUM_NAME}</a><br /></span>
			<span class="genmed">{catrow.forumrow.FORUM_DESC}<br /></span>
			<span class="gensmall">{catrow.forumrow.L_MODERATOR} {catrow.forumrow.MODERATORS}</span>
		</td>
	</tr>
	</table></td>
	<!-- BEGIN switch_forum_link_off -->
	<td class="row2" align="center" valign="middle" height="50"><span class="gensmall">{catrow.forumrow.TOPICS}</span></td>
	<td class="row2" align="center" valign="middle" height="50"><span class="gensmall">{catrow.forumrow.POSTS}</span></td>
	<td class="{catrow.forumrow.HYPERCELL_CLASS}-right" align="center" valign="middle" height="50" nowrap="nowrap"> <span class="gensmall">{catrow.forumrow.LAST_POST}</span></td>
	<!-- END switch_forum_link_off -->
	<!-- BEGIN switch_forum_link_on -->
	<td class="row2" align="center" valign="middle" height="50" colspan="3"><span class="gensmall">{catrow.forumrow.FORUM_LINK_COUNT}</span></td>
	<!-- END switch_forum_link_on -->
	</tr>
	<!-- END forumrow -->
	</table>
	<br />
	<!-- END catrow -->

	<!-- IF NUM_TOPICS || ! HAS_SUBFORUMS -->

	<table width="100%" cellspacing="2" cellpadding="2" border="0">
	<tr>
		<td colspan="2" align="left" valign="bottom" width="100%">
		<a class="maintitle" href="{U_VIEW_FORUM}">{FORUM_NAME}</a><br />
		<b class="gensmall">{L_MODERATOR}: {MODERATORS}</b>
		</td>
		<td align="right" valign="bottom" nowrap="nowrap"><b class="gensmall">{PAGINATION}</b></td>
	</tr>
	<tr> 
		<td align="left" valign="middle" width="50"><a href="{U_POST_NEW_TOPIC}"><img src="{POST_IMG}" border="0" alt="{L_POST_NEW_TOPIC}" title="{L_POST_NEW_TOPIC}" /></a></td>
		<!-- BEGIN toolbar -->
		<td align="right" valign="bottom" nowrap="nowrap"><span class="gensmall">{toolbar.S_TOOLBAR}</span></td>
		<!-- END toolbar -->
	</tr>
	</table>
  {TOPICS_LIST_BOX}
	<table width="100%" cellspacing="2" cellpadding="2" border="0">
	<tr> 
		<td align="left" valign="middle" width="100%"><a href="{U_POST_NEW_TOPIC}"><img src="{POST_IMG}" border="0" alt="{L_POST_NEW_TOPIC}" title="{L_POST_NEW_TOPIC}" /></a></td>
	</tr>
	<tr>
		<td colspan="2"><a href="{U_INDEX}" class="nav">{L_INDEX}</a> &raquo; <a href="{U_CAT}" class="nav">{CAT_NAME}</a> <!-- IF PARENT_FORUM --> &raquo; <a class="nav" href="{U_VIEW_PARENT_FORUM}">{PARENT_FORUM_NAME}</a><!-- ENDIF --> &raquo; <a class="nav" href="{U_VIEW_FORUM}">{FORUM_NAME}</a></td>
	</tr>
  </table>
</form>
<br class="nav" />

<div id="info_display" style="display:none;">
<table class="forumline" width="100%" cellspacing="1" cellpadding="3" border="0">
  <tr>
	<td class="catHead" colspan="2" height="28" valign="middle"><span class="cattitle">{L_BT_TITLE}</span></td>
  </tr>
  <tr>
	<td class="row2 gensmall" width="150" nowrap="nowrap">{PAGE_NUMBER}</td>
	<td class="row1 gensmall" width="100%">{PAGINATION}</td>
  </tr>
  <tr>
	<td class="row2 gensmall" colspan="2"><b>{LOGGED_IN_USER_LIST}</b></td>
  </tr>
  <tr>
	<td class="row2 gensmall" width="150" nowrap="nowrap"><b>{L_MODERATOR}:</b></td>
	<td class="row1 gensmall" width="100%">{MODERATORS}</td>
  </tr>
  <tr>
	<td class="row2 gensmall" width="150" nowrap="nowrap" valign="top"><b>{L_BT_PERMS}:</b></td>
	<td class="row1 gensmall" width="100%">{S_AUTH_LIST}</td>
  </tr>
  <tr>
	<td class="row2 gensmall" width="150" nowrap="nowrap" valign="top"><b>{L_BT_ICONS}:</b></td>
	<td class="row1 gensmall" width="100%"><table cellspacing="3" cellpadding="0" border="0">
	  <tr>
		<td align="left"><img src="{FOLDER_NEW_IMG}" alt="{L_NEW_POSTS}" width="19" height="18" /></td>
		<td class="gensmall">{L_NEW_POSTS}</td>
		<td>&nbsp;&nbsp;</td>
		<td align="left"><img src="{FOLDER_IMG}" alt="{L_NO_NEW_POSTS}" width="19" height="18" /></td>
		<td class="gensmall">{L_NO_NEW_POSTS}</td>
		<td>&nbsp;&nbsp;</td>
		<td align="left"><img src="{FOLDER_ANNOUNCE_IMG}" alt="{L_ANNOUNCEMENT}" width="19" height="18" /></td>
		<td class="gensmall">{L_ANNOUNCEMENT}</td>
	  </tr>
	  <tr> 
		<td align="left"><img src="{FOLDER_HOT_NEW_IMG}" alt="{L_NEW_POSTS_HOT}" width="19" height="18" /></td>
		<td class="gensmall">{L_NEW_POSTS_HOT}</td>
		<td>&nbsp;&nbsp;</td>
		<td align="left"><img src="{FOLDER_HOT_IMG}" alt="{L_NO_NEW_POSTS_HOT}" width="19" height="18" /></td>
		<td class="gensmall">{L_NO_NEW_POSTS_HOT}</td>
		<td>&nbsp;&nbsp;</td>
		<td align="left"><img src="{FOLDER_STICKY_IMG}" alt="{L_STICKY}" width="19" height="18" /></td>
		<td class="gensmall">{L_STICKY}</td>
	  </tr>
	  <tr>
		<td align="left"><img src="{FOLDER_LOCKED_NEW_IMG}" alt="{L_NEW_POSTS_LOCKED}" width="19" height="18" /></td>
		<td class="gensmall">{L_NEW_POSTS_LOCKED}</td>
		<td>&nbsp;&nbsp;</td>
		<td align="left"><img src="{FOLDER_LOCKED_IMG}" alt="{L_NO_NEW_POSTS_LOCKED}" width="19" height="18" /></td>
		<td class="gensmall">{L_NO_NEW_POSTS_LOCKED}</td>
	  </tr>
	</table></td>
  </tr>
</table>
</div>

<div id="info_close" style="display:visible;">
<table class="forumline" width="100%" cellspacing="1" cellpadding="3" border="0">
  <tr>
	<td class="catHead" colspan="2" height="28" valign="middle"><b>{L_BT_TITLE}</b></td>
  </tr>
  <tr>
	<td class="row2 gensmall" width="150" nowrap="nowrap">{PAGE_NUMBER}</td>
	<td class="row1 gensmall" width="100%">{PAGINATION}</td>
  </tr>
  <tr>
	<td class="row2 gensmall" colspan="2"><b>{LOGGED_IN_USER_LIST}</b></td>
  </tr>
  <tr>
	<td class="row2 gensmall" width="150" nowrap="nowrap" valign="top"><b>{L_BT_ICONS}:</b></td>
	<td class="row1 gensmall" width="100%"><table cellspacing="3" cellpadding="0" border="0">
	  <tr>
		<td align="left"><img src="{FOLDER_NEW_IMG}" alt="{L_NEW_POSTS}" width="19" height="18" /></td>
		<td class="gensmall">{L_NEW_POSTS}</td>
		<td>&nbsp;&nbsp;</td>
		<td align="left"><img src="{FOLDER_IMG}" alt="{L_NO_NEW_POSTS}" width="19" height="18" /></td>
		<td class="gensmall">{L_NO_NEW_POSTS}</td>
	  </tr>
	</table></td>
  </tr>
</table>
</div>

<table width="100%" cellspacing="0" cellpadding="0" border="0">
  <tr>
	<td align="right" valign="top">
		<span class="gensmall"><a href="javascript:dom_toggle.toggle('info_display','info_close');"><img alt="{L_BT_SHOWHIDE_ALT}" src="{I_BT_SHOWHIDE}" title="{L_BT_SHOWHIDE_ALT}" width="22" height="12" border="0" /></a></span></td>
  </tr>
</table>

<br class="nav" />
<table width="100%" cellspacing="2" cellpadding="0" border="0">
  <tr> 
	<td align="right" valign="top">{JUMPBOX}</td>
  </tr>
</table>

<!-- ELSE -->
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr> 
	<td align="right">{JUMPBOX}</td>
  </tr>
</table>
<!-- ENDIF -->
