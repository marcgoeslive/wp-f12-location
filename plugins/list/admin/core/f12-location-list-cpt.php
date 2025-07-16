<?php
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class F12LocationListCPT {
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
		register_post_type( F12_CPT . "list", array(
			'labels'              => array(
				'name'     => __( 'Listen', 'f12cl_commercial' ),
				'singular' => __( 'Liste', 'f12cl_commercial' )
			),
			'public'              => true,
			'publicly_queryable'  => false,
			'exclude_from_search' => true,
			'show_ui'             => true,
			'show_in_menu'        => "edit.php?post_type=" . F12_CPT . "commercial",
			'has_archive'         => true,
			'rewrite'             => true,
			'query_var'           => true,
			'supports'            => array(
				'title',
				'revisions'
			)
		));

		register_post_type(F12_CPT."list_item",array(
			'labels' => array(
				'name' => __('Items','f12cl_commercial'),
				'singular' => __('Item','f12cl_commercial')
			),
			'public'              => true,
			'publicly_queryable'  => false,
			'exclude_from_search' => true,
			'show_ui'             => true,
			'show_in_menu'        => false,
			'has_archive'         => true,
			'rewrite'             => true,
			'query_var'           => true,
			'supports'            => array(
				'title',
				'revisions'
			)
		));
	}
}