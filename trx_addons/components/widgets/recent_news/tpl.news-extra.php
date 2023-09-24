<?php
/**
 * The "Announce" template to show post's content
 *
 * Used in the widget Recent News.
 *
 * @package WordPress
 * @subpackage ThemeREX Addons
 * @since v1.0
 */
 
$widget_args = get_query_var('trx_addons_args_recent_news');
$style = $widget_args['style'];
$number = min(8, $widget_args['number']);
$count = min(8, $widget_args['count']);
$post_format = get_post_format();
$post_format = empty($post_format) ? 'standard' : str_replace('post-format-', '', $post_format);
$animation = apply_filters('trx_addons_blog_animation', '');


$title = '<div class="post_meta">';
// Post author
$met_post = get_post(get_the_id(), 'ARRAY_A');
$author_id = $met_post['post_author'];
if ($author_id > 0) {
    $author_link = get_author_posts_url($author_id);
    $author_name = get_the_author_meta('display_name', $author_id);
    $gutentype_mult = gutentype_get_retina_multiplier();
    $title .=
        '<a class="post_meta_item post_author" rel="author" href="' . esc_url($author_link) . '"><span class="author_avatar_meta">'
        . get_avatar(get_the_author_meta('user_email', $author_id), 35 * $gutentype_mult)
        . '</span>' . esc_html__('By ', 'gutentype') . esc_html($author_name) . '</a>';
}
$title .= '<span class="post_meta_item post_date"><a href="'.esc_url(get_permalink()).'">'.esc_html(get_the_date()).'</a></span>';
$title .= '</div>';


$grid = array(
	array('full'),
	array('big', 'medium'),
	array('big', 'medium', 'medium'),
	array('big', 'medium', 'medium', 'full'),
	array('big', 'medium', 'medium', 'big', 'medium'),
	array('big', 'medium', 'medium', 'big', 'medium', 'medium'),
	array('big', 'medium', 'medium', 'big', 'medium', 'medium', 'full'),
	array('big', 'medium', 'medium', 'big', 'medium', 'medium', 'big', 'medium')
);
$thumb_size = $grid[$count-$number >= 8 ? 8 : ($count-1)%8][($number-1)%8];
?><article 
	<?php post_class( 'post_item post_layout_'.esc_attr($style)
					.' post_format_'.esc_attr($post_format)
					.' post_size_'.esc_attr($thumb_size)
					); ?>
	<?php echo (!empty($animation) ? ' data-animation="'.esc_attr($animation).'"' : ''); ?>
	>

	<?php
	if ( is_sticky() && is_home() && !is_paged() ) {
		?><span class="post_label label_sticky"></span><?php
	}
	
	trx_addons_get_template_part('templates/tpl.featured.php',
								'trx_addons_args_featured',
								apply_filters('trx_addons_filter_args_featured', array(
                                    'post_info' => '<div class="post_info">'
                                        . '<span class="post_categories post_meta_item">'.trx_addons_get_post_categories().'</span>'
                                        . '<h5 class="post_title entry-title"><a href="'.esc_url(get_permalink()).'" rel="bookmark">'.wp_kses_post( get_the_title() ).'</a></h5>'
                                        . ( in_array( get_post_type(), array( 'post', 'attachment' ) )
                                            ? $title
                                            : '')
                                        . '</div>',
										'thumb_bg' => true,
										'thumb_size' => trx_addons_get_thumb_size('full')
										),
										'recent_news-extra')
								);
	?>
</article>