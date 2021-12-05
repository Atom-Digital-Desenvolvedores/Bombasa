<?php
	/*
		<?php
		    $args = array (
		        'post_type'         => 'adminpanel',
		        'posts_per_page'    => '-1',
		        'order'             => 'ASC',
		        'meta_key'          => '_position',
		        'orderby'           => 'meta_value_num'
		    );
		    query_posts($args);
		    if (have_posts()) : while (have_posts()) : the_post();
		    ?>
				<li>
					<a href="<?php echo get_post_meta( get_the_ID(), '_url', true ); ?>" target="_blank">
						<?php echo getImageThumb(get_post_thumbnail_id(get_the_ID()), 'full'); ?>
					</a>
				</li>
		<?php endwhile; ?>
		<?php endif; wp_reset_query(); ?>
	*/
?>