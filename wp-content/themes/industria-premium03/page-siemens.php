<?php
	get_header();

	$id_page = get_page_by_path( 'siemens', OBJECT, 'page' )->ID;
?>

	<?php include "inc-breadcrumbs.php"; ?>

	<section class="wq-siemens_01">
		<div class="wq-container">
			<div class="wq-cto">
				<h3 class="wq-titulo_1"><?php echo get_post_meta( $id_page, 'wsg_siemens_01_titulo', true ); ?></h3>
			</div>
			<div class="wq-tabs">
				<div class="wq-tabs_btns">
					<?php
						$position = 0;
						$entries = get_post_meta( $id_page, 'siemens_01_items', true );

						foreach ( (array) $entries as $key => $entry ) {
							$position++;

							if ( isset( $entry['wsg_siemens_01_items_legenda'] ) ) {
								$wsg_siemens_01_items_legenda = $entry['wsg_siemens_01_items_legenda'];
							}
					?>
						<a href="javascript:void(0)" class="wq-tabs_btn" data-tab="<?php echo $position; ?>"><?php echo $wsg_siemens_01_items_legenda; ?></a>
					<?php } ?>
				</div>
				<div class="wq-tabs_contents">
					<?php
						$position = 0;
						$entries = get_post_meta( $id_page, 'siemens_01_items', true );

						foreach ( (array) $entries as $key => $entry ) {
							$position++;

							if ( isset( $entry['wsg_siemens_01_items_titulo'] ) ) {
								$wsg_siemens_01_items_titulo = $entry['wsg_siemens_01_items_titulo'];
							}
							if ( isset( $entry['wsg_siemens_01_items_texto'] ) ) {
								$wsg_siemens_01_items_texto = $entry['wsg_siemens_01_items_texto'];
							}
							if ( isset( $entry['wsg_siemens_01_items_imgs'] ) ) {
								$wsg_siemens_01_items_imgs = $entry['wsg_siemens_01_items_imgs'];
							}
							if ( isset( $entry['wsg_siemens_01_items_pdf'] ) ) {
								$wsg_siemens_01_items_pdf = $entry['wsg_siemens_01_items_pdf'];
							}
							if ( isset( $entry['wsg_siemens_01_items_btn_texto'] ) ) {
								$wsg_siemens_01_items_btn_texto = $entry['wsg_siemens_01_items_btn_texto'];
							}
					?>
						<div data-tab="<?php echo $position; ?>">
							<h2><?php echo $wsg_siemens_01_items_titulo; ?></h2>
							<?php echo wpautop($wsg_siemens_01_items_texto); ?>
							<div class="wq-flex">
								<?php foreach ($wsg_siemens_01_items_imgs as $key => $value){ ?>
									<div class="wq-box_3 wq-box_cp-12 wq-box_cl-6 wq-box_tp-4">
										<figure>
											<?php getImageThumb($key,'300x300'); ?>
										</figure>
									</div>
								<?php } ?>
							</div>
							<a href="<?php echo $wsg_siemens_01_items_pdf; ?>" class="wq-btn"><?php echo $wsg_siemens_01_items_btn_texto; ?></a>
						</div>
					<?php } ?>
				</div>
			</div>
		</div>
	</section>

<?php get_footer(); ?>

