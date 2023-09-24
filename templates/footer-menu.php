<?php
/**
 * The template to display menu in the footer
 *
 * @package WordPress
 * @subpackage GUTENTYPE
 * @since GUTENTYPE 1.0.10
 */
if ( gutentype_is_on( gutentype_get_theme_option( 'menu_in_footer' ) ) ) {
// Footer menu
    $gutentype_menu_footer = gutentype_get_nav_menu(
        array(
            'location' => 'menu_footer',
            'class' => 'sc_layouts_menu sc_layouts_menu_default',
        )
    );
    if (!empty($gutentype_menu_footer)) {
        ?>
        <div class="footer_menu_wrap">
            <div class="footer_menu_inner">
                <?php gutentype_show_layout($gutentype_menu_footer); ?>
            </div>
        </div>
        <?php
    }
}