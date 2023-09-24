<?php
/**
 * The default template to display the content of the single post, page or attachment
 *
 * Used for index/archive/search.
 *
 * @package WordPress
 * @subpackage GUTENTYPE
 * @since GUTENTYPE 1.0
 */

$gutentype_seo = gutentype_is_on( gutentype_get_theme_option( 'seo_snippets' ) );
?>

<article id="post-<?php the_ID(); ?>" 
									<?php
									post_class(
										'post_item_single post_type_' . esc_attr( get_post_type() )
												. ' post_format_' . esc_attr( str_replace( 'post-format-', '', get_post_format() ) )
									);
									if ( $gutentype_seo ) {
										?>
			itemscope="itemscope" 
			itemprop="articleBody" 
			itemtype="//schema.org/<?php echo esc_attr( gutentype_get_markup_schema() ); ?>"
			itemid="<?php echo esc_url( get_the_permalink() ); ?>"
			content="<?php the_title_attribute(); ?>"
										<?php
									}
									?>
>
<?php

	do_action( 'gutentype_action_before_post_data' );

	// Structured data snippets
if ( $gutentype_seo ) {
	get_template_part( apply_filters( 'gutentype_filter_get_template_part', 'templates/seo' ) );
}

	// Featured image
if ( gutentype_is_off( gutentype_get_theme_option( 'hide_featured_on_single' ) )
			&& ! gutentype_sc_layouts_showed( 'featured' )
			&& strpos( get_the_content(), '[trx_widget_banner]' ) === false ) {
	do_action( 'gutentype_action_before_post_featured' );
	gutentype_show_post_featured( array(
	    'class' => is_single() && gutentype_is_on( gutentype_get_theme_option( 'extra_featured_on_single' )) ? 'extra_featured' : ''
    ));
	do_action( 'gutentype_action_after_post_featured' );
} elseif ( has_post_thumbnail() ) {
	?>
		<meta itemprop="image" itemtype="//schema.org/ImageObject" content="<?php echo esc_url( wp_get_attachment_url( get_post_thumbnail_id() ) ); ?>">
		<?php
}

	// Title and post meta
if ( ( ! gutentype_sc_layouts_showed( 'title' ) || ! gutentype_sc_layouts_showed( 'postmeta' ) ) && ! in_array( get_post_format(), array( 'link', 'aside', 'status', 'quote' ) ) ) {
	do_action( 'gutentype_action_before_post_title' );
	?>
		<div class="post_header post_header_single entry-header">
		<?php
		// Post title
		if ( ! gutentype_sc_layouts_showed( 'title' ) ) {
			the_title( '<h3 class="post_title entry-title"' . ( $gutentype_seo ? ' itemprop="headline"' : '' ) . '>', '</h3>' );
		}
		// Post meta
		if ( ! gutentype_sc_layouts_showed( 'postmeta' ) && gutentype_is_on( gutentype_get_theme_option( 'show_post_meta' ) ) ) {
			gutentype_show_post_meta(
				apply_filters(
					'gutentype_filter_post_meta_args', array(
						'components' => gutentype_array_get_keys_by_value( gutentype_get_theme_option( 'meta_parts' ) ),
						'counters'   => gutentype_array_get_keys_by_value( gutentype_get_theme_option( 'counters' ) ),
						'seo'        => gutentype_is_on( gutentype_get_theme_option( 'seo_snippets' ) ),
					), 'single', 1
				)
			);
		}
		?>
		</div><!-- .post_header -->
		<?php
		do_action( 'gutentype_action_after_post_title' );
}

	do_action( 'gutentype_action_before_post_content' );

	// Post content
?>
	<div class="post_content post_content_single entry-content" itemprop="mainEntityOfPage">
		<?php
		the_content();

		do_action( 'gutentype_action_before_post_pagination' );

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

		// Taxonomies and share
		if ( is_single() && ! is_attachment() ) {

			do_action( 'gutentype_action_before_post_meta' );

			// Post rating
			do_action(
				'trx_addons_action_post_rating', array(
					'class'                => 'single_post_rating',
					'rating_text_template' => esc_html__( 'Post rating: {{X}} from {{Y}} (according {{V}})', 'gutentype' ),
				)
			);

			?>
			<div class="post_meta post_meta_single">
			<?php

				// Post taxonomies
				the_tags( '<span class="post_meta_item post_tags">', '', '</span>' );

				// Share
			if ( gutentype_is_on( gutentype_get_theme_option( 'show_share_links' ) ) ) {
				gutentype_show_share_links(
					array(
						'type'    => 'block',
						'caption' => '',
						'before'  => '<span class="post_meta_item post_share">',
						'after'   => '</span>',
					)
				);
			}
			?>
			</div>
			<?php

			do_action( 'gutentype_action_after_post_meta' );
		}
		?>
	</div><!-- .entry-content -->

	<?php
	do_action( 'gutentype_action_after_post_content' );

    // Related posts
    if ( gutentype_get_theme_option( 'related_position' ) == 'below_content' ) {
        do_action( 'gutentype_action_related_posts' );
    }

	// Author bio
	if ( gutentype_get_theme_option( 'show_author_info' ) == 1 && is_single() && ! is_attachment() && get_the_author_meta( 'description' ) ) {
		do_action( 'gutentype_action_before_post_author' );
		get_template_part( apply_filters( 'gutentype_filter_get_template_part', 'templates/author-bio' ) );
		do_action( 'gutentype_action_after_post_author' );
	}

	do_action( 'gutentype_action_after_post_data' );
	?>
</article>
