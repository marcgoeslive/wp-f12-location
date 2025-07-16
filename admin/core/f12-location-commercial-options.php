<?php
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Options
 */
class F12LocationCommercialOptions {
	/**
	 * F12LocationCommercialOptions constructor.
	 */
	public function __construct() {
		// Add actions
		add_action( "admin_init", array( &$this, "register_settings" ) );
		add_action( "admin_init", array( &$this, "enqueue_scripts" ) );

		add_action( "admin_post_" . F12_CPT . "settings_save", array( &$this, "save" ) );

//		add_action("post_action_")
	}

	public function save() {
		wp_redirect( add_query_arg( array(
			"page"      => "f12cl_settings",
			"post_type" => "f12cl_commercial"
		), "edit.php" ) );

		// Gewerblich
		$rent_title    = isset( $_POST["rent_title"] ) ? $_POST["rent_title"] : "";
		$no_rent_text  = isset( $_POST["no_rent_text"] ) ? $_POST["no_rent_text"] : "";
		$no_rent_title = isset( $_POST["no_rent_title"] ) ? sanitize_text_field( $_POST["no_rent_title"] ) : "";

		$buy_title    = isset( $_POST["buy_title"] ) ? $_POST["buy_title"] : "";
		$no_buy_text  = isset( $_POST["no_buy_text"] ) ? $_POST["no_buy_text"] : "";
		$no_buy_title = isset( $_POST["no_buy_title"] ) ? sanitize_text_field( $_POST["no_buy_title"] ) : "";

		// Wohnen
		$rent_2_title    = isset( $_POST["rent_2_title"] ) ? $_POST["rent_2_title"] : "";
		$no_rent_2_text  = isset( $_POST["no_rent_2_text"] ) ? $_POST["no_rent_2_text"] : "";
		$no_rent_2_title = isset( $_POST["no_rent_2_title"] ) ? sanitize_text_field( $_POST["no_rent_2_title"] ) : "";

		$buy_2_title    = isset( $_POST["buy_2_title"] ) ? $_POST["buy_2_title"] : "";
		$no_buy_2_text  = isset( $_POST["no_buy_2_text"] ) ? $_POST["no_buy_2_text"] : "";
		$no_buy_2_title = isset( $_POST["no_buy_2_title"] ) ? sanitize_text_field( $_POST["no_buy_2_title"] ) : "";

		$commercial_page_overview = isset( $_POST["location_commercial_page_overview"] ) ? sanitize_text_field( $_POST["location_commercial_page_overview"] ) : - 1;
		$commercial_page_detail   = isset( $_POST["location_commercial_page_detail"] ) ? sanitize_text_field( $_POST["location_commercial_page_detail"] ) : - 1;
		$living_page_overview     = isset( $_POST["location_living_page_overview"] ) ? sanitize_text_field( $_POST["location_living_page_overview"] ) : - 1;
		$living_page_detail       = isset( $_POST["location_living_page_detail"] ) ? sanitize_text_field( $_POST["location_living_page_detail"] ) : - 1;

		// Default image
		$default_image             = isset( $_POST["f12cl_commercial-default-images"] ) ? $_POST["f12cl_commercial-default-images"][0] : "";
		$location_commercial_image = isset( $_POST["f12cl_commercial-image"] ) ? $_POST["f12cl_commercial-image"][0] : "";
		$living_commercial_image   = isset( $_POST["f12cl_living-image"] ) ? $_POST["f12cl_living-image"][0] : "";

		update_option( F12_CPT . "settings", array(
			"rent_title"                        => $rent_title,
			"no_rent_text"                      => $no_rent_text,
			"no_rent_title"                     => $no_rent_title,
			"buy_title"                         => $buy_title,
			"no_buy_text"                       => $no_buy_text,
			"no_buy_title"                      => $no_buy_title,
			"rent_2_title"                      => $rent_2_title,
			"no_rent_2_text"                    => $no_rent_2_text,
			"no_rent_2_title"                   => $no_rent_2_title,
			"buy_2_title"                       => $buy_2_title,
			"no_buy_2_text"                     => $no_buy_2_text,
			"no_buy_2_title"                    => $no_buy_2_title,
			"location_living_page_overview"     => $living_page_overview,
			"location_living_page_detail"       => $living_page_detail,
			"location_commercial_page_overview" => $commercial_page_overview,
			"location_commercial_page_detail"   => $commercial_page_detail,
			"default-image"                     => $default_image,
			"location-commercial-image"         => $location_commercial_image,
			"location-living-image"             => $living_commercial_image
		) );

		do_action("f12cl_admin_save");
	}

