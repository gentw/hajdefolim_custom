<?php
/**
 * The template to display the page title and breadcrumbs
 *
 * @package WordPress
 * @subpackage GUTENTYPE
 * @since GUTENTYPE 1.0
 */

// Page (category, tag, archive, author) title

if ( gutentype_need_page_title() ) {
	gutentype_sc_layouts_showed( 'title', true );
	gutentype_sc_layouts_showed( 'postmeta', true );
	?>
	<div class="top_panel_title sc_layouts_row sc_layouts_row_type_normal">
		<div class="content_wrap">
			<div class="sc_layouts_column sc_layouts_column_<?php echo esc_attr(is_single() ? 'align_left' : 'align_center'); ?>">
				<div class="sc_layouts_item">
					<div class="sc_layouts_title <?php echo esc_attr(is_single() ? 'sc_align_left' : 'sc_align_center'); ?>">
						<?php
						// Blog/Post title
						?>
						<div class="sc_layouts_title_title">
							<?php
							$gutentype_blog_title           = gutentype_get_blog_title();
							$gutentype_blog_title_text      = '';
							$gutentype_blog_title_class     = '';
							$gutentype_blog_title_link      = '';
							$gutentype_blog_title_link_text = '';
							if ( is_array( $gutentype_blog_title ) ) {
								$gutentype_blog_title_text      = $gutentype_blog_title['text'];
								$gutentype_blog_title_class     = ! empty( $gutentype_blog_title['class'] ) ? ' ' . $gutentype_blog_title['class'] : '';
								$gutentype_blog_title_link      = ! empty( $gutentype_blog_title['link'] ) ? $gutentype_blog_title['link'] : '';
								$gutentype_blog_title_link_text = ! empty( $gutentype_blog_title['link_text'] ) ? $gutentype_blog_title['link_text'] : '';
							} else {
								$gutentype_blog_title_text = $gutentype_blog_title;
							}
							?>
							<h1 itemprop="headline" class="sc_layouts_title_caption<?php echo esc_attr( $gutentype_blog_title_class ); ?>">
								<?php
								$gutentype_top_icon = gutentype_get_category_icon();
								if ( ! empty( $gutentype_top_icon ) ) {
									$gutentype_attr = gutentype_getimagesize( $gutentype_top_icon );
									?>
									<img src="<?php echo esc_url( $gutentype_top_icon ); ?>" alt="<?php esc_attr_e( 'Site icon', 'gutentype' ); ?>"
										<?php
										if ( ! empty( $gutentype_attr[3] ) ) {
											gutentype_show_layout( $gutentype_attr[3] );
										}
										?>
									>
									<?php
								}
								echo wp_kses_post( $gutentype_blog_title_text );
								?>
							</h1>
							<?php
							if ( ! empty( $gutentype_blog_title_link ) && ! empty( $gutentype_blog_title_link_text ) ) {
								?>
								<a href="<?php echo esc_url( $gutentype_blog_title_link ); ?>" class="theme_button theme_button_small sc_layouts_title_link"><?php echo esc_html( $gutentype_blog_title_link_text ); ?></a>
								<?php
							}

							// Category/Tag description
							if ( is_category() || is_tag() || is_tax() ) {
								the_archive_description( '<div class="sc_layouts_title_description">', '</div>' );
							}

							?>
						</div>


						<?php

                        // Post meta on the single post
                        if ( is_single() ) {
                            ?>
                            <div class="sc_layouts_title_meta">
                                <?php
                                gutentype_show_post_meta(
                                    apply_filters(
                                        'gutentype_filter_post_meta_args', array(
                                        'components' => gutentype_array_get_keys_by_value( gutentype_get_theme_option( 'meta_parts' ) ),
                                        'counters'   => gutentype_array_get_keys_by_value( gutentype_get_theme_option( 'counters' ) ),
                                        'seo'        => gutentype_is_on( gutentype_get_theme_option( 'seo_snippets' ) ),
                                    ), 'header', 1
                                    )
                                );
                                ?>
                            </div>
                            <?php
                        } else {
                            // Breadcrumbs
							if (gutentype_is_on( gutentype_get_theme_option( 'show_main_breadcrumbs'))) {
                            ?>
                            <div class="sc_layouts_title_breadcrumbs">
                                <?php
                                do_action('gutentype_action_breadcrumbs');
                                ?>
                            </div>
                            <?php
                        }

                        }
                        ?>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php
}
?>
