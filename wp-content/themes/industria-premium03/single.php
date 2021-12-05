<?php
	get_header();

	$id_page = get_page_by_path( 'blog', OBJECT, 'page' )->ID;
	$id_disqus = get_page_by_path( 'configuracoes-do-disqus', OBJECT, 'gerais' )->ID;
?>

	<?php include "inc-breadcrumbs.php"; ?>

	<?php
		if (have_posts()) : while (have_posts()) : the_post();
			$attachID = get_post_thumbnail_id(get_the_ID());
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

	<section class="wq-blog_01">
		<div class="wq-container">
			<div class="wq-flex">
				<?php
					get_sidebar();
				?>
				<div class="wq-box_8 wq-box_cp-12 wq-box_cl-7 wq-box_tp-7">
					<article class="wq-blog_item wq-blog_interna">
						<figure>
							<?php echo getImageThumb(get_post_thumbnail_id(), '750x400'); ?>
						</figure>
						<div>
							<h2><?php the_title(); ?></h2>
							<?php echo wpautop(the_content()); ?>
							<div class="wq-comentarios">
								<?php disqus_embed(get_post_meta( $id_disqus, 'wsg_disqus_code', true )); ?>
							</div>
						</div>
					</article>
				</div>
			</div>
		</div>
	</section>

	<?php endwhile; ?>
	<?php endif; ?>
	<?php wp_reset_query(); ?>

	<?php include "inc-newsletter.php" ?>

<?php get_footer(); ?>