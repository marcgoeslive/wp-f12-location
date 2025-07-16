<?php
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Helper functions for the Lists
 */
class F12LocationListUtils {
	/**
	 * Return all lists as Array.
	 *
	 * @return array([["data"=>WP_Post,"items"=>array(WP_Post...)]],...)
	 */
	public static function get_lists() {
		$args = array(
			"post_type" => "f12cl_list",
			"posts_per_page" => - 1
		);

		$query = new WP_Query( $args );
		$lists = $query->get_posts();

		$ret = array();
		foreach ( $lists as $list /* @var $list WP_Post */ ) {
			$ret[ $list->ID ] = array(
				"data"  => $list,
				"items" => self::get_list_items_by_list_id( $list->ID ),
				"type" => "list"
			);
		}

		return $ret;
	}

	/**
	 * Returns an array with all WP_Posts objects
	 * with the given list id.
	 *
	 * @param $id
	 *
	 * @return array
	 */
	public static function get_list_items_by_list_id( $id ) {
		$args = array(
			"post_type"  => "f12cl_list_item",
			"posts_per_page" => - 1,
			"meta_query" => array(
				array(
					"key"   => "f12cl_list-item-group",
					"value" => $id
				)
			)
		);

		$query = new WP_Query( $args );

		return $query->get_posts();
	}

	/**
	 * Return list as admin interface
	 *
	 * @param array
	 * @param int
	 *
	 * @return string
	 */
	public static function get_lists_admin( $post_meta_data, $columns = 2 ) {
		$lists = self::get_lists();

		$counter = ceil( count( $lists ) / $columns ) * $columns;
		$data    = "<tr>";

		for ( $i = 0; $i < $counter; $i ++ ) {
			$list = array_shift( $lists );

			if ( $i % $columns == 0 && $i != 0 ) {
				$data .= "</tr><tr>";
			}

			if ( $list ) {
				/* @var $object WP_Post */
				$object = $list["data"];

				// Get selected value
				$selected = - 1;
				if ( isset( $post_meta_data[ "f12cl-list-" . $object->post_name ] ) &&
				     ! empty( $post_meta_data[ "f12cl-list-" . $object->post_name ] )
				) {
					$selected = $post_meta_data[ "f12cl-list-" . $object->post_name ][0];
				};

				$args = array(
					"name"     => "f12cl-list-" . $object->post_name,
					"items"    => $list["items"],
					"label"    => $object->post_title,
					"selected" => $selected
				);

				$data .= F12LocationCommercialUtils::get_admin_template( "../../plugins/list/admin/templates/custom-admin-list.php", $args );
			} else {
				$data .= "<td class='label'></td><td></td>";
			}
		}

		$data .= "</tr>";

		return $data;
	}
}
