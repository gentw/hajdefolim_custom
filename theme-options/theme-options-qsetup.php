<?php
/**
 * Quick Setup Section in the Theme Panel
 *
 * @package WordPress
 * @subpackage GUTENTYPE
 * @since GUTENTYPE 1.0.48
 */


// Load required styles and scripts for admin mode
if ( ! function_exists( 'gutentype_options_qsetup_add_scripts' ) ) {
	add_action("admin_enqueue_scripts", 'gutentype_options_qsetup_add_scripts');
	function gutentype_options_qsetup_add_scripts() {
		if ( ! GUTENTYPE_THEME_FREE ) {
			$screen = function_exists( 'get_current_screen' ) ? get_current_screen() : false;
			if ( is_object( $screen ) && ! empty( $screen->id ) && false !== strpos($screen->id, 'page_trx_addons_theme_panel') ) {
				wp_enqueue_style( 'fontello-icons', gutentype_get_file_url( 'css/font-icons/css/fontello-embedded.css' ), array(), null );
				wp_enqueue_script( 'jquery-ui-tabs', false, array( 'jquery', 'jquery-ui-core' ), null, true );
				wp_enqueue_script( 'jquery-ui-accordion', false, array( 'jquery', 'jquery-ui-core' ), null, true );
				wp_enqueue_script( 'gutentype-options', gutentype_get_file_url( 'theme-options/theme-options.js' ), array( 'jquery' ), null, true );
				wp_localize_script( 'gutentype-options', 'gutentype_dependencies', gutentype_get_theme_dependencies() );
			}
		}
	}
}


// Add step to the 'Quick Setup'
if ( ! function_exists( 'gutentype_options_qsetup_theme_panel_steps' ) ) {
	add_filter( 'trx_addons_filter_theme_panel_steps', 'gutentype_options_qsetup_theme_panel_steps' );
	function gutentype_options_qsetup_theme_panel_steps( $steps ) {
		if ( ! GUTENTYPE_THEME_FREE ) {
			$steps = gutentype_array_merge( $steps, array( 'qsetup' => esc_html__( 'Start customizing your theme.', 'gutentype' ) ) );
		}
		return $steps;
	}
}


// Add tab link 'Quick Setup'
if ( ! function_exists( 'gutentype_options_qsetup_theme_panel_tabs' ) ) {
	add_filter( 'trx_addons_filter_theme_panel_tabs', 'gutentype_options_qsetup_theme_panel_tabs' );
	function gutentype_options_qsetup_theme_panel_tabs( $tabs ) {
		if ( ! GUTENTYPE_THEME_FREE ) {
			$tabs = gutentype_array_merge( $tabs, array( 'qsetup' => esc_html__( 'Quick Setup', 'gutentype' ) ) );
		}
		return $tabs;
	}
}

// Add accent colors to the 'Quick Setup' section in the Theme Panel
if ( ! function_exists( 'gutentype_options_qsetup_add_accent_colors' ) ) {
	add_filter( 'gutentype_filter_qsetup_options', 'gutentype_options_qsetup_add_accent_colors' );
	function gutentype_options_qsetup_add_accent_colors( $options ) {
		return gutentype_array_merge(
			array(
				'colors_info'        => array(
					'title'    => esc_html__( 'Theme Colors', 'gutentype' ),
					'desc'     => '',
					'qsetup'   => esc_html__( 'General', 'gutentype' ),
					'type'     => 'info',
				),
				'colors_text_link'   => array(
					'title'    => esc_html__( 'Accent color 1', 'gutentype' ),
					'desc'     => wp_kses_data( __( "Color of the links", 'gutentype' ) ),
					'std'      => '',
					'val'      => gutentype_get_scheme_color( 'text_link' ),
					'qsetup'   => esc_html__( 'General', 'gutentype' ),
					'type'     => 'color',
				),
				'colors_text_hover'  => array(
					'title'    => esc_html__( 'Accent color 1 (hovered state)', 'gutentype' ),
					'desc'     => wp_kses_data( __( "Color of the hovered state of the links", 'gutentype' ) ),
					'std'      => '',
					'val'      => gutentype_get_scheme_color( 'text_hover' ),
					'qsetup'   => esc_html__( 'General', 'gutentype' ),
					'type'     => 'color',
				),
				'colors_text_link2'  => array(
					'title'    => esc_html__( 'Accent color 2', 'gutentype' ),
					'desc'     => wp_kses_data( __( "Color of the accented areas", 'gutentype' ) ),
					'std'      => '',
					'val'      => gutentype_get_scheme_color( 'text_link2' ),
					'qsetup'   => esc_html__( 'General', 'gutentype' ),
					'type'     => 'color',
				),
				'colors_text_hover2' => array(
					'title'    => esc_html__( 'Accent color 2 (hovered state)', 'gutentype' ),
					'desc'     => wp_kses_data( __( "Color of the hovered state of the accented areas", 'gutentype' ) ),
					'std'      => '',
					'val'      => gutentype_get_scheme_color( 'text_hover2' ),
					'qsetup'   => esc_html__( 'General', 'gutentype' ),
					'type'     => 'color',
				),
				'colors_text_link3'  => array(
					'title'    => esc_html__( 'Accent color 3', 'gutentype' ),
					'desc'     => wp_kses_data( __( "Color of the another accented areas", 'gutentype' ) ),
					'std'      => '',
					'val'      => gutentype_get_scheme_color( 'text_link3' ),
					'qsetup'   => esc_html__( 'General', 'gutentype' ),
					'type'     => 'color',
				),
				'colors_text_hover3' => array(
					'title'    => esc_html__( 'Accent color 3 (hovered state)', 'gutentype' ),
					'desc'     => wp_kses_data( __( "Color of the hovered state of the another accented areas", 'gutentype' ) ),
					'std'      => '',
					'val'      => gutentype_get_scheme_color( 'text_hover3' ),
					'qsetup'   => esc_html__( 'General', 'gutentype' ),
					'type'     => 'color',
				),
			),
			$options
		);
	}
}

