<?php

	// add_action( 'cmb2_admin_init', 'metaboxes_endereco' );

	function metaboxes_endereco() {

		// Página de configurações da logo
		$page_atual = get_page_by_path( 'endereco', OBJECT, 'contatos' );

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

		// Metabox Endereço
		$endereco = new_cmb2_box( array(
			'id'            => 'endereco',
			'title'         => __( 'Endereço' ),
			'object_types'  => array( 'contatos', ),
			'context'       => 'normal',
			'priority'      => 'high',
			'show_names'    => true,
		) );

		$endereco->add_field( array(
			'id'			=> 'wsg_endereco',
			'type'			=> 'textarea'
		) );



	}

?>