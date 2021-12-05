<?php
	get_header();

	$id_page = get_page_by_path( 'equipe', OBJECT, 'page' )->ID;
?>

	<?php include "inc-breadcrumbs.php"; ?>

	<section class="wq-vendedores_01 wq-cto">
		<div class="wq-container">
			<h3 class="wq-titulo_1"><?php echo get_post_meta( $id_page, 'wsg_equipe_01_titulo', true ); ?></h3>
			<?php echo wpautop(get_post_meta( $id_page, 'wsg_equipe_01_texto', true )); ?>
			<div class="wq-flex wq-esq">
				<?php
					$arrayQueryServicos = array(
						'post_type'				=> array( 'equipe192' ),
						'orderby' => 'menu_order',
						'order' => 'ASC',
						'posts_per_page'		=> '-1',
					);
					$queryServicos = new WP_Query($arrayQueryServicos);
					while ( $queryServicos->have_posts()) {
						$queryServicos->the_post();
				?>
					<div class="wq-box_3 wq-box_cp-12 wq-box_cl-6 wq-box_tp-6 wq-box_tl-6">
						<div class="wq-consultor_box">
							<figure>
								<?php
									$wsg_equipe_item_img_id = get_post_meta( get_the_ID(), 'wsg_equipe_item_img_id', true );
									getImageThumb($wsg_equipe_item_img_id,'280x330');
								?>
							</figure>
							<div>
								<h2><?php the_title(); ?></h2>
								<p>Diretor Comercial</p>
								<ul class="wq-consultor_contatos">
									<?php
										$entries = get_post_meta( get_the_ID(), 'equipe_redes_sociais', true );

										foreach ( (array) $entries as $key => $entry ) {

											$wsg_equipe_redes_sociais_titulo = null;
											$wsg_equipe_redes_sociais_legenda = null;

											if ( isset( $entry['wsg_equipe_redes_sociais_img_id'] ) ) {
												$wsg_equipe_redes_sociais_img_id = $entry['wsg_equipe_redes_sociais_img_id'];
											}
											if ( isset( $entry['wsg_equipe_redes_sociais_titulo'] ) ) {
												$wsg_equipe_redes_sociais_titulo = $entry['wsg_equipe_redes_sociais_titulo'];
											}
											if ( isset( $entry['wsg_equipe_redes_sociais_legenda'] ) ) {
												$wsg_equipe_redes_sociais_legenda = $entry['wsg_equipe_redes_sociais_legenda'];
											}
											if ( isset( $entry['wsg_equipe_redes_sociais_link'] ) ) {
												$wsg_equipe_redes_sociais_link = $entry['wsg_equipe_redes_sociais_link'];
											}
									?>
										<?php if ( $wsg_equipe_redes_sociais_titulo != null || strlen($wsg_equipe_redes_sociais_titulo) > 0 ) { ?>
											<li>
												<a href="<?php echo $wsg_equipe_redes_sociais_link ?>">
													<?php getImageThumb($wsg_equipe_redes_sociais_img_id,'64x64'); ?>
													<p>
													<span><?php echo $wsg_equipe_redes_sociais_titulo; ?></span>
														<?php echo $wsg_equipe_redes_sociais_legenda; ?>
													</p>
												</a>
											</li>
										<?php } ?>
									<?php } ?>
								</ul>
							</div>
						</div>
					</div>
				<?php }wp_reset_query(); ?>
			</div>
		</div>
	</section>

	<?php include "inc-marcas.php"; ?>

	<?php include "inc-depoimentos.php"; ?>

<?php get_footer(); ?>