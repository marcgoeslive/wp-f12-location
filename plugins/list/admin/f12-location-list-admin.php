<?php
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Requests
require_once( plugin_dir_path( __FILE__ ) . "/core/f12-location-list-cpt.php" );
require_once( plugin_dir_path( __FILE__ ) . "/core/f12-location-list-metabox.php" );
require_once( plugin_dir_path( __FILE__ ) . "/core/f12-location-list-metabox-item.php" );
require_once( plugin_dir_path( __FILE__ ) . "/core/f12-location-list-overview.php" );


/**
 * Class F12LocationListsAdmin
 */
class F12LocationListsAdmin {
	private $F12CPTRequest;
	private $F12MetaBoxList;
	private $F12MetaBoxListItem;
	private $F12OverviewRequest;

	public function __construct() {
		// Anfragen
		$this->F12CPTRequest      = new F12LocationListCPT();
		$this->F12MetaBoxList     = new F12LocationListMetabox();
		$this->F12MetaBoxListItem = new F12LocationListMetaboxItem();
		$this->F12OverviewRequest = new F12LocationListOverview();

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
		// Save custom lists
		$lists = F12LocationListUtils::get_lists();

		foreach ( $lists as $item ) {
			/** @var $object WP_Post */
			$object = $item["data"];
			$value  = isset( $_POST[ "f12cl-list-" . $object->post_name ] ) ? $_POST[ "f12cl-list-" . $object->post_name ] : - 1;
			update_post_meta( $post_id, "f12cl-list-" . $object->post_name, $value );
		}
	}

	/**
	 * @param $args
	 *
	 * @return mixed
	 */
	public function hook_property( $args, $meta_data ) {
		$args[ F12_CPT . "custom-list" ] = F12LocationListUtils::get_lists_admin( $meta_data );
		return $args;
	}
}

new F12LocationListsAdmin();