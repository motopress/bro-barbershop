<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Bro_Barbershop
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'loop-post-grid' ); ?>>

	<?php bro_barbershop_post_thumbnail(); ?>

    <div class="loop-post-content">
		<?php
		bro_barbershop_posted_on();

		the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );

		bro_barbershop_posted_in();
		?>
    </div><!-- .entry-content -->
</article><!-- #post-<?php the_ID(); ?> -->
