<?php
/**
 * The Classic template to display the content
 *
 * Used for index/archive/search.
 *
 * @package WordPress
 * @subpackage GUTENTYPE
 * @since GUTENTYPE 1.0
 */

$gutentype_template_args = get_query_var( 'gutentype_template_args' );
if ( is_array( $gutentype_template_args ) ) {
	$gutentype_columns    = empty( $gutentype_template_args['columns'] ) ? 1 : max( 1, min( 3, $gutentype_template_args['columns'] ) );
	$gutentype_blog_style = array( $gutentype_template_args['type'], $gutentype_columns );
} else {
	$gutentype_blog_style = explode( '_', gutentype_get_theme_option( 'blog_style' ) );
	$gutentype_columns    = empty( $gutentype_blog_style[1] ) ? 1 : max( 1, min( 3, $gutentype_blog_style[1] ) );
}
$gutentype_expanded    = ! gutentype_sidebar_present() && gutentype_is_on( gutentype_get_theme_option( 'expand_content' ) );
$gutentype_post_format = get_post_format();
$gutentype_post_format = empty( $gutentype_post_format ) ? 'standard' : str_replace( 'post-format-', '', $gutentype_post_format );
$gutentype_animation   = gutentype_get_theme_option( 'blog_animation' );

?><article id="post-<?php the_ID(); ?>" 
									<?php
									post_class(
										'post_item'
										. ' post_layout_chess'
										. ' post_layout_chess_' . esc_attr( $gutentype_columns )
										. ' post_format_' . esc_attr( $gutentype_post_format )
										. ( ! empty( $gutentype_template_args['slider'] ) ? ' slider-slide swiper-slide' : '' )
									);
									echo ( ! gutentype_is_off( $gutentype_animation ) && empty( $gutentype_template_args['slider'] ) ? ' data-animation="' . esc_attr( gutentype_get_animation_classes( $gutentype_animation ) ) . '"' : '' );
									?>
	>

	<?php
	// Add anchor
	if ( 1 == $gutentype_columns && ! is_array( $gutentype_template_args ) && shortcode_exists( 'trx_sc_anchor' ) ) {
		echo do_shortcode( '[trx_sc_anchor id="post_' . esc_attr( get_the_ID() ) . '" title="' . the_title_attribute( array( 'echo' => false ) ) . '" icon="' . esc_attr( gutentype_get_post_icon() ) . '"]' );
	}

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
			'class'         => 1 == $gutentype_columns && ! is_array( $gutentype_template_args ) ? 'gutentype-full-height' : '',
			'singular'      => false,
			'hover'         => $gutentype_hover,
			'no_links'      => ! empty( $gutentype_template_args['no_links'] ),
			'show_no_image' => true,
			'thumb_ratio'   => '1:1',
			'thumb_bg'      => true,
			'thumb_size'    => gutentype_get_thumb_size(
				strpos( gutentype_get_theme_option( 'body_style' ), 'full' ) !== false
										? ( 1 < $gutentype_columns ? 'huge' : 'original' )
										: ( 2 < $gutentype_columns ? 'big' : 'huge' )
			),
		)
	);

	?>
	<div class="post_inner"><div class="post_inner_content"><div class="post_header entry-header">
		<?php
			do_action( 'gutentype_action_before_post_title' );

			// Post title
		if ( empty( $gutentype_template_args['no_links'] ) ) {
			the_title( sprintf( '<h3 class="post_title entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h3>' );
		} else {
			the_title( '<h3 class="post_title entry-title">', '</h3>' );
		}

			do_action( 'gutentype_action_before_post_meta' );

			// Post meta
			$gutentype_components = gutentype_array_get_keys_by_value( gutentype_get_theme_option( 'meta_parts' ) );
			$gutentype_counters   = gutentype_array_get_keys_by_value( gutentype_get_theme_option( 'counters' ) );
			$gutentype_post_meta  = empty( $gutentype_components ) || in_array( $gutentype_hover, array( 'border', 'pull', 'slide', 'fade' ) )
										? ''
										: gutentype_show_post_meta(
											apply_filters(
												'gutentype_filter_post_meta_args', array(
													'components' => $gutentype_components,
													'counters' => $gutentype_counters,
													'seo'  => false,
													'echo' => false,
												), $gutentype_blog_style[0], $gutentype_columns
											)
										);
			gutentype_show_layout( $gutentype_post_meta );
			?>
		</div><!-- .entry-header -->

		<div class="post_content entry-content">
		<?php
		if ( empty( $gutentype_template_args['hide_excerpt'] ) ) {
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
					$quote = gutentype_get_tag( get_the_content(), '<blockquote>', '</blockquote>' );
					if ( ! empty( $quote ) ) {
						gutentype_show_layout( wpautop( $quote ) );
					} else {
						the_excerpt();
					}
				} elseif ( substr( get_the_content(), 0, 4 ) != '[vc_' ) {
					the_excerpt();
				}
				?>
				</div>
				<?php
		}
			// Post meta
		if ( in_array( $gutentype_post_format, array( 'link', 'aside', 'status', 'quote' ) ) ) {
			gutentype_show_layout( $gutentype_post_meta );
		}
			// More button
		if ( empty( $gutentype_template_args['no_links'] ) && ! in_array( $gutentype_post_format, array( 'link', 'aside', 'status', 'quote' ) ) ) {
			?>
				<p><a class="more-link" href="<?php the_permalink(); ?>"><?php esc_html_e( 'Read more', 'gutentype' ); ?></a></p>
				<?php
		}
		?>
		</div><!-- .entry-content -->

	</div></div><!-- .post_inner -->

</article><?php
// Need opening PHP-tag above, because <article> is a inline-block element (used as column)!
