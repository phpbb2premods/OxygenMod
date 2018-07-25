<table cellspacing="2" cellpadding="2" align="center" border="0">
  <tr>
	<td valign="middle">{INBOX_IMG}</td>
	<td valign="middle" class="cattitle">{INBOX}&nbsp;</td>
	<td valign="middle">{SENTBOX_IMG}</td>
	<td valign="middle" class="cattitle">{SENTBOX}&nbsp;</td>
	<td valign="middle">{OUTBOX_IMG}</td>
	<td valign="middle" class="cattitle">{OUTBOX}&nbsp;</td>
  </tr>
  <tr>
	<td valign="middle">{SAVEBOX_IMG}</td>
	<td valign="middle" class="cattitle">{SAVEBOX}&nbsp;</td>
	<td valign="middle">{TRASHBOX_IMG}</td>
	<td valign="middle" class="cattitle">{TRASHBOX}&nbsp;</td>
	<td valign="middle">{EXPORT_IMG}</td>
	<td valign="middle" class="cattitle">{EXPORT}&nbsp;</td>
  </tr>
</table>
<br class="nav" />

<form method="post" action="{S_PRIVMSGS_ACTION}">
  <table width="100%" cellspacing="2" cellpadding="2" border="0">
	<tr>
	  <td class="gen" valign="middle">{REPLY_PM_IMG}</td>
	  <td class="nav" width="100%"><a href="{U_INDEX}" class="nav">{L_INDEX}</a></td>
	</tr>
  </table>

  <table border="0" cellpadding="4" cellspacing="1" width="100%" class="forumline">
	<tr>
	  <th colspan="3" class="thHead" nowrap="nowrap">{BOX_NAME} :: {L_MESSAGE}</th>
	</tr>
	<tr>
	  <td class="row2"><span class="genmed">{L_FROM}:</span></td>
	  <td class="row2" width="100%" colspan="2"><span class="genmed">{MESSAGE_FROM}</span></td>
	</tr>
	<tr>
		<td class="row2"><span class="genmed">{L_TO}:</span></td>
		<td class="row2" width="100%" colspan="2">
		<span class="genmed">{MESSAGE_TO}</span>
		<span class="gensmall">{POSTER_TO_ONLINE_STATUS}</span>
		</td>
	</tr>
	<tr>
	  <td class="row2"><span class="genmed">{L_POSTED}:</span></td>
	  <td class="row2" width="100%" colspan="2"><span class="genmed">{POST_DATE}</span></td>
	</tr>
	<tr>
	  <td class="row2"><span class="genmed">{L_SUBJECT}:</span></td>
	  <td class="row2" width="100%"><span class="genmed">{POST_SUBJECT}</span></td>
	  <td nowrap="nowrap" class="row2" align="center">{QUOTE_PM_IMG}&nbsp;{EDIT_PM_IMG}</td>
	</tr>
	<tr>
	  <td class="row1" valign="top" colspan="3"><span class="postbody">{MESSAGE}</span>
	  <!-- BEGIN postrow -->
	  {ATTACHMENTS}
	  <!-- END postrow -->
	  </td>
	</tr>
	<tr>
	  <td class="row1" colspan="3" width="78%" height="28" valign="bottom"><table cellspacing="0" cellpadding="0" height="18" border="0">
		<tr>
		  <td valign="middle" nowrap="nowrap">{POSTER_FROM_ONLINE_STATUS_IMG}{PROFILE_IMG} {PM_IMG} {EMAIL_IMG} {WWW_IMG} {AIM_IMG} {YIM_IMG} {MSN_IMG} {ICQ_IMG}</td>
		</tr>
	  </table></td>
	</tr>
	<tr>
	  <td class="catBottom" colspan="3" height="28" align="right">
		{S_HIDDEN_FIELDS}
		<!-- BEGIN switch_save_messages -->
		<input type="submit" name="save" value="{L_SAVE_MSG}" class="liteoption" />&nbsp;
		<!-- END switch_save_messages -->
		<input type="submit" name="delete" value="{L_DELETE_MSG}" class="liteoption" />
		<!-- BEGIN switch_attachments -->
		&nbsp;
		<input type="submit" name="pm_delete_attach" value="{L_DELETE_ATTACHMENTS}" class="liteoption" />
		<!-- END switch_attachments -->
	  </td>
	</tr>
  </table>

  <table width="100%" cellspacing="2" cellpadding="2" border="0">
	<tr>
	  <td class="gen" valign="middle">{REPLY_PM_IMG}</td>
	</tr>
  </table>
</form>
<table width="100%" cellspacing="2" cellpadding="2" border="0">
  <tr>
	<td valign="top" align="right">{JUMPBOX}</td>
  </tr>
</table>
