define([
	"jquery",
	"owlCarousel.min"
], function($){
	return function (config, element) {
		return $(element).owlCarousel(config);
	}
});