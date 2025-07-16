<?php
if ( ! defined( "ABSPATH" ) ) {
	exit;
}

/**
 * Class F12LocationCommercialMetaBox
 */
class F12LocationCommercialMetaBox {

	/**
	 * F12LocationCommercialMetaBox constructor.
	 */
	public function __construct() {
		// Add Actions
		add_action( "add_meta_boxes", array( &$this, "add_meta_boxes" ) );
		add_action( "admin_enqueue_scripts", array( &$this, "enqueue_scripts" ) );
		add_action( "save_post", array( &$this, "save_post" ) );
	}

	/**
	 * Save the post
	 */
	public function save_post() {
		global $post;

		if ( isset( $post ) ) {
			$post_id = $post->ID;

			$is_autosave    = wp_is_post_autosave( $post_id );
			$is_revision    = wp_is_post_revision( $post_id );
			$is_valid_nonce = ( isset( $_POST[ F12_CPT . "commercial-nonce" ] ) && wp_verify_nonce( $_POST[ F12_CPT . "commercial-nonce" ], basename( __FILE__ ) ) ) ? true : false;

			// Exit script depending on status
			if ( $is_autosave || $is_revision || ! $is_valid_nonce ) {
				return;
			}

			// Receive fields
			$f12l_category              = isset( $_POST[ F12_CPT . "category" ] ) ? $_POST[ F12_CPT . "category" ] : 1;
			$f12l_commercial_street     = isset( $_POST[ F12_CPT . "commercial-street" ] ) ? sanitize_text_field( $_POST[ F12_CPT . "commercial-street" ] ) : "";
			$f12l_commercial_zip        = isset( $_POST[ F12_CPT . "commercial-zip" ] ) ? sanitize_text_field( $_POST[ F12_CPT . "commercial-zip" ] ) : "";
			$f12l_commercial_city       = isset( $_POST[ F12_CPT . "commercial-city" ] ) ? sanitize_text_field( $_POST[ F12_CPT . "commercial-city" ] ) : "";
			$f12l_commercial_price_type = isset( $_POST[ F12_CPT . "commercial-price-type" ] ) ? $_POST[ F12_CPT . "commercial-price-type" ] : "rent"; // rent or buy - default rent
			$f12l_commercial_public     = isset( $_POST[ F12_CPT . "commercial-public" ] ) ? $_POST[ F12_CPT . "commercial-public" ] : 0;

			$f12l_commercial_images = isset( $_POST[ F12_CPT . "commercial-images" ] ) && ! empty( $_POST[ F12_CPT . "commercial-images" ] ) ? implode( ",", $_POST[ F12_CPT . "commercial-images" ] ) : "";

			// Update fields
			update_post_meta( $post_id, F12_CPT . "category", $f12l_category );
			update_post_meta( $post_id, F12_CPT . "commercial-images", $f12l_commercial_images );
			update_post_meta( $post_id, F12_CPT . "commercial-public", $f12l_commercial_public );
			update_post_meta( $post_id, F12_CPT . "commercial-street", $f12l_commercial_street );
			update_post_meta( $post_id, F12_CPT . "commercial-zip", $f12l_commercial_zip );
			update_post_meta( $post_id, F12_CPT . "commercial-city", $f12l_commercial_city );
			update_post_meta( $post_id, F12_CPT . "commercial-price-type", $f12l_commercial_price_type );

			do_action( "f12cl-location-commercial-save", $post_id );
		}
	}

