<?php
// Add plugin-specific vars to the custom CSS
if ( ! function_exists( 'gutentype_gutenberg_add_theme_vars' ) ) {
	add_filter( 'gutentype_filter_add_theme_vars', 'gutentype_gutenberg_add_theme_vars', 10, 2 );
	function gutentype_gutenberg_add_theme_vars( $rez, $vars ) {
		return $rez;
	}
}


// Add plugin-specific colors and fonts to the custom CSS
if ( ! function_exists( 'gutentype_gutenberg_get_css' ) ) {
	add_filter( 'gutentype_filter_get_css', 'gutentype_gutenberg_get_css', 10, 2 );
	function gutentype_gutenberg_get_css( $css, $args ) {

		if ( isset( $css['vars'] ) && isset( $args['vars'] ) ) {
			extract( $args['vars'] );
			$css['vars'] .= <<<CSS

CSS;
		}

		if ( isset( $css['fonts'] ) && isset( $args['fonts'] ) ) {
			$fonts                   = $args['fonts'];
			$fonts['p_font-family!'] = str_replace(';', ' !important;', $fonts['p_font-family']);
			$fonts['h6_font-family!'] = str_replace(';', ' !important;', $fonts['h6_font-family']);
			$css['fonts']           .= <<<CSS
.editor-block-list__block {
	{$fonts['p_font-family']}
	{$fonts['p_font-size']}
	{$fonts['p_font-weight']}
	{$fonts['p_font-style']}
	{$fonts['p_line-height']}
	{$fonts['p_text-decoration']}
	{$fonts['p_text-transform']}
	{$fonts['p_letter-spacing']}
}

.editor-post-title__block .editor-post-title__input {
	{$fonts['h1_font-family']}
	{$fonts['h1_font-size']}
	{$fonts['h1_font-weight']}
	{$fonts['h1_font-style']}
	{$fonts['h1_line-height']}
	{$fonts['h1_text-decoration']}
	{$fonts['h1_text-transform']}
	{$fonts['h1_letter-spacing']}
}

/* CoBlocks styles */

.wp-block-coblocks-alert .wp-block-coblocks-alert__title,
.wp-block-coblocks-accordion .wp-block-coblocks-accordion-item .wp-block-coblocks-accordion-item__title {
    {$fonts['h6_font-family']}
	{$fonts['h6_font-size']}
	{$fonts['h6_font-weight']}
	{$fonts['h6_font-style']}
	{$fonts['h6_line-height']}
}
.wp-block-coblocks-buttons .wp-block-coblocks-buttons__inner .wp-block-button .wp-block-button__link {
	{$fonts['h6_font-family!']}
}
.wp-block-coblocks-pricing-table-item__amount,
.wp-block-coblocks-pricing-table-item__currency,
.wp-block-coblocks-pricing-table-item__title,
.wp-block-coblocks-social ul li .wp-block-coblocks-social__text,
.coblocks-form label,
.wp-block-coblocks-click-to-tweet__twitter-btn,
.wp-block-coblocks-author .wp-block-coblocks-author__content .wp-block-coblocks-author__name {
    {$fonts['h6_font-family']}
}

CSS;
		}

		if ( isset( $css['colors'] ) && isset( $args['colors'] ) ) {
			$colors         = $args['colors'];
			$css['colors'] .= <<<CSS




.style-bg:before,
.style-bg-top:before,
.style-bg-left:before  {
	background-color: {$colors['alter_bg_color']};
}

/* CoBlocks */
/* Accodrion */
.wp-block-coblocks-accordion .wp-block-coblocks-accordion-item .wp-block-coblocks-accordion-item__title {
    color: {$colors['text_dark']};
	background-color: {$colors['alter_bg_color']};
}
.wp-block-coblocks-accordion .wp-block-coblocks-accordion-item:nth-child(3n+1) .wp-block-coblocks-accordion-item__title:before {
    background-color: {$colors['text_link']} !important;
}
.wp-block-coblocks-accordion .wp-block-coblocks-accordion-item:nth-child(3n+2) .wp-block-coblocks-accordion-item__title:before {
    background-color: {$colors['text_link3']};
}
.wp-block-coblocks-accordion .wp-block-coblocks-accordion-item:nth-child(3n+3) .wp-block-coblocks-accordion-item__title:before {
    background-color: {$colors['text_link2']};
}
/*Alert*/
.wp-block-coblocks-alert.is-default-alert {
    color: {$colors['text']};
	background-color: {$colors['alter_bg_color']};
}
.wp-block-coblocks-alert:before {
    color: {$colors['text_dark']};
}

/* Author */
.wp-block-coblocks-author {
    background-color: {$colors['alter_bg_color']};
}
.wp-block-coblocks-author .wp-block-coblocks-author__content .wp-block-coblocks-author__name {
    color: {$colors['text_dark']};
}

.wp-block-coblocks-author .wp-block-button.is-style-outline .wp-block-button__link {
	border-color: {$colors['text_dark']} !important;
}
.wp-block-coblocks-author .wp-block-button.is-style-outline .wp-block-button__link:hover {
	border-color: {$colors['text_link']} !important;
}

/* Carousel */
.wp-block-coblocks-gallery-carousel .flickity-button {
    color: {$colors['text_link']} !important;
	background-color: {$colors['alter_bg_color']} !important;
}
.wp-block-coblocks-gallery-carousel .flickity-button:hover {
    color: {$colors['text_dark']} !important;
    background-color: {$colors['alter_bg_color']} !important;
}
/* click to tweet */
.wp-block-coblocks-click-to-tweet {
	color: {$colors['text']};
	background-color: {$colors['alter_bg_color']};
}
.wp-block-coblocks-click-to-tweet__text:before {
	color: {$colors['text_dark']};
}
.wp-block-coblocks-click-to-tweet__twitter-btn {
	color: {$colors['inverse_link']};
	background-color: {$colors['text_link']};
	box-shadow: 0px 18px 18px -18px {$colors['text_link']} !important;
}
.wp-block-coblocks-click-to-tweet__twitter-btn.has-button-color {
	box-shadow: none !important;
}
.wp-block-coblocks-click-to-tweet__twitter-btn:hover {
	color: {$colors['inverse_link']};
	background-color: {$colors['text_hover']};
}
.wp-block-coblocks-click-to-tweet.alter_background {
	color: {$colors['extra_dark']};
	background-color: {$colors['text_link2']};
}
.wp-block-coblocks-click-to-tweet.alter_background .wp-block-coblocks-click-to-tweet__text:before {
	color: {$colors['text_hover3']};
}
.wp-block-coblocks-click-to-tweet.alter_background .wp-block-coblocks-click-to-tweet__twitter-btn {
	box-shadow: none !important;
}

/* Featured Blocks */
.wp-block-coblocks-features .has-bg-color-background-color {		background-color: {$colors['extra_dark']};}

/* CoBlocks Form */
.coblocks-form label {
	color: {$colors['text_dark']};
}
.coblocks-form .wp-block-button__link  {
	color: {$colors['inverse_link']} !important;
	background-color: {$colors['text_link2']} !important;
	box-shadow: 0px 18px 18px -18px {$colors['text_link2']} !important;
}
.coblocks-form .wp-block-button__link:hover  {
	color: {$colors['inverse_link']} !important;
	background-color: {$colors['text_hover2']} !important;
}

/* Pricing Tables */
.wp-block-coblocks-pricing-table-item {
	background-color: {$colors['alter_bg_color']};
}
.wp-block-coblocks-pricing-table-item__amount,
.wp-block-coblocks-pricing-table-item__currency,
.wp-block-coblocks-pricing-table-item__title {
	color: {$colors['text_dark']};
}
.wp-block-coblocks-pricing-table .wp-block-coblocks-pricing-table__inner .wp-block-coblocks-pricing-table-item:nth-child(odd) .wp-block-button__link {
	color: {$colors['inverse_link']} !important;
	background-color: {$colors['text_link2']} !important;
	box-shadow: 0px 18px 18px -18px {$colors['text_link2']} !important;
}
.wp-block-coblocks-pricing-table .wp-block-coblocks-pricing-table__inner .wp-block-coblocks-pricing-table-item:nth-child(odd) .wp-block-button__link:hover {
	color: {$colors['inverse_link']} !important;
	background-color: {$colors['text_hover2']} !important;
}
/* COBlock Button */
.wp-block-coblocks-buttons .wp-block-coblocks-buttons__inner .wp-block-button.is-style-squared .wp-block-button__link {
	color: {$colors['inverse_link']} !important;
	background-color: {$colors['text_hover']} !important;
}
.wp-block-coblocks-buttons .wp-block-coblocks-buttons__inner .wp-block-button.is-style-squared .wp-block-button__link:hover {
	color: {$colors['inverse_link']} !important;
	background-color: {$colors['text_link']} !important;
}

.wp-block-coblocks-buttons .wp-block-coblocks-buttons__inner .wp-block-button.is-style-3d .wp-block-button__link {
	color: {$colors['inverse_link']} !important;
	background-color: {$colors['alter_link3']} !important;
	box-shadow: inset 0px -4px 0 0 {$colors['alter_hover3']} !important;
}
.wp-block-coblocks-buttons .wp-block-coblocks-buttons__inner .wp-block-button.is-style-3d .wp-block-button__link:hover {
	color: {$colors['inverse_link']} !important;
	background-color: {$colors['alter_hover3']} !important;
}
.use_background:before {
	background-color: {$colors['extra_hover3']} !important;
}

/* Theme-specific colors */
.has-bg-color-color {		color: {$colors['bg_color']}; }
.has-bd-color-color {		color: {$colors['bd_color']}; }
.has-text-color-color {		color: {$colors['text']}; }
.has-text-light-color {		color: {$colors['text_light']}; }
.has-text-dark-color {		color: {$colors['text_dark']}; }
.has-text-link-color {		color: {$colors['text_link']}; }
.has-text-hover-color {		color: {$colors['text_hover']}; }
.has-text-link-2-color {	color: {$colors['text_link2']}; }
.has-text-hover-2-color {	color: {$colors['text_hover2']}; }
.has-text-link-3-color {	color: {$colors['text_link3']}; }
.has-text-hover-3-color {	color: {$colors['text_hover3']}; }

.has-bg-color-background-color {		background-color: {$colors['bg_color']};}
.has-bd-color-background-color {		background-color: {$colors['bd_color']}; }
.has-text-background-color {			background-color: {$colors['text']}; }
.has-text-light-background-color {		background-color: {$colors['text_light']}; }
.has-text-dark-background-color {		background-color: {$colors['text_dark']}; }
.has-text-link-background-color {		background-color: {$colors['text_link']}; }
.has-text-hover-background-color {		background-color: {$colors['text_hover']}; }
.has-text-link-2-background-color {		background-color: {$colors['text_link2']}; }
.has-text-hover-2-background-color {	background-color: {$colors['text_hover2']}; }
.has-text-link-3-background-color {		background-color: {$colors['text_link3']}; }
.has-text-hover-3-background-color {	background-color: {$colors['text_hover3']}; }

.editor-post-title__block .editor-post-title__input {
	color: {$colors['text_dark']};
}

.wp-block-pullquote blockquote .wp-block-quote__citation {
	color: {$colors['inverse_link']};
	background-color: {$colors['text_link']};
}

CSS;
		}

		return $css;
	}
}

