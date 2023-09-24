<?php
/**
 * Theme Options, Color Schemes and Fonts utilities
 *
 * @package WordPress
 * @subpackage GUTENTYPE
 * @since GUTENTYPE 1.0
 */

// -----------------------------------------------------------------
// -- Create and manage Theme Options
// -----------------------------------------------------------------

// Theme init priorities:
// 2 - create Theme Options
if ( ! function_exists( 'gutentype_options_theme_setup2' ) ) {
	add_action( 'after_setup_theme', 'gutentype_options_theme_setup2', 2 );
	function gutentype_options_theme_setup2() {
		gutentype_create_theme_options();
	}
}

// Step 1: Load default settings and previously saved mods
if ( ! function_exists( 'gutentype_options_theme_setup5' ) ) {
	add_action( 'after_setup_theme', 'gutentype_options_theme_setup5', 5 );
	function gutentype_options_theme_setup5() {
		gutentype_storage_set( 'options_reloaded', false );
		gutentype_load_theme_options();
	}
}

// Step 2: Load current theme customization mods
if ( is_customize_preview() ) {
	if ( ! function_exists( 'gutentype_load_custom_options' ) ) {
		add_action( 'wp_loaded', 'gutentype_load_custom_options' );
		function gutentype_load_custom_options() {
			if ( ! gutentype_storage_get( 'options_reloaded' ) ) {
				gutentype_storage_set( 'options_reloaded', true );
				gutentype_load_theme_options();
			}
		}
	}
}



// Load current values for each customizable option
if ( ! function_exists( 'gutentype_load_theme_options' ) ) {
	function gutentype_load_theme_options() {
		$options = gutentype_storage_get( 'options' );
		$reset   = (int) get_theme_mod( 'reset_options', 0 );
		foreach ( $options as $k => $v ) {
			if ( isset( $v['std'] ) ) {
				$value = gutentype_get_theme_option_std( $k, $v['std'] );
				if ( ! $reset ) {
					if ( isset( $_GET[ $k ] ) ) {
						$value = wp_kses_data( wp_unslash( $_GET[ $k ] ) );
					} else {
						$default_value = -987654321;
						$tmp           = get_theme_mod( $k, $default_value );
						if ( $tmp != $default_value ) {
							$value = $tmp;
						}
					}
				}
				gutentype_storage_set_array2( 'options', $k, 'val', $value );
				if ( $reset ) {
					remove_theme_mod( $k );
				}
			}
		}
		if ( $reset ) {
			// Unset reset flag
			set_theme_mod( 'reset_options', 0 );
			// Regenerate CSS with default colors and fonts
			gutentype_customizer_save_css();
		} else {
			do_action( 'gutentype_action_load_options' );
		}
	}
}

// Override options with stored page/post meta
if ( ! function_exists( 'gutentype_override_theme_options' ) ) {
	add_action( 'wp', 'gutentype_override_theme_options', 1 );
	function gutentype_override_theme_options( $query = null ) {
		if ( is_page_template( 'blog.php' ) ) {
			gutentype_storage_set( 'blog_archive', true );
			gutentype_storage_set( 'blog_template', get_the_ID() );
		}
		gutentype_storage_set( 'blog_mode', gutentype_detect_blog_mode() );
		if ( is_singular() ) {
			gutentype_storage_set( 'options_meta', get_post_meta( get_the_ID(), 'gutentype_options', true ) );
		}
		do_action( 'gutentype_action_override_theme_options' );
	}
}

// Override options with stored page meta on 'Blog posts' pages
if ( ! function_exists( 'gutentype_blog_override_theme_options' ) ) {
	add_action( 'gutentype_action_override_theme_options', 'gutentype_blog_override_theme_options' );
	function gutentype_blog_override_theme_options() {
		global $wp_query;
		if ( is_home() && ! is_front_page() && ! empty( $wp_query->is_posts_page ) ) {
			$id = get_option( 'page_for_posts' );
			if ( $id > 0 ) {
				gutentype_storage_set( 'options_meta', get_post_meta( $id, 'gutentype_options', true ) );
			}
		}
	}
}


// Return 'std' value of the option, processed by special function (if specified)
if ( ! function_exists( 'gutentype_get_theme_option_std' ) ) {
	function gutentype_get_theme_option_std( $opt_name, $opt_std ) {
		if ( ! is_array( $opt_std ) && strpos( $opt_std, '$gutentype_' ) !== false ) {
			$func = substr( $opt_std, 1 );
			if ( function_exists( $func ) ) {
				$opt_std = $func( $opt_name );
			}
		}
		return $opt_std;
	}
}


// Return customizable option value
if ( ! function_exists( 'gutentype_get_theme_option' ) ) {
	function gutentype_get_theme_option( $name, $defa = '', $strict_mode = false, $post_id = 0 ) {
		$rez            = $defa;
		$from_post_meta = false;

		if ( $post_id > 0 ) {
			if ( ! gutentype_storage_isset( 'post_options_meta', $post_id ) ) {
				gutentype_storage_set_array( 'post_options_meta', $post_id, get_post_meta( $post_id, 'gutentype_options', true ) );
			}
			if ( gutentype_storage_isset( 'post_options_meta', $post_id, $name ) ) {
				$tmp = gutentype_storage_get_array( 'post_options_meta', $post_id, $name );
				if ( ! gutentype_is_inherit( $tmp ) ) {
					$rez            = $tmp;
					$from_post_meta = true;
				}
			}
		}

		if ( ! $from_post_meta && gutentype_storage_isset( 'options' ) ) {

			$blog_mode = gutentype_storage_get( 'blog_mode' );

			if ( ! gutentype_storage_isset( 'options', $name ) && ( empty( $blog_mode ) || ! gutentype_storage_isset( 'options', $name . '_' . $blog_mode ) ) ) {
				$rez = '_not_exists_';
				$tmp = $rez;
				if ( function_exists( 'trx_addons_get_option' ) ) {
					$rez = trx_addons_get_option( $name, $tmp, false );
				}
				if ( $rez === $tmp ) {
					if ( $strict_mode ) {
						// Translators: Add option's name to the output
						echo '<pre>' . esc_html( sprintf( __( 'Undefined option "%s" called from:', 'gutentype' ), $name ) );
						if ( function_exists( 'dcs' ) ) {
							dcs();
						}
						echo '</pre>';
						wp_die();
					} else {
						$rez = $defa;
					}
				}
			} else {

				$blog_mode_parent = 'post' == $blog_mode
										? 'blog'
										: str_replace( '_single', '', $blog_mode );

				// Override option from GET or POST for current blog mode
				if ( ! empty( $blog_mode ) && isset( $_REQUEST[ $name . '_' . $blog_mode ] ) ) {
					$rez = wp_kses_data( wp_unslash( $_REQUEST[ $name . '_' . $blog_mode ] ) );

					// Override option from GET
				} elseif ( isset( $_REQUEST[ $name ] ) ) {
					$rez = wp_kses_data( wp_unslash( $_REQUEST[ $name ] ) );

					// Override option from current page settings (if exists)
				} elseif ( gutentype_storage_isset( 'options_meta', $name ) && ! gutentype_is_inherit( gutentype_storage_get_array( 'options_meta', $name ) ) ) {
					$rez = gutentype_storage_get_array( 'options_meta', $name );

					// Override option from current blog mode settings: 'front', 'search', 'page', 'post', 'blog', etc. (if exists)
				} elseif ( ! empty( $blog_mode ) && gutentype_storage_isset( 'options', $name . '_' . $blog_mode, 'val' ) && ! gutentype_is_inherit( gutentype_storage_get_array( 'options', $name . '_' . $blog_mode, 'val' ) ) ) {
					$rez = gutentype_storage_get_array( 'options', $name . '_' . $blog_mode, 'val' );

					// Override option for 'post' from 'blog' settings (if exists)
					// Also used for override 'xxx_single' on the 'xxx'
					// (for example, instead 'sidebar_courses_single' return option for 'sidebar_courses')
				} elseif ( ! empty( $blog_mode_parent ) && $blog_mode != $blog_mode_parent && gutentype_storage_isset( 'options', $name . '_' . $blog_mode_parent, 'val' ) && ! gutentype_is_inherit( gutentype_storage_get_array( 'options', $name . '_' . $blog_mode_parent, 'val' ) ) ) {
					$rez = gutentype_storage_get_array( 'options', $name . '_' . $blog_mode_parent, 'val' );

					// Get saved option value
				} elseif ( gutentype_storage_isset( 'options', $name, 'val' ) ) {
					$rez = gutentype_storage_get_array( 'options', $name, 'val' );

					// Get ThemeREX Addons option value
				} elseif ( function_exists( 'trx_addons_get_option' ) ) {
					$rez = trx_addons_get_option( $name, $defa, false );

				}
			}
		}
		return $rez;
	}
}


