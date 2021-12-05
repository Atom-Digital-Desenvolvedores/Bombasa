<?php
	get_header();

	$id_page = get_page_by_path( 'suporte-tecnico', OBJECT, 'page' )->ID;

	$id_contato = get_page_by_path( 'contato', OBJECT, 'page' )->ID;
	$wsg_contato_widget = get_post_meta($id_contato, 'wsg_contato_widget', true);

	$id_telefones = get_page_by_path( 'telefones', OBJECT, 'contatos' )->ID;
?>

	<?php include "inc-breadcrumbs.php"; ?>

	<section class="wq-produtos_01">
		<div class="wq-container">
			<div class="wq-flex">
				<?php include "inc-sidebar.php"; ?>
				<div class="wq-box_9 wq-box_cp-12 wq-box_cl-12">
					<div class="wq-produto_interna">
						<div class="wq-flex">
							<div class="wq-box_7 wq-box_cp-12 wq-box_cl-12 wq-box_tp-12">
								<div class="wq-produto_interna-conteudo">
									<figure>
										<?php
											$wsg_suporte_01_img_id = get_post_meta( $id_page, 'wsg_suporte_01_img_id', true );
											getImageThumb($wsg_suporte_01_img_id,'500x292');
										?>
									</figure>
									<h2><?php echo get_post_meta( $id_page, 'wsg_suporte_01_titulo', true ); ?></h2>
									<?php echo wpautop(get_post_meta( $id_page, 'wsg_suporte_01_texto', true )); ?>
								</div>
							</div>
							<div class="wq-box_5 wq-box_cp-12 wq-box_cl-12 wq-box_tp-12">
								<div class="wq-suprimentos_section__form">
									<h3><?php echo get_post_meta( $id_page, 'wsg_suporte_01_form_titulo', true ); ?></h3>
									<?php echo wpautop(get_post_meta( $id_page, 'wsg_suporte_01_form_texto', true )); ?>
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
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

<?php get_footer(); ?>