<?php
/**
 * Setup theme-specific fonts and colors
 *
 * @package WordPress
 * @subpackage GUTENTYPE
 * @since GUTENTYPE 1.0.22
 */

// If this theme is a free version of premium theme
if ( ! defined( 'GUTENTYPE_THEME_FREE' ) ) {
	define( 'GUTENTYPE_THEME_FREE', false );
}
if ( ! defined( 'GUTENTYPE_THEME_FREE_WP' ) ) {
	define( 'GUTENTYPE_THEME_FREE_WP', false );
}

// If this theme uses multiple skins
if ( ! defined( 'GUTENTYPE_ALLOW_SKINS' ) ) {
	define( 'GUTENTYPE_ALLOW_SKINS', false );
}
if ( ! defined( 'GUTENTYPE_DEFAULT_SKIN' ) ) {
	define( 'GUTENTYPE_DEFAULT_SKIN', 'default' );
}

// Theme storage
// Attention! Must be in the global namespace to compatibility with WP CLI
$GLOBALS['GUTENTYPE_STORAGE'] = array(

	// Theme required plugin's slugs
	'required_plugins'   => array_merge(

		// List of plugins for both - FREE and PREMIUM versions
		//-----------------------------------------------------
		array(
			// Required plugins
			// DON'T COMMENT OR REMOVE NEXT LINES!
			'trx_addons'         => esc_html__( 'ThemeREX Addons', 'gutentype' ),
			'elementor'         => esc_html__( 'Elementor', 'gutentype' ),
			'gmasonry-related-posts'         => esc_html__( 'Grid Masonry Related Posts', 'gutentype' ),

			// Recommended (supported) plugins for both (lite and full) versions
			// If plugin not need - comment (or remove) it
			'gutenberg'          => esc_html__( 'Gutenberg', 'gutentype' ),
			'waspthemes-yellow-pencil'          => esc_html__( 'Yellow Pencil', 'gutentype' ),
			'contact-form-7'     => esc_html__( 'Contact Form 7', 'gutentype' ),
			'instagram-feed'     => esc_html__( 'Instagram Feed', 'gutentype' ),
			'mailchimp-for-wp'   => esc_html__( 'MailChimp for WP', 'gutentype' ),
			'elegro-payment'     => esc_html__( 'elegro Crypto Payment', 'gutentype' ),
			'trx_updater'     	 => esc_html__( 'TRX Updater', 'gutentype' ),

		),
		// List of plugins for the FREE version only
		//-----------------------------------------------------
		GUTENTYPE_THEME_FREE
			? array(
			)

		// List of plugins for the PREMIUM version only
		//-----------------------------------------------------
			: array(
				// Recommended (supported) plugins for the PRO (full) version
				// If plugin not need - comment (or remove) it
                'woocommerce'                => esc_html__( 'WooCommerce', 'gutentype' ),
			)
	),

	// Theme-specific blog layouts
	'blog_styles'        => array_merge(
		// Layouts for both - FREE and PREMIUM versions
		//-----------------------------------------------------
		array(
			'excerpt' => array(
				'title'   => esc_html__( 'Standard', 'gutentype' ),
				'archive' => 'index-excerpt',
				'item'    => 'content-excerpt',
				'styles'  => 'excerpt',
			),
			'classic' => array(
				'title'   => esc_html__( 'Classic', 'gutentype' ),
				'archive' => 'index-classic',
				'item'    => 'content-classic',
				'columns' => array( 2, 3 ),
				'styles'  => 'classic',
			),
		),
		// Layouts for the FREE version only
		//-----------------------------------------------------
		GUTENTYPE_THEME_FREE
		? array()

		// Layouts for the PREMIUM version only
		//-----------------------------------------------------
		: array(
			'masonry'   => array(
				'title'   => esc_html__( 'Masonry', 'gutentype' ),
				'archive' => 'index-classic',
				'item'    => 'content-classic',
				'columns' => array( 2, 3 ),
				'styles'  => 'masonry',
			),
			'portfolio' => array(
				'title'   => esc_html__( 'Portfolio', 'gutentype' ),
				'archive' => 'index-portfolio',
				'item'    => 'content-portfolio',
				'columns' => array( 2, 3, 4 ),
				'styles'  => 'portfolio',
			),
			'gallery'   => array(
				'title'   => esc_html__( 'Gallery', 'gutentype' ),
				'archive' => 'index-portfolio',
				'item'    => 'content-portfolio-gallery',
				'columns' => array( 2, 3, 4 ),
				'styles'  => array( 'portfolio', 'gallery' ),
			),
            'extra'     => array(
                'title'   => esc_html__( 'Extra', 'gutentype' ),
                'archive' => 'index-extra',
                'item'    => 'content-extra',
                'styles'  => 'extra',
            ),
            'plain'     => array(
                'title'   => esc_html__( 'Plain', 'gutentype' ),
                'archive' => 'index-plain',
                'item'    => 'content-plain',
                'styles'  => 'plain',
            ),
            'simple'     => array(
                'title'   => esc_html__( 'Simple', 'gutentype' ),
                'archive' => 'index-simple',
                'item'    => 'content-simple',
                'styles'  => 'simple',
            ),
            'divide'     => array(
                'title'   => esc_html__( 'Divide', 'gutentype' ),
                'archive' => 'index-divide',
                'item'    => 'content-divide',
                'styles'  => 'divide',
            ),
            'split'     => array(
                'title'   => esc_html__( 'Split', 'gutentype' ),
                'archive' => 'index-split',
                'item'    => 'content-split',
                'styles'  => 'split',
            ),
            'light'     => array(
                'title'   => esc_html__( 'Light', 'gutentype' ),
                'archive' => 'index-light',
                'item'    => 'content-light',
                'styles'  => 'light',
            ),
            'train'     => array(
                'title'   => esc_html__( 'Train', 'gutentype' ),
                'archive' => 'index-train',
                'item'    => 'content-train',
                'styles'  => 'train',
            ),
		)
	),

	// Key validator: market[env|loc]-vendor[axiom|ancora|themerex]
	'theme_pro_key'      => 'env-ancora',

	// Theme-specific URLs (will be escaped in place of the output)
	'theme_demo_url'     => 'http://gutentype.ancorathemes.com',
	'theme_doc_url'      => 'http://gutentype.ancorathemes.com/doc',
	'theme_download_url' => 'https://themeforest.net/item/gutentype-gutenberg-wordpress-blog-theme/22486033',

    'theme_support_url'  => 'https://themerex.net/support/',                    // Ancora

    'theme_video_url'    => 'https://www.youtube.com/channel/UCdIjRh7-lPVHqTTKpaf8PLA',  // Ancora

	// Comma separated slugs of theme-specific categories (for get relevant news in the dashboard widget)
	// (i.e. 'children,kindergarten')
	'theme_categories'   => '',

	// Responsive resolutions
	// Parameters to create css media query: min, max
	'responsive'         => array(
		// By device
		'desktop'  => array( 'min' => 1680 ),
		'notebook' => array(
			'min' => 1280,
			'max' => 1679,
		),
		'tablet'   => array(
			'min' => 768,
			'max' => 1279,
		),
		'mobile'   => array( 'max' => 767 ),
		// By size
		'xxl'      => array( 'max' => 1679 ),
		'xl'       => array( 'max' => 1439 ),
		'lg'       => array( 'max' => 1279 ),
		'md'       => array( 'max' => 1023 ),
		'sm'       => array( 'max' => 767 ),
		'sm_wp'    => array( 'max' => 600 ),
		'xs'       => array( 'max' => 479 ),
	),
);

// Theme init priorities:
// Action 'after_setup_theme'
// 1 - register filters to add/remove lists items in the Theme Options
// 2 - create Theme Options
// 3 - add/remove Theme Options elements
// 5 - load Theme Options. Attention! After this step you can use only basic options (not overriden)
// 9 - register other filters (for installer, etc.)
//10 - standard Theme init procedures (not ordered)
// Action 'wp_loaded'
// 1 - detect override mode. Attention! Only after this step you can use overriden options (separate values for the shop, courses, etc.)

