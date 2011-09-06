<?php
include 'config.php';
$page_title = 'MDOS'; //contenu variable
$special_data = '<link rel="stylesheet" type="text/css" href="template/'.$default_theme.'/main.css">'; //contenu variable
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title><?php echo $page_title; ?></title>
    <meta name="description" content="MDOS est un botnet à but éducatif non lucratif exploitant des failles de serveur HTTP." />
    <meta name="keywords" content="MDOS, DOS, online, en ligne, web, dosing, attaque, Apache, faille, hacking, piratage, education, test, slowloris, ralentir, site, pirate, pirater, DOS, DDOS, Perl, RedBust">
    <meta name="Identifier-URL" content="<?php echo $url; ?>" />
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
<?php
if ($info_error != "") {
	print ('<div id = "error" style ="text-align:center;margin-top:20px;"><img src = "template/'.$default_theme.'/'.$info_error.'erreur.png" alt = "Erreur. Remplissez les champs de nouveau."></div>');
} 
?>
<form id = "connect" action="#" method="post">
<input id="login" type="text" value="" name="login" maxlength = "10">
<br/>
<input id="mdp" type="password" value="" name="mdp"  maxlength = "10">
<br/>
<input border=0 src="template/<?php echo $default_theme; ?>/login.png" type="image" name = "postaction" value = "postaction" align="middle">
<br/>
<br/>
</form>
<br/>
<br/>
</body>
</html>