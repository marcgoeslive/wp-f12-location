<?php
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Requests
require_once( plugin_dir_path( __FILE__ ) . "/core/f12-location-commercial-cpt-request.php" );
require_once( plugin_dir_path( __FILE__ ) . "/core/f12-location-commercial-metabox-request.php" );
require_once( plugin_dir_path( __FILE__ ) . "/core/f12-location-commercial-options-request.php" );
require_once( plugin_dir_path( __FILE__ ) . "/core/f12-location-commercial-overview-request.php" );


/**
 * Class F12SliderAdmin
 */
class F12LocationCommercialRequestAdmin {
	// Objektanfragen
	private $F12CPTRequest;
	private $F12OptionsRequest;
	private $F12MetaBoxRequest;
	private $F12OverviewRequest;

	public function __construct() {
		// Anfragen
		$this->F12CPTRequest      = new F12CommercialCPTRequest();
		$this->F12OptionsRequest  = new F12CommercialOptionsRequest();
		$this->F12MetaBoxRequest  = new F12CommercialMetaBoxRequest();
		$this->F12OverviewRequest = new F12CommercialOverviewRequest();

		// Actions
		add_action( "f12cl_admin_navigation_plugin", array( &$this->F12OptionsRequest, "add_admin_navigation" ) );
		add_action( "f12cl_admin_content", array( &$this->F12OptionsRequest, "add_admin_content" ) );
	}
}

new F12LocationCommercialRequestAdmin();