// Check if customizable option exists
if ( ! function_exists( 'gutentype_check_theme_option' ) ) {
	function gutentype_check_theme_option( $name ) {
		return gutentype_storage_isset( 'options', $name );
	}
}


// Return customizable option value, stored in the posts meta
if ( ! function_exists( 'gutentype_get_theme_option_from_meta' ) ) {
	function gutentype_get_theme_option_from_meta( $name, $defa = '' ) {
		$rez = $defa;
		if ( gutentype_storage_isset( 'options_meta' ) ) {
			if ( gutentype_storage_isset( 'options_meta', $name ) ) {
				$rez = gutentype_storage_get_array( 'options_meta', $name );
			} else {
				$rez = 'inherit';
			}
		}
		return $rez;
	}
}


// Get dependencies list from the Theme Options
if ( ! function_exists( 'gutentype_get_theme_dependencies' ) ) {
	function gutentype_get_theme_dependencies() {
		$options = gutentype_storage_get( 'options' );
		$depends = array();
		foreach ( $options as $k => $v ) {
			if ( isset( $v['dependency'] ) ) {
				$depends[ $k ] = $v['dependency'];
			}
		}
		return $depends;
	}
}



//------------------------------------------------
// Save options
//------------------------------------------------
if ( ! function_exists( 'gutentype_options_save' ) ) {
	add_action( 'after_setup_theme', 'gutentype_options_save', 4 );
	function gutentype_options_save() {

		if ( ! isset( $_REQUEST['page'] ) || 'theme_options' != $_REQUEST['page'] || '' == gutentype_get_value_gp( 'gutentype_nonce' ) ) {
			return;
		}

		// verify nonce
		if ( ! wp_verify_nonce( gutentype_get_value_gp( 'gutentype_nonce' ), admin_url() ) ) {
			gutentype_add_admin_message( esc_html__( 'Bad security code! Options are not saved!', 'gutentype' ), 'error', true );
			return;
		}

		// Check permissions
		if ( ! current_user_can( 'manage_options' ) ) {
			gutentype_add_admin_message( esc_html__( 'Manage options is denied for the current user! Options are not saved!', 'gutentype' ), 'error', true );
			return;
		}

		// Save options
		gutentype_options_update( null, 'gutentype_options_field_' );

		// Return result
		gutentype_add_admin_message( esc_html__( 'Options are saved', 'gutentype' ) );
		wp_redirect( get_admin_url( null, 'admin.php?page=theme_options' ) );
		exit();
	}
}


// Update theme options from specified source
// (_POST or any other options storage)
if ( ! function_exists( 'gutentype_options_update' ) ) {
	function gutentype_options_update( $from = null, $from_prefix = '' ) {
		$options           = gutentype_storage_get( 'options' );
		$external_storages = array();
		$values            = null === $from ? get_theme_mods() : $from;
		foreach ( $options as $k => $v ) {
			// Skip non-data options - sections, info, etc.
			if ( ! isset( $v['std'] ) ) {
				continue;
			}
			// Get new value
			$value = null;
			if ( null === $from ) {
				$from_name = "{$from_prefix}{$k}";
				if ( isset( $_POST[ $from_name ] ) ) {
					$value = gutentype_get_value_gp( $from_name );
					// Individual options processing
					if ( 'custom_logo' == $k ) {
						if ( ! empty( $value ) && 0 == (int) $value ) {
							$value = attachment_url_to_postid( gutentype_clear_thumb_size( $value ) );
							if ( empty( $value ) ) {
								$value = null === $from ? get_theme_mod( $k ) : $values[$k];
							}
						}
					}
					// Save to the result array
					if ( ! empty( $v['type'] ) && 'hidden' != $v['type'] && ( empty( $v['hidden'] ) || ! $v['hidden'] ) && gutentype_get_theme_option_std( $k, $v['std'] ) != $value ) {
						$values[ $k ] = $value;
					} elseif ( isset( $values[ $k ] ) ) {
						unset( $values[ $k ] );
						$value = null;
					}
				}
			} else {
				$value = isset( $values[ $k ] )
								? $values[ $k ]
								: gutentype_get_theme_option_std( $k, $v['std'] );
			}
			// External plugin's options
			if ( $value !== null && ! empty( $v['options_storage'] ) ) {
				if ( ! isset( $external_storages[ $v['options_storage'] ] ) ) {
					$external_storages[ $v['options_storage'] ] = array();
				}
				$external_storages[ $v['options_storage'] ][ $k ] = $value;
			}
		}

		// Update options in the external storages
		foreach ( $external_storages as $storage_name => $storage_values ) {
			$storage = get_option( $storage_name, false );
			if ( is_array( $storage ) ) {
				foreach ( $storage_values as $k => $v ) {
					$storage[ $k ] = $v;
				}
				update_option( $storage_name, apply_filters( 'gutentype_filter_options_save', $storage, $storage_name ) );
			}
		}

		// Update Theme Mods (internal Theme Options)
		$stylesheet_slug = get_option( 'stylesheet' );
		$values          = apply_filters( 'gutentype_filter_options_save', $values, 'theme_mods' );
		update_option( "theme_mods_{$stylesheet_slug}", $values );

		do_action( 'gutentype_action_just_save_options', $values );

		// Store new schemes colors
		if ( ! empty( $values['scheme_storage'] ) ) {
			$schemes = gutentype_unserialize( $values['scheme_storage'] );
			if ( is_array( $schemes ) && count( $schemes ) > 0 ) {
				gutentype_storage_set( 'schemes', $schemes );
			}
		}

		// Store new fonts parameters
		$fonts = gutentype_get_theme_fonts();
		foreach ( $fonts as $tag => $v ) {
			foreach ( $v as $css_prop => $css_value ) {
				if ( in_array( $css_prop, array( 'title', 'description' ) ) ) {
					continue;
				}
				if ( isset( $values[ "{$tag}_{$css_prop}" ] ) ) {
					$fonts[ $tag ][ $css_prop ] = $values[ "{$tag}_{$css_prop}" ];
				}
			}
		}
		gutentype_storage_set( 'theme_fonts', $fonts );

		// Update ThemeOptions save timestamp
		$stylesheet_time = time();
		update_option( "gutentype_options_timestamp_{$stylesheet_slug}", $stylesheet_time );

		// Sinchronize theme options between child and parent themes
		if ( gutentype_get_theme_setting( 'duplicate_options' ) == 'both' ) {
			$theme_slug = get_option( 'template' );
			if ( $theme_slug != $stylesheet_slug ) {
				gutentype_customizer_duplicate_theme_options( $stylesheet_slug, $theme_slug, $stylesheet_time );
			}
		}

		// Apply action - moved to the delayed state (see below) to load all enabled modules and apply changes after
		// Attention! Don't remove comment the line below!
		// Not need here: do_action('gutentype_action_save_options');
		update_option( 'gutentype_action', 'gutentype_action_save_options' );
	}
}


