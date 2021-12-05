<?php

	function wsg_remove_menu_adminpanel() {
		remove_submenu_page( 'edit.php?post_type=adminpanel', 'post-new.php?post_type=adminpanel' );
	}
	add_action( 'admin_menu', 'wsg_remove_menu_adminpanel' );

?>