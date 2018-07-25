<form action="{S_AGREE}" method="post">
<table width="100%" cellspacing="1" cellpadding="3" border="0" class="forumline">
	<tr>
		<th class="thHead" height="25" valign="middle">{SITENAME} - {REGISTRATION}</th>
	</tr>
	<tr> 
		<td class="row1" align="center">
			<div class="panel">
			<fieldset class="fieldset">
	   			<legend class="gensmall">{FORUM_RULES}</legend>
	   			<table width="100%" cellspacing="3" cellpadding="0" border="0">
		   			<tr align="left">
		   				<td class="gensmall">{TO_JOIN}</td>
		   			</tr>
		   			<tr>
						<td>
							<div class="terms">{AGREEMENT}</div>
							<div><input type="checkbox" name="agreed" value="1" /><strong>{AGREE_CHECKBOX}</strong></div>
						</td>
		   			</tr>
	   			</table>
			</fieldset>
			</div>
			<div style="margin-top:6px"><input type="hidden" name="not_agreed" value="false" /><input type="submit" value="{L_REGISTER}" class="mainoption" /></div>
		</td>
	</tr>
</table>
</form>
