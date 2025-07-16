<?php
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Options
 */
class F12CommercialOptionsRequest {
	/**
	 * F12CommercialOptionsRequest constructor.
	 */
	public function __construct() {
		// Add actions
		add_action( "admin_init", array( &$this, "register_settings" ) );
		add_action( "f12cl_admin_save", array( &$this, "save" ) );
	}

	public function add_admin_navigation() {
		echo F12LocationCommercialUtils::loadAdminTemplate( "../../plugins/request/admin/templates/admin-request-navigation.php" );
	}

	public function add_admin_content() {
		$args = array(
			F12_CPT . "request-email"          => get_option( F12_CPT . "request-settings" )[ F12_CPT . "request-email" ],
			F12_CPT . "request-intern-subject" => get_option( F12_CPT . "request-settings" )[ F12_CPT . "request-intern-subject" ],
			F12_CPT . "request-intern-message" => get_option( F12_CPT . "request-settings" )[ F12_CPT . "request-intern-message" ],
			F12_CPT . "request-extern-subject" => get_option( F12_CPT . "request-settings" )[ F12_CPT . "request-extern-subject" ],
			F12_CPT . "request-extern-message" => get_option( F12_CPT . "request-settings" )[ F12_CPT . "request-extern-message" ],
			F12_CPT . "request-page-send"      => F12LocationCommercialUtils::get_option_list_pages( get_option( F12_CPT . "request-settings" )[ F12_CPT . "request-page-send" ] ),
			F12_CPT . "request-page"           => F12LocationCommercialUtils::get_option_list_pages( get_option( F12_CPT . "request-settings" )[ F12_CPT . "request-page" ] )
		);

		echo F12LocationCommercialUtils::loadAdminTemplate( "../../plugins/request/admin/templates/admin-request.php", $args );
	}

	public function save() {
		// Data
		$f12_request_email          = isset( $_POST[ F12_CPT . "request-email" ] ) ? $_POST[ F12_CPT . "request-email" ] : "";
		$f12_request_intern_subject = isset( $_POST[ F12_CPT . "request-intern-subject" ] ) ? $_POST[ F12_CPT . "request-intern-subject" ] : "";
		$f12_request_intern_message = isset( $_POST[ F12_CPT . "request-intern-message" ] ) ? $_POST[ F12_CPT . "request-intern-message" ] : "";
		$f12_request_extern_subject = isset( $_POST[ F12_CPT . "request-extern-subject" ] ) ? $_POST[ F12_CPT . "request-extern-subject" ] : "";
		$f12_request_extern_message = isset( $_POST[ F12_CPT . "request-extern-message" ] ) ? $_POST[ F12_CPT . "request-extern-message" ] : "";
		$f12_request_page_send      = isset( $_POST[ F12_CPT . "request-page-send" ] ) ? $_POST[ F12_CPT . "request-page-send" ] : - 1;
		$f12_request_page           = isset( $_POST[ F12_CPT . "request-page" ] ) ? $_POST[ F12_CPT . "request-page" ] : - 1;

		// Data to save
		$args = array(
			F12_CPT . "request-intern-subject" => $f12_request_intern_subject,
			F12_CPT . "request-intern-message" => $f12_request_intern_message,
			F12_CPT . "request-extern-subject" => $f12_request_extern_subject,
			F12_CPT . "request-extern-message" => $f12_request_extern_message,
			F12_CPT . "request-page-send"      => $f12_request_page_send,
			F12_CPT . "request-page"           => $f12_request_page
		);

		// validate data
		if ( is_email( $f12_request_email ) ) {
			$args[ F12_CPT . "request-email" ] = $f12_request_email;
		}

		// Update Data
		update_option( F12_CPT . "request-settings", $args );
	}

	public function register_settings() {
		// Default settings
		add_option( F12_CPT . "request-settings", array(
			F12_CPT . "request-email"          => "",
			F12_CPT . "request-intern-subject" => "",
			F12_CPT . "request-intern-message" => "",
			F12_CPT . "request-extern-subject" => "",
			F12_CPT . "request-extern-message" => "",
			F12_CPT . "request-page-send"      => - 1,
			F12_CPT . "request-page"           => - 1
		) );
	}
}