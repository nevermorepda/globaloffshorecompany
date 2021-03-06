<? if (!in_array($this->router->fetch_class(), array('member','apply_company_services'))) { ?>
<div class="cluster">
	<div class="container">
		<div class="home-bottom">
			<div style="position: absolute;width: 100%;height: 342px;top: 0;left: 0;background-image: linear-gradient(to right, transparent 10%, #00000091 100%);"></div>
			<div class="row">
				<div class="col-md-5"></div>
				<div class="col-md-7">
					<h3>GET STARTED NOW</h3>
					<p style="font-size: 15px;">If you have any questions, or would like to learn more about taking the next steps with Global Offshore Company, please select one of the options below.</p>
					<div class="apply-link">- For Company Formation Service, please <a target="_blank" href="<?=site_url("apply-company-services")?>">click here</a> to select Jurisdiction. </div>
					<div class="apply-link">- For more information and comprehensive consultation of other services, please <a target="_blank" href="<?=site_url("contact")?>">Contact Us</a>.</div>
					<div class="apply-link" style="padding-left: 25px;">We will happily guide you through our services and also advise you on the solutions that would best suite your needs.</div>
					<div class="apply-link">- To download the Due Diligence Form, please <a target="_blank" href="<?=BASE_URL.'/files/upload/file/due-diligence-form-for-individual.pdf'?>">click here</a>.</div>
				</div>
			</div>
		</div>
	</div>
</div>
<? } ?>
<div class="subscribe-email">
	<div class="container">
		<div class="clearfix" style="position: relative">
			<h5 class="subscribe-tlt">SIGN UP FOR EMAIL UPDATES</h5>
			<ul class="wrap-pc float-right d-none d-lg-block">
				<li>
					YOUR NAME:
				</li>
				<li>
					<input type="text" name="" class="form-control" value="" title="">
				</li>
				<li style="margin-left: 15px;">
					YOUR EMAIL:
				</li>
				<li>
					<input type="text" name="" class="form-control" value="" title="">
				</li>
				<li><button class="submit-pc">Submit</button></li>
			</ul>
			<div class="d-block d-lg-none">
				<div class="wrap-mobile">
					<div class="your-name">
						<input type="text" name="" class="form-control" value="" placeholder="YOUR NAME: " title="">
					</div>
					<div class="your-email">
						<input type="text" name="" class="form-control" value="" placeholder="YOUR EMAIL: " title="">
					</div>
				</div>
				<button class="submit-mobile">Submit</button>
			</div>
		</div>
	</div>
