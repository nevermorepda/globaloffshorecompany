
<!DOCTYPE html>
<html lang="en-US">
	<head>
		<? require_once(APPPATH."views/module/head_html.php"); ?>
	</head>
	<body>
		<header>
			<? require_once(APPPATH."views/module/header.php"); ?>
		</header>
		<section>
			<?=$content?>
		</section>
		<footer>
			<? require_once(APPPATH."views/module/notification.php"); ?>
			<? require_once(APPPATH."views/module/footer.php"); ?>
		</footer>
		<? require_once(APPPATH."views/module/scripttag.php"); ?>
	</body>
</html>
