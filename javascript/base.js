/* global $ */
$.jCanvas.defaults.fromCenter = false;

function write(x, y, text) {
	var letter = text.substr(0,1);
	$('canvas').drawText({
		fillStyle: '#828282',
		x: x, y: y,
		fontSize: 16,
		fontFamily: 'PerfectDOSVGA437Win',
		align: 'left',
		text: letter
	});
	
	text = text.substr(1);
	if (text != '')
		write(x+8, y, text);
}

$("#settings input, #settings select").on('change', function() {
	
	var model = $('input[name=model]:checked', "#settings").val();
	var region = $('select[name=region] option:selected', "#settings").val();
	var sd = $('select[name=sd] option:selected', "#settings").val();
	var type = $('select[name=type] option:selected', "#settings").val();
	var line1 = $('select[name=type] option:selected', "#settings").text();
	var line2 = ''; var processor = 0;

	switch(type) {
		case 'luma':
			$('canvas').attr('width', 400);
			line2 = 'Copyrigth(C) 2016, AuroraWright';
			break;
		case 'menuhax':
			$('canvas').attr('width', 800);
			line2 = 'Copyrigth(C) 2015, yellow8';
			break;
	}

	$('canvas').clearCanvas().drawRect({
		fillStyle: '#000',
		x: 0, y: 0,
		width: 400,
		height: 240
	}).drawImage({
		source: 'images/symbols.png',
		x: 0, y: 16,
		sWidth: 21,
		sHeight: 29,
		sx: 0, sy: 16
	}).drawImage({
		source: 'images/symbols.png',
		x: 265, y: 16,
		sWidth: 135,
		sHeight: 84,
		sx: 265, sy: 16
	});

	write(24, 16*1, line1);
	write(24, 16*2, line2);

	switch(model) {
		case '3DS':
			write(0, 16*5, 'Nintendo 3DS CTR-001('+region+')');
			processor = 2; sd += ' SD'			
			break;
		case '3DSXL':
			write(0, 16*5, 'Nintendo 3DS XL SPR-001('+region+')');
			processor = 2; sd += ' SD'
			break;
		case '2DS':
			write(0, 16*5, 'Nintendo 2DS FTR-001('+region+')');
			processor = 2; sd += ' SD'
			break;
		case 'n3DS':
			write(0, 16*5, 'New Nintendo 3DS KTR-001('+region+')');
			processor = 4; sd += ' microSD'
			break;
		case 'n3DSXL':
			write(0, 16*5, 'New Nintendo 3DS XL RED-001('+region+')');
			processor = 4; sd += ' microSD'
			break;
	}

	switch(processor) {
		case 2:
			write(0, 16*7, 'Main Processor       : Dual-core ARM11 MPCore');
			write(0, 16*8, 'Memory Testing       : 131072K OK');
			break;
		case 4:
			write(0, 16*7, 'Main Processor       : Quad-core ARM11 MPCore');
			write(0, 16*8, 'Memory Testing       : 262144K OK');
			break;
	}

	write(0, 16*10, 'Detecting Primary Master ... 2G Internal Memory');
	write(0, 16*11, 'Detecting Primary Slave  ... '+sd+' Card');

	if ($('canvas').width() == 800) {
		var img = new Image();
		img.src = $('canvas').getCanvasImage();

		console.log(img.src);

		$('canvas').drawImage({
			source: img,
			x: 400, y: 0
		});
	}

});