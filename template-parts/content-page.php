<?php
/**
 * Template part for displaying page content in page.php
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
			the_title( '<h1 class="entry-title">', '</h1>' );
			?>
        </div>
		<?php
		if ( has_post_thumbnail() ) {
			bro_barbershop_post_thumbnail( 'bro-barbershop-x-large' );
		} else {
			bro_barbershop_header_image();
		}
		bro_barbershop_breadcrumbs();
		?>
    </header><!-- .entry-header -->

    <div class="entry-content">
		<?php
		the_content();

		wp_link_pages(
			array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'bro-barbershop' ),
				'after'  => '</div>',
			)
		);
		?>
    </div><!-- .entry-content -->

	<?php if ( get_edit_post_link() ) : ?>
        <footer class="entry-footer">
			<?php
			edit_post_link(
				sprintf(
					wp_kses(
					/* translators: %s: Name of current post. Only visible to screen readers */
						__( 'Edit <span class="screen-reader-text">%s</span>', 'bro-barbershop' ),
						array(
							'span' => array(
								'class' => array(),
							),
						)
					),
					wp_kses_post( get_the_title() )
				),
				'<span class="edit-link">',
				'</span>'
			);
			?>
        </footer><!-- .entry-footer -->
	<?php endif; ?>
</article><!-- #post-<?php the_ID(); ?> -->
