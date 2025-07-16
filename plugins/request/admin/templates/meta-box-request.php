<?php echo $args["wp_nonce_field"]; ?>
<table class="f12-table">
    <tr>
        <td class="label">
            <label>Vor- / Nachanme</label>
        </td>
        <td>
            <input type="text" name="<?php echo F12_CPT . "request-name"; ?>"
                   value="<?php echo $args[ F12_CPT . "request-name" ]; ?>"/>
        </td>
    </tr>
    <tr>
        <td class="label">
            <label>E-Mail</label>
        </td>
        <td>
            <input type="text" name="<?php echo F12_CPT . "request-email"; ?>"
                   value="<?php echo $args[ F12_CPT . "request-email" ]; ?>"/>
        </td>
    </tr>
    <tr>
        <td class="label">
            <label>Telefon</label>
        </td>
        <td>
            <input type="text" name="<?php echo F12_CPT . "request-phone"; ?>"
                   value="<?php echo $args[ F12_CPT . "request-phone" ]; ?>"/>
        </td>
    </tr>
    <tr>
        <td class="label">
            <label>Stadt</label>
        </td>
        <td>
            <input type="text" name="<?php echo F12_CPT . "request-city"; ?>"
                   value="<?php echo $args[ F12_CPT . "request-city" ]; ?>"/>
        </td>
    </tr>
    <tr>
        <td class="label">
            <label>Straße</label>
        </td>
        <td>
            <input type="text" name="<?php echo F12_CPT . "request-street"; ?>"
                   value="<?php echo $args[ F12_CPT . "request-street" ]; ?>"/>
        </td>
    </tr>
    <tr>
        <td class="label">
            <label>Nachricht</label>
        </td>
        <td>
			<?php
			echo wp_editor( $args[ F12_CPT . "request-message" ], F12_CPT . "request-message" );
			?>
        </td>
    </tr>
    <tr>
        <td class="label">
            <label>Immobilienobjekt</label>
        </td>
        <td>
            <div class="f12-panel">
				<?php
				$location = get_post( $args[ F12_CPT . "request-object" ] );
				?>
                <table class="f12-table">
                    <tr>
                        <td class="label">
                            ID:
                        </td>
                        <td>
                            <input type="text" name="<?php echo F12_CPT . "request-object"; ?>"
                                   value="<?php echo $args[ F12_CPT . "request-object" ]; ?>"/>
                        </td>
                    </tr>
                    <tr>
                        <td class="label">
                            Name:
                        </td>
                        <td>
							<?php
							if ( $location ) {
								echo "<a href='" . get_edit_post_link( $location->ID ) . "'>" . $location->post_title . "</a>";
							}
							?>
                        </td>
                    </tr>
                    <tr>
                        <td class="label">
                            Bild:
                        </td>
                        <td>
							<?php
							$images = get_post_meta( $args[ F12_CPT . "request-object" ], F12_CPT . "commercial-images", true );
							if ( ! empty( $images ) ) {
								$images = explode( ",", $images );
								$images = wp_get_attachment_image( $images[0] );
								echo $images;
							}
							?>
                        </td>
                    </tr>
                </table>
            </div>
        </td>
    </tr>
    <tr>
        <td class="label">
            <label>IP-Addresse</label>
        </td>
        <td>
            <input type="text" name="<?php echo F12_CPT . "request-ip"; ?>"
                   value="<?php echo $args[ F12_CPT . "request-ip" ]; ?>"/>
        </td>
    </tr>
</table>