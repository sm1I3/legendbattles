$(document).ready(function(){


/* Modal Show - by Ramon Costa Atualstudio */
	$("#backblack").css({ height: '100%', width: '100%', position: 'fixed', top: '0', left: '0', background: '#000', opacity: '0.8', zIndex: 10 });
	$("#galleryimgs a, .openmodal").click(function(){
	

if($(this).attr('class') == 'gvideo') {


	var mhe = $(window).height() - 60; 	var mwi = $(window).width() - 60; var mhe2 = mhe - 20;	var mwi2 = mwi - 20;
	$("#modal").css({ 'max-height': mhe+'px', 'max-width': mwi+'px' }); $("#modal .image").css({ 'max-height': mhe2+'px', 'max-width': mwi2+'px' });

	var modal_top_margin = parseInt(($(window).height() - 20)/2); // -20 do margin
	var modal_left_margin = parseInt(($(window).width() - 20)/2); // -20 do margin
	var margin_complete = modal_top_margin+"px 0px 0px "+modal_left_margin+"px";

	$("#modal").css({ margin: margin_complete });


// adicional de 60
if($(window).height() < 540 || $(window).width() < 913) {
	var video_w = '640';
	var video_h = '360';
} else {
	var video_w = '853';
	var video_h = '480';
}

$("#modal .image").html("<iframe width=\""+video_w+"\" height=\""+video_h+"\" src=\""+$(this).attr('href')+"&wmode=transparent\" frameborder=\"0\" allowfullscreen></iframe>");

	var tmargin = parseInt((($(window).height() - video_h) - 20)/2);
	var lmargin = parseInt((($(window).width() - video_w) - 20)/2);
$("#modal").css({ 'margin-top': tmargin+'px', 'margin-left': lmargin+'px' });

	$("#modal").fadeIn('fast');
	$("#backblack").fadeIn('fast');


} else {

	var image_title = $(this).attr('title');

	// Altera href para a nova imagem
	var new_image_href = $(this).attr('href');
	$('#imglarge').attr('src', ''+new_image_href+'');

	var mhe = $(window).height() - 60; // captura tamanho height da tela e diminui 60 (30 de padding)
	var mwi = $(window).width() - 60; // captura tamanho height da tela e diminui 60 (30 de padding)
	var mhe2 = mhe - 20; // retira 20px de height do campo da imagem e da propria imagem por causa do padding
	var mwi2 = mwi - 20; // retira 125px de width do campo da imagem e da propria imagem por causa do margin(20) + conteudo lateral(100)
	$("#modal").css({ 'max-height': mhe+'px', 'max-width': mwi+'px' });
	$("#modal .image, #imglarge").css({ 'max-height': mhe2+'px', 'max-width': mwi2+'px' });


/* calculando margem top e left para centralizar o modal com a tela de LOADING */
	var modal_top_margin = parseInt(($(window).height() - 20)/2); // -20 do margin
	var modal_left_margin = parseInt(($(window).width() - 20)/2); // -20 do margin
	var margin_complete = modal_top_margin+"px 0px 0px "+modal_left_margin+"px";

	$("#modal").css({ margin: margin_complete });

	$("#modal").fadeIn('fast');
	$("#backblack").fadeIn('fast');


	$("img#imglarge").load(function(){

// captura as dimensoes da imagem e guarda
	var imgw = $("img#imglarge").width();
	var imgh = $("img#imglarge").height();

// transforma em 100x100 para animacao posterior (so para corrigir possiveis bugs)
	$('img#imglarge').css({ width: '100px', height: '100px' });

if(imgw > mwi2 || imgh > mhe2) {

if(imgw > mwi2) {
	var difwi = mwi2; var difhe = 'auto';
} else {
	var difwi = 'auto'; var difhe = mhe2;
}

	$("img#imglarge").animate({ width: difwi, height: difhe }, 500, function(){
	var tmargin = parseInt((($(window).height() - $("img#imglarge").height()) - 20)/2);
	var lmargin = parseInt((($(window).width() - $("img#imglarge").width()) - 20)/2);
	});


} else {

	$("img#imglarge").animate({ width: imgw+'px', height: imgh+'px' });
	var tmargin = parseInt((($(window).height() - imgh) - 20)/2); // - 20 = padding | - 100 = menu do modal
	var lmargin = parseInt((($(window).width() - imgw) - 20)/2);


}

	$("#modal").animate({ 'margin-top': tmargin+'px', 'margin-left': lmargin+'px' }, 400);
	$("img#imglarge").show('100', function(){

	if(image_title) {
		$("#modal .image div").html(image_title);
		$("#modal .image div").css({ display: 'block' });
	}

	});
	});


}
	});






/* Clicar no background preto ou no X sumir Modal */
	$("#backblack, #modal #closemodal").click(function() {
		$('.atendimento').slideToggle('fast');
		$("#modal, #backblack").fadeOut('fast', function() {
		$("#modal .image").html("<img id='imglarge' src='' /><div class='sub'></div>");
	});
	});
	

});
