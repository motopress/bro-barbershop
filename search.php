<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package Bro_Barbershop
 */

get_header();
?>

    <main id="primary" class="site-main">

		<?php if ( have_posts() ) : ?>

        <header class="page-header">
            <div class="page-header-info">
                <h1 class="page-title">
					<?php
					/* translators: %s: search query. */
					printf( esc_html__( 'Search Results for: %s', 'bro-barbershop' ), '<span>' . get_search_query() . '</span>' );
					?>
                </h1>
            </div>

			<?php bro_barbershop_header_image(); ?>
        </header><!-- .page-header -->

        <div class="posts-wrapper">

			<?php
			/* Start the Loop */
			while ( have_posts() ) :
				the_post();

				/**
				 * Run the loop for the search to output the results.
				 * If you want to overload this in a child theme then include a file
				 * called content-search.php and that will be used instead.
				 */
				get_template_part( 'template-parts/content', 'search' );

			endwhile;

			bro_barbershop_posts_pagination();

			else :

				get_template_part( 'template-parts/content', 'none' );

			endif;
			?>
        </div>
    </main><!-- #main -->

<?php
get_footer();
