<?php

	add_action( 'cmb2_admin_init', 'metaboxes_unidades' );

	function metaboxes_unidades() {

		// Detalhes do serviço na home
		$unidade_item = new_cmb2_box( array(
			'id'            => 'unidade_item',
			'title'         => __( 'Endereço da Unidade' ),
			'object_types'  => array( 'unidades192', ),
			'context'       => 'normal',
			'priority'      => 'high',
			'show_names'    => true,
			'closed'        => false,
		) );

		$unidade_item->add_field( array(
			'name'       => __( 'Endereço' ),
			'id'         => 'wsg_unidade_endereco',
			'type' => 'textarea',
		) );

		$unidade_item->add_field( array(
			'name'       => __( 'Iframe do Endereço' ),
			'id'         => 'wsg_unidade_iframe',
			'type' => 'textarea_code',
		) );


		// $unidade_item->add_field( array(
		// 	'name'       => __( 'Contatos da Unidade' ),
		// 	'id'         => 'wsg_unidade_contatos',
		// 	'type'		 => 'text',
		// 	'repeatable' => true
		// ) );


		// Metabox Números
		$unidade_tel = new_cmb2_box( array(
			'id'            => 'unidade_tel',
			'title'         => __( 'Números' ),
			'object_types'  => array( 'unidades192', ),
			'context'       => 'normal',
			'priority'      => 'high',
			'show_names'    => true,
		) );

		$unidade_tel_items = $unidade_tel->add_field( array(
			'id'			=> 'wsg_unidade_tel_items',
			'type'			=> 'group',
			'options'       => array(
				'group_title'   => __( 'Número 0{#}' ),
				'add_button'    => __( 'Adicionar novo Número' ),
				'remove_button' => __( 'Remover Número' ),
			),
		) );

		$unidade_tel->add_group_field($unidade_tel_items, array(
			'name'			=> __( 'Número da unidade' ),
			'id'			=> 'wsg_unidade_tel_nmr',
			'type'			=> 'text',
		) );

		$unidade_tel->add_group_field($unidade_tel_items, array(
			'name'			=> __( 'Link do número' ),
			'desc'			=> __( 'Este campo é editável para que você possa colocar um link diferente, exemplo link para rastreamento de lead.' ),
			'id'			=> 'wsg_unidade_tel_link',
			'type'			=> 'textarea_small',
			'default'		=> 'https://wa.me/5562999999999'
		) );
		$unidade_tel->add_group_field($unidade_tel_items, array(
			'name'			=> __( 'Ícone do número' ),
			'id'			=> 'wsg_unidade_tel_icone',
			'type'			=> 'text',
			'type'             => 'radio',
			'show_option_none' => false,
			'options'          => array(
				'whatsapp-1'   => __( 'Whatsapp <span class="flaticon-whatsapp-1"></span>' ),
				'phone-1' => __( 'Telefone <span class="flaticon-phone-1"></span>' ),
			),
			'default' => 'whatsapp-1',
		) );



		// Metabox cores principais
		$unidade_email = new_cmb2_box( array(
			'id'            => 'unidade_email',
			'title'         => __( 'E-mail' ),
			'object_types'  => array( 'unidades192', ),
			'context'       => 'normal',
			'priority'      => 'high',
			'show_names'    => true,
		) );

		$unidade_email->add_field( array(
			'id'			=> 'wsg_unidade_emails',
			'type'			=> 'text',
			'repeatable'	=> true
		) );


	}

?>