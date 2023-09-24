<?php
/**
 * The template to display the main menu
 *
 * @package WordPress
 * @subpackage GUTENTYPE
 * @since GUTENTYPE 1.0
 */
?>
<div class="top_panel_navi sc_layouts_row sc_layouts_row_type_compact sc_layouts_row_fixed_always
	<?php if(gutentype_is_on(gutentype_get_theme_option( 'header_sticky' ))){ ?>
		sc_layouts_row_fixed
	<?php } ?>
	<?php if ( gutentype_is_on( gutentype_get_theme_option( 'header_mobile_enabled' ) ) ) {?>
		sc_layouts_hide_on_mobile
	<?php } ?>
">
	<div class="content_wrap_full">
		<div class="columns_wrap columns_fluid">
			<div class="sc_layouts_column sc_layouts_column_align_left sc_layouts_column_icons_position_left sc_layouts_column_fluid <?php echo gutentype_exists_trx_addons() ? 'column-3_12' : 'column-3_12'?>">
				<div class="sc_layouts_item logo">
					<?php
					// Logo
					get_template_part( apply_filters( 'gutentype_filter_get_template_part', 'templates/header-logo' ) );
					?>
				</div><?php

				if(!gutentype_exists_trx_addons()) {
					?></div><div class="no_trx_addons sc_layouts_column sc_layouts_column_align_left sc_layouts_column_icons_position_left sc_layouts_column_fluid column-9_12"><?php
				} else {
					?></div><div class="sc_layouts_column sc_layouts_column_align_center sc_layouts_column_icons_position_center sc_layouts_column_fluid column-6_12"><?php
				}

				?><div class="sc_layouts_item menu"><?php
					// Main menu
					$gutentype_menu_main = gutentype_get_nav_menu(
						array(
							'location' => 'menu_main',
							'class'	=> 'sc_layouts_menu sc_layouts_menu_default sc_layouts_hide_on_mobile',
						)
					);
					// Show any menu if no menu selected in the location 'menu_main'
					if ( gutentype_get_theme_setting( 'autoselect_menu' ) && empty( $gutentype_menu_main ) ) {
						$gutentype_menu_main = gutentype_get_nav_menu(
							array(
								'class' => 'sc_layouts_menu sc_layouts_menu_default sc_layouts_hide_on_mobile',
							)
						);
					}
					gutentype_show_layout( $gutentype_menu_main );
					// Mobile menu button
					?>
					<div class="sc_layouts_iconed_text sc_layouts_menu_mobile_button">
						<a class="sc_layouts_item_link sc_layouts_iconed_text_link" href="#">
							<span class="sc_layouts_item_icon sc_layouts_iconed_text_icon trx_addons_icon-menu"></span>
						</a>
					</div>
				</div>

			</div><?php

			if(gutentype_exists_trx_addons()) {
				?><div class="sc_layouts_column sc_layouts_column_align_right sc_layouts_column_icons_position_left sc_layouts_column_fluid column-3_12">
				<div class="sc_layouts_item">
				<?php
				// Social icons
				gutentype_show_layout( gutentype_get_socials_links(), '<div class="socials_wrap">', '</div>' );
				?></div><?php
				if ( gutentype_exists_trx_addons() ) {
					?><div class="sc_layouts_item last">
						<?php
						// Display search field
						do_action( 'gutentype_action_search', 'fullscreen', 'header_search', false );
						// Social icons
						gutentype_show_layout( gutentype_get_socials_links(), '<div class="socials_wrap">', '</div>' );
						?>
					</div>
					<?php
				}
				?>
			</div>
			<?php
			}
			?>
		</div><!-- /.columns_wrap -->
	</div><!-- /.content_wrap -->
</div><!-- /.top_panel_navi -->
