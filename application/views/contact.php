<? $setting = $this->m_setting->load(1); ?>
<div class="banner" style="background-image: url('<?=IMG_URL?>banner_services_company.jpg')">
	<div class="container">
		<div style="display: table;"><i class="fas fa-angle-right"></i><h1>CONTACT US</h1></div>
	</div>
</div>
<div class="contact">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<? if (!empty($setting->company_name)) {?><h5 class="company-name"><?=$setting->company_name?></h5><? } ?>
				<h4 class="contact-title">CONTACT INFO</h4>
				
				<div class="row">
					<div class="col-md-4">
						<ul class="contact-list">
							<li class="flag"><img src="<?=IMG_URL.'flag/united-states.svg'?>" alt="united-states"> UNITED STATES</li>
							<? if (!empty($setting->company_hotline_us)) {?><li class="phone"><a href="tel:<?=$setting->company_hotline_us?>"><?=$setting->company_hotline_us?></a></li> <? } ?>
							<? if (!empty($setting->company_email_us)) {?><li class="mail"><a href="mailto:<?=$setting->company_email_us?>"><?=$setting->company_email_us?></a></li> <? } ?>
							<? if (!empty($setting->company_address_us)) {?><li class="address"><a href="#"><?=$setting->company_address_us?></a></li> <? } ?>
							<? if (!empty($setting->company_working_time_us)) {?><li class="clock"><a href="#"><?=$setting->company_working_time_us?></a></li> <? } ?>
						</ul>
					</div>
					<div class="col-md-4">
						<ul class="contact-list">
							<li class="flag"><img src="<?=IMG_URL.'flag/australia.svg'?>" alt="australia"> AUSTRALIA</li>
							<? if (!empty($setting->company_hotline_au)) {?><li class="phone"><a href="tel:<?=$setting->company_hotline_au?>"><?=$setting->company_hotline_au?></a></li> <? } ?>
							<? if (!empty($setting->company_email_au)) {?><li class="mail"><a href="mailto:<?=$setting->company_email_au?>"><?=$setting->company_email_au?></a></li> <? } ?>
							<? if (!empty($setting->company_address_au)) {?><li class="address"><a href="#"><?=$setting->company_address_au?></a></li> <? } ?>
							<? if (!empty($setting->company_working_time_au)) {?><li class="clock"><a href="#"><?=$setting->company_working_time_au?></a></li> <? } ?>
						</ul>
					</div>
					<div class="col-md-4">
						<ul class="contact-list">
							<li class="flag"><img src="<?=IMG_URL.'flag/singapore.svg'?>" alt="singapore">SINGAPORE</li>
							<? if (!empty($setting->company_hotline_sin)) {?><li class="phone"><a href="tel:<?=$setting->company_hotline_sin?>"><?=$setting->company_hotline_sin?></a></li> <? } ?>
							<? if (!empty($setting->company_email_sin)) {?><li class="mail"><a href="mailto:<?=$setting->company_email_sin?>"><?=$setting->company_email_sin?></a></li> <? } ?>
							<? if (!empty($setting->company_address_sin)) {?><li class="address"><a href="#"><?=$setting->company_address_sin?></a></li> <? } ?>
							<? if (!empty($setting->company_working_time_sin)) {?><li class="clock"><a href="#"><?=$setting->company_working_time_sin?></a></li> <? } ?>
						</ul>
					</div>
					<div class="col-md-4">
						<ul class="contact-list">
							<li class="flag"><img src="<?=IMG_URL.'flag/hong-kong.svg'?>" alt="hong-kong"> HONG KONG</li>
							<? if (!empty($setting->company_hotline_hk)) {?><li class="phone"><a href="tel:<?=$setting->company_hotline_hk?>"><?=$setting->company_hotline_hk?></a></li> <? } ?>
							<? if (!empty($setting->company_email_hk)) {?><li class="mail"><a href="mailto:<?=$setting->company_email_hk?>"><?=$setting->company_email_hk?></a></li> <? } ?>
							<? if (!empty($setting->company_address_hk)) {?><li class="address"><a href="#"><?=$setting->company_address_hk?></a></li> <? } ?>
							<? if (!empty($setting->company_working_time_hk)) {?><li class="clock"><a href="#"><?=$setting->company_working_time_hk?></a></li> <? } ?>
						</ul>
					</div>
					<div class="col-md-4">
						<ul class="contact-list">
							<li class="flag"><img src="<?=IMG_URL.'flag/vietnam.svg'?>" alt="Vietnam"> VIETNAM</li>
							<? if (!empty($setting->company_hotline_vn)) {?><li class="phone"><a href="tel:<?=$setting->company_hotline_vn?>"><?=$setting->company_hotline_vn?></a></li> <? } ?>
							<? if (!empty($setting->company_email_vn)) {?><li class="mail"><a href="mailto:<?=$setting->company_email_vn?>"><?=$setting->company_email_vn?></a></li> <? } ?>
							<? if (!empty($setting->company_address_vn)) {?><li class="address"><a href="#"><?=$setting->company_address_vn?></a></li> <? } ?>
							<? if (!empty($setting->company_working_time_vn)) {?><li class="clock"><a href="#"><?=$setting->company_working_time_vn?></a></li> <? } ?>
						</ul>
					</div>
				</div>
			</div>
			<div class="col-md-6">
				<h4 class="contact-title">SEND YOUR MESSAGE</h4>
				<form id="contact-form" action="<?=site_url("contact/message")?>" method="POST">
					
					<div class="row">
						<div class="col-md-6">
							<input type="text" id="fullname" name="fullname" class="full-width" value="" required="" placeholder="Name">
						</div>
						<div class="col-md-6">
							<select name="services_title" id="services_title">
								<option value="">Interested in</option>
								<option value="Company Formation">Company Formation</option>
								<option value="Company Directorship / Secretary / Nominee">Company Directorship / Secretary / Nominee</option>
								<option value="Company Maintenance / Administration">Company Maintenance / Administration</option>
								<option value="Company Dissolution / Restoration">Company Dissolution / Restoration</option>
								<option value="Shelf Companies">Shelf Companies</option>
								<option value="Serviced Office / Virtual Office">Serviced Office / Virtual Office</option>
								<option value="Accounting & Tax">Accounting & Tax</option>
								<option value="Foundation & Trust">Foundation & Trust</option>
								<option value="Bank Account Opening">Bank Account Opening</option>
								<option value="Visa & Immigrant ">Visa & Immigrant </option>
								<option value="Others">Others</option>
							</select>
						</div>
						<script type="text/javascript">
							$('#services_title').val('')
						</script>
						<div class="col-md-6">
							<input type="text" id="email" name="email" class="full-width" value="" required="" placeholder="Email">
						</div>
						<div class="col-md-6">
							<input type="text" id="phone" name="phone" class="full-width" value="" required="" placeholder="Phone">
						</div>
						<div class="col-md-12">
							<textarea id="message" name="message" class="full-width" placeholder="Message" required=""></textarea>
						</div>
					</div>
					<br>
					<button type="submit" class="btn btn-1x btn-sm btn-danger btn-red btn-contact full-width">Submit</button>
				</form>
				<br>
				<h4 class="contact-title">SOCIAL MEDIA</h4>
				<ul class="contact-social">
					<? if (!empty($setting->facebook_url)) { ?><li><a class="transition" href="<?=$setting->facebook_url?>"><i class="fab fa-facebook-f"></i></a></li><? } ?>
					<? if (!empty($setting->twitter_url)) { ?><li><a class="transition" href="<?=$setting->twitter_url?>"><i class="fab fa-twitter"></i></a></li><? } ?>
					<? if (!empty($setting->youtube_url)) { ?><li><a class="transition" href="<?=$setting->youtube_url?>"><i class="fab fa-youtube"></i></a></li><? } ?>
					<? if (!empty($setting->googleplus_url)) { ?><li><a class="transition" href="<?=$setting->googleplus_url?>"><i class="fab fa-instagram"></i></a></li><? } ?>
				</ul>
			</div>

			<div class="col-md-6">
				<h4 class="contact-title">FIND US IN MAP</h4>
				<div id="Map" style="width: 100%; height: 400px;">
			</div>
		</div>
		<hr>
	</div>