//-------------------------------------------------------
//-- Delayed action from previous session
//-- (after save options)
//-- to save new CSS, etc.
//-------------------------------------------------------
if ( ! function_exists( 'gutentype_do_delayed_action' ) ) {
	add_action( 'after_setup_theme', 'gutentype_do_delayed_action' );
	function gutentype_do_delayed_action() {
		$action = get_option( 'gutentype_action' );
		if ( '' != $action ) {
			do_action( $action );
			update_option( 'gutentype_action', '' );
		}
	}
}



// -----------------------------------------------------------------
// -- Theme Settings utilities
// -----------------------------------------------------------------

// Return internal theme setting value
if ( ! function_exists( 'gutentype_get_theme_setting' ) ) {
	function gutentype_get_theme_setting( $name ) {
		if ( ! gutentype_storage_isset( 'settings', $name ) ) {
			// Translators: Add setting's name to the output
			echo '<pre>' . esc_html( sprintf( __( 'Undefined setting "%s" called from:', 'gutentype' ), $name ) );
			if ( function_exists( 'dcs' ) ) {
				dcs();
			}
			echo '</pre>';
			wp_die();
		} else {
			return gutentype_storage_get_array( 'settings', $name );
		}
	}
}

// Set theme setting
if ( ! function_exists( 'gutentype_set_theme_setting' ) ) {
	function gutentype_set_theme_setting( $option_name, $value ) {
		if ( gutentype_storage_isset( 'settings', $option_name ) ) {
			gutentype_storage_set_array( 'settings', $option_name, $value );
		}
	}
}



// -----------------------------------------------------------------
// -- Color Schemes utilities
// -----------------------------------------------------------------

// Load saved values to the color schemes
if ( ! function_exists( 'gutentype_load_schemes' ) ) {
	add_action( 'gutentype_action_load_options', 'gutentype_load_schemes' );
	function gutentype_load_schemes() {
		$schemes = gutentype_storage_get( 'schemes' );
		$storage = gutentype_unserialize( gutentype_get_theme_option( 'scheme_storage' ) );
		if ( is_array( $storage ) && count( $storage ) > 0 ) {
			// New way - use all color schemes (built-in and created by user)
			gutentype_storage_set( 'schemes', $storage );
		}
	}
}

// Return specified color from current (or specified) color scheme
if ( ! function_exists( 'gutentype_get_scheme_color' ) ) {
	function gutentype_get_scheme_color( $color_name, $scheme = '' ) {
		if ( empty( $scheme ) ) {
			$scheme = gutentype_get_theme_option( 'color_scheme' );
		}
		if ( empty( $scheme ) || gutentype_storage_empty( 'schemes', $scheme ) ) {
			$scheme = 'default';
		}
		$colors = gutentype_storage_get_array( 'schemes', $scheme, 'colors' );
		return $colors[ $color_name ];
	}
}

// Return colors from current color scheme
if ( ! function_exists( 'gutentype_get_scheme_colors' ) ) {
	function gutentype_get_scheme_colors( $scheme = '' ) {
		if ( empty( $scheme ) ) {
			$scheme = gutentype_get_theme_option( 'color_scheme' );
		}
		if ( empty( $scheme ) || gutentype_storage_empty( 'schemes', $scheme ) ) {
			$scheme = 'default';
		}
		return gutentype_storage_get_array( 'schemes', $scheme, 'colors' );
	}
}

// Return colors from all schemes
if ( ! function_exists( 'gutentype_get_scheme_storage' ) ) {
	function gutentype_get_scheme_storage( $scheme = '' ) {
		return serialize( gutentype_storage_get( 'schemes' ) );
	}
}

// Return theme fonts parameter's default value
if ( ! function_exists( 'gutentype_get_scheme_color_option' ) ) {
	function gutentype_get_scheme_color_option( $option_name ) {
		$parts = explode( '_', $option_name, 2 );
		return gutentype_get_scheme_color( $parts[1] );
	}
}

// Return schemes list
if ( ! function_exists( 'gutentype_get_list_schemes' ) ) {
	function gutentype_get_list_schemes( $prepend_inherit = false ) {
		$list    = array();
		$schemes = gutentype_storage_get( 'schemes' );
		if ( is_array( $schemes ) && count( $schemes ) > 0 ) {
			foreach ( $schemes as $slug => $scheme ) {
				$list[ $slug ] = $scheme['title'];
			}
		}
		return $prepend_inherit ? gutentype_array_merge( array( 'inherit' => esc_html__( 'Inherit', 'gutentype' ) ), $list ) : $list;
	}
}

// Return all schemes, sorted by usage in the parameters 'xxx_scheme' on the current page
if ( ! function_exists( 'gutentype_get_sorted_schemes' ) ) {
	function gutentype_get_sorted_schemes() {
		$params  = gutentype_storage_get( 'schemes_sorted' );
		$schemes = gutentype_storage_get( 'schemes' );
		$rez     = array();
		if ( is_array( $schemes ) ) {
			foreach ( $params as $p ) {
				if ( ! gutentype_check_theme_option( $p ) ) {
					continue;
				}
				$s = gutentype_get_theme_option( $p );
				if ( ! empty( $s ) && ! gutentype_is_inherit( $s ) && isset( $schemes[ $s ] ) ) {
					$rez[ $s ] = $schemes[ $s ];
					unset( $schemes[ $s ] );
				}
			}
			if ( count( $schemes ) > 0 ) {
				$rez = array_merge( $rez, $schemes );
			}
		}
		return $rez;
	}
}


// -----------------------------------------------------------------
// -- Theme Fonts utilities
// -----------------------------------------------------------------

// Load saved values into fonts list
if ( ! function_exists( 'gutentype_load_fonts' ) ) {
	add_action( 'gutentype_action_load_options', 'gutentype_load_fonts' );
	function gutentype_load_fonts() {
		// Fonts to load when theme starts
		$load_fonts = array();
		for ( $i = 1; $i <= gutentype_get_theme_setting( 'max_load_fonts' ); $i++ ) {
			$name = gutentype_get_theme_option( "load_fonts-{$i}-name" );
			if ( '' != $name ) {
				$load_fonts[] = array(
					'name'   => $name,
					'family' => gutentype_get_theme_option( "load_fonts-{$i}-family" ),
					'styles' => gutentype_get_theme_option( "load_fonts-{$i}-styles" ),
				);
			}
		}
		gutentype_storage_set( 'load_fonts', $load_fonts );
		gutentype_storage_set( 'load_fonts_subset', gutentype_get_theme_option( 'load_fonts_subset' ) );

		// Font parameters of the main theme's elements
		$fonts = gutentype_get_theme_fonts();
		foreach ( $fonts as $tag => $v ) {
			foreach ( $v as $css_prop => $css_value ) {
				if ( in_array( $css_prop, array( 'title', 'description' ) ) ) {
					continue;
				}
				$fonts[ $tag ][ $css_prop ] = gutentype_get_theme_option( "{$tag}_{$css_prop}" );
			}
		}
		gutentype_storage_set( 'theme_fonts', $fonts );
	}
}

// Return slug of the loaded font
if ( ! function_exists( 'gutentype_get_load_fonts_slug' ) ) {
	function gutentype_get_load_fonts_slug( $name ) {
		return str_replace( ' ', '-', $name );
	}
}

// Return load fonts parameter's default value
if ( ! function_exists( 'gutentype_get_load_fonts_option' ) ) {
	function gutentype_get_load_fonts_option( $option_name ) {
		$rez        = '';
		$parts      = explode( '-', $option_name );
		$load_fonts = (array)gutentype_storage_get( 'load_fonts' );
		if ( 'load_fonts' == $parts[0] && count( $load_fonts ) > $parts[1] - 1 && isset( $load_fonts[ $parts[1] - 1 ][ $parts[2] ] ) ) {
			$rez = $load_fonts[ $parts[1] - 1 ][ $parts[2] ];
		}
		return $rez;
	}
}

