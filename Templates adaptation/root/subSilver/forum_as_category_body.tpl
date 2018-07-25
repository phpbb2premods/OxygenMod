<form method="post" action="{S_POST_DAYS_ACTION}">

	{ANNONCE_GLOBALE}

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
		<th colspan="2" class="thCornerL" height="25" nowrap="nowrap">&nbsp;{catrow.CAT_DESC}&nbsp;</th>
		<th width="70" class="thTop" nowrap="nowrap">&nbsp;{L_TOPICS}&nbsp;</th>
		<th width="70" class="thTop" nowrap="nowrap">&nbsp;{L_POSTS}&nbsp;</th>
		<th width="200" class="thCornerR" nowrap="nowrap">&nbsp;{L_LASTPOST}&nbsp;</th>
	</tr>
	<!-- BEGIN forumrow -->
	<tr> 
		<td class="row1" align="center" valign="middle" height="50">
		<img src="{catrow.forumrow.FORUM_FOLDER_IMG}" alt="{catrow.forumrow.L_FORUM_FOLDER_ALT}" title="{catrow.forumrow.L_FORUM_FOLDER_ALT}" border="0" /></td>
		<td class="{catrow.forumrow.HYPERCELL_CLASS}" width="100%" height="50"><table width="100%" cellpadding="2" cellspacing="0" border="0">
		<tr><td><a href="{catrow.forumrow.U_VIEWFORUM}" class="forumlink" {catrow.forumrow.FORUM_LINK_TARGET}>{catrow.forumrow.FORUM_ICON_IMG}</a></td>
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
	<!-- END catrow -->

	<table width="100%" cellspacing="2" cellpadding="2" border="0">
	<tr>
		<td>
		<a href="{U_INDEX}" class="nav">{L_INDEX}</a> &raquo; <a href="{U_CAT}" class="nav">{CAT_NAME}</a> <!-- IF PARENT_FORUM --> &raquo; <a class="nav" href="{U_VIEW_PARENT_FORUM}">{PARENT_FORUM_NAME}</a><!-- ENDIF --> &raquo; <a class="nav" href="{U_VIEW_FORUM}">{FORUM_NAME}</a>
		</td>
	</tr>
  </table>
	<br />
	<table width="100%" cellpadding="3" cellspacing="1" border="0" class="forumline">
		<tr>
			<th class="thCornerL" colspan="2" align="left" height="25" nowrap="nowrap">{L_INFORMATIONS}</th>
		</tr>
		<tr>
			<td class="row3" colspan="2" height="20">
			<b class="gensmall">{LOGGED_IN_USER_LIST}</b>
			</td>
		</tr>
		<tr>
  	<td class="row1"><span class="gensmall">
  		<strong>{L_LEGEND}:</strong>
  		<!-- BEGIN legend -->
  		[&nbsp;<a href="{legend.U_RANK}"{legend.RANK_STYLE}>{legend.RANK_NAME}</a>&nbsp;]
  		<!-- END legend -->
  	</span></td>
		</tr>
	</table>

</form>

<br class="nav" />
<table width="100%" cellspacing="2" cellpadding="0" border="0">
  <tr> 
	<td align="right" valign="top">{JUMPBOX}</td>
  </tr>
</table>
