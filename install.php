<?php
include 'static/config.php';

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

include 'static/header_install.php';

function search_entry ($tva, $entva) {
	include 'static/config.php';
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
	include 'static/config.php';
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