</div>
</div>
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDigCaYfSLVz0PhLL4P7s7D6kU5Kd63AEY&callback=initMap"></script>
<script type="text/javascript">
	var contentstring = [];
	var regionlocation = [];
	var markers = [];
	var iterator = 0;
	var areaiterator = 0;
	var map;
	var infowindow = [];
	geocoder = new google.maps.Geocoder();

	var vietnam = {lat: 25.836905, lng: 179.984401};
	
	$(document).ready(function () {
		setTimeout(function() { initialize(); }, 400);
	});
	
	function initialize() {           
		infowindow = [];
		markers = [];
		GetValues();
		iterator = 0;
		areaiterator = 0;
		region = new google.maps.LatLng(regionlocation[areaiterator].split(',')[0], regionlocation[areaiterator].split(',')[1]);
		map = new google.maps.Map(document.getElementById("Map"), { 
			zoom: 1,
			mapTypeId: google.maps.MapTypeId.ROADMAP,
			center: vietnam,
		});
		drop();
	}
	
	function GetValues() {
		//Get the Latitude and Longitude of a Point site : http://itouchmap.com/latlong.html
		contentstring[0] = "187 E. Warm Springs Rd, Suite B324, Las Vegas, Nevada 89119";
		regionlocation[0] = '36.0571651,-115.1633232';
					
		contentstring[1] = "23 New Industrial Road #04-08 Solstice Business Center Singapore 536209";
		regionlocation[1] = "1.3433314,103.8830069";
		
		contentstring[2] = "The EverRich Infinity, 290 An Duong Vuong, District 5, Ho Chi Minh City, Vietnam";
		regionlocation[2] = "10.7604927,106.6784627";
	}
	function drop() {
		for (var i = 0; i < contentstring.length; i++) {
			setTimeout(function() {
				addMarker();
			}, 800);
		}
	}
 
	function addMarker() {
		var address = contentstring[areaiterator];
		var icons = 'http://maps.google.com/mapfiles/ms/icons/red-dot.png';
		var templat = regionlocation[areaiterator].split(',')[0];
		var templong = regionlocation[areaiterator].split(',')[1];
		var temp_latLng = new google.maps.LatLng(templat, templong);
		markers.push(new google.maps.Marker(
		{
			position: temp_latLng,
			map: map,
			icon: icons,
			draggable: true
		}));            
		iterator++;
		info(iterator);
		areaiterator++;
	}
 
	function info(i) {
		infowindow[i] = new google.maps.InfoWindow({
			content: contentstring[i - 1]
		});
		infowindow[i].content = contentstring[i - 1];
		google.maps.event.addListener(markers[i - 1], 'click', function() {
			for (var j = 1; j < contentstring.length + 1; j++) {
				infowindow[j].close();
			}
			infowindow[i].open(map, markers[i - 1]);
		});
	}
