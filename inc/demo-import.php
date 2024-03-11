<?php

/**
 *
 * Demo data
 *
 **/

function bro_barbershop_ocdi_import_files() {
	$import_notice = '<h4>' . __( 'Important note before importing sample data.', 'bro-barbershop' ) . '</h4>';
	$import_notice .= __( 'Data import is generally not immediate and can take up to 10 minutes.', 'bro-barbershop' ) . '<br/>';
	$import_notice .= __( 'After you import this demo, you will have to configure the Instagram API key and Google Maps API key separately.', 'bro-barbershop' );

	$import_notice = wp_kses(
		$import_notice,
		array(
			'a'  => array(
				'href' => array(),
			),
			'ol' => array(),
			'li' => array(),
			'h4' => array(),
			'br' => array(),
		)
	);

	return array(
		array(
			'import_file_name'             => 'Bro Barbershop Demo',
			'import_file_url'              => 'https://raw.githubusercontent.com/motopress/bro-barbershop/master/assets/demo-data/bro-barbershop.xml',
			'import_widget_file_url'       => 'https://raw.githubusercontent.com/motopress/bro-barbershop/master/assets/demo-data/bro-barbershop-widgets.wie',
			'import_customizer_file_url'   => 'https://raw.githubusercontent.com/motopress/bro-barbershop/master/assets/demo-data/bro-barbershop-customizer.dat',
			'import_notice'                => $import_notice,
		),
	);
}

add_filter( 'pt-ocdi/import_files', 'bro_barbershop_ocdi_import_files' );


function bro_barbershop_ocdi_after_import_setup() {

	// Assign menus to their locations.
	$menu1 = get_term_by( 'slug', 'primary', 'nav_menu' );

	set_theme_mod( 'nav_menu_locations', array(
			'menu-1' => $menu1->term_id,
		)
	);

	// Assign front page and posts page (blog page).
	$front_page = bro_barbershop_get_page_by_title( 'Home' );

	if ( $front_page ) {
		update_option( 'page_on_front', $front_page->ID );
	}

	$blog_page = bro_barbershop_get_page_by_title( 'Blog' );

	if ( $blog_page ) {
		update_option( 'page_for_posts', $blog_page->ID );
	}

	update_option( 'show_on_front', 'page' );
	update_option( 'getwid_section_content_width', 1400 );
	set_theme_mod( 'bro_barbershop_main_sidebar_button_text', 'Book an appointment' );

	$bcn_options               = get_option( 'bcn_options', [] );
	$bcn_options['hseparator'] = '&#124;';
	update_option( 'bcn_options', $bcn_options );

	//update taxonomies
	$update_taxonomies = array(
		'post_tag',
		'category'
	);

	foreach ( $update_taxonomies as $taxonomy ) {
		bro_barbershop_ocdi_update_taxonomy( $taxonomy );
	}

}

add_action( 'pt-ocdi/after_import', 'bro_barbershop_ocdi_after_import_setup' );

// Disable the branding notice
add_filter( 'pt-ocdi/disable_pt_branding', '__return_true' );

function bro_barbershop_ocdi_update_taxonomy( $taxonomy ) {
	$get_terms_args = array(
		'taxonomy'   => $taxonomy,
		'fields'     => 'ids',
		'hide_empty' => false,
	);

	$update_terms = get_terms( $get_terms_args );
	if ( $taxonomy && $update_terms ) {
		wp_update_term_count_now( $update_terms, $taxonomy );
	}
}

function bro_barbershop_make_existed_widgets_inactive() {
	$widgets = get_option( 'sidebars_widgets' );

	$sidebars = array(
		'sidebar-1',
	);

	foreach ( $sidebars as $sidebar ) {
		if ( is_active_sidebar( $sidebar ) ) {
			$widgets['wp_inactive_widgets'] = array_merge( $widgets['wp_inactive_widgets'], $widgets[ $sidebar ] );
			$widgets[ $sidebar ]            = [];
		}
	}

	update_option( 'sidebars_widgets', $widgets );
}

add_action( 'pt-ocdi/widget_importer_before_widgets_import', 'bro_barbershop_make_existed_widgets_inactive' );


function bro_barbershop_get_page_by_title( $title ) {
	$posts = get_posts(
		array(
			'post_type'              => 'page',
			'title'                  => $title,
			'post_status'            => 'all',
			'numberposts'            => 1,
			'update_post_term_cache' => false,
			'update_post_meta_cache' => false,
			'orderby'                => 'post_date',
			'order'                  => 'DESC',
		)
	);

	if ( ! empty( $posts ) ) {
		$page_got_by_title = $posts[0];
	} else {
		$page_got_by_title = null;
	}

	return $page_got_by_title;

}
