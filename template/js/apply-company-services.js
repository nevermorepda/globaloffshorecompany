$(document).ready(function() {
	$('#jurisdictions').change(function(event) {
		var nation = $(this).val();
		$('.set-nation').html($('#jurisdictions option:selected').text());
		$('.wrap-loading').css('display', 'block');
		var p = {};
		p['nation'] = nation;
		$.ajax({
			url: BASE_URL + "/apply-company-services/get-list-service-fee",
			type: 'post',
			dataType: 'json',
			data: p,
			success: function (data) {
				var str = '';
				if (data) {
					var c = data[0].length;

					$('.wrap-loading').css('display', 'none');
					
					str +='<table class="tbl-apply">';
					str +='<thead class="pkg_header">';
					str +=			'<tr>';
					str +=				'<th class="benefits_pkg_title">Benefits Included In Your Package</th>';
					str +=				'<th class="non_pkg_title">Package</th>';
					str +=			'</tr>';
					str +=		'</thead>';
					str +=		'<tbody>';
					str +=			'<tr class="pkg_detail final_price">';
					str +=				'<td class="pkg_table_desc"><strong class="text-color-red">(*)Please be noticed that: all fees are subjected to change without prior notice. Please contact us prior payment for confirmation.</strong></td>';
					str +=				'<td class="pkg_info total_price_top"> ';
					str +=					'<strong class="non_pkg_price" >$<span class="total">'+data[1]+'</span></strong>';
					str +=					'<button type="submit" class="btn-small btn-red btn-next-step">Buy Now</button>';
					str +=				'</td>';
					str +=			'</tr>';
					for (var i = 0; i < c; i++) {
						str +=	'<tr class="pkg_detail">';
						str +=		'<td class="pkg_table_desc">';
						str +=			'<span class="new_services"><strong>'+data[0][i].name+'</strong> <b>-</b> '+data[0][i].content+'</span>';
						str +=		'</td>';
						str +=		'<td>';
						if (parseInt(data[0][i].recomen) == 0) {
							str +=		'<span value="795" class="price">$'+data[0][i].fee+'</span>';
						} else {
							str +=		'<label class="wrap-checkbox">';
							str +=			'<span value="795" class="price">$'+data[0][i].fee+'</span>';
							str +=			'<input type="checkbox" class="check-option" name="service_option[]" value="'+data[0][i].id+'">';
							str +=			'<span class="checkmark"></span>';
							str +=		'</label>';
						}
						str +=		'</td>';
						str +=	'</tr>';
					}
					str +=			'<tr class="pkg_detail final_price">';
					str +=				'<td class="pkg_table_desc title_bottom"> <strong>TOTAL FEE </strong> </td>';
					str +=				'<td class="total_price_bottom"> <strong class="non_pkg_price">$<span class="total">'+data[1]+'</span></strong>';
					str +=				'</td>';
					str +=			'</tr>';
					str +=		'</tbody>';
					str +=	'</table><br>';
					
					str +=	'<div class="text-center"><button type="submit" class="btn-small btn-red btn-next-step">Buy Now</button></div>';
					$('.wrap-apply').html(str);
				}
			}
		});
	});
});
$(document).on('change', '.check-option', function(event) {
	event.preventDefault();
	var id = $(this).val();
	var total = parseFloat($('.total').html());
	var check = $(this).is(":checked");
	$.ajax({
		url: BASE_URL + "/apply-company-services/get-service-fee",
		type: 'post',
		dataType: 'json',
		data: {id: id},
		success: function(data) {
			if (check) {
				$('.total').html(total+parseFloat(data.fee));
			} else {
				$('.total').html(total-parseFloat(data.fee));
			}
		}
	});
});