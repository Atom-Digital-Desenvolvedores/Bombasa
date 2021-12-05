$(function(){

	// função para funcionar o botão do menu

	jQuery('.wq-btn_menu').click(function() {
		jQuery('.wq-menu_principal').toggleClass("aberto")
		jQuery('.wq-btn_menu').toggleClass("btn-fechar")
	})
	jQuery('li[class*="wq-drop"] span').click(function() {
		jQuery('li[class*="wq-drop"]').toggleClass("mobileDrop")
	})

	// função de funcionamento dos drop

	if (jQuery('li[class*="wq-drop"]').length) {
		jQuery('li[class*="wq-drop"] span').each(function(index, value){
			jQuery(value).click(function(){
				var drop = jQuery(this).data('drop');
				jQuery('li[class*="wq-drop"]').each(function(index2, value2){
					jQuery(value2).removeClass('mobileDrop');
				});
				jQuery('li.wq-dropdown[data-drop='+drop+']').toggleClass('mobileDrop');
				jQuery('li[class*="wq-drop"] span').each(function(index2, value2){
					jQuery(value2).removeClass('active');
				});
				jQuery(this).addClass('active');
			});
		});
	}

	// função de funcionamento das tabs

	if (jQuery('.wq-tabs_contents').length) {
		jQuery('.wq-tabs_btn').each(function(index, value){
			jQuery(value).click(function(){
				var tab = jQuery(this).data('tab');
				jQuery('.wq-tabs_contents > div').each(function(index2, value2){
					jQuery(value2).removeClass('ver');
				});
				jQuery('.wq-tabs_contents > div[data-tab='+tab+']').addClass('ver');
				jQuery('.wq-tabs_btn').each(function(index2, value2){
					jQuery(value2).removeClass('active');
				});
				jQuery(this).addClass('active');
			});
		});
		jQuery('.wq-tabs_btn:first-child').click();
	}

	// função de funcionamento de accordion

	if (jQuery('.wq-accordion').length) {
		jQuery('.wq-accordion').each(function(index, value){
			jQuery(value).click(function(){
				var accordion = jQuery(this).data('accordion');
				jQuery('.wq-accordion_content').each(function(index2, value2){
					jQuery(value2).removeClass('ver');
				});
				jQuery('.wq-accordion_content[data-accordion='+accordion+']').addClass('ver');
				jQuery('.wq-accordion').each(function(index2, value2){
					jQuery(value2).removeClass('active');
				});
				jQuery(this).addClass('active');
			});
		});
		jQuery('.wq-accordion:first-child').click();
	}

	// função de funcionamento de modal

	if (jQuery('.wq-modal').length) {
		jQuery('.wq-modal_btn').each(function(index, value){
			jQuery(value).click(function(){
				var item = jQuery(this).data('modal');
				jQuery('.wq-modal').each(function(index2, value2){
					jQuery(value2).removeClass('ver');
				});
				jQuery('.wq-modal[data-modal='+item+']').addClass('ver');
				jQuery('.wq-modal_btn').each(function(index2, value2){
					jQuery(value2).removeClass('active');
				});
				jQuery(this).addClass('active');
			});
		});
	}
	jQuery('.wq-modal_btn-fechar').click(function(){
		jQuery('.wq-modal').removeClass('ver')
	})


	// Função para filtrar items na wq-galeria

	jQuery('.wq-galeria_btn-todos').click(function(){
		jQuery('.wq-galeria_item').addClass('todos')
		jQuery('.wq-galeria_btn').removeClass('active')
		jQuery('.wq-galeria_btn-todos').addClass('active')
	})

	if (jQuery('.wq-galeria').length) {
		jQuery('.wq-galeria_btn').each(function(index, value){
			jQuery(value).click(function(){
				var item = jQuery(this).data('galeria');
				jQuery('.wq-galeria_item').each(function(index2, value2){
					jQuery(value2).removeClass('ver').removeClass('todos');
				});
				jQuery('.wq-galeria_item[data-galeria*='+item+']').addClass('ver');
				jQuery('.wq-galeria_btn').each(function(index2, value2){
					jQuery(value2).removeClass('active');
				});
				jQuery(this).addClass('active');
				jQuery('.wq-galeria_btn-todos').removeClass('active');
			});
		});
	}

	jQuery('.wq-galeria_btn-todos').click();

})