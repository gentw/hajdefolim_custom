<?php
/* Gutenberg support functions
------------------------------------------------------------------------------- */

// Theme init priorities:
// 9 - register other filters (for installer, etc.)
if ( ! function_exists( 'gutentype_gutenberg_theme_setup9' ) ) {
	add_action( 'after_setup_theme', 'gutentype_gutenberg_theme_setup9', 9 );
	function gutentype_gutenberg_theme_setup9() {

		// Add editor styles to backend
		add_theme_support( 'editor-styles' );
		if (gutentype_exists_gutenberg()) {
			if ( ! gutentype_get_theme_setting( 'gutenberg_add_context' ) ) {
				add_editor_style( gutentype_get_file_url( 'plugins/gutenberg/gutenberg-preview.css' ) );
			}
		} else {
			add_editor_style( gutentype_get_file_url('css/editor-style.css') );
		}

		
		add_filter( 'gutentype_filter_merge_styles', 'gutentype_gutenberg_merge_styles' );
		add_filter( 'gutentype_filter_merge_styles_responsive', 'gutentype_gutenberg_merge_styles_responsive' );
		add_action( 'enqueue_block_editor_assets', 'gutentype_gutenberg_editor_scripts' );
		add_filter( 'gutentype_filter_localize_script_admin',	'gutentype_gutenberg_localize_script');
		add_action( 'after_setup_theme', 'gutentype_gutenberg_add_editor_colors' );


		if ( is_admin() ) {
			add_filter( 'gutentype_filter_tgmpa_required_plugins', 'gutentype_gutenberg_tgmpa_required_plugins' );
		}
	}
}

// Check if Gutenberg is installed and activated
if ( ! function_exists( 'gutentype_exists_gutenberg' ) ) {
	function gutentype_exists_gutenberg() {
		return function_exists( 'register_block_type' );
	}
}

// Return true if Gutenberg exists and current mode is preview
if ( ! function_exists( 'gutentype_gutenberg_is_preview' ) ) {
	function gutentype_gutenberg_is_preview() {
		return false;
	}
}

// Filter to add in the required plugins list
if ( ! function_exists( 'gutentype_gutenberg_tgmpa_required_plugins' ) ) {
	function gutentype_gutenberg_tgmpa_required_plugins( $list = array() ) {
		if ( gutentype_storage_isset( 'required_plugins', 'gutenberg' ) && gutentype_storage_get_array( 'required_plugins', 'gutenberg', 'install' ) !== false ) {
			if ( version_compare( get_bloginfo( 'version' ), '5.0', '<' ) ) {
				$list[] = array(
					'name'     => gutentype_storage_get_array( 'required_plugins', 'gutenberg' ),
					'slug'     => 'gutenberg',
					'required' => false,
				);
			}
		}
		return $list;
	}
}

// Merge custom styles
if ( ! function_exists( 'gutentype_gutenberg_merge_styles' ) ) {
	function gutentype_gutenberg_merge_styles( $list ) {
		if ( gutentype_exists_gutenberg() ) {
			$list[] = 'plugins/gutenberg/_gutenberg.scss';
		}
		return $list;
	}
}

// Merge responsive styles
if ( ! function_exists( 'gutentype_gutenberg_merge_styles_responsive' ) ) {
	function gutentype_gutenberg_merge_styles_responsive( $list ) {
		if ( gutentype_exists_gutenberg() ) {
			$list[] = 'plugins/gutenberg/_gutenberg-responsive.scss';
		}
		return $list;
	}
}


// Load required styles and scripts for Gutenberg Editor mode
if ( ! function_exists( 'gutentype_gutenberg_editor_scripts' ) ) {
	function gutentype_gutenberg_editor_scripts() {

		gutentype_admin_scripts();
		gutentype_admin_localize_scripts();
		
		// Editor styles
		if ( gutentype_get_theme_setting( 'gutenberg_add_context' ) ) {
			wp_enqueue_style( 'gutentype-gutenberg-preview', gutentype_get_file_url( 'plugins/gutenberg/gutenberg-preview.css' ), array(), null );
		}
		// Editor scripts
		wp_enqueue_script( 'gutentype-gutenberg-preview', gutentype_get_file_url( 'plugins/gutenberg/gutenberg-preview.js' ), array( 'jquery' ), null, true );

	}
}