if ( ! function_exists( 'gutentype_customizer_theme_setup1' ) ) {
	add_action( 'after_setup_theme', 'gutentype_customizer_theme_setup1', 1 );
	function gutentype_customizer_theme_setup1() {

		// -----------------------------------------------------------------
		// -- ONLY FOR PROGRAMMERS, NOT FOR CUSTOMER
		// -- Internal theme settings
		// -----------------------------------------------------------------
		gutentype_storage_set(
			'settings', array(

				'duplicate_options'      => 'child',            // none  - use separate options for the main and the child-theme
																// child - duplicate theme options from the main theme to the child-theme only
																// both  - sinchronize changes in the theme options between main and child themes

				'customize_refresh'      => 'auto',             // Refresh method for preview area in the Appearance - Customize:
																// auto - refresh preview area on change each field with Theme Options
																// manual - refresh only obn press button 'Refresh' at the top of Customize frame

				'max_load_fonts'         => 5,                  // Max fonts number to load from Google fonts or from uploaded fonts

				'comment_after_name'     => true,               // Place 'comment' field after the 'name' and 'email'

				'icons_selector'         => 'internal',         // Icons selector in the shortcodes:
																// vc (default) - standard VC (very slow) or Elementor's icons selector (not support images and svg)
																// internal - internal popup with plugin's or theme's icons list (fast and support images and svg)

				'icons_type'             => 'icons',            // Type of icons (if 'icons_selector' is 'internal'):
																// icons  - use font icons to present icons
																// images - use images from theme's folder trx_addons/css/icons.png
																// svg    - use svg from theme's folder trx_addons/css/icons.svg

				'socials_type'           => 'icons',            // Type of socials icons (if 'icons_selector' is 'internal'):
																// icons  - use font icons to present social networks
																// images - use images from theme's folder trx_addons/css/icons.png
																// svg    - use svg from theme's folder trx_addons/css/icons.svg

				'check_min_version'      => true,               // Check if exists a .min version of .css and .js and return path to it
																// instead the path to the original file
																// (if debug_mode is off and modification time of the original file < time of the .min file)

				'autoselect_menu'        => false,              // Show any menu if no menu selected in the location 'main_menu'
																// (for example, the theme is just activated)

				'disable_jquery_ui'      => false,              // Prevent loading custom jQuery UI libraries in the third-party plugins

				'use_mediaelements'      => true,               // Load script "Media Elements" to play video and audio

				'tgmpa_upload'           => false,              // Allow upload not pre-packaged plugins via TGMPA

				'allow_no_image'         => false,              // Allow use image placeholder if no image present in the blog, related posts, post navigation, etc.

				'separate_schemes'       => true,               // Save color schemes to the separate files __color_xxx.css (true) or append its to the __custom.css (false)

				'allow_fullscreen'       => false,              // Allow cases 'fullscreen' and 'fullwide' for the body style in the Theme Options
																// In the Page Options this styles are present always
																// (can be removed if filter 'gutentype_filter_allow_fullscreen' return false)

				'attachments_navigation' => false,              // Add arrows on the single attachment page to navigate to the prev/next attachment

				'gutenberg_add_context'  => true,              // Add context to the Gutenberg editor styles with our method (if true - use if any problem with editor styles) or use native Gutenberg way via add_editor_style() (if false - used by default)

				'gutenberg_safe_mode'    => array('elementor'), // vc,elementor - Prevent simultaneous editing of posts for Gutenberg and other PageBuilders (VC, Elementor)
			)
		);

		// -----------------------------------------------------------------
		// -- Theme fonts (Google and/or custom fonts)
		// -----------------------------------------------------------------

		// Fonts to load when theme start
		// It can be Google fonts or uploaded fonts, placed in the folder /css/font-face/font-name inside the theme folder
		// Attention! Font's folder must have name equal to the font's name, with spaces replaced on the dash '-'
		// For example: font name 'TeX Gyre Termes', folder 'TeX-Gyre-Termes'
		gutentype_storage_set(
			'load_fonts', array(
				// Google font
				array(
					'name'   => 'Barlow',
					'family' => 'sans-serif',
					'styles' => '300,300i,400,400i,500,500i,600,600i,700,700i,800',     // Parameter 'style' used only for the Google fonts
				),
                array(
					'name'   => 'Lora',
					'family' => 'serif',
					'styles' => '400,400i,700,700i',     // Parameter 'style' used only for the Google fonts
				),
			)
		);

		// Characters subset for the Google fonts. Available values are: latin,latin-ext,cyrillic,cyrillic-ext,greek,greek-ext,vietnamese
		gutentype_storage_set( 'load_fonts_subset', 'latin,latin-ext' );

		// Settings of the main tags
		// Attention! Font name in the parameter 'font-family' will be enclosed in the quotes and no spaces after comma!

		gutentype_storage_set(
			'theme_fonts', array(
				'p'       => array(
					'title'           => esc_html__( 'Main text', 'gutentype' ),
					'description'     => esc_html__( 'Font settings of the main text of the site. Attention! For correct display of the site on mobile devices, use only units "rem", "em" or "ex"', 'gutentype' ),
					'font-family'     => '"Lora",serif',
					'font-size'       => '1rem',
					'font-weight'     => '400',
					'font-style'      => 'normal',
					'line-height'     => '1.64em',
					'text-decoration' => 'none',
					'text-transform'  => 'none',
					'letter-spacing'  => '0.35px',
					'margin-top'      => '0em',
					'margin-bottom'   => '1.65em',
				),
				'h1'      => array(
					'title'           => esc_html__( 'Heading 1', 'gutentype' ),
                    'font-family'     => '"Barlow",sans-serif',
					'font-size'       => '2.471em',
					'font-weight'     => '700',
					'font-style'      => 'normal',
					'line-height'     => '0.96em',
					'text-decoration' => 'none',
					'text-transform'  => 'none',
					'letter-spacing'  => '0px',
					'margin-top'      => '1.9em',
					'margin-bottom'   => '0.9em',
				),
				'h2'      => array(
					'title'           => esc_html__( 'Heading 2', 'gutentype' ),
                    'font-family'     => '"Barlow",sans-serif',
					'font-size'       => '2.294em',
					'font-weight'     => '600',
					'font-style'      => 'normal',
					'line-height'     => '0.98em',
					'text-decoration' => 'none',
					'text-transform'  => 'none',
					'letter-spacing'  => '-0.75px',
					'margin-top'      => '1.6em',
					'margin-bottom'   => '0.88em',
				),
				'h3'      => array(
					'title'           => esc_html__( 'Heading 3', 'gutentype' ),
                    'font-family'     => '"Barlow",sans-serif',
					'font-size'       => '1.882em',
					'font-weight'     => '600',
					'font-style'      => 'normal',
					'line-height'     => '1.08em',
					'text-decoration' => 'none',
					'text-transform'  => 'none',
					'letter-spacing'  => '-0.67px',
					'margin-top'      => '1.65em',
					'margin-bottom'   => '0.73em',
				),
				'h4'      => array(
					'title'           => esc_html__( 'Heading 4', 'gutentype' ),
                    'font-family'     => '"Barlow",sans-serif',
					'font-size'       => '1.529em',
					'font-weight'     => '600',
					'font-style'      => 'normal',
					'line-height'     => '1.09em',
					'text-decoration' => 'none',
					'text-transform'  => 'none',
					'letter-spacing'  => '0px',
					'margin-top'      => '1.58em',
					'margin-bottom'   => '0.75em',
				),
				'h5'      => array(
					'title'           => esc_html__( 'Heading 5', 'gutentype' ),
                    'font-family'     => '"Barlow",sans-serif',
					'font-size'       => '1.118em',
					'font-weight'     => '600',
					'font-style'      => 'normal',
					'line-height'     => '1.35em',
					'text-decoration' => 'none',
					'text-transform'  => 'none',
					'letter-spacing'  => '0px',
					'margin-top'      => '1.71em',
					'margin-bottom'   => '1.08em',
				),
				'h6'      => array(
					'title'           => esc_html__( 'Heading 6', 'gutentype' ),
                    'font-family'     => '"Barlow",sans-serif',
					'font-size'       => '1em',
					'font-weight'     => '600',
					'font-style'      => 'normal',
					'line-height'     => '1.37em',
					'text-decoration' => 'none',
					'text-transform'  => 'none',
					'letter-spacing'  => '-0.34px',
					'margin-top'      => '1.4706em',
					'margin-bottom'   => '0.69em',
				),
				'logo'    => array(
					'title'           => esc_html__( 'Logo text', 'gutentype' ),
					'description'     => esc_html__( 'Font settings of the text case of the logo', 'gutentype' ),
                    'font-family'     => '"Barlow",sans-serif',
					'font-size'       => '1.8em',
					'font-weight'     => '600',
					'font-style'      => 'normal',
					'line-height'     => '1.25em',
					'text-decoration' => 'none',
					'text-transform'  => 'uppercase',
					'letter-spacing'  => '0.5px',
				),
				'button'  => array(
					'title'           => esc_html__( 'Buttons', 'gutentype' ),
                    'font-family'     => '"Barlow",sans-serif',
					'font-size'       => '17px',
					'font-weight'     => '600',
					'font-style'      => 'normal',
					'line-height'     => '20px',
					'text-decoration' => 'none',
					'text-transform'  => '',
					'letter-spacing'  => '0',
				),
				'input'   => array(
					'title'           => esc_html__( 'Input fields', 'gutentype' ),
					'description'     => esc_html__( 'Font settings of the input fields, dropdowns and textareas', 'gutentype' ),
					'font-family'     => 'inherit',
					'font-size'       => '15px',
					'font-weight'     => '400',
					'font-style'      => 'normal',
					'line-height'     => '1.5em', // Attention! Firefox don't allow line-height less then 1.5em in the select
					'text-decoration' => 'none',
					'text-transform'  => 'none',
					'letter-spacing'  => '0px',
				),
				'info'    => array(
					'title'           => esc_html__( 'Post meta', 'gutentype' ),
					'description'     => esc_html__( 'Font settings of the post meta: date, counters, share, etc.', 'gutentype' ),
                    'font-family'     => '"Barlow",sans-serif',
					'font-size'       => '14px',
					'font-weight'     => '500',
					'font-style'      => 'normal',
					'line-height'     => '1.5em',
					'text-decoration' => 'none',
					'text-transform'  => 'none',
					'letter-spacing'  => '0px',
					'margin-top'      => '0.4em',
					'margin-bottom'   => '',
				),
				'menu'    => array(
					'title'           => esc_html__( 'Main menu', 'gutentype' ),
					'description'     => esc_html__( 'Font settings of the main menu items', 'gutentype' ),
                    'font-family'     => '"Barlow",sans-serif',
					'font-size'       => '17px',
					'font-weight'     => '600',
					'font-style'      => 'normal',
					'line-height'     => '1.5em',
					'text-decoration' => 'none',
					'text-transform'  => 'none',
					'letter-spacing'  => '0px',
				),
				'submenu' => array(
					'title'           => esc_html__( 'Dropdown menu', 'gutentype' ),
					'description'     => esc_html__( 'Font settings of the dropdown menu items', 'gutentype' ),
                    'font-family'     => '"Barlow",sans-serif',
					'font-size'       => '15px',
					'font-weight'     => '400',
					'font-style'      => 'normal',
					'line-height'     => '1.5em',
					'text-decoration' => 'none',
					'text-transform'  => 'none',
					'letter-spacing'  => '0px',
				),
			)
		);

		// -----------------------------------------------------------------
		// -- Theme colors for customizer
		// -- Attention! Inner scheme must be last in the array below
		// -----------------------------------------------------------------
		gutentype_storage_set(
			'scheme_color_groups', array(
				'main'    => array(
					'title'       => esc_html__( 'Main', 'gutentype' ),
					'description' => esc_html__( 'Colors of the main content area', 'gutentype' ),
				),
				'alter'   => array(
					'title'       => esc_html__( 'Alter', 'gutentype' ),
					'description' => esc_html__( 'Colors of the alternative blocks (sidebars, etc.)', 'gutentype' ),
				),
				'extra'   => array(
					'title'       => esc_html__( 'Extra', 'gutentype' ),
					'description' => esc_html__( 'Colors of the extra blocks (dropdowns, price blocks, table headers, etc.)', 'gutentype' ),
				),
				'inverse' => array(
					'title'       => esc_html__( 'Inverse', 'gutentype' ),
					'description' => esc_html__( 'Colors of the inverse blocks - when link color used as background of the block (dropdowns, blockquotes, etc.)', 'gutentype' ),
				),
				'input'   => array(
					'title'       => esc_html__( 'Input', 'gutentype' ),
					'description' => esc_html__( 'Colors of the form fields (text field, textarea, select, etc.)', 'gutentype' ),
				),
			)
		);
		gutentype_storage_set(
			'scheme_color_names', array(
				'bg_color'    => array(
					'title'       => esc_html__( 'Background color', 'gutentype' ),
					'description' => esc_html__( 'Background color of this block in the normal state', 'gutentype' ),
				),
				'bg_hover'    => array(
					'title'       => esc_html__( 'Background hover', 'gutentype' ),
					'description' => esc_html__( 'Background color of this block in the hovered state', 'gutentype' ),
				),
				'bd_color'    => array(
					'title'       => esc_html__( 'Border color', 'gutentype' ),
					'description' => esc_html__( 'Border color of this block in the normal state', 'gutentype' ),
				),
				'bd_hover'    => array(
					'title'       => esc_html__( 'Border hover', 'gutentype' ),
					'description' => esc_html__( 'Border color of this block in the hovered state', 'gutentype' ),
				),
				'text'        => array(
					'title'       => esc_html__( 'Text', 'gutentype' ),
					'description' => esc_html__( 'Color of the plain text inside this block', 'gutentype' ),
				),
				'text_dark'   => array(
					'title'       => esc_html__( 'Text dark', 'gutentype' ),
					'description' => esc_html__( 'Color of the dark text (bold, header, etc.) inside this block', 'gutentype' ),
				),
				'text_light'  => array(
					'title'       => esc_html__( 'Text light', 'gutentype' ),
					'description' => esc_html__( 'Color of the light text (post meta, etc.) inside this block', 'gutentype' ),
				),
				'text_link'   => array(
					'title'       => esc_html__( 'Link', 'gutentype' ),
					'description' => esc_html__( 'Color of the links inside this block', 'gutentype' ),
				),
				'text_hover'  => array(
					'title'       => esc_html__( 'Link hover', 'gutentype' ),
					'description' => esc_html__( 'Color of the hovered state of links inside this block', 'gutentype' ),
				),
				'text_link2'  => array(
					'title'       => esc_html__( 'Link 2', 'gutentype' ),
					'description' => esc_html__( 'Color of the accented texts (areas) inside this block', 'gutentype' ),
				),
				'text_hover2' => array(
					'title'       => esc_html__( 'Link 2 hover', 'gutentype' ),
					'description' => esc_html__( 'Color of the hovered state of accented texts (areas) inside this block', 'gutentype' ),
				),
				'text_link3'  => array(
					'title'       => esc_html__( 'Link 3', 'gutentype' ),
					'description' => esc_html__( 'Color of the other accented texts (buttons) inside this block', 'gutentype' ),
				),
				'text_hover3' => array(
					'title'       => esc_html__( 'Link 3 hover', 'gutentype' ),
					'description' => esc_html__( 'Color of the hovered state of other accented texts (buttons) inside this block', 'gutentype' ),
				),
			)
		);
		gutentype_storage_set(
			'schemes', array(

				// Color scheme: 'default'
				'default' => array(
					'title'    => esc_html__( 'Default', 'gutentype' ),
					'internal' => true,
					'colors'   => array(

						// Whole block border and background
						'bg_color'         => '#ffffff',
						'bd_color'         => '#ededed', //ok

						// Text and links colors
						'text'             => '#596172', //ok
						'text_light'       => '#788193', //ok
						'text_dark'        => '#152035', //ok
						'text_link'        => '#fd4145', //ok
						'text_hover'       => '#e32e32', //ok
						'text_link2'       => '#244076', //ok
						'text_hover2'      => '#19315f', //ok
						'text_link3'       => '#ddb837',
						'text_hover3'      => '#eec432',

						// Alternative blocks (sidebar, tabs, alternative blocks, etc.)
						'alter_bg_color'   => '#f7f8fa', //ok
						'alter_bg_hover'   => '#fcfcfc',
						'alter_bd_color'   => '#ededed', //ok
						'alter_bd_hover'   => '#dadada',
						'alter_text'       => '#333333',
						'alter_light'      => '#b7b7b7',
						'alter_dark'       => '#1d1d1d',
						'alter_link'       => '#fe7259',
						'alter_hover'      => '#72cfd5',
						'alter_link2'      => '#8be77c',
						'alter_hover2'     => '#80d572',
						'alter_link3'      => '#788193', //ok
						'alter_hover3'     => '#5b6270', //ok

						// Extra blocks (submenu, tabs, color blocks, etc.)
						'extra_bg_color'   => '#152035', //ok
						'extra_bg_hover'   => '#28272e',
						'extra_bd_color'   => '#313131',
						'extra_bd_hover'   => '#3d3d3d',
						'extra_text'       => '#bfbfbf',
						'extra_light'      => '#afafaf',
						'extra_dark'       => '#ffffff', //ok
						'extra_link'       => '#72cfd5',
						'extra_hover'      => '#fe7259',
						'extra_link2'      => '#80d572',
						'extra_hover2'     => '#8be77c',
						'extra_link3'      => '#ddb837',
						'extra_hover3'     => '#2c374c', //ok

						// Input fields (form's fields and textarea)
						'input_bg_color'   => '#ffffff', //ok
						'input_bg_hover'   => '#ffffff', //ok
						'input_bd_color'   => '#ebebeb', //ok
						'input_bd_hover'   => '#dedede', //ok
						'input_text'       => '#596172', //ok
						'input_light'      => '#596172', //ok
						'input_dark'       => '#596172', //ok

						// Inverse blocks (text and links on the 'text_link' background)
						'inverse_bd_color' => '#67bcc1',
						'inverse_bd_hover' => '#5aa4a9',
						'inverse_text'     => '#1d1d1d',
						'inverse_light'    => '#333333',
						'inverse_dark'     => '#152035', //ok
						'inverse_link'     => '#ffffff',
						'inverse_hover'    => '#1d1d1d',
					),
				),

				// Color scheme: 'dark'
				'dark'    => array(
					'title'    => esc_html__( 'Dark', 'gutentype' ),
					'internal' => true,
					'colors'   => array(

						// Whole block border and background
						'bg_color'         => '#152035', //ok
						'bd_color'         => '#2c374c', //ok

						// Text and links colors
						'text'             => '#c9cdd6', //ok
						'text_light'       => '#d0d4dd', //ok
						'text_dark'        => '#ffffff', //ok
                        'text_link'        => '#fd4145', //ok
                        'text_hover'       => '#e32e32', //ok
						'text_link2'       => '#244375', //ok
						'text_hover2'      => '#18325d', //ok
						'text_link3'       => '#ddb837',
						'text_hover3'      => '#eec432',

						// Alternative blocks (sidebar, tabs, alternative blocks, etc.)
						'alter_bg_color'   => '#1e1d22',
						'alter_bg_hover'   => '#333333',
						'alter_bd_color'   => '#464646',
						'alter_bd_hover'   => '#4a4a4a',
						'alter_text'       => '#a6a6a6',
						'alter_light'      => '#6f6f6f',
						'alter_dark'       => '#ffffff',
						'alter_link'       => '#ffaa5f',
						'alter_hover'      => '#fe7259',
						'alter_link2'      => '#8be77c',
						'alter_hover2'     => '#80d572',
						'alter_link3'      => '#788193', //ok
						'alter_hover3'     => '#5b6270', //ok

						// Extra blocks (submenu, tabs, color blocks, etc.)
						'extra_bg_color'   => '#152035', //ok
						'extra_bg_hover'   => '#28272e',
						'extra_bd_color'   => '#464646',
						'extra_bd_hover'   => '#4a4a4a',
						'extra_text'       => '#a6a6a6',
						'extra_light'      => '#6f6f6f',
						'extra_dark'       => '#ffffff',
						'extra_link'       => '#ffaa5f',
						'extra_hover'      => '#fe7259',
						'extra_link2'      => '#80d572',
						'extra_hover2'     => '#8be77c',
						'extra_link3'      => '#ddb837',
						'extra_hover3'     => '#2c374c', //ok

						// Input fields (form's fields and textarea)
						'input_bg_color'   => '#152035', //ok
						'input_bg_hover'   => '#121c2e', //ok
						'input_bd_color'   => '#212c40', //ok
						'input_bd_hover'   => '#323c4f', //ok
						'input_text'       => '#c9cdd6', //ok
						'input_light'      => '#c9cdd6', //ok
						'input_dark'       => '#ffffff', //ok

						// Inverse blocks (text and links on the 'text_link' background)
						'inverse_bd_color' => '#e36650',
						'inverse_bd_hover' => '#cb5b47',
						'inverse_text'     => '#1d1d1d',
						'inverse_light'    => '#6f6f6f',
						'inverse_dark'     => '#152035',
						'inverse_link'     => '#ffffff',
						'inverse_hover'    => '#1d1d1d',
					),
				),

                // Color scheme: 'extra'
                'extra' => array(
                    'title'    => esc_html__( 'Extra', 'gutentype' ),
                    'internal' => true,
                    'colors'   => array(

                        // Whole block border and background
                        'bg_color'         => '#f7f8fa',
                        'bd_color'         => '#ededed', //ok

                        // Text and links colors
                        'text'             => '#596172', //ok
                        'text_light'       => '#788193', //ok
                        'text_dark'        => '#152035', //ok
                        'text_link'        => '#fd4145', //ok
                        'text_hover'       => '#e32e32', //ok
                        'text_link2'       => '#244076', //ok
                        'text_hover2'      => '#19315f', //ok
                        'text_link3'       => '#e8d4c2', //ok
                        'text_hover3'      => '#29a2ef', //ok

                        // Alternative blocks (sidebar, tabs, alternative blocks, etc.)
                        'alter_bg_color'   => '#ffffff', //ok
                        'alter_bg_hover'   => '#fcfcfc',
                        'alter_bd_color'   => '#ededed', //ok
                        'alter_bd_hover'   => '#dadada',
                        'alter_text'       => '#333333',
                        'alter_light'      => '#b7b7b7',
                        'alter_dark'       => '#1d1d1d',
                        'alter_link'       => '#fe7259',
                        'alter_hover'      => '#72cfd5',
                        'alter_link2'      => '#8be77c',
                        'alter_hover2'     => '#80d572',
                        'alter_link3'      => '#788193', //ok
                        'alter_hover3'     => '#5b6270', //ok

                        // Extra blocks (submenu, tabs, color blocks, etc.)
                        'extra_bg_color'   => '#152035', //ok
                        'extra_bg_hover'   => '#28272e',
                        'extra_bd_color'   => '#313131',
                        'extra_bd_hover'   => '#3d3d3d',
                        'extra_text'       => '#bfbfbf',
                        'extra_light'      => '#afafaf',
                        'extra_dark'       => '#ffffff', //ok
                        'extra_link'       => '#72cfd5',
                        'extra_hover'      => '#fe7259',
                        'extra_link2'      => '#80d572',
                        'extra_hover2'     => '#8be77c',
                        'extra_link3'      => '#ddb837',
                        'extra_hover3'     => '#2c374c', //ok

                        // Input fields (form's fields and textarea)
                        'input_bg_color'   => '#ffffff', //ok
                        'input_bg_hover'   => '#ffffff', //ok
                        'input_bd_color'   => '#ebebeb', //ok
                        'input_bd_hover'   => '#dedede', //ok
                        'input_text'       => '#596172', //ok
                        'input_light'      => '#596172', //ok
                        'input_dark'       => '#596172', //ok

                        // Inverse blocks (text and links on the 'text_link' background)
                        'inverse_bd_color' => '#67bcc1',
                        'inverse_bd_hover' => '#5aa4a9',
                        'inverse_text'     => '#1d1d1d',
                        'inverse_light'    => '#333333',
                        'inverse_dark'     => '#152035', //ok
                        'inverse_link'     => '#ffffff',
                        'inverse_hover'    => '#1d1d1d',
                    ),
                ),

			)
		);

		// Simple schemes substitution
		gutentype_storage_set(
			'schemes_simple', array(
				// Main color	// Slave elements and it's darkness koef.
				'text_link'   => array(
					'alter_hover'      => 1,
					'extra_link'       => 1,
					'inverse_bd_color' => 0.85,
					'inverse_bd_hover' => 0.7,
				),
				'text_hover'  => array(
					'alter_link'  => 1,
					'extra_hover' => 1,
				),
				'text_link2'  => array(
					'alter_hover2' => 1,
					'extra_link2'  => 1,
				),
				'text_hover2' => array(
					'alter_link2'  => 1,
					'extra_hover2' => 1,
				),
				'text_link3'  => array(
					'alter_hover3' => 1,
					'extra_link3'  => 1,
				),
				'text_hover3' => array(
					'alter_link3'  => 1,
					'extra_hover3' => 1,
				),
			)
		);

		// Additional colors for each scheme
		// Parameters:	'color' - name of the color from the scheme that should be used as source for the transformation
		//				'alpha' - to make color transparent (0.0 - 1.0)
		//				'hue', 'saturation', 'brightness' - inc/dec value for each color's component
		gutentype_storage_set(
			'scheme_colors_add', array(
				'bg_color_0'        => array(
					'color' => 'bg_color',
					'alpha' => 0,
				),
				'bg_color_02'       => array(
					'color' => 'bg_color',
					'alpha' => 0.2,
				),
				'bg_color_07'       => array(
					'color' => 'bg_color',
					'alpha' => 0.7,
				),
				'bg_color_08'       => array(
					'color' => 'bg_color',
					'alpha' => 0.8,
				),
				'bg_color_09'       => array(
					'color' => 'bg_color',
					'alpha' => 0.9,
				),
				'alter_bg_color_07' => array(
					'color' => 'alter_bg_color',
					'alpha' => 0.7,
				),
				'alter_bg_color_04' => array(
					'color' => 'alter_bg_color',
					'alpha' => 0.4,
				),
				'alter_bg_color_02' => array(
					'color' => 'alter_bg_color',
					'alpha' => 0.2,
				),
				'alter_bd_color_02' => array(
					'color' => 'alter_bd_color',
					'alpha' => 0.2,
				),
				'alter_link_02'     => array(
					'color' => 'alter_link',
					'alpha' => 0.2,
				),
				'alter_link_07'     => array(
					'color' => 'alter_link',
					'alpha' => 0.7,
				),
				'extra_bg_color_07' => array(
					'color' => 'extra_bg_color',
					'alpha' => 0.7,
				),
				'extra_link_02'     => array(
					'color' => 'extra_link',
					'alpha' => 0.2,
				),
                'text_link2_08'     => array(
					'color' => 'text_link2',
					'alpha' => 0.8,
				),
                'text_link_05'     => array(
					'color' => 'text_link',
					'alpha' => 0.5,
				),
				'extra_link_07'     => array(
					'color' => 'extra_link',
					'alpha' => 0.7,
				),
                'text_dark_005'      => array(
                    'color' => 'text_dark',
                    'alpha' => 0.05,
                ),
				'text_dark_07'      => array(
					'color' => 'text_dark',
					'alpha' => 0.7,
				),
				'text_link_02'      => array(
					'color' => 'text_link',
					'alpha' => 0.2,
				),
                'text_link2_02'      => array(
					'color' => 'text_link2',
					'alpha' => 0.2,
				),
				'text_link_07'      => array(
					'color' => 'text_link',
					'alpha' => 0.7,
				),
                'inverse_dark_08'      => array(
					'color' => 'inverse_dark',
					'alpha' => 0.85,
				),
				'alter_bg_color_03'      => array(
					'color' => 'alter_bg_color',
					'alpha' => 0.3,
				),
				'text_link_blend'   => array(
					'color'      => 'text_link',
					'hue'        => 2,
					'saturation' => -5,
					'brightness' => 5,
				),
				'alter_link_blend'  => array(
					'color'      => 'alter_link',
					'hue'        => 2,
					'saturation' => -5,
					'brightness' => 5,
				),
			)
		);

		// Parameters to set order of schemes in the css
		gutentype_storage_set(
			'schemes_sorted', array(
				'color_scheme',
				'header_scheme',
				'menu_scheme',
				'sidebar_scheme',
				'footer_scheme',
			)
		);

		// -----------------------------------------------------------------
		// -- Theme specific thumb sizes
		// -----------------------------------------------------------------
		gutentype_storage_set(
			'theme_thumbs', apply_filters(
				'gutentype_filter_add_thumb_sizes', array(
					// Width of the image is equal to the content area width (without sidebar)
					// Height is fixed
					'gutentype-thumb-huge'        => array(
						'size'  => array( 1170, 658, true ),
						'title' => esc_html__( 'Huge image', 'gutentype' ),
						'subst' => 'trx_addons-thumb-huge',
					),
					// Width of the image is equal to the content area width (with sidebar)
					// Height is fixed
					'gutentype-thumb-big'         => array(
						'size'  => array( 972, 546, true ),
						'title' => esc_html__( 'Large image', 'gutentype' ),
						'subst' => 'trx_addons-thumb-big',
					),

					// Width of the image is equal to the 1/3 of the content area width (without sidebar)
					// Height is fixed
					'gutentype-thumb-med'         => array(
						'size'  => array( 370, 208, true ),
						'title' => esc_html__( 'Medium image', 'gutentype' ),
						'subst' => 'trx_addons-thumb-medium',
					),

					// Small square image (for avatars in comments, etc.)
					'gutentype-thumb-tiny'        => array(
						'size'  => array( 90, 90, true ),
						'title' => esc_html__( 'Small square avatar', 'gutentype' ),
						'subst' => 'trx_addons-thumb-tiny',
					),

					// Width of the image is equal to the content area width (with sidebar)
					// Height is proportional (only downscale, not crop)
					'gutentype-thumb-masonry-big' => array(
						'size'  => array( 760, 0, false ),     // Only downscale, not crop
						'title' => esc_html__( 'Masonry Large (scaled)', 'gutentype' ),
						'subst' => 'trx_addons-thumb-masonry-big',
					),

					// Width of the image is equal to the 1/3 of the full content area width (without sidebar)
					// Height is proportional (only downscale, not crop)
					'gutentype-thumb-masonry'     => array(
						'size'  => array( 370, 0, false ),     // Only downscale, not crop
						'title' => esc_html__( 'Masonry (scaled)', 'gutentype' ),
						'subst' => 'trx_addons-thumb-masonry',
					),

                    'gutentype-thumb-extra'        => array(
                        'size'  => array( 676, 424, true ),
                        'title' => esc_html__( 'Extra', 'gutentype' ),
                        'subst' => 'trx_addons-thumb-extra',
                    ),
                    'gutentype-thumb-plain'        => array(
                        'size'  => array( 570, 452, true ),
                        'title' => esc_html__( 'Plain', 'gutentype' ),
                        'subst' => 'trx_addons-thumb-plain',
                    ),

                )
			)
		);
	}
}




