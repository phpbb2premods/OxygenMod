<br class="nav" />
{BDAYS_BOX}

<!-- BEGIN switch_shoutbox -->
{SHOUTBOX_BODY}
<!-- END switch_shoutbox -->

<table width="100%" cellspacing="0" cellpadding="2" border="0" align="center">
<tr>
	<td align="left" valign="bottom"><span class="gensmall">
	{LAST_VISIT_DATE}<br />
	{CURRENT_TIME}<br />
	{S_TIMEZONE}<br /></span>
</tr>
</table>

{ANNONCE_GLOBALE}

<table width="100%" cellspacing="0" cellpadding="2" border="0" align="center">
<tr>
	<td align="left" valign="bottom">
	<span class="nav"><a href="{U_INDEX}" class="nav">{L_INDEX}</a>
	</td>
	<td align="right" valign="bottom" class="gensmall">
	<!-- BEGIN toolbar -->
	{toolbar.S_TOOLBAR}
	<!-- END toolbar -->
	</td>
</tr>
</table>

<!-- BEGIN catrow -->
<table width="100%" cellpadding="2" cellspacing="1" border="0" class="forumline">
	<tr>
		<th colspan="5" class="thTop"><a href="{catrow.U_VIEWCAT}" class="cattitle">{catrow.CAT_DESC}</a></th>
	</tr>
	<tr>
		<td colspan="2" class="row2" width="100%" height="25" nowrap="nowrap"><b class="cattitle">{L_FORUM}</b></td>
		<td width="70" class="row2" align="center" nowrap="nowrap"><b class="cattitle">{L_TOPICS}</b></td>
		<td width="70" class="row2" align="center" nowrap="nowrap"><b class="cattitle">{L_POSTS}</b></td>
		<td width="200" class="row2" align="center" nowrap="nowrap"><b class="cattitle">{L_LASTPOST}</b></td>
	</tr>
	<!-- BEGIN forumrow -->
	<!-- IF ! forumrow.PARENT -->
	<tr>
		<td class="row1" align="center" valign="middle" height="50">
		<a href="{catrow.forumrow.U_VIEWFORUM}" class="forumlink" {catrow.forumrow.FORUM_LINK_TARGET}><img src="{catrow.forumrow.FORUM_FOLDER_IMG}" alt="{catrow.forumrow.L_FORUM_FOLDER_ALT}" title="{catrow.forumrow.L_FORUM_FOLDER_ALT}" border="0" /></a>
		</td>
		<td class="{catrow.forumrow.HYPERCELL_CLASS}" width="100%" height="50"><table width="100%" cellpadding="2" cellspacing="0" border="0">
		<tr>
			<td><a href="{catrow.forumrow.U_VIEWFORUM}" class="forumlink" {catrow.forumrow.FORUM_LINK_TARGET}>{catrow.forumrow.FORUM_ICON_IMG}</a></td>
			<td width="100%"><span {catrow.forumrow.FORUM_COLOR} class="forumlink"><a href="{catrow.forumrow.U_VIEWFORUM}" {catrow.forumrow.FORUM_COLOR} class="forumlink" {catrow.forumrow.FORUM_LINK_TARGET}>{catrow.forumrow.FORUM_NAME}</a><br /></span>
			<span class="genmed">{catrow.forumrow.FORUM_DESC}<br /></span>
			<!-- IF catrow.forumrow.MODERATORS --><span class="gensmall">{catrow.forumrow.L_MODERATOR} {catrow.forumrow.MODERATORS}<br /></span><!-- ENDIF -->
			<!-- BEGIN sub --><!-- DEFINE $HAS_SUB = 1 --><!-- IF catrow.forumrow.sub.NUM > 0 --> <!-- ELSE --><span class="genmed">{L_SUBFORUMS}: <!-- ENDIF -->{catrow.forumrow.sub.LAST_POST_SUB} <a href="{catrow.forumrow.sub.U_VIEWFORUM}" {catrow.forumrow.sub.FORUM_COLOR} <!-- IF catrow.forumrow.sub.UNREAD -->class="topic-new"<!-- ENDIF --> title="{catrow.forumrow.sub.FORUM_DESC_HTML}" {catrow.forumrow.sub.FORUM_LINK_TARGET}>{catrow.forumrow.sub.FORUM_NAME}</a><!-- END sub -->
			<!-- IF $HAS_SUB --></span><!-- UNDEFINE $HAS_SUB --><!-- ENDIF -->
			</td>
		</tr>
		</table></td>
		<!-- BEGIN switch_forum_link_off -->
		<td class="row2" align="center" valign="middle" height="50"><span class="gensmall">{catrow.forumrow.TOTAL_TOPICS}</span></td>
		<td class="row2" align="center" valign="middle" height="50"><span class="gensmall">{catrow.forumrow.TOTAL_POSTS}</span></td>
		<td class="{catrow.forumrow.HYPERCELL_CLASS}-right" align="center" valign="middle" height="50" nowrap="nowrap"><span class="gensmall">{catrow.forumrow.LAST_POST}</span></td>
		<!-- END switch_forum_link_off -->
		<!-- BEGIN switch_forum_link_on -->
		<td class="row2" align="center" valign="middle" height="50" colspan="3"><span class="gensmall">{catrow.forumrow.FORUM_LINK_COUNT}</span></td>
		<!-- END switch_forum_link_on -->
	</tr>
	<!-- END forumrow -->
	<!-- ENDIF -->
