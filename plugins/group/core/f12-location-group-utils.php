<?php
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Utils functionalities for the Plugin
 */
class F12LocationGroupUtils {
	/**
	 * Returns a list of all groups contianing the lists and fields
	 *
	 * @return array("data"=>WP_Post, "lists"=>array(0=>WP_Post,1=>WP_Post...),"fields"=>array("0"=>WP_Post...))
	 */
	public static function get_groups() {
		$args = array(
			"post_type"      => "f12cl_group",
			"order"          => "ASC",
			"orderby"        => "title",
			"posts_per_page" => - 1
		);

		$query = new WP_Query( $args );

		$data   = array();
		$groups = $query->get_posts();

		foreach ( $groups as $group /* @var $group WP_Post */ ) {
			$data[ $group->ID ]["data"]   = $group;
			$data[ $group->ID ]["lists"]  = self::get_lists( $group->ID );
			$data[ $group->ID ]["fields"] = self::get_fields( $group->ID );
		}

		return $data;
	}

	/**
	 * Return all lists by the given group id
	 *
	 * @param $group_id
	 *
	 * @return array(WP_Post,WP_Post,...)
	 */
	public static function get_lists( $group_id ) {
		$stored_meta_data = get_post_meta( $group_id );

		$data  = array();
		$lists = F12LocationListUtils::get_lists();
		foreach ( $lists as $list ) {
			if ( F12LocationCommercialUtils::get_field( $stored_meta_data, "f12cl-group-list-" . $list["data"]->post_name ) != 0 ) {
				$data[] = $list;
			}
		}

		return $data;
	}

	/**
	 * Return all fields by the given group id
	 *
	 * @param $group_id
	 *
	 * @return array(WP_Post,WP_Post,...)
	 */
	public static function get_fields( $group_id ) {
		$stored_meta_data = get_post_meta( $group_id );

		$data   = array();
		$fields = F12LocationFieldUtils::get_fields();
		foreach ( $fields as $field ) {
			if ( F12LocationCommercialUtils::get_field( $stored_meta_data, "f12cl-group-field-" . $field["data"]->post_name ) != 0 ) {
				$data[] = $field;
			}
		}

		return $data;
	}

	/**
	 * @param $group_id integer
	 * @param $group_name string
	 * @param $post_meta_data
	 * @param int $columns
	 *
	 * @return string
	 */
	public static function get_custom_content( $group_id, $group_name, $post_meta_data, $columns = 2 ) {
		$fields = self::get_fields( $group_id );
		$lists  = self::get_lists( $group_id );

		$content = array_merge( $fields, $lists );

		$counter = count( $content );
		$counter = ceil( $counter / $columns ) * $columns;
		$data    = "<tr>";

		$col_index = 0;

		for ( $i = 0; $i < $counter; $i ++ ) {
			$col_index ++;

			$item = array_shift( $content );

			if ( $col_index + 1 == ( $columns * 2 ) && $i != 0 ) {
				$col_index = 1;
				$data      .= "</tr><tr>";
			}

			if ( $item ) {
				if ( $item["type"] == "field" ) {
					$field = $item;
					/* @var $object WP_Post */
					$object = $field["data"];
					$name   = "f12cl-field-" . $group_name . "-" . $object->post_name;
					// Get selected value
					$value = "";
					if ( isset( $post_meta_data[ $name ] ) && ! empty( $post_meta_data[ $name ] ) ) {
						$value = $post_meta_data[ $name ][0];
					};

					$args = array(
						"name"  => $name,
						"label" => $object->post_title,
						"value" => $value
					);

					switch ( $item["field_type"] ) {
						case "wysiwyg":
							// Start a new line for each wysiwyg editor -

							if ( $col_index != 1 ) {
								for ( $tmp = $col_index; $tmp < $columns * 2; $tmp ++ ) {
									$data .= "<td></td>";
								}
								$data .= "</tr><tr>";
							}
							$args["colspan"] = $columns * 2 - 1;
							$data            .= F12LocationCommercialUtils::get_admin_template( "../../plugins/field/admin/templates/custom-admin-field-wysiwyg.php", $args );
							// Start a new line after each wysiwyg editor -
							$col_index = $columns * 2 - 1;
							break;
						case "checkbox":
							$data .= F12LocationCommercialUtils::get_admin_template( "../../plugins/field/admin/templates/custom-admin-field-checkbox.php", $args );
							break;
						case "date":
							$data .= F12LocationCommercialUtils::get_admin_template( "../../plugins/field/admin/templates/custom-admin-field-date.php", $args );
							break;
						case "number":
							$data .= F12LocationCommercialUtils::get_admin_template( "../../plugins/field/admin/templates/custom-admin-field-number.php", $args );
							break;
						case "text":
						default:
							$data .= F12LocationCommercialUtils::get_admin_template( "../../plugins/field/admin/templates/custom-admin-field.php", $args );
							break;
					}
				} else {
					$list = $item;
					/* @var $object WP_Post */
					$object = $list["data"];
					$name   = "f12cl-list-" . $group_name . "-" . $object->post_name;
					// Get selected value
					$selected = - 1;
					if ( isset( $post_meta_data[ $name ] ) && ! empty( $post_meta_data[ $name ] ) ) {
						$selected = $post_meta_data[ $name ][0];
					};

					$args = array(
						"name"     => $name,
						"items"    => $list["items"],
						"label"    => $object->post_title,
						"selected" => $selected
					);

					$data .= F12LocationCommercialUtils::get_admin_template( "../../plugins/list/admin/templates/custom-admin-list.php", $args );
				}
			} else {
				if ( $col_index != 1 ) {
					for ( $tmp = $col_index; $tmp < $columns * 2; $tmp ++ ) {
						$data .= "<td></td>";
					}
				}
				//$data .= "<td class='label'></td><td></td>";
			}
		}

		$data .= "</tr>";

		return $data;

	}
}
