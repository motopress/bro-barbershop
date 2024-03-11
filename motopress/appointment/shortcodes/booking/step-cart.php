<?php

/**
 * @since 1.4.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

?>
<div class="mpa-booking-step mpa-booking-step-cart mpa-hide">
    <p class="mpa-shortcode-title">
		<?php esc_html_e( 'Your Reservation', 'bro-barbershop' ); ?>
    </p>

    <div class="mpa-cart">
        <div class="mpa-cart-items">
            <div class="mpa-cart-item mpa-cart-item-template">
                <div class="item-header">
                    <div class="cell cell-service">
                        <span class="cell-value mpa-service-name">{service_name}</span>
                    </div>
                    <div class="cell cell-date">
                        <div class="cell-value">
                            <span class="mpa-reservation-date">{reservation_date}</span>,
                            <span class="mpa-reservation-time">{reservation_time}</span>
                        </div>
                    </div>
                    <div class="item-actions">
						<?php
						$buttonText = esc_html__( 'Edit', 'bro-barbershop' );
						$class      = 'edit';

						if ( mpapp()->settings()->isMultibookingEnabled() ) {
							$buttonText = esc_html__( 'Remove', 'bro-barbershop' );
							$class      = 'remove';
						}

						echo mpa_tmpl_button( $buttonText, [ 'class' => 'button button-secondary mpa-button-edit-or-remove ' . $class ] );
						?>

                        <button class="item-toggle"><span></span><span></span></button>
                    </div>
                </div>
                <div class="item-body">
                    <div class="cell cell-location">
                        <p class="cell-title">
							<?php
							if ( empty( $label_location ) ) {
								esc_html_e( 'Location', 'bro-barbershop' );
							} else {
								echo esc_html( $label_location );
							}
							?>
                        </p>
                        <span class="cell-value mpa-location-name">{location_name}</span>
                    </div>
                    <div class="cell cell-people">
                        <p class="cell-title"><?php esc_html_e( 'Clients', 'bro-barbershop' ); ?></p>
                        <div class="cell-value mpa-reservation-capacity">{reservation_capacity}</div>
                    </div>
                    <div class="cell cell-employee">
                        <p class="cell-title">
							<?php
							if ( empty( $label_employee ) ) {
								esc_html_e( 'Employee', 'bro-barbershop' );
							} else {
								echo esc_html( $label_employee );
							}
							?>
                        </p>
                        <span class="cell-value mpa-employee-name">{employee_name}</span>
                    </div>
                    <div class="cell cell-price">
                        <p class="cell-title"><?php esc_html_e( 'Price', 'bro-barbershop' ); ?></p>
                        <span class="cell-value mpa-reservation-price">{reservation_price}</span>
                    </div>
                </div>
            </div>

            <div class="no-items">
				<?php esc_html_e( 'Your cart is empty.', 'bro-barbershop' ); ?>
            </div>
        </div>
    </div>

    <p class="mpa-cart-total">
		<?php
		// Translators: %s: total price, like "$199".
		$totalText  = esc_html__( 'Total: %s', 'bro-barbershop' );
		$totalPrice = mpa_tmpl_price_number( 0 );

		printf( $totalText, '<span class="mpa-cart-total-price">' . $totalPrice . '</span>' );
		?>
    </p>

    <p class="mpa-actions mpa-hide">
		<?php
		if ( mpapp()->settings()->isMultibookingEnabled() ) {
			echo mpa_tmpl_button( esc_html__( 'Add More', 'bro-barbershop' ), [ 'class' => 'button button-primary mpa-button-new' ] );
		}
		?>

		<?php echo mpa_tmpl_button( esc_html__( 'Next', 'bro-barbershop' ), [ 'class' => 'button button-primary mpa-button-next' ] ); ?>
    </p>
</div>
