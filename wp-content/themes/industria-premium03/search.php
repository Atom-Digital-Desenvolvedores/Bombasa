<?php
	get_header();

	$id_page = get_page_by_path( 'blog', OBJECT, 'page' )->ID;
?>

	<?php include "inc-breadcrumbs.php"; ?>

	<section class="wq-blog_01">
		<div class="wq-container">
			<div class="wq-flex">
				<?php
					get_sidebar();
				?>
				<div class="wq-box_8 wq-box_cp-12 wq-box_cl-7 wq-box_tp-7">
					<?php
						global $query_string;
						$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
						$query_args = explode("&", $query_string);
						// essa variavel não deve ser reuniciada
						$search_query = array();
						foreach($query_args as $key => $string) {
							$query_split = explode("=", $string);
							$search_query[$query_split[0]] = urldecode($query_split[1]);
						}
						$search_query['post_type'] = array('post');
						$search_query['posts_per_page'] = 5;
						$search_query['paged'] = $paged;

						$query = new WP_Query( $search_query );
						if ( $query->have_posts() ) {
							while ( $query->have_posts() ) {
								$query->the_post();
								$attachID = get_post_thumbnail_id( get_the_ID() );

								$categories = get_the_terms( get_the_ID(), 'category' );
								$htmlCategory = '';
								if ( $categories && ! is_wp_error( $categories ) ){
									$draught_links = array();
									foreach ($categories as $category) {
										$item = '<a href="'.get_term_link($category->term_id, "category").'" title="'.$category->name.'" > '.$category->name.'</a>';
										array_push($draught_links, $item);
									}
									$htmlCategory = implode(' | ', $draught_links);
								}
					?>
						<article class="wq-blog_item">
							<figure>
								<?php echo getImageThumb(get_post_thumbnail_id(), '750x400'); ?>
							</figure>
							<div>
								<h2><?php the_title(); ?></h2>
								<?php echo wpautop(the_excerpt()); ?>
								<div class="wq-blog_item-info">
									<a href="<?php echo get_permalink(); ?>" class="wq-btn wq-btn_azul">Saiba mais</a>
									<ul class="wq-blog_info wq-lista-inline">
										<li>
											<img src="<?php bloginfo('template_url'); ?>/img/blog_icone-1.png" alt="icone da Data" title="Data">
											<span><?php echo get_the_date('d', $item->ID); ?>.<?php echo get_the_date('m', $item->ID); ?>.<?php echo get_the_date('Y', $item->ID); ?></span>
										</li>
										<li>
											<img src="<?php bloginfo('template_url'); ?>/img/blog_icone-2.png" alt="icone da Categoria" title="Categoria">
											<?php echo $htmlCategory; ?>
										</li>
										<li>
											<img src="<?php bloginfo('template_url'); ?>/img/blog_icone-3.png" alt="icone do Autor" title="Autor">
											<span>PUBLICADO POR: <?php echo get_the_author(); ?></span>
										</li>
									</ul>
								</div>
							</div>
						</article>
					<?php } } wp_reset_query(); ?>
					<?php
						if (function_exists("pagination")) {
							pagination($query);
						}
					?>
				</div>
			</div>
		</div>
	</section>

	<?php include "inc-newsletter.php" ?>

<?php get_footer(); ?>