// Return load fonts subset's default value
if ( ! function_exists( 'gutentype_get_load_fonts_subset' ) ) {
	function gutentype_get_load_fonts_subset( $option_name ) {
		return gutentype_storage_get( 'load_fonts_subset' );
	}
}

// Return load fonts list
if ( ! function_exists( 'gutentype_get_list_load_fonts' ) ) {
	function gutentype_get_list_load_fonts( $prepend_inherit = false ) {
		$list       = array();
		$load_fonts = gutentype_storage_get( 'load_fonts' );
		if ( is_array( $load_fonts ) && count( $load_fonts ) > 0 ) {
			foreach ( $load_fonts as $font ) {
				$list[ '"' . trim( $font['name'] ) . '"' . ( ! empty( $font['family'] ) ? ',' . trim( $font['family'] ) : '' ) ] = $font['name'];
			}
		}
		return $prepend_inherit ? gutentype_array_merge( array( 'inherit' => esc_html__( 'Inherit', 'gutentype' ) ), $list ) : $list;
	}
}

// Return font settings of the theme specific elements
if ( ! function_exists( 'gutentype_get_theme_fonts' ) ) {
	function gutentype_get_theme_fonts() {
		return gutentype_storage_get( 'theme_fonts' );
	}
}

// Return theme fonts parameter's default value
if ( ! function_exists( 'gutentype_get_theme_fonts_option' ) ) {
	function gutentype_get_theme_fonts_option( $option_name ) {
		$rez         = '';
		$parts       = explode( '_', $option_name );
		$theme_fonts = gutentype_storage_get( 'theme_fonts' );
		if ( ! empty( $theme_fonts[ $parts[0] ][ $parts[1] ] ) ) {
			$rez = $theme_fonts[ $parts[0] ][ $parts[1] ];
		}
		return $rez;
	}
}

// Update loaded fonts list in the each tag's parameter (p, h1..h6,...) after the 'load_fonts' options are loaded
if ( ! function_exists( 'gutentype_update_list_load_fonts' ) ) {
	add_action( 'gutentype_action_load_options', 'gutentype_update_list_load_fonts', 11 );
	function gutentype_update_list_load_fonts() {
		$theme_fonts = gutentype_get_theme_fonts();
		$load_fonts  = gutentype_get_list_load_fonts( true );
		foreach ( $theme_fonts as $tag => $v ) {
			gutentype_storage_set_array2( 'options', $tag . '_font-family', 'options', $load_fonts );
		}
	}
}



// -----------------------------------------------------------------
// -- Other options utilities
// -----------------------------------------------------------------

// Return all vars from Theme Options with option 'customizer'
if ( ! function_exists( 'gutentype_get_theme_vars' ) ) {
	function gutentype_get_theme_vars() {
		$options = gutentype_storage_get( 'options' );
		$vars    = array();
		foreach ( $options as $k => $v ) {
			if ( ! empty( $v['customizer'] ) ) {
				$vars[ $v['customizer'] ] = gutentype_get_theme_option( $k );
			}
		}
		return $vars;
	}
}

// Return current theme-specific border radius for form's fields and buttons
if ( ! function_exists( 'gutentype_get_border_radius' ) ) {
	function gutentype_get_border_radius() {
		$rad = str_replace( ' ', '', gutentype_get_theme_option( 'border_radius' ) );
		if ( empty( $rad ) ) {
			$rad = 0;
		}
		return gutentype_prepare_css_value( $rad );
	}
}




// -----------------------------------------------------------------
// -- Theme Options page
// -----------------------------------------------------------------

if ( ! function_exists( 'gutentype_options_init_page_builder' ) ) {
	add_action( 'after_setup_theme', 'gutentype_options_init_page_builder' );
	function gutentype_options_init_page_builder() {
		if ( is_admin() ) {
			add_action( 'admin_enqueue_scripts', 'gutentype_options_add_scripts' );
		}
	}
}

// Load required styles and scripts for admin mode
if ( ! function_exists( 'gutentype_options_add_scripts' ) ) {
	function gutentype_options_add_scripts() {
		$screen = function_exists( 'get_current_screen' ) ? get_current_screen() : false;
		if ( ! empty( $screen->id ) && false !== strpos($screen->id, '_page_theme_options') ) {
			wp_enqueue_style( 'fontello-icons', gutentype_get_file_url( 'css/font-icons/css/fontello-embedded.css' ), array(), null );
			wp_enqueue_style( 'wp-color-picker', false, array(), null );
			wp_enqueue_script( 'wp-color-picker', false, array( 'jquery' ), null, true );
			wp_enqueue_script( 'jquery-ui-tabs', false, array( 'jquery', 'jquery-ui-core' ), null, true );
			wp_enqueue_script( 'jquery-ui-accordion', false, array( 'jquery', 'jquery-ui-core' ), null, true );
			wp_enqueue_script( 'gutentype-options', gutentype_get_file_url( 'theme-options/theme-options.js' ), array( 'jquery' ), null, true );
			wp_enqueue_script( 'colorpicker-colors', gutentype_get_file_url( 'js/colorpicker/colors.js' ), array( 'jquery' ), null, true );
			wp_enqueue_script( 'jquery-colorpicker', gutentype_get_file_url( 'js/colorpicker/jqColorPicker.js' ), array( 'jquery' ), null, true );
			wp_localize_script( 'gutentype-options', 'gutentype_dependencies', gutentype_get_theme_dependencies() );
			wp_localize_script( 'gutentype-options', 'gutentype_color_schemes', gutentype_storage_get( 'schemes' ) );
			wp_localize_script( 'gutentype-options', 'gutentype_simple_schemes', gutentype_storage_get( 'schemes_simple' ) );
			wp_localize_script( 'gutentype-options', 'gutentype_sorted_schemes', gutentype_storage_get( 'schemes_sorted' ) );
			wp_localize_script( 'gutentype-options', 'gutentype_theme_fonts', gutentype_storage_get( 'theme_fonts' ) );
			wp_localize_script( 'gutentype-options', 'gutentype_theme_vars', gutentype_get_theme_vars() );
			wp_localize_script(
				'gutentype-options', 'gutentype_options_vars', apply_filters(
					'gutentype_filter_options_vars', array(
						'max_load_fonts' => gutentype_get_theme_setting( 'max_load_fonts' ),
					)
				)
			);
		}
	}
}

// Add Theme Options item in the Appearance menu
if ( ! function_exists( 'gutentype_options_add_theme_panel_page' ) ) {
	add_action( 'trx_addons_filter_add_theme_panel_pages', 'gutentype_options_add_theme_panel_page' );
	function gutentype_options_add_theme_panel_page($list) {
		if ( ! GUTENTYPE_THEME_FREE ) {
			$list[] = array(
				esc_html__( 'Theme Options', 'gutentype' ),
				esc_html__( 'Theme Options', 'gutentype' ),
				'manage_options',
				'theme_options',
				'gutentype_options_page_builder',
				'dashicons-admin-generic'
			);
		}
		return $list;
	}
}


