$(document).ready(function() {
	$('.btn-plus').click(function(event) {
		var t = new Date().getTime();
		var str = '';
			str += '<div class="after-add-more">';
			str +=		'<div class="row">';
			str +=			'<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">';
			str +=				'<input type="text" name="directorname[]" class="form-input dir_name form-control" id="directorname-'+t+'" placeholder="Director - Name of Person*"><div class="wrap-error"></div>';
			str +=			'</div>';
			str +=			'<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">';
			str +=				'<input type="text" name="directoraddress1[]" class="form-input dir_add form-control" id="directoraddress1-'+t+'" placeholder="Address Line 1*"><div class="wrap-error"></div>';
			str +=			'</div>';
			str +=		'</div>';
			str +=		'<div class="row">';
			str +=			'<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">';
			str +=				'<input type="text" name="directoraddress2[]" class="form-input dir_name form-control" id="directoraddress2-'+t+'" placeholder="Address Line 2*"><div class="wrap-error"></div>';
			str +=			'</div>';
			str +=			'<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">';
			str +=				'<input type="text" name="directorcity[]" class="form-input dir_add form-control" id="directorcity-'+t+'" placeholder="City*""><div class="wrap-error"></div>';
			str +=			'</div>';
			str +=		'</div>';
			str +=		'<div class="row">';
			str +=			'<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 dir_last">';
			str +=				'<input type="text" name="directorstate[]" class="form-input dir_state form-control" id="directorstate-'+t+'" placeholder="State*"><div class="wrap-error"></div>';
			str +=			'</div>';
			str +=			'<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 dir_last">';
			str +=				'<input type="text" name="directorcountry[]" class="form-input dir_country form-control" id="directorcountry-'+t+'" placeholder="Country*"><div class="wrap-error"></div>';
			str +=			'</div>';
			str +=			'<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 dir_last">';
			str +=				'<input type="text" name="directorcode[]" class="form-input dir_code form-control" id="directorcode-'+t+'" placeholder="Postal Code*"><div class="wrap-error"></div>';
			str +=			'</div>';
			str +=			'<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 dir_last">';
			str +=				'<div class="text-right">';
			str +=					'<a class="btn-del btn-red btn-small" item="'+t+'"><i class="fas fa-minus"></i> Delete</a>';
			str +=				'</div>';
			str +=			'</div>';
			str +=		'</div>';
			str += '</div>';
		$('.add-dir-section').append(str);
		$('.add-dir-section').attr('qty-plus', $('.add-dir-section').attr('qty-plus')+'|'+t);
	});
});
$(document).on('click', '.btn-del', function(event) {
	event.preventDefault();
	$(this).parents('.after-add-more').remove();
	var item = $(this).attr('item');
	$('.add-dir-section').attr('qty-plus', $('.add-dir-section').attr('qty-plus').replace('|'+item, ''));
});
$('.keyup-number').keyup(function(e) {
	this.value = this.value.replace(/[^0-9\.]/g,'');
});
$(document).on('click', '.btn-next', function(event) {
	event.preventDefault();
	var qty = $('.add-dir-section').attr('qty-plus').split('|');
	var c_qty = qty.length;
	var err = 0;
	var element_err = '';
	
	if ($('#preferred').val() == ''){
		$('#preferred').addClass('error');
		$('#preferred').parent().find('.wrap-error').html('<p style="color:red"><strong>Preferred Required*</strong></p>');
		err++;
		if (element_err == '') {
			element_err = 'preferred';
		}
	} else {
		$('#preferred').removeClass('error');
		$('#preferred').parent().find('.wrap-error').html('');
	}
	if ($('#alternate').val() == ''){
		$('#alternate').addClass('error');
		$('#alternate').parent().find('.wrap-error').html('<p style="color:red"><strong>Alternate Required*</strong></p>');
		err++;
		if (element_err == '') {
			element_err = 'alternate';
		}
	} else {
		$('#alternate').removeClass('error');
		$('#alternate').parent().find('.wrap-error').html('');
	}
	if ($('#shares').val() == ''){
		$('#shares').addClass('error');
		$('#shares').parent().find('.wrap-error').html('<p style="color:red"><strong>Shares Required*</strong></p>');
		err++;
		if (element_err == '') {
			element_err = 'shares';
		}
	} else {
		$('#shares').removeClass('error');
		$('#shares').parent().find('.wrap-error').html('');
	}
	if ($('#sharesval').val() == ''){
		$('#sharesval').addClass('error');
		$('#sharesval').parent().find('.wrap-error').html('<p style="color:red"><strong>Sharesval Required*</strong></p>');
		err++;
		if (element_err == '') {
			element_err = 'sharesval';
		}
	} else {
		$('#sharesval').removeClass('error');
		$('#sharesval').parent().find('.wrap-error').html('');
	}

	for (var i = 0; i < c_qty; i++) {
		if ($('#directorname-'+qty[i]).val() == ''){
			$('#directorname-'+qty[i]).addClass('error');
			$('#directorname-'+qty[i]).parent().find('.wrap-error').html('<p style="color:red"><strong>Directorname Required*</strong></p>');
			err++;
			if (element_err == '') {
				element_err = 'directorname-'+qty[i];
			}
		} else {
			$('#directorname-'+qty[i]).removeClass('error');
			$('#directorname-'+qty[i]).parent().find('.wrap-error').html('');
		}
		if ($('#directoraddress1-'+qty[i]).val() == ''){
			$('#directoraddress1-'+qty[i]).addClass('error');
			$('#directoraddress1-'+qty[i]).parent().find('.wrap-error').html('<p style="color:red"><strong>Directoraddress Required*</strong></p>');
			err++;
			if (element_err == '') {
				element_err = 'directoraddress1-'+qty[i];
			}
		} else {
			$('#directoraddress1-'+qty[i]).removeClass('error');
			$('#directoraddress1-'+qty[i]).parent().find('.wrap-error').html('');
		}
		if ($('#directoraddress2-'+qty[i]).val() == ''){
			$('#directoraddress2-'+qty[i]).addClass('error');
			$('#directoraddress2-'+qty[i]).parent().find('.wrap-error').html('<p style="color:red"><strong>Directoraddress Required*</strong></p>');
			err++;
			if (element_err == '') {
				element_err = 'directoraddress2-'+qty[i];
			}
		} else {
			$('#directoraddress2-'+qty[i]).removeClass('error');
			$('#directoraddress2-'+qty[i]).parent().find('.wrap-error').html('');
		}
		if ($('#directorcity-'+qty[i]).val() == ''){
			$('#directorcity-'+qty[i]).addClass('error');
			$('#directorcity-'+qty[i]).parent().find('.wrap-error').html('<p style="color:red"><strong>Directorcity Required*</strong></p>');
			err++;
			if (element_err == '') {
				element_err = 'directorcity-'+qty[i];
			}
		} else {
			$('#directorcity-'+qty[i]).removeClass('error');
			$('#directorcity-'+qty[i]).parent().find('.wrap-error').html('');
		}
		if ($('#directorstate-'+qty[i]).val() == ''){
			$('#directorstate-'+qty[i]).addClass('error');
			$('#directorstate-'+qty[i]).parent().find('.wrap-error').html('<p style="color:red"><strong>Directorstate Required*</strong></p>');
			err++;
			if (element_err == '') {
				element_err = 'directorstate-'+qty[i];
			}
		} else {
			$('#directorstate-'+qty[i]).removeClass('error');
			$('#directorstate-'+qty[i]).parent().find('.wrap-error').html('');
		}
		if ($('#directorcountry-'+qty[i]).val() == ''){
			$('#directorcountry-'+qty[i]).addClass('error');
			$('#directorcountry-'+qty[i]).parent().find('.wrap-error').html('<p style="color:red"><strong>Directorcountry Required*</strong></p>');
			err++;
			if (element_err == '') {
				element_err = 'directorcountry-'+qty[i];
			}
		} else {
			$('#directorcountry-'+qty[i]).removeClass('error');
			$('#directorcountry-'+qty[i]).parent().find('.wrap-error').html('');
		}
		if ($('#directorcode-'+qty[i]).val() == ''){
			$('#directorcode-'+qty[i]).addClass('error');
			$('#directorcode-'+qty[i]).parent().find('.wrap-error').html('<p style="color:red"><strong>Directorcode Required*</strong></p>');
			err++;
			if (element_err == '') {
				element_err = 'directorcode-'+qty[i];
			}
		} else {
			$('#directorcode-'+qty[i]).removeClass('error');
			$('#directorcode-'+qty[i]).parent().find('.wrap-error').html('');
		}
	}
	if (err == 0) {
		$('#frm-step1').submit();
	} else {
		location.href = "#"+element_err;
	}
});