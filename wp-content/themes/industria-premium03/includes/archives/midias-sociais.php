<?php

	add_action( 'cmb2_admin_init', 'metaboxes_midias_sociais' );

	function metaboxes_midias_sociais() {

		// Metabox Servicos
		$redes_sociais = new_cmb2_box( array(
			'id'            => 'redes_sociais',
			'title'         => __( 'Opções da rede social' ),
			'object_types'  => array( 'redes_sociais', ),
			'context'       => 'normal',
			'priority'      => 'high',
			'show_names'    => true,
		) );

		$redes_sociais->add_field( array(
			'name'			=> __( 'Ícone da rede social' ),
			'desc'			=> __( 'Lista com ícones disponíveis abaixo' ),
			'id'			=> 'wsg_redes_sociais_titulo',
			'type'			=> 'text_small',
		) );
		$redes_sociais->add_field( array(
			'name'			=> __( 'Link da rede social' ),
			'id'			=> 'wsg_redes_sociais_link',
			'type'			=> 'text',
		) );

	}

?>