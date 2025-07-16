<?php
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Utils functionalities for the Plugin
 */
class F12LocationCategoryUtils {

	/**
	 * Returns a list of all categories
	 *
	 * @return array
	 */
	public static function get_categories() {
		$args = array(
			"post_type" => "f12cl_category"
		);

		$query = new WP_Query( $args );

		return $query->get_posts();
	}

	/**
	 * Get all groups for the given category by post name
	 *
	 * @param $post_name string
	 *
	 * @return array
	 */
	public static function get_categories_by_group( $post_name ) {
		$data       = array();
		$categories = self::get_categories();

		foreach ( $categories as $category /** @var $stored_meta_data WP_Post */ ) {
			$stored_meta_data = get_post_meta( $category->ID );

			if ( isset( $stored_meta_data[ "f12cl-category-group-" . $post_name ] ) && $stored_meta_data[ "f12cl-category-group-" . $post_name ][0] == 1 ) {
				$data[] = $category->post_name;
			}
		}

		return $data;
	}

	public static function get_groups_by_category( $id ) {
		$stored_meta_data = get_post_meta( $id );
		$groups           = F12LocationGroupUtils::get_groups();

		$ret = array();
		foreach ( $groups as $group_data) {
			/** @var WP_Post $group */
			$group = $group_data["data"];

			$value = F12LocationCommercialUtils::get_field( $stored_meta_data, "f12cl-category-group-" . $group->post_name, 0 );

			if ( $value == 1 ) {
				$ret[] = $group_data;
			}
		}

		return $ret;
	}

	public static function get_categories_by_property_id( $id = 5 ) {
		$property_meta_data = get_post_meta( $id );

		$category = F12LocationCommercialUtils::get_field( $property_meta_data, "f12cl_category", - 1 );
		$category = get_post( $category );

		if ( ! $category ) {
			return array();
		}

		$groups = self::get_groups_by_category( $category->ID );

		return $groups;
	}
}
