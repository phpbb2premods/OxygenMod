<!-- BEGIN annonce_globale -->
  <table class="forumline" width="100%" cellpadding="4" cellspacing="1" border="0">
	<tr> 
	  <th class="thCornerL" colspan="3" align="center" width="100%" height="25" nowrap="nowrap">&nbsp;{annonce_globale.L_TOPICS}&nbsp;</th>
	  <th class="thTop" width="50" align="center" nowrap="nowrap">&nbsp;{annonce_globale.L_REPLIES}&nbsp;</th>
	  <th class="thTop" width="100" align="center" nowrap="nowrap">&nbsp;{annonce_globale.L_AUTHOR}&nbsp;</th>
	  <th class="thTop" width="150" align="center" nowrap="nowrap">&nbsp;{annonce_globale.L_CREATE_DATE}&nbsp;</th>
		<th class="thTop" width="50" align="center" nowrap="nowrap">&nbsp;{annonce_globale.L_VIEWS}&nbsp;</th>
	  <th class="thCornerR" width="200" align="center" nowrap="nowrap">&nbsp;{annonce_globale.L_LASTPOST}&nbsp;</th>
	</tr>
<!-- BEGIN row -->
<!-- BEGIN switch_post -->
	<tr>
	  <td class="row2" colspan="9" style="padding-left: 10px;"><span class="gensmall">{annonce_globale.row.switch_post.SPLIT_TYPE}</span></td>
	</tr>
<!-- END switch_post -->
	<tr> 
	  <td class="row1" align="center" valign="middle" width="20"><a href="{annonce_globale.row.U_VIEW_TOPIC}"><img src="{annonce_globale.row.TOPIC_FOLDER_IMG}" alt="{annonce_globale.row.L_TOPIC_FOLDER_ALT}" title="{annonce_globale.row.L_TOPIC_FOLDER_ALT}" /></a></td>
	  <td class="row1" align="center" valign="middle" width="20">{annonce_globale.row.ICON}</td>
	  <td class="{annonce_globale.row.HYPERCELL_CLASS}" width="100%">
		<span class="topictitle">{annonce_globale.row.NEWEST_POST_IMG}{annonce_globale.row.TOPIC_ATTACHMENT_IMG}<a href="{annonce_globale.row.U_VIEW_TOPIC}" class="topictitle">{annonce_globale.row.TOPIC_TITLE}</a></span>
		<!-- BEGIN sub_title -->
		<span class="gensmall"><br />{annonce_globale.row.sub_title.SUB_TITLE}</span>
		<!-- END sub_title -->
		<span class="gensmall"><br />{annonce_globale.row.GLOBAL_LINK}{annonce_globale.row.GOTO_PAGE}</span>
	  </td>
	  <td class="row2" align="center" valign="middle"><span class="postdetails">{annonce_globale.row.REPLIES}</span></td>
	  <td class="row3" align="center" valign="middle"><span class="name"><img src="images/flags/small/{annonce_globale.row.TOPIC_AUTHOR_FLAG}.png" width="14" height="9" title="{annonce_globale.row.TOPIC_AUTHOR_FLAG_ALT}" alt="{annonce_globale.row.TOPIC_AUTHOR_FLAG_ALT}" />&nbsp;{annonce_globale.row.TOPIC_AUTHOR}</span></td>
	  <td class="row3" align="center" valign="middle"><span class="postdetails">{annonce_globale.row.FIRST_POST_TIME}</span></td>
	  <td class="row2" align="center" valign="middle"><span class="postdetails">{annonce_globale.row.VIEWS}</span></td>
	  <td class="{annonce_globale.row.HYPERCELL_CLASS}-right" align="center" valign="middle" nowrap="nowrap"><span class="postdetails">
		{annonce_globale.row.LAST_POST_TIME}<br /><img src="images/flags/small/{annonce_globale.row.IP_CF_LAST_POST}.png" width="14" height="9" title="{annonce_globale.row.IP_CF_LAST_POST_ALT}" alt="{annonce_globale.row.IP_CF_LAST_POST_ALT}" />&nbsp;{annonce_globale.row.LAST_POST_AUTHOR} {annonce_globale.row.LAST_POST_IMG}
	  </span></td>
	</tr>
<!-- END row -->
  </table>
<br />
<!-- END annonce_globale -->
