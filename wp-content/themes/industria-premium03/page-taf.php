<?php
	get_header();

	$id_page = get_page_by_path( 'taf', OBJECT, 'page' )->ID;
?>

	<?php include "inc-breadcrumbs.php"; ?>

	<section class="wq-taf_01">
		<div class="wq-container">
			<div class="wq-cto">
				<h3 class="wq-titulo_1"><?php echo get_post_meta( $id_page, 'wsg_taf_01_titulo', true ); ?></h3>
				<p><?php echo get_post_meta( $id_page, 'wsg_taf_01_subtitulo', true ); ?></p>
			</div>
			<div class="wq-flex">
				<?php
					$entries = get_post_meta( $id_page, 'taf_01_items', true );
					foreach ( (array) $entries as $key => $entry ) {

						if ( isset( $entry['wsg_taf_01_items_img_id'] ) ) {
							$wsg_taf_01_items_img_id = $entry['wsg_taf_01_items_img_id'];
						}
						if ( isset( $entry['wsg_taf_01_items_link'] ) ) {
							$wsg_taf_01_items_link = $entry['wsg_taf_01_items_link'];
						}
				?>
					<div class="wq-box_3 wq-box_cp-12 wq-box_cl-6 wq-box_tp-4">
						<a href="<?php echo $wsg_taf_01_items_link; ?>">
							<figure>
								<?php getImageThumb($wsg_taf_01_items_img_id,'300x300'); ?>
							</figure>
						</a>
					</div>
				<?php } ?>
			</div>
		</div>
	</section>

<?php get_footer(); ?>

