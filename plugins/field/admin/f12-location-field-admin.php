<?php
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Requests
require_once( plugin_dir_path( __FILE__ ) . "/core/f12-location-field-cpt.php" );
require_once( plugin_dir_path( __FILE__ ) . "/core/f12-location-field-overview.php" );
require_once( plugin_dir_path( __FILE__ ) . "/core/f12-location-field-metabox.php" );


/**
 * Class F12LocationListsAdmin
 */
class F12LocationFieldAdmin {
	private $F12MetaBox;
	private $F12CPTRequest;
	private $F12OverviewRequest;

	public function __construct() {
		// Anfragen
		$this->F12MetaBox         = new F12LocationFieldMetaBox();
		$this->F12CPTRequest      = new F12LocationFieldCPT();
		$this->F12OverviewRequest = new F12LocationFieldOverview();

		// Hooks
		//add_filter( "f12cl-location-commercial-admin-args-property", array( &$this, "hook_property" ), 10, 2 );
		//add_action( "f12cl-location-commercial-save", array( &$this, "hook_save" ), 10, 1 );
	}

	/**
	 * Called on save of the location
	 *
	 * @param $post_id integer
	 */
	public function hook_save( $post_id ) {
		// Save custom fields
		$fields = F12LocationFieldUtils::get_fields();

		foreach ( $fields as $item ) {
			/** @var $object WP_Post */
			$object = $item["data"];
			$value  = isset( $_POST[ "f12cl-field-" . $object->post_name ] ) ? $_POST[ "f12cl-field-" . $object->post_name ] : "";
			update_post_meta( $post_id, "f12cl-field-" . $object->post_name, $value );
		}
	}

	/**
	 * @param $args
	 *
	 * @return mixed
	 */
	public function hook_property( $args, $meta_data ) {
		$args[ F12_CPT . "custom-field" ] = F12LocationFieldUtils::get_fields_admin( $meta_data );

		return $args;
	}
}

new F12LocationFieldAdmin();