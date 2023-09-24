<?php
/**
 * The Portfolio template to display the content
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
} else {
	$gutentype_blog_style = explode( '_', gutentype_get_theme_option( 'blog_style' ) );
	$gutentype_columns    = empty( $gutentype_blog_style[1] ) ? 2 : max( 2, $gutentype_blog_style[1] );
}
$gutentype_post_format = get_post_format();
$gutentype_post_format = empty( $gutentype_post_format ) ? 'standard' : str_replace( 'post-format-', '', $gutentype_post_format );
$gutentype_animation   = gutentype_get_theme_option( 'blog_animation' );

?><article id="post-<?php the_ID(); ?>" 
									<?php
									post_class(
										'post_item'
										. ' post_layout_portfolio'
										. ' post_layout_portfolio_' . esc_attr( $gutentype_columns )
										. ' post_format_' . esc_attr( $gutentype_post_format )
										. ( is_sticky() && ! is_paged() ? ' sticky' : '' )
										. ( ! empty( $gutentype_template_args['slider'] ) ? ' slider-slide swiper-slide' : '' )
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

	$gutentype_image_hover = ! empty( $gutentype_template_args['hover'] ) && ! gutentype_is_inherit( $gutentype_template_args['hover'] )
								? $gutentype_template_args['hover']
								: gutentype_get_theme_option( 'image_hover' );
	// Featured image
	gutentype_show_post_featured(
		array(
			'singular'      => false,
			'hover'         => $gutentype_image_hover,
			'no_links'      => ! empty( $gutentype_template_args['no_links'] ),
			'thumb_size'    => gutentype_get_thumb_size(
				strpos( gutentype_get_theme_option( 'body_style' ), 'full' ) !== false || $gutentype_columns < 3
								? 'masonry-big'
				: 'masonry'
			),
			'show_no_image' => true,
			'class'         => 'dots' == $gutentype_image_hover ? 'hover_with_info' : '',
			'post_info'     => 'dots' == $gutentype_image_hover ? '<div class="post_info">' . esc_html( get_the_title() ) . '</div>' : '',
		)
	);
	?>
</article><?php
// Need opening PHP-tag above, because <article> is a inline-block element (used as column)!