</table>
<br class="nav" />
<!-- END catrow -->

<!-- BEGIN switch_viewonline -->
<table width="100%" cellpadding="3" cellspacing="1" border="0" class="forumline">
<tr>
	<th class="thCornerL" colspan="2" align="left" valign="middle">
		<a style="float:right" href="#" onClick="doms_toggles.toggle('whoisonline_display', 'whoisonline_close_open', '{I_DOWN_ARROW}', '{I_UP_ARROW}'); return false;" class="postdetails"><img src="{I_DOWN_ARROW}" id="whoisonline_close_open" hspace="2" border="0" /></a>
		{L_STATISTICS}
	</th>
</tr>
<tr>
	<td class="row3"><table width="100%" border="0" cellpadding="2" cellspacing="2">
  <tr>
    <td width="16"><a href="{U_VIEWONLINE}"><img src="{IMG_WHOISONLINE}" alt="{L_WHO_IS_ONLINE}" title="{L_WHO_IS_ONLINE}" border="0" /></a></td>
		<td><b class="gen">{L_WHO_IS_ONLINE}</b></td>
	</tr>
	</table></td>
</tr>
<tr>
	<td class="row1"><table width="100%" cellpadding="3" cellspacing="1" border="0">
	<tr>
		<td class="row1" align="left"><span class="gensmall">{TOTAL_USERS_ONLINE}<br />{LOGGED_IN_USER_LIST}</span></td> 
	</tr>
	</table></td>
</tr>
<tbody id="whoisonline_display" style="display:{TOGGLE_STATUS}">
<tr>
	<td class="row3"><table width="100%" border="0" cellpadding="2" cellspacing="2">
  <tr>
    <td width="16"><a href="{U_MEMBERLIST}"><img src="{IMG_OFFLINE}" alt="{L_MEMBERLIST}" title="{L_MEMBERLIST}" border="0" /></a></td>
		<td><b class="gen">{L_WHO_WAS_ONLINE}</b></td>
	</tr>
	</table></td>
</tr>
<tr>
	<td class="row1"><table width="100%" cellpadding="3" cellspacing="1" border="0">
	<tr>
		<td class="row1" align="left"><span class="gensmall">{L_TOTAL_TODAY}{TOTAL_TODAY_USERS}<br />{TOTAL_HOUR_USERS}<br />{L_REGISTERED_USERS} {S_TODAY_USERLIST}</span></td>
	</tr>
	</table></td>
