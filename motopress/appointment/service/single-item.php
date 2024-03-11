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

// Initialize args
extract(
	array(
		'template_name'   => mpa_prefix( 'post' ),
		'show_image'      => false,
		'show_title'      => false,
		'show_content'    => false,
		'show_excerpt'    => false,
		'show_attributes' => false,
		'show_extra'      => false,
	),
	EXTR_SKIP
);

// Args for nested templates
$itemArgs = $template_args + array( 'view' => 'single' ); // Don't replace the view from loop-posts.php, if exists

// Hide content of the password protected posts
if ( post_password_required() ) {

	$show_extra      = false;
	$show_attributes = false;
	$show_excerpt    = false;
	$show_content    = false;
	$show_title      = false;
	$show_image      = false;
}

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
		if ( $show_image && has_post_thumbnail() ) {
			/**
			 * @param array Template args.
			 *
			 * @since 1.2
			 */
			do_action( "{$template_name}_item_image", $itemArgs );
		}
		?>

        <div class="loop-post-title-wrapper">
			<?php
			if ( $show_title ) {
				/**
				 * @param array Template args.
				 *
				 * @since 1.2
				 */
				do_action( "{$template_name}_item_title", $itemArgs );
			}
			?>

			<?php
			if ( $show_extra ) {
				/**
				 * @param array Template args.
				 *
				 * @since 1.2
				 */
				do_action( "{$template_name}_item_extra", $itemArgs );
			}
			?>
        </div>


		<?php
		if ( $show_content ) {
			/**
			 * @param array Template args.
			 *
			 * @since 1.2
			 */
			do_action( "{$template_name}_item_content", $itemArgs );
		}
		?>

		<?php
		if ( $show_excerpt ) {
			/**
			 * @param array Template args.
			 *
			 * @since 1.2
			 */
			do_action( "{$template_name}_item_excerpt", $itemArgs );
		}
		?>

		<?php
		if ( $show_attributes ) {
			/**
			 * @param array Template args.
			 *
			 * @since 1.2
			 */
			do_action( "{$template_name}_item_attributes", $itemArgs );
		}
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

<?php
/**
 * @param array Template args.
 *
 * @since 1.2
 */
do_action( "{$template_name}_after_item", $itemArgs );
?>
