<?php
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class F12LocationListMetaboxItem {
	/**
	 * Constructor
	 */
	public function __construct() {
		// actions
		add_action( "add_meta_boxes", array( &$this, "add_meta_box" ) );
		add_action( 'save_post', array( &$this, "save_meta_box" ) );
		add_action( 'trashed_post', array( &$this, "trashed_post" ) );
	}

	/**
	 * Hooked into add_meta_boxes to create it
	 */
	public function add_meta_box() {
		add_meta_box(
			F12_CPT . "meta_box",
			"Eigenschaften",
			array( &$this, "add_meta_box_html" ),
			F12_CPT . "list_item"
		);
	}

	/**
	 * Redirect on Trash item
	 */
	public function trashed_post() {
		$group_id = isset( $_GET[F12_CPT."list-item-group"] ) ? $_GET[F12_CPT."list-item-group"] : - 1;
		if ( $group_id !== - 1 ) {
			$redirect = get_edit_post_link( $group_id, "intern" );
			wp_redirect( $redirect );
			exit;
		}
	}

	/**
	 * Save the content of the metabox slider
	 */
	public function save_meta_box() {
		global $post;

		if ( isset( $post ) ) {
			$post_id = $post->ID;

			$is_autosave    = wp_is_post_autosave( $post_id );
			$is_revision    = wp_is_post_revision( $post_id );
			$is_valid_nonce = ( isset( $_POST[ F12_CPT.'list-item-nonce' ] ) && wp_verify_nonce( $_POST[ F12_CPT.'list-item-nonce' ], basename( __FILE__ ) ) ) ? true : false;

			// Exit script depending on status
			if ( $is_autosave || $is_revision || ! $is_valid_nonce ) {
				return;
			}

			$f12_list_item_group = isset( $_POST['list-item-group'] ) ? $_POST['list-item-group'] : - 1;

			update_post_meta( $post_id, F12_CPT.'list-item-group', $f12_list_item_group );

			wp_redirect( "post.php?post=" . $f12_list_item_group . "&action=edit" );
			exit;
		}
	}

	/**
	 * The output for the Metabox as HTML
	 */
	public function add_meta_box_html() {
		global $post;

		$stored_meta_data = get_post_meta( $post->ID );

		$group_id = isset($_GET["f12cl_list-item-group"]) ? $_GET["f12cl_list-item-group"] : F12LocationCommercialUtils::get_field($stored_meta_data, F12_CPT."list-item-group");

		$args = array(
			"wp-nonce-field"  => wp_nonce_field( basename( __FILE__ ), F12_CPT . "list-item-nonce" ),
			"list-item-group" => F12LocationCommercialUtils::get_list_by_post_type( F12_CPT . "list", $group_id )

		);

		F12LocationCommercialUtils::loadAdminTemplate( "../../plugins/list/admin/templates/meta-box-list-item.php", $args );
	}
}