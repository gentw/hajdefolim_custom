<?php
/**
 * The template to display the site logo in the footer
 *
 * @package WordPress
 * @subpackage GUTENTYPE
 * @since GUTENTYPE 1.0.10
 */

// Logo
if ( gutentype_is_on( gutentype_get_theme_option( 'logo_in_footer' ) ) ) {
	$gutentype_logo_image = gutentype_get_logo_image( 'footer' );
	$gutentype_logo_text  = get_bloginfo( 'name' );
	if ( ! empty( $gutentype_logo_image ) || ! empty( $gutentype_logo_text ) ) {
		?>
		<div class="footer_logo_wrap">
			<div class="footer_logo_inner">
				<?php
				if ( ! empty( $gutentype_logo_image ) ) {
					$gutentype_attr = gutentype_getimagesize( $gutentype_logo_image );
					echo '<a href="' . esc_url( home_url( '/' ) ) . '">'
							. '<img src="' . esc_url( $gutentype_logo_image ) . '"'
								. ' class="logo_footer_image"'
								. ' alt="' . esc_attr__( 'Site logo', 'gutentype' ) . '"'
								. ( ! empty( $gutentype_attr[3] ) ? ' ' . wp_kses_data( $gutentype_attr[3] ) : '' )
							. '>'
						. '</a>';
				} elseif ( ! empty( $gutentype_logo_text ) ) {
					echo '<h1 class="logo_footer_text">'
							. '<a href="' . esc_url( home_url( '/' ) ) . '">'
								. esc_html( $gutentype_logo_text )
							. '</a>'
						. '</h1>';
				}
				?>
			</div>
		</div>
		<?php
	}
}
