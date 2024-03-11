<?php
/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Bro_Barbershop
 */

if ( ! function_exists( 'bro_barbershop_posted_on' ) ) :
	/**
	 * Prints HTML with meta information for the current post-date/time.
	 */
	function bro_barbershop_posted_on() {
		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
		}

		$time_string = sprintf(
			$time_string,
			esc_attr( get_the_date( DATE_W3C ) ),
			esc_html( get_the_date() ),
			esc_attr( get_the_modified_date( DATE_W3C ) ),
			esc_html( get_the_modified_date() )
		);

		$posted_on = sprintf(
		/* translators: %s: post date. */
			esc_html_x( '%s', 'post date', 'bro-barbershop' ),
			'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
		);

		echo '<span class="posted-on">' . $posted_on . '</span>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

	}
endif;

if ( ! function_exists( 'bro_barbershop_posted_by' ) ) :
	/**
	 * Prints HTML with meta information for the current author.
	 */
	function bro_barbershop_posted_by() {
		$byline = sprintf(
		/* translators: %s: post author. */
			esc_html_x( 'by %s', 'post author', 'bro-barbershop' ),
			'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
		);

		echo '<span class="byline"> ' . $byline . '</span>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

	}
endif;

if ( ! function_exists( 'bro_barbershop_posted_in' ) ) :
	function bro_barbershop_posted_in() {
		$categories_list = get_the_category_list( ' ' );

		if ( $categories_list ) {
			echo '<span class="cat-links">' . $categories_list . '</span>';
		}
	}
endif;

if ( ! function_exists( 'bro_barbershop_comments_number' ) ) :
	function bro_barbershop_comments_number() {
		$comments_number = get_comments_number();

		if ( $comments_number ) { ?>
            <span class="post-comments">
                <?php comments_popup_link( '0', '1 Comment', '% Comments' ); ?>
            </span>
		<?php }
	}
endif;

if ( ! function_exists( 'bro_barbershop_entry_footer' ) ) :
	/**
	 * Prints HTML with meta information for the categories, tags and comments.
	 */
	function bro_barbershop_entry_footer() {
		// Hide category and tag text for pages.
		if ( 'post' === get_post_type() ) {

			$tags_list = get_the_tag_list( '', '' );
			if ( $tags_list ) {
				/* translators: 1: list of tags. */
				printf( '<span class="tags-links">' . esc_html__( '%1$s', 'bro-barbershop' ) . '</span>', $tags_list ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			}
		}

		if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
			echo '<span class="comments-link">';
			comments_popup_link(
				sprintf(
					wp_kses(
					/* translators: %s: post title */
						__( 'Leave a Comment<span class="screen-reader-text"> on %s</span>', 'bro-barbershop' ),
						array(
							'span' => array(
								'class' => array(),
							),
						)
					),
					wp_kses_post( get_the_title() )
				)
			);
			echo '</span>';
		}

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
	}
endif;

if ( ! function_exists( 'bro_barbershop_post_thumbnail' ) ) :
	/**
	 * Displays an optional post thumbnail.
	 *
	 * Wraps the post thumbnail in an anchor element on index views, or a div
	 * element when on single views.
	 */
	function bro_barbershop_post_thumbnail( $size = 'post-thumbnail' ) {
		if ( post_password_required() || is_attachment() || ! has_post_thumbnail() ) {
			return;
		}

		if ( is_singular() ) :
			?>

            <div class="post-thumbnail">
				<?php the_post_thumbnail(); ?>
            </div><!-- .post-thumbnail -->

		<?php else : ?>

            <a class="post-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
				<?php
				the_post_thumbnail(
					$size,
					array(
						'alt' => the_title_attribute(
							array(
								'echo' => false,
							)
						),
					)
				);
				?>
            </a>

		<?php
		endif; // End is_singular().
	}
endif;