//------------------------------------------------------------------------
// One-click import support
//------------------------------------------------------------------------

// Set theme specific importer options
if ( ! function_exists( 'gutentype_importer_set_options' ) ) {
	add_filter( 'trx_addons_filter_importer_options', 'gutentype_importer_set_options', 9 );
	function gutentype_importer_set_options( $options = array() ) {
		if ( is_array( $options ) ) {
			// Save or not installer's messages to the log-file
			$options['debug'] = false;
			// Allow import/export functionality
			$rtl_prefix = is_rtl() ? 'rtl.' : '';
            $rtl_demo_sufix = is_rtl() ? '_rtl' : '';
			$options['allow_import'] = true;
			$options['allow_export'] = false;
			// Prepare demo data
			$options['demo_url'] = esc_url( gutentype_get_protocol() . '://demofiles.ancorathemes.com/gutentype' . $rtl_demo_sufix . '/');
			// Required plugins
			$options['required_plugins'] = array_keys( gutentype_storage_get( 'required_plugins' ) );
			// Set number of thumbnails to regenerate when its imported (if demo data was zipped without cropped images)
			// Set 0 to prevent regenerate thumbnails (if demo data archive is already contain cropped images)
			$options['regenerate_thumbnails'] = 3;
			// Default demo
			$options['files']['default']['title']       = esc_html__( 'GutenType Demo', 'gutentype' );
			$options['files']['default']['domain_dev']  = esc_url( gutentype_get_protocol() . '://gutentype.upd.themerex.net' );       // Developers domain
			$options['files']['default']['domain_demo'] = esc_url( gutentype_get_protocol() . '://' . $rtl_prefix . 'gutentype.ancorathemes.com');       // Demo-site domain

			// Banners
			$options['banners'] = array(
				array(
					'image'        => gutentype_get_file_url( 'theme-specific/theme-about/images/frontpage.png' ),
					'title'        => esc_html__( 'Front Page Builder', 'gutentype' ),
					'content'      => esc_html__( "Create your front page right in the WordPress Customizer. There's no need in any page builder. Simply enable/disable sections, fill them out with content, and customize to your liking.", 'gutentype' ),
					'link_url'     => esc_url( '//www.youtube.com/watch?v=VT0AUbMl_KA' ),
					'link_caption' => esc_html__( 'Watch Video Introduction', 'gutentype' ),
					'duration'     => 20,
				),
				array(
					'image'        => gutentype_get_file_url( 'theme-specific/theme-about/images/layouts.png' ),
					'title'        => esc_html__( 'Layouts Builder', 'gutentype' ),
					'content'      => esc_html__( 'Use Layouts Builder to create and customize header and footer styles for your website. With a flexible page builder interface and custom shortcodes, you can create as many header and footer layouts as you want with ease.', 'gutentype' ),
					'link_url'     => esc_url( '//www.youtube.com/watch?v=pYhdFVLd7y4' ),
					'link_caption' => esc_html__( 'Learn More', 'gutentype' ),
					'duration'     => 20,
				),
				array(
					'image'        => gutentype_get_file_url( 'theme-specific/theme-about/images/documentation.png' ),
					'title'        => esc_html__( 'Read Full Documentation', 'gutentype' ),
					'content'      => esc_html__( 'Need more details? Please check our full online documentation for detailed information on how to use GutenType.', 'gutentype' ),
					'link_url'     => esc_url( gutentype_storage_get( 'theme_doc_url' ) ),
					'link_caption' => esc_html__( 'Online Documentation', 'gutentype' ),
					'duration'     => 15,
				),
				array(
					'image'        => gutentype_get_file_url( 'theme-specific/theme-about/images/video-tutorials.png' ),
					'title'        => esc_html__( 'Video Tutorials', 'gutentype' ),
					'content'      => esc_html__( 'No time for reading documentation? Check out our video tutorials and learn how to customize GutenType in detail.', 'gutentype' ),
					'link_url'     => esc_url( gutentype_storage_get( 'theme_video_url' ) ),
					'link_caption' => esc_html__( 'Video Tutorials', 'gutentype' ),
					'duration'     => 15,
				),
				array(
					'image'        => gutentype_get_file_url( 'theme-specific/theme-about/images/studio.png' ),
					'title'        => esc_html__( 'Website Customization', 'gutentype' ),
					'content'      => esc_html__( "Need a website fast? Order our custom service, and we'll build a website based on this theme for a very fair price. We can also implement additional functionality such as website translation, setting up WPML, and much more.", 'gutentype' ),
					'link_url'     => esc_url( 'themerex.net/offers/?utm_source=offers&utm_medium=click&utm_campaign=themeinstall' ),
					'link_caption' => esc_html__( 'Contact Us', 'gutentype' ),
					'duration'     => 25,
				),
			);
		}
		return $options;
	}
}


//------------------------------------------------------------------------
// OCDI support
//------------------------------------------------------------------------

// Set theme specific OCDI options
if ( ! function_exists( 'gutentype_ocdi_set_options' ) ) {
	add_filter( 'trx_addons_filter_ocdi_options', 'gutentype_ocdi_set_options', 9 );
	function gutentype_ocdi_set_options( $options = array() ) {
		if ( is_array( $options ) ) {
			// Prepare demo data
			$rtl_prefix = is_rtl() ? 'rtl.' : '';
			$rtl_demo_sufix = is_rtl() ? '_rtl' : '';
			
			$options['demo_url'] = esc_url( gutentype_get_protocol() . '://demofiles.ancorathemes.com/gutentype' . $rtl_demo_sufix . '/' );
			// Required plugins
			$options['required_plugins'] = array_keys( (array) gutentype_storage_get( 'required_plugins' ) );
			// Demo-site domain
			$options['files']['ocdi']['title']       = esc_html__( 'GutenType OCDI Demo', 'gutentype' );
			$options['files']['ocdi']['domain_demo'] = esc_url( gutentype_get_protocol() .'://' . $rtl_prefix . 'gutentype.ancorathemes.com' );

		}
		return $options;
	}
}


