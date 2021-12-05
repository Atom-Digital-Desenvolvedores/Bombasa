<?php $id_home = get_page_by_path( 'home', OBJECT, 'page' )->ID; ?>

	<section class="wq-07 wq-cto">
		<div class="wq-container">
			<h3 class="wq-titulo_1"><?php echo get_post_meta( $id_home, 'wsg_marcas_titulo', true ); ?></h3>
			<div class="wq-carousel_parceiros">
				<?php
					$entries = get_post_meta( $id_home, 'marcas_items', true );

					foreach ( (array) $entries as $key => $entry ) {

						if ( isset( $entry['wsg_marcas_items_img_id'] ) ) {
							$wsg_marcas_items_img_id = $entry['wsg_marcas_items_img_id'];
						}
				?>
					<figure>
						<?php getImageThumb($wsg_marcas_items_img_id,'full') ?>
					</figure>
				<?php } ?>
			</div>
		</div>
	</section>