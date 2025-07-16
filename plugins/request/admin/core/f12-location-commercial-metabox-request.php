<?php
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class F12CommercialMetaBoxRequest {
	/**
	 * Constructor
	 */
	public function __construct() {
		// actions
		add_action( "add_meta_boxes", array( &$this, "add_meta_box" ) );
		add_action( 'save_post', array( &$this, "save_meta_box" ) );
	}

	/**
	 * Hooked into add_meta_boxes to create it
	 */
	public function add_meta_box() {
		add_meta_box(
			F12_CPT . "request_meta_box",
			"Informationen",
			array( &$this, "add_meta_box_html" ),
			F12_CPT . "request"
		);
	}

	/**
	 * Save the content of the metabox slider
	 */
	public function save_meta_box() {
		global $post;

		if ( isset( $post ) ) {
			$post_id = $post->ID;

			$is_autosave    = wp_is_post_autosave( $post_id );
			$is_revision    = wp_is_post_revision( $post_id );
			$is_valid_nonce = ( isset( $_POST[ F12_CPT . 'request_nonce' ] ) && wp_verify_nonce( $_POST[ F12_CPT . 'request_nonce' ], basename( __FILE__ ) ) ) ? true : false;

			// Exit script depending on status
			if ( $is_autosave || $is_revision || ! $is_valid_nonce ) {
				return;
			}

			$f12_request_salutation = isset( $_POST[ F12_CPT . 'request-salutation' ] ) ? $_POST[ F12_CPT . 'request-salutation' ] : - 1;
			$f12_request_name       = isset( $_POST[ F12_CPT . 'request-name' ] ) ? $_POST[ F12_CPT . 'request-name' ] : "";
			$f12_request_email      = isset( $_POST[ F12_CPT . 'request-email' ] ) ? $_POST[ F12_CPT . 'request-email' ] : "";
			$f12_request_phone      = isset( $_POST[ F12_CPT . 'request-phone' ] ) ? $_POST[ F12_CPT . 'request-phone' ] : "";
			$f12_request_city       = isset( $_POST[ F12_CPT . 'request-city' ] ) ? $_POST[ F12_CPT . 'request-city' ] : "";
			$f12_request_message    = isset( $_POST[ F12_CPT . 'request-message' ] ) ? $_POST[ F12_CPT . 'request-message' ] : "";
			$f12_request_street     = isset( $_POST[ F12_CPT . 'request-street' ] ) ? $_POST[ F12_CPT . 'request-street' ] : "";
			$f12_request_object     = isset( $_POST[ F12_CPT . 'request-object' ] ) ? $_POST[ F12_CPT . 'request-object' ] : - 1;
			$f12_request_ip         = $_SERVER["REMOTE_ADDR"];

			update_post_meta( $post_id, F12_CPT . "request-salutation", $f12_request_salutation );
			update_post_meta( $post_id, F12_CPT . "request-name", $f12_request_name );
			update_post_meta( $post_id, F12_CPT . "request-email", $f12_request_email );
			update_post_meta( $post_id, F12_CPT . "request-phone", $f12_request_phone );
			update_post_meta( $post_id, F12_CPT . "request-city", $f12_request_city );
			update_post_meta( $post_id, F12_CPT . "request-message", $f12_request_message );
			update_post_meta( $post_id, F12_CPT . "request-street", $f12_request_street );
			update_post_meta( $post_id, F12_CPT . "request-ip", $f12_request_ip );
			update_post_meta( $post_id, F12_CPT . "request-object", $f12_request_object );
		}
	}

	/**
	 * The output for the Metabox as HTML
	 */
	public function add_meta_box_html() {
		global $post;

		$stored_meta_data = get_post_meta( $post->ID );

		$args = array(
			"wp_nonce_field"               => wp_nonce_field( basename( __FILE__ ), F12_CPT . "request_nonce" ),
			F12_CPT . "request-salutation" => F12LocationCommercialUtils::get_field( $stored_meta_data, F12_CPT . "request-salutation", - 1 ),
			F12_CPT . "request-name"       => F12LocationCommercialUtils::get_field( $stored_meta_data, F12_CPT . "request-name" ),
			F12_CPT . "request-email"      => F12LocationCommercialUtils::get_field( $stored_meta_data, F12_CPT . "request-email" ),
			F12_CPT . "request-phone"      => F12LocationCommercialUtils::get_field( $stored_meta_data, F12_CPT . "request-phone" ),
			F12_CPT . "request-city"       => F12LocationCommercialUtils::get_field( $stored_meta_data, F12_CPT . "request-city" ),
			F12_CPT . "request-message"    => F12LocationCommercialUtils::get_field( $stored_meta_data, F12_CPT . "request-message" ),
			F12_CPT . "request-street"     => F12LocationCommercialUtils::get_field( $stored_meta_data, F12_CPT . "request-street" ),
			F12_CPT . "request-ip"         => F12LocationCommercialUtils::get_field( $stored_meta_data, F12_CPT . "request-ip" ),
			F12_CPT . "request-object"     => F12LocationCommercialUtils::get_field( $stored_meta_data, F12_CPT . "request-object" ),

		);

		F12LocationCommercialUtils::loadAdminTemplate( "../../plugins/request/admin/templates/meta-box-request.php", $args );
	}
}