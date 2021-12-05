<?php

	add_action( 'cmb2_admin_init', 'metaboxes_logo' );

	function metaboxes_logo() {

		// Página de configurações da logo
		$logo_Conf = get_page_by_path( 'configuracoes-da-logo', OBJECT, 'gerais' );

		$post_id;

		if (isset($_GET['post'])) {
			$post_id = $_GET['post'];
		}else if(isset($_POST['post_ID'])) {
			$post_id = $_POST['post_ID'];
		}
		if( !isset( $post_id ) ) return;

		if($logo_Conf && $logo_Conf->ID != $post_id){
			return;
		}

		// Metabox logo header
		$logo_header = new_cmb2_box( array(
			'id'            => 'logo_header',
			'title'         => __( 'Logo do Cabeçalho' ),
			'object_types'  => array( 'gerais', ),
			'context'       => 'normal',
			'priority'      => 'high',
			'show_names'    => true,
		) );

		$logo_header->add_field( array(
			'name'       => __( 'Insira a imagem aqui' ),
			'id'         => 'wsg_logo_header_img',
			'type'       => 'file',
			'query_args' => array(
				'type' => array(
					'image',
				),
			),
			'preview_size' => 'medium',
		) );

		// Metabox logo footer
		$logo_footer = new_cmb2_box( array(
			'id'            => 'logo_footer',
			'title'         => __( 'Logo do Rodapé' ),
			'object_types'  => array( 'gerais', ),
			'context'       => 'normal',
			'priority'      => 'high',
			'show_names'    => true,
		) );

		$logo_footer->add_field( array(
			'name'       => __( 'Insira a imagem aqui' ),
			'id'         => 'wsg_logo_footer_img',
			'type'       => 'file',
			'query_args' => array(
				'type' => array(
					'image',
				),
			),
			'preview_size' => 'medium',
		) );

		// Metabox favicon
		$favicon = new_cmb2_box( array(
			'id'            => 'favicon',
			'title'         => __( 'Favicon do site' ),
			'object_types'  => array( 'gerais', ),
			'context'       => 'normal',
			'priority'      => 'high',
			'show_names'    => true,
		) );

		$favicon->add_field( array(
			'name'       => __( 'Insira a imagem aqui' ),
			'id'         => 'wsg_favicon_img',
			'type'       => 'file',
			'query_args' => array(
				'type' => array(
					'image',
				),
			),
			'preview_size' => 'medium',
		) );

	}

?>