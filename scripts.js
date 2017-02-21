/* global $ */
$.jCanvas.defaults.fromCenter = false;

if (window.location.protocol == 'file:' && window.navigator.vendor == "Google Inc.") {
	$('#offline_warning').show();
	$('select[name=type] option[value=menuhax]', "#settings").attr('disabled', 'disabled');
}

function write(x, y, text, color = 'gray') {
	var letter = text.substr(0,1);
	
	if (letter == '_') {
		text = text.substr(1);
		letter = text.substr(0,1);
		if (color == 'gray') color = 'white';
		else if (color == 'white') color = 'gray';
	}

	$('#topscreen').drawText({
		fillStyle: color,
		x: x+2, y: y,
		fontSize: 16,
		fontFamily: 'PerfectDOSVGA437Win',
		align: 'left',
		text: letter
	});
	
	text = text.substr(1);
	if (text != '')
		write(x+8, y, text, color);
}

$("#settings input, #settings select").on('change', function() {
	var $topscreen = $('#topscreen');
	
	var model = $('input[name=model]:checked', "#settings").val();
	var region = $('select[name=region] option:selected', "#settings").val();
	var sd = $('select[name=sd] option:selected', "#settings").val();
	var type = $('select[name=type] option:selected', "#settings").val();
	
	var line1 = $('select[name=type] option:selected', "#settings").text();
	var line2 = ''; var processor = 0; var use_bootinput = false; var use_auxinput = false;

	if ($('select[name=boottool] option:selected', "#settings").val() == 'custom') {
		$('input[name=boottool]', "#settings").show();
		$('select[name=boottool]', "#settings").hide();
		use_bootinput = true;
	}
	
	if ($('select[name=secondTool] option:selected', "#settings").val() == 'custom') {
		$('input[name=secondTool]', "#settings").show();
		$('select[name=secondTool]', "#settings").hide();
		use_auxinput = true;
	}

	switch(type) {
		case 'luma':
			$topscreen.attr('width', 400);
			line2 = 'Copyright(C) 2017, AuroraWright';
			if ($('input[name=energyLuma]', "#settings").is(':disabled'))
				$('input[name=energyLuma]', "#settings").prop('disabled', false);
			break;
		case 'menuhax':
			$topscreen.attr('width', 800);
			line2 = 'Copyright(C) 2015, yellow8';
			if ($('input[name=energyLuma]', "#settings").is(':checked'))
				$('input[name=energyLuma]', "#settings").prop('checked', false).prop('disabled', true);
			break;
	}

	$topscreen.clearCanvas().drawRect({
		fillStyle: 'black',
		x: 0, y: 0,
		width: 400,
		height: 240
	}).drawImage({
		source: 'images/symbols.png',
		x: 1, y: 16,
		sWidth: 21,
		sHeight: 29,
		sx: 40, sy: 10
	});
	
	if ($('input[name=energyLuma]', "#settings").is(':checked')) {
		$topscreen.drawImage({
			source: 'images/symbols.png',
			x: 266, y: 16,
			sWidth: 133,
			sHeight: 84,
			sx: 0, sy: 84
		})
	} else {
		$topscreen.drawImage({
			source: 'images/symbols.png',
			x: 266, y: 16,
			sWidth: 133,
			sHeight: 84,
			sx: 0, sy: 0
		}).drawRect({
			fillStyle: 'black',
			x: 306, y: 26,
			width: 21,
			height: 29
		});
	}

	write(24, 16*1, line1);
	write(24, 16*2, line2);

	switch(model) {
		case '3DS':
			write(0, 16*5, 'Nintendo 3DS CTR-001('+region+')');
			processor = 2; sd += ' SD'
			break;
		case '3DSXL':
			if (region == 'JPN')
				write(0, 16*5, 'Nintendo 3DS LL SPR-001('+region+')');
			else
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
			if (region == 'JPN')
				write(0, 16*5, 'New Nintendo 3DS LL RED-001('+region+')');
			else
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

	write(0, 16*9,  'Detecting Primary Master ... '+ processor/2 +'G Internal Memory');
	write(0, 16*10, 'Detecting Primary Slave  ... '+ sd +' Card');
	
	if (!use_bootinput)
		$('input[name=boottool]', "#settings").val($('select[name=boottool] option:selected', "#settings").text());
		
	if (!use_auxinput)
		$('input[name=secondTool]', "#settings").val($('select[name=secondTool] option:selected', "#settings").text());
	
	var boot_bool = $('input[name=hold]', "#settings").is(':checked');
	var boot_keys = $('select[name=onboot] option:selected', "#settings").val();
	var boot_tool = $('input[name=boottool]', "#settings").val();
	var boot_text = '_Hold ' + boot_keys + ' '+ $('select[name=firstTime] option:selected').text() +'_ to enter _' + boot_tool + '_.';

	var aux_bool = $('input[name=secondLine]', "#settings").is(':checked');
	var aux_keys = $('select[name=secondButton] option:selected').val();
	var aux_tool = $('input[name=secondTool]').val();
	var aux_text = '_Hold ' + aux_keys + ' '+ $('select[name=secondTime] option:selected').text() +'_ to enter _' + aux_tool + '_.';
	
	if (boot_bool && !aux_bool)
		write(0, 16*14, boot_text);
	else if (boot_bool)
		write(0, 16*13, boot_text);
	
	if (aux_bool)
		write(0, 16*14, aux_text);

	if ($topscreen.width() == 800) {
		$topscreen.drawImage({
			source: $topscreen.getCanvasImage(),
			x: 400, y: 0
		});
	}

});

$(document).ready(function() {
	
	$('canvas').drawImage({
		source: 'images/symbols.png',
		x: 0, y: 0,
		load: function() {
			$("select[name=region]", "#settings").trigger('change');
			if ($('#offline_warning').is(':hidden'))
				$('#downloadPNG, #downloadBIN').removeClass('disabled');
		}
	});
	
});

$('input[name=boottool]', "#settings").keyup(function() { $("#settings input").trigger('change'); });
$('input[name=auxtool]', "#settings").keyup(function() { $("#settings input").trigger('change'); });


/* Create a PNG downloadable of the canvas */
/* global download */
$('#downloadPNG').click(function() {
	if (!$(this).hasClass('disabled')) {
		var filename = ($('#topscreen').width() == 400) ? 'splash.png' : 'imagedisplay.png';
		var filedata = $('#topscreen').getCanvasImage();
		download(filedata, filename, "image/png");
	}
});

$('#downloadBIN').click(function() {
	if (!$(this).hasClass('disabled')) {
		var filename = ($('#topscreen').width() == 400) ? 'splash.bin' : 'menuhax_imagedisplay.bin';
		
		var width = $('#topscreen').height();
		var height = $('#topscreen').width();
		
		var $canvas = $('<canvas/>').css({ position: 'absolute', top: 0, left: -1*width }).appendTo('body');
		$canvas.attr('width', width).attr('height', height);

		$canvas.drawImage({
			source: $('#topscreen').getCanvasImage(),
			x: width/2, y: height/2,
			fromCenter: true,
			rotate: 90
		});

		var canvasdata = $canvas.get(0).getContext('2d').getImageData(0, 0, width, height).data;
		var filedata = '';
		
		for(var i = 0; i < canvasdata.length; i += 4)
			filedata += String.fromCharCode(canvasdata[i+2], canvasdata[i+1], canvasdata[i]);

		$canvas.remove();
		download('data:application/octet-stream;base64,' + window.btoa(filedata), filename);
	}
});