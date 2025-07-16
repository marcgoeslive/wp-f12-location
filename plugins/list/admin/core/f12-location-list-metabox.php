<?php
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class F12LocationListMetabox {
	/**
	 * Constructor
	 */
	public function __construct() {
		// actions
		add_action( "add_meta_boxes", array( &$this, "add_meta_box" ) );
	}

	/**
	 * Hooked into add_meta_boxes to create it
	 */
	public function add_meta_box() {
		add_meta_box(
			F12_CPT . "meta_box",
			"Listen Elemente",
			array( &$this, "add_meta_box_html" ),
			F12_CPT . "list"
		);
	}

	/**
	 * The output for the Metabox as HTML
	 */
	public function add_meta_box_html() {
		global $post;

		$stored_meta_data = get_post_meta( $post->ID );

		$args = array(
			"wp-nonce-field" => wp_nonce_field( basename( __FILE__ ), F12_CPT . "list-nonce" ),
			"list-item-group" => $post->ID,
			"list-items"     => F12LocationCommercialUtils::get_list( "f12cl_list_item", array(
				array(
					"key"   => "f12cl_list-item-group",
					"value" => $post->ID
				)
			) )
		);

		F12LocationCommercialUtils::loadAdminTemplate( "../../plugins/list/admin/templates/meta-box-list.php", $args );
	}
}