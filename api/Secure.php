<?php
	class  Secure {
		function WriteLog ($ip, $type, $data) {
			$d_date = (date("d"))."/".(date("m"))." ".(date("H")).":".(date("i"));
			$s_string = ($d_date.'|'.$type.'|'.$ip.'|'.$data);
			$fpath = (dirname(__FILE__).'/../task/rawlog/rawlog.txt');
			file_put_contents ($fpath, $s_string."\n", FILE_APPEND);
		}
		function CheckSID ($sid, $mdp) {
			$Secure = new Secure;
			$session = (date("z")).(date("d")).(date("g")).(date("f"));
			$string = ($mdp.($Secure -> RetrieveIP()).SYS_SALT.$session);
			$subsid = md5($string);
			$sidx = substr ($subsid, 0, 6);
			if ($sid == $sidx) {
				return true ;
			}
			else {
				return false;
			}
		}
		function CalcSID ($info_mdp) {
			$Secure = new Secure;
			$session = (date("z")).(date("d")).(date("g")).(date("f"));
			$string = ($info_mdp.($Secure -> RetrieveIP()).SYS_SALT.$session);
			$subsid = md5($string);
			$sid = substr ($subsid, 0, 6);
			return $sid;
		}
		function CheckZombSID ($sid) {
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
		function Redirect ($direct) {
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
	}
?>