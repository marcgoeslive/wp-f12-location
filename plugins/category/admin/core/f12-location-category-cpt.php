<?php
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class F12LocationCategoryCPT {
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
		register_post_type( F12_CPT . "category", array(
			'labels'              => array(
				'name'     => __( 'Kategorien', 'f12cl_commercial' ),
				'singular' => __( 'Kategorie', 'f12cl_commercial' )
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
	}
}