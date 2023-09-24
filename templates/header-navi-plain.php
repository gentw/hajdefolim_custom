
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
	<div class="content_wrap">
		<div class="columns_wrap columns_fluid">
			<div class="sc_layouts_column sc_layouts_column_align_left sc_layouts_column_icons_position_left sc_layouts_column_fluid column-1_3">
				<div class="sc_layouts_item"><?php
					// Mobile menu button
					?>
					<div class="sc_layouts_iconed_text sc_layouts_menu_mobile_button">
						<a class="sc_layouts_item_link sc_layouts_iconed_text_link" href="#">
							<span class="sc_layouts_item_icon sc_layouts_iconed_text_icon icon-menu-1"><span><?php esc_html_e('Menu', 'gutentype'); ?></span></span>
						</a>
					</div>
				</div>

                <?php $gutentype_menu_cusom = gutentype_get_nav_menu(
                    array(
                        'location' => 'custom_main',
                        'class'	=> 'sc_layouts_menu',
                    )
                );
                if ( !empty($gutentype_menu_cusom)  ) { ?>
                    <div class="sc_layouts_item sc_layouts_hide_on_mobile"><?php
                        gutentype_show_layout( $gutentype_menu_cusom );
                        ?>
                    </div>
                <?php } ?>

			</div><div class="sc_layouts_column sc_layouts_column_align_center sc_layouts_column_icons_position_center sc_layouts_column_fluid column-1_3">
				<div class="sc_layouts_item">
					<?php
					// Logo
					get_template_part( apply_filters( 'gutentype_filter_get_template_part', 'templates/header-logo' ) );
					?>
				</div>
			</div><div class="sc_layouts_column sc_layouts_column_align_right sc_layouts_column_icons_position_left sc_layouts_column_fluid column-1_3">
				<div class="sc_layouts_item socials_wrap_item">
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
		</div><!-- /.columns_wrap -->
		
		<!-- language wrap -->
		<div class="columns_wrap columns_fluid">
			<div class="sc_layouts_column sc_layouts_column_align_right ">
				
				
				<?php dynamic_sidebar( 'header_language_switcher_x' ); ?>
					
				
			
				
			</div>
		</div>
		<!-- end language wrap -->
		
		
	</div><!-- /.content_wrap -->
</div><!-- /.top_panel_navi -->
