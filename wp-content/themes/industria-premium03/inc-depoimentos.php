<?php $id_home = get_page_by_path( 'home', OBJECT, 'page' )->ID; ?>

	<section class="wq-02">
		<div class="wq-container">
			<h2 class="wq-titulo_1"><?php echo get_post_meta( $id_home, 'wsg_depoimentos_titulo', true ); ?></h2>
			<div class="wq-depoimentos-carousel">
				<?php
					$arrayQueryDepoimentos = array(
						'post_type'				=> array( 'depoimentos192' ),
						'orderby' => 'menu_order',
						'order' => 'ASC',
						'posts_per_page'		=> '-1',
					);
					$queryDepoimentos = new WP_Query($arrayQueryDepoimentos);
					while ( $queryDepoimentos->have_posts()) {
						$queryDepoimentos->the_post();
				?>
					<div class="wq-depoimentos-item">
						<figure>
							<?php
								$wsg_depoimento_item_img_id = get_post_meta( get_the_ID(), 'wsg_depoimento_item_img_id', true );
								getImageThumb($wsg_depoimento_item_img_id,'100x100');
							?>
						</figure>
						<h3><?php the_title(); ?></h3>
						<h4><?php echo get_post_meta( get_the_ID(), 'wsg_depoimento_item_cargo', true ); ?></h4>
						<?php echo wpautop(get_post_meta( get_the_ID(), 'wsg_depoimento_item_conteudo', true )); ?>
					</div>
				<?php }wp_reset_query(); ?>
			</div>
		</div>
	</section>