// Build options page
if ( ! function_exists( 'gutentype_options_page_builder' ) ) {
	function gutentype_options_page_builder() {
		?>
		<div class="gutentype_options">
			<h2 class="gutentype_options_title"><?php esc_html_e( 'Theme Options', 'gutentype' ); ?></h2>
			<?php gutentype_show_admin_messages(); ?>
			<div class="gutentype_options_info notice notice-info notice-large">
				<p><b>
					<?php esc_html_e( 'Attention!', 'gutentype' ); ?>
				</b></p>
				<p>
					<?php echo esc_html__( 'Some of these options can be overridden in the following sections (Blog, Plugins settings, etc.) or in the settings of individual pages.', 'gutentype' )
						. '<br>'
						. esc_html__( 'If you changed such parameter and nothing happened on the page, this option may be overridden in the corresponding section or in the Page Options of this page.', 'gutentype' );
					?>
				</p>
				<p><span class="gutentype_options_asterisk"></span>
					<i>
						<?php esc_html_e( 'These options are marked with an asterisk (*) in the title.', 'gutentype' ); ?>
					</i>
				</p>
			</div>
			<form id="gutentype_options_form" action="#" method="post" enctype="multipart/form-data">
				<input type="hidden" name="gutentype_nonce" value="<?php echo esc_attr( wp_create_nonce( admin_url() ) ); ?>" />
				<?php gutentype_options_show_fields(); ?>
				<div class="gutentype_options_buttons">
					<input type="button" class="gutentype_options_button_submit" value="<?php esc_attr_e( 'Save Options', 'gutentype' ); ?>">
				</div>
			</form>
		</div>
		<?php
	}
}


// Display all option's fields
if ( ! function_exists( 'gutentype_options_show_fields' ) ) {
	function gutentype_options_show_fields( $options = false ) {
		if ( empty( $options ) ) {
			$options = gutentype_storage_get( 'options' );
		}
		$tabs_titles  = array();
		$tabs_content = array();
		$last_panel   = '';
		$last_section = '';
		$last_group   = '';
		foreach ( $options as $k => $v ) {
			if ( 'panel' == $v['type'] || ( 'section' == $v['type'] && empty( $last_panel ) ) ) {
				// New tab
				if ( ! isset( $tabs_titles[ $k ] ) ) {
					$tabs_titles[ $k ]  = $v['title'];
					$tabs_content[ $k ] = '';
				}
				if ( ! empty( $last_group ) ) {
					$tabs_content[ $last_section ] .= '</div></div>';
					$last_group                     = '';
				}
				$last_section = $k;
				if ( 'panel' == $v['type'] ) {
					$last_panel = $k;
				}
			} elseif ( 'group' == $v['type'] || ( 'section' == $v['type'] && ! empty( $last_panel ) ) ) {
				// New group
				if ( empty( $last_group ) ) {
					$tabs_content[ $last_section ] = ( ! isset( $tabs_content[ $last_section ] ) ? '' : $tabs_content[ $last_section ] )
													. '<div class="gutentype_accordion gutentype_options_groups">';
				} else {
					$tabs_content[ $last_section ] .= '</div>';
				}
				$tabs_content[ $last_section ] .= '<h4 class="gutentype_accordion_title gutentype_options_group_title">' . esc_html( $v['title'] ) . '</h4>'
												. '<div class="gutentype_accordion_content gutentype_options_group_content">';
				$last_group                     = $k;
			} elseif ( in_array( $v['type'], array( 'group_end', 'section_end', 'panel_end' ) ) ) {
				// End panel, section or group
				if ( ! empty( $last_group ) && ( 'section_end' != $v['type'] || empty( $last_panel ) ) ) {
					$tabs_content[ $last_section ] .= '</div></div>';
					$last_group                     = '';
				}
				if ( 'panel_end' == $v['type'] ) {
					$last_panel = '';
				}
			} else {
				// Field's layout
				$tabs_content[ $last_section ] = ( ! isset( $tabs_content[ $last_section ] ) ? '' : $tabs_content[ $last_section ] )
												. gutentype_options_show_field( $k, $v );
			}
		}
		if ( ! empty( $last_group ) ) {
			$tabs_content[ $last_section ] .= '</div></div>';
		}

		if ( count( $tabs_content ) > 0 ) {
			// Remove empty sections
			foreach ( $tabs_content as $k => $v ) {
				if ( empty( $v ) ) {
					unset( $tabs_titles[ $k ] );
					unset( $tabs_content[ $k ] );
				}
			}
			?>
			<div id="gutentype_options_tabs" class="gutentype_tabs <?php echo count( $tabs_titles ) > 1 ? 'with_tabs' : 'no_tabs'; ?>">
				<?php
				if ( count( $tabs_titles ) > 1 ) {
					?>
					<ul>
						<?php
						$cnt = 0;
						foreach ( $tabs_titles as $k => $v ) {
							$cnt++;
							echo '<li><a href="#gutentype_options_section_' . esc_attr( $cnt ) . '">' . esc_html( $v ) . '</a></li>';
						}
						?>
					</ul>
					<?php
				}
				$cnt = 0;
				foreach ( $tabs_content as $k => $v ) {
					$cnt++;
					?>
					<div id="gutentype_options_section_<?php echo esc_attr( $cnt ); ?>" class="gutentype_tabs_section gutentype_options_section">
						<?php gutentype_show_layout( $v ); ?>
					</div>
					<?php
				}
				?>
			</div>
			<?php
		}
	}
}


