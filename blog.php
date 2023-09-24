<?php
/**
 * The template to display blog archive
 *
 * @package WordPress
 * @subpackage GUTENTYPE
 * @since GUTENTYPE 1.0
 */

/*
Template Name: Blog archive
*/

/**
 * Make page with this template and put it into menu
 * to display posts as blog archive
 * You can setup output parameters (blog style, posts per page, parent category, etc.)
 * in the Theme Options section (under the page content)
 * You can build this page in the WordPress editor or any Page Builder to make custom page layout:
 * just insert %%CONTENT%% in the desired place of content
 */

if ( function_exists( 'gutentype_elm_is_preview' ) && gutentype_elm_is_preview() ) {

	// Redirect to the page
	get_template_part( apply_filters( 'gutentype_filter_get_template_part', 'page' ) );

} else {

	// Store post with blog archive template
	if ( have_posts() ) {
		the_post();
		if ( isset( $GLOBALS['post'] ) && is_object( $GLOBALS['post'] ) ) {
			gutentype_storage_set( 'blog_archive_template_post', $GLOBALS['post'] );
		}
	}

	// Prepare args for a new query
	$gutentype_args        = array(
		'post_status' => current_user_can( 'read_private_pages' ) && current_user_can( 'read_private_posts' ) ? array( 'publish', 'private' ) : 'publish',
	);

	$gutentype_args        = gutentype_query_add_posts_and_cats( $gutentype_args, '', gutentype_get_theme_option( 'post_type' ), gutentype_get_list_options_parent_cat() );
	$gutentype_page_number = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : ( get_query_var( 'page' ) ? get_query_var( 'page' ) : 1 );
	if ( $gutentype_page_number > 1 ) {
		$gutentype_args['paged']               = $gutentype_page_number;
		$gutentype_args['ignore_sticky_posts'] = true;
	}
	$gutentype_ppp = gutentype_get_theme_option( 'posts_per_page' );
	if ( 0 != (int) $gutentype_ppp ) {
		$gutentype_args['posts_per_page'] = (int) $gutentype_ppp;
	}
	// Make a new main query
	$GLOBALS['wp_the_query']->query( $gutentype_args );

	get_template_part( apply_filters( 'gutentype_filter_get_template_part', gutentype_blog_archive_get_template() ) );
}
