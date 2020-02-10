<?
	$method = $this->util->slug($this->router->fetch_method());
?>
<ul class="nav">
	<? if (in_array($method, array('step1','step2','step3','completed'))) { ?>
	<li class="active">
		<a href="<?=site_url("apply-company-services/step1")?>" class="">1.Company Details</a>
	</li>
	<? } else { ?>
	<li class="">
		<a href="#" class="">1.Company Details</a>
	</li>
	<? } ?>
	<? if (in_array($method, array('step2','step3','completed'))) { ?>
	<li class="active">
		<a href="<?=site_url("apply-company-services/step2")?>" class="">2.Company Address</a>
	</li>
	<? } else { ?>
	<li class="">
		<a href="#" class="">2.Company Address</a>
	</li>
	<? } ?>
	<? if (in_array($method, array('step3','completed'))) { ?>
	<li class="active">
		<a href="<?=site_url("apply-company-services/step3")?>" class="">3.Payment</a>
	</li>
	<? } else { ?>
	<li class="">
		<a href="#" class="">3.Payment</a>
	</li>
	<? } ?>
</ul>