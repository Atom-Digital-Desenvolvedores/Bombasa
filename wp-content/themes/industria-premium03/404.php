<?php get_header(); ?>

	<section class="wq-404">
		<div class="wq-cto">
			<h1>Erro 404 - Página não encontrada.</h1>
			<a href="javascript:void(0)" class="wq-btn" onclick="goBack()">Voltar</a>
		</div>
	</section>

	<script>
		function goBack() {
			window.history.back();
		}
	</script>

<?php get_footer(); ?>