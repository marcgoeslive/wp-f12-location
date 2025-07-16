<?php
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class F12LocationCategoryMetabox {
	/**
	 * Constructor
	 */
	public function __construct() {
		// actions
		add_action( "add_meta_boxes", array( &$this, "add_meta_box" ) );
		add_action( "save_post", array( &$this, "save_post" ) );
	}

	/**
	 * Save the post
	 */
	public function save_post() {
		global $post;

		if ( isset( $post ) ) {
			$post_id = $post->ID;

			$is_autosave    = wp_is_post_autosave( $post_id );
			$is_revision    = wp_is_post_revision( $post_id );
			$is_valid_nonce = ( isset( $_POST[ F12_CPT . "category-nonce" ] ) && wp_verify_nonce( $_POST[ F12_CPT . "category-nonce" ], basename( __FILE__ ) ) ) ? true : false;

			// Exit script depending on status
			if ( $is_autosave || $is_revision || ! $is_valid_nonce ) {
				return;
			}

			// Add Groups
			$groups = F12LocationGroupUtils::get_groups();

			foreach ( $groups as $group_data ) {
				$group  = $group_data["data"];
				$lists  = $group_data["lists"];
				$fields = $group_data["fields"];

				$name     = "f12cl-category-group-" . $group->post_name;
				$value    = isset( $_POST[ $name ] ) ? $_POST[ $name ] : 0;
				$position = isset( $_POST[ $name . "-position" ] ) ? $_POST[ $name . "-position" ] : 0;

				$content_list = array_merge( $lists, $fields );

				foreach ( $content_list as $item ) {
					$item_name = $name . "-" . $item["data"]->post_name . "-highlight";
					$highlight = isset( $_POST[ $item_name ] ) ? $_POST[ $item_name ] : 0;

					if ( $highlight != 0 ) {
						update_post_meta( $post_id, $item_name, $highlight );
					}
				}

				update_post_meta( $post_id, $name, $value );
				update_post_meta( $post_id, $name . "-position", $position );
			}
		}
	}

	/**
	 * Hooked into add_meta_boxes to create it
	 */
	public function add_meta_box() {
		add_meta_box(
			F12_CPT . "meta_box",
			"Gruppen der Kategorie",
			array( &$this, "add_meta_box_html" ),
			F12_CPT . "category"
		);
	}

	/**
	 * The output for the Metabox as HTML
	 */
	public function add_meta_box_html() {
		global $post;

		$stored_meta_data = get_post_meta( $post->ID );

		/** Load groups display */
		$groups       = F12LocationGroupUtils::get_groups();
		$group_string = "";

		foreach ( $groups as $group_data /** @var $group WP_Post */ ) {
			$item_string = "";
			$group       = $group_data["data"];
			$lists       = $group_data["lists"];
			$fields      = $group_data["fields"];

			$value    = F12LocationCommercialUtils::get_field( $stored_meta_data, "f12cl-category-group-" . $group->post_name, 0 );
			$position = F12LocationCommercialUtils::get_field( $stored_meta_data, "f12cl-category-group-" . $group->post_name . "-position", 0 );

			if ( $value != 0 ) {
				$value = "checked = \"checked\"";
			} else {
				$value = "";
			}

			// Lists and Fields
			$content_list = array_merge( $lists, $fields );
			foreach ( $content_list as $item ) {
				$highlight = F12LocationCommercialUtils::get_field( $stored_meta_data, "f12cl-category-group-" . $group->post_name . "-" . $item["data"]->post_name . "-highlight", "" );
				$args = array(
					"name"      => $item["data"]->post_name,
					"input"     => "f12cl-category-group-" . $group->post_name . "-" . $item["data"]->post_name . "-highlight",
					"label"     => $item["data"]->post_title,
					"highlight" => $highlight == 1 ? "checked=\"checked\"" : ""
				);
				$item_string .= F12LocationCommercialUtils::get_admin_template( "../../plugins/category/admin/templates/meta-box-category-group-items.php", $args );
			}

			$args = array(
				"items"          => $item_string,
				"name"           => $group->post_name,
				"label"          => $group->post_title,
				"value"          => $value,
				"input"          => "f12cl-category-group-" . $group->post_name,
				"position-left"  => $position == 0 ? "checked=\"checked\"" : "",
				"position-right" => $position == 1 ? "checked=\"checked\"" : "",
			);

			$group_string .= F12LocationCommercialUtils::get_admin_template( "../../plugins/category/admin/templates/meta-box-category-group-checkbox.php", $args );
		}


		/** Load output */
		$args = array(
			"wp-nonce-field" => wp_nonce_field( basename( __FILE__ ), F12_CPT . "category-nonce" ),
			"group"          => $group_string,
		);

		F12LocationCommercialUtils::loadAdminTemplate( "../../plugins/category/admin/templates/meta-box-category.php", $args );
	}
}