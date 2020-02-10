<script>
$(document).ready(function() {
	<? if ($this->session->flashdata("error")) { ?>
		messageBox("ERROR", "Error", '<?=$this->session->flashdata("error")?>');
		$('.modal-header').css('background', '#dc3545');
	<? } else if ($this->session->flashdata("success")) { ?>
		messageBox("SUCCESS", "Success", '<?=$this->session->flashdata("success")?>');
		$('.modal-header').css('background', '#28a745');
	<? } else if ($this->session->flashdata("info")) { ?>
		messageBox("INFO", "Information", '<?=$this->session->flashdata("info")?>');
		$('.modal-header').css('background', '#007bff');
	<? } ?>
});
</script>