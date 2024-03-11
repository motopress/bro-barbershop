<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Bro_Barbershop
 */

?>

<footer id="colophon" class="site-footer">
    <div class="site-footer-inner">
		<?php if ( is_active_sidebar( 'footer-1' ) || is_active_sidebar( 'footer-2' ) || is_active_sidebar( 'footer-3' ) ) : ?>

            <div id="footer-sidebar" class="footer-widgets">
				<?php if ( is_active_sidebar( 'footer-1' ) ) : ?>
                    <div class="widget-area">
						<?php dynamic_sidebar( 'footer-1' ); ?>
                    </div>
				<?php
				endif;

				if ( is_active_sidebar( 'footer-2' ) ) : ?>
                    <div class="widget-area">
						<?php dynamic_sidebar( 'footer-2' ); ?>
                    </div>
				<?php
				endif;

				if ( is_active_sidebar( 'footer-3' ) ) : ?>
                    <div class="widget-area">
						<?php dynamic_sidebar( 'footer-3' ); ?>
                    </div>
				<?php
				endif;
				?>

            </div>

		<?php
		endif;
		?>

		<?php if ( get_theme_mod( 'bro_barbershop_show_footer_text', true ) == true ) { ?>
            <div class="site-info">
				<?php
				$dateObj = new DateTime;
				$year    = $dateObj->format( "Y" );
				printf(
					get_theme_mod( 'bro_barbershop_footer_text',
						sprintf(
							esc_html_x( '%1$s &copy; %2$s - All Rights Reserved', 'Default footer text, %1$s - blog name, %2$s - current year', 'bro-barbershop' ),
							get_bloginfo( 'name' ),
							$year
						)
					),
					get_bloginfo( 'name' ),
					$year
				);
				?>
            </div>
		<?php } ?>

    </div>
</footer><!-- #colophon -->

<?php get_sidebar(); ?>

</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
