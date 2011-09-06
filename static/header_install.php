<?php
	include 'config.php';
	$page_title = 'MDOS - Panneau utilisateur';
	$special_data = '<link rel="stylesheet" type="text/css" href="template/'.$default_theme.'/reg.css">'; //special content
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
<?php if ($info_error != "") {
	print ('<div id = "error" style ="text-align:center;margin-top:20px;"><img src = "template/'.$default_theme.'/'.$info_error.'erreur.png" alt = "Erreur. Remplissez les champs de nouveau."></div>');
}
elseif ($subscribe == 1) {
	print ('<div id = "error" style ="text-align:center;margin-top:20px;"><img src = "template/'.$default_theme.'/subscribeinfo.png" alt = "Retournez à la page principale et connectez-vous."></div>');
} ?>
<div id = "posbreaker"></div>
<form id = "register" action="#" method="post">
<div id = "performer">
<br/>
<br/>
<div>
<font size = "3" face = "Tahoma, Arial" color = "#8C8C8C">&nbsp;&nbsp;Nom d'utilisateur : </font>
<input id="username" type="text" value="" name="username" maxlength = "15"></div>
<br/>
<div>
<font size = "3" face = "Tahoma, Arial" color = "#8C8C8C">&nbsp;&nbsp;Mot de passe : </font>
<input id="txtPdw" type="password" value="" name="mdp" onkeyup="javascript:NiveauSecurite();" maxlength = "30">
</div>
<div id = "mdpchecker"><img src="./template/<?php echo $default_theme; ?>/NiveauZero.png" alt="Niveau de sécurité de votre mot de passe" id="imgNiveauSecurite" /></div>
<br/>
<div>
<font size = "3" face = "Tahoma, Arial" color = "#8C8C8C">&nbsp;&nbsp;Confirmation : </font>
<input id="mdp+" type="password" value="" name="mdp+" maxlength = "30">
</div>
<br/>
<div>
<font size = "3" face = "Tahoma, Arial" color = "#8C8C8C">&nbsp;&nbsp;Adresse email : </font>
<input id="email" type="text" value="" name="email" maxlength = "50"></div>
<br/>
<div>
<font size = "3" face = "Tahoma, Arial" color = "#8C8C8C">&nbsp;&nbsp;Site, blog, forum personnel : </font>
<input id="siteinfo" type="text" value="" name="siteinfo" maxlength = "30"></div>
<br/>
<br/>
<br/>
</div>
<div id = "button">
<input border=0 style="text-align:center" src="template/<?php echo $default_theme; ?>/send.png" type="image" name = "postaction" value = "postaction" align="middle">
</div>
<div id = "large"></div>
</form>
</body>
</html>