// -----------------------------------------------------------------
// -- Theme options for customizer
// -----------------------------------------------------------------
if ( ! function_exists( 'gutentype_create_theme_options' ) ) {

	function gutentype_create_theme_options() {

		// Message about options override.
		// Attention! Not need esc_html() here, because this message put in wp_kses_data() below
		$msg_override = __( 'Attention! Some of these options can be overridden in the following sections (Blog, Plugins settings, etc.) or in the settings of individual pages. If you changed such parameter and nothing happened on the page, this option may be overridden in the corresponding section or in the Page Options of this page. These options are marked with an asterisk (*) in the title.', 'gutentype' );

		// Color schemes number: if < 2 - hide fields with selectors
		$hide_schemes = count( gutentype_storage_get( 'schemes' ) ) < 2;

		gutentype_storage_set(
			'options', array(

				// 'Logo & Site Identity'
				'title_tagline'                 => array(
					'title'    => esc_html__( 'Logo & Site Identity', 'gutentype' ),
					'desc'     => '',
					'priority' => 10,
					'type'     => 'section',
				),
				'logo_info'                     => array(
					'title'    => esc_html__( 'Logo Settings', 'gutentype' ),
					'desc'     => '',
					'priority' => 20,
					'qsetup'   => esc_html__( 'General', 'gutentype' ),
					'type'     => 'info',
				),
				'logo_text'                     => array(
					'title'    => esc_html__( 'Use Site Name as Logo', 'gutentype' ),
					'desc'     => wp_kses_data( __( 'Use the site title and tagline as a text logo if no image is selected', 'gutentype' ) ),
					'class'    => 'gutentype_column-1_2 gutentype_new_row',
					'priority' => 30,
					'std'      => 1,
					'qsetup'   => esc_html__( 'General', 'gutentype' ),
					'type'     => GUTENTYPE_THEME_FREE ? 'hidden' : 'checkbox',
				),
				'logo_retina_enabled'           => array(
					'title'    => esc_html__( 'Allow retina display logo', 'gutentype' ),
					'desc'     => wp_kses_data( __( 'Show fields to select logo images for Retina display', 'gutentype' ) ),
					'class'    => 'gutentype_column-1_2',
					'priority' => 40,
					'refresh'  => false,
					'std'      => 0,
					'type'     => GUTENTYPE_THEME_FREE ? 'hidden' : 'checkbox',
				),
				'logo_zoom'                     => array(
					'title'   => esc_html__( 'Logo zoom', 'gutentype' ),
					'desc'    => wp_kses_data( __( 'Zoom the text logo. (1 - original size)', 'gutentype' ) ),
					'std'     => 1,
					'min'     => 0.2,
					'max'     => 2,
					'step'    => 0.1,
					'refresh' => false,
					'type'    => GUTENTYPE_THEME_FREE ? 'hidden' : 'slider',
				),
				// Parameter 'logo' was replaced with standard WordPress 'custom_logo'
				'logo_retina'                   => array(
					'title'      => esc_html__( 'Logo for Retina', 'gutentype' ),
					'desc'       => wp_kses_data( __( 'Select or upload site logo used on Retina displays (if empty - use default logo from the field above)', 'gutentype' ) ),
                    'class'    => ( !empty( $_REQUEST['post'] ) && !empty( $_REQUEST['action'] ) && $_REQUEST['action'] == 'edit' ) ? '' : 'gutentype_column-1_2',
                    'priority'   => 70,
					'dependency' => array(
						'logo_retina_enabled' => array( 1 ),
					),
					'std'        => '',
					'type'       => GUTENTYPE_THEME_FREE ? 'hidden' : 'image',
                    'override' => array(
                        'mode'    => 'page',
                        'section' => esc_html__( 'Header', 'gutentype' ),
                    ),
				),
				'logo_mobile_header'            => array(
					'title' => esc_html__( 'Logo for the mobile header', 'gutentype' ),
					'desc'  => wp_kses_data( __( 'Select or upload site logo to display it in the mobile header (if enabled in the section "Header - Header mobile"', 'gutentype' ) ),
					'class' => 'gutentype_column-1_2 gutentype_new_row',
					'std'   => '',
					'type'  => 'image',
				),
				'logo_mobile_header_retina'     => array(
					'title'      => esc_html__( 'Logo for the mobile header on Retina', 'gutentype' ),
					'desc'       => wp_kses_data( __( 'Select or upload site logo used on Retina displays (if empty - use default logo from the field above)', 'gutentype' ) ),
					'class'      => 'gutentype_column-1_2',
					'dependency' => array(
						'logo_retina_enabled' => array( 1 ),
					),
					'std'        => '',
					'type'       => GUTENTYPE_THEME_FREE ? 'hidden' : 'image',
				),
				'logo_mobile'                   => array(
					'title' => esc_html__( 'Logo for the mobile menu', 'gutentype' ),
					'desc'  => wp_kses_data( __( 'Select or upload site logo to display it in the mobile menu', 'gutentype' ) ),
					'class' => 'gutentype_column-1_2 gutentype_new_row',
					'std'   => '',
					'type'  => 'image',
				),
				'logo_mobile_retina'            => array(
					'title'      => esc_html__( 'Logo mobile on Retina', 'gutentype' ),
					'desc'       => wp_kses_data( __( 'Select or upload site logo used on Retina displays (if empty - use default logo from the field above)', 'gutentype' ) ),
					'class'      => 'gutentype_column-1_2',
					'dependency' => array(
						'logo_retina_enabled' => array( 1 ),
					),
					'std'        => '',
					'type'       => GUTENTYPE_THEME_FREE ? 'hidden' : 'image',
				),
				'logo_side'                     => array(
					'title' => esc_html__( 'Logo for the side menu', 'gutentype' ),
					'desc'  => wp_kses_data( __( 'Select or upload site logo (with vertical orientation) to display it in the side menu', 'gutentype' ) ),
					'class' => 'gutentype_column-1_2 gutentype_new_row',
					'std'   => '',
					'type'  => 'hidden',
				),
				'logo_side_retina'              => array(
					'title'      => esc_html__( 'Logo for the side menu on Retina', 'gutentype' ),
					'desc'       => wp_kses_data( __( 'Select or upload site logo (with vertical orientation) to display it in the side menu on Retina displays (if empty - use default logo from the field above)', 'gutentype' ) ),
					'class'      => 'gutentype_column-1_2',
					'dependency' => array(
						'logo_retina_enabled' => array( 1 ),
					),
					'std'        => '',
					'type'       => 'hidden',
				),

				// 'General settings'
				'general'                       => array(
					'title'    => esc_html__( 'General Settings', 'gutentype' ),
					'desc'     => wp_kses_data( $msg_override ),
					'priority' => 20,
					'type'     => 'section',
				),

				'general_layout_info'           => array(
					'title'  => esc_html__( 'Layout', 'gutentype' ),
					'desc'   => '',
					'qsetup' => esc_html__( 'General', 'gutentype' ),
					'type'   => 'info',
				),
				'body_style'                    => array(
					'title'    => esc_html__( 'Body style', 'gutentype' ),
					'desc'     => wp_kses_data( __( 'Select width of the body content', 'gutentype' ) ),
					'override' => array(
						'mode'    => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
						'section' => esc_html__( 'Content', 'gutentype' ),
					),
					'qsetup'   => esc_html__( 'General', 'gutentype' ),
					'refresh'  => false,
					'std'      => 'wide',
					'options'  => gutentype_get_list_body_styles( false ),
					'type'     => 'select',
				),
				'page_width'                    => array(
					'title'      => esc_html__( 'Page width', 'gutentype' ),
					'desc'       => wp_kses_data( __( 'Total width of the site content and sidebar (in pixels). If empty - use default width', 'gutentype' ) ),
					'dependency' => array(
						'body_style' => array( 'boxed', 'wide' ),
					),
					'std'        => 1170,
					'min'        => 1000,
					'max'        => 1400,
					'step'       => 10,
					'refresh'    => false,
					'customizer' => 'page',         // SASS variable's name to preview changes 'on fly'
					'type'       => GUTENTYPE_THEME_FREE ? 'hidden' : 'slider',
				),
				'boxed_bg_image'                => array(
					'title'      => esc_html__( 'Boxed bg image', 'gutentype' ),
					'desc'       => wp_kses_data( __( 'Select or upload image, used as background in the boxed body', 'gutentype' ) ),
					'dependency' => array(
						'body_style' => array( 'boxed' ),
					),
					'override'   => array(
						'mode'    => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
						'section' => esc_html__( 'Content', 'gutentype' ),
					),
					'std'        => '',
					'qsetup'     => esc_html__( 'General', 'gutentype' ),
					'type'       => 'image',
				),
				'remove_margins'                => array(
                    'title'    => esc_html__( 'Remove margins', 'gutentype' ),
                    'desc'     => wp_kses_data( __( 'Remove margins above and below the content area', 'gutentype' ) ),
                    'override' => array(
                        'mode'    => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
                        'section' => esc_html__( 'Content', 'gutentype' ),
                    ),
                    'refresh'  => false,
                    'std'      => 0,
                    'type'     => 'checkbox',
                ),
                'use_page_background_color'         => array(
                    'title'    => esc_html__( 'Page background color', 'gutentype' ),
                    'desc'     => wp_kses_data( __( "Use page background color.", 'gutentype' ) ),
                    'override' => array(
                        'mode'    => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
                        'section' => esc_html__( 'Content', 'gutentype' ),
                    ),
                    'std'      => 0,
                    'type'     => GUTENTYPE_THEME_FREE ? 'hidden' : 'checkbox',
                ),

                'page_background_color'         => array(
                    'title'    => esc_html__( 'Page background color', 'gutentype' ),
                    'desc'     => wp_kses_data( __( "Select page background color.", 'gutentype' ) ),
                    'override' => array(
                        'mode'    => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
                        'section' => esc_html__( 'Content', 'gutentype' ),
                    ),
                    'dependency' => array(
                        'use_page_background_color' => array( 1 ),
                    ),
                    'std'      => '',
                    'type'     => 'color',
                ),


                'show_social_side'                => array(
                    'title'    => esc_html__( 'Show Social Side', 'gutentype' ),
                    'desc'     => wp_kses_data( __( 'Show Social on the left side of the page', 'gutentype' ) ),
                    'override' => array(
                        'mode'    => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
                        'section' => esc_html__( 'Content', 'gutentype' ),
                    ),
                    'refresh'  => false,
                    'std'      => 0,
                    'type'     => gutentype_exists_trx_addons() ? 'checkbox' : 'hidden',
                ),

				'general_sidebar_info'          => array(
					'title' => esc_html__( 'Sidebar', 'gutentype' ),
					'desc'  => '',
					'type'  => 'info',
				),
				'sidebar_position'              => array(
					'title'    => esc_html__( 'Sidebar position', 'gutentype' ),
					'desc'     => wp_kses_data( __( 'Select position to show sidebar', 'gutentype' ) ),
					'override' => array(
						'mode'    => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
						'section' => esc_html__( 'Widgets', 'gutentype' ),
					),
					'std'      => 'right',
					'qsetup'   => esc_html__( 'General', 'gutentype' ),
					'options'  => array(),
					'type'     => 'switch',
				),
				'sidebar_widgets'               => array(
					'title'      => esc_html__( 'Sidebar widgets', 'gutentype' ),
					'desc'       => wp_kses_data( __( 'Select default widgets to show in the sidebar', 'gutentype' ) ),
					'override'   => array(
						'mode'    => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
						'section' => esc_html__( 'Widgets', 'gutentype' ),
					),
					'dependency' => array(
						'sidebar_position' => array( 'left', 'right' ),
					),
					'std'        => 'sidebar_widgets',
					'options'    => array(),
					'qsetup'     => esc_html__( 'General', 'gutentype' ),
					'type'       => 'select',
				),
				'sidebar_width'                 => array(
					'title'      => esc_html__( 'Sidebar width', 'gutentype' ),
					'desc'       => wp_kses_data( __( 'Width of the sidebar (in pixels). If empty - use default width', 'gutentype' ) ),
					'std'        => 370,
					'min'        => 150,
					'max'        => 500,
					'step'       => 10,
					'refresh'    => false,
					'customizer' => 'sidebar',      // SASS variable's name to preview changes 'on fly'
					'type'       => GUTENTYPE_THEME_FREE ? 'hidden' : 'slider',
				),
				'sidebar_gap'                   => array(
					'title'      => esc_html__( 'Sidebar gap', 'gutentype' ),
					'desc'       => wp_kses_data( __( 'Gap between content and sidebar (in pixels). If empty - use default gap', 'gutentype' ) ),
					'std'        => 30,
					'min'        => 0,
					'max'        => 100,
					'step'       => 1,
					'refresh'    => false,
					'customizer' => 'gap',          // SASS variable's name to preview changes 'on fly'
					'type'       => GUTENTYPE_THEME_FREE ? 'hidden' : 'slider',
				),
				'expand_content'                => array(
					'title'   => esc_html__( 'Expand content', 'gutentype' ),
					'desc'    => wp_kses_data( __( 'Expand the content width if the sidebar is hidden', 'gutentype' ) ),
					'refresh' => false,
					'std'     => 1,
					'type'    => 'checkbox',
                    'override' => array(
                        'mode'    => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
                        'section' => esc_html__( 'Content', 'gutentype' ),
                    ),
				),

				'general_widgets_info'          => array(
					'title' => esc_html__( 'Additional widgets', 'gutentype' ),
					'desc'  => '',
					'type'  => GUTENTYPE_THEME_FREE ? 'hidden' : 'info',
				),
				'widgets_above_page'            => array(
					'title'    => esc_html__( 'Widgets at the top of the page', 'gutentype' ),
					'desc'     => wp_kses_data( __( 'Select widgets to show at the top of the page (above content and sidebar)', 'gutentype' ) ),
					'override' => array(
						'mode'    => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
						'section' => esc_html__( 'Widgets', 'gutentype' ),
					),
					'std'      => 'hide',
					'options'  => array(),
					'type'     => GUTENTYPE_THEME_FREE ? 'hidden' : 'select',
				),
				'widgets_above_content'         => array(
					'title'    => esc_html__( 'Widgets above the content', 'gutentype' ),
					'desc'     => wp_kses_data( __( 'Select widgets to show at the beginning of the content area', 'gutentype' ) ),
					'override' => array(
						'mode'    => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
						'section' => esc_html__( 'Widgets', 'gutentype' ),
					),
					'std'      => 'hide',
					'options'  => array(),
					'type'     => GUTENTYPE_THEME_FREE ? 'hidden' : 'select',
				),
				'widgets_below_content'         => array(
					'title'    => esc_html__( 'Widgets below the content', 'gutentype' ),
					'desc'     => wp_kses_data( __( 'Select widgets to show at the ending of the content area', 'gutentype' ) ),
					'override' => array(
						'mode'    => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
						'section' => esc_html__( 'Widgets', 'gutentype' ),
					),
					'std'      => 'hide',
					'options'  => array(),
					'type'     => GUTENTYPE_THEME_FREE ? 'hidden' : 'select',
				),
				'widgets_below_page'            => array(
					'title'    => esc_html__( 'Widgets at the bottom of the page', 'gutentype' ),
					'desc'     => wp_kses_data( __( 'Select widgets to show at the bottom of the page (below content and sidebar)', 'gutentype' ) ),
					'override' => array(
						'mode'    => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
						'section' => esc_html__( 'Widgets', 'gutentype' ),
					),
					'std'      => 'hide',
					'options'  => array(),
					'type'     => GUTENTYPE_THEME_FREE ? 'hidden' : 'select',
				),




                'widgets_top_footer_page'            => array(
                    'title'    => esc_html__( 'Widgets at the top of the page footer (Not for Footer style Custom)', 'gutentype' ),
                    'desc'     => wp_kses_data( __( 'Select widgets to show at the bottom of the page (top of the footer)', 'gutentype' ) ),
                    'override' => array(
                        'mode'    => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
                        'section' => esc_html__( 'Widgets', 'gutentype' ),
                    ),
                    'std'      => 'hide',
                    'options'  => array(),
                    'type'     => GUTENTYPE_THEME_FREE ? 'hidden' : 'select',
                ),


                'widgets_blog_page'            => array(
                    'title'    => esc_html__( 'Widgets area in the middle of the blog belt (only for species Excerpt)', 'gutentype' ),
                    'desc'     => wp_kses_data( __( 'Select widgets to show in the middle of the blog belt', 'gutentype' ) ),
                    'override' => array(
                        'mode'    => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
                        'section' => esc_html__( 'Widgets', 'gutentype' ),
                    ),
                    'std'      => 'hide',
                    'options'  => array(),
                    'type'     => GUTENTYPE_THEME_FREE ? 'hidden' : 'select',
                ),





				'general_effects_info'          => array(
					'title' => esc_html__( 'Design & Effects', 'gutentype' ),
					'desc'  => '',
					'type'  => 'info',
				),
				'border_radius'                 => array(
					'title'      => esc_html__( 'Border radius', 'gutentype' ),
					'desc'       => wp_kses_data( __( 'Specify the border radius of the form fields and buttons in pixels', 'gutentype' ) ),
					'std'        => 0,
					'min'        => 0,
					'max'        => 20,
					'step'       => 1,
					'refresh'    => false,
					'customizer' => 'rad',      // SASS name to preview changes 'on fly'
					'type'       => 'hidden',
				),

                'blog_animation'                => array(
                    'title'      => esc_html__( 'Post animation', 'gutentype' ),
                    'desc'       => wp_kses_data( __( 'Select animation to show posts in the blog.', 'gutentype' ) ),
                    'override'   => array(
                        'mode'    => 'page',
                        'section' => esc_html__( 'Content', 'gutentype' ),
                    ),

                    'std'        => 'none',
                    'options'    => array(),
                    'type'       => GUTENTYPE_THEME_FREE ? 'hidden' : 'select',
                ),

				'general_misc_info'             => array(
					'title' => esc_html__( 'Miscellaneous', 'gutentype' ),
					'desc'  => '',
					'type'  => GUTENTYPE_THEME_FREE ? 'hidden' : 'info',
				),
				'seo_snippets'                  => array(
					'title' => esc_html__( 'SEO snippets', 'gutentype' ),
					'desc'  => wp_kses_data( __( 'Add structured data markup to the single posts and pages', 'gutentype' ) ),
					'std'   => 0,
					'type'  => GUTENTYPE_THEME_FREE ? 'hidden' : 'checkbox',
				),
				'privacy_text' => array(
					"title" => esc_html__("Text with Privacy Policy link", 'gutentype'),
					"desc"  => wp_kses_data( __("Specify text with Privacy Policy link for the checkbox 'I agree ...'", 'gutentype') ),
					"std"   => esc_html__( 'I agree that my submitted data is being collected and stored.', 'gutentype' ),
					"type"  => "text",
				),

				// 'Header'
				'header'                        => array(
					'title'    => esc_html__( 'Header', 'gutentype' ),
					'desc'     => wp_kses_data( $msg_override ),
					'priority' => 30,
					'type'     => 'section',
				),

				'header_style_info'             => array(
					'title' => esc_html__( 'Header style', 'gutentype' ),
					'desc'  => '',
					'type'  => 'info',
				),
				'header_type'                   => array(
					'title'    => esc_html__( 'Header style', 'gutentype' ),
					'desc'     => wp_kses_data( __( 'Choose whether to use the default header or header Layouts (available only if the ThemeREX Addons is activated)', 'gutentype' ) ),
					'override' => array(
						'mode'    => 'page,post,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
						'section' => esc_html__( 'Header', 'gutentype' ),
					),
					'std'      => 'default',
					'options'  => gutentype_get_list_header_types(),
					'type'     => GUTENTYPE_THEME_FREE || ! gutentype_exists_trx_addons() ? 'hidden' : 'switch',
				),
				'header_style'                  => array(
					'title'      => esc_html__( 'Select custom layout', 'gutentype' ),
					'desc'       => esc_html__( 'Select custom header from Layouts Builder', 'gutentype' ),
					'override'   => array(
						'mode'    => 'page,post,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
						'section' => esc_html__( 'Header', 'gutentype' ),
					),
					'dependency' => array(
						'header_type' => array( 'custom' ),
					),
					'std'        => GUTENTYPE_THEME_FREE ? 'header-custom-elementor-header-default' : 'header-custom-header-default',
					'options'    => array(),
					'type'       => 'select',
				),
				'header_position'               => array(
					'title'    => esc_html__( 'Header position', 'gutentype' ),
					'desc'     => wp_kses_data( __( 'Select position to display the site header', 'gutentype' ) ),
					'override' => array(
						'mode'    => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
						'section' => esc_html__( 'Header', 'gutentype' ),
					),
					'std'      => 'default',
					'options'  => array(),
					'type'     => GUTENTYPE_THEME_FREE ? 'hidden' : 'switch',
				),
				'header_fullheight'             => array(
					'title'    => esc_html__( 'Header fullheight', 'gutentype' ),
					'desc'     => wp_kses_data( __( 'Enlarge header area to fill whole screen. Used only if header have a background image', 'gutentype' ) ),
					'override' => array(
						'mode'    => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
						'section' => esc_html__( 'Header', 'gutentype' ),
					),
					'std'      => 0,
					'type'     => 'hidden',
				),
				'header_zoom'                   => array(
					'title'   => esc_html__( 'Header zoom', 'gutentype' ),
					'desc'    => wp_kses_data( __( 'Zoom the header title. 1 - original size', 'gutentype' ) ),
					'std'     => 1,
					'min'     => 0.3,
					'max'     => 2,
					'step'    => 0.1,
					'refresh' => false,
					'type'    => GUTENTYPE_THEME_FREE ? 'hidden' : 'slider',
				),
				'header_wide'                   => array(
					'title'      => esc_html__( 'Header fullwidth', 'gutentype' ),
					'desc'       => wp_kses_data( __( 'Do you want to stretch the header widgets area to the entire window width?', 'gutentype' ) ),
					'override'   => array(
						'mode'    => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
						'section' => esc_html__( 'Header', 'gutentype' ),
					),
					'dependency' => array(
						'header_type' => array( 'default', 'separate' ),
					),
					'std'        => 1,
					'type'       => GUTENTYPE_THEME_FREE ? 'hidden' : 'checkbox',
				),
				'header_sticky'                   => array(
					'title'      => esc_html__( 'Fix this header when scroll', 'gutentype' ),
					'desc'       => wp_kses_data( __( 'Fix this header to the top of the window when scrolling down', 'gutentype' ) ),
					'override'   => array(
						'mode'    => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
						'section' => esc_html__( 'Header', 'gutentype' ),
					),
					'std'        => 1,
					'type'       => GUTENTYPE_THEME_FREE ? 'hidden' : 'checkbox',
				),
                'show_main_title'             => array(
                    'title'    => esc_html__( 'Show Header Title', 'gutentype' ),
                    'desc'     => wp_kses_data( __( 'Show Page Title', 'gutentype' ) ),
                    'override' => array(
                        'mode'    => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
                        'section' => esc_html__( 'Header', 'gutentype' ),
                    ),
                    'std'      => 1,
                    'type'     => GUTENTYPE_THEME_FREE ? 'hidden' : 'checkbox',
                ),
                'show_main_breadcrumbs'             => array(
                    'title'    => esc_html__( 'Show Header Breadcrumbs', 'gutentype' ),
                    'desc'     => wp_kses_data( __( 'Show Page Breadcrumbs', 'gutentype' ) ),
                    'override' => array(
                        'mode'    => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
                        'section' => esc_html__( 'Header', 'gutentype' ),
                    ),
                    'std'      => 1,
                    'type'     => GUTENTYPE_THEME_FREE ? 'hidden' : 'checkbox',
                ),

				'header_widgets_info'           => array(
					'title' => esc_html__( 'Header widgets', 'gutentype' ),
					'desc'  => wp_kses_data( __( 'Here you can place a widget slider, advertising banners, etc.', 'gutentype' ) ),
					'type'  => 'info',
				),
				'header_widgets'                => array(
					'title'    => esc_html__( 'Header widgets', 'gutentype' ),
					'desc'     => wp_kses_data( __( 'Select set of widgets to show in the header on each page', 'gutentype' ) ),
					'override' => array(
						'mode'    => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
						'section' => esc_html__( 'Header', 'gutentype' ),
						'desc'    => wp_kses_data( __( 'Select set of widgets to show in the header on this page', 'gutentype' ) ),
					),
					'std'      => 'hide',
					'options'  => array(),
					'type'     => 'select',
				),
				'header_columns'                => array(
					'title'      => esc_html__( 'Header columns', 'gutentype' ),
					'desc'       => wp_kses_data( __( 'Select number columns to show widgets in the Header. If 0 - autodetect by the widgets count', 'gutentype' ) ),
					'override'   => array(
						'mode'    => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
						'section' => esc_html__( 'Header', 'gutentype' ),
					),
					'dependency' => array(
						'header_type'    => array( 'default' ),
						'header_widgets' => array( '^hide' ),
					),
					'std'        => 0,
					'options'    => gutentype_get_list_range( 0, 6 ),
					'type'       => 'select',
				),

                'header_widgets_below'                => array(
                    'title'    => esc_html__( 'Header widgets (below)', 'gutentype' ),
                    'desc'     => wp_kses_data( __( 'Select set of widgets to show below the header on each page', 'gutentype' ) ),
                    'override' => array(
                        'mode'    => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
                        'section' => esc_html__( 'Header', 'gutentype' ),
                        'desc'    => wp_kses_data( __( 'Select set of widgets to show in the header on this page', 'gutentype' ) ),
                    ),
                    'std'      => 'hide',
                    'options'  => array(),
                    'type'     => 'select',
                ),

				'header_columns_below'                => array(
				  'title'      => esc_html__( 'Header widgets (below) columns', 'gutentype' ),
				  'desc'       => wp_kses_data( __( 'Select number columns to show widgets in the Header. If 0 - autodetect by the widgets count', 'gutentype' ) ),
				  'override'   => array(
					'mode'    => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__( 'Header', 'gutentype' ),
				  ),
				  'dependency' => array(
					'header_type'    => array( 'default' ),
					'header_widgets_below' => array( '^hide' ),
				  ),
				  'std'        => 0,
				  'options'    => gutentype_get_list_range( 0, 6 ),
				  'type'       => 'select',
				),

				'header_subtitle'                     => array(
				  'title'      => esc_html__( 'Header Subtitle', 'gutentype' ),
				  'desc'       => wp_kses_data( __( 'Header Subtitle text in the header.', 'gutentype' ) ),
				  'std'        => '',
				  'override' => array(
					'mode'    => 'post,page',
					'section' => esc_html__( 'Header', 'gutentype' ),
				  ),
				  'type'       => 'textarea',
				),



				'menu_info'                     => array(
					'title' => esc_html__( 'Main menu', 'gutentype' ),
					'desc'  => wp_kses_data( __( 'Select main menu style, position and other parameters', 'gutentype' ) ),
					'type'  => GUTENTYPE_THEME_FREE ? 'hidden' : 'info',
				),
				'menu_style'                    => array(
					'title'    => esc_html__( 'Menu position', 'gutentype' ),
					'desc'     => wp_kses_data( __( 'Select position of the main menu', 'gutentype' ) ),
					'override' => array(
						'mode'    => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
						'section' => esc_html__( 'Header', 'gutentype' ),
					),
					'std'      => 'top',
					'options'  => array(
						'top'   => esc_html__( 'Top', 'gutentype' ),
					),
					'type'     => GUTENTYPE_THEME_FREE || ! gutentype_exists_trx_addons() ? 'hidden' : 'switch',
				),
				'menu_side_stretch'             => array(
					'title'      => esc_html__( 'Stretch sidemenu', 'gutentype' ),
					'desc'       => wp_kses_data( __( 'Stretch sidemenu to window height (if menu items number >= 5)', 'gutentype' ) ),
					'override'   => array(
						'mode'    => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
						'section' => esc_html__( 'Header', 'gutentype' ),
					),
					'dependency' => array(
						'menu_style' => array( 'left', 'right' ),
					),
					'std'        => 0,
					'type'       => GUTENTYPE_THEME_FREE ? 'hidden' : 'checkbox',
				),
				'menu_side_icons'               => array(
					'title'      => esc_html__( 'Iconed sidemenu', 'gutentype' ),
					'desc'       => wp_kses_data( __( 'Get icons from anchors and display it in the sidemenu or mark sidemenu items with simple dots', 'gutentype' ) ),
					'override'   => array(
						'mode'    => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
						'section' => esc_html__( 'Header', 'gutentype' ),
					),
					'dependency' => array(
						'menu_style' => array( 'left', 'right' ),
					),
					'std'        => 1,
					'type'       => GUTENTYPE_THEME_FREE ? 'hidden' : 'checkbox',
				),
				'menu_mobile_fullscreen'        => array(
					'title' => esc_html__( 'Mobile menu fullscreen', 'gutentype' ),
					'desc'  => wp_kses_data( __( 'Display mobile and side menus on full screen (if checked) or slide narrow menu from the left or from the right side (if not checked)', 'gutentype' ) ),
					'std'   => 1,
					'type'  => GUTENTYPE_THEME_FREE ? 'hidden' : 'checkbox',
				),

				'header_image_info'             => array(
					'title' => esc_html__( 'Header image', 'gutentype' ),
					'desc'  => '',
					'type'  => GUTENTYPE_THEME_FREE ? 'hidden' : 'info',
				),
				'header_image_override'         => array(
					'title'    => esc_html__( 'Header image override', 'gutentype' ),
					'desc'     => wp_kses_data( __( "Allow override the header image with the page's/post's/product's/etc. featured image", 'gutentype' ) ),
					'override' => array(
						'mode'    => 'page,post',
						'section' => esc_html__( 'Header', 'gutentype' ),
					),
					'std'      => 0,
					'type'     => GUTENTYPE_THEME_FREE ? 'hidden' : 'checkbox',
				),
                'use_header_background_color'         => array(
                    'title'    => esc_html__( 'Header alternative background color', 'gutentype' ),
                    'desc'     => wp_kses_data( __( "Use alternative header background color.", 'gutentype' ) ),
                    'override' => array(
                        'mode'    => 'page,post',
                        'section' => esc_html__( 'Header', 'gutentype' ),
                    ),
                    'std'      => 0,
                    'type'     => GUTENTYPE_THEME_FREE ? 'hidden' : 'checkbox',
                ),
                'header_background_color'         => array(
                    'title'    => esc_html__( 'Header alternative background color', 'gutentype' ),
                    'desc'     => wp_kses_data( __( "Use alternative header background color.", 'gutentype' ) ),
                    'override' => array(
                        'mode'    => 'page,post',
                        'section' => esc_html__( 'Header', 'gutentype' ),
                    ),
                    'dependency' => array(
                        'use_header_background_color' => array( 1 ),
                    ),
                    'std'      => '',
                    'type'     => 'color',
                ),

				'header_mobile_info'            => array(
					'title'      => esc_html__( 'Mobile header', 'gutentype' ),
					'desc'       => wp_kses_data( __( 'Configure the mobile version of the header', 'gutentype' ) ),
					'priority'   => 500,
					'dependency' => array(
						'header_type' => array( 'default' ),
					),
					'type'       => 'hidden',
				),
				'header_mobile_enabled'         => array(
					'title'      => esc_html__( 'Enable the mobile header', 'gutentype' ),
					'desc'       => wp_kses_data( __( 'Use the mobile version of the header (if checked) or relayout the current header on mobile devices', 'gutentype' ) ),
					'dependency' => array(
					  'header_type' => array( 'default', 'plain', 'extra', 'side', 'featured'),
					),
					'std'        => 0,
					'type'       => 'hidden',
				),
				'header_mobile_additional_info' => array(
					'title'      => esc_html__( 'Additional info', 'gutentype' ),
					'desc'       => wp_kses_data( __( 'Additional info to show at the top of the mobile header', 'gutentype' ) ),
					'std'        => '',
					'dependency' => array(
						'header_type'           => array( 'default' ),
						'header_mobile_enabled' => array( 1 ),
					),
					'refresh'    => false,
					'teeny'      => false,
					'rows'       => 20,
					'type'       => GUTENTYPE_THEME_FREE ? 'hidden' : 'text_editor',
				),
				'header_mobile_hide_info'       => array(
					'title'      => esc_html__( 'Hide additional info', 'gutentype' ),
					'std'        => 0,
					'dependency' => array(
						'header_type'           => array( 'default' ),
						'header_mobile_enabled' => array( 1 ),
					),
					'type'       => GUTENTYPE_THEME_FREE ? 'hidden' : 'checkbox',
				),
				'header_mobile_hide_logo'       => array(
					'title'      => esc_html__( 'Hide logo', 'gutentype' ),
					'std'        => 0,
					'dependency' => array(
						'header_type'           => array( 'default' ),
						'header_mobile_enabled' => array( 1 ),
					),
					'type'       => GUTENTYPE_THEME_FREE ? 'hidden' : 'checkbox',
				),
				'header_mobile_hide_login'      => array(
					'title'      => esc_html__( 'Hide login/logout', 'gutentype' ),
					'std'        => 0,
					'dependency' => array(
						'header_type'           => array( 'default' ),
						'header_mobile_enabled' => array( 1 ),
					),
					'type'       => GUTENTYPE_THEME_FREE ? 'hidden' : 'checkbox',
				),
				'header_mobile_hide_search'     => array(
					'title'      => esc_html__( 'Hide search', 'gutentype' ),
					'std'        => 0,
					'dependency' => array(
						'header_type'           => array( 'default' ),
						'header_mobile_enabled' => array( 1 ),
					),
					'type'       => GUTENTYPE_THEME_FREE ? 'hidden' : 'checkbox',
				),
				'header_mobile_hide_cart'       => array(
					'title'      => esc_html__( 'Hide cart', 'gutentype' ),
					'std'        => 0,
					'dependency' => array(
						'header_type'           => array( 'default' ),
						'header_mobile_enabled' => array( 1 ),
					),
					'type'       => GUTENTYPE_THEME_FREE ? 'hidden' : 'checkbox',
				),

				// 'Footer'
				'footer'                        => array(
					'title'    => esc_html__( 'Footer', 'gutentype' ),
					'desc'     => wp_kses_data( $msg_override ),
					'priority' => 50,
					'type'     => 'section',
				),
				'footer_type'                   => array(
					'title'    => esc_html__( 'Footer style', 'gutentype' ),
					'desc'     => wp_kses_data( __( 'Choose whether to use the default footer or footer Layouts (available only if the ThemeREX Addons is activated)', 'gutentype' ) ),
					'override' => array(
						'mode'    => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
						'section' => esc_html__( 'Footer', 'gutentype' ),
					),
					'std'      => 'default',
					'options'  => gutentype_get_list_header_footer_types(),
					'type'     => GUTENTYPE_THEME_FREE || ! gutentype_exists_trx_addons() ? 'hidden' : 'switch',
				),
				'footer_style'                  => array(
					'title'      => esc_html__( 'Select custom layout', 'gutentype' ),
					'desc'       => esc_html__( 'Select custom footer from Layouts Builder', 'gutentype' ),
					'override'   => array(
						'mode'    => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
						'section' => esc_html__( 'Footer', 'gutentype' ),
					),
					'dependency' => array(
						'footer_type' => array( 'custom' ),
					),
					'std'        => GUTENTYPE_THEME_FREE ? 'footer-custom-elementor-footer-default' : 'footer-custom-footer-default',
					'options'    => array(),
					'type'       => 'select',
				),
				'footer_widgets'                => array(
					'title'      => esc_html__( 'Footer widgets', 'gutentype' ),
					'desc'       => wp_kses_data( __( 'Select set of widgets to show in the footer', 'gutentype' ) ),
					'override'   => array(
						'mode'    => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
						'section' => esc_html__( 'Footer', 'gutentype' ),
					),
					'dependency' => array(
						'footer_type' => array( 'default', 'plain', 'simple', 'modern', 'center' ),
					),
					'std'        => 'footer_widgets',
					'options'    => array(),
					'type'       => 'select',
				),
				'footer_columns'                => array(
					'title'      => esc_html__( 'Footer columns', 'gutentype' ),
					'desc'       => wp_kses_data( __( 'Select number columns to show widgets in the footer. If 0 - autodetect by the widgets count', 'gutentype' ) ),
					'override'   => array(
						'mode'    => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
						'section' => esc_html__( 'Footer', 'gutentype' ),
					),
					'dependency' => array(
						'footer_type'    => array( 'default', 'plain', 'simple', 'modern', 'center' ),
						'footer_widgets' => array( '^hide' ),
					),
					'std'        => 0,
					'options'    => gutentype_get_list_range( 0, 6 ),
					'type'       => 'select',
				),
				'footer_wide'                   => array(
					'title'      => esc_html__( 'Footer fullwidth', 'gutentype' ),
					'desc'       => wp_kses_data( __( 'Do you want to stretch the footer to the entire window width?', 'gutentype' ) ),
					'override'   => array(
						'mode'    => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
						'section' => esc_html__( 'Footer', 'gutentype' ),
					),
					'dependency' => array(
						'footer_type' => array( 'default', 'plain', 'simple', 'modern', 'center' ),
					),
					'std'        => 0,
					'type'       => 'checkbox',
				),
                'menu_in_footer'                => array(
                    'title'      => esc_html__( 'Show Menu', 'gutentype' ),
                    'desc'       => wp_kses_data( __( 'Show menu in the footer', 'gutentype' ) ),
                    'refresh'    => false,
                    'override'   => array(
                        'mode'    => 'page',
                        'section' => esc_html__( 'Footer', 'gutentype' ),
                    ),
                    'dependency' => array(
                        'footer_type' => array( 'default', 'simple', 'modern', 'center' ),
                    ),
                    'std'        => 1,
                    'type'       => 'checkbox',
                ),
				'logo_in_footer'                => array(
					'title'      => esc_html__( 'Show logo', 'gutentype' ),
					'desc'       => wp_kses_data( __( 'Show logo in the footer', 'gutentype' ) ),
					'refresh'    => false,
                    'override'   => array(
                        'mode'    => 'page',
                        'section' => esc_html__( 'Footer', 'gutentype' ),
                    ),
					'dependency' => array(
						'footer_type' => array( 'default', 'simple', 'modern', 'center' ),
					),
					'std'        => 0,
					'type'       => 'checkbox',
				),
				'logo_footer'                   => array(
					'title'      => esc_html__( 'Logo for footer', 'gutentype' ),
					'desc'       => wp_kses_data( __( 'Select or upload site logo to display it in the footer', 'gutentype' ) ),
					'dependency' => array(
						'footer_type'    => array( 'default', 'modern', 'center' ),
						'logo_in_footer' => array( 1 ),
					),
                    'override'   => array(
                        'mode'    => 'page',
                        'section' => esc_html__( 'Footer', 'gutentype' ),
                    ),
					'std'        => '',
					'type'       => 'image',
				),
				'logo_footer_retina'            => array(
					'title'      => esc_html__( 'Logo for footer (Retina)', 'gutentype' ),
					'desc'       => wp_kses_data( __( 'Select or upload logo for the footer area used on Retina displays (if empty - use default logo from the field above)', 'gutentype' ) ),
					'dependency' => array(
						'footer_type'         => array( 'default', 'modern', 'center' ),
						'logo_in_footer'      => array( 1 ),
						'logo_retina_enabled' => array( 1 ),
					),
                    'override'   => array(
                        'mode'    => 'page',
                        'section' => esc_html__( 'Footer', 'gutentype' ),
                    ),
					'std'        => '',
					'type'       => GUTENTYPE_THEME_FREE ? 'hidden' : 'image',
				),
				'socials_in_footer'             => array(
					'title'      => esc_html__( 'Show social icons', 'gutentype' ),
					'desc'       => wp_kses_data( __( 'Show social icons in the footer (under logo or footer widgets)', 'gutentype' ) ),
                    'override'   => array(
                        'mode'    => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
                        'section' => esc_html__( 'Footer', 'gutentype' ),
                    ),
                    'dependency' => array(
						'footer_type' => array( 'default', 'plain', 'simple', 'modern', 'center' ),
					),
					'std'        => 0,
					'type'       => ! gutentype_exists_trx_addons() ? 'hidden' : 'checkbox',
				),
				'copyright'                     => array(
					'title'      => esc_html__( 'Copyright', 'gutentype' ),
					'desc'       => wp_kses_data( __( 'Copyright text in the footer. Use {Y} to insert current year and press "Enter" to create a new line', 'gutentype' ) ),
					'translate'  => true,
					'std'        => esc_html__( 'AncoraThemes &copy; {Y}. All rights reserved.', 'gutentype' ),
					'dependency' => array(
						'footer_type' => array( 'default', 'plain', 'simple', 'modern', 'center' ),
					),
					'refresh'    => false,
					'type'       => 'textarea',
				),

				// 'Blog'
				'blog'                          => array(
					'title'    => esc_html__( 'Blog', 'gutentype' ),
					'desc'     => wp_kses_data( __( 'Options of the the blog archive', 'gutentype' ) ),
					'priority' => 70,
					'type'     => 'panel',
				),

				// Blog - Posts page
				'blog_general'                  => array(
					'title' => esc_html__( 'Posts page', 'gutentype' ),
					'desc'  => wp_kses_data( __( 'Style and components of the blog archive', 'gutentype' ) ),
					'type'  => 'section',
				),
				'blog_general_info'             => array(
					'title'  => esc_html__( 'Posts page settings', 'gutentype' ),
					'desc'   => '',
					'qsetup' => esc_html__( 'General', 'gutentype' ),
					'type'   => 'info',
				),
				'blog_style'                    => array(
					'title'      => esc_html__( 'Blog style', 'gutentype' ),
					'desc'       => '',
					'override'   => array(
						'mode'    => 'page',
						'section' => esc_html__( 'Content', 'gutentype' ),
					),
					'dependency' => array(
					    'compare' => 'or',
                        '#page_template' => array( 'blog.php' ),
                        '.editor-page-attributes__template select' => array( 'blog.php' ),
					),
					'std'        => 'excerpt',
					'qsetup'     => esc_html__( 'General', 'gutentype' ),
					'options'    => array(),
					'type'       => 'select',
				),
				'first_post_large'              => array(
					'title'      => esc_html__( 'First post large', 'gutentype' ),
					'desc'       => wp_kses_data( __( 'Make your first post stand out by making it bigger', 'gutentype' ) ),
					'override'   => array(
						'mode'    => 'page',
						'section' => esc_html__( 'Content', 'gutentype' ),
					),
					'dependency' => array(
                        'compare' => 'or',
                        '#page_template' => array( 'blog.php' ),
                        '.editor-page-attributes__template select' => array( 'blog.php' ),
						'blog_style'     => array( 'classic', 'masonry' ),
					),
					'std'        => 0,
					'type'       => 'hidden',
				),
				'blog_content'                  => array(
					'title'      => esc_html__( 'Posts content', 'gutentype' ),
					'desc'       => wp_kses_data( __( 'Display either post excerpts or the full post content', 'gutentype' ) ),
					'std'        => 'excerpt',
					'dependency' => array(
						'blog_style' => array( 'excerpt' ),
					),
					'options'    => array(
						'excerpt'  => esc_html__( 'Excerpt', 'gutentype' ),
						'fullpost' => esc_html__( 'Full post', 'gutentype' ),
					),
					'type'       => 'switch',
				),
				'excerpt_length'                => array(
					'title'      => esc_html__( 'Excerpt length', 'gutentype' ),
					'desc'       => wp_kses_data( __( 'Length (in words) to generate excerpt from the post content. Attention! If the post excerpt is explicitly specified - it appears unchanged', 'gutentype' ) ),
					'dependency' => array(
						'blog_style'   => array( 'excerpt' ),
						'blog_content' => array( 'excerpt' ),
					),
					'std'        => 62,
					'type'       => 'text',
				),
				'blog_columns'                  => array(
					'title'   => esc_html__( 'Blog columns', 'gutentype' ),
					'desc'    => wp_kses_data( __( 'How many columns should be used in the blog archive (from 2 to 4)?', 'gutentype' ) ),
					'std'     => 2,
					'options' => gutentype_get_list_range( 2, 4 ),
					'type'    => 'hidden',      // This options is available and must be overriden only for some modes (for example, 'shop')
				),
				'post_type'                     => array(
					'title'      => esc_html__( 'Post type', 'gutentype' ),
					'desc'       => wp_kses_data( __( 'Select post type to show in the blog archive', 'gutentype' ) ),
					'override'   => array(
						'mode'    => 'page',
						'section' => esc_html__( 'Content', 'gutentype' ),
					),
                    'dependency' => array(
                        'compare' => 'or',
                        '#page_template' => array( 'blog.php' ),
                        '.editor-page-attributes__template select' => array( 'blog.php' ),
                    ),
					'linked'     => 'parent_cat',
					'refresh'    => false,
					'hidden'     => true,
					'std'        => 'post',
					'options'    => array(),
					'type'       => 'select',
				),
				'parent_cat'                    => array(
					'title'      => esc_html__( 'Category to show', 'gutentype' ),
					'desc'       => wp_kses_data( __( 'Select category to show in the blog archive', 'gutentype' ) ),
					'override'   => array(
						'mode'    => 'page',
						'section' => esc_html__( 'Content', 'gutentype' ),
					),
                    'dependency' => array(
                        'compare' => 'or',
                        '#page_template' => array( 'blog.php' ),
                        '.editor-page-attributes__template select' => array( 'blog.php' ),
                    ),
					'refresh'    => false,
					'hidden'     => true,
					'std'        => '0=1',
					'options'    => array(),
					'dir'        => 'vertical',
					'sortable'   => false,
					'type'       => 'checklist',
				),
				'posts_per_page'                => array(
					'title'      => esc_html__( 'Posts per page', 'gutentype' ),
					'desc'       => wp_kses_data( __( 'How many posts will be displayed on this page', 'gutentype' ) ),
					'override'   => array(
						'mode'    => 'page',
						'section' => esc_html__( 'Content', 'gutentype' ),
					),
                    'dependency' => array(
                        'compare' => 'or',
                        '#page_template' => array( 'blog.php' ),
                        '.editor-page-attributes__template select' => array( 'blog.php' ),
                    ),
					'hidden'     => true,
					'std'        => '',
					'type'       => 'text',
				),
				'blog_pagination'               => array(
					'title'      => esc_html__( 'Pagination style', 'gutentype' ),
					'desc'       => wp_kses_data( __( 'Show Older/Newest posts or Page numbers below the posts list', 'gutentype' ) ),
					'override'   => array(
						'mode'    => 'page',
						'section' => esc_html__( 'Content', 'gutentype' ),
					),
					'std'        => 'pages',
					'qsetup'     => esc_html__( 'General', 'gutentype' ),
                    'dependency' => array(
                        'compare' => 'or',
                        '#page_template' => array( 'blog.php' ),
                        '.editor-page-attributes__template select' => array( 'blog.php' ),
                    ),
					'options'    => array(
						'pages'    => esc_html__( 'Page numbers', 'gutentype' ),
						'links'    => esc_html__( 'Older/Newest', 'gutentype' ),
						'more'     => esc_html__( 'Load more', 'gutentype' ),
						'infinite' => esc_html__( 'Infinite scroll', 'gutentype' ),
					),
					'type'       => 'select',
				),

				'show_filters'                  => array(
					'title'      => esc_html__( 'Show filters', 'gutentype' ),
					'desc'       => wp_kses_data( __( 'Show categories as tabs to filter posts', 'gutentype' ) ),
					'override'   => array(
						'mode'    => 'page',
						'section' => esc_html__( 'Content', 'gutentype' ),
					),
					'dependency' => array(
                        '#page_template' => array( 'blog.php' ),
                        '.editor-page-attributes__template select' => array( 'blog.php' ),
						'blog_style'     => array( 'portfolio'),
					),
					'hidden'     => true,
					'std'        => 0,
					'type'       => GUTENTYPE_THEME_FREE ? 'hidden' : 'checkbox',
				),

				'blog_sidebar_info'             => array(
					'title' => esc_html__( 'Sidebar', 'gutentype' ),
					'desc'  => '',
					'type'  => 'info',
				),
				'sidebar_position_blog'         => array(
					'title'   => esc_html__( 'Sidebar position', 'gutentype' ),
					'desc'    => wp_kses_data( __( 'Select position to show sidebar', 'gutentype' ) ),
					'std'     => 'right',
					'options' => array(),
					'qsetup'     => esc_html__( 'General', 'gutentype' ),
					'type'    => 'switch',
				),
				'sidebar_widgets_blog'          => array(
					'title'      => esc_html__( 'Sidebar widgets', 'gutentype' ),
					'desc'       => wp_kses_data( __( 'Select default widgets to show in the sidebar', 'gutentype' ) ),
					'dependency' => array(
						'sidebar_position_blog' => array( 'left', 'right' ),
					),
					'std'        => 'sidebar_widgets',
					'options'    => array(),
					'qsetup'     => esc_html__( 'General', 'gutentype' ),
					'type'       => 'select',
				),
				'expand_content_blog'           => array(
					'title'   => esc_html__( 'Expand content', 'gutentype' ),
					'desc'    => wp_kses_data( __( 'Expand the content width if the sidebar is hidden', 'gutentype' ) ),
					'refresh' => false,
					'std'     => 1,
					'type'    => 'checkbox',
				),

				'blog_widgets_info'             => array(
					'title' => esc_html__( 'Additional widgets', 'gutentype' ),
					'desc'  => '',
					'type'  => GUTENTYPE_THEME_FREE ? 'hidden' : 'info',
				),
				'widgets_above_page_blog'       => array(
					'title'   => esc_html__( 'Widgets at the top of the page', 'gutentype' ),
					'desc'    => wp_kses_data( __( 'Select widgets to show at the top of the page (above content and sidebar)', 'gutentype' ) ),
					'std'     => 'hide',
					'options' => array(),
					'type'    => GUTENTYPE_THEME_FREE ? 'hidden' : 'select',
				),
				'widgets_above_content_blog'    => array(
					'title'   => esc_html__( 'Widgets above the content', 'gutentype' ),
					'desc'    => wp_kses_data( __( 'Select widgets to show at the beginning of the content area', 'gutentype' ) ),
					'std'     => 'hide',
					'options' => array(),
					'type'    => GUTENTYPE_THEME_FREE ? 'hidden' : 'select',
				),
				'widgets_below_content_blog'    => array(
					'title'   => esc_html__( 'Widgets below the content', 'gutentype' ),
					'desc'    => wp_kses_data( __( 'Select widgets to show at the ending of the content area', 'gutentype' ) ),
					'std'     => 'hide',
					'options' => array(),
					'type'    => GUTENTYPE_THEME_FREE ? 'hidden' : 'select',
				),
				'widgets_below_page_blog'       => array(
					'title'   => esc_html__( 'Widgets at the bottom of the page', 'gutentype' ),
					'desc'    => wp_kses_data( __( 'Select widgets to show at the bottom of the page (below content and sidebar)', 'gutentype' ) ),
					'std'     => 'hide',
					'options' => array(),
					'type'    => GUTENTYPE_THEME_FREE ? 'hidden' : 'select',
				),

				'blog_advanced_info'            => array(
					'title' => esc_html__( 'Advanced settings', 'gutentype' ),
					'desc'  => '',
					'type'  => 'info',
				),
				'no_image'                      => array(
					'title' => esc_html__( 'Image placeholder', 'gutentype' ),
					'desc'  => wp_kses_data( __( 'Select or upload an image used as placeholder for posts without a featured image', 'gutentype' ) ),
					'std'   => '',
					'type'  => 'image',
				),
				'time_diff_before'              => array(
					'title' => esc_html__( 'Easy Readable Date Format', 'gutentype' ),
					'desc'  => wp_kses_data( __( "For how many days to show the easy-readable date format (e.g. '3 days ago') instead of the standard publication date", 'gutentype' ) ),
					'std'   => 5,
					'type'  => 'text',
				),
				'sticky_style'                  => array(
					'title'   => esc_html__( 'Sticky posts style', 'gutentype' ),
					'desc'    => wp_kses_data( __( 'Select style of the sticky posts output', 'gutentype' ) ),
					'std'     => 'inherit',
					'options' => array(
						'inherit' => esc_html__( 'Decorated posts', 'gutentype' ),
						'columns' => esc_html__( 'Mini-cards', 'gutentype' ),
					),
					'type'    => 'hidden',
				),
				'meta_parts'                    => array(
					'title'      => esc_html__( 'Post meta', 'gutentype' ),
					'desc'       => wp_kses_data( __( "If your blog page is created using the 'Blog archive' page template, set up the 'Post Meta' settings in the 'Theme Options' section of that page. Post counters and Share Links are available only if plugin ThemeREX Addons is active", 'gutentype' ) )
								. '<br>'
								. wp_kses_data( __( '<b>Tip:</b> Drag items to change their order.', 'gutentype' ) ),
					'override'   => array(
						'mode'    => 'page',
						'section' => esc_html__( 'Content', 'gutentype' ),
					),
                    'dependency' => array(
                        'compare' => 'or',
                        '#page_template' => array( 'blog.php' ),
                        '.editor-page-attributes__template select' => array( 'blog.php' ),
                    ),
					'dir'        => 'vertical',
					'sortable'   => true,
					'std'        => 'author=1|categories=1|date=1|counters=0|share=0|edit=0',
					'options'    => gutentype_get_list_meta_parts(),
					'type'       => GUTENTYPE_THEME_FREE ? 'hidden' : 'checklist',
				),
				'counters'                      => array(
					'title'      => esc_html__( 'Post counters', 'gutentype' ),
					'desc'       => wp_kses_data( __( 'Show only selected counters. Attention! Likes and Views are available only if ThemeREX Addons is active', 'gutentype' ) ),
					'override'   => array(
						'mode'    => 'page',
						'section' => esc_html__( 'Content', 'gutentype' ),
					),
                    'dependency' => array(
                        'compare' => 'or',
                        '#page_template' => array( 'blog.php' ),
                        '.editor-page-attributes__template select' => array( 'blog.php' ),
                    ),
					'dir'        => 'vertical',
					'sortable'   => true,
					'std'        => 'views=1|likes=1|comments=1',
					'options'    => gutentype_get_list_counters(),
					'type'       => GUTENTYPE_THEME_FREE || ! gutentype_exists_trx_addons() ? 'hidden' : 'checklist',
				),

				// Blog - Single posts
				'blog_single'                   => array(
					'title' => esc_html__( 'Single posts', 'gutentype' ),
					'desc'  => wp_kses_data( __( 'Settings of the single post', 'gutentype' ) ),
					'type'  => 'section',
				),
				'hide_featured_on_single'       => array(
					'title'    => esc_html__( 'Hide featured image on the single post', 'gutentype' ),
					'desc'     => wp_kses_data( __( "Hide featured image on the single post's pages", 'gutentype' ) ),
					'override' => array(
						'mode'    => 'page,post',
						'section' => esc_html__( 'Content', 'gutentype' ),
					),
					'std'      => 0,
					'type'     => 'checkbox',
				),
                'extra_featured_on_single'       => array(
                    'title'    => esc_html__( 'Stretch featured image on the single post', 'gutentype' ),
                    'desc'     => wp_kses_data( __( "Stretch featured image on the single post's pages", 'gutentype' ) ),
                    'override' => array(
                        'mode'    => 'page,post',
                        'section' => esc_html__( 'Content', 'gutentype' ),
                    ),
                    'std'      => 0,
                    'type'     => 'checkbox',
                ),
				'hide_sidebar_on_single'        => array(
					'title' => esc_html__( 'Hide sidebar on the single post', 'gutentype' ),
					'desc'  => wp_kses_data( __( "Hide sidebar on the single post's pages", 'gutentype' ) ),
					'std'   => 0,
					'type'  => 'hidden',
				),


                'sidebar_position_post'         => array(
                    'title'   => esc_html__( 'Sidebar position', 'gutentype' ),
                    'desc'    => wp_kses_data( __( 'Select position to show sidebar on the single post\'s pages', 'gutentype' ) ),
                    'std'     => 'hide',
                    'options' => array(),
                    'type'    => 'switch',
                ),
                'sidebar_widgets_post'          => array(
                    'title'      => esc_html__( 'Sidebar widgets', 'gutentype' ),
                    'desc'       => wp_kses_data( __( 'Select default widgets to show in the sidebar', 'gutentype' ) ),
                    'dependency' => array(
                        'sidebar_position_post' => array( 'left', 'right' ),
                    ),
                    'std'        => 'sidebar_widgets',
                    'options'    => array(),
                    'type'       => 'select',
                ),


                'expand_content_post'                => array(
                    'title'   => esc_html__( 'Expand content on the single post', 'gutentype' ),
                    'desc'    => wp_kses_data( __( 'Expand the content width if the sidebar is hidden', 'gutentype' ) ),
                    'refresh' => false,
                    'std'     => 0,
                    'type'    => 'checkbox',
                    'override' => array(
                        'mode'    => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
                        'section' => esc_html__( 'Content', 'gutentype' ),
                    ),
                ),
				'show_post_meta'                => array(
					'title' => esc_html__( 'Show post meta', 'gutentype' ),
					'desc'  => wp_kses_data( __( "Display block with post's meta: date, categories, counters, etc.", 'gutentype' ) ),
					'std'   => 1,
					'type'  => 'checkbox',
				),
				'meta_parts_post'               => array(
					'title'      => esc_html__( 'Post meta', 'gutentype' ),
					'desc'       => wp_kses_data( __( 'Meta parts for single posts. Post counters and Share Links are available only if plugin ThemeREX Addons is active', 'gutentype' ) )
								. '<br>'
								. wp_kses_data( __( '<b>Tip:</b> Drag items to change their order.', 'gutentype' ) ),
					'dependency' => array(
						'show_post_meta' => array( 1 ),
					),
					'dir'        => 'vertical',
					'sortable'   => true,
					'std'        => 'author=1|categories=1|date=1|counters=0|share=0|edit=0',
					'options'    => gutentype_get_list_meta_parts(),
					'type'       => GUTENTYPE_THEME_FREE ? 'hidden' : 'checklist',
				),
				'counters_post'                 => array(
					'title'      => esc_html__( 'Post counters', 'gutentype' ),
					'desc'       => wp_kses_data( __( 'Show only selected counters. Attention! Likes and Views are available only if plugin ThemeREX Addons is active', 'gutentype' ) ),
					'dependency' => array(
						'show_post_meta' => array( 1 ),
					),
					'dir'        => 'vertical',
					'sortable'   => true,
					'std'        => 'views=1|likes=1|comments=1',
					'options'    => gutentype_get_list_counters(),
					'type'       => GUTENTYPE_THEME_FREE || ! gutentype_exists_trx_addons() ? 'hidden' : 'checklist',
				),
				'show_share_links'              => array(
					'title' => esc_html__( 'Show share links', 'gutentype' ),
					'desc'  => wp_kses_data( __( 'Display share links on the single post', 'gutentype' ) ),
					'std'   => 1,
					'type'  => ! gutentype_exists_trx_addons() ? 'hidden' : 'checkbox',
				),
				'show_author_info'              => array(
					'title' => esc_html__( 'Show author info', 'gutentype' ),
					'desc'  => wp_kses_data( __( "Display block with information about post's author", 'gutentype' ) ),
					'std'   => 1,
					'type'  => 'checkbox',
				),
				'blog_single_related_info'      => array(
					'title' => esc_html__( 'Related posts', 'gutentype' ),
					'desc'  => '',
                    'type'     => 'hidden',
				),
				'show_related_posts'            => array(
					'title'    => esc_html__( 'Show related posts', 'gutentype' ),
					'desc'     => wp_kses_data( __( "Show section 'Related posts' on the single post's pages", 'gutentype' ) ),
					'override' => array(
						'mode'    => 'page,post',
						'section' => esc_html__( 'Content', 'gutentype' ),
					),
					'std'      => 0,
					'type'     => 'checkbox',
				),
			
				'related_posts'                 => array(
					'title'      => esc_html__( 'Related posts', 'gutentype' ),
					'desc'       => wp_kses_data( __( 'How many related posts should be displayed in the single post? If 0 - no related posts are shown.', 'gutentype' ) ),
					'dependency' => array(
						'show_related_posts' => array( 1 ),
					),
					'std'        => 2,
					'options'    => gutentype_get_list_range( 1, 9 ),
					'type'       => GUTENTYPE_THEME_FREE ? 'hidden' : 'select',
				),
				'related_columns'               => array(
					'title'      => esc_html__( 'Related columns', 'gutentype' ),
					'desc'       => wp_kses_data( __( 'How many columns should be used to output related posts in the single page (from 2 to 4)?', 'gutentype' ) ),
					'dependency' => array(
						'show_related_posts' => array( 1 ),
					),
					'std'        => 2,
					'options'    => gutentype_get_list_range( 1, 4 ),
					'type'       => GUTENTYPE_THEME_FREE ? 'hidden' : 'switch',
				),
				'related_style'                 => array(
					'title'      => esc_html__( 'Related posts style', 'gutentype' ),
					'desc'       => wp_kses_data( __( 'Select style of the related posts output', 'gutentype' ) ),
					'dependency' => array(
						'show_related_posts' => array( 1 ),
					),
					'std'        => 2,
					'options'    => gutentype_get_list_styles( 1, 3 ),
					'type'       => 'hidden',
				),
				'related_slider'                => array(
					'title'      => esc_html__( 'Use slider layout', 'gutentype' ),
					'desc'       => wp_kses_data( __( 'Use slider layout in case related posts count is more than columns count', 'gutentype' ) ),
					'dependency' => array(
						'show_related_posts' => array( 1 ),
					),
					'std'        => 0,
					'type'       => 'hidden',
				),
				'related_slider_controls'       => array(
					'title'      => esc_html__( 'Slider controls', 'gutentype' ),
					'desc'       => wp_kses_data( __( 'Show arrows in the slider', 'gutentype' ) ),
					'dependency' => array(
						'show_related_posts' => array( 1 ),
						'related_slider' => array( 1 ),
					),
					'std'        => 'none',
					'options'    => array(
						'none'    => esc_html__('None', 'gutentype'),
						'side'    => esc_html__('Side', 'gutentype'),
						'outside' => esc_html__('Outside', 'gutentype'),
						'top'     => esc_html__('Top', 'gutentype'),
						'bottom'  => esc_html__('Bottom', 'gutentype')
					),
					'type'       => GUTENTYPE_THEME_FREE ? 'hidden' : 'select',
				),
				'related_slider_pagination'       => array(
					'title'      => esc_html__( 'Slider pagination', 'gutentype' ),
					'desc'       => wp_kses_data( __( 'Show bullets after the slider', 'gutentype' ) ),
					'dependency' => array(
						'show_related_posts' => array( 1 ),
						'related_slider' => array( 1 ),
					),
					'std'        => 'bottom',
					'options'    => array(
						'none'    => esc_html__('None', 'gutentype'),
						'bottom'  => esc_html__('Bottom', 'gutentype')
					),
					'type'       => GUTENTYPE_THEME_FREE ? 'hidden' : 'switch',
				),
				'related_slider_space'          => array(
					'title'      => esc_html__( 'Space', 'gutentype' ),
					'desc'       => wp_kses_data( __( 'Space between slides', 'gutentype' ) ),
					'dependency' => array(
						'show_related_posts' => array( 1 ),
						'related_slider' => array( 1 ),
					),
					'std'        => 30,
					'type'       => GUTENTYPE_THEME_FREE ? 'hidden' : 'text',
				),
				'related_position'              => array(
					'title'      => esc_html__( 'Related posts position', 'gutentype' ),
					'desc'       => wp_kses_data( __( 'Select position to display the related posts', 'gutentype' ) ),
					'dependency' => array(
						'show_related_posts' => array( 1 ),
					),
					'std'        => 'below_content',
					'options'    => array (
						'below_content' => esc_html__( 'After content', 'gutentype' ),
						'below_page'    => esc_html__( 'After content & sidebar', 'gutentype' ),
					),
					'type'       => 'hidden',
				),
				'show_posts_navigation'            => array(
					'title'    => esc_html__( 'Show posts navigation', 'gutentype' ),
					'desc'     => wp_kses_data( __( "Show Prev/Next links on the single post's pages", 'gutentype' ) ),
					'override' => array(
						'mode'    => 'post',
						'section' => esc_html__( 'Content', 'gutentype' ),
					),
					'std'      => 0,
					'type'     => 'checkbox',
				),
				'blog_end'                      => array(
					'type' => 'panel_end',
				),

				// 'Colors'
				'panel_colors'                  => array(
					'title'    => esc_html__( 'Colors', 'gutentype' ),
					'desc'     => '',
					'priority' => 300,
					'type'     => 'section',
				),

				'color_schemes_info'            => array(
					'title'  => esc_html__( 'Color schemes', 'gutentype' ),
					'desc'   => wp_kses_data( __( 'Color schemes for various parts of the site. "Inherit" means that this block is used the Site color scheme (the first parameter)', 'gutentype' ) ),
					'hidden' => $hide_schemes,
					'type'   => 'info',
				),
				'color_scheme'                  => array(
					'title'    => esc_html__( 'Site Color Scheme', 'gutentype' ),
					'desc'     => '',
					'override' => array(
						'mode'    => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
						'section' => esc_html__( 'Colors', 'gutentype' ),
					),
					'std'      => 'default',
					'options'  => array(),
					'refresh'  => false,
					'type'     => $hide_schemes ? 'hidden' : 'switch',
				),
				'header_scheme'                 => array(
					'title'    => esc_html__( 'Header Color Scheme', 'gutentype' ),
					'desc'     => '',
					'override' => array(
						'mode'    => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
						'section' => esc_html__( 'Colors', 'gutentype' ),
					),
					'std'      => 'inherit',
					'options'  => array(),
					'refresh'  => false,
					'type'     => $hide_schemes ? 'hidden' : 'switch',
				),
				'menu_scheme'                   => array(
					'title'    => esc_html__( 'Sidemenu Color Scheme', 'gutentype' ),
					'desc'     => '',
					'override' => array(
						'mode'    => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
						'section' => esc_html__( 'Colors', 'gutentype' ),
					),
					'std'      => 'inherit',
					'options'  => array(),
					'refresh'  => false,
					'type'     => 'hidden',
				),
				'sidebar_scheme'                => array(
					'title'    => esc_html__( 'Sidebar Color Scheme', 'gutentype' ),
					'desc'     => '',
					'override' => array(
						'mode'    => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
						'section' => esc_html__( 'Colors', 'gutentype' ),
					),
					'std'      => 'inherit',
					'options'  => array(),
					'refresh'  => false,
					'type'     => $hide_schemes ? 'hidden' : 'switch',
				),
				'footer_scheme'                 => array(
					'title'    => esc_html__( 'Footer Color Scheme', 'gutentype' ),
					'desc'     => '',
					'override' => array(
						'mode'    => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
						'section' => esc_html__( 'Colors', 'gutentype' ),
					),
					'std'      => 'default',
					'options'  => array(),
					'refresh'  => false,
					'type'     => $hide_schemes ? 'hidden' : 'switch',
				),

				'color_scheme_editor_info'      => array(
					'title' => esc_html__( 'Color scheme editor', 'gutentype' ),
					'desc'  => wp_kses_data( __( 'Select color scheme to modify. Attention! Only those sections in the site will be changed which this scheme was assigned to', 'gutentype' ) ),
					'type'  => 'info',
				),
				'scheme_storage'                => array(
					'title'       => esc_html__( 'Color scheme editor', 'gutentype' ),
					'desc'        => '',
					'std'         => '$gutentype_get_scheme_storage',
					'refresh'     => false,
					'colorpicker' => 'tiny',
					'type'        => 'scheme_editor',
				),

				// Internal options.
				// Attention! Don't change any options in the section below!
				// Use huge priority to call render this elements after all options!
				'reset_options'                 => array(
					'title'    => '',
					'desc'     => '',
					'std'      => '0',
					'priority' => 10000,
					'type'     => 'hidden',
				),

				'last_option'                   => array(     // Need to manually call action to include Tiny MCE scripts
					'title' => '',
					'desc'  => '',
					'std'   => 1,
					'type'  => 'hidden',
				),

			)
		);

		// Prepare panel 'Fonts'
		// -------------------------------------------------------------
		$fonts = array(

			// 'Fonts'
			'fonts'             => array(
				'title'    => esc_html__( 'Typography', 'gutentype' ),
				'desc'     => '',
				'priority' => 200,
				'type'     => 'panel',
			),

			// Fonts - Load_fonts
			'load_fonts'        => array(
				'title' => esc_html__( 'Load fonts', 'gutentype' ),
				'desc'  => wp_kses_data( __( 'Specify fonts to load when theme start. You can use them in the base theme elements: headers, text, menu, links, input fields, etc.', 'gutentype' ) )
						. '<br>'
						. wp_kses_data( __( 'Attention! Press "Refresh" button to reload preview area after the all fonts are changed', 'gutentype' ) ),
				'type'  => 'section',
			),
			'load_fonts_subset' => array(
				'title'   => esc_html__( 'Google fonts subsets', 'gutentype' ),
				'desc'    => wp_kses_data( __( 'Specify comma separated list of the subsets which will be load from Google fonts', 'gutentype' ) )
						. '<br>'
						. wp_kses_data( __( 'Available subsets are: latin,latin-ext,cyrillic,cyrillic-ext,greek,greek-ext,vietnamese', 'gutentype' ) ),
				'class'   => 'gutentype_column-1_3 gutentype_new_row',
				'refresh' => false,
				'std'     => '$gutentype_get_load_fonts_subset',
				'type'    => 'text',
			),
		);

		for ( $i = 1; $i <= gutentype_get_theme_setting( 'max_load_fonts' ); $i++ ) {
			if ( gutentype_get_value_gp( 'page' ) != 'theme_options' ) {
				$fonts[ "load_fonts-{$i}-info" ] = array(
					// Translators: Add font's number - 'Font 1', 'Font 2', etc
					'title' => esc_html( sprintf( __( 'Font %s', 'gutentype' ), $i ) ),
					'desc'  => '',
					'type'  => 'info',
				);
			}
			$fonts[ "load_fonts-{$i}-name" ]   = array(
				'title'   => esc_html__( 'Font name', 'gutentype' ),
				'desc'    => '',
				'class'   => 'gutentype_column-1_3 gutentype_new_row',
				'refresh' => false,
				'std'     => '$gutentype_get_load_fonts_option',
				'type'    => 'text',
			);
			$fonts[ "load_fonts-{$i}-family" ] = array(
				'title'   => esc_html__( 'Font family', 'gutentype' ),
				'desc'    => 1 == $i
							? wp_kses_data( __( 'Select font family to use it if font above is not available', 'gutentype' ) )
							: '',
				'class'   => 'gutentype_column-1_3',
				'refresh' => false,
				'std'     => '$gutentype_get_load_fonts_option',
				'options' => array(
					'inherit'    => esc_html__( 'Inherit', 'gutentype' ),
					'serif'      => esc_html__( 'serif', 'gutentype' ),
					'sans-serif' => esc_html__( 'sans-serif', 'gutentype' ),
					'monospace'  => esc_html__( 'monospace', 'gutentype' ),
					'cursive'    => esc_html__( 'cursive', 'gutentype' ),
					'fantasy'    => esc_html__( 'fantasy', 'gutentype' ),
				),
				'type'    => 'select',
			);
			$fonts[ "load_fonts-{$i}-styles" ] = array(
				'title'   => esc_html__( 'Font styles', 'gutentype' ),
				'desc'    => 1 == $i
							? wp_kses_data( __( 'Font styles used only for the Google fonts. This is a comma separated list of the font weight and styles. For example: 400,400italic,700', 'gutentype' ) )
								. '<br>'
								. wp_kses_data( __( 'Attention! Each weight and style increase download size! Specify only used weights and styles.', 'gutentype' ) )
							: '',
				'class'   => 'gutentype_column-1_3',
				'refresh' => false,
				'std'     => '$gutentype_get_load_fonts_option',
				'type'    => 'text',
			);
		}
		$fonts['load_fonts_end'] = array(
			'type' => 'section_end',
		);

		// Fonts - H1..6, P, Info, Menu, etc.
		$theme_fonts = gutentype_get_theme_fonts();
		foreach ( $theme_fonts as $tag => $v ) {
			$fonts[ "{$tag}_section" ] = array(
				'title' => ! empty( $v['title'] )
								? $v['title']
								// Translators: Add tag's name to make title 'H1 settings', 'P settings', etc.
								: esc_html( sprintf( __( '%s settings', 'gutentype' ), $tag ) ),
				'desc'  => ! empty( $v['description'] )
								? $v['description']
								// Translators: Add tag's name to make description
								: wp_kses_data( sprintf( __( 'Font settings of the "%s" tag.', 'gutentype' ), $tag ) ),
				'type'  => 'section',
			);

			foreach ( $v as $css_prop => $css_value ) {
				if ( in_array( $css_prop, array( 'title', 'description' ) ) ) {
					continue;
				}
				$options    = '';
				$type       = 'text';
				$load_order = 1;
				$title      = ucfirst( str_replace( '-', ' ', $css_prop ) );
				if ( 'font-family' == $css_prop ) {
					$type       = 'select';
					$options    = array();
					$load_order = 2;        // Load this option's value after all options are loaded (use option 'load_fonts' to build fonts list)
				} elseif ( 'font-weight' == $css_prop ) {
					$type    = 'select';
					$options = array(
						'inherit' => esc_html__( 'Inherit', 'gutentype' ),
						'100'     => esc_html__( '100 (Light)', 'gutentype' ),
						'200'     => esc_html__( '200 (Light)', 'gutentype' ),
						'300'     => esc_html__( '300 (Thin)', 'gutentype' ),
						'400'     => esc_html__( '400 (Normal)', 'gutentype' ),
						'500'     => esc_html__( '500 (Semibold)', 'gutentype' ),
						'600'     => esc_html__( '600 (Semibold)', 'gutentype' ),
						'700'     => esc_html__( '700 (Bold)', 'gutentype' ),
						'800'     => esc_html__( '800 (Black)', 'gutentype' ),
						'900'     => esc_html__( '900 (Black)', 'gutentype' ),
					);
				} elseif ( 'font-style' == $css_prop ) {
					$type    = 'select';
					$options = array(
						'inherit' => esc_html__( 'Inherit', 'gutentype' ),
						'normal'  => esc_html__( 'Normal', 'gutentype' ),
						'italic'  => esc_html__( 'Italic', 'gutentype' ),
					);
				} elseif ( 'text-decoration' == $css_prop ) {
					$type    = 'select';
					$options = array(
						'inherit'      => esc_html__( 'Inherit', 'gutentype' ),
						'none'         => esc_html__( 'None', 'gutentype' ),
						'underline'    => esc_html__( 'Underline', 'gutentype' ),
						'overline'     => esc_html__( 'Overline', 'gutentype' ),
						'line-through' => esc_html__( 'Line-through', 'gutentype' ),
					);
				} elseif ( 'text-transform' == $css_prop ) {
					$type    = 'select';
					$options = array(
						'inherit'    => esc_html__( 'Inherit', 'gutentype' ),
						'none'       => esc_html__( 'None', 'gutentype' ),
						'uppercase'  => esc_html__( 'Uppercase', 'gutentype' ),
						'lowercase'  => esc_html__( 'Lowercase', 'gutentype' ),
						'capitalize' => esc_html__( 'Capitalize', 'gutentype' ),
					);
				}
				$fonts[ "{$tag}_{$css_prop}" ] = array(
					'title'      => $title,
					'desc'       => '',
					'class'      => 'gutentype_column-1_5',
					'refresh'    => false,
					'load_order' => $load_order,
					'std'        => '$gutentype_get_theme_fonts_option',
					'options'    => $options,
					'type'       => $type,
				);
			}

			$fonts[ "{$tag}_section_end" ] = array(
				'type' => 'section_end',
			);
		}

		$fonts['fonts_end'] = array(
			'type' => 'panel_end',
		);

		// Add fonts parameters to Theme Options
		gutentype_storage_set_array_before( 'options', 'panel_colors', $fonts );

		// Add Header Video if WP version < 4.7
		// -----------------------------------------------------
		if ( ! function_exists( 'get_header_video_url' ) ) {
			gutentype_storage_set_array_after(
				'options', 'header_image_override', 'header_video', array(
					'title'    => esc_html__( 'Header video', 'gutentype' ),
					'desc'     => wp_kses_data( __( 'Select video to use it as background for the header', 'gutentype' ) ),
					'override' => array(
						'mode'    => 'page',
						'section' => esc_html__( 'Header', 'gutentype' ),
					),
					'std'      => '',
					'type'     => 'video',
				)
			);
		}

		// Add option 'logo' if WP version < 4.5
		// or 'custom_logo' if current page is 'Theme Options'
		// ------------------------------------------------------
		if ( ! function_exists( 'the_custom_logo' ) || ! gutentype_check_current_url( 'customize.php' ) ) {
			gutentype_storage_set_array_before(
				'options', 'logo_retina', function_exists( 'the_custom_logo' ) ? 'custom_logo' : 'logo', array(
					'title'    => esc_html__( 'Logo', 'gutentype' ),
					'desc'     => wp_kses_data( __( 'Select or upload the site logo', 'gutentype' ) ),
					'class'    => ( !empty( $_REQUEST['post'] ) && !empty( $_REQUEST['action'] ) && $_REQUEST['action'] == 'edit' ) ? '' : 'gutentype_column-1_2 gutentype_new_row',
					'priority' => 60,
					'std'      => '',
					'qsetup'   => esc_html__( 'General', 'gutentype' ),
					'type'     => 'image',
                    'override' => array(
                        'mode'    => 'page',
                        'section' => esc_html__( 'Header', 'gutentype' ),
                    ),
				)
			);
		}

	}
}


