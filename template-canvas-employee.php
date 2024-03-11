<?php
/**
 * Template Name: Canvas
 * Template Post Type: mpa_employee
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Barbershop
 */

get_header();
?>

    <main id="primary" class="site-main template-canvas-header">

		<?php
		while ( have_posts() ) :
			the_post();

			get_template_part( 'template-parts/content', 'employee-canvas' );

			bro_barbershop_posts_navigation();

			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;

		endwhile; // End of the loop.
		?>

    </main><!-- #main -->

<?php
get_footer();
