<?php
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Requests
require_once( plugin_dir_path( __FILE__ ) . "/core/f12-location-group-cpt.php" );
require_once( plugin_dir_path( __FILE__ ) . "/core/f12-location-group-metabox.php" );
require_once( plugin_dir_path( __FILE__ ) . "/core/f12-location-group-overview.php" );


/**
 * Class F12LocationListsAdmin
 */
class F12LocationGroupAdmin {
	private $F12CPTRequest;
	private $F12MetaBoxList;
	private $F12OverviewRequest;

	public function __construct() {
		// Anfragen
		$this->F12CPTRequest      = new F12LocationGroupCPT();
		$this->F12MetaBoxList     = new F12LocationGroupMetabox();
		$this->F12OverviewRequest = new F12LocationGroupOverview();

		// Actions
		add_action( "f12cl-location-commercial-add-meta-boxes", array( &$this, "hook_meta_boxes" ), 10, 1 );
		add_action( "f12cl-location-commercial-save", array( &$this, "hook_save" ), 10, 1 );
	}

	/**
	 * Hook the meta boxes to add the dynamic lists and fields
	 *
	 * @param $post_type string
	 */
	public function hook_meta_boxes( $post_type ) {
		$groups = F12LocationGroupUtils::get_groups();

		foreach ( $groups as $group /** @var $group WP_Post */ ) {
			$id = "f12l_commercial_metabox_" . $group["data"]->post_name;

			add_meta_box( $id, $group["data"]->post_title, array(
				&$this,
				"add_meta_box"
			), $post_type, 'advanced', 'default', array( "group" => $group ) );
		}
	}

	/**
	 * @param $post WP_Post
	 * @param $callback_args array
	 */
	public function add_meta_box( $post, $callback_args ) {
		$group            = $callback_args["args"]["group"]["data"];
		$stored_meta_data = get_post_meta( $post->ID );


		$args = array(
			"custom" => F12LocationGroupUtils::get_custom_content( $group->ID, $group->post_name, $stored_meta_data, 2 ),
			"category" => implode( ",", F12LocationCategoryUtils::get_categories_by_group($group->post_name) )
		);

		F12LocationCommercialUtils::loadAdminTemplate( "../../plugins/group/admin/templates/meta-box-custom.php", $args );
	}


	/**
	 * Called on save of the location
	 *
	 * @param $post_id integer
	 */
	public function hook_save( $post_id ) {

		$groups = F12LocationGroupUtils::get_groups();
		foreach ( $groups as $group /* @var $group WP_Post */ ) {
			$lists  = $group["lists"];
			$fields = $group["fields"];

			foreach ( $lists as $list ) {
				/** @var $object WP_Post */
				$object = $list["data"];
				$name   = "f12cl-list-" . $group["data"]->post_name . "-" . $object->post_name;

				$value = isset( $_POST[ $name ] ) ? $_POST[ $name ] : -1;
				update_post_meta( $post_id, $name, $value );
			}

			foreach ( $fields as $field ) {
				/** @var $object WP_Post */
				$object = $field["data"];
				$name   = "f12cl-field-" . $group["data"]->post_name . "-" . $object->post_name;
				$value  = isset( $_POST[ $name ] ) ? $_POST[ $name ] : "";
				update_post_meta( $post_id, $name, $value );
			}
		}
	}
}

new F12LocationGroupAdmin();