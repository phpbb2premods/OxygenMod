<table width="100%" cellspacing="2" cellpadding="2" border="0">
  <tr>
	<td class="nav" align="left" valign="middle" width="100%">
		<a class="nav" href="{U_INDEX}">{L_INDEX}</a> &raquo; <a href="{U_CAT}" class="nav">{CAT_NAME}</a> <!-- IF PARENT_FORUM --> &raquo; <a class="nav" href="{U_VIEW_PARENT_FORUM}">{PARENT_FORUM_NAME}</a><!-- ENDIF --> &raquo; <a class="nav" href="{U_VIEW_FORUM}">{FORUM_NAME}</a>
	</td>
  </tr>
  <tr>
	<td align="left" valign="bottom" colspan="2">
		<a class="maintitle" href="{U_VIEW_TOPIC}">{TOPIC_TITLE}</a><br />
		<b class="gensmall">{PAGINATION}</b>
	</td>
  </tr>
</table>

<table width="100%" cellspacing="2" cellpadding="2" border="0">
	<tr>
	{POLL_DISPLAY}
	</tr>
</table>

<table width="100%" cellspacing="2" cellpadding="2" border="0">
  <tr>
	<td class="nav" align="left" valign="bottom" nowrap="nowrap">
		<a class="nav" href="{U_POST_NEW_TOPIC}"><img src="{POST_IMG}" border="0" alt="{L_POST_NEW_TOPIC}" title="{L_POST_NEW_TOPIC}" align="middle" /></a>
		<a class="nav" href="{U_POST_REPLY_TOPIC}"><img src="{REPLY_IMG}" border="0" alt="{L_POST_REPLY_TOPIC}" title="{L_POST_REPLY_TOPIC}" align="middle" /></a>
		<!-- BEGIN bump_topic -->
		<a href="{bump_topic.U_BUMP_TOPIC}"><img src="{bump_topic.I_BUMP_TOPIC}" border="0" alt="{bump_topic.L_BUMP_TOPIC}" title="{bump_topic.L_BUMP_TOPIC}" align="middle" /></a>
		<!-- END bump_topic -->
	</td>
	<!-- BEGIN toolbar -->
	<td align="right" valign="bottom" nowrap="nowrap"><span class="gensmall">{toolbar.S_TOOLBAR}</span></td>
	<!-- END toolbar -->
  </tr>
</table>

<!-- BEGIN postrow -->
<table class="forumline" width="100%" cellspacing="1" cellpadding="3" border="0">
  <tr>
	<th class="thLeft" width="150" height="26" nowrap="nowrap">{L_AUTHOR}</th>
	<th class="thRight" nowrap="nowrap">{L_MESSAGE}</th>
	<span class="name"><a name="{postrow.S_NUM_ROW}" id="{postrow.S_NUM_ROW}"></a></span>
  </tr>
  <tr>
	<td class="row1" width="150" align="middle" valign="top">
		<span class="nav">{postrow.S_NAV_BUTTONS}</span>
		<hr size="1" />
		<b class="name"><a name="{postrow.U_POST_ID}"></a>{postrow.POSTER_NAME}</b>{postrow.I_QP_QUOTE}<br />
		<span class="postdetails"><br />{postrow.POSTER_RANK}<br /><br />{postrow.RANK_IMAGE}<br />{postrow.POSTER_AVATAR}<br />{postrow.WARN_CARDS}<br /><br />{postrow.POSTER_JOINED}<br />{postrow.POSTER_POSTS}<br />{postrow.POINTS}{postrow.DONATE_POINTS}<br /></span>
	</td>
	<td class="row1" width="100%" height="28" valign="top"><table width="100%" cellspacing="0" cellpadding="0" border="0">
	  <tr>
		<td width="100%"><span class="postdetails">
			<img src="{I_MINITIME}" alt="" title="{L_POSTED}" border="0" />{L_POSTED}: {postrow.POST_DATE}<br />
			<a href="{postrow.U_MINI_POST}"><img src="{postrow.MINI_POST_IMG}" alt="" title="{postrow.L_MINI_POST_ALT}" border="0" /></a>{L_POST_SUBJECT}: {postrow.POST_SUBJECT}
			<!-- BEGIN sub_title -->
			<br /><img src="{postrow.MINI_POST_IMG}" width="12" height="9" alt="" title="{L_SUB_TITLE}" border="0" />{L_SUB_TITLE}: {postrow.sub_title.SUB_TITLE}
			<!-- END sub_title -->
		</span></td>
		<td valign="top" nowrap="nowrap">{postrow.QUOTE_IMG} {postrow.EDIT_IMG} {postrow.DELETE_IMG} {postrow.KEEP_UNREAD_IMG} {postrow.SPLIT_IMG} {postrow.IP_IMG} {postrow.WARN_YELLOW_CARD} {postrow.WARN_RED_CARD} {postrow.WARN_GREEN_CARD}</td>
	  </tr>
	  <tr>
		<td colspan="2"><hr size="1" /></td>
	  </tr>
	  <tr>
		<td colspan="2">
			<div id="message_{postrow.U_POST_ID}"><span class="postbody">{postrow.MESSAGE}</span></div>{postrow.ATTACHMENTS}<div align="right"><span class="gensmall"><font color="#999999"><i>{postrow.EDITED_MESSAGE}{postrow.BUMPED_MESSAGE}</i></font></span><span class="postbody">{postrow.SIGNATURE}</span></div>
		</td>
	  </tr>
	</table></td>
  </tr>
  <tr>
	<td class="row1" width="100%" colspan="2" valign="bottom" nowrap="nowrap"><table width="100%" height="18" cellspacing="0" cellpadding="0" border="0">
	  <tr> 
		<td valign="middle" nowrap="nowrap"><span class="nav">
			{postrow.SEARCH_IMG} {postrow.PROFILE_IMG} {postrow.PM_IMG} {postrow.EMAIL_IMG} {postrow.WWW_IMG} {postrow.AIM_IMG} {postrow.YIM_IMG} {postrow.MSN_IMG} {postrow.SKYPE_IMG} {postrow.ICQ_IMG}
		</span></td>
		<td align="right" valign="middle" nowrap="nowrap"><span class="nav">{postrow.POSTER_ONLINE_STATUS_IMG}</span></td>
	  </tr>
	</table></td>
  </tr>
  <tr>
	<td class="spaceRow" colspan="2" height="1"><img src="{I_SPACER}" alt="" width="1" height="1" /></td>
  </tr>