// Display 'Quick Setup' section in the Theme Panel
if ( ! function_exists( 'gutentype_options_qsetup_theme_panel_section' ) ) {
	add_action( 'trx_addons_action_theme_panel_section', 'gutentype_options_qsetup_theme_panel_section', 10, 2);
	function gutentype_options_qsetup_theme_panel_section( $tab_id, $theme_info ) {
		if ( 'qsetup' !== $tab_id ) return;
		?>
		<div id="trx_addons_theme_panel_section_<?php echo esc_attr($tab_id); ?>" class="trx_addons_tabs_section">

			<?php do_action('trx_addons_action_theme_panel_section_start', $tab_id, $theme_info); ?>
			
			<div class="trx_addons_theme_panel_qsetup">

				<?php do_action('trx_addons_action_theme_panel_before_section_title', $tab_id, $theme_info); ?>

				<h1 class="trx_addons_theme_panel_section_title">
					<?php esc_html_e( 'Quick Setup', 'gutentype' ); ?>
				</h1>

				<?php do_action('trx_addons_action_theme_panel_after_section_title', $tab_id, $theme_info); ?>
				
				<div class="trx_addons_theme_panel_section_info">
					<p>
						<?php
						echo wp_kses_data( __( 'Here you can customize the basic settings of your website.', 'gutentype' ) )
							. ' '
							. wp_kses_data( sprintf(
								__( 'For a detailed customization, go to %s.', 'gutentype' ),
								'<a href="' . esc_url(admin_url() . 'customize.php') . '">' . esc_html__( 'Customizer', 'gutentype' ) . '</a>'
								. ( GUTENTYPE_THEME_FREE 
									? ''
									: ' ' . esc_html__( 'or', 'gutentype' ) . ' ' . '<a href="' . esc_url( get_admin_url( null, 'admin.php?page=trx_addons_theme_panel' ) ) . '">' . esc_html__( 'Theme Options', 'gutentype' ) . '</a>'
									)
								)
							);
						?>
					</p>
					<p><?php echo wp_kses_data( __( "<b>Note:</b> If you've imported the demo data, you may skip this step, since all the necessary settings have already been applied.", 'gutentype' ) ); ?></p>
				</div>

				<?php
				do_action('trx_addons_action_theme_panel_before_qsetup', $tab_id, $theme_info);

				gutentype_options_qsetup_show();

				do_action('trx_addons_action_theme_panel_after_qsetup', $tab_id, $theme_info);
				?>

			</div>

			<?php do_action('trx_addons_action_theme_panel_section_end', $tab_id, $theme_info); ?>

		</div>
		<?php
	}
}


