<?php
/**
 * The template to display default site footer
 *
 * @package WordPress
 * @subpackage GUTENTYPE
 * @since GUTENTYPE 1.0.10
 */

$gutentype_footer_id = str_replace( 'footer-custom-', '', gutentype_get_theme_option( 'footer_style' ) );
if ( 0 == (int) $gutentype_footer_id ) {
	$gutentype_footer_id = gutentype_get_post_id(
		array(
			'name'      => $gutentype_footer_id,
			'post_type' => defined( 'TRX_ADDONS_CPT_LAYOUTS_PT' ) ? TRX_ADDONS_CPT_LAYOUTS_PT : 'cpt_layouts',
		)
	);
} else {
	$gutentype_footer_id = apply_filters( 'gutentype_filter_get_translated_layout', $gutentype_footer_id );
}
$gutentype_footer_meta = get_post_meta( $gutentype_footer_id, 'trx_addons_options', true );
if ( ! empty( $gutentype_footer_meta['margin'] ) != '' ) {
	gutentype_add_inline_css( sprintf( '.page_content_wrap{padding-bottom:%s}', esc_attr( gutentype_prepare_css_value( $gutentype_footer_meta['margin'] ) ) ) );
}
?>
<footer class="footer_wrap footer_custom footer_custom_<?php echo esc_attr( $gutentype_footer_id ); ?> footer_custom_<?php echo esc_attr( sanitize_title( get_the_title( $gutentype_footer_id ) ) ); ?>
						<?php
						if ( ! gutentype_is_inherit( gutentype_get_theme_option( 'footer_scheme' ) ) ) {
							echo ' scheme_' . esc_attr( gutentype_get_theme_option( 'footer_scheme' ) );
						}
						?>
						">
	<?php
	// Custom footer's layout
	do_action( 'gutentype_action_show_layout', $gutentype_footer_id );
	?>
</footer><!-- /.footer_wrap -->
