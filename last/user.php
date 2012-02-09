<?php
include 'config.php';
if ((isset ($_GET["log"])) and (isset ($_GET["sid"]))) {
	$info_log = $_GET["log"];
	$info_sid = $_GET["sid"];
	if (isset ($_GET["tab"])) {
		$info_tab = $_GET["tab"];
	}
	if (testlog($info_log)) {
		if ((checksid($info_sid, getmdp($info_log)))==true) {
			if (isset ($_POST["update"])) {
				echo ('<script type = "text/javascript">alert("update")</script>');
			}
		}
		else {
			_write_log ($_SERVER['REMOTE_ADDR'], '#1', 'CSRF MDOS attack attempt OR expired session. (a bad secure id given on user page)');
			echo ('<script type="text/javascript">window.location.replace("'.$url.'index.php?session=0");</script>');
			exit;
		}
	}
	else {
		_write_log ($_SERVER['REMOTE_ADDR'], '#1', 'CSRF MDOS attack attempt. (a bad log given on user page)');
		echo ('<script type="text/javascript">window.location.replace("'.$url.'");</script>');
		exit;
	}
}
else {
		_write_log ($_SERVER['REMOTE_ADDR'], '#1', 'CSRF MDOS attack attempt. (no parameters calling user page)');
		echo ('<script type="text/javascript">window.location.replace("'.$url.'");</script>');
		exit;
}

function testlog ($log) {
	include 'config.php';
	$login = $log;
	$link = mysql_connect($mysql_host, $mysql_log, $mysql_mdp);
	mysql_select_db($mysql_dbname, $link);
	$sql = "SELECT * FROM user_account WHERE login = '".(mysql_real_escape_string($login))."'";
	$query = mysql_query($sql);
	if ( mysql_num_rows($query) === 1 ) {
		mysql_close($link);
		Return True;
	} else {
		mysql_close($link);
		Return False;
	}
}

function checksid($sid, $mdp) {
	include 'config.php';
	$session = (date("z")).(date("d")).(date("g")).(date("f"));
	$string = ($mdp.$_SERVER['REMOTE_ADDR'].$salt.$session);
	$subsid = md5($string);
	$sidx = substr ($subsid, 0, 6);
	if ($sid == $sidx) {
		return true ;
	}
	else {
		return false;
	}
}

