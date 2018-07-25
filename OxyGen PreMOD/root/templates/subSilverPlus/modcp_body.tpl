<script language="javascript" type="text/javascript">
<!--
function select_switch(status)
{
	for (i = 0; i < document.modcpForm.length; i++)
	{
		document.modcpForm.elements[i].checked = status;
	}
}
//-->
</script>

<form method="post" action="{S_MODCP_ACTION}" name="modcpForm">
  <table width="100%" cellspacing="2" cellpadding="2" border="0">
	<tr>
	  <td class="nav"><a href="{U_INDEX}" class="nav">{L_INDEX}</a> &raquo; <a href="{U_CAT}" class="nav">{CAT_NAME}</a> <!-- IF PARENT_FORUM --> &raquo; <a class="nav" href="{U_VIEW_PARENT_FORUM}">{PARENT_FORUM_NAME}</a> <!-- ENDIF --> &raquo; <a href="{U_VIEW_FORUM}" class="nav">{FORUM_NAME}</a></td>
	</tr>
  </table>

  <table class="forumline" width="100%" cellpadding="3" cellspacing="1" border="0">
	<tr>
	  <td class="catHead" colspan="9" align="center" height="28"><span class="cattitle">{L_MOD_CP}</span></td>
	</tr>
	<tr>
	  <td class="row2" colspan="9" align="center"><span class="gensmall">{L_MOD_CP_EXPLAIN}</span></td>
	</tr>
	<tr>
	  <th class="thCornerL" colspan="3" width="100%" nowrap="nowrap">&nbsp;{L_TOPICS}&nbsp;</th>
	  <th class="thTop" width="50" nowrap="nowrap">&nbsp;{L_REPLIES}&nbsp;</th>
	  <th class="thTop" width="100" nowrap="nowrap">&nbsp;{L_AUTHOR}&nbsp;</th>
	  <th class="thTop" width="150" nowrap="nowrap">&nbsp;{L_CREATE_DATE}&nbsp;</th>
	  <th class="thTop" width="50" nowrap="nowrap">&nbsp;{L_VIEWS}&nbsp;</th>
	  <th class="thTop" width="200" nowrap="nowrap">&nbsp;{L_LASTPOST}&nbsp;</th>
	  <th class="thCornerR" width="5%" nowrap="nowrap">&nbsp;{L_SELECT}&nbsp;</th>
	</tr>
	<!-- BEGIN topicrow -->
	<tr>
	  <td class="row1" width="6" align="center" valign="middle"><img src="{topicrow.TOPIC_FOLDER_IMG}" alt="{topicrow.L_TOPIC_FOLDER_ALT}" title="{topicrow.L_TOPIC_FOLDER_ALT}" /></td>
	  <td class="row1" width="6" align="center" valign="middle">{topicrow.ICON}</td>
	  <td class="{topicrow.HYPERCELL_CLASS}"><span class="topictitle">{topicrow.TOPIC_ATTACHMENT_IMG}{topicrow.TOPIC_TYPE}<a href="{topicrow.U_VIEW_TOPIC}" class="topictitle">{topicrow.TOPIC_TITLE}</a></span></td>
	  <td class="row2" align="center" valign="middle"><span class="postdetails">{topicrow.REPLIES}</span></td>
	  <td class="row3" align="center" valign="middle"><span class="name">{topicrow.TOPIC_AUTHOR}</span></td>
	  <td class="row3" align="center" valign="middle"><span class="name">{topicrow.FIRST_POST_TIME}</span></td>
	  <td class="row2" align="center" valign="middle"><span class="postdetails">{topicrow.VIEWS}</span></td>
	  <td class="{topicrow.HYPERCELL_CLASS}" align="center" valign="middle"><span class="postdetails">{topicrow.LAST_POST_TIME}<br />{topicrow.LAST_POST_AUTHOR} {topicrow.LAST_POST_IMG}</span></td>
	  <td class="row3Right" align="center" valign="middle"><input type="checkbox" name="topic_id_list[]" value="{topicrow.TOPIC_ID}" /></td>
	</tr>
	<!-- END topicrow -->
	<tr align="right"> 
	  <td class="catBottom" colspan="9" height="29">
		{S_HIDDEN_FIELDS}
		<input type="submit" name="delete" class="liteoption" value="{L_DELETE}" />&nbsp;
		<input type="submit" name="move" class="liteoption" value="{L_MOVE}" />&nbsp;
		<input type="submit" name="lock" class="liteoption" value="{L_LOCK}" />&nbsp;
		<input type="submit" name="unlock" class="liteoption" value="{L_UNLOCK}" />&nbsp;
		<input type="submit" name="merge" class="liteoption" value="{L_MERGE}" />&nbsp;
		<input type="submit" class="liteoption" name="recycle" value="{L_RECYCLE}" />&nbsp;
		{SELECT_TITLE}&nbsp;
		<input type="submit" name="quick_title_edit" class="liteoption" value="{L_EDIT_TITLE}" />
	  </td>
	</tr>
  </table>
  <table width="100%" cellspacing="2" cellpadding="2" border="0">
	<tr>
		<td align="left" valign="middle"><b class="nav">{PAGE_NUMBER}</b></td>
		<td align="right" valign="top" nowrap="nowrap">
		<span class="gensmall"><b><a href="javascript:select_switch(true);">{L_MARK_ALL}</a>&nbsp;::&nbsp;<a href="javascript:select_switch(false);">{L_UNMARK_ALL}</a></b><br /></span>
		<span class="nav">{PAGINATION}</span></td>
	</tr>
  </table>
</form>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
	<td align="right">{JUMPBOX}</td>
  </tr>
</table>
