<script language="Javascript" type="text/javascript">
<!--
function select_switch(status)
{
	for (i = 0; i < document.privmsg_list.length; i++)
	{
		document.privmsg_list.elements[i].checked = status;
	}
}
//-->
</script>

<table width="100%" cellspacing="0" cellpadding="0" border="0">
  <tr>
	<td align="right"> 
	<!-- BEGIN switch_box_size_notice -->
	<table class="forumline" width="189" cellspacing="1" cellpadding="2" border="0">
	<tr> 
		<td colspan="3" width="189" class="row1" nowrap="nowrap" align="center"><span class="gensmall">{ATTACH_BOX_SIZE_STATUS}</span></td>
	</tr>
	<tr> 
		<td colspan="3" width="189" class="row2"><table cellspacing="0" cellpadding="1" border="0">
			<tr> 
				<td><img src="{I_LCAP}" width="4" height="12" alt="{ATTACHBOX_LIMIT_IMG_WIDTH}" /><img src="templates/subSilverPlus/images/voting_bar.gif" width="{ATTACHBOX_LIMIT_IMG_WIDTH}" height="12" alt="{ATTACH_LIMIT_PERCENT}" /><img src="{I_RCAP}" width="4" height="12" alt="{ATTACHBOX_LIMIT_IMG_WIDTH}" /></td>
			</tr>
			</table>
		</td>
	</tr>
	<tr> 
		<td width="33%" class="row1"><span class="gensmall">0%</span></td>
		<td width="34%" align="center" class="row1"><span class="gensmall">50%</span></td>
		<td width="33%" align="right" class="row1"><span class="gensmall">100%</span></td>
	</tr>
	</table>
	<!-- END switch_box_size_notice -->
	</td>
	<td width="100%" valign="top" align="center"><table height="40" cellspacing="2" cellpadding="2" border="0">
	  <tr valign="middle"> 
		<td>{INBOX_IMG}</td>
		<td class="cattitle">{INBOX}</td>
		<td>{SENTBOX_IMG}</td>
		<td class="cattitle">{SENTBOX}</td>
		<td>{OUTBOX_IMG}</td>
		<td class="cattitle">{OUTBOX}</td>
	  </tr>
	  <tr valign="middle"> 
		<td>{SAVEBOX_IMG}</td>
		<td class="cattitle">{SAVEBOX}</td>
		<td>{TRASHBOX_IMG}</td>
		<td class="cattitle">{TRASHBOX}</td>
		<td>{EXPORT_IMG}</td>
		<td class="cattitle">{EXPORT}</td>
	  </tr>
	</table></td>
	<td align="right"> 
	  <!-- BEGIN switch_box_size_notice -->
	  <table class="forumline" width="189" cellspacing="1" cellpadding="2" border="0">
		<tr> 
		  <td colspan="4" width="189" class="row1" nowrap="nowrap" align="center"><span class="gensmall">{BOX_SIZE_STATUS}</span></td>
		</tr>
		<tr> 
		  <td colspan="4" width="189" class="row2"><table cellspacing="0" cellpadding="1" border="0">
			<tr>
				<td><img src="{I_LCAP}" width="4" height="12" alt="{BOX_SIZE_STATUS}" /><img src="templates/subSilverPlus/images/voting_bar.gif" width="{INBOX_LIMIT_IMG_WIDTH}" height="12" alt="{BOX_SIZE_STATUS}" /><img src="{I_RCAP}" width="4" height="12" alt="{BOX_SIZE_STATUS}" /></td>
			</tr>
		  </table></td>
		</tr>
		<tr>
		  <td width="33%" class="row1"><span class="gensmall">0%</span></td>
		  <td width="34%" align="center" class="row1"><span class="gensmall">50%</span></td>
		  <td width="33%" align="right" class="row1"><span class="gensmall">100%</span></td>
		</tr>
	  </table>
	  <!-- END switch_box_size_notice -->
	</td>
  </tr>
</table>
<br class="nav" />

