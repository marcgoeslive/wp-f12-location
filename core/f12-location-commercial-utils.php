<?php
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Utils functionalities for the Plugin
 */
class F12LocationCommercialUtils {
	/**
	 * Loads and returns the content of an admin template
	 *
	 * @param $template - The Template that should be loaded
	 * @param array $args - parameter that should be loaded
	 *
	 * @return string the output of the template
	 */
	public static function loadAdminTemplate( $template, $args = array() ) {
		include( plugin_dir_path( __FILE__ ) . "../admin/templates/" . $template );
	}

	/**
	 * The same as loadAdminTemplate but returning the template instead of executing it
	 *
	 * @param $template
	 * @param array $args
	 *
	 * @return string
	 */
	public static function get_admin_template( $template, $args = array() ) {
		ob_start();
		include( plugin_dir_path( __FILE__ ) . "../admin/templates/" . $template );
		$output = ob_get_clean();

		return $output;
	}

	/**
	 * Loads and returns the content of the frontend template
	 *
	 * @param $template - The Template that should be loaded
	 * @param array $args - parameter that should be loaded
	 *
	 * @return string the output of the template
	 */
	public static function loadTemplate( $template, $args = array() ) {
		if ( file_exists( get_stylesheet_directory() . "/f12-location-commercial/" . $template ) ) {
			ob_start();
			include( get_stylesheet_directory() . "/f12-location-commercial/" . $template );
			$output = ob_get_contents();
		} else {
			ob_start();
			include( plugin_dir_path( __FILE__ ) . "../templates/" . $template );
			$output = ob_get_clean();
		}

		return $output;
	}

	/**
	 * The same as loadAdminTemplate but returning the template instead of executing it
	 *
	 * @param $template
	 * @param array $args
	 *
	 * @return string
	 */
	public static function get_template( $template, $args = array() ) {
		ob_start();
		include( plugin_dir_path( __FILE__ ) . "../templates/" . $template );
		$output = ob_get_clean();

		return $output;
	}

	/**
	 * Get List with posts by a given post type and an defined field
	 */
	public static function get_list( $post_type, $where = array() ) {
		if ( empty( $where ) ) {
			$args = array(
				"post_type" => $post_type,
				"orderby"   => "title",
				"order"     => "ASC",
				"posts_per_page" => - 1
			);
		} else {
			$args = array(
				"post_type"  => $post_type,
				"orderby"    => "title",
				"order"      => "ASC",
				"posts_per_page" => - 1,
				"meta_query" => array(
					array(
						"key"   => $where[0]["key"],
						"value" => $where[0]["value"]
					)
				)
			);
		}

		$query = new WP_Query( $args );
		$items = $query->get_posts();

		return $items;
	}

	/**
	 * Get field from Stored Meta Data and return value if it exists,
	 * otherwise return the default value
	 */
	public static function get_field( $stored_meta_data = array(), $key, $default = "" ) {
		if ( isset( $stored_meta_data[ $key ] ) && ! empty( $stored_meta_data[ $key ] ) ) {
			return $stored_meta_data[ $key ][0];
		}

		return $default;
	}

	/**
	 * Generate a numeric option list {from} to {to}
	 *
	 */
	public static function get_list_numeric( $from, $to, $selected = - 1 ) {
		$options = "<option value='-1'>Bitte wählen</option>";

		for ( $i = $from; $i <= $to; $i ++ ) {
			if ( $selected == $i ) {
				$options .= "<option value='" . $i . "' selected=\"selected\">" . $i . "</option>";
			} else {
				$options .= "<option value='" . $i . "'>" . $i . "</option>";
			}
		}

		return $options;
	}

	/**
	 * Returns an option list with the values from the post type
	 *
	 * @param $post_type
	 * @param int $selected
	 *
	 * @return string
	 */
	public static function get_list_by_post_type( $post_type, $selected = - 1 ) {

		$args = array(
			"post_type"      => $post_type,
			"posts_per_page" => - 1
		);

		$query = new WP_Query( $args );
		$items = $query->get_posts();

		$options = "<option value='-1'>Bitte wählen</option>";

		foreach ( $items as $item ) {
			/* @var $item WP_Post */

			if ( $selected == $item->ID ) {
				$options .= "<option value='" . $item->ID . "' selected=\"selected\">" . $item->post_title . "</option>";
			} else {
				$options .= "<option value='" . $item->ID . "'>" . $item->post_title . "</option>";
			}
		}

		return $options;
	}

	/**
	 * @param $value
	 *
	 * @return string
	 */
	public static function get_price_type_by_value( $value ) {
		if ( $value == "rent" ) {
			return "Mietpreis";
		} else {
			return "Kaufpreis";
		}
	}

	/**
	 * @param $id
	 *
	 * @return string
	 */
	public static function get_list_value_by_id( $id ) {
		$item = get_post( $id );

		if ( ! $item ) {
			return "";
		}

		return $item->post_title;
	}


	/**
	 * Returns a Option list with all pages and the given $selected as selected.
	 *
	 * @param $selected_id int
	 *
	 * @return string
	 */
	public static function get_option_list_pages( $selected_id ) {

		$option = "<option value='-1'>Bitte wählen</option>";
		$pages  = get_pages();
		foreach ( $pages as $page ) {
			if ( $selected_id == $page->ID ) {
				$option .= "<option value=\"" . $page->ID . "\" selected='selected'>" . $page->post_title . "</option>";
			} else {
				$option .= "<option value=\"" . $page->ID . "\">" . $page->post_title . "</option>";
			}
		}

		return $option;
	}
}
