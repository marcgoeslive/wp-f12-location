<?php
///echo $args["f12cl_commercial_nonce"]
?>
<table class="f12-table">
    <tr>
        <td class="label" style="width:300px;">
            <label>Kategorie</label>
        </td>
        <td style="width:400px;">
            <input type="radio" name="<?php echo F12_CPT; ?>category" class="f12-form-validate f12-property-category"
                   validation='{"validation":{"required":true}}'
                   value="1" <?php if ( $args[ F12_CPT . "category" ] == 1 ) {
				echo "checked=\"checked\"";
			} ?> > <span>Default</span><br><br>

			<?php
			// Kategorien ausgeben
			if ( isset( $args[ F12_CPT . "categories" ] ) ):
				foreach ( $args[ F12_CPT . "categories" ] as $item /** @var $item WP_Post */ ):
					?>
                    <input type="radio" id="<?php echo $item->post_name; ?>" name="<?php echo F12_CPT; ?>category"
                           class="f12-form-validate f12-property-category"
                           validation='{"validation":{"required":true}}'
                           value="<?php echo $item->ID; ?>" <?php if ( $args[ F12_CPT . "category" ] == $item->ID ) {
						echo "checked=\"checked\"";
					} ?> > <label for="<?php echo $item->post_name; ?>"><?php echo $item->post_title; ?></label><br><br>
				<?php
				endforeach;
			endif;
			?>
        </td>
        <td class="label" style="width:300px;">
            <label>Miete / Kauf</label>
        </td>
        <td>
            <input type="radio" name="<?php echo F12_CPT; ?>commercial-price-type" class="f12-form-validate"
                   validation='{"validation":{"required":true}}'
                   value="rent" <?php if ( $args[ F12_CPT . "commercial-price-type" ] == "rent" ) {
				echo "checked=\"checked\"";
			} ?>/> <span>Miete</span><br><br>
            <input type="radio" name="<?php echo F12_CPT; ?>commercial-price-type" class="f12-form-validate"
                   validation='{"validation":{"required":true}}'
                   value="buy" <?php if ( $args[ F12_CPT . "commercial-price-type" ] == "buy" ) {
				echo "checked=\"checked\"";
			} ?>/> <span>Kauf</span>
        </td>
    </tr>
    <tr>
        <td class="label">
            <label>Veröffentlichen?</label>
            <p>
                Wenn Sie das Objekt veröffentlichen wird es auf der Gewerbe- bzw. Wohnimmobilienseite angezeigt.
            </p>
        </td>
        <td colspan="3">
            <input type="checkbox" name="<?php echo F12_CPT; ?>commercial-public" value="1"
				<?php if ( isset( $args[ F12_CPT . "commercial-public" ] ) && $args[ F12_CPT . "commercial-public" ] == 1 ) {
					echo "checked=\"checked\"";
				} ?>
            > Ja, das Objekt soll auf der Webseite öffentlich sichtbar sein.
        </td>
    </tr>
</table>