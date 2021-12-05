					<div class="wq-flex">
						<?php
							$catOriginais = get_terms('categorias_produtos', array(
								'hide_empty' => false,
								'parent'     => $categoryProduct->term_id
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
						?>
							<article class="wq-box_4 wq-box_cp-12 wq-box_cl-6 wq-box_tp-6">
								<div class="wq-produtos_subcategorias-box destaque">
									<figure>
										<?php
											$wsg_categorias_produtos_img_id = get_term_meta( $mainCat->term_id, 'wsg_categorias_produtos_img_id', true );
											getImageThumb($wsg_categorias_produtos_img_id,'262x212');
										?>
									</figure>
									<div>
										<h2><?php echo $mainCat->name; ?></h2>
										<a href="<?php echo get_term_link( $mainCat, 'categorias_produtos') ?>" class="wq-btn">Saiba mais</a>
									</div>
								</div>
							</article>
						<?php } ?>
					</div>