<?php
/**
 * The template 'Style 2' to displaying related posts
 *
 * @package WordPress
 * @subpackage GUTENTYPE
 * @since GUTENTYPE 1.0
 */

$gutentype_link        = get_permalink();
$gutentype_post_format = get_post_format();
$gutentype_post_format = empty( $gutentype_post_format ) ? 'standard' : str_replace( 'post-format-', '', $gutentype_post_format );

$gutentype_quote_content = '';

if ('quote' === $gutentype_post_format) {
	$gutentype_quote_content = gutentype_get_tag( get_the_content(), '<blockquote', '</blockquote>' );
	if ( empty( $gutentype_quote_content ) ) {
		$gutentype_quote_content = wp_kses( get_the_excerpt(), 'gutentype_kses_content' );
	}
}

?><div id="post-<?php the_ID(); ?>" 
	<?php post_class( 'related_item related_item_style_2 post_format_' . esc_attr( $gutentype_post_format ) ); ?>>
						<?php
						gutentype_show_post_featured(
							array(
								'thumb_size'    => apply_filters( 'gutentype_filter_related_thumb_size', gutentype_get_thumb_size( (int) gutentype_get_theme_option( 'related_posts' ) == 1 ? 'huge' : 'plain' ) ),
								'show_no_image' => gutentype_get_theme_setting( 'allow_no_image' ),
								'singular'      => false,
                                'thumb_ratio' => '570:452',
								'post_info'     => $gutentype_quote_content
							)
						);
						?>
	<div class="post_header entry-header">
        <?php
        // Post meta
        gutentype_show_post_meta(
            array(
                'components' => 'categories,date',
                'counters'   => '',
                'seo'        => false,
            )
        );
        ?>
		<h6 class="post_title entry-title"><a href="<?php echo esc_url( $gutentype_link ); ?>"><?php the_title(); ?></a></h6>
	</div>
</div>