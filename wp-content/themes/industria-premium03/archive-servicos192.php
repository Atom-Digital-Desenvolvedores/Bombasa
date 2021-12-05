<?php
	get_header();

	$id_page = get_page_by_path( 'servicos', OBJECT, 'page' )->ID;
?>

	<?php include "inc-breadcrumbs.php"; ?>

	<section class="wq-04 wq-cto">
		<div class="wq-container">
			<h2 class="wq-titulo_1"><?php echo get_post_meta( $id_page, 'wsg_servicos_01_titulo', true ); ?></h2>
			<div class="wq-flex">
				<?php
					$arrayQueryServicos = array(
						'post_type'				=> array( 'servicos192' ),
						'orderby' => 'menu_order',
						'order' => 'ASC',
						'posts_per_page'		=> '-1',
					);
					$queryServicos = new WP_Query($arrayQueryServicos);
					while ( $queryServicos->have_posts()) {
						$queryServicos->the_post();
				?>
					<div class="wq-box_4 wq-box_cp-12 wq-box_cl-12 wq-box_tp-6 wq-box_tl-6">
						<a href="<?php the_permalink(); ?>" class="wq-servico_box">
							<figure>
								<?php
									$wsg_servico_item_icone_id = get_post_meta( get_the_ID(), 'wsg_servico_item_icone_id', true );
									getImageThumb($wsg_servico_item_icone_id,'100x100');
								?>
							</figure>
							<div>
								<h2><?php the_title(); ?></h2>
							</div>
						</a>
					</div>
				<?php }wp_reset_query(); ?>
			</div>
		</div>
	</section>

	<?php include "inc-marcas.php"; ?>

	<?php include "inc-depoimentos.php"; ?>

<?php get_footer(); ?>

