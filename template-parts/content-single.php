<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Bro_Barbershop
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <header class="entry-header page-header">
        <div class="page-header-info">
			<?php
			bro_barbershop_posted_in();
			the_title( '<h1 class="entry-title">', '</h1>' );
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
        </div>
		<?php
		bro_barbershop_header_image();
		bro_barbershop_breadcrumbs();
		?>
    </header><!-- .entry-header -->

    <div class="entry-content">
		<?php
		bro_barbershop_post_thumbnail();

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

		wp_link_pages(
			array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'bro-barbershop' ),
				'after'  => '</div>',
			)
		);
		?>
    </div><!-- .entry-content -->

    <footer class="entry-footer">
		<?php bro_barbershop_entry_footer(); ?>
    </footer><!-- .entry-footer -->
</article><!-- #post-<?php the_ID(); ?> -->
