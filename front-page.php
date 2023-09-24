<?php
/**
 * The Front Page template file.
 *
 * @package WordPress
 * @subpackage GUTENTYPE
 * @since GUTENTYPE 1.0.31
 */

get_header();

// If front-page is a static page
if ( get_option( 'show_on_front' ) == 'page' ) {

	// If Front Page Builder is enabled - display sections
	if ( gutentype_is_on( gutentype_get_theme_option( 'front_page_enabled' ) ) ) {

		if ( have_posts() ) {
			the_post();
		}

		$gutentype_sections = gutentype_array_get_keys_by_value( gutentype_get_theme_option( 'front_page_sections' ), 1, false );
		if ( is_array( $gutentype_sections ) ) {
			foreach ( $gutentype_sections as $gutentype_section ) {
				get_template_part( apply_filters( 'gutentype_filter_get_template_part', 'front-page/section', $gutentype_section ), $gutentype_section );
			}
		}

		// Else if this page is blog archive
	} elseif ( is_page_template( 'blog.php' ) ) {
		get_template_part( apply_filters( 'gutentype_filter_get_template_part', 'blog' ) );

		// Else - display native page content
	} else {
		get_template_part( apply_filters( 'gutentype_filter_get_template_part', 'page' ) );
	}

	// Else get index template to show posts
} else {
	get_template_part( apply_filters( 'gutentype_filter_get_template_part', 'index' ) );
}

get_footer();
