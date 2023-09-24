<?php
/**
 * The template for homepage posts with "Simple" style
 *
 * @package WordPress
 * @subpackage GUTENTYPE
 * @since GUTENTYPE 1.0
 */

gutentype_storage_set( 'blog_archive', true );

get_header();

if ( have_posts() ) {

	gutentype_blog_archive_start();

	?><div class="posts_container">
		<?php

		$gutentype_stickies   = is_home() ? get_option( 'sticky_posts' ) : false;
		$gutentype_sticky_out = gutentype_get_theme_option( 'sticky_style' ) == 'columns'
								&& is_array( $gutentype_stickies ) && count( $gutentype_stickies ) > 0 && get_query_var( 'paged' ) < 1;
		if ( $gutentype_sticky_out ) {
			?>
			<div class="sticky_wrap columns_wrap">
			<?php
		}

        $gutentype_widgets_blog_page = gutentype_get_theme_option( 'widgets_blog_page' );
        $gutentype_show_widgets = ! gutentype_is_off( $gutentype_widgets_blog_page ) && is_active_sidebar( $gutentype_widgets_blog_page );

		while ( have_posts() ) {
			the_post();
			if ( $gutentype_sticky_out && ! is_sticky() ) {
				$gutentype_sticky_out = false;
				?>
				</div>
				<?php
			}
			$gutentype_part = $gutentype_sticky_out && is_sticky() ? 'sticky' : 'simple';
			get_template_part( apply_filters( 'gutentype_filter_get_template_part', 'content', $gutentype_part ), $gutentype_part );
		}
		if ( $gutentype_sticky_out ) {
			$gutentype_sticky_out = false;
			?>
			</div>
			<?php
		}

		?>
	</div>
	<?php

	gutentype_show_pagination();

	gutentype_blog_archive_end();

} else {

	if ( is_search() ) {
		get_template_part( apply_filters( 'gutentype_filter_get_template_part', 'content', 'none-search' ), 'none-search' );
	} else {
		get_template_part( apply_filters( 'gutentype_filter_get_template_part', 'content', 'none-archive' ), 'none-archive' );
	}
}

get_footer();
