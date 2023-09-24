<?php
/**
 * The Sidebar containing the main widget areas.
 *
 * @package WordPress
 * @subpackage GUTENTYPE
 * @since GUTENTYPE 1.0
 */

if ( gutentype_sidebar_present() ) {
	ob_start();
	$gutentype_sidebar_name = gutentype_get_theme_option( 'sidebar_widgets' );
	gutentype_storage_set( 'current_sidebar', 'sidebar' );
	if ( is_active_sidebar( $gutentype_sidebar_name ) ) {
		dynamic_sidebar( $gutentype_sidebar_name );
	}
	$gutentype_out = trim( ob_get_contents() );
	ob_end_clean();
	if ( ! empty( $gutentype_out ) ) {
		$gutentype_sidebar_position = gutentype_get_theme_option( 'sidebar_position' );
		?>
		<div class="sidebar widget_area
			<?php
			echo esc_attr( $gutentype_sidebar_position );
			if ( ! gutentype_is_inherit( gutentype_get_theme_option( 'sidebar_scheme' ) ) ) {
				echo ' scheme_' . esc_attr( gutentype_get_theme_option( 'sidebar_scheme' ) );
			}
			?>
		" role="complementary">
			<div class="sidebar_inner">
				<?php
				do_action( 'gutentype_action_before_sidebar' );
				gutentype_show_layout( preg_replace( "/<\/aside>[\r\n\s]*<aside/", '</aside><aside', $gutentype_out ) );
				do_action( 'gutentype_action_after_sidebar' );
				?>
			</div><!-- /.sidebar_inner -->
		</div><!-- /.sidebar -->
		<div class="clearfix"></div>
		<?php
	}
}
