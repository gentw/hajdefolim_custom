<?php
/**
 * The template to display the copyright info in the footer
 *
 * @package WordPress
 * @subpackage GUTENTYPE
 * @since GUTENTYPE 1.0.10
 */

// Copyright area
?> 
<div class="footer_copyright_wrap">
	<div class="footer_copyright_inner">
		<div class="content_wrap">
			<div class="copyright_text">
			<?php
				$gutentype_copyright = gutentype_get_theme_option( 'copyright' );
			if ( ! empty( $gutentype_copyright ) ) {
				// Replace {{Y}} or {Y} with the current year
				$gutentype_copyright = str_replace( array( '{{Y}}', '{Y}' ), date( 'Y' ), $gutentype_copyright );
				// Replace {{...}} and ((...)) on the <i>...</i> and <b>...</b>
				$gutentype_copyright = gutentype_prepare_macros( $gutentype_copyright );
				// Display copyright
				echo wp_kses_post( nl2br( $gutentype_copyright ) );
			}
			?>
			</div>
            <?php
            if ( gutentype_exists_trx_addons() ) {
                do_action('trx_addons_scroll_to_top');
            }
            ?>
		</div>
	</div>
</div>
