<?php

	function load_alunos192_wp_admin_mask() {
		// global $post;
		// if ($post !== NULL && $post->post_type === 'alunos192') {

			wp_enqueue_script( 'alunos192_wp_admin_js_maskedinput', get_template_directory_uri() . '/includes/defaults/libraries/mask/jquery.maskedinput.min.js' );

			wp_enqueue_script( 'alunos192_wp_admin_js_autonumeric', get_template_directory_uri() . '/includes/defaults/libraries/mask/autoNumeric/autoNumeric.js' );

			wp_enqueue_script( 'alunos192_wp_admin_js_mask_script', get_template_directory_uri() . '/includes/defaults/libraries/mask/script.js' );

		// }
	}

	add_action( 'admin_enqueue_scripts', 'load_alunos192_wp_admin_mask' );
?>