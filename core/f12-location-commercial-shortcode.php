<?php
if ( ! defined( "ABSPATH" ) ) {
	exit;
}

/**
 * Class F12LocationCommercialShortcode
 */
class F12LocationCommercialShortcode {
	/**
	 * Constructor
	 */
	public function __construct() {
		add_shortcode( F12_CPT . "galerie", array( &$this, "add_shortcode_galerie" ) );
		add_action( "wp_enqueue_scripts", array( &$this, "enqueue_scripts" ) );
	}

	public function enqueue_scripts() {
		wp_enqueue_script( F12_CPT . "commercial_scripts", plugin_dir_url( __FILE__ ) . '../assets/js/f12-location-commercial.js', array( 'jquery' ), null, true );
	}

	/**
	 * @param $price_type -> rent or buy
	 * @param $category -> id of the cateogry | Gewerbe (1) or Wohnen (2)
	 *
	 * @return string
	 */
	public function get_items( $price_type, $category ) {
		$args = array(
			"post_type"      => F12_CPT . "commercial",
			"posts_per_page" => - 1,
			"orderby"        => "DESC",
			"meta_query"     => array(
				"relation" => "AND",
				array(
					"key"   => F12_CPT . "commercial-price-type",
					"value" => $price_type
				),
				array(
					"key"   => F12_CPT . "category",
					"value" => $category
				),
				array(
					"key"   => F12_CPT . "commercial-public",
					"value" => 1
				)
			)
		);

		$query = new WP_Query( $args );
		$items = $query->get_posts();

		$content = "";
		foreach ( $items as $item ) {
			/* @var $item WP_Post */

			$storedmetadata = get_post_meta( $item->ID );

			// Load image
			$images = F12LocationCommercialUtils::get_field( $storedmetadata, F12_CPT . "commercial-images" ); // get first image
			$images = explode( ",", $images );
			$image  = ""; //add default image

			if ( ! empty( $images ) && isset( $images[0] ) && ! empty( $images[0] ) ) {
				$image = wp_get_attachment_image_src( $images[0], "" );
				$image = $image[0];
			} else {
				// Load default image
				$image = get_option( F12_CPT . "settings" )["default-image"];
				$image = wp_get_attachment_image_src( $image, "" );
				$image = $image[0];
			}
			$image = parse_url($image)["path"];
			$image = get_home_url()."/image.php?image=".$image."&width=425";

			$data = array(
				F12_CPT . "commercial-title"      => $item->post_title,
				F12_CPT . "commercial-image"      => $image,
				F12_CPT . "commercial-housetype"  => F12LocationCommercialUtils::get_list_value_by_id( F12LocationCommercialUtils::get_field( $storedmetadata, F12_CPT . "commercial-housetype" ) ),
				F12_CPT . "commercial-street"     => F12LocationCommercialUtils::get_field( $storedmetadata, F12_CPT . "commercial-street" ),
				F12_CPT . "commercial-zip"        => F12LocationCommercialUtils::get_field( $storedmetadata, F12_CPT . "commercial-zip" ),
				F12_CPT . "commercial-city"       => F12LocationCommercialUtils::get_field( $storedmetadata, F12_CPT . "commercial-city" ),
				F12_CPT . "commercial-price"      => F12LocationCommercialUtils::get_field( $storedmetadata, F12_CPT . "commercial-price" ),
				F12_CPT . "commercial-price-type" => F12LocationCommercialUtils::get_price_type_by_value( F12LocationCommercialUtils::get_field( $storedmetadata, F12_CPT . "commercial-price-type" ) ),
				F12_CPT . "commercial-livingarea" => F12LocationCommercialUtils::get_field( $storedmetadata, F12_CPT . "commercial-livingarea" ),
				F12_CPT . "commercial-rooms"      => F12LocationCommercialUtils::get_field( $storedmetadata, F12_CPT . "commercial-rooms" ),
				F12_CPT . "commercial-link"       => get_page_link( $item->ID )
			);

			$content .= F12LocationCommercialUtils::loadTemplate( "shortcode-galerie-container-items.php", $data );
		}

		return $content;
	}

	public function get_rent( $category ) {
		$content = $this->get_items( "rent", $category );

		if ( empty( $content ) ) {
			return $content = $this->get_empty( "rent", $category );
		}


		$args = array(
			"title" => get_option( F12_CPT . "settings" )["rent_title"],
			"items" => $content,
			"id"    => "mietangebote"
		);

		return F12LocationCommercialUtils::loadTemplate( "shortcode-galerie-container.php", $args );
	}

	public function get_empty( $type, $category ) {
		$args = array();

		if ( $category == 2 ) {
			if ( $type == "buy" ) {
				$args = array(
					"title" => get_option( F12_CPT . "settings" )["no_buy_2_title"],
					"text"  => get_option( F12_CPT . "settings" )["no_buy_2_text"]
				);
			} else {
				$args = array(
					"title" => get_option( F12_CPT . "settings" )["no_rent_2_title"],
					"text"  => get_option( F12_CPT . "settings" )["no_rent_2_text"]
				);
			}
		} else {
			if ( $type == "buy" ) {
				$args = array(
					"title" => get_option( F12_CPT . "settings" )["no_buy_2_title"],
					"text"  => get_option( F12_CPT . "settings" )["no_buy_2_text"]
				);
			} else {
				$args = array(
					"title" => get_option( F12_CPT . "settings" )["no_rent_2_title"],
					"text"  => get_option( F12_CPT . "settings" )["no_rent_2_text"]
				);
			}
		}

		return F12LocationCommercialUtils::loadTemplate( "shortcode-galerie-container-empty.php", $args );
	}

	public function get_buy( $category ) {
		$content = $this->get_items( "buy", $category );

		if ( empty( $content ) ) {
			return $content = $this->get_empty( "buy", $category );
		}

		$args = array(
			"title" => get_option( F12_CPT . "settings" )["buy_title"],
			"items" => $content,
			"id"    => "kaufangebote"
		);

		return F12LocationCommercialUtils::loadTemplate( "shortcode-galerie-container.php", $args );
	}


	/**
	 * Shortcode galerie output
	 */
	public function add_shortcode_galerie( $atts ) {
		if ( ! isset( $atts["category"] ) ) {
			return;
		}

		// Load BG Image
		$options = get_option( F12_CPT . "settings" );

		if ( $atts["category"] == 2 ) {
			if ( isset( $options["location-living-image"] ) ) {
				$image = get_option( F12_CPT . "settings" )["location-living-image"];
			} else {
				$image = "";
			}
		} else {
			if ( isset( $options["location-commercial-image"] ) ) {
				$image = get_option( F12_CPT . "settings" )["location-commercial-image"];
			} else {
				$image = "";
			}
		}

		if ( isset( $image ) && ! empty( $image ) ) {
			$image = wp_get_attachment_image_src( $image, "" );
			$image = "style='background-image:url(\"" . $image[0] . "\");'";
		}

		$args = array(
			"items" => $this->get_rent( $atts["category"] ) . $this->get_buy( $atts["category"] ),
			"image" => $image,
		);


		echo F12LocationCommercialUtils::loadTemplate( "shortcode-galerie.php", $args );
	}
}