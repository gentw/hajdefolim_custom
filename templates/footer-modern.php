<?php
/**
 * The template to display modern site footer
 *
 * @package WordPress
 * @subpackage GUTENTYPE
 * @since GUTENTYPE 1.0.10
 */

?>
<footer class="footer_wrap footer_default modern_style
<?php
if ( ! gutentype_is_inherit( gutentype_get_theme_option( 'footer_scheme' ) ) ) {
	echo ' scheme_' . esc_attr( gutentype_get_theme_option( 'footer_scheme' ) );
}
?>
				">
	<?php

	// Footer widgets area
	get_template_part( apply_filters( 'gutentype_filter_get_template_part', 'templates/footer-widgets' ) );

    // Logo
    get_template_part( apply_filters( 'gutentype_filter_get_template_part', 'templates/footer-logo' ) );

	// Socials
	get_template_part( apply_filters( 'gutentype_filter_get_template_part', 'templates/footer-socials' ) );

    // Menu
    get_template_part( apply_filters( 'gutentype_filter_get_template_part', 'templates/footer-menu' ) );

	// Copyright area
	get_template_part( apply_filters( 'gutentype_filter_get_template_part', 'templates/footer-copyright-modern' ) );

	?>
</footer><!-- /.footer_wrap -->
