<?php
/* Contact Form 7 support functions
------------------------------------------------------------------------------- */

// Theme init priorities:
// 9 - register other filters (for installer, etc.)
if ( ! function_exists( 'gutentype_yellow_pencil_theme_setup9' ) ) {
    add_action( 'after_setup_theme', 'gutentype_yellow_pencil_theme_setup9', 9 );
    function gutentype_yellow_pencil_theme_setup9() {

        if ( is_admin() ) {
            add_filter( 'gutentype_filter_tgmpa_required_plugins', 'gutentype_yellow_pencil_required_plugins' );
        }
    }
}

// Filter to add in the required plugins list
if ( ! function_exists( 'gutentype_yellow_pencil_required_plugins' ) ) {
	function gutentype_yellow_pencil_required_plugins( $list = array() ) {
		if ( gutentype_storage_isset( 'required_plugins', 'contact-form-7' ) ) {
            $path = gutentype_get_plugin_source_path( 'plugins/waspthemes-yellow-pencil/waspthemes-yellow-pencil.zip' );
			$list[] = array(
				'name'     => gutentype_storage_get_array( 'required_plugins', 'waspthemes-yellow-pencil' ),
				'slug'     => 'waspthemes-yellow-pencil',
                'version'  => '7.3.0',
                'source'   => ! empty( $path ) ? $path : 'upload://waspthemes-yellow-pencil.zip',
			);
		}
		return $list;
	}
}


