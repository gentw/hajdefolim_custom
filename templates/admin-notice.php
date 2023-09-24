<?php
/**
 * The template to display Admin notices
 *
 * @package WordPress
 * @subpackage GUTENTYPE
 * @since GUTENTYPE 1.0.1
 */

$gutentype_theme_obj = wp_get_theme();
?>
<div class="gutentype_admin_notice gutentype_welcome_notice update-nag">
	<?php
	// Theme image
	$gutentype_theme_img = gutentype_get_file_url( 'screenshot.jpg' );
	if ( '' != $gutentype_theme_img ) {
		?>
		<div class="gutentype_notice_image"><img src="<?php echo esc_url( $gutentype_theme_img ); ?>" alt="<?php esc_attr_e( 'Theme screenshot', 'gutentype' ); ?>"></div>
		<?php
	}

	// Title
	?>
	<h3 class="gutentype_notice_title">
		<?php
		echo esc_html(
			sprintf(
				// Translators: Add theme name and version to the 'Welcome' message
				__( 'Welcome to %1$s v.%2$s', 'gutentype' ),
				$gutentype_theme_obj->name . ( GUTENTYPE_THEME_FREE ? ' ' . __( 'Free', 'gutentype' ) : '' ),
				$gutentype_theme_obj->version
			)
		);
		?>
	</h3>
	<?php

	// Description
	?>
	<div class="gutentype_notice_text">
		<p class="gutentype_notice_text_description">
			<?php
			echo str_replace( '. ', '.<br>', wp_kses_data( $gutentype_theme_obj->description ) );
			?>
		</p>
		<p class="gutentype_notice_text_info">
			<?php
			echo wp_kses_data( __( 'Attention! Plugin "ThemeREX Addons" is required! Please, install and activate it!', 'gutentype' ) );
			?>
		</p>
	</div>
	<?php

	// Buttons
	?>
	<div class="gutentype_notice_buttons">
		<?php
		// Link to the page 'About Theme'
		?>
		<a href="<?php echo esc_url( admin_url() . 'themes.php?page=gutentype_about' ); ?>" class="button button-primary"><i class="dashicons dashicons-nametag"></i> 
			<?php
			echo esc_html__( 'Install plugin "ThemeREX Addons"', 'gutentype' );
			?>
		</a>
		<?php		
		// Dismiss this notice
		?>
		<a href="#" class="gutentype_hide_notice"><i class="dashicons dashicons-dismiss"></i> <span class="gutentype_hide_notice_text"><?php esc_html_e( 'Dismiss', 'gutentype' ); ?></span></a>
	</div>
</div>
