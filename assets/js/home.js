$(window).resize(larg);

function larg(){
    var width = $(window).width();

    $('.titulo').text(width);
}



$(document).ready(function(){
	$('.slick-slider').slick({
		accessibility: true,
		arrows: true,
		rows: 4,
		infinite: false,
		appendArrows: $(".slick-arrows")

	});
});

// Inicializa o plugin de slide (produtos relativos)

$(document).ready(function(){
	$('.slick-slider-oferta').slick({
	  infinite: false,
	  slidesToShow: 2,
	  slidesToScroll: 1,
	  appendArrows: $(".slick-arrows-oferta"),
	  responsive: [
	    {
	      breakpoint: 1250,
	      settings: {
	        slidesToShow: 1,
	        slidesToScroll: 1
	      }
	    }
	  ]
	});

	$('.slick-slider-mais-vendidos-one').slick({
	  infinite: false,
	  slidesToShow: 5,
	  slidesToScroll: 1,
	  rows: 2,
	  appendArrows: $(".slick-arrows-mais-vendidos"),
	  responsive: [
	    {
	      breakpoint: 1200,
	      settings: {
	        slidesToShow: 3,
	        slidesToScroll: 1
	      }
	    },
	    {
	      breakpoint: 740,
	      settings: {
	        slidesToShow: 2,
	        slidesToScroll: 1
	      }
	    },
	    {
	      breakpoint: 560,
	      settings: {
	        slidesToShow: 1,
	        slidesToScroll: 1
	      }
	    }
	  ]
	});

	$('.slick-slider-novos-one').slick({
	  infinite: false,
	  slidesToShow: 5,
	  slidesToScroll: 1,
	  appendArrows: $(".slick-arrows-novos"),
	  responsive: [
	    {
	      breakpoint: 1200,
	      settings: {
	        slidesToShow: 3,
	        slidesToScroll: 1
	      }
	    },
	    {
	      breakpoint: 740,
	      settings: {
	        slidesToShow: 2,
	        slidesToScroll: 1
	      }
	    },
	    {
	      breakpoint: 560,
	      settings: {
	        slidesToShow: 1,
	        slidesToScroll: 1
	      }
	    }
	  ]
	});

	$('.slick-slider-vistos').slick({
	  infinite: false,
	  slidesToShow: 3,
	  slidesToScroll: 1,
	  appendArrows: $(".slick-arrows-vistos"),
	  responsive: [
	    {
	      breakpoint: 1200,
	      settings: {
	        slidesToShow: 2,
	        slidesToScroll: 1
	      }
	    },
	    {
	      breakpoint: 630,
	      settings: {
	        slidesToShow: 1,
	        slidesToScroll: 1
	      }
	    }
	  ]
	});

});



//** 		SECTION FOR ON CLICK

$('.categoria-one').on('click', function(){

	$(this).addClass('categoria-active');
	$('.categoria-two').removeClass('categoria-active');
	$('.categoria-three').removeClass('categoria-active');

	$('.mais-vendidos').find('.slick-active-mais-vendido').slick('unslick');

	$('.slick-slider-mais-vendidos-two').addClass('display-none').removeClass('slick-active-mais-vendido');
	$('.slick-slider-mais-vendidos-three').addClass('display-none').removeClass('slick-active-mais-vendido');

	$('.slick-slider-mais-vendidos-one').removeClass('display-none').addClass("slick-active-mais-vendido");

	$('.slick-slider-mais-vendidos-one').slick({
	  infinite: false,
	  slidesToShow: 5,
	  slidesToScroll: 1,
	  rows: 2,
	  appendArrows: $(".slick-arrows-mais-vendidos"),
	  responsive: [
	    {
	      breakpoint: 1200,
	      settings: {
	        slidesToShow: 3,
	        slidesToScroll: 1
	      }
	    },
	    {
	      breakpoint: 740,
	      settings: {
	        slidesToShow: 2,
	        slidesToScroll: 1
	      }
	    },
	    {
	      breakpoint: 560,
	      settings: {
	        slidesToShow: 1,
	        slidesToScroll: 1
	      }
	    }
	  ]
	});



});


$('.categoria-two').on('click', function(){

	$(this).addClass('categoria-active');
	$('.categoria-one').removeClass('categoria-active');
	$('.categoria-three').removeClass('categoria-active');

	$('.mais-vendidos').find('.slick-active-mais-vendido').slick('unslick');

	$('.slick-slider-mais-vendidos-one').addClass('display-none').removeClass('slick-active-mais-vendido');
	$('.slick-slider-mais-vendidos-three').addClass('display-none').removeClass('slick-active-mais-vendido');

	$('.slick-slider-mais-vendidos-two').removeClass('display-none').addClass("slick-active-mais-vendido");
	$('.slick-slider-mais-vendidos-two').slick({
	  infinite: false,
	  slidesToShow: 5,
	  slidesToScroll: 1,
	  rows: 2,
	  appendArrows: $(".slick-arrows-mais-vendidos"),
	  responsive: [
	    {
	      breakpoint: 1200,
	      settings: {
	        slidesToShow: 3,
	        slidesToScroll: 1
	      }
	    },
	    {
	      breakpoint: 740,
	      settings: {
	        slidesToShow: 2,
	        slidesToScroll: 1
	      }
	    },
	    {
	      breakpoint: 560,
	      settings: {
	        slidesToShow: 1,
	        slidesToScroll: 1
	      }
	    }
	  ]
	});

});

