
<script language="javascript" type="text/javascript">
<!--
function emoticon(text)
{
	var txtarea = opener.document.forms['post'].message;
	text = ' ' + text + ' ';
	if( txtarea.createTextRange && txtarea.caretPos )
	{
		var caretPos = txtarea.caretPos;
		caretPos.text = caretPos.text.charAt(caretPos.text.length - 1) == ' ' ? text + ' ' : text;
		window.txtarea.focus();
	}
	else if( txtarea.selectionEnd && (txtarea.selectionStart | txtarea.selectionStart == 0) )
	{ 
		mozInsert(txtarea, text, "");
	}
	else 
	{
		txtarea.value  += text;
		window.txtarea.focus();
	}
}

// The mozInsert function allows Mozilla users to insert smilies/bbcode tags at the cursor position
// and not just at the end like previously

function mozInsert(txtarea, openTag, closeTag)
{
        if( txtarea.selectionEnd > txtarea.value.length )
	{
		txtarea.selectionEnd = txtarea.value.length;
	}
       
        var startPos = txtarea.selectionStart; 
        var endPos = txtarea.selectionEnd+openTag.length; 
       
        txtarea.value = txtarea.value.slice(0,startPos)+openTag+txtarea.value.slice(startPos); 
        txtarea.value = txtarea.value.slice(0,endPos)+closeTag+txtarea.value.slice(endPos); 
         
        txtarea.selectionStart = startPos+openTag.length; 
        txtarea.selectionEnd = endPos; 
        window.txtarea.focus(); 
}
// From www.codeave.com
window.resizeTo({S_WIDTH},{S_HEIGHT})
//-->
</script>
<table width="100%" border="0" cellspacing="0" cellpadding="10">
	<tr>
		<td align="center"><table width="100%" border="0" cellspacing="1" cellpadding="4" class="forumline">
			<tr>
				<th class="thHead" height="25">{L_EMOTICONS}</th>
			</tr>
			<tr>
				<td><table width="100%" border="0" cellspacing="0" cellpadding="5">
					<!-- BEGIN smilies_row -->
					<tr align="center">
						<!-- BEGIN smilies_col -->
						<td><img src="{smilies_row.smilies_col.SMILEY_IMG}" alt="{smilies_row.smilies_col.SMILEY_DESC}" border="0" onMouseOver="this.style.cursor='hand';" onClick="emoticon('{smilies_row.smilies_col.SMILEY_CODE}');" title="{smilies_row.smilies_col.SMILEY_DESC}" /></td>
						<!-- END smilies_col -->
					</tr>
					<!-- END smilies_row -->
				</table></td>
			</tr>
			<tr>
				<td align="center"><span class="genmed">{PAGINATION}</span></td>
			</tr>
			<!-- BEGIN smiley_category -->
			<tr>
				<th class="thHead" height="25">{L_SMILEY_CATEGORIES}</th>
			</tr>
		 	<tr>
				<td align="center">
				<!-- BEGIN buttons -->
				<input {smiley_category.buttons.TYPE} {smiley_category.buttons.VALUE} onClick="window.location='{smiley_category.buttons.CAT_MORE_SMILIES}'; return false;" />
				<!-- END buttons -->
		 		<!-- BEGIN dropdown -->
		 		{smiley_category.dropdown.OPTIONS}
				<!-- END dropdown -->
				</td>

			</tr>
			<!-- END smiley_category -->
		</table></td>
	</tr>
</table>
<div align="center"><span class="copyright"><a href="http://mods.afkamm.co.uk" target="blank" class="copyright">Smiley Categories MOD</a> &copy; 2004, 2005 Afkamm</span></div>