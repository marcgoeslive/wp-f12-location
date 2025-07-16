<?php if ( "" != $args["value"] ) : ?>
	<div class="bfi-ce-list-table__row">
		<div class="bfi-ce-list-table__column">
			<?php echo $args["name"];?>
		</div>
		<div class="bfi-ce-list-table__column">
			<strong><?php echo $args["value"]; ?></strong>
		</div>
	</div>
<?php endif; ?>