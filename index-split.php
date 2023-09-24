<?php
/**
 * The template for homepage posts with "Split" style
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
    <div class="split_wrap posts_container">
        <div class="columns_wrap">
            <?php
            $count = 1;
            while ( have_posts() ) {
                the_post();

                if($count === 1) {
                    echo '<div class="column-1_1">';
                    $gutentype_part = 'split-one';
                } else {
                    echo '<div class="column-1_2">';
                    $gutentype_part = 'split';
                }


                get_template_part( apply_filters( 'gutentype_filter_get_template_part', 'content', $gutentype_part ), $gutentype_part );

                echo '</div>';

                $count++;
            }
            ?>
        </div>
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