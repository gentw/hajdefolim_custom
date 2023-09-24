<?php
/* The GDPR Framework support functions
------------------------------------------------------------------------------- */

// Theme init priorities:
// 9 - register other filters (for installer, etc.)
if ( ! function_exists( 'gutentype_gmasonry_related_posts_theme_setup9' ) ) {
	add_action( 'after_setup_theme', 'gutentype_gmasonry_related_posts_theme_setup9', 9 );
	function gutentype_gmasonry_related_posts_theme_setup9() {
		if ( is_admin() ) {
			add_filter( 'gutentype_filter_tgmpa_required_plugins', 'gutentype_gmasonry_related_posts_tgmpa_required_plugins' );
		}
	}
}

// Filter to add in the required plugins list
if ( ! function_exists( 'gutentype_gmasonry_related_posts_tgmpa_required_plugins' ) ) {
	function gutentype_gmasonry_related_posts_tgmpa_required_plugins( $list = array() ) {
		if ( gutentype_storage_isset( 'required_plugins', 'gmasonry-related-posts' ) ) {
			$path = gutentype_get_plugin_source_path( 'plugins/gmasonry-related-posts/gmasonry-related-posts.zip' );
			if ( ! empty( $path ) || gutentype_get_theme_setting( 'tgmpa_upload' ) ) {
				$list[] = array(
				  'name'     => gutentype_storage_get_array( 'required_plugins', 'gmasonry-related-posts' ),
				  'slug'     => 'gmasonry-related-posts',
				  'version'  => '1.0',
				  'source'   => ! empty( $path ) ? $path : 'upload://gmasonry-related-posts.zip',
				  'required' => true,
				);
			}
		}
		return $list;
	}
}

// Check if this plugin installed and activated
if ( ! function_exists( 'gutentype_exists_gmasonry_related_posts' ) ) {
	function gutentype_exists_gmasonry_related_posts() {
		return defined( 'GMASONRY_RELATED_POSTS' );
	}
}