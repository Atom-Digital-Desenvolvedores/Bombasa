<?php

	add_action( 'cmb2_admin_init', 'metaboxes_all_pages' );

	function metaboxes_all_pages() {

		$id_sobre 		= get_page_by_path( 'sobre-nos', OBJECT, 'page' )->ID;
		$id_produtos 	= get_page_by_path( 'produtos', OBJECT, 'page' )->ID;
		$id_servicos 	= get_page_by_path( 'servicos', OBJECT, 'page' )->ID;
		$id_equipe 		= get_page_by_path( 'equipe', OBJECT, 'page' )->ID;
		$id_blog 		= get_page_by_path( 'blog', OBJECT, 'page' )->ID;
		$id_contato 	= get_page_by_path( 'contato', OBJECT, 'page' )->ID;
		$id_suporte 	= get_page_by_path( 'suporte-tecnico', OBJECT, 'page' )->ID;
		$id_siemens 	= get_page_by_path( 'siemens', OBJECT, 'page' )->ID;
		$id_chint 		= get_page_by_path( 'chint', OBJECT, 'page' )->ID;
		$id_taf 		= get_page_by_path( 'taf', OBJECT, 'page' )->ID;
		$id_trabalhe 	= get_page_by_path( 'trabalhe-conosco', OBJECT, 'page' )->ID;
		$id_eficiencia 	= get_page_by_path( 'eficiencia-energetica', OBJECT, 'page' )->ID;

		is_array($all_pagesArray);

		$all_pagesArray = [ $id_sobre, $id_produtos, $id_servicos, $id_equipe, $id_blog, $id_contato, $id_suporte, $id_siemens, $id_chint, $id_taf, $id_trabalhe, $id_eficiencia ];

		// Metabox Banner
		$banner_all_pages = new_cmb2_box( array(
			'id'            => 'banner_all_pages',
			'title'         => __( 'Banner' ),
			'object_types'  => array( 'page', ),
			'show_on'       => array( 'key' => 'id', 'value' => $all_pagesArray ),
			'context'       => 'normal',
			'priority'      => 'high',
			'show_names'    => true,
			'closed'        => true,
		) );

		$banner_all_pages->add_field( array(
			'name'         => __( 'Imagem do banner' ),
			'desc'         => __( 'Tamanho recomendado <strong>1920x110</strong>' ),
			'id'           => 'wsg_banner_all_pages_img',
			'type'         => 'file',
			'preview_size' => array( 1920/1, 110/1 ),
			'query_args'   => array( 'type' => 'image' ),
		) );

	}

?>