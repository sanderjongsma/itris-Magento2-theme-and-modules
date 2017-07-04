/**
 * https://magento.stackexchange.com/questions/162741/how-to-add-jquery-chosen-plugin-to-magento-2-checkout-fields/163365#163365
 * http://realize.be/mobile-support-chosen
 */

require([
	"jquery",
	"chosen.jquery"
], function ($) {
	$(function () {
		var initChosen = function(){

			if($('#checkout-loader').length > 0) {
				setTimeout(initChosen, 200);
			} else {
				$('select').chosen().change(function(){
					$('[name="region_id"]').trigger("chosen:updated");
				});
			}

		};

		initChosen();

	});
});