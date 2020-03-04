<? $setting = $this->m_setting->load(1); ?>
<div class="banner" style="background-image: url('<?=IMG_URL?>banner_services_company.jpg')">
	<div class="container">
		<div style="display: table;"><i class="fas fa-angle-right"></i><h1>CONTACT US</h1></div>
	</div>
</div>
<div class="contact">
	<div class="container">
		<div class="row">
			<div class="col-md-5">
				<h4 class="contact-title">CONTACT INFO</h4>
				<ul class="contact-list">
					<li class="phone"><a href=""><?=$setting->company_hotline_us?></a></li>
					<li class="mail"><a href=""><?=$setting->company_email?></a></li>
					<li class="address"><a href="">187 E. Warm Springs Rd, Suite B324, Las Vegas, Nevada 89119</a></li>
					<li class="address"><a href="">23 New Industrial Road #04-08 Solstice Business Center Singapore 536209</a></li>
					<li class="address"><a href="">The EverRich Infinity, 290 An Duong Vuong, District 5, Ho Chi Minh City, Vietnam</a></li>
				</ul>
				<h4 class="contact-title">SOCIAL MEDIA</h4>
				<ul class="contact-social">
					<li><a class="transition" href="<?=$setting->facebook_url?>"><i class="fab fa-facebook-f"></i></a></li>
					<li><a class="transition" href="#"><i class="fas fa-rss"></i></a></li>
					<li><a class="transition" href="<?=$setting->googleplus_url?>"><i class="fab fa-google-plus-g"></i></a></li>
					<li><a class="transition" href="#"><i class="fab fa-pinterest-p"></i></a></li>
					<li><a class="transition" href="#"><i class="fab fa-instagram"></i></a></li>
				</ul>
			</div>
			<div class="col-md-7">
				<form id="contact-form" action="<?=site_url("contact/message")?>" method="POST">
					<h4 class="contact-title">SEND YOUR MESSAGE</h4>
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
					<button type="submit" class="btn btn-1x btn-sm btn-danger btn-red btn-contact">Submit</button>
				</form>
			</div>
		</div>
		<hr>
	</div>
</div>
<div id="Map" style="width: 100%; height: 400px;">
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
			zoom: 4,
			mapTypeId: google.maps.MapTypeId.ROADMAP,
			center: region,
		});
		drop();
	}
	
	function GetValues() {
		//Get the Latitude and Longitude of a Point site : http://itouchmap.com/latlong.html
		contentstring[0] = "S4 Ba Vi, District 10, Ho Chi Minh City";
		regionlocation[0] = '10.7801413,106.6604573';
					
		contentstring[1] = "21, 3 Trần Hưng Đạo, Thành phố Long Xuyên, An Giang Province";
		regionlocation[1] = "10.3299182,105.4818821";
		
		contentstring[2] = "11, 33 Nguyễn Hữu Tiến, Tân Phú, Ho Chi Minh City";
		regionlocation[2] = "10.809922,106.6230835";
		
		// contentstring[3] = "Pune, india";
		// regionlocation[3] = "18.520430, 73.856744";
		
		// contentstring[4] = "Chennai, india";
		// regionlocation[4] = "13.082680, 80.270718";
		
		// contentstring[5] = "Visakhapatnam, Andhra Pradesh, india";
		// regionlocation[5] = "17.686816, 83.218482";
		
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
			draggable: false
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