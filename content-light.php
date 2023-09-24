<?php
/**
 * The Light template to display the content
 *
 * Used for index/archive/search.
 *
 * @package WordPress
 * @subpackage GUTENTYPE
 * @since GUTENTYPE 1.0
 */

$gutentype_template_args = get_query_var( 'gutentype_template_args' );
if ( is_array( $gutentype_template_args ) ) {
	$gutentype_columns    = empty( $gutentype_template_args['columns'] ) ? 2 : max( 1, $gutentype_template_args['columns'] );
	$gutentype_blog_style = array( $gutentype_template_args['type'], $gutentype_columns );
	if ( ! empty( $gutentype_template_args['slider'] ) ) {
		?><div class="slider-slide swiper-slide">
		<?php
	} elseif ( $gutentype_columns >= 1 ) {
		?>
		<div class="column-1_<?php echo esc_attr( $gutentype_columns ); ?>">
		<?php
	}
}
$gutentype_expanded    = ! gutentype_sidebar_present() && gutentype_is_on( gutentype_get_theme_option( 'expand_content' ) );
$gutentype_post_format = get_post_format();
$gutentype_post_format = empty( $gutentype_post_format ) ? 'standard' : str_replace( 'post-format-', '', $gutentype_post_format );
$gutentype_animation   = gutentype_get_theme_option( 'blog_animation' );

$gutentype_hover = ! empty( $gutentype_template_args['hover'] ) && ! gutentype_is_inherit( $gutentype_template_args['hover'] )
						? $gutentype_template_args['hover']
						: gutentype_get_theme_option( 'image_hover' );
?>
<article id="post-<?php the_ID(); ?>" 
	<?php post_class( 'post_item post_layout_light post_format_' . esc_attr( $gutentype_post_format ) ); ?>
	<?php echo ( ! gutentype_is_off( $gutentype_animation ) && empty( $gutentype_template_args['slider'] ) ? ' data-animation="' . esc_attr( gutentype_get_animation_classes( $gutentype_animation ) ) . '"' : '' ); ?>
	>
	<?php

	// Sticky label
	if ( is_sticky() && ! is_paged() ) {
		?>
		<span class="post_label label_sticky"></span>
		<?php
	}

	// Featured image
	gutentype_show_post_featured(
		array(
		    'show_gallery_on_format_image' => true,
			'singular'   => false,
			'no_links'   => ! empty( $gutentype_template_args['no_links'] ),
			'hover'      => $gutentype_hover,
			'thumb_bg'      => true,
			'simple_show'=> true,
			'thumb_size' => gutentype_get_thumb_size( 'plain' ),
		)
	);

    ?><div class="wrap_light"><?php

			// Title and post meta
        if ( get_the_title() != '' ) {
            ?>
            <div class="post_header entry-header">
                <?php
                do_action( 'gutentype_action_before_post_title' );

                // Post title
                if ( empty( $gutentype_template_args['no_links'] ) ) {
                    the_title( sprintf( '<h2 class="post_title entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' );
                } else {
                    the_title( '<h2 class="post_title entry-title">', '</h2>' );
                }

                do_action( 'gutentype_action_before_post_meta' );

                // Post meta
                $gutentype_components = gutentype_array_get_keys_by_value( gutentype_get_theme_option( 'meta_parts' ) );
                $gutentype_counters   = gutentype_array_get_keys_by_value( gutentype_get_theme_option( 'counters' ) );

                if ( ! empty( $gutentype_components ) && ! in_array( $gutentype_hover, array( 'border', 'pull', 'slide', 'fade' ) ) ) {
                    gutentype_show_post_meta(
                        apply_filters(
                            'gutentype_filter_post_meta_args', array(
                                'components' => $gutentype_components,
                                'counters'   => $gutentype_counters,
                                'seo'        => false,
                            ), 'light', 1
                        )
                    );
                }
                ?>
            </div><!-- .post_header -->
            <?php
        }



        // Post content
        if ( empty( $gutentype_template_args['hide_excerpt'] ) ) {

            ?>
            <div class="post_content entry-content">
            <?php
            if ( gutentype_get_theme_option( 'blog_content' ) == 'fullpost' ) {
                // Post content area
                ?>
                    <div class="post_content_inner">
                    <?php
                    the_content( '' );
                    ?>
                    </div>
                    <?php
                    // Inner pages
                    wp_link_pages(
                        array(
                            'before'      => '<div class="page_links"><span class="page_links_title">' . esc_html__( 'Pages:', 'gutentype' ) . '</span>',
                            'after'       => '</div>',
                            'link_before' => '<span>',
                            'link_after'  => '</span>',
                            'pagelink'    => '<span class="screen-reader-text">' . esc_html__( 'Page', 'gutentype' ) . ' </span>%',
                            'separator'   => '<span class="screen-reader-text">, </span>',
                        )
                    );
            } else {
                // Post content area
                ?>
                    <div class="post_content_inner">
                    <?php
                    if ( has_excerpt() ) {
                            the_excerpt();
                    } elseif ( strpos( get_the_content( '!--more' ), '!--more' ) !== false ) {
                            the_content( '' );
                    } elseif ( in_array( $gutentype_post_format, array( 'link', 'aside', 'status' ) ) ) {
                                            the_content();
                    } elseif ( 'quote' == $gutentype_post_format ) {
                        $quote = gutentype_get_tag( get_the_content(), '<blockquote', '</blockquote>' );
                        if ( ! empty( $quote ) ) {
                            gutentype_show_layout( wpautop( $quote ) );
                        } else {
                            the_excerpt();
                        }
                    } elseif ( substr( get_the_content(), 0, 4 ) != '[vc_' ) {
                        $post_excerpt = get_the_excerpt();
                        echo wp_trim_words( $post_excerpt, 10, '...');
                    }
                    ?>
                    </div>
                    <?php
            }
            ?>
            </div><!-- .entry-content -->
            <?php
        }
        ?>

	</div>
	</article>
<?php

if ( is_array( $gutentype_template_args ) ) {
	if ( ! empty( $gutentype_template_args['slider'] ) || $gutentype_columns >= 1 ) {
		?>
		</div>
		<?php
	}
}
