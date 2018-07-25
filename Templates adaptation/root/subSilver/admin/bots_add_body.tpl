
<h1>{L_BOTS_TITLE}</h1>

<p>{L_BOTS_TITLE_EXPLAIN}</p>

<form action="{S_BOTS_ACTION}" method="post"><table width="90%" cellpadding="4" cellspacing="1" border="0" align="center" class="forumline">
	<tr>
		<th colspan="2">{L_BOTS_TITLE}</th>
	</tr>
	<!-- BEGIN errorrow -->
	<tr>
		<td class="row3" colspan="2" align="center"><span style="color:red">{errorrow.BOT_ERROR}</span></td>
	</tr>
	<!-- END errorrow -->
	<tr>
		<td class="row1" width="40%">
			<b class="gen">{L_BOT_NAME}: </b><br />
			<span class="gensmall">{L_BOT_NAME_EXPLAIN}</span>
		</td>
		<td class="row2">
			<input class="post" type="text" name="bot_name" size="30" maxlength="1000" value="{BOT_NAME}" />
		</td>
	</tr>
	<tr>
		<td class="row1">
			<b class="gen">{L_BOT_AGENT}: </b><br />
			<span class="gensmall">{L_BOT_AGENT_EXPLAIN}</span>
		</td>
		<td class="row2">
		<textarea name="bot_agent" rows="5" cols="30">{BOT_AGENT}</textarea>
		</td>
	</tr>
	<tr>
		<td class="row1">
			<b class="gen">{L_BOT_IP}: </b><br />
			<span class="gensmall">{L_BOT_IP_EXPLAIN}</span>
		</td>
		<td class="row2">
		<textarea name="bot_ip" rows="5" cols="30">{BOT_IP}</textarea>
		</td>
	</tr>
	<tr>
		<td class="row1">
			<b class="gen">{L_BOT_STYLE}: </b><br />
			<span class="gensmall">{L_BOT_STYLE_EXPLAIN}</span>
		</td>
		<td class="row2">
			<select name="style">{BOT_STYLE}</select>
		</td>
	</tr>
	<tr>
		<td class="cat" colspan="2" align="center">
		<input class="mainoption" type="submit" name="submit" value="{L_BOT_SUBMIT}" />&nbsp;&nbsp;
		<input class="liteoption" type="reset" value="{L_BOT_RESET}" />
		</td>
	</tr>
</table></form>
<br clear="all" />