if ( ! function_exists( 'wp_body_open' ) ) :
	/**
	 * Shim for sites older than 5.2.
	 *
	 * @link https://core.trac.wordpress.org/ticket/12563
	 */
	function wp_body_open() {
		do_action( 'wp_body_open' );
	}
endif;

if ( ! function_exists( 'bro_barbershop_posts_pagination' ) ):

	function bro_barbershop_posts_pagination() {

		$icon_prev = '<svg width="17" height="17" viewBox="0 0 17 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M9.8 15.9L9 16.8C8.6 17.2 8.1 17.2 7.7 16.8L0.3 9.2C-0.1 8.8 -0.1 8.2 0.3 7.9L7.7 0.3C8.1 -0.1 8.6 -0.1 9 0.3L9.8 1.2C10.2 1.6 10.2 2.2 9.8 2.5L5.2 6.9H16.1C16.6 6.9 17 7.3 17 7.8V9C17 9.5 16.6 9.9 16.1 9.9H5.2L9.8 14.4C10.1 14.9 10.1 15.5 9.8 15.9Z"/>
                        </svg>';

		$icon_next = '<svg width="17" height="17" viewBox="0 0 17 17" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M7.2 1.1L8 0.200002C8.4 -0.199998 8.9 -0.199998 9.3 0.200002L16.7 7.8C17.1 8.2 17.1 8.8 16.7 9.1L9.3 16.7C8.9 17.1 8.4 17.1 8 16.7L7.2 15.8C6.8 15.4 6.8 14.8 7.2 14.5L11.8 10H0.9C0.4 10.1 0 9.6 0 9.1V7.9C0 7.4 0.4 7 0.9 7H11.8L7.2 2.5C6.9 2.1 6.9 1.5 7.2 1.1Z"/>
</svg>';

		the_posts_pagination( array(
			'mid_size'  => 1,
			'prev_text' => $icon_prev,
			'next_text' => $icon_next,
		) );
	}
endif;

if ( ! function_exists( 'bro_barbershop_posts_navigation' ) ):

	function bro_barbershop_posts_navigation() {

		if ( is_singular( 'mpa_service' ) || is_singular( 'mpa_employee' ) || is_singular( 'mpa_location' ) ) {
			return;
		}

		$icon_prev = '<svg width="17" height="17" viewBox="0 0 17 17" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M9.8 15.9L9 16.8C8.6 17.2 8.1 17.2 7.7 16.8L0.3 9.2C-0.1 8.8 -0.1 8.2 0.3 7.9L7.7 0.3C8.1 -0.1 8.6 -0.1 9 0.3L9.8 1.2C10.2 1.6 10.2 2.2 9.8 2.5L5.2 6.9H16.1C16.6 6.9 17 7.3 17 7.8V9C17 9.5 16.6 9.9 16.1 9.9H5.2L9.8 14.4C10.1 14.9 10.1 15.5 9.8 15.9Z"/>
</svg>';

		$icon_next = '<svg width="17" height="17" viewBox="0 0 17 17" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M7.2 1.1L8 0.200002C8.4 -0.199998 8.9 -0.199998 9.3 0.200002L16.7 7.8C17.1 8.2 17.1 8.8 16.7 9.1L9.3 16.7C8.9 17.1 8.4 17.1 8 16.7L7.2 15.8C6.8 15.4 6.8 14.8 7.2 14.5L11.8 10H0.9C0.4 10.1 0 9.6 0 9.1V7.9C0 7.4 0.4 7 0.9 7H11.8L7.2 2.5C6.9 2.1 6.9 1.5 7.2 1.1Z"/>
</svg>';

		the_post_navigation(
			array(
				'prev_text' => '<div class="nav-icon">' . $icon_prev . '</div><span class="nav-title">%title</span>',
				'next_text' => '<span class="nav-title">%title</span><div class="nav-icon">' . $icon_next . '</div>',
			)
		);
	}

endif;
