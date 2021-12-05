<?php
	add_action( 'cmb2_admin_init', 'cmb2_metaboxes_adminpanel_settings_outrasinfo' );
	/**
	* Define the metabox and field configurations.
	*/
	function cmb2_metaboxes_adminpanel_settings_outrasinfo() {

		$slugTelaDeLogin = get_page_by_path( 'slug-outras-info', OBJECT, 'adminpanel' );
		$post_id;
		if (isset($_GET['post'])) {
			$post_id = $_GET['post'];
		}else if(isset($_POST['post_ID'])) {
			$post_id = $_POST['post_ID'];
		}
		if( !isset( $post_id ) ) return;

		if($slugTelaDeLogin && $slugTelaDeLogin->ID != $post_id){
			return;
		}

		/**
		* Initiate the metabox
		*/
		$cmbFooterWebSite = new_cmb2_box( array(
			'id'            => 'cmbFooterWebSite',
			'title'         => "Rodapé do site",
			'object_types'  => array( 'adminpanel', ),
			'context'       => 'normal',
			'priority'      => 'high',
			'show_names'    => true,
			'closed'        => false,
		));
		$cmbFooterWebSite->add_field( array(
			'id'      => 'agency_setting_footer_site_content',
			'type'    => 'wysiwyg',
			'default' => '<a href="http://www.websitesgoias.com.br/">WebSiteGoiás</a>',
		));

		$cmbFooterAdmPanel = new_cmb2_box( array(
			'id'            => 'cmbFooterAdmPanel',
			'title'         => "Rodapé do painel administrativo",
			'object_types'  => array( 'adminpanel', ),
			'context'       => 'normal',
			'priority'      => 'high',
			'show_names'    => true,
			'closed'        => false,
		));
		$cmbFooterAdmPanel->add_field( array(
			'id'      => 'agency_setting_footer_admpanel_content',
			'type'    => 'wysiwyg',
			'default' => '<a href="http://www.websitesgoias.com.br/">WebSiteGoiás</a>',
		));
	}

?>