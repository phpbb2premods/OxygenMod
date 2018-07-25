<table width="100%">
	<tr>
		<td>
			<h1>{L_CONFIGURATION_TITLE}</h1>

			<p>{L_CONFIGURATION_EXPLAIN}</p>
			
			{CHECK_VERSION}
		</td>
	</tr>
</table>

<form action="{S_CONFIG_ACTION}" method="post"><table width="99%" cellpadding="4" cellspacing="1" border="0" align="center" class="forumline">
<!-- BEGIN log -->
<!-- BEGIN title -->
	<tr>
	  <th class="thHead" colspan="2">{log.title.title}</th>
	</tr>
<!-- BEGIN desc -->
	<tr>
		<td class="row2" colspan="2"><span class="gensmall">{log.title.desc.desc}</span></td>
	</tr>
<!-- END desc -->
<!-- END title -->
<!-- BEGIN row -->
	<tr>
		<td class="row1">
			{log.row.title}
			<!-- BEGIN desc -->
			<br /><span class="gensmall">{log.row.desc.desc}</span>
			<!-- END desc -->
		</td>
		<td class="row2">
			<!-- BEGIN bool -->
			<input type="radio" name="{log.row.name}" id="{log.row.name}_yes" value="1" {log.row.bool.select_yes} />
			<label for="{log.row.name}_yes">
				{L_ENABLED}
			</label>
			&nbsp;&nbsp;
			<input type="radio" name="{log.row.name}" id="{log.row.name}_no" value="0" {log.row.bool.select_no} />
			<label for="{log.row.name}_no">
				{L_DISABLED}
			</label>
			<!-- END bool -->
			<!-- BEGIN text -->
			<b>{log.row.text.value}</b>
			<!-- END text -->
			<!-- BEGIN string -->
			<input type="text" name="{log.row.name}" value="{log.row.string.value}" class="post" />
			<!-- END string -->
			<!-- BEGIN bigstring -->
			<textarea name="{log.row.name}" class="post">{log.row.bigstring.value}</textarea>
			<!-- END bigstring -->
		</td>
	</tr>
<!-- END row -->
<!-- END log -->
	<tr>
		<td class="catBottom" colspan="2" align="center">{S_HIDDEN_FIELDS}<input type="submit" name="submit" value="{L_SUBMIT}" class="mainoption" />&nbsp;&nbsp;<input type="reset" value="{L_RESET}" class="liteoption" />
		</td>
	</tr>
</table></form>

<br clear="all" />
