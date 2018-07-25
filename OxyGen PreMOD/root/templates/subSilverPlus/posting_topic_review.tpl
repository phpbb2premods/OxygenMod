<!-- BEGIN switch_inline_mode -->
<table class="forumline" width="100%" cellpadding="3" cellspacing="1" border="0">
  <tr> 
	<td class="catHead" height="28" align="center"><span class="cattitle">{L_TOPIC_REVIEW}</span></td>
  </tr>
  <tr>
	<td class="row1"><iframe width="100%" height="300" src="{U_REVIEW_TOPIC}">
<!-- END switch_inline_mode -->
<table class="forumline" width="100%" cellpadding="3" cellspacing="1" border="0">
  <tr>
	<th class="thCornerL" width="22%" height="26">{L_AUTHOR}</th>
	<th class="thCornerR">{L_MESSAGE}</th>
  </tr>
  <!-- BEGIN postrow -->
  <tr>
	<td width="22%" align="left" valign="top" class="row1"><a class="name" name="{postrow.U_POST_ID}"></a><b class="name">{postrow.POSTER_NAME}</b></td>
	<td class="row1" height="28" valign="top"><table width="100%" cellspacing="0" cellpadding="0" border="0">
	  <tr> 
		<td width="100%"><span class="postdetails">
			<img src="{I_MINITIME}" alt="" title="{L_POSTED}" border="0" />{L_POSTED}: {postrow.POST_DATE}<br />
			<img src="{postrow.MINI_POST_IMG}" alt="" title="{postrow.L_MINI_POST_ALT}" border="0" />{L_POST_SUBJECT}: {postrow.POST_SUBJECT}
			<!-- BEGIN sub_title -->
			<br /><img src="{postrow.MINI_POST_IMG}" width="12" height="9" alt="" title="{L_SUB_TITLE}" border="0" />{L_SUB_TITLE}: {postrow.sub_title.SUB_TITLE}
			<!-- END sub_title -->
		</span></td>
	  </tr>
	  <tr> 
		<td colspan="2"><hr size="1" /></td>
	  </tr>
	  <tr> 
		<td colspan="2"><span class="postbody">{postrow.MESSAGE}</span>{postrow.ATTACHMENTS}</td>
	  </tr>
	</table></td>
  </tr>
  <tr> 
	<td colspan="2" height="1" class="spaceRow"><img src="{I_SPACER}" alt="" width="1" height="1" /></td>
  </tr>
  <!-- END postrow -->
</table>
<!-- BEGIN switch_inline_mode -->
	</iframe></td>
  </tr>
</table>
<!-- END switch_inline_mode -->