// Display options
if ( ! function_exists( 'gutentype_options_qsetup_show' ) ) {
	function gutentype_options_qsetup_show() {
		$tabs_titles  = array();
		$tabs_content = array();
		$options      = apply_filters( 'gutentype_filter_qsetup_options', gutentype_storage_get( 'options' ) );
		// Show fields
		$cnt = 0;
		foreach ( $options as $k => $v ) {
			if ( empty( $v['qsetup'] ) ) {
				continue;
			}
			if ( is_bool( $v['qsetup'] ) ) {
				$v['qsetup'] = esc_html__( 'General', 'gutentype' );
			}
			if ( ! isset( $tabs_titles[ $v['qsetup'] ] ) ) {
				$tabs_titles[ $v['qsetup'] ]  = $v['qsetup'];
				$tabs_content[ $v['qsetup'] ] = '';
			}
			if ( 'info' !== $v['type'] ) {
				$cnt++;
				if ( ! empty( $v['class'] ) ) {
					$v['class'] = str_replace( array( 'gutentype_column-1_2', 'gutentype_new_row' ), '', $v['class'] );
				}
				$v['class'] = ( ! empty( $v['class'] ) ? $v['class'] . ' ' : '' ) . 'gutentype_column-1_2' . ( $cnt % 2 == 1 ? ' gutentype_new_row' : '' );
			} else {
				$cnt = 0;
			}
			$tabs_content[ $v['qsetup'] ] .= gutentype_options_show_field( $k, $v );
		}
		if ( count( $tabs_titles ) > 0 ) {
			?>
			<div class="gutentype_options gutentype_options_qsetup">
				<form action="<?php echo esc_url( get_admin_url( null, 'admin.php?page=trx_addons_theme_panel' ) ); ?>" class="trx_addons_theme_panel_section_form" name="trx_addons_theme_panel_qsetup_form" method="post">
					<input type="hidden" name="qsetup_options_nonce" value="<?php echo esc_attr( wp_create_nonce( admin_url() ) ); ?>" />
					<?php
					if ( count( $tabs_titles ) > 1 ) {
						?>
						<div id="gutentype_options_tabs" class="gutentype_tabs">
							<ul>
								<?php
								$cnt = 0;
								foreach ( $tabs_titles as $k => $v ) {
									$cnt++;
									?>
									<li><a href="#gutentype_options_<?php echo esc_attr( $cnt ); ?>"><?php echo esc_html( $v ); ?></a></li>
									<?php
								}
								?>
							</ul>
							<?php
							$cnt = 0;
							foreach ( $tabs_content as $k => $v ) {
								$cnt++;
								?>
								<div id="gutentype_options_<?php echo esc_attr( $cnt ); ?>" class="gutentype_tabs_section gutentype_options_section">
									<?php gutentype_show_layout( $v ); ?>
								</div>
								<?php
							}
							?>
						</div>
						<?php
					} else {
						?>
						<div class="gutentype_options_section">
							<?php gutentype_show_layout( gutentype_array_get_first( $tabs_content, false ) ); ?>
						</div>
						<?php
					}
					?>
					<div class="gutentype_options_buttons trx_buttons">
						<input type="button" class="gutentype_options_button_submit button button-action" value="<?php esc_attr_e( 'Save Options', 'gutentype' ); ?>">
					</div>
				</form>
			</div>
			<?php
		}
	}
}


