<div class="front_page_section front_page_section_googlemap<?php
	$gutentype_scheme = gutentype_get_theme_option( 'front_page_googlemap_scheme' );
	if ( ! gutentype_is_inherit( $gutentype_scheme ) ) {
		echo ' scheme_' . esc_attr( $gutentype_scheme );
	}
	echo ' front_page_section_paddings_' . esc_attr( gutentype_get_theme_option( 'front_page_googlemap_paddings' ) );
?>"
		<?php
		$gutentype_css      = '';
		$gutentype_bg_image = gutentype_get_theme_option( 'front_page_googlemap_bg_image' );
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
	$gutentype_anchor_icon = gutentype_get_theme_option( 'front_page_googlemap_anchor_icon' );
	$gutentype_anchor_text = gutentype_get_theme_option( 'front_page_googlemap_anchor_text' );
if ( ( ! empty( $gutentype_anchor_icon ) || ! empty( $gutentype_anchor_text ) ) && shortcode_exists( 'trx_sc_anchor' ) ) {
	echo do_shortcode(
		'[trx_sc_anchor id="front_page_section_googlemap"'
									. ( ! empty( $gutentype_anchor_icon ) ? ' icon="' . esc_attr( $gutentype_anchor_icon ) . '"' : '' )
									. ( ! empty( $gutentype_anchor_text ) ? ' title="' . esc_attr( $gutentype_anchor_text ) . '"' : '' )
									. ']'
	);
}
?>
	<div class="front_page_section_inner front_page_section_googlemap_inner
	<?php
	if ( gutentype_get_theme_option( 'front_page_googlemap_fullheight' ) ) {
		echo ' gutentype-full-height sc_layouts_flex sc_layouts_columns_middle';
	}
	?>
			"
			<?php
			$gutentype_css      = '';
			$gutentype_bg_mask  = gutentype_get_theme_option( 'front_page_googlemap_bg_mask' );
			$gutentype_bg_color_type = gutentype_get_theme_option( 'front_page_googlemap_bg_color_type' );
			if ( 'custom' == $gutentype_bg_color_type ) {
				$gutentype_bg_color = gutentype_get_theme_option( 'front_page_googlemap_bg_color' );
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
		<div class="front_page_section_content_wrap front_page_section_googlemap_content_wrap
		<?php
			$gutentype_layout = gutentype_get_theme_option( 'front_page_googlemap_layout' );
		if ( 'fullwidth' != $gutentype_layout ) {
			echo ' content_wrap';
		}
		?>
		">
			<?php
			// Content wrap with title and description
			$gutentype_caption     = gutentype_get_theme_option( 'front_page_googlemap_caption' );
			$gutentype_description = gutentype_get_theme_option( 'front_page_googlemap_description' );
			if ( ! empty( $gutentype_caption ) || ! empty( $gutentype_description ) || ( current_user_can( 'edit_theme_options' ) && is_customize_preview() ) ) {
				if ( 'fullwidth' == $gutentype_layout ) {
					?>
					<div class="content_wrap">
					<?php
				}
					// Caption
				if ( ! empty( $gutentype_caption ) || ( current_user_can( 'edit_theme_options' ) && is_customize_preview() ) ) {
					?>
					<h2 class="front_page_section_caption front_page_section_googlemap_caption front_page_block_<?php echo ! empty( $gutentype_caption ) ? 'filled' : 'empty'; ?>">
					<?php
					echo wp_kses_data( $gutentype_caption );
					?>
					</h2>
					<?php
				}

					// Description (text)
				if ( ! empty( $gutentype_description ) || ( current_user_can( 'edit_theme_options' ) && is_customize_preview() ) ) {
					?>
					<div class="front_page_section_description front_page_section_googlemap_description front_page_block_<?php echo ! empty( $gutentype_description ) ? 'filled' : 'empty'; ?>">
					<?php
					echo wp_kses( wpautop( $gutentype_description ), 'gutentype_kses_content' );
					?>
					</div>
					<?php
				}
				if ( 'fullwidth' == $gutentype_layout ) {
					?>
					</div>
					<?php
				}
			}

			// Content (text)
			$gutentype_content = gutentype_get_theme_option( 'front_page_googlemap_content' );
			if ( ! empty( $gutentype_content ) || ( current_user_can( 'edit_theme_options' ) && is_customize_preview() ) ) {
				if ( 'columns' == $gutentype_layout ) {
					?>
					<div class="front_page_section_columns front_page_section_googlemap_columns columns_wrap">
						<div class="column-1_3">
					<?php
				} elseif ( 'fullwidth' == $gutentype_layout ) {
					?>
					<div class="content_wrap">
					<?php
				}

				?>
				<div class="front_page_section_content front_page_section_googlemap_content front_page_block_<?php echo ! empty( $gutentype_content ) ? 'filled' : 'empty'; ?>">
				<?php
					echo wp_kses( $gutentype_content, 'gutentype_kses_content' );
				?>
				</div>
				<?php

				if ( 'columns' == $gutentype_layout ) {
					?>
					</div><div class="column-2_3">
					<?php
				} elseif ( 'fullwidth' == $gutentype_layout ) {
					?>
					</div>
					<?php
				}
			}

			// Widgets output
			?>
			<div class="front_page_section_output front_page_section_googlemap_output">
			<?php
			if ( is_active_sidebar( 'front_page_googlemap_widgets' ) ) {
				dynamic_sidebar( 'front_page_googlemap_widgets' );
			} elseif ( current_user_can( 'edit_theme_options' ) ) {
				if ( ! gutentype_exists_trx_addons() ) {
					gutentype_customizer_need_trx_addons_message();
				} else {
					gutentype_customizer_need_widgets_message( 'front_page_googlemap_caption', 'ThemeREX Addons - Google map' );
				}
			}
			?>
			</div>
			<?php

			if ( 'columns' == $gutentype_layout && ( ! empty( $gutentype_content ) || ( current_user_can( 'edit_theme_options' ) && is_customize_preview() ) ) ) {
				?>
				</div></div>
				<?php
			}
			?>
		</div>
	</div>
</div>
