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
					<?php
						$categoryProduct = get_queried_object();
						$children = get_terms( $categoryProduct->taxonomy, array( 'parent' => $categoryProduct->term_id, 'hide_empty' => false ) );

						if($children) {
							include "inc-subcategorias.php";
						}else{
							include "inc-produtos.php";
						}
					?>
				</div>
			</div>
		</div>
	</section>

	<?php include "inc-newsletter.php"; ?>

<?php get_footer(); ?>