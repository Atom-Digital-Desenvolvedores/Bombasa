<?php 
	add_action( 'pre_user_query', 'yoursite_pre_user_query' );
	function yoursite_pre_user_query( $user_search )
	{
		global $wpdb;
		$user = wp_get_current_user();
		$user->get_role_caps();
		$where = 'WHERE 1=1';

		// Temporarily remove this hook otherwise we might be stuck in an infinite loop
		remove_action( 'pre_user_query', 'yoursite_pre_user_query' );

		// View adminstrators? (Remember: this is capability defined by you!)
		// $view_admins = in_array( 'list_admins', $user->allcaps );
		// if ( !$view_admins ) {
		if ($user->roles[0] == 'wsg_agency') {
			// Get the list of admin IDs
			$args = array(
				'role' => 'wsg_super_admin',
			);
			$user_query = new WP_User_Query( $args );
			$admins = $user_query->get_results();

			$admin_ids = array();
			foreach ( $admins as $admin ) {
				$admin_ids[] = $admin->id;
			}

			$where .= ' AND '.$wpdb->users.'.ID NOT IN ('.implode(',', $admin_ids).')';
		}else if ($user->roles[0] !== 'wsg_super_admin' && $user->roles[0] !== 'wsg_agency') {
			// Get the list of admin IDs
			$args = array(
				'role' => array('wsg_super_admin'),
			);
			$user_query = new WP_User_Query( $args );
			$admins = $user_query->get_results();
			$admin_ids = array();
			foreach ( $admins as $admin ) {
				$admin_ids[] = $admin->id;
			}
			$args = array(
				'role' => array('wsg_agency'),
			);
			$user_query = new WP_User_Query( $args );
			$admins = $user_query->get_results();
			foreach ( $admins as $admin ) {
				$admin_ids[] = $admin->id;
			}
			$where .= ' AND '.$wpdb->users.'.ID NOT IN ('.implode(',', $admin_ids).')';
		}
		// }

		// Repeat block above for other capabilities you define,
		// i.e. hide users not everybody should see
		// ...

	// var_dump($user_search->query_where);
		// Modify original WP_User_Query
		$user_search->query_where = str_replace(
			'WHERE 1=1',
			$where,
			$user_search->query_where
		);
	// var_dump($user_search->query_where);
	// exit;
		 // Re-add the hook
		add_action( 'pre_user_query', 'yoursite_pre_user_query' );
	}

?>