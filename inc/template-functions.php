<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package Bro_Barbershop
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 *
 * @return array
 */
function bro_barbershop_body_classes( $classes ) {
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	// Adds a class of no-sidebar when there is no sidebar present.
	if ( ! is_active_sidebar( 'sidebar-1' ) ) {
		$classes[] = 'no-sidebar';
	}

	return $classes;
}

add_filter( 'body_class', 'bro_barbershop_body_classes' );

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function bro_barbershop_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
	}
}

add_action( 'wp_head', 'bro_barbershop_pingback_header' );

function bro_barbershop_add_ellipses_to_nav( $nav_menu, $args ) {

	if ( 'menu-1' === $args->theme_location && get_theme_mod( 'bro_barbershop_menu_overflow', false ) ) :

		$nav_menu .= '
			<div class="main-menu-more">
				<ul class="menu">
					<li class="menu-item menu-item-has-children">
						<button class="submenu-expand primary-menu-more-toggle is-empty" tabindex="-1"
							aria-label="' . esc_attr__( 'More', 'bro-barbershop' ) . '" aria-haspopup="true" aria-expanded="false">
							<span class="screen-reader-text">' . esc_html__( 'More', 'bro-barbershop' ) . '</span><i class="fas fa-ellipsis-h"></i>
						</button>
						<ul class="sub-menu hidden-links"></ul>
					</li>
				</ul>
			</div>';

	endif;

	return $nav_menu;
}

add_filter( 'wp_nav_menu', 'bro_barbershop_add_ellipses_to_nav', 10, 2 );

function bro_barbershop_comment_form_fields( $fields ) {

	$rearranged_fields = array(
		'author'  => $fields['author'],
		'email'   => $fields['email'],
		'comment' => $fields['comment']
	);

	unset( $fields['url'] );
	unset( $fields['author'] );
	unset( $fields['email'] );
	unset( $fields['comment'] );

	$fields = $rearranged_fields + $fields;

	return $fields;
}

add_filter( 'comment_form_fields', 'bro_barbershop_comment_form_fields' );

if ( ! function_exists( 'bro_barbershop_header_image' ) ):
	function bro_barbershop_header_image() {
		if ( get_header_image() ) { ?>
            <div class="header-images">
                <img src="<?php echo get_header_image(); ?>" alt="<?php echo esc_attr( get_bloginfo( 'title' ) ); ?>">
            </div>
		<?php }
	}
endif;

function bro_barbershop_filter_header_classes( $classes ) {
	$menu_overflow = get_theme_mod( 'bro_barbershop_menu_overflow', false );

	if ( $menu_overflow ) {
		$classes[] = 'hide-overflow';
	}

	return $classes;
}

add_filter( 'bro_barbershop_header_classes', 'bro_barbershop_filter_header_classes', 10, 1 );


if ( ! function_exists( 'bro_barbershop_breadcrumbs' ) ) {
	function bro_barbershop_breadcrumbs() {
		if ( ! function_exists( 'bcn_display' ) ) {
			return;
		}

		?>
        <div class="breadcrumbs-wrapper" typeof="BreadcrumbList" vocab="https://schema.org/">
			<?php bcn_display(); ?>
        </div>
		<?php
	}
}

function bro_barbershop_main_sidebar_tooggle() {
	$button_title = get_theme_mod( 'bro_barbershop_main_sidebar_button_text', '' )
	?>
    <div class="main-sidebar-toggle">
		<?php if ( $button_title ) : ?>
            <button class="main-sidebar-toggle-button button-creative">
				<?php echo esc_html( $button_title ); ?>
            </button>
		<?php
		endif;
		?>
    </div>
<?php }
