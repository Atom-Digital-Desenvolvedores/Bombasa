<?php
	$id_sobre = get_page_by_path( 'sobre-nos', OBJECT, 'page' )->ID;
	$id_admin = get_page_by_path( 'slug-outras-info', OBJECT, 'adminpanel' )->ID;

	$id_logo = get_page_by_path( 'configuracoes-da-logo', OBJECT, 'gerais' )->ID;
	$id_telefones = get_page_by_path( 'telefones', OBJECT, 'contatos' )->ID;
	$id_email = get_page_by_path( 'email', OBJECT, 'contatos' )->ID;
	$id_endereco = get_page_by_path( 'endereco', OBJECT, 'contatos' )->ID;
?>

	<footer class="wq-footer">
		<div class="wq-footer_top">
			<div class="wq-container">
				<div class="wq-flex">
					<div class="wq-box_3 wq-box_cp-12 wq-box_cl-6 wq-box_tp-6">
						<h4>Redes sociais</h4>
						<ul class="wq-midias-sociais wq-lista-inline">
							<?php
								$arrayQuery_Midias_Sociais = array(
									'post_type'			=> array( 'redes_sociais' ),
									'posts_per_page'	=> '-1',
									'orderby' 			=> 'menu_order',
									'order' 			=> 'ASC',
								);

								$query_Midias_Sociais = new WP_Query($arrayQuery_Midias_Sociais);

								while ( $query_Midias_Sociais->have_posts()) {
									$query_Midias_Sociais->the_post();
							?>
								<li>
									<a href="<?php echo get_post_meta( get_the_ID(), 'wsg_redes_sociais_link', true ); ?>" target="_blank" class="flaticon-<?php echo get_post_meta( get_the_ID(), 'wsg_redes_sociais_titulo', true); ?>"></a>
								</li>
							<?php
								} wp_reset_query();
							?>
						</ul>

						<a href="<?php bloginfo( 'url' ); ?>/" class="wq-logo">
							<figure>
								<?php
									$wsg_logo_footer_img_id = get_post_meta( $id_logo, 'wsg_logo_footer_img_id', true );
									echo getImageThumb($wsg_logo_footer_img_id, 'full');
								?>
							</figure>
						</a>
					</div>
					<!-- <div class="wq-box_3 wq-box_cp-12 wq-box_cl-6 wq-box_tp-6">
						<h4>
							<?php
								$menu_location = 'footer-menu';
								$menu_locations = get_nav_menu_locations();
								$menu_object = (isset($menu_locations[$menu_location]) ? wp_get_nav_menu_object($menu_locations[$menu_location]) : null);
								$menu_name = (isset($menu_object->name) ? $menu_object->name : '');
								echo esc_html($menu_name);
							?>
						</h4>
							<ul class="wq-menu_footer">
								<?php
									$menu_name = 'footer-menu';
									$locations = get_nav_menu_locations();
									$menu = wp_get_nav_menu_object( $locations[ $menu_name ] );
									$primaryNav = wp_get_nav_menu_items( $menu->term_id, array( 'order' => 'DESC' ) );

									$activeclass = '';
									$count = 0;
									$submenu = FALSE;
									foreach ( $primaryNav as $navItem ) {
										$activeclass = '';
										// if($navItem->object_id == $getid){
										// 	$activeclass = 'class="live-act"';
										// }
										if (!$navItem->menu_item_parent ){
											$parent_id = $navItem->ID;
											//var_dump($navItem);
											echo '<li><a href="'.$navItem->url.'" class= "'.$navItem->classes[0].'" title="'.$navItem->title.'">'.$navItem->title.'</a>';
										}
										if ( $parent_id == $navItem->menu_item_parent ) {
											if ( !$submenu ): $submenu = true;
												echo "<ul>";
											endif;
								?>
									<li>
										<a href="<?php echo $navItem->url; ?>" class="<?php echo $navItem->classes[0]; ?>"><?php echo $navItem->title; ?></a>
									</li>
								<?php
											if ( $primaryNav[ $count + 1 ]->menu_item_parent != $parent_id && $submenu ){
												echo "</ul>";
												$submenu = false;
											}
										}
										if ( $primaryNav[ $count + 1 ]->menu_item_parent != $parent_id ){
											echo "</li>";
											$submenu = false;
										}
										$count++;
									}
								?>
							</ul>
						<script>
							var $temFilho = $('.wq-menu_footer li').has( "ul" );
							$($temFilho).attr({
								class: "wq-drop",
								onclick: ""
							});
						</script>
					</div> -->
					<div class="wq-box_3 wq-box_cp-12 wq-box_cl-6 wq-box_tp-6">
						<h4>Serviços</h4>
						<ul class="wq-formas_de_pagamento">
							<?php
								$arrayQueryServicos = array(
									'post_type'				=> array( 'servicos192' ),
									'orderby' => 'menu_order',
									'order' => 'ASC',
									'posts_per_page'		=> '5',
								);
								$queryServicos = new WP_Query($arrayQueryServicos);
								while ( $queryServicos->have_posts()) {
									$queryServicos->the_post();
							?>
								<li>
									<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
								</li>
							<?php } ?>
						</ul>
					</div>



					<?php
						$arrayQueryUnidades = array(
							'post_type'				=> array( 'unidades192' ),
							'orderby' => 'menu_order',
							'order' => 'ASC',
							'posts_per_page'		=> '3',
						);
						$queryUnidades = new WP_Query($arrayQueryUnidades);
						while ( $queryUnidades->have_posts()) {
							$queryUnidades->the_post();
					?>
					<div class="wq-box_3 wq-box_cp-12 wq-box_cl-6 wq-box_tp-6">
						<h4><?php the_title(); ?></h4>

						<ul class="wq-footer_contatos">
							<?php
								$wsg_unidade_emails = get_post_meta( get_the_ID(), 'wsg_unidade_emails', true );
								if( $wsg_unidade_emails ){
								foreach ( (array) $wsg_unidade_emails as $key => $email ) {
							?>
								<li>
									<a href="mailto:<?php echo $email; ?>" target="_blank">
										<span class="flaticon-mail-1"></span>
										<p>
											<span>Email</span>
											<?php echo $email; ?>
										</p>
									</a>
								</li>
							<?php
								}}
							?>
							<?php
								$entries = get_post_meta( get_the_ID(), 'wsg_unidade_tel_items', true );

								if( $entries ){
									foreach ( (array) $entries as $key => $entry ) {

										if ( isset( $entry['wsg_unidade_tel_nmr'] ) ) {
											$wsg_unidade_tel_nmr = $entry['wsg_unidade_tel_nmr'];
										}
										if ( isset( $entry['wsg_unidade_tel_link'] ) ) {
											$wsg_unidade_tel_link = $entry['wsg_unidade_tel_link'];
										}
										if ( isset( $entry['wsg_unidade_tel_icone'] ) ) {
											$wsg_unidade_tel_icone = $entry['wsg_unidade_tel_icone'];
										}
							?>
								<li>
									<a href="<?php echo $wsg_unidade_tel_link; ?>" target="_blank">
										<?php if ( $wsg_unidade_tel_icone == "phone-1" ){ ?>
											<span class="flaticon-phone-1"></span>
											<p>
												<span>Telefone</span>
										<?php } else { ?>
											<span class="flaticon-whatsapp-1"></span>
											<p>
												<span>Whatsapp</span>
										<?php } ?>
											<?php echo $wsg_unidade_tel_nmr; ?>
										</p>
									</a>
								</li>
							<?php }}?>

							<!-- Endereços -->
							<?php if( $wsg_unidade_endereco = get_post_meta( get_the_ID(), 'wsg_unidade_endereco', true ) ){ ?>
								<li>
									<span class="flaticon-placeholder-1"></span>
									<div>
										<p>
											<span><?php the_title(); ?></span>
											<?php echo $wsg_unidade_endereco; ?>
										</p>
									</div>
								</li>
							<?php } ?>
							</ul>
						</div>
					<?php } ?>
				</div>
			</div>
		</div>
		<div class="wq-footer_bottom">
			<div class="wq-container">
				<div class="wq-flex">
					<?php echo wpautop(get_post_meta( $id_sobre, 'wsg_sobre_footer_copyright', true )); ?>
					<?php echo wpautop(get_post_meta( $id_admin, 'agency_setting_footer_site_content', true )); ?>
				</div>
			</div>
		</div>
	</footer>

	<?php
		$id_google = get_page_by_path( 'configuracoes-do-google', OBJECT, 'gerais' )->ID;

		echo get_post_meta( $id_google, 'script_analytics', true );
	?>

	<script src="<?php bloginfo('template_url') ?>/js-template/footer-load.js"></script>

	<?php wp_footer(); ?>

	<?php
		$wsg_whatsapp_popup_link = get_post_meta( $id_telefones, 'wsg_whatsapp_popup_link', true );
		if ( !empty($wsg_whatsapp_popup_link) ) {
	?>
		<div class="wq-whatsapp_btn">
			<a href="<?php echo $wsg_whatsapp_popup_link; ?>" target="_blank">
				<span class="flaticon-whatsapp-2"></span>
			</a>
		</div>
	<?php } ?>

</body>
</html>