define([
	"jquery",
	"Itris_OwlCarousel/js/owl.carousel.min"
], function($){
	return function (config, element) {
		return $(element).owlCarousel(config);
	}
});