	public function enqueue_scripts() {

		if(!wp_script_is("f12", "enqueued")) {
			wp_enqueue_style( "f12", plugin_dir_url( __FILE__ ) . "../assets/css/f12.css" );
		}

		if(!wp_script_is("f12-admin-navigation","enqueued")){
			wp_enqueue_script("f12-admin-navigation",plugin_dir_url(__FILE__)."../assets/js/f12-admin-navigation.js", array("jquery"));
		}
	}

	public function register_settings() {
		add_option( F12_CPT . "settings", array(
			"rent_title"                        => "",
			"no_rent_text"                      => "",
			"no_rent_title"                     => "",
			"buy_title"                         => "",
			"no_buy_text"                       => "",
			"no_buy_title"                      => "",
			"rent_2_title"                      => "",
			"no_rent_2_text"                    => "",
			"no_rent_2_title"                   => "",
			"buy_2_title"                       => "",
			"no_buy_2_text"                     => "",
			"no_buy_2_title"                    => "",
			"location_commercial_page_overview" => - 1,
			"location_commercial_page_detail"   => - 1,
			"location_living_page_overview"     => - 1,
			"location_living_page_detail"       => - 1,
			"location-commercial-image"         => "",
			"location-living-image"             => "",
			"default-image"                     => ""
		) );
	}

	/**
	 * Output the Settings page
	 */
	public function render() {
		$image = get_option( F12_CPT . "settings" );

		if ( isset( $image["default-image"] ) ) {
			$image = $image["default-image"];
		} else {
			$image = "";
		}

		$commercial_image_data = get_option( F12_CPT . "settings" );

		if ( isset( $commercial_image_data["location-commercial-image"] ) ) {
			$commercial_image_data = $commercial_image_data["location-commercial-image"];
		} else {
			$commercial_image_data = "";
		}

		$living_image_data = get_option( F12_CPT . "settings" );

		if ( isset( $living_image_data["location-living-image"] ) ) {
			$living_image_data = $living_image_data["location-living-image"];
		} else {
			$living_image_data = "";
		}

		$default_image    = F12ImagePicker::get( F12_CPT . "commercial-default-images", explode( ",", $image ) );
		$commercial_image = F12ImagePicker::get( F12_CPT . "commercial-image", explode( ",", $commercial_image_data ) );
		$living_image     = F12ImagePicker::get( F12_CPT . "living-image", explode( ",", $living_image_data ) );

		$args = array(
			"rent_title"                        => get_option( F12_CPT . "settings" )["rent_title"],
			"no_rent_text"                      => get_option( F12_CPT . "settings" )["no_rent_text"],
			"no_rent_title"                     => get_option( F12_CPT . "settings" )["no_rent_title"],
			"buy_title"                         => get_option( F12_CPT . "settings" )["buy_title"],
			"no_buy_text"                       => get_option( F12_CPT . "settings" )["no_buy_text"],
			"no_buy_title"                      => get_option( F12_CPT . "settings" )["no_buy_title"],
			"rent_2_title"                      => get_option( F12_CPT . "settings" )["rent_2_title"],
			"no_rent_2_text"                    => get_option( F12_CPT . "settings" )["no_rent_2_text"],
			"no_rent_2_title"                   => get_option( F12_CPT . "settings" )["no_rent_2_title"],
			"buy_2_title"                       => get_option( F12_CPT . "settings" )["buy_2_title"],
			"no_buy_2_text"                     => get_option( F12_CPT . "settings" )["no_buy_2_text"],
			"no_buy_2_title"                    => get_option( F12_CPT . "settings" )["no_buy_2_title"],
			"location_commercial_page_overview" => F12LocationCommercialUtils::get_option_list_pages( get_option( F12_CPT . "settings" )["location_commercial_page_overview"] ),
			"location_commercial_page_detail"   => F12LocationCommercialUtils::get_option_list_pages( get_option( F12_CPT . "settings" )["location_commercial_page_detail"] ),
			"location_living_page_overview"     => F12LocationCommercialUtils::get_option_list_pages( get_option( F12_CPT . "settings" )["location_living_page_overview"] ),
			"location_living_page_detail"       => F12LocationCommercialUtils::get_option_list_pages( get_option( F12_CPT . "settings" )["location_living_page_detail"] ),
			"default-image"                     => $default_image,
			"location-commercial-image"         => $commercial_image,
			"location-living-image"             => $living_image
		);

		echo F12LocationCommercialUtils::loadAdminTemplate( "admin.php", $args );
	}
}