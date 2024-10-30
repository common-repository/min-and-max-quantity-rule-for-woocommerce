function minMaxValidation(var1, var2) {
		
	var min_cart_quntity = jQuery('#'+var1).val();
	var max_cart_quntity = jQuery("#"+var2).val();

	var error = 0;
	if (min_cart_quntity != '') {
		jQuery('#'+var1).css('border-color', '#7e8993');
		if (max_cart_quntity != '') {
			jQuery("#"+var2).css('border-color', '#7e8993');
		} else {
			jQuery("#"+var2).css('border', '1px solid #ff0000');
			jQuery("#"+var2).addClass('mamwr_error');
			error = 1;
		}
	}

	if ((min_cart_quntity != '' && max_cart_quntity != '') || (min_cart_quntity == '' && max_cart_quntity == '')) {
		jQuery("#"+var1).css('border-color', '#7e8993');
		jQuery("#"+var2).css('border-color', '#7e8993');
	}

	return error;
}


jQuery(document).ready(function(){
    //slider setting options by tabbing
    jQuery('.mamwr-inner-block ul.tabs li').click(function(){
        var tab_id = jQuery(this).attr('data-tab');
        jQuery('.mamwr-inner-block ul.tabs li').removeClass('current');
        jQuery('.mamwr-inner-block .tab-content').removeClass('current');
        jQuery(this).addClass('current');
        jQuery("#"+tab_id).addClass('current');
    });

    jQuery('#mamwr-btn-space').click(function(){
		var emptyGInp = 0;
		jQuery('.mamwr_groping_pro #gm_name').each(function() {
			if(!jQuery(this).val()){
				emptyGInp += 1;
				jQuery(this).css('border', '1px solid #ff0000');
			} else {
				jQuery(this).css('border-color', '#7e8993');
				emptyGInp += 0;
			}
		});

		if(emptyGInp > 0) {
			jQuery('.mamwr-inner-block ul.tabs li').removeClass('current');
        	jQuery('.mamwr-inner-block .tab-content').removeClass('current');
        	jQuery('[data-tab=mamwr-tab-group]').addClass('current');
        	jQuery("#mamwr-tab-group").addClass('current');
			jQuery('#mamwr_grpmngform').attr('onsubmit','return false;');
		} else {
			jQuery('#mamwr_grpmngform').attr('onsubmit','return true;');
		}
	});
});