<!-- BEGIN spacing -->
</table>
<br class="gensmall" />
<!-- END spacing -->
<!-- END postrow -->
  <tr align="center">
	<td class="catBottom" colspan="2" height="28"><table cellspacing="0" cellpadding="0" border="0">
	  <tr>
		<form method="post" action="{S_POST_DAYS_ACTION}"><td class="gensmall" align="center">
			{L_DISPLAY_POSTS}: {S_SELECT_POST_DAYS}&nbsp;{S_SELECT_POST_ORDER}&nbsp;
			<input type="submit" value="{L_GO}" class="liteoption" name="submit" />
		</td></form>
	  </tr>
	</table></td>
  </tr>
</table>

<table width="100%" cellspacing="2" cellpadding="2" border="0">
  <tr>
	<td class="nav" align="left" valign="middle" nowrap="nowrap">
		<a class="nav" href="{U_POST_NEW_TOPIC}"><img src="{POST_IMG}" border="0" alt="{L_POST_NEW_TOPIC}" title="{L_POST_NEW_TOPIC}" align="middle" /></a>
		<a class="nav" href="{U_POST_REPLY_TOPIC}"><img src="{REPLY_IMG}" border="0" alt="{L_POST_REPLY_TOPIC}" title="{L_POST_REPLY_TOPIC}" align="middle" /></a>
		<!-- BEGIN bump_topic -->
		<a href="{bump_topic.U_BUMP_TOPIC}"><img src="{bump_topic.I_BUMP_TOPIC}" border="0" alt="{bump_topic.L_BUMP_TOPIC}" title="{bump_topic.L_BUMP_TOPIC}" align="middle" /></a>
		<!-- END bump_topic -->
		<!-- BEGIN qp_form -->
		<!-- BEGIN qp_button -->
		<a href="{qp_form.qp_button.U_QPES}"><img src="{qp_form.qp_button.I_QPES}" border="0" alt="{qp_form.qp_button.L_QPES_ALT}" title="{qp_form.qp_button.L_QPES_ALT}" align="middle" /></a>
		<!-- END qp_button -->
		<!-- END qp_form -->
	</td>
	<td align="right" class="nav" nowrap="nowrap">{SELECT_TITLE}</td>
  </tr>
</table>

<table width="100%" cellspacing="2" cellpadding="2" border="0">
  <tr>
	<td class="nav" width="100%" align="left" valign="middle">
		<a class="nav" href="{U_INDEX}">{L_INDEX}</a> &raquo; <a href="{U_CAT}" class="nav">{CAT_NAME}</a> <!-- IF PARENT_FORUM --> &raquo; <a class="nav" href="{U_VIEW_PARENT_FORUM}">{PARENT_FORUM_NAME}</a><!-- ENDIF --> &raquo; <a class="nav" href="{U_VIEW_FORUM}">{FORUM_NAME}</a>
	</td>
  </tr>
</table>

<!-- BEGIN qp_form -->
<br class="nav" />
{QP_BOX}
<br class="nav" />
<!-- END qp_form -->

<table class="forumline" width="100%" cellspacing="1" cellpadding="3" border="0">
  <tr>
	<td class="catHead" colspan="2" height="28"><span class="cattitle" valign="top"><b>{L_BT_TITLE}</b></span></td>
  </tr>
  <tr>
	<td class="row2 gensmall" width="150" nowrap="nowrap">{PAGE_NUMBER}</td>
	<td class="row1 gensmall" width="100%">{PAGINATION}</td>
  </tr>
  <!-- BEGIN switch_user_logged_in -->
  <tr>
	<td class="row2 gensmall" colspan="2">{S_WATCH_TOPIC}</td>
  </tr>
  <!-- END switch_user_logged_in -->
  <tbody id="info_display" style="display:none;">
	<tr>
		<td class="row2 gensmall" valign="top" width="150" nowrap="nowrap" valign="top"><b>{L_BT_PERMS}:</b></td>
		<td class="row1 gensmall" width="100%">{S_AUTH_LIST}</td>
	</tr>
  </tbody>
</table>

<table width="100%" cellspacing="0" cellpadding="0" border="0">
  <tr>
	<td width="100%" align="left" valign="top" nowrap="nowrap">
	<br class="nav" />
	{S_TOPIC_ADMIN}
	</td>
	<td align="right" valign="top">
		<span class="gensmall"><a href="javascript:dom_toggle.toggle('info_display','info_close');"><img alt="{L_BT_SHOWHIDE_ALT}" src="{I_BT_SHOWHIDE}" title="{L_BT_SHOWHIDE_ALT}" width="22" height="12" border="0" /></a>
	</span></td>
  </tr>
  <tr>
	<td colspan="2" valign="middle" align="right">{JUMPBOX}</td>
  </tr>
</table>
