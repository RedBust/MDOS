<?php
include 'config.php';
$info_error = "";
$subscribe = 0;
if (isset($_POST["postaction"])) {
$info_user = $_POST['username'];
$info_mdp = $_POST['mdp'];
$info_mdpconf = $_POST['mdp+'];
$info_email = $_POST['email'];
$info_siteinfo = $_POST['siteinfo'];

	if ((empty($info_user)) or (empty($info_mdp)) or (empty($info_mdpconf)) or (empty($info_email)) or (empty($info_siteinfo))) {
		$info_error = "champ";
	}
	elseif (check_email ($info_email))
	{
		echo (check_email ($info_email));
		$info_error = "mail";
	}
	else {
		if ($info_mdp != $info_mdpconf) {
			$info_error = "confirm";
		}
		elseif (search_entry ("login", $info_user)) {
			$info_error = "user";
		}
		else {
			if (search_entry ("email", $info_email)) {
				$info_error = "mail";
			}
			else {
				register ($info_user, $info_mdp, $info_email, $info_siteinfo);
				$subscribe = 1;
			}
		}
	}
}

function search_entry ($tva, $entva) {
	include 'config.php';
	$type = $tva;
	$entry = $entva;
	$link = mysql_connect($mysql_host, $mysql_log, $mysql_mdp);
	mysql_select_db($mysql_dbname, $link);
	$sql = "SELECT * FROM user_account WHERE ".$type." = '$entry'";
	$query = mysql_query($sql);
	if ( mysql_num_rows($query) === 1 ) {
		Return True;
	}
	else {
		Return False;
	}
	mysql_close($link);
}

function register ($a, $b, $c, $d) {
	include 'config.php';
	$link = mysql_connect($mysql_host, $mysql_log, $mysql_mdp);
	mysql_select_db($mysql_dbname, $link);
	$sql = "INSERT INTO `".$mysql_dbname."`.`user_account` (`login`, `password`, `email`, `website`) VALUES ('$a', '$b', '$c', '$d');";
	$query = mysql_query($sql);
	mysql_close($link);
}

function check_email ($xemail) {
if (preg_match("/^[_a-zA-Z0-9-]+(.[_a-zA-Z0-9-]+)*@([a-zA-Z0-9-]+.)+[a-zA-Z]{2,4}$/", $xemail)) {
	if (strlen($xemail) >= 8) {
		Return False;
	}
	else {
		Return True;
	}
}
else {
	Return True;
}
}

function domain_exists($email,$record = 'MX')
{
	if(preg_match("/^[_a-zA-Z0-9-]+(.[_a-zA-Z0-9-]+)*@([a-zA-Z0-9-]+.)+[a-zA-Z]{2,4}$/", $email))
	{
		list($user,$domain) = split('@',$email);
		return checkdnsrr($domain,$record);
	}
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>MDOS - Inscription</title>
    <meta name="description" content="MDOS est un site à but éducatif non lucratif exploitant des failles de serveur HTTP." />
    <meta name="keywords" content="MDOS, DOS, online, en ligne, web, dosing, attaque, Apache, faille, hacking, piratage, éducation, test, slowloris, ralentir, site, piraté, pirater, DOS, DDOS, Perl, RedBust">
    <meta name="Identifier-URL" content="http://mdosproj.alwaysdata.net/" />
    <meta name="robots" content="Index,Follow" />
    <meta name="language" content="fr" />
    <meta http-equiv="imagetoolbar" content="no" />
    <link type="image/x-icon" rel="shortcut icon" href="favicon.ico" />
	<link rel="stylesheet" type="text/css" href="portail/reg.css">
	<script src="portail/MotDePasse.js" type="text/javascript"></script>
</head>

<body bgcolor="#FFFFFF">
<div id = "userbar" align = "right">
<a id = "contact" href = "mailto:&#114;&#101;&#100;&#098;&#117;&#115;&#116;&#064;&#104;&#111;&#116;&#109;&#097;&#105;&#108;&#046;&#102;&#114;
">contact&nbsp;</a>
<a id = "forum" href = "">forum&nbsp;</a>
</div>
<div id = "postbar"><hr size = "1px" color = "#34BEED"></div>
<div id = "logo"><a  href = "<?php echo $url ?>"><img src="portail/logo_final.png" alt = "MDOS"></a></div>
<div id = "bar"></div>
<?php
if ($info_error != "") {
print ('<div id = "error" style ="text-align:center;margin-top:20px;"><img src = "portail/'.$info_error.'erreur.png" alt = "Erreur. Remplissez les champs de nouveau."></div>');
}
elseif ($subscribe == 1) {
print ('<div id = "error" style ="text-align:center;margin-top:20px;"><img src = "portail/subscribeinfo.png" alt = "Retournez à la page principale et connectez-vous."></div>');
}
?>
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
<div id = "mdpchecker"><img src="./portail/NiveauZero.png" alt="Niveau de sécurité de votre mot de passe" id="imgNiveauSecurite" /></div>
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
<input border=0 style="text-align:center" src="portail/send.png" type="image" name = "postaction" value = "postaction" align="middle">
</div>
<div id = "large"></div>
</form>
</body>
</html>