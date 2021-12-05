<?php
function page_login_logo() {

	$idTelaDeLogin = get_page_by_path( 'slug-tela-de-login', OBJECT, 'adminpanel' )->ID;

	/* Configuração de fundo da página */
	$color_background_colorpicker = get_post_meta($idTelaDeLogin, 'color_background_colorpicker', true);
	$color_font_background_colorpicker = get_post_meta($idTelaDeLogin, 'color_font_background_colorpicker', true);

	/* Configuração das informações da agência */
	$image_dataagency_background_colorpicker_id = get_post_meta($idTelaDeLogin, 'image_dataagency_background_colorpicker_id', true);
	$color_font_dataagency_background_colorpicker = get_post_meta($idTelaDeLogin, 'color_font_dataagency_background_colorpicker', true);

	$logoAgency = wp_get_attachment_image_src($image_dataagency_background_colorpicker_id, 'img-logo-agency-login');
	$image_dataagency_background_colorpicker = $logoAgency[0];

	// img-logo-agency-login

	/* Configuração do box de login */
	$color_background_box_colorpicker = get_post_meta($idTelaDeLogin, 'color_background_box_colorpicker', true);
	$color_font_box_colorpicker = get_post_meta($idTelaDeLogin, 'color_font_box_colorpicker', true);
	$color_background_btn_box_colorpicker = get_post_meta($idTelaDeLogin, 'color_background_btn_box_colorpicker', true);
	$color_font_btn_box_colorpicker = get_post_meta($idTelaDeLogin, 'color_font_btn_box_colorpicker', true);

	?>
	<style type="text/css">
		html, body{
			<?php
				if ($color_background_colorpicker !== NULL && strlen($color_background_colorpicker) > 0) {
					?>
						background-color: <?php echo $color_background_colorpicker; ?> !important;
					<?php
				}else{
					?>
						letter-spacing: 0.025em;
						background-color: #f9f9f9 !important;
					<?php
				}
			?>
		}
		body.login div#login h1 a {
			<?php
				if ($image_dataagency_background_colorpicker !== NULL && strlen($image_dataagency_background_colorpicker) > 0) {
					?>
						background-image: url(<?php echo $image_dataagency_background_colorpicker; ?>);
					<?php
				}else{
					?>
						background-image: url(<?php echo get_stylesheet_directory_uri(); ?>/includes/defaults/login/img/atom-logo.png);
					<?php
				}
			?>
			width: 210px;
			height: 210px;
			background-size: contain;
			background-position: center;
		}

		.login form{
			box-shadow: 0 10px 20px -7px rgba(0,0,0,.3);
		}

		#loginform label{
			color: #000;
		}

		#login p#nav a, #login p#backtoblog a{
			<?php
				if ($color_font_background_colorpicker !== NULL && strlen($color_font_background_colorpicker) > 0) {
					?>
						color: <?php echo $color_font_background_colorpicker; ?>;
					<?php
				}else{
					?>
						color: #444;
					<?php
				}
			?>
		}

		form {
			<?php
				if ($color_background_box_colorpicker !== NULL && strlen($color_background_box_colorpicker) > 0) {
					?>
						background-color: <?php echo $color_background_box_colorpicker; ?> !important;
					<?php
				}else{
					?>
						background-color: #fff !important;
					<?php
				}
			?>
		}

		form label{
			<?php
				if ($color_font_box_colorpicker !== NULL && strlen($color_font_box_colorpicker) > 0) {
					?>
						color: <?php echo $color_font_box_colorpicker; ?> !important;
					<?php
				}else{
					?>
						color: #444 !important;
					<?php
				}
			?>
		}


		#wp-submit{
			<?php
				if ($color_background_btn_box_colorpicker !== NULL && strlen($color_background_btn_box_colorpicker) > 0) {
					?>
						background-color: <?php echo $color_background_btn_box_colorpicker; ?> !important;
					<?php
				}else{
					?>
						border-radius: 0px;
						background-color: #461d7c !important;
					<?php
				}
			?>
			<?php
				if ($color_font_btn_box_colorpicker !== NULL && strlen($color_font_btn_box_colorpicker) > 0) {
					?>
						color: <?php echo $color_font_btn_box_colorpicker; ?> !important;
					<?php
				}else{
					?>
						color: #fff !important;
					<?php
				}
			?>
			border-color: transparent;
			box-shadow: none;
			text-shadow: none;
		}

		.info-harpia span{
			display: block;
			text-align: center;
			margin-bottom: 10px;
			<?php
				if ($color_font_dataagency_background_colorpicker !== NULL && strlen($color_font_dataagency_background_colorpicker) > 0) {
					?>
						color: <?php echo $color_font_dataagency_background_colorpicker; ?>;
					<?php
				}else{
					?>
						color: #ffcc00;
					<?php
				}
			?>
			font-size: 20px;
			font-weight: 700;
		}

		.info-harpia a{
			display: inline-block;
			margin:0 auto 20px;
		}
		.rede-sociais{
			text-align: center;
		}
		<?php
			$entries = get_post_meta( $idTelaDeLogin, 'cmbNetWorkTelaDeLoginItens', true );
			$positionIcons = 0;
			foreach ( (array) $entries as $key => $entry ) {
				$positionIcons++;
				$title_socialnetwork = NULL;
				if ( isset( $entry['title_socialnetwork'] ) ) {
					$title_socialnetwork = $entry['title_socialnetwork'];
				}
				$url_socialnetwork = NULL;
				if ( isset( $entry['url_socialnetwork'] ) ) {
					$url_socialnetwork = $entry['url_socialnetwork'];
				}

				$image_socialnetwork_id = $entry['image_socialnetwork_id'];
				$logoAgency = wp_get_attachment_image_src($image_socialnetwork_id, 'img-login-agency-icon-socialnetwork');
				$image_socialnetwork = $logoAgency[0];

				?>
					.rede-sociais a:nth-child(<?php echo $positionIcons; ?>){
						text-indent: -99999px;
						background: url(<?php echo $image_socialnetwork; ?>) no-repeat;
						height: 40px;
						width: 40px;
					}
				<?php
			}
		?>
	</style>
