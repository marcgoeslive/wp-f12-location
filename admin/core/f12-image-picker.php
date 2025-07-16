<?php
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
/**
 * Class F12ImagePicker
 * Used for Uploading / Removing images via the Wordpress Media Libary
 */
class F12ImagePicker {
	/**
	 * @param $name - The Name of the Input Field, used with [].
	 * @param string $value - array with all images already defined
	 *
	 * @return string
	 */
	public static function get( $name, $value = "" ) {
		// enqueue media
		if ( ! did_action( 'wp_enqueue_media' ) ) {
			wp_enqueue_media();
		}

		// Enque script if not already done
		if ( ! wp_script_is( "f12-image-picker", "enqueued" ) ) {
			wp_enqueue_script( 'f12-image-picker', plugin_dir_url( __FILE__ ) . "../assets/js/f12-image-picker.js", array( "jquery" ), null, false );
		}

		$output = ""; // Return String

		if ( empty( $value ) ) {
			return $output;
		}

		if ( ! is_array( $value ) ) {
			$value = array( $value );
		}

		$items = array(); // Contains all Childs

		foreach ( $value as $key => $id ) {
			$image = wp_get_attachment_image_src( $id );

			if ( isset( $image[0] ) ) {
				$args    = array(
					"id"   => $id,
					"name" => $name,
					"src"  => $image[0]
				);
				$items[] = F12LocationCommercialUtils::get_admin_template( "f12-image-picker-item.php", $args );

				unset( $args );
			}
		}

		$args = array(
			"name"  => $name,
			"items" => implode( "", $items )
		);

		$output .= F12LocationCommercialUtils::get_admin_template( "f12-image-picker.php", $args );

		return $output;
	}
}