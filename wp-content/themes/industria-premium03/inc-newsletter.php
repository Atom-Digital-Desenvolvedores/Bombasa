<?php
	get_header();

	$id_home = get_page_by_path( 'home', OBJECT, 'page' )->ID;
	$id_contato = get_page_by_path( 'contato', OBJECT, 'page' )->ID;

	$wsg_contato_widget = get_post_meta($id_contato, 'wsg_contato_widget', true);
?>

	<section class="wq-newsletter">
		<div class="wq-container">
			<div class="wq-flex">
				<div class="wq-box_3 wq-box_cp-12 wq-box_cl-12">
					<h3 class="wq-titulo_1"><?php echo get_post_meta( $id_home, 'wsg_newsletter_titulo', true ); ?></h3>
					<p><?php echo get_post_meta( $id_home, 'wsg_newsletter_subtitulo', true ); ?></p>
				</div>
				<div class="wq-box_9 wq-box_cp-12 wq-box_cl-12">
					<form action="#" onsubmit="return submitFormWithRecaptcha(this);" class="contact-form" method="POST">

						<input type="hidden" name="subject_email" value="Enviado pelo site">
						<input required type="hidden" name="title_email" value="Contato enviado pelo formulário de newsletter">

						<input type="hidden" name="label-send-data-name" value="Nome">
						<input required type="text" name="send-data-name" placeholder="Qual é o seu nome?">

						<input type="hidden" name="label-send-data-email" value="Email">
						<input required type="email" name="send-data-email" placeholder="Qual é o seu melhor email?">

						<?php if (strlen($wsg_contato_widget) > 0) { ?>
							<div class="g-recaptcha invisible-recaptcha" id="recaptcha-<?php echo md5(uniqid(rand(), true)); ?>" data-sitekey="<?php echo $wsg_contato_widget; ?>" data-size="invisible"></div>
						<?php } ?>

						<button class="wq-btn wq-btn_azul" type="submit">Enviar</button>
					</form>
				</div>
			</div>
		</div>
	</section>