<?php
/**
 * The template to display default site footer
 *
 * @package WordPress
 * @subpackage GUTENTYPE
 * @since GUTENTYPE 1.0.10
 */

?>
<footer class="footer_wrap footer_plain
<?php
if ( ! gutentype_is_inherit( gutentype_get_theme_option( 'footer_scheme' ) ) ) {
	echo ' scheme_' . esc_attr( gutentype_get_theme_option( 'footer_scheme' ) );
}
?>
				">
	<?php

	// Footer widgets area
	get_template_part( apply_filters( 'gutentype_filter_get_template_part', 'templates/footer-widgets' ) );

	// Socials
	get_template_part( apply_filters( 'gutentype_filter_get_template_part', 'templates/footer-socials-plain' ) );

	// Copyright area
	get_template_part( apply_filters( 'gutentype_filter_get_template_part', 'templates/footer-copyright' ) );

	?>
</footer><!-- /.footer_wrap -->
