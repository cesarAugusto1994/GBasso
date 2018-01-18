// Aplica resets para layout responsivo nas divs do plugin de zoom ao redimensionar a tela
$(window).resize(function(){
	var width = $(window).width();

	if(width < 1024) {
		$(".zoomWindow").addClass('zoom-height-reset');
		$(".zoomWindow").addClass('zoom-width-reset');
		$(".zoomWrapper").addClass('zoom-width-reset');
		$(".zoomContainer").addClass('zoom-width-reset zoom-absolute-reset');
		
	} else{
		$(".zoomWindow").removeClass('zoom-height-reset');
		$(".zoomWindow").removeClass('zoom-width-reset');
		$(".zoomWrapper").removeClass('zoom-width-reset');
		$(".zoomContainer").removeClass('zoom-width-reset zoom-absolute-reset');
	} 

	$('.titulo').text(width);

	if(width < 580) {
		$("#gallery_01").addClass('display-none');
	} else{
		$("#gallery_01").removeClass('display-none');
	}

	var produtoWidth = $('.produto-imagem').width();

	$('.zoomContainer').width(produtoWidth);
	$('.zoomWrapper').width(produtoWidth);
	$('.zoomWindowContainer').width(produtoWidth);
	$('.zoomWindow').width(produtoWidth);
	
	
});


// Aplica resets para layout responsivo nas divs do plugin de zoom ao carregar a tela
$(window).load( function(){

	var width = $(window).width();

	if(width < 1024) {
		$(".zoomWindow").addClass('zoom-height-reset');
		$(".zoomWindow").addClass('zoom-width-reset');
		$(".zoomWrapper").addClass('zoom-width-reset');
		$(".zoomContainer").addClass('zoom-width-reset zoom-absolute-reset');
		
	} else{
		$(".zoomWindow").removeClass('zoom-height-reset');
		$(".zoomWindow").removeClass('zoom-width-reset');
		$(".zoomWrapper").removeClass('zoom-width-reset');
		$(".zoomContainer").removeClass('zoom-width-reset zoom-absolute-reset');
	} 

	$('.titulo').text(width);

	if(width < 580) {
		$("#gallery_01").addClass('display-none');
	} else{
		$("#gallery_01").removeClass('display-none');
	}

	var produtoWidth = $('.produto-imagem').width();

	$('.zoomContainer').width(produtoWidth);
	$('.zoomWrapper').width(produtoWidth);
	$('.zoomWindowContainer').width(produtoWidth);
	$('.zoomWindow').width(produtoWidth);

});

//initiate the plugin and pass the id of the div containing gallery images 

$("#img_01").elevateZoom({
	zoomType: "inner",
	cursor: "crosshair",
	zoomWindowFadeIn: 500,
	zoomWindowFadeOut: 750,
	gallery:'gallery_01',  
	galleryActiveClass: 'active', 
	imageCrossfade: true
}); 

//pass the images to Fancybox 

$("#img_01").bind("click", function(e) { 
	var ez = $('#img_01').data('elevateZoom');	

	$.fancybox(ez.getGalleryList()); 

	return false; 
});



// Inicializa o plugin de slide (produtos relativos)

$('.slick-slider').slick({
  infinite: false,
  slidesToShow: 4,
  slidesToScroll: 1,
  appendArrows: $(".slick-arrows-relativos"),
  responsive: [
    {
      breakpoint: 1000,
      settings: {
        slidesToShow: 2,
        slidesToScroll: 2
      }
    },
    {
      breakpoint: 480,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1
      }
    }
  ]
});

