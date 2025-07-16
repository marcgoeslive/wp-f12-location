<td class="label" style="width:300px;">
	<label>
		<?php echo $args["label"]; ?>
	</label>
</td>
<td style="width:350px;">
	<input type="checkbox" value="1" name="<?php echo $args["name"]; ?>" <?php if(isset($args["value"]) && $args["value"] == 1) echo "checked=\checked\"";?> />
</td>