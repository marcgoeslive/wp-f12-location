<?php if ( isset( $args ) && isset( $args["name"] ) ) : ?>
    <div>
        <a
                href="#"
                data-key-output=".f12-image-picker-gallerie"
                data-key-id="<?php echo $args["name"]; ?>[]"
                class="f12-image-picker-upload-button button"
        >
            Upload image
        </a>
        <div class="f12-image-picker-gallerie">
			<?php echo $args["items"]; ?>
        </div>
    </div>
<?php endif; ?>