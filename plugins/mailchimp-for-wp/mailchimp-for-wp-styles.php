<?php
// Add plugin-specific colors and fonts to the custom CSS
if ( ! function_exists( 'gutentype_mailchimp_get_css' ) ) {
	add_filter( 'gutentype_filter_get_css', 'gutentype_mailchimp_get_css', 10, 2 );
	function gutentype_mailchimp_get_css( $css, $args ) {

		if ( isset( $css['fonts'] ) && isset( $args['fonts'] ) ) {
			$fonts         = $args['fonts'];
			$css['fonts'] .= <<<CSS
form.mc4wp-form .mc4wp-form-fields input[type="email"] {
	{$fonts['input_font-family']}
	{$fonts['input_font-weight']}
	{$fonts['input_font-style']}
	{$fonts['input_line-height']}
	{$fonts['input_text-decoration']}
	{$fonts['input_text-transform']}
	{$fonts['input_letter-spacing']}
}
form.mc4wp-form .mc4wp-form-fields input[type="submit"] {
	{$fonts['button_font-family']}
	{$fonts['button_font-size']}
	{$fonts['button_font-weight']}
	{$fonts['button_font-style']}
	{$fonts['button_line-height']}
	{$fonts['button_text-decoration']}
	{$fonts['button_text-transform']}
	{$fonts['button_letter-spacing']}
}
.content_wrap .sidebar_inner form.mc4wp-form .mc4wp-form-fields .submit-icon:before,
.mc4wp-form .title {
    {$fonts['h5_font-family']}
}

.content_wrap .sidebar_inner form.mc4wp-form label,
.content_wrap .sidebar_inner form.mc4wp-form .mc4wp-form-fields input[type="email"] {
    {$fonts['p_font-family']}
}


CSS;
		}

		if ( isset( $css['vars'] ) && isset( $args['vars'] ) ) {
			$vars = $args['vars'];

			$css['vars'] .= <<<CSS

form.mc4wp-form .mc4wp-form-fields input[type="email"],
form.mc4wp-form .mc4wp-form-fields input[type="submit"] {
	-webkit-border-radius: {$vars['rad']};
	    -ms-border-radius: {$vars['rad']};
			border-radius: {$vars['rad']};
}

CSS;
		}

		if ( isset( $css['colors'] ) && isset( $args['colors'] ) ) {
			$colors         = $args['colors'];
			$css['colors'] .= <<<CSS

form.mc4wp-form .mc4wp-alert {
	background-color: {$colors['text_link']};
	border-color: {$colors['text_hover']};
	color: {$colors['inverse_link']};
}
form.mc4wp-form .mc4wp-alert a {
	color: {$colors['text_dark']} !important;	
}
form.mc4wp-form .mc4wp-alert a:hover {
	color: {$colors['inverse_link']} !important;	
}




.content_wrap .widget.widget_mc4wp_form_widget .mc4wp-form {
    background-color: {$colors['text_link2']};
    color: {$colors['inverse_link']};
}

.blog_style_simple .content_wrap .widget.widget_mc4wp_form_widget .mc4wp-form {    
    background-color: {$colors['inverse_dark']};
}



.content_wrap .sidebar_inner .widget.widget_mc4wp_form_widget .mc4wp-form {
    background-color: {$colors['alter_bg_color']};
    color: {$colors['text']};
}


.content_wrap .sidebar_inner .mc4wp-form .title {
    color: {$colors['text_dark']};
}

.content_wrap .sidebar_inner form.mc4wp-form label {
	color: {$colors['text']};
}
.content_wrap .sidebar_inner form.mc4wp-form label a {
	 color: {$colors['text_dark']};
}
.content_wrap .sidebar_inner form.mc4wp-form label a:hover {
	 color: {$colors['text_link']};
}
.content_wrap .sidebar_inner form.mc4wp-form input[type="checkbox"] + label:before {
	border-color: {$colors['text_dark']};
}

.content_wrap .sidebar_inner form.mc4wp-form .mc4wp-form-fields .submit-icon:before  {
    background-color: {$colors['text_link']} !important;
}
.content_wrap .sidebar_inner form.mc4wp-form .mc4wp-form-fields input[type="submit"]:hover {
 
}
.content_wrap .sidebar_inner form.mc4wp-form .mc4wp-form-fields .submit-icon:before {
    color: {$colors['inverse_link']};
}

CSS;
		}

		return $css;
	}
}

