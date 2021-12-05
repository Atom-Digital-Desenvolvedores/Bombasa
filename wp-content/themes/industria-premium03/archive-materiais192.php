<?php
	get_header();

	$id_page = get_page_by_path( 'cases', OBJECT, 'page' )->ID;
?>

	<?php include "inc-breadcrumbs.php"; ?>

	<section class="wq-potifolio">
		<div class="wq-container">
			<div class="wq-flex">
				<div class="wq-box_4 wq-box_cp-12 wq-box_cl-12 wq-box_tp-12 wq-box_tl-6">
					<div class="wq-filtro">
						<h2 class="wq-titulo_1">Filtrar por:</h2>
						<div class="wq-filtro_box">
							<h3>Formato</h3>
						</div>
						<div class="wq-filtro_box">
							<h3>Categoria</h3>
						</div>
					</div>
				</div>
				<div class="wq-box_8 wq-box_cp-12 wq-box_cl-12 wq-box_tp-12 wq-box_tl-6">
					<h2 class="wq-titulo_1">Lista de materiais</h2>
					<div class="wq-flex">
						<?php
							$arrayQueryCases = array(
								'post_type'				=> array( 'materiais192' ),
								'orderby' => 'menu_order',
								'order' => 'ASC',
								'posts_per_page'		=> '-1',
							);
							$queryCases = new WP_Query($arrayQueryCases);
							while ( $queryCases->have_posts()) {
								$queryCases->the_post();
						?>
							<div class="wq-box_4 wq-box_cp-12 wq-box_cl-12 wq-box_tp-12 wq-box_tl-6">
								<div class="wq-portifolio-box">
									<a href="<?php echo get_post_meta( get_the_ID(), 'wsg_material_item_pdf', true ); ?>" target="_blank">
										<figure>
											<?php
												$wsg_material_item_img_id = get_post_meta( get_the_ID(), 'wsg_material_item_img_id', true );
												getImageThumb($wsg_material_item_img_id,'220x168');
											?>
										</figure>
										<div>
											<h2><?php the_title(); ?></h2>
											<?php echo wpautop(get_post_meta( get_the_ID(), 'wsg_material_item_resumo', true )); ?>
										</div>
									</a>
								</div>
							</div>
						<?php }wp_reset_query(); ?>
					</div>
				</div>
			</div>
		</div>
	</section>

<?php get_footer(); ?>