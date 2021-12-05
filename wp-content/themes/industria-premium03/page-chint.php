<?php
	get_header();

	$id_page = get_page_by_path( 'chint', OBJECT, 'page' )->ID;
?>

	<?php include "inc-breadcrumbs.php"; ?>

	<section class="wq-chint_01">
		<div class="wq-container">
			<div class="wq-cto">
				<h3 class="wq-titulo_1"><?php echo get_post_meta( $id_page, 'wsg_chint_01_titulo', true ); ?></h3>
				<p><?php echo get_post_meta( $id_page, 'wsg_chint_01_subtitulo', true ); ?></p>
			</div>
			<div class="wq-flex">
				<?php
					$entries = get_post_meta( $id_page, 'chint_01_items', true );
					foreach ( (array) $entries as $key => $entry ) {

						if ( isset( $entry['wsg_chint_01_items_img_id'] ) ) {
							$wsg_chint_01_items_img_id = $entry['wsg_chint_01_items_img_id'];
						}
						if ( isset( $entry['wsg_chint_01_items_link'] ) ) {
							$wsg_chint_01_items_link = $entry['wsg_chint_01_items_link'];
						}
				?>
					<div class="wq-box_2 wq-box_cl-6 wq-box_cp-4 wq-box_tp-3">
						<a href="<?php echo $wsg_chint_01_items_link; ?>">
							<figure>
								<?php getImageThumb($wsg_chint_01_items_img_id,'200x200'); ?>
							</figure>
						</a>
					</div>
				<?php } ?>
			</div>
		</div>
	</section>

<?php get_footer(); ?>