// Returns a list of options that can be overridden for CPT
if ( ! function_exists( 'gutentype_options_get_list_cpt_options' ) ) {
	function gutentype_options_get_list_cpt_options( $cpt, $title = '' ) {
		if ( empty( $title ) ) {
			$title = ucfirst( $cpt );
		}
		return array(
			"header_info_{$cpt}"            => array(
				'title' => esc_html__( 'Header', 'gutentype' ),
				'desc'  => '',
				'type'  => 'info',
			),
			"header_type_{$cpt}"            => array(
				'title'   => esc_html__( 'Header style', 'gutentype' ),
				'desc'    => wp_kses_data( __( 'Choose whether to use the default header or header Layouts (available only if the ThemeREX Addons is activated)', 'gutentype' ) ),
				'std'     => 'inherit',
				'options' => gutentype_get_list_header_types( true ),
				'type'    => GUTENTYPE_THEME_FREE ? 'hidden' : 'switch',
			),
			"header_style_{$cpt}"           => array(
				'title'      => esc_html__( 'Select custom layout', 'gutentype' ),
				// Translators: Add CPT name to the description
				'desc'       => wp_kses_data( sprintf( __( 'Select custom layout to display the site header on the %s pages', 'gutentype' ), $title ) ),
				'dependency' => array(
					"header_type_{$cpt}" => array( 'custom' ),
				),
				'std'        => 'inherit',
				'options'    => array(),
				'type'       => GUTENTYPE_THEME_FREE ? 'hidden' : 'select',
			),
			"header_position_{$cpt}"        => array(
				'title'   => esc_html__( 'Header position', 'gutentype' ),
				// Translators: Add CPT name to the description
				'desc'    => wp_kses_data( sprintf( __( 'Select position to display the site header on the %s pages', 'gutentype' ), $title ) ),
				'std'     => 'inherit',
				'options' => array(),
				'type'    => GUTENTYPE_THEME_FREE ? 'hidden' : 'switch',
			),
			"header_image_override_{$cpt}"  => array(
				'title'   => esc_html__( 'Header image override', 'gutentype' ),
				'desc'    => wp_kses_data( __( "Allow override the header image with the post's featured image", 'gutentype' ) ),
				'std'     => 'inherit',
				'options' => array(
					'inherit' => esc_html__( 'Inherit', 'gutentype' ),
					1         => esc_html__( 'Yes', 'gutentype' ),
					0         => esc_html__( 'No', 'gutentype' ),
				),
				'type'    => GUTENTYPE_THEME_FREE ? 'hidden' : 'switch',
			),
			"header_widgets_{$cpt}"         => array(
				'title'   => esc_html__( 'Header widgets', 'gutentype' ),
				// Translators: Add CPT name to the description
				'desc'    => wp_kses_data( sprintf( __( 'Select set of widgets to show in the header on the %s pages', 'gutentype' ), $title ) ),
				'std'     => 'hide',
				'options' => array(),
				'type'    => 'select',
			),

			"sidebar_info_{$cpt}"           => array(
				'title' => esc_html__( 'Sidebar', 'gutentype' ),
				'desc'  => '',
				'type'  => 'info',
			),
			"sidebar_position_{$cpt}"       => array(
				'title'   => esc_html__( 'Sidebar position', 'gutentype' ),
				// Translators: Add CPT name to the description
				'desc'    => wp_kses_data( sprintf( __( 'Select position to show sidebar on the %s pages', 'gutentype' ), $title ) ),
				'std'     => 'left',
				'options' => array(),
				'type'    => 'switch',
			),
			"sidebar_widgets_{$cpt}"        => array(
				'title'      => esc_html__( 'Sidebar widgets', 'gutentype' ),
				// Translators: Add CPT name to the description
				'desc'       => wp_kses_data( sprintf( __( 'Select sidebar to show on the %s pages', 'gutentype' ), $title ) ),
				'dependency' => array(
					"sidebar_position_{$cpt}" => array( 'left', 'right' ),
				),
				'std'        => 'hide',
				'options'    => array(),
				'type'       => 'select',
			),


			"footer_info_{$cpt}"            => array(
				'title' => esc_html__( 'Footer', 'gutentype' ),
				'desc'  => '',
				'type'  => 'info',
			),
			"footer_type_{$cpt}"            => array(
				'title'   => esc_html__( 'Footer style', 'gutentype' ),
				'desc'    => wp_kses_data( __( 'Choose whether to use the default footer or footer Layouts (available only if the ThemeREX Addons is activated)', 'gutentype' ) ),
				'std'     => 'inherit',
				'options' => gutentype_get_list_header_footer_types( true ),
				'type'    => GUTENTYPE_THEME_FREE ? 'hidden' : 'switch',
			),
			"footer_style_{$cpt}"           => array(
				'title'      => esc_html__( 'Select custom layout', 'gutentype' ),
				'desc'       => wp_kses_data( __( 'Select custom layout to display the site footer', 'gutentype' ) ),
				'std'        => 'inherit',
				'dependency' => array(
					"footer_type_{$cpt}" => array( 'custom' ),
				),
				'options'    => array(),
				'type'       => GUTENTYPE_THEME_FREE ? 'hidden' : 'select',
			),
			"footer_widgets_{$cpt}"         => array(
				'title'      => esc_html__( 'Footer widgets', 'gutentype' ),
				'desc'       => wp_kses_data( __( 'Select set of widgets to show in the footer', 'gutentype' ) ),
				'dependency' => array(
					"footer_type_{$cpt}" => array( 'default', 'plain', 'simple', 'modern' ),
				),
				'std'        => 'footer_widgets',
				'options'    => array(),
				'type'       => 'select',
			),
			"footer_columns_{$cpt}"         => array(
				'title'      => esc_html__( 'Footer columns', 'gutentype' ),
				'desc'       => wp_kses_data( __( 'Select number columns to show widgets in the footer. If 0 - autodetect by the widgets count', 'gutentype' ) ),
				'dependency' => array(
					"footer_type_{$cpt}"    => array( 'default', 'plain', 'simple', 'modern' ),
					"footer_widgets_{$cpt}" => array( '^hide' ),
				),
				'std'        => 0,
				'options'    => gutentype_get_list_range( 0, 6 ),
				'type'       => 'select',
			),
			"footer_wide_{$cpt}"            => array(
				'title'      => esc_html__( 'Footer fullwidth', 'gutentype' ),
				'desc'       => wp_kses_data( __( 'Do you want to stretch the footer to the entire window width?', 'gutentype' ) ),
				'dependency' => array(
					"footer_type_{$cpt}" => array( 'default', 'plain', 'simple', 'modern' ),
				),
				'std'        => 0,
				'type'       => 'checkbox',
			),

			"widgets_info_{$cpt}"           => array(
				'title' => esc_html__( 'Additional panels', 'gutentype' ),
				'desc'  => '',
				'type'  => GUTENTYPE_THEME_FREE ? 'hidden' : 'info',
			),
			"widgets_above_page_{$cpt}"     => array(
				'title'   => esc_html__( 'Widgets at the top of the page', 'gutentype' ),
				'desc'    => wp_kses_data( __( 'Select widgets to show at the top of the page (above content and sidebar)', 'gutentype' ) ),
				'std'     => 'hide',
				'options' => array(),
				'type'    => GUTENTYPE_THEME_FREE ? 'hidden' : 'select',
			),
			"widgets_above_content_{$cpt}"  => array(
				'title'   => esc_html__( 'Widgets above the content', 'gutentype' ),
				'desc'    => wp_kses_data( __( 'Select widgets to show at the beginning of the content area', 'gutentype' ) ),
				'std'     => 'hide',
				'options' => array(),
				'type'    => GUTENTYPE_THEME_FREE ? 'hidden' : 'select',
			),
			"widgets_below_content_{$cpt}"  => array(
				'title'   => esc_html__( 'Widgets below the content', 'gutentype' ),
				'desc'    => wp_kses_data( __( 'Select widgets to show at the ending of the content area', 'gutentype' ) ),
				'std'     => 'hide',
				'options' => array(),
				'type'    => GUTENTYPE_THEME_FREE ? 'hidden' : 'select',
			),
			"widgets_below_page_{$cpt}"     => array(
				'title'   => esc_html__( 'Widgets at the bottom of the page', 'gutentype' ),
				'desc'    => wp_kses_data( __( 'Select widgets to show at the bottom of the page (below content and sidebar)', 'gutentype' ) ),
				'std'     => 'hide',
				'options' => array(),
				'type'    => GUTENTYPE_THEME_FREE ? 'hidden' : 'select',
			),
		);
	}
}


