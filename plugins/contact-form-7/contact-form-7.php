<?php
/* Contact Form 7 support functions
------------------------------------------------------------------------------- */

// Theme init priorities:
// 9 - register other filters (for installer, etc.)
if ( ! function_exists( 'gutentype_cf7_theme_setup9' ) ) {
	add_action( 'after_setup_theme', 'gutentype_cf7_theme_setup9', 9 );
	function gutentype_cf7_theme_setup9() {

		add_filter( 'gutentype_filter_merge_scripts', 'gutentype_cf7_merge_scripts' );
		add_filter( 'gutentype_filter_merge_styles', 'gutentype_cf7_merge_styles' );

		if ( gutentype_exists_cf7() ) {
			add_action( 'wp_enqueue_scripts', 'gutentype_cf7_frontend_scripts', 1100 );
		}

		if ( is_admin() ) {
			add_filter( 'gutentype_filter_tgmpa_required_plugins', 'gutentype_cf7_tgmpa_required_plugins' );
		}
	}
}

// Filter to add in the required plugins list
if ( ! function_exists( 'gutentype_cf7_tgmpa_required_plugins' ) ) {
	function gutentype_cf7_tgmpa_required_plugins( $list = array() ) {
		if ( gutentype_storage_isset( 'required_plugins', 'contact-form-7' ) ) {
			// CF7 plugin
			$list[] = array(
				'name'     => gutentype_storage_get_array( 'required_plugins', 'contact-form-7' ),
				'slug'     => 'contact-form-7',
				'required' => false,
			);
		}
		return $list;
	}
}



// Check if cf7 installed and activated
if ( ! function_exists( 'gutentype_exists_cf7' ) ) {
	function gutentype_exists_cf7() {
		return class_exists( 'WPCF7' );
	}
}

// Enqueue custom scripts
if ( ! function_exists( 'gutentype_cf7_frontend_scripts' ) ) {
	function gutentype_cf7_frontend_scripts() {
		if ( gutentype_exists_cf7() ) {
			if ( gutentype_is_on( gutentype_get_theme_option( 'debug_mode' ) ) ) {
				$gutentype_url = gutentype_get_file_url( 'plugins/contact-form-7/contact-form-7.js' );
				if ( '' != $gutentype_url ) {
					wp_enqueue_script( 'gutentype-cf7', $gutentype_url, array( 'jquery' ), null, true );
				}
			}
		}
	}
}

// Merge custom scripts
if ( ! function_exists( 'gutentype_cf7_merge_scripts' ) ) {
	function gutentype_cf7_merge_scripts( $list ) {
		if ( gutentype_exists_cf7() ) {
			$list[] = 'plugins/contact-form-7/contact-form-7.js';
		}
		return $list;
	}
}

// Merge custom styles
if ( ! function_exists( 'gutentype_cf7_merge_styles' ) ) {
	function gutentype_cf7_merge_styles( $list ) {
		if ( gutentype_exists_cf7() ) {
			$list[] = 'plugins/contact-form-7/_contact-form-7.scss';
		}
		return $list;
	}
}