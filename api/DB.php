<?php
	class DB {
		function GetMDP ($logx) {
			$link = mysql_connect(MYSQL_HOST, MYSQL_USER, MYSQL_PASS);
			mysql_select_db(MYSQL_DB, $link);
			$sql = "SELECT password FROM user_account WHERE login =  '".(mysql_real_escape_string($logx))."'";
			$query = mysql_query($sql);
			$result =  mysql_result($query,0);
			mysql_close($link);
			return $result;
		}
		function CheckLog ($log) {
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
		function TryConnect ($login, $passwd) {
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
	}
?>