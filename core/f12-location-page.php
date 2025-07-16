<?php
if ( ! defined( "ABSPATH" ) ) {
	exit;
}

class F12LocationPage {
	public function __construct() {
		// Filter
		add_filter( "the_content", array( &$this, "validate_page_id" ) );
	}

	/**
	 * Validates the page id and changes the content to the detail page if it is
	 * the assigned page in the settings.
	 *
	 * @param $content
	 *
	 * @return string
	 */
	public function validate_page_id( $content ) {
		/* @var $post WP_Post */
		global $post;

		if ( "f12cl_commercial" == $post->post_type && true == $this->property_exists( $post ) ) {
			return $content . $this->get_content( $post );
		} else {
			if ( empty( $settings ) || ! isset( $settings["location_commercial_page_detail"] ) || $post->ID != $settings["location_commercial_page_detail"] ) {
				return $content;
			}
		}

		//$settings = get_option( "f12cl_settings" );
	}

	/**
	 * Validate if the property exists or not
	 *
	 * @param $object WP_Post
	 *
	 * @return bool
	 */
	private function property_exists( $object ) {
		$stored_meta_data = get_post_meta( $object->ID );

		$public = F12LocationCommercialUtils::get_field( $stored_meta_data, "f12cl_commercial-public", 0 );

		if ( 0 === $public ) {
			return false;
		}

		return true;
	}

	/**
	 * Returns the previous post for the given category
	 *
	 * @param $post_type
	 *
	 * @return array|null|WP_Post
	 */
	private function get_custom_previous_post( $post_id, $post_type, $category ) {
		global $wpdb;

		$sql = "SELECT $wpdb->posts.* 
    FROM $wpdb->posts, $wpdb->postmeta, $wpdb->postmeta AS mt1
    WHERE 
    $wpdb->posts.ID = $wpdb->postmeta.post_id
    AND $wpdb->posts.ID = mt1.post_id
    AND $wpdb->postmeta.meta_key = 'f12cl_category'
    AND $wpdb->postmeta.meta_value = $category
    AND mt1.meta_key = 'f12cl_commercial-public'
    AND mt1.meta_value = 1
    AND $wpdb->posts.post_status = 'publish' 
    AND $wpdb->posts.post_type = '$post_type'
    AND $wpdb->posts.post_date < NOW()
    AND $wpdb->posts.ID < $post_id
    ORDER BY $wpdb->posts.post_date DESC LIMIT 1";

		$items = $wpdb->get_results( $sql );

		if ( empty( $items ) ) {
			return $this->get_last_post( $post_type, $category );
		}

		return get_post( $items[0]->ID );
	}

	/**
	 * Returns the previous post for the given category
	 *
	 * @param $post_type
	 *
	 * @return array|null|WP_Post
	 */
	private function get_custom_next_post( $post_id, $post_type, $category ) {
		global $wpdb;

		$sql = "SELECT $wpdb->posts.* 
    FROM $wpdb->posts, $wpdb->postmeta, $wpdb->postmeta AS mt1
    WHERE 
    $wpdb->posts.ID = $wpdb->postmeta.post_id
    AND $wpdb->posts.ID = mt1.post_id   
    AND $wpdb->postmeta.meta_key = 'f12cl_category'
    AND $wpdb->postmeta.meta_value = $category
    AND mt1.meta_key = 'f12cl_commercial-public'
    AND mt1.meta_value = 1
    AND $wpdb->posts.post_status = 'publish' 
    AND $wpdb->posts.post_type = '$post_type'
    AND $wpdb->posts.post_date < NOW()
    AND $wpdb->posts.ID > $post_id
    ORDER BY $wpdb->posts.post_date ASC LIMIT 1";

		$items = $wpdb->get_results( $sql );

		if ( empty( $items ) ) {
			return $this->get_first_post( $post_type, $category );
		}

		return get_post( $items[0]->ID );
	}


	/**
	 * Get the first post ID of a given post type
	 *
	 * @param $post_type
	 *
	 * @return WP_Post
	 */
	private function get_first_post( $post_type, $category ) {
		$args = array(
			"post_type"      => $post_type,
			"posts_per_page" => 1,
			"orderby"        => "post_date",
			"order"          => "ASC",
			"meta_query"     => array(
				array(
					"key"   => "f12cl_category",
					"value" => $category
				),
				array(
					"key"   => "f12cl_commercial-public",
					"value" => 1
				)
			)
		);

		$query = new WP_Query( $args );
		$items = $query->get_posts();
		if ( ! empty( $items ) ) {
			return $items[0];
		}

		return "";
	}

	/**
	 * Get the Last post ID of a given post type
	 *
	 * @param $post_type
	 *
	 * @return WP_Post
	 */
	private function get_last_post( $post_type, $category ) {
		$args = array(
			"post_type"      => $post_type,
			"posts_per_page" => 1,
			"orderby"        => "post_date",
			"order"          => "DESC",
			"meta_query"     => array(
				array(
					"key"   => "f12cl_category",
					"value" => $category
				),
				array(
					"key"   => "f12cl_commercial-public",
					"value" => 1
				)
			)
		);

		$query = new WP_Query( $args );
		$items = $query->get_posts();

		if ( ! empty( $items ) ) {
			return $items[0];
		}

		return "";
	}

