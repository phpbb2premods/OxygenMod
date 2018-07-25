<form method="post" action="{S_SPLIT_ACTION}">
  <table width="100%" cellspacing="2" cellpadding="2" border="0">
	<tr>
	  <td class="nav"><a href="{U_INDEX}" class="nav">{L_INDEX}</a> &raquo; <a href="{U_CAT}" class="nav">{CAT_NAME}</a> <!-- IF PARENT_FORUM --> &raquo; <a class="nav" href="{U_VIEW_PARENT_FORUM}">{PARENT_FORUM_NAME}</a> <!-- ENDIF --> &raquo; <a href="{U_VIEW_FORUM}" class="nav">{FORUM_NAME}</a></td>
	</tr>
  </table>
  <table class="forumline" width="100%" cellpadding="3" cellspacing="1" border="0">
	<tr>
	  <th class="thHead" height="25" colspan="3" nowrap="nowrap">{L_SPLIT_TOPIC}</th>
	</tr>
	<tr>
	  <td class="row2" colspan="3" align="center"><span class="gensmall">{L_SPLIT_TOPIC_EXPLAIN}</span></td>
	</tr>
	<tr>
	  <td class="row1" nowrap="nowrap"><span class="gen">{L_SPLIT_SUBJECT}</span></td>
	  <td class="row2" colspan="2"><input class="post" type="text" size="35" style="width: 350px" maxlength="60" name="subject" /></td>
	</tr>
	<tr>
	  <td class="row1" nowrap="nowrap"><span class="gen">{L_SPLIT_FORUM}</span></td>
	  <td class="row2" colspan="2">{S_FORUM_SELECT}</td>
	</tr>
	<tr>
	  <td class="catHead" colspan="3" height="28"><table width="100%" cellspacing="0" cellpadding="0" border="0" align="center">
		<tr>
		  <td width="100%" align="center">
			<input class="liteoption" type="submit" name="split_type_all" value="{L_SPLIT_POSTS}" />&nbsp;
			<input class="liteoption" type="submit" name="split_type_beyond" value="{L_SPLIT_AFTER}" />
		  </td>
		</tr>
	  </table></td>
	</tr>
	<tr>
	  <th class="thCornerL" nowrap="nowrap">{L_AUTHOR}</th>
	  <th class="thTop" nowrap="nowrap">{L_MESSAGE}</th>
	  <th class="thCornerR" nowrap="nowrap">{L_SELECT}</th>
	</tr>
	<!-- BEGIN postrow -->
	<tr>
	  <td class="row1" align="left" valign="top"><span class="name"><a name="{postrow.U_POST_ID}"></a>{postrow.POSTER_NAME}</span></td>
	  <td class="row1" width="100%" valign="top"><table width="100%" cellspacing="0" cellpadding="3" border="0">
		<tr>
		  <td valign="middle"><span class="postdetails">
			<img src="{I_MINITIME}" alt="{L_POSTED}">{L_POSTED}: {postrow.POST_DATE}<br />
			<img src="{I_MINIPOST}" alt="{L_POST}">{L_POST_SUBJECT}: {postrow.POST_SUBJECT}
		  </span></td>
		</tr>
		<tr>
		  <td valign="top">
			<hr size="1" />
			<span class="postbody">{postrow.MESSAGE}</span>
		  </td> 
		</tr>
	  </table></td>
	  <td class="row1" width="5%" align="center">{postrow.S_SPLIT_CHECKBOX}</td>
	</tr>
	<tr>
	  <td class="row3" colspan="3" height="1"><img src="{I_SPACER}" alt="" width="1" height="1" /></td>
	</tr>
	<!-- END postrow -->
	<tr>
	  <td class="catBottom" colspan="3" height="28"><table width="100%" cellspacing="0" cellpadding="0" border="0">
		<tr>
		  <td width="100%" align="center">
			{S_HIDDEN_FIELDS}
			<input class="liteoption" type="submit" name="split_type_all" value="{L_SPLIT_POSTS}" />&nbsp;
			<input class="liteoption" type="submit" name="split_type_beyond" value="{L_SPLIT_AFTER}" />
		  </td>
		</tr>
	  </table></td>
	</tr>
  </table>
</form>
