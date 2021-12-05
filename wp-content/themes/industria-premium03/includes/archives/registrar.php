<?php

// Meus posts types
	function meus_post_types(){

		// Produtos
		register_post_type('produtos192',
			array(
				'labels' 			=> array(
					'name' 			=> __('Produtos'),
					'singular_name'	=> _x('Produto', 'post type singular name'),
					'add_new'		=> _x('Novo Produto', 'portfolio item'),
					'add_new_item'	=> _x('Adicionar novo Produto', 'portfolio item'),
					'edit_item'		=> _x('Editar Produto', 'portfolio item'),
				),
				'rewrite' 			=> array('slug' => 'produtos'),
				'public' 			=> true,
				'has_archive' 		=> true,
				'menu_icon' 		=> 'dashicons-admin-post',
				'supports' 			=> array('title', 'page-attributes'),
			)
		);

		// Serviços
		register_post_type('servicos192',
			array(
				'labels' 			=> array(
					'name' 			=> __('Serviços'),
					'singular_name'	=> _x('Serviço', 'post type singular name'),
					'add_new'		=> _x('Novo Serviço', 'portfolio item'),
					'add_new_item'	=> _x('Adicionar novo Serviço', 'portfolio item'),
					'edit_item'		=> _x('Editar Serviço', 'portfolio item'),
				),
				'rewrite' 			=> array('slug' => 'servicos'),
				'public' 			=> true,
				'has_archive' 		=> true,
				'menu_icon' 		=> 'dashicons-admin-post',
				'supports' 			=> array('title', 'page-attributes'),
			)
		);

		// Depoimentos
		register_post_type('depoimentos192',
			array(
				'labels' 			=> array(
					'name' 			=> __('Depoimentos'),
					'singular_name'	=> _x('Depoimento', 'post type singular name'),
					'add_new'		=> _x('Novo Depoimento', 'portfolio item'),
					'add_new_item'	=> _x('Adicionar novo Depoimento', 'portfolio item'),
					'edit_item'		=> _x('Editar Depoimento', 'portfolio item'),
				),
				'rewrite' 			=> array('slug' => 'depoimentos'),
				'public' 			=> true,
				'has_archive' 		=> true,
				'menu_icon' 		=> 'dashicons-testimonial',
				'supports' 			=> array('title', 'page-attributes'),
			)
		);

		
		// Materiais
		register_post_type('materiais192',
			array(
				'labels' 			=> array(
					'name' 			=> __('Materiais'),
					'singular_name'	=> _x('Material', 'post type singular name'),
					'add_new'		=> _x('Novo Material', 'portfolio item'),
					'add_new_item'	=> _x('Adicionar novo Material', 'portfolio item'),
					'edit_item'		=> _x('Editar Material', 'portfolio item'),
				),
				'rewrite' 			=> array('slug' => 'materiais'),
				'public' 			=> true,
				'has_archive' 		=> true,
				'menu_icon' 		=> 'dashicons-admin-post',
				'supports' 			=> array('title', 'page-attributes'),
			)
		);


		// Unidades
		register_post_type('unidades192',
			array(
				'labels' 			=> array(
					'name' 			=> __('Unidades'),
					'singular_name'	=> _x('Unidade', 'post type singular name'),
					'add_new'		=> _x('Nova Unidade', 'portfolio item'),
					'add_new_item'	=> _x('Adicionar nova Unidade', 'portfolio item'),
					'edit_item'		=> _x('Editar Unidade', 'portfolio item'),
				),
				'rewrite' 			=> array('slug' => 'unidades'),
				'public' 			=> true,
				'has_archive' 		=> true,
				'menu_icon' 		=> 'dashicons-location',
				'supports' 			=> array('title', 'page-attributes'),
			)
		);


	}
	add_action('init', 'meus_post_types');

?>