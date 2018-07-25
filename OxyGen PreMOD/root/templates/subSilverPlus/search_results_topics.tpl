<table width="100%" cellspacing="2" cellpadding="2" border="0">
  <tr> 
	<td class="maintitle" valign="bottom">{L_SEARCH_MATCHES}</td>
  </tr>
</table>

<table width="100%" cellspacing="2" cellpadding="2" border="0">
  <tr> 
	<td class="nav"><a href="{U_INDEX}" class="nav">{L_INDEX}</a></td>
  </tr>
</table>

<table class="forumline" width="100%" cellpadding="4" cellspacing="1" border="0">
  <tr> 
	<th class="thCornerL" colspan="3" width="100%" height="25" nowrap="nowrap">&nbsp;{L_TOPICS}&nbsp;</th>
	<th class="thTop" width="50" nowrap="nowrap">&nbsp;{L_REPLIES}&nbsp;</th>
	<th class="thTop" width="100" nowrap="nowrap">&nbsp;{L_AUTHOR}&nbsp;</th>
	<th class="thTop" width="150" nowrap="nowrap">&nbsp;{L_CREATE_DATE}&nbsp;</th>
	<th class="thTop" width="50" nowrap="nowrap">&nbsp;{L_VIEWS}&nbsp;</th>
	<th class="thCornerR" width="200" nowrap="nowrap">&nbsp;{L_LASTPOST}&nbsp;</th>
  </tr>
  <!-- BEGIN searchresults -->
  <tr> 
	<td class="row1" align="center" valign="middle" width="20"><a href="{searchresults.U_VIEW_TOPIC}"><img src="{searchresults.TOPIC_FOLDER_IMG}" alt="{searchresults.L_TOPIC_FOLDER_ALT}" title="{searchresults.L_TOPIC_FOLDER_ALT}" border="0" /></a></td>
	<td class="row1" align="center" valign="middle" width="20">{searchresults.ICON}</td>
	<td class="{searchresults.HYPERCELL_CLASS}" width="100%">
		<span class="topictitle">{searchresults.NEWEST_POST_IMG}{searchresults.TOPIC_TYPE}<a href="{searchresults.U_VIEW_TOPIC}" class="topictitle">{searchresults.TOPIC_TITLE}</a></span><br />
		<!-- BEGIN sub_title -->
		<span class="gensmall">{searchresults.sub_title.SUB_TITLE}</span><br />
		<!-- END sub_title -->
		<span class="gensmall">[&nbsp;<a href="{searchresults.U_VIEW_FORUM}" title="{searchresults.FORUM_DESC}">{searchresults.FORUM_NAME}</a>&nbsp;]
		<br />{searchresults.GOTO_PAGE}</span>
	</td>
	<td class="row2" align="center" valign="middle"><span class="postdetails">{searchresults.REPLIES}</span></td>
	<td class="row3" align="center" valign="middle"><span class="name">{searchresults.TOPIC_AUTHOR}</span></td>
	<td class="row3" align="center" valign="middle"><span class="postdetails">{searchresults.FIRST_POST_TIME}</span></td>
	<td class="row2" align="center" valign="middle"><span class="postdetails">{searchresults.VIEWS}</span></td>
	<td class="{searchresults.HYPERCELL_CLASS}-right" align="center" valign="middle" nowrap="nowrap"><span class="postdetails">
		{searchresults.LAST_POST_TIME}<br />{searchresults.LAST_POST_AUTHOR} {searchresults.LAST_POST_IMG}
	</span></td>
  </tr>
  <!-- END searchresults -->
  <tr> 
	<td class="catBottom" colspan="8" height="28" valign="middle">&nbsp;</td>
  </tr>
</table>

<table width="100%" cellspacing="2" cellpadding="2" border="0">
  <tr> 
	<td align="left" valign="top"><span class="nav">{PAGE_NUMBER}</span></td>
	<td align="right" valign="top" nowrap="nowrap"><span class="nav">{PAGINATION}</span></td>
  </tr>
</table>

<table width="100%" cellspacing="2" cellpadding="0" border="0">
  <tr> 
	<td valign="top" align="right">{JUMPBOX}</td>
  </tr>
</table>
