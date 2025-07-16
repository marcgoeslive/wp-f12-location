<?php
if ( ! defined( "ABSPATH" ) ) {
	exit;
}

/**
 * Class F12LocationCommercialCPT
 */
class F12LocationCommercialCPT {
	/**
	 * F12LocationCommercialCPT constructor.
	 */
	public function __construct() {
		add_action( "init", array( &$this, "add_custom_post_type" ) );
	}

	/**
	 * Post Type erstellen
	 */
	public function add_custom_post_type() {
		register_post_type( F12_CPT . "commercial", array(
			'labels'             => array(
				'name'          => __( 'Immobilien' ),
				'singular_name' => __( 'Immobilie' ),
				'menu_name'     => __( 'Immobilien' ),
			),
			'menu_icon'          => 'dashicons-admin-multisite',
			'public'             => true,
			'publicly_queryable' => true,
			'show_ui'            => true,
			'show_in_menu'       => true,
			'query_var'          => true,
			'capability_type'    => 'post',
			'has_archive'        => true,
			'hierarchical'       => false,
			'rewrite'            => array( 'slug' => 'immobilien' ),
			'supports'           => array(
				"title",
				"revisions"
			)
		) );
		flush_rewrite_rules( true );
	}
}