$('.categoria-three').on('click', function(){

	$(this).addClass('categoria-active');
	$('.categoria-one').removeClass('categoria-active');
	$('.categoria-two').removeClass('categoria-active');

	$('.mais-vendidos').find('.slick-active-mais-vendido').slick('unslick');

	$('.slick-slider-mais-vendidos-one').addClass('display-none').removeClass('slick-active-mais-vendido');
	$('.slick-slider-mais-vendidos-two').addClass('display-none').removeClass('slick-active-mais-vendido');

	$('.slick-slider-mais-vendidos-three').removeClass('display-none').addClass("slick-active-mais-vendido");;
	$('.slick-slider-mais-vendidos-three').slick({
	  infinite: false,
	  slidesToShow: 5,
	  slidesToScroll: 1,
	  rows: 2,
	  appendArrows: $(".slick-arrows-mais-vendidos"),
	  responsive: [
	    {
	      breakpoint: 1200,
	      settings: {
	        slidesToShow: 3,
	        slidesToScroll: 1
	      }
	    },
	    {
	      breakpoint: 740,
	      settings: {
	        slidesToShow: 2,
	        slidesToScroll: 1
	      }
	    },
	    {
	      breakpoint: 560,
	      settings: {
	        slidesToShow: 1,
	        slidesToScroll: 1
	      }
	    }
	  ]
	});

});



$('.categoria-novos-one').on('click', function(){

	$(this).addClass('categoria-novos-active');
	$('.categoria-novos-two').removeClass('categoria-novos-active');
	$('.categoria-novos-three').removeClass('categoria-novos-active');

	$('.novos-produtos').find('.slick-novos-active').slick('unslick');

	$('.slick-slider-novos-two').addClass('display-none').removeClass('slick-novos-active');
	$('.slick-slider-novos-three').addClass('display-none').removeClass('slick-novos-active');

	$('.slick-slider-novos-one').removeClass('display-none').addClass("slick-novos-active");

	$('.slick-slider-novos-one').slick({
	  infinite: false,
	  slidesToShow: 5,
	  slidesToScroll: 1,
	  appendArrows: $(".slick-arrows-novos"),
	  responsive: [
	    {
	      breakpoint: 1200,
	      settings: {
	        slidesToShow: 3,
	        slidesToScroll: 1
	      }
	    },
	    {
	      breakpoint: 740,
	      settings: {
	        slidesToShow: 2,
	        slidesToScroll: 1
	      }
	    },
	    {
	      breakpoint: 560,
	      settings: {
	        slidesToShow: 1,
	        slidesToScroll: 1
	      }
	    }
	  ]
	});



});


$('.categoria-novos-two').on('click', function(){

	$(this).addClass('categoria-novos-active');
	$('.categoria-novos-one').removeClass('categoria-novos-active');
	$('.categoria-novos-three').removeClass('categoria-novos-active');

	$('.novos-produtos').find('.slick-novos-active').slick('unslick');

	$('.slick-slider-novos-one').addClass('display-none').removeClass('slick-novos-active');
	$('.slick-slider-novos-three').addClass('display-none').removeClass('slick-novos-active');

	$('.slick-slider-novos-two').removeClass('display-none').addClass("slick-novos-active");

	$('.slick-slider-novos-two').slick({
	  infinite: false,
	  slidesToShow: 5,
	  slidesToScroll: 1,
	  appendArrows: $(".slick-arrows-novos"),
	  responsive: [
	    {
	      breakpoint: 1200,
	      settings: {
	        slidesToShow: 3,
	        slidesToScroll: 1
	      }
	    },
	    {
	      breakpoint: 740,
	      settings: {
	        slidesToShow: 2,
	        slidesToScroll: 1
	      }
	    },
	    {
	      breakpoint: 560,
	      settings: {
	        slidesToShow: 1,
	        slidesToScroll: 1
	      }
	    }
	  ]
	});



});

$('.categoria-novos-three').on('click', function(){

	$(this).addClass('categoria-novos-active');
	$('.categoria-novos-one').removeClass('categoria-novos-active');
	$('.categoria-novos-two').removeClass('categoria-novos-active');

	$('.novos-produtos').find('.slick-novos-active').slick('unslick');

	$('.slick-slider-novos-one').addClass('display-none').removeClass('slick-novos-active');
	$('.slick-slider-novos-two').addClass('display-none').removeClass('slick-novos-active');

	$('.slick-slider-novos-three').removeClass('display-none').addClass("slick-novos-active");

	$('.slick-slider-novos-three').slick({
	  infinite: false,
	  slidesToShow: 5,
	  slidesToScroll: 1,
	  appendArrows: $(".slick-arrows-novos"),
	  responsive: [
	    {
	      breakpoint: 1200,
	      settings: {
	        slidesToShow: 3,
	        slidesToScroll: 1
	      }
	    },
	    {
	      breakpoint: 740,
	      settings: {
	        slidesToShow: 2,
	        slidesToScroll: 1
	      }
	    },
	    {
	      breakpoint: 560,
	      settings: {
	        slidesToShow: 1,
	        slidesToScroll: 1
	      }
	    }
	  ]
	});



});



if(page == 'home'){
	setTimeout(function(){

	    $('.cd-dropdown-trigger').trigger('click');

	}, 1000);
}