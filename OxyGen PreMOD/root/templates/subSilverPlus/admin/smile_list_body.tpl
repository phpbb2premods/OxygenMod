<script language="javascript" type="text/javascript">
<!--
	function update_smiley(newimage)
	{
		document.smiley_image.src = "{S_SMILEY_BASEDIR}/" + newimage;
	}

	function orderVals(url, number)
	{
		var orderArray = number.split('|');
		document.location.href = url + "&old=" + orderArray[0] + "&new=" + orderArray[1];
	}

	function check_switch(val)
	{
		for( i = 0; i < document.smiley_list.elements.length; i++ )
		{
			document.smiley_list.elements[i].checked = val;
		}
	}
//-->
</script>

<h1>{L_PAGE_TITLE}</h1>

<p><span class="gen">{L_PAGE_DESCRIPTION}</span></p>

<form method="post" action="{S_SMILEY_ACTION}" name="smiley_list">
<table cellspacing="1" cellpadding="4" border="0" width="100%" align="center" class="forumline">
	<tr>
		<th class="thCornerL" nowrap="nowrap">{L_CATEGORY}</th>
		<th colspan="5" class="thTop">{L_CATEGORY_DESC}</th>
	</tr>
	<tr>
		<td class="{ROW_CLASS}" nowrap="nowrap"><span class="gen">{S_CAT_NAME}</span></td>
		<td colspan="5" class="{ROW_CLASS}" width="60%"><span class="gen">{S_CAT_DESCRIPTION}</span></td>
	</tr>
	<tr>
		<th height="22">{L_CODE}</th>
		<th width="60%">{L_SMILE}</th>
		<th>{L_EMOT}</th>
		<th>{L_MOVE}</th>
		<th>{L_ORDER}</th>
		<th>{L_DELETE}</th>
	</tr>
	<!-- BEGIN smiles -->
	<tr>
		<td class="{smiles.ROW_CLASS}"><input type="text" size="15" name="code{smiles.SMILEY_ID}" value="{smiles.SMILEY_CODE}" /></td>
		<td class="{smiles.ROW_CLASS}" align="center"><img src="{smiles.SMILEY_IMG}" alt="{smiles.SMILEY_URL}" title="{smiles.SMILEY_URL}" border="0"></td>
		<td class="{smiles.ROW_CLASS}"><input type="text" size="25" name="emot{smiles.SMILEY_ID}" value="{smiles.SMILEY_EMOTICON}" /></td>
		<td class="{smiles.ROW_CLASS}"><select name="cat{smiles.SMILEY_ID}">{smiles.CATEGORY_LIST}</select></td>
		<td class="{smiles.ROW_CLASS}" align="center"><select name="order{smiles.SMILEY_ID}" onChange="orderVals('{smiles.SMILEY_ORDER_ACTION}',this.options[selectedIndex].value);">{smiles.SMILEY_ORDER}</select></td>
		<td class="{smiles.ROW_CLASS}" align="center"><input type="hidden" name="id{smiles.SMILEY_COUNT}" value="{smiles.SMILEY_ID}" /><input type="checkbox" name="del{smiles.SMILEY_ID}" value="1" /></td>
	</tr>
	<!-- END smiles -->
	{S_CAT_EMPTY}
	<tr>
		<td colspan="5" class="catBottom" align="center"><span class="gen">{S_PAGINATION}</span></td>
		<td class="catBottom" align="center"><span class="nav"><a href="javascript:check_switch(true);" class="nav">{L_TICK_ALL}</a></span></td>
	</tr>
	<tr>
		<td colspan="5" class="catBottom" align="center">
		<input class="liteoption" type="submit" name="smiley_edit" value="{L_SMILEY_ADD}" />
		&nbsp;&nbsp;
		<input class="mainoption" type="submit" name="submit_all" value="{L_MULTI_EDIT_SUBMIT}" />
		</td>
		<td class="catBottom" align="center"><span class="nav"><a href="javascript:check_switch();" class="nav">{L_UNTICK_ALL}</a></span></td>
	</tr>
</table>
{S_HIDDEN_FIELDS}
</form>

<div align="center"><span class="copyright"><a href="http://mods.afkamm.co.uk" target="blank" class="copyright">Smiley Categories MOD</a> &copy; 2004, 2005 Afkamm</span></div>
