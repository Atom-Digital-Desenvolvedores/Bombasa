<?php

	add_action( 'cmb2_admin_init', 'metaboxes_materiais' );

	function metaboxes_materiais() {

		// Detalhes do material
		$material_item = new_cmb2_box( array(
			'id'            => 'material_item',
			'title'         => __( 'Detalhes do material' ),
			'object_types'  => array( 'materiais192', ),
			'context'       => 'normal',
			'priority'      => 'high',
			'show_names'    => true,
			'closed'        => false,
		) );

		$material_item->add_field( array(
			'name'       => __( 'Imagem do material' ),
			'desc'       => __( 'Tamanho recomendado <strong>220x168</strong>' ),
			'id'         => 'wsg_material_item_img',
			'type' => 'file',
			'preview_size' => array( 220/1, 168/1 ),
			'query_args' => array( 'type' => 'image' ),
		) );
		$material_item->add_field( array(
			'name'       => __( 'Resumo do material' ),
			'id'         => 'wsg_material_item_resumo',
			'type'       => 'wysiwyg',
		) );
		$material_item->add_field( array(
			'name'       => __( 'PDF do material' ),
			'id'         => 'wsg_material_item_pdf',
			'type' => 'file',
			'query_args' => array(
				'type' => 'application/pdf', // Make library only display PDFs. ),
			),
		));


		// Método de especificação de página
		$projetosPage = get_page_by_path( 'materiais', OBJECT, 'page' );

		$post_id;

		if (isset($_GET['post'])) {
			$post_id = $_GET['post'];
		}else if(isset($_POST['post_ID'])) {
			$post_id = $_POST['post_ID'];
		}
		if( !isset( $post_id ) ) return;

		if($projetosPage && $projetosPage->ID != $post_id){
			return;
		}

		// Metabox materiais
		$materiais_01 = new_cmb2_box( array(
			'id'            => 'materiais_01',
			'title'         => __( 'materiais' ),
			'object_types'  => array( 'page', ),
			'context'       => 'normal',
			'priority'      => 'high',
			'show_names'    => true,
			'closed'        => true,
		) );

		$materiais_01->add_field( array(
			'name'       => __( 'Título da seção' ),
			'id'         => 'wsg_materiais_01_titulo',
			'type'       => 'text',
		) );
		$materiais_01->add_field( array(
			'name'       => __( 'Texto da seção' ),
			'id'         => 'wsg_materiais_01_texto',
			'type'       => 'wysiwyg',
		) );

	}

?>