<script language="javascript" type="text/javascript">
<!--
function update_smiley(newimage)
{
	document.smiley_image.src = "{S_SMILEY_BASEDIR}/" + newimage;
}
//-->
</script>

<h1>{L_SMILEY_TITLE}</h1>

<p><span class="gen">{L_SMILEY_DESCRIPTION}</span></p>

<form method="post" action="{S_SMILEY_ACTION}">
<table class="forumline" cellspacing="1" cellpadding="4" border="0" align="center">
	<tr> 
		<th class="thHead" colspan="2">{L_SMILEY_CONFIG}</th>
	</tr>
	<tr> 
		<td class="row2"><span class="genmed">{L_SMILEY_CODE}</span></td>
		<td class="row2"> <input type="text" name="smile_code" value="{SMILEY_CODE}" class="post" /></td>
	</tr>
	<tr> 
		<td class="row1"><span class="genmed">{L_SMILEY_URL}</span></td>
		<td class="row1"><select name="smile_url" onchange="update_smiley(this.options[selectedIndex].value);">{S_FILENAME_OPTIONS}</select>&nbsp; <img name="smiley_image" src="{SMILEY_IMG}" border="0" alt="" />&nbsp;</td>
	</tr>
	<tr> 
		<td class="row2"><span class="genmed">{L_SMILEY_EMOTION}</span></td>
		<td class="row2"> <input type="text" name="smile_emoticon" value="{SMILEY_EMOTICON}" class="post" /></td>
	</tr>
	<tr>
		<td class="row1"><span class="genmed">{L_SMILEY_CATEGORY}</span></td>
		<td class="row1"><select name="smile_category">{S_CATEGORY_OPTIONS}</select></td>
	</tr>
	<tr>
		<td class="row1"><span class="genmed">{L_SMILEY_DELETE}</span></td>
		<td class="row1"><input type="checkbox" name="delete" value="1" class="post" {DISABLED} /></td>
	</tr>
	<tr> 
		<td class="catBottom" colspan="2" align="center">{S_HIDDEN_FIELDS}<input class="mainoption" type="submit" value="{L_SUBMIT}" /></td>
	</tr>
</table>
</form>

<div align="center"><span class="copyright"><a href="http://mods.afkamm.co.uk" target="blank" class="copyright">Smiley Categories MOD</a> &copy; 2004, 2005 Afkamm</span></div>
