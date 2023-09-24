<?php
/* The GDPR Framework support functions
------------------------------------------------------------------------------- */

// Theme init priorities:
// 9 - register other filters (for installer, etc.)
if ( ! function_exists( 'gutentype_gdpr_framework_feed_theme_setup9' ) ) {
	add_action( 'after_setup_theme', 'gutentype_gdpr_framework_theme_setup9', 9 );
	function gutentype_gdpr_framework_theme_setup9() {
		if ( is_admin() ) {
			add_filter( 'gutentype_filter_tgmpa_required_plugins', 'gutentype_gdpr_framework_tgmpa_required_plugins' );
		}
	}
}

// Filter to add in the required plugins list
if ( ! function_exists( 'gutentype_gdpr_framework_tgmpa_required_plugins' ) ) {
	function gutentype_gdpr_framework_tgmpa_required_plugins( $list = array() ) {
		if ( gutentype_storage_isset( 'required_plugins', 'gdpr-framework' ) ) {
			$list[] = array(
				'name'     => gutentype_storage_get_array( 'required_plugins', 'gdpr-framework' ),
				'slug'     => 'gdpr-framework',
				'required' => false,
			);
		}
		return $list;
	}
}

// Check if this plugin installed and activated
if ( ! function_exists( 'gutentype_exists_gdpr_framework' ) ) {
	function gutentype_exists_gdpr_framework() {
		return defined( 'GDPR_FRAMEWORK_VERSION' );
	}
}