	/**
	 * Enqueue Scripts
	 */
	public function enqueue_scripts() {
		// Load the datepicker script (pre-registered in WordPress).
		wp_enqueue_script( 'jquery-ui-datepicker' );

		// You need styling for the datepicker. For simplicity I've linked to Google's hosted jQuery UI CSS.
		//wp_register_style( 'jquery-ui', 'http://code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css' );
		wp_register_style( "jquery-ui", plugin_dir_url( __FILE__ ) . "../assets/css/jquery-ui.css" );
		wp_enqueue_style( 'jquery-ui' );

		// Form Validation
		if ( ! wp_script_is( "f12-image-picker", "enqueued" ) ) {
			wp_register_script( "f12-form-validate", plugins_url( "../assets/js/f12-form-validate.js", __FILE__ ), array( "jquery" ), false, true );
			wp_enqueue_script( "f12-form-validate" );

			wp_enqueue_style( "f12-form-validate", plugin_dir_url( __FILE__ ) . "../assets/css/f12-form-validate.css" );;
		}

		if ( ! wp_script_is( "f12-property", "enqueued" ) ) {
			wp_register_script( "f12-property", plugins_url( "../assets/js/f12-property.js", __FILE__ ), array( "jquery" ), false, true );
			wp_enqueue_script( "f12-property" );
		}
	}

	/**
	 * Meta Box adding
	 */
	public function add_meta_boxes() {

		add_meta_box( "f12l_commercial_metabox_core", "Objekt-Einstellungen", array(
			&$this,
			"add_meta_box_core_html"
		), F12_CPT . "commercial" );

		add_meta_box( "f12l_commerical_metabox_address", "Addresse", array(
			&$this,
			"add_meta_box_address_html"
		), F12_CPT . "commercial" );

		add_meta_box( "f12l_commerical_metabox_image", "Bilder", array(
			&$this,
			"add_meta_box_images_html"
		), F12_CPT . "commercial" );

		do_action( "f12cl-location-commercial-add-meta-boxes", F12_CPT . "commercial" );
	}

	public function add_meta_box_images_html() {
		global $post;

		$stored_meta_data       = get_post_meta( $post->ID );
		$f12l_commercial_images = F12ImagePicker::get( F12_CPT . "commercial-images", explode( ",", F12LocationCommercialUtils::get_field( $stored_meta_data, F12_CPT . "commercial-images" ) ) );

		$args = array(
			F12_CPT . "commercial-images" => $f12l_commercial_images,
		);

		F12LocationCommercialUtils::loadAdminTemplate( "meta-box-image.php", $args );
	}

	public function add_meta_box_address_html() {
		global $post;

		$stored_meta_data = get_post_meta( $post->ID );

		$args = array(
			F12_CPT . "commercial-street" => F12LocationCommercialUtils::get_field( $stored_meta_data, F12_CPT . "commercial-street" ),
			F12_CPT . "commercial-zip"    => F12LocationCommercialUtils::get_field( $stored_meta_data, F12_CPT . "commercial-zip" ),
			F12_CPT . "commercial-city"   => F12LocationCommercialUtils::get_field( $stored_meta_data, F12_CPT . "commercial-city" ),
		);

		F12LocationCommercialUtils::loadAdminTemplate( "meta-box-address.php", $args );
	}

	public function add_meta_box_core_html() {
		global $post;

		$stored_meta_data = get_post_meta( $post->ID );

		// Read all categories
		$categories            = F12LocationCategoryUtils::get_categories();
		$f12l_commercial_nonce = wp_nonce_field( basename( __FILE__ ), F12_CPT . "commercial-nonce" );
		$args                  = array(
			F12_CPT . "commercial-nonce"      => $f12l_commercial_nonce,
			F12_CPT . "category"              => F12LocationCommercialUtils::get_field( $stored_meta_data, F12_CPT . "category" ),
			F12_CPT . "commercial-price-type" => F12LocationCommercialUtils::get_field( $stored_meta_data, F12_CPT . "commercial-price-type" ),
			F12_CPT . "commercial-public"     => F12LocationCommercialUtils::get_field( $stored_meta_data, F12_CPT . "commercial-public" ),
			F12_CPT . "categories"            => $categories
		);

		F12LocationCommercialUtils::loadAdminTemplate( "meta-box-core.php", $args );
	}
}