<?php
	add_action( 'cmb2_admin_init', 'cmb2_metaboxes_gerais_googleanalytics' );
	/**
	* Define the metabox and field configurations.
	*/
	function cmb2_metaboxes_gerais_googleanalytics() {
		$slugGeraisGoogle = get_page_by_path( 'configuracoes-do-google', OBJECT, 'gerais' );
		$post_id;
		if (isset($_GET['post'])) {
			$post_id = $_GET['post'];
		}else if(isset($_POST['post_ID'])) {
			$post_id = $_POST['post_ID'];
		}
		if( !isset( $post_id ) ) return;

		if($slugGeraisGoogle && $slugGeraisGoogle->ID != $post_id){
			return;
		}

		$cmbDataGoogleAnalyticsScript = new_cmb2_box( array(
			'id'            => 'cmbDataGoogleAnalyticsScript',
			'title'         => "Gerais",
			'object_types'  => array( 'gerais', ),
			'context'       => 'normal',
			'priority'      => 'high',
			'show_names'    => true,
			'closed'     => false,
		));

		$cmbDataGoogleAnalyticsScript->add_field( array(
			'name' => 'Script',
			'id' => 'script_analytics',
			'type' => 'textarea_code'
		));

		$cmbDataGoogleAnalyticsScript->add_field( array(
			'name'  => 'Pixel de conversão',
			'id'    => 'pixel_de_conversao_facebook',
			'type'  => 'textarea_code'
		));

		$cmbDataGoogleAnalyticsScript->add_field( array(
			'name'  => 'Código WebMasterTools',
			'id'    => 'code_webmaster_tools',
			'type'  => 'textarea_code'
		));
	}
?>