<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Bro_Barbershop
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="page" class="site">
    <a class="skip-link screen-reader-text"
       href="#primary"><?php esc_html_e( 'Skip to content', 'bro-barbershop' ); ?></a>

	<?php $header_classes = apply_filters( 'bro_barbershop_header_classes', [ 'site-header' ] ); ?>
    <header id="masthead" class="<?php echo esc_attr( implode( ' ', $header_classes ) ) ?>">
        <div class="site-header-inner">
            <div class="site-branding">
				<?php the_custom_logo(); ?>
                <div class="site-title-wrapper">
					<?php if ( is_front_page() && is_home() ) : ?>
                        <h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>"
                                                  rel="home"><?php bloginfo( 'name' ); ?></a></h1>
					<?php
					else :
						?>
                        <p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>"
                                                 rel="home"><?php bloginfo( 'name' ); ?></a></p>
					<?php
					endif;
					$barbershop_description = get_bloginfo( 'description', 'display' );
					if ( $barbershop_description || is_customize_preview() ) :
						?>
                        <p class="site-description"><?php echo $barbershop_description; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
							?></p>
					<?php endif; ?>
                </div>
            </div><!-- .site-branding -->

			<?php $has_menu = has_nav_menu( 'menu-1' ); ?>
			<?php if ( $has_menu ) { ?>

                <button id="menuToggle" class="menu-toggle">
                    <span class="bar1"></span>
                    <span class="bar2"></span>
                    <span class="bar3"></span>
                </button>

                <div class="main-navigation-container">
                    <nav id="site-navigation" class="main-navigation">
                        <div class="primary-menu-wrapper">
							<?php
							wp_nav_menu(
								array(
									'theme_location'  => 'menu-1',
									'menu_id'         => 'primary-menu',
									'container_class' => 'primary-menu-container'
								)
							);
							?>
                        </div>
						<?php bro_barbershop_main_sidebar_tooggle(); ?>
                    </nav><!-- #site-navigation -->
                </div>

			<?php } ?>

        </div>
    </header><!-- #masthead -->
