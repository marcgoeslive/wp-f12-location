<?php echo $args["wp-nonce-field"]; ?>
<table class="f12-table">
	<tr>
		<td class="label" style="width:300px;">
			<label><?php echo __("Gruppe", "f12cl_commercial"); ?></label>
			<p><?php echo __("Die Gruppe zu der dieses Listen Element zugeordnet wurde", "f12cl_commercial");?></p>
		</td>
		<td>
			<select name="list-item-group">
				<?php echo $args["list-item-group"];?>
			</select>
		</td>
	</tr>
</table>