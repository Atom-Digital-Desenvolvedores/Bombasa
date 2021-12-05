<?php
	add_action( 'cmb2_admin_init', 'cmb2_metaboxes_gerais_settings' );

	function cmb2_metaboxes_gerais_settings() {
		$geraisInformacoesRecebimentoEnvioEmail = get_page_by_path( 'configuracoes-de-e-mail', OBJECT, 'gerais' );
		$post_id;
		if (isset($_GET['post'])) {
			$post_id = $_GET['post'];
		}else if(isset($_POST['post_ID'])) {
			$post_id = $_POST['post_ID'];
		}
		if( !isset( $post_id ) ) return;

		if($geraisInformacoesRecebimentoEnvioEmail && $geraisInformacoesRecebimentoEnvioEmail->ID != $post_id){
			return;
		}

		$cmbDestinatarios = new_cmb2_box( array(
			'id'            => 'cmbDestinatarios',
			'title'         => "Destinatários",
			'object_types'  => array( 'gerais', ), 
			'context'       => 'normal',
			'priority'      => 'high',
			'show_names'    => true, 
			'closed'     => false, 
		));

		$cmbDestinatarios->add_field( array(
			'name'        => 'Email de recebimento',
			'desc'        => 'Email que receberá as mensagens de formulários como os de Contato.',
			'id'          => 'addaddress_smtprecipients_send_mail',
			'type'        => 'text',
			'repeatable'  => true,
		));

		$cmbDestinatarios->add_field( array(
			'name'    => 'Email de recebimento de copia',
			'desc'    => 'Email que receberá copias das mensagens de formulários como os de Contato.',
			'default' => '',
			'id'      => 'addcc_smtprecipients_send_mail',
			'type'    => 'text',
			'repeatable'  => true,
		));

		$cmbDestinatarios->add_field( array(
			'name'    => 'Email de recebimento de copia oculta',
			'desc'    => 'Email que receberá copias ocultas das mensagens de formulários como os de Contato.',
			'default' => '',
			'id'      => 'addbcc_smtprecipients_send_mail',
			'type'    => 'text',
			'repeatable'  => true,
		));

	}
?>