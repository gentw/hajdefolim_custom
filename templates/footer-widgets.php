<?php
/**
 * The template to display the widgets area in the footer
 *
 * @package WordPress
 * @subpackage GUTENTYPE
 * @since GUTENTYPE 1.0.10
 */


$gutentype_footer_wide = gutentype_get_theme_option( 'footer_wide' );
$gutentype_widgets_name = gutentype_get_theme_option( 'widgets_top_footer_page' );
$gutentype_show_widgets = ! gutentype_is_off( $gutentype_widgets_name ) && is_active_sidebar( $gutentype_widgets_name );


if ( $gutentype_show_widgets ) { ?>
    <div class="top_footer_widgets_wrap <?php echo ! empty( $gutentype_footer_wide ) ? ' footer_fullwidth' : ''; ?> sc_layouts_row sc_layouts_row_type_normal">
    <?php
    if ( ! $gutentype_footer_wide ) {
        ?>
        <div class="content_wrap">
        <?php
    }
    if ( $gutentype_show_widgets ) {
        gutentype_create_widgets_area( 'widgets_top_footer_page' );
    }
    if ( ! $gutentype_footer_wide ) {
        ?>
        </div><!-- </.content_wrap> -->
        <?php
    } ?>
    </div>
    <?php
}










// Footer sidebar
$gutentype_footer_name    = gutentype_get_theme_option( 'footer_widgets' );
$gutentype_footer_present = ! gutentype_is_off( $gutentype_footer_name ) && is_active_sidebar( $gutentype_footer_name );
if ( $gutentype_footer_present ) {
	gutentype_storage_set( 'current_sidebar', 'footer' );
	$gutentype_footer_wide = gutentype_get_theme_option( 'footer_wide' );
	ob_start();
	if ( is_active_sidebar( $gutentype_footer_name ) ) {
		dynamic_sidebar( $gutentype_footer_name );
	}
	$gutentype_out = trim( ob_get_contents() );
	ob_end_clean();
	if ( ! empty( $gutentype_out ) ) {
		$gutentype_out          = preg_replace( "/<\\/aside>[\r\n\s]*<aside/", '</aside><aside', $gutentype_out );
		$gutentype_need_columns = true;
		if ( $gutentype_need_columns ) {
			$gutentype_columns = max( 0, (int) gutentype_get_theme_option( 'footer_columns' ) );
			if ( 0 == $gutentype_columns ) {
				$gutentype_columns = min( 4, max( 1, substr_count( $gutentype_out, '<aside ' ) ) );
			}
			if ( $gutentype_columns > 1 ) {
				$gutentype_out = preg_replace( '/<aside([^>]*)class="widget/', '<aside$1class="column-1_' . esc_attr( $gutentype_columns ) . ' widget', $gutentype_out );
			} else {
				$gutentype_need_columns = false;
			}
		}
		?>
		<div class="footer_widgets_wrap widget_area<?php echo ! empty( $gutentype_footer_wide ) ? ' footer_fullwidth' : ''; ?> sc_layouts_row sc_layouts_row_type_normal">
			<div class="footer_widgets_inner widget_area_inner">
				<?php
				if ( ! $gutentype_footer_wide ) {
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
				gutentype_show_layout( $gutentype_out );
				do_action( 'gutentype_action_after_sidebar' );
				if ( $gutentype_need_columns ) {
					?>
					</div><!-- /.columns_wrap -->
					<?php
				}
				if ( ! $gutentype_footer_wide ) {
					?>
					</div><!-- /.content_wrap -->
					<?php
				}
				?>
			</div><!-- /.footer_widgets_inner -->
		</div><!-- /.footer_widgets_wrap -->
		<?php
	}
}
