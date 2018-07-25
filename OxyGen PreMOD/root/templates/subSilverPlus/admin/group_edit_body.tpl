<h1>{L_GROUP_TITLE}</h1>

<form action="{S_GROUP_ACTION}" method="post" name="post">
  <table class="forumline" cellpadding="3" cellspacing="1" border="0" align="center">
	<tr>
	  <th class="thHead" colspan="2">{L_GROUP_EDIT_DELETE}</th>
	</tr>
	<tr>
	  <td class="row1" width="38%"><span class="gen">{L_GROUP_NAME}:</span></td>
	  <td class="row2"><input class="post" type="text" name="group_name" size="35" maxlength="40" value="{GROUP_NAME}" /></td>
	</tr>
	<tr>
	  <td class="row1" width="38%"><span class="gen">{L_RCS_SELECT_RANK}:</span></td>
	  <td class="row2">{LIST_BOX}</td>
	</tr>
	<tr>
	  <td class="row1" width="38%"><span class="gen">{L_GROUP_DESCRIPTION}:</span></td>
	  <td class="row2"><textarea class="post" name="group_description" rows="5" cols="51">{GROUP_DESCRIPTION}</textarea></td>
	</tr>
	<tr>
	  <td class="row1" width="38%"><span class="gen">{L_GROUP_MODERATOR}:</span></td>
	  <td class="row2">
		<input type="text" class="post" name="username" maxlength="50" size="20" value="{GROUP_MODERATOR}" />&nbsp;
		<input type="submit" name="usersubmit" value="{L_FIND_USERNAME}" class="liteoption" onClick="window.open('{U_SEARCH_USER}', '_phpbbsearch', 'HEIGHT=250,resizable=yes,WIDTH=400');return false;" />
	  </td>
	</tr>
	<tr>
	  <td class="row1" width="38%"><span class="gen">{L_GROUP_STATUS}:</span></td>
	  <td class="row2"> 
		<input type="radio" name="group_type" value="{S_GROUP_OPEN_TYPE}" {S_GROUP_OPEN_CHECKED} /> {L_GROUP_OPEN}&nbsp;
		<input type="radio" name="group_type" value="{S_GROUP_CLOSED_TYPE}" {S_GROUP_CLOSED_CHECKED} />	{L_GROUP_CLOSED}&nbsp;
		<input type="radio" name="group_type" value="{S_GROUP_HIDDEN_TYPE}" {S_GROUP_HIDDEN_CHECKED} />	{L_GROUP_HIDDEN}
	  </td> 
	</tr>
	<!-- BEGIN group_edit -->
	<tr>
	  <td class="row1" width="38%">
		<span class="gen">{L_DELETE_MODERATOR}</span><br />
		<span class="gensmall">{L_DELETE_MODERATOR_EXPLAIN}</span>
	  </td>
	  <td class="row2"><input type="checkbox" name="delete_old_moderator" value="1" /> {L_YES}</td>
	</tr>
	<tr>
	  <td class="row1" width="38%"><span class="gen">{L_GROUP_DELETE}:</span></td>
	  <td class="row2"><input type="checkbox" name="group_delete" value="1" /> {L_GROUP_DELETE_CHECK}</td>
	</tr>
	<tr> 
		<td class="row1"><span class="gen">{L_UPLOAD_QUOTA}</span></td>
		<td class="row2">{S_SELECT_UPLOAD_QUOTA}</td>
	</tr>
	<tr> 
		<td class="row1"><span class="gen">{L_PM_QUOTA}</span></td>
		<td class="row2">{S_SELECT_PM_QUOTA}</td>
	</tr>
	<!-- END group_edit -->
	<tr>
	  <td class="catBottom" colspan="2" align="center"><span class="cattitle"> 
		{S_HIDDEN_FIELDS}
		<input type="submit" name="group_update" value="{L_SUBMIT}" class="mainoption" />&nbsp;
		<input type="reset" value="{L_RESET}" name="reset" class="liteoption" />
	  </span></td>
	</tr>
  </table>
</form>