<?php }
	add_action( 'login_enqueue_scripts', 'page_login_logo' );

	function page_login_logo_url() {
		return 'http://www.harpiapropaganda.com.br';
	}
	add_filter( 'login_headerurl', 'page_login_logo_url' );

	function page_login_logo_title() {
		return 'Harpia Propaganda - Agência digital';
	}
	add_filter( 'login_headertitle', 'page_login_logo_title' );

	function page_login_content_description() {
		$idTelaDeLogin = get_page_by_path( 'slug-tela-de-login', OBJECT, 'adminpanel' )->ID;
		?>
			<div class="info-harpia">
				<span><?php echo get_post_meta( $idTelaDeLogin, 'line1_info_dataagency', true ); ?></span>
				<span><?php echo get_post_meta( $idTelaDeLogin, 'line2_info_dataagency', true ); ?></span>
				<div class="rede-sociais">
					<?php
						$entries = get_post_meta( $idTelaDeLogin, 'cmbNetWorkTelaDeLoginItens', true );

						foreach ( (array) $entries as $key => $entry ) {
							$title_socialnetwork = NULL;
							if ( isset( $entry['title_socialnetwork'] ) ) {
								$title_socialnetwork = $entry['title_socialnetwork'];
							}
							$url_socialnetwork = NULL;
							if ( isset( $entry['url_socialnetwork'] ) ) {
								$url_socialnetwork = $entry['url_socialnetwork'];
							}
							?>
								<a title="<?php echo $title_socialnetwork; ?>" href="<?php echo $url_socialnetwork; ?>" target="_blank"><?php echo $title_socialnetwork; ?></a>
							<?php
						}
					?>
				</div>
			</div>
		<?php
	}
	add_filter( 'login_message', 'page_login_content_description' );

?>