<?php

	add_action( 'cmb2_admin_init', 'metaboxes_email' );

	function metaboxes_email() {

		// Página de configurações da logo
		$page_atual = get_page_by_path( 'email', OBJECT, 'contatos' );

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

		// Metabox cores principais
		$email = new_cmb2_box( array(
			'id'            => 'email',
			'title'         => __( 'E-mail' ),
			'object_types'  => array( 'contatos', ),
			'context'       => 'normal',
			'priority'      => 'high',
			'show_names'    => true,
		) );

		$email->add_field( array(
			'id'			=> 'wsg_emails',
			'desc'			=> '<h1>Esses emails aparecerão no cabeçalho</h1>',
			'type'			=> 'text',
			'repeatable'	=> true
		) );



	}

?>