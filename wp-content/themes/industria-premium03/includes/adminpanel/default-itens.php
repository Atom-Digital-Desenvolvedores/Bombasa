<?php
	// Our custom post type function
	function create_posttype_adminpanel() {
		/*
		return;
			$the_query = new WP_Query(array( 'post_type' => 'adminpanel', 'posts_per_page' => -1 , 'field' => 'ids'));
			echo $the_query->post_count;
			while ( $the_query->have_posts() ) {
				$the_query->the_post();
				echo get_the_ID() . ', ';
				wp_delete_post( get_the_ID() );
			}
		return;
		*/
		if(!get_page_by_path( 'slug-tela-de-login', OBJECT, 'adminpanel' )){
			$dataToInsert = array(
									'post_title'	=> 'Tela de login',
									'post_name'		=> 'slug-tela-de-login',
									'post_status'	=> 'publish',
									'post_type'		=> 'adminpanel'
								);
			$postRecordID = wp_insert_post($dataToInsert);
		}
		if(!get_page_by_path( 'slug-outras-info', OBJECT, 'adminpanel' )){
			$dataToInsert = array(
									'post_title'	=> 'Outros',
									'post_name'		=> 'slug-outras-info',
									'post_status'	=> 'publish',
									'post_type'		=> 'adminpanel'
								);
			$postRecordID = wp_insert_post($dataToInsert);
		}
	}
	// Hooking up our function to theme setup
	add_action( 'init', 'create_posttype_adminpanel' );
?>
