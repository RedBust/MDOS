<?php
include 'config.php';
$info_page = $_GET['page'];

switch ($info_page) {
	case "register":
		$page_title = 'MDOS - Installation';
		$special_data = '<link rel="stylesheet" type="text/css" href="template/'.$default_theme.'/reg.css">
		<script src="template/'.$default_theme.'/MotDePasse.js" type="text/javascript"></script>'; //special content
	break;
	case "index":
		$page_title = 'MDOS';
		$special_data = '<link rel="stylesheet" type="text/css" href="template/'.$default_theme.'/main.css">'; //special content
	break;
	case "user":
		$page_title = 'MDOS - Panneau utilisateur';
		$special_data = '<link rel="stylesheet" type="text/css" href="template/'.$default_theme.'/user.css">'; //special content
}
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title><?php echo $page_title; ?></title>
    <meta name="description" content="MDOS est un botnet à but éducatif non lucratif exploitant des failles de serveur HTTP." />
    <meta name="keywords" content="MDOS, DOS, online, en ligne, web, dosing, attaque, Apache, faille, hacking, piratage, education, test, slowloris, ralentir, site, pirate, pirater, DOS, DDOS, Perl, RedBust">
    <meta name="Identifier-URL" content="http://dev-area.lescigales.org" />
    <meta name="robots" content="Index,Follow" />
    <meta name="language" content="fr" />
    <meta http-equiv="imagetoolbar" content="no" />
    <?php echo $special_data; ?>
</head>

<body bgcolor="#FFFFFF">
<div id = "userbar" align = "right">
<a id = "contact" href = "mailto:&#114;&#101;&#100;&#098;&#117;&#115;&#116;&#064;&#104;&#111;&#116;&#109;&#097;&#105;&#108;&#046;&#102;&#114;">contact&nbsp;</a>
<a id = "forum" href = "">forum&nbsp;</a>
</div>
<div id = "postbar"><hr size = "1px" color = "#34BEED"</div>
<div id = "logo"><a  href = "<?php echo $url ?>" ><img src="template/<?php echo $default_theme; ?>/logo_final.png" alt = "MDOS"></a></div>
<div id = "bar"></div>