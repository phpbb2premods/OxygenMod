
			<tr>
				<th class="thHead" colspan="2">{L_EXT_HOST_TITLE}</th>
	        </tr>
			<tr>
				<td class="row1" colspan="2"><span class="gensmall">{L_EXT_HOST_EXPLAIN}</span></td>
	        </tr>
	        <!-- BEGIN hoster_row -->
            <tr>
				<td class="row1"><span class="gen"><b>{hoster_row.L_EXT_HOST_NAME}</b></span></td>
				<!-- BEGIN switch_link -->
				<td class="row2"><span class="genmed"><input class="button" name="{hoster_row.L_EXT_HOST_NAME}" value=" {L_EXT_HOST_BUTTON} " onClick="window.open('{hoster_row.U_EXT_HOST_URL}','','')" type="button"></span></td>
				<!-- END switch_link -->
				<!-- BEGIN switch_ubc -->
				<td class="row2">{hoster_row.L_EXT_HOST_UBC}</td>
				<!-- END switch_ubc -->
			</tr>
			<!-- END hoster_row -->