<?php

	function load_alunos192_wp_admin_sweetalert2() {
		// global $post;
		// if ($post !== NULL && $post->post_type === 'alunos192') {
			wp_enqueue_script( 'alunos192_wp_admin_js_sweetalert2', get_template_directory_uri() . '/includes/defaults/libraries/sweetalert2/sweetalert.min.js' );

			wp_register_style( 'wp_admin_css_sweetalert2', get_template_directory_uri() . '/includes/defaults/libraries/sweetalert2/sweetalert.css', false, '1.0.0' );
			wp_enqueue_style( 'wp_admin_css_sweetalert2' );

			wp_enqueue_script( 'alunos192_wp_admin_js_sweetalert2_form', get_template_directory_uri() . '/includes/defaults/libraries/sweetalert2/swal-forms.js' );

			wp_register_style( 'wp_admin_css_sweetalert2_form', get_template_directory_uri() . '/includes/defaults/libraries/sweetalert2/swal-forms.css', false, '1.0.0' );

			wp_enqueue_style( 'wp_admin_css_sweetalert2_form' );

		// }
	}

	add_action( 'admin_enqueue_scripts', 'load_alunos192_wp_admin_sweetalert2' );

?>