<h1>{L_FORUM_TITLE}</h1>

<p>{L_FORUM_EXPLAIN}</p>

<form method="post" action="{S_FORUM_ACTION}">
  <table class="forumline" width="100%" cellspacing="1" cellpadding="3" border="0">
	<tr>
	  <th class="thHead" colspan="7">{L_FORUM_TITLE}</th>
	</tr>
	<!-- BEGIN catrow -->
	<tr>
	  <td class="catLeft" colspan="3"><b class="cattitle"><a href="{catrow.U_VIEWCAT}">{catrow.CAT_DESC}</a></b></td>
	  <td class="cat" align="center" valign="middle"><span class="gen"><a href="{catrow.U_CAT_EDIT}">{L_EDIT}</a></span></td>
	  <td class="cat" align="center" valign="middle"><span class="gen"><a href="{catrow.U_CAT_DELETE}">{L_DELETE}</a></span></td>
	  <td class="cat" align="center" valign="middle" nowrap="nowrap"><span class="gen">
		<a href="{catrow.U_CAT_MOVE_UP}">{L_MOVE_UP}</a>
		<a href="{catrow.U_CAT_MOVE_DOWN}">{L_MOVE_DOWN}</a>
	  </span></td>
	  <td class="catRight" align="center" valign="middle"><span class="gen">&nbsp;</span></td>
	</tr>
	<!-- BEGIN forumrow -->
	<tr> 
	  <td class="row2">
			<!-- BEGIN tree_cross -->
			<table border="0" cellpadding="0" cellspacing="0" width="100%"><tr>
			<td><img src="{catrow.forumrow.tree_cross.FORUM_TREE_IMG}" border="0" alt="" title="" /></td></td><td><span class="gen">&nbsp;</span></td><td valign="middle" width="100%">
			<!-- END tree_cross -->
				<table border="0" cellpadding="0" cellspacing="0" width="100%"><tr>
				<td>{catrow.forumrow.FORUM_ICON_IMG}</td>
				<td width="100%">
					<span {catrow.forumrow.FORUM_COLOR} class="gen">&nbsp;&nbsp;<a href="{catrow.forumrow.U_VIEWFORUM}" target="_new" {catrow.forumrow.FORUM_COLOR}>{catrow.forumrow.FORUM_NAME}</a></span><br />
					<span class="gensmall">&nbsp;&nbsp;{catrow.forumrow.FORUM_DESC}</span>
				</td>
				</tr></table>
			<!-- BEGIN tree_cross -->
			</td></tr></table>
			<!-- END tree_cross -->
	  </td>
	  <td class="row1" align="center" valign="middle"><span class="gen">{catrow.forumrow.NUM_TOPICS}</span></td>
	  <td class="row2" align="center" valign="middle"><span class="gen">{catrow.forumrow.NUM_POSTS}</span></td>
	  <td class="row1" align="center" valign="middle"><span class="gen"><a href="{catrow.forumrow.U_FORUM_EDIT}">{L_EDIT}</a></span></td>
	  <td class="row2" align="center" valign="middle"><span class="gen"><a href="{catrow.forumrow.U_FORUM_DELETE}">{L_DELETE}</a></span></td>
	  <td class="row1" align="center" valign="middle"><span class="gen">
		<a href="{catrow.forumrow.U_FORUM_MOVE_UP}">{L_MOVE_UP}</a><br />
		<a href="{catrow.forumrow.U_FORUM_MOVE_DOWN}">{L_MOVE_DOWN}</a>
	  </span></td>
	  <td class="row2" align="center" valign="middle"><span class="gen"><a href="{catrow.forumrow.U_FORUM_RESYNC}">{L_RESYNC}</a></span></td>
	</tr>
	<!-- END forumrow -->
	<tr>
	  <td colspan="7" class="row2">
		<input class="post" type="text" name="{catrow.S_ADD_FORUM_NAME}" />
		<input type="submit" class="liteoption" name="{catrow.S_ADD_FORUM_SUBMIT}" value="{L_CREATE_FORUM}" />
	  </td>
	</tr>
	<tr>
	  <td colspan="7" height="1" class="spaceRow"><img src="../{I_SPACER}" alt="" width="1" height="1" /></td>
	</tr>
	<!-- END catrow -->
	<tr>
	  <td colspan="7" class="catBottom">
		<input class="post" type="text" name="categoryname" />&nbsp;
		<input type="submit" class="liteoption" name="addcategory" value="{L_CREATE_CATEGORY}" />
	  </td>
	</tr>
  </table>
</form>
