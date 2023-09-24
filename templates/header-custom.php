<?php
/**
 * The template to display custom header from the ThemeREX Addons Layouts
 *
 * @package WordPress
 * @subpackage GUTENTYPE
 * @since GUTENTYPE 1.0.06
 */

$gutentype_header_css   = '';
$gutentype_header_image = get_header_image();
$gutentype_header_video = gutentype_get_header_video();
if ( ! empty( $gutentype_header_image ) && gutentype_trx_addons_featured_image_override( is_singular() || gutentype_storage_isset( 'blog_archive' ) || is_category() ) ) {
	$gutentype_header_image = gutentype_get_current_mode_image( $gutentype_header_image );
}

$gutentype_header_id = str_replace( 'header-custom-', '', gutentype_get_theme_option( 'header_style' ) );
if ( 0 == (int) $gutentype_header_id ) {
	$gutentype_header_id = gutentype_get_post_id(
		array(
			'name'      => $gutentype_header_id,
			'post_type' => defined( 'TRX_ADDONS_CPT_LAYOUTS_PT' ) ? TRX_ADDONS_CPT_LAYOUTS_PT : 'cpt_layouts',
		)
	);
} else {
	$gutentype_header_id = apply_filters( 'gutentype_filter_get_translated_layout', $gutentype_header_id );
}
$gutentype_header_meta = get_post_meta( $gutentype_header_id, 'trx_addons_options', true );
if ( ! empty( $gutentype_header_meta['margin'] ) != '' ) {
	gutentype_add_inline_css( sprintf( '.page_content_wrap{padding-top:%s}', esc_attr( gutentype_prepare_css_value( $gutentype_header_meta['margin'] ) ) ) );
}

?><header class="top_panel top_panel_custom top_panel_custom_<?php echo esc_attr( $gutentype_header_id ); ?> top_panel_custom_<?php echo esc_attr( sanitize_title( get_the_title( $gutentype_header_id ) ) ); ?>
				<?php
				echo ! empty( $gutentype_header_image ) || ! empty( $gutentype_header_video )
					? ' with_bg_image'
					: ' without_bg_image';
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

	// Background video
	if ( ! empty( $gutentype_header_video ) ) {
		get_template_part( apply_filters( 'gutentype_filter_get_template_part', 'templates/header-video' ) );
	}

	// Custom header's layout
	do_action( 'gutentype_action_show_layout', $gutentype_header_id );

	// Header widgets area
	get_template_part( apply_filters( 'gutentype_filter_get_template_part', 'templates/header-widgets' ) );

	?>
</header>
