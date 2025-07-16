<?php
/**
 * The template for displaying the home screen
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages and that
 * other "pages" on your WordPress site will use a different template.
 *
 * @package WordPress
 * @subpackage BFI
 * @since BFI 1.0
 */ ?>
<!-- LAYOUT CONTENT BEGIN -->
<div class="bfi-content bfi-page__wohnimmobilien-details">
    <!-- WRAPPER SPLITTER BEGIN -->
    <div class="bfi-wrapper-default bfi-wrapper-default--flex">
        <!-- OPTION BAR BEGIN -->
        <div class="bfi-wrapper-650 bfi-ce-bar-option bfi-mobile">
            <!-- OPTION BAR ITEM BEGIN -->
            <div class="bfi-ce-bar-option__item">
                <a href="<?php echo $args["previous-page"]["url"]; ?>"
                   class="bfi-button-iconized bfi-button-iconized--small"
                   title="Gehe zu <?php echo $args["previous-page"]["name"]; ?>">
                    <i class="ic-arrow--left"></i>
                    <span>Vorheriges Objekt</span>
                </a>
            </div>
            <!-- OPTION BAR ITEM END -->
            <!-- OPTION BAR ITEM BEGIN -->
            <div class="bfi-ce-bar-option__item">
                <a href="<?php echo $args["page-data"]["url"]; ?>"
                   class="bfi-button-iconized bfi-button-iconized--small"
                   title="<?php echo $args["page-data"]["title"]; ?>">
                    <i class="ic-overview"></i>
                    <span>Zurück zur Übersicht</span>
                </a>
            </div>
            <!-- OPTION BAR ITEM END -->
            <!-- OPTION BAR ITEM BEGIN -->
            <div class="bfi-ce-bar-option__item">
                <a href="<?php echo $args["next-page"]["url"]; ?>"
                   class="bfi-button-iconized bfi-button-iconized--small"
                   title="Gehe zu <?php echo $args["next-page"]["name"]; ?>">
                    <span>Nächstes Objekt</span>
                    <i class="ic-arrow--right"></i>
                </a>
            </div>
            <!-- OPTION BAR ITEM END -->
        </div>
        <!-- OPTION BAR END -->
        <!-- VCARD MOBILE BEGIN -->
        <div class="bfi-wrapper-default bfi-location-vcard bfi-mobile">
            <div class="bfi-ce-text-inline">
                <div class="bfi-ce-text-inline__content">
                    <h1><?php echo $args["title"]; ?> <i class="ic-print"></i></h1>
					<?php if ( ! empty( $args["zip"] ) || ! empty( $args["city"] ) ) : ?>
                        <h2>
                            <i class="ic-location"></i>
							<?php
							$zip    = $args["zip"];
							$city   = $args["city"];
							$street = $args["street"];

							if ( empty( $street ) ) {
								echo $zip . " " . $city;
							} else {
								echo $zip . " " . $city . ", " . $street;
							}
							?>
                        </h2>
					<?php endif; ?>
                    <ul class="bfi-list-column bfi-list-column--full">
						<?php if ( ! empty( $args["price"] ) ) : ?>
                            <li>
                                <p class="teaser"><?php echo $args["price"] ?>
                                    €</p>
                                <p>
                                <p><?php echo $args["price-type"]; ?></p>
                                </p>
                            </li>
						<?php endif; ?>
						<?php if ( ! empty( $args["rooms"] ) ) : ?>
                            <li>
                                <p class="teaser"><?php echo $args["rooms"] ?> </p>
                                <p>Zimmer</p>
                            </li>
						<?php endif; ?>
						<?php if ( ! empty( $args["livingarea"] ) ) : ?>
                            <li>
                                <p class="teaser"><?php echo $args["livingarea"] ?>
                                    m²</p>
                                <p>Wohnfläche</p>
                            </li>
						<?php endif; ?>
						<?php if ( ! empty( $args["property"] ) ) : ?>
                            <li>
                                <p class="teaser"><?php echo $args["property"]; ?>
                                    m²</p>
                                <p>Grundstück</p>
                            </li>
						<?php endif; ?>
                    </ul>
                </div>
            </div>
        </div>
        <!-- VCARD MOBILE END -->


		<?php
		$attachments = $args["images"];

		if ( empty( $attachments ) || ! isset( $attachments[0] ) || empty( $attachments[0] ) ) {
			$attachments = array( get_option( "f12cl_settings" )["default-image"] );
		}

		$image_src  = wp_get_attachment_image_src( $attachments[0], "" )[0];
		$image_meta = wp_get_attachment_metadata( $attachments[0] );
		$image_alt  = $image_meta["image_meta"]["title"];
		?>

        <!-- WRAPPER LEFT SIDE BEGIN -->
        <div class="bfi-wrapper-default__half">
            <!-- COMPONENT IMAGE GALERIE BEGIN -->
            <div class="bfi-ce-image-galerie">

                <div class="bfi-ce-image-galerie__header">
                    <button class="bfi-button-left">
                        <i class="ic-arrow--left"></i>
                    </button>
                    <div class="bfi-ce-image-galerie__item">
                        <img src="<?php echo $image_src; ?>" alt="<?php echo $image_alt; ?>">
                    </div>
                    <button class="bfi-button-right">
                        <i class="ic-arrow--right"></i>
                    </button>
                </div>

                <div class="bfi-ce-image-galerie__list">
					<?php
					$i                    = 0;
					foreach ( $attachments as $attachment ) :
						$image_src = wp_get_attachment_image_src( $attachment, "" )[0];
						if ( $image_src != null ):
							$image_meta = wp_get_attachment_metadata( $attachment );
							$image_alt    = $image_meta["image_meta"]["title"];
							$image_active = ( $i == 0 ) ? "active" : "";

							?>
                            <div class="bfi-ce-image-galerie__item <?php echo $image_active; ?>">
                                <img src="<?php echo $image_src; ?>"
                                     alt="<?php echo $image_alt; ?>">
                            </div>
							<?php
							$i ++;
						endif;
					endforeach;
					?>
                </div>

            </div>
            <!-- COMPONENT IMAGE GALERIE RIGHT -->
            <!-- OPTION BAR BEGIN -->
			<?php
			if ( isset( $args["request-page"] ) && $args["request-page"] != - 1 ) :
				?>
                <div class="bfi-wrapper-default bfi-ce-bar-option">
                    <!-- OPTION BAR ITEM BEGIN -->
                    <div class="bfi-ce-bar-option__item bfi-ce-bar-option__item--full">
                        <a href="javascript:void(0);" class="bfi-button-iconized modular-objectrequest"
                           title="Objektanfrage">
                            <i class="ic-mail"></i>
                            <span>Objektanfrage</span>
                        </a>
                    </div>
                    <!-- OPTION BAR ITEM END -->
                </div>
                <!-- OPTION BAR END -->
			<?php
			endif;
			?>

            <div class="bfi-mobile bfi-ce-location-attributes">
				<?php
				if ( ! empty( $args["equipment"] ) ) :
					?>
                    <h2>Ausstattung</h2>
                    <ul class="bfi-ce-list-square bfi-list-square--half">
						<?php
						foreach ( $args["equipment"] as $item ) :
							?>
                            <li>
								<?php echo $item->name; ?>
                            </li>
						<?php
						endforeach;
						?>
                    </ul>
				<?php endif; ?>

                <!-- LIST TABLE BEGIN -->
                <div class="bfi-ce-list-table bfi-wrapper-default">
					<?php if ( - 1 != $args["housetype"] ) : ?>
                        <div class="bfi-ce-list-table__row">
                            <div class="bfi-ce-list-table__column">
                                Haustyp
                            </div>
                            <div class="bfi-ce-list-table__column">
                                <strong><?php echo F12LocationCommercialUtils::get_list_value_by_id( $args["housetype"] ); ?></strong>
                            </div>
                        </div>
					<?php endif; ?>
					<?php if ( ! empty( $args["floors"] ) ) : ?>
                        <div class="bfi-ce-list-table__row">
                            <div class="bfi-ce-list-table__column">
                                Etagenanzahl
                            </div>
                            <div class="bfi-ce-list-table__column">
                                <strong><?php echo $args["floors"]; ?></strong>
                            </div>
                        </div>
					<?php endif; ?>
					<?php if ( ! empty( $args["livingarea"] ) ) : ?>
                        <div class="bfi-ce-list-table__row">
                            <div class="bfi-ce-list-table__column">
                                Wohnfläche ca.
                            </div>
                            <div class="bfi-ce-list-table__column">
                                <strong><?php echo $args["livingarea"]; ?>
                                    m²</strong>
                            </div>
                        </div>
					<?php endif; ?>
					<?php if ( ! empty( $args["property"] ) ) : ?>
                        <div class="bfi-ce-list-table__row">
                            <div class="bfi-ce-list-table__column">
                                Grundstücksfläche ca.
                            </div>
                            <div class="bfi-ce-list-table__column">
                                <strong><?php echo $args["property"]; ?>
                                    m²</strong>
                            </div>
                        </div>
					<?php endif; ?>
					<?php if ( ! empty( $args["movein"] ) ) : ?>
                        <div class="bfi-ce-list-table__row">
                            <div class="bfi-ce-list-table__column">
                                Bezugsfrei ab
                            </div>
                            <div class="bfi-ce-list-table__column">
                                <strong><?php echo str_replace( "-", ".", $args["movein"] ); ?></strong>
                            </div>
                        </div>
					<?php endif; ?>
					<?php if ( ! empty( $args["rooms"] ) ) : ?>
                        <div class="bfi-ce-list-table__row">
                            <div class="bfi-ce-list-table__column">
                                Zimmer
                            </div>
                            <div class="bfi-ce-list-table__column">
                                <strong><?php echo $args["rooms"] ?></strong>
                            </div>
                        </div>
					<?php endif; ?>
					<?php if ( ! empty( $args["bedroom"] ) ) : ?>
                        <div class="bfi-ce-list-table__row">
                            <div class="bfi-ce-list-table__column">
                                Schlafzimmer
                            </div>
                            <div class="bfi-ce-list-table__column">
                                <strong><?php echo $args["bedroom"]; ?></strong>
                            </div>
                        </div>
					<?php endif; ?>
					<?php if ( ! empty( $args["bathroom"] ) ) : ?>
                        <div class="bfi-ce-list-table__row">
                            <div class="bfi-ce-list-table__column">
                                Badezimmer
                            </div>
                            <div class="bfi-ce-list-table__column">
                                <strong><?php echo $args["bathroom"]; ?></strong>
                            </div>
                        </div>
					<?php endif; ?>
					<?php if ( $args["garage"] != - 1 ) : ?>
                        <div class="bfi-ce-list-table__row">
                            <div class="bfi-ce-list-table__column">
                                Garage/Stellplatz
                            </div>
                            <div class="bfi-ce-list-table__column">
                                <strong><?php echo F12LocationCommercialUtils::get_list_value_by_id( $args["garage"] ); ?></strong>
                            </div>
                        </div>
					<?php endif; ?>
                </div>
                <!-- LIST TABLE END -->
                <!-- LIST TABLE BEGIN -->
				<?php
				if (
					! empty( $args["price"] ) ||
					! empty( $args["provision"] )
				) :
					?>
                    <div class="bfi-ce-list-table bfi-wrapper-default">
                        <h2>
                            Kosten
                        </h2>
						<?php if ( ! $args["price"] ) : ?>
                            <div class="bfi-ce-list-table__row">
                                <div class="bfi-ce-list-table__column">
                                    <p><?php echo F12LocationCommercialUtils::get_price_type_by_value( $args["price-type"] ); ?></p>
                                </div>
                                <div class="bfi-ce-list-table__column">
                                    <strong><?php echo $args["price"]; ?>
                                        €</strong>
                                </div>
                            </div>
						<?php endif; ?>
						<?php if ( ! empty( $args["provision"] ) ) : ?>
                            <div class="bfi-ce-list-table__row">
                                <div class="bfi-ce-list-table__column">
                                    Provision für <?php
									if ( $args["price-type"] == "rent" ) : ?>
                                        Mieter
									<?php else : ?>
                                        Käufer
									<?php endif; ?>
                                </div>
                                <div class="bfi-ce-list-table__column">
									<?php echo $args["provision"]; ?>
                                </div>
                            </div>
						<?php endif; ?>
                    </div>
				<?php endif; ?>
                <!-- LIST TABLE END -->
                <!-- LIST TABLE BEGIN -->
				<?php if (
					- 1 != $args["buildyear"] ||
					- 1 != $args["object-condition"] ||
					- 1 != $args["equipment-condition"] ||
					- 1 != $args["heater"] ||
					- 1 != $args["energy"] ||
					- 1 != $args["energy-pass"] ||
					- 1 != $args["energy-pass-type"] ||
					! empty( $args["energy-consumption"] )
				) : ?>
                    <div class="bfi-ce-list-table bfi-wrapper-default">
                        <h2>
                            Bausubstanz & Energieausweis
                        </h2>
						<?php if ( - 1 != $args["buildyear"] ) : ?>
                            <div class="bfi-ce-list-table__row">
                                <div class="bfi-ce-list-table__column">
                                    Baujahr
                                </div>
                                <div class="bfi-ce-list-table__column">
                                    <strong><?php echo $args["buildyear"]; ?></strong>
                                </div>
                            </div>
						<?php endif; ?>
						<?php if ( - 1 != $args["object-condition"] ) : ?>
                            <div class="bfi-ce-list-table__row">
                                <div class="bfi-ce-list-table__column">
                                    Objektzustand
                                </div>
                                <div class="bfi-ce-list-table__column">
                                    <strong><?php echo F12LocationCommercialUtils::get_list_value_by_id( $args["object-condition"] ); ?></strong>
                                </div>
                            </div>
						<?php endif; ?>
						<?php if ( - 1 != $args["equipment-condition"] ) : ?>
                            <div class="bfi-ce-list-table__row">
                                <div class="bfi-ce-list-table__column">
                                    Qualität der Ausstattung
                                </div>
                                <div class="bfi-ce-list-table__column">
                                    <strong><?php echo F12LocationCommercialUtils::get_list_value_by_id( $args["equipment-condition"] ); ?></strong>
                                </div>
                            </div>
						<?php endif; ?>
						<?php if ( - 1 != $args["heater"] ) : ?>
                            <div class="bfi-ce-list-table__row">
                                <div class="bfi-ce-list-table__column">
                                    Heizungsart
                                </div>
                                <div class="bfi-ce-list-table__column">
                                    <strong><?php echo F12LocationCommercialUtils::get_list_value_by_id( $args["heater"] ); ?></strong>
                                </div>
                            </div>
						<?php endif; ?>
						<?php if ( - 1 != $args["energy"] ) : ?>
                            <div class="bfi-ce-list-table__row">
                                <div class="bfi-ce-list-table__column">
                                    Wesentlicher Energieträger
                                </div>
                                <div class="bfi-ce-list-table__column">
                                    <strong><?php echo F12LocationCommercialUtils::get_list_value_by_id( $args["energy"] ); ?></strong>
                                </div>
                            </div>
						<?php endif; ?>
						<?php if ( - 1 != $args["energy-pass"] ) : ?>
                            <div class="bfi-ce-list-table__row">
                                <div class="bfi-ce-list-table__column">
                                    Energieausweis
                                </div>
                                <div class="bfi-ce-list-table__column">
                                    <strong><?php echo F12LocationCommercialUtils::get_list_value_by_id( $args["energy-pass"] ); ?></strong>
                                </div>
                            </div>
						<?php endif; ?>
						<?php if ( - 1 != $args["energy-pass-type"] ) : ?>
                            <div class="bfi-ce-list-table__row">
                                <div class="bfi-ce-list-table__column">
                                    Energieausweistyp
                                </div>
                                <div class="bfi-ce-list-table__column">
                                    <strong><?php echo F12LocationCommercialUtils::get_list_value_by_id( $args["energy-pass-type"] ); ?></strong>
                                </div>
                            </div>
						<?php endif; ?>
						<?php if ( ! empty( $args["energy-consumption"] ) ) : ?>
                            <div class="bfi-ce-list-table__row">
                                <div class="bfi-ce-list-table__column">
                                    Endenenergieverbrauch
                                </div>
                                <div class="bfi-ce-list-table__column">
                                    <strong><?php echo $args["energy-consumption"] ?></strong>
                                </div>
                            </div>
						<?php endif; ?>
                    </div>
                    <!-- LIST TABLE END -->
				<?php endif; ?>
            </div>
            <!-- COMPONENT TEXT INLINE BEGIN -->
			<?php if ( ! empty( $args["description"] ) ) : ?>
                <div class="bfi-wrapper-default bfi-ce-text-inline">
                    <div class="bfi-ce-text-inline__header">
                        <h2>
                            Objektbeschreibung
                        </h2>
                    </div>
                    <div class="bfi-ce-text-inline__content">
						<?php echo wpautop( $args["description"] ); ?>
                    </div>
                </div>
			<?php endif; ?>
            <!-- COMPONENT TEXT INLINE END -->
            <!-- COMPONENT TEXT INLINE BEGIN -->
			<?php if ( ! empty( $args["location"] ) ) : ?>
                <div class="bfi-wrapper-default bfi-ce-text-inline">
                    <div class="bfi-ce-text-inline__header">
                        <h2>
                            Lage
                        </h2>
                    </div>
                    <div class="bfi-ce-text-inline__content">
						<?php echo wpautop( $args["location"] ); ?>
                    </div>
                </div>
			<?php endif; ?>
            <!-- COMPONENT TEXT INLINE END -->
            <!-- COMPONENT TEXT INLINE BEGIN -->
			<?php if ( ! empty( $args["others"] ) ) : ?>
                <div class="bfi-wrapper-default bfi-ce-text-inline">
                    <div class="bfi-ce-text-inline__header">
                        <h2>
                            Sonstiges
                        </h2>
                    </div>
                    <div class="bfi-ce-text-inline__content">
						<?php echo wpautop( $args["others"] ); ?>
                    </div>
                </div>
			<?php endif; ?>
            <!-- COMPONENT TEXT INLINE END -->
        </div>
        <!-- WRAPPER LEFT SIDE END -->
        <!-- WRAPPER RIGHT SIDE BEGIN -->
        <div class="bfi-wrapper-default__half">
            <!-- OPTION BAR BEGIN -->
            <div class="bfi-wrapper-default bfi-ce-bar-option">
                <!-- OPTION BAR ITEM BEGIN -->
                <div class="bfi-ce-bar-option__item">
                    <a href="<?php echo $args["previous-page"]["url"]; ?>"
                       class="bfi-button-iconized bfi-button-iconized--small"
                       title="Gehe zu <?php echo $args["previous-page"]["name"]; ?>">
                        <i class="ic-arrow--left"></i>
                        <span>Vorheriges Objekt</span>
                    </a>
                </div>
                <!-- OPTION BAR ITEM END -->
                <!-- OPTION BAR ITEM BEGIN -->
                <div class="bfi-ce-bar-option__item">
                    <a href="<?php echo $args["page-data"]["url"]; ?>"
                       class="bfi-button-iconized bfi-button-iconized--small"
                       title="<?php echo $args["page-data"]["title"]; ?>">
                        <i class="ic-overview"></i>
                        <span>Zurück zur Übersicht</span>
                    </a>
                </div>
                <!-- OPTION BAR ITEM END -->
                <!-- OPTION BAR ITEM BEGIN -->
                <div class="bfi-ce-bar-option__item">
                    <a href="<?php echo $args["next-page"]["url"]; ?>"
                       class="bfi-button-iconized bfi-button-iconized--small"
                       title="Gehe zu <?php echo $args["next-page"]["name"]; ?>">
                        <span>Nächstes Objekt</span>
                        <i class="ic-arrow--right"></i>
                    </a>
                </div>
                <!-- OPTION BAR ITEM END -->
            </div>
            <!-- OPTION BAR END -->
            <!-- VCARD BEGIN -->
            <div class="bfi-wrapper-default bfi-location-vcard">
                <div class="bfi-ce-text-inline">
                    <div class="bfi-ce-text-inline__content">
                        <h1><?php echo $args["title"]; ?> <i class="ic-print"></i></h1>
						<?php if ( ! empty( $args["zip"] ) || ! empty( $args["city"] ) ) : ?>
                            <h2>
                                <i class="ic-location"></i>
								<?php
								$zip    = $args["zip"];
								$city   = $args["city"];
								$street = $args["street"];

								if ( empty( $street ) ) {
									echo $zip . " " . $city;
								} else {
									echo $zip . " " . $city . ", " . $street;
								}
								?>
                            </h2>
						<?php endif; ?>
						<?php
						if (
							! empty( $args["price"] ) ||
							! empty( $args["rooms"] ) ||
							! empty( $args["livingarea"] ) ||
							! empty( $args["property"] )
						) :
							?>
                            <ul class="bfi-list-column bfi-list-column--full">
								<?php if ( ! empty( $args["price"] ) ) : ?>
                                    <li>
                                        <p class="teaser"><?php echo $args["price"] ?>
                                            €</p>
                                        <p><?php echo F12LocationCommercialUtils::get_price_type_by_value( $args["price-type"] ); ?></p>
                                    </li>
								<?php endif; ?>
								<?php if ( ! empty( $args["rooms"] ) ) : ?>
                                    <li>
                                        <p class="teaser"><?php echo $args["rooms"] ?> </p>
                                        <p>Zimmer</p>
                                    </li>
								<?php endif; ?>
								<?php if ( ! empty( $args["livingarea"] ) ) : ?>
                                    <li>
                                        <p class="teaser"><?php echo $args["livingarea"]; ?>
                                            m²</p>
                                        <p>Wohnfläche</p>
                                    </li>
								<?php endif; ?>
								<?php if ( ! empty( $args["property"] ) ) : ?>
                                    <li>
                                        <p class="teaser"><?php echo $args["property"] ?>
                                            m²</p>
                                        <p>Grundstück</p>
                                    </li>
								<?php endif; ?>
                            </ul>
						<?php endif; ?>

						<?php
						if ( ! empty( $args["equipment"] ) ) :
							?>
                            <h2>Ausstattung</h2>
                            <ul class="bfi-ce-list-square bfi-list-square--half">
								<?php
								foreach ( $args["equipment"] as $item ) :
									?>
                                    <li>
										<?php echo $item->name; ?>
                                    </li>
								<?php
								endforeach;
								?>
                            </ul>
						<?php endif; ?>
                    </div>
                </div>
            </div>
            <!-- VCARD END -->
            <!-- LOCATION ATTRIBUTES START-->
            <div class="bfi-ce-location-attributes">
                <!-- LIST TABLE BEGIN -->
                <div class="bfi-ce-list-table bfi-wrapper-default">
	                <?php echo $args["custom-group"];?>
					<?php if ( $args["housetype"] != - 1 ) : ?>
                        <div class="bfi-ce-list-table__row">
                            <div class="bfi-ce-list-table__column">
                                Haustyp
                            </div>
                            <div class="bfi-ce-list-table__column">
                                <strong><?php echo F12LocationCommercialUtils::get_list_value_by_id( $args["housetype"] ); ?></strong>
                            </div>
                        </div>
					<?php endif; ?>
					<?php if ( ! empty( $args["floors"] ) ) : ?>
                        <div class="bfi-ce-list-table__row">
                            <div class="bfi-ce-list-table__column">
                                Etagenanzahl
                            </div>
                            <div class="bfi-ce-list-table__column">
                                <strong><?php echo $args["floors"]; ?></strong>
                            </div>
                        </div>
					<?php endif; ?>
					<?php if ( ! empty( $args["livingarea"] ) ) : ?>
                        <div class="bfi-ce-list-table__row">
                            <div class="bfi-ce-list-table__column">
                                Wohnfläche ca.
                            </div>
                            <div class="bfi-ce-list-table__column">
                                <strong><?php echo $args["livingarea"]; ?>
                                    m²</strong>
                            </div>
                        </div>
					<?php endif; ?>
					<?php if ( ! empty( $args["property"] ) ) : ?>
                        <div class="bfi-ce-list-table__row">
                            <div class="bfi-ce-list-table__column">
                                Grundstücksfläche ca.
                            </div>
                            <div class="bfi-ce-list-table__column">
                                <strong><?php echo $args["property"]; ?>
                                    m²</strong>
                            </div>
                        </div>
					<?php endif; ?>
					<?php if ( ! empty( $args["movein"] ) ) : ?>
                        <div class="bfi-ce-list-table__row">
                            <div class="bfi-ce-list-table__column">
                                Bezugsfrei ab
                            </div>
                            <div class="bfi-ce-list-table__column">
                                <strong><?php echo str_replace( "-", ".", $args["movein"] ); ?></strong>
                            </div>
                        </div>
					<?php endif; ?>
					<?php if ( ! empty( $args["rooms"] ) ) : ?>
                        <div class="bfi-ce-list-table__row">
                            <div class="bfi-ce-list-table__column">
                                Zimmer
                            </div>
                            <div class="bfi-ce-list-table__column">
                                <strong><?php echo $args["rooms"]; ?></strong>
                            </div>
                        </div>
					<?php endif; ?>
					<?php if ( ! empty( $args["bedroom"] ) ) : ?>
                        <div class="bfi-ce-list-table__row">
                            <div class="bfi-ce-list-table__column">
                                Schlafzimmer
                            </div>
                            <div class="bfi-ce-list-table__column">
                                <strong><?php echo $args["bedroom"] ?></strong>
                            </div>
                        </div>
					<?php endif; ?>
					<?php if ( ! empty( $args["bathroom"] ) ) : ?>
                        <div class="bfi-ce-list-table__row">
                            <div class="bfi-ce-list-table__column">
                                Badezimmer
                            </div>
                            <div class="bfi-ce-list-table__column">
                                <strong><?php echo $args["bathroom"]; ?></strong>
                            </div>
                        </div>
					<?php endif; ?>
					<?php if ( $args["garage"] != - 1 ) : ?>
                        <div class="bfi-ce-list-table__row">
                            <div class="bfi-ce-list-table__column">
                                Garage/Stellplatz
                            </div>
                            <div class="bfi-ce-list-table__column">
                                <strong><?php echo F12LocationCommercialUtils::get_list_value_by_id( $args["garage"] ); ?></strong>
                            </div>
                        </div>
					<?php endif; ?>
                </div>
                <!-- LIST TABLE END -->
                <!-- LIST TABLE BEGIN -->
				<?php
				if (
					! empty( $args["price"] ) ||
					! empty( $args["provision"] )
				) :
					?>
                    <div class="bfi-ce-list-table bfi-wrapper-default">
                        <h2>
                            Kosten
                        </h2>
						<?php if ( ! $args["price"] ) : ?>
                            <div class="bfi-ce-list-table__row">
                                <div class="bfi-ce-list-table__column">
                                    <p><?php echo F12LocationCommercialUtils::get_price_type_by_value( $args["price-type"] ); ?></p>
                                </div>
                                <div class="bfi-ce-list-table__column">
                                    <strong><?php echo $args["price"]; ?>
                                        €</strong>
                                </div>
                            </div>
						<?php endif; ?>
						<?php if ( ! empty( $args["provision"] ) ) : ?>
                            <div class="bfi-ce-list-table__row">
                                <div class="bfi-ce-list-table__column">
                                    Provision für <?php
									if ( $args["price-type"] == "rent" ) : ?>
                                        Mieter
									<?php else : ?>
                                        Käufer
									<?php endif; ?>
                                </div>
                                <div class="bfi-ce-list-table__column">
									<?php echo $args["provision"]; ?>
                                </div>
                            </div>
						<?php endif; ?>
                    </div>
				<?php endif; ?>
                <!-- LIST TABLE END -->
                <!-- LIST TABLE BEGIN -->
				<?php if (
					- 1 != $args["buildyear"] ||
					- 1 != $args["object-condition"] ||
					- 1 != $args["equipment-condition"] ||
					- 1 != $args["heater"] ||
					- 1 != $args["energy"] ||
					- 1 != $args["energy-pass"] ||
					- 1 != $args["energy-pass-type"] ||
					! empty( $args["energy-consumption"] )
				) : ?>
                    <div class="bfi-ce-list-table bfi-wrapper-default">
                        <h2>
                            Bausubstanz & Energieausweis
                        </h2>
						<?php if ( - 1 != $args["buildyear"] ) : ?>
                            <div class="bfi-ce-list-table__row">
                                <div class="bfi-ce-list-table__column">
                                    Baujahr
                                </div>
                                <div class="bfi-ce-list-table__column">
                                    <strong><?php echo $args["buildyear"]; ?></strong>
                                </div>
                            </div>
						<?php endif; ?>
						<?php if ( - 1 != $args["object-condition"] ) : ?>
                            <div class="bfi-ce-list-table__row">
                                <div class="bfi-ce-list-table__column">
                                    Objektzustand
                                </div>
                                <div class="bfi-ce-list-table__column">
                                    <strong><?php echo F12LocationCommercialUtils::get_list_value_by_id( $args["object-condition"] ); ?></strong>
                                </div>
                            </div>
						<?php endif; ?>
						<?php if ( - 1 != $args["equipment-condition"] ) : ?>
                            <div class="bfi-ce-list-table__row">
                                <div class="bfi-ce-list-table__column">
                                    Qualität der Ausstattung
                                </div>
                                <div class="bfi-ce-list-table__column">
                                    <strong><?php echo F12LocationCommercialUtils::get_list_value_by_id( $args["equipment-condition"] ); ?></strong>
                                </div>
                            </div>
						<?php endif; ?>
						<?php if ( - 1 != $args["heater"] ) : ?>
                            <div class="bfi-ce-list-table__row">
                                <div class="bfi-ce-list-table__column">
                                    Heizungsart
                                </div>
                                <div class="bfi-ce-list-table__column">
                                    <strong><?php echo F12LocationCommercialUtils::get_list_value_by_id( $args["heater"] ); ?></strong>
                                </div>
                            </div>
						<?php endif; ?>
						<?php if ( - 1 != $args["energy"] ) : ?>
                            <div class="bfi-ce-list-table__row">
                                <div class="bfi-ce-list-table__column">
                                    Wesentlicher Energieträger
                                </div>
                                <div class="bfi-ce-list-table__column">
                                    <strong><?php echo F12LocationCommercialUtils::get_list_value_by_id( $args["energy"] ); ?></strong>
                                </div>
                            </div>
						<?php endif; ?>
						<?php if ( - 1 != $args["energy-pass"] ) : ?>
                            <div class="bfi-ce-list-table__row">
                                <div class="bfi-ce-list-table__column">
                                    Energieausweis
                                </div>
                                <div class="bfi-ce-list-table__column">
                                    <strong><?php echo F12LocationCommercialUtils::get_list_value_by_id( $args["energy-pass"] ); ?></strong>
                                </div>
                            </div>
						<?php endif; ?>
						<?php if ( - 1 != $args["energy-pass-type"] ) : ?>
                            <div class="bfi-ce-list-table__row">
                                <div class="bfi-ce-list-table__column">
                                    Energieausweistyp
                                </div>
                                <div class="bfi-ce-list-table__column">
                                    <strong><?php echo F12LocationCommercialUtils::get_list_value_by_id( $args["energy-pass-type"] ); ?></strong>
                                </div>
                            </div>
						<?php endif; ?>
						<?php if ( ! empty( $args["energy-consumption"] ) ) : ?>
                            <div class="bfi-ce-list-table__row">
                                <div class="bfi-ce-list-table__column">
                                    Endenenergieverbrauch
                                </div>
                                <div class="bfi-ce-list-table__column">
                                    <strong><?php echo $args["energy-consumption"]; ?></strong>
                                </div>
                            </div>
						<?php endif; ?>
                    </div>
                    <!-- LIST TABLE END -->
				<?php endif; ?>
            </div>
            <!-- LOCATION ATTRIBUTES END-->
        </div>
        <!-- WRAPPER RIGHT SIDE END -->
        <!-- WRAPPER BOTTOM BEGIN -->
        <!-- OPTION BAR BEGIN -->
        <div class="bfi-wrapper-650 bfi-ce-bar-option bfi-no-mobile">
            <!-- OPTION BAR ITEM BEGIN -->
            <div class="bfi-ce-bar-option__item">
                <a href="<?php echo $args["previous-page"]["url"]; ?>"
                   class="bfi-button-iconized bfi-button-iconized--small"
                   title="Gehe zu <?php echo $args["previous-page"]["name"]; ?>">
                    <i class="ic-arrow--left"></i>
                    <span>Vorheriges Objekt</span>
                </a>
            </div>
            <!-- OPTION BAR ITEM END -->
            <!-- OPTION BAR ITEM BEGIN -->
            <div class="bfi-ce-bar-option__item">
                <a href="<?php echo $args["page-data"]["url"]; ?>"
                   class="bfi-button-iconized bfi-button-iconized--small"
                   title="<?php echo $args["page-data"]["title"]; ?>">
                    <i class="ic-overview"></i>
                    <span>Zurück zur Übersicht</span>
                </a>
            </div>
            <!-- OPTION BAR ITEM END -->
            <!-- OPTION BAR ITEM BEGIN -->
            <div class="bfi-ce-bar-option__item">
                <a href="<?php echo $args["next-page"]["url"]; ?>"
                   class="bfi-button-iconized bfi-button-iconized--small"
                   title="Gehe zu <?php echo $args["next-page"]["name"]; ?>">
                    <span>Nächstes Objekt</span>
                    <i class="ic-arrow--right"></i>
                </a>
            </div>
            <!-- OPTION BAR ITEM END -->
        </div>
        <!-- OPTION BAR END -->
        <!-- WRAPPER BOTTOM END -->
    </div>
    <!-- WRAPPER SPLITTER END -->
</div>
<!-- LAYOUT CONTENT END -->
<script type="text/javascript">
    window.f12.ready(function () {
        $(".bfi-ce-image-galerie").f12Galerie(".bfi-ce-image-galerie__header", ".bfi-ce-image-galerie__list", ".bfi-button-right", ".bfi-button-left");

        window.f12.ajaxurl = '<?php echo admin_url( "admin-ajax.php" );?>';

        // Gewerbeimmobilien popup
		<?php if(isset( $args["request-page"] ) && $args["request-page"] != - 1) : ?>
        $(".modular-objectrequest").f12Modular({
            href: '<?php echo get_permalink( $args["request-page"] );?>',
            width: 800,
            height: 600,
            width_offset: 0,
            height_offset: 16,
            post: "object=<?php echo $args["id"];?>"
        });
		<?php endif; ?>
    });
</script>
