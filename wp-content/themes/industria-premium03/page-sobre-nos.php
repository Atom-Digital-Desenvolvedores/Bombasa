<?php
	get_header();

	$id_page = get_page_by_path( 'sobre-nos', OBJECT, 'page' )->ID;
?>

	<?php include "inc-breadcrumbs.php"; ?>

	<section class="wq-sobre_01">
		<div class="wq-container">
			<div class="wq-flex">
				<div class="wq-box_6 wq-box_cp-12 wq-box_cl-12 wq-box_tp-12">
					<div class="wq-carousel_sobre owl-loaded owl-drag">
						<?php
							$wsg_sobre_01_img = get_post_meta( $id_page, 'wsg_sobre_01_img', true );

							foreach ($wsg_sobre_01_img as $key => $value){
						?>
							<figure>
								<?php getImageThumb($key,'530x334'); ?>
							</figure>
						<?php } ?>
					</div>
				</div>
				<div class="wq-box_6 wq-box_cp-12 wq-box_cl-12 wq-box_tp-12">
					<h2 class="wq-titulo_1"><?php echo get_post_meta( $id_page, 'wsg_sobre_01_titulo', true ); ?></h2>
					<?php echo wpautop(get_post_meta( $id_page, 'wsg_sobre_01_texto', true )); ?>
				</div>
			</div>
		</div>
	</section>

	<section class="wq-sobre_02">
		<div class="wq-container">
			<div class="wq-flex">
				<?php
					$entries = get_post_meta( $id_page, 'sobre_01_items', true );

					foreach ( (array) $entries as $key => $entry ) {

						$wsg_sobre_01_items_valor = null;
						$wsg_sobre_01_items_texto = null;

						if ( isset( $entry['wsg_sobre_01_items_img_id'] ) ) {
							$wsg_sobre_01_items_img_id = $entry['wsg_sobre_01_items_img_id'];
						}
						if ( isset( $entry['wsg_sobre_01_items_valor'] ) ) {
							$wsg_sobre_01_items_valor = $entry['wsg_sobre_01_items_valor'];
						}
						if ( isset( $entry['wsg_sobre_01_items_texto'] ) ) {
							$wsg_sobre_01_items_texto = $entry['wsg_sobre_01_items_texto'];
						}
				?>
					<div class="wq-box_4 wq-box_cp-12 wq-box_cl-6 wq-box_tp-6">
						<div class="wq-estatisticas_box">
							<figure>
								<?php getImageThumb($wsg_sobre_01_items_img_id,'100x100'); ?>
							</figure>
							<div>
								<?php if ($wsg_sobre_01_items_valor != null && strlen($wsg_sobre_01_items_valor) > 0) { ?>
									<h2><?php echo $wsg_sobre_01_items_valor; ?></h2>
								<?php } ?>
								<?php if ($wsg_sobre_01_items_texto != null && strlen($wsg_sobre_01_items_texto) > 0) { ?>
									<p><?php echo $wsg_sobre_01_items_texto; ?></p>
								<?php } ?>
							</div>
						</div>
					</div>
				<?php } ?>
			</div>
		</div>
	</section>

	<section class="wq-sobre_03 wq-cto">
		<div class="wq-container">
			<div class="wq-flex">
				<?php
					$entries = get_post_meta( $id_page, 'sobre_02_items', true );

					foreach ( (array) $entries as $key => $entry ) {

						$wsg_sobre_02_items_titulo = null;
						$wsg_sobre_02_items_texto = null;

						if ( isset( $entry['wsg_sobre_02_items_img_id'] ) ) {
							$wsg_sobre_02_items_img_id = $entry['wsg_sobre_02_items_img_id'];
						}
						if ( isset( $entry['wsg_sobre_02_items_titulo'] ) ) {
							$wsg_sobre_02_items_titulo = $entry['wsg_sobre_02_items_titulo'];
						}
						if ( isset( $entry['wsg_sobre_02_items_texto'] ) ) {
							$wsg_sobre_02_items_texto = $entry['wsg_sobre_02_items_texto'];
						}
				?>
					<div class="wq-box_4 wq-box_cp-12 wq-box_cl-6 wq-box_tp-6">
						<figure>
							<?php getImageThumb($wsg_sobre_02_items_img_id,'100x100'); ?>
						</figure>
						<?php if ($wsg_sobre_02_items_titulo != null && strlen($wsg_sobre_02_items_titulo) > 0) { ?>
							<h2><?php echo $wsg_sobre_02_items_titulo; ?></h2>
						<?php } ?>
						<?php if ($wsg_sobre_02_items_texto != null && strlen($wsg_sobre_02_items_texto) > 0) { ?>
							<?php echo wpautop($wsg_sobre_02_items_texto); ?>
						<?php } ?>
					</div>
				<?php } ?>
			</div>
		</div>
	</section>

	<?php include "inc-marcas.php"; ?>

	<?php include "inc-depoimentos.php"; ?>

<?php get_footer(); ?>

