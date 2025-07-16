<?php
if ( isset( $args ) && isset( $args["id"] ) && isset( $args["src"] ) && isset( $args["name"] ) ):
	?>
    <div data-key="<?php echo $args["id"]; ?>">
        <img class="true_pre_image" src="<?php echo $args["src"]; ?>" style="max-width:30%;display:block;">
        <a href="javascript:void(0);" class="f12-image-picker-remove-button">Bild entfernen</a>
        <input type="hidden" name="<?php echo $args["name"]; ?>[]" value="<?php echo $args["id"]; ?>">
    </div>
<?php endif; ?>