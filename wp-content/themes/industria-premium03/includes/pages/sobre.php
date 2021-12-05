<?php

	add_action( 'cmb2_admin_init', 'metaboxes_sobre' );

	function metaboxes_sobre() {

		// Método de especificação de página
		$sobrePage = get_page_by_path( 'sobre-nos', OBJECT, 'page' );

		$post_id;

		if (isset($_GET['post'])) {
			$post_id = $_GET['post'];
		}else if(isset($_POST['post_ID'])) {
			$post_id = $_POST['post_ID'];
		}
		if( !isset( $post_id ) ) return;

		if($sobrePage && $sobrePage->ID != $post_id){
			return;
		}

		// Metabox Sobre
		$sobre_01 = new_cmb2_box( array(
			'id'            => 'sobre_01',
			'title'         => __( 'Sobre nós' ),
			'object_types'  => array( 'page', ),
			'context'       => 'normal',
			'priority'      => 'high',
			'show_names'    => true,
			'closed'        => true,
		) );

		$sobre_01->add_field( array(
			'name'       => __( 'Imagens da seção' ),
			'desc'       => __( 'Tamanho recomendado <strong>530x334</strong>' ),
			'id'         => 'wsg_sobre_01_img',
			'type' => 'file_list',
			'preview_size' => array( 530/1, 334/1 ),
			'query_args' => array( 'type' => 'image' ),
		) );

		$sobre_01->add_field( array(
			'name'       => __( 'Título da seção' ),
			'id'         => 'wsg_sobre_01_titulo',
			'type'       => 'text',
		) );
		$sobre_01->add_field( array(
			'name'       => __( 'Texto da seção' ),
			'id'         => 'wsg_sobre_01_texto',
			'type'       => 'wysiwyg',
		) );

		$sobre_01_items = $sobre_01->add_field( array(
			'name'			=> __( 'Estatísticas' ),
			'id'            => 'sobre_01_items',
			'type'          => 'group',
			'options'       => array(
				'group_title'   => __( 'Item {#}' ),
				'add_button'    => __( 'Adicionar Outro Item' ),
				'remove_button' => __( 'Remover Item' ),
				'sortable'      => true,
				'closed'        => true,
			),
		) );
		$sobre_01->add_group_field( $sobre_01_items, array(
			'name'       => __( 'Imagem do item' ),
			'desc'       => __( 'Tamanho recomendado <strong>100x100</strong>' ),
			'id'         => 'wsg_sobre_01_items_img',
			'type' => 'file',
			'preview_size' => array( 100/1, 100/1 ),
			'query_args' => array( 'type' => 'image' ),
		) );
		$sobre_01->add_group_field( $sobre_01_items, array(
			'name'       => __( 'Valor do item' ),
			'id'         => 'wsg_sobre_01_items_valor',
			'type' => 'text',
		) );
		$sobre_01->add_group_field( $sobre_01_items, array(
			'name'       => __( 'Texto do item' ),
			'id'         => 'wsg_sobre_01_items_texto',
			'type' => 'text',
		) );

		// Metabox sobre_02
		$sobre_02 = new_cmb2_box( array(
			'id'            => 'sobre_02',
			'title'         => __( 'Missão, visão e valores' ),
			'object_types'  => array( 'page', ),
			'context'       => 'normal',
			'priority'      => 'high',
			'show_names'    => true,
			'closed'        => true,
		) );

		$sobre_02_items = $sobre_02->add_field( array(
			'id'            => 'sobre_02_items',
			'type'          => 'group',
			'options'       => array(
				'group_title'   => __( 'Item {#}' ),
				'add_button'    => __( 'Adicionar Outro Item' ),
				'remove_button' => __( 'Remover Item' ),
				'sortable'      => true,
				'closed'        => true,
			),
		) );
		$sobre_02->add_group_field( $sobre_02_items, array(
			'name'       => __( 'Imagem do item' ),
			'desc'       => __( 'Tamanho recomendado <strong>100x100</strong>' ),
			'id'         => 'wsg_sobre_02_items_img',
			'type' => 'file',
			'preview_size' => array( 100/1, 100/1 ),
			'query_args' => array( 'type' => 'image' ),
		) );

		$sobre_02->add_group_field( $sobre_02_items, array(
			'name'       => __( 'Título do item' ),
			'id'         => 'wsg_sobre_02_items_titulo',
			'type' => 'Text',
		) );

		$sobre_02->add_group_field( $sobre_02_items, array(
			'name'       => __( 'Texto do item' ),
			'id'         => 'wsg_sobre_02_items_texto',
			'type' => 'wysiwyg',
		) );

		// Metabox Sobre
		$sobre_footer = new_cmb2_box( array(
			'id'            => 'sobre_footer',
			'title'         => __( 'Rodapé' ),
			'object_types'  => array( 'page', ),
			'context'       => 'normal',
			'priority'      => 'high',
			'show_names'    => true,
			'closed'        => true,
		) );

		$sobre_footer->add_field( array(
			'name'       => __( 'Copyright do rodapé' ),
			'id'         => 'wsg_sobre_footer_copyright',
			'type'       => 'wysiwyg',
		) );


	}

?>