</script>
<!-- <div class="googlemap">
	<div class="container">
		<h5 class="maps-title">Global Offshore</h5>
		<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut</p>
		<p><strong>Please lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut</strong></p>
		<div class="choose-nation">
			<div class="row">
				<div class="col-md-2"></div>
				<div class="col-md-8">
					<div class="row">
						<div class="col-md-4">
							<div style="margin-top: 4px;text-align: right;">CHOOSE YOUR LOCATION</div>
						</div>
						<div class="col-md-4">
							<select name="" id="input" class="form-control" required="required">
								<option value="">Select an Area</option>
							</select>
						</div>
						<div class="col-md-4">
							<select name="" id="input" class="form-control" required="required">
								<option value="">Select an Country</option>
							</select>
						</div>
					</div>
				</div>
				<div class="col-md-2"></div>
			</div>
		</div>
	</div>
	<div id="mapcanvas" style="height: 310px; width: 100%; margin-top: 10px"></div>
</div>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDigCaYfSLVz0PhLL4P7s7D6kU5Kd63AEY" async defer></script>
<script type="text/javascript">
$(document).ready(function() {
	var options = {
		zoom:14,
		mapTypeId: google.maps.MapTypeId.ROADMAP
	};
	map = new google.maps.Map(document.getElementById("mapcanvas"), options);
	var location = new google.maps.LatLng(10.784512, 106.667953);
	map.setCenter(location);
	var marker = new google.maps.Marker({
		map: map,
		position: location,
		title : 'THE ONE VIETNAM'
	});
});
</script> -->
<script>
$(document).ready(function() {
	$(".btn-contact").click(function() {
		var err = 0;
		var msg = new Array();
		if ($("#fullname").val() == "") {
			$("#fullname").addClass("error");
			msg.push("Your name is required.");
			err++;
		} else {
			$("#fullname").removeClass("error");
		}
		if ($("#services_title").val() == "") {
			$("#services_title").addClass("error");
			msg.push("Interested in is required.");
			err++;
		} else {
			$("#services_title").removeClass("error");
		}
		if ($("#phone").val() == "") {
			$("#phone").addClass("error");
			msg.push("Your phone is required.");
			err++;
		} else {
			$("#phone").removeClass("error");
		}

		if ($("#email").val() == "") {
			$("#email").addClass("error");
			msg.push("Your email is required.");
			err++;
		} else {
			$("#email").removeClass("error");
		}

		if ($("#message").val() == "") {
			$("#message").addClass("error");
			msg.push("Please give us your message.");
			err++;
		} else {
			$("#message").removeClass("error");
		}

		if (err == 0) {
			return true;
		}
		else {
			showErrorMessage(msg);
			return false;
		}
	});
});
</script>