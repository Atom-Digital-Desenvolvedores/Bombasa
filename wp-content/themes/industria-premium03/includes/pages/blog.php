<?php

	add_action( 'cmb2_admin_init', 'metaboxes_blog' );

	function metaboxes_blog() {

		// Método de especificação de página
		$blogPage = get_page_by_path( 'blog', OBJECT, 'page' );

		$post_id;

		if (isset($_GET['post'])) {
			$post_id = $_GET['post'];
		}else if(isset($_POST['post_ID'])) {
			$post_id = $_POST['post_ID'];
		}
		if( !isset( $post_id ) ) return;

		if($blogPage && $blogPage->ID != $post_id){
			return;
		}

	}


	add_action( 'admin_head-post-new.php', 'add_recommendation_images_to_upload' );
	add_action( 'admin_head-post.php', 'add_recommendation_images_to_upload' );

	function add_recommendation_images_to_upload()
	{
		global $post;
		$size = NULL;

		if('post' == $post->post_type){
			$size = '750x400';
		}
		if ($size !== NULL) {
			?>
			<script type="text/javascript">
				jQuery( document ).ready(function() {
					jQuery('<p style="text-align: center"><strong>Tamanho recomendado: </strong><?php echo $size; ?></p>').insertAfter('#postimagediv div.inside')
				});
			</script>
			<?php
		}
	}
?>