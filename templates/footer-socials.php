<?php
/**
 * The template to display the socials in the footer
 *
 * @package WordPress
 * @subpackage GUTENTYPE
 * @since GUTENTYPE 1.0.10
 */


// Socials
if ( gutentype_is_on( gutentype_get_theme_option( 'socials_in_footer' ) ) ) {
	$gutentype_output = gutentype_get_socials_links();
	if ( '' != $gutentype_output ) {
		?>
		<div class="footer_socials_wrap socials_wrap">
			<div class="footer_socials_inner">
				<?php gutentype_show_layout( $gutentype_output ); ?>
			</div>
		</div>
		<?php
	}
}
