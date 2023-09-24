<?php
/**
 * The Footer: widgets area, logo, footer menu and socials
 *
 * @package WordPress
 * @subpackage GUTENTYPE
 * @since GUTENTYPE 1.0
 */

						// Widgets area inside page content
						gutentype_create_widgets_area( 'widgets_below_content' );
						?>
					</div><!-- </.content> -->

					<?php
					// Show main sidebar
					get_sidebar();

					$gutentype_body_style = gutentype_get_theme_option( 'body_style' );
					if ( 'fullscreen' != $gutentype_body_style ) {
						?>
						</div><!-- </.content_wrap> -->
						<?php
					}

					// Widgets area below page content and related posts below page content
					$gutentype_widgets_name = gutentype_get_theme_option( 'widgets_below_page' );
					$gutentype_show_widgets = ! gutentype_is_off( $gutentype_widgets_name ) && is_active_sidebar( $gutentype_widgets_name );
					$gutentype_show_related = is_single() && gutentype_get_theme_option( 'related_position' ) == 'below_page';
					if ( $gutentype_show_widgets || $gutentype_show_related ) {
						if ( 'fullscreen' != $gutentype_body_style ) {
							?>
							<div class="content_wrap">
							<?php
						}
						// Show related posts before footer
						if ( $gutentype_show_related ) {
							do_action( 'gutentype_action_related_posts' );
						}

						// Widgets area below page content
						if ( $gutentype_show_widgets ) {
							gutentype_create_widgets_area( 'widgets_below_page' );
						}
						if ( 'fullscreen' != $gutentype_body_style ) {
							?>
							</div><!-- </.content_wrap> -->
							<?php
						}
					}
					?>
			</div><!-- </.page_content_wrap> -->

			<?php
			// Footer
			$gutentype_footer_type = gutentype_get_theme_option( 'footer_type' );
			if ( 'custom' == $gutentype_footer_type && ! gutentype_is_layouts_available() ) {
				$gutentype_footer_type = 'custom';
			}
			get_template_part( apply_filters( 'gutentype_filter_get_template_part', "templates/footer-{$gutentype_footer_type}" ) );
			?>

		</div><!-- /.page_wrap -->

	</div><!-- /.body_wrap -->

    <?php
        if ( gutentype_is_on( gutentype_get_theme_option( 'show_social_side' ) ) ) {
            gutentype_show_layout( gutentype_get_socials_links(), '<div class="socials_wrap side">', '</div>' );
        }
    ?>

	<?php wp_footer(); ?>

</body>
</html>
