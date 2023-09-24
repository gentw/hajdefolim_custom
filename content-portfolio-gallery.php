<?php
/**
 * The Gallery template to display posts
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
	$gutentype_columns    = empty( $gutentype_blog_style[1] ) ? 2 : max( 1, $gutentype_blog_style[1] );
}
$gutentype_post_format = get_post_format();
$gutentype_post_format = empty( $gutentype_post_format ) ? 'standard' : str_replace( 'post-format-', '', $gutentype_post_format );
$gutentype_animation   = gutentype_get_theme_option( 'blog_animation' );
$gutentype_image       = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'full' );

?><article id="post-<?php the_ID(); ?>" 
									<?php
									post_class(
										'post_item'
										. ' post_layout_portfolio'
										. ' post_layout_gallery'
										. ' post_layout_gallery_' . esc_attr( $gutentype_columns )
										. ' post_format_' . esc_attr( $gutentype_post_format )
										. ( ! empty( $gutentype_template_args['slider'] ) ? ' slider-slide swiper-slide' : '' )
									);
									echo ( ! gutentype_is_off( $gutentype_animation ) && empty( $gutentype_template_args['slider'] ) ? ' data-animation="' . esc_attr( gutentype_get_animation_classes( $gutentype_animation ) ) . '"' : '' );
									?>
	data-size="
	<?php
	if ( ! empty( $gutentype_image[1] ) && ! empty( $gutentype_image[2] ) ) {
		echo intval( $gutentype_image[1] ) . 'x' . intval( $gutentype_image[2] );}
	?>
	"
	data-src="
	<?php
	if ( ! empty( $gutentype_image[0] ) ) {
		echo esc_url( $gutentype_image[0] );}
	?>
	"
>
<?php

	// Sticky label
if ( is_sticky() && ! is_paged() ) {
	?>
		<span class="post_label label_sticky"></span>
		<?php
}

	// Featured image
	$gutentype_image_hover = 'icon';
if ( in_array( $gutentype_image_hover, array( 'icons', 'zoom' ) ) ) {
	$gutentype_image_hover = 'dots';
}
$gutentype_components = gutentype_array_get_keys_by_value( gutentype_get_theme_option( 'meta_parts' ) );
$gutentype_counters   = gutentype_array_get_keys_by_value( gutentype_get_theme_option( 'counters' ) );
gutentype_show_post_featured(
	array(
		'hover'         => $gutentype_image_hover,
		'singular'      => false,
		'no_links'      => ! empty( $gutentype_template_args['no_links'] ),
		'thumb_size'    => gutentype_get_thumb_size( strpos( gutentype_get_theme_option( 'body_style' ), 'full' ) !== false || $gutentype_columns < 3 ? 'masonry-big' : 'masonry' ),
		'thumb_only'    => true,
		'show_no_image' => true,
		'post_info'     => '<div class="post_details">'
						. '<h2 class="post_title">'
							. ( empty( $gutentype_template_args['no_links'] )
								? '<a href="' . esc_url( get_permalink() ) . '">' . esc_html( get_the_title() ) . '</a>'
								: esc_html( get_the_title() )
								)
						. '</h2>'
						. '<div class="post_description">'
							. ( ! empty( $gutentype_components )
								? gutentype_show_post_meta(
									apply_filters(
										'gutentype_filter_post_meta_args', array(
											'components' => $gutentype_components,
											'counters' => $gutentype_counters,
											'seo'      => false,
											'echo'     => false,
										), $gutentype_blog_style[0], $gutentype_columns
									)
								)
								: ''
								)
							. ( empty( $gutentype_template_args['hide_excerpt'] )
								? '<div class="post_description_content">' . get_the_excerpt() . '</div>'
								: ''
								)
							. ( empty( $gutentype_template_args['no_links'] )
								? '<a href="' . esc_url( get_permalink() ) . '" class="theme_button post_readmore"><span class="post_readmore_label">' . esc_html__( 'Learn more', 'gutentype' ) . '</span></a>'
								: ''
								)
						. '</div>'
					. '</div>',
	)
);
?>
</article><?php
// Need opening PHP-tag above, because <article> is a inline-block element (used as column)!
