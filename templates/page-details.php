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
					<?php echo $args["custom-group-right"]; ?>
                </div>
                <!-- LIST TABLE END -->

            </div>
            <!-- COMPONENT TEXT INLINE BEGIN -->
			<?php echo $args["custom-group-left"]; ?>

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
					<?php echo $args["custom-group-right"]; ?>
                </div>
            </div>
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
