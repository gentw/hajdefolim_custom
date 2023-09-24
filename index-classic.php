<?php
/**
 * The template for homepage posts with "Classic" style
 *
 * @package WordPress
 * @subpackage GUTENTYPE
 * @since GUTENTYPE 1.0
 */

get_header();

if ( have_posts() ) {

	gutentype_blog_archive_start();

	$gutentype_classes    = 'posts_container '
						. ( substr( gutentype_get_theme_option( 'blog_style' ), 0, 7 ) == 'classic'
							? 'columns_wrap columns_padding_bottom'
							: 'masonry_wrap'
							);
	$gutentype_stickies   = is_home() ? get_option( 'sticky_posts' ) : false;
	$gutentype_sticky_out = gutentype_get_theme_option( 'sticky_style' ) == 'columns'
							&& is_array( $gutentype_stickies ) && count( $gutentype_stickies ) > 0 && get_query_var( 'paged' ) < 1;
	if ( $gutentype_sticky_out ) {
		?>
		<div class="sticky_wrap columns_wrap">
		<?php
	}
	if ( ! $gutentype_sticky_out ) {
		if ( gutentype_get_theme_option( 'first_post_large' ) && ! is_paged() && ! in_array( gutentype_get_theme_option( 'body_style' ), array( 'fullwide', 'fullscreen' ) ) ) {
			the_post();
			get_template_part( apply_filters( 'gutentype_filter_get_template_part', 'content', 'excerpt' ), 'excerpt' );
		}

		?>
		<div class="<?php echo esc_attr( $gutentype_classes ); ?>">
		<?php
	}
	while ( have_posts() ) {
		the_post();
		if ( $gutentype_sticky_out && ! is_sticky() ) {
			$gutentype_sticky_out = false;
			?>
			</div><div class="<?php echo esc_attr( $gutentype_classes ); ?>">
			<?php
		}
		$gutentype_part = $gutentype_sticky_out && is_sticky() ? 'sticky' : 'classic';
		get_template_part( apply_filters( 'gutentype_filter_get_template_part', 'content', $gutentype_part ), $gutentype_part );
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