// Add plugin's specific variables to the scripts
if ( ! function_exists( 'gutentype_gutenberg_localize_script' ) ) {
	function gutentype_gutenberg_localize_script( $arr ) {
		$arr['color_scheme']  = gutentype_get_theme_option( 'color_scheme' );
		return $arr;
	}
}

// Save CSS with custom colors and fonts to the gutenberg-editor-style.css
if ( ! function_exists( 'gutentype_gutenberg_save_css' ) ) {
	add_action( 'gutentype_action_save_options', 'gutentype_gutenberg_save_css', 21 );
	add_action( 'trx_addons_action_save_options', 'gutentype_gutenberg_save_css', 21 );
	function gutentype_gutenberg_save_css() {
		$msg = '/* ' . esc_html__( "ATTENTION! This file was generated automatically! Don't change it!!!", 'gutentype' )
			. "\n----------------------------------------------------------------------- */\n";

		// Get main styles
		$css = gutentype_fgc( gutentype_get_file_dir( 'style.css' ) );

		// Append theme-vars styles
		$css .= gutentype_customizer_get_css(
			array(
				'colors' => gutentype_get_theme_setting( 'separate_schemes' ) ? false : null,
			)
		);

		// Append color schemes
		if ( gutentype_get_theme_setting( 'separate_schemes' ) ) {
			$schemes = gutentype_get_sorted_schemes();
			if ( is_array( $schemes ) ) {
				foreach ( $schemes as $scheme => $data ) {
					$css .= gutentype_customizer_get_css(
						array(
							'fonts'  => false,
							'colors' => $data['colors'],
							'scheme' => $scheme,
						)
					);
				}
			}
		}

		// Add context class to each selector
		if ( gutentype_get_theme_setting( 'gutenberg_add_context' ) && function_exists( 'trx_addons_css_add_context' ) ) {		
			$css = trx_addons_css_add_context(
				$css,
				array(
					'context' => '.edit-post-visual-editor ',
					'context_self' => array( 'html', 'body', '.edit-post-visual-editor' )
				)
			);
		} else {
			$css = apply_filters( 'gutentype_filter_prepare_css', $css );
		}

		// Save styles to the file
		gutentype_fpc( gutentype_get_file_dir( 'plugins/gutenberg/gutenberg-preview.css' ), $msg . $css );
	}
}

// Add theme-specific colors to the Gutenberg color picker
if ( ! function_exists( 'gutentype_gutenberg_add_editor_colors' ) ) {
	function gutentype_gutenberg_add_editor_colors() {
		$scheme = gutentype_get_scheme_colors();
		$groups = gutentype_storage_get( 'scheme_color_groups' );
		$names  = gutentype_storage_get( 'scheme_color_names' );
		$colors = array();
		foreach( $groups as $g => $group ) {
			foreach( $names as $n => $name ) {
				$c = 'main' == $g ? $n : $g . '_' . str_replace( 'text_', '', $n );
				if ( isset( $scheme[ $c ] ) ) {
					$colors[] = array(
						'name'  => ( 'main' == $g ? '' : $group['title'] . ' ' ) . $name['title'],
						'slug'  => $c,
						'color' => $scheme[ $c ]
					);
				}
			}
			// Add only one group of colors
			// Delete next condition (or add false && to them) to add all groups
			if ( 'main' == $g ) {
				break;
			}
		}
		add_theme_support( 'editor-color-palette', $colors );
	}
}


// Add plugin-specific colors and fonts to the custom CSS
if ( gutentype_exists_gutenberg() ) {
	require_once GUTENTYPE_THEME_DIR . 'plugins/gutenberg/gutenberg-styles.php';
}
