<table width="100%" cellspacing="2" cellpadding="2" border="0">
  <tr>
	<td class="nav"><a href="{U_INDEX}" class="nav">{L_INDEX}</a></td>
  </tr>
</table>

<table class="forumline" width="100%" cellspacing="1" cellpadding="3" border="0">
  <tr>
	<th class="thHead">{L_FAQ_TITLE}</th>
  </tr>
  <tr>
	<td class="row1">
		<!-- BEGIN faq_block_link -->
		<b class="gen">{faq_block_link.BLOCK_TITLE}</b><br />
		<!-- BEGIN faq_row_link -->
		<span class="gen"><a href="{faq_block_link.faq_row_link.U_FAQ_LINK}" class="postlink">{faq_block_link.faq_row_link.FAQ_LINK}</a></span><br />
		<!-- END faq_row_link -->
		<br />
		<!-- END faq_block_link -->
	</td>
  </tr>
</table>

<!-- BEGIN faq_block -->
<br class="nav" />
<table class="forumline" width="100%" cellspacing="1" cellpadding="3" border="0">
  <tr> 
	<td class="catHead" height="28" align="center"><span class="cattitle">{faq_block.BLOCK_TITLE}</span></td>
  </tr>
  <!-- BEGIN faq_row -->  
  <tr> 
	<td class="{faq_block.faq_row.ROW_CLASS}" align="left" valign="top"><span class="postbody">
		<a name="{faq_block.faq_row.U_FAQ_ID}"></a><b>{faq_block.faq_row.FAQ_QUESTION}</b><br />
		{faq_block.faq_row.FAQ_ANSWER}<br />
		<a class="postlink" href="#top">{L_BACK_TO_TOP}</a>
	</span></td>
  </tr>
  <tr>
	<td class="spaceRow" height="1"><img src="{I_SPACER}" alt="" width="1" height="1" /></td>
  </tr>
  <!-- END faq_row -->
</table>
<!-- END faq_block -->

<br class="nav" />
<table width="100%" cellspacing="2" border="0">
  <tr>
	<td align="right" valign="top" nowrap="nowrap">{JUMPBOX}</td> 
  </tr>
</table>