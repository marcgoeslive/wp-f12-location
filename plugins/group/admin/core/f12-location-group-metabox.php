<?php
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class F12LocationGroupMetabox {
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
			$is_valid_nonce = ( isset( $_POST[ F12_CPT . "group-nonce" ] ) && wp_verify_nonce( $_POST[ F12_CPT . "group-nonce" ], basename( __FILE__ ) ) ) ? true : false;

			// Exit script depending on status
			if ( $is_autosave || $is_revision || ! $is_valid_nonce ) {
				return;
			}

			// Add fields and Lists
			$lists = F12LocationCommercialUtils::get_list( "f12cl_list" );

			foreach ( $lists as $list ) {
				/* @var $list WP_Post */
				$name  = "f12cl-group-list-" . $list->post_name;
				$value = isset( $_POST[ $name ] ) ? $_POST[ $name ] : 0;

				update_post_meta( $post_id, $name, $value );
			}

			$fields = F12LocationCommercialUtils::get_list( "f12cl_field" );

			foreach ( $fields as $field ) {
				/* @var $field WP_Post */
				$name  = "f12cl-group-field-" . $field->post_name;
				$value = isset( $_POST[ $name ] ) ? $_POST[ $name ] : 0;
				update_post_meta( $post_id, $name, $value );
			}
		}
	}

	/**
	 * Hooked into add_meta_boxes to create it
	 */
	public function add_meta_box() {
		add_meta_box(
			F12_CPT . "meta_box",
			"Gruppen Elemente",
			array( &$this, "add_meta_box_html" ),
			F12_CPT . "group"
		);
	}

	/**
	 * The output for the Metabox as HTML
	 */
	public function add_meta_box_html() {
		global $post;

		$stored_meta_data = get_post_meta( $post->ID );

		/** Load list display */
		$lists       = F12LocationCommercialUtils::get_list( "f12cl_list" );
		$list_string = "";
		foreach ( $lists as $list /** @var $list WP_Post */ ) {
			$value = F12LocationCommercialUtils::get_field( $stored_meta_data, "f12cl-group-list-" . $list->post_name, 0 );
			if ( $value != 0 ) {
				$value = "checked=\"checked\"";
			} else {
				$value = "";
			}

			$args        = array(
				"name"  => $list->post_name,
				"label" => $list->post_title,
				"value" => $value
			);
			$list_string .= F12LocationCommercialUtils::get_admin_template( "../../plugins/group/admin/templates/meta-box-group-list-checkbox.php", $args );
		}

		/** Load field display */
		$fields        = F12LocationCommercialUtils::get_list( "f12cl_field" );
		$fields_string = "";
		foreach ( $fields as $field /** @var $field WP_Post */ ) {
			$value = F12LocationCommercialUtils::get_field( $stored_meta_data, "f12cl-group-field-" . $field->post_name, 0 );
			if ( $value != 0 ) {
				$value = "checked=\"checked\"";
			} else {
				$value = "";
			}

			$args          = array(
				"name"  => $field->post_name,
				"label" => $field->post_title,
				"value" => $value
			);
			$fields_string .= F12LocationCommercialUtils::get_admin_template( "../../plugins/group/admin/templates/meta-box-group-field-checkbox.php", $args );
		}

		/** Load output */
		$args = array(
			"wp-nonce-field" => wp_nonce_field( basename( __FILE__ ), F12_CPT . "group-nonce" ),
			"lists"          => $list_string,
			"fields"         => $fields_string
		);

		F12LocationCommercialUtils::loadAdminTemplate( "../../plugins/group/admin/templates/meta-box-group.php", $args );
	}
}