<?php if ( - 1 != $args["value"] ) : ?>
	<div class="bfi-ce-list-table__row">
		<div class="bfi-ce-list-table__column">
			<?php echo $args["name"];?>
		</div>
		<div class="bfi-ce-list-table__column">
			<strong><?php echo F12LocationCommercialUtils::get_list_value_by_id( $args["value"] ); ?></strong>
		</div>
	</div>
<?php endif; ?>