<?php
/**
 * The Split template to display the content
 *
 * Used for index/archive/search.
 *
 * @package WordPress
 * @subpackage GUTENTYPE
 * @since GUTENTYPE 1.0
 */

$gutentype_template_args = get_query_var( 'gutentype_template_args' );
if ( is_array( $gutentype_template_args ) ) {
    $gutentype_columns    = 2;
    $gutentype_blog_style = array( $gutentype_template_args['type'], $gutentype_columns );
} else {
    $gutentype_blog_style = explode( '_', gutentype_get_theme_option( 'blog_style' ) );
    $gutentype_columns    = empty( $gutentype_blog_style[1] ) ? 2 : max( 2, $gutentype_blog_style[1] );
}
$gutentype_expanded   = ! gutentype_sidebar_present() && gutentype_is_on( gutentype_get_theme_option( 'expand_content' ) );
$gutentype_animation  = gutentype_get_theme_option( 'blog_animation' );
$gutentype_components = gutentype_array_get_keys_by_value( gutentype_get_theme_option( 'meta_parts' ) );
$gutentype_counters   = gutentype_array_get_keys_by_value( gutentype_get_theme_option( 'counters' ) );

$gutentype_post_format = get_post_format();
$gutentype_post_format = empty( $gutentype_post_format ) ? 'standard' : str_replace( 'post-format-', '', $gutentype_post_format );

?><div class="<?php
if ( ! empty( $gutentype_template_args['slider'] ) ) {
    echo ' slider-slide swiper-slide';
} else {
    echo 'column-in';
}
?>"><article id="post-<?php the_ID(); ?>"
        <?php
        post_class(
            'post_item post_format_' . esc_attr( $gutentype_post_format )
            . ' post_layout_split post_layout_split_' . esc_attr( $gutentype_columns )
            . ' post_layout_' . esc_attr( $gutentype_blog_style[0] )
        );
        echo ( ! gutentype_is_off( $gutentype_animation ) && empty( $gutentype_template_args['slider'] ) ? ' data-animation="' . esc_attr( gutentype_get_animation_classes( $gutentype_animation ) ) . '"' : '' );
        ?>
    >
        <?php

        // Sticky label
        if ( is_sticky() && ! is_paged() ) {
            ?>
            <span class="post_label label_sticky"></span>
            <?php
        }

        // Featured image
        $gutentype_hover = ! empty( $gutentype_template_args['hover'] ) && ! gutentype_is_inherit( $gutentype_template_args['hover'] )
            ? $gutentype_template_args['hover']
            : gutentype_get_theme_option( 'image_hover' );
        gutentype_show_post_featured(
            array(
                'thumb_size' => gutentype_get_thumb_size('plain'),
                'hover'      => $gutentype_hover,
                'no_links'   => ! empty( $gutentype_template_args['no_links'] ),
                'singular'   => false,
                'simple_show'=> true,
                'thumb_ratio' => '570:424',
            )
        );

        if ( ! in_array( $gutentype_post_format, array( 'link', 'aside', 'status', 'quote' ) ) ) {
            ?>
            <div class="post_header entry-header">
                <?php

                do_action( 'gutentype_action_before_post_title' );

                // Post title
                if ( empty( $gutentype_template_args['no_links'] ) ) {
                    the_title( sprintf( '<h4 class="post_title entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h4>' );
                } else {
                    the_title( '<h4 class="post_title entry-title">', '</h4>' );
                }

                do_action( 'gutentype_action_before_post_meta' );
                // Post meta
                if ( ! empty( $gutentype_components ) && ! in_array( $gutentype_hover, array( 'border', 'pull', 'slide', 'fade' ) ) ) {
                    gutentype_show_post_meta(
                        apply_filters(
                            'gutentype_filter_post_meta_args', array(
                            'components' => $gutentype_components,
                            'counters'   => $gutentype_counters,
                            'seo'        => false,
                        ), $gutentype_blog_style[0], $gutentype_columns
                        )
                    );
                }
                do_action( 'gutentype_action_after_post_meta' );
                ?>
            </div><!-- .entry-header -->
            <?php




        } else { ?>
            <div class="post_content_inner">
                <?php
                if ( has_excerpt() ) {
                    the_excerpt();
                } elseif ( in_array( $gutentype_post_format, array( 'link', 'aside', 'status' ) ) ) {
                    the_content();
                } elseif ( 'quote' == $gutentype_post_format ) {
                    $quote = gutentype_get_tag( get_the_content(), '<blockquote', '</blockquote>' );
                    if ( ! empty( $quote ) ) {
                        gutentype_show_layout( wpautop( $quote ) );
                    } else {
                        the_excerpt();
                    }
                }
                ?>
            </div>
        <?php }



        if(false) {
            ?>

            <div class="post_content entry-content">
                <?php
                if (empty($gutentype_template_args['hide_excerpt'])) {
                    ?>
                    <div class="post_content_inner">
                        <?php
                        if (has_excerpt()) {
                            the_excerpt();
                        } elseif (strpos(get_the_content('!--more'), '!--more') !== false) {
                            the_content('');
                        } elseif (in_array($gutentype_post_format, array('link', 'aside', 'status'))) {
                            the_content();
                        } elseif ('quote' == $gutentype_post_format) {
                            $quote = gutentype_get_tag(get_the_content(), '<blockquote>', '</blockquote>');
                            if (!empty($quote)) {
                                gutentype_show_layout(wpautop($quote));
                            } else {
                                the_excerpt();
                            }
                        } elseif (substr(get_the_content(), 0, 4) != '[vc_') {
                            the_excerpt();
                        }
                        ?>
                    </div>
                    <?php
                }
                // Post meta
                if (in_array($gutentype_post_format, array('link', 'aside', 'status', 'quote'))) {
                    if (!empty($gutentype_components)) {
                        gutentype_show_post_meta(
                            apply_filters(
                                'gutentype_filter_post_meta_args', array(
                                'components' => $gutentype_components,
                                'counters' => $gutentype_counters,
                            ), $gutentype_blog_style[0], $gutentype_columns
                            )
                        );
                    }
                }
                // More button
                if (false && empty($gutentype_template_args['no_links']) && !in_array($gutentype_post_format, array('link', 'aside', 'status', 'quote'))) {
                    ?>
                    <p><a class="more-link"
                          href="<?php the_permalink(); ?>"><?php esc_html_e('Read more', 'gutentype'); ?></a>
                    </p>
                    <?php
                }
                ?>
            </div><!-- .entry-content -->

            <?php
        }
        ?>
    </article></div><?php
// Need opening PHP-tag above, because <div> is a inline-block element (used as column)!
