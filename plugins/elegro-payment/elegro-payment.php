<?php
/* Elegro Crypto Payment support functions
------------------------------------------------------------------------------- */

// Theme init priorities:
// 9 - register other filters (for installer, etc.)
if ( ! function_exists( 'gutentype_elegro_payment_theme_setup9' ) ) {
	add_action( 'after_setup_theme', 'gutentype_elegro_payment_theme_setup9', 9 );
	function gutentype_elegro_payment_theme_setup9() {
		if ( gutentype_exists_elegro_payment() ) {
			add_filter( 'gutentype_filter_merge_styles', 'gutentype_elegro_payment_merge_styles' );
		}
		if ( is_admin() ) {
			add_filter( 'gutentype_filter_tgmpa_required_plugins', 'gutentype_elegro_payment_tgmpa_required_plugins' );
		}
	}
}

// Filter to add in the required plugins list
if ( ! function_exists( 'gutentype_elegro_payment_tgmpa_required_plugins' ) ) {
	function gutentype_elegro_payment_tgmpa_required_plugins( $list = array() ) {
		if ( gutentype_storage_isset( 'required_plugins', 'woocommerce' ) && gutentype_storage_isset( 'required_plugins', 'elegro-payment' ) && gutentype_storage_get_array( 'required_plugins', 'elegro-payment', 'install' ) !== false ) {
			$list[] = array(
				'name'     => gutentype_storage_get_array( 'required_plugins', 'elegro-payment' ),
				'slug'     => 'elegro-payment',
				'required' => false,
			);
		}
		return $list;
	}
}

// Check if this plugin installed and activated
if ( ! function_exists( 'gutentype_exists_elegro_payment' ) ) {
	function gutentype_exists_elegro_payment() {
		return class_exists( 'WC_Elegro_Payment' );
	}
}

// Merge custom styles
if ( ! function_exists( 'gutentype_elegro_payment_merge_styles' ) ) {
	function gutentype_elegro_payment_merge_styles( $list ) {
		$list[] = 'plugins/elegro-payment/_elegro-payment.scss';
		return $list;
	}
}