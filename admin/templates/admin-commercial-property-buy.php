<div class="f12-panel">
	<div class="f12-panel__header">
		<h2>Kaufobjekte</h2>
		<p>
			Hier können Sie Einstellungen für Kaufobjekte vornehmen.
		</p>
	</div>
	<div class="f12-panel__content">
		<table class="f12-table">
			<tr>
				<td class="label" style="width:300px;">
					<label>Titel</label>
					<p>Definieren Sie einen Titel der über dem Slider Element angezeigt werden soll.</p>
				</td>
				<td>
					<input id="buy_title" type="text" name="buy_title" class="f12-form-validate"
					       validation='{"validation":{"required":true}}'
					       value="<?php echo $args["buy_title"]; ?>"/>
				</td>
			</tr>
			<tr>
				<th colspan="2">
					Alternativer Text
				</th>
			</tr>
			<tr>
				<td class="label">
					<label>Alternativer Titel</label>
					<p>Definieren Sie einen Titel der ausgegeben werden soll.</p>
				</td>
				<td>
					<input id="no_buy_title" type="text" name="no_buy_title" class="f12-form-validate"
					       validation='{"validation":{"required":true}}'
					       value="<?php echo $args["no_buy_title"]; ?>"/>
				</td>
			</tr>
			<tr>
				<td class="label">
					<label>Inhalt</label>
					<p>Legen Sie den Text fest der Ihren Besuchern angezeigt werden soll.</p>
				</td>
				<td>
					<?php echo wp_editor( $args["no_buy_text"], "no_buy_text" ); ?>
				</td>
			</tr>
		</table>
	</div>
</div>