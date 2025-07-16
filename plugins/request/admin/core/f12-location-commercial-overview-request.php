<?php
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
/**
 * Change the view of the overview table
 */
class F12CommercialOverviewRequest {
	public function __construct() {
		//add_filter( 'manage_f12_contact_columns', array( &$this, "set_columns" ) );
		add_filter( 'manage_' . F12_CPT . 'request_posts_columns', array( &$this, "posts_columns" ) );
		add_action( 'manage_' . F12_CPT . 'request_posts_custom_column', array( &$this, "custom_columns" ), 10, 2 );
	}

	public function custom_columns( $column, $post_id ) {
		$stored_meta_data = get_post_meta( $post_id );
		switch ( $column ) {
			case "cp":
				echo "<input type=\"checkbox\" />";
				break;
			case 'name':
				echo F12LocationCommercialUtils::get_field( $stored_meta_data, F12_CPT . "request-name" );
				break;
			case 'email':
				echo F12LocationCommercialUtils::get_field( $stored_meta_data, F12_CPT . "request-email" );
				break;
			case 'phone':
				echo F12LocationCommercialUtils::get_field( $stored_meta_data, F12_CPT . "request-phone" );
				break;
			case 'city':
				echo F12LocationCommercialUtils::get_field( $stored_meta_data, F12_CPT . "request-city" );
				break;
			case 'street':
				echo F12LocationCommercialUtils::get_field( $stored_meta_data, F12_CPT . "request-street" );
				break;
			case 'object':
				$location = get_post( F12LocationCommercialUtils::get_field( $stored_meta_data, F12_CPT . "request-object" ) );
				if ( $location ) {
					echo "<a href='" . get_edit_post_link( $location->ID ) . "'>" . $location->post_title . "</a>";
				} else {
					echo F12LocationCommercialUtils::get_field( $stored_meta_data, F12_CPT . "request-object" );
				}
				break;
		}
	}

	public function posts_columns( $columns ) {
		unset( $columns["title"] );

		$args = array(
			"name"   => "Name",
			"email"  => "E-Mail",
			"phone"  => "Telefon",
			"city"   => "Stadt",
			"street" => "Straße",
			"object" => "Immobilie",
			"date"   => $columns["date"]
		);;
		unset( $columns["date"] );

		$columns = array_merge( $columns, $args );

		return $columns;
	}
}