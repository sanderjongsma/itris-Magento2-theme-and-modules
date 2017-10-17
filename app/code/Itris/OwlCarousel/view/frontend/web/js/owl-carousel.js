define([
	"jquery",
	"OwlCarousel.min"
], function($){
	return function (config, element) {
		return $(element).owlCarousel(config);
	}
});