<form method="post" name="privmsg_list" action="{S_PRIVMSGS_ACTION}">
  <table width="100%" cellspacing="2" cellpadding="2" border="0">
	<tr>
	  <td align="left" valign="middle">{POST_PM_IMG}</td>
	  <td class="nav" width="100%" align="left"><a href="{U_INDEX}" class="nav">{L_INDEX}</a></td>
	  <td align="right" nowrap="nowrap"><span class="gensmall">
		{L_DISPLAY_MESSAGES}: <select name="msgdays">{S_SELECT_MSG_DAYS}</select>&nbsp;
		<input type="submit" value="{L_GO}" name="submit_msgdays" class="liteoption" />
	  </span></td>
	</tr>
  </table>

  <table class="forumline" width="100%" cellpadding="3" cellspacing="1" border="0">
	<tr>
	  <th width="5%" height="25" class="thCornerL" nowrap="nowrap">&nbsp;{L_FLAG}&nbsp;</th>
	  <th width="55%" class="thTop" nowrap="nowrap">&nbsp;{L_SUBJECT}&nbsp;</th>
	  <th width="20%" class="thTop" nowrap="nowrap">&nbsp;{L_FROM_OR_TO}&nbsp;</th>
	  <th width="15%" class="thTop" nowrap="nowrap">&nbsp;{L_DATE}&nbsp;</th>
	  <th width="5%" class="thCornerR" nowrap="nowrap">&nbsp;{L_MARK}&nbsp;</th>
	</tr>
	<!-- BEGIN listrow -->
	<tr>
	  <td class="{listrow.ROW_CLASS}" width="5%" align="center" valign="middle"><img src="{listrow.PRIVMSG_FOLDER_IMG}" alt="{listrow.L_PRIVMSG_FOLDER_ALT}" title="{listrow.L_PRIVMSG_FOLDER_ALT}" /></td>
	  <td class="{listrow.ROW_CLASS}" width="55%" valign="middle">{listrow.PRIVMSG_ATTACHMENTS_IMG}<span class="topictitle"><a href="{listrow.U_READ}" class="topictitle">{listrow.SUBJECT}</a></span></td>
	  <td class="{listrow.ROW_CLASS}" width="25%" align="center" valign="middle"><span class="name"><a href="{listrow.U_FROM_USER_PROFILE}"{listrow.STYLE}>{listrow.FROM}</a></span></td>
	  <td class="{listrow.ROW_CLASS}" width="15%" align="center" valign="middle"><span class="postdetails">{listrow.DATE}</span></td>
	  <td class="{listrow.ROW_CLASS}" width="5%" align="center" valign="middle"><span class="postdetails"><input type="checkbox" name="mark[]" value="{listrow.S_MARK_ID}" /></span></td>
	</tr>
	<!-- END listrow -->
	<!-- BEGIN switch_no_messages -->
	<tr>
	  <td class="row1" colspan="5" align="center" valign="middle"><span class="gen">{L_NO_MESSAGES}</span></td>
	</tr>
	<!-- END switch_no_messages -->
	<tr>
	  <td class="catBottom" colspan="5" height="28" align="right">
		{S_HIDDEN_FIELDS}
		<!-- BEGIN switch_save_messages -->
		<input type="submit" name="save" value="{L_SAVE_MARKED}" class="mainoption" />&nbsp;
		<!-- END switch_save_messages -->
		<input type="submit" name="delete" value="{L_DELETE_MARKED}" class="liteoption" />&nbsp;
		<input type="submit" name="deleteall" value="{L_DELETE_ALL}" class="liteoption" />&nbsp;
	  </td>
	</tr>
  </table>

  <table width="100%" cellspacing="2" cellpadding="2" border="0">
	<tr>
	  <td align="left" valign="top"><span class="nav">{POST_PM_IMG}</span></td>
	  <td align="left" valign="middle" width="100%"><span class="nav">{PAGE_NUMBER}</span></td>
	  <td align="right" valign="top" nowrap="nowrap">
		<b class="gensmall"><a href="javascript:select_switch(true);" class="gensmall">{L_MARK_ALL}</a> :: <a href="javascript:select_switch(false);" class="gensmall">{L_UNMARK_ALL}</a></b>
		<br /><span class="nav">{PAGINATION}</span>
	  </td>
	</tr>
  </table>
</form>
<table width="100%" cellspacing="0" cellpadding="0" border="0">
  <tr>
	<td align="right" valign="top">{JUMPBOX}</td>
  </tr>
</table>
