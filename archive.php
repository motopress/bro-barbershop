<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Bro_Barbershop
 */

get_header();
$blog_style = get_theme_mod( 'bro_barbershop_blog_layout', '' );
?>

    <main id="primary" class="site-main">

        <header class="page-header">
            <div class="page-header-info">
				<?php
				the_archive_title( '<h1 class="page-title">', '</h1>' );
				the_archive_description( '<div class="archive-description">', '</div>' );
				?>
            </div>

			<?php bro_barbershop_header_image(); ?>
        </header><!-- .page-header -->

        <div class="posts-wrapper">

			<?php if ( $blog_style == 'grid' ) { ?>
            <div class="grid-posts">
				<?php } ?>

				<?php if ( have_posts() ) : ?>

				<?php
				/* Start the Loop */
				while ( have_posts() ) :
					the_post();

					/*
					 * Include the Post-Type-specific template for the content.
					 * If you want to override this in a child theme, then include a file
					 * called content-___.php (where ___ is the Post Type name) and that will be used instead.
					 */
					get_template_part( 'template-parts/content-loop', $blog_style . '-' . get_post_type() );

				endwhile;
				?>

				<?php if ( $blog_style == 'grid' ) { ?>
            </div>
		<?php } ?>

		<?php

		bro_barbershop_posts_pagination();

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif;
		?>
        </div>
    </main><!-- #main -->

<?php
get_footer();
