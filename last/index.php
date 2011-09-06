<?php
include 'config.php';
$info_error = "";
if (isset($_GET["session"])) {
	$info_error = "expire";
}
if (isset($_POST["postaction"])) {
$info_log = $_POST['login'];
$info_mdp = $_POST['mdp'];

	if ((empty($info_log)) or (empty($info_mdp))) {
		_write_log ($_SERVER['REMOTE_ADDR'], '#0', 'Connexion error (empty input).');
		$info_error = "champ";
	}
	else {
		if (tryconnect ($info_log, $info_mdp)) {
			$session = (date("z")).(date("d")).(date("g")).(date("f"));
			$string = ($info_mdp.$_SERVER['REMOTE_ADDR'].$salt.$session);
			$subsid = md5($string);
			$sid = substr ($subsid, 0, 6);
			$httpsp = 'user.php?log='.$info_log.'&sid='.$sid.'&tab=attack';
			echo ('<script type="text/javascript">window.location.replace("'.$httpsp.'");</script>');
		}
		else {
			_write_log ($_SERVER['REMOTE_ADDR'], '#0', 'Connexion error (no sql entry correspond).');
			$info_error = "connect";
		}
	}
}

function tryconnect ($log, $pass) {
	include 'config.php';
	$login = $log; // On récupère le login de ton formulaire
	$passwd = $pass; // On récupère le mot de passe de ton formulaire
	$link = mysql_connect($mysql_host, $mysql_log, $mysql_mdp);
	mysql_select_db($mysql_dbname, $link);
	$sql = "SELECT * FROM user_account WHERE login = '".(mysql_real_escape_string($login))."' AND password = '".(mysql_real_escape_string($passwd))."' ";
	$query = mysql_query($sql);
	if ( mysql_num_rows($query) === 1 ) {
		mysql_close($link);
		Return True;
	} else {
		mysql_close($link);
		Return False;
	}
}

function _write_log($ip, $type, $data) {
$d_date = (date("d"))."/".(date("m"))." ".(date("H")).":".(date("i"));
$s_string = ($d_date.'|'.$type.'|'.$ip.'|'.$data);
file_put_contents ("appdata/rawlog/rawlog.txt", $s_string."\n", FILE_APPEND);
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>MDOS</title>
    <meta name="description" content="MDOS est un site à but éducatif non lucratif exploitant des failles de serveur HTTP." />
    <meta name="keywords" content="MDOS, DOS, online, en ligne, web, dosing, attaque, Apache, faille, hacking, piratage, education, test, slowloris, ralentir, site, pirate, pirater, DOS, DDOS, Perl, RedBust">
    <meta name="Identifier-URL" content="http://dev-area.lescigales.org" />
    <meta name="robots" content="Index,Follow" />
    <meta name="language" content="fr" />
    <meta http-equiv="imagetoolbar" content="no" />
    <link type="image/x-icon" rel="shortcut icon" href="favicon.ico" />
	<link rel="stylesheet" type="text/css" href="portail/main.css">
</head>

<body bgcolor="#FFFFFF">
<div id = "userbar" align = "right">
<a id = "contact" href = "mailto:&#114;&#101;&#100;&#098;&#117;&#115;&#116;&#064;&#104;&#111;&#116;&#109;&#097;&#105;&#108;&#046;&#102;&#114;
">contact&nbsp;</a>
<a id = "forum" href = "">forum&nbsp;</a>
</div>
<div id = "postbar"><hr size = "1px" color = "#34BEED"</div>
<div id = "logo"><a  href = "<?php echo $url ?>" ><img src="portail/logo_final.png" alt = "MDOS"></a></div>
<div id = "bar"></div>
<?php
if ($info_error != "") {
	print ('<div id = "error" style ="text-align:center;margin-top:20px;"><img src = "portail/'.$info_error.'erreur.png" alt = "Erreur. Remplissez les champs de nouveau."></div>');
}
?>
<form id = "connect" action="#" method="post">
<input id="login" type="text" value="" name="login" maxlength = "10">
<br/>
<input id="mdp" type="password" value="" name="mdp"  maxlength = "10">
<br/>
<input border=0 src="portail/login.png" type="image" name = "postaction" value = "postaction" align="middle">
<br/>
<br/>
</form>
<br/>
<br/>
<div id = "conteneur"><a id = "noaccount" href = "register.php">Vous n'avez pas de compte ? Inscrivez-vous !</a></div>
</body>
</html>