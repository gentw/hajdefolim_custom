<?php
/**
 * The template 'Style 1' to displaying related posts
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

?><div id="post-<?php the_ID(); ?>" <?php post_class( 'related_item related_item_style_1 post_format_' . esc_attr( $gutentype_post_format ) ); ?>>
	<?php
	gutentype_show_post_featured(
		array(
			'thumb_size'    => apply_filters( 'gutentype_filter_related_thumb_size', gutentype_get_thumb_size( (int) gutentype_get_theme_option( 'related_posts' ) == 1 ? 'huge' : 'big' ) ),
			'show_no_image' => gutentype_get_theme_setting( 'allow_no_image' ),
			'singular'      => false,
			'post_info'     => '<div class="post_header entry-header">'
						. '<div class="post_categories">' . wp_kses( gutentype_get_post_categories( '' ), 'gutentype_kses_content' ) . '</div>'
						. '<h6 class="post_title entry-title"><a href="' . esc_url( $gutentype_link ) . '">' . wp_kses_data( get_the_title() ) . '</a></h6>'
						. ( in_array( get_post_type(), array( 'post', 'attachment' ) )
								? '<span class="post_date"><a href="' . esc_url( $gutentype_link ) . '">' . wp_kses_data( gutentype_get_date() ) . '</a></span>'
								: $gutentype_quote_content )
					. '</div>'
				)
	);
	?>
</div>
