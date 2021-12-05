<?php
	// Our custom post type function
	function create_posttype_contato() {
		/*
			$the_query = new WP_Query(array( 'post_type' => 'contato', 'posts_per_page' => -1 , 'field' => 'ids'));
			echo $the_query->post_count;
			while ( $the_query->have_posts() ) {
				$the_query->the_post();
				echo get_the_ID() . ', ';
				wp_delete_post( get_the_ID() );
			}
		return;
		*/
		if(!get_page_by_path( 'email', OBJECT, 'contatos' )){
			$dataToInsert = array(
									'post_title'	=> 'E-mails',
									'post_name'		=> 'email',
									'post_status'	=> 'publish',
									'post_type'		=> 'contatos'
								);
			$postRecordID = wp_insert_post($dataToInsert);
		}

		// if(!get_page_by_path( 'endereco', OBJECT, 'contatos' )){
		// 	$dataToInsert = array(
		// 							'post_title'	=> 'Endereços',
		// 							'post_name'		=> 'endereco',
		// 							'post_status'	=> 'publish',
		// 							'post_type'		=> 'contatos'
		// 						);
		// 	$postRecordID = wp_insert_post($dataToInsert);
		// }

		if(!get_page_by_path( 'telefones', OBJECT, 'contatos' )){
			$dataToInsert = array(
									'post_title'	=> 'Telefones',
									'post_name'		=> 'telefones',
									'post_status'	=> 'publish',
									'post_type'		=> 'contatos'
								);
			$postRecordID = wp_insert_post($dataToInsert);
		}
	}
	// Hooking up our function to theme setup
	add_action( 'init', 'create_posttype_contato' );
?>
