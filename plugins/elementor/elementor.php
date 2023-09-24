<?php
/* Elementor Builder support functions
------------------------------------------------------------------------------- */

// Theme init priorities:
// 9 - register other filters (for installer, etc.)
if ( ! function_exists( 'gutentype_elm_theme_setup9' ) ) {
	add_action( 'after_setup_theme', 'gutentype_elm_theme_setup9', 9 );
	function gutentype_elm_theme_setup9() {
	

		add_filter( 'gutentype_filter_merge_styles', 'gutentype_elm_merge_styles' );
		add_filter( 'gutentype_filter_merge_styles_responsive', 'gutentype_elm_merge_styles_responsive' );
		add_action( 'elementor/editor/before_enqueue_scripts', 'gutentype_elm_editor_scripts' );

		if ( is_admin() ) {
			add_filter( 'gutentype_filter_tgmpa_required_plugins', 'gutentype_elm_tgmpa_required_plugins' );
		
		}
	}
}



// Filter to add in the required plugins list
if ( ! function_exists( 'gutentype_elm_tgmpa_required_plugins' ) ) {
	//Handler of the add_filter('gutentype_filter_tgmpa_required_plugins',	'gutentype_elm_tgmpa_required_plugins');
	function gutentype_elm_tgmpa_required_plugins( $list = array() ) {
		if ( gutentype_storage_isset( 'required_plugins', 'elementor' ) && gutentype_storage_get_array( 'required_plugins', 'elementor', 'install' ) !== false ) {
			$list[] = array(
				'name'     => gutentype_storage_get_array( 'required_plugins', 'elementor' ),
				'slug'     => 'elementor',
				'required' => false,
			);
		}
		return $list;
	}
}

// Check if Elementor is installed and activated
if ( ! function_exists( 'gutentype_exists_elementor' ) ) {
	function gutentype_exists_elementor() {
		return class_exists( 'Elementor\Plugin' );
	}
}

// Merge custom styles
if ( ! function_exists( 'gutentype_elm_merge_styles' ) ) {
    function gutentype_elm_merge_styles( $list ) {
		if ( gutentype_exists_elementor() ) {
			$list[] = 'plugins/elementor/elementor.scss';	
		}
        return $list;
    }
}

// Merge responsive styles
if ( ! function_exists( 'gutentype_elm_merge_styles_responsive' ) ) {
	//Handler of the add_filter('gutentype_filter_merge_styles_responsive', 'gutentype_elm_merge_styles_responsive');
	function gutentype_elm_merge_styles_responsive( $list ) {
		if ( gutentype_exists_elementor() ) {
			$list[] = 'plugins/elementor/elementor-responsive.scss';	
		}
		return $list;
	}
}

// Enqueue styles for frontend
if ( ! function_exists( 'gutentype_elm_frontend_scripts' ) ) {

    function gutentype_elm_frontend_scripts() {
        if ( gutentype_is_on( gutentype_get_theme_option( 'debug_mode' ) ) ) {
            $gutentype_url = gutentype_get_file_dir( 'plugins/elementor/elementor.css' );
            if ( '' != $gutentype_url ) {
                wp_enqueue_style( 'gutentype-delivery-date', $gutentype_url, array(), null );
            }
        }
    }
}


// Enqueue responsive styles for frontend
if ( ! function_exists( 'gutentype_elm_responsive_styles' ) ) {
	//Handler of the add_action( 'wp_enqueue_scripts', 'gutentype_elm_responsive_styles', 2000 );
	function gutentype_elm_responsive_styles() {
		if ( gutentype_is_on( gutentype_get_theme_option( 'debug_mode' ) ) ) {
			$gutentype_url = gutentype_get_file_url( 'plugins/elementor/elementor-responsive.css' );
			if ( '' != $gutentype_url ) {
				wp_enqueue_style( 'gutentype-elementor-responsive', $gutentype_url, array(), null );
			}
		}
	}
}

// Load required styles and scripts for Elementor Editor mode
if ( ! function_exists( 'gutentype_elm_editor_scripts' ) ) {
	//Handler of the add_action( 'elementor/editor/before_enqueue_scripts',	'gutentype_elm_editor_scripts');
	function gutentype_elm_editor_scripts() {
		// Load font icons
		wp_enqueue_style( 'gutentype-icons', gutentype_get_file_url( 'css/font-icons/css/fontello.css' ), array(), null );
	}
}


// Add/Remove params to the existings sections: use templates as Tab content
if (!function_exists('gutentype_elm_add_params_new_set')) {
	add_action( 'elementor/element/before_section_end', 'gutentype_elm_add_params_new_set', 10, 3 );
	function gutentype_elm_add_params_new_set($element, $section_id, $args) {

		if ( ! is_object($element) ) return;
		$el_name = $element->get_name();

		if ( 'trx_sc_blogger' == $el_name && 'section_sc_blogger' === $section_id ) {
			
			$element->update_control(
                'columns', array(
                    'condition' => [
                        'type' => ['default', 'modern', 'standard', 'classic', 'masonry', 'portrolio', 'gallery', 'divide']
                    ],
                )
            );

		}
	}
}