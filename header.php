<?php
/**
 * The Header: Logo and main menu
 *
 * @package WordPress
 * @subpackage GUTENTYPE
 * @since GUTENTYPE 1.0
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js
									<?php
										// Class scheme_xxx need in the <html> as context for the <body>!
										echo ' scheme_' . esc_attr( gutentype_get_theme_option( 'color_scheme' ) );
									?>
										">
<head>
	<?php wp_head(); ?>
</head>

<body <?php	body_class(); ?>>
	<?php wp_body_open(); ?>
	<?php do_action( 'gutentype_action_before_body' ); ?>

	<div class="body_wrap">
        <?php
        // Desktop header
        $gutentype_header_type = gutentype_get_theme_option( 'header_type' );
        ?>
        <div id="container" class="page_wrap <?php if ($gutentype_header_type == 'side') { echo 'intro-effect-side'; } ?>">
			<?php
			if ( 'custom' == $gutentype_header_type && ! gutentype_is_layouts_available() ) {
				$gutentype_header_type = 'custom';
			}
			get_template_part( apply_filters( 'gutentype_filter_get_template_part', "templates/header-{$gutentype_header_type}" ) );

			// Side menu
			if ( in_array( gutentype_get_theme_option( 'menu_style' ), array( 'left', 'right' ) ) ) {
				get_template_part( apply_filters( 'gutentype_filter_get_template_part', 'templates/header-navi-side' ) );
			}

			// Mobile menu
			get_template_part( apply_filters( 'gutentype_filter_get_template_part', 'templates/header-navi-mobile' ) );

            // Widgets area below page header
            gutentype_create_widgets_area( 'header_widgets_below' );
			?>

			<div class="page_content_wrap
            <?php
            $gutentype_page_background = gutentype_get_theme_option( 'page_background_color' );

            if( !empty($gutentype_page_background) ){
                echo  ' ' . esc_attr( gutentype_add_inline_css_class( 'background-color: ' . esc_url( $gutentype_page_background ) . '!important' . ';' ) );
            }
            ?>

            ">



                <?php
                $widgets_name = gutentype_get_theme_option( 'widgets_above_page' );
                if ( ! gutentype_is_off( $widgets_name ) && is_active_sidebar( $widgets_name ) ) {
                    if ( gutentype_is_no_woocommerce_single_page() && gutentype_get_theme_option( 'body_style' ) != 'fullscreen' ) { ?>
                        <div class="content_wrap">
                    <?php }
                }

                // Widgets area above page content
                if(gutentype_is_no_woocommerce_single_page())
                    gutentype_create_widgets_area( 'widgets_above_page' );


                if ( ! gutentype_is_off( $widgets_name ) && is_active_sidebar( $widgets_name ) ) {
                    if ( gutentype_is_no_woocommerce_single_page() && gutentype_get_theme_option( 'body_style' ) != 'fullscreen' ) { ?>
                        </div>
                    <?php }
                }
                ?>


				<?php if ( gutentype_get_theme_option( 'body_style' ) != 'fullscreen' ) { ?>
				<div class="content_wrap">
				<?php } ?>



					<div class="content">
						<?php
						// Widgets area inside page content
                        if(gutentype_is_no_woocommerce_single_page())
						    gutentype_create_widgets_area( 'widgets_above_content' );
