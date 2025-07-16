<?php
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Utils functionalities for the Plugin
 */
class F12LocationFieldUtils {
	/**
	 * Return all fields as array
	 *
	 * @return array([["data"=>WP_Post,"items"=>array(WP_Post...)]],...)
	 */
	public static function get_fields() {
		$args = array(
			"post_type"      => "f12cl_field",
			"posts_per_page" => - 1
		);

		$query  = new WP_Query( $args );
		$fields = $query->get_posts();

		$ret = array();

		foreach ( $fields as $field ) {
			$ret[ $field->ID ] = array(
				"data" => $field,
				"type" => "field"
			);

			$field_type = get_post_meta( $field->ID, "f12cl_field_type", true );
			if ( ! $field_type || empty( $field_type ) ) {
				$field_type = "text";
			}

			$ret[$field->ID]["field_type"] = $field_type;
		}

		return $ret;
	}

	public static function get_type_list( $selected ) {
		$types = array( "text", "number", "date", "wysiwyg", "checkbox" );

		$option = "";
		foreach ( $types as $type ) {
			if ( $type == $selected ) {
				$option .= "<option value=" . $type . " selected='selected'>" . $type . "</option>";
			} else {
				$option .= "<option value=" . $type . ">" . $type . "</option>";
			}
		}

		return $option;
	}

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
	 * Return list as admin interface
	 */
	public static function get_fields_admin( $post_meta_data, $columns = 2 ) {
		$fields = self::get_fields();

		$counter = count( $fields );
		$counter = ceil( $counter / $columns ) * $columns;
		$data    = "<tr>";

		for ( $i = 0; $i < $counter; $i ++ ) {
			$field = array_shift( $fields );

			if ( $i % $columns == 0 && $i != 0 ) {
				$data .= "</tr><tr>";
			}

			if ( $field ) {
				/* @var $object WP_Post */
				$object = $field["data"];
				// Get selected value
				$value = "";
				if ( isset( $post_meta_data[ "f12cl-field-" . $object->post_name ] ) && ! empty( $post_meta_data[ "f12cl-field-" . $object->post_name ] ) ) {
					$value = $post_meta_data[ "f12cl-field-" . $object->post_name ][0];
				};

				$args = array(
					"name"  => "f12cl-field-" . $object->post_name,
					"label" => $object->post_title,
					"value" => $value
				);

				$data .= F12LocationCommercialUtils::get_admin_template( "../../plugins/field/admin/templates/custom-admin-field.php", $args );
			} else {
				$data .= "<td class='label'></td><td></td>";
			}
		}

		$data .= "</tr>";

		return $data;
	}
}
