<?php
	get_header();

	$id_page = get_page_by_path( 'home', OBJECT, 'page' )->ID;
?>

	<section class="wq-banner">
		<?php
			$entries = get_post_meta( $id_page, 'banner_items', true );

			foreach ( (array) $entries as $key => $entry ) {

				$wsg_banner_items_subtitulo = null;
				$wsg_banner_items_titulo = null;
				$wsg_banner_items_btn_link = null;
				$wsg_banner_items_btn_texto = null;

				if ( isset( $entry['wsg_banner_items_img_id'] ) ) {
					$wsg_banner_items_img_id = $entry['wsg_banner_items_img_id'];
				}
				if ( isset( $entry['wsg_banner_items_mobile_img_id'] ) ) {
					$wsg_banner_items_mobile_img_id = $entry['wsg_banner_items_mobile_img_id'];
				}
				if ( isset( $entry['wsg_banner_items_subtitulo'] ) ) {
					$wsg_banner_items_subtitulo = $entry['wsg_banner_items_subtitulo'];
				}
				if ( isset( $entry['wsg_banner_items_titulo'] ) ) {
					$wsg_banner_items_titulo = $entry['wsg_banner_items_titulo'];
				}
				if ( isset( $entry['wsg_banner_items_btn_link'] ) ) {
					$wsg_banner_items_btn_link = $entry['wsg_banner_items_btn_link'];
				}
				if ( isset( $entry['wsg_banner_items_btn_texto'] ) ) {
					$wsg_banner_items_btn_texto = $entry['wsg_banner_items_btn_texto'];
				}
		?>
			<div class="wq-banner-item">
				<figure>
					<?php if ( !empty($wsg_banner_items_btn_link) && empty($wsg_banner_items_btn_texto) ) { ?>
						<a href="<?php echo $wsg_banner_items_btn_link; ?>">
							<?php
								getImageThumb($wsg_banner_items_img_id,'1920x600');
							?>
						</a>
					<?php } else{ ?>
						<?php
							getImageThumb($wsg_banner_items_img_id,'1920x600');
						?>
					<?php } ?>
				</figure>
				<figure class="wq-banner_responsivo">
					<?php if ( !empty($wsg_banner_items_btn_link) && empty($wsg_banner_items_btn_texto) ) { ?>
						<a href="<?php echo $wsg_banner_items_btn_link; ?>">
							<?php
								getImageThumb($wsg_banner_items_mobile_img_id,'1000x820');
							?>
						</a>
					<?php } else{ ?>
						<?php
							getImageThumb($wsg_banner_items_mobile_img_id,'1000x820');
						?>
					<?php } ?>
				</figure>
				<div class="wq-banner_conteudo">
					<div class="wq-container">
						<div class="wq-esq">
							<?php if ( !empty($wsg_banner_items_subtitulo) ) { ?>
								<h4><?php echo $wsg_banner_items_subtitulo; ?></h4>
							<?php } ?>
							<?php if ( !empty($wsg_banner_items_titulo) ) { ?>
								<h2><?php echo $wsg_banner_items_titulo; ?></h2>
							<?php } ?>
							<?php if ( !empty($wsg_banner_items_btn_link) && !empty($wsg_banner_items_btn_texto) ) { ?>
								<a href="<?php echo $wsg_banner_items_btn_link; ?>" class="wq-btn"><?php echo $wsg_banner_items_btn_texto; ?></a>
							<?php } ?>
						</div>
					</div>
				</div>
			</div>
		<?php } ?>
	</section>

	<section class="wq-produtos_02">
		<div class="wq-container">
			<div class="wq-empresa_box">
				<div class="wq-flex">
					<div class="wq-box_5 wq-box_cp-12 wq-box_cl-12 wq-box_tp-6">
						<?php $wsg_sobre_link = get_post_meta( $id_page, 'wsg_sobre_link', true ); ?>
						<figure>
							<?php if ( !empty($wsg_sobre_link) ) { ?>
								<a href="<?php echo $wsg_sobre_link; ?>" data-lity>
									<?php
										$wsg_sobre_img_id = get_post_meta( $id_page, 'wsg_sobre_img_id', true );
										getImageThumb($wsg_sobre_img_id,'550x392');
									?>
								</a>
							<?php } else{ ?>
								<?php
									$wsg_sobre_img_id = get_post_meta( $id_page, 'wsg_sobre_img_id', true );
									getImageThumb($wsg_sobre_img_id,'550x392');
								?>
							<?php } ?>
						</figure>
					</div>
					<div class="wq-box_7 wq-box_cp-12 wq-box_cl-12 wq-box_tp-6">
						<div class="wq-empresa_box-conteudo">
							<h1><?php echo get_post_meta( $id_page, 'wsg_sobre_titulo', true ); ?></h1>
							<?php echo wpautop(get_post_meta( $id_page, 'wsg_sobre_texto', true )); ?>
							<a href="<?php bloginfo('url'); ?>/sobre-nos" class="wq-btn">
								<span>Saiba mais</span>
							</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<?php include "inc-fornecedores.php"; ?>

	<section class="wq-produtos_01">
		<div class="wq-container">
			<div class="wq-cto">
				<h3 class="wq-titulo_1"><?php echo get_post_meta( $id_page, 'wsg_produtos_titulo', true ); ?></h3>
			</div>
			<div class="wq-flex">
				<?php
					$catOriginais = get_terms('categorias_produtos', array(
						'hide_empty' => false,
						'parent'     => 0
					));
					$catsPrincipais = array();
					foreach ($catOriginais as $keyCat => $mainCat) {
						$categoria_ordem_valor = get_term_meta($mainCat->term_id, "categoria_ordem_valor");
						if (is_array($categoria_ordem_valor) && count($categoria_ordem_valor) > 0) {
							$mainCat->categoria_ordem_valor = $categoria_ordem_valor[0];
						}else{
							$mainCat->categoria_ordem_valor = 0;
						}
						array_push($catsPrincipais, $mainCat);
					}
					usort($catsPrincipais, "cmp_orde_menu_top");
					foreach ($catsPrincipais as $keyCat => $mainCat) {
						if ( get_term_meta( $mainCat->term_id, 'categoria_ordem_checkbox', true ) ) {
				?>
						<article class="wq-box_4 wq-box_cp-12 wq-box_cl-6 wq-box_tp-6">
							<div class="wq-produtos_subcategorias-box destaque">
								<figure>
									<?php
										$wsg_categorias_produtos_img_id = get_term_meta( $mainCat->term_id, 'wsg_categorias_produtos_img_id', true );
										getImageThumb($wsg_categorias_produtos_img_id,'360x290');
									?>
								</figure>
								<div>
									<h2><?php echo $mainCat->name; ?></h2>
									<a href="<?php echo get_term_link($mainCat->term_id, 'categorias_produtos' ); ?>" class="wq-btn">Saiba mais</a>
								</div>
							</div>
						</article>
					<?php } ?>
				<?php } ?>
			</div>
		</div>
	</section>

	<?php
		$wsg_estatisticas_img_id = get_post_meta($id_page, 'wsg_estatisticas_img_id', true);
		$wsg_estatisticas_img_id = wp_get_attachment_image_src($wsg_estatisticas_img_id, '1920x480');
		$wsg_estatisticas_img_id = $wsg_estatisticas_img_id[0];
	?>
	<section class="wq-estatisticas wq-cto" style="background-image: url(<?php echo $wsg_estatisticas_img_id; ?>);">
		<div class="wq-container">
			<h2 class="wq-titulo_1"><?php echo get_post_meta( $id_page, 'wsg_estatisticas_titulo', true ); ?></h2>
			<div class="wq-flex">
				<?php
					$entries = get_post_meta( $id_page, 'estatisticas_items', true );

					foreach ( (array) $entries as $key => $entry ) {

						if ( isset( $entry['wsg_estatisticas_items_valor'] ) ) {
							$wsg_estatisticas_items_valor = $entry['wsg_estatisticas_items_valor'];
						}
						if ( isset( $entry['wsg_estatisticas_items_legenda'] ) ) {
							$wsg_estatisticas_items_legenda = $entry['wsg_estatisticas_items_legenda'];
						}
				?>
					<div class="wq-box_3 wq-box_cp-12 wq-box_cl-6 wq-box_tp-4">
						<h3><?php echo $wsg_estatisticas_items_valor; ?></h3>
						<p><?php echo $wsg_estatisticas_items_legenda; ?></p>
					</div>
				<?php } ?>
			</div>
		</div>
	</section>

	<?php include "inc-marcas.php"; ?>

	<section class="wq-04 wq-cto">
		<div class="wq-container">
			<h2 class="wq-titulo_1"><?php echo get_post_meta( $id_page, 'wsg_servicos_titulo', true ); ?></h2>
			<div class="wq-flex">
				<?php
					$wsg_servicos_na_home = get_post_meta( $id_page, 'wsg_servicos_na_home', true );

					$arrayQueryServicos = array(
						'post_type'				=> array( 'servicos192' ),
						'orderby' => 'menu_order',
						'order' => 'ASC',
						'posts_per_page'		=> '-1',
						'post__in'				=> $wsg_servicos_na_home
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

	<?php include "inc-depoimentos.php"; ?>

	<section class="wq-05">
		<div class="wq-container">
			<h3 class="wq-titulo_1"><?php echo get_post_meta( $id_page, 'wsg_blog_titulo', true ); ?></h3>
			<div class="wq-flex">
				<?php
					$args = array (
						'post_type'         => 'post',
						'posts_per_page'    => 2
					);
					$query = new WP_Query( $args );
					$posts = $query->get_posts();
					foreach ($posts as $key => $item) {
						// setup_postdata($item);
						$categories = get_the_terms( $item->ID, 'category' );
						$htmlCategory = '';
						if ( $categories && ! is_wp_error( $categories ) ){
							$draught_links = array();
							foreach ($categories as $category) {
								$cat_Item = '<a href="'.get_term_link($category->term_id, "category").'" title="'.$category->name.'" > '.$category->name.'</a>';
								array_push($draught_links, $cat_Item);
							}
							$htmlCategory = implode(' | ', $draught_links);
						}
				?>
					<div class="wq-box_6 wq-box_cp-12 wq-box_cl-12 wq-box_tp-6 wq-box_tl-6">
						<div class="wq-blog_box">
							<div class="wq-flex">
								<div class="wq-box_5f wq-box_cp-12f wq-box_cl-12f wq-box_tp-12f wq-box_tl-12f">
									<figure>
										<?php echo getImageThumb(get_post_thumbnail_id($item->ID), '262x262'); ?>
									</figure>
								</div>
								<div class="wq-box_7f wq-box_cp-12f wq-box_cl-12f wq-box_tp-12f wq-box_tl-12f">
									<div class="wq-blog_box-conteudo">
										<ul class="wq-lista-inline">
											<li>
												<span class="flaticon-calendar-2"></span>
												<?php echo get_the_date('d', $item->ID); ?>.<?php echo get_the_date('m', $item->ID); ?>.<?php echo get_the_date('Y', $item->ID); ?>
											</li>
											<li>
												<span class="flaticon-folder-2"></span>
												<?php echo $htmlCategory; ?>
											</li>
										</ul>
										<h2><?php echo $item->post_title; ?></h2>
										<?php echo wpautop($item->post_excerpt); ?>
										<a href="<?php echo get_permalink($item->ID); ?>" class="wq-btn">Ler Mais</a>
									</div>
								</div>
							</div>
						</div>
					</div>
				<?php }wp_reset_query(); ?>
			</div>
		</div>
	</section>

	<?php include "inc-newsletter.php"; ?>

<?php get_footer(); ?>