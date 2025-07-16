<?php
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Includes
require_once( plugin_dir_path( __FILE__ ) . "/core/f12-image-picker.php" );
require_once( plugin_dir_path( __FILE__ ) . "/core/f12-location-commercial-cpt.php" );
require_once( plugin_dir_path( __FILE__ ) . "/core/f12-location-commercial-tax.php" );
require_once( plugin_dir_path( __FILE__ ) . "/core/f12-location-commercial-metabox.php" );
require_once( plugin_dir_path( __FILE__ ) . "/core/f12-location-commercial-options.php" );


/**
 * Class F12SliderAdmin
 */
class F12LocationCommercialAdmin {
	// Custom Post Types
	private $F12CPT;
	// Taxonomies
	private $F12Taxonomies;
	// Metaboxes
	private $F12MetaBox;
	// Options
	private $F12Options;

	public function __construct() {
		$this->F12CPT          = new F12LocationCommercialCPT();
		$this->F12Taxonomies   = new F12LocationCommercialTax();
		$this->F12MetaBox      = new F12LocationCommercialMetaBox();
		$this->F12Options      = new F12LocationCommercialOptions();

		// Actions
		add_action( "admin_menu", array( &$this, "admin_menu" ) );
	}

	public function admin_menu() {
		add_submenu_page( "edit.php?post_type=" . F12_CPT . "commercial", "Einstellungen", "Einstellungen", "manage_options", F12_CPT . "settings", array(
			&$this->F12Options,
			"render"
		) );
	}
}

new F12LocationCommercialAdmin();