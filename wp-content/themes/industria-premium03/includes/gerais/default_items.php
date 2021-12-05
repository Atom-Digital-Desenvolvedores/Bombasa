<?php
	// Our custom post type function
	function create_posttype_gerais() {
		/*
			$the_query = new WP_Query(array( 'post_type' => 'gerais', 'posts_per_page' => -1 , 'field' => 'ids'));
			echo $the_query->post_count;
			while ( $the_query->have_posts() ) {
				$the_query->the_post();
				echo get_the_ID() . ', ';
				wp_delete_post( get_the_ID() );
			}
		return;
		*/
		if(!get_page_by_path( 'configuracoes-do-google', OBJECT, 'gerais' )){
			$dataToInsert = array(
									'post_title'	=> 'Configurações do Google',
									'post_name'		=> 'configuracoes-do-google',
									'post_status'	=> 'publish',
									'post_type'		=> 'gerais'
								);
			$postRecordID = wp_insert_post($dataToInsert);
		}
		if(!get_page_by_path( 'configuracoes-da-logo', OBJECT, 'gerais' )){
			$dataToInsert = array(
									'post_title'	=> 'Configurações da Logo',
									'post_name'		=> 'configuracoes-da-logo',
									'post_status'	=> 'publish',
									'post_type'		=> 'gerais'
								);
			$postRecordID = wp_insert_post($dataToInsert);
		}
		if(!get_page_by_path( 'configuracoes-de-e-mail', OBJECT, 'gerais' )){
			$dataToInsert = array(
									'post_title'	=> 'Configurações de E-mail',
									'post_name'		=> 'configuracoes-de-e-mail',
									'post_status'	=> 'publish',
									'post_type'		=> 'gerais'
								);
			$postRecordID = wp_insert_post($dataToInsert);
		}
		if(!get_page_by_path( 'configuracoes-do-disqus', OBJECT, 'gerais' )){
			$dataToInsert = array(
									'post_title'	=> 'Configurações do Disqus',
									'post_name'		=> 'configuracoes-do-disqus',
									'post_status'	=> 'publish',
									'post_type'		=> 'gerais'
								);
			$postRecordID = wp_insert_post($dataToInsert);
		}
	}
	// Hooking up our function to theme setup
	add_action( 'init', 'create_posttype_gerais' );
?>