// Display single option's field
if ( ! function_exists( 'gutentype_options_show_field' ) ) {
	function gutentype_options_show_field( $name, $field, $post_type = '' ) {

		$inherit_allow = ! empty( $post_type );
		$inherit_state = ! empty( $post_type ) && isset( $field['val'] ) && gutentype_is_inherit( $field['val'] );

		$field_data_present = 'info' != $field['type'] || ! empty( $field['override']['desc'] ) || ! empty( $field['desc'] );

		if ( ( 'hidden' == $field['type'] && $inherit_allow )         // Hidden field in the post meta (not in the root Theme Options)
			|| ( ! empty( $field['hidden'] ) && ! $inherit_allow )    // Field only for post meta in the root Theme Options
		) {
			return '';
		}

		if ( 'hidden' == $field['type'] ) {
			$output = isset( $field['val'] )
							? '<input type="hidden" name="gutentype_options_field_' . esc_attr( $name ) . '"'
								. ' value="' . esc_attr( $field['val'] ) . '"'
								. ' />'
							: '';
		} else {
			$output = ( ! empty( $field['class'] ) && strpos( $field['class'], 'gutentype_new_row' ) !== false
						? '<div class="gutentype_new_row_before"></div>'
						: '' )
						. '<div class="gutentype_options_item gutentype_options_item_' . esc_attr( $field['type'] )
									. ( $inherit_allow ? ' gutentype_options_inherit_' . ( $inherit_state ? 'on' : 'off' ) : '' )
									. ( ! empty( $field['class'] ) ? ' ' . esc_attr( $field['class'] ) : '' )
									. '">'
							. '<h4 class="gutentype_options_item_title">'
								. esc_html( $field['title'] )
								. ( ! empty( $field['override'] )
										? ' <span class="gutentype_options_asterisk"></span>'
										: '' )
								. ( $inherit_allow
										? '<span class="gutentype_options_inherit_lock" id="gutentype_options_inherit_' . esc_attr( $name ) . '"></span>'
										: '' )
							. '</h4>'
							. ( $field_data_present
								? '<div class="gutentype_options_item_data">'
									. '<div class="gutentype_options_item_field" data-param="' . esc_attr( $name ) . '"'
										. ( ! empty( $field['linked'] ) ? ' data-linked="' . esc_attr( $field['linked'] ) . '"' : '' )
										. '>'
								: '' );
			if ( 'checkbox' == $field['type'] ) {
				// Type 'checkbox'
				$output .= '<label class="gutentype_options_item_label">'
							// Hack to always send checkbox value even it not checked
							. '<input type="hidden" name="gutentype_options_field_' . esc_attr( $name ) . '" value="' . esc_attr( gutentype_is_inherit( $field['val'] ) ? '' : $field['val'] ) . '" />'
							. '<input type="checkbox" name="gutentype_options_field_' . esc_attr( $name ) . '_chk" value="1"'
									. ( 1 == $field['val'] ? ' checked="checked"' : '' )
									. ' />'
							. esc_html( $field['title'] )
						. '</label>';
			} elseif ( in_array( $field['type'], array( 'switch', 'radio' ) ) ) {
				// Type 'switch' (2 choises) or 'radio' (3+ choises)
				$field['options'] = apply_filters( 'gutentype_filter_options_get_list_choises', $field['options'], $name );
				$first            = true;
				foreach ( $field['options'] as $k => $v ) {
					$output .= '<label class="gutentype_options_item_label">'
								. '<input type="radio" name="gutentype_options_field_' . esc_attr( $name ) . '"'
										. ' value="' . esc_attr( $k ) . '"'
										. ( ( '#' . $field['val'] ) == ( '#' . $k ) || ( $first && ! isset( $field['options'][ $field['val'] ] ) ) ? ' checked="checked"' : '' )
										. ' />'
								. esc_html( $v )
							. '</label>';
					$first   = false;
				}
			} elseif ( in_array( $field['type'], array( 'text', 'time', 'date' ) ) ) {
				// Type 'text' or 'time' or 'date'
				$output .= '<input type="text" name="gutentype_options_field_' . esc_attr( $name ) . '"'
								. ' value="' . esc_attr( gutentype_is_inherit( $field['val'] ) ? '' : $field['val'] ) . '"'
								. ' />';
			} elseif ( 'textarea' == $field['type'] ) {
				// Type 'textarea'
				$output .= '<textarea name="gutentype_options_field_' . esc_attr( $name ) . '">'
								. esc_html( gutentype_is_inherit( $field['val'] ) ? '' : $field['val'] )
							. '</textarea>';
			} elseif ( 'text_editor' == $field['type'] ) {
				// Type 'text_editor'
				$output .= '<input type="hidden" id="gutentype_options_field_' . esc_attr( $name ) . '"'
								. ' name="gutentype_options_field_' . esc_attr( $name ) . '"'
								. ' value="' . esc_textarea( gutentype_is_inherit( $field['val'] ) ? '' : $field['val'] ) . '"'
								. ' />'
							. gutentype_show_custom_field(
								'gutentype_options_field_' . esc_attr( $name ) . '_tinymce',
								$field,
								gutentype_is_inherit( $field['val'] ) ? '' : $field['val']
							);
			} elseif ( 'select' == $field['type'] ) {
				// Type 'select'
				$field['options'] = apply_filters( 'gutentype_filter_options_get_list_choises', $field['options'], $name );
				$output          .= '<select size="1" name="gutentype_options_field_' . esc_attr( $name ) . '">';
				foreach ( $field['options'] as $k => $v ) {
					$output .= '<option value="' . esc_attr( $k ) . '"' . ( ( '#' . $field['val'] ) == ( '#' . $k ) ? ' selected="selected"' : '' ) . '>' . esc_html( $v ) . '</option>';
				}
				$output .= '</select>';
			} elseif ( in_array( $field['type'], array( 'image', 'media', 'video', 'audio' ) ) ) {
				// Type 'image', 'media', 'video' or 'audio'
				if ( (int) $field['val'] > 0 ) {
					$image        = wp_get_attachment_image_src( $field['val'], 'full' );
					$field['val'] = $image[0];
				}
				$output .= ( ! empty( $field['multiple'] )
							? '<input type="hidden" id="gutentype_options_field_' . esc_attr( $name ) . '"'
								. ' name="gutentype_options_field_' . esc_attr( $name ) . '"'
								. ' value="' . esc_attr( gutentype_is_inherit( $field['val'] ) ? '' : $field['val'] ) . '"'
								. ' />'
							: '<input type="text" id="gutentype_options_field_' . esc_attr( $name ) . '"'
								. ' name="gutentype_options_field_' . esc_attr( $name ) . '"'
								. ' value="' . esc_attr( gutentype_is_inherit( $field['val'] ) ? '' : $field['val'] ) . '"'
								. ' />' )
						. gutentype_show_custom_field(
							'gutentype_options_field_' . esc_attr( $name ) . '_button',
							array(
								'type'            => 'mediamanager',
								'multiple'        => ! empty( $field['multiple'] ),
								'data_type'       => $field['type'],
								'linked_field_id' => 'gutentype_options_field_' . esc_attr( $name ),
							),
							gutentype_is_inherit( $field['val'] ) ? '' : $field['val']
						);
			} elseif ( 'color' == $field['type'] ) {
				// Type 'color'
				$output .= '<input type="text" id="gutentype_options_field_' . esc_attr( $name ) . '"'
								. ' class="gutentype_color_selector"'
								. ' name="gutentype_options_field_' . esc_attr( $name ) . '"'
								. ' value="' . esc_attr( $field['val'] ) . '"'
								. ' />';
			} elseif ( 'icon' == $field['type'] ) {
				// Type 'icon'
				$output .= '<input type="text" id="gutentype_options_field_' . esc_attr( $name ) . '"'
								. ' name="gutentype_options_field_' . esc_attr( $name ) . '"'
								. ' value="' . esc_attr( gutentype_is_inherit( $field['val'] ) ? '' : $field['val'] ) . '"'
								. ' />'
							. gutentype_show_custom_field(
								'gutentype_options_field_' . esc_attr( $name ) . '_button',
								array(
									'type'   => 'icons',
									'button' => true,
									'icons'  => true,
								),
								gutentype_is_inherit( $field['val'] ) ? '' : $field['val']
							);
			} elseif ( 'checklist' == $field['type'] ) {
				// Type 'checklist'

				if ( $name === 'parent_cat' ) {
					$field['options'] = apply_filters( 'gutentype_filter_options_get_list_choises', $field['options'], $name );
					$field['val'] = is_numeric( $field['val'] ) ? $field['val'] . '=1' : $field['val'];
				}

				$output .= '<input type="hidden" id="gutentype_options_field_' . esc_attr( $name ) . '"'
								. ' name="gutentype_options_field_' . esc_attr( $name ) . '"'
								. ' value="' . esc_attr( gutentype_is_inherit( $field['val'] ) ? '' : $field['val'] ) . '"'
								. ' />'
							. gutentype_show_custom_field(
								'gutentype_options_field_' . esc_attr( $name ) . '_list',
								$field,
								gutentype_is_inherit( $field['val'] ) ? '' : $field['val']
							);
			} elseif ( 'scheme_editor' == $field['type'] ) {
				// Type 'scheme_editor'
				$output .= '<input type="hidden" id="gutentype_options_field_' . esc_attr( $name ) . '"'
								. ' name="gutentype_options_field_' . esc_attr( $name ) . '"'
								. ' value="' . esc_attr( gutentype_is_inherit( $field['val'] ) ? '' : $field['val'] ) . '"'
								. ' />'
							. gutentype_show_custom_field(
								'gutentype_options_field_' . esc_attr( $name ) . '_scheme',
								$field,
								gutentype_unserialize( $field['val'] )
							);
			} elseif ( in_array( $field['type'], array( 'slider', 'range' ) ) ) {
				// Type 'slider' || 'range'
				$field['show_value'] = ! isset( $field['show_value'] ) || $field['show_value'];
				$output             .= '<input type="' . ( ! $field['show_value'] ? 'hidden' : 'text' ) . '" id="gutentype_options_field_' . esc_attr( $name ) . '"'
								. ' name="gutentype_options_field_' . esc_attr( $name ) . '"'
								. ' value="' . esc_attr( gutentype_is_inherit( $field['val'] ) ? '' : $field['val'] ) . '"'
								. ( $field['show_value'] ? ' class="gutentype_range_slider_value"' : '' )
								. ' />'
							. gutentype_show_custom_field(
								'gutentype_options_field_' . esc_attr( $name ) . '_slider',
								$field,
								gutentype_is_inherit( $field['val'] ) ? '' : $field['val']
							);
			}

			$output .= ( $inherit_allow
							? '<div class="gutentype_options_inherit_cover' . ( ! $inherit_state ? ' gutentype_hidden' : '' ) . '">'
								. '<span class="gutentype_options_inherit_label">' . esc_html__( 'Inherit', 'gutentype' ) . '</span>'
								. '<input type="hidden" name="gutentype_options_inherit_' . esc_attr( $name ) . '"'
										. ' value="' . esc_attr( $inherit_state ? 'inherit' : '' ) . '"'
										. ' />'
								. '</div>'
							: '' )
						. ( $field_data_present ? '</div>' : '' )
						. ( ! empty( $field['override']['desc'] ) || ! empty( $field['desc'] )
							? '<div class="gutentype_options_item_description">'
								. ( ! empty( $field['override']['desc'] )   // param 'desc' already processed with wp_kses()!
										? $field['override']['desc']
										: $field['desc'] )
								. '</div>'
							: '' )
					. ( $field_data_present ? '</div>' : '' )
				. '</div>';
		}
		return $output;
	}
}


