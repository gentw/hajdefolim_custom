<?php
/**
 * The template to display the Author bio
 *
 * @package WordPress
 * @subpackage GUTENTYPE
 * @since GUTENTYPE 1.0
 */
?>

<div class="author_info author vcard" itemprop="author" itemscope itemtype="//schema.org/Person">

	<div class="author_avatar" itemprop="image">
		<?php
		$gutentype_mult = gutentype_get_retina_multiplier();
		echo get_avatar( get_the_author_meta( 'user_email' ), 135 * $gutentype_mult );
		?>
	</div><!-- .author_avatar -->

	<div class="author_description">
        <span class="author_subtitle"><?php esc_html_e('Written By','gutentype'); ?></span>
		<h5 class="author_title" itemprop="name">
            <a class="author_link" href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" rel="author">
                <?php
                    // Translators: Add the author's name in the <span>
                    echo wp_kses_data( sprintf( '%s', '<span class="fn">' . get_the_author() . '</span>' ) );
                ?>
            </a>
		</h5>

		<div class="author_bio" itemprop="description">
			<?php echo wp_kses( wpautop( get_the_author_meta( 'description' ) ), 'gutentype_kses_content' ); ?>
			<?php do_action( 'gutentype_action_user_meta' ); ?>
		</div><!-- .author_bio -->

	</div><!-- .author_description -->

</div><!-- .author_info -->
