<!-- VCARD BEGIN -->
<div class="bfi-ce-vcard">
    <div class="bfi-ce-vcard__header">
        <a href="<?php echo $args[ F12_CPT . "commercial-link" ]; ?>" title="Mehr erfahren">
            <img src="<?php echo $args[ F12_CPT . "commercial-image" ]; ?>"
                 alt="<?php echo $args[ F12_CPT . "commercial-title" ]; ?>">
        </a>
    </div>
    <div class="bfi-ce-vcard__content">
        <p>
			<?php
			echo $args[ F12_CPT . "commercial-housetype" ];
			?>
            &nbsp;
        </p>
        <p>
			<?php echo $args[ F12_CPT . "commercial-zip" ]; ?>
            &nbsp;<?php echo $args[ F12_CPT . "commercial-city" ]; ?><?php if ( ! empty( $args[ F12_CPT . "commercial-street" ] ) ) {
				echo ", " . $args[ F12_CPT . "commercial-street" ];
			} ?>
        </p>
        <p class="teaser">
			<?php if ( ! empty( $args[ F12_CPT . "commercial-price" ] ) ) : ?>
				<?php
				echo $args[ F12_CPT . "commercial-price" ];
				?> €
			<?php endif; ?>
            &nbsp;
        </p>
        <p>
			<?php if ( ! empty( $args[ F12_CPT . "commercial-price" ] ) ) : ?>
				<?php echo $args[ F12_CPT . "commercial-price-type" ]; ?>
			<?php endif; ?>
            &nbsp;
        </p>
        <p>
			<?php if ( ! empty( $args[ F12_CPT . "commercial-livingarea" ] ) ) : ?>
                Wohnfläche: <?php echo $args[ F12_CPT . "commercial-livingarea" ]; ?> m² |
			<?php endif; ?>
			<?php if ( ! empty( $args[ F12_CPT . "commercial-rooms" ] ) ) : ?>
                Zimmer: <?php echo $args[ F12_CPT . "commercial-rooms" ]; ?>
			<?php endif; ?>
            &nbsp;
        </p>
        <a href="<?php echo $args[ F12_CPT . "commercial-link" ]; ?>" class="bfi-button" title="Mehr erfahren">
            Mehr erfahren
        </a>
    </div>
</div>
<!-- VCARD END -->