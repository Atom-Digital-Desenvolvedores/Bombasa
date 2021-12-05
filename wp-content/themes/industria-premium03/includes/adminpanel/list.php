<?php

	//first register the column
	add_filter('manage_adminpanel_posts_columns', 'adminpanel_posts_columns');
	function adminpanel_posts_columns($defaults){
		$new = array();
		$new['cb'] = '<input type="checkbox" />';
		$new['title'] = "Título";
		// $new['position'] = "Ordem";
		unset($defaults['date']);
		$defaults = $new + $defaults;
		return $defaults;
	}

	//then you need to render the column
	add_action('manage_adminpanel_posts_custom_column', 'adminpanel_posts_custom_columns', 5, 2);
	function adminpanel_posts_custom_columns($column_name, $post_id){
		if($column_name === 'position'){
			// echo get_post_meta( $post_id, '_position', true );
		}
	}

?>