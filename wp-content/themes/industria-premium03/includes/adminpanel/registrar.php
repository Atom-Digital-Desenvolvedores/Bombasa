<?php
	add_action('init', 'custom_post_adminpanel_register');
	function custom_post_adminpanel_register() {
		$labels = array(
			'name' => _x('Agência Info.', 'post type general name'),
			'singular_name' => _x('Agência', 'post type singular name'),
			'add_new' => _x('Nova informação', 'portfolio item'),
			'add_new_item' => __('Novo'),
			'edit_item' => __('Editar'),
			'new_item' => __('Novo'),
			'view_item' => __('Ver'),
			'search_items' => __('Pesquisar'),
			'not_found' =>  __('Nenhuma informação encontrada'),
			'not_found_in_trash' => __('Nenhuma informação na lixeira'),
			'parent_item_colon' => '',
		);

		$args = array(
			'menu_icon'	=> 'dashicons-businessman',
			'labels' => $labels,
			'public' => true,
			'publicly_queryable' => true,
			'show_ui' => true,
			'query_var' => true,
			'rewrite' => array( 'slug' => 'adminpanel'),
			'hierarchical' => false,
			'has_archive' => true,
			'menu_position' => 101,
			'supports' => array('title'),
			'map_meta_cap' => true,
			'capabilities' => array(
				'edit_published_posts'				=>	'edit_published_adminpanel_s',
				'publish_posts'						=>	'publish_adminpanel',
				'delete_published_posts'			=>	'delete_published_adminpanel_s',
				'edit_posts'						=>	'edit_adminpanel',
				'delete_posts'						=>	'delete_adminpanel_s',
				'edit_others_posts'					=>	'edit_others_adminpanel',
				'delete_others_posts'				=>	'delete_others_adminpanel_s',
				'delete_private_posts'				=>	'delete_private_adminpanel_s',
				'edit_private_posts'				=>	'edit_private_adminpanel_s',
				'read_private_posts'				=>	'read_private_adminpanel',
			),
		);
		register_post_type( 'adminpanel' , $args );
		flush_rewrite_rules();
	}

?>