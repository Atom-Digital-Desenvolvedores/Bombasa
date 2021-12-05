/*
	COMPLETO
	<h3 class="numberincrement" data-decimal="0" data-initial="0" data-final="1240" data-duration="2000" data-delay="0" data-content-before="+" data-content-after="" data-reset-in-click="true">+1240</h3>
*/
/*
	MINIMO
	<h3 class="numberincrement" data-final="350" data-duration="2000">+350</h3>
*/
function Inc(obj) {
	var elem = obj.elem;
	var input = (elem.nodeName.toLowerCase() === 'input') ? true: false;
	var value = parseFloat(elem.getAttribute('data-final')) || 0;
	var duration = parseInt(elem.getAttribute('data-duration')) || 0;
	var delay = parseInt(elem.getAttribute('data-delay')) || 0;
	var decimal = parseInt(elem.getAttribute('data-decimal')) || 0;//((obj.decimal > 2) ? 2 : obj.decimal) || 0;
	var contentBefore = elem.getAttribute('data-content-before') || '';
	var contentAfter = elem.getAttribute('data-content-after') || '';
	var speed = ((obj.speed < 30) ? 30 : obj.speed) || 30;
	var count = parseFloat(elem.getAttribute('data-initial')) || 0;
	var increment = value / (duration / speed);
	var interval = null;
	var regex = /\B(?=(\d{3})+(?!\d))/g;

	var run = function() {
		count += increment;
		if (count < value) {
			if (decimal == 0) {
				(input) ? elem.value = contentBefore + (count).toFixed(decimal).toString() + contentAfter : elem.innerHTML = contentBefore + (count).toFixed(decimal).toString() + contentAfter;
			}else{
				(input) ? elem.value = contentBefore + (count).toFixed(decimal).toString().replace(regex, ',') + contentAfter : elem.innerHTML = contentBefore + (count).toFixed(decimal).toString().replace(regex, ',') + contentAfter;
			}
		} else {
			clearInterval(interval);
			if (decimal == 0) {
				(input) ? elem.value = contentBefore + (value).toFixed(decimal).toString() + contentAfter : elem.innerHTML = contentBefore + (value).toFixed(decimal).toString() + contentAfter;
			}else{
				(input) ? elem.value = contentBefore + (value).toFixed(decimal).toString().replace(regex, ',') + contentAfter : elem.innerHTML = contentBefore + (value).toFixed(decimal).toString().replace(regex, ',') + contentAfter;
			}
		}
	};

	setTimeout(function() {
		interval = setInterval(run.bind(this), speed);
	}.bind(this), delay);

	this.reset = function() {
		clearInterval(interval);
		value = parseFloat(elem.getAttribute('data-final')) || 0;
		duration = parseInt(elem.getAttribute('data-duration')) || 0;
		increment = value / (duration / speed);
		delay = parseInt(elem.getAttribute('data-delay')) || 0;
		count = parseFloat(elem.getAttribute('data-initial')) || 0;
		interval = setInterval(run, speed);
	}.bind(this);

	this.id_code_autoincrement = elem.getAttribute('data-id_code_autoincrement');
} // Inc