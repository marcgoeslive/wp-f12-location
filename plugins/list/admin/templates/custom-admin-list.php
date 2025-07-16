<td class="label">
    <label>
		<?php echo $args["label"]; ?>
    </label>
</td>
<td>
    <select name="<?php echo $args["name"]; ?>">
        <option value="-1"><?php echo __( "Bitte wählen", "f12cl_commercial" ); ?></option>
		<?php foreach ( $args["items"] as $item ) :
			if ( $args["selected"] == $item->ID ) :?>
                <option value="<?php echo $item->ID; ?>" selected="selected"><?php echo $item->post_title; ?></option>
			<?php else : ?>
                <option value="<?php echo $item->ID; ?>"><?php echo $item->post_title; ?></option>
			<?php endif; ?>
		<?php endforeach; ?>
    </select>
</td>