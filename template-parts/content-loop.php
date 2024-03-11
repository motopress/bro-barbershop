<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Bro_Barbershop
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'loop-post' ); ?>>

	<?php bro_barbershop_post_thumbnail(); ?>

    <div class="loop-post-content">

		<?php if ( is_sticky() ) { ?>
            <span class="sticky-post-indicator"><?php echo esc_html__( 'Featured', 'bro-barbershop' ) ?></span>
		<?php } ?>

		<?php
		bro_barbershop_posted_in();
		the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
		?>

		<?php if ( 'post' === get_post_type() ) : ?>
            <div class="entry-meta">
				<?php
				bro_barbershop_posted_on();
				bro_barbershop_posted_by();
				bro_barbershop_comments_number();
				?>
            </div><!-- .entry-meta -->
		<?php endif; ?>

        <div class="entry-content">
			<?php
			the_content(
				sprintf(
					wp_kses(
					/* translators: %s: Name of current post. Only visible to screen readers */
						__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'bro-barbershop' ),
						array(
							'span' => array(
								'class' => array(),
							),
						)
					),
					wp_kses_post( get_the_title() )
				)
			);
			?>
        </div>
    </div>
</article><!-- #post-<?php the_ID(); ?> -->
