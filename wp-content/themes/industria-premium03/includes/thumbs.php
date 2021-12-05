<?php

	// tamanhos dinâmicos para thumbs
	function tamanhos_thumbs(){

		// Ativando suporte para imagem destacada
		add_theme_support('post-thumbnails');
		add_image_size( '1920x600', 1920, 600, true );
		add_image_size( '1920x480', 1920, 480, true );
		add_image_size( '1920x110', 1920, 110, true );
		add_image_size( '1000x820', 1000, 820, true );
		add_image_size( '750x400', 750, 400, true );
		add_image_size( '550x392', 550, 392, true );
		add_image_size( '530x334', 530, 334, true );
		add_image_size( '500x292', 500, 292, true );
		add_image_size( '360x290', 360, 290, true );
		add_image_size( '300x340', 300, 340, true );
		add_image_size( '300x300', 300, 300, true );
		add_image_size( '300x240', 300, 240, true );
		add_image_size( '280x330', 280, 330, true );
		add_image_size( '262x262', 262, 262, true );
		add_image_size( '262x212', 262, 212, true );
		add_image_size( '100x100', 100, 100, true );
		add_image_size( '64x64', 64, 64, true );
	}
	add_action('after_setup_theme', 'tamanhos_thumbs');

?>