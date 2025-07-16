<div class="f12-panel">
	<div class="f12-panel__header">
		<h2>
			<?php echo __( "Standardbilder", "f12cl_commercial" ); ?>
		</h2>
		<p>
			<?php echo __( "Hier können Sie Standardbilder ändern.", "f12cl_commercial" ); ?>
		</p>
	</div>
	<div class="f12-panel__content">
		<table class="f12-table">
			<tr>
				<td class="label" style="width:300px;">
					<label>Immobilien</label>
					<p>Standardbild für Immobilien falls nicht angelegt.</p>
				</td>
				<td>
					<?php echo $args["default-image"]; ?>
				</td>
			</tr>
		</table>
	</div>
</div>