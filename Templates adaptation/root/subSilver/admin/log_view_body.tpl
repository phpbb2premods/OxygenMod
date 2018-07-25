<script type="text/javascript">
<!--
/**
* Mark/unmark checkboxes
* id = ID of parent container, name = name prefix, state = state [true/false]
* 
* Function taken from Olympus. All credit goes to the phpBB Group / phpBB3 dev team
*/
function marklist(id, name, state)
{
	var parent = document.getElementById(id);
	if (!parent)
	{
		eval('parent = document.' + id);
	}

	if (!parent)
	{
		return;
	}

	var rb = parent.getElementsByTagName('input');
	
	for (var r = 0; r < rb.length; r++)
	{
		if (rb[r].name.substr(0, name.length) == name)
		{
			rb[r].checked = state;
		}
	}
}
// -->
</script>

<table width="100%">
	<tr>
		<td>
			<h1>{L_LOG_VIEW}:&nbsp;{LOG_TYPE}</h1>

			<p>{L_LOG_VIEW_EXPLAIN}</p>

			{CHECK_VERSION}

			<form action="{S_FORM_GET_ACTION}" method="get">
			{SWITCHBOX}
			<input type="submit" value="{L_GO}" class="mainoption" />
			{S_HIDDEN_FIELDS}
			</form>
		</td>
	</tr>
</table>

<form action="{S_FORM_ACTION}" method="post" id="list">

<br />

<table width="99%" cellpadding="4" cellspacing="1" border="0" align="center" class="forumline">

	<tr>
		<th class="thCornerL">{L_USERNAME}</th>
		<th class="thTop">{L_USER_IP}</th>
		<th class="thTop">{L_USER_IP_REAL}</th>
		<th class="thTop">{L_TIME}</th>
		<th class="thTop" width="50%">{L_ACTION}</th>
		<th class="thCornerR">{L_MARK}</th>
	</tr>
	<!-- BEGIN log_row -->
		<tr>
			<td class="{log_row.ROW_CLASS}">{log_row.USERNAME}{log_row.GENDER}</td>
			<td class="{log_row.ROW_CLASS}" align="center"><a href="{LOOKUP}{log_row.USER_IP}" target="_blank">{log_row.USER_IP}</a></td>
			<td class="{log_row.ROW_CLASS}" align="center"><a href="{LOOKUP}{log_row.USER_IP_REAL}" target="_blank">{log_row.USER_IP_REAL}</a></td>
			<td class="{log_row.ROW_CLASS}" align="center">{log_row.TIME}</td>
			<td class="{log_row.ROW_CLASS}">{log_row.ACTION}</td>
			<td class="{log_row.ROW_CLASS}" align="center"><input type="checkbox" name="deletelogs[]" value="{log_row.ID}" /></td>
		</tr>
	<!-- END log_row -->
	<!-- BEGIN no_logs -->
	<tr>
		<td class="row1" colspan="5" align="center">{L_NO_LOGS}</td>
	</tr>
	<!-- END no_logs -->
</table>

<div style="text-align: right; margin-right: 15px;">
	<p>
		<a href="#" onclick="marklist('list', 'deletelogs', true); return false;">{L_MARK_ALL}</a> :: <a href="#" onclick="marklist('list', 'deletelogs', false); return false;">{L_UNMARK_ALL}</a>
	</p>
	
	{S_HIDDEN_FIELDS}
	
	<input type="submit" name="delete" value="{L_DELETE}" class="mainoption" />&nbsp;&nbsp;
	<input type="submit" name="deleteall" value="{L_DELETE_ALL}" class="liteoption" />&nbsp;&nbsp;
	<input type="reset" value="{L_RESET}" class="liteoption" />
	
	<p>{PAGINATION}</p>
</div>

</form>
