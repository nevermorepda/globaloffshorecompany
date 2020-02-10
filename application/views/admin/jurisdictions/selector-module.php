<?
	$modules = $this->m_category->items();
	$process = $this->m_services_process->items();
	$services = $this->m_services->items();
?>
<select name="module" id="module" class="form-control">
	<optgroup label="">
		<option value="content">Content</option>
		<option value="jurisdictions">Jurisdictions</option>
		<option value="service">Services</option>
		<option value="faqs-jurisdiction">FAQs</option>
		<option value="download">Download & Form</option>
	</optgroup>
	<optgroup label="—————How it work—————">
		<? foreach ($process as $proces) { ?>
		<option value="process-|-<?=$proces->id?>"><?=$proces->name?></option>
		<? } ?>
	</optgroup>
	<optgroup label="—————Module—————">
		<? foreach ($modules as $module) { ?>
		<option value="<?=$module->alias?>"><?=$module->name?></option>
		<? } ?>
	</optgroup>
</select>