// Show theme specific fields
function gutentype_show_custom_field( $id, $field, $value ) {
	$output = '';

	switch ( $field['type'] ) {

		case 'mediamanager':
			wp_enqueue_media();
			$title   = empty( $field['data_type'] ) || 'image' == $field['data_type']
							? esc_html__( 'Choose Image', 'gutentype' )
							: esc_html__( 'Choose Media', 'gutentype' );
			$output .= '<input type="button"'
							. ' id="' . esc_attr( $id ) . '"'
							. ' class="button mediamanager gutentype_media_selector"'
							. '	data-param="' . esc_attr( $id ) . '"'
							. '	data-choose="' . esc_attr( ! empty( $field['multiple'] ) ? esc_html__( 'Choose Images', 'gutentype' ) : $title ) . '"'
							. ' data-update="' . esc_attr( ! empty( $field['multiple'] ) ? esc_html__( 'Add to Gallery', 'gutentype' ) : $title ) . '"'
							. '	data-multiple="' . esc_attr( ! empty( $field['multiple'] ) ? '1' : '0' ) . '"'
							. '	data-type="' . esc_attr( ! empty( $field['data_type'] ) ? $field['data_type'] : 'image' ) . '"'
							. '	data-linked-field="' . esc_attr( $field['linked_field_id'] ) . '"'
							. ' value="'
								. ( ! empty( $field['multiple'] )
										? ( empty( $field['data_type'] ) || 'image' == $field['data_type']
											? esc_html__( 'Add Images', 'gutentype' )
											: esc_html__( 'Add Files', 'gutentype' )
											)
										: esc_html( $title )
									)
								. '"'
							. '>';
			$output .= '<span class="gutentype_options_field_preview">';
			$images  = explode( '|', $value );
			if ( is_array( $images ) ) {
				foreach ( $images as $img ) {
					$output .= $img && ! gutentype_is_inherit( $img )
							? '<span>'
									. ( in_array( gutentype_get_file_ext( $img ), array( 'gif', 'jpg', 'jpeg', 'png' ) )
											? '<img src="' . esc_url( $img ) . '" alt="' . esc_attr__( 'Selected image', 'gutentype' ) . '">'
											: '<a href="' . esc_attr( $img ) . '">' . esc_html( basename( $img ) ) . '</a>'
										)
								. '</span>'
							: '';
				}
			}
			$output .= '</span>';
			break;

		case 'icons':
			$icons_type = ! empty( $field['style'] )
							? $field['style']
							: gutentype_get_theme_setting( 'icons_type' );
			if ( empty( $field['return'] ) ) {
				$field['return'] = 'full';
			}
			$gutentype_icons = gutentype_get_list_icons( $icons_type );
			if ( is_array( $gutentype_icons ) ) {
				if ( ! empty( $field['button'] ) ) {
					$output .= '<span id="' . esc_attr( $id ) . '"'
									. ' class="gutentype_list_icons_selector'
											. ( 'icons' == $icons_type && ! empty( $value ) ? ' ' . esc_attr( $value ) : '' )
											. '"'
									. ' title="' . esc_attr__( 'Select icon', 'gutentype' ) . '"'
									. ' data-style="' . esc_attr( $icons_type ) . '"'
									. ( in_array( $icons_type, array( 'images', 'svg' ) ) && ! empty( $value )
										? ' style="background-image: url(' . esc_url( 'slug' == $field['return'] ? $gutentype_icons[ $value ] : $value ) . ');"'
										: ''
										)
								. '></span>';
				}
				if ( ! empty( $field['icons'] ) ) {
					$output .= '<div class="gutentype_list_icons">'
								. '<input type="text" class="gutentype_list_icons_search" placeholder="' . esc_attr__( 'Search icon ...', 'gutentype' ) . '">';
					foreach ( $gutentype_icons as $slug => $icon ) {
						$output .= '<span class="' . esc_attr( 'icons' == $icons_type ? $icon : $slug )
								. ( ( 'full' == $field['return'] ? $icon : $slug ) == $value ? ' gutentype_list_active' : '' )
								. '"'
								. ' title="' . esc_attr( $slug ) . '"'
								. ' data-icon="' . esc_attr( 'full' == $field['return'] ? $icon : $slug ) . '"'
								. ( in_array( $icons_type, array( 'images', 'svg' ) ) ? ' style="background-image: url(' . esc_url( $icon ) . ');"' : '' )
								. '></span>';
					}
					$output .= '</div>';
				}
			}
			break;

		case 'checklist':
			if ( ! empty( $field['sortable'] ) ) {
				wp_enqueue_script( 'jquery-ui-sortable', false, array( 'jquery', 'jquery-ui-core' ), null, true );
			}
			$output .= '<div class="gutentype_checklist gutentype_checklist_' . esc_attr( $field['dir'] )
						. ( ! empty( $field['sortable'] ) ? ' gutentype_sortable' : '' )
						. '">';
			if ( ! is_array( $value ) ) {
				if ( ! empty( $value ) && ! gutentype_is_inherit( $value ) ) {
					parse_str( str_replace( '|', '&', $value ), $value );
				} else {
					$value = array();
				}
			}
			// Sort options by values order
			if ( ! empty( $field['sortable'] ) && is_array( $value ) ) {
				$field['options'] = gutentype_array_merge( $value, $field['options'] );
			}
			foreach ( $field['options'] as $k => $v ) {
				$output .= '<label class="gutentype_checklist_item_label'
								. ( ! empty( $field['sortable'] ) ? ' gutentype_sortable_item' : '' )
								. '">'
							. '<input type="checkbox" value="1" data-name="' . $k . '"'
								. ( isset( $value[ $k ] ) && 1 == (int) $value[ $k ] ? ' checked="checked"' : '' )
								. ' />'
							. ( substr( $v, 0, 4 ) == 'http' ? '<img src="' . esc_url( $v ) . '">' : esc_html( $v ) )
						. '</label>';
			}
			$output .= '</div>';
			break;

		case 'slider':
		case 'range':
			wp_enqueue_script( 'jquery-ui-slider', false, array( 'jquery', 'jquery-ui-core' ), null, true );
			$is_range   = 'range' == $field['type'];
			$field_min  = ! empty( $field['min'] ) ? $field['min'] : 0;
			$field_max  = ! empty( $field['max'] ) ? $field['max'] : 100;
			$field_step = ! empty( $field['step'] ) ? $field['step'] : 1;
			$field_val  = ! empty( $value )
							? ( $value . ( $is_range && strpos( $value, ',' ) === false ? ',' . $field_max : '' ) )
							: ( $is_range ? $field_min . ',' . $field_max : $field_min );
			$output    .= '<div id="' . esc_attr( $id ) . '"'
							. ' class="gutentype_range_slider"'
							. ' data-range="' . esc_attr( $is_range ? 'true' : 'min' ) . '"'
							. ' data-min="' . esc_attr( $field_min ) . '"'
							. ' data-max="' . esc_attr( $field_max ) . '"'
							. ' data-step="' . esc_attr( $field_step ) . '"'
							. '>'
							. '<span class="gutentype_range_slider_label gutentype_range_slider_label_min">'
								. esc_html( $field_min )
							. '</span>'
							. '<span class="gutentype_range_slider_label gutentype_range_slider_label_max">'
								. esc_html( $field_max )
							. '</span>';
			$values     = explode( ',', $field_val );
			for ( $i = 0; $i < count( $values ); $i++ ) {
				$output .= '<span class="gutentype_range_slider_label gutentype_range_slider_label_cur">'
								. esc_html( $values[ $i ] )
							. '</span>';
			}
			$output .= '</div>';
			break;

		case 'text_editor':
			if ( function_exists( 'wp_enqueue_editor' ) ) {
				wp_enqueue_editor();
			}
			ob_start();
			wp_editor(
				$value, $id, array(
					'default_editor' => 'tmce',
					'wpautop'        => isset( $field['wpautop'] ) ? $field['wpautop'] : false,
					'teeny'          => isset( $field['teeny'] ) ? $field['teeny'] : false,
					'textarea_rows'  => isset( $field['rows'] ) && $field['rows'] > 1 ? $field['rows'] : 10,
					'editor_height'  => 16 * ( isset( $field['rows'] ) && $field['rows'] > 1 ? (int) $field['rows'] : 10 ),
					'tinymce'        => array(
						'resize'             => false,
						'wp_autoresize_on'   => false,
						'add_unload_trigger' => false,
					),
				)
			);
			$editor_html = ob_get_contents();
			ob_end_clean();
			$output .= '<div class="gutentype_text_editor">' . $editor_html . '</div>';
			break;

		case 'scheme_editor':
			if ( ! is_array( $value ) ) {
				break;
			}
			if ( empty( $field['colorpicker'] ) ) {
				$field['colorpicker'] = 'internal';
			}
			$output .= '<div class="gutentype_scheme_editor">';
			// Select scheme
			$output .= '<div class="gutentype_scheme_editor_scheme">'
							. '<select class="gutentype_scheme_editor_selector">';
			foreach ( $value as $scheme => $v ) {
				$output .= '<option value="' . esc_attr( $scheme ) . '">' . esc_html( $v['title'] ) . '</option>';
			}
			$output .= '</select>';
			// Scheme controls
			$output .= '<span class="gutentype_scheme_editor_controls">'
							. '<span class="gutentype_scheme_editor_control gutentype_scheme_editor_control_reset" title="' . esc_attr__( 'Reload scheme', 'gutentype' ) . '"></span>'
							. '<span class="gutentype_scheme_editor_control gutentype_scheme_editor_control_copy" title="' . esc_attr__( 'Duplicate scheme', 'gutentype' ) . '"></span>'
							. '<span class="gutentype_scheme_editor_control gutentype_scheme_editor_control_delete" title="' . esc_attr__( 'Delete scheme', 'gutentype' ) . '"></span>'
						. '</span>'
					. '</div>';
			// Select type
			$output .= '<div class="gutentype_scheme_editor_type">'
							. '<div class="gutentype_scheme_editor_row">'
								. '<span class="gutentype_scheme_editor_row_cell">'
									. esc_html__( 'Editor type', 'gutentype' )
								. '</span>'
								. '<span class="gutentype_scheme_editor_row_cell gutentype_scheme_editor_row_cell_span">'
									. '<label>'
										. '<input name="gutentype_scheme_editor_type" type="radio" value="simple" checked="checked"> '
										. esc_html__( 'Simple', 'gutentype' )
									. '</label>'
									. '<label>'
										. '<input name="gutentype_scheme_editor_type" type="radio" value="advanced"> '
										. esc_html__( 'Advanced', 'gutentype' )
									. '</label>'
								. '</span>'
							. '</div>'
						. '</div>';
			// Colors
			$groups  = gutentype_storage_get( 'scheme_color_groups' );
			$colors  = gutentype_storage_get( 'scheme_color_names' );
			$output .= '<div class="gutentype_scheme_editor_colors">';
			foreach ( $value as $scheme => $v ) {
				$output .= '<div class="gutentype_scheme_editor_header">'
								. '<span class="gutentype_scheme_editor_header_cell"></span>';
				foreach ( $groups as $group_name => $group_data ) {
					$output .= '<span class="gutentype_scheme_editor_header_cell" title="' . esc_attr( $group_data['description'] ) . '">'
								. esc_html( $group_data['title'] )
								. '</span>';
				}
				$output .= '</div>';
				foreach ( $colors as $color_name => $color_data ) {
					$output .= '<div class="gutentype_scheme_editor_row">'
								. '<span class="gutentype_scheme_editor_row_cell" title="' . esc_attr( $color_data['description'] ) . '">'
								. esc_html( $color_data['title'] )
								. '</span>';
					foreach ( $groups as $group_name => $group_data ) {
						$slug    = 'main' == $group_name
									? $color_name
									: str_replace( 'text_', '', "{$group_name}_{$color_name}" );
						$output .= '<span class="gutentype_scheme_editor_row_cell">'
									. ( isset( $v['colors'][ $slug ] )
										? "<input type=\"text\" name=\"{$slug}\" class=\"" . ( 'tiny' == $field['colorpicker'] ? 'tinyColorPicker' : 'iColorPicker' ) . '" value="' . esc_attr( $v['colors'][ $slug ] ) . '">'
										: ''
										)
									. '</span>';
					}
					$output .= '</div>';
				}
				break;
			}
			$output .= '</div>'
					. '</div>';
			break;
	}
	return apply_filters( 'gutentype_filter_show_custom_field', $output, $id, $field, $value );
}


