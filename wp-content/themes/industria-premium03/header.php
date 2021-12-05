<?php
	$id_logo = get_page_by_path( 'configuracoes-da-logo', OBJECT, 'gerais' )->ID;

	$id_email = get_page_by_path( 'email', OBJECT, 'contatos' )->ID;
	$id_telefones = get_page_by_path( 'telefones', OBJECT, 'contatos' )->ID;
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title><?php wp_title('|', true, 'right'); ?></title>

	<meta name="robots" content="noodp" />
	<meta http-equiv="Content-Language" content="pt-br">

	<?php
		$wsg_favicon_img_id = get_post_meta( $id_logo, 'wsg_favicon_img_id', true );
		if ($wsg_favicon_img_id !== NULL && strlen($wsg_favicon_img_id) > 0) {
			$wsg_favicon = wp_get_attachment_image_src($wsg_favicon_img_id);
			if ($wsg_favicon !== NULL && count($wsg_favicon) > 0) {
				?>
					<link rel="icon" href="<?php echo $wsg_favicon[0]; ?>" type="image/x-icon"/>
				<?php
			}
		}
	?>

	<link rel="stylesheet" type="text/css" href="<?php bloginfo('template_url'); ?>/css/webquantica-grid.css">
	<link rel="stylesheet" type="text/css" href="<?php bloginfo('template_url'); ?>/css/lity.min.css">
	<link rel="stylesheet" type="text/css" href="<?php bloginfo('template_url'); ?>/style.css">

	<?php if ( is_page('sobre-nos') ) { ?>
		<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/css/sobre-nos.css">

	<?php } elseif ( is_front_page() || is_home() || is_post_type_archive('produtos192') || is_tax( 'categorias_produtos' ) || is_singular('produtos192')  ) { ?>
		<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/css/produtos.css">

	<?php } elseif ( is_post_type_archive('servicos192') || is_singular('servicos192')  ) { ?>
		<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/css/produtos.css">
		<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/css/servicos.css">

	<?php } elseif ( is_page('contato') ) { ?>
		<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/css/contato.css">

	<?php } elseif ( is_page('blog') || is_category() || is_search() || is_tag() || is_date() ) { ?>
		<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/css/blog.css">

	<?php } elseif ( is_single() ) { ?>
		<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/css/blog.css">
	<?php } ?>

	<link rel="stylesheet" type="text/css" href="<?php bloginfo('template_url'); ?>/mobile.css">


	<script src="<?php bloginfo('template_url'); ?>/js/jquery.js"></script>
	<script src="<?php bloginfo('template_url'); ?>/js/webquantica-grid.js"></script>
	<script src="<?php bloginfo('template_url'); ?>/js/owl.carousel.min.js"></script>
	<script src="<?php bloginfo('template_url'); ?>/js/carousel.js"></script>
	<script src="<?php bloginfo('template_url'); ?>/js/lity.min.js"></script>
	<script src="<?php bloginfo('template_url'); ?>/js/efeitos.js"></script>

	<meta name="wq_url_theme" content="<?php bloginfo('template_url'); ?>/">
	<!-- -->
	<link rel="stylesheet" href="<?php bloginfo('template_url') ?>/js-template/sweetalert2/sweetalert2.min.css">
	<script src="<?php bloginfo('template_url') ?>/js-template/sweetalert2/sweetalert2.min.js"></script>
	<script src="<?php bloginfo('template_url') ?>/js-template/jquery.blockUI.js"></script>

	<script src="<?php bloginfo('template_url') ?>/js-template/jquery.maskedinput.min.js"></script>
	<script src="<?php bloginfo('template_url') ?>/js-template/script-template.js"></script>

	<!-- -->
	<script src='https://www.google.com/recaptcha/api.js?onload=onloadCallbackFormsRecaptcha&render=explicit' async defer></script>

	<?php wp_head(); ?>

	<?php
		$id_google = get_page_by_path( 'configuracoes-do-google', OBJECT, 'gerais' )->ID;

		echo get_post_meta( $id_google, 'pixel_de_conversao_facebook', true );
		echo get_post_meta( $id_google, 'code_webmaster_tools', true );
	?>
</head>
<body>
	<header class="wq-header wq-header_horizontal">
		<div class="wq-header_top">
			<div class="wq-container">
				<div class="wq-flex">
					<ul class="wq-contatos wq-lista-inline">
						<?php
							$wsg_emails = get_post_meta( $id_email, 'wsg_emails', true );
							foreach ( (array) $wsg_emails as $key => $email ) {
						?>
							<li>
								<a href="mailto:<?php echo $email; ?>" target="_blank">
									<span class="flaticon-mail-1"></span>
									<p>
										<span>Email:</span>
										<?php echo $email; ?>
									</p>
								</a>
							</li>
						<?php
								if (count($wsg_emails) > 1) {
									break;
								}
							}
						?>

						<?php
							$entries = get_post_meta( $id_telefones, 'wsg_telefone_items', true );

							foreach ( (array) $entries as $key => $entry ) {

								if ( isset( $entry['wsg_telefone_nmr'] ) ) {
									$wsg_telefone_nmr = $entry['wsg_telefone_nmr'];
								}
								if ( isset( $entry['wsg_telefone_link'] ) ) {
									$wsg_telefone_link = $entry['wsg_telefone_link'];
								}
								if ( isset( $entry['wsg_telefone_icone'] ) ) {
									$wsg_telefone_icone = $entry['wsg_telefone_icone'];
								}
						?>
							<li>
								<a href="<?php echo $wsg_telefone_link; ?>" target="_blank">
									<?php if ( $wsg_telefone_icone == "phone-1" ){ ?>
										<span class="flaticon-phone-1"></span>
										<p>
											<span>Telefone:</span>
									<?php } else { ?>
										<span class="flaticon-whatsapp-1"></span>
										<p>
											<span>Whatsapp:</span>
									<?php } ?>
										<?php echo $wsg_telefone_nmr; ?>
									</p>
								</a>
							</li>
						<?php } ?>
					</ul>
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
				</div>
			</div>
		</div>
		<div class="wq-header_bottom">
			<div class="wq-container">
				<div class="wq-flex">
					<a href="<?php bloginfo('url'); ?>/" class="wq-logo">
						<figure>
							<?php
								$wsg_logo_header_img_id = get_post_meta( $id_logo, 'wsg_logo_header_img_id', true );
								echo getImageThumb($wsg_logo_header_img_id, 'full');
							?>
						</figure>
					</a>
					<div class="wq-btn_menu">
						<hr>
						<hr>
						<hr>
					</div>
					<nav class="wq-menu_principal">
						<ul class="wq-lista-inline">
							<?php
								$menu_name = 'header-menu';
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
										echo '<li><a href="'.$navItem->url.'" class= "'.$navItem->classes[0].'" title="'.$navItem->title.'">'.$navItem->title.'</a>';
									}
									if ( $parent_id == $navItem->menu_item_parent ) {
										if ( !$submenu ): $submenu = true;
											echo "<ul>";
										endif;
							?>
								<li>
									<a href="<?php echo $navItem->url; ?>" class="<?php echo $navItem->classes[0]; ?>" title="<?php echo $navItem->title; ?>"><?php echo $navItem->title; ?></a>
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
							var $temFilho = $('.wq-menu_principal ul li').has( "ul" );
							$($temFilho).attr({
								class: "wq-drop",
								onclick: ""
							});
						</script>
					</nav>
				</div>
			</div>
		</div>
	</header>