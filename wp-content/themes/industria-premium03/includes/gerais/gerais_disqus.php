<?php

	add_action( 'cmb2_admin_init', 'metaboxes_disqus' );

	function metaboxes_disqus() {

		// Página de configurações da logo
		$logo_Conf = get_page_by_path( 'configuracoes-do-disqus', OBJECT, 'gerais' );

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

		// Metabox logo footer
		$disqus = new_cmb2_box( array(
			'id'            => 'disqus',
			'title'         => __( 'Disqus' ),
			'object_types'  => array( 'gerais', ),
			'context'       => 'normal',
			'priority'      => 'high',
			'show_names'    => true,
		) );

		$disqus->add_field( array(
			'name'       => __( 'Insira o código do disqus para habilitar os comentários nos seus posts de blog' ),
			'id'         => 'wsg_disqus_title',
			'type'       => 'title',
		) );

		$disqus->add_field( array(
			'name'       => __( 'Insira o código aqui' ),
			'id'         => 'wsg_disqus_code',
			'type'       => 'text',
		) );

	}

?>