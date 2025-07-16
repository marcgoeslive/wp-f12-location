<div class="f12-panel">
	<div class="f12-panel__header">
		<h2>Gewerbeimmobilien</h2>
		<p>
			Hier können Sie Einstellungen für Gewerbeimmobilien vornehmen.
		</p>
	</div>
	<div class="f12-panel__content">
		<table class="f12-table">
			<tr>
				<td class="label" style="width:300px;">
					<label>Übersichtsseite</label>
					<p>Legen Sie fest, welche Seite als Überssichtsseite dienen soll</p>
				</td>
				<td>
					<select name="location_commercial_page_overview" class="f12-form-validate"
					        validation='{"validation":{"required":true}}'>
						<?php echo $args["location_commercial_page_overview"]; ?>
					</select>
				</td>
			</tr>
			<tr>
				<td class="label">
					<label>Detailseite</label>
					<p>Legen Sie fest, welche Seite als Detailseite dienen soll</p>
				</td>
				<td>
					<select name="location_commercial_page_detail" class="f12-form-validate"
					        validation='{"validation":{"required":true}}'>
						<?php echo $args["location_commercial_page_detail"]; ?>
					</select>
				</td>
			</tr>
			<tr>
				<td class="label" style="width:300px;">
					<label>Hintergrundbild</label>
					<p>Hintergrundbild für die Galerie auf der Gewerbeimmobilien Seite</p>
				</td>
				<td>
					<?php echo $args["location-commercial-image"]; ?>
				</td>
			</tr>
		</table>
	</div>
</div>