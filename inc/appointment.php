<?php

function barbershop_mpa_pagination_args( $args ) {
	$icon_prev = '<svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M0.292893 8.70711C-0.0976315 8.31658 -0.0976315 7.68342 0.292893 7.29289L6.65685 0.928932C7.04738 0.538408 7.68054 0.538408 8.07107 0.928932C8.46159 1.31946 8.46159 1.95262 8.07107 2.34315L2.41421 8L8.07107 13.6569C8.46159 14.0474 8.46159 14.6805 8.07107 15.0711C7.68054 15.4616 7.04738 15.4616 6.65685 15.0711L0.292893 8.70711ZM16 9L1 9V7L16 7V9Z"/>
</svg>';

	$icon_next = '<svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M15.7071 8.70711C16.0976 8.31658 16.0976 7.68342 15.7071 7.29289L9.34315 0.928932C8.95262 0.538408 8.31946 0.538408 7.92893 0.928932C7.53841 1.31946 7.53841 1.95262 7.92893 2.34315L13.5858 8L7.92893 13.6569C7.53841 14.0474 7.53841 14.6805 7.92893 15.0711C8.31946 15.4616 8.95262 15.4616 9.34315 15.0711L15.7071 8.70711ZM0 9L15 9V7L0 7L0 9Z"/>
</svg>';

	$new_args = [
		'prev_text' => $icon_prev,
		'next_text' => $icon_next,
		'before_page_number' => '<span class="meta-nav screen-reader-text">' . esc_html__( 'Page', 'bro-barbershop' ) . ' </span>',
		'mid_size' => 2,
	];

	return array_merge( $args, $new_args );
}

add_filter( 'mpa_employees_list_pagination_args', 'barbershop_mpa_pagination_args' );
add_filter( 'mpa_locations_list_pagination_args', 'barbershop_mpa_pagination_args' );
add_filter( 'mpa_services_list_pagination_args', 'barbershop_mpa_pagination_args' );

function bro_barbershop_appointment_service_templates() {

	if ( is_page_template( 'template-canvas-service.php' ) ) {
		remove_action( 'mpa_service_single_post_attributes', 'barbershop_before_mpa_service_single_attributes', 1 );
		remove_action( 'mpa_service_single_post_attributes', 'barbershop_after_mpa_service_single_attributes', 20 );
		remove_action( 'mpa_service_single_post_attributes', array(
			MotoPress\Appointment\Views\PostTypesView::getInstance(),
			'serviceSinglePostAttributes'
		) );
	}
}

add_action( 'template_redirect', 'bro_barbershop_appointment_service_templates' );

function barbershop_mpa_employees_list_item_title() { ?>
    <div class="mpa-employee-content-wrap">
    <div class="mpa-employee-content">
<?php }

add_action( 'mpa_employees_list_item_title', 'barbershop_mpa_employees_list_item_title', 1 );

function barbershop_mpa_employees_list_before_item_end() { ?>
    </div>
    <div class="entry-link-wrapper">
        <a href="<?php the_permalink(); ?>"
           class="button-creative entry-link"><?php esc_html_e( 'Book an Appointment', 'bro-barbershop' ); ?></a>
    </div>
    </div>
<?php }

add_action( 'mpa_employees_list_before_item_end', 'barbershop_mpa_employees_list_before_item_end', 10 );

function bro_barbershop_appointment_employee_templates() {
	if ( is_page_template( 'template-canvas-employee.php' ) ) {
		remove_action( 'mpa_employee_single_post_attributes', array(
			MotoPress\Appointment\Views\PostTypesView::getInstance(),
			'employeeSinglePostContacts'
		), 15 );

		remove_action( 'mpa_employee_single_post_attributes', array(
			MotoPress\Appointment\Views\PostTypesView::getInstance(),
			'employeeSinglePostSocialNetworks'
		), 20 );

		remove_action( 'mpa_employee_single_post_attributes', array(
			MotoPress\Appointment\Views\PostTypesView::getInstance(),
			'employeeSinglePostAdditionalInfo'
		), 30 );
	}
}

add_action( 'template_redirect', 'bro_barbershop_appointment_employee_templates', 20 );

add_filter( 'mpa_employee_single_post_contacts_title', '__return_empty_string' );
add_filter( 'mpa_employee_single_post_attributes_title', '__return_empty_string' );
add_filter( 'mpa_employee_single_post_social_networks_title', '__return_empty_string' );
add_filter( 'mpa_employee_single_post_additional_info_title', '__return_empty_string' );
