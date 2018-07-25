	<tr>
	  <th class="thHead" colspan="2">{L_ADD_A_POLL}</th>
	</tr>
	<tr>
	  <td class="row1" colspan="2"><span class="gensmall">{L_ADD_POLL_EXPLAIN}</span></td>
	</tr>
	<tr>
	  <td class="row1"><b class="gen">{L_POLL_QUESTION}</b></td>
	  <td class="row2"><span class="genmed"><input type="text" name="poll_title" size="50" maxlength="255" class="post" value="{POLL_TITLE}" /></span></td>
	</tr>
	<tr>
	  <td class="row1"><b class="gen">{L_POLL_OPTION}</b></td>
	  <td class="row2"><span class="genmed">
		<textarea rows="{POLL_MAX_OPTIONS}" class="post" name="poll_option_text" style="width: 312px;">{POLL_OPTION}</textarea>
	  </span></td>
	</tr>
	<tr>
	  <td class="row1"><b class="gen">{L_POLL_LENGTH}</b></td>
	  <td class="row2">
		<span class="genmed"><input type="text" name="poll_length" size="3" maxlength="3" class="post" value="{POLL_LENGTH}" /></span>
		<b class="gen">{L_DAYS}</b>
		<span class="gensmall">{L_POLL_LENGTH_EXPLAIN}</span>
	  </td>
	</tr>
	<!-- BEGIN switch_poll_delete_toggle -->
	<tr>
	  <td class="row1"><b class="gen">{L_POLL_DELETE}</b></td>
	  <td class="row2"><input type="checkbox" name="poll_delete" /></td>
	</tr>
	<!-- END switch_poll_delete_toggle -->
