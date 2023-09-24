<?php
/**
 * The template to display the logo or the site name and the slogan in the Header
 *
 * @package WordPress
 * @subpackage GUTENTYPE
 * @since GUTENTYPE 1.0
 */

$gutentype_args = get_query_var( 'gutentype_logo_args' );

// Site logo
$gutentype_logo_type   = isset( $gutentype_args['type'] ) ? $gutentype_args['type'] : '';
$gutentype_logo_image  = gutentype_get_logo_image( $gutentype_logo_type );
$gutentype_logo_text   = gutentype_is_on( gutentype_get_theme_option( 'logo_text' ) ) ? get_bloginfo( 'name' ) : '';
$gutentype_logo_slogan = get_bloginfo( 'description', 'display' );
if ( ! empty( $gutentype_logo_image ) || ! empty( $gutentype_logo_text ) ) {
	?><a class="sc_layouts_logo" href="<?php echo esc_url( home_url( '/' ) ); ?>">
		<?php
		if ( ! empty( $gutentype_logo_image ) ) {
			if ( empty( $gutentype_logo_type ) && function_exists( 'the_custom_logo' ) && (int) $gutentype_logo_image > 0 ) {
				the_custom_logo();
			} else {
				$gutentype_attr = gutentype_getimagesize( $gutentype_logo_image );
				echo '<img src="' . esc_url( $gutentype_logo_image ) . '" alt="' . esc_attr( $gutentype_logo_text ) . '"' . ( ! empty( $gutentype_attr[3] ) ? ' ' . wp_kses_data( $gutentype_attr[3] ) : '' ) . '>';
			}
		} else {
			gutentype_show_layout( gutentype_prepare_macros( $gutentype_logo_text ), '<span class="logo_text">', '</span>' );
			gutentype_show_layout( gutentype_prepare_macros( $gutentype_logo_slogan ), '<span class="logo_slogan">', '</span>' );
		}
		?>
	</a>
	<?php
}