</div>
<div class="footer-top">
	<div class="container">
		<div class="d-none d-lg-block">
			<div class="row">
				<div class="col-sm-3">
					<div class="item">
						<i class="fas fa-headset transition"></i>
						<strong>Quick Contact</strong>
					</div>
				</div>
				<div class="col-sm-3">
					<div class="item">
						<i class="fas fa-comments transition"></i>
						<strong>Chat with Us</strong>
					</div>
				</div>
				<div class="col-sm-3">
					<div class="item">
						<i class="fab fa-expeditedssl"></i>
						<strong>Security</strong>
					</div>
				</div>
				<div class="col-sm-3">
					<div class="item">
						<i class="fas fa-phone-volume transition"></i>
						<strong>Talk to Us</strong>
					</div>
				</div>
			</div>
		</div>
		<div class="d-block d-lg-none">
			<div class="contact-mobile">
				<div class="contact-mobile-item">
					<a class="border-item" href="#">
						<i class="fab fa-teamspeak transition"></i><br>
						<strong>Quick Contact</strong>
					</a>
				</div>
				<div class="contact-mobile-item">
					<a class="border-item" href="#">
						<i class="fas fa-comments transition"></i><br>
						<strong>Chat with Us</strong>
					</a>
				</div>
				<div class="contact-mobile-item">
					<a class="border-item" href="#">
						<i class="fas fa-envelope transition"></i><br>
						<strong>Write to Us</strong>
					</a>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="footer-content">
	<div class="container">
		<div class="row">
			<div class="col-md-2">
				<div class="footer-logo">
					<img src="<?=IMG_URL?>logo-mobile.png" alt="global offshore company" style="margin-top: 9px;">
					<ul class="socical">
						<? if (!empty($setting->googleplus_url)) { ?><li><a href="<?=$setting->googleplus_url?>" target="_blank"><i class="transition fab fa-instagram"></i></a></li><? } ?>
						<? if (!empty($setting->facebook_url)) { ?><li><a href="<?=$setting->facebook_url?>" target="_blank"><i class="transition fab fa-facebook-f"></i></a></li><? } ?>
						<? if (!empty($setting->twitter_url)) { ?><li><a href="<?=$setting->twitter_url?>" target="_blank"><i class="transition fab fa-twitter"></i></a></li><? } ?>
						<? if (!empty($setting->youtube_url)) { ?><li><a href="<?=$setting->youtube_url?>" target="_blank"><i class="transition fab fa-youtube"></i></a></li><? } ?>
					</ul>
				</div>
			</div>
			<div class="col-md-10">
				<div class="row">
					<div class="col-md-3">
						<ul class="support">
							<li style="font-size: 18px;font-weight: bold;padding-bottom: 10px;">SUPPORT PHONE</li>
							<? if (!empty($setting->company_hotline_us)) { ?>
							<li class="clearfix"><img src="<?=IMG_URL?>flag/united-states.svg" alt="united-states"><a href="tel:<?=$setting->company_hotline_us?>"><?=$setting->company_hotline_us?></a></li>
							<? } ?>
							<? if (!empty($setting->company_hotline_au)) { ?>
							<li class="clearfix"><img src="<?=IMG_URL?>flag/australia.svg" alt="australia"><a href="tel:<?=$setting->company_hotline_au?>"><?=$setting->company_hotline_au?></a></li>
							<? } ?>
							<? if (!empty($setting->company_hotline_sin)) { ?>
							<li class="clearfix"><img src="<?=IMG_URL?>flag/singapore.svg" alt="singapore"><a href="tel:<?=$setting->company_hotline_sin?>"><?=$setting->company_hotline_sin?></a></li>
							<? } ?>
							<? if (!empty($setting->company_hotline_hk)) { ?>
							<li class="clearfix"><img src="<?=IMG_URL?>flag/hong-kong.svg" alt="hong-kong"><a href="tel:<?=$setting->company_hotline_hk?>"><?=$setting->company_hotline_hk?></a></li>
							<? } ?>
							<? if (!empty($setting->company_hotline_vn)) { ?>
							<li class="clearfix"><img src="<?=IMG_URL?>flag/vietnam.svg" alt="vietnam"><a href="tel:<?=$setting->company_hotline_vn?>"><?=$setting->company_hotline_vn?></a></li>
							<? } ?>
					</div>
					<div class="col-md-4">
						<ul class="support">
							<li style="font-size: 18px;font-weight: bold;padding-bottom: 10px;">FIND US</li>
							<? if (!empty($setting->company_hotline_vn)) { ?><li> <i class="fas fa-phone"></i> <a href="tel:<?=$setting->company_hotline_vn?>"> <?=$setting->company_hotline_vn?></a></li><? } ?>
							<? if (!empty($setting->company_email)) { ?><li> <i class="fas fa-envelope"></i> <a href="mailto:<?=$setting->company_email?>"> <?=$setting->company_email?></a></li><? } ?>
							<li> <i class="far fa-clock"></i> Mon - Fri: 8:00 - 17:30</li>
						</ul>
					</div>
					<div class="col-md-5">
						<ul class="support">
							<li style="font-size: 18px;font-weight: bold;padding-bottom: 10px;" class="d-none d-lg-block">ADDRESS</li>
							<? if (!empty($setting->company_address_us)) { ?><li><img src="<?=IMG_URL?>flag/united-states.svg" alt="united-states"><?=$setting->company_address_us?></li><? } ?>
							<? if (!empty($setting->company_address_au)) { ?><li><img src="<?=IMG_URL?>flag/australia.svg" alt="australia"><?=$setting->company_address_au?></li><? } ?>
							<? if (!empty($setting->company_address_sin)) { ?><li><img src="<?=IMG_URL?>flag/singapore.svg" alt="singapore"><?=$setting->company_address_sin?></li><? } ?>
							<? if (!empty($setting->company_address_hk)) { ?><li><img src="<?=IMG_URL?>flag/hong-kong.svg" alt="hong-kong"><?=$setting->company_address_hk?></li><? } ?>
							<? if (!empty($setting->company_address_vn)) { ?><li><img src="<?=IMG_URL?>flag/vietnam.svg" alt="vietnam"><?=$setting->company_address_vn?></li><? } ?>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="copyright">
	<div class="container clearfix">
		<div class="float-left">Copyright © 2019 <a href="">Global Offshore</a></div>
		<div class="float-right">
			<ul>
				<li><a href="">Terms of Use</a></li>
				<li><a href="">Privacy Policy</a></li>
			</ul>
		</div>
	</div>
</div>
<div id="dialog" class="modal-error modal fade" data-backdrop="static" data-keyboard="false">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" style="color:#fff;">Modal title</h4>
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true" style="color:#fff;">&times;</button>
			</div>
			<div class="modal-body">
				<p>&hellip;</p>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>