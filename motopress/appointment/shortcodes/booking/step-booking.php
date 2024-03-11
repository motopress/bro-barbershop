<?php

/**
 * @param bool $show_add_to_calendar
 *
 * @since 1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Initialize args
extract(
	array(
		'show_add_to_calendar' => true,
	),
	EXTR_SKIP
);

?>
<div class="mpa-booking-step mpa-booking-step-booking mpa-hide">
	<?php
	$image_url = get_theme_mod( 'bro_barbershop_appointment_checkout_image', false );
	if ( $image_url ) : ?>
        <div class="mpa-booking-image-wrap">
            <img src="<?php echo esc_url( $image_url ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'title' ) ); ?>">
        </div>
	<?php endif; ?>

    <p class="mpa-message">
		<?php esc_html_e( 'Making a reservation...', 'bro-barbershop' ); ?>
        <span class="mpa-preloader"></span>
    </p>

	<?php if ( $show_add_to_calendar ) { ?>
		<?php mpa_display_template( 'shortcodes/booking/sections/booking-details-section.php' ); ?>
	<?php } ?>

    <p class="mpa-actions mpa-hide">
		<?php echo mpa_tmpl_button( esc_html__( 'Back', 'bro-barbershop' ), [ 'class' => 'button button-secondary mpa-button-back' ] ); ?>
		<?php echo mpa_tmpl_button( esc_html__( 'Add New Reservation', 'bro-barbershop' ), [ 'class' => 'button button-primary mpa-button-reset' ] ); ?>
    </p>
</div>
