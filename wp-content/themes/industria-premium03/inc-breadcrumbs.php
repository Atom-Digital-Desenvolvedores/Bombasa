<section class="wq-banner_pagina">
		<figure>
			<?php
				$wsg_banner_all_pages_img_id = get_post_meta($id_page, 'wsg_banner_all_pages_img_id', true);
				getImageThumb($wsg_banner_all_pages_img_id,'1920x110');
			?>
		</figure>
		<div class="wq-breadcrumbs">
			<div class="wq-container">
				<div class="wq-flex">
					<?php if ( is_page() || is_single() ) { ?>
						<h1><?php the_title(); ?></h1>
					<?php } elseif ( is_post_type_archive('produtos192') ) { ?>
						<h1><?php echo get_page_by_path( 'produtos', OBJECT, 'page' )->post_title; ?></h1>
					<?php } elseif ( is_post_type_archive('servicos192') ) { ?>
						<h1><?php echo get_page_by_path( 'servicos', OBJECT, 'page' )->post_title; ?></h1>
					<?php } elseif ( is_post_type_archive('equipe192') ) { ?>
						<h1><?php echo get_page_by_path( 'equipe', OBJECT, 'page' )->post_title; ?></h1>
					<?php } elseif ( is_tax('categorias_produtos') ) { ?>
						<h1>Categoria: <?php $categoryProduct = get_queried_object(); echo $categoryProduct->name; ?></h1>
					<?php } elseif ( is_category() ) { ?>
						<h1>Categoria: <?php echo $category->name; ?></h1>
					<?php } elseif ( is_search() ) { ?>
						<h1>Resultados de: <?php echo $_GET['s'];?></h1>
					<?php } elseif ( is_tag() ) { ?>
						<h1>Tag: <?php echo $tag->name; ?></h1>
					<?php } ?>
					<?php
						if ( function_exists('yoast_breadcrumb') ) {
							yoast_breadcrumb('<p id="breadcrumbs">','</p>');
						}
					?>
				</div>
			</div>
		</div>
	</section>