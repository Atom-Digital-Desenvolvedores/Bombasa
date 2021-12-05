<?php
	get_header();

	$id_page = get_page_by_path( 'servicos', OBJECT, 'page' )->ID;

	$id_telefones = get_page_by_path( 'telefones', OBJECT, 'contatos' )->ID;

	$id_contato = get_page_by_path( 'contato', OBJECT, 'page' )->ID;

	$wsg_contato_widget = get_post_meta($id_contato, 'wsg_contato_widget', true);
?>

	<?php include "inc-breadcrumbs.php"; ?>

	<section class="wq-atuacao_01 wq-suprimentos_section">
		<div class="wq-container">
			<div class="wq-flex">
				<article class="wq-box_8 wq-box_cp-12 wq-box_cl-6">
					<div class="wq-solucao_interna">
						<figure class="wq-atuacao_icone">
							<?php
								$wsg_servico_item_icone_id = get_post_meta( get_the_ID(), 'wsg_servico_item_icone_id', true );
								getImageThumb($wsg_servico_item_icone_id,'100x100');
							?>
						</figure>
						<figure>
							<?php
								$wsg_servico_interna_img_id = get_post_meta( get_the_ID(), 'wsg_servico_interna_img_id', true );
								getImageThumb($wsg_servico_interna_img_id,'530x334');
							?>
						</figure>
					</div>
					<h2 class="wq-titulo_1"><?php echo get_post_meta( get_the_ID(), 'wsg_servico_interna_titulo', true ); ?></h2>
					<?php echo wpautop(get_post_meta( get_the_ID(), 'wsg_servico_interna_conteudo', true )); ?>
				</article>
				<aside class="wq-box_4 wq-box_cp-12 wq-box_cl-6">
					<div class="wq-suprimentos_section__form">
						<h3><?php echo get_post_meta( $id_page, 'wsg_servicos_formulario_titulo', true ); ?></h3>
						<p><?php echo get_post_meta( $id_page, 'wsg_servicos_formulario_subtitulo', true ); ?></p>
						<form action="#" onsubmit="return submitFormWithRecaptcha(this);" class="contact-form" method="POST">

							<input type="hidden" name="subject_email" value="Enviado pelo site">
							<input required type="hidden" name="title_email" value="Contato enviado pelo formulário da página: <?php the_title(); ?>">

							<input type="hidden" name="label-send-data-name" value="Nome">
							<input required type="text" name="send-data-name" placeholder="Qual é o seu nome?">

							<input type="hidden" name="label-send-data-email" value="Email">
							<input required type="email" name="send-data-email" placeholder="Qual é o seu melhor email?">

							<input type="hidden" name="label-send-data-phone" value="Telefone">
							<input required type="text" name="send-data-phone" placeholder="Qual é o seu telefone?" class="inputphone">

							<?php if (strlen($wsg_contato_widget) > 0) { ?>
								<div class="g-recaptcha invisible-recaptcha" id="recaptcha-<?php echo md5(uniqid(rand(), true)); ?>" data-sitekey="<?php echo $wsg_contato_widget; ?>" data-size="invisible"></div>
							<?php } ?>

							<button class="wq-btn wq-btn_azul" type="submit">Enviar</button>
						</form>
					</div>
					<?php
						$wsg_whatsapp_btn_sidebar_link = get_post_meta( $id_telefones, 'wsg_whatsapp_btn_sidebar_link', true );
						if (!empty($wsg_whatsapp_btn_sidebar_link)) {
					?>
						<a href="<?php echo $wsg_whatsapp_btn_sidebar_link; ?>" class="wq-btn_whatsapp">
							<span class="flaticon-whatsapp-2"></span>
							<span>ATENDIMENTO POR WHATSAPP</span>
						</a>
					<?php } ?>
				</aside>
			</div>
		</div>
	</section>

	<section class="wq-04 wq-cto">
		<div class="wq-container">
			<h2 class="wq-titulo_1">Outras soluções</h2>
			<div class="wq-flex">
				<?php
					$arrayQueryServicos = array(
						'post_type'				=> array( 'servicos192' ),
						'posts_per_page'		=> '4',
						'orderby' => 'menu_order',
						'order' => 'ASC',
						'post__not_in'			=> array(
							get_the_ID()
						),
					);

					$queryServicos = new WP_Query($arrayQueryServicos);

					while ( $queryServicos->have_posts()) {
						$queryServicos->the_post();
				?>
					<div class="wq-box_4 wq-box_cp-12 wq-box_cl-12 wq-box_tp-6 wq-box_tl-6">
						<a href="<?php the_permalink(); ?>" class="wq-servico_box">
							<figure>
								<?php
									$wsg_servico_item_icone_id = get_post_meta( get_the_ID(), 'wsg_servico_item_icone_id', true );
									getImageThumb($wsg_servico_item_icone_id,'100x100');
								?>
							</figure>
							<div>
								<h2><?php the_title(); ?></h2>
							</div>
						</a>
					</div>
				<?php } ?>
			</div>
		</div>
	</section>

<?php get_footer(); ?>