<?php

	add_action( 'cmb2_admin_init', 'metaboxes_telefones' );

	function metaboxes_telefones() {

		// Página de configurações da logo
		$page_atual = get_page_by_path( 'telefones', OBJECT, 'contatos' );

		$post_id;

		if (isset($_GET['post'])) {
			$post_id = $_GET['post'];
		}else if(isset($_POST['post_ID'])) {
			$post_id = $_POST['post_ID'];
		}
		if( !isset( $post_id ) ) return;

		if($page_atual && $page_atual->ID != $post_id){
			return;
		}

		// Metabox Números
		$telefone = new_cmb2_box( array(
			'id'            => 'telefone',
			'title'         => __( 'Números' ),
			'object_types'  => array( 'contatos', ),
			'context'       => 'normal',
			'priority'      => 'high',
			'show_names'    => true,
		) );

		$telefone_items = $telefone->add_field( array(
			'id'			=> 'wsg_telefone_items',
			'desc'			=> '<h1>Esses telefones aparecerão no cabeçalho</h1>',
			'type'			=> 'group',
			'options'       => array(
				'group_title'   => __( 'Telefone 0{#}' ),
				'add_button'    => __( 'Adicionar novo telefone' ),
				'remove_button' => __( 'Remover telefone' ),
			),
		) );

		$telefone->add_group_field($telefone_items, array(
			'name'			=> __( 'Número do telefone' ),
			'id'			=> 'wsg_telefone_nmr',
			'type'			=> 'text',
		) );

		$telefone->add_group_field($telefone_items, array(
			'name'			=> __( 'Link do telefone' ),
			'desc'			=> __( 'Este campo é editável para que você possa colocar um link diferente, exemplo link para rastreamento de lead.' ),
			'id'			=> 'wsg_telefone_link',
			'type'			=> 'textarea_small',
			'default'		=> 'https://wa.me/5562999999999'
		) );
		$telefone->add_group_field($telefone_items, array(
			'name'			=> __( 'Ícone do telefone' ),
			'id'			=> 'wsg_telefone_icone',
			'type'			=> 'text',
			'type'             => 'radio',
			'show_option_none' => false,
			'options'          => array(
				'whatsapp-1'   => __( 'Whatsapp <span class="flaticon-whatsapp-1"></span>' ),
				'phone-1' => __( 'Telefone <span class="flaticon-phone-1"></span>' ),
			),
			'default' => 'whatsapp-1',
		) );

		// Metabox Whatsapp popup
		$whatsapp_popup = new_cmb2_box( array(
			'id'            => 'whatsapp_popup',
			'title'         => __( 'Whatsapp popup' ),
			'object_types'  => array( 'contatos', ),
			'context'       => 'normal',
			'priority'      => 'high',
			'show_names'    => true,
		) );

		$whatsapp_popup->add_field( array(
			'name'			=> __( 'Link do número' ),
			'id'			=> 'wsg_whatsapp_popup_link',
			'type'			=> 'text',
		) );

		// Metabox Botão dop whatsapp na sidebar
		$whatsapp_btn_sidebar = new_cmb2_box( array(
			'id'            => 'whatsapp_btn_sidebar',
			'title'         => __( 'Botão dop whatsapp na sidebar' ),
			'object_types'  => array( 'contatos', ),
			'context'       => 'normal',
			'priority'      => 'high',
			'show_names'    => true,
		) );

		$whatsapp_btn_sidebar->add_field( array(
			'name'			=> __( 'Link do número' ),
			'id'			=> 'wsg_whatsapp_btn_sidebar_link',
			'type'			=> 'text',
		) );

	}

?>