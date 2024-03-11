<?php
/**
 * Bro Barbershop Theme Customizer
 *
 * @package Bro_Barbershop
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function bro_barbershop_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial(
			'blogname',
			array(
				'selector'        => '.site-title a',
				'render_callback' => 'bro_barbershop_customize_partial_blogname',
			)
		);
		$wp_customize->selective_refresh->add_partial(
			'blogdescription',
			array(
				'selector'        => '.site-description',
				'render_callback' => 'bro_barbershop_customize_partial_blogdescription',
			)
		);
	}

	$wp_customize->add_panel( 'bro_barbershop_theme_options', array(
		'title' => esc_html__( 'Theme Options', 'bro-barbershop' ),
	) );

	$wp_customize->add_section( 'bro_barbershop_blog_options', array(
		'title' => esc_html__( 'Blog', 'bro-barbershop' ),
		'panel' => 'bro_barbershop_theme_options'
	) );

	$wp_customize->add_setting( 'bro_barbershop_blog_layout', array(
		'default'           => 'default',
		'sanitize_callback' => 'bro_barbershop_sanitize_select'
	) );

	$wp_customize->add_control( 'bro_barbershop_blog_layout', array(
		'type'    => 'select',
		'section' => 'bro_barbershop_blog_options',
		'label'   => esc_html__( 'Blog layout', 'bro-barbershop' ),
		'choices' => array(
			'default' => esc_html__( 'Default', 'bro-barbershop' ),
			'grid'    => esc_html__( 'Grid', 'bro-barbershop' ),
		),
	) );

	$wp_customize->add_section( 'bro_barbershop_header', array(
		'title' => esc_html__( 'Header', 'bro-barbershop' ),
		'panel' => 'bro_barbershop_theme_options'
	) );

	$wp_customize->add_setting( 'bro_barbershop_menu_overflow', array(
		'default'           => false,
		'transport'         => 'refresh',
		'type'              => 'theme_mod',
		'sanitize_callback' => 'bro_barbershop_sanitize_checkbox'
	) );

	$wp_customize->add_control( 'bro_barbershop_menu_overflow', array(
			'label'       => esc_html__( 'Show main menu always in one line?', 'bro-barbershop' ),
			'description' => esc_html__( 'Menu items that do not fit will be moved to dropdown.', 'bro-barbershop' ),
			'section'     => 'bro_barbershop_header',
			'type'        => 'checkbox',
			'settings'    => 'bro_barbershop_menu_overflow'
		)
	);

	$wp_customize->add_section(
		'bro_barbershop_footer',
		array(
			'title' => esc_html__( 'Footer', 'bro-barbershop' ),
			'panel' => 'bro_barbershop_theme_options'
		)
	);

	$wp_customize->add_setting( 'bro_barbershop_show_footer_text', array(
		'default'           => true,
		'type'              => 'theme_mod',
		'sanitize_callback' => 'bro_barbershop_sanitize_checkbox'
	) );

	$wp_customize->add_control( 'bro_barbershop_show_footer_text', array(
			'label'    => esc_html__( 'Show Footer Text?', 'bro-barbershop' ),
			'section'  => 'bro_barbershop_footer',
			'type'     => 'checkbox',
			'settings' => 'bro_barbershop_show_footer_text'
		)
	);

	$default_footer_text = esc_html_x( '%1$s &copy; %2$s - All Rights Reserved', 'Default footer text, %1$s - blog name, %2$s - current year', 'bro-barbershop' );
	$wp_customize->add_setting( 'bro_barbershop_footer_text', array(
		'default'           => $default_footer_text,
		'type'              => 'theme_mod',
		'sanitize_callback' => 'wp_kses_post'
	) );

	$wp_customize->add_control( 'bro_barbershop_footer_text', array(
			'label'       => esc_html__( 'Footer Text', 'bro-barbershop' ),
			'description' => esc_html__( 'Use %1$s to insert the blog name, %2$s to insert the current year. Doesn`t work for Live Preview.', 'bro-barbershop' ),
			'section'     => 'bro_barbershop_footer',
			'type'        => 'textarea',
			'settings'    => 'bro_barbershop_footer_text'
		)
	);

	$wp_customize->add_section( 'bro_barbershop_appointment', array(
		'title' => esc_html__( 'Appointment', 'bro-barbershop' ),
		'panel' => 'bro_barbershop_theme_options'
	) );

	$wp_customize->add_setting( 'bro_barbershop_main_sidebar_button_text', array(
		'default'           => '',
		'type'              => 'theme_mod',
		'sanitize_callback' => 'sanitize_text_field'
	) );

	$wp_customize->add_control( 'bro_barbershop_main_sidebar_button_text', array(
		'label'       => esc_html__( 'Sidebar toggle button text', 'bro-barbershop' ),
		'description' => esc_html__( 'Leave blank if you want hide button.', 'bro-barbershop' ),
		'section'     => 'bro_barbershop_appointment',
		'type'        => 'text',
		'settings'    => 'bro_barbershop_main_sidebar_button_text'
	) );

	$wp_customize->add_setting( 'bro_barbershop_appointment_checkout_image', array(
		'default'           => '',
		'sanitize_callback' => 'esc_url_raw'
	) );

	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'bro_barbershop_appointment_checkout_image', array(
			'label'    => esc_html__( 'Image used at booking checkout', 'bro-barbershop' ),
			'section'  => 'bro_barbershop_appointment',
			'settings' => 'bro_barbershop_appointment_checkout_image',
		)
	) );
}

add_action( 'customize_register', 'bro_barbershop_customize_register' );

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function bro_barbershop_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function bro_barbershop_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function bro_barbershop_customize_preview_js() {
	wp_enqueue_script( 'bro-barbershop-customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), BRO_BARBERSHOP_VERSION, true );
}

add_action( 'customize_preview_init', 'bro_barbershop_customize_preview_js' );

function bro_barbershop_sanitize_checkbox( $input ) {
	return filter_var( $input, FILTER_VALIDATE_BOOLEAN );
}

function bro_barbershop_sanitize_select( $input, $setting ) {
	//input must be a slug: lowercase alphanumeric characters, dashes and underscores are allowed only
	$input = sanitize_key( $input );

	//get the list of possible select options
	$choices = $setting->manager->get_control( $setting->id )->choices;

	//return input if valid or return default option
	return ( array_key_exists( $input, $choices ) ? $input : $setting->default );
}
