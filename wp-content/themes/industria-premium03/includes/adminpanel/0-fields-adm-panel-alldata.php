<?php
  add_action( 'cmb2_admin_init', 'cmb2_metaboxes_adminpanel_settings' );
  /**
  * Define the metabox and field configurations.
  */
  function cmb2_metaboxes_adminpanel_settings() {
    $slugTelaDeLogin = get_page_by_path( 'slug-tela-de-login', OBJECT, 'adminpanel' );
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
    $cmbTelaDeLogin = new_cmb2_box( array(
      'id'            => 'cmbTelaDeLogin',
      'title'         => "Tela de login",
      'object_types'  => array( 'adminpanel', ), // Post type
      'context'       => 'normal',
      'priority'      => 'high',
      'show_names'    => true, // Show field names on the left
      // 'cmb_styles' => false, // false to disable the CMB stylesheet
      'closed'     => false, // Keep the metabox closed by default
    ));
    $cmbTelaDeLogin->add_field( array(
      'name' => 'Configuração de fundo da página',
      'type' => 'title',
      'id'   => 'setting_general_page'
    ));
    $cmbTelaDeLogin->add_field( array(
      'name'    => 'Cor de fundo',
      'id'      => 'color_background_colorpicker',
      'type'    => 'colorpicker',
      'default' => '#000000',
      'options' => array(
       'alpha' => true, // Make this a rgba color picker.
      ),
    ));
    $cmbTelaDeLogin->add_field( array(
      'name'    => 'Cor da fonte',
      'id'      => 'color_font_background_colorpicker',
      'type'    => 'colorpicker',
      'default' => '#FFFFFF',
      'options' => array(
       'alpha' => true, // Make this a rgba color picker.
      ),
    ));
    $cmbTelaDeLogin->add_field( array(
      'name' => 'Configuração do box de login',
      'type' => 'title',
      'id'   => 'setting_box_login'
    ));
    $cmbTelaDeLogin->add_field( array(
      'name'    => 'Background do box de login',
      'id'      => 'color_background_box_colorpicker',
      'type'    => 'colorpicker',
      'default' => '#FFFFFF',
      'options' => array(
       'alpha' => true, // Make this a rgba color picker.
      ),
    ));
    $cmbTelaDeLogin->add_field( array(
      'name'    => 'Cor da fonte do box de login',
      'id'      => 'color_font_box_colorpicker',
      'type'    => 'colorpicker',
      'default' => '#000000',
      'options' => array(
       'alpha' => true, // Make this a rgba color picker.
      ),
    ));
    $cmbTelaDeLogin->add_field( array(
      'name'    => 'Cor do botão de login',
      'id'      => 'color_background_btn_box_colorpicker',
      'type'    => 'colorpicker',
      'default' => '#FFFFFF',
      'options' => array(
       'alpha' => true, // Make this a rgba color picker.
      ),
    ));
    $cmbTelaDeLogin->add_field( array(
      'name'    => 'Cor da fonte do botão de login',
      'id'      => 'color_font_btn_box_colorpicker',
      'type'    => 'colorpicker',
      'default' => '#000000',
      'options' => array(
       'alpha' => true, // Make this a rgba color picker.
      ),
    ));
    $cmbNetWorkTelaDeLogin = new_cmb2_box( array(
      'id'            => 'cmbNetWorkTelaDeLogin',
      'title'         => "Configuração das informações da agência",
      'object_types'  => array( 'adminpanel', ), // Post type
      'context'       => 'normal',
      'priority'      => 'high',
      'show_names'    => true, // Show field names on the left
      // 'cmb_styles' => false, // false to disable the CMB stylesheet
      'closed'     => false, // Keep the metabox closed by default
    ));

    $cmbNetWorkTelaDeLogin->add_field( array(
      'name'    => 'Imagem principal',
      'desc'    => 'Tamanho recomendado <strong>182x200</strong>.',
      'id'      => 'image_dataagency_background_colorpicker',
      'type'    => 'file',
      'options' => array(
        'url' => false, // Hide the text input for the url
      ),
      'text'    => array(
        'add_upload_file_text' => 'Add File'
      ),
      'query_args' => array(
        'type' => 'image',
      ),
      // 'default' => 'func_setting_default_logo_agency_login'
    ));
    $cmbNetWorkTelaDeLogin->add_field( array(
      'name'    => 'Cor da fonte',
      'id'      => 'color_font_dataagency_background_colorpicker',
      'type'    => 'colorpicker',
      'default' => '#FFFFFF',
      'options' => array(
       'alpha' => true, // Make this a rgba color picker.
      ),
    ));
    $cmbNetWorkTelaDeLogin->add_field( array(
      'name'    => 'Linha 1',
      'id'      => 'line1_info_dataagency',
      'type'    => 'text',
    ));
    $cmbNetWorkTelaDeLogin->add_field( array(
      'name'    => 'Linha 2',
      'id'      => 'line2_info_dataagency',
      'type'    => 'text',
    ));
    $cmbNetWorkTelaDeLoginFieldId = $cmbNetWorkTelaDeLogin->add_field( array(
      'id'          => 'cmbNetWorkTelaDeLoginItens',
      'type'        => 'group',
      // 'repeatable'  => false, // use false if you want non-repeatable group
      'options'     => array(
        'group_title'   => "{#} - Rede social", // since version 1.1.4, {#} gets replaced by row number
        'add_button'    => "Add",
        'remove_button' => "Remover",
        'sortable'      => true, // beta
        // 'closed'     => true, // true to have the groups closed by default
      ),
    ));
    $cmbNetWorkTelaDeLogin->add_group_field( $cmbNetWorkTelaDeLoginFieldId, array(
      'name'    => 'Imagem',
      'desc'    => 'Tamanho recomendado <strong>29x29</strong>.',
      'id'      => 'image_socialnetwork',
      'type'    => 'file',
      'options' => array(
        'url' => false, // Hide the text input for the url
      ),
      'text'    => array(
        'add_upload_file_text' => 'Add File'
      ),
      'query_args' => array(
        'type' => 'image',
      )
    ));
    $cmbNetWorkTelaDeLogin->add_group_field( $cmbNetWorkTelaDeLoginFieldId, array(
      'name' => 'Titulo do link',
      'id'   => 'title_socialnetwork',
      'type' => 'text',
      // 'repeatable' => true, // Repeatable fields are supported w/in repeatable groups (for most types)
    ));
    $cmbNetWorkTelaDeLogin->add_group_field( $cmbNetWorkTelaDeLoginFieldId, array(
      'name' => 'URL',
      'id'   => 'url_socialnetwork',
      'type' => 'text',
      // 'repeatable' => true, // Repeatable fields are supported w/in repeatable groups (for most types)
    ));




  }

/*
  http://www.harpiapropaganda.com.br/harpia/themes/harpia/img/logo.png

  media_sideload_image( $url, $post_id, $description );

* /
  function func_setting_default_logo_agency_login() {
    $idAttachment = get_thumb_id_with_ends_word("wsg_logo_login.png");
    if (!$idAttachment) {
      $idAttachment = wsg_insert_attachment_from_url("http://www.harpiapropaganda.com.br/harpia/themes/harpia/img/logo.png", "wsg_logo_login.png");
    }
    // $default = array('id' => $idAttachment, 'url' => 'wsg_logo_login.png');
    // return $default;
    // $default = array('id' => $idAttachment, 'url' => 'wsg_logo_login.png');

    return get_post($idAttachment)->guid;
  }
*/
?>