<?php

/**
 * @param string $template_name Recommended. Shortcode or other template name.
 * @param bool $show_image Optional. False by default.
 * @param bool $show_title Optional. False by default.
 * @param bool $show_content Optional. False by default.
 * @param bool $show_excerpt Optional. False by default.
 * @param bool $show_attributes Optional. False by default.
 * @param bool $show_extra Optional. False by default.
 *
 * @since 1.2
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$template_name = 'mpa_employees_list';

// Args for nested templates
$itemArgs = [ 'view' => 'single' ]; // Don't replace the view from
// loop-posts.php, if exists


/**
 * @param string Default classes.
 *
 * @since 1.2
 */
$itemClass = apply_filters( "{$template_name}_item_class", mpa_get_post_class( 'mpa-grid-column' ) );

/**
 * @param array Template args.
 *
 * @since 1.2
 */
do_action( "{$template_name}_before_item", $itemArgs );

?>

<div class="<?php echo esc_attr( $itemClass ); ?>">
    <div class="mpa-loop-post-wrapper">
		<?php
		/**
		 * @param array Template args.
		 *
		 * @since 1.2
		 */
		do_action( "{$template_name}_after_item_start", $itemArgs );
		?>

		<?php
		if ( has_post_thumbnail() ) {
			/**
			 * @param array Template args.
			 *
			 * @since 1.2
			 */
			do_action( "{$template_name}_item_image", $itemArgs );
		}
		?>

		<?php
		/**
		 * @param array Template args.
		 *
		 * @since 1.2
		 */
		do_action( "{$template_name}_item_title", $itemArgs );

		/**
		 * @param array Template args.
		 *
		 * @since 1.2
		 */
		do_action( "{$template_name}_item_attributes", $itemArgs );

		/**
		 * @param array Template args.
		 *
		 * @since 1.2
		 */
		do_action( "{$template_name}_item_excerpt", $itemArgs );
		?>

		<?php

		/**
		 * @param array Template args.
		 *
		 * @since 1.2
		 */

		do_action( "{$template_name}_item_extra", $itemArgs );
		?>

		<?php
		/**
		 * @param array Template args.
		 *
		 * @since 1.2
		 */
		do_action( "{$template_name}_before_item_end", $itemArgs );
		?>
    </div>
</div>
