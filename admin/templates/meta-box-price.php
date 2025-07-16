<?php
///echo $args["f12cl_commercial_nonce"]
?>
<table class="f12-table">
	<tr>
		<td class="label" style="width:300px;">
			<label>Bezugsfrei ab</label>
		</td>
		<td>
			<script type="text/javascript">
                jQuery(document).ready(function ($) {
                    $("#<?php echo F12_CPT;?>commercial-movein").datepicker({dateFormat: "dd-mm-yy"});
                });
			</script>
			<input type="text" id="<?php echo F12_CPT; ?>commercial-movein"
			       name="<?php echo F12_CPT; ?>commercial-movein"
			       value="<?php echo $args[ F12_CPT . "commercial-movein" ]; ?>"/>
		</td>
	</tr>
	<tr>
		<td class="label" >
			<label>Preis</label>
		</td>
		<td>
			<input type="text" name="<?php echo F12_CPT; ?>commercial-price"
			       value="<?php echo $args[ F12_CPT . "commercial-price" ]; ?>"/>
		</td>
	</tr>
	<tr>
		<td class="label">
			<label>Provision für Käufer</label>
		</td>
		<td>
			<?php
			wp_editor( $args[ F12_CPT . "commercial-provision" ], F12_CPT . "commercial-provision" );
			?>
		</td>
	</tr>
</table>