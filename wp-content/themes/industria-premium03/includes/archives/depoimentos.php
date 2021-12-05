<?php

	add_action( 'cmb2_admin_init', 'metaboxes_depoimentos' );

	function metaboxes_depoimentos() {
		$depoimento_item = new_cmb2_box( array(
			'id'            => 'depoimento_item',
			'title'         => __( 'Detalhes do depoimento' ),
			'object_types'  => array( 'depoimentos192', ),
			'context'       => 'normal',
			'priority'      => 'high',
			'show_names'    => true,
			'closed'        => false,
		) );

		$depoimento_item->add_field( array(
			'name'       => __( 'Imagem do depoimento' ),
			'desc'       => __( 'Tamanho recomendado <strong>100x100</strong>' ),
			'id'         => 'wsg_depoimento_item_img',
			'type' => 'file',
			'preview_size' => array( 100/1, 100/1 ),
			'query_args' => array( 'type' => 'image' ),
		) );
		$depoimento_item->add_field( array(
			'name'       => __( 'Empresa/Cargo' ),
			'id'         => 'wsg_depoimento_item_cargo',
			'type'       => 'text',
		) );
		$depoimento_item->add_field( array(
			'name'       => __( 'Conteúdo do depoimento' ),
			'id'         => 'wsg_depoimento_item_conteudo',
			'type'       => 'wysiwyg',
		) );


	}

?>