<?php
///echo $args["f12cl_commercial_nonce"]
?>
<table class="f12-table">
	<tr>
		<td class="label" style="width:300px;">
			<label>PLZ</label>
		</td>
		<td style="width:400px;">
			<input type="text" name="<?php echo F12_CPT; ?>commercial-zip"  class="f12-form-validate" validation='{"validation":{"required":true}}'
			       value="<?php echo $args[ F12_CPT . "commercial-zip" ]; ?>"/>
		</td>
		<td class="label" style="width:300px;">
			<label>Ort</label>
		</td>
		<td>
			<input type="text" name="<?php echo F12_CPT; ?>commercial-city"  class="f12-form-validate" validation='{"validation":{"required":true}}'
			       value="<?php echo $args[ F12_CPT . "commercial-city" ]; ?>"/>
		</td>
	</tr>
	<tr>
		<td class="label">
			<label>Straße</label>
		</td>
		<td colspan="3">
			<input type="text" name="<?php echo F12_CPT; ?>commercial-street"
			       value="<?php echo $args[ F12_CPT . "commercial-street" ]; ?>"/>
		</td>
	</tr>
</table>