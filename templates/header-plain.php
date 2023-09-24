<?php
/**
 * The template to display plain site header
 *
 * @package WordPress
 * @subpackage GUTENTYPE
 * @since GUTENTYPE 1.0
 */

$gutentype_header_css   = '';
$gutentype_header_image = get_header_image();
$gutentype_header_background = gutentype_get_theme_option( 'header_background_color' );
$gutentype_header_video = gutentype_get_header_video();
if ( ! empty( $gutentype_header_image ) && gutentype_trx_addons_featured_image_override( is_singular() || gutentype_storage_isset( 'blog_archive' ) || is_category() ) ) {
	$gutentype_header_image = gutentype_get_current_mode_image( $gutentype_header_image );
}

?><header class="top_panel top_panel_plain
	<?php
	echo ! empty( $gutentype_header_image ) || ! empty( $gutentype_header_video ) ? ' with_bg_image' : ' without_bg_image';
	if ( '' != $gutentype_header_video ) {
		echo ' with_bg_video';
	}

	if( !empty($gutentype_header_background) ){
        echo ' ' . esc_attr( gutentype_add_inline_css_class( 'background-color: ' . esc_url( $gutentype_header_background ) . ';' ) );
	}

	if ( '' != $gutentype_header_image ) {
		echo ' ' . esc_attr( gutentype_add_inline_css_class( 'background-image: url(' . esc_url( $gutentype_header_image ) . ');' ) );
	}
	if ( is_single() && has_post_thumbnail() ) {
		echo ' with_featured_image';
	}
	if ( gutentype_is_on( gutentype_get_theme_option( 'header_fullheight' ) ) ) {
		echo ' header_fullheight gutentype-full-height';
	}
	if ( ! gutentype_is_inherit( gutentype_get_theme_option( 'header_scheme' ) ) ) {
		echo ' scheme_' . esc_attr( gutentype_get_theme_option( 'header_scheme' ) );
	}
	?>
">
	<?php

	// Background video
	if ( ! empty( $gutentype_header_video ) ) {
		get_template_part( apply_filters( 'gutentype_filter_get_template_part', 'templates/header-video' ) );
	}

	// Main menu
	if ( gutentype_get_theme_option( 'menu_style' ) == 'top' ) {
		get_template_part( apply_filters( 'gutentype_filter_get_template_part', 'templates/header-navi-plain' ) );
	}

	// Mobile header
	if ( gutentype_is_on( gutentype_get_theme_option( 'header_mobile_enabled' ) ) ) {
		get_template_part( apply_filters( 'gutentype_filter_get_template_part', 'templates/header-mobile' ) );
	}

	// Page title and breadcrumbs area
	get_template_part( apply_filters( 'gutentype_filter_get_template_part', 'templates/header-title' ) );

	// Header widgets area
	get_template_part( apply_filters( 'gutentype_filter_get_template_part', 'templates/header-widgets' ) );

	// Display featured image in the header on the single posts
	// Comment next line to prevent show featured image in the header area
	// and display it in the post's content
	get_template_part( apply_filters( 'gutentype_filter_get_template_part', 'templates/header-single' ) );

	?>
</header>
