<?php if ( "" != $args["value"] ) : ?>
    <div class="bfi-wrapper-default bfi-ce-text-inline">
        <div class="bfi-ce-text-inline__header">
            <h2>
	            <?php echo $args["name"];?>
            </h2>
        </div>
        <div class="bfi-ce-text-inline__content">
	        <?php echo wpautop($args["value"]); ?>
        </div>
    </div>
<?php endif; ?>
