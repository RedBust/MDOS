<?php
	class MDOS {
		function HTMLPrintIndex($error) {
			include 'static/config.php';
			$fwd = 'template/'.$default_theme.'/htmlcontent/index.html';
			$content = read_file($fwd);
			$md_d1 = str_replace ("%url%", $url, $content);
			$md_d2 = str_replace ("%default_theme%", $default_theme, $md_d1);
			if ($error != "") {
				$sp_data = '<div id = "error" style ="text-align:center;margin-top:20px;"><img src = "template/'.$default_theme.'/'.$error.'erreur.png" alt = "Erreur. Remplissez les champs de nouveau."></div>';
				$md_d2 = str_replace ("%error%", $sp_data, $md_d2);
			}
			else {
				$md_d2 = str_replace ("%error%", "", $md_d2);
			}
			echo $md_d2;
		}
		function HTMLPrintUser($info_sid, $info_log, $tab, $logdata = "") {
			include 'static/config.php';
			$content = read_file ('template/'.$default_theme.'/htmlcontent/user.html');
			$tabcontent = read_file ('template/'.$default_theme.'/htmlcontent/user'.$tab.'.html');
			$md_d1 = str_replace ("%tab%", $tabcontent, $content);
			$md_d2 = str_replace ("%url%", $url, $md_d1);
			$md_d3 = str_replace ("%default_theme%", $default_theme, $md_d2);
			$md_d4 = str_replace ("%info_log%", $info_log, $md_d3);
			$md_d5 = str_replace ("%info_sid%", $info_sid, $md_d4);
			if ($logdata != "") {
				$md_d5 = str_replace ("%logdata%", $logdata, $md_d5);
			}
			echo $md_d5;
		}
		function WriteLog ($ip, $type, $data) {
			$d_date = (date("d"))."/".(date("m"))." ".(date("H")).":".(date("i"));
			$s_string = ($d_date.'|'.$type.'|'.$ip.'|'.$data);
			file_put_contents ("task/rawlog/rawlog.txt", $s_string."\n", FILE_APPEND);
		}
		function DBTryConnect ($log, $pass) {
			include 'static/config.php';
			$login = $log;
			$passwd = $pass;
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
		function DBGetMDP ($logx) {
			include 'static/config.php';
			$conn = $logx;
			$link = mysql_connect($mysql_host, $mysql_log, $mysql_mdp);
			mysql_select_db($mysql_dbname, $link);
			$sql = "SELECT password FROM user_account WHERE login =  '".(mysql_real_escape_string($conn))."'";
			$query = mysql_query($sql);
			$result =  mysql_result($query,0);
			mysql_close($link);
			return $result;
		}
		function DBCheckLog ($log) {
			include 'static/config.php';
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
		function SecureCheckSID ($sid, $mdp) {
			include 'static/config.php';
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
		function SecureCalcSID ($info_mdp) {
			include 'static/config.php';
			$session = (date("z")).(date("d")).(date("g")).(date("f"));
			$string = ($info_mdp.$_SERVER['REMOTE_ADDR'].$salt.$session);
			$subsid = md5($string);
			$sid = substr ($subsid, 0, 6);
			return $sid;
		}
		function SecureRedirect ($direct) {
		    if (isset($_SERVER['HTTP_USER_AGENT']) && (strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE') !== false)) {
				echo ('<script type="text/javascript">window.location.href("'.$direct.'");</script>');;
			}
			else {
				echo ('<script type="text/javascript">window.location.replace("'.$direct.'");</script>');
			}			
		}
	}
	function read_file($sfile) {
		$fwd = $sfile;
		$hwd = fopen ($fwd, 'r');
		$content = fread($hwd, filesize($fwd));
		fclose($hwd);
		return $content;
	}
?>