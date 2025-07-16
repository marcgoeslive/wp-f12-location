<td class="label" style="width:300px;">
    <label>
		<?php echo $args["label"]; ?>
    </label>
</td>
<td style="width:350px;" <?php if ( isset( $args["colspan"] ) ): ?> colspan="<?php echo $args["colspan"]; ?>" <?php endif; ?>>
	<?php
	wp_editor( $args["value"], $args["name"] );
	?>
</td>