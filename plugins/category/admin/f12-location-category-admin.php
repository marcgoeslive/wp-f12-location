<?php
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Requests
require_once( plugin_dir_path( __FILE__ ) . "/core/f12-location-category-cpt.php" );
require_once( plugin_dir_path( __FILE__ ) . "/core/f12-location-category-metabox.php" );
require_once( plugin_dir_path( __FILE__ ) . "/core/f12-location-category-overview.php" );


/**
 * Class F12LocationCategoryAdmin
 */
class F12LocationCategoryAdmin {
	private $F12CPTRequest;
	private $F12MetaBoxList;
	private $F12OverviewRequest;

	public function __construct() {
		// Anfragen
		$this->F12CPTRequest      = new F12LocationCategoryCPT();
		$this->F12MetaBoxList     = new F12LocationCategoryMetabox();
		$this->F12OverviewRequest = new F12LocationCategoryOverview();
	}
}

new F12LocationCategoryAdmin();