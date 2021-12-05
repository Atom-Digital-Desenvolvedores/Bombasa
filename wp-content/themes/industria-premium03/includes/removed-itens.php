<?php

	// remover botoes dos posttypes
	function hide_buttons_page_custom(){
		echo '
		<style type="text/css">
			body.post-type-page .wrap .wp-heading-inline+.page-title-action,
			body.post-type-gerais .wrap .wp-heading-inline+.page-title-action,
			body.post-type-contatos .wrap .wp-heading-inline+.page-title-action,

			body.post-type-page #posts-filter select option[value=trash],
			body.post-type-gerais #posts-filter select option[value=trash],
			body.post-type-contatos #posts-filter select option[value=trash],
			body.post-type-page #posts-filter table tr td:first-child,
			body.post-type-page #posts-filter table tr th:first-child,

			body.post-type-page .page-title-action,
			body.post-type-gerais .page-title-action,
			body.post-type-contatos .page-title-action,

			body.post-type-page tr span.trash,
			body.post-type-gerais tr span.trash,
			body.post-type-contatos tr span.trash,

			body.post-type-page a.page-title-action,
			body.post-type-gerais a.page-title-action,
			body.post-type-contatos a.page-title-action,

			body.post-type-page #delete-action,
			body.post-type-gerais #delete-action,
			body.post-type-contatos #delete-action,

			body.post-type-page tr span.inline.hide-if-no-js,
			body.post-type-gerais tr span.inline.hide-if-no-js,
			body.post-type-contatos tr span.inline.hide-if-no-js,

			body.post-type-page div#wpbody-content div.wrap ul.subsubsub,
			body.post-type-gerais div#wpbody-content div.wrap ul.subsubsub,
			body.post-type-contatos div#wpbody-content div.wrap ul.subsubsub,

			body.post-type-page #titlediv > .inside,
			body.post-type-gerais #titlediv > .inside,
			body.post-type-contatos #titlediv > .inside,

			body.post-type-gerais .widefat .check-column,
			body.post-type-contatos .widefat .check-column,

			fieldset.menu-settings-group.auto-add-pages {
				display: none !important;
			}
		</style>';
	}
	add_action('admin_head','hide_buttons_page_custom');

	add_action( 'admin_menu', 'remover_menu_posttype', 999 );
	function remover_menu_posttype() {
		// Postypes defaults
		remove_submenu_page( 'edit.php?post_type=contatos', 'post-new.php?post_type=contatos' );
		remove_submenu_page( 'edit.php?post_type=gerais', 'post-new.php?post_type=gerais' );
		remove_submenu_page( 'edit.php?post_type=page', 'post-new.php?post_type=page' );

		// Aparencia
		remove_submenu_page( 'themes.php', 'themes.php' );
		remove_submenu_page( 'themes.php', 'theme-editor.php' );
		remove_submenu_page( 'themes.php', 'customize.php' );
		global $submenu;

		if ( isset( $submenu[ 'themes.php' ] ) ) {
			foreach ( $submenu[ 'themes.php' ] as $index => $menu_item ) {
				if ( in_array( 'Personalizar', $menu_item ) ) {
					unset( $submenu[ 'themes.php' ][ $index ] );
				}
			}
		}

		// Ferramentas
		remove_submenu_page( 'tools.php', 'export_personal_data' );
		remove_submenu_page( 'tools.php', 'remove_personal_data' );

		// Configurações
		remove_submenu_page( 'options-general.php', 'options-writing.php' );
		remove_submenu_page( 'options-general.php', 'options-reading.php' );
		remove_submenu_page( 'options-general.php', 'options-discussion.php' );
		remove_submenu_page( 'options-general.php', 'options-media.php' );
		remove_submenu_page( 'options-general.php', 'options-permalink.php' );
		remove_submenu_page( 'options-general.php', 'privacy.php' );
	}

	function hide_buttons(){

		echo '    <style type="text/css">
				body.options-general-php form table tr:nth-last-of-type(4),
				body.options-general-php form table tr:nth-last-of-type(3),
				body.options-general-php form table tr:nth-last-of-type(2),
				body.options-general-php form table tr:nth-last-of-type(1),
				body.options-writing-php form h2:nth-of-type(1),
				body.options-writing-php form p:nth-of-type(1),
				body.options-writing-php form table:nth-of-type(2),
				#wp-admin-bar-comments,
				#wp-admin-bar-new-content,
				#wp-admin-bar-archive,
				#wp-admin-bar-wp-logo div.ab-sub-wrapper,
				#menu-appearance .wp-submenu li:nth-last-child(1) a[href="theme-editor.php"],
				body.options-general-php .form-table tr:nth-of-type(3),
				body.options-general-php .form-table tr:nth-of-type(4){
					display: none !important;
				}
			</style>';
	}
	add_action('admin_head','hide_buttons', 5);

	function disable_comments() {
		$post_types = get_post_types();
		foreach ($post_types as $post_type) {
			if(post_type_supports($post_type,'comments')) {
				remove_post_type_support($post_type,'comments');
				remove_post_type_support($post_type,'trackbacks');
			}
		}
	}
	add_action('admin_init','disable_comments');


	add_filter('show_admin_bar', '__return_false');

	add_action('after_setup_theme', 'remove_admin_bar');
	function remove_admin_bar() {
		show_admin_bar(false);
	}

?>