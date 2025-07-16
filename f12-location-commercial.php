<?php
/**
 * Plugin Name: Forge12 Gewerbeimmobilien
 * Plugin URI: https://www.forge12.com
 * Description: Immobilien darstellen
 * Version: v1.0
 * Author: Forge12 Interactive GmbH
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
define( "F12_CPT", "f12cl_" );

require_once( plugin_dir_path( __FILE__ ) . "core/f12-location-commercial-utils.php" );
require_once( plugin_dir_path( __FILE__ ) . "core/f12-location-commercial-shortcode.php" );
require_once( plugin_dir_path( __FILE__ ) . "core/f12-location-page.php" );
require_once( plugin_dir_path( __FILE__ ) . "admin/f12-location-commercial-admin.php" );

// Plugins
require_once( plugin_dir_path( __FILE__ ) . "plugins/request/f12-location-commercial-request.php" );
require_once( plugin_dir_path( __FILE__ ) . "plugins/list/f12-location-list.php" );
require_once( plugin_dir_path( __FILE__ ) . "plugins/field/f12-location-field.php" );
require_once( plugin_dir_path( __FILE__ ) . "plugins/group/f12-location-group.php" );
require_once( plugin_dir_path( __FILE__ ) . "plugins/category/f12-location-category.php" );

class F12LocationCommercial {
	public function __construct() {
		// Add action
		add_action( "init", array( &$this, "init" ) );
	}

	public function init() {
		$F12LocationCommercialShortcode = new F12LocationCommercialShortcode();
		$F12LocationPage                = new F12LocationPage();
	}
}

new F12LocationCommercial();