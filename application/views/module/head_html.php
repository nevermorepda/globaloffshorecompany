<?
$meta_info = new stdClass();
$meta_info->url = $_SERVER["HTTP_HOST"].$_SERVER["REQUEST_URI"];
$configured_metas = $this->m_meta->items($meta_info, 1);

if (empty($meta['title'])) {
	$meta['title'] = "Global Offshore";
}
if (empty($meta['keywords'])) {
	$meta['keywords'] = "Global Offshore, Global Offshore company";
}
if (empty($meta['description'])) {
	$meta['description'] = "";
	$meta['description'] = "";
}
if (empty($meta['canonical'])) {
	$meta['canonical'] = "";
}
if (empty($meta['author'])) {
	$meta['author'] = SITE_NAME;
}

if (!empty($configured_metas)) {
	$configured_meta = array_shift($configured_metas);
	$meta['title'] = $configured_meta->title;
	$meta['keywords'] = $configured_meta->keywords;
	$meta['description'] = $configured_meta->description;
	$meta['canonical'] = $configured_meta->canonical;
}
?>

<title><?=$meta['title']?></title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta http-equiv="Cache-Control" content="must-revalidate">
<meta http-equiv="Expires" content="<?=gmdate("D, d M Y H:i:s", time() + (60*60))?> GMT">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="<?=$meta['description']?>" />
<meta name="keywords" content="<?=$meta['keywords']?>" />
<meta name="news_keywords" content="<?=$meta['keywords']?>" />
<meta property="og:site_name" content="<?=$meta['author']?>" />
<meta property="og:title" content="<?=$meta['title']?>" />
<meta property="og:description" content="<?=$meta['description']?>" />
<meta property="og:locale" content="en_US" />
<meta property="og:type" content="website" />
<meta property="og:url" content="<?=current_url()?>" />
<meta property="og:image" content="<?=IMG_URL?>visa-map.jpg" />
<meta property="og:image:type" content="image/jpeg" />
<meta name="twitter:card" content="summary" />
<meta name="twitter:description" content="<?=$meta['description']?>" />
<meta name="twitter:title" content="<?=$meta['title']?>" />
<meta name="twitter:image" content="<?=BASE_URL?>/template/images/visa-fees.jpg" />
<meta name="robots" content="index,follow" />
<meta name="googlebot" content="index,follow" />
<meta name="author" content="<?=$meta['author']?>" />
<meta name="google-site-verification" content="dY5xCapFcXO7OnQacN6byJf2sh-QOsBEh5FjPKBfX-k"/>

<link rel='SHORTCUT ICON' href='<?=BASE_URL?>/favico.ico'/>
<link rel="alternate" href="<?=BASE_URL?>" hreflang="en" />
<link rel="canonical" href="<?=PROTOCOL.$meta_info->url?>" />

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" media="screen,all" href="<?=CSS_URL?>style.css" />
<link rel="stylesheet" href="<?=CSS_URL?>owlcarousel/owl.carousel.min.css">
<link rel="stylesheet" href="<?=CSS_URL?>owlcarousel/owl.theme.default.min.css">
<script type="text/javascript" src="<?=JS_URL?>jquery.min.js"></script>
<script src="<?=JS_URL?>owl.carousel.min.js"></script>
<script type="text/javascript" src="<?=JS_URL?>util.js"></script>
<script type="text/javascript">
	var BASE_URL = "<?=BASE_URL?>";
</script>