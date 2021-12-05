				<aside class="wq-box_3 wq-box_cp-12 wq-box_cl-12">
					<div class="wq-buscar">
						<form method="get" action="">
							<input type="hidden" name="post_type" value="produtos192">
							<input type="text" placeholder="buscar..." name="s">
							<button type="submit">
								<span class="flaticon-search-1"></span>
							</button>
						</form>
					</div>
					<div class="wq-categorias">
						<div class="wq-accordion" data-accordion="1">
							<div class="wq-accordion_btn">
								<h3>Categorias</h3>
							</div>
							<div class="wq-accordion_content ver" data-accordion="1">
								<ul>
									<?php
										// categoria primeira linhagem
										$catOriginais = get_terms('categorias_produtos', array(
											'hide_empty' => false,
											'parent'   => 0,
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

											// categoria segunda linhagem
											$subCat = get_terms('categorias_produtos', array(
												'hide_empty' => false,
												'parent'   => $mainCat->term_id,
											));
											$subCatChild = array();
											foreach ($subCat as $keyCat => $childCat) {
												$categoria_ordem_valor = get_term_meta($childCat->term_id, "categoria_ordem_valor");
												if (is_array($categoria_ordem_valor) && count($categoria_ordem_valor) > 0) {
													$childCat->categoria_ordem_valor = $categoria_ordem_valor[0];
												}else{
													$childCat->categoria_ordem_valor = 0;
												}
												array_push($subCatChild, $childCat);
											}
											usort($subCatChild, "cmp_orde_menu_top");
											?>
												<li>
													<a href="<?php echo get_term_link($mainCat->term_id, 'categorias_produtos' ); ?>"  class="wq-tabs_btn"><?php echo $mainCat->name; ?></a>
													<?php if (count($subCatChild) > 0) { ?>
														<ul>
															<?php
																foreach ($subCatChild as $keySubCat => $mainSubCat) {
																	$subSubCat = get_terms('categorias_produtos', array(
																		'hide_empty' => false,
																		'parent'   => $mainSubCat->term_id,
																	));
																	$subSubCatChild = array();
																	foreach ($subSubCat as $keySubCat => $childSubCat) {
																		$categoria_ordem_valor = get_term_meta($childSubCat->term_id, "categoria_ordem_valor");
																		if (is_array($categoria_ordem_valor) && count($categoria_ordem_valor) > 0) {
																			$childSubCat->categoria_ordem_valor = $categoria_ordem_valor[0];
																		}else{
																			$childSubCat->categoria_ordem_valor = 0;
																		}
																		array_push($subSubCatChild, $childSubCat);
																	}
																	usort($subSubCatChild, "cmp_orde_menu_top");
															?>
																<li>
																	<a href="<?php echo get_term_link($mainSubCat->term_id, 'categorias_produtos' ); ?>"  class="wq-tabs_btn"><?php echo $mainSubCat->name; ?></a>
																	<?php if (count($subSubCatChild) > 0) { ?>
																		<ul>
																			<?php foreach ($subSubCatChild as $keySubSubCat => $mainSubSubCat) { ?>
																				<li>
																					<a href="<?php echo get_term_link($mainSubSubCat->term_id, 'categorias_produtos' ); ?>"  class="wq-tabs_btn"><?php echo $mainSubSubCat->name; ?></a>
																				</li>
																			<?php } ?>
																		</ul>
																	<?php } ?>
																</li>
															<?php } ?>
														</ul>
													<?php } ?>
												</li>
											<?php
										}
									?>
								</ul>
								<script>
									var $temFilho = $('.wq-categorias li').has( "ul" );
									$($temFilho).attr({
										class: "wq-drop",
										onclick: ""
									});
								</script>
							</div>
						</div>
					</div>
				</aside>