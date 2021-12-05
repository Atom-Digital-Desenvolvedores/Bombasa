<?php
	add_filter( 'contextual_help', 'harpia_remove_help_tabs', 999, 3 );
	function harpia_remove_help_tabs($old_help, $screen_id, $screen){
		if (stringEndsWith($_SERVER['SCRIPT_FILENAME'], "admin/index.php")) {
			$screen->remove_help_tabs();
			$screen->remove_help_tabs();
		}
		return $old_help;
	}

	function harpia_remove_core_updates(){
		global $wp_version;
		return(object) array('last_checked'=> time(),'version_checked'=> $wp_version,);
	}
	add_filter('pre_site_transient_update_core','harpia_remove_core_updates');
	add_filter('pre_site_transient_update_plugins','harpia_remove_core_updates');
	add_filter('pre_site_transient_update_themes','harpia_remove_core_updates');

	add_action( 'admin_init', 'harpia_wpse_38111' );
	function harpia_wpse_38111() {
		remove_submenu_page( 'index.php', 'update-core.php' );
	}

	function stringEndsWith($haystack, $needle){
		return $needle === "" || substr($haystack, -strlen($needle)) === $needle;
	}

	function hide_itens_wp_head(){
		$user = wp_get_current_user();
		if($user->roles[0] === 'wsg_super_admin'){
			return;
		}
		echo '	
				<style type="text/css">
					ul#wp-admin-bar-root-default li#wp-admin-bar-wp-logo {
						display: none;
					}
					tr[data-slug="cmb2"],
					.theme-actions {
						display: none;
					}
				</style>
				';
	}
	add_action('admin_head','hide_itens_wp_head');

	function hide_itens_wp_script(){
		$user = wp_get_current_user();
		if($user->roles[0] === 'wsg_super_admin'){
			return;
		}
		echo '	<script>
					jQuery(\'tr[data-slug="cmb2"] th.check-column\').remove();
				</script>
				';
	}
	add_action('admin_footer','hide_itens_wp_script');


	//COMO MODIFICAR O TEXTO DO FOOTER
	function harpia_remove_footer_admin () {
		$idTelaDeLogin = get_page_by_path('slug-outras-info', OBJECT, 'adminpanel')->ID;
		echo get_post_meta($idTelaDeLogin, 'agency_setting_footer_admpanel_content', true);
		// echo '<a href="http://www.harpiapropaganda.com.br/">Harpia Propaganda</a> - Agência digital.';
	}
	add_filter('admin_footer_text', 'harpia_remove_footer_admin');


	add_action( 'admin_menu', 'harpia_remove_menu_default' );
	function harpia_remove_menu_default() {
		remove_menu_page('edit-comments.php');
	}

	function isa_disable_dashboard_widgets() {
		remove_meta_box('dashboard_right_now', 'dashboard', 'normal');// Remove "At a Glance"
		remove_meta_box('dashboard_activity', 'dashboard', 'normal');// Remove "Activity" which includes "Recent Comments"
		remove_meta_box('dashboard_quick_press', 'dashboard', 'side');// Remove Quick Draft
		remove_meta_box('dashboard_primary', 'dashboard', 'core');
		
		$post_types = get_post_types();
		foreach ($post_types as $post_type) {
			remove_meta_box('postcustom', $post_type, 'core');
			remove_meta_box('slugdiv', $post_type, 'core');
			remove_meta_box('commentstatusdiv', $post_type, 'core');
			remove_meta_box('commentsdiv', $post_type, 'core');
			// remove_meta_box('pageparentdiv', $post_type, 'core');
			remove_meta_box('vsw_post_meta_video_widget_setting', $post_type, 'core');
			if ($post_type !== 'post') {
				remove_meta_box('authordiv', $post_type, 'core');
			}
		}

		remove_action('welcome_panel', 'wp_welcome_panel');
	}
	add_action('admin_menu', 'isa_disable_dashboard_widgets');

	function my_disable_post_revisions() {
		foreach ( get_post_types() as $post_type ) {
			if ($post_type !== 'post') {
				remove_post_type_support( $post_type, 'revisions' );
			}
		}
	}
	add_action( 'init', 'my_disable_post_revisions', 999 );

	add_action('admin_print_scripts', 'disable_autosave');
	function disable_autosave(){
		global $post;
		if($post !== NULL && get_post_type($post->ID) === 'post'){
			wp_deregister_script('autosave');
		}
	}

	function run_activate_plugin( $plugin ) {
		$current = get_option( 'active_plugins' );
		$plugin = plugin_basename( trim( $plugin ) );

		if ( !in_array( $plugin, $current ) ) {
			$current[] = $plugin;
			sort( $current );
			do_action( 'activate_plugin', trim( $plugin ) );
			update_option( 'active_plugins', $current );
			do_action( 'activate_' . trim( $plugin ) );
			do_action( 'activated_plugin', trim( $plugin) );
		}

		return null;
	}
	run_activate_plugin( 'cmb2/init.php' );

	function wq_stop_edit_theme() {
		global $pagenow;
		if ($pagenow == 'theme-editor.php') {
			wp_die('Acesso negado');
		}
	}
	add_action( 'admin_init', 'wq_stop_edit_theme' );
?>