	/**
	 * Load the PArent Page
	 */
	function get_parent_page( $category ) {
		if ( $category == 1 ) {
			$id = get_option( "f12cl_settings" )["location_commercial_page_detail"];
		} else {
			$id = get_option( "f12cl_settings" )["location_living_page_detail"];
		}

		return get_post( $id );
	}

	/**
	 * Returns an array with url, ID and title of the overview page  given by the category.
	 * Returns -1 if nothing exists
	 *
	 * @param $category
	 *
	 * @return array|int
	 */
	function get_overview_page( $category ) {
		if ( $category == 1 ) {
			$page_id = get_option( "f12cl_settings" )["location_commercial_page_overview"];
		} else {
			$page_id = get_option( "f12cl_settings" )["location_living_page_overview"];
		}
		if ( $page_id == - 1 ) {
			return - 1;
		}

		$data = array(
			"ID"    => $page_id,
			"url"   => get_permalink( $page_id ),
			"title" => get_the_title( $page_id )
		);

		return $data;
	}

	/**
	 * @param $object WP_Post
	 *
	 * @return string
	 */
	private function get_content( $object ) {
		$stored_meta_data = get_post_meta( $object->ID );

		$category = F12LocationCommercialUtils::get_field( $stored_meta_data, F12_CPT . "category" );

		// Informations about the previous Property Object
		$previous_post      = $this->get_custom_previous_post( $object->ID, "f12cl_commercial", $category );
		$previous_post_data = array(
			"id"   => $previous_post->ID,
			"url"  => get_permalink( $previous_post->ID ),
			"name" => $previous_post->post_title
		);

		// Informations about the next property object
		$next_post      = $this->get_custom_next_post( $object->ID, "f12cl_commercial", $category );
		$next_post_data = array(
			"id"   => $next_post->ID,
			"url"  => get_permalink( $next_post->ID ),
			"name" => $next_post->post_title
		);

		$args_data = array(
			"id"            => $object->ID,
			"title"         => $object->post_title,
			"category"      => $category,
			"street"        => F12LocationCommercialUtils::get_field( $stored_meta_data, F12_CPT . "commercial-street" ),
			"zip"           => F12LocationCommercialUtils::get_field( $stored_meta_data, F12_CPT . "commercial-city" ),
			"city"          => F12LocationCommercialUtils::get_field( $stored_meta_data, F12_CPT . "commercial-city" ),
			"price-type"    => F12LocationCommercialUtils::get_field( $stored_meta_data, F12_CPT . "commercial-price-type" ),
			"public"        => F12LocationCommercialUtils::get_field( $stored_meta_data, F12_CPT . "commercial-public" ),
			"next-page"     => $next_post_data,
			"previous-page" => $previous_post_data,
			"parent"        => $this->get_parent_page( $category ),
			"page-data"     => $this->get_overview_page( $category ),
			"images"        => explode( ",", F12LocationCommercialUtils::get_field( $stored_meta_data, "f12cl_commercial-images" ) ),
			"equipment"     => get_the_terms( $object->ID, "f12cl_equipment" ),
			"request-page"  => get_option( "f12cl_request-settings" )["f12cl_request-page"]
		);

		// Custom Fields loading
		$custom_group_left  = "";
		$custom_group_right = "";
		$groups             = F12LocationCategoryUtils::get_categories_by_property_id( $object->ID );
		$category_stored_meta = get_post_meta( $category );

		foreach ( $groups as $group ) {
			$position = F12LocationCommercialUtils::get_field( $category_stored_meta, "f12cl-category-group-" . $group["data"]->post_name . "-position", 0 );
			$custom_fields = "";
			foreach ( $group["lists"] as $list ) {

				$args = array(
					"name"  => $list["data"]->post_title,
					"value" => F12LocationCommercialUtils::get_field( $stored_meta_data, "f12cl-list-" . $group["data"]->post_name . "-" . $list["data"]->post_name, - 1 )
				);

				if($position == 1){
					$custom_fields .= F12LocationCommercialUtils::get_template( "page-details-group-list-item-right.php", $args );
				}else{
					$custom_fields .= F12LocationCommercialUtils::get_template( "page-details-group-list-item-left.php", $args );
				}
			}

			foreach ( $group["fields"] as $field ) {
				$args = array(
					"name"  => $field["data"]->post_title,
					"value" => F12LocationCommercialUtils::get_field( $stored_meta_data, "f12cl-field-" . $group["data"]->post_name . "-" . $field["data"]->post_name, "" )
				);

				if($position == 1){
					$custom_fields .= F12LocationCommercialUtils::get_template( "page-details-group-field-item-right.php", $args );
				}else{
					$custom_fields .= F12LocationCommercialUtils::get_template( "page-details-group-field-item-left.php", $args );
				}
			}

			if ( ! empty( $custom_fields ) ) {
				$args = array(
					"custom-fields" => $custom_fields,
					"name"          => $group["data"]->post_title
				);

				if ( $position == 1 ) {
					$custom_group_right .= F12LocationCommercialUtils::get_template( "page-details-group-right.php", $args );
				} else {
					$custom_group_left .= F12LocationCommercialUtils::get_template( "page-details-group-left.php", $args );
				}
			}
		}

		$args_data["custom-group-left"]  = $custom_group_left;
		$args_data["custom-group-right"] = $custom_group_right;

		return F12LocationCommercialUtils::get_template( "page-details.php", $args_data );
	}
}