// Return lists with choises when its need in the admin mode
if ( ! function_exists( 'gutentype_options_get_list_choises' ) ) {
	add_filter( 'gutentype_filter_options_get_list_choises', 'gutentype_options_get_list_choises', 10, 2 );
	function gutentype_options_get_list_choises( $list, $id ) {
		if ( is_array( $list ) && count( $list ) == 0 ) {
			if ( strpos( $id, 'header_style' ) === 0 ) {
				$list = gutentype_get_list_header_styles( strpos( $id, 'header_style_' ) === 0 );
			} elseif ( strpos( $id, 'header_position' ) === 0 ) {
				$list = gutentype_get_list_header_positions( strpos( $id, 'header_position_' ) === 0 );
			} elseif ( strpos( $id, 'header_widgets' ) === 0 ) {
				$list = gutentype_get_list_sidebars( strpos( $id, 'header_widgets_' ) === 0, true );
			} elseif ( strpos( $id, '_scheme' ) > 0 ) {
				$list = gutentype_get_list_schemes( 'color_scheme' != $id );
			} elseif ( strpos( $id, 'sidebar_widgets' ) === 0 ) {
				$list = gutentype_get_list_sidebars( strpos( $id, 'sidebar_widgets_' ) === 0, true );
			} elseif ( strpos( $id, 'sidebar_position' ) === 0 ) {
				$list = gutentype_get_list_sidebars_positions( strpos( $id, 'sidebar_position_' ) === 0 );
			} elseif ( strpos( $id, 'widgets_above_page' ) === 0 ) {
				$list = gutentype_get_list_sidebars( strpos( $id, 'widgets_above_page_' ) === 0, true );
			} elseif ( strpos( $id, 'widgets_above_content' ) === 0 ) {
				$list = gutentype_get_list_sidebars( strpos( $id, 'widgets_above_content_' ) === 0, true );
			} elseif ( strpos( $id, 'widgets_below_page' ) === 0 ) {
				$list = gutentype_get_list_sidebars( strpos( $id, 'widgets_below_page_' ) === 0, true );
			} elseif ( strpos( $id, 'widgets_below_content' ) === 0 ) {
				$list = gutentype_get_list_sidebars( strpos( $id, 'widgets_below_content_' ) === 0, true );
			} elseif ( strpos( $id, 'widgets_top_footer_page' ) === 0 ) {
                $list = gutentype_get_list_sidebars( strpos( $id, 'widgets_top_footer_page_' ) === 0, true );
            } elseif ( strpos( $id, 'widgets_blog_page' ) === 0 ) {
                $list = gutentype_get_list_sidebars( strpos( $id, 'widgets_blog_page' ) === 0, true );
            } elseif ( strpos( $id, 'footer_style' ) === 0 ) {
				$list = gutentype_get_list_footer_styles( strpos( $id, 'footer_style_' ) === 0 );
			} elseif ( strpos( $id, 'footer_widgets' ) === 0 ) {
				$list = gutentype_get_list_sidebars( strpos( $id, 'footer_widgets_' ) === 0, true );
			} elseif ( strpos( $id, 'blog_style' ) === 0 ) {
				$list = gutentype_get_list_blog_styles( strpos( $id, 'blog_style_' ) === 0 );
			} elseif ( strpos( $id, 'post_type' ) === 0 ) {
				$list = gutentype_get_list_posts_types();
			} elseif ( strpos( $id, 'parent_cat' ) === 0 ) {
				$list = gutentype_array_merge( array( 0 => esc_html__( 'All categories', 'gutentype' ) ), gutentype_get_list_categories() );
			} elseif ( strpos( $id, 'blog_animation' ) === 0 ) {
				$list = gutentype_get_list_animations_in();
			} elseif ( 'color_scheme_editor' == $id ) {
				$list = gutentype_get_list_schemes();
			} elseif ( strpos( $id, '_font-family' ) > 0 ) {
				$list = gutentype_get_list_load_fonts( true );
			}
		}
		return $list;
	}
}
