<?php
include 'static/config.php';
include 'api/core.php';

$info_error = "";

if (isset($_GET["session"])) {
	$info_error = "expire";
}
if ((isset($_POST["postaction"])) && (isset ($_POST['login'])) && (isset ($_POST['mdp']))) {
	$info_log = $_POST['login'];
	$info_mdp = $_POST['mdp'];

	if ((empty($info_log)) or (empty($info_mdp))) {
		$Secure -> WriteLog(($Secure -> RetrieveIP()), '#0', 'Connexion error (empty input).');
		$info_error = "champ";
	}
	else {
		if ($DB -> TryConnect ($info_log, $info_mdp)) {
			$sid = $Secure -> CalcSID($info_mdp);
			$httpsp = 'user.php?log='.$info_log.'&sid='.$sid.'&tab=attack';
			$Secure -> Redirect($httpsp);
		}
		else {
			$Secure -> WriteLog(($Secure -> RetrieveIP()), '#0', 'Connexion error (no sql entry correspond).');
			$info_error = "connect";
		}
	}
}

$HTML -> PrintIndex($info_error);
?>