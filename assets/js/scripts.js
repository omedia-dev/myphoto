/*
Author       : Syed Ekram.
Template Name: Monali - Responsive HTML5 Template
Version      : 1.0
*/
(function($) {
	'use strict';
	
	jQuery(document).on('ready', function(){
	
		/*PRELOADER JS*/
		$(window).on('load', function() { 
			$('.status').fadeOut();
			$('.preloader').delay(350).fadeOut('slow'); 
		}); 
		/*END PRELOADER JS*/

		/*START MENU JS*/
			$('a.page-scroll').on('click', function(e){
				var anchor = $(this);
				$('html, body').stop().animate({
					scrollTop: $(anchor.attr('href')).offset().top - 50
				}, 1500);
				e.preventDefault();
			});		

			$(window).on('scroll', function() {
				//не надо чтобы на странице конструктора этот скрипт отрабатывался
			  if ($(this).scrollTop() > 100 && $('#photoUploader').length < 1) {
				$('.menu-top').addClass('menu-shrink');
			  } else {
				$('.menu-top').removeClass('menu-shrink');
			  }
			});
			
			$(document).on('click','.navbar-collapse.in',function(e) {
			if( $(e.target).is('a') && $(e.target).attr('class') != 'dropdown-toggle' ) {
				$(this).collapse('hide');
			}
			});				
		/*END MENU JS*/ 

		/*START SLIDER JS*/
			$('.carousel').carousel({
				interval:8000,
				pause:'false',
			});
		/*END SLIDER JS*/
		
		/*START PARTNER LOGO*/
		$('.partner').owlCarousel({
		  autoPlay: 3000, //Set AutoPlay to 3 seconds
		  items : 4,
		  itemsDesktop : [1199,3],
		  itemsDesktopSmall : [979,3]
		});
		/*END PARTNER LOGO*/	
		
		/*START LIGHTBOX JS*/
			$('.lightbox').venobox({
				numeratio: true,
				infinigall: true
			});	
		/*END LIGHTBOX JS*/
		
		/*START CONTACT MAP JS*/
		function initialize() {
		  var mapOptions = {
			zoom: 15,
			scrollwheel: false,
			center: new google.maps.LatLng(40.7127837, -74.00594130000002)
		  };
		  var map = new google.maps.Map(document.getElementById('map'),
			  mapOptions);
		  var marker = new google.maps.Marker({
			position: map.getCenter(),
			icon: 'assets/img/map_pin.png',
			map: map
			
		  });
		}
		google.maps.event.addDomListener(window, 'load', initialize);	
	   /*END CONTACT MAP JS*/
		
	}); 		
	
	/*START WOW ANIMATION JS*/
	  new WOW().init();	
	/*END WOW ANIMATION JS*/	
				
})(jQuery);


  

