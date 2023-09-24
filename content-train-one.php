<?php
/**
 * The Train One template to display the content
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
	<?php post_class( 'post_item post_layout_train one post_format_' . esc_attr( $gutentype_post_format ) ); ?>
	<?php echo ( ! gutentype_is_off( $gutentype_animation ) && empty( $gutentype_template_args['slider'] ) ? ' data-animation="' . esc_attr( gutentype_get_animation_classes( $gutentype_animation ) ) . '"' : '' ); ?>
	>
	<?php

    $title = '<div class="post_meta">';
    // Post author
    $met_post = get_post(get_the_id(), 'ARRAY_A');
    $author_id = $met_post['post_author'];
    if ($author_id > 0) {
        $author_link = get_author_posts_url($author_id);
        $author_name = get_the_author_meta('display_name', $author_id);
        $title .=
            '<a class="post_meta_item post_author" rel="author" href="' . esc_url($author_link) . '">' . esc_html__('By ', 'gutentype') . esc_html($author_name) . '</a>';
    }
    $title .= '<span class="post_meta_item post_date"><a href="'.esc_url(get_permalink()).'">'.esc_html(get_the_date()).'</a></span>';
    $title .= '</div>';

	// Featured image
	gutentype_show_post_featured(
		array(
		    'show_gallery_on_format_image' => true,
			'singular'   => false,
			'no_links'   => ! empty( $gutentype_template_args['no_links'] ),
			'hover'      => $gutentype_hover,
			'thumb_bg'      => true,
			'simple_show'=> true,
			'thumb_size' => gutentype_get_thumb_size( 'big' ),
			'post_info' => '<div class="post_info">'
                                        . '<span class="post_categories post_meta_item">'.trx_addons_get_post_categories().'</span>'
                                        . '<h5 class="post_title entry-title"><a href="'.esc_url(get_permalink()).'" rel="bookmark">'.wp_kses_post( get_the_title() ).'</a></h5>'
                                        . ( in_array( get_post_type(), array( 'post', 'attachment' ) )
                                            ? $title
                                            : '')
                                        . '</div>'
		)
	);

    ?>
	</article>
<?php

if ( is_array( $gutentype_template_args ) ) {
	if ( ! empty( $gutentype_template_args['slider'] ) || $gutentype_columns > 1 ) {
		?>
		</div>
		<?php
	}
}