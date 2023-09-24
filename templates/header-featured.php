<?php
/**
 * The template to display default site header
 *
 * @package WordPress
 * @subpackage GUTENTYPE
 * @since GUTENTYPE 1.0
 */

$gutentype_header_css   = '';
$gutentype_header_image = get_header_image();
$gutentype_header_video = gutentype_get_header_video();
if ( ! empty( $gutentype_header_image ) && gutentype_trx_addons_featured_image_override( is_singular() || gutentype_storage_isset( 'blog_archive' ) || is_category() ) ) {
	$gutentype_header_image = gutentype_get_current_mode_image( $gutentype_header_image );
}

?><header class="top_panel top_panel_featured header
	<?php
echo ! empty( $gutentype_header_image ) || ! empty( $gutentype_header_video ) ? ' with_bg_image' : ' without_bg_image';
if ( '' != $gutentype_header_video ) {
	echo ' with_bg_video';
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
	wp_enqueue_style( 'gutentype-header-side-css', gutentype_get_file_url( 'css/header-side.css' ), array(), null );

	gutentype_sc_layouts_showed( 'title', true );
	gutentype_sc_layouts_showed( 'postmeta', true );

	// Background video
	if ( ! empty( $gutentype_header_video ) ) {
		get_template_part( apply_filters( 'gutentype_filter_get_template_part', 'templates/header-video' ) );
	}

	// Main menu
	if ( gutentype_get_theme_option( 'menu_style' ) == 'top' ) {
		get_template_part( apply_filters( 'gutentype_filter_get_template_part', 'templates/header-navi' ) );
	}

	// Mobile header
	if ( gutentype_is_on( gutentype_get_theme_option( 'header_mobile_enabled' ) ) ) {
		get_template_part( apply_filters( 'gutentype_filter_get_template_part', 'templates/header-mobile' ) );
	}

	// Display featured image in the header on the single posts
	// Comment next line to prevent show featured image in the header area
	// and display it in the post's content
	if ( get_query_var( 'gutentype_header_image' ) == '' && gutentype_trx_addons_featured_image_override( is_singular() && has_post_thumbnail() && in_array( get_post_type(), array( 'post', 'page' ) ) ) ) {
		$gutentype_src = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'full' );
		if ( ! empty( $gutentype_src[0] ) ) {
			gutentype_sc_layouts_showed( 'featured', true );
			?>
            <div class="sc_layouts_featured with_image without_content <?php echo esc_attr( gutentype_add_inline_css_class( 'background-image:url(' . esc_url( $gutentype_src[0] ) . ');' ) ); ?>">
                <div class="title-box">
                    <h1><?php echo get_the_title();?></h1>
                    <p class="subline"><?php echo gutentype_get_theme_option( 'header_subtitle' )?></p>
                </div>
            </div>
			<?php
		}
	}

	// Header widgets area
	get_template_part( apply_filters( 'gutentype_filter_get_template_part', 'templates/header-widgets' ) );

	?>
</header>
