<?php
if ( ! defined( "ABSPATH" ) ) {
	exit;
}

/**
 * Class F12ContactShortcode
 */
class F12CommercialShortcodeRequest {
	/**
	 * Error Messages
	 */
	private $error = array();

	/**
	 * Constructor
	 */
	public function __construct() {
		add_shortcode( "f12cl_request_form", array( &$this, "add_shortcode" ) );
		add_action( "wp_loaded", array( &$this, "validate_form" ) );
	}

	/**
	 * Validate form
	 */
	public function validate_form() {
		if ( ! isset( $_POST["f12cl_request-submit"] ) ) {
			return;
		}

		// clean input
		$salutation = isset( $_POST["f12cl_request-salutation"] ) ? $_POST["f12cl_request-salutation"] : "";
		$name       = isset( $_POST["f12cl_request-name"] ) ? sanitize_text_field( $_POST["f12cl_request-name"] ) : "";
		$street     = isset( $_POST["f12cl_request-street"] ) ? sanitize_text_field( $_POST["f12cl_request-street"] ) : "";
		$city       = isset( $_POST["f12cl_request-city"] ) ? sanitize_text_field( $_POST["f12cl_request-city"] ) : "";
		$phone      = isset( $_POST["f12cl_request-phone"] ) ? sanitize_text_field( $_POST["f12cl_request-phone"] ) : "";
		$email      = isset( $_POST["f12cl_request-email"] ) ? $_POST["f12cl_request-email"] : "";
		$message    = isset( $_POST["f12cl_request-message"] ) ? sanitize_textarea_field( $_POST["f12cl_request-message"] ) : "";
		$object     = isset( $_POST["f12cl_request-object"] ) ? intval( $_POST["f12cl_request-object"] ) : - 1;
		$copy       = isset( $_POST["f12cl_request-copy"] ) && intval($_POST["f12cl_request-copy"]) == 1 ? 1 : 0;

		// Check fields
		$is_valid_name    = ! empty( $name ) ? true : false;
		$is_valid_email   = is_email( $email ) ? true : false;
		$is_valid_message = ! empty( $message ) ? true : false;
		$is_valid_nonce   = ( isset( $_POST['f12cl_request_nonce'] ) && wp_verify_nonce( $_POST['f12cl_request_nonce'], basename( __FILE__ ) ) ) ? true : false;
		$is_valid_object  = ! empty( $object ) && is_numeric( $object ) && $object > 0 ? true : false;

		if ( $is_valid_name && $is_valid_email && $is_valid_message && $is_valid_nonce && $is_valid_object ) {
			$location = get_post( $object );

			// array data
			$data = array(
				"salutation"  => $salutation,
				"name"        => $name,
				"street"      => $street,
				"city"        => $city,
				"phone"       => $phone,
				"email"       => $email,
				"message"     => $message,
				"object-id"   => $object,
				"object-name" => $location->post_name,
				"object-link" => get_permalink( $object )
			);

			// Send mail
			$admin_mail    = get_option( "f12cl_request-settings" )["f12cl_request-email"];
			$email_message = $this->parse_email_message( wpautop(get_option( "f12cl_request-settings" )["f12cl_request-intern-message"]), $data );

			$header   = array();
			$header[] = "MIME-Version: 1.0";
			$header[] = "Content-type: text/html; charset=utf-8";
			$header[] = "From: " . $admin_mail;
			$header[] = "X-Mailer: PHP/" . phpversion();
			$header[] = "Reply-To: " . $admin_mail;
			$header   = implode( "\r\n", $header );

			// send the internal email
			mail( $admin_mail, get_option( "f12cl_request-settings" )["f12cl_request-intern-subject"], $email_message, $header );

			// Send the external e-mail
			if ( $copy == 1 ) {
				$email_message = $this->parse_email_message( wpautop(get_option( "f12cl_request-settings" )["f12cl_request-extern-message"]), $data );
				mail( $email, get_option( "f12cl_request-settings" )["f12cl_request-extern-subject"], $email_message, $header );
			}

			$post = array(
				'post_title'  => "Objektanfrage Webseite",
				'post_status' => 'publish',
				'post_author' => 1,
				'post_type'   => 'f12cl_request'
			);

			// Add to posts
			$post_id = wp_insert_post( $post );

			update_post_meta( $post_id, "f12cl_request-name", $name );
			update_post_meta( $post_id, "f12cl_request-email", $email );
			update_post_meta( $post_id, "f12cl_request-salutation", $salutation );
			update_post_meta( $post_id, "f12cl_request-street", $street );
			update_post_meta( $post_id, "f12cl_request-city", $city );
			update_post_meta( $post_id, "f12cl_request-phone", $phone );
			update_post_meta( $post_id, "f12cl_request-message", $message );
			update_post_meta( $post_id, "f12cl_request-object", $object );

			wp_redirect( get_permalink( get_option( "f12cl_request-settings" )["f12cl_request-page-send"] ) );
			exit;
		} else {
			if ( ! $is_valid_message ) {
				$this->error["error-message"] = true;
			}
			if ( ! $is_valid_name ) {
				$this->error["error-name"] = true;
			}
			if ( ! $is_valid_email ) {
				$this->error["error-email"] = true;
			}
		}
	}

	/**
	 * Parse the email message content with the given user data
	 */
	private function parse_email_message( $message, $placeholder ) {
		foreach ( $placeholder as $key => $value ) {
			$message = str_replace( "{" . $key . "}", $value, $message );
		}

		return $message;
	}

	/**
	 * Shortcode galerie output
	 */
	public function add_shortcode( $atts ) {
		if ( ! isset( $_GET["object"] ) ) {
			return;
		}
		if ( ! is_array( $atts ) ) {
			$atts = array();
		}

		$atts["wp_nonce_field"] = wp_nonce_field( basename( __FILE__ ), "f12cl_request_nonce" );
		$atts["object"]         = $_GET["object"];

		$atts = array_merge( $atts, $this->error );

		echo F12LocationCommercialUtils::loadTemplate( "../plugins/request/templates/shortcode-request.php", $atts );
	}
}

new F12CommercialShortcodeRequest();