<?php
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Change the view of the overview table
 */
class F12LocationFieldOverview {
	public function __construct() {
		//add_filter( 'manage_f12_contact_columns', array( &$this, "set_columns" ) );
		add_filter( 'manage_' . F12_CPT . 'field_posts_columns', array( &$this, "posts_columns" ) );
		add_action( 'manage_' . F12_CPT . 'field_posts_custom_column', array( &$this, "custom_columns" ), 10, 2 );
	}

	public function custom_columns( $column, $post_id ) {
		/* @var $item WP_Post */
		$item             = get_post( $post_id );
		$stored_meta_data = get_post_meta( $post_id );
		switch ( $column ) {
			case "cp":
				echo "<input type=\"checkbox\" />";
				break;
			case 'name':
				echo "<a href='" . get_edit_post_link( $item->ID ) . "'>" . $item->post_title . "</a>";
				break;
			case 'shortcode':
				echo "[f12-location-field-" . $item->post_name . "]";
				break;
		}
	}

	public function posts_columns( $columns ) {
		unset( $columns["title"] );

		$args = array(
			"name"      => "Name",
			"shortcode" => "Shortcode",
			"date"      => $columns["date"]
		);;
		unset( $columns["date"] );

		$columns = array_merge( $columns, $args );

		return $columns;
	}
}