// Save quick setup options
if ( ! function_exists( 'gutentype_options_qsetup_save_options' ) ) {
	add_action( 'after_setup_theme', 'gutentype_options_qsetup_save_options', 4 );
	function gutentype_options_qsetup_save_options() {

		if ( ! isset( $_REQUEST['page'] ) || 'trx_addons_theme_panel' != $_REQUEST['page'] || '' == gutentype_get_value_gp( 'qsetup_options_nonce' ) ) {
			return;
		}

		// verify nonce
		if ( ! wp_verify_nonce( gutentype_get_value_gp( 'qsetup_options_nonce' ), admin_url() ) ) {
			trx_addons_set_admin_message( esc_html__( 'Bad security code! Options are not saved!', 'gutentype' ), 'error', true );
			return;
		}

		// Check permissions
		if ( ! current_user_can( 'manage_options' ) ) {
			trx_addons_set_admin_message( esc_html__( 'Manage options is denied for the current user! Options are not saved!', 'gutentype' ), 'error', true );
			return;
		}

		// Prepare colors for Theme Options
		if ( '' != gutentype_get_value_gp( 'gutentype_options_field_colors_text_link' ) ) {
			$scheme_storage = get_theme_mod( 'scheme_storage' );
            if ( empty( $scheme_storage ) ) {
                $scheme_storage = gutentype_get_scheme_storage();
            }
            if ( ! empty( $scheme_storage ) ) {
				$schemes = gutentype_unserialize( $scheme_storage );
				if ( is_array( $schemes ) ) {
					$color_scheme = get_theme_mod( 'color_scheme' );
					if ( empty( $color_scheme ) ) {
						$color_scheme = gutentype_array_get_first( $schemes );
					}
					if ( ! empty( $schemes[ $color_scheme] ) ) {
						// Get posted data
						$schemes[ $color_scheme][ 'colors' ][ 'text_link' ]        = gutentype_get_value_gp( 'gutentype_options_field_colors_text_link' );
						$schemes[ $color_scheme][ 'colors' ][ 'text_hover' ]       = gutentype_get_value_gp( 'gutentype_options_field_colors_text_hover' );
						$schemes[ $color_scheme][ 'colors' ][ 'text_link2' ]       = gutentype_get_value_gp( 'gutentype_options_field_colors_text_link2' );
						$schemes[ $color_scheme][ 'colors' ][ 'text_hover2' ]      = gutentype_get_value_gp( 'gutentype_options_field_colors_text_hover2' );
						$schemes[ $color_scheme][ 'colors' ][ 'text_link3' ]       = gutentype_get_value_gp( 'gutentype_options_field_colors_text_link3' );
						$schemes[ $color_scheme][ 'colors' ][ 'text_hover3' ]      = gutentype_get_value_gp( 'gutentype_options_field_colors_text_hover3' );
						// Calculate 'alter' colors
						$schemes[ $color_scheme][ 'colors' ][ 'alter_link' ]       = $schemes[ $color_scheme][ 'colors' ][ 'text_hover' ];
						$schemes[ $color_scheme][ 'colors' ][ 'alter_hover' ]      = $schemes[ $color_scheme][ 'colors' ][ 'text_link' ];
						$schemes[ $color_scheme][ 'colors' ][ 'alter_link2' ]      = $schemes[ $color_scheme][ 'colors' ][ 'text_hover2' ];
						$schemes[ $color_scheme][ 'colors' ][ 'alter_hover2' ]     = $schemes[ $color_scheme][ 'colors' ][ 'text_link2' ];
						$schemes[ $color_scheme][ 'colors' ][ 'alter_link3' ]      = $schemes[ $color_scheme][ 'colors' ][ 'text_hover3' ];
						$schemes[ $color_scheme][ 'colors' ][ 'alter_hover3' ]     = $schemes[ $color_scheme][ 'colors' ][ 'text_link3' ];
						// Calculate 'extra' colors
						$schemes[ $color_scheme][ 'colors' ][ 'extra_link' ]       = $schemes[ $color_scheme][ 'colors' ][ 'text_link' ];
						$schemes[ $color_scheme][ 'colors' ][ 'extra_hover' ]      = $schemes[ $color_scheme][ 'colors' ][ 'text_hover' ];
						$schemes[ $color_scheme][ 'colors' ][ 'extra_link2' ]      = $schemes[ $color_scheme][ 'colors' ][ 'text_link2' ];
						$schemes[ $color_scheme][ 'colors' ][ 'extra_hover2' ]     = $schemes[ $color_scheme][ 'colors' ][ 'text_hover2' ];
						$schemes[ $color_scheme][ 'colors' ][ 'extra_link3' ]      = $schemes[ $color_scheme][ 'colors' ][ 'text_link3' ];
						$schemes[ $color_scheme][ 'colors' ][ 'extra_hover3' ]     = $schemes[ $color_scheme][ 'colors' ][ 'text_hover3' ];
						// Calculate 'inverse' colors
						$hsb                                                       = gutentype_hex2hsb( $schemes[ $color_scheme][ 'colors' ][ 'text_link' ] );
						$hsb['b']                                                  = max( 0, $hsb['b'] - 10 );
						$schemes[ $color_scheme][ 'colors' ][ 'inverse_bd_color' ] = gutentype_hsb2hex( $hsb );
						$hsb['b']                                                  = max( 0, $hsb['b'] - 10 );
						$schemes[ $color_scheme][ 'colors' ][ 'inverse_bd_hover' ] = gutentype_hsb2hex( $hsb );
						// Put new values to the POST
						$_POST['gutentype_options_field_scheme_storage']             = serialize( $schemes );
					}
				}
			}
		}

		// Save options
		gutentype_options_update( null, 'gutentype_options_field_' );

		// Return result
		trx_addons_set_admin_message( esc_html__( 'Options are saved', 'gutentype' ), 'success', true );
		wp_redirect( get_admin_url( null, 'admin.php?page=trx_addons_theme_panel#trx_addons_theme_panel_section_qsetup' ) );
		exit();
	}
}
