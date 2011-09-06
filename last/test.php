<?php
include 'config.php';
_calcsid($salt, $url);

function _calcsid($s, $u) {
	$string = ($s.(strrev($u))) ;
	$sidx = md5($string);
	echo $sidx;
}
?>