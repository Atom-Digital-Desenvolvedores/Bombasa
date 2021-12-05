<?php
	get_header();

	$id_page = get_page_by_path( 'produtos', OBJECT, 'page' )->ID;
?>

	<?php include "inc-breadcrumbs.php"; ?>

	<section class="wq-produtos_01">
		<div class="wq-container">
			<div class="wq-flex">
				<?php include "inc-sidebar.php" ?>
				<div class="wq-box_9 wq-box_cp-12 wq-box_cl-12">
					<div class="wq-produtos_subcategorias-listagem">
						<div class="wq-flex">
							<h2><?php echo get_post_meta( $id_page, 'wsg_produtos_01_titulo', true ); ?></h2>
							<form class="wq-ordenar" method="POST" action="">
								<label for="ordenarPor">ORDENAR POR:</label>
								<select name="filtrodeordenacao" id="ordenarPor">
									<option value="menor_preco">Menor preço</option>
									<option value="maior_preco">Maior preço</option>
								</select>
							</form>
							<script>
								$(function() {
									function sort_Menor(a, b) {
										return ($(b).data('valor')) < ($(a).data('valor')) ? 1 : -1;
									}
									function sort_Maior(a, b) {
										return ($(a).data('valor')) < ($(b).data('valor')) ? 1 : -1;
									}
									$("#ordenarPor").change(function () {
										var valueOption = $(this).val();
										if (valueOption == 'menor_preco'){
											$(".wq-listagem-ordenar article").sort(sort_Menor).appendTo('.wq-listagem-ordenar');
										}else if (valueOption == 'maior_preco') {
											$(".wq-listagem-ordenar article").sort(sort_Maior).appendTo('.wq-listagem-ordenar');
										}
									});
								});
							</script>
						</div>
						<div class="wq-flex wq-listagem-ordenar">
							<?php
								$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
								$arrayQueryProdutos = array(
									'post_type'			=> array( 'produtos192' ),
									'orderby' 			=> 'menu_order',
									'order' 			=> 'ASC',
									'posts_per_page'	=> '12',
									'paged' 			=> $paged,
								);
								$queryProdutos = new WP_Query($arrayQueryProdutos);
								while ( $queryProdutos->have_posts()) {
									$queryProdutos->the_post();
							?>
								<article class="wq-box_4 wq-box_cp-12 wq-box_cl-6 wq-box_tp-6" data-valor="<?php echo strip_tags(str_replace(array(',', '.'), array('', ''), $wsg_produto_info_valor)) ?>">
									<div class="wq-produtos_subcategorias-box destaque">
										<figure>
											<?php
												$wsg_produto_item_img_id = get_post_meta( get_the_ID(), 'wsg_produto_item_img_id', true );
												getImageThumb($wsg_produto_item_img_id,'262x212');
											?>
										</figure>
										<div>
											<h2><?php the_title(); ?></h2>
											<a href="<?php the_permalink(); ?>" class="wq-btn">Saiba mais</a>
										</div>
									</div>
								</article>
							<?php }wp_reset_query(); ?>
						</div>
						<?php
							if (function_exists("pagination")) {
								pagination($queryProdutos);
							}
						?>
					</div>
				</div>
			</div>
		</div>
	</section>

	<?php include "inc-newsletter.php"; ?>

<?php get_footer(); ?>