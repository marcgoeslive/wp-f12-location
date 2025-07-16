<?php
if ( ! defined( "ABSPATH" ) ) {
	exit;
}

/**
 * Class F12LocationCommercialTax
 */
class F12LocationCommercialTax {
	/**
	 * F12LocationCommercialTax constructor.
	 */
	public function __construct() {
		add_action( "init", array( &$this, "add_taxonomies" ) );
	}

	/**
	 * Taxonomies erstellen
	 */
	public function add_taxonomies() {
		register_taxonomy( F12_CPT . "equipment", F12_CPT . "commercial", array(
			'labels'             => array(
				'name'          => __( 'Ausstattungen' ),
				'singular_name' => __( 'Ausstattung' ),
				'add_new_item'  => __( 'Neue Ausstattung' )
			),
			'public'             => true,
			'publicly_queryable' => true,
			'hierarchical'       => false,
			'show_ui'            => true,
			'show_admin_column'  => true,
			'query_var'          => true
		) );
	}
}