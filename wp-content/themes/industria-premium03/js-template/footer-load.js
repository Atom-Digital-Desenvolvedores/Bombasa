loadScript(wq_url_theme+"/js-template/auto.increment.number.to.js", function(){
	var elems = [
		document.querySelector('li:nth-of-type(1) span'),
		document.querySelector('li:nth-of-type(2) span'),
		document.querySelector('li:nth-of-type(3) input')
	];
	objsIncrement = [];
	var element_numberincrement = document.getElementsByClassName('numberincrement');
	for (var i = 0; i < element_numberincrement.length; ++i) {
		var currentElement = element_numberincrement[i];
		var id_code_autoincrement = MD5(new Date().getTime().toString());
		currentElement.setAttribute('data-id_code_autoincrement', id_code_autoincrement);
		objsIncrement.push(
			new Inc({
				elem: currentElement,
				speed: 1
			})
		);
		if (currentElement.getAttribute('data-reset-in-click')) {
			currentElement.addEventListener('click', function(event) {
				var targetElement = event.target || event.srcElement;
				var id_code_autoincrement = targetElement.getAttribute('data-id_code_autoincrement')
				var resultObj = objsIncrement.filter(function( obj ) {
					return obj.id_code_autoincrement == id_code_autoincrement;
				});
				resultObj[0].reset();
			});
		}
	}
});