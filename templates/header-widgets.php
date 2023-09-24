<?php
/**
 * The template to display the widgets area in the header
 *
 * @package WordPress
 * @subpackage GUTENTYPE
 * @since GUTENTYPE 1.0
 */

// Header sidebar
$gutentype_header_name    = gutentype_get_theme_option( 'header_widgets' );
$gutentype_header_present = ! gutentype_is_off( $gutentype_header_name ) && is_active_sidebar( $gutentype_header_name );
if ( $gutentype_header_present ) {
	gutentype_storage_set( 'current_sidebar', 'header' );
	$gutentype_header_wide = gutentype_get_theme_option( 'header_wide' );
	ob_start();
	if ( is_active_sidebar( $gutentype_header_name ) ) {
		dynamic_sidebar( $gutentype_header_name );
	}
	$gutentype_widgets_output = ob_get_contents();
	ob_end_clean();
	if ( ! empty( $gutentype_widgets_output ) ) {
		$gutentype_widgets_output = preg_replace( "/<\/aside>[\r\n\s]*<aside/", '</aside><aside', $gutentype_widgets_output );
		$gutentype_need_columns   = strpos( $gutentype_widgets_output, 'columns_wrap' ) === false;
		if ( $gutentype_need_columns ) {
			$gutentype_columns = max( 0, (int) gutentype_get_theme_option( 'header_columns' ) );
			if ( 0 == $gutentype_columns ) {
				$gutentype_columns = min( 6, max( 1, substr_count( $gutentype_widgets_output, '<aside ' ) ) );
			}
			if ( $gutentype_columns > 1 ) {
				$gutentype_widgets_output = preg_replace( '/<aside([^>]*)class="widget/', '<aside$1class="column-1_' . esc_attr( $gutentype_columns ) . ' widget', $gutentype_widgets_output );
			} else {
				$gutentype_need_columns = false;
			}
		}
		?>
		<div class="header_widgets_wrap widget_area<?php echo ! empty( $gutentype_header_wide ) ? ' header_fullwidth' : ' header_boxed'; ?>">
			<div class="header_widgets_inner widget_area_inner">
				<?php
				if ( ! $gutentype_header_wide ) {
					?>
					<div class="content_wrap">
					<?php
				}
				if ( $gutentype_need_columns ) {
					?>
					<div class="columns_wrap">
					<?php
				}
				do_action( 'gutentype_action_before_sidebar' );
				gutentype_show_layout( $gutentype_widgets_output );
				do_action( 'gutentype_action_after_sidebar' );
				if ( $gutentype_need_columns ) {
					?>
					</div>	<!-- /.columns_wrap -->
					<?php
				}
				if ( ! $gutentype_header_wide ) {
					?>
					</div>	<!-- /.content_wrap -->
					<?php
				}
				?>
			</div>	<!-- /.header_widgets_inner -->
		</div>	<!-- /.header_widgets_wrap -->
		<?php
	}
}
