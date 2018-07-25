
<script type="text/javascript" src="./../templates/picker/picker.js"></script>

<!-- BEGIN edit -->
<h1>{edit.L_ATTRIBUTE_EDIT}</h1>

<p>{edit.L_ATTRIBUTE_EDIT_EXPLAIN}</p>
<!-- END edit -->
<!-- BEGIN add -->
<h1>{add.L_ATTRIBUTE_ADD}</h1>

<p>{add.L_ATTRIBUTE_ADD_EXPLAIN}</p>
<!-- END add -->

<form action="{S_TITLE_ACTION}" method="post">
	<table class="forumline" cellpadding="4" cellspacing="1" border="0" align="center">
		<tr>
			<th class="thTop" colspan="2">
				<!-- BEGIN edit -->
				{edit.L_ATTRIBUTE_EDIT}
				<!-- END edit -->
				<!-- BEGIN add -->
				{add.L_ATTRIBUTE_ADD}
				<!-- END add -->
			</th>
		</tr>
		<tr>
			<td class="row1" width="42%">
				<span class="gen">{L_ATTRIBUTE}</span><br />
				<span class="gensmall">{L_ATTRIBUTE_EXPLAIN}</span>
			</td>
			<td class="row2">
				<input class="post" type="text" name="attribute" size="35" maxlength="255" value="{ATTRIBUTE}" />
			</td>
		</tr>
		<tr>
			<td class="row1">
				<span class="gen">{L_PERMISSIONS}</span><br />
				<span class="gensmall">{L_PERMISSIONS_EXPLAIN}</span>
			</td>
			<td class="row2">
				<span class="post">
				<input type="checkbox" name="attribute_administrator" {ADMINISTRATOR_CHECKED}/>&nbsp;{ADMINISTRATOR}&nbsp;&nbsp;
				<input type="checkbox" name="attribute_moderator" {MODERATOR_CHECKED}/>&nbsp;{MODERATOR}&nbsp;&nbsp;
				<input type="checkbox" name="attribute_author" {AUTHOR_CHECKED}/>&nbsp;{AUTHOR}</span>
			</td>
		</tr>
		<tr>
			<td class="row1">
				<span class="gen">{L_DATE_FORMAT}</span><br />
				<span class="gensmall">{L_DATE_FORMAT_EXPLAIN}</span>
			</td>
			<td class="row2">
				<input class="post" type="text" name="attribute_date_format" size="15" maxlength="255" value="{DATE_FORMAT}" />
			</td>
		</tr>
		<tr>
			<td class="row1">
				<span class="gen">{L_POSITION}</span><br />
				<span class="gensmall">{L_POSITION_EXPLAIN}</span>
			</td>
			<td class="row2">
				<input type="radio" name="attribute_position" value="0" {LEFT} />&nbsp;{L_LEFT}&nbsp;
				<input type="radio" name="attribute_position" value="1" {RIGHT} />&nbsp;{L_RIGHT}&nbsp;
			</td>
		</tr>
		<tr>
			<td class="row1">
				<span class="gen">{L_COLOR}</span><br />
				<span class="gensmall">{L_COLOR_EXPLAIN}</span>
			</td>
			<td class="row2">
				<input class="post" type="text" id="attribute_color" name="attribute_color" size="15" maxlength="6" value="{COLOR}" onchange="previewColor('preview_attribute_color', this.value);" />
				<input class="cp_preview" type="text" readonly="readonly" size="1" id="preview_attribute_color" title="{L_PICK_COLOR}" onclick="showColorPicker(this, document.forms[0].attribute_color, 'preview_attribute_color'); return false;" />
			</td>
		</tr>
		<tr>
			<td class="catBottom" colspan="2" align="center">{S_HIDDEN_FIELDS}<span class="gensmall">
				<input type="image" src="{I_SUBMIT}" name="submit_form" title="{L_SUBMIT}" />&nbsp;
				<input type="image" src="{I_CANCEL}" name="cancel_form" title="{L_CANCEL}" />
			</span></td>
		</tr>
	</table>
</form>
<br clear="all" />
<script type="text/javascript">
//<![CDATA[
<!--//
previewColor('preview_attribute_color', document.getElementById('attribute_color').value);
//-->
//]]>
</script>
