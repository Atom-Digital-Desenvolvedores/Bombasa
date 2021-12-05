<?php

// Minhas taxonomies
	function minhas_taxonomies(){

		// Na home
		register_taxonomy( 'categorias_produtos', array( 'produtos192' ), array(
			'hierarchical' => true,
			'label' => __( 'Categorias' ),
			'show_ui' => true,
			'show_in_tag_cloud' => false,
			'query_var' => true,
				'rewrite' => array(
					'slug' => 'categoria-produtos',
					'with_front' => true,
				),
				'capabilities' => array(
					'manage_terms' => true,
					'edit_terms' => true,
					'delete_terms' => true,
				)
			)
		);

		// Na home
		register_taxonomy( 'formatos_materiais', array( 'materiais192' ), array(
			'hierarchical' => true,
			'label' => __( 'Formatos materiais' ),
			'show_ui' => true,
			'show_in_tag_cloud' => false,
			'query_var' => true,
				'rewrite' => array(
					'slug' => 'formatos-materiais',
					'with_front' => true,
				),
				'capabilities' => array(
					'manage_terms' => true,
					'edit_terms' => true,
					'delete_terms' => true,
				)
			)
		);
		// Na home
		register_taxonomy( 'categorias_materiais', array( 'materiais192' ), array(
			'hierarchical' => true,
			'label' => __( 'Categorias materiais' ),
			'show_ui' => true,
			'show_in_tag_cloud' => false,
			'query_var' => true,
				'rewrite' => array(
					'slug' => 'categorias-materiais',
					'with_front' => true,
				),
				'capabilities' => array(
					'manage_terms' => true,
					'edit_terms' => true,
					'delete_terms' => true,
				)
			)
		);


	}
	add_action('init', 'minhas_taxonomies');

?>