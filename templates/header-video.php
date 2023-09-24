<?php
/**
 * The template to display the background video in the header
 *
 * @package WordPress
 * @subpackage GUTENTYPE
 * @since GUTENTYPE 1.0.14
 */
$gutentype_header_video = gutentype_get_header_video();
$gutentype_embed_video  = '';
if ( ! empty( $gutentype_header_video ) && ! gutentype_is_from_uploads( $gutentype_header_video ) ) {
	if ( gutentype_is_youtube_url( $gutentype_header_video ) && preg_match( '/[=\/]([^=\/]*)$/', $gutentype_header_video, $matches ) && ! empty( $matches[1] ) ) {
		?><div id="background_video" data-youtube-code="<?php echo esc_attr( $matches[1] ); ?>"></div>
		<?php
	} else {
		global $wp_embed;
		if ( false && is_object( $wp_embed ) ) {
			$gutentype_embed_video = do_shortcode( $wp_embed->run_shortcode( '[embed]' . trim( $gutentype_header_video ) . '[/embed]' ) );
			$gutentype_embed_video = gutentype_make_video_autoplay( $gutentype_embed_video );
		} else {
			$gutentype_header_video = str_replace( '/watch?v=', '/embed/', $gutentype_header_video );
			$gutentype_header_video = gutentype_add_to_url(
				$gutentype_header_video, array(
					'feature'        => 'oembed',
					'controls'       => 0,
					'autoplay'       => 1,
					'showinfo'       => 0,
					'modestbranding' => 1,
					'wmode'          => 'transparent',
					'enablejsapi'    => 1,
					'origin'         => home_url(),
					'widgetid'       => 1,
				)
			);
			$gutentype_embed_video  = '<iframe src="' . esc_url( $gutentype_header_video ) . '" width="1170" height="658" allowfullscreen="0" frameborder="0"></iframe>';
		}
		?>
		<div id="background_video"><?php gutentype_show_layout( $gutentype_embed_video ); ?></div>
		<?php
	}
}
