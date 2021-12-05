<?php

	function iconesAdmin(){
		$screen_redes_sociais = get_current_screen();

		//If not on the screen with ID 'edit-post' abort.
		if($screen_redes_sociais->id !='redes_sociais' ){
			return;
		}
		$listaIcones = "
			<div class=\"wsg-info listaIcones\">
				<h2 class=\"hndle ui-sortable-handle\"><span>Lista de ícones</span></h2>
				<ul>
					<li>
						<span class=\"flaticon-youtube-1\"></span>
						<input type=\"text\" readonly value=\"youtube-1\">
					</li>
					<li>
						<span class=\"flaticon-youtube-2\"></span>
						<input type=\"text\" readonly value=\"youtube-2\">
					</li>
					<li>
						<span class=\"flaticon-twitter-1\"></span>
						<input type=\"text\" readonly value=\"twitter-1\">
					</li>
					<li>
						<span class=\"flaticon-twitter-2\"></span>
						<input type=\"text\" readonly value=\"twitter-2\">
					</li>
					<li>
						<span class=\"flaticon-linkedin-1\"></span>
						<input type=\"text\" readonly value=\"linkedin-1\">
					</li>
					<li>
						<span class=\"flaticon-linkedin-2\"></span>
						<input type=\"text\" readonly value=\"linkedin-2\">
					</li>
					<li>
						<span class=\"flaticon-google-plus-1\"></span>
						<input type=\"text\" readonly value=\"google-plus-1\">
					</li>
					<li>
						<span class=\"flaticon-google-plus-2\"></span>
						<input type=\"text\" readonly value=\"google-plus-2\">
					</li>
					<li>
						<span class=\"flaticon-facebook-1\"></span>
						<input type=\"text\" readonly value=\"facebook-1\">
					</li>
					<li>
						<span class=\"flaticon-facebook-2\"></span>
						<input type=\"text\" readonly value=\"facebook-2\">
					</li>
					<li>
						<span class=\"flaticon-instagram-1\"></span>
						<input type=\"text\" readonly value=\"instagram-1\">
					</li>
					<li>
						<span class=\"flaticon-instagram-2\"></span>
						<input type=\"text\" readonly value=\"instagram-2\">
					</li>
					<li>
						<span class=\"flaticon-whatsapp-1\"></span>
						<input type=\"text\" readonly value=\"whatsapp-1\">
					</li>
					<li>
						<span class=\"flaticon-whatsapp-2\"></span>
						<input type=\"text\" readonly value=\"whatsapp-2\">
					</li>
					<li>
						<span class=\"flaticon-whatsapp-3\"></span>
						<input type=\"text\" readonly value=\"whatsapp-3\">
					</li>
					<li>
						<span class=\"flaticon-vimeo-1\"></span>
						<input type=\"text\" readonly value=\"vimeo-1\">
					</li>
					<li>
						<span class=\"flaticon-vimeo-2\"></span>
						<input type=\"text\" readonly value=\"vimeo-2\">
					</li>
					<!-- ícones genéricos -->
					<li>
						<span class=\"flaticon-cellphone-1\"></span>
						<input type=\"text\" readonly value=\"cellphone-1\">
					</li>
					<li>
						<span class=\"flaticon-cellphone-2\"></span>
						<input type=\"text\" readonly value=\"cellphone-2\">
					</li>
					<li>
						<span class=\"flaticon-phone-1\"></span>
						<input type=\"text\" readonly value=\"phone-1\">
					</li>
					<li>
						<span class=\"flaticon-phone-2\"></span>
						<input type=\"text\" readonly value=\"phone-2\">
					</li>
					<li>
						<span class=\"flaticon-mail-1\"></span>
						<input type=\"text\" readonly value=\"mail-1\">
					</li>
					<li>
						<span class=\"flaticon-mail-2\"></span>
						<input type=\"text\" readonly value=\"mail-2\">
					</li>
				</ul>
			</div>
		";

		echo $listaIcones;

		echo "
			<link rel=\"stylesheet\" href=\"".get_bloginfo('template_url')."/icons/flaticon.css\">
			<style>
				.listaIcones{
					display: none;
					border: 1px solid #e5e5e5;
					background: #fff;
					box-shadow: 0 1px 1px rgba(0,0,0,.04);
				}
				.listaIcones ul{
					padding: 12px;
					display: flex;
					flex-wrap: wrap;
					border-top: 1px solid #e5e5e5;
				}
				.listaIcones li{
					width: calc(33.33333333% - 5px);
					padding: 5px 5px;
					margin: 0 2.5px;
					border-bottom: 1px solid #e5e5e5;
				}
				.listaIcones li input{
					width: 120px;
    				font-size: 14px;
    				padding: 5px;
					border: 1px solid #ddd;
					background-color: #fff;
					color: #32373c;
					outline: 0;
					margin-left: 5px;
					transition: 50ms border-color ease-in-out;
					box-shadow: inset 0 1px 2px rgba(0,0,0,.07);
				}
			</style>
		";
	?>
<script type="text/javascript">
	jQuery( document ).ready(function() {
		jQuery('.listaIcones').css("display","block").insertAfter('#redes_sociais')
	});
</script>
<?php
	}
	add_action( 'admin_notices', 'iconesAdmin' );
?>