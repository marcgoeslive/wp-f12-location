<div class="f12-panel">
	<div class="f12-panel__header">
		<h2>Mietobjekte</h2>
		<p>
			Hier können Sie Einstellungen für Mietobjekte vornehmen.
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
					<input id="rent_title" type="text" name="rent_title" class="f12-form-validate"
					       validation='{"validation":{"required":true}}'
					       value="<?php echo $args["rent_title"]; ?>"/>
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
					<p>Definieren Sie einen Titel der ausgegeben werden soll wenn keine Mietobjekte vorhanden
						sind.</p>
				</td>
				<td>
					<input type="text" name="no_rent_title" class="f12-form-validate"
					       validation='{"validation":{"required":true}}'
					       value="<?php echo $args["no_rent_title"]; ?>"/>
				</td>
			</tr>
			<tr>
				<td class="label">
					<label>Inhalt</label>
					<p>Legen Sie den Text fest der Ihren Besuchern angezeigt werden soll wenn keine Mietobjekte
						vorhanden sind.</p>
				</td>
				<td>
					<?php echo wp_editor( $args["no_rent_text"], "no_rent_text", array( "editor_class" => "f12-form-validate" ) ); ?>
				</td>
			</tr>
		</table>
	</div>
</div>
