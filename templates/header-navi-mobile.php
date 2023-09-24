<?php
/**
 * The template to show mobile menu
 *
 * @package WordPress
 * @subpackage GUTENTYPE
 * @since GUTENTYPE 1.0
 */
?>
<div class="menu_mobile_overlay"></div>
<div class="menu_mobile menu_mobile_<?php echo esc_attr( gutentype_get_theme_option( 'menu_mobile_fullscreen' ) > 0 ? 'fullscreen' : 'narrow' ); ?>">
	<div class="menu_mobile_inner">
		<a class="menu_mobile_close icon-cancel"></a>
		<?php

		// Logo
		set_query_var( 'gutentype_logo_args', array( 'type' => 'mobile' ) );
		get_template_part( apply_filters( 'gutentype_filter_get_template_part', 'templates/header-logo' ) );
		set_query_var( 'gutentype_logo_args', array() );

		// Mobile menu
		$gutentype_menu_mobile = gutentype_get_nav_menu( 'menu_mobile' );
		if ( empty( $gutentype_menu_mobile ) ) {
			$gutentype_menu_mobile = apply_filters( 'gutentype_filter_get_mobile_menu', '' );
			if ( empty( $gutentype_menu_mobile ) ) {
				$gutentype_menu_mobile = gutentype_get_nav_menu( 'menu_main' );
			}
			if ( empty( $gutentype_menu_mobile ) ) {
				$gutentype_menu_mobile = gutentype_get_nav_menu();
			}
		}

		if ( ! empty( $gutentype_menu_mobile ) ) {
			if ( ! empty( $gutentype_menu_mobile ) ) {
				$gutentype_menu_mobile = str_replace(
					array( 'menu_main', 'id="menu-', 'sc_layouts_menu_nav', 'sc_layouts_hide_on_mobile', 'hide_on_mobile', 'sc_layouts_menu' ),
					array( 'menu_mobile', 'id="menu_mobile-', '', '', '' ),
					$gutentype_menu_mobile
				);

			}
			if ( strpos( $gutentype_menu_mobile, '<nav ' ) === false ) {
				$gutentype_menu_mobile = sprintf( '<nav class="menu_mobile_nav_area">%s</nav>', $gutentype_menu_mobile );
			}
			gutentype_show_layout( apply_filters( 'gutentype_filter_menu_mobile_layout', $gutentype_menu_mobile ) );
		}


		// Social icons
		gutentype_show_layout( gutentype_get_socials_links(), '<div class="socials_mobile">', '</div>' );
		?>
	</div>
</div>
