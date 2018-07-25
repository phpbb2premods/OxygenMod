
<h1>{L_SMILEY_TITLE}</h1>

<p><span class="genmed">{L_SMILEY_TEXT}</span></p>

<script language="JavaScript" type="text/javascript">
<!--
	function check_switch(val)
	{
		for( i = 0; i < document.post.elements.length; i++ )
		{
			document.post.elements[i].checked = val;
		}
	}
//-->
</script>

<form method="post" action="{S_SMILEY_ACTION}" name="post">
<table cellspacing="1" cellpadding="4" border="0" width="100%" align="center" class="forumline">
	<tr>
		<th height="22">{L_CODE}</th>
		<th width="60%">{L_SMILE}</th>
		<th>{L_EMOT}</th>
		<th>{L_CATEGORY}</th>
		<th>{L_ORDER_NUM}</th>
		<th nowrap="nowrap">{L_ADD}</th>
	</tr>
	<!-- BEGIN smiles -->
	<tr>
		<td class="{smiles.ROW_CLASS}"><input type="text" size="15" name="code{smiles.SMILEY_ID}" value="{smiles.SMILEY_CODE}" /></td>
		<td class="{smiles.ROW_CLASS}" align="center"><img src="{smiles.SMILEY_IMG}" alt="{smiles.SMILEY_URL}" title="{smiles.SMILEY_URL}" border="0"></td>
		<td class="{smiles.ROW_CLASS}"><input type="text" size="25" name="emot{smiles.SMILEY_ID}" value="" /></td>
		<td class="{smiles.ROW_CLASS}"><select name="cat{smiles.SMILEY_ID}">{smiles.CATEGORY_LIST}</select></td>
		<td class="{smiles.ROW_CLASS}" align="center"><input type="hidden" name="url{smiles.SMILEY_ID}" value="{smiles.SMILEY_URL}" /><span class="genmed">{smiles.SMILEY_ORDER}</span></td>
		<td class="{smiles.ROW_CLASS}" align="center"><input type="checkbox" name="add{smiles.SMILEY_ID}" value="1" /></td>
	</tr>
	<!-- END smiles -->
	<tr>
		<td colspan="5" class="catBottom" align="center"><span class="gen">{S_PAGINATION}</span></td>
		<td class="catBottom" align="center"><span class="nav"><a href="javascript:check_switch(true);" class="nav">{L_TICK_ALL}</a></span></td>
	</tr>
	<tr>
		<td colspan="5" class="catBottom" align="center" valign="middle"><input class="mainoption" type="submit" value="{L_SUBMIT}" /></td>
		<td class="catBottom" align="center"><span class="nav"><a href="javascript:check_switch();" class="nav">{L_UNTICK_ALL}</a></span></td>
	</tr>
</table>
{S_HIDDEN_FIELDS}
</form>

<div align="center"><span class="copyright"><a href="http://mods.afkamm.co.uk" target="blank" class="copyright">Smiley Categories MOD</a> &copy; 2004, 2005 Afkamm</span></div>
