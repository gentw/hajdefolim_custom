<div class="front_page_section front_page_section_woocommerce<?php
	$gutentype_scheme = gutentype_get_theme_option( 'front_page_woocommerce_scheme' );
	if ( ! gutentype_is_inherit( $gutentype_scheme ) ) {
		echo ' scheme_' . esc_attr( $gutentype_scheme );
	}
	echo ' front_page_section_paddings_' . esc_attr( gutentype_get_theme_option( 'front_page_woocommerce_paddings' ) );
?>"
		<?php
		$gutentype_css      = '';
		$gutentype_bg_image = gutentype_get_theme_option( 'front_page_woocommerce_bg_image' );
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
	$gutentype_anchor_icon = gutentype_get_theme_option( 'front_page_woocommerce_anchor_icon' );
	$gutentype_anchor_text = gutentype_get_theme_option( 'front_page_woocommerce_anchor_text' );
if ( ( ! empty( $gutentype_anchor_icon ) || ! empty( $gutentype_anchor_text ) ) && shortcode_exists( 'trx_sc_anchor' ) ) {
	echo do_shortcode(
		'[trx_sc_anchor id="front_page_section_woocommerce"'
									. ( ! empty( $gutentype_anchor_icon ) ? ' icon="' . esc_attr( $gutentype_anchor_icon ) . '"' : '' )
									. ( ! empty( $gutentype_anchor_text ) ? ' title="' . esc_attr( $gutentype_anchor_text ) . '"' : '' )
									. ']'
	);
}
?>
	<div class="front_page_section_inner front_page_section_woocommerce_inner
	<?php
	if ( gutentype_get_theme_option( 'front_page_woocommerce_fullheight' ) ) {
		echo ' gutentype-full-height sc_layouts_flex sc_layouts_columns_middle';
	}
	?>
			"
			<?php
			$gutentype_css      = '';
			$gutentype_bg_mask  = gutentype_get_theme_option( 'front_page_woocommerce_bg_mask' );
			$gutentype_bg_color_type = gutentype_get_theme_option( 'front_page_woocommerce_bg_color_type' );
			if ( 'custom' == $gutentype_bg_color_type ) {
				$gutentype_bg_color = gutentype_get_theme_option( 'front_page_woocommerce_bg_color' );
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
		<div class="front_page_section_content_wrap front_page_section_woocommerce_content_wrap content_wrap woocommerce">
			<?php
			// Content wrap with title and description
			$gutentype_caption     = gutentype_get_theme_option( 'front_page_woocommerce_caption' );
			$gutentype_description = gutentype_get_theme_option( 'front_page_woocommerce_description' );
			if ( ! empty( $gutentype_caption ) || ! empty( $gutentype_description ) || ( current_user_can( 'edit_theme_options' ) && is_customize_preview() ) ) {
				// Caption
				if ( ! empty( $gutentype_caption ) || ( current_user_can( 'edit_theme_options' ) && is_customize_preview() ) ) {
					?>
					<h2 class="front_page_section_caption front_page_section_woocommerce_caption front_page_block_<?php echo ! empty( $gutentype_caption ) ? 'filled' : 'empty'; ?>">
					<?php
						echo wp_kses_data( $gutentype_caption );
					?>
					</h2>
					<?php
				}

				// Description (text)
				if ( ! empty( $gutentype_description ) || ( current_user_can( 'edit_theme_options' ) && is_customize_preview() ) ) {
					?>
					<div class="front_page_section_description front_page_section_woocommerce_description front_page_block_<?php echo ! empty( $gutentype_description ) ? 'filled' : 'empty'; ?>">
					<?php
						echo wp_kses( wpautop( $gutentype_description ), 'gutentype_kses_content' );
					?>
					</div>
					<?php
				}
			}

			// Content (widgets)
			?>
			<div class="front_page_section_output front_page_section_woocommerce_output list_products shop_mode_thumbs">
			<?php
				$gutentype_woocommerce_sc = gutentype_get_theme_option( 'front_page_woocommerce_products' );
			if ( 'products' == $gutentype_woocommerce_sc ) {
				$gutentype_woocommerce_sc_ids      = gutentype_get_theme_option( 'front_page_woocommerce_products_per_page' );
				$gutentype_woocommerce_sc_per_page = count( explode( ',', $gutentype_woocommerce_sc_ids ) );
			} else {
				$gutentype_woocommerce_sc_per_page = max( 1, (int) gutentype_get_theme_option( 'front_page_woocommerce_products_per_page' ) );
			}
				$gutentype_woocommerce_sc_columns = max( 1, min( $gutentype_woocommerce_sc_per_page, (int) gutentype_get_theme_option( 'front_page_woocommerce_products_columns' ) ) );
				echo do_shortcode(
					"[{$gutentype_woocommerce_sc}"
									. ( 'products' == $gutentype_woocommerce_sc
											? ' ids="' . esc_attr( $gutentype_woocommerce_sc_ids ) . '"'
											: '' )
									. ( 'product_category' == $gutentype_woocommerce_sc
											? ' category="' . esc_attr( gutentype_get_theme_option( 'front_page_woocommerce_products_categories' ) ) . '"'
											: '' )
									. ( 'best_selling_products' != $gutentype_woocommerce_sc
											? ' orderby="' . esc_attr( gutentype_get_theme_option( 'front_page_woocommerce_products_orderby' ) ) . '"'
												. ' order="' . esc_attr( gutentype_get_theme_option( 'front_page_woocommerce_products_order' ) ) . '"'
											: '' )
									. ' per_page="' . esc_attr( $gutentype_woocommerce_sc_per_page ) . '"'
									. ' columns="' . esc_attr( $gutentype_woocommerce_sc_columns ) . '"'
					. ']'
				);
				?>
			</div>
		</div>
	</div>
</div>
