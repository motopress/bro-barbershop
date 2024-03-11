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

function bro_barbershop_comment_form_fields($fields)
{

$rearranged_fields = array(
    'author' => $fields['author'],
    'email' => $fields['email'],
    'comment' => $fields['comment']
);

	unset($fields['url']);
	unset($fields['author']);
	unset($fields['email']);
	unset($fields['comment']);

	$fields = $rearranged_fields + $fields;

	return $fields;
}

add_filter('comment_form_fields', 'bro_barbershop_comment_form_fields');

if (!function_exists('bro_barbershop_header_image')):
    function bro_barbershop_header_image() {
        if (get_header_image()) { ?>
            <div class="header-images">
                <img src="<?php echo get_header_image(); ?>" alt="<?php echo esc_attr( get_bloginfo( 'title' ) ); ?>">
            </div>
        <?php }
    }
endif;