function getmdp ($logx) {
	include 'config.php';
	$conn = $logx;
	$link = mysql_connect($mysql_host, $mysql_log, $mysql_mdp);
	mysql_select_db($mysql_dbname, $link);
	$sql = "SELECT password FROM user_account WHERE login =  '".(mysql_real_escape_string($conn))."'";
	$query = mysql_query($sql);
	$result =  mysql_result($query,0);
	mysql_close($link);
	return $result;
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
    <meta name="keywords" content="MDOS, DOS, online, en ligne, web, dosing, attaque, Apache, faille, hacking, piratage, éducation, test, slowloris, ralentir, site, piraté, pirater, DOS, DDOS, Perl, RedBust">
    <meta name="Identifier-URL" content="http://dev-area.lescigales.org" />
    <meta name="robots" content="Index,Follow" />
    <meta name="language" content="fr" />
    <meta http-equiv="imagetoolbar" content="no" />
    <link type="image/x-icon" rel="shortcut icon" href="favicon.ico" />
	<link rel="stylesheet" type="text/css" href="portail/user.css">
</head>
<body bgcolor="#FFFFFF">
<div id = "userbar" align = "right">
<a id = "contact" href = "mailto:&#114;&#101;&#100;&#098;&#117;&#115;&#116;&#064;&#104;&#111;&#116;&#109;&#097;&#105;&#108;&#046;&#102;&#114;">contact&nbsp;</a>
<a id = "forum" href = "http://mdosproj.alwaysdata.net/">forum&nbsp;</a>
</div>
<hr size = "1px" color = "#34BEED"</div>
<div id = "logo"><a  href = "<?php echo $url ?>" ><img src="portail/logo_final.png" alt = "MDOS"></a></div>
<div id = "bar"></div>

<?php if($info_tab == "attack"): ?>
<div id = "tab"><img src = "portail/attacktab.png" id = "tabimg"></div>
<div id = "active"><img src = "portail/attaque_c.png" id = ""></div>
<div><a href="user.php?log=<?php echo $info_log ?>&sid=<?php echo $info_sid ?>&tab=zomb"><img src = "portail/client_a.png" onmouseover = "this.src='portail/client_h.png'" onmouseout = "this.src = 'portail/client_a.png'"></a></div>
<div><a href="user.php?log=<?php echo $info_log ?>&sid=<?php echo $info_sid ?>&tab=log"><img src = "portail/log_a.png"  onmouseover = "this.src='portail/log_h.png'" onmouseout = "this.src = 'portail/log_a.png'"></a></div>
<form id = "contener" method="post" action = "#">
<textarea name="textinput" id = "textinput"></textarea>
<div id = "buttonbar">
<img src = "portail/check.png" onclick = "document.getElementById('textinput').value = document.getElementById('textinput').value + 'check'">
<img src = "portail/attack.png" onclick = "document.getElementById('textinput').value = document.getElementById('textinput').value + 'attack'">
<img src = "portail/else.png" onclick = "document.getElementById('textinput').value = document.getElementById('textinput').value + 'else {'">
<img src = "portail/}.png" onclick = "document.getElementById('textinput').value = document.getElementById('textinput').value + '}'">
<img src = "portail/{.png" id = "subbar" onclick = "document.getElementById('textinput').value = document.getElementById('textinput').value + '{'">
<img src = "portail/restart.png" onclick = "document.getElementById('textinput').value = document.getElementById('textinput').value + 'restart'">
<img src = "portail/resynchronize.png" onclick = "document.getElementById('textinput').value = document.getElementById('textinput').value + 'resynchronize'">
<img src = "portail/vegetate.png" onclick = "document.getElementById('textinput').value = document.getElementById('textinput').value + 'check'"></div>
</br>
<div id = "send">
<input border=0 src="portail/send.png" type="image" name = "update" value = "update" align="middle">
</div>
</form>
<?php elseif($info_tab == "zomb"): ?>
<div id = "tab"><img src = "portail/zombtab.png" id = "tabimg"></div>
<div id = "active"><img src = "portail/client_c.png" id = ""></div>
<div><a href="user.php?log=<?php echo $info_log ?>&sid=<?php echo $info_sid ?>&tab=attack"><img src = "portail/attaque_a.png"  onmouseover = "this.src='portail/attaque_h.png'" onmouseout = "this.src = 'portail/attaque_a.png'"></a></div>
<div><a href="user.php?log=<?php echo $info_log ?>&sid=<?php echo $info_sid ?>&tab=log"><img src = "portail/log_a.png"  onmouseover = "this.src='portail/log_h.png'" onmouseout = "this.src = 'portail/log_a.png'"></a></div>
<?php elseif($info_tab == "log"): ?>
<div id = "tab"><img src = "portail/logtab.png" id = "tabimg"></div>
<div id = "active"><img src = "portail/log_c.png" id = ""></div>
<div><a href="user.php?log=<?php echo $info_log ?>&sid=<?php echo $info_sid ?>&tab=attack"><img src = "portail/attaque_a.png"  onmouseover = "this.src='portail/attaque_h.png'" onmouseout = "this.src = 'portail/attaque_a.png'"></a></div>
<div><a href="user.php?log=<?php echo $info_log ?>&sid=<?php echo $info_sid ?>&tab=zomb"><img src = "portail/client_a.png" onmouseover = "this.src='portail/client_h.png'" onmouseout = "this.src = 'portail/client_a.png'"></a></div>
<?php else: ?>
<div id = "tab"><img src = "portail/attacktab.png" id = "tabimg"></div>
<div id = "active"><img src = "portail/attaque_c.png" id = ""></div>
<div id = "notactive"><a  href="user.php?log=<?php echo $info_log ?>&sid=<?php echo $info_sid ?>&tab=zomb"><img src = "portail/client_a.png" onmouseover = "this.src='portail/client_h.png'" onmouseout = "this.src = 'portail/client_a.png'"></a></div>
<div><a href="user.php?log=<?php echo $info_log ?>&sid=<?php echo $info_sid ?>&tab=log"><img src = "portail/log_a.png"  onmouseover = "this.src='portail/log_h.png'" onmouseout = "this.src = 'portail/log_a.png'"></a></div>
<?php endif ?>
</body>
</html>