<?php

	// Nomarlize Wordpress
	remove_action('wp_head', 'rsd_link');
	remove_action('wp_head', 'wlwmanifest_link');
	remove_action('wp_head', 'wp_generator');
	remove_action('wp_head', 'start_post_rel_link');
	remove_action('wp_head', 'index_rel_link');
	remove_action('wp_head', 'adjacent_posts_rel_link');

	remove_action('wp_head', 'wp_resource_hints', 2);
	remove_action('wp_head', 'print_emoji_detection_script', 7 );
	remove_action('admin_print_scripts', 'print_emoji_detection_script' );
	remove_action('wp_print_styles', 'print_emoji_styles' );
	remove_action('admin_print_styles', 'print_emoji_styles' );

	remove_action('wp_head', 'rest_output_link_wp_head');

	remove_action( 'wp_head', 'wp_oembed_add_discovery_links');
	remove_action( 'template_redirect', 'rest_output_link_header', 11, 0 );
	// Nomarlize Wordpress

	function remove_editor_page(){
		remove_post_type_support( 'page', 'editor' );
		remove_post_type_support( 'page', 'thumbnail' );
	}
	add_action( 'admin_init', 'remove_editor_page' );

	// adicionando svg
	function wp_check_filetype_and_ext_callback($filetype_ext_data, $file, $filename, $mimes) {
		if ( substr($filename, -4) === '.svg' ) {
			$filetype_ext_data['ext'] = 'svg';
			$filetype_ext_data['type'] = 'image/svg+xml';
		}
		return $filetype_ext_data;
	}
	add_filter('wp_check_filetype_and_ext', 'wp_check_filetype_and_ext_callback', 100, 4 );

	function add_svg_to_upload_mimes( $upload_mimes ) {
		$upload_mimes['svg'] = 'image/svg+xml';
		$upload_mimes['svgz'] = 'image/svg+xml';
		return $upload_mimes;
	}
	add_filter( 'upload_mimes', 'add_svg_to_upload_mimes', 10, 1 );

	function svg_size() {
		echo '
			<style>
				svg:not([class^="yoast"]), img[src*=".svg"]{
					width: 150px !important;
					height: 150px !important;
				}
				svg.yst-traffic-light {
					width: 19px !important;
					height: 30px !important;
					margin: 0 0 0 5px !important;
				}
				.yoast-alert .yoast-seo-icon {
					width: 60px !important;
					height: 60px !important;
				}
			</style>
		';
	}
	//add_action('admin_head', 'svg_size');

	// Disabilitar sistema de comentários default do wordpress
	function remove_comments_wordpress() {
		remove_menu_page('edit-comments.php');
	}
	add_action('admin_init', 'remove_comments_wordpress');

	// Está função registra os post types default do tema
	function posts_types_default(){

		// Gerais
		register_post_type('gerais',
			array(
				'labels' 			=> array(
					'name' 			=> __('Gerais'),
					'singular_name' => __('geral')
				),
				'public' 			=> true,
				'has_archive' 		=> true,
				'menu_icon' 		=> 'dashicons-admin-generic',
				'supports' 			=> array('title'),
			)
		);

		// Contatos
		register_post_type('contatos',
			array(
				'labels' 			=> array(
					'name' 			=> __('Contatos'),
					'singular_name' => __('contato')
				),
				'public' 			=> true,
				'has_archive' 		=> true,
				'menu_icon' 		=> 'dashicons-phone',
				'supports' 			=> array('title'),
			)
		);

		// Redes sociais
		register_post_type('redes_sociais',
			array(
				'labels' 			=> array(
					'name' 			=> __('Redes sociais'),
					'singular_name' => __('contato')
				),
				'public' 			=> true,
				'has_archive' 		=> true,
				'menu_icon' 		=> 'dashicons-share',
				'supports' 			=> array('title', 'page-attributes'),
			)
		);

	}
	add_action('init', 'posts_types_default');

	function meus_menus() {
		register_nav_menus(
			array(
				'header-menu' => __( 'Menu do cabeçalho' ),
				'footer-menu' => __( 'Menu do rodapé' ),
	    	)
		);
	}
	add_action( 'init', 'meus_menus' );

	function cmp_orde_menu_top($a, $b){
		// return strcmp($a->categoria_ordem_valor, $b->categoria_ordem_valor);
		$a = $a->categoria_ordem_valor;
		$b = $b->categoria_ordem_valor;

		if ($a == $b) {
			return 0;
		}
		return ($a < $b) ? -1 : 1;
	}

	function get_post_primary_category($post_id, $term='category', $return_all_categories=false){
		$return = array();

		if (class_exists('WPSEO_Primary_Term')){
			// Show Primary category by Yoast if it is enabled & set
			$wpseo_primary_term = new WPSEO_Primary_Term( $term, $post_id );
			$primary_term = get_term($wpseo_primary_term->get_primary_term());

			if (!is_wp_error($primary_term)){
				$return['primary_category'] = $primary_term;
			}
		}

		if (empty($return['primary_category']) || $return_all_categories){
			$categories_list = get_the_terms($post_id, $term);

			if (empty($return['primary_category']) && !empty($categories_list)){
				$return['primary_category'] = $categories_list[0];  //get the first category
			}
			if ($return_all_categories){
				$return['all_categories'] = array();

				if (!empty($categories_list)){
					foreach($categories_list as &$category){
						$return['all_categories'][] = $category->term_id;
					}
				}
			}
		}

		return $return;
	}

	// Função para colocar imagem no html com o recorte e o title
	function getImageThumb($attachID, $size = null) {
		$imageFull = wp_get_attachment_image_src($attachID, $size);
		if ($imageFull !== NULL && $imageFull !== FALSE) {
			$postItem = get_post($attachID);
			$imageFull = '<img src="'.$imageFull[0].'" class="attachment-full size-full" alt="'.$postItem->post_title.'" title="'.$postItem->post_title.'" />';
		}else{
			$imageFull = "";
		}
		echo $imageFull;
	}

	include 'includes/defaults/include.php';
	include 'includes/defaults/settings.php';
	include 'includes/functions.php';
	include 'includes/thumbs.php';
	include 'includes/icons.php';
	include 'includes/removed-itens.php';

	foreach (glob(get_template_directory().'/includes/pages/*.php') as $filename) {
		include $filename;
	} // Incluindo pasta com os arquivos da pasta pages
	foreach (glob(get_template_directory().'/includes/adminpanel/*.php') as $filename) {
		include $filename;
	} // Incluindo pasta com os arquivos da pasta adminpanel
	foreach (glob(get_template_directory().'/includes/archives/*.php') as $filename) {
		include $filename;
	} // Incluindo pasta com os arquivos da pasta archives
	foreach (glob(get_template_directory().'/includes/gerais/*.php') as $filename) {
		include $filename;
	} // Incluindo pasta com os arquivos da pasta gerais
	foreach (glob(get_template_directory().'/includes/blog/*.php') as $filename) {
		include $filename;
	} // Incluindo pasta com os arquivos da pasta blog
	foreach (glob(get_template_directory().'/includes/contatos/*.php') as $filename) {
		include $filename;
	} // Incluindo pasta com os arquivos da pasta contatos
	foreach (glob(get_template_directory().'/includes/taxonomies/*.php') as $filename) {
		include $filename;
	} // Incluindo pasta com os arquivos da pasta taxonomies
	foreach (glob(get_template_directory().'/includes/menu/*.php') as $filename) {
		include $filename;
	} // Incluindo pasta com os arquivos da pasta menu


	// $role = get_role( 'wsg_agency' );
	$role = get_role( 'wsg_super_admin' );
	$role->add_cap( 'edit_published_adminpanel_s' );
	$role->add_cap( 'publish_adminpanel' );
	$role->add_cap( 'delete_published_adminpanel_s' );
	$role->add_cap( 'edit_adminpanel' );
	$role->add_cap( 'delete_adminpanel_s' );
	$role->add_cap( 'edit_others_adminpanel' );
	$role->add_cap( 'delete_others_adminpanel_s' );
	$role->add_cap( 'delete_private_adminpanel_s' );
	$role->add_cap( 'edit_private_adminpanel_s' );
	$role->add_cap( 'read_private_adminpanel' );


?>