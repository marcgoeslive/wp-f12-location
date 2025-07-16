<?php
if ( ! defined( "ABSPATH" ) ) {
	exit;
}

/**
 * Class F12LocationFieldMetaBox
 */
class F12LocationFieldMetaBox {

	/**
	 * F12LocationFieldMetaBox constructor.
	 */
	public function __construct() {
		// Add Actions
		add_action( "add_meta_boxes", array( &$this, "add_meta_boxes" ) );
		add_action( "save_post_f12cl_field", array( $this, "save" ) );
	}

	public function save() {
		global $post;

		if ( isset( $post ) ) {
			$post_id = $post->ID;

			$is_autosave    = wp_is_post_autosave( $post_id );
			$is_revision    = wp_is_post_revision( $post_id );
			$is_valid_nonce = ( isset( $_POST[ F12_CPT . "field-nonce" ] ) && wp_verify_nonce( $_POST[ F12_CPT . "field-nonce" ], basename( __FILE__ ) ) ) ? true : false;

			// Exit script depending on status
			if ( $is_autosave || $is_revision || ! $is_valid_nonce ) {
				return;
			}

			$type = isset( $_POST["f12cl_field_type"] ) ? $_POST["f12cl_field_type"] : "text";

			update_post_meta( $post_id, "f12cl_field_type", $type );
		}
	}

	public function add_meta_boxes() {
		add_meta_box( "f12l_metabox_field", "Feld", array(
			&$this,
			"add_meta_box_field_html"
		), F12_CPT . "field" );
	}

	public function add_meta_box_field_html() {
		global $post;

		$stored_meta_data = get_post_meta( $post->ID );

		$args = array(
			"nonce"            => wp_nonce_field( basename( __FILE__ ), F12_CPT . "field-nonce" ),
			"f12cl_field_type" => F12LocationFieldUtils::get_type_list( F12LocationFieldUtils::get_field( $stored_meta_data, "f12cl_field_type", "text" ) )
		);

		F12LocationFieldUtils::loadAdminTemplate( "meta-box-field.php", $args );
	}
}