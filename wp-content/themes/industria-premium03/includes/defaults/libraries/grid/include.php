<?php
	function load_alunos192_wp_admin_customgrid() {
		// global $post;
		// if ($post !== NULL && $post->post_type === 'alunos192') {

			wp_register_style( 'wp_admin_css_customgrid_cutegrids', get_template_directory_uri() . '/includes/defaults/libraries/grid/cutegrids.css', false, '1.0.0' );

			wp_enqueue_style( 'wp_admin_css_customgrid_cutegrids' );

			wp_register_style( 'wp_admin_css_customgrid_normalize', get_template_directory_uri() . '/includes/defaults/libraries/grid/normalize.css', false, '1.0.0' );

			wp_enqueue_style( 'wp_admin_css_customgrid_normalize' );

		// }
	}

	add_action( 'admin_enqueue_scripts', 'load_alunos192_wp_admin_customgrid' );
?>