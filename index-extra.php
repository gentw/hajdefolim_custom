<?php
/**
 * The template for homepage posts with "Extra" style
 *
 * @package WordPress
 * @subpackage GUTENTYPE
 * @since GUTENTYPE 1.0
 */

gutentype_storage_set( 'blog_archive', true );

get_header();

if ( have_posts() ) {

	gutentype_blog_archive_start();
    $count_all = min($GLOBALS['wp_query']->found_posts, get_query_var('posts_per_page'));
    ?>
    <div class="extra_wrap posts_container">
    <?php
    $count = 0;
	while ( have_posts() ) {
		the_post();

        $count++;
		if($count%2 != 0) {
		    echo '<div class="wrap columns_wrap column-wrap'. (($count == $count_all && $count_all%2 !== 0) ? ' one' : '') .'">';
        }

		$gutentype_part = 'extra';
		get_template_part( apply_filters( 'gutentype_filter_get_template_part', 'content', $gutentype_part ), $gutentype_part );

        if($count%2 == 0 || $count == $count_all) {
            echo '</div>';
        }
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