</tr>
<tr>
	<td class="row3"><table width="100%" border="0" cellpadding="2" cellspacing="2">
  <tr>
    <td width="16"><img src="{IMG_STATISTICS}" alt="{L_STATISTICS}" title="{L_STATISTICS}" border="0" /></td>
		<td><b class="gen">{L_STATISTICS}</b></td>
	</tr>
	</table></td>
</tr>
<tr>
	<td class="row1"><table width="100%" cellpadding="3" cellspacing="1" border="0">
	<tr>
		<td class="row1" align="left"><span class="gensmall">{TOTAL_POSTS}{TOTAL_TOPICS}<br />{TOTAL_USERS}<br />{NEWEST_USER}&nbsp;-&nbsp;{L_NEWEST_FROM}&nbsp;<img width="14" height="9" border="0" src="images/flags/small/{NEWEST_FLAG}.png" alt="{NEWEST_COUNTRY}" title="{NEWEST_COUNTRY}" /><br />{RECORD_USERS}</span></td>
	</tr>
	</table></td>
</tr>
</tbody>
<tr>
 	<td class="row1"><span class="gensmall">
 		<strong>{L_LEGEND}:</strong>
 		<!-- BEGIN legend -->
 		[&nbsp;<a href="{switch_viewonline.legend.U_RANK}"{switch_viewonline.legend.RANK_STYLE}>{switch_viewonline.legend.RANK_NAME}</a>&nbsp;]
 		<!-- END legend -->
 	</span></td>
</tr>
</table>
<!-- END switch_viewonline -->

<table width="100%" cellpadding="1" cellspacing="1" border="0">
	<tr>
		<td class="gensmall" valign="top">{L_ONLINE_EXPLAIN}</td>
	</tr>
</table>

<!-- BEGIN switch_user_logged_out -->
<form method="post" action="{S_LOGIN_ACTION}">
  <table width="100%" cellpadding="3" cellspacing="1" border="0" class="forumline">
	<tr>
	  <td class="catHead" height="28"><a name="login"></a><span class="cattitle">{L_LOGIN_LOGOUT}</span></td>
	</tr>
	<tr>
	  <td class="row1" align="center" valign="middle" height="28"><span class="gensmall">
		<label for="username">{L_USERNAME}: </label>
		<input class="post" id="username" name="username" type="text" size="10" />
		<label for="mdp">{L_PASSWORD}: </label>
		<input class="post" id="mdp" maxlength="32" name="password" type="password" size="10" />
		<!-- BEGIN switch_allow_autologin -->
		<label for="autologin">{L_AUTO_LOGIN}</label>
		<input class="text" id="autologin" name="autologin" type="checkbox" checked="checked" />
		<!-- END switch_allow_autologin -->
		<input class="mainoption" name="login" type="submit" value="{L_LOGIN}" />
	  </span></td>
	</tr>
  </table>
</form>
<!-- END switch_user_logged_out -->

<br class="nav" />
<table cellspacing="3" border="0" align="center" cellpadding="0">
  <tr>
	<td width="20" align="center"><img src="{I_FOLDER_NEW_BIG}" alt="{L_NEW_POSTS}"/></td>
	<td><span class="gensmall">{L_NEW_POSTS}</span></td>
	<td width="20" align="center"><img src="{I_FOLDER_BIG}" alt="{L_NO_NEW_POSTS}" /></td>
	<td><span class="gensmall">{L_NO_NEW_POSTS}</span></td>
	<td width="20" align="center"><img src="{I_FOLDER_LOCKED_BIG}" alt="{L_FORUM_LOCKED}" /></td>
	<td><span class="gensmall">{L_FORUM_LOCKED}</span></td>
	<td width="20" align="center"><img src="{FORUM_LINK_IMG}" alt="{L_FORUM_LINK}" /></td>
	<td><span class="gensmall">{L_FORUM_LINK}</span></td>
  </tr>
</table>
<br class="nav" />
