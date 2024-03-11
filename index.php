<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Bro_Barbershop
 */

get_header();
$blog_style = get_theme_mod( 'bro_barbershop_blog_layout', '' );
?>

    <main id="primary" class="site-main">

		<?php

		if ( have_posts() ) :

		if ( is_home() && ! is_front_page() ) :
			?>

            <header class="entry-header page-header">
                <div class="page-header-info">
                    <h1 class="entry-title">
						<?php single_post_title(); ?>
                    </h1>
                </div>
				<?php
				bro_barbershop_header_image();
				bro_barbershop_breadcrumbs();
				?>
            </header><!-- .entry-header -->
		<?php
		endif;
		?>
        <div class="posts-wrapper">

			<?php if ( $blog_style == 'grid' ) { ?>
            <div class="grid-posts">
				<?php } ?>

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

				endwhile; ?>

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
