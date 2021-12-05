<?php
	function disqus_embed($disqus_shortname) {
		global $post;

		if(isset($_SERVER['HTTPS'])) {
			if ($_SERVER['HTTPS'] == "on") {
				$secure_connection = true;
			}
		}
		if ($secure_connection) {
			wp_enqueue_script('disqus_embed','https://'.$disqus_shortname.'.disqus.com/embed.js');
		}else{
			wp_enqueue_script('disqus_embed','http://'.$disqus_shortname.'.disqus.com/embed.js');
		}
		echo '<div id="disqus_thread"></div>
		<script type="text/javascript">
			var disqus_shortname = "'.$disqus_shortname.'";
			var disqus_title = "'.$post->post_title.'";
			var disqus_url = "'.get_permalink($post->ID).'";
			var disqus_identifier = "'.$disqus_shortname.'-'.$post->ID.'";
		</script>';
	}

	function isSave($post){
		// pointless if $_POST is empty (this happens on bulk edit)
		if ( empty( $_POST ) )
			return false;

		// verify quick edit nonce
		if ( isset( $_POST[ '_inline_edit' ] ) && ! wp_verify_nonce( $_POST[ '_inline_edit' ], 'inlineeditnonce' ) )
			return false;

		if (defined('DOING_AJAX') && DOING_AJAX)
			return false;

		// don't save for autosave
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
			return false;

		return true;
	}

	function pagination($query = null, $pages = '', $range = 4){

		$showitems = ($range * 2)+1;
		global $paged;
		if(empty($paged)) $paged = 1;

		if($pages == '')
		{
			if ($query == null) {
				global $wp_query;
				$query = $wp_query;
			}
			$pages = $query->max_num_pages;
			if(!$pages)
			{
				$pages = 1;
			}
		}

		echo '<div class="wq-pagination"><ul class="wq-lista-inline">';
		if( $paged > 1 ){
			echo '<li><a href="'.get_pagenum_link( $paged - 1 ).'"><span class="flaticon-arrow-left"></span></a></li>';
		}
		for ($i=1; $i <= $pages; $i++)
		{
			if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems ))
			{
				echo ($paged == $i)? "<li><a href=\"javascript:;\" class=\"active\">".$i."</a></li>":"<li><a href=\"".get_pagenum_link($i)."\" class=\" \">".$i."</a></li>";
			}
		}
		if ($paged < $pages){
			echo '<li><a href="'.get_pagenum_link($paged + 1).'"><span class="flaticon-arrow-right"></span></a></li>';
		}
		echo '</ul></div>';

	}

	function SearchFilter($query) {
		if (is_admin()) {
			return $query;
		}
			if (is_home()) {
				if (isset($query->query_vars['post_type'])) {
					if ($query->query_vars['post_type'] == 'post') {
						$query->set('posts_per_page', 6);
					}
				}else{
					$query->set('posts_per_page', 6);
				}
			}else if(is_page('blog') || is_category() || is_tag() || is_search() || is_date()) {
				$query->set('posts_per_page', 6);
			}else if( is_post_type_archive( 'produtos192' ) || is_tax( 'categorias_produtos' ) ) {
				$query->set('posts_per_page', 12);
			}
		return $query;
	}
	add_filter('pre_get_posts','SearchFilter');


	function role_exists( $role ) {
		if( ! empty( $role ) ) {
			return $GLOBALS['wp_roles']->is_role( $role );
		}
		return false;
	}

?>