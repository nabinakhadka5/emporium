global.$ = global.jQuery = require('jquery');
require('../template/home/vendor/animsition/js/animsition');
require("bootstrap");
require('../template/home/vendor/slick/slick');
require('../template/home/js/slick-custom');
require('../template/home/vendor/parallax100/parallax100');
$('.parallax100').parallax100();
require('../template/home/vendor/MagnificPopup/jquery.magnific-popup.min');

		$('.gallery-lb').each(function() { // the containers for all your galleries
			$(this).magnificPopup({
		        delegate: 'a', // the selector for gallery item
		        type: 'image',
		        gallery: {
		        	enabled:true
		        },
		        mainClass: 'mfp-fade'
		    });
        });

require('../template/home/vendor/isotope/isotope.pkgd.min');
// require('../template/home/vendor/sweetalert/sweetalert.min');
require('../template/home/vendor/perfect-scrollbar/perfect-scrollbar.min');

		$('.js-pscroll').each(function(){
			$(this).css('position','relative');
			$(this).css('overflow','hidden');

		});
require("../template/home/js/main")

