<div class="front_page_section front_page_section_blog<?php
	$gutentype_scheme = gutentype_get_theme_option( 'front_page_blog_scheme' );
	if ( ! gutentype_is_inherit( $gutentype_scheme ) ) {
		echo ' scheme_' . esc_attr( $gutentype_scheme );
	}
	echo ' front_page_section_paddings_' . esc_attr( gutentype_get_theme_option( 'front_page_blog_paddings' ) );
?>"
		<?php
		$gutentype_css      = '';
		$gutentype_bg_image = gutentype_get_theme_option( 'front_page_blog_bg_image' );
		if ( ! empty( $gutentype_bg_image ) ) {
			$gutentype_css .= 'background-image: url(' . esc_url( gutentype_get_attachment_url( $gutentype_bg_image ) ) . ');';
		}
		if ( ! empty( $gutentype_css ) ) {
			echo ' style="' . esc_attr( $gutentype_css ) . '"';
		}
		?>
>
<?php
	// Add anchor
	$gutentype_anchor_icon = gutentype_get_theme_option( 'front_page_blog_anchor_icon' );
	$gutentype_anchor_text = gutentype_get_theme_option( 'front_page_blog_anchor_text' );
if ( ( ! empty( $gutentype_anchor_icon ) || ! empty( $gutentype_anchor_text ) ) && shortcode_exists( 'trx_sc_anchor' ) ) {
	echo do_shortcode(
		'[trx_sc_anchor id="front_page_section_blog"'
									. ( ! empty( $gutentype_anchor_icon ) ? ' icon="' . esc_attr( $gutentype_anchor_icon ) . '"' : '' )
									. ( ! empty( $gutentype_anchor_text ) ? ' title="' . esc_attr( $gutentype_anchor_text ) . '"' : '' )
									. ']'
	);
}
?>
	<div class="front_page_section_inner front_page_section_blog_inner
	<?php
	if ( gutentype_get_theme_option( 'front_page_blog_fullheight' ) ) {
		echo ' gutentype-full-height sc_layouts_flex sc_layouts_columns_middle';
	}
	?>
			"
			<?php
			$gutentype_css      = '';
			$gutentype_bg_mask  = gutentype_get_theme_option( 'front_page_blog_bg_mask' );
			$gutentype_bg_color_type = gutentype_get_theme_option( 'front_page_blog_bg_color_type' );
			if ( 'custom' == $gutentype_bg_color_type ) {
				$gutentype_bg_color = gutentype_get_theme_option( 'front_page_blog_bg_color' );
			} elseif ( 'scheme_bg_color' == $gutentype_bg_color_type ) {
				$gutentype_bg_color = gutentype_get_scheme_color( 'bg_color', $gutentype_scheme );
			} else {
				$gutentype_bg_color = '';
			}
			if ( ! empty( $gutentype_bg_color ) && $gutentype_bg_mask > 0 ) {
				$gutentype_css .= 'background-color: ' . esc_attr(
					1 == $gutentype_bg_mask ? $gutentype_bg_color : gutentype_hex2rgba( $gutentype_bg_color, $gutentype_bg_mask )
				) . ';';
			}
			if ( ! empty( $gutentype_css ) ) {
				echo ' style="' . esc_attr( $gutentype_css ) . '"';
			}
			?>
	>
		<div class="front_page_section_content_wrap front_page_section_blog_content_wrap content_wrap">
			<?php
			// Caption
			$gutentype_caption = gutentype_get_theme_option( 'front_page_blog_caption' );
			if ( ! empty( $gutentype_caption ) || ( current_user_can( 'edit_theme_options' ) && is_customize_preview() ) ) {
				?>
				<h2 class="front_page_section_caption front_page_section_blog_caption front_page_block_<?php echo ! empty( $gutentype_caption ) ? 'filled' : 'empty'; ?>"><?php echo wp_kses_data( $gutentype_caption ); ?></h2>
				<?php
			}

			// Description (text)
			$gutentype_description = gutentype_get_theme_option( 'front_page_blog_description' );
			if ( ! empty( $gutentype_description ) || ( current_user_can( 'edit_theme_options' ) && is_customize_preview() ) ) {
				?>
				<div class="front_page_section_description front_page_section_blog_description front_page_block_<?php echo ! empty( $gutentype_description ) ? 'filled' : 'empty'; ?>"><?php echo wp_kses( wpautop( $gutentype_description ), 'gutentype_kses_content' ); ?></div>
				<?php
			}

			// Content (widgets)
			?>
			<div class="front_page_section_output front_page_section_blog_output">
			<?php
			if ( is_active_sidebar( 'front_page_blog_widgets' ) ) {
				dynamic_sidebar( 'front_page_blog_widgets' );
			} elseif ( current_user_can( 'edit_theme_options' ) ) {
				if ( ! gutentype_exists_trx_addons() ) {
					gutentype_customizer_need_trx_addons_message();
				} else {
					gutentype_customizer_need_widgets_message( 'front_page_blog_caption', 'ThemeREX Addons - Blogger' );
				}
			}
			?>
			</div>
		</div>
	</div>
</div>