// Refresh data in the linked field
// according the main field value
if ( ! function_exists( 'gutentype_refresh_linked_data' ) ) {
	function gutentype_refresh_linked_data( $value, $linked_name ) {
		if ( 'parent_cat' == $linked_name ) {
			$tax   = gutentype_get_post_type_taxonomy( $value );
			$terms = ! empty( $tax ) ? gutentype_get_list_terms( false, $tax ) : array();
			$terms = gutentype_array_merge( array( 0 => esc_html__( '- Select category -', 'gutentype' ) ), $terms );
			gutentype_storage_set_array2( 'options', $linked_name, 'options', $terms );
		}
	}
}


// AJAX: Refresh data in the linked fields
if ( ! function_exists( 'gutentype_callback_get_linked_data' ) ) {
	add_action( 'wp_ajax_gutentype_get_linked_data', 'gutentype_callback_get_linked_data' );
	add_action( 'wp_ajax_nopriv_gutentype_get_linked_data', 'gutentype_callback_get_linked_data' );
	function gutentype_callback_get_linked_data() {
		if ( ! wp_verify_nonce( gutentype_get_value_gp( 'nonce' ), admin_url( 'admin-ajax.php' ) ) ) {
			wp_die();
		}
		$chg_name  = wp_kses_data( wp_unslash( $_REQUEST['chg_name'] ) );
		$chg_value = wp_kses_data( wp_unslash( $_REQUEST['chg_value'] ) );
		$response  = array( 'error' => '' );
		if ( 'post_type' == $chg_name ) {
			$tax              = gutentype_get_post_type_taxonomy( $chg_value );
			$terms            = ! empty( $tax ) ? gutentype_get_list_terms( false, $tax ) : array();
			$response['list'] = gutentype_array_merge( array( 0 => esc_html__( '- Select category -', 'gutentype' ) ), $terms );
		}
		echo json_encode( $response );
		wp_die();
	}
}
