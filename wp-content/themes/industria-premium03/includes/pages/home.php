<?php

	add_action( 'cmb2_admin_init', 'metaboxes_home' );

	function metaboxes_home() {

		// Método de especificação de página
		$homePage = get_page_by_path( 'home', OBJECT, 'page' );

		$post_id;

		if (isset($_GET['post'])) {
			$post_id = $_GET['post'];
		}else if(isset($_POST['post_ID'])) {
			$post_id = $_POST['post_ID'];
		}
		if( !isset( $post_id ) ) return;

		if($homePage && $homePage->ID != $post_id){
			return;
		}

		// Metabox Banner
		$banner = new_cmb2_box( array(
			'id'            => 'banners',
			'title'         => __( 'Banners' ),
			'object_types'  => array( 'page', ),
			'context'       => 'normal',
			'priority'      => 'high',
			'show_names'    => true,
			'closed'        => true,
		) );

		$banner_items = $banner->add_field( array(
			'id'            => 'banner_items',
			'type'          => 'group',
			'options'       => array(
				'group_title'   => __( 'Item {#}' ),
				'add_button'    => __( 'Adicionar Outro Item' ),
				'remove_button' => __( 'Remover Item' ),
				'sortable'      => true,
				'closed'        => true,
			),
		) );
		$banner->add_group_field( $banner_items, array(
			'name'       => __( 'Imagem do banner' ),
			'desc'       => __( 'Tamanho recomendado <strong>1920x600</strong>' ),
			'id'         => 'wsg_banner_items_img',
			'type' => 'file',
			'preview_size' => array( 1920/5, 600/5 ),
			'query_args' => array( 'type' => 'image' ),
		) );
		$banner->add_group_field( $banner_items, array(
			'name'       => __( 'Imagem do banner' ),
			'desc'       => __( 'Tamanho recomendado <strong>1000x820</strong>' ),
			'id'         => 'wsg_banner_items_mobile_img',
			'type' => 'file',
			'preview_size' => array( 1000/2, 820/2 ),
			'query_args' => array( 'type' => 'image' ),
		) );
		$banner->add_group_field( $banner_items, array(
			'name'       => __( 'Subtitulo do banner' ),
			'id'         => 'wsg_banner_items_subtitulo',
			'type'       => 'text',
		) );
		$banner->add_group_field( $banner_items, array(
			'name'       => __( 'Titulo do banner' ),
			'id'         => 'wsg_banner_items_titulo',
			'type'       => 'text',
		) );
		$banner->add_group_field( $banner_items, array(
			'name'       => __( 'Link do botão do banner' ),
			'id'         => 'wsg_banner_items_btn_link',
			'type'       => 'text',
		) );
		$banner->add_group_field( $banner_items, array(
			'name'       => __( 'Texto do botão do banner' ),
			'id'         => 'wsg_banner_items_btn_texto',
			'type'       => 'text',
		) );

		// Metabox Sobre
		$sobre = new_cmb2_box( array(
			'id'            => 'sobre',
			'title'         => __( 'Sobre' ),
			'object_types'  => array( 'page', ),
			'context'       => 'normal',
			'priority'      => 'high',
			'show_names'    => true,
			'closed'        => true,
		) );
		$sobre->add_field( array(
			'name'       => __( 'Imagem da seção' ),
			'desc'       => __( 'Tamanho recomendado <strong>550x392</strong>' ),
			'id'         => 'wsg_sobre_img',
			'type' => 'file',
			'preview_size' => array( 550/1, 392/1 ),
			'query_args' => array( 'type' => 'image' ),
			'options' => array(
				'url' => false, // Hide the text input for the url
			),
		) );
		$sobre->add_field( array(
			'name'       => __( 'link do vídeo da seção' ),
			'id'         => 'wsg_sobre_link',
			'type'       => 'text',
		) );
		$sobre->add_field( array(
			'name'       => __( 'Título da seção' ),
			'id'         => 'wsg_sobre_titulo',
			'type'       => 'text',
		) );
		$sobre->add_field( array(
			'name'       => __( 'Texto da seção' ),
			'id'         => 'wsg_sobre_texto',
			'type'       => 'wysiwyg',
		) );

		// Metabox Fornecedores
		$fornecedores = new_cmb2_box( array(
			'id'            => 'fornecedores',
			'title'         => __( 'Fornecedores' ),
			'object_types'  => array( 'page', ),
			'context'       => 'normal',
			'priority'      => 'high',
			'show_names'    => true,
			'closed'        => true,
		) );
		$fornecedores->add_field( array(
			'name'       => __( 'Título da seção' ),
			'id'         => 'wsg_fornecedores_titulo',
			'type'       => 'text',
		) );
		$fornecedores_items = $fornecedores->add_field( array(
			'id'            => 'fornecedores_items',
			'type'          => 'group',
			'options'       => array(
				'group_title'   => __( 'Item {#}' ),
				'add_button'    => __( 'Adicionar Outro Item' ),
				'remove_button' => __( 'Remover Item' ),
				'sortable'      => true,
				'closed'        => true,
			),
		) );
		$fornecedores->add_group_field( $fornecedores_items, array(
			'name'       => __( 'Imagem do item' ),
			'desc'       => __( 'Tamanho recomendado <strong>230x90</strong>' ),
			'id'         => 'wsg_fornecedores_items_img',
			'type' => 'file',
			'preview_size' => array( 230/1, 90/1 ),
			'query_args' => array( 'type' => 'image' ),
		) );

		// Metabox Produtos
		$produtos = new_cmb2_box( array(
			'id'            => 'produtos',
			'title'         => __( 'Produtos' ),
			'object_types'  => array( 'page', ),
			'context'       => 'normal',
			'priority'      => 'high',
			'show_names'    => true,
			'closed'        => true,
		) );
		$produtos->add_field( array(
			'name'       => __( 'Título da seção' ),
			'id'         => 'wsg_produtos_titulo',
			'type'       => 'text',
		) );

		// Metabox Estatísticas
		$estatisticas = new_cmb2_box( array(
			'id'            => 'estatisticas',
			'title'         => __( 'Estatísticas' ),
			'object_types'  => array( 'page', ),
			'context'       => 'normal',
			'priority'      => 'high',
			'show_names'    => true,
			'closed'        => true,
		) );
		$estatisticas->add_field( array(
			'name'       => __( 'Título da seção' ),
			'id'         => 'wsg_estatisticas_titulo',
			'type'       => 'text',
		) );
		$estatisticas->add_field( array(
			'name'       => __( 'Imagem de fundo da seção' ),
			'desc'       => __( 'Tamanho recomendado <strong>1920x480</strong>' ),
			'id'         => 'wsg_estatisticas_img',
			'type' => 'file',
			'preview_size' => array( 1920/1, 480/1 ),
			'query_args' => array( 'type' => 'image' ),
		) );
		$estatisticas_items = $estatisticas->add_field( array(
			'id'            => 'estatisticas_items',
			'type'          => 'group',
			'options'       => array(
				'group_title'   => __( 'Item {#}' ),
				'add_button'    => __( 'Adicionar Outro Item' ),
				'remove_button' => __( 'Remover Item' ),
				'sortable'      => true,
				'closed'        => true,
			),
		) );
		$estatisticas->add_group_field( $estatisticas_items, array(
			'name'       => __( 'Valor do item' ),
			'id'         => 'wsg_estatisticas_items_valor',
			'type'       => 'text',
		) );
		$estatisticas->add_group_field( $estatisticas_items, array(
			'name'       => __( 'legenda do item' ),
			'id'         => 'wsg_estatisticas_items_legenda',
			'type'       => 'text',
		) );

		// Metabox Serviços
		$servicos = new_cmb2_box( array(
			'id'            => 'servicos',
			'title'         => __( 'Serviços' ),
			'object_types'  => array( 'page', ),
			'context'       => 'normal',
			'priority'      => 'high',
			'show_names'    => true,
			'closed'        => true,
		) );
		$servicos->add_field( array(
			'name'       => __( 'Título da seção' ),
			'id'         => 'wsg_servicos_titulo',
			'type'       => 'text',
		) );
		$servicos->add_field( array(
			'name'    => __( 'Listagem de serviços' ),
			'desc'    => __( 'Arraste as serviços da coluna da esquerda para a da direita para anexá-lo. <br/>Você pode reorganizar a ordem das serviços na coluna da direita arrastando e soltando.'),
			'id'      => 'wsg_servicos_na_home',
			'type'    => 'custom_attached_posts',
			'options' => array(
				'show_thumbnails' => true,
				'filter_boxes'    => true,
				'query_args'      => array(
					'posts_per_page' => -1,
					'post_type'      => 'servicos192',
				),
			),
		) );

		// Metabox Marcas
		$marcas = new_cmb2_box( array(
			'id'            => 'marcas',
			'title'         => __( 'Marcas' ),
			'object_types'  => array( 'page', ),
			'context'       => 'normal',
			'priority'      => 'high',
			'show_names'    => true,
			'closed'        => true,
		) );
		$marcas->add_field( array(
			'name'       => __( 'Título da seção' ),
			'id'         => 'wsg_marcas_titulo',
			'type'       => 'text',
		) );
		$marcas_items = $marcas->add_field( array(
			'id'            => 'marcas_items',
			'type'          => 'group',
			'options'       => array(
				'group_title'   => __( 'Item {#}' ),
				'add_button'    => __( 'Adicionar Outro Item' ),
				'remove_button' => __( 'Remover Item' ),
				'sortable'      => true,
				'closed'        => true,
			),
		) );
		$marcas->add_group_field( $marcas_items, array(
			'name'       => __( 'Imagem do item' ),
			'desc'       => __( 'Tamanho recomendado <strong>230x90</strong>' ),
			'id'         => 'wsg_marcas_items_img',
			'type' => 'file',
			'preview_size' => array( 230/1, 90/1 ),
			'query_args' => array( 'type' => 'image' ),
		) );

		// Metabox Depoimentos
		$depoimentos = new_cmb2_box( array(
			'id'            => 'depoimentos',
			'title'         => __( 'Depoimentos' ),
			'object_types'  => array( 'page', ),
			'context'       => 'normal',
			'priority'      => 'high',
			'show_names'    => true,
			'closed'        => true,
		) );
		$depoimentos->add_field( array(
			'name'       => __( 'Título da seção' ),
			'id'         => 'wsg_depoimentos_titulo',
			'type'       => 'text',
		) );

		// Metabox Blog
		$blog = new_cmb2_box( array(
			'id'            => 'blog',
			'title'         => __( 'Blog' ),
			'object_types'  => array( 'page', ),
			'context'       => 'normal',
			'priority'      => 'high',
			'show_names'    => true,
			'closed'        => true,
		) );

		$blog->add_field( array(
			'name'       => __( 'Título da seção' ),
			'id'         => 'wsg_blog_titulo',
			'type'       => 'text',
		) );

		// Metabox Newsletter
		$newsletter = new_cmb2_box( array(
			'id'            => 'newsletter',
			'title'         => __( 'Newsletter' ),
			'object_types'  => array( 'page', ),
			'context'       => 'normal',
			'priority'      => 'high',
			'show_names'    => true,
			'closed'        => true,
		) );
		$newsletter->add_field( array(
			'name'       => __( 'Título da seção' ),
			'id'         => 'wsg_newsletter_titulo',
			'type'       => 'text',
		) );
		$newsletter->add_field( array(
			'name'       => __( 'Subtítulo da seção' ),
			'id'         => 'wsg_newsletter_subtitulo',
			'type'       => 'text',
		) );


	}

?>