<?php
/**
 * The template for homepage posts with "Train" style
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
        $count = 1;
		while ( have_posts() ) {
			the_post();

            if( $count%3 == 0 ) {
                $gutentype_part = 'train-one';
            } else {
                $gutentype_part = 'train';
            }
			get_template_part( apply_filters( 'gutentype_filter_get_template_part', 'content', $gutentype_part ), $gutentype_part );
            $count++;
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