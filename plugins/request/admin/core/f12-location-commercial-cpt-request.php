<?php
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class F12CommercialCPTRequest {
	/**
	 * Constructor
	 */
	public function __construct() {

		// Add actions
		add_action( "init", array( &$this, "add_custom_post_types" ) );
	}

	/**
	 * Add custom post types to wordpress
	 */
	public function add_custom_post_types() {
		register_post_type( F12_CPT . "request", array(
			'labels'          => array(
				'name'          => __( 'Objektanfragen' ),
				'singular_name' => __( 'Objektanfrage' )
			),
			'menu_position'   => 41,
			'menu_icon'       => 'dashicons-email-alt',
			'public'          => true,
			'has_archive'     => true,
			'rewrite'         => array( 'slug' => F12_CPT . "request" ),
			'show_in_menu' => "edit.php?post_type=f12cl_commercial",
			'capability_type' => 'page',
			'supports'        => array(
				"title",
				"revisions"
			)
		) );
	}
}