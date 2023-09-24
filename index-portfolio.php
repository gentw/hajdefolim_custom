<?php
/**
 * The template for homepage posts with "Portfolio" style
 *
 * @package WordPress
 * @subpackage GUTENTYPE
 * @since GUTENTYPE 1.0
 */

gutentype_storage_set( 'blog_archive', true );

get_header();

if ( have_posts() ) {

    gutentype_blog_archive_start();

    $gutentype_stickies   = is_home() ? get_option( 'sticky_posts' ) : false;
    $gutentype_sticky_out = gutentype_get_theme_option( 'sticky_style' ) == 'columns'
        && is_array( $gutentype_stickies ) && count( $gutentype_stickies ) > 0 && get_query_var( 'paged' ) < 1;

    // Show filters
    $args = array_merge(
        array(
            'post_type'  => '',
            'taxonomy'   => '',
            'parent_cat' => 0,
            'posts_per_page' => 0,
        )
    );

    $gutentype_cat          = gutentype_get_list_options_parent_cat();
    $gutentype_post_type    = gutentype_get_theme_option( 'post_type' );
    $gutentype_taxonomy     = '';
    $gutentype_show_filters = gutentype_get_theme_option( 'show_filters' );
    $gutentype_tabs         = array();
    if ( ! gutentype_is_off( $gutentype_show_filters ) ) {
        $gutentype_args           = array(
            'type'         =>  ! empty( $args['post_type'] ) ? $args['post_type'] : 'post',
            'child_of'     => $args['parent_cat'],
            'orderby'      => 'name',
            'order'        => 'ASC',
            'hide_empty'   => 1,
            'hierarchical' => 0,
            'taxonomy'     => ! empty( $args['taxonomy'] ) ? $args['taxonomy'] : 'category',
            'pad_counts'   => false,
        );
        $gutentype_portfolio_list = get_terms( $gutentype_args );
        if ( is_array( $gutentype_portfolio_list ) && count( $gutentype_portfolio_list ) > 0 ) {
            $gutentype_tabs[ $gutentype_cat ] = esc_html__( 'All', 'gutentype' );
            foreach ( $gutentype_portfolio_list as $gutentype_term ) {
                if ( isset( $gutentype_term->term_id ) ) {
                    $gutentype_tabs[ $gutentype_term->term_id ] = $gutentype_term->name;
                }
            }
        }
    }
    if ( count( $gutentype_tabs ) > 0 ) {
        $gutentype_portfolio_filters_ajax   = true;
        $gutentype_portfolio_filters_active = $gutentype_cat;
        $gutentype_portfolio_filters_id     = 'portfolio_filters';
        ?>
        <div class="portfolio_filters gutentype_tabs gutentype_tabs_ajax">
            <ul class="portfolio_titles gutentype_tabs_titles">
                <?php
                foreach ( $gutentype_tabs as $gutentype_id => $gutentype_title ) {
                    ?>
                    <li><a href="<?php echo esc_url( gutentype_get_hash_link( sprintf( '#%s_%s_content', $gutentype_portfolio_filters_id, $gutentype_id ) ) ); ?>" data-tab="<?php echo esc_attr( $gutentype_id ); ?>"><?php echo esc_html( $gutentype_title ); ?></a></li>
                    <?php
                }
                ?>
            </ul>
            <?php
            $gutentype_ppp = gutentype_get_theme_option( 'posts_per_page' );
            if ( gutentype_is_inherit( $gutentype_ppp ) ) {
                $gutentype_ppp = '';
            }
            foreach ( $gutentype_tabs as $gutentype_id => $gutentype_title ) {
                $gutentype_portfolio_need_content = $gutentype_id == $gutentype_portfolio_filters_active || ! $gutentype_portfolio_filters_ajax;
                ?>
                <div id="<?php echo esc_attr( sprintf( '%s_%s_content', $gutentype_portfolio_filters_id, $gutentype_id ) ); ?>"
                     class="portfolio_content gutentype_tabs_content"
                     data-blog-template="<?php echo esc_attr( gutentype_storage_get( 'blog_template' ) ); ?>"
                     data-blog-style="<?php echo esc_attr( gutentype_get_theme_option( 'blog_style' ) ); ?>"
                     data-posts-per-page="<?php echo esc_attr( $gutentype_ppp ); ?>"
                     data-post-type="<?php echo esc_attr( $gutentype_post_type ); ?>"
                     data-taxonomy="<?php echo esc_attr( $gutentype_taxonomy ); ?>"
                     data-cat="<?php echo esc_attr( $gutentype_id ); ?>"
                     data-parent-cat="<?php echo esc_attr( $gutentype_cat ); ?>"
                     data-need-content="<?php echo ( false === $gutentype_portfolio_need_content ? 'true' : 'false' ); ?>"
                >
                    <?php
                    if ( $gutentype_portfolio_need_content ) {
                        gutentype_show_portfolio_posts(
                            array(
                                'cat'        => $gutentype_id,
                                'parent_cat' => $gutentype_cat,
                                'taxonomy'   => $gutentype_taxonomy,
                                'post_type'  => $gutentype_post_type,
                                'page'       => 1,
                                'sticky'     => $gutentype_sticky_out,
                            )
                        );
                    }
                    ?>
                </div>
                <?php
            }
            ?>
        </div>
        <?php
    } else {
        gutentype_show_portfolio_posts(
            array(
                'cat'        => $gutentype_cat,
                'parent_cat' => $gutentype_cat,
                'taxonomy'   => $gutentype_taxonomy,
                'post_type'  => $gutentype_post_type,
                'page'       => 1,
                'sticky'     => $gutentype_sticky_out,
            )
        );
    }

    gutentype_blog_archive_end();

} else {

    if ( is_search() ) {
        get_template_part( apply_filters( 'gutentype_filter_get_template_part', 'content', 'none-search' ), 'none-search' );
    } else {
        get_template_part( apply_filters( 'gutentype_filter_get_template_part', 'content', 'none-archive' ), 'none-archive' );
    }
}

get_footer();
