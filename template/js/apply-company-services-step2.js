$(document).on('click', '.btn-next', function(event) {
	event.preventDefault();
	var err = 0;
	var element_err = '';
	
	if ($('#req_ship_fullname').val() == ''){
		$('#req_ship_fullname').addClass('error');
		$('#req_ship_fullname').parent().find('.wrap-error').html('<p style="color:red"><strong>Fullname Required*</strong></p>');
		err++;
		if (element_err == '') {
			element_err = 'req_ship_fullname';
		}
	} else {
		$('#req_ship_fullname').removeClass('error');
		$('#req_ship_fullname').parent().find('.wrap-error').html('');
	}
	if ($('#req_ship_address').val() == ''){
		$('#req_ship_address').addClass('error');
		$('#req_ship_address').parent().find('.wrap-error').html('<p style="color:red"><strong>Address Required*</strong></p>');
		err++;
		if (element_err == '') {
			element_err = 'req_ship_address';
		}
	} else {
		$('#req_ship_address').removeClass('error');
		$('#req_ship_address').parent().find('.wrap-error').html('');
	}
	if ($('#req_ship_city').val() == ''){
		$('#req_ship_city').addClass('error');
		$('#req_ship_city').parent().find('.wrap-error').html('<p style="color:red"><strong>City Required*</strong></p>');
		err++;
		if (element_err == '') {
			element_err = 'req_ship_city';
		}
	} else {
		$('#req_ship_city').removeClass('error');
		$('#req_ship_city').parent().find('.wrap-error').html('');
	}
	if ($('#req_ship_province').val() == ''){
		$('#req_ship_province').addClass('error');
		$('#req_ship_province').parent().find('.wrap-error').html('<p style="color:red"><strong>Province Required*</strong></p>');
		err++;
		if (element_err == '') {
			element_err = 'req_ship_province';
		}
	} else {
		$('#req_ship_province').removeClass('error');
		$('#req_ship_province').parent().find('.wrap-error').html('');
	}
	if ($('#req_ship_zipcode').val() == ''){
		$('#req_ship_zipcode').addClass('error');
		$('#req_ship_zipcode').parent().find('.wrap-error').html('<p style="color:red"><strong>Zipcode Required*</strong></p>');
		err++;
		if (element_err == '') {
			element_err = 'req_ship_zipcode';
		}
	} else {
		$('#req_ship_zipcode').removeClass('error');
		$('#req_ship_zipcode').parent().find('.wrap-error').html('');
	}
	if ($('#req_ship_country').val() == ''){
		$('#req_ship_country').addClass('error');
		$('#req_ship_country').parent().find('.wrap-error').html('<p style="color:red"><strong>Country Required*</strong></p>');
		err++;
		if (element_err == '') {
			element_err = 'req_ship_country';
		}
	} else {
		$('#req_ship_country').removeClass('error');
		$('#req_ship_country').parent().find('.wrap-error').html('');
	}
	if ($('#req_ship_day_phone').val() == ''){
		$('#req_ship_day_phone').addClass('error');
		$('#req_ship_day_phone').parent().find('.wrap-error').html('<p style="color:red"><strong>Day phone Required*</strong></p>');
		err++;
		if (element_err == '') {
			element_err = 'req_ship_day_phone';
		}
	} else {
		$('#req_ship_day_phone').removeClass('error');
		$('#req_ship_day_phone').parent().find('.wrap-error').html('');
	}
	if ($('#req_ship_evening_phone').val() == ''){
		$('#req_ship_evening_phone').addClass('error');
		$('#req_ship_evening_phone').parent().find('.wrap-error').html('<p style="color:red"><strong>Evening phone Required*</strong></p>');
		err++;
		if (element_err == '') {
			element_err = 'req_ship_evening_phone';
		}
	} else {
		$('#req_ship_evening_phone').removeClass('error');
		$('#req_ship_evening_phone').parent().find('.wrap-error').html('');
	}
	if ($('#req_ship_phone').val() == ''){
		$('#req_ship_phone').addClass('error');
		$('#req_ship_phone').parent().find('.wrap-error').html('<p style="color:red"><strong>Phone Required*</strong></p>');
		err++;
		if (element_err == '') {
			element_err = 'req_ship_phone';
		}
	} else {
		$('#req_ship_phone').removeClass('error');
		$('#req_ship_phone').parent().find('.wrap-error').html('');
	}
	if ($('#req_ship_fax').val() == ''){
		$('#req_ship_fax').addClass('error');
		$('#req_ship_fax').parent().find('.wrap-error').html('<p style="color:red"><strong>Fax Required*</strong></p>');
		err++;
		if (element_err == '') {
			element_err = 'req_ship_fax';
		}
	} else {
		$('#req_ship_fax').removeClass('error');
		$('#req_ship_fax').parent().find('.wrap-error').html('');
	}
	if ($('#req_ship_email').val() == ''){
		$('#req_ship_email').addClass('error');
		$('#req_ship_email').parent().find('.wrap-error').html('<p style="color:red"><strong>Email Required*</strong></p>');
		err++;
		if (element_err == '') {
			element_err = 'req_ship_email';
		}
	} else {
		if (isEmail($('#req_ship_email').val())) {
			$('#req_ship_email').removeClass('error');
			$('#req_ship_email').parent().find('.wrap-error').html('');
		} else {
			$('#req_ship_email').addClass('error');
			$('#req_ship_email').parent().find('.wrap-error').html('<p style="color:red"><strong>Is not an email format</strong></p>');
			err++;
			if (element_err == '') {
				element_err = 'req_ship_email';
			}
		}
		
	}

	if (err == 0) {
		$('#frm-step2').submit();
	} else {
		location.href = "#"+element_err;
	}
});
$('.keyup-number').keyup(function(e) {
	this.value = this.value.replace(/[^0-9\.]/g,'');
});