<?php

	add_action( 'cmb2_admin_init', 'metaboxes_produtos' );

	function metaboxes_produtos() {

		// Detalhes do produto na home
		$produto_item = new_cmb2_box( array(
			'id'            => 'produto_item',
			'title'         => __( 'Detalhes do produto na home' ),
			'object_types'  => array( 'produtos192', ),
			'context'       => 'normal',
			'priority'      => 'high',
			'show_names'    => true,
			'closed'        => false,
		) );

		$produto_item->add_field( array(
			'name'       => __( 'Imagem do produto' ),
			'desc'       => __( 'Tamanho recomendado <strong>262x212</strong>' ),
			'id'         => 'wsg_produto_item_img',
			'type' => 'file',
			'preview_size' => array( 262/1, 212/1 ),
			'query_args' => array( 'type' => 'image' ),
		) );
		$produto_item->add_field( array(
			'name'       => __( 'Resumo do produto' ),
			'id'         => 'wsg_produto_item_resumo',
			'type'       => 'wysiwyg',
		) );

		// Página do produto
		$produto_interna = new_cmb2_box( array(
			'id'            => 'produto_interna',
			'title'         => __( 'Página do produto' ),
			'object_types'  => array( 'produtos192', ),
			'context'       => 'normal',
			'priority'      => 'high',
			'show_names'    => true,
			'closed'        => false,
		) );
		$produto_interna->add_field( array(
			'name'       => __( 'Imagens do produto' ),
			'desc'       => __( 'Tamanho recomendado <strong>500x292</strong>' ),
			'id'         => 'wsg_produto_interna_img',
			'type' => 'file_list',
			'preview_size' => array( 500/1, 292/1 ),
			'query_args' => array( 'type' => 'image' ),
		) );
		$produto_interna->add_field( array(
			'name'       => __( 'Conteúdo do produto' ),
			'id'         => 'wsg_produto_interna_conteudo',
			'type'       => 'wysiwyg',
		) );

		$produto_interna->add_field( array(
			'name'       => __( 'video do produto' ),
			'id'         => 'wsg_produto_interna_video',
			'type'       => 'textarea_code',
		) );
		$produto_interna->add_field( array(
			'name'       => __( 'ficha tecnica do produto' ),
			'id'         => 'wsg_produto_interna_ficha_tecnica',
			'type'       => 'wysiwyg',
		) );

		$produto_interna_items = $produto_interna->add_field( array(
			'name'			=> __( 'Downloads' ),
			'id'            => 'produto_interna_items',
			'type'          => 'group',
			'options'       => array(
				'group_title'   => __( 'Item {#}' ),
				'add_button'    => __( 'Adicionar Outro Item' ),
				'remove_button' => __( 'Remover Item' ),
				'sortable'      => true,
				'closed'        => true,
			),
		) );
		$produto_interna->add_group_field( $produto_interna_items, array(
			'name'       => __( 'link do item' ),
			'id'         => 'wsg_produto_interna_items_link',
			'type' => 'text',
		) );
		$produto_interna->add_group_field( $produto_interna_items, array(
			'name'       => __( 'titulo do item' ),
			'id'         => 'wsg_produto_interna_items_titulo',
			'type' => 'text',
		) );

		// Informações extra do produto
		$produto_info = new_cmb2_box( array(
			'id'            => 'produto_info',
			'title'         => __( 'Informações extra do produto' ),
			'object_types'  => array( 'produtos192', ),
			'context'       => 'side',
			'priority'      => 'high',
			'show_names'    => true,
			'closed'        => false,
		) );

		$produto_info->add_field( array(
			'name'       => __( 'Valor do produto' ),
			'id'         => 'wsg_produto_info_valor',
			'type'       => 'text',
		) );

		// Método de especificação de página
		$projetosPage = get_page_by_path( 'produtos', OBJECT, 'page' );

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

		// Metabox Listagem de produtos
		$produto_01 = new_cmb2_box( array(
			'id'            => 'produto_01',
			'title'         => __( 'Listagem de produtos' ),
			'object_types'  => array( 'page', ),
			'context'       => 'normal',
			'priority'      => 'high',
			'show_names'    => true,
			'closed'        => true,
		) );
		$produto_01->add_field( array(
			'name'       => __( 'Título da seção' ),
			'id'         => 'wsg_produtos_01_titulo',
			'type'       => 'text',
		) );

		// Metabox Formulário da interna
		$servicos_formulario = new_cmb2_box( array(
			'id'            => 'servicos_formulario',
			'title'         => __( 'Formulário da interna' ),
			'object_types'  => array( 'page', ),
			'context'       => 'normal',
			'priority'      => 'high',
			'show_names'    => true,
			'closed'        => true,
		) );

		$servicos_formulario->add_field( array(
			'name'       => __( 'Título da seção' ),
			'id'         => 'wsg_servicos_formulario_titulo',
			'type'       => 'text',
		) );
		$servicos_formulario->add_field( array(
			'name'       => __( 'Subtítulo da seção' ),
			'id'         => 'wsg_servicos_formulario_subtitulo',
			'type'       => 'text',
		) );

	}

?>