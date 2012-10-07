<?php
	class HTML {
		function PrintIndex($error) {
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
		function PrintUser($info_sid, $info_log, $tab, $data, $page = 1) {
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
			if ($page != 1) {
				global $page_htm;
				for($i=$page;$i>0;$i--){
					$page_htm .= '<div onclick = "" class = "page">'.$i.'</div>';
				}
				$md_d5 = str_replace ("%page%", $page_htm);
			}
			else {
				$md_d5 = str_replace ("%page%", '<div onclick = "" class = "page">1</div>');
			}
			echo $md_d5;
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